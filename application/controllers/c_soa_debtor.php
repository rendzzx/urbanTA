<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Soa_debtor extends Core_Controller
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
        $name = $this->session->userdata('Ts name');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
	    // }

        $table = 'pl_project';
        $proDescs = $this->m_wsbangun->getData_cons('ifca3',$table);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
        



    $ContentAllData = array('project_no'=>$project,
        'ProjectDescs'=>$projectName,
        'cbProject'=>$comboProject
       );
    $group = $this->session->userdata('Tsusergroup');
    // if ($group=='DEBTOR'){
            $this->load_content_top_menu('soa_debtor/index',$ContentAllData);
        // }else{
        //     $this->load_content_top_menu('soa_debtor/index2',$ContentAllData);
        // }
    }
    public function getTable(){


        $userid = $this->session->userdata("Tsname");
        $date_end = $this->input->post("date_end",true);
    
        if(empty($date_end)){
            $date_end=date('Y-m-d');
            
        }

        $date_start = $this->input->post("date_start",true);

        if(empty($date_start)){
            $date_start=date('Y-01-01');
            
        }
      
        $pro = $this->input->post("project",true);
        $debtor= $this->input->post("debtor",true);
        $lotno=$this->input->post("unit",true);
        // var_dump($pro);
        $sSearch=$this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            // var_dump($entity);
        }
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB2 = $this->load->database('ifca', TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','project_descs','lot_no','total_inv','total_receipt');

        $sTable = "mgr.fn_VSOA_debtor('".$date_start."','".$date_end."')";

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


   
    
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' and UserId = '".$userid ."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablesoa($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
        // var_dump($rResult);
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
    public function view($debtor_acct='',$entity='',$project='',$start='',$end='') {
        $project = trim($project);
        $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
        $dt = $this->m_wsbangun->getData_by_query($sql3);
        $namaproject=$dt[0]->descs;
        // $sql="SELECT *, SUM(balance_amt)/* OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) */AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
        $date_end = $end;
    
        if(empty($date_end)){
            $date_end=date('Y-m-d');
            
        }

        $date_start = $start;

        if(empty($date_start)){
            $date_start=date('Y-01-01');
            
        }
        $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail_debtor('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
        $dtDetail = $this->m_wsbangun->getData_by_query($sql);
        $sql2="SELECT bussines_name = max(bussines_name),address1=max(mail_addr1),address2=max(mail_addr2),address3=max(mail_addr3), lot_no=max(lot_no),debtor_acct=max(debtor_acct),deposit = sum(deposit) FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
        $dtHeader = $this->m_wsbangun->getData_by_query($sql2);
        $ContentAllData = array('dtSOA'=>$dtDetail,
            'dtHeader'=>$dtHeader,
            'debtor'=>$debtor_acct,
            'project'=>$project,
            'namaproject'=>$namaproject,
            'entity'=>$entity);
        $group = $this->session->userdata('Tsusergroup');
        if ($group=='MGM'){
            $this->load_content_mgm('soa_debtor/view',$ContentAllData);
        }else{
            $this->load_content_top_menu('soa_debtor/view',$ContentAllData);
        }
    }
    public function printview($debtor_acct='',$entity='',$project='',$start='',$end='') {
        $project = trim($project);
        $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
        $dt = $this->m_wsbangun->getData_by_query($sql3);
        $namaproject=$dt[0]->descs;
        // $sql="SELECT *, SUM(balance_amt)/* OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) */AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
        $date_end = $end;
    
        if(empty($date_end)){
            $date_end=date('Y-m-d');
            
        }

        $date_start = $start;

        if(empty($date_start)){
            $date_start=date('Y-01-01');
            
        }
        $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail_debtor('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
        $dtDetail = $this->m_wsbangun->getData_by_query($sql);
        $sql2="SELECT bussines_name = max(bussines_name),address1=max(mail_addr1),address2=max(mail_addr2),address3=max(mail_addr3), lot_no=max(lot_no),debtor_acct=max(debtor_acct),deposit = sum(deposit) FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
        $dtHeader = $this->m_wsbangun->getData_by_query($sql2);
        $ContentAllData = array('dtSOA'=>$dtDetail,
            'dtHeader'=>$dtHeader,
            'debtor'=>$debtor_acct,
            'project'=>$project,
            'namaproject'=>$namaproject,
            'entity'=>$entity);
        $this->load->view('soa_debtor/view_print',$ContentAllData);
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
            $webuser = $this->session->userdata('Tsname');
            $today = date('d M Y H:i:s');
            $project = trim($project);
            // $tbl = 'rl_nup_email';
            // $dtEmail = $this->m_wsbangun->getData($tbl);
            
            $email = $this->input->post("email",true);
            // $Email = $dtEmail[0]->email;
            $subject = $this->input->post("subject",true);
            
            $body = "<!DOCTYPE html><html><head></head><body>".$this->input->post("msg",true)."</body></html>";
            // $attach = $this->input->post("attach",true);
            $attach = 'pdf/soa/report.pdf';
            
            // $this->load->library('upload');
            // $this->upload->initialize($this->setUploadOptions());
          
            $docno='SOA'.$debtor_acct;
                // $out_pdf=file_get_contents($attach);
                
                // $imgData = bin2hex($out_pdf);
                // $imgbin ="0x".$imgData; 
                
                // $sql="SELECT count(*) as cnt from mgr.report_attachment where entity_cd='$entity' and project_no='$project' and document_no='$docno'";
                // $dt = $this->m_wsbangun->getData_by_query($sql);
                // $count = $dt[0]->cnt;
                // if($count>0){
                //     $where = array('document_no'=>$docno,
                //         'project_no'=>$project,
                //         'entity_cd'=>$entity);
                //     $this->m_wsbangun->deletedata('report_attachment', $where);
                // }

                // $sql = "INSERT INTO mgr.report_attachment (\"entity_cd\", \"project_no\", \"document_no\", \"file_attachment\", \"file_attached\", \"audit_user\", \"audit_date\") VALUES ('".$entity."', '".$project."', '".$docno."', 'report.pdf', ".$imgbin .", '".$webuser."', '".$today."') ";
                
                // $insert=$this->m_wsbangun->setData_by_query($sql);

    
                // if($insert  == 'OK') {
 
                    // $sql ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
                    // $data = $this->m_wsbangun->getData_by_query($sql);                    
                    // $profile_mail = $data[0]->email_profile;
                    // $sql = "mgr.x_send_mail_report_php '".$profile_mail."', '".$Email."', '".$Judul."', '".$body."', '".$entity."','".$project."', '".$docno."', '".$CI->db->hostname."' ";
                    
                    // $snd = $this->m_wsbangun->setData_by_query($sql);
       
                    // $aaa = strpos($snd,'queued');
             
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
            // $sql="SELECT *, SUM(balance_amt)/* OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) */AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
            $date_end = $end;
    
            if(empty($date_end)){
                $date_end=date('Y-m-d');
                
            }

            $date_start = $start;

            if(empty($date_start)){
                $date_start=date('Y-01-01');
                
            }
            $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail_debtor('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
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
   public function mail($debtor_acct='',$entity='',$project='',$start='',$end=''){
                $project = trim($project);
                $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
                $dt = $this->m_wsbangun->getData_by_query($sql3);
                $namaproject=$dt[0]->descs;
                // $sql="SELECT *, SUM(balance_amt)/* OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) */AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
                $date_end = $end;
    
                if(empty($date_end)){
                    $date_end=date('Y-m-d');
                    
                }

                $date_start = $start;

                if(empty($date_start)){
                    $date_start=date('Y-01-01');
                    
                }
                $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail_debtor('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
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
                $filename = 'pdf/soa/'.$pdf.'.pdf';

                // $html = $this->load->view('grafik/sumary_pdf', $data, true);
                $html = $this->load->view('Email/EmailSOA', $ContentAllData, true);
                // var_dump($html);
                $a = pdfGenMail($html, $pdf, "A4", "landscape");
                $pathfileattach=base_url('pdf/soa/').$pdf.'.pdf';
                // var_dump($html);
                file_put_contents($filename, $a);

                $data = array('pathfileattach' =>  $pathfileattach );
                $this->load->view('soa_debtor/composemail',$data);
   }
   public function createpdf(){
            $project = $this->input->post('project',TRUE);
            $debtor_acct = $this->input->post('debtor',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $end = $this->input->post('end_date',TRUE);
            $start = $this->input->post('s tart_date',TRUE);
            // var_dump(expression)
            if(!empty($project)){

                $project = trim($project);
                $sql3="SELECT descs FROM mgr.pl_project where project_no='$project' and entity_cd='$entity' ";
                $dt = $this->m_wsbangun->getData_by_query($sql3);
                $namaproject=$dt[0]->descs;
                // $sql="SELECT *, SUM(balance_amt)/* OVER(ORDER BY debtor_acct,balance_amt desc ROWS BETWEEN UNBOUNDED PRECEDING AND CURRENT ROW) */AS cum_balance FROM mgr.v_ar_soa where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct'";
                $date_end = $end;
    
                if(empty($date_end)){
                    $date_end=date('Y-m-d');
                }

                $date_start = $start;

                if(empty($date_start)){
                    $date_start=date('Y-01-01');
                }
                $sql = "SELECT TOP 100 * from mgr.fn_VSOA_detail_debtor('".$date_start."','".$date_end."') where project_no='$project' and entity_cd='$entity' and debtor_acct='$debtor_acct' order by dataID";
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
                $filename = 'pdf/soa/'.$pdf.'.pdf';

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
        $data = file_get_contents(base_url('/pdf/soa/'.$filename));
        force_download($filename,$data);
    }

}
?>