<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ticket extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();

		$this->load->model('m_complain');
		$this->load->model('m_wsbangun');
    }

    public function open()
    {
    	$offset = $this->uri->segment(3);
        if(!isset($offset)) { 
            $offset = 0;
        }
        $list_helpdesk = '';
        $status = 'R';
        $dataStaff = $this->m_staff->get_by_id($this->session->userdata("Tsuser_id"));
        if(!empty($dataStaff)){
        	$user_staff = $this->session->userdata("Tsuname");
        	$lvl = $dataStaff->level;
            if($lvl==1){
                // var_dump("level 1");
                $data_complain = $this->m_wsbangun->get_ticket_by_spv($user_staff, $status);
            } else {
            	// var_dump("BUKAN level 1");
            	$data_complain = $this->m_wsbangun->get_ticket_by_usr($user_staff, $status);
            }

            if(!empty($data_complain)) {
                $i = $offset + 1;
                foreach ($data_complain as $complain) {
                    $list_helpdesk.= '<tr role="row" class="odd">';
                    $list_helpdesk.= '<td>'.$i.'</td>';
                    $list_helpdesk.= '<td>'.$complain->complain_no.'</td>';
                    $list_helpdesk.= '<td>'.$complain->descs.'</td>';
                    $list_helpdesk.= '<td>'.$complain->work_requested.'</td>';
                    $list_helpdesk.= '<td>'.date('d M Y', strtotime($complain->reported_date)). '</td>';
                    $list_helpdesk.= '<td>'.$complain->serv_req_by. '</td>';
                    $list_helpdesk.= '<td>'.$complain->lot_no. '</td>';
                    $data_status = get_statusIFCA($complain->status);
                    $list_helpdesk.= '<td><span class="label label-'.$data_status["label"].'">'. $data_status["status"]. '</span></td>';
                    $list_helpdesk.= '<td><a href="'.base_url().'ticket/assign/'.$complain->complain_no.'"><span class="label label-success">Assign</span></a></td>';
                    // $list_helpdesk.= '<td><button class="btn btn-block btn-warning btn-sm" data-ot="'.$complain->complain_no.'" onclick="asgn('.$complain->complain_no.')">Assign</button></td>'
                    $list_helpdesk.= '</tr>';
                    $i++;
                }
            }
                
            // var_dump($list_helpdesk);
            $content = array(
                'list_helpdesk'=>$list_helpdesk
            );
            $this->load_content('ticket/open', $content);
        }
    }

    public function process()
    {
        $offset = $this->uri->segment(3);
        if(!isset($offset)) { 
            $offset = 0;
        }
        $list_helpdesk = '';
        $dataStaff = $this->m_staff->get_by_id($this->session->userdata("Tsuser_id"));
        if(!empty($dataStaff)){
            $user_staff = $this->session->userdata("Tsuname");
            $data_complain = $this->m_wsbangun->get_ticket_process($user_staff);
            // var_dump($data_complain);
            if(!empty($data_complain)) {
                $i = $offset + 1;
                foreach ($data_complain as $complain) {
                    $list_helpdesk.= '<tr role="row" class="odd">';
                    $list_helpdesk.= '<td>'.$i.'</td>';
                    $list_helpdesk.= '<td>'.$complain->complain_no.'</td>';
                    $list_helpdesk.= '<td>'.$complain->report_no.'</td>';
                    $list_helpdesk.= '<td>'.$complain->descs.'</td>';
                    $list_helpdesk.= '<td>'.$complain->work_requested.'</td>';
                    $list_helpdesk.= '<td>'.date('d M Y', strtotime($complain->reported_date)). '</td>';
                    $list_helpdesk.= '<td>'.$complain->serv_req_by. '</td>';
                    $list_helpdesk.= '<td>'.$complain->lot_no. '</td>';
                    $data_status = get_statusIFCA($complain->status);
                    $list_helpdesk.= '<td><span class="label label-'.$data_status["label"].'">'. $data_status["status"]. '</span></td>';
                    $list_helpdesk.= '<td><a href="'.base_url().'ticket/update/'.$complain->complain_no.'"><span class="label label-success">Update</span></a></td>';
                    $list_helpdesk.= '</tr>';
                    $i++;
                }
            }

            $content = array(
                'list_helpdesk'=>$list_helpdesk
            );
            $this->load_content('ticket/process', $content);
        }
    }

    public function confirm()
    {
        $offset = $this->uri->segment(3);
        if(!isset($offset)) { 
            $offset = 0;
        }
        $list_helpdesk = '';
        $status = 'F';
        $dataStaff = $this->m_staff->get_by_id($this->session->userdata("Tsuser_id"));
        if(!empty($dataStaff)){
            $user_staff = $this->session->userdata("Tsuname");
            $data_complain = $this->m_wsbangun->get_ticket_by_spv($user_staff, $status);
            // var_dump($data_complain);
            if(!empty($data_complain)) {
                $i = $offset + 1;
                foreach ($data_complain as $complain) {
                    $list_helpdesk.= '<tr role="row" class="odd">';
                    $list_helpdesk.= '<td>'.$i.'</td>';
                    $list_helpdesk.= '<td>'.$complain->complain_no.'</td>';
                    $list_helpdesk.= '<td>'.$complain->report_no.'</td>';
                    $list_helpdesk.= '<td>'.$complain->descs.'</td>';
                    $list_helpdesk.= '<td>'.$complain->work_requested.'</td>';
                    $list_helpdesk.= '<td>'.date('d M Y', strtotime($complain->reported_date)). '</td>';
                    $list_helpdesk.= '<td>'.$complain->serv_req_by. '</td>';
                    $list_helpdesk.= '<td>'.$complain->lot_no. '</td>';
                    $data_status = get_statusIFCA($complain->status);
                    $list_helpdesk.= '<td><span class="label label-'.$data_status["label"].'">'. $data_status["status"]. '</span></td>';
                    $list_helpdesk.= '<td><a href="'.base_url().'ticket/confirmed/'.$complain->complain_no.'"><span class="label label-success">Update</span></a></td>';
                    $list_helpdesk.= '</tr>';
                    $i++;
                }
            }

            $content = array(
                'list_helpdesk'=>$list_helpdesk
            );
            $this->load_content('ticket/process', $content);
        }
    }

    public function assign($selected_id="", $data=null)
    {
        $offset = $this->uri->segment(3);
        if(!isset($offset)) { 
            $offset = 0;
        }
        if($selected_id && $selected_id!="") {
            $dataStaff = $this->m_staff->get_by_id($this->session->userdata("Tsuser_id"));
            if(!empty($dataStaff)) {
                $user_staff = $this->session->userdata("Tsuname");
                $table = 'tenant_ticket';
                $crit = array('complain_no'=>$selected_id);
                $data_complain = $this->m_wsbangun->getData_by_criteria($table, $crit);
                // var_dump($data_complain);
                if(!empty($data_complain)) {
                    // var_dump("expression");
                    $table = 'sv_category';
                    $crit = array('category_cd'=>$data_complain[0]->category_cd);
                    $category = $this->m_wsbangun->getData_by_criteria($table, $crit);
                    $ttype = '';
                    if($data_complain[0]->complain_type=='R') {
                        $ttype = 'Request';
                    } else {
                        $ttype = 'Complain';
                    }
                    $table = 'sv_user_assign';
                    $crit = array('user_id'=>$user_staff);
                    $data_assign = $this->m_wsbangun->getData_by_criteria($table, $crit);
                    if(!empty($data_assign)) {
                        foreach ($data_assign as $userassign) {
                            $combo_assign[] = '<option value="'.$userassign->staff_id.'" >'.$userassign->staff_id.'</option>';
                        }
                        $combo_assign = implode("",$combo_assign);
                    }
                    // var_dump($category);
                } else {
                    var_dump("No Data complain");
                }
                $content = array(
                    'complain'=>$data_complain[0],
                    'tickettp'=>$ttype,
                    'category'=>$category[0],
                    'combo_staff'=>$combo_assign,
                    'data'=>$data);
                $this->load_content('ticket/assign', $content);
            } else {
                var_dump("NO Staff ID");
            }
        } else {
            // var_dump("No Selected ID");
            $dataStaff = $this->m_staff->get_by_id($this->session->userdata("Tsuser_id"));
            if(!empty($dataStaff)) {
                $list_helpdesk='';
                $status = 'A';
                $user_staff = $this->session->userdata("Tsuname");
                // $data_complain = $this->m_wsbangun->get_ticket_by_usr($user_staff, $status);
                $data_complain = $this->m_wsbangun->get_ticket_by_usr($user_staff);
                // $data_complain = $this->m_wsbangun->get_ticket_by_usr('BUDI', $status);
                // var_dump($data_complain);
                if(!empty($data_complain)) {
                    $i = $offset + 1;
                    foreach ($data_complain as $complain) {
                        $list_helpdesk.= '<tr role="row" class="odd">';
                        $list_helpdesk.= '<td>'.$i.'</td>';
                        $list_helpdesk.= '<td>'.$complain->report_no.'</td>';
                        $list_helpdesk.= '<td>'.$complain->complain_no.'</td>';
                        $list_helpdesk.= '<td>'.$complain->descs.'</td>';
                        // $list_helpdesk.= '<td>'.$complain->work_requested.'</td>';
                        $list_helpdesk.= '<td>'.date('d M Y', strtotime($complain->reported_date)). '</td>';
                        $list_helpdesk.= '<td>'.$complain->serv_req_by. '</td>';
                        $list_helpdesk.= '<td>'.$complain->lot_no. '</td>';
                        $data_status = get_statusIFCA($complain->status);
                        $list_helpdesk.= '<td><span class="label label-'.$data_status["label"].'">'. $data_status["status"]. '</span></td>';
                        // if($complain->status=='A') {
                        //     // $list_helpdesk.= '<td style="width:40px;"><a href="'.base_url().'ticket/survey/'.$complain->complain_no.'"><span class="label label-success">Survey</span></a></td>';
                        //     // $list_helpdesk.= '<td style="width:30px;"><span class="label label-primary">Item</span></td>';
                        //     // $list_helpdesk.= '<td style="width:30px;"><span class="label label-primary">Service</span></td>';
                        //     // $list_helpdesk.= '<td><a href="'.base_url().'ticket/survey/'.$complain->complain_no.'"><span class="label label-success">Survey</span></a><br><span class="label label-primary">Item</span><br><span class="label label-primary">Serv</span></td>';
                        //     $list_helpdesk.= '<td><a href="'.base_url().'ticket/survey/'.$complain->complain_no.'"><span class="label label-success">Status</span></a><span class="label label-default"> Item</span><span class="label label-default">Service</span></td>';
                        //     // $list_helpdesk.='<td>-</td><td>-</td>';
                        // } else {
                        //     $list_helpdesk.= '<td><span class="label label-default">Status</span><a href="'.base_url().'ticket/items/'.$complain->complain_no.'"><span class="label label-primary"> Item</span></a><a href="'.base_url().'ticket/service/'.$complain->complain_no.'"><span class="label label-primary">Service</span></a></td>';
                        //     // $list_helpdesk.='<td>-</td><td>-</td>';
                        // }
                        switch ($complain->status) {
                            case 'A':
                                $list_helpdesk.= '<td><a href="'.base_url().'ticket/survey/'.$complain->complain_no.'"><span class="label label-success">Status</span></a><span class="label label-default"> Item</span><span class="label label-default">Service</span></td>';
                                break;
                            case 'S':
                                $list_helpdesk.= '<td><a href="'.base_url().'ticket/proc/'.$complain->complain_no.'"><span class="label label-success">Status</span></a><a href="'.base_url().'ticket/items/'.$complain->complain_no.'"><span class="label label-primary"> Item</span></a><a href="'.base_url().'ticket/service/'.$complain->complain_no.'"><span class="label label-primary">Service</span></a></td>';
                                break;
                            case 'P':
                                $list_helpdesk.= '<td><a href="'.base_url().'ticket/update/'.$complain->complain_no.'"><span class="label label-success">Status</span></a><span class="label label-default"> Item</span><span class="label label-default">Service</span></td>';
                                break;
                            
                            default:
                                # code...
                                break;
                        }
                        
                        // $list_helpdesk.= '<td><button class="btn btn-block btn-warning btn-sm" data-ot="'.$complain->complain_no.'" onclick="asgn('.$complain->complain_no.')">Assign</button></td>'
                        $list_helpdesk.= '</tr>';
                        $i++;
                    }
                }
                $content = array(
                    'list_helpdesk'=>$list_helpdesk
                );
                $this->load_content('ticket/assigned', $content);
            }
        }
    }

    public function confirmed($selected_id='', $data=null)
    {
        if($selected_id && $selected_id!='') {
            $user_staff = $this->session->userdata("Tsuname");
            $table = 'tenant_postticket';
            $crit = array('complain_no'=>$selected_id);
            $data_complain = $this->m_wsbangun->getData_by_criteria($table, $crit);
            if(!empty($data_complain)) {
                $ticket_stat = array("F"=>"Confirm",
                    "M"=>"Modify",
                    "C"=>"Close");
                foreach ($ticket_stat as $key => $valuestat) {
                    if($key==$data_complain[0]->status) {
                        $select = ' Selected="1"';
                    } else {
                        $select = '';
                    }
                    $combo_stat[] = '<option value="'.$key.'" '.$select.'>'.$valuestat.'</option>';
                }
                $combo_stat = implode("",$combo_stat);
            }
            $content = array(
                'complain'=>$data_complain[0],
                'combo_stat'=>$combo_stat,
                'data'=>$data);
            $this->load_content('ticket/confirmed', $content);
        }
    }

    public function service($selected_id='', $data=null)
    {
        if($selected_id && $selected_id!='') {
            $table = 'tenant_postticket';
            $crit1 = array('complain_no'=>$selected_id);
            $data_complain = $this->m_wsbangun->getData_by_criteria($table, $crit1);
            if(!empty($data_complain)) {
                $table = 'sv_master';
                $data_serv = $this->m_wsbangun->getData($table);
                if(!empty($data_serv)) {
                    $combo_serv[] = '<option>-- Choose --</option>';
                    foreach ($data_serv as $serv) {
                        $combo_serv[] = '<option value="'.$serv->service_cd. '" >'.$serv->descs.'</option>';
                    }
                    $combo_serv = implode("", $combo_serv);
                }

                $table = 'cf_tax_sch_hd';
                $datatax_hd = $this->m_wsbangun->getData($table);
                // var_dump($datatax_hd);
                if(!empty($datatax_hd)) {
                    $combo_tax[] = '<option data-level="">-- Choose --</option>';
                    foreach ($datatax_hd as $taxhd) {
                        $table = 'cf_tax_sch_dt';
                        $crit = array('tax_cd'=>'VATO', 'scheme_cd'=>$taxhd->scheme_cd);
                        $taxdt = $this->m_wsbangun->getData_by_criteria($table,$crit);
                        if(!empty($taxdt)) {
                            $combo_tax[] = '<option data-rate="'.$taxdt[0]->tax_rate.'" value="'.$taxhd->scheme_cd.'" >'.$taxhd->descs.'</option>';
                        } else {
                            $combo_tax[] = '<option date-rate="0" value="'.$taxhd->scheme_cd.'" >'.$taxhd->descs.'</option>';
                        }
                        
                    }
                    $combo_tax = implode("",$combo_tax);
                }
                // var_dump($data_complain[0]);
                $content = array('combo_serv'=>$combo_serv,
                    'combo_tax'=>$combo_tax,
                    'data'=>$data,
                    'complain'=>$data_complain[0],
                    'duration'=>1);
                $this->load_content('ticket/service', $content);
            }
        }
    }

    public function items($selected_id='', $data=null)
    {
        if($selected_id && $selected_id!='') {
            $table = 'tenant_postticket';
            $crit1 = array('complain_no'=>$selected_id);
            $data_complain = $this->m_wsbangun->getData_by_criteria($table, $crit1);
            if(!empty($data_complain)) {
                // $entity = $data_complain->entity_cd;
                // $project = $data_complain->project_no;
                $table = 'sv_charge';
                // $data_item = $this->m_wsbangun->getData_by_criteria();
                $data_item = $this->m_wsbangun->getData($table);
                if(!empty($data_item)) {
                    $combo_item[] = '<option>-- Choose --</option>';
                    foreach ($data_item as $items) {
                        $combo_item[] = '<option value="'.$items->item_cd.'" >'.$items->descs.'</option>';
                    }
                    $combo_item = implode("",$combo_item);
                }

                $table = 'cf_tax_sch_hd';
                $datatax_hd = $this->m_wsbangun->getData($table);
                // var_dump($datatax_hd);
                if(!empty($datatax_hd)) {
                    $combo_tax[] = '<option data-level="">-- Choose --</option>';
                    foreach ($datatax_hd as $taxhd) {
                        $table = 'cf_tax_sch_dt';
                        $crit = array('tax_cd'=>'VATO', 'scheme_cd'=>$taxhd->scheme_cd);
                        $taxdt = $this->m_wsbangun->getData_by_criteria($table,$crit);
                        if(!empty($taxdt)) {
                            $combo_tax[] = '<option data-rate="'.$taxdt[0]->tax_rate.'" value="'.$taxhd->scheme_cd.'" >'.$taxhd->descs.'</option>';
                        } else {
                            $combo_tax[] = '<option date-rate="0" value="'.$taxhd->scheme_cd.'" >'.$taxhd->descs.'</option>';
                        }
                        
                    }
                    $combo_tax = implode("",$combo_tax);
                }
                // var_dump($data_complain[0])
                $content = array('combo_item' =>$combo_item,
                    'combo_tax'=>$combo_tax,
                    'data'=>$data,
                    'unitprice'=>0,
                    'taxamt'=>0,
                    'totalamt'=>0,
                    'complain'=>$data_complain[0]);
                $this->load_content('ticket/item', $content);
            }
        }
    }

    public function get_item($selected_id="")
    {
        if($_POST) {
            $complain_no = $this->input->post('complain_no', TRUE);
            $table = 'sv_charge';
            $crit1 = array('item_cd'=>$complain_no);
            $data_item = $this->m_wsbangun->getData_by_criteria($table, $crit1);
            // var_dump($data_item);
            // var_dump($crit1);
            echo json_encode($data_item);
            // echo $data_item[0];
        }
        // if($selected_id && $selected_id!='') {
        //     $table = 'sv_charge';
        //     $crit1 = array('item_cd'=>$selected_id);
        //     $data_item = $this->m_wsbangun->getData_by_criteria($table, $crit1);
        //     echo json_encode($data_item);
        //     // if(!empty($data_item)) {
        //     //     echo json_encode($data_item);
        //     // }
        // }
    }

    public function get_service($selected_id="")
    {
        if($_POST) {
            $complain_no = $this->input->post('complain_no', TRUE);
            $table = 'sv_master';
            $crit1 = array('service_cd'=>$complain_no);
            $data_serv = $this->m_wsbangun->getData_by_criteria($table, $crit1);

            echo json_encode($data_serv);
        }
    }

    public function get_combo_tax($selected_id="")
    {
        if($selected_id && $selected_id!='') {
            $table = 'cf_tax_sch_hd';
            $crit = array('scheme_cd' =>$selected_id);
            $data_tax = $this->m_wsbangun->getData_by_criteria($table,$crit);
            if(!empty($data_tax)) {
                $sel = '';
                foreach ($data_tax as $taxs) {
                    if($selected_id==$taxs->scheme_cd) {
                        $sel = "selected='1'";
                    } else {
                        $sel = '';
                    }
                    $table = 'cf_tax_sch_dt';
                    $crit2 = array('tax_cd'=>'VATO',
                        'scheme_cd'=>$selected_id);
                    $taxdt = $this->m_wsbangun->getData_by_criteria($crit2);

                    $combo_tax[] = '<option data-rate="'.$taxdt[0]->tax_rate.'"" value="'.$taxs->scheme_cd.'" '.$sel.'>'.$taxs->descs.'</option>';
                }
                $combo_tax = implode("",$combo_tax);
                echo $combo_tax;
            }
        }
    }

    public function survey($selected_id='', $data=null)
    {
        if($selected_id && $selected_id!="") {
            $dataStaff = $this->m_staff->get_by_id($this->session->userdata("Tsuser_id"));
            if(!empty($dataStaff)) {
                $user_staff = $this->session->userdata("Tsuname");
                $table = 'tenant_postticket';
                $crit = array('complain_no'=>$selected_id);
                $data_complain = $this->m_wsbangun->getData_by_criteria($table, $crit);
                // var_dump($data_complain);
                if(!empty($data_complain)) {
                    // $table = 'sv_category';
                    // $crit = array('category_cd'=>$data_complain[0]->category_cd);
                    // $category = $this->m_wsbangun->getData_by_criteria($table, $crit);
                    // $ttype = '';
                    // if($data_complain[0]->complain_type=='R') {
                    //     $ttype = 'Request';
                    // } else {
                    //     $ttype = 'Complain';
                    // }
                    $ticket_stat = array("A"=>"Assign",
                        "S"=>"Survey");
                    foreach ($ticket_stat as $key => $valuestat) {
                        if($key==$data_complain[0]->status) {
                            $select = ' Selected="1"';
                        } else {
                            $select = '';
                        }
                        $combo_stat[] = '<option value="'.$key.'" '.$select.'>'.$valuestat.'</option>';
                    }
                    $combo_stat = implode("",$combo_stat);
                }
                $content = array(
                    'complain'=>$data_complain[0],
                    // 'tickettp'=>$ttype,
                    // 'category'=>$category[0],
                    'combo_stat'=>$combo_stat,
                    'data'=>$data);
                $this->load_content('ticket/survey', $content);
            }
        }
    }

    public function proc($selected_id='', $data=null)
    {
        if($selected_id && $selected_id!="") {
            $dataStaff = $this->m_staff->get_by_id($this->session->userdata("Tsuser_id"));
            if(!empty($dataStaff)) {
                $user_staff = $this->session->userdata("Tsuname");
                $table = 'tenant_postticket';
                $crit = array('complain_no'=>$selected_id);
                $data_complain = $this->m_wsbangun->getData_by_criteria($table, $crit);
                // var_dump($data_complain);
                if(!empty($data_complain)) {
                    $ticket_stat = array("S"=>"Survey",
                        "P"=>"Process",
                        "F"=>"Confirm");
                    foreach ($ticket_stat as $key => $valuestat) {
                        if($key==$data_complain[0]->status) {
                            $select = ' Selected="1"';
                        } else {
                            $select = '';
                        }
                        $combo_stat[] = '<option value="'.$key.'" '.$select.'>'.$valuestat.'</option>';
                    }
                    $combo_stat = implode("",$combo_stat);

                    $data_item = $this->m_wsbangun->get_item_process($data_complain[0]->report_no);
                    $data_serv = $this->m_wsbangun->get_serv_process($data_complain[0]->report_no);
                    $i = 1;
                    $list_needed = '';
                    foreach ($data_item as $items) {
                        $list_needed.= '<tr role="row" class="odd">';
                        $list_needed.= '<td>'.$i.'</td>';
                        $list_needed.= '<td>'.$items->descs.'</td>';
                        $list_needed.= '<td>'.intval($items->qty).'</td>';
                        $list_needed.= '<td>'.$items->currency_cd.'</td>';
                        $list_needed.= '<td>'.$items->total_amt.'</td>';
                        $list_needed.= '</tr>';
                        $i++;
                    }
                    foreach ($data_serv as $serv) {
                        $list_needed.= '<tr role="row" class="odd">';
                        $list_needed.= '<td>'.$i.'</td>';
                        $list_needed.= '<td>'.$serv->descs.'</td>';
                        $list_needed.= '<td>1</td>';
                        $list_needed.= '<td>'.$serv->currency_cd.'</td>';
                        $list_needed.= '<td>'.$serv->total_amt.'</td>';
                        $list_needed.= '</tr>';
                        $i++;
                    }

                }

                $content = array(
                    'complain'=>$data_complain[0],
                    'combo_stat'=>$combo_stat,
                    'data'=>$data,
                    'list_needed'=>$list_needed,
                    'items'=>$data_item,
                    'serv'=>$data_serv);
                $this->load_content('ticket/wip', $content);
            }
        }
    }

    public function update($selected_id='', $data=null)
    {
        if($selected_id && $selected_id!="") {
            $dataStaff = $this->m_staff->get_by_id($this->session->userdata("Tsuser_id"));
            if(!empty($dataStaff)) {
                $user_staff = $this->session->userdata("Tsuname");
                $table = 'tenant_ticket';
                $crit = array('complain_no'=>$selected_id);
                $data_complain = $this->m_wsbangun->getData_by_criteria($table, $crit);
                if(!empty($data_complain)) {
                    $table = 'sv_category';
                    $crit = array('category_cd'=>$data_complain[0]->category_cd);
                    $category = $this->m_wsbangun->getData_by_criteria($table, $crit);
                    $ttype = '';
                    if($data_complain[0]->complain_type=='R') {
                        $ttype = 'Request';
                    } else {
                        $ttype = 'Complain';
                    }
                    $ticket_stat = array("A"=>"Assign",
                        "S"=>"Survey",
                        "P"=>"Process",
                        "M"=>"Modify",
                        "F"=>"Confirm");
                    foreach ($ticket_stat as $key => $valuestat) {
                        if($key==$data_complain[0]->status) {
                            $select = ' Selected="1"';
                        } else {
                            $select = '';
                        }
                        $combo_stat[] = '<option value="'.$key.'" '.$select.'>'.$valuestat.'</option>';
                    }
                    $combo_stat = implode("",$combo_stat);
                    
                }
                $content = array(
                    'complain'=>$data_complain[0],
                    'tickettp'=>$ttype,
                    'category'=>$category[0],
                    'combo_stat'=>$combo_stat,
                    'data'=>$data);
                $this->load_content('ticket/update', $content);
            }
        }
    }

    public function saveProc()
    {
        if($_POST)
        {
            $complain_no = $this->input->post('ticket_num',TRUE);
            $report_no = $this->input->post('work_num',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $project = $this->input->post('project', TRUE);
            $actiontaken = $this->input->post('actiontaken', TRUE);
            $cmplt_date = $this->input->post('cmplt_date', TRUE);
            $status = $this->input->post('status',TRUE);
            $today = date('d-m-Y H:i:s');
            $user = $this->session->userdata('Tsuname');

            $this->form_validation->set_rules('actiontaken', 'Action Taken', 'required');
            $this->form_validation->set_rules('cmplt_date', 'Completed Date', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                $data['error'] = validation_errors();
                $this->proc($complain_no,$data);
                return;
            } else {
                $table = 'tenant_ticket';
                $crit = array('complain_no'=>$complain_no);
                $data = array('status'=>$status,
                    'audit_user'=>$user,
                    'audit_date'=>$today);
                $this->m_wsbangun->updateData($table,$data,$crit);
                $table = 'sv_entry_hd';
                $crit1 = array('report_no'=>$report_no);
                $data1 = array('completion_date'=>date('d-m-Y', strtotime($cmplt_date)),
                    'action_taken'=>$actiontaken,
                    'status'=>$status,
                    'audit_user'=>$user,
                    'audit_date'=>$today);
                $this->m_wsbangun->updateData($table,$data1,$crit1);

                $data_complain = $this->m_wsbangun->getData_by_criteria($table,$crit1);
                $ticket = $data_complain[0];
                $table = 'sv_report_action';
                $crit2 = array('report_no'=>$ticket->report_no);
                $cnt = $this->m_wsbangun->getCount_by_criteria($table,$crit2);

                $data2 = array('entity_cd'=>$ticket->entity_cd,
                    'project_no'=>$ticket->project_no,
                    'debtor_acct'=>$ticket->debtor_acct,
                    'report_no'=>$ticket->report_no,
                    'line_no'=>1,
                    'action_date'=>date('d-m-Y', strtotime($cmplt_date)),
                    'action_taken'=>$actiontaken,
                    'action_by'=>$user,
                    'audit_user'=>$user,
                    'audit_date'=>$today);
                if($cnt>0) {
                    $this->m_wsbangun->updateData($table,$data2,$crit2);
                } else {
                    $this->m_wsbangun->insertData($table,$data2);
                }
                
            }
            redirect("ticket/assign");
        }
    }

    public function saveSurv()
    {
        if($_POST) 
        {
            $complain_no = $this->input->post('ticket_num',TRUE);
            $report_no = $this->input->post('work_num',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $project = $this->input->post('project', TRUE);
            $problem_cause = $this->input->post('problem_cause', TRUE);
            $remarks = $this->input->post('remarks', TRUE);
            $est_date = $this->input->post('est_date', TRUE);
            $today = date('d-m-Y H:i:s');

            $status = 'S';
            $user = $this->session->userdata('Tsuname');

            $this->form_validation->set_rules('problem_cause', 'Problem cause', 'required');
            $this->form_validation->set_rules('remarks', 'Remarks', 'required');

            if ($this->form_validation->run() == FALSE) 
            {
                $data['error'] = validation_errors();
                $this->survey($complain_no,$data);
                return;
            } else {
                $data1 = array('problem_cause'=>$problem_cause,
                    'remarks'=>$remarks,
                    'status'=>$status,
                    'est_completion_date'=>date('d-m-Y', strtotime($est_date)),
                    'survey_date'=>$today,
                    'response_time'=>$today,
                    'audit_user'=>$user,
                    'audit_date'=>$today);
                $crit1 = array('report_no'=>$report_no);
                $table = 'sv_entry_hd';
                $this->m_wsbangun->updateData($table, $data1, $crit1);
                $data2 = array('status'=>$status);
                $table = 'tenant_ticket';
                $this->m_wsbangun->updateData($table, $data2, $crit1);
                redirect("ticket/assign");
            }
        }
    }

    public function saveCnf()
    {
        if($_POST)
        {
            $complain_no = $this->input->post('ticket_num',TRUE);
            $report_no = $this->input->post('work_num',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $project = $this->input->post('project', TRUE);
            $feedback = $this->input->post('feedback', TRUE);
            $status = $this->input->post('status',TRUE);
            $today = date('d-m-Y H:i:s');
            $user = $this->session->userdata('Tsuname');

            $this->form_validation->set_rules('feedback', 'Feedback', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                $data['error'] = validation_errors();
                $this->confirmed($complain_no,$data);
                return;
            } else {
                $data1 = array('feed_back'=>'OK',
                    'status'=>$status,
                    'audit_user'=>$user,
                    'audit_date'=>$today);
                $crit1 = array('report_no'=>$report_no);
                $table = 'sv_entry_hd';
                $this->m_wsbangun->updateData($table, $data1, $crit1);

                $data2 = array('status'=>$status);
                $table = 'tenant_ticket';
                $this->m_wsbangun->updateData($table, $data2, $crit1);
                redirect("dash");
            }
        }
    }

    public function save()
    {
        if($_POST) 
        {
            $complain_no = $this->input->post('ticket_num',TRUE);
            $assignto = $this->input->post('assignto',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $project = $this->input->post('project', TRUE);
            $user = $this->session->userdata('Tsuname');
            // var_dump($assignto);
            $this->form_validation->set_rules('assignto', 'Assign To', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                $data['error'] = validation_errors();
                $this->assign($complain_no,$data);
                return;
            } else {
                var_dump("BEGIN SAVE");
                $data1 = array('status'=>'A',
                    'assign_to'=>$assignto
                    );
                $crit1 = array('complain_no'=>$complain_no,
                    'entity_cd'=>$entity);
                $table = 'sv_entry_multi_dt';
                $this->m_wsbangun->updateData($table, $data1, $crit1);
                var_dump("11");
                $table = 'sv_entry_multi';
                $this->m_wsbangun->updateData($table, $data1, $crit1);
                var_dump("22");
                $this->m_wsbangun->set_postAssignment($entity, $project, $complain_no, $user);
                var_dump("33");
                $table = 'tenant_ticket';
                $data_entry = $this->m_wsbangun->getData_by_criteria($table,$crit1);
                $report_no = $data_entry[0]->report_no;
                $data2 = array('report_no'=>$report_no,
                    'status'=>'A');
                $this->m_complain->update($data2,$crit1);
                var_dump('END SAVE');
                redirect("dash");
            }
        } else {
            var_dump("NO POST");
        }
    }

    public function saveItem()
    {
        if($_POST)
        {
            $report_no = $this->input->post('workorder',TRUE);
            $complain_no = $this->input->post('complain',TRUE);
            $item_no = $this->input->post('item_no',TRUE);
            $qty = $this->input->post('qty',TRUE);
            $tax = $this->input->post('tax',TRUE);
            $unitprice = $this->input->post('unitprice',TRUE);
            $baseamt = $this->input->post('baseamt',TRUE);
            $taxamt = $this->input->post('taxamt',TRUE);
            $totalamt = $this->input->post('totalamt',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $project = $this->input->post('project', TRUE);
            $user = $this->session->userdata('Tsuname');
            $today = date('d-m-Y H:i:s');

            $this->form_validation->set_rules('item_no', 'Item', 'required');
            $this->form_validation->set_rules('tax', ' Tax', 'required');
            $this->form_validation->set_rules('qty', ' Quantity', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                $data['error'] = validation_errors();
                $this->items($complain_no,$data);
                return;
            } else {
                $table = 'sv_charge';
                $crit = array('item_cd'=>$item_no);
                $dataitem = $this->m_wsbangun->getData_by_criteria($table,$crit);
                $table = 'tenant_postticket';
                $crit1 = array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'report_no'=>$report_no);
                $complains = $this->m_wsbangun->getData_by_criteria($table,$crit1);
                if(!empty($complains)) {
                    $data = $complains[0];
                    $table = 'sv_entry_dt';
                    $data1 = array('entity_cd'=>$data->entity_cd,
                        'project_no'=>$data->project_no,
                        'debtor_acct'=>$data->debtor_acct,
                        'report_no'=>$report_no,
                        'line_no'=>1,
                        'lot_no'=>$data->lot_no,
                        'status'=>$data->status,
                        'item_cd'=>$item_no,
                        'qty'=>$qty,
                        'charge_type'=>'I',
                        'service_cd'=>' ',
                        'sch_date'=>$today,
                        'status'=>$data->status,
                        'charge_rate'=>$unitprice,
                        'total_amt'=>$totalamt,
                        'tax_cd'=>$tax,
                        'tax_amt'=>$taxamt,
                        'base_amt'=>$baseamt,
                        'currency_cd'=>$dataitem[0]->currency_cd,
                        'status_ic'=>$dataitem[0]->ic_flag,
                        'trx_type'=>$dataitem[0]->trx_type,
                        'audit_user'=>$user,
                        'audit_date'=>$today);
                    $this->m_wsbangun->insertData($table,$data1);
                }
                redirect('ticket/assign');
            }
        }
    }

    public function saveServ()
    {
        if($_POST)
        {
            $report_no = $this->input->post('workorder',TRUE);
            $complain_no = $this->input->post('complain',TRUE);
            $serv_no = $this->input->post('serv_no',TRUE);
            $duration = $this->input->post('duration',TRUE);
            $tax = $this->input->post('tax',TRUE);
            $rateamt = $this->input->post('rateprice',TRUE);
            $baseamt = $this->input->post('baseamt',TRUE);
            $taxamt = $this->input->post('taxamt',TRUE);
            $totalamt = $this->input->post('totalamt',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $project = $this->input->post('project', TRUE);
            $user = $this->session->userdata('Tsuname');
            $today = date('d-m-Y H:i:s');

            $this->form_validation->set_rules('serv_no', 'Service', 'required');
            $this->form_validation->set_rules('tax', ' Tax', 'required');
            if ($this->form_validation->run() == FALSE) 
            {
                $data['error'] = validation_errors();
                $this->service($complain_no,$data);
                return;
            } else {
                $table = 'sv_master';
                $crit = array('service_cd'=>$serv_no);
                $dataserv = $this->m_wsbangun->getData_by_criteria($table,$crit);
                $table = 'tenant_postticket';
                $crit1 = array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'report_no'=>$report_no);
                $complains = $this->m_wsbangun->getData_by_criteria($table,$crit1);
                if(!empty($complains)) {
                    $data = $complains[0];
                    $table = 'sv_entry_dt';
                    $data1 = array('entity_cd'=>$data->entity_cd,
                        'project_no'=>$data->project_no,
                        'debtor_acct'=>$data->debtor_acct,
                        'report_no'=>$report_no,
                        'line_no'=>1,
                        'lot_no'=>$data->lot_no,
                        'status'=>$data->status,
                        'service_cd'=>$serv_no,
                        'charge_type'=>'S',
                        'assign_to'=>$user,
                        'sch_date'=>$today,
                        'time_in'=>$today,
                        'time_out'=>date('d-m-Y H:i:s',strtotime($today)+3600),
                        'charge_rate'=>$rateamt,
                        'total_amt'=>$totalamt,
                        'tax_cd'=>$tax,
                        'tax_amt'=>$taxamt,
                        'base_amt'=>$baseamt,
                        'currency_cd'=>$dataserv[0]->currency_cd,
                        'section_cd'=>$dataserv[0]->section_cd,
                        'trx_type'=>$dataserv[0]->trx_type,
                        'manhours'=>1,
                        'audit_user'=>$user,
                        'audit_date'=>$today);
                    $this->m_wsbangun->insertData($table,$data1);
                }
                redirect('ticket/assign');
            }
        }
    }

    public function saveUpd()
    {
        if($_POST)
        {
            $complain_no = $this->input->post('ticket_num',TRUE);
            $report_no = $this->input->post('work_num', TRUE);
            $status = $this->input->post('status',TRUE);
            $entity = $this->input->post('entity',TRUE);
            $project = $this->input->post('project', TRUE);
            $user = $this->session->userdata('Tsuname');

            var_dump('bS');
            $data1 = array('status'=>$status);
            $crit1 = array('complain_no'=>$complain_no);
            $crit2 = array('report_no'=>$report_no);
            $table = 'sv_entry_multi';
            $this->m_wsbangun->updateData($table, $data1, $crit1);
            $table = 'sv_entry_multi_dt';
            $this->m_wsbangun->updateData($table, $data1, $crit2);
            $table = 'sv_entry_hd';
            $this->m_wsbangun->updateData($table, $data1, $crit2);
            var_dump('END SAVE');
            redirect("dash");
        }
    }
}