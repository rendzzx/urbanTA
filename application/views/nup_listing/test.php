<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/redist/when.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/core.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/graphics.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/mapimage.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/mapdata.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/areadata.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/areacorners.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/scale.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/maps/tooltip.js')?>"></script>
</head>
<body>
	<div class="floor-plans">
		<div class="plan">
		    <img src="<?=base_url('img/floorplan/siteplan0.png')?>" usemap="#floor-1" id="plan-img" class="plan-img" data-floor="1">
		    <map id="floor-1" name="floor-1">
		        <area shape="poly" data-key="sold" class="sold" alt="" title="" coords="251,282,266,202,159,164,163,129,96,119,84,184,161,249" href="#" target="">
		        <area shape="poly" data-key="reserve" class="reserve" alt="" title="" coords="299,155,369,149,468,231,444,271,434,280,376,282,353,307,319,319,279,311,256,293,269,198" href="#" target="">
		        <area shape="poly" data-key="free" class="free" alt="" title="" coords="154,161,152,121,177,99,207,80,197,58,197,46,215,37,241,21,253,32,263,48,272,59,276,76,277,96,287,92,293,104,304,123,307,136,316,155,309,172" href="#" target="">
		    </map>
		</div>
	</div>

	<script type="text/javascript">
		var map = $('#plan-img'),

	    render = new Array();

	    render["free"] = {
	        fillColor: '68f442',
	        strokeColor: '68f442',
	    };

	    render["sold"] = {
	        fillColor: 'f45942',
	        strokeColor: 'f45942',
	    };

	    render["reserve"] = {
	        fillColor: '5342f4',
	        strokeColor: '5342f4',
	    };

	map.mapster({        
	    onConfigured: function () {

	        $(this).parent().parent().find("area").each(function(){

	            var type = $(this).attr("data-key");                
	            $(this).mapster('set',true,render[type]);

	        })
	    },
	    onClick: function (data) {
	        if (this.href && this.href !== '#') {
	            window.open(this.href, '_self');
	        }
	    }

	});
	</script>

</body>
</html>




