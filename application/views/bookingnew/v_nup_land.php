

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
<div id="loader" class="loader" hidden="true"></div>
   <div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
      <div class="form-group">
        <div class="judulprojek"><?php echo $project_name ?></div>
        <div class="tittle-top pull-right">Booking Unit</div>  
      </div>
    </section><br>
         
      <section class="content">    
      <div class="row">      
        <div class="col-xs-12" style="padding-right: 0px;padding-left: 0px;">        
          <div class="ibox-content" style="padding-right: 10px;padding-left: 10px;">
            <div class="box-body">            
         
            <!-- <div class="form-group">
             
            </div>
            <div class="form-group">
              
              
              
            </div> -->
            <section class="content-header">
                

                <div class="pull-right"> 
                  
                  <button id="btnback" name="btnback" onclick="tes()" type="button" class="btn abu-bg btn-sm">Back to Main Picture</button>
                  <!-- <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-success btn-sm">Process Chosen Units</button> -->
                  <button id="make-small" name="make-small" type="button" class="btn btn-primary btn-sm">Fit Screen</button>
                  <button id="make-big" name="make-big"  type="button" class="btn btn-primary btn-sm">Actual Size</button>
                  
                  
                </div>                
              </section>
              
               <div class="form-group">
                  <label class="col-sm-2 control-label" style="clear: left;font-size: 13px">Unit</label>              
                    <div>
                      <input type="text" class="form-control" name="lot_no2" id="lot_no2" style="border:none; background-color:white;color:#ec0303;font-weight: bold;width: 500px" readonly="readonly" >
                      <input type="hidden" class="form-control" name="lot_nox" id="lot_nox" style="border:none; background-color:white;" readonly="readonly" >
                    </div>              
              </div>
                          
         
               
            <div style="margin-left: 0px;">
             <font color="red"> <i>Please choose unit from the picture below.</i></font>
            </div>
                  
          <!-- <div style="border:3px solid #8e8e8e"> -->
            <div id="MAP" class="box-body" style="overflow-x: scroll; width:100%;">
            <!-- <div id="MAP" class="box-body" style="width:100%;"> -->
                <div id="map_demo" style=" overflow-y: auto;"> 
                  
                    <!-- <div style="text-align:left; width:100%; height:100%; border:0; overflow: hidden; float:left; overflow:auto; position:relative;"> -->
                   <div style="width:100%; overflow-x: scroll;height:100%; border:2px solid #c7c9cc; float:left; position:relative; ">

                    <img style="width:100%;" id="usa_image" src="<?php echo $map_picture;?>" usemap="#usa" >
                    <map id="usa" name="usa">
                    <?php echo $dataarea; ?>
                    </map>
                    
                    </div>
                    

                    <div style="clear:both; height:8px;"></div>
                        

                    <div>
                      
                        
                    </div>
                     
                         <!-- <button id="make-small" name="make-small" type="button" class="btn btn-primary btn-sm">Fit Screen</button>
                         <button id="make-big" name="make-big"  type="button" class="btn btn-primary btn-sm">Actual Size</button> -->

                         
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


 <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">          
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="padding-left: 10px !important;padding-right: 10px !important;">
            
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

$('#pl_property').select2();




function myTimer(Id) {
  console.log(Id);
    $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'});
    myStopFunction();
}

function myStopFunction() {
    clearInterval(myVar);
} 
$('#modal').on('shown.bs.modal', function () {   
    $(this).find('.close').css({display:'none'});
  });
function back(){

 window.location.href="<?php echo base_url('booking/indextipe/')?><?php echo $pcd ?>/";
}
function tes() {
  window.location.href="<?php echo base_url('booking/indextipe/')?><?php echo $pcd ?>";
  
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
            render_highlight: {
                fillColor:  '777777',// fillColor:  '00FF00',//ijo //biru  FF0000     2aff00          
                stroke: true
                
            },
            render_select: {
                fillColor: 'FF0000',//hijau   putih: ffffff 0066ff
                strokeColor: 'FF0000'
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
                    // var nupcount = $(this).attr("data-key");

                    // console.log(nupcount);
                    
                   
                    var unit = $(this).attr("unit");
                    var type = $(this).attr("type");
                    // console.log('unit:'+unit+'--'+'key:'+e.key);
                    // console.log($(this));
                     // if(status =='B'){
                      
                    // } else {
                      if(unit == e.key ){
                        openPage(e.key,type);
                      }
                    // } 

                })
               
            },
            // onConfigured: mapsterConfigured,
            onConfigured: function () {
                // console.log($(this));
                $(this).parent().parent().find("area").each(function(){
                        // console.log($(this));
                    var type = $(this).attr("data-key"); 
                    var status = $(this).attr("data-status"); 
                   
                    if(status == 'A'){
                      $(this).mapster('set',true,render['GREEN']);
                    } else {
                      $(this).mapster('set',true,render['RED']);
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

function openPage(unit,type){
      
window.location.href="<?php echo base_url('booking/getPrice/')?>"+unit+"/"+type;
       
      }


// function fn_change_box(Id,type,from){ 


// var fn = '';
// var lot_no = $('#lot_no2').val();
// var lot_nox = $('#lot_nox').val();


// var arr_lot = lot_no.split(",");
// var arr_lotx = lot_nox.split(",");


// var new_lot = ""; var new_lotx = ""; 

//     var ss = arr_lot.indexOf(Id);
//             // console.log(ss);
//             // console.log('ggg');

//             // if(ss < 0){   
//             //   // $('#usa_image').mapster('highlight', false, ID);
//             //   fn = 'A';
//             // }else{
//             //   fn ='B';             
//             // }
//  fn = from[0].attributes['data-status'].value; 
//             console.log();

// if(fn=='A'){
       

//           // txtlotno
//           for (i = 0; i < arr_lot.length; i++) {
//             if (arr_lot[i] != Id && new_lot == ""){
//               new_lot = arr_lot[i];
//             } else if (arr_lot[i] != Id && new_lot != ""){
//               new_lot = new_lot + ',' + arr_lot[i];
//             } 
//           }
//           // alert(new_lot);

//           // txtlotno2
//           for (i = 0; i <= arr_lotx.length; i++) {
//             if (i == 0){
//               new_lotx = arr_lotx[i];
//             } else if (i == arr_lotx.length && lot_nox != "") {
//               new_lotx = new_lotx + ',' + Id;
//             } else if (i == arr_lotx.length && lot_nox == "") {
//               new_lotx = Id;
//             } else {
//               new_lotx = new_lotx + ',' + arr_lotx[i];
//             } 
//           }

                

//           var ind = arr_lot.indexOf(Id);
//           if (ind > -1) {
//             arr_lot.splice(ind, 1);
//           }

//           if(fn=='A'){
//             // console.log('jj');
//                   landinfo(Id,type);              

                  
//           }
         

       
// }else{
//    // swal({
//    //        title: "Are you sure?",
//    //        text: "You will cancel [ " + Id + " ] unit!",
//    //        type: "warning",
//    //        showCancelButton: true,
//    //        confirmButtonColor: "#DD6B55",
//    //        confirmButtonText: "Yes"
//    //      },
//    //      function(isConfirm) {
//    //        if(isConfirm) {
//    //          for (i = 0; i < arr_lot.length; i++) {
//    //          if (arr_lot[i] != Id && new_lot == ""){
//    //            new_lot = arr_lot[i];
//    //          } else if (arr_lot[i] != Id && new_lot != ""){
//    //            new_lot = new_lot + ',' + arr_lot[i];
//    //          } 
//    //        }
          
                 


//    //        // alert(new_lot);
//    //        // txtlotno2
//    //        for (i = 0; i <= arr_lotx.length; i++) {
//    //          if (i == 0){
//    //            new_lotx = arr_lotx[i];
//    //          } else if (i == arr_lotx.length && lot_nox != "") {
//    //            new_lotx = new_lotx + ',' + Id;
//    //          } else if (i == arr_lotx.length && lot_nox == "") {
//    //            new_lotx = Id;
//    //          } else {
//    //            new_lotx = new_lotx + ',' + arr_lotx[i];
//    //          } 
//    //        }

//    //          $('#lot_no2').val(new_lot);
//    //          $('#lot_nox').val(new_lotx);
           
//    //        } else {
//    //          $("#usa_image").mapster('set',true,ID,{fillColor: 'FF0000'});
//    //        }
          

//    //       });
//      $("#usa_image").mapster('set',true,ID,{fillColor: 'FF0000'});
           
// }

   
  
  
// }  
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
function landinfo(data,type)
  { 

    var balance = $('#b_val').val();
    var pcd='<?php echo $pcd?>';
    // var property_type ='<?php echo $ptype;?>';

    // alert(pcd);
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
                        
                        $('#modalTitle').html('Unit Detail Information');
                        // alert(data);
                        // alert(property_type);
                        // alert(pcd);
                        $('div.modal-body').load("<?php echo base_url("booking/showland");?>"+"/"+data +"/"+type);
                        $('#modal').data('balance',balance);
                        $('#modal').modal('show');
                       
                        $('#modal').data('Id',data);
    
   
  }
 
    
</script>
<script type="text/javascript">
  
 var a =20;


function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = 'Reload In : '+ seconds;
            if(seconds==0){
              var selected_unit = $('#lot_no2').val();
              
            }
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

</script>

 



  


