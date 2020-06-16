<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_profile extends Core_Controller{
	public function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    public function profile(){
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');
        if($group=='AGENT')
        {
            $this->load->view('agent/profile');
        }
        else if($group=='PRINCIPAL')
        {
            $this->load->view('agent/principal');
        }
        else 
        {
            $this->load->view('agent/else');
        }
    }
    
    public function changepass(){
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        $password2 = $this->input->post('password2', True);
        $email = $this->input->post('email', true);
        $em = $email;
        $pass = $password2;

        if (!empty($pass)) {

            $this->load->database();
            $DB2 = $this->load->database('ifca3', TRUE);
            $sql = 'select * from sysUser where email=?';
            $where =array($em);
            $qq = $DB2->query($sql,$where);
            $datas = $qq->result();

            $email = strtoupper(md5($email));
            $paswd = $pass;
            $paswd = strtoupper(md5($paswd));
            $EmailPassword = strtoupper(md5($email.'P@ssw0rd'.$paswd));

            if($datas){
                $dataupdate = array(       
                    'COM'=>$EmailPassword,
                    'password'=>$EmailPassword
                );
                $criteria = array(
                    'email'=>$em
                );
                $update = $this->M_wsbangun->updateDataadm('sysUser',$dataupdate, $criteria);
       
                if($update !="OK"){
                    $callback['Error'] = true;
                    $callback['Pesan'] = 'Cannot reset your password.';
                }else{
                    $callback['Pesan'] = "Your password has been updated successfully"; 
                }    
            }
        }
        echo json_encode($callback);
    }
}