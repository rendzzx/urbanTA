<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_cs extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }

    public function insert($rowID=0)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
        $group = $this->session->userdata('Tsusergroup');
        $projectName = $this->session->userdata('Tsprojectname');
        $email = $this->session->userdata('Tsemail');
        $userID = $this->session->userdata('Tsuser_id');

        // var_dump($cons);exit();
        // var_dump("-- userid: ".$userID."<br>-- email: ".$email);exit();
        $table = 'sv_spec(nolock)';
        $crit = array('entity_cd'=>$entity,
                       'project_no' => $project,
                     );
        $dtE = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
        // var_dump($dtE);
        // exit;
        if(!empty($dtE)){
            $seq_no_ticket = (int) $dtE[0]->seq_no_ticket;
            $visitor_acct = $dtE[0]->visitor_acct;
            $upseq = intval($seq_no_ticket) + 1;
            // $sql = "UPDATE mgr.sv_spec SET seq_no_ticket = ".$upseq." WHERE entity_cd='".$entity."' and project_no='".$project."'";
            // $dupdate = $this->m_wsbangun->setData_by_query_cons($cons,$sql);
        } else {
            $visitor_acct = '';
            $seq_no_ticket = '---';
        }

      
        // var_dump($dupdate);

        // $name = '7-A06';
        // $email = 'debtor@ifca.co.id';
        // if($group=='DEBTOR'){
        //     $table = 'v_logindebtor';
        //     $crit = array('rowID'=>$name);
        //     // $crit = array('debtor_acct'=>$name);
        //     $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);
        // } else {
        //     $DataMenu='';
        // }
        // var_dump($name);exit();
       
        // var_dump($userID);
        // $table = 'v_logindebtor';
        // $crit = array('email_addr'=>$email);
        // // $crit = array('debtor_acct'=>$name);
        // $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);        
        // $debtor_acct = $DataMenu[0]->debtor_acct;
        if($group!='DEBTOR'){
            // var_dump('expression');
            $dsb = 'false';
            // $notelp =  '';
            $datadebtor = $this->zoom_debtor("");
            $datalot = '';
        }else{
            // $notelp =  $DataMenu[0]->hand_phone;
            // if(count($DataMenu)>0){
            //     $dsb = 'false';    
            // } else {
                $dsb = 'false';    
            // }
            $Business_id = $this->session->userdata('TsbusinessId');
            // var_dump($Business_id);
            // exit();
            $datadebtor = $this->zoom_debtor($Business_id);
            // $datadebtor = $this->zoom_debtor("");
            $datalot = $this->zoom_lot_no_in($Business_id);

        }
        // var_dump($dsb);exit();
        

        $content = array(
            'dtdebtor'=>$datadebtor,
            'ddx'=>$dsb,
            'seq_no_ticket'=>$seq_no_ticket,
            'visitor_acct'=>$visitor_acct,
            'rowID'=>$rowID,
            'datacomplain'=>$this->zoom_complain_in(),
            'datacategory'=>'',
            'datalot'=>$datalot,
            'ProjectDescs'=>$projectName);
        
        $this->load_content_top_menu('cs/insert_cs',$content);
    }
    public function zoom_complain_in(){
    
       
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $cons = $this->session->userdata('Tscons');
        

        $sqlad = "SELECT * from mgr.sv_complain_source where complain_source <> (select complain_source from mgr.sv_spec where entity_cd='$entity' and project_no='$project')";        
        $dtComplain = $this->m_wsbangun->getData_by_query_cons($cons,$sqlad);

        $comboProject[] = '<option value=""></option>';
            if(!empty($dtComplain)) {
                $comboProject[] = '<option></option>';
                foreach ($dtComplain as $key) {
                  // if($debtor_acct === $key->lot_no) {
                  //   $pilih = ' selected = "1"';
                  // } else {
                  //   $pilih = '';
                  // }
                    $comboProject[] = '<option  value="'.$key->complain_source.'" >'.$key->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
      }
    public function zoom_category_from(){
  
        $project = $this->session->userdata('Tsproject'); 
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        if($_POST)
        {
            $type_cd = $this->input->post('prod', TRUE);
            
            if(empty($type_cd)) {
                echo('<option></option>');
            } else {
               
                
                $sqlad = "SELECT category_cd,descs,complain_type,user_spv from mgr.sv_category(nolock) where complain_type ='$type_cd'";        
                $dtDebtor = $this->m_wsbangun->getData_by_query_cons($cons,$sqlad);

                $list = '';$pilih='';
                if(!empty($dtDebtor)) {
                    $list = '<option></option>';
                    foreach ($dtDebtor as $key) {
                        if($type_cd==$key->complain_type){
                            $pilih = 'selected="true"';
                        }
                        $list.='<option value="'.$key->category_cd.'" '.$pilih.' data-spv="'.$key->user_spv.'">'.$key->descs.'</option>';
                    }
                }
                echo($list);
            }
        }
    }
    public function application($rowID=0)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
        $group = $this->session->userdata('Tsusergroup');
        $projectName = $this->session->userdata('Tsprojectname');
        $email = $this->session->userdata('Tsemail');
        $userID = $this->session->userdata('Tsuser_id');

        // $rowID = $rowID?'1':$rowID;

        // var_dump($rowID);exit();
        // var_dump($userID."-- name: ".$name);exit();
        $table = 'sv_spec(nolock)';
        $crit = array('entity_cd'=>$entity,
                       'project_no' => $project,
                     );
        $dtE = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
        // var_dump($dtE);
        // exit;
        if(!empty($dtE)){
            //ini seqno buat attachment/gambarnya
            $seq_no_ticket = (int) $dtE[0]->seq_no_ticket;
            $upseq = intval($seq_no_ticket) + 1;
            
        } else {
            $seq_no_ticket = '---';
        }


        if($group!='DEBTOR'){
            // var_dump('expression');
            $dsb = 'false';
            $datadebtor = $this->zoom_debtor("");
            $datalot = '';
        }else{

                $dsb = 'false';    
            // }
            $Business_id = $this->session->userdata('TsbusinessId');
            // var_dump($Business_id);
            // exit();
            $datadebtor = $this->zoom_debtor($Business_id);
            $datalot = $this->zoom_lot_no_in($Business_id);

        }
        // var_dump($dsb);exit();
        

        $content = array(
            'dtdebtor'=>$datadebtor,
            'ddx'=>$dsb,
            'seq_no_ticket'=>$seq_no_ticket,
            'rowID'=>$rowID,
            'datacomplain'=>$this->zoom_complain_in(),
            'datacategory'=>'',
            'datalot'=>$datalot,
            'ProjectDescs'=>$projectName);
        
        $this->load_content_top_menu('cs/aplication',$content);
    }
    public function getById($id){
        // $where=array('rowID'=>$id);
        // $data = $this->m_wsbangun->getData_by_criteria('sv_entry_multi',$where);
        $sql = "SELECT sem.debtor_acct,sem.complain_no,sem.work_requested,sem.location,sem.floor,sem.serv_req_by,sem.contact_no,sem.[status],sem.lot_no,sem.report_no,sem.complain_type,sem.category_cd,sat.file_url ";
        $sql .= "FROM mgr.sv_entry_multi AS sem WITH(NOLOCK) ";
        $sql .= "LEFT OUTER JOIN mgr.sv_attachment AS sat WITH(NOLOCK) ";
        $sql .= "ON sem.entity_cd = sat.entity_cd ";
        $sql .= "AND sem.project_no = sat.project_no ";
        $sql .= "AND sem.seq_no_ticket = sat.sv_entryhd_rowid ";
        $sql .= " WHERE sem.rowID = '$id' ";
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        echo json_encode($data);
    }
    
    public function zoom_debtor($debtor_acct){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        // $this->load->model('m_wsbangun'); 
        $sql = "SELECT mgr.ar_debtor.debtor_acct,
        mgr.ar_debtor.name
        from mgr.ar_debtor
        inner join mgr.cf_business
        on mgr.ar_debtor.business_id=mgr.cf_business.business_id
        where mgr.ar_debtor.entity_cd='$entity'
        and mgr.ar_debtor.project_no='$project'";
        $cons = $this->session->userdata('Tscons');

        if(empty($debtor_acct) or $debtor_acct==''){
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project );
        } else {
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$debtor_acct );
        }
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($debtor_acct === $dtProject->debtor_acct) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->debtor_acct.'">'.$dtProject->debtor_acct.'-'.$dtProject->name.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
      }

      public function zoom_debtor_from($debtor_acct=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        // $this->load->model('m_wsbangun'); 
        $sql = "SELECT mgr.ar_debtor.debtor_acct,
        mgr.ar_debtor.name
        from mgr.ar_debtor
        inner join mgr.cf_business
        on mgr.ar_debtor.business_id=mgr.cf_business.business_id
        where mgr.ar_debtor.entity_cd='$entity'
        and mgr.ar_debtor.project_no='$project'";
        $cons = $this->session->userdata('Tscons');

        if(empty($debtor_acct) or $debtor_acct==''){
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project );
        } else {
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project,
                    'debtor_acct'=>$debtor_acct );
        }
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($debtor_acct === $dtProject->debtor_acct) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->debtor_acct.'">'.$dtProject->debtor_acct.'-'.$dtProject->name.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            else{
                $comboProject[] = '<option  value=""></option>';
                $comboProject = implode("", $comboProject);
            }
            echo ($comboProject);
      }
    public function tes(){
        $this->load->view('cs/tes');
    }
    public function addpic(){
        $this->load->view('cs/add_pic');
    }

    public function savePic2() {
        if($_POST)
        {

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsname');
            $seq_no_ticket = $this->input->post('seq_no_ticket',true);
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
                $tmpName = $_FILES['userfile']['tmp_name'];
                $imgString = file_get_contents($tmpName);
                $imgData = bin2hex($imgString);
                $imgbin ="0x".$imgData;
                $psn='';
                
                $picture = array_filter($picture);
                
                //create folder by sequence no
                if(!is_dir("./img/Ticket/".$seq_no_ticket)){
                    mkdir("./img/Ticket/".$seq_no_ticket);
                }
                //end of create folder by sequence no
                //check if file exist append number to file
                $name = basename($_FILES["userfile"]["name"]);
                $actual_name = str_replace(' ', '_', pathinfo($name,PATHINFO_FILENAME));
                $original_name = $actual_name;
                $extension = pathinfo($name, PATHINFO_EXTENSION);

                $i = 1;
                while(file_exists("./img/Ticket/".$seq_no_ticket.'/'.$actual_name.".".$extension))
                {           
                    $actual_name = (string)$original_name.$i;
                    $picname = $actual_name.".".$extension;
                    $i++;
                }
                //end of check if file exist append number to file
                // var_dump($picname);exit();
                $target_dir = "./img/Ticket/".$seq_no_ticket."/";
                $target_file = $target_dir . $picname;
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                // if(isset($_POST["submit"])) {
                //     var_dump("TEST");exit;
                //     $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                //     if($check !== false) {
                //         $msg = "File is an image - " . $check["mime"] . ".";
                //         $uploadOk = 1;
                //     } else {
                //         $msg = "File is not an image.";
                //         $uploadOk = 0;
                //     }
                // }
                // Check file size
                if ($_FILES["userfile"]["size"] > 500000) {
                    $msg1 = "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                $imageFileType = strtolower($imageFileType);
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $msg1 = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg_up = $msg1."\n Your file was not uploaded.";
                    $psn = "Failed";
                    $url = '';
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg_up = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                    } else {
                        $msg_up = "Sorry, there was an error uploading your file.";
                        $psn = "Failed";
                        $url = '';
                    }
                }
                // exit();
                if($psn=="OK"){
                    $descs ="img/Ticket/".$seq_no_ticket."/".$picname;
                    $cons = $this->session->userdata('Tscons');
                    $url=base_url().$descs;
                    $sql = "select count(sv_entryhd_rowid) as cnt from mgr.sv_attachment WHERE  sv_entryhd_rowid = $seq_no_ticket and document_no = $seqno";
                    $data = $this->m_wsbangun->getData_by_querypb($sql);
     
                    $cnt = $data[0]->cnt;

                    if($cnt>0){
                         $sql = "UPDATE mgr.sv_attachment SET file_attachment='$picname', status_attach='1', audit_date='$audit_date', file_url='$url' ";
                         $sql .= "   WHERE sv_entryhd_rowid = $seq_no_ticket and document_no = $seqno";
                    }else{
                         $sql = "INSERT INTO mgr.sv_attachment(entity_cd,project_no,sv_entryhd_rowid,document_no,document_descs,";
                         $sql .= "document_status,file_attachment,status_attach,audit_user,audit_date, file_url)";
                         $sql .= "    VALUES('$entity','$project','$seq_no_ticket','$seqno','Gambar Perbaikan','Y','$picname','1','$audit_user','$audit_date', '$url')";
                    }

                    
                    $data = $this->m_wsbangun->setData_by_query($sql);
                    if($data !="OK"){
                            $msg = 'Upload File Failed : '.$data;
                            $psn = 'Fail';
                            $pic = '';
                    } else{
                        $msg = "File saved successfully";
                        $psn ="OK";
                        $pic = $picname;
                    }
                }else {
                    //kalo gagal upload gambar
                    $msg=$msg_up;
                    $psn="Failed";
                }
                // $picname = str_replace(' ', '_', $files['userfile']['name']);
               
                
                // $sql = "SELECT count(sales_seq_no) as counter FROM mgr.rl_sales_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND sales_seq_no=$seqno ";
                // $sql.= "AND (status_attach IS NULL OR status_attach='0')";
                // $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
                // $cnt = $dtCnt[0]->counter;
                // if(empty($dtCnt)){
                //     $cnt = 0;
                // }
            } else {
              
               $msg = "Sorry, there was an error uploading your file.";
               $psn = "Failed";
            }

                
            // }
            $res = array('pesan'=>$msg, 
                        'status'=>$psn,
                        'url'=>$url
                        );
            echo json_encode($res);

        
        }
    }

    public function savePic()
    {
        if($_POST)
        {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsname');
            $complain_no = $this->input->post('complain_no',true);
            $seqno = $this->input->post('seqno',true);
            $isFile = $this->input->post('isFile',TRUE);
            // var_dump($isFile);
                   
                            if($isFile=="true"){
                                
                                
                                $this->load->library('upload');
                                $this->upload->initialize($this->setUploadOptions());
                                $picname = $_FILES['userfile']['name'];
                                $tmpName = $_FILES['userfile']['tmp_name'];
                       // Check file size
                // if ($_FILES["userfile"]["size"] > 500000) {
                //     $msg = "Sorry, your file is too large.";
                //     $res = array('pesan'=>$msg, 
                //         'status'=>'Fail',
                //         'picname'=>$picname
                //         );
                //     echo json_encode($res);
                //     exit();
                // }
                                $imgString = file_get_contents($tmpName);
                           
                                $imgData = bin2hex($imgString);
                                $imgbin ="0x".$imgData;
                                $cons = $this->session->userdata('Tscons');

                                        $sql = "select count(sv_entryhd_rowid) as cnt from mgr.sv_attachment WHERE  sv_entryhd_rowid = $complain_no and document_no = $seqno";
                                        $data = $this->m_wsbangun->getData_by_querypb($sql);
                         
                                        $cnt = $data[0]->cnt;

                                        if($cnt>0){
                                             $sql = "UPDATE mgr.sv_attachment SET file_attachment='$picname', file_attached=$imgbin, status_attach='1', audit_date='$audit_date' ";
                                             $sql .= "   WHERE sv_entryhd_rowid = $complain_no and document_no = $seqno";
                                        }else{
                                             $sql = "INSERT INTO mgr.sv_attachment(entity_cd,project_no,sv_entryhd_rowid,document_no,document_descs,";
                                             $sql .= "document_status,file_attachment,file_attached,status_attach,audit_user,audit_date)";
                                             $sql .= "    VALUES('$entity','$project','$complain_no','$seqno','Gambar Perbaikan','Y','$picname',$imgbin,'1','$audit_user','$audit_date')";
                                        }

                                        
                                        $data = $this->m_wsbangun->setData_by_query($sql);
                                        if($data !="OK"){
                                                $msg = 'Upload File Failed : '.$data;
                                                $psn = 'Fail';
                                                $pic = '';
                                        } else{
                                            $msg = "File saved successfully";
                                            $psn ="OK";
                                            $pic = $picname;
                                        }
                                    } else {
                                        $msg = "File is not found";
                                        $psn = "Fail";
                                        $pic = '';
                                    }

                            // }
            }
            $res = array('pesan'=>$msg, 
                        'status'=>$psn,
                        'picname'=>$pic
                        );
            echo json_encode($res);


    } 
    public function zoom_category(){
        $location = $this->input->post('prod',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
        $sql = "select * from mgr.sv_category where complain_type ='A'";
        $rst = $this->m_wsbangun->getData_by_query($sql);
        //var_dump($rst);
        $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                
                $combo[] = '<option value="'.trim($result->category_cd).'" >'.$result->descs.'</option>';
            }
            return implode("", $combo);
      }
      public function zoom_lot_no_in($debtor_acct=''){
    
       
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $cons = $this->session->userdata('Tscons');
        

        $sql = "SELECT mgr.pm_lot.lot_no ,mgr.pm_lot.level_no, mgr.pm_lot.descs , mgr.pm_lot.status FROM mgr.pm_lot (nolock) ";
        $sql .=" WHERE mgr.pm_lot.entity_cd = '".$entity."' ";
        $sql .=" and mgr.pm_lot.project_no = '".$project."' ";
        $sql .=" and mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_tenant_lot (nolock)  ";  
        $sql .="                where mgr.pm_tenant_lot.status <> 'T' ";
        $sql .="                AND mgr.pm_tenant_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_tenant_lot.project_no = mgr.pm_lot.project_no";
        $sql .="                AND  mgr.pm_tenant_lot.tenant_no  in   ";
        $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
        $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
        $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
        $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
        $sql .=" or  mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_owner_lot (nolock)  ";   
        $sql .="                where mgr.pm_owner_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_owner_lot.project_no = mgr.pm_lot.project_no";
        // $sql .="                AND  mgr.pm_owner_lot.owner_acct  = '".$debtor_acct."')";
        $sql .="                AND  mgr.pm_owner_lot.owner_acct  in   ";
        $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
        $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
        $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
        $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
        // var_dump($sql);exit();
        $proDescs =  $this->m_wsbangun->getData_by_query($sql);
        // var_dump($proDescs);exit();

        $comboProject[] = '<option value=""></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($debtor_acct === $dtProject->lot_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->lot_no.'" data-floor='.$dtProject->level_no.'>'.$dtProject->lot_no.' - '.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
      }
      public function zoom_lot_no(){
        $debtor_acct = $this->input->post('debtor_acct',TRUE);
        $lotno = $this->input->post('Id',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        

        $sql = "SELECT mgr.pm_lot.lot_no ,mgr.pm_lot.level_no, mgr.pm_lot.descs , mgr.pm_lot.status FROM mgr.pm_lot (nolock) ";
        $sql .=" WHERE mgr.pm_lot.entity_cd = '".$entity."' ";
        $sql .=" and mgr.pm_lot.project_no = '".$project."' ";
        $sql .=" and mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_tenant_lot (nolock)  ";  
        $sql .="                where mgr.pm_tenant_lot.status <> 'T' ";
        $sql .="                AND mgr.pm_tenant_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_tenant_lot.project_no = mgr.pm_lot.project_no";
        $sql .="                AND  mgr.pm_tenant_lot.tenant_no  in   ";
        $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
        $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
        $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
        $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
        $sql .=" or  mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_owner_lot (nolock)  ";   
        $sql .="                where mgr.pm_owner_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_owner_lot.project_no = mgr.pm_lot.project_no";
        // $sql .="                AND  mgr.pm_owner_lot.owner_acct  = '".$debtor_acct."')";
        $sql .="                AND  mgr.pm_owner_lot.owner_acct  in   ";
        $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
        $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
        $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
        $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
        // var_dump($sql);
        $proDescs =  $this->m_wsbangun->getData_by_query($sql);
        // var_dump($entityName);
        $comboProject[] = '<option value=""></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($lotno === $dtProject->lot_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->lot_no.'" data-floor='.$dtProject->level_no.'>'.$dtProject->lot_no.'</option>';
                }
                // $comboProject = implode("", $comboProject);
            }
            echo implode("", $comboProject);
      }
      public function zoom_floor(){
        $lotno = $this->input->post('prod',TRUE);

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $cons = $this->session->userdata('Tscons');
        $sql = "select level_no from mgr.pm_lot where lot_no='$lotno' ";
        $rst = $this->m_wsbangun->getData_by_query($sql);

            echo $rst[0]->level_no;
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
    public function tesemail(){
        $project = $this->session->userdata('Tsproject');
        $entity = $this->session->userdata('Tsentity');
        $complain_no = '10026568';
        $debtor='0005-114';
        $lotdescs = '0005 - BAYER IND 14';
        $cons = $this->session->userdata('Tscons');
        $crit = array('complain_no' => $complain_no,
                        'entity_cd'=>$entity,
                        'project_no'=>$project,
                        'debtor_acct'=>$debtor );
        $dtheader = $this->m_wsbangun->getData_by_criteria('sv_entry_multi',$crit);
        $dtdetail = $this->m_wsbangun->getData_by_criteria('v_sv_entry_multi_dt',$crit);
        
        $content = array('dtheader' => $dtheader,
                        'dtdetail'=>$dtdetail,
                        'lotdescs'=>$lotdescs );
        $this->load->view('cs/email', $content);
    }
    public function save(){
        
            $msg="";
            if ($_POST) 
            {
                // var_dump($this->input->post());exit();
                $email_user = $this->session->userdata('Tsemail');
                $userID = $this->session->userdata('Tsuser_id');
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
                $cons = $this->session->userdata('Tscons');
                $debtor_acct = $this->input->post('debtor_name', true);
                $bill_type = $this->input->post('bill_type',true);
                $complain_type = $this->input->post('ticket_type',true);
                $req_by = $this->input->post('serv_req_by',TRUE);
                $contact_no =$this->input->post('contact_no',TRUE);
                $lotno = $this->input->post('lotno',TRUE);
                $lotdescs = $this->input->post('lotdescs',TRUE);           
                $floor = $this->input->post('floor',TRUE);
                $seq_no_ticket = $this->input->post('seq_no_ticket',TRUE);
                $location = $this->input->post('location',TRUE);
                $category = $this->input->post('category',TRUE);
                $work_req = $this->input->post('work_req',TRUE);
                $picname = $this->input->post('picturename',TRUE);
                $batas = $this->input->post('batas',TRUE);
                $rowID = $this->input->post('rowID',TRUE);
                $complain_source = $this->input->post('complain_source',TRUE);
                // var_dump($batas);exit();
                $audit_date = date('Y M d H:i:s');
                $audit_user = $this->session->userdata('Tsname');
                $email = $this->session->userdata('Tsemail');

                $table = 'sv_spec(nolock)';
                $crit = array('entity_cd'=>$entity,
                       'project_no' => $project,
                     );
                $dtE = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
                $complain_no = (int) $dtE[0]->complain_seq_no;
            
                    // var_dump($categoryarray);
                    // var_dump($work_reqarray);
                    // var_dump($picnamearray);exit();
                
                        $data = array(          
                        
                        'entity_cd' => $entity,
                        'project_no' => $project,
                        'debtor_acct' =>$debtor_acct,
                        'report_no' =>'',                       
                        'serv_req_by'=>$req_by,
                        'reported_date'=>$audit_date,
                        'lot_no'=>$lotno,
                        'floor'=>$floor,
                        'complain_source'=>$complain_source,
                        'status'=>'R',
                        'billing_type'=>$bill_type,
                        'post_status'=>'N',
                        'reported_by'=>$audit_user,
                        'seq_no_ticket'=>$seq_no_ticket,
                        'complain_no'=>$complain_no,
                        'work_requested'=>$work_req,
                        'category_cd'=>$category,
                        'contact_no'=>$contact_no,
                        'complain_type'=>$complain_type,
                        'location'=>$location,
                        'rowid_sysuser'=>$userID,
                        'email_addr'=>$email_user,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );

                        $where = array('rowID' => $rowID );
                        if($rowID==0){
                            $insert = $this->m_wsbangun->insertData_cons($cons,'sv_entry_multi',$data);
                            $msg="Data has been saved successfully";
                        }else{
                            unset($data['report_no']);
                            $insert = $this->m_wsbangun->updateData_cons($cons,'sv_entry_multi',$data,$where);
                            $msg="Data has been updated successfully";
                        }
                        
                        // var_dump('data dari sv_entry_multi');
                        // var_dump($insert);
                        if($insert !="OK"){
                            $msg= $data;
                            $psn = 'Fail multi';
                        }else{
                            
                            
                         
                                // for ($i=1; $i < $batas; $i++) { 
                                
                       
                                // var_dump($imgbin);
                                $savedata = array(          
                              
                                    'entity_cd' => $entity,
                                    'project_no' => $project,
                                    'debtor_acct' =>$debtor_acct,
                                    'report_no' =>'',                        
                                    'serv_req_by'=>$req_by,
                                    'reported_by'=>$audit_user,
                                    'seq_no'=>1,
                                    'reported_date'=>$audit_date,
                                    'lot_no'=>$lotno,
                                    'floor'=>$floor,
                                    'billing_type'=>$bill_type,
                                    'status'=>'R',
                                    'complain_no'=>$complain_no,
                                    'contact_no'=>$contact_no,
                                    'complain_source'=>$complain_source,
                                    'seq_no_ticket'=>$seq_no_ticket,
                                    'location'=>$location,
                                    // 'category_cd'=>$category[$i-1],
                                    // 'work_requested'=>$work_req[$i-1],
                                    // 'picture'=>$picname[$i-1],
                                    'work_requested'=>$work_req,
                                    'audit_user'=>$audit_user,
                                    'audit_date'=>$audit_date
                                    );
                                    
                                    if($rowID==0){
                                        $insertdt = $this->m_wsbangun->insertData_cons($cons,'sv_entry_multi_dt',$savedata);
                                        $msg="Data has been saved successfully";
                                    }else{
                                        $insertdt = $this->m_wsbangun->updateData_cons($cons,'sv_entry_multi_dt',$savedata,$where);
                                        $msg="Data has been updated successfully";
                                    }
                                    
                                    // var_dump('sv_entry_multi_dt '.$i);
                                    // var_dump($insertdt);
                                    if($insertdt !="OK"){
                                        $msg= $insertdt;
                                        $psn = 'Fail';
                                    }else{
                                        
                                        $psn = 'OK';

                                    }

                                // }//end looping
                               
                            
                        }
                        //execute SP update table dan email
                        if($psn == "OK") {

                            $sql = "SELECT mgr.cf_business.email_addr,
                            mgr.ar_debtor.name
                            from mgr.ar_debtor
                            inner join mgr.cf_business
                            on mgr.ar_debtor.business_id=mgr.cf_business.business_id
                            where mgr.ar_debtor.entity_cd='$entity'
                            and mgr.ar_debtor.project_no='$project'
                            and mgr.ar_debtor.debtor_acct='$debtor_acct'";
                            $email2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
                            $email="";
                            $name="";
                            if ($email2) {
                                $email3 = $email2[0]->email_addr;
                                $name = $email2[0]->name;
                            }

                            if ($complain_type=="A" || $complain_type=="P" || $complain_type=="T") {
                                $NotificationCd = "";
                                if ($complain_type=="A") {
                                    $NotificationCd = "Access";
                                }
                                if ($complain_type=="P") {
                                    $NotificationCd = "Parking";
                                }
                                if ($complain_type=="T") {
                                    $NotificationCd = "Telepohone";
                                }
                                $dtnotif = array(          
                                    'entity_cd' => $entity,
                                    'project_no' => $project,
                                    'email_addr' =>$email3,
                                    'NotificationDate' =>$audit_date,                        
                                    'NotificationCd'=>$NotificationCd,
                                    'remarks'=>'Your ticket has been submitted with the ticket no #'.$complain_no,
                                    'complain_no'=>$complain_no,
                                    'seq_no_ticket'=>$seq_no_ticket,
                                    'IsRead'=>0,
                                    'email_from'=>$email_user
                                );

                                $dtactivity = array(          
                                    'entity_cd' => $entity,
                                    'project_no' => $project,
                                    'email_addr' =>$email_user,
                                    'activitydate' =>$audit_date,                        
                                    'activitycd'=>$NotificationCd,
                                    'remarks'=>'You have submitted a ticket with Ticket No. #'.$complain_no,
                                    'complain_no'=>$complain_no,
                                    'seq_no_ticket'=>$seq_no_ticket
                                );
                            }
                            else{
                                $dtnotif = array(          
                                    'entity_cd' => $entity,
                                    'project_no' => $project,
                                    'email_addr' =>$email3,
                                    'NotificationDate' =>$audit_date,                        
                                    'NotificationCd'=>'NEW',
                                    'remarks'=>'Your ticket has been submitted with the ticket no #'.$complain_no,
                                    'complain_no'=>$complain_no,
                                    'seq_no_ticket'=>$seq_no_ticket,
                                    'IsRead'=>0,
                                    'email_from'=>$email_user
                                );
                                $dtactivity = array(          
                                    'entity_cd' => $entity,
                                    'project_no' => $project,
                                    'email_addr' =>$email_user,
                                    'activitydate' =>$audit_date,                        
                                    'activitycd'=>'NEW',
                                    'remarks'=>'You have submitted a ticket with Ticket No. #'.$complain_no,
                                    'complain_no'=>$complain_no,
                                    'seq_no_ticket'=>$seq_no_ticket
                                );
                            }
                            $insert_notif = $this->m_wsbangun->insertData_cons('ifca3','sysnotification',$dtnotif);
                            $insert_activity = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dtactivity);
                            if($insert_activity=='OK'){ 
                                $sql = "mgr.xsv_notification_ticket_to_spv '".$entity."', '".$project."','".$complain_no."', ".$seq_no_ticket.", 'NEW', '".$email_user."' ";
                                $snd = $this->m_wsbangun->setData_by_query_cons($cons,$sql);

                                $sql2 = "mgr.x_send_mail_newticket '".$email3."', '".$name."', '".$complain_no."' ";
                                $snd2 = $this->m_wsbangun->setData_by_query_cons('ifca3',$sql2);

                                if($snd=='OK'){
                                    $msg = 'Your ticket has successfully submitted with ticket no. '.$complain_no.'. Thank you!';
                                    $psn ='OK';
                                    $aa = $msg;
                                }else{
                                    $msg = $snd;
                                    $psn ='Fail';
                                    $aa = 'Sent Email Failed, Please Contact your Admin!';
                                }
                            }

                            if($rowID==0){
                                $sql = "mgr.xsv_post_ticket_new '".$entity."', '".$project."','".$debtor_acct."', '".$audit_date."', '".$complain_no."', '".$batas."' ";
                                $snd = $this->m_wsbangun->setData_by_query_cons($cons,$sql);
                                              
                                if($snd=='OK'){
                                    $msg = 'Your ticket has successfully submitted with ticket no. '.$complain_no.'. Thank you!';

                                    $table = 'sv_spec(nolock)';
                                    $crit = array('entity_cd'=>$entity,
                                           'project_no' => $project,
                                         );
                                    $dtE = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
                                    if(!empty($dtE)){
                                        $complain_no = (int) $dtE[0]->complain_seq_no;
                                        $seq_no_ticket = (int) $dtE[0]->seq_no_ticket + 1;
                                        $upseq = intval($complain_no) + 1;
                                        $sql = "UPDATE mgr.sv_spec SET complain_seq_no = ".$upseq.", seq_no_ticket='$seq_no_ticket' WHERE entity_cd='".$entity."' and project_no='".$project."'";
                                        $dupdate = $this->m_wsbangun->setData_by_query_cons($cons,$sql);
                                    } else {
                                        $msg = "Can't get complain number for this ticket";
                                        $psn = "Failed";
                                        $msg1= array('pesan'=>$msg,
                                        'status'=>$psn);
                                
                                        echo json_encode($msg1);
                                        exit();
                                        // return;
                                    }

                                    $psn ='OK';
                                    $aa = $msg;
                                }else{
                                    $msg = $snd;
                                    $psn ='Fail';
                                    $aa = 'Sent Email Failed, Please Contact your Admin!';
                                }
                            }
                                    
                                // }
                        } else {
                            $msg="Can't send email, error while inserting the data.";
                            $psn="Failed";
                        }


            } 
            else{
                $msg="Data validation is not valid";
            }
            
           $msg1= array('pesan'=>$msg,
                    'status'=>$psn,
                    'ticket'=>$complain_no
                );
            
        echo json_encode($msg1);

       
    }
    function sendemail(){
        $msg="";
            if ($_POST) 
            {
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
       
                $lotdescs = '0005 - BAYER IND 14';
                $complain_no = '10026568';
                $debtor_acct='0005-114';

                        //execute SP update table dan email
                  
                                        $msg = 'Email sent';
                                        $psn ='OK';
                                        $aa = $msg;
                                        $cons = $this->session->userdata('Tscons');
                                         $crit = array('complain_no' => $complain_no,
                                                        'entity_cd'=>$entity,
                                                        'project_no'=>$project,
                                                        'debtor_acct'=>$debtor_acct );
                                        $dtheader = $this->m_wsbangun->getData_by_criteria('sv_entry_multi',$crit);
                                        $dtdetail = $this->m_wsbangun->getData_by_criteria('v_sv_entry_multi_dt',$crit);
                                        // $email = 'deska.priyanti@ifca.co.id';
                                        $email = 'deskaruwanda@gmail.com';
                                        $cc='';$bcc='';
                                        // $cc= 'deskaruwanda@gmail.com';$bcc='';
                                        if($dtheader[0]->complain_type =='R'){$type1= 'request';}else{$type1 = 'complain';}
                                        $tgl = strtotime($dtheader[0]->reported_date);
                                        if($dtheader[0]->complain_type =='R'){$type2= 'Request';}else{$type2= 'Complain';}
                                        $body = '';

                                        // $body .= '<!DOCTYPE html>';
                                        // $body .= '<html>';
                                        // $body .= '<head>';
                                        // $body .= '    <title>Customer Service Ticket</title>';
                                        // $body .= '</head>';
                                        // $body .= '<body style="font-family: Arial;">';

                                        $body .= '<h1>Dear '.$dtheader[0]->serv_req_by.',</h1>';
                                        $body .= 'Berikut kami informasikan '.$type1.'<br>';
                                        $body .= '<table>';
                                        $body .= '    <tr>';
                                        $body .= '        <td><b>Tanggal Terima</b></td>';
                                        $body .= '        <td> : </td>';
                                        $body .= '        <td>'.date('d M Y H:i:s',$tgl).'</td>';
                                        $body .= '    </tr>';
                                        $body .= '    <tr>';
                                        $body .= '        <td><b>Nomor Ticket</b></td>';
                                        $body .= '        <td> : </td>';
                                        $body .= '        <td>'.$dtheader[0]->report_no.'</td>';
                                        $body .= '    </tr>';
                                        $body .= '    <tr>';
                                        $body .= '        <td><b>CC / Unit ID</b></td>';
                                        $body .= '        <td> : </td>';
                                        $body .= '        <td>'.$lotdescs.' floor: '.$dtheader[0]->floor.' location: '.$dtheader[0]->location.'</td>';
                                        $body .= '    </tr>';
                                        $body .= '    <tr>';
                                        $body .= '        <td valign="top"><b>'.$type2.' / Info</b></td>';
                                        $body .= '        <td valign="top"> : </td>';
                                        $body .= '        <td><TABLE>';
                                                  foreach ($dtdetail as $key) {
                                                    $body .= ' <tr><td width="10px">-</td><td>Category</td><td> : </td><td>'.$key->category_desc.'</td></tr>';
                                                    $body .= ' <tr><td> </td><td>Work Requested</td><td> : </td><td>'.$key->work_requested.'</td></tr>';
                                                    } 
                                        $body .= '            </TABLE>';
                                        $body .= '        </td>';
                                        $body .= '    </tr>';
                                        $body .= '    <tr>';
                                        $body .= '        <td><b>Note</b></td>';
                                        $body .= '        <td> : </td>';
                                        $body .= '        <td>Email telah diteruskan ke Help Desk '.$this->session->userdata('Tsprojectname').' apa lu</td>';
                                        $body .= '    </tr> iya napa';
                                        $body .= '</table> bodos';
                                        $body .= '<br>fffffu';
                                        $body .= 'Terima kasih atas kerjasamanya.<br>';
                                        $body .= 'Customer Service,<br>';
                                        $body .= 'Property365.';
                                        $body .= '</body>';
                                        $body .= '</html>';
                                        $subject = 'Ticket No. : '.$dtheader[0]->report_no;

                                        $url = 'http://52.187.57.5/emailAPI/c_api_email/POST_EMAIL_API';
                                        $dataJson = "to=".$email."&subject=".$subject."&cc=".$cc."&bcc=".$bcc."&message=".$body;
                                        $ch = curl_init();
                                        curl_setopt($ch, CURLOPT_URL, $url);

                                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
                                        curl_setopt($ch, CURLOPT_POST, 1);
                                        curl_setopt($ch, CURLOPT_POSTFIELDS,$dataJson);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                         
                                        $response  = curl_exec($ch);
                                        curl_close($ch);
                                        // var_dump($response);
                                        $response = get_object_vars(json_decode($response));
                                        // var_dump($response["status"]);

                                        $msg = $response["Pesan"];
                                        $psn = $response["status"];
                                    
                                        if($psn=='Success'){
                                            $msg = 'Email sent';
                                            $psn = 'OK';
                                        } else {
                                            $msg = 'API email fail';
                                            $psn = $response["Pesan"];
                                        }
  


            } 
            else{
                $msg="Data validation is not valid";
            }
            
           $msg1= array('pesan'=>$msg,
                    'status'=>$psn);
            
        echo json_encode($msg1);

       
    }
   
}