<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class ResetPassword extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
    }
   
    public function index()
    {
        
            $error_login = $this->session->userdata('Error_Login');
            if(empty($error_login)){
                $error_login ='';
            }
            $cp["error_login"] = $error_login;
            $this->session->unset_userdata('Error_Login');
            
            $this->load->view('resetpass/index', $cp);
            // $this->load->view('resetpass/index');
    }
    public function reset()
    {
            $email = $this->session->userdata('Tsemail');
            $error_login = $this->session->userdata('Error_Login');
            if(empty($error_login)){
                $error_login ='';
            }
            $cp = $this->setCaptcha();
            $cp["error_login"] = $error_login;
            $cp["email_user"] = $email;
            $this->session->unset_userdata('Error_Login');
            
            $this->load->view('resetpass/index_new', $cp);
            // $this->load->view('resetpass/reset');
    }     
    private function setCaptcha(){
        
        $rand_number = substr(md5(uniqid(rand(), true)), 0, 4);
        $va = array('img_path'=>'./img/static/',
            'img_url'=>base_url().'img/static/',
            'font_size'=>20,
            
            'font_path'=>FCPATH. 'dist/captcha4.ttf',
            'word'=>$rand_number,
            'img_width'=>140,
            'img_height'=>34,
            'expiration'=>3600
            );
        $cp = create_captcha($va);
        $this->session->set_userdata('captchaWord', $cp['word']);
        return $cp;
    }
    public function ForgetPassword(){
     
        if($_POST){
            $Email = $this->security->xss_clean($this->input->post('txtUser',TRUE));
            // var_dump($Email);exit();
            if(empty($Email)){
                $Error = true;
                $Psn = "Email can't be blank";
            }else{
                $param =array('Email'=>$Email);
                $dataUser = $this->M_wsbangun->getCount_by_criteria_cons('ifca3','sysUser',$param);
                
                if((int)$dataUser==0){
                    
                    $psn = "Wrong Email Account";
                    $status = "Failed";
                    // $this->session->set_userdata('Error_Login', 'Wrong Email Account');
                    // redirect('ResetPassword');
                    // return;
                }else{

                    $query = "mgr.x_send_mail_reset_password '".$Email."'";
                    $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
                    $aaa = strpos($PsnMail,'queued');
                    if( $aaa <= 0 || !$aaa){
                        if($PsnMail=='OK'){
                            $status = "OK";
                            $psn = 'Please cek your email';
                        }else{
                            $msg = $PsnMail;                        
                            $Psn = 'Sent Email Failed, Please Contact your Admin!'; 
                            $status = "Failed"; 
                        }
                        
                    }else{
                        $psn = 'Please cek your email';
                        $status = "Failed";
                    }

              
                }
                
            }
        }

        $msg = array('pesan'=>$psn,
                    'status'=>$status);
        echo json_encode($msg);
    }
    public function SavePassword()
    {
        $this->load->model('M_wsbangun');
        if($_POST)
        {    
            $email = $this->security->xss_clean($this->input->post('txtUser'));            
            $paswd = $this->security->xss_clean(trim($this->input->post('newpass')));
            // $paswd = strtoupper(md5($paswd));
            $email_user = $email;
            
            
            $captcha = strtoupper($this->input->post('userCaptcha', TRUE));
            
            $this->form_validation->set_rules('txtUser', 'Email', 'required');
            $this->form_validation->set_rules('userCaptcha', 'Captcha', 'required');
            if($this->form_validation->run() == false)
            {
                $cp = $this->setCaptcha();
                $email = $this->session->userdata('Tsemail');
                $cp["email_user"] = $email;
                $this->load->view('resetpass/reset', $cp);
                return;
            } else {

                $this->load->database();
                $DB2 = $this->load->database('ifca3', TRUE);
                // $sql = 'select * from mgr.security_userdetails where email=?'; awal
                $sql = 'select * from mgr.sysUser where email=?'; //new harus dari adm
                $where =array($email);
                $qq = $DB2->query($sql,$where);
                $datas = $qq->result();
                
            
                $emails = strtoupper(md5(strtolower($email)));
                $paswd  = strtoupper(md5($paswd));
                $PS2 = $emails.'P@ssw0rd'.$paswd;
                $NewEmailPassword = strtoupper(md5($PS2));
          
                    if($datas)
                    {
                       
                        $dataupdate = array(       
                            'isResetLogin' => 0,
                            'COM'=>$NewEmailPassword,
                            'password'=>$paswd
                        );
                        $criteria = array(
                            'email'=>$email_user
                        );
                        $update = $this->M_wsbangun->updateDataadm('sysUser',$dataupdate, $criteria);
               
                        if($update !="OK"){
                            $psn="Cannot reset your password.";
                            $status = "Failed";
                        }else{
                            $psn = "Your password has been updated successfully"; 
                            $status = "OK";
                            $this->session->sess_destroy();
                        }
                            
                    } 
                 
            }
        } else {
            $psn = 'Data is not valid';
            $status = "Failed";
        }
        $msg = array('pesan'=>$psn,
                    'status'=>$status);
        echo json_encode($msg);
    }
    
   
}