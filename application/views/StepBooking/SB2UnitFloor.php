<style>
  ul#stepForm, ul#stepForm li {
    margin: 0;
    padding: 0;
  }
  ul#stepForm li {
    list-style: none outside none;
  } 
  label{margin-top: 10px;}
  .help-inline-error{color:red;}
 /* .ScrollStyle
{
    max-height: 450px;
    overflow-y: scroll;
}*/


</style>
<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>" type="text/javascript"></script>
<link rel="stylesheet" href="<?=base_url('js/plugins/jvectormap/jquery-jvectormap-1.2.2.css')?>">

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-left"><b><?php echo $projectName; ?></b></div>
            <div class="tittle-top pull-right"><b>Booking</b></div>
        </div>
    </div>
    <div class="wrapper wrapper-content" >
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
                          <span class="number">1. </span>
                          Choose Property
                        </a>
                      </li>
                      <li class="current" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                          <span class="current-info audible">current step: </span>
                          <span class="number">2. </span>
                          Choose Unit
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h2" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">3. </span>
                          Input Customer Information
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h3" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">4. </span>
                          Input Payment Plan + Disc
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h4" aria-controls="form-p-1">
                          <span class="current-info audible">current step: </span>
                          <span class="number">5. </span>
                          Finish
                        </a>
                      </li>
                    </ul>
                  </div>
                  </form>
                        <div class=""><br>
                  <div class="content" >
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title">Choose Unit</h3>
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
                                      <label for="pl_project_name" class="control-label"><?php echo $property_descs; ?> </label> 
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
                                      <input type="button" name="btnNext" id="btnNext" value="Next" class="btn btn-primary">
                                      <input type="button" name="btnClear" id="btnClear" value="Clear" onclick="Clear();" class="btn btn-primary">
                                    </div>
                                  <!-- </div> -->
                                  <div class="form-group">
                                    <div class="col-sm-12">
                                      <!-- <div class="ScrollStyle"> -->
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
                                        <!-- </div> -->
                                      </div>
                                    </div>                                   
                                  </div>
                                  <!-- </div> -->
                                   <!-- <div class="footer"> -->
                                    <div class="col-sm-12">
                                      <input type="button" name="btnBack" id="btnBack" value="Back" class="btn btn-primary">
                                      <input type="button" name="btnNext" id="btnNext" value="Next" class="btn btn-primary">
                                      <input type="button" name="btnClear" id="btnClear" value="Clear" onclick="Clear();" class="btn btn-primary">
                                    </div>
                                  <!-- </div> -->

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
function imgpop(src) {
    
    var _src = '<?php echo base_url("img/LotInfo/'+src+'");?>';
    // alert(_src);
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

var txt = [];
var unit_book = '<?php echo $unit_book;?>';

if(unit_book){  
  txt = unit_book.split(",");
  $('#txt_unit').val(unit_book);
}

    function hasClass(element, cls) {
        return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
    }
    function Change_unit(lot_no){
      swal({
            title: "Are you sure?",
            text: "You will Cancel unit [ "+lot_no+" ] Unit!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Cancel it!",
            closeOnConfirm: false
          },
          function(){
            var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
            var property_cd = '<?php echo $property_cd;?>';
            $.post(site_url,
                      {id:lot_no,status:"A",property_cd:property_cd},
                      function(data,status) {
                        console.log(data.Pesan);
                        // var a = event.nup_no;
                        // alert(a);
                        console.log(txt);
                        swal("Cancel!", "Your Unit has been Canceled.", "success");
                        var CariLotNo = txt.indexOf(lot_no);
                        console.log(CariLotNo);
                        txt.splice(CariLotNo,1);
                        console.log(txt);
                        $('#txt_unit').val(txt);
                        $('#'+lot_no).removeClass("btn-warning").addClass("btn-success");
                      }
                    );
            
          });
    }
    function showInfo(lot_no){

    
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
          $('div.modal-body').load("<?php echo base_url("c_stepbooking/showland");?>"+"/"+lot_no);
          // $('#modal').data('balance',balance);
          $('#modal').modal('show');
          $('#modal').data('Id',lot_no);
          $('#modal').data('property_cd',property_cd);
    }
    function loadinfo(lot_no){
      var el = document.getElementById(lot_no);
      // console.log(hasClass(el,'btn-success'));
      if(hasClass(el,'btn-success')){
        showInfo(lot_no);
        // $('#'+lot_no).removeClass("btn-success").addClass("btn-warning");
      }else{
        Change_unit(lot_no);
        
      }
      
    }

    function Clear(){
      var lot_unit = $('#txt_unit').val(); 
      document.getElementById('txt_unit').value=""; 
      //update status unit
      var property_cd = '<?php echo $property_cd;?>';
      var site_url = '<?php echo base_url("c_stepbooking/clear_unit")?>';
            var property_cd = '<?php echo $property_cd;?>';
            $.post(site_url,
                      {id:lot_unit,status:"A",property_cd:property_cd},
                      function(data,status) {
                        // console.log(data.Pesan);
                        var lot_no = $('#txt_unit').val(); 
                        $('#table1').load( "<?php echo base_url('c_stepbooking/goto_table');?> #table1",{"property_cd":property_cd,"lot_no":lot_no} );
                         txt = [];
                        
                      }
                    );
      //update status unit end
      // alert(property_cd);
      

    }
      
     
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
              var property_cd = '<?php echo $property_cd;?>';
              var lot_no = $('#txt_unit').val(); 
              $('#table1').load( "<?php echo base_url('c_stepbooking/goto_table');?> #table1",{"property_cd":property_cd,"lot_no":lot_no} );
            }
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

      $(function() {
     $('#btnNext').click(function(){
      // alert('tes');
      var myBookId = $('#txt_unit').val();
      var property_cd = '<?php echo $property_cd;?>';
      var url_ = '<?php echo base_url("c_stepbooking/next/3")?>';
      if(myBookId==""){
        
        swal('warning','Please Click Unit!');
        return;
      }
       var site_url = "<?php echo base_url('c_stepbooking/set_session')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: {property_cd:property_cd,unit_book:myBookId},
          dataType: "json",
          success: function(data, status){
            var a = '<?php echo $business_id;?>';
            window.location.href = "<?php echo base_url('c_stepbooking/add_customer')?>"+'/'+a+'/A';

          },
          error: function(jqXHR, textStatus, errorThrown){
            swal(textStatus+' Save : '+errorThrown);
          }
        })
      
      
                      
     });
     $('#btnBack').click(function(){
        // window.history.back();
        window.location.href = "<?php echo base_url('c_stepbooking')?>";
     });
   });
      function fn_focus(dta){
      // console.log(dta);
      // dta.style.background-color="red";
      // dta.addclass=""
     }
     
</script>
    