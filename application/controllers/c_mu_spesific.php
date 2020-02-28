<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_mu_spesific extends Core_Controller
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
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        $project = $this->session->userdata('Tsproject');
        // $entity = $this->session->userdata('Tsentity');

        $ContentAllData = array(
                'project'=>$project,
                'ProjectDescs'=>$projectName
             );

        $this->load_content_top_menu('mu_specific/index',$ContentAllData);
    }

    public function getByID($rowID=''){
        
        $cons = $this->session->userdata('Tscons');
        $where=array('rowID'=>$rowID);
        $data = $this->m_wsbangun->getData_by_criteriapb_cons($cons, 'pm_meter',$where);

        echo json_encode($data);

    }

    public function Delete(){

        $cons = $this->session->userdata('Tscons');
        $rowid = $this->input->post("rowid",true);
        if(empty($rowid)){
            $rowid=0;
        }
        $where=array('rowid'=>$rowid);
        $data = $this->m_wsbangun->deletedata_cons($cons,'pm_meter',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
    
    public function getTable()
    {

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $project = $this->session->userdata('Tsproject');   
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        

        //untuk PK diharap diletakan di awal array
        $aColumns  = array('row_number', 'rowID', 'descs', 'category_cd', 'trx_type', 'meter_type');

        $sTable = 'mgr.pm_meter';

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
        $param = " where entity_cd='".$entity."' AND project_no='".$project."'".$filter_search;
        // var_dump($param);
        $cons = $this->session->userdata('Tscons');
        $rResult = $this->m_wsbangun->getlisttable_cons($cons, $sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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



    public function form($trx_type='', $category_cd='', $meter_cd='', $op_trx='', $meter_type='')
    {
        $projectName = $this->session->userdata('Tsprojectname');
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        
        // GET TRX TYPE
        $sqltrx = "SELECT distinct mgr.cf_trx_type.trx_type, mgr.cf_trx_type.descs, mgr.cf_trx_type.trx_type_desc, mgr.cf_trx_type.prefix, mgr.cf_trx_type.trx_mode, mgr.cf_trx_type.acct_type, mgr.cf_trx_type.bank_cd, mgr.cf_document_ctl.auto_gen_flag FROM mgr.cf_document_ctl, mgr.cf_trx_type where ( mgr.cf_document_ctl.entity_cd = mgr.cf_trx_type.entity_cd ) and ( mgr.cf_document_ctl.prefix = mgr.cf_trx_type.prefix ) AND mgr.cf_trx_type.entity_cd='$entity' and mgr.cf_trx_type.module = 'AR' AND mgr.cf_trx_type.trx_mode = 'D' and mgr.cf_trx_type.trx_class = 'I'";   

        $dtTRX = $this->m_wsbangun->getData_by_query_cons($cons,$sqltrx);

        $combotrx[] = '<option value=""></option>';
        if(!empty($dtTRX)) {
                foreach ($dtTRX as $key) {
                  if($trx_type === $key->trx_type) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $combotrx[] = '<option  value="'.$key->trx_type.'" '.$pilih.'>'.$key->trx_type.' - '.$key->trx_type_desc.'</option>';
                }
                $combotrx = implode("", $combotrx);
            }

        // -------------------- GET CATEGORY
        $sqlctg = "SELECT distinct category_cd, category_name FROM mgr.pm_meter_category WHERE entity_cd = '$entity' AND project_no = '$project'";   

        $dtCTG = $this->m_wsbangun->getData_by_query_cons($cons,$sqlctg);

        $comboctg[] = '<option value=""></option>';
        if(!empty($dtCTG)) {
                foreach ($dtCTG as $key) {
                  if($category_cd === $key->category_cd) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboctg[] = '<option  value="'.$key->category_cd.'" '.$pilih.'>'.$key->category_cd.' - '.$key->category_name.'</option>';
                }
                $comboctg = implode("", $comboctg);
            }

        // var_dump($comboctg); exit();
        $sqw = "SELECT DISTINCT meter_cd, meter_type FROM mgr.pm_meter WHERE entity_cd = '$entity' AND project_no = '$project'";
        $getdatas = $this->m_wsbangun->getData_by_querypb_cons($cons,$sqw);
        
        $content = array(
                'project'=>$project,
                'ProjectDescs'=>$projectName,
                'combotrx'=>$combotrx,
                'comboctg'=>$comboctg,
                'meter_cd'=>$meter_cd,
                'meter_type'=>$meter_type
            );

        // var_dump($content); exit();
        // var_dump($meter_cd);exit();
        if(!empty($meter_cd)){
            $this->load_content_top_menu('mu_specific/formeditHD', $content);
        }else{
            $this->load_content_top_menu('mu_specific/form', $content);
        }
        
        
    }

    public function getbyMetercd($meter_cd=''){
        // $nup_type = $this->input->post('nuptype');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        // var_dump($cons);

        
        //data nuptype per db project
        $sql = "SELECT * FROM mgr.pm_meter WITH(NOLOCK) WHERE meter_cd = '$meter_cd'";
        $data1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        // var_dump($data1); exit();
        $content = array('data1' => $data1);

        echo json_encode($content);
    }

    public function formDT($entity=null, $project=null)
    {
        $projectName = $this->session->userdata('Tsprojectname');
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        $project = $this->session->userdata('Tsproject');


        $content = array(
                'project'=>$project,
                'ProjectDescs'=>$projectName
            );

       
        $this->load_content_top_menu('mu_specific/form_detail',$content);
        
    }

    public function getTableDT($meter_cd='')
    {

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $project = $this->session->userdata('Tsproject');   
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        

        //untuk PK diharap diletakan di awal array
        $aColumns  = array('row_number', 'rowID', 'meter_id', 'ref_no', 'curr_date', 'curr_read_high');

        $sTable = 'mgr.pm_lot_meter';

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
        $param = " where entity_cd='".$entity."' AND project_no='".$project."' AND meter_cd='".$meter_cd."'".$filter_search;
        // var_dump($param);
        $cons = $this->session->userdata('Tscons');
        $rResult = $this->m_wsbangun->getlisttable_cons($cons, $sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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

         public function save(){
        
            $msg="";
            if ($_POST) 
            {
                // var_dump($this->input->post());exit();
                $email_user = $this->session->userdata('Tsemail');
                $userID = $this->session->userdata('Tsuser_id');
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
                $cons = $this->session->userdata('Tscons');

                $rowID = $this->input->post('rowid', true);
                $mtrtype = $this->input->post('mtrtype',true);
                $mtrdescs = $this->input->post('mtrdescs',true);
                $multip = $this->input->post('multip',TRUE);
                $trxtype = $this->input->post('trxtype',TRUE);
                $taxsch = $this->input->post('taxsch',TRUE);
                $min_amt = $this->input->post('min_amt',TRUE);
                $catego = $this->input->post('catego',TRUE);
                $mtrtyp = $this->input->post('mtrtyp',TRUE);
                $flags = $this->input->post('flags',TRUE);
                $addmin = $this->input->post('addmin',TRUE);
                $stamps = $this->input->post('stamps',TRUE);
                $sewaflg = $this->input->post('sewaflg',TRUE);
                $optrx = $this->input->post('optrx',TRUE);
                $optax = $this->input->post('optax',TRUE);
                $percent = $this->input->post('percent',TRUE);
                $amounts = $this->input->post('amounts',TRUE);
                $sewatrx = $this->input->post('sewatrx',TRUE);
                $sewatax = $this->input->post('sewatax',TRUE);
                $audit_date = date('Y M d H:i:s');
                $audit_user = $this->session->userdata('Tsname');

                $data = array(          
                
                'entity_cd' => $entity,
                'project_no' => $project,
                'meter_cd' =>$mtrtype,
                'descs' =>$mtrdescs,
                'multiplier' =>$multip,
                'trx_type'=>$trxtype,
                'min_amt'=>$min_amt,
                'category_cd'=>$catego,
                'meter_type'=>$mtrtyp,
                'tax_cd'=>$taxsch,
                'other_chrg'=>$flags,
                'add_min'=>$addmin,
                'stamp_duty'=>$stamps,
                'op_trx'=>$optrx,
                'op_tax_cd'=>$optax,
                'sewage_flaq'=>$sewaflg,
                'sewage_percent'=>$percent,
                'sewage_amt'=>$amounts,
                'sewage_trx'=>$sewatrx,
                'sewage_tax_cd'=>$sewatax,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );

                $where = array('rowID' => $rowID );
                if($rowID==0){
                    $insert = $this->m_wsbangun->insertData_cons($cons,'pm_meter',$data);
                    $msg="Data has been saved successfully";
                }else{
              
                    $insert = $this->m_wsbangun->updateData_cons($cons,'pm_meter',$data,$where);
                    $msg="Data has been updated successfully";
                }

                if($insert !="OK"){
                    $msg= $insert;
                    $psn = 'Fail pm_meter';
                }else{
                    $msg = "Data has been saved successfully";
                    $psn ="OK";
                }
                

            } else {
                $msg="Data validation is not valid";
                $psn='Fail';
            }
            
           $msg1 = array(
                'pesan'=>$msg,
                'status'=>$psn
            );
            
        echo json_encode($msg1);

       
    }


    public function saveDT(){
        
            $msg="";
            if ($_POST) 
            {
                // var_dump($this->input->post());exit();
                $email_user = $this->session->userdata('Tsemail');
                $userID = $this->session->userdata('Tsuser_id');
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
                $cons = $this->session->userdata('Tscons');

                $rowID = $this->input->post('rowid', true);
                $mtrtype = $this->input->post('mtrtype',true);
                $mtrdescs = $this->input->post('mtrdescs',true);
                $multip = $this->input->post('multip',TRUE);
                $trxtype = $this->input->post('trxtype',TRUE);
                $taxsch = $this->input->post('taxsch',TRUE);
                $min_amt = $this->input->post('min_amt',TRUE);
                $catego = $this->input->post('catego',TRUE);
                $mtrtyp = $this->input->post('mtrtyp',TRUE);
                $flags = $this->input->post('flags',TRUE);
                $addmin = $this->input->post('addmin',TRUE);
                $stamps = $this->input->post('stamps',TRUE);
                $sewaflg = $this->input->post('sewaflg',TRUE);
                $optrx = $this->input->post('optrx',TRUE);
                $optax = $this->input->post('optax',TRUE);
                $percent = $this->input->post('percent',TRUE);
                $amounts = $this->input->post('amounts',TRUE);
                $sewatrx = $this->input->post('sewatrx',TRUE);
                $sewatax = $this->input->post('sewatax',TRUE);
                $audit_date = date('Y M d H:i:s');
                $audit_user = $this->session->userdata('Tsname');

                $data = array(          
                
                'entity_cd' => $entity,
                'project_no' => $project,
                'meter_cd' =>$mtrtype,
                'descs' =>$mtrdescs,
                'multiplier' =>$multip,
                'trx_type'=>$trxtype,
                'min_amt'=>$min_amt,
                'category_cd'=>$catego,
                'meter_type'=>$mtrtyp,
                'tax_cd'=>$taxsch,
                'other_chrg'=>$flags,
                'add_min'=>$addmin,
                'stamp_duty'=>$stamps,
                'op_trx'=>$optrx,
                'op_tax_cd'=>$optax,
                'sewage_flaq'=>$sewaflg,
                'sewage_percent'=>$percent,
                'sewage_amt'=>$amounts,
                'sewage_trx'=>$sewatrx,
                'sewage_tax_cd'=>$sewatax,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
                );

                $where = array('rowID' => $rowID );
                if($rowID==0){
                    $insert = $this->m_wsbangun->insertData_cons($cons,'pm_meter',$data);
                    $msg="Data has been saved successfully";
                }else{
              
                    $insert = $this->m_wsbangun->updateData_cons($cons,'pm_meter',$data,$where);
                    $msg="Data has been updated successfully";
                }

                if($insert !="OK"){
                    $msg= $insert;
                    $psn = 'Fail pm_meter';
                }else{
                    $msg = "Data has been saved successfully";
                    $psn ="OK";
                }
                
       
            } else {
                $msg="Data validation is not valid";
                $psn='Fail';
            }
            
           $msg1 = array(
                'pesan'=>$msg,
                'status'=>$psn
            );
            
        echo json_encode($msg1);

       
    }

}
