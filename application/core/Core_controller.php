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
        
        $sqlpict = "SELECT * from sysuser where email='$user_email'";
        $pictuser = $this->M_wsbangun->getData_by_query('IFCA', $sqlpict);

        $content['pictuser'] = '';
        if ($pictuser) {
            $content['pictuser'] = $pictuser[0]->pict;                   
        }
        else{
            $content['pictuser'] = base_url('app-assets/images/images/white.png');
        }

        $this->load->view('template/header', $content);
        if (!empty($view)) {
            $this->load->view($view, $content);
        }
        $this->load->view('template/footer');
    }

    public function load_content_top_menu($view = "", $content = null){
        $projectNo = $this->session->userdata('Tsproject');
        $usergroup = $this->session->userdata('Tsusergroup');
        $entity = $this->session->userdata('Tsentity');
        $projectn = $this->session->userdata('Tsprojectname') ;
        $user_email = $this->session->userdata('Tsemail');
        
        $content['projectName'] = '<a class="nav-link" href="'.base_url().'dash/index" style="padding-top: 0px;padding-right: 0px;">'.$projectn.'</a>';

        // picuser
            $sqlpict = "SELECT * from sysuser where email='$user_email'";
            $pictuser = $this->M_wsbangun->getData_by_query('IFCA', $sqlpict);
            $content['pictuser'] = '';
            if ($pictuser) {
                $content['pictuser'] = $pictuser[0]->pict;                   
            }
            else{
                $content['pictuser'] = "https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1";
            }

        // pic project
            $prjpict = "SELECT picture_path FROM project where project_no='$projectNo'";
            $pictproj = $this->M_wsbangun->getData_by_query('IFCA', $prjpict);
            
            $content['propict']='';
            if ($pictproj) {
                $content['propict'] = $pictproj[0]->picture_path;
            }else{
                $content['propict'] = "https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1";
            }

        // segment
            $param1 = $this->uri->segment(1);
            $param2 = $this->uri->segment(2);
            if(empty($param2)){
                $path = $param1.'/index';    
            }else{
                $path = $param1.'/'.$param2;
            }
            $content['path']=$path;

        $content['usergroup']=$usergroup;
        
        $this->load->view('template/header2', $content);
        if (!empty($view)){
            $this->load->view($view, $content);
        }
        $footer = array('copyright' => '');
        $this->load->view('template/footer2', $footer);
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

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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