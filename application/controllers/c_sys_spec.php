<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_sys_spec extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');

    	$this->load_content_top_menu('sys_spec/index');
    }


      
    public function addnew($id=""){
        
 
        $this->load->view('sys_spec/add');

    }
    public function getByID($rowID=''){
  
        $where=array('rowID'=>$rowID);
        $data = $this->m_wsbangun->getData_by_criteria_adm('sysSpec',$where);

        echo json_encode($data);

    }

    public function delete(){
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedataweb('sysSpec',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
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
        $aColumns  = array('row_number', 'rowID','max_upload_size', 'max_upload_type','email_splus', 'audit_user', 'audit_date');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.sysSpec';

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
 
    public function save(){
        
            $msg="";
            if ($_POST) 
            {
                $rowID = $this->input->post('txtrowID', true);
                // var_dump($_POST);exit();
                $max_upload_type = $this->input->post('max_type',TRUE);
                $max_upload_size =$this->input->post('max_size',TRUE);
                $email_splus =$this->input->post('email',TRUE);
                
                // $status = intval($this->input->post('status',TRUE));
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                if(empty($rowID)){
                    $rowID = 0;
                }
                
                    $data = array(          
                    'max_upload_size' => $max_upload_size,
                    'max_upload_type' => $max_upload_type,
                    'email_splus' => $email_splus,
                    'audit_user'=>$audit_user,
                    'audit_date'=>$audit_date
                    );
                    

                    $criteria = array('rowID' => $rowID);
                    // var_dump($criteria);
                    if($rowID>0) {
                        $data = $this->m_wsbangun->updateDataweb('sysSpec',$data, $criteria);
                        // var_dump($data);exit();
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been updated successfully";
                            $st = 'OK';
                        }
            
                    } else {
                        $data = $this->m_wsbangun->insertDataweb('sysSpec',$data);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been saved successfully";
                            $st = 'OK';
                        }
                        
                  
                    }

                 
            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);

    }
}