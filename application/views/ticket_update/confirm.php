<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>" rel="stylesheet" />
<link href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>" rel="stylesheet" />
<link href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>" rel="stylesheet" />

<style type="text/css">
.clockpicker-popover {
    z-index: 999999;
}

#tblw td{
    text-align: center; 
    vertical-align: middle;
}
/*div#modaldialog{
    zoom: 85%;
}*/

.select2-dropdown--below {
    top: -2rem; /*your input height*/
    /*left: 0rem;*/
    /*left: : -1rem !important;*/
}

span.select2-dropdown.select2-dropdown--below{
    left: -1rem !important;
}

h4#modaltitle{
    width: 100%;
}

.select2 {
    width:100% !important;
}

</style>
<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>C_Ticket_Update/save_update" enctype="multipart/form-data">
<?php

$confirmdate = $data[0]->confirm_date;
if (empty($confirmdate)) {
    $confirm_date = date("d F Y");
    $confirm_clock = date("G:i");
}
else{
    $confirm_date = date("d F Y",strtotime($confirmdate));
    $confirm_clock = date('G:i', strtotime($confirmdate));
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
                                        <span class="media-object rounded-circle text-circle bg-danger ">AS</span>
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
                <div id="accordion">
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
                                <input type="hidden" name="sectioncd" id="sectioncd">
                                <input type="hidden" name="categorycd" id="categorycd">
                                <input type="hidden" name="assignto" id="assignto" value="<?php echo $data[0]->assign_to ?>">
                                <div class="form-group">
                                    <label for="schedule_survey_date">Confirm Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="confirm_date" class="form-control" name="confirm_date" value="<?php echo $confirm_date ?>">
                                                <div class="form-control-position">
                                                    <i class="ft-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="confirm_clock" class="form-control" name="confirm_clock" value="<?php echo $confirm_clock ?>">
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
                                            <input type="radio" name="payment_method" id="C" value="C" checked>
                                            <label for="C">Cash</label>
                                        </fieldset>
                                        <fieldset class="col-sm-2">
                                            <input type="radio" name="payment_method" id="S" value="S">
                                            <label for="S">Schedule</label>
                                        </fieldset>
                                        <fieldset class="col-sm-2">
                                            <input type="radio" name="payment_method" id="F" value="F">
                                            <label for="F">Free of Charge</label>
                                        </fieldset>
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
<div class="modal-footer" style="padding-top: 0px;padding-bottom: 0px">
    <button type="button" id="btnSave" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
</div>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){
    
    var confirm_date = '<?php echo $data[0]->confirm_date; ?>'
    var start_date = '<?php echo $data[0]->start_date; ?>'
    if (confirm_date!=='') {
        $('#btnSave').text('Update Confirm')
    }
    else{
        $('#btnSave').text('Submit')
    }

    if (start_date!=='') {
        $('#btnSave').attr('disabled','disabled')
    }

    var payment_method = '<?php echo $data[0]->payment_method; ?>'
    if (payment_method !== '') {
        $("#"+payment_method).attr('checked', 'checked');
        $(".iradio_square-red").removeClass("checked")
        $("#"+payment_method).iCheck({
          radioClass: 'iradio_square-red checked',
        });
    }

    $('#confirm_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd MM yyyy',
    });

    $('#confirm_clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

let optionss = {
    donetext : 'Done',
     placement: 'bottom',
     align: 'left',

     autoclose: true,
        'default': 'now'
        
}
    $('#clock_completion').clockpicker(optionss);


    $('#clock_est').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('#inclock').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'bottom-dikit',
        align: 'kiri-dikit'
    });

    $('#outclock').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'bottom-dikit',
        align: 'kiri-dikit-outclock'
    });

    $('#btnSave').click(function(){
        $(this).attr('disabled','disabled')
        block(true)
        var datafrm = $('#frmEditor').serializeArray();

        $.ajax({
            url : "<?php echo base_url('C_Ticket_Update/save_confirm');?>",
            type:"POST",
            data:datafrm,
            dataType:"json",
            success:function(event, data){
                if(event.Error==false){
                block(false)
                swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: event.Pesan,
                    confirmButtonText: "OK"
                });
                    $('#modal').modal('hide');
                    table.ajax.reload(null,true);
                    loadfilter()
                    $('#btnSave').removeAttr('disabled')
                }
                else {
                    block(false)
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                    $('#btnSave').removeAttr('disabled')   
                }
            },                    
            error: function(jqXHR, textStatus, errorThrown){
                block(false)
                swal({
                    title: "Error",
                    animation: false,
                    type:"error",
                    text: textStatus+' Save : '+errorThrown,
                    confirmButtonText: "OK"
                });
                $('#btnSave').removeAttr('disabled')
            }
        });
    })
})

function block(boelan){
    var block_ele = $('#frmEditor')
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
