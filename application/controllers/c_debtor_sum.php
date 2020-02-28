<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class C_debtor_sum extends Core_Controller
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
        $cons = $this->session->userdata('Tscons');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
	       // }
        $userid = $this->session->userdata("Tsname");
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
        

    	$sql="select distinct a.debtor_acct, a.name from  mgr.ar_debtor a  WITH(NOLOCK), mgr.ar_ledger b  WITH(NOLOCK) where a.debtor_acct = b.debtor_acct and b.entity_cd='".$entity."' and b.project_no='".$project."'";
        $debtorData=$this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql1="select distinct lot_no from mgr.ar_ledger  WITH(NOLOCK) where entity_cd='".$entity."' and project_no='".$project."'";
        $unitData=$this->m_wsbangun->getData_by_query_cons($cons,$sql1);
       
        $sql2="select * from mgr.ar_spec(NOLOCK)";
        $ageData=$this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        
    $ContentAllData = array('project_no'=>$project,
        'ProjectDescs'=>$projectName,
        'cbProject'=>$comboProject,
        'cbDebtor'=>$debtorData,
        'cbUnit'=>$unitData,
        'ageData'=>$ageData);
    $group = $this->session->userdata('Tsusergroup');
    if ($group=='MGM'){
            $this->load_content_mgm('list_debtor/indexsum',$ContentAllData);
        }else{
            $this->load_content_top_menu('list_debtor/indexsum',$ContentAllData);
        }
    }


    public function getTable(){


        $userid = $this->session->userdata("Tsuname");


        $pro = $this->input->post("project",true);
        $debtor= $this->input->post("debtor",true);
        $lotno=$this->input->post("unit",true);
        // if(empty($lotno)){
        //     $lotno='all';
        // }
        // var_dump('what');
        $cons = $this->input->post("cons",true);
        if(empty($cons))
        {
            $cons=$this->session->userdata('Tscons');
        }
        $sSearch=$this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            // $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $datas = $this->m_wsbangun->getData_by_queryadm($sql);
            $entity = $datas[0]->entity_cd;
            // var_dump($entity);
        }
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database($cons, TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','debtor_name','lot_no');

        $sTable = "mgr.v_ar_debtor_aging_summary_enq";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);

        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $addsort = 'product_cd,property_cd,lead_cd,group_cd ';
        $addsort = '';
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


        $where=' ';
        if($debtor!='all')
        {
            
            $where="AND debtor_acct='".$debtor."' ".$where;
        }
        // if($lotno!='all')
        // {
       
        //     $where="AND lot_no='".$lotno."' ".$where;
        // }
      
    
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablenup_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);

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