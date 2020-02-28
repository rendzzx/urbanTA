<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Submitsales extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->model('m_newsfeed');
        $this->load->model('m_sms');
    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $Sdebtr = $this->session->userdata('debtr');
        $Slotno = $this->session->userdata('lotno');
        $Saudit_user = $this->session->userdata('Saudit_user');
        $business = $this->session->userdata('Sbusiness');

        $entityname = $this->session->userdata('Tsentityname');
      
      

        $content = array('entityname'=>$entityname);
        $this->load_content_top_menu('booking/v_rl_salesSubmitNew', $content);
    }
       public function indexfromlist()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $Sdebtr = $this->session->userdata('debtr');
        $Slotno = $this->session->userdata('lotno');
        $Saudit_user = $this->session->userdata('Saudit_user');
        $business = $this->session->userdata('Sbusiness');

        $entityname = $this->session->userdata('Tsentityname');
      
      

        $content = array('entityname'=>$entityname);
        $this->load->view('booking/v_rl_salesSubmitlist', $content);
    }


    public function tesemail(){
        $Tsprojectname = $this->session->userdata('Tsprojectname');
        $debtr = $this->session->userdata('debtr');
        $Slotno = $this->session->userdata('lotno');
        $dtName='ARIE';
        $Tsuname ='Otnay';
         $data=array('lotno'=>$Slotno,
                                    'toName'=>$dtName,
                                    'fromName'=>$Tsuname,
                                    'projectdesct'=>$Tsprojectname);
        $this->load->view('Email/EmailSubmit',$data);
    }
    public function getTable()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // var_dump($aProject);
        $entity = $this->session->userdata('Tsentity');
        // $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
      
        $aColumns  = array('level_no','user_id', 'description');
        $sTable = 'mgr.v_rl_approval_user';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
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
        $SordField = ($sortIdColumn==0? 'level_no' :$Column[$sortIdColumn]['name']);

     

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
        // Select Data

        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        $param =" Where process_cd='SALE' and entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      // var_dump($rResult->result());
        // Total data set length
        
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
    public function addSubmitmodal()
    {
        if($_POST)
        {
            //session login
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            //session booking
            $Tsuname = $this->session->userdata('Tsuname');
            $Tsprojectname = $this->session->userdata('Tsprojectname');
            // $debtr = $this->session->userdata('debtr');
            // $Slotno = $this->session->userdata('lotno');
            $Saudit_user = $this->session->userdata('Saudit_user');
            // $business = $this->session->userdata('Sbusiness');
            //data pos checkbox
            $arUser = $this->input->post('dtSubmit');
            $debtr = $arUser[4]['value'];
            $Slotno = $arUser[3]['value'];
            $business = $arUser[2]['value'];
            // var_dump($debtr);
            // var_dump($Slotno);
            // var_dump($business);
            // return;
            // var_dump($debtr);
            $dtName = '';
            // if(!empty($debtr)){
            //     $table='ar_debtor';
            //     $crit=array('debtor_acct'=>$debtr,
            //         'entity_cd'=>$entity,
            //         'project_no'=>$project);
            //     $dt = $this->m_wsbangun->getData_by_criteria($table, $crit);
            //     $dtName = $dt[0]->name;
            // }setData_by_query
            $sql="Update mgr.rl_sales set STATUS='P' where entity_cd='".$entity."' AND project_no='".$project."' ";
            $sql.=" AND lot_no='".$Slotno."' AND debtor_acct='".$debtr."'";
            $this->m_wsbangun->setData_by_query($sql);
            
            $tableSel = 'rl_sales';
            $dataSel = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'lot_no'=>$Slotno,
                    'debtor_acct'=>$debtr,
                    'business_id'=>$business
                );
            $Setdata = $this->m_wsbangun->getData_by_criteria($tableSel, $dataSel);
            $refno = '';
            if($Setdata) {
                $refno = $Setdata[0]->ref_no;    
            }
            // var_dump($refno);
            // var_dump($arUser[0]);
             
            $max = count($arUser);
            // var_dump($max);
            // var_dump($arUser);
            $arcode='';

            for ($i=0; $i < $max; $i++) 
            { 
                // var_dump($arUser[$i]['value']);
                if($arUser[$i]['name']=='rowID'){
                    $where=array('entity_cd'=>$entity,
                            'project_no'=>$project,
                            'approval_level_rowID'=>$arUser[$i]['value']);
               $datasubmit = $this->m_wsbangun->getData_by_criteria('v_rl_approval_user', $where); 
               // var_dump($datasubmit);
                // $level = $arUser[$i][1];
                // $userid = $arUser[$i][2];
                  $level = $datasubmit[0]->level_no;
                $userid = $datasubmit[0]->user_id;
                // var_dump($level);
               
                $Tperson = 'cm_authorized_person';
                if ($level == '1') {
                    $status = 'O';                    
                    $arcode = $userid;
                    $dtName = $datasubmit[0]->name;
                    // $Tperson = 'cm_authorized_person';

                    
                }else{
                    $status = 'N';                    

                }
                $Kperson = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'type'=>'A',
                    'trx_type'=>'',
                    'doc_no'=>$refno,
                    'curr_cd'=>'IDR',
                    'level_no'=>$level,
                    'user_id'=>$userid,
                    'from_limit'=>'00',
                    'to_limit'=>'00',
                    'status'=>$status,
                    'his_cancel'=>'0',
                    'audit_user'=>$Saudit_user,
                    'audit_date'=>date("d M Y h:i:s")
                    ); 

                $this->m_wsbangun->insertData($Tperson, $Kperson);
                $msg= "Submit Succesfully";

                }
               
            } //end for

                if ($Kperson) {
                    // $arcode = $arUser[0][2];
                    $table1 = 'security_users';
                    $kriteria1 = array('name' => $arcode);
                    $selData = $this->m_wsbangun->getData_by_criteria($table1, $kriteria1);
                    $DesNumber = '';
                    $Email = '';
                    if($selData) {
                        $DesNumber = $selData[0]->phone_cellular;
                        $Email = $selData[0]->email;    
                        if($dtName==''){
                            $dtName = $selData[0]->name;    
                        }
                    }

                        if (!empty($selData)) 
                        {   
                            $mesText = array(
                            "DestinationNumber"=>$DesNumber,
                            "TextDecoded"=>'Please review and approve new booking unit '.$Slotno.' Cs Name '.$dtName.'',
                            "creatorID"=>'MGR'
                                );
                        $this->m_sms->SendSms($mesText);
                            $msgSend='ok';
                        }else{
                            $msgSend= "Could'n read security_users, failed Send SMS";
                        }

                        // $pesan = '';
                        // $pesan.= 'congrat,'."\n\n";
                        // $pesan.= 'Please review and approve new booking unit '.$Slotno.' Cs Name '.$dtName.','."\n";
                        // $pesan.= '<a href="http://192.168.0.69/ifcaportal/">Go Here</a>'."\n";
                        // $pesan.= 'Thank you,';
                         $judul = 'Approval';
                        $data=array('lotno'=>$Slotno,
                                    'toName'=>$dtName,
                                    'fromName'=>$Tsuname,
                                    'projectdesct'=>$Tsprojectname);
                        $body = $this->load->view('Email/EmailSubmit', $data, true);
                        if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                        {
                            $this->_sendmail($Email, $judul, $body);
                            // $msg = 'Invitation successfully send';
                            $msgEmail='ok';
                        } else {
                            $msgEmail = 'Email not valid';
                        }
                        // $this->_sendmail($kepada, $judul, $pesan);
                }
            
            // $data = json_encode($level);
                $msg1=array('Pesan'=>$msg,
                            'PesanSend'=>$msgSend,
                            'PesanEmail'=>$msgEmail);
                echo json_encode($msg1);

            

        } 
    }
    public function addSubmit()
    {
        if($_POST)
        {
            //session login
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            //session booking
            $Tsuname = $this->session->userdata('Tsuname');
            $Tsprojectname = $this->session->userdata('Tsprojectname');
            $debtr = $this->session->userdata('debtr');
            $Slotno = $this->session->userdata('lotno');
            $Saudit_user = $this->session->userdata('Saudit_user');
            $business = $this->session->userdata('Sbusiness');
            //data pos checkbox
            $arUser = $this->input->post('dtSubmit');
            // var_dump($debtr);
            // return;
            // var_dump($debtr);
            $dtName = '';
            // if(!empty($debtr)){
            //     $table='ar_debtor';
            //     $crit=array('debtor_acct'=>$debtr,
            //         'entity_cd'=>$entity,
            //         'project_no'=>$project);
            //     $dt = $this->m_wsbangun->getData_by_criteria($table, $crit);
            //     $dtName = $dt[0]->name;
            // }setData_by_query
            $sql="Update mgr.rl_sales set STATUS='P' where entity_cd='".$entity."' AND project_no='".$project."' ";
            $sql.=" AND lot_no='".$Slotno."' AND debtor_acct='".$debtr."'";
            $this->m_wsbangun->setData_by_query($sql);
            
            $tableSel = 'rl_sales';
            $dataSel = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'lot_no'=>$Slotno,
                    'debtor_acct'=>$debtr,
                    'business_id'=>$business
                );
            $Setdata = $this->m_wsbangun->getData_by_criteria($tableSel, $dataSel);
            $refno = '';
            if($Setdata) {
                $refno = $Setdata[0]->ref_no;    
            }
            // var_dump($refno);
            // var_dump($arUser[0]);
             
            $max = count($arUser);
            // var_dump($max);
            // var_dump($arUser);
            $arcode='';

            for ($i=0; $i < $max; $i++) 
            { 
                // var_dump($arUser[$i]['value']);
               $where=array('entity_cd'=>$entity,
                            'project_no'=>$project,
                            'approval_level_rowID'=>$arUser[$i]['value']);
               $datasubmit = $this->m_wsbangun->getData_by_criteria('v_rl_approval_user', $where); 
               // var_dump($datasubmit);
                // $level = $arUser[$i][1];
                // $userid = $arUser[$i][2];
                  $level = $datasubmit[0]->level_no;
                $userid = $datasubmit[0]->user_id;
                // var_dump($level);
               
                $Tperson = 'cm_authorized_person';
                if ($level == '1') {
                    $status = 'O';                    
                    $arcode = $userid;
                    $dtName = $datasubmit[0]->name;
                    // $Tperson = 'cm_authorized_person';

                    
                }else{
                    $status = 'N';                    

                }
                $Kperson = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'type'=>'A',
                    'trx_type'=>'',
                    'doc_no'=>$refno,
                    'curr_cd'=>'IDR',
                    'level_no'=>$level,
                    'user_id'=>$userid,
                    'from_limit'=>'00',
                    'to_limit'=>'00',
                    'status'=>$status,
                    'his_cancel'=>'0',
                    'audit_user'=>$Saudit_user,
                    'audit_date'=>date("d M Y h:i:s")
                    ); 

                $this->m_wsbangun->insertData($Tperson, $Kperson);
                $msg= "Submit Succesfully";
                } //end for

                if ($Kperson) {
                    // $arcode = $arUser[0][2];
                    $table1 = 'security_users';
                    $kriteria1 = array('name' => $arcode);
                    $selData = $this->m_wsbangun->getData_by_criteria($table1, $kriteria1);
                    $DesNumber = '';
                    $Email = '';
                    if($selData) {
                        $DesNumber = $selData[0]->phone_cellular;
                        $Email = $selData[0]->email;    
                        if($dtName==''){
                            $dtName = $selData[0]->name;    
                        }
                    }

                        if (!empty($selData)) 
                        {   
                            $mesText = array(
                            "DestinationNumber"=>$DesNumber,
                            "TextDecoded"=>'Please review and approve new booking unit '.$Slotno.' Cs Name '.$dtName.'',
                            "creatorID"=>'MGR'
                                );
                        $this->m_sms->SendSms($mesText);
                            $msgSend='ok';
                        }else{
                            $msgSend= "Could'n read security_users, failed Send SMS";
                        }

                        // $pesan = '';
                        // $pesan.= 'congrat,'."\n\n";
                        // $pesan.= 'Please review and approve new booking unit '.$Slotno.' Cs Name '.$dtName.','."\n";
                        // $pesan.= '<a href="http://192.168.0.69/ifcaportal/">Go Here</a>'."\n";
                        // $pesan.= 'Thank you,';
                         $judul = 'Approval';
                        $data=array('lotno'=>$Slotno,
                                    'toName'=>$dtName,
                                    'fromName'=>$Tsuname,
                                    'projectdesct'=>$Tsprojectname);
                        $body = $this->load->view('Email/EmailSubmit', $data, true);
                        if(filter_var($Email, FILTER_VALIDATE_EMAIL))
                        {
                            $this->_sendmail($Email, $judul, $body);
                            // $msg = 'Invitation successfully send';
                            $msgEmail='ok';
                        } else {
                            $msgEmail = 'Email not valid';
                        }
                        // $this->_sendmail($kepada, $judul, $pesan);
                }

            // $data = json_encode($level);
                $msg1=array('Pesan'=>$msg,
                            'PesanSend'=>$msgSend,
                            'PesanEmail'=>$msgEmail);
                echo json_encode($msg1);

            

        } 
    }

}