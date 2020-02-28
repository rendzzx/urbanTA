<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dash_sales extends Core_controller
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
 
    public function index($project='')
    {
        // $entity = '';
        $entity = $this->session->userdata('Tsentity');
        $project_sess = $this->session->userdata('Tsproject');
        $name = $this->session->userdata('Tsuname');
        $entityname = $this->session->userdata('Tsentityname');
        $usergroup = $this->session->userdata('Tsusergroup');
        $sys = $this->session->userdata('Tsysadmin');
        $cons = $this->session->userdata('Tscons');
        if(empty($project_sess)){
            $sqlquery="SELECT min(project_no) as project_no, min(entity_cd) as entity_cd from mgr.pl_project "; 
            $dt = $this->m_wsbangun->getData_by_query_cons($cons,$sqlquery);
            $project =  $dt[0]->project_no;
            $entity = $dt[0]->entity_cd;
        }
// var_dump($project_sess);
        if($project !=''){
            // $sqlquery ="select * from mgr.cfs_user_project (nolock) where userid ='$name' and project_no='$project' ";  
            $sqlquery="SELECT entity_cd = max(entity_cd) from mgr.pl_project (nolock) where project_no = '$project' ";        
            // var_dump($sqlquery);
            $tes = $this->m_wsbangun->getData_by_query_cons($cons,$sqlquery);            
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
        $param2="";
        if(!empty($project)){
            if($project !='null'){
            $param2 = " AND project_no='".$project."' AND entity_cd='".$entity."'";
            }
        }else{
                $project=$project_sess;
            }



        $approver = 0;
        if($usergroup){
             $jsp = "Chart.pluginService.register({afterDraw:function(chart,easing){if(chart.config.options.showPercentage||chart.config.options.showLabel){var self=chart.config;var ctx=chart.chart.ctx;ctx.font='11px Arial';ctx.textAlign='center';ctx.fillStyle='#fff';self.data.datasets.forEach(function(dataset,datasetIndex){var total=0,labelxy=[],offset=Math.PI/2,radius,centerx,centery,lastend=0;for(var val of dataset.data){total+=val}
                var i=0;var meta=dataset._meta[i];while(!meta){i++;meta=dataset._meta[i]}
                var element;for(index=0;index<meta.data.length;index++){element=meta.data[index];radius=0.9*element._view.outerRadius-element._view.innerRadius;centerx=element._model.x;centery=element._model.y;var thispart=dataset.data[index],arcsector=Math.PI*(2*thispart/total);if(element.hasValue()&&dataset.data[index]>0){labelxy.push(lastend+arcsector/2+Math.PI+offset)}
                else{labelxy.push(-1)} lastend+=arcsector}
                    var lradius=radius*2/4;for(var idx in labelxy){if(labelxy[idx]===-1)continue;var langle=labelxy[idx],dx=centerx+lradius*Math.cos(langle),dy=centery+lradius*Math.sin(langle),val=Math.round(dataset.data[idx]/total*100);if(chart.config.options.showPercentage)
                        ctx.fillText(val+'%',dx,dy);else ctx.fillText(chart.config.data.labels[idx],dx,dy)}
                        ctx.restore()})}}});";
                $jsp2="Chart.pluginService.register({beforeRender: function (chart) {if (chart.config.options.showAllTooltips) {
                    chart.pluginTooltips = [];chart.config.data.datasets.forEach(function (dataset, i) {

                        chart.getDatasetMeta(i).data.forEach(function (sector, j) {
                            chart.pluginTooltips.push(new Chart.Tooltip({
                                _chart: chart.chart,
                                _chartInstance: chart,
                                _data: chart.data,
                                _options: chart.options,
                                _active: [sector]
                            }, chart));});});chart.options.tooltips.enabled = false;}},afterDraw: function (chart, easing) {if (chart.config.options.showAllTooltips) { if (!chart.allTooltipsOnce) {if (easing !== 1)return;
                        chart.allTooltipsOnce = true;}chart.options.tooltips.enabled = true;
                    Chart.helpers.each(chart.pluginTooltips, function (tooltip) {
                        tooltip.initialize();tooltip.update();tooltip.pivot();tooltip.transition(easing).draw();});chart.options.tooltips.enabled = false;}}})";

            $sql = "SELECT * from mgr.v_nup_group_agent_type $param";
            $dt = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript = '';
            if(!empty($dt)) {
               
                $bgColor = '"#2fb4ed","#80d82d","#d7f442","#b5b8cf"';
                $jscript.='var pieData={labels:[';
                $jlabel = '';
                
                $jdata= '';
                $jcolor= '';
                $jjum='';
                foreach ($dt as $key => $row) {
                    $jlabel.='"'.$row->agentype_descs.'",';
                    $persen = ($row->qty / $row->total) * 100;
                    $persen = number_format($persen);
                    $jdata.=$persen.',';  
                }
                    
                $jlabel = substr($jlabel,0,-1);
                
                $jcolor=substr($jcolor,0,-1);
                $jdata=substr($jdata,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript.=$jlabel.'],datasets:[{label:"A",data:['.$jdata.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript.='var pieOption={responsive: true, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript.='var ctx=document.getElementById("inhouseChart").getContext("2d");';
                // $jscript4.='ctx.fillStyle="white";';
                $jscript.='new Chart(ctx,{type: "pie", data: pieData, options:pieOption});';
   
                
                }

            //WITHOUT HOLD

            $sql = "SELECT * from mgr.v_sales_summary_group_by_product where product_cd='APT' $param2 "; //APT QTY WITHOUT HOLD
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt5 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript5 = '';
            if(!empty($dt5)) {
                
                $bgColor = '"#e82020","#80d82d","#ff6b0f"'; //"#2fb4ed","#e82020","#80d82d","#ff6b0f"
                $jscript5.='var pieData={labels:["Sold","Available","Reserve"],';
                // $jlabel6 = '';
                
                $jdata5= '';
                $jcolor= '';
                $jjum5='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt5 as $key => $row) {
                    // $jlabel6.='"'.$row->product_cd.'",';
                   

                    $sold = ($row->sold_unit / $row->total_unit) * 100; 
                    $sold = number_format($sold, 2);
                    $soldAmt = $row->sold_unit;

                    $avail = ($row->avail_unit / $row->total_unit) * 100; 
                    $avail = number_format($avail, 2);
                    $availAmt = $row->avail_unit;

                    $reserve = ($row->reserve_unit / $row->total_unit) * 100; 
                    $reserve = number_format($reserve, 2);
                    $reserveAmt = $row->reserve_unit;
                   
                    $jdata5.=$sold.','.$avail.','.$reserve.',';  
                    $jjum5.=$soldAmt.','.$availAmt.','.$reserveAmt.','; 
                }
                    
                // $jlabel6 = substr($jlabel6,0,-1);
                // var_dump($jdata1);
                $jcolor=substr($jcolor,0,-1);
                $jdata5=substr($jdata5,0,-1);
                $jjum5=substr($jjum5,0,-1);
               // var_dump($jjum5);
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript5.='datasets:[{label: ['.$jjum5.'] ,data:['.$jdata5.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript5.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Qty :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript5.='var ctx=document.getElementById("haptqtychart").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript5.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_summary_group_by_product where product_cd='APT' $param2 "; //APT AMT WITHOUT HOLD
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt6 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript6 = '';
            if(!empty($dt6)) {
                
                $bgColor = '"#e82020","#80d82d","#ff6b0f"';
                $jscript6.='var pieData={labels:["Sold","Available","Reserve"],';
                // $jlabel6 = '';
                
                $jdata6= '';
                $jcolor= '';
                $jjum6='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt6 as $key => $row) {
                    // $jlabel6.='"'.$row->product_cd.'",';
                    

                    $sold = ($row->sold_value / $row->total_value) * 100; 
                    $sold = number_format($sold, 2);
                    $soldAmt = $row->sold_value; 

                    $avail = ($row->avail_value / $row->total_value) * 100; 
                    $avail = number_format($avail, 2);
                    $availAmt = $row->avail_value;

                    $reserve = ($row->reserve_value / $row->total_value) * 100; 
                    $reserve = number_format($reserve, 2);
                    $reserveAmt = $row->reserve_value;
                   
                    $jdata6.=$sold.','.$avail.','.$reserve.',';  
                    $jjum6.=$soldAmt.','.$availAmt.','.$reserveAmt.','; 
                }
                    
                // $jlabel6 = substr($jlabel6,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata6=substr($jdata6,0,-1);
                $jjum6=substr($jjum6,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript6.='datasets:[{label: ['.$jjum6.'] ,data:['.$jdata6.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript6.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Amount :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript6.='var ctx=document.getElementById("haptamtchart").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript6.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_summary_group_by_product where product_cd='LND' $param2 "; //LND QTY WITHOUT HOLD
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt7 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript7 = '';
            if(!empty($dt7)) {
                
                $bgColor = '"#e82020","#80d82d","#ff6b0f"';
                $jscript7.='var pieData={labels:["Sold","Available","Reserve"],';
                // $jlabel6 = '';
                
                $jdata7= '';
                $jcolor= '';
                $jjum7='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt7 as $key => $row) {
                    // $jlabel6.='"'.$row->product_cd.'",';
                    

                    $sold = ($row->sold_unit / $row->total_unit) * 100; 
                    $sold = number_format($sold, 2);
                    $soldAmt = $row->sold_unit;

                    $avail = ($row->avail_unit / $row->total_unit) * 100; 
                    $avail = number_format($avail, 2);
                    $availAmt = $row->avail_unit;

                    $reserve = ($row->reserve_unit / $row->total_unit) * 100; 
                    $reserve = number_format($reserve, 2);
                    $reserveAmt = $row->reserve_unit;
                   
                    $jdata7.=$sold.','.$avail.','.$reserve.',';  
                    $jjum7.=$soldAmt.','.$availAmt.','.$reserveAmt.','; 
                }
                    
                // $jlabel6 = substr($jlabel6,0,-1);
                // var_dump($jdata3);
                $jcolor=substr($jcolor,0,-1);
                $jdata7=substr($jdata7,0,-1);
                $jjum7=substr($jjum7,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript7.='datasets:[{label: ['.$jjum7.'] ,data:['.$jdata7.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript7.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Qty :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript7.='var ctx=document.getElementById("hlndqtychart").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript7.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_summary_group_by_product where product_cd='LND' $param2 "; //LND AMT WITHOUT HOLD
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt8 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript8 = '';
            if(!empty($dt8)) {
                
                $bgColor = '"#e82020","#80d82d","#ff6b0f"';
                $jscript8.='var pieData={labels:["Sold","Available","Reserve"],';
                // $jlabel6 = '';
                
                $jdata8= '';
                $jcolor= '';
                $jjum8='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt8 as $key => $row) {
                    // $jlabel6.='"'.$row->product_cd.'",';
                    

                    $sold = ($row->sold_value / $row->total_value) * 100; 
                    $sold = number_format($sold, 2);
                    $soldAmt = $row->sold_value;

                    $avail = ($row->avail_value / $row->total_value) * 100; 
                    $avail = number_format($avail, 2);
                    $availAmt = $row->avail_value;

                    $reserve = ($row->reserve_value / $row->total_value) * 100; 
                    $reserve = number_format($reserve, 2);
                    $reserveAmt = $row->reserve_value;
                   
                    $jdata8.=$sold.','.$avail.','.$reserve.',';  
                    $jjum8.=$soldAmt.','.$availAmt.','.$reserveAmt.','; 
                }
                    
                // $jlabel6 = substr($jlabel6,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata8=substr($jdata8,0,-1);
                $jjum8=substr($jjum8,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript8.='datasets:[{label: ['.$jjum8.'] ,data:['.$jdata8.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript8.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Amount :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript8.='var ctx=document.getElementById("hlndamtchart").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript8.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            //payment

            $sql = "SELECT * from mgr.v_sales_by_payment where product_cd='LND' $param2 "; //LND payment qty
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt9 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript9 = '';
            if(!empty($dt9)) {
                
                $bgColor = '"#2fb4ed","#ba68c8","#33e0ff","#0fe07f","#ffb74d","#4caf50","#ff7043"';
                $jscript9.='var pieData={labels:[';
                $jlabel9 = '';
                
                $jdata9= '';
                $jcolor= '';
                $jjum9='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt9 as $key => $row) {
                    $jlabel9.='"'.$row->payment_descs.'",';
                    

                    $qty = ($row->sales_qty / $row->total_sales_qty) * 100; 
                    $qty = number_format($qty, 2);
                    $qty_unit = $row->sales_qty;
                    
                   
                    $jdata9.=$qty.',';  
                    $jjum9.=$qty_unit.',';
                }
                    
                $jlabel9 = substr($jlabel9,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata9=substr($jdata9,0,-1);
                $jjum9=substr($jjum9,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript9.=$jlabel9.'],datasets:[{label: ['.$jjum9.'] ,data:['.$jdata9.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript9.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Qty : " + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript9.='var ctx=document.getElementById("paymentlndqty").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript9.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_by_payment where product_cd='LND' $param2 "; //LND payment amt
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt10 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript10 = '';
            if(!empty($dt10)) {
                
                $bgColor = '"#2fb4ed","#ba68c8","#33e0ff","#0fe07f","#ffb74d","#4caf50","#ff7043"';
                $jscript10.='var pieData={labels:[';
                $jlabel10 = '';
                
                $jdata10= '';
                $jcolor= '';
                $jjum10='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt10 as $key => $row) {
                    $jlabel10.='"'.$row->payment_descs.'",';
                    

                    $qty = ($row->sales_amt / $row->total_sales_amt) * 100; 
                    $qty = number_format($qty, 2);
                    $qtyAmt = $row->sales_amt;
                    
                   
                    $jdata10.=$qty.',';  
                    $jjum10.=$qtyAmt.',';  
                }
                    
                $jlabel10 = substr($jlabel10,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata10=substr($jdata10,0,-1);
                $jjum10=substr($jjum10,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript10.=$jlabel10.'],datasets:[{label: ['.$jjum10.'] ,data:['.$jdata10.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript10.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Amount :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript10.='var ctx=document.getElementById("paymentlndamt").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript10.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }


            $sql = "SELECT * from mgr.v_sales_by_payment where product_cd='APT' $param2 "; //APT payment qty
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt11 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript11 = '';
            if(!empty($dt11)) {
                
                $bgColor = '"#2fb4ed","#ba68c8","#33e0ff","#0fe07f","#ffb74d","#4caf50","#ff7043"';
                $jscript11.='var pieData={labels:[';
                $jlabel11 = '';
                
                $jdata11= '';
                $jcolor= '';
                $jjum11='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt11 as $key => $row) {
                    $jlabel11.='"'.$row->payment_descs.'",';
                    

                    $qty = ($row->sales_qty / $row->total_sales_qty) * 100; 
                    $qty = number_format($qty, 2);
                    $qty_unit = $row->sales_qty;

                    
                   
                    $jdata11.=$qty.',';  
                    $jjum11.=$qty_unit.',';  
                }
                    
                $jlabel11 = substr($jlabel11,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata11=substr($jdata11,0,-1);
                $jjum11=substr($jjum11,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript11.=$jlabel11.'],datasets:[{label: ['.$jjum11.'] ,data:['.$jdata11.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript11.='var pieOption={ legend:{onClick: null}, responsive: true,maintainAspectRatio: false, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          // amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Qty :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript11.='var ctx=document.getElementById("paymentaptqty").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript11.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_by_payment where product_cd='APT' $param2 "; //APT payment amt
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt12 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript12 = '';
            if(!empty($dt12)) {
                
                $bgColor = '"#2fb4ed","#ba68c8","#33e0ff","#0fe07f","#ffb74d","#4caf50","#ff7043"';
                $jscript12.='var pieData={labels:[';
                $jlabel12 = '';
                
                $jdata12= '';
                $jcolor= '';
                $jjum12='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt12 as $key => $row) {
                    $jlabel12.='"'.$row->payment_descs.'",';
                    

                    $qty = ($row->sales_amt / $row->total_sales_amt) * 100; 
                    $qty = number_format($qty, 2);
                    $qtyAmt = $row->sales_amt;
                    
                   
                    $jdata12.=$qty.',';  
                    $jjum12.=$qtyAmt.',';  
                }
                    
                $jlabel12 = substr($jlabel12,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata12=substr($jdata12,0,-1);
                $jjum12=substr($jjum12,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript12.=$jlabel12.'],datasets:[{label: ['.$jjum12.'],data:['.$jdata12.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript12.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Amount :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript12.='var ctx=document.getElementById("paymentaptamt").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript12.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }
           
            $sql = "SELECT * from mgr.v_sales_int_vs_ext where product_cd='APT'"; //APT qty
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt13 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript13 = '';
            if(!empty($dt13)) {
                
                $bgColor = '"#2fb4ed","#80d82d","#33e0ff","#0fe07f"';
                $jscript13.='var pieData={labels:[';
                $jlabel13 = '';
                
                $jdata13= '';
                $jcolor= '';
                $jjum13='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt13 as $key => $row) {
                    $jlabel13.='"'.$row->agent_type.'",';
                    

                    $qty = ($row->sales_qty / $row->total_sales_qty) * 100; 
                    $qty = number_format($qty, 2);

                    
                   
                    $jdata13.=$qty.',';  
                    $jjum13.=$row->sales_qty.',';  
                }
                    
                $jlabel13 = substr($jlabel13,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata13=substr($jdata13,0,-1);
                $jjum13=substr($jjum13,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript13.=$jlabel13.'],datasets:[{label: ['.$jjum13.'] ,data:['.$jdata13.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript13.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Qty :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript13.='var ctx=document.getElementById("salesinqtyapt").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript13.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_int_vs_ext where product_cd='LND' $param2 "; //LND qty
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt14 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript14 = '';
            if(!empty($dt14)) {
                
                $bgColor = '"#2fb4ed","#80d82d","#33e0ff","#0fe07f"';
                $jscript14.='var pieData={labels:[';
                $jlabel14 = '';
                
                $jdata14= '';
                $jcolor= '';
                $jjum14='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt14 as $key => $row) {
                    $jlabel14.='"'.$row->agent_type.'",';
                    

                    $qty = ($row->sales_qty / $row->total_sales_qty) * 100; 
                    $qty = number_format($qty, 2);

                    
                   
                    $jdata14.=$qty.',';  
                    $jjum14.=$row->sales_qty.',';  
                }
                    
                $jlabel14 = substr($jlabel14,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata14=substr($jdata14,0,-1);
                $jjum14=substr($jjum14,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript14.=$jlabel14.'],datasets:[{label: ['.$jjum14.'] ,data:['.$jdata14.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript14.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Qty :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript14.='var ctx=document.getElementById("salesinqtylnd").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript14.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_int_vs_ext where product_cd='APT' $param2 "; //APT amt
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt15 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript15 = '';
            if(!empty($dt15)) {
                
                $bgColor = '"#2fb4ed","#80d82d","#33e0ff","#0fe07f"';
                $jscript15.='var pieData={labels:[';
                $jlabel15 = '';
                
                $jdata15= '';
                $jcolor= '';
                $jjum15='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt15 as $key => $row) {
                    $jlabel15.='"'.$row->agent_type.'",';
                    

                    $qty = ($row->sales_amt / $row->total_sales_amt) * 100; 
                    $qty = number_format($qty, 2);

                    
                   
                    $jdata15.=$qty.',';  
                    $jjum15.=$row->sales_amt.','; 
                }
                    
                $jlabel15 = substr($jlabel15,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata15=substr($jdata15,0,-1);
                $jjum15=substr($jjum15,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript15.=$jlabel15.'],datasets:[{label: ['.$jjum15.'] ,data:['.$jdata15.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript15.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Amount :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript15.='var ctx=document.getElementById("salesinamtapt").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript15.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_int_vs_ext where product_cd='LND' $param2 "; //LND amt
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt16 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript16 = '';
            if(!empty($dt16)) {
                
                $bgColor = '"#2fb4ed","#80d82d","#33e0ff","#0fe07f"';
                $jscript16.='var pieData={labels:[';
                $jlabel16 = '';
                
                $jdata16= '';
                $jcolor= '';
                $jjum16='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt16 as $key => $row) {
                    $jlabel16.='"'.$row->agent_type.'",';
                    

                    $qty = ($row->sales_amt / $row->total_sales_amt) * 100; 
                    $qty = number_format($qty, 2);

                    
                   
                    $jdata16.=$qty.',';  
                    $jjum16.=$row->sales_amt.',';  
                }
                    
                $jlabel16 = substr($jlabel16,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata16=substr($jdata16,0,-1);
                $jjum16=substr($jjum16,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript16.=$jlabel16.'],datasets:[{label: ['.$jjum16.'] ,data:['.$jdata16.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript16.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Amount :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript16.='var ctx=document.getElementById("salesinamtlnd").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript16.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_by_lead_agent where product_cd='APT' $param2 "; //APT amt
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt17 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript17 = '';
            if(!empty($dt17)) {
                
                $bgColor = '"#2fb4ed","#ba68c8","#33e0ff","#0fe07f","#ffb74d","#4caf50","#ff7043"';
                $jscript17.='var pieData={labels:[';
                $jlabel17 = '';
                
                $jdata17= '';
                $jcolor= '';
                $jjum17='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt17 as $key => $row) {
                    $jlabel17.='"'.$row->lead_name.'",';
                    

                    $qty = ($row->sales_amt / $row->total_sales_amt) * 100; 
                    $qty = number_format($qty, 2);

                    
                   
                    $jdata17.=$qty.',';  
                    $jjum17.=$row->sales_amt .',';  
                }
                    
                $jlabel17 = substr($jlabel17,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata17=substr($jdata17,0,-1);
                $jjum17=substr($jjum17,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript17.=$jlabel17.'],datasets:[{label: ['.$jjum17.'] ,data:['.$jdata17.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript17.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
            amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Amount :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript17.='var ctx=document.getElementById("leadaptamt").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript17.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_by_lead_agent where product_cd='LND' $param2 "; //LND amt
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt18 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript18 = '';
            if(!empty($dt18)) {
                
                $bgColor = '"#2fb4ed","#ba68c8","#33e0ff","#0fe07f","#ffb74d","#4caf50","#ff7043"';
                $jscript18.='var pieData={labels:[';
                $jlabel18 = '';
                
                $jdata18= '';
                $jcolor= '';
                $jjum18='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt18 as $key => $row) {
                    $jlabel18.='"'.$row->lead_name.'",';
                    

                    $qty = ($row->sales_amt / $row->total_sales_amt) * 100; 
                    $qty = number_format($qty, 2);

                    
                   
                    $jdata18.=$qty.',';  
                    $jjum18.=$row->sales_amt.',';  
                }
                    
                $jlabel18 = substr($jlabel18,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata18=substr($jdata18,0,-1);
                $jjum18=substr($jjum18,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript18.=$jlabel18.'],datasets:[{label: ['.$jjum18.'] ,data:['.$jdata18.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript18.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
    amt = amt.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Amount :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript18.='var ctx=document.getElementById("leadlndamt").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript18.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_by_lead_agent where product_cd='APT' $param2 "; //LND qty
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt19 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript19 = '';
            if(!empty($dt19)) {
                
                $bgColor = '"#2fb4ed","#ba68c8","#33e0ff","#0fe07f","#ffb74d","#4caf50","#ff7043"';
                $jscript19.='var pieData={labels:[';
                $jlabel19 = '';
                
                $jdata19= '';
                $jcolor= '';
                $jjum19='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt19 as $key => $row) {
                    $jlabel19.='"'.$row->lead_name.'",';
                    

                    $qty = ($row->sales_qty / $row->total_sales_qty) * 100; 
                    $qty = number_format($qty, 2);

                    
                   
                    $jdata19.=$qty.',';  
                    $jjum19.=$row->sales_qty.',';  
                }
                    
                $jlabel19 = substr($jlabel19,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata19=substr($jdata19,0,-1);
                $jjum19=substr($jjum19,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript19.=$jlabel19.'],datasets:[{label: ['.$jjum19.'] ,data:['.$jdata19.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript19.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Qty :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript19.='var ctx=document.getElementById("leadaptqty").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript19.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }

            $sql = "SELECT * from mgr.v_sales_by_lead_agent where product_cd='LND' $param2 "; //LND qty
// $sql = "SELECT * from mgr.v_nup_amt_group_agent_type";
            $dt20 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
            $jscript20 = '';
            if(!empty($dt20)) {
                
                $bgColor = '"#2fb4ed","#ba68c8","#33e0ff","#0fe07f","#ffb74d","#4caf50","#ff7043"';
                $jscript20.='var pieData={labels:[';
                $jlabel20 = '';
                
                $jdata20= '';
                $jcolor= '';
                $jjum20='';


                // $sold = ($row->sold_unit/$row->total_unit) * 100;
                foreach ($dt20 as $key => $row) {
                    $jlabel20.='"'.$row->lead_name.'",';
                    

                    $qty = ($row->sales_qty / $row->total_sales_qty) * 100; 
                    $qty = number_format($qty, 2);

                    
                   
                    $jdata20.=$qty.',';  
                    $jjum20.=$row->sales_qty.',';  
                }
                    
                $jlabel20 = substr($jlabel20,0,-1);
                // var_dump($jdata6);
                $jcolor=substr($jcolor,0,-1);
                $jdata20=substr($jdata20,0,-1);
                $jjum20=substr($jjum20,0,-1);
               
                //$jpersen='var calcPrice=('.$jdata.' * '.$jjum.' / 100 );';
                $jscript20.=$jlabel20.'],datasets:[{label: ['.$jjum20.'] ,data:['.$jdata20.'],backgroundColor:['.$bgColor.']}]};';
                    //var_dump($jpersen);
                // $jscript4.='var precentage = Math.floor((('.$jdata.' / '.$jjum.') * 100)+0.5);';         
                // $jscript4.='return precentage + "%";';
                
                $jscript20.='var pieOption={ legend:{onClick: null}, responsive: true, label: true, tooltips: {callbacks: {
            label: function(tooltipItem, data) {
            var dataset = data.datasets[tooltipItem.datasetIndex];
            var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {return previousValue + currentValue;});
          var currentValue = dataset.data[tooltipItem.index];
          var amt = dataset.label[tooltipItem.index];
          var precentage = Math.floor(((currentValue/total) * 100)+0.5);         
          return "Qty :" + amt;
        }
      }}, showPercentage: true, scales: {label: [{display: true}]}};';

                $jscript20.='var ctx=document.getElementById("leadlndqty").getContext("2d");';
                // $jscript1.='ctx.fillStyle="Black";';
                // $jscript1.='var textSize=document.getElementById("amtchart").width/15;';
                $jscript20.='new Chart(ctx, {type: "pie", data: pieData, options:pieOption});';
        
            }
            
             $sql21 = "SELECT * from mgr.v_sales_apt_by_amt $param order by level_seq_no ";

            $dt21 = $this->m_wsbangun->getData_by_query_cons($cons,$sql21);
            // var_dump($dt8);
            // exit();
            $jscript21='';
            if (!empty($dt21)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript21.='var barData={labels:[';
                $jlabel21 = ''; $jdata21=''; $jdata211=''; $jdata212='';
                foreach ($dt21 as $key => $row) {
                    $jlabel21 .='"'.$row->level_descs.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';


                    $jdata21 .=$row->tower1.",";
                    $jdata211 .=$row->tower2.",";
                    $jdata212 .=$row->tower3.",";


                }

                $jlabel21 = substr($jlabel21, 0,-1);
                $jdata21 = substr($jdata21, 0,-1);
                $jdata211 = substr($jdata211, 0,-1);
                $jdata212 = substr($jdata212, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript21.=$jlabel21.'],datasets:[{label:"Tower 1" ,data:['.$jdata21.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata211.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata212.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript21.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                            }
                    }
                }, maintainAspectRatio: false, responsive: true, legend: {display: true},
                scales: {yAxes: [{ticks: {
                    beginAtZero: true,
                    stepSize: 0,

       
                    userCallback: function(value, index, values) {
          
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);

           
                        value = value.join(".");
                        return "" + value;
                    }
                }}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript21.='var ctx=document.getElementById("barAptAmt").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }

            $sql22 = "SELECT * from mgr.v_sales_apt_by_qty order by level_seq_no ";

            $dt22 = $this->m_wsbangun->getData_by_query_cons($cons,$sql22);
            // var_dump($dt9);
            // exit();
            $jscript22='';
            if (!empty($dt22)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript22.='var barData={labels:[';
                $jlabel22 = ''; $jdata22=''; $jdata221=''; $jdata222='';
                foreach ($dt22 as $key => $row) {
                    $jlabel22 .='"'.$row->level_descs.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata22 .=$row->tower1.",";
                    $jdata221 .=$row->tower2.",";
                    $jdata222 .=$row->tower3.",";

                }

                $jlabel22 = substr($jlabel22, 0,-1);
                $jdata22 = substr($jdata22, 0,-1);
                $jdata221 = substr($jdata221, 0,-1);
                $jdata222 = substr($jdata222, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript22.=$jlabel22.'],datasets:[{label:"Tower 1" ,data:['.$jdata22.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata221.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata222.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                $jscript22.='var barOptions = {tooltips: {
        
        callbacks: {
            label: function (tooltipItems, data) {
                return "Total Quantity : " + tooltipItems.yLabel;
            }
        }
    },maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript22.='var ctx=document.getElementById("barAptQty").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }

            $sql23 = "SELECT * from mgr.v_sales_lnd_by_amt where phase1 > 0 or phase2 > 0 or phase3 > 0 $param2";

            $dt23 = $this->m_wsbangun->getData_by_query_cons($cons,$sql23);
            // var_dump($dt10);
            // exit();
            $jscript23='';
            if (!empty($dt23)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript23.='var barData={labels:[';
                $jlabel23 = ''; $jdata23=''; $jdata231=''; $jdata232='';
                foreach ($dt23 as $key => $row) {
                    $jlabel23 .='"'.$row->lot_type_descs.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata23 .=$row->phase1.",";
                    $jdata231 .=$row->phase2.",";
                    $jdata232 .=$row->phase3.",";

                }

                $jlabel23 = substr($jlabel23, 0,-1);
                $jdata23 = substr($jdata23, 0,-1);
                $jdata231 = substr($jdata231, 0,-1);
                $jdata232 = substr($jdata232, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript23.=$jlabel23.'],datasets:[{label:"Phase 1" ,data:['.$jdata23.'],backgroundColor:['.$bg1.']},{label:"Phase 2" ,data:['.$jdata231.'],backgroundColor:['.$bg2.']},{label:"Phase 3" ,data:['.$jdata232.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript23.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                            }
                    }
                }, maintainAspectRatio: false, responsive: true, legend: {display: true},
                scales: {yAxes: [{ticks: {
                    beginAtZero: true,
                    stepSize: 0,

       
                    userCallback: function(value, index, values) {
          
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);

           
                        value = value.join(".");
                        return "" + value;
                    }
                }}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript23.='var ctx=document.getElementById("barLndAmt").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }


            $sql24 = "SELECT * from mgr.v_sales_lnd_by_qty where phase1 > 0 or phase2 > 0 or phase3 > 0 order by level_seq_no";

            $dt24 = $this->m_wsbangun->getData_by_query_cons($cons,$sql24);
            // var_dump($dt10);
            // exit();
            $jscript24='';
            if (!empty($dt24)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript24.='var barData={labels:[';
                $jlabel24 = ''; $jdata24=''; $jdata241=''; $jdata242='';
                foreach ($dt24 as $key => $row) {
                    $jlabel24 .='"'.$row->lot_type_descs.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata24 .=$row->phase1.",";
                    $jdata241 .=$row->phase2.",";
                    $jdata242 .=$row->phase3.",";

                }

                $jlabel24 = substr($jlabel24, 0,-1);
                $jdata24 = substr($jdata24, 0,-1);
                $jdata241 = substr($jdata241, 0,-1);
                $jdata242 = substr($jdata242, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript24.=$jlabel24.'],datasets:[{label:"Phase 1" ,data:['.$jdata24.'],backgroundColor:['.$bg1.']},{label:"Phase 2" ,data:['.$jdata241.'],backgroundColor:['.$bg2.']},{label:"Phase 3" ,data:['.$jdata242.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                $jscript24.='var barOptions = {tooltips: {
        
        callbacks: {
            label: function (tooltipItems, data) {
                return "Total Quantity : " + tooltipItems.yLabel;
            }
        }
    },maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript24.='var ctx=document.getElementById("barLndQty").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
            //quantity apt by nationality
            $sql25 = "SELECT * from mgr.v_sales_qty_nationality where product_cd='APT' $param2  ";

            $dt25 = $this->m_wsbangun->getData_by_query_cons($cons,$sql25);
            // var_dump($dt8);
            // exit();
            $jscript25='';
            if (!empty($dt25)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript25.='var barData={labels:[';
                $jlabel25 = ''; $jdata25=''; $jdata251=''; $jdata252='';
                foreach ($dt25 as $key => $row) {
                    $jlabel25 .='"'.$row->nationality.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata25 .=$row->Qty_1.",";
                    $jdata251 .=$row->Qty_2.",";
                    $jdata252 .=$row->Qty_3.",";


                }

                $jlabel25 = substr($jlabel25, 0,-1);
                $jdata25 = substr($jdata25, 0,-1);
                $jdata251 = substr($jdata251, 0,-1);
                $jdata252 = substr($jdata252, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript25.=$jlabel25.'],datasets:[{label:"Tower 1" ,data:['.$jdata25.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata251.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata252.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript25.='var barOptions = {tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                });
            }
        }
    },scaleLabel:
        function(label){return  "" + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");},
        
    maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript25.='var ctx=document.getElementById("barAptQtyN").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
            //amount apt by nationality
            
            // var_dump($dt8);
            // exit();
            $jscript26='';
            if (!empty($dt25)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript26.='var barData={labels:[';
                $jlabel26 = ''; $jdata26=''; $jdata261=''; $jdata262='';
                foreach ($dt25 as $key => $row) {
                    $jlabel26 .='"'.$row->nationality.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata26 .=$row->Price_1.",";
                    $jdata261 .=$row->Price_2.",";
                    $jdata262 .=$row->Price_3.",";


                }

                $jlabel26 = substr($jlabel26, 0,-1);
                $jdata26 = substr($jdata26, 0,-1);
                $jdata261 = substr($jdata261, 0,-1);
                $jdata262 = substr($jdata262, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript26.=$jlabel26.'],datasets:[{label:"Tower 1" ,data:['.$jdata26.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata261.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata262.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript26.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                            }
                    }
                }, maintainAspectRatio: false, responsive: true, legend: {display: true},
                scales: {yAxes: [{ticks: {
                    beginAtZero: true,
                    stepSize: 0,

       
                    userCallback: function(value, index, values) {
          
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);

           
                        value = value.join(".");
                        return "" + value;
                    }
                }}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript26.='var ctx=document.getElementById("barAptAmtN").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
             //quantity LND by nationality
            $sql27 = "SELECT * from mgr.v_sales_qty_nationality where product_cd='LND' $param2  ";

            $dt27 = $this->m_wsbangun->getData_by_query_cons($cons,$sql27);
            // var_dump($dt8);
            // exit();
            $jscript27='';
            if (!empty($dt27)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript27.='var barData={labels:[';
                $jlabel27 = ''; $jdata27=''; $jdata271=''; $jdata272='';
                foreach ($dt27 as $key => $row) {
                    $jlabel27 .='"'.$row->nationality.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata27 .=$row->Qty_1.",";
                    $jdata271 .=$row->Qty_2.",";
                    $jdata272 .=$row->Qty_3.",";


                }

                $jlabel27 = substr($jlabel27, 0,-1);
                $jdata27 = substr($jdata27, 0,-1);
                $jdata271 = substr($jdata271, 0,-1);
                $jdata272 = substr($jdata272, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript27.=$jlabel27.'],datasets:[{label:"Tower 1" ,data:['.$jdata27.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata271.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata272.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript27.='var barOptions = {tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                });
            }
        }
    },scaleLabel:
        function(label){return  "" + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");},
        
    maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript27.='var ctx=document.getElementById("barLndQtyN").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
            //amount apt by nationality
           
            // exit();
            $jscript28='';
            if (!empty($dt27)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript28.='var barData={labels:[';
                $jlabel28 = ''; $jdata28=''; $jdata281=''; $jdata282='';
                foreach ($dt27 as $key => $row) {
                    $jlabel28 .='"'.$row->nationality.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata28 .=$row->Price_1.",";
                    $jdata281 .=$row->Price_2.",";
                    $jdata282 .=$row->Price_3.",";


                }

                $jlabel28 = substr($jlabel28, 0,-1);
                $jdata28 = substr($jdata28, 0,-1);
                $jdata281 = substr($jdata281, 0,-1);
                $jdata282 = substr($jdata282, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript28.=$jlabel28.'],datasets:[{label:"Tower 1" ,data:['.$jdata28.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata281.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata282.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript28.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                            }
                    }
                }, maintainAspectRatio: false, responsive: true, legend: {display: true},
                scales: {yAxes: [{ticks: {
                    beginAtZero: true,
                    stepSize: 0,

       
                    userCallback: function(value, index, values) {
          
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);

           
                        value = value.join(".");
                        return "" + value;
                    }
                }}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript28.='var ctx=document.getElementById("barLndAmtN").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
            //-----------------------------------------------
            //quantity apt by city
            $sql29 = "SELECT * from mgr.v_sales_city where product_cd='APT' $param2  ";

            $dt29 = $this->m_wsbangun->getData_by_query_cons($cons,$sql29);
            // var_dump($dt8);
            // exit();
            $jscript29='';
            if (!empty($dt29)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript29.='var barData={labels:[';
                $jlabel29 = ''; $jdata29=''; $jdata291=''; $jdata292='';
                foreach ($dt29 as $key => $row) {
                    $jlabel29 .='"'.$row->city.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata29 .=$row->Qty_1.",";
                    $jdata291 .=$row->Qty_2.",";
                    $jdata292 .=$row->Qty_3.",";


                }

                $jlabel29 = substr($jlabel29, 0,-1);
                $jdata29 = substr($jdata29, 0,-1);
                $jdata291 = substr($jdata291, 0,-1);
                $jdata292 = substr($jdata292, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript29.=$jlabel29.'],datasets:[{label:"Tower 1" ,data:['.$jdata29.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata291.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata292.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript29.='var barOptions = {tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                });
            }
        }
    },scaleLabel:
        function(label){return  "" + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");},
        
    maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript29.='var ctx=document.getElementById("barAptQtyC").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
            //amount apt by nationality
            
            // var_dump($dt8);
            // exit();
            $jscript30='';
            if (!empty($dt29)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript30.='var barData={labels:[';
                $jlabel30 = ''; $jdata30=''; $jdata301=''; $jdata302='';
                foreach ($dt29 as $key => $row) {
                    $jlabel30 .='"'.$row->city.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata30 .=$row->Price_1.",";
                    $jdata301 .=$row->Price_2.",";
                    $jdata302 .=$row->Price_3.",";


                }

                $jlabel30 = substr($jlabel30, 0,-1);
                $jdata30 = substr($jdata30, 0,-1);
                $jdata301 = substr($jdata301, 0,-1);
                $jdata302 = substr($jdata302, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript30.=$jlabel30.'],datasets:[{label:"Tower 1" ,data:['.$jdata30.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata301.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata302.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript30.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                            }
                    }
                }, maintainAspectRatio: false, responsive: true, legend: {display: true},
                scales: {yAxes: [{ticks: {
                    beginAtZero: true,
                    stepSize: 0,

       
                    userCallback: function(value, index, values) {
          
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);

           
                        value = value.join(".");
                        return "" + value;
                    }
                }}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript30.='var ctx=document.getElementById("barAptAmtC").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
             //quantity LND by nationality
            $sql31 = "SELECT * from mgr.v_sales_city where product_cd='LND' $param2  ";

            $dt31 = $this->m_wsbangun->getData_by_query_cons($cons,$sql31);
            // var_dump($dt8);
            // exit();
            $jscript31='';
            if (!empty($dt31)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript31.='var barData={labels:[';
                $jlabel31 = ''; $jdata31=''; $jdata311=''; $jdata312='';
                foreach ($dt31 as $key => $row) {
                    $jlabel31 .='"'.$row->city.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata31 .=$row->Qty_1.",";
                    $jdata311 .=$row->Qty_2.",";
                    $jdata312 .=$row->Qty_3.",";


                }

                $jlabel31 = substr($jlabel31, 0,-1);
                $jdata31 = substr($jdata31, 0,-1);
                $jdata311 = substr($jdata311, 0,-1);
                $jdata312 = substr($jdata312, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript31.=$jlabel31.'],datasets:[{label:"Tower 1" ,data:['.$jdata31.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata311.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata312.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript31.='var barOptions = {tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                });
            }
        }
    },scaleLabel:
        function(label){return  "" + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");},
        
    maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript31.='var ctx=document.getElementById("barLndQtyC").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
            //amount apt by nationality
           
            // exit();
            $jscript32='';
            if (!empty($dt31)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript32.='var barData={labels:[';
                $jlabel32 = ''; $jdata32=''; $jdata321=''; $jdata322='';
                foreach ($dt31 as $key => $row) {
                    $jlabel32 .='"'.$row->city.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata32 .=$row->Price_1.",";
                    $jdata321 .=$row->Price_2.",";
                    $jdata322 .=$row->Price_3.",";


                }

                $jlabel32 = substr($jlabel32, 0,-1);
                $jdata32 = substr($jdata32, 0,-1);
                $jdata321 = substr($jdata321, 0,-1);
                $jdata322 = substr($jdata322, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript32.=$jlabel32.'],datasets:[{label:"Tower 1" ,data:['.$jdata32.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata321.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata322.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript32.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                            }
                    }
                }, maintainAspectRatio: false, responsive: true, legend: {display: true},
                scales: {yAxes: [{ticks: {
                    beginAtZero: true,
                    stepSize: 0,

       
                    userCallback: function(value, index, values) {
          
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);

           
                        value = value.join(".");
                        return "" + value;
                    }
                }}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript32.='var ctx=document.getElementById("barLndAmtC").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }

             //-----------------------------------------------
            //quantity apt by lot type
            $sql33 = "SELECT * from mgr.v_sales_lot_type where product_cd='APT' $param2  ";

            $dt33 = $this->m_wsbangun->getData_by_query_cons($cons,$sql33);
            // var_dump($dt8);
            // exit();
            $jscript33='';
            if (!empty($dt33)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript33.='var barData={labels:[';
                $jlabel33 = ''; $jdata33=''; $jdata331=''; $jdata332='';
                foreach ($dt33 as $key => $row) {
                    $jlabel33 .='"'.$row->Lot_Type_descs.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata33 .=$row->Qty_1.",";
                    $jdata331 .=$row->Qty_2.",";
                    $jdata332 .=$row->Qty_3.",";


                }

                $jlabel33 = substr($jlabel33, 0,-1);
                $jdata33 = substr($jdata33, 0,-1);
                $jdata331 = substr($jdata331, 0,-1);
                $jdata332 = substr($jdata332, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript33.=$jlabel33.'],datasets:[{label:"Tower 1" ,data:['.$jdata33.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata331.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata332.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript33.='var barOptions = {tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                });
            }
        }
    },scaleLabel:
        function(label){return  "" + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");},
        
    maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript33.='var ctx=document.getElementById("barAptQtyLT").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
            //amount apt by nationality
            
            // var_dump($dt8);
            // exit();
            $jscript34='';
            if (!empty($dt33)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript34.='var barData={labels:[';
                $jlabel34 = ''; $jdata34=''; $jdata341=''; $jdata342='';
                foreach ($dt33 as $key => $row) {
                    $jlabel34 .='"'.$row->Lot_Type_descs.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata34 .=$row->Price_1.",";
                    $jdata341 .=$row->Price_2.",";
                    $jdata342 .=$row->Price_3.",";


                }

                $jlabel34 = substr($jlabel34, 0,-1);
                $jdata34 = substr($jdata34, 0,-1);
                $jdata341 = substr($jdata341, 0,-1);
                $jdata342 = substr($jdata342, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript34.=$jlabel34.'],datasets:[{label:"Tower 1" ,data:['.$jdata34.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata341.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata342.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript34.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                            }
                    }
                }, maintainAspectRatio: false, responsive: true, legend: {display: true},
                scales: {yAxes: [{ticks: {
                    beginAtZero: true,
                    stepSize: 0,

       
                    userCallback: function(value, index, values) {
          
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);

           
                        value = value.join(".");
                        return "" + value;
                    }
                }}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript34.='var ctx=document.getElementById("barAptAmtLT").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
             //quantity LND by nationality
            $sql35 = "SELECT * from mgr.v_sales_lot_type where product_cd='LND' $param2  ";

            $dt35= $this->m_wsbangun->getData_by_query_cons($cons,$sql35);
            // var_dump($dt8);
            // exit();
            $jscript35='';
            if (!empty($dt35)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript35.='var barData={labels:[';
                $jlabel35 = ''; $jdata35=''; $jdata351=''; $jdata352='';
                foreach ($dt35 as $key => $row) {
                    $jlabel35 .='"'.$row->Lot_Type_descs.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata35 .=$row->Qty_1.",";
                    $jdata351 .=$row->Qty_2.",";
                    $jdata352 .=$row->Qty_3.",";


                }

                $jlabel35 = substr($jlabel35, 0,-1);
                $jdata35 = substr($jdata35, 0,-1);
                $jdata351 = substr($jdata351, 0,-1);
                $jdata352 = substr($jdata352, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript35.=$jlabel35.'],datasets:[{label:"Tower 1" ,data:['.$jdata35.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata351.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata352.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript35.='var barOptions = {tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                    return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
                });
            }
        }
    },scaleLabel:
        function(label){return  "" + label.value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");},
        
    maintainAspectRatio: false, responsive: true, legend: {display: true},scales: {yAxes: [{ticks:{beginAtZero:true}}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript35.='var ctx=document.getElementById("barLndQtyLT").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }
            //amount apt by nationality
           
            // exit();
            $jscript36='';
            if (!empty($dt35)) {
                $bg1='';
                $bg2='';
                $bg3='';

                $jscript36.='var barData={labels:[';
                $jlabel36 = ''; $jdata36=''; $jdata361=''; $jdata362='';
                foreach ($dt35 as $key => $row) {
                    $jlabel36 .='"'.$row->Lot_Type_descs.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#80d82d",';
                    $bg3.='"#ff7e1c",';

                    $jdata36 .=$row->Price_1.",";
                    $jdata361 .=$row->Price_2.",";
                    $jdata362 .=$row->Price_3.",";


                }

                $jlabel36 = substr($jlabel36, 0,-1);
                $jdata36 = substr($jdata36, 0,-1);
                $jdata361 = substr($jdata361, 0,-1);
                $jdata362 = substr($jdata362, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                 $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                   $jscript36.=$jlabel36.'],datasets:[{label:"Tower 1" ,data:['.$jdata36.'],backgroundColor:['.$bg1.']},{label:"Tower 2" ,data:['.$jdata361.'],backgroundColor:['.$bg2.']},{label:"Tower 3" ,data:['.$jdata362.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jscript36.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                            }
                    }
                }, maintainAspectRatio: false, responsive: true, legend: {display: true},
                scales: {yAxes: [{ticks: {
                    beginAtZero: true,
                    stepSize: 0,

       
                    userCallback: function(value, index, values) {
          
                        value = value.toString();
                        value = value.split(/(?=(?:...)*$)/);

           
                        value = value.join(".");
                        return "" + value;
                    }
                }}],xAxes: [{gridLines:{display: false}}]}};';
                $jscript36.='var ctx=document.getElementById("barLndAmtLT").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }

            //---------------------mulai dari sini ----------------------//
        $param = " where project_no='".$project."' AND entity_cd='".$entity."'";
        $sql = "SELECT * from mgr.v_sales_summary_group_by_product_list  $param  ORDER BY product_cd"; 
        $dt1 = $this->m_wsbangun->getData_by_query_cons($cons,$sql);
        $bb = 'APT';
        $apt = array_filter($dt1,function($a) use($bb) {
                        
                        return $a->product_cd === $bb;

                    });
        
        $jdata1= '';
        $jdata3='';
        $jcolor= '';
        $jjum1= '';

        foreach ($apt as $key => $row) {
            $p1 = '["'.$row->status_descs.'",'.$row->amount.']';
            $P2 = '["'.$row->status_descs.'",'.$row->unit.']';
            //set colour
            $cl='';
            if($row->STATUS=='A'){
                $cl ='"#80d82d"';
            }else if($row->STATUS=='B'){
                $cl ='"#e82020"';
            }else if($row->STATUS=='H'){
                $cl ='"#2fb4ed"';
            }else if($row->STATUS=='R'){
                $cl ='"#ff6b0f"';
            }
            $c1 = $row->status_descs.' : '.$cl;
            $jdata1.= $p1.',';
            $jcolor.= $c1.',';
            $jdata3.= $P2.',';
        }
        $jdata1=substr($jdata1,0,-1);
        $jcolor=substr($jcolor,0,-1);
        $jdata3=substr($jdata3,0,-1);

         $pie1 = '';
        $pie1.='var chart1 = c3.generate({bindto: "#aptamtchart",padding: {bottom: 20,top:10}, data: {';
        $pie1.='         columns: [ '.$jdata1.'], ';
        $pie1.='         type : "pie",        ';
        $pie1.='         colors :{'.$jcolor.'}         ';
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
       

        $pie3 = '';
        $pie3.='var chart1 = c3.generate({bindto: "#aptunitchart",data: {';
        $pie3.='         columns: [ '.$jdata3.'], ';
        $pie3.='         type : "pie",        ';
        $pie3.='         colors :{'.$jcolor.'}         ';
        $pie3.='     }, ';
        $pie3.='     tooltip: { ';
        $pie3.='         format: { ';
        // $pie1.='             // title: function (d) { return 'Data ' + d; }, ';
        $pie3.='             value: function (value, ratio, id) { ';
        $pie3.='                 return value; ';
        $pie3.='             } ';
        $pie3.='         } ';
        $pie3.='     } ';
        $pie3.=' });';

        $Lnd = array_filter($dt1,function($a)  {
                        
                        return $a->product_cd === 'LND';

                    });
         $jdata2= '';
         $jdata4= '';
        $jcolor= '';
        $jjum1= '';

        foreach ($Lnd as $key => $row) {
            $p1 = '["'.$row->status_descs.'",'.$row->amount.']';
            $P2 = '["'.$row->status_descs.'",'.$row->unit.']';
            //set colour
            $cl='';
            if($row->STATUS=='A'){
                $cl ='"#80d82d"';
            }else if($row->STATUS=='B'){
                $cl ='"#e82020"';
            }else if($row->STATUS=='H'){
                $cl ='"#2fb4ed"';
            }else if($row->STATUS=='R'){
                $cl ='"#ff6b0f"';
            }
            $c1 = $row->status_descs.' : '.$cl;
            $jdata2.= $p1.',';
            $jcolor.= $c1.',';
            $jdata4.= $P2.',';
        }
        $jdata2=substr($jdata2,0,-1);
        $jcolor=substr($jcolor,0,-1);
        $jdata4=substr($jdata4,0,-1);

        $pie2 = '';
        $pie2.='var chart1 = c3.generate({bindto: "#lndamtchart", padding: {bottom: 20,top:10},data: {';
        $pie2.='         columns: [ '.$jdata2.'], ';
        $pie2.='         type : "pie",        ';
        $pie2.='         colors :{'.$jcolor.'}         ';
        $pie2.='     }, ';
        $pie2.='     tooltip: { ';
        $pie2.='         format: { ';
        // $pie1.='             // title: function (d) { return 'Data ' + d; }, ';
        $pie2.='             value: function (value, ratio, id) { ';
        $pie2.='                 return formatNumber(value); ';
        $pie2.='             } ';
        $pie2.='         } ';
        $pie2.='     } ';
        $pie2.=' });';

        $pie4 = '';
        $pie4.='var chart1 = c3.generate({bindto: "#lndunitchart",data: {';
        $pie4.='         columns: [ '.$jdata4.'], ';
        $pie4.='         type : "pie",        ';
        $pie4.='         colors :{'.$jcolor.'}         ';
        $pie4.='     }, ';
        $pie4.='     tooltip: { ';
        $pie4.='         format: { ';
        // $pie1.='             // title: function (d) { return 'Data ' + d; }, ';
        $pie4.='             value: function (value, ratio, id) { ';
        $pie4.='                 return value; ';
        $pie4.='             } ';
        $pie4.='         } ';
        $pie4.='     } ';
        $pie4.=' });';


        //............top 10 agent awal//
         
        //............top 10 agent akhir//
            //---------------------akhir dari sini ----------------------//

        //----------------------------agent 10 baru ----------------------//
        $sqltop10 = "SELECT * from mgr.v_rl_top_10_sales";

            $dttop = $this->m_wsbangun->getData_by_query_cons($cons,$sqltop10); //dt21 => dttop
            // var_dump($dttop);
            // exit();
            $jtop10agent='';  //jscript21 = jtop10agent
            if (!empty($dttop)) {
                $bg1=''; $bg2=''; $bg3='';
                $jdata10agen2 ='';
                $jdata10agen3 ='';

                $jtop10agent.='var barData={labels:[';
                $j10label = ''; $jdata10agen='';  //jlabel21 => j10label, jdata21 => jdata10agen
                foreach ($dttop as $key => $row) {
                    $j10label .='"'.$row->agent_name.'",';
                    $bg1.='"#2fb4ed",';
                    $bg2.='"#ffffff",';
                    $bg3.='"#ffffff",';
                    $jdata10agen .=$row->total_sell_amt.",";
                    $jdata10agen2 .=' '.",";
                    $jdata10agen3 .=' '.",";
                   

                }

                $j10label = substr($j10label, 0,-1);
                $jdata10agen = substr($jdata10agen, 0,-1);
                $jdata10agen2 = substr($jdata10agen2, 0,-1);
                $jdata10agen3 = substr($jdata10agen3, 0,-1);
                $bg1 = substr($bg1, 0,-1);
                $bg2 = substr($bg2, 0,-1);
                  $bg3 = substr($bg3, 0,-1);
                // [["My", "long", "long", "long", "label"], "another label",...]
                   $jtop10agent.=$j10label.'],datasets:[{label:"Agent" ,data:['.$jdata10agen.'],backgroundColor:['.$bg1.']}, {label:"Agent" ,data:['.$jdata10agen2.'],backgroundColor:['.$bg2.']}, {label:"Agent" ,data:['.$jdata10agen3.'],backgroundColor:['.$bg3.']} ]};';
                //$jscript3=substr($jscript3,0,-1);
                   $jtop10agent.='var barOptions = {tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            return "Total Amount : " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
                                return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;});
                                                 }
                                    }
                            }, legend: {display: false},
                         scales: {yAxes: [{ticks: 
                            {
                                ticks: {
                                    fontSize: 40
                                },
                             userCallback: function(value, index, values)
                                {
          
                                    value = value.toString();
                                    value = value.split(/(?=(?:...)*$)/);
                                    value = value.join(".");
                                    return "" + value;
                                }
                            }
                        }],xAxes: [{gridLines:{display: false}}] }};';
                        $jtop10agent.='Chart.defaults.global.responsive = true;Chart.defaults.global.maintainAspectRatio = false;';
                $jtop10agent.='var ctx=document.getElementById("barAptAmtAgent").getContext("2d");new Chart(ctx,{type:"bar",data:barData,options:barOptions});';


            }

        //e-----------------------n--------------------------d//

            $content = array(   'jsp'=>$jsp,
                                'jsp2'=>$jsp2,
                                'js1'=>$pie1,
                                'js2'=>$pie2,
                                'js3'=>$pie3,
                                'js4'=>$pie4,
                                'listproduct'=>$dt1,
                                'Top10Agent'=>$dttop,
                                'jtop10agent'=>$jtop10agent,
                                'js8'=>$jscript8,
                                'js9'=>$jscript9,
                                'js10'=>$jscript10,
                                'js11'=>$jscript11,
                                'js12'=>$jscript12,
                                'js13'=>$jscript13,
                                'js14'=>$jscript14,
                                'js15'=>$jscript15,
                                'js16'=>$jscript16,
                                'js17'=>$jscript17,
                                'js18'=>$jscript18,
                                'js19'=>$jscript19,
                                'js20'=>$jscript20,
                                'js21'=>$jscript21,
                                'js22'=>$jscript22,
                                'js23'=>$jscript23,
                                'js24'=>$jscript24,
                                'js25'=>$jscript25,
                                'js26'=>$jscript26,
                                'js27'=>$jscript27,
                                'js28'=>$jscript28,
                                'js29'=>$jscript29,
                                'js30'=>$jscript30,
                                'js31'=>$jscript31,
                                'js32'=>$jscript32,
                                'js33'=>$jscript33,
                                'js34'=>$jscript34,
                                'js35'=>$jscript35,
                                'js36'=>$jscript36,
                                'data_project'=>$this->project_list($project)
                                );
            $this->load_content_top_menu('dash_sales/grafiknove',$content);
            return;
        }

        $tabel2 = 'v_cfs_user_project';
        $kriteria2 = array(
            'entity_cd'=>$entity,
            'userid'=>$name);

        $datalist2 = $this->m_wsbangun->getData_by_criteria_cons($cons,$tabel2, $kriteria2);
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
    public function project_list($project=''){
        $userid = $this->session->userdata('Tsname');
        $sql = "SELECT distinct project_no,descs from mgr.v_cfs_user_project (nolock) where userid= '$userid'";
        $proDescs = $this->m_wsbangun->getData_by_query($sql);
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
        $cons = $this->session->userdata('Tscons');
        
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
            'entity_cd'=>$entity,
            'userid'=>$name);

        $datalist2 = $this->m_wsbangun->getData_by_criteria_cons($cons,$tabel2, $kriteria2);
        
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
        $pgBilling = create_paging($this, $pageset, 4, $offset, base_url('dash/index/billing/'), $cnBilling);
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
        $pgTicket = create_paging($this, $pageset, 4, $offset, base_url('dash/index/ticket/'), $cnTicket);
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
        $this->load_content('dash/index',$allList);
    }

    public function ambildata(){

        $data = $this->m_wsbangun->getData('v_nup_group_leadbatam');

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
                    $res = $this->m_wsbangun->getData_by_query($sql);

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