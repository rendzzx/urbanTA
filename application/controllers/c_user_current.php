<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_user_current extends Core_Controller{
	public function __construct(){
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
    }

    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
    
        // $sysmail = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql);
        // var_dump($sysmail);exit();
        
        $content = array(
            'project'=>$projectName,
            // 'sysmail'=>$sysmail
        );
        
    	$this->load_content_top_menu('user_current/index',$content);
    }

    public function addnew($id=""){
        
        $sql = 'select * from msdb.dbo.sysmail_profile';
        $sysmail = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql);
        $sq2 = 'select select db_profile from mgr.pl_project from mgr.pl_project';
        $project = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql);


        // var_dump($sysmail);exit();
        
        $content = array(
            'sysmail'=>$sysmail,
            'id'=>$id,
            'project'=>$project
        );
        $this->load_content_top_menu('user_current/addproject',$content);
    }

    public function getByID($rowID=''){
 
        $where=array('rowID'=>$rowID);
        $data = $this->m_wsbangun->getData_by_criteria_adm('pl_project',$where);

        echo json_encode($data);
    }

    public function getTable(){
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);

        //untuk PK diharap diletakan di awal array
       
        $aColumns  = array('row_number','audit_user', 'IpAddress', 'Device', 'LastLogin');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.sysusersession';

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
        $SordField = ($sortIdColumn==0? 'idUserSession' :$Column[$sortIdColumn]['name']);
        $param='';
        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     
            $param =" Where  ".$filter_search;
        }
        // var_dump($filter_search);
        // $param =" Where status='1' ".$filter_search;

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
        if($_POST){
            // var_dump($_POST);exit();
            $id = (int)$this->input->post('id');
            $entity_cd = $this->input->post('entity_cd');
            $project_no = $this->input->post('project_no');
            $descs = $this->input->post('descs');
            $http_add = $this->input->post('http_add');
            $map = $this->input->post('map');
            $hp = $this->input->post('hp');
            $db_profile =$this->input->post('db_profile');
            $sysmail =$this->input->post('sysmail');
            $db_name =$this->input->post('db_name');
            $status =$this->input->post('status');
            $product_cd =$this->input->post('product_cd');
            $pict_name =$this->input->post('picturepath1',TRUE);
            $pict_name = str_replace(' ', '_', $pict_name);
            $pict_pro =$this->input->post('picturepath2',TRUE);
            $pict_pro = str_replace(' ', '_', $pict_pro);
            $seq_no = $this->input->post('seq_no');
            // var_dump($pict_pro);exit();
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            $isFile  =$this->input->post('isFile',TRUE);

      

            if(strpos($pict_name, base_url('img/PlProject/')) !== false || strpos($pict_pro, base_url('img/PlProject/')) !== false) {
                        $data = array(
                        'entity_cd' => $entity_cd,
                        'project_no' => $project_no,
                        'descs' =>$descs,
                        'picture_path' => $pict_name,
                        'picture_url' => $pict_pro,
                        'coordinat_project' => $map,
                        'caption_address'=>$http_add,
                        'handphone' => $hp,
                        'db_profile'=>$db_profile,
                        'db_name'=>$db_name,
                        'status'=>$status,
                        'product_cd'=>$product_cd,
                        'profile_name'=>$sysmail,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date,
                        'seq_no' => $seq_no
                    );    
                    }else{
                        $data = array(          
                        'entity_cd' => $entity_cd,
                        'project_no' => $project_no,
                        'descs' =>$descs,
                        'picture_path' => base_url().'img/PlProject/'.$pict_name,
                        'picture_url' => base_url().'img/PlProject/'.$pict_pro,
                        'caption_address'=>$http_add,
                        'coordinat_project' => $map,
                        'handphone' => $hp,
                        'db_profile'=>$db_profile,
                        'db_name'=>$db_name,
                        'status'=>$status,
                        'product_cd'=>$product_cd,
                        'profile_name'=>$sysmail,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date,
                        'seq_no' => $seq_no
                        );
                    }
                 $criteria = array('RowID' => $id);
                    // var_dump($data);
                    if($id>0) {
                        unset($data['entity_cd']);
                        unset($data['project_no']);
                        $update = $this->m_wsbangun->updateDataweb('pl_project',$data, $criteria);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                    
                    } else {
                        $insert = $this->m_wsbangun->insertDataweb('pl_project',$data);
                        if($insert == 'OK')
                        {
                            $msg="Data has been saved successfully";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                    }
        } else {
            $msg="Data validation is not valid";
            $psn = "Failed";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }
}