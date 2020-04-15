<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_event extends Core_Controller {

	function __construct(){
        parent::__construct();
        $this->auth_check();
    }

	public function index(){
		$this->load_content_top_menu('event/index');
	}

	public function all(){
		$this->load_content_top_menu('event/all');
	}

	public function comingsoon(){
		$this->load_content_top_menu('event/comingsoon');
	}

	public function history(){
		$this->load_content_top_menu('event/history');
	}

	public function cancle(){
		$this->load_content_top_menu('event/cancle');
	}

	public function report(){
		$this->load_content_top_menu('event/report');
	}
}