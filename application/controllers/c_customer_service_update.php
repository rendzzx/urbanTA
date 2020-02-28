<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_customer_service_update extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        // $this->auth_check();
        $this->load->model('m_wsbangun');

    }
    public function index(){
            $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        // var_dump($projectName);
        $table = 'sysMenu';
        $DataMenu = $this->m_wsbangun->getData($table);        
        
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu,
            'ProjectDescs'=>$projectName,);
        
        $this->load_content_top_menu('customer_service_update/index',$content);
    } 
     function goto_signature(){ 
            $Name = $this->input->post('Name',TRUE);
            
            // var_dump($property_cd);
            // var_dump($level_no); exit;
           // var_dump(base_url()); 
            $Name = $Name.'.png';
            $data = array(
                                'Name_sign'=>$Name
                        );
            // var_dump($data);
            $this->load->view('customer_service_update/replace_signature_pict',$data);
        }
    public function update_form($rowID=0){
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');

        // $sql = 'Select * from mgr.v_sv_entry_hd_list where rowID = $rowID';
        $where = array('rowID' => $rowID );
        $data_custService = $this->m_wsbangun->getData_by_criteria('v_sv_entry_hd_list',$where);
        // var_dump($data_custService);

        $content = array(
            'data_cs'=>$data_custService,
            'ProjectDescs'=>$projectName,);
        
        $this->load_content_top_menu('customer_service_update/update',$content);


    }
    public function addsignature(){
        $this->load->view('customer_service_update/signature_form');
    }

     public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'report_no','name', 'lot_no', 'reported_date_string', 'status','work_requested');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_sv_entry_hd_list';

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
        $SordField = ($sortIdColumn==0? 'report_no' :$Column[$sortIdColumn]['name']);

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
        $param = ' where 1=1'. $filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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
    public function zoom_staff(){
        $staff = $this->input->post('staff',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $table = 'sv_labour (nolock)';
        $crit = array('staff_id', 'name');
        // $where = array('payment_status'=>'A');
        $combo_payment = $this->m_wsbangun->getCombo($table,$crit,null,$staff);
        echo $combo_payment;
      }

      public function zoom_category(){
        $Category = $this->input->post('Category',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $table = 'sv_category (nolock)';
        $crit = array('category_cd', 'descs');
        // $where = array('payment_status'=>'A');
        $combo_payment = $this->m_wsbangun->getCombo($table,$crit,null,$Category);
        echo $combo_payment;
      }
    public function save_signature(){
                $msg="";
                $st='';
            if ($_POST) 
            {
                $image_name= $_POST['image_name'];
                $imgData = base64_decode($_POST['imageData']);
                // REMOVE HEADER data:image/png;base64,
                // $img = str_replace('data:image/png;base64,', NULL, $imgData);
                // REVERSE BASE-64 ENCODING
                // $img = base64_decode($img);

                $filePath = "./img/signature/".$image_name.'.png';
                // STORE THE IMAGE
               if(file_put_contents($filePath, $imgData)){
                            $msg = "The file ". $image_name. " has been uploaded.";
                            $st ='OK';
               }else{
                            $msg = "Sorry, there was an error uploading your file.";
                            $st ='Fail';
               }
                // var_dump($imgData);
                

        // Path where the image is going to be saved
                // $filePath = '../img/signature/'.$image_name.'.jpg';
                

        // // Delete previously uploaded image
        //         if (file_exists($filePath)) { unlink($filePath); }

        // // Write $imgData into the image file
        //         $file = fopen($filePath, 'w');
        //         fwrite($file, $imgData);
        //         fclose($file);
                // if (move_uploaded_file($imgData, $filePath)) {
                //         $msg = "The file ". $image_name. " has been uploaded.";
                //     } else {
                //         $msg = "Sorry, there was an error uploading your file.";
                //     }

            }else{
                $msg="Data validation is not valid";
            }
            
           $msg1 = array('pesan'=>$msg,
                        'status'=>$st);
            
        echo json_encode($msg1);
    }
    private function setUploadOptions()
    {
        $max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/NUP',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }
    public function save(){
        
            $msg="";
            if ($_POST) 
            {
                $entity = $this->session->userdata('Tsentity');
                $project = $this->session->userdata('Tsproject');
                $rowID = $this->input->post('rowID', true);

                $staff = $this->input->post('ddstaff',TRUE);
                $problemcoused =$this->input->post('problemacoused',TRUE);                
                $category = $this->input->post('ddcategory',TRUE);
                $actionTaken = $this->input->post('actionTaken',TRUE);
                $remarks = $this->input->post('remarks',TRUE);
                $isFile  =$this->input->post('isFile',TRUE);

                $survey_date = $this->input->post('survey_date',TRUE);
                $start_date  =$this->input->post('start_date',TRUE);
                $est_completion_date = $this->input->post('est_completion_date',TRUE);
                $complete_date  =$this->input->post('complete_date',TRUE);
                $status = $this->input->post('action',TRUE);
                // var_dump($status);exit();

                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                $files = $_FILES;
                $cnt ='';
                // $picname = str_replace(' ', '_', $files['userfile']['name']);
                
                // var_dump($isFile);
                if($isFile=="true"){
                    // var_dump('otnay');
                    $this->load->library('upload');
                    $this->upload->initialize($this->setUploadOptions());
                    $picname =  $files['userfile']['name'];
                    $tmpName = $_FILES['userfile']['tmp_name'];
                    // var_dump($tmpName);
                    $imgString = file_get_contents($tmpName);
                    // var_dump($imgString);exit();
                    $imgData = bin2hex($imgString);
                    $imgbin ="0x".$imgData;
                    // var_dump($imgbin);
                   
                    $sql = "select count(sv_entryhd_rowid) as cnt from mgr.sv_attachment WHERE  sv_entryhd_rowid = $rowID";
                    $data = $this->m_wsbangun->getData_by_querypb($sql);
                    // var_dump($data);
                    $cnt = $data[0]->cnt;

                    if($cnt>0){
                         $sql = "   UPDATE mgr.sv_attachment SET file_attachment='$picname', file_attached=$imgbin, status_attach='1', audit_date='$audit_date' ";
                         $sql .= "   WHERE sv_entryhd_rowid = $rowID ";
                    }else{
                         $sql = "INSERT INTO mgr.sv_attachment(entity_cd,project_no,sv_entryhd_rowid,document_no,document_descs,";
                         $sql .= "document_status,file_attachment,file_attached,status_attach,audit_user,audit_date)";
                         $sql .= "    VALUES('$entity','$project','$rowID','1','Gambar Perbaikan','Y','$picname',$imgbin,'1','$audit_user','$audit_date')";
                    }

                    
                    $data = $this->m_wsbangun->setData_by_query($sql);
                    if($data !="OK"){
                            $msg= 'Upload File Failed : '.$data;
                            $st = 'Fail';

                            $msg1 = array('pesan'=>$msg,
                            'status'=>$st);
            
                            echo json_encode($msg1);
                            return;
                    }
                }
               
                if($status=='F') {
                    $data = array(          
                        'assign_to'=> $staff,                    
                        'problem_cause' =>$problemcoused,                        
                        'category_cd'=>$category,
                        'action_taken'=>$actionTaken,
                        'remarks'=>$remarks,
                        'complete_date'=>$complete_date,
                        'status'=>$status
                        );
                } else if($status=='S') {
                    $data = array(          
                        'assign_to'=> $staff,                    
                        'problem_cause' =>$problemcoused,                        
                        'category_cd'=>$category,
                        'action_taken'=>$actionTaken,
                        'remarks'=>$remarks,
                        'survey_date'=>$survey_date,
                        'status'=>$status
                        );
                } else if($status=='P') {
                    $data = array(          
                        'assign_to'=> $staff,                    
                        'problem_cause' =>$problemcoused,                        
                        'category_cd'=>$category,
                        'action_taken'=>$actionTaken,
                        'remarks'=>$remarks,
                        'start_date'=>$start_date,
                        'est_completion_date'=>$est_completion_date,
                        'status'=>$status
                        );
                } else {
                    $data = array(          
                        'assign_to'=> $staff,                    
                        'problem_cause' =>$problemcoused,                        
                        'category_cd'=>$category,
                        'action_taken'=>$actionTaken,
                        'remarks'=>$remarks//,
                        //'status'=>'P'
                        );
                }
                        
                    

                    
                
                    if($rowID>0) {
                        $criteria = array('rowID' => $rowID);
                        $data = $this->m_wsbangun->updateData('sv_entry_hd',$data, $criteria);
           
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been updated successfully";
                            $st = 'OK';
                        }
                 
                    } 

            } 
            else{
                $msg="Data validation is not valid";
            }
            
           $msg1 = array('pesan'=>$msg,
                    'status'=>$st);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
}