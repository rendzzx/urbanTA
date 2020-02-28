<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_rl_sales_list extends CI_Model {
	
	// public function __construct(){
	// 	parent::__construct();
	// }

	public $sql = 'select distinct
					mgr.cf_business.business_id as business_id,
					mgr.cf_business.name as name,
					mgr.pm_lot.lot_no as lot_no,
					mgr.pm_lot.descs as descs,
					mgr.rl_sales.sales_date as sales_date,
					mgr.rl_sales.sell_price as sell_price,
					mgr.rl_sales.status as status,
					mgr.rl_sales.ref_no as ref_no 
				from 
					mgr.rl_sales,
					mgr.cf_business,
					mgr.pm_lot
				where 
					mgr.rl_sales.business_id = mgr.cf_business.business_id
					and mgr.rl_sales.entity_cd = mgr.pm_lot.entity_cd
					and mgr.rl_sales.project_no = mgr.pm_lot.project_no
					and mgr.rl_sales.lot_no = mgr.pm_lot.lot_no';


	public function GetAllData(){
		$DB2 = $this->load->database('ifca', TRUE);
		$query = $DB2->query($this->sql);
		//$query = $this->db->query($this->sql);

		return $query->result();
	}

	public function DataPaging($a = 0, $b = 0){
		$DB2 = $this->load->database('ifca', TRUE);
		$sql = "SELECT mgr.cf_business.business_id  AS business_id,
		       mgr.cf_business.name AS NAME,
		       mgr.pm_lot.lot_no AS lot_no,
		       mgr.pm_lot.descs AS descs,
		       convert(varchar(11),a.sales_date,106) AS sales_date,
		       a.sell_price AS sell_price,
		       a.status AS status,
		       a.ref_no AS ref_no,
		       row
		FROM   (Select *, ROW_number() over (order by business_id ) as row from mgr.rl_sales) a,
		       mgr.cf_business,
		       mgr.pm_lot
		WHERE  a.business_id = mgr.cf_business.business_id
		       AND a.entity_cd = mgr.pm_lot.entity_cd
		       AND a.project_no = mgr.pm_lot.project_no
		       AND a.lot_no = mgr.pm_lot.lot_no
		       AND a.row > $a AND a.row <= $b
		ORDER BY a.sales_date, mgr.cf_business.name desc";

		$query = $DB2->query($sql);
		return $query->result();
	}

	public function getdata_row($criteria = null){
		$DB2 = $this->load->database('ifca', TRUE);
		if(is_null($criteria)){
			$query = $DB2->query($this->sql);
			
		}else{
			$query = $DB2->query($this->sql .'and '.$criteria);
		}
		return $query->result();
		// return $this->db->count_all_results();
	}

	public function getlot_name($LotNo){
		$DB2 = $this->load->database('ifca', TRUE);

		$query = $DB2->query("select distinct
					mgr.cf_business.name as name,mgr.rl_sales.sales_date
				from 
					mgr.rl_sales,
					mgr.cf_business,
					mgr.pm_lot
				where 
					mgr.rl_sales.business_id = mgr.cf_business.business_id
					and mgr.rl_sales.entity_cd = mgr.pm_lot.entity_cd
					and mgr.rl_sales.project_no = mgr.pm_lot.project_no
					and mgr.rl_sales.lot_no = mgr.pm_lot.lot_no
					and mgr.rl_sales.lot_no = '$LotNo'
				ORDER BY mgr.rl_sales.sales_date, mgr.cf_business.name DESC");

		return $query->result();
	}

	public function cari($params = '')
	{
		$DB2 = $this->load->database('ifca', TRUE);
		
		if(!empty($params)){
			$sql = "select distinct					
					mgr.cf_business.business_id as business_id,
					mgr.cf_business.NAME as NAME,
					mgr.pm_lot.lot_no as lot_no,
					mgr.pm_lot.descs as descs,
					convert(varchar(11),a.sales_date,106) AS sales_date,
					a.sell_price as sell_price,
					row				
				FROM   (Select *, ROW_number() over (order by business_id ) as row from mgr.rl_sales) a,
				       mgr.cf_business,
				       mgr.pm_lot
				WHERE  a.business_id = mgr.cf_business.business_id
				       AND a.entity_cd = mgr.pm_lot.entity_cd
				       AND a.project_no = mgr.pm_lot.project_no
				       AND a.lot_no = mgr.pm_lot.lot_no
				       AND mgr.cf_business.NAME like '%".$params."%'
				ORDER BY mgr.rl_sales.sales_date, mgr.cf_business.name DESC";
		$query = $DB2->query($sql);
		return $query->result();

		}else{
			$this->DataPaging();
		}		
	}
}