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

    public function forgot(){
        $this->load->view('login/forgot');
    }

    public function verify($mail=null, $err=null){
        $pwd = md5("password");
        $criteria = array('email'=>$mail, 'password'=> $pwd);
        $table = 'security_userdetails';
        $ret = $this->M_wsbangun->getData_by_criteria('IFCA', $table, $criteria);

        if($ret){
           $data = array('username'=>$mail, 'error'=>$err);
           $this->load->view('login/change',$data);
        } else {
            redirect('Auth');
        }
    }
    
    public function verify2($mail=null,$pass=null ,$err=null){
        $criteria = array('email_add'=>$mail, 'pager'=> $pass);
        $table = 'security_users';
        $ret = $this->M_wsbangun->getData_by_criteria('IFCA', $table, $criteria);
            // var_dump($ret);
            // exit();
        if($ret){
           $data = array('username'=>$mail, 'error'=>$err);
           $this->load->view('login/change',$data);
        } else {

            redirect('Auth');
        }
    }

    public function save(){
        if($_POST){
            $this->load->database();
            $DB2 = $this->load->database('IFCA', TRUE);
            $email = $this->security->xss_clean($this->input->post('username',TRUE));
            $pwd1 = $this->security->xss_clean($this->input->post('newpassword',TRUE));
            $pwd2 = $this->security->xss_clean($this->input->post('confpassword',TRUE));

            
                $paswd = strtoupper(md5(trim($this->input->post('newpassword')))); 
                $data=array('password'=>$paswd);
                

                $table = 'security_userdetails';
                $kriteria = array('email'=>$email);
                $sql = "SELECT count(*) as CNT from mgr.security_userdetails (NOLOCK) where email = '$email' ";
                $countResult = $this->M_wsbangun->getData_by_query('IFCA', $sql);
                $cnDet = $countResult[0]->CNT;
                // $tess = array($email);
                
                $sql = "SELECT * from mgr.security_users (NOLOCK) where email = '$email' ";
                $dataResult = $this->M_wsbangun->getData_by_query('IFCA', $sql);

                $userID='';
                $descsName ='';
                if(!empty($dataResult[0]->name)){
                        $userID = $dataResult[0]->name;
                        $descsName = $dataResult[0]->description;
                }
             

                $pwd = $paswd ;
                    $today = date('d M Y H:i:s');
                    $data = array('email'=>$email,
                        'password'=>$pwd,
                        'audit_user'=>'MGR',
                        'audit_date'=>$today,
                        'userID'=>$userID,
                        'name'=>$descsName
        
                        );

                if(!$cnDet > 0) {                    
                    
                    $insertSU = $this->M_wsbangun->insertData($table, $data);
                    if($insertSU == 'OK'){
                        $a="Data has been saved successfully";
                        $psn = "OK";
                    } else {
                        $a= $insert;
                        $psn = "Failed";
                    }

                }else{                    
                    $updateSU = $this->M_wsbangun->updateData($table, $data, $kriteria);
                    if($updateSU == 'OK'){
                        $a="Data has been update successfully";
                        $psn = "OK";
                    } else {
                        $a= $insert;
                        $psn = "Failed";
                    } 
                }
                
                $data = array('pager'=>'');
                $crit = array('email_add'=>$email);
                $this->M_wsbangun->updateData('security_users', $data, $crit);

                $table = 'cf_agent_dt';
                $kriteria = array('email_add'=>$email);
                $data = array('status'=>'A');
                $this->M_wsbangun->updateData($table, $data, $kriteria);
                // redirect('Auth');
            // }
        } else {
            $a = "Data is not valid";
        }
        $msg = array('pesan'=>$a,
                    'status'=>$psn);
        echo json_encode($msg);
    }

    public function ResetPassword(){ 
        if($_POST)
        {
            $m = $this->security->xss_clean($this->input->post('username',TRUE));
            $a = 'Forget Password';
            
            if(filter_var($m, FILTER_VALIDATE_EMAIL))
            {
                $table = 'security_users';
                $crit = array('email_add'=>$m);
                $sql = "SELECT * from mgr.security_users (NOLOCK) where email_add = ? ";
                $tess = array($m);
                
                $this->load->database();
                $DB2 = $this->load->database('IFCA', TRUE);
                $qq = $DB2->query($sql,$tess);
                $dtA = $qq->result();
                // var_dump($dtA);exit();

                if(!empty($dtA))
                {
                    $df = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));  
                    $dpager  =strtoupper(md5($df));                
                    $dataemail = array('pager'=>$df);
                    $data = array('pager'=>$dpager);
                    $this->M_wsbangun->updateData($table, $data, $crit);
                    $b = $this->load->view('Email/EmailForgetPass', $dataemail, true);

                    $Judul = 'Reset Password';
                    $sql ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
                    $data = $this->M_wsbangun->getData_by_query('IFCA', $sql);                    
                    $profile_mail = $data[0]->email_profile;

                    $sql2 = "mgr.x_send_mail_php '".$profile_mail."', '".$m."', '".$Judul."', '".$b."', '' ";
                    // var_dump($sql2);

                    $snd = $this->M_wsbangun->setData_by_query($sql2);
                    
                  

                        $msg = 'Please cek your email';//'Email sent';
                 


                } else {
                    $msg = 'Forgot Email failed, data not found.';
                }
                
            } else {
                $msg = 'Email not valid';
            }
        } else {
            $msg = 'method not valid';
        }
        
        echo $msg;
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

        $sql = 'select count(*) as CNT from mgr.sysMenuGroup where GroupCd=?';
        $where =array($groupCD);
        $qq = $DB2->query($sql,$where);
        $data = $qq->result();
        
        return $data[0]->CNT;
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
                $sql = "SELECT * from mgr.v_sysUser where email='$email' and status_activate ='Y'";
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
                    $this->session->set_userdata('Tsuser_id', $datas[0]->rowID);
                    $this->session->set_userdata('Tsname', $datas[0]->userID);
                    $this->session->set_userdata('Tsemail', $datas[0]->email);
                    $this->session->set_userdata('Tsuname', $datas[0]->name);
                    $this->session->set_userdata('Tsprojectname', '');
                    $this->session->unset_userdata('captchaWord');
                    $this->session->set_userdata('Tsusergroup', $datas[0]->Group_Cd);
                    $this->session->set_userdata('Tsdebtor_acct', $datas[0]->debtor_acct);
                    $this->session->set_userdata('Tsdashboard', $datas[0]->dashboard_url);
                    redirect('Dash');
                } 
                else{
                    $this->session->set_userdata('Error_Login', 'User is not valid');
                    redirect('Auth');
                }
            }
        }
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

    public function load_captcha(){
        $this->session->unset_userdata('captchaAgent');         
        $cp = $this->setCaptcha();
        $this->load->view('login/captcha',$cp);
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