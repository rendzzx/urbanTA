<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_profile extends Core_Controller{
	public function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    public function profile(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');
        if($group=='AGENT')
        {
            $this->load->view('agent/profile');
        }
        else if($group=='PRINCIPAL')
        {
            $this->load->view('agent/principal');
        }
        else 
        {
            $this->load->view('agent/else');
        }
    }

    public function profile_edit(){
        $this->load->view('agent/profile');
    }

    public function agentProfile(){
        $this->load->database();
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsuname');        
        $group = $this->session->userdata('Tsusergroup');
        if($group=='AGENT')
        {
            $this->load_content_top_menu('agent/profileAgent');
        }
        else if($group=='PRINCIPAL')
        {
            $this->load_content_top_menu('agent/profilePrinciple');
        }
        else 
        {
            $this->load_content_top_menu('agent/profileElse');
        }
    }

    public function change(){
        $this->load->database();
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsuname');        
        $group = $this->session->userdata('Tsusergroup');
        $Tsemail = $this->session->userdata('Tsemail');
        
        $cp =  $this->setCaptcha();
        $ContentAllData = array('email'=>$Tsemail,
                                'cp' => $cp);
        $this->load_content_top_menu('login/changepass',$ContentAllData);
    }

    public function getByName($Name){
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sysuser';

        // $where=array('rowID'=>$id);
        $where = array('name' => $Name );
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);

        echo json_encode($data);
    }

    public function fotopict($Name){
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sysuser';

        // $where=array('rowID'=>$id);
        $where = array('name' => $Name );
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);

        echo json_encode($data);
    }

    public function getByID($Name){
        $sql = "select * from cf_agent_dt where agent_cd='$Name'";
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        echo json_encode($data);
    }

    public function getByIDGroup($name = null){
        if(!empty($name)){
            $q = "select * from cf_agent_dt a inner join cf_agent_hd b ON a.group_cd=b.group_cd WHERE a.agent_cd='$name'";
            $cons = $this->session->userdata('Tscons');
            $d = $this->m_wsbangun->getData_by_query_cons($cons,$q);

            echo json_encode($d);
        }
    }

    public function getByIDGroup2($name = null){
        if(!empty($name)){
            $q2 = "select a.email_add as email_add from cf_agent_dt a inner join cf_agent_hd b ON a.group_cd=b.group_cd WHERE a.agent_cd='$name'";
            $cons = $this->session->userdata('Tscons');
            $d2 = $this->m_wsbangun->getData_by_query_cons($cons,$q2);

            echo json_encode($d2);
        }
    }

    public function getByIDDD($name = null){
        if(!empty($name)){
            $this->load->database();
             $DB2 = $this->load->database('ifca', TRUE);
             $sql = 'select a.email as email_add,a.name from security_userdetails a with(NOLOCK) where a.name =?';
             $where = array($name);
             $qq = $DB2->query($sql, $where);     
             $datas = $qq->result();
            // $q2 = "select * from security_userdetails a with(NOLOCK) where a.name='$name'";
            // $d2 = $this->m_wsbangun->getData_by_query($q2);

            echo json_encode($datas);
        }
    }

    public function zoom_office(){
        $id = $this->input->post('Id', TRUE);
        $id = trim($id);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $table = 'cf_agent_hd (nolock)';
        $obj = array('group_cd', 'group_name');
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,null,$id);
        echo $data;
    }

    public function choose_Lead(){
        $id = $this->input->post('Id', TRUE);
        $table = 'cf_lead_agent (nolock)';
        $entity = $this->session->userdata('Tsentity');
        $order = array("rowID","asc");
        $obj = array('lead_cd', 'lead_name');
        $where = array('entity_cd'=>$entity, 'lead_cd'=>$id);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,$where,$id,$order);
        echo $data;
    }

    public function choose_Brand(){
        $id = $this->input->post('Id', TRUE);
        $table = 'cf_brand_agent (nolock)';
        $order = array("rowID","asc");
        $obj = array('brand_cd', 'brand_name');
        $where = array('brand_cd'=>$id);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getCombo_cons($cons,$table,$obj,$where,$id,$order);
        echo $data;
    }

    public function chooseLead(){
        $id =$this->input->post('q', TRUE);
        $sql = "select * from cf_lead_agent where lead_name like '%$id%' order by rowid asc";
        $cons = $this->session->userdata('Tscons');
        $city = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        if(!empty($city)){
            foreach ($city as $value) {
                $row[] = array('id'=>$value->lead_cd,'text'=>$value->lead_name);
            }
            echo json_encode($row);
        }
    }

    public function chooseBrand(){
        $id =$this->input->post('q', TRUE);
        $sql = "select * from cf_brand_agent where brand_name like '%$id%' order by rowid asc";
        $cons = $this->session->userdata('Tscons');
        $city = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        if(!empty($city)){
            foreach ($city as $value) {
                $row[] = array('id'=>$value->brand_cd,'text'=>$value->brand_name);
            }
            echo json_encode($row);
        }
    }

    public function updateGroup(){
        $msg ='';
        $status ='';
        if($_POST){
            $AM = $this->input->post('am',TRUE);
            $AMno = $this->input->post('txtArmNo',TRUE);
            $brand = $this->input->post('txtBrand',TRUE);
            $officename = $this->input->post('txtOfficeName',TRUE);
            $PT = $this->input->post('PT',TRUE);
            $CompNPWP = $this->input->post('txtCompNPWP',TRUE);
            $CompAddr = $this->input->post('txtCompAdd',TRUE);
            $City = $this->input->post('txtCity',TRUE);
            $Lead = $this->input->post('txtLead',TRUE);
            $telp = $this->input->post('txtTelp',TRUE);
            $fax = $this->input->post('txtFax',TRUE);
            $Oemail = $this->input->post('txtOffEmail',TRUE);
            $ComBankName = $this->input->POST('txtCompBankName',TRUE);
            $AcctName      = $this->input->POST('txtAcctName',TRUE);
            $AcctNo      = $this->input->POST('txtAcctNo',TRUE);
            $PrincipleName     = $this->input->POST('txtPrinNo',TRUE);
            $IdNo     = $this->input->POST('txtIdNo',TRUE);
            $NPWP    = $this->input->POST('txtNPWP',TRUE);
            $EmailAdd        = $this->input->POST('txtEmailAdd',TRUE);
            $hp1        = $this->input->POST('txtMbl1',TRUE);
            $hp2        = $this->input->POST('txtMbl2',TRUE);
            $asAgent = $this->input->POST('AssAgent',TRUE);
            $package = $this->input->POST('package',TRUE);
            $audit_date = date('d M Y H:i:s');
            $userid = $this->session->userdata("Tsuname");
            $entity = $this->session->userdata('Tsentity');
            $cr = array('group_cd'=>$userid);
            $data = array(
                'entity_cd'=>$entity,
                'group_name'=>$officename,
                'contact_person'=>$PrincipleName,
                'contact_no'=>$IdNo,
                'company_name'=>$PT,
                'Brand'=>$brand,
                // 'group_type'=>$rbType,
                'Company_NPWP'=>$CompNPWP,
                'Company_Address'=>$CompAddr,
                'City'=>$City,
                // 'Province'=>$txtProvince,
                // 'PostCd'=>$txtPostCd,
                'Telp_No'=>$telp,
                'Fax_No'=>$fax,
                'Company_Email'=>$Oemail,
                'Bank_Name'=>$ComBankName,
                'Bank_Acct_Name'=>$AcctName,
                'Bank_Acct_No'=>$AcctNo,
                'NPWP'=>$NPWP,
                'Email_Addr'=>$EmailAdd,
                'Handphone1'=>$hp1,
                'Handphone2'=>$hp2,
                // 'status'=>'N',
                'Brand'=>$brand,
                'Arebi_Member'=>$AM,
                'Arebi_Number'=>$AMno,
                'Audit_date'=>$audit_date,
                'Audit_user'=>'WEB',
                'Assigned_Agent'=>$asAgent,
                'Package'=>$package,
                'lead_cd'=>$Lead
                // 'seqno'=>$seqno
            );
            $d = $this->m_wsbangun->updateData('cf_agent_hd',$data,$cr);
            if($d=='OK') {
                $msg="Data has been saved successfully";
                $status="ok";
            } else {
                $msg="Data error when updated";
                $status = $d;
            }
        } else {
            $msg = "Data validation is not valid";
            $status="fail";
        }
        $t = array("Pesan"=>$msg, "status"=>$status);
        echo json_encode($t);
    }

    public function updateElse(){
        $msg ='';
        $status ='';

        $isFile  =$this->input->post('isFile',TRUE);

        $uploadOk = 1;
        $image  = $this->input->post('image',TRUE);
        if($isFile=="true"){

            $image = str_replace(' ', '_', $image);
            $image = base_url('img/user/').$image;

            $picture = $_FILES["userfile"];
            $target_dir = "./img/user/";
            $target_file = $target_dir . str_replace(' ','_',basename($_FILES["userfile"]["name"]));
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            if(isset($_POST["submit"])) {
                $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                if($check !== false) {
                    $callback['Pesan'] = "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = "File is not an image.";
                    $uploadOk = 0;
                }

                $callback['Data'] = 'Failed';                        

                echo json_encode($callback);
                exit();
            }

            if ($_FILES["userfile"]["size"] > 300000) {
                $callback['Error'] = true;
                $callback['Pesan'] = "Maximum file size is 300kb";
                $uploadOk = 0;
                $callback['Data'] = 'failed';

                echo json_encode($callback);
                exit();
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" ) {
                $callback['Error'] = true;
                $callback['Pesan'] ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                $callback['Data'] = 'failed';

                echo json_encode($callback);
                exit();
            }

            if ($uploadOk == 0) {
                $callback['Error'] = true;
                $callback['Pesan'] = "Sorry, your file was not uploaded.";
            }
            else {
                if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                    $callback['Pesan'] = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                }
                else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = "Sorry, there was an error uploading your file.";
                }
            }
        } 

        $table = 'sysuser';
        if($_POST){
            
            $name = $this->input->post('Name',TRUE);
            $telp = $this->input->post('Handphone',TRUE);
            // $Menu = $this->input->post('Menu',TRUE);
            $userid = $this->session->userdata("Tsuname");
            // $pict_image = $this->input->post('')
            $image = $this->input->post('image',TRUE);
            $email = $this->input->post('Email', True);
            $password = $this->input->post('password', True);
            $wa_no = $this->input->post('Wa', True);
            
            $cr = array('name'=>$userid);

            if(strpos($image, base_url('img/user/')) !==false ) {
                        $data = array(
               
                'name'=>$name,
                'Handphone'=>$telp,
                // 'MenuPosition'=>$Menu,
                // 'pict' => $image,
                'pict' => $image,
                'email' => $email,
                'password' => $password,
                'wa_no' => $wa_no
                
            );
                    }

            else{
                $data = array(
               
                'name'=>$name,
                'Handphone'=>$telp,
                // 'MenuPosition'=>$Menu,
                // 'pict' => $image,
                'pict' => base_url('img/user/').$image,
                'email' => $email,
                'password' => $password,
                'wa_no' => $wa_no

                );
                
            }
            
            
            // $d = $this->m_wsbangun->updateData('security_users',$data,$cr);
            // $d = $this->m_wsbangun->updateData('sysuser',$data,$cr);
            $d = $this->m_wsbangun->updateData_cons('ifca3',$table,$data,$cr);
            // var_dump($d);
            if($d=='OK') {
                // $this->session->unset_userdata('TMenuPs');
                // $this->session->set_userdata('TMenuPs', $Menu);
                $msg="Data has been saved successfully";
                $status="OK";
            } else {
                $msg="Data error wher updated";
                $status = $d;
            }
        } else {
            $msg = "Data validation is not valid";
            $status="fail";
        }
        $t = array("Pesan"=>$msg, "status"=>$status);
        echo json_encode($t);
    }

    public function changepass(){
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $password2 = $this->input->post('password2', True);
        $email = $this->input->post('email', true);
        $em = $email;
        $pass = $password2;

        if (!empty($pass)) {

            $this->load->database();
            $DB2 = $this->load->database('ifca3', TRUE);
            $sql = 'select * from sysUser where email=?';
            $where =array($em);
            $qq = $DB2->query($sql,$where);
            $datas = $qq->result();

            $email = strtoupper(md5($email));
            $paswd = $pass;
            $paswd = strtoupper(md5($paswd));
            $EmailPassword = strtoupper(md5($email.'P@ssw0rd'.$paswd));

            if($datas){
                $dataupdate = array(       
                    'COM'=>$EmailPassword,
                    'password'=>$EmailPassword
                );
                $criteria = array(
                    'email'=>$em
                );
                $update = $this->M_wsbangun->updateDataadm('sysUser',$dataupdate, $criteria);
       
                if($update !="OK"){
                    $callback['Error'] = true;
                    $callback['Pesan'] = 'Cannot reset your password.';
                }else{
                    $callback['Pesan'] = "Your password has been updated successfully"; 
                }    
            }
        }
        echo json_encode($callback);
    }

    public function update(){
        $msg ='';
        $status ='';
        if ($_POST) 
        {
            $agent_cd = $this->session->userdata('Tsuname');
            $PT                 = $this->input->POST('PTPTdtl',TRUE);
            $txtHomeAdd      = (string)$this->input->POST('txtHomeAdd',TRUE);
            $txtAgentName     = $this->input->POST('txtAgentName',TRUE);
            $txtCity      = $this->input->POST('txtCity',TRUE);
            // $txtProvince      = $this->input->POST('txtProp',TRUE);
            // $txtPostCd      = $this->input->POST('txtCode',TRUE);
            // $txtTelp      = $this->input->POST('txtTelp',TRUE);
            // $txtFax      = $this->input->POST('txtFax',TRUE);
            // $txtOffiEmail      = $this->input->POST('txtOffiEmail',TRUE);
            // $txtComBankName      = $this->input->POST('txtComBankName',TRUE);
            // $txtAcctName      = $this->input->POST('txtAcctName',TRUE);
            // $txtAcctNo      = $this->input->POST('txtAcctNo',TRUE);
            // $txtPrincipleName     = $this->input->POST('txtPrinNo',TRUE);
            $txtIdNo     = $this->input->POST('txtIdNo',TRUE);
            $txtNPWP    = $this->input->POST('txtNPWP',TRUE);
            $txtEmailAdd        = $this->input->POST('txtEmailAdd',TRUE);
            $txthp1        = $this->input->POST('txtMbl1',TRUE);
            $txthp2        = $this->input->POST('txtMbl2',TRUE);
            $audit_date = date('d M Y H:i:s');
            
            // $entity_cd = '2101';
            $data = array(
                    // 'entity_cd'=>$entity_cd,
                    // 'group_cd'=>$group_cd,
                    // 'agent_cd'=>$Agent_cd,
                    'agent_name'=>$txtAgentName,
                    'id_no'=>$txtIdNo,
                    'NPWP'=>$txtNPWP,
                    'home_address'=>$txtHomeAdd,
                    'City'=>$txtCity,
                    // 'Province'=>$txtProvince,
                    // 'Post_Cd'=>$txtPostCd,
                    // 'email_add'=>$txtEmailAdd,
                    'Handphone1'=>$txthp1,
                    'Handphone2'=>$txthp2,                    
                    // 'agent_type_cd'=>$rbType,                    
                    // 'status'=>'N',
                    'Audit_date'=>$audit_date,
                    'Audit_user'=>'WEB',
                    // 'seqno'=>$seqno,
                    // 'status_approval'=>'U',
                    // 'principal_flag'=>'N'

                );
            $where =array('agent_cd'=>$agent_cd);
            $tes = $this->m_wsbangun->updateData('cf_agent_dt',$data,$where);
            if($tes=='OK'){
                            $msg="Data has been saved successfully";
                            $status ='ok';
                        } else {
                            $status="fail";
                            $msg=$tes;
                        }
        }else
        {
                $msg="Data validation is not valid";
                $status="fail";
        }
        $msg1=array("Pesan"=>$msg,
                        "status"=>$status);
            
        echo json_encode($msg1);
    }

}