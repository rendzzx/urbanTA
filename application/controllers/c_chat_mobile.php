<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Chat_Mobile extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $this->load->view('chat/chat_form');
    }

    public function chat($email='',$name='',$ticket='')
    {
        $content = array(
            'email' => $email, 
            'name' => $name,
            'ticket' =>$ticket
        );
        $this->load->view('chat/chat_mobile',$content);
    }

}