<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dash extends Core_controller{
    public function __construct(){
        parent::__construct();
        $this->auth_check();
        $this->load->library('encrypt');
    }
 
    public function index($project=''){
        $entity = $this->session->userdata('Tsentity');
        $project_sess = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $userID = $this->session->userdata('Tsname');
        $email = $this->session->userdata('Tsemail');
        $entityname = $this->session->userdata('Tsentityname');
        $usergroup = $this->session->userdata('Tsusergroup');
        $sys = $this->session->userdata('Tsysadmin');

        $approver = 0;
        if(empty($project_sess)){
            $sqlquery="SELECT min(project_no) as project_no, min(entity_cd) as entity_cd  from mgr.pl_project "; 
            $dt = $this->M_wsbangun->getData_by_query('IFCA', $sqlquery);
            $project =  $dt[0]->project_no;
            $entity = $dt[0]->entity_cd;
        }

        if($usergroup=='MGM'){
            redirect($this->session->userdata('Tsdashboard'));
        }

        $this->session->unset_userdata('Tsentity');              
        $this->session->unset_userdata('Tsproject'); 
        $this->session->unset_userdata('Tsprojectname'); 

        $datalist2 = '';
        $descs = '';
        if ($usergroup=='Guest') {
            $datalist2 = $this->M_wsbangun->getData('IFCA', 'pl_project');
            $cntdatalist2 = count($datalist2);
        }
        else{
            $tabel2 = 'v_cfs_login_user';
            $kriteria2 = array(
                'project_status'=>1,
                'email'=>$email
            );
        
            $datalist2 = $this->M_wsbangun->getData_by_criteria('IFCA', $tabel2, $kriteria2);
            $cntdatalist2 =count($datalist2);
        }
        $ListAllData='';
        // $cntdatalist2 =0;
        if($cntdatalist2 > 0){
            if(!empty($datalist2)){
                // var_dump($this->session->userdata("Tsdashboard"));die;
                foreach ($datalist2 as $value) {
                    $pict = $value->picture_path;
                    if ($usergroup=='Guest') {
                        $descs = $value->descs;
                    }
                    else{
                        $descs = $value->project_descs;
                    }
                   
                    $url_direct = base_url(
                        $this->session->userdata("Tsdashboard").base64_encode($value->project_no.'-%-'.$descs)
                    );
                    if(!empty($value->picture_path)){
                        $pic_url = $value->picture_path;           
                    }else{
                        $pic_url = base_url('img/PlProject/blankproject.png');
                    }
                    $ListAllData .='<div class="col-sm-3">';
                    $ListAllData .='<div class="card pull-up">';
                    $ListAllData .='    <a href="'.$url_direct.'"><img class="card-img-top img-fluid" src="' .$pic_url. '" alt="' .$descs. '" />';
                    $ListAllData .='    <div class="card-body">';
                    $ListAllData .='      <h4 class="card-title" style="color: #7C7F81;">' .$descs. '</h4>';
                    $ListAllData .='    </div></a>';
                    $ListAllData .='</div> '; 
                    $ListAllData .='</div> ';  

                 
                }
            }

            $sqlimage = "select pict from mgr.sysuser where name='$userID'";
      
            $image = $this->M_wsbangun->getData_by_query('IFCA', $sqlimage);

       

            $ContentAllData = array('PlProject' => $ListAllData,
                'leftdyn'=>$name,
                'isi'=>$datalist2,
                'sys'=>$sys,
                'approver'=>$approver,
                'entityname'=> $entityname
                ,'image' => $image
                );
            $this->load_content('dash/index', $ContentAllData);
            return;
        } else if($cntdatalist2 == 0){
            //kalo projectnya ga ada 
            if($usergroup=='ADMINWEB'){
                $ListAllData='';
                $ListAllData .='<div class="col-sm-12">';
                $ListAllData .='<div class="card ">';
                $ListAllData .='    <div class="card-body" style="text-align:center;">';
                $ListAllData .='      <br><h4 class="card-title" style="color: #7C7F81;"> No project available. Please register new project by click the button below.</h4>';
                $ListAllData .='      <a href="'.base_url('c_projects/form/regist').'" class="btn btn-primary">Registration New Project</a>';
                $ListAllData .='    </div>';
                $ListAllData .='</div> '; 
                $ListAllData .='</div> ';  

                $sqlimage = "select pict from mgr.sysuser where name='$userID'";
                $image = $this->M_wsbangun->getData_by_query('IFCA', $sqlimage);

                 $ContentAllData = array('PlProject' => $ListAllData,
                    'leftdyn'=>$name,
                    'isi'=>$datalist2,
                    'sys'=>$sys,
                    'approver'=>$approver,
                    'entityname'=> $entityname
                    ,'image' => $image
                    );
                $this->load_content('dash/index', $ContentAllData);
            }else{
                $ListAllData='';
                $ListAllData .='<div class="col-sm-12">';
                $ListAllData .='<div class="card ">';
                $ListAllData .='    <div class="card-body" style="text-align:center;">';
                $ListAllData .='      <br><h4 class="card-title" style="color: #7C7F81;"> No project available. To regist a please contact admin.</h4>';
                $ListAllData .='      ';
                $ListAllData .='    </div>';
                $ListAllData .='</div> '; 
                $ListAllData .='</div> ';  

                $sqlimage = "select pict from mgr.sysuser where name='$userID'";
                $image = $this->M_wsbangun->getData_by_query('IFCA', $sqlimage);

                 $ContentAllData = array('PlProject' => $ListAllData,
                    'leftdyn'=>$name,
                    'isi'=>$datalist2,
                    'sys'=>$sys,
                    'approver'=>$approver,
                    'entityname'=> $entityname
                    ,'image' => $image
                    );
                $this->load_content('dash/index', $ContentAllData);
            }
            
        }
        else
        {
            //kalo project cuma 1 lgsg ke projectinfo/newsfeed
            $this->session->set_userdata('Tsentity', trim($datalist2[0]->entity_cd));
            $this->session->set_userdata('Tsproject', trim($datalist2[0]->project_no));
            $this->session->set_userdata('Tscons', $datalist2[0]->db_profile);
            // $this->session->set_userdata('Tsentityname', $datalist2[0]->entity_name);
            redirect($this->session->userdata("Tsdashboard").base64_encode($datalist2[0]->project_no.'-%-'.$datalist2[0]->descs.'-%-'.$datalist2[0]->db_profile));
        }
    }

    public function search_project(){
        $search = $this->input->post('searchval');
        $usergroup = $this->session->userdata('Tsusergroup');
        $email = $this->session->userdata('Tsemail');
        $where = '';
        if(empty($search)){
            $where = '';
        }else{
            if($usergroup=='Guest') {
                $where = " and descs like '%$search%'";
            }
            else{
                $where = " and project_descs like '%$search%'";
            }
        }
        if ($usergroup=='Guest') {
            // $datalist2 = $this->M_wsbangun->getData('IFCA', 'pl_project');
            $sql = "SELECT * from mgr.pl_project(NOLOCK) where status=1".$where;
            $datalist2 = $this->M_wsbangun->getData_by_query('IFCA', $sql);
            $cntdatalist2 = count($datalist2);
        }
        else{
           
            $sql = "SELECT * from mgr.v_cfs_login_user where email = '$email' and project_status=1".$where;
            $datalist2 = $this->M_wsbangun->getData_by_query('IFCA', $sql);
            $cntdatalist2 = count($datalist2);
        }
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $pict = $value->picture_path;
                if ($usergroup=='Guest') {
                    $descs = $value->descs;
                }
                else{
                    $descs = $value->project_descs;
                }
               
                $url_direct = base_url($this->session->userdata("Tsdashboard").base64_encode($value->project_no.'-%-'.$descs.'-%-'.$value->db_profile));
                if(!empty($value->picture_path)){
                    $pic_url = $value->picture_path;           
                }else{
                    $pic_url = base_url('img/PlProject/blankproject.png');
                }
                $ListAllData .='<div class="col-sm-3">';
                $ListAllData .='<div class="card pull-up">';
                $ListAllData .='    <a href="'.$url_direct.'"><img class="card-img-top img-fluid" src="' .$pic_url. '" alt="' .$descs. '" />';
                $ListAllData .='    <div class="card-body">';
                $ListAllData .='      <h4 class="card-title" style="color: #7C7F81;">' .$descs. '</h4>';
                $ListAllData .='    </div></a>';
                $ListAllData .='</div> '; 
                $ListAllData .='</div> ';  

             
            }
        }else{
            $ListAllData .='<div class="col-sm-12">';
            $ListAllData .='<div class="card ">';
            $ListAllData .='    <div class="card-body" style="text-align:center;">';
            $ListAllData .='      <br><h4 class="card-title" style="color: #7C7F81;"> No project found. Please try again.</h4>';
            $ListAllData .='      ';
            $ListAllData .='    </div>';
            $ListAllData .='</div> '; 
            $ListAllData .='</div> ';  
        }
  
        $content = array('PlProject' => $ListAllData );
        $this->load->view('dash/search_project',$content);
    }

    // public function project_list($project=''){
    //     $userid = $this->session->userdata('Tsname');
    //     $sql = "SELECT distinct project_no,descs from mgr.v_cfs_user_project (nolock) where userid= '$userid'";
    //     $proDescs = $this->M_wsbangun->getData_by_query('IFCA', $sql);
    //     // var_dump($project);
    //     $comboProject[]='';
    //         if(!empty($proDescs)) {
    //             $comboProject[] = '<option></option>';
    //              // $comboProject[] = '<option value="1"></option>';
    //             foreach ($proDescs as $dtProject) {

    //               if($project === $dtProject->project_no) {
    //                 // var_dump($project.' -- '.$dtProject->project_no);
    //                 $pilih = ' selected = "1"';
    //               } else {
    //                 $pilih = '';
    //               }
    //                 $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
    //             }
    //             $comboProject = implode("", $comboProject);
    //         }
    //         return $comboProject;
    // }

    // public function call()
    // {
    //     $paramSrc = $this->uri->segment(3);
    //     $param = base64_decode($paramSrc);
        
    //     if(empty($param)) {
    //         $entity = $this->session->userdata('Tsentity');            
    //         $entityname = $this->session->userdata('Tsentityname');
    //     } else {
    //         $entity = substr($param, 0,4);            
    //         $entityname = str_replace('%20', ' ', substr($param, 5));
    //         $this->session->set_userdata('Tsentity', $entity);
    //         $this->session->set_userdata('Tsentityname', $entityname);
    //     }
        
    //     $name = $this->session->userdata('Tsuname');
    //     $sys = $this->session->userdata('Tsysadmin');
    //     $approver = 0;

    //     $tabel2 = 'v_cfs_user_project';
    //     $kriteria2 = array(
    //         // 'entity_cd'=>$entity,
    //         'userid'=>$name);

    //     $datalist2 = $this->M_wsbangun->getData_by_criteria($tabel2, $kriteria2);
        
    //     $ListAllData='';
    //     if(!empty($datalist2)){
    //         foreach ($datalist2 as $value) {
                
    //             $ListAllData .='<div class="col-md-3">';
    //             $ListAllData .='<div class="ibox">';
    //             $ListAllData .='<div class="ibox-content product-box">';
    //             $ListAllData .='<div class="product-imitation">';
    //             if(!empty($value->picture_path)){
    //                 $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/'.$value->picture_path).'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';
    //             }else{
    //                 $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/blankproject.png').'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';
    //             }
    //             $ListAllData .=$a;
    //             $ListAllData .='</div>';
    //             $ListAllData .='<div class="product-desc">'; 
    //             $ListAllData .='<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'" class="product-name">' .$value->descs. '&nbsp; <i class="fa fa-arrow-circle-right"></i><br>Click Here to begin.</a>';
    //             $ListAllData .='<a href="http://'.$value->http_add.'" target="_blank">&nbsp;<br>'.$value->http_add.'</a>';
    //             $ListAllData .='</div>';
    //             $ListAllData .='</div>';
    //             $ListAllData .='</div>';
    //             $ListAllData .='</div>';

    //         }
    //     }

    //     $ContentAllData = array('PlProject' => $ListAllData,
    //         'leftdyn'=>$name,
    //         'isi'=>$datalist2,
    //         'sys'=>$sys,
    //         'approver'=>$approver,
    //         'entityname'=>$entityname);
    //     $this->load_content('dash/index', $ContentAllData, true);
    // }
}