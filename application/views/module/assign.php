<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">

    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/validation/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>"></script>

    <style type="text/css">
        .has-error .select2 {
            border: 1px solid #a94442;
            border-radius: 4px;
        }
        .has-error .checkbox-inline {
            border: 1px solid #a94442;
            border-radius: 4px;
        }
        .has-error .radio-inline {
            border: 1px solid #a94442;
            border-radius: 4px;
        }
    </style>
<!-- link -->

<!-- content -->
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
                <?php 
                    $no = 1;
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
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        $(document).ready(function(){
            loaddata();
            $(".select2").select2();

            $('#savefrm').click(function(event) {
                block(true);
                event.preventDefault();
                if (event.handled !== true){
                    event.handled = true;
                    if($('#frmdata').valid()){
                        var id = $('#modal').data('id');
                        var datafrm = $('#frmdata').serializeArray();
                        $.ajax({
                            url : "<?php echo base_url('C_module/save_assign');?>",
                            type:"POST",
                            data:datafrm,
                            dataType:"json",
                            success:function(event, data){
                                if (event.Error == false) {
                                    Swal.fire({
                                        title: "Information",
                                        animation: true,
                                        icon:"success",
                                        text: event.Message,
                                        confirmButtonText: "OK"
                                    });
                                    $('#modal').modal('hide');
                                    tblassignmodule.ajax.reload(null,true);
                                }
                                else{
                                    Swal.fire({
                                        title: "Information",
                                        animation: false,
                                        icon:"error",
                                        text: event.Message,
                                        confirmButtonText: "OK"
                                    });
                                }
                                block(false);
                            },                  
                            error: function(jqXHR, textStatus, errorThrown){
                                Swal.fire({
                                    title: "Error",
                                    animation: false,
                                    icon:"error",
                                    text: textStatus+' Save : '+errorThrown,
                                    confirmButtonText: "OK"
                                });
                                block(false);
                            }
                        });
                    }
                    else{
                        block(false);
                    }
                }
            });
        });


        function loaddata(){
            var GroupID = $('#modal').data('GroupID');
            var group_cd = $('#modal').data('group_cd');
            var group_descs = $('#modal').data('group_descs');
            $('#group_descs').val(group_descs);
            $('#group_cd').val(group_cd);
            $('#GroupID').val(GroupID);

            block(true);
            $.getJSON("<?php echo base_url('C_module/getByModuleGroup');?>" + "/" + group_cd, function (data) {
                // console.log(data.length);
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

        $('#modal').one('hidden.bs.modal', function (e) {
            $(this).removeData();
        });
    </script>
<!-- js -->