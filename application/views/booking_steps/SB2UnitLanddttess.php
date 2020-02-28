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
<link rel="stylesheet" href="js/plugins/jvectormap/jquery-jvectormap-1.2.2.css">

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">
        <div class="form-group">
            <div class="tittle-top pull-left"><b><?php echo $projectName; ?></b></div>
            <div class="tittle-top pull-right"><b>Booking</b></div>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- next start -->
                <div class="ibox-content">
                    <form class="wizard-big wizard clearfix" role="application" id="form">
                        <div class="steps clearfix">
                            <ul role="tablist">
                                <li class="first done" role="tab" aria-disabled="false" aria-selected="false">
                                    <a id="form-t-0" href="#form-h0" aria-controls="form-p-0">
                                        <span class="current-info audible">current step: </span>
                                        <span class="number">1. </span> Product
                                    </a>
                                </li>
                                <li class="current" role="tab" aria-disabled="true">
                                    <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                                        <span class="current-info audible">current step: </span>
                                        <span class="number">2. </span> Pilih Unit
                                    </a>
                                </li>
                                <li class="disabled" role="tab" aria-disabled="true">
                                    <a id="form-t-1" href="#form-h2" aria-controls="form-p-1">
                                        <!-- <span class="current-info audible">current step: </span> -->
                                        <span class="number">3. </span> Add Customer
                                    </a>
                                </li>
                                <li class="disabled" role="tab" aria-disabled="true">
                                    <a id="form-t-1" href="#form-h3" aria-controls="form-p-1">
                                        <!-- <span class="current-info audible">current step: </span> -->
                                        <span class="number">4. </span> Payment Plan + Disc
                                    </a>
                                </li>
                                <li class="disabled" role="tab" aria-disabled="true">
                                    <a id="form-t-1" href="#form-h4" aria-controls="form-p-1">
                                        <span class="current-info audible">current step: </span>
                                        <span class="number">5. </span> Finish
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </form>
                    <div class="">
                        <br>
                        <div class="content">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Pilih Unit Landed Detail</h3>
                                </div>
                                <div class="panel-body row">
                                    <form name="basicform" id="basicform" class="form-horizontal" method="post" action="#">
                                        <!-- <div class="row"> -->
                                        <div class="box-body">
                                            <!-- <div class="navbar navbar-default navbar-fixed-top"> -->
                                            <!-- <div class="form-group"> -->
                                            <div class="col-sm-12">
                                                <label for="pl_project" class="col-sm-2 control-label">Property Type :</label>
                                                <div class="col-sm-8">
                                                    <label for="pl_project_name" class="control-label">
                                                        <?php echo $property_descs; ?>
                                                    </label>
                                                </div>
                                                <span id="time"></span>
                                            </div>
                                            <!-- <div class="form-group"> -->
                                            <div class="col-sm-12">
                                                <label for="pl_Unit" class="col-sm-2 control-label">Unit :</label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="txt_unit" id="txt_unit" width="100%" style="border:none; background-color:white; color:#ec0303; font-size: large;">
                                                </div>

                                            </div>
                                            <!-- <br> -->
                                            <!-- <div class="form-group"> -->
                                            <div class="col-sm-12">
                                                <input type="button" name="btnBack" id="btnBack" value="Back" class="btn btn-primary">
                                                <!-- <input type="button" name="btnNext" id="btnNext" value="Next" class="btn btn-primary"> -->
                                                <input type="button" name="btnClear" id="btnClear" value="Clear" onclick="Clear();" class="btn btn-primary">
                                            </div>
                                            <!-- </div> -->
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <div style="margin-left: 0px;">
                                                        <i>Click on this image to see details.</i>
                                                    </div>

                                                    <div id="MAP" class="box-body" style="overflow-x: scroll; width:100%;">
                                                        <div id="map_demo">

                                                            <div style="width:100%; overflow-x: scroll;height:80%; border:2px solid #c7c9cc; float:left; position:relative; ">

                                                                <img style="width:100%;" id="usa_image" src="<?php echo base_url($map_picture);?>" usemap="#usa">
                                                                <map id="usa" name="usa">
                                                                    <?php echo $dataarea; ?>
                                                                </map>
                                                            </div>

                                                            <!-- <div id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" hidden="true"></div> -->
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
    var tstatus ='';
    var unit_book = '<?php echo $unit_book;?>';

    if (unit_book) {
        txt = unit_book.split(",");
        $('#txt_unit').val(unit_book);
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
        $('div.modal-body').load("<?php echo base_url("c_stepbooking / showland ");?>" + "/" + lot_no);
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
        document.getElementById('loader').hidden=false;
        var lot_unit = $('#txt_unit').val();
        document.getElementById('txt_unit').value = "";
        //update status unit
        var property_cd = '<?php echo $property_cd;?>';
        var site_url = '<?php echo base_url("c_stepbooking/clear_unit")?>';
        var property_cd = '<?php echo $property_cd;?>';
        $.post(site_url, {
                id: lot_unit,
                status: "A",
                property_cd: property_cd
            },
            function(data, status) {
                // console.log(data.Pesan);
                var lot_no = $('#txt_unit').val();
                $('#table1').load("<?php echo base_url('c_stepbooking/goto_table');?> #table1", {
                    "property_cd": property_cd,
                    "lot_no": lot_no
                });
                txt = [];
            document.getElementById('loader').hidden=true;
            }
        );
        //update status unit end
        // alert(property_cd);

    }
function openPage(rowid,property_cd){
  alert(rowid);
}
    var a = 10;
    display = document.querySelector('#time');
    startTimer(a, display);

    function startTimer(duration, display) {
        var timer = duration,
            minutes, seconds;
        setInterval(function() {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = 'Reload In : ' + seconds;
            if (seconds == 0) {
                var property_cd = '<?php echo $property_cd;?>';
                var lot_no = $('#txt_unit').val();
                var id = '<?php echo $rowID;?>';
    // window.location.href = "<?php echo base_url('c_stepbooking/data_unit_landdt')?>/"+id+"/"+property_cd+"/"+lot_no; 
                // $('#MAP').load("<?php echo base_url('c_stepbooking/goto_landed');?> #MAP", {
                //     "property_cd": property_cd,
                //     "lot_no": lot_no,
                //     "map_picture":pict_path
                // });
            }
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

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
            // render_highlight: {
            //     fillColor:  '0066ff',//biru  FF0000     2aff00          
            //     stroke: true
                
            // },
            render_select: {
                fillColor: 'FF8000',//hijau   putih: ffffff 0066ff
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
                    var type = $(this).attr("data-status"); 
                    // if(type !='A'){
                        $(this).mapster('set',true,render[type]);
                    // } 

                    // console.log(type);              
                    

                })
            },
            showToolTip: true,
            toolTipClose: ["area-mouseout"],
            areas:[ <?php echo $keyarea; ?> ] 
           
        };
        map.mapster(default_options);
    // map.mapster({        
    //     onConfigured: function () {

    //         $(this).parent().parent().find("area").each(function(){
    //                 // console.log('otnay');
    //                 // console.log($(this));
    //             var type = $(this).attr("data-status");  
    //             console.log(type);              
    //             $(this).mapster('set',true,render[type]);

    //         })
    //     },
    //     onClick: function (data) {
    //         if (this.href && this.href !== '#') {
    //             window.open(this.href, '_self');
    //         }
    //     }

    // });
      //end Mapster


        $('#btnNext').click(function() {
            // alert('tes');
            var myBookId = $('#txt_unit').val();
            var property_cd = '<?php echo $property_cd;?>';
            var url_ = '<?php echo base_url("c_stepbooking/next/3")?>';
            if (myBookId == "") {

                swal('warning', 'Please Click Unit!');
                return;
            }
            var site_url = "<?php echo base_url('c_stepbooking/set_session')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: {
                    property_cd: property_cd,
                    unit_book: myBookId
                },
                dataType: "json",
                success: function(data, status) {
                    window.location.href = "<?php echo base_url('c_stepbooking/add_customer')?>"; //+'/'+property_cd+'/'+myBookId;

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                }
            })

        });
        $('#btnBack').click(function() {
            // window.history.back();
            var property_cd = '<?php echo $property_cd?>';
            var unit = $('#txt_unit').val();
            window.location.href = "<?php echo base_url('c_stepbooking/index')?>/L/"+property_cd+"/"+unit;
        });
    });
function fn_change_box(Id,checked,from){

   var lot_no = $('#txt_unit').val();
   var arr_lot = lot_no.split(",");
   // var balance = $('#b_val').val();
    var cek = document.getElementById(Id).checked;

      if(checked){      
        landinfo(Id);
      }else{
        var ss = arr_lot.indexOf(Id);
        console.log(ss);
        if(ss < 0){
         
         $('#usa_image').mapster('highlight', false, ID);
         
        }else{
            var property_cd = '<?php echo $property_cd?>';
             var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
                $.post(site_url,
                    {id:Id,status:"A",property_cd:property_cd},
                    function(data,status) {
                         
                     }
                );
        }
        var ind = arr_lot.indexOf(Id);
          if (ind > -1) {
            arr_lot.splice(ind, 1);
          }
          // console.log(arr_lot);
          $('#txt_unit').val(arr_lot);
      }
}  
function fn_oncLick(Id,status,checked,dd ){
        var lot_no = $('#txt_unit').val();
        var arr_lot = lot_no.split(",");
        // tstatus = status;
        // console.log(dd);
        // if(status=='A'){
        //     // if(tstatus==''){
        //     //     console.log('ts1');
        //         tstatus = status;
        //     // }else if(tstatus=='R'){
        //     //     console.log('ts2');
        //     // }  
        // }
        // else if(status=='R'){
        //     tstatus = status;
        // }
        // else if(status=='B'){
        //     tstatus = status;
        // }
        
        
            // var cek = document.getElementById(Id).checked;
            var sas = arr_lot.indexOf(Id);
                // console.log(status);
                console.log(sas);
            if(sas < 0){
                if(status=='A'){
                    tstatus=status;
                }
            }else{
                tstatus='R';
            }
            
            
        // if(checked){      
        // console.log(tstatus);
        if(tstatus=='A'){
           
                landinfo(Id);
        
        }else{
                var ss = arr_lot.indexOf(Id);
                
                if(ss < 0){         
                        $('#usa_image').mapster('highlight', false, ID);  
                        // tstatus ='A';      
                }else{
                    document.getElementById('loader').hidden=false;
                    var property_cd = '<?php echo $property_cd?>';
                    var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
                        $.post(site_url,
                            {id:Id,status:"A",property_cd:property_cd},
                        function(data,status) {
                         // tstatus ='A';
                         $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'} );
                         document.getElementById('loader').hidden=true;
                     }
                );
        }
        var ind = arr_lot.indexOf(Id);
          if (ind > -1) {
            arr_lot.splice(ind, 1);
          }
          // console.log(arr_lot);
          $('#txt_unit').val(arr_lot);
      }
      console.log(tstatus);
}
function landinfo(data)
  {
    
        var property_cd = '<?php echo $property_cd?>';
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
                        $('div.modal-body').load("<?php echo base_url("c_stepbooking/showlanddt");?>"+"/"+data);
                        $('#modal').data('property_cd',property_cd);
                        document.getElementById('loader').hidden=false;
                        $('#modal').modal('show');
                        // modalDialog
                        // $('.modal-dialog').draggable({
                        //     handle: ".modal-header"
                        // });
                        $('#modal').data('Id',data);
    
   
  }

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
</script>

