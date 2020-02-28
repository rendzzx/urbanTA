<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class C_Booking_By_Floor extends Core_Controller
{
	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_booking_by_floor');
        $this->load->model('m_wsbangun');
        date_default_timezone_set('Asia/Jakarta');

    }
      public function index()
        { 
            $entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');

        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project);
        	$sql = "SELECT MAX(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;

            $butt = '<a href="'.base_url("newsfeed/index/$project-$projectName").'" class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a>';
            
            

			// $data_project = $this->m_wsbangun->getData_by_criteria("pl_project (NOLOCK)",$where);

            $ContentAllData = array('userLevelList'=>$this->datatable($a),
            						'property_type'=>$this->property_type($a),
            						// 'project_name'=>$data_project[0]->descs,
                                    'project_name'=>$projectName,
                                    'backButton'=> $butt);
            $this->load_content_top_menu('bookingfloor/Index', $ContentAllData);/*
            var_dump($AllData);*/
        }
        function goto_table($property_cd=''){

        	
        	$data = array('userLevelList'=> $this->datatable($property_cd));
        	$this->load->view('bookingfloor/table',$data);
        }
        function goto_table_sales($property_cd=''){

            
            $data = array('userLevelList'=> $this->datatable($property_cd),
                        'property_cd'=>$property_cd);
            $this->load->view('bookingfloor/table_sales_floor',$data);
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
        public function datatable($property_cd=''){
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

            $sql2 = "SELECT lot_no, level_no, remarks, status FROM mgr.pm_lot_web";
            $sql2 .= " WHERE entity_cd = '$entity' ";
            $sql2 .= " AND project_no = '$project' ";
            $sql2 .= " AND property_cd = '$property_cd' ";
            $sql2 .= " AND status <> 'H' ";
            $sql2 .= " ORDER by level_no, lot_no";

            $AllDataUnit = $this->m_wsbangun->getData_by_query($sql2);

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
                        // $kriteria2 = array('entity_cd' => $entity, 
                        //                 'project_no' => $project, 
                        //                 'level_no' => $level,
                        //                 'status <>'=>'H',
                        //                 'property_cd'=>$property_cd);
                        // $AllDataUnit = $this->m_wsbangun->getData_by_criteria($table2, $kriteria2);
                        // var_dump($AllDataUnit);
                        $Listunit = '<td align="left">';
                        if ($AllDataUnitLevel) 
                        {
                            foreach ($AllDataUnitLevel as $key=>$value2) 
                                {
                                    if ($value2->status=='A') 
                                    {
                                        $btn = 'btn-success'; 
                                        $href = '';
                                       /* $Listunit .='<b><span><a href="'.base_url('OptionFloor/lotDetail/'.$value2->lot_no).'" class="btn btn_block '.$btn.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';*/
                                        $Listunit .='<b><span><a href="" class="open-AddBookDialog btn btn_block '.$btn.'"  data-id="'.$value2->lot_no.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';
                                    }
                                    if ($value2->status=='B') 
                                    {
                                        $btn = 'btn-danger';
                                        $href = ''; 
                                        // $Listunit .='<b><span><strong><a href="" class="open-AddBookDialog btn btn_block '.$btn.'"><strong>'.$value2->lot_no.'</strong></a></strong></span></b>';
                                        $Listunit .='<b><span><a href="" class="book-AddBookDialog btn btn_block '.$btn.'"  data-id="'.$value2->lot_no.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';
                                    }
                                    if ($value2->status=='H') 
                                    {
                                        $btn = 'btn-primary';
                                        $href = ''; 
                                        $Listunit .='<b><span><strong><a href="'.base_url('OptionFloor/lotDetail/'.$value2->lot_no).'" class="btn btn_block '.$btn.'"><strong>'.$value2->lot_no.'</strong></a></strong></span></b>';
                                    }
                                    if ($value2->status=='R') 
                                    {
                                        $btn = 'btn-warning';
                                        $href = ''; 
                                        $Listunit .='<b><span><a href="" class="reserve-AddBookDialog btn btn_block '.$btn.'"  data-id="'.$value2->lot_no.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';
                                    }
                                }     

                        }else{
                            $Listunit.='<b><span> UNIT NOT AVALAIBLE </span></b>';
                        }
                        $Listunit .= '</td>';
                        // var_dump($Listunit);
                        $ListAllData .= $Listunit;
                     $ListAllData .='</tr>';
                }
                
                $ContentAllData = $ListAllData;
            } 
            return $ContentAllData;

        }
        public function update_status(){
        	$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
			$lot_no = $this->input->post('id',TRUE);
			$status = $this->input->post('status',TRUE);
			$property_cd = $this->input->post('property_cd',TRUE);
			

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
           var_dump($lot_parm);
        }
}