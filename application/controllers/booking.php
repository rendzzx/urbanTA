<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends Core_Controller {
	
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
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
		$projectName = $this->session->userdata('Tsprojectname');

		$table = 'v_reservation_update';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $cons = $this->session->userdata('Tscons');
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

        $x = "enable";
        $unit = "enable";
        // $x = $this->validasi_button_new($entity,$project);
        // $unit = $this->validasi_button_unit($entity,$project);
        // var_dump($unit);exit;
        
    // 	$ContentAllData = array('kondisi'=>$x,
    // 			'project_no'=>$project,
				// 'ProjectDescs'=>$prjDesc);

         // $csrf = array(
         //            'name' => $this->security->get_csrf_token_name(),
         //            'hash' => $this->security->get_csrf_hash()
         //    );

        $encParam = base64_encode($project.'-'.$projectName);
        // var_dump($encParam);

    	$ContentAllData = array(
    			'kondisi'=>$x,
    			'project_no'=>$project,
				'ProjectDescs'=>$projectName,
				'btnUnit'=>$unit,
				'product'=>$dtProduct,
				'encParam'=>$encParam
             );

    	// $ContentAllData['csrf']=$csrf;

    	$this->load_content_top_menu('bookingnew/NupIndex',$ContentAllData);
    }

    public function goto_form($status=''){
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $today = date('d M Y');
        $dday = date('d M Y H:i:s');

 		$table = 'rl_nup_type(nolock) order by nup_type';
 		// $table = 'SELECT * from mgr.rl_nup_type order by nup_type';
        $crit = array('nup_type', 'descs');
        // $nuptype = $this->m_wsbangun->getCombo($table,$crit);

        $cons = $this->session->userdata('Tscons');
        $table = 'cf_business(nolock)';
        $crit = array('business_id', 'name');
        $customer = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $cons = $this->session->userdata('Tscons');
    	$table = 'cf_trx_type(nolock)';
        $crit = array('trx_type', 'descs');
        $cbtrxtype = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);
        $table = 'agent_details';
        $crit = array('userid'=>$user);
        $agent = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // var_dump($agent);

        $cons = $this->session->userdata('Tscons');
        $table = 'cb_activity_type(nolock)';
        $crit = array('activity_type', 'descs');
        $cbtype = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);
        
        // $table = 'pl_project(nolock)';
        // $crit = array('entity_cd'=>$entity,
        // 	'project_no'=>$project);
        // $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        // $prjName = empty($dtPrj) ? '' : $dtPrj[0]->descs;

        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
        $dtPhase = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT counter from mgr.next_number where name='nup_sequence_no'";
        $dtSeq = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $seqno = (int) $dtSeq[0]->counter;
       	$upseq = intval($seqno) + 1;
	    $sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='nup_sequence_no'";
	    $this->m_wsbangun->setData_by_query($sql);

    	$sql = "IF NOT EXISTS(SELECT nup_sequence_no FROM mgr.rl_nup_attachment WHERE nup_sequence_no=$seqno) ";
    	$sql.= "INSERT into mgr.rl_nup_attachment(entity_cd, project_no, document_no, document_descs, document_status, nup_sequence_no, audit_user, audit_date) ";
        $sql.= "SELECT entity_cd, project_no, document_no, descs, STATUS, $seqno, '$user', '$dday' FROM mgr.rl_document_mst WHERE entity_cd='$entity' AND project_no='$project'";
        $exc = $this->m_wsbangun->setData_by_query($sql);

        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT count(nup_sequence_no) as counter FROM mgr.rl_nup_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
        $sql.= "AND (status_attach IS NULL OR status_attach='0')";
        $dtCnt = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $cnt = $dtCnt[0]->counter;

        $content = array('comboTnup'=>$nuptype,
        	'comboCs'=>$customer,
        	'comboType'=>$cbtype,
        	// 'comboPhase'=>$cbphase,
        	'comboTrxType'=>$cbtrxtype,
        	'user'=>$user,
        	'seqno'=>$seqno,
        	'project'=>$projectName,
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
    	$cons = $this->session->userdata('Tscons');
    	$sql = "SELECT count(*) as counter from mgr.rl_nup_parameter (NOLOCK) where entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date and status = '1'";
        $Dataparam = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $c =intval($Dataparam[0]->counter);
        // var_dump($Dataparam);
        
        if($c > 0){
        	$x = 'enable';
        }else{
        	$x = 'disabled';
        }

        return $x;
    }

    function validasi_button_unit($entity=null,$project){
    	$today = date('d/m/Y');
    	$cons = $this->session->userdata('Tscons');
    	$sql = "SELECT count(*) as cnt FROM mgr.rl_nup_parameter (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date and status = 1 and choose_unit_status = 1";
        $Dataparam = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $c =intval($Dataparam[0]->cnt);
        // var_dump($Dataparam);
        
        if($c > 0){
        	$x = 'enable';
        }else{
        	$x = 'disabled';
        }

        return $x;
    }

    function sendInvitation()
    {
    	if($_POST)
    	{
    		$rowID = $this->input->post('rid', true);
    		$table = 'v_nup_update';
    		$crit = array('rowid'=>$rowID);
    		$cons = $this->session->userdata('Tscons');
    		$dtNup = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
    		if(!empty($dtNup))
    		{
    			$email = $dtNup[0]->Email;
    			$locid = $dtNup[0]->location_cd;
    			$entity = $dtNup[0]->entity_cd;
    			$project = $dtNup[0]->project_no;

    			$table = 'rl_nup_loc_attachment(nolock)';
    			$crit = array('entity_cd'=>$entity,
    				'project_no'=>$project,
    				'location_cd'=>$locid);
    			$cons = $this->session->userdata('Tscons');
    			$dtAtch = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
    			$pic = !empty($dtAtch) ? $dtAtch[0]->invitation_path : '';
    			$subj = 'Invitation';
    			$data = array('pic'=>$pic);
    			$body = $this->load->view('tesmail.php', $data, true);
    			if(filter_var($email, FILTER_VALIDATE_EMAIL))
    			{
    				$this->_sendmail($email, $subj, $body);
    				$msg = 'Invitation successfully send';
    			} else {
    				$msg = 'Email not valid';
    			}
    		} else {
    			$msg = "Data NUP not found";
    		}
    	} else {
    		$msg = 'Method not valid';
    	}
    	$output = array('pesan'=>$msg);
    	echo json_encode($output);
    }

	function tes()
	{
		
		// email
		$to = 'xiomi9669@gmail.com'; //'protozoa007@gmail.com'; //'xiomi9669@gmail.com';  
		// $pic = 'launch.jpg';
		// $pic = 'http://www.seevibes.com/en/wp-content/uploads/sites/2/2015/08/launch.png';
		$pic = 'http://gambar-rumah.com/attachments/bsd/6079213d1467342346-bsd-city-asatti-vanya-park-sinar-mas-dekat-aeon-asatti-garden-house-invitation-03-juli-2016.jpg';

		$subj = 'tes new email html';

		$data = array('pic'=>$pic);
		// $body = $this->load->view('Email/EmailSubmit',$data,TRUE);
    	// $this->email->message($body); 
		//if (preg_match("/^[a-zA-Z ]*$/",$to)) {
		if(filter_var($to, FILTER_VALIDATE_EMAIL))
		{
			// $pesan = '';
			// $pesan.= 'Dear Finance,'."\n\n";
			// $pesan.= 'Please approve NUP No. '.$dtNup[0]->nup_no.', descs: '.$dtNup[0]->descs."\n";
			// $pesan.= 'Name: '.$dtA[0]->NAME.', From Agent: '.$dtA[0]->group_name.' and Sales: '.$dtA[0]->agent_name."\n";
			// $pesan.= 'Total Amount : '.number_format($dtA[0]->nup_amt)."\n\n\n";
			// $pesan.= 'Thank you,';
			// $judul = 'Approval';
	        // $this->_sendmail($to, $subj, $body);
	        // var_dump($data);
	    } else {
	    	// var_dump('expression');
	    }
	    $this->load->view('Email/EmailSubmit',$data);

		// $str = "customer=1000002&nuptype=BZ&nupdesc=Bronze&grpcd=300&agtype=02&nupamt=5%2C000%2C000.00&type=01&prefix=&phase=02&seqno=1&bankcd=IH&cntfile=0";
		
		// $entity = $this->session->userdata('Tsentity');
		// $project = $this->session->userdata('Tsproject');
		// $user = $this->session->userdata('Tsuname');
		// $today = date('d M Y');
		// $table = 'rl_nup_type';
		// $crit = array('nup_type'=>$tnup,
		// 	'entity_cd'=>$entity,
		// 	'project_no'=>$project);
		// $dtNup = $this->m_wsbangun->getData_by_criteria($table, $crit);
		// $pref = $dtNup[0]->prefix;
		// $today = date('d M Y');
		// $DB2 = $this->load->database('ifca',TRUE);
		// $sql = "mgr.x_gen_docnumber '$entity', '$pref', '$user', '$today'";

		// // var_dump($sql);
		// $result = $DB2->query($sql);
		// // $dtGen = $this->m_wsbangun->getData_by_query($sql);
		// // array_push($dtNup, $sql[0]->output);
		// // var_dump($result);
		// // var_dump("expression");
		// // $dtNup[0] = array('nup_no'=>$dtGen->output);
		// $table = 'x_tformat';
		// $result = $this->m_wsbangun->getData($table);
		// $output = array(
		// 	"draw" => $_POST['draw'],
		// 	"recordsTotal" => $this->GetCust->count_all(),
		// 	"recordsFiltered" => $this->GetCust->count_filtered(),
		// 	"data" => $data,
		// );
		// // $sql = "SELECT output FROM ##t_format";
		// // $result = $DB2->query($sql);
		// // var_dump($result);
		// // var_dump("expression");
		// var_dump($dtNup);

		// // $dtNup[0] = array('nup_no'=>$result[0]->output);
		// $dtNup[0] = $result[0]->output;
		// var_dump($dtNup);
	}

	private function setUploadOptions()
    {
    	$max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/NUP',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
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
			$cons = $this->session->userdata('Tscons');
			$dtNup = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
			if(!empty($dtNup))
			{
				$pref = $dtNup[0]->prefix;
				$today = date('d M Y');
				$output = array('pesan'=>1,
					'pref'=>$dtNup[0]->prefix,
					'descs'=>$dtNup[0]->descs,
					'nup_amt'=>$dtNup[0]->nup_amt

					// ,'remarks'=>$dtNup[0]->remarks
					

					);
			} else {
				$output = array('pesan'=>0,
					'pref'=>null,
					'descs'=>null,
					'nup_amt'=>0
					 // ,'remarks'=>null

					 );
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

	public function setPayment()
	{
		if(!empty($_POST))
		{
			$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$user = $this->session->userdata('Tsuname');
			$tnup = $this->input->post('act');
			$nupseq = $this->input->post('bct');
			$table = 'rl_reserve_nup';
			$crit = array('nup_sequence_no'=>$nupseq, 'type'=>$tnup);
			$cons = $this->session->userdata('Tscons');
			$dtNup = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
			$rnup = !empty($dtNup) ? 1 : 0;
			$snup = !empty($dtNup) ? $dtNup[0]->payment_type_remarks : '';
			$table = 'cb_activity_type';
			$crit = array('activity_type'=>$tnup,
				'entity_cd'=>$entity);
			$cons = $this->session->userdata('Tscons');
			$dtNup = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
			if(!empty($dtNup))
			{				
				$output = array('pesan'=>$rnup,					
					'remarks'=>$dtNup[0]->remarks,
					'values'=>$snup);
			} else {
				$output = array('pesan'=>0,					
					'remarks'=>null,
					'values'=>null);
			}			
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
			$cons = $this->session->userdata('Tscons');
			$dtNup = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
			$table = 'v_rl_sales_nup';
			$cons = $this->session->userdata('Tscons');
			$dtA = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
			$table = 'rl_nup_email';
			$cons = $this->session->userdata('Tscons');
			$dtEmail = $this->m_wsbangun->getData_cons($cons,$table);
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
					// $isiSms = array(
	    //                 "DestinationNumber"=>$hp_no,
	    //                 "TextDecoded"=>$pesan,
	    //                 "CreatorID"=>'TWP'
	    //                 );
	    //         	$this->m_sms->sendSms($isiSms);
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
        $projectName = $this->session->userdata('Tsprojectname');
        
        // $table = 'pl_project(nolock)';
        // $crit = array('entity_cd'=>$entity,
        //     'project_no'=>$project);
        // $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        // $prjDesc = empty($dtPrj) ? '' : $dtPrj[0]->descs;
        // var_dump($project);
        $today = date('d/m/Y');
        // var_dump($today);

        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT count(*) as counter from mgr.rl_nup_parameter where entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date and status = '1'";
        $Dataparam = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
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
	 	$cons = $this->session->userdata('Tscons');
		$datalist2 = $this->m_wsbangun->getData_by_criteria_cons($cons,$tabel2, $kriteria2);

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
				'ProjectDescs'=>$projectName);
			
		}else{
			$list_curr = '';
			$paging2 = '';

			$ContentAllData = array(
				'RlSalesList' => $list_curr,
				// 'paging' => $paging2,
				'ProjectDescs'=>$projectName,
				'kondisi'=>$x);
			// $this->load->view('v_currency', $ContentAllData2);	
		}
		
		$this->load_content_top_menu('booking/v_list_nup',$ContentAllData);
	}

	public function check_attachment($seqno='',$from=''){
		if($seqno==''){
			$seqno =  $this->input->post('seqno', TRUE);
			$from =  $this->input->post('from', TRUE);
			
		}
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
		
		$sql = "SELECT count(*) as cnt , count(file_url) as counter FROM mgr.rl_nup_attachment(nolock) ";
		$sql.= "WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";

		$cons = $this->session->userdata('Tscons');
		$dtCnt = $this->m_wsbangun->getData_by_query2($sql);
		$cnt = $dtCnt[0]->counter;
		$ttlcnt = $dtCnt[0]->cnt;

		$sql2 = "SELECT isnull(max(type),'') as typemax, isnull(max(payment_type_remarks),'') as remarksmax from mgr.rl_reserve_nup (NOLOCK)";
		$sql2 .= "WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";

		$cons = $this->session->userdata('Tscons');
		$dtCntT = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
		$maxType = $dtCntT[0]->typemax;
		$maxRemarks = $dtCntT[0]->remarksmax;
		// $sql.= "AND (status_attach IS NULL OR status_attach='0')";	
		// var_dump($maxType);
		// var_dump($maxRemarks);

		if(strlen($maxType) == 0 || strlen($maxRemarks) == 0){

			$ttlcnt = 0;
			// var_dump('suskes');exit;
		}

		// var_dump('1');
		// 	var_dump($ttlcnt);
		if($from=='IN'){			
			return $cnt;
		}else{
			// $sql2 = "SELECT count(*) as counter FROM mgr.rl_nup_attachment(nolock) ";
			// $sql2.= "WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
			// // $sql.= "AND (status_attach IS NULL OR status_attach='0')";
			// $dtCnt = $this->m_wsbangun->getData_by_query($sql2);
			// $ttlcnt = $dtCnt[0]->counter;
			// var_dump('2');
			// var_dump($ttlcnt);
			if($ttlcnt==0){
				$cnt='FAIL';
			}else{
				if($ttlcnt==$cnt){
					$cnt ='OK';
				}else{
					$cnt ='FAIL';
				}	
			}		

			// $msg = array('pesan'=>$cnt);
			// echo json_encode($msg);
			echo $cnt;
		}
	}

	public function check_delete_attachment(){
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $seqno =  $this->input->post('seqno', TRUE);
		// $sql = "SELECT count(file_attached) as counter FROM mgr.rl_nup_attachment(nolock) ";
		// $sql.= "WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
		// // $sql.= "AND (status_attach IS NULL OR status_attach='0')";
		// $dtCnt = $this->m_wsbangun->getData_by_query($sql);
		// $cnt = $dtCnt[0]->counter;
		// var_dump($seqno);
        $sql = "SELECT count(*) as jumlah from mgr.rl_reserve_nup where nup_sequence_no = $seqno";
        // echo $sql; exit;
        $cons = $this->session->userdata('Tscons');
        $query = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $cnt = $query[0]->jumlah;
        // var_dump($countDt);exit;

  //       $cnt = $this->check_attachment($seqno,'IN');
		$where=array('entity_cd'=>$entity,
					'project_no'=>$project,
					'nup_sequence_no'=>$seqno);

        if($cnt == 0){
        	// if($cnt==0 ){
				$this->m_wsbangun->deletedata('rl_nup_attachment',$where);
			// }
        }
        echo json_encode($cnt);
	}

	public function chosen_salutation(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cf_business (nolock)';
        $obj = array('salutation', 'salutation');
        // var_dump($obj);
      
      	$cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,null,$id);
        echo $data;
	}

	public function chosen_country(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cf_country (nolock)';
        $obj = array('country_code', 'descs');
      
      	$cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,null,$id);
        echo $data;
	}

	public function chosen_nationality(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cf_nationality (nolock)';
        $obj = array('nationality_cd', 'descs');
      
      	$cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,null,$id);
        echo $data;
	}

	public function chosen_nup_type(){
		$id = $this->input->post('Id', TRUE);
		$product = $this->input->post('product', TRUE);
		$id = trim($id);
		// var_dump($id.' '.$product);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
		// var_dump($id);
		$table = 'rl_nup_type(nolock)';
		$order = array('nup_type', 'ASC');
        $obj = array('nup_type', 'descs');
        $where =array('entity_cd'=>$entity,
        			'project_no'=>$project,
        			'product_cd'=>$product);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,$where,$id,$order);
        echo $data;
	}
	
	public function chosen_city_(){
		$id =$this->input->post('q', TRUE);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $table = 'v_list_city';
        // $city = $this->m_wsbangun->getData_by_criteria($table, null, null, array('rowid','asc'));
        $sql = "select * from mgr.v_list_city where coba like '%$id%' order by rowid asc";
        $cons = $this->session->userdata('Tscons');
        $city = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        if(!empty($city)){
        	foreach ($city as $value) {
        		$row[] = array('id'=>$value->city,'text'=>$value->coba);
        	}
        	echo json_encode($row);
        }

	}

	public function chosen_city(){
		$id = $this->input->post('Id', TRUE);
		
		// $id = trim($id);
		// var_dump($id);

		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
		
        $table = 'v_list_city';
		$order = array("rowid","asc");//'"rowid" ,"ASC"';
        $obj = array('city', 'coba');
        $where = array('city'=>$id);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,$where,$id,$order);
        // var_dump($data);
        echo $data;
	}

	public function chosen_location(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cf_location(nolock)';
        $obj = array('location_cd', 'descs');
      
      	$cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,null,$id);
        echo $data;
	}


	public function chosen_reason(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cf_reason(nolock)';
        $obj = array('reason_cd', 'descs');
      
      	$cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,null,$id);
        echo $data;
	}

	public function chosen_payment(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cb_activity_type(nolock)';
        $obj = array('activity_type', 'descs');
      
      	$cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,null,$id);
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
		$cons = $this->session->userdata('Tscons');
		$data = $this->m_wsbangun->getData_by_criteria_cons($cons,'v_reservation_update',$where);


		echo json_encode($data);

	}
	public function show_e_data($ID=''){
		// $rowID = (string)$this->input->post('ID', TRUE);
		// $seqno = (string)$this->input->post('seqno', TRUE);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$where =array('entity_cd'=>$entity,
					'project_no'=>$project,
					'rowID'=>$ID);
		$cons = $this->session->userdata('Tscons');
		$dataa = $this->m_wsbangun->getData_by_criteria_cons('rl_reserve_nup',$cons,$where);


		echo json_encode($dataa);

	}

	public function cek_agent(){
		$status = $this->input->post('status',TRUE);
		$user = $this->session->userdata('Tsuname');
		
		$msg='';
		$table = 'cf_agent_dt (nolock)';
        $crit = array(
        	'userid'=>$user,
        	'status'=>'A');
        $cons = $this->session->userdata('Tscons');
        $agent = $this->m_wsbangun->getCount_by_criteria_cons($cons,$table,$crit);

        // if(empty($agent)){
        // 	$msg="FAIL";
        // }

        echo $agent;

	}

	public function showinfo($status = null)
	{
		// var_dump($status);exit;
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$sql = "select nup_type_info, nup_loc_info from mgr.rl_nup_spec where entity_cd ='$entity' and project_no = '$project'";
		$cons = $this->session->userdata('Tscons');
		$data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
		$info =$data[0]->nup_type_info;
		$loc_info = $data[0]->nup_loc_info;
		$content = array('info' => $info,
						'loc_info'=> $loc_info,
						'status' => $status);
        $this->load->view('nup/nuptypeinfo',$content);
	}

	public function zoom_nuptype(){
        $product = $this->input->post('prod',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
		$sql = "select * from mgr.rl_nup_type where product_cd='$product' ";
		$cons = $this->session->userdata('Tscons');
        $rst = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        //var_dump($rst);
		$combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                
                $combo[] = '<option value="'.trim($result->nup_type).'" >'.$result->descs.'</option>';
            }
            echo implode("", $combo);
      }
      public function zoom_property(){
        $product = $this->input->post('prod',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
		$sql = "select  product_type, descs from mgr.pm_product_dtl where entity_cd = '$entity' and project_no = '$project' and status = 'Y' and product_cd='$product' ";
		$cons = $this->session->userdata('Tscons');
        $rst = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        //var_dump($rst);
		$comboProp[] = '<option value=""></option>';
            foreach ($rst as $result) {
                
                $comboProp[] = '<option value="'.trim($result->product_type).'" >'.$result->descs.'</option>';
            }
            echo implode("", $comboProp);
      }
      public function zoom_property_edit(){
      	$product = $this->input->post('prod',TRUE);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $id = $this->input->post('Id', TRUE);

        $id = trim($id);

		$table = 'pm_product_dtl(nolock)';
        $obj = array('product_type', 'descs');
      	$where =array('entity_cd'=>$entity,
      				  'project_no'=>$project,
      				  'status'=>'Y',
      				  'product_cd'=>$product
      		);
      	$cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,$where,$id);
        echo $data;

      }

	public function edit_rev($status='',$rowID='')
	{
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');

        $table = 'v_cf_nationality (nolock)';
        $crit = array('nationality_cd', 'descs');
        $cbnationality = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $sql = "SELECT nup_type, descs, prefix, nup_amt, expired_minute FROM mgr.v_rl_nup_types WHERE entity_cd='$entity' AND project_no='$project'";
        $nuptype = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        if(!empty($nuptype)) {
                $comboProject[] = '<option></option>';
                foreach ($nuptype as $key) {
                  if($project === $key->nup_type) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$key->descs."-".$key->nup_type."-".$key->prefix."-".$key->nup_amt.'">'.$key->prefix." - ".$key->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }

        $sql = '';
        if($rowID!='' && $rowID!=null){
            $sql = "SELECT DISTINCT * FROM mgr.v_reservation_update WHERE rowID = '$rowID'";
        }
        else {
            $sql = "SELECT DISTINCT * FROM mgr.v_reservation_update WHERE audit_user = '$user'";
        }

        $DataMenu = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
       

        $content = array('project'=>$projectName,
                         // 'comboCountry'=>$cbcountry,
                         'cbnationality'=> $cbnationality,
                          'agent'=>$user,
                          // 'unit'=>$unit,
                          'nuptype'=>$comboProject,
                          // 'product_descs'=>$product_descs,
                          // 'payment_method'=>$this->zoom_payment_cd($unit,$entity),
                          // 'special_discount'=>$this->zoom_discount(),
                          // 'booking_fee_amt'=>$booking_fee_amt,
                          'seqno'=>'',
                        
                          // 'payment'=>$payment,
                          // 'product_cd'=>$product_cd,
                          'lot_no'=>'',
                          'rowIdsales'=>$rowID
                          // ,'comboMedia'=>$media
            );

        $this->load_content_top_menu('bookingnew/v_rl_BookingNew',$content);
    }
    
	public function edit_rev_a($status='',$rowID='')
	{
		// $rowID = (string)$this->input->post('ID', TRUE);
  		// $status = (string)$this->input->post('status', TRUE);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        // var_dump($rowID);
        
        // $sqlcb = "select distinct city as city, REPLACE(cast(city as char(50)) + mgr.cf_province.descs,' ','&nbsp;') as coba,  mgr.cf_province.rowid from mgr.cf_province_dtl, mgr.cf_province where  mgr.cf_province_dtl.province_cd = mgr.cf_province.province_cd order by mgr.cf_province.rowid";
        // $sqlcb = "select * from mgr.v_list_city";
        // $cbCity = $this->m_wsbangun->getData_by_query($sqlcb);
        // // var_dump($entityName);
        //     if(!empty($cbCity)) {
        //         $comboCity[] = '<option></option>';
        //         foreach ($cbCity as $dtCity) {
        //         //   if(trim($dtCity->rowid) == $selected_id) {
        //         //     $selected = ' selected="1"';
        //         // } else {
        //         //     $selected = '';
        //         // }
        //             $comboCity[] = '<option value="'.$dtCity->city.'">'.$dtCity->coba.'</option>';
        //         }
        //         $comboCity = implode("", $comboCity);
        //     }

        $sql = "SELECT reserve_by,nup_sequence_no,location_cd,rowID,payment_type_remarks,type FROM mgr.v_nup_update (NOLOCK) ";
        $sql.= " WHERE entity_cd ='".$entity."' and project_no='".$project."' and rowID='".$rowID."'";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);	
        $paymentremarks = $data[0]->payment_type_remarks;
        $today = date('d M Y');
        // $today = DateTime::createFromFormat('d M Y', $today);
        // $today = $today->format('d M Y');
        // if($status)
      	

        $table1 = 'cb_activity_type(nolock)';
        $crit1 = array('activity_type', 'descs');
        $cons = $this->session->userdata('Tscons');
        $payment = $this->m_wsbangun->getCombo_cons($cons,$table1,$crit1,null,$data[0]->type);


		$sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
		$cons = $this->session->userdata('Tscons');
        $dtPhase = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        //  $table = 'rl_nup_type(nolock)';
        // $crit = array('nup_type', 'descs');
        // $nuptype = $this->m_wsbangun->getCombo($table,$crit);

        $table = 'agent_details';
        $crit = array('userid'=>$data[0]->reserve_by);
        $cons = $this->session->userdata('Tscons');
        $agent = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
		
		// $table = 'pl_project(nolock)';
  //       $crit = array('entity_cd'=>$entity,
  //       	'project_no'=>$project);
  //       $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
  //       $prjName = empty($dtPrj) ? '' : $dtPrj[0]->descs;

        $table = 'cf_country (nolock)';
        $crit = array('country_code', 'descs');
        $cons = $this->session->userdata('Tscons');
        $cbcountry = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $table = 'v_reserve_product';
       	$crit = array('entity_cd'=>$entity,
        	 'project_no'=>$project);
       	$cons = $this->session->userdata('Tscons');
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
        
        if($status=='N'){
        	$status='E';
        }
        $cnt = $this->cek_nup_attach($entity,$project,$data[0]->nup_sequence_no,$data[0]->reserve_by);
		
		// var_dump($status);

		if($status == 'A' || $status == 'P' || $status == 'V' || $status == 'R'){	
			// var_dump('ref');
        	$crit = array('reason_cd', 'descs');
        	$cons = $this->session->userdata('Tscons');
        	$reason = $this->m_wsbangun->getCombo_cons($cons,'cf_reason',$crit);

			$content = array(
        	// 'comboType'=>$data[0]->location_cd,
        	// 'comboPhase'=>$cbphase,
        	// 'user'=>$data[0]->reserve_by,
			// 'comboCity'=>$comboCity,
        	'seqno'=>$data[0]->nup_sequence_no,
        	'project'=>$projectName,
        	'phase'=>$dtPhase[0],
        	'today'=>$today, 
        	'status'=>$status, 
        	'cnt'=>$cnt,      	
        	// 'agent'=>$agent[0],
        	'rowID'=>$data[0]->rowID,
        	'reason'=>$reason,
        	'payment'=>$payment
        	,'payment_type_remarks'=>$paymentremarks,
        	'product'=>$dtProduct);

			$this->load_content_top_menu('booking/v_rl_nupRev2',$content);
		}else{
			// var_dump('edit');
			$content = array('comboTnup'=>'',
        	'comboLocation'=>$data[0]->location_cd,
        	// 'comboPhase'=>$cbphase,
        	// 'comboCountry'=>$cbcountry,
        	'user'=>$data[0]->reserve_by,
        	'seqno'=>$data[0]->nup_sequence_no,
        	// 'comboCity'=>$comboCity,
        	'project'=>$projectName,
        	'phase'=>$dtPhase[0],
        	'today'=>$today, 
        	'status'=>$status, 
        	'cnt'=>$cnt,      	
        	'agent'=>$agent[0],
        	'rowID'=>$data[0]->rowID,
        	'payment'=>$payment
        	,'payment_type_remarks'=>$paymentremarks,
        	'product'=>$dtProduct);

			$this->load_content_top_menu('booking/v_rl_nupNew',$content);	
		}
        
	}
	public function zoom_city(){
        $ent = $this->input->post('ent',TRUE);
        // var_dump($ent);
        // $table = 'DISTINCT city cf_province_dtl';
        // $table = "SELECT DISTINCT city, province_cd from mgr.cf_province_dtl (NOLOCK) order by province_cd";
        $table = "SELECT distinct city, province_cd = mgr.cf_province.descs, mgr.cf_province.rowid from mgr.cf_province_dtl, mgr.cf_province where  mgr.cf_province_dtl.province_cd = mgr.cf_province.province_cd order by mgr.cf_province.rowid";
        $cons = $this->session->userdata('Tscons');
        $entityName = $this->m_wsbangun->getData_cons($cons,$table);

        // var_dump($entityName);
            if(!empty($entityName)) {
                $comboEntity[] = '<option></option>';
                foreach ($entityName as $dtEntity) {
                  if($ent === $dtEntity->province_cd) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtEntity->province_cd.'">'.$dtEntity->city.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            echo $comboEntity;
      }

	public function insert($status='') 
	{

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
        $payment = $this->m_wsbangun->getCombo_cons($cons,$table1,$crit1);


        
        $table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $cons = $this->session->userdata('Tscons');
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

        $table = 'agent_details';
        $crit = array('userid'=>$user);
        // var_dump($crit);
        $cons = $this->session->userdata('Tscons');
        $agent = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
 
        $table = 'cf_location (nolock)';
        $crit = array('location_cd', 'descs');
        $cblocation = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $table = 'cf_country (nolock)';
        $crit = array('country_code', 'descs');
        $cbcountry = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $table = 'cf_nationality (nolock)';
        $crit = array('nationality_cd', 'descs');
        $cbnationality = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
        // var_dump($sql);
        $dtPhase = $this->m_wsbangun->getData_by_query_cons($cons,$sql);               
           	
    	$sql = "SELECT counter from mgr.next_number (NOLOCK) where name='nup_sequence_no'";
    	$cons = $this->session->userdata('Tscons');
    	$dtSeq = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
    	$seqno = (int) $dtSeq[0]->counter;
		$upseq = intval($seqno) + 1;
    	$sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='nup_sequence_no'";
    	$this->m_wsbangun->setData_by_query_cons($cons,$sql);
		
    	$cnt = $this->cek_nup_attach($entity,$project,$seqno,$user);

        $content = array('comboTnup'=>$nuptype,
        	// 'comboCs'=>$customer,
        	'comboLocation'=>$cblocation,
        	'comboCountry'=>$cbcountry,
        	// 'comboCity'=>$comboCity,
        	'cbnationality'=> $cbnationality,
        	// 'comboPhase'=>$cbphase,
        	// 'comboTrxType'=>$cbtrxtype,
        	'user'=>$user,
        	'seqno'=>$seqno,
        	'project'=>$projectName,
        	'phase'=>$dtPhase[0],
        	'today'=>$today, 
        	'status'=>$status,       	
        	'cnt'=>$cnt,
        	// 'agent_name'=>$agent_name,
        	'agent'=>$agent[0],
        	'rowID'=>0,
        	'payment'=>$payment,
        	'form'=>'insert',
        	'product'=>$dtProduct
        	);
        $this->load_content_top_menu('booking/v_rl_nupNew',$content);
	}

	 public function data_unit_landed($property_cd,$property_type,$unit=null){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $name = $this->session->userdata('Tsuname');
            $business_id = $this->session->userdata('business_id');
            if(empty($business_id)){
                $business_id ='null';
            }
            if(empty($unit)){
                        $unit = $this->session->userdata('unit_book');
                    }

            if(empty($unit)){
                $unit = null;
            }

            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
            $cons = $this->session->userdata('Tscons');
            $sql = "SELECT MAX(descs) AS default_value,MAX(map_picture) as map_picture FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '".$entity."' and project_no = '".$project."' and property_cd='".$property_cd."' ";
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $a='';
            $map_picture ='';
            if(!empty($defaulValue)){
                $a =  $defaulValue[0]->default_value;
                $map_picture = $defaulValue[0]->map_picture; 
            }
            

            $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            
            $cons = $this->session->userdata('Tscons');
            $sql = "SELECT project_no, property_cd, line_no, descs ,map_picture, rowID, coord, coord_status = ISNULL(coord_status,0) from mgr.cf_property_dtl where property_cd = '".$property_cd."' and coord is not null";
            $query = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            // var_dump($property_cd);
            $areadata[]='';
            $keyarea='';
            if(!empty($query)){
                foreach ($query as $value) {
                    $areadata[] = '<area alt="" title="" onclick="openPage(\''.$value->rowID.'\',\''.$property_cd.'\',\''.$unit.'\')" href="#" shape="circle"  unit="'.$value->rowID.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    
                    if($value->coord_status ==1){
                        $keyarea.='{ key: "'.$value->rowID.'", selected: true}';
                    }

                    // if($value->coord_status ==1){
                    //     $keyarea.='{ key: "'.$value->lot_no.'", selected: true, toolTip: "'.$value->lot_no.'" },';
                                                                                                                                                                                                                                                                     
                    // } else {
                    //      $keyarea.='{ key: "'.$value->lot_no.'", toolTip: "'.$value->lot_no.'" },';
                    // }


                    # code...
                }
                $keyarea.='';
                $areadata = implode("", $areadata);
            }
            $tess='img/FloorPlan/'.$map_picture;
            // $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);

            $data = array(
                                    'dataarea' => $areadata,
                                    'keyarea' => $keyarea,
                                    // 'userLevelList'=>$this->datatable($property_cd,$unit),
                                    'map_picture'=>$tess,
                                    'property_descs'=>$a,
                                    'property_type'=>$property_type,
                                    'property_cd'=>$property_cd,                                
                                    'projectName'=>$projectName,
                                    'backButton'=> $butt,
                                    'business_id'=>$business_id,
                                    'unit_book'=>$unit);
            return $data;
            // $this->load_content_top_menu('bookingfloor/Index', $ContentAllData);
            
    }

    public function data_unit($property_cd,$property_type){
    	$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $name = $this->session->userdata('Tsuname');
            $unit = $this->session->userdata('unit_book');
            if(empty($unit)){
                $unit = null;
            }
            $business_id = $this->session->userdata('business_id');
            if(empty($business_id)){
                $business_id ='null';
            }
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project);
        	$sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and property_cd='$property_cd' ";
            $cons = $this->session->userdata('Tscons');
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;

            $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            
            

			// $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);

            $ContentAllData = array('userLevelList'=>$this->datatable($property_cd,$unit),
            						'property_descs'=>$a,
                                    'property_type'=>$property_type,
                                    'property_cd'=>$property_cd,           						
                                    'projectName'=>$projectName,
                                    'backButton'=> $butt,
                                    'business_id'=>$business_id,
                                    'unit_book'=>$unit);
            return $ContentAllData;
            // $this->load_content_top_menu('bookingfloor/Index', $ContentAllData);
    }

	function insert2($property_type=null,$property_cd=null,$unit=null){
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

        $table = 'v_reservation_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $cons = $this->session->userdata('Tscons');
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
        $data=array('product'=>$dtProduct,
                    'project'=>$project,
                    'projectName'=>$projectName);
        if(!empty($property_type) && !empty($property_cd)){
            if($property_type=='A'){
                $data = $this->data_unit($property_cd,$property_type);
                $this->load_content_top_menu('bookingnew/SB2UnitFloor',$data);
            }else if($property_type=='L'){
                $data = $this->data_unit_landed($property_cd,$property_type,$unit);
                $this->load_content_top_menu('bookingnew/SB2UnitLanded',$data);
            }
            
        }else{
            $this->load_content_top_menu('bookingnew/SB1',$data);  
        }
	}

	public function property_image(){
         $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $tabel2 = 'cf_property';
        $cons = $this->session->userdata('Tscons');
        $kriteria2 = array(
            'entity_cd'=>$entity,
            'project_no'=>$project
            );

        $datalist2 = $this->m_wsbangun->getData_by_criteria_cons($cons,$tabel2, $kriteria2);
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $sql = "select descs from mgr.cf_property (NOLOCK)";
                $cons = $this->session->userdata('Tscons');
                $dtproduct = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

                $ListAllData .='<div class="col-md-3">';
                $ListAllData .='<div class="ibox">';
                $ListAllData .='<div class="ibox-content product-box">';
                $ListAllData .='<div class="product-imitation">';
                if(!empty($value->picture_url)){                    
                    $a = '<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\');"><center><img src="'.$value->picture_url.'" class="img-thumbnail"></center></a>';

                }else{
                    $a = '<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\');" style="a:focus"><center><img src="'.base_url('img/PlProject/blankproject.png').'" class="img-thumbnail"></center></a>';
                }
                $ListAllData .=$a;
                $ListAllData .='</div>';
                $ListAllData .='<div class="product-desc">'; 
                $ListAllData .='<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\');" class="product-name">' .$value->descs. '&nbsp; <i class="fa fa-arrow-circle-right"></i><br><div style="font-size:12.5px;">'.$dtproduct[0]->descs.'</div></a>';                                      
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';               
            }
        }
        $data = array('property_type'=> $ListAllData);
            $this->load->view('bookingnew/property_type',$data);
        }

    public function indextipe($property_cd=null)
    {
            

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');


           

            $cons = $this->session->userdata('Tscons');

            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $approver = 1;

            $pcd = $property_cd;
                      

            // $sql = "SELECT project_no, property_cd, line_no, descs ,map_picture, rowID, coord, coord_status = ISNULL(coord_status,0) from mgr.cf_property_dtl (NOLOCK) where property_cd = '$pcd' and coord is not null and coord_status='1'";
            $sql = "SELECT project_no, property_cd, descs , rowID, coord, level_no, coord_status = ISNULL(coord_status,0) from mgr.pm_level (NOLOCK) where property_cd = '$pcd' and entity_cd = '$entity' and project_no = '$project' and coord is not null and coord_status='1'";
            $query = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

           
            // $map_picture = $this->input->post('map_picture',TRUE);
            // var_dump($map_picture);
            
            $areadata[]='';
            $keyarea='';

            if(!empty($query)){
                foreach ($query as $value) {
                    $areadata[] = '<area alt="" title="" onclick="openPage(\''.$entity.'\',\''.$project.'\',\''.$pcd.'\',\''.$value->level_no.'\')" href="#" shape="poly" unit="'.$value->rowID.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    
                    if($value->coord_status ==1){
                        $keyarea.='{ key: "'.$value->rowID.'"},';
                    }

                   
                }
                
            }
            $keyarea.='';
            $areadata = implode("", $areadata);
             
            
            $backurl = base_url("booking/insert2");     
            
            $tess='';

            $where = array('property_cd'=>$pcd,
                            'entity_cd'=>$entity,
                            'project_no'=>$project);
            $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property (NOLOCK)', $where);
            	if (!empty($data[0]->map_picture)) {
            		$map_picture = $data[0]->map_picture;
            }
            else{
            	$map_picture = 'No_image.png';
            }
            // var_dump($map_picture);
            $tess='img/FloorPlan/'.$map_picture;

            $Content = array('dataarea' => $areadata,
                            'keyarea' => $keyarea,
                            'project_name'=>$projectName,
                             'backurl'=>$backurl,
                             'map_picture'=>$tess,
                             'pcd'=>$property_cd,
                             'property_type'=>$data[0]->descs
                             // 'property_type'=>$this->property_type($property_cd,$property_type)
                             );

            $this->load_content_top_menu('bookingnew/v_nup_landed', $Content);


        }

     public function indexland($entity = null, $project = null,$pcd=null,$level=null)    
        {
            
            // $rowidd=$rowid;

           
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');

            $cons = $this->session->userdata('Tscons');
           
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $approver = 1;

            $pcd = $pcd;
            
           
            // $sql = "SELECT  status =mgr.pm_lot_web.STATUS,project_no = mgr.pm_lot_web.project_no  ,property_cd = mgr.pm_lot_web.property_cd";
            // $sql .= ",level_no = mgr.pm_lot_web.level_no ,lot_no = mgr.pm_lot_web.lot_no ";
            // $sql .= ",theme = mgr.pm_theme.descs,descs = mgr.pm_lot_web.descs   ,type   ,build_up_area  ,land_area ";
            // $sql .= ",coord  ,coord_status = ISNULL(coord_status, 0) ,nup_counter ";
            // $sql .= ",type_descs = (select descs from mgr.cf_lot_type (NOLOCK) where lot_type= type) ";
            // $sql .= ",price_HC = CONVERT(varchar, CAST(mgr.pm_lot_price.trx_amt AS money), 1) ";
            // $sql .= ",nup_counter = isnull(mgr.pm_lot_web.nup_counter,0) ";
            // $sql .= "    FROM mgr.pm_lot_web(NOLOCK) left outer join mgr.pm_lot_price (NOLOCK) ";
            // $sql .= "    On mgr.pm_lot_web.entity_cd = mgr.pm_lot_price.entity_cd ";
            // $sql .= "    and  mgr.pm_lot_web.project_no = mgr.pm_lot_price.project_no ";
            // $sql .= "    and  mgr.pm_lot_web.lot_no = mgr.pm_lot_price.lot_no ";
            // $sql .= "    and  mgr.pm_lot_price.Hc ='Y' ";
            // $sql .= "    LEFT OUTER JOIN mgr.pm_theme(NOLOCK)";
            // $sql .= "    ON mgr.pm_lot_web.theme_cd = mgr.pm_theme.theme_cd";
            // $sql .= "    WHERE coord IS NOT NULL ";
            // $sql .= "    AND mgr.pm_lot_web.property_dtl_rowid = '$rowid' ";
            // $sql .= "    AND mgr.pm_lot_web.entity_cd = '$entity' ";
            // $sql .= "    AND mgr.pm_lot_web.project_no = '$project' ";//" AND mgr.pm_lot_web.STATUS='A'";
            $sql = "Select * from mgr.pm_lot where entity_cd='$entity' and project_no='$project' and property_cd='$pcd' and level_no='$level'";
            $query = $this->m_wsbangun->getData_by_query_cons($cons,$sql);            
            
            
            // $map_picture = $this->input->post('map_picture',TRUE);
            $areadata[]='';
            $keyarea='';
           
            if(!empty($query)){
                foreach ($query as $value) {                    
                    // $nupCounterx = $value->nup_counter >3?3:$value->nup_counter;
                    $statusx = $value->status;
                  
                        // $areadata[] = '<area data-key="'.$nupCounterx.'" data-status='.$statusx.' class="sold" alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                        // $areadata[] = '<area data-status='.$statusx.' class="sold" alt="" title="" onclick="landinfo(\''.$entity.'\',\''.$project.'\',\''.$pcd.'\',\''.$value->level_no.'\')" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                        $areadata[] = '<area data-status='.$statusx.' class="sold" alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" type="'.$value->type.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                        $areadata[] = '<area data-status='.$statusx.' class="sold" alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" type="'.$value->type.'"  full="Unit '.$value->descs.'" coords="'.$value->coord.'">';

                        // $areadata[] = 'test';
                  
                    // $ck_in_arr = in_array($value->lot_no, $unit_arr);                    
                   if($statusx=='A'){
                   	$keyarea.='{ key: "'.$value->lot_no.'", toolTip: "<b></b>'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type.' <br>Semi Gross Area : '.$value->build_up_area.'"},';                        
                   }
                   else{
                   	$keyarea.='{ key: "'.$value->lot_no.'", toolTip: "<b></b>'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type.' <br>Semi Gross Area : '.$value->build_up_area.'"},';                        
                   }
                        // if($ck_in_arr){
                        // $keyarea.='{ key: "'.$value->lot_no.'", selected: true, toolTip: "<h2><b>Already Selected : '.$value->nup_counter.' times</b></h2>'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type_descs.' <br>Semi Gross Area : '.$value->build_up_area.' <br>Harga Hardcash : '.$value->price_HC.'"},';
                        // }else{
                            
                    
                    
                }
                              
            }           
            $keyarea.='';
            $areadata = implode("", $areadata);  
            $tess='';
            
            $where = array(
                            'entity_cd'=>$entity,
                            'project_no'=>$project,
                            // 'rowID' => $rowid
                            );
            $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'pm_level (NOLOCK)', $where);

            if (!empty($data)) {
                $map_picture = $data[0]->picture_url;         
            }
            $tess=$map_picture;

            $Content = array('dataarea' => $areadata,
                            'keyarea' => $keyarea,
                            'project_name'=>$projectName,
                            'ptype'=>$project,
                            'map_picture'=>$tess,
                            'pcd'=>$pcd,
                             // 'RowID'=> $rowid,
                             
                             // 'rowidd'=>$rowidd,
                             
                             );

            
            $this->load_content_top_menu('bookingnew/v_nup_land', $Content);
        }



        public function getPayDetail($lot_no='',$type='',$payment_cd='') {
        	
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');

        $cons = $this->session->userdata('Tscons');
       
        $name = $this->session->userdata('Tsuname');
        $sys = $this->session->userdata('Tsysadmin');

		$descs = $this->input->post('descs', TRUE);
		$trx = $this->input->post('trx', TRUE);
		// var_dump($descs);exit();


        // $callback = array(
        //     'Data' => null,
        //     'Error' => false,
        //     'Pesan' => '',
        //     'Status' => 200
        // );

        $sql = "SELECT * FROM mgr.v_pm_lot_info where lot_no = '$lot_no'";
        $Data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql2 = "SELECT gallery_url, gallery_title FROM mgr.v_cf_lot_type_gallery WHERE entity_cd = '$entity' AND project_no = '$project' AND lot_type = '$type'";
        $galery = $this->M_wsbangun->getData_by_query_cons($cons,$sql2);


        $sql3 = "SELECT descs = b.descs + case when a.freq > 1 then ' ' + convert(varchar,a.freq) + 'X' else '' end ";
        $sql3 .= ", SUBSTRING(FORMAT(a.trx_amt, 'C', 'id-id'),3,LEN(FORMAT(a.trx_amt, 'C', 'id-id'))) AS trx_amt ";
        $sql3 .= "FROM mgr.pm_lot_price_dtl a (NOLOCK) inner join mgr.cf_trx_type b (NOLOCK) ";
        $sql3 .= "ON a.entity_cd = b.entity_cd AND a.trx_type = b.trx_type AND b.module = 'AR' ";
        $sql3 .= "WHERE a.entity_cd = '$entity' AND a.project_no = '$project'";
        $sql3 .= " AND a.lot_no = '$lot_no' AND a.payment_cd = '$payment_cd' ";

        $Data1 = $this->M_wsbangun->getData_by_query_cons($cons,$sql3);   

        // var_dump($Data1);exit(); 
       
        // if (!empty($DataMenu)) {
        //     $callback['Data'] = $DataMenu;
        // }
        // else {
        //     $callback['Error'] = true;
        //     $callback['Pesan'] = "Can't Load Data";
        //     // $callback['Pesan'] = 'c_menuentry->getData() : Error';
        // }

        // var_dump($Data1);exit();

        $content = array(
            'data'=>$Data,
            'projectName'=>$projectName,
            'galery'=>$galery,
            'data1'=>$Data1,
            'descs'=>$descs,
            'trx'=>$trx,
            ); 
            $this->load->view('bookingnew/infoaptnew',$content);
    }


    public function getPrice($lot_no='',$type=''){
    	$entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');

            $cons = $this->session->userdata('Tscons');
           
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');

            $nupno = $this->session->userdata('NupNo');

        $sql = "SELECT * FROM mgr.v_pm_lot_info where lot_no = '$lot_no'";
        $payment = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql2 = "SELECT gallery_url, gallery_title FROM mgr.v_cf_lot_type_gallery WHERE entity_cd = '$entity' AND project_no = '$project' AND lot_type = '$type'";
        $galery = $this->M_wsbangun->getData_by_query_cons($cons,$sql2);
        // $callback = array(
        //     'Data' => null,
        //     'Error' => false,
        //     'Pesan' => '',
        //     'Status' => 200
        // );
 
        $sql3 = "SELECT payment_cd,descs, SUBSTRING(FORMAT(trx_amt, 'C', 'id-id'),3,LEN(FORMAT(trx_amt, 'C', 'id-id'))) AS trx_amt , trx_amt as trx_amt2";
        $sql3 .= " FROM mgr.v_payment_plan ";
        $sql3 .= " WHERE entity_cd = '$entity'";
        $sql3 .=  " AND project_no = '$project'";
        $sql3 .= " AND lot_no = '$lot_no'";
        $sql3 .= " AND GETDATE() BETWEEN start_date AND end_date";

        $DataMenu = $this->M_wsbangun->getData_by_query_cons($cons,$sql3);   

        // var_dump($DataMenu);exit();
       
        // if (!empty($DataMenu)) {
        //     $callback['Data'] = $DataMenu;
        // }
        // else {
        //     $callback['Error'] = true;
        //     $callback['Pesan'] = "Can't Load Data";
        //     // $callback['Pesan'] = 'c_menuentry->getData() : Error';
        // }
        // echo json_encode($callback);
        $Content = array(
                            'project'=>$projectName,
                            'ptype'=>$project,
                            'agent'=>$name,
                            'data'=>$payment,
							'galery'=>$galery,
							'Data'=>$DataMenu
                             // 'RowID'=> $rowid,
                             
                             // 'rowidd'=>$rowidd,
                             
                             );
        	$this->load_content_top_menu('bookingnew/paymentplan',$Content);
    }

        public function showland($lotno = null,$lot_type=null)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
        $nupno = $this->session->userdata('NupNo');

        $sql = "SELECT * FROM mgr.v_pm_lot_info where lot_no = '$lotno'";
        $payment = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql2 = "SELECT gallery_url, gallery_title FROM mgr.v_cf_lot_type_gallery WHERE entity_cd = '$entity' AND project_no = '$project' AND lot_type = '$lot_type'";
        $galery = $this->M_wsbangun->getData_by_query_cons($cons,$sql2);

        
        $content = array(
            'data'=>$payment,
            'projectName'=>$projectName,
            'galery'=>$galery
            ); 
            $this->load->view('bookingnew/infoaptnew',$content);//apart

        }

    public function AddpayAndCust($rowID=0){

    	$callback = array(
            'Data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status' => 200
        ); 

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
		$lot_no = $this->input->post('unit_book', TRUE);

		$descs = $this->input->post('descs', TRUE);
		$trx = $this->input->post('trx', TRUE);
		$unit = $this->input->post('unit', TRUE);
		// var_dump($_POST);exit();
        
        if($rowID==null){
            $rowiID=0;
        }



        $table = 'v_cf_nationality (nolock)';
        $crit = array('nationality_cd', 'descs');
        $cbnationality = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $sql = "SELECT nup_type, descs, prefix, nup_amt, expired_minute FROM mgr.v_rl_nup_types WHERE entity_cd='$entity' AND project_no='$project' AND refund_type='N'";
        $nuptype = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        if(!empty($nuptype)) {
                $comboProject[] = '<option></option>';
                foreach ($nuptype as $key) {
                  if($project === $key->nup_type) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$key->descs."-".$key->nup_type."-".$key->prefix."-".$key->nup_amt.'">'.$key->prefix." - ".$key->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }

        if($rowID==0){
            $sql = "SELECT counter from mgr.next_number (NOLOCK) where name='sales_seq_no'";
            $dtSeq = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $seqno = (int) $dtSeq[0]->counter;
            $upseq = intval($seqno) + 1;
            $sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='sales_seq_no'";
            $this->m_wsbangun->setData_by_query_cons($cons,$sql);
        }else{
            $Squery ="select sales_seq_no from mgr.rl_sales where rowid = $rowID";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
            $seqno = $this->m_wsbangun->getData_by_query_cons($cons,$Squery);
            $seqno =  $seqno[0]->sales_seq_no;
            $sql = "SELECT count(sales_seq_no) as counter FROM mgr.rl_sales_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND sales_seq_no=$seqno ";
            $sql.= "AND (status_attach IS NULL OR status_attach='0')";
            $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
        }

        $content = array('project'=>$projectName,
                         // 'comboCountry'=>$cbcountry,
                         'cbnationality'=> $cbnationality,
                          'agent'=>$user,
                          // 'unit'=>$unit,
                          'nuptype'=>$comboProject,
                          'descs'=>$descs,
                          'trx'=>$trx,
                          // 'product_descs'=>$product_descs,
                          // 'payment_method'=>$this->zoom_payment_cd($unit,$entity),
                          // 'special_discount'=>$this->zoom_discount(),
                          // 'booking_fee_amt'=>$booking_fee_amt,
                          'seqno'=>$seqno,
                        
                          'lot_no'=>$unit,
                          // 'product_cd'=>$product_cd,
                          'rowIdsales'=>$rowID
                          // ,'comboMedia'=>$media
            );
        // var_dump('expression');exit();
        // $callback['Data'] = '.booking/AddpayAndCust';
        $this->load_content_top_menu('bookingnew/v_rl_BookingNew',$content);
        // $this->load->view('bookingnew/v_rl_BookingNew',$content);
    }

    public function addNew()//($dt=null, $row=null)
    {
       
        $this->load->view('bookingnew/v_booking_upload');
    }


            // $this->load->view('booking_steps/infolandednew',$content);//landed

	function cek_nup_attach($entity='',$project='',$seqno='',$user=''){	

		$dday = date('d M Y H:i:s');
		/* cek data attachment di db2
		klo ga ada => insert data attachment dari document master di DB1
		klo ada biar aja
		kembalikan nilai count dari data attachment yg statusnya NULL atau 0
		*/
		$sql = "SELECT count(1) AS cnt FROM mgr.rl_nup_attachment WHERE nup_sequence_no=$seqno";
		$cons = $this->session->userdata('Tscons');
		$dtA = $this->m_wsbangun->getData_by_query2($sql);
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
        $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
        $cnt = $dtCnt[0]->counter;

        return $cnt;

		// var_dump($entity);
		// var_dump($project);
		// var_dump($seqno);
		// var_dump($user);
		// var_dump($dday);
		
		// , '".$seqno."', '".$user."', '".$dday."'

		// $sql = "SELECT entity_cd, project_no, document_no, descs, STATUS FROM mgr.rl_document_mst WHERE entity_cd='$entity' AND project_no='$project'";
  //       $exc = $this->m_wsbangun->getData_by_query($sql);
  //       $a = array('data' => $exc);

  //       var_dump($a);exit;

  //       if(!empty($exc)){
  //       	foreach ($exc as $value) {
  //       		$a = array('entity_cd' => $value->entity_cd, 
  //       					'project_no' => $value->project_no,
  //       					'document_no' => $value->document_no,
  //       					'descs' => $value->descs,
  //       					'STATUS' => $value->STATUS,
  //       					'seqno' => $seqno,
  //       					'user' => $user,
  //       					'dday' => $dday);
  //       		// var_dump($a);exit;
  //       	}
  //       }

		// $sql = "IF NOT EXISTS(SELECT nup_sequence_no FROM mgr.rl_nup_attachment WHERE nup_sequence_no=$seqno) ";
  //   	$sql.= "INSERT into mgr.rl_nup_attachment(entity_cd, project_no, document_no, document_descs, document_status, nup_sequence_no, audit_user, audit_date) ";
  //       $sql.= "SELECT entity_cd, project_no, document_no, descs, STATUS, $seqno, '$user', '$dday' FROM mgr.rl_document_mst WHERE entity_cd='$entity' AND project_no='$project'";
  //       $exc = $this->m_wsbangun->setData_by_query($sql);
  //       $sql = "SELECT count(nup_sequence_no) as counter FROM mgr.rl_nup_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
  //       $sql.= "AND (status_attach IS NULL OR status_attach='0')";
  //       $dtCnt = $this->m_wsbangun->getData_by_query($sql);
  //       $cnt = $dtCnt[0]->counter;

  //       return $cnt;

	}

	public function save_cf_business($ID='',$name='',$hp='',$email='',$user='',$country_cd='',$address='',$noktp='',$city='',$npwp='',$salutation='', $nationality=''){
		$cons = $this->session->userdata('Tscons');
		$table = 'cf_business';      
		$class =  $this->m_business->zomm_class(); 
        $class_cd = $class[0]->class_cd;
        $msg = '';
		if($ID==0)
		{
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
                			"audit_date"=>date("d M Y h:i:s"),
                			'country_code'=>$country_cd,
                			'address1'=>$address,
                			'city'=>$city,
                			'ic_no'=>$noktp,
                			'income_tax'=>$npwp,
                			'salutation'=>$salutation,
                			'nationality'=>$nationality
  				);
	        $msg = $this->m_wsbangun->insertData_cons($cons,$table,$data);
	        $data=array(
                        "COUNTER"=>$Number + 1 
                        );
	       	$where=array("name" => "business_id");
	       	$this->m_business->update($data, $where); 
		}
		else
			{
				// var_dump($ID);
				// exit;
				$Number = $ID;
				$data = array(
	                			'business_id'=>$Number,
	                			'class_cd'=>$class_cd,
	  							'category'=>'I',
	  							'name'=>$name,  							
	  							'hand_phone'=>$hp,
	  							'email_addr'=>$email,
	                			"audit_user"=>$user,
	                			"audit_date"=>date("d M Y h:i:s"),
	                			'country_code'=>$country_cd,
	                			'address1'=>$address,
                			'city'=>$city,
                			'ic_no'=>$noktp,
                			'income_tax'=>$npwp,
                			'salutation'=>$salutation,
                			'nationality'=>$nationality
	                			//'payment_type_remarks'=>$paymentremarks
	  				);
				$where =array('business_id'=>$Number);
				$msg = $this->m_wsbangun->updateData_cons($cons,$table,$data, $where);
             

			}
		

        
        // var_dump($editdata);
            	
  		$data_=array('business_id'=>$Number,
  					'pesan'=>$msg);
        
        return $data_;
  			
  			
	}
	public function insert_his($rowID=''){
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');

        $sql ="INSERT INTO mgr.rl_reserve_nup_his ";
        $sql.=" select * from mgr.rl_reserve_nup WHERE rowID= ".$rowID;
        // $result = $this->m_wsbangun->getData_by_query($sql);
        $DB2 = $this->load->database($cons, TRUE);
        $query = $DB2->query($sql);

	}

	public function saveCfBusiness($cons, $data) {
        $sql = "SELECT COUNTER from mgr.v_Next_Number where Name = 'business_id'";
        $number = $this->M_wsbangun->getData_by_query_cons($cons,$sql);
        $number = (int)$number[0]->COUNTER;
        $data['business_id'] = $number;
        // $data['category'] = '';
        // $data['class_cd'] = '';

        $msg = $this->M_wsbangun->insertData_cons($cons,"cf_business",$data);
        if($msg == "OK"){
            $xx = $this->M_wsbangun->updateData_cons($cons,"Next_Number",["COUNTER" => $number+1],["Name" => "business_id"]);
        // var_dump($xx);exit;
        }

        $callback = array(
            'msg' => $msg,
            'id' => $number
        );

        return $callback;
    }

	public function savenup()
	{
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');


		$tday = date('d M Y');
		$today = date('d M Y H:i:s');

		$customer = $this->input->post('customer', TRUE);
		$HP = $this->input->post('HP', TRUE);
		$Email = $this->input->post('Email', TRUE);
		$nationality = $this->input->post('nationality', TRUE);
		$noktp = $this->input->post('noktp', TRUE);
		$address = $this->input->post('address', TRUE);
		$reserv = $this->input->post('reserv', TRUE);
		$remark = $this->input->post('remark', TRUE);
		$ktp = $this->input->post('ktp', TRUE);
		$npwp = $this->input->post('npwp', TRUE);
		$bukti = $this->input->post('bukti', TRUE);
		$lot_no = $this->input->post('unit', TRUE);

        	$audit_date = date("d M Y H:i:s");
            $dataCfBusiness = array(
                'nationality' => $nationality,
                'class_cd' => '1-01',
                'category' => 'I',
                'name' => $customer,
                'ic_no' => $noktp,
                'remark' => $remark,
                'address1' => $address,
                'email_addr' => $Email,
                'hand_phone' => $HP,
                'audit_user' => $user,
                'audit_date' => date("d M Y H:i:s"),
                'statement_type' => "I",
                'tax_trx_cd' => "01",
                "credit_terms"=> "00",
                "tel_no" => "-",
                "sex" =>"M",
                "marital_status"=> "N",
                "mail_type" =>"O",
                // 'country_code'=>' ',
                // 'city'=>' ',
                'income_tax'=>' ',
                'salutation'=>' ',
            );

            $cf_business = $this->saveCfBusiness($cons, $dataCfBusiness);
            if($cf_business['msg'] != "OK"){
                // $business_id = $cf_business['id'];
                $callback['Error'] = true;
                $callback['Pesan'] = "Reserve Error";

                echo json_encode($callback);
                return;
            }
            else {
            	$reserv1 = explode("-",$reserv);
                $business_id = $cf_business['id'];
                $dataReserve = array(
                    'entity_cd' => $entity,
                    'project_no' => $project,
                    'nup_no' => '',
                    'business_id' => ''.$business_id,
                    'reserve_by' => $user,
                    'reserve_date' => $audit_date,
                    'nup_type' => $reserv1[1],
                    'descs' => $reserv1[0],
                    'prefix' => $reserv1[2],
                    'group_cd' => "",
                    'agent_cd' => "",
                    'agent_type_cd' => "",
                    'nup_amt' => $reserv1[3],
                    'alloc_amt' => 0,
                    'refund_amt' => 0,
                    'bal_amt' => 0,
                    'STATUS' => 'S',
                    'status_sales' => 'N',
                    'lot_no' => $lot_no,
                    'audit_date' => $audit_date,
                    'audit_user' => $user,
                    'expired_time' => $audit_date,
                    'link_ktp' => base_url('img/Booking/'.$ktp),
                    'link_npwp' => base_url('img/Booking/'.$npwp),
                    'link_bukti_transfer' => base_url('img/Booking/'.$bukti),
                    'nup_sequence_no' => NULL,
                    // 'product_cd'=>"",
                    'phase_cd'=>'',
                    // 'payment_type_remarks'=>' ',
                    'type'=>'',
                    // 'payment_cd' => $pay->payment_cd,
                    // 'sell_price' => $pay->amt
                );

                $msg2 = $this->M_wsbangun->insertData_cons($cons,"rl_reserve_nup",$dataReserve);
                // var_dump($msg2);exit;
                if($msg2 != 'OK'){
                    $callback['Error'] = true;
                    $callback['Pesan'] = "Reserve Error";
                }

                			// $msg = "Data has been save successfully";
	  //       $status='ok';
	  //   // }else{
	  //   // 	$msg = "Could't Delete rl_reserve_nup rowID ".$id;
	  //   // 	$status='fail';
	  //   // }
   //      $msg1=array("Pesan"=>$msg);
   //      echo json_encode($msg1);
                else {
                    $whereLot = array(
                        'entity_cd' => $entity,
                        'project_no' => $project,
                        // 'property_cd' => $lot->property,
                        // 'level_no' => $lot->level,
                        'lot_no' => $lot_no,
                    );
                    $xx2 = $this->M_wsbangun->updateData_cons($cons,"pm_lot",["status" => 'R'],$whereLot);
                    $callback['Pesan'] = "Reserve Success";
                }
            }
        // }

        echo json_encode($callback);
    }




	public function Delete(){
        $id = $this->input->post("id",true);
        $seqno = $this->input->post("seqno",true);
        $business_id = $this->input->post("business_id",true);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
       	$cons = $this->session->userdata('Tscons');
        // $sql ="SELECT business_id,nup_sequence_no FROM mgr.rl_reserve_nup WHERE rowID=".$id;
        // $data = $this->m_wsbangun->getData_by_query($sql);        
        // if(!empty($data)){
        	// $business_id = $data[0]->business_id;
        	// $seqno 		 = $data[0]->nup_sequence_no;
        
	        $where=array('business_id'=>$business_id);
	        $data = $this->m_wsbangun->deletedata_cons($cons,'cf_business',$where);

	        $where=array('nup_sequence_no'=>$seqno,
	        			'entity_cd'=>$entity,
	        			'project_no'=>$project);
	        $data = $this->m_wsbangun->deletedata2('rl_nup_attachment',$where);

	        $where=array('business_id'=>$business_id,
	        			'entity_cd'=>$entity,
	        			'project_no'=>$project);

	        $data = $this->m_wsbangun->deletedata_cons($cons,'rl_reserve_nup',$where);


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
    	if($_POST){
    		

    		$id = $this->input->post("id",true) - 1000000;
    		// var_dump($id);exit;
	    	$status = $this->input->post("status",true);
	    	$entity = $this->session->userdata('Tsentity');
	        $project = $this->session->userdata('Tsproject');
	    	// if($status=='N'){
	    	$Newstatus='S';
	    	$OldStatus=$status;
	    	// }else if($status=='R'){
	    		// $Newstatus='S';
	    		// $OldStatus='R';
	    	// }

	    	$data =array('STATUS'=>$Newstatus, 'old_status'=>$OldStatus);

	    	$where=array('entity_cd'=>$entity,
	    				'project_no'=>$project,
	    				'rowID'=>$id);
	    	$this->m_wsbangun->updateData('rl_reserve_nup', $data, $where);

	    	$Temail = 'rl_nup_email';
	    	$kritTemail = array('entity_cd' => $entity, 
	    						'project_no'=>$project);
	    	$cons = $this->session->userdata('Tscons');
	    	$Qemail = $this->m_wsbangun->getData_by_criteria_cons($cons,$Temail, $kritTemail);
	    	$Email = $Qemail[0]->email;
	    	$Judul = $Qemail[0]->subject_email;
	    	$noHp = $Qemail[0]->hp_no;

	    	$rowID = $this->input->post("id",true);
	    	
	    	$TisiEmail = 'v_nup_update';
	    	$kritIsiEmail = array('entity_cd' => $entity, 
	    							'project_no' => $project,
	    							'rowID' => $rowID);
	    	$cons = $this->session->userdata('Tscons');
	    	$QisiEmail = $this->m_wsbangun->getData_by_criteria_cons($cons,$TisiEmail, $kritIsiEmail);

	    	$data = array('nup_sequence_no' => $QisiEmail[0]->nup_sequence_no,
	    					'NAME' => $QisiEmail[0]->NAME,
	    					'descs' => $QisiEmail[0]->descs,
	    					'nup_amt' => $QisiEmail[0]->nup_amt,
	    					'group_name' => $QisiEmail[0]->group_name,
	    					'agent_name' => $QisiEmail[0]->agent_name,
	    					'old_status_desc' => $QisiEmail[0]->old_status_desc,
	    					'reason_descs'=>$QisiEmail[0]->reason_descs,
	    					'product_descs'=>$QisiEmail[0]->product_descs);	    	    	

	    	$body = $this->load->view('Email/EmailSubmitNup', $data, true);
	    	// var_dump($Email);
	    	// if(filter_var($Email, FILTER_VALIDATE_EMAIL)){
	    		$sql ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
	    		$cons = $this->session->userdata('Tscons');
                $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);                    
                $profile_mail = $data[0]->email_profile;
	    		$sql = "mgr.x_send_mail_php '".$profile_mail."', '".$Email."', '".$Judul."', '".$body."', '' ";
	    		// var_dump($sql);
				// $this->_sendmail($Email, $Judul, $body);
                // $msg = 'Invitation successfully send';
                $snd = $this->m_wsbangun->setData_by_query($sql);
                // var_dump($snd);
                // var_dump(strpos($snd,'fauziah'));
                $aaa = strpos($snd,'queued');
                // var_dump($aaa);exit;
                if( $aaa <= 0 || !$aaa){
                	if($snd=='OK'){
                		$msg = 'Email sent';
                    	$psn ='OK';
                    	$aa = $msg;
                	}else{
                		$msg = $snd;
                    	$psn ='Fail';
                    	$aa = 'Sent Email Failed, Please Contact your Admin!';	
                	}
                    
                }else{
                    $msg = 'Email sent';
                    $psn ='OK';
                    $aa = $msg;
                }
    //         }else{
				// $msgEmail = 'Email not valid';
    //         }

            //sms Start

    //         if (!empty($QisiEmail)){   
				// $mesText = array(
    //             "DestinationNumber"=>$noHp,
    //             // "TextDecoded"=>'Please review and approve new booking unit '.$Slotno.' Cs Name '.$dtName.'',
    //             "TextDecoded" =>'Please approve NUP Sequence No. ['.$QisiEmail[0]->nup_sequence_no.'], Name : '.$QisiEmail[0]->NAME.', NUP Type : '.$QisiEmail[0]->descs.', Amount : '.$QisiEmail[0]->nup_amt.'',
    //             "creatorID"=>'MGR'
    //         );
            
    //         $this->m_sms->SendSms($mesText);
    //         	$msgSend='ok';
    //         }else{
    //         	$msgSend= "Could'n read security_users, failed Send SMS";
    //         }

            //sms End

	    		// var_dump($QisiEmail);exit;

	    	// $msg="Data has been Submit";
	    	// $msg1=array("Pesan"=>$msg);
	    	$t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
	        echo json_encode($t);
    	}    	
    }
	// public function addNew()//($dt=null, $row=null)
 //    {
 //        // if(!empty($dt)&&!empty($row))
 //        // {	
 //        	// var_dump($dt);
 //            // $content = array('dt'=>$dt, 'row'=>$row);
 //            // $this->load->view('booking/v_nup_upload',$content);
 //        // } else {
 //        //     show_404();
 //        //     return;
 //        // }
 //        $this->load->view('booking/v_nup_upload');
 //    }
    public function downloadFile($seqno='',$document_no=''){
    	// var_dump($seqno);
    	// var_dump($document_no);
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // $seqno = $this->input->post('seqno',true);
        // $document_no = $this->input->post('document_no',true);
        // $where =array('entity_cd'=>$entity,
        // 			  'project_no'=>$project,
        // 			  'nup_sequence_no'=>$seqno,
        // 			  'document_no'=>$document_no);
        // $data = $this->m_wsbangun->getData_by_criteria('rl_nup_attachment',$where);
        $sql="select file_attachment,file_attached from mgr.rl_nup_attachment ";
        $sql.=" where entity_cd='".$entity."' and project_no='".$project."' and nup_sequence_no=".$seqno." and document_no=".$document_no;
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query2_cons($cons,$sql);
        // var_dump($data);
        $filename = $data[0]->file_attachment;
        $filedata = $data[0]->file_attached;
        $a = strrpos($filename, '.')+1;  
        $c = strlen($filename);
        $ext = substr($filename, $a,$c-$a);
        // $file = base64_decode($filedata);
        $file = $filedata;

          switch ($ext) 
		    {
		      case "pdf": $filetype="application/pdf"; break;
		      case "exe": $filetype="application/octet-stream"; break;
		      case "zip": $filetype="application/zip"; break;
		      case "doc": $filetype="application/msword"; break;
		      case "xls": $filetype="application/vnd.ms-excel"; break;
		      case "ppt": $filetype="application/vnd.ms-powerpoint"; break;
		      case "gif": $filetype="image/gif"; break;
		      case "png": $filetype="image/png"; break;
		      case "jpeg":
		      case "jpg": $filetype="image/jpg"; break;
		      default: $filetype="application/force-download";
		    }
		// var_dump($file);
		// var_dump(strlen($file));
		header("Pragma: public"); 
	    header("Expires: 0");
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Cache-Control: private",false); 
	    header("Content-Type: $ctype");
        header("Cache-Control: no-cache private");
		header("Content-Description: File Transfer");
		header("Content-Type: ".$filetype);
		header('Content-disposition: attachment; filename='.$filename);
		header("Content-Transfer-Encoding: binary");
		header('Content-Length: '. strlen($file));
		ob_clean();
		flush();
        echo $file;
        exit;
    }

	function compress($File, $destination, $quality) {
			$source = $File['userfile']['tmp_name'];
			$uploadimage = $File['userfile']['name'];
			$info = getimagesize($source);
			// $tmpName = $_FILES['userfile']['tmp_name'];
			

			list( $width,$height ) = getimagesize( $source );
			// It makes the new image width of 350
			if($width > 1000){
				$width = ($width*0.5);
				$height = ($height*0.5);
			}elseif($width > 2000){
				$width = ($width*0.2);
				$height = ($height*0.2);
			}elseif($width < 1000){
				$width = ($width*0.7);
				$height = ($height*0.7);
			}
			$newwidth = $width;


			// It makes the new image height of 350
			$newheight = $height;

			$thumb = imagecreatetruecolor( $newwidth, $newheight );

			if ($info['mime'] == 'image/jpeg')
				{$image = imagecreatefromjpeg($source);}
			elseif ($info['mime'] == 'image/gif') 
				{$image = imagecreatefromgif($source);}
			elseif ($info['mime'] == 'image/png') 
				{$image = imagecreatefrompng($source);}
			elseif ($info['mime'] == 'image/jpg') 
				{$image = imagecreatefrompng($source);}
			elseif ($info['mime'] == 'image/jpe') 
				{$image = imagecreatefrompng($source);}
			// Resize the $thumb image.
			imagecopyresized($thumb, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);


			imagejpeg($thumb, $destination, $quality);			

			return $destination;
		}

	public function saveUpload()
    {
    	// var_dump($_POST);
        if($_POST)
        {
            
            $webuser = $this->session->userdata('Tsuname');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $today = date('d M Y H:i:s');
            // $row = $this->input->post('row',true);
            // $seqno = $this->input->post('sn',true);
			$cons = $this->session->userdata('Tscons');
            $files = $_FILES;
            // var_dump($files);exit;
            $cnt ='';
            // $picname = str_replace(' ', '_', $files['userfile']['name']);
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());

                 // var_dump($_POST);
                // var_dump($row);exit();
            $picture = !empty($_FILES) ? $picture = $_FILES["userfile"] : '';
            if(!empty($picture["name"]))
            {
                $picname = str_replace(' ', '_', $picture["name"]);
                $picture = $_FILES["userfile"];
                $psn='';
                
                // var_dump($picname);
                $picture = array_filter($picture);

                $target_dir = "./img/Booking/";
                $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                    if($check !== false) {
                        $msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $msg = "File is not an image.";
                        $uploadOk = 0;
                    }
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // var_dump($msg);
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg = "Sorry, your file was not uploaded.";
                    $psn = "Failed";
                // if everything is ok, try to upload file
                } else {
                    // var_dump('expression');
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "Sorry, there was an error uploading your file.";
                        $psn = "Failed";
                    } else {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                        // var_dump('fail wkwk');
                    }

                }
                
                
                
       
            } else {
              
               // $msg = "Sorry, there was an error uploading your file.";
               // $psn = "Failed";
            	$msg = "The file  has been uploaded.";
                        $psn = "OK";
            }

                
            // }
            $res = array('pesan'=>$msg, 
                        'status'=>$psn
                        );
            echo json_encode($res);

        
        }
    }

	public function getTableAttach()
	{
		$entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $seqno = $this->input->post('seqno', true);
        $DB2 = $this->load->database('ifca2', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number', 'document_no', 'document_descs', 'file_attachment');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.rl_nup_attachment';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        // if($iDisplayLength<0){
        // 	$iDisplayLength=5;
        // }
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
        $field=" document_no,document_descs,file_attachment,rowID,nup_sequence_no ";
        $cons = $this->session->userdata('Tscons');
   		$rResult = $this->m_wsbangun->getlisttableattach($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$field);
      // var_dump($rResult);
      // return;
        // Total data set length
        
        // $sql="select count(*) as cnt from ".$sTable." ".$param;
        // $ts = $DB2->query($sql);
        // $a = $ts->result()[0]->cnt;

        // $iTotal = $a;//$DB2->count_all($sTable);
    
        // Output
        $output = array(
            'draw' => intval($draw),
            // 'recordsTotal' => $iTotal,
            // 'recordsFiltered' => $iTotal,
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
	public function getTable($product_cd='')
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
        $aColumns  = array('row_number','rowID', 'nup_no', 'reserve_date','STATUS');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_reservation_update';
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";

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
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);
        // $SordField = ('STATUS desc,reserve_date ASC');

     
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

        // var_dump($name);
        // var_dump($entity);
        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        // $param =" Where (status = 'A' or status = 'V') AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $param =" Where (status = 'A' or status = 'V') AND refund_type='N' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
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

    public function getTableHd()
    {
    	$sSearch = $this->input->post("sSearchHd",true);
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
        $aColumns  = array('row_number','rowID', 'nup_no', 'reserve_date','STATUS');
        // $aColumns = array('entity_cd', 'entity_name');
        // $sTable = "select * from mgr.v_nup_update where (status not in ('A','V', 'S') or (status = 'S' and old_status in ('R','N')))'";
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";
        $sTable = "mgr.v_reservation_update";

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
        $param =" Where status not in ('A','V','C','E') AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        // $param =" Where project_no= '".$project."' ".$filter_search;
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

//     public function getTableDt()
//     {
//     	$sSearch = $this->input->post("sSearch",true);
//         if(empty($sSearch)){
//             $sSearch='';
//         }
//        $entity = $this->session->userdata('Tsentity');
// 		// var_dump($entity);
//         $project = $this->session->userdata('Tsproject');
//         $name = $this->session->userdata('Tsuname');
        
//         $DB2 = $this->load->database('ifca', TRUE);

//         //untuk PK diharap diletakan di awal array
//         $aField = array('id', 'subject', 'content','status');
//         $aColumns  = array('row_number','rowID', 'nup_no', 'reserve_date','STATUS','nup_type');
//         // $aColumns = array('entity_cd', 'entity_name');
//         $sTable = "select * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";
//         // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";

//         $iDisplayStart = (int)$this->input->get_post('start', true);
//         $iDisplayLength = (int)$this->input->get_post('length', true);
        
//         $order = $this->input->get_post('order', true);

//         $draw = (int)$this->input->get_post('draw', true);
//         $Column = $this->input->get_post('columns', true);
//         // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
//         // $iSortingCols = $this->input->get_post('iSortingCols', true);
//         // $sSearch = $this->input->get_post('search', true);
//         // $Search = $sSearch['value'];
//         $Search = $sSearch;
//         // $Search_regex = $sSearch['regex'];
//         $SortdOrder = $order[0]['dir'];
//         $sortIdColumn = (int)$order[0]['column'];
//         // var_dump($Column[$sordIdColumn]['name']);
//         $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);

     
// // var_dump($Search);
//         // filter
//         $filter_search='';
//         if(isset($Search) && !empty($Search)){            
//             for($i=0;$i<count($Column); $i++){
//                 if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
//                     $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
//                 }
                
//             }
//             $a = strrpos($filter_search, 'OR');        
//             $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

//         }
//         // Select Data

//         // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
//         // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
//         // $rResult = $DB2->get($sTable);
//         // $rResult = $DB2->query($sql_data);
//         $param =" Where userid='".$name."' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
//         $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
//         // Total data set length
        
//         $sql="select count(*) as cnt from ".$sTable." ".$param;
//         $ts = $DB2->query($sql);
//         $a = $ts->result()[0]->cnt;

//         $iTotal = $a;//$DB2->count_all($sTable);
    
//         // Output
//         $output = array(
//             'draw' => intval($draw),
//             'recordsTotal' => $iTotal,
//             'recordsFiltered' => $iTotal,
//             'data' => array()
//         );
        
//         foreach($rResult->result_array() as $aRow)
//         {
//             $row = array();
            
//             foreach($aColumns as $col)
//             {
//                 $row[] = $aRow[$col];
                
//             }
    
//             $output['data'][] = $aRow;
//         }

   
//         echo json_encode($output);

//     }

	public function getImage()
	{
		$rowid = $this->input->post('rid', true);
		// var_dump($rowid);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // var_dump($rowid);
        // $table = 'rl_nup_attachment(nolock)';
        // $crit = array('rowID'=>$rowid);
        // $dtAtch = $this->m_wsbangun->getData_by_criteria($table, $crit);
        $sql="select document_descs,file_attachment from mgr.rl_nup_attachment where rowID=".$rowid;
        $cons = $this->session->userdata('Tscons');
        $dtAtch = $this->m_wsbangun->getData_by_query2_cons($cons,$sql);
        // var_dump($dtAtch);
        // var_dump($dtAtch);
        echo json_encode($dtAtch);
	}


	public function getImages($n, $s)
	{
		$DB2 = $this->load->database('ifca2',TRUE);
		$sql = "SELECT CONVERT(varbinary(MAX),'file_attached') AS image FROM mgr.rl_nup_attachment WHERE nup_no = '$n' AND sec_no=$s";
		$a = $DB2->query($sql);
		// var_dump($a);
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
	 	$cons = $this->session->userdata('Tscons');
		$datalist2 = $this->m_wsbangun->getData_by_criteria_cons($cons,$tabel2, $kriteria2);

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
					$cons = $this->session->userdata('Tscons');
					$allName = $this->m_wsbangun->getData_by_criteria_cons($cons,$tabel3, $kriteria3);

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