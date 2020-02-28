<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_agent extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // $this->load->model('m_login');
        // $this->load->model('m_wsbangun');
        // require APPPATH . 'third_party\google\vendor\autoload.php';
    }
    // public function log_with_google()
    // {
    //     # cek sudah login belum
    //     // if (!empty($this->session->userdata('logingoogle'))) {
    //     //     redirect('agent');
    //     // }
  
    //     # redirect ke auth url google
    //     $client = $this->get_google_client();
    //     $auth_url = $client->createAuthUrl();
    //     redirect($auth_url);
    // }
    // private function get_google_client()
    // {
    //     $client = new Google_Client();
    //     $client->setAuthConfigFile(APPPATH . 'client_secret.json'); //rename file ini supaya lebih aman nanti
    //     $client->setRedirectUri(base_url('c_agent/google'));
    //     $client->setScopes(array(
    //         "https://www.googleapis.com/auth/plus.login",
    //         "https://www.googleapis.com/auth/userinfo.email",
    //         "https://www.googleapis.com/auth/userinfo.profile",
    //         "https://www.googleapis.com/auth/plus.me",
    //     ));
  
    //     return $client;
    // }
    // public function google()
    // {
    //     # kalo sudah login atau tidak ada get code, redirect
    //     // if (!empty($this->session->userdata('logingoogle')) OR empty($_GET['code'])) {
    //     //     redirect('agent');
    //     // }
  
    //     $client = $this->get_google_client();
    //     $client->authenticate($_GET['code']);
  
    //     # ambil profilenya
    //     $plus = new Google_Service_Plus($client);
    //     $profile = $plus->people->get("me");
    //     $datagoogle = array('email'=>$profile['emails'][0]['value'],
    //                          'displayName'=>$profile['displayName'],
    //                          'familyName'=>$profile['name']['familyName'],
    //                          'givenName'=>$profile['name']['givenName'],
    //                          'idgoogle'=>$profile['id']    
    //                          );
    //     $this->session->set_userdata('logingoogle', $profile);
    //     // echo "<pre>";
    //     // var_dump($datagoogle);
    //     // var_dump($profile['emails'][0]['value']);
    //     redirect('agent');
    // }
    // public function logoutgoogle()
    // {
    //     $this->session->set_userdata('logingoogle', null);
 
    //     redirect('agent');
    // }
   
	public function mainPage(){
		// var_dump('expression');
		// $this->load->view('agent/index');
        // $profile= $this->session->userdata('logingoogle');
        // echo "<pre>";
        // var_dump($profile);
        // echo $profile['modelData']['email'][0]['value'];
        // echo  $profile['emails'][0]['value']."<br> Nama : ".$profile['name']['familyName']." ".$profile['name']['givenName'];
            

        $cp = $this->setCaptcha();
        // $seqno = $this->Next_Number('Agent_seq_no','seqno');
        // $cnt = $this->cek_agent_attach('2101','210101',$seqno,'WEB');
        // // var_dump($cnt);exit;
        // $cp['seq_no'] = $seqno;
        // $CI=&get_instance();
        // $CI->load->database();
        // $cp['hostname'] = $CI->db->hostname;
        // $cp['dbName']=$CI->db->database;
        // var_dump($seqno);
        // $content = array(
        //         'cp'=>$cp,
        //         'seq_no'=> $seqno
        //     );
        // var_dump($cp);
        $this->load->view('agent/index', $cp);
	}
    
    public function cek_offEmail(){
        $this->load->model('m_wsbangun');
        // $isStatus = (bool)true;
        $pName    = $this->input->POST('pName',TRUE);
        // var_dump($pName);
        $where =array('Company_Email'=>$pName);
        $cnt = $this->m_wsbangun->getCount_by_criteria('cf_agent_hd',$where);
        // var_dump($cnt);
        // if($cnt>0){
        //     $isStatus = (bool)false;
        // }

        echo $cnt; 
    }

    public function cek_emailAdd(){
        $this->load->model('m_wsbangun');
        // $isStatus = (bool)true;
        $pName    = $this->input->POST('pName',TRUE);
        // var_dump($pName);
        $where =array('Email_Addr'=>$pName);
        $cnt = $this->m_wsbangun->getCount_by_criteria('cf_agent_hd',$where);
        // var_dump($cnt);
        // if($cnt>0){
        //     $isStatus = (bool)false;
        // }

        echo $cnt; 
    }     

    public function cek_office(){
        $this->load->model('m_wsbangun');
        // $isStatus = (bool)true;
        $pName    = $this->input->POST('pName',TRUE);
        // var_dump($pName);
        $where =array('group_name'=>$pName);
        $cnt = $this->m_wsbangun->getCount_by_criteria('cf_agent_hd',$where);
        // var_dump($cnt);
        // if($cnt>0){
        //     $isStatus = (bool)false;
        // }

        echo $cnt; 
    }
    public function cek_PT(){
        // $isStatus = (bool)true;
        $this->load->model('m_wsbangun');
        $pName    = $this->input->POST('pName',TRUE);
        // var_dump($pName);
        $where =array('company_name'=>$pName);
        $cnt = $this->m_wsbangun->getCount_by_criteria('cf_agent_hd',$where);
        // var_dump($cnt);
        // if($cnt>0){
        //     $isStatus = (bool)false;
        // }

        echo $cnt; 
    }


    public function cek_offNPWP(){
        $this->load->model('m_wsbangun');
        // $isStatus = (bool)true;
        $pName    = $this->input->POST('pName',TRUE);
        // var_dump($pName);
        $where =array('Company_NPWP'=>$pName);
        $cnt = $this->m_wsbangun->getCount_by_criteria('cf_agent_hd',$where);
        // var_dump($cnt);
        // if($cnt>0){
        //     $isStatus = (bool)false;
        // }

        echo $cnt; 
    }

    public function cek_valueNPWP(){
        $this->load->model('m_wsbangun');
        // $isStatus = (bool)true;
        $pName    = $this->input->POST('pName',TRUE);
        // var_dump($pName);
        $where =array('Company_NPWP'=>$pName);
        $cnt = $this->m_wsbangun->getCount_by_criteria('cf_agent_hd',$where);
        // var_dump($cnt);
        // if($cnt>0){
        //     $isStatus = (bool)false;
        // }

        echo $cnt; 
    }
    public function load_captcha(){
         $this->session->unset_userdata('captchaAgent');
        $cp = $this->setCaptcha();
        $this->load->view('agent/captcha',$cp);
    }


    public function load_panel3($status='',$type=''){
        $this->load->model('m_wsbangun');

        // var_dump('expression');
        $a = $this->zoom_brand();
        // $b = '';
        // $tbl = 'cf_province_dtl';
        // $EntityData = $this->m_wsbangun->getData($tbl);
        // $table = 'v_list_city (nolock)';
        // $obj = array('city', 'coba');
        // $order = array('rowid', 'ASC');
        $comboCity = '';//$this->m_wsbangun->getCombo($table,$obj,null,null,$order);

        $content=array(
            'zoom_brand'=>$a,
            'Type' =>$type,
            'comboCity'=>$comboCity,
            'comboLead'=>$this->Lead()
            // 'descs' => $descs
            // 'province_cd' => $province_cd,
            // 'city' => $city,
            // 'seq_no' => $seq_no,

            );
        $this->load->view('agent/panel3',$content);
    }

    // 
      
      public function zoom_province(){
        $this->load->model('m_wsbangun');
        $pro = $this->input->post('ent',TRUE);       
        $table = 'cf_province';
        $proDescs = $this->m_wsbangun->getData($table);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($pro === $dtProject->province_cd) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->province_cd.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            echo $comboProject;
      }

    public function update_attach(){
        $this->load->model('m_wsbangun');
        $Id             = $this->input->POST('Id',TRUE);
        $obj = array('file_attachment'=>'',
                        'file_attached'=>null);
        $where =array('agent_sequence_no'=>$Id);
        $this->m_wsbangun->updateData('rl_agent_attachment',$obj,$where);
    }
    public function load_panel4($status='',$type=''){
        $this->load->model('m_wsbangun');
        // var_dump($status);
        // var_dump($type);
        $datalist = $this->zoom_group_cd($type);

        $table = 'v_list_city (nolock)';
        $obj = array('city', 'coba');
        $order = array('rowid', 'ASC');
        $comboCity = '';//$this->m_wsbangun->getCombo($table,$obj,null,null,$order);

        // var_dump($datalist);
        $content=array('zoom'=>$datalist,
                        'comboCity'=>$comboCity
                        );


        $this->load->view('agent/panel4',$content);
    }

    public function load_panel5(){
        $this->load->view('agent/panel5');
    }

    public function load_panel6($status='',$type=''){
        $this->load->model('m_wsbangun');
        
        $table = 'v_list_city (nolock)';
        $obj = array('city', 'coba');
        $order = array('rowid', 'ASC');
        $comboCity = '';//$this->m_wsbangun->getCombo($table,$obj,null,null,$order);

        $content=array('comboCity'=>$comboCity);

        $this->load->view('agent/panel6', $content);
    }

    public function load_panel7(){
        $this->load->view('agent/panel7');
    }

    public function load_panel8(){
        $this->load->model('m_wsbangun');
       $table = 'v_list_city (nolock)';
        $obj = array('city', 'coba');
        $order = array('rowid', 'ASC');
        $comboCity = '';//$this->m_wsbangun->getCombo($table,$obj,null,null,$order);

        $content=array('comboCity'=>$comboCity);

        $this->load->view('agent/panel8', $content);
    }

    private function setCaptcha()
    {
        // $rand_number = substr(number_format(time() * rand(), 0, '',''),0,4);
        $rand_number = substr(md5(uniqid(rand(), true)), 0, 4);
        $va = array('img_path'=>'./img/static/',
            'img_url'=>base_url().'img/static/',
            // 'font_size'=>300,
            'font_path'=>FCPATH. 'dist/captcha4.ttf',
            'word'=>$rand_number,
            'img_width'=>140,
            'img_height'=> 34,
            'expiration'=>3600
            );
        $cp = create_captcha($va);
        // var_dump($cp['word']);
        $this->session->set_userdata('captchaAgent', $cp['word']);
        return $cp;
    }

    private function isPostBack() { 
        return ($_SERVER['REQUEST_METHOD'] == 'POST');
    }
    function cek_agent_attach($entity='',$project='',$seqno='',$user=''){
        // var_dump($entity)
        $this->load->model('m_wsbangun');
        $dday = date('d M Y H:i:s');
        $sql = "SELECT count(*) AS cnt FROM mgr.rl_agent_attachment WHERE agent_sequence_no=$seqno";
        // var_dump($sql);
        // exit;
        $dtA = $this->m_wsbangun->getData_by_query($sql);//? $this->m_wsbangun->setData_by_query3($sql):0;
        // var_dump($dtA);exit;
        // if ($dtA == 'OK'){
        //     $cnt = 1; //$dtA->cnt;    
        // }else{
        //     $cnt = 0;
        // }
        if(!empty($dtA)){
            $cnt = $dtA[0]->cnt;
        }
        // $dtA = $dtA->result();
        // $cnt = $dtA[0]->cnt;
        // var_dump('expression');
        
        if($cnt == 0)
        {
            // $sql = "SELECT entity_cd, project_no, document_no, descs, STATUS, $seqno, '$user', '$dday' FROM mgr.rl_document_mst WHERE entity_cd='$entity' AND project_no='$project'";
            $sql = "SELECT entity_cd, project_no, document_no, descs, STATUS FROM mgr.rl_document_agent WHERE entity_cd='$entity' AND project_no='$project'";
            $dtB = $this->m_wsbangun->getData_by_query($sql);
            // var_dump($dtB);exit;
            if(!empty($dtB))
            {
                foreach ($dtB as $value) {
                    $table = 'rl_agent_attachment';
                    $data = array('entity_cd' => $value->entity_cd, 
                            'project_no' => $value->project_no,
                            'document_no' => $value->document_no,
                            'document_descs' => $value->descs,
                            'document_status' => $value->STATUS,
                            'agent_sequence_no' => $seqno,
                            'audit_user' => $user,
                            'audit_date' => $dday);
                    $this->m_wsbangun->insertData($table, $data);
                    // var_dump('sss');

                }
            }
        }
        $sql = "SELECT count(agent_sequence_no) as counter FROM mgr.rl_agent_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND agent_sequence_no=$seqno ";
        $sql.= "AND (status_attach IS NULL OR status_attach='0')";
        $dtCnt = $this->m_wsbangun->getData_by_query($sql);
        $cnt = $dtCnt[0]->counter;

        return $cnt;
    }
    private function Next_Number($Name='',$type=''){
        $this->load->model('m_wsbangun');
        $_result ='';
        $where=array('Name'=>$Name);
        $data = $this->m_wsbangun->getData_by_criteria('Next_Number',$where);
        $Count = (string)$data[0]->Counter;
        if($type=='HD'){
            $_result = $Count;
        }else if($type='seqno')
        {
            $_result = $Count;
        }else{
            // $CountDt = $Count;//(string)substr($Count, 1);
            $_result = $Count;//(string)$type+$CountDt;

        }
        $data = array('COUNTER'=>$Count+1);
        $this->m_wsbangun->updateData('Next_Number',$data,$where);
        return $_result;
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
    public function zoom_group_cd($type=''){
        $this->load->model('m_wsbangun');
        $table = 'cf_agent_hd (nolock)';
        $crit = array('group_cd', 'group_name');
        $where = array('group_type'=>$type,
                        'entity_cd'=>'2101');
        $customer = $this->m_wsbangun->getCombo($table,$crit,$where);
        return $customer;
    }
    public function zoom_brand(){
        $this->load->model('m_wsbangun');
        $table = 'cf_brand_agent (nolock)';
        $crit = array('brand_cd', 'brand_name');
        $customer = $this->m_wsbangun->getCombo($table,$crit);
        return $customer;
    }
    public function downloadFile($seqno='',$document_no=''){
        // var_dump($seqno);
        // var_dump($document_no);
        $this->load->model('m_wsbangun');
        $entity = '2101';//$this->session->userdata('Tsentity');
        $project = '210101';//$this->session->userdata('Tsproject');
        // $seqno = $this->input->post('seqno',true);
        // $document_no = $this->input->post('document_no',true);
        // $where =array('entity_cd'=>$entity,
        //            'project_no'=>$project,
        //            'nup_sequence_no'=>$seqno,
        //            'document_no'=>$document_no);
        // $data = $this->m_wsbangun->getData_by_criteria('rl_nup_attachment',$where);
        $sql="select file_attachment,file_attached from mgr.rl_agent_attachment ";
        $sql.=" where entity_cd='".$entity."' and project_no='".$project."' and agent_sequence_no=".$seqno." and document_no=".$document_no;
        $data = $this->m_wsbangun->getData_by_query($sql);
        // var_dump($data);
        // exit;
        $filename = $data[0]->file_attachment;
        $filedata = $data[0]->file_attached;
        $a = strrpos($filename, '.')+1;  
        $c = strlen($filename);
        $ext = substr($filename, $a,$c-$a);
        // $file = base64_decode($filedata);
        $file = $filedata;

          switch ($ext) 
            {
              case "pdf": $filetype="application/pdf"; break;
              case "exe": $filetype="application/octet-stream"; break;
              case "zip": $filetype="application/zip"; break;
              case "doc": $filetype="application/msword"; break;
              case "xls": $filetype="application/vnd.ms-excel"; break;
              case "ppt": $filetype="application/vnd.ms-powerpoint"; break;
              case "gif": $filetype="image/gif"; break;
              case "png": $filetype="image/png"; break;
              case "jpeg":
              case "jpg": $filetype="image/jpg"; break;
              default: $filetype="application/force-download";
            }
        // var_dump($file);
        // var_dump(strlen($file));
        header("Pragma: public"); 
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 
        header("Content-Type: $ctype");
        header("Cache-Control: no-cache private");
        header("Content-Description: File Transfer");
        header("Content-Type: ".$filetype);
        header('Content-disposition: attachment; filename='.$filename);
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '. strlen($file));
        ob_clean();
        flush();
        echo $file;
        exit;
    }
    public function saveUpload()
    {
        if($_POST)
        {
            $this->load->model('m_wsbangun');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $today = date('d M Y H:i:s');
            $row = $this->input->post('row',true);
            $seqno = $this->input->post('sn',true);
            $files = $_FILES;
            $cnt ='';
            $picname = str_replace(' ', '_', $files['userfile']['name']);
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());
                $tmpName = $_FILES['userfile']['tmp_name'];
                // var_dump($tmpName);
                $imgString = file_get_contents($tmpName);
                // var_dump($imgString);
                $imgData = bin2hex($imgString);
                $imgbin ="0x".$imgData; 
                $sql = "UPDATE MGR.rl_agent_attachment SET file_attachment='$picname', file_attached=$imgbin, status_attach='1', audit_date='$today' ";
                $sql.= "WHERE rowID=$row";
                $this->m_wsbangun->setData_by_query($sql);
                $msg = "file has been saved successfully";

                $sql = "SELECT count(agent_sequence_no) as counter FROM mgr.rl_agent_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND agent_sequence_no=$seqno ";
                $sql.= "AND (status_attach IS NULL OR status_attach='0')";
                $dtCnt = $this->m_wsbangun->getData_by_query($sql);
                $cnt = $dtCnt[0]->counter;
                if(empty($dtCnt)){
                    $cnt = 0;
                }
            // }
            $res = array('pesan'=>$msg, 
                        'count'=>$cnt
                        );
            echo json_encode($res);
        } 
        
    }
    public function formupload(){
        $this->load->view('agent/upload');
        
    }
    public function getTableAttach()
    {
        $entity ='2101'; //$this->session->userdata('Tsentity');
        $this->load->model('m_wsbangun');
        // var_dump($entity);
        $project ='210101';// $this->session->userdata('Tsproject');
        $name = 'web';//$this->session->userdata('Tsuname');
        $seqno = $this->input->post('seqno', true);

        $DB2 = $this->load->database('ifca2', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number', 'document_no', 'document_descs', 'file_attachment');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.rl_agent_attachment';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        // if($iDisplayLength<0){
        //  $iDisplayLength=5;
        // }
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('search', true);
        $Search = $sSearch['value'];

        $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $aColumns[1] :$column[$sortIdColumn]['name']);

     

        // filter
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
        
        $param =" Where agent_sequence_no=".$seqno." AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $field=" document_no,document_descs,file_attachment,rowID,agent_sequence_no ";
        $rResult = $this->m_wsbangun->getlisttableattachold($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$field);
        // var_dump($rResult);
      
        $output = array(
            'draw' => intval($draw),
            // 'recordsTotal' => $iTotal,
            // 'recordsFiltered' => $iTotal,
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
    private function check_agent_attach($seqno=''){
    $this->load->model('m_wsbangun');
    $sql = "select count(file_attached) as count from mgr.rl_agent_attachment where agent_sequence_no = ".$seqno;
    $data = $this->m_wsbangun->getData_by_query($sql);
    $cnt = $data[0]->count;
        // var_dump($cnt);
    if($cnt==0){
        $where =array('entity_cd'=>'2101',
                      'agent_sequence_no'=>$seqno  );
        $this->m_wsbangun->deletedata('rl_agent_attachment',$where);
    }

    }
    private function check_data_double($field='',$table='',$where=''){
    $sql = "select count(".$field.") as count from mgr.".$table." ".$where;
    $this->load->model('m_wsbangun');
    // $where =array()
    $data = $this->m_wsbangun->getData_by_query($sql);
    $cnt = $data[0]->count;
        // var_dump($cnt);
        // exit;
    return $cnt;

    }
    public function SaveHd(){
         $msg ='';
         $status ='';
        if ($_POST) 
        {
            $this->load->model('m_wsbangun');
            $userCaptcha        = strtoupper($this->input->POST('userCaptcha',TRUE));
            $cc = strtoupper($this->session->userdata('captchaAgent'));
            // var_dump($userCaptcha);
            // var_dump($cc);
            if($cc != $userCaptcha){
                $msg= 'Wrong Captcha!';
                $status="fail";
            } else {                        
                $Group_cd           = $this->Next_Number('AGENT_HD','HD');
                $rbType             = $this->input->POST('rbType',TRUE);
                $rbType2            = $this->input->POST('rbType2',TRUE);
                $seqno            = $this->input->POST('seqno',TRUE);
                if($seqno == ''){
                    $seqno = NULL;
                }
                $rbArebi            = $this->input->POST('am',TRUE);
                $txtArebiNo         = $rbArebi=='Y'? $this->input->POST('txtArmNo',TRUE):' ';
                $rbAsign            = $this->input->POST('AssAgent',TRUE);
                $rbPackage          = $rbAsign=='Y'? $this->input->POST('package',TRUE):'';
                $txtBrand           = $rbType=='F' && $rbType2=='P'? $this->input->POST('txtBrand',TRUE): ' ';
                $txtOfficeName      = $this->input->POST('txtOfficeName',TRUE);
                $lead_cd      = $this->input->POST('txtLead',TRUE);
                $PT                 = $this->input->POST('PT',TRUE);
                $txtCompanyNPWP      = (string)$this->input->POST('txtCompNPWP',TRUE);
                $txtComAddress      = $this->input->POST('txtCompAdd',TRUE);
                $txtCity      = $this->input->POST('txtCity',TRUE);
                $txtProvince      = $this->input->POST('txtProp',TRUE);
                $txtPostCd      = $this->input->POST('txtCode',TRUE);
                $txtTelp      = $this->input->POST('txtTelp',TRUE);
                $txtFax      = $this->input->POST('txtFax',TRUE);
                $txtOffiEmail      = $this->input->POST('txtOffEmail',TRUE);
                $txtComBankName      = $this->input->POST('txtComBankName',TRUE);
                $txtAcctName      = $this->input->POST('txtAcctName',TRUE);
                $txtAcctNo      = $this->input->POST('txtAcctNo',TRUE);
                $txtPrincipleName     = $this->input->POST('txtPrinNo',TRUE);
                $txtIdNo     = $this->input->POST('txtIdNo',TRUE);
                $txtNPWP    = $this->input->POST('txtNPWP',TRUE);
                $txtEmailAdd        = $this->input->POST('txtEmailAdd',TRUE);
                $txthp1        = $this->input->POST('txtMbl1',TRUE);
                $txthp2        = $this->input->POST('txtMbl2',TRUE);
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');
                $entity_cd = '2101';
                $data = array(
                    'entity_cd'=>$entity_cd,
                    'group_cd'=>$Group_cd,
                    'group_name'=>$txtOfficeName,
                    'contact_person'=>$txtPrincipleName,
                    'contact_no'=>$txtIdNo,
                    'company_name'=>$PT,
                    'group_type'=>$rbType,
                    'Company_NPWP'=>$txtCompanyNPWP,
                    'Company_Address'=>$txtComAddress,
                    'City'=>$txtCity,
                    'Province'=>$txtProvince,
                    'PostCd'=>$txtPostCd,
                    'Telp_No'=>$txtTelp,
                    'Fax_No'=>$txtFax,
                    'Company_Email'=>$txtOffiEmail,
                    'Bank_Name'=>$txtComBankName,
                    'Bank_Acct_Name'=>$txtAcctName,
                    'Bank_Acct_No'=>$txtAcctNo,
                    'NPWP'=>$txtNPWP,
                    'Email_Addr'=>$txtEmailAdd,
                    'Handphone1'=>$txthp1,
                    'Handphone2'=>$txthp2,
                    'status'=>'N',
                    'Brand'=>$txtBrand,
                    'Arebi_Member'=>$rbArebi,
                    'Arebi_Number'=>$txtArebiNo,
                    'Audit_date'=>$audit_date,
                    'Audit_user'=>'WEB',
                    'Assigned_Agent'=>$rbAsign,
                    'Package'=>$rbPackage,
                    'seqno'=>$seqno,
                    'lead_cd'=>$lead_cd

                );
                 $datadtl = array(
                    'entity_cd'=>$entity_cd,
                    'group_cd'=>$Group_cd,
                    'agent_cd'=>$Group_cd,
                    'agent_name'=>$txtOfficeName,
                    'id_no'=>'-',
                    'NPWP'=>$txtCompanyNPWP,
                    'home_address'=>$txtComAddress,
                    'City'=>$txtCity,
                    'Province'=>$txtProvince,
                    'Post_Cd'=>$txtPostCd,
                    'email_add'=>$txtOffiEmail,
                    'Handphone1'=>$txthp1,
                    'Handphone2'=>$txthp2,                    
                    'agent_type_cd'=>$rbType,                    
                    'status'=>'N',
                    'Audit_date'=>$audit_date,
                    'Audit_user'=>'WEB',
                    'seqno'=>$seqno,
                    'status_approval'=>'U',
                    'principal_flag'=>'Y'

                );
                $tes = $this->m_wsbangun->insertData('cf_agent_hd',$data);
                // var_dump($tes);
                if($tes=='OK'){
                    $dtl = $this->SaveDtlHD($datadtl);
                    if($dtl=='ok'){
                       $msg="Data has been saved successfully";
                    }else{
                        $msg ='Fail to Detail error: '.$dtl;
                        $status="fail";
                        $tt = array('group_cd'=>$Group_cd);
                        $this->m_wsbangun->deletedata('cf_agent_hd',$tt);

                    }
                } else {
                    $status="fail";
                    $msg=$tes;
                }
                $this->session->unset_userdata('captchaAgent');
            }
        }else{
                $msg="Data validation is not valid";
                $status="fail";
            }
            
            $msg1=array("Pesan"=>$msg,
                        "status"=>$status);
            
        echo json_encode($msg1);
    }
    public function Lead(){
        $this->load->model('m_wsbangun');
        $table = 'cf_lead_agent (nolock)';
        $crit = array('lead_cd', 'lead_name');
        $customer = $this->m_wsbangun->getCombo($table,$crit);
        return $customer;
    }
    public function cek_Lead(){
        $this->load->model('m_wsbangun');
        $q = $this->input->post('pName',TRUE);
        $sql = "SELECT lead_agent_status from mgr.v_list_city where city= '$q' ";
        $d = $this->m_wsbangun->getData_by_query($sql);
        if(!empty($d)){
            $data = $d[0]->lead_agent_status;
            echo json_encode($data);
        }
    }
    public function city(){
        $this->load->model('m_wsbangun');
        $q = $this->input->post('q',TRUE);
        $sql = "SELECT * from mgr.v_list_city WHERE coba like '%$q%' ORDER BY coba";
        $d = $this->m_wsbangun->getData_by_query($sql);
        if(!empty($d)){
            foreach ($d as $key) {
                $row[] = array('id'=>$key->city,'text'=>$key->coba);
            }
            echo json_encode($row);
        }

    }
    public function getById(){
        $this->load->model('m_wsbangun');
        $Id   = $this->input->POST('Id',TRUE);
        $cons = $this->session->userdata('Tscons');
        $sql = "select Company_name from mgr.cf_agent_hd where group_cd = '".$Id."' ";
        $where=array('group_cd'=>$Id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_agent_hd',$where);
        // var_dump($data[0]->company_name);
        // exit;
        echo $data[0]->company_name;
    }
    private function SaveDtlHD($dataarray){
        $status='';
                $tes = $this->m_wsbangun->insertData('cf_agent_dt',$dataarray);
                        if($tes=='OK'){                           
                            $status ='ok';
                        } else {
                            $status=$tes;
                            // $msg=$tes;
                        }
        return $status;
    }
    private function SaveSosmed($dataarray){
        $status='';
                $tes = $this->m_wsbangun->insertData('security_sosmed',$dataarray);
                        if($tes=='OK'){                           
                            $status ='ok';
                        } else {
                            $status=$tes;
                            // $msg=$tes;
                        }
        return $status;
    }
    public function Savedtl(){
         $msg ='';
         $status ='';
        if ($_POST) 
        {
            $this->load->model('m_wsbangun');
            $userCaptcha        = strtoupper($this->input->POST('userCaptcha',TRUE));
            $cc                 = strtoupper($this->session->userdata('captchaAgent'));
            // var_dump($userCaptcha);
            // var_dump($cc);
            if($cc != $userCaptcha){
                $msg= 'Wrong Captcha!';
                $status="fail";
            }else{    
            $rbType             = $this->input->POST('rbType',TRUE);
            $rbType2            = $this->input->POST('rbType2',TRUE);

            $group_cd           = $rbType=='N'?'999999':$this->input->POST('OfficeNamedtl',TRUE);                    
            $aa          = $this->Next_Number('AGENT_DT',$group_cd);
            $Agent_cd   =(string)$group_cd.(string)substr($aa, 1); 
            
            $seqno            = $this->input->POST('seqno',TRUE); 
            if($seqno == ''){
                    $seqno = NULL;
                }           
            // $txtOfficeName      = $this->input->POST('txtOfficeName',TRUE);
            $PT                 = $this->input->POST('PTdtl',TRUE);
            $txtHomeAdd      = (string)$this->input->POST('txtHomeAdd',TRUE);
            $txtAgentName     = $this->input->POST('txtAgentName',TRUE);
            $txtCity      = $this->input->POST('txtCity',TRUE);
            $txtProvince      = $this->input->POST('txtProp',TRUE);
            $txtPostCd      = $this->input->POST('txtCode',TRUE);
            $txtTelp      = $this->input->POST('txtTelp',TRUE);
            $txtFax      = $this->input->POST('txtFax',TRUE);
            $txtOffiEmail      = $this->input->POST('txtOffiEmail',TRUE);
            $txtComBankName      = $this->input->POST('txtComBankName',TRUE);
            $txtAcctName      = $this->input->POST('txtAcctName',TRUE);
            $txtAcctNo      = $this->input->POST('txtAcctNo',TRUE);
            $txtPrincipleName     = $this->input->POST('txtPrinNo',TRUE);
            $txtIdNo     = $this->input->POST('txtIdNo',TRUE);
            $txtNPWP    = $this->input->POST('txtNPWP',TRUE);
            $txtEmailAdd        = $this->input->POST('txtEmailAdd',TRUE);
            $txthp1        = $this->input->POST('txtMbl1',TRUE);
            $txthp2        = $this->input->POST('txtMbl2',TRUE);
            $audit_date = date('d M Y H:i:s');

            $sosmed = $this->input->POST('txtsosmed',TRUE);
            $Link_sosmed = $this->input->POST('txtlink',TRUE);
            $gender = $this->input->POST('txtgender',TRUE);

            if(!empty($sosmed)){
                    $datasosmed = array(
                    'email'=>$txtEmailAdd,
                    'name'=>$txtAgentName,
                    'gender'=>$gender,
                    'link'=>$Link_sosmed,
                    'sosmed'=>$sosmed,                    
                    'Audit_date'=>$audit_date,
                    'Audit_user'=>'WEB'

                );

                $dtl = $this->SaveSosmed($datasosmed);
                // var_dump($dtl);
                if($dtl !='ok'){
                       // $msg="Data has been saved successfully";
                       $msg1=array("Pesan"=>$dtl,
                        "status"=>'fail');
            
                        echo json_encode($msg1);
                        exit();
                    }

            }

            
            // exit();
            // $audit_user = $this->session->userdata('Tsuname');
            $entity_cd = '2101';
            $data = array(
                    'entity_cd'=>$entity_cd,
                    'group_cd'=>$group_cd,
                    'agent_cd'=>$Agent_cd,
                    'agent_name'=>$txtAgentName,
                    'id_no'=>$txtIdNo,
                    'NPWP'=>$txtNPWP,
                    'home_address'=>$txtHomeAdd,
                    'City'=>$txtCity,
                    'Province'=>$txtProvince,
                    'Post_Cd'=>$txtPostCd,
                    'email_add'=>$txtEmailAdd,
                    'Handphone1'=>$txthp1,
                    'Handphone2'=>$txthp2,                    
                    'agent_type_cd'=>$rbType,                    
                    'status'=>'N',
                    'Audit_date'=>$audit_date,
                    'Audit_user'=>'WEB',
                    'seqno'=>$seqno,
                    'status_approval'=>'U',
                    'principal_flag'=>'N'

                );
            // var_dump($data);
            // exit;
            $where =" Where email_add ='".$txtEmailAdd."'";
            $ck_email = $this->check_data_double('email_add','cf_agent_dt',$where);
            if($ck_email == 0){
                $where =" where id_no='".$txtIdNo."'";
                $ck_ID = $this->check_data_double('*','cf_agent_dt',$where);
                if($ck_ID==0){
                     $where =" where npwp='".$txtNPWP."'";
                     $ck_npwp = $this->check_data_double('*','cf_agent_dt',$where);
                     if($ck_npwp==0){
                        // $this->check_agent_attach($seqno);
                        $tes = $this->m_wsbangun->insertData('cf_agent_dt',$data);
                        if($tes=='OK'){
                            $msg="Data has been saved successfully";
                            $status ='ok';
                        } else {
                            $status="fail";
                            $msg=$tes;
                        }
                        $this->session->unset_userdata('captchaAgent');
                     }else{
                        $msg=" NPWP Already Exist!";
                        $status ='fail';
                     }
                    
                }else{
                    $msg=" ID No Already Exist!";
                        $status ='fail';
                }
                
            }else{
                $msg=" Email Address Already Exist!";
                        $status ='fail';
            }
            
        }
        }else{
                $msg="Data validation is not valid";
                $status="fail";
            }
            
            $msg1=array("Pesan"=>$msg,
                        "status"=>$status);
            
        echo json_encode($msg1);
    }
}
