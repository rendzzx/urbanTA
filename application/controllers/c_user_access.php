<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_User_Access extends Core_Controller
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
        $this->load_content_top_menu('user_access/index');
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
        
        $aColumns  = array('email','name','Group_Cd','Handphone','wa_no');

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
        $param = " where rowID > 0 ".$filter_search;
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
        $table  = 'sysuser';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);

        echo json_encode($data);
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

    public function zoombusiness($id)
    {
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_business';

        $where=array('business_id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        echo json_encode($data);

    }

    public function zoomstaff($id)
    {
        $cons = $this->session->userdata('Tscons');
        $table = 'cf_staff';

        $where=array('staff_id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        echo json_encode($data);

    }

    public function adduser()
    {
        $cons   = $this->session->userdata('Tscons');

        $sql = "SELECT * FROM mgr.cf_business";
        $sql2 = "SELECT * FROM mgr.cf_staff";
        $sql3 = "SELECT * FROM mgr.pl_project where status='1'";

        $business = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $staff = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $project = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql3);

        $content = array(
            'business'=>$business,
            'project'=>$project,
            'staff'=>$staff,
        );
        
    	$this->load->view('user_access/add',$content);
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
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

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

        $id = $this->input->post('id',TRUE);
        $int = $this->input->post('int',TRUE);
        $groupcd = $this->input->post('groupcd',TRUE);
        $businessid = $this->input->post('businessid',TRUE);
        $staffid = $this->input->post('staffid',TRUE);
        $name = $this->input->post('name',TRUE);
        $staffname = $this->input->post('staffname',TRUE);
        $email = $this->input->post('email',TRUE);
        $coname = $this->input->post('coname',TRUE);
        $contactperson = $this->input->post('contactperson',TRUE);
        $handphone = $this->input->post('handphone',TRUE);
        $whatsapp = $this->input->post('whatsapp',TRUE);
        $notifsms = $this->input->post('notifsms',TRUE);
        $notifemail = $this->input->post('notifemail',TRUE);
        $norifwa = $this->input->post('norifwa',TRUE);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $project1 = $this->input->post('project1',TRUE);
        $project2 = $this->input->post('project2',TRUE);
        $project3 = $this->input->post('project3',TRUE);

        $randompass = $this->generateRandomString(6);
        $emails = strtoupper(md5($email));
        $paswd = strtoupper(md5($randompass));
        $PS2 = $emails.'P@ssw0rd'.$paswd;
        $NewEmailPassword = strtoupper(md5($PS2));


        $tableuser = 'sysuser';
        $tableproject = 'cfs_user_project';

        $criteria = array('rowID' => $id);

        if($_POST){
        	if($id > 0) {
                if ($uploadOk == 1) {
                    if ($groupcd=='Debtor') {
                        $datauser = array(
                            'Group_Cd' => $groupcd, 
                            'business_id' => $businessid, 
                            'name' => $name, 
                            'email' => $email,
                            'Handphone' => $handphone,
                            'wa_no' => $whatsapp,
                            'menu_type' => 'L',
                            'status' => 'S',
                            'pict' => $image,
                            'notif_sms' => $notifsms, 
                            'notif_email' => $notifemail, 
                            'notif_wa' => $norifwa,
                            // 'COM'=>$NewEmailPassword,
                            // 'password'=>$NewEmailPassword,
                            // 'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableuser,$datauser,$criteria);

                        if ($project1) {
                            $dataproject1 = explode(',',$project1);
                            $databusiness = array(
                                'userid'    => $businessid,
                                'entity_cd' => $dataproject1[0],
                                'project_no'=> $dataproject1[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableproject,$databusiness,$criteria);
                        }
                        if ($project2) {
                            $dataproject2 = explode(',',$project2);
                            $databusiness = array(
                                'userid'    => $businessid,
                                'entity_cd' => $dataproject2[0],
                                'project_no'=> $dataproject2[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableproject,$databusiness,$criteria);
                        }
                        if ($project3) {
                            $dataproject3 = explode(',',$project3);
                            $databusiness = array(
                                'userid'    => $businessid,
                                'entity_cd' => $dataproject3[0],
                                'project_no'=> $dataproject3[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableproject,$databusiness,$criteria);
                        }
                    }
                    else{
                        $datauser = array(
                            'Group_Cd' => $groupcd, 
                            'business_id' => $businessid, 
                            'name' => $staffname, 
                            'email' => $email,
                            'Handphone' => $handphone,
                            'wa_no' => $whatsapp,
                            'menu_type' => 'L',
                            'status' => 'S',
                            'pict' => $image,
                            'notif_sms' => $notifsms, 
                            'notif_email' => $notifemail, 
                            'notif_wa' => $norifwa,
                            // 'COM'=>$NewEmailPassword,
                            // 'password'=>$NewEmailPassword,
                            // 'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableuser,$datauser,$criteria);

                        if ($project1) {
                            $dataproject1 = explode(',',$project1);
                            $databusiness = array(
                                'userid'    => $staffid,
                                'entity_cd' => $dataproject1[0],
                                'project_no'=> $dataproject1[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableproject,$databusiness,$criteria);
                        }
                        if ($project2) {
                            $dataproject2 = explode(',',$project2);
                            $databusiness = array(
                                'userid'    => $staffid,
                                'entity_cd' => $dataproject2[0],
                                'project_no'=> $dataproject2[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableproject,$databusiness,$criteria);
                        }
                        if ($project3) {
                            $dataproject3 = explode(',',$project3);
                            $databusiness = array(
                                'userid'    => $staffid,
                                'entity_cd' => $dataproject3[0],
                                'project_no'=> $dataproject3[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableproject,$databusiness,$criteria);
                        }
                    }

                //     $query = "mgr.[x_send_mail_newuser] '".$email."',"."'".$name."',"."'".$randompass."'";
                //     $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
                //     $callback['Pesan'] = "Please cek your email";
                }
	        }
	        else{
                if ($uploadOk == 1) {
                    if ($groupcd=='Debtor') {
                        $datauser = array(
                            'Group_Cd' => $groupcd, 
                            'business_id' => $businessid, 
                            'name' => $name, 
                            'email' => $email,
                            'Handphone' => $handphone,
                            'wa_no' => $whatsapp,
                            'menu_type' => 'L',
                            'status' => 'S',
                            'pict' => base_url('img/user/').$image,
                            'notif_sms' => $notifsms, 
                            'notif_email' => $notifemail, 
                            'notif_wa' => $norifwa,
                            'COM'=>$NewEmailPassword,
                            'password'=>$NewEmailPassword,
                            'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableuser,$datauser);

                        if ($project1) {
                            $dataproject1 = explode(',',$project1);
                            $databusiness = array(
                                'userid'    => $businessid,
                                'entity_cd' => $dataproject1[0],
                                'project_no'=> $dataproject1[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableproject,$databusiness);
                        }
                        if ($project2) {
                            $dataproject2 = explode(',',$project2);
                            $databusiness = array(
                                'userid'    => $businessid,
                                'entity_cd' => $dataproject2[0],
                                'project_no'=> $dataproject2[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableproject,$databusiness);
                        }
                        if ($project3) {
                            $dataproject3 = explode(',',$project3);
                            $databusiness = array(
                                'userid'    => $businessid,
                                'entity_cd' => $dataproject3[0],
                                'project_no'=> $dataproject3[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableproject,$databusiness);
                        }
                    }
                    else{
                        $datauser = array(
                            'Group_Cd' => $groupcd, 
                            'business_id' => $businessid, 
                            'name' => $staffname, 
                            'email' => $email,
                            'Handphone' => $handphone,
                            'wa_no' => $whatsapp,
                            'menu_type' => 'L',
                            'status' => 'S',
                            'pict' => base_url('img/user/').$image,
                            'notif_sms' => $notifsms, 
                            'notif_email' => $notifemail, 
                            'notif_wa' => $norifwa,
                            'COM'=>$NewEmailPassword,
                            'password'=>$NewEmailPassword,
                            'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableuser,$datauser);

                        if ($project1) {
                            $dataproject1 = explode(',',$project1);
                            $databusiness = array(
                                'userid'    => $staffid,
                                'entity_cd' => $dataproject1[0],
                                'project_no'=> $dataproject1[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableproject,$databusiness);
                        }
                        if ($project2) {
                            $dataproject2 = explode(',',$project2);
                            $databusiness = array(
                                'userid'    => $staffid,
                                'entity_cd' => $dataproject2[0],
                                'project_no'=> $dataproject2[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableproject,$databusiness);
                        }
                        if ($project3) {
                            $dataproject3 = explode(',',$project3);
                            $databusiness = array(
                                'userid'    => $staffid,
                                'entity_cd' => $dataproject3[0],
                                'project_no'=> $dataproject3[1],
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user,
                                'email'=> $email
                            );
                            $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableproject,$databusiness);
                        }
                    }

                //     $query = "mgr.[x_send_mail_newuser] '".$email."',"."'".$name."',"."'".$randompass."'";
                //     $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
                //     $callback['Pesan'] = "Please cek your email";
                }
                else{
                    $callback['Error'] = true;
                    $callback['Pesan'] = 'Data validation is not valid 1'; 
                }
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