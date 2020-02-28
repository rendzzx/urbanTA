<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_tes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // $this->auth_check();
        // $this->load->model('m_wsbangun');
    }

    public function index(){
    	var_dump($this->session->userdata('is_Staff_logged'));
    	var_dump($this->session->userdata('Tsentity2'));
    	exit();
    	 $this->load_content('dash/index', $ContentAllData, true);
    }
}