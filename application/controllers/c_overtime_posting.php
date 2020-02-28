<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_overtime_posting extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        // $email = $this->session->userdata('Tsemail');
        $group = $this->session->userdata('Tsusergroup');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        $Business_id = $this->session->userdata('TsbusinessId');

        // var_dump($this->get_table());exit();
        $content = array(
            'ProjectDescs'=>$projectName);
        
        $this->load_content_top_menu('overtime/index_posting',$content);
    }
 
    public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        

        $ov_date = $this->input->post('ov_date',true);
        $ov_timestart = date('Y M d H:i:s', strtotime($ov_date));
        // var_dump($ov_timestart);
        // exit();
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','debtor_acct','name');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_overtime_posting';

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
        $SordField = ($sortIdColumn==0? 'debtor_acct' :$Column[$sortIdColumn]['name']);

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
        // $sqlad = "SELECT distinct debtor_acct from mgr.ot_trx(nolock) where entity_cd='$entity' and project_no='$project'  AND status_posting ='N'  and status='P' and approved='Y' ";        
        // $dt1 = $this->m_wsbangun->getData_by_queryadm($sqlad);
        // if(!empty($dt1)){
        //     $where_in = array();
        //     foreach ($dt1 as $key) {
        //         $where_in[]="'".$key->debtor_acct."'";
        //     }
        //     $where_in = implode( ', ', $where_in );
        //     // $where = "where entity_cd='$entity' and project_no='$project' and debtor_acct in ($where_in)";
        //     $where = "where  bill_debtor_acct in ($where_in) and debtor_acct = bill_debtor_acct";
        // }else{
        //     // $where="where entity_cd='$entity' and project_no='$project' and debtor_acct=''";
        //      $where="where  bill_debtor_acct='' and debtor_acct = bill_debtor_acct";
        // }
        // var_dump($filter_search);
        // $param = " $where ".$filter_search;
        // $param = " $where ".$filter_search;
        $param = $filter_search;
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

    public function posting(){

        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $project = $this->session->userdata('Tsproject');
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');

        $debtor_acct = $this->input->post('debtor_acct',true);
        $postdate = $this->input->post('ov_date',true);

        // var_dump($postdate);exit();


        $sql = "mgr.xot_post_overtime '".$entity."', '".$project."','".$debtor_acct."','".$debtor_acct."','".$postdate."'";
        $approve = $this->m_wsbangun->setData_by_query_cons($cons,$sql);

        if ($approve=='OK') {
            $callback['Pesan'] = 'Overtime has been posted succesfully.';
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = $update; 
        }

        echo json_encode($callback);
    }

    public function post_ot(){
        if($_POST){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
            $bill_debtor_acct = $this->input->post('bill_debtor_acct',true);
            $business_id = $this->input->post('business_id',true);
            $postdate = $this->input->post('post_date',true);
            $startperiod = $this->input->post('start',true);
            $endperiod = $this->input->post('end',true);
            $remarks = $this->input->post('remarks',true);
            $today = date('Y M d H:i:s');
            $time1 = strtotime($postdate);
            $postdate_new = date('Y M d H:i:s',$time1);

            $time2 = strtotime($startperiod);
            $startperiod = date('Y M d H:i:s',$time2);

            $time3 = strtotime($endperiod);
            $endperiod = date('Y M d H:i:s',$time3);

            $psn='';$statusdtpost='';$msg='';

            // $sqlad = "SELECT distinct debtor_acct from mgr.ot_trx(nolock) where entity_cd='$entity' and project_no='$project'  AND business_id='$business_id' ";        
            // $dtdebtors = $this->m_wsbangun->getData_by_query($sqlad);
            // $where_in = '';
            // if(!empty($dtdebtors)){
            //     $where_in = array();
            //     foreach ($dtdebtors as $key) {
            //         $where_in[]="'".$key->debtor_acct."'";
            //     }
            //     $where_in = implode( ', ', $where_in );
            //     // $where = "where entity_cd='$entity' and project_no='$project' and debtor_acct in ($where_in)";
            //     // $where = " business_id in ($where_in)";
            // } 
            // $where = " and debtor_acct in ($where_in)";
            // $sql = "SELECT * from mgr.v_ot_debtor_tenancy where entity_cd='$entity' and project_no='$project' and debtor_acct = '$debtor_acct'";    
            $sql = "SELECT distinct bill_debtor_acct,inv_group,currency_cd,min_hours_type,min_over_hours,credit_terms,trx_type,zone_cd,over_cd from mgr.v_ot_debtor_tenancy where entity_cd='$entity' and project_no='$project' and debtor_acct='$bill_debtor_acct' ";     
            $dthours = $this->m_wsbangun->getData_by_query($sql);
            // exit();
            if(!empty($dthours)){
                $bill_debtor = $dthours[0]->bill_debtor_acct;
                $inv_group = $dthours[0]->inv_group;
                $currency_cd = $dthours[0]->currency_cd;
                $min_hours_type = $dthours[0]->min_hours_type;
                $min_over_hours = $dthours[0]->min_over_hours;
                $credit_terms = $dthours[0]->credit_terms;
                $trx_type = $dthours[0]->trx_type; 
                $zone_cd = $dthours[0]->zone_cd; 
                $over_cd = $dthours[0]->over_cd; 
                // var_dump('data ot min hours berhasil');
            }else{
                $msg = "Can not get data from v_ot_debtor_tenancy.";
                $psn = 'Fail';
                $msg1= array('pesan'=>$msg,
                    'status'=>$psn);
                // var_dump('data ot min hours');
                echo json_encode($msg1);
                exit();
            }

            $dt_fji = array(
                            'entity_cd' => $entity,
                            'project_no'=>$project,
                            'debtor_acct'=>$bill_debtor_acct,
                            'inv_group'=>$inv_group,
                            'trx_type'=>$trx_type,
                            'bill_date'=>$postdate_new,
                            'currency_cd'=>$currency_cd,
                            'remarks'=>$remarks,
                            'status'=>'N',
                            'audit_user'=>'TWP',
                            'audit_date'=>$today,
                            'min_hours_type'=>$min_hours_type,
                            'min_over_hours'=>$min_over_hours,
                            'bill_amt'=>0,
                            'flag_round'=>'N',
                            'credit_terms'=>$credit_terms,
                            'start_period'=>$startperiod,
                            'end_period'=>$endperiod
                        );
            //start insert fji header
            $insertfji = $this->m_wsbangun->insertData('ot_trx_fji',$dt_fji);
            // $insertfji = 'OK';
            if($insertfji !="OK"){
                $msg = "Can't insert header. [ot_trx_fji]";
                $psn = 'Fail';
                $msg1= array('pesan'=>$msg,
                    'status'=>$psn);
                // var_dump('insert fji');
                echo json_encode($msg1);
                exit();
            }else{
                //ambil row id fji header
                // var_dump('insert fji berhasil');
                unset($dt_fji['audit_date']);
                unset($dt_fji['bill_amt']);
                $table = 'ot_trx_fji(nolock)';
                $dt_id_fji = $this->m_wsbangun->getData_by_criteria($table,$dt_fji);
                // var_dump('expression');
                // var_dump($dtfji);exit();   
                if(!empty($dt_id_fji)){
                    $rowid_hd=$dt_id_fji[0]->rowID;
                    // var_dump($rowid_hd);
                    // var_dump('dapet id fji');
                    //start select overtime dari adm
                    $sql = "SELECT DATEDIFF ( HOUR , start_overtime, end_overtime ) as hour_diff,DATEDIFF ( mi , start_overtime, end_overtime ) as min_diff, * from mgr.ot_trx where entity_cd='$entity' and project_no='$project' and debtor_acct = '$bill_debtor' and status_posting='N'  and status ='Y' and date_created <= '$postdate ".date("H:i:s")."'";        
                    $dt_OT = $this->m_wsbangun->getData_by_queryadm($sql);
                    if(!empty($dt_OT)){
                        //start inserting detail fji
                        $no=1;
                        $i = 0;
                        $len = count($dt_OT);
                        foreach ($dt_OT as $key) {
                            $dt_fji_dtl = array(
                                    'entity_cd' => $entity,
                                    'project_no'=>$project,
                                    'debtor_acct'=>$bill_debtor_acct,
                                    'lot_no'=>$key->lot_no,
                                    'inv_group'=>$inv_group,
                                    'trx_type'=>$trx_type,
                                    'over_cd'=>$over_cd,
                                    'zone_cd'=>$zone_cd,
                                    'bill_date'=>$postdate_new,
                                    'begin_date'=>date('Y M d H:i:s',strtotime($key->start_overtime)),
                                    'end_date'=>date('Y M d H:i:s',strtotime($key->end_overtime)),
                                    'apport_percent'=>100,
                                    'usage'=>$key->hour_diff,
                                    'rate'=>0,
                                    'trx_amt'=>0,
                                    'base_amt'=>0,
                                    'tax_amt'=>0,
                                    'audit_user'=>'TWP',
                                    'audit_date'=>$today,
                                    'descs'=>$key->description,
                                    'usage_zone'=>$key->min_diff,
                                    'area'=>0,
                                    'level_no'=>$key->level_no,
                                    'hours'=>$key->hour_diff,
                                    'trx_no'=>$no,
                                    'rowid_hd'=>$rowid_hd
                                );
                            //ini insert fji dtl
                            $insertfjidt = $this->m_wsbangun->insertData('ot_trxdt_fji',$dt_fji_dtl);
                            if($insertfjidt !="OK"){
                                $msg = "Can't insert detail with lot (".$key->lot_no."). ";
                                $psn = 'Fail';
                                $msg1= array('pesan'=>$msg,
                                    'status'=>$psn);
                            // var_dump('insert fji detail gagal');
                                echo json_encode($msg1);
                                exit();
                            } else {
                                //kalo berhasil insert detail fji trs update status posting ot adm jadi Y
                                $dtup = array('status_posting' => 'Y');
                                $where = array('ot_id' => $key->ot_id );
                                $updatestat = $this->m_wsbangun->updateDataweb('ot_trx',$dtup,$where);
                                if($updatestat !="OK"){
                                    $msg = "Can't update status with id (".$key->ot_id.").";
                                    $psn = 'Fail';
                                    $msg1= array('pesan'=>$msg,
                                        'status'=>$psn);
                                    // var_dump('update status posting di ot adm ggl');
                                    echo json_encode($msg1);
                                    exit();
                                }
                            }
                            if ($i == $len - 1) {
                                // var_dump($i);
                                // var_dump($len);
                                // var_dump('ALL DONE BITCH');
                                $statusdtpost = 'ALLDONE';
                            }
                            $no++;
                            $i++; 
                        }//end of foreach overtime adm
                        
                        //start excuteing stor procedure ot_trxdt_fji_time from pb
                        if($statusdtpost=='ALLDONE'){
                            $sql1 = "mgr.xot_trxdt_dtl_web '".$entity."', '".$project."','".$bill_debtor_acct."','".$bill_debtor_acct."', '".$postdate."', '".$rowid_hd."'";
                            $this->load->database();
                            $DB2 = $this->load->database('ifca', TRUE);
                            $aa = $DB2->query($sql1);
                            // var_dump($aa);
                            if($aa){
                            //      $sql2 = "mgr.xot_trxdt_time_dtl  '".$entity."', '".$project."','".$bill_debtor_acct."', '".$postdate."', '".$rowid_hd."'";
                            //     $bb = $DB2->query($sql2);

                            //     var_dump($bb);
                            //     if($bb){
                            //         var_dump('apaluw');
                            //     }
                                 // var_dump('ITS DONE');
                                $sql = "SELECT  sum(trx_amt) as trx_amt FROM mgr.ot_trxdt_fji_time  WHERE entity_cd = '$entity'and project_no = '$project' and debtor_acct = '$bill_debtor_acct' and bill_date ='$postdate' and rowid_hd ='$rowid_hd'";        
                                $dt_amt = $this->m_wsbangun->getData_by_query($sql);
                                $trx_amt = $dt_amt[0]->trx_amt;
                                // var_dump($trx_amt);
                                $dtup = array('bill_amt' => $trx_amt);
                                $where = array('rowid' => $rowid_hd );
                                $updatestat = $this->m_wsbangun->updateData('ot_trx_fji',$dtup,$where);
                                if($updatestat !="OK"){
                                    $msg = "Can't update trx_amt in ot_trx_fji.";
                                    $psn = 'Fail';
                                }else{
                                    $msg = "Overtime has been posted succesfully.";
                                    $psn = 'OK';
                                }
                            } else {
                                $msg = "Can't exec store procedure. Please tell admin.";
                                $psn = 'Fail';
                           
                            } 
                           
                            // var_dump('expression sp1');
                            // $sql2 = " mgr.xot_trxdt_time_dtl  '".$entity."', '".$project."','".$bill_debtor_acct."', '".$postdate."', '".$rowid_hd."'";
                            // $sp2 = $this->m_wsbangun->setData_by_query_cons('IFCAPB',$sql2);
                            // var_dump($sp2);
                            // var_dump('surprise maderfader');
                            // $aaa = strpos($sp1,'affected');
                            // if( $aaa <= 0 || !$aaa){
                            //     var_dump('aaa');
                            //     var_dump($aaa);
                            // }
                       
                          
                            // var_dump($qq);
                          
                        }else {
                            $msg = "Posting all data failed. Please tell admin.";
                            $psn = 'Fail';
                            // $msg1= array('pesan'=>$msg,
                            //     'status'=>$psn);
                            // // var_dump('data ot kosong');
                            // echo json_encode($msg1);
                            // exit();
                        }
                        //end of store procedure
                    } else {
                        $msg = "Can't insert fji detail. There's no overtime available.";
                        $psn = 'Fail';
                        // $msg1= array('pesan'=>$msg,
                        //     'status'=>$psn);
                        // // var_dump('data ot kosong');
                        // echo json_encode($msg1);
                        // exit();
                    } 

                } else {
                    $msg = "Can't get rowid from ot_trx_fji. Insert failed.";
                    $psn = 'Fail';
                    // $msg1= array('pesan'=>$msg,
                    //     'status'=>$psn);
                    // // var_dump('ga dapet id fji');
                    // echo json_encode($msg1);
                    // exit();
                }
            }// end if insert fji header
        
            
           
        } else{
            $msg="Data validation is not valid";
            $psn = 'Fail';
        }
            
        $msg1 = array('pesan'=>$msg,
                'status'=>$psn//,
                // 'dtexec'=>$bill_debtor.'-%-'.$postdate.'-%-'.$rowid_hd
            );
            
        echo json_encode($msg1);
    }


    public function exec_sp_ot(){


        $sql = "mgr.xot_trxdt_dtl '".$entity."', '".$project."','".$bill_debtor_acct."','".$bill_debtor_acct."', '".$postdate."', ".$rowid_hd."";
        $snd = $this->m_wsbangun->setData_by_query($sql);
                      
        if($snd=='OK'){
            $sql = "mgr.xot_trxdt_time_dtl  '".$entity."', '".$project."','".$bill_debtor_acct."', '".$postdate."', ".$rowid_hd."";
            $snd = $this->m_wsbangun->setData_by_query($sql);
                          
            if($snd=='OK'){
                //update trx_amt di ot_trx_fji
                $sql = "SELECT  sum(trx_amt) as trx_amt FROM mgr.ot_trxdt_fji_time   WHERE entity_cd = '$entity'and project_no = '$project' and debtor_acct = '$bill_debtor_acct' and bill_date ='$postdate' and rowid_hd ='$rowid_hd'";        
                $dt_amt = $this->m_wsbangun->getData_by_query($sql);
                $trx_amt = $dt_amt[0]->trx_amt;
                if($trx_amt == NULL || empty($trx_amt)){
                    $sql = "mgr.xot_trxdt_dtl '".$entity."', '".$project."','".$bill_debtor_acct."','".$bill_debtor_acct."', '".$postdate."', ".$rowid_hd."";
                    $snd = $this->m_wsbangun->setData_by_query($sql);
                    $sql = "mgr.xot_trxdt_time_dtl  '".$entity."', '".$project."','".$bill_debtor_acct."', '".$postdate."', ".$rowid_hd."";
                    $snd = $this->m_wsbangun->setData_by_query($sql);
                }else{
                    $dtup = array('bill_amt' => $trx_amt);
                    $where = array('rowid' => $rowid_hd );
                    $updatestat = $this->m_wsbangun->updateData('ot_trx_fji',$dtup,$where);
                    if($updatestat !="OK"){
                        $msg = "Can't update trx_amt in ot_trx_fji.";
                        $psn = 'Fail';
                    }else{
                        $msg = "Overtime has been posted succesfully.";
                        $psn = 'OK';
                    }
                }
               

            }else{
                $msg = "Can't execute sp xot_trxdt_dtl.";
                $psn = 'Fail';
                            
            }
        }else{
            $msg = "Can't execute sp xot_trxdt_dtl.";
            $psn = 'Fail';
                        
        }

        $msg1= array('pesan'=>$msg,
                'status'=>$psn);
            
        echo json_encode($msg1);
    }
  
}