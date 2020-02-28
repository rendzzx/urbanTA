<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_ticket_history extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }
    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsname');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');
        $project = $this->session->userdata('Tsproject');
        $email = $this->session->userdata('Tsemail');
        $unit = $this->input->post('lot_no',TRUE);
        $business_id=$this->input->post('business_id',TRUE);

        $read_date=$this->input->post('read_date',TRUE);
        $debtor_acct=$this->input->post('debtor_acct',TRUE);


        $group = $this->session->userdata('Tsusergroup');
            
      
        $table = 'securityuserdebtor';
        $crit = array('UserId'=>$name);
        $cons = $this->session->userdata('Tscons');
            // $crit = array('debtor_acct'=>$name);
        $DataMenu = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);

        if(empty($DataMenu)){
           
            $dsb = 'false';
            $datadebtor = $this->zoom_debtor("");
          
            
        }else{
            
            if(count($DataMenu)>0){
                $dsb = 'false';    
            } else {
                $dsb = 'true';    
            }
            $datadebtor = $this->zoom_debtor($DataMenu[0]->Debtor_acct);

            $table = 'v_logindebtor';
            $crit = array('debtor_acct'=>$DataMenu[0]->Debtor_acct);
            $cons = $this->session->userdata('Tscons');
            $dt = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
     
            // var_dump($dtunit);exit;
            
        }

        $month = date("m");
        $year = date("Y");

        $param="";
        if(!empty($pro)){
            $project = trim($pro);
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $cons = $this->session->userdata('Tscons');
            $datas = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $entity = $datas[0]->entity_cd;

        }else{
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
           
        }
 
        $content = array('debtor_acct'=>$name,
            'project_no'=>$project,
            'sys'=>$admin,
            'ddx'=>$dsb,
            'approver'=>0,
            'project'=>$DataMenu,
            'dtdebtor'=>$datadebtor,
          
            'ProjectDescs'=>$projectName);
        
        $this->load_content_top_menu('customer_ticket/index',$content);
    } 


     public function viewticket($rowid){
        $projectName = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsname');
        $table = 'securityuserdebtor';
        $crit = array('UserId'=>$name);
        // var_dump($rowid);//exit();
            // $crit = array('debtor_acct'=>$name);
        $cons = $this->session->userdata('Tscons');
        $DataMenu = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        $content = array(
            'rowid'=>$rowid,
            'ProjectDescs'=>$projectName );
        $this->load_content_top_menu('customer_ticket/viewticket',$content);
    }
    public function zoom_category($from=''){
        $category_cd = $this->input->post('category_cd',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $sql = "select * from mgr.sv_category ";
        $cons = $this->session->userdata('Tscons');
        $rst = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        //var_dump($rst);
        $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if($category_cd==$result->category_cd){
                    $pilih='selected="1"';
                }else {
                    $pilih='';
                }
                $combo[] = '<option value="'.trim($result->category_cd).'" '.$pilih.'>'.$result->descs.'</option>';
            }
            if($from=='controller'){
                return implode("", $combo);    
            } else{
                echo implode("", $combo); 
            }
            
      }
    public function editticket($rowid){
        $projectName = $this->session->userdata('Tsprojectname');
        $name = $this->session->userdata('Tsname');
        // $table = 'securityuserdebtor';
        // $crit = array('UserId'=>$name);
        //     // $crit = array('debtor_acct'=>$name);
        // $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);
        // var_dump($this->zoom_debtor());exit();
        $content = array(
            'rowid'=>$rowid,
            'dtdebtor'=>$this->zoom_debtor(),
            'datacategory'=>$this->zoom_category('controller'),
            'ProjectDescs'=>$projectName );
        $this->load_content_top_menu('customer_ticket/editticket',$content);
    }
    public function getTicketByID($rowid=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
  
        $where=array('rowID'=>$rowid);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_criteria_cons('v_ticket',$cons,$where);
        // var_dump($rowID);
        foreach ($data as $key => $value ) {

            $picbase64 = base64_encode($value->file_attached);
            $value->file_attached = $picbase64;
        }

        echo json_encode($data);

    }
    public function deletedetail(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $complain_no = $this->input->post('complain_no',true);
        $seqno = $this->input->post('seqno',true);
        
        $where=array('complain_no'=>$complain_no,'seq_no'=>$seqno,'entity_cd'=>$entity,'project_no'=>$project);
        $where2=array('sv_entryhd_rowid'=>$complain_no,'document_no'=>$seqno,'entity_cd'=>$entity,'project_no'=>$project);
        $cons = $this->session->userdata('Tscons');
        $count = $this->m_wsbangun->getData_by_criteria_cons('sv_entry_multi_dt',$cons,$where);
        // var_dump(count($count));
        if(count($count)>0){
            $data = $this->m_wsbangun->deletedata('sv_entry_multi_dt',$where);
            if($data !="OK"){
                $msg= $data;
                $psn = 'Fail detail';
            }else{
                $data = $this->m_wsbangun->deletedata('sv_attachment',$where2 );
                if($data !="OK"){
                    $msg= $data;
                    $psn = 'Fail attach';
                }else{
                    $msg="Data has been deleted successfully";
                    $psn = 'OK';
                 }
             }
        } else {
            $msg="Data has been deleted successfully";
            $psn = 'OK';
        }
        
        $msg1 = array('pesan' => $msg,'status'=>$psn );
        echo json_encode($msg1);

    }
   public function zoom_lotno($debtor_acct='', $from='')
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
  
        $where=array('project_no'=>$project,
            'entity_cd'=>$entity,
            'debtor_acct'=>$debtor_acct);
        $cons = $this->session->userdata('Tscons');
        $proUnit = $this->m_wsbangun->getData_by_criteria_cons('v_pm_debtor_unit',$cons,$where);

        
        // var_dump($entityName);
             if(!empty($proUnit)) {
                $unit = $proUnit[0]->lot_no;
                        $comboUnit[] = '<option></option>';
                        foreach ($proUnit as $dtUnit) {
                          if($unit === $dtUnit->lot_no) {
                            $pilih = ' selected = "1"';
                          } else {
                            $pilih = '';
                          }
                            $comboUnit[] = '<option '.$pilih.' value="'.$dtUnit->lot_no.'">'.$dtUnit->lot_no.'</option>';
                        }
                        $comboUnit = implode("", $comboUnit);
                    } else {
                        $comboUnit= '<option></option>';
                    }
            if($from=='controller') {
                return $comboUnit;
            } else {
                echo $comboUnit;
            }            
            
    }

    public function zoom_debtor($debtor_acct='')
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $this->load->model('m_wsbangun'); 
        $table = 'v_logindebtor';

        if(empty($debtor_acct) or $debtor_acct==''){
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project );
        } else {
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project,
                    'UserID'=>$name );
        }
        $cons = $this->session->userdata('Tscons');
        $proDescs = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // var_dump($entityName);
        $comboProject[] = '<option></option>';
        if(empty($debtor_acct) or $debtor_acct==''){
            $comboProject[] = '<option value="all">All</option>';
        }
            if(!empty($proDescs)) {
                
                foreach ($proDescs as $dtProject) {
                  if($debtor_acct === $dtProject->debtor_acct) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->debtor_acct.'" data-telp="'.$dtProject->hand_phone.'" data-businessid="'.$dtProject->business_id.'">'.$dtProject->debtor_acct.'-'.$dtProject->name.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }
    public function zoom_debtor_dd()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $debtor_acct = $this->input->post('Id',true);
        $table = 'securityuserdebtor';
        $crit = array('UserId'=>$name);
        $cons = $this->session->userdata('Tscons');
        $DataMenu = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        $this->load->model('m_wsbangun'); 
        $table = 'v_logindebtor';
        $cons = $this->session->userdata('Tscons');
        if(count($DataMenu)>0){

            $crit = array('entity_cd' => $entity,
                        'project_no'=>$project,
                        'UserID'=>$name );
        } else {
                $crit = array('entity_cd' => $entity,
                    'project_no'=>$project );
        }
        
        $proDescs = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // var_dump($entityName);
        $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                
                foreach ($proDescs as $dtProject) {
                    // var_dump($debtor_acct."---".$dtProject->debtor_acct);
                  if(trim($debtor_acct) == trim($dtProject->debtor_acct)) {
                    $pilih = ' selected = "1"';
                    // var_dump($debtor_acct);exit;
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->debtor_acct.'" data-telp="'.$dtProject->hand_phone.'" data-businessid="'.$dtProject->business_id.'">'.$dtProject->debtor_acct.'-'.$dtProject->name.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            echo $comboProject;
    }

    public function tableLatestTicket()
    {
        $product = $this->input->post('prod',TRUE);
        $project = $this->session->userdata('Tsproject');  
        $entity = $this->session->userdata('Tsentity');
        $debtor_acct = $this->input->post('debtor_acct', true);   
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'report_no','name', 'lot_no', 'reported_date_string', 'status','work_requested','category_descs');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_sv_entry_multi_list';
        
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
        $addsort = 'report_no';
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
       
        $where = '';
      
        // var_dump($debtor_acct);exit();
        if($debtor_acct!='all' || empty($debtor_acct))
        {
            // var_dump('b');
            $where="AND debtor_acct='".$debtor_acct."' ".$where;
        }
        
        // var_dump($filter_search);
        // $param = $filter_search;
        // // var_dump($param);
        // $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);    
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttableagent_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$addsort);    

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
    public function addpic(){
        $this->load->view('customer_ticket/add_pic');
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
                       
                                $imgString = file_get_contents($tmpName);
                           
                                $imgData = bin2hex($imgString);
                                $imgbin ="0x".$imgData;
                                $cons = $this->session->userdata('Tscons');

                                        $sql = "select count(sv_entryhd_rowid) as cnt from mgr.sv_attachment WHERE  entity_cd = '$entity' and project_no='$project' and sv_entryhd_rowid = $complain_no and document_no = $seqno";
                                        $datacnt = $this->m_wsbangun->getData_by_querypb_cons($cons,$sql);
                                        $cnt = $datacnt[0]->cnt;

                                        if($cnt>0){
                                             $sql = "UPDATE mgr.sv_attachment SET file_attachment='$picname', file_attached=$imgbin, status_attach='1', audit_date='$audit_date' ";
                                             $sql .= "   WHERE sv_entryhd_rowid = $complain_no and document_no = $seqno";
                                             // var_dump('update');exit();
                                        }else{
                                             $sql = "INSERT INTO mgr.sv_attachment(entity_cd,project_no,sv_entryhd_rowid,document_no,document_descs,";
                                             $sql .= "document_status,file_attachment,file_attached,status_attach,audit_user,audit_date)";
                                             $sql .= "    VALUES('$entity','$project','$complain_no','$seqno','Gambar Perbaikan','Y','$picname',$imgbin,'1','$audit_user','$audit_date')";
                                            // var_dump('update');exit();
                                        }
// var_dump($sql);exit();
                                        
                                        $data = $this->m_wsbangun->setData_by_query($sql);
                                        // var_dump($data);
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
    public function save(){
        
            $msg="";
            if ($_POST) 
            {
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
                $debtor_acct = $this->input->post('debtor_name', true);
                $complain_type = $this->input->post('ticket_type',true);
                $req_by = $this->input->post('serv_req_by',TRUE);
                $contact_no =$this->input->post('contact_no',TRUE);
                $lotno = $this->input->post('lot_no',TRUE);
                $lotdescs = $this->input->post('lotdescs',TRUE);           
                $floor = $this->input->post('floor',TRUE);
                $rowid = $this->input->post('rowid',TRUE);
                $complain_no = $this->input->post('complain_no',TRUE);
                $report_no = $this->input->post('report_no',TRUE);
                $location = $this->input->post('location',TRUE);
                $category = $this->input->post('category',TRUE);
                $work_req = $this->input->post('work_req',TRUE);
                $picname = $this->input->post('picturename',TRUE);
                $batas = $this->input->post('batas',TRUE);
                $seqno = $this->input->post('seq_no_detail',TRUE);
                
                $audit_date = date('Y M d H:i:s');
                $audit_user = $this->session->userdata('Tsname');
                $batasloop = count($seqno);
               
                
                        $data = array(          
                     
                        'debtor_acct' =>$debtor_acct,                     
                        'serv_req_by'=>$req_by,
                        'lot_no'=>$lotno,
                        'floor'=>$floor,
                        'reported_by'=>$audit_user,
                        'work_requested'=>$work_req[0],
                        'category_cd'=>$category[0],
                        'contact_no'=>$contact_no,
                        'complain_type'=>$complain_type,
                        'location'=>$location,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );
                        $criteria = array('report_no'=>$report_no,'rowid' => $rowid,'entity_cd'=>$entity,'project_no'=>$project);
                        // var_dump($data);exit();
                        // $insert = $this->m_wsbangun->insertData('sv_entry_multi',$data);
                        $update = $this->m_wsbangun->updateDataweb('sv_entry_multi',$data, $criteria);
                        // var_dump('data dari sv_entry_multi');
                        // var_dump($insert);
                        if($update !="OK"){
                            $msg= $update;
                            $psn = 'Fail multi';
                        }else{
                            $msg="Data has been updated successfully";
                            $psn = 'OK';
                            
                            //uodate detail
                       
         
                                for ($i=0; $i < $batasloop; $i++) { 
                                
                                $sql = "select count(*) as cnt from mgr.sv_entry_multi_dt(nolock) WHERE  entity_cd = '$entity' and project_no='$project' and complain_no = $complain_no and seq_no = $seqno[$i]";
                                $cons = $this->session->userdata('Tscons');
                                        $data = $this->m_wsbangun->getData_by_querypb_cons($cons,$sql);
                         
                                        $cnt = $data[0]->cnt;
                                        if($cnt>0){
                                            $updata = array(  
                                                'debtor_acct' =>$debtor_acct,            
                                                'serv_req_by'=>$req_by,
                                                'reported_by'=>$audit_user,
                                                'lot_no'=>$lotno,
                                                'floor'=>$floor,
                                                'contact_no'=>$contact_no,
                                                'location'=>$location,
                                                'category_cd'=>$category[$i],
                                                'work_requested'=>$work_req[$i],
                                                'picture'=>$picname[$i],
                                                'audit_user'=>$audit_user,
                                                'audit_date'=>$audit_date
                                                );
                                                $crit = array('entity_cd' => $entity,'project_no'=>$project,'complain_no'=>$complain_no,'seq_no'=>$seqno[$i] );
                                                $insertdt = $this->m_wsbangun->updateDataweb('sv_entry_multi_dt',$updata,$crit);
                                                if($insertdt !="OK"){
                                                    $msg= $insertdt;
                                                    $psn = 'Fail update';
                                                }else{
                                                    $msg="Data has been saved successfully";
                                                    $psn = 'OK';

                                                }
                                            } else {
                                                $insdata = array(          
                              
                                                    'entity_cd' => $entity,
                                                    'project_no' => $project,
                                                    'debtor_acct' =>$debtor_acct,
                                                    'report_no' =>$report_no,                        
                                                    'serv_req_by'=>$req_by,
                                                    'reported_by'=>$audit_user,
                                                    'seq_no'=>$seqno[$i],
                                                    'reported_date'=>$audit_date,
                                                    'lot_no'=>$lotno,
                                                    'floor'=>$floor,
                                                    'status'=>'R',
                                                    'complain_no'=>$complain_no,
                                                    'contact_no'=>$contact_no,
                                                    'location'=>$location,
                                                    'category_cd'=>$category[$i],
                                                    'work_requested'=>$work_req[$i],
                                                    'picture'=>$picname[$i],
                                                    'audit_user'=>$audit_user,
                                                    'audit_date'=>$audit_date
                                                    );
                                                    
                                                    $insertdt = $this->m_wsbangun->insertData('sv_entry_multi_dt',$insdata);
                                          
                                                    if($insertdt !="OK"){
                                                        $msg= $insertdt;
                                                        $psn = 'Fail';
                                                    }else{
                                                        $msg="Data has been saved successfully";
                                                        $psn = 'OK';

                                                    }

                                            }
                                // $savedata = array(          
                              
                                //     'entity_cd' => $entity,
                                //     'project_no' => $project,
                                //     'debtor_acct' =>$debtor_acct,
                                //     'report_no' =>$report_no,                        
                                //     'serv_req_by'=>$req_by,
                                //     'reported_by'=>$audit_user,
                                //     'seq_no'=>$i,
                                //     'reported_date'=>$audit_date,
                                //     'lot_no'=>$lotno,
                                //     'floor'=>$floor,
                                //     'status'=>'R',
                                //     'complain_no'=>$complain_no,
                                //     'contact_no'=>$contact_no,
                                //     'location'=>$location,
                                //     'category_cd'=>$category[$i],
                                //     'work_requested'=>$work_req[$i],
                                //     'picture'=>$picname[$i],
                                //     'audit_user'=>$audit_user,
                                //     'audit_date'=>$audit_date
                                //     );
                                    
                                //     $insertdt = $this->m_wsbangun->insertData('sv_entry_multi_dt',$savedata);
                                
                                    

                                }//end looping


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