<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_menu extends Core_Controller
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
        
        $table = 'sysMenu';
        $DataMenu = $this->m_wsbangun->getDataadm($table);        
        // var_dump($_SERVER['HTTP_HOST']);
        // var_dump($_SERVER['REMOTE_PORT']);exit();
        $content = array('leftdyn'=>$name,
            'sys'=>$admin,
            'approver'=>0,
            'project'=>$DataMenu);
        
    	$this->load_content_top_menu('menu/index',$content);
    }

      public function zoom_parentid(){  
//         $table = 'sysMenu(nolock)';
//         $object = array('MenuID', 'Title'); 
//         $comboParentID = $this->m_wsbangun->getCombo($table, $object);


      }

      //set combo when edit
      public function zoom_parentid_from(){
        $ent = $this->input->post('MenuID',TRUE);
        // var_dump($ent);
        $table = 'sysMenu';
        $parentID = $this->m_wsbangun->getDataadm($table);


        // var_dump($entityName);
            if(!empty($parentID)) {
                $comboParent[] = '<option></option>';
                foreach ($parentID as $dtParent) {
                  if($ent == $dtParent->MenuID) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboParent[] = '<option '.$pilih.' value="'.$dtParent->MenuID.'">'.$dtParent->Title.'</option>';
                }
                $comboParent = implode("", $comboParent);
            }
            echo $comboParent;
      }

      
    public function test(){
        $this->load_content('nup_parameter/test');
    }

    public function addnew($id=""){
        
        $table = 'sysMenu';
        $where = array('ParentMenuID' => 0 );
        $MenuData = $this->m_wsbangun->getData_by_criteria_adm($table,$where);   
       
        $content = array('menuData'=>$MenuData);

        // $this->load->view('menu/add', $content);
        $this->load->view('menu/add', $content);

    }
    public function getByID($MenuID=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('MenuID'=>$MenuID);
        $data = $this->m_wsbangun->getData_by_criteria_adm('sysMenu',$where);

        echo json_encode($data);

    }
    public function Delete(){
        $MenuID = $this->input->post("MenuID",true);
        if(empty($MenuID)){
            $MenuID=0;
        }
        $where=array('MenuID'=>$MenuID);
        $data = $this->m_wsbangun->deletedataweb('sysMenu',$where);
        $msg = "Data has been deleted successfully";
        $msg1=array("Pesan"=>$msg);
        echo json_encode($msg1);
    }
    public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca3', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'MenuID','Title', 'URL', 'ParentMenuID', 'IconClass');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_sysMenu';

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
        $SordField = ($sortIdColumn==0? 'MenuID' :$Column[$sortIdColumn]['name']);

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
        $param = " where MenuID > 0 ".$filter_search;
        // var_dump($param);

        $rResult = $this->m_wsbangun->getlisttableadm($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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
        // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
        // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);
        // if ($pri->can_edit == '1') {

            $newsfeeds = $this->m_newsfeed->get_by_id($newsfeed_id);
            $list_newsfeeds = '';
            // foreach ($newsfeeds as $newsfeed) {
            //     $list_newsfeeds .= '<option value="'
            //     1">Information</option>
            //             <option value="2">Warning</option>
            // }
            $statusnya = array('','Information','Warning');
            for($i=1;$i<=2;$i++){
                if($i==$newsfeeds->status){
                    $list_newsfeeds .= '<option selected="selected" value="'.$newsfeeds->status. '">'.$statusnya[$newsfeeds->status]. '</option>'."\n";
                } else {
                    $list_newsfeeds .= '<option value="'.$newsfeeds->status. '">'.$statusnya[$i]. '</option>'."\n";
                }
                
            }
            
            $content = array(
                'newsfeeds' => $newsfeeds,
                'list_newsfeeds'=>$list_newsfeeds,
                'error' => $data
            );
            $this->load_content('c_newsfeed/edit', $content);

        // } else {
            // $content['url'] = base_url() . "newsfeed";
            // $this->load_content('error', $content);
        // }

    //     } else {
    //         $content['url'] = base_url() . "newsfeed";
    //         $this->load_content('error', $content);
    //     }

    }
    public function new_newsfeed($data=null)
    {
        $content = array(
                'error' => $data
            );

       // $this->load_content('newsfeed/add',$content);
        $this->load->view('newsfeed/add',$content);
        // $user = $this->m_users->get_by_uname($this->session->userdata('uname'));
        // $pri = $this->m_privileges->get_by_id($user->group_id, $this->m_privileges->get_by_title("newsfeedS")->module_id);

        // if ($pri->can_add == '1')
            
        // else {
        //     $content['url'] = base_url() . "newsfeed";
        //     $this->load_content('error', $content);
        // }
    }
    public function save_menu(){
        
            $msg="";
            if ($_POST) 
            {
                $menu_id = $this->input->post('txtMenuID', true);
                // var_dump($nup_id);
                $title = $this->input->post('txtTitle',TRUE);
                $url =$this->input->post('txtURL',TRUE);
                $parent_id = $this->input->post('txtParentID',TRUE);                
                $icon_class = $this->input->post('txtIconClass',TRUE);
                $order_seq = $this->input->post('txtOrderSeq',TRUE);
                // $status = intval($this->input->post('status',TRUE));
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                if(empty($parent_id)){
                    $parent_id = 0;
                }
                
                        $data = array(          
                        // 'nup_id' => $nup_id,
                        'title' => $title,
                        'URL' => $url,
                        'ParentMenuID' =>$parent_id,
                        'IconClass' =>$icon_class,                        
                        'OrderSeq'=>$order_seq,
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );
                    

                    $criteria = array('MenuID' => $menu_id);
                    // var_dump($criteria);
                    if($menu_id>0) {
                        $data = $this->m_wsbangun->updateDataweb('sysMenu',$data, $criteria);
                        // var_dump($data);exit();
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been updated successfully";
                            $st = 'OK';
                        }
                        
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("ADD newsfeed")));
                    } else {
                        $data = $this->m_wsbangun->insertDataweb('sysMenu',$data);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been saved successfully";
                            $st = 'OK';
                        }
                        
                        
                     //   $this->m_user_log->insert(add_user_log("newsfeed Name " . $newsfeed_name, $this->m_users->get_by_uname($this->session->userdata('uname')), $this->m_activities->get_by_title("EDIT newsfeed")));
                    }

                    // redirect("c_newsfeed");
                // } // tutup if validation
            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);

        // redirect("C_nup_parameter/index");
    }
}