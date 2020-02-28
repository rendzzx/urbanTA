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
    <div class="row border-bottom white-bg dashboard-header">
        <div class="form-group">
            <div class="tittle-top pull-left"><?php echo $projectName; ?></div>
            <div class="tittle-top pull-right">ROI Reguler</div>
        </div>
    </div><br>
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
                <div class="col-sm-10">
        <input type="hidden" name="cl_colour" id="cl_colour" width="100%" value='<?php echo $ms_colour;?>' class="form-control" >
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
                            <!-- <div class="col-sm-12">
                                <div class="col-sm-2">
                                    <label class="control-label">Legend</label>
                                </div>
                                <div class="col-sm-3"><img style="width:100%;" id="ap" src="<?php echo base_url('img/ap.png');?>"></div>
                                <div class="col-sm-3"><img style="width:100%;" id="anp" src="<?php echo base_url('img/anp.png');?>"></div>
                                <div class="col-sm-3"><img style="width:100%;" id="fb" src="<?php echo base_url('img/fb.png');?>"></div>
                            </div> -->
                            <!-- <div class="panel panel-primary"> -->
                                <!-- <div class="panel-heading">
                                    <h3 class="panel-title">Choose Unit Landed Detail</h3>
                                </div> -->
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

                                                                    <img style="width:100%;" id="usa_image" src="<?php echo base_url($map_picture);?>" usemap="#usa">
                                                                <map id="usa" name="usa">
                                                                    <?php echo $dataarea; ?>
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
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div id="headermodal" class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                        
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
var dataWarna = new Array();
// alert($('#cl_colour').val());
dataWarna = JSON.parse($('#cl_colour').val());
// console.log(dataWarna);
loaddata();
$('#txtType').select2();
$('#txtDirection').select2();
$('#txtPrice').select2();
function myTimer(Id,Type) {
  // console.log(Id);
    // $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'});
    
        // var type = $('#modal').data('nup_counter');
        var a = dataWarna[Type]["fillColor"];
        // console.log(Type);
        // console.log(dataWarna[Type]["fillColor"]);
        // console.log(a);
        $("#usa_image").mapster('set',true,Id,{fillColor: a,strokeColor:'000000'});
        
    
    myStopFunction();
}

function myStopFunction() {
    clearInterval(myVar);
} 


   


$('#modal').on('shown.bs.modal', function () {   
       $(this).find('.ui-dialog-titlebar-close').css({visibility: false});
  });

    var txt = [];
    var txt_descs = [];
    var tstatus ='';
    var unit_book = '<?php echo $unit_book;?>';
    var descs_temp = '<?php echo $descs_temp;?>';
    var lot_descs = '<?php echo $lot_descs; ?>';


    if (unit_book) {
        txt = unit_book.split(",");
        txt_descs = lot_descs.split(",");

        if(lot_descs){
            $('#lot_descs').val(lot_descs);
        }else{
            $('#lot_descs').val(descs_temp);
        }

        $('#lot_no2').val(unit_book);
        // $('#lot_descs').val(descs_temp);
        
    }

    function hasClass(element, cls) {
        return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
    }


    function Clear() {
        document.getElementById('loader').hidden=false;
        var lot_unit = $('#lot_no2').val();
        document.getElementById('lot_no2').value = "";
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
                var lot_no = $('#lot_no2').val();
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

    var a = 10;
    // display = document.querySelector('#time');
    // startTimer(a, display);

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
                var lot_no = $('#lot_no2').val();
                var id = '<?php echo $rowID;?>';
    
            }
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    function loader(){
        document.getElementById('loader').hidden=false;
    }
    

    $(document).ready(function(e) {
        
     
    
    // askColour(function(_colour){
        
     var $statelist, $usamap, ratio;
        var map = $('#usa_image');
        var render = new Array();

        render["ORANGE"] = {
            fillColor: 'FF8000',
            strokeColor: 'FF8000',
        };

        render["GREEN"] = {
            fillColor: '00FF00',
            strokeColor: '00FF00',
        };

        render["RED"] = {
            fillColor: 'FF0000',
            strokeColor: 'FF0000',
        };
        // alert('11');
        var default_options =
        {
            fillOpacity: 0.5,
            // render_highlight: {
            //     fillColor:  'FF0000',//biru  FF0000     2aff00          
            //     stroke: true
                
            // },
            render_select: {
                fillColor: 'FF8000'
                // ,//hijau   putih: ffffff 0066ff
                // strokeColor: '000000',
                // stroke: true
                
            },
            //render_zoom: {
            //    altImage: 'images/usa_map_huge.jpg'
            //},
            mouseoutDelay: 0,
            fadeInterval: 50,
            isSelectable: true,
            singleSelect: false,
            // mapKey: 'state',
            strokeWidth: 2,
            // staticState:false,
            mapKey: 'unit',
            mapValue: 'full',
            listKey: 'name',
            // listSelectedAttribute: 'checked',
            sortList: "ASC",
            // onGetList: addCheckBoxes,
            onClick: function (e) {
                // console.log(e);
                loader();
                // document.getElementById('loader').hidden=false;
                // console.log('2');
                 // alert(document.getElementById('loader').hidden=false);
                // console.log(e);
                // document.getElementById('loader').hidden=false;
                // console.log(e);
                // alert('sdf');
                // return;
                // landinfo(e.key,0); 
                $(this).parent().parent().find("area").each(function(){
                    
                        
                    var status = $(this).attr("data-key");  
                    var unit = $(this).attr("unit");  
                   

                    if(unit == e.key ){
                        // alert('aa');
                //         // fn_oncLick(e.key,status,e.selected,$(this));
                        fn_change_box(e.key,status,$(this));
                        
                        
                    }
                    // document.getElementById('loader').hidden=true;

                })
               
            },
            // onConfigured: mapsterConfigured,
            onConfigured: function () {   
            // askColourNew();             
                 // var vv = 'sdf';
                 // console.log(e);
                 // console.log(render);
                 // alert('12');
                 console.log($(this).parent().parent().find("area"));
                    $(this).parent().parent().find("area").each(function(){         
                                    
                       var type = $(this).attr("data-status");
                       var Aktif = $(this).attr("data-aktif"); 
                       var cl = dataWarna[type]["fillColor"];
                       var descs =  $(this).attr("data-descs"); 
                       // console.log(dataWarna);
                        // console.log(_colour[type)              "70ed5c"     
                        // $(this).mapster('set',true,dataWarna[type]);
                        if(Aktif=='A'){
                            $(this).mapster('set',true,{fillColor:dataWarna[type]["strokeColor"]});
                        }else{
                            $(this).mapster('set',true,{fillColor:cl});
                        }

                        // if(descs != ' '){
                        //     txt_descs = descs;
                        // }

                        // $(this).mapster('set',true,{fillColor:"000000"});
                        // console.log(_colour[type]);
                        // $(this).mapster('set',true,render['RED']);
   
                    })
                    // $('#lot_descs').val(txt_descs);
                            
                // }); 
            },
            showToolTip: true,
            toolTipClose: ["area-mouseout"],
            areas:[ <?php echo $keyarea; ?> ] 
           
        };


            $('#make-small').bind('click',function() {
                // $('#usa_image').mapster('resize', 720, 0, 450);
                $('#usa_image').mapster('resize', 257, 0, 513);
            });
            $('#make-big').bind('click',function() {
                $('#usa_image').mapster('resize', 1000, 0, 1000);
            });
            
            map.mapster(default_options);
         // }); 
           // }
           //  );
      //end Mapster
      // console.log(render);

        $('#btnNext').click(function() {
            // alert('tes');
            var myBookId = $('#lot_no2').val();
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
        $('#btnBack').click(function() {
            var myBookId = $('#lot_no2').val();
            var lot_descs = $('#lot_descs').val();
            // if (myBookId == "") {

            //     swal('Warning', 'Please Click Unit!',"warning");
            //     return;
            // }
            var site_url = "<?php echo base_url('c_nup_landed_cfld_dt/set_session')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: {
                    unit_loop : myBookId,
                    descs_loop : lot_descs
                },
                dataType: "json",
                success: function(data, status){
                    window.location.href = "<?php echo base_url('c_nup_landed_cfld/index')?>";
                },
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus + ' Save : ' + errorThrown);
                }
            })
        
            // window.location.href = "<?php echo base_url('c_nup_landed_cfld/index')?>";
        });
    });

function fn_change_box(Id,nup_counter,from){ 
// document.getElementById('loader').hidden=false;
// return;
    var Type = "A"+nup_counter;
    var fn = '';
    var lot_no = $('#lot_no2').val();
    var lot_nox = $('#lot_nox').val();
    var lot_descs = $('#lot_descs').val();

    var arr_lot = lot_no.split(",");
    var arr_lotx = lot_nox.split(",");    
    var arr_descs = lot_descs.split(",");

    var new_lot = ""; var new_lotx = ""; var new_descs = "";
    var ss = arr_lot.indexOf(Id);

            if(ss < 0){   
              fn = 'A';
            }else{
              fn ='B';             
            }
            console.log(fn); 

if(fn=='A'){
    console.log(nup_counter);

            if(nup_counter < 3){             
                  for (i = 0; i < arr_lot.length; i++) {
                    if (arr_lot[i] != Id && new_lot == ""){
                      new_lot = arr_lot[i];
                    } else if (arr_lot[i] != Id && new_lot != ""){
                      new_lot = new_lot + ',' + arr_lot[i];
                    } 
                  }
       
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

                

          var ind = arr_lot.indexOf(Id);
          if (ind > -1) {
            arr_lot.splice(ind, 1);
          }
          console.log(fn); 
          if(fn=='A'){

                  landinfo(Id,nup_counter); 
                  // document.getElementById('loader').hidden=true;             

                  
          }


        }else{
            // alert('12');
            document.getElementById('loader').hidden=true;   
          $('#usa_image').mapster('highlight', false, ID);
        }
    
    }else{
          for (i = 0; i < arr_lot.length; i++) {
            if (arr_lot[i] != Id && new_lot == ""){
              new_lot = arr_lot[i];
            } else if (arr_lot[i] != Id && new_lot != ""){
              new_lot = new_lot + ',' + arr_lot[i];
            } 
          }
          console.log(new_lot);

          var ind = arr_lot.indexOf(Id);
            if (ind > -1) {
                arr_descs.splice(ind, 1);
            }

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
          console.log(new_lotx);

          // balance = parseInt(balance) + 1;
          //   $('#b_val').val(balance);
         
            $('#lot_no2').val(new_lot);
            $('#lot_nox').val(new_lotx);
            $('#lot_descs').val(arr_descs);
         
            myVar =  setInterval(function(){ myTimer(Id,Type) }, 1000);
            document.getElementById('loader').hidden=true; 
    }
}  
function landinfo(data,nup_counter)
  {
    // document.getElementById('loader').hidden=true;
    // return;
    // console.log(nup_counter);
    document.getElementById('loader').hidden=true;
    var chosen_unit = $('#lot_no2').val();
    

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
                        $('div.modal-body').load("<?php echo base_url("c_nup_landed_cfld_dt/showland");?>"+"/"+data);

                        // $('div.modal-body').load("<?php echo base_url("c_menu/addnew");?>");

                        $('#modal').data('property_cd',property_cd);
                        
                        
                        // modalDialog
                        // $('.modal-dialog').draggable({
                        //     handle: ".modal-header"
                        // });nup_counter
                        $('#modal').data('chosen',chosen_unit);
                        $('#modal').data('Id',data);
                        $('#modal').data('Type','R');
                        $('#modal').data('nup_counter','A'+nup_counter);
                        $('#modal').modal('show');
    
   
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
function fn_Clearsearch(){
    var rowid = '<?php echo $rowID;?>';
    var property_cd = '<?php echo $property_cd;?>';
    var bb = '<?php echo base_url("c_nup_landed_cfld_dt/data_unit_landdt");?>'+"/"+rowid+"/"+property_cd+"/";
    window.location.href = bb;
}
function fn_search1(){

    var rowid = '<?php echo $rowID;?>';
    var property_cd = '<?php echo $property_cd;?>';
    var bb = '<?php echo base_url("c_nup_landed_cfld_dt/data_unit_landdt");?>'+"/"+rowid+"/"+property_cd+"/";
    var Type = $('#txtType').val();
    var Direction = $('#txtDirection').val();
    var Price = $('#txtPrice').val();
    var lot_no = $('#lot_no2').val();

    if(lot_no !=""){
        lot_no = lot_no;
    }else{
        lot_no = "null";
    }

    console.log(Price);
    var where="";
    if(Type != ""){
        // where = "AND type='"+Type+"'";
        where = "null/"+Type;
    }
    if(Direction!=""){
        if(where !=""){
            where = where+"/"+Direction;
        }else{
            where = "null/null/"+Direction;
        }
        
    }else{
        if(Type !="" && Price!=""){
            where = where + "/null/"
        }
        
    }

    if(Price !=""){
        if(where !=""){
            where = where+"/"+Price;
        }else{
            where = "null/null/null/"+Price;
        }
    }
    // console.log(bb+where);
    
    window.location.href = bb+where;
}

function fn_search(){

    var rowid = '<?php echo $rowID;?>';
    var property_cd = '<?php echo $property_cd;?>';
    var bb = '<?php echo base_url("c_nup_landed_cfld_dt/data_unit_landdt");?>'+"/"+rowid+"/"+property_cd+"/";
    var Type = $('#txtType').val();
    var Direction = $('#txtDirection').val();
    var Price = $('#txtPrice').val();
    var lot_no = $('#lot_no2').val();

    if(lot_no !=""){
        lot_no = lot_no;
    }else{
        lot_no = "null";
    }

    // alert(lot_no);

    console.log(Price);
    var where="";
    if(Type != ""){
        // where = "AND type='"+Type+"'";
        where = lot_no+"/"+Type;
    }
    if(Direction!=""){
        if(where !=""){
            where = where+"/"+Direction;
        }else{
            where = lot_no+"/null/"+Direction;
        }
        
    }else{
        if(Type !="" && Price!=""){
            where = where + "/null/"
        }
        
    }

    if(Price !=""){
        if(where !=""){
            where = where+"/"+Price;
        }else{
            where = lot_no+"/null/null/"+Price;
        }
    }
    // console.log(bb+where);
    
    window.location.href = bb+where;
}

function loaddata(){
    console.log('123');
    var type = '<?php echo $type;?>';
    var property_cd = '<?php echo $property_cd?>';
    var Direction = '<?php echo $direction;?>';
    var Price = '<?php echo $Price;?>';
    var site_url = '<?php echo base_url("c_nup_landed_cfld_dt/zoom_type")?>';
            $.post(site_url,
                {property_cd:property_cd,type:type},
                function(data,status) {
                    $("#txtType").empty();
                    $("#txtType").append(data);
                    $("#txtType").trigger('change');
                }
                );
    var site_url = '<?php echo base_url("c_nup_landed_cfld_dt/zoom_direction")?>';
            $.post(site_url,
                {Direction:Direction},
                function(data,status) {
                    $("#txtDirection").empty();
                    $("#txtDirection").append(data);
                    $("#txtDirection").trigger('change');
                }
                );
    var site_url = '<?php echo base_url("c_nup_landed_cfld_dt/Price")?>';
            $.post(site_url,
                {Price:Price,property_cd:property_cd},
                function(data,status) {
                    $("#txtPrice").empty();
                    $("#txtPrice").append(data);
                    $("#txtPrice").trigger('change');
                }
                );
            console.log('321');
    
}
function askColour(callback)
{
    // var strUrl = "functions.php";
    var site_url = '<?php echo base_url("c_nup_landed_cfld_dt/ms_colour")?>';
    // var mm = new Array();
    jQuery.ajax({
       url:site_url, 
       success:callback, 
       dataType: "json" 
       // ,
       // success: function(data, status) {
       //  callback = data;
       // }
        
    });
    // return mm;
}
function askColourNew()
{
    // var strUrl = "functions.php";
    var site_url = '<?php echo base_url("c_nup_landed_cfld_dt/ms_colour")?>';
    // var mm = new Array();
    jQuery.ajax({
       url:site_url, 
       // success:callback, 
       dataType: "json" 
       ,
       success: function(data, status) {
        // callback = data;
        $('#cl_colour').val(JSON.stringify(data));
       }
        
    });
    // return mm;
}
</script>

