<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_billing_history extends Core_Controller
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
        $name = $this->session->userdata('Tsname');
        $email = $this->session->userdata('Tsemail'); 
        // $name='GP100027';
        $cons = $this->session->userdata('Tscons');
        $projectName = $this->session->userdata('Tsprojectname');
        if($entity == ''){
            $entity = '2101';
            $project = '210101';
	       }
           // var_dump();
        // $r = range(date("Y"), date("Y",strtotime("-2 year")));
        // var_dump($r);exit();
        // $group = $this->session->userdata('Tsusergroup');
        // if($group=='DEBTOR'){
        //     $table = 'v_logindebtor';
        //     $crit = array('rowID'=>$name);
        //     $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);
        // } else {
        //     $DataMenu='';
        // }
        $table = 'securityuserdebtor';
        $crit = array('UserId'=>$name);
            // $crit = array('debtor_acct'=>$name);
        $DataMenu = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // $table = 'v_logindebtor';
        // $crit = array('email_addr'=>$email);
        // $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);        
        // $debtor_acct = $DataMenu[0]->debtor_acct;
            if(empty($DataMenu)){
            // var_dump('expression');
            $dsb = 'false';
            $datadebtor = $this->zoom_debtor("");
            }else{

            if(count($DataMenu)>0){
                $dsb = 'false';    
            } else {
                $dsb = 'true';    
            }
            $datadebtor = $this->zoom_debtor($DataMenu[0]->Debtor_acct);

        }

        
    $ContentAllData = array('project_no'=>$project,
        'ProjectDescs'=>$projectName,
        'ddx'=>$dsb,
        'cbyear'=>$this->yeardropdown(date("Y"),date("Y",strtotime("-2 year")),date("Y")),
        'cbDebtor'=>$datadebtor);
    // $group = $this->session->userdata('Tsusergroup');
    // if ($group=='MGM'){
    //         $this->load_content_mgm('billing_history/index',$ContentAllData);
    //     }else{
    //         $this->load_content_top_menu('billing_history/index',$ContentAllData);
    //     }
     $this->load_content_top_menu('billing_history/index',$ContentAllData);
    }
    public function yeardropdown($start_year, $end_year = null, $selected=null) {
 
        // curret year as end year
        $end_year = is_null($end_year) ? date('Y') : $end_year;
        
        // the current year
        $selected = is_null($selected) ? date('Y') : $selected;
 
        // range of years 
        $r = range($start_year, $end_year);
        
        //create the HTML select
        $select = '';
        foreach( $r as $year )
        {
            $select .= "<option value=\"$year\"";
            $select .= ($year==$selected) ? ' selected="selected"' : '';
            $select .= ">$year</option>\n";
        }
        return $select;
    }
     public function zoom_debtor($debtor_acct)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
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
        $proDescs = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // var_dump($entityName);
         $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                // $comboProject[] = '<option></option>';
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
    public function getTable(){


        $userid = $this->session->userdata("Tsuname");
        $date_end = $this->input->post("date_end",true);
    
        if(empty($date_end)){
            $date_end=date('Y-m-d');
            
        }

        $date_start = $this->input->post("date_start",true);

        if(empty($date_start)){
            $date_start=date('Y-01-01');
            
        }
        // $date_end=date_create($date_end);
        // $date_start=date_create($date_start);
        $pro = $this->input->post("project",true);
        $debtor= $this->input->post("debtor",true);
        $lotno=$this->input->post("unit",true);

        $sSearch=$this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        // if (empty($debtor)) {
        //     $Dtrx_mode='Not Selected';
        // }
        // else{
        //     $Dtrx_mode='D';
        //  }

            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
            
 
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $cons = $this->session->userdata('Tscons');
        $DB2 = $this->load->database($cons, TRUE);

        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','doc_no','doc_date','descs','currency_cd','mdoc_amt');

            $sTable = "mgr.fn_BLH('".$date_start."','".$date_end."')";

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

        $SordField = 'trx_date ';

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
        // var_dump($debtor);
        if($debtor!='all')
        {
            
            $where="AND debtor_acct='".$debtor."' ".$where;
        }
        else{
            if ($debtor=='all') {
             $where="";
                 }
            else{
                      $where="AND debtor_acct='".$debtor."' ".$where;
             }
        }
       
        $yearr = $this->input->post("txtYear",true);

        if(empty($yearr)){
            $year=date('Y');
        } else {
            $year=$yearr; 
        }

$param =" Where trx_mode='D' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
// $param =" Where trx_mode='D' AND entity_cd='".$entity."' AND project_no= '".$project."' and fin_year='".$year."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablesoa_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
        
        

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
    public function view($debtor_acct='',$entity='',$project='') {
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
        $group = $this->session->userdata('Tsusergroup');
        if ($group=='MGM'){
            $this->load_content_mgm('billing_history/view',$ContentAllData);
        }else{
            $this->load_content_top_menu('billing_history/view',$ContentAllData);
        }
    }
    public function printview($debtor_acct='',$entity='',$project='') {
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
        $this->load->view('billing_history/view_print',$ContentAllData);
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
            
            $Email = $this->input->post("email",true);
            // $Email = $dtEmail[0]->email;
            $Judul = $this->input->post("subject",true);
            
            $body = "<!DOCTYPE html><html><head></head><body>".$this->input->post("msg",true)."</body></html>";
            // $attach = $this->input->post("attach",true);
            $attach = 'pdf/soa/report.pdf';
            
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());
          
            $docno='SOA'.$debtor_acct;
                $out_image=file_get_contents($attach);
                
                $imgData = bin2hex($out_image);
                $imgbin ="0x".$imgData; 
                
                $sql="SELECT count(*) as cnt from mgr.report_attachment where entity_cd='$entity' and project_no='$project' and document_no='$docno'";
                $dt = $this->m_wsbangun->getData_by_query($sql);
                $count = $dt[0]->cnt;
                if($count>0){
                    $where = array('document_no'=>$docno,
                        'project_no'=>$project,
                        'entity_cd'=>$entity);
                    $this->m_wsbangun->deletedata('report_attachment', $where);
                }

                $sql = "INSERT INTO mgr.report_attachment (\"entity_cd\", \"project_no\", \"document_no\", \"file_attachment\", \"file_attached\", \"audit_user\", \"audit_date\") VALUES ('".$entity."', '".$project."', '".$docno."', 'report.pdf', ".$imgbin .", '".$webuser."', '".$today."') ";
                
                $insert=$this->m_wsbangun->setData_by_query($sql);
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
                $CI = &get_instance();
                $CI->load->database();
                $CI->db->hostname;
                if($insert  == 'OK') {
                    // $sql1 ='Select max(path_file) AS path_file from mgr.report_spec';
                    // $data = $this->m_wsbangun->getData_by_query($sql1);                    
                    // $path = $data[0]->path_file;
                    $sql ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
                    $data = $this->m_wsbangun->getData_by_query($sql);                    
                    $profile_mail = $data[0]->email_profile;
                    $sql = "mgr.x_send_mail_report_php '".$profile_mail."', '".$Email."', '".$Judul."', '".$body."', '".$entity."','".$project."', '".$docno."', '".$CI->db->hostname."' ";
                    
                    $snd = $this->m_wsbangun->setData_by_query($sql);
       
                    $aaa = strpos($snd,'queued');
             
                    if( $aaa <= 0 || !$aaa){
                        if($snd=='OK'){
                            $msg = 'Email sent';
                            $psn ='OK';
                            $aa = $msg;
                        }else{
                            $msg = $snd;

                            $psn ='Fail';
                            $aa = 'Sent Email Failed, Please Contact your Admin!';  
                        }
                        
                    }else{
                        $msg = 'Email sent';
                        $psn ='OK';
                        $aa = $msg;
                    }
                } else {
                    $msg='Upload attachment failed!';
                    $psn='Failed';
                    $aa=$msg;
                }
               
                

          
               
    
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
   public function mail($debtor_acct='',$entity='',$project=''){
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
                $this->load->view('billing_history/composemail',$data);
   }
   public function createpdf(){
            $project = $this->input->post('project',TRUE);
            $debtor_acct = $this->input->post('debtor',TRUE);
            $entity = $this->input->post('entity',TRUE);
            // var_dump(expression)
            if(!empty($project)){

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