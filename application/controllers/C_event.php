<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_event extends Core_Controller {

	function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    // DASHBOARD
    	public function dashboard(){
	        $group_cd = $this->session->userdata('Tsusergroup');

	    	if ($group_cd != 'ADMINWEB') {
	    		redirect('C_event/index');
	    	}
	    	else {
		        $date 		= date("d M Y");

	    		$event = $this->M_wsbangun->getData('IFCA', 'event');
	    		$totalevent = count($event);

	    		$sqlsoon = "SELECT * FROM event WHERE event_date > '$date' AND status = 1";
		        $soon = $this->M_wsbangun->getData_by_query('IFCA', $sqlsoon);
		        $totalsoon = count($soon);

		        $sqlcancle = "SELECT * FROM event WHERE event_date > '$date' AND status = 0";
		        $cancle = $this->M_wsbangun->getData_by_query('IFCA', $sqlcancle);
		        $totalcancle = count($cancle);


	    		$content = array(
	    			'totalevent' 	=> $totalevent,
	    			'totalsoon'		=> $totalsoon,
	    			'totalcancle'	=> $totalcancle
	    		);

				$this->load_content_top_menu('dashboard/event', $content);
	    	}
	    }
	// DASHBOARD

	// TODAY
		public function index(){
			$this->load_content_top_menu('event/index');
		}

		public function getTableToday(){
			$date = date('d M Y');
	        $sql = "
	        	SELECT * FROM event 
        		WHERE DAY(event_date) = DAY('$date')
				AND MONTH(event_date) = MONTH('$date')
				AND YEAR(event_date) = YEAR('$date')
				AND status = 1
			";

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        // var_dump($res);
	        // if ($res) {
	            $callback = $res;
	        // }
	        echo json_encode($callback);
	    }
	// TODAY

	// ALL
		public function all(){
			$group_cd = $this->session->userdata('Tsusergroup');

	    	if ($group_cd != 'ADMINWEB') {
	    		redirect('C_event/index');
	    	}
	    	else{
				$this->load_content_top_menu('event/all');
	    	}
		}

		public function getTableAll(){
	        $sql = "SELECT * FROM event ";

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        // var_dump($res);
	        // if ($res) {
	            $callback = $res;
	        // }
	        echo json_encode($callback);
	    }

	    public function addnew(){
	    	$this->load->view('event/all_add');
	    }

	    public function getByID($id=''){
	        $where=array('event_id'=>$id);
	        $data = $this->M_wsbangun->getData_by_criteria('IFCA','event',$where);
	        $callback = array(
	        	'event_id' 			=> $data[0]->event_id,
	        	'event_name' 		=> $data[0]->event_name,
	        	'event_descs' 		=> $data[0]->event_descs,
	        	'event_date' 		=> date_format(date_create($data[0]->event_date), "Y-m-d"),
	        	'event_location' 	=> $data[0]->event_location,
	        	'event_latitude' 	=> $data[0]->event_latitude,
	        	'event_longitude' 	=> $data[0]->event_longitude,
	        );
	        echo json_encode($callback);
	    }

	    public function save(){
	    	$callback = array(
                'Data' => null,
                'Message' => null,
                'Error' => false
            );
            if ($_POST) {
            	$event_id 			= $this->input->post('event_id', TRUE);
            	$event_name 		= $this->input->post('name', TRUE);
            	$event_descs 		= $this->input->post('descs', TRUE);
            	$event_date 		= $this->input->post('event_date', TRUE);
            	$event_date			= date('d M Y', strtotime($event_date));
            	$event_location 	= $this->input->post('event_location', TRUE);
            	$event_latitude 	= $this->input->post('event_latitude', TRUE);
            	$event_longitude 	= $this->input->post('event_longitude', TRUE);

            	if (empty($event_id)) {
            		$make_eventid = makeID('event_id', 'event', 'EVN');
            		$data = array(
            			'event_id' 			=> $make_eventid,
            			'event_name' 		=> $event_name,
            			'event_descs' 		=> $event_descs,
            			'event_date' 		=> $event_date,
            			'event_location' 	=> $event_location,
            			'event_latitude' 	=> $event_latitude,
            			'event_longitude' 	=> $event_longitude,
            			'status'			=> 1
            		);

            		$insert = $this->M_wsbangun->insertData('IFCA', 'event', $data);
            		if ($insert) {
            			$callback['Message'] = 'Success Insert Event';
            			$callback['Data'] = $insert;
            		}
            		else{
            			$callback['Data'] = $insert;
            			$callback['Message'] = 'Insert Event Failed';
            			$callback['Error'] = true;
            		}
            	}
            	else{
            		$data = array(
            			'event_name' => $event_name,
            			'event_descs' => $event_descs,
            			'event_date' => $event_date,
            			'event_location' => $event_location,
            			'event_latitude' => $event_latitude,
            			'event_longitude' => $event_longitude,
            		);
            		$where = array('event_id' => $event_id);

            		$update = $this->M_wsbangun->updateData('IFCA', 'event', $data, $where);
            		if ($update) {
            			$callback['Message'] = 'Success Update Event';
            			$callback['Data'] = $update;
            		}
            		else{
            			$callback['Data'] = $update;
            			$callback['Message'] = 'Update Event Failed';
            			$callback['Error'] = true;
            		}
            	}
            }
            else{
            	$callback['Error'] = true;
            	$callback['Message'] = 'data not valid';
            }
	    	echo json_encode($callback);
	    }

	    public function delete(){
	    	$callback = array(
	            'Data' => null,
	            'Message' => null,
	            'Error' => false
	        );
	        if ($_POST) {
	            $id 	= $this->input->post("id",true);
	            $data 	= array('status' => 0);
	            $where 	= array('event_id' => $id);

	            $delemp = $this->M_wsbangun->updateData('IFCA', 'event', $data, $where);
	            if ($delemp) {
                    $callback['Message'] = "event has been deactivated";
	            }
	            else {
	                $callback['Message'] = $delemp;
	                $callback['Error'] = true;
	            }
	        }
	        echo json_encode($callback);
	    }
	// ALL

	// COMINGSOON
		public function comingsoon(){
			$this->load_content_top_menu('event/comingsoon');
		}

		public function getTableSoon(){
			$date = date('d M Y');
	        $sql = "
	        	SELECT * FROM event 
        		WHERE event_date > '$date'
        		AND status = 1
			";

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        // var_dump($res);
	        // if ($res) {
	            $callback = $res;
	        // }
	        echo json_encode($callback);
	    }
	// COMINGSOON

	// HISTORY
		public function history(){
			$this->load_content_top_menu('event/history');
		}

		public function getTableHis(){
			$date = date('d M Y');
	        $sql = "
	        	SELECT * FROM event 
        		WHERE event_date < '$date'
        		AND status = 1
			";

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        // var_dump($res);
	        // if ($res) {
	            $callback = $res;
	        // }
	        echo json_encode($callback);
	    }
	// HISTORY

	// CANCLE
		public function cancle(){
			$this->load_content_top_menu('event/cancle');
		}

		public function getTableCan(){
	        $sql = "
	        	SELECT * FROM event 
        		WHERE status = 0
			";

	        $res = $this->M_wsbangun->getData_by_query('IFCA', $sql);
	        // var_dump($res);
	        // if ($res) {
	            $callback = $res;
	        // }
	        echo json_encode($callback);
	    }
	// CANCLE

	public function report(){
		$this->load_content_top_menu('event/report');
	}
}