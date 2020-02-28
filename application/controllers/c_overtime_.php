<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_overtime extends Core_Controller
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
        $name = $this->session->userdata('Tsname');
        // $email = $this->session->userdata('Tsemail');
        $group = $this->session->userdata('Tsusergroup');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        $Business_id = $this->session->userdata('Tsbusinessid');
       

        $content = array(
            'ProjectDescs'=>$projectName);
        
        $this->load_content_top_menu('overtime/index',$content);
    }
    public function cek_startOT(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $ot_id = $this->input->post('ot_id',TRUE);

        $sql = "SELECT count(*) as cnt from mgr.ot_trx where entity_cd = '".$entity."' AND project_no = '".$project."' and ot_id ='".$ot_id."' and convert(datetime,start_overtime) <= convert(datetime,getdate())  ";
        $dt = $this->m_wsbangun->getData_by_queryadm($sql);
        if($dt[0]->cnt >0){
            echo 'true';
        } else {
            echo 'false';
        }
    }
    public function zoom_debtor($debtor_acct){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $this->load->model('m_wsbangun'); 
        $table = 'ar_debtor';
        $cons = $this->session->userdata('Tscons');

        if(empty($debtor_acct) or $debtor_acct==''){
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project );
        } else {
            $crit = array('entity_cd' => $entity,
                    'project_no'=>$project,
                    'business_id'=>$debtor_acct );
        }
        $proDescs = $this->m_wsbangun->getData_by_criteria($table,$crit);
            $comboProject[] = '<option></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($debtor_acct === $dtProject->debtor_acct) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->debtor_acct.'-%-'.$dtProject->business_id.'">'.$dtProject->debtor_acct.'-'.$dtProject->name.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
      }
    public function tes(){
        $this->load->view('cs/tes');
    }
     
    public function zoom_category(){
        $location = $this->input->post('prod',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
        $sql = "select * from mgr.sv_category ";
        $rst = $this->m_wsbangun->getData_by_query($sql);
        //var_dump($rst);
        $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                
                $combo[] = '<option value="'.trim($result->category_cd).'" >'.$result->descs.'</option>';
            }
            return implode("", $combo);
      }

public function zoom_lot_no_in($debtor_acct=''){
    
       
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $cons = $this->session->userdata('Tscons');
        

        $sql = "SELECT mgr.pm_lot.lot_no ,mgr.pm_lot.level_no, mgr.pm_lot.descs , mgr.pm_lot.status FROM mgr.pm_lot (nolock) ";
        $sql .=" WHERE mgr.pm_lot.entity_cd = '".$entity."' ";
        $sql .=" and mgr.pm_lot.project_no = '".$project."' ";
        $sql .=" and mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_tenant_lot (nolock)  ";  
        $sql .="                where mgr.pm_tenant_lot.status <> 'T' ";
        $sql .="                AND mgr.pm_tenant_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_tenant_lot.project_no = mgr.pm_lot.project_no";
        $sql .="                AND  mgr.pm_tenant_lot.tenant_no  in   ";
        $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
        $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
        $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
        $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
        $sql .=" or  mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_owner_lot (nolock)  ";   
        $sql .="                where mgr.pm_owner_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_owner_lot.project_no = mgr.pm_lot.project_no";
        $sql .="                AND  mgr.pm_owner_lot.owner_acct  in   ";
        $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
        $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
        $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
        $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
        // var_dump($sql);exit();
        $proDescs =  $this->m_wsbangun->getData_by_query($sql);
        // var_dump($proDescs);exit();

        $comboProject[] = '<option value=""></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($debtor_acct === $dtProject->lot_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                  $comboProject[] = '<option '.$pilih.' value="'.$dtProject->lot_no.'-%-'.$dtProject->level_no.'-%-'.$dtProject->descs_level.'">'.$dtProject->lot_no.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
      }

      public function zoom_lot_no(){
        $debtor_acct = $this->input->post('debtor_acct',TRUE);
        $lotno = $this->input->post('Id',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        

        $sql = "SELECT mgr.pm_lot.lot_no ,mgr.pm_lot.level_no, mgr.pm_lot.descs , mgr.pm_lot.status, mgr.pm_lot.ot_over_cd, mgr.pm_lot.ot_zone_cd FROM mgr.pm_lot (nolock) ";
        $sql .=" WHERE mgr.pm_lot.entity_cd = '".$entity."' ";
        $sql .=" and mgr.pm_lot.project_no = '".$project."' ";
        $sql .=" and mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_tenant_lot (nolock)  ";  
        $sql .="                where mgr.pm_tenant_lot.status <> 'T' ";
        $sql .="                AND mgr.pm_tenant_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_tenant_lot.project_no = mgr.pm_lot.project_no";
        $sql .="                AND  mgr.pm_tenant_lot.tenant_no  in   ";
        $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
        $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
        $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
        $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
        $sql .=" or  mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_owner_lot (nolock)  ";   
        $sql .="                where mgr.pm_owner_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_owner_lot.project_no = mgr.pm_lot.project_no";
        $sql .="                AND  mgr.pm_owner_lot.owner_acct  in   ";
        $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
        $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
        $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
        $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
        // var_dump($sql);
        $proDescs =  $this->m_wsbangun->getData_by_query($sql);
        // var_dump($entityName);
        $comboProject[] = '<option value=""></option>';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($lotno === $dtProject->lot_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                  $comboProject[] = '<option '.$pilih.' value="'.$dtProject->lot_no.'-%-'.$dtProject->level_no.'-%-'.$dtProject->ot_over_cd.'-%-'.$dtProject->ot_zone_cd.'">'.$dtProject->lot_no.'</option>';
                }
                // $comboProject = implode("", $comboProject);
            }
            echo implode("", $comboProject);
      }

  // public function zoom_lot_no(){
    
       
  //       $entity = $this->session->userdata('Tsentity');
  //       $project = $this->session->userdata('Tsproject');
  //       $name = $this->session->userdata('Tsuname');
  //       $cons = $this->session->userdata('Tscons');
        

  //       // $sql = "SELECT mgr.pm_lot.lot_no,mgr.pm_lot.level_no,mgr.pm_lot.descs,mgr.pm_lot.status, ";
  //       // $sql .=" debtor_acct = (CASE WHEN ( ";
  //       // $sql .="                             SELECT MAX(ptl.tenant_no) FROM mgr.pm_tenant_lot ptl WITH(NOLOCK) ";
  //       // $sql .="                             WHERE ptl.entity_cd = mgr.pm_lot.entity_cd ";
  //       // $sql .="                             AND ptl.project_no = mgr.pm_lot.project_no ";
  //       // $sql .="                             AND ptl.lot_no = mgr.pm_lot.lot_no ";
  //       // $sql .="                 ) IS NOT NULL THEN ( ";
  //       // $sql .="                             SELECT MAX(ptl.tenant_no) FROM mgr.pm_tenant_lot ptl WITH(NOLOCK) ";
  //       // $sql .="                             WHERE ptl.entity_cd = mgr.pm_lot.entity_cd ";
  //       // $sql .="                             AND ptl.project_no = mgr.pm_lot.project_no ";
  //       // $sql .="                             AND ptl.lot_no = mgr.pm_lot.lot_no ";
  //       // $sql .="                ) ELSE ( SELECT MAX(pol.owner_acct) FROM mgr.pm_owner_lot pol WITH(NOLOCK) ";
  //       // $sql .="                            WHERE pol.entity_cd = mgr.pm_lot.entity_cd ";
  //       // $sql .="                            AND pol.project_no = mgr.pm_lot.project_no ";
  //       // $sql .="                            AND pol.lot_no = mgr.pm_lot.lot_no)                              ";
  //       // $sql .="                END ) , ";
  //       // $sql .=" pl.descs AS descs_level  ";
  //       // $sql .=" FROM   mgr.pm_lot (NOLOCK)  ";
  //       // $sql .=" INNER JOIN mgr.pm_level AS pl WITH(NOLOCK) ";
  //       // $sql .=" ON pl.entity_cd = mgr.pm_lot.entity_cd ";
  //       // $sql .=" AND pl.project_no = mgr.pm_lot.project_no ";
  //       // $sql .=" AND pl.level_no = mgr.pm_lot.level_no ";



  //       // $sql .=" WHERE mgr.pm_lot.entity_cd = '".$entity."' ";
  //       // $sql .=" and mgr.pm_lot.project_no = '".$project."' ";
  //       // $sql .=" and mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_tenant_lot (nolock)  ";  
  //       // $sql .="                where mgr.pm_tenant_lot.status <> 'T' ";
  //       // $sql .="                AND mgr.pm_tenant_lot.entity_cd  = mgr.pm_lot.entity_cd";
  //       // $sql .="                AND  mgr.pm_tenant_lot.project_no = mgr.pm_lot.project_no";
  //       // $sql .="                AND  mgr.pm_tenant_lot.tenant_no  IN (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK) WHERE ad.business_id = '$debtor' )) ";
  //       // $sql .=" or  mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_owner_lot (nolock)  ";   
  //       // $sql .="                where mgr.pm_owner_lot.entity_cd  = mgr.pm_lot.entity_cd";
  //       // $sql .="                AND  mgr.pm_owner_lot.project_no = mgr.pm_lot.project_no";
  //       // $sql .="                AND  mgr.pm_owner_lot.owner_acct  IN (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK) WHERE ad.business_id = '$debtor'))";

  //       // $sql = "SELECT mgr.pm_lot.lot_no, ";
  //       // $sql .="       mgr.pm_lot.level_no, ";
  //       // $sql .="       mgr.pm_lot.descs, ";
  //       // $sql .="       mgr.pm_lot.status, ";
  //       // $sql .="       debtor_acct = ( CASE ";
  //       // $sql .="                         WHEN (SELECT Max(ptl.tenant_no) ";
  //       // $sql .="                               FROM   mgr.pm_tenant_lot ptl WITH(nolock) ";
  //       // $sql .="                               WHERE  ptl.entity_cd = mgr.pm_lot.entity_cd ";
  //       // $sql .="                                      AND ptl.project_no = mgr.pm_lot.project_no ";
  //       // $sql .="                                      AND ptl.lot_no = mgr.pm_lot.lot_no) IS NOT NULL"; 
  //       // $sql .="                       THEN ";
  //       // $sql .="                                 ( SELECT max(mgr.ot_min_hours.bill_debtor_acct) ";
  //       // $sql .="                                  FROM   mgr.pm_tenant_lot ptl WITH(nolock) ";
  //       // $sql .="                                  left outer join mgr.ot_min_hours ";
  //       // $sql .="                                  on ptl.entity_cd = mgr.ot_min_hours.entity_cd ";
  //       // $sql .="                                  and ptl.project_no = mgr.ot_min_hours.project_no";
  //       // $sql .="                                  and ptl.tenant_no = mgr.ot_min_hours.debtor_acct";
  //       // $sql .="                                  WHERE  ptl.entity_cd = mgr.pm_lot.entity_cd ";
  //       // $sql .="                                         AND ptl.project_no = mgr.pm_lot.project_no ";
  //       // $sql .="                                         AND ptl.lot_no = mgr.pm_lot.lot_no) ";
  //       // $sql .="                         ELSE (SELECT Max(pol.owner_acct) ";
  //       // $sql .="                               FROM   mgr.pm_owner_lot pol WITH(nolock) ";
  //       // $sql .="                               WHERE  pol.entity_cd = mgr.pm_lot.entity_cd ";
  //       // $sql .="                                      AND pol.project_no = mgr.pm_lot.project_no ";
  //       // $sql .="                                      AND pol.lot_no = mgr.pm_lot.lot_no) ";
  //       // $sql .="                       END ), ";
  //       // $sql .="       pl.descs AS descs_level ";
  //       // $sql .="FROM   mgr.pm_lot (nolock) ";
  //       // $sql .="       INNER JOIN mgr.pm_level AS pl WITH(nolock) ";
  //       // $sql .="               ON pl.entity_cd = mgr.pm_lot.entity_cd ";
  //       // $sql .="                  AND pl.project_no = mgr.pm_lot.project_no ";
  //       // $sql .="                  AND pl.level_no = mgr.pm_lot.level_no ";
  //       // $sql .="WHERE  mgr.pm_lot.entity_cd = '".$entity."' ";
  //       // $sql .="       AND mgr.pm_lot.project_no = '".$project."' ";
  //       // $sql .="       AND mgr.pm_lot.lot_no IN (SELECT lot_no ";
  //       // $sql .="                                 FROM   mgr.pm_tenant_lot (nolock) ";
  //       // $sql .="                                 WHERE  mgr.pm_tenant_lot.status <> 'T' ";
  //       // $sql .="                                        AND mgr.pm_tenant_lot.entity_cd = ";
  //       // $sql .="                                            mgr.pm_lot.entity_cd ";
  //       // $sql .="                                        AND mgr.pm_tenant_lot.project_no = ";
  //       // $sql .="                                            mgr.pm_lot.project_no ";
  //       // $sql .="                                        AND mgr.pm_tenant_lot.tenant_no IN ";
  //       // $sql .="                                            (SELECT ad.debtor_acct ";
  //       // $sql .="                                             FROM   mgr.ar_debtor ad WITH(nolock)";
  //       // $sql .="                                             WHERE  ad.business_id = '$debtor')) ";
  //       // $sql .="        OR mgr.pm_lot.lot_no IN (SELECT lot_no ";
  //       // $sql .="                                 FROM   mgr.pm_owner_lot (nolock) ";
  //       // $sql .="                                 WHERE  mgr.pm_owner_lot.entity_cd = ";
  //       // $sql .="                                        mgr.pm_lot.entity_cd ";
  //       // $sql .="                                        AND mgr.pm_owner_lot.project_no = ";
  //       // $sql .="                                            mgr.pm_lot.project_no ";
  //       // $sql .="                                        AND mgr.pm_owner_lot.owner_acct IN ";
  //       // $sql .="                                            (SELECT ad.debtor_acct ";
  //       // $sql .="                                             FROM   mgr.ar_debtor ad WITH(nolock)";
  //       // $sql .="                                             WHERE  ad.business_id = '$debtor')) ";

  //       $sql = "SELECT mgr.pm_lot.lot_no ,mgr.pm_lot.level_no, mgr.pm_lot.descs , mgr.pm_lot.status FROM mgr.pm_lot (nolock) ";
  //       $sql .=" WHERE mgr.pm_lot.entity_cd = '".$entity."' ";
  //       $sql .=" and mgr.pm_lot.project_no = '".$project."' ";
  //       $sql .=" and mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_tenant_lot (nolock)  ";  
  //       $sql .="                where mgr.pm_tenant_lot.status <> 'T' ";
  //       $sql .="                AND mgr.pm_tenant_lot.entity_cd  = mgr.pm_lot.entity_cd";
  //       $sql .="                AND  mgr.pm_tenant_lot.project_no = mgr.pm_lot.project_no";
  //       $sql .="                AND  mgr.pm_tenant_lot.tenant_no  in   ";
  //       $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
  //       $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
  //       $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
  //       $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
  //       $sql .=" or  mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_owner_lot (nolock)  ";   
  //       $sql .="                where mgr.pm_owner_lot.entity_cd  = mgr.pm_lot.entity_cd";
  //       $sql .="                AND  mgr.pm_owner_lot.project_no = mgr.pm_lot.project_no";
  //       // $sql .="                AND  mgr.pm_owner_lot.owner_acct  = '".$debtor_acct."')";
  //       $sql .="                AND  mgr.pm_owner_lot.owner_acct  in   ";
  //       $sql .="                        (SELECT ad.debtor_acct FROM mgr.ar_debtor ad with(NOLOCK)";
  //       $sql .="                         inner join mgr.cf_business with(NOLOCK) ";
  //       $sql .="                         on ad.business_id = mgr.cf_business.business_id  ";
  //       $sql .="                         WHERE ad.debtor_acct  = '".$debtor_acct."')) ";
  //       // var_dump($sql);
  //       $proDescs =  $this->m_wsbangun->getData_by_query($sql);
  //       // var_dump($proDescs);exit();

  //       $comboProject[] = '<option value=""></option>';
  //           if(!empty($proDescs)) {
  //               $comboProject[] = '<option></option>';
  //               foreach ($proDescs as $dtProject) {
  //                 if($debtor === $dtProject->lot_no) {
  //                   $pilih = ' selected = "1"';
  //                 } else {
  //                   $pilih = '';
  //                 }
  //                   $comboProject[] = '<option '.$pilih.' value="'.$dtProject->lot_no.'" data-floor='.$dtProject->level_no.'>'.$dtProject->lot_no.' - '.$dtProject->descs.'</option>';
  //               }
  //               $comboProject = implode("", $comboProject);
  //           }
  //           return $comboProject;
  //     }
      public function zoom_floor(){
        $lotno = $this->input->post('prod',TRUE);

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $cons = $this->session->userdata('Tscons');
        $sql = "select zone_cd from mgr.pm_lot where lot_no='$lotno' ";
        $rst = $this->m_wsbangun->getData_by_query($sql);

            echo $rst[0]->zone_cd;
      }
    private function setUploadOptions()
    {
        $max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/cs',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }
    
    public function save(){
        
            $msg="";
            if ($_POST) 
            {
                // $Business_id = $this->session->userdata('Tsbusinessid');
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
                $Ot_Id = $this->input->post('Ot_Id', true);   
                $debtor_acct = $this->input->post('debtor_name', true);
                $debtor_acct = explode("-%-",$debtor_acct);
                $debtor_acct = $debtor_acct[0];
                $Business_id = $debtor_acct[1];
                $lotno = $this->input->post('lotno',TRUE);
                
                $ov_date = $this->input->post('ov_date',TRUE);
                $startHour = $this->input->post('startHour',TRUE);
                $endHour = $this->input->post('endHour',TRUE);
                // $txtfloor = $this->input->post('txtfloor',TRUE);
                // $txtfloordescs = $this->input->post('txtfloordescs',TRUE);                
                // var_dump($lotno);exit();
                $audit_date = date('Y M d H:i:s');
                $descs = 'Overtime '.$audit_date;
                $audit_user = $this->session->userdata('Tsname');
                $email = $this->session->userdata('Tsemail');
                
                $dt_timestart = date('Y-m-d', strtotime($ov_date)); //reza
                $dt_start = date('H:i:s', strtotime($startHour));
                $dt_end = date('H:i:s', strtotime($endHour));

                // Solution 1, merge objects to new object:
                $start_o = new DateTime($dt_timestart." ".$dt_start); //reza
                $end_o = new DateTime($dt_timestart." ".$dt_end);
                $start_overtime = $start_o->format('Y M d H:i:s');
                $end_overtime = $end_o->format('Y M d H:i:s');
                    // var_dump($categoryarray);
                    // var_dump($work_reqarray);
                    // var_dump($picnamearray);exit();
                $sql = "SELECT  end_ot_time from mgr.ot_spec(nolock)";
                $dt = $this->m_wsbangun->getData_by_query($sql);
                $endhour_OT = date('H:i:s', strtotime(substr ($dt[0]->end_ot_time,11)));
                // var_dump($endhour_OT);
                // foreach ($lotno as $lot) {
                //     $dtlot = explode('-%-', $lot);
                //     // $debtor_acct=$dtlot[1];
                //     // var_dump($dtlot);exit();
                //     if(empty($debtor_acct) || $debtor_acct==''){
                //         $msg = "Please check bill debtor acct.";
                //         $psn = 'Fail';
                //         $msg1= array('pesan'=>$msg,
                //         'status'=>$psn,'endhour_OT'=>true);
                //         echo json_encode($msg1);
                //         exit();
                //     }
                // }

                
                if(date('H:i:s')>=$endhour_OT){
                    $msg = "Can't input overtime past than this time (".$endhour_OT.")";
                    $psn = 'Fail ';
                    $msg1= array('pesan'=>$msg,
                    'status'=>$psn,'endhour_OT'=>true);
                    echo json_encode($msg1);
                    exit();
                }
                foreach ($lotno as $lot) {

                    $dtlot = explode('-%-', $lot);
                    $lotnoo = $dtlot[0];
                    // $debtor_acct = $dtlot[1];
                    $txtfloor = $dtlot[1];
                    $txtfloordescs = $dtlot[2];
                   $sql = "SELECT count(*) as cnt from mgr.ot_trx where entity_cd = '".$entity."' AND project_no = '".$project."' and lot_no = '".$lotnoo."' AND status IN ('N','A','Z') AND ((start_overtime >= '".$start_overtime."' AND start_overtime < '".$end_overtime."') OR (end_overtime > '".$start_overtime."' AND end_overtime <= '".$end_overtime."'))";
                    $dt = $this->m_wsbangun->getData_by_queryadm($sql);
                    $cnt = $dt[0]->cnt;
                    // var_dump($lot." : ".$cnt);
                    if($cnt<1){
                        $data = array(          
                        
                        'entity_cd' => $entity,
                        'project_no' => $project,
                        'debtor_acct' =>$debtor_acct,
                        'business_id' => $Business_id,
                        'status' =>'N',
                        'status_posting'=>'N',
                        'date_created'=>$audit_date,
                        'lot_no'=>$lotnoo,
                        'description'=>$descs,
                        'start_overtime'=>$start_overtime,
                        'end_overtime'=>$end_overtime,
                        'level_no' => $txtfloor,
                        'descs_level'=>$txtfloordescs
                        );
                        if($Ot_Id>0){
                            $where = array('ot_id' => $Ot_Id );
                            $update = $this->m_wsbangun->updateDataweb('ot_trx',$data,$where);
                            if($update !="OK"){
                                $msg= $update;
                                $psn = 'Fail multi';
                            }else{
                                $msg="Data has been updated successfully";
                                $psn = 'OK';                                                                                    
                                
                            }

                        }else{
                            $insert = $this->m_wsbangun->insertDataweb('ot_trx',$data);
                            if($insert !="OK"){
                                $msg= $insert;
                                $psn = 'Fail multi';
                            }else{
                                $msg="Data has been saved successfully";
                                $psn = 'OK';                                                                                    
                                
                            }
                        }
                    } else {
                        $msg="Request overtime failed, data already exist!";
                        $psn = 'Fail';  
                    }
                } 
                // exit();

            } 
            else{
                $msg="Data validation is not valid";
            }
            
           $msg1= array('pesan'=>$msg,
                    'status'=>$psn,'endhour_OT'=>true);
            
        echo json_encode($msg1);

       
    }
    function countOT($lotno = null, $st = null, $en = null)
    {
        if(empty($lotno) || empty($st) || empty($en))
        {
            return -1;
        } else {
            $sql = "SELECT COUNT(1) AS cnt FROM $this->table_name WHERE lot_no=? AND status IN ('N','A','Z') AND ";
            $sql.= "((start_overtime >= ? AND start_overtime < ?) OR (end_overtime > ? AND end_overtime <= ?))";
            $res = $this->db->query($sql, array($lotno, $st, $en, $st, $en))->result();
           
            
            if(isset($res))
            {
                return $res[0]->cnt;
            } else {
                return -1;
            }
        }
    }
    public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        

        $ov_date = $this->input->post('ov_date',true);
        $ov_timestart = date('Y M d H:i:s', strtotime($ov_date));
        // var_dump($ov_timestart);
        // exit();
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','ot_id', 'debtor_acct','business_id', 'lot_no', 'date_created', 'description','start_overtime','end_overtime','level_no','descs_level');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_ot_trx_all';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $sEcho = $this->input->get_post('sEcho', true);
    
        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'ot_id' :$Column[$sortIdColumn]['name']);

        $filter_search='';
        if(isset($Search) && !empty($Search)){            
            for($i=0;$i<count($Column); $i++){
                if(isset($Column[$i]['searchable']) && $Column[$i]['searchable']=='true'){
                    $filter_search .=  $Column[$i]['name'] ." LIKE '%".$Search."%' OR ";
                }
                
            }
            $a = strrpos($filter_search, 'OR');        
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0,$a).")":$filter_search);     

        }
        // var_dump($filter_search);
        $param = " where ot_id > 0 and status ='N' and dateadd(d, datediff(d,0, start_overtime), 0) = CONVERT(DATETIME,'$ov_timestart') ".$filter_search;
        // var_dump($param);

        $rResult = $this->m_wsbangun->getlisttableadm($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

        $sql="select count(*) as cnt from ".$sTable." ".$param;
        $ts = $DB2->query($sql);
        $a = $ts->result()[0]->cnt;

        $iTotal = $a;//$DB2->count_all($sTable);
    
        // Output
        $output = array(
            'draw' => intval($draw),
            'recordsTotal' => $iTotal,
            'recordsFiltered' => $iTotal,
            'data' => array()
        );
        
        foreach($rResult->result_array() as $aRow)
        {
            $row = array(); 
            
            foreach($aColumns as $col)
            {
                $row[] = $aRow[$col];
                
            }
    
            $output['data'][] = $aRow;
        }

   
        echo json_encode($output);

    }
    public function delete()
    {
        $msg="";
        $psn='';
            if ($_POST) 
            {
                $ot_id = $this->input->post('Ot_Id', true);  

                $where = array('ot_id' => $ot_id );
                $psn = $this->m_wsbangun->deletedataweb('ot_trx',$where);                

                if($psn!='OK'){
                    $msg = $psn;
                    $psn = 'Fail';
                }else{
                    $msg = 'Data has been deleted successfully';
                }   
            }
            else
            {
                $msg="Data validation is not valid";
                $psn = 'Fail';
            }

            $msg1= array('Pesan'=>$msg,
                    'Status'=>$psn);
            
        echo json_encode($msg1);
    }
    public function getByID($id){
        $where=array('Ot_Id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria_adm('ot_trx',$where);

        echo json_encode($data);
    }
    public function add(){
         $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        // $email = $this->session->userdata('Tsemail');
        $group = $this->session->userdata('Tsusergroup');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        $Business_id = $this->session->userdata('Tsbusinessid');
        // var_dump($userID."-- name: ".$name);exit();
      
        $sql = "SELECT  end_ot_time from mgr.ot_spec(nolock)";
        $dt = $this->m_wsbangun->getData_by_query($sql);
        $endhour_OT = date('g A', strtotime(substr ($dt[0]->end_ot_time,11)));
      
        // var_dump($dupdate);

        // $name = '7-A06';
        // $email = 'debtor@ifca.co.id';
        // if($group=='DEBTOR'){
        //     $table = 'v_logindebtor';
        //     $crit = array('rowID'=>$name);
        //     // $crit = array('debtor_acct'=>$name);
        //     $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);
        // } else {
        //     $DataMenu='';
        // }
        // var_dump($name);exit();
        // $table = 'securityuserdebtor';
        // $crit = array('UserId'=>$name);
        // $cons = $this->session->userdata('Tscons');
        //     // $crit = array('debtor_acct'=>$name);
        // $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);
        // var_dump($DataMenu);exit();
        // $table = 'v_logindebtor';
        // $crit = array('email_addr'=>$email);
        // // $crit = array('debtor_acct'=>$name);
        // $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);        
        // $debtor_acct = $DataMenu[0]->debtor_acct;
        if($group!='DEBTOR'){
            // var_dump('expression');
            $dsb = 'false';
            // $notelp =  '';
            $datadebtor = $this->zoom_debtor("");
            $datalot = '';
        }else{
            
            $dsb = 'true';    
            
            
            $datadebtor = $this->zoom_debtor($Business_id);
            $datalot = $this->zoom_lot_no_in($Business_id);

        }
        // var_dump($datalot);exit();

        $content = array(
            'dtdebtor'=>$datadebtor,
            'ddx'=>$dsb,
            // 'complain_no'=>$complain_no,
            // 'ddno'=>(string)$notelp,
            'endhour'=>$endhour_OT,
            'datalot'=>$datalot,
            'ProjectDescs'=>$projectName);
        
        $this->load->view('overtime/add',$content);
    }
   public function edit(){
         $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsname');
        // $email = $this->session->userdata('Tsemail');
        $group = $this->session->userdata('Tsusergroup');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        $Business_id = $this->session->userdata('Tsbusinessid');
        // var_dump($entity);
        // var_dump($userID."-- name: ".$name);exit();
      

      $sql = "SELECT  end_ot_time from mgr.ot_spec(nolock)";
        $dt = $this->m_wsbangun->getData_by_query($sql);
        $endhour_OT = date('g A', strtotime(substr ($dt[0]->end_ot_time,11)));
        // var_dump($dupdate);

        if($group!='DEBTOR'){
           
            $dsb = 'false';
         
            $datalot = '';
        }else{
            
            $dsb = 'true';    
            
       
            $datalot = $this->zoom_lot_no($Business_id);

        }
   

        $content = array(
          
            'datalot'=>$datalot,
            'ProjectDescs'=>$projectName);
        
        $this->load->view('overtime/edit',$content);
    }
   
}