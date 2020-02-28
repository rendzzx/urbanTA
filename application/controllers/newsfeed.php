<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newsfeed extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
    }

    // public function index($project_no='')
    public function index()
    {
        $entity = $this->session->userdata('Tsentity');

        // var_dump($entity);exit();
        
        $project = $this->session->userdata('Tsproject');
        $seqno = $this->input->post('seqno', true);
        $pdfname='';
        $status='';
        // $projectNoParm = $project_no;
        // $project_no = base64_decode($projectNoParm);
        
        // echo ($project_no); exit;
        // var_dump($project_no);
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
            
            // $projectName = str_replace('%20', ' ', substr($paramDcd, $a + 1));
            // $projectName = substr($param, 5);
            
            $Squery ="SELECT max(entity_cd) as entity_cd ,max(entity_name) as entity_name from mgr.v_cf_entity_project where project_no ='$project_no' ";            
            $dd = $this->m_wsbangun->getData_by_query_cons($dbprofile,$Squery);
            // var_dump($Squery);var_dump($dd);
            $entity = $dd[0]->entity_cd;
            $entity_name = $dd[0]->entity_name;

            // var_dump($entity);exit();

            // $sql ="select MenuPosition from mgr.v_security_users where entity_cd = '$entity' and project_no = '$project_no' and email_add='$email' ";            
            // $dd2 = $this->m_wsbangun->getData_by_query_cons($dbprofile,$sql);
            $position ='T';
            // if(!empty($dd2)){
            //     $position = $dd2[0]->MenuPosition;        
            // }
            
            
            // $this->session->unset_userdata('Tsentity');
            // $this->session->unset_userdata('Tsproject');
            // $this->session->unset_userdata('Tsprojectname');
            // var_dump($entity);exit();
            // var_dump($project_no);
            $this->session->set_userdata('TMenuPs',$position);
            $this->session->set_userdata('Tsentityname',$entity_name);
            $this->session->set_userdata('Tsentity', $entity);              
            $this->session->set_userdata('Tsproject', $project_no);            
            $this->session->set_userdata('Tsprojectname', $projectName);
            $this->session->set_userdata('Tscons', $dbprofile);
        }      
            $cons = $this->session->userdata('Tscons');
            // var_dump($cons);exit();


        // $table = 'newsfeed';
        // $crit = array(
        //     'project_no'=>$project_no,
        //     'entity_cd'=>$entity);
        // $dtNews = $this->m_wsbangun->getData_by_criteria($table, $crit);

        $table = "SELECT descs,address1,coordinat_project,coordinat_name,coordinat_address from mgr.pl_project where entity_cd='$entity' and project_no='$project_no'";        
        $table2 = "SELECT feature_info from mgr.rl_project_feature where entity_cd='$entity' and project_no='$project_no'";
        $table3 = "SELECT overview_info, url_brochure, youtube_link from mgr.rl_project_overview where entity_cd='$entity' and project_no='$project_no'";
        $table4 = "SELECT amenities_type,amenities_info from mgr.rl_project_amenities where entity_cd='$entity' and project_no='$project_no'";
        $table5 = "SELECT line_no,gallery_url,gallery_title from mgr.rl_project_gallery where entity_cd='$entity' and project_no='$project_no' order by line_no";
        $table6 = "SELECT line_no,plan_url,plan_title from mgr.rl_project_plan where entity_cd='$entity' and project_no='$project_no' order by line_no";
        $dtNews = $this->m_wsbangun->getData_by_query_cons($cons,$table);
        $dtNews2 = $this->m_wsbangun->getData_by_query_cons($cons,$table2);
        $dtNews3 = $this->m_wsbangun->getData_by_query_cons($cons,$table3);
        $dtNews4 = $this->m_wsbangun->getData_by_query_cons($cons,$table4);
        $dtNews5 = $this->m_wsbangun->getData_by_query_cons($cons,$table5);
        $dtNews6 = $this->m_wsbangun->getData_by_query_cons($cons,$table6);


        $table7 = "SELECT handphone FROM mgr.pl_project WHERE entity_cd='$entity' AND project_no='$project_no'";
        $dtNews7 = $this->m_wsbangun->getData_by_query_cons('ifca3',$table7);
        if(!empty($dtNews7)){
                foreach ($dtNews7 as $newsfeed) {
                    $handphone = $newsfeed->handphone;
             }
        }else{
            // foreach ($dtNews7 as $newsfeed) {
                $handphone = '6285718517795';
            // }
        }
        // var_dump($table7);exit();
        // var_dump($dtNews7);exit();


        // $table2 = 'pl_project';
        // $crit2 = array('project_no' => $project_no,
        //     'entity_cd'=>$entity);

        // $descProject = $this->m_wsbangun->getData_by_criteria($table2, $crit2);
        // // $descs = $dtNews->descs;
        // $Descs = $descProject[0]->descs;
        // $nupMenu = $descProject[0]->nup_menu;
        // $bookingMenu = $descProject[0]->booking_menu;
        
        // var_dump($dtNews);
        $iconic = array('bg-green','bg-blue','bg-yellow','bg-red');
        $list_nf = '';
        $data = null;
        if(!empty($dtNews)){
            // $list_nf .= '<div class="lightBoxGallery">';
                foreach ($dtNews as $newsfeed) {
                    $projectName = $newsfeed->descs;
                    // var_dump($projectName);exit();
            }
        }
            $brochure = "";
            $list_nf .= '<div class="ibox">';
            $list_nf .= '<div class="ibox-content" style="background: #ffffff; padding-left: 30px;">';
            $list_nf .= '<h2><span style="line-height: 2.3em;
            display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Project Overview</span></h2>';
            if(!empty($dtNews)){
                // var_dump($dtNews);exit();
                foreach ($dtNews3 as $newsfeed) {
                    // var_dump($$newsfeed->url_brochure);exit();
                $list_nf .= '<div style = "margin-top:10px;"><p>'.$newsfeed->overview_info.'</p></div>';
                // $brochure = "";
                if (!empty($newsfeed->url_brochure)) {
                    $brochure = $newsfeed->url_brochure;
                }
                else{
                    $brochure = "";
                }
            }
            // var_dump($brochure);exit();
        }  
        $list_nf .= '</div>';                    
        $list_nf .= '</div>';  

        $list_nf .= '<div class="ibox">';
        $list_nf .= '<div class="ibox-content" style="background: #ffffff; padding-left: 30px;">';
        $list_nf .= '<h2><span style="line-height: 2.3em;
            display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Project Feature</span>';
        if(!empty($dtNews)){
                foreach ($dtNews2 as $newsfeed) {
                $list_nf .= '<div style = "margin-top:10px;"><pre style="border:0px; background: #ffffff;">'.$newsfeed->feature_info.'</pre></div>';
            } 
        }
        $list_nf .= '</div>';                    
        $list_nf .= '</div>'; 


        // $list_nf .= '<div class="ibox">';
        // $list_nf .= '<div class="ibox-content" style="background: #ffffff; padding-left: 30px;">';
        // $list_nf .= '<h3>Plan</h3>';
        // if(!empty($dtNews)){
        //     $list_nf .= '<div class="lightBoxGallery">';
        //         foreach ($dtNews6 as $newsfeed) {
        //     $a = (substr($newsfeed->plan_url,0,4)=='http' ? '<a href="#" class="pop" ><img class="img-responsive" src="'.$newsfeed->plan_url.'" alt="'.$newsfeed->plan_url.'"></a>' : '<a href="#" class="pop"><img src="'.base_url($newsfeed->plan_url).'" alt="'.$newsfeed->plan_url.'"></a>');
        //     $list_nf .= $a;
            
        //         } 
                
        //     }    
        //     $list_nf .= '</div>';
        //     $list_nf .= '</div>';   
        //     $list_nf .= '</div>';

        //     $list_nf .= '<div class="ibox">';
        //     $list_nf .= '<div class="col-lg-10">';
        //     $list_nf .= '</div>';                    
        //     $list_nf .= '<div class="ibox-content" style="background: #ffffff; padding-left: 30px;">';
            if(!empty($dtNews)){
                foreach ($dtNews as $newsfeed) {
                    $name = $newsfeed->coordinat_name;
                    $address = $newsfeed->coordinat_address;
             }
        }
                     else{
                $maps = "";
             }

             if(!empty($dtNews)){
                foreach ($dtNews as $newsfeed) {
                    $maps = $newsfeed->coordinat_project;
             }
        }

        $type2 = "";
        $type3 = "";
        $type4 = "";
        $type5 = "";
        if(!empty($dtNews)){
                foreach ($dtNews4 as $newsfeed) {
                   $type = $newsfeed->amenities_type;
                   if ($type=="O") {
                       $type2 = $newsfeed->amenities_info;
                   }
                   elseif ($type=="S") {
                       $type3 = $newsfeed->amenities_info;
                   }
                   elseif ($type=="I") {
                       $type4 = $newsfeed->amenities_info;
                   }
                   elseif ($type=="H") {
                       $type5 = $newsfeed->amenities_info;
                   }
                   // $newsfeed->amenities_info;
                } 

            }
        else{
            $type2 = "";
            $type3 = "";
            $type4 = "";
            $type5 = "";
        }
        
       
        

        
        // $table = 'attach_newsfeed';
        // $crit = array('entity_cd'=>$entity,
        //      'project_no'=>$project
        //      // ,'seq_no'=>$seqno
        //      );
        // $dtPdf = $this->m_wsbangun->getData_by_criteria($table, $crit);

        // var_dump($dtPdf);exit();
        
            // $list_nf .= '<div class="ibox">';
            // $list_nf .= '<div class="col-lg-10">';
            // $list_nf .= '</div>';  
            // // $list_nf .= '<div class="row">';
                    
            //              $list_nf .= '<div class="ibox-content" style="background: #ffffff; padding-left: 30px;">';
            //                  $list_nf .= '<div class="table-responsive">';
            //                      $list_nf .= '<h2><span style="line-height: 2.3em;
            // display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">Project Attachment</span></h2>';

                                 
            //                          $list_nf .= '<table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">';
            //                          $list_nf .= '<thead>';            
            //                             $list_nf .= '<th>No</th>';
            //                              $list_nf .= '<th>Description</th>';
            //                             $list_nf .= '<th>File Name</th>';
            //                             $list_nf .= '<th>Action</th>';
            //                              $list_nf .= '</thead>';
                                       
            //                               $i=1;
            //                               foreach ($dtPdf as $newsfeed) { 
            //                             $list_nf .= '<tbody>';
            //                              $list_nf .= '<td>'.$i.'</td>';
            //                              $list_nf .= '<td>'.$newsfeed->descs.'</td>';
            //                             $list_nf .= '<td>'.$newsfeed->file_name.'</td>';
            //                             $list_nf .= '<td><button id="'.$newsfeed->id.'" class="btn biru-bg btn-sm" onclick="opendownload(\''.$newsfeed->file_name.'\')"><i class="fa fa-file "></i> <span class="hidden-xs">&nbsp;Download</span></button></td>';
            //                              $list_nf .= '</tbody>';
            //                              $i++;
            //                               }
            //                          $list_nf .= '</table>';
                               
            //                  $list_nf .= '</div>';
            //              $list_nf .= '</div>';
                   
            //       // $list_nf .= '</div>';
            // $list_nf .= '</div>';

    //         $list_nf .= '<div class="ibox">';
    //         $list_nf .= '<div class="col-lg-10">';
    //         $list_nf .= '</div>';                    
    //         $list_nf .= '<div class="ibox-content" style="background: #ffffff; padding-left: 30px;">';
    //         $list_nf .= '<h2><span style="line-height: 2.3em;
    //         display: inline-block;border-bottom: #00a1e4 5px solid; font-size:18px;">'.$newsfeed->descs.'</span></h2>';
    // // $list_nf .= '<h2><span style="line-height: 2.3em;
    // // display: inline-block;border-bottom: #ffbc21 5px solid; font-size:18px;">'.$newsfeed->subject.'</span></h2>';

    //             $list_nf .= '<div style = "margin-top:10px;"><pre style="border:0px; background: #ffffff;">'.$newsfeed->file_name.'</pre></div>'; 
    //             // $list_nf .= '<div style = "margin-top:10px;"><pre style="border:0px; background: #ffffff;">'.$newsfeed->pdf.'</pre></div>';
    //             $list_nf .= '<span class="vertical-date">';
    //             // $list_nf .= '<small>'.date_format(new DateTime($newsfeed->date_created),"d F Y").'</small>';
    //             $list_nf .= '</span></div></div>';
            
        // var_dump($dtPdf);exit();

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
            'error'=>$data,
            'list_nf'=>$list_nf,
            'pdfname'=>$pdfname,
            // 'pdf'=>$dtPdf,
            'projectName'=>$projectName,
            'iconstatus' =>$status,
            'project_no'=>$project_no,
            'DataSurvey'=>$surv,
            'name'=>$user_id,
            'Surveyy'=>$surveyy,
            'infoo'=>$type2,
            'infos'=>$type3,
            'infoi'=>$type4,
            'infoh'=>$type5,
            'maps'=>$maps,
            'dtNews3'=>$dtNews3,
            'dtNews5'=>$dtNews5,
            'dtNews6'=>$dtNews6,
            'name'=>$name,
            'address'=>$address,
            'brochure'=>$brochure,
            'handphone' => $handphone,
            );
        // var_dump($handphone);exit();

        $this->load_content_top_menu('newsfeed/newsfeed', $content);

    }
    public function pdf($namapdf)
    {
        $data['file_name']=$namapdf;
        // var_dump($data['pdf_name']);exit();
        $this->load->view('newsfeed/download',$data);
    }

    public function send(){

        $name = $this->session->userdata('Tsuname');
        $entity = $this->session->userdata('Tsentity');
        $project_no = $this->session->userdata('Tsproject');
        $project = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');

        $callback = array(
            'Data' => null,
            'Error' => true,
            'Pesan' => '',
            'Status'=> 200
        );

        $subj    = $this->input->post('subject',TRUE);
        $notlp = $this->input->post('notlp', true);
        $cc = $this->input->post('emailcc', true);
        $footer = '';

        $table = 'v_emailtemplate';
        $where = array(
            'Email_Id' => 1
        );
        $data = $this->M_wsbangun->getData_by_criteria_adm($table,$where);
        $body = $data[0]->body;
        $id = $data[0]->Template_Id;

        $sql1 = "SELECT email_add from mgr.pl_project where entity_cd='$entity' and project_no='$project_no'";
        $dt = $this->M_wsbangun->getData_by_query_cons($cons,$sql1);   
        // $email = $dt[0]->email_add;
        $email = 'reza.julian@ifca.co.id';

        $body = str_replace(array('{{name}}','{{project_name}}','{{email}}'), array($name,$project,$email), $body);

        $data = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project_no,
                    'name'=>$name,
                    'handphone'=>$notlp,
                    'description'=>$body
                );
        $_save = $this->M_wsbangun->insertData_cons('ifca3','contact',$data);

        $data = array(
            'code'      => $body,
            'footer'    => $footer
        );

        if ($id==1) {
            $temp = $this->load->view('EmailTemplate/sendemail',$data, true);
        }
        if ($id==2) {
            $temp = $this->load->view('EmailTemplate/sendemail2',$data, true);
        }
        if ($id==3) {
            $temp = $this->load->view('EmailTemplate/sendemail3',$data, true);
        }
        // $this->load->view('EmailTemplate/sendemail',$data);
        $send = $this->_sendgmail($email, $cc, $subj, $temp);
        if ($send=="OK") {
            $callback['Error'] = false;
            $callback['Pesan'] = "Email Sent";
        }
        else{
            $callback['Error'] = true;
            $callback['Pesan'] = "Email failed to send";
        }

        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

    public function sendemail(){
        $name = $this->session->userdata('Tsuname');
        $entity = $this->session->userdata('Tsentity');
        $project_no = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');

        $notlp = $this->input->post('notlp', true);
        $Desc = $this->input->post('text', true);
        $Email_cc = $this->input->post('emailcc', true);

        $sql1 = "SELECT email_add from mgr.pl_project where entity_cd='$entity' and project_no='$project_no'";
        $dt = $this->M_wsbangun->getData_by_query_cons($cons,$sql1);   
        $Email = $dt[0]->email_add;

        if(empty($name) ){
            $Error = true;
            $Psn = "Data Not Valid";
        }
        else{  
            $data = array(
                    'entity_cd'=>$entity,
                    'project_no'=>$project_no,
                    'name'=>$name,
                    'handphone'=>$notlp,
                    'description'=>$Desc,
                    // 'userID'=>$userid
                );
            $where = array(
                        'name'=> $name);
            $_save = $this->M_wsbangun->insertData_cons('ifca3','contact',$data);
            if($_save != 'OK'){
                $Error=true;
                $Psn = $_save;
            }else{

                 $query = "mgr.x_send_mail_contact '".$Email."','".$Email_cc."','".$name."','".$notlp."','".$Desc."'";
                $PsnMail = $this->M_wsbangun->setData_by_query_cons('ifca3',$query);
                $aaa = strpos($PsnMail,'queued');
                if( $aaa <= 0 || !$aaa){
                    if($PsnMail=='OK'){
                        $Error = false;
                        $Psn = 'Please cek your email';
                    }else{
                        $msg = $PsnMail;                        
                        $Psn = 'Sent Email Failed, Please Contact your Admin!';  
                    }
                    
                }else{
                    $Psn = 'Please cek your email';
                    $Error = false;
                }

                $Error = false;
                $Psn = "Send Success";
            }
            
        }
        $msg1=array("Pesan"=>$Psn,
                        "Error"=>$Error);
        echo json_encode($msg1);
    }

    public function wa()
    {
        $entity = $this->session->userdata('Tsentity');
        $project_no = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $table6 = "SELECT handphone FROM mgr.pl_project WHERE entity_cd='$entity' AND project_no='$project_no'";
        $dtNews7 = $this->m_wsbangun->getData_by_query_cons('ifca3',$table6);
        if(!empty($dtNews7)){
                foreach ($dtNews7 as $newsfeed) {
                    $handphone = $newsfeed->handphone;
             }
        }
        $data = array(
            'handphone'=>$handphone,
            'name'=>$name
        );
        $this->load->view('newsfeed/whatsapp',$data);
    }

    public function download($filename = NULL) 
    {
        // alert('klik');
        // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents(base_url('./pdf/NewsFeed/'.$filename));
        force_download($filename, $data);
    }
    public function indexOLD($year = null, $month = null)
    {
        if(intval($year)==0) {
            $year = null;
            $month = null;
        }
        $datanewsfeed = $this->m_newsfeed->get_all();
        $list_nf = "";
        $data = null;
        $iconic = array('bg-green','bg-blue','bg-yellow','bg-red');
        foreach ($datanewsfeed as $newsfeed) {
            $list_nf .= '<div class="vertical-timeline-content">';
            $list_nf .= '<h2>'.$newsfeed->subject.'</h2>';
            if(!empty($newsfeed->picture)){
                $list_nf .= '<div class="margin"><img src="'.$this->config->item('energy_url').'lainnya/uploads/'.$newsfeed->picture.'" alt="" class="img-responsive" /></div>';
            }
            if($newsfeed->youtube_link!=''){
                $list_nf .= '<div class="embed-responsive embed-responsive-16by9">'."\n";
                $list_nf .= '<iframe class="embed-responsive-item" src="'.$newsfeed->youtube_link.'" frameborder="0" allowfullscreen></iframe></div>'."\n";
            }
            $list_nf .= '<p>'.$newsfeed->content.'</p>';
            $list_nf .= '<span class="vertical-date">'.date_format(new DateTime($newsfeed->date_created),"d F Y").'</span>';
            $list_nf .= '</div>';

            // $list_nf .= '<li><i class="fa fa-comments '.$iconic[$newsfeed->status].'"></i><div class="timeline-item">';
            // $list_nf .= '<span class="time">'.date_format(new DateTime($newsfeed->date_created),"d F Y").'</span>';
            // $list_nf .= '<h3 class="timeline-header">'.$newsfeed->subject.'</h3>';
            // $list_nf .= '<div class="timeline-body">';
            // if(!empty($newsfeed->picture)){
            //     $list_nf .= '<div class="margin"><img src="'.$this->config->item('energy_url').'lainnya/uploads/'.$newsfeed->picture.'" alt="" class="img-responsive" /></div>';
            // }
            // if($newsfeed->youtube_link!=''){
            //     $list_nf .= '<div class="embed-responsive embed-responsive-16by9">'."\n";
            //     $list_nf .= '<iframe class="embed-responsive-item" src="'.$newsfeed->youtube_link.'" frameborder="0" allowfullscreen></iframe></div>'."\n";
            // }
            // $list_nf .= $newsfeed->content;
            // $list_nf .= '</div></div></li>'."\n";
        }
        
        $content = array(
            'error'=>$data,
            'list_nf'=>$list_nf
        );

        $this->load_content('newsfeed/newsfeed', $content);
    }
}
