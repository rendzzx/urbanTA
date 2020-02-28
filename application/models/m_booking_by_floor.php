<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Booking_By_Floor extends Core_Model 
{
	public function __construct() 
	{
		parent::__construct();
		$this->table_name = "mgr.pm_lot_web";
	}	
	
}