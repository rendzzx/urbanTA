<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');

class Auth extends Core_Controller{
    function __construct(){
        parent::__construct();
    }
    
    public function index(){
        if($this->session->userdata('is_Staff_logged')==true){
            redirect('Dash');
        }
        else{
            $error_login = $this->session->userdata('Error_Login');
            if(empty($error_login)){
                $error_login ='';
            }

            $cp = $this->setCaptcha();
            $cp["error_login"] = $error_login;
            $this->session->unset_userdata('Error_Login');
            
            $this->load->view('Auth/login', $cp);
        }
    }

    public function login(){
        if($_POST){
            $email = $this->security->xss_clean($this->input->post('txtUser'));
            $paswd = $this->security->xss_clean(trim($this->input->post('txtPass')));
            $paswd = strtoupper(md5($paswd));
            $captcha = strtoupper($this->input->post('userCaptcha', TRUE));
            $this->form_validation->set_rules('txtUser', 'Email', 'required');
            $this->form_validation->set_rules('userCaptcha', 'Captcha', 'required');

            if($this->form_validation->run() == false){
                $cp = $this->setCaptcha();
                $this->load->view('Auth/login', $cp);
                return;
            } 
            else{
                $cc = strtoupper($this->session->userdata('captchaWord'));
                if($cc!=$captcha){
                    redirect('Auth');
                }
                $sql = "SELECT * from v_sysUser where email='$email' and status_activate ='Y'";
                $datas = $this->M_wsbangun->getData_by_query('IFCA', $sql);
                $EmailPassword = strtoupper(md5(strtoupper(md5($email)).'P@ssw0rd'.$paswd));
          
                if($datas){
                    if($EmailPassword != strtoupper($datas[0]->COM)){
                        $this->session->set_userdata('Error_Login', 'Wrong Password!');
                        redirect('Auth');
                    } 
                    
                    if(!$this->cekMenuGroup($datas[0]->Group_Cd)>0){
                        $this->session->set_userdata('Error_Login', "don't have Menu, Please contact your administrator! Groud cd empty");
                        redirect('Auth');
                    }
                  
                    if($datas[0]->isResetLogin==true){
                        $this->session->set_userdata('Tsemail', $datas[0]->email);
                        $this->session->set_userdata('isReset', $datas[0]->isResetLogin);
                        redirect('ResetPassword/reset');
                    }
                    $this->session->set_userdata('is_Staff_logged', true);
                    $this->session->set_userdata('Tsname', $datas[0]->userID);
                    $this->session->set_userdata('Tsemail', $datas[0]->email);
                    $this->session->set_userdata('Tsuname', $datas[0]->name);
                    $this->session->set_userdata('Tsprojectname', '');
                    $this->session->unset_userdata('captchaWord');
                    $this->session->set_userdata('Tsusergroup', $datas[0]->Group_Cd);
                    $this->session->set_userdata('Tsdebtor_acct', $datas[0]->debtor_acct);
                    $this->session->set_userdata('Tsdashboard', 'administrator/index/');
                    redirect('Dash');
                } 
                else{
                    $this->session->set_userdata('Error_Login', 'User is not valid');
                    redirect('Auth');
                }
            }
        }
    }

    public function forgot(){
        $this->load->view('login/forgot');
    }

    public function checkCapt(){
        if($_POST){
            $userCaptcha = strtoupper($this->input->post('userCaptcha', TRUE));            

            $istatus = 0;            
            $cc = strtoupper($this->session->userdata('captchaWord'));
                if($cc!=$userCaptcha){
                    $istatus = 1;
                }
            echo $istatus;
        }        
    }
   
    private function cekMenuGroup($groupCD){
        $this->load->database();
        $DB2 = $this->load->database('IFCA', TRUE);

        $sql = 'SELECT count(*) as CNT from sysMenuGroup where GroupCd=?';
        $where = array($groupCD);
        $qq = $DB2->query($sql,$where);
        $data = $qq->result();
        return $data[0]->CNT;
    }

    public function setCaptcha(){
        $rand_number = rand(1000,9999);
        $va = array(
            'img_path'=>'./app-assets/images/static/',
            'img_url'=>base_url().'app-assets/images/static/',
            'font_size'=>60,
            'font_path'=>FCPATH. 'dist/captcha4.ttf',
            'word'=>$rand_number,
            'img_width'=>200,
            'img_height'=>50,
            'expiration'=>3600
        );
        $cp = create_captcha($va);
        $this->session->set_userdata('captchaWord', $cp['word']);
        return $cp;
    }

    public function logout(){
        $this->session->unset_userdata('is_Staff_logged');
        $this->session->unset_userdata('Tsuser_id');
        $this->session->unset_userdata('Tsname');
        $this->session->unset_userdata('Tsemail');
        $this->session->unset_userdata('Tsuname');
        $this->session->unset_userdata('Tsentity');
        $this->session->unset_userdata('Tsproject');
        $this->session->unset_userdata('TmpLot');
        $this->session->unset_userdata('TmpBuss');
        $this->session->unset_userdata('Tsentity');
        $this->session->unset_userdata('Tsproject');
        $this->session->unset_userdata('Tsentityname');
        $this->session->unset_userdata('Tsusergroup');
        $this->session->unset_userdata('TMenuPs');
        $is_cloud = $this->session->userdata("FCloud");
        redirect('login');
    }
}