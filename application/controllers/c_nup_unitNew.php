<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_nup_unitNew extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_booking_by_floor');
        $this->load->model('m_wsbangun');

        date_default_timezone_set('Asia/Jakarta');

    }
      public function index($rowID=null, $LotQty=null, $NupNO=null, $new = null )
        { 
            // var_dump($new);exit;
            $entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $cons = $this->session->userdata('Tscons');


        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project);
        	$sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 and property_type='A'";
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $b = 'L';
            $row_index = $rowID + 1000000;
            // var_dump($this->level($b)); exit;

            $sql="select choose_unit_status from mgr.rl_reserve_nup (NOLOCK) where entity_cd='$entity' and project_no ='$project' and nup_no='$NupNO'";
            $DataUnitStatus = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $unit_status = $DataUnitStatus[0]->choose_unit_status;
            
            if($unit_status=='Y'){
                    $backurl = base_url("c_nup_dtNew/list_dtNew/$NupNO/1/$row_index/A");     
            }else{
                $backurl = base_url("c_choose_unit/indexNew");     
            }
            $tblHd = 'v_rl_reserve_nup_hd';
            $critHd = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'nup_no'=>$NupNO);

            $dataHd = $this->m_wsbangun->getData_by_criteria_cons($cons,$tblHd,$critHd);
            $BussName = $dataHd[0]->name;
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
                                    'BussName'=>$BussName,
                                    'backurl'=>$backurl,
                                    'level_no'=>$this->level('in',$a),
                                    'row_index' =>$row_index,
                                    'unit'=>$new
                                    );


            $this->load_content_top_menu('ChooseUnit/v_nup_unit', $ContentAllData);

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
      public function indexview()
        { 
            // var_dump($new);exit;
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $groupName = $this->session->userdata('Tsusergroup');
            $cons = $this->session->userdata('Tscons');

            // var_dump($project." - ".$entity);exit();

             if(empty($project)){
                $sqlquery="SELECT min(project_no) as project_no, min(entity_cd) as entity_cd from mgr.pl_project "; 
                $dt = $this->m_wsbangun->getData_by_query_cons($cons,$sqlquery);
                $project =  $dt[0]->project_no;
                $entity = $dt[0]->entity_cd;
            }
            // var_dump($project." - ".$entity);exit();
            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
            $sql = "SELECT MIN(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 ";
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $b = 'L';
            // $row_index = $rowID + 1000000;
          // var_dump($a);

            $ContentAllData = array(
                                    'userLevelList'=>$this->datatableView($a, $b),
                                    'property_type'=>$this->property_typeview($a),
                                    'project_name'=>$projectName,
                                    // 'RowID'=> $rowID,
                                    // 'LotQty'=>$LotQty,
                                    // 'NupNO'=>$NupNO,
                                    // 'BussName'=>$BussName,
                                    // 'backurl'=>$backurl,
                                    'level_no'=>$this->level('in',$a)//,
                                    // 'row_index' =>$row_index,
                                    // 'unit'=>$new
                                    );


            if ($groupName=='MGM'){
                $this->load_content_mgm('ChooseUnit/v_nup_unit_view',$ContentAllData);
            }else{
                $this->load_content_top_menu('ChooseUnit/v_nup_unit_view',$ContentAllData);
            }

            // $this->load_content_top_menu('ChooseUnit/v_nup_unit_view', $ContentAllData);

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

        public function indexviewInternal()
        {             
            $entity      = $this->session->userdata('Tsentity');
            $project     = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $groupName   = $this->session->userdata('Tsusergroup');
            $cons        = $this->session->userdata('Tscons');

            $where = array(
                'entity_cd'  =>$entity,
                'project_no' => $project
            );

            $sql = "SELECT MIN(property_cd) AS default_value
            FROM mgr.cf_property (NOLOCK)
            WHERE entity_cd   = '$entity'
            AND project_no    = '$project'
            AND default_value =1 ";
            $defaulValue = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $b = 'L';            

            $ContentAllData = array(
                'userLevelList' => $this->datatableViewInternal($a, $b),
                'property_type' => $this->property_typeview($a),
                'project_name'  => $projectName,
                'level_no'      => $this->level('in',$a)
            );

            if ($groupName=='MGM'){
                $this->load_content_mgm('ChooseUnit/v_nup_unit_view_internal',$ContentAllData);
            }else{
                $this->load_content_top_menu('ChooseUnit/v_nup_unit_view_internal',$ContentAllData);
            }
        }


        public function indexNew($rowID=null, $LotQty=null, $NupNO=null)
        { 
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $cons = $this->session->userdata('Tscons');



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

        function goto_table($property_cd = null, $level_no = null){ 
            $property_cd = $this->input->post('property_cd',TRUE);
            $level_no = $this->input->post('level_no',TRUE);
            $lot_no = $this->input->post('lot_no',TRUE);
            // var_dump($property_cd);
            // var_dump($level_no); exit;

            $Type = $this->input->post('Type',TRUE);
            // var_dump($property_cd);
            // var_dump($level_no); exit;
            $ts='';
            if($Type=='A'){
                    $ts='Level';
            }else{
                $ts='Type';
            }
            $data = array(
                                'userLevelList'=> $this->datatableViewInternal($property_cd, $level_no,$lot_no),
                                'Type'=>$ts
                        );

        	// $data = array('userLevelList'=> $this->datatable($property_cd, $level_no,$lot_no));
            // var_dump($data);
        	$this->load->view('ChooseUnit/table',$data);
        }
        function goto_tableView($property_cd = null, $level_no = null){ 
            $property_cd = $this->input->post('property_cd',TRUE);
            $level_no = $this->input->post('level_no',TRUE);
            $lot_no = $this->input->post('lot_no',TRUE);
            $Type = $this->input->post('Type',TRUE);
            // var_dump($property_cd);
            // var_dump($level_no); exit;
            $ts='';
            if($Type=='A'){
                    $ts='Level';
            }else{
                $ts='Type';
            }
            $data = array(
                                'userLevelList'=> $this->datatableView($property_cd, $level_no,$lot_no),
                                'Type'=>$ts
                        );
            // var_dump($data);
            $this->load->view('ChooseUnit/table',$data);
        }

        function goto_tableViewInternal($property_cd = null, $level_no = null){ 
            $property_cd = $this->input->post('property_cd',TRUE);
            $level_no = $this->input->post('level_no',TRUE);
            $lot_no = $this->input->post('lot_no',TRUE);
            $Type = $this->input->post('Type',TRUE);
            // var_dump($property_cd);
            // var_dump($level_no); exit;
            $ts='';
            if($Type=='A'){
                    $ts='Level';
            }else{
                $ts='Type';
            }
            $data = array(
                                'userLevelList'=> $this->datatableViewInternal($property_cd, $level_no,$lot_no),
                                'Type'=>$ts
                        );
            // var_dump($data);
            $this->load->view('ChooseUnit/table',$data);
        }

        function goto_table2($property_cd = null, $level_no = null, $lot_no = null){ 
            // $property_cd = $this->input->post('property_cd',TRUE);
            // $level_no = $this->input->post('level_no',TRUE);
            // $lot_no = $this->input->post('lot_no',TRUE);
            var_dump($level_no);
            // var_dump($level_no); exit;
            $data = array('userLevelList'=> $this->datatable($property_cd, $level_no,$lot_no));
            // var_dump($data);
            $this->load->view('ChooseUnit/table',$data);
        }
        public function property_typeview($property_cd=''){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');

            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
            $table = 'cf_property (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('property_cd', 'descs');

            // $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where, $property_cd);
            $Data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$where); 
            $combo[] = '<option value=""></option>';
            foreach ($Data as $result) {
                if(trim($result->property_cd) == $property_cd) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.$result->property_cd.'" '.$selected.' data-level="">'.$result->descs.'</option>';
            }
            $cbProp = implode("", $combo); 

            // $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
            return $cbProp;
        }
        public function property_type($property_cd=''){
        	$entity = $this->session->userdata('Tsentity');
            $cons = $this->session->userdata('Tscons');
        	$project = $this->session->userdata('Tsproject');
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project,
                        'property_type'=>'A');
            $table = 'cf_property (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('property_cd', 'descs');

            $cbProp = $this->m_wsbangun->getCombo_cons($cons,$table, $obj, $where, $property_cd);

        	// $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
        	return $cbProp;
        }

        // public function level($property_cd='', $level_no=''){
        public function level($from = '',$property_code=''){
            $cons = $this->session->userdata('Tscons');

            
            if($property_code!=''){
                $property_cd = $property_code;
            }else{
                $property_cd = $this->input->post('property_cd', TRUE);
            }
            // var_dump($property_cd);
            $level_no = $this->input->post('level_no', TRUE);

            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            
            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project,
                        'property_cd'=>$property_cd);

            $table = 'v_pm_lot_level (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('level_no', 'descs');

            $cbLvl = $this->m_wsbangun->getCombo_cons($cons,$table, $obj, $where, $level_no); 

            // $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
            // return $cbLvl;
            
            if($from == 'in'){
                return $cbLvl;     
            }else{
                echo $cbLvl;    
            }
            
        }

        public function datatableViewInternal($property_cd='', $level_no = '',$lot_no=null){

            $ContentAllData ='';
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');
            $level_param = '';
            
           if($level_no <> 'L'){
                    $level_param = " AND level_no = '$level_no' ";
                }

                $sql="SELECT level_no, descs FROM   MGR.PM_LEVEL (NOLOCK) WHERE ENTITY_CD = '$entity' ";
                $sql.=" AND PROJECT_NO     = '$project' ".$level_param."";
                $sql.=" AND property_cd     = '$property_cd'";
                $sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.pm_lot.LEVEL_NO " ;
                $sql.=" FROM   MGR.pm_lot (NOLOCK) " ;
                $sql.=" WHERE  MGR.pm_lot.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
                $sql.=" AND MGR.pm_lot.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
                $sql.=" AND MGR.pm_lot.PROPERTY_CD = '$property_cd')" ;
                // $sql.=" AND MGR.pm_lot.STATUS = 'A') ORDER BY seq_no"; 

            $AllData = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

            $sql2 = "SELECT  project_no = mgr.pm_lot.project_no  ,property_cd = mgr.pm_lot.property_cd";
            $sql2.= ",level_no = mgr.pm_lot.level_no ,lot_no = mgr.pm_lot.lot_no ";
            $sql2 .= ",img = mgr.cf_lot_type_gallery.gallery_url, descs = mgr.pm_lot.descs   ,type ";
            $sql2 .= ",CASE WHEN mgr.pm_lot.build_up_area = 0  THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.build_up_area) END AS build_up_area";
            $sql2 .= ",CASE WHEN mgr.pm_lot.land_area = 0  THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.land_area) END AS land_area";
            $sql2 .= ",coord  ,coord_status = ISNULL(coord_status, 0)  ";
            $sql2 .= ",type_descs = (select descs from mgr.cf_lot_type (NOLOCK) where lot_type= type) ";
            $sql2 .= ",price_HC = 0 ";
            $sql2 .= ", mgr.pm_lot.status ";
            $sql2 .= "    FROM mgr.pm_lot(NOLOCK)";
            $sql2 .= "    LEFT OUTER JOIN mgr.cf_lot_type_gallery(NOLOCK)";
            $sql2 .= "    ON mgr.pm_lot.type = mgr.cf_lot_type_gallery.lot_type";
            $sql2 .= "    WHERE mgr.pm_lot.property_cd ='$property_cd' ";
            $sql2 .= "     AND mgr.pm_lot.entity_cd = '$entity' ";
            $sql2 .= "    AND mgr.pm_lot.project_no = '$project'  ".$level_param;
            
            $AllDataUnit = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

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
                                    $img = "<img src=".$value2->img." class='img-responsive' />";
                                    $titlehd ="Selected by ".$value2->nup_counter." Customers <br>";
                                    $title = "<b><h3>".$value2->lot_no."</h3></b> <br>";
                                    $title .="Type : ".$value2->type_descs."<br>";
                                    $title .="Semi Gross Area : ".$value2->build_up_area."<br>";
                                    $stt = $value2->status;

                                    if($stt=='A'){
                                        $Listunit .='<button type="button" name="'.$value2->lot_no.'" class="btn btn-success" style="margin:5px" data-toggle="popover" data-placement="top" data-container="body" data-original-title="Popover on top" data-content="Macaroon chocolate candy. I love carrot cake gingerbread cake lemon drops. Muffin sugar plum marzipan pie.">'.$text_.'</button>';
                                    }elseif($stt=='B' || $stt=='N' || $stt=='S' || $stt=='R'){
                                        $Listunit .='<button type="button" name ="'.$value2->lot_no.'" class="btn btn-danger" style="margin:5px" data-toggle="popover" data-placement="top" data-container="body" data-original-title="Popover on top" data-content="Macaroon chocolate candy. I love carrot cake gingerbread cake lemon drops. Muffin sugar plum marzipan pie.">'.$text_.'</button>';
                                    }elseif ($stt=='H') {
                                        $Listunit .='<button type="button" name ="'.$value2->lot_no.'" class="btn btn-warning" style="margin:5px" data-toggle="popover" data-placement="top" data-container="body" data-original-title="Popover on top" data-content="Macaroon chocolate candy. I love carrot cake gingerbread cake lemon drops. Muffin sugar plum marzipan pie.">'.$text_.'</button>';
                                    }

                                       
                                      
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

public function datatableView($property_cd='', $level_no = '',$lot_no=null){

            $ContentAllData ='';
            $entity = $this->session->userdata('Tsentity');
            $cons = $this->session->userdata('Tscons');
            $project = $this->session->userdata('Tsproject');
            // $table = 'pm_level';
            // $kriteria= array('entity_cd' => $entity, 'project_no' => $project );
            $level_param = '';

            // if(!empty($level_no)){
            //     $level_param = " AND level_no = '$level_no' ";
           

           if($level_no <> 'L'){
                    $level_param = " AND level_no = '$level_no' ";
                }


                $sql="SELECT level_no, descs FROM   MGR.PM_LEVEL (NOLOCK) WHERE ENTITY_CD = '$entity' ";
                $sql.=" AND PROJECT_NO     = '$project' ".$level_param."";
                $sql.=" AND property_cd     = '$project'";
                $sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.pm_lot.LEVEL_NO " ;
                $sql.=" FROM   MGR.pm_lot (NOLOCK) " ;
                $sql.=" WHERE  MGR.pm_lot.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
                $sql.=" AND MGR.pm_lot.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
                $sql.=" AND MGR.pm_lot.PROPERTY_CD = '$property_cd') ORDER BY seq_no" ;
                // $sql.=" AND MGR.pm_lot.STATUS = 'A') ORDER BY seq_no"; 

            $AllData = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            // var_dump($property_cd);
            // var_dump($level_no);



            // echo $sql; exit;        
            
            
           
            // $sql2 = "SELECT lot_no,descs, level_no, remarks, status,isnull(nup_counter,0) AS nup_counter FROM mgr.pm_lot WHERE entity_cd = '$entity'";
            // $sql2 .= " AND project_no = '$project' ";
            // $sql2 .= " AND property_cd = '$property_cd' ".$level_param."";
            // $sql2 .= " AND status = 'A' ";
            // // $sql2 .= " AND ISNULL(nup_counter,0) < 3";
            // $sql2 .= " ORDER by level_no, lot_no";
            $sql2 = "SELECT  project_no = mgr.pm_lot.project_no  ,property_cd = mgr.pm_lot.property_cd";
            $sql2.= ",level_no = mgr.pm_lot.level_no ,lot_no = mgr.pm_lot.lot_no ";
            $sql2 .= ",isnull(mgr.pm_theme.descs,'N/A') AS theme, descs = mgr.pm_lot.descs   ,type ";
            $sql2 .= ",CASE WHEN mgr.pm_lot.build_up_area = 0  THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.build_up_area) END AS build_up_area";
            $sql2 .= ",CASE WHEN mgr.pm_lot.land_area = 0  THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.land_area) END AS land_area";
            $sql2 .= ",coord  ,coord_status = ISNULL(coord_status, 0)  ";
            $sql2 .= ",type_descs = (select descs from mgr.cf_lot_type (NOLOCK) where lot_type= type) ";
            $sql2 .= ",price_HC = CONVERT(varchar, CAST(mgr.pm_lot_price.trx_amt AS money), 1) ";
            $sql2 .= "    FROM mgr.pm_lot(NOLOCK) left outer join mgr.pm_lot_price (NOLOCK) ";
            $sql2 .= "    On mgr.pm_lot.entity_cd = mgr.pm_lot_price.entity_cd ";
            $sql2 .= "    and  mgr.pm_lot.project_no = mgr.pm_lot_price.project_no ";
            $sql2 .= "    and  mgr.pm_lot.lot_no = mgr.pm_lot_price.lot_no ";
            $sql2 .= "    and  mgr.pm_lot_price.Hc ='Y' ";
            $sql2 .= "    LEFT OUTER JOIN mgr.pm_theme(NOLOCK)";
            $sql2 .= "    ON mgr.pm_lot.theme_cd = mgr.pm_theme.theme_cd";
            $sql2 .= "    WHERE mgr.pm_lot.property_cd ='$property_cd' ";
            $sql2 .= "     AND mgr.pm_lot.entity_cd = '$entity' ";
            $sql2 .= "    AND mgr.pm_lot.project_no = '$project'  ".$level_param;
            // var_dump($sql2);
            // var_dump($sql);
            $AllDataUnit = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

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
                        // $table2 = 'pm_lot';
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
                                    // $text_ .= $tes .'('.$value2->nup_counter.') ('.$value2->status.')'; 
                                    $title = "<b><h3>".$value2->lot_no."</h3></b> <br>"; //"Tes satu: &#013; apa aja";
                                    $title .="Type : ".$value2->type_descs."<br>";
                                    $title .="Semi Gross Area : ".$value2->build_up_area."<br>";
                                    // $title .="Harga Hard Cash <br>";
                                    // $title .="- Early Bird : ".$value2->price_HC."<br>";                                  
                                    // $title .="- Launching : ".$value2->trx_amt_1."<br>";
                                    $stt = $value2->status;
                                    // var_dump($stt);
                                    // if($stt=='A'){
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-primary" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    // }elseif($stt=='B'){
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    // }elseif ($stt=='H') {
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;background:#FF8000;" class = "btn btn" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    // }elseif ($stt=='R') {
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;background:#F7FE2E;" class = "btn btn" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    // }

                                    if($stt=='A'){
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-green" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    }elseif($stt=='B' || $stt=='H' || $stt='R'){
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    }

                                    // elseif ($stt=='H') {
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;background:#FF8000;" class = "btn btn" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    // }elseif ($stt=='R') {
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;background:#F7FE2E;" class = "btn btn" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    // }

//                                     if(in_array($value2->lot_no, $chose_unit)){
//                                         if($value2->nup_counter>=3){
                                        // $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, borderline: #000000, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                        // $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" disabled>'.$text_.'</button>';
// //title="'.$titlehd.'"
//                                        }else{
//                                         // $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
//                                         $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'">'.$text_.'</button>';
//                                        }
//                                     }else{
//                                         if($value2->nup_counter>=3){
//                                         // $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
//                                         $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)"  data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" disabled>'.$text_.'</button>';

//                                        }else{
//                                         // $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
//                                         $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-primary" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'">'.$text_.'</button>';
//                                        }
//                                     }


                                       
                                        
                                      
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
        public function datatable($property_cd='', $level_no = '',$lot_no=null){

        	$ContentAllData ='';
        	$entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $cons = $this->session->userdata('Tscons');

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
       		$sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.pm_lot.LEVEL_NO " ;
            $sql.=" FROM   MGR.pm_lot (NOLOCK) " ;
            $sql.=" WHERE  MGR.pm_lot.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
            $sql.=" AND MGR.pm_lot.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
            $sql.=" AND MGR.pm_lot.PROPERTY_CD = '$property_cd'" ;
            $sql.=" AND MGR.pm_lot.STATUS = 'A')"; 

            // echo $sql; exit;        
            
            $AllData = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
           
            // $sql2 = "SELECT lot_no,descs, level_no, remarks, status,isnull(nup_counter,0) AS nup_counter FROM mgr.pm_lot WHERE entity_cd = '$entity'";
            // $sql2 .= " AND project_no = '$project' ";
            // $sql2 .= " AND property_cd = '$property_cd' ".$level_param."";
            // $sql2 .= " AND status = 'A' ";
            // // $sql2 .= " AND ISNULL(nup_counter,0) < 3";
            // $sql2 .= " ORDER by level_no, lot_no";
            $sql2 = "SELECT  project_no = mgr.pm_lot.project_no  ,property_cd = mgr.pm_lot.property_cd";
            $sql2.= ",level_no = mgr.pm_lot.level_no ,lot_no = mgr.pm_lot.lot_no ";
            $sql2 .= ",isnull(mgr.pm_theme.descs,'N/A') AS theme, descs = mgr.pm_lot.descs   ,type ";
            $sql2 .= ",CASE WHEN mgr.pm_lot.build_up_area = 0  THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.build_up_area) END AS build_up_area";
            $sql2 .= ",CASE WHEN mgr.pm_lot.land_area = 0  THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.land_area) END AS land_area";
            $sql2 .= ",coord  ,coord_status = ISNULL(coord_status, 0)  ";
            $sql2 .= ",type_descs = (select descs from mgr.cf_lot_type (NOLOCK) where lot_type= type) ";
            $sql2 .= ",price_HC = CONVERT(varchar, CAST(mgr.pm_lot_price.trx_amt AS money), 1) ";
            $sql2 .= "    FROM mgr.pm_lot(NOLOCK) left outer join mgr.pm_lot_price (NOLOCK) ";
            $sql2 .= "    On mgr.pm_lot.entity_cd = mgr.pm_lot_price.entity_cd ";
            $sql2 .= "    and  mgr.pm_lot.project_no = mgr.pm_lot_price.project_no ";
            $sql2 .= "    and  mgr.pm_lot.lot_no = mgr.pm_lot_price.lot_no ";
            $sql2 .= "    and  mgr.pm_lot_price.Hc ='Y' ";
            $sql2 .= "    LEFT OUTER JOIN mgr.pm_theme(NOLOCK)";
            $sql2 .= "    ON mgr.pm_lot.theme_cd = mgr.pm_theme.theme_cd";
            $sql2 .= "    WHERE mgr.pm_lot.property_cd ='$property_cd' ";
            $sql2 .= "     AND mgr.pm_lot.entity_cd = '$entity' ";
            $sql2 .= "    AND mgr.pm_lot.project_no = '$project'  ".$level_param;
            // var_dump($sql2);
            // var_dump($sql);
            $AllDataUnit = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

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
                        // $table2 = 'pm_lot';
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
                                    $titlehd ="Selected by ".$value2->nup_counter." Customers <br>";
                                    $title = "<b><h3>".$value2->lot_no."</h3></b> <br>"; //"Tes satu: &#013; apa aja";
                                    $title .="Type : ".$value2->type_descs."<br>";
                                    $title .="Semi Gross Area : ".$value2->build_up_area."<br>";
                                    $title .="Harga Hard Cash <br>";
                                    $title .="- Early Bird : ".$value2->price_HC."<br>";                                  
                                   

                                    // if(in_array($value2->lot_no, $chose_unit)){
                                    //     if($value2->nup_counter>=5){
                                    //     $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, borderline: #000000, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" data-html="true">'.$text_.'</button></span>';

                                    //    }else{
                                    //     $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly" data-html="true">'.$text_.'</button></span>';
                                    //    }
                                    // }else{
                                    //     if($value2->nup_counter>=5){
                                    //     $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-primary" onclick="landinfo(\''.$value2->lot_no.'\', this)"  data-html="true">'.$text_.'</button></span>';

                                    //    }else{
                                    //     $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                    //     $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-primary" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly" data-html="true">'.$text_.'</button></span>';
                                    //    }
                                    // }

                                    if(in_array($value2->lot_no, $chose_unit)){
                                        if($value2->nup_counter>=3){
                                        // $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, borderline: #000000, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right" title="'.$titlehd.'" data-content="'.$title.'" disabled>'.$text_.'</button>';

                                       }else{
                                        // $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right" title="'.$titlehd.'" data-content="'.$title.'">'.$text_.'</button>';
                                       }
                                    }else{
                                        if($value2->nup_counter>=3){
                                        // $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" onclick="landinfo(\''.$value2->lot_no.'\', this)"  data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right" title="'.$titlehd.'" data-content="'.$title.'" disabled>'.$text_.'</button>';

                                       }else{
                                        // $Listunit .='<span class="skinnytip" data-text="'.$title.'" data-title="'.$titlehd.'" data-options="width: 300px, border: 2px, borderColor: #000000, backColor: #f7ee47, textColor: #000000,titleTextColor: #ec0303, fontFace: verdana, fontSize: 12px, titleFontSize: 18px, titlePadding: 10px, textPadding: 10px, xOffset: 30, yOffset: 30">';
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-primary" onclick="landinfo(\''.$value2->lot_no.'\', this)" readOnly="readOnly" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right" title="'.$titlehd.'" data-content="'.$title.'">'.$text_.'</button>';
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
            $cons = $this->session->userdata('Tscons');

        // var_dump($NupNo);
                    $nupno = $this->session->userdata('NupNo');



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
                $this->load->view('ChooseUnit/infoapt',$content);
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
        	$this->m_wsbangun->updateData('pm_lot',$data, $where);
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
            $cons = $this->session->userdata('Tscons');


                $table3 = 'pm_lot';
                $content = array('entity_cd' => $entity,
                                'project_no' => $project,
                                'lot_no' => $id
                                );
                $lotData = $this->m_wsbangun->getData_by_criteria_cons($cons,$table3, $content);
                if ($lotData) 
                {
                    $table = 'cf_property';
                    $kriteria = array('entity_cd' => $entity,
                                    'project_no' => $project,
                                    'property_cd' => $lotData[0]->property_cd
                                     );
                    $lotData2 = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $kriteria);
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
                        $lotData1 = $this->m_wsbangun->getData_by_criteria_cons($cons,$table1, $kriteria1);
                        $level_desc = $lotData1[0]->descs;
                    }
                    if ($lotData1) 
                    {
                        $table4 = 'cf_lot_type';
                        $kriteria4 = array('lot_type' => $lotData[0]->type);
                        $lotData4 = $this->m_wsbangun->getData_by_criteria_cons($cons,$table4, $kriteria4);
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
            $cons = $this->session->userdata('Tscons');
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
                                    $updateCntr = $this->m_wsbangun->setData_by_query_cons($cons,"UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = '$value' and entity_Cd = '$entity' and project_no = '$project' and nup_counter > 0");
                                
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
                   
                    $lotCount = "SELECT COUNT (*) as cnt FROM mgr.pm_lot (NOLOCK) WHERE entity_Cd = '$entity' and project_no = '$project' and lot_no ='$val' and ISNULL(nup_counter,0) > 2";
                    $lotResult = $this->m_wsbangun->getData_by_query_cons($cons,$lotCount);
                    $b = $lotResult[0]->cnt;
                    // var_dump($lotCount);exit();

                    $sql1 = "SELECT business_id, nup_no FROM mgr.rl_reserve_nup (NOLOCK) WHERE rowID = $PRowID";
                    $row1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
                    $NupNo = $row1[0]->nup_no;
                    // var_dump($PRowID);
                    // var_dump($NupNo);exit();
                    // $NupNo =$NupNo_;

                    if($b > 0){
                        $msg = "This unit ['".$val."'] has been choosen more than 3";
                        $notif = 'GAGAL';

                        $msg1=array('Pesan'=>$msg,
                                     'nup'=>$NupNo,
                                     'notif'=>$notif);

                        echo json_encode($msg1);

                        exit;
                    }else{
                        // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                        
                        // $count = "SELECT COUNT (*) as cnt from mgr.rl_reserve_nup_dt where nup_no = '$NupNo' and lot_no = '$val'";
                        // $countRs = $this->m_wsbangun->getData_by_query($count);
                        // $hasil = $countRs[0]->cnt;
                        // if($hasil == 0){
                        //     $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                        // }

                        $count = "SELECT COUNT (*) as cnt from mgr.rl_reserve_nup_dt where nup_no = '$NupNo' and lot_no = '$val'";
                        $countRs = $this->m_wsbangun->getData_by_query_cons($cons,$count);
                        $hasil = $countRs[0]->cnt;
                        if($hasil == 0){
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                            $updateCntr = $this->m_wsbangun->setData_by_query_cons($cons,"UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
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
                $this->m_wsbangun->deletedata_cons($cons,'rl_reserve_nup_dt',$where);
                // var_dump('selesai');


                // $tblDt = 'rl_reserve_nup_dt';
               

                // $updateCntr2 = $this->m_wsbangun->setData_by_query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = 'AP010001' and entity_Cd = '$entity' and project_no = '$project'");

                $tblHd = 'v_rl_reserve_nup_hd';
                $critHd = array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'nup_no'=>$NupNo);

                $dataHd = $this->m_wsbangun->getData_by_criteria_cons($cons,$tblHd,$critHd);
                $TotQty = $dataHd[0]->total_dtl;
                $LotQty = $dataHd[0]->nup_lot_qty;
                $blnc = $LotQty - $TotQty;
                
                // var_dump($blnc);
                if((int)$blnc >= (int)$TotCount){
                    for ($x = 0; $x <= $countArray-1; $x++) {
                        $datax = array();

                        $countDt = "SELECT count(*) as cnt FROM mgr.rl_reserve_nup_dt WHERE nup_rowid = $PRowID and lot_no = '$data[$x]' ";
                        $dtResult = $this->m_wsbangun->getData_by_query_cons($cons,$countDt);
                        $c = $dtResult[0]->cnt;
                        // var_dump($c);

                        if($c == 0){
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");



                            $sql2 = "SELECT rowid, property_cd, type, nup_counter from mgr.pm_lot (nolock) where entity_cd = '$entity' and project_no = '$project' and lot_no = '$data[$x]' ";
                            $row2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
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

                            $insert = $this->m_wsbangun->insertData_cons($cons,'rl_reserve_nup_dt', $datax);
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
                        // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]'"); 
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
                    // redirect('C_nup_unitNew/index/'.$PRowID.'/'.$PLotQty);
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
            $cons = $this->session->userdata('Tscons');
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
                                    $updateCntr = $this->m_wsbangun->setData_by_query_cons($cons,"UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) - 1 where lot_no = '$value' and entity_Cd = '$entity' and project_no = '$project' and nup_counter > 0");
                                
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
                   
                    $lotCount = "SELECT COUNT (*) as cnt FROM mgr.pm_lot (NOLOCK) WHERE entity_Cd = '$entity' and project_no = '$project' and lot_no ='$val' and ISNULL(nup_counter,0) > 2";
                    $lotResult = $this->m_wsbangun->getData_by_query_cons($cons,$lotCount);
                    $b = $lotResult[0]->cnt;
                    // var_dump($lotCount);exit();

                    $sql1 = "SELECT business_id, nup_no FROM mgr.rl_reserve_nup (NOLOCK) WHERE rowID = $PRowID";
                    $row1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
                    $NupNo = $row1[0]->nup_no;
                    // var_dump($PRowID);
                    // var_dump($NupNo);exit();
                    // $NupNo =$NupNo_;

                    if($b > 0){
                        $msg = "This unit ['".$val."'] has been choosen more than 3";
                        $notif = 'GAGAL';

                        $msg1=array('Pesan'=>$msg,
                                     'nup'=>$NupNo,
                                     'notif'=>$notif);

                        echo json_encode($msg1);

                        exit;
                    }else{
                        // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                        
                        // $count = "SELECT COUNT (*) as cnt from mgr.rl_reserve_nup_dt where nup_no = '$NupNo' and lot_no = '$val'";
                        // $countRs = $this->m_wsbangun->getData_by_query($count);
                        // $hasil = $countRs[0]->cnt;
                        // if($hasil == 0){
                        //     $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                        // }

                        $count = "SELECT COUNT (*) as cnt from mgr.rl_reserve_nup_dt where nup_no = '$NupNo' and lot_no = '$val'";
                        $countRs = $this->m_wsbangun->getData_by_query_cons($cons,$count);
                        $hasil = $countRs[0]->cnt;
                        if($hasil == 0){
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
                            $updateCntr = $this->m_wsbangun->setData_by_query_cons($cons,"UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$val' and entity_Cd = '$entity' and project_no = '$project'");
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

                $dataHd = $this->m_wsbangun->getData_by_criteria_cons($cons,$tblHd,$critHd);
                $TotQty = $dataHd[0]->total_dtl;
                $LotQty = $dataHd[0]->nup_lot_qty;
                $blnc = $LotQty - $TotQty;
                
                // var_dump($blnc);
                if((int)$blnc >= (int)$TotCount){
                    for ($x = 0; $x <= $countArray-1; $x++) {
                        $datax = array();

                        $countDt = "SELECT count(*) as cnt FROM mgr.rl_reserve_nup_dt WHERE nup_rowid = $PRowID and lot_no = '$data[$x]' ";
                        $dtResult = $this->m_wsbangun->getData_by_query_cons($cons,$countDt);
                        $c = $dtResult[0]->cnt;
                        // var_dump($c);

                        if($c == 0){
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");
                            // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]' and entity_Cd = '$entity' and project_no = '$project'");



                            $sql2 = "SELECT rowid, property_cd, type, nup_counter from mgr.pm_lot (nolock) where entity_cd = '$entity' and project_no = '$project' and lot_no = '$data[$x]' ";
                            $row2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
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
                        // $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no = '$data[$x]'"); 
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
                    // redirect('C_nup_unitNew/index/'.$PRowID.'/'.$PLotQty);
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
            $cons = $this->session->userdata('Tscons');

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

                $lotCount = "SELECT COUNT (*) as cnt FROM mgr.pm_lot (nolock) WHERE entity_Cd = '$entity' and project_no = '$project' and lot_no in ($category_string) and ISNULL(nup_counter,0) > 2";
                $lotResult = $this->m_wsbangun->getData_by_query_cons($cons,$lotCount);
                $b = $lotResult[0]->cnt;

                $sql1 = "SELECT business_id, nup_no FROM mgr.rl_reserve_nup WHERE rowID = $PRowID";
                $row1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql1);
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
                    $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no in ($category_string) and entity_Cd = '$entity' and project_no = '$project'");
                    $this->db->query("UPDATE mgr.pm_lot set nup_counter = ISNULL(nup_counter,0) + 1 where lot_no in ($category_string) and entity_Cd = '$entity' and project_no = '$project'");
                }

                $TotCount = $countArray;

                if($TotCount <= $PLotQty && $b == 0){
                    for ($x = 0; $x <= $countArray-1; $x++) {
                        $datax = array();

                        $countDt = "SELECT count(*) as cnt FROM mgr.rl_reserve_nup_dt WHERE nup_rowid = $PRowID and lot_no = '$data[$x]'";
                        $dtResult = $this->m_wsbangun->getData_by_query_cons($cons,$countDt);
                       
                        // if ($dtResult == 'OK'){
                            $c = $dtResult[0]->cnt;    
                        // }
                        

                        if($c == 0){
                           
                            $sql2 = "SELECT rowid, property_cd, type, nup_counter from mgr.pm_lot (nolock) where entity_cd = '$entity' and project_no = '$project' and lot_no = '$data[$x]' ";
                            $row2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);

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