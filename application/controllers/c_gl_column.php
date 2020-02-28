<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_gl_column extends Core_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->auth_check();
		$this->load->model('m_wsbangun');
	
	}
    public function index()
    {

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

    
        $today = date('d/m/Y');
        $table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);
  

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName);

        // $this->load_content_top_menu('report_format/indexcolumn',$ContentAllData);
        $group = $this->session->userdata('Tsusergroup');
        if ($group=='MGM'){
            $this->load_content_mgm('report_format/indexcolumn',$ContentAllData);
        }else{
            $this->load_content_top_menu('report_format/indexcolumn',$ContentAllData);
        }
        
    }
    public function edit(){
        $crit = array('module' => 'GL' );
        $obj = array('amt_type', 'descs');
        $cbAmt = $this->m_wsbangun->getComboPB('cf_rpt_amt_type', $obj, $crit);

        $crit = array('module' => 'GL' );
        $obj = array('col_id', 'descs');
        $cbcrit = $this->m_wsbangun->getComboPB('cf_rpt_column_master', $obj, $crit);
        $content  = array('cbAmt' => $cbAmt,
                            'cbcrit'=>$cbcrit );
        $this->load->view('report_format/edit',$content);

    }
     public function zoom_criteria(){
        $ent = $this->input->post('id',TRUE);
        
        // var_dump($ent);
        $table = 'cf_rpt_column_master';
        $crit = array('module' => 'GL' );
        $entityName = $this->m_wsbangun->getData_by_criteriapb($table,$crit);
        // var_dump($entityName);
            if(!empty($entityName)) {
                $comboEntity[] = '<option></option>';
                foreach ($entityName as $dtEntity) {
                  if($ent === $dtEntity->col_id) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtEntity->col_id.'">'.$dtEntity->descs.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            echo $comboEntity;
      }
      public function zoom_amt_type(){
        $ent = $this->input->post('id',TRUE);
        
        // var_dump($ent);
        $table = 'cf_rpt_amt_type';
        $crit = array('module' => 'GL' );
        $entityName = $this->m_wsbangun->getData_by_criteriapb($table,$crit);
        // var_dump($entityName);
            if(!empty($entityName)) {
                $comboEntity[] = '<option></option>';
                foreach ($entityName as $dtEntity) {
                  if($ent === $dtEntity->amt_type) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtEntity->amt_type.'">'.$dtEntity->descs.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            echo $comboEntity;
      }
    public function getByID($field_id=''){
 
        $where=array('field_id'=>$field_id);
        $data = $this->m_wsbangun->getData_by_criteriapb('cf_rpt_column',$where);

        echo json_encode($data);

    }
    public function Delete(){
        $MenuID = $this->input->post("MenuID",true);
        if(empty($MenuID)){
            $MenuID=0;
        }
        $where=array('field_id'=>$MenuID,'module'=>'GL');
        $data = $this->m_wsbangun->deletedata('cf_rpt_column',$where);
        if($data=='OK'){
            $msg = "Data has been deleted successfully";
            $st = 'OK';    
        } else {
            $msg = $data;
            $st = 'Failed';
        }
        
        $msg1=array("Pesan"=>$msg,"status"=>$st);
        echo json_encode($msg1);
    }
    public function getTable()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $entity = $this->session->userdata('Tsentity');
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        // var_dump($name);
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','field_id', 'header1', 'header2','amt_type','formula');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_rpt_gl_column';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
   
        $Search = $sSearch;
        
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];

        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);


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

        $param =" Where module='GL' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablePB($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      
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
    public function save(){
        
            $msg="";
            if ($_POST) 
            {
                $form = $this->input->post('form', true);
                $field_id = $this->input->post('col_id', true);
                $header1 = $this->input->post('header1',TRUE);
                $header2 =$this->input->post('header2',TRUE);
                $amt_type = $this->input->post('amt_type',TRUE);                
                $formula = $this->input->post('formula',TRUE);
                $fixed_relative = $this->input->post('fixed_relative',TRUE);
                $relative_by = $this->input->post('relative_by',TRUE);
                $period = $this->input->post('period',TRUE);
                $duration_type = $this->input->post('duration_type',TRUE);
                $duration = $this->input->post('duration',TRUE);
                $calc = $this->input->post('calc_val',TRUE);
                
                $col_id1 = $this->input->post('col_id1',TRUE);
                $col_range1_val = $this->input->post('col_range1_val',TRUE);
                $start_exp1 = $this->input->post('start_exp1',TRUE);
                $end_exp1 = $this->input->post('end_exp1',TRUE);
                $col_id2 = $this->input->post('col_id2',TRUE);
                $col_range2_val = $this->input->post('col_range2_val',TRUE);
                $start_exp2 = $this->input->post('start_exp2',TRUE);
                $end_exp2 = $this->input->post('end_exp2',TRUE);
                $col_id3 = $this->input->post('col_id3',TRUE);
                $col_range3_val = $this->input->post('col_range3_val',TRUE);
                $start_exp3 = $this->input->post('start_exp3',TRUE);
                $end_exp3 = $this->input->post('end_exp3',TRUE);
                $col_id4 = $this->input->post('col_id4',TRUE);
                $col_range4_val = $this->input->post('col_range4_val',TRUE);
                $start_exp4 = $this->input->post('start_exp4',TRUE);
                $end_exp4 = $this->input->post('end_exp4',TRUE);
                $col_id5 = $this->input->post('col_id5',TRUE);
                $col_range5_val = $this->input->post('col_range5_val',TRUE);
                $start_exp5 = $this->input->post('start_exp5',TRUE);
                $end_exp5 = $this->input->post('end_exp5',TRUE);

                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');
                

                    
                    $psn='';
                    $criteria = array('field_id' => $field_id,'module'=>'GL');
                    // var_dump($criteria);
                    if($form=='edit') {
                        $data = array(          
                        // 'field_id'=>$col_id,
                        'header1' => $header1,
                        'header2' => $header2,
                        'amt_type' =>$amt_type,
                        'formula' =>$formula,
                        'fixed_relative' =>$fixed_relative,
                        'relative_by' =>$relative_by,
                        'period' =>$period,
                        'duration_type' =>$duration_type,
                        'duration' =>$duration,                        
                        'calc'=>$calc,
                        'col_id1'=>$col_id1,
                        'col_range1'=>$col_range1_val,
                        'start_exp1'=>$start_exp1,
                        'end_exp1'=>$end_exp1,
                        'col_id2'=>$col_id2,
                        'col_range2'=>$col_range2_val,
                        'start_exp2'=>$start_exp2,
                        'end_exp2'=>$end_exp2,
                        'col_id3'=>$col_id3,
                        'col_range3'=>$col_range3_val,
                        'start_exp3'=>$start_exp3,
                        'end_exp3'=>$end_exp3,
                        'col_id4'=>$col_id4,
                        'col_range4'=>$col_range4_val,
                        'start_exp4'=>$start_exp4,
                        'end_exp4'=>$end_exp4,
                        'col_id5'=>$col_id5,
                        'col_range5'=>$col_range5_val,
                        'start_exp5'=>$start_exp5,
                        'end_exp5'=>$end_exp5,
                        // 'module'=>'GL',
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );
                        $update = $this->m_wsbangun->updateData('cf_rpt_column',$data, $criteria);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                        
                    } else {
                        $data = array(          
                        'field_id'=>strtoupper($field_id),
                        'header1' => $header1,
                        'header2' => $header2,
                        'amt_type' =>$amt_type,
                        'formula' =>$formula,
                        'fixed_relative' =>$fixed_relative,
                        'relative_by' =>$relative_by,
                        'period' =>(int)$period,
                        'duration_type' =>$duration_type,
                        'duration' =>(int)$duration,                        
                        'calc'=>$calc,
                        'col_id1'=>(int)$col_id1,
                        'col_range1'=>$col_range1_val,
                        'start_exp1'=>$start_exp1,
                        'end_exp1'=>$end_exp1,
                        'col_id2'=>(int)$col_id2,
                        'col_range2'=>$col_range2_val,
                        'start_exp2'=>$start_exp2,
                        'end_exp2'=>$end_exp2,
                        'col_id3'=>(int)$col_id3,
                        'col_range3'=>$col_range3_val,
                        'start_exp3'=>$start_exp3,
                        'end_exp3'=>$end_exp3,
                        'col_id4'=>(int)$col_id4,
                        'col_range4'=>$col_range4_val,
                        'start_exp4'=>$start_exp4,
                        'end_exp4'=>$end_exp4,
                        'col_id5'=>(int)$col_id5,
                        'col_range5'=>$col_range5_val,
                        'start_exp5'=>$start_exp5,
                        'end_exp5'=>$end_exp5,
                        'module'=>'GL',
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );
                        $insert = $this->m_wsbangun->insertData('cf_rpt_column',$data);
                        if ($insert == 'OK')
                        {
                            $msg="Data has been saved successfully";
                            $psn = "OK";
                        } else {
                            $msg= $insert;
                            $psn = "Failed";
                        }
                        
                        
                    }

            } //tutup post
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                "status"=>$psn);
            
        echo json_encode($msg1);


    }
   
	

}
?>