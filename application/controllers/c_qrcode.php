<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_Qrcode extends Core_Controller 
{
               
        public function __construct()
        {
           
            parent::__construct();
            $this->auth_check();
            $this->load->model('m_wsbangun');
        }

        public function index()
        {       
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $name = $this->session->userdata('Tsuname');
            $projectName = $this->session->userdata('Tsprojectname');

            $Content = array(
                'entity'=>$entity,
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                'name'=>$name
             );

            $this->load_content_top_menu('qrcode/index',$Content);


        }

        public function saveqr(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $name = $this->session->userdata('Tsuname');
            $projectName = $this->session->userdata('Tsprojectname');
            $qrcode = $this->input->post('scan', true);
            $audit_date = date('d M Y H:i:s');


            $data = array(          
                'project_no'=>$project,
                'audit_user'=>$name,
                'audit_date'=>$audit_date,
                'qr_code'=>$qrcode
                );

            if ($_POST){
                $data = $this->m_wsbangun->insertDataweb('rl_agent_absen',$data);
                if($data !="OK"){
                    $msg= $data;
                    $st = 'Fail';
                }else{
                    $msg="Data has been saved successfully";
                    $st = 'OK';
                }
            }
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);

            echo json_encode($msg1);

        }
}