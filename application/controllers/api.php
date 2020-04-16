<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');
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
                    'day'           => date_format(date_create($dataattend[0]->day), "d F Y"),
                    'name'          => $dataattend[0]->name,
                    'hour_in'       => date_format(date_create($dataattend[0]->hour_in), "H:i:s"),
                    'hour_out'      => date_format(date_create($dataattend[0]->hour_out), "H:i:s"),
                    'latitude_in'   => $dataattend[0]->latitude_in,
                    'longitude_in'  => $dataattend[0]->longitude_in,
                    'latitude_out'  => $dataattend[0]->latitude_out,
                    'longitude_out' => $dataattend[0]->longitude_out,
                );
            }
            else{
                $callback['Error'] = true;
                $callback['Message'] = 'You have not attend today';
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

            if (count($dataattend) == 0){
                $getid = makeID('attend_id', 'attendance_trx', 'URB');

                $data = array(
                    'attend_id'     => $getid,
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

                $data_in = array(
                    'attend_id'     => $getid,
                    'hour_in'       => $hour,
                    'latitude_in'      => $latitude,
                    'longitude_in'     => $longitude
                );
                $dt_in = $this->M_wsbangun->insertData('IFCA', 'attendance_trx_dt', $data_in);
                if ($dt_in) {
                    $callback['Message'] = 'Success insert dt_in';
                    $callback['Type'] = 'IN';
                }
                else {
                    $callback['Error'] = true;
                    $callback['Message'] = 'error insert dt_in';
                    goto forceExit;
                }
            }
            elseif (count($dataattend) == 1){
                $sql = "SELECT hour_out as hour_out FROM attendance_trx_dt WHERE attend_id = '".$dataattend[0]->attend_id."'";
                $dataout = $this->M_wsbangun->getData_by_query('IFCA', $sql);
                if ($dataout[0]->hour_out == NULL) {
                    $data_out = array(
                        'hour_out'      => $hour,
                        'latitude_out'      => $latitude,
                        'longitude_out'     => $longitude
                    );
                    $where = array('attend_id' => $dataattend[0]->attend_id);

                    $dt_out = $this->M_wsbangun->updateData('IFCA', 'attendance_trx_dt', $data_out, $where);
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
