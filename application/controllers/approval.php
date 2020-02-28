<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Approval extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
        // $this->load->model('m_dash');
    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        // var_dump($entity);
        $entname = $this->session->userdata('Tsentityname');
        // $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        // var_dump($name);
        $sys = $this->session->userdata('Tsysadmin');
        $approver = 1;

        $Content = array(
            'leftdyn'=>$name,
            'sys'=>$sys,
            'entname'=>$entname,
            'approver'=>$approver);
        $this->load_content('approval/index', $Content);
    }

    public function aprv()
    {
        $param = $this->uri->segment(3);
        $param = base64_decode($param);
        if(empty($param)) {
            $entity = $this->session->userdata('Tsentity');            
            $entityname = $this->session->userdata('Tsentityname');
        } else {
            $entity = $param;
            $table = 'cf_entity(nolock)';
            $crit = array('entity_cd'=>$entity);
            $dtE = $this->m_wsbangun->getData_by_criteria($table, $crit);
            if(!empty($dtE))
            {
                $entityname = $dtE[0]->entity_name;
                $this->session->set_userdata('Tsentity', $entity);
                $this->session->set_userdata('Tsentityname', $entityname);
            }
        }
        // $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $sys = $this->session->userdata('Tsysadmin');
        $approver = 1;
        $Content = array(
            'leftdyn'=>$name,
            'approver'=>$approver,
            'sys'=>$sys,
            'entname'=>$entityname);  
        $this->load_content('approval/index', $Content, true);
    }
    
    public function getTable()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aColumns  = array('row_number','type', 'doc_no', 'name','prjname', 'rowid');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_list_approval';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        // $iDisplayLength = 10;
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($sortIdColumn);
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'doc_no' :$Column[$sortIdColumn]['name']);
        // var_dump($SordField);
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
        $param =" Where user_id='".$name."' AND entity_cd='".$entity."' AND project_no= '".$project."' AND status='O' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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

    public function updApv()
    {
        if($_POST)
        {
            $rowid = $this->input->post('rid', TRUE);
            $today = date('Y M d H:i:s');
            // approved
            $table = 'cm_authorized_person';
            $crit = array('rowID'=>$rowid);
            $data = array('status'=>'A',
                'approved_date'=>$today);
            $this->m_wsbangun->updateData($table, $data, $crit);
            // var_dump("1");
            // check other approver
            $table = 'v_list_approval';
            $dtA = $this->m_wsbangun->getData_by_criteria($table, $crit);
            $entity = $dtA[0]->entity_cd;
            $project = $dtA[0]->project_no;
            $doc_no = $dtA[0]->doc_no;
            $acct = $dtA[0]->debtor_acct;
            $ord = array('level_no', 'ASC');
            $crit = array('type'=>'A',
                'status'=>'N',
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'doc_no'=>$doc_no);
            $dtApv = $this->m_wsbangun->getData_by_criteria($table, $crit, null, $ord);
            $table = 'rl_sales(nolock)';
            $crit = array('ref_no'=>$doc_no);
            $dtSale = $this->m_wsbangun->getData_by_criteria($table, $crit);
            // var_dump('2');
            if(!empty($dtApv))
            {
                $othApv = $dtApv[0]->user_id;
                $table = 'cm_authorized_person';
                $data1 = array('status'=>'O');
                $crit = array('type'=>'A',
                    'status'=>'N',
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'doc_no'=>$doc_no,
                    'user_id'=>$othApv);
                $this->m_wsbangun->updateData($table, $data1, $crit);

                $table = 'security_users';
                $crit = array('name'=>$othApv);
                $dtUser = $this->m_wsbangun->getData_by_criteria($table, $crit);
                // var_dump('3');
                if(!empty($dtUser))
                {
                    $destno = $dtUser[0]->phone_cellular;
                    $mailto = $dtUser[0]->email;
                    
                    if(!empty($dtSale))
                    {
                        $lot = $dtSale[0]->lot_no;
                        $acct = $dtSale[0]->debtor_acct;
                        $table = 'ar_debtor(nolock)';
                        $crit = array('debtor_acct'=>$acct);
                        $dtAcct = $this->m_wsbangun->getData_by_criteria($table, $crit);
                        $dtName = (!empty($dtAcct)) ? $dtAcct[0]->name : '';
                    }
                    // notify sms
                    // if(!empty($destno)||!empty($dtName))
                    // {
                    //     $msgSMS = array('DestinationNumber'=>$destno,
                    //         "TextDecoded"=>'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName,
                    //         "creatorID"=>'MGR');
                    //     $this->m_sms->SendSms($msgSMS);
                    // }

                    // notify email
                    // if(!empty($mailto)||!empty($dtName))
                    // {
                    //     $subj = 'Approval';
                    //     $body = 'Congrat,'."\n\n";
                    //     $body.= 'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName.','."\n\n";
                    //     $body.= 'Thank you,';
                    //     $this->_sendmail($mailto, $subj, $body);
                    // }
                    $msg = 'Approval on progress';
                } else {
                    $msg = 'Approver not found';
                    // var_dump('4');
                }
            } else {
                if(!empty($acct))
                {
                    $sql = "mgr.xrl_billing_chrg '".$entity."', '".$project."','".$acct."'";
                    $res = $this->m_wsbangun->getData_by_query($sql);

                    $table = 'rl_sales';
                    $crit = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'ref_no'=>$doc_no);
                    $data = array('status'=>'B');
                    $this->m_wsbangun->updateData($table, $data, $crit);
                    // print_r("xrl");
                }
                $msg = 'Approval completed';
                // var_dump('5');
            }
        } else {
            $msg = 'method not valid';
            // var_dump('6');
        }
        $t = array('pesan'=>$msg);
        // var_dump($t);
        echo json_encode($t);
    }

    public function upApv()
    {        
        if($_POST)
        {
            $resback = false;
            $userid = $this->input->post('user_id', TRUE);
            $status = $this->input->post('status',TRUE);
            $doc_no = $this->input->post('doc_no',TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $today = date('Y M d H:i:s');
            // save approval
            $table = 'cm_authorized_person';
            $crit = array('type'=>'A',
                'doc_no'=>$doc_no,
                'user_id'=>$userid,
                'entity_cd'=>$entity,
                'project_no'=>$project);
            $data = array('status'=>$status,
                'approved_date'=>$today);
            $this->m_wsbangun->updateData($table, $data, $crit);
            // print_r('approve');
            // check other approver
            $ord = array('level_no', 'ASC');
            $crit = array('type'=>'A',
                'status'=>'N',
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'doc_no'=>$doc_no);
            // $cnt = $this->m_wsbangun->getCount_by_criteria($table, $crit);
            $dtApv = $this->m_wsbangun->getData_by_criteria($table, $crit, null, $ord);
            $table = 'rl_sales';
            $crit = array('ref_no'=>$doc_no);
            $dtSale = $this->m_wsbangun->getData_by_criteria($table, $crit);
            $acct = $dtSale[0]->debtor_acct;
            if(!empty($dtApv)) 
            {
                // update status next approver
                $othApv = $dtApv[0]->user_id;
                $table = 'cm_authorized_person';
                $data1 = array('status'=>'O');
                $crit = array('type'=>'A',
                    'status'=>'N',
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'doc_no'=>$doc_no,
                    'user_id'=>$othApv);
                $this->m_wsbangun->updateData($table, $data1, $crit);
                // find detail data
                $table = 'security_users';
                $crit = array('name'=>$othApv);
                $dtUser = $this->m_wsbangun->getData_by_criteria($table, $crit);
                if(!empty($dtUser))
                {
                    $destno = $dtUser[0]->phone_cellular;
                    $mailto = $dtUser[0]->email;
                    
                    if(!empty($dtSale))
                    {
                        $lot = $dtSale[0]->lot_no;
                        $acct = $dtSale[0]->debtor_acct;
                        $table = 'ar_debtor';
                        $crit = array('debtor_acct'=>$acct);
                        $dtAcct = $this->m_wsbangun->getData_by_criteria($table, $crit);
                        $dtName = (!empty($dtAcct)) ? $dtAcct[0]->name : '';
                        // if(!empty($dtAcct))
                        // {
                        //     $dtName = $dtAcct->name;
                        // }
                        // var_dump($dtName);
                    }
                    // notify sms
                    // if(!empty($destno)||!empty($dtName))
                    // {
                    //     $msgSMS = array('DestinationNumber'=>$destno,
                    //         "TextDecoded"=>'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName,
                    //         "creatorID"=>'MGR');
                    //     $this->m_sms->SendSms($msgSMS);
                    //     // print_r("sms");
                    // }

                    // notify email
                    if(!empty($mailto)||!empty($dtName))
                    {
                        $subj = 'Approval';
                        $body = 'Congrat,'."\n\n";
                        $body.= 'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName.','."\n\n";
                        $body.= 'Thank you,';
                        $this->_sendmail($mailto, $subj, $body);
                        // print_r("email");
                    }
                }
            } else {
                if(!empty($acct))
                {
                    $sql = "mgr.xrl_billing_chrg '".$entity."', '".$project."','".$acct."'";
                    $res = $this->m_wsbangun->getData_by_query($sql);

                    $table = 'rl_sales';
                    $crit = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'ref_no'=>$doc_no);
                    $data = array('status'=>'B');
                    $this->m_wsbangun->updateData($table, $data, $crit);
                    // print_r("xrl");
                }
            $resback = true;    
            }
        }
        $tes = array('tes' => $resback );
        echo json_encode($tes);
    }
}