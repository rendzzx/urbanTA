<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class History extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->auth_check();
        $this->load->model('m_wsbangun');   
    }

    public function ticketOLD()
    {
            // $offset = $this->uri->segment(3);
            // $where = array(
            //     'id_tenant' => $this->session->userdata('Tuser_id')
            // );
            // $pageset = 15;
            // $count_all = $this->m_complain->count_by_criteria($where);
            // // $link_paging = create_paging($this, $this->config, 3, $offset, base_url() . "history/ticket/", $count_all);
            // // $tickets = $this->m_complain->get_all($offset, 15, $where);
            // // $tickets = $this->m_complain->get_all($offset, $this->config->config['per_page'], $where);
            // $link_paging = create_paging($this, $pageset, 3, $offset, base_url() . "history/ticket/", $count_all);
            // $tickets = $this->m_complain->get_all($offset,$pageset,$where);

            // $list_ticket = "";
            // $i = $offset + 1;
            // $category = 'sv_category';
            // foreach ($tickets as $ticket) 
            // {
            //     $list_ticket .= '<tr role="row" class="odd">' . "\n";
            //     $list_ticket .= '<td>' . $i . '</td>' . "\n";
            //     $list_ticket .= '<td>' . $ticket->complain_no . '</td>' . "\n";
            //     $crit = array('category_cd'=>$ticket->category_cd);
            //     $data_category = $this->m_wsbangun->getData_by_criteria($category, $crit);
            //     if(empty($data_category)) {
            //         $list_ticket .= '<td>' . $ticket->category_cd . '</td>' . "\n";
            //     } else {
            //         $list_ticket .= '<td>' . $data_category[0]->descs . '</td>' . "\n";
            //     }
            //     $list_ticket .= '<td>' . $ticket->work_requested . '</td>' . "\n";
            //     $list_ticket .= '<td>' . date("d M Y", strtotime($ticket->reported_date)) . '</td>' . "\n";
            //     $list_ticket .= '<td>' . $ticket->serv_req_by. '</td>' . "\n";
            //     $list_ticket .= '<td>' . $ticket->lot_no. '</td>' . "\n";
            //     $data_status = get_statusIFCA($ticket->status);
            //     $list_ticket .= '<td><span class="label label-'.$data_status["label"].'">'. $data_status["status"]. '</span></td>'."\n";
            //     if($ticket->status=='R') {
            //         $list_ticket .= '<td><a class="btn btn-sm" href="'.base_url().'req_ticket/edit/'.$ticket->id.'"><i class="fa fa-edit"></i> Edit</a></td>'."\n";
            //     } else {
            //         $list_ticket .= '<td></td>'."\n";
            //     }
            //     $list_ticket .= '</tr>' . "\n";
            //     $i++;
            // }

            // $content = array(
            //     'list_ticket' => $list_ticket,
            //     'link_paging' => $link_paging
            // );
            // $this->load_content('history/ticket_history', $content);
    }

    public function overtime()
    {
        // $id_tenant=$this->session->userdata('Tuser_id');
        // $history_search = $this->input->post('search');
        // $offset = $this->uri->segment(3);
        // // $pageset = $this->config->config['per_page'];
        // $pageset = 15;
        // if (!isset($offset))
        // {
        //     $offset = 0;
        // }
        // if ($_POST) {
        //     $where=array(
        //         'id_tenant' =>$id_tenant,
        //         'status' =>$history_search
        //         );
        //     $count_all = $this->m_ot->count_by_criteria($where);
        //     $link_paging = create_paging($this, $this->config, 3, $offset, base_url() . "history/overtime/", $count_all);
        //     $hovertime = $this->m_ot->get_by_criteria($where);
        // } else {
        //     $where=array(
        //         'id_tenant' =>$id_tenant,
        //         );
        //     $count_all = $this->m_ot->count_by_criteria($where);
        //     $link_paging = create_paging($this, $pageset, 3, $offset, base_url() . "history/overtime/", $count_all);
        //     $hovertime = $this->m_ot->get_all($offset,$pageset,$where);
        //     // $hovertime = $this->m_ot->get_all($offset,$this->config->config['per_page'],$where);
        // }
        // $list_overtime = "";
        // $i = $offset + 1;
        // $datenow=date('Y-m-d');
        // $timenow=date('h:i:s');
        // $today=$datenow." ".$timenow;
        // $today = date('Y-m-d H:i:s');
        // // var_dump($today);
        // foreach ($hovertime as $overtime)
        // {
        //     $list_overtime .= '<tr role="row" class="odd">' . "\n";
        //     $list_overtime .= '<td>' . $i . '</td>' . "\n";
        //     $list_overtime .= '<td>' . $overtime->id . '</td>' . "\n";
        //     $list_overtime .= '<td>' . date("d M Y", strtotime($overtime->date_created)) . '</td>' . "\n";
        //     $list_overtime .= '<td>' . $overtime->lot_no . '</td>' . "\n";
        //     // $list_overtime .= '<td>' . $overtime->time_from. ' until ' . $overtime->time_until. '</td>' . "\n";
        //     $list_overtime .= '<td>' . $overtime->start_overtime . '</td>' . "\n";
        //     $list_overtime .= '<td>' . $overtime->end_overtime . '</td>' . "\n";
        //     // $list_overtime .= '<td>' . get_status_overtime($overtime->status) . '</td>' . "\n";
        //     $data_status = get_statusOT($overtime->status);
        //     $list_overtime .= '<td><span class="label label-'.$data_status["label"].'">'. $data_status["status"]. '</span></td>'."\n";
        //     // $list_overtime .= '<td>'.$overtime->status.'</td>'."\n";
        //     if($overtime->start_overtime > $today && $overtime->status!='X') {
        //         $list_overtime .= '<td><button class="btn btn-block btn-warning btn-sm" data-ot="'.$overtime->id.'" onclick="cancelOT('.$overtime->id.')">Cancel</button></td>'."\n";
        //     } else {
        //         $list_overtime .= '<td><button class="btn btn-block btn-warning btn-sm disabled">Cancel</button></td>'."\n";
        //     }
        //     if($overtime->status=='N') {
        //         $list_overtime .= '<td><a class="btn btn-sm" href="'.base_url().'overtime/edit/'.$overtime->id.'"><i class="fa fa-edit"></i> Edit</a></td>'."\n";
        //     } 
        //     // else {
        //     //     $list_overtime .= '<td></td>'."\n";
        //     // }

        //     // if ($overtime->date_created < $datenow ){
        //     //     //di sini untuk matikan tombol saat udh lewat harinya
        //     //     $list_overtime .= '<td>Mati karena lewat tanggal</td>' . "\n";
        //     //     // var_dump('ok');
        //     // } else if($overtime->date_created = $datenow ) {
        //     //     if ($overtime->time_from < $timenow){
        //     //         $list_overtime .= '<td>Mati karena lewat jam</td>' . "\n";
        //     //     } else {
        //     //         $list_overtime .= '<td>Lanjut</td>' . "\n";
        //     //     }
        //     // }

        //     $list_overtime .= '</tr>' . "\n";
        //     $i++;
        // }
        // $content = array(
        //     'list_overtime' => $list_overtime,
        //     'link_paging'=>$link_paging
        // );
        // $this->load_content('history/overtime_history', $content);
    }

    public function ticket()
    {
        $business_no = $this->session->userdata('business_no');
        $offset = (int) $this->uri->segment(3);
        $pageset = 15;
        // $sortby = 'rowid';
        // $order = 'ASC';
        if (!isset($offset)) {
            $offset = 0;
        }
        $table = 'sv_entry_multi';
        $count_all = $this->m_wsbangun->getCount_by_criteria($table);
        $dtTicket = $this->m_wsbangun->getListData($offset, $pageset);
        $link_paging = create_paging($this, $pageset, 3, $offset, base_url() . "history/ticket/", $count_all);
        $list_ticket = "";
        $i = $offset + 1;
        $category = 'sv_category';
        foreach ($dtTicket as $ticket) {
            $list_ticket.='<tr role="row" class="odd">';
            $list_ticket.='<td>'.$i.'</td>';
            $list_ticket.='<td>'.$ticket->complain_no.'</td>';
            $crit = array('category_cd'=>$ticket->category_cd);
            $dtCategory = $this->m_wsbangun->getData_by_criteria($category, $crit);
            if(empty($dtCategory)) 
            {
                $list_ticket.='<td>'.$ticket->category_cd.'</td>';
            } else {
                $list_ticket.='<td>'.$dtCategory[0]->descs.'</td>';
            }
            $list_ticket .= '<td>' . $ticket->work_requested . '</td>' . "\n";
            $list_ticket .= '<td>'.$ticket->reported_date.'</td>';
            // $list_ticket .= '<td>' . date("d M Y", strtotime($ticket->reported_date)) . '</td>' . "\n";
            $list_ticket .= '<td>' . $ticket->serv_req_by. '</td>' . "\n";
            $list_ticket .= '<td>' . $ticket->lot_no. '</td>' . "\n";
            $data_status = get_statusIFCA($ticket->status);
            $list_ticket .= '<td><span class="label label-'.$data_status["label"].'">'. $data_status["status"]. '</span></td>'."\n";
            if($ticket->status=='R') {
                $list_ticket .= '<td><a class="btn btn-sm" href="'.base_url().'req_ticket/edit/'.$ticket->rowid.'"><i class="fa fa-edit"></i> Edit</a></td>'."\n";
            } else {
                $list_ticket .= '<td></td>'."\n";
            }
            $list_ticket .= '</tr>' . "\n";
            $i++;
        }
        $content = array(
            'list_ticket' => $list_ticket,
            'link_paging' => $link_paging
        );
        $this->load_content('history/ticket_history', $content);
    }

    public function billing()
    {
        // echo ucwords($_SESSION["tenant_df"]);
        $offset =(int) $this->uri->segment(3);
        $pageset = 15;
        if (!isset($offset)) {
            $offset = 0;
        }
        $list_billing = '';
        $business_no = $this->session->userdata('business_no');
        $business_no = '1000161';
        // var_dump($business_no);
        if(!empty($_SESSION["tenant_df"])) {
            $tenant_no = $_SESSION["tenant_df"];
            // var_dump("1");
        } else {
            $tenant_no = $this->session->userdata('tenant_df');
            // var_dump('B');
        }
        $tenant_no = '0101';
        // var_dump($tenant_no);
        // $crit = array(
        //     'business_no'=>$business_no,
        //     'tenant_no'=>$tenant_no);
        // $dataTenancy = $this->m_tenancy->get_by_criteria($crit);
        // $i = $offset + 1;
        // if(isset($dataTenancy)) {
        //     $entity = $dataTenancy[0]->entity_cd;
        //     $project = $dataTenancy[0]->project_no;
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

            $dataBilling = $this->m_wsbangun->getAll_soa_by_tenant($entity, $project, $tenant_no, null, $pageset, $offset);
            if(!empty($dataBilling)) {
                foreach ($dataBilling as $billing) {
                    $list_billing .= '<tr role="row" class="odd">';
                    $list_billing .= '<td>'. $i.'</td>';
                    $list_billing .= '<td>'. $billing->doc_no.'</td>';
                    $list_billing .= '<td>'. date("d M Y", strtotime($billing->doc_date)).'</td>';
                    $list_billing .= '<td>'. date("d M Y", strtotime($billing->due_date)).'</td>';
                    $list_billing .= '<td>'. $billing->ar_ldg_desc.'</td>';
                    $list_billing .= '<td>'. date("d M Y", strtotime($billing->start_date)).' - '.date("d M Y", strtotime($billing->end_date)).'</td>';
                    $list_billing .= '<td>'. $billing->currency_cd.'</td>';
                    $list_billing .= '<td align="right">'. number_format($billing->fdoc_amt,2,",",".").'</td>';
                    $list_billing .= '<td align="right">'. number_format($billing->alloc_amt,2,",",".").'</td>';
                    $list_billing .= '<td align="right">'. number_format($billing->fbal_amt,2,",",".").'</td>';
                    $list_billing .= '</tr>';
                    $i++;
                    // $count_all_billing++;
                }
            }

            $dataBilling = $this->m_wsbangun->getAll_soa_by_tenant($entity, $project, $tenant_no);
            $count_all_billing = 0;
            if(!empty($dataBilling)) {
                foreach ($dataBilling as $bill) {
                    $count_all_billing++;
                }
                // var_dump($count_all_billing);
            }
            $link_paging = create_paging($this, $pageset, 3, (int)$offset, base_url() . "history/billing/", $count_all_billing);
        // }
        

        $i = $offset + 1;
        $content = array(
            'list_billing'=>$list_billing,
            'link_paging'=>$link_paging);
        $this->load_content('history/billing_history', $content);
    }
    /*
    public function ticket_old()
    {
            // $baseon = $this->input->post('r1');
            $offset = $this->uri->segment(3);
            // var_dump($baseon);
            // $radio = array("Ticket Closed","Confirm","Work In Progress","Ticket Open","Survey","Ticket Assign");
            // $list_radio = "";
            // for ($j=0; $j<6 ; $j++) { 
            //     if ($j==(int)$baseon) {
            //         $list_radio.='<div class="radio"><input type="radio" name="r1" class="minimal" value="'.$j.'" checked>'.$radio[$j].'</div>'."\n";
            //     } else {
            //         $list_radio.='<div class="radio"><input type="radio" name="r1" class="minimal" value="'.$j.'">'.$radio[$j].'</div>'."\n";
            //     }
            // }
            // if (!isset($offset)) {
            //     $offset = 0;
            // }
            $where = array(
                'id_tenancy' => $this->session->userdata('Tuser_id')
            );
            $count_all = $this->m_complain->count_by_criteria($where);
            $link_paging = create_paging($this, $this->config, 3, $offset, site_url() . "/history/ticket/", $count_all);
            $tickets = $this->m_complain->get_all($offset, $this->config->config['per_page'], $where);
            // $where = array(
            //     'id_requester' => $this->session->userdata('Tuser_id'),
            //     'status'=>$baseon
            // );
            
            // if ($_POST) 
            // {
            //     // $where = array(
            //     //         'id_requester' => $this->session->userdata('Tuser_id'),
            //     //         'status'=>$baseon
            //     //     );
            //     $count_all = $this->m_helpdesk->count_by_criteria($where);
            //     $link_paging = create_paging($this, $this->config, 3, $offset, site_url() . "/history/ticket/", $count_all);
            //     $tickets = $this->m_helpdesk->get_all($offset, $this->config->config['per_page'], $where);
            // } else {
            //     // var_dump('NOT POST');
            //     // var_dump($baseon);
            //     // $where = array(
            //     //         'id_requester' => $this->session->userdata('Tuser_id'),
            //     //         'status'=>3
            //     //     );
            //     $count_all = $this->m_helpdesk->count_by_criteria($where);
            //     $link_paging = create_paging($this, $this->config, 3, $offset, site_url() . "/history/ticket/", $count_all);
            //     $tickets = $this->m_helpdesk->get_all($offset, $this->config->config['per_page'],$where);
            // }


            $list_ticket = "";
            $i = $offset + 1;
            foreach ($tickets as $ticket) 
            {
                // $wherefoto = array('id_helpdesk'=> $ticket->id);
                // $surveydata = $this->m_assignsurvey->get_by_criteria($wherefoto);
                // $tasklistdata = $this->m_tasklist->get_by_criteria($wherefoto);

                $list_ticket .= '<tr role="row" class="odd">' . "\n";
                $list_ticket .= '<td>' . $i . '</td>' . "\n";
                $list_ticket .= '<td>' . $ticket->complain_no . '</td>' . "\n";
                // $list_ticket .= '<td>' . $ticket->documentnumber . '</td>' . "\n";
                $list_ticket .= '<td>' . $ticket->category_cd . '</td>' . "\n";
                // $list_ticket .= '<td>' . $this->helpdesk_category($ticket->category) . '</td>' . "\n";
                $list_ticket .= '<td>' . $ticket->description . '</td>' . "\n";
                // $list_ticket .= '<td>' . date("d-m-Y", strtotime($ticket->ticket_created)) . '</td>' . "\n";
                $list_ticket .= '<td>' . date("d-m-Y", strtotime($ticket->reported_date)) . '</td>' . "\n";
                $list_ticket .= '<td>' . $ticket->serv_req_by. '</td>' . "\n";
                // $list_ticket .= '<td>' . $ticket->subject. '</td>' . "\n";
                $list_ticket .= '<td>' . $ticket->lot_no. '</td>' . "\n";                
                $list_ticket .= '<td>' . $ticket->status. '</td>'."\n";
                // $list_ticket .= '<td class="sorting_1"><a href="'.base_url().'uploads/tenanthelpdesk/'. $ticket->photo.'" target="_blank"><img src="'.base_url().'uploads/tenanthelpdesk/'. $ticket->photo.'" class="user-image" width="40px" height="40px"/ alt="logo"></a></td>' . "\n";
                // if($ticket->status==5)
                // {
                //     $list_ticket .= '<td><a href="' .$this->config->item('base_url').'uploads/tenanthelpdesk/'. $ticket->photo.'" target="_blank"><img src="'.$this->config->item('base_url').'uploads/tenanthelpdesk/'. $ticket->photo.'" class="user-image" width="40px" height="40px"/ alt="logo"></a></td>' . "\n";
                // } else if($ticket->status==4)
                // {
                //     if (!isset($surveydata)||empty($surveydata)||$surveydata[0]->photo==''){
                //         $list_ticket .= '<td class="sorting_1"><a href="'.$this->config->item('base_url').'uploads/tenanthelpdesk/no_image.jpg" target="_blank"><img src="'.$this->config->item('base_url').'uploads/tenanthelpdesk/no_image.jpg" class="user-image" width="40px" height="40px"/ alt="logo"></a></td>' . "\n";
                //     } else {
                //     $hasildatafoto="";
                //     $datafotos=$surveydata[0]->photo;
                //     $listdatafotos=explode(",", $datafotos);
                //     $list_ticket .= '<td>' . "\n";
                //     foreach ($listdatafotos as $listdatafoto) {
                //         $list_ticket .= '<a href="' .$this->config->item('base_url').'uploads/surveyimages/'. $listdatafoto.'" target="_blank"><img src="'.$this->config->item('base_url').'uploads/surveyimages/'. $listdatafoto.'" class="user-image" width="40px" height="40px"/ alt="logo"></a>' . "\n";
                //     }
                //     $list_ticket .= '</td>' . "\n";
                //     }
                // }
                // else if($ticket->status==3)
                // {
                //     $list_ticket .= '<td><a href="' .$this->config->item('base_url').'uploads/tenanthelpdesk/'. $ticket->photo.'" target="_blank"><img src="'.$this->config->item('base_url').'uploads/tenanthelpdesk/'. $ticket->photo.'" class="user-image" width="40px" height="40px"/ alt="logo"></a></td>' . "\n";
                // }
                // else if($ticket->status==2)
                // {
                //     if (!isset($surveydata)||empty($surveydata)||$surveydata[0]->photo==''){
                //         $list_ticket .= '<td class="sorting_1"><a href="'.$this->config->item('base_url').'uploads/tenanthelpdesk/no_image.jpg" target="_blank"><img src="'.$this->config->item('base_url').'uploads/tenanthelpdesk/no_image.jpg" class="user-image" width="40px" height="40px"/ alt="logo"></a></td>' . "\n";
                //     } else {
                //     $hasildatafoto="";
                //     $datafotos=$surveydata[0]->photo;
                //     $listdatafotos=explode(",", $datafotos);
                //     $list_ticket .= '<td>' . "\n";
                //     foreach ($listdatafotos as $listdatafoto) {
                //         $list_ticket .= '<a href="' .$this->config->item('base_url').'uploads/surveyimages/'. $listdatafoto.'" target="_blank"><img src="'.$this->config->item('base_url').'uploads/surveyimages/'. $listdatafoto.'" class="user-image" width="40px" height="40px"/ alt="logo"></a>' . "\n";
                //     }
                //     $list_ticket .= '</td>' . "\n";
                //     }
                // }else if($ticket->status==1)
                // {
                //     if (!isset($tasklistdata)||empty($tasklistdata)||$tasklistdata[0]->photo_wip==''){
                //         $list_ticket .= '<td class="sorting_1"><a href="'.$this->config->item('base_url').'uploads/tenanthelpdesk/no_image.jpg" target="_blank"><img src="'.$this->config->item('base_url').'uploads/tenanthelpdesk/no_image.jpg" class="user-image" width="40px" height="40px"/ alt="logo"></a></td>' . "\n";
                //     } else {
                //     $hasildatafoto="";
                //     $datafotos=$tasklistdata[0]->photo_wip;
                //     $listdatafotos=explode(",", $datafotos);
                //     $list_ticket .= '<td>' . "\n";
                //     foreach ($listdatafotos as $listdatafoto) {
                //         $list_ticket .= '<a href="' .$this->config->item('base_url').'uploads/wipimages/'. $listdatafoto.'" target="_blank"><img src="'.$this->config->item('base_url').'uploads/wipimages/'. $listdatafoto.'" class="user-image" width="40px" height="40px"/ alt="logo"></a>' . "\n";
                //     }
                //     $list_ticket .= '</td>' . "\n";
                //     }
                // }
                // else if($ticket->status==0)
                // {
                //     // var_dump($tasklistdata);
                //     // if ($tasklistdata[0]->photo_wip==null){
                //     if (!isset($tasklistdata)||empty($tasklistdata)||$tasklistdata[0]->photo_wip==''){
                //         $list_ticket .= '<td class="sorting_1"><a href="'.$this->config->item('base_url').'uploads/tenanthelpdesk/no_image.jpg" target="_blank"><img src="'.$this->config->item('base_url').'uploads/tenanthelpdesk/no_image.jpg" class="user-image" width="40px" height="40px"/ alt="logo"></a></td>' . "\n";
                //     } else {
                //         $hasildatafoto="";
                //         $datafotos=$tasklistdata[0]->photo_wip;
                //         $listdatafotos=explode(",", $datafotos);
                //         $list_ticket .= '<td>' . "\n";
                //         foreach ($listdatafotos as $listdatafoto) {
                //             $list_ticket .= '<a href="' .$this->config->item('base_url').'uploads/wipimages/'. $listdatafoto.'" target="_blank"><img src="'.$this->config->item('base_url').'uploads/wipimages/'. $listdatafoto.'" class="user-image" width="40px" height="40px"/ alt="logo"></a>' . "\n";
                //         }
                //         $list_ticket .= '</td>' . "\n";
                //     }
                // }
                
                // $list_ticket .= '<td><span class="label label-'.get_status($ticket->status).'">' .get_status_label($ticket->status)."</span></td>"."\n";
                
                // $list_ticket .= '<td><a href='.site_url().'/ticket/edit_ticket/' . $ticket->id. '>Edit</a></td>' . "\n";
                // $list_ticket .= '<td><a href='.site_url().'/ticket/del_ticket/' . $ticket->id. '>Delete</a></td>' . "\n";
                $list_ticket .= '</tr>' . "\n";
                $i++;
            }

            $content = array(
                // 'list_radio' => $list_radio,
                'list_ticket' => $list_ticket,
                'link_paging' => $link_paging
            );
            $this->load_content('history/ticket_history', $content);
    }
    */
}
