<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_invoice extends Core_Controller {

    public function __construct(){ 
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
        $this->load->model('m_business');
    }
    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
        // }

        $sql3="select distinct project_no from mgr.v_ar_invoice_lst (NOLOCK)";
        $ProjectData = $this->m_wsbangun->getData_by_query($sql3);

        $sql="select distinct debtor_acct from mgr.v_ar_invoice_lst (NOLOCK) where entity_cd ='".$entity."' and project_no = '".$project."'";
        $DebtorData = $this->m_wsbangun->getData_by_query($sql);
        
        $ContentAllData = array(
                'project_no'=>$project,
                // 'Lead'=>$LeadData,
                // 'Group'=>$GroupData,
                'ProjectDescs'=>$projectName,
                'ProjectData'=>$ProjectData,
                'DebtorData'=>$DebtorData
                 
             );
        if ($group=='MGM'){
            $this->load_content_mgm('invoice/index',$ContentAllData);
        }else{
            $this->load_content_top_menu('invoice/index',$ContentAllData);
        }
        
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
        $aColumns  = array('row_number','debtor_acct', 'project_no', 'doc_no','doc_date','due_date','ar_ldg_desc','currency_cd','alloc_amt');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_ar_invoice_lst';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);


        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $addsort = 'doc_date';
        $SortdOrder =$order[0]['dir'];
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
        // $ent=$this->input->post("entity",true);
        $project_parse = $this->input->post("project",true);
        $debtor_acct = $this->input->post("debtor",true);
        $where = '';

        if ($project_parse!='all')
        {
            $where = $where." AND project_no='".$project_parse."' ";
        } 
        if ($debtor_acct!='all')
        {
            $where = $where." AND debtor_acct='".$debtor_acct."' ";
        }
       
        // Select Data

        $param =" Where entity_cd='".$entity."' ".$where." ".$filter_search;
        // $param =" Where entity_cd='2101' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttableinvoice($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);
      
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
    public function zoom_lead(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // if($_POST)
        // {
            // $ent=$this->input->post('ent',true);
            
            // if(empty($ent)) {
                // echo('<option></option>');
            // } else {
                // if($ent=='all'){
                    $sql="select distinct debtor_acct from mgr.v_ar_invoice_lst (NOLOCK)";
                // } else {
                    // $sql="select distinct lead_cd,lead_name from mgr.v_agent_list (NOLOCK) where entity_cd ='".$ent."'";
                // }
                
                $ProjectData = $this->m_wsbangun->getData_by_query($sql);
                var_dump($ProjectData);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->debtor_acct.'">'.$project->debtor_acct.'</option>';
                    }
                }
                echo($listProject);
            // }
        // }
    }

    public function zoom_group(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        if($_POST)
        {
            $ent=$this->input->post('ent',true);
            
            if(empty($ent)) {
                echo('<option></option>');
            } else {
                if($ent=='all'){
                    $sql="select distinct group_cd,group_name from mgr.v_agent_list (NOLOCK)";
                } else {
                    $sql="select distinct group_cd,group_name from mgr.v_agent_list (NOLOCK) where entity_cd ='".$ent."'";
                }
                
                $ProjectData = $this->m_wsbangun->getData_by_query($sql);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->group_cd.'">'.$project->group_name.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }
    public function zoom_group_from(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        if($_POST)
        {
            $lead=$this->input->post('lead',true);
            $ent=$this->input->post('ent',true);
            if(empty($ent)){
                $ent=$this->session->userdata('Tsentity');
            }
            if(empty($lead)) {
                echo('<option></option>');
            } else {
                if($ent=='all'){
                   
                    $sql="select distinct group_cd,group_name from mgr.v_agent_list (NOLOCK) where lead_cd='".$lead."'";
                } else {
                    $sql="select distinct group_cd,group_name from mgr.v_agent_list (NOLOCK) where entity_cd ='".$ent."' and lead_cd='".$lead."'";
                }
                
                $ProjectData = $this->m_wsbangun->getData_by_query($sql);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->group_cd.'">'.$project->group_name.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }
}
?>