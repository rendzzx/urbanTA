<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="sectioncd">User</label>
            <select data-placeholder="Choose a User" class="select2 form-control" id="userid" name="userid">
                <option value=""></option>
                <?php foreach ($user as $key) { ?>
                    <option value="<?php echo $key->name?>"><?php echo $key->description ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="labourid">Labour</label>
            <select data-placeholder="Choose a Labour" class="select2 form-control" id="labourid" name="labourid">
                <option value=""></option>
                <?php foreach ($labour as $key) { ?>
                    <option value="<?php echo $key->staff_id?>"><?php echo $key->staff_name ?></option>
                <?php }  ?>
            </select>
        </div>
    </div>
</form>
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
            url : "<?php echo base_url('C_Setting_Cs/save_assign');?>",
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
                    tblassign.ajax.reload(null,true);
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
        $.getJSON("<?php echo base_url('C_Setting_Cs/getByIDassign');?>" + "/" + id, function (data) {
            $('#userid').val(data[0].user_id).trigger("change");
            $('#labourid').val(data[0].staff_id).trigger("change");
            block(false);
        });
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