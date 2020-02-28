<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class UserStaff extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
        
    }
   
    public function index()
    {
        
        if($this->session->userdata('is_Staff_logged')==true)
        {
            redirect('Dash');
        }else
        {
           
            $error_login = $this->session->userdata('Error_Login');
            if(empty($error_login)){
                $error_login ='';
            }
            $cp = $this->setCaptcha();
            $cp["error_login"] = $error_login;
            $this->session->unset_userdata('Error_Login');
            
            $this->load->view('login/index', $cp);
        }
    }   

    private function isPostBack() { 
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }

    public function forgot()
    {
        $this->load->view('login/forgot');
    }

    public function verify($mail=null, $err=null)
    {
        $this->load->model('M_wsbangun');
        $pwd = md5("password");
        $criteria = array('email'=>$mail, 'password'=> $pwd);
        $table = 'security_userdetails';
        $ret = $this->M_wsbangun->getData_by_criteria($table, $criteria);

        if($ret){
           $data = array('username'=>$mail, 'error'=>$err);
           $this->load->view('login/change',$data);
        } else {
            redirect('userStaff');
        }
    }
     public function verify2($mail=null,$pass=null ,$err=null)
    {
        $this->load->model('M_wsbangun');
        
        $criteria = array('email_add'=>$mail, 'pager'=> $pass);
        $table = 'security_users';
        $ret = $this->M_wsbangun->getData_by_criteria($table, $criteria);
            // var_dump($ret);
            // exit();
        if($ret){
           $data = array('username'=>$mail, 'error'=>$err);
           $this->load->view('login/change',$data);
        } else {

            redirect('userStaff');
        }
    }

    public function save()
    {
        $this->load->model('M_wsbangun');
        if($_POST){
            $this->load->database();
            $DB2 = $this->load->database('ifca', TRUE);
            $email = $this->security->xss_clean($this->input->post('username',TRUE));
            $pwd1 = $this->security->xss_clean($this->input->post('newpassword',TRUE));
            $pwd2 = $this->security->xss_clean($this->input->post('confpassword',TRUE));

            
                $paswd = strtoupper(md5(trim($this->input->post('newpassword')))); 
                $data=array('password'=>$paswd);
                

                $table = 'security_userdetails';
                $kriteria = array('email'=>$email);
                // var_dump($kriteria);exit;
                // $cnDet = $this->M_wsbangun->getCount_by_criteria($table, $kriteria);

                // $sql = "SELECT count(*) as CNT from mgr.security_userdetails (NOLOCK) where email = ? ";
                $sql = "SELECT count(*) as CNT from mgr.security_userdetails (NOLOCK) where email = '$email' ";
                $countResult = $this->M_wsbangun->getData_by_query($sql);
                $cnDet = $countResult[0]->CNT;
                // $tess = array($email);
                
                $sql = "SELECT * from mgr.security_users (NOLOCK) where email = '$email' ";
                $dataResult = $this->M_wsbangun->getData_by_query($sql);

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
                // redirect('userStaff');
            // }
        } else {
            $a = "Data is not valid";
        }
        $msg = array('pesan'=>$a,
                    'status'=>$psn);
        echo json_encode($msg);
    }
    public function ResetPassword(){    
    $this->load->model('M_wsbangun');    
        if($_POST)
        {
            $m = $this->security->xss_clean($this->input->post('username',TRUE));
            $a = 'Forget Password';
            
            if(filter_var($m, FILTER_VALIDATE_EMAIL))
            {
                $table = 'security_users';
                $crit = array('email_add'=>$m);
                // $dtA = $this->M_wsbangun->getData_by_criteria($table, $crit);

                $sql = "SELECT * from mgr.security_users (NOLOCK) where email_add = ? ";
                $tess = array($m);
                
                $this->load->database();
                $DB2 = $this->load->database('ifca', TRUE);
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
                    $data = $this->M_wsbangun->getData_by_query($sql);                    
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
        $this->load->model('M_wsbangun');
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
        $DB2 = $this->load->database('ifca3', TRUE);

        $sql = 'select count(*) as CNT from mgr.sysMenuGroup where GroupCd=?';
        $where =array($groupCD);
        $qq = $DB2->query($sql,$where);
        $data = $qq->result();
        
        return $data[0]->CNT;
    }

    public function singupsosmed(){

        $error_login = $this->session->userdata('Error_Login');
            if(empty($error_login)){
                $error_login ='';
            }
        $cp["error_login"] = $error_login;
        $this->session->unset_userdata('Error_Login');
            
        $this->load->view('login/add', $cp);

    }

    public function sosmed(){

        $this->load->view('login/addnew');

    }

    public function SignUpGuest(){
        // $this->_Authorization();
        $callback = array(
            'Data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status' => 200
        ); 
        $id = $this->input->post('id', true);
        $name = $this->input->post('name', true);
        $email = $this->input->post('email', true);
        $notelp = $this->input->post('notelp', true);
        $sosmed = $this->input->post('sosmed', true);

        $emailstr = strtoupper(md5(strtolower($email)));
        $paswd = strtoupper(md5($id));
        $COM = strtoupper(md5($emailstr.'P@ssw0rd'.$paswd));



        if(empty($email) || empty($name) || empty($notelp) || empty($sosmed) ){
            $callback['Error'] = true;
            $callback['Pesan'] = "Data Not Valid";
        }else{
            $data = array('email'=>$email,
                         'password'=>' ',
                        'name'=>$name,
                        'Group_Cd'=>'Guest',
                        'sosmed'=>$sosmed,
                        'COM'=>$COM,
                        'LoginId'=>$id,
                        'UserId'=>$this->generateRandomString(10),
                        'Handphone'=>$notelp,
                        'isResetLogin'=>true,
                        'audit_date'=>date('d M Y H:i:s'),
                        'audit_user'=>'GuestWeb');
            $_save = $this->M_wsbangun->insertDataweb('sysUser', $data);
            if($_save != 'OK'){
                $callback['Error'] = true;
                $callback['Pesan'] = $_save;
            }else{

                $callback['Error'] = false;
                $callback['Pesan'] = "Sign Up Succes, Please wait 24haour until Account Active";   
            }
            
        }
        echo json_encode($callback);
    }

    public function LoginWithSosmed(){
        $callback = array(
            'Data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status' => 200
        ); 

        // var_dump($_POST);exit();

        $dateNow = date('d M Y H:i:s');
        $date = new Datetime($dateNow);
        // add 24 jam expired
        $date->add(new DateInterval('PT24H'));
        $ExpiredOn = $date->format('d M Y H:i:s');

        $email_user = $this->input->post('Email', true);
        // var_dump($email_user);exit();
        $fr = $this->input->post('fr', true);
        $LoginId = $this->input->post('id', true);
        // if($_POST){
        if(!empty($email_user) && !empty($fr)){
            // $email_user = $this->security->xss_clean(trim($this->input->post('Email')));
            // $fr = $this->security->xss_clean(trim($this->input->post('Medsos')));

            $DB2 = $this->load->Database('ifca3', TRUE);
            $sql = 'select * from mgr.sysUser where email =? and LoginId=? ';
            $where =array($email_user,$LoginId);
            $qq = $DB2->query($sql,$where);
            $DatasysUser = $qq->result();
            $DB2->close();
            // var_dump($DatasysUser);exit();
             if($DatasysUser){    
                    $email = strtoupper(md5(strtolower($email_user)));
                    $paswd = strtoupper(md5($LoginId));
                    $COM = strtoupper(md5($email.'P@ssw0rd'.$paswd)); 

            $this->session->set_userdata('is_Staff_logged', true);
            $this->session->set_userdata('Tsuser_id', $DatasysUser[0]->rowID);
            $this->session->set_userdata('Tsname', $DatasysUser[0]->LoginId);
            $this->session->set_userdata('Tsemail', $DatasysUser[0]->email);
            $this->session->set_userdata('Tsuname', $DatasysUser[0]->name);
            $this->session->set_userdata('Tsusergroup', $DatasysUser[0]->Group_Cd);
            $this->session->set_userdata('Tsprojectname', '');

                    if($COM != strtoupper($DatasysUser[0]->COM)){

                        $psn="Wrong Login ID";
                        $Data =null;
                        $Error = true;                       
                        $msg1 = $this->Output($Error,$Data,$psn,401);
                        echo  json_encode($msg1);
                        exit();
                    }

                    if(!$this->cekMenuGroup($DatasysUser[0]->Group_Cd)>0){
                        $this->session->set_userdata('Error_Login', "don't have Menu, Please contact your administrator! Groud cd empty");
                    }
                    //Generate Token
                    $GenerateToken = $this->GenerateToken($COM,$ExpiredOn,$DatasysUser[0]->userID,$email_user);
                    //Insert user session
                    $ArSession = array( 'IdUser'    =>  $DatasysUser[0]->userID,
                                        'Token'     =>   $GenerateToken,
                                        'LocationID'  =>  '1',
                                        'LocationDescs'  =>  'Waskita',
                                        'LastLogin' => $dateNow,
                                        'ExpireOn'  => $ExpiredOn,
                                        'IpAddress' => $_SERVER['REMOTE_ADDR'],
                                        'audit_date'=> $dateNow,
                                        'audit_user'=> $email_user
                                    );
                    $Tsession = $this->SaveUserSession($ArSession);

                   // var_dump($this->get_menu_dash($DatasysUser[0]->Group_Cd));
                    $Data = array(
                                    'DashMenu'=>$this->get_menu($DatasysUser[0]->Group_Cd),
                                    // 'SideMenu'=>$this->get_menu($DatasysUser[0]->Group_Cd),
                                    'name'=>$DatasysUser[0]->name,
                                    'user'=>$email_user,
                                    'UserId'=>$DatasysUser[0]->userID,
                                    'Token'=>$GenerateToken,
                                    'Group'=>$DatasysUser[0]->Group_Cd,
                                    'isResetPass'=>false,
                                    'AgentCd'=>$DatasysUser[0]->agent_cd
                                    );                                                                                     
                    // $Error = false;
                    // var_dump($Data);exit();
                    $callback['Data'] = './Dash';
                    // redirect('Dash');
                }else{
                    $callback['Error'] = true;
                    $callback['Pesan'] = 'Your Account is not valid';        
                }


        }else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data Not Valid';
        }

        // $msg1 = $this->Output($Error,$Data,$psn,$Status);

    echo  json_encode($callback);

    }


   public function LoginSosmed($Token,$Id){

    $TokenIDLog = base64_decode($Token);
    // var_dump($TokenIDLog);exit();
     $a = strrpos($TokenIDLog, '/');
     $TokenIDLog = explode("/",$TokenIDLog);//;substr($TokID, 1,$a);
     $Token = $TokenIDLog[0];
     $IDLog = $TokenIDLog[1];

        $this->load->database();
        $DB2 = $this->load->database('ifca', TRUE);
        $sql = 'select * from mgr.security_userdetails where COM=?';
        $where =array($Token);
        $qq = $DB2->query($sql,$where);
        $datas = $qq->result();
// var_dump($datas);exit();
        if($datas){

            $email = $datas[0]->email;

         if (!$this->cekMenuGroup($datas[0]->Group_Cd) > 0) {
             $this->session->set_userdata('Error_Login', "don't have Menu, Please contact your administrator!");
             redirect('userStaff');
         }

         // $kriteria2 = array('email_add' => $email);
         // $table = 'v_security_users';
         // $datauser = $this->M_wsbangun->getData_by_criteria($table, $kriteria2);

         $this->session->set_userdata('is_Staff_logged', true);
         $this->session->set_userdata('UserLogId', $IDLog);
         // if ($datauser) { 
            $this->session->set_userdata('Tsuser_id', $datas[0]->rowID);
            $this->session->set_userdata('Tsname', $datas[0]->userID);
            $this->session->set_userdata('Tsemail', $datas[0]->email);
            $this->session->set_userdata('Tsuname', $datas[0]->name);
                        // $this->session->set_userdata('Tsentity', trim($datas[0]->entity_cd));
                        // $this->session->set_userdata('Tsproject', trim($datas[0]->project_no));
                        // $this->session->set_userdata('Tsysadmin', $datas[0]->system_admin);// gak kepake
                        // $this->session->set_userdata('Tsentityname', $datas[0]->entity_name);
            $this->session->set_userdata('Is_Survey',true );

            $this->session->set_userdata('FCloud',true );
            $this->session->set_userdata('Tsprojectname', '');
            $this->session->unset_userdata('captchaWord');
            $this->session->set_userdata('Tsusergroup', $datas[0]->Group_Cd);

             // if (empty($datauser[0]->MenuPosition)) {
             //     $this->session->set_userdata('TMenuPs', 'T');
             // } else {
             //     $this->session->set_userdata('TMenuPs', $datauser[0]->MenuPosition);
             // }
// var_dump($datas[0]->Group_Cd);exit();
             if ($datas[0]->Group_Cd != 'MGM') {
                 redirect('Dash');
             } else {
                 $kriteria2 = array('email_add' => $email );
                 $table = 'v_security_users';
                 $datauser = $this->M_wsbangun->getData_by_criteria($table, $kriteria2);
                 if ($datauser) 
                       {
                         $this->session->set_userdata('Tsentity', trim($datauser[0]->entity_cd));
                         $this->session->set_userdata('Tsproject', trim($datauser[0]->project_no));
                            // $this->session->set_userdata('Tsysadmin', $datas[0]->system_admin);// gak kepake
                         $this->session->set_userdata('Tsentityname', $datauser[0]->entity_name);
                       }
                 $url = '';
                 $sql = "select * from mgr.v_sysmenumgmgroup where GroupCd='MGM' and Parent_SEQ = (select MIN(parent_seq) AS top_menu from mgr.v_sysmenumgmgroup where GroupCd='MGM' AND PARENT_SEQ <> '1000')";
                 $menuA = $this->M_wsbangun->getData_by_query($sql);
                 // var_dump($menuA[0]->URL);
                 if (empty($menuA[0]->URL) || $menuA[0]->URL == '') {
                     $sql = "select top 1 * from mgr.sysmenumgm where ParentMenuID='".$menuA[0]->MenuID.
                     "'";
                     $menuB = $this->M_wsbangun->getData_by_query($sql);
                     $url = $menuB[0]->URL;
                     // var_dump('1');

                 } else {
                     $url = $menuA[0]->URL;
                     // var_dump('2');
                     // var_dump('aapa');
                 }
                 // var_dump($url);exit();

                 redirect($url);
             }

        }else{
            $this->UpdateUserLog($IDLog,0);
            $this->session->set_userdata('Error_Login', "Your Account can't acces this site");
            redirect('userStaff');
        }
   }

public function login()
{
    $this->load->model('M_wsbangun');
    if($_POST)
    {    
        $email = $this->security->xss_clean($this->input->post('txtUser'));
        // var_dump($email);exit();      
        $paswd = $this->security->xss_clean(trim($this->input->post('txtPass')));
        $paswd = strtoupper(md5($paswd));
        
        
        
        $captcha = strtoupper($this->input->post('userCaptcha', TRUE));
        
        $this->form_validation->set_rules('txtUser', 'Email', 'required');
        $this->form_validation->set_rules('userCaptcha', 'Captcha', 'required');
        // var_dump($this->form_validation->run());exit();
        if($this->form_validation->run() == false)
        {
            $cp = $this->setCaptcha();
            $this->load->view('login/index', $cp);
            return;
        } else {
        
            $cc = strtoupper($this->session->userdata('captchaWord'));
            if($cc!=$captcha){
                redirect('userStaff');
            }

            $this->load->database();
            $DB2 = $this->load->database('ifca3', TRUE);
            // $sql = 'select * from mgr.security_userdetails where email=?'; awal
            $sql = "SELECT * from mgr.v_sysUser where email='$email' and status_activate ='Y'"; //new harus dari adm
            // $where =array($email);
            $qq = $DB2->query($sql);
            $datas = $qq->result();

            // var_dump($datas);exit();
           
            $EmailPassword = strtoupper(md5(strtoupper(md5($email)).'P@ssw0rd'.$paswd));
      
                if($datas)
                {
                    if($EmailPassword != strtoupper($datas[0]->COM))
                    {

                        $this->session->set_userdata('Error_Login', 'Wrong Password!');
                        redirect('userStaff');
                       
                    } 
                    
                    if(!$this->cekMenuGroup($datas[0]->Group_Cd)>0){
                        $this->session->set_userdata('Error_Login', "don't have Menu, Please contact your administrator! Groud cd empty");
                        redirect('userStaff');
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
                        // $this->session->set_userdata('Tsdashboard', 'administrator/index/');
                        redirect('Dash');

                            // if($datas[0]->Group_Cd!='MGM'){
                            //     redirect('Dash');    
                            // } else {
                            //     $kriteria2 = array('email_add' => $email );
                            //     $table = 'v_security_users';
                            //     $datauser = $this->M_wsbangun->getData_by_criteria($table, $kriteria2);
                            //      if ($datauser) 
                            //         {
                            //                 $this->session->set_userdata('Tsentity', trim($datauser[0]->entity_cd));
                            //                 $this->session->set_userdata('Tsproject', trim($datauser[0]->project_no));
                            //                 // $this->session->set_userdata('Tsysadmin', $datas[0]->system_admin);// gak kepake
                            //                 $this->session->set_userdata('Tsentityname', $datauser[0]->entity_name);
                            //         }

                            //     $url='';
                            //     $sql = "select * from mgr.v_sysmenumgmgroup where GroupCd='MGM' and Parent_SEQ = (select MIN(parent_seq) AS top_menu from mgr.v_sysmenumgmgroup where GroupCd='MGM' AND PARENT_SEQ <> '1000')";
                            //     $menuA = $this->M_wsbangun->getData_by_query($sql);
                            //     // var_dump($menuA[0]->URL);
                            //     if(empty($menuA[0]->URL) || $menuA[0]->URL=='') {
                            //         $sql = "select top 1 * from mgr.sysmenumgm where ParentMenuID='".$menuA[0]->MenuID."'";
                            //         $menuB = $this->M_wsbangun->getData_by_query($sql);
                            //         $url = $menuB[0]->URL;
                                    
                            //     } else {
                            //         $url=$menuA[0]->URL;
                            //         // var_dump('aapa');
                            //     }
                                
                            //     redirect($url);
                            // }
                } 
                else{
                    $this->session->set_userdata('Error_Login', 'User is not valid');
                    redirect('userStaff');
                }
                // else {

                //     $sql = "SELECT max(name) as name,max(pager) as pager,COUNT(email_add) AS cnt from mgr.security_users (NOLOCK) where email_add = ? ";
                //     $tess = array($email);
                
                //     $this->load->database();
                //     $DB2 = $this->load->database('ifca', TRUE);
                //     $qq = $DB2->query($sql,$tess);
                //     $xxx = $qq->result();
                    
                //     if($xxx[0]->cnt==0){
                //         $this->session->set_userdata('Error_Login', 'Wrong Email!');
                //         redirect('userStaff');
                //     }

                //     if($paswd==strtoupper($xxx[0]->pager)){
                        
                //         $this->verify2($email,$xxx[0]->pager,null);
                //         return;
                //     }else{
                //         $this->session->set_userdata('Error_Login', 'Wrong Pager');
                //         redirect('userStaff');   
                //     }
                // }
        }
    }
}

 public function Auth($Token) 
 {
     $TokenIDLog = base64_decode($Token);
     // var_dump($TokenIDLog); exit();
     // $a = strrpos($TokID, '/');
     $TokenIDLog = explode("/",$TokenIDLog);//;substr($TokID, 1,$a);
     $Token = $TokenIDLog[0];
     $IDLog = $TokenIDLog[1];
     // var_dump($Token);
     // var_dump($IDLog);
     // exit();
     $this->load->model('M_wsbangun');

     $this->load->database();
     $DB2 = $this->load->database('ifca', TRUE);
     $sql = 'select * from mgr.security_userdetails with(nolock) where COM =?';
     $where = array($Token);
     $qq = $DB2->query($sql, $where);     
     $datas = $qq->result();
     // var_dump($datas);exit();

     if ($datas) {
         $email = $datas[0]->email;

         if (!$this->cekMenuGroup($datas[0]->Group_Cd) > 0) {
             $this->session->set_userdata('Error_Login', "don't have Menu, Please contact your administrator!");
             redirect('userStaff');
         }

         // $kriteria2 = array('email_add' => $email);
         // $table = 'v_security_users';
         // $datauser = $this->M_wsbangun->getData_by_criteria($table, $kriteria2);

         $this->session->set_userdata('is_Staff_logged', true);
         $this->session->set_userdata('UserLogId', $IDLog);
         // if ($datauser) { 
            $this->session->set_userdata('Tsuser_id', $datas[0]->rowID);
            $this->session->set_userdata('Tsname', $datas[0]->userID);
            $this->session->set_userdata('Tsemail', $datas[0]->email);
            $this->session->set_userdata('Tsuname', $datas[0]->name);
                        // $this->session->set_userdata('Tsentity', trim($datas[0]->entity_cd));
                        // $this->session->set_userdata('Tsproject', trim($datas[0]->project_no));
                        // $this->session->set_userdata('Tsysadmin', $datas[0]->system_admin);// gak kepake
                        // $this->session->set_userdata('Tsentityname', $datas[0]->entity_name);
            $this->session->set_userdata('Is_Survey',true );

            $this->session->set_userdata('FCloud',true );
            $this->session->set_userdata('Tsprojectname', '');
            $this->session->unset_userdata('captchaWord');
            $this->session->set_userdata('Tsusergroup', $datas[0]->Group_Cd);

             // if (empty($datauser[0]->MenuPosition)) {
             //     $this->session->set_userdata('TMenuPs', 'T');
             // } else {
             //     $this->session->set_userdata('TMenuPs', $datauser[0]->MenuPosition);
             // }
            // var_dump($datas[0]->Group_Cd);exit();
             if ($datas[0]->Group_Cd != 'MGM') {
                 redirect('Dash');
             } else {
                 $kriteria2 = array('email_add' => $email );
                 $table = 'v_security_users';
                 $datauser = $this->M_wsbangun->getData_by_criteria($table, $kriteria2);
                 if ($datauser) 
                       {
                         $this->session->set_userdata('Tsentity', trim($datauser[0]->entity_cd));
                         $this->session->set_userdata('Tsproject', trim($datauser[0]->project_no));
                            // $this->session->set_userdata('Tsysadmin', $datas[0]->system_admin);// gak kepake
                         $this->session->set_userdata('Tsentityname', $datauser[0]->entity_name);
                       }
                 $url = '';
                 $sql = "select * from mgr.v_sysmenumgmgroup where GroupCd='MGM' and Parent_SEQ = (select MIN(parent_seq) AS top_menu from mgr.v_sysmenumgmgroup where GroupCd='MGM' AND PARENT_SEQ <> '1000')";
                 // var_dump($sql);
                 $menuA = $this->M_wsbangun->getData_by_query($sql);
                 // var_dump($menuA[0]->URL);
                 if (empty($menuA[0]->URL) || $menuA[0]->URL == '') {
                     $sql = "select top 1 * from mgr.sysmenumgm where ParentMenuID='".$menuA[0]->MenuID."'";
                     $menuB = $this->M_wsbangun->getData_by_query($sql);
                     $url = $menuB[0]->URL;
                     // var_dump('1');

                 } else {
                     $url = $menuA[0]->URL;
                     // var_dump('2');
                     // var_dump('aapa');
                 }
                 // var_dump($url);exit();

                 redirect($url);
             }

         // } 
         // else {
         //     $this->session->set_userdata('Error_Login', 'Wrong Email!');
         //     redirect('goto_cloud');
         // }
     }else{
        $this->UpdateUserLog($IDLog,0);
        $this->session->set_userdata('Error_Login', 'Email and Password Not Valid in Cilent!');
        redirect('goto_cloud'); 
     }

 }
public function ChangePasswordAPI(){
    $this->load->model('M_wsbangun');
    $msg='';
    $psn='';
    $datasave = null;
        if($_POST)
        { 

            $email = base64_decode($this->input->post('COM1', true));
            // $email = base64_decode($email);
            $password = base64_decode($this->input->post('COM2', true));

            $sql="select count(a.email) cnt from mgr.security_userdetails a with(NOLOCK) where a.email='$email' ";
            $dtuser = $this->M_wsbangun->getData_by_query($sql);

            if($dtuser[0]->cnt >0){
                $sql1 ="update mgr.security_userdetails set COM ='$password' where email ='$email' ";
                $dtCOM = $this->M_wsbangun->setData_by_query($sql1);
                if($dtCOM!='OK'){
                    $msg=$dtCOM;
                    $psn="FAIL";
                }else{
                    $msg="Password Has Been Changes";
                    $psn="OK";
                }
            }

        }else{
            $msg='Data not Valid!';
            $psn='error';
        }
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn,
                "data"=>$datasave);
            
        echo json_encode($msg1);
 }


public function SendEmail(){
    $this->load->model('M_wsbangun');
    $msg='';
    $psn='';
    $datasave = null;
    if($_POST)
       { 
            $email = base64_decode($this->input->post('COM1', true));
            $Link = base64_decode($this->input->post('COM2', true));
            $emailHash = base64_decode($this->input->post('COM3', true));

             $sql = "mgr.sp_changePassword_web '$email','$Link','$emailHash' ";
                    // var_dump($sql);
                    $snd = $this->M_wsbangun->setData_by_query($sql);
                    // var_dump($snd);exit();
                    $aaa = strpos($snd,'queued');       
                     if( $aaa <= 0 || !$aaa){
                            if($snd=='OK'){
                                $msg = 'Please Check Your Email';
                                $psn ='OK';
                                $aa = $msg;
                            }else{
                                $msg = $snd;
                                $psn ='Fail';
                                $aa = 'Sent Email Failed, Please Contact your Admin!';
                            }
                    
                        }else{
                            $msg = 'Please Check Your Email';
                            $psn ='OK';
                            $aa = $msg;
                        }
       }
       else
       {

       }
       $msg1=array("Pesan"=>$msg,
                "status"=>$psn,
                "data"=>$datasave);
            
        echo json_encode($msg1);

}
public function SendMailError(){
    $this->load->model('M_wsbangun');
    $msg='';
    $psn='';
    $datasave = null;
    if($_POST)
       { 
            $severity = $this->input->post('severity', true);
            $Message = $this->input->post('Message', true);
            $Filename = $this->input->post('Filename', true);
            $Line = $this->input->post('Line', true);
            $uri = $this->input->post('uri', true);

              $sql = "mgr.sp_changePassword_web '$severity','$Message','$Filename','' ";
                    // var_dump($sql);
                    $snd = $this->M_wsbangun->setData_by_query($sql);
                    // var_dump($snd);exit();
                    $aaa = strpos($snd,'queued');       
                     if( $aaa <= 0 || !$aaa){
                            if($snd=='OK'){
                                $msg = 'Please Check Your Email';
                                $psn ='OK';
                                $aa = $msg;
                            }else{
                                $msg = $snd;
                                $psn ='Fail';
                                $aa = 'Sent Email Failed, Please Contact your Admin!';
                            }
                    
                        }else{
                            $msg = 'Please Check Your Email';
                            $psn ='OK';
                            $aa = $msg;
                        }

       }
       $msg1=array("Pesan"=>$msg,
                "status"=>$psn,
                "data"=>$email);
            
        echo json_encode($msg1);

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
    

public function load_captcha(){
         $this->session->unset_userdata('captchaAgent');         
        $cp = $this->setCaptcha();
        $this->load->view('login/captcha',$cp);
    }

    public function logout()
    {
        
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

            redirect('loginstaff'); 
            // redirect('goto_cloud');          
        
    }
    public function logout_cloud()
    {
        //update Logout in cloud
        // $id = $this->session->userdata('UserLogId');
        
        // $this->UpdateUserLog($id,1);
        
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

        $this->session->unset_userdata('FCloud');


        $this->session->unset_userdata('UserLogId');


            redirect('goto_cloud');    

    }

    private function UpdateUserLog($IdLog='',$sukses=1){
        
        if($sukses==1){
            $sql="Update sysUserLog SET Logout = GETDATE() WHERE UserLogID = '$IdLog'";   
        }else{
            $sql="Update sysUserLog SET IsSuccess = $sukses WHERE UserLogID = '$IdLog'";
        }
            
            $data = $this->M_wsbangun->setData_by_query_cloud($sql);
            // var_dump($data);exit();
            if($data!='OK'){
                redirect('Dash'); 
            }
    }

}