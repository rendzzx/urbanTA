<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_agent_approval extends Core_Controller { 

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

		// $table = 'v_reservation_product';
  //       $crit = array('entity_cd'=>$entity,
  //           'project_no'=>$project);
  //       $cons = $this->session->userdata('Tscons');
  //       $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

		$ContentAllData = array(
    			'project_no'=>$project,
				'ProjectDescs'=>$projectName,
				// 'product'=>$dtProduct
								
             );


    	$this->load_content_top_menu('approval/indexnew',$ContentAllData);
	}
    public function viewprofile($rowid=null)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');

        $sql = "select * from mgr.cf_agent_dt where rowID='$rowid'";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        

                // $this->load->view('approval/principal');
                $this->load->view('approval/profile');

        
        
    }
    public function getByID($rowid=''){
        $sql = "select * from mgr.v_agent_approve where rowID_agent='$rowid'";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        // var_dump($data);exit();

        echo json_encode($data);
    }
   
    
	public function getTable()
    {
    	$sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
       $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','rowID_agent', 'group_name', 'agent_name','Agent_handphone1', 'email_add', 'status_approval');

        $sTable = "mgr.v_agent_approve";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID_agent' :$Column[$sortIdColumn]['name']);
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

       
        $param =" Where status_approval='A'".$filter_search;
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

    public function getTable_unappr()
        {
            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }
           $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');
            $name = $this->session->userdata('Tsuname');
            
            $DB2 = $this->load->database($cons, TRUE);

            //untuk PK diharap diletakan di awal array
            $aField = array('id', 'subject', 'content','status');
            $aColumns  = array('row_number','rowID_agent', 'group_name', 'agent_name','Agent_handphone1', 'email_add');

            $sTable = "mgr.v_agent_approve";

            $iDisplayStart = (int)$this->input->get_post('start', true);
            $iDisplayLength = (int)$this->input->get_post('length', true);
            
            $order = $this->input->get_post('order', true);

            $draw = (int)$this->input->get_post('draw', true);
            $Column = $this->input->get_post('columns', true);
            $Search = $sSearch;
            // $Search_regex = $sSearch['regex'];
            $SortdOrder = $order[0]['dir'];
            $sortIdColumn = (int)$order[0]['column'];
            // var_dump($Column[$sordIdColumn]['name']);
            $SordField = ($sortIdColumn==0? 'rowID_agent' :$Column[$sortIdColumn]['name']);
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

           
            $param =" Where status_approval='U' ".$filter_search;
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

    public function Approval(){
        if($_POST){
            $id = $this->input->post("id",true);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $name = $this->session->userdata('Tsuname');
            $where = array('rowID_agent'=>$id);
            $cons = $this->session->userdata('Tscons');
            $v_agent_approve = $this->m_wsbangun->getData_by_criteria_cons($cons,'v_agent_approve',$where);
            $Email = $v_agent_approve[0]->email_add;
            $agent_cd = $v_agent_approve[0]->agent_cd;
            $group_cd = $v_agent_approve[0]->group_cd;

            $msg='';
            $psn='';
            $aa='';
            if(filter_var($Email, FILTER_VALIDATE_EMAIL)){
                $sql = "mgr.xcf_agent_approval_web '".$entity."', '".$project."', '".$group_cd."', '".$agent_cd."', '".$Email."','".$name."' ";
               
                $snd = $this->m_wsbangun->setData_by_query_cons($cons,$sql);
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
            }else{
                $msg = 'Email not valid';
                $psn ='Fail';
            }
            $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
            echo json_encode($t);
        }
    }

}