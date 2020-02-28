<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dash_tenant extends Core_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->library('encrypt');
        
    }
    public function index($pro='',$tab='',$property_cd='',$level='')
    {
        
        // var_dump($pro);
        $name = $this->session->userdata('Tsuname');
        $userid = $this->session->userdata('Tsname');
        $entityname = $this->session->userdata('Tsentityname');
        $usergroup = $this->session->userdata('Tsusergroup');
        $sys = $this->session->userdata('Tsysadmin');

        if(!empty($level)){
            $lev=$level;
        } else {
            $lev='';
        }
        $param="";//var_dump($pro);
        if(!empty($pro)){
            $project = trim($pro);
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.cfs_user_project(nolock) where project_no='$pro' and userid='$userid'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;

        }else{
             $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        }
        // var_dump($project);
        $param = "  project_no='".$project."' AND entity_cd='".$entity."'";

        $month = date("m");
        $year = date("Y");


        $approver = 0;
        if($usergroup=='MGM'){
            

      
           
            //-------------------< Property list + grafik pie >--------------------------------------------
    			// $sql = "select * from mgr.v_pm_tenancy_sum where entity_cd='0001' and project_no='0001' order by descs asc";
                $sql = "select * from mgr.v_pm_tenancy_sum where ".$param." order by descs asc";
    			$list = $this->m_wsbangun->getData_by_query($sql);
                $selectsql =  "SELECT entity_cd, project_no, ";
				$selectsql .= "		sum_avail_qty = sum(lot_avail_qty),";
				$selectsql .= "		sum_rented_qty = sum(lot_rented_qty),";
				$selectsql .= "		sum_avail_area = sum(lot_avail_area),";
				$selectsql .= "		sum_rented_area = sum(lot_rented_area) ";
				$selectsql .= " from mgr.v_pm_tenancy_sum";
				// $selectsql .= " where entity_cd='0001' and project_no='0001'";
                $selectsql .= " where ".$param." ";
				$selectsql .= " group by entity_cd, project_no ";
                
                $dt1 = $this->m_wsbangun->getData_by_query($selectsql);
               
               	
               	if (!empty($dt1)) {

                    foreach ($dt1 as $key => $row) {
                        $avail1 = $row->sum_avail_qty;
                        $avail2 = $row->sum_avail_area;
                        $rent1 = $row->sum_rented_qty;
                        $rent2 = $row->sum_rented_area;
                    }
                   

                    $pie1 = '';
                    $pie1.='var pieQTY = c3.generate({bindto: "#pieQTY",padding: {bottom: 20,top:10}, data: {';
                    $pie1.='         columns: [["AVAILABLE",'.$avail1.'],["RENTED",'.$rent1.']], ';
                    $pie1.='         type : "pie" ,       ';
                    $pie1 .='names:{';
                  	$pie1 .='      AVAILABLE: "AVAILABLE",';
                  	$pie1 .='      RENTED:"RENTED"';
                  	$pie1 .='  },';
                    $pie1.='         colors:{ AVAILABLE:"#80d82d",RENTED:"#e82020"}       '; // colors :{'.$jcolor.'}
                    $pie1.='     }, ';
                    $pie1.='     tooltip: { ';
                    $pie1.='         format: { ';
                    // $pie1.='             // title: function (d) { return 'Data ' + d; }, ';
                    $pie1.='             value: function (value, ratio, id) { ';
                    $pie1.='                 return formatNumber(value); ';
                    $pie1.='             } ';
                    $pie1.='         } ';
                    $pie1.='     } ';
                    $pie1.=' });';

                    $pie2 = '';
                    $pie2.='var pieAREA = c3.generate({bindto: "#pieAREA",padding: {bottom: 20,top:10}, data: {';
                    $pie2.='         columns: [["AVAILABLE",'.$avail2.'],["RENTED",'.$rent2.']], ';
                    $pie2.='         type : "pie",        ';
                    $pie2 .='names:{';
                  	$pie2 .='      AVAILABLE: "AVAILABLE",';
                  	$pie2 .='      RENTED:"RENTED"';
                  	$pie2 .='  },';
                    $pie2.='         colors:{ AVAILABLE:"#80d82d",RENTED:"#e82020"}        '; // colors :{'.$jcolor.'}
                    $pie2.='     }, ';
                    $pie2.='     tooltip: { ';
                    $pie2.='         format: { ';
                    // $pie2.='             // title: function (d) { return 'Data ' + d; }, ';
                    $pie2.='             value: function (value, ratio, id) { ';
                    $pie2.='                 return formatNumber(value); ';
                    $pie2.='             } ';
                    $pie2.='         } ';
                    $pie2.='     } ';
                    $pie2.=' });';
          

            }else {
                 $pie1 = '';
                    $pie1.='var pieQTY = c3.generate({bindto: "#pieQTY",padding: {bottom: 20,top:10}, data: {';
                    $pie1.='         columns: [["AVAILABLE",0],["RENTED",0]], ';
                    $pie1.='         type : "pie" ,       ';
                    $pie1 .='names:{';
                    $pie1 .='      AVAILABLE: "AVAILABLE",';
                    $pie1 .='      RENTED:"RENTED"';
                    $pie1 .='  },';
                    $pie1.='         colors:{ AVAILABLE:"#80d82d",RENTED:"#e82020"}       '; // colors :{'.$jcolor.'}
                    $pie1.='     }, ';
                    $pie1.='     tooltip: { ';
                    $pie1.='         format: { ';
                    // $pie1.='             // title: function (d) { return 'Data ' + d; }, ';
                    $pie1.='             value: function (value, ratio, id) { ';
                    $pie1.='                 return formatNumber(value); ';
                    $pie1.='             } ';
                    $pie1.='         } ';
                    $pie1.='     } ';
                    $pie1.=' });';

                    $pie2 = '';
                    $pie2.='var pieAREA = c3.generate({bindto: "#pieAREA",padding: {bottom: 20,top:10}, data: {';
                    $pie2.='         columns: [["AVAILABLE",0],["RENTED",0]], ';
                    $pie2.='         type : "pie",        ';
                    $pie2 .='names:{';
                    $pie2 .='      AVAILABLE: "AVAILABLE",';
                    $pie2 .='      RENTED:"RENTED"';
                    $pie2 .='  },';
                    $pie2.='         colors:{ AVAILABLE:"#80d82d",RENTED:"#e82020"}        '; // colors :{'.$jcolor.'}
                    $pie2.='     }, ';
                    $pie2.='     tooltip: { ';
                    $pie2.='         format: { ';
                    // $pie2.='             // title: function (d) { return 'Data ' + d; }, ';
                    $pie2.='             value: function (value, ratio, id) { ';
                    $pie2.='                 return formatNumber(value); ';
                    $pie2.='             } ';
                    $pie2.='         } ';
                    $pie2.='     } ';
                    $pie2.=' });';
            }
            //----------------------------< End Income VS Expanse >------------------------------
            //-----------------------------< Bar yg ke dua > ------------------------------------
             // $param2 = " where project_no='0001' and entity_cd='0001' and trx_year='$year' and status='N' order by trx_month asc";
             $param2 = " where ".$param." and trx_year='$year'  order by trx_month asc";
             $sql3 = "SELECT * from mgr.v_pm_bill_sch_sum  $param2 "; 
            $dt3 = $this->m_wsbangun->getData_by_query($sql3);
             $stringMonth="'January','February','March','April','May','June','July','August','September','October','November','December'";
            if (!empty($dt3)) {
                   
                    $data_ipl_pro ='';
                    $data_rental_pro ='';
                    $data_ipl_real ='';
                    $data_rental_real ='';
                    $datamonth='';
                    foreach ($dt3 as $key => $row) {
                        if($row->bill_type=='S') {
                            $data_ipl_pro.= $row->amt_project.',';
                            $data_ipl_real.= $row->amt_real.',';
                        } else {
                            $data_rental_pro.= $row->amt_project.',';
                            $data_rental_real.= $row->amt_real.',';
                        }

                        
                    }
                    $arrayMonth = ['','January','February','March','April','May','June','July','August','September','October','November','December'];

                    foreach ($dt3 as $key => $row) {
                        $nup_distinct[]=$row->trx_month;
                    }
                        $month = array_unique($nup_distinct);
                        // var_dump($month);
                        foreach ($month as $key) {
                            $datamonth .= '"'.$arrayMonth[$key].'",';
                        }
                        
                    $data_ipl_pro=substr($data_ipl_pro,0,-1);
                    $data_rental_pro=substr($data_rental_pro,0,-1);
                    $data_ipl_real=substr($data_ipl_real,0,-1);
                    $data_rental_real=substr($data_rental_real,0,-1);
                    $datamonth=substr($datamonth,0,-1);
                    // var_dump($data_rental_real);
                    $bar='';
                    $bar.='var barprop = c3.generate({bindto: "#barproperty",padding: {bottom: 20,top:10},';
                    $bar.='data: {';
                    $bar .=" x:'x',columns:[  ['x',".$datamonth."], ";
                    $bar .="['rental_pro', ".$data_rental_pro."],";
                    $bar .="['rental_real', ".$data_rental_real."],";
                    $bar .=" ['IPL_pro',".$data_ipl_pro."],";
                    $bar .=" ['IPL_real',".$data_ipl_real."]],";
                    $bar.='     type:"bar",';
                    $bar .='colors: {';
                    $bar .='      rental_pro: "#1f77b4",';
                    $bar .='      rental_real: "#2ca02c",';
                    $bar .='      IPL_pro: "#ff7f0e",';
                    $bar .='      IPL_real: "#d62728"';
                    $bar .='  },';
                    $bar .='names:{';
                    $bar .='      IPL_pro: "Project: Service Charge (IPL)",';
                    $bar .='      rental_pro:"Project: Rental",';
                    $bar .='      IPL_real: "Realisation: Service Charge (IPL)",';
                    $bar .='      rental_real:"Realisation: Rental"';
                    $bar .='  },';
                    $bar.='},';
                
                    $bar.='grid: {';
                    $bar.='    y: {';
                    $bar.='        lines: [';
                    $bar.='            {value: 0}';
                    $bar.='            ]';
                    $bar.='        }';
                    $bar.='    },';
                    $bar.='axis: {';
                    $bar.='    x:{';
                    $bar.='         type: "category",';
                    $bar.='         categories:[';
                    $bar.=$datamonth;
                    $bar.=']';
                    $bar.='     },';
                    $bar.='     y : {';
                    $bar.='           tick: {';
                    $bar.='             format: function (d) { return formatNumber(d); }';
                    $bar.='             }';
                    $bar.='         }';
                    $bar.='    },';
                    $bar.='     tooltip: { ';
                    $bar.='         format: { ';
                    $bar.='             value: function (value, ratio, id) { ';
                    $bar.='                 return formatNumber(value); ';
                    $bar.='             } ';
                    $bar.='         } ';
                    $bar.='     } ';
                    $bar.='});';

            } else {
                $bar='';
                $bar.='var barprop = c3.generate({bindto: "#barproperty",padding: {bottom: 20,top:10},';
                    $bar.='data: {';
                    $bar .=" x:'x',columns:[  ['x',0], ";
                    $bar .="['rental_pro', 0],";
                    $bar .=" ['IPL_pro',0],";
                    $bar .="['rental_real', 0],";
                    $bar .=" ['IPL_real',0]],";
                    $bar.='     type:"bar",';
                    $bar .='colors: {';
                    $bar .='      rental_pro: "#1f77b4",';
                    $bar .='      rental_real: "#ff7f0e",';
                    $bar .='      IPL_pro: "#2ca02c",';
                    $bar .='      IPL_real: "#d62728"';
                    $bar .='  },';
                    $bar .='names:{';
                    $bar .='      IPL_pro: "Project: Service Charge (IPL)",';
                    $bar .='      rental_pro:"Project: Rental",';
                    $bar .='      IPL_real: "Realisation: Service Charge (IPL)",';
                    $bar .='      rental_real:"Realisation: Rental"';
                    $bar .='  },';
                    $bar.='},';
                
                    $bar.='grid: {';
                    $bar.='    y: {';
                    $bar.='        lines: [';
                    $bar.='            {value: 0}';
                    $bar.='            ]';
                    $bar.='        }';
                    $bar.='    },';
                    $bar.='axis: {';
                    $bar.='    x:{';
                    $bar.='         type: "category",';
                    $bar.='         categories:[';
                    $bar.=$stringMonth;
                    $bar.=']';
                    $bar.='     },';
                    $bar.='     y : {';
                    $bar.='           tick: {';
                    $bar.='             format: function (d) { return formatNumber(d); }';
                    $bar.='             }';
                    $bar.='         }';
                    $bar.='    },';
                    $bar.='     tooltip: { ';
                    $bar.='         format: { ';
                    $bar.='             value: function (value, ratio, id) { ';
                    $bar.='                 return formatNumber(value); ';
                    $bar.='             } ';
                    $bar.='         } ';
                    $bar.='     } ';
                    $bar.='});';
            }
            //-----------------------------< bar2 yg ke tiga > ------------------------------------
             // $param3 = " where project_no='0001' and entity_cd='0001' and trx_year='$year' and status='Y' order by trx_month asc";
            $param3 = " where ".$param." and trx_year='$year' order by trx_month asc ";
            $sql3 = "SELECT * from mgr.v_pm_bill_sch_sum  $param3 "; 
            $dt4 = $this->m_wsbangun->getData_by_query($sql3);
            $arrayMonth = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
            if (!empty($dt4)) {
                   
                    $data_ipl ='';//"['Income Amount',";
                    $data_rental ='';
                    $datamonth='';
                    foreach ($dt4 as $key => $row) {
                        if($row->bill_type=='S') {
                            $data_ipl.= $row->amt_project.',';
                        } else {
                            $data_rental.= $row->amt_project.',';
                        }

                        
                    }
                    
                    foreach ($dt4 as $key => $row) {
                        $nup_distinct[]=$row->trx_month;
                    }
                        $month = array_unique($nup_distinct);
                        // var_dump($month);
                        foreach ($month as $key) {
                            $datamonth .= '"'.$arrayMonth[$key].'",';
                        }
                        
                    $data_ipl=substr($data_ipl,0,-1);
                    $data_rental=substr($data_rental,0,-1);
                    $datamonth=substr($datamonth,0,-1);
                    // var_dump($datamonth);
                    $bar2='';
                    $bar2.='var bar2prop = c3.generate({bindto: "#bar2property",padding: {bottom: 20,top:10},';
                    $bar2.='data: {';
                    $bar2 .=" x:'x',columns:[  ['x',".$datamonth."], ['rental2', ".$data_rental."],";
                    $bar2 .=" ['IPL2',".$data_ipl."]],";
                    $bar2.='     type:"bar",';
                    $bar2 .='colors: {';
                    $bar2 .='      rental_pro: "#1f77b4",';
                    $bar2 .='      rental_real: "#ff7f0e",';
                    $bar2 .='      IPL_pro: "#2ca02c",';
                    $bar2 .='      IPL_real: "#d62728"';
                    $bar2 .='  },';
                    $bar2 .='names:{';
                    $bar2 .='      IPL2: "Service Charge (IPL)",';
                    $bar2 .='      rental2:"Rental"';
                    $bar2 .='  },';
                    $bar2.='},';
                
                    $bar2.='grid: {';
                    $bar2.='    y: {';
                    $bar2.='        lines: [';
                    $bar2.='            {value: 0}';
                    $bar2.='            ]';
                    $bar2.='        }';
                    $bar2.='    },';
                    $bar2.='axis: {';
                    $bar2.='    x:{';
                    $bar2.='         type: "category",';
                    $bar2.='         categories:[';
                    $bar2.=$datamonth;
                    $bar2.=']';
                    $bar2.='     },';
                    $bar2.='     y : {';
                    $bar2.='           tick: {';
                    $bar2.='             format: function (d) { return formatNumber(d); }';
                    $bar2.='             }';
                    $bar2.='         }';
                    $bar2.='    },';
                    $bar2.='     tooltip: { ';
                    $bar2.='         format: { ';
                    $bar2.='             value: function (value, ratio, id) { ';
                    $bar2.='                 return formatNumber(value); ';
                    $bar2.='             } ';
                    $bar2.='         } ';
                    $bar2.='     } ';
                    $bar2.='});';

            } else {
                $bar2='';
                $bar2.='var bar2prop = c3.generate({bindto: "#bar2property",padding: {bottom: 20,top:10},';
                    $bar2.='data: {';
                    $bar2 .=" x:'x',columns:[  ['x',0], ['rental2', 0],";
                    $bar2 .=" ['IPL2',0]],";
                    $bar2.='     type:"bar",';
                    $bar2 .='colors: {';
                    $bar2 .='      rental_pro: "#1f77b4",';
                    $bar2 .='      rental_real: "#ff7f0e",';
                    $bar2 .='      IPL_pro: "#2ca02c",';
                    $bar2 .='      IPL_real: "#d62728"';
                    $bar2 .='  },';
                    $bar2 .='names:{';
                    $bar2 .='      IPL2: "Service Charge (IPL)",';
                    $bar2 .='      rental2:"Rental"';
                    $bar2 .='  },';
                    $bar2.='},';
                
                    $bar2.='grid: {';
                    $bar2.='    y: {';
                    $bar2.='        lines: [';
                    $bar2.='            {value: 0}';
                    $bar2.='            ]';
                    $bar2.='        }';
                    $bar2.='    },';
                    $bar2.='axis: {';
                    $bar2.='    x:{';
                    $bar2.='         type: "category",';
                    $bar2.='         categories:[';
                    $bar2.=$stringMonth;
                    $bar2.=']';
                    $bar2.='     },';
                    $bar2.='     y : {';
                    $bar2.='           tick: {';
                    $bar2.='             format: function (d) { return formatNumber(d); }';
                    $bar2.='             }';
                    $bar2.='         }';
                    $bar2.='    },';
                    $bar2.='     tooltip: { ';
                    $bar2.='         format: { ';
                    $bar2.='             value: function (value, ratio, id) { ';
                    $bar2.='                 return formatNumber(value); ';
                    $bar2.='             } ';
                    $bar2.='         } ';
                    $bar2.='     } ';
                    $bar2.='});';

            }
            if(empty($property_cd)||empty($level)){
                $sql = "SELECT MIN(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE ".$param." and default_value=1";
                $defaulValue = $this->m_wsbangun->getData_by_query($sql);
                $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
                $b = 'L';    
            } else {
                $a = $property_cd;
                $b = $level;
            }
            
            // var_dump($a.','.$b);
            // var_dump($bar2);
            // --------------------------------- end of bar yg kedua -------------------------------
            $content = array(  
                                
                                'js1'=>$pie1,
                                'js2'=>$pie2,
                                'js3'=>$bar,
                                'js4'=>$bar2,
                                'listproperty'=>$list,
                                'userLevelList'=>$this->datatableView($a, $b,null,$project,$entity),
                                'property_type'=>$this->property_typeview($a,$project,$entity),
                                // 'project_name'=>$projectName,
                                'level_no'=>$this->level('in',$a,$project,$entity,$b),
                                'data_project'=>$this->project_list($project),
                                // 'trialyear'=>$this->year_list($entity,$year),
                                'profityear'=>$this->yearbar_list($entity,$project,$year),
                                'tab'=>$tab,
                                // 'profityear'=>$this->yearbar_list($entity,$project,$year),
                                'propertyList'=>$this->property_list($entity,$project,"")//,
                                // 'deptList'=>$this->dept_list("")
                                );
            $this->load_content_mgm('dash_tenant/grafiknove',$content);
            return;
        }

        $tabel2 = 'v_cfs_user_project';
        $kriteria2 = array(
            'entity_cd'=>$entity,
            'userid'=>$name);

        $datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2, $kriteria2);
        $ListAllData='';
        if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $ListAllData .='<div class="col-md-3">';
                $ListAllData .='<div class="ibox">';
                $ListAllData .='<div class="ibox-content product-box">';
                $ListAllData .='<div class="product-imitation">';
                if(!empty($value->picture_path)){                    
                    $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/'.$value->picture_path).'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';
                }else{
                    $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/blankproject.png').'" style="width: 178px; height: 140px;" class="img-thumbnail"></center></a>';
                }
                $ListAllData .=$a;
                $ListAllData .='</div>';
                $ListAllData .='<div class="product-desc">'; 
                $ListAllData .='<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'" class="product-name">' .$value->descs. '&nbsp; <i class="fa fa-arrow-circle-right"></i><br>Click Here to begin.</a>';

                // $ListAllData .='<a href="'.$value->http_add.'" target="_blank">&nbsp;<br>'.$value->http_add.'</a>';                                           
                $ListAllData .='<a href="http://'.$value->http_add.'" target="_blank">&nbsp;<br>'.$value->http_add.'</a>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';
                $ListAllData .='</div>';               
            }
        }

        $ContentAllData = array('PlProject' => $ListAllData,
            'leftdyn'=>$name,
            'isi'=>$datalist2,
            'sys'=>$sys,
            'approver'=>$approver,
            'entityname'=> $entityname);
        $this->load_content('dash_sales/index', $ContentAllData);

    }
  
    public function goto_enquiry(){
            $pro = $this->input->post('project', TRUE); 
            if(empty($pro)||$pro==''){
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
            } else {
                $project = trim($pro);//onchange
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;
                // var_dump($entity);
            } 
                $Type = $this->input->post('Type',TRUE);
      
                
 
            $ts='';
            if($Type=='A'){
                    $ts='Level';
            }else{  
                $ts='Type';
            }
            $sql = "SELECT MIN(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 ";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $a = empty($defaulValue)? '': $defaulValue[0]->default_value;
            $b = 'L';
            $content = array(
                                'userLevelList'=> $this->datatableView($a, $b,null,$project,$entity),
                                'Type'=>$ts
                        );
 
            $this->load->view('dash_tenant/table',$content);      
    }
    public function barproperty2(){
    
            $year = $this->input->post('year', TRUE);
            $pro = $this->input->post('project', TRUE); 
            if(empty($pro)||$pro==''){
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
            } else {
                $project = trim($pro);//onchange
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;
                // var_dump($entity);
            }
            $table = 'v_pm_bill_sch_sum';
            $crit = array('trx_year'=>$year,'project_no'=>$project,'entity_cd'=>$entity,'status'=>'Y');
            $order = array('trx_month','asc');
            $databar = $this->m_wsbangun->getData_by_criteria($table,$crit,null,$order);
            // if(empty($databar)){
            //     $data_ipl='IPL,0';
            //     $data_rental='rental,0';
            // } else {
                $data_ipl ='IPL2,';//"['Income Amount',";
                $data_rental ='rental2,';
                    foreach ($databar as $key => $row) {
                      
                        if($row->bill_type=='S') {
                            $data_ipl.= $row->amt.',';
                        } else {
                            $data_rental.= $row->amt.',';
                        }

      
                   }
                   $datamonth='x,';
                   $arrayMonth = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
                   // $nup_distinct[]='';
                   if(!empty($databar)){
                    foreach ($databar as $key => $row) {
                        $nup_distinct[]=$row->trx_month;
                    }
                    $month = array_unique($nup_distinct);
                        // var_dump($month);
                    foreach ($month as $key) {
                       $datamonth .= ''.$arrayMonth[$key].',';
                    }
                    $datamonth=substr($datamonth,0,-1);
                   }
                    
                 
                $data_ipl=substr($data_ipl,0,-1);
                $data_rental=substr($data_rental,0,-1);
                
            // }
            
            
            $datas  = array('ipl'=>$data_ipl,'rental'=>$data_rental,'category' => $datamonth);
        echo json_encode($datas);
    }
    public function barproperty(){
    
            $year = $this->input->post('year', TRUE);
            $pro = $this->input->post('project', TRUE); 
            if(empty($pro)||$pro==''){
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
            } else {
                $project = trim($pro);//onchange
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;
                // var_dump($entity);
            }
            $table = 'v_pm_bill_sch_sum';
            $crit = array('trx_year'=>$year,'project_no'=>$project,'entity_cd'=>$entity);
            $order = array('trx_month','asc');
            $databar = $this->m_wsbangun->getData_by_criteria($table,$crit,null,$order);
            // if(empty($databar)){
            //     $data_ipl='IPL,0';
            //     $data_rental='rental,0';
            // } else {
                $data_ipl_pro ='IPL_pro,';//"['Income Amount',";
                $data_rental_pro ='rental_pro,';
                $data_ipl_real ='IPL_real,';//"['Income Amount',";
                $data_rental_real ='rental_real,';
                    foreach ($databar as $key => $row) {
                      
                        if($row->bill_type=='S') {
                            $data_ipl_pro.= $row->amt_project.',';
                            $data_ipl_real.= $row->amt_real.',';
                        } else {
                            $data_rental_pro.= $row->amt_project.',';
                            $data_rental_real.= $row->amt_real.',';
                        }

      
                   }
                   // var_dump($data_rental_real);
                   $datamonth='x,';
                   $arrayMonth = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
                   // $nup_distinct[]='';
                   if(!empty($databar)){
                    foreach ($databar as $key => $row) {
                        $nup_distinct[]=$row->trx_month;
                    }
                    $month = array_unique($nup_distinct);
                        // var_dump($month);
                    foreach ($month as $key) {
                       $datamonth .= ''.$arrayMonth[$key].',';
                    }
                    $datamonth=substr($datamonth,0,-1);
                   }
                    
                 
                    $data_ipl_pro=substr($data_ipl_pro,0,-1);
                    $data_rental_pro=substr($data_rental_pro,0,-1);
                    $data_ipl_real=substr($data_ipl_real,0,-1);
                    $data_rental_real=substr($data_rental_real,0,-1);
                
            // }
            
            
            $datas  = array('ipl'=>$data_ipl_pro,'rental'=>$data_rental_pro,'iplreal'=>$data_ipl_real,'rentalreal'=>$data_rental_real,'category' => $datamonth);
            // var_dump($data_rental_real);
        echo json_encode($datas);
    }
    public function property_list($entity='',$project='',$pro_cd=''){
        // var_dump($entity." pro : ".$project);
         $table = "SELECT distinct property_cd,descs from mgr.v_pm_tenancy_sum where entity_cd='".$entity."' and project_no='".$project."'";
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query($table);
        // var_dump($project);

        $comboEntity[]='';
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtentity) {

                  if($pro_cd === $dtentity->property_cd) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtentity->property_cd.'">'.$dtentity->property_cd.' - '.$dtentity->descs.'</option>';
                }
                
            }
            $comboEntity = implode("", $comboEntity);
            return $comboEntity;
    }
    public function project_list($project=''){
        $userid = $this->session->userdata('Tsname');
        $table = "SELECT * from mgr.v_cfs_user_project (nolock) where userid='$userid' ";
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query($table);
        // var_dump($project);
        $comboProject[]='';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
         
                foreach ($proDescs as $dtProject) {
                	
                  if($project === trim($dtProject->project_no)) {
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboProject[] = '<option '.$pilih.' value="'.$dtProject->project_no.'">'.$dtProject->descs.'</option>';
                }
                $comboProject = implode("", $comboProject);
            }
            return $comboProject;
    }
    public function filter_property(){
        if($_POST){
            $pro = $this->input->post('project', TRUE); 
            if(empty($pro)||$pro==''){
                $project = $this->session->userdata('Tsproject');
                $entity = $this->session->userdata('Tsentity');
            } else {
                $project = $pro;//onchange
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;
                // var_dump($entity);
            }
            $pro_cd_post = $this->input->post('pro_cd', TRUE);
            $where = ' ';
                if(!empty($pro_cd_post)){   
                      $pro_cd_in = "'".implode("','", $pro_cd_post)."'";
                      $where = $where . " AND property_cd IN (".$pro_cd_in.") ";
                 }
            $project=trim($project);

            $sql="select entity_cd, project_no, ";
    		$sql.="sum_avail_qty = sum(lot_avail_qty), sum_rented_qty = sum(lot_rented_qty), ";
    		$sql.="sum_avail_area = sum(lot_avail_area),sum_rented_area = sum(lot_rented_area) ";
    		$sql.=" from mgr.v_pm_tenancy_sum ";
    		$sql.="where entity_cd = '$entity' and project_no='$project' ".$where;
    		$sql.="group by entity_cd, project_no  ";
            $dt1 = $this->m_wsbangun->getData_by_query($sql);

                if (!empty($dt1)) {
                    
    					foreach ($dt1 as $key => $row) {
                            $avail1 = "AVAILABLE,".$row->sum_avail_qty;
                            $avail2 = "AVAILABLE,".$row->sum_avail_area;
                            $rent1 = "RENTED,".$row->sum_rented_qty;
                            $rent2 = "RENTED,".$row->sum_rented_area;
                        }
                        // $jdata1=','.substr($jdata1,0,-1);

                         $msg1=array(
                            'avqty'=>$avail1,
              				'avarea'=>$avail2,
              				'renqty'=>$rent1,
              				'renarea'=>$rent2,
              				'status'=>'OK'
                            );

                } else {
                	 $msg1=array(
                            'avqty'=>"AVAILABLE,0",
              				'avarea'=>"AVAILABLE,0",
              				'renqty'=>"RENTED,0",
              				'renarea'=>"RENTED,0",
              				'status'=>'Failed'
                            );
                }
                echo json_encode($msg1);

        }
        
    }
	public function goto_table(){
        $pro = $this->input->post('project_no', TRUE); 
        if(empty($pro)||$pro==''){
            $project = $this->session->userdata('Tsproject');
            $entity = $this->session->userdata('Tsentity');
        } else {
            $project = trim($pro);//onchange
            $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro'";
            $datas = $this->m_wsbangun->getData_by_query($sql);
            $entity = $datas[0]->entity_cd;
            // var_dump($entity);
        }
       
            $sql = "select * from mgr.v_pm_tenancy_sum where entity_cd='$entity' and project_no='$project' order by descs asc";
    			$list = $this->m_wsbangun->getData_by_query($sql);
            $data = array('listproperty'=>$list);
            $this->load->view('dash_tenant/propertylist',$data);
        }

    public function yearbar_list($entity='',$project='',$fyear=''){
         $table = "SELECT distinct trx_year from mgr.v_pm_bill_sch_sum (nolock) WHERE entity_cd='$entity' and project_no='$project' order by trx_year asc";
        // var_dump($fyear);
        $proDescs = $this->m_wsbangun->getData_by_query($table);
        $comboEntity[]='';

            
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtentity) {
                    // var_dump($fyear.','.$dtentity->trx_year);
                  if($fyear == $dtentity->trx_year) {
                    // var_dump('expression');
                    $pilih = ' selected = "true"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtentity->trx_year.'">'.$dtentity->trx_year.'</option>';
                }
                // $comboEntity = implode("", $comboEntity);
            }
             $comboEntity = implode("", $comboEntity);
        // var_dump($project);
          return $comboEntity;
    }
    public function datatableView($property_cd='', $level_no = '',$lot_no=null,$pro='',$ent=''){

            $ContentAllData ='';
            if(!empty($pro)||!empty($ent)) {
                $project=$pro;
                $entity=$ent;
            } else {
                 $entity = $this->session->userdata('Tsentity');
                $project = $this->session->userdata('Tsproject');
            }
           
        
            $level_param = '';

            $property_param='';
           

           if($level_no <> 'L'){
                    $level_param = " AND level_no = '$level_no' ";
                }
                 if($property_cd <> 'L'){
                    $property_param= " AND mgr.pm_lot.property_cd = '$property_cd' ";
                }


                $sql="SELECT level_no, descs FROM   MGR.PM_LEVEL (NOLOCK) WHERE ENTITY_CD = '$entity' ";
                $sql.=" AND PROJECT_NO     = '$project' ".$level_param."";
                $sql.=" AND LEVEL_NO IN (SELECT DISTINCT MGR.PM_LOT.LEVEL_NO " ;
                $sql.=" FROM   MGR.PM_LOT (NOLOCK) " ;
                $sql.=" WHERE  MGR.PM_LOT.ENTITY_CD = MGR.PM_LEVEL.ENTITY_CD " ;
                $sql.=" AND MGR.PM_LOT.PROJECT_NO = MGR.PM_LEVEL.PROJECT_NO " ;
                $sql.=" ".$property_param.") ORDER BY seq_no" ;
                // $sql.=" AND MGR.PM_LOT.STATUS = 'A') ORDER BY seq_no"; 

            $AllData = $this->m_wsbangun->getData_by_query($sql);
           

            $sql2 = "SELECT  project_no = mgr.pm_lot.project_no  ,";
            $sql2.= " property_cd = mgr.pm_lot.property_cd,level_no = mgr.pm_lot.level_no ";
            $sql2.= " ,lot_no = mgr.pm_lot.lot_no , nup_counter,rented_status,";
            $sql2.= " descs = mgr.pm_lot.descs   ,type ,CASE WHEN mgr.pm_lot.build_up_area = 0  ";
            $sql2.= " THEN 'N/A' ELSE convert(varchar,mgr.pm_lot.build_up_area) END AS build_up_area";
            $sql2.= " FROM mgr.pm_lot(NOLOCK) left outer join mgr.pm_lot_price (NOLOCK)    ";
            $sql2.= " On mgr.pm_lot.entity_cd = mgr.pm_lot_price.entity_cd  ";
            $sql2.= " and  mgr.pm_lot.project_no = mgr.pm_lot_price.project_no";   
            $sql2.= " and  mgr.pm_lot.lot_no = mgr.pm_lot_price.lot_no   ";
            $sql2.= " and  mgr.pm_lot_price.Hc ='Y'   ";
            $sql2.= " LEFT OUTER JOIN mgr.pm_theme(NOLOCK)";   
            $sql2.= " ON mgr.pm_lot.theme_cd = mgr.pm_theme.theme_cd";   
            $sql2.= " WHERE mgr.pm_lot.project_no = '$project'     ";
            $sql2.= " AND mgr.pm_lot.entity_cd = '$entity'    ".$property_param;
            $sql2.= " and rented_status in ('A','R') ".$level_param;

            // echo $sql; exit;        

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
                                    
                                    $titlehd ="Selected by ".$value2->nup_counter." Customers <br>";
                                    $title = "<b><h3>".$value2->lot_no."</h3></b> <br>"; //"Tes satu: &#013; apa aja";
                                    $title .="Description : ".$value2->descs."<br>";
                                    $title .="Semi Gross Area : ".$value2->build_up_area."<br>";
                                    
                                    $stt = $value2->rented_status;


                                    if($stt=='A'){
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; cursor:default;margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-green" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
                                    }elseif($stt='R'){
                                        $Listunit .='<button type="button" id="'.$value2->lot_no.'" name ="'.$value2->lot_no.'" style="width: 100px;margin-bottom: 5px; cursor:default;margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" data-html="true" data-trigger="hover" data-toggle="popover" data-placement="auto right"  data-content="'.$title.'" >'.$text_.'</button>';
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
         function goto_tableView($property_cd = null, $level_no = null){ 
            $property_cd = $this->input->post('property_cd',TRUE);
            $level_no = $this->input->post('level_no',TRUE);
            $lot_no = $this->input->post('lot_no',TRUE);
            $Type = $this->input->post('Type',TRUE);
            $pro = $this->input->post('project',TRUE);
          
            if(empty($pro)||$pro==''){
                $project = '0001';
                $entity = '0001';
            } else {
                $project = trim($pro);//onchange
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;
                // var_dump($entity);
            }
            $ts='';
            if($Type=='A'){
                    $ts='Level';
            }else{
                $ts='Type';
            }
            $data = array(
                                'userLevelList'=> $this->datatableView($property_cd, $level_no,$lot_no,$project,$entity),
                                'Type'=>$ts
                        );
            // var_dump($data);
            $this->load->view('dash_tenant/table',$data);
        }
        public function property_typeview($property_cd='',$pro='',$ent=''){
            // var_dump($property_cd);
            $pro2 = $this->input->post('project');
            if(!empty($pro)||!empty($ent)) {
                $project=$pro;
                $entity=$ent;
            } else if(!empty($pro2)){
                $project=trim($pro2);
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;

            } else {
                  $entity = '0001';
                $project = '0001';
            }
            // var_dump($entity);var_dump($project);exit();
            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
            $table = 'cf_property (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('property_cd', 'descs');

            // $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where, $property_cd);
            $Data = $this->m_wsbangun->getData_by_criteria($table,$where); 
            $combo[] = '<option value=""></option>';
            $combo[] = '<option value="L">All</option>';
            foreach ($Data as $result) {
                if(trim($result->property_cd) == trim($property_cd)) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.$result->property_cd.'" '.$selected.' data-level="'.$result->property_type.'">'.$result->descs.'</option>';
            }
            $cbProp = implode("", $combo); 

            // $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
            return $cbProp;
        }
         public function zoom_propertytype(){
            $pro = $this->input->post('project');
           
            if(!empty($pro)){
                $project=trim($pro);
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;

            } else {
                 $entity = '0001';
                $project = '0001';
            }
             $sql = "SELECT MIN(property_cd) AS default_value FROM mgr.cf_property (NOLOCK) WHERE entity_cd = '$entity' and project_no = '$project' and default_value=1 ";
            $defaulValue = $this->m_wsbangun->getData_by_query($sql);
            $property_cd = empty($defaulValue)? '': $defaulValue[0]->default_value;
            // $b = 'L';
            $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
            $table = 'cf_property (NOLOCK)';
            // $table = 'SELECT property_cd, descs FROM mgr.cf_property (NOLOCK)';

            $obj = array('property_cd', 'descs');

            // $cbProp = $this->m_wsbangun->getCombo($table, $obj, $where, $property_cd);
            $Data = $this->m_wsbangun->getData_by_criteria($table,$where); 
            // var_dump($Data);
            $combo[] = '<option value=""></option>';
            foreach ($Data as $result) {
                if(trim($result->property_cd) == trim($property_cd)) {
                    $selected = ' selected="1"';
                } else {
                    $selected = '';
                }
                $combo[] = '<option value="'.$result->property_cd.'" '.$selected.' data-level="'.$result->property_type.'">'.$result->descs.'</option>';
            }
            $cbProp = implode("", $combo); 
            // var_dump($cbProp);

            // $data_project = $this->m_wsbangun->getData_by_criteria("cf_property",$where);    
            echo $cbProp;
        }
        public function level($from = '',$property_code='',$pro='',$ent='',$lev=''){
            
            if($property_code!=''){
                $property_cd = $property_code;
            }else{
                $property_cd = $this->input->post('property_cd', TRUE);
            }
            // var_dump($property_cd);
            if(!empty($lev)){
                $level_no=trim($lev);
            } else {
                $level_no = $this->input->post('level_no', TRUE);    
            }
            
            $pro2 = $this->input->post('project');
            if(!empty($pro)||!empty($ent)) {
                $project=$pro;
                $entity=$ent;
            } else if(!empty($pro2)){
                // var_dump('holdin me');
                $project=trim($pro2);
                $sql = "SELECT entity_cd = max(entity_cd) from mgr.pl_project(nolock) where project_no='$pro2'";
                $datas = $this->m_wsbangun->getData_by_query($sql);
                $entity = $datas[0]->entity_cd;

            } else {
                 $entity = $this->session->userdata('Tsentity');
                $project = $this->session->userdata('Tsproject');
            }
            // var_dump('project'.$project.' entity '.$entity.' property '.$property_cd);//exit();
            if($property_cd <> 'L') {
                $where=array('entity_cd'=>$entity,
                        'project_no'=> $project,
                        'property_cd'=>trim($property_cd));
                 $table = 'v_pm_lot_level (NOLOCK)';
            }else {
                $where=array('entity_cd'=>$entity,
                        'project_no'=> $project);
                $table = 'v_pm_lot_level_all (NOLOCK)';
            }
            

           
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
 } 
 ?>