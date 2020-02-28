<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Module extends Core_Controller
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

    	$this->load_content_top_menu('sysmodule/index');
    }
    public function assign(){

        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');

        $this->load_content_top_menu('sysmodule/index_assign');

    } 
    public function assignuser(){

        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $sql = "SELECT distinct rowID,module_cd,module_descs,OrderSeq FROM mgr.sysModule (nolock) order by OrderSeq asc";
        $module = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $content = array('module' => $module);
        
        $this->load->view('sysmodule/assign',$content);

    } 
    public function getByModuleUser($email='')
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'v_sysModuleUser';

        $where=array('email'=>$email);
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);

        echo json_encode($data);
    }
    public function getByModuleGroup($group_cd='')
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'v_sysModuleUser';

        $where=array('group_cd'=>$group_cd);
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);

        echo json_encode($data);
    }
     public function getTableGroup()
    {
        $project = $this->session->userdata('Tsproject');        
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);
        
        $aColumns  = array('group_cd','group_descs');

        $sTable = 'mgr.sysGroup';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'GroupID' :$Column[$sortIdColumn]['name']);

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
        $param = " where GroupID > 0 and dashboard_url not like '%adminweb%' ".$filter_search;
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

        $sql = "SELECT * FROM mgr.sysGroup where dashboard_url like '%adminweb%' order by group_descs asc";
        $group = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $content = array('group' => $group);
        $this->load->view('sysmodule/add',$content);

    }
    public function getByID($rowID=''){
  
        $where=array('rowID'=>$rowID);
        $data = $this->m_wsbangun->getData_by_criteria_adm('sysmodule',$where);

        echo json_encode($data);

    }

    public function delete(){
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedataweb('sysmodule',$where);
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
        $aColumns  = array('row_number', 'rowID','module_cd', 'module_descs', 'module_group_cd', 'dashboard_url');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.sysmodule';

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
                $rowID = $this->input->post('rowID', true);
                // var_dump($nup_id);
                $module_cd = $this->input->post('module_cd',TRUE);
                $module_descs =$this->input->post('module_descs',TRUE);
                $module_group_cd =$this->input->post('group',TRUE);
                $dashboard_url = $this->input->post('dashboard',TRUE);
                $iconclass = $this->input->post('iconclass',TRUE);
                $buttonclass = $this->input->post('buttonclass',TRUE);
                $orderseq = $this->input->post('orderseq',TRUE);
                $status = intval($this->input->post('status',TRUE));
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                if(empty($rowID)){
                    $rowID = 0;
                }
                
                $data = array(   
                    'module_cd' => $module_cd,
                    'module_descs' => $module_descs,
                    'module_group_cd' => $module_group_cd,
                    'module_descs' => $module_descs,
                    'dashboard_url' => $dashboard_url,
                    'IconClass' => $iconclass,
                    'ButtonClass' => $buttonclass,
                    'OrderSeq' => $orderseq,
                    'status' => $status,
                    'audit_user'=>$audit_user,
                    'audit_date'=>$audit_date
                    );
                    

                    $criteria = array('rowID' => $rowID);
                    // var_dump($criteria);
                    if($rowID>0) {
                        $data = $this->m_wsbangun->updateDataweb('sysmodule',$data, $criteria);
                        // var_dump($data);exit();
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been updated successfully";
                            $st = 'OK';
                        }
            
                    } else {
                        $data = $this->m_wsbangun->insertDataweb('sysmodule',$data);
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
    public function save_assign()
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

     


        
        if($_POST){

            $module = $this->input->post('module',TRUE);
            $group_cd = $this->input->post('group_cd',TRUE);

            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            // var_dump($_POST)
           
            // exit();
            $where=array('group_cd'=>$group_cd);
            $delete = $this->m_wsbangun->deletedata_cons('ifca3','sysModuleUser',$where);
            if($delete=='OK'){
                if(!empty($module)||count($module)>0){
                    // var_dump($staffid);exit();
                    foreach ($module as $key) {
                       
                   
                        $datauserpro = array( 
                            'group_cd' => $group_cd,
                            'moduleID'=>$key,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->insertData_cons('ifca3','sysModuleUser',$datauserpro);
                        if($insert=='OK'){
                            $callback['Error'] = false;
                            $callback['Pesan'] = 'Data saved successfully';
                        }else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = 'Fail inserting sysModuleUser ('.$key.') '.$insert;
                        }
                    }
                }

                $callback['Error'] = false;
                $callback['Pesan'] = 'Data saved successfully';
            }else{
                $callback['Error'] = true;
                $callback['Pesan'] = 'Fail deleting sysModuleUser';
            }

        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid 2';
        }

        echo json_encode($callback);

    }
}