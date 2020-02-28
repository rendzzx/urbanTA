<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dash_finance extends Core_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
        $this->load->library('encrypt');
        // $this->load->model('m_sms');
        // $this->load->model('m_dash');
    }
 
    public function index()
    {
        // $entity = '';
        $entity_sess = $this->session->userdata('Tsentity');
        $project_sess = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $entityname = $this->session->userdata('Tsentityname');
        $usergroup = $this->session->userdata('Tsusergroup');
        $sys = $this->session->userdata('Tsysadmin');
        $cons = $this->session->userdata('Tscons');

        // if($entity ==''){
        //     $sqlquery="SELECT entity_cd = max(entity_cd) from mgr.cfs_user_entity (nolock) ";
        //     $tes = $this->m_wsbangun->getData_by_query($sqlquery);            
    
        //     if(!empty($tes)){
        //         $tess = $tes[0]->entity_cd;
        //             $entity = $tess;
        //     }                        
        // }else{
            $entity = $entity_sess;
        // }

        $month = date("m");
        $year = date("Y");
        // var_dump($entity);exit();
        $approver = 0;
        if($usergroup){
            

      
            //---------------------mulai dari sini ----------------------//
        // if($month=='ALL'){
            $param = " where  entity_cd='".$entity."'";

        
            $sql = "SELECT * from mgr.fn_v_gl_trial('$month','$year')  $param  ORDER BY nomor, fyear"; 
            $dt1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            // var_dump($dt1);exit();
            $pie1 = '';
            if (!empty($dt1)) {
                    $jdata1= '';
                    // $jdata3='';
                    $jcolor= '';
                    $jjum1= '';

                    foreach ($dt1 as $key => $row) {
                        $p1 = '["'.$row->acct_type_descs.'",'.$row->trx_amt.']';
                        // $c1 = $row->acct_type_descs;                     

                        $jdata1.= $p1.',';
                        // $jcolor.= $c1.',';
                        // $jdata3.= $P2.',';
                    }
                    // var_dump($c1);

                    $jdata1=substr($jdata1,0,-1);
                    $jcolor=substr($jcolor,0,-1);
                    // $jdata3=substr($jdata3,0,-1);

                    
                    $pie1.='var pieBalanceGL = c3.generate({bindto: "#pieBalanceGL",padding: {bottom: 20,top:10}, data: {';
                    $pie1.='         columns: [ '.$jdata1.'], ';                    
                    $pie1.='         type : "pie"        ';
                    // $pie1.='                 '; // colors :{'.$jcolor.'}
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

            }

            //-------------------- end of gl trial ------------------------------

            //----------------------- profit loss --------------------------------

            $sql2 = "SELECT * from mgr.v_gl_profit_loss_yearly_pie  $param "; 
            $dt2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
            $pie2='';
            if (!empty($dt2)) {
                    $jdata2= '';
                    // $pattern='';
                    $jcolor= '';
                    $jlabel2= '';

                    foreach ($dt2 as $key => $row) {
                        // $p2 = '["'.$row->fyear.'",'.$row->profit_amt.']';
                        // $clr='';
                        // if($row->status=='1')
                        //     {
                        //         $clr='"#2ca02c"';//profit
                        //     } else {
                        //         $clr='"#d62728"';//loss
                        //     }
                        $jlabel2.= '"'.$row->fyear.'",';
                        $jdata2.='"'.$row->profit_amt.'",';
                        // $pattern.= $clr.',' ;
                        // $jdata2.= $p2.',';

                    }
                    // $pattern=substr($pattern,0,-1);
                    $jdata2=substr($jdata2,0,-1);
                    $jlabel2=substr($jlabel2,0,-1);
                    

                    
                    $pie2.='var chart = c3.generate({bindto: "#pieProfitLoss",padding: {bottom: 20,top:10},';
                    $pie2.='data: {';
                    $pie2.='     columns: [ ["Year",'.$jdata2.']], ';
                    $pie2.='    type:"line"';
                    $pie2.='},';
                    // $pie2.='pie: {';
                    // $pie2.='    label: {';
                    // $pie2.='        format: function (value, ratio, id) {';
                    // $pie2.='            return id;';
                    // $pie2.='        }';
                    // $pie2.='    }';
                    // $pie2.='},';
                    // $pie2.='color: {';
                    // $pie2.='    pattern: ['.$pattern.']';
                    // $pie2.='},';
                    $pie2.='axis: {';
                    $pie2.='    x:{';
                    $pie2.='         type: "category",';
                    $pie2.='         categories:['.$jlabel2.']';
                    $pie2.='     },';
                    $pie2.='     y : {';
                    $pie2.='           tick: {';
                    $pie2.='             format: function (d) { return formatNumber(d); }';
                    $pie2.='             }';
                    $pie2.='         }';
                    $pie2.='    },';
                    $pie2.='grid: {';
                    $pie2.='    y: {';
                    $pie2.='        lines: [';
                    $pie2.='            {value: 0}';
                    // $pie2.='            {value: 350, text: 'Lable 350 for y', position: 'middle'}';
                    $pie2.='            ]';
                    $pie2.='        }';
                    $pie2.='    },';
                    // $pie2.='legend: {';
                    // $pie2.='   show: false ';
                    // $pie2.='},';
                    $pie2.='     tooltip: { ';
                    $pie2.='         format: { ';
                    $pie2.='             value: function (value, ratio, id) { ';
                    $pie2.='                 return formatNumber(value); ';
                    $pie2.='             } ';
                    $pie2.='         } ';
                    $pie2.='     } ';
                    $pie2.='});';

      

            }

            //----------------------------------- end of profit loss pie-----------------------------------
            //---------------------------------- profit loss bar ---------------------------------
            $param2 = " where  entity_cd='".$entity."' and fyear='$year' ";
             $sql3 = "SELECT * from mgr.v_gl_profit_loss_monthly_bar  $param2 "; 
            $dt3 = $this->m_wsbangun->getData_by_query_cons($cons,$sql3);
            $bar='';
            if (!empty($dt3)) {
                    $jdata3= '';
                    $pattern='';
                    $jjum2= '';
                    $yeart='';
                    foreach ($dt3 as $key => $row) {
              
                        // $clr='';
                        // if($row->status=='1')
                        //     {
                        //         $clr='"#2ca02c"';//profit
                        //     } else {
                        //         $clr='"#d62728"';//loss
                        //     }

                        // $pattern.= $clr.',' ;
                      
                        $jdata3.= $row->profit_amt.',';
                        $yeart = $row->fyear;
                    }
             
                    $jdata3=substr($jdata3,0,-1);
                    // $jcolor=substr($jcolor,0,-1);
                    
                    $arrayMonth = ['January','February','March','April','May','June','July','August','September','October','November','December'];
                    
                    $bar.='var bar3 = c3.generate({bindto: "#barProfitLoss",padding: {bottom: 20,top:10},';
                    $bar.='data: {';
                    $bar.='     columns: [["'.$yeart.'",'.$jdata3.']], ';
                    $bar.='     type:"bar",';
                    $bar.='     color: function (color, d) {';
                    $bar.='         if (typeof d.index === "undefined") { return color; }';
                    $bar.='         return d.value > 0 ? "#2ca02c" : "#d62728";';
                    $bar.='         }';
                    $bar.='},';
                    $bar.='legend: {';
                    $bar.='    show: false';
                    $bar.='},';
                    $bar.='grid: {';
                    $bar.='    y: {';
                    $bar.='        lines: [';
                    $bar.='            {value: 0}';
                    // $pie2.='            {value: 350, text: 'Lable 350 for y', position: 'middle'}';
                    $bar.='            ]';
                    $bar.='        }';
                    $bar.='    },';
                    $bar.='axis: {';
                    $bar.='    x:{';
                    $bar.='         type: "category",';
                    $bar.='         categories:["January","February","March","April","May","June","July","August","September","October","November","December"]';
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
            //---------------------------------- end of profit loss bar ---------------------------
            //-------------------<start Income VS Expanse >--------------------------------------------
                $selectSql = '';
                $selectSql  .= ' select entity_cd,     fyear,      aperiod,        month_name = mgr.fn_month_name(aperiod),';
                $selectSql .= ' inc_amt = round(sum(income_amt),0),      inc_bgt = round(sum(income_budget),0),       exp_amt = round(sum(expense_amt),0),';
                $selectSql .= ' exp_bgt = round(sum(expense_budget),0) from mgr.v_gl_profit_loss_dtl ';
                $selectSql .= " WHERE entity_cd='".$entity."' AND fyear = '$year' ";
                $selectSql .= ' group by entity_cd,     fyear,      aperiod';
                // var_dump($selectSql);
                // $selectSql = 'select * from mgr.v_gl_profit_loss_dtl ';
                $dt1 = $this->m_wsbangun->getData_by_query_cons($cons,$selectSql);
                // $dt1 = $this->m_wsbangun->getData_by_query($selectSql);
                // var_dump($dt1);
                $InVSEx ='';
                if(!empty($dt1)){
                    $income_amt ='';//"['Income Amount',";
                    $income_budget ='';//"['Income Budget,'";
                    $expense_amt ='';// "['Expance Amount',";
                    $expense_budget ='';//"['Expance Budget',";
                    $label = '';
                    foreach ($dt1 as $key => $row) {
                        $income_amt .= $row->inc_amt.',';
                        $income_budget .= $row->inc_bgt.',';
                        if($row->exp_amt<0){
                            $exp_amt=$row->exp_amt*-1;
                        } else {
                            $exp_amt=$row->exp_amt;
                        }
                        $expense_amt .= $exp_amt.',';
                        $expense_budget .= $row->exp_bgt.',';

                        $label .= "'".$row->month_name."',";
                    }
                    $income_amt=substr($income_amt,0,-1);

                    $income_budget=substr($income_budget,0,-1);

                    $expense_amt=substr($expense_amt,0,-1);
                    // var_dump($expense_amt);exit();
                    $expense_budget=substr($expense_budget,0,-1);

                    $label=substr($label,0,-1);
                    // var_dump($label);
                  $InVSEx .=' var definecolor="",INCOME_A = Array(),INCOME_B = Array(),INCOME_A_color="";'; 
                  $InVSEx .=' var EXP_A = Array(),EXP_B = Array(),EXP_A_color="";'; 
                  $InVSEx .='var categories = ['.$label.'];';
                  $InVSEx .="var dtcolumns = [['x',".$label."],['IncomeBudget', ".$income_budget."],['IncomeAmount',".$income_amt."],['ExpanseBudget', ".$expense_budget."],['ExpanseAmount', ".$expense_amt."]];";  
                  $InVSEx .='  BarInVeX = c3.generate({ ';
                  $InVSEx .=" bindto: '#incomeVSexpanse',";
                  $InVSEx .=" data: { type: 'bar', x: 'x',";
                  $InVSEx .=" columns:dtcolumns,";
                  // $InVSEx .=" color: function (color, d) {";
                  // $InVSEx .="   console.log(dtcolumns[2][d.index + 1]+'--'+dtcolumns[1][d.index + 1]);";
                  // $InVSEx .="    return dtcolumns[0][d.index + 1] > dtcolumns[1][d.index + 1] ? '#F00' : '#00F';";
                  // $InVSEx .=" },";
                  // $InVSEx .="columns:[ ['x',".$label."],['IncomeBudget', ".$income_budget."],";
                  // $InVSEx .=" ['IncomeAmount',".$income_amt."],";
                  // $InVSEx .=" ['ExpanseBudget', ".$expense_budget."],";
                  // $InVSEx .=" ['ExpanseAmount', ".$expense_amt."]],";
                  // $InVSEx .='colors: {';
                  // // $InVSEx .='      IncomeAmount: "#2ca02c",';ijo
                  // // $InVSEx .='      IncomeBudget: "#909293",';abu2
                  // // $InVSEx .='      ExpanseAmount: "#d62728",';merah
                  // // $InVSEx .='      ExpanseBudget: "#1f77b4"';biru
                  // $InVSEx .='      IncomeBudget: "#909293",';
                  // $InVSEx .='      IncomeAmount: function(d) { console.log(d);},';
                  // $InVSEx .='      ExpanseBudget: "#909293",';
                  // $InVSEx .='      ExpanseAmount: "#d62728",';
                  // $InVSEx .='  },';
                  $InVSEx .='color: function (color, d) {';
           
                  //IF SUM INC ACTUAL > SUM INC BUDGET
                  
                  $InVSEx .='  if(d.id == "IncomeAmount"){  ';
                  $InVSEx .='  if(dtcolumns[2][d.index + 1] > dtcolumns[1][d.index + 1] )';
                  $InVSEx .='  { INCOME_A_color = "#1f77b4"; } else { INCOME_A_color = "#d62728"; }}'; 
                  //END OF IF SUM INC ACTUAL > SUM INC BUDGET
                  //IF SUM EXP ACTUAL > SUM EXP BUDGET
                  
                  // console.log(EXP_A.reduce((a, b) => a + b, 0)+"  -- "+EXP_B.reduce((a, b) => a + b, 0));';//sum expanse budget
                  $InVSEx .='  if(d.id == "ExpanseAmount"){  ';
                  $InVSEx .='  if(dtcolumns[4][d.index + 1] > dtcolumns[3][d.index + 1] )';
                  $InVSEx .='  { EXP_A_color = "#d62728"; } else { EXP_A_color = "#2ca02c"; }}'; 
                  //END OF IF SUM EXP ACTUAL > SUM EXP BUDGET
                  // DEFINE COLOR
                  $InVSEx .='  if(d.id=="IncomeAmount")';
                  $InVSEx .='  { return INCOME_A_color; }';
                  $InVSEx .='  else if(d.id=="ExpanseAmount") { return EXP_A_color; } else { return "#909293"}'; 
                  $InVSEx .=' },'; 

                  $InVSEx .='names:{';
                  $InVSEx .='      IncomeAmount: "Income Amount",';
                  $InVSEx .='      IncomeBudget:"Income Budget",';
                  $InVSEx .='      ExpanseAmount:"Expense Amount",';
                  $InVSEx .='      ExpanseBudget:"Expense Budget"';
                  $InVSEx .='  },';
                  // $InVSEx .=" groups: [['IncomeAmount', 'IncomeBudget'],";
                  // $InVSEx .="         ['ExpanseAmount', 'ExpanseBudget']]";
                  $InVSEx .="},";
                  $InVSEx .="legend: {";
                  // $InVSEx .="      colors: {";
                  // $InVSEx .="          'IncomeAmount': '#1f77b4',";
                  // $InVSEx .='           "IncomeBudget":"#909293",';
                  // $InVSEx .='           "ExpanseAmount":"#1f77b4",';
                  // $InVSEx .='           "ExpanseBudget":"#909293"';
                  // $InVSEx .="      }";
                  $InVSEx .="      show: false";
                  $InVSEx .="  },";
                  // $InVSEx .="   tooltip: {";
                  // $InVSEx .="          contents: function (d, defaultTitleFormat, defaultValueFormat, color) {";
                  // $InVSEx .="             color = function() {";
                  // $InVSEx .="                  if(d[2].value > d[1].value)";
                  // $InVSEx .="                  { INCOME_A_color = '#1f77b4'; } else { INCOME_A_color = '#d62728'; }";
                  // $InVSEx .="                  if(d[4].value > d[3].value)";
                  // $InVSEx .="                  { EXP_A_color = '#1f77b4'; } else { EXP_A_color = '#d62728'; }";
                  // $InVSEx .="                  return INCOME_A_color;";
                  // $InVSEx .="              };";
                  // $InVSEx .="           return BarInVeX.internal.getTooltipContent.call(this, d, defaultTitleFormat, defaultValueFormat, color)";
                  // $InVSEx .="          }";
                  // $InVSEx .="      },";
                  $InVSEx .="    axis: {x: {    ";
                  $InVSEx .="               type: 'category',   ";
                  $InVSEx .="               tick: {multiline: false}  ";
                  $InVSEx .="              }, ";
                  $InVSEx .="           y :{tick:{format : d3.format(',')}}}, ";
                  $InVSEx .="    tooltip: {  ";
                  $InVSEx .="           format: {  ";
                  $InVSEx .="               title: function (d) { ";
                  $InVSEx .="                     return categories[d];  ";
                  $InVSEx .="                   }";
                  $InVSEx .="               , value: function (value, ratio, id) { ";
                  $InVSEx .="                   var format=d3.format(','); ";
                  $InVSEx .="                   return format(value); ";
                  $InVSEx .="                   }";
                  $InVSEx .="               }, ";
                  $InVSEx .="          contents: function (d, defaultTitleFormat, defaultValueFormat, color) {";
                  $InVSEx .="             color = function() {";
                  $InVSEx .="                  if(d[1].value > d[0].value)";
                  $InVSEx .="                  { INCOME_A_color = '#1f77b4'; } else { INCOME_A_color = '#d62728'; }";
                  $InVSEx .="                  if(d[3].value > d[2].value)";
                  $InVSEx .="                  { EXP_A_color = '#d62728'; } else { EXP_A_color = '#2ca02c'; }";
                  // $InVSEx .='                   if(d.id=="IncomeAmount")';
                  // $InVSEx .='                   { return INCOME_A_color }';
                  // $InVSEx .='                   else if(d.id=="ExpanseAmount") { return EXP_A_color } else { return  "#909293"}'; 
                  $InVSEx .="              return ['IncomeAmount',INCOME_A_color],['ExpanseAmount',EXP_A_color],['IncomeBudget','#909293'],['ExpanseBudget','#909293']";      
                  $InVSEx .="              };";
                  $InVSEx .="           return BarInVeX.internal.getTooltipContent.call(this, d, defaultTitleFormat, defaultValueFormat, color)";
                  $InVSEx .="          }";
                  $InVSEx .="      } ";
                  $InVSEx .="    });console.log(BarInVeX.internal); ";
                }
            //-------------------<End Income VS Expanse >----------------------------------------------
            
            $content = array(  
                                
                                'js1'=>$pie1,
                                'js2'=>$pie2,
                                'js3'=>$bar,
                                'IncomeVSExpanse'=>$InVSEx,
                                'period'=>$month,
                                'fyear'=>$year,
                                'data_project'=>$this->entity_list($entity),
                                'trialyear'=>$this->year_list($entity,$year),
                                'profityear'=>$this->yearbar_list($entity,$year),
                                'divList'=>$this->div_list(""),
                                'deptList'=>$this->dept_list("")
                                );
            $this->load_content_top_menu('dash_finance/grafiknove',$content);
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
        $this->load_content_top_menu('dash_sales/index', $ContentAllData);

    }
    public function bar3(){
    
            $fyear = $this->input->post('fyear', TRUE);
            $entity = $this->input->post('entity',TRUE);
            $table = 'v_gl_profit_loss_monthly_bar';
            $crit = array('fyear'=>$fyear,'entity_cd'=>$entity);
            $databar = $this->m_wsbangun->getData_by_criteria($table,$crit);
            $jdata3='';$year='';
            foreach ($databar as $row) {
                $jdata3.= (float)$row->profit_amt.",";
                $year = $row->fyear;
            }
            $jdata3=substr($jdata3,0,-1);
            $bar3 = "".$year.",".$jdata3."";
            $wkwk  = array('year' => $year , 'data3'=>$bar3 );
        echo json_encode($wkwk);
    }
    public function project_list($project=''){
        $userid = $this->session->userdata('Tsname');
        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT distinct project_no,descs from mgr.v_cfs_user_project (nolock) where userid= '$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        // var_dump($project);
        $comboProject[]='';
            if(!empty($proDescs)) {
                $comboProject[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtProject) {

                  if($project === $dtProject->project_no) {
                    // var_dump($project.' -- '.$dtProject->project_no);
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
    public function entity_list($entity=''){
        $userid = $this->session->userdata("Tsname");
        $cons = $this->session->userdata('Tscons');
        $sql = "SELECT distinct entity_cd,entity_name from mgr.v_cfs_user_project(nolock) where userid='$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        // var_dump($project);
        $comboEntity[]='';
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtentity) {

                  if($entity === $dtentity->entity_cd) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtentity->entity_cd.'">'.$dtentity->entity_name.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            return $comboEntity;
    }
    public function div_list($div_cd=''){
        $cons = $this->session->userdata('Tscons');
         $table = "SELECT distinct div_cd,descs from mgr.cf_div (nolock) ";
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$table);
        // var_dump($project);
        $comboEntity[]='';
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtentity) {

                  if($div_cd === $dtentity->div_cd) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtentity->div_cd.'">'.$dtentity->div_cd.' - '.$dtentity->descs.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            return $comboEntity;
    }
    public function dept_list($dept_cd=''){
        $cons = $this->session->userdata('Tscons');
         $table = "SELECT distinct dept_cd,descs from mgr.cf_dept (nolock) ";
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$table);
        // var_dump($project);
        $comboEntity[]='';
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtentity) {

                  if($dept_cd === $dtentity->dept_cd) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtentity->dept_cd.'">'.$dtentity->dept_cd.' - '.$dtentity->descs.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            return $comboEntity;
    }
    public function year_list($entity='',$fyear=''){
        $cons = $this->session->userdata('Tscons');
         $table = "SELECT distinct fyear from mgr.v_gl_trial_bal_graph (nolock) WHERE entity_cd='$entity' ";
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$table);
        // var_dump($project);
        $comboEntity[]='';
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtentity) {

                  if($fyear === $dtentity->fyear) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtentity->fyear.'">'.$dtentity->fyear.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            return $comboEntity;
    }
    public function yearbar_list($entity='',$fyear=''){
        $cons = $this->session->userdata('Tscons');
         $table = "SELECT distinct fyear from mgr.v_gl_profit_loss_monthly_bar (nolock) WHERE entity_cd='$entity' ";
        // var_dump($table);
        $proDescs = $this->m_wsbangun->getData_by_query_cons($cons,$table);
        // var_dump($project);
        $comboEntity[]='';
            if(!empty($proDescs)) {
                $comboEntity[] = '<option></option>';
                 // $comboProject[] = '<option value="1"></option>';
                foreach ($proDescs as $dtentity) {

                  if($fyear === $dtentity->fyear) {
                    // var_dump($project.' -- '.$dtProject->project_no);
                    $pilih = ' selected = "1"';
                  } else {
                    $pilih = '';
                  }
                    $comboEntity[] = '<option '.$pilih.' value="'.$dtentity->fyear.'">'.$dtentity->fyear.'</option>';
                }
                $comboEntity = implode("", $comboEntity);
            }
            return $comboEntity;
    }
public function filter_Gl_balance(){
    if($_POST){
        $cons = $this->session->userdata('Tscons');
        // $entity = $this->input->post('entity', TRUE); 
        $entity = $this->session->userdata('Tsentity');
        $Year = $this->input->post('Year', TRUE);    
        $Aperiod = $this->input->post('Aperiod', TRUE);    
        
        $param = " where  entity_cd='".$entity."'";        
        $sql = "SELECT * from mgr.fn_v_gl_trial('$Aperiod','$Year')  $param  ORDER BY acct_type_descs,fyear"; 
        $dt1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

            if (!empty($dt1)) {
                    $jdata1= '';
                    // $jdata3='';
                    $jcolor= '';
                    $jjum1= '';

                    foreach ($dt1 as $key => $row) {
                        $p1 = $row->acct_type_descs.','.$row->trx_amt;
                        // $P2 = '["'.$row->status_descs.'",'.$row->unit.']';

                        $jdata1.= $p1.'-,';
                        // $jcolor.= $c1.',';
                        // $jdata3.= $P2.',';
                    }
                    $jdata1=','.substr($jdata1,0,-1);
                    // $jcolor=substr($jcolor,0,-1);
                    // $jdata3=substr($jdata3,0,-1);

                    // $pie1 = '';
                    // $pie1.='var chart1 = c3.generate({bindto: "#pieBalanceGL",padding: {bottom: 20,top:10}, data: {';
                    // $pie1.='         columns: [ '.$jdata1.'], ';
                    // $pie1.='         type : "pie"        ';
                    // $pie1.='                 '; // colors :{'.$jcolor.'}
                    // $pie1.='     }, ';
                    // $pie1.='     tooltip: { ';
                    // $pie1.='         format: { ';
                    // // $pie1.='             // title: function (d) { return 'Data ' + d; }, ';
                    // $pie1.='             value: function (value, ratio, id) { ';
                    // $pie1.='                 return formatNumber(value); ';
                    // $pie1.='             } ';
                    // $pie1.='         } ';
                    // $pie1.='     } ';
                    // $pie1.=' });';
                     $msg1=array(//'Pesan'=>$msg,
                        'data'=>$jdata1
                        // 'Income_Budget'=>$data2,
                        // 'Expanse_Amount'=>$data3,
                        // 'Expanse_Budget'=>$data4,
                        );

                 echo json_encode($msg1);

            }

    }
    
}
public function filter_IncomeVsexpanse(){
        if($_POST){
            $cons = $this->session->userdata('Tscons');
            // $entity = $this->session->userdata('Tsentity');
            // $project = $this->session->userdata('Tsproject');
            $entity = $this->input->post('entity', TRUE); 
            $incomeYear = $this->input->post('incomeYear', TRUE);    
            $div_cd_post = $this->input->post('div_cd', TRUE);    
            $dept_cd_post = $this->input->post('dept_cd', TRUE);  

            $where =' ';
            if(!empty($div_cd_post)){
                  // $div_array = explode(',', $div_cd_post);            
                  $div_cd_in = "'".implode("','", $div_cd_post)."'";
                  $where = $where . " AND div_cd IN (".$div_cd_in.") ";
             }

             if(!empty($dept_cd_post)){
                // $dept_array = explode(',', $dept_cd_post);
                $dept_cd_in = "'".implode("','", $dept_cd_post)."'";   
                $where = $where . " AND dept_cd IN (".$dept_cd_in.") "; 
             }
                
                $selectSql = '';
                $selectSql  .= ' select entity_cd,     fyear,      aperiod,        month_name = mgr.fn_month_name(aperiod),';
                $selectSql .= ' inc_amt = sum(income_amt),      inc_bgt = sum(income_budget),       exp_amt = sum(expense_amt),';
                $selectSql .= ' exp_bgt = sum(expense_budget) from mgr.v_gl_profit_loss_dtl ';
                $selectSql .= " WHERE entity_cd='".$entity."' and fyear = '".$incomeYear."' ".$where;
                // AND fyear = '2015'  AND div_cd = '1000' AND dept_cd ='1000' ";
                $selectSql .= ' group by entity_cd,     fyear,      aperiod';

                $data = $this->m_wsbangun->getData_by_query_cons($cons,$selectSql);

                $newData ='';
                $msg = '';
                    $income_amt ='';//"['Income Amount',";
                    $income_budget ='';//"['Income Budget,'";
                    $expense_amt ='';// "['Expance Amount',";
                    $expense_budget ='';//"['Expance Budget',";
                    $label = '';
                if(!empty($data)){
                      
                    
                    foreach ($data as $key => $row) {
                        $income_amt .= $row->inc_amt.',';
                        $income_budget .= $row->inc_bgt.',';

                        $expense_amt .= $row->exp_amt.',';
                        $expense_budget .= $row->exp_bgt.',';
                        $label .= $row->month_name.",";
                    }

                    $income_amt=substr($income_amt,0,-1);
                    $income_budget=substr($income_budget,0,-1);

                    $expense_amt=substr($expense_amt,0,-1);
                    $expense_budget=substr($expense_budget,0,-1);
                    $label=substr($label,0,-1);
                  
                    //  $jdata3=substr($jdata3,0,-1);
                    // $bar3 = "".$year.",".$jdata3."";
                    // $wkwk  = array('year' => $year , 'data3'=>$bar3 );

                        $data1 = "IncomeAmount,".$income_amt;
                        $data2 = "IncomeBudget,".$income_budget;
                        $data3 = "ExpanseAmount,".$expense_amt;
                        $data4 = "ExpanseBudget,".$expense_budget;
                        $lbl = "x,".$label;

                    $msg ='OK';
                }else{
                     $data1 = "0";
                     $data2 = "0";
                     $data3 = "0";
                     $data4 = "0";
                     $lbl = "0";
                }

                

            $msg1=array(//'Pesan'=>$msg,
                        'x'=>$lbl,
                        'IncomeBudget'=>$data2,
                        'IncomeAmount'=>$data1,
                        'ExpanseBudget'=>$data4,
                        'ExpanseAmount'=>$data3,
                        );

                 echo json_encode($msg1);

        }



    }


    public function upApv()
    {
        $cons = $this->session->userdata('Tscons');
        
        if($_POST)
        {
            $resback = false;
            $userid = $this->input->post('user_id', TRUE);
            $status = $this->input->post('status',TRUE);
            $doc_no = $this->input->post('doc_no',TRUE);
            $entity = $this->session->userdata('Tsentity');
            $project = $this->session->userdata('Tsproject');
            $today = date('Y M d H:i:s');
            // save approval
            $table = 'cm_authorized_person';
            $crit = array('type'=>'A',
                'doc_no'=>$doc_no,
                'user_id'=>$userid,
                'entity_cd'=>$entity,
                'project_no'=>$project);
            $data = array('status'=>$status,
                'approved_date'=>$today);
            $this->m_wsbangun->updateData($table, $data, $crit);
            // print_r('approve');
            // check other approver
            $ord = array('level_no', 'ASC');
            $crit = array('type'=>'A',
                'status'=>'N',
                'entity_cd'=>$entity,
                'project_no'=>$project,
                'doc_no'=>$doc_no);
            // $cnt = $this->m_wsbangun->getCount_by_criteria($table, $crit);
            $dtApv = $this->m_wsbangun->getData_by_criteria($table, $crit, null, $ord);
            $table = 'rl_sales';
            $crit = array('ref_no'=>$doc_no);
            $dtSale = $this->m_wsbangun->getData_by_criteria($table, $crit);
            $acct = $dtSale[0]->debtor_acct;
            if(!empty($dtApv)) 
            {
                // update status next approver
                $othApv = $dtApv[0]->user_id;
                $table = 'cm_authorized_person';
                $data1 = array('status'=>'O');
                $crit = array('type'=>'A',
                    'status'=>'N',
                    'entity_cd'=>$entity,
                    'project_no'=>$project,
                    'doc_no'=>$doc_no,
                    'user_id'=>$othApv);
                $this->m_wsbangun->updateData($table, $data1, $crit);
                // find detail data
                $table = 'security_users';
                $crit = array('name'=>$othApv);
                $dtUser = $this->m_wsbangun->getData_by_criteria($table, $crit);
                if(!empty($dtUser))
                {
                    $destno = $dtUser[0]->phone_cellular;
                    $mailto = $dtUser[0]->email;
                    
                    if(!empty($dtSale))
                    {
                        $lot = $dtSale[0]->lot_no;
                        $acct = $dtSale[0]->debtor_acct;
                        $table = 'ar_debtor';
                        $crit = array('debtor_acct'=>$acct);
                        $dtAcct = $this->m_wsbangun->getData_by_criteria($table, $crit);
                        $dtName = (!empty($dtAcct)) ? $dtAcct[0]->name : '';
                        // if(!empty($dtAcct))
                        // {
                        //     $dtName = $dtAcct->name;
                        // }
                        // var_dump($dtName);
                    }
                    // notify sms
                    if(!empty($destno)||!empty($dtName))
                    {
                        $msgSMS = array('DestinationNumber'=>$destno,
                            "TextDecoded"=>'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName,
                            "creatorID"=>'MGR');
                        $this->m_sms->SendSms($msgSMS);
                        // print_r("sms");
                    }

                    // notify email
                    if(!empty($mailto)||!empty($dtName))
                    {
                        $subj = 'Approval';
                        $body = 'Congrat,'."\n\n";
                        $body.= 'Please review and approve new booking unit: '.$lot.' Cs Name: '.$dtName.','."\n\n";
                        $body.= 'Thank you,';
                        $this->_sendmail($mailto, $subj, $body);
                        // print_r("email");
                    }
                }
            } else {
                if(!empty($acct))
                {
                    $sql = "mgr.xrl_billing_chrg '".$entity."', '".$project."','".$acct."'";
                    $res = $this->m_wsbangun->getData_by_query_cons($cons,$sql);

                    $table = 'rl_sales';
                    $crit = array('entity_cd'=>$entity,
                        'project_no'=>$project,
                        'ref_no'=>$doc_no);
                    $data = array('status'=>'B');
                    $this->m_wsbangun->updateData($table, $data, $crit);
                    // print_r("xrl");
                }
                $resback = true;    
            }
        }
        $tes = array('tes' => $resback );
        echo json_encode($tes);
    }
}