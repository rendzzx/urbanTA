

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
   border: 1px solid #cecece;
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
h2{
  color:red;
  font-weight: bold;
}

/*.btn:focus{
        background: red;
    */}
</style>
<link href="<?=base_url('css/plugins/blueimp/css/blueimp-gallery.min.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/blueimp/jquery.blueimp-gallery.min.js')?>"></script>
<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>" type="text/javascript"></script>
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
        <div class="tittle-top pull-left"><?php echo $project_name ?></div>
        <div class="tittle-top pull-right">Choose Unit</div>  
      </div>
    </section><br>
         
      <section class="content">    
      <div class="row">      
        <div class="col-xs-12">        
          <div class="ibox-content">
            <div class="box-body">            
            
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
                  <button id="btnback" name="btnback" onclick="tes()" type="button" class="btn abu-bg btn-sm">Back to Main Picture</button>
                  <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-success btn-sm">Process Chosen Units</button>
                 
                  
                </div>                
              </section>
              <div class="form-group">
                    <label class="col-sm-2 control-label" style="clear: left;font-size: 13px">NUP No.</label>
                          
                      <div>
                      <input class="form-control" name="nupno" id="nupno" style="border:none; background-color:white;font-weight: bold;width: 500px"  readonly="readonly" value="<?php echo $NupNO?>">
                      </div>

              
                    <label class="col-sm-2 control-label" style="clear: left;font-size: 13px">Name</label>
                           <!-- <input type="text" class="form-control" name="name" id="contentnewsfeed" placeholder="Content newsfeed"> -->
                      <div>
                      <input class="form-control" name="custname" id="custname" style="border:none; background-color:white;font-weight: bold;width: 500px" readonly="readonly" value="<?php echo $BussName?>">
                      </div>
                
                    <label class="col-sm-2 control-label" style="clear: left;font-size: 13px">Unit</label>
              
                      <div>
                      <input type="text" class="form-control" name="lot_no2" id="lot_no2" style="border:none; background-color:white;color:#ec0303;font-weight: bold;width: 500px" readonly="readonly" >
                      <input type="hidden" class="form-control" name="additional" id="additional" style="border:none; background-color:white;" readonly="readonly" >
                      <input type="hidden" class="form-control" name="payment" id="payment" style="border:none; background-color:white;" readonly="readonly" >
                      <input type="hidden" class="form-control" name="lot_nox" id="lot_nox" style="border:none; background-color:white;" readonly="readonly" >
                      <input type="hidden" class="form-control" style="width:10%;" name="b_val" id="b_val" >
                      </div>                        
              </div>
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
                    <!-- <span id="time"></span> -->
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
                    <map id="usa" name="usa">
        
                        <?php echo $dataarea; ?>
                    </map>
                    <!-- <img style="width:850px;height:580px; border:0;" id="usa_image" src="<?php echo base_url($map_picture);?>" usemap="#usa" > -->
                    </div>
                    <!-- <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" type="hidden"></div> -->
                    <!-- <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" type="hidden"></div> -->
                    <!-- <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" hidden></div> -->

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

    <div id="blueimp-gallery" class="blueimp-gallery">
      <div class="slides"></div>
      <h3 class="title"></h3>
      <a class="prev">‹</a>
      <a class="next">›</a>
      <a class="close">×</a>
      <a class="play-pause"></a>
      <ol class="indicator"></ol>
    </div> 
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
            <div id="header2" class="modal-header2">
                <button type="button" class="close"  data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <!-- <h5 class="modal-title" id="modalTitleimg"></h5> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body1" id="modalBodyimg">
            <img src="" class="imagepop" alt="image" style="width:100%">
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
var default_options;
var myVar;
$('#lot_no2').val('<?php echo $Land;?>');
$('#pl_property').select2();

$('#payment').val('<?php echo $selected_pay;?>');



function myTimer(Id) {
  console.log(Id);
    $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'});
    myStopFunction();
}

function myStopFunction() {
    clearInterval(myVar);
} 
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
$('#modal').on('shown.bs.modal', function () {   
    $(this).find('.close').css({display:'none'});
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
  var getpay = $('#payment').val();
  
   
   window.location.href="<?php echo base_url('c_nup_landedNew/indextipe/')?><?php echo $NupNO?>/<?php echo $pcd ?>/<?php echo $rowid_index?>/<?php echo $status_index?>/"+newbalance+"/"+rowHeader+"/<?php echo $unit?>/"+getInput+"/"+getpay;
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
    var $statelist, $usamap, ratio;
        var map = $('#usa_image'),   

       render = new Array();

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
        
        var default_options =
        {
            fillOpacity: 0.8,
            // render_highlight: {
            //     fillColor:  '00FF00',//biru  FF0000     2aff00          
            //     stroke: true
                
            // },
            render_select: {
                fillColor: '00FF00',//hijau   putih: ffffff 0066ff
                strokeColor: '00FF00'
                // stroke: false
                
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
                // alert('a');
                $(this).parent().parent().find("area").each(function(){
                        // console.log('aa');
                    var status = $(this).attr("data-key");  
                    var unit = $(this).attr("unit");
                    // console.log(status);
                    if(unit == e.key ){
                        fn_change_box(e.key,status,$(this));

                    }

                })
               
            },
            // onConfigured: mapsterConfigured,
            onConfigured: function () {
                // console.log($(this));
                $(this).parent().parent().find("area").each(function(){
                        // console.log($(this));
                    // var type = $(this).attr("data-key"); 
                   
                    // if(type >= 3){
                    //   $(this).mapster('set',true,render['RED']);
                    // }
                    // else{
                    //   $(this).mapster('set',true,render['GREEN']);
                    // }
                    // else{
                    //   $(this).mapster('set',true,render['ORANGE']);
                    // }
                    // else{
                    //   $(this).mapster('set',true,render['GREEN']);
                    // }
                    var type = $(this).attr("data-key"); 
                    var status = $(this).attr("data-status"); 
                   
                    if(type >= 3){
                      $(this).mapster('set',true,render['RED']);
                    } else {
                      $(this).mapster('set',true,render['GREEN']);
                    }
                })
            },
            showToolTip: true,
            toolTipClose: ["area-mouseout"],
            areas:[ <?php echo $keyarea; ?> ] 
           
        };
            $('#make-small').bind('click',function() {
                $('#usa_image').mapster('resize', 720, 0, 450);
            });
            $('#make-big').bind('click',function() {
                $('#usa_image').mapster('resize', 1000, 0, 1000);
            });
        map.mapster(default_options);

    });



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


var b_val= '<?php echo $balance;?>';
$('#b_val').val(b_val); 

function fn_change_box(Id,checked,from){ 
// clearTimeout(startTimer); 
// myStopFunction();
// alert(Id);
console.log(checked);
var balance = $('#b_val').val();
var fn = '';
var lot_no = $('#lot_no2').val();
var lot_nox = $('#lot_nox').val();
var pay = $('#payment').val();
// var add = $('#additional').val();

var arr_lot = lot_no.split(",");
var arr_lotx = lot_nox.split(",");
var arr_pay = pay.split(",");
// var arr_add = add.split(",");

var new_lot = ""; var new_lotx = ""; var new_pay = ""; var new_add = "";

   // var cek = document.getElementById(Id).checked;
   // console.log(Id);

    // var aa = $('#'+Id);
  //   if(cek){
  //     alert('input')
  //   }
  // }else{
    // console.log(balance);
    // console.log('tttt');
    //  var st = arr_lot.indexOf(Id);
    //         console.log(st);
    //         console.log('ggg');
    var ss = arr_lot.indexOf(Id);
            // console.log(ss);
            // console.log('ggg');

            if(ss < 0){   
              // $('#usa_image').mapster('highlight', false, ID);
              fn = 'A';
            }else{
              fn ='B';             
            }
            console.log(fn);
if(fn=='A'){
  // $("#usa_image").mapster('set', true, Id,{fillColor: 'FF0000'} );
  if(balance==0){
    swal('Information','You\'ve already used all your balance','warning');        
            $("#usa_image").mapster('set', false,data );
    }else{
          if(checked < 3){         

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

                

          var ind = arr_lot.indexOf(Id);
          if (ind > -1) {
            arr_lot.splice(ind, 1);
          }

          if(fn=='A'){
            // console.log('jj');
                //   landinfo(Id);       
                  var get_click = $("#usa_image").mapster("get");    
                var arr_get_click = get_click.split(',');
                var lotno = $('#lot_no2').val();
                var lotnox = $('#lot_nox').val();
                // var additional1 = $('#additional').val();
                // var payment1 = $('#payment').val();
                // var additional = $('#txtadd').val();
                // var payment =$('#txtpayment').val();

                // alert(additional1);
                // alert(payment1);
                
                var cnt_arr = arr_get_click.length;
                var this_lotno = Id;
                
                var b =  $('#b_val').val();

                var d = b - 1 ;

                
                    if (d >= 0)
                    {
                        $('#b_val').val(d);
                    }
                    else {
                        swal('Information','You\'ve already used all your balance','warning');
                    }
                    
                    // document.getElementById(Id).checked =true;
                    if (lotno!='')
                    {
                        $('#lot_no2').val(lotno+','+this_lotno);
                        
                        console.log('11111');
                        // $('#additional').val(additional1+','+additional);
                        // $('#payment').val(payment1+','+payment);
                    } else {
                        $('#lot_no2').val(this_lotno);
                        
                        console.log('22222');
                        // $('#additional').val(additional);
                        // $('#payment').val(payment);
                    }    

                  
          }
          

        } 
        else{
          $('#usa_image').mapster('highlight', false, ID);
        }
          }
}else{
  // txtlotno
  // $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'});
  // $('#usa_image').mapster('set', true, Id);
  // alert(Id);
  // console.log(Id+' sak');
   swal({
          title: "Are you sure?",
          text: "You will cancel [ " + Id + " ] unit!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes"
        },
        function(isConfirm) {
          
          if(isConfirm) {
            for (i = 0; i < arr_lot.length; i++) {
              if (arr_lot[i] != Id && new_lot == ""){
                new_lot = arr_lot[i];
              } else if (arr_lot[i] != Id && new_lot != ""){
                new_lot = new_lot + ',' + arr_lot[i];
              } 
            }
            
            var ind = arr_lot.indexOf(Id);
            // alert(ind);
            if (ind > -1) {
              arr_pay.splice(ind, 1);
            }
            $('#payment').val(arr_pay);

            var ind = arr_lot.indexOf(Id);
            // alert(ind);
            if (ind > -1) {
              // arr_add.splice(ind, 1);
            }

          // $('#additional').val(arr_add);          


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

            balance = parseInt(balance) + 1;
            $('#b_val').val(balance);
            // // document.getElementById("lot_no2").text = arr_lot;

            $('#lot_no2').val(new_lot);
            $('#lot_nox').val(new_lotx);
            // $('#usa_image').mapster('highlight',true,Id,{fillColor: '00FF00'});
            // setTimeout($("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'} ), 1000);           
           
            // $("#usa_image").mapster('set',true,Id,{fillColor: 'FFFF00'});
            // myVar =  setInterval(function(){ myTimer(Id) }, 1000);
            // var b =1;
            // display = document.querySelector('#time');
            //     startTimer(b, display);
          } else {
            // $("#usa_image").mapster('set',true,Id,{fillColor: 'FF0000'});
            // alert(Id);
          // $("#usa_image").mapster('set',true,Id);
          }
          

         });
     
           
}
//     if(balance==0){
//       swal('Information','You\'ve already used all your balance','warning');        
//             $("#usa_image").mapster('set', false,data );
//     }else{

        
// } 
   
  
  
}  
   function startTimer(duration, display) {
                    var timer = duration, minutes, seconds;
                    setInterval(function () {
                        minutes = parseInt(timer / 60, 10)
                        seconds = parseInt(timer % 60, 10);

                        minutes = minutes < 10 ? "0" + minutes : minutes;
                        seconds = seconds < 10 ? "0" + seconds : seconds;

                        display.textContent = 'Reload In : '+ seconds;
                        if(seconds==0){
                          $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'});
                        }
                        if (--timer < 0) {
                            timer = duration;
                        }
                    }, 500);
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
  
 var a =20;
// display = document.querySelector('#time');
    // startTimer(a, display);

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
              // window.location.href="<?php echo base_url('c_nup_landed/indexland/')?>"+nupno+"/"+rowid+"/"+pcd+"/"+rowid_index+"/"+status_index+"/"+balance+"/"+rowHd+"/"+unit+"/"+selected_unit;
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
      // var add = $('#additional').val();
      var pay = $('#payment').val();
      // var parseRowid = '<?php echo $RowID; ?>';
        
          var parseLotQty = $('#b_val').val();
          var rowid_index = '<?php echo $rowid_index?>';
          var status_index = '<?php echo $status_index?>';
          var parseNupno = '<?php echo $NupNO?>';
          
          // alert(rowid_index);return;
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
      var jml_lot = lot_no.split(',').length;

      if(lot_no != '' && jml_lot >= 3){
          // alert(balance);
          $('#modalTitle').html('Process New Unit');
          $('div.modal-body').load("<?php echo base_url("c_nup_landedNew/processnew")?>"+"/"+lot_no);
          $('#modal').data('xlot_no',xlot_no);
          $('#modal').data('parseLotQty',parseLotQty);
          $('#modal').data('rowid_index',rowid_index);
          $('#modal').data('status_index',status_index);
          $('#modal').data('parseNupno',parseNupno);
          $('#modal').data('RowID',b);
          $('#modal').data('id', lot_no).modal('show');
          

      }else{
        swal('Information','Please choose minimum 3 units','warning');
      }

      // alert(lot_no);
     
        // });
        // setTimeout(function () {
        //           window.location.href = url_booking;
        //                     }, 1500);  
        // var LotNumber = $('#txtlotno').val();
        // $('#modal').modal('hide');
    }
    function Booking2(lot_no, xlot_no, pay){
          // var LotNumber = $('#txtlotno').val();
          // alert(lot_no);
          var parseRowid = '<?php echo $RowID; ?>';
          // alert(parseRowid);
          // return;
          var parseLotQty = $('#b_val').val();//'<?php echo $balance;?>';
          var rowid_index = '<?php echo $rowid_index?>';
          var status_index = '<?php echo $status_index?>';
          var parseNupno = '<?php echo $NupNO?>';
          // var parseNupNo = <?=$NupNO?>;
          // console.log(parseNupno);
          // alert(parseNupNo);
          $.ajax({
                    url : "<?php echo base_url('c_nup_unit/validasiNew');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    // data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    data: {LotNumber:lot_no,
                          rowid:parseRowid,
                          lotqty:parseLotQty,
                          xlot_no:xlot_no,
                          // add:add,
                          pay:pay},
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
                        
                        $('#modal').modal('hide');

                       
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                     
                                swal({
                                      title: "Information",
                                      animation: false,
                                      type:"error",
                                      text: textStatus+' Save : '+errorThrown,
                                      confirmButtonText: "OK"
                                    });
                     
                    }
                    });

}
</script>

 



  


