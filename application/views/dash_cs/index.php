<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/charts/chartist.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/charts/chartist.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/charts/chartist-plugin-tooltip.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/colors/palette-gradient.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/charts/chartist.css')?>">
<style type="text/css">
.col-half-offset{
    margin-left:3.166666667%
}
#graphtype .ct-series-a .ct-bar
{
    stroke: url(#bartype1);
}

#graphtype .ct-series-a .ct-slice-pie
{
    fill: #843cf7;
}
#graphtype .ct-series-b .ct-bar
{
    stroke: url(#bartype2);
}

#graphtype .ct-series-b .ct-slice-pie
{
    fill: #f6adb1;
}
#graphcust .ct-series-a .ct-bar
{
    stroke: url(#barcust1);
}

#graphcust .ct-series-a .ct-slice-pie
{
    fill: #f6adb1;
}
/*#graphprior .ct-series-a .ct-bar
{
    stroke: url(#barprior1);
}

#graphprior .ct-series-a .ct-slice-pie
{
    fill: #f6adb1;
}*/
#graphprior .ct-series-a .ct-bar:nth-of-type(4n+1)
{
    stroke: url(#barprior1);
}

#graphprior .ct-series-a .ct-slice-pie:nth-of-type(4n+1)
{
    fill: #4e7c43;
}

#graphprior .ct-series-a .ct-bar:nth-of-type(4n+2)
{
    stroke: url(#barprior2);
}

#graphprior .ct-series-a .ct-slice-pie:nth-of-type(4n+2)
{
    fill: #ff9d00;
}
#graphprior .ct-series-a .ct-bar:nth-of-type(4n+3)
{
    stroke: url(#barprior3);
}

#graphprior .ct-series-a .ct-slice-pie:nth-of-type(4n+3)
{
    fill: #ff2626;
}


</style>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-6 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title"><?php echo $projectName; ?></h3>
      </div>
      <div class="content-header-right col-md-6 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title" ><span id="txtTime" class="pull-right"></span></h3>
      </div>
    </div>
    <div class="content-body"> 
<!-- start of content -->
      <div class="row"> 
        <div class="col-md-8">
          <div class="row">
            <div class="col-lg-6">
                <div class="card" id="divtype">
                    <div class="card-header">
                        <h4 class="card-title">Ticket by Type</h4>
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse">
                                        <i class="ft-minus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a onclick="reload_graph('divtype')">
                                        <i class="ft-rotate-cw"></i>
                                    </a>
                                </li>
                          
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                           
                            <div id="graphtype" class="height-400 BarChartShadow"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card" id="divcust"> 
                    <div class="card-header">
                        <h4 class="card-title">Ticket by Customer</h4>
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse">
                                        <i class="ft-minus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a  onclick="reload_graph('divcust')">
                                        <i class="ft-rotate-cw"></i>
                                    </a>
                                </li>
                           
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body" >
                           
                            <div id="graphcust" class="height-400 BarChartShadow"></div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
                <div class="card" id="divprior">
                    <div class="card-header">
                        <h4 class="card-title">Ticket by Priority</h4>
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse">
                                        <i class="ft-minus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a  onclick="reload_graph('divprior')">
                                        <i class="ft-rotate-cw"></i>
                                    </a>
                                </li>
                          
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                           
                           <div id="graphprior" class="height-400 BarChartShadow"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card" id="divcate">
                    <div class="card-header">
                        <h4 class="card-title">Ticket by Category</h4>
                        <a class="heading-elements-toggle">
                            <i class="la la-ellipsis-v font-medium-3"></i>
                        </a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li>
                                    <a data-action="collapse">
                                        <i class="ft-minus"></i>
                                    </a>
                                </li>
                                <li>
                                    <a  onclick="reload_graph('divcate')">
                                        <i class="ft-rotate-cw"></i>
                                    </a>
                                </li>
                        
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                           
                            <div class="table-responsive">
          
                        <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" >
                                       
                            <thead>
                                <th>Category</th>
                                <th style="text-align: right">Total</th>
                                
                            </thead>
                            <tbody>
                                <?php 
                                $color = ['','#6F213F','#F2D388','#C98474','#3490DC','#20504F','#FF851B','#1F9D55','#FFB6C1','#CD5C5C','#F08080','#FFA07A','#FA8072','#B22222','#6F213F','#F2D388','#C98474','#3490DC','#20504F','#FF851B','#1F9D55','#FFB6C1','#CD5C5C','#F08080','#FFA07A','#FA8072','#B22222','#6F213F','#F2D388','#C98474','#3490DC','#20504F','#FF851B','#1F9D55','#FFB6C1','#CD5C5C','#F08080','#FFA07A','#FA8072','#B22222','#6F213F','#6F213F','#F2D388','#C98474','#20504F','#FF851B','#1F9D55','#FFB6C1','#CD5C5C','#F08080','#FFA07A','#FA8072','#B22222','#6F213F','#F2D388','#C98474','#3490DC','#20504F','#FF851B','#1F9D55','#6F213F','#F2D388','#C98474','#F08080','#FFA07A','#FA8072','#B22222'];
                                $no=1; $a ='';
                                if(!empty($dtcate)){
                                   
                                    foreach ($dtcate as $key => $value) {
                                        
                                        $a.='<tr>';
                                          $a.='<td>';
                               
                                          $a.='<span class="btn btn-sm btn-glow round" style="background-color:'.$color[$no].'; color:white">'.$value->descs.'</span>';
                                          $a.='</td>';
                                          // echo $color[$no];
                                          $a.='<td style="text-align: right">';
                                          $a.= $value->total;
                                          $a.='</td>';
                                        $a.='</tr>';
                                        $no++;
                                        

                                    }
                                    // exit();
                                }else{
                                     $a.='<tr>';
                                          $a.='<td colspan="2">';
                                      
                                          $a.='No Data Available';
                                          $a.='</td>';

                                        $a.='</tr>';
                                }
                                     echo $a;
                                ?>
                            </tbody>
                        </table>
                      </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div id="with-header" class="card">
                  <div class="card-header">
                      <h4 class="card-title">Recent activities</h4>
                  </div>
                  <div class="card-content " >
                      <div class="card-body border-top-blue-grey border-top-lighten-5 " style="padding-left: 10px;padding-right: 10px;">
                         <div class="scrollable-container" style="position: relative; height: 910px!important;margin-right: -10px;">
                           <ul class="list-unstyled  base-timeline activity-timeline mt-3" style="margin-left: 20px;margin-right: 20px;margin-top: 0px!important;">
                           <div id="div_notif">
                           <?php echo $divactiv?>
                           </div>
                        </ul>
                         </div>
                        
                      </div>
                      
                  </div>
              </div>
        </div>
      </div>
<!--       <div class="row" style="margin: auto 0;">

          <div class="col-md-2 col-half-offset">
            <div class="card pull-up btn btn-bg-gradient-x-purple-blue">
                <div class="card-content">
                    <div class="media-body">
                      <i class="icon-social-dropbox icon-opacity font-large-4"></i>
                        <h1 style="color: white">Open</h1>
                    </div>
                  
                </div>
            </div>
          </div>
          <div class="col-md-2 col-half-offset">
            <div class="card pull-up btn btn-bg-gradient-x-orange-yellow">
                <div class="card-content">
                    <div class="media-body">
                      <i class="la la-user-plus icon-opacity font-large-4"></i>
                        <h1 style="color: white">Assign</h1>
                    </div>
                  
                </div>
            </div>
          </div>
          <div class="col-md-2 col-half-offset">
            <div class="card pull-up btn btn-bg-gradient-x-blue-cyan">
                <div class="card-content">
                    <div class="media-body">
                      <i class="la la-spinner icon-opacity font-large-4"></i>
                        <h1  style="color: white">Process</h1>
                    </div>
                  
                </div>
            </div>
          </div>
          <div class="col-md-2 col-half-offset">
            <div class="card pull-up btn btn-bg-gradient-x-red-pink">
                <div class="card-content">
                    <div class="media-body">
                      <i class="la la-cut icon-opacity font-large-4"></i>
                        <h1  style="color: white">Modify</h1>
                    </div>
                  
                </div>
            </div>
          </div>
          <div class="col-md-2 col-half-offset">
            <div class="card pull-up btn btn-bg-gradient-x-blue-green">
                <div class="card-content">
                    <div class="media-body">
                      <i class="la la-list-alt icon-opacity font-large-4"></i>
                        <h1 style="color: white">Confirm</h1>
                    </div>
                  
                </div>
            </div>
          </div>

      
      </div> -->
<!-- end of content -->
    </div>
  </div>
</div>

<!-- <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/charts/chartist.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
var graphtype,graphcust,graphprior;
<?=$jstype?>
<?=$jscust?>
<?=$jsprior?>
//end of graphic
//reload graph
function reload_graph(div_id){

        $('#'+div_id).block({
            message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
        
if(div_id=='divtype'){
    var urlpost = "<?php echo base_url('customerservice/get_graphtype');?>";
}else if(div_id=='divcust'){
    var urlpost = "<?php echo base_url('customerservice/get_graphcust');?>";
}else if(div_id=='divprior'){
    var urlpost = "<?php echo base_url('customerservice/get_graphprior');?>";
}
$.ajax({  
      url : urlpost,
      type:"POST",
      async: true,
      data: {},
        dataType:"json",
        success:function(data){
            console.log(data);
            var resp = '{"labels":['+data.labels+'],"series":['+data.series+']}';
            var JSONObject = JSON.parse(resp);
            console.log(JSONObject.labels);
            console.log(JSONObject.series);

             $('#'+div_id).unblock();
    
             
             
             if(div_id=='divtype'){
                    graphtype.update({
                        labels:JSONObject.labels,
                        series:[
                            JSONObject.series
                            ]
                        });
                }else if(div_id=='divcust'){
                    graphcust.update({
                        labels:JSONObject.labels,
                        series:[
                            JSONObject.series
                            ]
                        });
                }else if(div_id=='divprior'){
                    graphprior.update({
                        labels:JSONObject.labels,
                        series:[
                            JSONObject.series
                            ]
                        });
                }

        },                    
        error: function(jqXHR, textStatus, errorThrown){
          $('#'+div_id).unblock();
         // swal('Information',textStatus+' Save : '+errorThrown,'warning');
        }
      });
      
           
     
}

//end of reload graph
// ini buat jam
window.onload = function() { jam(); }

 function jam() {
  var e = document.getElementById('txtTime'),
  d = new Date(), h, m, s;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());
  em = d.toLocaleDateString("en-en", {month: "long"});

  e.innerHTML = d.getDate() + ' ' + em + ' ' + d.getFullYear() + ' ' + h +':'+ m +':'+ s;

  setTimeout('jam()', 1000);
 }

 function set(e) {
  e = e < 10 ? '0'+ e : e;
  return e;
 }

// var activityDiv = document.getElementById('div_notif');
// const ps = new PerfectScrollbar(activityDiv);
 // end of jam
</script>


<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>