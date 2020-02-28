<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class C_mobile_cfld extends Core_Controller
{
	function __construct()
    {
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_login');
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');
    }   


    public function index(){

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
        // $this->session->unset_userdata('unit_loop');        
        // $this->session->userdata('unit_book_temp');

        $table = 'cf_cluster';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);

        $dtProduct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);

        $data=array('product'=>$dtProduct,
                    'project'=>$project,
                    'projectName'=>$projectName);

        // if(!empty($property_type) && !empty($property_cd)){
        //     if($property_type=='A'){
        //         $data = $this->data_unit($property_cd,$property_type);
        //         $this->load_content_top_menu('StepBooking/SB2UnitFloor',$data);
        //     }else if($property_type=='L'){
        //         $data = $this->data_unit_landed($property_cd,$property_type,$unit);
        //         $this->load_content_top_menu('StepBooking/SB2UnitLanded',$data);
        //     }
            
        // }else{
            $this->load_content_top_menu('booking_mobile_cfld/cluster_mobile_cfld',$data);  
        // }
        
    }    
    public function indexPrior(){

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        // $this->session->unset_userdata('unit_loop');        
        // $this->session->userdata('unit_book_temp');

        $table = 'cf_cluster';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);

        $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);

        $data=array('product'=>$dtProduct,
                    'project'=>$project,
                    'projectName'=>$projectName);

        // if(!empty($property_type) && !empty($property_cd)){
        //     if($property_type=='A'){
        //         $data = $this->data_unit($property_cd,$property_type);
        //         $this->load_content_top_menu('StepBooking/SB2UnitFloor',$data);
        //     }else if($property_type=='L'){
        //         $data = $this->data_unit_landed($property_cd,$property_type,$unit);
        //         $this->load_content_top_menu('StepBooking/SB2UnitLanded',$data);
        //     }
            
        // }else{
            $this->load_content_top_menu('booking_mobile_cfld/cluster_mobile_cfldPrior',$data);  
        // }
        
    } 
    public function indexEdit(){

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $Type = $this->session->userdata('TypeScreen');
        // $this->session->unset_userdata('unit_loop');        
        // $this->session->userdata('unit_book_temp');

        $table = 'cf_cluster';
        $crit = array('entity_cd'=>$entity,
            'project_no'=>$project);

        $dtProduct = $this->m_wsbangun->getData_by_criteria($table, $crit);

        $data=array('product'=>$dtProduct,
                    'project'=>$project,
                    'projectName'=>$projectName,
                    'Type'=>$Type);

        // if(!empty($property_type) && !empty($property_cd)){
        //     if($property_type=='A'){
        //         $data = $this->data_unit($property_cd,$property_type);
        //         $this->load_content_top_menu('StepBooking/SB2UnitFloor',$data);
        //     }else if($property_type=='L'){
        //         $data = $this->data_unit_landed($property_cd,$property_type,$unit);
        //         $this->load_content_top_menu('StepBooking/SB2UnitLanded',$data);
        //     }
            
        // }else{
            $this->load_content_top_menu('booking_mobile_cfld/cluster_mobile_cfldEdit',$data);  
        // }
        
    } 
    public function ClusterLanded($Cluster_cd,$TypeRoi,$unit_book=null,$Block=null,$type=null,$direction=null,$Price=null){
        
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $headerid = $this->session->userdata('headerid');
        $unit2 = $this->session->userdata('unit_loop');
        $unit='';
        // $this->session->unset_userdata('unit_book_temp');
        // $this->session->unset_userdata('descs_book_temp');
        $unit_temp = $this->session->userdata('unit_book_temp');

        $lot_descs = $this->session->userdata('descs_book_temp');
        
        $this->session->unset_userdata('descs_book_temp');
        $this->session->set_userdata('descs_book_temp',$lot_descs);
        // var_dump($lot_descs);

        if(empty($unit_temp)){
            
            if(!empty($unit_book)){
                $unit=$unit_book;
            }else{
                $unit = $unit2;
            }
        }else{
            $unit = $unit_temp;
        }
        $cons = $this->session->userdata('Tscons');
        // var_dump($unit);
        // if(empty($unit_book)){

        //     $unit = $unit_temp;

        // }else if(empty($unit_temp)){
        //     $unit = $unit_book;
        // }
        // var_dump($unit_temp);
        	$sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_cluster (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and cluster_cd='$Cluster_cd' ";
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            
        $ContentAllData = array('userLevelList'=>$this->datatableCluster($Cluster_cd,$TypeRoi,$unit,$Block,$type,$direction,$Price),
            						'Cluster_descs'=>$a,
                                    'Cluster_cd'=>$Cluster_cd,           						
                                    'projectName'=>$projectName,
                                    'unit_book'=>$unit_book,
                                    'type'=>$type,
                                    'direction'=>$direction,
                                    'Price'=>$Price,
                                    'Block'=>$Block,
                                    'ms_colour'=>$this->ms_colour_ss("OUT"),
                                    'unit_temp'=>$unit,
                                    'Cluster_cd'=>$Cluster_cd,
                                    'headerid'=>$headerid,
                                    'lot_descs'=>$lot_descs,
                                    'TypeRoi'=>$TypeRoi);
        $this->load_content_top_menu('booking_mobile_cfld/UnitLand_Cluster2',$ContentAllData);  
    }
    public function ClusterLandedEdit($Cluster_cd,$TypeRoi,$unit_book=null,$Block=null,$type=null,$direction=null,$Price=null){
        
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $headerid = $this->session->userdata('headerid');
        $unit2 = $this->session->userdata('unit_loop');
        $unit='';
        // $this->session->unset_userdata('unit_book_temp');
        // $this->session->unset_userdata('descs_book_temp');
        $unit_temp = $this->session->userdata('unit_book_temp');

        $lot_descs = $this->session->userdata('descs_book_temp');
        $headerid = $this->session->userdata('headeridEdit');
        $status = $this->session->userdata('statusEdit');
        $rowID = $this->session->userdata('rowIDEdit');
        $TypeScreen = $this->session->userdata('TypeScreen');
        // var_dump($unit_temp);
        
        

        if(empty($unit_temp)){
            
            if(!empty($unit_book)){
                $unit=$unit_book;
            }else{
                $unit = $unit2;
            }
        }else{
            $unit = $unit_temp;
        }
        // var_dump($unit);
        // if(empty($unit_book)){

        //     $unit = $unit_temp;

        // }else if(empty($unit_temp)){
        //     $unit = $unit_book;
        // }
        // var_dump($unit_temp);
            $sql = "SELECT MAX(descs) AS default_value FROM mgr.cf_cluster (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and cluster_cd='$Cluster_cd' ";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            
        $ContentAllData = array('userLevelList'=>$this->datatableCluster($Cluster_cd,$TypeRoi,$unit,$Block,$type,$direction,$Price),
                                    'Cluster_descs'=>$a,
                                    'Cluster_cd'=>$Cluster_cd,                                  
                                    'projectName'=>$projectName,
                                    'unit_book'=>$unit_book,
                                    'type'=>$type,
                                    'direction'=>$direction,
                                    'Price'=>$Price,
                                    'Block'=>$Block,
                                    'ms_colour'=>$this->ms_colour_ss("OUT"),
                                    'unit_temp'=>$unit,
                                    'Cluster_cd'=>$Cluster_cd,
                                    'headerid'=>$headerid,
                                    'lot_descs'=>$lot_descs,
                                    'TypeRoi'=>$TypeRoi,
                                    'TypeScreen'=>$TypeScreen);
        $this->load_content_top_menu('booking_mobile_cfld/UnitLand_ClusterEdit',$ContentAllData);  
    }

public function datatableCluster($Cluster_cd,$TypeRoi,$lot_no=null,$Block=null,$type=null,$direction=null,$Price=null){

        	$ContentAllData ='';
        	$entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            // $unit = $this->session->userdata('unit_loop');
            // $table = 'pm_level';
            // $kriteria= array('entity_cd' => $entity, 'project_no' => $project );
            // if(empty($lot_no)){
            //     $lot_no =$unit;
            // }
            $cons = $this->session->userdata('Tscons');
             $param=" ";
            if(!empty($Block)){
                if($Block !='null'){
                        $param = $param." AND block_no='".$Block."'";
                    } 
                }
            $sql="SELECT * FROM   MGR.cf_block (NOLOCK) WHERE  ";
            $sql.="  PROJECT_NO     = '$project' ";
       		$sql.=" AND block_no IN (SELECT DISTINCT MGR.PM_LOT_WEB.block_no " ;
            $sql.=" FROM   MGR.PM_LOT_WEB (NOLOCK) " ;
            $sql.=" WHERE MGR.PM_LOT_WEB.PROJECT_NO = MGR.cf_block.PROJECT_NO " ;
            $sql.=" AND MGR.PM_LOT_WEB.cluster_cd = '$Cluster_cd'" ;
            $sql.=" AND MGR.PM_LOT_WEB.status = 'A')";
            $sql.=" $param";
            $sql.=" ORDER BY MGR.cf_block.block_no ASC ";
            // $order = array('seq_no' , 'ASC' );
           /* var_dump($kriteria);*/
           // var_dump($sql);
           $AllData = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
           // var_dump($AllData);
            // $AllData = $this->m_wsbangun->getData_by_criteria($table, $kriteria, null, $order);
            /* $AllData = $this->m_optionFloor->GetAllData();*/           
            /*var_dump($AllData);*/
           
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
                    'PriceID'=>$Price);
            $rst = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property_price (NOLOCK)',$where);
            if(!empty($rst)){
                        $param = $param . " AND (land_price BETWEEN ".$rst[0]->from_price." AND ".$rst[0]->to_price.")";               
            }
            $sql2 = "SELECT lot_no, level_no,block_no, remarks, status,nup_counter,type, descs ";
            $sql2 .= " ,convert(varchar,REVERSE(SUBSTRING(REVERSE(lot_no),0,CHARINDEX('-',REVERSE(lot_no))))) AS Lot_new ";
	        $sql2 .= " ,LEN(convert(varchar,REVERSE(SUBSTRING(REVERSE(lot_no),0,CHARINDEX('-',REVERSE(lot_no)))))) AS LENNGTH ";
            $sql2 .= " FROM mgr.pm_lot_web";
            $sql2 .= " WHERE entity_cd = '$entity' ";
            $sql2 .= " AND project_no = '$project' ";
            $sql2 .= " AND Cluster_cd = '$Cluster_cd' ";
            // $sql2 .= " AND status <> 'H' $param";
            $sql2 .= " AND nup_counter <= 3 ";
            $sql2 .= " AND status = 'A' $param";
            $sql2 .= " ORDER by block_no,LENNGTH,lot_no";
            
            $AllDataUnit = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

            $chose_unit[]='';
            if(!empty($lot_no)){
                $chose_unit=explode(',', $lot_no);
            }
            $colour = $this->ms_colour_ss("IN");
            
            // var_dump($colour["A0"]["fillColor"]);
            if(!empty($AllData))
            {
                $ListAllData = '';          
                foreach ($AllData as $value) 
                {                    
                    $bb = $value->block_no;

                    $AllDataUnitLevel = array_filter($AllDataUnit,function($a) use($bb) {
                        
                        return $a->block_no === $bb;

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
                                    $text_ = $value2->Lot_new;
                                    // $text_ .= $tes .'('.$value2->nup_counter.')'; 
                                    $text_ .= $tes .'('.$value2->type.')'; 
                                    $nupCOunter = $value2->nup_counter;
                                    // var_dump($text_);
                                    $colorBtn = $colour["A".$nupCOunter]["fillColor"];
                                    // if ($value2->status=='A') 
                                    // {
                                        $btn = 'btn-success'; 
                                   if($TypeRoi=='P')
                                   {
                                    if(in_array($value2->lot_no, $chose_unit)){
                                            $cnn = $nupCOunter;
                                            $colorBtn = $colour["A".$cnn]["strokeColor"];
                                           
                                            $Listunit .='<button title="'.$value2->descs.'" type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px; width: 50px;background-color:'.$colorBtn.'" class = "btn " onclick="landinfo(\''.$value2->lot_no.'\',\''.$value2->nup_counter.'\', this,\''.$value2->descs.'\')" readOnly="readOnly">'.$text_.'</button>';
                                           
                                        }
                                    else
                                        {
                                            $Listunit .='<button title="'.$value2->descs.'" type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px; width: 50px;background-color:'.$colorBtn.'" class = "btn " onclick="landinfo(\''.$value2->lot_no.'\',\''.$value2->nup_counter.'\', this,\''.$value2->descs.'\')" readOnly="readOnly">'.$text_.'</button>';
                                           

                                        }
                                   }
                                   else
                                   {
                                    if(in_array($value2->lot_no, $chose_unit)){
                                            $cnn = $nupCOunter;
                                            $colorBtn = $colour["A".$cnn]["strokeColor"];
                                            if($value2->nup_counter>=3){
                                            // $Listunit .='<button title="'.$value2->descs.'" type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px; width: 50px;background-color:'.$colorBtn.'" class = "btn " onclick="landinfo(\''.$value2->lot_no.'\',\''.$value2->nup_counter.'\', this,\''.$value2->descs.'\')" disabled>'.$text_.'</button>';
                                            $Listunit .='<button title="'.$value2->descs.'" type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px; width: 50px;background-color:'.$colorBtn.'" class = "btn " onclick="landinfo(\''.$value2->lot_no.'\',\''.$value2->nup_counter.'\', this,\''.$value2->descs.'\')" >'.$text_.'</button>';

                                           }else{
                                            $Listunit .='<button title="'.$value2->descs.'" type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px; width: 50px;background-color:'.$colorBtn.'" class = "btn " onclick="landinfo(\''.$value2->lot_no.'\',\''.$value2->nup_counter.'\', this,\''.$value2->descs.'\')" readOnly="readOnly">'.$text_.'</button>';
                                           }
                                        }
                                    else
                                        {
                                            if($value2->nup_counter>=3){
                                            $Listunit .='<button title="'.$value2->descs.'" type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px; width: 50px;background-color:'.$colorBtn.'" class = "btn " onclick="landinfo(\''.$value2->lot_no.'\',\''.$value2->nup_counter.'\', this,\''.$value2->descs.'\')" disabled>'.$text_.'</button>';

                                           }else{
                                            $Listunit .='<button title="'.$value2->descs.'" type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px; width: 50px;background-color:'.$colorBtn.'" class = "btn " onclick="landinfo(\''.$value2->lot_no.'\',\''.$value2->nup_counter.'\', this,\''.$value2->descs.'\')" readOnly="readOnly">'.$text_.'</button>';
                                           }

                                        }

                                   }
                                                                           
                                      
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
        public function ms_colour_ss($from){
            $cons = $this->session->userdata('Tscons');
         $nup_colour = $this->m_wsbangun->getData_by_query_cons($cons,"select * from mgr.pm_lot_nup_colour (nolock) ");
             $colour_arr =array();
             // $cc = array();
         // var_dump(count($nup_colour));
             if(!empty($nup_colour)){
                foreach ($nup_colour as $key ) {
                    // $colour_arr["A".$key->counter_id] = array('fillColor'=>substr($key->initial_colour,1),'strokeColor'=>'0000FE');
                    $colour_arr["A".$key->counter_id] = array('fillColor'=>$key->initial_colour,'strokeColor'=>$key->after_choose_colour);
                    // $colour_arr["A".$key->counter_id] = array('fillColor'=>substr($key->initial_colour,1));

                    // $cc[$key->counter_id] = array($key->counter_id=>$colour_arr);

                }
             }
            //  $aa = array('ss'=>$colour_arr);
              //json_encode  
            if($from=="IN"){
                return ($colour_arr); 
            }else{
                return json_encode($colour_arr); 
            }     
    }
        public function Price(){
            $selected_id = $this->input->post('Price', TRUE);
            
            $cons = $this->session->userdata('Tscons');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');

            $where =array('entity_cd'=>$entity,
                    'project_no'=>$project);
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
public function zoom_type(){
        
        $id = $this->input->post('type', TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');
            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
            $table = 'cf_lot_type (NOLOCK)';

            $obj = array('lot_type', 'descs');

            $cbProp = $this->m_wsbangun->getCombo_cons($cons,$table, $obj, $where,$id);

            // return $cbProp;
            echo $cbProp;
    }
    public function zoom_block(){
        
        $id = $this->input->post('Block', TRUE);
        $Cluster_cd = $this->input->post('Cluster_cd', TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
          $cons = $this->session->userdata('Tscons');

            $obj = array('block_no', 'descs');
            
            $tsql  ="Select * from mgr.cf_block (NOLOCK) where project_no='$project' ";
            $tsql .=" and block_no in (select distinct a.block_no from mgr.pm_lot_web a (nolock) ";
            $tsql .=" where a.entity_cd ='$entity' and a.project_no='$project' and cluster_cd='$Cluster_cd')";
            $Data = $this->m_wsbangun->getData_by_query_cons($cons,$tsql);        
            // $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where,$id);
             $combo[] = '<option value=""></option>';
            foreach ($Data as $result) {
                if(trim($result->block_no) == $id) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.$result->block_no.'" '.$selected.'>'.$result->descs.'</option>';
            }
            $cbProp = implode("", $combo); 
            // return $cbProp;
            echo $cbProp;
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
    public function property_image($Type=''){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $tabel2 = 'cf_cluster';
        $kriteria2 = array(
            'entity_cd'=>$entity,
            'project_no'=>$project,
            'Status'=>'Y'
            );

        $datalist2 = $this->m_wsbangun->getData_by_criteria_cons($cons,$tabel2, $kriteria2);
        
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                // $sql = "select descs from mgr.pm_product (NOLOCK) where product_cd='".$value->product_cd."'";
                // $dtproduct = $this->m_wsbangun->getData_by_query($sql);

                $ListAllData .='<div class="col-md-3">';
                $ListAllData .='<div class="ibox">';
                $ListAllData .='<div class="ibox-content product-box">';
                $ListAllData .='<div class="product-imitation">';
                if(!empty($value->pic_name)){                    
                    $a = '<a href="#" id="'.$value->cluster_cd.'" onclick="fn_click_image(\''.$value->cluster_cd.'\',\''.$Type.'\');"><center><img src="'.base_url('img/PlProject/'.$value->pic_name).'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';

                }else{
                    $a = '<a href="#" id="'.$value->cluster_cd.'" onclick="fn_click_image(\''.$value->cluster_cd.'\',\''.$Type.'\');" style="a:focus"><center><img src="'.base_url('img/PlProject/blankproject.png').'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';
                }
                $ListAllData .=$a;
                $ListAllData .='</div>';
                $ListAllData .='<div class="product-desc">'; 
                $ListAllData .='<a href="#" id="'.$value->cluster_cd.'" onclick="fn_click_image(\''.$value->cluster_cd.'\',\''.$Type.'\');" class="product-name">' .$value->descs. '&nbsp; <i class="fa fa-arrow-circle-right"></i><br><div style="font-size:12.5px;">'.$value->descs.'</div></a>';

                // $ListAllData .='<a href="http://www.detik.com" target="_blank">&nbsp;<br>'.$value->http_add.'</a>';                                           
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';               
            }
        }
        $data = array('property_type'=> $ListAllData);
            $this->load->view('booking_mobile_cfld/property_type_mobile',$data);
    }
    public function update_session_mobile(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $lot_no = $this->input->post('id',TRUE);
            $lot_descs = $this->input->post('lot_descs',TRUE);
            //$this->input->post('HeaderID',TRUE);
            $statusEdit = $this->input->post('statusEdit',TRUE);
            $rowIDEdit = $this->input->post('rowID',TRUE);
            $TypeScreen = $this->input->post('Type',TRUE);
            $headeridEdit = (int)$rowIDEdit+1000000;

            $unit_temp = $this->session->userdata('unit_book_temp');
            $descs_temp = $this->session->userdata('descs_book_temp');



            $this->session->set_userdata('headeridEdit', $headeridEdit);
            $this->session->set_userdata('statusEdit', $statusEdit);
            $this->session->set_userdata('rowIDEdit', $rowIDEdit);
            $this->session->set_userdata('TypeScreen', $TypeScreen);

            // if(empty($unit_temp)){
            //     $unit_temp = $lot_no;
            // }else{
                 $unit_arr[]="";
                 $descs_arr[]="";

                // if($status=='A'){
                    $bb='';
                    $cc='';

                    // $unit_arr = explode(",", $unit_temp);
                    // $descs_arr = explode(",", $descs_temp);
                     $unit_arr = explode(",", $lot_no);
                    $descs_arr = explode(",", $lot_descs);
                    // var_dump($descs_arr);
                    // $key = array_search($lot_no, $unit_arr);
                    // $decss_key = array_search($lot_descs, $descs_arr);

                  

                    // foreach (array_keys($descs_arr, $lot_descs) as $dat4) {
                    //     var_dump($dat4);
                    //     unset($descs_arr[$dat4]);
                    // }

                    foreach ($unit_arr as $dat2) {
                        $bb .= $dat2 .',';
                    }

                    foreach ($descs_arr as $dat3) {
                        $cc .= $dat3 .',';
                    }

                    $unit_temp = $bb;
                    $descs_temp = $cc;
                    // var_dump($unit_temp);
                    // var_dump($descs_temp);

                    $abc = strrpos($unit_temp, ",");
                    $unit_temp = substr($unit_temp,0,$abc);

                    $def = strrpos($descs_temp, ",");
                    $descs_temp = substr($descs_temp,0,$def);

                 // }//else{
                 //    if(empty($unit_temp)){
                 //        $unit_temp = $lot_no;
                 //    }else{
                 //        $unit_temp = $unit_temp.','.$lot_no;
                 //    }  

                 //    if(empty($descs_temp)){
                 //        $descs_temp = $lot_descs;
                 //    }else{
                 //        $descs_temp = $descs_temp.','.$lot_descs;
                 //    }
                 // }
                
            // }
            // var_dump($unit_temp);

                 
           
            $this->session->unset_userdata('unit_book_temp');
            $this->session->set_userdata('unit_book_temp', $unit_temp);

            $this->session->unset_userdata('descs_book_temp');
            $this->session->set_userdata('descs_book_temp', $descs_temp);



            // $data=array('status'=>$status);
            // $where =array('entity_cd'=>$entity,
            //                 'project_no'=>$project,
            //                 'property_cd'=>$property_cd,
            //                 'lot_no'=>$lot_no);
            // $msg='';
            // $psn = $this->m_wsbangun->updateData('pm_lot_web',$data, $where);
            // $psn2 = $this->m_wsbangun->updateData('pm_lot',$data, $where);
            // if(!$psn=='OK' && !$psn=='OK'){
            //         $msg = $
            // }else{
                $msg="Data has been updated successfully";
            // }
            
                        
                $msg1=array("Pesan"=>$msg,
                            "status"=>'OK');
             echo json_encode($msg1);
        }
    public function update_status(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $lot_no = $this->input->post('id',TRUE);
            $lot_descs = $this->input->post('lot_descs',TRUE);
            $status = $this->input->post('status',TRUE);
            $unit_temp = $this->session->userdata('unit_book_temp');
            $descs_temp = $this->session->userdata('descs_book_temp');
            var_dump('expression');
            var_dump($descs_temp);



            // if(empty($unit_temp)){
            //     $unit_temp = $lot_no;
            // }else{
                 $unit_arr[]="";
                 $descs_arr[]="";

                if($status=='A'){
                    $bb='';
                    $cc='';

                    $unit_arr = explode(",", $unit_temp);
                    $descs_arr = explode(",", $descs_temp);
                    // var_dump($descs_arr);
                    // $key = array_search($lot_no, $unit_arr);
                    // $decss_key = array_search($lot_descs, $descs_arr);

                    foreach (array_keys($unit_arr,$lot_no) as $dat) {
                        // var_dump($dat);
                        unset($unit_arr[$dat]);
                        unset($descs_arr[$dat]);
                    }

                    // foreach (array_keys($descs_arr, $lot_descs) as $dat4) {
                    //     var_dump($dat4);
                    //     unset($descs_arr[$dat4]);
                    // }

                    foreach ($unit_arr as $dat2) {
                        $bb .= $dat2.',';
                    }

                    foreach ($descs_arr as $dat3) {
                        $cc .= $dat3.',';
                    }

                    $unit_temp = $bb;
                    $descs_temp = $cc;
                    // var_dump($unit_temp);
                    // var_dump($descs_temp);

                    $abc = strrpos($unit_temp,",");
                    $unit_temp = substr($unit_temp,0,$abc);

                    $def = strrpos($descs_temp,",");
                    $descs_temp = substr($descs_temp,0,$def);

                    $sql = "UPDATE mgr.pm_lot_web SET nup_counter= nup_counter-1 ";
                    $sql.= "WHERE lot_no='$lot_no' and project_no='$project' and entity_cd='$entity' ";

                    $sql2 = "UPDATE mgr.pm_lot SET nup_counter= nup_counter-1 ";
                    $sql2.= "WHERE lot_no='$lot_no' and project_no='$project' and entity_cd='$entity' ";

                 }else{
                    if(empty($unit_temp)){
                        $unit_temp = $lot_no;
                    }else{
                        $unit_temp = $unit_temp.','.$lot_no;
                    }  

                    if(empty($descs_temp)){
                        $descs_temp = $lot_descs;
                    }else{
                        $descs_temp = $descs_temp.','.$lot_descs;
                    }

                    $sql = "UPDATE mgr.pm_lot_web SET nup_counter= nup_counter+1 ";
                    $sql.= "WHERE lot_no='$lot_no' and project_no='$project' and entity_cd='$entity' ";

                    $sql2 = "UPDATE mgr.pm_lot SET nup_counter= nup_counter+1 ";
                    $sql2.= "WHERE lot_no='$lot_no' and project_no='$project' and entity_cd='$entity' ";
                 }
                
            // }
            // var_dump($unit_temp);

                 
           
            $this->session->unset_userdata('unit_book_temp');
            $this->session->set_userdata('unit_book_temp',$unit_temp);

            $this->session->unset_userdata('descs_book_temp');
            $this->session->set_userdata('descs_book_temp',$descs_temp);


            
            // $psn = $this->m_wsbangun->setData_by_query($sql);

            
            // $psn2 = $this->m_wsbangun->setData_by_query($sql2);
            // $data=array('status'=>$status);
            // $where =array('entity_cd'=>$entity,
            //                 'project_no'=>$project,
            //                 'property_cd'=>$property_cd,
            //                 'lot_no'=>$lot_no);
            // $msg='';
            // $psn = $this->m_wsbangun->updateData('pm_lot_web',$data, $where);
            // $psn2 = $this->m_wsbangun->updateData('pm_lot',$data, $where);
            // if(!$psn=='OK' && !$psn=='OK'){
            //         $msg = $
            // }else{
                $msg="Data has been updated successfully";
            // }
            
                        
                $msg1=array("Pesan"=>$msg,
                            "status"=>'OK');
             echo json_encode($msg1);
        }
        public function update_status_min_counter(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $lot_no = $this->input->post('id',TRUE);
            $lot_descs = $this->input->post('lot_descs',TRUE);
            $status = $this->input->post('status',TRUE);
            $unit_temp = $this->session->userdata('unit_book_temp');
            $descs_temp = $this->session->userdata('descs_book_temp');



            // if(empty($unit_temp)){
            //     $unit_temp = $lot_no;
            // }else{
                 $unit_arr[]="";
                 $descs_arr[]="";

                if($status=='A'){
                    $bb='';
                    $cc='';

                    $unit_arr = explode(",", $unit_temp);
                    $descs_arr = explode(",", $descs_temp);
                    // var_dump($descs_arr);
                    // $key = array_search($lot_no, $unit_arr);
                    // $decss_key = array_search($lot_descs, $descs_arr);

                    foreach (array_keys($unit_arr,$lot_no) as $dat) {
                        // var_dump($dat);
                        unset($unit_arr[$dat]);
                        unset($descs_arr[$dat]);
                    }

                    // foreach (array_keys($descs_arr, $lot_descs) as $dat4) {
                    //     var_dump($dat4);
                    //     unset($descs_arr[$dat4]);
                    // }

                    foreach ($unit_arr as $dat2) {
                        $bb .= $dat2.',';
                    }

                    foreach ($descs_arr as $dat3) {
                        $cc .= $dat3.',';
                    }

                    $unit_temp = $bb;
                    $descs_temp = $cc;
                    // var_dump($unit_temp);
                    // var_dump($descs_temp);

                    $abc = strrpos($unit_temp,",");
                    $unit_temp = substr($unit_temp,0,$abc);

                    $def = strrpos($descs_temp,",");
                    $descs_temp = substr($descs_temp,0,$def);

                 }else{
                    if(empty($unit_temp)){
                        $unit_temp = $lot_no;
                    }else{
                        $unit_temp = $unit_temp.','.$lot_no;
                    }  

                    if(empty($descs_temp)){
                        $descs_temp = $lot_descs;
                    }else{
                        $descs_temp = $descs_temp.','.$lot_descs;
                    }
                 }
                
            // }
            

                 
           
            $this->session->unset_userdata('unit_book_temp');
            $this->session->set_userdata('unit_book_temp',$unit_temp);

            $this->session->unset_userdata('descs_book_temp');
            $this->session->set_userdata('descs_book_temp',$descs_temp);


            // $sql = "UPDATE mgr.pm_lot_web SET nup_counter= nup_counter-1 ";
            // $sql.= "WHERE lot_no='$lot_no' and project_no='$project' and entity_cd='$entity' ";
            // $psn = $this->m_wsbangun->setData_by_query($sql);

            // $sql2 = "UPDATE mgr.pm_lot SET nup_counter= nup_counter-1 ";
            // $sql2.= "WHERE lot_no='$lot_no' and project_no='$project' and entity_cd='$entity' ";
            // $psn2 = $this->m_wsbangun->setData_by_query($sql2);
            // $data=array('status'=>$status);
            // $where =array('entity_cd'=>$entity,
            //                 'project_no'=>$project,
            //                 'property_cd'=>$property_cd,
            //                 'lot_no'=>$lot_no);
            // $msg='';
            // $psn = $this->m_wsbangun->updateData('pm_lot_web',$data, $where);
            // $psn2 = $this->m_wsbangun->updateData('pm_lot',$data, $where);
            if($psn!='OK' || $psn2!='OK'){
                    $msg = $psn;
            }else{
                $msg="Data has been updated successfully";
            }
            
                        
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


public function zoom_event(){
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
public function zoom_payment_cd(){
       $table = 'rl_payment_plan_hd (nolock)';
        $crit = array('payment_cd', 'descs');
        $where = array('payment_status'=>'A');
        $combo_payment = $this->m_wsbangun->getCombo($table,$crit,$where);
        return $combo_payment;
    }
public function zoom_namaa(){
        $pro = $this->input->post('pro',true);
       $table = 'cf_business';
        $dtBuss = $this->m_wsbangun->getData($table);
        if(!empty($dtBuss)) {
            $comboBus[] = '<option></option>';
            foreach ($dtBuss as $customer) {
                $comboBus[] = '<option value="'.$customer->business_id.'">'.$customer->ic_no.'         - '.$customer->name.'</option>';
            }
            $comboBus = implode("", $comboBus);
        }
        return $comboBus;
    }
public function zoom_nama($bussId){
        
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
         
        $Cluster_cd = $this->input->post('Cluster_cd',TRUE);
        $unit_loop = $this->input->post('unit_loop',TRUE);
        $headerid = $this->input->post('headerid',TRUE);
        $lot_descs = $this->input->post('lot_descs',TRUE);

        $this->session->unset_userdata('Cluster_cd');
        $this->session->unset_userdata('unit_loop');
        $this->session->unset_userdata('unit_book_temp');
        $this->session->unset_userdata('headerid');
        $this->session->unset_userdata('lot_descs');
        // $this->session->unset_userdata('descs_book_temp');

        $this->session->set_userdata('Cluster_cd', $Cluster_cd);
        $this->session->set_userdata('unit_loop', $unit_loop);
        $this->session->set_userdata('headerid',$headerid);
        $this->session->set_userdata('lot_descs',$lot_descs);
        // var_dump($lot_descs);

        $msg1=array("Pesan"=>$this->session->userdata('unit_loop'));
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
                    'product_type'=>$property_type,
                    'business_id'=>$business_id);
        $this->load_content_top_menu('StepBooking/SB3',$data);  
    }
    
public function add_payment($property_type=null){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $unit_book = $this->session->userdata('unit_book');
        $property_cd = $this->session->userdata('property_cd');

        // $this->session->set_userdata('business_id', $business_id);

        // $where= array('business_id'=>$business_id);
        // $datalist = $this->m_wsbangun->getData_by_criteria('cf_business',$where);  
        // $name = $datalist[0]->name;
        $combo_nama = $this->zoom_namaa();

        $combo_payment = $this->zoom_payment_cd();
        
        $combo_event = $this->zoom_event();

        $combo_disc = $this->zoom_discount();

        $chose_unit[]='';
        if(!empty($unit_book)){
            $chose_unit=explode(',', $unit_book);
        }
        $datalist2=$chose_unit;

        // $where= array('entity_cd'=>$entity,
        //               'business_id'=>$business_id);
        // $datalist2 = $this->m_wsbangun->getData_by_criteria('rl_sales',$where);

        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $today = date('Y M d H:i:s');
                // $sales_date = date_create($value->sales_date);
                // $sales_date = date_format($sales_date,"D, d M Y");
                $lot_no = $value;
                // echo $lot_no;
                $ListAllData .='<h1>Unit '.$lot_no.'</h1>';                
                $ListAllData .='<fieldset>';

                $ListAllData .='<div class="col-xs-12">';
                $ListAllData .='<div class="ibox float-e-margins dark-timeline">';
                

            

                $ListAllData .='<div id="ibox-content" class="ibox-content">'; 

                $ListAllData .='<div class="form-group">';
                $ListAllData .='<label class="font-noraml">Name </label>';
                $ListAllData .='<div class="input-group col-xs-12">';
                $ListAllData .='<div class="col-xs-10">';
                $ListAllData .='<select name="nama'.$lot_no.'" id="nama'.$lot_no.'" class="nama select2_demo_1 required" tabindex="2" data-placeholder="Select Customer" style="width:200px">
                    '.$combo_nama.'</select>';
                $ListAllData .='</div>';
                $ListAllData .='<div class="col-xs-2">';
                $ListAllData .='<a class="btn btn-success btn-xs" id="btnaddname" onclick="addnama(\''.$lot_no.'\');"><i class="fa fa-plus"></i></a>
                <a class="btn btn-success btn-xs" id="btneditname" onclick="editnama(\''.$lot_no.'\');"><i class="fa fa-pencil"></i></a>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';

                

                $ListAllData .='<div class="form-group">';
                $ListAllData .='<label class="font-noraml">Payment Method </label>';
                $ListAllData .='<div class="input-group col-xs-12">';
                $ListAllData .='<select name="payment'.$lot_no.'" id="payment'.$lot_no.'" class="select2_demo_1 required" tabindex="2" data-placeholder="Select Payment Method" onChange="tampil_data(\''.$lot_no.'\');">
                    '.$combo_payment.'</select>'; 
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

              $ListAllData .='<input type="hidden" id="lotno'.$lot_no.'" name="lotno'.$lot_no.'" value="'.$lot_no.'">';
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
                    'projectName'=>$projectName,
                    'project'=>$project,
                    'property_cd'=>$property_cd,
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
            $this->session->unset_userdata('unit_book_temp');
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
public function showlanddt($lotno = null){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
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
        $this->load->view('StepBooking/infolanded',$content);
    }
    
public function data_unit_landdt($rowid,$property_cd,$unit_book=null,$type=null,$direction=null,$Price=null){
                
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
            // $this->session->unset_userdata('unit_book_temp');
            $unit_temp = $this->session->userdata('unit_book_temp');
            
            if(empty($unit_temp)){
                $unit_temp ='';
            }
            // $nupno = $this->session->userdata('NupNo');                               
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
            $rst = $this->m_wsbangun->getData_by_criteria('cf_property_price (NOLOCK)',$where);
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
                                    'map_picture'=>$tess,
                                    'property_descs'=>$a,
                                    'business_id'=>$business_id,
                                    // 'property_type'=>$property_type,
                                    'property_cd'=>$property_cd,                                
                                    'projectName'=>$projectName,
                                    'rowID'=> $rowid,
                                    'unit_book'=>$unit_book,
                                    'type'=>$type,
                                    'direction'=>$direction,
                                    'Price'=>$Price,
                                    'unit_temp'=>$unit_temp);
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
        public function showlandEdit($lotno = null)
    {
        
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');

        $nupno = $this->session->userdata('NupNo');

        $business_id = $this->session->userdata('business_id');
        if(empty($business_id)){
            $business_id ='null';
        }

        $img ="";
        
    
        if ($handle = opendir('img/LotInfo/')) {
            
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

        // $this->load->view('booking_cfld/infolanded',$content);StepBooking/infolanded
        $this->load->view('booking_mobile_cfld/infolandedEdit',$content);
    }
public function showland($lotno = null)
    {
        
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
        $nupno = $this->session->userdata('NupNo');

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

        // $this->load->view('booking_cfld/infolanded',$content);StepBooking/infolanded
        $this->load->view('booking_mobile_cfld/infolanded',$content);
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
      
        public function showlandOld($lotno = null)
            {
                
                $entity = $this->session->userdata('Tsentity');
                    $project = $this->session->userdata('Tsproject');
                    $projectName = $this->session->userdata('Tsprojectname');
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
      

        $where2=array('entity_cd'=>$entity_cd,
                    'project_no'=>$project_no,
                    'lot_no'=>$lot_no);
        $data =array('status'=>'R');
        $this->m_wsbangun->updateData('pm_lot',$data,$where2);
        $this->m_wsbangun->updateData('pm_lot_web',$data,$where2);


    }
}