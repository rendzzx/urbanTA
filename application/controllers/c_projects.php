<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_projects extends Core_Controller{
	public function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        $content = array(
            'project' => $projectName
        );
        
    	$this->load_content_top_menu('project/index',$content);
    }

    public function getTable(){
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('IFCA', TRUE);
        $table = 'v_project';

        $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table);
        if ($res) {
            $callback = $res;
        }
        echo json_encode($callback);
    }
}