

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
        <div class="tittle-top pull-right">Choose Unit </div>  
      </div>
    </section><br>
         
      <section class="content">    
      <div class="row">      
        <div class="col-xs-12">        
          <div class="ibox-content">
            <div class="box-body">           
            
            <div class="form-group">
        
            </div>
            <div class="form-group">
              
              
              
            </div>
            <section class="content-header">
                <div class="pull-right"> 
                  
                  <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-success btn-sm">Process</button>
                  <button id="btnback" name="btnback" onclick="tes()" type="button" class="btn abu-bg btn-sm">Back</button>
                </div>                
              </section>
              <label class="col-xs-1 control-label" style="height:34px;vertical-align: middle;padding: 6px 12px;font-size: 13px">Unit</label>
               <div class="form-group">
                           <div class="pull-left" >
                            <input type="text" class="form-control" name="lot_no2" id="lot_no2" style="border:none; background-color:white;width:80%;" readonly="readonly" >
                            <input type="text" class="form-control" name="lot_nox" id="lot_nox" style="border:none; background-color:white;width:80%;" readonly="readonly" >
                            <input type="hidden" class="form-control" style="width:10%;" name="b_val" id="b_val" >
                           </div>
                          
                </div>
            
            <br><br> <br>
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
                    <!-- <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;" hidden></div> -->

                    <div style="clear:both; height:8px;"></div>
                        

                    <div>                        
                        
                    </div>
                      
                         <button id="make-small" name="make-small" type="button" class="btn btn-primary btn-sm">Fit Screen</button>
                         <button id="make-big" name="make-big"  type="button" class="btn btn-primary btn-sm">Actual Size</button>

                         
                </div>
           
            </div>
            <div class="box-footer">
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
      
    // $(document).ready(function () {
      
    //    // var x = '<?php echo $nupCounter;?>';
    //    // alert(x);
    //    render = new Array();

    //     render["free"] = {
    //         fillColor: '68f442',
    //         strokeColor: 'f45942',
    //     };

    //     render["sold"] = {
    //         fillColor: 'f45942',
    //         strokeColor: '68f442',
    //     };

    //     render["reserve"] = {
    //         fillColor: '5342f4',
    //         strokeColor: '5342f4',
    //     };

    //     var $statelist, $usamap, ratio,
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

    //         $(this).parent().parent().find("area").each(function(){
    //           var type = $(this).attr("data-key");                
    //           $(this).mapster('set',true,render[type]);
    //         });         

    //     },
    //     // var area = '<?php echo $keyarea; ?>';
    //     //     console.log(area);
    //     default_options =
    //     {
    //         fillOpacity: 0.5,
    //         render_highlight: {
    //             fillColor:  '2aff00',//biru                
    //             stroke: true
                
    //         },
    //         render_select: {
    //             fillColor: 'ff000c',//'0066ff',//hijau   putih: ffffff
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
    //            // selected = true;
               
    //            // $('#'+e.key).prop('checked', e.selected);
    //            document.getElementById(e.key).checked =e.selected;
    //            fn_change_box(e.key,e.selected,'fn');
               
    //            //  if (e.key==='OH') {
    //            //     $usamap.mapster('zoom','OH');
    //            //      return false;
    //            //  }
    //            // return true;
    //         },
    //         onConfigured: mapsterConfigured,
    //         showToolTip: true,
    //         toolTipClose: ["area-mouseout"],
    //         areas:[ <?php echo $keyarea; ?> ] 
           
    //     };

    $(document).ready(function(e) {
      //start Mapster
     var $statelist, $usamap, ratio;
        var map = $('#usa_image'),

        render = new Array();

        render["RED"] = {
            fillColor: 'ff000c',
            strokeColor: 'ff000c',
        };

        render["GREEN"] = {
            fillColor: '00FF00',
            strokeColor: '00FF00',
        };

        // render["B"] = {
        //     fillColor: 'FF0000',
        //     strokeColor: 'FF0000',
        // };
        var default_options =
        {
            fillOpacity: 0.5,
            
            render_select: {
                fillColor: 'FF8000',//hijau   putih: ffffff 0066ff
                stroke: false
                
            },     
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
                        // fn_oncLick(e.key,status,e.selected,$(this));
                    }            
                })
               
            },
            // onConfigured: mapsterConfigured,
            onConfigured: function () {

                $(this).parent().parent().find("area").each(function(){
                    var type = $(this).attr("data-key"); 
                      if (type < 3){                        
                        $(this).mapster('set',true,render['RED']);
                      }else{
                        $(this).mapster('set',true,render['GREEN']);
                      }
          
                })
            },
            showToolTip: true,
            toolTipClose: ["area-mouseout"],
            areas:[ <?php echo $keyarea; ?> ] 
           
        };
        map.mapster(default_options);

        function fn_oncLick(Id,status,checked,dd ){
        var lot_no = $('#txt_unit').val();
        var arr_lot = lot_no.split(",");
       
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



  


