<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_payroll extends Core_Controller {

	function __construct(){
        parent::__construct();
        $this->auth_check();
    }

	public function index(){
		$this->load_content_top_menu('payroll/index');
	}

	public function attandance(){
		$this->load_content_top_menu('payroll/attandance');
	}

	public function event(){
		$this->load_content_top_menu('payroll/event');
	}

	public function report(){
		$this->load_content_top_menu('payroll/report');
	}
}