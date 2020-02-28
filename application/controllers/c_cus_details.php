<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_cus_details extends Core_Controller {

    public function __construct(){ 
        parent::__construct();
        $this->auth_check();
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
                'cbproject'=>$comboProject
             );
        if ($group=='MGM'){
            $this->load_content_mgm('cus_summary/indexdetails',$ContentAllData);
        }else{
            $this->load_content_top_menu('cus_summary/indexdetails',$ContentAllData);
        }
        
    }
   
    public function getTable()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        
        $name = $this->session->userdata('Tsuname');
        $prono = $this->input->post("project",true);
        if($prono=='all'||empty($prono))
        {
            $project=$this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');

        } else {
            $project = $prono;//onchange

            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$prono'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            
        }
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','rowid', 'nup_no', 'lot_no','agent_name','group_name','property_descs','nup_counter','name','no_prioritas','company_name');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_nup_unit_prioritas';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = 'property_cd,nup_no,rowid';
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        // $SordField = ('STATUS desc,reserve_date ASC');

     
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

        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."'  ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablecus($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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