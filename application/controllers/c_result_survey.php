<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_result_survey extends Core_Controller
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
        $group = $this->session->userdata('Tsusergroup');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        // $table = 'v_logindebtor';
        // $crit = array('debtor_acct'=>$name);
        // $cons = $this->session->userdata('Tscons');
        // $DataMenu = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // var_dump($group);
        if ($group != "ADMINWEB") {
            $btnR = 'true';
        } else {
            $btnR = 'false';
        }

        // $btnR = 'true' ;
        // var_dump($btnR);
        $content = array(
            'ProjectDescs'=>$projectName,
            'Rbtn'=>$btnR);

        $this->load_content_top_menu('result_survey/index',$content);
    }

    public function getPublishId(){
        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT MAX(publish_id) as cnt from mgr.pm_publishsurvey";
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        echo json_encode((int)$data[0]->cnt);

    }

    public function Result($publish=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT * FROM mgr.v_pm_survey_result where publish_id ='".$publish."' ORDER BY publish_id ASC" ;
        $result1 = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

        $sqlCnt = "SELECT COUNT(*) as count from mgr.ar_debtor where entity_cd = '".$entity."' AND Project_no = '".$project."'";
        $sql2 = $this->m_wsbangun->getData_by_query_cons($cons,$sqlCnt);

         $sqlLine = "SELECT (SELECT COUNT(DISTINCT user_id) FROM mgr.pm_surveyrespon i WHERE i.publish_id = j.publish_id) AS cnt
                            FROM mgr.pm_publishsurvey j
                            where publish_id = '".$publish."'" ;
        $result3 = $this->m_wsbangun->getData_by_query_cons('ifca3',$sqlLine);

        // foreach ($result3 as $key ) {
        // $sqlCnt = "SELECT COUNT(DISTINCT [user_id]) cnt FROM mgr.pm_surveyrespon";
        // $result2 = $this->m_wsbangun->getData_by_query($sqlCnt);
        // }
        // var_dump($result2);exit();
        $result2;
        if ($sql2[0]->count>0) {
            $result2 = $sql2[0]->count ;
        }
        else{
            $result2 = 1;
        }
        // var_dump($result2);exit();
        $content = array(
                         'dtsurvey'=>$result1,
                         'CountD'=>$result2,
                         'Responden'=>$result3
                     );
        // var_dump($content);exit();
        $this->load->view('result_survey/result',$content);

    }

        public function getByID($publish_id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('publish_id'=>$publish_id);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_criteria_cons('pm_publishsurvey',$cons,$where);

        echo json_encode($data);

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
        // $aColumns = array('row_number','debtor_name','doc_date','due_date','doc_no','decs');
        $aColumns  = array('row_number','title', 'sub', 'publishdate','expireddate');
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
        $param = " where 1=1".$filter_search;
        
        // var_dump($param);exit();
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

      
}