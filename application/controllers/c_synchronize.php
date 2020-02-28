<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_Synchronize extends Core_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_login');
        $this->load->model('m_wsbangun');
 
    }   

     public function index(){

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
         if($entity == ''){
            $entity = '2101';
            $project = '210101';
	       }

        $table = 'pl_project';
        $proDescs = $this->m_wsbangun->getData($table);
        // var_dump($entityName);
            
 
        // $table = 'v_reserve_product';
        // $crit = array('entity_cd'=>$entity,
        //     'project_no'=>$project);
        // $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);

        $data=array(
            // 'product'=>$dtProduct,
                    'project'=>$project,
                    'ProjectDescs'=>$projectName
                    );
        
        
        $this->load_content_top_menu('synchronize/index',$data);
        
    }
    public function getTable()
    {


        $userid = $this->session->userdata("Tsuname");

        // $date_end=date_create($date_end);
        // $date_start=date_create($date_start);
        $pro = $this->input->post("project",true);


        $sSearch=$this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            // var_dump($entity);
        }
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');

        $DB1 = $this->load->database('ifca', TRUE);
        


        $aField = array('id','subject','content','status');
        $aColumns = array('row_number','TABLE_NAME');

        $sTable = "select * from INFORMATION_SCHEMA.TABLES '".$param."'";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);

        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        // $addsort = 'product_cd,property_cd,lead_cd,group_cd ';
        $addsort = '';
        $SortdOrder =$order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];

        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);

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


        $where=' ';
        if($ar='ar_%')
        {
            
            $where="AND TABLE_NAME='".$ar."' ".$where;
        }
        if($rl='rl_%')
        {
       
            $where="AND TABLE_NAME='".$rl."' ".$where;
        }
      
    
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$where." ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablesoa($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);

        $output = array(
            'draw' => intval($draw),
            
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

    

    public function sinkron()
    {
        if($_POST)
        {
            // var_dump($_POST);
            $models = $this->input->post('models', true);
           $CI = &get_instance();
            $this->ifca = $CI->load->database('ifca',true); //SMLWEB
            $this->ifca->query('ifca');
            
            $CI->ifca->hostname;
            $CI->ifca->database;

            // var_dump($CI->ifca->database);

            $CI2 = &get_instance();
            $this->ifca3 = $CI2->load->database('ifca3',true); //IFCA_PB
            $this->ifca3->query('ifca3');
            
            $CI2->ifca3->hostname;
            $CI2->ifca3->database;
            // $qq=$this->db->database();
            // var_dump($CI2->ifca3->database);
            
            // exit();
           // $menuID = $dt->MenuID;
                    // $url= base_url('occupants/index/'.base64_encode($dt['debtor_acct'].'_'.$dt['entity'].'_'.$dt['project']));

                    $sql = "mgr.syncrhonize_db '".$CI->ifca->hostname."', '".$CI->ifca->database."','".$CI2->ifca3->hostname."', '".$CI2->ifca3->database."', '".$models."' ";
                    $snd = $this->m_wsbangun->setData_by_queryweb($sql);
                //  var_dump($snd);
                // exit();
                // var_dump($snd);
                // exit;
               if($snd=='OK'){
                    $msg = 'Success';
                    $Status ='OK';
                    $Status2 ='OK';
                    $Status3 ='OK';
                    $Status4 ='OK';
                }else{
                    $msg = $snd;

                    $Status ='Fail';
                    $Status2 ='Fail';
                   $Status3 ='Fail';
                    $Status4 ='Fail';
                }
		// $Status='ok';
  //       $msg = 'Done';
		      
            
        } else {
            $msg = 'No menu Assigned';
            // var_dump($_POST);
            // exit();
            // $gID = $models[0]['GroupCd'];
            // $table = 'sysMenuGroup';
            // $crit = array('groupCd'=>$gID);
            // $this->m_wsbangun->deletedata($table, $crit);
        }
        $tes = array('Response'=>$msg,
            'Status'=>$Status,
            'Status2'=>$Status2,
            'Status3'=>$Status3
            ,'Status4'=>$Status4
            );
        echo json_encode($tes);
    }

public function sendmail(){
            $debtor_acct=$this->input->post("debtor",true);
            $entity=$this->input->post("entity",true);
            $project=$this->input->post("project",true);
            $webuser = $this->session->userdata('Tsuname');
            $today = date('d M Y H:i:s');
            $project = trim($project);
            // $tbl = 'rl_nup_email';
            // $dtEmail = $this->m_wsbangun->getData($tbl);
            
            $Email = $this->input->post("email",true);
            // $Email = $dtEmail[0]->email;
            $Judul = $this->input->post("subject",true);
            
            $body = "<!DOCTYPE html><html><head></head><body>".$this->input->post("msg",true)."</body></html>";
            // $attach = $this->input->post("attach",true);
            $attach = 'pdf/SOA/report.pdf';
            
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());
          
            $docno='SOA'.$debtor_acct;
                $out_image=file_get_contents($attach);
                
                $imgData = bin2hex($out_image);
                $imgbin ="0x".$imgData; 
                
                $sql="SELECT count(*) as cnt from mgr.report_attachment where entity_cd='$entity' and project_no='$project' and document_no='$docno'";
                $dt = $this->m_wsbangun->getData_by_query($sql);
                $count = $dt[0]->cnt;
                if($count>0){
                    $where = array('document_no'=>$docno,
                        'project_no'=>$project,
                        'entity_cd'=>$entity);
                    $this->m_wsbangun->deletedata('report_attachment', $where);
                }

                $sql = "INSERT INTO mgr.report_attachment (\"entity_cd\", \"project_no\", \"document_no\", \"file_attachment\", \"file_attached\", \"audit_user\", \"audit_date\") VALUES ('".$entity."', '".$project."', '".$docno."', 'report.pdf', ".$imgbin .", '".$webuser."', '".$today."') ";
                
                $insert=$this->m_wsbangun->setData_by_query($sql);
                //  $table = 'report_attachment';

                //     $dtEntry = array('entity_cd'=>$entity,
                //         'project_no'=>$project,
                //         'document_no'=>$docno,
                //         'file_attachment'=>'report.pdf',
                //         'file_attached'=>$imgbin,
                //         'audit_user'=>$webuser,
                //         'audit_date'=>$today
                //     );
                // $insert = $this->m_wsbangun->insertData($table, $dtEntry);
                $CI = &get_instance();
                $CI->load->database();
                $CI->db->hostname;
                if($insert  == 'OK') {
                    // $sql1 ='Select max(path_file) AS path_file from mgr.report_spec';
                    // $data = $this->m_wsbangun->getData_by_query($sql1);                    
                    // $path = $data[0]->path_file;
                    $sql ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
                    $data = $this->m_wsbangun->getData_by_query($sql);                    
                    $profile_mail = $data[0]->email_profile;
                    $sql = "mgr.x_send_mail_report_php '".$profile_mail."', '".$Email."', '".$Judul."', '".$body."', '".$entity."','".$project."', '".$docno."', '".$CI->db->hostname."' ";
                    
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
                        $msg = 'Email sent';
                        $psn ='OK';
                        $aa = $msg;
                    }
                } else {
                    $msg='Upload attachment failed!';
                    $psn='Failed';
                    $aa=$msg;
                }
               
                

          
               
    
            $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
            echo json_encode($t);
   }
    
}