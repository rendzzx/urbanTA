<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}

</style>
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
              <label for="pl_project" class="col-sm-2 control-label">Property Type</label> 
                  <div class="form-group">
                    <div class="pull-left">
                      <select name="pl_property" id="pl_property" data-placeholder="Choose a Project..." class="select2" style="width:250px;" tabindex="2">
                        <option value=""></option>
                        <?php echo $property_type; ?>      
                      </select> 
                    </div>
                  </div>
            </div>
            <div class="form-group">
              <label for="pl_project" class="col-sm-1 control-label">Level</label>
                <div class="form-group">
                  <div class="pull-left">
                    <select name="level_no" id="level_no" data-placeholder="Choose a Level..." class="select2" style="width:250px;" tabindex="2">
                      <option selected="1" value="L">All Unit</option>                                   
                      <?php echo $level_no; ?>      
                    </select>
                  </div>
                  <div class="pull-right">
                    <span id="time"></span>
                  </div>
                </div>
            </div><br>
            <div class="form-group">
              <label for="test" class="col-sm-1 control-label">Unit</label>             
                <!-- <?php echo $unit; ?> -->
              <section class="content-header">
                <div class="form-group">
                  <div class="pull-left col-sm-8">
                    <b><input type="text" id="txtlotno" name="txtlotno" value="<?php echo $unit; ?>" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly"></b>
                    <input type="hidden" id="txtlotno2" name="txtlotno2" value="<?php echo $unit; ?>" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly">
                  </div>
                </div>
                <div class="pull-right">
                  <button id="btnclear" name="btnclear" onclick="reset(this)" type="button" class="btn bg-orange btn-sm">Clear</button>&nbsp;
                  <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-danger btn-sm">Process</button>
                  <a href="<?=base_url('c_nup_dt/list_dtNew/')?>/<?=$NupNO?>/1/<?=$row_index?>/A" class="btn abu-bg btn-sm">Back</a>  
                </div>                
              </section>
            </div>
            <br><br> 
              <div id="load" hidden="true"></div>
              <table id="table1" class="table table-hover dataTable">
                <thead>
                  <tr>
                    <th class="col-xs-1">Floor</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>                
                   <?php echo $userLevelList; ?>            
                </tbody>
              </table>
               </div>
            <div class="box-footer">
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
$('#pl_property').select2();
$('#level_no').select2();
</script>


<script type="text/javascript">
function progress_bar(){
  var progress = '<div ="myProgress"><div id="myBar"></div></div>';
}


$('#level_no').on("change",function(e){
  // alert('a');
   var property_cd = $('#pl_property').val();
   var level_no = $('#level_no').val();
   var lot_no = $('#txtlotno').val();
   // alert(lot_no);
   // var true_cl = hasClass(btnN,'btn-danger');   

document.getElementById('load').hidden=false;

var state = document.readyState
  if (state == 'complete') {
      setTimeout(function(){
          document.getElementById('interactive');
         // document.getElementById('load').style.visibility="hidden";
         document.getElementById('load').hidden=true;
      },1000);
  }

  $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table2');?>"+"/"+property_cd+"/"+level_no+"/"+lot_no+" #table1" );

});

$('#pl_property').on("change",function(e){
  // alert('1');
   var property_cd = $('#pl_property').val();
   var level_no = 'L';
  

document.getElementById('load').hidden=false;


var state = document.readyState
  if (state == 'complete') {
      setTimeout(function(){
          document.getElementById('interactive');
         document.getElementById('load').hidden=true;
      },1000);

  }

  $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?>"+"/"+property_cd+"/"+level_no+" #table1" );

  var property_cd = $(this).find(':selected').val(); 
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
              // console.log(property_cd);
              
                 // $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?> #table1",{"property_cd":property_cd,"level_no":level_no,"lot_no":lot_no} );
            }
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

  //buton status Book, Do nothing
  $(document).on("click", ".book-AddBookDialog", function () {
      var myBookId = $(this).data('id');     
return false;
  });
   //buton status Reserve, Do nothing
  $(document).on("click", ".reserve-AddBookDialog", function () {
      var myBookId = $(this).data('id');     
return false;
  });

  function Booking2(lot_no, row_index, xlot_no){

    var parseRowid = <?php echo $RowID; ?>;
    var parseLotQty = <?php echo $LotQty;?>;
    // alert(xlot_no);
    // return;

    $.ajax({  
      url : "<?php echo base_url('c_nup_unit/validasi2');?>",
      type:"POST",
      data: {LotNumber:lot_no,
        rowid:parseRowid,
        lotqty:parseLotQty,
        xlot_no:xlot_no},
        dataType:"json",
        success:function(event, data){
        // console.log(data);
          swal({
                    title: "Information",
                    text: data.pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){                    
                     var a = event.nup;
                     var b = event.notif;

                      if(b == 'OK'){
                        window.location.href="<?=base_url('c_nup_dt/list_dtNew/')?>"+"/"+a+"/1/"+row_index+"/A";
                      }else{
                        // window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;
                        window.location.href="<?=base_url('c_nup_dt/list_dtNew/')?>"+"/"+a+"/1/"+row_index+"/A";  
                      }
                  });
      
          $('#modal').modal('hide');
        },                    
        error: function(jqXHR, textStatus, errorThrown){
          // console.log('a')
         swal('Information',textStatus+' Save : '+errorThrown,'warning');
        }
      });
  }

    function Booking(){
      var b = <?php echo $RowID; ?>;
      var row_index = b + 1000000;
      var lot_no = $('#txtlotno').val();
      var xlot_no =  $('#txtlotno2').val();
     // alert(xlot_no);

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
         $('div.modal-body').html('Are You Sure want to Book this unit '+ lot_no);
         $('div.modal-body').append('<div class="modal-footer"></div>');
         $('#addBookDialog').data('id', lot_no).modal('show');
                            var btnYes = $('<input/>')
                                .attr({
                                    id: "btnYes",
                                    name: "btnYes",
                                    type: "button",
                                    class: "btn btn-danger",
                                    // onclick: "Booking2("+lot_no+'\',\''+row_index+'\'");",
                                    onclick: "Booking2(\'"+lot_no+"\',\'"+row_index+"\',\'"+xlot_no+"\');",                                    
                                    value: 'OK'                                    
                                });                            

                            var btnNo = $('<a>Cancel</a>').attr({
                                class: "btn btn-default pull-right", 'data-dismiss': "modal"
                            });
                            $('div.modal-footer').append(btnYes);
                            $('div.modal-footer').append(btnNo);
          $('#modal').data('id', lot_no).modal('show');
      }else{
        swal('Please select Unit.');
      }     
    }

    </script>

  <script type="text/javascript">    
    var txt = [];
    var txt2= [];
    var txt3= [];
    var aa = $('#txtlotno').val();
    var bb = $('#txtlotno2').val(); 
    txt = aa.split(',');
    txt2 = bb.split(',');

    // console.log(txt);
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
        alert('Balance choosen unit only ' + b);
        return false;
      }
       
      document.getElementById("txtlotno").value=txt;        

    }    
    
    function reset(btn){

      // btn.style.background = 'blue';
      document.getElementById('txtlotno').value="";     
      var property_cd = $('#pl_property').val();
              var level_no = $('#level_no').val();
              var lot_no = $('#txtlotno').val(); 
      $('#table1').load( "<?php echo base_url('c_nup_unit/goto_table');?> #table1",{"property_cd":property_cd,"level_no":level_no,"lot_no":lot_no} );
       txt = [];
       // $('#'+lotno).removeClass("btn-danger").addClass("btn-primary");
      
    }   
  function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
  }

  function landinfo(lotno, btn)
  {
    var balance = $('#b_val').val();
    // var cbtn = btn.style.background = 'red';
    // var btnN = $('#'+lotno);
    var btnN = document.getElementById(lotno);
    // console.log(btn);
    var b = 3;//<?php echo $LotQty;?>;
    var c = txt.length + 1;
    var d = b - c ;
    var true_cl = hasClass(btnN,'btn-danger');
    // alert(c);
    // alert(hasClass(btnN,'btn-danger'));
    // console.log(c);
    // console.log(true_cl);
    if(true_cl){
      //red
      var lot_no = $('#txtlotno').val();
      var lot_no2 = $('#txtlotno2').val();
      var arr_lot = lot_no.split(",");
      var arr_lot2 = lot_no2.split(",");
      var new_lot = ""; var new_lot2 = "";

      // txtlotno
      for (i = 0; i < arr_lot.length; i++) {
        if (arr_lot[i] != lotno && new_lot == ""){
          new_lot = arr_lot[i];
        } else if (arr_lot[i] != lotno && new_lot != ""){
          new_lot = new_lot + ',' + arr_lot[i];
        } 
      }
      // alert(new_lot);

      // txtlotno2
      for (i = 0; i <= arr_lot2.length; i++) {
        if (i == 0){
          new_lot2 = arr_lot2[i];
        } else if (i == arr_lot2.length && lot_no2 != "") {
          new_lot2 = new_lot2 + ',' + lotno;
        } else if (i == arr_lot2.length && lot_no2 == "") {
          new_lot2 = lotno;
        } else {
          new_lot2 = new_lot2 + ',' + arr_lot2[i];
        } 
      }
      // alert(new_lot2);

      var ind = txt.indexOf(lotno);
      txt.splice(ind, 1);

      /*var ind = arr_lot.indexOf(lotno);
      var test1 = arr_lot[ind];*/

      // arr_lot.splice(ind, 1);
      $('#'+lotno).removeClass("btn-danger").addClass("btn-primary");
       
      /*txt2.push(test1);
      var uniqueNames = [];
      $.each(txt2, function(i, el){
          if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
      });*/
      // console.log(uniqueNames);
       // txt3 = uniqueNames;
       // console.log(txt3);
       // txt2 = uniqueNames;
      // $('#txtlotno2').val(txt3);
      /*$('#txtlotno2').val(txt2);
      $('#txtlotno').val(arr_lot);*/
      // txt = arr_lot;
      $('#txtlotno').val(new_lot);
      $('#txtlotno2').val(new_lot2);


    }else{

      // var lot_no = $('#txtlotno').val();       
      // var arr_lot = lot_no.split(",");

      // var ind = arr_lot.indexOf(lotno);        
      // var test1 = arr_lot[ind];      

      // if (ind > -1) {
      //   arr_lot.splice(ind, 1);          
      //    $('#'+lotno).removeClass("btn-danger").addClass("btn-primary");
      // }
       
      // txt2.push(test1);
      // $('#txtlotno2').val(txt3);

      //green
      // $('#'+lotno).removeClass("btn-primary").addClass("btn-danger");
      // console.log(d);
      if (d >= 0){

        var CariLotNo = txt.indexOf(lotno);
        if( CariLotNo >= 0){
          return false;
        }else{

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
          $('div.modal-body').load("<?php echo base_url("c_nup_unit/showland");?>"+"/"+lotno);
          $('#modal').data('balance',balance);
          $('#modal').modal('show');
          $('#modal').data('Id',lotno);
        }
      }else{
        // btn.style.background = '#18a689';     
        // $('#'+lotno).removeClass("btn-danger").addClass("btn-primary");   
        swal('Information','Balance choosen unit only ' + b,'warning');
        return false;
      }
    }
    
  }

    $(document).ready(function () {
      var unit = '<?php echo $unit; ?>';

      if(unit == 1){
        // $('#txtlotno').val('');
        document.getElementById('txtlotno').value="";
        document.getElementById('txtlotno2').value="";
        txt = [];
        txt2 = [];
      }else{
        $('#txtlotno').val(unit);
        $('#txtlotno2').val('');
        txt2 = [];
      }

    });

  </script>


    