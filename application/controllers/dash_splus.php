<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class dash_splus extends Core_Controller
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
        

        $sql ="SELECT count(distinct email) as active_users from mgr.sysUser(nolock) where status_activate='Y' ";            
        $dt_user = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        if(!empty($dt_user)){
            $active_users = $dt_user[0]->active_users;
        }else{
            $active_users = 0;
        }
        $sql ="SELECT * from mgr.v_user_by_device ";            
        $dtdevice = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $graphdevice='';
        if(!empty($dtdevice)){
            $labeldevice='';$jdatadevice='';$jseriesdevice='';
           
             foreach ($dtdevice as $key => $row) {
                $labeldevice .= '"'.$row->Device.'",';
                $jdatadevice.= $row->total.',';
                $jseriesdevice.= '{meta:"'.$row->Device.':", value:'.$row->total.'},';
            }
            $graphdevice.='var alldata = ['.$jdatadevice.'];';
            $graphdevice.='var data = {';   
            $graphdevice.='    labels: ['.$jdatadevice.'],';        
            $graphdevice.='    series: ['.$jseriesdevice.']';
            $graphdevice.='};';

            $graphdevice.='var sum = function(a, b) { return a + b };';

            $graphdevice.='var graphdevice = new Chartist.Pie("#graphdevice", data, {';
            $graphdevice.='  labelInterpolationFnc: function(value,idx) {';
            $graphdevice.='    return Math.round(value / alldata.reduce(sum) * 100) + "%";';
            $graphdevice.='  },';
            $graphdevice.='        plugins: [';
            $graphdevice.='           Chartist.plugins.tooltip({';
            $graphdevice.='                appendToBody: true';
            $graphdevice.='            })';
            $graphdevice.='        ]';
            $graphdevice.='});';

        }else{
            $graphdevice.='var alldata = [0];';
            $graphdevice.='var data = {';   
            $graphdevice.='    labels: [0],';        
            $graphdevice.='    series: [{meta:"No Data Available",value:0}]';
            $graphdevice.='};';

            $graphdevice.='var sum = function(a, b) { return a + b };';

            $graphdevice.='var graphdevice = new Chartist.Pie("#graphdevice", data, {';
            $graphdevice.='  labelInterpolationFnc: function(value,idx) {';
            $graphdevice.='    return Math.round(value / alldata.reduce(sum) * 100) + "%";';
            $graphdevice.='  },';
            $graphdevice.='        plugins: [';
            $graphdevice.='           Chartist.plugins.tooltip({';
            $graphdevice.='                appendToBody: true';
            $graphdevice.='            })';
            $graphdevice.='        ]';
            $graphdevice.='});';
        }
            

        $sql ="SELECT * from mgr.v_user_by_group ";            
        $dtpertype = $this->m_wsbangun->getData_by_query_cons('ifca3',$sql);
        $graphgroup='';
        if(!empty($dtpertype)){
            $labelgroup='';$jdatagroup='';
            foreach ($dtpertype as $key => $row) {
                $labelgroup .= '"'.$row->Group_Cd.'",';
                $jdatagroup.= $row->total.',';
            }
            
  
           
            $graphgroup.='var graphgroup = new Chartist.Bar("#graphgroup", {';
            $graphgroup.='    labels: ['.$labelgroup.'],';
            $graphgroup.='   series: [';
            $graphgroup.='        ['.$jdatagroup.']';
            // $graphgroup.='        [8000, 12000],[9000, 5000]';
            $graphgroup.='    ]';
            $graphgroup.='}, {';
            $graphgroup.='        axisY: {';
            $graphgroup.='            labelInterpolationFnc: function (value) {';
            $graphgroup.='                return value ;';
            $graphgroup.='            },';
            $graphgroup.='            scaleMinSpace: 50,';
            $graphgroup.='        },';
            $graphgroup.='       axisX: {';
            $graphgroup.='            showGrid: false';
            $graphgroup.='        },';
            $graphgroup.='        plugins: [';
            $graphgroup.='           Chartist.plugins.tooltip({';
            $graphgroup.='                appendToBody: true';
            $graphgroup.='            })';
            $graphgroup.='        ]';
            $graphgroup.='    });';
            $graphgroup.='graphgroup.on("draw", function (data) {';
            $graphgroup.='    if (data.type === "bar") {';
            $graphgroup.='        data.element.attr({';
            $graphgroup.='            style: "stroke-width: 30px",';
            $graphgroup.='            y1: 350,';
            $graphgroup.='            x1: data.x1 + 0.001';
            $graphgroup.='        });';
            $graphgroup.='        data.group.append(new Chartist.Svg("circle", {';
            $graphgroup.='            cx: data.x2,';
            $graphgroup.='            cy: data.y2,';
            $graphgroup.='            r: 15';
            $graphgroup.='        }, "ct-slice-pie"));';
            $graphgroup.='    }';
            $graphgroup.='});';
            $graphgroup.='graphgroup.on("created", function (data) {';
            $graphgroup.='        var defs = data.svg.querySelector("defs") || data.svg.elem("defs");';
            $graphgroup.='        defs.elem("linearGradient", {';
            $graphgroup.='            id: "bar1",';
            $graphgroup.='            x1: 0,';
            $graphgroup.='            y1: 0,';
            $graphgroup.='            x2: 0,';
            $graphgroup.='            y2: 1';
            $graphgroup.='        }).elem("stop", {';
            $graphgroup.='            offset: 0,';
            $graphgroup.='            "stop-color": "rgba(132, 60, 247,1)"';
            $graphgroup.='        }).parent().elem("stop", {';
            $graphgroup.='            offset: 1,';
            $graphgroup.='            "stop-color": "rgba(56, 184, 242, 1)"';
            $graphgroup.='        });';
            $graphgroup.='        defs.elem("linearGradient", {';
            $graphgroup.='            id: "bartype2",';
            $graphgroup.='            x1: 0,';
            $graphgroup.='            y1: 0,';
            $graphgroup.='            x2: 0,';
            $graphgroup.='            y2: 1';
            $graphgroup.='        }).elem("stop", {';
            $graphgroup.='            offset: 0,';
            $graphgroup.='            "stop-color": "#f6adb1"';
            $graphgroup.='        }).parent().elem("stop", {';
            $graphgroup.='            offset: 1,';
            $graphgroup.='            "stop-color": "#f75e3b"';
            $graphgroup.='        });';
            $graphgroup.='        return defs;';
            $graphgroup.='    });';

        } else {
            $graphgroup.='var graphgroup = new Chartist.Bar("#graphgroup", {';
            $graphgroup.='    labels: ["No Data Available"],';
            $graphgroup.='   series: [';
            $graphgroup.='        [0]';
            // $graphgroup.='        [8000, 12000],[9000, 5000]';
            $graphgroup.='    ]';
            $graphgroup.='}, {';
            $graphgroup.='        axisY: {';
            $graphgroup.='            labelInterpolationFnc: function (value) {';
            $graphgroup.='                return value ;';
            $graphgroup.='            },';
            $graphgroup.='            scaleMinSpace: 50,';
            $graphgroup.='        },';
            $graphgroup.='       axisX: {';
            $graphgroup.='            showGrid: false';
            $graphgroup.='        },';
            $graphgroup.='        plugins: [';
            $graphgroup.='           Chartist.plugins.tooltip({';
            $graphgroup.='                appendToBody: true';
            $graphgroup.='            })';
            $graphgroup.='        ]';
            $graphgroup.='    });';
        }

        $content = array(
            'jsgroup'=>$graphgroup,
            'jsdevice'=>$graphdevice,
            'active_users'=>$active_users,
            'projectNamee'=>$projectName,
            'project_no'=>$project_no
        
            );
        // var_dump($projectName);exit();
        $this->load_content_top_menu('dash_splus/index', $content);

    }

   
}
