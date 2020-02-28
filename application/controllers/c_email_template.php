<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_email_template extends Core_Controller {
	
	public function __construct(){ 
		parent::__construct();
        header('Content-Transfer-Encoding: base64');
		$this->auth_check();
		$this->load->model('m_wsbangun');
	}

	public function index(){
        $table = "sysEmailTemplate";
        $data = $this->m_wsbangun->getDataadm($table);
        $data = array(
            'data'=> $data
         );
		$this->load_content_top_menu('Email_Template/index',$data);
	}

    public function getTable()
    {

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $project = $this->session->userdata('Tsproject');   
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);
        

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','Tittle','body','Template_Id');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.sysBodyEmail';

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
        $SordField = ($sortIdColumn==0? 'Body_Id' :$Column[$sortIdColumn]['name']);

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
        $param = " where Body_Id > 0 ".$filter_search;
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
        $project = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsname');
        $email = $this->session->userdata('Tsemail');
        // $table = "sysEmailTemplate";
        // $data = $this->m_wsbangun->getDataadm($table);
        $data = array(
            'id'        => $id,
            'project'   => $project,
            'name'      => $name,
            'email'     => $email
         );

        $this->load_content_top_menu('email_template/new',$data);
    }

    public function editemail($id=0){

        $data = array(
            'id'=> $id
         );

        if ($id==1) {
            $this->load_content_top_menu('EmailTemplate/edit',$data);
        }
        if ($id==2) {
            $this->load_content_top_menu('EmailTemplate/edit2',$data);
        }
        if ($id==3) {
            $this->load_content_top_menu('EmailTemplate/edit3',$data);
        }

    }

    public function getByID($id){

        $table = "sysBodyEmail";
        $where = array(
            'Body_Id' => $id
        );
        $data = $this->m_wsbangun->getData_by_criteria_adm($table,$where);

        echo json_encode($data);
    }

    public function openuse(){
        $table = "sysEmail";
        $Email = $this->m_wsbangun->getDataadm($table);

        $data = array('email' => $Email );

        $this->load->view('email_template/use',$data);
    }

    public function save(){
        $callback = array(
            'Data'  => null,
            'Error' => true,
            'Pesan' => '',
            'Status'=> 200
        );
        // var_dump($_POST);exit();
        if($_POST){

            $id         = $this->input->post('id',TRUE);
            $tempalte   = $this->input->post('tempalte',TRUE);
            $subject    = $this->input->post('subject',TRUE);
            $code       = $this->input->post('code',TRUE);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');

            $data = array(
                'Tittle'        => $subject,
                'Body'          => $code,
                'audit_date'    => $audit_date,
                'audit_user'    => $audit_user,
                'Template_Id'   => $tempalte,
            );

            $criteria = array('Body_Id' => $id);

            if ($id>0) {
                $update = $this->m_wsbangun->updateDataweb('sysBodyEmail',$data, $criteria);
                if($update == 'OK')
                {
                    $callback['Pesan'] = "Data has been updated successfully";
                    $callback['Error'] = false;
                } else {
                    $callback['Pesan'] = $update;
                    $callback['Error'] = true;
                }
            }
            else{
                $insert = $this->m_wsbangun->insertDataweb('sysBodyEmail',$data);
                if($insert == 'OK')
                {
                    $callback['Pesan'] = "Data has been saved successfully";
                    $callback['Error'] = false;
                } else {
                    $callback['Pesan'] = $insert;
                    $callback['Error'] = true;
                }
            }

        }
        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function delete(){

        $id = $this->input->post('id',TRUE);
        if(empty($id)){
            $id=0;
        }
        $where=array('Body_Id'=>$id);
        $data = $this->m_wsbangun->deletedataweb('sysBodyEmail',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }

    public function useemail(){
        $callback = array(
            'Data'  => null,
            'Error' => true,
            'Pesan' => '',
            'Status'=> 200
        );
        // var_dump($_POST);exit();
        if($_POST){

            $id         = $this->input->post('email',TRUE);
            $body       = $this->input->post('body',TRUE);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            // var_dump($_POST);exit();

            $data = array(
                'Body_Id'       => $body,
                'audit_date'    => $audit_date,
                'audit_user'    => $audit_user,
            );

            $criteria = array('Email_Id' => $id);

            if ($id>0) {
                $update = $this->m_wsbangun->updateDataweb('sysEmail',$data, $criteria);
                if($update == 'OK')
                {
                    $callback['Pesan'] = "Data has been updated successfully";
                    $callback['Error'] = false;
                } else {
                    $callback['Pesan'] = $update;
                    $callback['Error'] = true;
                }
            }
        }
        echo json_encode($callback, JSON_PRETTY_PRINT);
    }
}