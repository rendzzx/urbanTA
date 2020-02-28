<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Ticket_Close extends Core_Controller
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
        $this->load_content_top_menu('ticket_close/index');
    }

    public function getfilter(){
        $cons       = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');

        $sql = "SELECT count(*) AS cnt
        FROM mgr.sv_entry_hd  
        inner join mgr.ar_debtor
        on  mgr.sv_entry_hd.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_hd.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_hd.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_hd.category_cd =   mgr.sv_category.category_cd
        WHERE mgr.sv_entry_hd.entity_cd = '$entity' 
        and mgr.sv_entry_hd.project_no  = '$project'
        and mgr.sv_entry_hd.status = 'V'";

        $sqlopen        = $sql."AND mgr.sv_entry_hd.status  = 'R'";
        $sqlassign      = $sql."AND mgr.sv_entry_hd.status  = 'A'";
        $sqlsurvey      = $sql."AND mgr.sv_entry_hd.status  = 'S'";
        $sqlmodify      = $sql."AND mgr.sv_entry_hd.status  = 'M'";
        $sqlproses      = $sql."AND mgr.sv_entry_hd.status  = 'P'";
        $sqlconfirm     = $sql."AND mgr.sv_entry_hd.status  = 'F'";
        $sqlapproved    = $sql."AND mgr.sv_entry_hd.status  = 'Z'";
        $sqldone        = $sql."AND mgr.sv_entry_hd.status  = 'D'";

        $open = $this->m_wsbangun->getData_by_query_cons($cons,$sqlopen);
        $assign = $this->m_wsbangun->getData_by_query_cons($cons,$sqlassign);
        $survey = $this->m_wsbangun->getData_by_query_cons($cons,$sqlsurvey);
        $modify  = $this->m_wsbangun->getData_by_query_cons($cons,$sqlmodify );
        $proses = $this->m_wsbangun->getData_by_query_cons($cons,$sqlproses);
        $confirm = $this->m_wsbangun->getData_by_query_cons($cons,$sqlconfirm);
        $approved = $this->m_wsbangun->getData_by_query_cons($cons,$sqlapproved);
        $done = $this->m_wsbangun->getData_by_query_cons($cons,$sqldone);

        $data = array(
            'open' => $open,
            'assign' => $assign,
            'survey' => $survey,
            'modify' => $modify,
            'proses' => $proses,
            'confirm' => $confirm,
            'approved' => $approved,
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

        $sql = "SELECT mgr.sv_entry_hd.complain_no ,           
        mgr.sv_entry_hd.debtor_acct ,           
        mgr.ar_debtor.name ,           
        mgr.sv_entry_hd.reported_date ,           
        mgr.sv_entry_hd.reported_by , 
        mgr.sv_entry_hd.status ,
        mgr.sv_entry_hd.category_cd,
        mgr.sv_category.descs,
        mgr.sv_category.category_priority,
        mgr.sv_category.complain_type,
        mgr.sv_entry_hd.assign_to,
        mgr.sv_entry_hd.report_no,
        mgr.sv_entry_hd.work_requested,
        mgr.sv_entry_hd.assigned_date,
        mgr.sv_entry_hd.response_time,
        mgr.sv_entry_hd.survey_date,
        mgr.sv_entry_hd.est_completion_date,
        mgr.sv_entry_hd.completion_date,
        mgr.sv_entry_hd.remarks,
        mgr.sv_entry_hd.lot_no,
        mgr.sv_entry_hd.floor,
        mgr.sv_entry_hd.serv_req_by,
        mgr.sv_entry_hd.contact_no,
        mgr.sv_entry_hd.location,
        mgr.sv_entry_hd.seq_no_ticket,
        mgr.sv_entry_hd.contact_no
        FROM mgr.sv_entry_hd  
        inner join mgr.ar_debtor
        on  mgr.sv_entry_hd.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_hd.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_hd.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_hd.category_cd =   mgr.sv_category.category_cd
        WHERE mgr.sv_entry_hd.status = 'V'
        AND   mgr.sv_entry_hd.entity_cd = '$entity' 
        and   mgr.sv_entry_hd.project_no  = '$project'
        order by CAST(mgr.sv_entry_hd.reported_date AS datetime) desc";

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

    public function getpict($id)
    {
        $cons   = $this->session->userdata('Tscons');
        $table  = 'sv_attachment';

        $where=array('sv_entryhd_rowid'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where);

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

    public function add($id,$view){
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $sql = "SELECT mgr.sv_entry_hd.complain_no ,           
        mgr.sv_entry_hd.debtor_acct ,           
        mgr.ar_debtor.name ,           
        mgr.sv_entry_hd.reported_date ,           
        mgr.sv_entry_hd.reported_by , 
        mgr.sv_entry_hd.status ,
        mgr.sv_entry_hd.category_cd,
        mgr.sv_category.descs,
        mgr.sv_category.category_priority,
        mgr.sv_entry_hd.assign_to,
        mgr.sv_entry_hd.report_no,
        mgr.sv_entry_hd.work_requested,
        mgr.sv_entry_hd.assigned_date,
        mgr.sv_entry_hd.response_time,
        mgr.sv_entry_hd.survey_date,
        mgr.sv_entry_hd.est_completion_date,
        mgr.sv_entry_hd.completion_date,
        mgr.sv_entry_hd.contact_no,
        mgr.sv_entry_hd.seq_no_ticket,
        mgr.sv_category.complain_type,
        mgr.sv_entry_hd.survey_notes,
        mgr.sv_entry_hd.process_notes,
        mgr.sv_entry_hd.lot_no,
        mgr.sv_entry_hd.debtor_acct,
        mgr.sv_entry_hd.remarks,
        mgr.sv_entry_hd.problem_cause,
        mgr.sv_entry_hd.schedule_survey_date,
        mgr.sv_entry_hd.est_start_date,
        mgr.sv_entry_hd.confirm_date,
        mgr.sv_entry_hd.start_date,
        mgr.sv_entry_hd.completion_date
        FROM mgr.sv_entry_hd  
        inner join mgr.ar_debtor
        on  mgr.sv_entry_hd.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_hd.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_hd.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_hd.category_cd =   mgr.sv_category.category_cd
        WHERE  mgr.sv_entry_hd.entity_cd = '$entity' 
        and mgr.sv_entry_hd.project_no  = '$project'
        and mgr.sv_entry_hd.complain_no='$id'";
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $seq_no_ticket = $data[0]->seq_no_ticket;
        $whereP = array('sv_entryhd_rowid' => $seq_no_ticket);

        $pictP  = $this->m_wsbangun->getData_by_criteria_cons($cons,'sv_attachment',$whereP);
        $pictS  = $this->m_wsbangun->getData_by_criteria_cons($cons,'sv_attachment_solved',$whereP);

        $tableFb    = 'sv_feed_back';
        $whereFb    = array('rowID' > 0);
        $feedback   = $this->m_wsbangun->getData_by_criteria_cons($cons,$tableFb,$whereFb);

        $content = array(
            'data'      => $data,
            'feedback'  => $feedback,
            'pictP'     => $pictP,
            'pictS'     => $pictS
        );

        $this->load->view('ticket_close/'.$view,$content);
    }


    public function save_close()
    {
    	$callback = array(
 			'Data'	 => null,
 			'Error'  => false,
 			'Pesan'  => '',
 			'Status' => 200,
            'wa_cus'=>'',
            'ticket'=>''
 		);

 		$entity		= $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email 	    = $this->session->userdata('Tsemail');
        $cons 		= $this->session->userdata('Tscons');

        $complainno = $this->input->post('complainno',TRUE);
        $debtor_acct  = $this->input->post('debtor_acct',TRUE);
        $feedback  = $this->input->post('feedback',TRUE);
        $wa_cus  = $this->input->post('contact_no',TRUE);
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $tablestaff = 'cf_staff';
        $where=array('email_addr'=>$email);
        $emailaddr = $this->m_wsbangun->getData_by_criteria_cons($cons,$tablestaff,$where);
        $staff_id = $emailaddr[0]->staff_id;

        $table_ehd = 'sv_entry_hd';
        $table_em = 'sv_entry_multi';
        $table_emdt = 'sv_entry_multi_dt';

        $criteria = array('complain_no' => $complainno);

        if($_POST){
            $data_ehd = array(
                'close_by' => $staff_id,
                'close_date' => $audit_date,
                'status' => 'C',
                'feed_back'=> $feedback,
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $data_em = array(
                'status' => 'C',
                'feed_back'=> $feedback,
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $data_emdt = array(
                'status' => 'C',
                'feed_back'=> $feedback,
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );

            $update_ehd = $this->m_wsbangun->updateData_cons($cons,$table_ehd,$data_ehd,$criteria);
            $update_em = $this->m_wsbangun->updateData_cons($cons,$table_em,$data_em,$criteria);
            $update_emdt = $this->m_wsbangun->updateData_cons($cons,$table_emdt,$data_emdt,$criteria);

            if($update_ehd == 'OK' && $update_em == 'OK' && $update_emdt == 'OK'  )
            {   

                $sql1 = "SELECT mgr.cf_business.email_addr,
                mgr.ar_debtor.name
                from mgr.ar_debtor
                inner join mgr.cf_business
                on mgr.ar_debtor.business_id=mgr.cf_business.business_id
                where mgr.ar_debtor.entity_cd='$entity'
                and mgr.ar_debtor.project_no='$project'
                and mgr.ar_debtor.debtor_acct='$debtor_acct'";
                $cus = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
                $email_cus = "";
                $name_cus = "";
                if (!empty($cus)) {                    
                    $email_cus = $cus[0]->email_addr;
                    $name_cus = $cus[0]->name;
                }
                
                $sql2 = "SELECT seq_no_ticket FROM mgr.sv_entry_hd where complain_no='$complainno'";
                $seq_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
                $seq_no_ticket=0;                    
                if (!empty($seq_no)) {                    
                    $seq_no_ticket = $seq_no[0]->seq_no_ticket;
                }

                $sql2 = "SELECT report_no FROM mgr.sv_entry_multi where complain_no='$complainno'";
                $report_no = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

                $datanot = array(
                    'Email_addr'=>$email_cus,
                    'Entity_cd'=>$entity,
                    'Project_no'=>$project,
                    'NotificationDate'=>$audit_date,
                    'NotificationCd'=>"CLOSE",
                    'Remarks'=>"Your ticket #".$complainno."# Already Complete. Please Rate Me Your Satisfaction. Thank You",
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
                    'ActivityCd'=>"CLOSE",
                    'Remarks'=>"You have updated the Close status with wo #".$report_no[0]->report_no."#",
                    'Complain_No'=>$complainno,
                    'Seq_no_ticket'=>$seq_no_ticket,
                );
                $insertnot = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot);
                $insertact = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dataact);
                $sql = "mgr].x_send_mail_closeticket '".$email_cus."', '".$name_cus."', '".$complainno."' ,'".$report_no[0]->report_no."' ";
                $snd = $this->m_wsbangun->setData_by_query_cons('ifca3',$sql);
                $callback['Pesan'] = "Your ticket #".$complainno."# Already Complete. Please Rate Me Your Satisfaction. Thank You";
                $callback['wa_cus'] = $wa_cus;
                $callback['ticket'] = $complainno;
            } else {
				$callback['Error'] = true;
                $callback['Pesan'] = $update_ehd;
            }
        }
        else{
        	$callback['Error'] = true;
	        $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

    public function save_modify()
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
        $audit_date = date('d M Y H:i:s');
        $audit_user = $this->session->userdata('Tsuname');

        $table = 'sv_entry_hd';

        $criteria = array('complain_no' => $complainno);

        if($_POST){
            $data = array(
                'status' => 'M',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
            if($update == 'OK')
            {   
                $callback['Pesan'] = 'Modify Berhasil';
            } else {
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