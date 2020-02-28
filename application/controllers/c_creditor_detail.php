<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class C_creditor_detail extends Core_Controller
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
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        if($entity == ''){
            $entity = '2101';
            $project = '210101';
	       }

        // $table = 'cf_entity';
        // $proDescs = $this->m_wsbangun->getData($table);
        $userid = $this->session->userdata("Tsname");
        $sql = "SELECT distinct entity_cd,entity_name from mgr.v_cfs_user_project(nolock) where userid='$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query($sql);
        // var_dump($entityName);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($entity === $dtProject->entity_cd) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtProject->entity_cd.'">'.$dtProject->entity_name.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
        

    	$sql="select distinct creditor_acct, creditor_name from  mgr.v_ap_creditor_aging_dtl(NOLOCK) where entity_cd='".$entity."' order by creditor_name";
        $CreditorData=$this->m_wsbangun->getData_by_query($sql);
     
       
        $sql2="select * from mgr.ar_spec(NOLOCK)";
        $ageData=$this->m_wsbangun->getData_by_query($sql2);
        
    $ContentAllData = array(
        'ProjectDescs'=>$projectName,
        'cbEntity'=>$comboEntity,
        'cbCreditor'=>$CreditorData,
        'ageData'=>$ageData);
    $group = $this->session->userdata('Tsusergroup');
    if ($group=='MGM'){
            $this->load_content_mgm('list_Creditor/indexdetail',$ContentAllData);
        }else{
            $this->load_content_top_menu('list_Creditor/indexdetail',$ContentAllData);
        }
    }


    public function getTable(){


        $userid = $this->session->userdata("Tsuname");


        $ent = $this->input->post("entity",true);
        $creditor= $this->input->post("creditor",true);
  


        $sSearch=$this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        if(empty($ent)||$ent==''){
            $entity = $this->session->userdata('Tsentity');
        } else {
            $entity = $ent;//onchange
           
            // var_dump($entity);
        }
        // var_dump($entity);
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database('ifca', TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','creditor_name','doc_date','due_date','doc_no','descs');

        $sTable = "mgr.v_ap_creditor_aging_dtl";

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
        if($creditor!='all')
        {
            
            $where="AND creditor_acct='".$creditor."' ".$where;
        }

    
        $param =" Where entity_cd='".$entity."'  ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablenup($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);

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