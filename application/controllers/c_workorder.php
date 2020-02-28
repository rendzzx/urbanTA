<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_workorder extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
    }

    public function index2()
    {
        $cons       = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
            // var_dump($b);exit();
            
            
            
            // $Squery ="select max(entity_cd) as entity_cd ,max(entity_name) as entity_name from mgr.v_cfs_user_project where project_no ='$project_no' ";     
            $Squery="select * from mgr.v_sv_workorder where project_no ='$project'";       
            $dd = $this->m_wsbangun->getData_by_query_cons($cons,$Squery);
            // var_dump($dd);
            
           
        
        
        // var_dump($surveyy);exit();
        $content = array(
            // 'error'=>$data,
            // 'pdfname'=>$pdfname,
            // 'pdf'=>$dtPdf,
            
          
            'project_no'=>$project,
            
            // 'name'=>$name,
            );
        // 

        $this->load_content_top_menu('workorder/index', $content);

    }

    public function index(){
            $this->load_content_top_menu('workorder/index');
    }

    // public function create_print()
    // {
    //     $this->load_content_top_menu('workorder/create_print');
    // }

    public function gettable(){

        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status'=> 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');

        $sql = "SELECT distinct report_no, assign_to, work_requested from mgr.v_sv_workorder";

        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
// var_dump($email);
//         var_dump($cons);exit();


        if (!empty($data)) {
            $callback['data'] = $data;
            }

        else{
            $callback['Error'] = true;
            $callback['data'] = $data;
        }

        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function viewprint($report_no='')
        {

            $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
                
                $sql = "SELECT distinct report_no, assign_to, reported_date, debtor_name, lot_no, serv_req_by, contact_no, category_descs, complain_descs, work_requested, item_descs, base_amt, tax_amt, total_amt, survey_date, est_completion_date, completion_date  from mgr.v_sv_workorder where report_no='$report_no'";
                $dataprint = $this->m_wsbangun->getData_by_query($sql);

                // var_dump($dataprint);exit();
                
                $ContentAllData = array(
                    'dataprint'=>$dataprint,
                    'entity'=> $entity,
                    'project'=> $project
                    
                    );
                // $this->load->view('workorder/seeprint',$ContentAllData);
                $this->load_content_top_menu('workorder/seeprint',$ContentAllData);
    
        }

        public function cetakprint($report_no='')
        {
            $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
                
                $sql = "SELECT distinct report_no, assign_to, reported_date, debtor_name, lot_no, serv_req_by, contact_no, category_descs, complain_descs, work_requested, item_descs, base_amt, tax_amt, total_amt, survey_date, est_completion_date, completion_date  from mgr.v_sv_workorder where report_no='$report_no'";
                $dataprint = $this->m_wsbangun->getData_by_query($sql);

                // var_dump($dataprint);exit();
                
                $ContentAllData = array(
                    'dataprint'=>$dataprint
                    
                    
                    );
                $this->load->view('workorder/viewprint',$ContentAllData);
        }
   
   
}


