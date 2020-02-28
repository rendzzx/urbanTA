<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_principle_list extends Core_Controller {
    
    public function __construct(){ 
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_rl_sales_list');
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
        $this->load->model('m_business');
    }
    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

        $sql2 = "SELECT DISTINCT group_cd from mgr.cf_agent_hd (NOLOCK) where ENTITY_CD='$entity'";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $groupcode="";       
        if(!empty($data)){
            $groupcode=$data[0]->group_cd;    
        }
        

        $sql = "SELECT DISTINCT group_name from mgr.v_agent_approve (NOLOCK) Where group_cd='$groupcode' AND entity_cd='$entity'";
        $cons = $this->session->userdata('Tscons');
        $dataMkt = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $offName = "";
        if(!empty($dataMkt)){
            $offName = $dataMkt[0]->group_name;    
        }
        
        
        $encParam = base64_encode($project.'-'.$projectName);

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                'OfficeName'=>$offName,
                'encParam'=>$encParam
             );


        $this->load_content_top_menu('principle_list/index',$ContentAllData);
    }

    public function edit(){
        
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');

        
        // $this->load->view('marketing_list/edit');
        $this->load->view('principle_list/add');
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
        $cons = $this->session->userdata('Tscons');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        //$aField = array('id', 'subject', 'content','status');
        $aColumns  = array('rowID','group_name','NPWP','Company_Address','City','Company_Email','Handphone1','Handphone2');
        // $aColumns = array('entity_cd', 'entity_name');
        // $sTable = "select * from mgr.v_nup_update where (status not in ('A','V', 'S') or (status = 'S' and old_status in ('R','N')))'";
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";
        //$sql2 = "SELECT group_cd from mgr.cf_agent_dt (NOLOCK) where agent_cd='$name' and ENTITY_CD='$entity'";
        
        // $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        // $groupcode="";
        // if(!empty($data)){
        //     $groupcode=$data[0]->group_cd;    
        // }
        
        // $sTable = "mgr.v_executive_mkt";
        $sTable = "mgr.v_executive_prl";

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
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['group_name']);
        // $SordField = ('STATUS,reserve_date ASC');
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

        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        $param =" Where rowID > 0".$filter_search;

        // $param =" Where group_cd='".$groupcode."' AND entity_cd='".$entity."'  ".$filter_search;
        // $cons = $this->session->userdata('Tscons');
        $rResult = $this->m_wsbangun->getlisttablenup_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
    public function update($rowID=null){
        $msg ='';
        $status ='';
        if ($_POST) 
        {
            $agent_cd = $this->session->userdata('Tsuname');
            $PT                 = $this->input->POST('PTPTdtl',TRUE);
            $txtHomeAdd      = (string)$this->input->POST('txtHomeAdd',TRUE);
            $txtAgentName     = $this->input->POST('txtAgentName',TRUE);
            $txtCity      = $this->input->POST('txtCity',TRUE);
            // $txtProvince      = $this->input->POST('txtProp',TRUE);
            // $txtPostCd      = $this->input->POST('txtCode',TRUE);
            // $txtTelp      = $this->input->POST('txtTelp',TRUE);
            // $txtFax      = $this->input->POST('txtFax',TRUE);
            // $txtOffiEmail      = $this->input->POST('txtOffiEmail',TRUE);
            // $txtComBankName      = $this->input->POST('txtComBankName',TRUE);
            // $txtAcctName      = $this->input->POST('txtAcctName',TRUE);
            // $txtAcctNo      = $this->input->POST('txtAcctNo',TRUE);
            // $txtPrincipleName     = $this->input->POST('txtPrinNo',TRUE);
            $txtIdNo     = $this->input->POST('txtIdNo',TRUE);
            $txtNPWP    = $this->input->POST('txtNPWP',TRUE);
            $txtEmailAdd        = $this->input->POST('txtEmailAdd',TRUE);
            $txthp1        = $this->input->POST('txtMbl1',TRUE);
            $txthp2        = $this->input->POST('txtMbl2',TRUE);
            $audit_date = date('d M Y H:i:s');
            
            $cons = $this->session->userdata('Tscons');
            // $entity_cd = '2101';
            $data = array(
                    // 'entity_cd'=>$entity_cd,
                    // 'group_cd'=>$group_cd,
                    // 'agent_cd'=>$Agent_cd,
                    'agent_name'=>$txtAgentName,
                    'id_no'=>$txtIdNo,
                    'NPWP'=>$txtNPWP,
                    'home_address'=>$txtHomeAdd,
                    'City'=>$txtCity,
                    // 'Province'=>$txtProvince,
                    // 'Post_Cd'=>$txtPostCd,
                    // 'email_add'=>$txtEmailAdd,
                    'Handphone1'=>$txthp1,
                    'Handphone2'=>$txthp2,                    
                    // 'agent_type_cd'=>$rbType,                    
                    // 'status'=>'N',
                    'Audit_date'=>$audit_date,
                    'Audit_user'=>'WEB',
                    // 'seqno'=>$seqno,
                    // 'status_approval'=>'U',
                    // 'principal_flag'=>'N'

                );
            $where =array('rowID'=>$rowID);
            $tes = $this->m_wsbangun->updateData_cons($cons,'v_executive_mkt',$data,$where);
            if($tes=='OK'){
                            $msg="Data has been saved successfully";
                            $status ='ok';
                        } else {
                            $status="fail";
                            $msg=$tes;
                        }
        }else
        {
                $msg="Data validation is not valid";
                $status="fail";
        }
        $msg1=array("Pesan"=>$msg,
                        "status"=>$status);
            
        echo json_encode($msg1);
         

    }

}
?>