<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class c_gl_report extends Core_Controller
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

        $group = $this->session->userdata('Tsusergroup');
        if ($group=='MGM'){
            $this->load_content_mgm('report_format/indexreport',$ContentAllData);
        }else{
            $this->load_content_top_menu('report_format/indexreport',$ContentAllData);
        }
        // $this->load_content_top_menu('report_format/indexreport',$ContentAllData);

        
    }
    public function Delete(){
        $row_id = $this->input->post("row_id",true);
        $report_id = $this->input->post("report_id",true);

        $where=array('report_id'=>$report_id,'row_id'=>$row_id,'module'=>'GL');
        $data = $this->m_wsbangun->deletedata('cf_rpt_format',$where);
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
     public function add($report_id='',$row_id=''){
        if($report_id>0||!empty($report_id)){
            $rep_id = $report_id;
            $ro_id = $row_id;
            $form = 'Edit';
        } else {
            $rep_id = 0;
            $ro_id = 0;
            $form = 'Entry';
        }
        $crit = array('module' => 'GL' );
        $table = 'cf_rpt_row_hd';
        $data1 = $this->m_wsbangun->getData_by_criteriapb($table,$crit);
         if(!empty($data1)) {
                $combodata1[] = '<option></option>';
                foreach ($data1 as $dt1) {
                if($row_id === $dt1->row_id) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $combodata1[] = '<option value="'.$dt1->row_id.'">'.$dt1->row_id.' - '.$dt1->descs.'</option>';
                }
                $combodata1 = implode("", $combodata1);
            }
        $crit = array('module' => 'GL' );
        $table = 'cf_rpt_column';
        $data2 = $this->m_wsbangun->getData_by_criteriapb($table,$crit);
         if(!empty($data2)) {
                $combodata2[] = '<option></option>';
                foreach ($data2 as $dt2) {
                     if(!empty($dt2->header2)||trim($dt2->header2)!=''){
                        $header2 = ' ('.trim($dt2->header2).')';
                      } else {
                        $header2 = '';
                      }
                    $combodata2[] = '<option value="'.$dt2->field_id.'">'.$dt2->field_id.' - '.trim($dt2->header1).$header2.'</option>';
                }
                $combodata2 = implode("", $combodata2);
            }
            $content  = array('cbrowformat' => $combodata1,
            'cbcolumn'=>$combodata2,
            'row_id'=>$ro_id,
            'report_id'=>$rep_id,
            'form'=>$form 
             );
        $group = $this->session->userdata('Tsusergroup');
        if ($group=='MGM'){
            $this->load_content_mgm('report_format/addreport',$content);
        }else{
            $this->load_content_top_menu('report_format/addreport',$content);
        }
        // $this->load->view('report_format/addreport',$content);

    }
     public function zoom_colid(){
        $ent = $this->input->post('id',TRUE);
        
        $table = 'cf_rpt_column';
        $crit = array('module' => 'GL' );
        $entityName = $this->m_wsbangun->getData_by_criteriapb($table,$crit);
        // var_dump($entityName);
            if(!empty($entityName)) {
                $comboEntity[] = '<option></option>';
                foreach ($entityName as $dt2) {
                  if($ent === $dt2->field_id) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                  if(!empty($dt2->header2)||trim($dt2->header2)!=''){
                    $header2 = ' ('.trim($dt2->header2).')';
                  } else {
                    $header2 = '';
                  }
                  var_dump($dt2->header2);
                    $comboEntity[] =  '<option '.$pilih.' value="'.$dt2->field_id.'">'.$dt2->field_id.' - '.trim($dt2->header1).$header2.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            echo $comboEntity;
      }
    public function gettitleByID(){
        
        $id = $this->input->POST('id',TRUE);
        $sql = "select descs from mgr.cf_rpt_row_hd where row_id = '".$id."' and module='GL'";
        
        $data = $this->m_wsbangun->getData_by_querypb($sql);
        
        echo $data[0]->descs;
    }
       public function getByID($report_id='',$row_id=''){
 
        $where=array('report_id'=>$report_id,'row_id'=>$row_id,'module'=>'GL');
        $data = $this->m_wsbangun->getData_by_criteriapb('cf_rpt_format',$where);

        echo json_encode($data);

    }
    public function get_colformat(){
        $row_id = $this->input->POST('row_id',TRUE);
        $report_id = $this->input->POST('report_id',TRUE);
        $no = $this->input->POST('col_no',TRUE);
        // $no='1';
        $sql = "select column_factor".$no." from mgr.cf_rpt_format where row_id='$row_id' and module='GL' and report_id='$report_id'";
        // var_dump($sql);
        $data = $this->m_wsbangun->getData_by_querypb($sql);
        $dt = json_decode(json_encode($data), true);
        // var_dump($dt);
        echo $dt[0]['column_factor'.$no];

    }
    public function view($report_id='',$row_id='')
    {

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

    
        $today = date('d/m/Y');

        $table = 'cf_rpt_format';
        $crit = array('module' => 'GL' );
        $data1 = $this->m_wsbangun->getData_by_criteriapb($table,$crit);
        // $DataFil = array_filter($data1,function($a) use($report_id) {                
        //                 return $a->report_id === $report_id;
        //             });
        $table = 'cf_rpt_format';
        $crit = array('module' => 'GL','report_id'=>$report_id,'row_id'=>$row_id );
        $DataFil = $this->m_wsbangun->getData_by_criteriapb($table,$crit);
        // var_dump($DataFil);
        $sql1 = "select * from mgr.cf_rpt_column (nolock) where module='GL'";
        $dt1 = $this->m_wsbangun->getData_by_querypb($sql1);
        $cols[]='column_id1';
        for ($i=2; $i <=20 ; $i++) { 
            
                $cols[] .= 'column_id'.$i.'';
            
        }
        
        $new = json_decode(json_encode($DataFil[0]), true);
        $datacols[]='';
        foreach ($cols as $key) {
            $datacols[] .= $new[$key];
        }
        
        $dataheader1[]='';$dataheader2[]='';
        foreach ($datacols as $key) {
           
      
            if($key=='-1'||$key=='') {
                $dataheader1[].=$key;
                $dataheader2[].='';
            } else {
                $bb = $key;
                $header = array_filter($dt1,function($a) use($bb) {
                            
                            return $a->field_id === $bb;
                        });

                    foreach ($header as $key) {
                
                        $dataheader1[] .= $key->header1;
                        $dataheader2[] .= $key->header2;
                    }

            }
           
        }
        $header1[]=$dataheader1[1];
        for ($i=2; $i <=21 ; $i++) { 
            $header1[].=$dataheader1[$i];
        }
        $header2[]=$dataheader2[1];
        for ($i=2; $i <=21 ; $i++) { 
            $header2[].=$dataheader2[$i];
        }

    
        // var_dump($header1);exit();
     

            if(!empty($data1)) {
                $combodata1[] = '<option></option>';
                foreach ($data1 as $dt1) {
                  if($report_id === $dt1->report_id) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $combodata1[] = '<option '.$pilih.' value="'.$dt1->report_id.'">'.$dt1->report_id.'</option>';
                }
                $combodata1 = implode("", $combodata1);
            }
            if(!empty($data1)) {
                $combodata2[] = '<option></option>';
                foreach ($data1 as $dt1) {
                  if($row_id === $dt1->row_id) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $combodata2[] = '<option '.$pilih.' value="'.$dt1->row_id.'">'.$dt1->row_id.'</option>';
                }
                $combodata2 = implode("", $combodata2);
            }

        $ContentAllData = array(
                'project_no'=>$project,
                'dataheader1'=>$header1,
                'dataheader2'=>$header2,
                // 'cbReport'=>$combodata1,
                // 'cbRow'=>$combodata2,
                'new'=>$new,
                'datafilter'=>$DataFil,
                'ProjectDescs'=>$projectName);

        // $this->load_content_top_menu('report_format/viewreport',$ContentAllData);
        $group = $this->session->userdata('Tsusergroup');
        if ($group=='MGM'){
            $this->load_content_mgm('report_format/viewreport',$ContentAllData);
        }else{
            $this->load_content_top_menu('report_format/viewreport',$ContentAllData);
        }
        
    }
     public function getTableIndex()
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
        $aColumns  = array('row_number','descs','row_id','report_id','title_descs');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.cf_rpt_format';

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
    public function getTable()
    {
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        $reportid = $this->input->post("reportid",true);
        if(empty($reportid)){
            $reportid='';
        }
        $rowid = $this->input->post("rowid",true);
        if(empty($rowid)){ 
            $rowid='';
        }
        $entity = $this->session->userdata('Tsentity');
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        // var_dump($name);
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','row_descs');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_rpt_gl_format';

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

        $param =" Where module='GL' and report_id='$reportid' and row_id='$rowid' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablePB($sTable,(int)($iDisplayStart),(int)($iDisplayLength),'seq_id',$SortdOrder,$param);
      
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
                $form = $this->input->post('form', TRUE);
                $row_id = $this->input->post('row_id',TRUE);
                $reportid = $this->input->post('reportid');
                $descs =$this->input->post('descs',TRUE);
                $title_descs = $this->input->post('title_descs',TRUE);
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                $filter_zero = $this->input->post('filter_zero_val',TRUE);
              
                for ($i=1; $i <=20 ; $i++) {
                    $k = $this->input->post('column_id'.$i,TRUE); 
                    if($k==null||empty($k)||$k=='') {
                        $col_id = '-1';
                    } else {
                        $col_id = $k;
                    }
                    $data['column_id'.$i]= $col_id;
                    $data['column_factor'.$i]= $this->input->post('column_factor'.$i,TRUE);
                    $data['column_x'.$i]= $this->input->post('column_x'.$i,TRUE);
                    $data['column_justify'.$i]= $this->input->post('column_justify'.$i,TRUE);
                    $data['column_format'.$i]= '###,###,###,##0.00;(###,###,###,##0.00)';
                    $data['column_width'.$i]='330';

                    $data2['column_id'.$i]= $col_id;
                    $data2['column_factor'.$i]= $this->input->post('column_factor'.$i,TRUE);
                    $data2['column_x'.$i]= $this->input->post('column_x'.$i,TRUE);
                    $data2['column_justify'.$i]= $this->input->post('column_justify'.$i,TRUE);
                    $data2['column_format'.$i]= '###,###,###,##0.00;(###,###,###,##0.00)';
                    $data2['column_width'.$i]='330';
                    // echo $data['column_id'.$i];
                }
                $data['report_id']=$reportid;
                $data['row_x']='5';
                $data['ref_x']='1211';
                $data['ref_width']='343';
                $data['filter_zero']=$filter_zero;
                $data['module']='GL';
                $data['row_id']=$row_id;
                $data['descs']=$descs;
                $data['title_descs']=$title_descs;
                $data['audit_user']=$audit_user;
                $data['audit_date']=$audit_date;

                $data2['row_id']=$row_id;
                $data2['descs']=$descs;
                $data2['row_x']='5';
                $data2['ref_x']='1211';
                $data2['ref_width']='343';
                $data2['title_descs']=$title_descs;
                $data2['audit_user']=$audit_user;
                $data2['audit_date']=$audit_date;
                // var_dump($data); exit();
             
             
                    $psn='';
                    $criteria = array('report_id' => $reportid,'module'=>'GL');
                    // var_dump($criteria);
                    if($form=='Edit') {
                        
                        $update = $this->m_wsbangun->updateData('cf_rpt_format',$data2, $criteria);
                        if($update == 'OK')
                        {
                            $msg="Data has been updated successfully";
                            $psn = "OK";
                        } else {
                            $msg= $update;
                            $psn = "Failed";
                        }
                        
                    } else {
                       
                        $insert = $this->m_wsbangun->insertData('cf_rpt_format',$data);
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