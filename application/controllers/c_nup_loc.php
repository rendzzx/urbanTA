<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Nup_loc extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');

    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        $entityname = $this->session->userdata('Tsentityname');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        $project = $this->session->userdata('Tsproject');
        // var_dump($project);
        $table = 'pl_project(nolock)';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtPrj = $this->m_wsbangun->getData_by_criteria($table, $crit);
        if(!empty($dtPrj))
        {
            $prjdesc = $dtPrj[0]->descs;
            $content = array('leftdyn'=>$name,
                'sys'=>$admin,
                'prj'=>$prjdesc,
                'approver'=>0,
                'entityname'=>$entityname
            );
            $this->load_content('nuploc/index',$content);
        } else {
            show_404();
            return;
        }
    }

    private function setUploadOptions()
    {
        $config = array('upload_path'=>'./img/NUP',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>'10000',
            'overwrite'=>TRUE
        );
        return $config;
    }

    public function getTable()
    {
        
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $project = $this->session->userdata('Tsproject');
        $entity = $this->session->userdata('Tsentity');
        $seqno = $this->input->post('seqno', true);
        $DB2 = $this->load->database('ifca', true);
        $this->load->library('Datatables');

        $aColumns  = array('row_number', 'prjname', 'location', 'invitation_path');

        $sTable = 'mgr.nuplocation';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        // $iDisplayLength = 10;
        $order = (int)$this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $column = $this->input->get_post('columns', true);
        // $sSearch = $this->input->get_post('search', true);
        $sSearch = $this->input->post("sSearch",true);
        // $Search = $sSearch['value'];
        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        $SordField = ($sortIdColumn==0? $aColumns[1] :$column[$sortIdColumn]['name']);

        // // paging
        // if(isset($iDisplayStart) && $iDisplayLength != '-1')
        // {
        //     $DB2->limit($DB2->escape_str($iDisplayLength), $DB2->escape_str($iDisplayStart));
        // }
        // // var_dump($iDisplayLength);
        // filter
        $filter_search='';
        if(isset($sSearch) && !empty($sSearch))
        {
            for($i=1; $i<count($column); $i++)
            {
                if(isset($column[$i]['searchable']) && $column[$i]['searchable']=='true')
                {
                    $filter_search.= $column[$i]['name'] ." LIKE '%". $Search. "%' OR ";
                }
            }
            $a = strrpos($filter_search, 'OR');
            $filter_search = (!empty($filter_search)? "AND (".substr($filter_search, 0, $a).")" : $filter_search);
        }
        // select data
        // $iPage = (int)($iDisplayStart+$iDisplayLength);
        
        // $sql = " WHERE entity_cd='$entity' AND project_no='$project' " .$filter_search;
        $param = " WHERE entity_cd='$entity' AND project_no='$project' " .$filter_search;
        // $rResult = $this->m_wsbangun->getlisttable("mgr.nuplocation", $iDisplayStart, $iPage, $SordField, $SortdOrder, $sql);
        // $rResult = $this->m_wsbangun->getlisttable("mgr.nuplocation", $iDisplayStart, $SordField, $SortdOrder, $param);
        $rResult = $this->m_wsbangun->getlisttable($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
        // Total data set length
        
        // $where = array('entity_cd'=>$entity,
        //     'project_no'=>$project);
        // $cnt = $this->m_wsbangun->getCount_by_criteria("nuplocation", $where);
        // $iTotal = $cnt;

        $sql="select count(*) as cnt from ".$sTable." ".$param;
        $ts = $DB2->query($sql);
        $a = $ts->result()[0]->cnt;

        $iTotal = $a;//$DB2->count_all($sTable);

        // output
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

    public function insert()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $entityname = $this->session->userdata('Tsentityname');
        $name = $this->session->userdata('Tsuname');
        $admin = $this->session->userdata('Tsysadmin');
        // var_dump($project);
        $table = 'pl_project(nolock)';
        $kriteria = array('entity_cd'=>$entity);
        $obj = array('project_no','descs');
        $cbPrj = $this->m_wsbangun->getCombo($table, $obj, $kriteria, $project);
        $table = 'cf_location';
        $obj = array('location_cd', 'descs');
        $cbLoc = $this->m_wsbangun->getCombo($table, $obj);

        $content = array('leftdyn'=>$name,
            'comboPrj'=>$cbPrj,
            'comboLoc'=>$cbLoc,
            'entityname'=>$entityname);
        
    	// $this->load_content('nuploc/nuplocation',$content);
        $this->load->view('nuploc/nuplocation',$content);
    }

    public function edit($id = '')
    {
        if(!empty($id))
        {
            $table = 'rl_nup_loc_attachment(nolock)';
            $crit = array('rowID'=>$id);
            $dtNuploc = $this->m_wsbangun->getData_by_criteria($table, $crit);
            if(!empty($dtNuploc))
            {
                $entity = $dtNuploc[0]->entity_cd;
                $project = $dtNuploc[0]->project_no;
                $loc = $dtNuploc[0]->location_cd;
                $row = $dtNuploc[0]->rowID;
                $pic = $dtNuploc[0]->invitation_path;
                $table = 'pl_project(nolock)';
                $kriteria = array('entity_cd'=>$entity);
                $obj = array('project_no','descs');
                $cbPrj = $this->m_wsbangun->getCombo($table, $obj, $kriteria, $project);
                $table = 'cf_location';
                $obj = array('location_cd', 'descs');
                $cbLoc = $this->m_wsbangun->getCombo($table, $obj, null, $loc);
                $content = array('row'=>$row,
                    'pic'=>$pic,
                    'comboPrj'=>$cbPrj,
                    'comboLoc'=>$cbLoc);

                $this->load->view('nuploc/nuplocedit', $content);
            }
        } else {
            show_404();
            return;
        }
    }

    public function save()
    {
        if($_POST)
        {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->input->post('pl_project', true);
            $location = $this->input->post('location', true);
            $id = $this->input->post('id', true);
            $this->load->library('upload');
            if($_FILES) {
                $files = $_FILES;
                $invite = str_replace(' ', '_', $files['userfile']['name']);
                $this->upload->initialize($this->setUploadOptions());
                if(!$this->upload->do_upload()) 
                {
                    $msg = $this->upload->display_errors();
                } else {
                    $msg = "file has been uploaded successfully";
                }

            } else {
                $invite = $this->input->post('Picture', true);
            }

            $data = array('entity_cd'=>$entity,
                'project_no'=>$project,
                'location_cd'=>$location
                ,'invitation_path'=>$invite
                );
            $table = 'rl_nup_loc_attachment';
            if(!empty($id))
            {
                // var_dump("UPDATE");
                $crit = array('rowID'=>$id);
                $this->m_wsbangun->updateData($table, $data, $crit);
            } else {
                // var_dump("INSERT");
                $this->m_wsbangun->insertData($table, $data);
            }
            $msg = "file has been saved successfully";

            
            $res = array('pesan'=>$msg);
            echo json_encode($res);
        } else {
            show_404();
            return;
        }
        
    }

    public function remove()
    {
        $id = $this->input->post("rid",true);
        if(empty($id)){
            $msg = "Data is not successfully deleted";
        } else {
            $table = 'rl_nup_loc_attachment';
            $where = array('rowID'=>$id);
            $data = array('file_attachment'=>'',
                'status_attach'=>'0',
                'file_attached'=>null);
            // $res = $this->m_wsbangun->updateData($table, $data, $where);
            $res = $this->m_wsbangun->deletedata($table, $where);
            $msg = "File has been removed successfully";
        }
        $output = array("Pesan"=>$msg);
        echo json_encode($output);
    }
}