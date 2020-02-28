<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Endorse extends Core_Controller
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
        $this->load_content_top_menu('endorse/index');
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
        AND mgr.sv_entry_hd.project_no  = '$project'
        AND mgr.sv_entry_hd.status  = 'F'
        AND mgr.sv_entry_hd.payment_method = 'S'";

        $sqlopen        = $sql."AND mgr.sv_entry_hd.status  = 'R'";
        $sqlassign      = $sql."AND mgr.sv_entry_hd.status  = 'A'";
        $sqlsurvey      = $sql."AND mgr.sv_entry_hd.status  = 'S'";
        $sqlconfirm     = $sql."AND mgr.sv_entry_hd.status  = 'F'";

        $open = $this->m_wsbangun->getData_by_query_cons($cons,$sqlopen);
        $assign = $this->m_wsbangun->getData_by_query_cons($cons,$sqlassign);
        $survey = $this->m_wsbangun->getData_by_query_cons($cons,$sqlsurvey);
        $confirm = $this->m_wsbangun->getData_by_query_cons($cons,$sqlconfirm);


        $data = array(
            'open' => $open,
            'assign' => $assign,
            'survey' => $survey,
            'confirm' => $confirm,
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
        mgr.sv_entry_hd.process_notes,
        mgr.sv_entry_hd.est_completion_date,
        mgr.sv_entry_hd.completion_date,
        mgr.sv_entry_hd.survey_notes,
        mgr.sv_entry_hd.remarks,
        mgr.sv_entry_hd.lot_no,
        mgr.sv_entry_hd.floor,
        mgr.sv_entry_hd.serv_req_by,
        mgr.sv_entry_hd.contact_no,
        mgr.sv_entry_hd.location,
        mgr.sv_entry_hd.seq_no_ticket,
        mgr.sv_entry_hd.confirm_date
        FROM mgr.sv_entry_hd  
        inner join mgr.ar_debtor
        on  mgr.sv_entry_hd.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_hd.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_hd.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_hd.category_cd =   mgr.sv_category.category_cd
        WHERE mgr.sv_entry_hd.status = 'F'
        AND   mgr.sv_entry_hd.payment_method = 'S'
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

    public function add($id,$view,$report){
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
        mgr.sv_entry_hd.survey_notes,
        mgr.sv_entry_hd.process_notes,
        mgr.sv_entry_hd.survey_date,
        mgr.sv_entry_hd.est_completion_date,
        mgr.sv_entry_hd.completion_date,
        mgr.sv_entry_hd.problem_cause,
        mgr.sv_entry_hd.remarks,
        mgr.sv_entry_hd.lot_no,
        mgr.sv_entry_hd.start_date,
        mgr.sv_entry_hd.est_start_date,
        mgr.sv_entry_hd.schedule_survey_date,
        mgr.sv_entry_hd.confirm_date,
        mgr.sv_entry_hd.payment_method
        FROM mgr.sv_entry_hd  
        inner join mgr.ar_debtor
        on  mgr.sv_entry_hd.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_hd.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_hd.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_hd.category_cd =   mgr.sv_category.category_cd
        WHERE mgr.sv_entry_hd.status = 'F'
        AND mgr.sv_entry_hd.entity_cd = '$entity' 
        and mgr.sv_entry_hd.project_no  = '$project'
        and mgr.sv_entry_hd.complain_no='$id'";
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $sql_item  = "SELECT
        mgr.sv_entry_dt.*,
        mgr.sv_charge.descs as descs_item
        FROM mgr.sv_entry_dt
        inner join mgr.sv_charge
        on mgr.sv_entry_dt.item_cd = mgr.sv_charge.item_cd
        where report_no='$report'";
        $item = $this->m_wsbangun->getData_by_query_cons($cons,$sql_item);

        $sql_service  = "SELECT
        mgr.sv_entry_dt.*,
        mgr.sv_master.descs as descs_service
        from mgr.sv_entry_dt
        inner join mgr.sv_master
        on mgr.sv_entry_dt.service_cd = mgr.sv_master.service_cd
        where report_no='$report'";
        $service = $this->m_wsbangun->getData_by_query_cons($cons,$sql_service);

        $sql_cnt  = "SELECT count(*) AS cnt FROM mgr.sv_entry_dt WHERE report_no='$report'";
        $cnt = $this->m_wsbangun->getData_by_query_cons($cons,$sql_cnt);

        $sql1 = "select count(*) as cnt from mgr.sv_entry_dt where charge_type='I' and report_no='$report'";
        $cntitem = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
        $cntitem = $cntitem[0]->cnt;

        $sql2 = "select count(*) as cnt from mgr.sv_entry_dt where charge_type='S' and report_no='$report'";
        $cntservice = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
        $cntservice = $cntservice[0]->cnt;

        $content = array(
            'data'=>$data,
            'item'=>$item,
            'service'=>$service,
            'cnt'=>$cnt,
            'cntitem'=>$cntitem,
            'cntservice'=>$cntservice
        );

        $this->load->view('endorse/'.$view,$content);
    }


    public function save_approve()
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

        $complainno = $this->input->post('complainno',TRUE);
        $lot_no = $this->input->post('lotno',TRUE);
        $assignto = $this->input->post('assignto',TRUE);
        $debtor_acct = $this->input->post('debtor_acct',TRUE);
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
                'approved_by' => $staff_id,
                'date_approved' => $audit_date,
                'status' => 'Z',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $data_em = array(
                'status' => 'Z',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $data_emdt = array(
                'status' => 'Z',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );

            $update_ehd = $this->m_wsbangun->updateData_cons($cons,$table_ehd,$data_ehd,$criteria);
            $update_em = $this->m_wsbangun->updateData_cons($cons,$table_em,$data_em,$criteria);
            $update_emdt = $this->m_wsbangun->updateData_cons($cons,$table_emdt,$data_emdt,$criteria);

            if($update_ehd == 'OK' && $update_em == 'OK' && $update_emdt == 'OK'  )
            {   
                $callback['Pesan'] = 'Approve Succesfull';

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
                    'NotificationCd'=>"APPROVAL",
                    'Remarks'=>'Work Order #'.$report_no[0]->report_no.'# Already Approval',
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
                    'ActivityCd'=>"APPROVAL",
                    'Remarks'=>'Staff namYou have updated the approval status with wo #'.$report_no[0]->report_no.'#',
                    'Complain_No'=>$complainno,
                    'Seq_no_ticket'=>$seq_no_ticket,
                );
                $insertnot = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot);
                $insertact = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dataact);

                $sql = "mgr.xsv_post_approval_endorsement_web '".$entity."', '".$project."','".$debtor_acct."', '".$report_no[0]->report_no."', '".$lot_no."', '".$audit_date."' ,'".$audit_date."'";
                $post = $this->m_wsbangun->setData_by_query_cons($cons,$sql);

                if($post == 'OK'){
                    $callback['Pesan'] = 'Approve Succesfull';
                }
                else{
                    $callback['Error'] = true;
                    $callback['Pesan'] = $post;
                }

            } else {
				$callback['Error'] = true;
                $callback['Pesan'] = $update_ehd . '<br>' .$update_em . '<br>' .$update_emdt;
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
        $assignto = $this->input->post('assignto',TRUE);
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
                'status' => 'M',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $data_em = array(
                'status' => 'M',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $data_emdt = array(
                'status' => 'M',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );

            $update_ehd = $this->m_wsbangun->updateData_cons($cons,$table_ehd,$data_ehd,$criteria);
            $update_em = $this->m_wsbangun->updateData_cons($cons,$table_em,$data_em,$criteria);
            $update_emdt = $this->m_wsbangun->updateData_cons($cons,$table_emdt,$data_emdt,$criteria);

            if($update_ehd == 'OK' && $update_em == 'OK' && $update_emdt == 'OK'  )
            {   
                $callback['Pesan'] = 'Modify Succesfull';

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
                    'NotificationCd'=>"MODIFY",
                    'Remarks'=>'Staff name assign to "'.$labourname.'" already assigned with WO # '.$report_no[0]->report_no.' #',
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
                    'ActivityCd'=>"MODIFY",
                    'Remarks'=>'Staff name assign to "'.$labourname.'" already assigned with WO # '.$report_no[0]->report_no.' #',
                    'Complain_No'=>$complainno,
                    'Seq_no_ticket'=>$seq_no_ticket,
                );
                $insertnot = $this->m_wsbangun->insertData_cons('ifca3','sysNotification',$datanot);
                $insertact = $this->m_wsbangun->insertData_cons('ifca3','sysActivity',$dataact);

            } else {
                $callback['Error'] = true;
                $callback['Pesan'] = $update_ehd . '<br>' .$update_em . '<br>' .$update_emdt;
            }
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = 'Data validation is not valid';
        }

        echo json_encode($callback);

    }

}