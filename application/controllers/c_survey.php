<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_survey extends Core_Controller
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
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
    

        $content = array(
            'Survey'=>$this->zoom_subject()
          );

        $this->load_content_top_menu('survey_post/index',$content);
    }
  public function detail($id='')
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
    

        $content = array(
            'Survey'=>$this->zoom_subject_dtl($id)
          );

        $this->load_content_top_menu('survey_post/index_detail',$content);
    }
    public function zoom_subject()
    {
      $entity = $this->session->userdata('Tsentity');
      $project = $this->session->userdata('Tsproject');
      $cons = $this->session->userdata('Tscons');
      $user_id = $this->session->userdata('Tsname');
      // var_dump($user_id);exit();
     
      $publishProject = ' ';

          $QuerySql2 = "SELECT  distinct publish_id,title,audit_date,publishdate FROM mgr.fn_Survey_user('$entity','$project','$user_id') ORDER BY  audit_date";
          $Exec = $this->m_wsbangun->getData_by_query_cons('ifca3', $QuerySql2);
          if (!empty($Exec)) {

            foreach($Exec as $key) {
                $publishdate=date('Y-m-d',strtotime($key->publishdate)).' '.date('H:i:s',strtotime($key->audit_date));
                  // var_dump($publishdate);exit();
                $publishProject.= 
                '<div class="row">
                    <div class="col-12">
                      <div class="card">
                      <div class="card-content collapse show">
                      <div class="card-body card-dashboard">
                      <hr><h2 style="color: #0a3a99">' .  $key->title . '</h2><hr>
                      <div class="pull-left"><i>'.$this->time_elapsed_string($publishdate).'</i> <br> <small>at '.date('g:i a',strtotime($key->audit_date)).' - '.date('j F Y',strtotime($key->publishdate)).'</small></div>
                      <div class="pull-right"><a class="btn btn-primary" href="'.base_url('c_survey/detail/').$key->publish_id.'">Click to see this survey <i class="fa fa-arrow-right"></i></a>
                      </div>
                            </div>
                      </div>
                      <br><br>
                      </div>
                    </div>
                  </div>';
       

            } //END LOOPING
          
          }
          else {
            $publishProject = '<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">Survey Belum Tersedia Untuk Anda</div>
                            </div>
                        </div>
                    </div>
                </div>';
          }


      return $publishProject;
    }
  public function zoom_subject_dtl($id='')
    {
      $entity = $this->session->userdata('Tsentity');
      $project = $this->session->userdata('Tsproject');
      $cons = $this->session->userdata('Tscons');
      $user_id = $this->session->userdata('Tsname');
      $publishProject = ' ';
      // $QuerySql = "SELECT COUNT(*) as cnt FROM mgr.fn_Survey_user('$entity','$project','$user_id')  ";
      // $Cnt = $this->m_wsbangun->getData_by_query_cons('ifca3', $QuerySql);
      // $Cnt = $Cnt[0]->cnt;
      // // var_dump($Cnt);exit();
      
      // // var_dump($Cnt);exit();
      // // if ($user_id == 'ADMIN') {
      //   if ($Cnt != 0) {
          $QuerySql2 = "SELECT * FROM mgr.fn_Survey_user('$entity','$project','$user_id') where publish_id = '$id' ORDER BY  entity_cd,  project_no,  publish_id,survey_id,line_no";
          $Exec = $this->m_wsbangun->getData_by_query_cons('ifca3', $QuerySql2);
          if (!empty($Exec)) {
            $batas = 0;
            $bat = 0;
            $no = 0;
            $pus = '';
            $no_opt = 0;
            $s = '';$q = '';$f = '';$g = '';$k = '';
            $l = '';$o = '';$t = '';$x = '';$y = '';
            $z = '';$z1 = '';$bs = '';$bq = '';
            foreach($Exec as $key) {
              $s = $key->title;
              $c = '';
              if ($s != $q) {
                $no = 0;
                $publishProject.= '<hr><h2 style="color: #0a3a99">' . $s . '</h2>';
                // $publish = $key->publish_id;
                // $publishProject.= '<input type="hidden" name="txtpublish[]" id="txtpublish" value="' . $publish . '" >';
              }
              $publish = $key->publish_id;
                $publishProject.= '<input type="hidden" name="txtpublish[]" id="txtpublish" value="' . $publish . '" >';
              $q = $s;
              $f = $key->content;
              $h = '';
              if ($f != $g) {
                
                $no_ur = "SELECT line_no+1 as no_urut,* from mgr.pm_publishsurvey where entity_cd='$entity' AND project_no ='$project' AND publish_id = '$key->publish_id' AND  survey_id ='$key->survey_id' order by publish_id";
                $Count = $this->m_wsbangun->getData_by_query_cons('ifca3', $no_ur);
                $no++;
                $no_opt++;
                if($no_opt!=1){
                  $publishProject.= '</div>';
                }
                $publishProject.= '<hr><br /><div class="satupertanyaan"><label>' . $Count[0]->no_urut . '. ' . $key->content . '</label><br />';
                $bat++;
              }

              // console.log(q);

              $g = $f;

              // NO Jawaban

              $k = $key->survey_id;
              $p = 1;
              if ($k != $l) {
                $p+= 1;
              }

              $l = $k;
              $x = $key->options;
              if ($x != $y) {
                $publishProject.= "<div class='i-checks'>";
                $publishProject.= '<br />&nbsp&nbsp&nbsp<input type="radio" class="required" name="txtRespon' . $no_opt . '" id="txtRespon" value=' . $key->line_no . '> ' . $key->options . '</input>';
                $publishProject.= "</div>";

                // Jawaban

                if ($key->flag == 1) {
                  $publishProject.= '&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" style="width:20%" class="form-control" name="txtRemark' . $no_opt . '" id="txtRemark" placeholder="Input Answer">';
                }
              }

              $y = $x;
              $o = $key->survey_id;
              $e = '';
              if ($o != $t) {
                $e = $key->survey_id;
                $publishProject.= '<input type="hidden" name="txtSurveyNum[]" id="txtSurvey" value="' . $e . '" >';
                $publishProject.= '<input type="hidden" name="txtSurvey' . $e . '" id="txtSurvey" value="' . $e . '" >';
              }


              // console.log(q);

              $t = $o;
              $survey = $key->survey_id;
            } //END LOOPING
            $publishProject.= '<input type="hidden" name="batas" id="batas" value="' . $bat . '" >';
            $publishProject.= '<br />';
          }
          else {
            $publishProject = 'Survey Belum Tersedia Untuk Anda';
          }
        // }
        // else {
        //   $publishProject = "Survey Belum Tersedia Untuk Anda";
        // }
      // }

      return $publishProject;
    }

    // public function save_yg_lama(){

    //     $msg="";
    //     if ($_POST)
    //     {
    //         $survey_id = $this->input->post('txtsubject');
    //         $form = $this->input->post('form');
    //         $cons = $this->session->userdata('Tscons');
    //         // $line_no = $this->input->post('line_no');
    //         $project = $this->session->userdata('Tsproject');
    //         $entity = $this->session->userdata('Tsentity');
    //         $title = $this->input->post('txttitle');
    //         $survey_id = $this->input->post('txtSurvey');
    //         $publish_id = $this->input->post('txtpublish');
    //         // $publish_id = $this->input->post('publish_id');
    //         $publish = $this->input->post('publishDate');
    //         $expired = $this->input->post('ExpiredDate');
    //         $batas = $this->input->post('batas');
            
    //         $remark = $this->input->post('txtRemark');
    //         $user = $this->session->userdata('Tsname');
    //         // var_dump($survey_id);exit();
    //         $audit_date = date('d M Y H:i:s');
    //         $audit_user = $this->session->userdata('Tsname');
    //           // var_dump($audit_user);exit();
    //         $gg = 0;
    //         for($i = 0 ; $i < $batas ; $i++){
    //             // var_dump($i.' ahay '.$batas);exit();
    //           $gg++;
    //           // var_dump($gg);exit();    
    //             $dataSurvey = array(
    //             'entity_cd' => $entity,
    //             'project_no' => $project,
    //             'publish_id' => (Int)$publish_id[$i],
    //             'survey_id' => (Int)$this->input->post('txtSurvey'.$this->input->post('txtSurveyNum['.$i.']')),
    //             'respon'=> (Int)$this->input->post('txtRespon'.$gg),
    //             'remark'=>$this->input->post('txtRemark'.$gg),
    //             'user_id'=>$user,
    //             'datecreated' =>$audit_date,
    //             'audit_user'=>$audit_user,
    //             'audit_date'=>$audit_date
    //         );
    //           // var_dump($dataSurve);
    //                      // var_dump($dataSurvey);exit();
    //                $insertRespon = $this->m_wsbangun->insertData_cons($cons,'pm_surveyrespon',$dataSurvey);
    //                if ($insertRespon !='OK') {
    //                    $msg= $insertRespon;
    //                    $psn = 'Fail';
    //                    $ha = 'Insert header insert pm_surveyrespon fail';
    //                } else {
    //                    $msg="Data has been Insert successfully";
    //                    $psn = 'OK';
    //                    $ha = 'Insert header insert pm_surveyrespon Success';
    //                     }
                
    //           }   
           
   


    //         $msg1= array('pesan'=>$msg,
    //             'status'=>$psn,
    //             'ha'=>$ha);

    //         echo json_encode($msg1);

    //     }

    // }
    //dari btpn
    public function save(){

        $msg="";
        if ($_POST)
        {
            $survey_id = $this->input->post('txtsubject');
            $form = $this->input->post('form');
            $cons = $this->session->userdata('Tscons');
            // $line_no = $this->input->post('line_no');
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
            $title = $this->input->post('txttitle');
            $survey_id = $this->input->post('txtSurvey');
            $publish_id = $this->input->post('txtpublish');
            // $publish_id = $this->input->post('publish_id');
            $publish = $this->input->post('publishDate');
            $expired = $this->input->post('ExpiredDate');
            $batas = $this->input->post('batas');
            
            $remark = $this->input->post('txtRemark');
            $user = $this->session->userdata('Tsname');
            // var_dump($survey_id);exit();
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsname');
              // var_dump($audit_user);exit();
            $gg = 0;
            for($i = 0 ; $i < $batas ; $i++){
                // var_dump($i.' ahay '.$batas);exit();
              $gg++;
              // var_dump($gg);exit();    
                $dataSurvey = array(
                'entity_cd' => $entity,
                'project_no' => $project,
                'publish_id' => (Int)$publish_id[$i],
                'survey_id' => (Int)$this->input->post('txtSurvey'.$this->input->post('txtSurveyNum['.$i.']')),
                'respon'=> (Int)$this->input->post('txtRespon'.$gg),
                'remark'=>$this->input->post('txtRemark'.$gg),
                'user_id'=>$user,
                'datecreated' =>$audit_date,
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date
            );
              // var_dump($dataSurve);
                         // var_dump($dataSurvey);exit();
                   $insertRespon = $this->m_wsbangun->insertData_cons('ifca3','pm_surveyrespon',$dataSurvey);
                   if ($insertRespon !='OK') {
                       $msg= $insertRespon;
                       $psn = 'Fail';
                       $ha = 'Insert header insert pm_surveyrespon fail';
                   } else {
                       $msg="Data has been saved successfully";
                       $psn = 'OK';
                       $ha = 'Insert header insert pm_surveyrespon Success';
                        }
                
              }   
           
   


            $msg1= array('pesan'=>$msg,
                'status'=>$psn,
                'ha'=>$ha);

            echo json_encode($msg1);

        }

    }
}