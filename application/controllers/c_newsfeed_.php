<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Newsfeed extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_newsfeed');
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');

    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $entityname = $this->session->userdata('Tsentityname');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $approver = 0;
        $where=array('entity_cd'=>$entity);
        $data_project = $this->m_newsfeed->get_table_by_id("mgr.pl_project",$where);                
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$data_project,
            'entityname'=>$entityname);
        
    	$this->load_content('newsfeed/NewIndex',$content);
    }
    public function addnew($project_no=''){
        // $content = array('error'=>'');
        // $entity = $this->session->userdata('Tsentity');
        // $where=array('entity_cd'=>$entity);
        // $data_project = $this->m_newsfeed->get_table_by_id("mgr.pl_project",$where);  
        // var_dump($project_no);
        $data=array('project_no'=>$project_no);
        $this->load->view('newsfeed/add',$data);
    }
    public function zoom_project(){
        $data_id = $this->m_newsfeed->get_table_by_id("mgr.pl_project");
        return $data_id;
    }
    public function getByID($id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('id'=>$id);
        $data = $this->m_wsbangun->getData_by_criteria('newsfeed',$where);

        echo json_encode($data);

    }
    public function Delete(){
        $id = $this->input->post("id",true);
        if(empty($id)){
            $id=0;
        }
        $where=array('id'=>$id);
        $data = $this->m_wsbangun->deletedata('newsfeed',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);

    }
    public function getTable()
    {
        $aProject = $this->input->post("pl_project",true);
        if(empty($aProject)){
            $aProject='';
        }
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        // var_dump($aProject);
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','id', 'subject', 'content','status');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.newsfeed';

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
        $SordField = ($sortIdColumn==0? 'id' :$Column[$sortIdColumn]['name']);

     
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

        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        $param =" Where entity_cd='".$entity."' AND project_no= '".$aProject."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
     public function edit_newsfeed($newsfeed_id = "", $data=null)
    {
        

    }
    public function new_newsfeed($data=null)
    {
        
    }
public function save_newsfeed()
    {
        // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
        // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);

        // if ($pri->can_edit == '1' || $pri->can_add == '1') {
        
            $msg="";
            if ($_POST) 
            {
                $id = (int)$this->input->post('id',TRUE);
                $subject = $this->input->post('subject',TRUE);
                $content = $this->input->post('content');
                $status = $this->input->post('status',TRUE);
                $youtube = $this->input->post('youtubelink',TRUE);
                $entity = $this->session->userdata('Tsentity');
                $project_no =$this->input->post('project_no',TRUE);
                $pict_name =$this->input->post('Picture',TRUE);
                $date_created  =$this->input->post('date_created',TRUE);
                $date_created = date($date_created);
                $date_created = DateTime::createFromFormat('d/m/Y H:i:s', $date_created.' 00:00:00');
                $date_created = $date_created->format('Y-d-m H:i:s');
                $pict_name = str_replace(' ', '_', $pict_name);
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');
                $isFile  =$this->input->post('isFile',TRUE);
                
                // var_dump(strlen($pict_name));
                $tes='';
                if($isFile=="true"){
                    // var_dump($isFile);
                $picture = $_FILES["file"];
                
                var_dump(strlen($picture));
                 // var_dump($picture["name"]);
                $picture = array_filter($picture);
                if (!empty($picture["name"])) {
                    $config['upload_path'] = './img/NewsFeed/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '500';
                    $config['max_width'] = '1024';
                    // $config['max_height'] = '768';
                    // var_dump($config['upload_path']);
                    $data['upload_data'] = '';
                    $this->load->library('upload', $config);
                 
                    if(!$this->upload->do_upload())
                    { 
                        $data = $this->upload->display_errors();
                        $tes='1==';
                        // if(empty($id)) {
                        //     $this->new_newsfeed($data);
                        // } else {
                        //     $this->edit_newsfeed($id,$data);
                        //     var_dump("expression");
                        // }
                        $msg=$data;
                        return;
                    } else {
                        $data = $this->upload->data();
                        $tes='2==';

                    }
                    // var_dump("111");
                } //else {
                    $tes.= 'zonk';
                //     $picname = $this->input->post('picname',TRUE);
                //     var_dump("222");
                // }
                }
                var_dump($tes);
                exit;

                // $this->form_validation->set_rules('subject', 'Subject newsfeed', 'required');
                // // $this->form_validation->set_rules('content', 'Content newsfeed', 'required');
                
                // $this->form_validation->set_message('required', '** %s harap diisi..');
                // $this->form_validation->set_message('is_unique', '** %s telah terdaftar..');
                // $this->form_validation->set_message('max_length', '** %s maksimal hanya 12 karakter..');
                // $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

                // if($this->form_validation->run() == FALSE) {
                //     if(empty($id)) {
                //         $data = validation_errors();
                //         // $this->new_newsfeed($data);
                //         $msg=$data;
                //         return;
                        
                //     } else {
                //         $data = validation_errors();
                //         // $this->edit_newsfeed($newsfeed_id,$data);
                //         $msg=$data;
                //         return;
                //     }
                    
                // } else {
                    if(strlen($pict_name) > 1) {
                        $data = array(
                        'subject' => $subject,
                        'content' => $content,
                        'status' =>$status,
                        'youtube_link' =>$youtube,
                        'picture' =>$pict_name,
                        'entity_cd'=>$entity,
                        'project_no'=>$project_no,
                        'date_created'=>$date_created,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                    );    
                    }else{
                        $data = array(          
                        'subject' => $subject,
                        'content' => $content,
                        'status' =>$status,
                        'youtube_link' =>$youtube,
                        'date_created'=>$date_created,
                        // 'picture' =>$pict_name,
                        'entity_cd'=>$entity,
                        'project_no'=>$project_no,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );
                    }
                    
                    $criteria = array('id' => $id);
                    // var_dump($data);
                    if($id>0) {
                        $this->m_wsbangun->updateData('newsfeed',$data, $criteria);
                        $msg="Data has been updated successfully";
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("ADD newsfeed")));
                    } else {
                        $this->m_wsbangun->insertData('newsfeed',$data);
                        $msg="Data has been saved successfully";
                        
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("EDIT newsfeed")));
                    }

                    // redirect("c_newsfeed");
                // } // tutup if validation
            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg);
            // var $result = new{
            //     Response = $msg;
            // };

        echo json_encode($msg1);
    }
}