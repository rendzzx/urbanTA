<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Setting_Cs extends Core_Controller
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
        $this->load_content_top_menu('setting/index');
    }

    // -------- SECTION --------
    public function gettablesection()
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
        
        $aColumns  = array('section_cd','descs');

        $sTable = 'mgr.sv_section';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

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

    public function getByIDsection($id)
    {
    	$cons 	= $this->session->userdata('Tscons');
        $table 	= 'sv_section';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addsection()
    {
        $cons   = $this->session->userdata('Tscons');
    	$this->load->view('setting/addsection');
    }

    public function save_section()
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

        $id 		= $this->input->post('id',TRUE);
        $sectioncd  = $this->input->post('sectioncd',TRUE);
        $descs 		= $this->input->post('descs',TRUE);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $table = 'sv_section';

        $criteria = array('rowID' => $id);

        if($_POST){
        	if($id > 0) {
	            $data = array(
	            'section_cd'	=> $sectioncd,
	            'descs'			=> $descs,
	            'audit_date'	=> $audit_date,
	            'audit_user'	=> $audit_user
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
	            'section_cd'	=> $sectioncd,
	            'descs'			=> $descs,
	            'audit_date'	=> $audit_date,
	            'audit_user'	=> $audit_user
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

    // -------- CATEGORY --------
    public function gettablecategory()
    {
    	$project = $this->session->userdata('Tsproject');    
        $entity     = $this->session->userdata('Tsentity');          
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        
        $aColumns  = array('category_cd','descs','category_priority','user_spv','complain_type','descs_category_group');

        $sTable = "mgr.v_sv_category";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'category_cd' :$Column[$sortIdColumn]['name']);

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
        $param = " where rowID > 0 and entity_cd='$entity' and project_no='$project' ".$filter_search;
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

    public function getByIDcategory($id)
    {
    	$cons 	= $this->session->userdata('Tscons');
        $table 	= 'sv_category';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addcategory()
    {   
        $cons   = $this->session->userdata('Tscons');

        $sql = "SELECT DISTINCT  mgr.sv_labour.staff_id ,mgr.sv_labour.name     
        FROM mgr.sv_labour 
        WHERE mgr.sv_labour.supervisor = 'Y'";

        $sql2 = "SELECT * FROM mgr.sv_category_group";

        $supervisor = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $category_group = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $content = array(
            'supervisor'=>$supervisor,
            'category_group'=>$category_group
        );
    	$this->load->view('setting/addcategory',$content);
    }

    public function save_category()
    {
    	$callback = array(
 			'Data'	 => null,
 			'Error'  => false,
 			'Pesan'  => '',
 			'Status' => 200
 		);
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

        $id         = $this->input->post('id',TRUE);
        $descs      = $this->input->post('descs',true);
        $priority   = $this->input->post('priority',true);
        $spvid      = $this->input->post('spvid',true);
        $complain   = $this->input->post('complain',true);
        $categorygroup   = $this->input->post('categorygroup',true);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $sql        = 'select category_cd from mgr.sv_category order by category_cd';
        $category = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $categorycd = 0;
        foreach ($category as $key) {
            $categorycd = $key->category_cd+1;
        }

        $table = 'sv_category';

        $criteria = array('rowID' => $id);

        if($_POST){
        	if($id > 0) {
	            $data = array(
                'descs'             => $descs,
                'category_priority' => $priority,
                'user_spv'          => $spvid,
                'complain_type'     => $complain,
                'category_group_cd' => $categorygroup,
	            'audit_date'	    => $audit_date,
	            'audit_user'	    => $audit_user
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
	            'category_cd'       => $categorycd,
                'descs'             => $descs,
                'category_priority' => $priority,
                'user_spv'          => $spvid,
                'complain_type'     => $complain,
                'category_group_cd' => $categorygroup,
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

    // -------- SERVICE --------
    public function gettableservice()
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
        
        $aColumns  = array('service_cd','section_cd','category_cd','trx_type','descs','service_day','tax_cd','currency_cd','labour_rate');

        $sTable = 'mgr.sv_master';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'service_cd' :$Column[$sortIdColumn]['name']);

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
        $param = " where rowID > 0 ".$filter_search;
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

    public function getByIDservice($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_master';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addservice()
    {
        $cons   = $this->session->userdata('Tscons');

        $table  = 'sv_section';
        $where1=array('rowID'>0);
        $section = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where1);

        $table  = 'sv_category';
        $where2=array('rowID'>0);
        $category = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where2);

        $table  = 'cf_currency';
        $where3=array('rowID'>0);
        $currency = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where3);

        $sql1="SELECT DISTINCT mgr.cf_trx_type.trx_type,   
        mgr.cf_trx_type.descs,   
        mgr.cf_trx_type.trx_type_desc,   
        mgr.cf_trx_type.prefix,   
        mgr.cf_trx_type.trx_mode,   
        mgr.cf_trx_type.acct_type,     
        mgr.cf_document_ctl.auto_gen_flag  
        FROM mgr.cf_document_ctl,   
        mgr.cf_trx_type  
        WHERE (( mgr.cf_document_ctl.entity_cd = mgr.cf_trx_type.entity_cd ) and  
        ( mgr.cf_document_ctl.prefix = mgr.cf_trx_type.prefix )   
        ) AND mgr.cf_trx_type.entity_cd = '1500' AND mgr.cf_trx_type.module = 'AR' AND mgr.cf_trx_type.trx_class = 'I' 
        ORDER BY mgr.cf_trx_type.trx_type ASC,   
        mgr.cf_trx_type.descs ASC ";

        $trxtype = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);

        $sql2="SELECT distinct mgr.cf_tax_sch_hd.scheme_cd,   
        mgr.cf_tax_sch_hd.descs,   
        mgr.cf_tax_sch_hd.incl_excl
        FROM mgr.cf_tax_sch_dt, mgr.cf_tax_sch_hd
        WHERE ( mgr.cf_tax_sch_dt.scheme_cd = mgr.cf_tax_sch_hd.scheme_cd )
        GROUP BY mgr.cf_tax_sch_hd.scheme_cd,
        mgr.cf_tax_sch_hd.descs, mgr.cf_tax_sch_hd.incl_excl  
        ORDER BY mgr.cf_tax_sch_hd.scheme_cd ASC, 
        mgr.cf_tax_sch_hd.incl_excl ASC ";

        $taxcd = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

        $content = array(
            'section'=>$section,
            'category'=>$category,
            'currency'=>$currency,
            'trxtype'=>$trxtype,
            'taxcd'=>$taxcd
        );

        $this->load->view('setting/addservice',$content);
    }

    public function save_service()
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

        $id          = $this->input->post('id',TRUE);
        $servicecd   = $this->input->post('servicecd',true);
        $sectioncd   = $this->input->post('sectioncd',true);
        $categorycd  = $this->input->post('categorycd',true);
        $trxtype     = $this->input->post('trxtype',true);
        $descs       = $this->input->post('descs',true);
        $hours       = $this->input->post('hours',true);
        $taxcd       = $this->input->post('taxcd',true);
        $currencycd  = $this->input->post('currencycd',true);
        $servicerate = $this->input->post('servicerate',true);
        $audit_date  = date('d M Y H:i:s');
        $audit_user  = $this->session->userdata('Tsuname');
        

        $table = 'sv_master';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'section_cd'    => $sectioncd,
                'category_cd'   => $categorycd,
                'service_cd'    => $servicecd,
                'trx_type'      => $trxtype,
                'descs'         => $descs,
                'service_day'   => $hours,
                'labour_rate'   => $servicerate,
                'currency_cd'   => $currencycd,
                'tax_cd'        => $taxcd,
                'audit_date'    => $audit_date,
                'audit_user'    => $audit_user
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
                'section_cd'    => $sectioncd,
                'category_cd'   => $categorycd,
                'service_cd'    => $servicecd,
                'trx_type'      => $trxtype,
                'descs'         => $descs,
                'service_day'   => $hours,
                'labour_rate'   => $servicerate,
                'currency_cd'   => $currencycd,
                'tax_cd'        => $taxcd,
                'audit_date'    => $audit_date,
                'audit_user'    => $audit_user
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

    // -------- COMPLAIN --------
    public function gettablecomplain()
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
        
        $aColumns  = array('complain_source','descs');

        $sTable = 'mgr.sv_complain_source';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

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

    public function getByIDcomplain($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_complain_source';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addcomplain()
    {
        $cons   = $this->session->userdata('Tscons');
        $this->load->view('setting/addcomplain');
    }

    public function save_complain()
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

    // -------- LABOUR --------
    public function gettablelabour()
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
        
        $aColumns  = array('staff_id','name','div_cd','dept_cd','prefix');

        $sTable = 'mgr.sv_labour';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

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

    public function getByIDlabour($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_labour';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function zoomlabour($id)
    {
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_staff';

        $where=array('staff_id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        echo json_encode($data);

    }

    public function addlabour()
    {
        $cons   = $this->session->userdata('Tscons');

        $table  = 'cf_div';
        $where1=array('rowID'>0);
        $division = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where1);

        $table  = 'cf_dept';
        $where2=array('rowID'>0);
        $departement = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where2);

        $table  = 'sv_category';
        $where3=array('rowID'>0);
        $category = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where3);

        $table  = 'cf_staff';
        $where4 = array('rowID'>0);
        $labour = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where4);

        $content = array(
            'division'=>$division,
            'departement'=>$departement,
            'category'=>$category,
            'labour'=>$labour
        );

        $this->load->view('setting/addlabour',$content);
    }

    public function save_labour()
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

        $id             = $this->input->post('id',TRUE);
        $labourid       = $this->input->post('labourid',true);
        $name           = $this->input->post('name',true);
        // $categorycd     = $this->input->post('categorycd',true);
        $division       = $this->input->post('division',true);
        $departement    = $this->input->post('departement',true);
        $doctype        = $this->input->post('doctype',true);
        $audit_date     = date('d M Y H:i:s');
        $audit_user     = $this->session->userdata('Tsuname');
        

        $table = 'sv_labour';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'staff_id'   => $labourid,
                'name'       => $name,
                'category_cd'=> " ",
                'div_cd'     => $division,
                'dept_cd'    => $departement,
                'prefix'     => $doctype,
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
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
                'staff_id'   => $labourid,
                'name'       => $name,
                'category_cd'=> " ",
                'div_cd'     => $division,
                'dept_cd'    => $departement,
                'prefix'     => $doctype,
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
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

    // -------- ITEM --------
    public function gettableitem()
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
        
        $aColumns  = array('ic_flag','descs','item_cd','trx_type','tax_cd','currency_cd','charge_amt');

        $sTable = 'mgr.sv_charge';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

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

    public function getByIDitem($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_charge';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function additem()
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'cf_currency';
        $where1=array('rowID'>0);
        $currency = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where1);

        $sql="SELECT DISTINCT mgr.cf_trx_type.trx_type,   
        mgr.cf_trx_type.descs,   
        mgr.cf_trx_type.trx_type_desc,   
        mgr.cf_trx_type.prefix,   
        mgr.cf_trx_type.trx_mode,   
        mgr.cf_trx_type.acct_type,     
        mgr.cf_document_ctl.auto_gen_flag  
        FROM mgr.cf_document_ctl,   
        mgr.cf_trx_type  
        WHERE (( mgr.cf_document_ctl.entity_cd = mgr.cf_trx_type.entity_cd ) and  
        ( mgr.cf_document_ctl.prefix = mgr.cf_trx_type.prefix )   
        ) AND mgr.cf_trx_type.entity_cd = '1500' AND mgr.cf_trx_type.module = 'AR' AND mgr.cf_trx_type.trx_class = 'I' 
        ORDER BY mgr.cf_trx_type.trx_type ASC,   
        mgr.cf_trx_type.descs ASC ";

        $trxtype = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql2="SELECT distinct mgr.cf_tax_sch_hd.scheme_cd,   
        mgr.cf_tax_sch_hd.descs,   
        mgr.cf_tax_sch_hd.incl_excl
        FROM mgr.cf_tax_sch_dt, mgr.cf_tax_sch_hd
        WHERE ( mgr.cf_tax_sch_dt.scheme_cd = mgr.cf_tax_sch_hd.scheme_cd )
        GROUP BY mgr.cf_tax_sch_hd.scheme_cd,
        mgr.cf_tax_sch_hd.descs, mgr.cf_tax_sch_hd.incl_excl  
        ORDER BY mgr.cf_tax_sch_hd.scheme_cd ASC, 
        mgr.cf_tax_sch_hd.incl_excl ASC ";

        $taxcd = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

        $content = array(
            'currency'=>$currency,
            'trxtype'=>$trxtype,
            'taxcd'=>$taxcd
        );
        $this->load->view('setting/additem',$content);
    }

    public function save_item()
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
        $itemcd     = $this->input->post('itemcd',true);
        $icflag     = $this->input->post('icflag',true);
        // if ($icflag==null) {
        //     $icflag = 'N';
        // }
        $descs      = $this->input->post('descs',true);
        $trxtype    = $this->input->post('trxtype',true);
        $taxcd      = $this->input->post('taxcd',true);
        $currencycd = $this->input->post('currencycd',true);
        $unitprice  = $this->input->post('unitprice',true);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $table = 'sv_charge';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'item_cd'       => $itemcd,
                'descs'         => $descs,
                'trx_type'      => $trxtype,
                'currency_cd'   => $currencycd,
                'charge_amt'    => $unitprice,
                'ic_flag'       => $icflag,
                'tax_cd'        => $taxcd,
                'audit_date'    => $audit_date,
                'audit_user'    => $audit_user
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
                'item_cd'       => $itemcd,
                'descs'         => $descs,
                'trx_type'      => $trxtype,
                'currency_cd'   => $currencycd,
                'charge_amt'    => $unitprice,
                'ic_flag'       => $icflag,
                'tax_cd'        => $taxcd,
                'audit_date'    => $audit_date,
                'audit_user'    => $audit_user
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

    // -------- FEEDBACK --------
    public function gettablefeedback()
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
        
        $aColumns  = array('code','descs');

        $sTable = 'mgr.sv_feed_back';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

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

    public function getByIDfeedback($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_feed_back';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addfeedback()
    {
        $cons   = $this->session->userdata('Tscons');
        $this->load->view('setting/addfeedback');
    }

    public function save_feedback()
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
        $feedbackcd = $this->input->post('feedbackcd',true);
        $descs      = $this->input->post('descs',true);

        $table = 'sv_feed_back';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'code'  => $feedbackcd,
                'descs' => $descs,
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
                'code'  => $feedbackcd,
                'descs' => $descs,
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

    // -------- ASSIGN --------
    public function gettableassign()
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
        
        $aColumns  = array('user_id','staff_id');

        $sTable = 'mgr.sv_user_assign';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

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

    public function getByIDassign($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_user_assign';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addassign()
    {
        $cons   = $this->session->userdata('Tscons');

        $sql  = "SELECT  mgr.security_users.name , mgr.security_users.description
        FROM mgr.security_users
        WHERE (( mgr.security_users.user_type = 0 ) ) AND mgr.security_users.entity_cd = '1500'
        ORDER BY mgr.security_users.name ASC";
        $user = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $table  = 'cf_staff';
        $where2 = array('rowID'>0);
        $labour = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where2);

        $content = array(
            'user'=>$user,
            'labour'=>$labour
        );
        $this->load->view('setting/addassign',$content);
    }

    public function save_assign()
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
        $userid     = $this->input->post('userid',true);
        $labourid   = $this->input->post('labourid',true);
        // $name       = $this->input->post('name',true);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');
        

        $table = 'sv_user_assign';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'entity_cd'         => $entity,
                'user_id'           => $userid,
                'staff_id'          => $labourid,
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
                'user_id'           => $userid,
                'staff_id'          => $labourid,
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

    // -------- CATEGORY GROUP --------
    public function gettablecategorygroup()
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
        
        $aColumns  = array('category_group_cd','descs');

        $sTable = 'mgr.sv_category_group';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

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

    public function getByIDcategorygroup($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_category_group';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function addcategorygroup()
    {
        $cons   = $this->session->userdata('Tscons');
        $this->load->view('setting/addcategorygroup');
    }

    public function save_categorygroup()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity          = $this->session->userdata('Tsentity');
        $project         = $this->session->userdata('Tsproject');
        $cons            = $this->session->userdata('Tscons');

        $id              = $this->input->post('id',TRUE);
        $categorygroupcd = $this->input->post('categorygroupcd',TRUE);
        $descs           = $this->input->post('descs',TRUE);
        $audit_date      = date('d M Y H:i:s');
        $audit_user      = $this->session->userdata('Tsuname');

        $table = 'sv_category_group';

        $criteria = array('rowID' => $id);

        if($_POST){
            if($id > 0) {
                $data = array(
                'category_group_cd' => $categorygroupcd,
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
                'category_group_cd' => $categorygroupcd,
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
        
        if(empty($id)){
            $id=0;
        }

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedata_cons($cons,$table,$where);
        $callback['Pesan'] = 'Data has been deleted successfully';
        echo json_encode($callback);
    }

    public function backup(){
        $this->load->dbutil();

        $prefs = array(
            'tables'        => array('mgr.v_mu_meter'),   // Array of tables to backup.
            'ignore'        => array(),                     // List of tables to omit from the backup
            'format'        => 'txt',                       // gzip, zip, txt
            'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
            'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
            'newline'       => "\n"                         // Newline character used in backup file
        );

        return $this->dbutil->backup($prefs);
    }
}