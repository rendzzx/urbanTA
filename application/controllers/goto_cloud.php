<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
class goto_cloud extends Core_Controller
{

    function __construct()
    {
        parent::__construct();
        
        
    }
  
    public function index()
    {
       $sql ="select Link from syslocation where Descs='Login' ";
       $Link = $this->M_wsbangun->getData_by_query_cloud($sql);
       $Link = $Link[0]->Link;
       // var_dump($Link);exit();
       $content = array('go_cloud'=>$Link);

            $this->load->view('login/index_cloud',$content); 
        
    }   



}