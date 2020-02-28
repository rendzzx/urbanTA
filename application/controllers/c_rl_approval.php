<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_rl_approval extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
    }

    public function setup()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $webuser = $this->session->userdata('Tsuname');
        $sql = "SELECT a.level_no, a.user_id, b.email, b.phone_cellular FROM mgr.cf_approval_level a ";
        $sql.= "INNER JOIN mgr.security_users b ON a.entity_cd=b.entity_cd AND a.project_no=b.project_no AND ";
        $sql.= "a.user_id=b.name WHERE a.module = 'CM' AND a.process_cd = 'SALE'";
        $dtApv = $this->m_wsbangun->getData_by_query($sql);
        $list = '';
        if(!empty($dtApv)){
            foreach ($dtApv as $key => $value) {
                $list.= '<tr role="row" class="odd">';
                $list.= '<td><input type="text" id="level'.$key.'" value="'.$value->level_no.'" class="form-control"/></td>';
                $list.= '<td><input type="text" id="user'.$key.'" value="'.$value->user_id.'" class="form-control"/></td>';
                // $list.= '<td>'.$value->email.'</td>';
                // $list.= '<td>'.$value->phone_cellular.'</td>';
                // $list.= '<td><a href="'.base_url('c_rl_approval/edit/'.$value->user_id).'" class="btn btn-primary"></a>';
                $list.= '<td><input type="email" name="email'.$key.'" id="email'.$key.'" value="'.$value->email.'" class="form-control"/></td>';
                $list.= '<td><input type="text" name="cellular'.$key.'" id="cellular'.$key.'" value="'.$value->phone_cellular.'" class="form-control"/></td>';
                $list.= '<td><input type="button" id="edit'.$key.'" data-level="'.$key.'" class="btn btn-default open-enabled" value="Edit" onclick="edit('.$key.');"></td>';
                $list.= '</tr>';
            }
        }
        $content = array('appList'=>$list);
        $this->load_content('approval/setting',$content);
    }

    public function edit()
    {
        if($_POST)
        {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $dt = $this->input->post('dname',TRUE);
            // var_dump($dt);
            // var dt = new array(user,level,email,phone);
            // $v1 = $dt[0];
            // var_export($v1);
            $sql = "update mgr.security_users set email='".$dt[2]."', email_add='".$dt[2]."', phone_cellular='".$dt[3]."' ";
            $sql.= "where name='".$dt[0]."' and entity_cd='".$entity."' and project_no='".$project."'";
            // $res = $this->m_wsbangun->getData_by_query($sql);
            $DB2 = $this->load->database('ifca', TRUE);
            $res = $DB2->query($sql);
            $DB2->close();
            // var_dump($sql);
            // $DB2 = $this->load->database('ifca', TRUE);
            // $query = $DB2->query($sql);
            // $res = $query->result();
            
        }
    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $entity = '2101';
        $project = '210101';
        // $webuser = $this->session->userdata('Tsuname');
        $tid = $this->session->userdata('Tuser_id');
   	 	$webuser = $this->session->userdata('Tsuname');
   	 	// var_dump($tid);
   	 	if($tid == 34) {
   	 		$webuser = 'MKT1';
   	 	} elseif($tid == 36) {
   	 		$webuser = 'ARIE';
   	 	} else {
   	 		$webuser = 'ARYA';
   	 	}
   	 	// var_dump($webuser);
        // $webuser = 'ARIE';
        $table = 'cm_authorized_person';
        $kriteria = array( 'status' => 'O',
         'user_id'=>$webuser);
        $listData = $this->m_wsbangun->getData_by_criteria($table, $kriteria);
        
        if (!empty($listData)) 
        {   
            $n = 0;
            $appList = '';
            foreach ($listData as $value) 
            {
                $appList .='<tr role="row" class="odd">';
                $appList .='<td></td>';
                $appList .='<td>'.$value->type.'</td>';
                $appList .='<td class="sorting_1">'.$value->doc_no.'</td>';
                $n++;

                $table = 'rl_sales';
                $sel1 = $value->entity_cd;
                $sel2 = $value->project_no;
                $sel3 = $value->doc_no;

                $kriterialot = array(
                    'entity_cd'=>$sel1,
                    'project_no'=>$sel2,
                    'ref_no'=>$sel3
                    );

                $allLot = $this->m_wsbangun->getData_by_criteria($table, $kriterialot);
                $business = '';
                $listLot = '';
                if ($allLot) {
                    $business = $allLot[0]->business_id;
                    foreach ( $allLot as $key => $value2) {
                        $listLot .='<td>'.$value2->lot_no.'</td>';
                        $listLot .='<td> Price : '.number_format($value2->list_price,2).'<br/>Disc Amt : '.number_format($value2->disc_amt,2).'<br/>Disc Special : '.number_format($value2->discount_special_amt,2).'<br/> Sell Price : '.number_format($value2->sell_price,2).'</td>';
                        // $listLot .='<td>'.number_format($value2->disc_amt,2).'</td>';
                        // $listLot .='<td>'.number_format($value2->discount_special_amt,2).'</td>';
                        // $listLot .='<td>'.number_format($value2->sell_price,2).'</td>';
                    }
                }
                //buyer
                $tablebuy = 'ar_debtor';
                $sell3 = $value2->business_id;
                $sell3 = $business;
                // var_dump($sell3);

                $kriteriabuyer = array(
                    'business_id'=>$sell3
                    );

                $allbuyer = $this->m_wsbangun->getData_by_criteria($tablebuy, $kriteriabuyer);

                $listbuyer = '';
                if ($allbuyer) {
                    // var_dump($allbuyer);
                    // foreach ( $allbuyer as $join => $value3) {
                    //     $listbuyer .='<td>'.$value3->name.'</td>';
                    // }
                    $listbuyer .='<td>'.$allbuyer[0]->name.'</td>';
                }

                $appList .= $listbuyer;
                $appList .= $listLot;
                // $appList .='<td>'.$value->reason_cd.'</td>';
                // $appList .='<td>'.date('Y-m-d', strtotime($value->audit_date)).'</td>';
                // $appList .='<td><select>
                //             <option value="O"></option>
                //             <option value="A">Approval</option>
                //             <option value="R">Reject</option>
                //             <option value="V">Revision</option>
                //             </select></td>';
                // $appList .='<td><input type="radio" value="O"><label> Avalaible </label><br/>';
                $appList .='<td><input type="radio" id="radio1" name="optAction'.$n.'" value="A">&nbsp;<label> Approval </label><br>';
                $appList .='<input type="radio" id="radio2" name="optAction'.$n.'" value="R">&nbsp;<label> Reject </label><br>';
                $appList .='<input type="radio" id="radio3" name="optAction'.$n.'" value="V">&nbsp;<label> Revision </label><br></td>';
                // $appList .='<td>'.$value->reason_cd.'</td>';
                // $appList .='<td></td>';
                $appList .='</tr>';
            }
            $allList = array('appList'=>$appList);
        }else{
            $allList = array('appList'=>'');
        }
        $this->load_content('approval/index',$allList);
    }

    public function upApv()
    {
        
        if($_POST)
        {
            $resback = false;
            $userid = $this->input->post('user_id', TRUE);
            $status = $this->input->post('status',TRUE);
            $doc_no = $this->input->post('doc_no',TRUE);

            // $tid = $this->session->userdata('Tuser_id');
            // var_dump($tid);
            // if($tid = 34) {
            //     $userid = 'MKT1';
            // } elseif($tid = 36) {
            //     $userid = 'ARIE';
            // } else {
            //     $userid = 'ARYA';
            // }

            // $entity = $this->session->userdata('Tsentity');
            // $project = $this->session->userdata('Tsproject');
            $entity = '2101';
        	$project = '210101';
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
                        // $acct = $dtSale[0]->debtor_acct;
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
                        $body = 'Dear Manager, '."\n\n";
                        $body.= 'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName.','."\n\n";
                        $body.= 'http://112.78.150.228/demo'."\n\n";
                        $body.= 'Thank you,';
                        $this->_sendmail($mailto, $subj, $body);
                        // print_r("email");
                    }
                }
            } else {
                if(!empty($acct))
                {
                    $DB2 = $this->load->database('new', TRUE);
                    // // sqlsrv_configure('WarningReturnAsErrors', 0);
                    $sql = "mgr.xrl_billing_chrg '".$entity."', '".$project."', '".$acct."'";
                    $result = $DB2->query($sql); //->result_array();
                    $DB2->close();
                    // echo "result"; 
                    // var_dump($result);
                    // $sp = "mgr.xrl_billing_chrg ?,?,?";
                    // $params = array($entity, $project,$acct);
                    // // sqlsrv_configure('WarningReturnAsErrors', 0);
                    // $result = $DB2->query($sp,$params);
                    // var_dump($result);

                    // $sql = "mgr.xrl_billing_chrg '".$entity."', '".$project."','".$acct."'";
                    // $res = $this->m_wsbangun->getData_by_query2($sql);

                    $table = 'rl_sales';
                    $crit = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'ref_no'=>$doc_no);
                    $data = array('status'=>'B');
                    $this->m_wsbangun->updateData2($table, $data, $crit);
                    // print_r("xrl");
                    $dtrl = $this->m_wsbangun->getData_by_criteria($table, $crit);

                    $table = 'cm_authorized_person';
                    $data = array('status'=>$status);
                    $crit = array('type'=>'A',
                        'doc_no'=>$doc_no,
                        'user_id'=>$userid,
                        'entity_cd'=>$entity,
                        'project_no'=>$project);
                    $this->m_wsbangun->updateData($table, $data, $crit);

                    // if(!empty($dtrl)) {
                    // 	$salesman = $dtrl[0]->staff_in_charge;
                    // 	$sql = "select c.email,c.phone_cellular,c.name from mgr.cf_agent_dt b, mgr.security_users c ";
                    // 	$sql.= "where b.ENTITY_CD = c.entity_cd and b.agent_name = c.name and b.agent_cd = '" .$salesman. "'";
                    // 	$dtnm = $this->m_wsbangun->getData_by_query($sql);
                    // 	if(!empty($dtnm)) {
                    // 		$mail = $dtnm[0]->email;
                    // 		$phone = $dtnm[0]->phone_cellular;
                    // 		// sms to agent
                    // 		if(!empty($phone)) {
                    // 			$msgSMS = array('DestinationNumber'=>$phone,
		                  //           "TextDecoded"=>'Your Sales booking with SP Number : '.$doc_no.' have been approved',
		                  //           "creatorID"=>'MGR');
		                  //       $this->m_sms->SendSms($msgSMS);
                    // 		}
                    // 	}

                    // }
                }
            $resback = true;    
            }
        }
        $tes = array('tes' => $resback );
        echo json_encode($tes);
    }
}