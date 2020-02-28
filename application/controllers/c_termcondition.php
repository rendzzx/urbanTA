<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_Termcondition extends Core_Controller
{
    public function __construct(){
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
    }

    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $cons = $this->session->userdata('Tscons');

        // $projectName = $this->session->userdata('Tsprojectname');

        $table = 'cf_termcondition_principle';
        $DataMenu = $this->m_wsbangun->getData_cons('ifca3',$table);

        $data = array(
            'leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu,
            // 'ProjectDescs' => $projectName
            );
        $this->load_content_top_menu('termcondition/index', $data);
    }

    public function add(){
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        
        $table = 'cf_termcondition_principle';
        $feature = $this->m_wsbangun->getData_cons('ifca3',$table);

        $content = array(
            'feature'=>$feature,
        );

        $this->load->view('termcondition/add', $content);
    }

    public function getByID($id){
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_termcondition_principle';

        $where = array('rowID' => $id);
        // $data = $this->m_wsbangun->getData_by_criteria_adm('cf_termcondition_principle',$where);
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);

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
        $DB2 = $this->load->database('ifca3', TRUE);

        $aColumns  = array('row_number','file_attachment', 'file_url', 'audit_user', 'audit_date', 'rowID');
        $sTable = 'mgr.cf_termcondition_principle';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);
        // $param='';

        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     
            // $param =" Where  ".$filter_search;
        }
        // var_dump($filter_search);
        // $param =" Where status='1' ".$filter_search;
        $param = " where rowID > 0 ".$filter_search;
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

    public function upload(){
        var_dump($_POST);exit();
    }

    public function save_termcondition(){
        $msg="";
        $isFile  =$this->input->post('isFile',TRUE);
        if($_POST){
            if($isFile=="true"){
                $picture = $_FILES["userfile"];
                $psn="";

                $picture = array_filter($picture);
                // $target_dir = $_SERVER['DOCUMENT_ROOT'].'/WaskitaAPI2/pdf/';
                $target_dir = './pdf/termcondition/';
                // var_dump($target_dir);exit();
                // var_dump($target_dir);exit();
                $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                if($imageFileType != "pdf") {
                    $msg = "Sorry, only PDF files are allowed.";
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

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');

            $id  =$this->input->post('id',TRUE);
            // $file_attachment  =$this->input->post('file_attachment',TRUE);
            $pdf  =$this->input->post('pdf',TRUE);
            // $pdf = str_replace(' ', '_', $pdf);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');

            $table = 'cf_termcondition_principle';
            $sql="select count(*) as cnt from mgr.cf_termcondition_principle";
            $ts = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
            $line_no = $ts[0]->cnt;
            
            $criteria = array('rowID' => $id);
            if(strpos($pdf, base_url('pdf/termcondition/')) !==false ){
                // $target_url = base_url('pdf/').$pdf;
                 $target_url = $pdf;
            }else{
                // $target_url = $pdf;
                $target_url = base_url('pdf/termcondition/').$pdf;
            }
            // var_dump($target_url);exit();
            if($id > 0) {
                $data = array(
                // 'file_attachment' => $file_attachment,
                'file_url' => $target_url,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );
                $update = $this->m_wsbangun->updateData_cons('ifca3',$table,$data,$criteria);
                    if($update == 'OK')
                    {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    } else {
                        $msg= $update;
                        $psn = "Failed";
                    }
            }
            else{
                $data = array(
                'line_no' => $line_no+1,
                // 'file_attachment' => $file_attachment,
                'file_url' => $target_url,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );
                $insert = $this->m_wsbangun->insertData_cons('ifca3',$table,$data);
                        if($insert == 'OK')
                        {
                            $msg="Data has been insert successfully";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
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

    public function Delete(){
        $cons = $this->session->userdata('Tscons');
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedata_cons('ifca3','cf_termcondition_principle',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
}