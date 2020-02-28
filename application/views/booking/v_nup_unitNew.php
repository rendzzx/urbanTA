<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url('bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="<?=base_url('plugins/font-awesome/css/font-awesome.min.css')?>">
  <!-- Image preview -->
  <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('plugins/imagepreview/imgpreview.css')?>"> -->

  <link href="<?=base_url('plugins/select2/select2.min.css')?>" rel="stylesheet" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('dist/css/AdminLTE.min.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('dist/css/skins/_all-skins.min.css')?>">
  <!-- jQuery 2.2.0 -->
  <script src="<?=base_url('plugins/jQuery/jQuery-2.2.0.min.js')?>"></script>

  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
  <script type="text/javascript" src="<?=base_url('plugins/confirmationDialog/bootstrap.min.js')?>"></script>
  <!-- <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/css/bootstrap-dialog.min.css">--> 
  <link rel="stylesheet" type="text/css" href="<?=base_url('plugins/confirmationDialog/bootstrap-dialog.min.css')?>">  
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/js/bootstrap-dialog.min.js"></script>-->
  <script type="text/javascript" src="<?=base_url('plugins/confirmationDialog/bootstrap-dialog.min.js')?>"></script>

<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}

/*.btn:focus{
        background: red;
    */}
</style>

<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
<!-- <script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script> -->
   <div class="">
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
                      </select> 
                    </div>
                  </div>                 
                 <!--  <div class="pull-right">
                    <span id="time"></span>
                  </div> -->                  
                <!-- </section>                         -->
            </div>
            <div class="form-group">
              <label for="pl_project" class="col-sm-1 control-label">Level</label>              
              <!-- <section class="content-header"> -->
                <div class="form-group">
                  <div class="pull-left">
                    <select name="level_no" id="level_no" data-placeholder="Choose a Level..." class="chosen-select" style="width:250px;" tabindex="2">
                      <option selected="1" value="L">All Unit</option>                                   
                      <?php echo $level_no; ?>      
                    </select>
                  </div>
                  <div class="pull-right">
                    <span id="time"></span>
                  </div>
                </div>
              <!-- </section> -->
            </div>
            <div class="form-group">
              <label for="test" class="col-sm-1 control-label"></label>
              <!-- <div class="col-sm-8">
                <b><input type="text" id="txtlotno" name="txtlotno" value="" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly"></b>
                
              </div>
              <div class="col-sm-3">
                <button id="btnclear" name="btnclear" onclick="reset()" type="button" class="btn btn-success btn-sm">Clear</button>
                <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-success btn-sm">Proses</button>
                <!-- <button id="btnsubmit" name="btnsubmit" onclick="close(a)" type="button" class="open-AddBookDialog btn btn_block btn-success">Close</button> -->
                <!-- <a href="<?=base_url('c_nup_dt/list_dt/')?>/<?=$NupNO?>" class="btn btn-success btn-sm">Close</a> -->
                <!-- <?php echo $LotQty; ?> -->
              <!-- </div> -->
              <section class="content-header">
                <div class="form-group">
                  <div class="pull-left col-sm-8">
                    <b><input type="text" id="txtlotno" name="txtlotno" value="" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly"></b>
                  </div>
                </div>
                <div class="pull-right">
                  <button id="btnclear" name="btnclear" onclick="reset(this)" type="button" class="btn bg-orange btn-sm">Clear</button>
                  <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-danger btn-sm">Process</button>
                  <!-- <button id="btnsubmit" name="btnsubmit" onclick="close(a)" type="button" class="open-AddBookDialog btn btn_block btn-success">Close</button> -->
                  <a href="<?=base_url('c_nup_dt/list_dtNew/')?>/<?=$NupNO?>" class="btn bg-orange btn-sm">Back</a>  
                </div>                
              </section>
            </div>
            <br><br> 
              <div id="load" hidden="true"></div>
              <!-- <div id="isiTable"> -->
                <!-- <table id="table1" class="table table-bordered table-hover dataTable"> -->
                <table id="table1" class="table table-hover dataTable">
                <thead>
                  <tr>
                    <th class="col-xs-1">Floor</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>                
                   <?php 
                    // if(!empty($userLevelList['AllData'])) {
                    //   $ListAllData = '';
                    //   foreach ($userLevelList['AllData'] as $value) {
                    //     $bb = $value->level_no;

                    //     $AllDataUnitLevel = array_filter($userLevelList['AllDataUnit'], function($a) use($bb){
                    //       return $a->level_no===$bb;
                    //     });

                    //     $ListAllData .= '<tr>';                         
                    //     $ListAllData .= '<td>'.$value->descs.'</td>';
                    //     $Listunit = '<td align="left">';
                    //     $Listunit .= '<div data-toggle="buttons">';

                    //     if($AllDataUnitLevel){
                    //       foreach ($AllDataUnitLevel as $key => $value2) {
                    //         $Listunit .='<input type="buttons" style="width: 57px;" class = "btn btn_block btn-success" value="'.$value2->lot_no.'" rel="tooltip" title="'.$value2->remarks.'" name="lot_no" onclick="moveNumbers(this.value)" readOnly="readOnly">';                          
                    //       }
                    //     }else{
                    //         $Listunit .='<b><span> UNIT NOT AVALAIBLE </span></b>';
                    //     }
                    //       $Listunit .= '</div>';
                    //       $Listunit .= '</td>';
                    //       $ListAllData .= $Listunit;
                    //       $ListAllData .='</tr>';
                    //   }
                    // }
                   echo $userLevelList; ?>            
                </tbody>
              </table>
              <!-- </div> -->
              
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
<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_nup_unit/validasi" enctype="multipart/form-data">
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
//End choosen properties      
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
//End choosen properties      
</script>


<script type="text/javascript">
 
// alert(table);
  //dropdown change
function progress_bar(){
  var progress = '<div ="myProgress"><div id="myBar"></div></div>';
}


$('#level_no').on("change",function(e){
   var property_cd = $('#pl_property').val();
   var level_no = $('#level_no').val();   

document.getElementById('load').hidden=false;

var state = document.readyState
  if (state == 'complete') {
      setTimeout(function(){
          document.getElementById('interactive');
         // document.getElementById('load').style.visibility="hidden";
         document.getElementById('load').hidden=true;
      },1000);
  }

  $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?>"+"/"+property_cd+"/"+level_no+" #table1" );

});

$('#pl_property').on("change",function(e){
   var property_cd = $('#pl_property').val();
   // alert('a');
   var level_no = 'L';
   // alert(level_no);

   // $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?>"+"/"+property_cd+" #table1" );

   // var elem = document.getElementById("myBar"); 
   //  var width = 1;
   //  var id = setInterval(frame, 10);
   //  function frame() {
   //      if (width >= 100) {
   //          clearInterval(id);
   //      } else {
   //          width++; 
   //          elem.style.width = width + '%'; 
   //      }
   //  }

// alert('Mulai');

document.getElementById('load').hidden=false;

// var state = document.readyState
//   if (state == 'interactive') {
//        document.getElementById('contents').style.visibility="hidden";
//   } else if (state == 'complete') {
//       // setTimeout(function(){
//       //    document.getElementById('interactive');
//       //    document.getElementById('load').hidden=true;
//       //    // document.getElementById('load').style.visibility="hidden";
//       //    // document.getElementById('contents').style.visibility="visible";
//       // },1000);
//       document.getElementById('load').hidden=true;
//       $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?>"+"/"+property_cd+" #table1" );
//  }


var state = document.readyState
  if (state == 'complete') {
      setTimeout(function(){
          document.getElementById('interactive');
         // document.getElementById('load').style.visibility="hidden";
         document.getElementById('load').hidden=true;
      },1000);

  }

  $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?>"+"/"+property_cd+"/"+level_no+" #table1" );

  var property_cd = $(this).find(':selected').val(); 
  // alert(property_cd);
          if(property_cd!=='') {
            var site_url = '<?php echo base_url("c_nup_unit/level")?>';
            $.post(site_url,
              {property_cd:property_cd,level_no:level_no},              
              function(data,status) {
                $("#level_no").empty();
                $("#level_no").append('<option value="L" >All Unit</option>');
                $("#level_no").append(data);
                $("#level_no").trigger('chosen:updated');
                // console.log(data);
              }

            );
          } 
          // else {
          //   $("#level_no").empty();
          // }
});

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
              var property_cd = $('#pl_property').val();
              var level_no = $('#level_no').val();
              var lot_no = $('#txtlotno').val();
              
               // $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?>"+"/"+property_cd+"/"+level_no+" #table1" );
                $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?> #table1",{"property_cd":property_cd,"level_no":level_no,"lot_no":lot_no} );
            }
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

  //buton status Book, Do nothing
  $(document).on("click", ".book-AddBookDialog", function () {
      var myBookId = $(this).data('id');
     // alert(myBookId);
     // $('#addBookDialog').data('id', myBookId).modal('show');
    
   // });
return false;
  });
   //buton status Reserve, Do nothing
  $(document).on("click", ".reserve-AddBookDialog", function () {
      var myBookId = $(this).data('id');
     // alert(myBookId);
     // $('#addBookDialog').data('id', myBookId).modal('show');
    
   // });
return false;
  });

function Booking2(lot_no){
          // var LotNumber = $('#txtlotno').val();
          // alert(lot_no);
          var parseRowid = <?php echo $RowID; ?>;
          var parseLotQty = <?php echo $LotQty;?>;
          // var parseNupNo = <?=$NupNO?>;
          // alert(parseNupNo);
          $.ajax({
                    url : "<?php echo base_url('c_nup_unit/validasi');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    // data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    data: {LotNumber:lot_no,
                          rowid:parseRowid,
                          lotqty:parseLotQty},
                    dataType:"json",
                    success:function(event, data){
                        
                        // BootstrapDialog.alert(event.Pesan);

                        BootstrapDialog.alert(event.Pesan, function(result){
                            if(result) {
                                var a = event.nup;
                                var b = event.notif;

                                if(b == 'OK'){
                                  window.location.href="<?=base_url('c_nup_dt/list_dtNew/')?>"+"/"+a;  
                                }else{
                                  window.location.href="<?=base_url('c_nup_unit/indexNew/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;  
                                }
                            }
                            // else {
                            //     alert('Nope.');
                            // }
                        });

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
                     BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                     // window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty;
                    }
                    });

}
    function Booking(){
      // var url_booking ="<?php echo base_url('c_nup_unit/validasi'); ?>/"+myBookId;
      // var property_cd = $('#pl_property').val();  
      var b = <?php echo $RowID; ?>;
      var lot_no = $('#txtlotno').val();

      if(lot_no != ''){
         $('div.modal-header').html('Information');
         $('div.modal-body').html('Are You Sure want to Book this unit '+ lot_no);
         $('div.modal-body').append('<div class="modal-footer"></div>');
         $('#addBookDialog').data('id', lot_no).modal('show');
                            var btnYes = $('<input/>')
                                .attr({
                                    id: "btnYes",
                                    name: "btnYes",
                                    type: "button",
                                    class: "btn btn-danger pull-left",
                                    onclick: "Booking2('"+lot_no+"');",
                                    value: 'OK'
                                });                            

                            var btnNo = $('<a>Cancel</a>').attr({
                                class: "btn btn-default pull-right", 'data-dismiss': "modal"
                            });
                            $('div.modal-footer').append(btnYes);
                            $('div.modal-footer').append(btnNo);
          $('#modal').data('id', lot_no).modal('show');
      }else{
        BootstrapDialog.alert('Please select Unit.');
      }

      // alert(lot_no);
     
        // });
        // setTimeout(function () {
        //           window.location.href = url_booking;
        //                     }, 1500);  
        // var LotNumber = $('#txtlotno').val();
        // $('#modal').modal('hide');
    }

    </script>

  <script type="text/javascript">

    // $(function() {
    //   $('input').on('click', function() {
    //           var values = [];
    //           $('input:checked').each(function() {
    //               values.push($(this).parent().text());
    //           });
    //           $('[name="txtlotno"]').attr({value: values.join(', ')});
    //       });
    //   });
    var txt = [];
    
    function moveNumbers(num, btn) { 
    var a = document.getElementById("txtlotno").value;
    var b = <?php echo $LotQty;?>;
    var c = txt.length + 1;
    var d = b - c ;
    

    if (d >= 0){
      var CariLotNo = txt.indexOf(num);
      if( CariLotNo >= 0){
        return false;
      }else{
        txt.push(num); 
        btn.style.background = 'red'; 
      }      
    }else{
      // alert('Unit Habis');
      BootstrapDialog.alert('Balance choosen unit only ' + b);
      return false;
      // alert('I want banana!');
    }

    // txt.push(num);
    
    // document.getElementById("txtlotno").value=txt;
   
      // if (a.indexOf(num) >= 0) {
      //   // Found it
      // } else  {


      // var CariLotNo = txt.indexOf(num);

      // if (CariLotNo >= 0 ) {
      //   // alert("Lot number sudah ada");
      //   return false;
      // } else {
      //   txt.push(num);        
      // }       
        document.getElementById("txtlotno").value=txt;

        

    }    
    
    function reset(btn){

      btn.style.background = 'blue';
      document.getElementById('txtlotno').value="";     
      var property_cd = $('#pl_property').val();
              var level_no = $('#level_no').val();
              var lot_no = $('#txtlotno').val(); 
      $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?> #table1",{"property_cd":property_cd,"level_no":level_no,"lot_no":lot_no} );
       txt = [];
      
    }
    
    // $(document).ready(function() {
    //     $('[rel="tooltip"]')
    //         .tooltip({placement: 'right'})
    //         .data('tooltip')
    //         .tip()
    //         .css('z-index',2080);
    // });

  </script>


    