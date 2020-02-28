<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('demo/demo');
	}
	public function contact() {
		$sitekey = '';$secret='';
		if($_SERVER['SERVER_ADDR']=="192.168.0.225") { //deska
			$sitekey = '6LcgjSMUAAAAACkagfUurv3syFW_perf5mvTRrR6';
			$secret='6LcgjSMUAAAAAPcMJrMfp5cIufUATxT_JxG73SKs';
		}
		if($_SERVER['SERVER_ADDR']=="192.168.0.26") { //bang nay
			$sitekey = '6LfwjCMUAAAAAK7-h0eYl2HOn50BRbn-LkwRx8sD';
			$secret='6LfwjCMUAAAAAAwdQ0HzvDZCt01IsLprx8c6hNW8';
		}
		if($_SERVER['SERVER_ADDR']=="192.168.0.25") { //bang pau
			$sitekey = '6LcmjyMUAAAAANv4WkbFV6zDY4HBC0SSWcG83w1d';
			$secret='6LcmjyMUAAAAAP81CHPYwQNijZevZ6Oz1D8vbrkY';
		}
		if($_SERVER['SERVER_ADDR']=="192.168.0.88") { //hany
			$sitekey = '6LcljSMUAAAAAEBtFSLr4pH-tKTZNBAGQD1rIADH';
			$secret='6LcljSMUAAAAAAOC81sTgbD_ypYqye7nrLcoGukz';
		}
		if($_SERVER['SERVER_ADDR']=="112.78.150.230") { //demo
			$sitekey = '6LehjCMUAAAAALfGHI0hbcuvuDj0bcvjH5Fhf4mt';
			$secret='6LehjCMUAAAAAAHuX11cxJWbhOIgUxlWEedhHrHE';
		}

		$data  = array('sitekey' => $sitekey,
						'secret'=>$secret );
		$this->load->view('demo/contact',$data);
	}
	public function recaptcha($str='')
	{
	    $google_url="https://www.google.com/recaptcha/api/siteverify";
	    $secret='6LcgjSMUAAAAAPcMJrMfp5cIufUATxT_JxG73SKs';
	    $ip=$_SERVER['REMOTE_ADDR'];
	    $url=$google_url."?secret=".$secret."&response=".$str."&remoteip=".$ip;
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
	    $res = curl_exec($curl);
	    curl_close($curl);
	    $res= json_decode($res, true);
	    //reCaptcha success check
	    if($res['success'])
	    {
	      return TRUE;
	    }
	    else
	    {
	      $this->form_validation->set_message('recaptcha', 'The reCAPTCHA field is telling me that you are a robot. Shall we give it another try?');
	      return FALSE;
	    }
	}
	 public function save_message(){
        	$this->load->model('m_wsbangun');
            $msg="";
            if ($_POST) 
            {

                $first_name = $this->input->post('first',TRUE);
                $hp =$this->input->post('hp',TRUE);
                $email = $this->input->post('email',TRUE);                
                $message = $this->input->post('message',TRUE);
    			$today = date('d M Y H:i:s');
                

                
                        $data = array(          
                        'name'=>$first_name,
                        'handphone'=>$hp,
                        'email'=>$email,
                        'message'=>$message,
                        'audit_date'=>$today
                        );
                    $psn='';

                        $insert = $this->m_wsbangun->insertData('contact_us',$data);
                        if ($insert == 'OK')
                        {
                            $msg="Message sent.";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }


            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                "status"=>$psn);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
}

?>