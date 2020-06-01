<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_attandance extends Core_Controller {

	function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    // DASHBOARD
	    public function dashboard(){
	        $group_cd = $this->session->userdata('Tsusergroup');

	    	if ($group_cd != 'ADMINWEB') {
	    		redirect('C_attandance/index');
	    	}
	    	else {
	    		$totaluser = $this->M_wsbangun->getData('IFCA', 'employee');
	    		$totaluser_cnt = count($totaluser);

	    		$reportDay = $this->M_wsbangun->getData('IFCA', 'v_attend_report_daily');
	    		$reportDay_cnt = count($reportDay);

	    		$notAttend = $totaluser_cnt - $reportDay_cnt;

	    		$content = array(
	    			'totaluser' 	=> $totaluser_cnt,
	    			'userAttend' 	=> $reportDay_cnt,
	    			'notAttend' 	=> $notAttend
	    		);

				$this->load_content_top_menu('dashboard/attendance', $content);
	    	}
	    	
	    }

	    public function getAttend(){
	        $this->load->library('Datatables');
	        $DB2 = $this->load->database('IFCA', TRUE);
	        $sql = 'SELECT * FROM v_attend_report_daily ';

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        // if ($res) {
	            $callback = $res;
	        // }
	        echo json_encode($callback);
	    }
    // DASHBOARD

    // ATTEND
		public function index(){
			$this->load_content_top_menu('attandance/index');
		}

		public function getTableAttend(){
	        $project 	= $this->session->userdata('Tsproject');        
	        $group 		= $this->session->userdata('Tsusergroup');
	        $email 		= $this->session->userdata('Tsemail');
	        $date 		= date("d M Y");
	        $callback 	= '';
        	$where = ' ';
	        if ($group != 'ADMINWEB') {
	        	$where = " AND email = '".$email."'";
	        }

	        $this->load->library('Datatables');
	        $DB2 = $this->load->database('IFCA', TRUE);
	        $sql = "SELECT * FROM v_attend_trx WHERE MONTH(day) = MONTH('$date') AND YEAR(day) = YEAR('$date') ".$where;

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        // var_dump($res);
	        // if ($res) {
	            $callback = $res;
	        // }
	        echo json_encode($callback);
	    }
	// ATTEND

	// EVENT
		public function event(){
			$this->load_content_top_menu('attandance/event');
		}

		public function getTableEvent(){
	        $project 	= $this->session->userdata('Tsproject');        
	        $group 		= $this->session->userdata('Tsusergroup');
	        $email 		= $this->session->userdata('Tsemail');
	        $date 		= date("d M Y");
	        $callback 	= '';
        	$where = ' ';
	        if ($group != 'ADMINWEB') {
	        	$where = " AND email = '".$email."'";
	        }

	        $this->load->library('Datatables');
	        $DB2 = $this->load->database('IFCA', TRUE);
	        $sql = "SELECT * FROM v_event_trx WHERE MONTH(event_date) = MONTH('$date') AND YEAR(event_date) = YEAR('$date') ".$where;

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        // var_dump($res);
	        // if ($res) {
	            $callback = $res;
	        // }
	        echo json_encode($callback);
	    }
	// EVENT

	// REPORT
		public function report(){
			$group_cd = $this->session->userdata('Tsusergroup');

	    	if ($group_cd != 'ADMINWEB') {
	    		redirect('C_attandance/index');
	    	}
	    	else {
		        $sql = "SELECT distinct employee_id, name from employee(nolock)";        
	            $dataEMP = $this->M_wsbangun->getData_by_query('IFCA',$sql);
	            $combo = array();
	            if(!empty($dataEMP)) {
	                $combo[] = '<option value="">Select Employee</option>';
	                foreach ($dataEMP as $key) {
	                    $combo[] = '<option  value="'.$key->employee_id.'" >'.$key->employee_id.' - '.$key->name.'</option>';
	                }
	                $combo = implode("", $combo);
	            }

	            $content = array(
	                'cmbEMP'=>$combo
	            );

				$this->load_content_top_menu('attandance/report', $content);
	    	}
		}

		public function getTableReport($id){
	        $date 		= date("d M Y");
	        $callback 	= array();

	        $sql = "
	        	SELECT employee_id, name, email, day, hour_in 
	        	FROM v_attend_trx 
	        	WHERE MONTH(day) = MONTH('$date') 
	        	AND YEAR(day) = YEAR('$date') 
	        	AND employee_id = '$id' 
	        ";

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        foreach ($res as $val) {
	        	$callback[] = array(
	        		'employee_id' 	=> $val->employee_id,
	        		'name' 			=> $val->name,
	        		'email' 		=> $val->email,
	        		'day' 			=> date_format(date_create($val->day), "d F Y"),
	        		'hour_in' 		=> date_format(date_create($val->hour_in), "H:i:s"),
	        	);
	        }
	        echo json_encode($callback);
	    }
	// REPORT

}