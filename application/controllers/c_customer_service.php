<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_customer_service extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');

    }

    public function insert()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $userID = $this->session->userdata('Tsuser_id');
        $projectName = $this->session->userdata('Tsprojectname');
        // var_dump($name);
        // var_dump($userID);
        $table = 'v_logindebtor';
        $crit = array('debtor_acct'=>$name);
        $DataMenu = $this->m_wsbangun->getData_by_criteria($table,$crit);        
        // $debtor_acct = $DataMenu[0]->debtor_acct;
        if(empty($DataMenu)){
            // var_dump('expression');
            $dsb = 'false';
            $datadebtor = $this->zoom_debtor("");
        }else{
            
            $dsb = 'true';
            $datadebtor = $this->zoom_debtor($DataMenu[0]->debtor_acct);

        }


        $content = array(
            'dtdebtor'=>$datadebtor,
            'ddx'=>$dsb,
            // 'datalot'=>$datalot,
            // 'cbProject'=>$comboProject,
            'ProjectDescs'=>$projectName);
        
    	$this->load_content_top_menu('cs/insert',$content);
    }
    public function zoom_debtor($debtor_acct){
        $this->load->model('m_wsbangun');
        // $pro = $this->input->post('ent',TRUE);       
        $table = 'v_logindebtor';
        $proDescs = $this->m_wsbangun->getData($table);
        // var_dump($entityName);
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($debtor_acct === $dtProject->debtor_acct) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->debtor_acct.'" data-telp="'.$dtProject->hand_phone.'">'.$dtProject->debtor_acct.'-'.$dtProject->name.'</option>';
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
        $name = $this->session->userdata('Tsuname');
        $sql = "select * from mgr.sv_category where location_type='$location' ";
        $rst = $this->m_wsbangun->getData_by_query($sql);
        //var_dump($rst);
        $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                
                $combo[] = '<option value="'.trim($result->category_cd).'" >'.$result->descs.'</option>';
            }
            echo implode("", $combo);
      }
      public function zoom_lot_no(){
        $debtor_acct = $this->input->post('debtor_acct',TRUE);
        $lotno = $this->input->post('Id',TRUE);
        // var_dump($ent);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        

        $sql = "SELECT mgr.pm_lot.lot_no , mgr.pm_lot.level_no,  mgr.pm_lot.descs , mgr.pm_lot.status FROM mgr.pm_lot (nolock) ";
        $sql .=" WHERE mgr.pm_lot.entity_cd = '".$entity."' ";
        $sql .=" and mgr.pm_lot.project_no = '".$project."' ";
        $sql .=" and mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_tenant_lot (nolock)  ";  
        $sql .="                where mgr.pm_tenant_lot.status <> 'T' ";
        $sql .="                AND mgr.pm_tenant_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_tenant_lot.project_no = mgr.pm_lot.project_no";
        $sql .="                AND  mgr.pm_tenant_lot.tenant_no  = '".$debtor_acct."') ";
        $sql .=" or  mgr.pm_lot.lot_no in (select lot_no from  mgr.pm_owner_lot (nolock)  ";   
        $sql .="                where mgr.pm_owner_lot.entity_cd  = mgr.pm_lot.entity_cd";
        $sql .="                AND  mgr.pm_owner_lot.project_no = mgr.pm_lot.project_no";
        $sql .="                AND  mgr.pm_owner_lot.owner_acct  = '".$debtor_acct."')";
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
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->lot_no.'" data-floor='.$dtProject->level_no.'>'.$dtProject->lot_no.' - '.$dtProject->descs.'</option>';
                }
                // $comboProject = implode("", $comboProject);
            }
            echo implode("", $comboProject);
      }

      public function zoom_floor(){
        $lotno = $this->input->post('prod',TRUE);

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $sql = "select level_no from mgr.pm_lot (nolock) where lot_no='$lotno' ";
        $rst = $this->m_wsbangun->getData_by_query($sql);

            echo $rst[0]->level_no;
      }

    public function save(){
        
            $msg="";
            if ($_POST) 
            {
                $debtor_acct = $this->input->post('debtor_acct', true);

                $req_by = $this->input->post('serv_req_by',TRUE);
                $contact_no =$this->input->post('contact_no',TRUE);
                $lotno = $this->input->post('lotno',TRUE);                
                $report_no = $this->input->post('report_no',TRUE);
                $location = $this->input->post('loc_type',TRUE);
                $category = $this->input->post('category',TRUE);
                $work_req = $this->input->post('work_req',TRUE);
                $pro =$this->input->post('project_no',TRUE);
                if(empty($pro)||$pro==''){
                    $project = $this->session->userdata('Tsproject');
                    $entity = $this->session->userdata('Tsentity');
                } else {
                    $project = $pro;
                    $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
                    $datas = $this->m_wsbangun->getData_by_query($sql);
                    $entity = $datas[0]->entity_cd;
                    
                }

                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                if(empty($parent_id)){
                    $parent_id = 0;
                }
                
                    $sql = "mgr.xsv_post_ticket '".$entity."', '".$project."','".$debtor_acct."', '".$audit_date."', '".$lotno."', '".$location."', '".$category."', '".$work_req."', '".$audit_user."' ";
                    $snd = $this->m_wsbangun->setData_by_query($sql);
          
                        $aaa = strpos($snd,'queued');
                        if( $aaa <= 0 || !$aaa){
                            if($snd=='OK'){
                                $msg = 'Email sent';
                                $psn ='OK';
                                $aa = $msg;
                            }else{
                                $msg = $snd;
                                $psn ='Fail';
                                $aa = 'Sent Email Failed, Please Contact your Admin!';
                            }
                            
                        }else{
                            $msg = 'Email sent and Data has been saved successfully.';
                            $psn ='OK';
                            $aa = $msg;
                        }

                    //     $data = array(          
                  
                    //     'entity_cd' => $title,
                    //     'project_no' => $url,
                    //     'debtor_acct' =>$parent_id,
                    //     'report_no' =>$icon_class,                        
                    //     'reported_by'=>$order_seq,
                    //     'reported_date'=>$audit_date,
                    //     'work_requested'=>$work_req,
                    //     'lot_no'=>$lotno,
                    //     'floor'=>$lotno,
                    //     'serv_req_by'=>$lotno,
                    //     'contact_no'=>$lotno,
                    //     'request_type'=>'R',
                    //     'category_cd'=>$category_cd,
                    //     'location_type'=>$lotno,
                    //     'audit_user'=>$audit_user,
                    //     'audit_date'=>$audit_date
                    //     );
                    

                    // $criteria = array('report_no' => $report_no);
                
                    // if($menu_id>0) {
                    //     $data = $this->m_wsbangun->updateDataweb('sv_entry_hd',$data, $criteria);
           
                    //     if($data !="OK"){
                    //         $msg= $data;
                    //         $st = 'Fail';
                    //     }else{
                    //         $msg="Data has been updated successfully";
                    //         $st = 'OK';
                    //     }
                 
                    // } else {
                    //     $data = $this->m_wsbangun->insertData('sv_entry_hd',$data);
                    //     if($data !="OK"){
                    //         $msg= $data;
                    //         $st = 'Fail';
                    //     }else{
                    //         $msg="Data has been saved successfully";
                    //         $st = 'OK';
                    //     }
 
                    // }

            } 
            else{
                $msg="Data validation is not valid";
            }
            
           $msg1= array('pesan'=>$msg,
                    'status'=>$psn);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
}