<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />

<style type="text/css">
.clockpicker-popover {
    z-index: 999999;
}
</style>
<?php  
    $timein = $work[0]->begin_time;
    $timein_date = '';
    $timein_clock = '';

    if ($timein==null || $timein=='') {
        $timein_date = '';
        $timein_clock = '';
    }
    else{

        $timein_date = date("d/m/Y",strtotime($timein));
        $timein_clock = date("h:i",strtotime($timein));
    }

    $timeout = $work[0]->end_time;
    $timeout_date = '';
    $timeout_clock = '';

    if ($timeout==null || $timeout=='') {
        $timeout_date = '';
        $timeout_clock = '';
    }
    else{
        $timeout_date = date("d/m/Y",strtotime($timeout));
        $timeout_clock = date("h:i",strtotime($timeout));
    }
 ?>
<form class="form" id="frmdata">
    <div class="form-group">
        <label for="day_cd">Day Code</label>
        <input type="text" class="form-control" id="day_cd" name="day_cd">
    </div>
    <div class="form-group">
        <label for="descs">Description</label>
        <input type="text" class="form-control" id="descs" name="descs">
    </div>
    <div class="form-group">
        <label for="day_type">Day Type</label>
        <select data-placeholder="Choose a Day Type" class="select2 form-control" id="day_type" name="day_type">
            <option value="D">Weekday</option>
            <option value="E">Weekend</option>
        </select>
    </div>
    <div class="form-group">
        <label>Time In</label>
        <div class="row">
            <div class="col-sm-5">
                <input type="text" id="timein_date" name="timein_date" class="form-control">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="timein_clock" name="timein_clock">
            </div>
        </div>
    </div>
	<div class="form-group">
        <label>Time Out</label>                     
        <div class="row">
            <div class="col-sm-5">
                <input type="text" id="timeout_date" name="timeout_date" class="form-control">
            </div>
            <div class="col-sm-3">
                <input type="text" class="form-control" id="timeout_clock" name="timeout_clock">
            </div>
        </div>
    </div>
</form>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script>
$(document).ready(function(){

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $(".select2").select2();

	loaddata();

    $('#timein_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd-MM-yyyy',
    });

    $('#timein_clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('#timeout_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd-MM-yyyy'
    });

    $('#timeout_clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('#savefrm').click(function(){
        block(true);
        var id = $('#modal').data('id');
        var datafrm = $('#frmdata').serializeArray();
        datafrm.push({name:"id",value:id})

        $.ajax({
            url : "<?php echo base_url('C_Setting_ot/save_workhour');?>",
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
                    tblworkhour.ajax.reload(null,true);
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

function loaddata(){
    var id = $('#modal').data('id');
    if (id > 0) {
        block(true);

        $.getJSON("<?php echo base_url('C_Setting_ot/getByIDworkhour');?>" + "/" + id, function (data){
            $('#day_cd').val(data[0].day_cd);
            $('#descs').val(data[0].descs);
            $('#day_type').val(data[0].day_type);
            var begin = new Date(data[0].begin_time);
            var begintime = begin.toLocaleDateString('en-GB')
            var beginclock = begin.toLocaleTimeString()
            $('#timein_date').val(begintime);
            $('#timein_clock').val(beginclock);
            var end = new Date(data[0].end_time);
            var endtime = end.toLocaleDateString('en-GB')
            var endclock = end.toLocaleTimeString()
            $('#timeout_date').val(endtime);
            $('#timeout_clock').val(endclock);
            block(false)
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