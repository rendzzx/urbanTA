<?php
if (! defined('BASEPATH'))
{
	exit('No direct script access allowed');
}

class Core_controller extends CI_Controller
{

	public $session_id;
  public $key = 1500806800;
	public function __construct()
	{
		parent::__construct();

		date_default_timezone_set("Asia/Jakarta");
    header('Content-Transfer-Encoding: base64');
		// $this->load->model('m_staff');
        // $this->load->model('m_helpdesk');
		// $this->load->model('m_documentnumber');
		// $this->load->model('m_category4helpdesk');
        $this->load->model('M_wsbangun');
        // $this->session_id = $this->session->userdata('session_id');
    }

    public function load_content($view = "", $content = null)
    {		

        $today = strtotime('now');
     
        $userID = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
        $user_email = $this->session->userdata('Tsemail'); 
        // var_dump($user_email);exit();
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        
        $projectn = $this->session->userdata('Tsprojectname') ;
       
        
        $projectnm = '';
        $projectnm = ' <a class="nav-link" href="'.base_url().'dash/index" style="padding-top: 0px;padding-right: 0px;">'.$projectn.'</a>';

        $content['projectName'] = '';
        if(!empty($projectn)) {
            $content['projectName'] = $projectnm;
        }else{
            $content['projectName'] = '';
        }
        

        // $sqlpict = "SELECT * from mgr.sysuser where email='$user_email'";
        // $pictuser = $this->m_wsbangun->getData_by_queryadm($sqlpict);
        // // var_dump($sqlpict);exit();
        // // console.log($pictuser);

        // $content['propict'] = '';
        // if ($pictuser) {
        //     $content['propict'] = $pictuser[0]->pict;                   
        // }
        // else{
        //     $content['propict'] = "././app-assets/images/images/white.png";
        // }

        $prjpict = "SELECT picture_path FROM mgr.pl_project where project_no='$project'";
        $pictproj = $this->m_wsbangun->getData_by_queryadm($prjpict);
        
        $content['propict']='';
        if ($pictproj) {
            $content['propict'] = $pictproj[0]->picture_path;
        }else{
            $content['propict'] = base_url('app-assets/images/images/white.png');
        }

        

        $tabel2 = 'v_cfs_login_user';
        $kriteria2 = array('userid'=>$userID);

        
        $sqlpict = "SELECT * from mgr.sysuser where email='$user_email'";
        $pictuser = $this->m_wsbangun->getData_by_queryadm($sqlpict);

        $content['pictuser'] = '';
        if ($pictuser) {
            $content['pictuser'] = $pictuser[0]->pict;                   
        }
        else{
            $content['pictuser'] = base_url('app-assets/images/images/white.png');
        }

        $datalist2 = $this->m_wsbangun->getData_by_criteria_adm($tabel2, $kriteria2);
        $cntdatalist2 = count($datalist2);
        $content['countproject']=$cntdatalist2;
          
        $divcnt_notif = '';
        $sql ="SELECT count(*) as cnt from mgr.sysnotification where entity_cd='$entity' and project_no='$project' and email_addr ='$user_email' and isread='0' ";
        $cntnotif = $this->m_wsbangun->getData_by_queryadm($sql);
        $newnotif = (int)$cntnotif[0]->cnt;
        if($newnotif>0){
            
            $divcnt_notif.='<span class="badge badge-pill badge-sm badge-danger badge-default badge-up badge-glow">'.$newnotif.'</span>';
        }
        $content['cntnotif']=$divcnt_notif;

        $div_notif='';
        $sql ="SELECT * from mgr.sysnotification where entity_cd='$entity' and project_no='$project' and email_addr ='$user_email' order by notificationdate desc";        
        $dtnotif = $this->m_wsbangun->getData_by_queryadm($sql);
        // $dtnotif = null;
        if(!empty($dtnotif)){
            foreach ($dtnotif as $key) {
                if($key->NotificationCd =='NEW'){
                    $classcolors = 'info';
                    $icon = 'ft-tag';
                    $notifdescs='New Ticket';
                } else if($key->NotificationCd =='ASSIGN'){
                    $classcolors = 'danger';
                    $icon = 'ft-user-plus';
                    $notifdescs='New Assigned Ticket';
                }else if($key->NotificationCd =='APPROVAL'){
                    $classcolors = 'warning';
                    $icon = 'ft-user-check';
                    $notifdescs='New Approval';
                }else if($key->NotificationCd =='CONFIRM'){
                    $classcolors = 'secondary';
                    $icon = 'ft-save';
                    $notifdescs='New Confirmed Ticket';
                }else if($key->NotificationCd =='MODIFY'){
                    $classcolors = 'primary';
                    $icon = 'ft-save';
                    $notifdescs='New Modified Ticket';
                }else if($key->NotificationCd =='PROCESS'){
                    $classcolors = 'success';
                    $icon = 'ft-clock';
                    $notifdescs='Ticket is Being Processed';
                } else {
                    $icon = 'ft-loader';
                    $classcolors = 'dark';
                    $notifdescs='Undefined'; 
                }

                if(!$key->IsRead){
                    $div_notif.='<div style="background-color: #fffbea">';
                }else {
                    $div_notif.='<div style="background-color: #fff">';
                }
                  
                  $div_notif.='<div class="media">';
                  $div_notif.='  <div class="media-left align-self-center"><i class="'.$icon.' '.$classcolors.' font-medium-4 mt-2"></i></div>';
                  $div_notif.='  <div class="media-body">';
                  $div_notif.='    <small class="pull-right">'.$this->time_elapsed_string($key->NotificationDate).'</small>';
                  $div_notif.='    <h6 class="media-heading '.$classcolors.'">'.$notifdescs.'</h6>';
                  $div_notif.='   <p class="notification-text font-small-3 text-muted text-bold-600">'.$key->Remarks.'</p><small>';
                  $div_notif.='      <time class="media-meta text-muted">at '.date('g:i a',strtotime($key->NotificationDate)).' - '.date('j F Y',strtotime($key->NotificationDate)).'</time></small>';
                  $div_notif.='  </div>';
                  $div_notif.='</div>';
                  $div_notif.='  </div>';         
            }
            
        } else {
            $div_notif.='<p style="padding-left: 15px;padding-top: 10px;">No Notification Available.</p>';
        }
        $content['divnotif']=$div_notif;

        $this->load->view('template/header', $content);

        if (! empty($view)) {
         $this->load->view($view, $content);
        }

		// $footer = array('copyright' => '');
		$this->load->view('template/footer');
 }
 
 public function Output($Error,$Data,$Psn,$Status){
    $msg1 = array(
        'Error' => $Error,
        'Data' =>$Data,
        'Pesan'=>$Psn,
        'Status'=>$Status
    );
  }
public function convertToBytes($from){
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
    $number = substr($from, 0, -2);
    $suffix = strtoupper(substr($from,-2));

    //B or no suffix
    if(is_numeric(substr($suffix, 0, 1))) {
        return preg_replace('/[^\d]/', '', $from);
    }

    $exponent = array_flip($units)[$suffix];
    if($exponent === null) {
        return null;
    }

    return $number * (1024 ** $exponent);
}


public function GenerateToken($EmailPassword,$Date,$UserID,$email){
    $token = $email.','.$EmailPassword.','.$UserID.','.$Date;
    return $this->EncryptText($token);

}

public function EncryptText($inputText){
     // $inputText = "The quick brown fox jumps over the lazy dog.";
        $enc_method = 'AES-128-CTR';
        // var_dump($_SERVER['SERVER_ADDR']);
        $enc_key = openssl_digest(gethostname() . "|" . ip2long($_SERVER['SERVER_ADDR']),'SHA256', true);
        $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($enc_method));
        $crypted_inputText = openssl_encrypt($inputText, $enc_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
        unset($inputText, $enc_method, $enc_key, $enc_iv);
        return $crypted_inputText;
}

public function SaveUserSession($data){
      return  $save = $this->M_wsbangun->insertData('ifca3','sysUserSession', $data);
}

public function get_dropdown($data){
    $dataDropdown = array_filter($data,function($a) {
                        
                        return $a->FieldType === 'DropDown';

                    });
    $dt = array();
    foreach ($dataDropdown as $key ) {
        $view = 'mgr.'.$key->DropdownSource;        
        $sql = 'Select * from '.$view;

        $DB2 = $this->load->database('ifca3', TRUE);
       
        $qq = $DB2->query($sql);     
        $query = $qq->result(); 
         $DB2->close();
        $dt[$key->KeyName] = $query;

    }

    return $dt;

}

public function get_menu($group=''){
    $this->load->database();
    $DB2 = $this->load->database('ifca3', TRUE);

    $table = "select ROW_NUMBER() OVER (ORDER BY parent_seq, child_seq, mgr.v_sysMenuMobileGroup.MenuID ASC) AS [row_number], ";
    $table .= " * from mgr.v_sysMenuMobileGroup";
    $table .= " where GroupCd =? ";
    $table .= " order by parent_seq, child_seq";

    $where = array($group);
    $qq = $DB2->query($table, $where);     
    $query = $qq->result();        

    return ($query);
}

public function get_field(){
    $this->load->database();
    $DB2 = $this->load->database('ifca3', TRUE);

    $table = "select  ";
    $table .= " * from mgr.sysField";
    $table .= " order by FieldOrder";
   
    $qq = $DB2->query($table);     
    $query = $qq->result();        
     $DB2->close();
    return ($query);
}

 public function generateRandomString($length = 10) {
    // $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


 public function load_content_top_menu2($view = null, $content = null)
 {       

    $projectNo = $this->session->userdata('Tsproject');
    $entity = $this->session->userdata('Tsentity');
    $project = $this->session->userdata('Tsproject');
    $dday = strtotime('now');
    $today = date('d/m/Y');
        // var_dump($projectNo);
        // return;

    $table2 = "SELECT nup_menu, booking_menu FROM mgr.pl_project (NOLOCK) WHERE project_no = '$projectNo'";
        // $crit2 = array('project_no' => $projectNo);

    $sql ="SELECT COUNT(*) AS counter FROM mgr.rl_nup_parameter";
    $sql.= " WHERE entity_cd = '$entity'";
    $sql.= " AND project_no = '$project'";
    $sql.= " AND '$today' BETWEEN start_date AND end_date";
    $sql.= " AND status = '1' and cancel_nup = '1'";
        // var_dump($sql);exit;
    // $data =($dday>$this->key) ? $this->m_wsbangun->dTr('application'): '';
    $qry = $this->m_wsbangun->getData_by_query($sql);
    $cnt = $qry[0]->counter;

    $sql2 = "SELECT count(*) as cnt FROM mgr.rl_nup_parameter (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and '$today' between start_date and end_date and status = 1 and choose_unit_status = 1";
    $a = $this->m_wsbangun->getData_by_query($sql2);
    $b =intval($a[0]->cnt); 

        // $content = array('cek' => $cnt);

        // $descProject = $this->m_wsbangun->getData_by_criteria($table2, $crit2);
    $descProject = $this->m_wsbangun->getData_by_query($table2);
    $nupMenu = $descProject[0]->nup_menu;
    $bookingMenu = $descProject[0]->booking_menu;

    $menu = array('nupMenu'=>$nupMenu,
        'bookingMenu'=>$bookingMenu,
        'cek'=>$cnt,
        'MenuChoose'=>$b);

    // $this->load->view('template/header2', $menu);
    $this->load->view('template/header', $menu);
        // $this->load->view('template/top', $content);
    if (!empty($view))
    {
        $this->load->view($view, $content);
    }

    // $footer = array('copyright' => '');
    $this->load->view('template/footer'); 
}

public function load_content_mgm($view="", $content="")
{
  $projectNo = $this->session->userdata('Tsproject');
  $usergroup = $this->session->userdata('Tsusergroup');
  $entity = $this->session->userdata('Tsentity');
  $today = date('d/m/Y');
  $nday = strtotime('now');
  $param1 = $this->uri->segment(1);
  $param2 = $this->uri->segment(2);
// var_dump($nday>$this->key);
  if(empty($param2)){
      $path = $param1.'/index';    
    }else{
        $path = $param1.'/'.$param2;
    }
  // var_dump($path);
  // var_dump($usergroup);
  $header['path']=$path;
  $header['usergroup']=$usergroup;
  // $data =($nday>$this->key) ? $this->m_wsbangun->dTr('application'): '';
  $this->load->view('template/headergrafik2',$header);
  if(!empty($view)) {
    $this->load->view($view, $content);
  }
  $this->load->view('template/footer2');
}

public function load_content_top_menu($view = "", $content = null)
    {
        $projectNo = $this->session->userdata('Tsproject');
        $usergroup = $this->session->userdata('Tsusergroup');
        $entity = $this->session->userdata('Tsentity');
        $MenuPs = $this->session->userdata('TMenuPs');
        $today = date('d/m/Y');
        $pday = strtotime('now');

        $projectn = $this->session->userdata('Tsprojectname') ;
        $user_email = $this->session->userdata('Tsemail');
        
        $projectnm = '';
        $projectnm = ' <a class="nav-link" href="'.base_url().'dash/index" style="padding-top: 0px;padding-right: 0px;">'.$projectn.'</a>';
        
        
        $content['projectName'] = $projectnm;

        $sqlpict = "SELECT * from mgr.sysuser where email='$user_email'";
        $pictuser = $this->m_wsbangun->getData_by_queryadm($sqlpict);


        
        $content['pictuser'] = '';
        if ($pictuser) {
            $content['pictuser'] = $pictuser[0]->pict;                   
        }
        else{
            $content['pictuser'] = "https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1";
        }

        $prjpict = "SELECT picture_path FROM mgr.pl_project where project_no='$projectNo'";
        $pictproj = $this->m_wsbangun->getData_by_queryadm($prjpict);
        
        $content['propict']='';
        if ($pictproj) {
            $content['propict'] = $pictproj[0]->picture_path;
        }else{
            $content['propict'] = "https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1";
        }



        $param1 = $this->uri->segment(1);
        $param2 = $this->uri->segment(2);

        if(empty($param2)){
            $path = $param1.'/index';    
        }else{
            $path = $param1.'/'.$param2;
        }

        $cons = $this->session->userdata('Tscons');
        // $user_id = $this->session->userdata('Tsname');
        $user_email = $this->session->userdata('Tsemail'); 
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        
        $content['path']=$path;
        // var_dump($path);
        // var_dump($usergroup);
        $userID = $this->session->userdata('Tsname');
        $content['usergroup']=$usergroup;
        // $tabel2 = 'v_cfs_user_project';
        $tabel2 = 'v_cfs_login_user';
        $kriteria2 = array('userid'=>$userID);

        $datalist2 = $this->m_wsbangun->getData_by_criteria_adm($tabel2, $kriteria2);
        $cntdatalist2 = count($datalist2);
        $content['countproject']=$cntdatalist2;

        $sqlpict = "SELECT * from mgr.sysuser where email='$user_email'";
        $pictuser = $this->m_wsbangun->getData_by_queryadm($sqlpict);

        $content['pictuser'] = '';
        if ($pictuser) {
            $content['pictuser'] = $pictuser[0]->pict;                   
        }
        else{
            $content['pictuser'] = "https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1";
        }

        $divcnt_notif = '';
        $sql ="SELECT count(*) as cnt from mgr.sysnotification where entity_cd='$entity' and project_no='$project' and email_addr ='$user_email' and isread='0' ";
        $cntnotif = $this->m_wsbangun->getData_by_queryadm($sql);
        $newnotif = (int)$cntnotif[0]->cnt;
        if($newnotif>0){
            
            $divcnt_notif.='<span class="badge badge-pill badge-sm badge-danger badge-default badge-up badge-glow">'.$newnotif.'</span>';
        }
        $content['cntnotif']=$divcnt_notif;

        $div_notif='';
        $sql ="SELECT * from mgr.sysnotification where entity_cd='$entity' and project_no='$project' and email_addr ='$user_email' order by notificationdate desc";        
        $dtnotif = $this->m_wsbangun->getData_by_queryadm($sql);
        // $dtnotif = null;
        if(!empty($dtnotif)){
            foreach ($dtnotif as $key) {
                if($key->NotificationCd =='NEW'){
                    $classcolors = 'info';
                    $icon = 'ft-tag';
                    $notifdescs='New Ticket';
                } else if($key->NotificationCd =='ASSIGN'){
                    $classcolors = 'danger';
                    $icon = 'ft-user-plus';
                    $notifdescs='New Assigned Ticket';
                }else if($key->NotificationCd =='APPROVAL'){
                    $classcolors = 'warning';
                    $icon = 'ft-user-check';
                    $notifdescs='New Approval';
                }else if($key->NotificationCd =='CONFIRM'){
                    $classcolors = 'secondary';
                    $icon = 'ft-save';
                    $notifdescs='New Confirmed Ticket';
                }else if($key->NotificationCd =='MODIFY'){
                    $classcolors = 'primary';
                    $icon = 'ft-save';
                    $notifdescs='New Modified Ticket';
                }else if($key->NotificationCd =='PROCESS'){
                    $classcolors = 'success';
                    $icon = 'ft-clock';
                    $notifdescs='Ticket is Being Processed';
                } else {
                    $icon = 'ft-loader';
                    $classcolors = 'dark';
                    $notifdescs='Undefined'; 
                }

                if(!$key->IsRead){
                    $div_notif.='<div style="background-color: #fffbea">';
                }else {
                    $div_notif.='<div style="background-color: #fff">';
                }
                  
                  $div_notif.='<div class="media">';
                  $div_notif.='  <div class="media-left align-self-center"><i class="'.$icon.' '.$classcolors.' font-medium-4 mt-2"></i></div>';
                  $div_notif.='  <div class="media-body">';
                  $div_notif.='    <small class="pull-right">'.$this->time_elapsed_string($key->NotificationDate).'</small>';
                  $div_notif.='    <h6 class="media-heading '.$classcolors.'">'.$notifdescs.'</h6>';
                  $div_notif.='   <p class="notification-text font-small-3 text-muted text-bold-600">'.$key->Remarks.'</p><small>';
                  $div_notif.='      <time class="media-meta text-muted">at '.date('g:i a',strtotime($key->NotificationDate)).' - '.date('j F Y',strtotime($key->NotificationDate)).'</time></small>';
                  $div_notif.='  </div>';
                  $div_notif.='</div>';
                  $div_notif.='  </div>';         
            }
            
        } else {
            $div_notif.='<p style="padding-left: 15px;padding-top: 10px;">No Notification Available.</p>';
        }
        $content['divnotif']=$div_notif;
        if($MenuPs=='L'){
             $this->load->view('template/headerLeft', $content);
        }else{
              $this->load->view('template/header2', $content);
        }
       
        
        if (!empty($view))
        {
            $this->load->view($view, $content);
        }

        $footer = array('copyright' => '');
        $this->load->view('template/footer2', $footer);
    }
public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
    
public function auth_check()
{
    $is_logged = $this->session->userdata("is_Staff_logged");
    $is_cloud = $this->session->userdata("FCloud");
    $is_reset = $this->session->userdata("isReset");
    if($is_reset == '1' || (isset($is_reset) && $is_reset == true)){
      redirect('ResetPassword/reset');
    }
    if (!isset($is_logged) || (isset($is_logged) && $is_logged == false)) {
        
        //jika ifca cloud
          // redirect('goto_cloud');    
        //jika dari client
          redirect('userStaff');   
        
    }
    $user_id = $this->session->userdata('Tsuser_id');
}

public function get_total_page($total_rows = 0, $per_page = 0)
{
  $total_page = (int)($total_rows / (int)$per_page);
  $remainder = (int)($total_rows % (int)$per_page);
  if ($remainder > 0)
  {
     $total_page ++;
 }

 if ($total_page > 0)
 {
     return $total_page;
 }
 else
 {
     return 0;
 }
}

protected function is_approved($model_name = "", $rec_num = 0) {
    $record = $this->$model_name->get_by_id($rec_num);
    if (!is_null($record) && $record->approved != '-1') {
        return true;
    } else {
        return false;
    }
}

protected function check_client() {
//        if ($_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR']) {
//            redirect(base_url() . "block.php");
//        }
}

protected function is_backend_login() {
    $backend_login = $this->session->userdata('backend_login');
    if (is_null($backend_login)) {
        $backend_login = false;
    }
    return $backend_login;
}

public function take_status_lain($id)
{

   $kriteria = array('id_helpdesk' => $id);
   $data=$this->m_helpdesk_log->get_by_criteria($kriteria);
   if($data)
   {
      return $data[0]->status;	
  }else{
      return (int)3;	
  }

}

public function generate_doc_num($type=null)
{
   $kriteria = array('tipedocument' => $type);
   $data=$this->m_documentnumber->get_doc($kriteria);
   if($data)
   {
      $angka = (int)$data[0]->number + 1;
      return (string)str_pad($angka, 7, "0", STR_PAD_LEFT);	
  }else{
      return (string)str_pad(1, 7, "0", STR_PAD_LEFT);	
  }

}

public function save_doc_num($data=null)
{
   $this->m_documentnumber->insert($data);
}

public function helpdesk_category($cat=null)
{
   $kriteria = array('id' => $cat);
   $data=$this->m_category4helpdesk->get_by_criteria($kriteria);
   if($data)
   {    		
      return $data[0]->name;	
  }else{
      return null;
  }

}  

public function _sendmail($to, $subject, $message, $attachment=null){  

    $config = array (
    'protocol' => 'smtp',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'crlf' => "\r\n",
    'newline' => "\r\n", //must have for office365!
    'priority' => 3,
    'smtp_host' => 'smtp.office365.com',
    'smtp_port' => '587',
    'smtp_crypto' => 'tls',
    'smtp_user' => 'cs@ifcacloud.com',
    'smtp_pass' =>'P@ssw0rd',
    'smtp_timeout' => 5);

    $this->load->library('email', $config);        

    $this->email->from('cs@ifcacloud.com');        
    $this->email->to($to);
    // $this->email->cc($cc); 
    // $this->email->bcc($bcc);         
    $this->email->subject($subject);
    $this->email->message($message);

    if (!empty($attachment)){
      $this->email->attach($attachment);
    }

    $this->email->send();

    $sent = $this->email->send();      
}

public function _sendgmail($to, $cc, $subject, $message, $attachment=null){

    $msg = "OK"; 

    $config = array (
    'protocol' => 'smtp',
    'mailtype' => 'html',
    'charset' => 'utf-8',
    'crlf' => "\r\n",
    'newline' => "\r\n",
    'priority' => 3,
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_crypto' => 'tls',
    'smtp_user' => 'rhezajulian@gmail.com',
    'smtp_pass' =>'hirohamada123456',
    'smtp_timeout' => 5,
    'wordwrap' => TRUE,
    '_bit_depths' => array('7bit', '8bit', 'base64'),
    '_encoding' => 'base64'
  );

    $this->load->library('Email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from('rhezajulian@gmail.com');        
    $this->email->to($to);
    $this->email->cc($cc); 
    // $this->email->bcc($bcc);         
    $this->email->subject($subject);
    $this->email->message($message);

    if (!empty($attachment)){
      $this->email->attach($attachment);
    }

    // $this->email->send();

    $sent = $this->email->send(); 
    // var_dump($sent);

    if ($sent) {
      $msg = "OK";
    }     
    else{
      $msg = "Gagal";
    }

    return $msg;
}

public function _sendmailxx($kepada, $judul, $pesan, $attc=null)
{

   $config = [        
      'protocol' => 'smtp',
      'smtp_host' => 'smtp.office365.com',
      'smtp_user' => 'cs@ifcacloud.com',
      'smtp_pass' => 'P@ssw0rd',
      'smtp_crypto' => 'tls',    
      'newline' => "\r\n", //REQUIRED! Notice the double quotes!
      'smtp_port' => 587,
      'mailtype' => 'html'    
    ];

    $this->load->library('email', $config);        

    $this->email->from('cs@ifcacloud.com');        
    $this->email->to($to);
    $this->email->cc($cc); 
    $this->email->bcc($bcc);         
    $this->email->subject($subject);
    $this->email->message($message);

    if (!empty($attachment)){
      $this->email->attach($attachment);
    }

    $this->email->send();

    $sent = $this->email->send();
    // $config['useragent'] = 'codeigniter';
    // $config['protocol'] = 'smtp';
    // $config['smtp_host'] = 'ssl://smtp.gmail.com';
    // $config['smtp_port'] = '465';
    //     // $config['smtp_user'] = 'ifca.acfi.tt@gmail.com';
    // $config['smtp_user'] = 'sml.ifca@gmail.com';        
    // $config['smtp_from_name'] = 'Sinarmas Land';
    // $config['smtp_pass'] = 'smlifca365';      
    //     // $config['mailpath'] = "/usr/sbin/sendmail"; // or "/usr/sbin/sendmail"
    // $config['mailpath'] = 'C:\\xampp\\sendmail\\sendmail.exe -t ';
    //     $config['mailtype'] = 'html'; //'text';
    //     $config['charset'] = 'utf-8';
    //     $config['newline'] = "\r\n";
    //     $config['wordwrap'] = TRUE;
    //     $config['charset'] = 'iso-8859-1';

    //     $this->load->library('Email');
    //     $this->email->clear(TRUE);
    //     $this->email->initialize($config);
    //     // $this->email->from('ifca.acfi.tt@gmail.com', 'Web System');
    //     $this->email->from('sml.ifca@gmail.com', 'Sinarmas Land');
    //     $this->email->to($kepada); 
    //     $this->email->subject($judul);
    //     $this->email->message($pesan);
    //     if (!empty($attc)) 
    //     {
    //      $this->email->attach($attc);
    //  }  
    //  /* $this->email->attach($attc);*/

    //  $this->email->send();
        // echo $this->email->print_debugger();
 }
}