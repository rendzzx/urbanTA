<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_csassign extends Core_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_login');
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');
    }   

     public function index(){

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
         if($entity == ''){
            $entity = '2101';
            $project = '210101';
	       }

        $table = 'pl_project';
        $proDescs = $this->m_wsbangun->getData($table);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }

        

        $table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);

        $table = 'select name from mgr.sv_labour';
        $assignto = $this->m_wsbangun->getData_by_query($table);
        // var_dump($entityName);
           // $cbassign[] = '<option value=""></option>';
            foreach ($assignto as $result) {
                
                $cbassign[] = '<option value="'.trim($result->name).'" >'.$result->name.'</option>';
            }
            $cbassign = implode("", $cbassign);

            

        $data=array('product'=>$dtProduct,
                    'project'=>$project,
                    'ProjectDescs'=>$projectName,
                    'cbProject'=>$comboProject,
                    'comboAssign'=>$this->list_assign($name));
        
        
        $this->load_content_top_menu('cs_assign/index',$data);
        
    }
    public function getTable()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
       $entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('report_no','debtor_acct', 'name', 'reported_date','reported_by','status_desc','assign_to','departement','division','rowID','status');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_sv_entry_assignment';
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $Search = $sSearch['value'];
        $Search = $sSearch;

         if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            // var_dump($entity);
        }
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        // $SordField = ('STATUS desc,reserve_date ASC');

     
// var_dump($Search);
        // filter
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
        // Select Data

        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablenup($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
        // Total data set length
        
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

    

   public function Approval(){
        if($_POST){
            $debtor_acct = $this->input->post("debtor_acct",true);
            $entity = $this->input->post('entity');
            $project = $this->input->post('project');
            $project = trim($project);
            // $name = $this->session->userdata('Tsuname');

           
            // $group_cd = $v_logindebtor[0]->group_cd;

            $url= base_url('occupants/index/'.base64_encode($debtor_acct.'_'.$entity.'_'.$project));

            $msg='';
            $psn='';
            $aa='';
            
                $sql = "mgr.xcf_debtor_approval_web '".$entity."', '".$project."','".$debtor_acct."', '".$url."' ";
               
                $snd = $this->m_wsbangun->setData_by_query($sql);
                //  var_dump($snd);
                // exit();
                // var_dump($snd);
                // exit;
                $aaa = strpos($snd,'queued');
                if( $aaa <= 0 || !$aaa){
                    if($snd=='OK'){
                        $msg = 'Email sent';
                        $psn ='OK';
                        $aa = $msg;
                    }else{
                        $msg = $snd;
                        $psn ='Fail';
                        $aa = 'Sent Email Failed, Please Contact your Admin!';
                    }
                    
                }else{
                    $msg = 'Email sent';
                    $psn ='OK';
                    $aa = $msg;
                }
           
            $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
            echo json_encode($t);
        }
    }

    public function save()
    {
        if($_POST)
        {
            // var_dump($_POST);
            $models = $this->input->post('models', true);
            // $today = date('d M Y H:i:s');
            
            // $group = $this->input->post('gid', true);

            if(!empty($models))
            {
                // var_dump($models);
                // $debtor_acct = $models[0]['debtor_acct'];
                // $entity = $models[0]['entity'];
                // $project = $models[0]['project'];
                // // var_dump($gID);
                // var_dump($gID['GroupCd']);
                // exit();
                
                foreach ($models as $dt) {
                    // var_dump($dt);
                    $msg='';
		            $psn='';
		            $aa='';
                    // $menuID = $dt->MenuID;
                    $url= base_url('occupants/index/'.base64_encode($dt['debtor_acct'].'_'.$dt['entity'].'_'.$dt['project']));

                    $sql = "mgr.xcf_debtor_approval_web '".$dt['entity']."', '".$dt['project']."','".$dt['debtor_acct']."', '".$url."' ";
                    $snd = $this->m_wsbangun->setData_by_query($sql);
                //  var_dump($snd);
                // exit();
                // var_dump($snd);
                // exit;
		                $aaa = strpos($snd,'queued');
		                if( $aaa <= 0 || !$aaa){
		                    if($snd=='OK'){
		                        $msg = 'Email sent';
		                        $psn ='OK';
		                        $aa = $msg;
		                    }else{
		                        $msg = $snd;
		                        $psn ='Fail';
		                        $aa = 'Sent Email Failed, Please Contact your Admin!';
		                    }
		                    
		                }else{
		                    $msg = 'Email sent';
		                    $psn ='OK';
		                    $aa = $msg;
		                }
		           
		                }
            }
        } else {
            $msg = 'No menu Assigned';
            // var_dump($_POST);
            // exit();
            // $gID = $models[0]['GroupCd'];
            // $table = 'sysMenuGroup';
            // $crit = array('groupCd'=>$gID);
            // $this->m_wsbangun->deletedata($table, $crit);
        }
        $tes = array('Response'=>$msg);
        echo json_encode($tes);
    }

    public function showinfo($status = null)
    {
        // var_dump($status);exit();
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        // $sql = "select report_no, serv_req_by, contact_no, lot_no, floor, location_type, category_cd, work_requested from mgr.sv_entry_hd where entity_cd ='$entity' and project_no = '$project'";
        // $data = $this->m_wsbangun->getData_by_query($sql);
        // var_dump($data);exit();
        // $report_no =$data[0]->report_no;
        // $serv_req_by = $data[0]->serv_req_by;
        // $contact_no =$data[0]->contact_no;
        // $lot_no = $data[0]->lot_no;
        // $floor =$data[0]->floor;
        // $location_type = $data[0]->location_type;
        // $category_cd = $data[0]->category_cd;
        // $work_requested = $data[0]->work_requested;
        // $content = array('report_no' => $report_no,
        //                 'serv_req_by'=> $serv_req_by,
        //                 'contact_no' => $contact_no,
        //                 'lot_no'=> $lot_no,
        //                 'floor' => $floor,
        //                 'location_type'=> $location_type,
        //                 'category_cd' => $category_cd,
        //                 'work_requested'=> $work_requested,
        //                 'status'=>$status);
        // var_dump($content);
        $content = array('status' => $status );
        // $data = $this->m_wsbangun->getData_by_criteria('mgr.sv_entry_hd',$content);
        // echo json_encode($data);
        // exit();
        $this->load->view('cs_assign/info',$content);
    }


    public function getByID($id=''){
        // if(empty($id)){
        //     $id=''
        // }
        //  $sql = "select report_no, serv_req_by, contact_no, lot_no, floor, location_type, category_cd, work_requested from mgr.sv_entry_hd where entity_cd ='$entity' and project_no = '$project'";
        // $data = $this->m_wsbangun->getData_by_query($sql);
        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria('sv_entry_hd',$where);

        echo json_encode($data);


    }

    public function updatestatus()
    {
     $table='sv_entry_hd';
     $rowID = $this->input->post('rowID');
     $assign_to = $this->input->post('assign_to');
     // var_dump($assign_to);exit();
     $data = array('assign_to' => $assign_to);
     $where = array('rowID'=>$rowID);
     $update = $this->m_wsbangun->updateData($table,$data, $where);

     if($update == 'OK')
           {
                          
                $a = "Data has been Update successfully";
                $psn = "OK";
            } else {
                $a= $update;
                $psn = "Failed";
            }   
        $msg = array('pesan'=>$a,
                    'status'=>$psn);
        echo json_encode($msg);
    }


public function updatesubmit()
    {
     
            $table='sv_entry_hd';
             // $rowID = $this->input->post('rowID');
             $rowID = $this->input->post('rowID');
             // $status = $this->input->post('status');
             $status = $this->input->post('status');
             // var_dump($status);exit();
            $sql = "SELECT assign_to from mgr.sv_entry_hd(nolock) where rowID='$rowID'";
            $data = $this->m_wsbangun->getData_by_querypb($sql);
            // var_dump($data);exit();
            if (empty($data[0]->assign_to) or $data[0]->assign_to=='') {
                $psn = "Failed";
                $a = "Choose assign to first.";
            }
            else{
            $data = array('status'=> 'M');
             $where = array('rowID'=>$rowID);
             $update = $this->m_wsbangun->updateData($table,$data, $where);

                if($update == 'OK')
                        {
                            
                            $a = "Data has been Updated successfully";
                            $psn = "OK";
                        } else {
                            $a= $update;
                            $psn = "Failed";
                        }  
            }
             // $assign_to = $this->input->post('assign_to');
             
                $msg = array('pesan'=>$a,
                            'status'=>$psn);
                echo json_encode($msg);


    }

    public function insert_his($rowID=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $sql ="INSERT INTO mgr.sv_entry_hd";
        $sql.=" select * from sv_entry_hd WHERE rowID= ".$rowID;
        // $result = $this->m_wsbangun->getData_by_query($sql);
        $DB2 = $this->load->database('ifca', TRUE);
        $query = $DB2->query($sql);

    }

    public function list_assign($name=''){


         $table = "SELECT * from mgr.sv_labour (nolock) ";
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query($table);
        // var_dump($project);
        $comboAssign[]='';
            if(!empty($proDescs)) {
                $comboAssign[] = '';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $assignto) {

                  // if($name === $assignto->rowID) {
                  //   // var_dump($project.' -- '.$dtProject->project_no);
                  //   $pilih = ' selected = "1"';
                  // } else {
                  //   $pilih = '';
                  // }
                    $comboAssign[] = '<option value="'.trim($assignto->staff_id).'" >'.$assignto->staff_id.'</option>';
                }
                $comboAssign = implode("", $comboAssign);
            }
            return $comboAssign;
    }
    
}