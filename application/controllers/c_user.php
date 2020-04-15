<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends Core_Controller {
	public function __construct(){
        parent::__construct();
        $this->auth_check();
    }

	public function index(){
		$this->load_content_top_menu('user/index');
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
        $table = 'v_employee_user';

        $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table);
        if ($res) {
            $callback = $res;
        }
        echo json_encode($callback);
    }
      
    public function addnew(){
        $this->load->view('user/add');
    }

    public function getByID($id=''){
        $where=array('userID'=>$id);
        $data = $this->M_wsbangun->getData_by_criteria('IFCA','v_employee_user',$where);
        echo json_encode($data);
    }

    public function save(){
        $callback = array(
            'Data' => null,
            'Message' => null,
            'Error' => false
        );
        if ($_POST){
            $userid = $this->input->post('userid', true);
            $email = $this->input->post('email', true);
            $group = $this->input->post('group', true);
            $agent = $this->input->post('agent', true);
            $debtor = $this->input->post('debtor', true);

            $employeeid = $this->input->post('employeeid', true);
            $name = $this->input->post('name', true);
            $address = $this->input->post('address', true);
            $gender = $this->input->post('gender', true);
            $handphone = $this->input->post('handphone', true);
            $nik = $this->input->post('nik', true);
            $npwp = $this->input->post('npwp', true);
            $bankacc = $this->input->post('bankacc', true);
            $division = $this->input->post('division', true);
            $postition = $this->input->post('postition', true);
            $salary = $this->input->post('salary', true);
            
            $password = $this->input->post('password', true);

            $datauser = array(          
                'userID' 		=> $userid,
                'email' 		=> $email,
                'name'			=> $name,
                'Group_Cd' 		=> $group,
                'agent_cd'		=> $agent,
                'debtor_acct'	=> $debtor
            );
            $where = array('userID' => $userid);

            $dataemp = array(
            	'userID' 		=> $userid,
            	'employee_id' 	=> $employeeid,
            	'name' 			=> $name,
            	'address' 		=> $address,
            	'gender' 		=> $gender,
            	'handphone' 	=> $handphone,
            	'nik' 			=> $nik,
            	'npwp' 			=> $npwp,
            	'bank_acct' 	=> $bankacc,
            	'division_cd' 	=> $division,
            	'postition_cd' 	=> $postition,
            	'base_salary' 	=> $base_salary,
            );

            $datapass = array(
            	'password' 	=> $password,
            	'COM'		=> $password
            );
            
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

/* End of file C_user.php */
/* Location: ./application/controllers/C_user.php */