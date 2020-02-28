<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Ticket_Assign extends Core_Controller
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
        $this->load_content_top_menu('ticket_assign/index');
    }

    public function getfilter(){
        $cons       = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');

        $sql = "SELECT count(*) AS cnt
        FROM mgr.sv_entry_multi 
        inner join mgr.ar_debtor
        on  mgr.sv_entry_multi.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_multi.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_multi.category_cd =   mgr.sv_category.category_cd
        inner join mgr.cf_staff
        on mgr.sv_category.user_spv = mgr.cf_staff.staff_id
        left outer join mgr.sv_entry_hd
        on mgr.sv_entry_multi.entity_cd = mgr.sv_entry_hd.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.sv_entry_hd.project_no
        and mgr.sv_entry_multi.complain_no = mgr.sv_entry_hd.complain_no
        and mgr.sv_entry_multi.seq_no_ticket = mgr.sv_entry_hd.seq_no_ticket
        WHERE mgr.sv_entry_multi.entity_cd = '$entity' 
        and mgr.sv_entry_multi.project_no = '$project' 
        and mgr.cf_staff.email_addr = '$email'
        and mgr.sv_entry_multi.status in ('R','A')";

        $sqlopen        = $sql."AND mgr.sv_entry_multi.status  = 'R'";
        $sqlassign      = $sql."AND mgr.sv_entry_multi.status  = 'A'";


        $open = $this->m_wsbangun->getData_by_query_cons($cons,$sqlopen);
        $assign = $this->m_wsbangun->getData_by_query_cons($cons,$sqlassign);

        $data = array(
            'assign'=>$assign,
            'open'=>$open,
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

        $sql = "SELECT mgr.sv_entry_multi.complain_no ,           
        mgr.sv_entry_multi.debtor_acct ,     
        mgr.sv_entry_multi.rowId ,     
        mgr.ar_debtor.name ,           
        mgr.sv_entry_multi.reported_date ,           
        mgr.sv_entry_multi.reported_by , 
        mgr.sv_entry_multi.status ,
        mgr.sv_entry_multi.post_status ,  
        mgr.sv_entry_multi.category_cd,
        mgr.sv_category.descs,
        mgr.sv_category.category_priority,
        mgr.sv_entry_multi.assign_to,
        mgr.sv_entry_multi.report_no,
        mgr.sv_entry_multi.work_requested,
        mgr.sv_entry_hd.assigned_date,
        mgr.sv_entry_hd.response_time,
        mgr.sv_entry_hd.survey_date,
        mgr.sv_entry_hd.schedule_survey_date,
        mgr.sv_entry_multi.lot_no,
        mgr.sv_entry_multi.floor,
        mgr.sv_entry_multi.serv_req_by,
        mgr.sv_entry_multi.complain_type,
        mgr.sv_entry_multi.contact_no,
        mgr.sv_entry_multi.location,
        mgr.sv_entry_multi.seq_no_ticket,
        mgr.sv_entry_multi.completion_date,
        mgr.sv_entry_multi.est_completion_date
        FROM mgr.sv_entry_multi 
        inner join mgr.ar_debtor
        on  mgr.sv_entry_multi.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_multi.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_multi.category_cd =   mgr.sv_category.category_cd
        inner join mgr.cf_staff
        on mgr.sv_category.user_spv = mgr.cf_staff.staff_id
        left outer join mgr.sv_entry_hd
        on mgr.sv_entry_multi.entity_cd = mgr.sv_entry_hd.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.sv_entry_hd.project_no
        and mgr.sv_entry_multi.complain_no = mgr.sv_entry_hd.complain_no
        and mgr.sv_entry_multi.seq_no_ticket = mgr.sv_entry_hd.seq_no_ticket
        WHERE mgr.sv_entry_multi.entity_cd = '$entity' 
        and mgr.sv_entry_multi.project_no = '$project' 
        and mgr.cf_staff.email_addr = '$email'
        and mgr.sv_entry_multi.status in ('R','A')
        order by CAST(mgr.sv_entry_multi.reported_date AS datetime) desc";

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

    public function getDataByid($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_entry_multi';

        $where=array('complain_no'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getpict($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_attachment';

        $where=array('sv_entryhd_rowid'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

        echo json_encode($data);
    }

    public function getassited($id)
    {
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $where = "";
        if ($id) {
            $where = "AND mgr.sv_user_assign.staff_id <> '$id'";
        }

        $sql2="SELECT mgr.sv_user_assign.staff_id,
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
        and mgr.cf_staff.email_addr = '$email' $where";
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

        echo json_encode($data);
    }

    public function gettoken()
    {
        $cons   = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');

        $sql  = "SELECT mgr.token_firebase.*,
        mgr.cfs_user_project.entity_cd,
        mgr.cfs_user_project.project_no
        FROM mgr.token_firebase
        INNER JOIN mgr.cfs_user_project
        ON mgr.token_firebase.email=mgr.cfs_user_project.email
        WHERE entity_cd='$entity'
        AND project_no='$project'";

        $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

        echo json_encode($data);
    }

    public function assign($id){
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $sql = "SELECT mgr.sv_entry_multi.complain_no ,           
        mgr.sv_entry_multi.debtor_acct ,           
        mgr.ar_debtor.name ,           
        mgr.sv_entry_multi.reported_date ,           
        mgr.sv_entry_multi.reported_by , 
        mgr.sv_entry_multi.status ,
        mgr.sv_entry_multi.post_status ,  
        mgr.sv_entry_multi.category_cd,
        mgr.sv_entry_multi.contact_no,
        mgr.sv_category.descs,
        mgr.sv_category.category_priority,
        mgr.sv_entry_multi.assign_to,
        mgr.sv_entry_multi.report_no,
        mgr.sv_entry_multi.work_requested,
        mgr.sv_entry_hd.assigned_date,
        mgr.sv_entry_hd.response_time,
        mgr.sv_entry_hd.schedule_survey_date,
        mgr.sv_entry_hd.survey_date
        FROM mgr.sv_entry_multi 
        inner join mgr.ar_debtor
        on  mgr.sv_entry_multi.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_multi.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_multi.category_cd =   mgr.sv_category.category_cd
        inner join mgr.cf_staff
        on mgr.sv_category.user_spv = mgr.cf_staff.staff_id
        left outer join mgr.sv_entry_hd
        on mgr.sv_entry_multi.entity_cd = mgr.sv_entry_hd.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.sv_entry_hd.project_no
        and mgr.sv_entry_multi.complain_no = mgr.sv_entry_hd.complain_no
        and mgr.sv_entry_multi.seq_no_ticket = mgr.sv_entry_hd.seq_no_ticket
        WHERE mgr.sv_entry_multi.entity_cd = '$entity' 
        and mgr.sv_entry_multi.project_no = '$project'
        and mgr.cf_staff.email_addr = '$email'
        and mgr.sv_entry_multi.status <> 'F'
        and mgr.sv_entry_multi.complain_no = $id" ;

        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql2="SELECT  mgr.sv_user_assign.staff_id ,           
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
        and mgr.cf_staff.email_addr = '$email'";
        $labour = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

        $content = array(
            'data'=>$data,
            'labour'=>$labour,
            // 'token'=>$token
        );

        $this->load->view('ticket_assign/assign',$content);
    }

    public function save_assign()
    {
    	$callback = array(
 			'Data'	 => null,
 			'Error'  => false,
 			'Pesan'  => '',
 			'Status' => 200,
            'wa_no'=>'',
            'wa_cus'=>'',
            'ticket'=>''
 		);

 		$entity		= $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email 	= $this->session->userdata('Tsemail');
        $cons 		= $this->session->userdata('Tscons');

        $assign_to = $this->input->post('assign_to',TRUE);
        $complainno = $this->input->post('complainno',TRUE);
        $debtor_acct  = $this->input->post('debtor_acct',TRUE);
        $wa_cus  = $this->input->post('contact_no',TRUE);
        $assisted  = $this->input->post('assisted',TRUE);
        $date  = $this->input->post('schedule_survey_date',TRUE);
        $clock  = $this->input->post('schedule_survey_clock',TRUE);
        $schedule_survey_date = date('d M Y H:i:s', strtotime("$date $clock"));
        $labour  = $this->input->post('labourid',TRUE);
        $labour = explode(',', $labour);
        $labourid = $labour[0];
        $labouremail = $labour[1];
        $labourname = $labour[2];
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');


        $table    = 'sv_entry_multi';
        $table_dt = 'sv_entry_multi_dt';
        $table_hd = 'sv_entry_hd';

        $criteria = array('complain_no' => $complainno);

        if($_POST){
            if ($assign_to=='' || $assign_to==null) {
                $data = array(
                    'status'                => 'A',
                    'post_status'           => 'Y',
                    'assign_to'             => $labourid,
                    'assisted_by'           => $assisted,
                    'schedule_survey_date'  => $schedule_survey_date,
                    'audit_date'            => $audit_date,
                    'audit_user'            => $audit_user
                );

                $data_dt = array(
                    'status'     => 'A',
                    'assign_to'  => $labourid,
                    'audit_date' => $audit_date,
                    'audit_user' => $audit_user
                );

                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                if($update == 'OK'){   
                    $update_dt = $this->m_wsbangun->updateData_cons($cons,$table_dt,$data_dt,$criteria);
                    if ($update_dt== 'OK') {
                        $sql = "mgr.xsv_post_assignment '".$entity."', '".$project."','".$complainno."', '".$audit_user."'";
                        $post = $this->m_wsbangun->setData_by_query_cons($cons,$sql);
                        if ($post == 'OK') {
                            $email_spv= "";
                            $reportno = "";
                            $wa_no = 0;
                            $seq_no_ticket=0; 

                            $sql = "SELECT  mgr.sv_user_assign.user_id ,           
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
                            $emailspv = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

                            $sql2 = "SELECT report_no FROM mgr.sv_entry_multi where complain_no='$complainno'";
                            $report_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

                            $sql3 = "SELECT seq_no_ticket FROM mgr.sv_entry_hd where complain_no='$complainno'";
                            $seq_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);

                            $sql4 = "SELECT * FROM mgr.sysuser where email='$labouremail'";
                            $wa = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql4);

                            if (!empty($emailspv)) {                    
                                $email_spv = $emailspv[0]->email_addr;
                            }
                            if (!empty($report_no)) {                    
                                $reportno = $report_no[0]->report_no;
                            }
                            if (!empty($seq_no)) {                    
                                $seq_no_ticket = $seq_no[0]->seq_no_ticket;
                            }
                            if (!empty($wa)) {                    
                                $wa_no = $wa[0]->wa_no;
                            }

                            $sql5 = "SELECT mgr.cf_business.email_addr,
                            mgr.ar_debtor.name
                            from mgr.ar_debtor
                            inner join mgr.cf_business
                            on mgr.ar_debtor.business_id=mgr.cf_business.business_id
                            where mgr.ar_debtor.entity_cd='$entity'
                            and mgr.ar_debtor.project_no='$project'
                            and mgr.ar_debtor.debtor_acct='$debtor_acct'";
                            $cus = $this->m_wsbangun->getData_by_query_cons($cons,$sql5);

                            $email_cus = '';
                            $name_cus = '';

                            if (!empty($cus)) {                    
                                $email_cus = $cus[0]->email_addr;
                                $name_cus = $cus[0]->name;
                            }

                            $datanot = array(
                                'Email_addr'=>$email_spv,
                                'Entity_cd'=>$entity,
                                'Project_no'=>$project,
                                'NotificationDate'=>$audit_date,
                                'NotificationCd'=>"ASSIGN",
                                'Remarks'=>'Staff name assign to "'.$labourname.'" already assigned with WO # '.$reportno.' #',
                                'Complain_No'=>$complainno,
                                'Seq_no_ticket'=>$seq_no_ticket,
                                'IsRead'=>0,
                                'Email_from'=>$email
                            );
                            $datanot2 = array(
                                'Email_addr'=>$email_cus,
                                'Entity_cd'=>$entity,
                                'Project_no'=>$project,
                                'NotificationDate'=>$audit_date,
                                'NotificationCd'=>"ASSIGN",
                                'Remarks'=>"Your ticket #".$complainno."# Already Assigned. Thank you",
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
                                'ActivityCd'=>"ASSIGN",
                                'Remarks'=>"You have updated the Assign status with Ticket No #".$complainno."#",
                                'Complain_No'=>$complainno,
                                'Seq_no_ticket'=>$seq_no_ticket,
                            );
                            $insertnot = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot);
                            $insertnot2 = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot2);
                            $insertact = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dataact);

                            $sql = "mgr.x_send_mail_assignticket '".$email_cus."', '".$name_cus."', '".$complainno."' ,'".$reportno."' ";
                            $snd = $this->m_wsbangun->setData_by_query_cons('ifca3',$sql);
                            if ($insertnot=='OK' && $insertact=='OK' ) {
                               $callback['Pesan'] = "Your Ticket Already Assigned with Report No ".$report_no[0]->report_no;
                               $callback['wa_no'] = $wa_no;
                               $callback['wa_cus'] = $wa_cus;
                               $callback['ticket'] = $complainno;
                            }
                            else{
                                $callback['Error'] = true;
                                $callback['Pesan'] = $insertact;
                            }

                            $data_hd = array(
                                'schedule_survey_date' => $schedule_survey_date,
                            );
                            $update_hd = $this->m_wsbangun->updateData_cons($cons,$table_hd,$data_hd,$criteria);
                        }
                        else{
                            $callback['Error'] = true;
                            $callback['Pesan'] = $post;
                        }
                    }
                    else{
                        $callback['Error'] = true;
                        $callback['Pesan'] = $update_dt;
                    }
                }
                else {
                    $callback['Error'] = true;
                    $callback['Pesan'] = $update;
                }
            }
            else{

                $sql2 = "SELECT report_no FROM mgr.sv_entry_multi where complain_no='$complainno'";
                $report_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
                if (!empty($report_no)) {                    
                    $reportno = $report_no[0]->report_no;
                }

                $data = array(
                    'assign_to' => $labourid,
                    'assisted_by' => $assisted,
                    'schedule_survey_date' => $schedule_survey_date,
                    'audit_date' => $audit_date,
                    'audit_user' => $audit_user
                );
                $data_dt = array(
                    'assign_to' => $labourid,
                    'audit_date' => $audit_date,
                    'audit_user' => $audit_user
                );
                $data_hd = array(
                    'assign_to' => $labourid,
                    'assisted_by' => $assisted,
                    'schedule_survey_date' => $schedule_survey_date,
                    'audit_date' => $audit_date,
                    'audit_user' => $audit_user
                );
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                $update_dt = $this->m_wsbangun->updateData_cons($cons,$table_dt,$data_dt,$criteria);
                $update_hd = $this->m_wsbangun->updateData_cons($cons,$table_hd,$data_hd,$criteria);
                if ($update=='OK' && $update_dt=='OK' && $update_hd=='OK') {
                    $callback['Pesan'] = "Your Ticket Already Assigned with Report No ".$report_no[0]->report_no;
                    $callback['ticket'] = $complainno;
                }
                else{
                    $callback['Error'] = true;
                    $callback['Pesan'] = $update;
                }
            }
        }
        else{
        	$callback['Error'] = true;
	        $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

}