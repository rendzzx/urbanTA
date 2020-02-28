<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Commission_Sales extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

        $tableAgentHd  = 'cf_agent_hd';
        $where = array('rowID' > 0);
        $group = $this->m_wsbangun->getData_by_criteria_cons($cons, $tableAgentHd, $where);

        $tableAgentHd  = 'cf_agent_dt';
        $where = array('rowID' > 0);
        $agent = $this->m_wsbangun->getData_by_criteria_cons($cons, $tableAgentHd, $where);

        $content = array(
            'group' => $group,
            'agent' => $agent
        );

        $this->load_content_top_menu('commission_sales/index', $content);
    }

    public function getByIdAgent($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'cf_agent_dt';

        $where = array(
            'rowID' > 0
        );
        if ($id != 'all') {
            $where = array('group_cd' => $id);
        }

        $agent = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        $combo[] = '<option value=""></option>';
        $combo[] = '<option value="all" selected>All</option>';
        foreach ($agent as $key) {
            $combo[] = '<option value="'.$key->agent_cd.'">'.$key->agent_name.'</option>';
        }
        $combo = implode("", $combo);
        echo json_encode($combo);
    }

    public function gettablecomm()
    {
        $project = $this->session->userdata('Tsproject');    
        $entity     = $this->session->userdata('Tsentity');          
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        $agentCd = $this->input->post("agentCd",true);
        $groupCd = $this->input->post("groupCd",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        
        $aColumns  = array('comm_doc_no','trx_date','lot_no','name','sell_price','comm_percen','comm_amount_dtl','status','cb_doc_no');

        $sTable = "mgr.v_sales_commission";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        $SordField = ($sortIdColumn==0? 'trx_date' :$Column[$sortIdColumn]['name']);

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

        $whereGroupCd = "";
        if (!empty($groupCd)) {
            if ($groupCd != 'all') {
                $whereGroupCd = "AND agent_group_cd='".$groupCd."'";
            }
        }

        $whereAgentCd = "";
        if (!empty($agentCd)) {
            if ($agentCd != 'all') {
                $whereAgentCd = "AND agent_cd='".$agentCd."'";
            }
        }

        $param = " where entity_cd='$entity' and project_no='$project' $whereGroupCd $whereAgentCd".$filter_search;
        // var_dump($param);exit();
        $rResult = $this->m_wsbangun->getlisttable_int_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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
}