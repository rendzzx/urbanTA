<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Occupants extends Core_Controller
{
	
	public function __construct()
	{
		parent::__construct();

        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
        $this->load->model('m_business');
	}
	public function index(){

        $param = $this->uri->segment(3);

        $paramDcd = base64_decode($param);

        $a = explode("+", $paramDcd);
        $debtor_acct = trim($a[0]);
        $project = trim($a[2]);
        $entity = trim($a[1]);
        $Email = trim($a[3]);
        $cp =  $this->setCaptcha();
        // var_dump($Email);
        // $sql = "SELECT * FROM mgr.v_logindebtor WHERE entity_cd='$entity' and project_no='$project' and debtor_acct = '$debtor_acct'";
        // $dtDebtor= $this->m_wsbangun->getData_by_query($sql);
        
         $ContentAllData = array('project_no'=>$project,
        'cp' => $cp,
        // 'dtDebt'=>$dtDebtor
        'project_no'=>$project,
        'entity_cd'=>$entity,
        'debtor_acct'=>$debtor_acct,
        'Email'=>$Email
        );

        $this->load->view('tenant/index',$ContentAllData);
     
    }
    public function agent(){

        $param = $this->uri->segment(3);

        $paramDcd = base64_decode($param);

        $a = explode("+", $paramDcd);
        $debtor_acct = trim($a[0]);
        $project = trim($a[2]);
        $entity = trim($a[1]);
        $Email = trim($a[3]);
        $cp =  $this->setCaptcha();
        // var_dump($Email);
        // $sql = "SELECT * FROM mgr.v_logindebtor WHERE entity_cd='$entity' and project_no='$project' and debtor_acct = '$debtor_acct'";
        // $dtDebtor= $this->m_wsbangun->getData_by_query($sql);
        
         $ContentAllData = array('project_no'=>$project,
        'cp' => $cp,
        // 'dtDebt'=>$dtDebtor
        'project_no'=>$project,
        'entity_cd'=>$entity,
        'debtor_acct'=>$debtor_acct,
        'Email'=>$Email
        );

        $this->load->view('tenant/indexagent',$ContentAllData);
     
    }
    public function indexstaff(){

        $param = $this->uri->segment(3);

        $paramDcd = base64_decode($param);

        $a = explode("+", $paramDcd);
        $debtor_acct = trim($a[0]);
        $project = trim($a[2]);
        $entity = trim($a[1]);
        $Email = trim($a[3]);
        $cp =  $this->setCaptcha();
        // var_dump($debtor_acct);
        // $sql = "SELECT * FROM mgr.security_users WHERE entity_cd='$entity' and project_no='$project' and name = '$debtor_acct'";
        // $dtDebtor= $this->m_wsbangun->getData_by_query($sql);
        // $this->load->database();
        // $DB2 = $this->load->database('ifca', TRUE);
        // $sql = 'select * from mgr.security_userdetails where COM=?';
        // $where =array($Token);
        // $qq = $DB2->query($sql,$where);
        // $datas = $qq->result();
        // var_dump($dtDebtor);
         $ContentAllData = array('project_no'=>$project,
        'cp' => $cp,
        // 'dtDebt'=>$dtDebtor
        'project_no'=>$project,
        'entity_cd'=>$entity,
        'name'=>$debtor_acct,
        'Email'=>$Email
        );

        $this->load->view('tenant/indexstaff',$ContentAllData);
     
    }
    private function setCaptcha()
    {
        
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
         $ContentAllData = array(
        'cp' => $cp
        );
        $this->load->view('tenant/captcha',$ContentAllData);
    }
    public function save(){
         
            $msg="";
            if ($_POST) 
            {

                // $rowid = $this->input->post('txtrowID', true);
                    $email = $this->input->post('txtemail', true);
                    $password = strtoupper(md5(trim($this->input->post('txtpassword')))); 
                    $name = $this->input->post('txtname', true);
                    $gender = $this->input->post('txtgender', true);
                    $link = $this->input->post('txtlink', true);
                    $sosmed = $this->input->post('txtsosmed', true);
                    $entity_cd = $this->input->post('entity_cd',TRUE);
                    $project_no = $this->input->post('project_no',TRUE);
                    $debtor_acct = $this->input->post('debtor_acct',TRUE);
                $userCaptcha = strtoupper($this->input->post('userCaptcha',TRUE));

                $cc = strtoupper($this->session->userdata('captchaWord'));
                if(!$sosmed){
                    if($cc!=$userCaptcha){
                    $msg1=array("Pesan"=>'Captcha is invalid',
                    "status"=>'Fail');
            
                    echo json_encode($msg1);
                    exit();
                   }    
                }
                     
                $audit_date = date('d M Y H:i:s');
                $audit_user = 'IFCA';
                
                // $sql="select rowID from mgr.v_logindebtor where debtor_acct='$name' and entity_cd='$entity_cd' and Project_no ='$project_no' ";
                $table="v_logindebtor";
                $crit = array('debtor_acct' => $name,
                                'entity_cd'=> $entity_cd,
                                'Project_no'=>$project_no);
                $rowid = $this->m_wsbangun->getData_by_criteria($table,$crit);

                $dataDebtor = $rowid ;
                // var_dump($dataDebtor);exit();
                $rowid = $rowid[0]->rowID;    

                //ifca_cloud start
                $email_md = strtoupper(md5($email));
                $EmailPassword ='';
                if(empty($sosmed)|| $sosmed==''){
                        $EmailPassword = md5($email_md.'P@ssw0rd'.$password);    
                }else{
                    $EmailPassword = md5($email_md.'P@ssw0rdGm41L');
                    $password = $EmailPassword;
                }
                
         
                $tbl = "sysLocationSpec";
                // $sql ="select LocationId from mgr.sysLocationSpec";
                $dd = $this->m_wsbangun->getDatapb($tbl);//cek data in PB DB
                // var_dump($dd);
                if(!empty($dd)){
                    $lok_id = $dd[0]->LocationID;    
                }else{
                    $msg1=array("Pesan"=>'Please contact admin \n Location Id Null',
                "status"=>'Failed');
            
                echo json_encode($msg1);
                exit();
                }
                
                $rowId_syscom = 0;
                $sql_cloud = "IF NOT EXISTS(select com1 from syscom where com1 = '$email_md') ";
                $sql_cloud.= "Begin Insert into syscom(Com1,Com2,status) values('$email_md','$password',0);";
                $sql_cloud.= "End ";
                // $exc = $this->m_wsbangun->setData_by_query($sql_cloud);
                $exc = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);
                
                $sql_cloud = "IF EXISTS(select com1 from syscom where com1 = '$email_md') ";
                $sql_cloud .= " BEGIN ";
                $sql_cloud .= " update syscom set Com2='$password' where com1 = '$email_md'; ";
                $sql_cloud .= " END ";
                $dt_cloud = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);

                $sql_cloud = "IF EXISTS(select com1 from syscom where com1 = '$email_md') ";
                // $sql_cloud .= " BEGIN ";
                $sql_cloud .= " Select ID from syscom where Com1 = '$email_md' ;";
                // $sql_cloud .= " END ";
                // var_dump($sql_cloud);exit();
                $dt_cloud = $this->m_wsbangun->getData_by_query_cloud($sql_cloud);

                if(!empty($dt_cloud)){
                    $rowId_syscom = $dt_cloud[0]->ID;
                }
                // var_dump($dt_cloud);//exit();
                                
                $sql_cloud = "IF NOT EXISTS(select com from SysComDt where com = '$email_md' and LocationId=$lok_id) ";
                $sql_cloud .= " BEGIN ";
                $sql_cloud .= "Insert into SysComDt(Com,LocationId) values('$email_md',$lok_id) ";
                $sql_cloud .= " END ";
                $exc = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);
                //ifca_cloud end
                        
                         $psn='';                                                                        

                        $rowId_syscom;

                        $criteria1 = array('email' => $email);
                        $criteria2 = array('userid' => $rowId_syscom);                                                
                        $criteria3 = array('UserId' => $rowId_syscom);   

                        // $dataU2 = array(          
                  
                        // 'audit_user' => $audit_user,
                        // 'audit_date' =>$audit_date,
                        // 'entity_cd'=>trim($entity_cd),
                        // 'project_no'=>trim($project_no)
                        // );                     

                        
                        // $data2 = array(          
                  
                        // 'audit_user' => $audit_user,
                        // 'audit_date' =>$audit_date,
                        // 'entity_cd'=>trim($entity_cd),
                        // 'project_no'=>trim($project_no),
                        // 'userid'=>$rowId_syscom
                        // );

                        
                    $sql = "SELECT count(*) as CNT from mgr.security_userdetails(NOLOCK) where email = '$email' ";
                    $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                    $cnDet = $countResult[0]->CNT;

                    if($cnDet>0) {
                          $dataU1 = array(          
                        // 'nup_id' => $nup_id,
                        'password' => $password,
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'email' =>$email,                        
                        // 'name'=>$name,
                        'userID'=>$rowId_syscom,
                        'name'=>$dataDebtor[0]->name,
                        'gender'=>$gender,
                        'link'=>$link,
                        'sosmed'=>$sosmed,
                        'Group_Cd'=>'DEBTOR',
                        // 'LocationId'=>$lok_id,
                        'COM'=>$EmailPassword
                        );
                                                     
                        $update = $this->m_wsbangun->updateData('security_userdetails',$dataU1, $criteria1);                        
                        if($update == 'OK')
                        {
                            
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                            
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                                          
                    } else {   

                        $data1 = array(          
                        // 'nup_id' => $nup_id,
                        'password' => $password,
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'email' =>$email,                        
                        // 'name'=>$name,
                        'name'=>$dataDebtor[0]->name,
                        'gender'=>$gender,
                        'link'=>$link,
                        'sosmed'=>$sosmed,
                        'userID'=>$rowId_syscom,
                        'Group_Cd'=>'DEBTOR',
                        // 'LocationId'=>$lok_id,
                        'COM'=>$EmailPassword
                        );

                        $insert = $this->m_wsbangun->insertData('security_userdetails',$data1);
                        if ($insert == 'OK')
                        {
                            $msg="Data has been saved successfully";
                            $psn = "OK";                            
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                        
                        
                 
                    }

                    // if($psn=='OK'){
                    //     $dataentitysave = array(          
                  
                    //     'audit_user' => $audit_user,
                    //     'audit_date' =>$audit_date,
                    //     'entity_cd'=>trim($entity_cd),
                    //     'userid'=>$rowid
                    //     );


                    //     $dataentityupdate = array(          
                  
                    //     'audit_user' => $audit_user,
                    //     'audit_date' =>$audit_date,
                    //     'entity_cd'=>trim($entity_cd)//,
                    //     // 'userid'=>$rowid
                    //     );


                    //     $sql = "SELECT count(*) as CNT from mgr.cfs_user_entity(NOLOCK) where userid = '$rowId_syscom' ";
                    //     $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                    //     $cnDet = $countResult[0]->CNT;

                    //     if($cnDet>0){
                    //         $update1 = $this->m_wsbangun->updateData('cfs_user_entity',$dataentityupdate, $criteria2);
                    //         if($update1 != 'OK')
                    //         {
                    //             $msg= $update;
                    //             $psn = "Failed";
                    //         }
                    //     }else{
                    //         $insert1 = $this->m_wsbangun->insertData('cfs_user_entity',$dataentitysave);
                    //         if ($insert1 != 'OK')
                    //         { 
                    //             $msg= $update;
                    //             $psn = "Failed";
                    //         }
                    //     }                    
                    // }
                    // if($psn=="OK"){

                    //     $sql = "SELECT count(*) as CNT from mgr.cfs_user_project with(NOLOCK) where userid = '$rowId_syscom' ";
                    //     $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                    //     $cnDet = $countResult[0]->CNT;

                    //     if($cnDet>0){
                    //         $update1 = $this->m_wsbangun->updateData('cfs_user_project',$dataU2, $criteria2);
                    //         if($update1 != 'OK')
                    //         {
                    //             $msg= $update;
                    //             $psn = "Failed";
                    //         }
                    //     }else{
                    //         $insert1 = $this->m_wsbangun->insertData('cfs_user_project',$data2);
                    //         if ($insert1 != 'OK')
                    //         { 
                    //             $msg= $update;
                    //             $psn = "Failed";
                    //         }

                    //     }
                    // }

                    if($psn=="OK"){

                        $data_userdebtor=array(
                                'UserId'=>$rowId_syscom,
                                'Entity_Cd'=> $entity_cd,
                                'Project_no'=>$project_no,
                                'Debtor_acct'=>$debtor_acct);

                        $criteria2 = array('userid' => $rowId_syscom,
                                            'Debtor_acct'=>$name,
                                            'entity_cd'=>$entity_cd);   
                        $sql = "SELECT count(*) as CNT from mgr.SecurityUserDebtor with(NOLOCK) where Debtor_acct = '$name' and entity_cd='$entity_cd' and project_no='$project_no' ";
                        $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                        $cnDet = $countResult[0]->CNT;

                        if($cnDet>0){
                                $criteria2 = array('debtor_acct'=>$name,
                                                    'entity_cd'=>$entity_cd,
                                                    'project_no'=>$project_no);
                                $update2 = $this->m_wsbangun->updateData('SecurityUserDebtor',$data_userdebtor, $criteria2);
                                if($update2 != 'OK')
                                {
                                    $msg= $update;
                                    $psn = "Failed";
                                }
                        }else{
                            // var_dump('expression');
                            // exit();
                                $insert2 = $this->m_wsbangun->insertData('SecurityUserDebtor',$data_userdebtor);
                                if ($insert2 != 'OK')
                                {
                                    $msg= $update;
                                    $psn = "Failed";
                                }
                        }
                        
                    }
                    // var_dump($password);

            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                "status"=>$psn);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
    public function saveAgent(){
        
            $msg="";
            if ($_POST) 
            {
                // $rowid = $this->input->post('txtrowID', true);
                    $email = $this->input->post('txtemail', true);
                    $password = strtoupper(md5(trim($this->input->post('txtpassword')))); 
                    $name = $this->input->post('txtname', true);
                    $gender = $this->input->post('txtgender', true);
                    $link = $this->input->post('txtlink', true);
                    $sosmed = $this->input->post('txtsosmed', true);
                    $entity_cd = $this->input->post('entity_cd',TRUE);
                    $project_no = $this->input->post('project_no',TRUE);
                    $debtor_acct = $this->input->post('debtor_acct',TRUE);
                $userCaptcha = strtoupper($this->input->post('userCaptcha',TRUE));
                $cc = strtoupper($this->session->userdata('captchaWord'));

                 if(!$sosmed){
                    if($cc!=$userCaptcha){
                    $msg1=array("Pesan"=>'Captcha is invalid',
                    "status"=>'Fail');
            
                    echo json_encode($msg1);
                    exit();
                   }    
                }
                       
                $audit_date = date('d M Y H:i:s');
                $audit_user = 'IFCA';
                
                // $sql="select rowID from mgr.v_logindebtor where debtor_acct='$name' and entity_cd='$entity_cd' and Project_no ='$project_no' ";
                $table="cf_agent_dt";
                $crit = array('agent_cd' => $name,
                                'entity_cd'=> $entity_cd);
                $rowid = $this->m_wsbangun->getData_by_criteria($table,$crit);
                $DataAgent = $rowid;
                $rowid = $rowid[0]->rowID;    

                //ifca_cloud start
                $email_md = strtoupper(md5($email));
                $EmailPassword ='';
                if(empty($sosmed)|| $sosmed==''){
                        $EmailPassword = md5($email_md.'P@ssw0rd'.$password);    
                }else{
                    $EmailPassword = md5($email_md.'P@ssw0rdGm41L');
                    $password = $EmailPassword;
                }
                
         
                $tbl = "sysLocationSpec";
                // $sql ="select LocationId from mgr.sysLocationSpec";
                $dd = $this->m_wsbangun->getDatapb($tbl);//cek data in PB DB
                // var_dump($dd);
                if(!empty($dd)){
                    $lok_id = $dd[0]->LocationID;    
                }else{
                    $msg1=array("Pesan"=>'Please contact admini \n Location Id Null',
                "status"=>'Failed');
            
                echo json_encode($msg1);
                exit();
                }
                
                $rowId_syscom = 0;
                $sql_cloud = "IF NOT EXISTS(select com1 from syscom where com1 = '$email_md') ";
                $sql_cloud.= "Begin Insert into syscom(Com1,Com2,status) values('$email_md','$password',0);";
                $sql_cloud.= "End ";
                // $exc = $this->m_wsbangun->setData_by_query($sql_cloud);
                $exc = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);
                
                $sql_cloud = "IF EXISTS(select com1 from syscom where com1 = '$email_md') ";
                $sql_cloud .= " BEGIN ";
                $sql_cloud .= " update syscom set Com2='$password' where com1 = '$email_md'; ";
                $sql_cloud .= " END ";
                $dt_cloud = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);

                $sql_cloud = "IF EXISTS(select com1 from syscom where com1 = '$email_md') ";
                $sql_cloud .= " BEGIN ";
                $sql_cloud .= " Select ID from syscom where Com1 = '$email_md' ";
                $sql_cloud .= " END ";
                $dt_cloud = $this->m_wsbangun->getData_by_query_cloud($sql_cloud);

                if(!empty($dt_cloud)){
                    $rowId_syscom = $dt_cloud[0]->ID;
                }
                // var_dump($dt_cloud);exit();
                                
                $sql_cloud = "IF NOT EXISTS(select com from SysComDt where com = '$email_md' and LocationId=$lok_id) ";
                $sql_cloud .= " BEGIN ";
                $sql_cloud.= "Insert into SysComDt(Com,LocationId) values('$email_md',$lok_id) ";
                $sql_cloud .= " END ";
                $exc = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);
                //ifca_cloud end
                        
                         $psn='';                                                                        

                        $rowId_syscom;

                        $criteria1 = array('email' => $email);
                        $criteria2 = array('userid' => $rowId_syscom);                                                
                        $criteria3 = array('UserId' => $rowId_syscom);   

                    // var_dump($sql."  count:".$cnDet);exit();
                        // var_dump($cnDet);
                        
                    $dataU1 = array(          
                        // 'nup_id' => $nup_id,
                        'password' => $password,
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'email' =>$email,                        
                        // 'name'=>$name,
                        'userID'=>$rowId_syscom,
                        'name'=>$DataAgent[0]->agent_name,
                        'gender'=>$gender,
                        'link'=>$link,
                        'sosmed'=>$sosmed,
                        'Group_Cd'=>'DEBTOR',
                        // 'LocationId'=>$lok_id,
                        'COM'=>$EmailPassword
                        );
                        $dataU2 = array(          
                  
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'entity_cd'=>trim($entity_cd),
                        'project_no'=>trim($project_no)
                        );

                        $data_userdebtor=array(                                
                                'Entity_Cd'=> $entity_cd,
                                'Project_no'=>$project_no,
                                'Debtor_acct'=>$debtor_acct
                        );

                        $data1 = array(          
                        // 'nup_id' => $nup_id,
                        'password' => $password,
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'email' =>$email,                        
                        // 'name'=>$name,
                        'name'=>$DataAgent[0]->agent_name,
                        'gender'=>$gender,
                        'link'=>$link,
                        'sosmed'=>$sosmed,
                        'userID'=>$rowId_syscom,
                        'Group_Cd'=>'DEBTOR',
                        // 'LocationId'=>$lok_id,
                        'COM'=>$EmailPassword
                        );
                        $data2 = array(          
                  
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'entity_cd'=>trim($entity_cd),
                        'project_no'=>trim($project_no),
                        'userid'=>$rowId_syscom
                        );

                        $data_userdebtor=array(
                                'UserId'=>$rowId_syscom,
                                'Entity_Cd'=> $entity_cd,
                                'Project_no'=>$project_no,
                                'Debtor_acct'=>$debtor_acct);



                    $sql = "SELECT count(*) as CNT from mgr.security_userdetails(NOLOCK) where email = '$email' ";
                    $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                    $cnDet = $countResult[0]->CNT;

                    if($cnDet>0) {
                        
                                                                     
                        $update = $this->m_wsbangun->updateData('security_userdetails',$dataU1, $criteria1);                        
                        if($update == 'OK')
                        {
                            
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                            
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                                          
                    } else {                       
                        $insert = $this->m_wsbangun->insertData('security_userdetails',$data1);
                        if ($insert == 'OK')
                        {
                            $msg="Data has been saved successfully";
                            $psn = "OK";                            
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                        
                        
                 
                    }

                    if($psn=='OK'){
                        $dataentitysave = array(          
                  
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'entity_cd'=>trim($entity_cd),
                        'userid'=>$rowid
                        );


                        $dataentityupdate = array(          
                  
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'entity_cd'=>trim($entity_cd)//,
                        // 'userid'=>$rowid
                        );


                        $sql = "SELECT count(*) as CNT from mgr.cfs_user_entity(NOLOCK) where userid = '$rowid' ";
                        $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                        $cnDet = $countResult[0]->CNT;

                        if($cnDet>0){
                            $update1 = $this->m_wsbangun->updateData('cfs_user_entity',$dataentityupdate, $criteria2);
                            if($update1 != 'OK')
                            {
                                $msg= $update;
                                $psn = "Failed";
                            }
                        }else{
                            $insert1 = $this->m_wsbangun->insertData('cfs_user_entity',$dataentitysave);
                            if ($insert1 != 'OK')
                            { 
                                $msg= $update;
                                $psn = "Failed";
                            }
                        }

                    
                    }
                    if($psn=="OK"){

                        $sql = "SELECT count(*) as CNT from mgr.cfs_user_project with(NOLOCK) where userid = '$rowid' ";
                        $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                        $cnDet = $countResult[0]->CNT;

                        if($cnDet>0){
                            $update1 = $this->m_wsbangun->updateData('cfs_user_project',$dataU2, $criteria2);
                            if($update1 != 'OK')
                            {
                                $msg= $update;
                                $psn = "Failed";
                            }
                        }else{
                            $insert1 = $this->m_wsbangun->insertData('cfs_user_project',$data2);
                            if ($insert1 != 'OK')
                            { 
                                $msg= $update;
                                $psn = "Failed";
                            }

                        }

                    }
                    if($psn=="OK"){
                        $sql = "SELECT count(*) as CNT from mgr.SecurityUserDebtor with(NOLOCK) where Debtor_acct = '$name'";
                        $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                        $cnDet = $countResult[0]->CNT;

                        if($cnDet>0){
                                $update2 = $this->m_wsbangun->updateData('SecurityUserDebtor',$data_userdebtor, $criteria2);
                                if($update2 != 'OK')
                                {
                                    $msg= $update;
                                    $psn = "Failed";
                                }
                        }else{
                                $insert2 = $this->m_wsbangun->insertData('SecurityUserDebtor',$data_userdebtor);
                                if ($insert2 != 'OK')
                                {
                                    $msg= $update;
                                    $psn = "Failed";
                                }
                        }
                        
                    }
                    // var_dump($password);

            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                "status"=>$psn);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
    public function savestaff(){
        
            $msg="";
            if ($_POST) 
            {
                
                $email = $this->input->post('txtemail', true);
                $password = strtoupper(md5(trim($this->input->post('txtpassword')))); 
                $name = $this->input->post('txtname', true);
                $idname = $this->input->post('txtname', true);
                $gender = $this->input->post('txtgender', true);
                $link = $this->input->post('txtlink', true);
                $sosmed = $this->input->post('txtsosmed', true);
                $entity_cd = $this->input->post('entity_cd',TRUE);
                $project_no = $this->input->post('project_no',TRUE);
                $userCaptcha = strtoupper($this->input->post('userCaptcha',TRUE));
                $cc = strtoupper($this->session->userdata('captchaWord'));

                 if(!$sosmed){
                    if($cc!=$userCaptcha){
                    $msg1=array("Pesan"=>'Captcha is invalid',
                    "status"=>'Fail');
            
                    echo json_encode($msg1);
                    exit();
                   }    
                }
                // $rowid = $this->input->post('txtrowID', true);

                // $sql="select RowID from mgr.security_users where NAME='$name' ";
                $table="security_users(nolock)";
                $crit = array('name' => $name );
                // $rowid = $this->m_wsbangun->getData_by_query($sql);
                $rowid = $this->m_wsbangun->getData_by_criteria($table,$crit);
                $DataUser = $rowid;
                $rowid = $rowid[0]->RowID;       
                // var_dump($DataUser);exit();

                $audit_date = date('d M Y H:i:s');
                $audit_user = 'IFCA';
      
                $tbl = 'security_groupings(nolock)';
                $crit = array('user_name'=>$idname);
                $groups = $this->m_wsbangun->getData_by_criteria($tbl,$crit);
                $groupcd = $groups[0]->group_name;
                
                $email_md = strtoupper(md5($email));
                // $EmailPassword = md5($email_md.'P@ssw0rd'.$password);
                  if(empty($sosmed)|| $sosmed==''){
                        $EmailPassword = md5($email_md.'P@ssw0rd'.$password);    
                }else{
                    $EmailPassword = md5($email_md.'P@ssw0rdGm41L');
                    $password = $EmailPassword;
                }
         
                // $lok_id ='';
                // $sql ="select LocationId from mgr.sysLocationSpec";
                // $dd = $this->m_wsbangun->getData_by_querypb($sql);//cek data in PB DB
                // // var_dump($dd);
                // if(!empty($dd)){
                //     $lok_id = $dd[0]->LocationId;    
                // }else{
                //     $msg1=array("Pesan"=>'Please contact admini \n Location Id Null',
                // "status"=>'Failed');
            
                // echo json_encode($msg1);
                // exit();
                // }
                
                // $rowId_syscom = 0;
                // $sql_cloud = "IF NOT EXISTS(select com1 from syscom where com1 = '$email_md') ";
                // $sql_cloud.= "Begin Insert into syscom(Com1,Com2,status) values('$email_md','$password',0);";
                // $sql_cloud.= "End else begin update syscom set Com2='$password' where com1 = '$email_md'; end  ";
                // // $exc = $this->m_wsbangun->setData_by_query($sql_cloud);
                // $exc = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);
                
                // // $sql_cloud = "IF EXISTS(select com1 from syscom where com1 = '$email_md') ";
                // // $sql_cloud .= " BEGIN ";
                // // $sql_cloud .= " update syscom set Com2='$password' where com1 = '$email_md'; ";
                // // $sql_cloud .= " END ";
                // // $dt_cloud = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);

                // $sql_cloud = "IF EXISTS(select com1 from syscom where com1 = '$email_md') ";
                // $sql_cloud .= " BEGIN ";
                // $sql_cloud .= " Select ID from syscom where Com1 = '$email_md' ";
                // $sql_cloud .= " END ";
                // $dt_cloud = $this->m_wsbangun->getData_by_query_cloud($sql_cloud);

                // $sql_cloud = "IF NOT EXISTS(select com from SysComDt where com = '$email_md' and LocationId=$lok_id) ";
                // $sql_cloud .= " BEGIN ";
                // $sql_cloud.= "Insert into SysComDt(Com,LocationId) values('$email_md',$lok_id) ";
                // $sql_cloud .= " END ";
                // $exc = $this->m_wsbangun->setData_by_query_cloud($sql_cloud);

                // if(!empty($dt_cloud)){
                //     $rowId_syscom = $dt_cloud[0]->ID;
                // }

                        $psn='';
                        
                        
                        $sql = "SELECT count(*) as CNT from mgr.security_userdetails(NOLOCK) where email = '$email' ";
                        $countResult = $this->M_wsbangun->getData_by_querypb($sql);
                        $cnDet = $countResult[0]->CNT;

                        $rowId_syscom;

                        $criteria1 = array('email' => $email);
                        // $criteria2 = array('userid' => $rowId_syscom);                                                
                   

                    // var_dump($sql."  count:".$cnDet);exit();
                        // var_dump($cnDet);

                            
                        // var_dump($cnDet);
                    if($cnDet>0) {
                        $dataU1 = array(          
                        // 'nup_id' => $nup_id,
                        'password' => $password,
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'email' =>$email,                        
                        'name'=>$DataUser[0]->description,
                        'gender'=>$gender,
                        'link'=>$link,
                        'sosmed'=>$sosmed,
                        'Group_Cd'=>$groupcd,
                        // 'LocationId'=>$lok_id,
                        'COM'=>$EmailPassword
                        );
                        // $dataU2 = array(          
                  
                        // 'audit_user' => $audit_user,
                        // 'audit_date' =>$audit_date,
                        // 'entity_cd'=>trim($entity_cd),
                        // 'project_no'=>trim($project_no)
                        // );

                        
                        // $criteria3 = array('UserId' => $rowId_syscom);                                                
                        $update = $this->m_wsbangun->updateData('security_userdetails',$dataU1, $criteria1);                        
                        if($update == 'OK')
                        {
                            // $update1 = $this->m_wsbangun->updateData('cfs_user_project',$dataU2, $criteria2);
                            // if($update1 == 'OK')
                            // {
                                $msg="Data has been updated successfully";
                                $psn = "OK";                              
                            // } else {
                            //     $msg= $update1;
                            //     $psn = "Failed";
                            // }
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                        
                  
                    } else {

                        $data1 = array(          
                        // 'nup_id' => $nup_id,
                        'password' => $password,
                        'audit_user' => $audit_user,
                        'audit_date' =>$audit_date,
                        'email' =>$email,                        
                        'name'=>$DataUser[0]->description,
                        'gender'=>$gender,
                        'link'=>$link,
                        'sosmed'=>$sosmed,
                        'userID'=>$DataUser[0]->name,//$rowid,
                        'Group_Cd'=>$groupcd,
                        // 'LocationId'=>$lok_id,
                        'COM'=>$EmailPassword
                        );
                        // $data2 = array(          
                  
                        // 'audit_user' => $audit_user,
                        // 'audit_date' =>$audit_date,
                        // 'entity_cd'=>trim($entity_cd),
                        // 'project_no'=>trim($project_no),
                        // 'userid'=>$rowid
                        // );

                       

                        $insert = $this->m_wsbangun->insertData('security_userdetails',$data1);
                        if ($insert == 'OK')
                        {

                            // $insert1 = $this->m_wsbangun->insertData('cfs_user_project',$data2);
                            // if ($insert1 == 'OK')
                            // {                                

                                $msg="Data has been saved successfully";
                                $psn = "OK";
                                
                            // } else {
                            //     $msg= $insert1;
                            //     $psn = "Failed";
                            // }
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                        
                        
                 
                    }//end of inserting to pb
                    //start inserting to adm
                    $sqlAdm = "SELECT count(*) as CNT from mgr.sysUser(NOLOCK) where email = '$email' ";
                    $countResAdm = $this->M_wsbangun->getData_by_queryadm($sqlAdm);
                    $cnDetAdm = $countResAdm[0]->CNT;
                    if($cnDetAdm>0){
                        $dtAdm1 = array(        
                            'password' => $password,
                            'name'=>$DataUser[0]->description,
                            'audit_user' => $audit_user,
                            'audit_date' =>$audit_date,
                            'userID'=>$DataUser[0]->name,             
                            'Group_Cd'=>$groupcd,
                           
                            'isResetLogin'=>0,
                            'COM'=>$EmailPassword
                        );
                     
                        $critAdm1 = array('email' => $email);                                                
                        $update = $this->m_wsbangun->updateDataadm('sysUser',$dtAdm1, $critAdm1);                        
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";                              
                        
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                        
                  
                    } else {

                        $dtAdm1 = array(   
                            'email'=>$email,     
                            'password' => $password,
                            'name'=>$DataUser[0]->description,
                            'audit_user' => $audit_user,
                            'audit_date' =>$audit_date,
                            'userID'=>$DataUser[0]->name,             
                            'Group_Cd'=>$groupcd,
                           
                            'isResetLogin'=>0,
                            'COM'=>$EmailPassword
                        );
                  
                        $insert = $this->m_wsbangun->insertDataadm('sysUser',$data1);
                        if ($insert == 'OK')
                        {
                            $msg="Data has been saved successfully";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                        
                    }//end of inserting to adm



            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                "status"=>$psn);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
    public function Save_GL_API(){
        // $param = json_decode($this->uri->segment(3));
        var_dump($param);
        $msg='';
        $psn='';
        if ($_POST) 
            {
                $acct_cd = $this->input->post('acct_cd', true);
                $descs = $this->input->post('descs', true);
                $class_cd = $this->input->post('class_cd', true);
                $active_status = $this->input->post('active_status', true);
                $acct_type = $this->input->post('acct_type', true);
                $mgm_acct = $this->input->post('mgm_acct', true);
                $control = $this->input->post('control',TRUE);
                $audit_user = $this->input->post('user',TRUE);
                $audit_date = date('d M Y H:i:s');
                $datasave=array('acct_cd'=>$acct_cd,
                                'descs'=>$descs,
                                'class_cd'=>$class_cd,
                                'active_status'=>$active_status,
                                'acct_type'=>$acct_type,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date);
                $insert2 = $this->m_wsbangun->insertData('gl_chart',$datasave);
                                if ($insert2 != 'OK')
                                {
                                    $msg= $insert2;
                                    $psn = "Error";
                                    $datasave=null;
                                }else{
                                        $msg="Data berhasil di simpan";
                                        $psn="Sukses";                    
                                }
                
            }else{
                $msg="data post not valid";
                $psn ="Error";
                $datasave =null;
            }
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn,
                "data"=>$datasave);
            
        echo json_encode($msg1);
    }

} 
?>