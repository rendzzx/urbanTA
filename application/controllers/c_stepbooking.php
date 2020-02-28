<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_stepbooking extends Core_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_login');
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');
    }   
    public function index($property_type=null,$property_cd=null,$unit=null){

    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
		$projectName = $this->session->userdata('Tsprojectname');

		$table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);
        $data=array('product'=>$dtProduct,
        			'project'=>$project,
        			'projectName'=>$projectName);
        if(!empty($property_type) && !empty($property_cd)){
        	if($property_type=='A'){
                $data = $this->data_unit($property_cd,$property_type);
                $this->load_content_top_menu('StepBooking/SB2UnitFloor',$data);
            }else if($property_type=='L'){
                $data = $this->data_unit_landed($property_cd,$property_type,$unit);
                $this->load_content_top_menu('StepBooking/SB2UnitLanded',$data);
            }
        	
        }else{
        	$this->load_content_top_menu('StepBooking/SB1',$data);	
        }
    	
    }
     public function indexNew(){

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');

        $table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);

        $data=array('product'=>$dtProduct,
                    'project'=>$project,
                    'ProjectDescs'=>$projectName);
        
        
        $this->load_content_top_menu('StepBooking/index',$data);
        
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
        
        $DB2 = $this->load->database('ifca', TRUE);

        //untuk PK diharap diletakan di awal array
        // $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','SP_No','NAME','lot_no','payment_plan','sell_price','status_desc','sales_date','rowID');
        // $aColumns = array('entity_cd', 'entity_name');
        // $sTable = "select * from mgr.v_nup_update where (status not in ('A','V', 'S') or (status = 'S' and old_status in ('R','N')))'";
        // $sTableDet = "SELECT * from mgr.v_nup_update where (status = 'A' or status = 'V' or (status = 'S' and old_status = 'V'))";
        $sql2 = "SELECT group_cd from mgr.cf_agent_dt (NOLOCK) where agent_cd='$name' and ENTITY_CD='$entity'";
        $data = $this->m_wsbangun->getData_by_query($sql2);
        $groupcode=$data[0]->group_cd;


        $sTable = "mgr.v_rl_sales_list";

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        
        $order = $this->input->get_post('order', true);

        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        // $sSearch = $this->input->get_post('search', true);
        // $Search = $sSearch['value'];
        $Search = $sSearch;
        // $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $Column[1]['name'] :$Column[$sortIdColumn]['name']);
        // $SordField = ('STATUS,reserve_date ASC');
// var_dump($Search);
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

        // $DB2->select('ROW_NUMBER() OVER (ORDER BY id ) AS [row_number], '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // // $DB2->select('SQL_CALC_FOUND_ROWS '.str_replace(' , ', ' ', implode(', ', $aColumns)), false);
        // $rResult = $DB2->get($sTable);
        // $rResult = $DB2->query($sql_data);
        $param =" Where entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $rResult = $this->m_wsbangun->getlisttablenup($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      // var_dump($rResult->result_array());
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
    public function property_type_image($property_type=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $tabel2 = 'cf_property';
        $kriteria2 = array(
            'entity_cd'=>$entity,
            'project_no'=>$project,
            'product_cd'=>$property_type
            );

        $datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2, $kriteria2);
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $ListAllData .='<div class="col-md-3">';
                $ListAllData .='<div class="ibox">';
                $ListAllData .='<div class="ibox-content product-box">';
                $ListAllData .='<div class="product-imitation">';
                if(!empty($value->map_picture)){                    
                    $a = '<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\',\''.$value->property_type.'\');"><center><img src="'.base_url('img/PlProject/'.$value->map_picture).'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';

                }else{
                    $a = '<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\',\''.$value->property_type.'\');" style="a:focus"><center><img src="'.base_url('img/PlProject/blankproject.png').'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';
                }
                $ListAllData .=$a;
                $ListAllData .='</div>';
                $ListAllData .='<div class="product-desc">'; 
                $ListAllData .='<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\',\''.$value->property_type.'\');" class="product-name">' .$value->descs. '&nbsp; <i class="fa fa-arrow-circle-right"></i></a>';

                // $ListAllData .='<a href="http://www.detik.com" target="_blank">&nbsp;<br>'.$value->http_add.'</a>';                                           
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';               
            }
        }
        $data = array('property_type'=> $ListAllData);
            $this->load->view('StepBooking/property_type',$data);
    }
    
    public function property_image(){
        {
         $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $tabel2 = 'cf_property';
        $cons = $this->session->userdata('Tscons');
        $kriteria2 = array(
            'entity_cd'=>$entity,
            'project_no'=>$project
            );

        $datalist2 = $this->m_wsbangun->getData_by_criteria_cons($cons,$tabel2, $kriteria2);
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $sql = "select descs from mgr.cf_property (NOLOCK)";
                $cons = $this->session->userdata('Tscons');
                $dtproduct = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

                
                // $ListAllData .='<div class="row">';
                // $ListAllData .='<div class="col-12" style="padding-left: 50px;align-content: center; vertical-align: center;">';
                // $ListAllData .='<div class="row">';
                $ListAllData .='<div class="col-offset-3 col-3">';
                $ListAllData .='<div class="card pull-up">';
                if(!empty($value->picture_url)){                    
                    $a = '<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\');"><img src="'.$value->picture_url.'" class="card-img-top img-fluid"></a>';

                }else{
                    $a = '<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\');" style="a:focus"><img src="'.base_url('img/PlProject/blankproject.png').'" class="card-img-top img-fluid"></a>';
                }
                $ListAllData .=$a;
                $ListAllData .='<div class="card-body">';
                $ListAllData .='<div class="card-title">'; 
                $ListAllData .='<a href="#" id="'.$value->property_cd.'" onclick="fn_click_image(\''.$value->property_cd.'\');" class="product-name">' .$value->descs. '&nbsp; <i class="fa fa-arrow-circle-right"></i><br><div class="card-text" style="font-size:12.5px;">'.$dtproduct[0]->descs.'</div></a>';
                $ListAllData .='</div>';//card-title
                $ListAllData .='</div>'; //card-body                                 
                $ListAllData .='</div>';//card pull-up
                $ListAllData .='</div>';//col-3
                // $ListAllData .='</div>';
                // $ListAllData .='</div>';
                // $ListAllData .='</div>';
            }
        }

        // var_dump($ListAllData);exit(); 
        $data = array('property_type'=> $ListAllData);
           $this->load->view('StepBooking/property_type',$data);
        }
    }
            
    public function update_status(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $lot_no = $this->input->post('id',TRUE);
            $status = $this->input->post('status',TRUE);
            $property_cd = (int)$this->input->post('property_cd',TRUE);
            

            $data=array('status'=>$status);
            $where =array('entity_cd'=>$entity,
                            'project_no'=>$project,
                            'property_cd'=>$property_cd,
                            'lot_no'=>$lot_no);
            $msg='';
            $psn = $this->m_wsbangun->updateData('pm_lot_web',$data, $where);
            $psn2 = $this->m_wsbangun->updateData('pm_lot',$data, $where);
            // if(!$psn=='OK' && !$psn=='OK'){
            //         $msg = $
            // }else{
                $msg="Data has been updated successfully";
            // }
            
                        
                $msg1=array("Pesan"=>$msg,
                            "status"=>'OK');
             echo json_encode($msg1);
        }
    public function SB3(){

            $this->load->view('StepBooking/SB3');
        }
     
    public function zoom_discount(){
          $tableopDis = 'rl_discount';
        $lotopdis = $this->m_wsbangun->getData($tableopDis);
        if (!empty($lotopdis)) 
        {
            $optidisc[] = '<option></option>';
            foreach ($lotopdis as $disc) 
            {
                $optidisc[] = '<option data-level="'.$disc->percent1.'" value="'.$disc->disc_cd.'">'.$disc->descs.'</option>';
            }
            $optidisc = implode("", $optidisc);
        }
        return $optidisc;
    }
    public function zoom_event()
    {
         $table = 'rl_spec (nolock)';
        $dtSpec = $this->m_wsbangun->getData($table);
        if(!empty($dtSpec)) {
            $dfMedia = $dtSpec[0]->media_cd;
        } else {
            $dfMedia = 'NA';
        }
        $table = 'cf_media (nolock)';
        $crit = array('media_cd', 'descs');
        $combo_event = $this->m_wsbangun->getCombo($table,$crit,null,$dfMedia);
        return $combo_event;
    }
    public function zoom_payment_cd()
    {
       $table = 'rl_payment_plan_hd (nolock)';
        $crit = array('payment_cd', 'descs');
        $where = array('payment_status'=>'A');
        $combo_payment = $this->m_wsbangun->getCombo($table,$crit,$where);
        return $combo_payment;
    }
    public function zoom_nama($bussId)
    {
        $Id = 
        $table = 'cf_business';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
                if($bussId === $customer->business_id) {
                    $pilih = ' selected = "1"';
                } else {
                    $pilih = '';
                }
                $comboBus[] = '<option '.$pilih.' value="'.$customer->business_id.'">'.$customer->ic_no.'         - '.$customer->name.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        return $comboBus;
    }
    public function set_session(){
         
        $property_cd = $this->input->post('property_cd',TRUE);
        $unit_book = $this->input->post('unit_book',TRUE);

        $this->session->unset_userdata('property_cd');
        $this->session->unset_userdata('unit_book');

        $this->session->set_userdata('property_cd', $property_cd);
        $this->session->set_userdata('unit_book', $unit_book);

        $msg1=array("Pesan"=>$this->session->userdata('unit_book'));
             echo json_encode($msg1);
      
    }
    public function unset_session(){
         
        $property_cd = $this->input->post('property_cd',TRUE);
        

        $this->session->unset_userdata('property_cd');
        $this->session->unset_userdata('unit_book');
        $this->session->unset_userdata('unit_land');
        $this->session->unset_userdata('business_id');


        $msg1=array("Pesan"=>"OK");
             echo json_encode($msg1);
      
    }
    public function set_session_landed(){
         
        $property_cd = $this->input->post('property_cd',TRUE);
        $unit_book = $this->input->post('unit_land',TRUE);

        
        $this->session->unset_userdata('unit_land');

        
        $this->session->set_userdata('unit_land', $unit_book);

        $msg1=array("Pesan"=>$this->session->userdata('unit_book'));
             echo json_encode($msg1);
      
    }
    public function finish(){
        $projectName = $this->session->userdata('Tsprojectname');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $table = 'v_reserve_product';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);
        $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);
        $data=array('product'=>$dtProduct,
                    'project'=>$project,
                    'projectName'=>$projectName);
        $this->load_content_top_menu('StepBooking/SB5',$data);  
    }
    public function add_customer($business_id=null,$property_type=''){ 
    // var_dump($business_id);      
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $unit_book = $this->session->userdata('unit_book');
        $property_cd = $this->session->userdata('property_cd');
        
        $table = 'cf_religion';
        $crit = array('religion_cd','descs');
        $religion = $this->m_wsbangun->getCombo($table,$crit);
        $crit = array('nationality_cd','descs');
        $nationality = $this->m_wsbangun->getCombo('cf_nationality',$crit);
        
        if(empty($business_id)){
            $business_id = 0;
        }

        $data=array('religion'=>$religion,
                    'nationality'=>$nationality,
                    'project'=>$project,
                    'projectName'=>$projectName,
                    'unit_book'=>$unit_book,
                    'property_cd'=>$property_cd,
                    'product_type'=>$property_type ,
                    'business_id'=>$business_id);
        $this->load_content_top_menu('StepBooking/SB3',$data);  
    }   
    public function add_payment($business_id=null,$property_type=null){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $unit_book = $this->session->userdata('unit_book');
        $property_cd = $this->session->userdata('property_cd');

        $this->session->set_userdata('business_id', $business_id);

        $where= array('business_id'=>$business_id);
        $datalist = $this->m_wsbangun->getData_by_criteria('cf_business',$where);  
        $name = $datalist[0]->name;

        $combo_payment = $this->zoom_payment_cd();
        
        $combo_event = $this->zoom_event();

        $combo_disc = $this->zoom_discount();

        $where= array('entity_cd'=>$entity,
                      'business_id'=>$business_id);
        $datalist2 = $this->m_wsbangun->getData_by_criteria('rl_sales',$where);      
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $sales_date = date_create($value->sales_date);
                $sales_date = date_format($sales_date,"D, d M Y");
                $lot_no = $value->lot_no;
                $ListAllData .='<h1>Unit '.$lot_no.'</h1>';                
                $ListAllData .='<fieldset>';

                $ListAllData .='<div class="col-xs-12">';
                $ListAllData .='<div class="ibox float-e-margins dark-timeline">';
                

            

                $ListAllData .='<div id="ibox-content" class="ibox-content">'; 

                

                $ListAllData .='<div class="form-group">';
                $ListAllData .='<label class="font-noraml">Payment Method </label>';
                $ListAllData .='<div class="input-group col-xs-12">';
                $ListAllData .='<select name="payment'.$lot_no.'" id="payment'.$lot_no.'" class="select2_demo_1 required" tabindex="2" data-placeholder="Select Payment Method" onChange="tampil_data(\''.$lot_no.'\');">
                    '.$combo_payment.'
                  </select>'; 
                $ListAllData .='</div>';
                $ListAllData .='</div>';

                $ListAllData .='<div class="form-group">';
                $ListAllData .='<label class="font-noraml">List Price(Exlude tax) </label>';
                $ListAllData .='<div class="input-group col-xs-12">';              
                $ListAllData .='<input name="txt_list_bf_price'.$lot_no.'" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txt_list_bf_price'.$lot_no.'" readonly>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';

                $ListAllData .='<div class="form-group">';
                $ListAllData .='<label class="font-noraml">Plan Discount </label>';
                $ListAllData .='<div class="input-group col-xs-12">';
                
                $ListAllData .='<input name="txt_discount'.$lot_no.'" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txt_discount'.$lot_no.'" readonly>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';

                $ListAllData .='<div class="form-group">';
                $ListAllData .='<label class="font-noraml">Special Discount </label>';
                $ListAllData .='<div class="input-group col-xs-12">';
                $ListAllData .='<select name="disc'.$lot_no.'" id="disc'.$lot_no.'" onChange="fn_disc(\''.$lot_no.'\')" class="select2_demo_1 required" tabindex="2" data-placeholder="Select Special Discount"                 
                >
                    '.$combo_disc.'
                  </select>'; 
                $ListAllData .='</div>';
                $ListAllData .='<br><div class="input-group col-xs-12">';
                $ListAllData .='<input name="txt_aditional_disc'.$lot_no.'" class="form-control required" align="left" type="input" onchange="hitung_ulang_disc(\''.$lot_no.'\')" id="txt_aditional_disc'.$lot_no.'" >';
                $ListAllData .='</div>';
                $ListAllData .='</div>';

                $ListAllData .='<div class="form-group">';
                $ListAllData .='<label class="font-noraml">Net Price </label>';
                $ListAllData .='<div class="input-group col-xs-12">';
                // $ListAllData .='<input class="form-control" disabled value="" type="text">';
                // $ListAllData .='<label class="control-label" id="txt_netprice'.$lot_no.'"></label>';
                $ListAllData .='<input name="txt_netprice'.$lot_no.'" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txt_netprice'.$lot_no.'" readonly>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';

                $ListAllData .='<div class="form-group">';
                $ListAllData .='<label class="font-noraml">Sales Event </label>';
                $ListAllData .='<div class="input-group col-xs-12">';
                $ListAllData .='<select name="mediacd'.$lot_no.'" id="mediacd'.$lot_no.'" class="select2_demo_1" tabindex="2" data-placeholder="Select Event Method">
                    '.$combo_event.'
                  </select>'; 
                $ListAllData .='</div>';
                $ListAllData .='</div>';

              $ListAllData .='<input type="hidden" id="txt_listamt'.$lot_no.'" name="txt_listamt'.$lot_no.'">';
              $ListAllData .='<input type="hidden" name="txt_tax_cd'.$lot_no.'" id="txt_tax_cd'.$lot_no.'">';
              $ListAllData .='<input type="hidden" id="txt_contractprice'.$lot_no.'" name="txt_contractprice'.$lot_no.'">';
              $ListAllData .='<input type="hidden" id="txt_debtor'.$lot_no.'" name="txt_debtor'.$lot_no.'" >';

                $ListAllData .='</div>';

                
                $ListAllData .='</div>';
                $ListAllData .='</div>';  

                $ListAllData .='                </fieldset>';   
                
            }
        }
        
        $data=array('list_rl_sales'=>$ListAllData,
                    'data_rl_sales'=>$datalist2,
                    'data_cf_business'=>$datalist,
                    'projectName'=>$projectName,
                    'project'=>$project,
                    'property_type'=>$property_type,
                    'unit_book'=>$unit_book);
        $this->load_content_top_menu('StepBooking/SB4',$data);  
    }
    function clear_unit(){
        $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');  
            $lot_no = $this->input->post('id',TRUE);
            $status = $this->input->post('status',TRUE);
            $property_cd = $this->input->post('property_cd',TRUE);  
            $this->session->unset_userdata('property_cd');
            $this->session->unset_userdata('unit_book');

            $arr_unit[]='';
            if(!empty($lot_no)){
                $arr_unit=explode(',', $lot_no);
            
                if(!empty($arr_unit)){
                    foreach ($arr_unit as $key) {
                            // var_dump('tes');
                            // var_dump($key);
                            $data=array('status'=>$status);
                            $where =array('entity_cd'=>$entity,
                                            'project_no'=>$project,
                                            'property_cd'=>$property_cd,
                                            'lot_no'=>$key);
                            $this->m_wsbangun->updateData('pm_lot_web',$data, $where);
                            $this->m_wsbangun->updateData('pm_lot',$data, $where);
                    }
                }   
            }           

            
            $msg="Data has been updated successfully";
                $msg1=array("Pesan"=>$msg);
             echo json_encode($msg1);
    }
    function goto_landed(){
        $property_cd = $this->input->post('property_cd',TRUE);
        $lot_no = $this->input->post('lot_no',TRUE);
        $map_picture = $this->input->post('map_picture',TRUE);

        $data = array("map_picture"=>$map_picture);
        $this->load->view('StepBooking/property_landed',$data);

    }
    function goto_table(){
            $property_cd = $this->input->post('property_cd',TRUE);
            $lot_no = $this->input->post('lot_no',TRUE);
            // $arr_unit='';
            // var_dump($lot_no);
            
            $data = array('userLevelList'=> $this->datatable($property_cd,$lot_no));
            $this->load->view('bookingfloor/table',$data);
        }
    public function data_unit_landed($property_cd,$property_type,$unit=null){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $name = $this->session->userdata('Tsuname');
            $business_id = $this->session->userdata('business_id');
            if(empty($business_id)){
                $business_id ='null';
            }
            if(empty($unit)){
                        $unit = $this->session->userdata('unit_book');
                    }

            if(empty($unit)){
                $unit = null;
            }

            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
            $sql = "SELECT MAX(descs) AS default_value,MAX(map_picture) as map_picture FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '".$entity."' and project_no = '".$project."' and property_cd='".$property_cd."' ";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a='';
            $map_picture ='';
            if(!empty($defaulValue)){
                $a =  $defaulValue[0]->default_value;
                $map_picture = $defaulValue[0]->map_picture; 
            }
            

            $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            
            $sql = "SELECT project_no, property_cd, line_no, descs ,map_picture, rowID, coord, coord_status = ISNULL(coord_status,0) from mgr.cf_property_dtl where property_cd = '".$property_cd."' and coord is not null";
            $query = $this->m_wsbangun->getData_by_query($sql);
            // var_dump($property_cd);
            $areadata[]='';
            $keyarea='';
            if(!empty($query)){
                foreach ($query as $value) {
                    $areadata[] = '<area alt="" title="" onclick="openPage(\''.$value->rowID.'\',\''.$property_cd.'\',\''.$unit.'\')" href="#" shape="circle"  unit="'.$value->rowID.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    
                    if($value->coord_status ==1){
                        $keyarea.='{ key: "'.$value->rowID.'", selected: true}';
                    }

                    // if($value->coord_status ==1){
                    //     $keyarea.='{ key: "'.$value->lot_no.'", selected: true, toolTip: "'.$value->lot_no.'" },';
                                                                                                                                                                                                                                                                     
                    // } else {
                    //      $keyarea.='{ key: "'.$value->lot_no.'", toolTip: "'.$value->lot_no.'" },';
                    // }


                    # code...
                }
                $keyarea.='';
                $areadata = implode("", $areadata);
            }
            $tess='img/FloorPlan/'.$map_picture;
            // $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);

            $data = array(
                                    'dataarea' => $areadata,
                                    'keyarea' => $keyarea,
                                    // 'userLevelList'=>$this->datatable($property_cd,$unit),
                                    'map_picture'=>$tess,
                                    'property_descs'=>$a,
                                    'property_type'=>$property_type,
                                    'property_cd'=>$property_cd,                                
                                    'projectName'=>$projectName,
                                    'backButton'=> $butt,
                                    'business_id'=>$business_id,
                                    'unit_book'=>$unit);
            return $data;
            // $this->load_content_top_menu('bookingfloor/Index', $ContentAllData);
            
    }
    public function showlanddt($lotno = null)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');

        $business_id = $this->session->userdata('business_id');
        if(empty($business_id)){
            $business_id ='null';
        }

        $img ="";
        
    
        if ($handle = opendir('img/LotInfo/new/')) {
            
            $sql = "select * from mgr.v_pm_lot_info where lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
            $data = $this->m_wsbangun->getData_by_query($sql);
            $pic = $data[0]->pic_name;
            
            $thelist='';$list='';$no=1;
            while (false !== ($file = readdir($handle)))
            { 


                if ($file != "." && $file != ".." && substr($file,0,4) == $pic)
                {    
                    if($no==1){
                        $thelist .= '<div class="item active">';
                    }      
                    else {
                        $thelist .= '<div class="item">';
                    }              
                    $thelist .= '<a href="'.base_url('img/LotInfo/new/').$file.'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/new/').$file.'" ></a>';
                    $thelist .= '</div>';
                    $no++;
                }
                    
            }
            if($thelist!=''){

                $list=$thelist;
            }
            else {
                $list .= '<div class="item active">';
                $list .= '<a href="'.base_url('img/LotInfo/new/unavailable.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/new/unavailable.jpg').'" ></a>';
                $list .= '</div>';
            }
            // echo $list;
        }
            closedir($handle);
        
        // var_dump($list);
        
        
        
        $content = array('data' => $data,
            'business_id'=>$business_id,
            'img'=>$list
            );
        $this->load->view('StepBooking/infolanded',$content);
    }
    
    public function data_unit_landdt($rowid,$property_cd,$unit_book=null){
                
            $unit = $this->session->userdata('unit_book');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $business_id = $this->session->userdata('business_id');
            if(empty($business_id)){
                $business_id ='null';
            }
            // $nupno = $this->session->userdata('NupNo');                               
            
             $sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '".$entity."' and project_no = '".$project."' and property_cd='".$property_cd."' ";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a='';
            if(!empty($defaulValue)){
                $a = $defaulValue[0]->default_value;
            }
            
            $pcd = $property_cd;
           
            $sql = "SELECT project_no, property_cd, level_no, lot_no, descs, coord, coord_status = ISNULL(coord_status,0), nup_counter ,status from mgr.pm_lot_web (NOLOCK) where  coord is not null and property_dtl_rowid = '$rowid'";
            $query = $this->m_wsbangun->getData_by_query($sql);        
            // var_dump($query->status);
            $unit_arr[]="";
            if(!empty($unit_book)){
                
                $unit_arr = explode(",", $unit_book);  
            }
            
            // var_dump($unit_arr);
            $areadata[]='';
            $keyarea='';
            if(!empty($query)){
                foreach ($query as $value) {
                    $areadata[] = '<area alt="" data-status="'.$value->status.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    
                    // if($value->coord_status ==1){
                    $ck_in_arr = in_array($value->lot_no, $unit_arr);
                    // if($ck_in_arr){
                    //     $keyarea.='{ key: "'.$value->lot_no.'", selected: true,status:"'.$value->status.'", toolTip: "'.$value->lot_no.'"},';
                    // }else{
                       if($value->status =='R'){
                           
                             $keyarea.='{ key: "'.$value->lot_no.'", selected: true,status:"'.$value->status.'", toolTip: "'.$value->lot_no.'"},';
                        }
                        else{
                            
                            $keyarea.='{ key: "'.$value->lot_no.'",status:"'.$value->status.'", toolTip: "'.$value->lot_no.'"},';
                        } 
                    // }
                    
                   
                    
                }
                $keyarea.='';
                $areadata = implode("", $areadata);
            }

            $tess='';
            
            $where = array(
                            'entity_cd'=>$entity,
                            'project_no'=>$project,
                            'rowID' => $rowid
                            );
            $data = $this->m_wsbangun->getData_by_criteria('cf_property_dtl', $where);
          
            if (!empty($data)) {
                $map_picture = $data[0]->map_picture;         
            }
            $tess='img/FloorPlan/'.$map_picture;

            // $Content = array('dataarea' => $areadata,
            //                 'keyarea' => $keyarea);
             $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            // return $Content;
             $ContentAllData = array(
                                    'dataarea' => $areadata,
                                    'keyarea' => $keyarea,
                                    // 'userLevelList'=>$this->datatable($property_cd,$unit),
                                    'map_picture'=>$tess,
                                    'property_descs'=>$a,
                                    'business_id'=>$business_id,
                                    // 'property_type'=>$property_type,
                                    'property_cd'=>$property_cd,                                
                                    'projectName'=>$projectName,
                                    'rowID'=> $rowid,
                                    'unit_book'=>$unit_book);
            // return $ContentAllData;
            $this->load_content_top_menu('StepBooking/SB2UnitLanddt',$ContentAllData);
            // $this->load_content_top_menu('StepBooking/SB2UnitLanddt',$ContentAllData);
    }
    public function data_unit($property_cd,$property_type){
    	$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $name = $this->session->userdata('Tsuname');
            $unit = $this->session->userdata('unit_book');
            if(empty($unit)){
                $unit = null;
            }
            $business_id = $this->session->userdata('business_id');
            if(empty($business_id)){
                $business_id ='null';
            }
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project);
        	$sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and property_cd='$property_cd' ";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;

            $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            
            

			// $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);

            $ContentAllData = array('userLevelList'=>$this->datatable($property_cd,$unit),
            						'property_descs'=>$a,
                                    'property_type'=>$property_type,
                                    'property_cd'=>$property_cd,           						
                                    'projectName'=>$projectName,
                                    'backButton'=> $butt,
                                    'business_id'=>$business_id,
                                    'unit_book'=>$unit);
            return $ContentAllData;
            // $this->load_content_top_menu('bookingfloor/Index', $ContentAllData);
    }
    public function to_unit($product,$property_cd){
    	$entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $where =array('entity_cd'=>$entity,
        			'project_no'=>$project,
        			'property_cd'=>$property_cd);
        $data = $this->m_wsbangun->getData_by_criteria('cf_property (NOLOCK)',$where);
        $property_type = $data[0]->property_type;
        if($property_type=='A'){
        	$this->load->view('StepBooking/SB2',$data);
        }else{
        	$this->load->view('StepBooking/SB2',$data);
        }
    	
    }
    public function zoom_property_type(){
    	$product_cd = $this->input->post('product_cd', TRUE);
        	$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project,
                        'product_cd'=>$product_cd);
            $table = 'cf_property (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('property_cd', 'descs');

            $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where);

        	// $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
        	echo $cbProp;
        }
    public function go_toPDF(){
    	$this->load->view('StepBooking/viewer');
    }
    public function datatable($property_cd='',$lot_no=null){
        	$ContentAllData ='';
        	$entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            // $table = 'pm_level';
            // $kriteria= array('entity_cd' => $entity, 'project_no' => $project );

            $sql="SELECT * FROM   MGR.PM_LEVEL (NOLOCK) WHERE  ENTITY_CD = '$entity' ";
            $sql.=" AND PROJECT_NO     = '$project' ";
       		$sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.PM_LOT_WEB.LEVEL_NO " ;
            $sql.=" FROM   MGR.PM_LOT_WEB (NOLOCK) " ;
            $sql.=" WHERE  MGR.PM_LOT_WEB.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
            $sql.=" AND MGR.PM_LOT_WEB.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
            $sql.=" AND MGR.PM_LOT_WEB.PROPERTY_CD = '$property_cd')" ;
            // $order = array('seq_no' , 'ASC' );
           /* var_dump($kriteria);*/
           $AllData = $this->m_wsbangun->getData_by_query($sql);
            // $AllData = $this->m_wsbangun->getData_by_criteria($table, $kriteria, null, $order);
            /* $AllData = $this->m_optionFloor->GetAllData();*/           
            /*var_dump($AllData);*/

            $sql2 = "SELECT lot_no, level_no, remarks, status,nup_counter FROM mgr.pm_lot_web";
            $sql2 .= " WHERE entity_cd = '$entity' ";
            $sql2 .= " AND project_no = '$project' ";
            $sql2 .= " AND property_cd = '$property_cd' ";
            $sql2 .= " AND status <> 'H' ";
            $sql2 .= " ORDER by level_no, lot_no";

            $AllDataUnit = $this->m_wsbangun->getData_by_query($sql2);

            $chose_unit[]='';
            if(!empty($lot_no)){
                $chose_unit=explode(',', $lot_no);
            }

            if(!empty($AllData))
            {
                $ListAllData = '';          
                foreach ($AllData as $value) 
                {                    
                    $bb = $value->level_no;

                    $AllDataUnitLevel = array_filter($AllDataUnit,function($a) use($bb) {
                        
                        return $a->level_no === $bb;

                    });
                  
                    $ListAllData .='<tr>';
                    $ListAllData .='<td>'.$value->descs.'</td>';

                        $tes = '<br>';
                        $Listunit = '<td align="left">';
                        $Listunit .= '<div data-toggle="buttons">';
                        if ($AllDataUnitLevel) 
                        {
                            foreach ($AllDataUnitLevel as $key=>$value2) 
                                {
                                    $text_ = $value2->lot_no;
                                    // $text_ .= $tes .'('.$value2->nup_counter.')'; 
                                    if ($value2->status=='A') 
                                    {
                                        $btn = 'btn-success'; 
                                        $href = '';
                                       
                                        // $Listunit .='<b><span><a href="" class="open-AddBookDialog btn btn_block '.$btn.'"  data-id="'.$value2->lot_no.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';

                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;" class = "btn '.$btn.'" value="'.$value2->lot_no.'" onclick="loadinfo(this.value)">'.$text_.'</button>&nbsp;&nbsp;';
                                    }
                                    if ($value2->status=='B') 
                                    {
                                        $btn = 'btn-danger';
                                        $href = ''; 
                                        // $Listunit .='<b><span><a href="" class="book-AddBookDialog btn btn_block '.$btn.'"  data-id="'.$value2->lot_no.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';

                                        
                                            $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;" class = "btn '.$btn.'" value="'.$value2->lot_no.'" disabled onclick="loadinfo(this.value)">'.$text_.'</button>&nbsp;&nbsp;';

                                        
                                        
                                    }
                                    if ($value2->status=='H') 
                                    {
                                        $btn = 'btn-primary';
                                        $href = ''; 
                                        // $Listunit .='<b><span><strong><a href="'.base_url('OptionFloor/lotDetail/'.$value2->lot_no).'" class="btn btn_block '.$btn.'"><strong>'.$value2->lot_no.'</strong></a></strong></span></b>';
                                        $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn '.$btn.'" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" disabled>'.$text_.'</button>&nbsp;&nbsp;';
                                    }
                                    if ($value2->status=='R') 
                                    {
                                        $btn = 'btn-warning';
                                        $href = ''; 
                                        // $Listunit .='<b><span><a href="" class="reserve-AddBookDialog btn btn_block '.$btn.'"  data-id="'.$value2->lot_no.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';
                                        if(in_array($value2->lot_no,$chose_unit)){
                                            $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;" class = "btn '.$btn.'" value="'.$value2->lot_no.'" onclick="loadinfo(this.value)">'.$text_.'</button>&nbsp;&nbsp;';
                                        }else{
                                            $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;" class = "btn '.$btn.'" value="'.$value2->lot_no.'" onclick="loadinfo(this.value)" disabled>'.$text_.'</button>&nbsp;&nbsp;';
                                        }
                                    }
                                    // if(in_array($value2->lot_no, $chose_unit)){
                                    //     if($value2->nup_counter>=3){
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-danger" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" disabled>'.$text_.'</button>';

                                    //    }else{
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px; background: red" class = "btn btn-success" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" readOnly="readOnly">'.$text_.'</button>';
                                    //    }
                                    // }else{
                                    //     if($value2->nup_counter>=3){
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;background: red" class = "btn btn-danger" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" disabled>'.$text_.'</button>';

                                    //    }else{
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;background: blue" class = "btn btn-success" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" readOnly="readOnly">'.$text_.'</button>';
                                    //    }

                                    // }
                                       
                                        
                                      
                                }     
                                
                        }else{
                            $Listunit.='<b><span> UNIT NOT AVALAIBLE </span></b>';
                        }
                        $Listunit .= '</div>';                        
                        $Listunit .= '</td>';
                        // var_dump($Listunit);
                        $ListAllData .= $Listunit;
                     $ListAllData .='</tr>';
                }
                
                $ContentAllData = $ListAllData;
            } 
            return $ContentAllData;

        }
         public function property_type($property_cd=''){
        	$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project);
             $table = 'cf_property (NOLOCK)';
            $obj = array('property_cd', 'descs');
            $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where, $property_cd);

        	// $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
        	return $cbProp;
        }
        public function tes(){
            $product = $this->input->post('tt',TRUE);
            $msg;
            $data=array('Name'=>'TesError',
                        'CounterAA'=>1,
                        'Audit_Date'=>date('d M Y H:i:s'),
                        'Audit_User'=>'otnay');
            $msg='';
            $msg1 = $this->m_wsbangun->insertDataTes('Next_Number', $data);
            if($msg1=='OK'){
                $msg='Data has been Insert successfully';
            }else{
               $msg=$msg1;
               $msg1='fail'; 
            }
            $aa =array('Pesan'=>$msg,
                        'Status'=>$msg1);
            // var_dump($aa);
            // exit;   
            echo json_encode($aa);

        }
        public function showland($lotno = null)
            {
                
                $entity = $this->session->userdata('Tsentity');
                    $project = $this->session->userdata('Tsproject');
                    $projectName = $this->session->userdata('Tsprojectname');
        // var_dump($NupNo);
                    $nupno = $this->session->userdata('NupNo');



                    $img ="";
                $sql = "select * from mgr.v_pm_lot_info where lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
                $data = $this->m_wsbangun->getData_by_query($sql);
                $pic = $data[0]->pic_name;
                // var_dump($pic);
                if ($pic == '111B')
                {
                    $img= '<div class="item active">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/111B01.jpg').'" id="pop" onclick="imgpop(\'111B01.jpg\')">';
                    $img .= '</div>';
                    $img.= '<div class="item ">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/111B02.jpg').'" id="pop" onclick="imgpop(\'111B02.jpg\')">';
                    $img .= '</div>';
                }
                else if ($pic == '112B')
                {
                    $img= '<div class="item active">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/112B01.jpg').'" id="pop" onclick="imgpop(\'112B01.jpg\')">';
                    $img .= '</div>';
                    $img.= '<div class="item ">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/112B02.jpg').'" id="pop" onclick="imgpop(\'112B02.jpg\')">';
                    $img .= '</div>';
                }
                else if ($pic == '11ST')
                {
                    $img= '<div class="item active">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/11ST01.jpg').'" id="pop" onclick="imgpop(\'11ST01.jpg\')">';
                    $img .= '</div>';
                    $img.= '<div class="item ">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/11ST02.jpg').'" id="pop" onclick="imgpop(\'11ST02.jpg\')">';
                    $img .= '</div>';
                }
                else if ($pic == '1201')
                {
                    $img= '<div class="item active">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120101.jpg').'" id="pop" onclick="imgpop(\'120101.jpg\')">';
                    $img .= '</div>';
                    $img.= '<div class="item ">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120102.jpg').'" id="pop" onclick="imgpop(\'120102.jpg\')">';
                    $img .= '</div>';
                }
                else if ($pic == '1202')
                {
                    $img= '<div class="item active">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120201.jpg').'" id="pop" onclick="imgpop(\'120201.jpg\')">';
                    $img .= '</div>';
                    $img.= '<div class="item ">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120202.jpg').'" id="pop" onclick="imgpop(\'120202.jpg\')">';
                    $img .= '</div>';
                    $img.= '<div class="item ">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120203.jpg').'" id="pop" onclick="imgpop(\'120203.jpg\')">';
                    $img .= '</div>';
                }
                else if ($pic == '1203')
                {
                    $img= '<div class="item active">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120301.jpg').'" id="pop" onclick="imgpop(\'120301.jpg\')">';
                    $img .= '</div>';
                    $img.= '<div class="item ">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120302.jpg').'" id="pop" onclick="imgpop(\'120302.jpg\')">';
                    $img .= '</div>';
                    $img.= '<div class="item ">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120303.jpg').'" id="pop" onclick="imgpop(\'120303.jpg\')">';
                    $img .= '</div>';
                }
                else 
                {
                    $img= '<div class="item active">';
                    $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/unavailable.png').'" id="pop" onclick="imgpop(\'unavailable.png\')">';
                    $img .= '</div>';
                   
                }
                
                // var_dump($img);
                
                
                
                $content = array('data' => $data,
                    'img'=>$img
                    
                    );
                $this->load->view('StepBooking/infoaptunit',$content);
            }
        public function isi_data_rl_sales(){
        if(!empty($_POST)){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $webuser = $this->session->userdata('Tsuname');
            $entity_cd      =$entity;
            $project_no     =$project;
            $unit_book         =$this->input->POST('unit_book',true);
            $business_id    =$this->input->POST('business_id');
            $category    =$this->input->POST('category');
            if(empty($category)){
                $category ='C';
            }
            $table = 'pl_project';
                $crit = array('entity_cd'=>$entity,
                    'project_no'=>$project);
                $dtProject = $this->m_wsbangun->getData_by_criteria($table, $crit);
                if(!empty($dtProject)) {
                    $debtorType = $dtProject[0]->debtor_type;
                } else {
                    $debtorType = null;
                    $error = 'debtor_type not set';                    
					$msg1=array("Pesan"=>$error,
                        "Status"=>'error');
						echo json_encode($msg1);
                    return;
                }

                
			$chose_unit[]='';
            if(!empty($unit_book)){
                $chose_unit=explode(',', $unit_book);
            }
            // var_dump($chose_unit);exit();
            // $rowID           =$this->input->POST('rowID');
            foreach($chose_unit as $lot_no){
                $sql = "select max(debtor_acct) as debtor_acct from mgr.rl_sales where entity_cd='".$entity."' and project_no ='".$project."' and lot_no ='".$lot_no."'";
                $data = $this->m_wsbangun->getData_by_query($sql);
                $debtor = $data[0]->debtor_acct;
                // var_dump($debtor);exit();
				$payment_cd     =$this->input->POST('payment'.$lot_no,TRUE);
				// $debtor         =$this->input->POST('txt_debtor'.$lot_no,TRUE);
				
				$list_bf_price  =str_replace(",","",$this->input->POST('txt_list_bf_price'.$lot_no));
				$discount       =str_replace(",","",$this->input->POST('txt_discount'.$lot_no));
				$net_price      =str_replace(",","",$this->input->POST('txt_netprice'.$lot_no));
				$tax_cd         =$this->input->POST('txt_tax_cd'.$lot_no);
				$list_amt       =str_replace(",","",$this->input->POST('txt_listamt'.$lot_no));
				$contract_price =str_replace(",","",$this->input->POST('txt_contractprice'.$lot_no));
// var_dump($list_bf_price);exit();
				// $debtor_acct =$this->input->POST('debtor');
				
				
				$Special_disc_cd    =$this->input->POST('disc'.$lot_no);
				$Special_disc_amt   =str_replace(",","",$this->input->POST('txt_aditional_disc'.$lot_no));
				// var_dump($Special_disc_amt);
				
				$media_cd       =$this->input->POST('mediacd'.$lot_no);
				/*$disc             =$this->input->POST('disc');*/
				$disct_cd       = $this->discount_cd($payment_cd);
				// $aditional_disc = str_replace(",","",$this->input->POST('aditional_disc'));


				$status = 'B';
				

				

				//no delete
				$table = 'cf_agent_dt';
				$crit = array('userid'=>$webuser,
					'entity_cd'=>$entity);
				$dtAgent = $this->m_wsbangun->getData_by_criteria($table, $crit);
				if(!empty($dtAgent)) {
					$agent_cd = $dtAgent[0]->agent_cd;
				} else {
					$agent_cd = null;
					$error = 'Agent not registered';
					$this->index($lot_no, $error);
					return;
				}

			   
				//no delete
				$table = 'rl_spec';
				$submitapp='';
				$dtSpec = $this->m_wsbangun->getData($table);
				if(!empty($dtSpec)){
					$submitapp = $dtSpec[0]->submit_app;    
				}

				// var_dump($aditional_disc); 

				if($submitapp=='N' && $Special_disc_amt==0 ) {
					$status = 'B';
				}else{
					$status = 'E';
				}
				//no delete

				
				
				// if
				$data= array(
						"entity_cd"=>$entity_cd,
						"project_no"=>$project_no,
						// "lot_no"=>$lot_no,
						// "debtor_acct"=>$debtor_acct,
						// "business_id"=>$business_id,
						"category"=>$category,
						"media_cd"=>$media_cd,
						"contract_no"=>'-',
						"staff_in_charge"=>$agent_cd,
						"sales_date"=>date("d M Y"),
						"list_tax_scheme"=>$tax_cd,
						"list_tax_amt"=>(float)$list_amt,
						"list_after_tax_amt"=>(float)$list_amt,
						"list_after_amt"=>($contract_price-$list_amt),
						"list_before_price"=>(float)$list_bf_price,
						"list_price"=>(float)$list_bf_price,
						"disc_cd"=>$disct_cd,
						"disc_amt"=>(float)$discount,
						"sell_price"=>(float)$contract_price,
						"currency_cd"=>"IDR",
						"currency_rate"=>1,
						"status"=>$status,
						"audit_user"=>$webuser,
						"audit_date"=>date("d M Y h:i:s"),
						"payment_cd"=>$payment_cd,
						"sales_type"=>"NA"/*$disc*/,
						// "sales_spv"=>"otnay",
						"debtor_type"=>$debtorType,
						"entitas_cd"=>"L",
						// "disc_status"=>"N",
						// "discount_special_amt"=>(float)$aditional_disc,
						"lot_rowid"=>0,
						"disc_cd_spe"=>$Special_disc_cd,
						"discount_special_amt"=>(float)$Special_disc_amt
						);
				// var_dump($data);
				
					$where=array('entity_cd'=>$entity,
							'project_no'=>$project,
							'lot_no'=>$lot_no);
					$table = 'rl_sales';
					$_result = $this->m_wsbangun->updateData($table,$data,$where);
					if($_result=='OK'){
						$msg = "Data has been Updated successfully";
						$status = "OK";
					}else{
						$msg = $_result;
						$status ="error";
					}
					

				
				
				// if ($data) {
				// 	$this->session->set_userdata('debtr',$debtor_acct);
				// 	$this->session->set_userdata('lotno',$lot_no);
				// 	$this->session->set_userdata('Saudit_user',$webuser);
				// 	$this->session->set_userdata('Sbusiness',$business_id);
					
				// }
				
				$DB2 = $this->load->database('ifca',TRUE);
				$today = date('d M Y');
				$sql = "mgr.xrl_sales_reg_web '".$entity."', '".$project."', '".$lot_no."', '".$debtor."', '".$webuser."' ";
				$result = $DB2->query($sql);
							
				// $result = $this->sp_sales($entity,$project,$lot_no,$debtor_acct,$webuser);
				$where = array('entity_cd'=>$entity,
								'project_no'=>$project_no,
								'debtor_acct'=>$debtor);
				$cnt = $this->m_wsbangun->getCount_by_criteria('rl_sales_payment',$where);
				if($cnt==0){
					$msg='Error SQl Stored Procedure';
					$status='Error';
					$debtor_acct='';
					$this->when_sp_error($entity_cd,$project_no,$lot_no,$debtor);
                    $msg1=array("Pesan"=>$msg,
                        "Status"=>$status);
                    echo json_encode($msg1);
					return;
				}
				
				
				if($submitapp=='N' && $Special_disc_amt==0){        
						 
					$sql2 = "mgr.xrl_billing_chrg '".$entity."', '".$project."', '".$debtor."'";
					$result = $this->m_wsbangun->setData_by_query($sql2);
				   

				}
    //             else{
				// 	$status='Submit';
				// 	$msg.= ", Please do Submit";
				// }
				
			}
            
            $msg1=array("Pesan"=>$msg,
                        "Status"=>$status);
            echo json_encode($msg1);
            // $this->load_content('booking/v_rl_salesSubmit'); 
        }
    }
    public function discount_cd($payment_cd=null)
    {
        $disc_cd='';
        $where = array('payment_status' => 'A', 
                        'payment_cd'=>$payment_cd);
        
        $data = $this->m_wsbangun->getData_by_criteria("rl_payment_plan_hd (NOLOCK) ",$where);
        // $data=$data->result();
        // format keluaran di dalam array
        if($data !='OK'){
            $disc_cd = '';
        }else{
            if(!empty($data)){
            $disc_cd = $data[0]->discount_cd;
            // $debtor_no = substr($debtor_no,1,strlen($debtor_no) );
            }else{
                $disc_cd = '';
            }
        }
        
        
         return $disc_cd;
         

    }
    public function when_sp_error($entity_cd='',$project_no='',$lot_no='',$debtor_acct=''){
        // $where=array('entity_cd'=>$entity_cd,
        //             'project_no'=>$project_no,
        //             'debtor_acct'=>$debtor_acct,
        //             'lot_no'=>$lot_no);
        // $this->m_wsbangun->deletedata('rl_sales',$where);

        $where2=array('entity_cd'=>$entity_cd,
                    'project_no'=>$project_no,
                    'lot_no'=>$lot_no);
        $data =array('status'=>'R');
        $this->m_wsbangun->updateData('pm_lot',$data,$where2);
        $this->m_wsbangun->updateData('pm_lot_web',$data,$where2);


    }
}