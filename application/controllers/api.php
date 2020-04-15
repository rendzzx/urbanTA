<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');
ini_set('max_execution_time', 0);
// ini_set('memory_limit','2048M');
class Api extends Core_Controller{
    public function __construct(){
        parent::__construct();
    }

    public function Login(){
        $callback = array(
            'Error' => false,
            'Data' => null,
            'Message' => null 
        );

        $Data = file_get_contents("php://input");
        $Data = json_decode($Data);

        $email      = $Data->email;
        $password   = $Data->password;
        if (!empty($email) && !empty($password)) {
            $email      = strtolower($email);
            $password   = strtolower($password);
            $COM        = strtoupper(md5(strtoupper(md5($email)). "P@ssw0rd" .strtoupper(md5($password))));

            $sql = "SELECT * from v_employee_user where  email = '$email' AND status_activate = 'Y' ";
            $DatasysUser = $this->M_wsbangun->getData_by_query('IFCA', $sql);
            
            if ($DatasysUser) {
                if ($COM != $DatasysUser[0]->password) {
                    $callback['Message'] = "Wrong Password";
                    $callback['Data'] = null;
                    $callback['Error'] = true;
                }
                else{
                    $callback['Data'] = array(
                        'user_id'       => $DatasysUser[0]->userID,
                        'email'         => $email,
                        'name'          => $DatasysUser[0]->name,
                        'group_cd'      => $DatasysUser[0]->Group_Cd,
                        'agent_cd'      => $DatasysUser[0]->agent_cd,
                        'debtor_acct'   => $DatasysUser[0]->debtor_acct,
                        'employee_id'   => $DatasysUser[0]->employee_id,
                        'handphone'     => $DatasysUser[0]->handphone,
                        'nik'           => $DatasysUser[0]->nik,
                        'npwp'          => $DatasysUser[0]->npwp,
                        'division'      => $DatasysUser[0]->division_name,
                        'postition'     => $DatasysUser[0]->postition_name,
                    );
                    $callback['Error'] = false;
                }
            }
            else {
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

    // ATTEND
        public function cekAttend(){
            $callback = array(
                'Error' => false,
                'Data' => null,
                'Message' => null 
            );

            $Data = file_get_contents("php://input");
            $Data = json_decode($Data);

            $email = $Data->email;
            $employee_id = $Data->employee_id;
            $today = date("d M Y");

            $query = "SELECT * FROM v_attend_trx WHERE employee_id  = '$employee_id' AND day = '$today' ";
            $dataattend = $this->M_wsbangun->getData_by_query('IFCA', $query);
            // var_dump($dataattend);die;
            if ($dataattend) {
                $callback['Data'] = array(
                    'attend_id'     => $dataattend[0]->attend_id,
                    'employee_id'   => $dataattend[0]->employee_id,
                    'day'           => $dataattend[0]->day,
                    'name'          => $dataattend[0]->name,
                    'hour_in'       => $dataattend[0]->hour_in,
                    'hour_out'      => $dataattend[1]->hour_out,
                    'latitude'      => $dataattend[0]->latitude,
                    'longitude'     => $dataattend[0]->longitude,
                    'ket'           => $dataattend[0]->ket,
                );
            }
            else{
                $callback['Error'] = true;
                $callback['Message'] = 'No data available';
            }

            echo json_encode($callback);
        }

        public function Attend(){
            $callback = array(
                'Error' => false,
                'Data' => null,
                'Message' => null,
                'Type' => null
            );

            $Data = file_get_contents("php://input");
            $Data = json_decode($Data);

            $employee_id = $Data->employee_id;
            $latitude = $Data->latitude;
            $longitude = $Data->longitude;
            $today = date("d M Y");
            $hour  = date("d M Y H:i:s");

            $query = "SELECT * FROM attendance_trx WHERE employee_id  = '$employee_id' AND day = '$today' ";
            $dataattend = $this->M_wsbangun->getData_by_query('IFCA', $query);
            // var_dump($dataattend);die;
            if (count($dataattend) == 0) {
                $data = array(
                    'employee_id'   => $employee_id,
                    'day'           => $today
                );
                $hd = $this->M_wsbangun->insertData('IFCA', 'attendance_trx', $data);
                if ($hd) {
                    $callback['Message'] = 'Success insert hd';
                    $callback['Type'] = 'IN';
                }
                else {
                    $callback['Error'] = true;
                    $callback['Message'] = 'error insert hd';
                    goto forceExit;
                }
            }

            $query = "SELECT attend_id FROM attendance_trx WHERE employee_id  = '$employee_id' AND day = '$today' ";
            $dataattend = $this->M_wsbangun->getData_by_query('IFCA', $query);

            $attend_id  = $dataattend[0]->attend_id;
            if ($attend_id > 1) {
                $query = "SELECT attend_id, ket FROM attendance_trx_dt WHERE attend_id  = '$attend_id' ";
                $dataattend = $this->M_wsbangun->getData_by_query('IFCA', $query);

                if (count($dataattend) == 0) {
                    $data_in = array(
                        'attend_id'     => $attend_id,
                        'hour_in'       => $hour,
                        'latitude'      => $latitude,
                        'longitude'     => $longitude,
                        'ket'           => 'in'
                    );
                    $dt_in = $this->M_wsbangun->insertData('IFCA', 'attendance_trx_dt', $data_in);
                    if ($dt_in) {
                        $callback['Message'] = 'Success insert dt_in';
                        $callback['Type'] = 'IN';
                    }
                    else {
                        $callback['Error'] = true;
                        $callback['Message'] = 'error insert dt_in';
                    }
                }
                elseif (count($dataattend) == 1){
                    
                    $data_out = array(
                        'attend_id'     => $attend_id,
                        'hour_out'      => $hour,
                        'latitude'      => $latitude,
                        'longitude'     => $longitude,
                        'ket'           => 'out'
                    );
                    $dt_out = $this->M_wsbangun->insertData('IFCA', 'attendance_trx_dt', $data_out);
                    if ($dt_out) {
                        $callback['Message'] = 'Success insert dt_out';
                        $callback['Type'] = 'OUT';
                    }
                    else {
                        $callback['Error'] = true;
                        $callback['Message'] = 'error insert dt_out';
                    }
                }
                else{
                    $callback['Error'] = true;
                    $callback['Message'] = 'You already attend today';
                }
            }
            forceExit:
            echo json_encode($callback);
        }
    // ATTEND
}
