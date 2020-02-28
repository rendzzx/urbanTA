<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_nup_unitApartement extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_booking_by_floor');
        $this->load->model('m_wsbangun');

        date_default_timezone_set('Asia/Jakarta');

    }
      public function index($rowID=null, $LotQty=null, $NupNO=null, $new = null,$pay=null,$add=null)
        { 
            // var_dump($new);exit;
            $entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');

        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project);
        	$sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 and property_type='A'";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $b = 'L';
            $row_index = $rowID + 1000000;
            // var_dump($this->level($b)); exit;
            $sql="select choose_unit_status from mgr.rl_reserve_nup (NOLOCK) where entity_cd='$entity' and project_no ='$project' and nup_no='$NupNO'";
            $DataUnitStatus = $this->m_wsbangun->getData_by_query($sql);
            $unit_status = $DataUnitStatus[0]->choose_unit_status;
            
            if($unit_status=='Y'){
                    $backurl = base_url("c_nup_dt/list_dtNew/$NupNO/1/$row_index/A");     
            }else{
                $backurl = base_url("c_choose_unit_nup/indexNew");     
            }


			// $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);

            // $dt = $this->datatable($a);
            // var_dump($dt); exit;
            // $dtr = array('dt' => $dt);

            // var_dump($dtr); 

            $ContentAllData = array(
                                    'userLevelList'=>$this->datatable($a, $b,$new),
            						'property_type'=>$this->property_type($a),
            						'project_name'=>$projectName,
                                    'RowID'=> $rowID,
                                    'LotQty'=>$LotQty,
                                    'NupNO'=>$NupNO,
                                    'backurl'=>$backurl,
                                    'level_no'=>$this->level('in',$a),
                                    'row_index' =>$row_index,
                                    'unit'=>$new,
                                    'pay'=>$pay,
                                    'add'=>$add
                                    );


            $this->load_content_top_menu('booking/v_nup_unit', $ContentAllData);

            // $tblHd = 'v_rl_reserve_nup_hd';
            // $critHd = array('entity_cd'=>$entity,
            //         'project_no'=>$project,
            //         'rowID'=>$rowID);

            // $data = $this->m_wsbangun->getData_by_criteria($tblHd, $critHd);
            // $isiData = array('isiData' => $data);

            // var_dump($isiData);

            /*
            var_dump($AllData);*/
        }


        public function indexNew($rowID=null, $LotQty=null, $NupNO=null)
        { 
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');

            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
            $sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 and property_type = 'A'";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $b = 'L';             

            $ContentAllData = array(
                                    'userLevelList'=>$this->datatable($a, $b),
                                    'property_type'=>$this->property_type($a),
                                    'project_name'=>$projectName,
                                    'RowID'=> $rowID,
                                    'LotQty'=>$LotQty,
                                    'NupNO'=>$NupNO,
                                    'level_no'=>$this->level('in',$a)
                                    );


            $this->load->view('booking/v_nup_unitNew', $ContentAllData);

        }
        public function goto_info($payment=null,$lotno=null){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $sql = "SELECT price_HC = CONVERT(varchar, CAST(trx_amt AS money), 1),* from mgr.v_pm_lot_info where payment_cd='$payment' AND lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
        $data = $this->m_wsbangun->getData_by_query($sql);

        $content = array('data' => $data, );
        $this->load->view('booking/tableapt',$content);
        }
        function goto_table($property_cd = null, $level_no = null){ 
            $property_cd = $this->input->post('property_cd',TRUE);
            $level_no = $this->input->post('level_no',TRUE);
            $lot_no = $this->input->post('lot_no',TRUE);
            // var_dump($property_cd);
            // var_dump($level_no); exit;
        	$data = array('userLevelList'=> $this->datatable($property_cd, $level_no,$lot_no));
            // var_dump($data);
        	$this->load->view('booking/table',$data);
        }

        function goto_table2($property_cd = null, $level_no = null, $lot_no = null){ 
            // $property_cd = $this->input->post('property_cd',TRUE);
            // $level_no = $this->input->post('level_no',TRUE);
            // $lot_no = $this->input->post('lot_no',TRUE);
            var_dump($lot_no);
            // var_dump($level_no); exit;
            $data = array('userLevelList'=> $this->datatable($property_cd, $level_no,$lot_no));
            // var_dump($data);
            $this->load->view('booking/table',$data);
        }

        public function property_type($property_cd=''){
        	$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project,
                        'property_type'=>'A');
            $table = 'cf_property (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('property_cd', 'descs');

            $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where, $property_cd);

        	// $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
        	return $cbProp;
        }

        // public function level($property_cd='', $level_no=''){
        public function level($from = '',$property_code=''){
            
            if($property_code!=''){
                $property_cd = $property_code;
            }else{
                $property_cd = $this->input->post('property_cd', TRUE);
            }
            
            $level_no = $this->input->post('level_no', TRUE);

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            
            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project,
                        'property_cd'=>$property_cd);

            $table = 'v_pm_lot_level (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('level_no', 'descs');

            $cbLvl = $this->m_wsbangun->getCombo($table, $obj, $where, $level_no); 

            // $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
            // return $cbLvl;
            
            if($from == 'in'){
                return $cbLvl;     
            }else{
                echo $cbLvl;    
            }
            
        }

        public function datatable($property_cd='', $level_no = '',$lot_no=null){

        	$ContentAllData ='';
        	$entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            // $table = 'pm_level';
            // $kriteria= array('entity_cd' => $entity, 'project_no' => $project );
            $level_param = '';

            // if(!empty($level_no)){
            //     $level_param = " AND level_no = '$level_no' ";
            // }

            if($level_no <> 'L'){
                $level_param = " AND level_no = '$level_no' ";
            }

            // var_dump($property_cd);
            // var_dump($level_no);


            $sql="SELECT level_no, descs FROM   MGR.PM_LEVEL (NOLOCK) WHERE  ENTITY_CD = '$entity' ";
            $sql.=" AND PROJECT_NO     = '$project' ".$level_param."";
       		$sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.PM_LOT_WEB.LEVEL_NO " ;
            $sql.=" FROM   MGR.PM_LOT_WEB (NOLOCK) " ;
            $sql.=" WHERE  MGR.PM_LOT_WEB.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
            $sql.=" AND MGR.PM_LOT_WEB.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
            $sql.=" AND MGR.PM_LOT_WEB.PROPERTY_CD = '$property_cd'" ;
            $sql.=" AND ISNULL(MGR.PM_LOT_WEB.NUP_COUNTER,0) < 3";
            $sql.=" AND MGR.PM_LOT_WEB.STATUS = 'A')"; 

            // echo $sql; exit;        
            
            $AllData = $this->m_wsbangun->getData_by_query($sql);
           
            // $sql2 = "SELECT lot_no, level_no, remarks, status,isnull(nup_counter,0) AS nup_counter FROM mgr.pm_lot_web WHERE entity_cd = '$entity'";
            // $sql2 .= " AND project_no = '$project' ";
            // $sql2 .= " AND property_cd = '$property_cd' ".$level_param."";
            // $sql2 .= " AND status = 'A' ";
            // // $sql2 .= " AND ISNULL(nup_counter,0) < 3";
            // $sql2 .= " ORDER by level_no, lot_no";
            $sql2 = "SELECT  project_no = mgr.pm_lot_web.project_no  ,property_cd = mgr.pm_lot_web.property_cd";
            $sql2.= ",level_no = mgr.pm_lot_web.level_no ,lot_no = mgr.pm_lot_web.lot_no ";
            $sql2 .= ",theme = mgr.pm_theme.descs,descs = mgr.pm_lot_web.descs   ,type   ,build_up_area  ,land_area ";
            $sql2 .= ",coord  ,coord_status = ISNULL(coord_status, 0) ,nup_counter ";
            $sql2 .= ",type_descs = (select descs from mgr.cf_lot_type (NOLOCK) where lot_type= type) ";
            $sql2 .= ",price_HC = CONVERT(varchar, CAST(mgr.pm_lot_price.trx_amt AS money), 1) ";
            $sql2 .= ",nup_counter = mgr.pm_lot_web.nup_counter ";
            $sql2 .= "    FROM mgr.pm_lot_web(NOLOCK) left outer join mgr.pm_lot_price (NOLOCK) ";
            $sql2 .= "    On mgr.pm_lot_web.entity_cd = mgr.pm_lot_price.entity_cd ";
            $sql2 .= "    and  mgr.pm_lot_web.project_no = mgr.pm_lot_price.project_no ";
            $sql2 .= "    and  mgr.pm_lot_web.lot_no = mgr.pm_lot_price.lot_no ";
            $sql2 .= "    and  mgr.pm_lot_price.Hc ='Y' ";
            $sql2 .= "    LEFT OUTER JOIN mgr.pm_theme(NOLOCK)";
            $sql2 .= "    ON mgr.pm_lot_web.theme_cd = mgr.pm_theme.theme_cd";
            $sql2 .= "    WHERE mgr.pm_lot_web.property_cd ='$property_cd' ";
            $sql2 .= "     AND mgr.pm_lot_web.entity_cd = '$entity' ";
            $sql2 .= "    AND mgr.pm_lot_web.project_no = '$project'  ".$level_param;
            // var_dump($sql2);
            // var_dump($sql);
            $AllDataUnit = $this->m_wsbangun->getData_by_query($sql2);

           // $ContentAllData = array('AllData' => $AllData, 
           //              'AllDataUnit' => $AllDataUnit);

           // return $ContentAllData;
           // var_dump($Data); exit;
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

                        /*$entity = $this->session->userdata('Tsentity');*/
                        // $project = $this->session->userdata('Tsproject');
                        // $table2 = 'pm_lot_web';
                        // $level = $value->level_no;
                        // $kriteria2 = array('entity_cd' => $entity, 'project_no' => $project, 'level_no' => $level,'status '=>'A', 'ISNULL(nup_counter,0) <' => 3, 'property_cd' =>$property_cd);
                        // $AllDataUnit = $this->m_wsbangun->getData_by_criteria($table2, $kriteria2);
                        // var_dump($AllDataUnit);
                        $tes = '<br>';
                        $Listunit = '<td align="left">';
                        $Listunit .= '<div data-toggle="buttons">';
                        if ($AllDataUnitLevel) 
                        {
                            foreach ($AllDataUnitLevel as $key=>$value2) 
                                {
                                    $text_ = $value2->lot_no;
                                    $text_ .= $tes .'('.$value2->nup_counter.')'; 
                                    $title = $value2->descs." (".$value2->lot_no.") &#013;";//"Tes satu: &#013; apa aja";
                                    $title .="Type : ".$value2->type_descs."&#013;";
                                    $title .="Semi Gross Area : ".$value2->build_up_area."&#013;";
                                    $title .="Harga Hardcash : ".$value2->price_HC."&#013;";
                                    $title .="Unit Counter Qty : ".$value2->nup_counter."&#013;";

                                    // if(in_array($value2->lot_no, $chose_unit)){
                                    //     if($value2->nup_counter>=3){
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" disabled>'.$text_.'</button>';

                                    //    }else{
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px; background: red" class = "btn btn-primary" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly">'.$text_.'</button>';
                                    //    }
                                    // }else{
                                    //     if($value2->nup_counter>=3){
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" disabled>'.$text_.'</button>';

                                    //    }else{
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-primary" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly">'.$text_.'</button>';
                                    //    }

                                    // }

                                    if(in_array($value2->lot_no, $chose_unit)){
                                        if($value2->nup_counter>=5){
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" disabled data-html="true" title="'.$title.'">'.$text_.'</button>';

                                       }else{
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly" data-html="true" title="'.$title.'">'.$text_.'</button>';
                                       }
                                    }else{
                                        if($value2->nup_counter>=5){
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" disabled data-html="true" title="'.$title.'">'.$text_.'</button>';

                                       }else{
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-primary" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly" data-html="true" title="'.$title.'">'.$text_.'</button>';
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
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-danger" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" disabled>'.$text_.'</button>';

                                    //    }else{
                                    //     $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-success" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" readOnly="readOnly">'.$text_.'</button>';
                                    //    }

                                    // }
                                       
                                        
                                      
                                }     
                                // exit;
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

        public function showland($lotno = null)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');

        $nupno = $this->session->userdata('NupNo');

        $img ="";
        
        $sql4="SELECT DISTINCT payment_cd from mgr.pm_lot_price (NOLOCK) where lot_no ='$lotno' and HC='Y' ORDER by payment_cd";
        $payment = $this->m_wsbangun->getData_by_query($sql4);
        $payment = $payment[0]->payment_cd;
        // var_dump($lotno);

        $table = 'v_payment_plan (nolock)';
        $object = array('payment_cd', 'descs');
        $where = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'lot_no' =>$lotno);
        $cbpayment = $this->m_wsbangun->getCombo($table,$object,$where);

        // $table = ''
        // var_dump($cbpayment);

    
        if ($handle = opendir('img/LotInfo/new/')) {
            
            $sql = "select price_HC = CONVERT(varchar, CAST(trx_amt AS money), 1), * from mgr.v_pm_lot_info where HC='Y' AND lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
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
        // var_dump($img);
        
        
        
        $content = array('data' => $data,
            'img'=>$list,
            'cbpayment'=>$cbpayment,
            'payment'=>$payment
            
            );
        $this->load->view('booking/infoapt',$content);
    }

        public function showland2($lotno = null)
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
                $this->load->view('booking/infoapt',$content);
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
        	$this->m_wsbangun->updateData('pm_lot_web',$data, $where);
        	$this->m_wsbangun->updateData('pm_lot',$data, $where);
                        $msg="Data has been updated successfully"; 
				$msg1=array("Pesan"=>$msg);
             echo json_encode($msg1);
        }
        public function lotDetail($id = null)
        {
           if (!is_null($id)) 
           {
                $entity = $this->session->userdata('Tsentity');
                $project = $this->session->userdata('Tsproject');

                $table3 = 'pm_lot';
                $content = array('entity_cd' => $entity,
                                'project_no' => $project,
                                'lot_no' => $id
                                );
                $lotData = $this->m_wsbangun->getData_by_criteria($table3, $content);
                if ($lotData) 
                {
                    $table = 'cf_property';
                    $kriteria = array('entity_cd' => $entity,
                                    'project_no' => $project,
                                    'property_cd' => $lotData[0]->property_cd
                                     );
                    $lotData2 = $this->m_wsbangun->getData_by_criteria($table, $kriteria);
                    $property_desc = $lotData2[0]->descs;
                    $status = array('A'=>'Available',
                                'B'=>'Booked',
                                'R'=> 'Reserved',
                                'H'=>'Hold');
                    $new = $status[$lotData[0]->status];
                    // var_dump($new);
                    if ($lotData2) 
                    {
                        $table1 = 'pm_level';
                        $kriteria1 = array('entity_cd' => $entity,
                                    'project_no' => $project,
                                    'level_no' => $lotData[0]->level_no
                                    );
                        $lotData1 = $this->m_wsbangun->getData_by_criteria($table1, $kriteria1);
                        $level_desc = $lotData1[0]->descs;
                    }
                    if ($lotData1) 
                    {
                        $table4 = 'cf_lot_type';
                        $kriteria4 = array('lot_type' => $lotData[0]->type);
                        $lotData4 = $this->m_wsbangun->getData_by_criteria($table4, $kriteria4);
                        $type = $lotData4[0]->descs;
                    }
                    if($lotData4)
                    {
                        $dataCount = round(($lotData[0]->land_net_price)+($lotData[0]->package_net_price)+($lotData[0]->other_net_amt));
                    }
                }
            }
            $Data = array('lot_no' => $lotData,
                        'property_descs'=> $property_desc,
                        'level_descs'=> $level_desc,
                        'status'=>$new,
                        'type'=>$type,
                        'dataCount'=>$dataCount
                        );

            $this->load_content('floorPlan/lot_detail', $Data); 
        }

        public function booking()
        {
            /*redirect('c_rl_sales');*/
            $this->load_content('booking/v_rl_sales');
        }

        function sessions($value)
        {
           $this->session->set_userdata('lot_parm',$value);
           $lot_parm = $this->session->userdata('lot_parm');
           // var_dump($lot_parm);
        }
        public function validasiNew(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $user = $this->session->userdata('Tsuname');
            $psn='';
            // $add = '';
            // $pay = '';
            // $msg="";
            if($_POST){

                $lotNumber = $this->input->post('LotNumber', TRUE);                
                // $NupNo_ = $this->input->post('nupno', TRUE);
                $PLotQty = $this->input->post('lotqty', TRUE);
                $PRowID = $this->input->post('rowid', TRUE);
                $xlot_no = $this->input->post('xlot_no', TRUE);
                // $additional = $this->input->post('add',TRUE);
                $payment = $this->input->post('pay',TRUE);
               
                $xdata = explode(',', $xlot_no);


                $data=explode(',', $lotNumber);
                $countArray = count($data);

                // $add = explode(',', $additional);
                // $pay = explode(',', $payment);

                
              
                
                $category_string = "'" . implode("','",$data) . "'";

                // $count = "SELECT COUNT(*) as cnt FROM mgr.rl_reserve_nup_dt (NOLOCK) WHERE lot_no NOT IN ($category_string) and nup_rowid = $PRowID";
                // $countResult = $this->m_wsbangun->getData_by_query($count);
                // $a = $countResult[0]->cnt;

                // var_dump($a);
                if(!empty($xdata)){
                    foreach ($xdata as $value) {
                                    $updateCntr = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = '$value' and entity_Cd = '$entity' and project_no = '$project' and nup_counter > 0");
                                
                                    if ($updateCntr == 'OK'){
                                        $msg='Data has been saved successfully';
                                        $notif = 'OK';
                                        $psn = 'OK';
                                    } else {
                                        $msg=$updateCntr;
                                        $notif = 'OK';
                                        $psn = 'Failed';
                                    }
                               
                    }

                }
                

                foreach ($data as $val) {
                   
                    $lotCount = "SELECT COUNT (*) as cnt FROM mgr.pm_lot_web (NOLOCK) WHERE entity_Cd = '$entity' and project_no = '$project' and lot_no ='$val' and ISNULL(nup_counter,0) > 4";
                    $lotResult = $this->m_wsbangun->getData_by_query($lotCount);
                    $b = $lotResult[0]->cnt;
                    // var_dump($lotCount);exit();

                    $sql1 = "SELECT business_id, nup_no FROM mgr.rl_reserve_nup (NOLOCK) WHERE rowID = $PRowID";
                    $row1 = $this->m_wsbangun->getData_by_query($sql1);
                    $NupNo = $row1[0]->nup_no;
                    // var_dump($PRowID);
                    // var_dump($NupNo);exit();
                    // $NupNo =$NupNo_;

                    if($b > 0){
                        $msg = "This unit ['".$val."'] has been choosen more than 5";
                        $notif = 'GAGAL';

                        $msg1=array('Pesan'=>$msg,
                                     'nup'=>$NupNo,
                                     'notif'=>$notif);

                        echo json_encode($msg1);

                        exit;
                    }else{
                        // $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                        
                        // $count = "SELECT COUNT (*) as cnt from mgr.rl_reserve_nup_dt where nup_no = '$NupNo' and lot_no = '$val'";
                        // $countRs = $this->m_wsbangun->getData_by_query($count);
                        // $hasil = $countRs[0]->cnt;
                        // if($hasil == 0){
                        //     $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                        // }

                        $count = "SELECT COUNT (*) as cnt from mgr.rl_reserve_nup_dt where nup_no = '$NupNo' and lot_no = '$val'";
                        $countRs = $this->m_wsbangun->getData_by_query($count);
                        $hasil = $countRs[0]->cnt;
                        if($hasil == 0){
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                            $updateCntr = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                            // $data = array('nup_counter'=>ISNULL(nup_counter,0) + 1);

                            // $where =array('lot_no'=>$val,
                            //     'entity_Cd'=>$entity,
                            //     'project_no'=>$project);

                            // $updateCntr = $this->m_wsbangun->updateData('mgr.pm_lot',$data,$where);
                            if ($updateCntr == 'OK'){
                                $msg='Data has been saved successfully';
                                $notif = 'OK';
                                $psn = 'OK';
                            } else {
                                $msg=$updateCntr;
                                $notif = 'OK';
                                $psn = 'Failed';
                            }

                          
                        }
                       


                    }                   
                    
                }

                // var_dump($a);

                // $TotCount = $countArray + $a;
                $TotCount = $countArray;

                
                $where=array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'nup_no'=>$NupNo);
                $this->m_wsbangun->deletedata('rl_reserve_nup_dt',$where);
                // var_dump('selesai');


                // $tblDt = 'rl_reserve_nup_dt';
               

                // $updateCntr2 = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = 'AP010001' and entity_Cd = '$entity' and project_no = '$project'");

                $tblHd = 'v_rl_reserve_nup_hd';
                $critHd = array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'nup_no'=>$NupNo);

                $dataHd = $this->m_wsbangun->getData_by_criteria($tblHd,$critHd);
                $TotQty = $dataHd[0]->total_dtl;
                $LotQty = $dataHd[0]->nup_lot_qty;
                $blnc = $LotQty - $TotQty;
                
                // var_dump($blnc);
                if((int)$blnc >= (int)$TotCount){
                    for ($x = 0; $x <= $countArray-1; $x++) {
                        $datax = array();

                        $countDt = "SELECT count(*) as cnt FROM mgr.rl_reserve_nup_dt WHERE nup_rowid = $PRowID and lot_no = '$data[$x]' ";
                        $dtResult = $this->m_wsbangun->getData_by_query($countDt);
                        $c = $dtResult[0]->cnt;
                        // var_dump($c);

                        if($c == 0){
                            // $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");



                            $sql2 = "SELECT rowid, property_cd, type, nup_counter from mgr.pm_lot_web (nolock) where entity_cd = '$entity' and project_no = '$project' and lot_no = '$data[$x]' ";
                            $row2 = $this->m_wsbangun->getData_by_query($sql2);
                            // $property_type = $row2[0]->property_type;                           
                            
                            if(!empty($payment)){
                                $datax = array(
                                                'entity_cd' => $entity,
                                                'project_no' => $project,
                                                'business_id' => $row1[0]->business_id,
                                                'nup_no' => $NupNo,
                                                'lot_no' => $data[$x],
                                                'property_type' => $row2[0]->property_cd,
                                                'lot_type'=>$row2[0]->type,
                                                'STATUS'=>'A',
                                                'audit_user'=>$user,
                                                'audit_date'=>date('d M Y H:i:s'),
                                                'lot_rowid'=>$row2[0]->rowid,
                                                'nup_rowid'=>$PRowID,                                                
                                                'payment_cd'=>$payment//,
                                                // 'additional_cd'=>$add[$x]
                                                );
                            } else {
                                $datax = array(
                                                'entity_cd' => $entity,
                                                'project_no' => $project,
                                                'business_id' => $row1[0]->business_id,
                                                'nup_no' => $NupNo,
                                                'lot_no' => $data[$x],
                                                'property_type' => $row2[0]->property_cd,
                                                'lot_type'=>$row2[0]->type,
                                                'STATUS'=>'A',
                                                'audit_user'=>$user,
                                                'audit_date'=>date('d M Y H:i:s'),
                                                'lot_rowid'=>$row2[0]->rowid,
                                                'nup_rowid'=>$PRowID,
                                                );
                            }
                            $sql ="Update mgr.rl_reserve_nup set Choose_unit_status ='Y' where entity_cd='$entity' and project_no='$project' and nup_no='$NupNo' ";
                            $updatenupHd = $this->m_wsbangun->setData_by_query($sql);
                            $insert = $this->m_wsbangun->insertData('rl_reserve_nup_dt', $datax);
                            if ($insert == 'OK')
                            {
                                $msg='Data has been saved successfully';
                                $notif = 'OK';
                                $psn = 'OK';
                            } else {
                                $msg=$insert;
                                $notif = 'OK';
                                $psn = 'Failed';
                            }
                            
                        }else{
                            $msg='Data has been saved successfully';
                            $notif = 'OK';
                            $psn = 'OK';
                        } 
                        // $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]'"); 
                        // $this->m_wsbangun->updateData('rl_reserve_nup_dt', $data[$x], 'lot_no');
                    }
                }else{
                    if($blnc > 1){
                        $tobe = "are ";
                    }else{
                        $tobe = "is ";
                    }

                    $msg = "Maximum Lot Number " .$tobe." ".$PLotQty;
                    $notif = 'GAGAL';
                    // echo $msg;
                    // redirect('c_nup_unit/index/'.$PRowID.'/'.$PLotQty);
                }

                 $msg1=array('Pesan'=>$msg,
                 'nup'=>$NupNo,
                 'notif'=>$notif,
                 'status'=>$psn);
            }

            echo json_encode($msg1);
        }
        public function validasi2(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $user = $this->session->userdata('Tsuname');
            $psn='';
            // $add = '';
            // $pay = '';
            // $msg="";
            if($_POST){

                $lotNumber = $this->input->post('LotNumber', TRUE);                
                // $NupNo_ = $this->input->post('nupno', TRUE);
                $PLotQty = $this->input->post('lotqty', TRUE);
                $PRowID = $this->input->post('rowid', TRUE);
                $xlot_no = $this->input->post('xlot_no', TRUE);
                $additional = $this->input->post('add',TRUE);
                $payment = $this->input->post('pay',TRUE);
               
                $xdata = explode(',', $xlot_no);


                $data=explode(',', $lotNumber);
                $countArray = count($data);

                $add = explode(',', $additional);
                $pay = explode(',', $payment);

                
              
                
                $category_string = "'" . implode("','",$data) . "'";

                // $count = "SELECT COUNT(*) as cnt FROM mgr.rl_reserve_nup_dt (NOLOCK) WHERE lot_no NOT IN ($category_string) and nup_rowid = $PRowID";
                // $countResult = $this->m_wsbangun->getData_by_query($count);
                // $a = $countResult[0]->cnt;

                // var_dump($a);

                foreach ($xdata as $value) {
                        // $count = "select count(*) as cnt FROM mgr.pm_lot where lot_no = '$value'";
                        // $countRs = $this->m_wsbangun->getData_by_query($count);
                        // $hasil = $countRs[0]->cnt;
                        // if($hasil == 0){
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                            // $nC = $value->nup_counter
                            // if($value->nup_counter >= 1 || $value->nup_counter <= 3){

                            // if(!empty($value)){
                                // $qnc = "SELECT nup_counter from mgr.pm_lot WHERE lot_no = '$value' and entity_Cd = '$entity' and project_no = '$project'";
                                // var_dump($qnc);
                                // $ncresult = $this->m_wsbangun->getData_by_query($qnc);
                                // $nc = $ncresult[0]->nup_counter;
                                
                                // if($nc == 'NULL' || $nc == ''){
                                //     $nc = 0;
                                // }
                                // var_dump($nc);exit;

                                // if($nc >= 1 || $nc <= 3){
                                    $updateCntr = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = '$value' and entity_Cd = '$entity' and project_no = '$project' and nup_counter > 0");
                                
                                    if ($updateCntr == 'OK'){
                                        $msg='Data has been saved successfully';
                                        $notif = 'OK';
                                        $psn = 'OK';
                                    } else {
                                        $msg=$updateCntr;
                                        $notif = 'OK';
                                        $psn = 'Failed';
                                    }
                                // }
                            // }
                                

                            
                        // }
                }

                foreach ($data as $val) {
                   
                    $lotCount = "SELECT COUNT (*) as cnt FROM mgr.pm_lot_web (NOLOCK) WHERE entity_Cd = '$entity' and project_no = '$project' and lot_no ='$val' and ISNULL(nup_counter,0) > 4";
                    $lotResult = $this->m_wsbangun->getData_by_query($lotCount);
                    $b = $lotResult[0]->cnt;
                    // var_dump($lotCount);exit();

                    $sql1 = "SELECT business_id, nup_no FROM mgr.rl_reserve_nup (NOLOCK) WHERE rowID = $PRowID";
                    $row1 = $this->m_wsbangun->getData_by_query($sql1);
                    $NupNo = $row1[0]->nup_no;
                    // var_dump($PRowID);
                    // var_dump($NupNo);exit();
                    // $NupNo =$NupNo_;

                    if($b > 0){
                        $msg = "This unit ['".$val."'] has been choosen more than 5";
                        $notif = 'GAGAL';

                        $msg1=array('Pesan'=>$msg,
                                     'nup'=>$NupNo,
                                     'notif'=>$notif);

                        echo json_encode($msg1);

                        exit;
                    }else{
                        // $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                        
                        // $count = "SELECT COUNT (*) as cnt from mgr.rl_reserve_nup_dt where nup_no = '$NupNo' and lot_no = '$val'";
                        // $countRs = $this->m_wsbangun->getData_by_query($count);
                        // $hasil = $countRs[0]->cnt;
                        // if($hasil == 0){
                        //     $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                        // }

                        $count = "SELECT COUNT (*) as cnt from mgr.rl_reserve_nup_dt where nup_no = '$NupNo' and lot_no = '$val'";
                        $countRs = $this->m_wsbangun->getData_by_query($count);
                        $hasil = $countRs[0]->cnt;
                        if($hasil == 0){
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                            $updateCntr = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                            // $data = array('nup_counter'=>ISNULL(nup_counter,0) + 1);

                            // $where =array('lot_no'=>$val,
                            //     'entity_Cd'=>$entity,
                            //     'project_no'=>$project);

                            // $updateCntr = $this->m_wsbangun->updateData('mgr.pm_lot',$data,$where);
                            if ($updateCntr == 'OK'){
                                $msg='Data has been saved successfully';
                                $notif = 'OK';
                                $psn = 'OK';
                            } else {
                                $msg=$updateCntr;
                                $notif = 'OK';
                                $psn = 'Failed';
                            }

                            //  $msg1=array('Pesan'=>$msg,
                            // 'nup'=>$NupNo,
                            // 'notif'=>$notif);

                            // echo json_encode($msg1); 
                        }
                        // else{
                        //     $updateCntr = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                           
                        //     if ($updateCntr == 'OK'){
                        //         $msg='Data has been saved successfully';
                        //         $notif = 'OK';
                        //         $psn = 'OK';
                        //     } else {
                        //         $msg=$updateCntr;
                        //         $notif = 'OK';
                        //         $psn = 'Failed';
                        //     }
                        // }


                    }                   
                    
                }

                // var_dump($a);

                // $TotCount = $countArray + $a;
                $TotCount = $countArray;

                // var_dump($TotCount);

                
                // $NupNo = array('NupNo' =>$row1[0]->nup_no);
                // var_dump($NupNo);

                // $sql3 = "SELECT nup_lot_qtr FROM mgr.v_rl_reserve_nup_hd WHERE rowID = $PRowID";
                // $query3 = $this->m_wsbangun->getData_by_query($sql3);

                // var_dump($query3);

                // $a = $row1[0]->business_id;
                // // var_dump($a);
                // var_dump($PLotQty);
                // var_dump($TotCount);

                // foreach ($data as $val) {
                    // $updateCntr2 = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                //     if ($updateCntr == 'OK'){
                //         $msg='Data has been saved successfully';
                //         $notif = 'OK';
                //         $psn = 'OK';
                //     } else {
                //         $msg=$updateCntr;
                //         $notif = 'OK';
                //         $psn = 'Failed';
                //     }
                // }
                
                // $where=array('entity_cd'=>$entity,
                //     'project_no'=>$project,
                //     'nup_no'=>$NupNo);
                // $dataDt = $this->m_wsbangun->getData_by_criteria('rl_reserve_nup_dt',$where);
                // var_dump('expression');
                // var_dump($dataDt);
                // $lotNo = $dataDt[0]->lot_no;

                // $updateCntr2 = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = 'AP010002' and entity_Cd = '$entity' and project_no = '$project'");
                // var_dump($NupNo);
                // var_dump('mulai');
                $where=array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'nup_no'=>$NupNo);
                $this->m_wsbangun->deletedata('rl_reserve_nup_dt',$where);
                // var_dump('selesai');


                // $tblDt = 'rl_reserve_nup_dt';
               

                // $updateCntr2 = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = 'AP010001' and entity_Cd = '$entity' and project_no = '$project'");

                $tblHd = 'v_rl_reserve_nup_hd';
                $critHd = array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'nup_no'=>$NupNo);

                $dataHd = $this->m_wsbangun->getData_by_criteria($tblHd,$critHd);
                $TotQty = $dataHd[0]->total_dtl;
                $LotQty = $dataHd[0]->nup_lot_qty;
                $blnc = $LotQty - $TotQty;
                
                // var_dump($blnc);
                if((int)$blnc >= (int)$TotCount){
                    for ($x = 0; $x <= $countArray-1; $x++) {
                        $datax = array();

                        $countDt = "SELECT count(*) as cnt FROM mgr.rl_reserve_nup_dt WHERE nup_rowid = $PRowID and lot_no = '$data[$x]' ";
                        $dtResult = $this->m_wsbangun->getData_by_query($countDt);
                        $c = $dtResult[0]->cnt;
                        // var_dump($c);

                        if($c == 0){
                            // $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");



                            $sql2 = "SELECT rowid, property_cd, type, nup_counter from mgr.pm_lot_web (nolock) where entity_cd = '$entity' and project_no = '$project' and lot_no = '$data[$x]' ";
                            $row2 = $this->m_wsbangun->getData_by_query($sql2);
                            // $property_type = $row2[0]->property_type;                           
                            
                            if(!empty($payment)){
                                $datax = array(
                                                'entity_cd' => $entity,
                                                'project_no' => $project,
                                                'business_id' => $row1[0]->business_id,
                                                'nup_no' => $NupNo,
                                                'lot_no' => $data[$x],
                                                'property_type' => $row2[0]->property_cd,
                                                'lot_type'=>$row2[0]->type,
                                                'STATUS'=>'A',
                                                'audit_user'=>$user,
                                                'audit_date'=>date('d M Y H:i:s'),
                                                'lot_rowid'=>$row2[0]->rowid,
                                                'nup_rowid'=>$PRowID,                                                
                                                'payment_cd'=>$pay[$x],
                                                'additional_cd'=>$add[$x]
                                                );
                            } else {
                                $datax = array(
                                                'entity_cd' => $entity,
                                                'project_no' => $project,
                                                'business_id' => $row1[0]->business_id,
                                                'nup_no' => $NupNo,
                                                'lot_no' => $data[$x],
                                                'property_type' => $row2[0]->property_cd,
                                                'lot_type'=>$row2[0]->type,
                                                'STATUS'=>'A',
                                                'audit_user'=>$user,
                                                'audit_date'=>date('d M Y H:i:s'),
                                                'lot_rowid'=>$row2[0]->rowid,
                                                'nup_rowid'=>$PRowID,
                                                );
                            }

                            $insert = $this->m_wsbangun->insertData('rl_reserve_nup_dt', $datax);
                            if ($insert == 'OK')
                            {
                                $msg='Data has been saved successfully';
                                $notif = 'OK';
                                $psn = 'OK';
                            } else {
                                $msg=$insert;
                                $notif = 'OK';
                                $psn = 'Failed';
                            }
                            
                        }else{
                            $msg='Data has been saved successfully';
                            $notif = 'OK';
                            $psn = 'OK';
                        } 
                        // $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]'"); 
                        // $this->m_wsbangun->updateData('rl_reserve_nup_dt', $data[$x], 'lot_no');
                    }
                }else{
                    if($blnc > 1){
                        $tobe = "are ";
                    }else{
                        $tobe = "is ";
                    }

                    $msg = "Maximum Lot Number " .$tobe." ".$PLotQty;
                    $notif = 'GAGAL';
                    // echo $msg;
                    // redirect('c_nup_unit/index/'.$PRowID.'/'.$PLotQty);
                }

                 $msg1=array('Pesan'=>$msg,
                 'nup'=>$NupNo,
                 'notif'=>$notif,
                 'status'=>$psn);
            }

            echo json_encode($msg1);
        }

        public function validasi(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $user = $this->session->userdata('Tsuname');

            if($_POST){

                $lotNumber = $this->input->post('LotNumber', TRUE);                
                $PRowID = $this->input->post('rowid', TRUE);
                $PLotQty = $this->input->post('lotqty', TRUE);
                
                $data=explode(',', $lotNumber);
                $countArray = count($data);                
                
                $category_string = "'" . implode("','",$data) . "'";

                // $count = "SELECT COUNT(*) as cnt FROM mgr.rl_reserve_nup_dt (NOLOCK) WHERE lot_no NOT IN ($category_string) and nup_rowid = $PRowID";
                // $countResult = $this->m_wsbangun->getData_by_query($count);
                // $a = $countResult[0]->cnt;

                $lotCount = "SELECT COUNT (*) as cnt FROM mgr.pm_lot_web (nolock) WHERE entity_Cd = '$entity' and project_no = '$project' and lot_no in ($category_string) and ISNULL(nup_counter,0) > 2";
                $lotResult = $this->m_wsbangun->getData_by_query($lotCount);
                $b = $lotResult[0]->cnt;

                $sql1 = "SELECT business_id, nup_no FROM mgr.rl_reserve_nup WHERE rowID = $PRowID";
                $row1 = $this->m_wsbangun->getData_by_query($sql1);
                $NupNo = $row1[0]->nup_no;

                if($b > 0){
                    $msg = "This unit has been choosen more than 3";
                    $notif = 'GAGAL';

                    $msg1=array('Pesan'=>$msg,
                                 'nup'=>$NupNo,
                                 'notif'=>$notif);

                    echo json_encode($msg1);

                    exit;
                }else{
                    $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no in ($category_string) and entity_Cd = '$entity' and project_no = '$project'");
                    $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no in ($category_string) and entity_Cd = '$entity' and project_no = '$project'");
                }

                $TotCount = $countArray;

                if($TotCount <= $PLotQty && $b == 0){
                    for ($x = 0; $x <= $countArray-1; $x++) {
                        $datax = array();

                        $countDt = "SELECT count(*) as cnt FROM mgr.rl_reserve_nup_dt WHERE nup_rowid = $PRowID and lot_no = '$data[$x]'";
                        $dtResult = $this->m_wsbangun->getData_by_query($countDt);
                       
                        // if ($dtResult == 'OK'){
                            $c = $dtResult[0]->cnt;    
                        // }
                        

                        if($c == 0){
                           
                            $sql2 = "SELECT rowid, property_cd, type, nup_counter from mgr.pm_lot_web (nolock) where entity_cd = '$entity' and project_no = '$project' and lot_no = '$data[$x]' ";
                            $row2 = $this->m_wsbangun->getData_by_query($sql2);

                                    $datax = array(
                                                'entity_cd' => $entity,
                                                'project_no' => $project,
                                                'business_id' => $row1[0]->business_id,
                                                'nup_no' => $row1[0]->nup_no,
                                                'lot_no' => $data[$x],
                                                'property_type' => $row2[0]->property_cd,
                                                'lot_type'=>$row2[0]->type,
                                                'STATUS'=>'A',
                                                'audit_user'=>$user,
                                                'audit_date'=>date('d M Y H:i:s'),
                                                'lot_rowid'=>$row2[0]->rowid,
                                                'nup_rowid'=>$PRowID
                                                );

                            $insert = $this->m_wsbangun->insertData('rl_reserve_nup_dt', $datax);

                            if($insert == 'OK'){
                                $msg='Data has been saved successfully';
                                $notif = 'OK';    
                            }else{
                                 $msg= $insert;
                                 $notif = "Failed";
                            }
                            
                        }else{
                            $msg='Data has been saved successfully';
                            $notif = 'OK';
                        } 
                      
                    }
                }else{
                    if($PLotQty > 1){
                        $tobe = "are ";
                    }else{
                        $tobe = "is ";
                    }

                    $msg = "Maximum Lot Number " .$tobe." ".$PLotQty;
                    $notif = 'GAGAL';
                }

                 $msg1=array('Pesan'=>$msg,
                 'nup'=>$NupNo,
                 'notif'=>$notif);
            }

            echo json_encode($msg1);
        }

}