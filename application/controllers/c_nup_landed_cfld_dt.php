<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_nup_landed_cfld_dt extends Core_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_login');
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');
    }   
 
    public function set_session(){
         
        // $property_cd = $this->input->post('property_cd',TRUE);
        $unit_book = $this->input->post('unit_loop',TRUE);
        $headerid = $this->input->post('headerid', TRUE);
        $descs_book = $this->input->post('descs_loop',TRUE);

        // $unit_temp = $this->input->post('unit_temp', TRUE);

        // $this->session->unset_userdata('property_cd');

        $this->session->unset_userdata('unit_loop');
        $this->session->unset_userdata('headerid');
        $this->session->unset_userdata('unit_temp');
        $this->session->unset_userdata('descs_temp');
        $this->session->unset_userdata('descs_loop');

        // $this->session->set_userdata('property_cd', $property_cd);
        $this->session->set_userdata('unit_loop', $unit_book);
        $this->session->set_userdata('headerid', $headerid);
        $this->session->set_userdata('descs_loop', $descs_book);
        // $this->session->set_userdata('unit_temp', $unit_temp);

        $msg1=array("Pesan"=>$this->session->userdata('unit_loop'));
             echo json_encode($msg1);
      
    }
    public function unset_session(){
         
        $property_cd = $this->input->post('property_cd',TRUE);
        

        $this->session->unset_userdata('property_cd');
        $this->session->unset_userdata('unit_book');
        $this->session->unset_userdata('unit_land');
        $this->session->unset_userdata('business_id');
        $this->session->unset_userdata('unit_loop');
        $this->session->unset_userdata('headerid');


        $msg1=array("Pesan"=>"OK");
             echo json_encode($msg1);
      
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
    function goto_table(){
            $property_cd = $this->input->post('property_cd',TRUE);
            $lot_no = $this->input->post('lot_no',TRUE);
            // $arr_unit='';
            // var_dump($lot_no);
            
            $data = array('userLevelList'=> $this->datatable($property_cd,$lot_no));
            $this->load->view('bookingfloor/table',$data);
        }

    public function showlanddt($lotno = null)
    {
        $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');




            $img ="";
        $sql = "select * from mgr.v_pm_lot_info where lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $pic = $data[0]->pic_name;
        // var_dump($pic);
        if ($pic == '111B')
        {
            $img= '<div class="item active">';
            $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/111B01.png').'" id="pop" onclick="imgpop(\'111B01.png\')">';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/111B02.png').'" id="pop" onclick="imgpop(\'111B02.png\')">';
            $img .= '</div>';
        }
        else if ($pic == '112B')
        {
            $img= '<div class="item active">';
            $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/112B01.png').'" id="pop" onclick="imgpop(\'112B01.png\')">';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/112B02.png').'" id="pop" onclick="imgpop(\'112B02.png\')">';
            $img .= '</div>';
        }
        else if ($pic == '11ST')
        {
            $img= '<div class="item active">';
            $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/11ST01.png').'" id="pop" onclick="imgpop(\'11ST01.png\')">';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/11ST02.png').'" id="pop" onclick="imgpop(\'11ST02.png\')">';
            $img .= '</div>';
        }
        else if ($pic == '1201')
        {
            $img= '<div class="item active">';
            $img .=  '<img alt="image"  class="img-responsive"  src="'.base_url('img/LotInfo/120101.jpg').'" id="pop" onclick="imgpop(\'120101.jpg\')">';
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
        $this->load->view('StepBooking/infolanded',$content);
    }
    public function zoom_type(){
        $cons = $this->session->userdata('Tscons');
        $property_cd = $this->input->post('property_cd', TRUE);
        $id = $this->input->post('type', TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project,
                        'property_cd'=>$property_cd);
            $table = 'cf_lot_type (NOLOCK)';

            $obj = array('lot_type', 'descs');

            $cbProp = $this->m_wsbangun->getCombo_cons($cons,$table, $obj, $where,$id);

            // return $cbProp;
            echo $cbProp;
    }
    public function zoom_direction(){
        $cons = $this->session->userdata('Tscons');
        $id = $this->input->post('Direction', TRUE);
            $table = 'cf_direction (NOLOCK)';

            $obj = array('direction_cd', 'descs');

            $cbProp = $this->m_wsbangun->getCombo_cons($cons,$table, $obj,null,$id);

            
            echo $cbProp;
    }
    public function Price(){
            $selected_id = $this->input->post('Price', TRUE);
            // var_dump($selected_id);
            $property_cd = $this->input->post('property_cd', TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');
            $where =array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'property_cd'=>$property_cd);
            $rst = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property_price (NOLOCK)',$where);
            // $rst = $query->result();
            $combo[] = '<option value=""></option>';
            foreach ($rst as $result) {
                if(trim($result->PriceID) == $selected_id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
               $from_price = number_format($result->from_price,2,',','.');
               $to_price =  number_format($result->to_price,2,',','.');
                $combo[] = '<option value="'.trim($result->PriceID).'" '.$selected.'>'.$from_price.' - '.$to_price.'</option>';
            }
            $cbProp = implode("", $combo);  

            
            echo $cbProp;
    }
    public function ms_colour(){
        $cons = $this->session->userdata('Tscons');
        $id = $this->input->post('id', TRUE);
         $nup_colour = $this->m_wsbangun->getData_by_query_cons($cons,"select * from mgr.pm_lot_nup_colour (nolock) ");
             $colour_arr =array();
             // $cc = array();
         // var_dump(count($nup_colour));
             if(!empty($nup_colour)){
                foreach ($nup_colour as $key ) {
                    $colour_arr["A".$key->counter_id] = array('fillColor'=>substr($key->initial_colour,1),
                                                        'strokeColor'=>'0000FE');

                    // $cc[$key->counter_id] = array($key->counter_id=>$colour_arr);

                }
             }
            //  $aa = array('ss'=>$colour_arr);
            echo json_encode($colour_arr);
             // return $colour_arr;
             // var_dump($cc);
            // echo json_encode($cc);
    }
    public function ms_colour_ss(){
        $id = $this->input->post('id', TRUE);
        $cons = $this->session->userdata('Tscons');
         $nup_colour = $this->m_wsbangun->getData_by_query_cons($cons,"select * from mgr.pm_lot_nup_colour (nolock) ");
             $colour_arr =array();
             // $cc = array();
         // var_dump(count($nup_colour));
             if(!empty($nup_colour)){
                foreach ($nup_colour as $key ) {
                    // $colour_arr["A".$key->counter_id] = array('fillColor'=>substr($key->initial_colour,1),'strokeColor'=>'0000FE');
                    $colour_arr["A".$key->counter_id] = array('fillColor'=>substr($key->initial_colour,1),'strokeColor'=>substr($key->after_choose_colour,1));
                    // $colour_arr["A".$key->counter_id] = array('fillColor'=>substr($key->initial_colour,1));

                    // $cc[$key->counter_id] = array($key->counter_id=>$colour_arr);

                }
             }
            //  $aa = array('ss'=>$colour_arr);
            return json_encode($colour_arr);
             // return $ccc;
             // var_dump($cc);
            // echo json_encode($cc);
    }
    public function parampampam(){
        $param = $this->input->post('param', TRUE);
        $param = base64_encode($param);
        echo $param;
    }
    public function showlandxx($lotno = null)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $nupno = $this->session->userdata('NupNo');
        $business_id = $this->session->userdata('business_id');
        if(empty($business_id)){
            $business_id ='null';
        }
        $cons = $this->session->userdata('Tscons');
        $img ="";
        $sql = "select * from mgr.v_pm_lot_info where lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
        $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $pic = $data[0]->pic_name;
        
    
        if ($pic == '111B')
        {
            $img= '<div class="item active">';
            $img .=  '<a href="'.base_url('img/LotInfo/111B01.png').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/111B01.png').'"></a>';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<a href="'.base_url('img/LotInfo/111B02.png').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/111B02.png').'"></a>';
            $img .= '</div>';
        }
        else if ($pic == '112B')
        {
            $img= '<div class="item active">';
            $img .=  '<a href="'.base_url('img/LotInfo/112B01.png').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/112B01.png').'"></a>';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<a href="'.base_url('img/LotInfo/112B02.png').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/112B02.png').'" ></a>';
            $img .= '</div>';
        }
        else if ($pic == '11ST')
        {
            $img= '<div class="item active">';
            $img .=  '<a href="'.base_url('img/LotInfo/11ST01.png').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/11ST01.png').'" ></a>';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<a href="'.base_url('img/LotInfo/11ST02.png').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/11ST02.png').'" ></a>';
            $img .= '</div>';
        }
        else if ($pic == '1201')
        {
            $img= '<div class="item active">';
            $img .=  '<a href="'.base_url('img/LotInfo/120101.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive"  src="'.base_url('img/LotInfo/120101.jpg').'" ></a>';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<a href="'.base_url('img/LotInfo/120102.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120102.jpg').'" ></a>';
            $img .= '</div>';
        }
        else if ($pic == '1202')
        {
            $img= '<div class="item active">';
            $img .=  '<a href="'.base_url('img/LotInfo/120201.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120201.jpg').'" ></a>';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<a href="'.base_url('img/LotInfo/120202.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120202.jpg').'" ></a>';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<a href="'.base_url('img/LotInfo/120203.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120203.jpg').'" ></a>';
            $img .= '</div>';
        }
        else if ($pic == '1203')
        {
            $img= '<div class="item active">';
            $img .=  '<a href="'.base_url('img/LotInfo/120301.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120301.jpg').'" ></a>';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<a href="'.base_url('img/LotInfo/120302.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120302.jpg').'" ></a>';
            $img .= '</div>';
            $img.= '<div class="item ">';
            $img .=  '<a href="'.base_url('img/LotInfo/120303.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/120303.jpg').'" ></a>';
            $img .= '</div>';
        }
        else 
        {
            $img= '<div class="item active">';
            $img .=  '<a href="'.base_url('img/LotInfo/unavailable.png').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/unavailable.png').'" ></a>';
            $img .= '</div>';
           
        }
        
        
        
        
        $content = array('data' => $data,
            'business_id'=>$business_id,
            'img'=>$list
            );

        $this->load->view('booking_cfld/infolanded',$content);
    }
    
    public function showland($lotno = null)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');

        $nupno = $this->session->userdata('NupNo');
        $cons = $this->session->userdata('Tscons');
        $business_id = $this->session->userdata('business_id');
        if(empty($business_id)){
            $business_id ='null';
        }

        $img ="";
        
    
        if ($handle = opendir('img/LotInfo/')) {
            
            $sql = "select * from mgr.v_pm_lot_info where lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
            $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
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
                    $thelist .= '<a href="'.base_url('img/LotInfo/').$file.'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/').$file.'" ></a>';
                    $thelist .= '</div>';
                    $no++;
                }
                    
            }
            if($thelist!=''){

                $list=$thelist;
            }
            else {
                $list .= '<div class="item active">';
                $list .= '<a href="'.base_url('img/LotInfo/unavailable.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/unavailable.jpg').'" ></a>';
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

        $this->load->view('booking_cfld/infolanded',$content);
    }
    public function tes_opendir(){
         if ($handle = opendir('img/LotInfo/')) {
            
            $sql = "select * from mgr.v_pm_lot_info where lot_no='1-1-1' and entity_cd ='2101' and project_no = '210101'";
            $data = $this->m_wsbangun->getData_by_query($sql);
            $pic = $data[0]->pic_name;
            // $pic='sad';
            $thelist='';$list='';
            if($pic)
            while (false !== ($file = readdir($handle)))
            {
                if ($file != "." && $file != ".." && substr($file,0,4) == $pic)
                {                       
                    $thelist .= '<div class="item">';
                    $thelist .= '<a href="'.base_url('img/LotInfo/').$file.'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/').$file.'" ></a>';
                    $thelist .= '</div>';
                }
                    
            }
            if($thelist!=''){

                $list=$thelist;
            }
            else {
                $list .= '<div class="item">';
                $list .= '<a href="'.base_url('img/LotInfo/unavailable.jpg').'" title="Detail Image" data-gallery=""><img alt="image"  class="img-responsive" src="'.base_url('img/LotInfo/unavailable.jpg').'" ></a>';
                $list .= '</div>';
            }
            echo $list;
        }
            closedir($handle);
    }
    

  public function data_unit_landdt($rowid,$property_cd,$unit_book=null,$type=null,$direction=null,$Price=null){
                // var_dump('expression');exit();
            $unit = $this->session->userdata('unit_book');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $business_id = $this->session->userdata('business_id');

            $unit_temp = $this->session->userdata('unit_loop');
            $descs_temp = $this->session->userdata('descs_loop');
            $lot_descs = $this->session->userdata('Tslotdescs');            
            
            // var_dump($Type_roi);

            // var_dump('descs_temp : '.$descs_temp);
            // var_dump('lot_descs : '.$lot_descs);
            // var_dump('unit_temp : '.$unit_temp);
            

            if(empty($unit_book)){
                $unit_book = $unit_temp;
            } else {
                $unit_book = $unit_book;
            }

            // var_dump($unit_temp);
            // var_dump($unit);

            // var_dump($unit_book);

            if(empty($business_id)){
                $business_id ='null';
            }
            // if(empty($param)){
                $param=" ";
            // }else{
            //     $param = base64_decode($param);
            // }
                if(!empty($type)){
                    if($type !='null'){
                        $param = $param." AND type='".$type."'";
                    } 
                }
            if(!empty($direction)){
                if($direction !='null'){
                    $param = $param." AND direction_cd='".$direction."'";
                }
            }
            $cons = $this->session->userdata('Tscons');
            // $Price = '';
            $where =array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'property_cd'=>$property_cd,
                    'PriceID'=>$Price);
            $rst = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property_price (NOLOCK)',$where);
            if(!empty($rst)){
                        $param = $param . " AND (land_price BETWEEN ".$rst[0]->from_price." AND ".$rst[0]->to_price.")";               
            }
            

            
            $sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '".$entity."' and project_no = '".$project."' and property_cd='".$property_cd."' ";
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $a='';
            if(!empty($defaulValue)){
                $a = $defaulValue[0]->default_value;
            }
            
            $pcd = $property_cd;
           
            $sql = "SELECT project_no, property_cd, level_no, lot_no, descs, coord, coord_status = ISNULL(coord_status,0), nup_counter ,status from mgr.pm_lot_web (NOLOCK) where  coord is not null and property_dtl_rowid = '$rowid' and status = 'A' $param";
            $query = $this->m_wsbangun->getData_by_query_cons($cons,$sql);        
            // var_dump($query->status);
            $unit_arr[]="";
            if(!empty($unit_book)){
                if($unit_book=="null"){
                    $unit_book="";
                }else{
                    $unit_arr = explode(",", $unit_book);  
                }
                
            }else{
                $unit_book="";
            }
            
            // var_dump($unit_arr);
            $areadata[]='';
            $keyarea='';
            if(!empty($query)){
                foreach ($query as $value) {
                    // $oncom = "A".$value->nup_counter;
                    $oncom = $value->nup_counter > 3?"A3":"A".$value->nup_counter; 
                    $nupCounterx = $value->nup_counter;
                    // $areadata[] = '<area alt="" data-status="'.$value->status.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    // $areadata[] = '<area alt="" data-status="'.$oncom.'" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    // if($value->coord_status ==1){
                    $ck_in_arr = in_array($value->lot_no, $unit_arr);

                    if($ck_in_arr){
                        $areadata[] = '<area alt="" data-status="'.$oncom.'" data-descs="'.$value->descs.'" data-aktif="A" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    }
                    else{
                        $areadata[] = '<area alt="" data-status="'.$oncom.'" data-descs=" " data-aktif="B" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    }
                    
                   
                       // if($value->status =='R'){
                           
                       //       $keyarea.='{ key: "'.$value->lot_no.'", selected: true,status:"'.$value->status.'", toolTip: "'.$value->lot_no.'"},';
                       //  }
                       //  else{
                            
                            $keyarea.='{ key: "'.$value->lot_no.'",status:"'.$value->status.'", toolTip: "'.$value->descs.'" ,nupCounter :"'.$nupCounterx.'"},';
                        // } 
                    // }
                           
                }
                // $keyarea.='';
                // $areadata = implode("", $areadata);
            }
            $keyarea.='';
            $areadata = implode("", $areadata);

            $tess='';
            
            $sql3 = "SELECT * FROM mgr.cf_property_dtl (NOLOCK) WHERE entity_cd = '".$entity."'AND project_no = '".$project."'AND rowID = '".$rowid."'";
            $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql3); 
          
            if (!empty($data)) {
                $map_picture = $data[0]->map_picture;         
            }
            $tess='img/FloorPlan/'.$map_picture;

            // $Content = array('dataarea' => $areadata,
            //                 'keyarea' => $keyarea);
             $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            // return $Content;
            
             // $ContentAllData = '';
             $cl = $this->ms_colour_ss();
             // var_dump($cl);
             $ContentAllData = array(
                                    'dataarea' => $areadata,
                                    'keyarea' => $keyarea,
                                    // 'TypeList'=>$this->zoom_type($property_cd),
                                    'map_picture'=>$tess,
                                    'property_descs'=>$a,
                                    'business_id'=>$business_id,
                                    // 'Nup_Colour'=>$colour_arr,
                                    'property_cd'=>$property_cd,                                
                                    'projectName'=>$projectName,
                                    'rowID'=> $rowid,
                                    'unit_book'=>$unit_book,
                                    'type'=>$type,
                                    'direction'=>$direction,
                                    'Price'=>$Price,
                                    'ms_colour'=>$cl,
                                    'descs_temp'=>$descs_temp,
                                    'lot_descs'=>$lot_descs
                                    );
            // return $ContentAllData;
            $this->load_content_top_menu('booking_cfld/UnitLanddtCfld',$ContentAllData);
            // $this->load_content_top_menu('StepBooking/SB2UnitLanddt',$ContentAllData);
    }
    public function data_unit_landdtPrior($rowid,$property_cd,$unit_book=null,$type=null,$direction=null,$Price=null){
                
            $unit = $this->session->userdata('unit_book');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $business_id = $this->session->userdata('business_id');
            $cons = $this->session->userdata('Tscons');
            $unit_temp = $this->session->userdata('unit_loop');
            $descs_temp = $this->session->userdata('descs_loop');
            $lot_descs = $this->session->userdata('Tslotdescs');            
            
            // var_dump('descs_temp : '.$descs_temp);
            // var_dump('lot_descs : '.$lot_descs);
            // var_dump('unit_temp : '.$unit_temp);
            

            if(empty($unit_book)){
                $unit_book = $unit_temp;
            } else {
                $unit_book = $unit_book;
            }

            // var_dump($unit_temp);
            // var_dump($unit);

            // var_dump($unit_book);

            if(empty($business_id)){
                $business_id ='null';
            }
            // if(empty($param)){
                $param=" ";
            // }else{
            //     $param = base64_decode($param);
            // }
                if(!empty($type)){
                    if($type !='null'){
                        $param = $param." AND type='".$type."'";
                    } 
                }
            if(!empty($direction)){
                if($direction !='null'){
                    $param = $param." AND direction_cd='".$direction."'";
                }
            }
            // $Price = '';
            $where =array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'property_cd'=>$property_cd,
                    'PriceID'=>$Price);
            $rst = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property_price (NOLOCK)',$where);
            if(!empty($rst)){
                        $param = $param . " AND (land_price BETWEEN ".$rst[0]->from_price." AND ".$rst[0]->to_price.")";               
            }
            

            
            $sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '".$entity."' and project_no = '".$project."' and property_cd='".$property_cd."' ";
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $a='';
            if(!empty($defaulValue)){
                $a = $defaulValue[0]->default_value;
            }
            
            $pcd = $property_cd;
           
            $sql = "SELECT project_no, property_cd, level_no, lot_no, descs, coord, coord_status = ISNULL(coord_status,0), nup_counter ,status from mgr.pm_lot_web (NOLOCK) where  coord is not null and property_dtl_rowid = '$rowid' and status = 'A' $param";
            $query = $this->m_wsbangun->getData_by_query_cons($cons,$sql);        
            // var_dump($query->status);
            $unit_arr[]="";
            if(!empty($unit_book)){
                if($unit_book=="null"){
                    $unit_book="";
                }else{
                    $unit_arr = explode(",", $unit_book);  
                }
                
            }else{
                $unit_book="";
            }
            
            // var_dump($unit_arr);
            $areadata[]='';
            $keyarea='';
            if(!empty($query)){
                foreach ($query as $value) {
                    $oncom = "A".$value->nup_counter;
                    $nupCounterx = $value->nup_counter;
                    // $areadata[] = '<area alt="" data-status="'.$value->status.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    // $areadata[] = '<area alt="" data-status="'.$oncom.'" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    // if($value->coord_status ==1){
                    $ck_in_arr = in_array($value->lot_no, $unit_arr);

                    if($ck_in_arr){
                        $areadata[] = '<area alt="" data-status="'.$oncom.'" data-descs="'.$value->descs.'" data-aktif="A" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    }else{
                        $areadata[] = '<area alt="" data-status="'.$oncom.'" data-descs=" " data-aktif="B" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    }
                    
                   
                       // if($value->status =='R'){
                           
                       //       $keyarea.='{ key: "'.$value->lot_no.'", selected: true,status:"'.$value->status.'", toolTip: "'.$value->lot_no.'"},';
                       //  }
                       //  else{
                            
                            $keyarea.='{ key: "'.$value->lot_no.'",status:"'.$value->status.'", toolTip: "'.$value->descs.'" ,nupCounter :"'.$nupCounterx.'"},';
                        // } 
                    // }
                           
                }
                // $keyarea.='';
                // $areadata = implode("", $areadata);
            }
            $keyarea.='';
            $areadata = implode("", $areadata);

            $tess='';
            
            $sql3 = "SELECT * FROM mgr.cf_property_dtl (NOLOCK) WHERE entity_cd = '".$entity."'AND project_no = '".$project."'AND rowID = '".$rowid."'";
            $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql3); 
          
            if (!empty($data)) {
                $map_picture = $data[0]->map_picture;         
            }
            $tess='img/FloorPlan/'.$map_picture;

            // $Content = array('dataarea' => $areadata,
            //                 'keyarea' => $keyarea);
             $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            // return $Content;
            
             // $ContentAllData = '';
             $cl = $this->ms_colour_ss();
             // var_dump($cl);
             $ContentAllData = array(
                                    'dataarea' => $areadata,
                                    'keyarea' => $keyarea,
                                    // 'TypeList'=>$this->zoom_type($property_cd),
                                    'map_picture'=>$tess,
                                    'property_descs'=>$a,
                                    'business_id'=>$business_id,
                                    // 'Nup_Colour'=>$colour_arr,
                                    'property_cd'=>$property_cd,                                
                                    'projectName'=>$projectName,
                                    'rowID'=> $rowid,
                                    'unit_book'=>$unit_book,
                                    'type'=>$type,
                                    'direction'=>$direction,
                                    'Price'=>$Price,
                                    'ms_colour'=>$cl,
                                    'descs_temp'=>$descs_temp,
                                    'lot_descs'=>$lot_descs
                                    );
            // return $ContentAllData;
            $this->load_content_top_menu('booking_cfld/UnitLanddtCfldPrior',$ContentAllData);
            // $this->load_content_top_menu('StepBooking/SB2UnitLanddt',$ContentAllData);
    }
    public function data_unit_landdtEdit1($rowid,$property_cd,$unit_book=null,$type=null,$direction=null,$Price=null){
                
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
            // if(empty($param)){
                $param=" ";
            // }else{
            //     $param = base64_decode($param);
            // }
                if(!empty($type)){
                    if($type !='null'){
                        $param = $param." AND type='".$type."'";
                    } 
                }
            if(!empty($direction)){
                if($direction !='null'){
                    $param = $param." AND direction_cd='".$direction."'";
                }
            }
            // $Price = '';
            $where =array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'property_cd'=>$property_cd,
                    'PriceID'=>$Price);
            $rst = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property_price (NOLOCK)',$where);
            if(!empty($rst)){
                        $param = $param . " AND (land_price BETWEEN ".$rst[0]->from_price." AND ".$rst[0]->to_price.")";               
            }
            

            
            $sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '".$entity."' and project_no = '".$project."' and property_cd='".$property_cd."' ";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a='';
            if(!empty($defaulValue)){
                $a = $defaulValue[0]->default_value;
            }
            
            $pcd = $property_cd;
           
            $sql = "SELECT project_no, property_cd, level_no, lot_no, descs, coord, coord_status = ISNULL(coord_status,0), nup_counter ,status from mgr.pm_lot_web (NOLOCK) where  coord is not null and property_dtl_rowid = '$rowid' $param";
            $query = $this->m_wsbangun->getData_by_query($sql);        
            // var_dump($query->status);
            $unit_arr[]="";
            if(!empty($unit_book)){
                if($unit_book=="null"){
                    $unit_book="";
                }else{
                    $unit_arr = explode(",", $unit_book);  
                }
                
            }else{
                $unit_book="";
            }
            
            // var_dump($unit_arr);
            $areadata[]='';
            $keyarea='';
            if(!empty($query)){
                foreach ($query as $value) {
                    $oncom = "A".$value->nup_counter;
                    $nupCounterx = $value->nup_counter;
                    // $areadata[] = '<area alt="" data-status="'.$value->status.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    $areadata[] = '<area alt="" data-status="'.$oncom.'" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    // if($value->coord_status ==1){
                    $ck_in_arr = in_array($value->lot_no, $unit_arr);
                    
                   
                       // if($value->status =='R'){
                           
                       //       $keyarea.='{ key: "'.$value->lot_no.'", selected: true,status:"'.$value->status.'", toolTip: "'.$value->lot_no.'"},';
                       //  }
                       //  else{
                            
                            $keyarea.='{ key: "'.$value->lot_no.'",status:"'.$value->status.'", toolTip: "'.$value->descs.'" ,nupCounter :"'.$nupCounterx.'"},';
                        // } 
                    // }
                           
                }
                // $keyarea.='';
                // $areadata = implode("", $areadata);
            }
            $keyarea.='';
            $areadata = implode("", $areadata);

            $tess='';
            
            $sql3 = "SELECT * FROM mgr.cf_property_dtl (NOLOCK) WHERE entity_cd = '".$entity."'AND project_no = '".$project."'AND rowID = '".$rowid."'";
            $data = $this->m_wsbangun->getData_by_query($sql3); 
          
            if (!empty($data)) {
                $map_picture = $data[0]->map_picture;         
            }
            $tess='img/FloorPlan/'.$map_picture;

            // $Content = array('dataarea' => $areadata,
            //                 'keyarea' => $keyarea);
             $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            // return $Content;
            
             // $ContentAllData = '';
             $cl = $this->ms_colour_ss();
             // var_dump($cl);
             $ContentAllData = array(
                                    'dataarea' => $areadata,
                                    'keyarea' => $keyarea,
                                    // 'TypeList'=>$this->zoom_type($property_cd),
                                    'map_picture'=>$tess,
                                    'property_descs'=>$a,
                                    'business_id'=>$business_id,
                                    // 'Nup_Colour'=>$colour_arr,
                                    'property_cd'=>$property_cd,                                
                                    'projectName'=>$projectName,
                                    'rowID'=> $rowid,
                                    'unit_book'=>$unit_book,
                                    'type'=>$type,
                                    'direction'=>$direction,
                                    'Price'=>$Price,
                                    'ms_colour'=>$cl
                                    );
            // return $ContentAllData;
            $this->load_content_top_menu('booking_cfld/UnitLanddtEditCfld',$ContentAllData);
            // $this->load_content_top_menu('StepBooking/SB2UnitLanddt',$ContentAllData);
    }

    // public function data_unit_landdtEdit($rowid,$property_cd,$type=null,$direction=null,$Price=null){
    public function data_unit_landdtEdit($rowid,$property_cd,$statusEdit=null,$Type_roi=null,$unit_book=null,$type=null,$direction=null,$Price=null){
    // public function data_unit_landdtEdit($rowid,$property_cd){
                
            // $unit = $this->session->userdata('unit_book');
            // var_dump($Type_roi);

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $business_id = $this->session->userdata('business_id');
            $unit_temp = $this->session->userdata('unit_loop');
            $lot_descs = $this->session->userdata('Tslotdescs');
            $cons = $this->session->userdata('Tscons');
            // var_dump($lot_descs);

            // $this->session->unset_userdata('headerid');

            $unit = $unit_book; //$this->session->userdata('unit_loop');
            $hid = $this->session->userdata('headerid');
          
            $headerid = $hid;

            if(empty($unit_book)){
                $unit_book = $unit_temp;
            } else {
                $unit_book = $unit_book;
            }
            

            // var_dump($headerid);
            // var_dump($unit);

            if(empty($business_id)){
                $business_id ='null';
            }
            // if(empty($param)){
                $param=" ";
            // }else{
            //     $param = base64_decode($param);
            // }
                if(!empty($type)){
                    if($type !='null'){
                        $param = $param." AND type='".$type."'";
                    } 
                }
            if(!empty($direction)){
                if($direction !='null'){
                    $param = $param." AND direction_cd='".$direction."'";
                }
            }
            $where =array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'property_cd'=>$property_cd,
                    'PriceID'=>$Price);
            $dataPrice = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property_price (NOLOCK)',$where);

            if(!empty($dataPrice)){
                $param = " AND (land_price BETWEEN ".$dataPrice[0]->from_price." AND ".$dataPrice[0]->to_price.")";
                    //         break;";
                    // switch($Price){
                    //     case "1":
                    //         $param = $param . " AND (land_price BETWEEN 0 AND 500000000)";
                    //         break;
                    //     case "2":
                    //     $param = $param . " AND (land_price BETWEEN 500000001 AND 700000000)";
                    //         break;
                    //     case "3":
                    //     $param = $param . " AND (land_price BETWEEN 700000001 AND 1000000000)";
                    //         break;
                    //     case "4":
                    //     $param = $param . " AND (land_price > 1000000000)";
                    //     break;

                    // }                
            }
            

            
            $sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '".$entity."' and project_no = '".$project."' and property_cd='".$property_cd."' ";
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $a='';
            if(!empty($defaulValue)){
                $a = $defaulValue[0]->default_value;
            }
            
            $pcd = $property_cd;
           
            $sql = "SELECT project_no, property_cd, level_no, lot_no, descs, coord, coord_status = ISNULL(coord_status,0), nup_counter ,status from mgr.pm_lot_web (NOLOCK) where  coord is not null and property_dtl_rowid = '$rowid' $param";
            $query = $this->m_wsbangun->getData_by_query_cons($cons,$sql);        
            // var_dump($query->status);
            $unit_arr[]="";
            if(!empty($unit_book)){
                if($unit_book=="null"){
                    $unit_book="";
                }else{
                    $unit_arr = explode(",", $unit_book);  
                }
                
            }else{
                $unit_book="";
            }
            
            // var_dump($unit_arr);
            $areadata[]='';
            $keyarea='';
            if(!empty($query)){
                foreach ($query as $value) {
                    $oncom = "A".$value->nup_counter;
                    $nupCounterx = $value->nup_counter;
                    // $areadata[] = '<area alt="" data-status="'.$value->status.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    
                    // if($value->coord_status ==1){
                    $ck_in_arr = in_array($value->lot_no, $unit_arr);
                    if($ck_in_arr){
                        // var_dump($value->descs);
                        // var_dump($unit_arr);
                        // var_dump('data-key CI : '.$nupCounterx);
                        $areadata[] = '<area alt="" data-status="'.$oncom.'" data-descs="'.$value->descs.'" data-aktif="A" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    }else{
                        $areadata[] = '<area alt="" data-status="'.$oncom.'" data-descs=" " data-aktif="B" data-key="'.$nupCounterx.'" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    }
                   
                       // if($value->status =='R'){
                           
                       //       $keyarea.='{ key: "'.$value->lot_no.'", selected: true,status:"'.$value->status.'", toolTip: "'.$value->lot_no.'"},';
                       //  }
                       //  else{
                            
                            // $keyarea.='{ key: "'.$value->lot_no.'",status:"'.$value->status.'", toolTip: "'.$value->descs.'"},';
                            $keyarea.='{ key: "'.$value->lot_no.'",status:"'.$value->status.'", toolTip: "'.$value->descs.'" ,nupCounter :"'.$nupCounterx.'"},';
                        // } 
                    // }
                    
                   
                    
                }
                // $keyarea.='';
                // $areadata = implode("", $areadata);
            }
            $keyarea.='';
            $areadata = implode("", $areadata);

            $tess='';
            
            $where = array(
                            'entity_cd'=>$entity,
                            'project_no'=>$project,
                            'rowID' => $rowid
                            );
            $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property_dtl', $where);
          
            if (!empty($data)) {
                $map_picture = $data[0]->map_picture;         
            }
            $tess='img/FloorPlan/'.$map_picture;

            // $Content = array('dataarea' => $areadata,
            //                 'keyarea' => $keyarea);
             $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            // return $Content;
            
            $cl = $this->ms_colour_ss();

             $ContentAllData = array(
                                    'dataarea' => $areadata,
                                    'keyarea' => $keyarea,
                                    // 'TypeList'=>$this->zoom_type($property_cd),
                                    'map_picture'=>$tess,
                                    'property_descs'=>$a,
                                    'business_id'=>$business_id,
                                    // 'Nup_Colour'=>$colour_arr,
                                    'property_cd'=>$property_cd,                                
                                    'projectName'=>$projectName,
                                    'rowID'=> $rowid,
                                    'unit_book'=>$unit,
                                    'type'=>$type,
                                    'direction'=>$direction,
                                    'Price'=>$Price,
                                    'headerid'=>$headerid,
                                    'ms_colour'=>$cl,
                                    'statusEdit'=>$statusEdit,
                                    'lot_descs'=>$lot_descs,
                                    'Type_roi'=>$Type_roi);
            // return $ContentAllData;
            $this->load_content_top_menu('booking_cfld/UnitLanddtEditCfld',$ContentAllData);
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
        
        
   
}