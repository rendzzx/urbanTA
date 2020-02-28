<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
    <link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<!-- link -->

<!-- content -->
    <form class="form" id="frmdata">

        <!-- hidden input -->
            <input type="text" id="txtGrouptype" name="txtGrouptype" value="<?php echo $agent[0]->group_type ?>" hidden>
            <input type="text" id="txtGroupcd" name="txtGroupcd" value="<?php echo $agent[0]->group_cd ?>" hidden>
            <input type="text" id="txtGroupname" name="txtGroupname" value="<?php echo $agent[0]->group_name ?>" hidden>
            <input type="text" id="txtEmail" name="txtEmail" value="<?php echo $agent[0]->email_add ?>" hidden>
            <input type="text" id="txtFullname" name="txtFullname" value="<?php echo $agent[0]->full_name ?>" hidden>
            <input type="text" id="txtRegistdate" name="txtRegistdate" value="<?php echo date('d M Y H:i:s', strtotime($agent[0]->registration_date))?>" hidden>

            <input type="text" id="txtNik" name="txtNik" value="<?php echo $agent[0]->nik ?>" hidden>
            <input type="text" id="txtNpwp" name="txtNpwp" value="<?php echo $agent[0]->npwp ?>" hidden>
            <input type="text" id="txtTrasnfer_bank" name="txtTrasnfer_bank" value="<?php echo $agent[0]->transfer_bank_name ?>" hidden>
            <input type="text" id="txtTransfer_name" name="txtTransfer_name" value="<?php echo $agent[0]->transfer_name ?>" hidden>
            <input type="text" id="txtTransfer_acc" name="txtTransfer_acc" value="<?php echo $agent[0]->transfer_acct_no ?>" hidden>

            <input type="text" id="txtFileurl" name="txtFileurl" value="<?php echo $agent[0]->file_url ?>" hidden>
            <input type="text" id="txtNpwpurl" name="txtNpwpurl" value="<?php echo $agent[0]->npwp_file_url ?>" hidden>
            <input type="text" id="txtMemberurl" name="txtMemberurl" value="<?php echo $agent[0]->member_file_url ?>" hidden>
            <input type="text" id="txtSavingurl" name="txtSavingurl" value="<?php echo $agent[0]->saving_file_url ?>" hidden>

            <input type="text" id="txtFileattachment" name="txtFileattachment" value="<?php echo $agent[0]->file_attachment ?>" hidden>
            <input type="text" id="txtNpwpattachment" name="txtNpwpattachment" value="<?php echo $agent[0]->npwp_file_attachment ?>" hidden>
            <input type="text" id="txtMemberattachment" name="txtMemberattachment" value="<?php echo $agent[0]->member_file_attachment ?>" hidden>
            <input type="text" id="txtSavingattachment" name="txtSavingattachment" value="<?php echo $agent[0]->saving_file_attachment ?>" hidden>
            

            <input type="text" id="txtHandphone" name="txtHandphone" value="<?php echo $agent[0]->handphone1 ?>" hidden>
            <input type="text" id="txtStatus" name="txtStatus" value="<?php echo $agent[0]->status ?>" hidden>

        <div class="col-lg-12">
            <div class="form-group">
                <label>Assign Project</label>
                
                    <?php $no = 1;
                        if(!empty($project)){
                            foreach ($project as $key) { ?>
                                <div class="row skin skin-line">
                                    <div class="col-lg">
                                        <fieldset>
                                            <input type="checkbox" class="pro" name="project[]" id="project_no" value="<?= $key->project_no?>">
                                            <label for="project_no_<?= $key->project_no?>"><?php echo $key->descs.' ('.$key->project_no.')'?></label>
                                        </fieldset>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    ?>
                
            </div>
        </div>
    </form>
<!-- content -->

<!-- script -->
    <script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/forms/toggle/switchery.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/forms/toggle/switchery.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/js/scripts/forms/switch.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
    <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<!-- script -->

<!-- script -->
    <script>
        var isFile=false;
        var jqXHRData;
        $(document).ready(function(){
            $("#modal").on("hidden.bs.modal", function(){
                $("#modalbody").html("");
            });

            $('.i-checks').iCheck({
                radioClass: 'iradio_square-purple',
                checkboxClass: 'icheckbox_flat-purple'
            });
           $('#activate-Y').iCheck('disable');
           $('#activate-N').iCheck('disable');
            
            $("#frmdata").validate({
                ignore:"",
                rules: {
                },
                messages: {
                    // project[]: {
                    //     cek_data: "Please choose a picture."
                    // }
                },
                errorElement: "span",
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass(errorClass); //.removeClass(errorClass);
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass(errorClass); //.addClass(validClass);
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else if (element.hasClass('select2')){
                        error.insertAfter(element.next('span'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
         
            $('#savefrm').click(function(event) {
                var proj = [];
                $('input[name="project[]"]:checked').each(function() {
                    proj.push($(this)[0].value);
                });

                block(true);
                event.preventDefault();
                if (event.handled !== true) {
                    event.handled = true;
                    if(proj.length > 0){
                        var email = $('#modal').data('email');
                        var datafrm = $('#frmdata').serializeArray();
                  
                        datafrm.push(
                            {name:"email",value:email}
                        )

                        // console.log(datafrm);return;
                        $.ajax({
                            url : "<?php echo base_url('c_submit_agent/verifyproject_save');?>",
                            type:"POST",
                            data:datafrm,
                            dataType:"json",
                            success:function(event, data){
                                if(event.status == 'OK'){
                                    block(false);
                                    swal({
                                        title: "Information",
                                        animation: false,
                                        type:"success",
                                        text: event.Pesan,
                                        confirmButtonText: "OK"
                                    });
                                    $('#modal').modal('hide');
                                    tblagent.ajax.reload(null,true);
                                    tbldeclineagent.ajax.reload(null,true);
                                    tblhisagent.ajax.reload(null,true);
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
                    }else{
                        block(false);
                        swal({
                            title: "Error",
                            type:"warning",
                            text: "You have to at least select one project before saving",
                            confirmButtonText: "OK"
                        });
                    }
                }
                block(false);
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

    </script>
<!-- end script