<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Administrator extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
    }

    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $this->session->unset_userdata('urlmodule');
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
            // $product_cd = $b[3];
            // var_dump($dbprofile);
            // exit();
            
            
            
            $Squery ="SELECT max(entity_cd) as entity_cd ,max(entity_name) as entity_name from mgr.v_cf_entity_project where project_no ='$project_no' ";            
            // var_dump($Squery);
            $dd = $this->m_wsbangun->getData_by_query_cons($dbprofile,$Squery);
            // var_dump($dd);
            $entity = $dd[0]->entity_cd;
            $entity_name = $dd[0]->entity_name;

       
            $position ='T';
 
            $this->session->set_userdata('TMenuPs',$position);
            $this->session->set_userdata('Tsentityname',$entity_name);
            $this->session->set_userdata('Tsentity', $entity);   
            // $this->session->set_userdata('Tsproductcd', $product_cd);             
            $this->session->set_userdata('Tsproject', $project_no);            
            $this->session->set_userdata('Tsprojectname', $projectName);
            $this->session->set_userdata('Tscons', $dbprofile);
        }      
        
        $cons = $this->session->userdata('Tscons');
        $user_id = $this->session->userdata('Tsname');
        $user_email = $this->session->userdata('Tsemail'); 
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $group_cd = $this->session->userdata('Tsusergroup');
        // var_dump($group_cd);exit();

        $where=array('group_cd'=>$group_cd);

        $sql = "SELECT * from mgr.v_sysModuleUser where group_cd = '$group_cd' order by orderseq asc";
        $dtmodule = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $module = '';
        if(!empty($dtmodule)){
            foreach ($dtmodule as $key) {
                $module.='<div class="col-xl-4 col-lg-6 col-12" onclick="gotodash(\''.$key->moduleID.'\')">';
                $module.='    <div class="card btn btn-bg-gradient-x-'.$key->ButtonClass.' box-shadow-3">';
                $module.='        <div class="card-content">';
                $module.='            <div class="card-body">';
                $module.='                <div class="media d-flex">';
                $module.='                    <div class="align-self-top">';
                $module.='                        <i class="'.$key->IconClass.' icon-opacity text-white font-large-4 float-left"></i>';
                $module.='                    </div>';
                $module.='                    <div class="media-body text-white text-right align-self-bottom mt-3">';
                $module.='                        <span class="d-block mb-1 font-medium-1">'.$key->module_descs.'</span>';
                $module.='                        <h1 class="text-white mb-0">'.$key->module_cd.'</h1>';
                $module.='                    </div>';
                $module.='                </div>';
                $module.='            </div>';
                $module.='        </div>';
                $module.='    </div>';
                $module.='</div>';
            }
        }
     // var_dump($entity);exit();
    
        $content = array(
            'projectName'=>$projectName,
            'project_no'=>$project_no,
            'name'=>$user_id,
            'module' => $module
            );
        
        $this->load_content('dash/dash_admin', $content);
    }
    
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    
    public function gotodash(){
        $param = $this->uri->segment(3);
        $moduleID = base64_decode($param);
        // $dtparam = explode('=&=', $paramDcd);

        // $margin ='';
        // var_dump($choosengroup);exit();
        $where=array('rowID'=>$moduleID);
        $dtmodule = $this->m_wsbangun->getData_by_criteria_cons('ifca3','sysModule',$where);
        if(!empty($dtmodule)){
            $choosengroup = $dtmodule[0]->module_group_cd;
            $url = $dtmodule[0]->dashboard_url;
            $appsname = $dtmodule[0]->module_cd;
        }
       
        $this->session->set_userdata('choosengroup', $choosengroup);
        
        // if($choosengroup=='CSM'){
        //     $url = 'customerservice/index';
        //     $appsname = 'CSM';
        //     $margin= ' ';
        // }else if($choosengroup=='SAM'){
        //     $url = 'newsfeed/index';
        //     $appsname = 'S+';
        //     $margin= ' ';
        // } else if($choosengroup=='TAM'){
        //     $url = 'officetower/index';
        //     $appsname = 'O+';
        //     $margin= ' ';
        // } else if($choosengroup=='MAM'){
        //     $url = 'administrator/NA';
        //     $appsname = 'M+';
        //     $margin= ' ';
        // }else if($choosengroup=='OTM'){
        //     $url = 'overtime/index';
        //     $appsname = 'OT';
        //     $margin= ' ';
        // } else if($choosengroup=='AM'){
        //     $url = 'overtime/index';
        //     $appsname = 'AM';
        //     $margin= ' ';
        // } else if($choosengroup=='SA'){
        //     $url = 'overtime/index';
        //     $appsname = 'SA';
        //     $margin= ' ';
        // } else {
        //     $url = 'administrator/NA';
        //     $appsname = ' ';
        //     $margin= ' style="margin-left:100%" ';
        // }

        
        // $margin= ' style="margin-left:100%" ';
        

        $this->session->set_userdata('appsname', $appsname);
        $this->session->set_userdata('urlmodule', $url);
        $this->session->set_userdata('margin', $margin);
        // $this->session->set_userdata('image',$data);
        // var_dump($margin);exit();
        redirect($url);
   }
   public function NA()
    {
        
        $this->load_content_top_menu('dash/dash_NA');

    }
}
