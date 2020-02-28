<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">

<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />

<style type="text/css">
    #tbl td{
        padding-right: 15px;
        padding-bottom: 10px
    }
    #tbl th{
        padding-right: 15px;
        padding-bottom: 10px
    }
</style>
<form class="form-horizontal" id="frmdata">
<?php
$schedulesurveydate = $data[0]->schedule_survey_date;
$schedule_survey_date = '';
$schedule_survey_clock = '';
if ($schedulesurveydate==null || $schedulesurveydate=='') {
    $schedule_survey_date = date("d F Y");
    $schedule_survey_clock = date("G:i");
}
else{
    $schedule_survey_date = date("d F Y",strtotime($schedulesurveydate));
    $schedule_survey_clock = date("G:i",strtotime($schedulesurveydate));
}    

$priority = $data[0]->category_priority;
$reportno = $data[0]->report_no;

if ($priority==1) {
    $priority = "Low";
}
else if ($priority==2) {
    $priority = "Medium";
}
else if ($priority==1) {
    $priority = "High";
}
else{
    $priority = "Error";
}

if ($reportno==null || $reportno=='') {
    $reportno = 'Not Set';
}

function formatdate($data){
    if ($data==null || $data=='') {
        return "--  ----  ---- --:--";
    }
    else{
        return date("d F Y G:i",strtotime($data));
    }
}

 ?>
<div class="panel panel-default">
    <div class="panel-body">
        <table id="tbl">
            <tr>
                <th>Ticket No</th>
                <td>:</td>
                <td><?php echo $data[0]->complain_no ?></td>
            </tr>
            <tr>
                <th>Category</th>
                <td>:</td>
                <td><?php echo $data[0]->descs ?></td>
            </tr>
            <tr>
                <th>Priority</th>
                <td>:</td>
                <td><?php echo $priority ?></td>
            </tr>
            <tr>
                <th>Work Requested</th>
                <td>:</td>
                <td><?php echo $data[0]->work_requested ?></td>
            </tr>
            <tr>
                <th>Date Requested</th>
                <td>:</td>
                <td><?php echo formatdate($data[0]->reported_date) ?></td>
            </tr>
        </table>
    </div>
</div>
<div class="form-group">
<input type="hidden" name="complainno" value="<?php echo $data[0]->complain_no ?>">
<input type="hidden" name="assign_to" value="<?php echo $data[0]->assign_to ?>">
<input type="hidden" name="debtor_acct" value="<?php echo $data[0]->debtor_acct ?>">
<input type="hidden" name="contact_no" value="<?php echo $data[0]->contact_no ?>">
    <label><b>Assign to PIC<b></label>
    <div class="row skin skin-line">
    <?php foreach ($labour as $key) { ?>
        <div class="col-sm-4">
            <fieldset>
                <input type="radio" name="labourid" id="<?php echo $key->staff_id?>" value="<?php echo $key->staff_id.','.$key->email_addr.','.$key->name ?>">
                <label for="<?php echo $key->staff_id?>">
                    <?php echo $key->name ?>
                </label>
            </fieldset>
        </div>
            <?php   } ?>
    </div>
</div>
<div class="form-group">
    <label for="descs">Assisted By</label>
    <select data-placeholder="Choose an Assisten" class="select2 form-control" id="assisted" name="assisted" multiple="multiple">
    </select>
</div>
<div class="form-group">
    <label for="schedule_survey_date">Schedule Survey Date</label>
    <div class="row">
        <div class="col-sm-8">
            <div class="position-relative has-icon-left">
                <input type="text" id="schedule_survey_date" class="form-control" name="schedule_survey_date" value="<?php echo $schedule_survey_date?>">
                <div class="form-control-position">
                    <i class="ft-calendar"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="position-relative has-icon-left">
                <input type="text" id="schedule_survey_clock" class="form-control" name="schedule_survey_clock" value="<?php echo $schedule_survey_clock?>">
                <div class="form-control-position">
                    <i class="ft-clock"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-danger" id="savefrm">Save</button>
</div>

</form>
<!-- <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>

<script type="text/javascript">

    $(".select2").select2({
        width:'100%'
    });

    $('#schedule_survey_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd MM yyyy',
    });

    $('#schedule_survey_clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    var assigto = '<?php echo $data[0]->assign_to ?>'
    if (assigto!=='') {
        $('#savefrm').text('Update Assign')
        $("#"+assigto).attr('checked', 'checked');
        $(".iradio_line-blue").removeClass("checked")
        $("#"+assigto).iCheck({
          radioClass: 'iradio_line-blue checked',
          insert: '<div class="icheck_line-icon"></div>' + assigto
        });
    }

    $.getJSON("<?php echo base_url('C_Ticket_Assign/getassited/');?>" + assigto, function (data) {
        $("#assisted").empty()
        $.each(data, function( index, value ) {
            $("#assisted").append('<option value="'+value.staff_id+'">'+value.name+'</option>')
        });
    })

    $('input[name=labourid]').on('ifChanged', function(event){
        block(true);
        var labour = this.value
        var labour = labour.split(",");
        $.getJSON("<?php echo base_url('C_Ticket_Assign/getassited/');?>" + labour[0], function (data) {
            $("#assisted").empty()
            $.each(data, function( index, value ) {
                $("#assisted").append('<option value="'+value.staff_id+'">'+value.name+'</option>')
                block(false);
            });
        })
    })

    loaddata();

    $('#savefrm').click(function(){
        $(this).attr('disabled','disabled')
        block(true);
        var id = $('#modal').data('id');
        var assisted = $("#assisted").val();
        var datafrm = $('#frmdata').serializeArray();
        datafrm.push({name:"id",value:id},{name:"assisted",value:assisted})

        $.ajax({
            url : "<?php echo base_url('C_Ticket_Assign/save_assign');?>",
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
                    pesan = event.Pesan
                    $('#modal').modal('hide');
                    table.ajax.reload(null,true);
                    table
                      .column( 4 )
                      .search('')
                    .draw()
                    var wa_no = event.wa_no;
                    var wa_cus = event.wa_cus;
                    var notpln = wa_no.substring(0, 1);
                    var notpln2 = wa_cus.substring(0, 1);
                    if (notpln==0) {
                      wa_no = wa_no.replace(0,62);
                    }
                    if (notpln2==0) {
                      wa_cus = wa_cus.replace(0,62);
                    }
                    var psnwa = "Your ticket *%23"+event.ticket+"*%23 Already Assigned. Thank you"
                    var psnntf = "Your ticket #"+event.ticket+"# Already Assigned. Thank you"
                    $.getJSON("<?php echo base_url('C_Ticket_Assign/gettoken');?>", function (data) {
                        $.each(data, function( index, value ) {
                            var notification = {
                                "to" : value.token,
                                 "collapse_key" : "type_a",
                                 "notification" : {
                                    "body" : psnntf,
                                    "title": "Assign"
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
                        url : 'http://35.197.137.111/whatsapp.php?IDus=CUS00000001&Handphone='+wa_no+'&Messages='+psnwa,
                        type: "POST",
                    })
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
    })

    function loaddata(){
        var id = "<?php echo $data[0]->complain_no ?>";
        if (id > 0) {
            block(true);
            $.getJSON("<?php echo base_url('C_Ticket_Assign/getDataByid');?>" + "/" + id, function (data) {
                var assisted = data[0].assisted_by
                if (assisted !== null) {
                    assisted = assisted.split(",");
                    $.each(assisted, function( index, value ) {
                        $("#assisted option[value="+value+"]").remove()
                        $("#assisted").append('<option value="'+value+'" selected>'+value+'</option>')
                    });
                }
                block(false);
            })
        }
    }

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
