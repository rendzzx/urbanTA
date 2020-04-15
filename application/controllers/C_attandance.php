<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_attandance extends Core_Controller {

	function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    //ATTEND
		public function index(){
			$this->load_content_top_menu('attandance/index');
		}

		public function getTableAttend(){
	        $project = $this->session->userdata('Tsproject');        

	        $sSearch = $this->input->post("sSearch",true);
	        if(empty($sSearch)){
	            $sSearch='';
	        }

	        $entity = $this->session->userdata('Tsentity');
	        $this->load->library('Datatables');
	        $DB2 = $this->load->database('IFCA', TRUE);
	        $table = 'v_attend_trx';

	        $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table);
	        if ($res) {
	            $callback = $res;
	        }
	        echo json_encode($callback);
	    }
	// ATTEND

	public function event(){
		$this->load_content_top_menu('attandance/event');
	}

	public function report(){
		$this->load_content_top_menu('attandance/report');
	}

}