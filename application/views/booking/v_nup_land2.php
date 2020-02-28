

<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
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

<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/redist/when.js')?>"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/core.js')?>"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/graphics.js')?>"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/mapimage.js')?>"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/mapdata.js')?>"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/areadata.js')?>"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/areacorners.js')?>"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/scale.js')?>"></script>
<script type="text/javascript" src="<?=base_url('plugins/maps/tooltip.js')?>"></script>
<link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<!-- <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script> -->
   <div class="content-wrapper">
    <section class="content-header">
      <div class="form-group">
        <div class="tittle-top pull-left"><?php echo $project_name ?></div>
        <div class="tittle-top pull-right">Choose Unit </div>  
      </div>
    </section>
         
      <section class="content">    
      <div class="row">      
        <div class="col-xs-12">        
          <div class="box">
            <div class="box-body">            
             <div class="form-group">
              <label for="pl_project" class="col-sm-2 control-label">Property Type</label>               
                <!-- <section class="content-header"> -->
                  <div class="form-group">
                    <div class="pull-left">
                      <select name="pl_property" id="pl_property" data-placeholder="Choose a Project..." class="chosen-select" style="width:250px;" tabindex="2">
                        <option value=""></option>
                        <?php echo $property_type; ?> 
                        <input type="hidden" name="nupno" id="nupno" value="<?php echo $NupNO?>"/>    
                      </select> 
                    </div>
                  </div>                 
                 <!--  <div class="pull-right">
                    <span id="time"></span>
                  </div> -->                  
                <!-- </section>                         -->
            </div>
            <div class="form-group">
                            
              <!-- <section class="content-header"> -->
                
              <!-- </section> -->
            </div>
            <div class="form-group">
              <label for="test" class="col-sm-1 control-label"></label>
              
              <section class="content-header">
                <div class="form-group">
                  
                </div>
                <div class="pull-right">
                  <button id="btnclear" name="btnclear" onclick="reset(this)" type="button" class="btn bg-orange btn-sm">Clear</button>
                  <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-danger btn-sm">Process</button>
                  <!-- <button id="btnsubmit" name="btnsubmit" onclick="close(a)" type="button" class="open-AddBookDialog btn btn_block btn-success">Close</button> -->
                  <a href="<?=base_url('c_nup_dt/list_dt/')?>/<?php echo $NupNO?>/1" class="btn bg-orange btn-sm">Back</a>  
                </div>                
              </section>
            </div>
            <br><br> 
              <!-- <div id="load" hidden="true"></div> -->
              <!-- <div id="isiTable"> -->
                <!-- <table id="table1" class="table table-bordered table-hover dataTable"> -->
            <!--     <table id="table1" class="table table-hover dataTable">
                <tr>
                    <th class="col-xs-1">Landed</th>
                    </tr>
                   
				</table>
                <thead> -->
                <!-- <body> -->
                  
              <?php 
              if (!empty($pcd)) {
                  
              ?>    
            <div id="MAP" class="box-body" style="overflow-x: scroll;">
                <div id="map_demo" style="width:920px; ">    
                    <div style="width:720px; border:0; overflow: hidden; float:left;">      
                        

                    <!-- <img style="width:800px;border:0;" id="usa_image" src="<?php echo base_url();?><?php echo $map_picture;?>" usemap="#usa" > -->

                    <img style="width:800px;border:0;" id="usa_image" src="<?php echo base_url($map_picture);?>" usemap="#usa" >
                    </div>
                    <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;"></div>

                    <div style="clear:both; height:8px;"></div>
                    <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-plus"></i></button>
              </div>
                    <div>
                        <div style="clear:both;"></div> 
                        <input id="update" type="submit" value="Update">
                        <input type="button" value="Realod" id="test" onclick="test_klik()">
                        <br><br>
                        <div>
                            <a id="show_selected" href="#">Click here to show selected items:</a>
                            <span id="selections"></span>    
                        </div>
                    </div>
                </div>
           
            </div>
            <?php 
                }
            ?>
            
            
              <!-- </div> -->
              <!-- </body> -->
              <!-- </thead> -->
              
            </div>
            <div class="box-footer">
             <!--  <a href="<?php echo base_url("userlevel/entryForm"); ?>"><i class="fa fa-plus"> New Record </i></a> -->
            </div>
          </div>
        </div>      
      </div>         
    </section>

    
  </div>
  <?php
  ?>
<!-- <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_nup_unit/validasi" enctype="multipart/form-data">

 -->
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
var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:false},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }

// function ambilfoto(){
//     var foto = $this->
// }

function test_klik(){
    $('#1011').prop('checked', true);
}


    if (window.Zepto) {
        jQuery = Zepto;
        (function ($) {
            if ($) {
                $.fn.prop = $.fn.attr;
            }
        } (jQuery));
    }

    $(document).ready(function () {

        // $('#btnReload').on('click', function(){

        // });

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
        // var area = '<?php echo $keyarea; ?>';
        //     console.log(area);
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
               // console.log(e.key);
               // console.log(e);
               // console.log('1');
               //  if (e.key==='OH') {
               //     $usamap.mapster('zoom','OH');
               //      return false;
               //  }
               // return true;
            },
            onConfigured: mapsterConfigured,
            showToolTip: true,
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
                $usamap.mapster('highlight', true, key);
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

     //            if (val > "0") {
     //                new_options = {
                    //  altImage: 'images/usa_map_720_alt_' + val + '.jpg',
                    //  stroke: true
                    // };
     //            } else {
                    new_options = {
                        altImage: null,
                        stroke: false
                    };
                // }
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
    var nupno = $('#nupno').val();
 	console.log(property_cd);
    console.log(nupno);
 	// document.getElementById('load').hidden=false;

 	// if(property_cd!==''){

  //   }
    // $('#MAP').load( "<?php echo base_url('c_nup_landed/indextipe');?>"+"/"+property_cd+"/"+property_cd+" #MAP" );

    window.location.href = "<?php echo base_url('c_nup_landed/indextipe');?>"+"/"+nupno+"/"+property_cd+"";

    // window.location.href = "<?php echo base_url('c_nup_landed/indextipe');?>"+"/"+property_cd+"/"+property_cd+"";
 });  

                // $("#pl_property").on("change"
                //     function(e){
                        
                //         window.location.href = "<?php echo base_url('c_nup_landed/indextipe/');?>"+"/"+property_cd+"/"+property_cd+" #MAP";
                //     }
                // );        

</script>

 <map id="usa_image_map" name="usa">
        
        <?php echo $dataarea; ?>
    </map>



  


