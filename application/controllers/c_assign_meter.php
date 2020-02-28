<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class c_assign_meter extends Core_Controller
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
        $project = $this->session->userdata('Tsproject');
        $content = array(
            'project-no'    => $project,
            'entity_cd'     => $entity
        );
        
        $this->load_content_top_menu('assign_meter/index',$content);
    }
    public function edit(){
        
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // $table = 'sysMenu';
        // $where = array('ParentMenuID' => 0 );
        // $MenuData = $this->m_wsbangun->getData_by_criteria_adm($table,$where);   
       
        // $content = array('menuData'=>$MenuData);

        // // $this->load->view('menu/add', $content);
        $sql = "SELECT DISTINCT lot_no,descs FROM mgr.pm_lot(nolock) WHERE entity_cd ='".$entity."' AND project_no = '".$project."'";

        $lot = $this->m_wsbangun->getData_by_query_cons('ifca',$sql);

        $combo_lot[] = '<option value=""></option>';
        if(!empty($lot)) {
            $combo_lot[] = '<option></option>';
            foreach ($lot as $key) {
                $combo_lot[] = '<option  value="'.$key->lot_no.'" >'.$key->descs.'</option>';
            }
            $combo_lot = implode("", $combo_lot);
        }

        $sql1 = "SELECT DISTINCT debtor_acct,name FROM mgr.ar_debtor(nolock) WHERE entity_cd ='".$entity."' AND project_no = '".$project."'";        
        
        $debtor = $this->m_wsbangun->getData_by_query_cons('ifca',$sql1);
        // var_dump($debtor);exit;

        $combo_debtor[] = '<option value=""></option>';
        if(!empty($debtor)) {
            $combo_debtor[] = '<option></option>';
            foreach ($debtor as $key) {
                $combo_debtor[] = '<option  value="'.$key->debtor_acct.'" >'.$key->name.'</option>';
            }
            $combo_debtor = implode("", $combo_debtor);
        }
        $content = array(
            'lot'       => $combo_lot,
            'debtor'    => $combo_debtor
        );
        $this->load->view('assign_meter/edit',$content);
    }
    public function getByID($meter_cd="",$meter_id="",$line_no=""){
        // if(empty($id)){
        //     $id=''
        // }
        $object       = 'v_lot_meter';
        $cons         = $this->session->userdata('Tscons');
        $project    = $this->session->userdata('Tsproject');
        $entity     = $this->session->userdata('Tsentity');

        // $project    = '19-ALS-01';
        // $entity     = 'ALS';

        $where=array(
            'meter_cd'      => $meter_cd,
            'meter_id'      => $meter_id,
            'line_no'       => $line_no,
            'entity_cd'     => $entity,
            'project_no'    => $project
        );
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$object,$where);
        // var_dump($data);exit;
        echo json_encode($data);
    }
    public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        
        $entity = $this->session->userdata('Tsentity');

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);
        $cons = 'ifca';

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'meter_cd','descs', 'meter_id', 'lot_no', 'debtor_acct', 'apportion', 'capacity', 'capacity_limit', 'line_no', 'rowID');

        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_lot_meter';
        // $sTable = 'mgr.pm_meter';

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
        $SordField = ($sortIdColumn==0? 'entity_cd' :$Column[$sortIdColumn]['name']);

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
        // 
        // var_dump($filter_search);
        $param = " WHERE project_no = '".$project."' AND entity_cd = '".$entity."' ".$filter_search;
        // var_dump($param);exit;

        $rResult = $this->m_wsbangun->getlisttableadm_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
        // var_dump($rResult);exit; 

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
    public function save(){
        $msg="";
        if (isset($_POST)) {
            $project_no         = $this->session->userdata('Tsproject');
            $entity_cd          = $this->session->userdata('Tsentity');
            // var_dump($category_cd);exit;
            
            $meter_cd           = $this->input->post('meter_cd');
            $descs              = $this->input->post('descs');
            $meter_id           = $this->input->post('meter_id');
            $lot_no             = $this->input->post('lot_no');
            $debtor_acct        = $this->input->post('debtor_acct');
            $apportion          = $this->input->post('apportion');

            $parts = explode('.', (int) $apportion);
            $apportion = $parts[0];

            $capacity           = $this->input->post('capacity');

            $parts = explode('.', (int) $capacity);
            $capacity = $parts[0];

            $capacity_limit     = $this->input->post('capacity_limit');

            $parts = explode('.', (int) $capacity_limit);
            $capacity_limit = $parts[0];

            $line_no            = (int)$this->input->post('line_no');
            $rowID              = (int)$this->input->post('rowID');

            $audit_user = $this->session->userdata('Tsname');
            $audit_date = date('d M Y H:i:s');

            $criteria = array(
                'rowID'     => $rowID,
            );

            // if ($rowID>0) {
                $data = array(
                    // 'entity_cd'             => $entity_cd,
                    // 'project_no'            => $project_no,
                    // 'category_cd'           => $category_cd,

                    'meter_cd'          => $meter_cd,
                    // 'descs'             => $descs,
                    'meter_id'          => $meter_id,
                    'lot_no'            => $lot_no,
                    'debtor_acct'       => $debtor_acct,
                    'apportion'         => $apportion,
                    'capacity'          => $capacity,
                    'capacity_limit'    => $capacity_limit,

                    'audit_user'        => $audit_user,
                    'audit_date'        => $audit_date
                );
                // var_dump($data);
                $update = $this->m_wsbangun->updateData_cons('ifca','pm_lot_meter',$data, $criteria);
                // var_dump($update);exit;
                if($update == 'OK')
                {
                    $msg="Data has been updated successfully";
                    $psn = true;
                } else {
                    $msg= $update;
                    $psn = false;
                }
            // }

        } else {
            $msg="Data validation is not valid";
        }
        
        $msg1=array(
            "Pesan"=>$msg,
            "status"=>$psn
        );
        // var_dump($data);
        echo json_encode($msg1);
    }
}