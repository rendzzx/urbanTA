<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_pm_bill_sch extends Core_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->load->model('m_pm_bill_sch');
		$this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
	}

	public function billing($project_no=''){
        // $content = array('error'=>'');
        // $entity = $this->session->userdata('Tsentity');
        // $where=array('entity_cd'=>$entity);
        // $data_project = $this->m_newsfeed->get_table_by_id("mgr.pl_project",$where);  
        // var_dump($project_no);
        $data=array('project_no'=>$project_no);
        $this->load->view('newsfeed/add',$data);
    }

	public function index()
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
		$config['base_url'] = base_url("c_pm_bill_sch/index/".$LotNo);
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