<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_api extends Core_Model {

	public function getData_by_query($con='',$sql=null){
        
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database($con, TRUE);
            $query = $DB2->query($sql);
            $res = $query->result();
            $DB2->close();
            return $res;
        } else {
            return null;
        }
    }

    public function updateData($con='',$object="", $data=null, $where=null){
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($con, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($data != null && $where != null) {
            $DB2->update($DB2->table_name, $data, $where);
            // var_dump($DB2);
            // if(!$DB2->trans_status()) {
            // if(!$DB2) {
            //     $msg = $DB2->_error_message();
                $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }
                // var_dump($msg);
            // }
        }
        return $msg;
    }

    public function insertData($con='',$object="", $data=null){
        $this->load->database();
        $msg = '';
        $DB2 = $this->load->database($con, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        // var_dump($DB2);
        if($data != null) {
            $ins = $DB2->insert($DB2->table_name, $data);
            // var_dump($ins);
            if(!$ins) {
                $msg = $DB2->error();
                $msg = $msg["message"];
            } else {
                // $msg = $query;
                $msg = 'OK';
            }
            $DB2->close();
            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }

    public function getCount_by_criteria($con='',$object="",$where=null, $like=null){
        $this->load->database();
    	$DB2 = $this->load->database($con, TRUE);
    	// $DB2->table_name = $DB2->username .'.'. $object;
        $DB2->table_name = 'mgr.'. $object.' with(nolock)';
    	if(!is_null($where)) {
    		$DB2->where($where);
    	} else if(!is_null($like)) {
    		$DB2->like($like);
    	}
    	$DB2->from($DB2->table_name);
    	return $DB2->count_all_results();
    }

    public function deletedata($con='',$object=null,$where=null){
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($con, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($where != null){
            $del = $DB2->delete($DB2->table_name, $where);
            if(!$del) {
                $msg = $DB2->error();
                $msg = $msg["message"];
            } else {
                // $msg = $query;
                $msg = 'OK';
            }
            $DB2->close();
            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }

}

/* End of file M_api.php */
/* Location: ./application/models/M_api.php */