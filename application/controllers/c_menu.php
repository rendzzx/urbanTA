<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_menu extends Core_Controller{
	public function __construct(){
        parent::__construct();
        $this->auth_check();
    }

    // ========================================  MENU
        public function index(){
            $entity = $this->session->userdata('Tsentity');
            $name = $this->session->userdata('Tsuname');
            $admin = $this->session->userdata('Tsysadmin');
            
            $table = 'sysMenu';
            $DataMenu = $this->M_wsbangun->getData('IFCA', $table);

            $content = array(
                'leftdyn'=>$name,
                'sys'=>$admin,
                'approver'=>0,
                'project'=>$DataMenu
            );
            
        	$this->load_content_top_menu('menu/index',$content);
        }

        public function getTable(){
            $project = $this->session->userdata('Tsproject');        

            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }

            $entity = $this->session->userdata('Tsentity');
            $this->load->library('Datatables');
            $DB2 = $this->load->database('IFCA', TRUE);
            $table = 'v_sysmenu';

            $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table);
            if ($res) {
                $callback = $res;
            }
            echo json_encode($callback);
        }

        public function addnew($id=""){
            $table = 'sysMenu';
            $where = array('ParentMenuID' => 0 );
            $MenuData = $this->M_wsbangun->getData_by_criteria('IFCA', $table, $where);   
            $content = array(
                'menuData' => $MenuData
            );
            $this->load->view('menu/add', $content);
        }

        public function getByID($MenuID=''){
            $where=array('MenuID'=>$MenuID);
            $data = $this->M_wsbangun->getData_by_criteria('IFCA', 'sysMenu',$where);
            echo json_encode($data);
        }

        public function save(){
            $callback = array(
                'Data' => null,
                'Message' => null,
                'Error' => false
            );
        
            if ($_POST) {
                $menu_id = $this->input->post('txtMenuID', true);
                $title = $this->input->post('txtTitle',TRUE);
                $descs = $this->input->post('txtDescs',TRUE);
                $url =$this->input->post('txtURL',TRUE);
                $parent_id = $this->input->post('txtParentID',TRUE);                
                $icon_class = $this->input->post('txtIconClass',TRUE);
                $order_seq = $this->input->post('txtOrderSeq',TRUE);
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsname');

                if(empty($parent_id)){
                    $parent_id = 0;
                }
                    
                $data = array(
                    'title' => $title,
                    'descs' => $descs,
                    'URL' => $url,
                    'ParentMenuID' =>$parent_id,
                    'IconClass' =>$icon_class,                        
                    'OrderSeq'=>$order_seq,
                    'audit_user'=>$audit_user,
                    'audit_date'=>$audit_date
                );
                $criteria = array('MenuID' => $menu_id);

                if($menu_id>0) {
                    $data = $this->M_wsbangun->updateData('IFCA', 'sysMenu',$data, $criteria);
                    if($data){
                        $callback['Message'] ="Data has been updated successfully";
                    }
                    else{
                        $callback['Message'] = $data;
                        $callback['Error'] = true;
                    }
                }
                else{
                    $data = $this->M_wsbangun->insertData('IFCA', 'sysMenu',$data);
                    if($data){
                        $callback['Message'] = "Data has been saved successfully";
                    }
                    else{
                        $callback['Message'] = $data;
                        $callback['Error'] = true;
                    }
                }
            } //tutup post
            else{
                $callback['Error'] = true;
                $callback['Message'] = "Data validation is not valid";
            }
                
            echo json_encode($callback);
        }

        public function delete(){
            $callback = array(
                'Data' => null,
                'Message' => null,
                'Error' => false
            );

            if ($_POST) {
                $id = $this->input->post("id",true);
                $where = array('MenuID'=>$id);

                $del = $this->M_wsbangun->deleteData('IFCA', 'sysMenu', $where);
                if ($del) {
                    $callback['Message'] = "Data has been deleted successfully";
                }
                else {
                    $callback['Message'] = $del;
                    $callback['Error'] = true;
                }
            }
            echo json_encode($callback);
        }
    // ========================================  MENU

    // ========================================  ASSIGN MENU
        public function assign(){
            $sql = "SELECT distinct group_cd,group_descs from sysGroup(nolock)";        
            $dtComplain = $this->M_wsbangun->getData_by_query('IFCA',$sql);

            if(!empty($dtComplain)) {
                $comboGroup[] = '<option></option>';
                foreach ($dtComplain as $key) {
                    $comboGroup[] = '<option  value="'.$key->group_cd.'" >'.$key->group_descs.'</option>';
                }
                $comboGroup = implode("", $comboGroup);
            }

            $content = array(
                'cmbGroup'=>$comboGroup
            );
            $this->load_content_top_menu('menu/assignmenu', $content);
        }

        public function getTableAssign(){
            $project = $this->session->userdata('Tsproject');        

            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }

            $entity = $this->session->userdata('Tsentity');
            $this->load->library('Datatables');
            $DB2 = $this->load->database('IFCA', TRUE);
            $table = 'sysmenu';

            $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table);
            if ($res) {
                $callback = $res;
            }
            echo json_encode($callback);
        }

        public function getList(){
            if($_POST){
                $gid = $this->input->post('gid', true);
                $table = 'v_SysMenuGroup';
                $crit = array('groupCd'=>$gid);
                $dtA = $this->M_wsbangun->getData_by_criteria('IFCA', $table, $crit);
            }
            echo json_encode($dtA);
            return;
        }

        public function saveAssign(){
            $callback = array(
                'Data'   => null,
                'Error'  => false,
                'Message'=> null
            );

            if($_POST){
                $models = $this->input->post('models');
                $today = date('d M Y H:i:s');
                $name = $this->session->userdata('Tsname');
                $group = $this->input->post('gid');
                if(!empty($models)){
                    $gID = $models[0]['GroupCd'];
                    $table = 'sysMenuGroup';

                    $crit = array('groupCd'=>$gID);
                    $this->M_wsbangun->deleteData('IFCA', $table, $crit);

                    foreach ($models as $dt) {
                        $dtL = array(
                            'audit_user' => $name,
                            'audit_date' => $today
                        );
                        $dt = array_merge($dt, $dtL);    
                        $insert = $this->M_wsbangun->insertData('IFCA', $table, $dt);
                        if ($insert) {
                            $callback['Message'] = "Data has been insert successfully";
                        }
                        else{
                            $callback['Error'] = true;
                            $callback['Message'] = $insert;
                        }
                    }
                }
            }
            else{
                $callback['Error'] = true;
                $callback['Message'] = 'No menu Assigned';
            }
            echo json_encode($callback);
        }
    // ========================================  ASSIGN MENU
}