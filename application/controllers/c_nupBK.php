<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_Nup extends Core_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->auth_check();
		// $this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
		$this->load->model('m_sms');
		$this->load->model('m_business');
	}
	
	public function index()
    {
    	$entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $table = 'pl_project(nolock)';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        $prjDesc = empty($dtPrj) ? '' : $dtPrj[0]->descs;
        // var_dump($project);
        
        
        $x = $this->validasi_button_new($entity,$project);
        
    	$ContentAllData = array('kondisi'=>$x,
    			'project_no'=>$project,
				'ProjectDescs'=>$prjDesc);
    	$this->load_content_top_menu('nup/NupIndex',$ContentAllData);
    }
    public function goto_form($status=''){
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $today = date('d M Y');
        $dday = date('d M Y H:i:s');

 		$table = 'rl_nup_type(nolock)';
        $crit = array('nup_type', 'descs');
        $nuptype = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'cf_business(nolock)';
        $crit = array('business_id', 'name');
        $customer = $this->m_wsbangun->getCombo($table,$crit);


    	$table = 'cf_trx_type(nolock)';
        $crit = array('trx_type', 'descs');
        $cbtrxtype = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'agent_details';
        $crit = array('userid'=>$user);
        $agent = $this->m_wsbangun->getData_by_criteria($table,$crit);
        // var_dump($agent);
        $table = 'cb_activity_type(nolock)';
        $crit = array('activity_type', 'descs');
        $cbtype = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'pl_project(nolock)';
        $crit = array('entity_cd'=>$entity,
        	'project_no'=>$project);
        $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        $prjName = empty($dtPrj) ? '' : $dtPrj[0]->descs;

        $sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
        $dtPhase = $this->m_wsbangun->getData_by_query($sql);

        $sql = "SELECT counter from mgr.next_number where name='nup_sequence_no'";
        $dtSeq = $this->m_wsbangun->getData_by_query($sql);
        $seqno = (int) $dtSeq[0]->counter;
       	$upseq = intval($seqno) + 1;
	    $sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='nup_sequence_no'";
	    $this->m_wsbangun->setData_by_query($sql);

    	$sql = "IF NOT EXISTS(SELECT nup_sequence_no FROM mgr.rl_nup_attachment WHERE nup_sequence_no=$seqno) ";
    	$sql.= "INSERT into mgr.rl_nup_attachment(entity_cd, project_no, document_no, document_descs, document_status, nup_sequence_no, audit_user, audit_date) ";
        $sql.= "SELECT entity_cd, project_no, document_no, descs, STATUS, $seqno, '$user', '$dday' FROM mgr.rl_document_mst WHERE entity_cd='$entity' AND project_no='$project'";
        $exc = $this->m_wsbangun->setData_by_query($sql);

        $sql = "SELECT count(nup_sequence_no) as counter FROM mgr.rl_nup_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
        $sql.= "AND (status_attach IS NULL OR status_attach='0')";
        $dtCnt = $this->m_wsbangun->getData_by_query($sql);
        $cnt = $dtCnt[0]->counter;

        $content = array('comboTnup'=>$nuptype,
        	'comboCs'=>$customer,
        	'comboType'=>$cbtype,
        	// 'comboPhase'=>$cbphase,
        	'comboTrxType'=>$cbtrxtype,
        	'user'=>$user,
        	'seqno'=>$seqno,
        	'project'=>$prjName,
        	'phase'=>$dtPhase[0],
        	'today'=>$today,
        	'error'=>$status,
        	'cnt'=>$cnt,
        	'agent'=>$agent[0],
        	'status'=>$status);
    	
        $this->load->view('nup/form',$content);
    }
    function validasi_button_new($entity=null,$project){
    	$today = date('d/m/Y');
    	$sql = "SELECT count(*) as counter from mgr.rl_nup_parameter where entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date and status = '1'";
        $Dataparam = $this->m_wsbangun->getData_by_query($sql);
        $c =intval($Dataparam[0]->counter);
        // var_dump($Dataparam);
        
        if($c > 0){
        	$x = 'enable';
        }else{
        	$x = 'disabled';
        }

        return $x;
    }
	function tes($tnup)
	{
		$str = "customer=1000002&nuptype=BZ&nupdesc=Bronze&grpcd=300&agtype=02&nupamt=5%2C000%2C000.00&type=01&prefix=&phase=02&seqno=1&bankcd=IH&cntfile=0";
		
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $today = date('d M Y');
        $table = 'rl_nup_type';
		$crit = array('nup_type'=>$tnup,
			'entity_cd'=>$entity,
			'project_no'=>$project);
		$dtNup = $this->m_wsbangun->getData_by_criteria($table, $crit);
		$pref = $dtNup[0]->prefix;
		$today = date('d M Y');
		$DB2 = $this->load->database('ifca',TRUE);
		$sql = "mgr.x_gen_docnumber '$entity', '$pref', '$user', '$today'";

		// var_dump($sql);
		$result = $DB2->query($sql);
		// $dtGen = $this->m_wsbangun->getData_by_query($sql);
		// array_push($dtNup, $sql[0]->output);
		// var_dump($result);
		// var_dump("expression");
		// $dtNup[0] = array('nup_no'=>$dtGen->output);
		$table = 'x_tformat';
		$result = $this->m_wsbangun->getData($table);
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->GetCust->count_all(),
			"recordsFiltered" => $this->GetCust->count_filtered(),
			"data" => $data,
		);
		// $sql = "SELECT output FROM ##t_format";
		// $result = $DB2->query($sql);
		// var_dump($result);
		// var_dump("expression");
		var_dump($dtNup);

		// $dtNup[0] = array('nup_no'=>$result[0]->output);
		$dtNup[0] = $result[0]->output;
		var_dump($dtNup);
	}

	private function setUploadOptions()
    {
        $config = array('upload_path'=>'./img/NUP',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>'10000',
            'overwrite'=>TRUE
        );
        return $config;
    }

	public function setnup()
	{
		if(!empty($_POST))
		{
			$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$user = $this->session->userdata('Tsuname');
			$tnup = $this->input->post('tnup');
			$table = 'rl_nup_type';
			$crit = array('nup_type'=>$tnup,
				'entity_cd'=>$entity,
				'project_no'=>$project);
			$dtNup = $this->m_wsbangun->getData_by_criteria($table, $crit);
			if(!empty($dtNup))
			{
				$pref = $dtNup[0]->prefix;
				$today = date('d M Y');
				$output = array('pesan'=>1,
					'pref'=>$dtNup[0]->prefix,
					'descs'=>$dtNup[0]->descs,
					'nup_amt'=>$dtNup[0]->nup_amt);
			} else {
				$output = array('pesan'=>0,
					'pref'=>null,
					'descs'=>null,
					'nup_amt'=>0);
			}
			
			// $sql = "mgr.x_gen_docnumber '$entity', '$pref', '$user', '$today'";
			// $this->m_wsbangun->getData_by_query($sql);
			// $table = 'x_tformat';
			// $result = $this->m_wsbangun->getData($table);
			// array_push($dtNup, $sql[0]->output);
			

			// $dtNup[0] = array('nup_no'=>$dtGen[0]->output);

			// if(!empty($dtNup))
			// {

			// }
			// $ret = json_encode($dtNup);
			// return $ret;
			echo json_encode($output);
		} else {
			echo 'nodata';
		}
	}
	
	public function submit($nup_no='')
	{
		if(!empty($nup_no))
		{
			$table = 'rl_reserve_nup';
			$crit = array('nup_no'=>$nup_no);
			$dtNup = $this->m_wsbangun->getData_by_criteria($table, $crit);
			$table = 'v_rl_sales_nup';
			$dtA = $this->m_wsbangun->getData_by_criteria($table, $crit);
			$table = 'rl_nup_email';
			$dtEmail = $this->m_wsbangun->getData($table);
			if(!empty($dtEmail))
			{
				foreach ($dtEmail as $key => $value) {
					$kepada = $value->email;
					$hp_no = $value->hp_no;
					// email
					if (preg_match("/^[a-zA-Z ]*$/",$kepada)) {
						$pesan = '';
	                    $pesan.= 'Dear Finance,'."\n\n";
	                    $pesan.= 'Please approve NUP No. '.$dtNup[0]->nup_no.', descs: '.$dtNup[0]->descs."\n";
	                    $pesan.= 'Name: '.$dtA[0]->NAME.', From Agent: '.$dtA[0]->group_name.' and Sales: '.$dtA[0]->agent_name."\n";
	                    $pesan.= 'Total Amount : '.number_format($dtA[0]->nup_amt)."\n\n\n";
	                    $pesan.= 'Thank you,';
	                    $judul = 'Approval';
	                    $this->_sendmail($kepada, $judul, $pesan);
	                }
                    // sms
					$isiSms = array(
	                    "DestinationNumber"=>$hp_no,
	                    "TextDecoded"=>$pesan,
	                    "CreatorID"=>'TWP'
	                    );
	            	$this->m_sms->sendSms($isiSms);
				}
			}
			$table = 'rl_reserve_nup';
			$crit = array('nup_no'=>$nup_no);
			$data = array('STATUS'=>'A');
			$this->m_wsbangun->updateData($table, $data, $crit);
		}
	}

	public function nup_list()
	{
		$entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $table = 'pl_project(nolock)';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        $prjDesc = empty($dtPrj) ? '' : $dtPrj[0]->descs;
        // var_dump($project);
        $today = date('d/m/Y');
        // var_dump($today);

        $sql = "SELECT count(*) as counter from mgr.rl_nup_parameter where entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date and status = '1'";
        $Dataparam = $this->m_wsbangun->getData_by_query($sql);
        $c =intval($Dataparam[0]->counter);
        // var_dump($Dataparam);
        
        if($c > 0){
        	$x = '<a href="'.base_url("c_nup/insert").'" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create New</a>';
        }else{
        	$x = '<a href="'.base_url("c_nup/insert").'" class="btn btn-primary disabled"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create New</a>';
        }

        $tabel2 = 'v_rl_sales_nup';
	 	$kriteria2 = array(
	 		'entity_cd'=>$entity,
	 		'project_no'=>$project,
	 		'userid'=>$name);
		$datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2, $kriteria2);

		$statusSales = array('A'=>'Submited', 'P'=>'Approved', 'U'=>'Pending', 'C'=>'Cancel','T' => '');
		
		if(!empty($datalist2)){
			$ListAllData = '';
			$i=1;
			foreach ($datalist2 as $value) {
				$ListAllData .='<tr role="row" class="odd">';
				$ListAllData .='<td class="sorting_1">'.$value->nup_no.'</td>';
				$ListAllData .='<td >'.$value->NAME.'</td>';
				$ListAllData .='<td>'.date('d M Y', strtotime($value->reserve_date)).'</td>';
				$ListAllData .='<td>'.$statusSales[$value->STATUS].'</td>';
				$ListAllData .='<td>'.$value->descs.'</td>';
				// $table = 'rl_nup_type';
				// $crit = array('nup_type'=>$value->nup_type);
				// $dtNup = $this->m_wsbangun->getData_by_criteria($table, $crit);
				// // var_dump($dtNup);
				// if(!empty($dtNup)) {
				// 	$ListAllData .= '<td >'.$dtNup[0]->descs.'</td>';
				// } else {
				// 	$ListAllData .= '<td >'.$value->nup_type.'</td>';
				// }
				// $ListAllData .= (empty($dtNup) ? '<td >'.$dtNup[0]->descs.'</td>' : '<td >'.$value->nup_type.'</td>');
				// $ListAllData .='<td >'.$value->nup_type.'</td>';
				
				if($value->STATUS <> "U"){
					$a = '<a href = "'.base_url('c_nup/submit/'.$value->nup_no).'" class="btn btn-primary disabled">Submit</a>&nbsp;&nbsp;';
				}else{
					$a = '<a href = "'.base_url('c_nup/submit/'.$value->nup_no).'" class="btn btn-primary">Submit</a>&nbsp;&nbsp;';
				}

				if($value->STATUS <> "P"){
					$b = '<a href = "'.base_url('c_pm_bill_sch/index/'.$value->nup_no).'" class="btn btn-success disabled"  target="_blank"><i></i> Preview </a>&nbsp;&nbsp;';
					$c = '<a href = "'.base_url('c_reports/sp/'.$value->nup_no.'/'.$value->nup_no).'" class="btn btn-warning disabled">Send</a>&nbsp;&nbsp;';
				}else{
					$b = '<a href = "'.base_url('c_reports/nup/'.$value->nup_no).'" class="btn btn-success"  target="_blank"><i></i> Preview </a>&nbsp;&nbsp;';
					$c = '<a href = "'.base_url('c_pm_bill_sch/index/'.$value->nup_no.'/'.$value->nup_no).'" class="btn btn-warning">Send</a>&nbsp;&nbsp;';
				}

				$d = '<a href = "'.base_url('c_nup_dt/list_dt/'.$value->nup_no).'" class="btn btn-danger">Unit</a>';
				
				$ListAllData .='<td align="center" style = "width:200px">'.$a.$b.$c.$d.'</td>';
				$ListAllData .='</tr>';
				$i++;
			}
			
			$ContentAllData = array('RlSalesList' => $ListAllData,
				'kondisi'=>$x,
				'ProjectDescs'=>$prjDesc);
			
		}else{
			$list_curr = '';
			$paging2 = '';

			$ContentAllData = array(
				'RlSalesList' => $list_curr,
				// 'paging' => $paging2,
				'ProjectDescs'=>$prjDesc,
				'kondisi'=>$x);
			// $this->load->view('v_currency', $ContentAllData2);	
		}
		
		$this->load_content_top_menu('booking/v_list_nup',$ContentAllData);
	}
	public function check_delete_attachment(){
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $seqno =  $this->input->post('seqno', TRUE);
		$sql = "SELECT count(file_attached) as counter FROM mgr.rl_nup_attachment(nolock) ";
		$sql.= "WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
		// $sql.= "AND (status_attach IS NULL OR status_attach='0')";
		$dtCnt = $this->m_wsbangun->getData_by_query($sql);
		$cnt = $dtCnt[0]->counter;

		$where=array('entity_cd'=>$entity,
					'project_no'=>$project,
					'nup_sequence_no'=>$seqno);
		if($cnt==0){
			$this->m_wsbangun->deletedata('rl_nup_attachment',$where);
		}
		echo json_encode($cnt);

	}
	public function chosen_nup_type(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
var_dump($id);
		$table = 'rl_nup_type(nolock)';
        $obj = array('nup_type', 'descs');
        $where =array('entity_cd'=>$entity,
        			'project_no'=>$project);
        $data = $this->m_wsbangun->getCombo($table,$obj,$where,$id);
        echo $data;
	}
	public function chosen_location(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cf_location(nolock)';
        $obj = array('location_cd', 'descs');
      
        $data = $this->m_wsbangun->getCombo($table,$obj,null,$id);
        echo $data;
	}
	public function chosen_reason(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cf_reason(nolock)';
        $obj = array('reason_cd', 'descs');
      
        $data = $this->m_wsbangun->getCombo($table,$obj,null,$id);
        echo $data;
	}
	public function show_edit_data($ID=''){
		// $rowID = (string)$this->input->post('ID', TRUE);
		// $seqno = (string)$this->input->post('seqno', TRUE);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$where =array('entity_cd'=>$entity,
					'project_no'=>$project,
					'rowID'=>$ID);
		$data = $this->m_wsbangun->getData_by_criteria('v_nup_update',$where);

		echo json_encode($data);

	}
	public function edit_rev($status='',$rowID='')
	{
		// $rowID = (string)$this->input->post('ID', TRUE);
  //       $status = (string)$this->input->post('status', TRUE);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        
        
        $sql = "select reserve_by,nup_sequence_no,location_cd,rowID from mgr.v_nup_update ";
        $sql.= " where entity_cd ='".$entity."' and project_no='".$project."' and rowID='".$rowID."'";
        $data = $this->m_wsbangun->getData_by_query($sql);	
        
        $today = date('d M Y');
        // $today = DateTime::createFromFormat('d M Y', $today);
        // $today = $today->format('d M Y');
        // if($status)
       

		$sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
        $dtPhase = $this->m_wsbangun->getData_by_query($sql);

        //  $table = 'rl_nup_type(nolock)';
        // $crit = array('nup_type', 'descs');
        // $nuptype = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'agent_details';
        $crit = array('userid'=>$data[0]->reserve_by);
        $agent = $this->m_wsbangun->getData_by_criteria($table,$crit);
		
		$table = 'pl_project(nolock)';
        $crit = array('entity_cd'=>$entity,
        	'project_no'=>$project);
        $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        $prjName = empty($dtPrj) ? '' : $dtPrj[0]->descs;
        
        if($status=='I'){
        	$status='E';
        }
        $cnt = $this->cek_nup_attach($entity,$project,$data[0]->nup_sequence_no,$data[0]->reserve_by);
		
		if($status=='A' || $status=='U'){
			
        	$crit = array('reason_cd', 'descs');
        	$reason = $this->m_wsbangun->getCombo('cf_reason',$crit);

			$content = array(
        	// 'comboType'=>$data[0]->location_cd,
        	// 'comboPhase'=>$cbphase,
        	// 'user'=>$data[0]->reserve_by,
        	'seqno'=>$data[0]->nup_sequence_no,
        	'project'=>$prjName,
        	'phase'=>$dtPhase[0],
        	'today'=>$today, 
        	'status'=>$status, 
        	'cnt'=>$cnt,      	
        	// 'agent'=>$agent[0],
        	'rowID'=>$data[0]->rowID,
        	'reason'=>$reason);

			$this->load_content_top_menu('booking/v_rl_nupRev',$content);
		}else{
			$content = array('comboTnup'=>'',
        	'comboType'=>$data[0]->location_cd,
        	// 'comboPhase'=>$cbphase,
        	'user'=>$data[0]->reserve_by,
        	'seqno'=>$data[0]->nup_sequence_no,
        	'project'=>$prjName,
        	'phase'=>$dtPhase[0],
        	'today'=>$today, 
        	'status'=>$status, 
        	'cnt'=>$cnt,      	
        	'agent'=>$agent[0],
        	'rowID'=>$data[0]->rowID);

			$this->load_content_top_menu('booking/v_rl_nupNew',$content);	
		}
        
	}
	public function insert($status='') 
	{
		// $status = (string)$this->input->post('status', TRUE);
		// var_dump($status);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $today = date('d M Y');

        $dday = date('d M Y H:i:s');
        $table = 'rl_nup_type(nolock)';
        $crit = array('nup_type', 'descs');
        $nuptype = $this->m_wsbangun->getCombo($table,$crit);
        // $table = 'cf_business(nolock)';
        // $crit = array('business_id', 'name');
        // $customer = $this->m_wsbangun->getCombo($table,$crit);
        // $table = 'rl_phase(nolock)';
        // $crit = array('phase_cd', 'descs');
        // $cbphase = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'cf_trx_type(nolock)';
        $crit = array('trx_type', 'descs');
        $cbtrxtype = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'agent_details';
        $crit = array('userid'=>$user);
        $agent = $this->m_wsbangun->getData_by_criteria($table,$crit);
        // var_dump($agent);
        // $table = 'cb_activity_type(nolock)';
        // $crit = array('activity_type', 'descs');
        // $cbtype = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'cf_location (nolock)';
        $crit = array('location_cd', 'descs');
        $cbtype = $this->m_wsbangun->getCombo($table,$crit);

        $table = 'pl_project(nolock)';
        $crit = array('entity_cd'=>$entity,
        	'project_no'=>$project);
        $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        $prjName = empty($dtPrj) ? '' : $dtPrj[0]->descs;
        $sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
        $dtPhase = $this->m_wsbangun->getData_by_query($sql);
        // if(empty($dtPhase)){
        // 	show_404();
        // 	return;
        // }else{
        // 	$dtPhase = $dtPhase[0]->descs;	
        // }                
           	
        	$sql = "SELECT counter from mgr.next_number where name='nup_sequence_no'";
        	$dtSeq = $this->m_wsbangun->getData_by_query($sql);
        	$seqno = (int) $dtSeq[0]->counter;
			$upseq = intval($seqno) + 1;
	    	$sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='nup_sequence_no'";
	    	$this->m_wsbangun->setData_by_query($sql);
		
    	$cnt = $this->cek_nup_attach($entity,$project,$seqno,$user);

        $content = array('comboTnup'=>$nuptype,
        	// 'comboCs'=>$customer,
        	'comboType'=>$cbtype,
        	// 'comboPhase'=>$cbphase,
        	'comboTrxType'=>$cbtrxtype,
        	'user'=>$user,
        	'seqno'=>$seqno,
        	'project'=>$prjName,
        	'phase'=>$dtPhase[0],
        	'today'=>$today, 
        	'status'=>$status,       	
        	'cnt'=>$cnt,
        	'agent'=>$agent[0],
        	'rowID'=>0);
        $this->load_content_top_menu('booking/v_rl_nupNew',$content);
	}
	function cek_nup_attach($entity='',$project='',$seqno='',$user=''){
		$dday = date('d M Y H:i:s');
		$sql = "IF NOT EXISTS(SELECT nup_sequence_no FROM mgr.rl_nup_attachment WHERE nup_sequence_no=$seqno) ";
    	$sql.= "INSERT into mgr.rl_nup_attachment(entity_cd, project_no, document_no, document_descs, document_status, nup_sequence_no, audit_user, audit_date) ";
        $sql.= "SELECT entity_cd, project_no, document_no, descs, STATUS, $seqno, '$user', '$dday' FROM mgr.rl_document_mst WHERE entity_cd='$entity' AND project_no='$project'";
        $exc = $this->m_wsbangun->setData_by_query($sql);
        $sql = "SELECT count(nup_sequence_no) as counter FROM mgr.rl_nup_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
        $sql.= "AND (status_attach IS NULL OR status_attach='0')";
        $dtCnt = $this->m_wsbangun->getData_by_query($sql);
        $cnt = $dtCnt[0]->counter;

        return $cnt;
	}
	public function save_cf_business($ID='',$name='',$hp='',$email='',$user=''){

		$table = 'cf_business';      
		$class =  $this->m_business->zomm_class(); 
        $class_cd = $class[0]->class_cd;

		if($ID==0){
		$AutoNumber = $this->m_business->get_autonumber();
        
        $Number = (int)$AutoNumber[0]->COUNTER;	
        $data = array(
                			'business_id'=>$Number,
                			'class_cd'=>$class_cd,
  							'category'=>'I',
  							'name'=>$name,  							
  							'hand_phone'=>$hp,
  							'email_addr'=>$email,
                			"audit_user"=>$user,
                			"audit_date"=>date("d M Y h:i:s")
  				);
        $this->m_wsbangun->insertData($table,$data);
        $data=array(
                        "COUNTER"=>$Number + 1 
                        );
       	$where=array("name" => "business_id");
       	$this->m_business->update($data, $where); 
		}
		else
			{
				$Number = $ID;
				$data = array(
	                			'business_id'=>$Number,
	                			'class_cd'=>$class_cd,
	  							'category'=>'I',
	  							'name'=>$name,  							
	  							'hand_phone'=>$hp,
	  							'email_addr'=>$email,
	                			"audit_user"=>$user,
	                			"audit_date"=>date("d M Y h:i:s")
	  				);
				$where =array('business_id'=>$Number);
				$this->m_wsbangun->updateData($table,$data, $where);
             

			}
		

        
        // var_dump($editdata);
            	
  		
        
        return $Number;
  			
  			
	}
	public function insert_his($rowID=''){
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $sql ="INSERT INTO mgr.rl_reserve_nup_his ";
        $sql.=" select * from mgr.rl_reserve_nup WHERE rowID= ".$rowID;
        // $result = $this->m_wsbangun->getData_by_query($sql);
        $DB2 = $this->load->database('ifca', TRUE);
        $query = $DB2->query($sql);

	}
	public function savenup()
	{
		if($_POST)
		{
			// var_dump($_POST);
			$tday = date('d M Y');
			$today = date('d M Y H:i:s');
			$bussiness_id = $this->input->post('bussiness_id', TRUE);
			$rowID = $this->input->post('rowID', TRUE);
			$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$user = $this->session->userdata('Tsuname');
        	$rsvdate = $this->input->post('rsvdate', TRUE);
        	$rsvby = $this->input->post('rsvby', TRUE);
        	$customer = $this->input->post('customer', TRUE);
        	$HP = $this->input->post('HP', TRUE);
        	$Email = $this->input->post('Email', TRUE);
        	// $nupno = $this->input->post('nupno', TRUE);
        	$nuptype = $this->input->post('nuptype', TRUE);
        	$nupdesc = $this->input->post('nupdesc', TRUE);
        	$nupamt = $this->input->post('nupamt', TRUE);
        	// $commamt = $this->input->post('commamt', TRUE);
        	// $type = $this->input->post('type', TRUE);
        	$pref = $this->input->post('prefix', TRUE);
        	$phase = $this->input->post('phase', TRUE);
        	$seqno = $this->input->post('seqno', TRUE);
        	$bankcd = $this->input->post('bankcd', TRUE);
        	$Location = $this->input->post('Location', TRUE);
        	$status = $this->input->post('status', TRUE);
        	$reason_cd = $this->input->post('reason_cd', TRUE);
        	if(empty($reason_cd)){
        		$reason_cd =' ';
        	}
        	$today = date('d M Y H:i:s');
        	
        	$table = 'agent_details';
	        $crit = array('userid'=>$user);
	        $agent = $this->m_wsbangun->getData_by_criteria($table,$crit);
	        $parsednupamt = floatval(preg_replace('/[^\d.]/', '', $nupamt));
			
	       
	        $number = $this->save_cf_business($bussiness_id,$customer,$HP,$Email,$user);
	        $nupno =' ';
	        	
	        	$table = 'rl_reserve_nup';
	        if($status=='I'){
	        	$data = array('entity_cd'=>$entity,
	        		'project_no'=>$project,
	        		'reserve_by'=>$user,
	        		'reserve_date'=>$today,
	        		'nup_type'=>$nuptype,
	        		'descs'=>$nupdesc,
	        		'prefix'=>$pref,
	        		'audit_user'=>$user,
	        		'audit_date'=>$today,
	        		'group_cd'=>$agent[0]->group_cd,
	        		'agent_cd'=>$agent[0]->agent_cd,
	        		'agent_type_cd'=>$agent[0]->agent_type_cd,
	        		'nup_amt'=>$parsednupamt,
	        		'business_id'=>$number,
	        		'nup_no'=>$nupno,
	        		'status'=>$status,
	        		'nup_sequence_no'=>$seqno,
	        		// 'comm_amt'=>$commamt,
	        		// 'type'=>$type,
	        		// 'trx_type'=>$bankcd,
	        		'phase_cd'=>$phase,
	        		'location_cd'=>$Location);

	        	$this->m_wsbangun->insertData($table, $data);
	        
	        	// redirect('c_nup/nup_list');
	        	$a = "Data has been saved successfully";

				}else{
					if($status=='E'){
						$status ='I';
					}else if($status=='A' || $status=='U'){
						$status ='R';
						$this->insert_his($rowID);
					}
					$data = array('entity_cd'=>$entity,
	        		'project_no'=>$project,
	        		'reserve_by'=>$user,
	        		'reserve_date'=>$today,
	        		'nup_type'=>$nuptype,
	        		'descs'=>$nupdesc,
	        		'prefix'=>$pref,
	        		'audit_user'=>$user,
	        		'audit_date'=>$today,
	        		'group_cd'=>$agent[0]->group_cd,
	        		'agent_cd'=>$agent[0]->agent_cd,
	        		'agent_type_cd'=>$agent[0]->agent_type_cd,
	        		'nup_amt'=>$parsednupamt,
	        		'business_id'=>$number,
	        		'nup_no'=>$nupno,
	        		'status'=>$status,
	        		'nup_sequence_no'=>$seqno,
	        		// 'comm_amt'=>$commamt,
	        		// 'type'=>$type,
	        		'revision_reason'=>$reason_cd,
	        		// 'trx_type'=>$bankcd,
	        		'phase_cd'=>$phase,
	        		'location_cd'=>$Location);

	        		$where =array('rowID'=>$rowID);
					$this->m_wsbangun->updateData($table,$data, $where);
					if($status=='I'){
						$a = "Data has been Updated successfully";
					}else{
						$a = "Data has been Revised successfully";
					}
				}

	        
		} else {
			$a = "Data is not valid";
		}
		$msg = array('pesan'=>$a);
		echo json_encode($msg);
	}
	public function Delete(){
        $id = $this->input->post("id",true);
        $seqno = $this->input->post("seqno",true);
        $business_id = $this->input->post("business_id",true);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
       
        // $sql ="SELECT business_id,nup_sequence_no FROM mgr.rl_reserve_nup WHERE rowID=".$id;
        // $data = $this->m_wsbangun->getData_by_query($sql);        
        // if(!empty($data)){
        	// $business_id = $data[0]->business_id;
        	// $seqno 		 = $data[0]->nup_sequence_no;
        
	        $where=array('business_id'=>$business_id);
	        $data = $this->m_wsbangun->deletedata('cf_business',$where);

	        $where=array('nup_sequence_no'=>$seqno,
	        			'entity_cd'=>$entity,
	        			'project_no'=>$project);
	        $data = $this->m_wsbangun->deletedata('rl_nup_attachment',$where);

	        $where=array('rowID'=>$id,
	        			'entity_cd'=>$entity,
	        			'project_no'=>$project);
	        $data = $this->m_wsbangun->deletedata('rl_reserve_nup',$where);


	        $msg = "Data has been deleted successfully";
	        $status='ok';
	    // }else{
	    // 	$msg = "Could't Delete rl_reserve_nup rowID ".$id;
	    // 	$status='fail';
	    // }
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);

    }
    public function SubmitStatus(){
    	$id = $this->input->post("id",true);
    	$status = $this->input->post("status",true);
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
    	if($status=='I'){
    		$status='S';
    	}else if($status=='R'){
    		$status='T';
    	}

    	$data =array('STATUS'=>$status);
    	$where=array('entity_cd'=>$entity,
    				'project_no'=>$project,
    				'rowID'=>$id);
    	$this->m_wsbangun->updateData('rl_reserve_nup', $data, $where);
    	$msg="Data has been Submit";
    	$msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
	public function addNew()//($dt=null, $row=null)
    {
        // if(!empty($dt)&&!empty($row))
        // {	
        	// var_dump($dt);
            // $content = array('dt'=>$dt, 'row'=>$row);
            // $this->load->view('booking/v_nup_upload',$content);
        // } else {
        //     show_404();
        //     return;
        // }
        $this->load->view('booking/v_nup_upload');
    }

	public function saveUpload()
	{
		if($_POST)
		{
			$webuser = $this->session->userdata('Tsuname');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $today = date('d M Y H:i:s');
            $row = $this->input->post('row',true);
            $seqno = $this->input->post('sn',true);
            $files = $_FILES;
			$cnt ='';
            $picname = str_replace(' ', '_', $files['userfile']['name']);
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());
            // if(!$this->upload->do_upload()) 
            // { 
            //     // $data['error'] = $this->upload->display_errors();
            //     $msg = $this->upload->display_errors();
            //     // var_dump($data);
            //     // return $data;
            // } else {
            	$tmpName = $_FILES['userfile']['tmp_name'];
				$imgString = file_get_contents($tmpName);
				$imgData = bin2hex($imgString);

				$sql = "UPDATE MGR.rl_nup_attachment SET file_attachment='$picname', file_attached=CONVERT(varbinary(MAX),'$imgData'), status_attach='1', audit_date='$today' ";
				$sql.= "WHERE rowID=$row";
				$this->m_wsbangun->setData_by_query($sql);
				$msg = "file has been saved successfully";

				$sql = "SELECT count(nup_sequence_no) as counter FROM mgr.rl_nup_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
		        $sql.= "AND (status_attach IS NULL OR status_attach='0')";
		        $dtCnt = $this->m_wsbangun->getData_by_query($sql);
		        $cnt = $dtCnt[0]->counter;
		        if(empty($dtCnt)){
		        	$cnt = 0;
		        }
            // }
            $res = array('pesan'=>$msg, 
            			'count'=>$cnt
            			);
            echo json_encode($res);
            // $this->insert($data);
            // return;
            // save
            // $table = 'rl_nup_attachment(nolock)';
            // $crit = array('rowID'=>$row);


		} 
		// else {
		// 	show_404();
		// 	return;
		// }
	}

	public function getTableAttach(){

		$entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $seqno = $this->input->post('seqno', true);
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number', 'document_no', 'document_descs', 'file_attachment');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.rl_nup_attachment';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('search', true);
        $Search = $sSearch['value'];
        $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $aColumns[1] :$column[$sortIdColumn]['name']);

     

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
        $param =" Where nup_sequence_no=".$seqno." AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
	public function getTable()
    {
       $entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','rowID', 'nup_no', 'reserve_date','STATUS','nup_type');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_nup_update';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('search', true);
        $Search = $sSearch['value'];
        $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'nup_no' :$Column[$sortIdColumn]['name']);

     

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
        $param =" Where userid='".$name."' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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

	public function getImage()
	{
		$rowid = $this->input->post('rid', true);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // var_dump($rowid);
        $table = 'rl_nup_attachment(nolock)';
        $crit = array('rowID'=>$rowid);
        $dtAtch = $this->m_wsbangun->getData_by_criteria($table, $crit);
        // var_dump($dtAtch);
        echo json_encode($dtAtch);
	}


	public function getImages($n, $s)
	{
		$DB2 = $this->load->database('ifca',TRUE);
		$sql = "SELECT CONVERT(varbinary(MAX),'file_attached') AS image FROM mgr.rl_nup_attachment WHERE nup_no = '$n' AND sec_no=$s";
		$a = $DB2->query($sql);
		var_dump($a);
		if($a->num_rows() > 0)
		{
			$obj = $a->row();
		}
		return $obj->image;
		// if(is_readable(filename))
	}

	public function remove()
    {
        $id = $this->input->post("rid",true);
        if(empty($id)){
            $msg = "Data is not successfully deleted";
        } else {
        	$table = 'rl_nup_attachment';
            $where = array('rowID'=>$id);
            $data = array('file_attachment'=>'',
            	'status_attach'=>'0',
            	'file_attached'=>null);
            $res = $this->m_wsbangun->updateData($table, $data, $where);
            $msg = "File has been removed successfully";
        }
        $output = array("Pesan"=>$msg);
        echo json_encode($output);
    }

	public function index2()
	{
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        
		// $dtotal = $this->m_rl_sales_list->getdata_row();

		// foreach ($dtotal as $value) {
		// 	$total++;
		// }
		// index.php/c_rl_sales/index/10
		// $config['base_url'] = base_url("index.php/c_rl_sales_list/index");
		// $config['base_url'] = base_url("c_rl_sales_list/index");
		// $config['total_rows'] = $total;
		// $config['per_page'] = 10;

		// $this->pagination->initialize($config); 

		// $paging = $this->pagination->create_links();
		// var_dump($offset);

		// $AllData = $this->m_rl_sales_list->DataPaging();
		// $AllData = $this->m_rl_sales->GetAllData();
        $tabel2 = 'rl_sales';
	 	$kriteria2 = array(
	 		'entity_cd'=>$entity,
	 		'project_no'=>$project);
		$datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2, $kriteria2);

		$statusSales = array('B'=>'Approve', 'P'=>'Not Approve', 'E'=>'Pending', 'C'=>'Cancel','T' => '');
		
		if(!empty($datalist2)){
			$ListAllData = '';
			$i=1;
			foreach ($datalist2 as $value) {
				$ListAllData .='<tr role="row" class="odd">';
				$ListAllData .='<td class="sorting_1">'.$value->ref_no.'</td>';

					$tabel3 = 'cf_business';
					$listName = $value->business_id;
					$kriteria3 = array( 'business_id' => $listName);
					$allName = $this->m_wsbangun->getData_by_criteria($tabel3, $kriteria3);

					$list = '';

					if ($allName) 
					{
						foreach ($allName as $key => $value2) 
						{
							$list .= '<td><a href = "'.base_url('c_cf_business/editCustomer/'.$value->business_id).'">'.$value2->name.'<a></td>';
						}
					}
					$ListAllData .= $list;

				// $ListAllData .='<td><a href = "'.base_url('c_cf_business/editCustomer/'.$value->business_id).'">'.$value->NAME.'<a></td>';
				$ListAllData .='<td>'.$value->lot_no.'</td>';
				// $ListAllData .='<td>'.$value->descs.'</td>';
				$ListAllData .='<td class="text-right">'.number_format($value->sell_price,2).'</td>';
				// $ListAllData .='<th>'.$value->status.'</th>';
				$ListAllData .='<td>'.$statusSales["$value->status"].'</td>';
				$ListAllData .='<td>'.date('Y-m-d', strtotime($value->sales_date)).'</td>';
				// // $ListAllData .='<th class="text-right">'.number_format($value->sell_price,2).'</th>';
				$ListAllData .='<td><a href = "'.base_url('c_rl_sales/edit/'.$value->lot_no).'" class="btn btn-primary"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;';
				$ListAllData .='<a href = "'.base_url('c_pm_bill_sch/index/'.$value->lot_no).'" class="btn btn-success"><i></i> Billing </a>&nbsp;&nbsp;';
				$ListAllData .='<a href = "'.base_url('c_reports/sp/'.$value->debtor_acct.'/'.$value->lot_no).'" class="btn btn-warning" target="_blank"><i class="fa fa-print"></i></a></td>';
				$ListAllData .='</tr>';
				$i++;
			}
			
			$ContentAllData = array('RlSalesList' => $ListAllData);

			// $this->load->view('template/header');
			// // $this->load->view('template/left');
			// $this->load->view('v_rl_sales', $ContentAllData);
			// $this->load->view('template/footer');
			// $ContentAllData = array('RlSales' => $ListAllData);
		}else{
			$list_curr = '';
			$paging2 = '';

			$ContentAllData = array(
				'RlSalesList' => $list_curr,
				'paging' => $paging2);
			// $this->load->view('v_currency', $ContentAllData2);	
		}
		// var_dump($AllData);
		// $this->load->view('template/header');
			// $this->load->view('template/left');
		// $this->load->view('v_rl_sales_list', $ContentAllData);
		// $this->load->view('template/footer');

		// $this->load->view('template/v_header');
		// $this->load->view('template/v_menu');
		// $this->load->view('v_rl_sales_list', $ContentAllData);
		// $this->load->view('template/v_footer');
		$this->load_content('booking/v_rl_sales_list',$ContentAllData);
	}

	// public function hasilcari()
	// {
	// 	$perpage = 10;			
	// 	$total = 0;
	// 	$offset = $this->uri->segment(3);

	// 	if($offset===false){
	// 		$offset = 0;
	// 	}

	// 	$perpage = $perpage + $offset;

	// 	$dtotal = $this->m_rl_sales_list->getdata_row();
	// 	//var_dump($dtotal);

	// 	foreach ($dtotal as $value) {
	// 		$total++;
	// 	}

	// 	$config['base_url'] = base_url("index.php/c_rl_sales_list/hasilcari");
	// 	$config['total_rows'] = $total;
	// 	$config['per_page'] = 10; 

	// 	$this->pagination->initialize($config); 

	// 	$paging = $this->pagination->create_links();

	// 	$AllData = $this->m_rl_sales_list->DataPaging($offset, $perpage);

	// 	if($_POST){
	// 		$paging = null;
	// 		$cari = $this->input->post('search',TRUE);
	// 		$data = $this->m_rl_sales_list->cari($cari);
	// 		$ListAllData = '';
	// 		$i = 1;
	// 		if(!empty($data)){
	// 			foreach ($data as $value) {
	// 				$ListAllData .='<tr>';
	// 				$ListAllData .='<th>'.$i.'</th>';
	// 				$ListAllData .='<th>'.$value->business_id.'</th>';
	// 				$ListAllData .='<th>'.$value->NAME.'</th>';
	// 				$ListAllData .='<th>'.$value->lot_no.'</th>';
	// 				$ListAllData .='<th>'.$value->descs.'</th>';
	// 				$ListAllData .='<th>'.$value->sales_date.'</th>';
	// 				$ListAllData .='<th class="text-right">'.number_format($value->sell_price,2).'</th>';
	// 				$ListAllData .='<th><a href = "'.base_url('index.php/c_pm_bill_sch/index/'.$value->lot_no).'"><input type = "button" name="billing" value="Billing"></a></th>';
	// 				$ListAllData .='</tr>';
	// 				$i++;
	// 			}
	// 			// date_format($date,"Y/m/d H:i:s");
	// 			$content = array(
	// 				'RlSalesList' => $ListAllData,
	// 				'paging' => $paging);
				
	// 			// $this->load->view('v_currency',$content);

	// 			$this->load->view('template/v_header');
	// 			$this->load->view('template/v_menu');
	// 			$this->load->view('v_rl_sales_list', $content);
	// 			$this->load->view('template/v_footer');
	// 		}else{
	// 			$this->index();
	// 		}
			
	// 	}

	// }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */