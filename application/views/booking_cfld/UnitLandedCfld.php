<style type="text/css">
 #load{
    width:100%;
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
<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>" type="text/javascript"></script>
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
    <div class="row border-bottom white-bg dashboard-header">
        <div class="form-group">
            <div class="tittle-top pull-left"><b><?php echo $projectName; ?></b></div>
            <div class="tittle-top pull-right"><b>Regular</b></div>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="">
                        <div class="content">
                                <div class="panel-body row">
                                    <form name="basicform" id="basicform" class="form-horizontal" method="post" action="#">
                                        <div class="box-body">
                                            <div class="col-sm-12">
                                                <label for="pl_project" class="col-sm-2 control-label">Property Type :</label>
                                                <div class="col-sm-8">
                                                    <label for="pl_project_name" class="control-label">
                                                        <?php echo $property_descs; ?>
                                                    </label>
                                                </div>                                                
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="pl_Unit" class="col-sm-2 control-label">Unit :</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="txt_unit" id="txt_unit" width="100%" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly">
                                                    <input type="text" name="lot_descs" id="lot_descs" width="100%" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly">
                                                    <!-- style="border:none; background-color:white; color:#ec0303; font-size: large;" -->
                                                </div>

                                            </div>
                                            <div class="col-sm-12">
                                            <br>
                                                <input type="button" name="btnClear" id="btnClear" value="Clear" onclick="Clear();" class="btn btn-danger btn-sm">
                                                <input type="button" name="btnNext" id="btnNext" value="Process" class="btn btn-success btn-sm pull-right">
                                                <input type="button" name="btnBack" id="btnBack" value="Back" class="btn abu-bg btn-sm">
                                                
                                                
                                            </div>
                                           
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div style="margin-left: 0px;">
                                                        <i>Click on unit to booked.</i>
                                                    </div>
                                                        <div id="MAP" class="box-body" style="width:100%;">
                                                            <div id="map_demo">

                                                                <div style="width:100%; overflow-x: scroll;height:80%; border:2px solid #c7c9cc; float:left; position:relative; ">

                                                                    <img style="width:100%;" id="usa_image" src="<?php echo base_url($map_picture);?>" usemap="#usa">
                                                                    <map id="usa_image_map" name="usa">
        
                                                                            <?php echo $dataarea; ?>
                                                                    </map>
                                                                </div>

                                                                <div id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" hidden></div>
                                                            </div>

                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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

<script type="text/javascript">
    var txt = [];
    // var txt_descs = [];
    var unit_book = '<?php echo $unit_book;?>';
    var unit_descs = '<?php echo $descs; ?>';
    // var descs_book = '<?php echo $descs_loop ?>'

    if (unit_book) {
        txt = unit_book.split(",");
        // txt_descs = descs_book.split(",");
        $('#txt_unit').val(unit_book);
        $('#lot_descs').val(unit_descs);
        // $('#lot_descs').val(descs_book);
    }

    function hasClass(element, cls) {
        return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
    }

    function Change_unit(lot_no) {
        swal({
                title: "Are you sure?",
                text: "You will Cancel unit [ " + lot_no + " ] Unit!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Cancel it!",
                closeOnConfirm: false
            },
            function() {
                var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
                var property_cd = '<?php echo $property_cd;?>';
                $.post(site_url, {
                        id: lot_no,
                        status: "A",
                        property_cd: property_cd
                    },
                    function(data, status) {
                        console.log(data.Pesan);
                        // var a = event.nup_no;
                        // alert(a);
                        console.log(txt);
                        swal("Cancel!", "Your Unit has been Canceled.", "success");
                        var CariLotNo = txt.indexOf(lot_no);
                        console.log(CariLotNo);
                        txt.splice(CariLotNo, 1);
                        console.log(txt);
                        $('#txt_unit').val(txt);
                        $('#' + lot_no).removeClass("btn-warning").addClass("btn-success");
                    }
                );

            });
    }

    function showInfo(lot_no) {

        var property_cd = '<?php echo $property_cd;?>';
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
        $('div.modal-body').load("<?php echo base_url("c_stepbooking/showland");?>" + "/" + lot_no);
        // $('#modal').data('balance',balance);
        $('#modal').modal('show');
        $('#modal').data('Id', lot_no);
        $('#modal').data('property_cd', property_cd);
    }

    function loadinfo(lot_no) {
        var el = document.getElementById(lot_no);
        // console.log(hasClass(el,'btn-success'));
        if (hasClass(el, 'btn-success')) {
            showInfo(lot_no);
            // $('#'+lot_no).removeClass("btn-success").addClass("btn-warning");
        } else {
            Change_unit(lot_no);

        }

    }

    function Clear() {
        console.log('jjj');
        var lot_unit = $('#txt_unit').val();
        document.getElementById('txt_unit').value = "";
        //update status unit
        var property_cd = '<?php echo $property_cd;?>';
        var site_url = '<?php echo base_url("c_nup_landed_cfld/clear_unit")?>';
        var property_cd = '<?php echo $property_cd;?>';
        // var a = '<?php echo $property_cd;?>';
        var type = '<?php echo $property_type;?>';
        $.post(site_url, {
                id: lot_unit,
                status: "A",
                property_cd: property_cd
            },
            function(data, status) {
                

        // window.location.href = "<?php echo base_url('c_stepbooking/index')?>"+'/'+type+'/'+property_cd;
        window.location.href = "<?php echo base_url('c_nup_cfld/index')?>";
                // console.log(data.Pesan);
                // var lot_no = $('#txt_unit').val();
                // $('#table1').load("<?php echo base_url('c_stepbooking/goto_table');?> #table1", {
                //     "property_cd": property_cd,
                //     "lot_no": lot_no
                // });
                // txt = [];

            }
        );
        //update status unit end
        // alert(property_cd);

    }
function openPage(rowid,property_cd,unit){
  // alert(rowid);
  // window.location.href="<?php echo base_url('c_nup_landed_cfld/data_unit_landdt')?>"+"/"+rowid+"/"+property_cd+"/"+unit;
  window.location.href="<?php echo base_url('C_nup_landed_cfld_dt/data_unit_landdt')?>"+"/"+rowid+"/"+property_cd+"/"+unit;

}
    // var a = 10;
    // display = document.querySelector('#time');
    // startTimer(a, display);

    // function startTimer(duration, display) {
    //     var timer = duration,
    //         minutes, seconds;
    //     setInterval(function() {
    //         minutes = parseInt(timer / 60, 10)
    //         seconds = parseInt(timer % 60, 10);

    //         minutes = minutes < 10 ? "0" + minutes : minutes;
    //         seconds = seconds < 10 ? "0" + seconds : seconds;

    //         display.textContent = 'Reload In : ' + seconds;
    //         if (seconds == 0) {
    //             var property_cd = '<?php echo $property_cd;?>';
    //             var lot_no = $('#txt_unit').val();
    //             $('#table1').load("<?php echo base_url('c_stepbooking/goto_table');?> #table1", {
    //                 "property_cd": property_cd,
    //                 "lot_no": lot_no
    //             });
    //         }
    //         if (--timer < 0) {
    //             timer = duration;
    //         }
    //     }, 1000);
    // }

    // $(document).ready(function(e) {
    //   //start Mapster
    //   var $statelist, $usamap, ratio,
    //     mapsterConfigured = function () {
    //         // set html settings values
            
    //         var opts = $usamap.mapster('get_options', null, true);
    //         if (!ratio) {
    //             ratio = $usamap.width() / $usamap.height();
    //         }
    //         $('#stroke_highlight').prop("checked", opts.render_highlight.stroke);
    //         $('#strokewidth_highlight').val(opts.render_highlight.strokeWidth);
    //         $('#fill_highlight').val(opts.render_highlight.fillOpacity);
    //         $('#strokeopacity_highlight').val(opts.render_highlight.strokeOpacity);
    //         $('#stroke_select').prop("checked", opts.render_select.stroke);
    //         $('#strokewidth_select').val(opts.render_select.strokeWidth);
    //         $('#fill_select').val(opts.render_select.fillOpacity);
    //         $('#strokeopacity_select').val(opts.render_select.strokeOpacity);
    //         $('#mouseout-delay').val(opts.mouseoutDelay);
    //         $('#img_width').val($usamap.width());
    //     },
    //     // var area = '<?php echo $keyarea; ?>';
    //     //     console.log(area);
    //     default_options =
    //     {
    //         fillOpacity: 0.5,
    //         render_highlight: {
    //             fillColor: '2aff00',                
    //             stroke: true
    //         },
    //         render_select: {
    //             fillColor: 'ff000c',
    //             stroke: false
    //         },
    //         //render_zoom: {
    //         //    altImage: 'images/usa_map_huge.jpg'
    //         //},
    //         mouseoutDelay: 0,
    //         fadeInterval: 50,
    //         isSelectable: true,
    //         singleSelect: false,
    //         // mapKey: 'state',
    //         mapKey: 'unit',
    //         mapValue: 'full',
    //         listKey: 'name',
    //         listSelectedAttribute: 'checked',
    //         sortList: "asc",
    //         onGetList: addCheckBoxes,
    //         onClick: function (e) {
    //            styleCheckbox(e.selected, e.listTarget);
    //            if (!utils.isScrolledIntoView(e.listTarget, false, $statelist)) {
    //                utils.centerOn($statelist, e.listTarget);
    //            }
    //            selected = true;

    //            $('#'+e.key).prop('checked', selected);
    //            // console.log(e.key);
    //            // console.log(e);
    //            // console.log('1');
    //            //  if (e.key==='OH') {
    //            //     $usamap.mapster('zoom','OH');
    //            //      return false;
    //            //  }
    //            // return true;
    //         },
    //         onConfigured: mapsterConfigured,
    //         // showToolTip: true,
    //         toolTipClose: ["area-mouseout"],
    //         areas:[ <?php echo $keyarea; ?> ] 
    //     };

    //     function styleCheckbox(selected, $checkbox) {
    //         var nowWeight = selected ? "bold" : "normal";
    //         $checkbox.closest('div').css("font-weight", nowWeight);
    //     }
        
    //     function addCheckBoxes(items) {
    //         // console.log(items);
    //         // console.log('2');
    //         var item, selected;
    //         $statelist.children().remove();
    //         for (var i = 0; i < items.length; i++) {
    //             selected = items[i].isSelected();
    //             item = $('<div><input type="checkbox" id="'+ items[i].key +'" name="' + items[i].key + '" ' + (selected ? "checked" : "") + '><span class="sel" key="' + items[i].key + '">' + items[i].value + '</span></div>');

    //             $statelist.append(item);
    //         }
    //         $statelist.find('span.sel').unbind('click').bind('click', function (e) {
    //             var key = $(this).attr('key');
    //             $usamap.mapster('highlight', true, key);
    //         });
    //         // return the list to mapster so it can bind to it
    //         return $statelist.find('input[type="checkbox"]').unbind('click').click(function (e) {
    //             var selected = $(this).is(':checked');
    //             $usamap.mapster('set', selected, $(this).attr('name'));
    //             styleCheckbox(selected, $(this));
    //         });
    //     }


    //     $statelist = $('#statelist');
    //     $usamap = $('#usa_image');

    //     function bindlinks() {
    //         // console.log('bindlinks');
    //         // $('*').unbind();
    //         $("#unbind_link").bind("click", function (e) {
    //             e.preventDefault();
    //             $usamap.mapster("unbind");
    //             $usamap.width(720);
    //             bindlinks();
    //         });
    //         $("#rebind_link").bind("click", function (e) {
    //             console.log('rebind_link');
    //             e.preventDefault();
    //             $usamap.mapster(default_options);
    //         });

    //         $("#unbind_link_preserve").bind("click", function (e) {
    //             e.preventDefault();
    //             $usamap.mapster("unbind", true);
    //             bindlinks();
    //         });
    //         $("#tooltip").bind("click", function (e) {
    //             e.preventDefault();
    //             var state = !$usamap.mapster('get_options').showToolTip;
    //             $('#tooltip_state').text(state ? "enabled" : "disabled");
    //             $usamap.mapster("set_options", { showToolTip: state });
    //         });
    //         $("#show_selected").bind("click", function (e) {
    //             e.preventDefault();
    //             $('#selections').text($("#usa_image").mapster("get"));
    //         });
    //         $("#single_select").bind("click", function (e) {
    //             e.preventDefault();
    //             var state = !$usamap.mapster('get_options').singleSelect;
    //             $('#single_select_state').text(state ? "enabled" : "disabled");
    //             $usamap.mapster("set_options", { singleSelect: state });
    //         });
    //         $("#is_deselectable").bind("click", function (e) {
    //             e.preventDefault();
    //             var state = !$usamap.mapster('get_options').isDeselectable;
    //             $('#is_deselectable_state').text(state ? "enabled" : "disabled");
    //             $usamap.mapster("set_options", { isDeselectable: state });
    //         });
    //             //     ('#usa_image').mapster({ 
    //             // mapKey: 'data-title',
    //             // stroke: true,
    //             // strokeWidth: 2,
    //             // strokeColor: 'ff0000'
    //             //  });

    //         $('#make-small').bind('click',function() {
    //             $('#usa_image').mapster('resize', 720, 0, 450);
    //         });
    //         $('#make-big').bind('click',function() {
    //             $('#usa_image').mapster('resize', 1000, 0, 1000);
    //         });
    //         $('#make-any').bind('click',function() {
    //             $('#usa_image').mapster('resize', $('#new-size').val(), 0, 1000);
    //         });


    //         function getSelected(sel) {
    //             var item=$();
    //             sel.each(function() {
    //                 if (this.selected) {
    //                     item=item.add(this);
    //                     return false;
    //                 }

    //             });
    //             return item;

    //         }

    //         function getFillOptions(el) {
    //             var new_options,
    //                 val = getSelected($(el).find("option")).val();
    //                 new_options = {
    //                     altImage: null,
    //                     stroke: false
    //                 };
    //             return new_options;
    //         }

    //         function getNewOptions() {
    //             var options,
    //                 render_highlight = getFillOptions($('#highlight_style')),
    //                 render_select = getFillOptions($('#select_style'));

    //             options = $.extend({},
    //                 default_options,
    //                 {
    //                     render_select: render_select,
    //                     render_highlight: render_highlight
    //                 });

    //             return options;
    //         }

    //         $("#highlight_style, #select_style").bind("change", function (e) {
    //             e.preventDefault();
    //             $statelist.children().remove();

    //             $usamap.mapster(getNewOptions());
    //         });

    //         $("#update").click(function (e) {
    //             var newOpts = {};
    //             function setOption(base, opt, value) {
    //                 if (value !== '' && value !== null) {
    //                     base[opt] = value;
    //                 }
    //             }
    //             e.preventDefault();

    //             newOpts.render_highlight = {};
    //             setOption(newOpts.render_highlight, "stroke", $('#stroke_highlight').prop("checked"));

    //             setOption(newOpts.render_highlight, "strokeWidth", $('#strokewidth_highlight').val());
    //             setOption(newOpts.render_highlight, "fillOpacity", $('#fill_highlight').val());
    //             setOption(newOpts.render_highlight, "strokeOpacity", $('#strokeopacity_highlight').val());

    //             newOpts.render_select = {};
    //             setOption(newOpts.render_select, "stroke", $('#stroke_select').prop("checked"));
    //             setOption(newOpts.render_select, "strokeWidth", $('#strokewidth_select').val());
    //             setOption(newOpts.render_select, "fillOpacity", $('#fill_select').val());
    //             setOption(newOpts.render_select, "strokeOpacity", $('#strokeopacity_select').val());
    //             setOption(newOpts, "mouseoutDelay", $('#mouseout-delay').val());
    //             var width = parseInt($('#img_width').val(), 10);

    //             if ($usamap.width() != width) {
    //                 $('#update').prop("disabled",true);
    //                 $usamap.mapster('resize', width, null, 1000,function() {
    //                     $('#update').prop("disabled",false);
    //                 });
    //             } else {
    //                 $usamap.mapster('set_options', newOpts);
    //             }
    //         });
    //     }

    //     bindlinks();
        
    //     $usamap.mapster(default_options);
    //   //end Mapster


    //     $('#btnNext').click(function() {
    //         // alert('tes');
    //         var myBookId = $('#txt_unit').val();
    //         var property_cd = '<?php echo $property_cd;?>';
    //         var url_ = '<?php echo base_url("c_stepbooking/next/3")?>';
    //         if (myBookId == "") {

    //             swal('warning', 'Please Click Unit!');
    //             return;
    //         }
    //         var site_url = "<?php echo base_url('c_stepbooking/set_session')?>";
    //         $.ajax({
    //             url: site_url,
    //             type: "POST",
    //             data: {
    //                 property_cd: property_cd,
    //                 unit_book: myBookId
    //             },
    //             dataType: "json",
    //             success: function(data, status) {
    //                 var busID = '<?php echo $business_id;?>';
    //                 window.location.href = "<?php echo base_url('c_stepbooking/add_customer')?>/"+busID+"/L"; //+'/'+property_cd+'/'+myBookId;

    //             },
    //             error: function(jqXHR, textStatus, errorThrown) {
    //                 swal(textStatus + ' Save : ' + errorThrown);
    //             }
    //         })

    //     });

    $('#btnNext').click(function() {
            // alert('tes');
            var myBookId = $('#txt_unit').val();
            var property_cd = '<?php echo $property_cd;?>';
            var url_ = '<?php echo base_url("c_stepbooking/next/3")?>';
            if (myBookId == "") {

                swal('Warning', 'Please Click Unit!',"warning");
                return;
            }
            var site_url = "<?php echo base_url('c_nup_landed_cfld_dt/set_session')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: {
                    unit_loop: myBookId
                },
                dataType: "json",
                success: function(data, status) {
                    var busID = '<?php echo $business_id;?>';
                    window.location.href = "<?php echo base_url('c_nup_cfld/insert/N/R')?>/"; //+'/'+property_cd+'/'+myBookId;

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                }
            })

        });

    //     $('#btnBack').click(function() {
    //         // window.history.back();
    //         swal({
    //           title: "Are you sure?",
    //           text: "Going back will clear all the unit you've chosen.",
    //           type: "warning",
    //           showCancelButton: true,
    //           confirmButtonColor: "#DD6B55",
    //           confirmButtonText: "Yes",
    //           closeOnConfirm: false
    //         },
    //         function(){
    //             var lot_unit = $('#txt_unit').val();
    //             if(lot_unit=='') {
    //                 window.location.href = "<?php echo base_url('c_stepbooking')?>";
    //             } else {
    //                 document.getElementById('txt_unit').value = "";
    //                 //update status unit
    //                 var property_cd = '<?php echo $property_cd;?>';
    //                 var site_url = '<?php echo base_url("c_stepbooking/clear_unit")?>';
    //                 var property_cd = '<?php echo $property_cd;?>';
    //                 // var a = '<?php echo $property_cd;?>';
    //                 var type = '<?php echo $property_type;?>';
    //                 $.post(site_url, {
    //                         id: lot_unit,
    //                         status: "A",
    //                         property_cd: property_cd
    //                     },
    //                     function(data, status) {
    //                         window.location.href = "<?php echo base_url('c_stepbooking')?>";
    //                     }
    //                 );
    //             }
                
    //         });
            
    //     });
    // });
    
    $(document).ready(function(e) {
        //start Mapster

     var $statelist, $usamap, ratio;
        var map = $('#usa_image'),

        render = new Array();

        render["R"] = {
            fillColor: 'FF8000',
            strokeColor: 'FF8000',
        };

        render["A"] = {
            fillColor: '00FF00',
            strokeColor: '00FF00',
        };

        render["B"] = {
            fillColor: 'FF0000',
            strokeColor: 'FF0000',
        };
        
        var default_options =
        {
            fillOpacity: 0.5,
            render_highlight: {
                fillColor:  '00ff00',
                // ,//biru  FF0000     2aff00          
                stroke: true
                
            },
            render_select: {
                fillColor: '00ff00',//hijau   putih: ffffff 0066ff
                stroke: true
                
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
            // onGetList: addCheckBoxes,
            onClick: function (e) {
                // console.log(e);
                $(this).parent().parent().find("area").each(function(){
                        
                    var status = $(this).attr("data-status");  
                    var unit = $(this).attr("unit");  
                   

                    if(unit == e.key ){
                        // console.log($(this));
                        fn_oncLick(e.key,status,e.selected,$(this));
                        // if(status=='A'){
                        //     $(this).mapster('set',true,render['R']);
                        //     console.log($(this));
                        // }
                         // if(status=='B'){
                         //        // console.log(status);
                         //        $('#usa_image').mapster('highlight', false, ID);
                         //             // return;
                         //    }else if(status=='R'){

                         //    }else{

                         //    }
                            // console.log('mantap');
                    }
                    // console.log(type);              
                    // 

                })
               
            },
            // onConfigured: mapsterConfigured,
            onConfigured: function () {

                $(this).parent().parent().find("area").each(function(){
                        // console.log($(this));
                    // var type = $(this).attr("data-status"); 
                    // if(type !='A'){
                        // $(this).mapster('set',true,render[type]);
                    // } 

                    // console.log(type);              
                    

                })
            },
            showToolTip: true,
            toolTipClose: ["area-mouseout"],
            areas:[ <?php echo $keyarea; ?> ] 
           
        };
        map.mapster(default_options);

            $('#btnBack').click(function() {
            // window.history.back();
                swal({  
                  title: "Are you sure?",
                  text: "Going back will clear all the unit you've chosen.",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes",
                  closeOnConfirm: false
                },
                function(){
                    var lot_unit = $('#txt_unit').val();
                    if(lot_unit=='') {
                        window.location.href = "<?php echo base_url('c_nup_cfld/index')?>";
                    } else {
                        document.getElementById('txt_unit').value = "";
                        //update status unit
                        var property_cd = '<?php echo $property_cd;?>';
                        var site_url = '<?php echo base_url("c_nup_landed_cfld/clear_unit")?>';
                        var property_cd = '<?php echo $property_cd;?>';
                        // var a = '<?php echo $property_cd;?>';
                        var type = '<?php echo $property_type;?>';
                        $.post(site_url, {
                                id: lot_unit,
                                status: "A",
                                property_cd: property_cd
                            },
                            function(data, status) {
                                window.location.href = "<?php echo base_url('c_nup_cfld/index')?>";
                            }
                        );
                    }
                    
                });
            });

    });
      



    
</script>

