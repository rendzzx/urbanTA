<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_overtime_all extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');

    }

    public function index()
    {   
        $cons       = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');

        $sql = "SELECT count(*) AS cnt
        FROM mgr.ot_trx 
        
        WHERE mgr.ot_trx.entity_cd = '$entity' 
        and   mgr.ot_trx.project_no  = '$project'";

        $sqlopen        = $sql."AND mgr.ot_trx.approved  = 'N'";
        $sqlclose      = $sql."AND mgr.ot_trx.approved  = 'Y'";
     

        $open = $this->m_wsbangun->getData_by_query_cons('ifca3',$sqlopen);
        $close  = $this->m_wsbangun->getData_by_query_cons('ifca3',$sqlclose);

        $content = array(
            'open' => $open,
            'close' => $close,
        );

        $this->load_content_top_menu('overtime/index_all',$content);
    }

    public function getfilter(){
        $cons       = $this->session->userdata('Tscons');
        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');

        $CI =& get_instance();
        $CI->load->database('ifca3');
        $db_adm = $CI->db->database;

        // $sql = "SELECT count(*) AS cnt
        // FROM ".$db_adm.".mgr.ot_trx (nolock)
        // inner join mgr.ar_debtor (nolock)
        // on  ".$db_adm.".mgr.ot_trx.entity_cd  = mgr.ar_debtor.entity_cd
        // and ".$db_adm.".mgr.ot_trx.project_no = mgr.ar_debtor.project_no 
        // and ".$db_adm.".mgr.ot_trx.debtor_acct = mgr.ar_debtor.debtor_acct
        // WHERE ";
        // $sqlopen        = $sql."".$db_adm.".mgr.ot_trx.status  = 'N'";
        // $sqlapproved    = $sql."".$db_adm.".mgr.ot_trx.status  = 'P'";
        // $sqlposting      = $sql."".$db_adm.".mgr.ot_trx.status_posting  = 'Y'";
        $sql = "SELECT count(*) AS cnt FROM mgr.v_ot_trx_all WHERE  entity_cd='$entity' and project_no='$project' and";
        $sqlopen        = $sql." approved  = 'N'";
        $sqlapproved    = $sql." approved  = 'Y'";
        $sqlposted      = $sql." status_posting  = 'P'";
        $sqlunposted      = $sql." status_posting  = 'N'";


        $open = $this->m_wsbangun->getData_by_query_cons('ifca3',$sqlopen);
        $approved = $this->m_wsbangun->getData_by_query_cons('ifca3',$sqlapproved);
        $posted = $this->m_wsbangun->getData_by_query_cons('ifca3',$sqlposted);
        $unposted = $this->m_wsbangun->getData_by_query_cons('ifca3',$sqlunposted);
        $data = array(
            'open'=>$open,
            'approved'=>$approved,
            'posted'=>$posted,
            'unposted'=>$unposted
        );

        echo json_encode($data);
    }

    public function gettable(){

        $callback = array(
            'data' => null,
            'Error' => false,
            'Pesan' => '',
            'Status'=> 200
        );

        $entity     = $this->session->userdata('Tsentity');
        $project    = $this->session->userdata('Tsproject');
        $email      = $this->session->userdata('Tsemail');
        $cons       = $this->session->userdata('Tscons');
        $CI =& get_instance();
        $CI->load->database('ifca3');
        $db_adm = $CI->db->database;
        // $sql = "SELECT ".$db_adm.".mgr.ot_trx.ot_id ,           
        // ".$db_adm.".mgr.ot_trx.debtor_acct , 
        // ".$db_adm.".mgr.ot_trx.lot_no ,            
        // mgr.ar_debtor.name ,           
        // ".$db_adm.".mgr.ot_trx.start_overtime ,    
        // ".$db_adm.".mgr.ot_trx.end_overtime ,         
        // ".$db_adm.".mgr.ot_trx.description , 
        // ".$db_adm.".mgr.ot_trx.status ,
        // ".$db_adm.".mgr.ot_trx.descs_level,
        // ".$db_adm.".mgr.ot_trx.status_posting
        // FROM ".$db_adm.".mgr.ot_trx (nolock)
        // inner join mgr.ar_debtor (nolock)
        // on  ".$db_adm.".mgr.ot_trx.entity_cd  = mgr.ar_debtor.entity_cd
        // and ".$db_adm.".mgr.ot_trx.project_no = mgr.ar_debtor.project_no 
        // and ".$db_adm.".mgr.ot_trx.debtor_acct = mgr.ar_debtor.debtor_acct 
       
        // order by CAST(".$db_adm.".mgr.ot_trx.start_overtime AS datetime) desc";
        $sql = "SELECT * from mgr.v_ot_trx_all where  entity_cd='$entity' and project_no='$project' order by CAST (start_overtime AS datetime) desc";
        $data = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

        if (!empty($data)) {
            $callback['data'] = $data;
            }

        else{
            $callback['Error'] = true;
            $callback['data'] = $data;
        }

        echo json_encode($callback, JSON_PRETTY_PRINT);
    }

   

}