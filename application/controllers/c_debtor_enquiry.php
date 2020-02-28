<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_debtor_enquiry extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

    public function index($pro='')
    {
        
        // $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $cons = $this->session->userdata('Tscons');
        $admin = $this->session->userdata('Tsysadmin');
        $group = $this->session->userdata('Tsusergroup');
        $project = $this->session->userdata('Tsproject');

        // if(empty($pro)||$pro==''){
        //     $project = $this->session->userdata('Tsproject');
        //     $entity = $this->session->userdata('Tsentity');
        //     $cons = $this->session->userdata('Tscons');
        // } else {
        //     $project = $pro;//onchange
        //     $sql = "SELECT entity_cd = max(entity_cd),db_profile = max(db_profile) from mgr.pl_project (nolock) where project_no = '$pro'";
        //     $datas = $this->m_wsbangun->getData_by_queryadm($cons,$sql);
        //     $entity = $datas[0]->entity_cd;
        //     $cons=$datas[0]->db_profile;
            
        // }

        // $table = 'sysMenu';
        // $DataMenu = $this->m_wsbangun->getData($table);        
        
        // $content = array('leftdyn'=>$name,
        //     'sys'=>$admin,
        //     'approver'=>0,
        //     'project'=>$DataMenu
        //     );

        // $table = 'pl_project';
        // $proDescs = $this->m_wsbangun->getData($table);
            $userid = $this->session->userdata('Tsname');
            $sql = "SELECT distinct project_no,project_descs,db_profile from mgr.v_cfs_login_user (nolock) where userid= '$userid'";
            $proDescs = $this->m_wsbangun->getData_by_queryadm($sql);
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

        $isiData = array('comboProject' => $comboProject);

        // $sql = "SELECT TOP 1 debtor_acct FROM mgr.v_ar_debtor_profile WHERE entity_cd = '$entity' AND project_no = '$project' ORDER BY debtor_acct ASC";

        // $query = $this->m_wsbangun->getData_by_query($sql);
        // $loadDebtorAcct = $query[0]->business_id;

        // $debtor_acct = array('loadDebtorAcct' => $loadDebtorAcct);
        
    	if ($group=='MGM'){
            $this->load_content_mgm('debtor_enquiry/index', $isiData);
        }else{
            $this->load_content_top_menu('debtor_enquiry/index', $isiData);
        }

        // $this->load_content_top_menu('debtor_enquiry/index',$content);
        // $this->load_content_top_menu('debtor_enquiry/index');
    }

      //set combo when edit
      public function zoom_parentid_from(){
        $ent = $this->input->post('MenuID',TRUE);
        // var_dump($ent);
        $table = 'sysMenu';
        $parentID = $this->m_wsbangun->getData($table);


        // var_dump($entityName);
            if(!empty($parentID)) {
                $comboParent[] = '<option></option>';
                foreach ($parentID as $dtParent) {
                  if($ent == $dtParent->MenuID) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboParent[] = '<option '.$pilih.' value="'.$dtParent->MenuID.'">'.$dtParent->Title.'</option>';
                }
                $comboParent = implode("", $comboParent);
            }
            echo $comboParent;
      }
public function showDetailAccount(){
    $this->load->view('debtor_enquiry/detailAccount');
}
    // public function goto_tab($debtor_acct='',$tab='',$schedule='',$reminder=''){
public function goto_tab($debtor_acct='',$tab='', $project='',$cons=''){
        // var_dump($debtor_acct);
        // var_dump($tab);
        $tes = '';
        if($tab=='tab-1'){
            // $data = array('dataProfile' => $this->dataProfile($debtor_acct));
            $tes = 'debtor_enquiry/profile';
        }else if($tab=='tab-2'){
            $tes = 'debtor_enquiry/Account';
        }
        else if($tab=='tab-7'){
            $tes = 'debtor_enquiry/Schedule';

        }
        else if($tab=='tab-5'){
            $tes = 'debtor_enquiry/Reminder';

        } else if($tab=='tab-3'){
            $tes = 'debtor_enquiry/Aging';
        } 
        // else if($tab=='tab-8'){
        //     $tes = 'debtor_enquiry/salesinfo';
        // }
        
        if(empty($cons))
        {
            $cons=$this->session->userdata('Tscons');
        }
        $sql2="select * from mgr.ar_spec(NOLOCK)";
        $ageData=$this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        
        $content = array('debtor_acct'=>$debtor_acct,
                        'profile'=>$this->dataProfile($debtor_acct, $project,$cons),
                        'schedule'=>$this->dataSchedule($debtor_acct,$cons),
                        'reminder'=>$this->dataReminder($debtor_acct,$cons),
                        'ageData'=>$ageData,
                        'dtAging'=>$this->dataAging($debtor_acct, $project,$cons)
            );
        $this->load->view($tes,$content);

    }
    public function dataAging($debtor_acct = '', $pro='',$cons=''){

 
        // $entity = $this->session->userdata('Tsentity');
        // $project = $this->session->userdata('Tsproject');
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (NOLOCK) where project_no='$pro'";
            $datas = $this->m_wsbangun->getData_by_queryadm($sql);
            $entity = $datas[0]->entity_cd;
            
        }
        if(empty($cons)||$cons=='')
        {
            $cons=$this->session->userdata('Tscons');
        }
        $sql = "SELECT * FROM mgr.v_ar_debtor_aging_summary_enq WHERE entity_cd = '$entity' AND project_no = '$project' AND debtor_acct = '$debtor_acct'";

        $getAging = $this->m_wsbangun->getData_by_query_cons($cons,$sql);


        return $getAging;

    }
    public function detail_aging($amt='',$debtor_acct='',$cons=''){
        $param = '';
        if($amt =='current'){
            $param = 'and current_day > 0';
        }
        if($amt =='day1'){
            $param = 'and day1_amt > 0';
        }
        if($amt =='day2'){
            $param = 'and day2_amt > 0';
        }
        if($amt =='day3'){
            $param = 'and day3_amt > 0';
        }
        if($amt =='day4'){
            $param = 'and day4_amt > 0';
        }
        if($amt =='day5'){
            $param = 'and day5_amt > 0';
        }
        if($amt =='day6'){
            $param = 'and day6_amt > 0';
        }
        if($amt =='day7'){
            $param = 'and day7_amt > 0';
        }
        // $cons = $this->input->post("cons",true);
        if(empty($cons)||$cons=='')
        {
            $cons=$this->session->userdata('Tscons');
        }
        $sql = "select * from mgr.v_ar_debtor_aging_detail_currency where debtor_acct='$debtor_acct' $param";
        // $sql = "select * from mgr.v_ar_debtor_aging_detail_currency where debtor_acct='$debtor_acct'";
        $dtAging = $this->m_wsbangun->getData_by_query_cons($cons,$sql); 
        $sql2="select * from mgr.ar_spec(NOLOCK)";
        $ageData=$this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $content = array('debtor_acct'=>$debtor_acct,
            'dtAging'=>$dtAging,
            'ageData'=>$ageData,
            'amt'=>$amt
            );
        $this->load->view('debtor_enquiry/Aging_detail',$content);
    }


    public function dataProfile($debtor_acct = '', $pro='',$cons=''){

        $dataProfile='';
        // $entity = $this->session->userdata('Tsentity');
        // $project = $this->session->userdata('Tsproject');

        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (NOLOCK) where project_no='$pro'";
            $datas = $this->m_wsbangun->getData_by_queryadm($sql);
            $entity = $datas[0]->entity_cd;
            
        }
        if(empty($cons))
        {
            $cons=$this->session->userdata('Tscons');
        }
        $sql = "SELECT * FROM mgr.v_ar_debtor_profile WHERE entity_cd = '$entity' AND project_no = '$project' AND debtor_acct = '$debtor_acct'";

        $getProfil = $this->m_wsbangun->getData_by_query_cons($cons,$sql);


        return $getProfil;

    }

    public function dataSchedule($debtor_acct = '',$cons=''){

        $dataSchedule='';
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        if(empty($cons)||$cons=='')
        {
            $cons=$this->session->userdata('Tscons');
        }
   
        $sql = "SELECT * FROM mgr.pm_bill_sch WHERE entity_cd = '$entity' AND project_no = '$project' AND debtor_acct = '$debtor_acct'";
        $getSchedule = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        // var_dump($getSchedule);
        return $getSchedule;

    }

    public function dataReminder($debtor_acct = '',$cons=''){

        $dataReminder='';
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        if(empty($cons)||$cons=='')
        {
            $cons=$this->session->userdata('Tscons');
        }

        $sql = "SELECT * FROM mgr.ar_remind_tmp WHERE entity_cd = '$entity' AND project_no = '$project' AND debtor_acct = '$debtor_acct'";
        $getReminder = $this->m_wsbangun->getData_by_query_cons($cons,$sql);


        return $getReminder;

    }

    public function getTable()
    {
        // $project = $this->session->userdata('Tsproject');
               

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $pro = $this->input->post("project",true); 
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (NOLOCK) where project_no='$pro'";
            $datas = $this->m_wsbangun->getData_by_queryadm($sql);
            $entity = $datas[0]->entity_cd;
        }
        $cons = $this->input->post("cons",true);
        if(empty($cons))
        {
            $cons=$this->session->userdata('Tscons');
        }
        // $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'debtor_acct','name');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.ar_debtor';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        // $order = (int)$this->input->get_post('order', true);
        $order = $this->input->get_post('order', true);
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
        $SordField = ($sortIdColumn==0? 'debtor_acct' :$Column[$sortIdColumn]['name']);

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
        // $param = " where rowID > 0 ".$filter_search;
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        // $param =" Where entity_cd='1' AND project_no= '2' ".$filter_search;
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
    
    public function getTableSchedule()
    {
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','bill_date','bill_type','trx_type','descs','tax_scheme','currency_cd','trx_amt','status');
        // var_dump($aColumns);exit();
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.pm_bill_sch';

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
        $SordField = ($sortIdColumn==0? 'trx_type' :$Column[$sortIdColumn]['bill_type']);

        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['bill_type'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        // var_dump($filter_search);
        $param = " where rowID > 0 ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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