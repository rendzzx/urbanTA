<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class c_termcondition extends Core_Controller{
    public function __construct(){
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
    }

    public function index(){
        $projectName = $this->session->userdata('Tsprojectname');

        $data = array(
            'ProjectDescs' => $projectName
        );
        $this->load_content_top_menu('termcondition/index', $data);
    }

    public function getTable(){
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);

        $aColumns  = array('row_number','file_attachment', 'file_url', 'audit_user', 'audit_date', 'rowID');
        $sTable = 'mgr.cf_termcondition_principle';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);
        $param='';
        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     
            $param =" Where  ".$filter_search;
        }
        // var_dump($filter_search);
        // $param =" Where status='1' ".$filter_search;

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

    public function getByID($id){
        $where = array(
            'rowID' => $id
        );
        $data = $this->m_wsbangun->getData_by_criteria_adm('cf_termcondition_principle',$where);

        echo json_encode($data);
    }

    public function addnew(){
        $this->load->view('termcondition/add');
    }
}