<?php if (! defined('BASEPATH')){exit('No direct script access allowed');}

class Core_controller extends CI_Controller{
	public $session_id;
    public $key = 1500806800;

	public function __construct(){
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
        header('Content-Transfer-Encoding: base64');
        $this->load->model('M_wsbangun');
    }

    public function load_content($view = "", $content = null){
        $today = strtotime('now');
        $userID = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
        $user_email = $this->session->userdata('Tsemail');
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

        $prjpict = "SELECT picture_path FROM mgr.pl_project where project_no='$project'";
        $pictproj = $this->M_wsbangun->getData_by_query('IFCA', $prjpict);
        
        $content['propict']='';
        if ($pictproj) {
            $content['propict'] = $pictproj[0]->picture_path;
        }else{
            $content['propict'] = base_url('app-assets/images/images/white.png');
        }

        $tabel2 = 'v_cfs_login_user';
        $kriteria2 = array('userid'=>$userID);

        
        $sqlpict = "SELECT * from mgr.sysuser where email='$user_email'";
        $pictuser = $this->M_wsbangun->getData_by_query('IFCA', $sqlpict);

        $content['pictuser'] = '';
        if ($pictuser) {
            $content['pictuser'] = $pictuser[0]->pict;                   
        }
        else{
            $content['pictuser'] = base_url('app-assets/images/images/white.png');
        }

        $datalist2 = $this->M_wsbangun->getData_by_criteria('IFCA', $tabel2, $kriteria2);
        $cntdatalist2 = count($datalist2);
        $content['countproject']=$cntdatalist2;

        $this->load->view('template/header', $content);
        if (!empty($view)) {
            $this->load->view($view, $content);
        }
        $this->load->view('template/footer');
     }
 
    public function GenerateToken($EmailPassword,$Date,$UserID,$email){
        $token = $email.','.$EmailPassword.','.$UserID.','.$Date;
        return $this->EncryptText($token);
    }

    public function EncryptText($inputText){
        $enc_method = 'AES-128-CTR';
        $enc_key = openssl_digest(gethostname() . "|" . ip2long($_SERVER['SERVER_ADDR']),'SHA256', true);
        $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($enc_method));
        $crypted_inputText = openssl_encrypt($inputText, $enc_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
        unset($inputText, $enc_method, $enc_key, $enc_iv);
        return $crypted_inputText;
    }

    public function get_dropdown($data){
        $dataDropdown = array_filter(
            $data,function($a) {
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
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function load_content_top_menu($view = "", $content = null){
        $projectNo = $this->session->userdata('Tsproject');
        $usergroup = $this->session->userdata('Tsusergroup');
        $entity = $this->session->userdata('Tsentity');
        $today = date('d/m/Y');
        $pday = strtotime('now');

        $projectn = $this->session->userdata('Tsprojectname') ;
        $user_email = $this->session->userdata('Tsemail');
        
        $projectnm = '';
        $projectnm = ' <a class="nav-link" href="'.base_url().'dash/index" style="padding-top: 0px;padding-right: 0px;">'.$projectn.'</a>';
        
        
        $content['projectName'] = $projectnm;

        $sqlpict = "SELECT * from mgr.sysuser where email='$user_email'";
        $pictuser = $this->M_wsbangun->getData_by_query('IFCA', $sqlpict);


        
        $content['pictuser'] = '';
        if ($pictuser) {
            $content['pictuser'] = $pictuser[0]->pict;                   
        }
        else{
            $content['pictuser'] = "https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1";
        }

        $prjpict = "SELECT picture_path FROM mgr.pl_project where project_no='$projectNo'";
        $pictproj = $this->M_wsbangun->getData_by_query('IFCA', $prjpict);
        
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
        $user_email = $this->session->userdata('Tsemail'); 
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        
        $content['path']=$path;
        $userID = $this->session->userdata('Tsname');
        $content['usergroup']=$usergroup;
        $tabel2 = 'v_cfs_login_user';
        $kriteria2 = array('userid'=>$userID);

        $datalist2 = $this->M_wsbangun->getData_by_criteria('IFCA', $tabel2, $kriteria2);
        $cntdatalist2 = count($datalist2);
        $content['countproject']=$cntdatalist2;

        $sqlpict = "SELECT * from mgr.sysuser where email='$user_email'";
        $pictuser = $this->M_wsbangun->getData_by_query('IFCA', $sqlpict);

        $content['pictuser'] = '';
        if ($pictuser) {
            $content['pictuser'] = $pictuser[0]->pict;                   
        }
        else{
            $content['pictuser'] = "https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1";
        }

        $this->load->view('template/header2', $content);
        if (!empty($view)){
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
    
    public function auth_check(){
        $is_logged = $this->session->userdata("is_Staff_logged");
        $is_cloud = $this->session->userdata("FCloud");
        $is_reset = $this->session->userdata("isReset");
        if($is_reset == '1' || (isset($is_reset) && $is_reset == true)){
          redirect('ResetPassword/reset');
        }
        if (!isset($is_logged) || (isset($is_logged) && $is_logged == false)) {
              redirect('login');   
        }
        $user_id = $this->session->userdata('Tsuser_id');
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
}