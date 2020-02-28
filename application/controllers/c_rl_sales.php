<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//note
class C_rl_sales extends Core_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->auth_check();
		$this->load->model('m_rl_sales');
		$this->load->model('m_wsbangun');
		$this->load->model('m_sms');
	}
	
	public function index($lot=null, $property_cd=null,$error=null)
	{
		// $lot = $this->input->post('id',TRUE);
		// var_dump($property_cd);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $bussId = $this->session->userdata('TmpBuss');
        $webuser = $this->session->userdata('Tsuname');
        $Tsprojectname = $this->session->userdata('Tsprojectname');
		// $debtor_acct = $this->create_debtor();
		// $where=array('entity_cd'=>$entity,
  //       				'project_no'=> $project);
		// $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);   
		$data['project_name']=$Tsprojectname;
		// $data['debtor']=$this->create_debtor($lot,'in');
		$data['property_cd']=$property_cd;
		
        $data['combo_customer']=$this->zoom_nama($bussId);
        // $data['combo_unit']=$this->zoom_lot($lot);
        $data['lot_no']=$lot;
        $data['combo_payment']=$this->zoom_payment_cd();

        $data['combo_event'] = $this->zoom_event();

      
        $data['Combo_disc'] = $this->zoom_discount();
        // $data['property_type'] =$this->cb_property_cd($entity,$project);
        $data['error'] = $error;
   
		$this->load_content_top_menu('booking/v_rl_sales', $data);
		
	}
	public function Report(){
		$this->load->view('dash/ReportCR');
	}
	public function indexfromlist($rowID=null)
	{
		// var_dump($rowID);
		// $lot = $this->input->post('id',TRUE);
		// var_dump($property_cd);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $bussId = $this->session->userdata('TmpBuss');
        $webuser = $this->session->userdata('Tsuname');
        $Tsprojectname = $this->session->userdata('Tsprojectname');
		// $debtor_acct = $this->create_debtor();
		// $where=array('entity_cd'=>$entity,
  //       				'project_no'=> $project);
		// $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);   

		$sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1";
        $defaulValue = $this->m_wsbangun->getData_by_query($sql);
        $property_cd = empty($defaulValue)? '': $defaulValue[0]->default_value;

		$data['project_name']=$Tsprojectname;
		// $data['debtor']=$this->create_debtor($lot,'in');
		$data['property_cd']=$property_cd;
		$data['rowID']=$rowID;
		if($rowID==0){
		        $data['combo_customer']=$this->zoom_nama($bussId);       
		        $data['combo_payment']=$this->zoom_payment_cd();
		        $data['combo_event'] = $this->zoom_event();      
		        $data['Combo_disc'] = $this->zoom_discount();
		    }else{
		    	$data['combo_customer']='';       
		        $data['combo_payment']='';
		        $data['combo_event'] = '';      
		        $data['Combo_disc'] = '';
		    	
		    }
        // $data['property_type'] =$this->cb_property_cd($entity,$project);
        // $data['error'] = $error;
   
		$this->load_content_top_menu('booking/v_rl_sales_fromlist', $data);
		
	}
	public function indexModal($rowID=null)
	{
		// var_dump($rowID);
		// $lot = $this->input->post('id',TRUE);
		// var_dump($property_cd);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $bussId = $this->session->userdata('TmpBuss');
        $webuser = $this->session->userdata('Tsuname');
        $Tsprojectname = $this->session->userdata('Tsprojectname');
		// $debtor_acct = $this->create_debtor();
		// $where=array('entity_cd'=>$entity,
  //       				'project_no'=> $project);
		// $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);   

		$sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1";
        $defaulValue = $this->m_wsbangun->getData_by_query($sql);
        $property_cd = empty($defaulValue)? '': $defaulValue[0]->default_value;

		$data['project_name']=$Tsprojectname;
		// $data['debtor']=$this->create_debtor($lot,'in');
		$data['property_cd']=$property_cd;
		$data['rowID']=$rowID;
		if($rowID==0){
		        $data['combo_customer']=$this->zoom_nama($bussId);       
		        $data['combo_payment']=$this->zoom_payment_cd();
		        $data['combo_event'] = $this->zoom_event();      
		        $data['Combo_disc'] = $this->zoom_discount();
		    }else{
		    	$data['combo_customer']='';       
		        $data['combo_payment']='';
		        $data['combo_event'] = '';      
		        $data['Combo_disc'] = '';
		    	
		    }
        // $data['property_type'] =$this->cb_property_cd($entity,$project);
        // $data['error'] = $error;
   
		$this->load->view('booking/v_rl_sales_modal', $data);
		
	}
	public function getByID($id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria('rl_sales',$where);

        echo json_encode($data);

    }
	public function cb_property_cd(){

			// $sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1";
   //          $defaulValue = $this->m_wsbangun->getData_by_query($sql);
   //          $Id = empty($defaulValue)? '': $defaulValue[0]->default_value;
		$Id = $this->input->post('Id',TRUE);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
            
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project);
             // $table = 'cf_property';
            // $obj = array('property_cd', 'descs');
            // $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where, $property_cd);

        	// $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);   

        	// $Id = $this->input->post('Id',TRUE);
    		$table = 'cf_property';
	        $dtBuss = $this->m_wsbangun->getData_by_criteria($table,$where);

        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
              if($Id === $customer->property_cd) {
                $pilih = ' selected = "1"';
              } else {
                $pilih = '';
              }
                $comboBus[] = '<option '.$pilih.' value="'.$customer->property_cd.'">'.$customer->descs.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        echo $comboBus;
        	// return $cbProp;
	}

	public function edit($selected_id="", $data=null)
	{
		if(!empty($selected_id))
		{
			$entity = $this->session->userdata('Tsentity');
	        $project = $this->session->userdata('Tsproject');
	        // $lotno = $selected_id;
	        $table = 'rl_sales';
	        $criteria = array('entity_cd'=>$entity,
	        	'project_no'=>$project,
	        	'lot_no'=>$selected_id);
	        $dtSales = $this->m_wsbangun->getData_by_criteria($table, $criteria);
	        if(!empty($dtSales)) 
	        {
	        	$table = 'rl_payment_plan_hd';
		        $kriteria = array('payment_status'=>'A');
		        $dtPayment = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
		        if(!empty($dtPayment)) {
		        	$comboPay[] = '<option></option>';
		        	foreach ($dtPayment as $payment) {
		        		if($dtSales[0]->payment_cd == $payment->payment_cd) {
		        			$pilih = ' selected = "selected"';
		        		} else {
		        			$pilih = '';
		        		}
		        		$comboPay[] = '<option '.$pilih.' value="'.$payment->payment_cd.'">'.$payment->descs.'</option>';
		        	}
		        	$comboPay = implode("", $comboPay);
		        }
		        
		        $tableopDis = 'rl_discount';
		        $lotopdis = $this->m_wsbangun->getData($tableopDis);

		        $optidisc[] = '<option></option>';
		        if (!empty($lotopdis)) {
		        	foreach ($lotopdis as $disc) {
		        		if($disc->disc_cd == $dtSales[0]->disc_cd) {
		        			$pilih = ' selected="selected"';
		        		} else {
		        			$pilih = '';
		        		}
		        		if(empty($dtSales[0]->disc_cd)) {
		        			$pilih = ($disc->disc_cd=='NA'? ' selected="selected"': '');
		        		}
		        		$optidisc[] = '<option'.$pilih.' data-level="'.$disc->percent1.'" value="'.$disc->disc_cd.'">'.$disc->descs.'</option>';
		        	}
		        	$optidisc = implode("", $optidisc);
		        }
		        $dfMedia = $dtSales[0]->media_cd;

		        $table = 'cf_media';
        		$dtMedia = $this->m_wsbangun->getData($table);
				$comboEvent[] = '<option></option>';
				if(!empty($dtMedia)) {

					foreach ($dtMedia as $value) {
						if($dfMedia === $value->media_cd) {
							$pilih = ' selected = "selected"';
						} else {
							$pilih = '';
						}
						$comboEvent[] = '<option '.$pilih.' value="'.$value->media_cd.'">'.$value->descs.'</option>';
					}
				$comboEvent = implode("", $comboEvent);
				}
		        
		        $table = 'cf_business';
		        $kriteria = array('business_id'=>$dtSales[0]->business_id);
		        $dtBuss = $this->m_wsbangun->getData_by_criteria($table, $kriteria);
		        if(!empty($dtBuss)) {
		        	$customer = $dtBuss[0]->name;
		        } else {
		        	$customer = '';
		        }
		        $statusSales = array('B'=>'Approve',
	        		'P'=>'Not Approve',
	        		'E'=>'Pending',
	        		'C'=>'Cancel',
	        		'T'=>'Terminate');
	        	$status = $statusSales[$dtSales[0]->status];

	        	
				$cekStatus = $dtSales[0]->status;
				$back[] = '<a></a>';
				if ($cekStatus) {
					foreach ($dtSales as $value) {
						if ($value->status=='B') {
							$back[] = '<a href="'.base_url('c_rl_sales_list/index/').'"><input class="btn btn-primary" type="button" value="Back"></a>'; 
						}else{
							$back[] = '<button class="btn btn-primary" type="sumedia_cdmit" id="btnSimpan" onClick="validasi()"><i ></i> Save</button>'; 
						}
					}
				$back = implode("", $back);
				}

				$sql = "select DISTINCT trx_amt from mgr.pm_lot_price where entity_cd='".$entity."' AND project_no='".$project."' AND lot_no ='".$dtSales[0]->lot_no."'"; //SALE
        			$dtSubmit = $this->m_wsbangun->getData_by_query($sql);
        			$Priceamt = $dtSubmit[0]->trx_amt;

				// var_dump($sql);
	        	$content = array('dataSales'=>$dtSales[0],
	        		'status'=>$status,
	        		'customer'=>$customer,
	        		'combo_payment'=>$comboPay,
	        		'combo_disc'=>$optidisc,
	        		'combo_event'=>$comboEvent,
	        		'back'=>$back,
	        		'Priceamt'=>$Priceamt);
	        	// var_dump($content);
	        	$this->load_content_top_menu('booking/v_rl_salesEdit', $content);
	        } else 
	        {
	        	show_404();
				return;
	        }
		} else 
		{
			show_404();
			return;
		}
	}

	public function check_debtor()
	{
		if(!empty($_POST))
		{
			$entity = $this->session->userdata('Tsentity');
			$project = $this->session->userdata('Tsproject');
			$debtor = $this->input->post('debtor',TRUE);
			$table = 'rl_sales';
			$crit = array('entity_cd'=>$entity,
				'project_no'=>$project,
				'lot_no'=>$debtor,
				'status'=>'T');
			$cnt = $this->m_wsbangun->getCount_by_criteria($table, $crit);
			$acct_debtor = ($cnt>0 ? $debtor.'-'.$cnt : $debtor);

			echo($acct_debtor);
		}
	}

	public function create_debtor($lot,$from)
	{
		$debtor_no='';
		// $this->input->POST('debtor');
		$entity = $this->session->userdata('Tsentity');
			$project = $this->session->userdata('Tsproject');			
			$table = 'rl_sales';
			$crit = array(
				// 'entity_cd'=>$entity,
				// 'project_no'=>$project,
				// 'lot_no'=>$lot,
				'lot_rowid'=>$lot,
				'status'=>'T');
			$cnt = $this->m_wsbangun->getCount_by_criteria($table, $crit);
			$debtor_no = ($cnt>0 ? $lot.'-'.$cnt : $lot);

			// echo($acct_debtor);
		if($from=='in'){
		 return $debtor_no;
		}else{

			echo $debtor_no;
		}
	}


	public function zoom_nama($bussId)
	{
		$Id = 
		$table = 'cf_business';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
            	if($bussId === $customer->business_id) {
            		$pilih = ' selected = "1"';
            	} else {
            		$pilih = '';
            	}
                $comboBus[] = '<option '.$pilih.' value="'.$customer->business_id.'">'.$customer->ic_no.'         - '.$customer->name.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        return $comboBus;
	}
	public function zoom_nama_from()
	{
		$bussId = $this->input->post('bussId',TRUE);
		$table = 'cf_business';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
            	if($bussId === $customer->business_id) {
            		$pilih = ' selected = "1"';
            	} else {
            		$pilih = '';
            	}
                $comboBus[] = '<option '.$pilih.' value="'.$customer->business_id.'">'.$customer->ic_no.' - '.$customer->name.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        echo $comboBus;
	}
	public function hitung_ulang_disc()
	{
		$DB2 = $this->load->database('ifca', TRUE);

		$list_price = str_replace(",","",$this->input->POST('list_price'));
		$plan_disc = str_replace(",","",$this->input->POST('plan_disc'));
		$aditional_disc = $this->input->POST('aditional_disc');
		$tax_cd = $this->input->POST('tax_cd');
		// E RN
		// $disc = $this->input->POST('');


		$incl_excl ='';
		$tax_rate = 0;
		$tax_list_amt=0;
		$sales_price = 0;

		$net_price = $list_price - ($plan_disc+$aditional_disc);

		// var_dump($net_price);		
		
		$data = $DB2->query("SELECT max( mgr.cf_tax_sch_hd.incl_excl) AS incl_excl,sum( mgr.cf_tax_sch_dt.tax_rate)  AS tax_rate from  mgr.cf_tax_sch_dt,  mgr.cf_tax_sch_hd Where ( mgr.cf_tax_sch_dt.scheme_cd 	= mgr.cf_tax_sch_hd.scheme_cd) 	And ( mgr.cf_tax_sch_hd.scheme_cd 	= '".$tax_cd."') And	( mgr.cf_tax_sch_dt.deduct_flag 	= 'N' )");
		$data = $data->result();
		if(!empty($data)){
			$incl_excl = $data[0]->incl_excl;
			$tax_rate  = $data[0]->tax_rate;
		}

		if ($incl_excl =='I'){
			$tax_list_amt = round(($net_price * $tax_rate) / ($tax_rate + 100),2);
			$sales_price = $net_price;
		}else{
			$tax_list_amt = round(($net_price * $tax_rate) /  100,2);
			$sales_price = $net_price+$tax_list_amt;
		};
		
		$data[] = array('net_price'=>$net_price,
					   'list_tax_amt'=>$tax_list_amt,
					   'sales_price'=>$sales_price);

		echo json_encode($data);


	}
	public function search()
	{
		$DB2 = $this->load->database('ifca', TRUE);
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);

		$data = $DB2->query("SELECT business_id,name  FROM mgr.cf_business  WHERE name LIKE '%$keyword%' OR business_id LIKE '%$keyword%'");

		// format keluaran di dalam array
		foreach($data->result() as $row)
		{
			$arr['query'] = $keyword;
			$arr['suggestions'][] = array(
				'value'			=>$row->name,
				'business_id'		=>$row->business_id,
				'name'	=>$row->name
			);
		}
		// minimal PHP 5.2
		echo json_encode($arr);
	} 
	public function set_field2(){

		$cons = $this->session->userdata('Tscons');
		$DB2 = $this->load->database($cons, TRUE);
		$entity = $this->session->userdata('Tsentity');
		$project = $this->session->userdata('Tsproject');
		$lot_no 		=	$this->input->POST('lot_no');
		$payment_cd 	= 	$this->input->POST('payment');

		$data = $DB2->query("SELECT DISTINCT list_before_price,land_tax_cd,land_tax_amt,disc,net_price,list_tax_amt,contract_price FROM mgr.v_rl_sales_payment where entity_cd='".$entity."' and lot_no= '".$lot_no."' and payment_cd= '".$payment_cd."' AND ((DATEADD(dd,0,DATEDIFF(dd,0,GETDATE()))) BETWEEN START_DATE AND end_date OR max_end_date BETWEEN START_DATE AND end_date) ");
		$data= $data->result();
		// var_dump($data);

		echo json_encode($data);
		// echo json_encode($arr);

	}

	public function hitung_netprice()
	{

	}
	public function zoom_discount(){
		  $tableopDis = 'rl_discount';
        $lotopdis = $this->m_wsbangun->getData($tableopDis);
        if (!empty($lotopdis)) 
        {
        	$optidisc[] = '<option></option>';
        	foreach ($lotopdis as $disc) 
        	{
        		$optidisc[] = '<option data-level="'.$disc->percent1.'" value="'.$disc->disc_cd.'">'.$disc->descs.'</option>';
        	}
        	$optidisc = implode("", $optidisc);
        }
        return $optidisc;
	}
	public function cek_status_update(){
		$lot_no = $this->input->POST('Id',true);
		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
		$where=array(
			'entity_cd'=>$entity,
			'project_no'=>$project,
			'lot_no'=>$lot_no);
		$lot_web_status = $this->m_wsbangun->getData_by_criteria('pm_lot_web',$where);
		$lot_web_status = $lot_web_status[0]->status;
		if($lot_web_status=='R'){
			$data=array('status'=>'A');
			$this->m_wsbangun->updateData('pm_lot_web', $data, $where);
			
		}
		$msg='update succes!';
		echo $msg;
	}
	public function zoom_event(){
		 $table = 'rl_spec';
		$dtSpec = $this->m_wsbangun->getData($table);
		if(!empty($dtSpec)) {
			$dfMedia = $dtSpec[0]->media_cd;
		} else {
			$dfMedia = 'NA';
		}
        $table = 'cf_media';
        $dtMedia = $this->m_wsbangun->getData($table);
        $comboEvent[] = '<option></option>';
        if(!empty($dtMedia)) {

        	foreach ($dtMedia as $value) {
        		if($dfMedia === $value->media_cd) {
        			$pilih = ' selected = "selected"';
        		} else {
        			$pilih = '';
        		}
        		$comboEvent[] = '<option '.$pilih.' value="'.$value->media_cd.'">'.$value->descs.'</option>';
        	}
        	$comboEvent = implode("", $comboEvent);
        }
        return $comboEvent;
	}
	public function zoom_media_from(){
		$Id = $this->input->post('Id',TRUE);
		  $tableopDis = 'cf_media';
        $data = $this->m_wsbangun->getData($tableopDis);
        // var_dump($lotopdis);
        if(!empty($data)) {
            $comboBus[] = '<option></option>';
            foreach ($data as $value) {
            	if($Id === $value->media_cd) {
            		$pilih = ' selected = "1"';
            	} else {
            		$pilih = '';
            	}
                $comboBus[] = '<option '.$pilih.' value="'.$value->media_cd.'">'.$value->descs.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        echo $comboBus;
	}
	public function zoom_discount_from(){
		$Id = $this->input->post('Id',TRUE);
		  $tableopDis = 'rl_discount';
        $data = $this->m_wsbangun->getData($tableopDis);
        // var_dump($lotopdis);
        if(!empty($data)) {
            $comboBus[] = '<option></option>';
            foreach ($data as $value) {
            	if($Id === $value->disc_cd) {
            		$pilih = ' selected = "1"';
            	} else {
            		$pilih = '';
            	}
            	// $comboBus[] = '<option data-level="'.$disc->percent1.'" value="'.$disc->disc_cd.'">'.$disc->descs.'</option>';
                $comboBus[] = '<option '.$pilih.' data-level="'.$value->percent1.'" value="'.$value->disc_cd.'">'.$value->descs.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        echo $comboBus;
	}
	public function zoom_payment_cd()
	{
		$table = 'rl_payment_plan_hd';
        $kriteria = array('payment_status'=>'A');
        $dtPayment = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
        if(!empty($dtPayment)) {
        	$comboPay[] = '<option></option>';
        	foreach ($dtPayment as $payment) {
        		$comboPay[] = '<option value="'.$payment->payment_cd.'">'.$payment->descs.'</option>';
        	}
        	$comboPay = implode("", $comboPay);
        }
        return $comboPay;
	}
	public function zoom_payment_cd_from()
	{
		$Id = $this->input->post('Id',TRUE);
		$table = 'rl_payment_plan_hd';
		$kriteria = array('payment_status'=>'A');
        $data = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
        if(!empty($data)) {
            $comboBus[] = '<option></option>';
            foreach ($data as $value) {
            	if($Id === $value->payment_cd) {
            		$pilih = ' selected = "1"';
            	} else {
            		$pilih = '';
            	}
                $comboBus[] = '<option '.$pilih.' value="'.$value->payment_cd.'">'.$value->descs.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        echo $comboBus;
	} 
	public function zoom_lot($lot)
	{
		
		// $where = array('entity_cd'=>'0001');		
		// $data_id = $this->m_rl_sales->get_table_by_id("mgr.v_pm_lot",$where);
		// return $data_id;
		$table = 'pm_lot';
        $kriteria = array('entity_cd'=>$entity,
        	'project_no'=>$project,
        	'status'=>'A');
        $dtLot = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
        $comboLot[] = '<option></option>';
        if(!empty($dtLot)) {
        	
        	foreach ($dtLot as $unit) {
        		if($lot === $unit->lot_no) {
        			$pilih = ' selected = "selected"';
        			// var_dump($lot);
        		} else {
        			$pilih = '';
        		}
        		$comboLot[] = '<option '.$pilih.' value="'.$unit->lot_no.'">'.$unit->descs.'</option>';
        	}
        	$comboLot = implode("", $comboLot);
        }
        return $comboLot;
	} // End search
		
	public function update_debtor()
	{
		$debtor_no='';
		// $this->input->POST('debtor');

		$where = array('entity_cd' => '0001', 
						'project_no' => '0101');
		$data = $this->m_rl_sales->get_table_by_id("mgr.pl_project",$where);
		if(!empty($data)){
			$debtor_no = $data[0]->debtor_no;
			// $debtor_no = substr($debtor_no,1,strlen($debtor_no) );
		}else{
			$debtor_no = 1;
		}
		$data= array('debtor_no' => $debtor_no + 1 );
		
		$this->m_rl_sales->update("mgr.pl_project",$data,$where);
	}

	public function gen(){
		$DB2 = $this->load->database('ifca', TRUE);
		$entity = $this->session->userdata('Tsentity');
       	$project = $this->session->userdata('Tsproject');
		$entity_cd =$entity;
		$project_no =$project;
		$debtor_acct	=$this->input->POST('debtor');
		$business_id	=$this->input->POST('business_id');
		$audit_user		=$this->session->userdata('Tsuname');;
		// $call_sp = "mgr.tes1 $entity_cd" ;
		
		$data = $DB2->query("mgr.xsm_insert_payment_plan '".$entity_cd."','".$project_no."','".$business_id."','".$debtor_acct."','".$audit_user."'" );
		$data= $data->result();
		
		$tes = array('tes' => 'true' );
		echo json_encode ($tes);
		// return $data;		
	}

	public function newDebtor($businessID=null,$debtor=null)
	{
		$DB2 = $this->load->database('ifca', TRUE);
		$entity = $this->session->userdata('Tsentity');
       	$project = $this->session->userdata('Tsproject');
       	$webuser = $this->session->userdata('Tsuname');
       	if(empty($businessID)||empty($debtor)) {
       		return false;
       	} else {
       		$DB2 = $this->load->database('ifca', TRUE);
       		$data = $DB2->query("mgr.xar_insert_debtor '".$entity."','".$project."','".$businessID."','".$debtor."','".$webuser."'");
       		$res = $data->result();
       		return true;
       	}
       	/*
       	PROCEDURE [mgr].[xar_insert_debtor]
		@rt_entity_cd			varchar (4),
		@rt_project_no			varchar (20),
		@rt_business_id			varchar (10),
		@rt_debtor_acct			VARCHAR (20),
		@rt_audit_user			varchar (20)
		*/
	}

	public function discount_cd($payment_cd=null)
	{
		$disc_cd='';
		$where = array('payment_status' => 'A', 
						'payment_cd'=>$payment_cd);
		// $data = $this->db->query("SELECT max(mgr.rl_payment_plan_hd.discount_cd) FROM  mgr.rl_payment_plan_hd  WHERE mgr.rl_payment_plan_hd.payment_status='A' and mgr.rl_payment_plan_hd.payment_cd = '".$payment_cd."' ");
		$data = $this->m_rl_sales->get_table_by_id("mgr.rl_payment_plan_hd",$where);
		// $data=$data->result();
		// format keluaran di dalam array
		if(!empty($data)){
			$disc_cd = $data[0]->discount_cd;
			// $debtor_no = substr($debtor_no,1,strlen($debtor_no) );
		}else{
			$debtor_no = '';
		}
		
		 return $disc_cd;
		 

	}

	public function setData(){
		$DB2 = $this->load->database('ifca', TRUE);

		$entity = $this->session->userdata('Tsentity');
		$project = $this->session->userdata('Tsproject');
		$lot_no 		=	$this->input->POST('lot_no');
		$payment_cd 	= 	$this->input->POST('payment');

		$data = $DB2->query("SELECT DISTINCT trx_amt from mgr.pm_lot_price where entity_cd='".$entity."' and lot_no = '".$lot_no."' and payment_cd = '".$payment_cd."'");
		
		$data= $data->result();
		// var_dump($entity);
		// var_dump($project);
		// var_dump($lot_no);
		// var_dump($payment_cd);
		// var_dump($data);
		echo json_encode($data);
		// echo json_encode($arr);

	}

	public function delete_gagal_rl_sales(){

		$business_id= $this->input->POST('business_id');
		$debtor_acct=$this->input->POST('debtor_acct');
		$entity_cd='0001';
		$project_no='0101';
		$where=array('business_id'=>$business_id,
					  'debtor_acct'=>$debtor_acct,
					  'entity_cd'=>$entity_cd,
					  'project_no'=>$project_no);

		$data = $this->m_rl_sales->delete("mgr.rl_sales",$where);
	}
	public function sp_sales($entity='',$project='',$lot_no='',$debtor_acct='',$webuser=''){
		$serverName = 'IFCASERVER\\SQL2014';
		$connectionInfo = array( "Database"=>"Demo_arie", "UID"=>"mgr", "PWD"=>"mgr");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);
		if( $conn === false ) {
     		die( print_r( sqlsrv_errors(), true));
		}

		$result='';
		$sql = "mgr.xrl_sales_reg_web '".$entity."', '".$project."', '".$lot_no."', '".$debtor_acct."', '".$webuser."' ";
		$sql_query = sqlsrv_query($conn,$sql);
		// var_dump($sql_query);
		$errors = sqlsrv_errors();
		var_dump($errors);
		if($sql_query === false){
			
			if( ($errors = sqlsrv_errors() ) != null) {
			        // foreach( $errors as $error ) {
			        //     echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
			        //     echo "code: ".$error[ 'code']."<br />";
			        //     echo "message: ".$error[ 'message']."<br />";
			        // }
				$result = $errors;
			  }
		}

		return $result;
	}
	public function when_sp_error($entity_cd='',$project_no='',$lot_no='',$debtor_acct=''){
		$where=array('entity_cd'=>$entity_cd,
					'project_no'=>$project_no,
					'debtor_acct'=>$debtor_acct,
					'lot_no'=>$lot_no);
		$this->m_wsbangun->deletedata('rl_sales',$where);

		$where2=array('entity_cd'=>$entity_cd,
					'project_no'=>$project_no,
					'lot_no'=>$lot_no);
		$data =array('status'=>'R');
		$this->m_wsbangun->updateData('pm_lot',$data,$where2);
		$this->m_wsbangun->updateData('pm_lot_web',$data,$where2);


	}
	public function isi_data_rl_sales()
	{
		// var_dump($_POST);
		if(!empty($_POST)){
			$entity = $this->session->userdata('Tsentity');
       	 	$project = $this->session->userdata('Tsproject');
       	 	$webuser = $this->session->userdata('Tsuname');
			$entity_cd 		=$entity;
			$project_no		=$project;
			$lot_no			=$this->input->POST('unit');
			// $rowID			=$this->input->POST('rowID');
				
			$payment_cd		=$this->input->POST('payment');
			$debtor		    =$this->input->POST('txt_debtor',TRUE);
			
			$list_bf_price	=str_replace(",","",$this->input->POST('list_price'));
			$discount		=str_replace(",","",$this->input->POST('discount'));
			$net_price		=str_replace(",","",$this->input->POST('net_price'));
			$tax_cd			=$this->input->POST('tax_cd');
			$list_amt		=str_replace(",","",$this->input->POST('tax_listamt'));
			$contract_price	=str_replace(",","",$this->input->POST('sales_price'));

			// $debtor_acct	=$this->input->POST('debtor');
			
			
			$Special_disc_cd	=$this->input->POST('Special_disc_cd');
			$Special_disc_amt	=str_replace(",","",$this->input->POST('Special_disc_amt'));
			// var_dump($Special_disc_amt);
			$business_id	=$this->input->POST('business_id');
			$media_cd 		=$this->input->POST('mediacd');
			/*$disc 			=$this->input->POST('disc');*/
			$disct_cd 		= $this->discount_cd($payment_cd);
			// $aditional_disc = str_replace(",","",$this->input->POST('aditional_disc'));

			// var_dump($discount);
			// if($aditional_disc==''){
			// 	$aditional_disc=0;
			// }
			$status = 'B';
			$table = 'cf_business';
			$crit = array('business_id'=>$business_id);
			$dtBuss = $this->m_wsbangun->getData_by_criteria($table, $crit);
			if(!empty($dtBuss)) {
				$category = $dtBuss[0]->category;
			} else {
				$category = 'C';
			}
			$table = 'pl_project';
			$crit = array('entity_cd'=>$entity,
				'project_no'=>$project);
			$dtProject = $this->m_wsbangun->getData_by_criteria($table, $crit);
			if(!empty($dtProject)) {
				$debtorType = $dtProject[0]->debtor_type;
			} else {
				$debtorType = null;
				$error = 'debtor_type not set';
				$this->index($lot_no, $error);
				return;
			}
			$table = 'cf_agent_dt';
			$crit = array('userid'=>$webuser,
				'entity_cd'=>$entity);
			$dtAgent = $this->m_wsbangun->getData_by_criteria($table, $crit);
			if(!empty($dtAgent)) {
				$agent_cd = $dtAgent[0]->agent_cd;
			} else {
				$agent_cd = null;
				$error = 'Agent not registered';
				$this->index($lot_no, $error);
				return;
			}

			// $table = 'rl_spec';
			// $dtSpec = $this->m_wsbangun->getData($table);
			// if(!empty($dtSpec)) {
			// 	// $media = $dtSpec[0]->media_cd;
			// 	$sales_spv = $dtSpec[0]->sales_spv;
			// } else {
			// 	// $media = 'NA';
			// 	$sales_spv = null;
			// }
			$table = 'rl_spec';
	       	$submitapp='';
			$dtSpec = $this->m_wsbangun->getData($table);
			if(!empty($dtSpec)){
				$submitapp = $dtSpec[0]->submit_app;	
			}

			// var_dump($aditional_disc); 

			if($submitapp=='N' && $Special_disc_amt==0 ) {
				$status = 'B';
			}else{
				$status = 'E';
			}

			// var_dump($status); exit;

			$status_update='';
			if(empty($debtor) || $debtor==''){
				$debtor_acct = $this->create_debtor($lot_no,'in');	
			}else{
				
				$debtor_acct = $debtor;
				$status_update='update';
			}
			
			$sql="select Count(*) as Counter from mgr.rl_sales where entity_cd ='".$entity."' AND project_no='".$project."'";
			$sql.=" and lot_no ='".$lot_no."' AND debtor_acct='".$debtor_acct."'" ;
			$data = $this->m_wsbangun->getData_by_query($sql);
			$cnt = $data[0]->Counter;
			if($cnt != 0){
				$status_update='update';

			}
			
			// if
			$data= array(
					"entity_cd"=>$entity_cd,
					"project_no"=>$project_no,
					"lot_no"=>$lot_no,
					"debtor_acct"=>$debtor_acct,
					"business_id"=>$business_id,
					"category"=>$category,
					"media_cd"=>$media_cd,
					"contract_no"=>'-',
					"staff_in_charge"=>$agent_cd,
					"sales_date"=>date("d M Y"),
					"list_tax_scheme"=>$tax_cd,
					"list_tax_amt"=>(float)$list_amt,
					"list_after_tax_amt"=>(float)$list_amt,
					"list_after_amt"=>($contract_price-$list_amt),
					"list_before_price"=>(float)$list_bf_price,
					"list_price"=>(float)$list_bf_price,
					"disc_cd"=>$disct_cd,
					"disc_amt"=>(float)$discount,
					"sell_price"=>(float)$contract_price,
					"currency_cd"=>"IDR",
					"currency_rate"=>1,
					"status"=>$status,
					"audit_user"=>$webuser,
					"audit_date"=>date("d M Y h:i:s"),
					"payment_cd"=>$payment_cd,
					"sales_type"=>"NA"/*$disc*/,
					// "sales_spv"=>"otnay",
					"debtor_type"=>$debtorType,
					"entitas_cd"=>"L",
					// "disc_status"=>"N",
					// "discount_special_amt"=>(float)$aditional_disc,
					"lot_rowid"=>0,
					"disc_cd_spe"=>$Special_disc_cd,
					"discount_special_amt"=>(float)$Special_disc_amt
					);
			// var_dump($data);
			if($status_update=='update'){
				$where=array('entity_cd'=>$entity,
						'project_no'=>$project,
						'debtor_acct'=>$debtor_acct);
				$table = 'rl_sales';
				$this->m_wsbangun->updateData($table,$data,$where);
				$msg = "Data has been Updated successfully";

			}else{
				$table = 'rl_sales';
				$this->m_wsbangun->insertData($table,$data);
				$msg = "Data has been saved successfully";
			}
			
			if ($data) {
				$this->session->set_userdata('debtr',$debtor_acct);
			 	$this->session->set_userdata('lotno',$lot_no);
			 	$this->session->set_userdata('Saudit_user',$webuser);
			 	$this->session->set_userdata('Sbusiness',$business_id);
			 	// redirect('booking/submitSales');
			 	// redirect('dirForm');
			}
			// $msg='ok';
			$DB2 = $this->load->database('ifca',TRUE);
	       	$today = date('d M Y');
	    	$sql = "mgr.xrl_sales_reg_web '".$entity."', '".$project."', '".$lot_no."', '".$debtor_acct."', '".$webuser."' ";
	       	$result = $DB2->query($sql);
	       		       	
	       	// $result = $this->sp_sales($entity,$project,$lot_no,$debtor_acct,$webuser);
	       	$where = array('entity_cd'=>$entity,
	       					'project_no'=>$project_no,
	       					'debtor_acct'=>$debtor_acct);
	       	$cnt = $this->m_wsbangun->getCount_by_criteria('rl_sales_payment',$where);
	       	if($cnt==0){
				$msg='Error SQl Stored Procedure';
				$status='Error';
				$debtor_acct='';
				$this->when_sp_error($entity_cd,$project_no,$lot_no,$debtor_acct);
				return;
	       	}
	       	
			// var_dump($aditional_disc);
			if($submitapp=='N' && $Special_disc_amt==0){		
				// $DB3 = $this->load->database('ifca',TRUE);		
				$sql2 = "mgr.xrl_billing_chrg '".$entity."', '".$project."', '".$debtor_acct."'";
				$result = $this->m_wsbangun->setData_by_query($sql2);
	       		// $result = $DB2->query($sql2);
	       		// $result = $this->db->query($sql2);
	       		// $this->db->close();
	       		// $this->run_sp($entity,$project,$debtor_acct);
		// $serverName = "IFCASERVER\\SQL2014";
		// $connectionInfo = array( "Database"=>"demo_arie", "UID"=>"mgr", "PWD"=>"mgr");
		// $conn = sqlsrv_connect( $serverName, $connectionInfo);
		// if( $conn === false) {
		//     die( print_r( sqlsrv_errors(), true));
		// }
		// // var_dump($conn);


		// $procedure_params =array(&$entity,&$project,&$debtor_acct);

		// $sql = "EXEC mgr.xrl_billing_chrg @rt_entity_cd = ?, @rt_project = ?, @rt_debtor_acct=? ";
		// $stmt = sqlsrv_prepare($conn, $sql, $procedure_params);
		// sqlsrv_execute($stmt);

			}else{
				$status='Submit';
				$msg.= ", Please do Submit";
			}
		
			$msg1=array("Pesan"=>$msg,
						"Status"=>$status,
						"debtor"=>$debtor_acct);
			echo json_encode($msg1);
			// $this->load_content('booking/v_rl_salesSubmit');	
		}
	}
	public function run_sp($entity_cd='',$project_no='',$debtor=''){
		$serverName = "IFCASERVER\\SQL2014";
		$connectionInfo = array( "Database"=>"demo_arie", "UID"=>"mgr", "PWD"=>"mgr");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);


		$procedure_params =array(&$entity_cd,&$project_no,&$debtor);

		$sql = "EXEC mgr.xrl_billing_chrg @rt_entity_cd = ?, @rt_project = ?, @rt_debtor_acct=? ";
		$stmt = sqlsrv_prepare($conn, $sql, $procedure_params);
	}
	public function isi_data_rl_sales_backup()
	{
		// var_dump($_POST);
		if(!empty($_POST)){
			$entity = $this->session->userdata('Tsentity');
       	 	$project = $this->session->userdata('Tsproject');
       	 	$webuser = $this->session->userdata('Tsuname');
			$entity_cd 		=$entity;
			$project_no		=$project;
			$lot_no			=$this->input->POST('unit');	
			$payment_cd		=$this->input->POST('payment');
			$list_bf_price	=str_replace(",","",$this->input->POST('list_price'));
			$discount		=str_replace(",","",$this->input->POST('discount'));
			$net_price		=str_replace(",","",$this->input->POST('net_price'));
			$tax_cd			=$this->input->POST('tax_cd');
			$list_amt		=str_replace(",","",$this->input->POST('tax_listamt'));
			$contract_price	=str_replace(",","",$this->input->POST('sales_price'));

			// $debtor_acct	=$this->input->POST('debtor');
			$debtor_acct = $this->create_debtor($lot_no,'in');

			$business_id	=$this->input->POST('business_id');
			$media_cd 		=$this->input->POST('mediacd');
			/*$disc 			=$this->input->POST('disc');*/
			$disct_cd 		= $this->discount_cd($payment_cd);
			$aditional_disc = str_replace(",","",$this->input->POST('aditional_disc'));

			// var_dump($discount);
			if($aditional_disc==''){
				$aditional_disc=0;
			}
			$status = 'B';
			$table = 'cf_business';
			$crit = array('business_id'=>$business_id);
			$dtBuss = $this->m_wsbangun->getData_by_criteria($table, $crit);
			if(!empty($dtBuss)) {
				$category = $dtBuss[0]->category;
			} else {
				$category = 'C';
			}
			$table = 'pl_project';
			$crit = array('entity_cd'=>$entity,
				'project_no'=>$project);
			$dtProject = $this->m_wsbangun->getData_by_criteria($table, $crit);
			if(!empty($dtProject)) {
				$debtorType = $dtProject[0]->debtor_type;
			} else {
				$debtorType = null;
				$error = 'debtor_type not set';
				$this->index($lot_no, $error);
				return;
			}
			$table = 'cf_agent_dt';
			$crit = array('userid'=>$webuser,
				'entity_cd'=>$entity);
			$dtAgent = $this->m_wsbangun->getData_by_criteria($table, $crit);
			if(!empty($dtAgent)) {
				$agent_cd = $dtAgent[0]->agent_cd;
			} else {
				$agent_cd = null;
				$error = 'Agent not registered';
				$this->index($lot_no, $error);
				return;
			}
			$table = 'rl_spec';
			$dtSpec = $this->m_wsbangun->getData($table);
			if(!empty($dtSpec)) {
				// $media = $dtSpec[0]->media_cd;
				$sales_spv = $dtSpec[0]->sales_spv;
			} else {
				// $media = 'NA';
				$sales_spv = null;
			}

			if($aditional_disc>0) {
				$status = 'E';
			}

			$data= array(
					"entity_cd"=>$entity_cd,
					"project_no"=>$project_no,
					"lot_no"=>$lot_no,
					"debtor_acct"=>$debtor_acct,
					"business_id"=>$business_id,
					"category"=>$category,
					"media_cd"=>$media_cd,
					"contract_no"=>'-',
					"staff_in_charge"=>$agent_cd,
					"sales_date"=>date("d M Y"),
					"list_tax_scheme"=>$tax_cd,
					"list_tax_amt"=>$list_amt,
					"list_before_price"=>$list_bf_price,
					"list_price"=>$list_bf_price,
					"disc_cd"=>$disct_cd,
					"disc_amt"=>$discount,
					"sell_price"=>$contract_price,
					"currency_cd"=>"IDR",
					"currency_rate"=>1,
					"status"=>$status,
					"audit_user"=>$webuser,
					"audit_date"=>date("d M Y h:i:s"),
					"payment_cd"=>$payment_cd,
					"sales_type"=>"NA"/*$disc*/,
					// "sales_spv"=>"otnay",
					"debtor_type"=>$debtorType,
					"entitas_cd"=>"L",
					// "disc_status"=>"N",
					"discount_special_amt"=>$aditional_disc
					);

			$table = 'rl_sales';
			$this->m_wsbangun->insertData($table,$data);
			if ($data) {
				$this->session->set_userdata('debtr',$debtor_acct);
			 	$this->session->set_userdata('lotno',$lot_no);
			 	$this->session->set_userdata('Saudit_user',$webuser);
			 	$this->session->set_userdata('Sbusiness',$business_id);
			 	// redirect('booking/submitSales');
			 	// redirect('dirForm');
			}

			$DB2 = $this->load->database('ifca',TRUE);
	       	$today = date('d M Y');
	       	$sql = "mgr.x_gen_spnumber '".$entity."', '".$project."', '".$lot_no."', '".$business_id."', '".$webuser."', '".$today."'";
	       	$result = $DB2->query($sql);

			/* update pm_lot */
			$table = 'pm_lot';
			$crit = array('entity_cd' => $entity_cd,
            	'project_no'=>$project_no,
            	'lot_no'=>$lot_no);
            $sData = array('status'=>'B');
            $this->m_wsbangun->updateData($table, $sData, $crit);

            /* insert debtor */
            $createDebtor = $this->newDebtor($business_id, $debtor_acct);
            if(!$createDebtor) {
            	$error = 'create debtor failed';
				$this->index($lot_no, $error);
				return;
            }

			$table = 'security_users';
			$kriteria = array('name'=>'mgr');
			$dtSec = $this->m_wsbangun->getData_by_criteria($table ,$kriteria);
			$hptenant = $dtSec[0]->phone_cellular;
			// if(!empty($hptenant))
			// {
			// 	$isiSms = array(
   //                  "DestinationNumber"=>'085376662376',//$hptenant
   //                  "TextDecoded"=>'New booking entry have been created for Lot No : '.$lot_no.' by : '.$webuser.', Sales Price : '.number_format($net_price,2),
   //                  "CreatorID"=>'TWP'
   //                  );
   //          	$this->m_sms->sendSms($isiSms);	
			// }
			            
            if($status=='B') {
            	$tes = array('tes' => 'true' );	
            } else {
            	$tes = array('tes' => 'false' );
            }
			
			// echo json_encode($tes);
			$floorplan = $this->session->userdata("TmpLot");
			if (!empty($floorplan)) {
				redirect('optionFloor');
			}
			// var_dump(expression);

			// if ($hptenant) {
			// 	$this->session->set_userdata('debtr',$debtor_acct);
			//  	$this->session->set_userdata('lotno',$lot_no);
			//  	$this->session->set_userdata('Saudit_user',$webuser);
			//  	$this->session->set_userdata('Sbusiness',$business_id);
			//  	// redirect('booking/submitSales');
			//  	// redirect('dirForm');
			// }
			// if ($dtSpec[0]->submit_app =='N') {
			// 	if ($aditional_disc>0) {
			// 	$this->load_content('booking/v_rl_salesSubmit');
			// 	}else{
			// 		$this->load_content('booking/v_rl_sales_list');
			// 	}
			// }else{
			// 	$this->load_content('booking/v_rl_sales_list');
			// }

			// if ($aditional_disc>0) {
			// 	echo json_encode($tes);
			// 	$this->load_content('booking/v_rl_salesSubmit');
			// }else{
			// 	$this->load_content('booking/v_rl_sales_list');
			// }

			echo json_encode($tes);
			// $this->load_content('booking/v_rl_salesSubmit');	
		}
	}

	// public function dirForm()
	// {
	// 	$this->load_content('booking/v_rl_salesSubmit');
	// }

	public function saveUpdate()
	{
		if ($_POST) 
		{
			$entity 		= $this->session->userdata('Tsentity');
       	 	$project 		= $this->session->userdata('Tsproject');
       	 	$webuser 		= $this->session->userdata('Tsuname');
			$entity_cd 		= $entity;
			$project_no		= $project;

			$ref_no			= $this->input->POST('ref_no');
			$lot_no			= $this->input->POST('lotno');	

			// + hidden in form
			$business_id 	= $this->input->POST('business_id');
			$media_cd 		= $this->input->POST('mediacd');
			$payment_cd 	= $this->input->POST('payment');
			$disc_cd 		= $this->input->POST('disc');
			$tax_cd 		= $this->input->POST('txt_tax_cd');
			$list_amt		=str_replace(",","",$this->input->POST('txt_listamt'));

			$list_bf_price	=str_replace(",","",$this->input->POST('txt_list_bf_price'));
			$discount		=str_replace(",","",$this->input->POST('txt_discount'));
			$aditional_disc =str_replace(",","",$this->input->POST('txt_aditional_disc'));
			$net_price		=str_replace(",","",$this->input->POST('txt_netprice2'));
			$debtor_acct	=$this->input->POST('debtor');

			$table3 = 'rl_sales';
			$kriteria3 = array( 'entity_cd' => $entity,
								'project_no' => $project,
								'lot_no' => $lot_no,
								'business_id' => $business_id);
			$lotdata = $this->m_wsbangun->getData_by_criteria($table3,$kriteria3);
			$cekStatus = $lotdata[0]->status;


			$table = 'cf_agent_dt';
			$crit2 = array('userid'=>$webuser,
							'entity_cd'=>$entity);
			$dtAgent = $this->m_wsbangun->getData_by_criteria($table, $crit2);
			if(!empty($dtAgent)) {
				$agent_cd = $dtAgent[0]->agent_cd;
			} else {
				$agent_cd = null;
				$error = 'Agent not registered';
				$this->index($lot_no, $error);
				return;
			}

			$data = array(
					"media_cd"=>$media_cd,
					"staff_in_charge"=>$agent_cd,
					"list_tax_scheme"=>$tax_cd,
					"list_tax_amt"=>$list_amt,
					"list_before_price"=>$list_bf_price,
					"disc_cd"=>$disc_cd,
					"disc_amt"=>$discount,
					"sell_price"=>$net_price,
					"audit_user"=>$webuser,
					"audit_date"=>date("d M Y h:i:s"),
					"payment_cd"=>$payment_cd,
					"discount_special_amt"=>$aditional_disc);

			// var_dump($data);

			if ($data) 
			{
				$table2 = 'rl_sales';
				$whereEdit = array('entity_cd' => $entity,
            					'project_no'=>$project,
            					'lot_no'=>$lot_no);
				$this->m_wsbangun->updateData($table2,$data,$whereEdit);
				redirect(base_url().'c_rl_sales_list/index');
			}
		}
	}
}