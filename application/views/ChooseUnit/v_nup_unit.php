<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>
<script type="text/javascript" src="<?=base_url('js/skinnytip.js')?>"></script>
    <style>
      span {
        border-bottom: 1px;
        
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
            
              <div class="form-group">
              <label for="test" class="col-sm-2 control-label">NUP No.</label> 
                    <div class="col-sm-10">
                      <b><input type="text" id="nupno" name="nupno" value="<?php echo $NupNO; ?>" class="form-control" style="border:none; background-color:white;" readonly="readonly"></b>
                      </div>
              </div>
            </div>
            <div class="form-group">
            
              <div class="form-group">
              <label for="test" class="col-sm-2 control-label">Name</label> 
                    <div class="col-sm-10" style="margin-left: 0px;">
                      <b><input type="text" id="nupno" name="nupno" value="<?php echo $BussName; ?>" class="form-control" style="border:none; background-color:white;" readonly="readonly"></b>
                      </div>
              </div>
            </div>
            <div class="form-group">
            
              <label for="test" class="col-sm-2 control-label">Unit</label>             
                <!-- <?php echo $unit; ?> -->
              <section class="content-header">
                <div class="form-group">
                  <div class="pull-left col-sm-8">
                    <b><input type="text" id="txtlotno" name="txtlotno" value="<?php echo $unit; ?>" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly"></b>
                    <input type="hidden" id="txtlotno2" name="txtlotno2" value="<?php echo $unit; ?>" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: large;" readonly="readonly">
                  </div>
                </div>
                <div class="pull-right">
                <a href="<?php echo $backurl?>" class="btn abu-bg btn-sm">Back</a> 
                  <button id="btnclear" name="btnclear" onclick="reset(this)" type="button" class="btn bg-danger btn-sm">Clear</button>&nbsp;
                  <button id="btnsubmit" name="btnsubmit" onclick="Booking()" type="button" class="btn btn-success btn-sm">Process Chosen Units</button>
                   
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
<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>C_nup_unitNew/validasi" enctype="multipart/form-data">
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

  $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_table2');?>"+"/"+property_cd+"/"+level_no+"/"+lot_no+" #table1" );

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

  $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_table');?>"+"/"+property_cd+"/"+level_no+" #table1" );

  var property_cd = $(this).find(':selected').val(); 
          if(property_cd!=='') {
            var site_url = '<?php echo base_url("C_nup_unitNew/level")?>';
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
var a =20;
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
              
                 $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_table');?> #table1",{"property_cd":property_cd,"level_no":level_no,"lot_no":lot_no} );
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

  // function Booking2(lot_no, row_index, xlot_no, pl_property){
    function Booking2(lot_no, row_index, xlot_no){

    var parseRowid = <?php echo $RowID; ?>;
    var parseLotQty = <?php echo $LotQty;?>;
    // alert(xlot_no);pl_property
    // return;

    $.ajax({  
      url : "<?php echo base_url('C_nup_unitNew/validasi2');?>",
      type:"POST",
      data: {LotNumber:lot_no,
        rowid:parseRowid,
        lotqty:parseLotQty,
        xlot_no:xlot_no
        // ,
        // pl_property:pl_property
      },
        dataType:"json",
        success:function(event, data){
        console.log('data '+data);
        console.log('event '+event);
          swal({
                    title: "Information",
                    // animation: false,
                    text: event.Pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){                    
                     var a = event.nup;
                     var b = event.notif;
                     // console.log(a);
                     // console.log(b);
                     // return;
                      if(b == 'OK'){
                        window.location.href="<?=base_url('c_nup_dt/list_dtNew/')?>"+"/"+a+"/1/"+row_index+"/A";
                      }else{
                        // window.location.href="<?=base_url('C_nup_unitNew/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;
                        window.location.href="<?=base_url('c_nup_dt/list_dtNew/')?>"+"/"+a+"/1/"+row_index+"/A";  
                      }
                  });
      
          $('#modal').modal('hide');
        },                    
        error: function(jqXHR, textStatus, errorThrown){
          console.log('a')
         swal('Information',textStatus+' Save : '+errorThrown,'warning');
        }
      });
  }

    function Bookingold(){
      var pl_property = $('#pl_property').val();
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
                                    // onclick: "Booking2(\'"+lot_no+"\',\'"+row_index+"\',\'"+xlot_no+"\',\'"+pl_property+"\');",                                    
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
    function Booking(){
      // var url_booking ="<?php echo base_url('c_nup_unit/validasi'); ?>/"+myBookId;
      // var property_cd = $('#pl_property').val();  
      var b = '<?php echo $RowID; ?>';
      // console.log(b);
      // return;
      var lot_no = $('#txtlotno').val();
      var xlot_no =  $('#txtlotno2').val();
      // var add = $('#additional').val();
      
      // var parseRowid = '<?php echo $RowID; ?>';
        
          var parseLotQty = '<?php echo $LotQty;?>';//
          var rowid_index = '<?php echo $row_index?>';//
          var parseNupno = '<?php echo $NupNO?>';//
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
          $('div.modal-body').load("<?php echo base_url("c_nup_landedNew/processApartment")?>"+"/"+lot_no);
          $('#modal').data('xlot_no',xlot_no);
          $('#modal').data('parseLotQty',parseLotQty);
          $('#modal').data('rowid_index',rowid_index);
          $('#modal').data('parseNupno',parseNupno);
          $('#modal').data('RowID',b);
          $('#modal').data('id', lot_no).modal('show');
          

      }else{
        swal('Information','Please choose minimum 3 units','warning');
      }

      
    }
    </script>

  <script type="text/javascript">    
    var txt = [];
    var txt2= [];
    var txt3= [];
    var aa = $('#txtlotno').val();
    var bb = $('#txtlotno2').val(); 
    if(aa.length>0) {
      txt = aa.split(',');
    }
    // txt = aa.split(',');
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

          btn.style.background = 'yellow'; 
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
      $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_table');?> #table1",{"property_cd":property_cd,"level_no":level_no,"lot_no":lot_no} );
       txt = [];
       // $('#'+lotno).removeClass("btn-danger").addClass("btn-primary");
      
    }   
  function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
  }

  function landinfo(lotno, btn)
  {
    var balance = <?php echo $LotQty;?>;
    // alert(balance);
    // var cbtn = btn.style.background = 'red';
    // var btnN = $('#'+lotno);
    var btnN = document.getElementById(lotno);
    var colour_btn = btnN.style.backgroundColor;
    
    // console.log(colour_btn);
    var b = 5;//<?php echo $LotQty;?>;
    var c = txt.length + 1;
    var d = b - c ;
    var true_cl = hasClass(btnN,'btn-danger');
    // alert(true_cl);
    // alert(hasClass(btnN,'btn-danger'));
    // console.log(c);
    // console.log(true_cl);
    // if(colour_btn=='yellow'){
    if(true_cl){
      //red
      var lot_no = $('#txtlotno').val();
      var lot_no2 = $('#txtlotno2').val();
      var arr_lot = lot_no.split(",");
      var arr_lot2 = lot_no2.split(",");
      var new_lot = ""; var new_lot2 = "";

      $('#'+lotno).removeClass("btn-danger").addClass("btn-primary");  
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

        // btnN.style.background  = 'navy';
    
      $('#txtlotno').val(new_lot);
      $('#txtlotno2').val(new_lot2);


    }
    // else if(colour_btn=='red'){
    //   return;
    // }
    else{

     
      //green
      // $('#'+lotno).removeClass("btn-primary").addClass("btn-danger");
      // console.log(d);
      if (d >= 0){

        var CariLotNo = txt.indexOf(lotno);
        if( CariLotNo >= 0){
          return false;
        }else{


            var Id = lotno;// $('#modal').data('Id');
            var b = balance;// $('#modal').data('balance');
            // alert(Id);
            
            // txt.push(Id);
           
            //green
            var lotno = Id;
            var lot_no = $('#txtlotno').val();
            var lot_no2 = $('#txtlotno2').val();
            var arr_lot = lot_no.split(",");
            var arr_lot2 = lot_no2.split(",");
            var new_lot = ""; 
            var new_lot2 = "";
            
            // txtlotno
            for (i = 0; i < arr_lot2.length; i++) {
              if (arr_lot2[i] != lotno && new_lot2 == ""){
                new_lot2 = arr_lot2[i];
                console.log('a');
              } else if (arr_lot2[i] == lotno && new_lot2 == ""){
                new_lot2 = new_lot2;
                console.log('b');
              } else if (arr_lot2[i] != lotno && new_lot2 != ""){
                if (lot_no2.length >0){
                  new_lot2 = new_lot2 + ',' + arr_lot2[i];
                  console.log('c');
                } else{
                  new_lot2 = new_lot2 + arr_lot2[i];
                  console.log('d');
                } 
              }
            }
            // console.log(new_lot2);
            // alert(new_lot2);

            // txtlotno2
            for (i = 0; i < arr_lot.length; i++) {
              if (arr_lot[i] != lotno && new_lot == "" && lot_no == ""){
                new_lot = lotno;
              } else if (arr_lot[i] != lotno && new_lot == "" && lot_no != ""){
                if (lot_no.length>0){
                  new_lot = arr_lot[i] + ',' + lotno;
                } else {
                  new_lot = arr_lot[i] + lotno;
                }
                
              } else if (arr_lot[i] != lotno && new_lot != ""){
                if (lot_no.length>0){
                  new_lot = new_lot + ',' + lotno;
                } else {
                  new_lot = new_lot + lotno;
                }
                
                
              } else {
                new_lot = lot_no;
              }
            }
            console.log(new_lot);
            // alert(new_lot);
            // btnN.style.background  = 'yellow';
            $('#'+lotno).removeClass("btn-primary").addClass("btn-danger");   
            txt.push(Id);
            // console.log(txt);
            $('#txtlotno').val(txt);
            $('#txtlotno2').val(new_lot2);



            // $('#txtlotno').val(txt);
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

<script type="text/javascript">SkinnyTip.init();</script>
    