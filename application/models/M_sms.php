<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_sms extends Core_Model {

	public function __construct() 
	{
		parent::__construct();
		
	}	

	public function sendSms($object=null) 
	{
		$DBSMS = $this->load->database('sms', TRUE);
		$DBSMS->insert('outbox', $object);
	}

	public function readSms($where=null) 
	{
		$DBSMS = $this->load->database('sms', TRUE);
		if (!is_null($where)) 
		{
			$DBSMS->where($where);
        }
		$query = $DBSMS->get('inbox');
		return $query->result();
	}
}
