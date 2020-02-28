<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_cus_summary extends Core_Controller {

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
        $cons = $this->session->userdata('Tscons');

        // var_dump($group);
        $projectName = $this->session->userdata('Tsprojectname');
        // if($entity == ''){
        //     $entity = '2101';
        //     $project = '210101';
        // }

        $userid = $this->session->userdata('Tsname');
        $sql = "SELECT distinct project_no,descs from mgr.v_cfs_user_project (nolock) where userid= '$userid'";
        $data_project = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

        $ContentAllData = array(
                'project_no'=>$project,
                'ProjectDescs'=>$projectName,
                'project'=>$data_project,
                'Listdata'=>$this->datatable($project,$entity),
                'Listdata2'=>$this->datatable2($project,$entity)
             );
        if ($group=='MGM'){
            $this->load_content_mgm('cus_summary/index',$ContentAllData);
        }else{
            $this->load_content_top_menu('cus_summary/index',$ContentAllData);
        }
    }
    function goto_table(){
            $project_no = $this->input->post('project_no',TRUE);
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$project_no'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            
            
            $data = array('Listdata'=>$this->datatable($project_no,$entity),
                           'Listdata2'=> $this->datatable2($project_no,$entity)
                           );

            $this->load->view('cus_summary/indexdata',$data);
          
        }
    public function createpdf(){
            $entity = $this->session->userdata('Tsentity');
            $project_no = $this->input->post('project_no',TRUE);
            
            if(!empty($project_no)){

               $data = array('Listdata'=>$this->datatable($project_no,$entity),
                           'Listdata2'=> $this->datatable2($project_no,$entity));
               var_dump($this->datatable($project_no,$entity));
                $pdf = 'ChooseUnitSum_'.$project_no;
                $filename = 'pdf/Reports/'.$pdf.'.pdf';

                // $html = $this->load->view('grafik/sumary_pdf', $data, true);
                $html = $this->load->view('cus_summary/tampilanpdf', $data, true);
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
                           'Listdata2'=> $this->datatable2($project_no,$entity));
            $this->load->view('cus_summary/tampilanpdf', $data);
        }
    public function download($filename = null)
        {
            $this->load->helper('download');
            $data = file_get_contents(base_url('/pdf/Reports/'.$filename));
            force_download($filename,$data);
        }
   
    public function datatable($project_no=null, $entity_cd=null){
        $cons = $this->session->userdata('Tscons');

        if(!empty($project_no)){

            $sql = "select * from mgr.v_nup_choose_unit where entity_cd ='".$entity_cd."' and project_no='".$project_no."' order by product_cd asc";
            
            
            $nup_listing = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            
            $msg ='Fail';
            if(!empty($nup_listing)) {

                foreach ($nup_listing as $key ) {               
                    $product_distinct[]=$key->product_cd;                         
                    $type_distinct[]=$key->product_type; 
                }
                $product_cd = array_unique($product_distinct);
                $prodtype_cd = array_unique($type_distinct);

                $ListAllData='';
                $ListAllData.='<table class="table  table-bordered" rules="all">';
                $ListAllData.='<thead align="center" style="font-weight:bold;">';
                

                $ListAllData.='<tr>';
                $ListAllData.='<td>Type</td>';
                $ListAllData.='<td>Total Type</td>';
                $ListAllData.='<td>Total Choose Unit</td>';
                $ListAllData.='<td>Balance</td>';
                $ListAllData.='</tr>';
                $ListAllData.='</thead>';
                $ListAllData.='<tbody>';
                $listlead ='';
                foreach ($product_cd as $key ) {//looping apt/lnd (grouping report 1)

                        $sql = "select distinct product_descs from mgr.v_nup_choose_unit where product_cd='".$key."' and entity_cd='".$entity_cd."' and project_no='".$project_no."'";
                        
                        $productnamee = $this->m_wsbangun->getData_by_query($sql);

                        $productname = $productnamee[0]->product_descs;
                        $ListAllData .= '<tr>';
                        $ListAllData .= '<td colspan="4" align="left" style="font-weight:bold;">'.$productname.'</td>';
                        $ListAllData .= '</tr>';

                        foreach ($prodtype_cd as $key2 ) {
                            $sql = "select distinct product_type_descs from mgr.v_nup_choose_unit where product_type='".$key2."' and product_cd='".$key."' and entity_cd='".$entity_cd."' and project_no='".$project_no."'";
                        
                            $typenamee = $this->m_wsbangun->getData_by_query($sql);

                            $typename = $typenamee[0]->product_type_descs;
                            $ListAllData .= '<tr>';
                            $ListAllData .= '<td colspan="4" align="left" style="font-weight:bold;">&emsp;'.$typename.'</td>';
                            $ListAllData .= '</tr>';
                       

                        
                                    $sql = "select * from mgr.v_nup_choose_unit where product_cd = '".$key."' and product_type='".$key2."' and entity_cd='".$entity_cd."' and project_no='".$project_no."' order by nup_type desc";                   
                                    $nup_desc = $this->m_wsbangun->getData_by_query($sql);
                                            
                                    
                                            foreach ($nup_desc as $data ) {
                                                //detail list nup
                                                
                                                $ListAllData .= '<tr>';
                                                $ListAllData .= '<td>&emsp;&emsp;'.$data->type_descs.'</td>';
                                                $ListAllData .= '<td >&emsp;'.$data->total_nup.'</td>';
                                                $ListAllData .= '<td>&emsp;'.$data->total_choose.'</td>';
                                                $ListAllData .= '<td >&emsp;'.$data->bal.'</td>';
                                             
                                                $ListAllData .= '</tr>';
                                                
                                                $totalnup[] = $data->total_nup;
                                                $totalcus[] = $data->total_choose;
                                                $totalbal[] = $data->bal;
                                                $nup[] = $data->total_nup;
                                                $cus[] = $data->total_choose;
                                                $bal[] = $data->bal;

                                            }//end of foreach nupdesc
                                           
                                            $ListAllData .= '<tr>';
                                            $ListAllData .= '<td >Total '.$productname.' :</td>';
                                            $ListAllData .= '<td >&emsp;'.array_sum($nup).'</td>';
                                            $ListAllData .= '<td >&emsp;'.array_sum($cus).'</td>';
                                            $ListAllData .= '<td >&emsp;'.array_sum($bal).'</td>';
                                            $nup =array();
                                            $cus =array();
                                            $bal =array();
                                            $ListAllData .= '</tr>';

                                        }//end of product type foreach

                                   }//End apt/lnd foreach 
                              
                            $ListAllData .= '<tr>';
                            $ListAllData .= '<td >Grand total </td>';
                            $ListAllData .= '<td >&emsp;'.array_sum($totalnup).'</td>';
                            $ListAllData .= '<td >&emsp;'.array_sum($totalcus).'</td>';
                            $ListAllData .= '<td >&emsp;'.array_sum($totalbal).'</td>';
                            
                            $ListAllData .= '</tr>';
                            $ListAllData .='</tbody>';
                            $ListAllData .='</table>';
                    
                } //End empty nup listing
                        
                    else {
                   
                        $ListAllData = '';
                }
                       
                    $msg ='sukses';
            } else { //end of it project is empty

                        $ListAllData = '';
            }        

                return $ListAllData;
    
    }

     public function datatable3($project_no=null, $entity_cd=null){
    //     if(!empty($project_no)){

    //         $sql = "select * from mgr.v_lot_choose_unit where entity_cd ='".$entity_cd."' and project_no='".$project_no."' order by property_cd asc";
            
            
    //         $nup_listing = $this->m_wsbangun->getData_by_query($sql);
            
    //         $msg ='Fail';
    //         if(!empty($nup_listing)){
                

    //             $ListAllData2='';
    //             $ListAllData2.='<table class="table  table-bordered" rules="all">';
    //             $ListAllData2.='<thead align="center" style="font-weight:bold;">';
                

    //             $ListAllData2.='<tr>';
    //             $ListAllData2.='<td>Type</td>';
    //             $ListAllData2.='<td>Total Unit</td>';
    //             $ListAllData2.='<td>NUP Choose Unit</td>';
    //             $ListAllData2.='<td>Available</td>';

    //             $ListAllData2.='</tr>';
    //             $ListAllData2.='</thead>';
    //             $ListAllData2.='<tbody>';

    //             foreach ($nup_listing as $data ) {//looping apt/lnd (grouping report 1)
                        
    //                     $productname = $this->m_wsbangun->getData_by_query($sql);

                        
                       

                        
    //                                             //detail list nup
    //                                             // $ListAllData .= '<tbody>';
    //                                             $ListAllData2 .= '<tr>';
    //                                             // $ListAllData .= '<td class="tblbordered">'.$i.'</td>';
    //                                             $ListAllData2 .= '<td>'.$data->property_descs.'</td>';
    //                                             $ListAllData2 .= '<td >&emsp;'.$data->sum_lot.'</td>';
    //                                             $ListAllData2 .= '<td>&emsp;'.$data->sum_cu.'</td>';
    //                                             $ListAllData2 .= '<td >&emsp;'.$data->sum_avail.'</td>';
                                             
    //                                             $ListAllData2 .= '</tr>';
                                              
    //                                             $nup[] = $data->sum_lot;
    //                                             $cus[] = $data->sum_cu;
    //                                             $bal[] = $data->sum_avail;

    //                                         // $ListAllData .= '<tfoot>';
                                            
    //                                         // $ListAllData .= '</tfoot>';
                                            
                                        
    //                                }//End apt/lnd 
    //                                $ListAllData2 .= '<tr>';
    //                                         $ListAllData2 .= '<td >Total</td>';
    //                                         $ListAllData2 .= '<td >&emsp;'.array_sum($nup).'</td>';
    //                                         $ListAllData2 .= '<td >&emsp;'.array_sum($cus).'</td>';
    //                                         $ListAllData2 .= '<td >&emsp;'.array_sum($bal).'</td>';
    //                                         $nup =array();
    //                                         $cus =array();
    //                                         $bal =array();
    //                                         $ListAllData2 .= '</tr>';
                             
    //                         $ListAllData2 .='</tbody>';
    //                         $ListAllData2 .='</table>';
                    
    //              } //End empty nup listing
                        

                        
    //                     $msg ='sukses';        
            
    //     }else{
    //         $ListAllData2 = '';
    //     }
    //     return $ListAllData2;
        
    }
    public function datatable2($project_no=null, $entity_cd=null){
        $cons = $this->session->userdata('Tscons');
         if(!empty($project_no)){

            $sql = "select * from mgr.v_lot_choose_unit where entity_cd ='".$entity_cd."' and project_no='".$project_no."' ";
            
            
            $nup_listing = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            
            $msg ='Fail';
            if(!empty($nup_listing)) {
                foreach ($nup_listing as $key ) {               
                    $type_distinct[]=$key->property_cd;                         
                    
                }
                $property_cd = array_unique($type_distinct);

                $ListAllData2='';
                $ListAllData2.='<table class="table  table-bordered" rules="all">';
                $ListAllData2.='<thead align="center" style="font-weight:bold;">';
                

                $ListAllData2.='<tr>';
                $ListAllData2.='<td>Type</td>';
                $ListAllData2.='<td>Total Unit</td>';
                $ListAllData2.='<td>NUP Choose Unit</td>';
                $ListAllData2.='<td>Hold</td>';
                $ListAllData2.='<td>Booked</td>';
                $ListAllData2.='<td>Available</td>';
                $ListAllData2.='</tr>';
                $ListAllData2.='</thead>';
                $ListAllData2.='<tbody>';
                $listlead ='';
                foreach ($property_cd as $key ) {//looping apt/lnd (grouping report 1)

                        $sql = "select distinct property_descs from mgr.v_lot_choose_unit where property_cd='".$key."' and entity_cd='".$entity_cd."' and project_no='".$project_no."'";
                        
                        $proname = $this->m_wsbangun->getData_by_query($sql);

                        $propertyname = $proname[0]->property_descs;
                        $ListAllData2 .= '<tr>';
                        $ListAllData2 .= '<td colspan="4" align="left" style="font-weight:bold;">'.$propertyname.'</td>';
                        $ListAllData2 .= '</tr>';
                       

                        
                                    $sql = "select * from mgr.v_lot_choose_unit where property_cd = '".$key."' and entity_cd='".$entity_cd."' and project_no='".$project_no."' order by product_descs ASC";                   
                                    $nup_desc = $this->m_wsbangun->getData_by_query($sql);
                                            
                                    
                                            foreach ($nup_desc as $data ) {
                                                //detail list nup
                                                
                                                $ListAllData2 .= '<tr>';
                                                $ListAllData2 .= '<td>&emsp;'.$data->product_descs.'</td>';
                                                $ListAllData2 .= '<td >&emsp;'.$data->sum_lot.'</td>';
                                                $ListAllData2 .= '<td>&emsp;'.$data->sum_cu.'</td>';
                                                $ListAllData2 .= '<td >&emsp;'.$data->sum_hold.'</td>';
                                                $ListAllData2 .= '<td >&emsp;'.$data->sum_book.'</td>';
                                                $ListAllData2 .= '<td >&emsp;'.$data->sum_available.'</td>';
                                                $ListAllData2 .= '</tr>';
                                                
                                                $totalnup[] = $data->sum_lot;
                                                $totalcus[] = $data->sum_cu;
                                                $totalhol[] = $data->sum_hold;
                                                $totalbok[] = $data->sum_book;
                                                $totalbal[] = $data->sum_available;
                                                $nup[] = $data->sum_lot;
                                                $cus[] = $data->sum_cu;
                                                $hol[] = $data->sum_hold;
                                                $bok[] = $data->sum_book;
                                                $bal[] = $data->sum_available;


                                            }
                                           
                                            $ListAllData2 .= '<tr>';
                                            $ListAllData2 .= '<td >Total '.$propertyname.' :</td>';
                                            $ListAllData2 .= '<td >&emsp;'.array_sum($nup).'</td>';
                                            $ListAllData2 .= '<td >&emsp;'.array_sum($cus).'</td>';
                                            $ListAllData2 .= '<td >&emsp;'.array_sum($hol).'</td>';
                                            $ListAllData2 .= '<td >&emsp;'.array_sum($bok).'</td>';
                                            $ListAllData2 .= '<td >&emsp;'.array_sum($bal).'</td>';
                                            $nup =array();
                                            $cus =array();
                                            $hol =array();
                                            $bok =array();
                                            $bal =array();
                                            $ListAllData2 .= '</tr>';
                                        
                                   }//End apt/lnd 
                              
                            $ListAllData2 .= '<tr>';
                            $ListAllData2 .= '<td >Grand total </td>';
                            $ListAllData2 .= '<td >&emsp;'.array_sum($totalnup).'</td>';
                            $ListAllData2 .= '<td >&emsp;'.array_sum($totalcus).'</td>';
                            $ListAllData2 .= '<td >&emsp;'.array_sum($totalhol).'</td>';
                            $ListAllData2 .= '<td >&emsp;'.array_sum($totalbok).'</td>';
                            $ListAllData2 .= '<td >&emsp;'.array_sum($totalbal).'</td>';
                            $ListAllData2 .= '</tr>';
                            $ListAllData2 .='</tbody>';
                            $ListAllData2 .='</table>';
                    
                 } //End empty nup listing
                        

                        
                        $msg ='sukses';        
            
        } else{
            $ListAllData2 = '';
        }
        return $ListAllData2;
        
    }
    

}
?>