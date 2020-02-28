<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_Business extends core_Model {
	
	// protected $table_name;

	public function __construct()
	{
		parent::__construct();
		$this->table_name = "mgr.cf_business";
		$this->next_number = "mgr.Next_Number";
		$this->class_cd = "mgr.cf_business_class";
		$this->religion_cd = "mgr.cf_religion";
		$this->nationality_cd = "mgr.cf_nationality";
	}
	public function get_autonumber(){
		$cons = $this->session->userdata('Tscons');
		$DB2 = $this->load->database($cons, TRUE);

		$query = $DB2->query("select COUNTER from mgr.Next_Number where Name = 'business_id'");
		return $query->result();
	}

	function zomm_class(){
			
			$cons = $this->session->userdata('Tscons');
			$DB2 = $this->load->database($cons, TRUE);   

        	$query = $DB2->query('SELECT class_cd FROM mgr.cf_business_class');
        	return $query->result(); 
    }

     function zomm_religion(){
     	$DB2 = $this->load->database('ifca', TRUE);   

     	$query = $DB2->query('SELECT religion_cd,descs FROM mgr.cf_religion');
        return $query->result(); 
     }
	 function zomm_nationality()
        {   
        	$DB2 = $this->load->database('ifca', TRUE);

        	$query = $DB2->query('SELECT nationality_cd,descs FROM mgr.cf_nationality');
        	return $query->result(); 
        }     


      function insert($data=null)
			    {
			        $DB2 = $this->load->database('ifca', TRUE);

			        $DB2->insert($this->table_name, $data); 
			    }   

	  function update($data=null, $where=null)
			    {
			    	$cons = $this->session->userdata('Tscons');
			        $DB2 = $this->load->database($cons, TRUE);

			        $DB2->where($where);
			        $DB2->update($this->next_number, $data);
			    }
}


?>
