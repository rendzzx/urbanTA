<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_nup_parameter extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
        // var_dump($cons);
        $table = 'rl_nup_parameter';
        $DataNup = $this->m_wsbangun->getData_cons($cons,$table);
        
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'ProjectDescs'=>$projectName,
            'project'=>$DataNup);
        
    	$this->load_content_top_menu('nup_parameter/index',$content);
    }

    public function zoom_entity_from(){
        $ent = $this->input->post('ent',TRUE);
        $table = 'cf_entity';
        $entityName = $this->m_wsbangun->getData($table);
        if(!empty($entityName)){
            // $raw[]='';
            foreach ($entityName as $dtEntity) {
                $raw[]= array('id'=>$dtEntity->entity_cd, 'text'=>$dtEntity->entity_name);
                
            }
            echo json_encode($raw);

            // echo json_encode(array("status" => TRUE));
        }
    }

    public function _zoom_entity_from(){
        $ent = $this->input->post('ent',TRUE);
        // var_dump($ent);
        $table = 'cf_entity';
        $entityName = $this->m_wsbangun->getData($table);
        // var_dump($entityName);
            if(!empty($entityName)) {
                $comboEntity[] = '<option></option>';
                foreach ($entityName as $dtEntity) {
                  if($ent === $dtEntity->entity_cd) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtEntity->entity_cd.'">'.$dtEntity->entity_name.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            echo $comboEntity;
      }

      public function zoom_project_from(){
        $pro = $this->input->post('pro',TRUE);
        // var_dump($nup_id);
        $table = 'pl_project';
        $proDescs = $this->m_wsbangun->getData($table);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($pro === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            echo $comboProject;
      }

      public function zoom_phase_from(){
        $pha = $this->input->post('pha',TRUE);
        // var_dump($pha);
        $table = 'rl_phase';
        $phaseDescs = $this->m_wsbangun->getData($table);
        // var_dump($entityName);
            if(!empty($phaseDescs)) {
                $comboPhase[] = '<option></option>';
                foreach ($phaseDescs as $dtPhase) {
                  if($pha === $dtPhase->phase_cd) {
                    // $pilih = ' selected = "1"';
                    $pilih = 'selected';
                  } else {
                    $pilih = '';
                  }
                    $comboPhase[] = '<option value="'.$dtPhase->phase_cd.'" '.$pilih.' >'.$dtPhase->descs.'</option>';
                }
                $comboPhase = implode("", $comboPhase);
            }
            echo $comboPhase;
      }

      

   /* public function addnew($project_no=''){
        // $content = array('error'=>'');
        $data=array('project_no'=>$project_no);
        $this->load->view('nup/add',$data);
    }*/

    public function test(){
        $this->load_content('nup_parameter/test');
    }
    public function addtes(){
        $this->load->view('nup_parameter/addtes');
    }

    public function addnew(){
        $cons = $this->session->userdata('Tscons');
        $tblEntity = 'cf_entity';
        $EntityData = $this->m_wsbangun->getData_cons($cons,$tblEntity);
       
        $content = array('entityData'=>$EntityData);


        $this->load->view('nup_parameter/add', $content);

    }

    public function zoom_project(){
        // $data_id = $this->m_newsfeed->get_table_by_id("mgr.pl_project");
        // return $data_id;

        if($_POST)
        {
            $entity = $this->input->post('ent', TRUE);
            
            if(empty($entity)) {
                echo('<option></option>');
            } else {
                $table = 'pl_project';
                $kriteria = array('entity_cd'=>$entity);

                $ProjectData = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option></option>';
                    foreach ($ProjectData as $project) {
                        // $kriteria = array('entity_cd'=>$entity,
                        //     'project_no'=>$project,
                        //     'lot_no'=>$project->lot_no);                        

                        $listProject.='<option value="'.$project->project_no.'">'.$project->descs.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }


    public function zoom_phase(){
        // $data_id = $this->m_newsfeed->get_table_by_id("mgr.pl_project");
        // return $data_id;

        if($_POST)
        {
            $project_no = $this->input->post('projectNo', TRUE);
            
            if(empty($project_no)) {
                echo('<option></option>');
            } else {
                $table = 'rl_phase';
                $kriteria = array('project_no'=>$project_no);

                $ProjectData = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option></option>';
                    foreach ($ProjectData as $project) {
                        // $kriteria = array('entity_cd'=>$entity,
                        //     'project_no'=>$project,
                        //     'lot_no'=>$project->lot_no);                        

                        $listProject.='<option value="'.$project->phase_cd.'">'.$project->descs.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }

    public function getByID($nup_id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('nup_id'=>$nup_id);
        $data = $this->m_wsbangun->getData_by_criteria('rl_nup_parameter',$where);

        echo json_encode($data);

    }
    public function Delete(){
        $msg="";
        $psn="";
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('id'=>$id);
        $data = $this->m_wsbangun->deletedata('newsfeed',$where);
        if($data == 'OK')
        {
            $msg = "Data has been deleted successfully";
            $psn = "OK";
        } else {
            $msg= $data;
            $psn = "Failed";
        }
        $msg1=array("Pesan"=>$msg,
            "status"=>$psn);
        echo json_encode($msg1);
        

    }
    public function getTable()
    {
        // $aProject = $this->input->post("pl_project",true);
        // if(empty($aProject)){
        //     $aProject='';
        // }
        // var_dump($aProject);
        
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
        $aColumns  = array('row_number', 'nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_rl_nup_parameter';

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
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'nup_id' :$Column[$sortIdColumn]['name']);

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
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);

       

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
     public function edit_newsfeed($newsfeed_id = "", $data=null)
    {
        // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
        // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);
        // if ($pri->can_edit == '1') {

            $newsfeeds = $this->m_newsfeed->get_by_id($newsfeed_id);
            $list_newsfeeds = '';
            // foreach ($newsfeeds as $newsfeed) {
            //     $list_newsfeeds .= '<option value="'
            //     1">Information</option>
            //             <option value="2">Warning</option>
            // }
            $statusnya = array('','Information','Warning');
            for($i=1;$i<=2;$i++){
                if($i==$newsfeeds->status){
                    $list_newsfeeds .= '<option selected="selected" value="'.$newsfeeds->status. '">'.$statusnya[$newsfeeds->status]. '</option>'."\n";
                } else {
                    $list_newsfeeds .= '<option value="'.$newsfeeds->status. '">'.$statusnya[$i]. '</option>'."\n";
                }
                
            }
            
            $content = array(
                'newsfeeds' => $newsfeeds,
                'list_newsfeeds'=>$list_newsfeeds,
                'error' => $data
            );
            $this->load_content('c_newsfeed/edit', $content);

        // } else {
            // $content['url'] = base_url() . "newsfeed";
            // $this->load_content('error', $content);
        // }

    //     } else {
    //         $content['url'] = base_url() . "newsfeed";
    //         $this->load_content('error', $content);
    //     }

    }
    public function new_newsfeed($data=null)
    {
        $content = array(
                'error' => $data
            );

       // $this->load_content('newsfeed/add',$content);
        $this->load->view('newsfeed/add',$content);
        // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
        // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);

        // if ($pri->can_add == '1')
            
        // else {
        //     $content['url'] = base_url() . "newsfeed";
        //     $this->load_content('error', $content);
        // }
    }
    public function save_nup(){
        
            $msg="";
            if ($_POST) 
            {
                $nup_id = $this->input->post('txtNupId', true);
                // var_dump($nup_id);
                $entity_cd = $this->input->post('TxtentityCode',TRUE);
                $project_no =$this->input->post('TxtprojectNo',TRUE);
                $phase_cd = $this->input->post('TxtphaseCode',TRUE);                
                $startDateVar = $this->input->post('TxtstartEndDate',TRUE);
                $newStartDate = new DateTime(substr($startDateVar, 0, 10));
                // $startDate = date('Y-m-d', substr($startDateVar, 0, 10));
                $startDate = $newStartDate->format('d-m-y');
                $newEndDate = new DateTime(substr($startDateVar, -10));
                // $EndDate = date('Y-m-d', substr($startDateVar, 14, 23));
                $EndDate = $newEndDate->format('d-m-y');
                // var_dump($EndDate);
                $status = intval($this->input->post('status',TRUE));                                
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');
                // $unitStatus = intval($this->input->post('txtUnitStatus', TRUE));
                $unitStatus = $this->input->post('txtUnitStatus', TRUE);
                $cancelNUP = $this->input->post('txtCancelNUP', TRUE);
                
                // $revision = intval($this->input->post('txtRevision', TRUE));
                // $revision = $this->input->post('txtRevision', TRUE);
                $revision = 1;
                // var_dump($unitStatus);

                
                if (!isset($unitStatus) or empty($unitStatus)){
                  $unitStatus = 0;  
                } else {
                  $unitStatus = 1;
                }

                if (!isset($cancelNUP) or empty($cancelNUP)){
                  $cancelNUP = 0;  
                } else {
                  $cancelNUP = 1;
                }


                // if (!isset($revision) or empty($revision)){
                //   $revision = 0;  
                // } else {
                //   $revision = 1;
                // }
                
                        $data = array(          
                        // 'nup_id' => $nup_id,
                        'entity_cd' => $entity_cd,
                        'project_no' => $project_no,
                        'phase_cd' =>$phase_cd,
                        'start_date' =>$startDate,                        
                        'end_date'=>$EndDate,
                        'status'=>$status,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date,
                        'choose_unit_status'=>$unitStatus,
                        'revision'=>$revision,
                        'cancel_nup'=>$cancelNUP
                        );
                    $psn='';
                    $criteria = array('nup_id' => $nup_id);
                    // var_dump($criteria);
                    if($nup_id>0) {
                        $update = $this->m_wsbangun->updateData('rl_nup_parameter',$data, $criteria);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                        
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("ADD newsfeed")));
                    } else {
                        $insert = $this->m_wsbangun->insertData('rl_nup_parameter',$data);
                        if ($insert == 'OK')
                        {
                            $msg="Data has been saved successfully";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                        
                        
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("EDIT newsfeed")));
                    }

                    // redirect("c_newsfeed");
                // } // tutup if validation
            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                "status"=>$psn);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
    public function csv()
    {
        

       // $this->load_content('newsfeed/add',$content);
        $this->load->view('nup_parameter/csv');
        // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
        // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);

        // if ($pri->can_add == '1')
            
        // else {
        //     $content['url'] = base_url() . "newsfeed";
        //     $this->load_content('error', $content);
        // }
    }
}