<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Plocation extends Core_Controller
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
        $entity = $this->session->userdata('Tsentity');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $cons = $this->session->userdata('Tscons');
        
        
        $table = 'rl_project_gallery';
        $DataMenu = $this->m_wsbangun->getData_cons($cons,$table);        
        // var_dump($_SERVER['HTTP_HOST']);
        // var_dump($_SERVER['REMOTE_PORT']);exit();
        // var_dump($DataMenu); exit();
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu);
        

        $this->load_content_top_menu('gallery/index',$content);
    }


    public function add(){
        $entity = $this->session->userdata('Tsentity');
        $cons = $this->session->userdata('Tscons');
        
        $table = 'rl_project_gallery';
        $amenities = $this->m_wsbangun->getData_cons($cons,$table);   
       
        $content = array(
            'amenities'=>$amenities,
        );

        $this->load->view('gallery/add',$content);

    }

    public function getByID(){
        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $table = 'pl_project';
        $criteria = array(
                'entity_cd' => $entity,
                'project_no' => $project
            );
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$criteria);
        echo json_encode($data);

    }
    
    public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        
        $cons = $this->session->userdata('Tscons');
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number','line_no','gallery_title');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.rl_project_gallery';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $sEcho = $this->input->get_post('sEcho', true);
    
        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'line_no' :$Column[$sortIdColumn]['name']);

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
        // var_dump($filter_search);
        $param = " where rowID > 0 ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttable_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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

    public function upload(){
        var_dump($_POST);exit();
    }


    public function save_location(){
        $msg="";
        // var_dump($_POST);exit();
        if($_POST){

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');
            // var_dump($entity);
            // var_dump($project);
            $id  = $this->input->post('idlocation',TRUE);
            $coordinatname  =$this->input->post('coordinatname',TRUE);
            $wa_no  = $this->input->post('wa_no',TRUE);
            $coordinatproject  =$this->input->post('coordinatproject',TRUE );
            $coordinataddress  =$this->input->post('coordinataddress',TRUE );
            $email  =$this->input->post('email',TRUE);
            $audit_date = date('d M Y H:i:s');
            $audit_user = $this->session->userdata('Tsuname');
            $facebook_url  = $this->input->post('facebook_url',TRUE);
            $youtube_url  = $this->input->post('youtube_url',TRUE);
            $instagram_url  = $this->input->post('instagram_url',TRUE);
            $web_url  = $this->input->post('web_url',TRUE);
            $contact_telno  = $this->input->post('contact_telno',TRUE);

            // var_dump($id);
            // exit();

            $table = 'pl_project';

            $criteria = array(
                'entity_cd' => $entity,
                'project_no' => $project
            );

                $data = array(
                'audit_user'=>$audit_user,
                'audit_date'=>$audit_date,
                'wa_no'=>$wa_no,
                'coordinat_name' => $coordinatname,
                'coordinat_project' => $coordinatproject,
                'coordinat_address' => $coordinataddress,
                'email_add' => $email,
                'facebook_url' => $facebook_url,
                'youtube_url' => $youtube_url,
                'instagram_url' => $instagram_url,
                'web_url' => $web_url,
                'contact_telno' => $contact_telno
                );
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$criteria);
                    if($update == 'OK')
                    {
                        $msg="Data has been updated successfully";
                        $psn = "OK";
                    } else {
                        $msg= $update;
                        $psn = "Failed";
                    }
            }
                 else {
            $msg="Data validation is not valid";
        }
            
        $msg1=array("Pesan"=>$msg,
                "status"=>$psn);

        echo json_encode($msg1);
    }

    public function Delete(){
        $cons = $this->session->userdata('Tscons');
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('rowID'=>$id);
        $data = $this->m_wsbangun->deletedata_cons($cons,'rl_project_gallery',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
}