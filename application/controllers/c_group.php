<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_group extends Core_Controller{
	public function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
    	$this->load_content_top_menu('group/index');
    }

    public function getTable(){
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('IFCA', TRUE);
        $table = 'sysgroup';

        $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table);
        if ($res) {
            $callback = $res;
        }
        echo json_encode($callback);
    }
      
    public function addnew($id=""){
        $this->load->view('group/add');
    }

    public function getByID($GroupID=''){
        $where=array('GroupID'=>$GroupID);
        $data = $this->M_wsbangun->getData_by_criteria('IFCA','sysgroup',$where);
        echo json_encode($data);
    }

    public function save(){
        $callback = array(
            'Data' => null,
            'Message' => null,
            'Error' => false
        );
        if ($_POST){
            $GroupID = $this->input->post('txtGroupID', true);
            $GroupCD = $this->input->post('txtGroupCD',TRUE);
            $GroupDescs =$this->input->post('txtGroupDescs',TRUE);
            $dashboard ='sub-group ADMINWEB';;
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');

            if(empty($GroupID)){
                $GroupID = 0;
            }
                
            $data = array(          
                'dashboard_url' => $dashboard,
                'group_cd' => $GroupCD,
                'group_descs' => $GroupDescs,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
            );            
            
            $criteria = array('GroupID' => $GroupID);
            if($GroupID>0) {
                $data = $this->M_wsbangun->updateData('IFCA', 'sysgroup',$data, $criteria);
                if($data){
                    $callback['Message'] ="Data has been updated successfully";
                }
                else{
                    $callback['Message'] = $data;
                    $callback['Error'] = true;
                }
            }
            else{
                $data = $this->M_wsbangun->insertData('IFCA', 'sysgroup',$data);
                if($data){
                    $callback['Message'] = "Data has been saved successfully";
                }
                else{
                    $callback['Message'] = $data;
                    $callback['Error'] = true;
                }  
            }
        } //tutup post
        else{
            $callback['Error'] = true;
            $callback['Message'] = "Data validation is not valid";
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
            $id = $this->input->post("id",true);
            $where = array('GroupID'=>$id);

            $del = $this->M_wsbangun->deleteData('IFCA', 'sysgroup', $where);
            if ($del) {
                $callback['Message'] = "Data has been deleted successfully";
            }
            else {
                $callback['Message'] = $del;
                $callback['Error'] = true;
            }
        }
        echo json_encode($callback);
    }
}