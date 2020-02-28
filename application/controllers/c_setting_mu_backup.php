<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Setting_Mu extends Core_Controller
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
    	$cons 	    = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');

        $table 	= 'mu_other_spec';

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
 			'Data'	 => null,
 			'Error'  => false,
 			'Pesan'  => '',
 			'Status' => 200
 		);

 		$entity		= $this->session->userdata('Tsentity');
        $project 	= $this->session->userdata('Tsproject');
        $cons 		= $this->session->userdata('Tscons');

        $id         = $this->input->post('id',TRUE);
        $genchrg    = $this->input->post('genchrg',TRUE);
        $gendesc    = $this->input->post('gendesc',TRUE);
        $demchrg    = $this->input->post('demchrg',TRUE);
        $demdesc 	= $this->input->post('demdesc',TRUE);
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

    // -------- activatemeter --------/
    public function activatemeter()
    {
        $this->load_content_top_menu('setting_mu/activatemeter');
    }

    public function gettablemeteractive()
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
        $aColumns  = array('meter_cd');
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
        $param = " where rowID > 0 ".$filter_search;
        
        $rResult = $this->m_wsbangun->get_results_activatemeter();
        
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
}