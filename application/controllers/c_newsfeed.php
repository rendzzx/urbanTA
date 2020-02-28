<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Newsfeed extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('upload');

    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        // var_dump($entity);
        $entityname = $this->session->userdata('Tsentityname');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $approver = 0;
        $where=array('entity_cd'=>$entity);
        $data_project = $this->m_wsbangun->getData_by_criteria("pl_project",$where);                
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$data_project,
            'entityname'=>$entityname);
        
    	$this->load_content_top_menu('newsfeed/NewIndex',$content);
    }
    public function getTableAttach()
    {
        $entity = $this->session->userdata('Tsentity');
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $seqno = $this->input->post('seqno', true);
        $DB2 = $this->load->database('ifca2', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number',  'descs','file_name','seq_no');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.attach_newsfeed';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        // if($iDisplayLength<0){
        //  $iDisplayLength=5;
        // }
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('search', true);
        $Search = $sSearch['value'];

        $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $aColumns[1] :$column[$sortIdColumn]['name']);

     

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
        $param =" Where seq_no=".$seqno." AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $field=" descs,file_name,seq_no ";
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$field);
      // var_dump($rResult);
      // return;
        // Total data set length
        
        // $sql="select count(*) as cnt from ".$sTable." ".$param;
        // $ts = $DB2->query($sql);
        // $a = $ts->result()[0]->cnt;

        // $iTotal = $a;//$DB2->count_all($sTable);
    
        // Output
        $output = array(
            'draw' => intval($draw),
            // 'recordsTotal' => $iTotal,
            // 'recordsFiltered' => $iTotal,
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
    public function addpdf($project_no=''){
        $user = $this->session->userdata('Tsuname');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $sql = "SELECT counter from mgr.next_number (NOLOCK) where name='newsfeed'";
        $dtSeq = $this->m_wsbangun->getData_by_query($sql);
        $seqno = (int) $dtSeq[0]->counter;
        $upseq = intval($seqno) + 1;
        $sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='newsfeed'";
        $this->m_wsbangun->setData_by_queryweb($sql);

        $data=array('project_no'=>$project_no,
            'seq_no'=>$seqno
            );
        $this->load->view('newsfeed/addpdf',$data);
    }
    public function addnew($project_no=''){
        $user = $this->session->userdata('Tsuname');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $sql = "SELECT counter from mgr.next_number (NOLOCK) where name='newsfeed'";
        $dtSeq = $this->m_wsbangun->getData_by_query($sql);
        $seqno = (int) $dtSeq[0]->counter;
        $upseq = intval($seqno) + 1;
        $sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='newsfeed'";
        $this->m_wsbangun->setData_by_queryweb($sql);
        
        // $cnt = $this->cek_attach($entity,$project,$seqno,$user);

        $data=array('project_no'=>$project_no,
                    'seq_no'=>$seqno
            );
        $this->load->view('newsfeed/add',$data);
    }
    function cek_attach($entity='',$project='',$seqno='',$user=''){
        

        $dday = date('d M Y H:i:s');
        
        
        $sql = "SELECT count(1) AS cnt FROM mgr.attach_newsfeed WHERE seq_no=$seqno";
        $dtA = $this->m_wsbangun->getData_by_query($sql);
        $cnt = $dtA[0]->cnt;

        

        if($cnt == 0)
        {
            $desc = array('Pdf', 'Picture');
            
                for ($i=0; $i<2; $i++) {
                    $table = 'attach_newsfeed';
                    $data = array('entity_cd' => $entity, 
                            'project_no' => $project,
                            'seq_no' => $seqno,
                            'descs' => $desc[$i],
                            'audit_user' => $user,
                            'audit_date' => $dday);
                    $AA = $this->m_wsbangun->insertDataweb($table, $data);                

                }
            
        }
        // exit;
        // $sql = "SELECT count(seq_no) as counter FROM mgr.attach_newsfeed(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND seq_no=$seqno ";
        // $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
        // $cnt = $dtCnt[0]->counter;

        return $cnt;


    }
    public function addfile()
    {
        $this->load->view('newsfeed/uploadfile');
    }
    public function zoom_project(){
        $data_id = $this->m_wsbangun->getData_by_criteria("pl_project");
        return $data_id;
    }
    public function getByID($id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria('newsfeed',$where);

        echo json_encode($data);

    }
    public function getAttachByID($id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria('attach_newsfeed',$where);

        echo json_encode($data);

    }
    public function DeleteAttach(){
        $msg="";
        $psn="";
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('id'=>$id);
        $data = $this->m_wsbangun->deletedataweb('attach_newsfeed',$where);
        
        if($data == 'OK')
        {
            $msg = "Data has been deleted successfully";
            $psn = "OK";
        } else {
            $msg = $data;
            $psn = "Failed";
        }
        $msg1=array("Pesan"=>$msg,
            "status"=>$psn);
        echo json_encode($msg1);

    }public function Delete(){
        $msg="";
        $psn="";
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('id'=>$id);
        $data = $this->m_wsbangun->deletedataweb('newsfeed',$where);
        
        if($data == 'OK')
        {
            $msg = "Data has been deleted successfully";
            $psn = "OK";
        } else {
            $msg = $data;
            $psn = "Failed";
        }
        $msg1=array("Pesan"=>$msg,
            "status"=>$psn);
        echo json_encode($msg1);

    }
    public function getTable()
    {
        $aProject = $this->input->post("pl_project",true);
        if(empty($aProject)){
            $aProject='';
        }
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        // var_dump($aProject);
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','id', 'subject', 'content','status');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_newsfeed';

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
        $SordField = ($sortIdColumn==0? 'id' :$Column[$sortIdColumn]['name']);

     
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
        $param =" Where entity_cd='".$entity."' AND project_no= '".$aProject."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
    public function getTableAttachment()
    {
        $aProject = $this->input->post("pl_project",true);
        if(empty($aProject)){
            $aProject='';
        }
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        // var_dump($aProject);
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','descs','file_name');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_attach_newsfeed';

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
        $SordField = ($sortIdColumn==0? 'id' :$Column[$sortIdColumn]['name']);

     
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
        $param =" Where entity_cd='".$entity."' AND project_no= '".$aProject."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
     public function edit_newsfeed($newsfeed_id = "", $data=null)
    {
        

    }

    public function save_pdf()
    {
        $msg="";
            if ($_POST) 
            {
                $id = (int)$this->input->post('id',TRUE);
                
                $entity = $this->session->userdata('Tsentity');
                $project_no =$this->input->post('project_no',TRUE);
                $pdf_name =$this->input->post('pdf',TRUE);
                $descs =$this->input->post('descs',TRUE);
                $pdf_name = str_replace(' ', '_', $pdf_name);
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');
                $isFile  =$this->input->post('isFile',TRUE);
                $seq_no = $this->input->post('seqno',TRUE);
                // var_dump(strlen($pict_name));
                // $tes='';
                if($isFile=="true"){
                    // var_dump($isFile);
                $pdf = $_FILES["userfile"];
                 $psn='';
                // var_dump(strlen($picture));
                // var_dump($picture["name"]);
                $pdf = array_filter($pdf);
				
                $target_dir = "./pdf/NewsFeed/";
                $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
				
					// Check if file already exists
					if (file_exists($target_file)) {
						$msg = "Sorry, file already exists.";
						$uploadOk = 0;
						$psn='failed';
							// return;
							$msg1=array("Pesan"=>$msg,"status"=>$psn);                           

							echo json_encode($msg1);
							exit();
					}
					// Check file size
					if ($_FILES["userfile"]["size"] > 500000) {
						$msg = "Sorry, your file is too large.";
						$uploadOk = 0;
					}
					// Allow certain file formats
					if($imageFileType != "pdf" ) {
						$msg = "Sorry, only pdf files are allowed.";
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						$msg = "Sorry, your file was not uploaded.";
					// if everything is ok, try to upload file
					} else {
						if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
							$msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
						} else {
							$msg = "Sorry, there was an error uploading your file.";
						}
					}
					// if (!empty($pdf["name"])) {
					//     $config['upload_path'] = './pdf/NewsFeed/';
					//     $config['allowed_types'] = 'pdf';
					//     $data['upload_data'] = '';
					//     $this->load->library('upload', $config);
					 
					//     if(!$this->upload->do_upload())
					//     { 
					//         // $tes='1';
					//         $data = $this->upload->display_errors();

					//         $msg=$data;
					//         $psn="Failed";
					//         // return;
					//         $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

					//         echo json_encode($msg1);
					//         exit();
					//     } else {
					//         // $tes='2';
					//         $msg='sukses';
					//         $data = $this->upload->data();

					//     }
					//     // var_dump("111");
					// } 
                }
                
                
                        $data = array(
                        'descs' => $descs,
                        'file_name' =>$pdf_name,
                        'entity_cd'=>$entity,
                        'seq_no'=>$seq_no,
                        'project_no'=>$project_no,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );    
                    
                   
                    $criteria = array('id' => $id);
                    // var_dump($data);
                    if($id>0) {
                        $update = $this->m_wsbangun->updateDataweb('attach_newsfeed',$data, $criteria);
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
                        $insert = $this->m_wsbangun->insertDataweb('attach_newsfeed',$data);
                        if($insert == 'OK')
                        {
                            $msg="Data has been updated successfully";
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
            // var $result = new{
            //     Response = $msg;
            // };

        echo json_encode($msg1);

            
    }

    public function save_newsfeed(){
        $msg="";
        if($_POST){
            $id = (int)$this->input->post('id',TRUE);
            $subject = $this->input->post('subject',TRUE);
            $content = $this->input->post('content');
            $status = $this->input->post('status',TRUE);
            $youtube = $this->input->post('youtubelink',TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project_no =$this->input->post('project_no',TRUE);
            $pict_name =$this->input->post('Picture',TRUE);
            $date_created  =$this->input->post('date_created',TRUE);
            $date_created = date($date_created);
            $date_created = DateTime::createFromFormat('d/m/Y H:i:s', $date_created.' 00:00:00');
            $date_created = $date_created->format('Y-d-m H:i:s');
            $pict_name = str_replace(' ', '_', $pict_name);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            $isFile  =$this->input->post('isFile',TRUE);
            $seq_no = $this->input->post('seqno',TRUE);

            if($isFile=="true"){
                $picture = $_FILES["userfile"];
                $psn="";

                $picture = array_filter($picture);
                $target_dir = "./img/NewsFeed/";
                $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                    if($check !== false) {
                        $msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $msg = "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $msg = "Sorry, file already exists.";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                        $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                        echo json_encode($msg1);
                        exit();
                }
                // Check file size
                if ($_FILES["userfile"]["size"] > 500000) {
                    $msg = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                    }
                }
            }

            if(strlen($pict_name) > 1) {
                        $data = array(
                        'subject' => $subject,
                        'content' => $content,
                        'status' =>$status,
                        'youtube_link' =>$youtube,
                        'picture' =>$pict_name,
                        'entity_cd'=>$entity,
                        'seq_no'=>$seq_no,
                        'project_no'=>$project_no,
                        'date_created'=>$date_created,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                    );    
                    }else{
                        $data = array(          
                        'subject' => $subject,
                        'content' => $content,
                        'status' =>$status,
                        'youtube_link' =>$youtube,
                        'date_created'=>$date_created,
                        // 'picture' =>$pict_name,
                        'seq_no'=>$seq_no,
                        'entity_cd'=>$entity,
                        'project_no'=>$project_no,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );
                    }
                 $criteria = array('id' => $id);
                    // var_dump($data);
                    if($id>0) {
                        $update = $this->m_wsbangun->updateDataweb('newsfeed',$data, $criteria);
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
                        $insert = $this->m_wsbangun->insertDataweb('newsfeed',$data);
                        if($insert == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                        
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("EDIT newsfeed")));
                    }
        } else {
                $msg="Data validation is not valid";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }

// public function save_newsfeed()
//     {
//         // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
//         // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);

//         // if ($pri->can_edit == '1' || $pri->can_add == '1') {
        
//             $msg="";
//             if ($_POST) 
//             {
//                 $id = (int)$this->input->post('id',TRUE);
//                 $subject = $this->input->post('subject',TRUE);
//                 $content = $this->input->post('content');
//                 $status = $this->input->post('status',TRUE);
//                 $youtube = $this->input->post('youtubelink',TRUE);
//                 $entity = $this->session->userdata('Tsentity');
//                 $project_no =$this->input->post('project_no',TRUE);
//                 $pict_name =$this->input->post('Picture',TRUE);
//                 $date_created  =$this->input->post('date_created',TRUE);
//                 $date_created = date($date_created);
//                 $date_created = DateTime::createFromFormat('d/m/Y H:i:s', $date_created.' 00:00:00');
//                 $date_created = $date_created->format('Y-d-m H:i:s');
//                 $pict_name = str_replace(' ', '_', $pict_name);
//                 $audit_date = date('d M Y H:i:s');
//                 $audit_user = $this->session->userdata('Tsuname');
//                 $isFile  =$this->input->post('isFile',TRUE);
//                 $seq_no = $this->input->post('seqno',TRUE);
//                 // var_dump(strlen($pict_name));
//                 // var_dump($pict_name);
//                 // $tes='';
//                 if($isFile=="true"){

//                 $picture = $_FILES["userfile"];

//                 // var_dump($picture);
//                 $psn='';
                
//                 // var_dump(strlen($picture));
//                 // var_dump($picture["name"]);
//                 $picture = array_filter($picture);

//                 $target_dir = "./img/NewsFeed/";
//                 $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
//                 $uploadOk = 1;
//                 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//                 // Check if image file is a actual image or fake image
//                 if(isset($_POST["submit"])) {
//                     $check = getimagesize($_FILES["userfile"]["tmp_name"]);
//                     if($check !== false) {
//                         $msg = "File is an image - " . $check["mime"] . ".";
//                         $uploadOk = 1;
//                     } else {
//                         $msg = "File is not an image.";
//                         $uploadOk = 0;
//                     }
//                 }
//                 // Check if file already exists
//                 if (file_exists($target_file)) {
//                     $msg = "Sorry, file already exists.";
//                     $uploadOk = 0;
//                     $psn='failed';
//                         // return;
//                         $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

//                         echo json_encode($msg1);
//                         exit();
//                 }
//                 // Check file size
//                 if ($_FILES["userfile"]["size"] > 500000) {
//                     $msg = "Sorry, your file is too large.";
//                     $uploadOk = 0;
//                 }
//                 // Allow certain file formats
//                 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//                 && $imageFileType != "gif" ) {
//                     $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//                     $uploadOk = 0;
//                 }
//                 // Check if $uploadOk is set to 0 by an error
//                 if ($uploadOk == 0) {
//                     $msg = "Sorry, your file was not uploaded.";
//                 // if everything is ok, try to upload file
//                 } else {
//                     if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
//                         $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
//                     } else {
//                         $msg = "Sorry, there was an error uploading your file.";
//                     }
//                 }
//                     if(strlen($pict_name) > 1) {
//                         $data = array(
//                         'subject' => $subject,
//                         'content' => $content,
//                         'status' =>$status,
//                         'youtube_link' =>$youtube,
//                         'picture' =>$pict_name,
//                         'entity_cd'=>$entity,
//                         'seq_no'=>$seq_no,
//                         'project_no'=>$project_no,
//                         'date_created'=>$date_created,
//                         'audit_user'=>$audit_user,
//                         'audit_date'=>$audit_date
//                     );    
//                     }else{
//                         $data = array(          
//                         'subject' => $subject,
//                         'content' => $content,
//                         'status' =>$status,
//                         'youtube_link' =>$youtube,
//                         'date_created'=>$date_created,
//                         // 'picture' =>$pict_name,
//                         'seq_no'=>$seq_no,
//                         'entity_cd'=>$entity,
//                         'project_no'=>$project_no,
//                         'audit_user'=>$audit_user,
//                         'audit_date'=>$audit_date
//                         );
//                     }
                    
//                     $criteria = array('id' => $id);
//                     // var_dump($data);
//                     if($id>0) {
//                         $update = $this->m_wsbangun->updateDataweb('newsfeed',$data, $criteria);
//                         if($update == 'OK')
//                         {
//                             $msg="Data has been updated successfully";
//                             $psn = "OK";
//                         } else {
//                             $msg= $update;
//                             $psn = "Failed";
//                         }
//                      //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("ADD newsfeed")));
//                     } else {
//                         $insert = $this->m_wsbangun->insertDataweb('newsfeed',$data);
//                         if($insert == 'OK')
//                         {
//                             $msg="Data has been updated successfully";
//                             $psn = "OK";
//                         } else {
//                             $msg= $insert;
//                             $psn = "Failed";
//                         }
                        
//                      //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("EDIT newsfeed")));
//                     }

//                     // redirect("c_newsfeed");
//                 // } // tutup if validation
//             } //tutup post
//             else{
//                 $msg="Data validation is not valid";
//             }
            
//             $msg1=array("Pesan"=>$msg,
//                 "status"=>$psn);
//             // var $result = new{
//             //     Response = $msg;
//             // };

//         echo json_encode($msg1);
//     }
}