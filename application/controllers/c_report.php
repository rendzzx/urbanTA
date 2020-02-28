<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Report extends Core_Controller
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
        $this->load_content_top_menu('report/index');
    }

    public function getByID($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'web_attachment';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function gettabletb()
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
        
        $aColumns  = array('descs','file_attachment','doc_date','file_url');

        $sTable = 'mgr.web_attachment';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

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
        $param = " where module = 'TB' ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable_int_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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

    public function gettableda()
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
        
        $aColumns  = array('descs','file_attachment','doc_date','file_url');

        $sTable = 'mgr.web_attachment';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

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
        $param = " where module = 'DA' ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable_int_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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

    public function add()
    {
        $this->load->view('report/add');
    }

    public function save()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

        //Upload File
        $isFile     = $this->input->post('isFile',TRUE);
        $uploadOk   = 1;
        $namefile   = $this->input->post('namefile',TRUE);
        $fileUrl    = "";

        $id         = $this->input->post('id',TRUE);
        $module     = $this->input->post('module',TRUE);
        $descs      = $this->input->post('descs',TRUE);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $table = 'web_attachment';
        $criteria = array('rowID' => $id);

        $data = array(
            'entity_cd'       => $entity, 
            'project_no'      => $project,
            'descs'           => $descs,
            'doc_date'        => $audit_date,
            'module'          => $module,
            'audit_user'      => $audit_user,
            'audit_date'      => $audit_date,
        );

        if($isFile == "true"){

            $namefile = str_replace(' ', '_', $namefile);
            $fileUrl  = base_url('pdf/Report/').$namefile;

            $picture = $_FILES["userfile"];
            $target_dir = "./pdf/Report/";
            $target_file = $target_dir . str_replace(' ','_',basename($_FILES["userfile"]["name"]));
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

            if ($_FILES["userfile"]["size"] > 300000) {
                $callback['Error'] = true;
                $callback['Pesan'] = "Maximum file size is 300kb";
                $uploadOk = 0;
                $callback['Data'] = 'failed';

                echo json_encode($callback);
                exit();
            }

            if($imageFileType != "pdf" && $imageFileType != "PDF") {
                $callback['Error'] = true;
                $callback['Pesan'] ="Sorry, only PDF files are allowed.";
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
            $data = array(
                'entity_cd'       => $entity, 
                'project_no'      => $project,
                'descs'           => $descs,
                'file_attachment' => $namefile,
                'doc_date'        => $audit_date,
                'module'          => $module,
                'file_url'        => $fileUrl,
                'audit_user'      => $audit_user,
                'audit_date'      => $audit_date,
            );
        }

        if($_POST){
            if($id > 0) {
                if ($uploadOk == 1) {
                    unset($data['doc_date']);
                    $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                    if ($update == 'OK') {
                        $callback['Pesan'] = "Data has been updated successfully";
                    }
                    else{
                        $callback['Error'] = true;
                        $callback['Pesan'] = $update;
                    }
                }
            }
            else{
                if ($uploadOk == 1) {
                    $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                    if ($insert == 'OK') {
                        $callback['Pesan'] = "Data has been insert successfully";
                    }
                    else{
                        $callback['Error'] = true;
                        $callback['Pesan'] = $insert;
                    }
                }
            } 
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid 2';
        }

        echo json_encode($callback);

    }

    public function delete()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $id     = $this->input->post("id",true);
        
        if(empty($id)){
            $id=0;
        }

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedata_cons($cons,'web_attachment',$where);
        $callback['Pesan'] = 'Data has been deleted successfully';
        echo json_encode($callback);
    }

}