<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_nup_colour extends Core_Controller {

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

		$table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $cons = $this->session->userdata('Tscons');
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

		$ContentAllData = array(
    			'project_no'=>$project,
				'ProjectDescs'=>$projectName,
				'product'=>$dtProduct				
             );


    	$this->load_content_top_menu('nup_colour/index',$ContentAllData);
	}
	public function getByID($counter_id=''){
        
        $where=array('counter_id'=>$counter_id);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'pm_lot_nup_colour',$where);

        echo json_encode($data);

    }
	public function countnumber(){
		$id=$this->input->post('Id',TRUE);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
		$table = 'pm_lot_nup_colour';
		$where = array('entity_cd' =>$entity ,
					'project_no'=>$project );
        $cons = $this->session->userdata('Tscons');
		$data =  $this->m_wsbangun->getCount_by_criteria_cons($cons,$table,$where);
		$data=$data+1;
		echo $data;
	}
	public function add(){
        $user = $this->session->userdata('Tsuname');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        
        // $cnt = $this->cek_attach($entity,$project,$seqno,$user);

        $data=array('project_no'=>$project
            );
        $this->load->view('nup_colour/add',$data);
    }
    public function save_colour(){
    	$msg="";
            if ($_POST) 
            {
            	$id = $this->input->post('id',TRUE);
            	// var_dump($id);
            	$entity = $this->session->userdata('Tsentity');
            	$counter_id = $this->input->post('nomer',TRUE);
            	$after = $this->input->post('after',TRUE);
            	$initial = $this->input->post('initial',TRUE);
                $project = $this->session->userdata('Tsproject');
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');
	            $data = array(          
	                        // 'nup_id' => $nup_id,
	                        'entity_cd' => $entity,
	                        'project_no' => $project,
	                        'counter_id'=>$counter_id,
	                        'initial_colour'=>$initial,
	                        'after_choose_colour'=>$after,
	                        'audit_user'=>$audit_user,
	                        'audit_date'=>$audit_date
	                        );
                    $psn='';
                    $criteria = array('counter_id' => $counter_id);
                    // var_dump($criteria);
                    if($id >= 0) {
                        $update = $this->m_wsbangun->updateData('pm_lot_nup_colour',$data, $criteria);
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
                        $insert = $this->m_wsbangun->insertData('pm_lot_nup_colour',$data);
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
        $cons = $this->session->userdata('Tscons');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'counter_id','initial_colour','after_choose_colour');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.pm_lot_nup_colour';

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
        $SordField = ($sortIdColumn==0? 'counter_id' :$Column[$sortIdColumn]['name']);

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
        $cons = $this->session->userdata('Tscons');
        $rResult = $this->m_wsbangun->getlisttable_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);

       

        $sql="select count(*) as cnt from ".$sTable." ".$param;
        // var_dump($sql);
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
?>