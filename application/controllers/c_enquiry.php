<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_enquiry extends Core_Controller {

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
        $cons = $this->session->userdata('Tscons');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
        // }

        $userid = $this->session->userdata('Tsname');
        $sql = "SELECT distinct entity_cd,project_no,project_descs,db_profile from mgr.v_cfs_login_user (nolock) where userid= '$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
       
        if(!empty($proDescs)) {
                $comboProject[] = '';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                    $entity = $dtProject->entity_cd;
                    $project = $dtProject->project_no;
                    $cons = $dtProject->db_profile;
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'" data-cons="'.$dtProject->db_profile.'" >'.$dtProject->project_descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }


		$sql="select lead_cd,lead_name from mgr.cf_lead_agent (NOLOCK) where entity_cd ='".$entity."'";
        $LeadData = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql2="select distinct agent_cd,agent_name from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project."'";
        $AgentData = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

        $sql3="select product_cd,descs from mgr.pm_product (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."'";
        $ProductData = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

        $sql4="select nup_type,descs from mgr.rl_nup_type (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."'";
        $TypeData = $this->m_wsbangun->getData_by_query_cons($cons,$sql4);

        

		$ContentAllData = array(
    			'project_no'=>$project,
                'cbproject'=>$comboProject,
				'ProjectDescs'=>$projectName,
				'Lead'=>$LeadData,
				'Agent'=>$AgentData,
				'Product'=>$ProductData,
				'Type'=>$TypeData
								
             );
        // if ($group=='MGM'){
        //         $this->load_content_mgm('nup_enquiry/index2',$ContentAllData);
        //         $msg ='sukses'; 
        //     }else{
                $this->load_content_top_menu('nup_enquiry/index2',$ContentAllData);
            // }
	}
    public function zoom_agent(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        if($_POST)
        {
            $agenttype=$this->input->post('Atypecd',true);
            $project=$this->input->post('project',true);
            $sql = "SELECT entity_cd,project_no,db_profile from mgr.pl_project (nolock) where project_no = '$project'";
            $proDescs = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
            if(!empty($proDescs)){
                    $entity = $proDescs[0]->entity_cd;
                    $project = $proDescs[0]->project_no;
                    $cons = $proDescs[0]->db_profile;
            }else{
                $entity = $this->session->userdata('Tsentity');
                $project = $this->session->userdata('Tsproject');
                $cons = $this->session->userdata('Tscons');
            }
            if(empty($agenttype)) {
                echo('<option></option>');
            } else {
                if($agenttype=='I') {
                    $sql2="SELECT distinct agent_cd,agent_name from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project."' and agent_type_cd='I'";
                } else {
                    $sql2="SELECT distinct agent_cd,agent_name from mgr.v_listing_nup where entity_cd ='".$entity."' and project_no='".$project."' and agent_type_cd<>'I'";
                }
                $ProjectData = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
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
    	$date_end = $this->input->post("date_end",true); 
        $userid = $this->session->userdata("Tsuname");
       
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
    	$lead = $this->input->post("lead",true);
    	$agent = $this->input->post("agent",true);
        $prono = $this->input->post("project",true);
        $statusnup = $this->input->post("status",true);
    	$product = $this->input->post("product",true);
    	$nuptype = $this->input->post("nuptype",true);
        $CUS = $this->input->post("CUS",true);
    	$sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
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
        
		// var_dump($haha.": ".$entity."  ".$project."  ");
        
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number', 'name', 'descs','agent_name','nup_no');
       

        $sTable = "mgr.v_listing_nup";

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
        if ($date_end!='all' && $date_start!='all')
        {
            $where = $where." AND reserve_date BETWEEN '".$date_start."' AND '".$date_end."'";
        } 
        if ($lead!='all')
        {
            $where = $where." AND lead_cd='".$lead."' ";
        } 
        if ($agent!='all')
        {
            $where = $where." AND agent_cd='".$agent."'";
        }
        if($product!='all')
        {
            $where="AND product_cd='".$product."' ".$where;
        }
        if($statusnup!='all')
        {
            $where="AND STATUS='".$statusnup."' ".$where;
        }
        if($CUS!='all')
        {
            $where="AND choose_unit_status='".$CUS."' ".$where;
        }
        if($nuptype!='all')
        {

            if($nuptype=='G'){
                $where="AND left(nup_type,1)='".$nuptype."' ".$where;
            } 
            if($nuptype=='P') {
                $where="AND left(nup_type,1)='".$nuptype."' ".$where;
            } 
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