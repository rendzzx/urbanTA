<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_Assignmenu extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function assign()
    {
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $groupCd = $this->session->userdata('Tsusergroup');
        // var_dump($groupCd);
        $entityname = $this->session->userdata('Tsentityname');
        // $table = 'security_users(nolock)';
        // $table = 'sysGroup(nolock)';
        // $where = array('user_type'=>1);
        $where = '';
        
        
        // $object = array('group_cd', 'group_descs');
        // $comboGroup = $this->m_wsbangun->getComboAdm($table, $object, $where);
        $sql = "SELECT distinct group_cd,group_descs from mgr.sysGroup(nolock)";        
        $dtComplain = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);

        $comboGroup[] = '<option value=""></option>';
            if(!empty($dtComplain)) {
                $comboGroup[] = '<option></option>';
                foreach ($dtComplain as $key) {
                    $comboGroup[] = '<option  value="'.$key->group_cd.'" >'.$key->group_descs.'</option>';
                }
                $comboGroup = implode("", $comboGroup);
            }

        $content = array('leftdyn'=>$name,
                'sys'=>$admin,
                'approver'=>0,
                'entityname'=>$entityname,
                'cmbGroup'=>$comboGroup
            );
        $this->load_content_top_menu('menu/assignmenu', $content);
    }

    public function getTable()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $group = $this->input->post('group', TRUE);
        $DB2 = $this->load->database('ifca3', TRUE);

        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        // var_dump($group);exit;

        $aColumns  = array('MenuID','Title');
        $sTable = 'mgr.sysmenu';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);

        $Search = $sSearch;
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? 'MenuID' :$Column[$sortIdColumn]['name']);

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


        // Select data
        $param =" Where rowID > 0 ".$filter_search;
        // $param = "";
        $rResult = $this->m_wsbangun->getListAssignAdm($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
        // $rResult = $this->m_wsbangun->getListAssign($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder);
        // Total data set length        
        // $sql="select count(*) as cnt from ".$sTable." ".$param;
        $sql = "select count(*) as cnt from ".$sTable;
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

    public function getList()
    {
        if($_POST)
        {
            $gid = $this->input->post('gid', true);
            $table = 'v_SysMenuGroup';
            $crit = array('groupCd'=>$gid);
            $dtA = $this->m_wsbangun->getData_by_criteria_adm($table, $crit);
            // if(!empty($dtA)){
            //     echo json_encode($dtA);
            //     return;
            // }
            // var_dump($dtA);
                
        }
        echo json_encode($dtA);
        return;
    }

    public function save()
    {
        $callback = array(
            'Data'   => null,
            'Error'  => false,
            'Pesan'  => '',
            'Status' => 200
        );

        if($_POST)
        {
            // var_dump($_POST);
            $models = $this->input->post('models');
            $today = date('d M Y H:i:s');
            $name = $this->session->userdata('Tsuname');
            $group = $this->input->post('gid');


            if(!empty($models))
            {
                $gID = $models[0]['GroupCd'];
                // var_dump($gID);
                // var_dump($gID['GroupCd']);
                // exit();
                $table = 'sysMenuGroup';
                $crit = array('groupCd'=>$gID);
                $this->m_wsbangun->deletedataweb($table, $crit);

                foreach ($models as $dt) {
                    $dtL = array(
                        'audit_user' => $name,
                        'audit_date' => $today
                    );
                    $dt = array_merge($dt, $dtL);
                    
                    $insert = $this->m_wsbangun->insertDataweb($table, $dt);

                    if ($insert == 'OK') {
                        $callback['Pesan'] = "Data has been insert successfully";
                    }
                    else{
                        $callback['Error'] = true;
                        $callback['Pesan'] = $insert;
                    }
                }
            }
        } else {
            $callback['Pesan'] = 'No menu Assigned';

        }

        echo json_encode($callback);
    }
}