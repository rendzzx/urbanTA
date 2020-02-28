<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Overview extends Core_Controller
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
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu);
        

        $this->load_content_top_menu('overview/index',$content);
    }


    public function add(){
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        
        $table = 'rl_project_overview';
        $amenities = $this->m_wsbangun->getData_cons($cons,$table);   
       
        $content = array(
            'amenities'=>$amenities,
        );

        $this->load->view('overview/add',$content);

    }

    public function getByID($MenuID=''){

        $cons = $this->session->userdata('Tscons');
        $table = 'rl_project_overview';
        $data = $this->m_wsbangun->getData_cons($cons,$table);

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
        $aColumns  = array('row_number','overview_info', 'youtube_link','url_brochure');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.rl_project_overview';

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
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

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


    public function save_overview(){
        $msg="";
        $project = $this->session->userdata('Tsproject');
        // var_dump($_POST);exit();
        $isFile  =$this->input->post('isFile',TRUE);
        // var_dump($isFile);exit();
        if($_POST){
            if($isFile=="true"){
                $picture = $_FILES["userfile"];
                $psn="";

                $picture = array_filter($picture);
                if(!is_dir("./img/projectinfo/")){
                    mkdir("./img/projectinfo/");
                }
                if(!is_dir("./img/projectinfo/".$project)){
                    mkdir("./img/projectinfo/".$project);
                }

                if (!is_dir("./img/projectinfo/".$project."/overview/")) {
                    mkdir("./img/projectinfo/".$project."/overview/");
                }

                $target_dir = "./img/projectinfo/".$project."/overview/";
                // $target_dir = "./img/overview/";
                $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                // Check if image file is a actual image or fake image
                // if(isset($_POST["submit"])) {
                //     $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                //     if($check !== false) {
                //         $msg = "File is an image - " . $check["mime"] . ".";
                //         $uploadOk = 1;
                //     } else {
                //         $msg = "File is not an image.";
                //         $uploadOk = 0;
                //     }
                // }
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
                // var_dump($_FILES["userfile"]["size"]);  
                // if ($_FILES["userfile"]["size"] > 1000000) {
                //     $msg = "Sorry, your file is too large.";
                //     $uploadOk = 0;
                // }
                // Allow certain file formats
                if($imageFileType != "pdf") {
                    $msg = "Sorry, PDF allowed.";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($msg1);
                    exit();
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                    }
                }
            }
            $entity = $this->session->userdata('Tsentity');
            $cons = $this->session->userdata('Tscons');

            $overview = $this->input->post('overview', TRUE);
            $youtubelink = $this->input->post('youtubelink', TRUE);
            $id  =(int)$this->input->post('idoverview',TRUE);
            $pdf = $this->input->post('pdf', TRUE);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            // var_dump($id);exit();

            $table = 'rl_project_overview';

            
            if(strpos($pdf, base_url('img/projectinfo/'.$project.'/overview/')) !==false ) {

                $data = array(
                'entity_cd' => $entity,
                'project_no' => $project,
                'overview_info' => $overview,
                'youtube_link' => $youtubelink,
                'url_brochure' => $pdf,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );

            }
            else{
                $data = array(
                'entity_cd' => $entity,
                'project_no' => $project,
                'overview_info' => $overview,
                'youtube_link' => $youtubelink,
                'url_brochure' => base_url('img/projectinfo/'.$project.'/overview/').$pdf,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );
            }
            // var_dump($id);exit();
            if($id>0) {
                $criteria = array('rowID' => $id);
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                    if($update == 'OK')
                    {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    } else {
                        $msg= $update;
                        $psn = "Failed";
                    }
            }else{
                $update = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                    if($update == 'OK')
                    {
                        $msg="Data has been saved successfully";
                        $psn = "OK";
                    } else {
                        $msg= $update;
                        $psn = "Failed";
                    }
            }

        } else {
            $msg="Data validation is not valid";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }
}