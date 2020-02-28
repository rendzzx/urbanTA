<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Amenities extends Core_Controller
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
        $cons = $this->session->userdata('Tscons');
        
        
        $table = 'rl_project_amenities';
        $DataMenu = $this->m_wsbangun->getData_cons($cons,$table);        
        // var_dump($_SERVER['HTTP_HOST']);
        // var_dump($_SERVER['REMOTE_PORT']);exit();
        // var_dump($DataMenu); exit();
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu);
        

        $this->load_content_top_menu('gallery/index',$content);
    }


    public function add(){
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        
        $table = 'rl_project_amenities';
        $amenities = $this->m_wsbangun->getData_cons($cons,$table);   
       
        $content = array(
            'amenities'=>$amenities,
        );

        $this->load->view('gallery/add',$content);
    }

    public function getByID($id=''){
        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $table = 'rl_project_amenities';

        $where=array('entity_cd'=>$entity,'project_no'=>$project);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);

    }
    
    public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','line_no','gallery_title');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.rl_project_amenities';

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
        $SordField = ($sortIdColumn==0? 'line_no' :$Column[$sortIdColumn]['name']);

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
        $param = " where rowID > 0 ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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

    public function upload(){
        var_dump($_POST);exit();
    }


    public function save_amenities(){
        $msg="";
        $psn="";
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        if($_POST){
	        $id  =$this->input->post('id',TRUE);
	        $i  =$this->input->post('infra',TRUE);
	        $s  =$this->input->post('school',TRUE);
	        $h  =$this->input->post('hospital',TRUE);
	        $o  =$this->input->post('other',TRUE);
	        $audit_date = date('d M Y H:i:s');
	        $audit_user = $this->session->userdata('Tsuname');

	        $table = 'rl_project_amenities';
	        $where_i = array('entity_cd' => $entity,
	    					  'project_no'=>$project,
	    					  'amenities_type'=>'I'
	    						);
	        $cek_i = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_i);
      		$data_i = array('entity_cd' => $entity,
	    					'project_no'=>$project,
	    					'amenities_type'=>'I',
	    					'amenities_info'=>$i,
	    					'audit_user'=>$audit_user,
                			'audit_date'=>$audit_date);
      		if(!empty($cek_i)) {
               
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_i,$where_i);
                    if($update == 'OK')
                    {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    } else {
                        $msg= "failed updating i : ".$update;
                        $psn = "Failed";
                    }
            }else{
                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_i);
                    if($insert == 'OK')
                    {
                        $msg="Data has been saved successfully";
                        $psn = "OK";
                    } else {
                        $msg= "failed inserting i : ".$insert;
                        $psn = "Failed";
                    }
            }
            if($psn=="OK"){
            	$where_s = array('entity_cd' => $entity,
	    					  'project_no'=>$project,
	    					  'amenities_type'=>'S'
	    						);
		        $cek_s = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_s);
	      		$data_s = array('entity_cd' => $entity,
		    					'project_no'=>$project,
		    					'amenities_type'=>'S',
		    					'amenities_info'=>$s,
		    					'audit_user'=>$audit_user,
	                			'audit_date'=>$audit_date);
	      		if(!empty($cek_s)) {
	               
	                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_s,$where_s);
	                    if($update == 'OK')
	                    {
	                        $msg="Data has been updated successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed updating i : ".$update;
	                        $psn = "Failed";
	                    }
	            }else{
	                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_s);
	                    if($insert == 'OK')
	                    {
	                        $msg="Data has been saved successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed inserting i : ".$insert;
	                        $psn = "Failed";
	                    }
	            }
            }
            
            if($psn=="OK"){
            	$where_h = array('entity_cd' => $entity,
	    					  'project_no'=>$project,
	    					  'amenities_type'=>'H'
	    						);
		        $cek_h = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_h);
	      		$data_h = array('entity_cd' => $entity,
		    					'project_no'=>$project,
		    					'amenities_type'=>'H',
		    					'amenities_info'=>$h,
		    					'audit_user'=>$audit_user,
	                			'audit_date'=>$audit_date);
	      		if(!empty($cek_h)) {
	               
	                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_h,$where_h);
	                    if($update == 'OK')
	                    {
	                        $msg="Data has been updated successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed updating i : ".$update;
	                        $psn = "Failed";
	                    }
	            }else{
	                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_h);
	                    if($insert == 'OK')
	                    {
	                        $msg="Data has been saved successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed inserting i : ".$insert;
	                        $psn = "Failed";
	                    }
	            }
            }
            if($psn=="OK"){
            	$where_o = array('entity_cd' => $entity,
	    					  'project_no'=>$project,
	    					  'amenities_type'=>'O'
	    						);
		        $cek_o = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_o);
	      		$data_o = array('entity_cd' => $entity,
		    					'project_no'=>$project,
		    					'amenities_type'=>'O',
		    					'amenities_info'=>$o,
		    					'audit_user'=>$audit_user,
	                			'audit_date'=>$audit_date);
	      		if(!empty($cek_o)) {
	               
	                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_o,$where_o);
	                    if($update == 'OK')
	                    {
	                        $msg="Data has been updated successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed updating i : ".$update;
	                        $psn = "Failed";
	                    }
	            }else{
	                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_o);
	                    if($insert == 'OK')
	                    {
	                        $msg="Data has been saved successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed inserting i : ".$insert;
	                        $psn = "Failed";
	                    }
	            }
            }

        } else {
            $msg="Data validation is not valid";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }

    public function Delete(){
        $cons = $this->session->userdata('Tscons');
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedata_cons($cons,'rl_project_amenities',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
}