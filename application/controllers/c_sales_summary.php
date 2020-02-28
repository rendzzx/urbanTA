<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_sales_summary extends Core_Controller {

    public function __construct(){ 
        parent::__construct();
        $this->auth_check();
        // $this->load->model('m_rl_sales_list');
        $this->load->model('m_wsbangun');
        $this->load->model('m_sms');
        $this->load->model('m_business');
    }
    public function index(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $group = $this->session->userdata('Tsusergroup');
        // var_dump($group);
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
        // }

        $userid = $this->session->userdata('Tsname');
            $sql = "SELECT distinct project_no,descs from mgr.v_cfs_user_project (nolock) where userid= '$userid'";
            $data_project = $this->m_wsbangun->getData_by_query($sql);

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                'project'=>$data_project,
                'Listdata'=>$this->datatable($project,$entity)//,
                //'Listdata2'=>$this->datatable2($project,$entity)
             );
        if ($group=='MGM'){
            $this->load_content_mgm('sales_summary/index',$ContentAllData);
        }else{
            $this->load_content_top_menu('sales_summary/index',$ContentAllData);
        }
    }
    function goto_table(){
            $project_no = $this->input->post('project_no',TRUE);
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$project_no'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            
            
            $data = array('Listdata'=>$this->datatable($project_no,$entity),
                           // 'Listdata2'=> $this->datatable2($project_no,$entity)
                           );

            $this->load->view('sales_summary/indexdata',$data);
          
        }
    public function createpdf(){
            $entity = $this->session->userdata('Tsentity');
            $project_no = $this->input->post('project_no',TRUE);
            
            if(!empty($project_no)){

               $data = array('Listdata'=>$this->datatable($project_no,$entity)//,
                           //'Listdata2'=> $this->datatable2($project_no,$entity)
                        );
               var_dump($this->datatable($project_no,$entity));
                $pdf = 'SalesSum_'.$project_no;
                $filename = 'pdf/Reports/'.$pdf.'.pdf';

                // $html = $this->load->view('grafik/sumary_pdf', $data, true);
                $html = $this->load->view('sales_summary/tampilanpdf', $data, true);
                $a = pdfGenMail($html, $pdf, "A4", "landscape");

                // var_dump($html);
                file_put_contents($filename, $a);   
                $msg = 'ok';
                
            }
            echo $msg;
        }
        public function tes(){
            $project_no = '210101';
            $entity='2101';
            $data = array('Listdata'=>$this->datatable($project_no,$entity),
                           // 'Listdata2'=> $this->datatable2($project_no,$entity)
                );
            $this->load->view('sales_summary/tampilanpdf', $data);
        }
    public function download($filename = null)
        {
            $this->load->helper('download');
            $data = file_get_contents(base_url('/pdf/Reports/'.$filename));
            force_download($filename,$data);
        }
   
    public function datatable($project_no=null, $entity_cd=null){
        if(!empty($project_no)){

            $sql = "select * from mgr.v_sales_summary where entity_cd ='".$entity_cd."' and project_no='".$project_no."' AND property_cd is not null order by property_cd asc";
            
            
            $nup_listing = $this->m_wsbangun->getData_by_query($sql);
            
            $msg ='Fail';
            if(!empty($nup_listing)) {
                foreach ($nup_listing as $key ) {               
                    $prop_distinct[]=$key->property_cd;
                    // $stats_distinct[]=$key->status;
                }
                $property_cd = array_unique($prop_distinct);
                // $status = array_unique($stats_distinct);
                $ListAllData='';
                
                
                $listlead ='';
                foreach ($property_cd as $key ) {//looping apt/lnd (grouping report 1)

                        $sql = "select distinct property_descs from mgr.v_sales_summary where property_cd='".$key."' and entity_cd='".$entity_cd."' and project_no='".$project_no."'";
                        
                        $propertynamee = $this->m_wsbangun->getData_by_query($sql);

                        $propertyname = $propertynamee[0]->property_descs;
                        $ListAllData.='<div align="left" style="font-size:15px;font-weight:bold;" >'.$propertyname.'</div><br>';
                        $ListAllData.='<table class="table  table-bordered" rules="all">';
                        $ListAllData.='<thead align="center" style="font-weight:bold;">';
                        $ListAllData.='<tr rowspan="2" align="center" valign="middle">';
                        $ListAllData.='<td ></td>';
                        $ListAllData.='<td colspan="2">Total</td>';
                        $ListAllData.='<td colspan="2">Sold</td>';
                        $ListAllData.='<td colspan="2">Reserved</td>';
                        $ListAllData.='<td colspan="2">Hold</td>';
                        $ListAllData.='<td colspan="2">Available</td>';
                        $ListAllData.='</tr>';
                        $ListAllData.='<tr align="center">';
                        $ListAllData.='<td></td>';
                        $ListAllData.='<td >Unit</td>';
                        $ListAllData.='<td align="right">Value</td>';
                        $ListAllData.='<td >Unit</td>';
                        $ListAllData.='<td align="right">Value</td>';
                        $ListAllData.='<td >Unit</td>';
                        $ListAllData.='<td align="right">Value</td>';
                        $ListAllData.='<td >Unit</td>';
                        $ListAllData.='<td align="right">Value</td>';
                        $ListAllData.='<td >Unit</td>';
                        $ListAllData.='<td align="right">Value</td>';
                        $ListAllData.='</tr>';
                        $ListAllData.='</thead>';
                        $ListAllData.='<tbody>';

                        $bb = $key;

                        $DataLevel = array_filter($nup_listing,function($a) use($bb) {
                        
                            return $a->property_cd === $bb;
                        });
                         foreach ($DataLevel as $keylevel ) {               
                            $level_distinct[]=$keylevel->level_no;
                    // $stats_distinct[]=$key->status;
                        }
                        $level_no = array_unique($level_distinct);
                        // $sql = "select distinct level_no from mgr.v_sales_summary where property_cd='".$key."' and entity_cd='".$entity_cd."' and project_no='".$project_no."'";
                        // $level_no = $this->m_wsbangun->getData_by_query($sql);
                        // var_dump($level_no);
                        // $totalamt[] =0;
                        // var_dump($totalamt);
                        foreach ($level_no as $key2 ) {
                            
                            $sql = "select distinct level_descs from mgr.v_sales_summary where level_no='".$key2."' and property_cd='".$key."' and entity_cd='".$entity_cd."' and project_no='".$project_no."' AND property_cd is not null";                            
                            $levelnamee = $this->m_wsbangun->getData_by_query($sql);
                            $levelname = @$levelnamee[0]->level_descs;
                            // var_dump($levelname);
                            
                            $DataUnit = array_filter($DataLevel,function($a) use($key2) {
                        
                                return $a->level_no === $key2;
                            });
                            
                            foreach ($DataUnit as $keyunit ) {               
                            $amt_sum[]=$keyunit->value;
                            
                            }
                            // var_dump($amt_sum);
                            // if($key2=='03'){
                            //     var_dump($amt_sum);
                            //     exit();
                            // }
                             $unitall = count($DataUnit);
                             $totalunit[] = count($DataUnit);
                             $amountall = array_sum($amt_sum);
                             $amt_sum = array();
                             $totalamt[] =$amountall; //array_sum($amt_sum);//array_sum($DataUnit);
                            // $sql = "select ISNULL(COUNT(*),0) AS unit from mgr.v_sales_summary where property_cd = '".$key."' and level_no='".$key2."'  and entity_cd='".$entity_cd."' and project_no='".$project_no."' ";                   
                            // $unitalll = $this->m_wsbangun->getData_by_query($sql);
                            // $unitall = $unitalll[0]->unit;

                            // $sql = "select amount=CONVERT(varchar, CAST(ISNULL(sum(value), 0) AS money), 1),sum(value) as realamt from mgr.v_sales_summary where property_cd = '".$key."' and level_no='".$key2."'  and entity_cd='".$entity_cd."' and project_no='".$project_no."' ";                 
                            // $amtall = $this->m_wsbangun->getData_by_query($sql);
                            // $amountall = $amtall[0]->amount;
                            // $realamtall=$amtall[0]->realamt;
                            if($levelname!="" || !empty($levelname)) {

                            
                            $ListAllData .= '<tr>';
                            $ListAllData .= '<td style="width:160px;">'.$levelname.'</td>';
                            $ListAllData .= '<td align="center">'.$unitall.'</td>';
                            $ListAllData .= '<td align="right">'.number_format($amountall,2).'</td>';
                            // $ListAllData .= '<td></td>';
                            // $ListAllData .= '<td align="right"></td>';
                            // $ListAllData .= '<td></td>';
                            // $ListAllData .= '<td align="right"></td>';
                            // $ListAllData .= '<td></td>';
                            // $ListAllData .= '<td align="right"></td>';
                            // $status=array('B','H','A');
                            // foreach ($status as $key3 ) {
                                //var_dump($status);
                                // exit();
                            //SOLD
                            $DataUnitStatusB = array_filter($DataUnit,function($b)  {
                        
                                return $b->status === 'B';
                            });
                             if(!empty($DataUnitStatusB)) {
                                foreach ($DataUnitStatusB as $keyunitB ) {               
                                $amt_sumB[]=$keyunitB->value;
                                
                                }
                                
                                 $unitstatusB = count($DataUnitStatusB);
                                 $totalunitB[] = count($DataUnitStatusB);
                                 $amountstatusB = array_sum($amt_sumB);
                                 // $totalamtB[] = array_sum($amt_sumB);
                                 $amt_sumB = array();
                                 $totalamtB[] =$amountstatusB;
                             } else {
                                 $unitstatusB = 0;
                                 $totalunitB[] = 0;
                                 $amountstatusB = 0;
                                 $totalamtB[] = 0;
                             }
                             //---------------------
                            $DataUnitStatusR = array_filter($DataUnit,function($e)  {
                        
                                return $e->status === 'R';
                            });
                            if(!empty($DataUnitStatusR)) {
                                foreach ($DataUnitStatusR as $keyunitR ) {               
                                $amt_sumR[]=$keyunitR->value;
                                
                                }
                                
                                 $unitstatusR = count($DataUnitStatusR);
                                 $totalunitR[] = count($DataUnitStatusR);
                                 $amountstatusR = array_sum($amt_sumR);
                                 $amt_sumR = array();
                                 $totalamtR[] =$amountstatusR;
                             } else {
                                $unitstatusR = 0;
                                 $totalunitR[] = 0;
                                 $amountstatusR = 0;
                                 $totalamtR[] = 0;
                             }
                            
                             //---------------------
                            $DataUnitStatusH = array_filter($DataUnit,function($c)  {
                                return $c->status === 'H';
                            });
                            if(!empty($DataUnitStatusH)) {
                                foreach ($DataUnitStatusH as $keyunitH ) {               
                                $amt_sumH[]=$keyunitH->value;
                                
                                }
                                
                                 $unitstatusH = count($DataUnitStatusH);
                                 $totalunitH[] = count($DataUnitStatusH);
                                 $amountstatusH = array_sum($amt_sumH);
                                 $amt_sumH = array();
                                 $totalamtH[] =$amountstatusH;
                            } else {
                                $unitstatusH = 0;
                                 $totalunitH[] = 0;
                                 $amountstatusH = 0;
                                 $totalamtH[] = 0;
                             }

                             //---------------------
                            $DataUnitStatusA = array_filter($DataUnit,function($d)  {
                                return $d->status === 'A';
                            });
                            if(!empty($DataUnitStatusA)) {
                                foreach ($DataUnitStatusA as $keyunitA ) {               
                                $amt_sumA[]=$keyunitA->value;
                                
                                }
                                
                                 $unitstatusA = count($DataUnitStatusA);
                                 $totalunitA[] = count($DataUnitStatusA);
                                 $amountstatusA = array_sum($amt_sumA);
                                 $amt_sumA = array();
                                 $totalamtA[] = $amountstatusA;
                             } else {
                                $unitstatusA = 0;
                                 $totalunitA[] = 0;
                                 $amountstatusA = 0;
                                 $totalamtA[] = 0;
                             }
                             //        $sql = "select ISNULL(COUNT(*),0) AS unit from mgr.v_sales_summary where property_cd = '".$key."' and level_no='".$key2."' and status='B' and entity_cd='".$entity_cd."' and project_no='".$project_no."' ";
                             //        // var_dump($sql);                   
                             //        $unitstatsB = $this->m_wsbangun->getData_by_query($sql);
                             //        $unitstatusB = $unitstatsB[0]->unit;

                             //        $sql1 = "select amount = CONVERT(varchar, CAST(ISNULL(sum(value), 0) AS money), 1),sum(value) as realamt from mgr.v_sales_summary where property_cd = '".$key."' and level_no='".$key2."' and status='B' and entity_cd='".$entity_cd."' and project_no='".$project_no."' ";  
                             //        // var_dump($sql1);              
                             //        $amtstatsB = $this->m_wsbangun->getData_by_query($sql1);
                             //        // var_dump($amtstatsB);
                             //        $amountstatusB = $amtstatsB[0]->amount;
                             //        // $realamtB=$amtstatsB[0]->realamt;
                                    //END OF SOLD
                                    //HOLD
                                    // $sql2 = "select ISNULL(COUNT(*),0) AS unit from mgr.v_sales_summary where property_cd = '".$key."' and level_no='".$key2."' and status='H' and entity_cd='".$entity_cd."' and project_no='".$project_no."' ";
                                    // // var_dump($sql);                   
                                    // $unitstatsH = $this->m_wsbangun->getData_by_query($sql2);
                                    // $unitstatusH = $unitstatsH[0]->unit;

                                    // $sql3 = "select amount = CONVERT(varchar, CAST(ISNULL(sum(value), 0) AS money), 1) ,sum(value) as realamt from mgr.v_sales_summary where property_cd = '".$key."' and level_no='".$key2."' and status='H' and entity_cd='".$entity_cd."' and project_no='".$project_no."' ";  
                                    // // var_dump($sql1);              
                                    // $amtstatsH = $this->m_wsbangun->getData_by_query($sql3);
                                    // $amountstatusH = $amtstatsH[0]->amount;
                                    // // $realamtH=$amtstatsH[0]->realamt;
                                    // //END OF HOLD
                                    // //AVAIL
                                    // $sql4 = "select ISNULL(COUNT(*),0) AS unit from mgr.v_sales_summary where property_cd = '".$key."' and level_no='".$key2."' and status='A' and entity_cd='".$entity_cd."' and project_no='".$project_no."' ";
                                    // // var_dump($sql);                   
                                    // $unitstatsA = $this->m_wsbangun->getData_by_query($sql4);
                                    // $unitstatusA = $unitstatsA[0]->unit;

                                    // $sql5 = "select amount = CONVERT(varchar, CAST(ISNULL(sum(value), 0) AS money), 1),sum(value) as realamt  from mgr.v_sales_summary where property_cd = '".$key."' and level_no='".$key2."' and status='A' and entity_cd='".$entity_cd."' and project_no='".$project_no."' ";  
                                    // // var_dump($sql1);              
                                    // $amtstatsA = $this->m_wsbangun->getData_by_query($sql5);
                                    // $amountstatusA = $amtstatsA[0]->amount;
                                    // // $realamtA=$amtstatsA[0]->realamt;
                                    //AVAIL

                                    $ListAllData .= '<td align="center">'.$unitstatusB.'</td>';
                                    // var_dump($unitstatusB);
                                    if($unitstatusB==0) {
                                        $ListAllData .= '<td align="right">'.number_format(0,2).'</td>';
                                    }else{
                                        $ListAllData .= '<td align="right">'.number_format($amountstatusB,2).'</td>';
                                    }

                                    $ListAllData .= '<td align="center">'.$unitstatusR.'</td>';
                                    // var_dump($unitstatusB);
                                    if($unitstatusR==0) {
                                        $ListAllData .= '<td align="right">'.number_format(0,2).'</td>';
                                    }else{
                                        $ListAllData .= '<td align="right">'.number_format($amountstatusR,2).'</td>';
                                    }

                                    $ListAllData .= '<td align="center">'.$unitstatusH.'</td>';
                                    if($unitstatusH==0) {
                                        $ListAllData .= '<td align="right">'.number_format(0,2).'</td>';
                                    }else{
                                        $ListAllData .= '<td align="right">'.number_format($amountstatusH,2).'</td>';
                                    }

                                    $ListAllData .= '<td align="center">'.$unitstatusA.'</td>';
                                    if($unitstatusA==0) {
                                        $ListAllData .= '<td align="right">'.number_format(0,2).'</td>';
                                    }else{
                                        $ListAllData .= '<td align="right">'.number_format($amountstatusA,2).'</td>';
                                    }
                                    
                                    // 
                                    // $ListAllData .= '<td align="right">'.number_format($amountstatusH,2).'</td>';
                                    // 
                                    // $ListAllData .= '<td align="right">'.number_format($amountstatusA,2).'</td>';
                                    
                                // }
                                    $ListAllData .= '</tr>';//end of rows
                                      
                                // $totalunit[] = $unitalll[0]->unit;
                                // $totalunit[] = 123;
                                // $totalunitB[] = $unitstatsB[0]->unit;
                                // $totalunitH[] = $unitstatsH[0]->unit;
                                // $totalunitA[] = $unitstatsA[0]->unit;
                                
                                // $totalamt[] = $amtall[0]->realamt;
                                // $totalamtB[] = $amtstatsB[0]->realamt;
                                // $totalamtH[] = $amtstatsA[0]->realamt;
                                // $totalamtA[] = $amtstatsA[0]->realamt;
                                // var_dump(array_sum($totalamt));
                                // $cus[] = $data->total_choose;
                                // $bal[] = $data->bal;

                                         }//end of if levelname 
                                       
                                }//end of level
                                $totalamttt = array_sum($totalamt);
                            $ListAllData .= '<tr >';
                            $ListAllData .= '<td align="left"><b>Total </b></td>';
                            $ListAllData .= '<td align="center"><b>'.array_sum($totalunit).'</b></td>';
                            $ListAllData .= '<td align="right"><b>'.number_format($totalamttt,2).'</b></td>';
                            $totalamttt = 0;
                            // $totalamt =array();
                            $ListAllData .= '<td align="center"><b>'.array_sum($totalunitB).'</b></td>';
                            $ListAllData .= '<td align="right"><b>'.number_format(array_sum($totalamtB),2).'</b></td>';
                            $ListAllData .= '<td align="center"><b>'.array_sum($totalunitR).'</td>';
                            $ListAllData .= '<td align="right"><b>'.number_format(array_sum($totalamtR),2).'</b></td>';
                            $ListAllData .= '<td align="center"><b>'.array_sum($totalunitH).'</td>';
                            $ListAllData .= '<td align="right"><b>'.number_format(array_sum($totalamtH),2).'</b></td>';
                            $ListAllData .= '<td align="center"><b>'.array_sum($totalunitA).'</td>';
                            $ListAllData .= '<td align="right"><b>'.number_format(array_sum($totalamtA),2).'</b></td>';
                            $ListAllData .= '</tr>'; 
                            // var_dump(array_sum($totalamt));
                            // unset($totalamt);
                            $totalunit =array();
                            $amt_sum = array();
                            $totalamt =array();
                            $totalunitB =array();  
                            $totalamtB =array();
                            $totalunitR =array();  
                            $totalamtR =array();
                            $totalunitH =array();
                            $totalamtH =array();
                            $totalunitA =array(); 
                            $totalamtA =array(); 
                            $ListAllData .='</tbody>';
                            $ListAllData .='</table>';
                            $ListAllData .='<br>';
                    
                                   }//End of property_cd

              
                            
                 } //End empty nup listing
                        

                        
                        $msg ='sukses';        
            
        } else{
            $ListAllData = '';
        }
        return $ListAllData;
        
    }
    

}
?>