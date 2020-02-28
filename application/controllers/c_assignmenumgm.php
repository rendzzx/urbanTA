<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_Assignmenumgm extends Core_Controller
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
    	$entityname = $this->session->userdata('Tsentityname');
    	$table = 'security_users(nolock)';
    	$where = array('user_type'=>1,'name'=>'MGM');
    	$object = array('name', 'description');
    	$comboGroup = $this->m_wsbangun->getCombo($table, $object, $where);

    	$content = array('leftdyn'=>$name,
                'sys'=>$admin,
                'approver'=>0,
                'entityname'=>$entityname,
                'cmbGroup'=>$comboGroup
            );
    	$this->load_content_top_menu('menu_mgm/assignmenu', $content);
    }

    public function getTable()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $group = $this->input->post('group', TRUE);
        $DB2 = $this->load->database('ifca', TRUE);

        $aColumns  = array('MenuID','Title');
        $sTable = 'mgr.sysMenuMGM';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        $iDisplayLength = ($iDisplayLength > 0) ? $iDisplayLength :10;
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        $sSearch = $this->input->get_post('search', true);
        $Search = $sSearch['value'];
        $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        $SordField = ($sortIdColumn==0? '[path]' :$Column[$sortIdColumn]['name']);

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
        $param =" Where GroupCd='$group' ".$filter_search;
        // $param = "";
        $rResult = $this->m_wsbangun->getListAssignMGM($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
        // $rResult = $this->m_wsbangun->getListAssign($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder);
        // Total data set length        
        // var_dump($rResult);
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
        // var_dump($rResult);
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
            $table = 'v_sysMenuMGMGroup';
            $crit = array('groupCd'=>$gid);
            $dtA = $this->m_wsbangun->getData_by_criteria($table, $crit);
   
                
        }
        echo json_encode($dtA);
        return;
    }

    public function save()
    {
        if($_POST)
        {
            // var_dump($_POST);
            $models = $this->input->post('models', true);
            $today = date('d M Y H:i:s');
            $name = $this->session->userdata('Tsuname');
            $group = $this->input->post('gid', true);

            if(!empty($models))
            {
                // var_dump($models);
                $gID = $models[0]['GroupCd'];
 
                $table = 'sysMenuGroupMGM';
                $crit = array('groupCd'=>$gID);
                $this->m_wsbangun->deletedataweb($table, $crit);

                foreach ($models as $dt) {
                    // var_dump($dt);
                    // $menuID = $dt->MenuID;
                    $dtL = array('audit_user'=>$name,
                        'audit_date'=>$today);
                    $dt = array_merge($dt, $dtL);
                    
                    // var_dump($dt);
                    
                    $this->m_wsbangun->insertDataweb($table, $dt);
                    $msg = 'Data has been saved successfully';
                }
            }
        } else {
            $msg = 'No menu Assigned';
   
        }
        $tes = array('Response'=>$msg);
        echo json_encode($tes);
    }
}