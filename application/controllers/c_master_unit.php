<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_master_unit extends Core_Controller {

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
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
        // }
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

        $sql3="select property_cd,descs from mgr.cf_property (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."'";
        $PropertyData = $this->m_wsbangun->getData_by_query($sql3);

 

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                'Product'=>$ProductData,
                'cbProject'=>$comboProject,
                'Property'=>$PropertyData
                 
             );
        if ($group=='MGM'){
            $this->load_content_mgm('unit_counter/indexmaster',$ContentAllData);
        }else{
            $this->load_content_top_menu('unit_counter/indexmaster',$ContentAllData);
        }
        
    }
    
    public function zoom_property(){
        if($_POST)
        {
            $productcd=$this->input->post('product',true);
            $projectcd=$this->input->post('project',true);
            if(empty($projectcd)){
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
            } else {
                $project = $projectcd;//onchange
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$projectcd'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;
            }
            if(empty($productcd)) {
                echo('<option></option>');
            } else {
                $sql2="select property_cd,descs from mgr.cf_property (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."' and product_cd='".$productcd."'";
                
                $ProjectData = $this->m_wsbangun->getData_by_query($sql2);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->property_cd.'">'.$project->descs.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }
    public function getTable()
    {
        $date_end = $this->input->post("date_end",true);        
        // $endDateVar = $this->input->post("date_end",true);
        // $date_end = new DateTime(substr($endDateVar, 0, 10));
        // $date_end = date("d/m/Y", strtotime($endDateVar));

        if(empty($date_end)){
            $date_end='all';
        }

        $date_start = $this->input->post("date_start",true);
        // $startDateVar = $this->input->post("date_start",true);
        // $date_start = new DateTime(substr($startDateVar, 0, 10));
        // $date_start = date("d/m/Y", strtotime($startDateVar));

        if(empty($date_start)){
            $date_start='all';
        }
        $pro = $this->input->post("project",true);
        $product = $this->input->post("product",true);
        $property = $this->input->post("property",true);
        $status = $this->input->post("status",true);
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            
        }

        
        // var_dump($entity);
        
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number', 'lot_no', 'lot_descs','block_descs','nup_counter','zone_descs','direction_descs','land_area','build_up_area','status_desc');
       

        $sTable = "mgr.v_pm_lot_counter";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $Search = $sSearch['value'];
        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        // $SordField = ('STATUS,reserve_date ASC');
// var_dump($Search);
        // filter
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
        // Select Data

        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        $where = '';
        
        if($product!='all')
        {
            $where="AND product_cd='".$product."' ".$where;
        }
        if($status!='all')
        {
            $where="AND status='".$status."' ".$where;
        }
        if($property!='all')
        {
            $where="AND property_cd='".$property."' ".$where;
        }


        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablenup($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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