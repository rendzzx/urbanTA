<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dash extends Core_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->library('encrypt');
        // $this->load->model('m_sms');
        // $this->load->model('m_dash');
    }
 
    public function index($project='')
    {
        // $entity = '';

        $entity = $this->session->userdata('Tsentity');

        $project_sess = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $userID = $this->session->userdata('Tsname');
        $email = $this->session->userdata('Tsemail');
        $entityname = $this->session->userdata('Tsentityname');
        $usergroup = $this->session->userdata('Tsusergroup');
        $sys = $this->session->userdata('Tsysadmin');
        $cl = $this->session->userdata('FCloud');

        $approver = 0;
        // var_dump($cl);
        if(empty($project_sess)){
            $sqlquery="SELECT min(project_no) as project_no, min(entity_cd) as entity_cd  from mgr.pl_project "; 
            $dt = $this->m_wsbangun->getData_by_queryadm($sqlquery);
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

            $datalist2 = $this->m_wsbangun->getDataadm('pl_project');
            $cntdatalist2 = count($datalist2);
        }
        else{
            $tabel2 = 'v_cfs_login_user';
            $kriteria2 = array(
            // 'userid'=>$userID,
                'project_status'=>1,
            'email'=>$email
            );
        
            $datalist2 = $this->m_wsbangun->getData_by_criteria_adm($tabel2, $kriteria2);
            $cntdatalist2 =count($datalist2);
        }
        $ListAllData='';
        // $cntdatalist2 =0;
        if($cntdatalist2 > 0){
            if(!empty($datalist2)){
                // var_dump($datalist2[0]->picture_path);
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
            }

            $sqlimage = "select pict from mgr.sysuser where name='$userID'";
      
            $image = $this->m_wsbangun->getData_by_queryadm($sqlimage);

       

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
                $image = $this->m_wsbangun->getData_by_queryadm($sqlimage);

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
                $image = $this->m_wsbangun->getData_by_queryadm($sqlimage);

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
            // $datalist2 = $this->m_wsbangun->getDataadm('pl_project');
            $sql = "SELECT * from mgr.pl_project(NOLOCK) where status=1".$where;
            $datalist2 = $this->m_wsbangun->getData_by_queryadm($sql);
            $cntdatalist2 = count($datalist2);
        }
        else{
           
            $sql = "SELECT * from mgr.v_cfs_login_user where email = '$email' and project_status=1".$where;
            $datalist2 = $this->m_wsbangun->getData_by_queryadm($sql);
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

    public function project_list($project=''){
        $userid = $this->session->userdata('Tsname');
        $sql = "SELECT distinct project_no,descs from mgr.v_cfs_user_project (nolock) where userid= '$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query($sql);
        // var_dump($project);
        $comboProject[]='';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtProject) {

                  if($project === $dtProject->project_no) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }
    public function call()
    {
        $paramSrc = $this->uri->segment(3);
        $param = base64_decode($paramSrc);
        
        if(empty($param)) {
            $entity = $this->session->userdata('Tsentity');            
            $entityname = $this->session->userdata('Tsentityname');
        } else {
            $entity = substr($param, 0,4);            
            $entityname = str_replace('%20', ' ', substr($param, 5));
            $this->session->set_userdata('Tsentity', $entity);
            $this->session->set_userdata('Tsentityname', $entityname);
        }
        
        $name = $this->session->userdata('Tsuname');
        $sys = $this->session->userdata('Tsysadmin');
        $approver = 0;

        $tabel2 = 'v_cfs_user_project';
        $kriteria2 = array(
            // 'entity_cd'=>$entity,
            'userid'=>$name);

        $datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2, $kriteria2);
        
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                
                $ListAllData .='<div class="col-md-3">';
                $ListAllData .='<div class="ibox">';
                $ListAllData .='<div class="ibox-content product-box">';
                $ListAllData .='<div class="product-imitation">';
                if(!empty($value->picture_path)){
                    $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/'.$value->picture_path).'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';
                }else{
                    $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/blankproject.png').'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';
                }
                $ListAllData .=$a;
                $ListAllData .='</div>';
                $ListAllData .='<div class="product-desc">'; 
                $ListAllData .='<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'" class="product-name">' .$value->descs. '&nbsp; <i class="fa fa-arrow-circle-right"></i><br>Click Here to begin.</a>';
                $ListAllData .='<a href="http://'.$value->http_add.'" target="_blank">&nbsp;<br>'.$value->http_add.'</a>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';

            }
        }

        $ContentAllData = array('PlProject' => $ListAllData,
            'leftdyn'=>$name,
            'isi'=>$datalist2,
            'sys'=>$sys,
            'approver'=>$approver,
            'entityname'=>$entityname);
        $this->load_content('dash/index', $ContentAllData, true);
    }
    
    public function indexold()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $webuser = $this->session->userdata('Tsuname');
        // $webuser = 'ARIE';
        $goto = $this->uri->segment(3);
        $offset = $this->uri->segment(4);
        // billing
        $startBill = $offset;
        $pageset = 10;
        $debtor = '0101';
        $cnBilling = $this->m_dash->getBillingCount($debtor);
        // var_dump($cnBilling);
        $pgBilling = create_paging($this, $pageset, 4, $offset, base_url('dash/index/billing/'), $cnBilling);
        $dtBilling = $this->m_dash->getBillingList($offset, $pageset, $debtor);
        $lsBilling = '';
        if(!empty($dtBilling))
        {
            foreach ($dtBilling as $key => $billing) {
                $lsBilling.='<tr role="row" class="odd">';
                $lsBilling.='<td>'.$billing->doc_no.'</td>';
                $lsBilling.='<td>'.date("d M Y", strtotime($billing->doc_date)).'</td>';
                $lsBilling.='<td>'.date("d M Y", strtotime($billing->due_date)).'</td>';
                $lsBilling.='<td>'.$billing->ar_ldg_desc.'</td>';
                $lsBilling.='<td>'.date("d M Y", strtotime($billing->start_date)).' - '.date("d M Y", strtotime($billing->end_date)).'</td>';
                $lsBilling.='<td>'.$billing->currency_cd.'</td>';
                $lsBilling.='<td align="right">'.number_format($billing->fbal_amt,2,",",".").'</td>';
                $lsBilling.='</tr>';
                switch ($billing->currency_cd) {
                    case 'RP':
                    $sumBilling['RP'] += $billing->fbal_amt;
                    break;
                    case 'USD':
                    $sumBilling['USD'] += $billing->fbal_amt;
                    break;
                }
            }
            if($sumBilling['RP']!=0) {
                $lsBilling .= '<tr><td colspan="5" align="right"><b>Total</b></td><td><b><span class="text-lightlime">RP</span></b></td><td align="right"><b><span class="text-lightlime">'.number_format($sumBilling['RP'],2,",",".").'</span></b></td></tr>';
            }
            if($sumBilling['USD']!=0) {
                $lsBilling .= '<tr><td colspan="6" align="right"></td><td><b><span class="text-lightlime">USD</span></b></td><td align="right"><b><span class="text-lightlime">'.number_format($sumBilling['USD'],2,",",".").'</span></b></td></tr>';
            }
        }
        // ticket
        $cnTicket = $this->m_dash->getTicketCount();
        // var_dump($cnTicket);
        $pgTicket = create_paging($this, $pageset, 4, $offset, base_url('dash/index/ticket/'), $cnTicket);
        // var_dump($pgTicket);
        $dtTicket = $this->m_dash->getTicketList($offset, $pageset);
        $lsTicket = '';
        if(!empty($dtTicket))
        {
            foreach ($dtTicket as $key => $ticket) {
                $lsTicket.='<tr role="row" class="odd">';
                $lsTicket.='<td>'.$ticket->complain_no.'</td>';
                $lsTicket.='<td>'.$ticket->cat_desc.'</td>';
                $lsTicket.='<td>'.$ticket->work_requested.'</td>';
                $lsTicket.='<td>'.date("d M Y", strtotime($ticket->reported_date)).'</td>';
                $lsTicket.='<td>'.$ticket->serv_req_by.'</td>';
                $lsTicket.='<td>'.$ticket->lot_no.'</td>';
                $dtStatus = get_statusIFCA($ticket->status);
                $lsTicket.='<td><span class="label label-'.$dtStatus["label"].'">'. $dtStatus["status"]. '</span></td>';
                $lsTicket.='</tr>';
            }
        }
        // newsfeed
        $nFeed = 3;
        $dtNews = $this->m_dash->getNewsList($offset, $nFeed);
        $lsNews = '';
        if(!empty($dtNews))
        {
            $lsNews.='<div id="carousel-generic" class="carousel slide" data-ride="carousel">';
            $lsNews.='<div class="carousel-inner" role="listbox">';
            foreach ($dtNews as $key => $news) {
                $lsNews.=($key > 0 ? '<div class="item">' : '<div class="item active">');
                $lsNews.='<div class="transbox"><div class="text-white text-group">';
                $lsNews.='<span class="text-title text-yellow">'.$news->subject.'</span>';
                if(strlen($news->content)>100) {
                    $lsNews.='<p class="text-yellow">'.limitWord($news->content,20).'</p>';
                } else {
                    $lsNews.='<p class="text-yellow">'.$news->content.'</p>';
                }
                $lsNews.='</div></div>';
                $lsNews.=(substr($news->picture,0,4)=='http' ? '<img class="img-dash" src="'.$news->picture.'" alt="pic'.$key.'">' : '<img class="img-dash" src="'.base_url('uploads/'.$news->picture).'" alt="pic'.$key.'">');
                $lsNews.='</div>';
            }
            $lsNews.='</div>';
            $lsNews.='<a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">';
            $lsNews.='<span class="glyphicon glyphicon-chevron-left sign-bottom" aria-hidden="true"></span><span class="sr-only">Previous</span></a>';
            $lsNews.='<a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">';
            $lsNews.='<span class="glyphicon glyphicon-chevron-right sign-bottom" aria-hidden="true"></span><span class="sr-only">Next</span></a>';
            $lsNews.='</div>';
        }

        // display
        $allList = array('appList'=>$lsTicket,
            'appPage'=>$pgTicket,
            'hotList'=>$lsBilling,
            'newsList'=>$lsNews
            );
        $this->load_content('dash/index',$allList);
    }

    public function ambildata(){

        $data = $this->m_wsbangun->getData('v_nup_group_leadbatam');

        echo json_encode($data);
    }

    public function upApv()
    {
        
        if($_POST)
        {
            $resback = false;
            $userid = $this->input->post('user_id', TRUE);
            $status = $this->input->post('status',TRUE);
            $doc_no = $this->input->post('doc_no',TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $today = date('Y M d H:i:s');
            // save approval
            $table = 'cm_authorized_person';
            $crit = array('type'=>'A',
                'doc_no'=>$doc_no,
                'user_id'=>$userid,
                'entity_cd'=>$entity,
                'project_no'=>$project);
            $data = array('status'=>$status,
                'approved_date'=>$today);
            $this->m_wsbangun->updateData($table, $data, $crit);
            // print_r('approve');
            // check other approver
            $ord = array('level_no', 'ASC');
            $crit = array('type'=>'A',
                'status'=>'N',
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'doc_no'=>$doc_no);
            // $cnt = $this->m_wsbangun->getCount_by_criteria($table, $crit);
            $dtApv = $this->m_wsbangun->getData_by_criteria($table, $crit, null, $ord);
            $table = 'rl_sales';
            $crit = array('ref_no'=>$doc_no);
            $dtSale = $this->m_wsbangun->getData_by_criteria($table, $crit);
            $acct = $dtSale[0]->debtor_acct;
            if(!empty($dtApv)) 
            {
                // update status next approver
                $othApv = $dtApv[0]->user_id;
                $table = 'cm_authorized_person';
                $data1 = array('status'=>'O');
                $crit = array('type'=>'A',
                    'status'=>'N',
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'doc_no'=>$doc_no,
                    'user_id'=>$othApv);
                $this->m_wsbangun->updateData($table, $data1, $crit);
                // find detail data
                $table = 'security_users';
                $crit = array('name'=>$othApv);
                $dtUser = $this->m_wsbangun->getData_by_criteria($table, $crit);
                if(!empty($dtUser))
                {
                    $destno = $dtUser[0]->phone_cellular;
                    $mailto = $dtUser[0]->email;
                    
                    if(!empty($dtSale))
                    {
                        $lot = $dtSale[0]->lot_no;
                        $acct = $dtSale[0]->debtor_acct;
                        $table = 'ar_debtor';
                        $crit = array('debtor_acct'=>$acct);
                        $dtAcct = $this->m_wsbangun->getData_by_criteria($table, $crit);
                        $dtName = (!empty($dtAcct)) ? $dtAcct[0]->name : '';
                        // if(!empty($dtAcct))
                        // {
                        //     $dtName = $dtAcct->name;
                        // }
                        // var_dump($dtName);
                    }
                    // notify sms
                    if(!empty($destno)||!empty($dtName))
                    {
                        $msgSMS = array('DestinationNumber'=>$destno,
                            "TextDecoded"=>'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName,
                            "creatorID"=>'MGR');
                        $this->m_sms->SendSms($msgSMS);
                        // print_r("sms");
                    }

                    // notify email
                    if(!empty($mailto)||!empty($dtName))
                    {
                        $subj = 'Approval';
                        $body = 'Congrat,'."\n\n";
                        $body.= 'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName.','."\n\n";
                        $body.= 'Thank you,';
                        $this->_sendmail($mailto, $subj, $body);
                        // print_r("email");
                    }
                }
            } else {
                if(!empty($acct))
                {
                    $sql = "mgr.xrl_billing_chrg '".$entity."', '".$project."','".$acct."'";
                    $res = $this->m_wsbangun->getData_by_query($sql);

                    $table = 'rl_sales';
                    $crit = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'ref_no'=>$doc_no);
                    $data = array('status'=>'B');
                    $this->m_wsbangun->updateData($table, $data, $crit);
                    // print_r("xrl");
                }
                $resback = true;    
            }
        }
        $tes = array('tes' => $resback );
        echo json_encode($tes);
    }
}