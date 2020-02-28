<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Ticket_All extends Core_Controller
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
        $cons       = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');

        $sql = "SELECT count(*) AS cnt
        FROM mgr.sv_entry_multi 
        left outer join mgr.sv_entry_hd  
        on  mgr.sv_entry_multi.entity_cd  = mgr.sv_entry_hd.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.sv_entry_hd.project_no 
        -- and mgr.sv_entry_multi.complain_no = mgr.sv_entry_hd.complain_no 
        inner join mgr.ar_debtor
        on  mgr.sv_entry_multi.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_multi.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_multi.category_cd =   mgr.sv_category.category_cd
        WHERE mgr.sv_entry_multi.entity_cd = '$entity' 
        and   mgr.sv_entry_multi.project_no  = '$project'";

        $sqlopen        = $sql."AND mgr.sv_entry_multi.status  = 'R'";
        $sqlassign      = $sql."AND mgr.sv_entry_multi.status  = 'A'";
        $sqlsurvey      = $sql."AND mgr.sv_entry_multi.status  = 'S'";
        $sqlmodify      = $sql."AND mgr.sv_entry_multi.status  = 'M'";
        $sqlproses      = $sql."AND mgr.sv_entry_multi.status  = 'P'";
        $sqlconfirm     = $sql."AND mgr.sv_entry_multi.status  = 'F'";
        $sqlapproved    = $sql."AND mgr.sv_entry_multi.status  = 'Z'";
        $sqlclose       = $sql."AND mgr.sv_entry_multi.status  = 'C'";
        $sqldone        = $sql."AND mgr.sv_entry_multi.status  = 'D'";

        $open = $this->m_wsbangun->getData_by_query_cons($cons,$sqlopen);
        $assign = $this->m_wsbangun->getData_by_query_cons($cons,$sqlassign);
        $survey = $this->m_wsbangun->getData_by_query_cons($cons,$sqlsurvey);
        $modify  = $this->m_wsbangun->getData_by_query_cons($cons,$sqlmodify );
        $proses = $this->m_wsbangun->getData_by_query_cons($cons,$sqlproses);
        $confirm = $this->m_wsbangun->getData_by_query_cons($cons,$sqlconfirm);
        $approved = $this->m_wsbangun->getData_by_query_cons($cons,$sqlapproved);
        $close  = $this->m_wsbangun->getData_by_query_cons($cons,$sqlclose);
        $done = $this->m_wsbangun->getData_by_query_cons($cons,$sqldone);

        $content = array(
            'open' => $open,
            'assign' => $assign,
            'survey' => $survey,
            'modify' => $modify,
            'proses' => $proses,
            'confirm' => $confirm,
            'approved' => $approved,
            'close' => $close,
            'done' => $done
        );

        $this->load_content_top_menu('ticket_all/index',$content);
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
        mgr.ar_debtor.name ,           
        mgr.sv_entry_multi.reported_date ,           
        mgr.sv_entry_multi.reported_by , 
        mgr.sv_entry_multi.status ,
        mgr.sv_entry_multi.category_cd,
        mgr.sv_category.descs,
        mgr.sv_category.category_priority,
        mgr.sv_entry_hd.assign_to,
        mgr.sv_entry_hd.report_no,
        mgr.sv_entry_hd.rating_us,
        mgr.sv_entry_multi.work_requested,
        mgr.sv_entry_hd.assigned_date,
        mgr.sv_entry_hd.response_time,
        mgr.sv_entry_hd.survey_date,
        mgr.sv_entry_hd.est_completion_date,
        mgr.sv_entry_hd.completion_date,
        mgr.sv_entry_multi.remarks,
        mgr.sv_entry_multi.lot_no,
        mgr.sv_entry_multi.floor,
        mgr.sv_entry_multi.serv_req_by,
        mgr.sv_entry_multi.contact_no,
        mgr.sv_entry_multi.location,
        mgr.sv_entry_multi.seq_no_ticket
        FROM mgr.sv_entry_multi 
        left outer join mgr.sv_entry_hd  
        on  mgr.sv_entry_multi.entity_cd  = mgr.sv_entry_hd.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.sv_entry_hd.project_no 
        -- and mgr.sv_entry_multi.complain_no = mgr.sv_entry_hd.complain_no
        inner join mgr.ar_debtor
        on  mgr.sv_entry_multi.entity_cd  = mgr.ar_debtor.entity_cd
        and mgr.sv_entry_multi.project_no = mgr.ar_debtor.project_no 
        and mgr.sv_entry_multi.debtor_acct = mgr.ar_debtor.debtor_acct 
        inner join mgr.sv_category     
        on mgr.sv_entry_multi.category_cd =   mgr.sv_category.category_cd
        WHERE mgr.sv_entry_multi.entity_cd = '$entity' 
        and   mgr.sv_entry_multi.project_no  = '$project'
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

    public function add($id,$report){
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
        mgr.sv_entry_hd.problem_cause
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

        $tablefb  = 'sv_entry_hd';
        $where=array('complain_no'=>$id);
        $feedback = $this->m_wsbangun->getData_by_criteria_cons($cons,$tablefb,$where);

        $sql_cnt  = "SELECT count(*) AS cnt FROM mgr.sv_entry_dt WHERE report_no='$report'";
        $cnt = $this->m_wsbangun->getData_by_query_cons($cons,$sql_cnt);

        $content = array(
            'data'=>$data,
            'item'=>$item,
            'service'=>$service,
            'feedback'=>$feedback,
            'cnt'=>$cnt
        );

        $this->load->view('ticket_all/detail',$content);
    }


    public function save_close()
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
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $data_em = array(
                'status' => 'C',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );
            $data_emdt = array(
                'status' => 'C',
                'audit_date' => $audit_date,
                'audit_user' => $audit_user
            );

            $update_ehd = $this->m_wsbangun->updateData_cons($cons,$table_ehd,$data_ehd,$criteria);
            $update_em = $this->m_wsbangun->updateData_cons($cons,$table_em,$data_em,$criteria);
            $update_emdt = $this->m_wsbangun->updateData_cons($cons,$table_emdt,$data_emdt,$criteria);

            if($update_ehd == 'OK' && $update_em == 'OK' && $update_emdt == 'OK'  )
            {   
                $callback['Pesan'] = 'Close Berhasil';
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