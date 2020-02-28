<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_newsandpromo extends Core_Controller
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
        
        $project = $this->session->userdata('Tsproject');
        $seqno = $this->input->post('seqno', true);
        $pdfname='';
        $status='';
        // var_dump($this->session->userdata('is_Staff_logged'));    
        // var_dump($this->session->userdata('Tsentity'));
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
            $a = strrpos($paramDcd, '-');
            $project_no = substr($paramDcd, 0,$a);
            // var_dump($project_no)
            
            $projectName = str_replace('%20', ' ', substr($paramDcd, $a + 1));
            // $projectName = substr($param, 5);
            
            $Squery ="select max(entity_cd) as entity_cd ,max(entity_name) as entity_name from mgr.v_cfs_user_project where project_no ='$project_no' ";            
            $dd = $this->m_wsbangun->getData_by_query($Squery);
            $entity = $dd[0]->entity_cd;
            $entity_name = $dd[0]->entity_name;

            $sql ="select MenuPosition from mgr.v_security_users where entity_cd = '$entity' and project_no = '$project_no' and email_add='$email' ";            
            $dd2 = $this->m_wsbangun->getData_by_query($sql);
            $position ='T';
            if(!empty($dd2)){
                $position = $dd2[0]->MenuPosition;        
            }
            
            
            $this->session->unset_userdata('Tsentity');
            $this->session->unset_userdata('Tsproject');
            $this->session->unset_userdata('Tsprojectname');

            $this->session->set_userdata('TMenuPs',$position);
            $this->session->set_userdata('Tsentityname',$entity_name);
            $this->session->set_userdata('Tsentity', $entity);              
            $this->session->set_userdata('Tsproject', $project_no);            
            $this->session->set_userdata('Tsprojectname', $projectName);
            $this->session->set_userdata('Tscons', $dbprofile);
        }      
        $cons = $this->session->userdata('Tscons');



        // $table = 'newsfeed';
        // $crit = array(
        //     'project_no'=>$project_no,
        //     'entity_cd'=>$entity);
        // $dtNews = $this->m_wsbangun->getData_by_criteria($table, $crit);

        $table = "SELECT * FROM mgr.newsandpromo WHERE entity_cd = '$entity' and project_no = '$project_no' and start_date <= GETDATE() and GETDATE() <= end_date ORDER BY date_created desc";
        $dtNews = $this->m_wsbangun->getData_by_queryadm($table);

        // var_dump($dtNews);


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

        foreach ($dtNews as $newsfeed) { 
            $list_nf .= '<div class="card">';
            $list_nf .= '<div class="card-header">';            
            $list_nf .= '<h2 class="card-title"><span style="line-height: 2.3em;
            display: inline-block;border-bottom: #00a1e4 9px solid; font-size:18px;">'.$newsfeed->subject.'</span></h2></div>';
            $list_nf .= '<div class="card-body">';
    // $list_nf .= '<h2><span style="line-height: 2.3em;
    // display: inline-block;border-bottom: #ffbc21 5px solid; font-size:18px;">'.$newsfeed->subject.'</span></h2>';
              if($newsfeed->youtube_link != ''){
                //$list_nf .= '<div class="embed-responsive embed-responsive-16by9">'."\n";
                    $list_nf .= '<iframe style="background: #ffffff" width="100%" height="500" src="'.$newsfeed->youtube_link.'" frameborder="0" allowfullscreen></iframe>'."\n";
                }

                
                if(!empty($newsfeed->picture)){
                    $a = (substr($newsfeed->picture,0,4)=='http' ? '<div class="margin"><a href="#" class="pop" ><img class="img-responsive" src="'.$newsfeed->picture.'"></a></div>' : '<div class="margin"><a href="#"  class="pop"><img  class="img-responsive" src="'.base_url('img/NewsAndPromo/'.$newsfeed->picture).'" alt="pic-'.$newsfeed->picture.'"></a></div>');
                    
                }else{
                    $a = (substr($newsfeed->picture,0,4)=='http' ? '<div class="margin"><a href="#" class="pop"><img class="img-responsive" src="'.base_url('img/NewsAndPromo/'.$newsfeed->picture).'" alt="pic-'.$newsfeed->picture.'"></a></div>' : '<div class="margin"><a href="#" class="pop"><img id="myImg" class="img-responsive"></a></div>');

                }
                $list_nf .= $a;
                $date = substr($newsfeed->date_created, 0,10);
                $list_nf .= '<div style = "margin:10px; margin-top:20px; width:90%;">'.$newsfeed->content.'</div>'; 
                $list_nf .= '<div style = "margin-top:20px;"><pre style="border:0px; background: #ffffff;">'.$date.'</pre></div>';
                // $list_nf .= '<div style = "margin-top:10px;"><pre style="border:0px; background: #ffffff;">'.$newsfeed->pdf.'</pre></div>';
                $list_nf .= '<span class="vertical-date">';
                // $list_nf .= '<small>'.date_format(new DateTime($newsfeed->date_created),"d F Y").'</small>';
                $list_nf .= '</span></div></div>';


            //  
            // $pdfname=$newsfeed->pdf;
            // var_dump($pdfname);exit();
             }
        }
       
        
        // $cons = $this->session->userdata('Tscons');
        
        // $table = 'attach_newsfeed';
        // $crit = array('entity_cd'=>$entity,
        //      'project_no'=>$project
        //      // ,'seq_no'=>$seqno
        //      );
        // $dtPdf = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

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
        // $count = '';
        //   if ($publish[0]->cnt == 0) {
        //         $count = 'TIDAK';
        //     } else {
        //         $count = 'ADA';
        //     }
        // $surv = $count;    
        // $surveyy=$this->session->userdata('Is_Survey');
        // $this->session->set_userdata('Is_Survey',false );
        // var_dump($surveyy);exit();
        $content = array(
            'error'=>$data,
            'list_nf'=>$list_nf,
            'pdfname'=>$pdfname,
            // 'pdf'=>$dtPdf,
            'projectName'=>$projectName,
            'iconstatus' =>$status,
            'project_no'=>$project_no,
            // 'DataSurvey'=>$surv,
            'name'=>$user_id,
            // 'Surveyy'=>$surveyy
            );
        // 

        $this->load_content_top_menu('newsandpromo/newsfeed', $content);

    }
    public function pdf($namapdf)
    {
        $data['file_name']=$namapdf;
        // var_dump($data['pdf_name']);exit();
        $this->load->view('newsfeed/download',$data);
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
