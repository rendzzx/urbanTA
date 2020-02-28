<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<style type="text/css">
    #tblw td{
        text-align: center; 
        vertical-align: middle;
    }
    div#modaldialog{
    zoom: 85%;
}
button#btncheckout{

    padding-bottom: 5px;
    padding-top: 10px;
}
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

        function formatdate($data){
            if ($data==null || $data=='') {
                return "-- / -- / ---- -- : --";
            }
            else{
                return date("d/m/Y h:i",strtotime($data));
            }
        }
?>
<form id ="frmEditor" class="form">
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
                        <table width="100%" style="margin: 10px"  id="tblw">
                            <tr>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-info ">T</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-primary ">A</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-secondary ">R</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-warning ">S</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-danger ">E</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-success ">C</span>
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
                                    <div class="badge badge-default badge-secondary">Response</div><br>
                                    <div class="badge badge-secondary"><?php echo formatdate( $data[0]->response_time) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-warning">Survey</div><br>
                                    <div class="badge badge-warning"><?php echo formatdate( $data[0]->survey_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-danger">Estimated Date</div><br>
                                    <div class="badge badge-danger"><?php echo formatdate( $data[0]->est_completion_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-success">Complete</div><br>
                                    <div class="badge badge-success "><?php echo formatdate( $data[0]->completion_date) ?></div>
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
                              <div class="form-group">
                                    <label for="descs">Feedback</label>
                                    <input type="text" id="feedback" class="form-control" name="feedback" value="<?php echo $feedback[0]->feed_back ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingTwo" style="padding-top:8px;padding-bottom: 15px">
                            <a href="#" class="h6 blue" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Confirm</a>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion" style="padding-top:8px;padding-bottom: 15px">
                            <div class="card-body" style="padding-bottom: 10px;padding-top: 13px">
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
                                        <textarea class="form-control" name="note_confirm" id="note_confirm" rows="4" cols="50" readonly><?php echo $data[0]->remarks ?></textarea>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label>Problem Cause</label>
                                        <textarea class="form-control" name="problemcase" id="problemcase" rows="4" cols="50" readonly><?php echo $data[0]->problem_cause ?></textarea>
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
                                    <textarea class="form-control" name="note" id="note" rows="4" cols="50" readonly><?php echo $data[0]->process_notes ?></textarea>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="col-sm-12" id="tabckechout">
    <div id="accordion5" class="card-accordion">
        <div class="card collapse-icon accordion-icon-rotate left">
            <div class="card">
                <div class="card-header" id="headingHThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#accordionD3" aria-expanded="true" aria-controls="accordionD3">
                            Items
                        </button>
                    </h5>
                </div>
                <div id="accordionD3" class="collapse show" aria-labelledby="headingHThree" data-parent="#accordion5">
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr>
                                    <th width="5px">No</th>
                                    <th width="65px">Item Code</th>
                                    <th>Descs</th>
                                    <th width="5px">Qyt</th>
                                    <th width="100px">Unit Price</th>
                                    <th width="100px">Base Amt</th>
                                    <th width="5px">Tax</th>
                                    <th width="100px">Tax Amt</th>
                                    <th width="100px">Total Amt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $totalitem = 0;
                                    foreach ($item as $key) {
                                    $totalitem+= $key->total_amt;
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?>.</td>
                                    <td><?php echo $key->item_cd ?></td>
                                    <td><?php echo $key->descs_item ?></td>
                                    <td><?php echo number_format($key->qty) ?></td>
                                    <td align="right"><?php echo number_format($key->charge_rate) ?></td>
                                    <td align="right"><?php echo number_format($key->base_amt) ?></td>
                                    <td><?php echo $key->tax_cd ?></td>
                                    <td align="right"><?php echo number_format($key->tax_amt) ?></td>
                                    <td align="right"><?php echo number_format($key->total_amt) ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="8" align="right"><b>Total : </b></td>
                                    <td align="right" style="padding-left: 0px"><b>Rp. <?php echo number_format($totalitem) ?></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingHFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#accordionD4" aria-expanded="false" aria-controls="accordionD4">
                            Services
                        </button>
                    </h5>
                </div>
                <div id="accordionD4" class="collapse" aria-labelledby="headingHFour" data-parent="#accordion5">
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover dataTables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="65px">Service Code</th>
                                    <th width="110px">Descs</th>
                                    <th width="100px">Time In</th>
                                    <th width="100px">Time Out</th>
                                    <th width="5px">Hours</th>
                                    <th width="100px">Rate</th>
                                    <th width="100px">Base Amt</th>
                                    <th width="5px">Tax</th>
                                    <th width="100px">Tax Amt</th>
                                    <th width="100px">Total Amt</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $totalservice = 0;
                                    foreach ($service as $key) {
                                    $totalservice+= $key->total_amt;
                                ?>
                                <tr>
                                    <td><?php echo $no++ ?>.</td>
                                    <td><?php echo $key->service_cd ?></td>
                                    <td><?php echo $key->descs_service ?></td>
                                    <td align="center"><?php echo date("d M Y h:i",strtotime($key->time_in)) ?></td>
                                    <td align="center"><?php echo date("d M Y h:i",strtotime($key->time_out)) ?></td>
                                    <td><?php echo number_format($key->manhours) ?></td>
                                    <td align="right"><?php echo number_format($key->charge_rate) ?></td>
                                    <td align="right"><?php echo number_format($key->base_amt) ?></td>
                                    <td><?php echo $key->tax_cd ?></td>
                                    <td align="right"><?php echo number_format($key->tax_amt) ?></td>
                                    <td align="right"><?php echo number_format($key->total_amt) ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="10" align="right"><b>Total : </b></td>
                                    <td align="right" style="padding-left: 0px"><b>Rp. <?php echo number_format($totalservice) ?></b></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p align="right">
                    <b>
                        Grand Total : 
                        Rp.
                        <?php
                            $grandtotal=0;
                            $grandtotal = $totalitem + $totalservice;
                            echo number_format($grandtotal);
                        ?>
                    </b>
                </p>
            </div>
        </div>
    </div>
</div>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){

  $('#tabhome').show()
  $('#tabckechout').hide()

  $('#btncheckout').click(function(){
      $('#ttl').replaceWith('<span id="ttl"><i class="ft-arrow-left" onclick="back()" style="cursor: pointer;"></i>&nbsp;Items and Services</span>')
      $(this).removeClass('btn-info').addClass('btn-success')
      $('#tabhome').hide()
      $('#tabckechout').show()
  })

  $('#cntc').text('<?php echo $cnt[0]->cnt ?>')

  $("#modal").on("hidden.bs.modal", function(){
      $("#modalbody").html("");
  });

  $(".select2").select2()

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

function back(){
    $('#ttl').replaceWith('<span id="ttl">Approval</span>')
    $('#btncheckout').removeClass('btn-success').addClass('btn-info')
    $('#tabhome').show()
    $('#tabckechout').hide()
}
</script>
