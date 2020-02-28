<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_nup_unit extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_booking_by_floor');
        $this->load->model('m_wsbangun');

        date_default_timezone_set('Asia/Jakarta');

    }
      public function index($rowID=null, $LotQty=null, $NupNO=null)
        { 
            $entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');

        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project);
        	$sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 and property_type='A'";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $b = 'L';
            // var_dump($this->level($b)); exit;



			// $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);

            // $dt = $this->datatable($a);
            // var_dump($dt); exit;
            // $dtr = array('dt' => $dt);

            // var_dump($dtr); 

            $ContentAllData = array(
                                    'userLevelList'=>$this->datatable($a, $b),
            						'property_type'=>$this->property_type($a),
            						'project_name'=>$projectName,
                                    'RowID'=> $rowID,
                                    'LotQty'=>$LotQty,
                                    'NupNO'=>$NupNO,
                                    'level_no'=>$this->level('in',$a)
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

        function goto_table(){ 
            $property_cd = $this->input->post('property_cd',TRUE);
            $level_no = $this->input->post('level_no',TRUE);
            $lot_no = $this->input->post('lot_no',TRUE);
            // var_dump($property_cd);
            // var_dump($level_no); exit;
        	$data = array('userLevelList'=> $this->datatable($property_cd, $level_no,$lot_no));
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
            $level_param = '';

            if($level_no <> 'L'){
                $level_param = " AND level_no = '$level_no' ";
            }
           
            $sql="SELECT level_no, descs FROM   MGR.PM_LEVEL (NOLOCK) WHERE  ENTITY_CD = '$entity' ";
            $sql.=" AND PROJECT_NO     = '$project' ".$level_param."";
            $sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.PM_LOT_WEB.LEVEL_NO " ;
            $sql.=" FROM   MGR.PM_LOT_WEB (NOLOCK) " ;
            $sql.=" WHERE  MGR.PM_LOT_WEB.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
            $sql.=" AND MGR.PM_LOT_WEB.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
            $sql.=" AND MGR.PM_LOT_WEB.PROPERTY_CD = '$property_cd'" ;
            $sql.=" AND ISNULL(MGR.PM_LOT_WEB.NUP_COUNTER,0) < 3";
            $sql.=" AND MGR.PM_LOT_WEB.STATUS = 'A')"; 

           
            $AllData = $this->m_wsbangun->getData_by_query($sql);
           
            $sql2 = "SELECT lot_no, level_no, remarks, status,isnull(nup_counter,0) AS nup_counter FROM mgr.pm_lot_web WHERE entity_cd = '$entity'";
            $sql2 .= " AND project_no = '$project' ";
            $sql2 .= " AND property_cd = '$property_cd' ".$level_param."";
            $sql2 .= " AND status = 'A' ";
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
                                    $text_ .= $tes .'('.$value2->nup_counter.')'; 
                           
                                    if(in_array($value2->lot_no, $chose_unit)){
                                        if($value2->nup_counter>=3){
                                        $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-danger" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" disabled>'.$text_.'</button>';

                                       }else{
                                        $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px; background: red" class = "btn btn-success" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" readOnly="readOnly">'.$text_.'</button>';
                                       }
                                    }else{
                                        if($value2->nup_counter>=3){
                                        $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-danger" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" disabled>'.$text_.'</button>';

                                       }else{
                                        $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-success" value="'.$value2->lot_no.'" onclick="moveNumbers(this.value,this)" readOnly="readOnly">'.$text_.'</button>';
                                       }

                                    }                                         
                                }     
                                
                        }else{
                            $Listunit.='<b><span> UNIT NOT AVALAIBLE </span></b>';
                        }
                        $Listunit .= '</div>';                        
                        $Listunit .= '</td>';
                        $ListAllData .= $Listunit;
                     $ListAllData .='</tr>';
                }
                
                $ContentAllData = $ListAllData;
            } 
            return $ContentAllData;
        }


        // public function datatable($property_cd='', $level_no = '',$lot_no=null){           
        // 	$ContentAllData ='';
        // 	$entity = $this->session->userdata('Tsentity');
        //     $project = $this->session->userdata('Tsproject');
        //     // $table = 'pm_level';
        //     // $kriteria= array('entity_cd' => $entity, 'project_no' => $project );
        //     $level_param = '';

        //     // if(!empty($level_no)){
        //     //     $level_param = " AND level_no = '$level_no' ";
        //     // }

        //     if($level_no <> 'L'){
        //         $level_param = " AND level_no = '$level_no' ";
        //     }

        //     // var_dump($level_param);


        //     $sql="SELECT level_no, descs FROM   MGR.PM_LEVEL (NOLOCK) WHERE  ENTITY_CD = '$entity' ";
        //     $sql.=" AND PROJECT_NO     = '$project' ".$level_param."";
       	// 	$sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.PM_LOT_WEB.LEVEL_NO " ;
        //     $sql.=" FROM   MGR.PM_LOT_WEB (NOLOCK) " ;
        //     $sql.=" WHERE  MGR.PM_LOT_WEB.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
        //     $sql.=" AND MGR.PM_LOT_WEB.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
        //     $sql.=" AND MGR.PM_LOT_WEB.PROPERTY_CD = '$property_cd'" ;
        //     $sql.=" AND ISNULL(MGR.PM_LOT_WEB.NUP_COUNTER,0) < 3";
        //     $sql.=" AND MGR.PM_LOT_WEB.STATUS = 'A')"; 

        //     // echo $sql; exit;        
            
        //     $AllData = $this->m_wsbangun->getData_by_query($sql);
           
        //     $sql2 = "SELECT lot_no, level_no, remarks, status,isnull(nup_counter,0) AS nup_counter FROM mgr.pm_lot_web WHERE entity_cd = '$entity'";
        //     $sql2 .= " AND project_no = '$project' ";
        //     $sql2 .= " AND property_cd = '$property_cd' ".$level_param."";
        //     $sql2 .= " AND status = 'A' ";
        //     // $sql2 .= " AND ISNULL(nup_counter,0) < 3";
        //     $sql2 .= " ORDER by level_no, lot_no";

        //     $AllDataUnit = $this->m_wsbangun->getData_by_query($sql2);

        //    // $ContentAllData = array('AllData' => $AllData, 
        //    //              'AllDataUnit' => $AllDataUnit);

        //    // return $ContentAllData;
        //    // var_dump($Data); exit;
        //     $chose_unit[]='';
        //     if(!empty($lot_no)){
        //         $chose_unit=explode(',', $lot_no);
        //     }
        //    if(!empty($AllData))
        //     {
        //         $ListAllData = '';          
        //         foreach ($AllData as $value) 
        //         {                    
        //             $bb = $value->level_no;

        //             $AllDataUnitLevel = array_filter($AllDataUnit,function($a) use($bb) {
                        
        //                 return $a->level_no === $bb;

        //             });
                  
        //             $ListAllData .='<tr>';
        //             $ListAllData .='<td>'.$value->descs.'</td>';

        //                 /*$entity = $this->session->userdata('Tsentity');*/
        //                 // $project = $this->session->userdata('Tsproject');
        //                 // $table2 = 'pm_lot_web';
        //                 // $level = $value->level_no;
        //                 // $kriteria2 = array('entity_cd' => $entity, 'project_no' => $project, 'level_no' => $level,'status '=>'A', 'ISNULL(nup_counter,0) <' => 3, 'property_cd' =>$property_cd);
        //                 // $AllDataUnit = $this->m_wsbangun->getData_by_criteria($table2, $kriteria2);
        //                 // var_dump($AllDataUnit);
        //                 $tes = '<br>';
        //                 $Listunit = '<td align="left">';
        //                 $Listunit .= '<div data-toggle="buttons">';
        //                 if ($AllDataUnitLevel) 
        //                 {
        //                     foreach ($AllDataUnitLevel as $key=>$value2) 
        //                         {
        //                             $text_ = $value2->lot_no;
        //                             $text_ .= $tes .'('.$value2->nup_counter.')'; 

        //                             if(in_array($value2->lot_no, $chose_unit)){
        //                                 if($value2->nup_counter>=3){
        //                                 $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-danger" onclick="moveNumbers(\''.$value2->lot_no.'\',this)" disabled>'.$text_.'</button>';

        //                                }else{
        //                                 $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px; background: red" class = "btn btn-success" onclick="moveNumbers(\''.$value2->lot_no.'\',this)" readOnly="readOnly">'.$text_.'</button>';
        //                                }
        //                             }else{
        //                                 if($value2->nup_counter>=3){
        //                                 $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-danger" onclick="moveNumbers(\''.$value2->lot_no.'\',this)" disabled>'.$text_.'</button>';

        //                                }else{
        //                                 $Listunit .='<button type="button" id="lot_no" name ="lot_no" style="width: 100px;" class = "btn btn-success" onclick="moveNumbers(\''.$value2->lot_no.'\',this)" readOnly="readOnly">'.$text_.'</button>';
        //                                }

        //                             }
                                       
                                        
                                      
        //                         }     
        //                         // exit;
        //                 }else{
        //                     $Listunit.='<b><span> UNIT NOT AVALAIBLE </span></b>';
        //                 }
        //                 $Listunit .= '</div>';                        
        //                 $Listunit .= '</td>';
        //                 // var_dump($Listunit);
        //                 $ListAllData .= $Listunit;
        //              $ListAllData .='</tr>';
        //         }
                
        //         $ContentAllData = $ListAllData;
        //     } 
        //     return $ContentAllData;


        // }
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

        public function validasi2(){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $user = $this->session->userdata('Tsuname');
            $psn='';
            // $msg="";
            if($_POST){

                $lotNumber = $this->input->post('LotNumber', TRUE);                
                // $NupNo_ = $this->input->post('nupno', TRUE);
                $PLotQty = $this->input->post('lotqty', TRUE);
                $PRowID = $this->input->post('rowid', TRUE);
                // var_dump($PLotQty);

                // echo $lotNumber;
                // var_dump($LotNumber);

                // $a = strrpos($lotNumber,',');
                // $lotNumber = substr($lotNumber, 0,$a);
                $data=explode(',', $lotNumber);
                $countArray = count($data);
                // var_dump($data);
                // exit;
                
                $category_string = "'" . implode("','",$data) . "'";

                // $count = "SELECT COUNT(*) as cnt FROM mgr.rl_reserve_nup_dt (NOLOCK) WHERE lot_no NOT IN ($category_string) and nup_rowid = $PRowID";
                // $countResult = $this->m_wsbangun->getData_by_query($count);
                // $a = $countResult[0]->cnt;

                // var_dump($a);

                $lotCount = "SELECT COUNT (*) as cnt FROM mgr.pm_lot_web WHERE entity_Cd = '$entity' and project_no = '$project' and lot_no in ($category_string) and ISNULL(nup_counter,0) > 2";
                $lotResult = $this->m_wsbangun->getData_by_query($lotCount);
                $b = $lotResult[0]->cnt;
                // var_dump($b);exit();

                $sql1 = "SELECT business_id, nup_no FROM mgr.rl_reserve_nup WHERE rowID = $PRowID";//ini ganti
                $row1 = $this->m_wsbangun->getData_by_query($sql1);
                $NupNo = $row1[0]->nup_no;
                // var_dump($PRowID);
                // var_dump($NupNo);exit();
                // $NupNo =$NupNo_;

                if($b > 3){
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
                // var_dump($a);
                // var_dump($TotCount);
                // var_dump($PLotQty);
                // var_dump($b);
                if((int)$PLotQty <= (int)$TotCount){
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
                                                'nup_rowid'=>$PRowID
                                                );

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
                    if($PLotQty > 1){
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
            $psn='';
            // $msg="";
            if($_POST){

                $lotNumber = $this->input->post('LotNumber', TRUE);                
                $PRowID = $this->input->post('rowid', TRUE);
                $PLotQty = $this->input->post('lotqty', TRUE);
                // var_dump($PLotQty);

                // echo $lotNumber;
                // var_dump($LotNumber);

                // $a = strrpos($lotNumber,',');
                // $lotNumber = substr($lotNumber, 0,$a);
                $data=explode(',', $lotNumber);
                $countArray = count($data);
                // var_dump($data);
                // exit;
                
                $category_string = "'" . implode("','",$data) . "'";

                // $count = "SELECT COUNT(*) as cnt FROM mgr.rl_reserve_nup_dt (NOLOCK) WHERE lot_no NOT IN ($category_string) and nup_rowid = $PRowID";
                // $countResult = $this->m_wsbangun->getData_by_query($count);
                // $a = $countResult[0]->cnt;

                // var_dump($a);

                $lotCount = "SELECT COUNT (*) as cnt FROM mgr.pm_lot_web WHERE entity_Cd = '$entity' and project_no = '$project' and lot_no in ($category_string) and ISNULL(nup_counter,0) > 2";
                $lotResult = $this->m_wsbangun->getData_by_query($lotCount);
                $b = $lotResult[0]->cnt;
                // var_dump($b);

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
                // var_dump($a);

                if($TotCount <= $PLotQty && $b == 0){
                    for ($x = 0; $x <= $countArray-1; $x++) {
                        $datax = array();

                        $countDt = "SELECT count(*) as cnt FROM mgr.rl_reserve_nup_dt WHERE nup_rowid = $PRowID and lot_no = $data[$x]";
                        $dtResult = $this->m_wsbangun->getData_by_query($countDt);
                        $c = $dtResult[0]->cnt;

                        if($c == 0){
                            // $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");

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
                        } 
                        // $this->db->query("UPDATE mgr.pm_lot_web set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]'"); 
                        // $this->m_wsbangun->updateData('rl_reserve_nup_dt', $data[$x], 'lot_no');
                    }
                }else{
                    if($PLotQty > 1){
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

}