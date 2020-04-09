<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_projects extends Core_Controller{
	public function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        $content = array(
            'project'=>$projectName
        );
        
    	$this->load_content_top_menu('project/index',$content);
    }

    public function getTable(){
        $callback = array(
            'Data' => NULL,
            'Error' => FALSE,
            'Message' => NULL
        );

        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('IFCA', TRUE);
        $table = 'mgr.v_project';

        $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table, $where);
        if ($res) {
            $callback['Data'] = $res;
        }
        echo json_encode($callback);
    }

    public function form($typeform = '',$id=''){
        $sql = 'SELECT * from msdb.dbo.sysmail_profile';
        $sysmail = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $sq2 = 'SELECT db_profile from mgr.pl_project from mgr.pl_project';
        $project = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $sq2 = 'SELECT seq_no = max(seq_no) from mgr.pl_project';
        $dt = $this->m_wsbangun->getData_by_query_cons('ifca3',$sq2);
        if(!empty($dt)){
            $seq_no = (int)$dt[0]->seq_no+1;
        }else{
            $seq_no = 1;
        }
        
        if(empty($id)){
            $id=0;
        }
        if($typeform=='edit'){
            $title1 = "Edit Project";
            $title2 = "";
        }else{
            $title1 = "Registration New Project";
            $title2 = "New Project";
        }
        $content = array(
            'sysmail'=>$sysmail,
            'id'=>$id,
            'typeform'=>$typeform,
            'project'=>$project,
            'title1'=>$title1,
            'title2'=>$title2,
            'seq_no'=>$seq_no
        );
        $this->load_content_top_menu('projectmobile/regist',$content);
    }

    public function regist($id=''){
        $sql = 'SELECT * from msdb.dbo.sysmail_profile';
        $sysmail = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $sq2 = 'SELECT db_profile from mgr.pl_project from mgr.pl_project';
        $project = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        if(empty($id)){
            $id=0;
        }
        $content = array(
            'sysmail'=>$sysmail,
            'id'=>$id,
            'project'=>$project
        );
        $this->load_content('projectmobile/regist',$content);
    }

    public function zoom_entity_from(){
        $cons = $this->input->post('cons',TRUE);
        $ent = $this->input->post('ent',TRUE);
        $sql = 'SELECT distinct entity_cd,entity_name from mgr.cf_entity (nolock) order by entity_name asc';
        $entityDt = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
       
        $list = '';$pilih='';
            if(!empty($entityDt)) {
                $list = '<option></option>';
                foreach ($entityDt as $key) {
                    if($ent===$key->entity_cd){
                        $pilih = ' selected="1" ';
                    }else{
                        $pilih='';
                    }
                    $list.='<option value="'.$key->entity_cd.'"'.$pilih.'>'.$key->entity_cd.'-'.$key->entity_name.'</option>';
                }
            }
        echo($list);  
    }

    public function zoom_project_from(){
        $ent = $this->input->post('ent',TRUE);
        $cons = $this->input->post('cons',TRUE);
        $pro = $this->input->post('pro',TRUE);

        $sql = "SELECT distinct project_no,descs from mgr.pl_project (nolock) where entity_cd = '$ent' order by descs asc";
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $comboProject[] = '';$pilih='';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                    if($pro==$dtProject->project_no){
                        $pilih = ' selected="1" ';
                    }else{
                        $pilih='';
                    }
                    $comboProject[] = '<option value="'.$dtProject->project_no.'" data-prodescs="'.$dtProject->descs.'"'.$pilih.'>'.$dtProject->descs.'('.$dtProject->project_no.')'.'</option>';
                }
               
            }
            $comboProject = implode("", $comboProject);
            echo $comboProject;
    }

    public function zoom_phase_from(){
        $pha = $this->input->post('pha',TRUE);
        // var_dump($pha);
        $table = 'rl_phase';
        $phaseDescs = $this->m_wsbangun->getData($table);
        // var_dump($entityName);
            if(!empty($phaseDescs)) {
                $comboPhase[] = '<option></option>';
                foreach ($phaseDescs as $dtPhase) {
                  if($pha === $dtPhase->phase_cd) {
                    // $pilih = ' selected = "1"';
                    $pilih = 'selected';
                  } else {
                    $pilih = '';
                  }
                    $comboPhase[] = '<option value="'.$dtPhase->phase_cd.'" '.$pilih.' >'.$dtPhase->descs.'</option>';
                }
                $comboPhase = implode("", $comboPhase);
            }
            echo $comboPhase;
    }

    public function test(){
        $this->load_content('projectmobile/test');
    }

    private function setUploadOptions(){
        $max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/cs',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }

    public function savePic2() {
        if($_POST)
        {

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
                $psn='';
                
                $picture = array_filter($picture);

                $target_dir = "./img/PlProject/";
                // $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $target_file = $target_dir . str_replace(' ','_',basename($_FILES["userfile"]["name"]));
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                if ($_FILES["userfile"]["size"] > 5000000) {
                    $msg = "Maximum file size is 5MB";
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
                && $imageFileType != "gif" && $imageFileType != "JPG" ) {
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
                    $msg = "Sorry, your file was not uploaded.";
                    $psn = "Failed";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                        $descs ="img/PlProject/".$picname;
                        $url=base_url().$descs;
                        // var_dump($url);exit();
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                        $psn = "Failed";
                    }
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
                        'url'=>$url,
                        'picname'=>$picname,
                        );
            echo json_encode($res);
            // var_dump($res);exit();

        
        }
    }

    public function addnew($id=""){
        $sql = 'select * from msdb.dbo.sysmail_profile';
        $sysmail = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql);
        $sq2 = 'select select db_profile from mgr.pl_project from mgr.pl_project';
        $project = $this->m_wsbangun->getData_by_querypb_cons('ifca3',$sql);
        $content = array(
            'sysmail'=>$sysmail,
            'id'=>$id,
            'project'=>$project
        );
        $this->load_content_top_menu('projectmobile/addproject',$content);
    }

    public function zoom_project(){
        // $data_id = $this->m_newsfeed->get_table_by_id("mgr.pl_project");
        // return $data_id;

        if($_POST)
        {
            $entity = $this->input->post('ent', TRUE);
            
            if(empty($entity)) {
                echo('<option></option>');
            } else {
                $table = 'pl_project';
                $kriteria = array('entity_cd'=>$entity);

                $ProjectData = $this->m_wsbangun->getData_by_criteria($table,$kriteria);
                $listProject = '';
                if(!empty($ProjectData)) {
                    $listProject = '<option></option>';
                    foreach ($ProjectData as $project) {
                        // $kriteria = array('entity_cd'=>$entity,
                        //     'project_no'=>$project,
                        //     'lot_no'=>$project->lot_no);                        

                        $listProject.='<option value="'.$project->project_no.'">'.$project->descs.'</option>';
                    }
                }
                echo($listProject);
            }
        }
    }

    public function getByID($rowID=''){
 
        $where=array('rowID'=>$rowID);
        $data = $this->m_wsbangun->getData_by_criteria_adm('pl_project',$where);

        echo json_encode($data);
    }

    public function getTable2(){
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);

        //untuk PK diharap diletakan di awal array
       
        $aColumns  = array('row_number','entity_cd', 'project_descs', 'picture_path', 'http_add', 'db_profile','db_name');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_project';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $sEcho = $this->input->get_post('sEcho', true);
    
        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);
        $param='';
        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     
            $param =" Where  ".$filter_search;
        }
        // var_dump($filter_search);
        // $param =" Where status='1' ".$filter_search;

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

    public function save(){
        $msg="";
        if($_POST){
            // var_dump($_POST);exit();
            $id = (int)$this->input->post('id');
            $entity_cd = $this->input->post('entity_cd');
            $project_no = $this->input->post('project_no');
            $descs = $this->input->post('descs');
            $http_add = $this->input->post('http_add');
            $map = $this->input->post('map');
            $hp = $this->input->post('hp');
            $db_profile =$this->input->post('db_profile');
            $sysmail =$this->input->post('sysmail');
            $db_name =$this->input->post('db_name');
            $status =$this->input->post('status');
            $product_cd =$this->input->post('product_cd');
            $pict_name =$this->input->post('picturepath1',TRUE);
            $pict_name = str_replace(' ', '_', $pict_name);
            $pict_pro =$this->input->post('picturepath2',TRUE);
            $pict_pro = str_replace(' ', '_', $pict_pro);
            $seq_no = $this->input->post('seq_no');
            $location = $this->input->post('location');
            // var_dump($pict_pro);exit();
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            $isFile  =$this->input->post('isFile',TRUE);

      

            if(strpos($pict_name, base_url('img/PlProject/')) !== false || strpos($pict_pro, base_url('img/PlProject/')) !== false) {
                        $data = array(
                        'entity_cd' => $entity_cd,
                        'project_no' => $project_no,
                        'descs' =>$descs,
                        'picture_path' => $pict_name,
                        'picture_url' => $pict_pro,
                        'coordinat_project' => $map,
                        'caption_address'=>$http_add,
                        'handphone' => $hp,
                        'db_profile'=>$db_profile,
                        'db_name'=>$db_name,
                        'status'=>$status,
                        'product_cd'=>$product_cd,
                        'profile_name'=>$sysmail,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date,
                        'seq_no' => $seq_no,
                        'location' => $location
                    );    
                    }else{
                        $data = array(          
                        'entity_cd' => $entity_cd,
                        'project_no' => $project_no,
                        'descs' =>$descs,
                        'picture_path' => base_url().'img/PlProject/'.$pict_name,
                        'picture_url' => base_url().'img/PlProject/'.$pict_pro,
                        'caption_address'=>$http_add,
                        'coordinat_project' => $map,
                        'handphone' => $hp,
                        'db_profile'=>$db_profile,
                        'db_name'=>$db_name,
                        'status'=>$status,
                        'product_cd'=>$product_cd,
                        'profile_name'=>$sysmail,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date,
                        'seq_no' => $seq_no,
                        'location' => $location
                        );
                    }
                 $criteria = array('RowID' => $id);
                    // var_dump($data);
                    if($id>0) {
                        unset($data['entity_cd']);
                        unset($data['project_no']);
                        $update = $this->m_wsbangun->updateDataweb('pl_project',$data, $criteria);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                    
                    } else {
                        $insert = $this->m_wsbangun->insertDataweb('pl_project',$data);
                        if($insert == 'OK')
                        {
                            $msg="Data has been saved successfully";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                    }
        } else {
            $msg="Data validation is not valid";
            $psn = "Failed";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }
    
    public function save_regist(){
        $msg="";
        if($_POST){
            // var_dump($_POST);exit();
            $id = (int)$this->input->post('id');
            $entity_cd = $this->input->post('entity_cd');
            $project_no = $this->input->post('project_no');
            $descs = $this->input->post('descs');
            $caption_address = $this->input->post('caption_address');
            $coordinat_project = $this->input->post('coordinat_project');
            $hp = $this->input->post('hp');
            $db_profile =$this->input->post('db_profile');
            $sysmail =$this->input->post('sysmail');
            $db_name =$this->input->post('db_name');
            $status =$this->input->post('status');
            $pict_name =$this->input->post('picturepath1',TRUE);
            $pict_name = str_replace(' ', '_', $pict_name);
            $pict_pro =$this->input->post('picturepath2',TRUE);
            $pict_pro = str_replace(' ', '_', $pict_pro);
            $product_cd =$this->input->post('product_cd');
            $seq_no = $this->input->post('seq_no');
            $location = $this->input->post('location');
            // var_dump($pict_pro);exit();
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            $usergroup = $this->session->userdata('Tsusergroup');
            $email_user = $this->session->userdata('Tsemail');
            $isFile  =$this->input->post('isFile',TRUE);



            if(strpos($pict_name, base_url('img/PlProject/')) !== false || strpos($pict_pro, base_url('img/PlProject/')) !== false) 
            {
                 $pict_namee = $pict_name;
                 $pict_proo = $pict_pro;
            }else{
                $pict_namee = base_url().'img/PlProject/'.$pict_name;
                $pict_proo = base_url().'img/PlProject/'.$pict_pro;
            }

            $data = array(
                    'entity_cd' => $entity_cd,
                    'project_no' => $project_no,
                    'descs' =>$descs,
                    'picture_path' => $pict_namee,
                    'picture_url' => $pict_proo,
                    'coordinat_project' => $coordinat_project,
                    'caption_address'=>$caption_address,
                    'handphone' => $hp,
                    'db_profile'=>$db_profile,
                    'db_name'=>$db_name,
                    'product_cd'=>$product_cd,
                    'status'=>$status,
                    'profile_name'=>$sysmail,
                    'audit_user'=>$audit_user,
                    'audit_date'=>$audit_date,
                    'seq_no' => $seq_no,
                    'location' => $location
                ); 
             $criteria = array('RowID' => $id);
                // var_dump($data);
                if($id>0) {
                    $update = $this->m_wsbangun->updateDataweb('pl_project',$data, $criteria);
                    if($update == 'OK')
                    {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    } else {
                        $msg= $update;
                        $psn = "Failed";
                    }
                
                } else {
                    $sql = "SELECT count(*) as cnt from mgr.pl_project where entity_cd='$entity_cd' and project_no='$project_no'";
                    $cekproject = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
                    $cnt = $cekproject[0]->cnt;

                    if($cnt>0){
                        $msg1=array("Pesan"=>"There's already a project with the same code (".$project_no.") in this entity (".$entity_cd."). Please use another code.",
                                "status"=>"Failed");
                        echo json_encode($msg1);
                        exit();
                    }
                    $insert = $this->m_wsbangun->insertDataweb('pl_project',$data);
                    if($insert == 'OK')
                    {
                        
                        if($usergroup=="ADMINWEB"){
                            $datacfs = array(
                                'entity_cd' => $entity_cd,
                                'project_no' => $project_no,
                                'userid' =>$audit_user,
                                'audit_user'=>$audit_user,
                                'audit_date'=>$audit_date,
                                'email' => $email_user
                            ); 
                            $insertcfs = $this->m_wsbangun->insertDataweb('cfs_user_project',$datacfs);
                            if($insertcfs == 'OK')
                            {
                                $msg="Data has been saved successfully";
                                $psn = "OK";
                            } else {
                                $msg = $insertcfs;
                                $psn = "Failed";
                            }
                        }else{
                            $msg="Data has been saved successfully";
                            $psn = "OK";
                        }
                        

                    } else {
                        $msg = $insert;
                        $psn = "Failed";
                    }
                    
                 
                }
        } else {
                $msg="Data validation is not valid";
                $psn = "Failed";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }

}