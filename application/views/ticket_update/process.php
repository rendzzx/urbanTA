<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('css/plugins/toastr/toastr.min.css')?>" rel="stylesheet" />


<style type="text/css">
.clockpicker-popover {
    z-index: 999999;
}

#control-label{
    padding-top: 7px;
}

#row-respons{
    margin-right: 0px !important;
    margin-left: 0px !important;
}
.select2 {
    width:100% !important;
}

/*span.select2-container.select2-container--default.select2-container--open {
    position: relative !important;
    top: 0 !important;
    left: 0 !important;
}*/

.select2-dropdown--below {
    top: -2rem; 
    
}

span.select2-dropdown.select2-dropdown--below{
    left: -1rem !important;
}

/*.select2-container--open .select2-dropdown{
    left: none !important;
}*/

/*.select2-container--open {
    position: relative !important;
    top: 0 !important;
    left: 0 !important;
}*/

#tblw td{
    text-align: center; 
    vertical-align: middle;
}
/*div#modaldialog{
    zoom: 85%;
}*/

h4#modaltitle{
    width: 100%;
}

button.close{
    margin-left: 0px
}

/*.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom{
        margin-top: -3.5%;
position: relative;
}

.popover.clockpicker-popover.bottom.clockpicker-align-left {
    margin-top: -5%;
    margin-left: -10%;
}*/

/*.btn .badge{
    top: -2px;
}*/


    
</style>

<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>C_Ticket_Update/save_update" enctype="multipart/form-data">
<?php      
    $startdate = $data[0]->start_date;
    if ($startdate==null || $startdate=='') {
        $start_date = date("d F Y");
        $start_clock = date("G:i");
    }
    else{
        $start_date = date("d F Y",strtotime($startdate));;
        $start_clock = date("G:i",strtotime($startdate));
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
                <div class="card-body">
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
                        <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingTwo"  style="padding-top:0px;padding-bottom:15px">
                            <a href="#" class="h6 blue" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Process</a>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body" style="padding-top: 13px;">
                                <input type="hidden" name="complainno" value="<?php echo $data[0]->complain_no ?>">
                                <input type="hidden" name="assignto" id="assignto" value="<?php echo $data[0]->assign_to ?>">
                                <div class="form-group">
                                    <label for="surveydate">Actual Start Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <input type="text" id="act_start_date" class="form-control" placeholder="Actual Start Date" name="act_start_date" value="<?php echo $start_date?>" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="act_start_clock" name="act_start_clock"  value="<?php echo $start_clock?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Process Note</label>
                                    <textarea class="form-control" name="process_notes" id="process_notes" rows="4" cols="50"><?php echo $data[0]->process_notes ?></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="modal-footer" style="padding-top: 10px;padding-bottom: 10px">
    <button type="button" id="btnSave" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
</div>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){

    var start_date = '<?php echo $data[0]->start_date; ?>'
    var completion_date = '<?php echo $data[0]->completion_date; ?>'
    if (start_date!=='') {
        $('#btnSave').text('Update Process')
    }
    else{
        $('#btnSave').text('Submit')   
    }

    if (completion_date!=='') {
        $('#btnSave').attr('disabled','disabled')
    }

    $('#act_start_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd MM yyyy',
    });

    $('#act_start_clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('#clock_est').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('#btnSave').click(function(){
        $(this).attr('disabled','disabled')
        block(true)
        var datafrm = $('#frmEditor').serializeArray();

        $.ajax({
            url : "<?php echo base_url('C_Ticket_Update/save_proses');?>",
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
                    table.ajax.reload(null,true);
                    loadfilter()
                    $('#btnSave').removeAttr('disabled')
                    $('#modal').modal('hide');
                } else {
                    $('#modal').modal('hide');
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
                $('#modal').modal('hide');
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
