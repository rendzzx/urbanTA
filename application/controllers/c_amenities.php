<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Amenities extends Core_Controller
{
    public function __construct(){
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');
    }

    public function index(){
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
    
    public function getTable(){
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
	        $m  =$this->input->post('mall',TRUE);
	        $l  =$this->input->post('lrt',TRUE);
	        $g  =$this->input->post('gym',TRUE);
	        $d  =$this->input->post('dining',TRUE);
            $p  =$this->input->post('pool',TRUE);
            $y  =$this->input->post('play',TRUE);
	        $audit_date = date('d M Y H:i:s');
	        $audit_user = $this->session->userdata('Tsuname');

            $title = $this->input->post('title',TRUE);
            $pict_nam =$this->input->post('picturepath1',TRUE);
            $pict_nam = str_replace(' ', '_', $pict_nam);

            $title1 = $this->input->post('title1',TRUE);
            $pict_nam1 =$this->input->post('picturepath2',TRUE);
            $pict_nam1 = str_replace(' ', '_', $pict_nam1);

            $title2 = $this->input->post('title2',TRUE);
            $pict_nam2 =$this->input->post('picturepath3',TRUE);
            $pict_nam2 = str_replace(' ', '_', $pict_nam2);

            $title3 = $this->input->post('title3',TRUE);
            $pict_nam3 =$this->input->post('picturepath4',TRUE);
            $pict_nam3 = str_replace(' ', '_', $pict_nam3);

            $title4 = $this->input->post('title4',TRUE);
            $pict_nam4 =$this->input->post('picturepath5',TRUE);
            $pict_nam4 = str_replace(' ', '_', $pict_nam4);

            $title5 = $this->input->post('title5',TRUE);
            $pict_nam5 =$this->input->post('picturepath6',TRUE);
            $pict_nam5 = str_replace(' ', '_', $pict_nam5);


            $createFolder = "./img/projectinfo/";
            // $replace_namafoto = str_replace(' ','_',basename($_FILES["userfile"]["name"]));
            $target_dir = $createFolder . $project . '/amenities' . '/';


            if(strpos($pict_nam, base_url($target_dir)) !== false) 
            {
                $pict_names = $pict_nam;
            }else{
                $pict_names = base_url(). $target_dir .$pict_nam;
            }

            if(strpos($pict_nam1, base_url($target_dir)) !== false) 
            {
                $pict_names1 = $pict_nam1;
            }else{
                $pict_names1 = base_url().$target_dir.$pict_nam1;
            }

            if(strpos($pict_nam2, base_url($target_dir)) !== false) 
            {
                $pict_names2 = $pict_nam2;
            }else{
                $pict_names2 = base_url().$target_dir.$pict_nam2;
            }

            if(strpos($pict_nam3, base_url($target_dir)) !== false) 
            {
                $pict_names3 = $pict_nam3;
            }else{
                $pict_names3 = base_url().$target_dir.$pict_nam3;
            }

            if(strpos($pict_nam4, base_url($target_dir)) !== false) 
            {
                $pict_names4 = $pict_nam4;
            }else{
                $pict_names4 = base_url().$target_dir.$pict_nam4;
            }

            if(strpos($pict_nam1, base_url($target_dir)) !== false) 
            {
                $pict_names5 = $pict_nam5;
            }else{
                $pict_names5 = base_url().$target_dir.$pict_nam5;
            }

	        $table = 'rl_project_amenities';
	        $where_m = array('entity_cd' => $entity,
	    					  'project_no'=>$project,
	    					  'amenities_type'=>'M'
	    						);
	        $cek_m = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_m);
      		$data_m = array('entity_cd' => $entity,
	    					'project_no'=>$project,
	    					'amenities_type'=>'M',
	    					'amenities_info'=>$m,
	    					'audit_user'=>$audit_user,
                			'audit_date'=>$audit_date,
                            'amenities_url' => $pict_names,
                            'amenities_title' => $title
                            );
      		if(!empty($cek_m)) {
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_m,$where_m);
                    if($update == 'OK')
                    {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    } else {
                        $msg= "failed updating i : ".$update;
                        $psn = "Failed";
                    }
            }else{
                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_m);
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
            	$where_l = array('entity_cd' => $entity,
	    					  'project_no'=>$project,
	    					  'amenities_type'=>'L'
	    						);
		        $cek_l = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_l);
	      		$data_l = array('entity_cd' => $entity,
		    					'project_no'=>$project,
		    					'amenities_type'=>'L',
		    					'amenities_info'=>$l,
		    					'audit_user'=>$audit_user,
	                			'audit_date'=>$audit_date,
                                'amenities_url' => $pict_names1,
                                'amenities_title' => $title1
                            );
	      		if(!empty($cek_l)) {
	               
	                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_l,$where_l);
	                    if($update == 'OK')
	                    {
	                        $msg="Data has been updated successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed updating i : ".$update;
	                        $psn = "Failed";
	                    }
	            }else{
	                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_l);
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
            	$where_g = array('entity_cd' => $entity,
	    					  'project_no'=>$project,
	    					  'amenities_type'=>'G'
	    						);
		        $cek_g = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_g);
	      		$data_g = array('entity_cd' => $entity,
		    					'project_no'=>$project,
		    					'amenities_type'=>'G',
		    					'amenities_info'=>$g,
		    					'audit_user'=>$audit_user,
	                			'audit_date'=>$audit_date,
                                'amenities_url' => $pict_names2,
                                'amenities_title' => $title2
                            );
	      		if(!empty($cek_g)) {
	               
	                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_g,$where_g);
	                    if($update == 'OK')
	                    {
	                        $msg="Data has been updated successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed updating i : ".$update;
	                        $psn = "Failed";
	                    }
	            }else{
	                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_g);
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
            	$where_d = array('entity_cd' => $entity,
	    					  'project_no'=>$project,
	    					  'amenities_type'=>'D'
	    						);
		        $cek_d = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_d);
	      		$data_d = array('entity_cd' => $entity,
		    					'project_no'=>$project,
		    					'amenities_type'=>'D',
		    					'amenities_info'=>$d,
		    					'audit_user'=>$audit_user,
	                			'audit_date'=>$audit_date,
                                'amenities_url' => $pict_names3,
                                'amenities_title' => $title3
                            );
	      		if(!empty($cek_d)) { 
	                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_d,$where_d);
	                    if($update == 'OK')
	                    {
	                        $msg="Data has been updated successfully";
	                        $psn = "OK";
	                    } else {
	                        $msg= "failed updating i : ".$update;
	                        $psn = "Failed";
	                    }
	            }else{
	                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_d);
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
                $where_p = array('entity_cd' => $entity,
                              'project_no'=>$project,
                              'amenities_type'=>'P'
                                );
                $cek_p = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_p);
                $data_p = array('entity_cd' => $entity,
                                'project_no'=>$project,
                                'amenities_type'=>'P',
                                'amenities_info'=>$p,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date,
                                'amenities_url' => $pict_names4,
                                'amenities_title' => $title4
                            );
                if(!empty($cek_p)) {
                   
                    $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_p,$where_p);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= "failed updating i : ".$update;
                            $psn = "Failed";
                        }
                }else{
                    $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_p);
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
                $where_y = array('entity_cd' => $entity,
                              'project_no'=>$project,
                              'amenities_type'=>'Y'
                                );
                $cek_y = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_y);
                $data_y = array('entity_cd' => $entity,
                                'project_no'=>$project,
                                'amenities_type'=>'Y',
                                'amenities_info'=>$y,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date,
                                'amenities_url' => $pict_names5,
                                'amenities_title' => $title5
                            );
                if(!empty($cek_y)) {
                   
                    $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_y,$where_y);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= "failed updating i : ".$update;
                            $psn = "Failed";
                        }
                }else{
                    $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_y);
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

    public function save_amenities_BK(){
        $msg="";
        $psn="";
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        if($_POST){
            $id  =$this->input->post('id',TRUE);
            $m  =$this->input->post('mall',TRUE);
            $l  =$this->input->post('lrt',TRUE);
            $g  =$this->input->post('gym',TRUE);
            $d  =$this->input->post('dining',TRUE);
            $p  =$this->input->post('pool',TRUE);
            $y  =$this->input->post('play',TRUE);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            $title = $this->input->post('amenities_title',TRUE);
            $picturepath1 = $this->input->post('amenities_url',TRUE);

            $title = $this->input->post('title',TRUE);
            $pict_name =$this->input->post('picturepath1',TRUE);
            $pict_name = str_replace(' ', '_', $pict_name);

            $table = 'rl_project_amenities';
            $where_m = array('entity_cd' => $entity,
                              'project_no'=>$project,
                              'amenities_type'=>'M'
                                );
            $cek_m = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_m);
            if(strpos($pict_name, base_url('img/amenities/')) !== false) {
                                $data_m = array(
                                    'amenities_title' => $title,
                                    'amenities_url' => $pict_name,
                                    'entity_cd' => $entity,
                                    'project_no'=>$project,
                                    'amenities_type'=>'M',
                                    'amenities_info'=>$m,
                                    'audit_user'=>$audit_user,
                                    'audit_date'=>$audit_date,
                                    'amenities_title'=>$title,
                                    'amenities_url'=>$picturepath1
                                );    
                            }else{
                                $data_m = array(
                                    'amenities_title' => $title,        
                                    'amenities_url' => base_url().'img/amenities/'.$pict_name,
                                    'entity_cd' => $entity,
                                    'project_no'=>$project,
                                    'amenities_type'=>'M',
                                    'amenities_info'=>$m,
                                    'audit_user'=>$audit_user,
                                    'audit_date'=>$audit_date,
                                    'amenities_title'=>$title,
                                    'amenities_url'=>$picturepath1
                                    );
                            }
            // $data_m = array('entity_cd' => $entity,
                    //      'project_no'=>$project,
                    //      'amenities_type'=>'M',
                    //      'amenities_info'=>$m,
                    //      'audit_user'=>$audit_user,
        //                  'audit_date'=>$audit_date,
                              
        //                 );
            if(!empty($cek_m)) {
               
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_m,$where_m);
                    if($update == 'OK')
                    {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    } else {
                        $msg= "failed updating i : ".$update;
                        $psn = "Failed";
                    }
            }else{
                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_m);
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
                $where_l = array('entity_cd' => $entity,
                              'project_no'=>$project,
                              'amenities_type'=>'L'
                                );
                $cek_l = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_l);
                $data_l = array('entity_cd' => $entity,
                                'project_no'=>$project,
                                'amenities_type'=>'L',
                                'amenities_info'=>$l,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date);
                if(!empty($cek_l)) {
                   
                    $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_l,$where_l);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= "failed updating i : ".$update;
                            $psn = "Failed";
                        }
                }else{
                    $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_l);
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
                $where_g = array('entity_cd' => $entity,
                              'project_no'=>$project,
                              'amenities_type'=>'G'
                                );
                $cek_g = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_g);
                $data_g = array('entity_cd' => $entity,
                                'project_no'=>$project,
                                'amenities_type'=>'G',
                                'amenities_info'=>$g,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date);
                if(!empty($cek_g)) {
                   
                    $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_g,$where_g);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= "failed updating i : ".$update;
                            $psn = "Failed";
                        }
                }else{
                    $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_g);
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
                $where_d = array('entity_cd' => $entity,
                              'project_no'=>$project,
                              'amenities_type'=>'D'
                                );
                $cek_d = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_d);
                $data_d = array('entity_cd' => $entity,
                                'project_no'=>$project,
                                'amenities_type'=>'D',
                                'amenities_info'=>$d,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date);
                if(!empty($cek_d)) {
                   
                    $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_d,$where_d);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= "failed updating i : ".$update;
                            $psn = "Failed";
                        }
                }else{
                    $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_d);
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
                $where_p = array('entity_cd' => $entity,
                              'project_no'=>$project,
                              'amenities_type'=>'P'
                                );
                $cek_p = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_p);
                $data_p = array('entity_cd' => $entity,
                                'project_no'=>$project,
                                'amenities_type'=>'P',
                                'amenities_info'=>$p,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date);
                if(!empty($cek_p)) {
                   
                    $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_p,$where_p);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= "failed updating i : ".$update;
                            $psn = "Failed";
                        }
                }else{
                    $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_p);
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
                $where_y = array('entity_cd' => $entity,
                              'project_no'=>$project,
                              'amenities_type'=>'Y'
                                );
                $cek_y = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where_y);
                $data_y = array('entity_cd' => $entity,
                                'project_no'=>$project,
                                'amenities_type'=>'Y',
                                'amenities_info'=>$y,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date);
                if(!empty($cek_y)) {
                   
                    $update = $this->m_wsbangun->updateData_cons($cons,$table,$data_y,$where_y);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= "failed updating i : ".$update;
                            $psn = "Failed";
                        }
                }else{
                    $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data_y);
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

    private function setUploadOptions(){
        $max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/cs',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }   

    public function savePic() {
        if($_POST)
        {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsname');
            //$complain_no = $this->input->post('complain_no',true);
            //$seqno = $this->input->post('seqno',true);

            $files = $_FILES;
            $cnt ='';
            // $picname = str_replace(' ', '_', $files['userfile']['name']);
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());

            $picture = !empty($_FILES) ? $picture = $_FILES["userfile"] : '';
            if(!empty($picture["name"]))
            {
                $picname = str_replace(' ', '_', $picture["name"]);
                $picture = $_FILES["userfile"];
                // var_dump($picture);exit();
                $tmpName = $_FILES['userfile']['tmp_name'];
                $imgString = file_get_contents($tmpName);
                $imgData = bin2hex($imgString);
                $imgbin ="0x".$imgData;
                $psn='';
                
                $picture = array_filter($picture);

                $createFolder = "./img/projectinfo/";
                $replace_namafoto = str_replace(' ','_',basename($_FILES["userfile"]["name"]));
                $target_dir = $createFolder . $project . '/amenities' . '/';

                // $target_dir = "./img/projectinfo/1103/amenities/";
                // $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $target_file = $target_dir . $replace_namafoto;
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);  //create directory if not exist
                }
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                if ($_FILES["userfile"]["size"] > 5000000) {
                    $msg = "Maximum file size is 5MB";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $res=array("pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($res);
                    exit();
                }

                $imageFileType = strtolower($imageFileType);
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "JPG" ) {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $res=array("pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($res);
                    exit();
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg = "Sorry, your file was not uploaded.";
                    $psn = "Failed";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                        $descs =$target_dir.$picname;
                        $url=base_url().$descs;
                        // var_dump($url);exit();
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                        $psn = "Failed";
                    }
                }

                // $picname = str_replace(' ', '_', $files['userfile']['name']);
               
                
                // $sql = "SELECT count(sales_seq_no) as counter FROM mgr.rl_sales_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND sales_seq_no=$seqno ";
                // $sql.= "AND (status_attach IS NULL OR status_attach='0')";
                // $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
                // $cnt = $dtCnt[0]->counter;
                // if(empty($dtCnt)){
                //     $cnt = 0;
                // }
            } else {
              
               $msg = "Sorry, there was an error uploading your file.";
               $psn = "Failed";
            }

                
            // }
            $res = array('pesan'=>$msg, 
                        'status'=>$psn,
                        'url'=>$url,
                        'picname'=>$picname,
                        );
            echo json_encode($res);
            // var_dump($res);exit();

        
        }
    }

}