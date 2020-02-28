<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dash_Nup extends Core_controller
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
        $entity = $this->session->userdata('Tsentity');
        $project_sess = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $userID = $this->session->userdata('Tsname');
        $entityname = $this->session->userdata('Tsentityname');
        $usergroup = $this->session->userdata('Tsusergroup');
        $sys = $this->session->userdata('Tsysadmin');
        $cl = $this->session->userdata('FCloud');
        $cons = $this->session->userdata('Tscons');
        
        // var_dump($cl);
        $project=$project_sess;
        if(empty($project_sess)){
            $sqlquery="SELECT min(project_no) as project_no, min(entity_cd) as entity_cd from mgr.pl_project "; 
            $dt = $this->m_wsbangun->getData_by_query_cons($cons,$sqlquery);
            $project =  $dt[0]->project_no;
            $entity = $dt[0]->entity_cd;
        }

        if($project !=''){
            $this->load->database();
            $DB2 = $this->load->database('ifca3', TRUE);
            // $sqlquery ="select * from mgr.cfs_user_project (nolock) where userid ='$name' and project_no='$project' ";  
            $sqlquery="SELECT entity_cd = max(entity_cd) from mgr.pl_project with(nolock) WHERE project_no=? ";        
            // var_dump($sqlquery);
            // $tes = $this->m_wsbangun->getData_by_query($sqlquery);
            $where = array($project);
            $qq = $DB2->query($sqlquery, $where);     
            $tes = $qq->result();            
            // var_dump($tes);
            if(!empty($tes)){
                $tess = $tes[0]->entity_cd;
                $entity = $tess;
            }                        
        }else{
            $project = $project_sess;
        }

        // else{
        //     $entity = $this->session->userdata('Tsentity');
        // }
        // var_dump($entity);

        $param="";
        if(!empty($project)){
            if($project !='null'){
            $param = " where project_no='".$project."' AND entity_cd='".$entity."'";
            }
        }else{
                $project=$project_sess;
            }

        // var_dump($param);exit();
           
        $approver = 0;
        if($usergroup){

            $sql = "SELECT * FROM mgr.v_nup_chart_unit_approve $param";
            $dt1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            // var_dump($sql);exit();
            $jscript = '';
            if(!empty($dt1)) {
                $bgland ='';
                $bgapart = '';
                $bgColor = '"#80d82d","#2fb4ed","#80d82d","#2fb4ed"';
                $jscript.='var barData={labels:[';
                $jlabel1 = ''; $jdataapt='';
                $jlabel = ''; $jdataland=''; $a='';
                foreach ($dt1 as $key =>$row) {
                    if ($row->type=="G") {
                        $a = "Golden";
                    } else {
                        $a = "Platinum";
                    }
                    $jlabel .= '"'.$a.'",';
                    $bgland .='"#2fb4ed",';
                    $bgapart .= '"#80d82d",';

                    $jdataland  .= $row->qty_landed.",";
                    $jdataapt  .= $row->qty_apartment.",";
                }
                $jlabel = substr($jlabel, 0, -1);
                $jdataapt  = substr($jdataapt, 0, -1);
                $jscript.=$jlabel.'],datasets:[{label:"Landed",data:['.$jdataland.'],backgroundColor:['.$bgland.']},{label:"Apartement" ,data:['.$jdataapt.'],backgroundColor:['.$bgapart.']}]};';
                $jscript.='var barOptions = {responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true},tickDecimals: 0}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript.='var ctx=document.getElementById("barApprove").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';
            }

            $sql2 = "SELECT * from mgr.v_nup_chart_unit_unapprove $param";
            $dt2 = $this->m_wsbangun->getData_by_query_cons($cons,$sql2);
            $jscript2 = '';
            if(!empty($dt2)) {
                //$jscript2.='var barData={labels:["Total"],datasets:[';
                $bgColor = '"#2fb4ed","#80d82d","#2fb4ed"';
                $jscript2.='var barData={labels:[';
                $jlabel2 = ''; 
                $jdata2 = ''; $jdata21='';
                $bgland='';$bgapart='';
                foreach ($dt2 as $key =>$row) {
                    if ($row->type=="G") {
                        $a = "Golden";
                    } else {
                        $a = "Platinum";
                    }
                    $jlabel2.='"'.$a.'",';
                    $jdata21.= $row->qty_landed.",";
                    $jdata2.= $row->qty_apartment.",";
                    $bgland .='"#2fb4ed",';
                    $bgapart .= '"#80d82d",';
                   
                }

                 $jlabel2 = substr($jlabel2,0,-1);
                 $jdata2 = substr($jdata2,0,-1);
                 $jscript2.=$jlabel2.'], datasets:[{label: "Landed",data:['.$jdata21.'],backgroundColor:['.$bgland.']},{label:"Apartement" ,data:['.$jdata2.'],backgroundColor:['.$bgapart.']}]};';
                //$jscript2=substr($jscript2,0,-1);
                $jscript2.='var barOptions = {responsive: true, legend: {display: true},scales: {yAxes:  [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript2.='var ctx=document.getElementById("barNonApprove").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';
            }

            $sql = "SELECT * from mgr.v_nup_group_city $param order by city ASC";
            $dt3 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript3 = '';
            if(!empty($dt3)) {
                $bgland = '';
                $bgapart = '';
                // $bgland ='"#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed"';
                // $bgapart = '"#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d"';
                
                $jscript3.='var barData={labels:[';
                $jlabel3 = ''; $jdata3=''; 
                $jdata31 ='';
                foreach ($dt3 as $key =>$row) {
                    $jlabel3 .= '"'.$row->city.'",';
                    $bgland .='"#2fb4ed",';
                    $bgapart .= '"#80d82d",';
                    $jdata31  .= $row->qty_landed.",";
                    $jdata3  .= $row->qty_apartment.",";

                }
                
                $jlabel3 = substr($jlabel3, 0, -1);
                $jdata3  = substr($jdata3, 0, -1);
                $bgland  = substr($bgland, 0, -1);
                $bgapart  = substr($bgapart, 0, -1);
                // $jscript3.=$jlabel3.'],datasets:[{label:"Landed" ,data:['.$jdata31.'],backgroundColor:['.$bgland.']},{label:"Apartemen" ,data:['.$jdata3.'],backgroundColor:['.$bgapart.']}]};';
                // //$jscript3=substr($jscript3,0,-1);
                // $jscript3.='var barOptions = {maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:false}}]}};';
                // $jscript3.='var ctx=document.getElementById("barProvince").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


                $jscript3.=$jlabel3.'],datasets:[{label:"Landed" ,data:['.$jdata31.'],backgroundColor:['.$bgland.']},{label:"Apartemen" ,data:['.$jdata3.'],backgroundColor:['.$bgapart.']}]};';
                //$jscript3=substr($jscript3,0,-1);
                $jscript3.='var barOptions = {maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true},tickDecimals: 0}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript3.='var ctx=document.getElementById("barProvince").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
             $jsp = "Chart.pluginService.register({afterDraw:function(chart,easing){if(chart.config.options.showPercentage||chart.config.options.showLabel){var self=chart.config;var ctx=chart.chart.ctx;ctx.font='12px Arial';ctx.textAlign='center';ctx.fillStyle='#fff';self.data.datasets.forEach(function(dataset,datasetIndex){var total=0,labelxy=[],offset=Math.PI/2,radius,centerx,centery,lastend=0;for(var val of dataset.data){total+=val}
var i=0;var meta=dataset._meta[i];while(!meta){i++;meta=dataset._meta[i]}
var element;for(index=0;index<meta.data.length;index++){element=meta.data[index];radius=0.9*element._view.outerRadius-element._view.innerRadius;centerx=element._model.x;centery=element._model.y;var thispart=dataset.data[index],arcsector=Math.PI*(2*thispart/total);if(element.hasValue()&&dataset.data[index]>0){labelxy.push(lastend+arcsector/2+Math.PI+offset)}
else{labelxy.push(-1)} lastend+=arcsector}
var lradius=radius*2/4;for(var idx in labelxy){if(labelxy[idx]===-1)continue;var langle=labelxy[idx],dx=centerx+lradius*Math.cos(langle),dy=centery+lradius*Math.sin(langle),val=Math.round(dataset.data[idx]/total*100);if(chart.config.options.showPercentage)
ctx.fillText(val+'%',dx,dy);else ctx.fillText(chart.config.data.labels[idx],dx,dy)}
ctx.restore()})}}});";

            $sql = "SELECT * from mgr.v_nup_group_agent_type $param";
            $dt4 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            // var_dump($dt4);exit();
            $jscript4 = '';
            if(!empty($dt4)) {
               
                $bgColor = '"#2fb4ed","#80d82d","#d7f442","#b5b8cf"';
                $jscript4.='var pieData={labels:[';
                $jlabel4 = '';
                
                $jdata= '';
                $jcolor= '';
                $jjum='';
                foreach ($dt4 as $key => $row) {
                    $jlabel4.='"'.$row->agentype_descs.'",';
                    $persen = ($row->qty / $row->total) * 100;
                    $persen = number_format($persen);
                    $jdata.=$persen.',';  
                }
                    
                $jlabel4 = substr($jlabel4,0,-1);
                
                $jcolor=substr($jcolor,0,-1);
                $jdata=substr($jdata,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript4.=$jlabel4.'],datasets:[{label:"A",data:['.$jdata.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript4.='var pieOption={legend:{onClick: null}, responsive: true, tooltips: {enabled: false}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript4.='var ctx=document.getElementById("inhouseChart").getContext("2d");';
                // $jscript4.='ctx.fillStyle="white";';
                $jscript4.='new Chart(ctx,{type: "pie", data: pieData, options:pieOption});';
   
                
                }
        
            

            $sql = "SELECT * from mgr.v_nup_group_leadbatam $param";
            $dt5 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript5 = '';
            // var_dump($jscript5);exit();
            if(!empty($dt5)) {
                $bgland ='';
                $bgapart = '';
                
                $jscript5.='var barData={labels:[';
                $jlabel5 = ''; $jdata5=''; $jdatalandplat=''; $jdatalandgold=''; $jdataapartplat=''; $jdataapartgold='';
                $jdata51 =''; $jlabel51 = '';
                foreach ($dt5 as $key =>$row) {
                    $jlabel5 .= '"'.$row->lead_name.'",';
                    $bgland .='"#2fb4ed",';
                    $bgapart .= '"#80d82d",';
                    
                    $jdata51  .= $row->qty_landed.",";
                    $jdata5  .= $row->qty_apartment.",";
                    $jdatalandplat .= $row->qty_landed_platinum.",";
                    $jdatalandgold .= $row->qty_landed_golden.",";
                    $jdataapartplat .= $row->qty_apartment_platinum.",";
                    $jdataapartgold .= $row->qty_apartment_golden.",";

                }
                $jlabel5 = substr($jlabel5, 0, -1);
                $jdata5  = substr($jdata5, 0, -1);
                $jdata51  = substr($jdata51, 0, -1);
                $jdatalandplat  = substr($jdatalandplat, 0, -1);
                $jdatalandgold  = substr($jdatalandgold, 0, -1);
                $jdataapartplat  = substr($jdataapartplat, 0, -1);
                $jdataapartgold  = substr($jdataapartgold, 0, -1);

                $jscript5.=$jlabel5.'],datasets:[{label:"Landed",data:['.$jdata51.'],plat:['.$jdatalandplat.'],gold:['.$jdatalandgold.'],backgroundColor:['.$bgland.']},{label:"Apartemen" ,data:['.$jdata5.'],plat:['.$jdataapartplat.'],gold:['.$jdataapartgold.'],backgroundColor:['.$bgapart.']}]};';
                $jscript5.='var barOptions = {maintainAspectRatio: false,responsive: true, legend: {display: true},tooltips : {callbacks : {label : function(tooltipItem, data) {return data.datasets[tooltipItem.datasetIndex].label + ": " + tooltipItem.yLabel + ", Golden : "+ data.datasets[tooltipItem.datasetIndex].gold[tooltipItem.index]+ ", Platinum : "+ data.datasets[tooltipItem.datasetIndex].plat[tooltipItem.index];}}},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript5.='var ctx=document.getElementById("barBatam").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';
            }

            $sql = "SELECT * from mgr.v_nup_amt_group_agent_type $param";
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt6 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript6 = '';
            if(!empty($dt6)) {
                
                $bgColor = '"#2fb4ed","#80d82d","#d7f442","#b5b8cf"';
                $jscript6.='var pieData={labels:[';
                $jlabel6 = '';
                
                $jdata6= '';
                $jcolor= '';
                $jjum6='';
                foreach ($dt6 as $key => $row) {
                    $jlabel6.='"'.$row->agentype_descs.'",';
                    $persen = ($row->nup_amt / $row->total) * 100; 
                    $persen = number_format($persen, 2);
                    $jdata6.=$persen.',';  
                }
                    
                $jlabel6 = substr($jlabel6,0,-1);
                
                $jcolor=substr($jcolor,0,-1);
                $jdata6=substr($jdata6,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript6.=$jlabel6.'],datasets:[{label: "Total" ,data:['.$jdata6.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript6.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {enabled: false}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript6.='var ctx=document.getElementById("amtchart").getContext("2d");';
                // $jscript6.='ctx.fillStyle="Black";';
                // $jscript6.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript6.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_nup_group_nationality $param order by nationality ASC";
            $dt7 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript7 = '';
            if(!empty($dt7)) {
                $bgland = '';
                $bgapart = '';
                // $bgland ='"#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed","#2fb4ed"';
                // $bgapart = '"#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d","#80d82d"';
                
                $jscript7.='var barData={labels:[';
                $jlabel7 = ''; $jdata7=''; 
                $jdata71 ='';
                foreach ($dt7 as $key =>$row) {
                    $jlabel7 .= '"'.$row->nationality.'",';
                    $bgland .='"#2fb4ed",';
                    $bgapart .= '"#80d82d",';
                    $jdata71  .= $row->qty_landed.",";
                    $jdata7  .= $row->qty_apartment.",";

                }
                
                $jlabel7 = substr($jlabel7, 0, -1);
                $jdata7  = substr($jdata7, 0, -1);
                $bgland  = substr($bgland, 0, -1);
                $bgapart  = substr($bgapart, 0, -1);
                $jscript7.=$jlabel7.'],datasets:[{label:"Landed" ,data:['.$jdata71.'],backgroundColor:['.$bgland.']},{label:"Apartemen" ,data:['.$jdata7.'],backgroundColor:['.$bgapart.']}]};';
                //$jscript3=substr($jscript3,0,-1);
                $jscript7.='var barOptions = {maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript7.='var ctx=document.getElementById("barNationality").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';
            }


            // var_dump($jscript7);exit();
            $content = array('jsp'=>$jsp,
                             'js'=>$jscript,
                                'js2'=>$jscript2,
                                'js3'=>$jscript3,
                                'js4'=>$jscript4,
                                'js5'=>$jscript5,
                                'js6'=>$jscript6,
                                'js7'=>$jscript7,
                                // 'js8'=>$jscript8,
                                // 'js9'=>$jscript9,
                                // 'js10'=>$jscript10,
                                // 'js11'=>$jscript11,
                                'data_project'=>$this->project_list($project)
                                );
            $this->load_content_top_menu('dash_nup/grafiknove',$content);
            return;
        }

        
        $tabel2 = 'v_cfs_login_user';
        $kriteria2 = array(
            // 'entity_cd'=>$entity,
            'userid'=>$userID);
        // var_dump($name);
        // exit();
        $datalist2 = $this->m_wsbangun->getData_by_criteria($tabel2, $kriteria2);
        $cntdatalist2 =count($datalist2);
        // var_dump($userID);exit();
        // var_dump(readdir(opendir('img/PlProject/')));
        $ListAllData='';
        if($cntdatalist2 > 1){
            if(!empty($datalist2)){
            foreach ($datalist2 as $value) {
                $pict = $value->picture_path;
                // var_dump($pict);
                $ListAllData .='<div class="col-sm-3">';
                $ListAllData .='<div class="ibox">';
                $ListAllData .='<div class="ibox-content product-box" style="border-left-width: 0px; border-right-width: 0px; border-top-width: 0px; border-radius: 0px; position: relative;">';
                $ListAllData .='<div class="caption">';

                // var_dump($value->picture_path);
                // var_dump( file_exists(base_url('img/PlProject/'.$value->picture_path)));
                if(!empty($value->picture_path) && file_exists('img/PlProject/'.$value->picture_path)){
                    // if (file_exists(base_url('img/PlProject/'.$value->picture_path))) {
                        // $a = 'ada';
                        $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/'.$value->picture_path).'" style="width: 100%; height: 190px; padding:0px; border-radius: 0px; position: relative;" class="thumbnail" ></center></a>';
                    // }
                    // else{
                        // $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/blankproject.png').'" style="width: 100%; height: 190px; padding:0px; border-radius: 0px;" class="thumbnail" ></center></a>';
                    // }                    
                }else{
                    // $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/'.$value->picture_path).'" style="width: 100%; height: 190px; padding:0px; border-radius: 0px; position: relative;" class="thumbnail" ></center></a>';
                    $a = '<a href="'.base_url('newsfeed/index/'.base64_encode($value->project_no.'-'.$value->descs)).'"><center><img src="'.base_url('img/PlProject/blankproject.png').'" style="width: 100%; height: 190px; padding:0px; border-radius: 0px;" class="thumbnail" ></center></a>';
                    // $a = 'ga ada';
                }

        
                $ListAllData .=$a;
                $ListAllData .='</div>';
                $ListAllData .='<div class="product-desc" style="padding: 3px;">'; 
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
        $this->load_content_top_menu('dash_nup/index', $ContentAllData);
        return;
        }
        else
        {
            $this->session->set_userdata('Tsentity', trim($datalist2[0]->entity_cd));
            $this->session->set_userdata('Tsproject', trim($datalist2[0]->project_no));
                                            // $this->session->set_userdata('Tsysadmin', $datas[0]->system_admin);// gak kepake
            $this->session->set_userdata('Tsentityname', $datalist2[0]->entity_name);
        }
        
          redirect('/newsfeed/index/'.base64_encode($datalist2[0]->project_no.'-'.$datalist2[0]->descs));
        // $this->load->view('dash_nup/index', $ContentAllData);

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
    public function call()
    {
        $paramSrc = $this->uri->segment(3);
        $param = base64_decode($paramSrc);
        
        if(empty($param)) {
            $entity = $this->session->userdata('Tsentity');            
            $entityname = $this->session->userdata('Tsentityname');
        } else {
            $entity = substr($param, 0,4);            
            $entityname = str_replace('%20', ' ', substr($param, 5));
            $this->session->set_userdata('Tsentity', $entity);
            $this->session->set_userdata('Tsentityname', $entityname);
        }
        
        $name = $this->session->userdata('Tsuname');
        $sys = $this->session->userdata('Tsysadmin');
        $approver = 0;

        $tabel2 = 'v_cfs_user_project';
        $kriteria2 = array(
            // 'entity_cd'=>$entity,
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
            'entityname'=>$entityname);
        $this->load_content('dash/index', $ContentAllData, true);
    }
    
    public function indexold()
    {
        $entity = $this->session->userdata('Tsentity');
        $project = $this->session->userdata('Tsproject');
        $webuser = $this->session->userdata('Tsuname');
        // $webuser = 'ARIE';
        $goto = $this->uri->segment(3);
        $offset = $this->uri->segment(4);
        // billing
        $startBill = $offset;
        $pageset = 10;
        $debtor = '0101';
        $cnBilling = $this->m_dash->getBillingCount($debtor);
        // var_dump($cnBilling);
        $pgBilling = create_paging($this, $pageset, 4, $offset, base_url('dash_nup/index/billing/'), $cnBilling);
        $dtBilling = $this->m_dash->getBillingList($offset, $pageset, $debtor);
        $lsBilling = '';
        if(!empty($dtBilling))
        {
            foreach ($dtBilling as $key => $billing) {
                $lsBilling.='<tr role="row" class="odd">';
                $lsBilling.='<td>'.$billing->doc_no.'</td>';
                $lsBilling.='<td>'.date("d M Y", strtotime($billing->doc_date)).'</td>';
                $lsBilling.='<td>'.date("d M Y", strtotime($billing->due_date)).'</td>';
                $lsBilling.='<td>'.$billing->ar_ldg_desc.'</td>';
                $lsBilling.='<td>'.date("d M Y", strtotime($billing->start_date)).' - '.date("d M Y", strtotime($billing->end_date)).'</td>';
                $lsBilling.='<td>'.$billing->currency_cd.'</td>';
                $lsBilling.='<td align="right">'.number_format($billing->fbal_amt,2,",",".").'</td>';
                $lsBilling.='</tr>';
                switch ($billing->currency_cd) {
                    case 'RP':
                    $sumBilling['RP'] += $billing->fbal_amt;
                    break;
                    case 'USD':
                    $sumBilling['USD'] += $billing->fbal_amt;
                    break;
                }
            }
            if($sumBilling['RP']!=0) {
                $lsBilling .= '<tr><td colspan="5" align="right"><b>Total</b></td><td><b><span class="text-lightlime">RP</span></b></td><td align="right"><b><span class="text-lightlime">'.number_format($sumBilling['RP'],2,",",".").'</span></b></td></tr>';
            }
            if($sumBilling['USD']!=0) {
                $lsBilling .= '<tr><td colspan="6" align="right"></td><td><b><span class="text-lightlime">USD</span></b></td><td align="right"><b><span class="text-lightlime">'.number_format($sumBilling['USD'],2,",",".").'</span></b></td></tr>';
            }
        }
        // ticket
        $cnTicket = $this->m_dash->getTicketCount();
        // var_dump($cnTicket);
        $pgTicket = create_paging($this, $pageset, 4, $offset, base_url('dash_nup/index/ticket/'), $cnTicket);
        // var_dump($pgTicket);
        $dtTicket = $this->m_dash->getTicketList($offset, $pageset);
        $lsTicket = '';
        if(!empty($dtTicket))
        {
            foreach ($dtTicket as $key => $ticket) {
                $lsTicket.='<tr role="row" class="odd">';
                $lsTicket.='<td>'.$ticket->complain_no.'</td>';
                $lsTicket.='<td>'.$ticket->cat_desc.'</td>';
                $lsTicket.='<td>'.$ticket->work_requested.'</td>';
                $lsTicket.='<td>'.date("d M Y", strtotime($ticket->reported_date)).'</td>';
                $lsTicket.='<td>'.$ticket->serv_req_by.'</td>';
                $lsTicket.='<td>'.$ticket->lot_no.'</td>';
                $dtStatus = get_statusIFCA($ticket->status);
                $lsTicket.='<td><span class="label label-'.$dtStatus["label"].'">'. $dtStatus["status"]. '</span></td>';
                $lsTicket.='</tr>';
            }
        }
        // newsfeed
        $nFeed = 3;
        $dtNews = $this->m_dash->getNewsList($offset, $nFeed);
        $lsNews = '';
        if(!empty($dtNews))
        {
            $lsNews.='<div id="carousel-generic" class="carousel slide" data-ride="carousel">';
            $lsNews.='<div class="carousel-inner" role="listbox">';
            foreach ($dtNews as $key => $news) {
                $lsNews.=($key > 0 ? '<div class="item">' : '<div class="item active">');
                $lsNews.='<div class="transbox"><div class="text-white text-group">';
                $lsNews.='<span class="text-title text-yellow">'.$news->subject.'</span>';
                if(strlen($news->content)>100) {
                    $lsNews.='<p class="text-yellow">'.limitWord($news->content,20).'</p>';
                } else {
                    $lsNews.='<p class="text-yellow">'.$news->content.'</p>';
                }
                $lsNews.='</div></div>';
                $lsNews.=(substr($news->picture,0,4)=='http' ? '<img class="img-dash" src="'.$news->picture.'" alt="pic'.$key.'">' : '<img class="img-dash" src="'.base_url('uploads/'.$news->picture).'" alt="pic'.$key.'">');
                $lsNews.='</div>';
            }
            $lsNews.='</div>';
            $lsNews.='<a class="left carousel-control" href="#carousel-generic" role="button" data-slide="prev">';
            $lsNews.='<span class="glyphicon glyphicon-chevron-left sign-bottom" aria-hidden="true"></span><span class="sr-only">Previous</span></a>';
            $lsNews.='<a class="right carousel-control" href="#carousel-generic" role="button" data-slide="next">';
            $lsNews.='<span class="glyphicon glyphicon-chevron-right sign-bottom" aria-hidden="true"></span><span class="sr-only">Next</span></a>';
            $lsNews.='</div>';
        }

        // display
        $allList = array('appList'=>$lsTicket,
            'appPage'=>$pgTicket,
            'hotList'=>$lsBilling,
            'newsList'=>$lsNews
            );
        $this->load_content('dash_nup/index',$allList);
    }

    public function ambildata(){
        $cons = $this->session->userdata('Tscons');
        $data = $this->m_wsbangun->getData_cons($cons,'v_nup_group_leadbatam');

        echo json_encode($data);
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
            $dtApv = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit, null, $ord);
            $table = 'rl_sales';
            $crit = array('ref_no'=>$doc_no);
            $dtSale = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
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
                $dtUser = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
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
                        $dtAcct = $this->m_wsbangun->getData_by_criteria_cons($cons,$table, $crit);
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