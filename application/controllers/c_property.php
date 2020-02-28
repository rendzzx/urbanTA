<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Property extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('upload');

    }
    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $entityname = $this->session->userdata('Tsentityname');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $approver = 0;
        $where=array('entity_cd'=>$entity);
        $data_project = $this->m_wsbangun->getData_by_criteria_adm("pl_project",$where);                
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$data_project,
            'entityname'=>$entityname);
        
    	$this->load_content_top_menu('property/index',$content);
    }
    public function getTable()
    {
    	$projectno='';
        $cons = $this->session->userdata('Tscons');
        $aProject = $this->input->post("pl_project",true);
        if(empty($aProject)){
            $projectno='';
        } else {
        	$projectno=$aProject;
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
        $aColumns  = array('row_number','property_cd', 'picture_url', 'descs');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_cf_property';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        $SordField = ($sortIdColumn==0? 'descs' :$Column[$sortIdColumn]['name']);

     
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

        $param =" Where entity_cd='".$entity."' AND project_no= '".$projectno."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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

    public function getTable2()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        // var_dump($project);exit();

        //untuk PK diharap diletakan di awal array
        $aColumns  = array('row_number','property_cd', 'picture_url', 'descs');
        // $aColumns  = array('row_number','property_cd', 'booking_pic', 'descs');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_cf_property';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        $SordField = ($sortIdColumn==0? 'descs' :$Column[$sortIdColumn]['name']);

     
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

        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
    public function edit($project = '',$pcd='')
    {
        // if(empty($project))
        // {
        //     show_404();
        //     return;
        // }
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');

        $table = 'cf_property(nolock)';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project,
            'property_cd'=>$pcd);
        $dtPrj = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
        // var_dump($dtPrj);exit();
        if(!empty($dtPrj))
        {
            $prjdesc = $dtPrj[0]->descs;
            $pic = $dtPrj[0]->picture_url;
            $pcd = $dtPrj[0]->property_cd;
            $active = $dtPrj[0]->work_done;

            $content = array(
                'prj'=>$prjdesc,
                'logo'=>$pic,
                'pcd'=>$pcd,
                'project'=>$project,
                'active'=>$active
                );
            
            $this->load->view('property/edit', $content);
                    
        } 

    }

    public function add(){
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        $table = 'sysSpec';
        $dtspec = $this->m_wsbangun->getData_cons('ifca3',$table);  
        if(!empty($dtspec)){
            $max_upload_size = $dtspec[0]->max_upload_size.$dtspec[0]->max_upload_type;
        }else{
            $max_upload_size = 0;
        }
        $max_size = $this->convertToBytes($max_upload_size);
        $table = 'cf_property';
        $cf_property = $this->m_wsbangun->getData_cons($cons,$table);   
       
        $content = array(
            'cf_property'=>$cf_property,
            'max_upload_size'=>$max_upload_size,
            'max_size'=>$max_size
        );

        $this->load->view('property/add',$content);

    }

    // public function edit2($pcd='')
    // {
    //     // if(empty($project))
    //     // {
    //     //     show_404();
    //     //     return;
    //     // }
    //     $name = $this->session->userdata('Tsuname');
    //     $admin = $this->session->userdata('Tsysadmin');
    //     $entity = $this->session->userdata('Tsentity');
    //     $project = $this->session->userdata('Tsproject');
    //     $cons = $this->session->userdata('Tscons');

    //     $table = 'cf_property(nolock)';
    //     $crit = array('entity_cd'=>$entity,
    //         'project_no'=>$project,
    //         'property_cd'=>$pcd);
    //     $dtPrj = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
    //     // var_dump($dtPrj);exit();
    //     if(!empty($dtPrj))
    //     {
    //         $prjdesc = $dtPrj[0]->descs;
    //         $pic = $dtPrj[0]->picture_url;
    //         $pcd = $dtPrj[0]->property_cd;
    //         $active = $dtPrj[0]->work_done;

    //         $content = array(
    //             'prj'=>$prjdesc,
    //             'logo'=>$pic,
    //             'pcd'=>$pcd,
    //             'project'=>$project,
    //             'active'=>$active
    //             );
            
    //         $this->load->view('property/add', $content);
                    
    //     } 
       
        
    // }
     public function getByID($id=''){
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_property';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);

    }
    
    public function save_property(){
        $msg="";
        $isFile  =$this->input->post('isFile',TRUE);
        $project = $this->session->userdata('Tsproject');
        // var_dump($_POST);exit();
        
        // var_dump($max_size);exit();
        if($_POST){
            if($isFile=="true"){
                $picture = $_FILES["userfile"];

                $picture = array_filter($picture);
                // $targetproject = "./img/projectinfo/".$project;
                if(!is_dir("./img/unitinfo/")){
                    mkdir("./img/unitinfo/");
                }
                if(!is_dir("./img/unitinfo/".$project)){
                    mkdir("./img/unitinfo/".$project);
                }

                if (!is_dir("./img/unitinfo/".$project."/property/")) {
                    mkdir("./img/unitinfo/".$project."/property/");
                }

                $target_dir = "./img/unitinfo/".$project."/property/";

                $target_file = $target_dir . str_replace(' ','_',basename($_FILES["userfile"]["name"]));
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

                    $psn='failed';
                        // return;
                    $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($msg1);
                    exit();                }
                // Check if file already exists
                // if (file_exists($target_file)) {
                //     $msg = "Sorry, file already exists.";
                //     $uploadOk = 0;
                //     $psn='failed';
                //         // return;
                //     $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                //     echo json_encode($msg1);
                //     exit();
                // }
                // Check file size
                $table = 'sysSpec';
                $dtspec = $this->m_wsbangun->getData_cons('ifca3',$table);  
                if(!empty($dtspec)){
                    $max_upload_size = $dtspec[0]->max_upload_size.$dtspec[0]->max_upload_type;
                }else{
                    $max_upload_size = 0;
                }
                $max_size = $this->convertToBytes($max_upload_size);
                if ($_FILES["userfile"]["size"] > $max_size) {
                    $msg = "Maximum file size is ".$max_upload_size;
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($msg1);
                    exit();
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "JPG" ) {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($msg1);
                    exit();
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg1 = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {

                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                    }
                     else {
                        $msg = "Sorry, there was an error uploading your file.";
                        $psn = "failed";
                    }
                }
            }

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');

            $id  =$this->input->post('id',TRUE);
            // var_dump($id);exit();
            $image  =$this->input->post('image',TRUE);
            $image = str_replace(' ', '_', $image);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');

            $criteria = array('rowID' => $id);
            $table = 'cf_property';

            if(strpos($image, base_url('img/unitinfo/'.$project.'/property/')) !==false ) {
                $data = array(
                'picture_url' => $image,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );
            }
            else{
                $data = array(
                'picture_url' => base_url('img/unitinfo/'.$project.'/property/').$image,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );
            }
            $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                    if($update == 'OK')
                    {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    } else {
                        $msg= $update;
                        $psn = "Failed";
                    }


        } else {
            $msg="Data validation is not valid";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }
    public function saveLogo()
    {
        if($_POST)
        {
            
            $entity = $this->session->userdata('Tsentity');
            $project = $this->input->post('project', TRUE);
            $pcd = $this->input->post('pcd', TRUE);
            $active = $this->input->post('workdone', TRUE);
            $cons = $this->session->userdata('Tscons');

            if (!isset($nup)) $nup = 0;
            if (!isset($booking)) $booking = 0;



            $picture = !empty($_FILES) ? $picture = $_FILES["picture"] : '';
            if(!empty($picture["name"]))
            {
                $picname = str_replace(' ', '_', $picture["name"]);
                $picture = $_FILES["picture"];
                $psn='';
                
                // var_dump($picname);
                $picture = array_filter($picture);

                $target_dir = $_SERVER['DOCUMENT_ROOT'].'/WaskitaAPI/images/solterra/galery/';
                $target_file = $target_dir . basename($_FILES["picture"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["picture"]["tmp_name"]);
                    if($check !== false) {
                        $msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $msg = "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Check if file already exists
                // if (file_exists($target_file)) {
                //     $msg = "Sorry, file already exists.";
                //     $uploadOk = 0;
                //     $psn='failed';
                //         // return;
                //         $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                //         echo json_encode($msg1);
                //         exit();
                // }
                // Check file size
                if ($_FILES["picture"]["size"] > 500000) {
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
                    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                    }
                }

                
                $savedata = array('picture_url'=>'http://35.197.137.111/WaskitaAPI/images/solterra/galery'.$picname,
                    'work_done'=>$active);

            } else {
              
                $savedata = array(
                    'work_done'=>$active);
            }

            $table = 'cf_property';
            $crit = array('entity_cd'=>$entity,
                'project_no'=>$project,
                'property_cd'=>$pcd);
            $this->m_wsbangun->updateData_cons($cons,$table, $savedata, $crit);
            $msg = "file has been saved successfully";

            $res = array('pesan'=>$msg);
            echo json_encode($res);
        }
    }
}
?>