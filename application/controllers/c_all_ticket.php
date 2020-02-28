<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_all_ticket extends Core_Controller
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
        $seqno = $this->input->post('seqno', true);
        $pdfname='';
        $status='';
  
        $param = $this->uri->segment(3);
        // var_dump($param);
        $paramDcd = base64_decode($param);
        

        if(empty($paramDcd)) {
            $project_no = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname') ;
            // var_dump($project_no);
        } else {
            $email = $this->session->userdata('Tsemail');
            // $a = strrpos($paramDcd, '-');
            $b = explode("-%-", $paramDcd);
            // $project_no = substr($paramDcd, 0,$a);
            // var_dump($b);
            $project_no = $b[0];
            $projectName = $b[1];
            $dbprofile = $b[2];
            // var_dump($b);exit();
            
            
            
            $Squery ="select max(entity_cd) as entity_cd ,max(entity_name) as entity_name from mgr.v_cfs_user_project where project_no ='$project_no' ";            
            $dd = $this->m_wsbangun->getData_by_query_cons($dbprofile,$Squery);
            // var_dump($Squery);var_dump($dd);
            $entity = $dd[0]->entity_cd;
            $entity_name = $dd[0]->entity_name;

       
            $position ='T';
 
            $this->session->set_userdata('TMenuPs',$position);
            $this->session->set_userdata('Tsentityname',$entity_name);
            $this->session->set_userdata('Tsentity', $entity);              
            $this->session->set_userdata('Tsproject', $project_no);            
            $this->session->set_userdata('Tsprojectname', $projectName);
            $this->session->set_userdata('Tscons', $dbprofile);
        }      
        
        $cons = $this->session->userdata('Tscons');
        
        $user_id = $this->session->userdata('Tsname');
  
        // $table = "SELECT COUNT(*) as cnt FROM mgr.fn_Survey_user('$entity','$project','$user_id') ";

        // $publish = $this->m_wsbangun->getData_by_query_cons($cons,$table);
        $count = '';
          // if ($publish[0]->cnt == 0) {
          //       $count = 'TIDAK';
          //   } else {
          //       $count = 'ADA';
          //   }
   
        $surv = $count;    
        $surveyy=$this->session->userdata('Is_Survey');
        $this->session->set_userdata('Is_Survey',false );
        // var_dump($surveyy);exit();
        $content = array(
            // 'error'=>$data,
            // 'pdfname'=>$pdfname,
            // 'pdf'=>$dtPdf,
            'projectName'=>$projectName,
          
            'project_no'=>$project_no,
            'DataSurvey'=>$surv,
            'name'=>$user_id,
            'Surveyy'=>$surveyy,
            // 'name'=>$name,
            );
        // 

        $this->load_content_top_menu('all_ticket/index', $content);

    }
   
   
}
