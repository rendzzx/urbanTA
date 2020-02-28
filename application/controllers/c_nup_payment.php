<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_nup_payment extends Core_Controller {
	
	public function __construct(){ 
		parent::__construct();
		$this->auth_check();
		// $this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
		$this->load->model('m_sms');
		$this->load->model('m_business');
	}
	
	public function index()
    {
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
		$projectName = $this->session->userdata('Tsprojectname');

        $table = 'rl_payment';
        $DataMenu = $this->m_wsbangun->getDataadm($table);        
        
        // echo json_encode($DataMenu);

    	$this->load_content_top_menu('nup_payment/index');
    }

     public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'payment_cd','descs', 'logo', 'audit_user', 'audit_date','row_id');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.rl_payment';

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
        $SordField = ($sortIdColumn==0? 'payment_cd' :$Column[$sortIdColumn]['descs']);

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
        $param = " where payment_cd <> '' ".$filter_search;
        // var_dump($param);

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

    public function addnew($id=""){
        $sql = 'select * from mgr.rl_payment';
        $sysmail = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql);
        // $sq2 = 'select select db_profile from mgr.pl_project from mgr.pl_project';
        // $project = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql);


        // var_dump($sysmail);exit();
        
        $content = array(
            'sysmail'=>$sysmail,
            'id'=>$id,
            // 'project'=>$project
        );

        // var_dump($content);exit;
        // $this->load->view('menu/add', $content);
        $this->load->view('nup_payment/add', $content);

    }
  
    public function getByID($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'rl_payment';

        $where=array('row_id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);
        // var_dump($data);exit;
        echo json_encode($data);
    }



    

    public function save()
    {
    	$callback = array(
 			'Data'	 => null,
 			'Error'  => false,
 			'Pesan'  => '',
 			'Status' => 200
 		);

 		$entity		= $this->session->userdata('Tsentity');
        $project 	= $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

        //Upload Foto
        $isFile  =$this->input->post('isFile',TRUE);

        $uploadOk = 1;
        $image  = $this->input->post('image',TRUE);

        if($isFile=="true"){

            $image = str_replace(' ', '_', $image);
            $image = base_url('img/payment_logo/').$image;

            $picture = $_FILES["userfile"];
            $target_dir = "./img/payment_logo/";
            $target_file = $target_dir . str_replace(' ','_',basename($_FILES["userfile"]["name"]));
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                if($check !== false) {
                    $callback['Pesan'] = "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = "File is not an image.";
                    $uploadOk = 0;
                }

                $callback['Data'] = 'Failed';                        

                echo json_encode($callback);
                exit();
            }

            if ($_FILES["userfile"]["size"] > 1048576) {
                $callback['Error'] = true;
                $callback['Pesan'] = "Maximum file size is 1MB";
                $uploadOk = 0;
                $callback['Data'] = 'failed';

                echo json_encode($callback);
                exit();
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" ) {
                $callback['Error'] = true;
                $callback['Pesan'] ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                $callback['Data'] = 'failed';

                echo json_encode($callback);
                exit();
            }

            if ($uploadOk == 0) {
                $callback['Error'] = true;
                $callback['Pesan'] = "Sorry, your file was not uploaded.";
            }
            else {
                if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                    $callback['Pesan'] = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                }
                else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = "Sorry, there was an error uploading your file.";
                }
            }
        }

        $id = $this->input->post('row_id',TRUE);
        $payment_cd = $this->input->post('payment_cd',TRUE);
        $descs = $this->input->post('descs',TRUE);
        $logo = $this->input->post('image',TRUE);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $table = 'rl_payment';

        $criteria = array('row_id' => $id);

        if($_POST){
        	if($uploadOk == 1) {
                if ($id > 0) {
                        $datauser = array(
                            // 'payment_cd' => $payment_cd, 
                            'descs' => $descs, 
                            'logo' => $logo, 
                            // 'COM'=>$NewEmailPassword,
                            // 'password'=>$NewEmailPassword,
                            // 'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->updateData_cons('ifca3',$table,$datauser,$criteria);
                }
                else{
	        			$datauser = array(
                            'payment_cd' => $payment_cd,
                            'descs' => $descs, 
                            'logo' => $logo, 
                            // 'COM'=>$NewEmailPassword,
                            // 'password'=>$NewEmailPassword,
                            // 'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->insertData_cons('ifca3',$table,$datauser);
                    }

	        }
	        else{
	        	$callback['Error'] = true;
		        $callback['Pesan'] = 'Data validation is not valid 2';
	        }

       
	    }
	     else{
		    	$callback['Error'] = true;
		        $callback['Pesan'] = 'Data validation is not valid 2';
	        }
         echo json_encode($callback);
	}
}