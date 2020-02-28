<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_row_format extends Core_Controller
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
        $project = $this->session->userdata('Tsproject');
        $admin = $this->session->userdata('Tsysadmin');
        $projectName = $this->session->userdata('Tsprojectname');

              
        
        $content = array('project_no'=>$project,
                         'ProjectDescs'=>$projectName,
                         'row_formatID'=>$this->zoom_row_formatID()
                         );
        
    	$this->load_content_mgm('GL/index',$content);
    }

 

      //set combo when edit
      public function zoom_row_formatID(){
        // $ent = $this->input->post('MenuID',TRUE);
        $pro = $this->input->post('pro',TRUE);
        // var_dump($ent);
        $table = 'cf_rpt_row_hd';
        $where = array('module' => 'GL' );
        $parentID = $this->m_wsbangun->getData_by_criteriapb($table,$where);


        // var_dump($entityName);
            if(!empty($parentID)) {
                $comboParent[] = '<option></option>';
                foreach ($parentID as $dtParent) {
                  if($pro == $dtParent->row_id) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboParent[] = '<option '.$pilih.' value="'.$dtParent->row_id.'">'.$dtParent->row_id.' - '.$dtParent->descs.'</option>';
                }
                $comboParent = implode("", $comboParent);
            }
            if(empty($pro)){
                return $comboParent;    
            }else{
                echo  $comboParent;
            }
            
      }
public function zoom_start_end(){
        // $ent = $this->input->post('MenuID',TRUE);
        $table_name = $this->input->post('table_name',TRUE);
        $field_name = $this->input->post('field_name',TRUE);
        $field_show = $this->input->post('field_show',TRUE);
        // var_dump($ent);
        $table = $table_name;
        
        $parentID = $this->m_wsbangun->getDatapb($table);


        // var_dump($entityName);
            if(!empty($parentID)) {
                $comboParent[] = '<option></option>';
                foreach ($parentID as $dtParent) {
                  // if($pro == $dtParent->row_id) {
                  //   $pilih = ' selected = "1"';
                  // } else {
                    $pilih = '';
                  // }
                    $comboParent[] = '<option '.$pilih.' value="'.$dtParent->$field_name.'">'.$dtParent->$field_name.' - '.$dtParent->$field_show.'</option>';
                }
                $comboParent = implode("", $comboParent);
            }
            
                echo  $comboParent;
            
            
      }
      public function column_master($cl_id){
        // $ent = $this->input->post('MenuID',TRUE);
            // var_dump($cl_id);
        $pro = $this->input->post('pro',TRUE);
        if(empty($pro)){
            $pro =$cl_id;
        }
        // var_dump($pro);
        // var_dump($ent);
        $table = 'cf_rpt_column_master_web';
        $where = array('module' => 'GL' );
        $parentID = $this->m_wsbangun->getData_by_criteriapb($table,$where);


        // var_dump($entityName);
            if(!empty($parentID)) {
                $comboParent[] = '<option></option>';
                foreach ($parentID as $dtParent) {
                  if($pro == $dtParent->col_id) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboParent[] = '<option '.$pilih.' value="'.$dtParent->col_id.'" data-table="'.$dtParent->col_table.'" data-field="'.$dtParent->col_name.'" data-show="'.$dtParent->col_show.'">'.$dtParent->col_id.' - '.$dtParent->descs.'</option>';
                }
                $comboParent = implode("", $comboParent);
            }
            if(empty($pro)){
                return $comboParent;    
            }else{
                echo  $comboParent;
            }
            
      }

    public function add_header(){        
        $this->load->view('GL/add_header');

    }
     public function addnew(){
        $content =array('zoom_column'=>$this->column_master('0'));
        $this->load->view('GL/add_detail',$content);

    }
    public function getByID($field_id='',$row_id=''){
        // if(empty($id)){
        //     $id=''
        // }
        $where=array('module'=>'GL',
                     'field_id'=>$field_id,
                     'row_id'=>$row_id);
        $data = $this->m_wsbangun->getData_by_criteriapb('cf_rpt_row',$where);

        echo json_encode($data);

    }
  
    public function getTable()
    {
        $project = $this->session->userdata('Tsproject');        
        
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }

        $row_formatID = $this->input->post("row_formatID",true);
        if(empty($row_formatID)){
            $row_formatID='';
        }

        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('nup_id','entity_name', 'project_descs', 'start_date', 'end_date', 'phase_descs');
        $aColumns  = array('row_number', 'type_Descs','row_descs_space','ref_no', 'st_space', 'module', 'field_id','type','Col_id_descs','start_exp','end_exp','percent_exp','st_colour','row_descs');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_cf_rpt_row';

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
        $SordField = ($sortIdColumn==0? 'seq_id' :$Column[$sortIdColumn]['name']);

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
        $param = " where module = 'GL' and row_id = '$row_formatID' ".$filter_search;
        // var_dump($param);
        $rResult = $this->m_wsbangun->getlisttablePB($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);        

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


    public function space_line(){
        $msg="";
        $st = "";
        if($_POST){
            $row_format = $this->input->post('row_format', true);
            $seq_id = $this->input->post('seq_id', true);
            $Taku = $this->input->post('Taku', true);

            if($Taku=="tambah"){
                $sql = "UPDATE mgr.cf_rpt_row SET indent = indent + 1 WHERE row_id ='$row_format' AND seq_id >=$seq_id and module='GL' " ;
            }else{
                $sql = "UPDATE mgr.cf_rpt_row SET indent = indent - 1 WHERE row_id ='$row_format' AND seq_id >=$seq_id and module='GL' ";    
            }
            
            $data = $this->m_wsbangun->setData_by_query($sql);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been updated successfully";
                            $st = 'OK';
                        }

        } else{
                $msg="Data validation is not valid";
                $st = 'Fail';
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);
    }

    public function space_horizontal(){
        $msg="";
        $st = "";
        if($_POST){
            $row_id = $this->input->post('row_format', true);
            $seq_id = $this->input->post('seq_id', true);
            $field_id = $this->input->post('field_id', true);
            $Taku = $this->input->post('Taku', true);

            if($Taku=="UP"){

 //1 Down              //1 down
                     $sql = "   UPDATE mgr.cf_rpt_row SET seq_id = seq_id - 1 WHERE row_id ='$row_id' AND seq_id = $seq_id and module='GL'";
                    //2 up seq -1 
                    $sql1 =" UPDATE mgr.cf_rpt_row SET seq_id = seq_id + 1    WHERE row_id ='$row_id' AND seq_id = ($seq_id - 1 ) and module='GL'   AND field_id<>'$field_id'";

                    $data = $this->m_wsbangun->setData_by_query($sql);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $data1 = $this->m_wsbangun->setData_by_query($sql1);
                            if($data1!="OK"){
                                    $msg= $data;
                                    $st = 'Fail';
                            }else{
                                    $msg="Data has been updated successfully";
                                    $st = 'OK';    
                            }
                            
                        }
            }else{//Down

                 
                     $sql = "   UPDATE mgr.cf_rpt_row SET seq_id = seq_id + 1 WHERE row_id ='$row_id' AND seq_id = $seq_id and module='GL'";
                    //2 up seq -1 
                    $sql1 =" UPDATE mgr.cf_rpt_row SET seq_id = seq_id -1    WHERE row_id ='$row_id' AND seq_id = ($seq_id + 1 ) and module='GL'   AND field_id<>'$field_id'";

                    $data = $this->m_wsbangun->setData_by_query($sql);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $data1 = $this->m_wsbangun->setData_by_query($sql1);
                            if($data1!="OK"){
                                    $msg= $data;
                                    $st = 'Fail';
                            }else{
                                    $msg="Data has been updated successfully";
                                    $st = 'OK';    
                            }
                            
                        }

            }
            
            // $data = $this->m_wsbangun->setData_by_query($sql);
            //             if($data !="OK"){
            //                 $msg= $data;
            //                 $st = 'Fail';
            //             }else{
            //                 $msg="Data has been updated successfully";
            //                 $st = 'OK';
            //             }

        } else{
                $msg="Data validation is not valid";
                $st = 'Fail';
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);
    }
    public function Delete(){
        $msg="";
        $st = "";
        if($_POST){
            $row_id = $this->input->post('row_id', true);
            $field_id = $this->input->post('field_id', true);
            $seq_ID = $this->input->post('seq_ID', true);
            $indent = $this->input->post('indent', true);

            
            $where=array('row_id'=>$row_id,
                    'seq_id'=>$seq_ID,
                    'field_id'=>$field_id);
            $dd = $this->m_wsbangun->deletedata('cf_rpt_row',$where);

            if($dd!="OK"){
                $msg= $data;
                $st = 'Fail';
            }else{
                $sql = "UPDATE mgr.cf_rpt_row SET seq_id = seq_id - 1 WHERE row_id ='$row_id' AND seq_id >= ($seq_ID+1) and module='GL' ";    
            
            
                $data = $this->m_wsbangun->setData_by_query($sql);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been updated successfully";
                            $st = 'OK';
                        }
            }
            

        } else{
                $msg="Data validation is not valid";
                $st = 'Fail';
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);
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

    }
    public function save_header(){
        
            $msg="";
            if ($_POST) 
            {
                $txt_rowID = $this->input->post('txt_rowID', true);              
                $txt_descs = $this->input->post('txt_descs',TRUE);
              
                // $status = intval($this->input->post('status',TRUE));
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                // if(empty($parent_id)){
                //     $parent_id = 0;
                // }
                
                        $data = array(          
                        // 'nup_id' => $nup_id,
                        'module' => 'GL',
                        'row_id' => $txt_rowID,
                        'descs' =>$txt_descs,
                        'show_code' =>'N',                        
                        'audit_user'=>$audit_user,
                        'audit_date'=>$audit_date
                        );
                    

                    // $criteria = array('MenuID' => $menu_id);
                    // var_dump($criteria);
               
                        $data = $this->m_wsbangun->insertData('cf_rpt_row_hd',$data);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been saved successfully";
                            $st = 'OK';
                        }
                            
                }      
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);

    }
    public function save_detail(){
        
            $msg="";
            if ($_POST) 
            {
                $row_id = $this->input->post('row_id', true);              
                $field_id = $this->input->post('field_id',TRUE);
                $seq_ID = $this->input->post('seq_ID',TRUE);    
                $indent = $this->input->post('indent',TRUE);    

                $txt_type = $this->input->post('txt_type', true);              
                $txt_descs = isset($_POST["txt_descs"]) ? $_POST["txt_descs"] : ' ';//$this->input->post('txt_descs',TRUE);
                $txt_refno = isset($_POST["txt_refno"]) ? $_POST["txt_refno"] : ' ';//$this->input->post('txt_refno',TRUE);
                $txt_column =isset($_POST["txt_column"]) ? $_POST["txt_column"] : 0; //$this->input->post('txt_column',TRUE);
                $txtcolrange = isset($_POST["cb_colrange"]) ? $_POST["cb_colrange"] : 'Y';//$this->input->post('cb_colrange',TRUE);
                $txt_persent_exp = isset($_POST["txt_persent_exp"]) ? $_POST["txt_persent_exp"] : ' ';//$this->input->post('txt_persent_exp',TRUE);
                $formula = isset($_POST["txt_formula"]) ? $_POST["txt_formula"] : ' ';//$this->input->post('txt_formula',TRUE);
                $start_exp = isset($_POST["txt_start_exp"]) ? $_POST["txt_start_exp"] : ' ';//$this->input->post('txt_start_exp',TRUE);
                $end_exp = isset($_POST["txt_end_exp"]) ? $_POST["txt_end_exp"] : ' ';//$this->input->post('txt_end_exp',TRUE);
                //checkbox isset($_POST["status_$i"]) ? $_POST["status_$i"] : 0;
                $cb_debit_credit = isset($_POST["cb_debit_credit"]) ? $_POST["cb_debit_credit"] : 1;//$this->input->post('cb_debit_credit',TRUE);
                $cb_show_header = isset($_POST["cb_show_header"]) ? $_POST["cb_show_header"] : 'N';//$this->input->post('cb_show_header',TRUE);
                $cb_show_details = isset($_POST["cb_show_details"]) ? $_POST["cb_show_details"] : 'N';//$this->input->post('cb_show_details',TRUE);
                $cb_show_topline = isset($_POST["cb_show_topline"]) ? $_POST["cb_show_topline"] : 'N';//$this->input->post('cb_show_topline',TRUE);
                $cb_show_bottomline = isset($_POST["cb_show_bottomline"]) ? $_POST["cb_show_bottomline"] : 'N';//$this->input->post('cb_show_bottomline',TRUE);
                $cb_show_data = isset($_POST["cb_show_data"]) ? $_POST["cb_show_data"] : 'N';//$this->input->post('cb_show_data',TRUE);
                $cb_row_bold = isset($_POST["cb_row_bold"]) ? $_POST["cb_row_bold"] : 'N';//$this->input->post('cb_row_bold',TRUE);
                $cb_row_italic = isset($_POST["cb_row_italic"]) ? $_POST["cb_row_italic"] : 'N';//$this->input->post('cb_row_italic',TRUE);
                $cb_row_underline = isset($_POST["cb_row_underline"]) ? $_POST["cb_row_underline"] : 'N';//$this->input->post('cb_row_underline',TRUE);
                $audit_date = date('d M Y H:i:s');
                $audit_user = $this->session->userdata('Tsuname');

                $edit=1;

                //count seq_id
                $sql = "select count(seq_id) as cnt_seq_id from mgr.cf_rpt_row where row_id ='$row_id' ";
                $data = $this->m_wsbangun->getData_by_querypb($sql);
                $cnt = $data[0]->cnt_seq_id;
                if($cnt==0){
                    $cnt = 1;
                }
                $seq_id = (int)$cnt + 1;

                if($field_id=='0'){
                    $edit =0;
                    $fcnt = 100 + (int)$seq_id;
                    $field_id = 'R'.(string)$fcnt;
                }
                
                //
                if($edit!=1){
                    if(!empty($seq_ID)){
                    $sql = "UPDATE  mgr.cf_rpt_row set seq_id = seq_id + 1  WHERE row_id='$row_id' AND seq_id >=$seq_ID ";
                    $data = $this->m_wsbangun->setData_by_query($sql);
                    $seq_id = $seq_ID;
                    }
                }else{
                    if(!empty($seq_ID)){                    
                    $seq_id = $seq_ID;
                    }
                }
                

                    // $criteria = array('MenuID' => $menu_id);
                    // var_dump($criteria);
               if($edit==1){

                    $data = array(          
                        // 'nup_id' => $nup_id,
                        'module'    => 'GL',
                        'row_id'    => $row_id,
                        'field_id'  => $field_id,
                        // 'seq_id'    => $seq_id,
                        'type'      => $txt_type,
                        'row_descs'     => $txt_descs,
                        'ref_no'    => $txt_refno,
                        'indent'    => $indent,
                        'indent_rev'  => 0,

                        'row_bold'  => $cb_row_bold,
                        'row_italic'=> $cb_row_italic,
                        'row_underline' =>$cb_row_underline,
                        'show_header'   =>$cb_show_header,
                        'show_details'   =>$cb_show_details,
                        'show_data'     => $cb_show_data,
                        'show_bottomline' =>$cb_show_bottomline,
                        'show_topline'    => $cb_show_topline,
                        'debit_credit'    => $cb_debit_credit,

                        'col_id'        => $txt_column,
                        'col_range'     => $txtcolrange,
                        'start_exp'     => $start_exp,
                        'end_exp'       => $end_exp,
                        'percent_exp'   => $txt_persent_exp,
                        'print_sign'    => ' ',
                        'ext1'          => 0,
                        'ext2'          => 0,
                        'ext3'          => 0,
                        'across_downward'=>'A',                  
                        'audit_user'=> $audit_user,
                        'audit_date'=> $audit_date
                        );

                $criteria = array('module' => 'GL',
                                  'row_id' => $row_id,
                                  'field_id' => $field_id);
                    $data = $this->m_wsbangun->updateData('cf_rpt_row',$data, $criteria);
                        // var_dump($data);exit();
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been updated successfully";
                            $st = 'OK';
                        }
               }else{

                $data = array(          
                        // 'nup_id' => $nup_id,
                        'module'    => 'GL',
                        'row_id'    => $row_id,
                        'field_id'  => $field_id,
                        'seq_id'    => $seq_id,
                        'type'      => $txt_type,
                        'row_descs'     => $txt_descs,
                        'ref_no'    => $txt_refno,
                        'indent'    => $indent,
                        'indent_rev'  => 0,

                        'row_bold'  => $cb_row_bold,
                        'row_italic'=> $cb_row_italic,
                        'row_underline' =>$cb_row_underline,
                        'show_header'   =>$cb_show_header,
                        'show_details'   =>$cb_show_details,
                        'show_data'     => $cb_show_data,
                        'show_bottomline' =>$cb_show_bottomline,
                        'show_topline'    => $cb_show_topline,
                        'debit_credit'    => $cb_debit_credit,

                        'col_id'        => $txt_column,
                        'col_range'     => $txtcolrange,
                        'start_exp'     => $start_exp,
                        'end_exp'       => $end_exp,
                        'percent_exp'   => $txt_persent_exp,
                        'print_sign'    => ' ',
                        'ext1'          => 0,
                        'ext2'          => 0,
                        'ext3'          => 0,
                        'across_downward'=>'A',                  
                        'audit_user'=> $audit_user,
                        'audit_date'=> $audit_date
                        );
                        $data = $this->m_wsbangun->insertData('cf_rpt_row',$data);
                        if($data !="OK"){
                            $msg= $data;
                            $st = 'Fail';
                        }else{
                            $msg="Data has been saved successfully";
                            $st = 'OK';
                        }
               }
                        
                            
                }      
            else{
                $msg="Data validation is not valid";
            }
            
            $msg1=array("Pesan"=>$msg,
                        "St"=>$st);
            
        echo json_encode($msg1);

    }
}