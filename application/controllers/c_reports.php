<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_Reports extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
    }

    public function gta($t=null)
    {
        $cons = $this->session->userdata('Tscons');
        if(empty($t)) {
            show_404();
            return;
        } else {
            $table = 'v_tts';
            $crit = array('status'=>'A',
                'nup_no'=>$t);
            $dtA = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
            if(!empty($dtA))
            {
                $ticket = 'img/'.substr($dtA[0]->descs, 0, strpos($dtA[0]->descs, ' ')).'.jpg';
                $content = array('isi'=>$dtA[0], 'type'=>$dtA[0]->type, 'ticket'=>$ticket);
                // $html = $this->load->view('booking/v_rl_gt', $content);
                $html = $this->load->view('booking/v_rl_gt', $content, true);
            } else {
                $html = $this->load->view('booking/v_rl_gt', null, true);
            }
            pdfGen($html, $t, "A4", "portrait");
        }
    }

    public function test(){
        $this->load->view('booking/test');
    }

     public function gtm()
    {
        if($_POST)
        {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $usermail = $this->session->userdata('Tsemail');
            $cons = $this->session->userdata('Tscons');
            $nupno = $this->input->post('id', true);

             $sql = "mgr.xrl_send_mail_nup_app '".$entity."', '".$project."', '".$nupno."', '".$usermail."' ";

             $snd = $this->m_wsbangun->setData_by_query_cons($cons,$sql);
             $aaa = strpos($snd,'queued');
             if( $aaa <= 0 || !$aaa){
                    $msg = $snd;
                    $psn ='Fail';
                    $aa = 'Sent Email Failed, Please Contact your Admin!';
                }else{
                    $msg = 'Email sent';
                    $psn ='OK';
                    $aa = $msg;
                }

            // $t = array('Pesan'=>$msg,
            //         'Status'=>$psn,
            //         'Msg'=>$aa);

            // echo json_encode($t);




        //     $table = 'v_tts';
        //     $crit = array('status'=>'A',
        //         'nup_no'=>$nupno);
        //     $dtA = $this->m_wsbangun->getData_by_criteria($table, $crit);
        //     if(!empty($dtA))
        //     {
        //         $ticket = 'img/'.substr($dtA[0]->descs, 0, strpos($dtA[0]->descs, ' ')).'.jpg';
        //         $content = array('isi'=>$dtA[0], 'type'=>$dtA[0]->type, 'ticket'=>$ticket);
        //         // $html = $this->load->view('booking/v_rl_gt', $content);
        //         $html = $this->load->view('booking/v_rl_gt', $content, true);
        //     } else {
        //         $html = $this->load->view('booking/v_rl_gt', null, true);
        //     }
        //     $a = pdfGenMail($html, $nupno, "A4", "potrait");
        //     // var_dump($a);exit();
        //     $filename = 'pdf/PDF/'.$nupno.".pdf";
        //     $pdfName = $nupno.'.pdf';
        //     file_put_contents($filename, $a);
        //     sleep(1);
        //     if(!empty($dtA))
        //     {
        //         $email = $dtA[0]->email_addr;
        //         // $email = 'andi@ifca.co.id';
        //         // $email = 'harry.suwandi@ifca.co.id';
        //         $table = 'v_nup_update';
        //         $crit = array('nup_no' => $nupno );
        //         $dtB = $this->m_wsbangun->getData_by_criteria($table, $crit);
        //         $entity = $dtB[0]->entity_cd;
        //         if(!empty($dtB))
        //         {
        //             $data = array('mail'=>$dtB[0]);
        //             $body = $this->load->view('Email/EmailTicket', $data, TRUE);
        //             // var_dump($body);exit();
        //             $sql ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
        //             $data = $this->m_wsbangun->getData_by_query($sql);                    
        //             $profile_mail = $data[0]->email_profile;
        //             // var_dump($profile_mail);exit();
        //             if(filter_var($email, FILTER_VALIDATE_EMAIL))
        //             {

        //                 $title = 'NUP Ticket';
        //                 $file = base_url('pdf/PDF/'.$nupno.'.pdf');
        //                 // $s = $this->_sendmail($email, $title, $body, $filename);
        //                 // var_dump($s);
        //                 // exit();
        //                 // $this->_sendmail($email, $title, $body);
        //                 // $sql = "mgr.x_send_mail_php '".$profile_mail."', '".$email."', '".$title."', '".$body."', '".$pdfName."' ";
        //                 $sql = "mgr.x_send_mail_php '".$entity."', '".$project."', '".$nupno."', '".$usermail."' ";


     
        //                 $snd = $this->m_wsbangun->setData_by_query($sql);
        //                 if($snd !='OK'){
        //                     $msg = $snd;
        //                     $psn ='Fail';
        //                     $aa = 'Sent Email Failed, Please Contact your Admin!';
        //                 }else{
        //                     $msg = 'Email sent';
        //                     $psn ='OK';
        //                     $aa = $msg;
        //                 }
        //                 // var_dump($msg);
        //             }
        //         }
        //     }
        //     // $msg = 'Email sent';
        } else {
            $msg = 'method not valid';
            $psn ='Fail';
            $aa = $msg;
        }
        $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
        echo json_encode($t);
    }
    public function TesMail()
    {
        if($_POST)
        {
            $nupno = $this->input->post('id', true);
            $table = 'v_tts';
            $crit = array('status'=>'A',
                'nup_no'=>$nupno);
            $dtA = $this->m_wsbangun->getData_by_criteria($table, $crit);
            if(!empty($dtA))
            {
                $ticket = 'img/'.substr($dtA[0]->descs, 0, strpos($dtA[0]->descs, ' ')).'.jpg';
                $content = array('isi'=>$dtA[0], 'type'=>$dtA[0]->type, 'ticket'=>$ticket);
                // $html = $this->load->view('booking/v_rl_gt', $content);
                $html = $this->load->view('booking/v_rl_gt', $content, true);
            } else {
                $html = $this->load->view('booking/v_rl_gt', null, true);
            }
            $a = pdfGenMail($html, $nupno, "A4", "potrait");
            // var_dump($a);exit();
            $filename = 'pdf/PDF/'.$nupno.".pdf";
            $pdfName = $nupno.'.pdf';
            file_put_contents($filename, $a);
            sleep(1);
            if(!empty($dtA))
            {
                $email = $dtA[0]->email_addr;
                // $email = 'andi@ifca.co.id';
                // $email = 'harry.suwandi@ifca.co.id';
                $table = 'v_nup_update';
                $crit = array('nup_no' => $nupno );
                $dtB = $this->m_wsbangun->getData_by_criteria($table, $crit);
                if(!empty($dtB))
                {
                    $data = array('mail'=>$dtB[0]);
                    $body = $this->load->view('Email/EmailTicket', $data, TRUE);
                    // var_dump($body);exit();
                    $sql ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
                    $data = $this->m_wsbangun->getData_by_query($sql);                    
                    $profile_mail = $data[0]->email_profile;
                    // var_dump($profile_mail);exit();
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {

                        $title = 'NUP Ticket';
                        $file = base_url('pdf/PDF/'.$nupno.'.pdf');
                        // $s = $this->_sendmail($email, $title, $body, $filename);
                        // var_dump($s);
                        // exit();
                        // $this->_sendmail($email, $title, $body);
                        $sql = "mgr.x_send_mail_php '".$profile_mail."', '".$email."', '".$title."', '".$body."', '".$pdfName."' ";
                        $snd = $this->m_wsbangun->setData_by_query($sql);
                        if($snd !='OK'){
                            $msg = $snd;
                            $psn ='Fail';
                            $aa = 'Sent Email Failed, Please Contact your Admin!';
                        }else{
                            $msg = 'Email sent';
                            $psn ='OK';
                            $aa = $msg;
                        }
                        // var_dump($msg);
                    }
                }
            }
            // $msg = 'Email sent';
        } else {
            $msg = 'method not valid';
            $psn ='Fail';
            $aa = $msg;
        }
        $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
        echo json_encode($t);
    }

    public function gt($t=null)
    {
        if(empty($t)) {
            show_404();
            return;
        } else {
            $table = 'v_tts';
            $crit = array('status'=>'A',
                'nup_no'=>$t);
            $dtA = $this->m_wsbangun->getData_by_criteria($table, $crit);
            if(!empty($dtA))
            {
                $ticket = 'img/'.substr($dtA[0]->descs, 0, strpos($dtA[0]->descs, ' ')).'.jpg';
                $content = array('isi'=>$dtA[0], 'type'=>$dtA[0]->type, 'ticket'=>$ticket);
                // $html = $this->load->view('booking/v_rl_gt', $content);
                $html = $this->load->view('booking/v_rl_gt', $content, true);
            } else {
                $html = $this->load->view('booking/v_rl_gt', null, true);
            }
            // pdfGen($html, $t, "A4", "portrait");

            $a = pdfGenMail($html, $t, "A4", "potrait");
            $filename = '/img/rpt/'.$t.".pdf";
            file_put_contents($filename, $a);
            sleep(1);
            if(!empty($dtA))
            {
                // $email = $dtA[0]->email_addr;
                // $email = 'andi@ifca.co.id';
                $email = 'harry.suwandi@ifca.co.id';
                $table = 'v_nup_update';
                $crit = array('nup_no' => $t );
                $dtB = $this->m_wsbangun->getData_by_criteria($table, $crit);
                if(!empty($dtB))
                {
                    $data = array('mail'=>$dtB[0]);
                    $body = $this->load->view('Email/EmailTicket', $data, TRUE);
                    if(filter_var($email, FILTER_VALIDATE_EMAIL))
                    {
                        $title = 'NUP Ticket';
                        $file = base_url('img/rpt/'.$t.'.pdf');
                        // $s = $this->_sendmail($email, $title, $body, $filename);
                        // var_dump($s);
                        // exit();
                        $this->_sendmail($email, $title, $body);
                    }
                }

                // $data = array();
                
            }
        }
    }

    public function jp($debtor=null, $lotno=null)
    {
        if(empty($debtor)||empty($lotno)){
            show_404();
            return;
        } else {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $table = 'print_bill';
            $ord = array('bill_date','ASC');
            $criteria = array(
                'debtor_acct'=>$debtor,
                'lot_no'=>$lotno);
            $dtPrint = $this->m_wsbangun->getData_by_criteria($table, $criteria, null, $ord);
            $sale_amt = 0;
            $detail = '';
            foreach ($dtPrint as $key => $value) {
                $sale_amt+=$value->trx_amt;
                $n = $key + 1;
                $detail.='<tr>';
                $detail.='<td>'.$n.'</td>';
                $detail.='<td>'.(empty($value->bill_desc)? '': $value->bill_desc).'</td>';
                $detail.='<td style="text-align:right">'.date("d M Y", strtotime($value->bill_date)).'</td>';
                // $detail.='<td class="short">'.$value->currency_cd.'</td>';
                $detail.='<td class="money">'.$value->currency_cd.'  '.number_format($value->trx_amt,2).'</td>';
                $detail.='</tr>';
            }
            $detail.='<tr><th colspan="3" style="text-align:right;">Total</th>';
            // $detail.='<th class="short">&nbsp'.$value->currency_cd.'</th>';
            $detail.='<th class="money">'.$value->currency_cd.'  '.number_format($sale_amt,2).'</th>';
            // var_dump($dtPrint);
            $content = array('isi'=>$dtPrint[0],
                'harga'=>$sale_amt,
                'list'=>$detail);
            $namafile = 'bill-'.$dtPrint[0]->NAME;
            // $html = $this->load->view('booking/v_rl_jp', $content);
            $html = $this->load->view('booking/v_rl_jp', $content, true);
            pdfGen($html, $namafile, "A4", "portrait");
        }
    }

    public function sp($debtor=null, $lotno=null)
    {
    	// $html = $this->load->view('welcome_message','',true);
        // var_dump("2");
        // var_dump($debtor);
        // var_dump($lotno);
        if(empty($debtor)||empty($lotno)){
            show_404();
            return;
        } else {
            // var_dump("2");
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $table = 'print_sp';
            $criteria = array('entity_cd'=>$entity,
                'project_no'=>$project,
                'debtor_acct'=>$debtor,
                'lot_no'=>$lotno);
            $dtPrint = $this->m_wsbangun->getData_by_criteria($table, $criteria);
            if(!empty($dtPrint))
            {
                // var_dump("3");
                $table = 'cf_entity';
                $dtEntity = $this->m_wsbangun->getData($table);
                $table = 'pl_project';
                $criteria = array('entity_cd'=>$entity,
                    'project_no'=>$project);
                $dtProject = $this->m_wsbangun->getData_by_criteria($table, $criteria);
                $namafile = $dtPrint[0]->name.'-'.$lotno;
                $terbilang = amountinWords($dtPrint[0]->harga_jual);
                $table = 'print_sp_dt';
                $criteria = array('debtor_acct'=>$debtor,
                    'lot_no'=>$lotno);
                $ord = array('min_date', 'ASC');
                $dtPrintDet = $this->m_wsbangun->getData_by_criteria($table, $criteria, null, $ord);
                // $detail = null;
                $detail = '';
                if(!empty($dtPrintDet)) {
                    // $detail = $dtPrintDet[0];
                    // --
                    $t = 0;
                    foreach ($dtPrintDet as $key => $prDetail) {
                        $n = $key + 1;
                        $t+= $prDetail->trx_amt * $prDetail->jumlah;
                        $detail.='<tr>';
                        $detail.='<td>'.$n.'</td>';
                        $detail.='<td>'.($prDetail->min_descs==$prDetail->max_descs ? $prDetail->max_descs: $prDetail->min_descs.' s/d '. $prDetail->max_descs).'</td>';
                        $detail.='<td>'.($prDetail->min_date==$prDetail->max_date ? date("d M Y", strtotime($prDetail->max_date)) : date("d M Y", strtotime($prDetail->min_date)).' s/d '.date("d M Y", strtotime($prDetail->max_date))).'</td>';
                        $detail.='<td style="text-align:right;">'.($prDetail->jumlah>1 ? '@ Rp ' : 'Rp ').'</td>';
                        $detail.='<td style="text-align:right;">'.number_format($prDetail->trx_amt,2).'</td>';
                        $detail.='</tr>';
                    }
                    $detail.='<tr><th colspan="3" style="text-align:right;">Total</th><th style="text-align:right;">Rp </th><th style="text-align:right;">'.number_format($t,2).'</th></tr>';
                }
                $content = array('isi'=>$dtPrint,
                    'detail'=>$detail,
                    'entity'=>$dtEntity[0],
                    'project'=>$dtProject[0],
                    'terbilang'=>$terbilang);
                $html = $this->load->view('booking/v_rl_sp', $content, true);
                // $html = $this->load->view('booking/v_rl_sp', $content);
                pdfGen($html, $namafile, "A4", "portrait");
                // var_dump("4");
            } else {
                show_404();
                return;
            }
            // var_dump("4");
        }
        
    }

    public function nup($nup_no=null)
    {
        if(empty($nup_no)){
            show_404();
            return;
        } else {
            // var_dump("2");
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $table = 'v_rl_nup_rpt';
            $criteria = array('nup_no'=>$nup_no);
            //$ord = array('nup_no', 'ASC');
            $dtPrint = $this->m_wsbangun->getData_by_criteria($table, $criteria);
            //var_dump($dtPrint);
            if(!empty($dtPrint))
            {
                $namafile = $nup_no;
                $terbilang = amountinWords($dtPrint[0]->nup_amt);
                $content = array('isi'=>$dtPrint,
                    'terbilang'=>$terbilang);
                $html = $this->load->view('booking/v_rl_rpt_nup', $content, true);
                // $html = $this->load->view('booking/v_rl_sp', $content);
                pdfGen($html, $namafile, "A4", "portrait");
            } else {
                show_404();
                return;
            }
        }
        
    }
}
?>