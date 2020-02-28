<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_publish_survey extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        // $table = 'v_logindebtor';
        // $crit = array('debtor_acct'=>$name);
        // $cons = $this->session->userdata('Tscons');
        // $DataMenu = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        if ($name != "ADMIN") {
            $btnR = 'false';
        } else {
            $btnR = 'true';
        }

        $content = array(
            'ProjectDescs'=>$projectName,
            'Rbtn'=>$btnR);

        $this->load_content_top_menu('publish_survey/index',$content);
    }

        public function getPublishId(){
        $sql = "SELECT MAX(publish_id) as cnt from mgr.pm_publishsurvey";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

        echo json_encode((int)$data[0]->cnt);

    }

        public function add(){

        $table = 'v_pm_publish_survey';
        $where = array('publish_id' => 0 );
        $cons = $this->session->userdata('Tscons');
        $MenuData = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);

        $content = array('ddsubject'=>$this->zoom_subject());

        $this->load->view('publish_survey/add',$content);

    }

     public function Result($publish=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $sql = "SELECT * FROM mgr.v_pm_survey_result where publish_id ='".$publish."' ORDER BY publish_id ASC" ;
        $cons = $this->session->userdata('Tscons');
        $result1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $cons = $this->session->userdata('Tscons');
        $sqlCnt = "SELECT COUNT(*) as count from mgr.SecurityUserDebtor where entity_cd = '".$entity."' AND Project_no = '".$project."'";
        $result2 = $this->m_wsbangun->getData_by_query_cons($cons,$sqlCnt);

         $sqlLine = "SELECT (SELECT COUNT(DISTINCT user_id) FROM mgr.pm_surveyrespon i WHERE i.publish_id = j.publish_id) AS cnt
                            FROM mgr.pm_publishsurvey j
                            where publish_id = '".$publish."'" ;
        $cons = $this->session->userdata('Tscons');
        $result3 = $this->m_wsbangun->getData_by_query_cons($cons,$sqlLine);

        // foreach ($result3 as $key ) {
        // $sqlCnt = "SELECT COUNT(DISTINCT [user_id]) cnt FROM mgr.pm_surveyrespon";
        // $result2 = $this->m_wsbangun->getData_by_query($sqlCnt);
        // }
        // var_dump($result3);exit();
        $content = array(
                         'dtsurvey'=>$result1,
                         'CountD'=>$result2,
                         'Responden'=>$result3
                     );
        // var_dump($content);exit();
        $this->load->view('publish_survey/result',$content);

    }

        public function getByID($publish_id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('publish_id'=>$publish_id);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3','pm_publishsurvey',$where);

        echo json_encode($data);

    }

        public function zoom_subject(){
         $table = "SELECT subject,survey_id from mgr.pm_survey (nolock) ";
         $cons = $this->session->userdata('Tscons');
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query_cons('ifca3',$table);
        // var_dump($project);
        $comboProject[]='';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtProject) {

                  // if($project === $dtProject->project_no) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    // $pilih = ' selected = "1"';
                  // } else {
                    $pilih = '';
                  // }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->survey_id.'">'.$dtProject->subject.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return  $comboProject;
    }

  
     public function getTable()
    {
        $project = $this->session->userdata('Tsproject');

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id','subject','content','status');
        $aColumns  = array('title', 'sub', 'publishdate','expireddate');
        $sTable = 'mgr.v_pm_publish_survey2';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
         $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'title' :$Column[$sortIdColumn]['name']);

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
        $param = " where 1=1 ".$filter_search;
        $cons = $this->session->userdata('Tscons');
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable_cons('ifca3',$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);

        $sql="select count(*) as cnt from ".$sTable." ".$param;
        $ts =  $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $a = $ts[0]->cnt;

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

      public function save(){

        $msg="";
        if ($_POST)
        {
            // $sql = "select count(survey_id) as cnt from mgr.pm_survey";
            // $count = $this->m_wsbangun->getData_by_querypb($sql);
            // if(!empty($count)) {
            //     $cnt = $count[0]->cnt;
            //     // var_dump($cnt);exit();
            //     if($cnt>0){$no = $cnt;}
            //     else{$no=1;}
            // }
            $survey_id = $this->input->post('txtsubject');
            $form = $this->input->post('form');
            // $line_no = $this->input->post('line_no');
            $cons = $this->session->userdata('Tscons');
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
            $title = $this->input->post('txttitle');
            $publish_id = $this->input->post('publish_id');
            $publish = $this->input->post('publishDate');
            $expired = $this->input->post('ExpiredDate');
            $batas = $this->input->post('batas');
            $type = $this->input->post('txtoptType');
            // var_dump($survey_id);exit();
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsname');
            // $suid = 'select COUNT(survey_id) from mgr.pm_survey';
            // var_dump($line_no);exit();
            // var_dump($title);exit();


          

            // var_dump($survey_id);exit();
           if ($form == 'add') {
                for ($i=0; $i < $batas ; $i++) { 
                    
                
                 $dataPub = array(

                'entity_cd' => $entity,
                'project_no' => $project,
                'publish_id' => $publish_id,
                'survey_id' => $survey_id[$i],
                'publishdate'=>$publish,
                'expireddate'=>$expired,
                'date_created'=>$audit_date,
                'title' =>$title,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date,
                'line_no'=>$i
            );
                 // var_dump($dataPub);exit();
               $insertPub = $this->m_wsbangun->insertData_cons('ifca3','pm_publishsurvey',$dataPub);
               } // END LOOP
               if ($insertPub !='OK') {
               $msg= $insertPub;
               $psn = 'Fail';
               $ha = 'Insert header insert pm_publishsurvey fail';
               } else {
               $msg="Data has been Insert successfully";
               $psn = 'OK';
               $ha = 'Insert header insert pm_publishsurvey Success';
               } //ELSE INSERT PUBLISH
           }
           else{
                $where=array('publish_id'=>$publish_id);
                $data = $this->m_wsbangun->deletedata_cons('ifca3','pm_publishsurvey',$where);
                if ($data != 'OK') {
                   $msg= $data;
                   $psn = 'Fail';
                   $ha = 'Update One pm_publishsurvey fail';
                } else {
                 for ($i=0; $i < $batas ; $i++) { 
                       $datahdr_up = array(
                            'entity_cd' => $entity,
                            'project_no' => $project,
                            'publish_id' => $publish_id,
                            'survey_id' => $survey_id[$i],
                            'publishdate'=>$publish,
                            'expireddate'=>$expired,
                            'date_created'=>$audit_date,
                            'title' =>$title,
                            'audit_user'=>$audit_user,
                            'audit_date'=>$audit_date,
                            'line_no'=>$i
                        );
                        // $criteria = array('publish_id' => $publish_id);
                        $updatePub = $this->m_wsbangun->insertData_cons('ifca3','pm_publishsurvey',$datahdr_up);
                    } //END LOOPING
                     if ($updatePub !='OK') {
                       $msg= $updatePub;
                       $psn = 'Fail';
                       $ha = 'Update pm_publishsurvey fail';
                       } else {
                       $msg="Data has been Update successfully";
                       $psn = 'OK';
                       $ha = 'Update pm_publishsurvey Success';
                       } //ELSE INSERT PUBLISH

                }//ELSE OK
            
            }//ELSE One


            $msg1= array('pesan'=>$msg,
                'status'=>$psn,
                'ha'=>$ha);

            echo json_encode($msg1);

        }

    }
  
        public function Delete(){
        $publish_id = $this->input->post("publish_id",true);
         $cons = $this->session->userdata('Tscons');
         $cekDel = "SELECT count(*) as cnt from mgr.pm_publishsurvey where publish_id='".$publish_id."' AND DATEADD(dd, 0, DATEDIFF(dd, 0, GETDATE())) between publishdate and expireddate";
        $execDel = $this->m_wsbangun->getData_by_query_cons('ifca3',$cekDel);

        if ($execDel[0]->cnt >0) {
            $msg = "Data Cannot Be Deleted Because It Has Been Published";
            $psn = 'fail';
        } else {
            // $publish_id = $this->input->post("publish_id",true);
        if(empty($publish_id)){
            $publish_id=0;
        }
        $where=array('publish_id'=>$publish_id);
        $dataDel = $this->m_wsbangun->deletedata_cons('ifca3','pm_publishsurvey',$where);
        if ($dataDel != 'OK') {
        $msg = "Data has been deleted Failed";
        $psn = 'fail';
        } else{
        $msg = "Data has been deleted successfully";
        $psn = 'success';
        }
        
        }

        $msg1=array("Pesan"=>$msg,"status"=>$psn);
         echo json_encode($msg1);
    }

}