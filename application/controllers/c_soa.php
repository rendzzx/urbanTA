<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Soa extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');


    }
    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
	       // }           
        $userid = $this->session->userdata("Tsname");
        $sql = "SELECT distinct entity_cd,project_no,project_descs,db_profile from mgr.v_cfs_login_user with (nolock) where userid='$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        // var_dump($entityName);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                    $entity = $dtProject->entity_cd;
                    $project = $dtProject->project_no;
                    $cons = $dtProject->db_profile;
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'" data-cons="'.$dtProject->db_profile.'" >'.$dtProject->project_descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
        $group = $this->session->userdata('Tsusergroup');
        // $group = 'DEBTOR';
        if($group == 'DEBTOR'){
            $debtor_acct = $this->session->userdata("Tsdebtor_acct");
            $sql="SELECT distinct a.debtor_acct, a.name from  mgr.ar_debtor a (NOLOCK), mgr.ar_ledger b (NOLOCK) where a.debtor_acct = b.debtor_acct and b.entity_cd='".$entity."' and b.project_no='".$project."' and a.debtor_acct = '$debtor_acct'";
        }else{
            $sql="SELECT distinct a.debtor_acct, a.name from  mgr.ar_debtor a (NOLOCK), mgr.ar_ledger b (NOLOCK) where a.debtor_acct = b.debtor_acct and b.entity_cd='".$entity."' and b.project_no='".$project."' ";
        }

    	
        $debtorData=$this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $sql1="SELECT distinct lot_no from mgr.ar_ledger(NOLOCK) where entity_cd='".$entity."' and project_no='".$project."'";
        $unitData=$this->m_wsbangun->getData_by_query_cons($cons,$sql1);

        $ContentAllData = array('project_no'=>$project,
            'ProjectDescs'=>$projectName,
            'cbProject'=>$comboProject,
            'cbDebtor'=>$debtorData,
            'cbUnit'=>$unitData);
        $group = $this->session->userdata('Tsusergroup');

         $this->load_content_top_menu('soa/index',$ContentAllData);
  
    }
    public function getTable(){


        $userid = $this->session->userdata("Tsuname");
        $date_end = $this->input->post("date_end",true);
    
        if(empty($date_end)){
            $date_end=date('Y-m-d');
            
        } else {
           $dateen = str_replace('/', '-', $date_end);
           $date_end=date("Y-m-d", strtotime($dateen) );
        }

        $date_start = $this->input->post("date_start",true);

        if(empty($date_start)){
            $date_start=date('Y-01-01');
            
        }else {
           $datest = str_replace('/', '-', $date_start);
           $date_start=date("Y-m-d", strtotime($datest) );
        }
        // var_dump($date_start);
        // var_dump($date_end);
        // $date_end=date_create($date_end);
        // $date_start=date_create($date_start);
        $pro = $this->input->post("project",true);
        $debtor= $this->input->post("debtor",true);
        $lotno=$this->input->post("unit",true);

        $sSearch=$this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
            $cons = $this->session->userdata('Tscons');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd),db_profile = max(db_profile) from mgr.pl_project(nolock) where project_no = '$pro' ";
            $datas = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
            $entity = $datas[0]->entity_cd;
            $cons = $datas[0]->db_profile;
            // var_dump($entity);
        }
        // var_dump($entity);
        // $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database('ifca', TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','project_descs','lot_no','total_inv','total_receipt');

        $sTable = "mgr.fn_VSOA('".$date_start."','".$date_end."')";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);

        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $addsort = 'product_cd,property_cd,lead_cd,group_cd ';
        $addsort = '';
        $SortdOrder =$order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];

        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);

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


        $where=' ';
        if($debtor!='all')
        {
            
            $where="AND debtor_acct='".$debtor."' ".$where;
        }
        if($lotno!='all')
        {
       
            $where="AND lot_no='".$lotno."' ".$where;
        }
      
    
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablesoa_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);

        $output = array(
            'draw' => intval($draw),
            
            'data' => array()
        );
        $sql="select count(*) as cnt from ".$sTable." ".$param;
        $ts = $DB2->query($sql);
        $a1 = $ts->result()[0]->cnt;
        
        $iTotal = $a1;

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
    public function view() {
        $param = $this->uri->segment(3);
        // var_dump($param);
        $paramDcd = base64_decode($param);
        // var_dump($paramDcd);
        $b = explode("/", $paramDcd);
        // var_dump(count($b));
        $start='';$end='';
        $debtor_acct=$b[0];
        $entity=$b[1];
        $project=$b[2];
        $cons=$b[3];
        if(count($b)>4){
            $start=$b[6]."-".$b[5]."-".$b[4];
            $end=$b[9]."-".$b[8]."-".$b[7];
        }
        // var_dump($start);
        // exit();
        // $start='';$end='';
        $project = trim($project);
        $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
        $dt = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql3);
        $namaproject=$dt[0]->descs;
        // $sql="SELECT *, SUM(balance_amt) OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";\
        // $uri = $this->uri->segments;
        // if(!empty($start)){
        //     $start=$uri[8]."-".$uri[7]."-".$uri[6];
        //     $end=$uri[11]."-".$uri[10]."-".$uri[9];
        // }
        
        // var_dump($end);
        // var_dump($start);
        // exit();
        $date_end = $end;
    
        if(empty($date_end)){
            $date_end=date('Y-m-d');
        }
        
        $date_start = $start;

        if(empty($date_start)){
            $date_start=date('Y-01-01');
            
        }

        //Begining Balance
        $sqll ="SELECT isnull(SUM(a.debit_amt),0) AS Begin_debitAmt, isnull(SUM(a.credit_amt),0) AS Begin_CreditAmt FROM mgr.v_ar_soa a with(NOLOCK) ";
        $sqll .=" WHERE project_no='$project' and entity_cd='$entity' AND a.debtor_acct ='$debtor_acct' and a.doc_date < '$date_start' ";
        $BegData = $this->m_wsbangun->getData_by_query($sqll);
        // var_dump($BegData);exit();
        $BeginDebAmt = $BegData[0]->Begin_debitAmt;
        $BeginCreAmt = $BegData[0]->Begin_CreditAmt;

        $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
        // $sql = "SELECT * from mgr.v_cum_balance_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
        $dtDetail = $this->m_wsbangun->getData_by_query($sql);
        $sql2="SELECT bussines_name = max(bussines_name),address1=max(mail_addr1),address2=max(mail_addr2),address3=max(mail_addr3), lot_no=max(lot_no),debtor_acct=max(debtor_acct),deposit = sum(deposit) FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
        $dtHeader = $this->m_wsbangun->getData_by_query($sql2);

        $ContentAllData = array('dtSOA'=>$dtDetail,
            'dtHeader'=>$dtHeader,
            'debtor'=>$debtor_acct,
            'project'=>$project,
            'start'=>$date_start,
            'end'=>$date_end,
            'namaproject'=>$namaproject,
            'entity'=>$entity,
            'BDebitAmt'=>$BeginDebAmt,
            'BCreditAmt'=>$BeginCreAmt);
        $group = $this->session->userdata('Tsusergroup');
        if ($group=='MGM'){
            $this->load_content_mgm('soa/view',$ContentAllData);
        }else{
            $this->load_content_top_menu('soa/view',$ContentAllData);
        }
    }
    public function printview($debtor_acct='',$entity='',$project='',$start='',$end='') {
        $project = trim($project);
        $sql3="SELECT descs,db_profile FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
        $dt = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql3);
        $namaproject=$dt[0]->descs;
        $cons=$dt[0]->db_profile;
        // $sql="SELECT *, SUM(balance_amt) OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
        // $uri = $this->uri->segments;
        // if(!empty($start)){
        //     $end=$uri[8]."-".$uri[7]."-".$uri[6];
        //     $start=$uri[11]."-".$uri[10]."-".$uri[9];
        // }
        
      
        $date_end = $end;
    
        if(empty($date_end)){
            $date_end=date('d-m-Y');
        }
        
        $date_start = $start;

        if(empty($date_start)){
            $date_start=date('01-01-Y');
            
        }
        $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
        $dtDetail = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $sql2="SELECT bussines_name = max(bussines_name),address1=max(mail_addr1),address2=max(mail_addr2),address3=max(mail_addr3), lot_no=max(lot_no),debtor_acct=max(debtor_acct),deposit = sum(deposit) FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
        $dtHeader = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $ContentAllData = array('dtSOA'=>$dtDetail,
            'dtHeader'=>$dtHeader,
            'debtor'=>$debtor_acct,
            'project'=>$project,
            'namaproject'=>$namaproject,
            'entity'=>$entity);
        $this->load->view('soa/view_print',$ContentAllData);
   }
   private function setUploadOptions()
    {
        // $max = (1024*1024)*10;
        $config = array('upload_path'=>'./pdf/SOA',
            'allowed_types'=>'pdf',
            // 'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }
   public function sendmail(){
            $debtor_acct=$this->input->post("debtor",true);
            $entity=$this->input->post("entity",true);
            $project=$this->input->post("project",true);
            $webuser = $this->session->userdata('Tsuname');
            $today = date('d M Y H:i:s');
            $project = trim($project);
            // $tbl = 'rl_nup_email';
            // $dtEmail = $this->m_wsbangun->getData($tbl);
            
            $email = $this->input->post("email",true);
            // $Email = $dtEmail[0]->email;
            $subject = $this->input->post("subject",true);
            
            $body = "<!DOCTYPE html><html><head></head><body>".$this->input->post("msg",true)."</body></html>";
            // $attach = $this->input->post("attach",true);
            $attach = 'pdf/SOA/report.pdf';
            
                    if(!empty($attach) && !empty($email)){
                      
                      $mail = $this->_sendmail($email, $subject, $body, $attach);

                      $msg = "Email sent";
                      $psn ='OK';
                      $aa = '';
                    }else{
                        if(empty($attach)){
                            $msg = "Please insert email.";      
                        }
                        if(empty($attach)){
                            $msg = "Attachment failed to made.";    
                        }
                      
                      $psn ='Fail';
                      $aa = '';
                    }
            // $this->load->library('upload');
            // $this->upload->initialize($this->setUploadOptions());
          
            // $docno='SOA'.$debtor_acct;
            //     $out_image=file_get_contents($attach);
                
            //     $imgData = bin2hex($out_image);
            //     $imgbin ="0x".$imgData; 
                
            //     $sql="SELECT count(*) as cnt from mgr.report_attachment where entity_cd='$entity' and project_no='$project' and document_no='$docno'";
            //     $dt = $this->m_wsbangun->getData_by_query($sql);
            //     $count = $dt[0]->cnt;
            //     if($count>0){
            //         $where = array('document_no'=>$docno,
            //             'project_no'=>$project,
            //             'entity_cd'=>$entity);
            //         $this->m_wsbangun->deletedata('report_attachment', $where);
            //     }

            //     $sql = "INSERT INTO mgr.report_attachment (\"entity_cd\", \"project_no\", \"document_no\", \"file_attachment\", \"file_attached\", \"audit_user\", \"audit_date\") VALUES ('".$entity."', '".$project."', '".$docno."', 'report.pdf', ".$imgbin .", '".$webuser."', '".$today."') ";
                
            //     $insert=$this->m_wsbangun->setData_by_query($sql);
                //  $table = 'report_attachment';

                //     $dtEntry = array('entity_cd'=>$entity,
                //         'project_no'=>$project,
                //         'document_no'=>$docno,
                //         'file_attachment'=>'report.pdf',
                //         'file_attached'=>$imgbin,
                //         'audit_user'=>$webuser,
                //         'audit_date'=>$today
                //     );
                // $insert = $this->m_wsbangun->insertData($table, $dtEntry);
                // $CI = &get_instance();
                // $CI->load->database();
                // $CI->db->hostname;
                // if($insert  == 'OK') {
                //     // $sql1 ='Select max(path_file) AS path_file from mgr.report_spec';
                //     // $data = $this->m_wsbangun->getData_by_query($sql1);                    
                //     // $path = $data[0]->path_file;
                //     $sql ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
                //     $data = $this->m_wsbangun->getData_by_query($sql);                    
                //     $profile_mail = $data[0]->email_profile;
                //     $sql = "mgr.x_send_mail_report_php '".$profile_mail."', '".$Email."', '".$Judul."', '".$body."', '".$entity."','".$project."', '".$docno."', '".$CI->db->hostname."' ";
                    
                //     $snd = $this->m_wsbangun->setData_by_query($sql);
       
                //     $aaa = strpos($snd,'queued');
             
                //     if( $aaa <= 0 || !$aaa){
                //         if($snd=='OK'){
                //             $msg = 'Email sent';
                //             $psn ='OK';
                //             $aa = $msg;
                //         }else{
                //             $msg = $snd;

                //             $psn ='Fail';
                //             $aa = 'Sent Email Failed, Please Contact your Admin!';  
                //         }
                        
                //     }else{
                //         $msg = 'Email sent';
                //         $psn ='OK';
                //         $aa = $msg;
                //     }
                // } else {
                //     $msg='Upload attachment failed!';
                //     $psn='Failed';
                //     $aa=$msg;
                // }
               
                

          
               
    
            $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
            echo json_encode($t);
   }
   public function tesmail($debtor_acct='',$entity='',$project=''){
            
          
            $Email = 'deskaruwanda@gmail.com;';

            $Judul = 'Statement of Account';
            
            $project = trim($project);
            $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
            $dt = $this->m_wsbangun->getData_by_query($sql3);
            $namaproject=$dt[0]->descs;
            $sql="SELECT *, SUM(balance_amt) OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
            $dtDetail = $this->m_wsbangun->getData_by_query($sql);
            $sql2="SELECT bussines_name = max(bussines_name),address1=max(mail_addr1),address2=max(mail_addr2),address3=max(mail_addr3), lot_no=max(lot_no),debtor_acct=max(debtor_acct),deposit = sum(deposit) FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
            $dtHeader = $this->m_wsbangun->getData_by_query($sql2);
            $ContentAllData = array('dtSOA'=>$dtDetail,
                'dtHeader'=>$dtHeader,
                'debtor'=>$debtor_acct,
                'project'=>$project,
                'namaproject'=>$namaproject,
                'entity'=>$entity);         
            $this->load->view('Email/EmailSOA',$ContentAllData);
         
   }
   public function mail(){
        $param = $this->uri->segment(3);

        $paramDcd = base64_decode($param);
    
        $b = explode("/", $paramDcd);
        // var_dump(count($b));
        $start='';$end='';
        $debtor_acct=$b[0];
        $entity=$b[1];
        $project=$b[2];
        $cons=$b[3];
        if(count($b)>4){
            $start=$b[6]."-".$b[5]."-".$b[4];
            $end=$b[9]."-".$b[8]."-".$b[7];
        }
        // var_dump($start);
      
        $project = trim($project);
        $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
        $dt = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql3);
        $namaproject=$dt[0]->descs;
  
        $date_end = $end;
    
        if(empty($date_end)){
            $date_end=date('Y-m-d');
        }
        
        $date_start = $start;

        if(empty($date_start)){
            $date_start=date('Y-01-01');
            
        }

        //Begining Balance
        $sqll ="SELECT isnull(SUM(a.debit_amt),0) AS Begin_debitAmt, isnull(SUM(a.credit_amt),0) AS Begin_CreditAmt FROM mgr.v_ar_soa a with(NOLOCK) ";
        $sqll .=" WHERE project_no='$project' and entity_cd='$entity' AND a.debtor_acct ='$debtor_acct' and a.doc_date < '$date_start' ";
        $BegData = $this->m_wsbangun->getData_by_query($sqll);
        // var_dump($BegData);exit();
        $BeginDebAmt = $BegData[0]->Begin_debitAmt;
        $BeginCreAmt = $BegData[0]->Begin_CreditAmt;

        $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
        // $sql = "SELECT * from mgr.v_cum_balance_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
        $dtDetail = $this->m_wsbangun->getData_by_query($sql);
        $sql2="SELECT bussines_name = max(bussines_name),address1=max(mail_addr1),address2=max(mail_addr2),address3=max(mail_addr3), lot_no=max(lot_no),debtor_acct=max(debtor_acct),deposit = sum(deposit) FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
        $dtHeader = $this->m_wsbangun->getData_by_query($sql2);

                $project = trim($project);
                $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
                $dt = $this->m_wsbangun->getData_by_query($sql3);
                $namaproject=$dt[0]->descs;
                // $sql="SELECT *, SUM(balance_amt) OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
                $uri = $this->uri->segments;
                if(!empty($start)){
                    $end=$uri[8]."-".$uri[7]."-".$uri[6];
                    $start=$uri[11]."-".$uri[10]."-".$uri[9];
                }
                
              
                $date_end = $end;
            
                if(empty($date_end)){
                    $date_end=date('Y-m-d');
                }
                
                $date_start = $start;

                if(empty($date_start)){
                    $date_start=date('Y-01-01');
                    
                }
                $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
                // $sql = "SELECT * from mgr.v_cum_balance_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
                $dtDetail = $this->m_wsbangun->getData_by_query($sql);
                $sql2="SELECT bussines_name = max(bussines_name),address1=max(mail_addr1),address2=max(mail_addr2),address3=max(mail_addr3), lot_no=max(lot_no),debtor_acct=max(debtor_acct),deposit = sum(deposit) FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
                $dtHeader = $this->m_wsbangun->getData_by_query($sql2);
                $ContentAllData = array('dtSOA'=>$dtDetail,
                    'dtHeader'=>$dtHeader,
                    'debtor'=>$debtor_acct,
                    'project'=>$project,
                    'namaproject'=>$namaproject,
                    'entity'=>$entity); 
                $pdf = 'report';
                $filename = 'pdf/SOA/'.$pdf.'.pdf';

                // $html = $this->load->view('grafik/sumary_pdf', $data, true);
                $html = $this->load->view('Email/EmailSOA', $ContentAllData, true);
                // var_dump($html);
                $a = pdfGenMail($html, $pdf, "A4", "landscape");
                $pathfileattach=base_url('pdf/SOA/').$pdf.'.pdf';
                // var_dump($html);
                file_put_contents($filename, $a);

                $data = array('pathfileattach' =>  $pathfileattach );
                $this->load->view('soa/composemail',$data);
   }
   public function createpdf(){
            $project = $this->input->post('project',TRUE);
            $debtor_acct = $this->input->post('debtor',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $start = $this->input->post('start',TRUE);
            $end = $this->input->post('end',TRUE);
            // var_dump(expression)
            if(!empty($project)){

                $project = trim($project);
                $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
                $dt = $this->m_wsbangun->getData_by_query($sql3);
                $namaproject=$dt[0]->descs;
                // $sql="SELECT *, SUM(balance_amt) OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
                $date_end = $end;
    
                if(empty($date_end)){
                    $date_end=date('Y-m-d');
                }
                
                $date_start = $start;

                if(empty($date_start)){
                    $date_start=date('Y-01-01');
                    
                }
                // var_dump($date_start);var_dump($date_end);exit();
                $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
                // var_dump($sql);exit();
                // $sql = "SELECT * from mgr.v_cum_balance_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
                $dtDetail = $this->m_wsbangun->getData_by_query($sql);
                $sql2="SELECT bussines_name = max(bussines_name),address1=max(mail_addr1),address2=max(mail_addr2),address3=max(mail_addr3), lot_no=max(lot_no),debtor_acct=max(debtor_acct),deposit = sum(deposit) FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
                $dtHeader = $this->m_wsbangun->getData_by_query($sql2);
                $ContentAllData = array('dtSOA'=>$dtDetail,
                    'dtHeader'=>$dtHeader,
                    'debtor'=>$debtor_acct,
                    'project'=>$project,
                    'namaproject'=>$namaproject,
                    'entity'=>$entity); 
                $pdf = 'Report';
                $filename = 'pdf/SOA/'.$pdf.'.pdf';

                // $html = $this->load->view('grafik/sumary_pdf', $data, true);
                $html = $this->load->view('Email/EmailSOA', $ContentAllData, true);
                // var_dump($html);
                $a = pdfGenMail($html, $pdf, "A4", "landscape");

                // var_dump($html);
                file_put_contents($filename, $a);   
                $msg = 'ok';
                
            }
            echo $msg;
        }
    public function download($filename = null)
    {
        $this->load->helper('download');
        $data = file_get_contents(base_url('/pdf/SOA/'.$filename));
        force_download($filename,$data);
    }
    public function cek_startdate(){
        $startDate = $this->input->post('st',TRUE);       
        $endDate = $this->input->post('ed',TRUE);       
        $this->load->database();
     $DB2 = $this->load->database('ifca', TRUE);
     $sql='SELECT CASE WHEN DATEADD(YEAR,-1,?) < DATEADD(DAY,0,?) THEN 1 ELSE 0 END AS valid ';
     $where = array($endDate,$startDate);
     $qq = $DB2->query($sql, $where);     
     $datas = $qq->result();
    
    // var_dump($datas[0]->valid);
        // $sql="SELECT CASE WHEN DATEADD(YEAR,-1,'10/11/2017') < DATEADD(DAY,0,'11/11/2016') THEN 1 ELSE 0 END AS valid ";

        echo $datas[0]->valid;
    }

}
?>