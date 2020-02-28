<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class C_nup_landed extends Core_Controller
{
	
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_booking_by_floor');
        $this->load->model('m_wsbangun');

        $this->load->model('m_sms');

        date_default_timezone_set('Asia/Jakarta');

    }
    

    public function indexland($NupNo=null, $rowid = null, $property_cd = null, $rowid_index=null, $status_index=null,$balance = null,$RowHdr=null,$unit=null,$selected_unit=null,$selected_pay=null,$selected_add=null)
    // public function indexland()
        {
            // $unitt='';
            // if($unit=='0')
            // {
            //     $unitt='0';
            // } else {
            //     $unitt=$unit;
            // }
            $rowidd=$rowid;            // var_dump($balance);
            // $NupNo= $this->input->post('nupno',TRUE);
            // $rowid = $this->input->post('rowid',TRUE);
            // $property_cd = $this->input->post('pcd',TRUE);
            // $balance = $this->input->post('balance',TRUE);
            // $selected_unit=$this->input->post('selected_unit',TRUE);

            $unit_arr[]='';
            $unit_arr = explode(",", $selected_unit);
            // var_dump($unit_arr);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
// var_dump($NupNo);
            $nupno = $this->session->userdata('NupNo');
            
           
            
            if (!empty($NupNo)) {
                $nupno = $NupNo;
            }
// exit;
            $name = $this->session->userdata('Tsuname');
            // var_dump($name);
            $sys = $this->session->userdata('Tsysadmin');
            $approver = 1;
            

            $pcd = $property_cd;
            $blnc = $balance;
            // var_dump($pcd);
            // $sql = "SELECT project_no, property_cd, level_no, lot_no, descs, coord, coord_status = ISNULL(coord_status,0), nup_counter from mgr.pm_lot_web (NOLOCK) where  coord is not null and property_dtl_rowid = '$rowid'";
            // $query = $this->m_wsbangun->getData_by_query($sql);
            // $nupCounter = $query[0]->nup_counter;
            $sql = "SELECT  project_no = mgr.pm_lot_web.project_no  ,property_cd = mgr.pm_lot_web.property_cd";
            $sql .= ",level_no = mgr.pm_lot_web.level_no ,lot_no = mgr.pm_lot_web.lot_no ";
            $sql .= ",theme = mgr.pm_theme.descs,descs = mgr.pm_lot_web.descs   ,type   ,build_up_area  ,land_area ";
            $sql .= ",coord  ,coord_status = ISNULL(coord_status, 0) ,nup_counter ";
            $sql .= ",type_descs = (select descs from mgr.cf_lot_type (NOLOCK) where lot_type= type) ";
            $sql .= ",price_HC = CONVERT(varchar, CAST(mgr.pm_lot_price.trx_amt AS money), 1) ";
            $sql .= ",nup_counter = mgr.pm_lot_web.nup_counter ";
            $sql .= "    FROM mgr.pm_lot_web(NOLOCK) left outer join mgr.pm_lot_price (NOLOCK) ";
            $sql .= "    On mgr.pm_lot_web.entity_cd = mgr.pm_lot_price.entity_cd ";
            $sql .= "    and  mgr.pm_lot_web.project_no = mgr.pm_lot_price.project_no ";
            $sql .= "    and  mgr.pm_lot_web.lot_no = mgr.pm_lot_price.lot_no ";
            $sql .= "    and  mgr.pm_lot_price.Hc ='Y' ";
            $sql .= "    LEFT OUTER JOIN mgr.pm_theme(NOLOCK)";
            $sql .= "    ON mgr.pm_lot_web.theme_cd = mgr.pm_theme.theme_cd";
            $sql .= "    WHERE coord IS NOT NULL ";
            $sql .= "    AND mgr.pm_lot_web.property_dtl_rowid = '$rowid' ";
            $sql .= "    AND mgr.pm_lot_web.entity_cd = '$entity' ";
            $sql .= "    AND mgr.pm_lot_web.project_no = '$project' ";
            $query = $this->m_wsbangun->getData_by_query($sql);
            $nupCounter = $query[0]->nup_counter;

            
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $map_picture = $this->input->post('map_picture',TRUE);
            $areadata[]='';
            $keyarea='';
            if(!empty($query)){
                foreach ($query as $value) {                    
                    $nupCounterx = $value->nup_counter;
                    // var_dump($nupCounterx);

                    // if($nupCounterx == 0){
                    //     $areadata[] = '<area data-key="free" class="free" alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';    
                    // }else if ($nupCounterx <= 2) {
                    //     $areadata[] = '<area data-key="reserve" class="reserve" alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    // }else{
                        $areadata[] = '<area data-key="'.$nupCounterx.'" class="sold" alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    // }

                    // var_dump($areadata[]);
                    
                    // $areadata[] = '<area alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    
                    // if($value->coord_status ==1){
                    $ck_in_arr = in_array($value->lot_no, $unit_arr);                    
                    // if($ck_in_arr){
                    //        $keyarea.='{ key: "'.$value->lot_no.'", selected: true, toolTip: "'.$value->lot_no.'"},';
                    //    }else{
                    //        $keyarea.='{ key: "'.$value->lot_no.'", toolTip: "'.$value->lot_no.'"},';
                    //    }

                    // if($ck_in_arr || $value->nup_counter>=3){
                    //     $keyarea.='{ key: "'.$value->lot_no.'", selected: true, toolTip: "'.$value->lot_no.'"},';
                    // }else{
                    //     $keyarea.='{ key: "'.$value->lot_no.'", toolTip: "'.$value->lot_no.'"},';                        
                    // }
                    if($ck_in_arr){
                        $keyarea.='{ key: "'.$value->lot_no.'", selected: true, toolTip: "'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type_descs.' <br>Land Area : '.$value->land_area.' <br>Build Area : '.$value->build_up_area.' <br>Harga Hardcash : '.$value->price_HC.' <br>Design Option : '.$value->theme.' <br>Unit Counter Qty : '.$value->nup_counter.'"},';
                    }else{
                        $keyarea.='{ key: "'.$value->lot_no.'", toolTip: "'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type_descs.' <br>Land Area : '.$value->land_area.' <br>Build Area : '.$value->build_up_area.' <br>Harga Hardcash : '.$value->price_HC.' <br>Design Option : '.$value->theme.' <br>Unit Counter Qty : '.$value->nup_counter.'"},';                        
                    }
                    
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
            $data = $this->m_wsbangun->getData_by_criteria('cf_property_dtl (NOLOCK)', $where);

            if(!empty($rowid_index))
            {
                $rowid = $rowid_index - 1000000;
            }
            if (!empty($data)) {
                $map_picture = $data[0]->map_picture;         
            }
            $tess='img/FloorPlan/'.$map_picture;

            $tblHd = 'v_rl_reserve_nup_hd';
            $critHd = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'nup_no'=>$NupNo);

            $dataHd = $this->m_wsbangun->getData_by_criteria($tblHd,$critHd);
            $BussName = $dataHd[0]->name;
            $Content = array('dataarea' => $areadata,
                            'keyarea' => $keyarea,
                            'project_name'=>$projectName,
                             'NupNO'=>$nupno,
                             'map_picture'=>$tess,
                             'pcd'=>$property_cd,
                             'RowID'=> $rowid,
                             'BussName'=>$BussName,
                             'rowid_index'=>$rowid_index,
                             'status_index'=>$status_index,
                             'balance'=>$blnc,
                             'unit'=>$unit,
                             'rowidd'=>$rowidd,
                             'Land'=>$selected_unit,
                             'RowHeader'=>$RowHdr,
                             'nupCounter'=>$nupCounter,
                             'selected_unit'=>$selected_unit,
                             'selected_pay'=>$selected_pay,
                             'selected_add'=>$selected_add
                             // 'property_type'=>$this->property_type($property_cd)
                             );

            
            $this->load_content_top_menu('booking/v_nup_land', $Content);
        }

        public function indextipe($NupNo=null, $property_cd=null,$rowid_index=null,$status_index=null, $balance = null,$RowID=null,$unit=null,$new = null, $pay = null, $add = null)
        {
            $unitt='';
            if($unit=='0')
            {
                $unitt='0';
            } else {
                $unitt=$unit;
            }

            $nupno_1=$NupNo;
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');

            $nupno = $this->session->userdata('NupNo');

            $sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 and property_type = 'L'";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;

            if (!empty($NupNo)) {
                $nupno = $NupNo;
            }
            $tblHd = 'v_rl_reserve_nup_hd';
            $critHd = array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'nup_no'=>$NupNo);

            $dataHd = $this->m_wsbangun->getData_by_criteria($tblHd,$critHd);

            $BussName = $dataHd[0]->name;
            $LotQty = $dataHd[0]->nup_lot_qty;
            $TotQty = $dataHd[0]->total_dtl;
            $balance_val = $LotQty - $TotQty;

            $tabel2 = 'v_rl_reserve_nup_dt';
            $crit2 = array(
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'nup_no'=>$NupNo);
            $units='';
            $datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2,$crit2);

            foreach ($datalist2 as $key) {

                $units = $units.(string)$key->lot_no.',';

            }

            $abc = strrpos($units, ",");
            $units = substr($units,0,$abc);
            $processed_unit=$units;

            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $approver = 1;

            $pcd = $property_cd;
            $blnc = $balance;           

            $sql = "SELECT project_no, property_cd, line_no, descs ,map_picture, rowID, coord, coord_status = ISNULL(coord_status,0) from mgr.cf_property_dtl (NOLOCK) where property_cd = '$pcd' and coord is not null and coord_status='1'";
            $query = $this->m_wsbangun->getData_by_query($sql);

            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $map_picture = $this->input->post('map_picture',TRUE);
            $areadata[]='';
            $keyarea='';

            if(!empty($query)){
                foreach ($query as $value) {
                    $areadata[] = '<area alt="" title="" onclick="openPage(\''.$value->rowID.'\',\''.$NupNo.'\',\''.$pcd.'\')" href="#" shape="circle" unit="'.$value->rowID.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                    
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
            $backurl = base_url("c_nup_dt/list_dtNew/$nupno_1/1/$rowid_index/$status_index"); 
            
            $tess='';

            $where = array('property_cd'=>$pcd,
                            'entity_cd'=>$entity,
                            'project_no'=>$project);
            $data = $this->m_wsbangun->getData_by_criteria('cf_property (NOLOCK)', $where);
            if (!empty($data)){
                $map_picture = $data[0]->map_picture;
            }
            $tess='img/FloorPlan/'.$map_picture;

            $Content = array('dataarea' => $areadata,
                            'keyarea' => $keyarea,
                            'project_name'=>$projectName,
                             'NupNO'=>$nupno,
                             'map_picture'=>$tess,
                             'pcd'=>$property_cd,
                             'balance'=>$blnc,
                             'BussName'=>$BussName,
                             'rowid_index'=>$rowid_index,
                             'status_index'=>$status_index,
                             'balance2'=>$balance_val,
                             'new'=>$new,
                             'blnc_total'=>$LotQty,
                             'processed_unit'=>$processed_unit,
                             'unit'=>$unitt,
                             'backurl'=>$backurl,
                             'RowID'=>$RowID,
                             'property_type'=>$this->property_type($property_cd),
                             'pay'=>$pay,
                             'add'=>$add);

            $this->load_content_top_menu('booking/v_nup_landed', $Content);
            // exit();

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
            
            $sql = "select price_HC = CONVERT(varchar, CAST(trx_amt AS money), 1),* from mgr.v_pm_lot_info where HC='Y' AND lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
            $data = $this->m_wsbangun->getData_by_query($sql);
            $pic = $data[0]->pic_name;
            
            $thelist='';$list='';$no=1;
            while (false !== ($file = readdir($handle)))
            { 


                if ($file != "." && $file != ".." && substr($file,0,7) == "new".$pic)
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
        $this->load->view('booking/infolanded',$content);
    }
    public function goto_table($payment=null,$lotno=null){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $sql = "SELECT price_HC = CONVERT(varchar, CAST(trx_amt AS money), 1),* from mgr.v_pm_lot_info where payment_cd='$payment' AND lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
        $data = $this->m_wsbangun->getData_by_query($sql);

        $content = array('data' => $data, );
        $this->load->view('booking/tablelanded',$content);
    }
    public function zoom_payment(){
        $ent = $this->input->post('paycd',TRUE);
        $lot_no = $this->input->post('lotno',TRUE);
        

        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // var_dump($ent);
        $table = "SELECT DISTINCT payment_cd,descs from mgr.v_payment_plan where lot_no ='$lot_no' and entity_cd = '$entity' and project_no = '$project'";
        $entityName = $this->m_wsbangun->getData_by_query($table);
        // var_dump($entityName);
            if(!empty($entityName)) {
                $comboEntity[] = '<option></option>';
                foreach ($entityName as $dtEntity) {
                  if($ent === $dtEntity->payment_cd) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtEntity->payment_cd.'">'.$dtEntity->descs.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            echo $comboEntity;
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
        $this->load->view('booking/infolanded',$content);
    }

        public function landed($propertykode='', $lot_no=''){
            if($property_cd!=''){
                $property_cd = $propertykode;
                }else{
                    $property_cd = $this->input->post('property_cd',true);
                }
                $lot_no = $this->input->post('lot_no', true);

                    $entity = $this->session->userdata('Tsentity');
                    $project = $this->session->userdata('Tsproject');
                    
                    $where=array('entity_cd'=>$entity,
                                'project_no'=> $project,
                                'property_cd'=>$property_cd);

                    $table = 'pm_lot_web (NOLOCK)';

                    $obj = array('property_cd','lot_no');

                    $data = $this->m_wsbangun->getCombo($table, $obj, $where, $lot_no);

        }

        // function goto_landed($property_cd){ 
        //     // var_dump($property_cd);
        //     // var_dump($level_no); exit;
        //     $entity = $this->session->userdata('Tsentity');
        //     $project = $this->session->userdata('Tsproject');
            
        //     $pcd = $property_cd;

        //     $sql = "SELECT project_no, property_cd, level_no, lot_no, descs, coord, coord_status = ISNULL(coord_status,0) from mgr.pm_lot_web where  property_cd = '$pcd' and coord is not null";
        //     $query = $this->m_wsbangun->getData_by_query($sql);
        //     // $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
        //     $areadata[]='';
        //     $keyarea='';
        //     if(!empty($query)){
        //         foreach ($query as $value) {
        //             $areadata[] = '<area alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
        //             if($value->coord_status ==1){
        //                 $keyarea.='{ key: "'.$value->lot_no.'", selected: true}';
        //             }
        //             # code...
        //         }
        //         $keyarea.='';
        //         $areadata = implode("", $areadata);

                
        //     }
        //     // var_dump($query);
        //     // exit;
        //     $tess='';
            
        //     $where =array('property_cd'=>$pcd,
        //                     'entity_cd'=>$entity,
        //                     'project_no'=>$project
        //                     );
        //     $data = $this->m_wsbangun->getData_by_criteria('cf_property', $where);
            
        //     if (!empty($data)) {
        //         $map_picture = $data[0]->map_picture;
        //     //     var_dump($map_picture);
        //     // // exit;
        //     //     $lot_no = $data[0]->lot_no;
        //     }
        //     $tess='img/FloorPlan/'.$map_picture;
            

        //     // $where2 =array('property_cd'=>$pcd,
        //     //                 'entity_cd'=>$entity,
        //     //                 'project_no'=>$project,
        //     //                 'lot_no'=>$lot_no
        //     //                 );
        //     // $data2 = $this->m_wsbangun->getData_by_criteria('pm_lot_web', $where2);

        //     // if (!empty($data2)) {
          
        //     //     $lot_no = $data2[0]->lot_no;
        //     // }
           

        //     $Content = array('dataarea' => $areadata,
        //                     'keyarea' => $keyarea,
        //                     'map_picture'=>$tess);

        //     $this->load->view('booking/landed',$Content);
        // }

        public function property_type($property_cd=''){
        	$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project,
        				'property_type'=>'L');
            $table = 'cf_property (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('property_cd', 'descs');

            $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where, $property_cd);

        	// $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
            // var_dump($cbProp);
        	return $cbProp;
        }
}