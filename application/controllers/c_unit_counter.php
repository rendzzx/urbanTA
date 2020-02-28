<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_unit_counter extends Core_Controller {

    public function __construct(){ 
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_rl_sales_list');
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
        $this->load->model('m_business');
    }
    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');
        $projectName = $this->session->userdata('Tsprojectname');
        if($entity == ''){
            $entity = '2101';
            $project = '210101';
        }
        // $entity = ' 2101'
       
        $userid = $this->session->userdata('Tsname');
        $sql = "SELECT distinct project_no,descs from mgr.v_cfs_user_project (nolock) where userid= '$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query($sql);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
        
        

        $sql3="select product_cd,descs from mgr.pm_product (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."'";
        $ProductData = $this->m_wsbangun->getData_by_query($sql3);

 

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                'Product'=>$ProductData,
                'cbProject'=>$comboProject
                 
             );
        if ($group=='MGM'){
            $this->load_content_mgm('unit_counter/index',$ContentAllData);
        }else{
            $this->load_content_top_menu('unit_counter/index',$ContentAllData);
        }
        
    }
    public function zoom_agent(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        if($_POST)
        {
            $agenttype=$this->input->post('Atypecd',true);
            
            if(empty($agenttype)) {
                echo('<option></option>');
            } else {
                if($agenttype=='I') {
                    $sql2="select distinct agent_cd,agent_name from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project."' and agent_type_cd='I'";
                } else {
                    $sql2="select distinct agent_cd,agent_name from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project."' and agent_type_cd<>'I'";
                }
                $ProjectData = $this->m_wsbangun->getData_by_query($sql2);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->agent_cd.'">'.$project->agent_name.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }
    public function getTable()
    {
        $pro      = $this->input->post("project",true);
        $product  = $this->input->post("product",true);
        $nupcount = $this->input->post("nupcount",true);
        $cons     = $this->session->userdata('Tscons');
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $datas = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
            $entity = $datas[0]->entity_cd;
            
        }

        
        // var_dump($entity);
        
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number', 'lot_no', 'lot_descs','block_descs','nup_counter','zone_descs','direction_descs');
       

        $sTable = "mgr.v_pm_lot_counter";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        $where = '';
        // var_dump($product);exit();
        if($product !='all' && $product !='')
        {
            $where="AND product_cd='".$product."' ".$where;
        }
        if($nupcount!='all' && $nupcount!='')
        {

            if($nupcount=='nol'){
                $where="AND nup_counter=0 ".$where;
            } 
            if($nupcount=='lebih') {
                $where="AND nup_counter>0 ".$where;
            } 
        }


        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ";
        $rResult = $this->m_wsbangun->getlisttablenup_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
    

}
?>