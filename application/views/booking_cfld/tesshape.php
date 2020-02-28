<style type="text/css">
 #load{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
    ul#stepForm,
    ul#stepForm li {
        margin: 0;
        padding: 0;
    }
    
    ul#stepForm li {
        list-style: none outside none;
    }
    
    label {
        margin-top: 10px;
    }
    
    .help-inline-error {
        color: red;
    }
    /* .ScrollStyle
{
    max-height: 450px;
    overflow-y: scroll;
}*/
</style>
<link href="<?=base_url('css/plugins/blueimp/css/blueimp-gallery.min.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/blueimp/jquery.blueimp-gallery.min.js')?>"></script>

<script type="text/javascript" src="<?=base_url('js/plugins/maps/redist/when.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/core.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/graphics.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/mapimage.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/mapdata.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/areadata.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/areacorners.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/scale.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/tooltip.js')?>"></script>
<!-- <link rel="stylesheet" href="js/plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
  
    <div class="row border-bottom white-bg dashboard-header" style="background: rgba(145,16,16,1);

background: -moz-linear-gradient(top, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(145,16,16,1)), color-stop(0%, rgba(145,16,16,1)), color-stop(27%, rgba(247,8,8,1)), color-stop(70%, rgba(247,8,8,1)), color-stop(100%, rgba(145,16,16,1)));
background: -webkit-linear-gradient(top, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);
background: -o-linear-gradient(top, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);
background: -ms-linear-gradient(top, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);
background: linear-gradient(to bottom, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#911010', endColorstr='#911010', GradientType=1 );
 color: white;  box-shadow: 0 5px 10px 0 rgba(0, 0, 0,0.30), 0 15px 5px 0 rgba(0, 0, 0, 0.15);">
    <label class="control-label" style="font-size:15px;">Filter</label>
        <div class="form-group">            
            <div class="col-sm-12">
                <label for="pl_project" class="col-sm-2 control-label" style="font-size:15px;">Facing :</label>
                <div class="col-sm-10">
                    <select name="txtDirection" id="txtDirection" data-placeholder="Select Facing..." class="select2 form-control" tabindex="2">
                        <option value=""></option> 
                    </select> 
                </div>
                <!-- <span id="time"></span> -->
            </div>
            <div class="col-sm-12">
                <label for="pl_project" class="col-sm-2 control-label" style="font-size:15px;">Type :</label>
                <div class="col-sm-10">
                   <select name="txtType" id="txtType" data-placeholder="Select Type..." class="select2 form-control" tabindex="2">
                        <option value=""></option> 
                    </select> 
                </div>
                <!-- <span id="time"></span> -->
            </div>
            <div class="col-sm-12">
                <label for="pl_project" class="col-sm-2 control-label" style="font-size:15px;">Price :</label>
                <div class="col-sm-10">
                    <select name="txtPrice" id="txtPrice" data-placeholder="Select Price..." class="select2 form-control" tabindex="2">
                        <option value=""></option>                        
                    </select>
                </div>
                <!-- <span id="time"></span> -->
            </div>
            
             <div class="col-sm-12">
                <!-- <input type="button" align="rigth" name="btnS" id="btnNext" value="Process" class="btn btn-success btn-sm"> -->
                <a class="btn blue-bg pull-right" onclick="fn_search();" style=" width: auto">Search <i class="fa fa-search"></i></a>
                <a class="btn blue-bg pull-right" onclick="fn_Clearsearch();" style=" width: auto">Clear Filter</a>
            </div>
        </div>
    </div><br>
    <div class="row border-bottom white-bg dashboard-header">
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-2">
                    <label class="control-label">Legend</label>
                </div>
                <div class="col-sm-2"><img style="width:100%;" id="ap" src="<?php echo base_url('img/ap.png');?>"></div>
                <div class="col-sm-2"><img style="width:100%;" id="anp" src="<?php echo base_url('img/anp.png');?>"></div>
                <div class="col-sm-2"><img style="width:100%;" id="fb" src="<?php echo base_url('img/green.png');?>"></div>
                <div class="col-sm-2"><img style="width:100%;" id="fb" src="<?php echo base_url('img/fb.png');?>"></div>
            </div>
        </div>
    </div>
    
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="">                        
                        <!-- <br> -->
                        <div class="content">
                                <div class="panel-body row">
                                    <form name="basicform" id="basicform" class="form-horizontal" method="post" action="#">
                                        <!-- <div class="row"> -->
                                        <div class="box-body">
                                           
                                            <div class="col-sm-9"  style="">
                                                <label for="pl_Unit" class="col-sm-2 control-label">Unit :</label>
                                                <div class="col-sm-10">
                                                    <input type="hidden" name="lot_no2" id="lot_no2" width="100%" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly">
                                                    <!-- <input type="text" name="lot_descs" id="lot_descs" width="100%" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly"> -->
                                                    <textarea name="lot_descs" id="lot_descs" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;width:100%;" readonly="readonly" rows="2"></textarea>
                                                    <input type="hidden" class="form-control" name="lot_nox" id="lot_nox" style="border:none; background-color:white;width:80%;" readonly="readonly" >
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="pl_unit" class="col-sm-3 control-label">Unit :</label>
                                                <div></div>
                                            </div> -->

                                            <!-- <br> -->
                                            <!-- <div class="form-group"> -->
                                            <div class="col-sm-3" >
                                                <!-- <input type="button" name="btnClear" id="btnClear" value="Clear" onclick="Clear();" class="btn btn-danger btn-sm"> -->                                                
                                                <input type="button" name="btnBack" id="btnBack" value="Back" class="btn abu-bg btn-sm">
                                                <input type="button" name="btnNext" id="btnNext" value="Process" class="btn btn-success btn-sm">

                                            </div>

                                            <!-- </div> -->
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div style="margin-left: 0px;">
                                                        <i>Click on unit to booked.</i>
                                                    </div>
                                                   
                                                        <!-- <div id="MAP" class="box-body" style="overflow-x: scroll; width:100%;"> -->
                                                        <div id="MAP" class="box-body" style="width:100%;">
                                                            <div id="map_demo">

                                                                <div style="width:100%; overflow-x: scroll; border:2px solid #c7c9cc; float:left; position:relative; ">

                                                                     <!-- <img style="width:100%;" id="shapes" src="<?php echo base_url($map_picture);?>" usemap="#shapes_map">  -->
                                                                    <img style="width:100%;" id="shapes" src="http://www.outsharked.com/imagemapster/examples/images/shapes.jpg" usemap="#shapes_map">

                                                                <map id="shapes_map" name="shapes_map">
    <area shape="rect" data-group="rectangle" alt="" coords="378,39,463,116" nohref >
    <!-- <area shape="rect" data-group="rectangle" alt="" coords="1242,2547,1068,2954,1243,2795,1417,2954" nohref > -->
    <area shape="poly" data-group="blue-circle" alt="" coords="286,34, 298,42, 308,54, 
        314,79, 307,103, 292,118, 270,125, 242,122, 227,112, 216,97, 212,73, 219,53, 227,43,
        240,34, 264,29" href="#">

    <!-- concentric circles for stroke highlighting -->
    <area shape="circle" data-group="inner-circle,inner-circle-mask" coords="101,81,36" href="#">
    <area shape="circle" data-group="outer-circle-mask" coords="148,81,12" nohref >
    <area shape="circle" data-group="outer-circle" coords="100,81,59" href="#">
    <!-- End circles -->
                                                                </map>
                                                                </div>

                                                                <div id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" hidden="true" ></div>
                                                                <!-- hidden -->

                                                                <div style="clear:both; height:8px;"></div>

                                                                <div>

                                                                    <button id="make-small" name="make-small" type="button" class="btn btn-primary btn-sm">Fit Screen</button>
                                                                    <button id="make-big" name="make-big" type="button" class="btn btn-primary btn-sm">Actual Size</button>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                                 <div id="blueimp-gallery" class="blueimp-gallery">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div>  

                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">


    $(document).ready(function(e) {
        
     
    
    $('#shapes').mapster({
        noHrefIsMask: false,
        fillColor: '0a7a0a',
        fillOpacity: 0.7,
        mapKey: 'data-group',
        strokeWidth: 2,
        stroke: true,
        strokeColor: 'F88017',
        render_select: {
            fillColor: 'adadad'
            },
        areas: [
            {
                key: 'blue-circle',
                includeKeys: 'rectangle',
                stroke: false
            },
            {
                key: 'rectangle',
                stroke: true,
                strokeWidth: 3
            },
            {
                key: 'outer-circle',
                includeKeys: 'inner-circle-mask,outer-circle-mask',
                stroke: true
            },
            {
                key: 'outer-circle-mask',
                isMask: true,
                fillColorMask: 'ff002a'
            },
            {
                key: 'inner-circle-mask',
                fillColorMask: 'ffffff',
                isMask: true
            }
        ]
    });

    });

</script>

