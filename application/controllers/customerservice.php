<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Customerservice extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->auth_check();
        $this->load->model('m_wsbangun');
    }

    public function index()
    {
        $entity = $this->session->userdata('Tsentity');
        
        $project = $this->session->userdata('Tsproject');
        $seqno = $this->input->post('seqno', true);
        $pdfname='';
        $status='';
  
        $param = $this->uri->segment(3);
        // var_dump($param);
        $paramDcd = base64_decode($param);
        

        if(empty($paramDcd)) {
            $project_no = $this->session->userdata('Tsproject');
            $projectName = $this->session->userdata('Tsprojectname') ;
            // var_dump($project_no);
        } else {
            $email = $this->session->userdata('Tsemail');
            // $a = strrpos($paramDcd, '-');
            $b = explode("-%-", $paramDcd);
            // $project_no = substr($paramDcd, 0,$a);
            // var_dump($b);
            $project_no = $b[0];
            $projectName = $b[1];
            $dbprofile = $b[2];
            // var_dump($b);exit();
            
            
            
            $Squery ="SELECT max(entity_cd) as entity_cd ,max(entity_name) as entity_name from mgr.v_cf_entity_project where project_no ='$project_no' ";            
            $dd = $this->m_wsbangun->getData_by_query_cons($dbprofile,$Squery);
            // var_dump($Squery);var_dump($dd);
            $entity = $dd[0]->entity_cd;
            $entity_name = $dd[0]->entity_name;

       
            $position ='T';
 
            $this->session->set_userdata('TMenuPs',$position);
            $this->session->set_userdata('Tsentityname',$entity_name);
            $this->session->set_userdata('Tsentity', $entity);              
            $this->session->set_userdata('Tsproject', $project_no);            
            $this->session->set_userdata('Tsprojectname', $projectName);
            $this->session->set_userdata('Tscons', $dbprofile);
        }      
        
        $cons = $this->session->userdata('Tscons');
        $user_id = $this->session->userdata('Tsname');
        $user_email = $this->session->userdata('Tsemail'); 
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $count='';
        

        //start of making activity
        $div_activ='';
        $sql ="SELECT * from mgr.sysactivity where entity_cd='$entity' and project_no='$project' and email_addr ='$user_email' order by Activitydate desc ";            
        $dtactiv = $this->m_wsbangun->getData_by_queryadm($sql);
        // $dtactiv = null;
        if(!empty($dtactiv)){
            foreach ($dtactiv as $key) {
              
                if($key->ActivityCd =='NEW'){
                    $classcolors = 'info';
                    $icon = 'ft-tag';
                    $activdescs='Submitted a Ticket';
                } else if($key->ActivityCd =='ASSIGN'){
                    $classcolors = 'danger';
                    $icon = 'ft-user-plus';
                    $activdescs='Assigned a Ticket';
                }else if($key->ActivityCd =='APPROVAL'){
                    $classcolors = 'warning';
                    $icon = 'ft-user-check';
                    $activdescs='Approved a Ticket';
                }else if($key->ActivityCd =='CONFIRM'){
                    $classcolors = 'teal';
                    $icon = 'ft-save';
                    $activdescs='Confirmed a Ticket';
                }else if($key->ActivityCd =='MODIFY'){
                    $classcolors = 'primary';
                    $icon = 'ft-save';
                    $activdescs='Modified a Ticket';
                }else if($key->ActivityCd =='PROCESS'){
                    $classcolors = 'success';
                    $icon = 'ft-clock';
                    $activdescs='Processed a Ticket';
                }else if($key->ActivityCd =='SURVEY'){
                    $classcolors = 'teal';
                    $icon = 'ft-save';
                    $activdescs='Submitted a Survey';
                }else if($key->ActivityCd =='CLOSE'){
                    $classcolors = 'danger';
                    $icon = 'la la-close';
                    $activdescs='Closed a Ticket';
                } else {
                    $icon = 'ft-loader';
                    $classcolors = 'dark';
                    $activdescs='Undefined'; 
                }
             
              

                  //   $div_activ.='<div class="media">';
                  // $div_activ.='  <div class="media-left align-self-center"><i class="'.$icon.' '.$classcolors.' font-medium-4 mt-2"></i></div>';
                  // $div_activ.='  <div class="media-body">';
                  // $div_activ.='    <small class="pull-right">'.$this->time_elapsed_string($key->ActivityDate).'</small>';
                  // $div_activ.='    <h6 class="media-heading '.$classcolors.'">'.$activdescs.'</h6>';
                  // $div_activ.='   <p class="notification-text font-small-3 text-muted text-bold-600">'.$key->Remarks.'</p><small>';
                  // $div_activ.='      <time class="media-meta text-muted">at '.date('g:i a',strtotime($key->ActivityDate)).' - '.date('j F Y',strtotime($key->ActivityDate)).'</time></small>';
                  // $div_activ.='  </div>';
                  // $div_activ.='</div>';

                  $div_activ.='<li>';
                  $div_activ.='  <div class="timeline-icon bg-'.$classcolors.'">';
                  $div_activ.='    <i class="'.$icon.' font-medium-1"></i>';
                  $div_activ.='  </div>';
                 
                  $div_activ.='  <div class="base-timeline-'.$classcolors.'">';
                  $div_activ.='    <a href="#" class="text-'.$classcolors.' text-uppercase line-height-2"> '.$activdescs.'</a>';
                  $div_activ.='    <small class="pull-right">'.$this->time_elapsed_string($key->ActivityDate).'</small>';
                  $div_activ.='    <span class="d-block">'.$key->Remarks.'</span>';
                  $div_activ.='  </div>';
                  $div_activ.='  <small class="text-muted">';
                  $div_activ.='    at '.date('g:i a',strtotime($key->ActivityDate)).' - '.date('j F Y',strtotime($key->ActivityDate));
                  $div_activ.='  </small>';
                   
                  $div_activ.='</li>';
                           
            }
        } else {
            $div_activ.='<p style="padding-left: 15px;padding-top: 10px;">No Activity Available.</p>';
        }
        $sql ="SELECT * from mgr.v_sv_dash_ticket_type where entity_cd='$entity' and project_no='$project' ";            
        $dtpertype = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $graphtype='';
        if(!empty($dtpertype)){
            $labeltype='';$jdatatype='';
            foreach ($dtpertype as $key => $row) {
                $labeltype .= '"'.$row->ticket_type.'",';
                $jdatatype.= $row->total.',';
            }
            
  

            $graphtype.='var graphtype = new Chartist.Bar("#graphtype", {';
            $graphtype.='    labels: ['.$labeltype.'],';
            $graphtype.='   series: [';
            $graphtype.='        ['.$jdatatype.']';
            // $graphtype.='        [8000, 12000],[9000, 5000]';
            $graphtype.='    ]';
            $graphtype.='}, {';
            $graphtype.='        axisY: {';
            $graphtype.='            labelInterpolationFnc: function (value) {';
            $graphtype.='                return value ;';
            $graphtype.='            },';
            $graphtype.='            scaleMinSpace: 50,';
            $graphtype.='        },';
            $graphtype.='       axisX: {';
            $graphtype.='            showGrid: false';
            $graphtype.='        },';
            $graphtype.='        plugins: [';
            $graphtype.='           Chartist.plugins.tooltip({';
            $graphtype.='                appendToBody: true';
            $graphtype.='            })';
            $graphtype.='        ]';
            $graphtype.='    });';
            $graphtype.='graphtype.on("draw", function (data) {';
            $graphtype.='    if (data.type === "bar") {';
            $graphtype.='        data.element.attr({';
            $graphtype.='            style: "stroke-width: 30px",';
            $graphtype.='            y1: 350,';
            $graphtype.='            x1: data.x1 + 0.001';
            $graphtype.='        });';
            $graphtype.='        data.group.append(new Chartist.Svg("circle", {';
            $graphtype.='            cx: data.x2,';
            $graphtype.='            cy: data.y2,';
            $graphtype.='            r: 15';
            $graphtype.='        }, "ct-slice-pie"));';
            $graphtype.='    }';
            $graphtype.='});';
            $graphtype.='graphtype.on("created", function (data) {';
            $graphtype.='        var defs = data.svg.querySelector("defs") || data.svg.elem("defs");';
            $graphtype.='        defs.elem("linearGradient", {';
            $graphtype.='            id: "bartype1",';
            $graphtype.='            x1: 0,';
            $graphtype.='            y1: 0,';
            $graphtype.='            x2: 0,';
            $graphtype.='            y2: 1';
            $graphtype.='        }).elem("stop", {';
            $graphtype.='            offset: 0,';
            $graphtype.='            "stop-color": "rgba(132, 60, 247,1)"';
            $graphtype.='        }).parent().elem("stop", {';
            $graphtype.='            offset: 1,';
            $graphtype.='            "stop-color": "rgba(56, 184, 242, 1)"';
            $graphtype.='        });';
            $graphtype.='        defs.elem("linearGradient", {';
            $graphtype.='            id: "bartype2",';
            $graphtype.='            x1: 0,';
            $graphtype.='            y1: 0,';
            $graphtype.='            x2: 0,';
            $graphtype.='            y2: 1';
            $graphtype.='        }).elem("stop", {';
            $graphtype.='            offset: 0,';
            $graphtype.='            "stop-color": "#f6adb1"';
            $graphtype.='        }).parent().elem("stop", {';
            $graphtype.='            offset: 1,';
            $graphtype.='            "stop-color": "#f75e3b"';
            $graphtype.='        });';
            $graphtype.='        return defs;';
            $graphtype.='    });';

        } else {
            $graphtype.='var graphtype = new Chartist.Bar("#graphtype", {';
            $graphtype.='    labels: ["No Data Available"],';
            $graphtype.='   series: [';
            $graphtype.='        [0]';
            // $graphtype.='        [8000, 12000],[9000, 5000]';
            $graphtype.='    ]';
            $graphtype.='}, {';
            $graphtype.='        axisY: {';
            $graphtype.='            labelInterpolationFnc: function (value) {';
            $graphtype.='                return value ;';
            $graphtype.='            },';
            $graphtype.='            scaleMinSpace: 50,';
            $graphtype.='        },';
            $graphtype.='       axisX: {';
            $graphtype.='            showGrid: false';
            $graphtype.='        },';
            $graphtype.='        plugins: [';
            $graphtype.='           Chartist.plugins.tooltip({';
            $graphtype.='                appendToBody: true';
            $graphtype.='            })';
            $graphtype.='        ]';
            $graphtype.='    });';
        }
        $sql ="SELECT * from mgr.v_sv_dash_customer_type where entity_cd='$entity' and project_no='$project' ";            
        $dtpercust = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $graphcust='';
        if(!empty($dtpercust)){
            $labelcust='';$jdatacust='';
            foreach ($dtpercust as $key => $row) {
                $labelcust .= '"'.$row->customer_type.'",';
                $jdatacust.= $row->total.',';
            }
            
            // $jdata1=substr($jdata1,0,-1);

     
            $graphcust.='var graphcust = new Chartist.Bar("#graphcust", {';
            $graphcust.='    labels: ['.$labelcust.'],';
            $graphcust.='   series: [';
            $graphcust.='        ['.$jdatacust.']';
            // $graphcust.='        [8000, 12000],[9000, 5000]';
            $graphcust.='    ]';
            $graphcust.='}, {';
            $graphcust.='        axisY: {';
            $graphcust.='            labelInterpolationFnc: function (value) {';
            $graphcust.='                return value ;';
            $graphcust.='            },';
            $graphcust.='            scaleMinSpace: 50,';
            $graphcust.='        },';
            $graphcust.='       axisX: {';
            $graphcust.='            showGrid: false';
            $graphcust.='        },';
            $graphcust.='        plugins: [';
            $graphcust.='           Chartist.plugins.tooltip({';
            $graphcust.='                appendToBody: true';
            $graphcust.='            })';
            $graphcust.='        ]';
            $graphcust.='    });';
            $graphcust.='graphcust.on("draw", function (data) {';
            $graphcust.='        if (data.type === "bar") {';
            $graphcust.='            data.element.attr({';
            $graphcust.='                style: "stroke-width: 30px",';
            $graphcust.='                y1: 350,';
            $graphcust.='                x1: data.x1 + 0.001';
            $graphcust.='            });';
            $graphcust.='            data.group.append(new Chartist.Svg("circle", {';
            $graphcust.='                cx: data.x2,';
            $graphcust.='                cy: data.y2,';
            $graphcust.='                r: 15';
            $graphcust.='            }, "ct-slice-pie"));';
            $graphcust.='        }';
            $graphcust.='    });';
            $graphcust.='graphcust.on("created", function (data) {';
            $graphcust.='        var defs = data.svg.querySelector("defs") || data.svg.elem("defs");';
            $graphcust.='        defs.elem("linearGradient", {';
            $graphcust.='            id: "barcust1",';
            $graphcust.='            x1: 0,';
            $graphcust.='            y1: 0,';
            $graphcust.='            x2: 0,';
            $graphcust.='            y2: 1';
            $graphcust.='        }).elem("stop", {';
            $graphcust.='            offset: 0,';
            $graphcust.='            "stop-color": "#f6adb1"';
            $graphcust.='        }).parent().elem("stop", {';
            $graphcust.='            offset: 1,';
            $graphcust.='            "stop-color": "#f75e3b"';
            $graphcust.='        });';
            $graphcust.='        return defs;';
            $graphcust.='    });';

        }else{
            $graphcust.='var graphcust = new Chartist.Bar("#graphcust", {';
            $graphcust.='    labels: ["No Data Available"],';
            $graphcust.='   series: [';
            $graphcust.='        [0]';
            // $graphcust.='        [8000, 12000],[9000, 5000]';
            $graphcust.='    ]';
            $graphcust.='}, {';
            $graphcust.='        axisY: {';
            $graphcust.='            labelInterpolationFnc: function (value) {';
            $graphcust.='                return value ;';
            $graphcust.='            },';
            $graphcust.='            scaleMinSpace: 50,';
            $graphcust.='        },';
            $graphcust.='       axisX: {';
            $graphcust.='            showGrid: false';
            $graphcust.='        },';
            $graphcust.='        plugins: [';
            $graphcust.='           Chartist.plugins.tooltip({';
            $graphcust.='                appendToBody: true';
            $graphcust.='            })';
            $graphcust.='        ]';
            $graphcust.='    });';
        }
        $sql ="SELECT * from mgr.v_sv_dash_priority_type where entity_cd='$entity' and project_no='$project' ";            
        $dtperprior = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        // $dtperprior='';
        $graphprior='';
        if(!empty($dtperprior)){
            $labelprior='';$jdataprior='';
            foreach ($dtperprior as $key => $row) {
               
                $labelprior .= '"'.$row->priority.'",';
                $jdataprior.= $row->total.',';
            }
            
           

            $graphprior.='var graphprior = new Chartist.Bar("#graphprior", {';
            $graphprior.='    labels: ['.$labelprior.'],';
            $graphprior.='   series: [';
            $graphprior.='        ['.$jdataprior.']';
            // $graphprior.='        [8000, 12000],[9000, 5000]';
            $graphprior.='    ]';
            $graphprior.='}, {';
            $graphprior.='        axisY: {';
            $graphprior.='            labelInterpolationFnc: function (value) {';
            $graphprior.='                return value ;';
            $graphprior.='            },';
            $graphprior.='            scaleMinSpace: 50,';
            $graphprior.='        },';
            $graphprior.='       axisX: {';
            $graphprior.='            showGrid: false';
            $graphprior.='        },';
            $graphprior.='        plugins: [';
            $graphprior.='           Chartist.plugins.tooltip({';
            $graphprior.='                appendToBody: true';
            $graphprior.='            })';
            $graphprior.='        ]';
            $graphprior.='    });';
            $graphprior.='graphprior.on("draw", function (data) {';
            $graphprior.='        if (data.type === "bar") {';
            $graphprior.='            data.element.attr({';
            $graphprior.='                style: "stroke-width: 30px",';
            $graphprior.='                y1: 350,';
            $graphprior.='                x1: data.x1 + 0.001';
            $graphprior.='            });';
            $graphprior.='            data.group.append(new Chartist.Svg("circle", {';
            $graphprior.='                cx: data.x2,';
            $graphprior.='                cy: data.y2,';
            $graphprior.='                r: 15';
            $graphprior.='            }, "ct-slice-pie"));';
            $graphprior.='        }';
            $graphprior.='    });';
            $graphprior.='graphprior.on("created", function (data) {';
            $graphprior.='        var defs = data.svg.querySelector("defs") || data.svg.elem("defs");';
            $graphprior.='        defs.elem("linearGradient", {';
            $graphprior.='            id: "barprior1",';
            $graphprior.='            x1: 0,';
            $graphprior.='            y1: 0,';
            $graphprior.='            x2: 0,';
            $graphprior.='            y2: 1';
            $graphprior.='        }).elem("stop", {';
            $graphprior.='            offset: 0,';
            $graphprior.='            "stop-color": "#4e7c43"';
            $graphprior.='        }).parent().elem("stop", {';
            $graphprior.='            offset: 1,';
            $graphprior.='            "stop-color": "#93d385"';
            $graphprior.='        });';
            $graphprior.='        defs.elem("linearGradient", {';
            $graphprior.='            id: "barprior2",';
            $graphprior.='            x1: 0,';
            $graphprior.='            y1: 0,';
            $graphprior.='            x2: 0,';
            $graphprior.='            y2: 1';
            $graphprior.='        }).elem("stop", {';
            $graphprior.='            offset: 0,';
            $graphprior.='            "stop-color": "#ff9d00"';
            $graphprior.='        }).parent().elem("stop", {';
            $graphprior.='            offset: 1,';
            $graphprior.='            "stop-color": "#ffcd7c"';
            $graphprior.='        });';
            $graphprior.='        defs.elem("linearGradient", {';
            $graphprior.='            id: "barprior3",';
            $graphprior.='            x1: 0,';
            $graphprior.='            y1: 0,';
            $graphprior.='            x2: 0,';
            $graphprior.='            y2: 1';
            $graphprior.='        }).elem("stop", {';
            $graphprior.='            offset: 0,';
            $graphprior.='            "stop-color": "#ff2626"';
            $graphprior.='        }).parent().elem("stop", {';
            $graphprior.='            offset: 1,';
            $graphprior.='            "stop-color": "#ff9b9b"';
            $graphprior.='        });';
            $graphprior.='        return defs;';
            $graphprior.='    });';

        } else {
            $graphprior.='var graphprior = new Chartist.Bar("#graphprior", {';
            $graphprior.='    labels: ["No Data Available"],';
            $graphprior.='   series: [';
            $graphprior.='        [0]';
            // $graphprior.='        [8000, 12000],[9000, 5000]';
            $graphprior.='    ]';
            $graphprior.='}, {';
            $graphprior.='        axisY: {';
            $graphprior.='            labelInterpolationFnc: function (value) {';
            $graphprior.='                return value ;';
            $graphprior.='            },';
            $graphprior.='            scaleMinSpace: 50,';
            $graphprior.='        },';
            $graphprior.='       axisX: {';
            $graphprior.='            showGrid: false';
            $graphprior.='        },';
            $graphprior.='        plugins: [';
            $graphprior.='           Chartist.plugins.tooltip({';
            $graphprior.='                appendToBody: true';
            $graphprior.='            })';
            $graphprior.='        ]';
            $graphprior.='    });';
        }
        $sql ="SELECT * from mgr.v_sv_dash_category where entity_cd='$entity' and project_no='$project' ";            
        $dtcate = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $surv = $count;    
        $surveyy=$this->session->userdata('Is_Survey');
        $this->session->set_userdata('Is_Survey',false );
        $content = array(
          
            'divactiv'=>$div_activ,
            'projectName'=>$projectName,
            'project_no'=>$project_no,
            'DataSurvey'=>$surv,
            'name'=>$user_id,
            'dtcate'=>$dtcate,
            'jstype'=>$graphtype,
            'jscust'=>$graphcust,
            'jsprior'=>$graphprior,
            'Surveyy'=>$surveyy
            );
        
        $this->load_content_top_menu('dash_cs/index', $content);

    }
    function get_graphtype(){
        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $sql ="SELECT * from mgr.v_sv_dash_ticket_type where entity_cd='$entity' and project_no='$project' ";            
        $dtpertype = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $labeltype='';$jdatatype='';$graphtype='';
        if(!empty($dtpertype)){
            
            foreach ($dtpertype as $key => $row) {
               
                $labeltype .= '"'.$row->ticket_type.'",';
                $jdatatype.= $row->total.',';
            }
            // $labeltype = '"a","b",';
            // $jdatatype = "45,20,";
        }
        $labeltype=substr($labeltype,0,-1);
        $jdatatype=substr($jdatatype,0,-1);
            
         // $jdatatype = explode(",",$jdatatype);
           $graphtype = array('labels' =>$labeltype ,'series'=>$jdatatype
                            );
           // var_dump($graphtype);exit();
        echo json_encode($graphtype);
    }
    function get_graphcust(){
        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $sql ="SELECT * from mgr.v_sv_dash_customer_type where entity_cd='$entity' and project_no='$project' ";            
        $dtpercust = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $graphcust='';
        if(!empty($dtpercust)){
            $labelcust='';$jdatacust='';
            foreach ($dtpercust as $key => $row) {
                $labelcust .= '"'.$row->customer_type.'",';
                $jdatacust.= $row->total.',';
            }
            // $labeltype = '"a","b",';
            // $jdatatype = "45,20,";
        }
        $labelcust=substr($labelcust,0,-1);
        $jdatacust=substr($jdatacust,0,-1);
            
         // $jdatatype = explode(",",$jdatatype);
           $graphcust = array('labels' =>$labelcust ,'series'=>$jdatacust
                            );
           // var_dump($graphtype);exit();
        echo json_encode($graphcust);
    }
    function get_graphprior(){
        $cons = $this->session->userdata('Tscons');
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $sql ="SELECT * from mgr.v_sv_dash_priority_type where entity_cd='$entity' and project_no='$project' ";            
        $dtperprior = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        // $dtperprior='';
        $graphprior='';
        if(!empty($dtperprior)){
            $labelprior='';$jdataprior='';
            foreach ($dtperprior as $key => $row) {
               
                $labelprior .= '"'.$row->priority.'",';
                $jdataprior.= $row->total.',';
            }
            // $labelprior = $labelprior.'"High",';
            // $jdataprior = $jdataprior."20,";
        }
        $labelprior=substr($labelprior,0,-1);
        $jdataprior=substr($jdataprior,0,-1);
            
         // $jdatatype = explode(",",$jdatatype);
           $graphprior = array('labels' =>$labelprior ,'series'=>$jdataprior
                            );
           // var_dump($graphtype);exit();
        echo json_encode($graphprior);
    }
    function load_unseen_notif_cnt(){
        $user_email = $this->session->userdata('Tsemail'); 
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $divcnt_notif = '';
        $sql ="SELECT count(*) as cnt from mgr.sysnotification where entity_cd='$entity' and project_no='$project' and email_addr ='$user_email' and isread='0' ";
        $cntnotif = $this->m_wsbangun->getData_by_queryadm($sql);
        $newnotif = (int)$cntnotif[0]->cnt;
        if($newnotif>0){
            
            $divcnt_notif.='<span class="badge badge-pill badge-sm badge-danger badge-default badge-up badge-glow">'.$newnotif.'</span>';
        }
        $content = array('cntnotif' => $divcnt_notif);
        $this->load->view('dash_cs/unseen_notif_cnt',$content);
    }
    function load_unseen_notif(){
        $user_email = $this->session->userdata('Tsemail'); 
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');

        $divcnt_notif = '';
        $sql ="SELECT count(*) as cnt from mgr.sysnotification where entity_cd='$entity' and project_no='$project' and email_addr ='$user_email' and isread='0' ";
        $cntnotif = $this->m_wsbangun->getData_by_queryadm($sql);
        $newnotif = (int)$cntnotif[0]->cnt;
        if($newnotif>0){
            
            $divcnt_notif.='<span class="badge badge-pill badge-sm badge-danger badge-default badge-up badge-glow">'.$newnotif.'</span>';
        }

        $div_notif='';
        $sql ="SELECT * from mgr.sysnotification where entity_cd='$entity' and project_no='$project' and email_addr ='$user_email' order by notificationdate desc";        
        $dtnotif = $this->m_wsbangun->getData_by_queryadm($sql);
        // $dtnotif = null;
        if(!empty($dtnotif)){
            foreach ($dtnotif as $key) {
                if($key->NotificationCd =='NEW'){
                    $classcolors = 'info';
                    $icon = 'ft-tag';
                    $notifdescs='New Ticket';
                } else if($key->NotificationCd =='ASSIGN'){
                    $classcolors = 'danger';
                    $icon = 'ft-user-plus';
                    $notifdescs='New Assigned Ticket';
                }else if($key->NotificationCd =='APPROVAL'){
                    $classcolors = 'warning';
                    $icon = 'ft-user-check';
                    $notifdescs='New Approval';
                }else if($key->NotificationCd =='CONFIRM'){
                    $classcolors = 'secondary';
                    $icon = 'ft-save';
                    $notifdescs='New Confirmed Ticket';
                }else if($key->NotificationCd =='MODIFY'){
                    $classcolors = 'primary';
                    $icon = 'ft-save';
                    $notifdescs='New Modified Ticket';
                }else if($key->NotificationCd =='PROCESS'){
                    $classcolors = 'success';
                    $icon = 'ft-clock';
                    $notifdescs='Ticket is Being Processed';
                } else {
                    $icon = 'ft-loader';
                    $classcolors = 'dark';
                    $notifdescs='Undefined'; 
                }

                if(!$key->IsRead){
                    $div_notif.='<div style="background-color: #fffbea">';
                }else {
                    $div_notif.='<div style="background-color: #fff">';
                }
                  
                  $div_notif.='<div class="media">';
                  $div_notif.='  <div class="media-left align-self-center"><i class="'.$icon.' '.$classcolors.' font-medium-4 mt-2"></i></div>';
                  $div_notif.='  <div class="media-body">';
                  $div_notif.='    <small class="pull-right">'.$this->time_elapsed_string($key->NotificationDate).'</small>';
                  $div_notif.='    <h6 class="media-heading '.$classcolors.'">'.$notifdescs.'</h6>';
                  $div_notif.='   <p class="notification-text font-small-3 text-muted text-bold-600">'.$key->Remarks.'</p><small>';
                  $div_notif.='      <time class="media-meta text-muted">at '.date('g:i a',strtotime($key->NotificationDate)).' - '.date('j F Y',strtotime($key->NotificationDate)).'</time></small>';
                  $div_notif.='  </div>';
                  $div_notif.='</div>';
                  $div_notif.='  </div>';         
            }
            
        } else {
            $div_notif.='<p style="padding-left: 15px;padding-top: 10px;">No Notification Available.</p>';
        }
        $content = array(//'cntnotif' => $divcnt_notif,
                        'divnotif'=>$div_notif );
        $this->load->view('dash_cs/unseen_notif',$content);
    }
    
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
   
}
