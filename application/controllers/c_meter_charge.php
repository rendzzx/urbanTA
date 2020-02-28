<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Meter_Charge extends Core_Controller
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

        // $ha= $this->session->userdata('appsname');
        // var_dump($ha);exit();
    	$this->load_content_top_menu('meter_charge/index');
    }


      
    public function addnew(){
        
 
        $this->load->view('meter_charge/add');

    }
    public function getByCrit($entity_cd='',$project_no=''){
        $cons = $this->session->userdata('Tscons');
        // if(empty($entity_cd)&&empty($project_no)){
        //     $entity = $this->input->post('entity');
        //     $project = $this->input->post('project');      
        // }
        // $entity = $this->input->post('entity');
        // $project = $this->input->post('project');  
     
        $where=array('entity_cd'=>$entity_cd,
                    'project_no'=>$project_no);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'mu_other_spec',$where);

        echo json_encode($data);

    }

    public function delete(){
        $cons = $this->session->userdata('Tscons');
        $entity = $this->input->post('entity');
        $project = $this->input->post('project');  
     
        $where=array('entity_cd'=>$entity,
                    'project_no'=>$project);
        $data = $this->m_wsbangun->deletedata_cons($cons,'mu_other_spec',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
    
    public function getTable()
    {
              
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');  
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'gen_chrg','dem_chrg', 'gen_desc', 'dem_desc');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.mu_other_spec';

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
        $SordField = ($sortIdColumn==0? 'project_no' :$Column[$sortIdColumn]['name']);

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
        $param = " where entity_cd='$entity' and project_no='$project' ".$filter_search;
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
 
    public function save(){
        
            $msg="";
            if ($_POST) 
            {
                $cons = $this->session->userdata('Tscons');
                $entitypost = $this->input->post('entity', true);
                $projectpost = $this->input->post('project',TRUE);
                $entity = trim($this->session->userdata('Tsentity'));
                $project = trim($this->session->userdata('Tsproject'));  
                $gen_chrg = $this->input->post('gen_chrg',TRUE);
                $gen_desc = $this->input->post('gen_desc',TRUE);
                $dem_chrg = $this->input->post('dem_chrg',TRUE);
                $dem_desc = $this->input->post('dem_desc',TRUE);
                

                    $data = array(          
                    'entity_cd' => $entity,
                    'project_no' => $project,
                    'gen_chrg' => (float)$gen_chrg,
                    'dem_chrg' => (float)$dem_chrg,
                    'curr_chrg' => 0,
                    'gen_desc' => $gen_desc,
                    'dem_desc' => $dem_desc                    
                    );
                    
                    $criteria=array('entity_cd'=>$entity,
                    'project_no'=>$project);
                    $cnt = $this->m_wsbangun->getData_by_criteria_cons($cons,'mu_other_spec',$criteria);
                    if(count($cnt)>0) {
                        // unset($data['entity_cd']);
                        // unset($data['project_no']);
                        // var_dump($data);exit();
                        // var_dump($entitypost);var_dump($projectpost);
                        if(empty($entitypost) AND empty($projectpost)){
                            $msg="Data for this project already exist!";
                            $st = 'exist';
                        }else{
                            $update = $this->m_wsbangun->updateData_cons($cons,'mu_other_spec',$data, $criteria);
                            if($update !="OK"){
                                $msg =$update;
                                $st = 'Fail';
                            }else{
                                $msg="Data has been updated successfully";
                                $st = 'OK';
                            }
                        }
                        
            
                    } else {
                        $data = $this->m_wsbangun->insertData_cons($cons,'mu_other_spec',$data);
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