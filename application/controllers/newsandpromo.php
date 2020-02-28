<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Newsandpromo extends Core_Controller
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
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        // <?php echo $this->session->userdata('Tsproductcd')
        // $product_cd = $this->session->userdata('Tsproductcd');
        
        
        $table = 'NewsAndPromo';
        $DataMenu = $this->m_wsbangun->getDataadm($table);        
        // var_dump($_SERVER['HTTP_HOST']);
        // var_dump($_SERVER['REMOTE_PORT']);exit();
        // var_dump($DataMenu); exit();
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu);
        

        $this->load_content_top_menu('newsandpromo/index',$content);
    }

      public function zoom_parentid(){  
//         $table = 'sysMenuMobile(nolock)';
//         $object = array('MenuID', 'Title'); 
//         $comboParentID = $this->m_wsbangun->getCombo($table, $object);


      }

      //set combo when edit
      public function zoom_parentid_from(){
        $ent = $this->input->post('MenuID',TRUE);
        // var_dump($ent);
        $table = 'sysMenuMobile';
        $parentID = $this->m_wsbangun->getDataadm($table);


        // var_dump($entityName);
            if(!empty($parentID)) {
                $comboParent[] = '<option></option>';
                foreach ($parentID as $dtParent) {
                  if($ent == $dtParent->MenuID) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboParent[] = '<option '.$pilih.' value="'.$dtParent->MenuID.'">'.$dtParent->Title.'</option>';
                }
                $comboParent = implode("", $comboParent);
            }
            echo $comboParent;
      }

      
    public function test(){
        $this->load_content('nup_parameter/test');
    }

    public function addnew(){
      
        $this->load->view('newsandpromo/add');

    }
    public function getByID($MenuID=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('id'=>$MenuID);
        $data = $this->m_wsbangun->getData_by_criteriapb('v_newsandpromo',$where);

        echo json_encode($data);

    }
    public function Delete(){
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('id'=>$id);
        $data = $this->m_wsbangun->deletedataweb('newsandpromo',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
    
    public function getTable()
    {

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        // $product_cd = $this->session->userdata('Tsproductcd');
        $project = $this->session->userdata('Tsproject');   
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);
        // var_dump($product_cd);exit();
        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','content_type', 'subject', 'start_date', 'end_date');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.NewsAndPromo';

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
        $SordField = ($sortIdColumn==0? 'id' :$Column[$sortIdColumn]['name']);

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
        $param = " where id > 0 AND entity_cd='".$entity."' AND project_no='".$project."' and getdate()<end_date".$filter_search;
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
    public function getTable_history()
    {

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $project = $this->session->userdata('Tsproject');   
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);
        

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','content_type', 'subject', 'start_date', 'end_date');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.NewsAndPromo';

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
        $SordField = ($sortIdColumn==0? 'id' :$Column[$sortIdColumn]['name']);

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
        $param = " where id > 0 AND entity_cd='".$entity."' AND project_no='".$project."' and getdate()>end_date ".$filter_search;
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
     public function edit_newsfeed($newsfeed_id = "", $data=null)
    {
        // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
        // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);
        // if ($pri->can_edit == '1') {

            $newsfeeds = $this->m_newsfeed->get_by_id($newsfeed_id);
            $list_newsfeeds = '';
            // foreach ($newsfeeds as $newsfeed) {
            //     $list_newsfeeds .= '<option value="'
            //     1">Information</option>
            //             <option value="2">Warning</option>
            // }
            $statusnya = array('','Information','Warning');
            for($i=1;$i<=2;$i++){
                if($i==$newsfeeds->status){
                    $list_newsfeeds .= '<option selected="selected" value="'.$newsfeeds->status. '">'.$statusnya[$newsfeeds->status]. '</option>'."\n";
                } else {
                    $list_newsfeeds .= '<option value="'.$newsfeeds->status. '">'.$statusnya[$i]. '</option>'."\n";
                }
                
            }
            
            $content = array(
                'newsfeeds' => $newsfeeds,
                'list_newsfeeds'=>$list_newsfeeds,
                'error' => $data
            );
            $this->load_content('c_newsfeed/edit', $content);

        // } else {
            // $content['url'] = base_url() . "newsfeed";
            // $this->load_content('error', $content);
        // }

    //     } else {
    //         $content['url'] = base_url() . "newsfeed";
    //         $this->load_content('error', $content);
    //     }

    }
    public function new_newsfeed($data=null)
    {
        $content = array(
                'error' => $data
            );

       // $this->load_content('newsfeed/add',$content);
        $this->load->view('newsfeed/add',$content);
        // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
        // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);

        // if ($pri->can_add == '1')
            
        // else {
        //     $content['url'] = base_url() . "newsfeed";
        //     $this->load_content('error', $content);
        // }
    }
    public function form($id=null,$form=null)
    {
        // $product_cd=$this->session->userdata('appsname');
        // var_dump($product_cd);exit();
        $projectName = $this->session->userdata('Tsprojectname');
        if($form=='A'){
            $jdl = 'Add News & Promo';
            $form='add';
        }else if($form=='E'){
             $jdl = 'Edit News & Promo';
             $form='edit';
        }

        $content = array(
                'id' => $id,
                'jdl'=>$jdl,
                'form'=>$form,
                'project'=>$projectName
            );

       
        $this->load_content_top_menu('newsandpromo/form',$content);
        
    }
    public function save_menu(){
        
            $msg="";
            if ($_POST) 
            {
                $menu_id = $this->input->post('txtMenuID', true);
                // var_dump($nup_id);
                $title = $this->input->post('txtTitle',TRUE);
                $url =$this->input->post('txtURL',TRUE);
                $parent_id = $this->input->post('txtParentID',TRUE);                
                $icon_class = $this->input->post('txtIconClass',TRUE);
                $order_seq = $this->input->post('txtOrderSeq',TRUE);
                // $status = intval($this->input->post('status',TRUE));
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                if(empty($parent_id)){
                    $parent_id = 0;
                }
                
                        $data = array(          
                        // 'nup_id' => $nup_id,
                        'title' => $title,
                        'URL' => $url,
                        'ParentMenuID' =>$parent_id,
                        'IconClass' =>$icon_class,                        
                        'OrderSeq'=>$order_seq,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );
                    

                    $criteria = array('MenuID' => $menu_id);
                    // var_dump($criteria);
                    if($menu_id>0) {
                        $data = $this->m_wsbangun->updateDataweb('sysMenuMobile',$data, $criteria);
                        // var_dump($data);exit();
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been updated successfully";
                            $st = 'OK';
                        }
                        
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("ADD newsfeed")));
                    } else {
                        $data = $this->m_wsbangun->insertDataweb('rl_agent_absen',$data);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been saved successfully";
                            $st = 'OK';
                        }
                        
                        
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("EDIT newsfeed")));
                    }

                    // redirect("c_newsfeed");
                // } // tutup if validation
            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }


    public function save_newsfeed(){
        $msg="";
        // var_dump($_POST);exit();
        if($_POST){
            $action = $this->input->post('action', TRUE);
            $id = (int)$this->input->post('id',TRUE);
            // $project = $this->input->post('project_no',TRUE);
            // $split = explode("-",$project);
            // var_dump($split);exit();
            $project_no = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
            // var_dump($split[1]);
            $news = $this->input->post('news',TRUE);
            $subject = $this->input->post('subject',TRUE);
            $content = $this->input->post('content_html');
            $product_cd = $this->input->post('product_cd');
            $type = $this->input->post('type');
            // $status = $this->input->post('status',TRUE);
            $link = $this->input->post('youtubelink',TRUE);
            $youtube = str_replace("watch?v=", "embed/", $link);
            // $entity = $this->session->userdata('Tsentity');
            // $project_no =$this->input->post('project_no',TRUE);
            $pict_name =$this->input->post('Picture',TRUE);
            $date_created2 = date('d/m/Y H:i:s');
            $date_created  =$this->input->post('date_created',TRUE);
            $date_created = date($date_created);
            $date_created = DateTime::createFromFormat('d/m/Y H:i:s', $date_created.' 00:00:00');
            $date_created = $date_created->format('Y-d-m H:i:s');
            $date_created1  =$this->input->post('date_created1',TRUE);
            $date_created1 = date($date_created1);
            $date_created1 = DateTime::createFromFormat('d/m/Y H:i:s', $date_created1.' 00:00:00');
            $date_created1 = $date_created1->format('Y-d-m H:i:s');
            $pict_name = str_replace(' ', '_', $pict_name);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            $isFile  =$this->input->post('isFile',TRUE);
            $homeflag  =$this->input->post('homeflag', TRUE);

            // var_dump($homeflag); exit();
            // $seq_no = $this->input->post('seqno',TRUE);

            if($isFile=="true"){
                $picture = $_FILES["userfile"];
                $psn="";

                $picture = array_filter($picture);
                $target_dir = "./img/NewsAndPromo/";
                $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                    if($check !== false) {
                        $msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $msg = "File is not an image.";
                        $uploadOk = 0;
                    }

                    $psn='failed';
                        // return;
                    $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($msg1);
                    exit();                }
                // Check if file already exists
                if (file_exists($target_file)) {
                    $msg = "Sorry, file already exists.";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($msg1);
                    exit();
                }
                $table = 'sysSpec';
                $dtspec = $this->m_wsbangun->getData_cons('ifca3',$table);  
                if(!empty($dtspec)){
                    $max_upload_size = $dtspec[0]->max_upload_size.$dtspec[0]->max_upload_type;
                }else{
                    $max_upload_size = 0;
                }
                $max_size = $this->convertToBytes($max_upload_size);
                if ($_FILES["userfile"]["size"] > $max_size) {
                    $msg = "Maximum file size is ".$max_upload_size;
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($msg1);
                    exit();
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "JPEG" && $imageFileType != "JPEG" ) {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    $psn='failed';
                        // return;
                    $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

                    echo json_encode($msg1);
                    exit();
                }
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg = "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                        $psn = "failed";
                    }
                }
            }
            $criteria = array('id' => $id);
            if($action=='edit') {
                if(strpos($pict_name, base_url('img/NewsAndPromo/')) !==false ){
                $data = array(
                'entity_cd' => $entity,
                'project_no' => $project_no,
                'content_type' => $news,
                'subject' => $subject,
                'content' => $content,
                'attach_type' => $type,
                'youtube_link' =>$youtube,
                'picture' => $pict_name,
                'date_created'=>$date_created2,
                'start_date'=>$date_created,
                'end_date'=>$date_created1,
                'product_cd'=>$product_cd,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date,
                'home_flag'=>$homeflag
                );
                }else{
                $data = array(
                'entity_cd' => $entity,
                'project_no' => $project_no,
                'content_type' => $news,
                'subject' => $subject,
                'content' => $content,
                'attach_type' => $type,
                'product_cd'=>$product_cd,
                'youtube_link' =>$youtube,
                'picture' => base_url('img/NewsAndPromo/').$pict_name,
                'date_created'=>$date_created2,
                'start_date'=>$date_created,
                'end_date'=>$date_created1,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date,
                'home_flag'=>$homeflag
                );
                }
                $update = $this->m_wsbangun->updateDataweb('newsandpromo',$data, $criteria);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
            }
            else{
                $data = array(
                'entity_cd' => $entity,
                'project_no' => $project_no,
                'content_type' => $news,
                'subject' => $subject,
                'content' => $content,
                'attach_type' => $type,
                'product_cd'=>$product_cd,
                'youtube_link' =>$youtube,
                'picture' => base_url('img/NewsAndPromo/').$pict_name,
                'date_created'=>$date_created2,
                'start_date'=>$date_created,
                'end_date'=>$date_created1,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date,
                'home_flag'=>$homeflag
                );
                $insert = $this->m_wsbangun->insertDataweb('newsandpromo',$data);
                        if($insert == 'OK')
                        {
                            $msg="Data has been insert successfully";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
            }

     
        } else {
                $msg="Data validation is not valid";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }
}

// // public function save_newsfeed()
// //     {
// //         // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
// //         // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);

// //         // if ($pri->can_edit == '1' || $pri->can_add == '1') {
        
// //             $msg="";
// //             if ($_POST) 
// //             {
// //                 $id = (int)$this->input->post('id',TRUE);
// //                 $subject = $this->input->post('subject',TRUE);
// //                 $content = $this->input->post('content');
// //                 $status = $this->input->post('status',TRUE);
// //                 $youtube = $this->input->post('youtubelink',TRUE);
// //                 $entity = $this->session->userdata('Tsentity');
// //                 $project_no =$this->input->post('project_no',TRUE);
// //                 $pict_name =$this->input->post('Picture',TRUE);
// //                 $date_created  =$this->input->post('date_created',TRUE);
// //                 $date_created = date($date_created);
// //                 $date_created = DateTime::createFromFormat('d/m/Y H:i:s', $date_created.' 00:00:00');
// //                 $date_created = $date_created->format('Y-d-m H:i:s');
// //                 $pict_name = str_replace(' ', '_', $pict_name);
// //                 $audit_date = date('d M Y H:i:s');
// //                 $audit_user = $this->session->userdata('Tsuname');
// //                 $isFile  =$this->input->post('isFile',TRUE);
// //                 $seq_no = $this->input->post('seqno',TRUE);
// //                 // var_dump(strlen($pict_name));
// //                 // var_dump($pict_name);
// //                 // $tes='';
// //                 if($isFile=="true"){

// //                 $picture = $_FILES["userfile"];

// //                 // var_dump($picture);
// //                 $psn='';
                
// //                 // var_dump(strlen($picture));
// //                 // var_dump($picture["name"]);
// //                 $picture = array_filter($picture);

// //                 $target_dir = "./img/NewsFeed/";
// //                 $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
// //                 $uploadOk = 1;
// //                 $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// //                 // Check if image file is a actual image or fake image
// //                 if(isset($_POST["submit"])) {
// //                     $check = getimagesize($_FILES["userfile"]["tmp_name"]);
// //                     if($check !== false) {
// //                         $msg = "File is an image - " . $check["mime"] . ".";
// //                         $uploadOk = 1;
// //                     } else {
// //                         $msg = "File is not an image.";
// //                         $uploadOk = 0;
// //                     }
// //                 }
// //                 // Check if file already exists
// //                 if (file_exists($target_file)) {
// //                     $msg = "Sorry, file already exists.";
// //                     $uploadOk = 0;
// //                     $psn='failed';
// //                         // return;
// //                         $msg1=array("Pesan"=>$msg,"status"=>$psn);                           

// //                         echo json_encode($msg1);
// //                         exit();
// //                 }
// //                 // Check file size
// //                 if ($_FILES["userfile"]["size"] > 500000) {
// //                     $msg = "Sorry, your file is too large.";
// //                     $uploadOk = 0;
// //                 }
// //                 // Allow certain file formats
// //                 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// //                 && $imageFileType != "gif" ) {
// //                     $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
// //                     $uploadOk = 0;
// //                 }
// //                 // Check if $uploadOk is set to 0 by an error
// //                 if ($uploadOk == 0) {
// //                     $msg = "Sorry, your file was not uploaded.";
// //                 // if everything is ok, try to upload file
// //                 } else {
// //                     if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
// //                         $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
// //                     } else {
// //                         $msg = "Sorry, there was an error uploading your file.";
// //                     }
// //                 }
// //                     if(strlen($pict_name) > 1) {
// //                         $data = array(
// //                         'subject' => $subject,
// //                         'content' => $content,
// //                         'status' =>$status,
// //                         'youtube_link' =>$youtube,
// //                         'picture' =>$pict_name,
// //                         'entity_cd'=>$entity,
// //                         'seq_no'=>$seq_no,
// //                         'project_no'=>$project_no,
// //                         'date_created'=>$date_created,
// //                         'audit_user'=>$audit_user,
// //                         'audit_date'=>$audit_date
// //                     );    
// //                     }else{
// //                         $data = array(          
// //                         'subject' => $subject,
// //                         'content' => $content,
// //                         'status' =>$status,
// //                         'youtube_link' =>$youtube,
// //                         'date_created'=>$date_created,
// //                         // 'picture' =>$pict_name,
// //                         'seq_no'=>$seq_no,
// //                         'entity_cd'=>$entity,
// //                         'project_no'=>$project_no,
// //                         'audit_user'=>$audit_user,
// //                         'audit_date'=>$audit_date
// //                         );
// //                     }
                    
// //                     $criteria = array('id' => $id);
// //                     // var_dump($data);
// //                     if($id>0) {
// //                         $update = $this->m_wsbangun->updateDataweb('newsfeed',$data, $criteria);
// //                         if($update == 'OK')
// //                         {
// //                             $msg="Data has been updated successfully";
// //                             $psn = "OK";
// //                         } else {
// //                             $msg= $update;
// //                             $psn = "Failed";
// //                         }
// //                      //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("ADD newsfeed")));
// //                     } else {
// //                         $insert = $this->m_wsbangun->insertDataweb('newsfeed',$data);
// //                         if($insert == 'OK')
// //                         {
// //                             $msg="Data has been updated successfully";
// //                             $psn = "OK";
// //                         } else {
// //                             $msg= $insert;
// //                             $psn = "Failed";
// //                         }
                        
// //                      //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("EDIT newsfeed")));
// //                     }

// //                     // redirect("c_newsfeed");
// //                 // } // tutup if validation
// //             } //tutup post
// //             else{
// //                 $msg="Data validation is not valid";
// //             }
            
// //             $msg1=array("Pesan"=>$msg,
// //                 "status"=>$psn);
// //             // var $result = new{
// //             //     Response = $msg;
// //             // };

// //         echo json_encode($msg1);
// //     }
// }