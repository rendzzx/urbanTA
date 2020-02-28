<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_agent_regist extends Core_Controller {
	
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
        $cons = $this->session->userdata('Tscons');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName
             );


        $this->load_content_top_menu('agent_regist/agent_regist', $ContentAllData);
    }

    public function zoombyAgent()
    {
        $db_profile = $this->input->post('dbprofile',TRUE);

        $sql1 = "select distinct entity_cd, group_cd, group_name from mgr.cf_agent_hd";
        $dataAgent = $this->m_wsbangun->getData_by_querypb_cons($db_profile, $sql1); 

         
            if(!empty($dataAgent)) {
                // $comboAgent[] = '<option></option>';
                $comboAgent[] = '<option value=""></option>';
                foreach ($dataAgent as $agent) {
                  // if($projects === $key->project_no) {
                  //   $pilih = ' selected = "1"';
                  // } else {
                  //   $pilih = '';
                  // }
                    $comboAgent[] = '<option  value="'.$agent->group_cd.'">'.$agent->group_name.'</option>';
                }
                $comboAgent = implode("", $comboAgent);
            }
            echo $comboAgent;
    }

    public function newagent($rowID=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

        $sql1 = "SELECT descs, db_profile, project_no, entity_cd from mgr.pl_project";
        $data1 = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql1);

        // $sql2 = "select * from mgr.cf_registration_agent where RowID='$rowID'";
        // $data2 = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql2);

        $comboproject[] = '<option value=""></option>';
            if(!empty($data1)) {
                // $comboProject[] = '<option></option>';
                foreach ($data1 as $project) {
                  // if($projects === $key->project_no) {
                  //   $pilih = ' selected = "1"';
                  // } else {
                  //   $pilih = '';
                  // }
                    $comboproject[] = '<option  value="'.$project->project_no.'" data-db_profile="'.$project->db_profile.'" data-entity_cd="'.$project->entity_cd.'" data-project_no="'.$project->project_no.'">'.$project->descs.'</option>';
                }
                $comboproject = implode("", $comboproject);
            }


        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                'comboproject'=>$comboproject,
                // 'RowID' => $rowID,
                // 'agent' => $data2,
             );


        $this->load_content_top_menu('agent_regist/new_agent_regist', $ContentAllData);
    }

	public function form($nup_type=''){
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $name = $this->session->userdata('Tsuname');
		$projectName = $this->session->userdata('Tsprojectname');

		$sqlad = "SELECT distinct nup_type,descs from mgr.rl_nup_type where  entity_cd='$entity' and project_no='$project'";        
        $dtComplain = $this->m_wsbangun->getData_by_query_cons($cons,$sqlad);

        $combotype[] = '<option value=""></option>';
            if(!empty($dtComplain)) {
                // $comboProject[] = '<option></option>';
                foreach ($dtComplain as $key) {
                  if($nup_type === $key->nup_type) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $combotype[] = '<option  value="'.$key->nup_type.'" '.$pilih.'>'.$key->descs.'</option>';
                }
                $combotype = implode("", $combotype);
            }

    	$ContentAllData = array(
    			'project_no'=>$project,
				'ProjectDescs'=>$projectName,
				'combotype'=>$combotype,
                'nup_type'=>$nup_type
             );

        if(!empty($nup_type)){
            $this->load_content_top_menu('nup_online/NupOnlineEdit', $ContentAllData);
        }else{
            $this->load_content_top_menu('nup_online/NupOnlineNew', $ContentAllData);
        }
    }

    public function getByNUPtype($nuptype=''){
    	// $nup_type = $this->input->post('nuptype');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        // var_dump($cons);
        //data nuptype adm untuk ambil id
        $sql = "SELECT * FROM mgr.rl_nup_type WITH(NOLOCK) WHERE entity_cd='$entity' and project_no ='$project' and nup_type = '$nuptype' ";
        $dt = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

        $sql = "SELECT * FROM mgr.rl_nup_type_gallery WITH(NOLOCK) WHERE entity_cd='$entity' and project_no ='$project' and nup_type = '$nuptype' ";
        $data2 = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        
        //data nuptype per db project
        $sql = "SELECT * FROM mgr.rl_nup_type WITH(NOLOCK) WHERE nup_type = '$nuptype'";
        $data1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $content = array('data1' => $data1,
                         'data1_adm' => $dt,
                         'data2' => $data2
                        );
        echo json_encode($content);
    }



	public function getTable($product_cd='')
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
        $DB2 = $this->load->database('ifca3', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number', 'group_type','email_add','full_name', 'nik', 'handphone1', 'file_url');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_cf_agent_regist';
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";

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
        // $SortdOrder = $order[0]['dir'];
        $SortdOrder = " DESC";
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'audit_date' :$Column[$sortIdColumn]['name']);
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
        // Select Data

        $param = " where rowID > 0 ".$filter_search;
        $cons = $this->session->userdata('Tscons');
        $rResult = $this->m_wsbangun->getlisttablenup_cons('ifca3',$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
    public function savePic() {
        if($_POST)
        {

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsname');
            $nuptype = $this->input->post('nuptype',true);
            $seqno = $this->input->post('seqno',true);

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
                $tmpName = $_FILES['userfile']['tmp_name'];
                $imgString = file_get_contents($tmpName);
                $imgData = bin2hex($imgString);
                $imgbin ="0x".$imgData;
                $psn='';
                
                $picture = array_filter($picture);
                if(!is_dir("./img/project_nuptype/")){
                    mkdir("./img/project_nuptype/");
                }
                //create folder by sequence no
                if(!is_dir("./img/project_nuptype/".$project)){
                    mkdir("./img/project_nuptype/".$project);
                }
                //end of create folder by sequence no
                //check if file exist append number to file
                $name = basename($_FILES["userfile"]["name"]);
                $actual_name = str_replace(' ', '_', pathinfo($name,PATHINFO_FILENAME));
                $original_name = $actual_name;
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                // $i = 1;
                // while(file_exists("./img/project_nuptype/".$project.'/'.$actual_name.".".$extension))
                // {           
                //     $actual_name = (string)$original_name.$i;
                //     $picname = $actual_name.".".$extension;
                //     $i++;
                // }
                //end of check if file exist append number to file
                $picname = $project.'_'.$nuptype.'_'.$seqno.".".$extension;
                // var_dump($picname);exit();
                $target_dir = "./img/project_nuptype/".$project."/";
                $target_file = $target_dir . $picname;
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 
                // Check file size
                if ($_FILES["userfile"]["size"] > 5000000) {
                    $msg1 = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                $imageFileType = strtolower($imageFileType);
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $msg1 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg_up = $msg1."\n Your file was not uploaded.";
                    $psn = "Failed";
                    $url = '';
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg_up = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                    } else {
                        $msg_up = "Sorry, there was an error uploading your file.";
                        $psn = "Failed";
                        $url = '';
                    }
                }
                // exit();
                $sql='';
                if($psn=="OK"){
                    $descs ="img/project_nuptype/".$project."/".$picname;
                    // $cons = $this->session->userdata('Tscons');
                    $url=base_url().$descs;
                    $sql = "SELECT * from mgr.rl_nup_type_gallery WHERE entity_cd = '$entity' and project_no='$project' and nup_type = '$nuptype' and line_no = '$seqno'";
                    $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
                    $rowid='';
                    if(!empty($data)){
                        $rowid = $data[0]->rowID;
                    }
                    $cnt = count($data);


                    if($cnt>0){
                         $sql = "UPDATE mgr.rl_nup_type_gallery SET audit_date='$audit_date', gallery_url='$url' ";
                         $sql .= "   WHERE rowID = '$rowid'";
                    }else{
                         $sql = "INSERT INTO mgr.rl_nup_type_gallery(entity_cd,project_no,nup_type,line_no,gallery_url,";
                         $sql .= "main_image,audit_user,audit_date)";
                         $sql .= " VALUES ('$entity','$project','$nuptype','$seqno','$url','N','$audit_user','$audit_date')";
                    }
                    $msg="File saved successfully";
                    $psn="OK";
                    // $data = $this->m_wsbangun->setData_by_query_cons('ifca3',$sql);
                    // if($data !="OK"){
                    //         $msg = 'Upload File Failed : '.$data;
                    //         $psn = 'Fail';
                    //         $pic = '';
                    // } else {
                    //     $msg = "File saved successfully";
                    //     $psn ="OK";
                    //     $pic = $picname;
                    // }
                } else {
                    //kalo gagal upload gambar
                    $msg=$msg_up;
                    $psn="Failed";
                }

            } else {
              
               $msg = "Sorry, there was an error uploading your file.";
               $psn = "Failed";
            }

     
            $res = array('pesan'=>$msg, 
                        'status'=>$psn,
                        'url'=>$url,
                        'query'=>$sql
                        );
            echo json_encode($res);

        
        }
    }
    public function setUploadOptions()
    {
        $max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/cs',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }

 public function deletePic()
    {

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $nup_type = $this->input->post("nuptype",true);
        $line_no = $this->input->post("seqno",true);

        $where=array(
            'entity_cd'=>$entity,
            'project_no' =>$project,
            'nup_type' =>$nup_type,
            'line_no' =>$line_no);
        $data = $this->m_wsbangun->deletedataweb('rl_nup_type_gallery',$where);
       
        if($data !="OK"){
                                $msg = $data;
                                $psn ="Fail";
                            } else {
                                $msg = "Data has been deleted successfully";
                                $psn ="OK";
                             
                            }
        $msg1=array("pesan"=>$msg, "status" => $psn);
        echo json_encode($msg1);
        
    }


     public function save(){
        
            $msg="";
            if ($_POST) 
            {
                // var_dump($this->input->post());exit();
                $email_user = $this->session->userdata('Tsemail');
                $userID = $this->session->userdata('Tsuser_id');
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
                $cons = $this->session->userdata('Tscons');

                $rowID = $this->input->post('rowid', true);
                $nuptype = $this->input->post('nuptype',true);
                $descs = $this->input->post('descs',true);
                $start = $this->input->post('start',TRUE);
                $tglstart = explode('/',$start);                
                $start = date('Y M d',strtotime($tglstart[2].'-'.$tglstart[1].'-'.$tglstart[0]));
                $end = $this->input->post('end',TRUE);
                $tglend = explode('/',$end);
                $end = date('Y M d',strtotime($tglend[2].'-'.$tglend[1].'-'.$tglend[0]));
                $refundtype = $this->input->post('refund_type',TRUE);
                $nupamt = $this->input->post('nup_amt',TRUE); 
                $infonup = $this->input->post('nup_info',TRUE);
                $termsdescs = $this->input->post('terms_descs',TRUE);
                $expired_minute = $this->input->post('expired',TRUE);
                $badges = $this->input->post('btn_badges',TRUE);
                // var_dump($start);
                // var_dump($end);exit();
                $audit_date = date('Y M d H:i:s');
                $audit_user = $this->session->userdata('Tsname');
                $email = $this->session->userdata('Tsemail');

                $main_pic = $this->input->post('main_pic',TRUE);
                $infonup = iconv('','UTF-8',$infonup);
                $termsdescs = iconv('','UTF-8',$termsdescs);
                $data = array(          
                
                'entity_cd' => $entity,
                'project_no' => $project,
                'nup_type' =>$nuptype,
                'descs' =>$descs,                       
                'start_date'=>$start,
                'end_date'=>$end,
                'expired_minute'=>$expired_minute,
                'refund_type'=>$refundtype,
                'nup_amt'=>$nupamt,
                'info_nup'=>$infonup,
                'badges'=>$badges,
                'terms_descs'=>$termsdescs,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );
                // var_dump($data);
                $where = array('rowID' => $rowID );
                if($rowID==0){
                    $insert = $this->m_wsbangun->insertData_cons('ifca3','rl_nup_type',$data);
                    $msg="Data has been saved successfully";
                    // var_dump('expression');
                }else{
              
                    $insert = $this->m_wsbangun->updateData_cons('ifca3','rl_nup_type',$data,$where);
                    $msg="Data has been updated successfully";
                }
                if($insert !="OK"){
                    $msg= $insert;
                    $psn = 'Fail rl_nup_type';
                }else{
                    
                    for ($i=1; $i <= 5; $i++) { 
                        $sql = $this->input->post('query'.$i,TRUE);
                        if(!empty($sql)){
                            $data = $this->m_wsbangun->setData_by_query_cons('ifca3',$sql);
                            if($data !="OK"){
                                $msg = "Failed to upload picture (".$i.") : ".$data;
                                $psn ="Fail rl_nup_type_gallery (".$i.")";
                            } else {
                                $msg = "Data has been saved successfully";
                                $psn ="OK";
                             
                            }
                        }
                        $sql = "SELECT * from mgr.rl_nup_type_gallery WHERE entity_cd = '$entity' and project_no='$project' and nup_type = '$nuptype' and line_no = '$i'";
                        $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
                        $cnt = count($data);
                        if($cnt>0){
                            if($i == $main_pic){
                            $dataup = array('main_image' => 'Y' );
                            }else{
                                $dataup = array('main_image' => 'N' );
                            }
                            
                            $where = array(
                                'entity_cd' => $entity,
                                'project_no' => $project,
                                'nup_type' =>$nuptype,
                                'line_no' => $i );
                            $update = $this->m_wsbangun->updateData_cons('ifca3','rl_nup_type_gallery',$dataup,$where);
                            if($update !="OK"){
                                $msg = "Failed to update main_pic (".$i.") : ".$update;
                                $psn ="Fail";
                            } else {
                                $msg = "Data has been saved successfully";
                                $psn ="OK";
                             
                            }
                        }
                        
                    }


                }
                
       
            } else {
                $msg="Data validation is not valid";
                $psn='Fail';
            }
            
           $msg1 = array(
                'pesan'=>$msg,
                'status'=>$psn
            );
            
        echo json_encode($msg1);

       
    }
}

