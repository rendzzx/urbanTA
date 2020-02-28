<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_setting_ot extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $this->load_content_top_menu('setting_ot/index'); 
    }

    // --------OVERTIME TYPE--------
    public function gettableOTType()
    {
        $project = $this->session->userdata('Tsproject');        
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        // $entity = "ALS";
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        
        $aColumns  = array('rowID','over_cd','descs','trx_type','tax_cd','type');

        $sTable = 'mgr.ot_type';



        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = "desc";
        // $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = "rowID";
        // $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['over_cd']);

        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['over_cd'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        // var_dump($filter_search);
        $param = " where rowID > 0 and entity_cd = '".$entity."' ".$filter_search;
        // var_dump($param);exit;
        $rResult = $this->m_wsbangun->getlisttable_int_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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

        // var_dump($output);exit();
        
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

    public function getTableOTTDtl($cd="")
    {
        
        // var_dump($cd);exit;
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
        $aColumns  = array('row_number','project_no', 'project_descs','zone_cd','over_cd', 'rate', 'rate_descs','rowID');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_ot_rateproject';

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
        $SortdOrder = "desc";
        // $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = "rowID";
        // $SordField = ($sortIdColumn==0? 'project_no' :$Column[$sortIdColumn]['name']);

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
        $param = " where over_cd = '".$cd."'".$filter_search;
        // and cd = '".$cd."'
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

    public function getByIDOTType($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'ot_type';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        // var_dump($data);

        echo json_encode($data);
    }

    public function getOTTDtl($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'ot_rate';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        // var_dump($data);

        echo json_encode($data);
    }

    public function addOTType($id='',$over_cd='')
    {
        $cons   = $this->session->userdata('Tscons');
        
        $sql = 'select * from mgr.ot_type';
        $sysmail = $this->m_wsbangun->getData_by_querypb_cons('ifca',$sql);


        $table  = 'v_ot_typerate';
        $where2 = array('id_type'>0);
        $work = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where2);

        $content = array(
            // 'user'=>$user,
            'sysmail'=>$sysmail,
            'over_cd'=> $over_cd,
            'id'=>$id,
            'work'=>$work,
            'data_trx' => $this->zoomtrx_type(),
            'data_tax' => $this->zoomtax_cd(),
            // 'data_zone' => $this->zoomzone_cd(),
            'data_project'=> $this->zoomproject_descs()
           
        );
        $this->load_content_top_menu('setting_ot/addOTType',$content);
        // $this->load->view('setting_ot/addOTType',$content);
    }

    public function addOTTDtl($id="",$cd="")
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
            'data_project'  => $this->zoomproject_descs(),
            'data_zone'     => $this->zoomzone_cd()
        );
        
        $this->load->view('setting_ot/addOTTypeDtl',$content);
    }

    public function zoomtrx_type()
    {
        // $entity_cd = "ALS";
        $entity_cd = $this->session->userdata('Tsentity');
        // var_dump($entity_cd);
        $cons   = $this->session->userdata('Tscons');
        $sql  = "SELECT mgr.cf_trx_type.trx_type, mgr.cf_trx_type.descs FROM mgr.cf_trx_type WHERE mgr.cf_trx_type.entity_cd = '".$entity_cd."' AND mgr.cf_trx_type.module = 'AR' AND mgr.cf_trx_type.trx_mode = 'D' AND mgr.cf_trx_type.trx_class = 'I' ";
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  
                    $comboProject[] = '<option value="'.$dtProject->trx_type.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }

    public function zoomtax_cd()
    {
        $cons   = $this->session->userdata('Tscons');
        $sql  = "select scheme_cd, descs from mgr.cf_tax_sch_hd (nolock)";
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  
                    $comboProject[] = '<option value="'.$dtProject->scheme_cd.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }

    public function zoomzone_cd()
    {
        $cons   = $this->session->userdata('Tscons');
        $sql  = "select distinct type from mgr.ot_type (nolock)";
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                        if ($dtProject == 'C') {
                            $dtName = 'By Zone';
                        }else{
                            $dtName = 'By Area';
                        }
                    $comboProject[] = '<option value="'.$dtProject->type.'">'.$dtName.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }

    public function zoomproject_descs()
    {
        $cons       = $this->session->userdata('Tscons');
        $entity_cd  = $this->session->userdata('Tsentity');
        // $entity_cd  = "ALS";
        $sql  = "SELECT DISTINCT project_no,descs FROM mgr.pl_project(nolock) WHERE entity_cd = '".$entity_cd."'";
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                        
                    $comboProject[] = '<option value="'.$dtProject->project_no.'">'.$dtProject->project_no." - ".$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }

    public function save_OTType()
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
            $id     = $this->input->post('id',true);
            $over_cd     = $this->input->post('over_cd',true);
            $descs   = $this->input->post('descs',true);
            $trx_type     = $this->input->post('trx_type',true);
            $tax_cd  = $this->input->post('tax_cd',TRUE);
            $type  = $this->input->post('type',TRUE);
            if (!isset($type)) {
                $type = "L";
            }

            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            // var_dump($end_time);exit();

            $table = 'ot_type';

            $criteria = array('rowID' => $id);

            $data = array(
                'entity_cd'         => $entity,
                'over_cd'           => $over_cd,
                'descs'             => $descs,
                'trx_type'          => $trx_type,
                'tax_cd'            => $tax_cd,
                'type'              => $type,
                'audit_date'        => $audit_date,
                'audit_user'        => $audit_user
            );


            if($id > 0) {
                
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                if($update == 'OK')
                {
                    $callback['Pesan'] = "Data has been updated successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $update;
                }
            }
            else{

                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                if($insert == 'OK')
                {
                    $callback['Pesan'] = "Data has been insert successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $insert;
                }
            } 
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

            echo json_encode($callback);
    }

    public function save_OTTDtl()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );
        $entity_cd     = $this->session->userdata('Tsentity');
        // $project    = $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

        if($_POST){
            $project_no     = $this->input->post('project_no',true);
            $zone_cd        = $this->input->post('zone_cd',true);
            $over_cd        = $this->input->post('cd',true);
            if (empty($over_cd)) {
                $Pesan .= " over_cd empty ";
            }
            $by_area         = $this->input->post('by_area',true);
            if (!isset($by_area)) {
                $by_area = "N";
            }
            $rate           = $this->input->post('rate',true);
            $descs          = $this->input->post('descs',TRUE);
            $rowID          = $this->input->post('id',true);
            // var_dump($rowID);exit;
            if (!isset($rowID)) {
                $rowID = 0;
            }

            $audit_user = $this->session->userdata('Tsuname');
            $audit_date = date('d M Y H:i:s');
            // var_dump($end_time);exit();

            $table = 'ot_rate';

            $criteria = array('rowID' => $rowID);

            $data = array(
                'entity_cd'   => $entity_cd,
                'project_no'  => $project_no,
                'zone_cd'     => $zone_cd,
                'over_cd'     => $over_cd,
                'by_area'     => $by_area,
                'rate'        => $rate,
                'descs'       => $descs,
                'audit_date'  => $audit_date,
                'audit_user'  => $audit_user
            );


            if($rowID > 0) {
                
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                if($update == 'OK')
                {
                    $callback['Pesan'] = "Data has been updated successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $update;
                }
            }
            else{

                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                if($insert == 'OK')
                {
                    $callback['Pesan'] = "Data has been insert successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $insert;
                }
            } 
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

            echo json_encode($callback);
    }
    

    // --------WORK HOUR --------
    public function gettableworkhour()
    {
        $project = $this->session->userdata('Tsproject');        
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        
        $aColumns  = array('day_cd','descs','day_type','begin_time','end_time');

        $sTable = 'mgr.cf_workhour';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['day_cd']);

        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['day_cd'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        // var_dump($filter_search);
        $param = " where rowID > 0 ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable_int_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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

        // var_dump($output);exit();
        
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

    public function getByIDworkhour($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'cf_workhour';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        // var_dump($data);

        echo json_encode($data);
    }

    public function addworkhour()
    {
        $cons   = $this->session->userdata('Tscons');
        

        $sql  = " SELECT mgr.cf_workhour.day_cd, mgr.cf_workhour.descs, mgr.cf_workhour.day_type, mgr.cf_workhour.begin_time, mgr.cf_workhour.end_time FROM mgr.cf_workhour";
        $user = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $table  = 'cf_workhour';
        $where2 = array('rowID'>0);
        $work = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where2);


        $content = array(
            'user'=>$user,
            'work'=>$work
           
        );
        $this->load->view('setting_ot/addworkhour',$content);
    }

    public function save_workhour()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );
        $entity     = $this->session->userdata('Tsentity');
        // $project    = $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

        $id         = $this->input->post('id',TRUE); 
        $day_cd     = $this->input->post('day_cd',true);
        $descs   = $this->input->post('descs',true);
        $day_type     = $this->input->post('day_type',true);
        $timein_date  = $this->input->post('timein_date',TRUE);
        $timein_clock  = $this->input->post('timein_clock',TRUE);
        $timeout_date  = $this->input->post('timeout_date',TRUE);
        $timeout_clock  = $this->input->post('timeout_clock',TRUE);
        // $begin_time   = $this->input->post('$timein_date $timein_clock',true);
        $begin_time = date('d M Y H:i:s', strtotime("$timein_date $timein_clock"));
        // $end_time     = $this->input->post('end_time',true);
        $end_time = date('d M Y H:i:s', strtotime("$timeout_date $timeout_clock"));
        // $name       = $this->input->post('name',true);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');
        // var_dump($end_time);exit();

        $table = 'cf_workhour';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'entity_cd'         => $entity,
                'day_cd'            => $day_cd,
                'descs'             => $descs,
                'day_type'          => $day_type,
                'begin_time'        => $begin_time,
                'end_time'          => $end_time,
                'audit_date'        => $audit_date,
                'audit_user'        => $audit_user
                );
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                if($update == 'OK')
                {
                    $callback['Pesan'] = "Data has been updated successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $update;
                }
            }
            else{
                $data = array(
               'entity_cd'         => $entity,
                'day_cd'            => $day_cd,
                'descs'             => $descs,
                'day_type'          => $day_type,
                'begin_time'        => $begin_time,
                'end_time'          => $end_time,
                'audit_date'        => $audit_date,
                'audit_user'        => $audit_user
                );

                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                if($insert == 'OK')
                {
                    $callback['Pesan'] = "Data has been insert successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $insert;
                }
            } 
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

    // --------Overtime Rate --------
     public function gettableOTRate()
    {
        $project = $this->session->userdata('Tsproject');        
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        
        $aColumns  = array('level_no','descs','area');

        $sTable = 'mgr.pm_level';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['level_no']);

        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['level_no'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        // var_dump($filter_search);
        $param = " where rowID > 0 and project_no='".$project."' ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable_int_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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

        // var_dump($output);exit();
        
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

    public function getByIDOTRate($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'pm_level';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        // var_dump($data);

        echo json_encode($data);
    }

    public function addOTRate($rowID="")
    {
        $cons   = $this->session->userdata('Tscons');
        

        $sql  = " SELECT mgr.pm_level.level_no, mgr.pm_level.descs, mgr.pm_level.area FROM mgr.pm_level";
        $user = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $table  = 'pm_level';
        $where2 = array('rowID'>0);
        $work = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where2);


        $content = array(
            'rowID' => $rowID,
            'user'  => $user,
            'work'  => $work
           
        );
        $this->load_content_top_menu('setting_ot/addOTRate',$content);
    }

    public function save_OTRate()
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

        $id         = $this->input->post('id',TRUE); 
        $level_no     = $this->input->post('level_no',true);
        $descs   = $this->input->post('descs',true);
        $area     = $this->input->post('area',true);
        
        // $name       = $this->input->post('name',true);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');
        // var_dump($end_time);exit();

        $table = 'pm_level';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'entity_cd'            => $entity,
                'project_no'        => $project,
                'level_no'         => $level_no,
                
                'descs'             => $descs,
                'area'          => $area,
                
                'audit_date'        => $audit_date,
                'audit_user'        => $audit_user
                );
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                if($update == 'OK')
                {
                    $callback['Pesan'] = "Data has been updated successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $update;
                }
            }
            else{
                $data = array(
               'entity_cd'            => $entity,
                'project_no'        => $project,
                'level_no'         => $level_no,
                
                'descs'             => $descs,
                'area'          => $area,
                
                'audit_date'        => $audit_date,
                'audit_user'        => $audit_user
                );

                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                if($insert == 'OK')
                {
                    $callback['Pesan'] = "Data has been insert successfully";
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $insert;
                }
            } 
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }


    // -------- DELETE --------
    public function delete()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $id     = $this->input->post("id",true);
        $table = $this->input->post("table",true);
        // var_dump($id);exit;
        if ($table == 'ot_type') {
            $where  = array('over_cd'=>$id);
            $data   = $this->m_wsbangun->deletedata_cons($cons,$table,$where);
            $data   = $this->m_wsbangun->deletedata_cons($cons,'ot_rate',$where);
        }

        if ($table == 'ot_rate') {
            $where  = array('rowID'=>$id);
            $data   = $this->m_wsbangun->deletedata_cons($cons,$table,$where);
        }
        
        if(empty($id)){
            $id=0;
        }

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedata_cons($cons,$table,$where);
        $callback['Pesan'] = 'Data has been deleted successfully';
        echo json_encode($callback);
    }
}