<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_sales_billing extends Core_Controller {

	public function __construct(){
		parent::__construct();
		
		// $this->load->model('m_pm_bill_sch');
		// $this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
	}

	public function billing($lot_no=''){
		// $lot_no = $this->uri->segment(3);
        // $content = array('error'=>'');
        // $entity = $this->session->userdata('Tsentity');
        // $where=array('entity_cd'=>$entity);
        // $data_project = $this->m_newsfeed->get_table_by_id("mgr.pl_project",$where);  
        // var_dump($lot_no);
        // $data=array('lot_no'=>$lot_no);
        // $this->load->view('booking/v_sales_billing',$data);
        // $this->load->view('booking/v_sales_billing');

        $data = array('userLevelList'=> $this->datatable($lot_no));
        // $this->load->view('booking/v_sales_billing',$data);
    }
	
	function datatable($lot_no=null){		
		// $ContentAllData ='';
        	$entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $billType = 'B';
            $table = 'v_pm_bill_sch';
            $kriteria = array('entity_cd' => $entity, 
            				'project_no'=> $project,
            				'lot_no'=>$lot_no,
            				'bill_type' => $billType);
            // var_dump($kriteria);
            $table2 = 'v_cf_business';
            $kriteria2 = array('lot_no' => $lot_no);
            $BusinessName = $this->m_wsbangun->getData_by_criteria($table2, $kriteria2);
            $name = $BusinessName[0]->name;
            
            $sql = "SELECT debtor_acct,lot_no FROM mgr.rl_sales WHERE lot_no='".$lot_no."'";
			$dtSales = $this->m_wsbangun->getData_by_query($sql);
			$debtor = empty($dtSales) ? '' : $dtSales[0]->debtor_acct;

           $AllData = $this->m_wsbangun->getData_by_criteria($table, $kriteria);


           // var_dump($AllData);

            if(!empty($AllData)){
			$ListAllData = '';
			$TotalTrxAmt = 0;
			$i=1;

			foreach ($AllData as $value) {
				$ListAllData .='<tr>';
				$ListAllData .='<td>'.$i.'</td>';
				$ListAllData .='<td>'.$value->bill_date.'</td>';
				$ListAllData .='<td>'.$value->trx_type.'</td>';
				$ListAllData .='<td>'.$value->descs.'</td>';
				$ListAllData .='<td class="text-right">'.number_format($value->tax_amt,2).'</td>';
				$ListAllData .='<td class="text-center">'.$value->currency_cd.'</td>';
				$ListAllData .='<td class="text-right">'.number_format($value->trx_amt,2).'</td>';

				if($value->status == "N"){
					// $a = '<img src="'.base_url().'img/X.png" height="20" width="20">';
					$a = "<div class='glyphicon glyphicon-remove glyph-color-red'></div>";
				}else{
					// $a = '<img src="'.base_url().'img/Y.png" height="20" width="20">';
					$a = "<div class='glyphicon glyphicon-ok glyph-color-green'></div>";
				}

				$ListAllData .='<td class="text-center">'.$a.'</td>';
				$ListAllData .='</tr>';
				
				$i++;					
				$TotalTrxAmt = $value->trx_amt; 			
			}
			$ListAllData .= '<tr><td align = "right" colspan = "6"><b>Sub Total</b></td><td align = "right"><b>'.number_format($TotalTrxAmt,2).'</b></td></tr>';
			// $ListAllData .= '<tr><td align = "right" colspan = "6"><b>Total</b></td><td align = "right"><b>'.number_format($TrxTotal,2).'</b></td></tr>';
			// var_dump($ListAllData);
			$ContentAllData = array('PmBillSch' => $ListAllData,
				'lotno'=> $lot_no,
				'debtor'=> $debtor,
				'name' => $name
				);
			
		}else{
			$list_curr = '';
			// var_dump('expression');

			$ContentAllData = array(
				'PmBillSch' => $list_curr,
				'lotno'=> $lot_no,
				'debtor'=> $debtor,
				'name' => $name
				);
			//$this->load->view('v_pm_bill_sch', $ContentAllData2);
			// $ContentAllData = $ListAllData;	
		}
		$this->load->view('booking/v_sales_billing', $ContentAllData);
        // return $ContentAllData;
	}

	public function indexOld()
	{
		$perpage = 10;
		$total = 0;
		$offset = $this->uri->segment(4);
		$LotNo = $this->uri->segment(3);
		// echo $LotNo;
		if($offset===false){
			$offset = 0;
		}
		// var_dump($offset);
		$perpage = $perpage + $offset;
		$criteria = "where lot_no = '$LotNo'";
		$dtotal = $this->m_pm_bill_sch->getdata_row($criteria);
		//var_dump($dtotal);

		$TrxTotal = 0;

		foreach ($dtotal as $value) {
			$TrxTotal += $value->trx_amt;
			$total++;
		}
		// index.php/c_rl_sales/index/10
		// var_dump($total);
		$config['base_url'] = base_url("c_sales_billing/index/".$LotNo);
		// $config['base_url'] = base_url("index.php/c_pm_bill_sch/index/");
		$config['total_rows'] = $total;
		$config['per_page'] = 10;
		$config['uri_segment']= 4;

		// var_dump($config);
		$this->pagination->initialize($config); 
		// var_dump($this->pagination);
		$paging = $this->pagination->create_links();
		// var_dump($paging);
		$AllData = $this->m_pm_bill_sch->DataPaging($offset, $perpage, $LotNo);

		$DataLot = $this->m_rl_sales_list->getlot_name($LotNo);
		$LotName = $DataLot[0]->name;
		$sql = "SELECT debtor_acct,lot_no FROM mgr.rl_sales WHERE lot_no='".$LotNo."'";
		$dtSales = $this->m_wsbangun->getData_by_query($sql);
		$debtor = empty($dtSales) ? '' : $dtSales[0]->debtor_acct;

		// $AllData = $this->m_pm_bill_sch->DataPerLot($LotNo);
		if(!empty($AllData)){
			$ListAllData = '';
			$TotalTrxAmt = 0;
			$i=1 + $offset;

			foreach ($AllData as $value) {
				// $status = $value->status;
				$ListAllData .='<tr>';
				// $ListAllData .='<th>'.$value->row.'</th>';
				$ListAllData .='<th>'.$i.'</th>';
				$ListAllData .='<th>'.$value->bill_date.'</th>';
				$ListAllData .='<th>'.$value->trx_type.'</th>';
				$ListAllData .='<th>'.$value->descs.'</th>';
				$ListAllData .='<th class="text-right">'.number_format($value->tax_amt,2).'</th>';
				$ListAllData .='<th class="text-center">'.$value->currency_cd.'</th>';
				$ListAllData .='<th class="text-right">'.number_format($value->trx_amt,2).'</th>';
				// $ListAllData .='<th>'.$value->status.'</th>';				
				if($value->status == "N"){
					$a = '<img src="'.base_url().'assets/images/X.png" height="20" width="20">';
				}else{
					$a = '<img src="'.base_url().'assets/images/Y.png" height="20" width="20">';
				}
				$ListAllData .='<th class="text-center">'.$a.'</th>';
				$ListAllData .='</tr>';
				
				$i++;					
				$TotalTrxAmt += $value->trx_amt; 			
			}
			$ListAllData .= '<tr><td align = "right" colspan = "6"><b>Sub Total</b></td><td align = "right"><b>'.number_format($TotalTrxAmt,2).'</b></td></tr>';
			$ListAllData .= '<tr><td align = "right" colspan = "6"><b>Total</b></td><td align = "right"><b>'.number_format($TrxTotal,2).'</b></td></tr>';

			// $DataLot = $this->m_rl_sales->getlot_name($LotNo);
			// $LotName = $DataLot[0]->name;

			$ContentAllData = array('PmBillSch' => $ListAllData,
				'paging' => $paging,
				'lotno'=> $LotNo,
				'debtor'=> $debtor,
				'name' => $LotName);
			// $ContentAllData = array('PmBillSch' => $ListAllData);
			//$this->load->view('v_pm_bill_sch', $ContentAllData);
		}else{
			$list_curr = '';
			$paging2 = '';
			// $DataLot = $this->m_rl_sales->getlot_name($LotNo);
			// $LotName = $DataLot[0]->name;

			$ContentAllData = array(
				'PmBillSch' => $list_curr,
				'paging' => $paging2,
				'lotno'=> $LotNo,
				'debtor'=> $debtor,
				'name' => $LotName);
			//$this->load->view('v_pm_bill_sch', $ContentAllData2);	
		}
		
		 // $this->load->view('template/v_header');
		// $this->load->view('template/header');
		//  $this->load->view('v_pm_bill_sch', $ContentAllData);
		//  $this->load->view('template/footer');
		 // $this->load->view('template/v_footer');
		// var_dump($AllData);

		// $this->load->view('template/v_header');
		// $this->load->view('template/v_menu');
		// $this->load->view('v_pm_bill_sch', $ContentAllData);
		// $this->load->view('template/v_footer');
		$this->load_content('booking/v_pm_bill_sch', $ContentAllData);
	}
}