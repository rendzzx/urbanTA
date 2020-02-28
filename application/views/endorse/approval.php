<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>" rel="stylesheet" />
<link href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>" rel="stylesheet" />
<link href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>" rel="stylesheet" 
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>


<style type="text/css">
    #tblw td{
        text-align: center; 
        vertical-align: middle;
    }
    /*div#modaldialog{
    zoom: 85%;
}*/
button#btncheckout{

    padding-bottom: 5px;
    padding-top: 10px;

    float: right;
}

button.close{
    margin-left: 0px
}

h4#modaltitle{
    width: 100%;
}
</style>
<?php
    

    //SURVEY
    $eststartdate = $data[0]->est_start_date;
    $estcompletiondate = $data[0]->est_completion_date;
    $surveydate = $data[0]->survey_date;
    if (empty($eststartdate)) {
        $est_start_date = date("d F Y");
        $est_start_clock = date("G:i");
    }
    else{
        $est_start_date = date("d F Y",strtotime($eststartdate));
        $est_start_clock = date('G:i', strtotime($eststartdate));
    }
    if (empty($estcompletiondate)) {
        $est_completion_date = date("d F Y");
        $est_completion_clock = date("G:i");
    }
    else{
        $est_completion_date = date("d F Y",strtotime($estcompletiondate));
        $est_completion_clock = date("G:i",strtotime($estcompletiondate));
    }
    if (empty($surveydate)) {
        $survey_date = date("d F Y");
        $survey_clock = date("G:i");
    }
    else{
        $survey_date = date("d F Y",strtotime($surveydate));
        $survey_clock = date("G:i",strtotime($surveydate));
    }

    //CONFIRM
    $confirmdate = $data[0]->confirm_date;
    if (empty($confirmdate)) {
        $confirm_date = date("d F Y");
        $confirm_clock = date("G:i");
    }
    else{
        $confirm_date = date("d F Y",strtotime($confirmdate));
        $confirm_clock = date('G:i', strtotime($confirmdate));
    }

    //PROSES
    $startdate = $data[0]->start_date;
    if ($startdate==null || $startdate=='') {
        $start_date = date("d F Y");
        $start_clock = date("G:i");
    }
    else{
        $start_date = date("d F Y",strtotime($startdate));;
        $start_clock = date("G:i",strtotime($startdate));
    }
    //
    
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
                return "-- ---- ---- --:--";
            }
            else{
                return date("d F Y G:i",strtotime($data));
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
                        <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingTwo" style="padding-top:8px;padding-bottom: 15px">
                            <a href="#" class="h6 blue" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Confirm</a>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
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
                                <div class="form-group">
                                    <label for="schedule_survey_date">Confirm Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="confirm_date" class="form-control" name="confirm_date" value="<?php echo $confirm_date ?>" readonly>
                                                <div class="form-control-position">
                                                    <i class="ft-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="confirm_clock" class="form-control" name="confirm_clock" value="<?php echo $confirm_clock ?>" readonly>
                                                <div class="form-control-position">
                                                    <i class="ft-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="schedule_survey_date">Payment Method</label>
                                    <div class="row skin skin-square">
                                        <fieldset class="col-sm-2">
                                            <input type="radio" name="payment_method" id="C" value="C" checked disabled>
                                            <label for="C">Cash</label>
                                        </fieldset>
                                        <fieldset class="col-sm-2">
                                            <input type="radio" name="payment_method" id="S" value="S" disabled>
                                            <label for="S">Schedule</label>
                                        </fieldset>
                                        <fieldset class="col-sm-2">
                                            <input type="radio" name="payment_method" id="F" value="F" disabled>
                                            <label for="F">Free of Charge</label>
                                        </fieldset>
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
                                    <label for="surveydate">Actual Start Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <input type="text" id="act_start_date" class="form-control" placeholder="Actual Start Date" name="act_start_date" value="<?php echo $start_date?>" required readonly>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="act_start_clock" name="act_start_clock"  value="<?php echo $start_clock?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Process Note</label>
                                    <textarea class="form-control" name="process_notes" id="process_notes" rows="4" cols="50" readonly><?php echo $data[0]->process_notes ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingOne" style="padding-top:8px;padding-bottom: 15px">
                            <a href="#" class="h6 blue collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Survey</a>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion" style="">
                            <div class="card-body" style="padding-bottom: 10px;padding-top: 13px">
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label for="schedule_survey_date">Estimated Start Date</label>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="est_start_date" class="form-control" name="est_start_date" value="<?php echo $est_start_date ?>" readonly>
                                                    <div class="form-control-position">
                                                        <i class="ft-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="est_start_clock" class="form-control" name="est_start_clock" value="<?php echo $est_start_clock ?>" readonly>
                                                    <div class="form-control-position">
                                                        <i class="ft-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="schedule_survey_date">Estimated Completion Date</label>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="est_com_date" class="form-control" name="est_com_date" value="<?php echo $est_completion_date ?>" readonly>
                                                    <div class="form-control-position">
                                                        <i class="ft-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="est_com_clock" class="form-control" name="est_com_clock" value="<?php echo $est_completion_clock ?>" readonly>
                                                    <div class="form-control-position">
                                                        <i class="ft-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="schedule_survey_date">Actual Survey Date</label>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="act_survey_date" class="form-control" name="act_survey_date" value="<?php echo $survey_date ?>" readonly>
                                                    <div class="form-control-position">
                                                        <i class="ft-calendar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="position-relative has-icon-left">
                                                    <input type="text" id="act_survey_clock" class="form-control" name="act_survey_clock" value="<?php echo $survey_clock ?>" readonly>
                                                    <div class="form-control-position">
                                                        <i class="ft-clock"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label>Survey Note</label>
                                        <textarea class="form-control" name="surveynote" id="surveynote" rows="4" cols="50" readonly><?php echo $data[0]->survey_notes ?></textarea>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Problem Cause</label>
                                        <textarea class="form-control" name="problem" id="problem" rows="4" cols="50" readonly><?php echo $data[0]->problem_cause ?></textarea>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label>Solution of Problem</label>
                                        <textarea class="form-control" name="solution" id="solution" rows="4" cols="50" readonly><?php echo $data[0]->remarks ?></textarea>
                                    </div>
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
                            <div class='badge badge-pill badge-danger' id='cntitemc'><?php echo $cntitem; ?></div>
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
                            <div class='badge badge-pill badge-danger' id='cntservicec'><?php echo $cntservice; ?></div>
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
<div class="modal-footer" style="padding-top: 0px;padding-bottom: 0px">
    <button type="button" id="btnApproved" class="btn btn-primary">Approved</button>
    <!-- <button type="button" id="btnModify" class="btn btn-danger">Modify</button> -->
    <button type="button" id="back1" class="btn btn-default" data-dismiss="modal">Back</button>
    <button type="button" id="back2" onclick="back()" class="btn btn-default">Back</button>
</div>
</form>

<script type="text/javascript">
$(document).ready(function(){

    var payment_method = '<?php echo $data[0]->payment_method; ?>'
    if (payment_method !== '') {
        $("#"+payment_method).attr('checked', 'checked');
        $(".iradio_square-red").removeClass("checked")
        $("#"+payment_method).iCheck({
          radioClass: 'iradio_square-red checked',
        });
    }

    $('#tabhome').show()
    $('#tabckechout').hide()

    $('#btnApproved').show()
    $('#btnModify').show()
    $('#back1').show()
    $('#back2').hide()

    $('#cntc').text('<?php echo $cnt[0]->cnt ?>')

    $('#btncheckout').click(function(){
        // $('#ttl').replaceWith('<span id="ttl"><i class="ft-arrow-left" onclick="back()" style="cursor: pointer;"></i>&nbsp;Items and Services</span>')
        $('#ttl').replaceWith('<span id="ttl">Items and Services</span>')
        $(this).removeClass('btn-info').addClass('btn-success')
        $('#tabhome').hide()
        $('#tabckechout').show()

        $('#btnApproved').hide()
        $('#btnModify').hide()
        $('#back1').hide()
        $('#back2').show()
    })

    $('#btnApproved').click(function(){
            $(this).attr('disabled','disabled')
            block(true);
            var id = $('#modal').data('id');
            var datafrm = $('#frmdata').serializeArray();
            datafrm.push({name:"id",value:id})

            $.ajax({
                url : "<?php echo base_url('C_Endorse/save_approve');?>",
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
                        $('#btnApproved').removeAttr('disabled')
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
                        $('#btnApproved').removeAttr('disabled')
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
                    $('#btnApproved').removeAttr('disabled')
                }
            });
    })

    $('#btnModify').click(function(){
            $(this).attr('disabled','disabled')
            block(true);
            var id = $('#modal').data('id');
            var datafrm = $('#frmdata').serializeArray();
            datafrm.push({name:"id",value:id})

            $.ajax({
                url : "<?php echo base_url('C_Endorse/save_modify');?>",
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
                        $('#btnModify').removeAttr('disabled')
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
                        $('#btnModify').removeAttr('disabled')
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
                    $('#btnModify').removeAttr('disabled')
                }
            });
    })
})

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

    $('#btnApproved').show()
    $('#btnModify').show()
    $('#back1').show()
    $('#back2').hide()
}

</script>
