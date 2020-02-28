<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Approvaldash extends Core_Controller
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
         $param = $this->uri->segment(3);
        $paramDcd = base64_decode($param);
        

        if(empty($paramDcd)) {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname') ;
        } else {
            $email = $this->session->userdata('Tsemail');
            $b = explode("-%-", $paramDcd);
            // $project_no = substr($paramDcd, 0,$a);
            // var_dump($b);
            $project_no = $b[0];
            $projectName = $b[1];
            $dbprofile = $b[2];
            // var_dump($b);exit();
            
            
            
            $Squery ="select max(entity_cd) as entity_cd ,max(entity_name) as entity_name from mgr.v_cfs_user_project where project_no ='$project_no' ";            
            $dd = $this->m_wsbangun->getData_by_query_cons($dbprofile,$Squery);
            // var_dump($Squery);var_dump($dd);
            $entity = $dd[0]->entity_cd;
            $entity_name = $dd[0]->entity_name;

       
            $position ='T';
 
            $this->session->set_userdata('TMenuPs',$position);
            $this->session->set_userdata('Tsentityname',$entity_name);
            $this->session->set_userdata('Tsentity', $entity);              
            $this->session->set_userdata('Tsproject', $project_no);            
            $this->session->set_userdata('Tsprojectname', $projectName);
            $this->session->set_userdata('Tscons', $dbprofile);
        }      
        
        $cons = $this->session->userdata('Tscons');
        $user_id = $this->session->userdata('Tsname');
        $user_email = $this->session->userdata('Tsemail'); 
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $content = array(
            'projectName'=>$projectName);
        
        // $this->load_content_top_menu('dash/dash_ot',$content);
        $this->load_content_top_menu('dash_approval/index',$content);
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
        
        $aColumns  = array('email','name','Group_Cd','Handphone','Nik_id');

        $sTable = 'mgr.sysuserAppr';

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
        $table  = 'sysUserAppr';

        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons('ifca3',$table,$where);
        $userid = $data[0]->userID;

        $where=array('userID'=>$userid);
        $datapro = $this->m_wsbangun->getData_by_criteria_cons('ifca3','v_user_project_appr',$where);
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
        $sql3 = "SELECT * FROM mgr.sysGroupAppr";

        $project = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $staff = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $group = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql3);

        $content = array(
            'project'=>$project,
            'group'=>$group,
            'staff'=>$staff,
        );
        
    	$this->load->view('dash_approval/add',$content);
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
        // $isFile  =$this->input->post('isFile',TRUE);

        // $uploadOk = 1;
        // $image  = $this->input->post('image',TRUE);

        // if($isFile=="true"){

        //     $image = str_replace(' ', '_', $image);
        //     $image = base_url('img/user/').$image;

        //     $picture = $_FILES["userfile"];
        //     $target_dir = "./img/user/";
        //     $target_file = $target_dir . str_replace(' ','_',basename($_FILES["userfile"]["name"]));
        //     $uploadOk = 1;
        //     $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        //     if(isset($_POST["submit"])) {
        //         $check = getimagesize($_FILES["userfile"]["tmp_name"]);
        //         if($check !== false) {
        //             $callback['Pesan'] = "File is an image - " . $check["mime"] . ".";
        //             $uploadOk = 1;
        //         } else {
        //             $callback['Error'] = true;
        //             $callback['Pesan'] = "File is not an image.";
        //             $uploadOk = 0;
        //         }

        //         $callback['Data'] = 'Failed';                        

        //         echo json_encode($callback);
        //         exit();
        //     }

        //     if ($_FILES["userfile"]["size"] > 300000) {
        //         $callback['Error'] = true;
        //         $callback['Pesan'] = "Maximum file size is 300kb";
        //         $uploadOk = 0;
        //         $callback['Data'] = 'failed';

        //         echo json_encode($callback);
        //         exit();
        //     }

        //     if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" ) {
        //         $callback['Error'] = true;
        //         $callback['Pesan'] ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //         $uploadOk = 0;
        //         $callback['Data'] = 'failed';

        //         echo json_encode($callback);
        //         exit();
        //     }

        //     if ($uploadOk == 0) {
        //         $callback['Error'] = true;
        //         $callback['Pesan'] = "Sorry, your file was not uploaded.";
        //     }
        //     else {
        //         if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
        //             $callback['Pesan'] = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
        //         }
        //         else {
        //             $callback['Error'] = true;
        //             $callback['Pesan'] = "Sorry, there was an error uploading your file.";
        //         }
        //     }
        // }
        $assignpro = $this->input->post('project',TRUE);
        // var_dump(count($assignpro));
        // var_dump($assignpro);exit();
        $id = $this->input->post('id',TRUE);
        $groupcd = $this->input->post('groupcd',TRUE);
        $nik_id = $this->input->post('nik_id',TRUE);
        $staffid = $this->input->post('staffid',TRUE);
        $staffname = $this->input->post('staffname',TRUE);
        $email = $this->input->post('email',TRUE);
        $div_cd = $this->input->post('div_cd',TRUE);
        $dept_cd = $this->input->post('dept_cd',TRUE);
        $handphone = $this->input->post('handphone',TRUE);

        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $randompass = $this->generateRandomString(6);
        // $randompass = 'pass1234';
        $emails = strtoupper(md5(strtolower($staffid)));
        $paswd = strtoupper(md5($randompass));
        $PS2 = $emails.'P@ssw0rd'.$paswd;
        $NewEmailPassword = strtoupper(md5($PS2));


        $tableuser = 'sysUserAppr';

        $criteria = array('rowID' => $id);

        if($_POST){
        	if($id > 0) {
  

                        $datauser = array(
                            // 'userID' => $staffid,
                            // 'password'=>$NewEmailPassword, 
                            'name' => $staffname, 
                            'email' => $email,
                            'Group_Cd' => $groupcd,
                            'Nik_id' => $nik_id,
                            'Handphone' => $handphone,
                            'dept_cd' => $dept_cd,
                            'div_cd' => $div_cd,
                            // 'LastActivityDate'=>$audit_date,
                            // 'status'=>'S',
                            // 'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->updateData_cons('ifca3',$tableuser,$datauser,$criteria);
                        if($insert=='OK'){
                            $callback['Error'] = false;
                            $callback['Pesan'] = 'Data has been updated successfully';
                        }else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = 'Fail updating data';
                        }
                //     $query = "mgr.[x_send_mail_newuser] '".$email."',"."'".$name."',"."'".$randompass."'";
                //     $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
                //     $callback['Pesan'] = "Please cek your email";
                
	        }
	        else{
         
          
                        $datauser = array(
                            'userID' => $staffid,
                            'password'=>$NewEmailPassword, 
                            'name' => $staffname, 
                            'email' => $email,
                            'Group_Cd' => $groupcd,
                            'Nik_id' => $nik_id,
                            'Handphone' => $handphone,
                            'dept_cd' => $dept_cd,
                            'div_cd' => $div_cd,
                            'LastActivityDate'=>$audit_date,
                            'status'=>'S',
                            'isResetLogin'=>true,
                            'audit_date'=> $audit_date,
                            'audit_user'=> $audit_user
                        );
                        $insert = $this->m_wsbangun->insertData_cons('ifca3',$tableuser,$datauser);
                        if($insert=='OK'){
                            $query = "mgr.[x_send_mail_newuser_appr] '".$email."',"."'".$staffname."',"."'".$randompass."'";
                            $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
                            $callback['Pesan'] = "Please cek your email";   
                            $callback['Error'] = false;
                            // $callback['Pesan'] = 'Data has been updated successfully';
                        }else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = 'Fail updating data';
                        }
       

                   
                }
                //start assign project
                if($callback['Error'] == false){
                    if(!empty($assignpro)||count($assignpro)>0){
                        // var_dump($staffid);exit();
                        $where=array('userID'=>$staffid);
                        $delete = $this->m_wsbangun->deletedata_cons('ifca3','cfs_user_project_appr',$where);
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
                                $insert = $this->m_wsbangun->insertData_cons('ifca3','cfs_user_project_appr',$datauserpro);
                            }
                            //exit();
                        }else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = 'Fail deleting cfs_user_project_appr';
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