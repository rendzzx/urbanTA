<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OptionFloor extends Core_Controller 
{
               
        public function __construct()
        {
           
            parent::__construct();
            $this->auth_check();/*
            $this->load->helper('form');*/
            $this->load->model('m_optionFloor');
            $this->load->model('m_wsbangun');
            date_default_timezone_set('Asia/Jakarta');
        }

        public function index()
        { 
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $table = 'pm_level';
            $kriteria= array('entity_cd' => $entity, 'project_no' => $project );
            $order = array('seq_no' , 'ASC' );
           /* var_dump($kriteria);*/
            $AllData = $this->m_wsbangun->getData_by_criteria($table, $kriteria, null, $order);
         /* $AllData = $this->m_optionFloor->GetAllData();

*/           /*var_dump($AllData);*/
            if(!empty($AllData))
            {
                $ListAllData = '';          
                foreach ($AllData as $value) 
                {
                    $ListAllData .='<tr>';
                    $ListAllData .='<td>'.$value->descs.'</td>';
                        
                        /*$entity = $this->session->userdata('Tsentity');*/
                        $project = $this->session->userdata('Tsproject');
                        $table2 = 'pm_lot';
                        $level = $value->level_no;
                        $kriteria2 = array('entity_cd' => $entity, 'project_no' => $project, 'level_no' => $level);
                        $AllDataUnit = $this->m_wsbangun->getData_by_criteria($table2, $kriteria2);
                        // var_dump($AllDataUnit);
                        $Listunit = '<td align="left">';
                        if ($AllDataUnit) 
                        {
                            foreach ($AllDataUnit as $key=>$value2) 
                                {
                                    if ($value2->status=='A') 
                                    {
                                        $btn = 'btn-success'; 
                                        $href = '';
                                       /* $Listunit .='<b><span><a href="'.base_url('OptionFloor/lotDetail/'.$value2->lot_no).'" class="btn btn_block '.$btn.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';*/
                                        $Listunit .='<b><span><a href="#addBookDialog" class="open-AddBookDialog btn btn_block '.$btn.'" data-toggle="modal" data-id="'.$value2->lot_no.'"><strong>'.$value2->lot_no.'</strong></a></span></b>';
                                    }
                                    if ($value2->status=='B') 
                                    {
                                        $btn = 'btn-danger';
                                        $href = ''; 
                                        $Listunit .='<b><span><strong><a href="'.base_url('OptionFloor/lotDetail/'.$value2->lot_no).'" class="btn btn_block '.$btn.'"><strong>'.$value2->lot_no.'</strong></a></strong></span></b>';
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
                                        $Listunit .='<b><span><strong><a href="'.base_url('OptionFloor/lotDetail/'.$value2->lot_no).'" class="btn btn_block '.$btn.'"><strong>'.$value2->lot_no.'</strong></a></strong></span></b>';
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
                
                $ContentAllData = array('userLevelList' => $ListAllData);
            } else
            {           

                $ContentAllData = array('userLevelList' => '');         
            }
            
            $this->load_content('floorPlan/OptionFloor', $ContentAllData);/*
            var_dump($AllData);*/
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
        /*public function sendSms()
        {
            if(!is_null($id))
            {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $name = $this->session->userdata('Tsuname');
            $table6 = 'security_users';
            $kriteria6 = array( 'name' => $name );
            $setdata4 = $this->m_wsbangun->getData_by_criteria($table6, $kriteria6);
            }
            if ($setdata4) 
            {
                $telpon = $setdata4[0]->phone_celluler;
                                $kriteria5 = array( 'DestinationNumber' => $telpon,
                                'TextDecoded' => 'Dear Sales Manager, please Check Booking',
                                'CreatorID' => 'mgr'
                    );
                $this->m_sms->sendSms($kriteria5);
            }
        }*/
}