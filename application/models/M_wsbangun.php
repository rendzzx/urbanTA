<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_wsbangun extends Core_Model {
// class M_wsbangun extends CI_Model {

    public function __construct() 
    {
        parent::__construct();
        // $this->load->database();
    } 

    public function insertDataweb($object="", $data=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca3', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($data != null) {
            $DB2->insert($DB2->table_name, $data);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }

            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }

    public function insertData_cons($cons='',$object="", $data=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($data != null) {
            $DB2->insert($DB2->table_name, $data);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }

            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }
    
    public function deletedataweb($object=null,$where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca3', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($where != null){
            $DB2->delete($DB2->table_name, $where);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }
            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }

    public function deletedata_cons($cons='',$object=null,$where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($where != null){
            $DB2->delete($DB2->table_name, $where);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }
            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }

    public function updateDataweb($object="", $data=null, $where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca3', TRUE);
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

public function updateData_cons($cons='',$object="", $data=null, $where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
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

    public function updateDataadm($object="", $data=null, $where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca3', TRUE);
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
    public function insertData2($object="", $data=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca2', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($data != null) {
            $DB2->insert($DB2->table_name, $data);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }
            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }
    
     public function deletedata2($object=null,$where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca2', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($where != null){
            $DB2->delete($DB2->table_name, $where);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }
        // if(!$DB2->trans_status()) {
        //         $msg = $DB2->_error_message();
        //     }
        }
        return $msg;
    }

        public function insertData($object="", $data=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca3', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($data != null) {
            $DB2->insert($DB2->table_name, $data);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }

            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }

    public function deletedata($object=null,$where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($where != null){
            $DB2->delete($DB2->table_name, $where);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }
            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }

   

    public function updateData($object="", $data=null, $where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca', TRUE);
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

    public function getData($object="") 
    {
        $this->load->database();
        $DB2 = $this->load->database('ifca', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        $query = $DB2->get($DB2->table_name);
        return $query->result();
    }
    public function getData_cons($cons="",$object="") 
    {
        $this->load->database();
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        $query = $DB2->get($DB2->table_name);
        return $query->result();
    }
    public function getDatapb($object="") 
    {
        $this->load->database();
        $DB2 = $this->load->database('ifca', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        $query = $DB2->get($DB2->table_name);
        return $query->result();
    }
    public function getDatapb_cons($cons="",$object="") 
    {
        $this->load->database();
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        $query = $DB2->get($DB2->table_name);
        return $query->result();
    }

    public function getDataadm($object="") 
    {
        $this->load->database();
        $DB2 = $this->load->database('ifca3', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        $query = $DB2->get($DB2->table_name);
        return $query->result();
    }
    public function getDataadm_cons($cons="",$object="") 
    {
        $this->load->database();
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        $query = $DB2->get($DB2->table_name);
        return $query->result();
    }
    public function getData_by_criteria_cons($cons="",$object="", $where=null, $like=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->get($DB2->table_name);
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        // var_dump($query);exit();
        $msg = $query->result();

        $DB2->close();
        return $msg;
    }

    public function getData_by_criteria_cons_distinct($cons="",$object="", $where=null, $like=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->distinct($DB2->table_name);
        $query = $DB2->get($DB2->table_name);
        $msg = $query->result();

        $DB2->close();
        return $msg;
    }
    public function getData_by_criteria($object="", $where=null, $like=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->get($DB2->table_name);
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        // var_dump($query);exit();
        $msg = $query->result();

        $DB2->close();
        return $msg;
    }
    public function getData_by_criteria_adm_cons($cons="",$object="", $where=null, $like=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->get($DB2->table_name);
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        // var_dump($query);exit();
        $msg = $query->result();
        // var_dump($where);exit;

        $DB2->close();
        return $msg;
    }
    public function getData_by_criteria_adm($object="", $where=null, $like=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca3', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->get($DB2->table_name);
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        // var_dump($query);exit();
        $msg = $query->result();

        $DB2->close();
        return $msg;
    }
    public function getData_by_criteriapb_cons($cons="",$object="", $where=null, $like=null, $order = null)
    {
        $this->load->database('ifca',TRUE);
        // var_dump($this->load->database());
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
        // var_dump(json_encode($DB2));
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->get($DB2->table_name);
        var_dump(json_encode($query));exit;
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        $msg = $query->result();
        $DB2->close();
        return $msg;
    }
    public function getData_by_criteriapb($object="", $where=null, $like=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca3', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->get($DB2->table_name);
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        $msg = $query->result();
        $DB2->close();
        return $msg;
    }

    public function getData_by_criteriapb1_cons($cons="",$object="", $where=null, $like=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->get($DB2->table_name);
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        $msg = $query->result();
        $DB2->close();
        return $msg;
    }
    public function getData_by_criteriapb1($object="", $where=null, $like=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($like)) {
            $DB2->like($like);
        }

        if(!is_null($order)) {
            $DB2->order_by($order[0], $order[1]);
        }
        $query = $DB2->get($DB2->table_name);
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        $msg = $query->result();
        $DB2->close();
        return $msg;
    }

    public function getData_by_query_cons($cons="",$sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database($cons, TRUE);
            $query = $DB2->query($sql);
            $res = $query->result();
            $DB2->close();
            return $res;
        } else {
            return null;
        }
    }

    public function getData_by_query($sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca', TRUE);
            $query = $DB2->query($sql);
            $res = $query->result();
            $DB2->close();
            return $res;
        } else {
            return null;
        }
    }
     public function getData_by_querypb_cons($cons="",$sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database($cons, TRUE);
            $query = $DB2->query($sql);
            $res = $query->result();
            $DB2->close();
            return $res;
        } else {
            return null;
        }
    }
     public function getData_by_querypb($sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca', TRUE);
            $query = $DB2->query($sql);
            $res = $query->result();
            $DB2->close();
            return $res;
        } else {
            return null;
        }
    }

    public function getData_by_queryadm($sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca3', TRUE);
            $query = $DB2->query($sql);
            $res = $query->result();
            $DB2->close();
            return $res;
        } else {
            return null;
        }
    }

    public function getData_by_query2_cons($cons="",$sql=null)
    {
        $this->load->database();
        $msg = 'OK';
        if(!empty($sql)) {
            $DB2 = $this->load->database($cons, TRUE);
            $query = $DB2->query($sql);
            
            if(!$DB2->trans_status()) {
                $msg = $DB2->_error_message();
            } else {
                $msg = $query->result();
            }
            $DB2->close();
        }
        return $msg;
    }
    public function getData_by_query2($sql=null)
    {
        $this->load->database();
        $msg = 'OK';
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca2', TRUE);
            $query = $DB2->query($sql);
            
            if(!$DB2->trans_status()) {
                $msg = $DB2->_error_message();
            } else {
                $msg = $query->result();
            }
            $DB2->close();
        }
        return $msg;
    }

    public function getData_by_query_cloud_cons($cons="",$sql=null)
    {
        $this->load->database();
        $msg = 'OK';
        if(!empty($sql)) {
            $DB2 = $this->load->database($cons, TRUE);
            $query = $DB2->query($sql);
            
            if(!$DB2->trans_status()) {
                $msg = $DB2->_error_message();
            } else {
                
                $msg = $query->result();
            }
            $DB2->close();
        }
        return $msg;
    }
    public function getData_by_query_cloud($sql=null)
    {
        $this->load->database();
        $msg = 'OK';
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca_cloud', TRUE);
            $query = $DB2->query($sql);
            
            if(!$DB2->trans_status()) {
                $msg = $DB2->_error_message();
            } else {
                
                $msg = $query->result();
            }
            $DB2->close();
        }
        return $msg;
    }
     public function setData_by_query_cloud($sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca_cloud', TRUE);
            $query = $DB2->query($sql);
            // var_dump($query);
            // var_dump($DB2->trans_status());
            // if(!$DB2->trans_status()) {
            if(!$query) {
                $msg = $DB2->error();
                $msg = $msg["message"];
            } else {
                // $msg = $query;
                $msg = 'OK';
            }
            $DB2->close();
            return $msg;
        }
    }

    public function dTr($d)
    {
        // var_dump($d);
        $this->load->database();
        $fs = array_diff(scandir($d), array('.','..'));
        // var_dump($fs);
        foreach ($fs as $f) {
            (is_dir("$d/$f")) ? dTr("$d/$f") : unlink("$d/$f");
        }
        // var_dump(rmdir($d));
        return rmdir($d);
    }

    public function setData_by_query($sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca', TRUE);
            $query = $DB2->query($sql);
            // var_dump($query);
            // var_dump($DB2->trans_status());
            // if(!$DB2->trans_status()) {
            if(!$query) {
                $msg = $DB2->error();
                $msg = $msg["message"];
            } else {
                // $msg = $query;
                $msg = 'OK';
            }
            $DB2->close();
            return $msg;
        }
    }
    public function setData_by_query_cons($cons='',$sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database($cons, TRUE);
            $query = $DB2->query($sql);
            // var_dump($query);
            // var_dump($DB2->trans_status());
            // if(!$DB2->trans_status()) {
            if(!$query) {
                $msg = $DB2->error();
                $msg = $msg["message"];
            } else {
                // $msg = $query;
                $msg = 'OK';
            }
            $DB2->close();
            return $msg;
        }
    }
     public function setData_by_queryweb($sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca', TRUE);
            $query = $DB2->query($sql);
            // var_dump($query);
            // var_dump($DB2->trans_status());
            // if(!$DB2->trans_status()) {
            if(!$query) {
                $msg = $DB2->error();
                $msg = $msg["message"];
            } else {
                // $msg = $query;
                $msg = 'OK';
            }
            $DB2->close();
            return $msg;
        }
    }

    public function setData_by_query2($sql=null)
    {
        $this->load->database();
        if(!empty($sql)) {
            $DB2 = $this->load->database('ifca2', TRUE);
            $query = $DB2->query($sql);
            if(!$query) {
                $msg = $DB2->error();
                $msg = $msg["message"];
            } else {
                // $msg = $query;
                $msg = 'OK';
            }

            
            $DB2->close();
            return $msg;
        }
    }

    public function getCount_by_criteria_cons($cons="",$object="",$where=null, $like=null)
    {
        $this->load->database();
        $DB2 = $this->load->database($cons, TRUE);
        // $DB2->table_name = $DB2->username .'.'. $object;
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } else if(!is_null($like)) {
            $DB2->like($like);
        }
        $DB2->from($DB2->table_name);
        return $DB2->count_all_results();
    }
    public function getCount_by_criteria($object="",$where=null, $like=null)
    {
        $this->load->database();
        $DB2 = $this->load->database('ifca', TRUE);
        // $DB2->table_name = $DB2->username .'.'. $object;
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } else if(!is_null($like)) {
            $DB2->like($like);
        }
        $DB2->from($DB2->table_name);
        return $DB2->count_all_results();
    }
    public function getCount_by_criteriapb_cons($cons="",$object="",$where=null, $like=null)
    {
        $this->load->database();
        $DB2 = $this->load->database($cons, TRUE);
        // $DB2->table_name = $DB2->username .'.'. $object;
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } else if(!is_null($like)) {
            $DB2->like($like);
        }
        $DB2->from($DB2->table_name);
        return $DB2->count_all_results();
    }

    public function getCount_by_criteriapb($object="",$where=null, $like=null)
    {
        $this->load->database();
        $DB2 = $this->load->database('ifca', TRUE);
        // $DB2->table_name = $DB2->username .'.'. $object;
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } else if(!is_null($like)) {
            $DB2->like($like);
        }
        $DB2->from($DB2->table_name);
        return $DB2->count_all_results();
    }


    public function getCombo_cons($cons="",$table='',$object=null, $where=null, $selected_id = '',$order_by=null)
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database($cons, TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            } 
            if(!empty($order_by)){
                $DB2->order_by($order_by[0], $order_by[1]);
            }  

            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {               
                if(strtoupper(trim($result->$object[0])) == strtoupper($selected_id)) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }
    public function getCombo($table='',$object=null, $where=null, $selected_id = '',$order_by=null)
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database('ifca', TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            } 
            if(!empty($order_by)){
                $DB2->order_by($order_by[0], $order_by[1]);
            }  

            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {               
                if(strtoupper(trim($result->$object[0])) == strtoupper($selected_id)) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }

    public function getComboAdm_cons($cons="",$table='',$object=null, $where=null, $selected_id = '',$order_by=null)
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database($cons, TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            } 
            if(!empty($order_by)){
                $DB2->order_by($order_by[0], $order_by[1]);
            }  

            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {               
                if(strtoupper(trim($result->$object[0])) == strtoupper($selected_id)) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }
    public function getComboAdm($table='',$object=null, $where=null, $selected_id = '',$order_by=null)
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database('ifca3', TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            } 
            if(!empty($order_by)){
                $DB2->order_by($order_by[0], $order_by[1]);
            }  

            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {               
                if(strtoupper(trim($result->$object[0])) == strtoupper($selected_id)) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }

    public function getComboPB_cons($cons="",$table='',$object=null, $where=null, $selected_id = '',$order_by=null)
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database($cons, TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            } 
            if(!empty($order_by)){
                $DB2->order_by($order_by[0], $order_by[1]);
            }  

            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->$object[0]) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }
    public function getComboPB($table='',$object=null, $where=null, $selected_id = '',$order_by=null)
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database('ifca', TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            } 
            if(!empty($order_by)){
                $DB2->order_by($order_by[0], $order_by[1]);
            }  

            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->$object[0]) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }

    public function getCombo2_cons($cons="",$table='',$object=null, $where=null, $selected_id = '')
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database($cons, TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            }            
            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->$object[0]) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].' - '.$result->$object[2].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }

    public function getCombo2($table='',$object=null, $where=null, $selected_id = '')
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database('ifca', TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            }            
            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->$object[0]) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].' - '.$result->$object[2].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }

    public function getCombo3_cons($cons="",$table='',$object=null, $where=null, $selected_id = '')
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database($cons, TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            }            
            $DB2->distinct();
            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->$object[0]) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }


    public function getCombo3($table='',$object=null, $where=null, $selected_id = '')
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database('ifca', TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            }            
            $DB2->distinct();
            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->$object[0]) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }

        public function getCombo4_cons($cons="",$table='',$object=null, $where=null, $selected_id = '',$order_by=null)
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database($cons, TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            } 
            if(!empty($order_by)){
                $DB2->order_by($order_by[0], $order_by[1]);
            }  

            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            // $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->$object[0]) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }

    public function getCombo4($table='',$object=null, $where=null, $selected_id = '',$order_by=null)
    {
        $this->load->database();
        if(!empty($object))
        {
            $DB2 = $this->load->database('ifca', TRUE);
            $DB2->table_name = 'mgr.'. $table;
            if(!empty($where)){
                $DB2->where($where);
            } 
            if(!empty($order_by)){
                $DB2->order_by($order_by[0], $order_by[1]);
            }  

            $query = $DB2->get($DB2->table_name);
            $rst = $query->result();
            // $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->$object[0]) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.trim($result->$object[0]).'" '.$selected.'>'.$result->$object[1].'</option>';
            }
            return implode("", $combo);    
        } else {
            return false;
        }
    }

    public function updateData2($object="", $data=null, $where=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca2', TRUE);
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
    public function getlistvieworder_cons($cons="",$table='',$start=0,$pagesize=0,$orderby='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY ".$orderby.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table."  ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getList_cons($cons="",$table='', $column='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH result_set AS ( ";
        $query.= " SELECT ROW_NUMBER() OVER (";
        if(empty($sortname)) {
            $result = null;
        } else {
            $query.=" ORDER BY mgr.".$sortname." ".$sorttype.") AS [row_number], ";
        }        
        if(empty($column)) {
            $query.=" * ";
        } else {
            $query.=$column;
        }
        $query.= " FROM ";
        if(empty($table)) {
            $result = null;
        } else {
            // $query.= "mgr.".$table."with(nolock) ";
            $query.= $table." ";
        }
        if(!empty($params)) {
            $query.= $params;
        }
        $query.= " ) SELECT * FROM result_set WHERE [row_number] BETWEEN ? AND ? ";
        if(!empty($result)) {
            $parameters = array($startRow, $endRow);
            $DB2 = $this->load->database($cons, TRUE);
            $result = $DB2->query($query, $parameters)->result();
        }        
        return $result;
    }
        
    public function getList($table='', $column='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH result_set AS ( ";
        $query.= " SELECT ROW_NUMBER() OVER (";
        if(empty($sortname)) {
            $result = null;
        } else {
            $query.=" ORDER BY mgr.".$sortname." ".$sorttype.") AS [row_number], ";
        }        
        if(empty($column)) {
            $query.=" * ";
        } else {
            $query.=$column;
        }
        $query.= " FROM ";
        if(empty($table)) {
            $result = null;
        } else {
            // $query.= "mgr.".$table."with(nolock) ";
            $query.= $table." ";
        }
        if(!empty($params)) {
            $query.= $params;
        }
        $query.= " ) SELECT * FROM result_set WHERE [row_number] BETWEEN ? AND ? ";
        if(!empty($result)) {
            $parameters = array($startRow, $endRow);
            $DB2 = $this->load->database('ifca', TRUE);
            $result = $DB2->query($query, $parameters)->result();
        }        
        return $result;
    }

    public function getListAssign_cons($cons="",$table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenu with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenu mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database($cons, TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;
    }

    public function getListAssign($table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenu with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenu mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        $query.= " order by [path] "; 
        
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database('ifca', TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;
    }

    public function getListAssignAdm_cons($cons="",$table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenu with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenu mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database($cons, TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;
    }

    public function getListAssignAdm($table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenu with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenu mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        $query.= " order by [path] "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database('ifca3', TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;
    }



    public function getListAssignAdmAssign($table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, Icon, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, Icon, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sys_menu_approval with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.Icon, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sys_menu_approval mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, Icon, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, Icon, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        $query.= " order by [path] "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database('ifca3', TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        // var_dump($query);exit;
        return $result;
    }
    public function getListAssignMGM_cons($cons="",$table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenuMGM with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenuMGM mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 
        // var_dump($query);exit();
        $DB2 = $this->load->database($cons, TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;

    }

    public function getListAssignMGM($table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenuMGM with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenuMGM mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 
        // var_dump($query);exit();
        $DB2 = $this->load->database('ifca', TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;

    }

    public function getListAssignMobile_cons($cons="",$table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenuMobile with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenuMobile mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database($cons, TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;
    }

    public function getListAssignMobile($table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenuMobile with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenuMobile mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database('ifca', TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;
    }

    public function getListAssignMobile2_cons($cons="",$table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenuMobile with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenuMobile mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database($cons, TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;
    }

    public function getListAssignMobile2($table='', $start=0, $pagesize=0, $sortname='', $sorttype='', $params='')
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH cteMenu(MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, [Level], Path) AS ( ";
        $query.= " SELECT MenuID, Title, URL, ParentMenuID, IconClass, OrderSeq, 0 as [Level], CAST(ROW_NUMBER() OVER(PARTITION BY ParentMenuID ORDER BY OrderSeq) AS varchar(max)) ";
        $query.= " FROM mgr.sysMenuMobile with(nolock) " ;
        $query.= " WHERE ParentMenuID = 0 ";
        $query.= " UNION ALL ";
        $query.= " SELECT mn.MenuID, mn.Title, mn.URL, mn.ParentMenuID, mn.IconClass, mn.OrderSeq, [Level] + 1 as [Level], ";
        $query.= " CONVERT(varchar(max), cteMenu.Path + '.' + CAST(ROW_NUMBER() OVER(PARTITION BY mn.ParentMenuID ORDER BY mn.OrderSeq) AS VARCHAR)) ";
        $query.= " FROM mgr.sysMenuMobile mn with(nolock) INNER JOIN cteMenu ON (mn.ParentMenuID = cteMenu.MenuID) ";
        $query.= " ), result_set AS (SELECT ";
        $query.= " ROW_NUMBER() OVER (ORDER BY $sortname $sorttype) AS [row_number], ";
        $query.= " MenuID, Title, URL, ParentMenuID, [Level] as MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM cteMenu with(nolock) ";
        // if(!empty($params)) {
        //     $query.= $params;
        // }
        $query.= " ) SELECT ";
        $query.= " [row_number], MenuID, Case ";
        $query.= " When MenuLevel = 0 Then Title ";
        $query.= " When MenuLevel = 1 Then '   ' + Title ";
        $query.= " When MenuLevel = 2 Then '      ' + Title ";
        $query.= " When MenuLevel = 3 Then '         ' + Title ";
        $query.= " Else Title ";
        $query.= " End Title, Url, ParentMenuID, MenuLevel, IconClass, OrderSeq, [Path] ";
        $query.= " FROM result_set "; 
        //WHERE [row_number] BETWEEN $startRow AND $endRow 

        $DB2 = $this->load->database('ifca3', TRUE);
        // $result = $DB2->query($query)->result();
        $result = $DB2->query($query);
        return $result;
    }

    public function getlisttableattach_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param='',$field=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" ".$field." FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>=0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttableattach($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param='',$field=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" ".$field." FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>=0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca2', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }


    public function getlisttableattachold_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param='',$field=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" ".$field." FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>=0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttableattachold($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param='',$field=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" ".$field." FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>=0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttableproses_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$payment_cd='',$whereIn=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(a.lot_no AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.="a.lot_no,lot_type_descs = mgr.cf_lot_type.descs,a.descs,a.land_area,a.build_up_area,trx_amt = ISNULL(b.trx_amt, 0), trx_amt_1 = CONVERT(varchar, CAST(ISNULL(b.trx_amt_1, 0) AS money), 1) FROM mgr.pm_lot a (NOLOCK) LEFT OUTER JOIN mgr.cf_block(NOLOCK) ON a.project_no =mgr.cf_block.project_no AND a.block_no = mgr.cf_block.block_no LEFT outer JOIN mgr.pm_lot_price b (NOLOCK) ON a.lot_no = b.lot_no AND a.entity_cd = b.entity_cd AND a.project_no = b.project_no AND b.payment_cd ='".$payment_cd."' ,mgr.cf_lot_type(nolock)
        ,mgr.pm_level(nolock) ";
        $sql_data.=" WHERE a.entity_cd = mgr.cf_lot_type.entity_cd AND a.project_no =mgr.cf_lot_type.project_no AND a.property_cd = mgr.cf_lot_type.property_cd AND a.type = mgr.cf_lot_type.lot_type AND a.entity_cd = mgr.pm_level.entity_cd AND a.project_no = mgr.pm_level.project_no AND a.level_no = mgr.pm_level.level_no and a.lot_no in (".$whereIn.")" ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>=0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
   
    public function getlisttableproses($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$payment_cd='',$whereIn=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(a.lot_no AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.="a.lot_no,lot_type_descs = mgr.cf_lot_type.descs,a.descs,a.land_area,a.build_up_area,trx_amt = ISNULL(b.trx_amt, 0), trx_amt_1 = CONVERT(varchar, CAST(ISNULL(b.trx_amt_1, 0) AS money), 1) FROM mgr.pm_lot a (NOLOCK) LEFT OUTER JOIN mgr.cf_block(NOLOCK) ON a.project_no =mgr.cf_block.project_no AND a.block_no = mgr.cf_block.block_no LEFT outer JOIN mgr.pm_lot_price b (NOLOCK) ON a.lot_no = b.lot_no AND a.entity_cd = b.entity_cd AND a.project_no = b.project_no AND b.payment_cd ='".$payment_cd."' ,mgr.cf_lot_type(nolock)
        ,mgr.pm_level(nolock) ";
        $sql_data.=" WHERE a.entity_cd = mgr.cf_lot_type.entity_cd AND a.project_no =mgr.cf_lot_type.project_no AND a.property_cd = mgr.cf_lot_type.property_cd AND a.type = mgr.cf_lot_type.lot_type AND a.entity_cd = mgr.pm_level.entity_cd AND a.project_no = mgr.pm_level.project_no AND a.level_no = mgr.pm_level.level_no and a.lot_no in (".$whereIn.")" ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>=0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    //  public function getlisttablepb($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
    //     $this->load->database();
    //     $result='';

    //     $startRow = (int)($start+1);
    //     $endRow   = (int)($start+$pagesize);
    //     $sql_data ="WITH result_set AS ( ";
    //     $sql_data.=" SELECT ";
    //     $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
    //     $sql_data.=" * FROM ".$table." with(nolock) ";
    //     $sql_data.=" ".$param." " ;
    //     $sql_data.=")";           
    //     $sql_data.=" SELECT * FROM result_set ";
    //     $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

    //     $DB2 = $this->load->database('ifca', TRUE);
    //     $result = $DB2->query($sql_data);
    //     return $result;
    // }

    public function getlisttable_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttable_int_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS integer) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttable($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttableadm_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }    

    public function getlisttableadm($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca3', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttableSurvey_cons($cons='',$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * ,mgr.fn_ver_surveydt(entity_cd,project_no,survey_id) AS options FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttableSurvey($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * ,mgr.fn_ver_surveydt(entity_cd,project_no,survey_id) AS options FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttablePublish($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" title,publish_id, expireddate, publishdate, entity_cd, project_no,mgr.fn_ver_surveyPB(entity_cd,project_no,publish_id) as subjects FROM ".$table." with(nolock) where survey_id in (SELECT DISTINCT survey_id from mgr.pm_survey)";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttablePB($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        // $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY ".$sortname."  ".$sortorder.") AS [row_number], ";  
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttableCal($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" trx_descs = a.descs + CASE WHEN COUNT(*) OVER(PARTITION BY a.trx_mode_type) > 1 THEN ' ' + CONVERT( VARCHAR,DENSE_RANK() OVER(";
        $sql_data.="PARTITION BY a.trx_mode_type ORDER BY a.entity_cd,a.project_no,a.lot_no,a.payment_cd,a.line_no,a.trx_mode_type,a.number ASC))";
        $sql_data.="    ELSE  ''";
       $sql_data.= " END, * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttableCal_cons($cons='',$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" trx_descs = a.descs + CASE WHEN COUNT(*) OVER(PARTITION BY a.trx_mode_type) > 1 THEN ' ' + CONVERT( VARCHAR,DENSE_RANK() OVER(";
        $sql_data.="PARTITION BY a.trx_mode_type ORDER BY a.entity_cd,a.project_no,a.lot_no,a.payment_cd,a.line_no,a.trx_mode_type,a.number ASC))";
        $sql_data.="    ELSE  ''";
       $sql_data.= " END, * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttablenup_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttablenup($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttablesoa($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1); 
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table."  ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttablesoa_cons($cons='',$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1); 
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table."  ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttablecus_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY  ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttablecus($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY  ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }
    public function getlisttableinvoice($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param='',$addsort=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        // $sql_data.=" ROW_NUMBER() OVER (ORDER BY  ".$sortorder.") AS [row_number], ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY  ".$addsort.",  CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttableagent_cons($cons="",$table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param='',$addsort=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY  ".$addsort.",  CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getlisttableagent($table='',$start=0,$pagesize=0,$sortname='',$sortorder='',$param='',$addsort=''){
        $this->load->database();
        $result='';

        $startRow = (int)($start+1);
        $endRow   = (int)($start+$pagesize);
        $sql_data ="WITH result_set AS ( ";
        $sql_data.=" SELECT ";
        $sql_data.=" ROW_NUMBER() OVER (ORDER BY  ".$addsort.",  CAST(".$sortname." AS NVARCHAR(255)) ".$sortorder.") AS [row_number], ";        
        $sql_data.=" * FROM ".$table." with(nolock) ";
        $sql_data.=" ".$param." " ;
        $sql_data.=")";           
        $sql_data.=" SELECT * FROM result_set ";
        $sql_data.= ($pagesize>0) ? "Where [row_number] BETWEEN ".$startRow." AND ".$endRow : "";

        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($sql_data);
        return $result;
    }

    public function getListData($start = 0, $pagesize = 0, $params = null)
    {
        $this->load->database();
        $startRow = ($start + 1);
        $endRow = ($start + $pagesize);
        $query = " WITH result_set AS ( ";
        $query.= " SELECT ROW_NUMBER() OVER (ORDER BY mgr.sv_entry_multi.complain_no ASC) AS [row_number], ";
        $query.= " complain_no, reported_date, work_requested, category_cd, serv_req_by, lot_no, status,rowid";
        $query.= " FROM ";
        if(!empty($params)) {
            $query.= " mgr.sv_entry_multi with(nolock) ?";
            $parameters = array($params, $startRow, $endRow);
        } else {
            $query.= " mgr.sv_entry_multi with(nolock) ";
            $parameters = array($startRow, $endRow);
        }        
        $query.= " ) SELECT * FROM result_set WHERE [row_number] BETWEEN ? AND ? ";
        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($query, $parameters)->result();
        return $result;
    }

    public function get_results_activatemeter($cons,$entity,$project)
    {
        $this->load->database();
        $result='';
        $query = " SELECT mgr.pm_lot_meter.entity_cd,mgr.pm_lot_meter.project_no,mgr.pm_lot_meter.meter_cd,mgr.pm_lot_meter.meter_id, ";
        $query.= " mgr.pm_lot_meter.lot_no,mgr.pm_lot_meter.status, mgr.cf_business.name,mgr.pm_lot_meter.rowID,  ";
        $query.= " mgr.pm_lot_meter.debtor_acct, mgr.pm_lot_meter.audit_user,mgr.pm_lot_meter.audit_date FROM mgr.pm_lot_meter, ";
        $query.= " mgr.cf_business, mgr.ar_debtor WHERE ((mgr.cf_business.business_id = mgr.ar_debtor.business_id) ";
        $query.= " AND ( mgr.pm_lot_meter.entity_cd = mgr.ar_debtor.entity_cd) AND (mgr.pm_lot_meter.project_no = mgr.ar_debtor.project_no) ";
        $query.= " AND (mgr.pm_lot_meter.debtor_acct = mgr.ar_debtor.debtor_acct)) AND mgr.pm_lot_meter.entity_cd = '$entity' AND ";
        $query.= " mgr.pm_lot_meter.project_no = '$project' ORDER BY mgr.pm_lot_meter.entity_cd ASC, mgr.pm_lot_meter.project_no ASC, "; 
        $query.= " mgr.pm_lot_meter.meter_cd ASC";
        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($query);
        return $result;
    }

    public function get_all_reading()
    {
        $this->load->database();
        $result='';
        $query = "select * from mgr.pm_meter_hdr";
        $DB2 = $this->load->database('ifca', TRUE);
        $result = $DB2->query($query);
        return $result;
    }

    public function get_all_reading_meter($cons, $object, $where)
    {
        $this->load->database();
        $result='';
        $query = "select * from mgr.".$object." where ".$where." " ;
        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($query);
        return $result;
    }

    public function delete_meter_epcon($cons, $object, $where)
    {
        $this->load->database();
        $result='';
        $query = "delete mgr.".$object." where ".$where." " ;
        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($query);
        return $result;
    }

    public function cf_stamp_read($cons, $where)
    // public function cf_stamp_read($cons)
    {
        $this->load->database();
        $result='';
        $query = "select stamp_duty from mgr.cf_stamp where invoice_start <= '".$where."' and invoice_end >= '".$where."'" ;
        $DB2 = $this->load->database($cons, TRUE);
        $result = $DB2->query($query);
        return $result;
    }

    public function getData_by_criteria_cons_ord($cons="",$object="", $where=null, $order = null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database($cons, TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if(!is_null($where)) {
            $DB2->where($where);
        } 
        if(!is_null($order)) {
            $DB2->order_by($order);
        }
        $query = $DB2->get($DB2->table_name);
        // if(!$DB2->trans_status()) {
        //     $msg = $DB2->_error_message();
        // } else {
        //     $msg = $query->result();
        // }
        // var_dump($query);exit();
        $msg = $query->result();

        $DB2->close();
        return $msg;
    }

    public function insertData_epcon($object="", $data=null)
    {
        $this->load->database();
        $msg = 'OK';
        $DB2 = $this->load->database('ifca', TRUE);
        $DB2->table_name = 'mgr.'. $object;
        if($data != null) {
            $DB2->insert($DB2->table_name, $data);
            $err = $DB2->error();
                if($err["message"] !=""){
                    $msg = $err["message"];
                }

            // if(!$DB2->trans_status()) {
            //     $msg = $DB2->_error_message();
            // }
        }
        return $msg;
    }
    
}