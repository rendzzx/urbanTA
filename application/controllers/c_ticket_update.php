<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Ticket_Update extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

    public function index()
    {
        $this->load_content_top_menu('ticket_update/index');
    }

    public function getfilter(){
        $cons       = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');

        $sql = "SELECT count(*) AS cnt
        FROM mgr.sv_entry_hd
        inner join mgr.sv_category
        on mgr.sv_entry_hd.category_cd = mgr.sv_category.category_cd
        inner join mgr.cf_staff
        on mgr.sv_category.user_spv = mgr.cf_staff.staff_id
        inner join mgr.ar_debtor
        on mgr.sv_entry_hd.entity_cd = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_hd.project_no = mgr.ar_debtor.project_no
        and mgr.sv_entry_hd.debtor_acct = mgr.ar_debtor.debtor_acct
        WHERE mgr.sv_entry_hd.status in ('A','P','M','F','Y','Z','S','V' )
        AND mgr.sv_entry_hd.entity_cd ='$entity'
        and mgr.sv_entry_hd.project_no ='$project'
        and mgr.cf_staff.email_addr ='$email'";

        // $sqlopen        = $sql."AND mgr.sv_entry_hd.status  = 'R'";
        $sqlassign      = $sql."AND mgr.sv_entry_hd.status  = 'A'";
        $sqlsurvey      = $sql."AND mgr.sv_entry_hd.status  = 'S'";
        // $sqlmodify      = $sql."AND mgr.sv_entry_hd.status  = 'M'";
        $sqlconfirm     = $sql."AND mgr.sv_entry_hd.status  = 'F'";
        $sqlapproved    = $sql."AND mgr.sv_entry_hd.status  = 'Z'";
        $sqlproses      = $sql."AND mgr.sv_entry_hd.status  = 'P'";
        $sqlsolved      = $sql."AND mgr.sv_entry_hd.status  = 'V'";
        $sqlclose       = $sql."AND mgr.sv_entry_hd.status  = 'C'";
        $sqldone        = $sql."AND mgr.sv_entry_hd.status  = 'D'";
        
        // $open    = $this->m_wsbangun->getData_by_query_cons($cons,$sqlopen);
        $assign  = $this->m_wsbangun->getData_by_query_cons($cons,$sqlassign);
        $survey  = $this->m_wsbangun->getData_by_query_cons($cons,$sqlsurvey);
        // $modify  = $this->m_wsbangun->getData_by_query_cons($cons,$sqlmodify);
        $confirm = $this->m_wsbangun->getData_by_query_cons($cons,$sqlconfirm);
        $approved = $this->m_wsbangun->getData_by_query_cons($cons,$sqlapproved);
        $proses  = $this->m_wsbangun->getData_by_query_cons($cons,$sqlproses);
        $solved  = $this->m_wsbangun->getData_by_query_cons($cons,$sqlsolved);
        $close   = $this->m_wsbangun->getData_by_query_cons($cons,$sqlclose);
        $done    = $this->m_wsbangun->getData_by_query_cons($cons,$sqldone);

        $data = array(
            // 'open' => $open,
            'assign' => $assign,
            'survey' => $survey,
            // 'modify' => $modify,
            'confirm' => $confirm,
            'approved' => $approved,
            'proses' => $proses,
            'solved' => $solved,
            'close' => $close,
            'done' => $done
        );

        echo json_encode($data);
    }

    public function gettable(){

        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status'=> 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $sql = "SELECT  mgr.sv_entry_hd.report_no,
        mgr.sv_entry_hd.status,
        mgr.ar_debtor.name,
        mgr.sv_category.descs,
        mgr.sv_entry_hd.work_requested,
        mgr.sv_entry_hd.complain_no,
        mgr.sv_entry_hd.seq_no_ticket,
        mgr.sv_entry_hd.assigned_date,
        mgr.sv_entry_hd.survey_date,
        mgr.sv_entry_hd.assign_to,
        mgr.sv_category.category_priority,
        mgr.sv_category.complain_type,
        mgr.sv_entry_hd.response_time,
        mgr.sv_entry_hd.est_completion_date,
        mgr.sv_entry_hd.completion_date,
        mgr.sv_entry_hd.survey_notes,
        mgr.sv_entry_hd.lot_no,
        mgr.sv_entry_hd.floor,
        mgr.sv_entry_hd.serv_req_by,
        mgr.sv_entry_hd.contact_no,
        mgr.sv_entry_hd.location,
        mgr.sv_entry_hd.seq_no_ticket,
        mgr.sv_entry_hd.payment_method
        FROM mgr.sv_entry_hd
        inner join mgr.sv_category
        on mgr.sv_entry_hd.category_cd = mgr.sv_category.category_cd
        inner join mgr.cf_staff
        on mgr.sv_category.user_spv = mgr.cf_staff.staff_id
        inner join mgr.ar_debtor
        on mgr.sv_entry_hd.entity_cd = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_hd.project_no = mgr.ar_debtor.project_no
        and mgr.sv_entry_hd.debtor_acct = mgr.ar_debtor.debtor_acct
        WHERE mgr.sv_entry_hd.status in ('A','P','M','F','Y','Z','S','V' )
        AND mgr.sv_entry_hd.entity_cd ='$entity'
        and mgr.sv_entry_hd.project_no ='$project'
        and mgr.cf_staff.email_addr ='$email'
        order by CAST(mgr.sv_entry_hd.reported_date AS datetime) desc";

        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        if (!empty($data)) {
            $callback['data'] = $data;
            }

        else{
            $callback['data'] = $data;
            $callback['Error'] = true;
        }

        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function gettableitem($reportno){

        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status'=> 200,
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $sql = "select * from mgr.sv_entry_dt where charge_type='I' and report_no='$reportno' ORDER BY line_no";

        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql2="select count(*) as cnt from mgr.sv_entry_dt where charge_type='I' and report_no='$reportno'";
        $cntitem = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $a = $cntitem[0]->cnt;

        if (!empty($data)) {
            $callback['data'] = $data;
            }
        else{
            $callback['Error'] = true;
            $callback['data'] = $data;
        }

        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function gettableservice($reportno){

        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status'=> 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $sql = "select * from mgr.sv_entry_dt where charge_type='S' and report_no='$reportno' ORDER BY line_no";

        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        if (!empty($data)) {
            $callback['data'] = $data;
            }

        else{
            $callback['Error'] = true;
            $callback['data'] = $data;
        }

        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function add($id,$view){
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons = $this->session->userdata('Tscons');

        $sql = "SELECT  mgr.sv_entry_hd.report_no,
        mgr.sv_entry_hd.status,
        mgr.ar_debtor.name,
        mgr.sv_category.descs,
        mgr.sv_entry_hd.work_requested,
        mgr.sv_entry_hd.complain_no,
        mgr.sv_entry_hd.seq_no_ticket,
        mgr.sv_entry_hd.assigned_date,
        mgr.sv_entry_hd.survey_date,
        mgr.sv_entry_hd.assign_to,
        mgr.sv_category.category_priority,
        mgr.sv_category.complain_type,
        mgr.sv_entry_hd.response_time,
        mgr.sv_entry_hd.est_completion_date,
        mgr.sv_entry_hd.completion_date,
        mgr.sv_entry_hd.survey_notes,
        mgr.sv_entry_hd.process_notes,
        mgr.sv_entry_hd.lot_no,
        mgr.sv_entry_hd.debtor_acct,
        mgr.sv_entry_hd.process_notes,
        mgr.sv_entry_hd.reported_date,
        mgr.sv_entry_hd.remarks,
        mgr.sv_entry_hd.problem_cause,
        mgr.sv_entry_hd.schedule_survey_date,
        mgr.sv_entry_hd.est_start_date,
        mgr.sv_entry_hd.confirm_date,
        mgr.sv_entry_hd.payment_method,
        mgr.sv_entry_hd.start_date,
        mgr.sv_entry_hd.completion_date,
        mgr.sv_entry_hd.completion_notes
        FROM mgr.sv_entry_hd
        inner join mgr.sv_category
        on mgr.sv_entry_hd.category_cd = mgr.sv_category.category_cd
        inner join mgr.cf_staff
        on mgr.sv_category.user_spv = mgr.cf_staff.staff_id
        inner join mgr.ar_debtor
        on mgr.sv_entry_hd.entity_cd = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_hd.project_no = mgr.ar_debtor.project_no
        and mgr.sv_entry_hd.debtor_acct = mgr.ar_debtor.debtor_acct
        WHERE mgr.sv_entry_hd.entity_cd ='$entity' and mgr.sv_entry_hd.project_no ='$project'
        and mgr.cf_staff.email_addr ='$email'
        and mgr.sv_entry_hd.complain_no='$id'";
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $table  = 'sv_charge';
        $where = array('rowID'>0);
        $item = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        $table2  = 'sv_master';
        $where = array('rowID'>0);
        $service = $this->m_wsbangun->getData_by_criteria_cons($cons,$table2,$where);

        $content = array(
            'data'=>$data,
            'item'=>$item,
            'service'=>$service
        );

        $this->load->view('ticket_update/'.$view,$content);
    }

    public function zoomitem($id){

        $cons = $this->session->userdata('Tscons');
        $table = 'sv_charge';

        $where=array('item_cd'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        echo json_encode($data);
    }

    public function zoomservice($id){

        $cons = $this->session->userdata('Tscons');
        $table = 'sv_master';

        $where=array('service_cd'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);
        echo json_encode($data);
    }

    public function zoomtax($id){

        $cons = $this->session->userdata('Tscons');
        $table1 = 'cf_tax_sch_hd';
        $table2 = 'cf_tax_sch_dt';

        $where1=array('scheme_cd'=>$id);
        $where2=array(
            'scheme_cd'=>$id,
            'deduct_flag'=>'N'
        );
        $tax_cd = $this->m_wsbangun->getData_by_criteria_cons($cons,$table1,$where1);
        $tax_rate = $this->m_wsbangun->getData_by_criteria_cons($cons,$table2,$where2);
        $data = array(
            'tax_cd' => $tax_cd,
            'tax_rate' => $tax_rate
        );
        echo json_encode($data);
    }

    public function save_item_service(){

        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $currencycditem     = $this->input->post('currencycditem',TRUE);
        $currencycdservice  = $this->input->post('currencycdservice',TRUE);
        $sectioncd          = $this->input->post('sectioncd',TRUE);
        $categorycd         = $this->input->post('categorycd',TRUE);
        $reportno           = $this->input->post('reportno',TRUE);
        $debtoracct         = $this->input->post('debtoracct',TRUE);
        $lotno              = $this->input->post('lotno',TRUE);

        $li  = $this->input->post('li',TRUE);
        $ls  = $this->input->post('ls',TRUE);

        $audit_date     = date('d M Y H:i:s');
        $audit_user     = $this->session->userdata('Tsuname');

        $table_dt = 'sv_entry_dt';

        $sql1="select line_no from mgr.sv_entry_dt where charge_type='I' ORDER BY line_no";
        $ts1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
        $line_no_item = 1;
        foreach ($ts1 as $key) {
            $line_no_item = $key->line_no+1;
        }

        $sql2="select line_no from mgr.sv_entry_dt where charge_type='S' ORDER BY line_no";
        $ts2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $line_no_service = 1;
        foreach ($ts2 as $key) {
            $line_no_service = $key->line_no+1;
        }

        if($_POST){

            for ($i=0; $i < $ls ; $i++) {
                ${'service' . $i}  = $_POST["service-$i"];
                ${'dataservice' . $i} = explode(',',${'service' . $i});

                $sql4="SELECT * FROM mgr.sv_entry_dt WHERE report_no='$reportno' AND service_cd='".${'dataservice' . $i}[0]."'";
                $ts4 = $this->m_wsbangun->getData_by_query_cons($cons,$sql4);
                if(empty($ts4)){
                    ${'servicedata' . $i} = array(
                    'entity_cd' => $entity,
                    'project_no' => $project,
                    'debtor_acct' => $debtoracct,
                    'report_no' => $reportno,
                    'line_no' => $line_no_service,
                    'lot_no' => $lotno,
                    'service_cd' => ${'dataservice' . $i}[0],
                    'trx_type' => ${'dataservice' . $i}[7],
                    'charge_type' => 'S',
                    'sch_date' => $audit_date,
                    'time_in' => ${'dataservice' . $i}[1],
                    'time_out' => ${'dataservice' . $i}[2],
                    'charge_rate' => str_replace(".","",${'dataservice' . $i}[5]),
                    'total_amt' => str_replace(".","",${'dataservice' . $i}[9]),
                    'tax_cd' => ${'dataservice' . $i}[7],
                    'tax_amt' => str_replace(".","",${'dataservice' . $i}[8]),
                    'currency_cd' => $currencycdservice,
                    'base_amt' => str_replace(".","",${'dataservice' . $i}[6]),
                    'audit_user' => $audit_user,
                    'audit_date' => $audit_date,
                    'section_cd' => $sectioncd,
                    'category_cd' => $categorycd,
                    'manhours' => ${'dataservice' . $i}[3],
                    'status_ic' => 'N'
                );
                $insertservice = $this->m_wsbangun->insertData_cons($cons,$table_dt,${'servicedata' . $i});
                }
                else{
                    $callback['Error'] = true;
                    $callback['Pesan'] = "This Service already exists";
                    echo json_encode($callback);
                    exit();
                }
            }

            for ($i=0; $i < $li ; $i++) {
                ${'item' . $i}  = $_POST["item-$i"];
                ${'dataitem' . $i} = explode(',',${'item' . $i});
                $sql3="SELECT * FROM mgr.sv_entry_dt WHERE report_no='$reportno' AND item_cd='".${'dataitem' . $i}[0]."'";
                $ts3 = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);
                if(empty($ts3)){
                    ${'itemdata' . $i} = array(
                        'entity_cd' => $entity,
                        'project_no' => $project,
                        'debtor_acct' => $debtoracct,
                        'report_no' => $reportno,
                        'line_no' => $line_no_item,
                        'lot_no' => $lotno,
                        'service_cd' => '',
                        'trx_type' => ${'dataitem' . $i}[5],
                        'charge_type' => 'I',
                        'sch_date' => $audit_date,
                        'item_cd' => ${'dataitem' . $i}[0],
                        'qty' => ${'dataitem' . $i}[2],
                        'charge_rate' => str_replace(".","",${'dataitem' . $i}[3]),
                        'total_amt' => str_replace(".","",${'dataitem' . $i}[7]),
                        'tax_cd' => ${'dataitem' . $i}[5],
                        'tax_amt' => str_replace(".","",${'dataitem' . $i}[6]),
                        'currency_cd' => $currencycditem,
                        'base_amt' => str_replace(".","",${'dataitem' . $i}[4]),
                        'audit_user' => $audit_user,
                        'audit_date' => $audit_date,
                        'markup' => 0.00,
                        'status_ic' => 'N'
                    );
                    $insertitem = $this->m_wsbangun->insertData_cons($cons,$table_dt,${'itemdata' . $i});
                }
                else{
                    $criteria = array(
                        'entity_cd' => $entity,
                        'project_no' => $project,
                        'report_no' => $reportno,
                        'item_cd' => ${'dataitem' . $i}[0]
                    );
                    ${'itemdata' . $i} = array(
                        'qty'        => $ts3[0]->qty + ${'dataitem' . $i}[2],
                        'base_amt'   => $ts3[0]->base_amt + str_replace(".","",${'dataitem' . $i}[4]),
                        'total_amt'  => $ts3[0]->total_amt + str_replace(".","",${'dataitem' . $i}[7]),
                        'audit_user' => $audit_user,
                        'audit_date' => $audit_date
                    );
                    $insertitem = $this->m_wsbangun->updateData_cons($cons,$table_dt,${'itemdata' . $i},$criteria);
                }
            }

            $callback['Pesan'] = "Checkout Succesfull";

        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = $_POST;
        }

        echo json_encode($callback);
    }

    public function save_survey()
    {
    	$callback = array(
 			'Data'	 => null,
 			'Error'  => false,
 			'Pesan'  => '',
 			'Status' => 200
 		);

 		$entity		= $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email 	    = $this->session->userdata('Tsemail');
        $cons 		= $this->session->userdata('Tscons');

        $complainno         = $this->input->post('complainno',TRUE);
        $lotno              = $this->input->post('lotno',TRUE);
        $reportno           = $this->input->post('reportno',TRUE);
        $debtoracct         = $this->input->post('debtoracct',TRUE);
        $assignto           = $this->input->post('assignto',TRUE);

        $act_survey_date     = $this->input->post('act_survey_date',TRUE);
        $act_survey_clock    = $this->input->post('act_survey_clock',TRUE);
        $act_survey_date     = date('d M Y H:i:s', strtotime("$act_survey_date $act_survey_clock"));

        $est_start_date     = $this->input->post('est_start_date',TRUE);
        $est_start_clock    = $this->input->post('est_start_clock',TRUE);
        $est_start_date     = date('d M Y H:i:s', strtotime("$est_start_date $est_start_clock"));

        $est_com_date       = $this->input->post('est_com_date',TRUE);
        $est_com_clock      = $this->input->post('est_com_clock',TRUE);
        $est_com_date       = date('d M Y H:i:s', strtotime("$est_com_date $est_com_clock"));

        $surveynote = $this->input->post('surveynote',TRUE);
        $problem    = $this->input->post('problem',TRUE);
        $solution   = $this->input->post('solution',TRUE);

        $audit_date     = date('d M Y H:i:s');
        $audit_user     = $this->session->userdata('Tsuname');

        // GET STAFF ID
        $tablestaff = 'cf_staff';
        $where      = array('email_addr'=>$email);
        $emailaddr  = $this->m_wsbangun->getData_by_criteria_cons($cons,$tablestaff,$where);
        $staff_id   = '';
        if ($emailaddr) {
            $staff_id = $emailaddr[0]->staff_id;
        }

        $table        = 'sv_entry_hd';
        $table_mlt    = 'sv_entry_multi';
        $table_mlt_dt = 'sv_entry_multi_dt';

        $criteria = array('complain_no' => $complainno);

        $sqlresponse = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$criteria);
        $response_time = $sqlresponse[0]->response_time;

        if($_POST){

            $data = array(
                'status'                => 'S',
                'survey_by'             => $staff_id,
                'survey_date'           => $act_survey_date,
                'est_start_date'        => $est_start_date,
                'est_completion_date'   => $est_com_date,
                'survey_notes'          => $surveynote,
                'remarks'               => $solution,
                'problem_cause'         => $problem,
                'audit_date'            => $audit_date,
                'audit_user'            => $audit_user
            );

            $data_mlt = array(
                'status'                => 'S',
                'est_start_date'        => $est_start_date,
                'est_completion_date'   => $est_com_date,
                'remarks'               => $solution,
                'problem_cause'         => $problem,
                'audit_date'            => $audit_date,
                'audit_user'            => $audit_user
            );

            $data_mlt_dt = array(
                'status'                => 'S',
                'est_completion_date'   => $est_com_date,
                'remarks'               => $solution,
                'problem_cause'         => $problem,
                'audit_date'            => $audit_date,
                'audit_user'            => $audit_user
            );

            $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
            if($update == 'OK'){
                $update = $this->m_wsbangun->updateData_cons($cons,$table_mlt,$data_mlt,$criteria);
                if ($update == 'OK') {
                    $update = $this->m_wsbangun->updateData_cons($cons,$table_mlt_dt,$data_mlt_dt,$criteria);
                    if ($update == 'OK') {

                        // $sql1="SELECT  mgr.sv_user_assign.staff_id ,           
                        // mgr.sv_labour.name,
                        // c.email_addr 
                        // FROM mgr.sv_user_assign (nolock)
                        // inner join mgr.sv_labour (nolock)     
                        // on mgr.sv_user_assign.staff_id = mgr.sv_labour.staff_id
                        // inner join mgr.cf_staff
                        // on mgr.sv_user_assign.user_id = mgr.cf_staff.staff_id
                        // inner join mgr.cf_staff c
                        // on mgr.sv_user_assign.staff_id = c.staff_id
                        // WHERE  mgr.sv_user_assign.entity_cd = '$entity' 
                        // and mgr.cf_staff.email_addr = '$email'
                        // and mgr.sv_labour.name = '$assignto'";
                        // $labour = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
                        // $labouremail = $labour[0]->email_addr;
                        // $labourname = $labour[0]->name;
                        // if(!empty($labour)){

                        // }

                        // $sql2 = "SELECT  mgr.sv_user_assign.user_id ,           
                        // c.staff_name,
                        // c.email_addr    
                        // FROM mgr.sv_user_assign (nolock)
                        // inner join mgr.sv_labour (nolock)     
                        // on mgr.sv_user_assign.staff_id = mgr.sv_labour.staff_id
                        // inner join mgr.cf_staff
                        // on mgr.sv_user_assign.staff_id = mgr.cf_staff.staff_id
                        // inner join mgr.cf_staff c
                        // on mgr.sv_user_assign.user_id = c.staff_id
                        // WHERE  mgr.sv_user_assign.entity_cd = '$entity' 
                        // and mgr.cf_staff.email_addr = '$labouremail'
                        // and c.email_addr <> '$email'";
                        // $emailspv = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

                        // $sql3 = "SELECT report_no FROM mgr.sv_entry_multi where complain_no='$complainno'";
                        // $report_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

                        // $sql4 = "SELECT seq_no_ticket FROM mgr.sv_entry_hd where complain_no='$complainno'";
                        // $seq_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql4);
                        // $seq_no_ticket=0;                                   
                        // if (!empty($seq_no)) {
                        //     $seq_no_ticket = $seq_no[0]->seq_no_ticket;
                        // }

                        // $datanot = array(
                        //     'Email_addr'=>$emailspv[0]->email_addr,
                        //     'Entity_cd'=>$entity,
                        //     'Project_no'=>$project,
                        //     'NotificationDate'=>$audit_date,
                        //     'NotificationCd'=>"SURVEY",
                        //     'Remarks'=>'You have updated the survey status with wo # '.$report_no[0]->report_no.' #',
                        //     'Complain_No'=>$complainno,
                        //     'Seq_no_ticket'=>$seq_no_ticket,
                        //     'IsRead'=>0,
                        //     'Email_from'=>$email
                        // );
                        // $dataact = array(
                        //     'Entity_cd'=>$entity,
                        //     'Project_no'=>$project,
                        //     'Email_addr'=>$email,
                        //     'ActivityDate'=>$audit_date,
                        //     'ActivityCd'=>"SURVEY",
                        //     'Remarks'=>'You have updated the survey status with wo # '.$report_no[0]->report_no.' #',
                        //     'Complain_No'=>$complainno,
                        //     'Seq_no_ticket'=>$seq_no_ticket,
                        // );
                        // $insertnot = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot);
                        // $insertact = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dataact);

                        $callback['Pesan'] = "Survey Succesfull";
                        $callback['Error'] = false;

                    }
                    else{
                        $callback['Error'] = true;
                        $callback['Pesan'] = $update; 
                    }
                }
                else{
                    $callback['Error'] = true;
                    $callback['Pesan'] = $update; 
                }
            }
            else{
                $callback['Error'] = true;
                $callback['Pesan'] = $update;
            }
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = $_POST;
        }
        echo json_encode($callback);
    }

    public function save_proses()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $complainno = $this->input->post('complainno',TRUE);
        $assignto  = $this->input->post('assignto',TRUE);

        $act_start_date     = $this->input->post('act_start_date',TRUE);
        $act_start_clock    = $this->input->post('act_start_clock',TRUE);
        $act_start_date     = date('d M Y H:i:s', strtotime("$act_start_date $act_start_clock"));
        $process_notes      = $this->input->post('process_notes',TRUE);

        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $tablestaff = 'cf_staff';
        $where      = array('email_addr' => $email);
        $emailaddr  = $this->m_wsbangun->getData_by_criteria_cons($cons,$tablestaff,$where);
        $staff_id   = $emailaddr[0]->staff_id;

        $table_hd       = 'sv_entry_hd';
        $table_mlt      = 'sv_entry_multi';
        $table_mlt_dt   = 'sv_entry_multi_dt';

        $criteria = array('complain_no' => $complainno);

        if($_POST){

            $data_hd = array(
                'status'        => 'P',
                'process_by'    => $staff_id,
                'process_notes' => $process_notes,
                'start_date'    => $act_start_date,
            );

            $data_mlt = array(
                'status'     => 'P',
                'start_date' => $act_start_date,
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );

            $data_mlt_dt = array(
                'status'     => 'P',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );

            $update = $this->m_wsbangun->updateData_cons($cons,$table_hd,$data_hd,$criteria);
            if($update == 'OK')
            {
                $update_mlt = $this->m_wsbangun->updateData_cons($cons,$table_mlt,$data_mlt,$criteria);
                $update_mlt_dt = $this->m_wsbangun->updateData_cons($cons,$table_mlt_dt,$data_mlt_dt,$criteria);
                if ($update_mlt == 'OK' && $update_mlt_dt=='OK' ) {

                    $sql1="SELECT  mgr.sv_user_assign.staff_id ,           
                    mgr.sv_labour.name,
                    c.email_addr 
                    FROM mgr.sv_user_assign (nolock)
                    inner join mgr.sv_labour (nolock)     
                    on mgr.sv_user_assign.staff_id = mgr.sv_labour.staff_id
                    inner join mgr.cf_staff
                    on mgr.sv_user_assign.user_id = mgr.cf_staff.staff_id
                    inner join mgr.cf_staff c
                    on mgr.sv_user_assign.staff_id = c.staff_id
                    WHERE  mgr.sv_user_assign.entity_cd = '$entity' 
                    and mgr.cf_staff.email_addr = '$email'
                    and mgr.sv_labour.name = '$assignto'";
                    $labour = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
                    $labouremail = $labour[0]->email_addr;
                    $labourname = $labour[0]->name;

                    $sql2 = "SELECT  mgr.sv_user_assign.user_id ,           
                    c.staff_name,
                    c.email_addr    
                    FROM mgr.sv_user_assign (nolock)
                    inner join mgr.sv_labour (nolock)
                    on mgr.sv_user_assign.staff_id = mgr.sv_labour.staff_id
                    inner join mgr.cf_staff
                    on mgr.sv_user_assign.staff_id = mgr.cf_staff.staff_id
                    inner join mgr.cf_staff c
                    on mgr.sv_user_assign.user_id = c.staff_id
                    WHERE  mgr.sv_user_assign.entity_cd = '$entity' 
                    and mgr.cf_staff.email_addr = '$labouremail'
                    and c.email_addr <> '$email'";
                    $emailspv = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

                    $sql3 = "SELECT report_no FROM mgr.sv_entry_multi where complain_no='$complainno'";
                    $report_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

                    $sql4 = "SELECT seq_no_ticket FROM mgr.sv_entry_hd where complain_no='$complainno'";
                    $seq_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql4);
                    $seq_no_ticket=0;                                   
                    if (!empty($seq_no)) {
                        if ($seq_no_ticket==null || $seq_no_ticket=='') {
                            $seq_no_ticket=0;                                    
                        }
                        else{
                            $seq_no_ticket = $seq_no[0]->seq_no_ticket;
                        }
                    }

                    $datanot = array(
                        'Email_addr'=>$emailspv[0]->email_addr,
                        'Entity_cd'=>$entity,
                        'Project_no'=>$project,
                        'NotificationDate'=>$audit_date,
                        'NotificationCd'=>"PROCESS",
                        'Remarks'=>'Work Order # '.$report_no[0]->report_no.' # Already Process',
                        'Complain_No'=>$complainno,
                        'Seq_no_ticket'=>$seq_no_ticket,
                        'IsRead'=>0,
                        'Email_from'=>$email
                    );
                    $dataact = array(
                        'Entity_cd'=>$entity,
                        'Project_no'=>$project,
                        'Email_addr'=>$email,
                        'ActivityDate'=>$audit_date,
                        'ActivityCd'=>"PROCESS",
                        'Remarks'=>' You have updated the Process status with wo #'.$report_no[0]->report_no.'#',
                        'Complain_No'=>$complainno,
                        'Seq_no_ticket'=>$seq_no_ticket,
                    );
                    $insertnot = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot);
                    $insertact = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dataact);

                    $callback['Pesan'] = 'Process Succesfull';                        
                }
                else{
                     $callback['Error'] = true;
                     $callback['Pesan'] = $update_mlt.$update_mlt_dt;
                }
            }
            else {
                $callback['Error'] = true;
                $callback['Pesan'] = $update;
            }
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

    public function save_solve()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $complainno     = $this->input->post('complainno',TRUE);
        $seq_no_ticket  = $this->input->post('seq_no_ticket',TRUE);

        // UPLOAD FOTO
        $isFile     = $this->input->post('isFile',TRUE);
        $uploadOk   = 1;

        if($isFile=="true"){
            $length = sizeof($_FILES["userfile"]["name"]);

            for ($i = 0; $i < $length ; $i++) { 

                $no = $i+1;

                $image      = $_FILES["userfile"]["name"][$i];
                $image      = str_replace(' ', '_', $image);
                $imageUrl   = base_url("img/Ticket_Solved/".$complainno."/".$image);

                if(!is_dir("./img/Ticket_Solved/".$complainno)){
                    mkdir("./img/Ticket_Solved/".$complainno);
                }

                $target_dir = "./img/Ticket_Solved/".$complainno."/";
                $target_file = $target_dir . str_replace(' ','_',basename($_FILES["userfile"]["name"][$i]));
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["userfile"]["tmp_name"][$i]);
                    if($check !== false) {
                        $callback['Pesan'] = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $callback['Error'] = true;
                        $callback['Pesan'] = "File is not an image.";
                        $uploadOk = 0;
                    }

                    $callback['Data'] = 'Failed';                        

                    echo json_encode($callback);
                    exit();
                }

                // if ($_FILES["userfile"]["size"][$i] > 300000) {
                //     $callback['Error'] = true;
                //     $callback['Pesan'] = "Maximum file size is 300kb";
                //     $uploadOk = 0;
                //     $callback['Data'] = 'failed';

                //     echo json_encode($callback);
                //     exit();
                // }

                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" ) {
                    $callback['Error'] = true;
                    $callback['Pesan'] ="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    $callback['Data'] = 'failed';

                    echo json_encode($callback);
                    exit();
                }

                if ($uploadOk == 0) {
                    $callback['Error'] = true;
                    $callback['Pesan'] = "Sorry, your file was not uploaded.";
                }
                else {
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"][$i], $target_file)) {
                        $data_attachment = array(
                            'entity_cd'         => $entity,
                            'project_no'        => $project,
                            'sv_entryhd_rowid'  => $seq_no_ticket,
                            'document_no'       => $no,
                            'document_descs'    => "Gambar Solved",
                            'document_status'   => "Y",
                            'file_attachment'   => $image,
                            'status_attach'     => 1,
                            'audit_user'        => $audit_user,
                            'audit_date'        => $audit_date,
                            'file_url'          => $imageUrl
                        );
                        $insertattch = $this->m_wsbangun->insertData_cons($cons,'sv_attachment_solved',$data_attachment);

                        if ($insertattch == 'OK') {
                            $callback['Pesan'] = "The file ". basename( $_FILES["userfile"]["name"][$i]). " has been uploaded.";
                        }
                        else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = "Sorry, there was an error uploading your file.";
                        }
                    }
                    else {
                        $callback['Error'] = true;
                        $callback['Pesan'] = "Sorry, there was an error uploading your file.";
                    }
                }
            }
        }

        $assignto  = $this->input->post('assignto',TRUE);

        $complete_date     = $this->input->post('complete_date',TRUE);
        $complete_clock    = $this->input->post('complete_clock',TRUE);
        $complete_date     = date('d M Y H:i:s', strtotime("$complete_date $complete_clock"));
        $complete_notes    = $this->input->post('complete_notes',TRUE);

        $tablestaff = 'cf_staff';
        $where      = array('email_addr' => $email);
        $emailaddr  = $this->m_wsbangun->getData_by_criteria_cons($cons,$tablestaff,$where);
        $staff_id   = $emailaddr[0]->staff_id;

        $table_hd       = 'sv_entry_hd';
        $table_mlt      = 'sv_entry_multi';
        $table_mlt_dt   = 'sv_entry_multi_dt';

        $criteria = array('complain_no' => $complainno);

        if($_POST){

            $data_hd = array(
                'status'            => 'V',
                'completion_notes'  => $complete_notes,
                'completion_date'   => $complete_date,
                'audit_date'        => $audit_date,
                'audit_user'        => $audit_user
            );

            $data_mlt = array(
                'status'            => 'V',
                'completion_date'   => $complete_date,
                'audit_date'        => $audit_date,
                'audit_user'        => $audit_user
            );

            $data_mlt_dt = array(
                'status'     => 'V',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );

            $update = $this->m_wsbangun->updateData_cons($cons,$table_hd,$data_hd,$criteria);
            if($update == 'OK')
            {
                $update_mlt = $this->m_wsbangun->updateData_cons($cons,$table_mlt,$data_mlt,$criteria);
                $update_mlt_dt = $this->m_wsbangun->updateData_cons($cons,$table_mlt_dt,$data_mlt_dt,$criteria);
                if ($update_mlt == 'OK' && $update_mlt_dt=='OK' ) {

                    $sql1="SELECT  mgr.sv_user_assign.staff_id ,           
                    mgr.sv_labour.name,
                    c.email_addr 
                    FROM mgr.sv_user_assign (nolock)
                    inner join mgr.sv_labour (nolock)     
                    on mgr.sv_user_assign.staff_id = mgr.sv_labour.staff_id
                    inner join mgr.cf_staff
                    on mgr.sv_user_assign.user_id = mgr.cf_staff.staff_id
                    inner join mgr.cf_staff c
                    on mgr.sv_user_assign.staff_id = c.staff_id
                    WHERE  mgr.sv_user_assign.entity_cd = '$entity' 
                    and mgr.cf_staff.email_addr = '$email'
                    and mgr.sv_labour.name = '$assignto'";
                    $labour = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
                    $labouremail = $labour[0]->email_addr;
                    $labourname = $labour[0]->name;

                    $sql2 = "SELECT  mgr.sv_user_assign.user_id ,           
                    c.staff_name,
                    c.email_addr    
                    FROM mgr.sv_user_assign (nolock)
                    inner join mgr.sv_labour (nolock)
                    on mgr.sv_user_assign.staff_id = mgr.sv_labour.staff_id
                    inner join mgr.cf_staff
                    on mgr.sv_user_assign.staff_id = mgr.cf_staff.staff_id
                    inner join mgr.cf_staff c
                    on mgr.sv_user_assign.user_id = c.staff_id
                    WHERE  mgr.sv_user_assign.entity_cd = '$entity' 
                    and mgr.cf_staff.email_addr = '$labouremail'
                    and c.email_addr <> '$email'";
                    $emailspv = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

                    $sql3 = "SELECT report_no FROM mgr.sv_entry_multi where complain_no='$complainno'";
                    $report_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

                    $sql4 = "SELECT seq_no_ticket FROM mgr.sv_entry_hd where complain_no='$complainno'";
                    $seq_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql4);
                    $seq_no_ticket=0;                                   
                    if (!empty($seq_no)) {
                        if ($seq_no_ticket==null || $seq_no_ticket=='') {
                            $seq_no_ticket=0;                                    
                        }
                        else{
                            $seq_no_ticket = $seq_no[0]->seq_no_ticket;
                        }
                    }

                    $datanot = array(
                        'Email_addr'=>$emailspv[0]->email_addr,
                        'Entity_cd'=>$entity,
                        'Project_no'=>$project,
                        'NotificationDate'=>$audit_date,
                        'NotificationCd'=>"PROCESS",
                        'Remarks'=>'Work Order # '.$report_no[0]->report_no.' # Already Process',
                        'Complain_No'=>$complainno,
                        'Seq_no_ticket'=>$seq_no_ticket,
                        'IsRead'=>0,
                        'Email_from'=>$email
                    );
                    $dataact = array(
                        'Entity_cd'=>$entity,
                        'Project_no'=>$project,
                        'Email_addr'=>$email,
                        'ActivityDate'=>$audit_date,
                        'ActivityCd'=>"PROCESS",
                        'Remarks'=>' You have updated the Process status with wo #'.$report_no[0]->report_no.'#',
                        'Complain_No'=>$complainno,
                        'Seq_no_ticket'=>$seq_no_ticket,
                    );
                    $insertnot = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot);
                    $insertact = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dataact);

                    $callback['Pesan'] = 'Process Succesfull';                        
                }
                else{
                     $callback['Error'] = true;
                     $callback['Pesan'] = $update_mlt.$update_mlt_dt;
                }
            }
            else {
                $callback['Error'] = true;
                $callback['Pesan'] = $update;
            }
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

    public function getpict($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_attachment';

        $where=array('sv_entryhd_rowid'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getPictSolved($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_attachment_solved';

        $where = array(
            'sv_entryhd_rowid'  => $id,
        );
        $data   = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function save_confirm()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $complainno     = $this->input->post('complainno',TRUE);
        $categorypr     = $this->input->post('categorypr',TRUE);
        $reportno       = $this->input->post('reportno',TRUE);
        $assignto       = $this->input->post('assignto',TRUE);

        //CONFIRM
        $confirm_date   = $this->input->post('confirm_date',TRUE);
        $confirm_clock  = $this->input->post('confirm_clock',TRUE);
        $confirm_date   = date('d M Y H:i:s', strtotime("$confirm_date $confirm_clock"));
        $payment_method = $this->input->post('payment_method',TRUE);
        // var_dump($confirm_date);exit();

        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $tablestaff = 'cf_staff';
        $where      = array('email_addr' => $email);
        $emailaddr  = $this->m_wsbangun->getData_by_criteria_cons($cons,$tablestaff,$where);
        $staff_id   = $emailaddr[0]->staff_id;

        $table_hd     = 'sv_entry_hd';
        $table_mlt    = 'sv_entry_multi';
        $table_mlt_dt = 'sv_entry_multi_dt';

        $criteria = array('complain_no' => $complainno);

        if($_POST){

            $data_hd = array(
                'status'         => 'F',
                'confirm_by'     => $staff_id,
                'confirm_date'   => $confirm_date,
                'payment_method' => $payment_method,
                'audit_date'     => $audit_date,
                'audit_user'     => $audit_user
            );
            $data_mlt = array(
                'status'         => 'F',
                'confirm_date'   => $confirm_date,
                'payment_method' => $payment_method,
                'audit_date'     => $audit_date,
                'audit_user'     => $audit_user
            );

            $data_mlt_dt = array(
                'status'         => 'F',
                'audit_date'     => $audit_date,
                'audit_user'     => $audit_user
            );

            $update = $this->m_wsbangun->updateData_cons($cons,$table_hd,$data_hd,$criteria);
            if ($update == 'OK'){
                $update_mlt = $this->m_wsbangun->updateData_cons($cons,$table_mlt,$data_mlt,$criteria);
                $update_ml_tdt = $this->m_wsbangun->updateData_cons($cons,$table_mlt_dt,$data_mlt_dt,$criteria);
                if ($update_mlt == 'OK' && $update_ml_tdt=='OK' ) {
                    $callback['Pesan'] = 'Confirm Succesfull';

                    $sql1="SELECT  mgr.sv_user_assign.staff_id ,           
                    mgr.sv_labour.name,
                    c.email_addr 
                    FROM mgr.sv_user_assign (nolock)
                    inner join mgr.sv_labour (nolock)     
                    on mgr.sv_user_assign.staff_id = mgr.sv_labour.staff_id
                    inner join mgr.cf_staff
                    on mgr.sv_user_assign.user_id = mgr.cf_staff.staff_id
                    inner join mgr.cf_staff c
                    on mgr.sv_user_assign.staff_id = c.staff_id
                    WHERE  mgr.sv_user_assign.entity_cd = '$entity' 
                    and mgr.cf_staff.email_addr = '$email'
                    and mgr.sv_labour.name = '$assignto'";
                    $labour = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
                    $labouremail = $labour[0]->email_addr;
                    $labourname = $labour[0]->name;

                    $sql2 = "SELECT  mgr.sv_user_assign.user_id ,           
                    c.staff_name,
                    c.email_addr    
                    FROM mgr.sv_user_assign (nolock)
                    inner join mgr.sv_labour (nolock)     
                    on mgr.sv_user_assign.staff_id = mgr.sv_labour.staff_id
                    inner join mgr.cf_staff
                    on mgr.sv_user_assign.staff_id = mgr.cf_staff.staff_id
                    inner join mgr.cf_staff c
                    on mgr.sv_user_assign.user_id = c.staff_id
                    WHERE  mgr.sv_user_assign.entity_cd = '$entity' 
                    and mgr.cf_staff.email_addr = '$labouremail'
                    and c.email_addr <> '$email'";
                    $emailspv = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

                    $sql3 = "SELECT report_no FROM mgr.sv_entry_multi where complain_no='$complainno'";
                    $report_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

                    $sql4 = "SELECT seq_no_ticket FROM mgr.sv_entry_hd where complain_no='$complainno'";
                    $seq_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql4);
                    $seq_no_ticket=0;                                   
                    if (!empty($seq_no)) {
                        if ($seq_no_ticket==null || $seq_no_ticket=='') {
                            $seq_no_ticket=0;                                    
                        }
                        else{
                            $seq_no_ticket = $seq_no[0]->seq_no_ticket;
                        }
                    }

                    $datanot = array(
                        'Email_addr'=>$emailspv[0]->email_addr,
                        'Entity_cd'=>$entity,
                        'Project_no'=>$project,
                        'NotificationDate'=>$audit_date,
                        'NotificationCd'=>"CONFIRM",
                        'Remarks'=>'Work Order #'.$report_no[0]->report_no.'# Already Confirm',
                        'Complain_No'=>$complainno,
                        'Seq_no_ticket'=>$seq_no_ticket,
                        'IsRead'=>0,
                        'Email_from'=>$email
                    );
                    $dataact = array(
                        'Entity_cd'=>$entity,
                        'Project_no'=>$project,
                        'Email_addr'=>$email,
                        'ActivityDate'=>$audit_date,
                        'ActivityCd'=>"CONFIRM",
                        'Remarks'=>'You have updated the Confirm status with wo #'.$report_no[0]->report_no.'#',
                        'Complain_No'=>$complainno,
                        'Seq_no_ticket'=>$seq_no_ticket,
                    );
                    $insertnot = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot);
                    $insertact = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dataact);
                } else {
                     $callback['Error'] = true;
                     $callback['Pesan'] = $update_mlt.$update_ml_tdt;
                }
            }
            else {
                $callback['Error'] = true;
                $callback['Pesan'] = $update;
            }
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

}
