<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Setting_Mu extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');
        $this->load->library('ciqrcode');
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');

    }

    public function index()
    {
        $this->load_content_top_menu('setting_mu/index');
    }


    // -------- meterother --------
    public function gettablemeterother()
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
        
        $aColumns  = array('gen_chrg','dem_chrg','gen_desc','dem_desc');

        $sTable = 'mgr.mu_other_spec';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'gen_chrg' :$Column[$sortIdColumn]['name']);

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
        $param = " where gen_chrg > 0 ".$filter_search;
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

    public function getByIDmeterother()
    {
        $cons       = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');

        $table  = 'mu_other_spec';

        $where=array(
            'entity_cd' => $entity,
        );
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addmeterother()
    {
        $cons   = $this->session->userdata('Tscons');
        $this->load->view('setting_mu/addmeterother');
    }

    public function save_meterother()
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
        $genchrg    = $this->input->post('genchrg',TRUE);
        $gendesc    = $this->input->post('gendesc',TRUE);
        $demchrg    = $this->input->post('demchrg',TRUE);
        $demdesc    = $this->input->post('demdesc',TRUE);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $table = 'mu_other_spec';

        $criteria = array('entity_cd' => $entity);

        if($_POST){
            if($id > 0) {
                $data = array(
                    'gen_chrg'     => $genchrg,
                    'gen_desc'     => $gendesc,
                    'dem_chrg'     => $demchrg,
                    'dem_desc'     => $demdesc,
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
                    'gen_chrg'     => $genchrg,
                    'gen_desc'     => $gendesc,
                    'dem_chrg'     => $demchrg,
                    'dem_desc'     => $demdesc,
                    'entity_cd'    => $entity,
                    'project_no'   => $project
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

    // -------- metercategory --------
    public function gettablemetercategory()
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
        
        $aColumns  = array('category_cd','category_name','capacity_rate','calculation_method','capacity_given_flag','limit_usage_flag','disc_percent','opr_percent','min_usage_hour','constant_pln','bts_sub','trafo_rate');

        $sTable = 'mgr.pm_meter_category';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'audit_date' :$Column[$sortIdColumn]['name']);

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
        $param = " where entity_cd > 0  ".$filter_search;
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

    public function getByIDmetercategory($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_complain_source';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getdetail($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'pm_meter_category_dtl';

        $where=array('category_cd'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addmetercategory()
    {
        $cons   = $this->session->userdata('Tscons');
        $this->load->view('setting_mu/addmetercategory');
    }

    public function save_metercategory()
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
        $complaincd = $this->input->post('complaincd',true);
        $descs      = $this->input->post('descs',true);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        // $sql        = 'select complain_source from mgr.sv_complain_source order by complain_source';
        // $complain   = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        // $complaincd = 0;
        // foreach ($complain as $key) {
        //     $complaincd = $key->complain_source+1;
        // }

        $table = 'sv_complain_source';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'complain_source'   => $complaincd,
                'descs'             => $descs,
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
                'complain_source'   => $complaincd,
                'descs'             => $descs,
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

    // -------- meterutilityspecification --------
    public function gettablemeterutilityspecification()
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
        
        // $aColumns  = array('category_cd','category_name','capacity_rate','calculation_method','capacity_given_flag','limit_usage_flag','disc_percent','opr_percent','min_usage_hour','constant_pln','bts_sub','trafo_rate');
        $aColumns  = array('meter_cd', 'descs', 'multiplier', 'trx_type', 'tax_cd', 'min_amt', 'category_cd', 'meter_type', 'other_chrg', 'add_min', 'stamp_duty', 'op_trx', 'op_tax_cd', 'sewage_flaq');

        $sTable = 'mgr.pm_meter';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'audit_date' :$Column[$sortIdColumn]['name']);

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
        $param = " where entity_cd > 0  ".$filter_search;
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

    public function getByIDmeterutilityspecification($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_complain_source';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getdetailutility($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'pm_lot_meter';

        $where=array('meter_cd'=>$id);
        //$where=array('meter_cd'=>'E001');
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addmeterutilityspecification()
    {
        $cons   = $this->session->userdata('Tscons');
        $this->load->view('setting_mu/addmeterutilityspecification');
    }

    public function save_meterutilityspecification()
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
        $complaincd = $this->input->post('complaincd',true);
        $descs      = $this->input->post('descs',true);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        // $sql        = 'select complain_source from mgr.sv_complain_source order by complain_source';
        // $complain   = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        // $complaincd = 0;
        // foreach ($complain as $key) {
        //     $complaincd = $key->complain_source+1;
        // }

        $table = 'sv_complain_source';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'complain_source'   => $complaincd,
                'descs'             => $descs,
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
                'complain_source'   => $complaincd,
                'descs'             => $descs,
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

    // -------- assignmetertolot --------
    public function gettableassignmetertolot()
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
        
        $aColumns  = array('meter_cd', 'ref_no', 'meter_id', 'lot_no', 'debtor_acct', 'capacity', 'capacity_limit');

        $sTable = 'mgr.pm_lot_meter';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'audit_date' :$Column[$sortIdColumn]['name']);

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
        $param = " where entity_cd > 0  ".$filter_search;
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

    public function getByIDassignmetertolot($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_complain_source';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addassignmetertolot()
    {
        $cons   = $this->session->userdata('Tscons');
        $this->load->view('setting_mu/addassignmetertolot');
    }

    public function save_assignmetertolot()
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
        $complaincd = $this->input->post('complaincd',true);
        $descs      = $this->input->post('descs',true);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $table = 'sv_complain_source';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'complain_source'   => $complaincd,
                'descs'             => $descs,
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
                'complain_source'   => $complaincd,
                'descs'             => $descs,
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

    // -------- activatemeter --------/
    public function activatemeter()
    {
        $this->load_content_top_menu('setting_mu/activatemeter');
    }

    public function gettablemeteractive()
    {
        $project = $this->session->userdata('Tsproject');        
        $cons = $this->session->userdata('Tscons');
        // var_dump($cons);exit;
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
         $draw = (int)$this->input->get_post('draw', true);
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        $aColumns  = array('meter_cd');
        // $sTable = 'mgr.v_activate_meter';
        $sTable = 'mgr.pm_lot_meter';
        $order = (int)$this->input->get_post('order', true);

        $Search = $sSearch;
        $sortIdColumn = (int)$order[0]['column'];

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
        $param = " where entity_cd='$entity' and project_no='$project' ".$filter_search;
        $orderby="entity_cd ASC, project_no ASC, meter_cd ASC";
        // $rResult = $this->m_wsbangun->get_results_activatemeter($cons);
        $rResult = $this->m_wsbangun->getlistvieworder_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$orderby,$param);

        $sql="select count(*) as cnt from ".$sTable." ".$param;
        $ts =  $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $a = $ts[0]->cnt;

        $iTotal = $a;
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

    public function getdetailmeteractive($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'pm_lot_meter';

        $where=array('meter_cd'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function updatetoy($id)
    {
        $this->load->database();
        $result='';
        $query = "update mgr.pm_lot_meter set status='Y' where rowID='".$id."'";
        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($query);
        return $result;
        echo json_encode($data);
    }

    public function updateton($id)
    {
        $this->load->database();
        $result='';
        $query = "update mgr.pm_lot_meter set status='N' where rowID='".$id."'";
        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($query);
        return $result;
    }

    public function qr($id)
    // public function index()
    {
        // $id='1';
        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './img/qrcode/cachedir/'; //string, the default is application/cache/
        $config['errorlog']     = './img/qrcode/errorlog/'; //string, the default is application/logs/
        $config['imagedir']     = '/img/qrcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        $this->load->database();
        $result='';
        $query = "select meter_id from mgr.pm_lot_meter where rowID='".$id."'";
        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($query);
        // return $result;
        foreach ($result->result() as $qrr) {
            $image_name=$qrr->meter_id.'.jpg';
        }
        $params['data'] = $qrr->meter_id; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 1024;
        $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

        // echo json_encode(base_url($config['imagedir'].$image_name));
        echo json_encode($image_name);
    }

    public function openbarcode($id)
    {
        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');
        $this->load->database();
        $result='';
        $query = "select meter_id from mgr.pm_lot_meter where rowID='".$id."'";
        // $query = "select meter_id from mgr.pm_lot_meter where rowID='1'";
        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($query);
        // return $result;
        foreach ($result->result() as $qrr) {
            $image_name=$qrr->meter_id;
        }
        $barcodeOptions = array(
            'text' => $image_name,
            'barHeight'=> 100,
            'factor'=>2.3,
        );
        $rendererOptions = array();
        // $config['barcodeurl']     = './testing/openbarcode/'; //direktori penyimpanan qr code
        $barcode=Zend_Barcode::render('code128', 'image', $barcodeOptions, $rendererOptions);

        // echo json_encode($image_name, $barcode);
        // echo json_encode(base_url($config['barcodeurl'].$image_name));
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
        $entity = $this->session->userdata('Tsentity');
        $id     = $this->input->post("id",true);
        $table = $this->input->post("table",true);

        if ($table=='mu_other_spec') {
            $where=array('entity_cd'=>$entity);
            $data = $this->m_wsbangun->deletedata_cons($cons,$table,$where);
        }
        else{
            if(empty($id)){
                $id=0;
            }
            $where=array('rowID'=>$id);
            $data = $this->m_wsbangun->deletedata_cons($cons,$table,$where);
        }
            $callback['Pesan'] = 'Data has been deleted successfully';
            echo json_encode($callback);

    }

    public function meterreading()
    {
        $this->load_content_top_menu('setting_mu/meterreading');
    }

    public function gettablemeterreading()
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
        $aColumns  = array('level_no');
        $sTable = 'mgr.pm_meter_hdr';
        $order = (int)$this->input->get_post('order', true);

        $Search = $sSearch;
        $sortIdColumn = (int)$order[0]['column'];

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
        $param = " where rowID > 0 ".$filter_search;
        
        $rResult = $this->m_wsbangun->get_all_reading();
        
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

    public function getdetailreading($id, $id2)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'pm_meter_dtl';

        $where=array(
            'level_no'=>$id,
            'meter_type'=> $id2);

        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getByIDmeterreading($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_level';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project,
            'level_no' => $id
        );
        
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getByIDmeterreading_metertype($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_meter';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project,
            // 'level_no' => $id
        );
        
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addmeterreading()
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_level';
        $table2  = 'pm_meter';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project
        );

        $where2=array(
            'entity_cd' => $entity,
            'project_no' => $project
        );        

        $level = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        $meter = $this->m_wsbangun->getData_by_criteria_cons($cons,$table2,$where2);

        $content = array(
            'level_no' => $level,
            'meter_type' => $meter
        );

        // $this->load->view('testing2/addmeterreading',$content);
        $this->load->view('setting_mu/addmeterreading',$content);
    }

    public function save_meterreading()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        // $project    = '1502';
        $cons       = $this->session->userdata('Tscons');

        $level_no       = $this->input->post('level_no',TRUE);
        $descs          = $this->input->post('level_descs',TRUE);
        $meter_type     = $this->input->post('meter_type',TRUE);
        $doc_date       = date("d M Y H:i:s",strtotime($this->input->post('doc_date')));
        $read_date      = date("d M Y H:i:s",strtotime($this->input->post('doc_date')));
        $audit_date     = date('d M Y H:i:s');
        $audit_user     = $this->session->userdata('Tsuname');

        $table = 'pm_meter_hdr';
        $table2 = 'pm_meter';
        $table3 = 'pm_lot_meter';
        $table4 = 'pm_meter_category';
        $table5 =  'pm_meter_dtl';

        $criteria = array('entity_cd' => $entity);

        if($_POST)
        {
            $checked = $this->input->post('generatemeter');
            if(isset($checked) == 1)
            {
                $data=array(
                    'level_no'      => $level_no,
                    'descs'         => $descs,
                    'meter_type'    => $meter_type,
                    'doc_date'      => $audit_date, //ganti dengan inputan
                    'read_date'     => $audit_date, //ganti dengan inputan
                    'trx_date'      => $audit_date, //ganti dengan inputan
                    'due_date'      => $audit_date, //ganti dengan inputan
                    'status'        => 'N',
                    'currency_cd'   => 'IDR',
                    'currency_rate' => '1.0000',
                    'audit_user'    => $audit_user,
                    'audit_date'    => $audit_date,
                    'entity_cd'     => $entity,
                    'project_no'    => $project
                );
                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                if($insert == 'OK'){
                    $where2 = array(
                        'meter_type' => $meter_type
                    );
                    $select_pmmeter = $this->m_wsbangun->getData_by_criteria_cons($cons, $table2, $where2);
                    $where3 = array (
                        'meter_cd' => $select_pmmeter[0]->meter_cd
                    );
                    $where4 = array(
                        'entity_cd'     => $entity,
                        'project_no'    => $select_pmmeter[0]->project_no,
                        'category_cd'   => $select_pmmeter[0]->category_cd
                    );
                    $select_pmlotmeter = $this->m_wsbangun->getData_by_criteria_cons($cons, $table3, $where3);
                    $select_pmmetercategory = $this->m_wsbangun->getData_by_criteria_cons($cons, $table4, $where4);
                    // var_dump($select_pmmetercategory);exit();
                    foreach ($select_pmlotmeter as $key){
                        $data2=array(
                            'entity_cd'         => $entity,
                            'project_no'        => $project,
                            'meter_cd'          => $key->meter_cd,
                            'meter_id'          => $key->meter_id,
                            'debtor_acct'       => $key->debtor_acct,
                            'lot_no'            => $key->lot_no,
                            'trx_type'          => $select_pmmeter[0]->trx_type,
                            'doc_no'            => ' ',
                            'read_date'         => $read_date,
                            'doc_date'          => $doc_date,
                            'currency_cd'       => 'IDR',
                            'currency_rate'     => '1.00000',
                            'category_cd'       => $select_pmmeter[0]->category_cd,
                            'tax_cd'            => $select_pmmeter[0]->tax_cd,
                            'last_read'         => $key->curr_read,
                            'curr_read'         => '0.000',
                            'last_read_high'    => $key->curr_read_high,
                            'curr_read_high'    => '0.000',
                            'usage'             => '0.000',
                            'usage_high'        => '0.000',
                            'multiplier'        => $select_pmmeter[0]->multiplier,
                            'calculation_method'=> $select_pmmetercategory[0]->calculation_method,
                            'capacity_given_flag'=> $select_pmmetercategory[0]->capacity_given_flag,
                            'limit_usage_flag'  => $select_pmmetercategory[0]->limit_usage_flag,
                            'capacity'          => $key->capacity,
                            'capacity_limit'    => $key->capacity_limit,
                            'capacity_rate'     => $select_pmmetercategory[0]->capacity_rate,
                            'usage_11'           => '0.00',
                            'usage_21'           => '0.00',
                            'usage_31'           => '0.00',
                            'usage_12'           => '0.00',
                            'usage_22'           => '0.00',
                            'usage_32'           => '0.00',
                            'usage_range1'      => '0.00',
                            'usage_range2'      => '0.00',
                            'usage_range3'      => '0.00',
                            'usage_rate1'       => '0.00',
                            'usage_rate2'       => '0.00',
                            'usage_rate3'       => '0.00',
                            'gen_rate'          => '0.00',
                            'dem_rate'          => '0.00',
                            'base_amt1'         => '0.00',
                            'gen_amt1'          => '0.00',
                            'dem_amt1'          => '0.00',
                            'stamp_amt1'        => '0.00',
                            'base_amt2'         => '0.00',
                            'gen_amt2'          => '0.00',
                            'dem_amt2'          => '0.00',
                            'stamp_amt2'        => '0.00',
                            'trx_amt'           => '0.00',
                            'tax_amt'           => '0.00',
                            'status'            => 'N',
                            'audit_user'        => $audit_user,
                            'audit_date'        => $audit_date,
                            'opr_rate1'         => '0.00000',
                            'opr_rate2'         => '0.00000',
                            'disc_rate1'        => '0.00000',
                            'disc_rate2'        => '0.00000',
                            'level_no'          => $level_no,
                            'meter_type'        => $meter_type,
                            'opr_tax_amt1'      => '0',
                            'opr_tax_amt2'      => '0',
                            'usage_high_rate1'  => '0.00',
                            'usage_high_rate2'  => '0.00',
                            'usage_high_rate3'  => '0.00'
                        );
                        $insert2 = $this->m_wsbangun->insertData_cons($cons,$table5,$data2);
                        if($insert2 == 'OK'){
                            $callback['Pesan'] = 'Data has been insert successfully';
                        } else {
                            $callback['Error'] = true;
                            $callback['Pesan'] = $insert2;
                        }
                    }
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $insert; 
                }
            } 
            else 
            { // not checked
                $data=array(
                    'level_no'      => $level_no,
                    'descs'         => $descs,
                    'meter_type'    => $meter_type,
                    'doc_date'      => $audit_date, //ganti dengan inputan
                    'read_date'     => $audit_date, //ganti dengan inputan
                    'trx_date'      => $audit_date, //ganti dengan inputan
                    'due_date'      => $audit_date, //ganti dengan inputan
                    'status'        => 'N',
                    'currency_cd'   => 'IDR',
                    'currency_rate' => '1.0000',
                    'audit_user'    => $audit_user,
                    'audit_date'    => $audit_date,
                    'entity_cd'     => $entity,
                    'project_no'    => $project
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
        else
        {
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

    public function save_meterreading_detail()
    {
        $entity             = $this->session->userdata('Tsentity');
        $project            = $this->session->userdata('Tsproject');
        $cons               = $this->session->userdata('Tscons');
        $curr_read          = $_POST['curr_read'];
        $usage              = $_POST['usage'];
        $capacity           = $_POST['capacity'];
        $capacity_limit     = $_POST['capacity_limit'];
        $usage11            = $_POST['usage11'];
        $usage21            = $_POST['usage21'];
        $usage_range1       = $_POST['usage_range1'];
        $usage_rate1        = $_POST['usage_rate1'];
        $usage_rate2        = $_POST['usage_rate2'];
        $base_amt1          = $_POST['base_amt1'];
        $trx_amt            = $_POST['trx_amt'];
        $tax_amt            = $_POST['tax_amt'];
        $disc_amt1          = $_POST['disc_amt1'];
        $disc_amt1          = $_POST['disc_amt2'];
        $opr_amt1           = $_POST['opr_amt1'];
        $opr_amt1           = $_POST['opr_amt2'];
        $rowID              = $_POST['rowID'];
        $table              = 'pm_meter_dtl';


        $data       = array(
            'curr_read'     => $curr_read,
            'usage'         => $usage,
            'capacity'      => $capacity,
            'capacity_limit'=> $capacity_limit,
            'usage_11'      => $usage11,
            'usage_21'      => $usage21,
            'usage_range1'  => $usage_range1,
            'usage_rate1'   => $usage_rate1,
            'usage_rate2'   => $usage_rate2,
            'base_amt1'     => $base_amt1,
            'trx_amt'       => $trx_amt,
            'tax_amt'       => $tax_amt,
            'disc_amt1'     => $disc_amt1,
            'disc_amt2'     => $disc_amt2,
            'opr_amt1'      => $opr_amt1,
            'opr_amt2'      => $opr_amt2
        );

        $where      = array(
            'rowID' => $rowID
        );
        // if (isset($_POST['selectData']))
        $update     = $this->m_wsbangun->updateData_cons($cons,$table, $data, $where);
        if($insert == 'OK'){
            $callback['Pesan'] = "Update successfully";
        } else {
            $callback['Pesan'] = "Update Failed";
        }
    }

    public function getpm_meter_category_dtl($category_cd)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_meter_category_dtl';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project,
            'category_cd'=> $category_cd
        );

        $order = 'line_no';

        
        $data = $this->m_wsbangun->getData_by_criteria_cons_ord($cons,$table,$where,$order);

        if ($data) {
            $callback['Data'] = $data;
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = "No Data";
        }

        echo json_encode($callback);
    }

    public function getpm_meter_category($category_cd)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_meter_category';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project,
            'category_cd'=> $category_cd
        );
        
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        if ($data) {
            $callback['Data'] = $data;
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = "No Data";
        }

        echo json_encode($callback);
    }

    public function getpm_meter($meter_cd)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'pm_meter';

        $where=array(
            'entity_cd' => $entity,
            'project_no' => $project,
            'meter_cd'=> $meter_cd
        );
        
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        if ($data) {
            $callback['Data'] = $data;
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = "No Data";
        }

        echo json_encode($callback);
    }

    public function getcf_stamp($invoice)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'cf_stamp';
        $aColumns  = 'stamp_duty';
        
        $data = $this->m_wsbangun->cf_stamp_read($cons, $invoice);
        // $data = $this->m_wsbangun->cf_stamp_read($cons);

        foreach($data->result_array() as $aRow)
        {
            $output = $aRow;
        }
        
        echo json_encode($output);
    }

    public function getcf_tax_sch_hd($scheme_cd)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'cf_tax_sch_hd';

        $where=array(
            'scheme_cd' => $scheme_cd
        );
        
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        if ($data) {
            // $callback['Data'] = $data;
            $callback['Data'] = $data;
        }
        else{
            // $callback['Data'] = $data;
            $callback['Data'] = '0';
            // $callback['Error'] = true;
            // $callback['Pesan'] = "No Data";
        }

        echo json_encode($callback);
    }

    public function getcf_tax_sch_dt($scheme_cd)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');

        $table  = 'cf_tax_sch_dt';

        $where=array(
            'scheme_cd' => $scheme_cd,
            'deduct_flag' => 'N'
        );
        
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        if ($data) {
            // $callback['Data'] = $data;
            $callback['Data'] = $data;
        }
        else{
            $callback['Data'] = '0';
            // $callback['Error'] = true;
            // $callback['Pesan'] = "No Data";
        }

        echo json_encode($callback);
    }

    public function getpm_meter_epcon_view()
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');
        $table  = 'v_distinct_pm_meter_epcon';

        $where=array(
            'entity_cd'=>$entity,
            'project_no'=>$project
        );

        $data = $this->m_wsbangun->getData_by_criteria_cons_distinct($cons,$table,$where);

        echo json_encode($data);
    }

    public function getpm_meter_epcon()
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');
        $table  = 'pm_meter_epcon';

        $where=array(
            'entity_cd'=>$entity,
            'project_no'=>$project
        );

        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getpm_meter_dtl($id, $id2)
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');
        $table  = 'pm_meter_dtl';

        $where=array(
            'entity_cd'=>$entity,
            'project_no'=>$project,
            'meter_type'=>$id,
            'meter_id'=> $id2);

        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function update_pm_meter_dtl($id, $id2, $id3)
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');
        $table  = 'pm_meter_dtl';

        $where=array(
            'entity_cd'=>$entity,
            'project_no'=>$project,
            'meter_type'=>$id,
            'meter_id'=> $id2);

        $data=array(
            'curr_read' => $id3);

        $data = $this->m_wsbangun->updateData_cons($cons,$table,$data, $where);

        echo json_encode($data);
    }

    public function update_pm_meter_dtl2($id, $id2, $id4)
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');
        $table  = 'pm_meter_dtl';

        $where=array(
            'entity_cd'=>$entity,
            'project_no'=>$project,
            'meter_type'=>$id,
            'meter_id'=> $id2);

        $data=array(
            // 'curr_read' => $id3,
            'usage_11' => $id4
        );

        $data = $this->m_wsbangun->updateData_cons($cons,$table,$data, $where);

        echo json_encode($data);
    }

    // public function save_pm_meter_dtl2($id, $id2, $id4, $id5, $id7, $id8, $id9, $id10, $id11, $id12, $id13, $id14, $id15, $id16)
    public function save_pm_meter_dtl_cal3($id, $id2, $id4, $id5, $id6, $id7, $id8, $id9, $id10, $id11, $id12, $id13, $id14, $id15, $id16)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');
        $table  = 'pm_meter_dtl';

        $data       = array(
            // 'curr_read'     => $curr_read,
            'usage'             => $id,
            'capacity'          => $id2,
            'usage_11'          => $id4,
            'usage_21'          => $id5,
            'usage_range1'      => $id6,
            'usage_rate1'       => $id7,
            'usage_rate2'       => $id8,
            'base_amt1'         => $id9,
            'trx_amt'           => $id10,
            'tax_amt'           => $id11,
            'disc_amt1'         => $id12,
            'disc_amt2'         => $id13,
            'opr_amt1'          => $id14,
            'opr_amt2'          => $id15
        );

        $where      = array(
            'entity_cd'=>$entity,
            'project_no' => $project,
            'rowID' => $id16
        );
        // if (isset($_POST['selectData']))
        $update     = $this->m_wsbangun->updateData_cons($cons,$table, $data, $where);
        if($insert == 'OK'){
            $callback['Pesan'] = "Update successfully";
        } else {
            $callback['Pesan'] = "Update Failed";
        }
    }

    public function save_pm_meter_dtl_cal1($id, $id2, $id3, $id4, $id5, $id6, $id7, $id8, $id9, $id10, $id11, $id12)
    // public function save_pm_meter_dtl_cal1($id, $id2, $id3, $id4, $id5, $id6, $id7, $id12)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project     = $this->session->userdata('Tsproject');
        $table  = 'pm_meter_dtl';

        $data       = array(
            // 'curr_read'     => $curr_read,
            'usage'             => $id,
            'usage_11'          => $id2,
            'usage_range1'      => $id3,
            'usage_rate1'       => $id4,
            'usage_rate2'       => $id5,
            'base_amt1'         => $id6,
            'trx_amt'           => $id2,
            'tax_amt'           => $id7,
            'disc_amt1'          => $id8,
            'disc_amt2'         => $id9,
            'opr_amt1'          => $id10,
            'opr_amt2'          => $id11,
        );

        $where      = array(
            'entity_cd'=>$entity,
            'project_no' => $project,
            'rowID' => $id12
        );
        // if (isset($_POST['selectData']))
        $update     = $this->m_wsbangun->updateData_cons($cons,$table, $data, $where);
        if($insert == 'OK'){
            $callback['Pesan'] = "Update successfully";
        } else {
            $callback['Pesan'] = "Update Failed";
        }
    }

    public function save_pm_meter_hdrh($id, $id2, $id3, $id4, $id5, $id6)
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity             = $this->session->userdata('Tsentity');
        $project            = $this->session->userdata('Tsproject');
        $cons               = $this->session->userdata('Tscons');
        $now                = date('d-m-Y');
        $audit_user         = $this->session->userdata('Tsuname');
        $datenya            = rawurldecode($id6);
        $convertDate        = date("d-m-Y", strtotime($datenya));
        $descsnya           = rawurldecode($id5);
        $table              = 'pm_meter_hdr';
        $table2             = 'pm_meter_epcon';
        $tablehis             = 'pm_meter_epcon_his';
        $table3             = 'pm_meter';
        $table4             = 'pm_lot_meter';
        $table5             = 'pm_meter_category';
        $table7             = 'pm_meter_category_dtl';
        $table6             = 'pm_meter_dtl';
        $table8             = 'cf_tax_sch_hd';
        $table9             = 'cf_tax_sch_dt';
        $where2 = array (
            'type'              => $id3,
            'read_date'         => $convertDate,
        );
        $data       = array(
            'entity_cd'     => $id,
            'project_no'    => $id2,
            'level_no'      => $id4,
            'trx_date'      => $now,
            'doc_date'      => $now,
            'due_date'      => $now,
            'read_date'     => $convertDate,
            'descs'         => $descsnya,
            'status'        => 'N',
            'currency_cd'   => 'IDR',
            'currency_rate' => '1.0000',
            'audit_user'    =>  'MGR',
            'audit_date'    => $now,
            'meter_type'    => $id3
        );
        // var_dump($data);
        // exit();
        $insert     = $this->m_wsbangun->insertData_cons($cons,$table, $data);
        if ($insert == 'OK'){

            $where3 = array(
                'meter_type' => $id3
            );

            $select_pmmeter = $this->m_wsbangun->getData_by_criteria_cons($cons, $table3, $where3);
            $where5 = array (
                'category_cd' => $select_pmmeter[0]->category_cd
            );
            $select_pmmetercategory = $this->m_wsbangun->getData_by_criteria_cons($cons, $table5, $where5);
            $select_pmmetercategorydtl = $this->m_wsbangun->getData_by_criteria_cons($cons, $table7, $where5);
            $select_meterepcon = $this->m_wsbangun->getData_by_criteria_cons($cons, $table2, $where2);

            foreach ($select_meterepcon as $keyvalue) {
                $where4 = array(
                    'meter_cd' => $select_pmmeter[0]->meter_cd,
                    'lot_no'   => $keyvalue->lot_no,
                    'meter_id' => $keyvalue->meter_id
                );
                $select_pmlotmeter = $this->m_wsbangun->getData_by_criteria_cons($cons, $table4, $where4);
                // var_dump($select_pmlotmeter);
                // exit();
                $entity_cd = $keyvalue->entity_cd;
                $project_no = $keyvalue->project_no;
                $meter_cd = $select_pmmeter[0]->meter_cd;
                $meter_id = $keyvalue->meter_id;
                $debtor_acct = $select_pmlotmeter[0]->debtor_acct;
                $lot_no = $keyvalue->lot_no;
                $trx_type = $select_pmmeter[0]->trx_type;
                $doc_no = '';
                $read_date = $keyvalue->read_date;
                $doc_date = $now;
                $category_cd       = $select_pmmeter[0]->category_cd;
                $tax_cd       = $select_pmmeter[0]->tax_cd;
                $last_read  = '0.000';
                $curr_read = $keyvalue->curr_read;
                $last_read_high = $last_read  = '0.000';
                $curr_read_high = $keyvalue->curr_read_high;
                $usage        = '0.000';
                $usage_high        = '0.000';
                $multiplier        = $select_pmmeter[0]->multiplier;
                $calculation_method = $select_pmmetercategory[0]->calculation_method;
                $capacity_given_flag = $select_pmmetercategory[0]->capacity_given_flag;
                $limit_usage_flag  = $select_pmmetercategory[0]->limit_usage_flag;
                $capacity = $select_pmlotmeter[0]->capacity;
                $capacity_limit = $select_pmlotmeter[0]->capacity_limit;
                $capacity_rate     = $select_pmmetercategory[0]->capacity_rate;
                $allzero2 = '0';
                $status = 'N';
                $audit_date = $now;
                $level_no = $id4;
                $meter_type = $keyvalue->type;
                $max_reading = $select_pmmeter[0]->max_reading;
                $min_amt = $select_pmmeter[0]->min_amt;
                $other_chrg = $select_pmmeter[0]->other_chrg;
                $add_min = $select_pmmeter[0]->add_min;
                $stamp_duty = $select_pmmeter[0]->stamp_duty;
                $sewage_flag = $select_pmmeter[0]->sewage_flaq;
                $sewage_percent = $select_pmmeter[0]->sewage_percent;
                $sewage_amt = $select_pmmeter[0]->sewage_amt;
                $min_usage_hour = $select_pmmetercategory[0]->min_usage_hour;
                $capacity_multiplier = $select_pmmetercategorydtl[0]->capacity_multiplier;
                $low_rate = $select_pmmetercategorydtl[0]->low_rate;
                $high_rate  = $select_pmmetercategorydtl[0]->high_rate;
                $line_no = $select_pmmetercategorydtl[0]->line_no;
                $start_range = $select_pmmetercategorydtl[0]->start_range;
                $end_range  = $select_pmmetercategorydtl[0]->end_range;

                $datahis = array (
                    'entity_cd'         => $entity_cd,
                    'project_no'        => $project_no,
                    'type'              => $meter_type,
                    'meter_id'          => $meter_id,
                    'lot_no'            => $lot_no,
                    'read_date'         => $read_date,
                    'curr_read'         => $curr_read,
                    'curr_read_high'     => $curr_read_high
                );

                $data2=array(
                    'entity_cd'         => $entity_cd,
                    'project_no'        => $project_no,
                    'meter_cd'          => $meter_cd,
                    'meter_id'          => $meter_id,
                    'debtor_acct'       => $debtor_acct,
                    'lot_no'            => $lot_no,
                    'trx_type'          => $trx_type,
                    'doc_no'            => ' ',
                    'read_date'         => $read_date,
                    'doc_date'          => $doc_date,
                    'currency_cd'       => 'IDR',
                    'currency_rate'     => '1.00000',
                    'category_cd'       => $category_cd,
                    'tax_cd'            => $tax_cd,
                    'last_read'         => $allzero2,
                    'curr_read'         => $curr_read,
                    'last_read_high'    => $last_read_high,
                    'curr_read_high'    => $curr_read_high,
                    'usage'             => $allzero2,
                    'usage_high'        => $allzero2,
                    'multiplier'        => $multiplier,
                    'calculation_method'=> $calculation_method,
                    'capacity_given_flag'=> $capacity_given_flag,
                    'limit_usage_flag'  => $limit_usage_flag,
                    'capacity'          => $capacity,
                    'capacity_limit'    => $capacity_limit,
                    'capacity_rate'     => $capacity_rate,
                    'usage_11'           => '0.00',
                    'usage_21'           => '0.00',
                    'usage_31'           => '0.00',
                    'usage_12'           => '0.00',
                    'usage_22'           => '0.00',
                    'usage_32'           => '0.00',
                    'usage_range1'      => '0.00',
                    'usage_range2'      => '0.00',
                    'usage_range3'      => '0.00',
                    'usage_rate1'       => '0.00',
                    'usage_rate2'       => '0.00',
                    'usage_rate3'       => '0.00',
                    'gen_rate'          => '0.00',
                    'dem_rate'          => '0.00',
                    'base_amt1'         => '0.00',
                    'gen_amt1'          => '0.00',
                    'dem_amt1'          => '0.00',
                    'stamp_amt1'        => '0.00',
                    'base_amt2'         => '0.00',
                    'gen_amt2'          => '0.00',
                    'dem_amt2'          => '0.00',
                    'stamp_amt2'        => '0.00',
                    'trx_amt'           => '0.00',
                    'tax_amt'           => '0.00',
                    'status'            => 'N',
                    'audit_user'        => $audit_user,
                    'audit_date'        => $audit_date,
                    'opr_rate1'         => '0.00000',
                    'opr_rate2'         => '0.00000',
                    'disc_rate1'        => '0.00000',
                    'disc_rate2'        => '0.00000',
                    'level_no'          => $level_no,
                    'meter_type'        => $meter_type,
                    'opr_tax_amt1'      => '0',
                    'opr_tax_amt2'      => '0',
                    'usage_high_rate1'  => '0.00',
                    'usage_high_rate2'  => '0.00',
                    'usage_high_rate3'  => '0.00'
                );
                $insert2     = $this->m_wsbangun->insertData_cons($cons,$table6, $data2);
                if ($insert2 == 'OK'){
                    $whereisis = array (
                        'meter_id' => $meter_id,
                        'lot_no'    => $lot_no,
                        'meter_type' => $meter_type
                    );
                    $select_pmmeterdtl = $this->m_wsbangun->getData_by_criteria_cons($cons, $table6, $whereisis);
                    foreach ($select_pmmeterdtl as $buatan) {
                        $calculation_method = $buatan->calculation_method;
                        $curr_read = $buatan->curr_read;
                        $last_read = $buatan->last_read;
                        $multiplier = $buatan->multiplier;
                        $usage_high = $buatan->usage_high;
                        $meter_cd = $buatan->meter_cd;
                        $lot_no = $buatan->lot_no;
                        $capacity = $buatan->capacity;
                        $disc_rate1 = $buatan->disc_rate1;
                        $gen_rate = $buatan->gen_rate;
                        $dem_rate = $buatan->dem_rate;
                        $opr_rate1  = $buatan->opr_rate1;
                        $tax_cd = $buatan->tax_cd;
                        $opr_tax_cd = $buatan->opr_tax_cd;
                        $rowID = $buatan->rowID;
                        $capacity_limit = $buatan->capacity_limit;
                        $stamp_amt1 = $buatan->stamp_amt1;
                        $rowID = $buatan->rowID;
                        if ($calculation_method == '3'){
                            $usage = (($curr_read - $last_read) * $multiplier);
                            $usage_total = ($usage - $usage_high);
                            $usage_hour = ($usage_total / $capacity);
                            $beban = ($capacity * $capacity_rate);
                            if ($usage_hour < $min_usage_hour){
                                $usage21 = ($capacity * $min_usage_hour * $low_rate);
                                $usage11 = '0';
                                $base_amt1 = ($usage11 + $usage21);
                            } else {
                                $usage11 = ($high_rate * $usage_high);
                                $usage21 = ($low_rate * $usage);
                                $base_amt1 = ($beban + $usage11 +$usage21);
                            }
                            $disc_amt1 = ($base_amt1 * ($disc_rate1/100));
                            if ($other_chrg == 'Y') {
                                if ($gen_rate > 0 ){
                                    $genrate = ($gen_rate / 100);
                                    $gen_amt1 = (($base_amt1 - $disc_amt1) * $genrate);
                                } else {
                                    $gen_amt1 = '0';
                                }
                                if ($dem_rate > 0) {
                                    $demrate = ($dem_rate / 100);
                                    $dem_amt1 = ($demrate * ($base_amt1 + $gen_amt1));
                                } else {
                                    $dem_amt1 = '0';
                                }
                            } else {
                                $gen_amt1 = '0';
                                $dem_amt1 = '0';
                            }
                            $opr_amt1 = ((($base_amt1 - $disc_amt1) + $gen_amt1) * ($opr_rate1/100));
                            if ($stamp_duty == 'N') {
                                $stamp_amt1 = '0';
                                $trx_amt = ($base_amt1 + $gen_amt1 + $dem_amt1 + $stamp_amt1 + $disc_amt1 + $opr_amt1);
                                if ($add_min == 'Y') {
                                    $trx_amt ($trx_amt + $min_amt);
                                }
                                $where6 = array (
                                    'scheme_cd' => $tax_cd
                                );
                                $where99 = array (
                                    'scheme_cd' => $opr_tax_cd
                                );
                                $select_cf_tax_sch_hd = $this->m_wsbangun->getData_by_criteria_cons($cons, $table8, $where6);
                                $select_cf_tax_sch_dt = $this->m_wsbangun->getData_by_criteria_cons($cons, $table9, $where6);
                                $select_cf_tax_sch_hd_opr = $this->m_wsbangun->getData_by_criteria_cons($cons, $table8, $where99);
                                $select_cf_tax_sch_dt_opr = $this->m_wsbangun->getData_by_criteria_cons($cons, $table9, $where99);
                                $incl_excl = $select_cf_tax_sch_hd[0]->incl_excl;
                                $tax_rate = $select_cf_tax_sch_dt[0]->tax_rate;
                                $incl_excl_opr = $select_cf_tax_sch_hd[0]->incl_excl;
                                $tax_rate_opr = $select_cf_tax_sch_dt[0]->tax_rate;
                                if ($incl_excl == 'I') {
                                    $tax_amtnya = (($trx_amt - $stamp_amt1) * (100/(100 + $tax_rate)));
                                    $tax_amt = (($trx_amt - $stamp_amt1) - $tax_amtnya);
                                } else if ($incl_excl == 'E') {
                                    $tax_amt = (($tax_rate/100) * ($trx_amt - $stamp_amt1));
                                }
                                if ($incl_excl_opr == 'I'){
                                    $opr_tax_amtnya = ($opr_amt1 * (100/(100 + $tax_rate_opr)));
                                    $opr_tax_amt = ($opr_amt1 - $opr_tax_amtnya);
                                } else if ($incl_excl_opr == 'E') {
                                    $opr_tax_amt = (($tax_rate_opr/100) * $opr_amt1);
                                }
                                $usage_range1 = '0';
                                $disc_amt2 = '0';
                                $opr_amt2 = '0';
                                $dataupdate = array (
                                    'usage'             => $usage,
                                    'capacity_limit'    => $capacity_limit,
                                    'usage_11'           => $usage11,
                                    'usage_21'           => $usage21,
                                    'usage_rate2'       => $low_rate,
                                    'usage_rate1'       => $high_rate,
                                    'base_amt1'         => $base_amt1,
                                    'trx_amt'           => $trx_amt,
                                    'tax_amt'           => $tax_amt,
                                    'disc_amt1'         => $disc_amt1,
                                    'disc_amt2'         => $disc_amt2,
                                    'opr_amt1'          => $opr_amt1,
                                    'opr_amt2'          => $opr_amt2,
                                );
                                $updatenya     = $this->m_wsbangun->updateData_cons($cons,$table6, $dataupdate, $whereisis);
                                $insert3 = $this->m_wsbangun->insertData_cons($cons,$tablehis, $datahis);
                            } else if ($stamp_duty == 'Y'){
                                $invoice = ($base_amt1 - $disc_amt1 + $opr_amt1 + $gen_amt1);
                                $getcf_stamp = $this->m_wsbangun->cf_stamp_read($cons, $invoice);
                                $stamp_amt1 = $getcf_stamp[0]->stamp_duty;
                                $trx_amt = ($base_amt1 + $gen_amt1 + $dem_amt1 + $stamp_amt1 + $disc_amt1 + $opr_amt1);
                                if ($add_min == 'Y') {
                                    $trx_amt ($trx_amt + $min_amt);
                                }
                                $where6 = array (
                                    'scheme_cd' => $tax_cd
                                );
                                $where99 = array (
                                    'scheme_cd' => $opr_tax_cd
                                );
                                $select_cf_tax_sch_hd = $this->m_wsbangun->getData_by_criteria_cons($cons, $table8, $where6);
                                $select_cf_tax_sch_dt = $this->m_wsbangun->getData_by_criteria_cons($cons, $table9, $where6);
                                $select_cf_tax_sch_hd_opr = $this->m_wsbangun->getData_by_criteria_cons($cons, $table8, $where99);
                                $select_cf_tax_sch_dt_opr = $this->m_wsbangun->getData_by_criteria_cons($cons, $table9, $where99);
                                $incl_excl = $select_cf_tax_sch_hd[0]->incl_excl;
                                $tax_rate = $select_cf_tax_sch_dt[0]->tax_rate;
                                $incl_excl_opr = $select_cf_tax_sch_hd[0]->incl_excl;
                                $tax_rate_opr = $select_cf_tax_sch_dt[0]->tax_rate;
                                if ($incl_excl == 'I') {
                                    $tax_amtnya = (($trx_amt - $stamp_amt1) * (100/(100 + $tax_rate)));
                                    $tax_amt = (($trx_amt - $stamp_amt1) - $tax_amtnya);
                                } else if ($incl_excl == 'E') {
                                    $tax_amt = (($tax_rate/100) * ($trx_amt - $stamp_amt1));
                                }
                                if ($incl_excl_opr == 'I'){
                                    $opr_tax_amtnya = ($opr_amt1 * (100/(100 + $tax_rate_opr)));
                                    $opr_tax_amt = ($opr_amt1 - $opr_tax_amtnya);
                                } else if ($incl_excl_opr == 'E') {
                                    $opr_tax_amt = (($tax_rate_opr/100) * $opr_amt1);
                                }
                                $usage_range1 = '0';
                                $disc_amt2 = '0';
                                $opr_amt2 = '0';
                                $dataupdate = array (
                                    'usage'             => $usage,
                                    'capacity_limit'    => $capacity_limit,
                                    'usage_11'           => $usage11,
                                    'usage_21'           => $usage21,
                                    'usage_rate2'       => $low_rate,
                                    'usage_rate1'       => $high_rate,
                                    'base_amt1'         => $base_amt1,
                                    'trx_amt'           => $trx_amt,
                                    'tax_amt'           => $tax_amt,
                                    'disc_amt1'         => $disc_amt1,
                                    'disc_amt2'         => $disc_amt2,
                                    'opr_amt1'          => $opr_amt1,
                                    'opr_amt2'          => $opr_amt2,
                                );
                                $updatenya     = $this->m_wsbangun->updateData_cons($cons,$table6, $dataupdate, $whereisis);
                                $insert3 = $this->m_wsbangun->insertData_cons($cons,$tablehis, $datahis);
                            }
                        }
                        else if ($calculation_method == '1') {
                            $usage = ($curr_read - $last_read);
                            $usage_total = ($usage - $usage_high);
                            if ($capacity_given_flag == 'N' && $limit_usage_flag){
                                $beban = ($capacity * $capacity_rate);
                            } else if ($capacity_given_flag == 'Y') {
                                if ($capacity <= 0){
                                    alert("Capacity Cannot 0");
                                    $beban = '0';
                                    $usage = '0';
                                } else {
                                    $usage = ((($capacity - $capacity_limit) / $capacity) * $usage);
                                    $beban = (($capacity - $capacity_limit) * $capacity_rate);
                                }
                            }
                            $pass = '1';
                            $pemakaian = '0';
                            if ($start_range == 0){
                                $range = $end_range;
                            } else {
                                $range = (($end_range - $start_range) + 1);
                            }
                            if ($usage_total <= $range) {
                                if ($pass == 1) {
                                    $usage11 = ($usage * $low_rate);
                                    $usage21 = '0.00';
                                    $usage31 = '0.00';
                                    $usage_range1 = $end_range;
                                    $usage_rate1 = $low_rate;
                                } if ($pass == 2) {
                                    $usage21 = ($usage * $low_rate);
                                    $usage11 = '0.00';
                                    $usage31 = '0.00';
                                    $usage_range2 = $end_range;
                                    $usage_rate2 = $low_rate;
                                } if ($pass == 3) {
                                    $usage31 = ($usage * $low_rate);
                                    $usage11 = '0.00';
                                    $usage21 = '0.00';
                                    $usage_range3 = $end_range;
                                    $usage_rate3 = $low_rate;
                                }
                                $pemakaian = ($pemakaian + ($usage_total * $low_rate));
                                $usage = '0';
                            } else {
                                if ($pass == 1) {
                                    $usage11 = ($range * $low_rate);
                                    $usage21 = '0.00';
                                    $usage31 = '0.00';
                                    $usage_range1 = $end_range;
                                    $usage_rate1 = $low_rate;
                                }if ($pass == 2) {
                                    $usage21 = ($range * $low_rate);
                                    $usage11 = '0.00';
                                    $usage31 = '0.00';
                                    $usage_range2 = $end_range;
                                    $usage_rate2 = $low_rate;
                                } if ($pass == 3) {
                                    $usage31 = ($range * $low_rate);
                                    $usage11 = '0.00';
                                    $usage21 = '0.00';
                                    $usage_range3 = $end_range;
                                    $usage_rate3 = $low_rate;
                                }
                            }
                            $pass++;
                            $base_amt1 = ($beban + $pemakaian);
                            $disc_amt1 = ($base_amt1 * ($disc_rate1 /100));
                            if ($other_chrg == 'Y') {
                                if ($gen_rate > 0) {
                                    $gen_amt1 = (($base_amt1 - $disc_amt1) * ($gen_rate/100));
                                } else {
                                    $gen_amt1 = '0';
                                }
                                if ($dem_rate > 0) {
                                    $dem_amt1 = (($dem_rate/100) * ($base_amt1 + $gen_amt1));
                                }
                            } else {
                                $gen_amt1 = '0';
                                $dem_amt1 = '0';
                            }
                            if ($stamp_duty == 'Y') {
                                $invoice = ($base_amt1 - $disc_amt + $opr_amt + $gen_amt1);
                                $getcf_stamp = $this->m_wsbangun->cf_stamp_read($cons, $invoice);
                                $stamp_amt1 = $getcf_stamp[0]->stamp_duty;
                                if ($sewage_flag == 'Y') {
                                    $trx_amt = ($trx_amt + (($sewage_percent/100) * $pemakaian * $sewage_amt));
                                }
                                if ($add_min == 'Y'){
                                    $trx_amt = ($trx_amt + $min_amt);
                                }
                                $disc_amt2 ='0';
                                $opr_amt2 ='0';
                                $where6 = array (
                                    'scheme_cd' => $tax_cd
                                );
                                $where99 = array (
                                    'scheme_cd' => $opr_tax_cd
                                );
                                $select_cf_tax_sch_hd = $this->m_wsbangun->getData_by_criteria_cons($cons, $table8, $where6);
                                $select_cf_tax_sch_dt = $this->m_wsbangun->getData_by_criteria_cons($cons, $table9, $where6);
                                $select_cf_tax_sch_hd_opr = $this->m_wsbangun->getData_by_criteria_cons($cons, $table8, $where99);
                                $select_cf_tax_sch_dt_opr = $this->m_wsbangun->getData_by_criteria_cons($cons, $table9, $where99);
                                $incl_excl = $select_cf_tax_sch_hd[0]->incl_excl;
                                $tax_rate = $select_cf_tax_sch_dt[0]->tax_rate;
                                $incl_excl_opr = $select_cf_tax_sch_hd[0]->incl_excl;
                                $tax_rate_opr = $select_cf_tax_sch_dt[0]->tax_rate;
                                if ($incl_excl == 'E') {
                                    $tax_amt = ($tax_rate/100) * ($trx_amt - $stamp_amt1);
                                } else {
                                    $tax_amt = (($trx_amt - $stamp_amt1) - (($trx_amt - $stamp_amt1) * (100/(100 + $tax_rate))));
                                }
                                if ($opr_rate1 == 0){
                                    $opr_amt1 = '0';
                                } else {
                                    $opr_amt1 = ((($base_amt1 + $gen_amt1 + $dem_amt1) * $opr_rate1/100));
                                }
                                $trx_amt = ($trx_amt + $opr_amt1);
                                if ($incl_excl_opr == 'E') {
                                    $opr_tax_amt = (($tax_rate_opr/100) * $opr_amt1);
                                } else {
                                    $opr_tax_amt = ($opr_amt1 - ($opr_amt1 * (100/(100 + $tax_rate))));
                                }
                                $dataupdate = array (
                                    'usage'             => $usage_total,
                                    'usage_11'           => $trx_amt,
                                    'usage_21'           => $usage21,    
                                    'usage_range1'      => $usage_range1,
                                    'usage_rate1'       => $low_rate,
                                    'usage_rate2'       => $high_rate,
                                    'base_amt1'         => $base_amt1,
                                    'trx_amt'           => $trx_amt,
                                    'tax_amt'           => $tax_amt,
                                    'disc_amt1'         => $disc_amt1,
                                    'disc_amt2'         => $disc_amt2,
                                    'opr_amt1'          => $opr_amt1,
                                    'opr_amt2'          => $opr_amt2,
                                );
                                $updatenya     = $this->m_wsbangun->updateData_cons($cons,$table6, $dataupdate, $whereisis);
                                $insert3 = $this->m_wsbangun->insertData_cons($cons,$tablehis, $datahis);
                            } else if ($stamp_duty == 'N')  {
                                $stamp_amt1 = '0';
                                $trx_amt = ($base_amt1 + $gen_amt1 + $dem_amt1);
                                if ($sewage_flag == 'Y') {
                                    $trx_amt = ($trx_amt + (($sewage_percent/100) * $pemakaian * $sewage_amt));
                                }
                                if ($add_min == 'Y'){
                                    $trx_amt = ($trx_amt + $min_amt);
                                }
                                $disc_amt2 ='0';
                                $opr_amt2 ='0';
                                $where6 = array (
                                    'scheme_cd' => $tax_cd
                                );
                                $where99 = array (
                                    'scheme_cd' => $opr_tax_cd
                                );
                                $select_cf_tax_sch_hd = $this->m_wsbangun->getData_by_criteria_cons($cons, $table8, $where6);
                                $select_cf_tax_sch_dt = $this->m_wsbangun->getData_by_criteria_cons($cons, $table9, $where6);
                                $select_cf_tax_sch_hd_opr = $this->m_wsbangun->getData_by_criteria_cons($cons, $table8, $where99);
                                $select_cf_tax_sch_dt_opr = $this->m_wsbangun->getData_by_criteria_cons($cons, $table9, $where99);
                                $incl_excl = $select_cf_tax_sch_hd[0]->incl_excl;
                                $tax_rate = $select_cf_tax_sch_dt[0]->tax_rate;
                                $incl_excl_opr = $select_cf_tax_sch_hd[0]->incl_excl;
                                $tax_rate_opr = $select_cf_tax_sch_dt[0]->tax_rate;
                                if ($incl_excl == 'E') {
                                    $tax_amt = ($tax_rate/100) * ($trx_amt - $stamp_amt1);
                                } else {
                                    $tax_amt = (($trx_amt - $stamp_amt1) - (($trx_amt - $stamp_amt1) * (100/(100 + $tax_rate))));
                                }
                                if ($opr_rate1 == 0){
                                    $opr_amt1 = '0';
                                } else {
                                    $opr_amt1 = ((($base_amt1 + $gen_amt1 + $dem_amt1) * $opr_rate1/100));
                                }
                                $trx_amt = ($trx_amt + $opr_amt1);
                                if ($incl_excl_opr == 'E') {
                                    $opr_tax_amt = (($tax_rate_opr/100) * $opr_amt1);
                                } else {
                                    $opr_tax_amt = ($opr_amt1 - ($opr_amt1 * (100/(100 + $tax_rate))));
                                }
                                $usage_21 = '0';
                                $dataupdate = array (
                                    'usage'             => $usage_total,
                                    'usage_11'           => $trx_amt,
                                    'usage_21'           => $usage21,    
                                    'usage_range1'      => $usage_range1,
                                    'usage_rate1'       => $low_rate,
                                    'usage_rate2'       => $high_rate,
                                    'base_amt1'         => $base_amt1,
                                    'trx_amt'           => $trx_amt,
                                    'tax_amt'           => $tax_amt,
                                    'disc_amt1'         => $disc_amt1,
                                    'disc_amt2'         => $disc_amt2,
                                    'opr_amt1'          => $opr_amt1,
                                    'opr_amt2'          => $opr_amt2,
                                );
                                $updatenya     = $this->m_wsbangun->updateData_cons($cons,$table6, $dataupdate, $whereisis);
                                $insert3 = $this->m_wsbangun->insertData_cons($cons,$tablehis, $datahis);
                            }
                        }
                    }
                }
            }
        }
    }
}