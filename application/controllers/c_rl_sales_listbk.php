<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_rl_sales_list extends Core_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->auth_check();
		$this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
		$this->load->model('m_sms');
	}

	function tes($tnup)
	{
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
			$pref = $dtNup[0]->prefix;
			$today = date('d M Y');
			$sql = "mgr.x_gen_docnumber '$entity', '$pref', '$user', '$today'";
			$this->m_wsbangun->getData_by_query($sql);
			$table = 'x_tformat';
			$result = $this->m_wsbangun->getData($table);
			// array_push($dtNup, $sql[0]->output);
			$output = array('nup_no'=>$result[0]->output,
				'descs'=>$dtNup[0]->descs,
				'nup_amt'=>$dtNup[0]->nup_amt);

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
					$pesan = '';
                    $pesan.= 'Dear Finance,'."\n\n";
                    $pesan.= 'Please approve NUP No. '.$dtNup[0]->nup_no.', descs: '.$dtNup[0]->descs."\n";
                    $pesan.= 'Name: '.$dtA[0]->NAME.', From Agent: '.$dtA[0]->group_name.' and Sales: '.$dtA[0]->agent_name."\n";
                    $pesan.= 'Total Amount : '.number_format($dtA[0]->nup_amt)."\n\n\n";
                    $pesan.= 'Thank you,';
                    $judul = 'Approval';
                    $this->_sendmail($kepada, $judul, $pesan);
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
        // var_dump($project);
        $today = date('d/m/Y');
        // var_dump($today);

        $table1 = 'pl_project';
        $crit1 = array('project_no' => $project);

        $descProject = $this->m_wsbangun->getData_by_criteria($table1, $crit1);
        $ProjectDescs = $descProject[0]->descs;

        $sql = "SELECT count(*) as counter from mgr.rl_nup_parameter where entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date";
        $Dataparam = $this->m_wsbangun->getData_by_query($sql);
        $c =intval($Dataparam[0]->counter);
        // var_dump($Dataparam);

        if($c > 0){
        	$x = '<a href="'.base_url("c_rl_sales_list_nup").'" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create New</a>';
        }else{
        	$x = '<a href="'.base_url("c_rl_sales_list_nup").'" class="btn btn-primary disabled"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create New</a>';
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
				$table = 'rl_nup_type';
				$crit = array('nup_type'=>$value->nup_type);
				$dtNup = $this->m_wsbangun->getData_by_criteria($table, $crit);
				// var_dump($dtNup);
				if(!empty($dtNup)) {
					$ListAllData .= '<td >'.$dtNup[0]->descs.'</td>';
				} else {
					$ListAllData .= '<td >'.$value->nup_type.'</td>';
				}
				// $ListAllData .= (empty($dtNup) ? '<td >'.$dtNup[0]->descs.'</td>' : '<td >'.$value->nup_type.'</td>');
				// $ListAllData .='<td >'.$value->nup_type.'</td>';
				
				if($value->STATUS <> "U"){
					$a = '<a href = "'.base_url('c_rl_sales_list/submit/'.$value->nup_no).'" class="btn btn-primary disabled">Submit</a>&nbsp;&nbsp;';
				}else{
					$a = '<a href = "'.base_url('c_rl_sales_list/submit/'.$value->nup_no).'" class="btn btn-primary">Submit</a>&nbsp;&nbsp;';
				}

				if($value->STATUS <> "P"){
					$b = '<a href = "'.base_url('c_pm_bill_sch/index/'.$value->nup_no).'" class="btn btn-success disabled"  target="_blank"><i></i> Preview </a>&nbsp;&nbsp;';
					$c = '<a href = "'.base_url('c_reports/sp/'.$value->nup_no.'/'.$value->nup_no).'" class="btn btn-warning disabled">Send</a>&nbsp;&nbsp;';
				}else{
					$b = '<a href = "'.base_url('c_reports/nup/'.$value->nup_no).'" class="btn btn-success"  target="_blank"><i></i> Preview </a>&nbsp;&nbsp;';
					$c = '<a href = "'.base_url('c_pm_bill_sch/index/'.$value->nup_no.'/'.$value->nup_no).'" class="btn btn-warning">Send</a>&nbsp;&nbsp;';
				}

				$d = '<a href = "'.base_url('c_nup_dt/index/'.$value->nup_no).'" class="btn btn-danger">Unit</a>';
				$ListAllData .='<td align="center" style = "width:200px">'.$a.$b.$c.$d.'</td>';
				$ListAllData .='</tr>';
				$i++;
			}
			
			$ContentAllData = array('RlSalesList' => $ListAllData,
				'kondisi'=>$x,
				'ProjectDescs'=>$ProjectDescs);
			
		}else{
			$list_curr = '';
			$paging2 = '';
			$ProjectDescs = '';
			$ContentAllData = array(
				'RlSalesList' => $list_curr,
				'paging' => $paging2,
				'kodisi'=>null,
				'ProjectDescs'=>$ProjectDescs);
			// $this->load->view('v_currency', $ContentAllData2);	
		}
		
		$this->load_content_top_menu('booking/v_rl_sales_list_nup',$ContentAllData);
	}
	

	public function nup() 
	{
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $today = date('d M Y');
        $table = 'rl_nup_type';
        $crit = array('nup_type', 'descs');
        $nuptype = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'cf_business';
        $crit = array('business_id', 'name');
        $customer = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'rl_phase';
        $crit = array('phase_cd', 'descs');
        $cbphase = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'cf_trx_type';
        $crit = array('trx_type', 'descs');
        $cbtrxtype = $this->m_wsbangun->getCombo($table,$crit);
        $table = 'agent_details';
        $crit = array('userid'=>$user);
        $agent = $this->m_wsbangun->getData_by_criteria($table,$crit);
        // var_dump($agent);
        $table = 'cb_activity_type';
        $crit = array('activity_type', 'descs');
        $cbtype = $this->m_wsbangun->getCombo($table,$crit);
        $content = array('comboTnup'=>$nuptype,
        	'comboCs'=>$customer,
        	'comboType'=>$cbtype,
        	'comboPhase'=>$cbphase,
        	'comboTrxType'=>$cbtrxtype,
        	'user'=>$user,
        	'today'=>$today,
        	'agent'=>$agent[0]);
        $this->load_content('booking/v_rl_nup',$content);
	}

	public function savenup()
	{
		if(isset($_POST['submit']))
		{
			$today = date('d M Y H:i:s');
			$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$user = $this->session->userdata('Tsuname');
        	$rsvdate = $this->input->post('rsvdate', TRUE);
        	$rsvby = $this->input->post('rsvby', TRUE);
        	$customer = $this->input->post('customer', TRUE);
        	$nupno = $this->input->post('nupno', TRUE);
        	$nuptype = $this->input->post('nuptype', TRUE);
        	$nupdesc = $this->input->post('nupdesc', TRUE);
        	$nupamt = $this->input->post('nupamt', TRUE);
        	$commamt = $this->input->post('commamt', TRUE);
        	$type = $this->input->post('type', TRUE);
        	$phase = $this->input->post('phase', TRUE); 
        	$bankcd = $this->input->post('bankcd', TRUE);
        	$today = date('d M Y H:i:s');
        	$prefix = substr($nupno, 0, 2);
        	$table = 'agent_details';
	        $crit = array('userid'=>$user);
	        $agent = $this->m_wsbangun->getData_by_criteria($table,$crit);
	        $parsednupamt = floatval(preg_replace('/[^\d.]/', '', $nupamt));
	        $commamt = empty($commamt) ? 0 : floatval(preg_replace('/[^\d.]/', '', $commamt));
        	$data = array('entity_cd'=>$entity,
        		'project_no'=>$project,
        		'reserve_by'=>$user,
        		'reserve_date'=>$today,
        		'nup_type'=>$nuptype,
        		'descs'=>$nupdesc,
        		'prefix'=>$prefix,
        		'audit_user'=>$user,
        		'audit_date'=>$today,
        		'group_cd'=>$agent[0]->group_cd,
        		'agent_cd'=>$agent[0]->agent_cd,
        		'agent_type_cd'=>$agent[0]->agent_type_cd,
        		'nup_amt'=>$parsednupamt,
        		'business_id'=>$customer,
        		'nup_no'=>$nupno,
        		'status'=>'U',
        		'comm_amt'=>$commamt,
        		'type'=>$type,
        		'trx_type'=>$bankcd,
        		'phase_cd'=>$phase);
        	$table = 'rl_reserve_nup';
        	var_dump($data);
        	$this->m_wsbangun->insertData($table, $data);

        	// config
        	$validform = array('jpg','png','gif','bmp');
        	$max_filesize = 1024 * 1000;
        	$path = 'uploads/';
        	$count = 0;
        	foreach ($_FILES['picture']['name'] as $f => $name) {
        		if($_FILES['picture']['error'][$f] == 4) {
        			var_dump("error");
        			continue;
        		}
        		if($_FILES['picture']['error'][$f] == 0) 
        		{
        			if($_FILES['picture']['size'][$f] > $max_filesize) {
        				$message[] = "$name is too large!";
        				// var_dump("error2");
        				// return;
        				continue;
        			} else if (!in_array(pathinfo($name, PATHINFO_EXTENSION), $validform)) {
        				$message[] = "$name is not a valid format";
        				// var_dump("error3");
        				// return;
        				continue;
        			} else {
        				$this->load->library('image_lib');
        				// var_dump($_FILES['picture']);
        				// prepare the image for insertion
        				$tmpName = $_FILES['picture']['tmp_name'][$f];
						$imgString = file_get_contents($tmpName);
						// $aa = iconv('', 'utf-8//TRANSLIT', $imgString);
						$imgData = bin2hex($imgString);
						$bin = (binary) $imgData;
						
						// $tmpName = iconv('', 'BIG-5', $tmpName);
						// $fp = fopen($tmpName, 'rb');
						// $imgStr = fread($fp, filesize($tmpName));
						// // $content = iconv('', 'UTF-8//TRANSLIT', $imgStr);
						// fclose($fp);

						$s = $f + 1;
						$nupno = 'SLxxx';
						$DB2 = $this->load->database('ifca',TRUE);
						$sql = "INSERT INTO mgr.rl_nup_attachment(entity_cd, project_no, nup_no, audit_user, audit_date, file_attachment, file_attached, sec_no) ";
						$sql.= "VALUES('$entity','$project','$nupno','$user','$today','$name',CONVERT(varbinary(MAX),'$imgData'),$s)";
						$aa = $DB2->query($sql);
						// var_dump($aa);
						if($aa)
						{
							echo $this->getImages($nupno, $s);
							echo 'sukses';
						} else {
							echo 'error!';
						}

        				// $table = 'rl_nup_attachment';
        				// $data = array('entity_cd'=>$entity,
        				// 	'project_no'=>$project,
        				// 	'nup_no'=>"SLxxx",
        				// 	'audit_user'=>$user,
        				// 	'audit_date'=>$today,
        				// 	'file_attachment'=>$name,
        				// 	'sec_no'=>$f);
        				// 	// 'file_attached'=>$imgData);	//CONVERT(varbinary(MAX),$imgData)
        				// $this->m_wsbangun->insertData($table, $data);
        				$count++;
        			}
        		}
        	}
        	redirect('c_rl_sales_list/nup_list');

        	// var_dump($_FILES);
		}
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

	}

	public function index()
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

	public function hasilcari()
	{
		$perpage = 10;			
		$total = 0;
		$offset = $this->uri->segment(3);

		if($offset===false){
			$offset = 0;
		}

		$perpage = $perpage + $offset;

		$dtotal = $this->m_rl_sales_list->getdata_row();
		//var_dump($dtotal);

		foreach ($dtotal as $value) {
			$total++;
		}

		$config['base_url'] = base_url("index.php/c_rl_sales_list/hasilcari");
		$config['total_rows'] = $total;
		$config['per_page'] = 10; 

		$this->pagination->initialize($config); 

		$paging = $this->pagination->create_links();

		$AllData = $this->m_rl_sales_list->DataPaging($offset, $perpage);

		if($_POST){
			$paging = null;
			$cari = $this->input->post('search',TRUE);
			$data = $this->m_rl_sales_list->cari($cari);
			$ListAllData = '';
			$i = 1;
			if(!empty($data)){
				foreach ($data as $value) {
					$ListAllData .='<tr>';
					$ListAllData .='<th>'.$i.'</th>';
					$ListAllData .='<th>'.$value->business_id.'</th>';
					$ListAllData .='<th>'.$value->NAME.'</th>';
					$ListAllData .='<th>'.$value->lot_no.'</th>';
					$ListAllData .='<th>'.$value->descs.'</th>';
					$ListAllData .='<th>'.$value->sales_date.'</th>';
					$ListAllData .='<th class="text-right">'.number_format($value->sell_price,2).'</th>';
					$ListAllData .='<th><a href = "'.base_url('index.php/c_pm_bill_sch/index/'.$value->lot_no).'"><input type = "button" name="billing" value="Billing"></a></th>';
					$ListAllData .='</tr>';
					$i++;
				}
				// date_format($date,"Y/m/d H:i:s");
				$content = array(
					'RlSalesList' => $ListAllData,
					'paging' => $paging);
				
				// $this->load->view('v_currency',$content);

				$this->load->view('template/v_header');
				$this->load->view('template/v_menu');
				$this->load->view('v_rl_sales_list', $content);
				$this->load->view('template/v_footer');
			}else{
				$this->index();
			}
			
		}

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */