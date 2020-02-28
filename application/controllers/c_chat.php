<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Chat extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $name = $this->session->userdata('Tsname');
        $email = $this->session->userdata('Tsemail');
        $userID = $this->session->userdata('Tsuser_id');

        $sql = "SELECT pict FROM mgr.sysuser where email='$email'";
        $pict = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $pict = $pict[0]->pict;

        $content = array(
            'name' => $name,
            'email' => $email,
            'userID'=>$userID,
            'pict'=>$pict
        );

        $this->load->view('chat/index',$content);
    }

}