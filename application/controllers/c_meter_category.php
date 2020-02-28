<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_meter_category extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
  
        $param = $this->uri->segment(3);
        $paramDcd = base64_decode($param);
        

        if(empty($paramDcd)) {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname') ;
        } else {
            $email = $this->session->userdata('Tsemail');
            $b = explode("-%-", $paramDcd);
            // $project_no = substr($paramDcd, 0,$a);
            // var_dump($b);
            $project_no = $b[0];
            $projectName = $b[1];
            $dbprofile = $b[2];
            // var_dump($b);exit()
;            
            
            
            $Squery ="select max(entity_cd) as entity_cd ,max(entity_name) as entity_name from mgr.v_cfs_user_project where project_no ='$project_no' ";            
            $dd = $this->m_wsbangun->getData_by_query_cons($dbprofile,$Squery);
            // var_dump($Squery);var_dump($dd);
            $entity = $dd[0]->entity_cd;
            $entity_name = $dd[0]->entity_name;

       
            $position ='T';
 
            $this->session->set_userdata('TMenuPs',$position);
            $this->session->set_userdata('Tsentityname',$entity_name);
            $this->session->set_userdata('Tsentity', $entity);              
            $this->session->set_userdata('Tsproject', $project_no);            
            $this->session->set_userdata('Tsprojectname', $projectName);
            $this->session->set_userdata('Tscons', $dbprofile);
        }      
        
        $cons = $this->session->userdata('Tscons');
        $user_id = $this->session->userdata('Tsname');
        $user_email = $this->session->userdata('Tsemail'); 
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $content = array(
            'projectName'=>$projectName,);
        
        $this->load_content_top_menu('meter_category/index',$content);
    }
    

    
    public function save(){
        $msg="";
        if (isset($_POST)) {
            $cd                 = $this->input->post('cd');
            $project_no         = $this->session->userdata('Tsproject');
            $entity_cd          = $this->session->userdata('Tsentity');
            $category_cd        = $this->input->post('category_cd', true);   
            // var_dump($category_cd);exit;
            $category_name      = $this->input->post('category_name', true);
            $capacity_rate      = $this->input->post('capacity_rate',TRUE);

            $parts = explode('.', (int) $capacity_rate);
            $capacity_rate = $parts[0];

            $calculation_method = $this->input->post('calculation_method',TRUE);

            $capacity_given_flag = $this->input->post('capacity_given_flag',TRUE);
            if (!isset($capacity_given_flag)) {
                $capacity_given_flag = "N";
            }

            $limit_usage_flag = $this->input->post('limit_usage_flag',TRUE);
            if (!isset($limit_usage_flag)) {
                $limit_usage_flag = "N";
            }

            $disc_percent   = (float)$this->input->post('disc_percent',TRUE);
            $parts = explode('.', (int) $disc_percent);
            $disc_percent = $parts[0];

            $opr_percent    = (float)$this->input->post('opr_percent',TRUE);
            $parts = explode('.', (int) $opr_percent);
            $opr_percent = $parts[0];

            $min_usage_hour = (float)$this->input->post('min_usage_hour',TRUE);
            $parts = explode('.', (int) $min_usage_hour);
            $min_usage_hour = $parts[0];

            $portion1       = (float)$this->input->post('portion1',TRUE);
            $parts = explode('.', (int) $portion1);
            $portion1 = $parts[0];

            $portion2       = (float)$this->input->post('portion2',TRUE);
            $parts = explode('.', (int) $portion2);
            $portion2 = $parts[0];

            $audit_user = $this->session->userdata('Tsname');
            $audit_date = date('d M Y H:i:s');


            

            $criteria = array(
                'entity_cd'     => $entity_cd,
                'project_no'    => $project_no,
                'category_cd'   => $category_cd
            );

            if ($cd>0) {
                $data = array(
                    // 'entity_cd'             => $entity_cd,
                    // 'project_no'            => $project_no,
                    // 'category_cd'           => $category_cd,

                    'category_name'         => $category_name,
                    'capacity_rate'         => $capacity_rate,
                    'calculation_method'    => $calculation_method,
                    'capacity_given_flag'   => $capacity_given_flag,
                    'limit_usage_flag'      => $limit_usage_flag,
                    'disc_percent'          => $disc_percent,
                    'opr_percent'           => $opr_percent,
                    'min_usage_hour'        => $min_usage_hour,
                    'portion1'              => $portion1,
                    'portion2'              => $portion2,

                    'audit_user'            => $audit_user,
                    'audit_date'            => $audit_date
                );
                // var_dump($data);
                $update = $this->m_wsbangun->updateData_cons('ifca','pm_meter_category',$data, $criteria);
                if($update == 'OK')
                {
                    $msg="Data has been updated successfully";
                    $psn = "OK";
                } else {
                    $msg= $update;
                    $psn = "Failed";
                }
            }else{
                $data = array(
                    'entity_cd'             => $entity_cd,
                    'project_no'            => $project_no,
                    'category_cd'           => $category_cd,

                    'category_name'         => $category_name,
                    'capacity_rate'         => $capacity_rate,
                    'calculation_method'    => $calculation_method,
                    'capacity_given_flag'   => $capacity_given_flag,
                    'limit_usage_flag'      => $limit_usage_flag,
                    'disc_percent'          => $disc_percent,
                    'opr_percent'           => $opr_percent,
                    'min_usage_hour'        => $min_usage_hour,
                    'portion1'              => $portion1,
                    'portion2'              => $portion2,

                    'audit_user'            => $audit_user,
                    'audit_date'            => $audit_date
                );
                // var_dump($data);
                $insert = $this->m_wsbangun->insertData_cons('ifca','pm_meter_category',$data);
                if($insert == 'OK')
                {
                    $msg="Data has been saved successfully";
                    $psn = true;
                } else {
                    $msg= $insert;
                    $psn = false;
                }
            }
        } else {
            $msg="Data validation is not valid";
        }
        
        $msg1=array(
            "Pesan"=>$msg,
            "status"=>$psn
        );
        // var_dump($data);
        echo json_encode($msg1);
    }
    
    public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        
        $entity = $this->session->userdata('Tsentity');
        // $ov_date = $this->input->post('ov_date',true);
        // $ov_timestart = date('Y M d H:i:s', strtotime($ov_date));
        // var_dump($ov_timestart);
        // exit();
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $this->load->library('Datatables');
        $cons ='ifca';
        $DB2 = $this->load->database('ifca3', TRUE);
        $DB1 = $this->load->database('ifca', TRUE);


        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','category_cd', 'category_name','capacity_rate', 'calculation_method', 'capacity_given_flag', 'limit_usage_flag','disc_percent','opr_percent','min_usage_hour','portion1','portion2');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.pm_meter_category';

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
        $SordField = ($sortIdColumn==0? 'entity_cd' :$Column[$sortIdColumn]['name']);

        $filter_search='';
        // var_dump($filter_search);exit;
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        // var_dump($filter_search);exit;
        // var_dump($filter_search);
        // $param = " where ot_id > 0 and status ='N' and dateadd(d, datediff(d,0, start_overtime), 0) = CONVERT(DATETIME,'$ov_timestart') ".$filter_search;
        $param = " where entity_cd = '".$entity."' and project_no ='".$project."' ".$filter_search;
        // var_dump($param);exit;
        // var_dump($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);exit;
        $rResult = $this->m_wsbangun->getlisttable_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
        // var_dump($rResult);exit;
        $sql="select count(*) as cnt from ".$sTable." ".$param;
        
        $ts = $DB1->query($sql);
        
        $a = $ts->result()[0]->cnt;
        // var_dump($a);exit;
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

    public function getTableDtl($category_cd="")
    {
        
        // var_dump($category_cd);exit;
        $project = $this->session->userdata('Tsproject');        

        // $ov_date = $this->input->post('ov_date',true);
        // $ov_timestart = date('Y M d H:i:s', strtotime($ov_date));
        // var_dump($ov_timestart);
        // exit();
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $cons ='ifca';
        $DB2 = $this->load->database('ifca3', TRUE);
        $DB1 = $this->load->database('ifca', TRUE);


        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','line_no', 'start_range','end_range', 'capacity_multiplier', 'low_rate', 'high_rate','rate_factor','rowID');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.pm_meter_category_dtl';

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
        $SordField = ($sortIdColumn==0? 'entity_cd' :$Column[$sortIdColumn]['name']);

        $filter_search='';
        // var_dump($filter_search);exit;
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        
        // var_dump($filter_search);exit;
        // var_dump($filter_search);
        // $param = " where ot_id > 0 and status ='N' and dateadd(d, datediff(d,0, start_overtime), 0) = CONVERT(DATETIME,'$ov_timestart') ".$filter_search;
        $param = " where entity_cd = '".$entity."' and project_no ='".$project."' and category_cd = '".$category_cd."'".$filter_search;
        // and category_cd = '".$category_cd."'
        // var_dump($param);exit;
        // var_dump($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);exit;
        $rResult = $this->m_wsbangun->getlisttable_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
        // var_dump($rResult);exit;
        $sql="select count(*) as cnt from ".$sTable." ".$param;
        
        $ts = $DB1->query($sql);
        
        $a = $ts->result()[0]->cnt;
        // var_dump($a);exit;
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


    public function delete()
    {
        $msg="";
        $psn='';
            if ($_POST) 
            {
                $rowID = $this->input->post('rowID', true);  

                $where = array('rowID' => $rowID );
                $psn = $this->m_wsbangun->deletedataweb('pm_meter_category_dtl',$where);                

                if($psn!='OK'){
                    $msg = $psn;
                    $psn = 'Fail';
                }else{
                    $msg = 'Data has been deleted successfully';
                }   
            }
            else
            {
                $msg="Data validation is not valid";
                $psn = 'Fail';
            }

            $msg1= array('Pesan'=>$msg,
                    'Status'=>$psn);
            
        echo json_encode($msg1);
    }
    public function getByID($id=""){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $category_cd = $id;
        $where = array(
            'entity_cd'   => $entity,
            'project_no'  => $project,
            'category_cd' => $id,
        );
        // var_dump($where);exit;
        $data = $this->m_wsbangun->getData_by_criteria_adm_cons('ifca','pm_meter_category',$where);

        echo json_encode($data);
    }
    public function add($id=""){
        $sql = 'select * from mgr.pm_meter_category';
        $sysmail = $this->m_wsbangun->getData_by_querypb_cons('ifca',$sql);


        // var_dump($sysmail);exit();
        // var_dump($);exit();
        
        $content = array(
            'sysmail'=>$sysmail,
            'id'=>$id,
        );
        $this->load_content_top_menu('meter_category/add',$content);

    }
   public function edit(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        // $email = $this->session->userdata('Tsemail');
        $group = $this->session->userdata('Tsusergroup');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        $Business_id = $this->session->userdata('Tsbusinessid');
        // var_dump($entity);
        // var_dump($userID."-- name: ".$name);exit();
      

      $sql = "SELECT  end_ot_time from mgr.ot_spec(nolock)";
        $dt = $this->m_wsbangun->getData_by_query($sql);
        $endhour_OT = date('g A', strtotime(substr ($dt[0]->end_ot_time,11)));
        // var_dump($dupdate);

        if($group!='DEBTOR'){
           
            $dsb = 'false';
         
            $datalot = '';
        }else{
            
            $dsb = 'true';    
            
       
            $datalot = $this->zoom_lot_no($Business_id);

        }
   

        $content = array(
          
            'datalot'=>$datalot,
            'ProjectDescs'=>$projectName);
        
        $this->load->view('overtime/edit',$content);
    }

    public function adddtl($id="",$cd="")
    {
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $category_cd= $cd;
        $rowID      = $id;


        $content = array(
            'entity_cd'     => $entity,
            'project_no'    => $project,
            'category_cd'   => $category_cd,
            'rowID'         => $rowID,
        );
        
        $this->load->view('meter_category/adddtl',$content);
    }

    public function getByrowID($id=""){
        $entity         = $this->session->userdata('Tsentity');
        $project        = $this->session->userdata('Tsproject');
        // $category_cd    = $cd;
        $rowID          = $id;
        $where = array(
            'entity_cd'     => $entity,
            'project_no'    => $project,
            // 'category_cd'   => $category_cd,
            'rowID'         => $rowID,
        );
        // var_dump($where);exit;
        $data = $this->m_wsbangun->getData_by_criteria_adm_cons('ifca','pm_meter_category_dtl',$where);

        echo json_encode($data);
    }

    public function savedtl(){
        $msg="";
        
        if (isset($_POST)) {
            $category_cd        = $this->input->post('category_cd');
            $project_no         = $this->session->userdata('Tsproject');
            $entity_cd          = $this->session->userdata('Tsentity');
            $rowID              = $this->input->post('rowID');
            // var_dump($category_cd);exit;
            $line_no               = $this->input->post('line_no');
            $start_range           = $this->input->post('start_range');
            $parts = explode('.', (int) $start_range);
            $start_range = $parts[0];

            $end_range             = $this->input->post('end_range');
            $parts = explode('.', (int) $end_range);
            $end_range = $parts[0];

            $capacity_multiplier   = $this->input->post('capacity_multiplier');
            $parts = explode('.', (int) $capacity_multiplier);
            $capacity_multiplier = $parts[0];

            $low_rate              = $this->input->post('low_rate');
            $parts = explode('.', (int) $low_rate);
            $low_rate = $parts[0];

            $high_rate             = $this->input->post('high_rate');
            $parts = explode('.', (int) $high_rate);
            $high_rate = $parts[0];

            $rate_factor           = $this->input->post('rate_factor');
            $parts = explode('.', (int) $rate_factor);
            $rate_factor = $parts[0];

            $audit_user = $this->session->userdata('Tsname');
            $audit_date = date('d M Y H:i:s');


            

            $criteria = array(
                'entity_cd'     => $entity_cd,
                'project_no'    => $project_no,
                'category_cd'   => $category_cd,
                'rowID'         => $rowID,
            );

            if ($rowID>0) {
                $data = array(
                    // 'entity_cd'             => $entity_cd,
                    // 'project_no'            => $project_no,
                    // 'category_cd'           => $category_cd,

                    'line_no'               => $line_no,
                    'start_range'           => $start_range,
                    'end_range'             => $end_range,
                    'capacity_multiplier'   => $capacity_multiplier,
                    'low_rate'              => $low_rate,
                    'high_rate'             => $high_rate,
                    'rate_factor'           => $rate_factor,

                    'audit_user'            => $audit_user,
                    'audit_date'            => $audit_date
                );
                // var_dump($data);exit;
                $update = $this->m_wsbangun->updateData_cons('ifca','pm_meter_category_dtl',$data, $criteria);
                if($update == 'OK')
                {
                    $msg="Data has been updated successfully";
                    $psn = true;
                } else {
                    $msg= $update;
                    $psn = false;
                }
            }else{
                $data = array(
                    'entity_cd'             => $entity_cd,
                    'project_no'            => $project_no,
                    'category_cd'           => $category_cd,

                    'line_no'               => $line_no,
                    'start_range'           => $start_range,
                    'end_range'             => $end_range,
                    'capacity_multiplier'   => $capacity_multiplier,
                    'low_rate'              => $low_rate,
                    'high_rate'             => $high_rate,
                    'rate_factor'           => $rate_factor,

                    'multiplier'            => 0,

                    'audit_user'            => $audit_user,
                    'audit_date'            => $audit_date
                );
                // var_dump($data);exit;
                $insert = $this->m_wsbangun->insertData_cons('ifca','pm_meter_category_dtl',$data);
                if($insert == 'OK')
                {
                    $msg="Data has been saved successfully";
                    $psn = true;
                } else {
                    $msg= $insert;
                    $psn = false;
                }
            }
        } else {
            $msg="Data validation is not valid";
        }
        
        $msg1=array(
            "Pesan"=>$msg,
            "status"=>$psn,
        );
        // var_dump($data);
        echo json_encode($msg1);
    }
   
}