<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class c_api extends Core_Controller{
	public function __construct()
    {
        parent::__construct();
        // $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

	public function save(){
        
            $msg="";
            $st="";
            if ($_POST) 
            {
            	// $email = $this->security->xss_clean($this->input->post('username'));            
            	// $paswd = $this->security->xss_clean(trim($this->input->post('password')));
                $name = $this->security->xss_clean($this->input->post('name', true));
                $handphone = $this->security->xss_clean($this->input->post('handphone',TRUE));
                $email =$this->security->xss_clean($this->input->post('email',TRUE));
                $message = $this->security->xss_clean($this->input->post('message',TRUE));

                $audit_date = date('d M Y H:i:s');
                $ip_addr=$_SERVER['REMOTE_ADDR'];

               
                        $data = array(          
                        // 'nup_id' => $nup_id,
                        'name' => $name,
                        'handphone' => $handphone,
                        'email' =>$email,
                        'message' =>$message,                        
                        'audit_date'=>$audit_date,
                        'ip_address'=>$ip_addr
                        );
              
                        $data = $this->m_wsbangun->insertData('contact_us',$data);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been saved successfully";
                            $st = 'OK';
                        }
  
            } //tutup post
            else{
                $msg="Data validation is not valid";
                $st = "Fail";
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
}