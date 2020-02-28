<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_nup_dtNew extends Core_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->auth_check();
		$this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
		$this->load->model('m_sms');
	}
	
	public function chosen_country(){
		$id = $this->input->post('Id', TRUE);
		$id = trim($id);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$table = 'cf_country (nolock)';
        $obj = array('country_code', 'descs');
      
        $data = $this->m_wsbangun->getCombo($table,$obj,null,$id);
        echo $data;
	}
	public function zoom_nuptype(){
        $product = $this->input->post('prod',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
		$sql = "select * from mgr.rl_nup_type where product_cd='$product' ";
        $rst = $this->m_wsbangun->getData_by_query($sql);
        //var_dump($rst);
		$combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                
                $combo[] = '<option value="'.trim($result->nup_type).'" >'.$result->descs.'</option>';
            }
            echo implode("", $combo);
      }

	public function parse($nup_no){
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$tblHd = 'v_rl_reserve_nup_hd';
        $critHd = array('entity_cd'=>$entity,
        			'project_no'=>$project,
        			'nup_no'=>$nup_no);

        $dataHd = $this->m_wsbangun->getData_by_criteria($tblHd,$critHd);

  		// $NupNO = $dataHd[0]->nup_no;
		// $NupDescs = $dataHd[0]->nup_descs;
		// $BussName = $dataHd[0]->name;
		// $LotQty = $dataHd[0]->nup_lot_qty;
		// $RowId = $dataHd[0]->rowID;

		return $dataHd;
	}
	function cek_nup_attach($entity='',$project='',$seqno='',$user=''){
		
		// var_dump($seqno);
		$cons = $this->session->userdata('Tscons');
		$dday = date('d M Y H:i:s');
		/* cek data attachment di db2
		klo ga ada => insert data attachment dari document master di DB1
		klo ada biar aja
		kembalikan nilai count dari data attachment yg statusnya NULL atau 0
		*/

		// $sql = "SELECT count(1) AS cnt FROM mgr.rl_nup_attachment (NOLOCK) WHERE entity_cd='$entity' AND project_no='$project'AND nup_sequence_no='$seqno' AND document_descs in (SELECT descs FROM mgr.rl_document_mst (NOLOCK) WHERE entity_cd='$entity' AND project_no='$project' and phase_cd='02')";
		$sql = "SELECT DESCS FROM mgr.rl_document_mst (NOLOCK) WHERE entity_cd='$entity' AND project_no='$project' and phase_cd='02'";
		$dtA = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
		// var_dump($dtA);
		$a="";
		$cnt_mst = count($dtA);
		// var_dump($cnt_mst); exit();

		foreach ($dtA as $value) {
			$a .= $a." '".$value->DESCS."'," ;
		}
		$b = strrpos($a, ",");  
		$a =substr($a, 0,$b);
		// var_dump($a);

		$sql2= "SELECT count(phase_cd) as Phase_cd_cnt,document_no,document_descs FROM mgr.rl_nup_attachment (NOLOCK) WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no='$seqno' GROUP by document_no,document_descs";//AND document_descs in ($a)";
		$dtAA = $this->m_wsbangun->getData_by_query2($sql2);
		// var_dump($sql2);
		// var_dump($dtAA);exit();
		if(empty($dtAA)){
		$doc_no = 0;	
		}else{
			$doc_no = count($dtAA);	
		}
		
		
		$arr_desc=array();
		$arr_cnt=array();
		foreach ($dtAA  as $key ) {
			// var_dump($key->document_descs);
			$arr_desc []= $key->document_descs;
			$arr_cnt []= $key->Phase_cd_cnt;
		}
		$cnt = array_sum($arr_cnt);
		// var_dump($cnt);
		// var_dump($arr_desc);
		// var_dump($cnt_mst);//exit();
		
		
			
		if($cnt == 0 || $cnt_mst !=$cnt)
		{
			
			$sql = "SELECT entity_cd, project_no, document_no, descs, STATUS FROM mgr.rl_document_mst (NOLOCK) WHERE entity_cd='$entity' AND project_no='$project' and phase_cd='02' ";
			$dtB = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
			// var_dump($sql);
			// var_dump('xxx--');
			// var_dump($dtB);exit;

			
		// 			$sql = "SELECT counter from mgr.next_number (NOLOCK) where name='nup_sequence_no'";
  
			if(!empty($dtB))
			{
				foreach ($dtB as $value) {
					$ck_in_arr = in_array($value->descs, $arr_desc);
					// var_dump($ck_in_arr);
					// var_dump($value->descs);
					// var_dump($arr_desc);

					if(!$ck_in_arr){
						// var_dump('otnay '.$value->descs);
					// exit();
							$table = 'rl_nup_attachment';
							$data = array('entity_cd' => $value->entity_cd, 
        					'project_no' => $value->project_no,
        					'nup_sequence_no' => $seqno,
        					'document_no' => (int)$doc_no+1,
        					'document_descs' => $value->descs,
        					'document_status' => $value->STATUS,        					
        					'audit_user' => $user,
        					'audit_date' => $dday,
        					'phase_cd'=>'02');
					// var_dump($data);
					// $d=$this->m_wsbangun->insertData2($table, $data);
					// if ($d!='OK') {
					// 	swal("error: $d");
						// var_dump($value->descs);
						// var_dump($seqno);
					// }
 					$psn ='';
					$d=$this->m_wsbangun->insertData2($table, $data);
					// var_dump($d);
					// var_dump('ssssan');
		        		if($d == 'OK')
                        {
                            $a="Data has been saved successfully";
                            $psn = "OK";
                        } else {
                            $a= $d;
                            $psn = "Failed";
                        }
					}
					
                        	// var_dump($psn);exit;
                     $doc_no += 1;

				}
			}
		}

		$sql = "SELECT count(nup_sequence_no) as counter FROM mgr.rl_nup_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
        $sql.= "AND (status_attach IS NULL OR status_attach='0')";
        $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
        $cnt = $dtCnt[0]->counter;
        // var_dump('xxx==');
			// var_dump($dtB);exit;

			// exit();
        // var_dump($dtCnt[0]->counter);
        // exit();
        // var_dump('expression');exit;
        return $cnt;

		

	}

	public function list_dtNew($nup_no = null, $ops  = null, $rowID='',$status='')
	{
		
		$rowid_index=$rowID;
		$status_index=$status;
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        
     //    $nupno = $this->uri->segment(3);
    	// $balance = $this->uri->segment(4);
    	// $rowid_index = $this->uri->segment(5);
    	// $status = $this->uri->segment(6);
    	// var_dump($nupno.' - '.$balance.' - '.$rowid_index.' - '.$status);

        $today = date('d M Y');
        $dday = date('d M Y H:i:s');
 		// $sql = "SELECT counter from mgr.next_number where name='nup_sequence_no'";
   //      $dtSeq = $this->m_wsbangun->getData_by_query($sql);
   //      $seqno = (int) $dtSeq[0]->counter;
        
        // $sql = "SELECT descs FROM mgr.pl_project where project_no = '$project' and entity_cd='$entity'";
        // $descProject = $this->m_wsbangun->getData_by_query($sql);
        // $ProjectDescs = $descProject[0]->descs;
        // $dataaa = $this->parse($nup_no);
        // $cnt=$this->cek_nup_attach($entity, $project, $seqno, $user);
        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT reserve_by,nup_sequence_no,location_cd,rowID,payment_type_remarks,type FROM mgr.v_nup_update (NOLOCK) ";
        $sql.= " WHERE entity_cd ='".$entity."' and project_no='".$project."' and rowID='".$rowID."'";
        $datanup = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $today = date('d M Y');
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_country (nolock)';
        $crit = array('country_code', 'descs');
        $cbcountry = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $table = 'v_list_city (nolock)';
        $obj = array('city', 'coba');
        $order = array('rowid', 'ASC');
        $comboCity = '';//$this->m_wsbangun->getCombo($table,$obj,null,null,$order);

        $table = 'cf_location (nolock)';
        $crit = array('location_cd', 'descs');
        $cblocation = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $dtProduct='';
		
		$table = 'v_reserve_product';
       	$crit = array('entity_cd'=>$entity,
        	 'project_no'=>$project);
        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

        $sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
        $dtPhase = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $tblHd = 'v_rl_reserve_nup_hd';
        $critHd = array('entity_cd'=>$entity,
        			'project_no'=>$project,
        			'nup_no'=>$nup_no);

        $dataHd = $this->m_wsbangun->getData_by_criteria_cons($cons,$tblHd,$critHd);

        $NupNO = $dataHd[0]->nup_no;
		$NupDescs = $dataHd[0]->nup_descs;
		$BussName = $dataHd[0]->name;
		$NupTypeDescs = $dataHd[0]->nup_type_descs;
		$PropertyDescs = $dataHd[0]->property_descs;
		$ProductDescs = $dataHd[0]->product_descs;
		$nupsequenceno = $dataHd[0]->nup_sequence_no;
		$LotQty = $dataHd[0]->nup_lot_qty;
		$RowId = $dataHd[0]->rowID;
		$today = date('d/m/Y');
		$TotQty = $dataHd[0]->total_dtl;
		$tipe = $dataHd[0]->property_type;
		$balance = $LotQty - $TotQty;
		$busID=$dataHd[0]->business_id;
		// $national=$dataHd[0]->nationality;
		if($TotQty==0){
			$sql ="Update mgr.rl_reserve_nup set Choose_unit_status ='N' where entity_cd='$entity' and project_no='$project' and nup_no='$NupNO' ";
            $updatenupHd = $this->m_wsbangun->setData_by_query_cons($cons,$sql);
		}
		// var_dump($nupsequenceno);
		// var_dump($balance);
		// var_dump($rowid_index);
		// var_dump($status);

		$table = 'cf_business';
		$where = array('business_id' => $busID);
		$databus = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
		$person='';
		if(! empty($databus)){
			$person = $databus[0];
		}

		// $table = 'cf_business';
		// $where = array('nationality' => $national);
		// $nationali = $this->m_wsbangun->getData_by_criteria($table,$where);
		// $person='';
		// if(! empty($nationali)){
		// 	$person = $nationali[0];
		// }


		// $sql = "SELECT counter from mgr.next_number (NOLOCK) where name='nup_sequence_no'";
  //   	$dtSeq = $this->m_wsbangun->getData_by_query($sql);
  //   	$seqno = (int) $dtSeq[0]->counter;
		// $upseq = intval($seqno) + 1;
  //   	$sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='nup_sequence_no'";
  //   	$this->m_wsbangun->setData_by_query($sql);
		
    	$cnt = $this->cek_nup_attach($entity,$project,$nupsequenceno,$datanup[0]->reserve_by);
    	// var_dump($entity);
    	// var_dump($project);
    	// var_dump($nupsequenceno);
    	// var_dump($datanup[0]->reserve_by);
    	
    	$seqno = $datanup[0]->nup_sequence_no;

		$sql2 = "SELECT count(*) as cnt FROM mgr.rl_nup_parameter (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date and status = 1 and choose_unit_status = 1";
		$a = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
		$b =intval($a[0]->cnt);
		// var_dump($b);


		$sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 and property_type = 'L'";
         $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
         $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
		// if ($b == 0){
		// 	$butt = '<a href="'.base_url("c_nup_unit/index/$RowId/$LotQty/$NupNO").'" class="btn bg-orange btn-sm disabled"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a>';			
		// }else{
		// 	$butt = '<a href="'.base_url("c_nup_unit/index/$RowId/$LotQty/$NupNO").'" class="btn bg-orange btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a>';
		// }
		// var_dump($balance);exit;
  //       $tabel2 = 'v_rl_reserve_nup_dt';
	 // 	$crit2 = array(
	 // 		'entity_cd'=>$entity,
	 // 		'project_no'=>$project,
	 // 		'nup_no'=>$nup_no);

		// $datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2,$crit2);

		$tabel2 = "SELECT * FROM mgr.v_rl_reserve_nup_dt (NOLOCK) WHERE entity_cd = '$entity' AND project_no = '$project' AND nup_no = '$nup_no' ORDER BY rowID ASC";
        $datalist2 = $this->m_wsbangun->getData_by_query_cons($cons,$tabel2);
		// var_dump($datalist2);

         $new = '';
         $pay = '';
         $add = '';

         $sqlx = "SELECT count(*) as cnt FROM mgr.v_rl_reserve_nup_dt (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and nup_no='$nup_no'";
         // var_dump($sqlx);exit;
         $cntdata = $this->m_wsbangun->getData_by_query_cons($cons,$sqlx);
         $countx = $cntdata[0]->cnt;
         if($countx>0)
         {
         	foreach ($datalist2 as $key) {

         		$new = $new.(string)$key->lot_no.',';
         		$pay = $pay.(string)$key->payment_cd.',';
         		// $add = $add.(string)$key->additional_cd.',';

         	}
         	$abc = strrpos($new, ",");
         	$new = substr($new,0,$abc);

         	$def = strrpos($pay, ",");
         	$pay = substr($pay,0,$def);

			// $ghi = strrpos($add, ",");
   //       	$add = substr($add,0,$ghi);
         	
         } else {
         	$new = 1;
         	$pay = 1;
         	// $add = 1;
         }

         // var_dump($new);
         // exit;
		$this->session->set_userdata('nupno', $NupNO);
		$Url = ' ';
		if($tipe == 'A'){
			// $Url = base_url("c_nup_unit/indexNew/$RowId/$balance/$NupNO");
			$Url = base_url("c_nup_unitNew/index/$RowId/$balance/$NupNO/$new");
			// $Url = base_url("c_nup_unit/index/$RowId/$balance/$NupNO/$rowid_index/$status_index");
		}
		else{
			$Url = base_url("c_nup_landedNew/indextipe/$NupNO/$a/$rowid_index/$status_index/$balance/$RowId/0/$new/$pay"); 
		}
// var_dump($url);
		if ($b == 0){
			$butt = '<a href="'.$Url.'" class="btn btn-w-m btn-warning btn-sm disabled" style="font-size:13px !important;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a>';			
		}else{
			$butt = '<a href="'.$Url.'" class="btn btn-w-m btn-warning btn-sm" style="font-size:13px !important;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a>';
		}

		if (!empty($ops)) {
			$_url = "c_choose_unit_nup/indexNew";
			// $backbtn = '<a href="'.base_url("c_choose_unit_nup/indexNew").'" class="btn bg-orange" onclick="back1st();"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
		} else {
			$_url = "c_nup/index";
			// $backbtn = '<a href="'.base_url("c_nup/index").'" class="btn bg-orange" onclick="back1st();"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
		}


        	

		if(!empty($datalist2)){
			$ListAllData = '';
			$i=1;
			foreach ($datalist2 as $value) {
				$parse = array('Lotno' => (string)$value->lot_no, 
						'nupno' => $value->nup_no);
				$lott=(string)$value->rowID;
				
				if($b == 0){
					$dell = "<td style='width: 200px;'><a onclick='delete_1(".$lott.",\"".(string)$value->lot_no."\")' class='btn btn-danger btn-sm disabled'><i class='fa fa-scissors'></i>&nbsp;&nbsp;Delete</a> <a onclick='landinfo(".$lott.",\"".(string)$value->lot_no."\",\"".(string)$nup_no."\",\"".$balance."\",\"".(string)$rowid_index."\",\"".(string)$status."\")' class='btn btn-primary btn-sm disabled' style='display:none;'><i class='fa fa-pencil'></i>&nbsp;&nbsp;Edit</a></td>";
				}else{
					$dell = "<td style='width: 200px;'><a onclick='delete_1(".$lott.",\"".(string)$value->lot_no."\")' class='btn btn-danger btn-sm'><i class='fa fa-scissors'></i>&nbsp;&nbsp;Delete</a> <a onclick='landinfo(".$lott.",\"".(string)$value->lot_no."\",\"".(string)$nup_no."\",\"".$balance."\",\"".(string)$rowid_index."\",\"".(string)$status."\")' class='btn btn-primary btn-sm' style='display:none;'><i class='fa fa-pencil'></i>&nbsp;&nbsp;Edit</a> </td>";
				}

				$ListAllData .='<tr role="row" class="odd">';
				$ListAllData .= $dell;
				$ListAllData .='<td style="width: 100px;" class="sorting_1">'.$value->lot_no.'</td>';
				$ListAllData .='<td class="sorting_1">'.$value->lot_descs.'</td>';
				$ListAllData .='<td>'.$value->remarks.'</td>';
				// $ListAllData .='<td style="width: 20px;"><a href="'.base_url('c_nup_dt/delete/'.$value->lot_no.'/'.$value->nup_no).'" class="btn btn-danger btn-sm"><i class="fa fa-scissors"></i>&nbsp;&nbsp;Delete</a></td>';
				// $ListAllData .="<td style='width: 20px;'><a onclick='delete_1('".$lott."')' class='btn btn-danger btn-sm'><i class='fa fa-scissors'></i>&nbsp;&nbsp;Delete</a></td>";	
				

				// $ListAllData .="<td style='width: 20px;'><a onclick='delete_1(".$lott.")' class='btn btn-danger btn-sm'><i class='fa fa-scissors'></i>&nbsp;&nbsp;Delete</a></td>";
				
				$ListAllData .='</tr>';
				$i++;
			}
			$table = 'cf_nationality (nolock)';
        		$crit = array('nationality_cd', 'descs');
        		$cbnationality = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);
			$ContentAllData = array(
				'RlSalesList' => $ListAllData,
				'NupNO'=>$NupNO,
				'NupDescs'=>$NupDescs,
				'BussName'=>$BussName,
				'today'=>$today,
				'ProjectDescs'=>$projectName,
        		'user'=>$user,
        		'seqno'=>$seqno,
        		'phase'=>$dtPhase[0],
				'TotQty'=>$TotQty,
				'RowId'=>$RowId,
				'rowID'=>$datanup[0]->rowID,
				'choosUnit'=>$butt,
				'NupTypeDescs'=>$NupTypeDescs,
				'PropertyDescs'=>$PropertyDescs,
				'ProductDescs'=>$ProductDescs,
				'rowid_index'=>$rowid_index,
				'status_index'=>$status_index,
				// 'backbtn'=>$backbtn,
				'_url'=>$_url,
				'new'=>$new,
				'LotQty'=>$LotQty,
				'balance'=>$balance,
				'comboCountry'=>$cbcountry,
				'comboCity'=>$comboCity,
				'comboLocation'=>$cblocation,
        		'product'=>$dtProduct,
        		'person'=>$person,
        		'cbnationality'=> $cbnationality,
        		'cnt'=>$cnt);
			
		}else{
			$list_curr = '';
			$paging2 = '';
			// $NupNO = '';
			// $NupDescs = '';
			// $BussName = '';
			// $ProjectDescs = '';
			// $LotQty = '';

			$ContentAllData = array(
				'RlSalesList' => $list_curr,
				'paging' => $paging2,
				'NupNO'=>$NupNO,
				'today'=>$today,
				'NupDescs'=>$NupDescs,
				'BussName'=>$BussName,
				'ProjectDescs'=>$projectName,
				'NupTypeDescs'=>$NupTypeDescs,
				'PropertyDescs'=>$PropertyDescs,
				'ProductDescs'=>$ProductDescs,
				'user'=>$user,
				'rowID'=>$datanup[0]->rowID,
        		'seqno'=>$seqno,
        		'phase'=>$dtPhase[0],
				'TotQty'=>$TotQty,
				'RowId'=>$RowId,
				'choosUnit'=>$butt,
				'_url'=>$_url,
				'new'=>$new,
				'rowid_index'=>$rowid_index,
				'status_index'=>$status_index,
				// 'backbtn'=>$backbtn,
				'LotQty'=>$LotQty,
				'balance'=>$balance,
				'comboCountry'=>$cbcountry,
				'comboCity'=>$comboCity,
				'comboLocation'=>$cblocation,
        		'product'=>$dtProduct,
        		'person'=>$person,
        		'cbnationality'=> $cbnationality,
        		'cnt'=>$cnt);
		}
		
		$this->load_content_top_menu('ChooseUnit/v_rl_nup_dtNew2', $ContentAllData);
		// var_dump($ContentAllData);

		// $this->load->view('booking/v_rl_nup_dtNew', $ContentAllData);

	}

	public function load_sf2(){
		$this->load->view('booking/v_rl_nupRevNew');
	}

	public function list_dt($nup_no = null, $ops  = null)
	{
		// var_dump($nup_no);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');

        // $sql = "SELECT descs FROM mgr.pl_project where project_no = '$project' and entity_cd='$entity'";
        // $descProject = $this->m_wsbangun->getData_by_query($sql);
        // $ProjectDescs = $descProject[0]->descs;
        // $dataaa = $this->parse($nup_no);
        $tblHd = 'v_rl_reserve_nup_hd';
        $critHd = array('entity_cd'=>$entity,
        			'project_no'=>$project,
        			'nup_no'=>$nup_no);

        $dataHd = $this->m_wsbangun->getData_by_criteria($tblHd,$critHd);

        $NupNO = $dataHd[0]->nup_no;
		$NupDescs = $dataHd[0]->nup_descs;
		$BussName = $dataHd[0]->name;
		$LotQty = $dataHd[0]->nup_lot_qty;
		$RowId = $dataHd[0]->rowID;
		$today = date('d/m/Y');
		$TotQty = $dataHd[0]->total_dtl;
		$tipe = $dataHd[0]->property_type;
		$balance = $LotQty - $TotQty;



		$sql2 = "SELECT count(*) as cnt FROM mgr.rl_nup_parameter (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date and status = 1 and choose_unit_status = 1";
		$a = $this->m_wsbangun->getData_by_query($sql2);
		$b =intval($a[0]->cnt);
		// var_dump($b);
		
		// if ($b == 0){
		// 	$butt = '<a href="'.base_url("c_nup_unit/index/$RowId/$LotQty/$NupNO").'" class="btn bg-orange btn-sm disabled"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a>';			
		// }else{
		// 	$butt = '<a href="'.base_url("c_nup_unit/index/$RowId/$LotQty/$NupNO").'" class="btn bg-orange btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a>';
		// }

		 $sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 and property_type = 'L'";
         $defaulValue = $this->m_wsbangun->getData_by_query($sql);
         $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
         // var_dump($a);

		$this->session->set_userdata('nupno', $NupNO);
		$Url = ' ';
		if($tipe == 'A'){
				$Url = base_url("c_nup_unit/index/$RowId/$balance/$NupNO");				
		}
		else{
			$Url = base_url("c_nup_landed/indextipe/$NupNO/$a/$balance");

		}

		if ($b == 0){
			$butt = '<a href="'.$Url.'" class="btn abu-bg btn-sm disabled"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a>';			
		}else{
			$butt = '<a href="'.$Url.'" class="btn abu-bg btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a>';
		}

		if (!empty($ops)) {
			$backbtn = '<a href="'.base_url("c_choose_unit_nup/index").'" class="btn abu-bg btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
		} else {
			$backbtn = '<a href="'.base_url("c_nup/index").'" class="btn abu-bg btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
		}


        $tabel2 = 'v_rl_reserve_nup_dt';
	 	$crit2 = array(
	 		'entity_cd'=>$entity,
	 		'project_no'=>$project,
	 		'nup_no'=>$nup_no);

		$datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2,$crit2);

		

		if(!empty($datalist2)){
			$ListAllData = '';
			$i=1;
			foreach ($datalist2 as $value) {
				$parse = array('Lotno' => (string)$value->lot_no, 
						'nupno' => $value->nup_no);
				$lott=(string)$value->rowID;

				$ListAllData .='<tr role="row" class="odd">';
				$ListAllData .='<td style="width: 100px;" class="sorting_1">'.$value->lot_no.'</td>';
				$ListAllData .='<td class="sorting_1">'.$value->lot_descs.'</td>';
				$ListAllData .='<td>'.$value->remarks.'</td>';
				// $ListAllData .='<td style="width: 20px;"><a href="'.base_url('c_nup_dt/delete/'.$value->lot_no.'/'.$value->nup_no).'" class="btn btn-danger btn-sm"><i class="fa fa-scissors"></i>&nbsp;&nbsp;Delete</a></td>';
				// $ListAllData .="<td style='width: 20px;'><a onclick='delete_1('".$lott."')' class='btn btn-danger btn-sm'><i class='fa fa-scissors'></i>&nbsp;&nbsp;Delete</a></td>";
				
				if($b == 0){
					$dell = "<td style='width: 20px;'><a onclick='delete_1(".$lott.")' class='btn btn-danger btn-sm disabled'><i class='fa fa-scissors'></i>&nbsp;&nbsp;Delete</a></td>";
				}else{
					$dell = "<td style='width: 20px;'><a onclick='delete_1(".$lott.")' class='btn btn-danger btn-sm'><i class='fa fa-scissors'></i>&nbsp;&nbsp;Delete</a></td>";
				}

				// $ListAllData .="<td style='width: 20px;'><a onclick='delete_1(".$lott.")' class='btn btn-danger btn-sm'><i class='fa fa-scissors'></i>&nbsp;&nbsp;Delete</a></td>";
				$ListAllData .= $dell;
				$ListAllData .='</tr>';
				$i++;
			}
			
			$ContentAllData = array(
				'RlSalesList' => $ListAllData,
				'NupNO'=>$NupNO,
				'NupDescs'=>$NupDescs,
				'BussName'=>$BussName,
				'ProjectDescs'=>$projectName,
				'TotQty'=>$TotQty,
				'RowId'=>$RowId,
				'today'=>$today, 
				'choosUnit'=>$butt,
				'backbtn'=>$backbtn,
				'LotQty'=>$LotQty,
				'balance'=>$balance);
			
		}else{
			$list_curr = '';
			$paging2 = '';
			// $NupNO = '';
			// $NupDescs = '';
			// $BussName = '';
			// $ProjectDescs = '';
			// $LotQty = '';

			$ContentAllData = array(
				'RlSalesList' => $list_curr,
				'paging' => $paging2,
				'NupNO'=>$NupNO,
				'today'=>$today, 
				'NupDescs'=>$NupDescs,
				'BussName'=>$BussName,
				'ProjectDescs'=>$projectName,
				'TotQty'=>$TotQty,
				'RowId'=>$RowId,
				'choosUnit'=>$butt,
				'backbtn'=>$backbtn,
				'LotQty'=>$LotQty,
				'balance'=>$balance);
		}
		
		$this->load_content_top_menu('booking/v_rl_nup_dt', $ContentAllData);
	}

	public function delete(){
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $rowID = $this->input->post('rowID', TRUE);

        // $nup_no = $this->uri->segment(3);

        $sql ="SELECT nup_no, lot_no from mgr.rl_reserve_nup_dt (NOLOCK) where rowID = ".$rowID;

        $Query = $this->m_wsbangun->getData_by_query($sql);
        $nup_no = $Query[0]->nup_no;
        $lot_no = $Query[0]->lot_no;

        // var_dump($lot_no);
        // var_dump($rowID);
        // var_dump($nup_no);

		$tabel = 'rl_reserve_nup_dt';
		
		$crit2 = array('rowID' => $rowID,
		'entity_cd'=> $entity,
		'project_no' => $project);
		$this->m_wsbangun->deletedata($tabel, $crit2);

		// $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = '$lot_no' and entity_Cd = '$entity' and project_no = '$project'");
		$this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = '$lot_no' and entity_Cd = '$entity' and project_no = '$project' and nup_counter > 0");

		

		// $this->load_content_top_menu('c_nup_dt/list_dt/'.$nup_no);

		// redirect('c_nup_dt/list_dt/'.$nup_no); 		
		echo $nup_no;
	}

	// public function getTableAttach()
	// {
	// 	$entity = $this->session->userdata('Tsentity');
	// 	// var_dump($entity);
 //        $project = $this->session->userdata('Tsproject');
 //        $name = $this->session->userdata('Tsuname');
 //        $seqno = $this->input->post('seqno', true);
 //        // $DB2 = $this->load->database('ifca2', TRUE);

 //        //untuk PK diharap diletakan di awal array
 //        $aField = array('id', 'subject', 'content','status');
 //        $aColumns  = array('row_number', 'document_no', 'document_descs', 'file_attachment');
 //        // $aColumns = array('entity_cd', 'entity_name');
 //        $sTable = 'mgr.rl_nup_attachment';

 //        $iDisplayStart = (int)$this->input->get_post('start', true);
 //        $iDisplayLength = (int)$this->input->get_post('length', true);
 //        // if($iDisplayLength<0){
 //        // 	$iDisplayLength=5;
 //        // }
 //        $order = $this->input->get_post('order', true);
 //        $draw = (int)$this->input->get_post('draw', true);
 //        $Column = $this->input->get_post('columns', true);
 //        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
 //        // $iSortingCols = $this->input->get_post('iSortingCols', true);
 //        $sSearch = $this->input->get_post('search', true);
 //        $Search = $sSearch['value'];

 //        $Search_regex = $sSearch['regex'];
 //        $SortdOrder = $order[0]['dir'];
 //        $sortIdColumn = (int)$order[0]['column'];
 //        // var_dump($Column[$sordIdColumn]['name']);
 //        $SordField = ($sortIdColumn==0? $aColumns[1] :$column[$sortIdColumn]['name']);

     

 //        // filter
 //        $filter_search='';
 //        if(isset($Search) && !empty($Search)){            
 //            for($i=0;$i<count($Column); $i++){
 //                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
 //                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
 //                }
                
 //            }
 //            $a = strrpos($filter_search, 'OR');        
 //            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

 //        }
 //        // Select Data

 //        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
 //        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
 //        // $rResult = $DB2->get($sTable);
 //        // $rResult = $DB2->query($sql_data);
 //        $param =" Where nup_sequence_no=".$seqno." AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
 //        $field=" document_no,document_descs,file_attachment,rowID,nup_sequence_no ";
 //   		$rResult = $this->m_wsbangun->getlisttableattach($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$field);

   		
 //      // var_dump($rResult->result_array());exit();
 //      // return;
 //        // Total data set length
        
 //        // $sql="select count(*) as cnt from ".$sTable." ".$param;
 //        // $ts = $DB2->query($sql);
 //        // $a = $ts->result()[0]->cnt;

 //        // $iTotal = $a;//$DB2->count_all($sTable);
    
 //        // Output
 //        $output = array(
 //            'draw' => intval($draw),
 //            // 'recordsTotal' => $iTotal,
 //            // 'recordsFiltered' => $iTotal,
 //            'data' => array()
 //        );
        


 //        foreach($rResult->result_array() as $aRow)
 //        {
 //            $row = array();
            
 //            foreach($aColumns as $col)
 //            {
 //                $row[] = $aRow[$col];
                
 //            }
    
 //            $output['data'][] = $aRow;
 //        }

   
 //        echo json_encode($output);


	// }

	public function getTableAttachDoc()
	{
		$entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $seqno = $this->input->post('seqno', true);
        // $DB2 = $this->load->database('ifca2', TRUE);
        // var_dump($seqno);
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
        $param =" Where nup_sequence_no=".$seqno." AND entity_cd='".$entity."' AND project_no= '".$project."' AND document_descs in ('KTP','NPWP') ".$filter_search;
        $field=" document_no,document_descs,file_attachment,rowID,nup_sequence_no ";
   		$rResult = $this->m_wsbangun->getlisttableattach($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$field);

   		
      // var_dump($rResult->result_array());exit();
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
        $data = $this->m_wsbangun->getData_by_query2($sql);
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
        $this->load->view('booking/v_nup_uploadNew');
    }



	public function save_cf_business($ID='',$name='',$HP='',$email='',$user='',$country_cd='',$address='',$noktp='',$city='',$npwp='',$salutation='', $nationality=''){

		$table = 'cf_business';      
		$class =  $this->m_business->zomm_class(); 
        $class_cd = $class[0]->class_cd;

		if($ID==0)
		{
			$AutoNumber = $this->m_business->get_autonumber();
	        
	        $Number = (int)$AutoNumber[0]->COUNTER;	
	        $data = array(
                			'business_id'=>$Number,
                			'class_cd'=>$class_cd,
  							'category'=>'I',
  							'name'=>$name,  							
  							'hand_phone'=>$HP,
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
	        // $this->m_wsbangun->insertData($table,$data);
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
	  							'hand_phone'=>$HP,
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
				$this->m_wsbangun->updateData($table,$data, $where);
             

			}
		

        
        // var_dump($editdata);
            	
  		
        
        return $Number;
  			
  			
	}

	public function savenup2()
	{
		if($_POST){			
				$tday = date('d M Y');
				$today = date('d M Y H:i:s');
				$cons = $this->session->userdata('Tscons');
				$salutation =  $this->input->post('salutation', TRUE);
				$customer = $this->input->post('customer', TRUE);
				$HP = $this->input->post('HP', TRUE);
				$country_cd = $this->input->post('country_cd', TRUE);
				$Email = $this->input->post('Email', TRUE);
				$noktp = $this->input->post('noktp', TRUE);
				$address = $this->input->post('address', TRUE);
				$city = $this->input->post('city', TRUE);
				$npwp = $this->input->post('npwp', TRUE);
				
				$seqno = $this->input->post('seqno', TRUE);
				$Location = $this->input->post('Location', TRUE);
				$nationality =  $this->input->post('nationality', TRUE);
				// $business_id = $this->input->post('business_id', true);
				$cntfile = $this->input->post('cntfile', true);
				$business_id = $this->input->post('business_id', true);
				$entity = $this->session->userdata('Tsentity');
				$project = $this->session->userdata('Tsproject');
				$user = $this->session->userdata('Tsuname');
				$nupdesc = $this->input->post('nupdesc', true);

				// var_dump($country_cd);
				// var_dump($HP);
				if($nationality != '01'){
					$npwp = '';
				} else {
					$npwp = $npwp;
				}


				$hpcd = $country_cd.$HP;
				// var_dump($hpcd);
				// exit;

				$where = array('nup_sequence_no' => $seqno);

				// $table = 'agent_details';
		  //       $crit = array('userid'=>$user);
		  //       $agent = $this->m_wsbangun->getData_by_criteria($table,$crit);

				$data = array(
					// 'entity_cd'=>$entity,
	        		// 'project_no'=>$project,
	        		// 'reserve_by'=>$user,
	        		// 'reserve_date'=>$today,
	        		'audit_user'=>$user,
	        		'audit_date'=>$today,	        		
	        		'location_cd'=>$Location,
	        		'choose_unit_status'=>'Y'

	        		);

				$update = $this->m_wsbangun->updateData_cons($cons,'rl_reserve_nup',$data, $where);

				if($update == 'OK')
                        {
                            $a="Data has been saved successfully";
                            $psn = "OK";
                        } else {
                            $a= $update;
                            $psn = "Failed";
                        } 

                    	$where = array('business_id' => $business_id);
                    	$data = array(	                			
	  							'NAME'=>$customer,  							
	  							'hand_phone'=>$hpcd,
	  							'email_addr'=>$Email,
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
                    		$update = $this->m_wsbangun->updateData_cons($cons,'cf_business',$data, $where);

                    		if($update == 'OK')
	                        {
	                            $a="Data has been saved successfully";
	                            $psn = "OK";
	                        } else {
	                            $a= $update;
	                            $psn = "Failed";
	                        }

                    		




                } else {
                    $a = "Data is not valid";
                }

			$msg = array('pesan'=>$a,
					'status'=>$psn);
			echo json_encode($msg);
		}

		public function showland($lotno = null, $rowid = null, $nup_no = null, $balance = null, $rowid_index = null, $status = null) {    	

	        $entity = $this->session->userdata('Tsentity');
	        $project = $this->session->userdata('Tsproject');
	        $projectName = $this->session->userdata('Tsprojectname');

	        $nupno = $this->session->userdata('NupNo');

	        $img ="";
	        
	        // var_dump($lotno);

	        $table = 'v_payment_plan (nolock)';
	        $object = array('payment_cd', 'descs');
	        $where = array('entity_cd'=>$entity,
	                        'project_no'=>$project,
	                        'lot_no' =>$lotno);
	        $cbpayment = $this->m_wsbangun->getCombo($table,$object,$where);

	        // $table = ''
	        // var_dump($cbpayment);

	    
	        if ($handle = opendir('img/LotInfo/new/')) {
	            
	            $sql = "select * from mgr.v_pm_lot_info where lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
	            $data = $this->m_wsbangun->getData_by_query($sql);
	            $pic = $data[0]->pic_name;
	            
	            $thelist='';$list='';$no=1;
	            while (false !== ($file = readdir($handle)))
	            { 


	                if ($file != "." && $file != ".." && substr($file,0,4) == $pic)
	                {    
	                    if($no==1){
	                        $thelist .= '<div class="item active">';
	                    }      
	                    else {
	                        $thelist .= '<div class="item">';
	                    }              
	                    $thelist .= '<a href="'.base_url('img/LotInfo/new/').$file.'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/new/').$file.'" ></a>';
	                    $thelist .= '</div>';
	                    $no++;
	                }
	                    
	            }
	            if($thelist!=''){

	                $list=$thelist;
	            }
	            else {
	                $list .= '<div class="item active">';
	                $list .= '<a href="'.base_url('img/LotInfo/new/unavailable.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/new/unavailable.jpg').'" ></a>';
	                $list .= '</div>';
	            }
	            // echo $list;
	        }
	        closedir($handle);
	        // var_dump($img);
	        
	        
	        
	        $content = array('data' => $data,
		            'img'=>$list,
		            'cbpayment'=>$cbpayment,
		            'rowid'=>$rowid,
		            'nup_no'=>$nup_no,
		            'balance'=>$balance,
		            'rowid_index'=>$rowid_index,
		            'status'=>$status	            
	            );
	        $this->load->view('booking/infolandeddt',$content);
    }

    function updateAddPay(){
    	if($_POST){
    		$rowid = $this->input->post('rowid', TRUE);
    		$add = $this->input->post('additional_cd', TRUE);
    		$pay = $this->input->post('payment_cd', TRUE);

    		$table = 'rl_reserve_nup_dt';
    		$data = array('additional_cd'=>$add,
    						'payment_cd'=>$pay
    			);

    		$where = array('rowID' =>$rowid);

    		$update = $this->m_wsbangun->updateData($table, $data, $where);
    		if($update == 'OK') {
            	$a = "Data has been Updated successfully";
				$psn = "OK";
            } else {
            	$a= $update;
                $psn = "Failed";
            }

    	} else {
    		$a = "Data is not valid";
    	}

    	$msg = array('pesan'=>$a,
					'status'=>$psn);
		echo json_encode($msg);
    }

 //    function showEdit(){

 //    }

 //    public function chosen_salutation(){
	// 	$id = $this->input->post('Id', TRUE);
	// 	$id = trim($id);
	// 	$entity = $this->session->userdata('Tsentity');
 //        $project = $this->session->userdata('Tsproject');

	// 	$table = 'cf_business (nolock)';
 //        $obj = array('salutation', 'salutation');
 //        // var_dump($obj);
      
 //        $data = $this->m_wsbangun->getCombo($table,$obj,null,$id);
 //        echo $data;
	// }

    public function show_edit_data($rowID=''){
		
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

		$where =array('entity_cd'=>$entity,
					'project_no'=>$project,
					'rowID'=>$rowID);
		$data = $this->m_wsbangun->getData_by_criteria('rl_reserve_nup_dt',$where);


		echo json_encode($data);

	}
}