<?php
class M_rl_sales extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';
    var $tablename = 'mgr.rl_sales';
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_last_ten_entries()
    {
        $DB2 = $this->load->database('ifca', TRUE);

        $query = $DB2->get($this->tablename, 10);
        return $query->result();
    }
    public function exec_sp2($var1 = NULL,$var2 = NULL, $var3 = NULL, $var4 = NULL, $var5 = NULL){
        $DB2 = $this->load->database('ifca', TRUE);
        $sp="mgr.x_cf_document_ctl_prefix ?,?,?,?,?";

        $params = array(
        'PARAM_1' => $var1,
        'PARAM_2' => $var2,
        'PARAM_3' => $var3,
        'PARAM_4' => $var4,
        'PARAM_5' => $var5);

        $result = $DB2->query($sp,$params);
        $result = $result->result();
        return $result;
    }
    function get_table_by_id($tablename=null,$data=null)
    {
        $DB2 = $this->load->database('ifca', TRUE);

        if ($data==null) {
             // $this->db->where($data);
            $query = $DB2->get($tablename);
            return $query->result();
        } else
        {
        $DB2->where($data);
        $query = $DB2->get($tablename);
        
                return $query->result();
            
        }
    }  
     function get_by_id($data=null)
    {
        $DB2 = $this->load->database('ifca', TRUE);

        if ($data==null) {
             // $this->db->where($data);
            $query = $DB2->get($this->tablename);
            return $query->result();
        } else
        {
        $DB2->where($data);
        $query = $this->db->get($this->tablename);
        return $query->result();
        }
    } 
    function get_data_name()
    {
        $DB2 = $this->load->database('ifca', TRUE);

        $data = $DB2->query("SELECT business_id,name  FROM mgr.cf_business ");

        // format keluaran di dalam array
        foreach($data->result() as $row)
        {
            // $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value'         =>$row->business_id.' - '.$row->name,
                'business_id'       =>$row->business_id,
                'name'  =>$row->name
            );
        }
        // minimal PHP 5.2
        // echo json_encode($arr);
        return $arr;
    }

    function insert($tablename=null,$data=null)
    {
        // $this->db->insert($this->tablename, $data); 
        $DB2 = $this->load->database('ifca', TRUE);

        $DB2->insert($tablename, $data); 
    }  

    function update($tablename=null,$data=null, $where=null)
    {
        $DB2 = $this->load->database('ifca', TRUE);

        $DB2->where($where);
        $DB2->update($tablename, $data);
    }

    function delete($tablename=null,$where=null)
    {
        $DB2 = $this->load->database('ifca', TRUE);

        $DB2->delete($tablename, $where); 
    }

    function get_range($namakolom=null,$tandabaca=null,$id=null)
    {
        $DB2 = $this->load->database('ifca', TRUE);

        $DB2->where($namakolom.$tandabaca,$id);
        $query = $DB2->get($this->tablename);
        return $query->result();
    }
    function exec_sp($sp_name=null,$param=null){
        $DB2 = $this->load->database('ifca', TRUE);

        $DB2->query($sp_name,array($param));
    }
  
}

?>