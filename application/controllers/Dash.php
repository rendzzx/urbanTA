<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dash extends Core_controller{
    public function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    public function index(){
        $this->session->unset_userdata('Tsentity');              
        $this->session->unset_userdata('Tsproject'); 
        $this->session->unset_userdata('Tsprojectname');

        $listProject = $this->M_wsbangun->getData('IFCA', 'project');
        $cntlistProject = count($listProject);
        $ListAllData = '';
        if(!empty($listProject)){
            foreach ($listProject as $value) {
                $pic_url = $value->picture_path;
                $descs = $value->descs;

                $url_direct = base_url($this->session->userdata("Tsdashboard").base64_encode($value->project_no.'-%-'.$descs));

                $ListAllData .='<div class="col-sm-3">';
                $ListAllData .='    <div class="card pull-up">';
                $ListAllData .='        <a href="'.$url_direct.'"><img class="card-img-top img-fluid" src="' .$pic_url. '" alt="' .$descs. '" />';
                $ListAllData .='            <div class="card-body">';
                $ListAllData .='                <h4 class="card-title" style="color: #7C7F81;">' .$descs. '</h4>';
                $ListAllData .='            </div>';
                $ListAllData .='        </a>';
                $ListAllData .='    </div>'; 
                $ListAllData .='</div>';
            }
        }

        $ContentAllData = array(
            'PlProject' => $ListAllData
        );
        $this->load_content('dashboard/dash', $ContentAllData);
        return;
    }
}