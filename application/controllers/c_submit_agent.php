<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class c_submit_agent extends Core_Controller
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

		$table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $cons = $this->session->userdata('Tscons');
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

        $encParam = base64_encode($project.'-'.$projectName);

		$ContentAllData = array(
    			'project_no'=>$project,
				'ProjectDescs'=>$projectName,
				'product'=>$dtProduct,
                'encParam'=>$encParam
								
             );
    	$this->load_content_top_menu('submit_agent/index',$ContentAllData);
	}
    // Submit registration agent
    	public function getTable(){
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
            $aColumns  = array('row_number', 'group_type','email_add', 'project_choosen', 'full_name', 'nik', 'handphone1', 'file_url', 'registration_date');
            // $aColumns = array('entity_cd', 'entity_name');
            $sTable = 'mgr.v_cf_project_regist';

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
            $this->load->view('submit_agent/add', $data);
        }

        public function verifyproject($rowID, $email){
            $sql = "select * from mgr.v_cf_project_agent where email_add = '$email'";
            $project = $this->m_wsbangun->getData_by_queryadm($sql);

            $sql2 = "select * from mgr.cf_registration_agent where RowID='$rowID'";
            $dataAgent = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql2);

            $data = array(
                'agent' => $dataAgent,
                'project' => $project
            );
            $this->load->view('submit_agent/verifyproject', $data);
        }

        public function verifyproject_save(){
            $project_no = $this->input->post('project[]');
            $msg="";

            if ($_POST) {
                // DECLARE VARIABLE POST
                    $group_type = $this->input->post('txtGrouptype');
                    // $entity_cd = $this->input->post('cmbProject1');
                    $group_cd = $this->input->post('txtGroupcd');
                    $group_name = $this->input->post('txtGroupname');
                    $email_add = $this->input->post('txtEmail');
                    $full_name =$this->input->post('txtFullname');
                    $nik = $this->input->post('txtNik');                
                    $handphone1 = $this->input->post('txtHandphone');
                    $status = 'N'; 
                    $agent_type = 'E';
                    $transfer_bank = $this->input->post('txtTrasnfer_bank');
                    $transfer_name = $this->input->post('txtTransfer_name');
                    $transfer_acc = $this->input->post('txtTransfer_acc');
                    $npwp = $this->input->post('txtNpwp');
                    $home_add = '-';
                    $city = '-';
                    $province = '-';
                    $post_cd = '-';
                    $handphone = '-';
                    $status_app = 'U';
                    $principal_flag = 'N';
                    $resignstat = 'N';
                    $batas = $this->input->post('batas');                               
                    $audit_date = date('d M Y H:i:s');
                    $audit_user = $this->session->userdata('Tsuname');
                    $submit_date = date('d M Y H:i:s');

                    $file_url = $this->input->post('txtFileurl');
                    $npwp_file_url = $this->input->post('txtNpwpurl');
                    $member_file_url = $this->input->post('txtMemberurl');
                    $saving_file_url = $this->input->post('txtSavingurl');

                    $file_attachment = $this->input->post('txtFileattachment');
                    $npwp_file_attachment = $this->input->post('txtNpwpattachment');
                    $member_file_attachment = $this->input->post('txtMemberattachment');
                    $saving_file_attachment = $this->input->post('txtSavingattachment');
                    
                    $registration_date = $this->input->post('txtRegistdate');
                // UPDATE cf_project_agent AND INSERT TO cf_registration_agent_dt LOOPING
                    for ($i=0; $i < count($project_no); $i++) { 
                        $pro_no = $project_no[$i];
                        // UPDAT DATA SET STATUS TO N cf_project_agent
                            $set_cfpa = array('status' => 'N');
                            $where_cfpa = array(
                                'email_add' => $email_add, 
                                'project_no' => $pro_no
                            );

                            $update_cfpa = $this->m_wsbangun->updateDataadm('cf_project_agent', $set_cfpa, $where_cfpa);

                            if ($update_cfpa == 'OK'){
                                    $msg="Data has been saved successfully";
                                    $psn = "OK";
                            }else{
                                $msg= $update_cfpa;
                                $psn = "Failed";
                            }
                        // END UPDATE DATA cf_project_agent
                        
                        // INSERT DATA cf_registration_agent_dt
                            $entable = 'pl_project';
                            $enwhere = array(
                                'project_no' => $pro_no
                            );
                            $entity = $this->m_wsbangun->getData_by_criteria_adm($entable, $enwhere);

                            $en_cd = $entity[0]->entity_cd;
                            
                            $data_cfrad = array(
                                'group_type' => $group_type,
                                'email_add' => $email_add,
                                'project_no' => $pro_no,
                                'group_cd' => $group_cd,
                                'statuss' => $status,
                                'audit_user' => $audit_user,
                                'audit_date' => $audit_date,
                                'entity_cd' => $en_cd,
                                'submit_date' => $submit_date
                            );

                            $insert_cfrad = $this->m_wsbangun->insertData('cf_registration_agent_dt', $data_cfrad);

                            if ($insert_cfrad == 'OK'){
                                    $msg="Data has been saved successfully";
                                    $psn = "OK";
                            }else{
                                $msg= $insert_cfrad;
                                $psn = "Failed";
                            }
                        // END INSERT DATA cf_registration_agent_dt
                    } //end for
                // UPDATE cf_project_agent AND INSERT TO cf_registration_agent_dt LOOPING
                
                // INSERT TO urban_live cf_agent_dt AND urban_adm cf_his_registration_agent
                    // GET agent_cd
                        $cntgroup_cd = strlen($group_cd);
                        $sqls = "SELECT max(agent_cd)";
                        $sqls .= " AS agent_code";
                        $sqls .= " FROM mgr.cf_agent_dt";
                        $sqls .= " WHERE group_cd = '$group_cd' and";
                        $sqls .= "      substring(agent_cd,1,$cntgroup_cd)='$group_cd'  ;";

                        $cntAgent = $this->m_wsbangun->getData_by_querypb_cons('IFCAPB', $sqls);
                        $dtAgent = $cntAgent[0]->agent_code;

                        if (empty($dtAgent)) {
                            $dtAgent=0;
                        }
                        else{
                            $dtAgent= substr($dtAgent,-3,3);
                        }

                        $dtAgents = $dtAgent+1;
                        $dtAgent_ = $dtAgents+1000;
                        $dt_agent = $group_cd.substr($dtAgent_, 1, 3);

                    $datas = array(      
                        'group_cd' => $group_cd,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date,
                        'status' => $status,
                        'email_add'=>$email_add,
                        'ENTITY_CD' => ' ',
                        'agent_cd' => $dt_agent,
                        'agent_name' => $full_name,
                        'agent_type_cd' => $agent_type,
                        'handphone1'=>$handphone1,
                        'id_no'=>$nik,
                        'transfer_name'=>$transfer_name,
                        'transfer_acct_no'=>$transfer_acc,
                        'transfer_bank_name'=>$transfer_bank,
                        'npwp'=>$npwp,
                        'home_address'=>$home_add,
                        'city'=>$city,
                        'province'=>$province,
                        'post_cd'=>$post_cd,
                        'handphone2'=>$handphone,
                        'status_approval'=>$status_app,
                        'principal_flag'=>$principal_flag,
                        'resign_status'=>$resignstat,
                        
                        'file_url'=>$file_url,
                        'file_attachment'=>$file_attachment,
                        'npwp_file_url'=>$npwp_file_url,
                        'npwp_file_attachment'=>$npwp_file_attachment,
                        'member_file_url'=>$member_file_url,
                        'member_file_attachment'=>$member_file_attachment,
                        'saving_file_url'=>$saving_file_url,
                        'saving_file_attachment'=>$saving_file_attachment
                    );
                    // }

                    $insert2 = $this->m_wsbangun->insertData_cons('IFCAPB','cf_agent_dt',$datas);
                    if ($insert2 == 'OK') {
                        // INSERT TO cf_his_registration_agent
                            $data_cfhra = array(
                                'group_type'=>$group_type,
                                'email_add'=>$email_add,
                                'full_name'=>$full_name,
                                'nik'=>$nik,
                                'transfer_name'=>$transfer_name,
                                'transfer_acct_no'=>$transfer_acc,
                                'transfer_bank_name'=>$transfer_bank,
                                'npwp'=>$npwp,
                                'handphone1'=>$handphone1,
                                'status'=>$status,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date,
                                'registration_date'=>$registration_date,

                                'group_cd'=>$group_cd,
                                'group_name'=>$group_name,

                                'file_url'=>$file_url,
                                'npwp_file_url'=>$npwp_file_url,
                                'member_file_url'=>$member_file_url,
                                'saving_file_url'=>$saving_file_url,

                                'file_attachment'=>$file_attachment,
                                'npwp_file_attachment'=>$npwp_file_attachment,
                                'member_file_attachment'=>$member_file_attachment,
                                'saving_file_attachment'=>$saving_file_attachment,
                                'approve_user'=>$audit_user,
                                'approve_date'=>$audit_date
                            );

                            $insert_cfhra = $this->m_wsbangun->insertDataweb('cf_his_registration_agent',$data_cfhra);

                            if ($insert_cfhra == "OK") {

                                $email_add = $this->input->post('txtEmail',true);
                                if(empty($email_add)){
                                    $email_add=0;
                                }
                                $where=array('email_add'=>$email_add);
                                $datac = $this->m_wsbangun->deletedataweb('cf_registration_agent',$where);
                                if ($datac == 'OK') {
                                    $msg="Data has been saved successfully";
                                    $psn = "OK";
                                }else{
                                    $msg = $datac;
                                    $psn = "Failed";
                                }
                            }else{
                                $msg= $insert_cfhra;
                                $psn = "Failed";
                            }
                        // END INSERT TO cf_his_registration_agent
                    }else{
                        $msg= $insert2;
                        $psn = "Failed";
                    }
                // END INSERT TO mgr.cf_agent_dt URBAN LIVE
                // 
            } //end if post
            else{
                $msg="Data validation is not valid";
            }
            $msg1=array(
                "Pesan"=>$msg,
                "status"=>$psn
            );
            echo json_encode($msg1);
        }

        public function save_agent(){
            $msg="";
            if ($_POST){
                // var_dump($_POST);exit();
                //----------- Declare
                    $group_type = $this->input->post('txtGrouptype');
                    // $entity_cd = $this->input->post('cmbProject1');
                    // $group_cd = $this->input->post('cmbAgent1');
                    $email_add = $this->input->post('txtEmail');
                    $full_name =$this->input->post('txtFullname');
                    $nik = $this->input->post('txtNik');                
                    $handphone1 = $this->input->post('txtHandphone');
                    $status = 'N'; 
                    $agent_type = 'E';
                    $transfer_bank = $this->input->post('txtTrasnfer_bank');
                    $transfer_name = $this->input->post('txtTransfer_name');
                    $transfer_acc = $this->input->post('txtTransfer_acc');
                    $npwp = $this->input->post('txtNpwp');
                    $home_add = '-';
                    $city = '-';
                    $province = '-';
                    $post_cd = '-';
                    $handphone = '-';
                    $status_app = 'U';
                    $principal_flag = 'N';
                    $resignstat = 'N';
                    $batas = $this->input->post('batas');                               
                    $audit_date = date('d M Y H:i:s');
                    $audit_user = $this->session->userdata('Tsuname');
                    $submit_date = date('d M Y H:i:s');

                    $file_url = $this->input->post('txtFileurl');
                    $npwp_file_url = $this->input->post('txtNpwpurl');
                    $member_file_url = $this->input->post('txtMemberurl');
                    $saving_file_url = $this->input->post('txtSavingurl');

                    $file_attachment = $this->input->post('txtFileattachment');
                    $npwp_file_attachment = $this->input->post('txtNpwpattachment');
                    $member_file_attachment = $this->input->post('txtMemberattachment');
                    $saving_file_attachment = $this->input->post('txtSavingattachment');
                    
                    $registration_date = $this->input->post('txtRegistdate');

                for ($i=1; $i < $batas ; $i++) {
                    // $entity_cd = $this->input->post('cmbProject'.$i);
                    $entity_cd = $this->input->post('txtEntitycd'.$i);
                    $db_profile = $this->input->post('txtdbprofile'.$i);
                    $group_cd = $this->input->post('cmbAgent'.$i);
                    $project_no = $this->input->post('txtProjectno'.$i);

                    $data = array(      
                        'group_type' => $group_type,
                        'group_cd' => $group_cd,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date,
                        'statuss' => $status,
                        'email_add'=>$email_add,
                        'entity_cd'=>$entity_cd,
                        'project_no'=>$project_no,
                        'submit_date'=>$submit_date
                    );
                    $psn='';
                    // var_dump($data);
                    $insert = $this->m_wsbangun->insertData_cons('ifca3','cf_registration_agent_dt',$data);
                    // $insert == 'OK';
                    if ($insert == 'OK'){
                            $msg="Data has been saved successfully";
                            $psn = "OK";
                    }else{
                        $msg= $insert;
                        $psn = "Failed";
                    }

                    $cntgroup_cd = strlen($group_cd);
                    $sqls = "SELECT max(agent_cd)";
                    $sqls .= " AS agent_code";
                    $sqls .= " FROM mgr.cf_agent_dt";
                    $sqls .= " WHERE entity_cd = '$entity_cd' and";
                    $sqls .= "      group_cd = '$group_cd' and";
                    $sqls .= "      substring(agent_cd,1,$cntgroup_cd)='$group_cd'  ;";

                    $cntAgent = $this->m_wsbangun->getData_by_querypb_cons($db_profile, $sqls);
                    $dtAgent = $cntAgent[0]->agent_code;

                    if (empty($dtAgent)) {
                        $dtAgent=0;
                    }
                    else{
                        $dtAgent= substr($dtAgent,-3,3);
                    }

                    $dtAgents = $dtAgent+1;
                    // var_dump($dtAgent);
                    $dtAgent_ = $dtAgents+1000;
                    // var_dump($dtAgent_);
                    $dt_agent = $group_cd.substr($dtAgent_, 1, 3);
                    // var_dump($dt_agent);

                    $datas = array(      
                        'group_cd' => $group_cd,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date,
                        'status' => $status,
                        'email_add'=>$email_add,
                        'ENTITY_CD' => $entity_cd,
                        'agent_cd' => $dt_agent,
                        'agent_name' => $full_name,
                        'agent_type_cd' => $agent_type,
                        'handphone1'=>$handphone1,
                        'id_no'=>$nik,
                        'transfer_name'=>$transfer_name,
                        'transfer_acct_no'=>$transfer_acc,
                        'transfer_bank_name'=>$transfer_bank,
                        'npwp'=>$npwp,
                        'home_address'=>$home_add,
                        'city'=>$city,
                        'province'=>$province,
                        'post_cd'=>$post_cd,
                        'handphone2'=>$handphone,
                        'status_approval'=>$status_app,
                        'principal_flag'=>$principal_flag,
                        'resign_status'=>$resignstat
                    );
                    // }

                    $insert2 = $this->m_wsbangun->insertData_cons($db_profile,'cf_agent_dt',$datas);
                    if ($insert2 == 'OK') {

                        $dataz = array(
                            'group_type'=>$group_type,
                            'email_add'=>$email_add,
                            'full_name'=>$full_name,
                            'nik'=>$nik,
                            'transfer_name'=>$transfer_name,
                            'transfer_acct_no'=>$transfer_acc,
                            'transfer_bank_name'=>$transfer_bank,
                            'npwp'=>$npwp,
                            'handphone1'=>$handphone1,
                            'status'=>$status,
                            'audit_user'=>$audit_user,
                            'audit_date'=>$audit_date,
                            'registration_date'=>$registration_date,

                            'group_cd'=>$group_cd,

                            'file_url'=>$file_url,
                            'npwp_file_url'=>$npwp_file_url,
                            'member_file_url'=>$member_file_url,
                            'saving_file_url'=>$saving_file_url,

                            'file_attachment'=>$file_attachment,
                            'npwp_file_attachment'=>$npwp_file_attachment,
                            'member_file_attachment'=>$member_file_attachment,
                            'saving_file_attachment'=>$saving_file_attachment,
                            'approve_user' => $audit_user,
                            'approve_date' => $audit_date
                        );

                       $insert3 = $this->m_wsbangun->insertData_cons('ifca3','cf_his_registration_agent',$dataz);

                        if ($insert3 == "OK") {

                            $email_add = $this->input->post('txtEmail',true);
                            if(empty($email_add)){
                                $email_add=0;
                            }
                            $where=array('email_add'=>$email_add);
                            $datac = $this->m_wsbangun->deletedataweb('cf_registration_agent',$where);
                            if ($datac == 'OK') {
                                $msg="Data has been saved successfully";
                                $psn = "OK";
                            }else{
                                $msg = $datac;
                                $psn = "Failed";
                            }
                        }else{
                            $msg= $insert3;
                            $psn = "Failed";
                        }
                    }else{
                        $msg= $insert2;
                        $psn = "Failed";
                    }
                }

                // $dataupdate = array(
                //                'status' => $status );
                // $where = array(
                //             'email_add' => $email_add );
                // $updatedata = $this->m_wsbangun->updateDataadm('cf_registration_agent', $dataupdate,$where);

                // if ($updatedata == 'OK') {
                //     $msg = "Data has been saved successfully";
                //     $psn = "OK";
                // }else{
                //     $msg= $updatedata;
                //     $psn = "Failed";
                // }
            } //-----------tutup post
            else{
                $msg="Data validation is not valid";
            }
            $msg1=array("Pesan"=>$msg,
                "status"=>$psn
            );
            echo json_encode($msg1);
        }
    // End Submit registration agent
    
    // Decline registration agent
        public function getTableDecline(){
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
            $aColumns  = array('row_number', 'group_type','email_add', 'project_choosen', 'full_name', 'nik', 'handphone1', 'file_url', 'registration_date');
            // $aColumns = array('entity_cd', 'entity_name');
            $sTable = 'mgr.v_cf_project_regist';

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

        public function getPictDecline($id, $type){
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

        public function decline(){
            $rowID = $this->input->post("rowID",true);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');

            $table = 'cf_registration_agent';

            $data  = array(
                'status' => 'C',
                'approve_user' => $audit_user,
                'approve_date' => $audit_date
            );
            $where = array('rowID' => $rowID);

            $update = $this->m_wsbangun->updateDataadm($table,$data,$where);
            $msg = "Data has been deleted successfully";
            $msg1=array("Pesan"=>$msg);
            echo json_encode($msg1);
        }
    // End Decline registration agent
    
    // History Registration agent
        public function getTableHistory(){
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
            $aColumns  = array('row_number', 'group_type','email_add', 'project_choosen', 'full_name', 'nik', 'handphone1', 'file_url', 'registration_date');
            // $aColumns = array('entity_cd', 'entity_name');
            $sTable = 'mgr.v_cf_history_regist';

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
            $param = " where rowID > 0 AND status = 'N'".$filter_search;
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

        public function getPictHis($id, $type){
            $table  = 'mgr.v_cf_history_regist';

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

        public function addHis($rowID, $status){
            
            $sql1 = "select descs, db_profile, project_no, entity_cd from mgr.pl_project";
            $dataProject = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql1);
            $listProject = '<option></option>';

            $sql2 = "select * from mgr.cf_his_registration_agent where RowID='$rowID'";
            $dataAgent = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql2);

             if(!empty($dataProject)) {
                $listProject = '<option></option>';
                foreach ($dataProject as $project) {
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
            $this->load->view('submit_agent/addHistory', $data);
        }

        public function editHis($rowID){
            $sql2 = "select * from mgr.v_cf_his_agent_regist where rowID='$rowID'";
            $dataAgent = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql2);

                $data = array(
                    'agent' => $dataAgent,
                    'rowID' => $rowID
                    );

            // var_dump($data);exit();
            $this->load->view('submit_agent/editHistory', $data);
        }

        public function viewHis($email_add=''){
            $sql1 = "select * from mgr.v_history_agent where email_add='$email_add' ";
            $dataProject = $this->m_wsbangun->getData_by_queryadm($sql1);
            $listProject = "";
            if(!empty($dataProject)) {
                foreach ($dataProject as $project) {
                                      
                    $sql2 = "select group_name from mgr.cf_agent_hd where group_cd='".$project->group_cd."'";
                    $dataAgent = $this->m_wsbangun->getData_by_query_cons($project->db_profile,$sql2);
                    $listProject.= '<tr>';
                    $listProject.='<td>'.date("l, d-m-Y H:i:s",strtotime($project->registration_date)).'</td>';
                    $listProject.='<td>'.$project->descs.'</td>';
                    $listProject.='<td>'.$dataAgent[0]->group_name.'</td>';
                    $listProject.='<td>'.date("l, d-m-Y H:i:s",strtotime($project->submit_date)).'</td>';
                    $listProject.='</tr>';
                }
            }else{
                $listProject.= '<tr>';
                $listProject.='<td colspan="4" align="center">No Data Available</td>';
                $listProject.='</tr>';

            }

            $data = array(
                // 'descs' => $dataProject,
                // 'agent' => $dataAgent,
                'project' => $listProject
            );
            $this->load->view('submit_agent/viewHistory', $data);
        }

        public function saveHis(){ 
           $msg="";
              if ($_POST)
                {
                       // var_dump($_POST);exit();
                    //-----------kode agent_cd


                    $group_type = $this->input->post('txtGrouptype');
                    // $entity_cd = $this->input->post('cmbProject1');
                    // $group_cd = $this->input->post('cmbAgent1');
                    $email_add = $this->input->post('txtEmail');
                    $full_name =$this->input->post('txtFullname');
                    $nik = $this->input->post('txtNik');                
                    $handphone1 = $this->input->post('txtHandphone');
                    $status = 'N'; 
                    $agent_type = 'E';
                    $transfer_name = $this->input->post('txtTransfer_name');
                    $transfer_acc = $this->input->post('txtTransfer_bank');
                    $transfer_bank = $this->input->post('txtTransfer_acc');
                    $npwp = $this->input->post('txtNpwp');
                    $home_add = '-';
                    $city = '-';
                    $province = '-';
                    $post_cd = '-';
                    $handphone = '-';
                    $status_app = 'U';
                    $principal_flag = 'N';
                    $resignstat = 'N';
                    $batas = $this->input->post('batas');                               
                    $audit_date = date('d M Y H:i:s');
                    $audit_user = $this->session->userdata('Tsuname');
                    $submit_date = date('d M Y H:i:s');

                                for ($i=1; $i < $batas ; $i++) { 
                                        // $entity_cd = $this->input->post('cmbProject'.$i);
                                        $entity_cd = $this->input->post('txtEntitycd'.$i);
                                        $group_cd = $this->input->post('cmbAgent'.$i);
                                        $db_profile = $this->input->post('txtdbprofile'.$i);
                                        $project_no = $this->input->post('txtProjectno'.$i);

                                        $data = array(      
                                        'group_type' => $group_type,
                                        'group_cd' => $group_cd,
                                        'audit_user'=>$audit_user,
                                        'audit_date'=>$audit_date,
                                        'statuss' => $status,
                                        'email_add'=>$email_add,
                                        'entity_cd'=>$entity_cd,
                                        'project_no'=>$project_no,
                                        'submit_date'=>$submit_date
                                        );
                                    $psn='';
                                    // var_dump($data);
                                        $insert = $this->m_wsbangun->insertData_cons('ifca3','cf_registration_agent_dt',$data);
                                        // $insert == 'OK';
                                        if ($insert == 'OK'){
                                                $msg="Data has been saved successfully";
                                                $psn = "OK";
                                            
                                        }else{
                                            $msg= $insert;
                                            $psn = "Failed";
                                        }

                                        $cntgroup_cd = strlen($group_cd);
                                        $sqls = "SELECT max(agent_cd)";
                                        $sqls .= " AS agent_code";
                                        $sqls .= " FROM mgr.cf_agent_dt";
                                        $sqls .= " WHERE entity_cd = '$entity_cd' and";
                                        $sqls .= "      group_cd = '$group_cd' and";
                                        $sqls .= "      substring(agent_cd,1,$cntgroup_cd)='$group_cd'  ;";

                                    $cntAgent = $this->m_wsbangun->getData_by_querypb_cons($db_profile, $sqls);
                                    $dtAgent = $cntAgent[0]->agent_code;

                                    if (empty($dtAgent)) {
                                        $dtAgent=0;

                                    }
                                    else{
                                        $dtAgent= substr($dtAgent,-3,3);
                                    }

                                    $dtAgents = $dtAgent+1;
                                    // var_dump($dtAgent);
                                    $dtAgent_ = $dtAgents+1000;
                                    // var_dump($dtAgent_);
                                    $dt_agent = $group_cd.substr($dtAgent_, 1, 3);
                                    // var_dump($dt_agent);

                                    $datas = array(      
                                        'group_cd' => $group_cd,
                                        'audit_user'=>$audit_user,
                                        'audit_date'=>$audit_date,
                                        'status' => $status,
                                        'email_add'=>$email_add,
                                        'ENTITY_CD' => $entity_cd,
                                        'agent_cd' => $dt_agent,
                                        'agent_name' => $full_name,
                                        'agent_type_cd' => $agent_type,
                                        'handphone1'=>$handphone1,
                                        'id_no'=>$nik,
                                        'transfer_name'=>$transfer_name,
                                        'transfer_acct_no'=>$transfer_acc,
                                        'transfer_bank_name'=>$transfer_bank,
                                        'npwp'=>$npwp,
                                        'home_address'=>$home_add,
                                        'city'=>$city,
                                        'province'=>$province,
                                        'post_cd'=>$post_cd,
                                        'handphone2'=>$handphone,
                                        'status_approval'=>$status_app,
                                        'principal_flag'=>$principal_flag,
                                        'resign_status'=>$resignstat
                                        );
                                // }

                                $insert2 = $this->m_wsbangun->insertData_cons($db_profile,'cf_agent_dt',$datas);
                                if ($insert2 == 'OK') {
                                    $msg="Data has been saved successfully";
                                            $psn = "OK";
                                }else{
                                    $msg= $insert2;
                                    $psn = "Failed";
                                }  
                            }
                       
                } //-----------tutup post
                else{
                    $msg="Data validation is not valid";
                }
                
                $msg1=array("Pesan"=>$msg,
                    "status"=>$psn);
                
            echo json_encode($msg1);
        }

        public function getHisByID($rowID=''){
            $where=array('rowID'=>$rowID);
            $data = $this->m_wsbangun->getData_by_criteria_adm('v_cf_his_agent_regist',$where);

            // var_dump($RowID);exit();
            echo json_encode($data);
        }

        public function updateHis(){
            $msg="";
            if ($_POST){
                $email_add = $this->input->post('txtEmail');

                $full_name =$this->input->post('TxtfullName');
                $nik = $this->input->post('TxtnomorIdk');                
                $handphone1 = $this->input->post('TxthandPhone');
                $psn='';
                $dataupdate = array(
                    'full_name' => $full_name,
                    'nik' => $nik,
                    'handphone1' =>$handphone1 
                );
                
                $where = array(
                    'email_add' => $email_add 
                );

                $updatedata = $this->m_wsbangun->updateDataadm('cf_his_registration_agent', $dataupdate,$where);

                if ($updatedata == 'OK') {

                    $statusact = $this->input->post('hidden_btn');

                    $dataupdate2 = array('Status' =>$statusact);

                    $where2 = array('email' => $email_add );

                    $updatedata2 = $this->m_wsbangun->updateDataadm('Sysuser', $dataupdate2, $where2);

                    // var_dump($updatedata2); exit();
                    $psn='';

                    if ($updatedata2 == 'OK') {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    }else{
                        $msg= $updatedata2;
                        $psn = "Failed";
                    }
                }else{
                    $msg= $updatedata;
                    $psn = "Failed";
                }
            }
             $msg1=array(
                "Pesan"=>$msg,
                "status"=>$psn
            );
            echo json_encode($msg1);
        }

        public function viewaHis($email_add=''){
            var_dump($email_add);
            $sql1 = "select * from mgr.v_history_agent where email_add='$email_add' ";
            $dataProject = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql1);
            $listProject = "";

             if(!empty($dataProject)) {
                foreach ($dataProject as $project) {                 
                    $sql2 = "select group_name from mgr.cf_agent_hd where entity_cd='".$project->entity_cd."' and group_cd='".$project->group_cd."'";
                    $dataAgent = $this->m_wsbangun->getData_by_query_cons($project->db_profile,$sql2);
                    $listProject.= '<tr>';
                    $listProject.='<td>'.date("l, d-m-Y H:i:s",strtotime($project->registration_date)).'</td>';
                    $listProject.='<td>'.$project->descs.'</td>';
                    $listProject.='<td>'.$dataAgent[0]->group_name.'</td>';
                    $listProject.='<td>'.date("l, d-m-Y H:i:s",strtotime($project->submit_date)).'</td>';
                    $listProject.='</tr>';
                }
            }else{
                $listProject.= '<tr>';
                $listProject.='<td colspan="4" align="center">No Data Available</td>';
                $listProject.='</tr>';

            }

            $data = array(
                // 'descs' => $dataProject,
                // 'agent' => $dataAgent,
                'project' => $listProject
            );
            $this->load->view('submit_agent/viewHistory', $data);
        }
    // End History Registration agent

    public function deleteguest(){
        $msg="";
        $psn="";

        $email_add = $this->input->post("email_add",true);
        if(empty($email_add)){
            $email_add=0;
        }
        $where=array('email_add'=>$email_add);
        $data = $this->m_wsbangun->deletedataweb('cf_registration_agent',$where);
        $data2 = $this->m_wsbangun->deletedataweb('cf_project_agent',$where);
        $data3 = $this->m_wsbangun->deletedataweb('cf_registration_agent_dt',$where);
        
        if($data == 'OK')
        {
            if ($data2 == 'OK') 
            {
                if ($data3 == 'OK') {
                    $msg = "Data has been deleted successfully";
                    $psn = "OK";
                }else{
                    $msg = $data3;
                    $psn = "Failed";
                }
            }else{
                $msg = $data2;
                $psn = "Failed";
            }
            
        } else {
            $msg = $data;
            $psn = "Failed";
        }
        $msg1=array("Pesan"=>$msg,
            "status"=>$psn);
        echo json_encode($msg1);
    }

    public function viewagent($email_add=''){
        $sql1 = "select * from mgr.v_registration_agent where email_add='$email_add' ";
        $dataProject = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql1);
        $listProject = "";


         if(!empty($dataProject)) {
                    foreach ($dataProject as $project) {
                                          
                        $sql2 = "select group_name from mgr.cf_agent_hd where entity_cd='".$project->entity_cd."' and group_cd='".$project->group_cd."'";
                         $dataAgent = $this->m_wsbangun->getData_by_query_cons($project->db_profile,$sql2);
                        $listProject.= '<tr>';
                        $listProject.='<td>'.date("l, d-m-Y H:i:s",strtotime($project->registration_date)).'</td>';
                        $listProject.='<td>'.$project->descs.'</td>';
                        $listProject.='<td>'.$dataAgent[0]->group_name.'</td>';
                        $listProject.='<td>'.date("l, d-m-Y H:i:s",strtotime($project->submit_date)).'</td>';
                        $listProject.='</tr>';
                    }
                }else{
                    $listProject.= '<tr>';
                    $listProject.='<td colspan="4" align="center">No Data Available</td>';
                    $listProject.='</tr>';

                }

        $data = array(
                // 'descs' => $dataProject,
                // 'agent' => $dataAgent,
                'project' => $listProject
                );

        // var_dump($data);exit();
        $this->load->view('submit_agent/vieew', $data);
    }

    public function editagent($rowID=''){
        $sql2 = "select * from mgr.v_cf_agent_regist where rowID='$rowID'";
        $dataAgent = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql2);

        // $sql3 = "select * from mgr.Sysuser where Status ";

            $data = array(
                'agent' => $dataAgent,
                'rowID' => $rowID
                );

        // var_dump($data);exit();
        $this->load->view('submit_agent/edit', $data);
    }

    public function getByID($rowID=''){

        $where=array('rowID'=>$rowID);
        $data = $this->m_wsbangun->getData_by_criteria_adm('v_cf_agent_regist',$where);

        // var_dump($RowID);exit();
        echo json_encode($data);
    }

    public function zoom_project_from(){
        $db_profile = $this->input->post('dbprofile',TRUE);
        // var_dump($db_profile);
        $sql1 = "select distinct entity_cd, group_cd, group_name from mgr.cf_agent_hd";
        $dataAgent = $this->m_wsbangun->getData_by_querypb_cons($db_profile, $sql1);


        // var_dump($entityName);
            if(!empty($dataAgent)) {
                $comboAgent[] = '<option></option>';
                foreach ($dataAgent as $dtAgent) {
                    $comboAgent[] = '<option value="'.$dtAgent->group_cd.'">'.$dtAgent->group_name.'</option>';
                }
                $comboAgent = implode("", $comboAgent);
            }
            echo $comboAgent;
    }

    public function update_agent(){
            
            $msg="";
            if ($_POST)
            {
                $email_add = $this->input->post('txtEmail');

                $full_name =$this->input->post('TxtfullName');
                $nik = $this->input->post('TxtnomorIdk');                
                $handphone1 = $this->input->post('TxthandPhone');
                $psn='';
                $dataupdate = array(
                                'full_name' => $full_name,
                                'nik' => $nik,
                                'handphone1' =>$handphone1 
                            );
                
                $where = array(
                                'email_add' => $email_add 
                            );

                $updatedata = $this->m_wsbangun->updateDataadm('cf_registration_agent', $dataupdate,$where);

                    if ($updatedata == 'OK') {

                                    $statusact = $this->input->post('hidden_btn');

                                    $dataupdate2 = array('Status' =>$statusact);

                                    $where2 = array('email' => $email_add );

                                    $updatedata2 = $this->m_wsbangun->updateDataadm('Sysuser', $dataupdate2, $where2);

                                    // var_dump($updatedata2); exit();
                                    $psn='';

                                    if ($updatedata2 == 'OK') {
                                        $msg="Data has been updated successfully";
                                        $psn = "OK";
                                    }else{
                                        $msg= $updatedata2;
                                        $psn = "Failed";
                                    }
                        }else{
                            $msg= $updatedata;
                            $psn = "Failed";
                        }

            }

             $msg1=array("Pesan"=>$msg,
                        "status"=>$psn);
            
                echo json_encode($msg1);
    }
}
?>