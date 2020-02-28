<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_detail_survey extends Core_Controller
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
        $cons = $this->session->userdata('Tscons');
        // $DataMenu = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);

        $content = array(
            'ProjectDescs'=>$projectName);

        $this->load_content_top_menu('detail_survey/index',$content);
    }

    public function add(){

        $table = 'v_pm_survey_question';
        $where = array('survey_id' => 0 );
        $cons = $this->session->userdata('Tscons');
        $MenuData = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);

        $content = array('menuData'=>$MenuData);

        $this->load->view('detail_survey/edit');

    }

    public function getByID($survey_id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('survey_id'=>$survey_id);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3','v_pm_survey_question',$where);

        echo json_encode($data);

    }
    public function deletedtlbyID(){
        // $line_no = $this->input->post('line_no');
        $survey_id = $this->input->post('survey_id');
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        $project = $this->session->userdata('Tsproject');
        $where=array('survey_id'=>$survey_id,'entity_cd'=>$entity,'project_no'=>$project);
        $data = $this->m_wsbangun->deletedata_cons('ifca3','pm_survey_dtl',$where);

        echo $data;

    }
    public function getsurveyid(){
        $sql = "SELECT max(survey_id) as cnt from mgr.pm_survey";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

        echo json_encode((int)$data[0]->cnt);

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
            $cons = $this->session->userdata('Tscons');
            $survey_id = $this->input->post('survey_id');
            $form = $this->input->post('form');
            // $line_no = $this->input->post('line_no');
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
            $subject = $this->input->post('txtsubject',true);
            $content = $this->input->post('txtquestion',TRUE);
            $options =$this->input->post('txtopt_value',TRUE);
            $remark = $this->input->post('remark',TRUE);
            $remark_val = $this->input->post('remark_val',TRUE);
            $batas = $this->input->post('batas',TRUE);
            // var_dump(COUNT($options));exit();
            // var_dump($batas);
            // var_dump($options);
            // var_dump($remark_val);exit();
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            $batasLoop=COUNT($options);



            // var_dump($form);exit();
            $datahdr = array(

                'entity_cd' => $entity,
                'project_no' => $project,
                'survey_id' => $survey_id,
                'subject'=>$subject,
                'content'=>$content,
                'publishdate'=>'',
                'expireddate'=>'',
                'date_created'=>$audit_date,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
            );
            $datahdr_up = array(


                'subject'=>$subject,
                'content'=>$content,
                'publishdate'=>'',
                'expireddate'=>'',
                'date_created'=>$audit_date,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
            );
            $criteria = array('survey_id' => $survey_id);
            // var_dump($survey_id); 
            $cekEd = "SELECT COUNT(*) as cnt FROM mgr.pm_publishsurvey WHERE survey_id='$survey_id'";
            $cons = $this->session->userdata('Tscons');
            $execEd = $this->m_wsbangun->getData_by_query_cons('ifca3',$cekEd);
            // var_dump($execEd[0]->cnt); exit;
                if ($execEd[0]->cnt > 0) {
                    $msg= 'Data Cannot Edit Because It Has Been Published';
                    $psn = 'Fail';
                    $ha = 'Forbiden';
                } else {
            // var_dump($survey_id);exit();
            if($form!='add') {
                $update = $this->m_wsbangun->updateData_cons('ifca3','pm_survey',$datahdr_up, $criteria);
                // var_dump($data);exit();
                if($update !="OK"){
                    $msg= $data;
                    $st = 'Fail';
                    $ha = 'update pm_survey fail';
                }else{
                    $msg="Data has been updated successfully";
                    $st = 'OK';
                    $line_no = $this->input->post('line_no',TRUE);
                    $line = 0;

                    // $sql = "select count(*) as cnt from mgr.pm_survey_dtl where entity_cd='$entity' and project_no ='$project' and survey_id = '$survey_id' and line_no='$i'";
                    // $countdtl = $this->m_wsbangun->getData_by_query($sql);
                    // if($countdtl[0]->cnt > 0){
                    //uodate detail
                    $criteria2 = array('survey_id' => $survey_id);
                    // $savedata_up = array(
                    //     'options'=>$options[$i-1],
                    //     'flag'=>$remark_val[$i-1],
                    //     'audit_user'=>$audit_user,
                    //     'audit_date'=>$audit_date
                    // );
                    $data2 = $this->m_wsbangun->deletedata_cons('ifca3','pm_survey_dtl', $criteria2);
                    if($data2 !="OK"){
                        $msg= $data2;
                        $psn = 'Fail';
                        $ha = 'update header update pm_survey_dtl fail';
                    }else{
                        for($i=0; $i < $batasLoop; $i++){
                          $datadtl=array(
                        

                        'entity_cd' => $entity,
                        'project_no' => $project,
                        'survey_id'=>$survey_id,
                        'line_no'=>$i+1,
                        'options'=>$options[$i],
                        'flag'=>$remark_val[$i],
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                    );
                    $data = $this->m_wsbangun->insertData_cons('ifca3','pm_survey_dtl',$datadtl);
                    }
                    if($data !="OK"){
                        $msg= $data;
                        $psn = 'Fail';
                        $ha = 'update header  pm_survey_dtl fail';
                    }else{
                        $msg="Data has been Update successfully";
                        $psn = 'OK';
                        $ha = 'update header  pm_survey_dtl success';
                    }

                } //end else

            }
            } //end if update header
         else { //if count header (if insert)
            $inserthdr = $this->m_wsbangun->insertData_cons('ifca3','pm_survey',$datahdr);
            if($inserthdr !="OK"){
                $msg= $inserthdr;
                $psn = 'Fail';
                $ha = 'insert header fail';
            }else{
                $msg="Data has been saved successfully";
                $psn = 'OK';
                $line = 0;
                for ($i=0; $i < $batasLoop; $i++) {


                    $datadtl= array(

                        'entity_cd' => $entity,
                        'project_no' => $project,
                        'survey_id'=>$survey_id,
                        'line_no'=>$i,
                        'options'=>$options[$i],
                        'flag'=>$remark_val[$i],
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                    );
                    $data = $this->m_wsbangun->insertData_cons('ifca3','pm_survey_dtl',$datadtl);
                    if($data !="OK"){
                        $msg= $data;
                        $psn = 'Fail';
                        $ha = 'insert header insert pm_survey_dtl fail';
                    }else{
                        $msg="Data has been saved successfully";
                        $psn = 'OK';
                        $ha = 'insert header insert pm_survey_dtl success';

                    }


                }//end looping detail


            }


        } //END ELSE INSERT
    
    }

        $msg1= array('pesan'=>$msg,
            'status'=>$psn,
            'ha'=>$ha);

        echo json_encode($msg1);

    }

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
    // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
    $aColumns  = array('subject', 'content', 'options','date_created');
    // $DataField = "subject, content,options=mgr.fn_ver_surveydt(entity_cd,project_no,survey_id),date_created";
    // $aColumns = array('entity_cd', 'entity_name');
    $sTable = 'mgr.v_survey_detail';

    $iDisplayStart = (int)$this->input->get_post('start', true);
    $iDisplayLength = (int)$this->input->get_post('length', true);
    $order = $this->input->get_post('order', true);
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
    $SordField = ($sortIdColumn==0? 'date_created' :$Column[$sortIdColumn]['name']);

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
    $param = " where survey_id > 0 ".$filter_search;
    
    // var_dump($param);
    $rResult = $this->m_wsbangun->getlisttableSurvey_cons('ifca3',$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
    // var_dump($rResult);exit();
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

    public function Delete(){
        $survey_id = $this->input->post("survey_id",true);
        $cekDel = "SELECT COUNT(*) as cnt FROM mgr.pm_publishsurvey WHERE survey_id='$survey_id'";
        $cons = $this->session->userdata('Tscons');
        $execDel = $this->m_wsbangun->getData_by_query_cons('ifca3',$cekDel);

        if ($execDel[0]->cnt >0) {
            $msg = "Data can't be deleted because it has been published!";
            // $psn = 'fail';
        } else {

            if(empty($survey_id)){
                $survey_id=0;
            }
            $where=array('survey_id'=>$survey_id);
            $data = $this->m_wsbangun->deletedataweb('pm_survey',$where);
            $data2 = $this->m_wsbangun->deletedataweb('pm_survey_dtl',$where);
            $msg = "Data has been deleted successfully";

        }
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
}