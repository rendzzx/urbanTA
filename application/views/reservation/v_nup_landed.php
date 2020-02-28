
<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>
<style type="text/css">
body
{
    font-family: Arial, Helvetica;
    font-size: 12px;
}
h1
{
    padding-top: 4px; padding-bottom:4px;
    font-size: 13px;
    font-weight: bold;
}
input[type="text"]
{
    width:30px;
}
td
{
   padding: 6px;
   border: 1px solid black;
}
div.label
{
    clear:both;
    float:left;
    width:100px;
    height:24px;
    margin-top: 5px;
}
div.input
{
    float:left;
    height:24px;
    margin-top: 5px;
}

/*.btn:focus{
        background: red;
    */}
</style>

<!-- <script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script> -->
<script type="text/javascript" src="<?=base_url('js/plugins/maps/redist/when.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/core.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/graphics.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/mapimage.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/mapdata.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/areadata.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/areacorners.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/scale.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/maps/tooltip.js')?>"></script>

<!-- <script type="text/javascript" src="<?=base_url('js/plugins/datamaps/datamaps.all.min.js')?>"></script> -->
<!-- <link rel="stylesheet" href="js/plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
<!-- <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script> -->
   <div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
      <div class="form-group">
        <!-- <div class="tittle-top pull-left"><?php echo $project_name ?></div> -->
        <div class="judulprojek"><?php echo $project_name ?></div>
        
      </div>
    </section><br>         
      <section class="content">    
      <div class="row">      
        <div class="col-xs-12" style="padding-right: 0px;padding-left: 0px;">        
            <div class="ibox-content" style="padding-right: 10px;padding-left: 10px;">
				<div class="form-group">
					<label for="test" class="col-sm-1 control-label"></label>
					
					<section class="content-header">
					  
					  <div class="pull-right">
            <a href="<?php echo $backurl;?>" class="btn abu-bg btn-sm">Back</a> 
						<button id="btnclear" name="btnclear"  type="button" class="btn btn-danger btn-sm">Clear Unit</button> &nbsp;
						<!-- <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-success btn-sm">Process Chosen Units</button> -->
					   
						 
					  </div>                
					</section>
				  </div>
				<!-- <div class="box-body">             -->
				 <div class="form-group">
				  <label for="pl_project" class="col-sm-2 control-label">Property Type</label>
                  <label for="pl_project" class="col-sm-4 control-label"><?php echo $property_type?></label>
				   
					<div class="form-group">
						
						  <!-- <select name="pl_property" id="pl_property" data-placeholder="Choose a Project..." class="select2 col-sm-4"  style="width:50%;" tabindex="2">
							<option value=""></option>
							<?php echo $property_type; ?>  
						  </select> -->
						  
						
					  </div> 
					  <div class="form-group" style="display: none;">
            
					  <label for="pl_project" class="col-sm-2 control-label" style="clear: left;font-size: 13px">Unit</label> 
					  <div class="pull-left">
						<input class="form-control" name="lotno_4" id="lotno_4" style="border:none; background-color:white;color:#ec0303;font-weight: bold;width: 500px" readonly="readonly">
            <input type="hidden" class="form-control" name="add" id="add" style="border:none; background-color:white;" readonly="readonly">
            <input type="hidden" class="form-control" name="pay" id="pay" style="border:none; background-color:white;width: 500px" readonly="readonly">
					  </div>
            

					
				</div>
				
				
				
				<br><br> <br>
				 
				<div class="pull-left" style="margin-left: 0px;">
				  <font color="red"><i>Click on this image to see details.</i></font>
				</div> 
				  <?php 
				  if (!empty($pcd)) {
					  
				  ?>    
				<div id="MAP" class="box-body" style="overflow-x: scroll; width:100%;">
					<div id="map_demo"> 
					  
					   
						<div style="width:100%; overflow-x: scroll;height:80%; border:2px solid #c7c9cc; float:left; position:relative; ">
						
						<img style="width:100%;" id="usa_image" src="<?php echo base_url($map_picture);?>" usemap="#usa" >
						</div>
					   
						<div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" hidden></div>

						<div style="clear:both; height:8px;"></div>
							
						<div>
							
							<button id="make-small" name="make-small" type="button" class="btn btn-primary btn-sm">Fit Screen</button>
							 <button id="make-big" name="make-big"  type="button" class="btn btn-primary btn-sm">Actual Size</button>
						</div>
						
							 
							
					</div>
			   
				</div>
				<?php 
					}
				?>
            
            
            
            </div>
        </div>      
      </div>         
    </section>

    
  </div>
  

 <form id ="frmEditor" class="form-horizontal">
 <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>
</form>

<script type="text/javascript">
console.log('uchihahaha');
// $('#pl_property').select2();

    if (window.Zepto) {
        jQuery = Zepto;
        (function ($) {
            if ($) {
                $.fn.prop = $.fn.attr;
            }
        } (jQuery));
    }

    $(document).ready(function () {

        $('#btnclear').click(function(e){

          


          var property_cd = $('#pl_property').val();

          swal({
            title: "Are you sure?",
            text: "You will lose unit that is already chosen!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Clear",
            closeOnConfirm: false
          },
          function(){
           
            $('#lotno_4').val('');
           
            txt = [];
             
            
            bindlinks();
            $usamap.mapster(default_options); 
            swal('Information','Clear success','success');
          });
            
        });

       
       
        
        var $statelist, $usamap, ratio,
        mapsterConfigured = function () {
            // set html settings values
            
            var opts = $usamap.mapster('get_options', null, true);
            if (!ratio) {
                ratio = $usamap.width() / $usamap.height();
            }
            $('#stroke_highlight').prop("checked", opts.render_highlight.stroke);
            $('#strokewidth_highlight').val(opts.render_highlight.strokeWidth);
            $('#fill_highlight').val(opts.render_highlight.fillOpacity);
            $('#strokeopacity_highlight').val(opts.render_highlight.strokeOpacity);
            $('#stroke_select').prop("checked", opts.render_select.stroke);
            $('#strokewidth_select').val(opts.render_select.strokeWidth);
            $('#fill_select').val(opts.render_select.fillOpacity);
            $('#strokeopacity_select').val(opts.render_select.strokeOpacity);
            $('#mouseout-delay').val(opts.mouseoutDelay);
            $('#img_width').val($usamap.width());
        },
        
        default_options =
        {
            fillOpacity: 0.5,
            render_highlight: {
                fillColor: '2aff00',                
                stroke: true
            },
            render_select: {
                fillColor: 'ff000c',
                stroke: false
            },
            //render_zoom: {
            //    altImage: 'images/usa_map_huge.jpg'
            //},
            mouseoutDelay: 0,
            fadeInterval: 50,
            isSelectable: true,
            singleSelect: false,
            // mapKey: 'state',
            mapKey: 'unit',
            mapValue: 'full',
            listKey: 'name',
            listSelectedAttribute: 'checked',
            sortList: "asc",
            onGetList: addCheckBoxes,
            onClick: function (e) {
               styleCheckbox(e.selected, e.listTarget);
               if (!utils.isScrolledIntoView(e.listTarget, false, $statelist)) {
                   utils.centerOn($statelist, e.listTarget);
               }
               selected = true;

               $('#'+e.key).prop('checked', selected);
               
            },
            onConfigured: mapsterConfigured,
            // showToolTip: true,
            toolTipClose: ["area-mouseout"],
            areas:[ <?php echo $keyarea; ?> ] 
        };

        function styleCheckbox(selected, $checkbox) {
            var nowWeight = selected ? "bold" : "normal";
            $checkbox.closest('div').css("font-weight", nowWeight);
        }
        
        function addCheckBoxes(items) {
            // console.log(items);
            // console.log('2');
            var item, selected;
            $statelist.children().remove();
            for (var i = 0; i < items.length; i++) {
                selected = items[i].isSelected();
                item = $('<div><input type="checkbox" id="'+ items[i].key +'" name="' + items[i].key + '" ' + (selected ? "checked" : "") + '><span class="sel" key="' + items[i].key + '">' + items[i].value + '</span></div>');

                $statelist.append(item);
            }
            $statelist.find('span.sel').unbind('click').bind('click', function (e) {
                var key = $(this).attr('key');
                // $usamap.mapster('highlight', true, key);
                $usamap.mapster('highlight', true, KEY);
            });
            // return the list to mapster so it can bind to it
            return $statelist.find('input[type="checkbox"]').unbind('click').click(function (e) {
                var selected = $(this).is(':checked');
                $usamap.mapster('set', selected, $(this).attr('name'));
                styleCheckbox(selected, $(this));
            });
        }


        $statelist = $('#statelist');
        $usamap = $('#usa_image');

        function bindlinks() {
            // console.log('bindlinks');
            // $('*').unbind();
            $("#unbind_link").bind("click", function (e) {
                e.preventDefault();
                $usamap.mapster("unbind");
                $usamap.width(720);
                bindlinks();
            });
            $("#rebind_link").bind("click", function (e) {
                console.log('rebind_link');
                e.preventDefault();
                $usamap.mapster(default_options);
            });

            $("#unbind_link_preserve").bind("click", function (e) {
                e.preventDefault();
                $usamap.mapster("unbind", true);
                bindlinks();
            });
            $("#tooltip").bind("click", function (e) {
                e.preventDefault();
                var state = !$usamap.mapster('get_options').showToolTip;
                $('#tooltip_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { showToolTip: state });
            });
            $("#show_selected").bind("click", function (e) {
                e.preventDefault();
                $('#selections').text($("#usa_image").mapster("get"));
            });
            $("#single_select").bind("click", function (e) {
                e.preventDefault();
                var state = !$usamap.mapster('get_options').singleSelect;
                $('#single_select_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { singleSelect: state });
            });
            $("#is_deselectable").bind("click", function (e) {
                e.preventDefault();
                var state = !$usamap.mapster('get_options').isDeselectable;
                $('#is_deselectable_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { isDeselectable: state });
            });
                

            $('#make-small').bind('click',function() {
                $('#usa_image').mapster('resize', 720, 0, 450);
            });
            $('#make-big').bind('click',function() {
                $('#usa_image').mapster('resize', 1000, 0, 1000);
            });
            $('#make-any').bind('click',function() {
                $('#usa_image').mapster('resize', $('#new-size').val(), 0, 1000);
            });


            function getSelected(sel) {
                var item=$();
                sel.each(function() {
                    if (this.selected) {
                        item=item.add(this);
                        return false;
                    }

                });
                return item;

            }

            function getFillOptions(el) {
                var new_options,
                    val = getSelected($(el).find("option")).val();
                    new_options = {
                        altImage: null,
                        stroke: false
                    };
                return new_options;
            }

            function getNewOptions() {
                var options,
                    render_highlight = getFillOptions($('#highlight_style')),
                    render_select = getFillOptions($('#select_style'));

                options = $.extend({},
                    default_options,
                    {
                        render_select: render_select,
                        render_highlight: render_highlight
                    });

                return options;
            }

            $("#highlight_style, #select_style").bind("change", function (e) {
                e.preventDefault();
                $statelist.children().remove();

                $usamap.mapster(getNewOptions());
            });

            $("#update").click(function (e) {
                var newOpts = {};
                function setOption(base, opt, value) {
                    if (value !== '' && value !== null) {
                        base[opt] = value;
                    }
                }
                e.preventDefault();

                newOpts.render_highlight = {};
                setOption(newOpts.render_highlight, "stroke", $('#stroke_highlight').prop("checked"));

                setOption(newOpts.render_highlight, "strokeWidth", $('#strokewidth_highlight').val());
                setOption(newOpts.render_highlight, "fillOpacity", $('#fill_highlight').val());
                setOption(newOpts.render_highlight, "strokeOpacity", $('#strokeopacity_highlight').val());

                newOpts.render_select = {};
                setOption(newOpts.render_select, "stroke", $('#stroke_select').prop("checked"));
                setOption(newOpts.render_select, "strokeWidth", $('#strokewidth_select').val());
                setOption(newOpts.render_select, "fillOpacity", $('#fill_select').val());
                setOption(newOpts.render_select, "strokeOpacity", $('#strokeopacity_select').val());
                setOption(newOpts, "mouseoutDelay", $('#mouseout-delay').val());
                var width = parseInt($('#img_width').val(), 10);

                if ($usamap.width() != width) {
                    $('#update').prop("disabled",true);
                    $usamap.mapster('resize', width, null, 1000,function() {
                        $('#update').prop("disabled",false);
                    });
                } else {
                    $usamap.mapster('set_options', newOpts);
                }
            });
        }

        bindlinks();
        
        $usamap.mapster(default_options);
    });


           // Utility functions
           // If you are copying code you probably won't need these.


           var utils = {};
           // Tells if an element is completely visible. if the 2nd parm is true, it only looks at the top.

           utils.isScrolledIntoView = function (elem, topOnly, container) {
               var useWindow = false, docViewTop, docViewBottom, elemTop, elemBottom;

               if (!container) {
                   container = window;
                   useWindow = true;
               }


               if (useWindow) {
                   docViewTop = $(container).scrollTop();
                   elemTop = elem.offset().top;
               } else {
                   docViewTop = 0;
                   elemTop = elem.position().top;
               }
               docViewBottom = docViewTop + $(container).height();
               elemBottom = elemTop + elem.height();


               if (topOnly) {
                   return elemTop >= docViewTop && elemTop <= docViewBottom;
               } else {
                   return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom));
               }
           };

           utils.centerOn = function ($container, $element) {
               $container.animate({
                   scrollTop: $element.position().top - ($container.height() / 2)
               }, 'slow');
           };

 $('#pl_property').on("change",function(e){
    
 	var property_cd = $('#pl_property').val();
  console.log(property_cd);

    var urrri ='';
    var pathArray = window.location.pathname.split( '/' );
    for (i = 0; i < pathArray.length; i++) {
        if(i>5){
          urrri += pathArray[i]+'/';
          // console.log(pathArray[i]);
        }
    }
    // console.log(urrri);
    urrri = urrri.substring(0,urrri.length-1);
    // console.log(urrri);
    // console.log(pathArray);
 	// return;

    window.location.href = "<?php echo base_url('c_nup_landedAgentNew/indextipe');?>"+"/"+property_cd+"/"+urrri;
   
 });

 
       

    function openPage(entity,project,pcd,level){
      
        window.location.href="<?php echo base_url('c_reservation/indexland/')?>"+entity+"/"+project+"/"+pcd+"/"+level;
     
        
    }
</script>


 <map id="usa_image_map" name="usa">
        
        <?php echo $dataarea; ?>
    </map>



  


