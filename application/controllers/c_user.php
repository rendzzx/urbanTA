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

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

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
        $division   = $this->zoom_division();
        $postition  = $this->zoom_postition();
        $group      = $this->zoom_group();

        $content = array(
            'division'  => $division,
            'postition' => $postition,
            'group'     => $group
        );

        $this->load->view('user/add', $content);
    }

    public function zoom_division(){
        $division = $this->M_wsbangun->getData('IFCA','division');
        $res[] = '';
        if(!empty($division)) {
            foreach ($division as $values) {
                $res[] = '<option value="'.$values->division_cd.'">'.$values->division_name.'</option>';
            }
            $res = implode("", $res);
        }
        return $res;
    }

    public function zoom_postition(){
        $postition = $this->M_wsbangun->getData('IFCA','postition');
        $res[] = '';
        if(!empty($postition)) {
            foreach ($postition as $values) {
                $res[] = '<option value="'.$values->postition_cd.'">'.$values->postition_name.'</option>';
            }
            $res = implode("", $res);
        }
        return $res;
    }

    public function zoom_group(){
        $group = $this->M_wsbangun->getData('IFCA','sysGroup');
        $res[] = '';
        if(!empty($group)) {
            foreach ($group as $values) {
                $res[] = '<option value="'.$values->group_cd.'">'.$values->group_cd.' - '.$values->group_descs.'</option>';
            }
            $res = implode("", $res);
        }
        return $res;
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
            // DATA POST
                $userid = $this->input->post('userid', true);
                $employeeid = $this->input->post('employeeid', true);

                $email = $this->input->post('email', true);
                $group = $this->input->post('group', true);

                $name = $this->input->post('name', true);
                $address = $this->input->post('address', true);
                $gender = $this->input->post('gender', true);
                $handphone = $this->input->post('handphone', true);
                $nik = $this->input->post('nik', true);
                $npwp = $this->input->post('npwp', true);
                $bankacc = $this->input->post('bankacc', true);
                $division = $this->input->post('division', true);
                $postition = $this->input->post('postition', true);
                $base_salary = $this->input->post('salary', true);
            // DATA POST

            if (empty($userid)) {
                $makeuserid = makeID('userID', 'sysuser', 'USR');
                $makeempid  = makeID('employee_id', 'employee', 'EMP');
                $COM        = strtoupper(md5(strtoupper(md5($email)). "P@ssw0rd" .strtoupper(md5('pass1234'))));

                $datauser = array(
                    'userID'        => $makeuserid,
                    'email'         => $email,
                    'name'          => $name,
                    'Group_Cd'      => $group,
                    'password'      => $COM,
                );

                $dataemp = array(
                	'userID' 		=> $makeuserid,
                	'employee_id' 	=> $makeempid,
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

                $insertuser = $this->M_wsbangun->insertData('IFCA', 'sysUser', $datauser);
                $insertemp = $this->M_wsbangun->insertData('IFCA', 'employee', $dataemp);
                if ($insertuser && $insertemp) {
                    $callback['Message'] = "User registration Successful";
                }
                else{
                    $callback['Error'] = true;
                    $callback['Message'] = "User registration failed";
                }
            }
            else{
                $datauser = array(
                    'name'          => $name,
                    'Group_Cd'      => $group
                );

                $dataemp = array(
                    'name'          => $name,
                    'address'       => $address,
                    'gender'        => $gender,
                    'handphone'     => $handphone,
                    'nik'           => $nik,
                    'npwp'          => $npwp,
                    'bank_acct'     => $bankacc,
                    'division_cd'   => $division,
                    'postition_cd'  => $postition,
                    'base_salary'   => $base_salary,
                );
                    
                $whereusr = array('userID' => $userid);
                $whereemp = array('employee_id' => $employeeid);

                $updateuser = $this->M_wsbangun->updateData('IFCA', 'sysUser', $datauser, $whereusr);
                $updateemp = $this->M_wsbangun->updateData('IFCA', 'employee', $dataemp, $whereemp);
                if ($updateuser && $updateemp) {
                    $callback['Message'] = "User Updated Successfully";
                }
                else{
                    $callback['Error'] = true;
                    $callback['Message'] = "User update failed";
                }
            }
        } //tutup post
        else{
            $callback['Error'] = true;
            $callback['Message'] = "Data validation is not valid";
        }   
        echo json_encode($callback);
    }

    public function resetpass(){
        $callback = array(
            'Data' => null,
            'Message' => null,
            'Error' => false
        );

        if ($_POST) {
            $userid = $this->input->post('userid', TRUE);
            $email  = $this->input->post('email', true);
            if (!empty($userid) && !empty($email)) {
                $COM = strtoupper(md5(strtoupper(md5($email)). "P@ssw0rd" .strtoupper(md5('pass1234'))));
                $data = array(
                    'password'  => $COM,
                    'COM'       => $COM
                );
                $where = array('userID'=>$userid);
                $update = $this->M_wsbangun->updateData('IFCA', 'sysUser', $data, $where);
                if ($update) {
                    $callback['Message'] = 'Reset Password Successful';
                }
                else{
                    $callback['Error'] = true;
                    $callback['Message'] = 'Reset Falied';
                }
            }
            else{
                $callback['Error'] = true;
                $callback['Message'] = 'Invalid Data';
            }
        }
        else{
            $callback['Error'] = true;
            $callback['Message'] = 'Invalid Data';
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

            $where = array('userID'=>$id);

            $delemp = $this->M_wsbangun->deleteData('IFCA', 'employee', $where);
            if ($delemp) {
                $deluse = $this->M_wsbangun->deleteData('IFCA', 'sysuser', $where);
                if ($deluse) {
                    $callback['Message'] = "Data has been deleted successfully";
                }
                else{
                    $callback['Message'] = $deluse;
                    $callback['Error'] = true;
                }
            }
            else {
                $callback['Message'] = $delemp;
                $callback['Error'] = true;
            }
        }
        echo json_encode($callback);
    }
}

/* End of file C_user.php */
/* Location: ./application/controllers/C_user.php */