<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<form class="form" id="frmdata">

    <div class="form-group">
        <label for="name">Group Code</label>
        <input type="text" id="group_cd" class="form-control" placeholder="Group Code" name="group_cd" readonly>
    </div>
    <div class="form-group">
        <label for="name">Group Description</label>
        <input type="text" id="group_descs" class="form-control" placeholder="Group Description" name="group_descs" readonly>
        <input type="hidden" id="GroupID" class="form-control" placeholder="Email" name="GroupID">
    </div>

    <div class="form-group">
        <label>Assign Module</label>
        <div class="row skin skin-line">
            <?php $no = 1;
                if(!empty($module)){
                    foreach ($module as $key) {
                        ?>
            <div class="col-sm-12">
                <fieldset>
                    <input type="checkbox" class="pro" name="module[]" id="module_<?php echo $key->rowID?>" value="<?php echo $key->rowID?>">
                    <label for="module_<?php echo $key->rowID?>"><?php echo $key->module_descs.' ('.$key->module_cd.')'?></label>
                </fieldset>
            </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>

</form>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/toggle/switchery.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/toggle/switchery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/switch.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>


<script>

$(document).ready(function(){

    loaddata()

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $(".select2").select2()

 
  

    $('#savefrm').click(function(event) {
        block(true);
        event.preventDefault();
        if (event.handled !== true) {
            event.handled = true;
            if($('#frmdata').valid()){
            var id = $('#modal').data('id');
           
            var datafrm = $('#frmdata').serializeArray();
            console.log(datafrm);
            // return;

                $.ajax({
                url : "<?php echo base_url('c_module/save_assign');?>",
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
                        tbluser.ajax.reload(null,true);
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
            } else{
                block(false);
            }
        }
    });
});


function loaddata(){
    var GroupID = $('#modal').data('GroupID');
    var group_cd = $('#modal').data('group_cd');
    var group_descs = $('#modal').data('group_descs');
    $('#group_descs').val(group_descs)
    $('#group_cd').val(group_cd)
    $('#GroupID').val(GroupID)
        block(true);
        $.getJSON("<?php echo base_url('c_module/getByModuleGroup');?>" + "/" + group_cd, function (data) {
            console.log(data.length)

            $(".icheckbox_line-blue").removeClass("checked")
            if(data.length>0){
                 $.each(data, function( index, value ) {
                    var moduleID = value.moduleID;
                    var descs = value.module_descs;
                    var module_cd = value.module_cd;
                    $("#module_"+moduleID.trim()).attr('checked', 'checked');
                    $("#module_"+moduleID.trim()).iCheck({
                      checkboxClass: 'icheckbox_line-blue checked',
                      insert: '<div class="icheck_line-icon"></div>' + descs +' ('+module_cd.trim()+')'
                    });
                });
            }
           
            
            block(false);
        });

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