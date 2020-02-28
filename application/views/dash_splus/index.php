<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/charts/chartist.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/charts/chartist.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/charts/chartist-plugin-tooltip.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/colors/palette-gradient.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/charts/chartist.css')?>">
<style type="text/css">
#graphgroup .ct-series-a .ct-bar
{
    stroke: url(#bar1);
}

#graphgroup .ct-series-a .ct-slice-pie
{
    fill: #843cf7;
}
#graphdevice .ct-label{
	color:white!important;
	fill:white!important;
	/*font-size: 14px!important;*/
}

</style>
<div class="app-content content">
	 <div class="content-wrapper">
	    <div class="content-wrapper-before"></div>
	    <div class="content-header row">
	      <div class="content-header-left col-md-6 col-12 mb-2">
	        <br><br>
	        <h3 class="content-header-title" style="color: #ffffff !important"><?php echo $projectNamee; ?><br>S+</h3>
	      </div>
	      <div class="content-header-right col-md-6 col-12 mb-2">
	        <br><br>
	        <h3 class="content-header-title" ><span id="txtTime" class="pull-right"></span></h3>
	      </div>
	    </div>
	    <div class="content-body"> 
	    	<div class="row">
	            <div class="col-lg-4">
	                <div class="card pull-up" id="divtype">
	                    <div class="card-header">
	                        <h4 class="card-title">S+ Users</h4>
	                        <a class="heading-elements-toggle">
	                            <i class="la la-ellipsis-v font-medium-3"></i>
	                        </a>
	                     
	                    </div>
	                    <div class="card-content" style="height: 442px;">
			                <div class="card-body text-center">
			                	<br><br>
			                    <div class="card-header pt-0 pb-0">
			                        <p class="danger darken-2">Total Active Users</p>
			                        <h3 class="display-4 blue-grey lighten-2"><?php echo number_format($active_users)?></h3>
			                    </div>
			                    <div class="card-content">
			                        <div id="new-customers" class="height-150 donutShadow">  </div>
			             <!--            <ul class="list-inline clearfix mt-2">
			                            <li>
			                                <h1 class="blue-grey lighten-2 text-bold-400">  </h1>
			                                <span class="danger darken-2">
			                                    </span>
			                            </li>
			                        </ul> -->
			                    </div>
			                </div>
			            </div>
	                </div>
	            </div>
	            <div class="col-lg-8">
	                <div class="card pull-up" id="divtype">
	                    <div class="card-header">
	                        <h4 class="card-title">S+ Users by Device</h4>
	                        <a class="heading-elements-toggle">
	                            <i class="la la-ellipsis-v font-medium-3"></i>
	                        </a>
	                   
	                    </div>
	                    <div class="card-content collapse show">
	                        <div class="card-body">
	                           
	                            <div id="graphdevice" class="height-400 BarChartShadow"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
          	</div>
	    	<div class="row">
	            <div class="col-lg-12">
	                <div class="card pull-up" id="divtype">
	                    <div class="card-header">
	                        <h4 class="card-title">S+ Users by Group</h4>
	                        <a class="heading-elements-toggle">
	                            <i class="la la-ellipsis-v font-medium-3"></i>
	                        </a>
	                    </div>
	                    <div class="card-content collapse show">
	                        <div class="card-body">
	                           
	                            <div id="graphgroup" class="height-400 BarChartShadow"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
          	</div>
	    </div>
	</div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/charts/chartist.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
var graphgroup;
$(document).ready(function(){

	<?=$jsgroup?>
	<?=$jsdevice?>

	var newCustomers = new Chartist.Pie('#new-customers', {
        series: [100],
        labels: ['iOS']
    }, {
            donut: true,
            labelInterpolationFnc: function (value) {
                return '\ue9d7';
            },
            donutSolid: true,
            total: 100,
            donutWidth: 10,
        });

    newCustomers.on('draw', function (data) {
        if (data.type === 'label') {
            if (data.index === 0) {
                data.element.attr({
                    dx: data.element.root().width() / 2,
                    dy: (data.element.root().height() + (data.element.height() / 4)) / 2,
                    class: 'ct-label',
                    'font-family': 'feather'
                });
            } else {
                data.element.remove();
            }
        }
    });

    // For the sake of the example we update the chart every time it's created with a delay of 8 seconds
    newCustomers.on('created', function (data) {
        var defs = data.svg.querySelector('defs') || data.svg.elem('defs');
        defs.elem('linearGradient', {
            id: 'donutGradient5',
            x1: 0,
            y1: 1,
            x2: 0,
            y2: 0
        }).elem('stop', {
            offset: '0%',
            'stop-color': 'rgba(253,99,107,1)'
        }).parent().elem('stop', {
            offset: '95%',
            'stop-color': 'rgba(253,99,107, 0.3)'
        });
        return defs;


    });
});

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





function block(boelan,div){
        var block_ele = $(div);
        if (boelan==true) {
            $(block_ele).block({
                message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                fadeIn: 1000,
                fadeOut: 1000,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    backgroundColor: '#333',
                    marginLeft : 'auto'
                }
            });
        }
        else{
            $(block_ele).unblock()
        }
    }
</script>