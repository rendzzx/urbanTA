<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Module extends Core_Controller{
	public function __construct(){
        parent::__construct();
        $this->auth_check();
    }
    // ========================================  MODULE
        public function index(){
            $name = $this->session->userdata('Tsuname');
            $admin = $this->session->userdata('Tsysadmin');

        	$this->load_content_top_menu('module/index');
        }

        public function getTable(){

            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }

            $this->load->library('Datatables');
            $DB2 = $this->load->database('IFCA', TRUE);
            $table = 'sysmodule';

            $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table);
            if ($res) {
                $callback = $res;
            }
            echo json_encode($callback);
        }

        public function addnew($id=""){
            $sql = "SELECT * FROM sysGroup order by group_descs asc";
            $group = $this->M_wsbangun->getData_by_query('IFCA', $sql);
            $content = array('group' => $group);
            $this->load->view('module/add',$content);
        }

        public function getByID($rowID=''){
            $where=array('rowID'=>$rowID);
            $data = $this->M_wsbangun->getData_by_criteria('IFCA', 'sysmodule',$where);
            echo json_encode($data);
        }

        public function save(){
            $callback = array(
                'Data' => null,
                'Message' => null,
                'Error' => false
            );

            if ($_POST){
                $rowID = $this->input->post('rowID', true);
                $module_cd = $this->input->post('module_cd',TRUE);
                $module_descs =$this->input->post('module_descs',TRUE);
                $module_group_cd =$this->input->post('group',TRUE);
                $dashboard_url = $this->input->post('dashboard',TRUE);
                $iconclass = $this->input->post('iconclass',TRUE);
                $buttonclass = $this->input->post('buttonclass',TRUE);
                $orderseq = $this->input->post('orderseq',TRUE);
                $status = intval($this->input->post('status',TRUE));

                if(empty($rowID)){
                    $rowID = 0;
                }
                
                $data = array(   
                    'module_cd' => $module_cd,
                    'module_descs' => $module_descs,
                    'module_group_cd' => $module_group_cd,
                    'module_descs' => $module_descs,
                    'dashboard_url' => $dashboard_url,
                    'IconClass' => $iconclass,
                    'ButtonClass' => $buttonclass,
                    'OrderSeq' => $orderseq,
                    'status' => $status,
                );
                $criteria = array('rowID' => $rowID);

                if($rowID>0) {
                    $data = $this->M_wsbangun->updateData('IFCA', 'sysmodule',$data, $criteria);
                    if($data){
                        $callback['Message'] ="Data has been updated successfully";
                    }
                    else{
                        $callback['Message'] = $data;
                        $callback['Error'] = true;
                    }
                } 
                else {
                    $data = $this->M_wsbangun->insertData('IFCA', 'sysmodule',$data);
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
                $where = array('rowID'=>$id);

                $del = $this->M_wsbangun->deleteData('IFCA', 'sysmodule', $where);
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
    // ========================================  MODULE

    // ========================================  ASSIGN MODULE
        public function assign(){
            $name = $this->session->userdata('Tsuname');
            $admin = $this->session->userdata('Tsysadmin');

            $this->load_content_top_menu('module/index_assign');
        }

        public function getTableGroup(){

            $sSearch = $this->input->post("sSearch",true);
            if(empty($sSearch)){
                $sSearch='';
            }

            $this->load->library('Datatables');
            $DB2 = $this->load->database('IFCA', TRUE);
            $table = 'sysGroup';

            $res = $this->M_wsbangun->getData_by_criteria('IFCA', $table);
            if ($res) {
                $callback = $res;
            }
            echo json_encode($callback);
        }

        public function assignuser(){
            $name = $this->session->userdata('Tsuname');
            $admin = $this->session->userdata('Tsysadmin');
            $sql = "SELECT distinct rowID,module_cd,module_descs,OrderSeq FROM sysModule (nolock) order by OrderSeq asc";
            $module = $this->M_wsbangun->getData_by_query('IFCA',$sql);
            $content = array('module' => $module);
            
            $this->load->view('module/assign',$content);
        }

        public function getByModuleGroup($group_cd=''){
            $cons   = $this->session->userdata('Tscons');
            $table  = 'v_sysModuleUser';

            $where=array('group_cd'=>$group_cd);
            $data = $this->M_wsbangun->getData_by_criteria('IFCA',$table,$where);

            echo json_encode($data);
        }

        public function save_assign(){
            $callback = array(
                'Data'   => null,
                'Message'  => null,
                'Error'  => false
            );

            $cons       = $this->session->userdata('Tscons');

            if($_POST){
                $module     = $this->input->post('module',TRUE);
                $group_cd   = $this->input->post('group_cd',TRUE);
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                $where = array(
                    'group_cd' => $group_cd
                );
                
                $delete = $this->M_wsbangun->deleteData('IFCA','sysModuleUser',$where);
                if($delete){
                    if(!empty($module)||count($module)>0){
                        foreach ($module as $key) {
                            $datauserpro = array( 
                                'group_cd' => $group_cd,
                                'moduleID'=>$key,
                                'audit_date'=> $audit_date,
                                'audit_user'=> $audit_user
                            );

                            $insert = $this->M_wsbangun->insertData('IFCA','sysModuleUser',$datauserpro);
                            if($insert){
                                $callback['Error'] = false;
                                $callback['Message'] = 'Data saved successfully';
                            }
                            else{
                                $callback['Error'] = true;
                                $callback['Message'] = 'Fail inserting sysModuleUser ('.$key.') '.$insert;
                            }
                        }
                    }

                    $callback['Error'] = false;
                    $callback['Message'] = 'Data saved successfully';
                }
                else{
                    $callback['Error'] = true;
                    $callback['Message'] = 'Fail deleting sysModuleUser';
                }
            }
            else{
                $callback['Error'] = true;
                $callback['Message'] = 'Data validation is not valid 2';
            }
            echo json_encode($callback);
        }
    // ========================================  ASSIGN MODULE
}