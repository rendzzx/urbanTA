<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_nup_enquiry extends Core_Controller {
	
	public function __construct(){ 
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

		$table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $cons = $this->session->userdata('Tscons');
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

        $encParam = base64_encode($project.'-'.$projectName);

		$ContentAllData = array(
    			'project_no'=>$project,
				'ProjectDescs'=>$projectName,
				'product'=>$dtProduct,
                'encParam'=>$encParam
								
             );


    	$this->load_content_top_menu('nup_enquiry/index',$ContentAllData);
	}
	public function view($rowID=null){
		
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

        $today = date('d M Y');

        $dday = date('d M Y H:i:s');
        $table = 'rl_nup_type(nolock) order by nup_type ASC';
        $crit = array('nup_type', 'descs');
        $cons = $this->session->userdata('Tscons');
        $nuptype = $this->m_wsbangun->getCombo3_cons($cons,$table,$crit);

        $table1 = 'cb_activity_type(nolock)';
        $crit1 = array('activity_type', 'descs');
        $cons = $this->session->userdata('Tscons');
        $payment = $this->m_wsbangun->getCombo3_cons($cons,$table1,$crit1);

        
        
        $table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $cons = $this->session->userdata('Tscons');
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

        $table = 'agent_details';
        $crit = array('userid'=>$user);
        $cons = $this->session->userdata('Tscons');
        $agent = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        
        $table = 'cf_location (nolock)';
        $crit = array('location_cd', 'descs');
        $cons = $this->session->userdata('Tscons');
        $cblocation = $this->m_wsbangun->getCombo3_cons($cons,$table,$crit);

        $table = 'cf_country (nolock)';
        $crit = array('country_code', 'descs');
        $cons = $this->session->userdata('Tscons');
        $cbcountry = $this->m_wsbangun->getCombo3_cons($cons,$table,$crit);

        $table = 'cf_nationality (nolock)';
        $crit = array('nationality_cd', 'descs');
        $cons = $this->session->userdata('Tscons');
        $cbnationality = $this->m_wsbangun->getCombo3_cons($cons,$table,$crit);

       

        $sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
        $cons = $this->session->userdata('Tscons');
        $dtPhase = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql = "SELECT reserve_by,nup_sequence_no,location_cd,rowID FROM mgr.v_nup_principal (NOLOCK) ";
        $sql.= " WHERE entity_cd ='".$entity."' and project_no='".$project."' and rowID='".$rowID."'";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        
	
    	
		
    	$cnt = $this->cek_nup_attach($entity,$project,$data[0]->nup_sequence_no,$data[0]->reserve_by);


        $content = array(
        	'comboTnup'=>$nuptype,
        	'comboLocation'=>$cblocation,
        	'comboCountry'=>$cbcountry,
        	'cbnationality'=> $cbnationality,
        	'user'=>$data[0]->reserve_by,
        	'seqno'=>$data[0]->nup_sequence_no,
            'rowID'=>$data[0]->rowID,
        	'project'=>$projectName,
        	'phase'=>$dtPhase[0],
        	'today'=>$today,       	
        	'cnt'=>$cnt,
        	'agent'=>$agent[0],
        	'payment'=>$payment,
        	'product'=>$dtProduct
        	);
        $this->load->view('nup_enquiry/view',$content);
	}
	function cek_nup_attach($entity='',$project='',$seqno='',$user=''){	

		$dday = date('d M Y H:i:s');
		/* cek data attachment di db2
		klo ga ada => insert data attachment dari document master di DB1
		klo ada biar aja
		kembalikan nilai count dari data attachment yg statusnya NULL atau 0
		*/
		$sql = "SELECT count(1) AS cnt FROM mgr.rl_nup_attachment WHERE nup_sequence_no=$seqno";
        $cons = $this->session->userdata('Tscons');
		$dtA = $this->m_wsbangun->getData_by_query2_cons($cons,$sql);
		$cnt = $dtA[0]->cnt;		

		if($cnt == 0)
		{
			// $sql = "SELECT entity_cd, project_no, document_no, descs, STATUS, $seqno, '$user', '$dday' FROM mgr.rl_document_mst WHERE entity_cd='$entity' AND project_no='$project'";
			$sql = "SELECT entity_cd, project_no, document_no, descs, STATUS FROM mgr.rl_document_mst WHERE entity_cd='$entity' AND project_no='$project' and phase_cd='01' ";
            $cons = $this->session->userdata('Tscons');
			$dtB = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
			// var_dump($dtB);exit;
			if(!empty($dtB))
			{
				foreach ($dtB as $value) {
					$table = 'rl_nup_attachment';
					$data = array('entity_cd' => $value->entity_cd, 
        					'project_no' => $value->project_no,
        					'document_no' => $value->document_no,
        					'document_descs' => $value->descs,
        					'document_status' => $value->STATUS,
        					'nup_sequence_no' => $seqno,
        					'audit_user' => $user,
        					'audit_date' => $dday);
					$this->m_wsbangun->insertData2($table, $data);

				}
			}
		}
		$sql = "SELECT count(nup_sequence_no) as counter FROM mgr.rl_nup_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
        $sql.= "AND (status_attach IS NULL OR status_attach='0')";
        $cons = $this->session->userdata('Tscons');
        $dtCnt = $this->m_wsbangun->getData_by_query2_cons($cons,$sql);
        $cnt = $dtCnt[0]->counter;

        return $cnt;

	}
    public function show_edit_data($ID=''){
        // $rowID = (string)$this->input->post('ID', TRUE);
        // $seqno = (string)$this->input->post('seqno', TRUE);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $where =array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'rowID'=>$ID);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'v_nup_principal',$where);


        echo json_encode($data);

    }
	public function getTable()
    {
    	$sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
       $entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $cons = $this->session->userdata('Tscons');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','rowID', 'nup_no', 'reserve_date','STATUS','nup_type');
        // $aColumns = array('entity_cd', 'entity_name');
        // $sTable = "select * from mgr.v_nup_update where (status not in ('A','V', 'S') or (status = 'S' and old_status in ('R','N')))'";
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";
        $sql2 = "SELECT group_cd from mgr.cf_agent_dt (NOLOCK) where agent_cd='$name' and ENTITY_CD='$entity'";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $groupcode=$data[0]->group_cd;


        $sTable = "mgr.v_nup_principal_new";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $Search = $sSearch['value'];
        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
      	// $SordField = ('STATUS,reserve_date ASC');
// var_dump($Search);
        // filter
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
        // Select Data

        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        $param =" Where group_cd='".$groupcode."' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $cons = $this->session->userdata('Tscons');
        $rResult = $this->m_wsbangun->getlisttablenup_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
        // Total data set length
        
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
?>