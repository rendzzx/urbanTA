<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_wsbangun extends Core_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // ========================== SELECT DATA
        public function getData($cons, $table="") {
            $db2 = $this->load->database($cons, TRUE);
            $data = $db2->get($table);
            if ($data) {
                return $data->result();
            }
            else{
                return false;
            }
        }

        public function getData_by_query($cons, $sql=null){
            $db2 = $this->load->database($cons, TRUE);
            if(!empty($sql)) {
                $query = $db2->query($sql);
                $res = $query->result();
                return $res;
            } else {
                return null;
            }
        }

        public function getData_by_criteria($cons, $table="", $where=null, $like=null, $order = null){
            $db2 = $this->load->database($cons, TRUE);
            if(!is_null($where)) {
                $db2->where($where);
            } 
            if(!is_null($like)) {
                $db2->like($like);
            }
            if(!is_null($order)) {
                $db2->order_by($order[0], $order[1]);
            }
            $query = $db2->get($table);
            $res = $query->result();
            if ($res) {
                return $res;
            }
            else{
                return false;
            }
        }
    // ========================== SELECT DATA

    // ========================== INSERT DATA
        public function insertData($cons, $table="", $data=null){
            $this->load->database();
            $db2 = $this->load->database($cons, TRUE);
            if($data != null) {
                $db2->insert($table, $data);
                $err = $db2->error();
                if($err["message"] !=""){
                    return false;
                }
                else{
                    return true;
                }
            }
        }
    // ========================== INSERT DATA

    // ========================== UPDATE DATA
        public function updateData($cons, $table="", $data=null, $where=null){
            $this->load->database();
            $db2 = $this->load->database($cons, TRUE);
            if($data != null && $where != null) {
                $db2->update( $table, $data, $where);
                $err = $db2->error();
                if($err["message"] !=""){
                    return false;
                }
                else{
                    return true;
                }
            }
        }
    // ========================== UPDATE DATA

    // ========================== DELETE DATA
        public function deleteData($cons, $table=null,$where=null){
            $this->load->database();
            $db2 = $this->load->database($cons, TRUE);
            if($where != null){
                $db2->delete($table, $where);
                $err = $db2->error();
                if($err["message"] !=""){
                    return false;
                }
                else{
                    return true;
                }
            }
        }
    // ========================== DELETE DATA
}