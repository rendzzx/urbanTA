

<!-- <link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" /> -->
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
<link rel="stylesheet" href="js/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->
<!-- <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script> -->
   <div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
      <div class="form-group">
        <div class="tittle-top pull-left"><?php echo $project_name ?></div>
        <div class="tittle-top pull-right">Choose Unit</div>  
      </div>
    </section><br>
         
      <section class="content">    
      <div class="row">      
        <div class="col-xs-12">        
          <div class="ibox-content">
            <div class="box-body">            
             <!-- <div class="form-group">
              <label for="pl_project" class="col-sm-2 control-label">Property Type</label>
                  <div class="form-group">
                    <div class="pull-left">
                      <select name="pl_property" id="pl_property" data-placeholder="Choose a Project..." class="chosen-select" style="width:250px;" tabindex="2">
                        <option value=""></option>
                        <?php echo $property_type; ?> 
                        <input type="hidden" name="nupno" id="nupno" value="<?php echo $NupNO?>"/>    
                      </select> 
                    </div>
                  </div>
            </div> -->
            <div class="form-group">
                            
              <!-- <section class="content-header"> -->
                
              <!-- </section> -->
            </div>
            <div class="form-group">
              
              
              
            </div>
            <section class="content-header">
                
<!-- onclick="reset(this)" -->
                <div class="pull-right"> 
                  <!-- <button id="btnclear" name="btnclear"  type="button" class="btn abu-bg btn-sm">Clear</button> 
                  <button id="btnsubmit" name="btnsubmit" onclick="tes()" type="button" class="btn btn-success btn-sm">Process</button>
                  <button id="btnback" name="btnback" onclick="back()" type="button" class="btn abu-bg btn-sm">Back</button>-->
                  <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-success btn-sm">Process</button>
                  <button id="btnback" name="btnback" onclick="tes()" type="button" class="btn abu-bg btn-sm">Back</button>
                  <!-- <button id="btnsubmit" name="btnsubmit" onclick="close(a)" type="button" class="open-AddBookDialog btn btn_block btn-success">Close</button> -->
                  <!-- <a href="<?=base_url('c_nup_landed/indextipe/')?>/<?php echo $NupNO?>/<?php echo $pcd ?>/<?php echo $rowid_index?>/<?php echo $status_index?>/<?php echo $balance?>/<?php echo $RowHeader;?>/<?php echo $unit?>" class="btn abu-bg btn-sm">Back</a> -->
                  <!-- <a href="<?=base_url('c_nup_landed/indextipe/')?>/<?php echo $NupNO?>" class="btn bg-orange btn-sm">Back</a> -->
                   <!-- <button id="btnCancel" type="button" class="btn btn-danger">Cancel</button> -->
                </div>                
              </section>
              <label class="col-xs-1 control-label" style="height:34px;vertical-align: middle;padding: 6px 12px;font-size: 13px">Unit</label>
               <div class="form-group">
                         
                         
                         
                         
                         
                           <!-- <input type="text" class="form-control" name="name" id="contentnewsfeed" placeholder="Content newsfeed"> -->
                           <div class="pull-left" >
                            <input type="text" class="form-control" name="lot_no2" id="lot_no2" style="border:none; background-color:white;width:80%;" readonly="readonly" >
                            <input type="text" class="form-control" name="lot_nox" id="lot_nox" style="border:none; background-color:white;width:80%;" readonly="readonly" >
                            <input type="hidden" class="form-control" style="width:10%;" name="b_val" id="b_val" >
                            <!-- <?php echo $nup;?> -->
                            
                           </div>
                          
                </div>
            
            <br><br> <br>
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
                <div class="form-group"></div>
            <div class="pull-right">
                    <span id="time"></span>
                  </div>
            <div style="margin-left: 0px;">
              <i>Please choose unit from the picture below.</i>
            </div>
                  
          <!-- <div style="border:3px solid #8e8e8e"> -->
            <div id="MAP" class="box-body" style="overflow-x: scroll; width:100%;">
            <!-- <div id="MAP" class="box-body" style="width:100%;"> -->
                <div id="map_demo" style=" overflow-y: auto;"> 
                  
                    <!-- <div style="text-align:left; width:100%; height:100%; border:0; overflow: hidden; float:left; overflow:auto; position:relative;"> -->
                   <div style="width:100%; overflow-x: scroll;height:100%; border:2px solid #c7c9cc; float:left; position:relative; ">

                    <img style="width:100%;" id="usa_image" src="<?php echo base_url();?><?php echo $map_picture;?>" usemap="#usa" >

                    <!-- <img style="width:850px;height:580px; border:0;" id="usa_image" src="<?php echo base_url($map_picture);?>" usemap="#usa" > -->
                    </div>
                    <!-- <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" type="hidden"></div> -->
                    <!-- <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" type="hidden"></div> -->
                    <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" hidden></div>

                    <div style="clear:both; height:8px;"></div>
                        

                    <div>
                        <!-- <div style="clear:both;"></div> --> 
                        <!-- <input id="update" type="submit" value="Update">
                        <input type="button" value="Realod" id="test" onclick="test_klik()"> -->
                        
                        
                    </div>
                       <!--  <button id="make-small" name="make-small" type="button" class="btn btn-primary btn-sm">Fit Screen</button>
                         <button id="make-big" name="make-big"  type="button" class="btn btn-primary btn-sm"  >Actual Size</button>
                         <button id="btnclear" name="btnclear" onclick="reset(this)" type="button" class="btn bg-orange btn-sm">Clear</button>
                  <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-danger btn-sm">Process</button>
                  <button id="btnsubmit" name="btnsubmit" onclick="close(a)" type="button" class="open-AddBookDialog btn btn_block btn-success">Close</button> -->
                  <!-- <a href="<?=base_url('c_nup_landed/indextipe/')?>/<?php echo $NupNO?>/<?php echo $pcd ?>" class="btn bg-orange btn-sm">Back</a> -->
                         
                         <!-- <button id="make-any" name="make-any"  type="button" class="btn btn-danger btn-sm">besar</button> -->
                         <button id="make-small" name="make-small" type="button" class="btn btn-primary btn-sm">Fit Screen</button>
                         <button id="make-big" name="make-big"  type="button" class="btn btn-primary btn-sm">Actual Size</button>

                         
                </div>
           
            </div>
         
            
            
              <!-- </div> -->
              <!-- </body> -->
              <!-- </thead> -->
              
            <!-- </div> -->
            <div class="box-footer">
             <!--  <a href="<?php echo base_url("userlevel/entryForm"); ?>"><i class="fa fa-plus"> New Record </i></a> -->
            </div>
          </div>
        </div>      
      </div>         
    </section>

    
  </div>
<!--   <?php
  ?> -->
<!-- <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_nup_unit/validasi" enctype="multipart/form-data">

 -->

 <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button> -->
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            
            </div>
        </div>

    </div>
</div>
<div id="modalimg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialogimg" class="modal-dialog2">
        <div id="content" class="modal-content">
            <!-- Modal Header -->
            <div id="header2" class="modal-header">
                <button type="button" class="close"  data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <!-- <h5 class="modal-title" id="modalTitleimg"></h5> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body1" id="modalBodyimg">
            <img src="" class="imagepop" style="width:100%">
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
var default_options;
$('#lot_no2').val('<?php echo $Land;?>');
$('#pl_property').select2();

// var config = {
//         '.chosen-select'           : {},
//         '.chosen-select-deselect'  : {allow_single_deselect:false},
//         '.chosen-select-no-single' : {disable_search_threshold:10},
//         '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
//         '.chosen-select-width'     : {width:"95%"}
//       }
//       for (var selector in config) {
//         $(selector).chosen(config[selector]);
//       }

// function ambilfoto(){
//     var foto = $this->
// }
function imgpop(src) {
    // alert( src);
    var _src = '<?php echo base_url("img/LotInfo/'+src+'");?>';
    // var src = $('#pop').prop('src');
    // $('.imagepreview').attr('src', $('#pop').prop('src'));
    var modalClass = $('#modalimg').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modalimg').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modalimg').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            default:
                                $('#modalimg').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                        }

                        var modalDialogClass = $('#modalDialogimg').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialogimg').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialogimg').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialogimg').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }
                        // $('.imagepop').attr('src', _src);
                        $('div.modal-body1').html('<img src="'+_src+'" style="width:100%" align="center">');
                        
                        $('#modalimg').modal('show');
    // $('#modal2').modal('show');
}
$('#modalimg').on('shown.bs.modal', function () {
    $(this).find('#modalDialogimg').css({width:'auto',
     height:'auto', 'max-height':'100%'});
  });
function back(){
 var selected_unit = '<?php echo $Land?>';
 window.location.href="<?php echo base_url('c_nup_landed/indextipe/')?>/<?php echo $NupNO?>/<?php echo $pcd ?>/<?php echo $rowid_index?>/<?php echo $status_index?>/<?php echo $balance?>/<?php echo $RowHeader;?>/<?php echo $unit?>/"+selected_unit;
}
function tes() {
  var getInput = $('#lot_no2').val();
  var newbalance = $('#b_val').val();
  var rowid='<?php echo $RowID?>';
  var rowHeader='<?php echo $RowHeader?>';
  var unit = getInput;
  // alert(unit);
  // console.log(rowid);
  // if (rowid == '4')
  // {
  //   localStorage.setItem("rowid4",getInput);
  // } else if (rowid == '5') {
  //   localStorage.setItem("rowid5",getInput);
  // }
   
   window.location.href="<?php echo base_url('c_nup_landed/indextipe/')?><?php echo $NupNO?>/<?php echo $pcd ?>/<?php echo $rowid_index?>/<?php echo $status_index?>/"+newbalance+"/"+rowHeader+"/<?php echo $unit?>/"+getInput;
}
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
      // $('#LL0001').click(function() {
      //           // var checked = $(this).attr('checked');
      //           alert('checked');
      //           // if (checked) {
      //           //     $(this).attr('checked', false);
      //           // }
      //           // else {
      //           //     $(this).attr('checked', true);
      //           // }
      //       });
    $(document).ready(function () {
      
       // var x = '<?php echo $nupCounter;?>';
       // alert(x);
       render = new Array();

        render["free"] = {
            fillColor: '68f442',
            strokeColor: 'f45942',
        };

        render["sold"] = {
            fillColor: 'f45942',
            strokeColor: '68f442',
        };

        render["reserve"] = {
            fillColor: '5342f4',
            strokeColor: '5342f4',
        };

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

            $(this).parent().parent().find("area").each(function(){
              var type = $(this).attr("data-key");                
              $(this).mapster('set',true,render[type]);
            });         

        },
        // var area = '<?php echo $keyarea; ?>';
        //     console.log(area);
        default_options =
        {
            fillOpacity: 0.5,
            render_highlight: {
                fillColor:  '2aff00',//biru                
                stroke: true
                
            },
            render_select: {
                fillColor: 'ff000c',//'0066ff',//hijau   putih: ffffff
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
               // selected = true;
               
               // $('#'+e.key).prop('checked', e.selected);
               document.getElementById(e.key).checked =e.selected;
               fn_change_box(e.key,e.selected,'fn');
               
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
            
            var item, selected;
            $statelist.children().remove();
            for (var i = 0; i < items.length; i++) {
                selected = items[i].isSelected();
                // console.log(items[i]);
                var a ='input'
                item = $('<div><input type="checkbox" onclick="fn_change_box(\''+items[i].key+'\',\''+selected+'\',\''+a+'\')" id="'+ items[i].key +'" name="' + items[i].key + '" ' + (selected ? "checked" : "") + '><span class="sel" key="' + items[i].key + '">' + items[i].value + '</span></div>');

                $statelist.append(item);
            }
            $statelist.find('span.sel').unbind('click').bind('click', function (e) {
                // console.log(e);
                var key = $(this).attr('key');
                $usamap.mapster('highlight', true, key);
            });
            // return the list to mapster so it can bind to it
            return $statelist.find('input[type="checkbox"]').unbind('click').click(function (e) {
                var selected = $(this).is(':checked');
                // alert($(this).attr('name'));
               
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
                
                e.preventDefault();
                $usamap.mapster(default_options);
            });

            $("#unbind_link_preserve").bind("click", function (e) {
                
                e.preventDefault();
                $usamap.mapster("unbind", true);
                bindlinks();
            });
            $("#tooltip").bind("click", function (e) {
                // console.log('tooltip');
                e.preventDefault();
                var state = !$usamap.mapster('get_options').showToolTip;
                $('#tooltip_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { showToolTip: state });
            });
            $("#show_selected").bind("click", function (e) {
                // console.log('show_selected');
                e.preventDefault();
                $('#selections').text($("#usa_image").mapster("get"));
            });
            $("#single_select").bind("click", function (e) {
                // console.log('single_select');
                e.preventDefault();
                var state = !$usamap.mapster('get_options').singleSelect;
                $('#single_select_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { singleSelect: state });
            });
            $("#is_deselectable").bind("click", function (e) {
                // console.log('is_deselectable');
                e.preventDefault();
                var state = !$usamap.mapster('get_options').isDeselectable;
                $('#is_deselectable_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { isDeselectable: state });
            });
                //     ('#usa_image').mapster({ 
                // mapKey: 'data-title',
                // stroke: true,
                // strokeWidth: 2,
                // strokeColor: 'ff0000'
                //  });

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
                // console.log('getSelected');
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
                // console.log('getFillOptions');
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
                // console.log('getNewOptions');
                // console.log('b');
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
                // console.log('select_style,highlight_style');
                e.preventDefault();
                $statelist.children().remove();

                $usamap.mapster(getNewOptions());

            });
            $("#update").click(function (e) {
                console.log('update');
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

        $('#btnclear').click(function(e){
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
            var balance = '<?php echo $balance;?>';
      
            document.getElementById('lot_no2').value="";
            document.getElementById('b_val').value=balance;

            var property_cd = $('#pl_property').val();
            var lot_no = $('#lot_no2').val(); 
            // $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?> #table1",{"property_cd":property_cd,"lot_no":lot_no} );
            location.reload();
            txt = [];
             
            
            bindlinks();
            $usamap.mapster(default_options);
          });
           
            
        });
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

 // $('#pl_property').on("change",function(e){
 // 	var property_cd = $('#pl_property').val();
 //    var nupno = $('#nupno').val();
 // 	console.log(property_cd);
 //    console.log(nupno);
 // 	// document.getElementById('load').hidden=false;

 // 	// if(property_cd!==''){

 //  //   }
 //    // $('#MAP').load( "<?php echo base_url('c_nup_landed/indextipe');?>"+"/"+property_cd+"/"+property_cd+" #MAP" );

 //    window.location.href = "<?php echo base_url('c_nup_landed/indextipe');?>"+"/"+nupno+"/"+property_cd+"";

 //    // window.location.href = "<?php echo base_url('c_nup_landed/indextipe');?>"+"/"+property_cd+"/"+property_cd+"";
 // });  

                // $("#pl_property").on("change"
                //     function(e){
                        
                //         window.location.href = "<?php echo base_url('c_nup_landed/indextipe/');?>"+"/"+property_cd+"/"+property_cd+" #MAP";
                //     }
                // );
var b_val= '<?php echo $balance;?>';
$('#b_val').val(b_val); 
function fn_change_box(Id,checked,from){   

   var balance = $('#b_val').val();
   var cek = document.getElementById(Id).checked;
    // var aa = $('#'+Id);
  //   if(cek){
  //     alert('input')
  //   }
  // }else{
    // console.log(cek);
    if(!cek){
      var lot_no = $('#lot_no2').val();
      var lot_nox = $('#lot_nox').val();

      var arr_lot = lot_no.split(",");
      var arr_lotx = lot_nox.split(",");

      var new_lot = ""; var new_lotx = "";

      // txtlotno
      for (i = 0; i < arr_lot.length; i++) {
        if (arr_lot[i] != Id && new_lot == ""){
          new_lot = arr_lot[i];
        } else if (arr_lot[i] != Id && new_lot != ""){
          new_lot = new_lot + ',' + arr_lot[i];
        } 
      }
      // alert(new_lot);

      // txtlotno2
      for (i = 0; i <= arr_lotx.length; i++) {
        if (i == 0){
          new_lotx = arr_lotx[i];
        } else if (i == arr_lotx.length && lot_nox != "") {
          new_lotx = new_lotx + ',' + Id;
        } else if (i == arr_lotx.length && lot_nox == "") {
          new_lotx = Id;
        } else {
          new_lotx = new_lotx + ',' + arr_lotx[i];
        } 
      }



      var ss = arr_lot.indexOf(Id);
        console.log(ss);
        if(ss < 0){   
          $('#usa_image').mapster('highlight', false, ID);
        }      

      var ind = arr_lot.indexOf(Id);
      if (ind > -1) {
        arr_lot.splice(ind, 1);
      }

      // // console.log(arr_lot);
      // $('#lot_no2').val(arr_lot);
      balance = parseInt(balance) + 1;
      $('#b_val').val(balance);
      // // document.getElementById("lot_no2").text = arr_lot;

      $('#lot_no2').val(new_lot);
      $('#lot_nox').val(new_lotx);
    }
    
    if (balance == 0)
    {
        swal('Information','You\'ve already used all your balance','warning');        
        $("#usa_image").mapster('set', false,data );
    }
    else {
      if(checked && b_val != 0){      
        landinfo(Id);
      }else{  

      }
  }
  
  
}       
function landinfo(data)
  {
    var balance = $('#b_val').val();

         var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }
                        
                        $('#modalTitle').html('Detail Information');
                        $('div.modal-body').load("<?php echo base_url("c_nup_landed/showland");?>"+"/"+data);
                        $('#modal').data('balance',balance);
                        $('#modal').modal('show');
                        // modalDialog
                        // $('.modal-dialog').draggable({
                        //     handle: ".modal-header"
                        // });
                        $('#modal').data('Id',data);
    
   
  }
 /* function reset(btn){
     var balance = '<?php echo $balance;?>';
      
      document.getElementById('lot_no2').value="";
       document.getElementById('b_val').value=balance;

      var property_cd = $('#pl_property').val();
      var lot_no = $('#lot_no2').val(); 
      $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?> #table1",{"property_cd":property_cd,"lot_no":lot_no} );
       txt = [];
       alert(txt);
      
        bindlinks();
      $("#usa_image").mapster(default_options);  
        // $usamap.mapster(default_options);
    }*/
    
</script>
<script type="text/javascript">
    

//     function Booking(){
//       // var url_booking ="<?php echo base_url('c_nup_unit/validasi'); ?>/"+myBookId;
//       // var property_cd = $('#pl_property').val();  
//       var b = <?php echo $RowID; ?>;
//       var lot_no = $('#lot_no2').val();

//       if(lot_no != ''){
//          $('div.modal-header').html('Information');
//          $('div.modal-body').html('Are You Sure want to Book this unit '+ lot_no+' ?');
//          $('div.modal-body').append('<div class="modal-footer"></div>');
//          $('#addBookDialog').data('id', lot_no).modal('show');
//                             var btnYes = $('<input/>')
//                                 .attr({
//                                     id: "btnYes",
//                                     name: "btnYes",
//                                     type: "button",
//                                     class: "btn btn-danger",
//                                     onclick: "Booking2('"+lot_no+"');",
//                                     value: 'OK'
//                                 });                            

//                             var btnNo = $('<a>Cancel</a>').attr({
//                                 class: "btn btn-default pull-right", 'data-dismiss': "modal"
//                             });
//                             $('div.modal-footer').append(btnYes);
//                             $('div.modal-footer').append(btnNo);
//           $('#modal').data('id', lot_no).modal('show');
//       }else{
//         swal('Information','Please select Unit.','warning');
//       }

//       // alert(lot_no);
     
//         // });
//         // setTimeout(function () {
//         //           window.location.href = url_booking;
//         //                     }, 1500);  
//         // var LotNumber = $('#txtlotno').val();
//         // $('#modal').modal('hide');
//     }
//     function Booking2(lot_no){
//           // var LotNumber = $('#txtlotno').val();
//           // alert(lot_no);
//           var parseRowid = '<?php echo $RowID; ?>';
//           var parseLotQty = '<?php echo $balance;?>';
//           // var parseNupNo = <?=$NupNO?>;
//           // alert(parseNupNo);
//           $.ajax({
//                     url : "<?php echo base_url('c_nup_unit/validasi2');?>",
//                     type:"POST",
//                     // data:$('#form_rl_sales').serialize(),
//                     // data: $('#frmEditor').serialize() + '&' + $.param(obj),
//                     data: {LotNumber:lot_no,
//                           rowid:parseRowid,
//                           lotqty:parseLotQty},
//                     dataType:"json",
//                     success:function(event, data){
                        
//                         // BootstrapDialog.alert(event.Pesan);

//                         BootstrapDialog.alert(event.Pesan, function(result){
//                             if(result) {
//                                 var a = event.nup;
//                                 var b = event.notif;

//                                 if(b == 'OK'){
//                                   window.location.href="<?=base_url('c_nup_dt/list_dt/')?>"+"/"+a;  
//                                 }else{
//                                   window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;  
//                                 }
//                             }
//                             // else {
//                             //     alert('Nope.');
//                             // }
//                         });

//                         // alert(b);
//                         $('#modal').modal('hide');

//                         // var a = event.nup;
//                         // var b = event.notif;

//                         // if(b == 'OK'){
//                         //   window.location.href="<?=base_url('c_nup_dt/list_dt/')?>"+"/"+a;  
//                         // }else{
//                         //   window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;  
//                         // }
//                         // window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty;
                          
                        
//                         // tblnewsfeed.ajax.reload(null,true); 
//                     },                    
//                     error: function(jqXHR, textStatus, errorThrown){
//                       // delete_gagal();
//                      BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
//                      // window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty;
//                     }
//                     });

// }

//countdown reload
 var a =10;
display = document.querySelector('#time');
    startTimer(a, display);

function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = 'Reload In : '+ seconds;
            if(seconds==0){
              var pcd = '<?php echo $pcd;?>';
              var nupno = '<?php echo $NupNO;?>';
              var rowid_index = '<?php echo $rowid_index?>';
              var status_index = '<?php echo $status_index?>';
              var balance = $('#b_val').val();
              var unit = '<?php echo $unit ?>';//$('#lot_no2').val();
              var rowHd = '<?php echo $RowHeader?>';
              var rowid = '<?php echo $rowidd?>';
              var selected_unit = $('#lot_no2').val();//'<?php echo $selected_unit ?>';
              window.location.href="<?php echo base_url('c_nup_landed/indexland/')?>"+nupno+"/"+rowid+"/"+pcd+"/"+rowid_index+"/"+status_index+"/"+balance+"/"+rowHd+"/"+unit+"/"+selected_unit;
              // location.reload();
            }
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

function Booking(){
      // var url_booking ="<?php echo base_url('c_nup_unit/validasi'); ?>/"+myBookId;
      // var property_cd = $('#pl_property').val();  
      var b = '<?php echo $RowID; ?>';
      // console.log(b);
      // return;
      var lot_no = $('#lot_no2').val();
      var xlot_no =  $('#lot_nox').val();
      
        var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-lg":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                break;
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-lg":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                break;
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                break;
                        }

      if(lot_no != ''){
         $('div.modal-header').html('Information');
         $('div.modal-body').html('Are you sure you want to choose this unit '+ lot_no+' ?');
         $('div.modal-body').append('<div class="modal-footer"></div>');
         $('#addBookDialog').data('id', lot_no).modal('show');
                            var btnYes = $('<input/>')
                                .attr({
                                    id: "btnYes",
                                    name: "btnYes",
                                    type: "button",
                                    class: "btn btn-success",
                                    onclick: "Booking2(\'"+lot_no+"\',\'"+xlot_no+"\');",
                                    value: 'OK'
                                });                            

                            var btnNo = $('<a>Cancel</a>').attr({
                                class: "btn btn-default pull-right", 'data-dismiss': "modal"
                            });
                            $('div.modal-footer').append(btnYes);
                            $('div.modal-footer').append(btnNo);
          $('#modal').data('id', lot_no).modal('show');
      }else{
        swal('Information','Please select Unit.','warning');
      }

      // alert(lot_no);
     
        // });
        // setTimeout(function () {
        //           window.location.href = url_booking;
        //                     }, 1500);  
        // var LotNumber = $('#txtlotno').val();
        // $('#modal').modal('hide');
    }
    function Booking2(lot_no, xlot_no){
          // var LotNumber = $('#txtlotno').val();
          // alert(lot_no);
          var parseRowid = '<?php echo $RowID; ?>';
          // alert(parseRowid);
          // return;
          var parseLotQty = $('#balance').val();//'<?php echo $balance;?>';
          var rowid_index = '<?php echo $rowid_index?>';
          var status_index = '<?php echo $status_index?>';
          var parseNupno = '<?php echo $NupNO?>';
          // var parseNupNo = <?=$NupNO?>;
          // console.log(parseNupno);
          // alert(parseNupNo);
          $.ajax({
                    url : "<?php echo base_url('c_nup_unit/validasi2');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    // data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    data: {LotNumber:lot_no,
                          rowid:parseRowid,
                          lotqty:parseLotQty,
                          xlot_no:xlot_no},
                    dataType:"json",
                    success:function(event, data){
                        
                        // BootstrapDialog.alert(event.Pesan);
                            if(event.status=='OK'){
                                swal({
                                      title: "Information",
                                      animation: false,
                                      text: event.Pesan,
                                      type: "success",
                                      confirmButtonText: "OK"
                                    },
                                    function(){
                                        var a = event.nup;                                        
                                        var b = event.notif;
                                        // console.location(event);


                                        if(b == 'OK'){
                                          window.location.href="<?=base_url('c_nup_dt/list_dtNew/')?>"+"/"+parseNupno+"/1/"+rowid_index+"/"+status_index;  
                                        }else{
                                          window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;  
                                        }
                                    });
                            } else {
                                swal({
                                          title: "Error",
                                          animation: false,
                                          type:"error",
                                          text: event.Pesan,
                                          confirmButtonText: "OK"
                                        });
                            }
                        // BootstrapDialog.alert(event.Pesan, function(result){
                        //     if(result) {
                        //         var a = event.nup;
                        //         var b = event.notif;

                        //         if(b == 'OK'){
                        //           window.location.href="<?=base_url('c_nup_dt/list_dt/')?>"+"/"+a;  
                        //         }else{
                        //           window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;  
                        //         }
                        //     }
                        //     // else {
                        //     //     alert('Nope.');
                        //     // }
                        // });

                        // alert(b);
                        $('#modal').modal('hide');

                        // var a = event.nup;
                        // var b = event.notif;

                        // if(b == 'OK'){
                        //   window.location.href="<?=base_url('c_nup_dt/list_dt/')?>"+"/"+a;  
                        // }else{
                        //   window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;  
                        // }
                        // window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty;
                          
                        
                        // tblnewsfeed.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                                swal({
                                      title: "Information",
                                      animation: false,
                                      type:"error",
                                      text: textStatus+' Save : '+errorThrown,
                                      confirmButtonText: "OK"
                                    });
                     // window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty;
                    }
                    });

}
</script>

 <map id="usa_image_map" name="usa">
        
        <?php echo $dataarea; ?>
    </map>



  


