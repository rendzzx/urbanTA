<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_reserve_nup_cancel extends Core_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->auth_check();
		// $this->load->model('m_rl_sales_list');
		$this->load->model('m_wsbangun');
		// $this->load->model('m_sms');
		// $this->load->model('m_business');
        // $this->load->model('m_nup_cancel');
	}
    public function index()
    {

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

        // $table = 'pl_project(nolock)';
        // $crit = array('entity_cd'=>$entity,
        //     'project_no'=>$project);
        // $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        // $prjDesc = empty($dtPrj) ? '' : $dtPrj[0]->descs;
        $today = date('d/m/Y');
        
        $sql ="SELECT COUNT(*) AS counter FROM mgr.rl_nup_parameter";
        $sql.= " WHERE entity_cd = '$entity'";
        $sql.= " AND project_no = '$project'";
        $sql.= " AND '$today' BETWEEN start_date AND end_date";
        $sql.= " AND status = '1' and cancel_nup = '1'";
        // var_dump($sql);exit;
        
        $cons = $this->session->userdata('Tscons');
        $qry = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $cnt = $qry[0]->counter;
    //  $ContentAllData = array('kondisi'=>$x,
    //          'project_no'=>$project,
                // 'ProjectDescs'=>$prjDesc);

        $encParam = base64_encode($project.'-'.$projectName);

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                'encParam'=>$encParam);

        // if ($cnt > 0)
        // {
            $this->load_content_top_menu('nup_cancel/index',$ContentAllData);
        // }
        // else
        // {
        //     $this->load->view('error/error_prohibited',$ContentAllData);

        // }
        
    }

    // public function nupno_zoom(){
    //     $pro = $this->input->post('NupType',TRUE);
    //     // var_dump($nup_id);
    //     $table = 'rl_reserve_nup';

    //     $projectName = $this->m_wsbangun->getData($table);
    //     // var_dump($entityName);
    //         if(!empty($projectName)) {
    //             $comboProject[] = '<option></option>';
    //             foreach ($projectName as $dtProject) {
    //               if($pro === $dtProject->project_no) {
    //                 $pilih = ' selected = "1"';
    //               } else {
    //                 $pilih = '';
    //               }
    //                 $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
    //             }
    //             $comboProject = implode("", $comboProject);
    //         }
    //         echo $comboProject;
    //   }
     public function download($filename = NULL) 
    {
        // load download helder
        $this->load->helper('download');
        // read file contents
        $data = file_get_contents(base_url('/img/rpt/'.$filename));
        // var_dump($data);
        force_download($filename, $data);
    }
    public function getTable()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        // var_dump($name);
        $DB2 = $this->load->database($cons, TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('rowID','NAME', 'nup_no', 'Handphone', 'Email', 'nup_type','reserve_date', 'entity_cd', 'project_no', 'STATUS');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_nup_update';
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
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'rowID' :$Column[$sortIdColumn]['name']);
        // var_dump($SordField);

     
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

        // var_dump($name);
        // var_dump($entity);
        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        if($name=='ADMIN'||$name=='MGR'){
            $param =" Where (status = 'E' or status = 'C') AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        }else{
            $param =" Where (status = 'E' or status = 'C')  and reserve_by='".$name."' AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;    
        }
        $cons = $this->session->userdata('Tscons');
        $rResult = $this->m_wsbangun->getlisttable_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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

    public function NUPno()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
    	$nupno = $this->input->post('nupno',true);
    	// $sql = "select a.nup_amt as nup_amt, a.reserve_date as reserve_date,a.nup_sequence_no as nup_sequence_no,a.business_id as business_id,a.trx_type as trx_type,a.bank_cd as bank_cd,b.name as name, c.descs from mgr.rl_reserve_nup a (nolock), mgr.cf_business b (nolock), mgr.rl_nup_type c (nolock)
     //        where a.business_id = b.business_id and a.entity_cd='$entity' and a.project_no='$project' and  a.nup_no='$nupno' and a.entity_cd = c.entity_cd and a.project_no = c.project_no and a.prefix = c.prefix";
        $table = 'v_nup_drop_down';
        $krit = array('entity_cd' => $entity,
                        'project_no' => $project,
                        'nup_no' => $nupno);
    	// $result = $this->m_wsbangun->getData_by_query($sql);
        $cons = $this->session->userdata('Tscons');
        $result = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $krit);

    	echo json_encode($result);
    }
	public function cbNUP()
	{
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
		$NupType = $this->input->post('NupType',TRUE);
        $name = $this->session->userdata('Tsuname');
		$sql = "select DISTINCT nup_no from mgr.rl_reserve_nup where nup_no <> '' and status='A' and project_no='$project' and entity_cd='$entity' and reserve_by='$name'";
        $cons = $this->session->userdata('Tscons');
        $rst = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        //var_dump($rst);
		$combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                
                $combo[] = '<option value="'.trim($result->nup_no).'" >'.$result->nup_no.'</option>';
            }
            echo implode("", $combo); 
	}
	public function insert() 
	{
		// $status = (string)$this->input->post('status', TRUE);
		// var_dump($status);
        $today = date('d M Y');


		$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

      

        // if($cnt == 1){       
        

        $dday = date('d M Y H:i:s');
        $table = 'rl_nup_type(nolock)';
        $crit = array('nup_type', 'prefix', 'descs');
        $where = array('status_cancel'=>'Y');
        $cons = $this->session->userdata('Tscons');
        $nuptype = $this->m_wsbangun->getCombo2_cons($cons,$table,$crit,$where);

        $table = 'v_nup_no (nolock)';
        $crit  = array('nup_no', 'nup_no', 'prefix');
        if($user=='ADMIN'||$user=='MGR'){
            $where = array('entity_cd' => $entity, 
                        'project_no' => $project);
        }else{
            $where = array('entity_cd' => $entity, 
                        'project_no' => $project,
                        'reserve_by'=> $user);    
        }
        $cons = $this->session->userdata('Tscons');
        $nupno = $this->m_wsbangun->getCombo3_cons($cons,$table,$crit,$where);

        
        $table = 'agent_details';
        $crit = array('userid'=>$user);
        $cons = $this->session->userdata('Tscons');
        $agent = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        
        
        // $nupno = $this->cbNUP();

        $table = 'cf_reason (nolock)';
        $crit = array('reason_cd', 'reason_cd','descs');
        $cons = $this->session->userdata('Tscons');
        $reason = $this->m_wsbangun->getCombo2_cons($cons,$table,$crit);

       

        $sql = "SELECT * FROM mgr.rl_phase(NOLOCK) WHERE phase_cd=(SELECT max(phase_cd) FROM mgr.rl_nup_parameter(NOLOCK) WHERE entity_cd='$entity' and project_no='$project' and status=1)";
        $cons = $this->session->userdata('Tscons');
        $dtPhase = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
                       
           	
    	$sql = "SELECT counter from mgr.next_number (NOLOCK) where name='nup_sequence_no'";
        $cons = $this->session->userdata('Tscons');
    	$dtSeq = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
    	$seqno = (int) $dtSeq[0]->counter;
		$upseq = intval($seqno) + 1;
    	$sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='nup_sequence_no'";
    	$this->m_wsbangun->setData_by_query_cons($cons,$sql);
		
    	
        $content = array('comboTnup'=>$nuptype,
        	// 'comboCs'=>$customer,
        	'comboNonup'=>$nupno,
        	'comboCReason'=>$reason,
        	// 'comboPhase'=>$cbphase,
        	// 'comboTrxType'=>$cbtrxtype,
        	'user'=>$user,
        	// 'seqno'=>$seqno,
        	'project'=>$projectName,
            'project_no'=>$project,
        	// 'phase'=>$dtPhase[0],
        	'today'=>$today,       	
        	'agent'=>$agent[0],
        	'rowID'=>0);
        $this->load_content_top_menu('nup_cancel/form',$content);
    // }
    // else {
    //     $a = "Can not cancel NUP at current period";
    // }

	}
    private function setUploadOptions()
    {
        $max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/NUP',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }
    public function saveFile(){
        
            $webuser = $this->session->userdata('Tsuname');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $today = date('d M Y H:i:s');
            $nupno = $this->input->post('Nup_No',true);
            // $seqno = $this->input->post('sn',true);
            $cons = $this->session->userdata('Tscons');
            $files = $_FILES;
            $cnt ='';
            $picname = str_replace(' ', '_', $files['userfile']['name']);
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());
            // if(!$this->upload->do_upload()) 
            // { 
            //     // $data['error'] = $this->upload->display_errors();
            //     $msg = $this->upload->display_errors();
            //     // var_dump($data);
            //     // return $data;
            // } else {
            // var_dump($files);
            $sql1 = "Delete mgr.[rl_nup_cancel_attach] where nup_no='".$nupno."' and entity_cd='".$entity."' AND project_no='".$project."'";
            $this->m_wsbangun->setData_by_query_cons($cons,$sql1);


                $tmpName = $_FILES['userfile']['tmp_name'];
                // var_dump($tmpName);
                $imgString = file_get_contents($tmpName);
                // var_dump($imgString);
                $imgData = bin2hex($imgString);
                $imgbin ="0x".$imgData; 
                // var_dump($imgbin);
                // return;
                // $sql = "UPDATE MGR.rl_nup_attachment SET file_attachment='$picname', file_attached=$imgbin, status_attach='1', audit_date='$today' ";
                // $sql.= "WHERE rowID=$row";
                $sql ="INSERT INTO [mgr].[rl_nup_cancel_attach] ";
                $sql.="([entity_cd], [project_no], [nup_no]";
                $sql.=", [document_no], [file_attachment], [file_attached]";
                $sql.=", [audit_user], [audit_date])";
                $sql.="VALUES ('".$entity."','".$project."','".$nupno."' ";
                $sql.=",1,'$picname',$imgbin";
                $sql.=",'$webuser','$today')";
                $this->m_wsbangun->setData_by_query_cons($cons,$sql);
                $msg = array('pesan'=>"sukses",
                     'PesanEmail'=>"fail");
        echo json_encode($msg);
        
    }
    public function savecancel($nup_no='')
    {
        // var_dump($nup_no);exit;
        if($_POST)
        {
            $table = 'rl_reserve_nup_cancel';
            $isFile =  $this->input->post('isFile');
            
            // exit;
                $cons = $this->session->userdata('Tscons');
                $businessid = $this->input->post('businessid');
                $nupseq =$this->input->post('nupseq');
                $nupno =$this->input->post('nupno');
                $entity_cd = $this->session->userdata('Tsentity');
                $project_no = $this->session->userdata('Tsproject');
                $agentName = $this->session->userdata('Tsname');


                $data['entity_cd'] = $this->session->userdata('Tsentity');
                $data['project_no'] = $this->session->userdata('Tsproject');
                $data['cancel_staff'] = $this->session->userdata('Tsuname');
                $data['audit_user'] = $this->session->userdata('Tsuname');
                $data['audit_date'] = date('d M Y H:i:s');
                $data['business_id'] = $this->input->post('businessid');
                $data['status'] = "N";
                $data['trx_type'] = $this->input->post('trx');
                $data['bank_cd'] = $this->input->post('bankcd');                
                $data['nup_sequence_no']=$this->input->post('nupseq');
                $data['nup_type'] = $this->input->post('nupcd');
                $data['nup_no'] = $this->input->post('nupno');
                $data['reserve_date'] = $this->input->post('rsvdate');
                $data['nup_amt'] = $this->input->post('amount');
                $data['bank_name'] = $this->input->post('bankname');
                // var_dump($data['bank_name']);exit;
                $data['bank_acct_no'] = $this->input->post('bacctno');  
                $data['bank_acct_name'] = $this->input->post('bacctname');
                $data['cancel_date'] = $this->input->post('canceldate');
                $data['cancel_reason'] = $this->input->post('reason');
                $data['remarks'] = $this->input->post('remark');
                $customer = $this->input->post('customer');



                        // starto
                        $this->m_wsbangun->insertData_cons($cons,$table, $data);
                        //update
                        $table2='rl_reserve_nup';
                        $dt['STATUS']="E";
                        $entity = $this->session->userdata('Tsentity');
                        $project = $this->session->userdata('Tsproject');
                        $nupno = $this->input->post('nupno');
                        $where = array(
                             'entity_cd'=>$entity,
                             'project_no'=>$project,
                             'nup_no'=>$nupno
                            );
                        $this->m_wsbangun->updateData_cons($cons,$table2, $dt, $where);
                        //endo
            
            $reason = $this->input->post('reason');
            $remark = $this->input->post('remark');
           
            $Temail = 'rl_nup_email_cancel (nolock)';
            $kritTemail = array('entity_cd' => $entity, 
                                'project_no'=>$project);
            $cons = $this->session->userdata('Tscons');
            $Qemail = $this->m_wsbangun->getData_by_criteria_cons($cons,$Temail, $kritTemail);
            $email = $Qemail[0]->email;
            // $email = "deskaruwanda@gmail.com"; //buat tes
            $title = $Qemail[0]->subject_email;
            $noHp = $Qemail[0]->hp_no;

            $rowID = $this->input->post("id",true);
            
            // $TisiEmail = 'v_nup_update ';
            // $kritIsiEmail = array('entity_cd' => $entity, 
            //                         'project_no' => $project,
            //                         'nup_no'=>$nupno);
            // $QisiEmail = $this->m_wsbangun->getData_by_criteria($TisiEmail, $kritIsiEmail);

            // $tbl = 'rl_nup_type';
            // $dt = array('entity_cd' => $entity, 
            //             'project_no' => $project,
            //             'status_cancel' => 'Y');
            // $dtProject = $this->m_wsbangun->getData_by_criteria($tbl, $dt);


            // $tbl2 = 'cf_reason (nolock)';
            // $dt2 = array('reason_cd' => $reason);
            // $dtReason = $this->m_wsbangun->getData_by_criteria($tbl2, $dt2);

            // $data = array(
            //                 'NAME' => $QisiEmail[0]->NAME,
            //                 'descs' => $QisiEmail[0]->descs,
            //                 'nup_amt' => $QisiEmail[0]->nup_amt,
            //                 'agency' => $QisiEmail[0]->group_name,
            //                 'agent_name' => $QisiEmail[0]->agent_name,
            //                 'nuptype' => $QisiEmail[0]->descs,
            //                 'nupno'=>$nupno,
            //                 'reason'=>$dtReason[0]->descs,
            //                 'remark'=>$remark);
            $psn = "";
            $aa = "";
            $msg = "";


            $tblAgent = "SELECT group_name from mgr.agent_details (nolock) where userid = '".$data['cancel_staff']."' and agent_cd = '".$data['cancel_staff']."'";
            $cons = $this->session->userdata('Tscons');
            $query = $this->m_wsbangun->getData_by_query_cons($cons,$tblAgent);

            $tblReason = "SELECT descs from mgr.cf_reason (nolock) where reason_cd = '".$reason."'";
            $cons = $this->session->userdata('Tscons');
            $query2 = $this->m_wsbangun->getData_by_query_cons($cons,$tblReason);


            // $body = $this->load->view('Email/EmailNUPCancel', $data, true);
            $body = '<div>';
            $body .= '<h1>Dear Finance,</h1>';
            $body .= '<div >';
            $body .= '<div>';                        
            $body .= 'Please approve cancel NUP Number :'.$data['nup_no'].'<br>';
            $body .= 'Name : '.$customer.'<br>';
            $body .= 'NUP Type : '.$data['nup_type'].'<br>';
            $body .= 'Amount :  '.$data['nup_amt'].'<br>';
            $body .= 'Agency : '.$query[0]->group_name.'<br>';
            $body .= 'Marketing/Agent : '.$agentName.'<br>';
            $body .= 'Reason : '.$query2[0]->descs.' ('.$remark.')<br>';
            $body .= '<br><br><br>';
            $body .= '</div>';                    
            $body .= '</div>';
            $body .= '</div>';

            $sqlEP ='Select max(email_profile) AS email_profile from mgr.cf_sys_spec';
            $cons = $this->session->userdata('Tscons');
            $dataEP = $this->m_wsbangun->getData_by_query_cons($cons,$sqlEP);                    
            $profile_mail = $dataEP[0]->email_profile;

            // if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                // $this->_sendmail($Email, $Judul, $body);
                $sql = "mgr.x_send_mail_php '".$profile_mail."', '".$email."', '".$title."', '".$body."', '' ";
                $snd = $this->m_wsbangun->setData_by_query_cons($cons,$sql);


                // if(strpos($snd,'Mail')>0){
                //     // var_dump($snd);
                //     // var_dump('$snd');
                //     $msg = 'Submit success and email sent';
                //     $psn ='OK';
                //     $aa = $msg;
                // }else{
                //     // var_dump($snd);
                //     // var_dump('12');
                //     $msg = $snd;
                //     $psn ='Fail';
                //     $aa = 'Sent Email Failed, Please Contact your Admin!';
                // }

                $aaa = strpos($snd,'Mail');
                // var_dump($aaa);exit;
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
                
                // $msg = 'Invitation successfully send';
                // $msgEmail='Email has been sent';
            // }else{
            //     // $msgEmail = 'Email not valid';
            //     $msg = 'method not valid';
            //     $psn ='Fail';
            //     $aa = $msg;
            // }

            // $a = "Data has been saved successfully";                   
               
                
        } else {
            $a = "Data is not valid";
        }
        $msg = array('pesan'=>$msg,
                     'PesanEmail'=>$msg,
                     'Status'=>$psn,
                     'Msg'=>$aa);
                     
        echo json_encode($msg);
        // $msg1=array('Pesan'=>$msg,
        //             'PesanEmail'=>$msgEmail);
        //         echo json_encode($msg1);
    }

	

}
?>