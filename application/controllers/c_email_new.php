<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_email_new extends Core_Controller {
	
	public function __construct(){ 
		parent::__construct();
        header('Content-Transfer-Encoding: base64');
		$this->auth_check();
		$this->load->model('m_wsbangun');
	}

	public function index(){
        $project = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsname');
        $email = $this->session->userdata('Tsemail');
        $table = "sysEmailTemplate";
        $data = $this->m_wsbangun->getDataadm($table);
        $data = array(
            'project' => $project,
            'name' => $name,
            'email' => $email
         );
		$this->load_content_top_menu('email_new/index',$data);
	}

    public function editemail($id=0){

        $data = array(
            'id'=> $id
         );

        if ($id==1) {
            $this->load_content_top_menu('EmailTemplate/edit',$data);
        }
        if ($id==2) {
            $this->load_content_top_menu('EmailTemplate/edit2',$data);
        }
        if ($id==3) {
            $this->load_content_top_menu('EmailTemplate/edit3',$data);
        }

    }

    public function getByID($id){

        $table = "sysBodyEmail";
        $where = array(
            'Email_Id' => $id
        );
        $data = $this->m_wsbangun->getData_by_criteria_adm($table,$where);

        echo json_encode($data);
    }

    public function opentag(){
        $project = $this->session->userdata('Tsprojectname');
        $data = array(
            'project' => $project,
             );
        $this->load->view('email_new/tag',$data);
    }

    public function tag(){
        $callback = array(
            'Data' => null,
            'Error' => true,
            'Pesan' => '',
            'Status'=> 200
        );

        // // var_dump($_POST);exit();
        // $id         = $this->input->post('id',TRUE);
        // $subject    = $this->input->post('subject',TRUE);
        // $email      = $this->input->post('email',TRUE);
        // $cc         = $this->input->post('cc',TRUE);
        // $code       = $this->input->post('code',TRUE);
        // $footer     = $this->input->post('footer',TRUE);

        // $email = "reza.julian@ifca.co.id,delia.elvina@ifca.co.id";
        // $subj = $subject;
        $table = "sysEmailTemplate";
        $data = array(
            'code'      => '',
            'footer'    => ''
        );

        $body = $this->load_content_top_menu('email_new/index',$data);

    }

}