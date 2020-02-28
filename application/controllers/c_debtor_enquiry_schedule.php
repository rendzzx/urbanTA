<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_debtor_enquiry_schedule extends Core_Controller
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
        
        $table = 'sysMenu';
        $DataMenu = $this->m_wsbangun->getData($table);        
        
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu);
        
    	// $this->load_content_top_menu('debtor_enquiry/index',$content);
        $this->load_content_top_menu('debtor_enquiry/index');
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

    public function goto_tab($debtor_acct='',$tab=''){
        $tes = '';
        if($tab=='tab-1'){

        }else if($tab=='tab-2'){
            $tes = 'debtor_enquiry/Account';
            }
        else if($tab=='tab-5'){
            $tes = 'debtor_enquiry/Reminder';
        }
        else if($tab=='tab-7'){
            $tes = 'debtor_enquiry/Schedule';
        } else if($tab=='tab-8'){
            $tes = 'debtor_enquiry/salesinfo';
        }
        
        $content = array('debtor_acct'=>$debtor_acct
            );
        $this->load->view($tes,$content);

    }
    
   public function getTableSchedule()
    {
        // $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        $debtor_acct = $this->input->post("debtor_acct",true);
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
        $aColumns  = array('row_number','bill_date','bill_type','trx_type','descs','tax_scheme','currency_cd','trx_amt','status_pembayaran');
        // var_dump($aColumns);exit();
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_pm_bill_sch_debtor';

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
         $param = " where entity_cd ='$entity' and project_no='$project' and debtor_acct='$debtor_acct' and status_pembayaran <> 'H' ".$filter_search;
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
     
}