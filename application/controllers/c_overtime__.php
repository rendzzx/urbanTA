<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Overtime extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

    public function index(){
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        // $email = $this->session->userdata('Tsemail');
        $group = $this->session->userdata('Tsusergroup');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        $Business_id = $this->session->userdata('Tsbusinessid');
       

        $content = array(
            'ProjectDescs'=>$projectName);
        
        $this->load_content_top_menu('overtime/index',$content);
    }
}