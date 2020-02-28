<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_customer_info extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }
    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        $project = $this->session->userdata('Tsproject');
        $email = $this->session->userdata('Tsemail');
        $unit = $this->input->post('lot_no',TRUE);
        $business_id=$this->input->post('business_id',TRUE);

        $read_date=$this->input->post('read_date',TRUE);
        $debtor_acct=$this->input->post('debtor_acct',TRUE);
        // var_dump($name);exit();

        // $name = $this->session->userdata('Tsuname');

        $group = $this->session->userdata('Tsusergroup');
        $cons = $this->session->userdata('Tscons');
            
      
        $table = 'securityuserdebtor(nolock)';
        $crit = array('UserId'=>$name);
            // $crit = array('debtor_acct'=>$name);
        $DataMenu = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // var_dump($DataMenu);exit();
        if(empty($DataMenu)){
           
            $dsb = 'false';
            $datadebtor = $this->zoom_debtor("");
            // var_dump($datadebtor);exit();
            $dtunit = '';
            $databusiness = '';
            $comboUnit = '';
            
        }else{
            
            if(count($DataMenu)>0){
                $dsb = 'false';    
            } else {
                $dsb = 'true';    
            }
            $datadebtor = $this->zoom_debtor($DataMenu[0]->Debtor_acct);
            $dtunit = $this->getUnit($DataMenu[0]->Debtor_acct);
            $table = 'v_logindebtor';
            $crit = array('debtor_acct'=>$DataMenu[0]->Debtor_acct);
            $cons = $this->session->userdata('Tscons');
            $dt = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
            $databusiness = $this->getByID($dt[0]->business_id);
            $comboUnit = $this->zoom_lotno($DataMenu[0]->Debtor_acct, 'controller');
            // var_dump($dtunit);exit;
            
        }
        // var_dump($dtunit);exit();

        // $unit = $this->input->post('lot_no',TRUE);

        
        // return $comboUnit;

        // var_dump($pro);exit();

        $month = date("m");
        $year = date("Y");
        $cons = $this->session->userdata('Tscons');

        $param="";
        if(!empty($pro)){
            $project = trim($pro);
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $datas = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $entity = $datas[0]->entity_cd;

        }else{
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
           
        }
        // var_dump($dtunit);
        if(!empty($dtunit)){
            $unit = $dtunit[0]->lot_no;    
        } else{
            $unit = 0;
        }
            $cons = $this->session->userdata('Tscons');
            $param2 = " where  entity_cd='$entity' and project_no='$project' and lot_no='$unit' and read_date >= dateadd(Month,-13,GETDATE())";
            $sql3 = "SELECT * from mgr.v_pm_monthly_utilities  $param2"; 
            // var_dump($sql3);
            $dt3 = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);
        // $dt3=0;
            $stringMonth="'January','February','March','April','May','June','July','August','September','October','November','December'";
            if (!empty($dt3)) {
                   
                    $data_E ='';//"['Income Amount',";
                    $data_W ='';
                    $data_G ='';
                    $datamonth='';
                    foreach ($dt3 as $key => $row) {
                        if($row->meter_type=='E') {
                            $data_E.= $row->usages.',';
                        } else if($row->meter_type=='W') {
                            $data_W.= $row->usages.',';
                        } else{
                            $data_G.= $row->usages.',';
                        }

                    }
                    $arrayMonth = ['','January','February','March','April','May','June','July','August','September','October','November','December'];

                    foreach ($dt3 as $key => $row) {
                        $period_distinct[]=$row->period;
                        
                    }
                        $month = array_unique($period_distinct);
                        // var_dump($month);
                        foreach ($month as $key) {
                            $datamonth .= '"'.$arrayMonth[(int)substr($key,0,2)].' '.(int)substr($key,3,4).'",';
                            // $datamonth .= '"'.$arrayMonth[$key].'",';
                        }
                       
                    $data_E=substr($data_E,0,-1);
                    $data_W=substr($data_W,0,-1);
                    $data_G=substr($data_G,0,-1);
                    $datamonth=substr($datamonth,0,-1);

                    // var_dump($datamonth);exit();
                    $bar='';
                    $bar.='var barprop = c3.generate({bindto: "#barproperty",padding: {bottom: 20,top:10},';
                    $bar.='data: {';
                    $bar .=" x:'x',columns:[  ['x',".$datamonth."], ['W', ".$data_W."], ['E', ".$data_E."],";
                    $bar .=" ['G',".$data_G."]],";
                    $bar.='     type:"area-spline",';
                    $bar .='names:{';
                    $bar .='      E: "Electric",';
                    $bar .='      G: "Gas",';
                    $bar .='      W: "Water"';
                    $bar .='  },';
                    $bar.='},';
                
                    $bar.='grid: {';
                    $bar.='    y: {';
                    $bar.='        lines: [';
                    $bar.='            {value: 0}';
                    $bar.='            ]';
                    $bar.='        }';
                    $bar.='    },';
                    $bar.='axis: {';
                    $bar.='    x:{';
                    $bar.='         type: "category",';
                    $bar.='         categories:[';
                    $bar.=$datamonth;
                    $bar.=']';
                    $bar.='     },';
                    $bar.='     y : {';
                    $bar.='           tick: {';
                    $bar.='             format: function (d) { return formatNumber(d); }';
                    $bar.='             }';
                    $bar.='         }';
                    $bar.='    },';
                    $bar.='     tooltip: { ';
                    $bar.='         format: { ';
                    $bar.='             value: function (value, ratio, id) { ';
                    $bar.='                 return formatNumber(value); ';
                    $bar.='             } ';
                    $bar.='         } ';
                    $bar.='     } ';
                    $bar.='});';

            } else {
                $bar='';
                $bar.='var barprop = c3.generate({bindto: "#barproperty",padding: {bottom: 20,top:10},';
                    $bar.='data: {';
                    $bar .=" x:'x',columns:[  ['x',0], ['W', 0],['E', 0],";
                    $bar .=" ['G',0]],";
                    $bar.='     type:"area-spline",';
                    $bar .='names:{';
                    $bar .='      E: "Electric",';
                    $bar .='      G: "Gas",';
                    $bar .='      W: "Water"';
                    $bar .='  },';
                    $bar.='},';
                
                    $bar.='grid: {';
                    $bar.='    y: {';
                    $bar.='        lines: [';
                    $bar.='            {value: 0}';
                    $bar.='            ]';
                    $bar.='        }';
                    $bar.='    },';
                    $bar.='axis: {';
                    $bar.='    x:{';
                    $bar.='         type: "category",';
                    $bar.='         categories:[';
                    $bar.=$stringMonth;
                    $bar.=']';
                    $bar.='     },';
                    $bar.='     y : {';
                    $bar.='           tick: {';
                    $bar.='             format: function (d) { return formatNumber(d); }';
                    $bar.='             }';
                    $bar.='         }';
                    $bar.='    },';
                    $bar.='     tooltip: { ';
                    $bar.='         format: { ';
                    $bar.='             value: function (value, ratio, id) { ';
                    $bar.='                 return formatNumber(value); ';
                    $bar.='             } ';
                    $bar.='         } ';
                    $bar.='     } ';
                    $bar.='});';
            }
        
            // var_dump($DataMenu);exit();
        $content = array('debtor_acct'=>$name,
            'project_no'=>$project,
            'sys'=>$admin,
            'ddx'=>$dsb,
            'approver'=>0,
            'project'=>$DataMenu,
            'dtdebtor'=>$datadebtor,
            'js3'=>$bar,
            'chooseunit'=>$comboUnit,
            'databusiness'=>$databusiness,
            'dataUnit'=>$dtunit,
            
            // 'dataUnit'=>$this->getUnit('1000005'),
           
            'ProjectDescs'=>$projectName);
        
        $this->load_content_top_menu('customer_info/index',$content);
    } 

    public function getByID($business_id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $cons = $this->session->userdata('Tscons');
        $where=array('business_id'=>$business_id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_business with(nolock)',$where);
        // var_dump($data);exit();
        return $data;

    }

    public function getUnit($debtor_acct=''){

        $entity = $this->session->userdata('Tsentity');
       
        $project = $this->session->userdata('Tsproject');
       
        // $debtor_acct=$this->input->post('debtor_acct',TRUE);
        $cons = $this->session->userdata('Tscons');
        $where=array('project_no'=>$project,
            'entity_cd'=>$entity,
            'debtor_acct'=>$debtor_acct);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'v_pm_debtor_unit',$where);
        // var_dump($data);exit();
        return $data;

    }
    public function viewticket($rowid){
        $projectName = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsname');
        $table = 'securityuserdebtor';
        $crit = array('UserId'=>$name);
            // $crit = array('debtor_acct'=>$name);
        // $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);
        $content = array(
            'rowid'=>$rowid,
            'ProjectDescs'=>$projectName );
        // $this->load_content_top_menu('customer_info/viewticket',$content);
        $this->load->view('customer_info/viewticket',$content);
    }
   public function getTicketByID($rowid=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tsons');
        $where=array('rowID'=>$rowid);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'v_ticket',$where);
        // var_dump($rowID);
        foreach ($data as $key => $value ) {

            $picbase64 = base64_encode($value->file_attached);
            $value->file_attached = $picbase64;
        }
        // var_dump($picbase64);exit();

        echo json_encode($data);

    }
   public function zoom_lotno($debtor_acct='', $from='')
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        // var_dump($cons);
        $where=array('project_no'=>$project,
            'entity_cd'=>$entity,
            'debtor_acct'=>$debtor_acct);
        $proUnit = $this->m_wsbangun->getData_by_criteria_cons($cons,'v_pm_debtor_unit',$where);

        
        // var_dump($entityName);
             if(!empty($proUnit)) {
                $unit = $proUnit[0]->lot_no;
                        $comboUnit[] = '<option></option>';
                        foreach ($proUnit as $dtUnit) {
                          if($unit === $dtUnit->lot_no) {
                            $pilih = ' selected = "1"';
                          } else {
                            $pilih = '';
                          }
                            $comboUnit[] = '<option '.$pilih.' value="'.$dtUnit->lot_no.'">'.$dtUnit->lot_no.'</option>';
                        }
                        $comboUnit = implode("", $comboUnit);
                    } else {
                        $comboUnit= '<option></option>';
                    }
            if($from=='controller') {
                return $comboUnit;
            } else {
                echo $comboUnit;
            }            
            
    }

    public function zoom_debtor($debtor_acct)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $this->load->model('m_wsbangun'); 
        $table = 'v_logindebtor';
        $cons = $this->session->userdata('Tscons');

        if(empty($debtor_acct) or $debtor_acct==''){
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project );
        } else {
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project,
                    'UserID'=>$name );
        }
        $proDescs = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // var_dump($entityName);
        $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                
                foreach ($proDescs as $dtProject) {
                  if($debtor_acct === $dtProject->debtor_acct) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->debtor_acct.'" data-telp="'.$dtProject->hand_phone.'" data-businessid="'.$dtProject->business_id.'">'.$dtProject->debtor_acct.'-'.$dtProject->name.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }
    public function goto_table(){

        $business_id = $this->input->post('business_id', TRUE); 
        $debtor_acct = $this->input->post('debtor_acct', TRUE); 
        $project = $this->session->userdata('Tsproject'); 
        $entity = $this->session->userdata('Tsentity');
      
           
        $data = array('databusiness'=>$this->getByID($business_id),
            'dataUnit'=>$this->getUnit($debtor_acct));
        $this->load->view('customer_info/profildebtor',$data);
    
    }

    public function tableLatestTicket()
    {
        $product = $this->input->post('prod',TRUE);
        $project = $this->session->userdata('Tsproject');  
        $entity = $this->session->userdata('Tsentity');
        $debtor_acct = $this->input->post('debtor_acct', true);   

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $cons=$this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'report_no','name', 'lot_no', 'reported_date_string', 'status','work_requested','category_descs');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_sv_entry_multi_list';
        
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
        $addsort = 'report_no';
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'report_no' :$Column[$sortIdColumn]['name']);

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
      
        // var_dump($debtor_acct);exit();
        if($debtor_acct!='All' || empty($debtor_acct))
        {
            // var_dump('b');
            $where="AND debtor_acct='".$debtor_acct."' ".$where;
        }

        // var_dump($filter_search);
        // $param = $filter_search;
        // // var_dump($param);
        // $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);    
        
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttableagent_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);

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

    public function billingoutstanding()
    {
        $product = $this->input->post('prod',TRUE);
        $project = $this->session->userdata('Tsproject');  
        $entity = $this->session->userdata('Tsentity');
        $debtor_acct = $this->input->post('debtor_acct', true);       
        // var_dump($debtor_acct);exit();
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $cons=$this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','doc_no','doc_date', 'due_date', 'descs', 'currency_cd','mbal_amt');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_ar_ledger2'; 
        $addsort = 'trx_date';
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
      
        // var_dump($debtor_acct);exit();
        if($debtor_acct!='All' || empty($debtor_acct) || $debtor_acct=='')
        {
            // var_dump('b');
            $where="AND debtor_acct='".$debtor_acct."' ".$where;
        }
       
      
    
        
        $param =" Where class in ('I','D','N') and trx_mode='D' and mbal_amt>0 AND entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttableagent_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);


        // var_dump($filter_search);
        // $param = $filter_search;
        // // var_dump($param);
        // $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

        $sql="select count(*) as cnt from ".$sTable." with(nolock) ".$param;
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
        // $msg='';
        // if($rResult['pesan'] != 'OK'){
        //         $msg = array('pesan'=>'Insert Cf Business Fail!',
        //             'status'=>'Failed');
        //             echo json_encode($msg);
        //             return;
        //     }

   
        echo json_encode($output);

    }


    public function barproperty()
    {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $lotno = $this->input->post('lot_no');
            $cons = $this->session->userdata('Tscons');
            $param2 = " where  entity_cd='$entity' and project_no='$project' and lot_no='$lotno' and read_date >= dateadd(Month,-13,GETDATE())";
            $sql3 = "SELECT * from mgr.v_pm_monthly_utilities  $param2"; 
            $dt3 = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);
        
            if(!empty($dt3)){
                    $data_E ='E,';//"['Income Amount',";
                    $data_W ='W,';
                    $data_G ='G,';
                    $datamonth='x,';
                    foreach ($dt3 as $key => $row) {
                        if($row->meter_type=='E') {
                            $data_E.= $row->usages.',';
                        } else if($row->meter_type=='W') {
                            $data_W.= $row->usages.',';
                        } else{
                            $data_G.= $row->usages.',';
                        }

                    }
                    $arrayMonth = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
                    // var_dump($dt3);
                    foreach ($dt3 as $key => $row) {
                        $period_distinct[]=$row->period;
                        
                    }
                        $month = array_unique($period_distinct);
                        // var_dump($month);
                        foreach ($month as $key) {
                            $datamonth .= ''.$arrayMonth[(int)substr($key,0,2)].' '.(int)substr($key,3,4).',';
                            // $datamonth .= '"'.$arrayMonth[$key].'",';
                        }
                    
                    $data_E=substr($data_E,0,-1);
                    $data_W=substr($data_W,0,-1);
                    $data_G=substr($data_G,0,-1);
                    $datamonth=substr($datamonth,0,-1);
                
            } else {
                $data_E=0;
                $data_W=0;
                $data_G=0;
                $datamonth='No Data Available';
            }
           
            
            $datas  = array('dataE'=>$data_E,'dataG'=>$data_G,'dataW'=>$data_W,'category' => $datamonth);
            // var_dump($datas);exit();
            echo json_encode($datas);
    }
    // public function grafik($pro='')
    // {
        
    // }
    //
}