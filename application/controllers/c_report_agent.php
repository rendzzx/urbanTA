<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class C_report_agent extends Core_Controller
{
	
	public function __construct()
	{
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
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
	       // }

        $userid = $this->session->userdata('Tsname');
        $sql = "SELECT distinct project_no,project_descs,db_profile from mgr.v_cfs_login_user (nolock) where userid= '$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'" data-cons="'.$dtProject->db_profile.'">'.$dtProject->project_descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
        

	// $sql="select product_cd,descs from mgr.pm_product (NOLOCK) where entity_cd='".$entity."' and project_no='".$project."'";
 //    $ProductData=$this->m_wsbangun->getData_by_query_cons($cons,$sql);

    $sql3="select property_cd,descs from mgr.cf_property (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."'";
        $PropertyData = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

        // $sql3="select lead_cd,lead_name from mgr.cf_lead_Agent (NOLOCK) where entity_cd ='".$entity."'";
        // $leaddata = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

        $sql3="select group_cd,group_name from mgr.cf_agent_hd (NOLOCK) where entity_cd ='".$entity."'";
        $groupData = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

    $ContentAllData = array('project_no'=>$project,
        'ProjectDescs'=>$projectName,
        // 'Product'=>$ProductData,
        'cbProject'=>$comboProject,
        'Property'=>$PropertyData,
        // 'leaddata'=>$leaddata,
        'groupData'=>$groupData
    );
    $group = $this->session->userdata('Tsusergroup');
    // var_dump($group);exit();
    if ($group=='MGM'){
            $this->load_content_mgm('report_agent/index',$ContentAllData);
        }else{
            $this->load_content_top_menu('report_agent/index',$ContentAllData);
        }
    }
public function indexEnquery(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        // var_dump($name);
        // $group_name = $this->session->userdata('');
        // var_dump($entity.' '.$project);
        // exit();
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
        //    }

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
        

    // $sql="select product_cd,descs from mgr.pm_product (NOLOCK) where entity_cd='".$entity."' and project_no='".$project."'";
    // $ProductData=$this->m_wsbangun->getData_by_query($sql);

    $sql3="select property_cd,descs from mgr.cf_property (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."'";
        $PropertyData = $this->m_wsbangun->getData_by_query($sql3);

        // $sql3="select lead_cd,lead_name from mgr.cf_lead_Agent (NOLOCK) where entity_cd ='".$entity."'";
        // $leaddata = $this->m_wsbangun->getData_by_query($sql3);

        $sql3="select group_cd,group_name from mgr.cf_agent_hd (NOLOCK) where entity_cd ='".$entity."'";
        $groupData = $this->m_wsbangun->getData_by_query($sql3);

        $sql4="select lot_type,descs from mgr.cf_lot_type (NOLOCK) where entity_cd ='".$entity."'";
        $lotTypeData = $this->m_wsbangun->getData_by_query($sql4);

        $sql5="select nationality_cd,descs from mgr.cf_nationality (NOLOCK) ";
        $nationality = $this->m_wsbangun->getData_by_query($sql5);
        // var_dump($nationality);
        $sql6="select payment_cd,descs from mgr.rl_payment_plan_hd (NOLOCK) ";
        $PaymentData = $this->m_wsbangun->getData_by_query($sql6);

    $ContentAllData = array('
        project_no'=>$project,
        'ProjectDescs'=>$projectName,
        'Product'=>$ProductData,
        'cbProject'=>$comboProject,
        'Property'=>$PropertyData,
        'leaddata'=>$leaddata,
        'groupData'=>$groupData,
        'lot_type'=>$lotTypeData,
        'nationality'=>$nationality,
        'paymentdata'=>$PaymentData
        );

    $this->load_content_mgm('report_agent/indexEnquery',$ContentAllData);
    }
    public function index_agent(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        // var_dump($name);
        // $group_name = $this->session->userdata('');
        // var_dump($entity.' '.$project);
        // exit();
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
        //    }

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
        

    // $sql="select product_cd,descs from mgr.pm_product (NOLOCK) where entity_cd='".$entity."' and project_no='".$project."'";
    // $ProductData=$this->m_wsbangun->getData_by_query($sql);

    $sql3="select property_cd,descs from mgr.cf_property (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."'";
        $PropertyData = $this->m_wsbangun->getData_by_query($sql3);

        // $sql3="select lead_cd,lead_name from mgr.cf_lead_Agent (NOLOCK) where entity_cd ='".$entity."'";
        // $leaddata = $this->m_wsbangun->getData_by_query($sql3);

        $sql3="select group_cd,group_name from mgr.cf_agent_hd (NOLOCK) where entity_cd ='".$entity."'";
        $groupData = $this->m_wsbangun->getData_by_query($sql3);

    $ContentAllData = array('project_no'=>$project,
        'ProjectDescs'=>$projectName,
        // 'Product'=>$ProductData,
        'cbProject'=>$comboProject,
        'Property'=>$PropertyData,
        'leaddata'=>$leaddata,
        'groupData'=>$groupData);

    $this->load_content_top_menu('report_agent/index_agent',$ContentAllData);
    }

    public function index_principle(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        // $group_name = $this->session->userdata('');
        // var_dump($entity.' '.$project);
        // exit();
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
        //    }

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
        

    // $sql="select product_cd,descs from mgr.pm_product (NOLOCK) where entity_cd='".$entity."' and project_no='".$project."'";
    // $ProductData=$this->m_wsbangun->getData_by_query($sql);

    $sql3="select property_cd,descs from mgr.cf_property (NOLOCK) where entity_cd ='".$entity."' and project_no='".$project."'";
        $PropertyData = $this->m_wsbangun->getData_by_query($sql3);

        $sql3="select lead_cd,lead_name from mgr.cf_lead_Agent (NOLOCK) where entity_cd ='".$entity."'";
        $leaddata = $this->m_wsbangun->getData_by_query($sql3);

        $sql3="select group_cd,group_name from mgr.cf_agent_hd (NOLOCK) where entity_cd ='".$entity."'";
        $groupData = $this->m_wsbangun->getData_by_query($sql3);

    $ContentAllData = array('project_no'=>$project,
        'ProjectDescs'=>$projectName,
        // 'Product'=>$ProductData,
        'cbProject'=>$comboProject,
        'Property'=>$PropertyData,
        'leaddata'=>$leaddata,
        'groupData'=>$groupData);

    $this->load_content_top_menu('report_agent/index_principle',$ContentAllData);
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

    public function zoom_group(){
        if($_POST)
        {
            $leadcd=$this->input->post('leadname',true);
            $projectcd=$this->input->post('project',true);
            $entity = $this->session->userdata('Tsentity');
            // if(empty($projectcd)){
            //     // $project = $this->session->userdata('Tsproject');
            //     $entity = $this->session->userdata('Tsentity');
            // } else {
            //     $project = $projectcd;//onchange
            //     $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$projectcd'";
            //     $datas = $this->m_wsbangun->getData_by_query($sql);
            //     $entity = $datas[0]->entity_cd;
            // }
            if(empty($leadcd)) {
                echo('<option></option>');
            } else {
                // $sql2="select group_cd,group_name from mgr.cf_agent_hd (NOLOCK) where entity_cd ='".$entity."' and lead_cd='".$leadcd."'";
                
                $ProjectData = $this->m_wsbangun->getData_by_query($sql2);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option value="all"></option>';
                    $listProject .= '<option value="all"> All </option>';
                    foreach ($ProjectData as $project) {
                                   
                        $listProject.='<option value="'.$project->group_cd.'">'.$project->group_name.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }

    public function getTable(){

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
        $product = $this->input->post("product",true);
        // $cons = $this->input->post("cons",true);
        // if(empty($cons))
        // {
        //     $cons=$this->session->userdata('Tscons');
        // }
        $pro = $this->input->post("project",true);
        // var_dump($pro);exit();
        $property= $this->input->post("property",true);
        // $leadname=$this->input->post("leadname",true);
        $groupname=$this->input->post("groupname",true);
        $sSearch=$this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $cons=$this->session->userdata('Tscons');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $datas = $this->m_wsbangun->getData_by_queryadm($sql);
            $entity = $datas[0]->entity_cd;
            $cons=$this->input->post("cons",true);
            // var_dump($entity);exit();
        }
        // var_dump($entity);
        // $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database($cons, TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','property_descs','group_name','lot_no','NAMA','sales_date','sales','ref_no','build_up_area','land_area','lot_type_descs','direction_descs','view_descs','payment_plan_descs','sell_price');

        $sTable = "mgr.v_sales_unit_by_agent";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);

        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $addsort = 'product_cd,property_cd,lead_cd,group_cd ';
        $addsort = 'property_cd ';
        $SortdOrder =$order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];

        // $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        $SordField = 'property_cd'; 

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

        $where = '';
        if ($date_end!='all' && $date_start!='all')
        {
            $where = $where." AND sales_date BETWEEN '".$date_start."' AND '".$date_end."'";
        } 
        
        if($property!='all')
        {
            // var_dump('pro');
            $where="AND property_cd='".$property."' ".$where;
        }
        
        // if($leadname!='all')
        // {
        //     // var_dump('b');
        //     $where="AND lead_cd='".$leadname."' ".$where;
        // }
        if($groupname!='all')
        {
        // {var_dump('a');
            $where="AND group_cd='".$groupname."' ".$where;
        }
      
    
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttableagent_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);

        $output = array(
            'draw' => intval($draw),
            
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
    public function getTableEnquery(){

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
        $product = $this->input->post("product",true);
        $pro = $this->input->post("project",true);
        $property= $this->input->post("property",true);
        $leadname=$this->input->post("leadname",true);
        $groupname=$this->input->post("groupname",true);

        $nationality=$this->input->post("nationality",true);
        $lot_type=$this->input->post("lot_type",true);
        $payment_cd=$this->input->post("payment_cd",true);

        $sSearch=$this->input->post("sSearch",true);
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
            // var_dump($entity);
        }
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database('ifca', TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','property_descs','lead_name','group_name','lot_no','NAMA','sales_date','sales','ref_no','build_up_area','land_area','lot_type_descs','direction_descs','view_descs','payment_plan_descs','sell_price','nationality','nationality_descs');

        $sTable = "mgr.v_sales_enquiry";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);

        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $addsort = 'product_cd,property_cd,lead_cd,group_cd ';
        $addsort = 'product_cd,property_cd ';
        $SortdOrder =$order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];

        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        // $SordField = 'property_cd'; 

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

        $where = '';
        if ($date_end!='all' && $date_start!='all')
        {
            $where = $where." AND sales_date BETWEEN '".$date_start."' AND '".$date_end."'";
        } 
        
        if($product!='all')
        {
            // var_dump('$product');
            $where="AND product_cd='".$product."' ".$where;
        }
        if($property!='all')
        {
            // var_dump('pro');
            $where="AND property_cd='".$property."' ".$where;
        }
        
        if($leadname!='all')
        {
            // var_dump('b');
            $where="AND lead_cd='".$leadname."' ".$where;
        }
        if($groupname!='all')
        {
        // {var_dump('a');
            $where="AND group_cd='".$groupname."' ".$where;
        }

         if($nationality!='all')
        {
        // {var_dump('a');
            $where="AND nationality='".$nationality."' ".$where;
        }
         if($lot_type!='all')
        {
        // {var_dump('a');
            $where="AND lot_type='".$lot_type."' ".$where;
        }
         if($payment_cd!='all')
        {
        // {var_dump('a');
            $where="AND payment_cd='".$payment_cd."' ".$where;
        }
      
    
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttableagent($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);

        $output = array(
            'draw' => intval($draw),
            
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

    public function getTableAgent(){

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
        $product = $this->input->post("product",true);
        $pro = $this->input->post("project",true);
        $property= $this->input->post("property",true);
        $leadname=$this->input->post("leadname",true);
        $groupname=$this->input->post("groupname",true);
        $sSearch=$this->input->post("sSearch",true);
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
            // var_dump($entity);
        }
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database('ifca', TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','property_descs','lead_name','group_name','lot_no','NAMA','sales_date','sales','ref_no','build_up_area','land_area','lot_type_descs','direction_descs','view_descs','payment_plan_descs','sell_price');

        $sTable = "mgr.v_sales_unit_by_agent";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);

        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $addsort = 'product_cd,property_cd,lead_cd,group_cd ';
        $addsort = 'product_cd,property_cd ';
        $SortdOrder =$order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];

        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);

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

        $where = '';
        if ($date_end!='all' && $date_start!='all')
        {
            $where = $where." AND sales_date BETWEEN '".$date_start."' AND '".$date_end."'";
        } 
        
        if($product!='all')
        {
            // var_dump('$product');
            $where="AND product_cd='".$product."' ".$where;
        }
        if($property!='all')
        {
            // var_dump('pro');
            $where="AND property_cd='".$property."' ".$where;
        }
        
        if($leadname!='all')
        {
            // var_dump('b');
            $where="AND lead_cd='".$leadname."' ".$where;
        }
        if($groupname!='all')
        {
        // {var_dump('a');
            $where="AND group_cd='".$groupname."' ".$where;
        }
      
    
        $param =" Where staff_in_charge='".$userid."' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttableagent($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);

        $output = array(
            'draw' => intval($draw),
            
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

    public function getTablePrinciple(){

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
        $product = $this->input->post("product",true);
        $pro = $this->input->post("project",true);
        $property= $this->input->post("property",true);
        $leadname=$this->input->post("leadname",true);
        $groupname=$this->input->post("groupname",true);
        $sSearch=$this->input->post("sSearch",true);
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
            // var_dump($entity);
        }
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database('ifca', TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('property_cd', 'lot_no', 'lot_type_descs', 'view_descs', 'NAMA', 'sales', 'payment_plan_descs', 'ref_no', 'property_descs');

        $sTable = "mgr.v_sales_unit_by_agent";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);

        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $addsort = 'product_cd,property_cd,lead_cd,group_cd ';
        $addsort = 'property_cd ';
        $SortdOrder =$order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];

        // $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        $SordField = 'property_cd'; 

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

        $where = '';
        if ($date_end!='all' && $date_start!='all')
        {
            $where = $where." AND sales_date BETWEEN '".$date_start."' AND '".$date_end."'";
        } 
        
        if($product!='all')
        {
            // var_dump('$product');
            $where="AND product_cd='".$product."' ".$where;
        }
        if($property!='all')
        {
            // var_dump('pro');
            $where="AND property_cd='".$property."' ".$where;
        }
        
        if($leadname!='all')
        {
            // var_dump('b');
            $where="AND lead_cd='".$leadname."' ".$where;
        }
        if($groupname!='all')
        {
        // {var_dump('a');
            $where="AND group_cd='".$groupname."' ".$where;
        }
      
    
        $param =" Where sales_spv = '".$userid."' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttableagent($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);

        $output = array(
            'draw' => intval($draw),
            
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