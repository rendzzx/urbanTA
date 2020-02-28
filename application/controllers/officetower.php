<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Officetower extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
    }

    public function index()
    {
        
        
        $this->load_content_top_menu('officetower/index');

    }
    
   
}
