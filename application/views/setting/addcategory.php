<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">

<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="descs">Description</label>
            <input type="text" id="descs" class="form-control" placeholder="Description" name="descs">
        </div>
        <div class="form-group">
            <label for="descs">Priority</label>
            <div class="row skin skin-line">
                <div class="col-sm-4">
                    <fieldset>
                        <input type="radio" name="priority" id="priority1" value="1" checked="">
                        <label for="priority1" id="Low" label="Low">Low</label>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="priority" id="priority2" value="2">
                        <label for="priority2" label="Meduim">Meduim</label>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="priority" id="priority3" value="3">
                        <label for="priority2" label="High">High</label>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="descs">Supervisor</label>
            <select data-placeholder="Choose a Supervisor" class="select2 form-control" id="spvid" name="spvid">
                <option value=""></option>
                <?php foreach ($supervisor as $key) { ?>
                    <option value="<?php echo $key->staff_id?>"><?php echo $key->name ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="descs">Category Group</label>
            <select data-placeholder="Choose a Category Group" class="select2 form-control" id="categorygroup" name="categorygroup">
                <option value=""></option>
                <?php foreach ($category_group as $key) { ?>
                    <option value="<?php echo $key->category_group_cd?>"><?php echo $key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="descs">Helpdesk Type</label>
            <div class="row skin skin-line">
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="complain" id="R" value="R" checked="">
                        <label for="R" id="labelR">Request</label>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="complain" id="C" value="C">
                        <label for="C" id="labelC">Complain</label>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="complain" id="A" value="A">
                        <label for="C" id="labelC">Access</label>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="complain" id="P" value="P">
                        <label for="C" id="labelC">Parking</label>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="complain" id="T" value="T">
                        <label for="C" id="labelC">Telphone</label>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>

<script>
	$(document).ready(function(){

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $(".select2").select2();
    

		loaddata();

        $('#savefrm').click(function(){
            block(true);
            var id = $('#modal').data('id');
            var datafrm = $('#frmdata').serializeArray();
            datafrm.push({name:"id",value:id})

            $.ajax({
                url : "<?php echo base_url('C_Setting_Cs/save_category');?>",
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
                        tblcategory.ajax.reload(null,true);
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
        })
    });


    function loaddata(){
        var id = $('#modal').data('id');
        if (id > 0) {
            block(true);
            $.getJSON("<?php echo base_url('C_Setting_Cs/getByIDcategory');?>" + "/" + id, function (data) {
                $('#descs').val(data[0].descs);
                var priority = data[0].category_priority;
                $("#priority"+priority).attr('checked', 'checked');
                var label_priority = ''
                if (priority==1) {
                    label_priority = 'Low'
                }
                if (priority==2) {
                    label_priority = 'Meduim'
                }
                if (priority==3) {
                    label_priority = 'High'
                }
                $(".iradio_line-blue").removeClass("checked")
                $("#priority"+priority).iCheck({
                  radioClass: 'iradio_line-blue checked',
                  insert: '<div class="icheck_line-icon"></div>' + label_priority
                });
                $('#spvid').val(data[0].user_spv).trigger("change");
                $('#categorygroup').val(data[0].category_group_cd).trigger("change");
                var complain = data[0].complain_type;
                $("#"+complain).attr('checked', 'checked');
                var label_complain = ''
                if (complain=='R') {
                    label_complain = 'Request'
                }
                if (complain=='C') {
                    label_complain = 'Complain'
                }
                if (complain=='A') {
                    label_complain = 'Access'
                }
                if (complain=='T') {
                    label_complain = 'Telphone'
                }
                if (complain=='P') {
                    label_complain = 'Parking'
                }
                $("#"+complain).iCheck({
                  radioClass: 'iradio_line-blue checked',
                  insert: '<div class="icheck_line-icon"></div>' + label_complain
                });
                block(false);
            });
        }
        else{
            block(false);
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