<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_User extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $this->load_content_top_menu('user/index');
    }


    // -------- SECTION --------
    public function gettableuser()
    {
    	$project = $this->session->userdata('Tsproject');        
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);
        
        $aColumns  = array('email','name','Group_Cd','Handphone','nik_id');

        $sTable = 'mgr.sysuser';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);

        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        // var_dump($filter_search);
        $param = " where rowID > 0 and Group_Cd not in ('AGENT','DEBTOR','Guest') ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttableadm($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

        $sql="select count(*) as cnt from ".$sTable." ".$param;
        $ts = $DB2->query($sql);
        $a = $ts->result()[0]->cnt;

        $iTotal = $a;//$DB2->count_all($sTable);
    
        // Output
        $output = array(
            'draw' => intval($draw),
            'recordsTotal' => $iTotal,
            'recordsFiltered' => $iTotal,
            'data' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array(); 
            
            foreach($aColumns as $col)
            {
                $row[] = $aRow[$col];
                
            }
    
            $output['data'][] = $aRow;

        }
        echo json_encode($output);
    }

    public function getByIDuser($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sysUser';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);
        $email = $data[0]->email;

        $where=array('email'=>$email);
        $datapro = $this->m_wsbangun->getData_by_criteria_cons('ifca3','v_cfs_login_user',$where);
        $content = array('data' => $data,
                            'datapro'=>$datapro );
        echo json_encode($content);
    }

    public function getByIDproject($email)
    {
        $cons   = $this->session->userdata('Tscons');
        $sql  = "SELECT mgr.cfs_user_project.*,
        mgr.pl_project.descs as descs_project
        FROM mgr.cfs_user_project
        INNER JOIN mgr.pl_project
        on mgr.cfs_user_project.entity_cd=mgr.pl_project.entity_cd
        WHERE mgr.cfs_user_project.project_no = mgr.pl_project.project_no
        AND cfs_user_project.email='$email'";

        $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

        echo json_encode($data);
    }

    
    public function zoomdept($id)
    {
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_dept';

        $where=array('dept_cd'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        echo json_encode($data);

    }
    public function zoomdiv($id)
    {
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_div';

        $where=array('div_cd'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        echo json_encode($data);

    }
    public function zoomstaff($id)
    {
        $cons = $this->session->userdata('Tscons');
        $table = 'v_cf_staff';

        $where=array('staff_id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        echo json_encode($data);

    }

    public function adduser()
    {
        $cons   = $this->session->userdata('Tscons');
        // var_dump($cons);exit();
        $sql = "SELECT * FROM mgr.pl_project where status='1' order by descs";
        $sql2 = "SELECT * FROM mgr.cf_staff";
        $sql3 = "SELECT * FROM mgr.sysGroup  where dashboard_url not like '%adminweb%' order by group_descs";

        $project = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $staff = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $group = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql3);

        $content = array(
            'project'=>$project,
            'group'=>$group,
            'staff'=>$staff,
        );
        
    	$this->load->view('user/add',$content);
    }
    public function activate()
    {
        $cons   = $this->session->userdata('Tscons');
        // var_dump($cons);exit();
        $sql = "SELECT * FROM mgr.pl_project where status='1' order by descs";
        $sql2 = "SELECT * FROM mgr.cf_staff";
        $sql3 = "SELECT * FROM mgr.sysGroup  where dashboard_url not like '%adminweb%' order by group_descs";

        $project = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $staff = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $group = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql3);

        $content = array(
            'project'=>$project,
            'group'=>$group,
            'staff'=>$staff,
        );
        
        $this->load->view('user/activate',$content);
    }
     private function setUploadOptions()
    {
        $max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/cs',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }
    public function savePic() {
        // var_dump($_POST);
        // if($_POST)
        // {

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsname');
            $complain_no = $this->input->post('complain_no',true);
            $seqno = $this->input->post('seqno',true);

            $files = $_FILES;
            $cnt ='';
            // $picname = str_replace(' ', '_', $files['userfile']['name']);
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());



            $picture = !empty($_FILES) ? $picture = $_FILES["userfile"] : '';
            if(!empty($picture["name"]))
            {
                $picname = str_replace(' ', '_', $picture["name"]);
                $picture = $_FILES["userfile"];
                // var_dump($picture);exit();
                $tmpName = $_FILES['userfile']['tmp_name'];
                $imgString = file_get_contents($tmpName);
                $imgData = bin2hex($imgString);
                $imgbin ="0x".$imgData;
                $psn='';$msg='';
                
                $picture = array_filter($picture);

                $target_dir = "./img/user/";
                if(!is_dir($target_dir)){
                    mkdir($target_dir);
                }
                // $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $target_file = $target_dir . str_replace(' ','_',basename($_FILES["userfile"]["name"]));
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                if ($_FILES["userfile"]["size"] > 500000) {
                    $msg = "Maximum file size is 500kb";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $res=array("pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($res);
                    exit();
                }

                $imageFileType = strtolower($imageFileType);
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"  ) {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $res=array("pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($res);
                    exit();
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg = "Sorry, your file was not uploaded. ".$msg;
                    $psn = "Failed";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                        $descs ="img/user/".$picname;
                        $url=base_url().$descs;
                        // var_dump($url);exit();
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                        $psn = "Failed";
                    }
                }

            } else {
              
               $msg = "Sorry, there was an error uploading your file.";
               $psn = "Failed";
            }

                
            // }
            $res = array('pesan'=>$msg, 
                        'status'=>$psn,
                        'url'=>$url,
                        'picname'=>$picname,
                        );
            echo json_encode($res);
            // var_dump($res);exit();

        
        // }
    }
    public function save_user()
    {
    	$callback = array(
 			'Data'	 => null,
 			'Error'  => false,
 			'Pesan'  => '',
 			'Status' => 200
 		);

 		$entity		= $this->session->userdata('Tsentity');
        $project 	= $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

        //Upload Foto
        // var_dump(expression)
        $assignpro = $this->input->post('project',TRUE);
        // var_dump(count($assignpro));
        // var_dump($assignpro);exit();
        $id = $this->input->post('id',TRUE);
        $groupcd = $this->input->post('groupcd',TRUE);
        $nik_id = $this->input->post('nik_id',TRUE);
        $staffid = $this->input->post('staffid',TRUE);
        $staffname = $this->input->post('staffname',TRUE);
        $email = $this->input->post('email',TRUE);
        $gender = $this->input->post('gender',TRUE);
        $div_cd = $this->input->post('div_cd',TRUE);
        $dept_cd = $this->input->post('dept_cd',TRUE);
        $handphone = $this->input->post('handphone',TRUE);
        $web = $this->input->post('web',TRUE);
        $meter = $this->input->post('meter',TRUE);
        $approval = $this->input->post('approval',TRUE);
        $activate = $this->input->post('activate',TRUE);
        $picturepath = $this->input->post('picturepath',TRUE);
        $picturename = $this->input->post('picturename',TRUE);

        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $randompass = $this->generateRandomString(6);
        // $randompass = 'pass1234';
        $emails = strtoupper(md5(strtolower($email)));
        $paswd = strtoupper(md5($randompass));
        $PS2 = $emails.'P@ssw0rd'.$paswd;
        $NewEmailPassword = strtoupper(md5($PS2));


        $tableuser = 'sysUser';

        $criteria = array('rowID' => $id);

        
       


        if($_POST){

        	if($id > 0) {
                // $sql = "SELECT * FROM mgr.sysUser  where email='$email'";
                // $dt = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
                // if(!empty($dt)){

                //     if($email==$dt[0]->email){
                //         $callback['Error'] = true;
                //         $callback['Pesan'] = 'Email is already used!';
                //     }
                  
                //     echo json_encode($callback);
                //     exit();
                // }

                        $datauser = array(
                            // 'userID' => $staffid,
                            // 'password'=>$NewEmailPassword, 
                            // 'COM'=>$NewEmailPassword, 
                            'name' => $staffname, 
                            'gender' => $gender, 
                            'email' => $email,
                            'Group_Cd' => $groupcd,
                            'Nik_id' => $nik_id,
                            'Handphone' => $handphone,
                            'dept_cd' => $dept_cd,
                            'div_cd' => $div_cd,
                            'status'=>$web,
                            'meter_apps'=>$meter,
                            'approval_apps'=>$approval,
                            'status_activate'=>$activate,
                            'pict'=>$picturepath,
                            // 'isResetLogin'=>true,
                            // 'audit_date'=> $audit_date,
                            // 'audit_user'=> $audit_user
                        );
                        $update = $this->m_wsbangun->updateData_cons('ifca3',$tableuser,$datauser,$criteria);
                        if($update=='OK'){
                            $callback['Error'] = false;
                            $callback['Pesan'] = 'Data has been updated successfully';
                        }else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = 'Fail updating data: '.$update;
                        }
                //     $query = "mgr.[x_send_mail_newuser] '".$email."',"."'".$name."',"."'".$randompass."'";
                //     $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
                //     $callback['Pesan'] = "Please cek your email";
                
	        }
	        else{
                $sql = "SELECT * FROM mgr.sysUser  where userID='$staffid'";
                $dt1 = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
                // var_dump($dt1);exit();
                if(!empty($dt1)){

                    if($staffid==$dt1[0]->userID){
                        $callback['Error'] = true;
                        $callback['Pesan'] = 'Staff ID is already used!';
                    }
                    echo json_encode($callback);
                    exit();
                }

                $sql = "SELECT * FROM mgr.sysUser  where email='$email'";
                $dt2 = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
                if(!empty($dt2)){

                    if($email==$dt2[0]->email){
                        $callback['Error'] = true;
                        $callback['Pesan'] = 'Email is already used!';
                    }
                  
                    echo json_encode($callback);
                    exit();
                }
          
                        $datauser = array(
                            'userID' => $staffid,
                            'password'=>$NewEmailPassword, 
                            'COM'=>$NewEmailPassword, 
                            'name' => $staffname, 
                            'gender' => $gender, 
                            'email' => $email,
                            'Group_Cd' => $groupcd,
                            'Nik_id' => $nik_id,
                            'Handphone' => $handphone,
                            'dept_cd' => $dept_cd,
                            'div_cd' => $div_cd,
                            'status'=>$web,
                            'meter_apps'=>$meter,
                            'approval_apps'=>$approval,
                            'status_activate'=>'N',
                            'pict'=>$picturepath,
                            'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableuser,$datauser);
                        if($insert=='OK'){
                            // $query = "mgr.[x_send_mail_newuser] '".$email."','".$staffname."','".$randompass."','".$cons."'";
                            // $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
                            $callback['Pesan'] = "Data has been saved successfully";   
                            $callback['Error'] = false;
                            // $callback['Pesan'] = 'Data has been updated successfully';
                        }else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = 'Fail inserting data: '.$insert;
                        }
       

                   
                }
                //start assign project
                if($callback['Error'] == false){
                    if(!empty($assignpro)||count($assignpro)>0){
                        // var_dump($staffid);exit();
                        $where=array('email'=>$email);
                        $delete = $this->m_wsbangun->deletedata_cons('ifca3','cfs_user_project',$where);
                        if($delete=='OK'){
                            foreach ($assignpro as $key) {
                                $a = explode('=&=', $key);
                                $entity_cd_assign = $a[0];
                                $project_no_assign = $a[1];
                                // var_dump($a);
                                 // var_dump($staffid);exit();
                                $datauserpro = array(
                                    'userID' => $staffid,
                                    'entity_cd'=>$entity_cd_assign, 
                                    'project_no' => $project_no_assign, 
                                    'email' => $email,
                                    'audit_date'=> $audit_date,
                                    'audit_user'=> $audit_user
                                );
                                $insert = $this->m_wsbangun->insertData_cons('ifca3','cfs_user_project',$datauserpro);
                            }
                            //exit();
                        }else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = 'Fail deleting cfs_user_project';
                        }
                        

                    }
                }

        }
        else{
        	$callback['Error'] = true;
	        $callback['Pesan'] = 'Data validation is not valid 2';
        }

        echo json_encode($callback);

    }
    public function save_activate()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Error_activate'  => false,
            'Error_non'  => false,
            'Pesan'  => '',
            'Status' => 200
        );
        $msg_non='';$msg_act='';
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

    
        $id = $this->input->post('id',TRUE);
        $staffid = $this->input->post('staffid',TRUE);
        $staffname = $this->input->post('staffname',TRUE);
        $email = $this->input->post('email',TRUE);

        $web_stat_before = $this->input->post('web_stat_before',TRUE);
        $meter_stat_before = $this->input->post('meter_stat_before',TRUE);
        $approval_stat_before = $this->input->post('approval_stat_before',TRUE);

        $web_stat_after = $this->input->post('web_stat_after',TRUE);
        $meter_stat_after = $this->input->post('meter_stat_after',TRUE);
        $approval_stat_after = $this->input->post('approval_stat_after',TRUE);

        $randompass = $this->generateRandomString(6);
        // $randompass = 'pass1234';
        $emails = strtoupper(md5(strtolower($email)));
        $paswd = strtoupper(md5($randompass));
        $PS2 = $emails.'P@ssw0rd'.$paswd;
        $NewEmailPassword = strtoupper(md5($PS2));
        
        $activate = array();
        $nonactive = array();


        if($_POST){
            // if($web_stat_before!==$web_stat_after){
                if($web_stat_before=='Y'){
                    array_push($activate, 'web');
                }
                // if($web_stat_before=='N'){
                //     array_push($nonactive, 'web');
                // }
            // }
            // if($meter_stat_before!==$meter_stat_after){
                if($meter_stat_before=='Y'){
                    array_push($activate, 'meter');
                }
                // if($web_stat_before=='N'){
                //     array_push($nonactive, 'meter');
                // }
            // }
            // if($approval_stat_before!==$approval_stat_after){
                if($approval_stat_before=='Y'){
                    array_push($activate, 'approval');
                }
                // if($web_stat_before=='N'){
                //     array_push($nonactive, 'approval');
                // }
            // }
            // var_dump($activate);exit();
            $query = "UPDATE mgr.sysUser set status_activate='Y',password = mgr.fn_generatepassword('".$email."',"."'".$randompass."'),COM = mgr.fn_generatepassword('".$email."',"."'".$randompass."'),isResetLogin='1' where rowID = '$id'";
            $update = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
            if($update=='OK'){
                if(count($activate)>0){
                    $access_activated ='';$no_act = 1;
                    foreach ($activate as $key) {
                        $and = ' ';
                        if(count($activate)>1){
                            if(count($activate)==$no_act-1){
                                $and = ' and ';
                            }
                        }
                        if($key=='web'){
                            $access_activated .=$and."IFCA Website,";
                        }
                        if($key=='meter'){
                            $access_activated .=$and."Meter Apps,";
                        }
                        if($key=='approval'){
                            $access_activated .=$and."Approval Apps,";
                        }
                        
                        $no_act++;
                    }
                    $access_activated=substr($access_activated,0,-1);
                    $query = "[mgr].[x_send_mail_newuser] '".$email."','".$staffname."','".$randompass."','".$access_activated."','".$cons."'";
                    $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
           
                    $aaa = strpos($PsnMail,'queued');
                    // var_dump($aaa);exit;
                    if( $aaa <= 0 || !$aaa){
                        if($PsnMail=='OK'){
                            $callback['Error'] = false;
                            $callback['Pesan']  = 'Data has been saved successfully';
                   
                        }else{
                            $callback['Error'] = true;
                            $callback['Pesan']  = 'Fail send email: '.$PsnMail;
                        }
                        
                    }else{
                        $callback['Error'] = false;
                        $callback['Pesan']  = 'Data has been saved successfully';
                    }

                }else{
                    $callback['Error'] = true;
                    $callback['Pesan'] = 'Please edit and give access first to activate this user';
                }
             
            }else{
                $callback['Error'] = true;
                $callback['Pesan'] = 'Fail updating data: '.$update;
            }

      


        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid 2';
        }

        echo json_encode($callback);

    }
    // public function save_activate_old()
    // {
    //     $callback = array(
    //         'Data'   => null,
    //         'Error'  => false,
    //         'Error_activate'  => false,
    //         'Error_non'  => false,
    //         'Pesan'  => '',
    //         'Status' => 200
    //     );
    //     $msg_non='';$msg_act='';
    //     $entity     = $this->session->userdata('Tsentity');
    //     $project    = $this->session->userdata('Tsproject');
    //     $cons       = $this->session->userdata('Tscons');

    
    //     $id = $this->input->post('id',TRUE);
    //     $staffid = $this->input->post('staffid',TRUE);
    //     $staffname = $this->input->post('staffname',TRUE);
    //     $email = $this->input->post('email',TRUE);

    //     $web_stat_before = $this->input->post('web_stat_before',TRUE);
    //     $meter_stat_before = $this->input->post('meter_stat_before',TRUE);
    //     $approval_stat_before = $this->input->post('approval_stat_before',TRUE);

    //     $web_stat_after = $this->input->post('web_stat_after',TRUE);
    //     $meter_stat_after = $this->input->post('meter_stat_after',TRUE);
    //     $approval_stat_after = $this->input->post('approval_stat_after',TRUE);

    //     $randompass = $this->generateRandomString(6);
        
    //     $activate = array();
    //     $nonactive = array();


    //     if($_POST){
    //         if($web_stat_before!==$web_stat_after){
    //             if($web_stat_after=='Y'){
    //                 array_push($activate, 'web');
    //             }
    //             if($web_stat_after=='N'){
    //                 array_push($nonactive, 'web');
    //             }
    //         }
    //         if($meter_stat_before!==$meter_stat_after){
    //             if($meter_stat_after=='Y'){
    //                 array_push($activate, 'meter');
    //             }
    //             if($meter_stat_after=='N'){
    //                 array_push($nonactive, 'meter');
    //             }
    //         }
    //         if($approval_stat_before!==$approval_stat_after){
    //             if($approval_stat_after=='Y'){
    //                 array_push($activate, 'approval');
    //             }
    //             if($approval_stat_after=='N'){
    //                 array_push($nonactive, 'approval');
    //             }
    //         }
   
    //         $query = "UPDATE mgr.sysUser set Status='$web_stat_after',meter_apps='$meter_stat_after',approval_apps='$approval_stat_after' where rowID = '$id'";
    //         $update = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
    //         if($update=='OK'){
    //             if(count($activate)>0){
    //                 $access_activated ='';$no_act = 1;
    //                 foreach ($activate as $key) {
    //                     if($key=='web'){
    //                         $access_activated .=$no_act.". IFCA Website.<br>";
    //                     }
    //                     if($key=='meter'){
    //                         $access_activated .=$no_act.". Meter Apps.<br>";
    //                     }
    //                     if($key=='approval'){
    //                         $access_activated .=$no_act.". Approval Apps.<br>";
    //                     }
    //                     $no_act++;
    //                 }
    //                 $query = "[mgr].[x_send_mail_activate] '".$email."','".$staffname."','".$access_activated."','".$cons."'";
    //                 $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
           
    //                 $aaa = strpos($PsnMail,'queued');
    //                 // var_dump($aaa);exit;
    //                 if( $aaa <= 0 || !$aaa){
    //                     if($PsnMail=='OK'){
    //                         $callback['Error_activate'] = false;
    //                         $msg_act = 'Data has been saved successfully';
                   
    //                     }else{
    //                         $callback['Error_activate'] = true;
    //                         $msg_act = 'Fail send email: '.$PsnMail;
    //                     }
                        
    //                 }else{
    //                     $callback['Error_activate'] = false;
    //                     $msg_act = 'Data has been saved successfully';
    //                 }

    //             }
    //             if(count($nonactive)>0){
    //                 $access_nonactivated ='';$no_nonact = 1;
    //                 foreach ($nonactive as $key) {
    //                     if($key=='web'){
    //                         $access_nonactivated .=$no_nonact.". IFCA Website.<br>";
    //                     }
    //                     if($key=='meter'){
    //                         $access_nonactivated .=$no_nonact.". Meter Apps.<br>";
    //                     }
    //                     if($key=='approval'){
    //                         $access_nonactivated .=$no_nonact.". Approval Apps.<br>";
    //                     }
    //                     $no_nonact++;
    //                 }
    //                 $query = "[mgr].[x_send_mail_nonactivate] '".$email."','".$staffname."','".$access_nonactivated."','".$cons."'";
    //                 $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
           
    //                 $aaa = strpos($PsnMail,'queued');
    //                 // var_dump($aaa);exit;
    //                 if( $aaa <= 0 || !$aaa){
    //                     if($PsnMail=='OK'){
    //                         $callback['Error_non'] = false;
    //                         $msg_non = 'Data has been saved successfully';
                   
    //                     }else{
    //                         $callback['Error_non'] = true;
    //                         $msg_non= 'Fail send email: '.$PsnMail;
    //                     }
                        
    //                 }else{
    //                     $callback['Error_non'] = false;
    //                     $msg_non = 'Data has been saved successfully';
    //                 }
    //             }
    //             if($callback['Error_activate']==false&&$callback['Error_non']==false){
    //                 $callback['Error'] = false;
    //                 $callback['Pesan'] = 'Data has been saved successfully';
    //             }else{
    //                 if($callback['Error_activate']==true){
    //                     $callback['Error'] = true;
    //                     $callback['Pesan'] = 'Fail send email activation:'.$msg_act;
    //                 }
    //                 if($callback['Error_non']==true){
    //                     $callback['Error'] = true;
    //                     $callback['Pesan'] = 'Fail send email deactivation:'.$msg_non;
    //                 }
    //             }

    //         }else{
    //             $callback['Error'] = true;
    //             $callback['Pesan'] = 'Fail updating data: '.$update;
    //         }

      


    //     }
    //     else{
    //         $callback['Error'] = true;
    //         $callback['Pesan'] = 'Data validation is not valid 2';
    //     }

    //     echo json_encode($callback);

    // }
    public function resetpass()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $cons       = $this->session->userdata('Tscons');

    
        $id = $this->input->post('id',TRUE);
        $staffid = $this->input->post('staffid',TRUE);
        $staffname = $this->input->post('staffname',TRUE);
        $email = $this->input->post('email',TRUE);



        $randompass = $this->generateRandomString(6);
        // $randompass = 'pass1234';
        // $emails = strtoupper(md5(strtolower($staffid)));
        // $paswd = strtoupper(md5($randompass));
        // $PS2 = $emails.'P@ssw0rd'.$paswd;
        // $NewEmailPassword = strtoupper(md5($PS2));

        // var_dump($_POST);exit();
        if($_POST){

   
            $query = "UPDATE mgr.sysUser set password = mgr.fn_generatepassword('".$email."',"."'".$randompass."'),COM = mgr.fn_generatepassword('".$email."',"."'".$randompass."'), isResetLogin=1 where rowID = '$id'";
            $update = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
            if($update=='OK'){
                $query = "[mgr].[x_send_mail_resetpass] '".$email."',"."'".$staffname."','".$staffid."',"."'".$randompass."',"."'".$cons."'";
                $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
           
                $aaa = strpos($PsnMail,'queued');
                // var_dump($aaa);exit;
                if( $aaa <= 0 || !$aaa){
                    if($PsnMail=='OK'){
                        $callback['Error'] = false;
                        $callback['Pesan'] = 'Password reset successfully. Please check your email.';
               
                    }else{
                        $callback['Error'] = true;
                        $callback['Pesan'] = 'Fail send email: '.$PsnMail;
                    }
                    
                }else{
                    $callback['Error'] = false;
                    $callback['Pesan'] = 'Password reset successfully. Please check your email.';
                }
                

            }else{
                $callback['Error'] = true;
                $callback['Pesan'] = 'Fail updating data: '.$update;
            }

      


        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid 2';
        }

        echo json_encode($callback);

    }
    // -------- DELETE --------
    public function delete()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $cons   = $this->session->userdata('Tscons');
        $id     = $this->input->post("id",true);
        $table = $this->input->post("table",true);
        
        if(empty($id)){
            $id=0;
        }

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedata_cons($cons,$table,$where);
        $callback['Pesan'] = 'Data has been deleted successfully';
        echo json_encode($callback);
    }
}