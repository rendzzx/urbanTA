<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_loginagent extends Core_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_login');
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');
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
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                foreach ($proDescs as $dtProject) {
                  if($project === $dtProject->project_no) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }

        $table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);

        $data=array('product'=>$dtProduct,
                    'project'=>$project,
                    'ProjectDescs'=>$projectName,
                    'cbProject'=>$comboProject);
        
        
        $this->load_content_top_menu('loginagent/index',$data);
        
    }
    public function getTable()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        // $pro = $this->input->post("project",true);
        // if(empty($pro)){
        //     $pro='';
        // }
       $entity = $this->session->userdata('Tsentity');
		// var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','rowID','agent_cd', 'agent_name', 'handphone1','email_add');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.cf_agent_dt';
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $Search = $sSearch['value'];
        $Search = $sSearch;

        //  if(empty($pro)||$pro==''){
        //     $project = $this->session->userdata('Tsproject');
        //     $entity = $this->session->userdata('Tsentity');
        // } else {
        //     $project = $pro;//onchange
        //     // $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
        //     $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project WITH(NOLOCK) WHERE project_no='$pro' ";
        //     $datas = $this->m_wsbangun->getData_by_query($sql);
        //     $entity = $datas[0]->entity_cd;
        //     // var_dump($entity);
        // }
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        // $SordField = ('STATUS desc,reserve_date ASC');

     
// var_dump($Search);
        // filter
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
        // Select Data

        $param =" Where entity_cd='$entity' $filter_search";
        $rResult = $this->m_wsbangun->getlisttablenup($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
      // var_dump($rResult);
        // Total data set length
        
        $sql="select count(*) as cnt from $sTable $param";
        // var_dump($sql);
        $datas = $this->m_wsbangun->getData_by_query($sql);
        $a = $datas[0]->cnt;

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

    public function getTableStaff()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $pro = $this->input->post("project",true);
        if(empty($pro)){
            $pro='';
        }
        $name = $this->session->userdata('Tsuname');
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','RowID','description', 'name', 'phone_cellular','email_add');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.security_users';
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $Search = $sSearch['value'];
        $Search = $sSearch;

         if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = $pro;//onchange
            // $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$pro'";
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project WITH(NOLOCK) WHERE project_no='$pro' ";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            // var_dump($entity);
        }
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        // $SordField = ('STATUS desc,reserve_date ASC');

     
// var_dump($Search);
        // filter
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
        // Select Data

        $param =" Where user_type='0' and email_add is not null and  email_add <> '' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablenup($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
        // Total data set length
        
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
    
  private function EmailFormat($f_user_name,$f_project_name,$rt_url_link){

    
                      $email = '<!DOCTYPE html><html lang="en">'    ; 
                      $email .= '<head>'    ; 
                      $email .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">'    ; 
                      $email .= '<title>Occupants Registration </title>'    ; 
                      $email .= '<style type="text/css">'    ; 
                      $email .= '::selection{ background-color: #E13300; color: white; }'    ; 
                      $email .= '::moz-selection{ background-color: #E13300; color: white; } '    ; 
                      $email .= '::webkit-selection{ background-color: #E13300; color: white; } body { '    ; 
                      $email .= 'background-color: #fff; '    ; 
                      $email .= 'margin: 40px; '    ; 
                      $email .= 'font: 13px/20px normal Helvetica, Arial, sans-serif; '    ; 
                      $email .= 'color: #4F5155; '    ; 
                      $email .= '} '    ; 
                      $email .= 'a { '    ; 
                      $email .= 'color: #003399; '    ; 
                      $email .= 'background-color: transparent; '    ; 
                      $email .= 'font-weight: normal; '    ; 
                      $email .= '} '    ; 
                      $email .= 'h1 { '    ; 
                      $email .= 'color: #444; '    ; 
                      $email .= 'background-color: transparent; '    ; 
                      $email .= 'border-bottom: 1px solid #D0D0D0; '    ; 
                      $email .= 'font-size: 19px; '    ; 
                      $email .= 'font-weight: normal; '    ; 
                      $email .= 'margin: 0 0 14px 0; '    ; 
                      $email .= 'text-align: left; '    ; 
                      $email .= '} '    ; 
                      $email .= 'code { '    ; 
                      $email .= 'font-family: Consolas, Monaco, Courier New, Courier, monospace; '    ; 
                      $email .= 'font-size: 12px; '    ; 
                      $email .= 'background-color: #f9f9f9; '    ; 
                      $email .= 'border: 1px solid #D0D0D0; '    ; 
                      $email .= 'color: #002166; '    ; 
                      $email .= 'display: block; '    ; 
                      $email .= 'margin: 14px 0 14px 0; '    ; 
                      $email .= 'padding: 12px 10px 12px 10px; '    ; 
                      $email .= ' } '    ; 
                      $email .= '#body{ '    ; 
                      $email .= 'margin: 0 15px 0 15px; '    ; 
                      $email .= '} '    ; 
                      $email .= 'p.footer{ '    ; 
                      $email .= 'text-align: right; '    ; 
                      $email .= 'font-size: 11px; '    ; 
                      $email .= 'border-top: 1px solid #D0D0D0;'    ; 
                      $email .= 'line-height: 32px; '    ; 
                      $email .= 'padding: 0 10px 0 10px; '    ; 
                      $email .= 'margin: 20px 0 0 0; '    ; 
                      $email .= '} '    ; 
                      $email .= '#container{ '    ; 
                      $email .= 'margin: 10px; '    ; 
                      $email .= 'border: 1px solid #D0D0D0; '    ; 
                      $email .= '-webkit-box-shadow: 0 0 8px #D0D0D0; '    ; 
                      $email .= '} '    ; 
                      $email .= '</style> '    ; 
                      $email .= '</head> '    ; 
                      $email .= '<body> '    ; 
                      $email .= '<div> '    ; 
                      $email .= '<h1>Dear '.$f_user_name.',</h1>'    ; 
                      $email .= '<div> '     ;
                      $email .= '<div> '     ;
                      $email .= '<br>  To view '.$f_project_name.' web portal, please complete your registration in this link below :<br> '     ;
                      $email .= '<p><a title = "1" href = "'.$rt_url_link.'" target = "_blank" > Clik Here </a></p>'   ;
                      $email .= '<br><br>For more info contact us at +6281213141516 or email cs@ifcacloud.co.id .<br><br>'    ; 
                      $email .= '</div> '    ;   
                      $email .= '<p>Thank You.</p> '    ; 
                      $email .= '<br><br>  '    ; 
    
                      $email .= '<h1>Terhormat Bpk/Ibu '.$f_user_name.',</h1>'    ; 
                      $email .= '<div> '     ;
                      $email .= '<div> '     ;
                      $email .= '<br>Untuk melihat web portal '.$f_project_name.', mohon lakukan registrasi terlebih dahulu di link berikut : <br> '     ;
                      $email .= '<p><a title = "1" href = "'.$rt_url_link.'" target = "_blank" > Clik Here </a></p>'   ;
                      $email .= '<br><br>Keterangan lebih lanjut  hubungi kami di +6281213141516 atau email cs@ifcacloud.co.id .<br><br>'    ; 
                      $email .= '</div> '    ;   
                      $email .= '<p>Terima Kasih</p> '    ; 
                      $email .= '<br><br>  '    ; 
                      $email .= '</body>'    ; 
                      $email .= '</html>' ;
    return $email;

  }
   public function Approval(){
        if($_POST){
            $agent_cd = $this->input->post("agent_cd",true);
            $entity = $this->input->post('entity');
            $entityName = $this->session->userdata('Tsentityname');

            // $project = $this->input->post('project');
            // $project = trim($project);
            // if(empty($project)){
            $project = $this->session->userdata('Tsproject');
            // }
            // $name = $this->session->userdata('Tsuname');

           
            // $group_cd = $v_logindebtor[0]->group_cd;
            $table='cf_agent_dt with(NOLOCK)';
            $where =array('agent_cd'=>$agent_cd,'entity_cd'=>$entity);
            $datas = $this->m_wsbangun->getData_by_criteria($table,$where);
            // var_dump($datas);exit();
            $url= base_url('occupants/agent/'.base64_encode($agent_cd.'+'.$entity.'+'.$project.'+'.$datas[0]->email_add));
            // var_dump($url);exit();

            $msg='';
            $psn='';
            $aa='';

            $email =$datas[0]->email_add;
            $subject='Activation Login Occupants in IFCA System';
            $cc= '';$bcc='';
            $body=$this->EmailFormat($datas[0]->agent_name,$entityName,$url);
        


            $url = 'http://52.187.57.5/emailAPI/c_api_email/POST_EMAIL_API';
            $dataJson = "to=".$email."&subject=".$subject."&cc=".$cc."&bcc=".$bcc."&message=".$body;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$dataJson);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                         
            $response  = curl_exec($ch);
            curl_close($ch);
                                        // var_dump($response);exit();
            $response = get_object_vars(json_decode($response));
                                        // var_dump($response["status"]);
            $msg = $response["Pesan"];
            $psn = $response["status"];

            if($psn=='Success'){
                $msg = 'Email sent';
                $psn ='OK';
                $aa = $psn;
            }else{
                $msg = 'Sent Email Failed, Please Contact your Admin!';
                $psn ='Fail';
                $aa = 'Sent Email Failed, Please Contact your Admin!';
            }
            
                // $sql = "mgr.xcf_debtor_approval_web '".$entity."', '".$project."','".$agent_cd."', '".$url."' ,'AGENT' ";
               
                // $snd = $this->m_wsbangun->setData_by_query($sql);
                // //  var_dump($snd);
                // // exit();
                // // var_dump($snd);
                // // exit;
                // $aaa = strpos($snd,'queued');
                // if( $aaa <= 0 || !$aaa){
                //     if($snd=='OK'){
                //         $msg = 'Email sent';
                //         $psn ='OK';
                //         $aa = $msg;
                //     }else{
                //         $msg = $snd;
                //         $psn ='Fail';
                //         $aa = 'Sent Email Failed, Please Contact your Admin!';
                //     }
                    
                // }else{
                //     $msg = 'Email sent';
                //     $psn ='OK';
                //     $aa = $msg;
                // }
           
            $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
            echo json_encode($t);
        }
    }
    public function Approval2(){
        if($_POST){
            $name = $this->input->post("name",true);
            $entity = $this->input->post('entity');
            $project = $this->input->post('project');
            $project = trim($project);
            // $name = $this->session->userdata('Tsuname');

           // $sql ="SELECT  email_add,description FROM mgr.security_users where name "
            $table='security_users with(NOLOCK)';
            $where =array('NAME'=>$name);
            $datas = $this->m_wsbangun->getData_by_criteria($table,$where);
            // var_dump($datas[0]->email_add);exit();
            $creteria = array('entity_cd'=>$entity,
                              'project_no'=>$project);
            $ProjectData = $this->m_wsbangun->getData_by_criteria('pl_project',$creteria );

            // $group_cd = $v_logindebtor[0]->group_cd;

            $url= base_url('occupants/indexstaff/'.base64_encode($name.'+'.$entity.'+'.$project.'+'.$datas[0]->email_add));

            $email =$datas[0]->email_add;
            $subject='Activation Login Occupants in IFCA System';
            $cc= '';$bcc='';
            $body=$this->EmailFormat($name,$ProjectData[0]->descs,$url);
        


            $url = 'http://52.187.57.5/emailAPI/c_api_email/POST_EMAIL_API';
            $dataJson = "to=".$email."&subject=".$subject."&cc=".$cc."&bcc=".$bcc."&message=".$body;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$dataJson);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                         
            $response  = curl_exec($ch);
            curl_close($ch);
                                        // var_dump($response);exit();
            $response = get_object_vars(json_decode($response));
                                        // var_dump($response["status"]);
            $msg = $response["Pesan"];
            $psn = $response["status"];

            if($psn=='Success'){
                $msg = 'Email sent';
                $psn ='OK';
                $aa = $psn;
            }else{
                $msg = $msg;
                $psn ='Fail';
                $aa = 'Sent Email Failed, Please Contact your Admin!';
            }

            // $msg='';
            // $psn='';
            // $aa='';
            
            //     $sql = "mgr.xcf_debtor_approval_web '".$entity."', '".$project."','".$name."', '".$url."','staff' ";
               
            //     $snd = $this->m_wsbangun->setData_by_query($sql);
            //     //  var_dump($snd);
            //     // exit();
            //     // var_dump($snd);
            //     // exit;
            //     $aaa = strpos($snd,'queued');
            //     if( $aaa <= 0 || !$aaa){
            //         if($snd=='OK'){
            //             $msg = 'Email sent';
            //             $psn ='OK';
            //             $aa = $msg;
            //         }else{
            //             $msg = $snd;
            //             $psn ='Fail';
            //             $aa = 'Sent Email Failed, Please Contact your Admin!';
            //         }
                    
            //     }else{
            //         $msg = 'Email sent';
            //         $psn ='OK';
            //         $aa = $msg;
            //     }
           
            $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
            echo json_encode($t);
        }
    }


    public function save()
    {
        if($_POST)
        {
            // var_dump($_POST);
            $models = $this->input->post('models', true);
            // $today = date('d M Y H:i:s');
            
            // $group = $this->input->post('gid', true);

            if(!empty($models))
            {
                // var_dump($models);
                // $debtor_acct = $models[0]['debtor_acct'];
                // $entity = $models[0]['entity'];
                // $project = $models[0]['project'];
                // // var_dump($gID);
                // var_dump($gID['GroupCd']);
                // exit();
                
                foreach ($models as $dt) {
                    // var_dump($dt);
                    $msg='';
		            $psn='';
		            $aa='';
                    // $menuID = $dt->MenuID;
                    $url= base_url('occupants/index/'.base64_encode($dt['debtor_acct'].'_'.$dt['entity'].'_'.$dt['project']));

                    $sql = "mgr.xcf_debtor_approval_web '".$dt['entity']."', '".$dt['project']."','".$dt['debtor_acct']."', '".$url."' ";
                    $snd = $this->m_wsbangun->setData_by_query($sql);
                //  var_dump($snd);
                // exit();
                // var_dump($snd);
                // exit;
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
		           
		                }
            }
        } else {
            $msg = 'No email sent';
         
        }
          $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
        echo json_encode($t);
    }
    public function savestaff()
    {
        if($_POST)
        {
            // var_dump($_POST);
            $models = $this->input->post('models', true);
            // $today = date('d M Y H:i:s');
            
            // $group = $this->input->post('gid', true);

            if(!empty($models))
            {
                // var_dump($models);
                // $debtor_acct = $models[0]['debtor_acct'];
                // $entity = $models[0]['entity'];
                // $project = $models[0]['project'];
                // // var_dump($gID);
                // var_dump($gID['GroupCd']);
                // exit();
                
                foreach ($models as $dt) {
                    // var_dump($dt);
                    $msg='';
                    $psn='';
                    $aa='';
                    // $menuID = $dt->MenuID;
                    $url= base_url('occupants/indexstaff/'.base64_encode($dt['name'].'_'.$dt['entity'].'_'.$dt['project']));

                    $sql = "mgr.xcf_staff_approval_web '".$dt['entity']."', '".$dt['project']."','".$dt['name']."', '".$url."' ";
                    $snd = $this->m_wsbangun->setData_by_query($sql);
                //  var_dump($snd);
                // exit();
                // var_dump($snd);
                // exit;
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
                   
                        }
            }
        } else {
            $msg = 'No email sent';
         
        }
          $t = array('Pesan'=>$msg,
                    'Status'=>$psn,
                    'Msg'=>$aa);
        echo json_encode($t);
    }
    
}