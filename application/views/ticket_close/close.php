<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<style type="text/css">
    #tblw td{
        text-align: center; 
        vertical-align: middle;
    }
    /*div#modaldialog{
    zoom: 85%;
}*/

/*.modal-footer{
    padding-top: 0px;padding-bottom: 0px;
}*/
</style>
<?php 
    
    $estdate = $data[0]->est_completion_date;
        $est_date = '';
        $est_clock = '';
        if ($estdate==null || $estdate=='') {
            $est_date = date("d-M-Y");
            $est_clock = date("h:i");
            $disable = '';
        }
        else{
            $est_date = date("d/m/Y",strtotime($estdate));;
            $est_clock = date("h:i",strtotime($estdate));
            $disable = 'disabled=';
        }

        $surveydate = $data[0]->survey_date;
        $reported_date = date("d-M-Y h:i",strtotime($data[0]->reported_date));
        $assigned_date = date("d-M-Y h:i",strtotime($data[0]->assigned_date));
        $survey_date = '';
        $survey_clock = '';
        if ($surveydate==null || $surveydate=='') {
            $survey_date = date("d-M-Y");
            $survey_clock = date("h:i");
        }
        else{
            $survey_date = date("d/m/Y",strtotime($surveydate));
            $survey_clock = date("h:i",strtotime($surveydate));
        }

        $completiondate = $data[0]->completion_date;
        $completion_date = '';
        $completion_clock = '';
        if ($completiondate==null || $completiondate=='') {
            $completion_date = date("d-M-Y");
            $completion_clock = date("h:i");
            $disable = '';
        }
        else{
            $completion_date = date("m/d/Y",strtotime($completiondate));;
            $completion_clock = date("h:i",strtotime($completiondate));
            $disable = 'disabled=';
        }

        $completedate = $data[0]->completion_date;
        if ($completedate==null || $completedate=='') {
            $complete_date = date("d F Y");
            $complete_clock = date("G:i");
        }
        else{
            $complete_date = date("d F Y",strtotime($completedate));;
            $complete_clock = date("G:i",strtotime($completedate));
        }

        function formatdate($data){
            if ($data==null || $data=='') {
                return "-- / -- / ---- -- : --";
            }
            else{
                return date("d/m/Y h:i",strtotime($data));
            }
        }
?>
<form id ="frmdata" class="form">
    <div class="col-sm-12" id="tabhome">
        <div class="card">
            <div class="card-content">
                <div class="card-body" style="padding-bottom:20px">
                    <div class="row">
                        <div class="col-sm-4"><p class="text-center"><b>Ticket No : </b><?php echo $data[0]->complain_no ?></p></div>
                        <div class="col-sm-4"><p class="text-center"><b>Work Order : </b><?php echo $data[0]->report_no ?></p></div>
                        <div class="col-sm-4"><p class="text-center"><b>Assign To : </b><?php echo $data[0]->assign_to ?></p></div>
                    </div>
                    <hr style="margin-bottom: -33px;border-top: 3px solid rgba(0, 0, 0, 0.29);">
                    <div class="row">
                        <table width="100%" style="margin: 10px" id="tblw">
                            <tr>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-info ">New</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-primary ">A</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-secondary ">SS</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-warning ">AS</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-danger ">ES</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-danger ">EC</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-danger ">AC</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="badge badge-default badge-info">New Ticket</div><br>
                                    <div class="badge badge-info"><?php echo formatdate( $data[0]->reported_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-primary">Assign</div><br>
                                    <div class="badge badge-primary"><?php echo formatdate( $data[0]->assigned_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-secondary">Schedule Survey Date</div><br>
                                    <div class="badge badge-secondary"><?php echo formatdate( $data[0]->schedule_survey_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-warning">Actual Survey date</div><br>
                                    <div class="badge badge-warning"><?php echo formatdate( $data[0]->survey_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-danger">Estimated Start Date</div><br>
                                    <div class="badge badge-danger"><?php echo formatdate( $data[0]->est_start_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-danger">Estimated Complete Date</div><br>
                                    <div class="badge badge-danger"><?php echo formatdate( $data[0]->est_completion_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-danger">Actual Start Date</div><br>
                                    <div class="badge badge-danger"><?php echo formatdate( $data[0]->start_date) ?></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div id="accordion" >
                    <div class="card collapse-icon panel mb-0 box-shadow-0 border-0">
                        <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingFour" style="padding-top:8px;padding-bottom: 15px">
                            <a href="#" class="h6 blue collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Close</a>
                        </div>
                        <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion" style="">
                            <div class="card-body" style="padding-bottom: 10px;padding-top: 13px">
                              <input type="hidden" name="complainno" value="<?php echo $data[0]->complain_no ?>">
                              <input type="hidden" name="debtor_acct" value="<?php echo $data[0]->debtor_acct ?>">
                              <input type="hidden" name="contact_no" value="<?php echo $data[0]->contact_no ?>">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group col-sm-12">
                                        <label for="surveydate">Complete Date</label>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <input type="text" id="complete_date" class="form-control" placeholder="Complete Date" name="complete_date" value="<?php echo $complete_date?>" readonly>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="complete_clock" name="complete_clock"  value="<?php echo $complete_clock?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="feedback">Feedback</label>
                                        <span class="asdf" style="display: block; position: relative;">
                                            <select data-placeholder="Choose a Feedback" class="select2 form-control" id="feedback" name="feedback">
                                                <option value=""></option>
                                                <?php foreach ($feedback as $key) { ?>
                                                    <option value="<?php echo $key->code?>"><?php echo $key->descs ?></option>
                                                <?php }  ?>
                                            </select>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card" style="height: 300px">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h4>Picture Problem</h4>
                                                <?php if ($pictP): ?>
                                                    <div id="carousel-1" class="carousel slide" data-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                        <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                                                        <?php foreach ($pictP as $key => $value) { ?>
                                                            <?php if ($key > 0): ?>
                                                                <li data-target="#carousel-1" data-slide-to="<?php echo $key ?>" class=""></li>
                                                            <?php endif ?>
                                                        <?php } ?>
                                                    </ol>
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <img src="<?php echo $pictP[0]->file_url ?>" class="d-block w-100">
                                                        </div>
                                                        <?php foreach ($pictP as $key => $value) { ?>
                                                            <?php if ($key > 0): ?>
                                                                <div class="carousel-item">
                                                                    <img src="<?php echo $value->file_url ?>" class="d-block w-100">
                                                                </div>
                                                            <?php endif ?>
                                                        <?php } ?>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carousel-1" role="button" data-slide="prev">
                                                            <span class="la la-angle-left" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    <a class="carousel-control-next" href="#carousel-1" role="button" data-slide="next">
                                                            <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card" style="height: 300px">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <h4>Picture Solved</h4>
                                                <?php if ($pictS): ?>
                                                    <div id="carousel-2" class="carousel slide" data-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                        <li data-target="#carousel-2" data-slide-to="0" class="active"></li>
                                                        <?php foreach ($pictS as $key => $value) { ?>
                                                            <?php if ($key > 0): ?>
                                                                <li data-target="#carousel-2" data-slide-to="<?php echo $key ?>" class=""></li>
                                                            <?php endif ?>
                                                        <?php } ?>
                                                    </ol>
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <img src="<?php echo $pictS[0]->file_url ?>" class="d-block w-100">
                                                        </div>
                                                        <?php foreach ($pictS as $key => $value) { ?>
                                                            <?php if ($key > 0): ?>
                                                                <div class="carousel-item">
                                                                    <img src="<?php echo $value->file_url ?>" class="d-block w-100">
                                                                </div>
                                                            <?php endif ?>
                                                        <?php } ?>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carousel-2" role="button" data-slide="prev">
                                                            <span class="la la-angle-left" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    <a class="carousel-control-next" href="#carousel-2" role="button" data-slide="next">
                                                            <span class="la la-angle-right icon-next" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingTwo" style="padding-top:8px;padding-bottom: 15px">
                            <a href="#" class="h6 blue" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Confirm</a>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body" style="padding-bottom: 10px;padding-top: 13px">
                                <input type="hidden" name="complainno" value="<?php echo $data[0]->complain_no ?>">
                                <input type="hidden" name="lotno" value="<?php echo $data[0]->lot_no ?>">
                                <input type="hidden" name="categorypr" value="<?php echo $data[0]->category_priority ?>">
                                <input type="hidden" name="reportno" value="<?php echo $data[0]->report_no ?>">
                                <input type="hidden" name="debtoracct" value="<?php echo $data[0]->debtor_acct ?>">
                                <input type="hidden" name="currencycditem" id="currencycditem">
                                <input type="hidden" name="currencycdservice" id="currencycdservice">
                                <input type="hidden" name="sectioncd" id="sectioncd">
                                <input type="hidden" name="categorycd" id="categorycd">
                                <input type="hidden" name="assignto" id="assignto" value="<?php echo $data[0]->assign_to ?>">
                                <div class="form-group" id="data_1">
                                    <label>Date Complete</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <input type="text" id="completiondate" name="completiondate" class="form-control" value="<?php echo $completion_date?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="clock" name="clock"  value="<?php echo $completion_clock?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label>Remark</label>
                                        <textarea class="form-control" name="note_confirm" id="note_confirm" rows="4" cols="50" readonly>
                                            <?php echo $data[0]->remarks ?>
                                        </textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Problem Cause</label>
                                        <textarea class="form-control" name="problemcase" id="problemcase" rows="4" cols="50" readonly>
                                            <?php echo $data[0]->problem_cause ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingThree" style="padding-top:8px;padding-bottom: 15px">
                            <a href="#" class="h6 blue" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Process</a>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body" style="padding-bottom: 10px;padding-top: 13px">
                                <div class="form-group">
                                    <label for="surveydate">Estimate Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <input type="text" id="estdate" class="form-control" placeholder="Estimate Date" name="estdate" value="<?php echo $est_date?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="clock" name="clock"  value="<?php echo $est_clock?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea class="form-control" name="note" id="note" rows="4" cols="50" readonly>
                                        <?php echo $data[0]->process_notes ?>
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingOne" style="padding-top:8px;padding-bottom: 15px">
                            <a href="#" class="h6 blue collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Survey</a>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body" style="padding-bottom: 10px;padding-top: 13px">
                                <div class="form-group">
                                    <label for="surveydate">Survey Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <input type="text" id="surveydate" class="form-control" placeholder="Complain Code" name="surveydate" value="<?php echo $survey_date?>" readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="clock" name="clock"  value="<?php echo $survey_clock?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Note</label>
                                    <textarea readonly class="form-control" name="note" id="note" rows="4" cols="50"><?php echo $data[0]->survey_notes ?></textarea>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
var parentElement = $(".asdf");


  $("#modal").on("hidden.bs.modal", function(){
      $("#modalbody").html("");
  });

  $(".select2").select2({
    // width:'100%';
    dropdownParent: parentElement
    // dropdownParent: $('#modaldialog');
  })

  // $("#feedback").select2({ dropdownParent: $(".modal") });

  // loaddata();

  $('#savefrm').click(function(){
      $(this).attr('disabled','disabled')
      block(true);
      var id = $('#modal').data('id');
      var datafrm = $('#frmdata').serializeArray();
      datafrm.push({name:"id",value:id})

      $.ajax({
          url : "<?php echo base_url('C_Ticket_Close/save_close');?>",
          type:"POST",
          data:datafrm,
          dataType:"json",
          success:function(event, data){
              if(event.Error==false){
                  block(false);
                  swal({
                      title: "Information",
                      animation: false,
                      type:"success",
                      text: event.Pesan,
                      confirmButtonText: "OK"
                  });
                  loadfilter()
                  $('#modal').modal('hide');
                  table.ajax.reload(null,true);
                  var wa_cus = event.wa_cus;
                  var notpln = wa_cus.substring(0, 1);
                  if (notpln==0) {
                    wa_cus = wa_cus.replace(0,62);
                  }
                  var psnwa = "Your ticket *%23"+event.ticket+"*%23 Already Complete. Please Rate Me Your Satisfaction. Thank You"
                  var psnntf = "Your ticket *%23"+event.ticket+"*%23 Already Complete. Please Rate Me Your Satisfaction. Thank You"
                  $.getJSON("<?php echo base_url('C_Ticket_Close/gettoken');?>", function (data) {
                      $.each(data, function( index, value ) {
                          var notification = {
                              "to" : value.token,
                               "collapse_key" : "type_a",
                               "notification" : {
                                  "body" : psnntf,
                                  "title": "Close"
                              }
                          }
                          $.ajax({
                              url : "https://fcm.googleapis.com/fcm/send",
                              type:"POST",
                              headers: {
                                  "Authorization": "key=AAAAqsljBI4:APA91bFk3VsTZqTDpcQqtdifstNXiPugP4I53z_Mz_qww-P4GHUlxPRkCtzISg9gqXMQGcdnNAYaCEbM6N70GQ2R-fPmEAlx1IqTdG45slvXwOna7dHFYjRrkKWQU3MZSzA8_UYrfEv5",
                                  "Content-Type":"application/json; charset=utf-8"
                              },
                              data:JSON.stringify(notification),
                              dataType:"json"
                          });   
                      });
                  });
                  $.ajax({
                      url : 'http://35.197.137.111/whatsapp.php?IDus=CUS00000001&Handphone='+wa_cus+'&Messages='+psnwa,
                      type: "POST",
                  })
                $('#savefrm').removeAttr('disabled')
              }
              else {
                block(false);
                swal({
                      title: "Error",
                      animation: false,
                      type:"error",
                      text: event.Pesan,
                      confirmButtonText: "OK"
                });
                $('#savefrm').removeAttr('disabled')
              }
          },                    
          error: function(jqXHR, textStatus, errorThrown){
            block(false);
            swal({
                  title: "Error",
                  animation: false,
                  type:"error",
                  text: textStatus+' Save : '+errorThrown,
                  confirmButtonText: "OK"
            });
            $('#savefrm').removeAttr('disabled')
          }
      });
  });
});

function block(boelan){
  var block_ele = $('#frmdata')
  if (boelan==true) {
      $(block_ele).block({
          message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
          fadeIn: 1000,
          fadeOut: 1000,
          overlayCSS: {
              backgroundColor: '#fff',
              opacity: 0.8,
              cursor: 'wait'
          },
          css: {
              border: 0,
              padding: '10px 15px',
              color: '#fff',
              width: 'auto',
              backgroundColor: '#333',
              marginLeft : 'auto'
          }
      });
  }
  else{
      $(block_ele).unblock()
  }
}
</script>
