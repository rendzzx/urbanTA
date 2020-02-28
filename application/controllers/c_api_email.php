<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
// header('Access-Control-Allow-Origin: *');
class c_api_email extends Core_Controller
{
    public function __construct(){
        parent::__construct();
    }
    public function index(){

        $this->load->view('login/indexEmail');
    }
    public function POST_EMAIL_API(){
        $msg = ' ';
        $psn = ' ';
        if ($_POST) {
            $to = $this->input->post('to', TRUE);
            $subject = $this->input->post('subject', TRUE);
            $cc = $this->input->post('cc', TRUE);
            $bcc = $this->input->post('bcc', TRUE);
            $message = $this->input->post('message', TRUE);
            $attachment = $this->input->post('attachment', TRUE);

            // $to = 'fauzia.filardi@ifca.co.id';
            // $subject = 'Forget Password';
            // $message = 'Congrat,'."\n\n";
            // $message.= 'Please review and approve new booking unit: Cs Name: ,'."\n\n";
            // $message.= 'Thank you,';

            // $mail = $this->_sendmail($to, $cc, $bcc, $subject, $message, $attachment);
            $mail = $this->_sendmail($to, $subject, $message, $attachment);

            $msg="Email sent";
            $psn ="Success";
        } else {
            $msg="Email Failed";
            $psn ="Error";
        }

        $msg1 = array(
            'Pesan' => $msg,
            'status' =>$psn
        );
    echo  json_encode($msg1);
    }

     private function EmailFormat($f_user_name){

    
                      // $email = '<!DOCTYPE html><html lang="en">'    ; 
                      // $email .= '<head>'    ; 
                      // $email .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">'    ; 
                      // $email .= '<title>Occupants Registration </title>'    ; 
                      // $email .= '<style type="text/css">'    ; 
                      // $email .= '::selection{ background-color: #E13300; color: white; }'    ; 
                      // $email .= '::moz-selection{ background-color: #E13300; color: white; } '    ; 
                      // $email .= '::webkit-selection{ background-color: #E13300; color: white; } body { '    ; 
                      // $email .= 'background-color: #fff; '    ; 
                      // $email .= 'margin: 40px; '    ; 
                      // $email .= 'font: 13px/20px normal Helvetica, Arial, sans-serif; '    ; 
                      // $email .= 'color: #4F5155; '    ; 
                      // $email .= '} '    ; 
                      // $email .= 'a { '    ; 
                      // $email .= 'color: #003399; '    ; 
                      // $email .= 'background-color: transparent; '    ; 
                      // $email .= 'font-weight: normal; '    ; 
                      // $email .= '} '    ; 
                      // $email .= 'h1 { '    ; 
                      // $email .= 'color: #444; '    ; 
                      // $email .= 'background-color: transparent; '    ; 
                      // $email .= 'border-bottom: 1px solid #D0D0D0; '    ; 
                      // $email .= 'font-size: 19px; '    ; 
                      // $email .= 'font-weight: normal; '    ; 
                      // $email .= 'margin: 0 0 14px 0; '    ; 
                      // $email .= 'text-align: left; '    ; 
                      // $email .= '} '    ; 
                      // $email .= 'code { '    ; 
                      // $email .= 'font-family: Consolas, Monaco, Courier New, Courier, monospace; '    ; 
                      // $email .= 'font-size: 12px; '    ; 
                      // $email .= 'background-color: #f9f9f9; '    ; 
                      // $email .= 'border: 1px solid #D0D0D0; '    ; 
                      // $email .= 'color: #002166; '    ; 
                      // $email .= 'display: block; '    ; 
                      // $email .= 'margin: 14px 0 14px 0; '    ; 
                      // $email .= 'padding: 12px 10px 12px 10px; '    ; 
                      // $email .= ' } '    ; 
                      // $email .= '#body{ '    ; 
                      // $email .= 'margin: 0 15px 0 15px; '    ; 
                      // $email .= '} '    ; 
                      // $email .= 'p.footer{ '    ; 
                      // $email .= 'text-align: right; '    ; 
                      // $email .= 'font-size: 11px; '    ; 
                      // $email .= 'border-top: 1px solid #D0D0D0;'    ; 
                      // $email .= 'line-height: 32px; '    ; 
                      // $email .= 'padding: 0 10px 0 10px; '    ; 
                      // $email .= 'margin: 20px 0 0 0; '    ; 
                      // $email .= '} '    ; 
                      // $email .= '#container{ '    ; 
                      // $email .= 'margin: 10px; '    ; 
                      // $email .= 'border: 1px solid #D0D0D0; '    ; 
                      // $email .= '-webkit-box-shadow: 0 0 8px #D0D0D0; '    ; 
                      // $email .= '} '    ; 
                      // $email .= '</style> '    ; 
                      // $email .= '</head> '    ; 
                      // $email .= '<body> '    ; 
                      // $email .= '<div> '    ; 
                      // $email .= '<h1>Dear '.$f_user_name.',</h1>'    ; 
                      // $email .= '<div> '     ;
                      // $email .= '<div> '     ;
                      // $email .= '<br>  Please Click Link Below for change Password :<br> '     ;
                      // $email .= '<p><a title = "1" href = "#" target = "_blank" > Clik Here </a></p>'   ;
                      // $email .= '<br><br>For more info contact us at +6281213141516 or email admin@ifca.co.id .<br><br>'    ; 
                      // $email .= '</div> '    ;   
                      // $email .= '<p>Thank You.</p> '    ; 
                      // $email .= '<br><br>  '    ; 
                      // $email .= '</body>'    ; 
                      // $email .= '</html>' ;

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
                      $email .= '<br>  To view PROJECT NAME web portal please complete your registration in this link below :<br> '     ;
                      // $email .= '<p><a title = "1" href = "'.$rt_url_link.'" target = "_blank" > Clik Here </a></p>'   ;
                      $email .= '<br><br>For more info contact us at +6281213141516 or email admin@ifca.co.id .<br><br>'    ; 
                      $email .= '</div> '    ;   
                      $email .= '<p>Thank You.</p> '    ; 
                      $email .= '<br><br>  '    ; 
    
                      $email .= '<h1>Terhormat Bpk/Ibu '.$f_user_name.',</h1>'    ; 
                      $email .= '<div> '     ;
                      $email .= '<div> '     ;
                      $email .= '<br>Untuk melihat web portal PROJECT NAME mohon lakukan registrasi terlebih dahulu di link berikut : <br> '     ;
                      // $email .= '<p><a title = "1" href = "'.$rt_url_link.'" target = "_blank" > Clik Here </a></p>'   ;
                      $email .= '<br><br>Keterangan lebih lanjut  hubungi kami di +6281213141516 atau email admin@ifca.co.id .<br><br>'    ; 
                      $email .= '</div> '    ;   
                      $email .= '<p>Terima Kasih</p> '    ; 
                      $email .= '<br><br>  '    ; 
                      $email .= '</body>'    ; 
                      $email .= '</html>' ;

    return $email;

  }

  function TesSendMail(){
        $msg = ' ';
        $psn = ' ';
        if ($_POST) {
            $to = $this->input->post('to', TRUE);
            $subject = 'Tes EMAIL BRO';
            $cc = $this->input->post('cc', TRUE);
            $bcc = $this->input->post('bcc', TRUE);
            $message = $this->EmailFormat($to);
            $attachment = $this->input->post('attachment', TRUE);

            // $to = 'fauzia.filardi@ifca.co.id';
            // $subject = 'Forget Password';
            // $message = 'Congrat,'."\n\n";
            // $message.= 'Please review and approve new booking unit: Cs Name: ,'."\n\n";
            // $message.= 'Thank you,';

            // $mail = $this->_sendmail($to, $cc, $bcc, $subject, $message, $attachment);
            $mail = $this->_sendmail($to, $subject, $message, $attachment);

            $msg="Email sent";
            $psn ="Success";


        }else{
            $msg="Email Failed";
            $psn ="Error";
        }


        $msg1 = array(
            'Pesan' => $msg,
            'status' =>$psn
        );
    echo  json_encode($msg1);
  }

    
}