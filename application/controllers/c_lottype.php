<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Lottype extends Core_Controller
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
        
        
        $table = 'rl_project_gallery';
        $DataMenu = $this->m_wsbangun->getData_cons($cons,$table);        
        // var_dump($_SERVER['HTTP_HOST']);
        // var_dump($_SERVER['REMOTE_PORT']);exit();
        // var_dump($DataMenu); exit();
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu);
        

        $this->load_content_top_menu('picproject/index',$content);
    }


    public function add(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        

        $table = 'sysSpec';
        $dtspec = $this->m_wsbangun->getData_cons('ifca3',$table);  
        if(!empty($dtspec)){
            $max_upload_size = $dtspec[0]->max_upload_size.$dtspec[0]->max_upload_type;
        }else{
            $max_upload_size = 0;
        }
        $max_size = $this->convertToBytes($max_upload_size);

        // $table = 'cf_lot_type';
        // $amenities = $this->m_wsbangun->getData_cons($cons,$table);   
        $where=array('entity_cd'=>$entity,
                'project_no'=>$project);
        $table = 'pm_zone';
        $unitgroup = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);   
        // $table = 'v_cf_property';
        // $property = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);  
        $content = array(
            'unitgroup'=>$unitgroup,
            'max_upload_size'=>$max_upload_size,
            'max_size'=>$max_size
        );

        $this->load->view('unittype/add',$content);

    }

    public function getByID($id=''){
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_lot_type';

        $where=array('rowID'=>$id);
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
        $aColumns  = array('row_number','descs','picture_url','remarks','spec_info');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_lot_unit_group';

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
        $SordField = ($sortIdColumn==0? 'descs' :$Column[$sortIdColumn]['name']);

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


    public function save_lottype(){
        $project = $this->session->userdata('Tsproject');        
        $msg="";
        $isFile  =$this->input->post('isFile',TRUE);
        // var_dump($_POST);exit();
        if($_POST){
            if($isFile=="true"){
                $picture = $_FILES["userfile"];

                $picture = array_filter($picture);
                $targetproject = "./img/projectinfo/".$project;

                if(!is_dir("./img/unitinfo/")){
                    mkdir("./img/unitinfo/");
                }
                if(!is_dir("./img/unitinfo/".$project)){
                    mkdir("./img/unitinfo/".$project);
                }

                if (!is_dir("./img/unitinfo/".$project."/unittype/")) {
                    mkdir("./img/unitinfo/".$project."/unittype/");
                }

                $target_dir = "./img/unitinfo/".$project."/unittype/";

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
            $cons = $this->session->userdata('Tscons');

            $id  =$this->input->post('id',TRUE);
            $remarks  =$this->input->post('remarks',TRUE);
            $specinfo  =$this->input->post('specinfo',TRUE);
            $image  =$this->input->post('image',TRUE);
            $unitgroup  =$this->input->post('unitgroup',TRUE);

            $image = str_replace(' ', '_', $image);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');

            $criteria = array('rowID' => $id);
            $table = 'cf_lot_type';

            if(strpos($image, base_url('img/unitinfo/'.$project.'/unittype/')) !==false ) {
                $data = array(
                'remarks' => $remarks,
                'spec_info' => $specinfo,
                'picture_url' => $image,
                'zone_cd'=>$unitgroup,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );
            }
            else{
                $data = array(
                'remarks' => $remarks,
                'spec_info' => $specinfo,
                'zone_cd'=>$unitgroup,
                'picture_url' => base_url('img/unitinfo/'.$project.'/unittype/').$image,
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

    public function Delete(){
        $cons = $this->session->userdata('Tscons');
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedata_cons($cons,'rl_project_gallery',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
}