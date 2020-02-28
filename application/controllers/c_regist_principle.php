<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class c_regist_principle extends Core_Controller
{
    public function __construct(){
            parent::__construct();
            $this->auth_check();
            $this->load->model('m_wsbangun');
            $this->load->helper('date');
            date_default_timezone_set('Asia/Jakarta');
    }

    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

            // $table = 'v_reserve_product';
      //       $crit = array('entity_cd'=>$entity,
      //           'project_no'=>$project);
      //       $cons = $this->session->userdata('Tscons');
      //       $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

        $encParam = base64_encode($project.'-'.$projectName);

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                // 'product'=>$dtProduct,
                'encParam'=>$encParam
                                
             );
        $this->load_content_top_menu('regist_principle/index',$ContentAllData);
    }
    // Submit registration agent
        public function getTable_submit(){
            $project = $this->session->userdata('Tsproject');        

            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }

            $entity = $this->session->userdata('Tsentity');
            $this->load->library('Datatables');
            $DB2 = $this->load->database('ifca3', TRUE);

            //untuk PK diharap diletakan di awal array
            // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
            $aColumns  = array('row_number', 'registration_date','email_add', 'agency_name', 'company_name', 'contact_person', 'contact_no');
            // $aColumns = array('entity_cd', 'entity_name');
            $sTable = 'mgr.cf_registration_principle';

            $iDisplayStart = (int)$this->input->get_post('start', true);
            $iDisplayLength = (int)$this->input->get_post('length', true);
            $order = (int)$this->input->get_post('order', true);
            $draw = (int)$this->input->get_post('draw', true);
            $Column = $this->input->get_post('columns', true);
            // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
            // $iSortingCols = $this->input->get_post('iSortingCols', true);
            // $sSearch = $this->input->get_post('search', true);
            // $sEcho = $this->input->get_post('sEcho', true);
        
            $Search = $sSearch;
            // $SortdOrder = $order[0]['dir'];
            $SortdOrder = " DESC";
            $sortIdColumn = (int)$order[0]['column'];
            // var_dump($Column[$sordIdColumn]['name']);
            $SordField = ($sortIdColumn==0? 'audit_date' :$Column[$sortIdColumn]['name']);

            $filter_search='';
            if(isset($Search) && !empty($Search)){            
                for($i=0;$i<count($Column); $i++){
                    if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                        $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                    }
                    
                }
                $a = strrpos($filter_search, 'OR');        
                $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

            }
            // var_dump($filter_search);
            $param = " where rowID > 0 AND status = 'O'".$filter_search;
            // var_dump($param);

            $rResult = $this->m_wsbangun->getlisttableadm($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

            $sql="select count(*) as cnt from ".$sTable." ".$param;
            $ts = $DB2->query($sql);
            $a = $ts->result()[0]->cnt;

            $iTotal = $a;//$DB2->count_all($sTable);
        
            // Output
            $output = array(
                'draw' => intval($draw),
                'recordsTotal' => $iTotal,
                'recordsFiltered' => $iTotal,
                'data' => array()
            );
            
            foreach($rResult->result_array() as $aRow)
            {
                $row = array(); 
                
                foreach($aColumns as $col)
                {
                    $row[] = $aRow[$col];
                    
                }
        
                $output['data'][] = $aRow;
            }

       
            echo json_encode($output);
        }

        public function getPict($id, $type){
            $table  = 'mgr.v_cf_project_regist';

            if ($type == 'ID') {
                $type = 'file_url';
            }elseif ($type == 'NPWP') {
                $type = 'npwp_file_url';
            }elseif ($type == 'Member') {
                $type = 'member_file_url';
            }elseif ($type == 'Saving') {
                $type = 'saving_file_url';
            }

            $sql = "SELECT ".$type." AS url FROM ".$table." WHERE rowID = '$id'";

            // var_dump($sql);die;

            $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

            echo json_encode($data);
        }

        public function addnew($rowID, $status){
            $sql1 = "select descs, db_profile, project_no, entity_cd from mgr.pl_project";
            $dataProject = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql1);
            $listProject = '<option></option>';

            $sql2 = "select * from mgr.cf_registration_agent where RowID='$rowID'";
            $dataAgent = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql2);

             if(!empty($dataProject)) {
                $listProject = '<option></option>';
                foreach ($dataProject as $project) {
                    // $kriteria = array('entity_cd'=>$entity,
                    //     'project_no'=>$project,
                    //     'lot_no'=>$project->lot_no);                        

                    $listProject.='<option value="'.$project->project_no.'" data-db_profile="'.$project->db_profile.'" data-entity_cd="'.$project->entity_cd.'" data-project_no="'.$project->project_no.'" >'.$project->descs.'</option>';
                }
            }
            

            $data = array(
                'descs' => $dataProject,
                'agent' => $dataAgent,
                'RowID' => $rowID,
                'status' => $status,
                'project' => $listProject
            );

            // var_dump($data);exit();
            $this->load->view('regist_principle/add', $data);
        }

       
    // 
    // approve
        public function getTable_approvebk(){
            $project = $this->session->userdata('Tsproject');        

            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }

            $entity = $this->session->userdata('Tsentity');
            $this->load->library('Datatables');
            $DB2 = $this->load->database('ifca', TRUE);

            //untuk PK diharap diletakan di awal array
            // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
            $aColumns  = array('row_number', 'registration_date','email_add', 'agency_name', 'company_name', 'contact_person', 'contact_no');
            // $aColumns = array('entity_cd', 'entity_name');
            $sTable = 'mgr.cf_agent_hd';

            $iDisplayStart = (int)$this->input->get_post('start', true);
            $iDisplayLength = (int)$this->input->get_post('length', true);
            $order = (int)$this->input->get_post('order', true);
            $draw = (int)$this->input->get_post('draw', true);
            $Column = $this->input->get_post('columns', true);
            // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
            // $iSortingCols = $this->input->get_post('iSortingCols', true);
            // $sSearch = $this->input->get_post('search', true);
            // $sEcho = $this->input->get_post('sEcho', true);
        
            $Search = $sSearch;
            // $SortdOrder = $order[0]['dir'];
            $SortdOrder = " DESC";
            $sortIdColumn = (int)$order[0]['column'];
            // var_dump($Column[$sordIdColumn]['name']);
            $SordField = ($sortIdColumn==0? 'audit_date' :$Column[$sortIdColumn]['name']);

            $filter_search='';
            if(isset($Search) && !empty($Search)){            
                for($i=0;$i<count($Column); $i++){
                    if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                        $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                    }
                    
                }
                $a = strrpos($filter_search, 'OR');        
                $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

            }
            // var_dump($filter_search);
            $param = " where rowID > 0 AND status = 'A'".$filter_search;
            // var_dump($param);

            $rResult = $this->m_wsbangun->getlisttableadm($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

            $sql="select count(*) as cnt from ".$sTable." ".$param;
            $ts = $DB2->query($sql);
            $a = $ts->result()[0]->cnt;

            $iTotal = $a;//$DB2->count_all($sTable);
        
            // Output
            $output = array(
                'draw' => intval($draw),
                'recordsTotal' => $iTotal,
                'recordsFiltered' => $iTotal,
                'data' => array()
            );
            
            foreach($rResult->result_array() as $aRow)
            {
                $row = array(); 
                
                foreach($aColumns as $col)
                {
                    $row[] = $aRow[$col];
                    
                }
        
                $output['data'][] = $aRow;
            }

       
            echo json_encode($output);
        }
        public function getTable_approve(){
            $project = $this->session->userdata('Tsproject');        

            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }

            $entity = $this->session->userdata('Tsentity');
            $this->load->library('Datatables');
            $DB2 = $this->load->database('ifca3', TRUE);

            //untuk PK diharap diletakan di awal array
            // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
            $aColumns  = array('row_number', 'registration_date','email_add', 'agency_name', 'company_name', 'contact_person', 'contact_no');
            // $aColumns = array('entity_cd', 'entity_name');
            $sTable = 'mgr.cf_registration_principle';

            $iDisplayStart = (int)$this->input->get_post('start', true);
            $iDisplayLength = (int)$this->input->get_post('length', true);
            $order = (int)$this->input->get_post('order', true);
            $draw = (int)$this->input->get_post('draw', true);
            $Column = $this->input->get_post('columns', true);
            // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
            // $iSortingCols = $this->input->get_post('iSortingCols', true);
            // $sSearch = $this->input->get_post('search', true);
            // $sEcho = $this->input->get_post('sEcho', true);
        
            $Search = $sSearch;
            // $SortdOrder = $order[0]['dir'];
            $SortdOrder = " DESC";
            $sortIdColumn = (int)$order[0]['column'];
            // var_dump($Column[$sordIdColumn]['name']);
            $SordField = ($sortIdColumn==0? 'audit_date' :$Column[$sortIdColumn]['name']);

            $filter_search='';
            if(isset($Search) && !empty($Search)){            
                for($i=0;$i<count($Column); $i++){
                    if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                        $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                    }
                    
                }
                $a = strrpos($filter_search, 'OR');        
                $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

            }
            // var_dump($filter_search);
            $param = " where rowID > 0 AND status = 'A'".$filter_search;
            // var_dump($param);

            $rResult = $this->m_wsbangun->getlisttableadm($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

            $sql="select count(*) as cnt from ".$sTable." ".$param;
            $ts = $DB2->query($sql);
            $a = $ts->result()[0]->cnt;

            $iTotal = $a;//$DB2->count_all($sTable);
        
            // Output
            $output = array(
                'draw' => intval($draw),
                'recordsTotal' => $iTotal,
                'recordsFiltered' => $iTotal,
                'data' => array()
            );
            
            foreach($rResult->result_array() as $aRow)
            {
                $row = array(); 
                
                foreach($aColumns as $col)
                {
                    $row[] = $aRow[$col];
                    
                }
        
                $output['data'][] = $aRow;
            }

       
            echo json_encode($output);
        }
    
        public function approve(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');   

            
            if($_POST){
                $rowID = $this->input->post("rowID",true);
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');
                $cons = $this->session->userdata('Tscons');
           
                
                
                $sql = "SELECT max(group_cd) as group_cd from mgr.cf_agent_hd(nolock)";
                $cf_hd = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
                if(empty($cf_hd)){
                    $group_cd = 100000;
                } else{
                    $group_cd = (int)$cf_hd[0]->group_cd+1;
                }

                $where=array('rowID'=>$rowID);
                $data = $this->m_wsbangun->getData_by_criteria_adm('cf_registration_principle',$where);
                
                // buat jadi parameter store prosedur
                if(!empty($data)){
                    $lead_cd = $data[0]->lead_cd;
                    $group_name = $data[0]->agency_name;
                    $email_addr = $data[0]->email_add;
                }

                // var_dump($data[0]->agency_name);exit();
                $datacf = array(      
                            'group_name' => $data[0]->agency_name,
                            'group_cd' => $group_cd,
                            'contact_person' => $data[0]->contact_person,
                            'contact_no' => $data[0]->contact_no,
                            'audit_user'=>$audit_user,
                            'audit_date'=>$audit_date,
                            'group_type' => "P",
                            'telp_no' => $data[0]->office_phone,
                            'company_name' => $data[0]->company_name,
                            'company_NPWP' => $data[0]->company_npwp,
                            'company_address' => $data[0]->company_address,
                            'company_email'=>$data[0]->email_add,
                            'bank_name'=>$data[0]->bank_name,
                            'bank_acct_name'=>$data[0]->bank_acct_name,
                            'bank_acct_no'=>$data[0]->bank_acct_no,
                            'NPWP'=>$data[0]->company_npwp,
                            'lead_cd'=>$data[0]->lead_cd,
                            'email_addr'=>$data[0]->email_add,

                            'siup_file_attachment'=>$data[0]->siup_file_attachment,
                            'siup_file_url'=>$data[0]->siup_file_url,
                            'tdp_file_attachment'=>$data[0]->tdp_file_attachment,
                            'tdp_file_url'=>$data[0]->tdp_file_url,
                            'npwp_file_attachment'=>$data[0]->npwp_file_attachment,
                            'npwp_file_url'=>$data[0]->npwp_file_url,
                            'skd_file_attachment'=>$data[0]->skd_file_attachment,
                            'skd_file_url'=>$data[0]->skd_file_url,
                            'appp_file_attachment'=>$data[0]->appp_file_attachment,
                            'appp_file_url'=>$data[0]->appp_file_url,
                            'ktp_file_attachment'=>$data[0]->ktp_file_attachment,
                            'ktp_file_url'=>$data[0]->ktp_file_url
                        );
                
                $whereup = array('rowID' => $rowID);
                $dataup  = array('status' => 'A',
                                'approve_date'=>$audit_date,
                                'approve_user'=>$audit_user);
                // var_dump($group_cd);exit();
                $update = $this->m_wsbangun->updateDataadm('cf_registration_principle',$dataup,$whereup);
                if($update == 'OK'){
                    $insert = $this->m_wsbangun->insertData_cons($cons,'cf_agent_hd',$datacf);
                    if ($insert == 'OK'){
                            $msg="Data has been saved successfully";
                            $psn = "OK";
                           
                            $query = "mgr.xcf_approval_principle_mail '".$entity."', '".$project."','".$group_cd."','".$group_name."','".$email_addr."'";
                            $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca',$query);
                            $aaa = strpos($PsnMail,'queued');
                            if( $aaa <= 0 || !$aaa){
                                if($PsnMail=='OK'){
                                    $status = "OK";
                                    $psn = 'Please cek your email';
                                }else{
                                    $msg = $PsnMail;                        
                                    $Psn = 'Sent Email Failed, Please Contact your Admin!'; 
                                    $status = "Failed"; 
                                }
                                
                            }else{
                                $psn = 'Please cek your email';
                                $status = "Failed";
                            }
                        
                    }else{
                        $msg= $insert;
                        $psn = "Failed";
                    }
                }else{
                    $msg = $update;
                    $psn = "Failed";
                }

                

            }else{
                 $msg = "Data invalid";
                 $psn = "Failed";
            }
            $msg1=array("Pesan"=>$msg,
                    "status"=>$psn);
            echo json_encode($msg);
        }

        public function cancel(){
            $rowID = $this->input->post("rowID",true);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            
            $table = 'cf_registration_principle';
            $where = array('rowID' => $rowID);
            $data  = array('status' => 'C',
                            'approve_date'=>$audit_date,
                            'approve_user'=>$audit_user);

            $update = $this->m_wsbangun->updateDataadm($table,$data,$where);
            $msg = "Registration has been cancelled successfully";
            $msg1=array("Pesan"=>$msg);
            echo json_encode($msg1);
        }
    // End Decline registration agent
    // 
    // Cancel Registration agent
        public function getTable_cancel(){
            $project = $this->session->userdata('Tsproject');        

            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }

            $entity = $this->session->userdata('Tsentity');
            $this->load->library('Datatables');
            $DB2 = $this->load->database('ifca3', TRUE);

            //untuk PK diharap diletakan di awal array
            // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
            $aColumns  = array('row_number', 'registration_date','email_add', 'agency_name', 'company_name', 'contact_person', 'contact_no');
            // $aColumns = array('entity_cd', 'entity_name');
            $sTable = 'mgr.cf_registration_principle';

            $iDisplayStart = (int)$this->input->get_post('start', true);
            $iDisplayLength = (int)$this->input->get_post('length', true);
            $order = (int)$this->input->get_post('order', true);
            $draw = (int)$this->input->get_post('draw', true);
            $Column = $this->input->get_post('columns', true);
            // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
            // $iSortingCols = $this->input->get_post('iSortingCols', true);
            // $sSearch = $this->input->get_post('search', true);
            // $sEcho = $this->input->get_post('sEcho', true);
        
            $Search = $sSearch;
            // $SortdOrder = $order[0]['dir'];
            $SortdOrder = " DESC";
            $sortIdColumn = (int)$order[0]['column'];
            // var_dump($Column[$sordIdColumn]['name']);
            $SordField = ($sortIdColumn==0? 'audit_date' :$Column[$sortIdColumn]['name']);

            $filter_search='';
            if(isset($Search) && !empty($Search)){            
                for($i=0;$i<count($Column); $i++){
                    if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                        $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                    }
                    
                }
                $a = strrpos($filter_search, 'OR');        
                $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

            }
            // var_dump($filter_search);
            $param = " where rowID > 0 AND status = 'C'".$filter_search;
            // var_dump($param);

            $rResult = $this->m_wsbangun->getlisttableadm($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

            $sql="select count(*) as cnt from ".$sTable." ".$param;
            $ts = $DB2->query($sql);
            $a = $ts->result()[0]->cnt;

            $iTotal = $a;//$DB2->count_all($sTable);
        
            // Output
            $output = array(
                'draw' => intval($draw),
                'recordsTotal' => $iTotal,
                'recordsFiltered' => $iTotal,
                'data' => array()
            );
            
            foreach($rResult->result_array() as $aRow)
            {
                $row = array(); 
                
                foreach($aColumns as $col)
                {
                    $row[] = $aRow[$col];
                    
                }
        
                $output['data'][] = $aRow;
            }

       
            echo json_encode($output);
        }

      
        
    // End History Registration agent

    
}
?>