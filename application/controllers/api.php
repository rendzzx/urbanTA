<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');
ini_set('max_execution_time', 0);
// ini_set('memory_limit','2048M');
class api extends Core_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_api');
    }

    public function Login(){
        $callback = array(
            'Error' => false,
            'Data' => null,
            'Message' => null 
        );

        $dateNow = date('d M Y H:i:s');
        $date = new Datetime($dateNow);

        //add 1 bulam
        $date->add(new DateInterval('P1M'));
        $ExpiredOn = $date->format('d M Y H:i:s');

        $Data = file_get_contents("php://input");
        $Data = json_decode($Data);

        $em = $Data->email;
        $pass = $Data->password;
        $device = $Data->device;
        $token = $Data->token;
        $mac = $Data->mac;
        $token_firebase = $Data->token_firebase;
        $audit_date = date('d M Y H:i:s');

        $sql = "SELECT group_cd FROM mgr.sysuser where email='$em'";
        $group = $this->M_api->getData_by_query('ifca3', $sql);

        if ($group) {
            $group_cd = $group[0]->group_cd;
        } else {
            $callback['Error'] = true;
            $callback['Data'] = null;
            $callback['Message'] = 'Incorrect username or password';
            echo  json_encode($callback);
            exit();
        }

        $sql2 = "SELECT count(*) as cnt FROM mgr.token_firebase where mac_address='$mac'";
        $tokens = $this->M_api->getData_by_query('ifca3', $sql2);
        $cnttoken = $tokens[0]->cnt;
        if ($cnttoken > 0) {
            $data = array(
                'token' => $token,
                'email' => strtolower($em),
                'group_cd' => $group_cd,
                'audit_date' => $audit_date,
                'mac_address' => $mac
            );
            $where = array(
                'mac_adderss' => $mac,
                'devices' => 'android'
            );
            $update = $this->M_api->updateData('ifca3', 'token_firebase', $data, $where);
        }
        else {
            $data = array(
                'token' => $token_firebase,
                'devices' => $device,
                'email' => strtolower($em),
                'group_cd' => $group_cd,
                'audit_date' => $audit_date,
                'mac_address' => $mac
            );
            $insert = $this->M_api->insertData('ifca3', 'token_firebase', $data);
        }

        if (!empty($em) && !empty($pass)) {
            $email = strtolower($em); //$this->security->xss_clean(trim($this->input->post('username')));
            $email_user = $email;
            $email = strtoupper(md5($email));
            $paswd = $pass; //$this->security->xss_clean(trim($this->input->post('password')));
            $paswd = strtoupper(md5($paswd));

            $DB2 = $this->load->Database('ifca3', TRUE);
            $sql = "select * from mgr.sysUser where isnull(sosmed,'')='' AND email =? AND status_activate = 'Y' ";
            $where = array($email_user);
            $qq = $DB2->query($sql, $where);
            $DatasysUser = $qq->result();
            $DB2->close();

            $PS = $email . 'P@ssw0rd' . $paswd;
            $EmailPassword = strtoupper(md5($PS));
            if ($DatasysUser) {
                if ($EmailPassword != strtoupper($DatasysUser[0]->COM)) {
                    $callback['Message'] = "Wrong Password";
                    $callback['Data'] = null;
                    $callback['Error'] = true;
                    echo  json_encode($callback);
                    exit();
                }
                // is resset password
                if ($DatasysUser[0]->isResetLogin == true) {
                    $callback['Data'] = array(
                        'DashMenu' => null,
                        'name' => $DatasysUser[0]->name,
                        'user' => $email_user,
                        'handphone' => $DatasysUser[0]->Handphone,
                        'UserId' => $DatasysUser[0]->userID,
                        'Token' => null,
                        'Group' => $DatasysUser[0]->Group_Cd,
                        'isResetPass' => $DatasysUser[0]->isResetLogin,
                        'AgentCd' => $DatasysUser[0]->agent_cd,
                        'rowID' => $DatasysUser[0]->rowID
                    );
                    $callback['Message'] = "Reset Password";
                    $callback['Error'] = false;
                    echo  json_encode($callback);
                    exit();
                }

                //cek token sebelum'a and delete
                $param = array('Token' => $token);
                $countToken = $this->M_api->getCount_by_criteria('ifca3', 'sysUserSession', $param);
                // var_dump($countToken);
                if ((int) $countToken > 0) {
                    $this->M_api->deletedata('ifca3', 'sysUserSession', $param);
                }

                //Generate Token
                $GenerateToken = $this->GenerateToken($EmailPassword, $ExpiredOn, $DatasysUser[0]->userID, $email_user);
                //Insert user session
                $ArSession = array(
                    'IdUser'    =>  $DatasysUser[0]->userID,
                    'Token'     =>   $GenerateToken,
                    'LocationID'  =>  '1',
                    'LocationDescs'  =>  'Waskita',
                    'LastLogin' => $dateNow,
                    'ExpireOn'  => $ExpiredOn,
                    'IpAddress' => $_SERVER['REMOTE_ADDR'],
                    'Device'    => $device,
                    'audit_date' => $dateNow,
                    'audit_user' => $email_user
                );
                $Tsession = $this->SaveUserSession($ArSession);

                $DatasysUserSession = array(
                    'email' => $DatasysUser[0]->email,
                    'login_type' => 'Mobile',
                    'apps_type' => 'Urban Sales',
                    'ip_Address' => '192.168.3.1',
                    'devices' => 'android',
                    'login_date' => date("Y-m-d")
                );
                $this->M_api->insertData('ifca3', 'sysusersessionlog', $DatasysUserSession);

                $dataField = $this->get_field();
                $dataDropdown = $this->get_dropdown($dataField);
                // var_dump($dataDropdown);exit;
                $callback['Data'] = array(
                    'DashMenu' => $this->get_menu($DatasysUser[0]->Group_Cd),
                    // 'SideMenu'=>$this->get_menu($DatasysUser[0]->Group_Cd),
                    'name' => $DatasysUser[0]->name,
                    'pict' => $DatasysUser[0]->pict,
                    'user' => $email_user,
                    'handphone' => $DatasysUser[0]->Handphone,
                    'UserId' => $DatasysUser[0]->userID,
                    'Token' => $GenerateToken,
                    'Group' => $DatasysUser[0]->Group_Cd,
                    'isResetPass' => false,
                    'AgentCd' => $DatasysUser[0]->agent_cd,
                    // 'DynField'=>$dataField,
                    // 'DynDropdown'=>$dataDropdown,
                    'Debtor_acct' => $DatasysUser[0]->debtor_acct,
                    'rowID' => $DatasysUser[0]->rowID
                );
                $callback['Error'] = false;
            } else {
                $callback['Message'] = "Wrong Email";
                $callback['Data'] = null;
                $callback['Error'] = true;
            }
        } else {
            $callback['Message'] = "Data Not Valid";
            $callback['Data'] = null;
            $callback['Error'] = true;
        }
        echo  json_encode($callback);   
    }

    public function Logout($user=''){
        // var_dump($this->input->request_headers());
        // $this->_Authorization();
        $Error = false;
        $Data = null;
        $psn = '';
        $dateNow = date('d M Y H:i:s');

        $Data = file_get_contents("php://input");
        $Data = json_decode($Data);

        $email = $Data->email;
        $ipAddress = $Data->ipAddress;
        $device = $Data->device;
        // var_dump($user);["Token"]
        if ($user != '') {
            $Token = $this->input->request_headers()["token"];

            $where = array(
                'Token' => $Token,
                'IdUser' => $user
            );

            $delete = $this->M_api->deletedata('ifca3', 'sysUserSession', $where);
            if ($delete == 'OK') {

                $DatasysUserSession = array(
                    'email' => $email,
                    'login_type' => 'O',
                    'apps_type' => 'S',
                    'ipAddress' => $ipAddress,
                    'device' => $device,
                    'login_date' => date("Y-m-d H:i:s")
                );

                $insertLog = $this->M_api->insertData('ifca3', 'sysusersessionlog', $DatasysUserSession);

                $psn = 'Berhasil Logout';
            } else {
                $psn = $delete;
                $Error = true;
            }
        } else {
            $psn = 'Parameter cant be null';
            $Error = true;
        }


        $msg1 = array(
            'Error' => $Error,
            'Data' => $Data,
            'Pesan' => $psn,
            'Status' => 200
        );
        echo  json_encode($msg1);
    }
}
