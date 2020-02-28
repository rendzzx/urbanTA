<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class c_booking_landed extends Core_Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_booking_by_floor');
        $this->load->model('m_wsbangun');
        $this->load->model('m_business');
        $this->load->model('m_sms');

        date_default_timezone_set('Asia/Jakarta');

    }
    

    public function indexland($rowid = null, $property_cd = null,$property_type=null)    
        {
            
            $rowidd=$rowid;

           
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');

            $cons = $this->session->userdata('Tscons');
           
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $approver = 1;

            $pcd = $property_cd;
            
           
            $sql = "SELECT  status =mgr.pm_lot_web.STATUS,project_no = mgr.pm_lot_web.project_no  ,property_cd = mgr.pm_lot_web.property_cd";
            $sql .= ",level_no = mgr.pm_lot_web.level_no ,lot_no = mgr.pm_lot_web.lot_no ";
            $sql .= ",theme = mgr.pm_theme.descs,descs = mgr.pm_lot_web.descs   ,type   ,build_up_area  ,land_area ";
            $sql .= ",coord  ,coord_status = ISNULL(coord_status, 0) ,nup_counter ";
            $sql .= ",type_descs = (select descs from mgr.cf_lot_type (NOLOCK) where lot_type= type) ";
            $sql .= ",price_HC = CONVERT(varchar, CAST(mgr.pm_lot_price.trx_amt AS money), 1) ";
            $sql .= ",nup_counter = isnull(mgr.pm_lot_web.nup_counter,0) ";
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
            $sql .= "    AND mgr.pm_lot_web.project_no = '$project' ";//" AND mgr.pm_lot_web.STATUS='A'";
            $query = $this->m_wsbangun->getData_by_query_cons($cons,$sql);            
            
            
            $map_picture = $this->input->post('map_picture',TRUE);
            $areadata[]='';
            $keyarea='';
           
            if(!empty($query)){
                foreach ($query as $value) {                    
                    $nupCounterx = $value->nup_counter >3?3:$value->nup_counter;
                    $statusx = $value->status;
                  
                        $areadata[] = '<area data-key="'.$nupCounterx.'" data-status='.$statusx.' class="sold" alt="" title="" href="#" shape="circle" unit="'.$value->lot_no.'" full="Unit '.$value->descs.'" coords="'.$value->coord.'">';
                  
                    // $ck_in_arr = in_array($value->lot_no, $unit_arr);                    
                   
                    if($property_type=='A'){
                        // if($ck_in_arr){
                        // $keyarea.='{ key: "'.$value->lot_no.'", selected: true, toolTip: "<h2><b>Already Selected : '.$value->nup_counter.' times</b></h2>'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type_descs.' <br>Semi Gross Area : '.$value->build_up_area.' <br>Harga Hardcash : '.$value->price_HC.'"},';
                        // }else{
                            $keyarea.='{ key: "'.$value->lot_no.'", toolTip: "<b></b>'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type_descs.' <br>Semi Gross Area : '.$value->build_up_area.' <br>Harga Hardcash : '.$value->price_HC.'"},';                        
                        // }
                    }
                    if($property_type=='L'){
                        // if($ck_in_arr){
                        // $keyarea.='{ key: "'.$value->lot_no.'", selected: true, toolTip: "<b><h2>Already Selected : '.$value->nup_counter.' times</h2></b>'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type_descs.' <br>Land Area : '.$value->land_area.' <br>Build Area : '.$value->build_up_area.' <br>Harga Hardcash : '.$value->price_HC.' <br>Design Option : '.$value->theme.'"},';
                        // }else{
                            $keyarea.='{ key: "'.$value->lot_no.'", toolTip: "<b></b>'.$value->descs.' ('.$value->lot_no.')<br>Type : '.$value->type_descs.' <br>Land Area : '.$value->land_area.' <br>Build Area : '.$value->build_up_area.' <br>Harga Hardcash : '.$value->price_HC.' <br>Design Option : '.$value->theme.'"},';                        
                        // }
                    }
                    
                    
                }
                              
            }           
            $keyarea.='';
                $areadata = implode("", $areadata);  
            $tess='';
            
            $where = array(
                            'entity_cd'=>$entity,
                            'project_no'=>$project,
                            'rowID' => $rowid
                            );
            $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'cf_property_dtl (NOLOCK)', $where);

            if (!empty($data)) {
                $map_picture = $data[0]->map_picture;         
            }
            $tess='img/FloorPlan/'.$map_picture;

            $Content = array('dataarea' => $areadata,
                            'keyarea' => $keyarea,
                            'project_name'=>$projectName,
                             'ptype'=>$property_type,
                             'map_picture'=>$tess,
                             'pcd'=>$property_cd,
                             'RowID'=> $rowid,
                             
                             'rowidd'=>$rowidd,
                             
                             );

            
            $this->load_content_top_menu('booking_steps/v_nup_land', $Content);
        }

    public function showland($lotno = null,$property_type=null,$property_cd=null)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
        $nupno = $this->session->userdata('NupNo');

        $img ="";
        
        $sql4="SELECT DISTINCT payment_cd from mgr.pm_lot_price (NOLOCK) where lot_no ='$lotno' and HC='Y' and entity_cd ='$entity' and project_no = '$project' ";//ORDER by payment_cd
        $payment = $this->m_wsbangun->getData_by_query_cons($cons,$sql4);
        
        if(empty($payment)){
            $payment = "1";
        }else{
            $payment = $payment[0]->payment_cd;
        }
        // var_dump($lotno);

        $table = 'v_payment_plan (nolock)';
        $object = array('payment_cd', 'descs');
        $where = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'lot_no' =>$lotno);
        $cbpayment = $this->m_wsbangun->getCombo_cons($cons,$table,$object,$where);

        // $table = ''
        // var_dump($cbpayment);

    
        if ($handle = opendir('img/LotInfo/new/')) {
            
            $sql = "select CONVERT(varchar, CAST(trx_amt AS money), 1) AS [price_HC], * from mgr.v_pm_lot_info where lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
            $data = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $pic = $data[0]->pic_name;
            // var_dump($data);
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
        $sql = "select nup_counter from mgr.pm_lot where lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
            $dataLot = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $nup_counter=$dataLot[0]->nup_counter;
        
        
        $content = array('data' => $data,
            'img'=>$list,
            'nup_counter'=>$nup_counter,
            'cbpayment'=>$cbpayment,
            'payment'=>$payment,
            'property_cd'=>$property_cd
            
            );
        if($property_type=='A'){
            $this->load->view('booking_steps/infoaptnew',$content);//apart
        }
        if($property_type=='L')
        {
            $this->load->view('booking_steps/infolandednew',$content);//landed
        }
    }
    public function zoom_payment_cd($lot_no,$entity)
    {
        
        $cons = $this->session->userdata('Tscons');
        $query = "SELECT DISTINCT descs,payment_cd FROM mgr.v_rl_sales_payment where entity_cd='".$entity."' and lot_no= '".$lot_no."' AND ((DATEADD(dd,0,DATEDIFF(dd,0,GETDATE()))) BETWEEN START_DATE AND end_date OR max_end_date BETWEEN START_DATE AND end_date)";
        $lotopdis = $this->m_wsbangun->getData_by_query_cons($cons,$query); 

        // var_dump($query);

        $optidisc='';

        if (!empty($lotopdis)) 
        {
            $optidisc[] = '<option></option>';
            foreach ($lotopdis as $disc) 
            {
                $optidisc[] = '<option data-level="'.$disc->descs.'" value="'.$disc->payment_cd.'">'.$disc->descs.'</option>';
            }
            $optidisc = implode("", $optidisc);
        }
        return $optidisc;
    }

    public function zoom_discount(){
        $cons = $this->session->userdata('Tscons');
          $tableopDis = 'rl_discount';
        $lotopdis = $this->m_wsbangun->getData_cons($cons,$tableopDis);
        $optidisc[] = '<option></option>';
        if (!empty($lotopdis)) 
        {
            
            foreach ($lotopdis as $disc) 
            {
                $optidisc[] = '<option data-level="'.$disc->percent1.'" value="'.$disc->disc_cd.'">'.$disc->descs.'</option>';
            }
            $optidisc = implode("", $optidisc);
        }
        // var_dump($lotopdis);
        return $optidisc;
    }

    public function check_delete_attachment(){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $seqno =  $this->input->post('seqno', TRUE);
        // $sql = "SELECT count(file_attached) as counter FROM mgr.rl_nup_attachment(nolock) ";
        // $sql.= "WHERE entity_cd='$entity' AND project_no='$project' AND nup_sequence_no=$seqno ";
        // // $sql.= "AND (status_attach IS NULL OR status_attach='0')";
        // $dtCnt = $this->m_wsbangun->getData_by_query($sql);
        // $cnt = $dtCnt[0]->counter;
        // var_dump($seqno);
        $sql = "SELECT count(*) as jumlah from mgr.rl_sales_attachment where sales_seq_no = $seqno";
        // echo $sql; exit;
        $query = $this->m_wsbangun->getData_by_query2($sql);
        $cnt = $query[0]->jumlah;
        // var_dump($countDt);exit;

  //       $cnt = $this->check_attachment($seqno,'IN');
        $where=array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'nup_sequence_no'=>$seqno);

        if($cnt == 0){
            // if($cnt==0 ){
                $this->m_wsbangun->deletedata('rl_nup_attachment',$where);
            // }
        }
        echo json_encode($cnt);
    }
    
    public function AddpayAndCust($unit=null,$property_cd=null,$rowID=0)
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $user = $this->session->userdata('Tsuname');
        $projectName = $this->session->userdata('Tsprojectname');
        $cons = $this->session->userdata('Tscons');
        
        if($rowID==null){
            $rowiID=0;
        }
        // var_dump($rowID);
        // $table = 'v_booking';
        // $crit = array('rowID'=>$user);
        // $agent = $this->m_wsbangun->getData_by_criteria($table,$crit);

        $table = 'agent_details';
        $crit = array('userid'=>$user);
        $agent = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
        // var_dump($agent);exit();
        if(!empty($agent)){
            $agent = $agent[0]->agent_name;
        }else{
            $agent="";
        }

        $table = 'cf_country (nolock)';
        $crit = array('country_code', 'descs');
        $cbcountry = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);
        $Squery = "select descs,product_cd from mgr.pm_product where entity_cd='$entity' and project_no='$project' and ";
        $Squery .="product_cd = (select product_cd from mgr.cf_property where property_cd='$property_cd' and entity_cd='$entity' and project_no='$project')";
        $product = $this->m_wsbangun->getData_by_query_cons($cons,$Squery);
        $product_descs = $product[0]->descs;
        $product_cd = $product[0]->product_cd;
        // var_dump($product_descs);
        $Squery ="select convert(varchar,cast(booking_fee_amt AS MONEY),1) AS booking_fee_amt from mgr.rl_spec";
        $booking_fee_amt = $this->m_wsbangun->getData_by_query_cons($cons,$Squery);
        $booking_fee_amt = $booking_fee_amt[0]->booking_fee_amt;



        $table = 'cf_nationality (nolock)';
        $crit = array('nationality_cd', 'descs');
        $cbnationality = $this->m_wsbangun->getCombo_cons($cons,$table,$crit);

        $table1 = 'cb_activity_type(nolock)';
        $crit1 = array('activity_type', 'descs');
        $payment = $this->m_wsbangun->getCombo_cons($cons,$table1,$crit1);

        // $table2 = 'cf_media(nolock)';
        // $crit2 = array('media_cd', 'descs');    
        // $media = $this->m_wsbangun->getCombo($table2,$crit2);
        // var_dump($rowID);
        if($rowID==0){
            $sql = "SELECT counter from mgr.next_number (NOLOCK) where name='sales_seq_no'";
            $dtSeq = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $seqno = (int) $dtSeq[0]->counter;
            $upseq = intval($seqno) + 1;
            $sql = "UPDATE mgr.next_number SET counter = ".$upseq." WHERE name='sales_seq_no'";
            $this->m_wsbangun->setData_by_query_cons($cons,$sql);
            $cnt = $this->cek_nup_attach($entity,$project,$seqno,$user);
        }else{
            $Squery ="select sales_seq_no from mgr.rl_sales where rowid = $rowID";                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
            $seqno = $this->m_wsbangun->getData_by_query_cons($cons,$Squery);
            $seqno =  $seqno[0]->sales_seq_no;
            $sql = "SELECT count(sales_seq_no) as counter FROM mgr.rl_sales_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND sales_seq_no=$seqno ";
            $sql.= "AND (status_attach IS NULL OR status_attach='0')";
            $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
            $cnt = $dtCnt[0]->counter;
        }
        
        // var_dump($rowID);
        // var_dump($seqno);
        $content = array('project'=>$projectName,
                         'comboCountry'=>$cbcountry,
                         'cbnationality'=> $cbnationality,
                          'agent'=>$agent,
                          'unit'=>$unit,
                          'product_descs'=>$product_descs,
                          'payment_method'=>$this->zoom_payment_cd($unit,$entity),
                          'special_discount'=>$this->zoom_discount(),
                          'booking_fee_amt'=>$booking_fee_amt,
                          'seqno'=>$seqno,
                          'cnt'=>$cnt,
                          'payment'=>$payment,
                          'product_cd'=>$product_cd,
                          'rowIdsales'=>$rowID
                          // ,'comboMedia'=>$media
            );
        // var_dump('expression');exit();
        $this->load_content_top_menu('booking_steps/v_rl_BookingNew',$content);
    }

    public function show_edit_data($ID=''){
        // $rowID = (string)$this->input->post('ID', TRUE);
        // $seqno = (string)$this->input->post('seqno', TRUE);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $cons = $this->session->userdata('Tscons');
        $where =array('entity_cd'=>$entity,
                    'project_no'=>$project,
                    'rowID'=>$ID);
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,'v_booking',$where);


        echo json_encode($data);

    }

    function cek_nup_attach($entity='',$project='',$seqno='',$user=''){ 

        $dday = date('d M Y H:i:s');
        /* cek data attachment di db2
        klo ga ada => insert data attachment dari document master di DB1
        klo ada biar aja
        kembalikan nilai count dari data attachment yg statusnya NULL atau 0
        */
        // var_dump($seqno);
        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT count(1) AS cnt FROM mgr.rl_sales_attachment WHERE sales_seq_no=$seqno";
        $dtA = $this->m_wsbangun->getData_by_query2($sql);
        $cnt = $dtA[0]->cnt; 
        // var_dump($seqno);       
        // var_dump($cnt);
        if($cnt == 0)
        {
        // var_dump('expression');
            $sql = "SELECT entity_cd, project_no, document_no, descs, STATUS FROM mgr.rl_document_booking WHERE entity_cd='$entity' AND project_no='$project' ";
            // var_dump($sql);
            $dtB = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            // var_dump($sql);
            if(!empty($dtB))
            {
                foreach ($dtB as $value) {
                    $table = 'rl_sales_attachment';
                    $data = array('entity_cd' => $value->entity_cd, 
                            'project_no' => $value->project_no,
                            'document_no' => $value->document_no,
                            'document_descs' => $value->descs,
                            'document_status' => $value->STATUS,
                            'sales_seq_no' => $seqno,
                            'audit_user' => $user,
                            'audit_date' => $dday);
                    $this->m_wsbangun->insertData2($table, $data);

                }
            }
        }

        $sql = "SELECT count(sales_seq_no) as counter FROM mgr.rl_sales_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND sales_seq_no=$seqno ";
        $sql.= "AND (status_attach IS NULL OR status_attach='0')";
        $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
        $cnt = $dtCnt[0]->counter;
        // var_dump('expression2');exit();
        return $cnt;
    }

    public function discount_cd($payment_cd=null)
    {
        $disc_cd='';
        $where = array('payment_status' => 'A', 
                        'payment_cd'=>$payment_cd);
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_by_criteria_cons($cons,"rl_payment_plan_hd (NOLOCK) ",$where);
        // $data=$data->result();
        // format keluaran di dalam array
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
    public function SaveBookAndCust()
    {
        if($_POST)
        {
            // var_dump($_POST);
            $tday = date('d M Y');
            $today = date('d M Y H:i:s');
            $cons = $this->session->userdata('Tscons');
            // $rowID = $this->input->post('rowID', TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $user = $this->session->userdata('Tsuname');
            $bussiness_id = $this->input->post('business_id', TRUE);
            $rowID = $this->input->post('rowID', TRUE);

            // var_dump($rowID);
            // exit();

            if(empty($bussiness_id)){
                $bussiness_id=0;
            }
            //cf_business
            $salutation =  $this->input->post('salutation', TRUE);
            $customer = $this->input->post('customer', TRUE);
            $country_cd = $this->input->post('country_cd', TRUE);
            $HP = $this->input->post('HP', TRUE);
            $Email = $this->input->post('Email', TRUE);
            $nationality =  $this->input->post('nationality', TRUE);
            $noktp = $this->input->post('noktp', TRUE);
            $address = $this->input->post('address', TRUE);
            $city = $this->input->post('city', TRUE);
            $npwp = $this->input->post('npwp', TRUE);
            $HP = $country_cd.$HP;
            //end cf_business

            //rl_sales
            $unit_book      =$this->input->POST('unit');      
            $txt_list_bf_price = $this->input->post('txt_list_bf_price', TRUE);
            $payment_cd     =$this->input->POST('payment',TRUE);   
            $list_bf_price  =str_replace(",","",$this->input->POST('txt_list_bf_price'));
            $discount       =str_replace(",","",$this->input->POST('txt_discount'));
            $net_price      =str_replace(",","",$this->input->POST('txt_netprice'));
            $tax_cd         =$this->input->POST('txt_tax_cd');
            $list_amt       =str_replace(",","",$this->input->POST('txt_listamt'));
            $contract_price =str_replace(",","",$this->input->POST('txt_contractprice'));        
            $Special_disc_cd    =$this->input->POST('disc');
            $Special_disc_amt   =str_replace(",","",$this->input->POST('txt_aditional_disc'));
            $disct_cd       = $this->discount_cd($payment_cd);
            $seqno = $this->input->post('seqno', TRUE);
            // $booking_fee = str_replace(",","",$this->input->POST('booking_fee'));
            $booking_fee = $this->input->POST('booking_fee');
            $Paymenttype = $this->input->post('paymenttype',true);
            $paymentremarks = $this->input->post('remarkspayment', TRUE);
            $product = $this->input->post('Product_cd', TRUE);


            // $media_cd =  $this->input->post('media', TRUE);
            //end rl_sales
            

            $queryAgentDtl = "SELECT group_cd FROM mgr.v_agent_details (NOLOCK) WHERE userid = '$user'";
            $data = $this->m_wsbangun->getData_by_query_cons($cons,$queryAgentDtl);
            $sales_spv = $data[0]->group_cd;

            $queryMedia = "SELECT media_cd FROM mgr.rl_spec (NOLOCK)";
            $data = $this->m_wsbangun->getData_by_query_cons($cons,$queryMedia);
            $media_cd = $data[0]->media_cd;


            $today = date('d M Y H:i:s');
            
            $table = 'agent_details';
            $crit = array('userid'=>$user);
            $agent = $this->m_wsbangun->getData_by_criteria_cons($cons,$table,$crit);
            if(!empty($agent)) {
                $agent_cd = $agent[0]->agent_cd;
              } else {
                $msg = array('pesan'=>'Insert Cf Business Fail!',
                    'status'=>'Failed');
                    echo json_encode($msg);
                    return;        
              }
            $table = 'pl_project';
                $crit = array('entity_cd'=>$entity,
                    'project_no'=>$project);
                $dtProject = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
                if(!empty($dtProject)) {
                    $debtorType = $dtProject[0]->debtor_type;
                } else {
                    $debtorType = null;                   
                    $msg = array('pesan'=>'debtor_type not set',
                    'status'=>'Failed');
                        echo json_encode($msg);
                    return;
                }

            
            
              $debtor_no='';    
              $table = 'rl_sales with(NOLOCK)';
              $crit = array(
                'lot_no'=>$unit_book,
                'status'=>'T');
              $cnt = $this->m_wsbangun->getCount_by_criteria_cons($cons,$table, $crit);
              $debtor_no = ($cnt>0 ? $unit_book.'-'.$cnt : $unit_book);

             // $table = 'rl_spec';
             //    $submitapp='';
             //    $dtSpec = $this->m_wsbangun->getData($table);
             //    if(!empty($dtSpec)){
             //        $submitapp = $dtSpec[0]->submit_app;    
             //    }

             //    // var_dump($aditional_disc); 

             //    if($submitapp=='N' && $Special_disc_amt==0 ) {
             //        $status = 'B';
             //    }else{
             //        $status = 'E';
             //    }
                // $status = 'N';
              $status = 'U';
                $data_cf_business = $this->save_cf_business($bussiness_id,$customer,$HP,$Email,$user,$country_cd,$address,$noktp,$city,$npwp,$salutation,$nationality);
            $bussiness_id =(string)$data_cf_business['business_id'];
            $nupno=' ';

            if($data_cf_business['pesan'] != 'OK'){
                $msg = array('pesan'=>'Insert Cf Business Fail!',
                    'status'=>'Failed');
                    echo json_encode($msg);
                    return;
            }

             $data= array(
                  "entity_cd"=>$entity,
                  "project_no"=>$project,
                  "lot_no"=>$unit_book,
                  "debtor_acct"=>$debtor_no,
                  "business_id"=>$bussiness_id,
                  "category"=>'I',
                  // "media_cd"=>$media,
                  "contract_no"=>'-',
                  "staff_in_charge"=>$agent_cd,
                  "sales_date"=>date("d M Y"),
                  "audit_user"=>$user,
                  "audit_date"=>date("d M Y h:i:s"),
                  "lot_rowid"=>0,
                  "list_tax_scheme"=>$tax_cd,
                  "list_tax_amt"=>(float)$list_amt,
                  "list_after_tax_amt"=>(float)$list_amt,
                  "list_after_amt"=>($contract_price-$list_amt),
                  "list_before_price"=>(float)$list_bf_price,
                  "list_price"=>(float)$list_bf_price,
                  "disc_cd"=>$disct_cd,
                  "disc_amt"=>(float)$discount,
                  // "sell_price"=>(float)$contract_price,
                  "sell_price"=>(float)$net_price,
                  "currency_cd"=>"IDR",
                  "currency_rate"=>1,
                  "status"=>$status,
                  "payment_cd"=>$payment_cd,
                  "disc_cd_spe"=>$Special_disc_cd,
                  "debtor_type"=>$debtorType,
                  "sales_type"=>"NA"/*$disc*/,
                  "entitas_cd"=>"L",
                  "discount_special_amt"=>(float)$Special_disc_amt,
                  "product_cd"=>$product,
                  "booking_fee_amt"=> $booking_fee,
                  "payment_type" =>$Paymenttype,
                  "payment_type_remarks"=>$paymentremarks,
                  "sales_seq_no"=>$seqno,
                  "media_cd"=>$media_cd,
                  "sales_spv"=>$sales_spv
                  );
              $table = 'rl_sales';
              $where=array('entity_cd'=>$entity,
                            'project_no'=>$project,
                            'rowid'=>$rowID);

              if($rowID==0){
                $insert = $this->m_wsbangun->insertData_cons($cons,$table,$data);
                if($insert == 'OK')
                        {
                            $a="Data has been saved successfully";
                            $psn = "OK";
                        } else {
                            $a= $insert;
                            $psn = "Failed";
                        }  
              }else{
                $update = $this->m_wsbangun->updateData_cons($cons,$table,$data,$where);
                if($update == 'OK')
                        {
                            $a="Data has been Update successfully";
                            $psn = "OK";
                        } else {
                            $a= $insert;
                            $psn = "Failed";
                        }  
              }
               
                
            $sql = "exec mgr.xrl_sales_reg_sml '".$entity."', '".$project."', '".$debtor_no."', '".$debtor_no."', '".$user."' ";      
            $snd = $this->m_wsbangun->setData_by_query_cons($cons,$sql);
            if($snd!='OK'){
                        $a = $snd;
                        $psn ='Fail';
                        // $aa = 'Sent Email Failed, Please Contact your Admin!';  
                    }
            
            
        } else {
            $a = "Data is not valid";
        }
        $msg = array('pesan'=>$a,
                    'status'=>$psn);
        echo json_encode($msg);
    }
    public function save_cf_business($ID='',$name='',$hp='',$email='',$user='',$country_cd='',$address='',$noktp='',$city='',$npwp='',$salutation='', $nationality=''){

        $cons = $this->session->userdata('Tscons');
        $table = 'cf_business';      
        $class =  $this->m_business->zomm_class(); 
        $class_cd = $class[0]->class_cd;
        $msg = '';
        if($ID==0)
        {
            $AutoNumber = $this->m_business->get_autonumber();
            
            $Number = (int)$AutoNumber[0]->COUNTER; 
            $data = array(
                            'business_id'=>$Number,
                            'class_cd'=>$class_cd,
                            'category'=>'I',
                            'statement_type'=>'I',
                            'name'=>$name,                              
                            'hand_phone'=>$hp,
                            'email_addr'=>$email,
                            "audit_user"=>$user,
                            "audit_date"=>date("d M Y h:i:s"),
                            'country_code'=>$country_cd,
                            'address1'=>$address,
                            'city'=>$city,
                            'ic_no'=>$noktp,
                            'income_tax'=>$npwp,
                            'salutation'=>$salutation,
                            'nationality'=>$nationality
                );
            // $msg = $this->m_business->insertData($table,$data);
            $msg = $this->m_wsbangun->insertData_cons($cons,$table, $data);
            $data=array(
                        "COUNTER"=>$Number + 1 
                        );
            $where=array("name" => "business_id");
            $this->m_business->update($data, $where); 
        }
        else
            {
                // var_dump($ID);
                // exit;
                $Number = $ID;
                $data = array(
                                'business_id'=>$Number,
                                'class_cd'=>$class_cd,
                                'category'=>'I',
                                'statement_type'=>'I',
                                'name'=>$name,                              
                                'hand_phone'=>$hp,
                                'email_addr'=>$email,
                                "audit_user"=>$user,
                                "audit_date"=>date("d M Y h:i:s"),
                                'country_code'=>$country_cd,
                                'address1'=>$address,
                            'city'=>$city,
                            'ic_no'=>$noktp,
                            'income_tax'=>$npwp,
                            'salutation'=>$salutation,
                            'nationality'=>$nationality
                                //'payment_type_remarks'=>$paymentremarks
                    );
                $where =array('business_id'=>$Number);
                $msg = $this->m_wsbangun->updateData_cons($cons,$table,$data, $where);
             

            }
        

        
        // var_dump($editdata);
                
        $data_=array('business_id'=>$Number,
                    'pesan'=>$msg);
        
        return $data_;
            
            
    }
    public function addNew()//($dt=null, $row=null)
    {
       
        $this->load->view('booking_steps/v_booking_upload');
    }
    public function LotPriceList()//($dt=null, $row=null)
    {
       
        $this->load->view('booking_steps/v_lot_price');
    }
    private function setUploadOptions()
    {
        $max = (1024*1024)*10;
        $config = array('upload_path'=>'./img/NUP',
            'allowed_types'=>'jpg|png|pdf',
            'max_size'=>$max,
            'overwrite'=>TRUE
        );
        return $config;
    }
    public function downloadFile($seqno='',$document_no=''){
        // var_dump($seqno);
        // var_dump($document_no);
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // $seqno = $this->input->post('seqno',true);
        // $document_no = $this->input->post('document_no',true);
        // $where =array('entity_cd'=>$entity,
        //            'project_no'=>$project,
        //            'nup_sequence_no'=>$seqno,
        //            'document_no'=>$document_no);
        // $data = $this->m_wsbangun->getData_by_criteria('rl_nup_attachment',$where);
        $sql="select file_attachment,file_attached from mgr.rl_sales_attachment ";
        $sql.=" where entity_cd='".$entity."' and project_no='".$project."' and sales_seq_no=".$seqno." and document_no=".$document_no;
        $data = $this->m_wsbangun->getData_by_query2($sql);
        // var_dump($data);
        $filename = $data[0]->file_attachment;
        $filedata = $data[0]->file_attached;
        $a = strrpos($filename, '.')+1;  
        $c = strlen($filename);
        $ext = substr($filename, $a,$c-$a);
        // $file = base64_decode($filedata);
        $file = $filedata;

          switch ($ext) 
            {
              case "pdf": $filetype="application/pdf"; break;
              case "exe": $filetype="application/octet-stream"; break;
              case "zip": $filetype="application/zip"; break;
              case "doc": $filetype="application/msword"; break;
              case "xls": $filetype="application/vnd.ms-excel"; break;
              case "ppt": $filetype="application/vnd.ms-powerpoint"; break;
              case "gif": $filetype="image/gif"; break;
              case "png": $filetype="image/png"; break;
              case "jpeg":
              case "jpg": $filetype="image/jpg"; break;
              default: $filetype="application/force-download";
            }
        // var_dump($file);
        // var_dump(strlen($file));
        header("Pragma: public"); 
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false); 
        header("Content-Type: $ctype");
        header("Cache-Control: no-cache private");
        header("Content-Description: File Transfer");
        header("Content-Type: ".$filetype);
        header('Content-disposition: attachment; filename='.$filename);
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '. strlen($file));
        ob_clean();
        flush();
        echo $file;
        exit;
    }
    function compress($File, $destination, $quality) {
            $source = $File['userfile']['tmp_name'];
            $uploadimage = $File['userfile']['name'];
            $info = getimagesize($source);
            // $tmpName = $_FILES['userfile']['tmp_name'];
            

            list( $width,$height ) = getimagesize( $source );
            // It makes the new image width of 350
            if($width > 1000){
                $width = ($width*0.5);
                $height = ($height*0.5);
            }elseif($width > 2000){
                $width = ($width*0.2);
                $height = ($height*0.2);
            }elseif($width < 1000){
                $width = ($width*0.7);
                $height = ($height*0.7);
            }
            $newwidth = $width;


            // It makes the new image height of 350
            $newheight = $height;

            $thumb = imagecreatetruecolor( $newwidth, $newheight );

            if ($info['mime'] == 'image/jpeg')
                {$image = imagecreatefromjpeg($source);}
            elseif ($info['mime'] == 'image/gif') 
                {$image = imagecreatefromgif($source);}
            elseif ($info['mime'] == 'image/png') 
                {$image = imagecreatefrompng($source);}
            elseif ($info['mime'] == 'image/jpg') 
                {$image = imagecreatefrompng($source);}
            elseif ($info['mime'] == 'image/jpe') 
                {$image = imagecreatefrompng($source);}
            // Resize the $thumb image.
            imagecopyresized($thumb, $image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);


            imagejpeg($thumb, $destination, $quality);          

            return $destination;
        }
    public function saveUpload()
    {
        if($_POST)
        {
            
            $webuser = $this->session->userdata('Tsuname');
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $today = date('d M Y H:i:s');
            $row = $this->input->post('row',true);
            $seqno = $this->input->post('sn',true);
            $files = $_FILES;
            $cnt ='';
            // $picname = str_replace(' ', '_', $files['userfile']['name']);
            $this->load->library('upload');
            $this->upload->initialize($this->setUploadOptions());

                 // var_dump($_POST);
                // var_dump($row);exit();
            $picture = !empty($_FILES) ? $picture = $_FILES["userfile"] : '';
            if(!empty($picture["name"]))
            {
                $picname = str_replace(' ', '_', $picture["name"]);
                $picture = $_FILES["userfile"];
                $psn='';
                
                // var_dump($picname);
                $picture = array_filter($picture);

                $target_dir = "./img/Booking/";
                $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
                $uploadOk = 1;
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["userfile"]["tmp_name"]);
                    if($check !== false) {
                        $msg = "File is an image - " . $check["mime"] . ".";
                        $uploadOk = 1;
                    } else {
                        $msg = "File is not an image.";
                        $uploadOk = 0;
                    }
                }

                // Check file size
                // if ($_FILES["userfile"]["size"] > 500000) {
                //     $msg = "Sorry, your file is too large.";
                //     $uploadOk = 0;
                // }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                // var_dump($msg);
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    $msg = "Sorry, your file was not uploaded.";
                    $psn = "Failed";
                // if everything is ok, try to upload file
                } else {
                    // var_dump('expression');
                    if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_file)) {
                        $msg = "The file ". basename( $_FILES["userfile"]["name"]). " has been uploaded.";
                        $psn = "OK";
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                        $psn = "Failed";
                        // var_dump('fail wkwk');
                    }
                    if($psn == "OK"){
                    // $picname = str_replace(' ', '_', $files['userfile']['name']);
                        $descs ="img/Booking/".$picname;
                        $url=base_url().$descs;
                        $sql = "UPDATE MGR.rl_sales_attachment SET file_attachment='$picname', status_attach='1', audit_date='$today', file_url='$url'";
                        $sql.= "WHERE rowID=$row";
                        $update = $this->m_wsbangun->setData_by_query2($sql);
                        if($update =='OK'){
                            $msg = "File has been saved successfully";
                            $psn = "OK";
                        } else {
                            $msg = $update;
                            $psn = "Failed";
                        }
                    } else {
                        $msg = "Sorry, there was an error uploading your file.";
                        $psn = "Failed";
                    }
                }
                
                
                
                // $sql = "SELECT count(sales_seq_no) as counter FROM mgr.rl_sales_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND sales_seq_no=$seqno ";
                // $sql.= "AND (status_attach IS NULL OR status_attach='0')";
                // $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
                // $cnt = $dtCnt[0]->counter;
                // if(empty($dtCnt)){
                //     $cnt = 0;
                // }
            } else {
              
               $msg = "Sorry, there was an error uploading your file.";
               $psn = "Failed";
            }

                
            // }
            $res = array('pesan'=>$msg, 
                        'status'=>$psn
                        );
            echo json_encode($res);

        
        }
    }
    // public function saveUpload()
    // {
    //     if($_POST)
    //     {
    //         $webuser = $this->session->userdata('Tsuname');
    //         $entity = $this->session->userdata('Tsentity');
    //         $project = $this->session->userdata('Tsproject');
    //         $today = date('d M Y H:i:s');
    //         $row = $this->input->post('row',true);
    //         $seqno = $this->input->post('sn',true);
    //         $files = $_FILES;
    //         $cnt ='';
    //         // $picname = str_replace(' ', '_', $files['userfile']['name']);
    //         $this->load->library('upload');
    //         $this->upload->initialize($this->setUploadOptions());
    //         // var_dump($_FILES);exit();
    //         // if(!$this->upload->do_upload()) 
    //         // { 
    //         //     // $data['error'] = $this->upload->display_errors();
    //         //     $msg = $this->upload->display_errors();
    //         //     // var_dump($data);
    //         //     // return $data;
    //         // } else {
    //         // var_dump($files);
    //             $tmpName = $_FILES['userfile']['tmp_name'];
                
    //             $imgString = file_get_contents($tmpName);
    //             $rr = basename($_FILES["userfile"]["name"]);
    //             $descs ="img/FloorPlan/".$picname;
    //             // $mm = file_get_contents($descs);
    //             // $ddd = $this->compress($tmpName,$descs,75);
    //             $ddd = $this->compress($files,$descs,100);
    //             // $out_image=addslashes(file_get_contents($ddd));
    //             $out_image=file_get_contents($ddd);
    //             // var_dump($out_image);
    //             // var_dump('==============================================');
    //             // var_dump($mm);
    //             // exit();
    //             // var_dump($imgString);exit();
    //             $imgData = bin2hex($imgString);
    //             $url=base_url().$descs;
    //             var_dump($url);exit();
    //             // $imgData = bin2hex($out_image);
    //             // $imgData = bin2hex($out_image);
    //             $imgbin ="0x".$imgData; 
    //             // var_dump($imgbin);
    //             // return;
    //             $sql = "UPDATE MGR.rl_sales_attachment SET file_attachment='$picname', status_attach='1', audit_date='$today', file_url='$url'";
    //             // $sql = "UPDATE MGR.rl_sales_attachment SET file_attachment='$picname', file_attached=$imgbin, status_attach='1', audit_date='$today' ";
    //             $sql.= "WHERE rowID=$row";
    //             $this->m_wsbangun->setData_by_query2($sql);
    //             // $data =array('file_attachment'=>$picname,
    //             //          'file_attached'=>"0x".$imgData,
    //             //          'status_attach'=>'1',
    //             //          'audit_date'=>$today
    //             //  );
    //             // $where=array('rowID'=>$row);
    //             // $this->m_wsbangun->updateData('rl_nup_attachment',$data,$where);
    //             unlink($descs);//delete file compress
    //             $msg = "file has been saved successfully";

    //             $sql = "SELECT count(sales_seq_no) as counter FROM mgr.rl_sales_attachment(nolock) WHERE entity_cd='$entity' AND project_no='$project' AND sales_seq_no=$seqno ";
    //             $sql.= "AND (status_attach IS NULL OR status_attach='0')";
    //             $dtCnt = $this->m_wsbangun->getData_by_query2($sql);
    //             $cnt = $dtCnt[0]->counter;
    //             if(empty($dtCnt)){
    //                 $cnt = 0;
    //             }
    //         // }
    //         $res = array('pesan'=>$msg, 
    //                     'count'=>$cnt
    //                     );
    //         echo json_encode($res);
    //         // $this->insert($data);
    //         // return;
    //         // save
    //         // $table = 'rl_nup_attachment(nolock)';
    //         // $crit = array('rowID'=>$row);


    //     } 
    //     // else {
    //     //  show_404();
    //     //  return;
    //     // }
    // }
    public function getTable()
    {
        $lotno = $this->input->post("lot_no",true);
        if(empty($lotno)){
            $lotno='';
        }
        $paymentcd = $this->input->post("paymentcd",true);
        if(empty($paymentcd)){
            $paymentcd='';
        }
        
        $sSearch = $this->input->post("sSearch",true);
        if(empty($sSearch)){
            $sSearch='';
        }
        // var_dump($aProject);

        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $this->load->library('Datatables');
        $DB2 = $this->load->database($cons, TRUE);
        $project = $this->session->userdata('Tsproject');
        //untuk PK diharap diletakan di awal array
        // $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number','line_no', 'trx_descs', 'freq','trx_amt','due_date');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.v_rl_lot_price_dtl a';

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
        $SordField = ($sortIdColumn==0? 'line_no' :$Column[$sortIdColumn]['name']);
        $SordField = 'a.'.$SordField;

     
// var_dump($Search);
        // filter
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
        $param =" Where a.entity_cd='".$entity."' AND a.lot_no ='$lotno' AND a.payment_cd ='$paymentcd' AND a.project_no= '".$project."'  ".$filter_search;//AND (getdate() BETWEEN start_date and end_date)
        $rResult = $this->m_wsbangun->getlisttableCal_cons($cons,$sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param);
      // var_dump($rResult);
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
    public function getTableAttach()
    {
        $entity = $this->session->userdata('Tsentity');
        // var_dump($entity);
        $project = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $seqno = $this->input->post('seqno', true);
        $DB2 = $this->load->database('ifca2', TRUE);

        //untuk PK diharap diletakan di awal array
        $aField = array('id', 'subject', 'content','status');
        $aColumns  = array('row_number', 'document_no', 'document_descs', 'file_attachment','file_url');
        // $aColumns = array('entity_cd', 'entity_name');
        $sTable = 'mgr.rl_sales_attachment';

        $iDisplayStart = (int)$this->input->get_post('start', true);
        $iDisplayLength = (int)$this->input->get_post('length', true);
        // if($iDisplayLength<0){
        //  $iDisplayLength=5;
        // }
        $order = $this->input->get_post('order', true);
        $draw = (int)$this->input->get_post('draw', true);
        $Column = $this->input->get_post('columns', true);
        // $iSortCol_0 = $this->input->get_post('iSortCol_0', true);
        // $iSortingCols = $this->input->get_post('iSortingCols', true);
        $sSearch = $this->input->get_post('search', true);
        $Search = $sSearch['value'];

        $Search_regex = $sSearch['regex'];
        $SortdOrder = $order[0]['dir'];
        $sortIdColumn = (int)$order[0]['column'];
        // var_dump($Column[$sordIdColumn]['name']);
        $SordField = ($sortIdColumn==0? $aColumns[1] :$column[$sortIdColumn]['name']);

     

        // filter
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
        $param =" Where sales_seq_no=".$seqno." AND entity_cd='".$entity."' AND project_no= '".$project."' ".$filter_search;
        $field=" document_no,document_descs,file_attachment,rowID,sales_seq_no,file_url ";
        $rResult = $this->m_wsbangun->getlisttableattach($sTable,(int)($iDisplayStart),(int)($iDisplayLength),$SordField,$SortdOrder,$param,$field);
      // var_dump($rResult);
      // return;
        // Total data set length
        
        // $sql="select count(*) as cnt from ".$sTable." ".$param;
        // $ts = $DB2->query($sql);
        // $a = $ts->result()[0]->cnt;

        // $iTotal = $a;//$DB2->count_all($sTable);
    
        // Output
        $output = array(
            'draw' => intval($draw),
            // 'recordsTotal' => $iTotal,
            // 'recordsFiltered' => $iTotal,
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
    public function goto_table($payment=null,$lotno=null){
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $sql = "SELECT price_HC = CONVERT(varchar, CAST(trx_amt AS money), 1),* from mgr.v_pm_lot_info where payment_cd='$payment' AND lot_no='$lotno' and entity_cd ='$entity' and project_no = '$project'";
        $data = $this->m_wsbangun->getData_by_query($sql);

        $content = array('data' => $data, );
        $this->load->view('booking_steps/tablelanded',$content);
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

      public function zoom_payment2(){
        $ent = $this->input->post('paymentcd',TRUE);
        $lot_no = $this->input->post('lotno',TRUE);
        

        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        // var_dump($ent);
        // $table = "SELECT DISTINCT payment_cd,descs from mgr.v_payment_plan where lot_no ='$lot_no' and entity_cd = '$entity' and project_no = '$project' and (DATEADD(dd, 0, DATEDIFF(dd, 0, getdate())) BETWEEN start_date AND end_date)";
        $table = "SELECT DISTINCT descs,payment_cd FROM mgr.v_rl_sales_payment where entity_cd='".$entity."' and lot_no= '".$lot_no."' AND ((DATEADD(dd,0,DATEDIFF(dd,0,GETDATE()))) BETWEEN START_DATE AND end_date OR max_end_date BETWEEN START_DATE AND end_date)";
        $entityName = $this->m_wsbangun->getData_by_query_cons($cons,$table);
        // var_dump($entityName);exit;
            if(!empty($entityName)) {
                $comboEntity[] = '';
                foreach ($entityName as $dtEntity) {
                  if($ent === $dtEntity->payment_cd) {
                    $pilih = 'selected';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtEntity->payment_cd.'">'.$dtEntity->descs.'</option>';

                }
                $comboEntity = implode("", $comboEntity);
            }

            // if(!empty($entityName)) {
            //     $comboEntity = array('val' => [], 'text' => [], 'select' => []);
            //     foreach ($entityName as $dtEntity) {
            //       if($ent === $dtEntity->payment_cd) {
            //         $pilih = 'selected';
            //       } else {
            //         $pilih = '';
            //       }
            //         $comboEntity[] = '<option '.$pilih.' value="'.$dtEntity->payment_cd.'">'.$dtEntity->descs.'</option>';

            //     }
            //     $comboEntity = implode("", $comboEntity);
            // }
            // var_dump($entityName);exit;
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

      
        public function property_type($property_cd='',$type=''){
        	$entity = $this->session->userdata('Tsentity');
        	$project = $this->session->userdata('Tsproject');
        	$where=array('entity_cd'=>$entity,
        				'project_no'=> $project,
        				'property_type'=>$type);
            $table = 'cf_property (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('property_cd', 'descs');

            $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where, $property_cd);

        	// $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
            // var_dump($cbProp);
        	return $cbProp;
        }

        public function indextipe($property_cd=null,$property_type=null)
        {
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $cons = $this->session->userdata('Tscons');
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $pcd = $property_cd;

            $table = 'v_pm_lot_level';
            $where = array('property_cd'=>$pcd,
                            'entity_cd'=>$entity,
                            'project_no'=>$project);
            $data = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $where);
            $data2 = $this->m_wsbangun->getData_by_criteria_cons($cons, 'cf_property (NOLOCK)', $where);
            $Content = array(
                            'project_name'=>$projectName,
                            // 'backurl'=>$backurl,
                            'pcd'=>$property_cd,
                            'property_type'=>$data2[0]->descs,
                            'level_no' =>$data[0]->descs
                             );
            $this->load_content_top_menu('booking_steps/v_nup_landed', $Content);
            
        }

    public function property_types()
        {
         $entity = $this->session->userdata('Tsentity');
         $project = $this->session->userdata('Tsproject');
         $tabel2 = 'v_pm_lot_level';
         $cons = $this->session->userdata('Tscons');
         $kriteria2 = array(
            'entity_cd'=>$entity,
            'project_no'=>$project
            );

        $datalist2 = $this->m_wsbangun->getData_by_criteria_cons($cons, $tabel2, $kriteria2);
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $sql = "select descs from mgr.v_pm_lot_level (NOLOCK)";
                $cons = $this->session->userdata('Tscons');
                $dtproduct = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
                $text_ = $value->descs;

                $ListAllData .='<div class="col-offset-3 col-2">';
                $ListAllData .='<div data-toggle="buttons">';
                $ListAllData .='<button type="button" name="'.$value->level_no.'" class="btn btn-success" style="margin:5px" onclick="fn_click_btn(\''.$value->level_no.'\');">'.$text_.'</button>';
                $ListAllData .='</div>';//card-body       
                $ListAllData .='</div>';//col-3

            }
        }

        $data = array('property_type'=> $ListAllData);
           $this->load->view('StepBooking/property_type',$data);
        }
    

//  --------------------------------------------------------------------------------------

    public function indexunit($level_no){
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname');
            $cons = $this->session->userdata('Tscons');
            $name = $this->session->userdata('Tsuname');
            $sys = $this->session->userdata('Tsysadmin');
            $lvlno = $level_no;

            $table = 'v_pm_lot';
            $where = array(
                        'level_no'=>$lvlno,
                        'entity_cd'=>$entity,
                        'project_no'=>$project
                    );
            $data = $this->m_wsbangun->getData_by_criteria_cons($cons, $table, $where);
            $data2 = $this->m_wsbangun->getData_by_criteria_cons($cons, 'pm_lot', $where);
            $Content = array(
                            'project_name'=>$projectName,
                            'lvlno'=>$level_no,
                            'property_type'=>$data[0]->lot_no,
                            'lot_no'=>$data2[0]->lot_no
                        );

            // var_dump($Content); exit();
            $this->load_content_top_menu('booking_steps/v_nup_unit', $Content);
            // $this->load_content_top_menu('booking_steps/v_nup_unit');
            
        }

    public function property_unit($level_no=null, $lot_no=null){

         $entity = $this->session->userdata('Tsentity');
         $project = $this->session->userdata('Tsproject');
         $tabel2 = 'v_pm_lot';
         $cons = $this->session->userdata('Tscons');
         $kriteria2 = array(
            'entity_cd'=>$entity,
            'project_no'=>$project,
            );

        $AllDataUnit = $this->m_wsbangun->getData_by_criteria_cons($cons, $tabel2, $kriteria2);

        $chose_unit[]='';
            if(!empty($lot_no)){
                $chose_unit=explode(',', $lot_no);
        }

        $ListAllData = '';
        if (!empty($AllDataUnit)) { 
            
            foreach ($AllDataUnit as $key => $value) {
                $sql = "select lot_no from mgr.v_pm_lot where level_no = '$level_no' ";
                $cons = $this->session->userdata('Tscons');
                $dtproduct = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
                $text_ = $value->lot_no;

                $ListAllData .='<div class="col-offset-3 col-2">';
                $ListAllData .='<div data-toggle="buttons">';
                $ListAllData .='<button type="button" name="'.$value->lot_no.'" class="btn btn-success" style="margin:5px" onclick="fn_click_btn(\''.$value->lot_no.'\');">'.$text_.'</button>';
                $ListAllData .='</div>';//card-body       
                $ListAllData .='</div>';//col-3
            }
        }

           $data = array('property_type'=> $ListAllData);
           $this->load->view('booking_steps/v_nup_unit',$data);
        }


    // public function property_unit($property_cd='', $level_no=null, $lot_no=null){
    
    //     $ContentAllData ='';
    //         $entity = $this->session->userdata('Tsentity');
    //         $project = $this->session->userdata('Tsproject');
    //         $cons = $this->session->userdata('Tscons');
    //         $level_param = '';

    //     if($level_no <> 'L'){
    //          $level_param = " AND level_no = '$level_no' ";
    //     }

    //     $sql="SELECT level_no, descs FROM   MGR.PM_LEVEL (NOLOCK) WHERE ENTITY_CD = '$entity' ";
    //             $sql.=" AND PROJECT_NO     = '$project' ".$level_param."";
    //             $sql.=" AND property_cd     = '$property_cd'";
    //             $sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.pm_lot.LEVEL_NO " ;
    //             $sql.=" FROM   MGR.pm_lot (NOLOCK) " ;
    //             $sql.=" WHERE  MGR.pm_lot.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
    //             $sql.=" AND MGR.pm_lot.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
    //             $sql.=" AND MGR.pm_lot.PROPERTY_CD = '$property_cd')" ;
                

    //     $AllData = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

    //     $sql2 = "SELECT  project_no = mgr.pm_lot.project_no  ,property_cd = mgr.pm_lot.property_cd";
    //         $sql2.= ",level_no = mgr.pm_lot.level_no ,lot_no = mgr.pm_lot.lot_no ";
    //         $sql2 .= ",img = mgr.cf_lot_type_gallery.gallery_url, descs = mgr.pm_lot.descs   ,type ";
    //         $sql2 .= ",CASE WHEN mgr.pm_lot.build_up_area = 0  THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.build_up_area) END AS build_up_area";
    //         $sql2 .= ",CASE WHEN mgr.pm_lot.land_area = 0  THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.land_area) END AS land_area";
    //         $sql2 .= ",coord  ,coord_status = ISNULL(coord_status, 0)  ";
    //         $sql2 .= ",type_descs = (select descs from mgr.cf_lot_type (NOLOCK) where lot_type= type) ";
    //         $sql2 .= ",price_HC = 0 ";
    //         $sql2 .= ", mgr.pm_lot.status ";
    //         $sql2 .= "    FROM mgr.pm_lot(NOLOCK)";
    //         $sql2 .= "    LEFT OUTER JOIN mgr.cf_lot_type_gallery(NOLOCK)";
    //         $sql2 .= "    ON mgr.pm_lot.type = mgr.cf_lot_type_gallery.lot_type";
    //         $sql2 .= "    WHERE mgr.pm_lot.property_cd ='$property_cd' ";
    //         $sql2 .= "     AND mgr.pm_lot.entity_cd = '$entity' ";
    //         $sql2 .= "    AND mgr.pm_lot.project_no = '$project'  ".$level_param;
            
    //         $AllDataUnit = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);


    //         $chose_unit[]='';
    //         if(!empty($lot_no)){
    //             $chose_unit=explode(',', $lot_no);
    //         }

    //          if(!empty($AllData))
    //         {
    //             $ListAllData = '';          
    //             foreach ($AllData as $value) 
    //             {                    
    //                 $bb = $value->level_no;

    //                 $AllDataUnitLevel = array_filter($AllDataUnit,function($a) use($bb) {
                        
    //                     return $a->level_no === $bb;

    //                 });

    //                     $Listunit .= '<div data-toggle="buttons">';
    //                     if ($AllDataUnitLevel) 
    //                     {
    //                         foreach ($AllDataUnitLevel as $key=>$value2) 
    //                             {
    //                                 $text_ = $value2->lot_no;
    //                                 $Listunit .='<div class="col-offset-3 col-2">';
    //                                 $Listunit .='<div data-toggle="buttons">';
    //                                 $Listunit .='<button type="button" name="'.$value->lot_no.'" class="btn btn-success" style="margin:5px" onclick="fn_click_btn(\''.$value->lot_no.'\');">'.$text_.'</button>';
    //                                 $Listunit .='</div>';//card-body       
    //                                 $Listunit .='</div>';//col-3   
                                      
    //                             }     
    //                             // exit;
    //                     }

    //                      $ListAllData .= $Listunit;
    //                      $data = array('property_type'=> $ListAllData);

    //                      $this->load->view('StepBooking/property_type',$data);
    //                 }
    //             }
    //         }




}
