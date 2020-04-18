<!-- link       -->
    <link href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>" rel="stylesheet">
    <script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>"></script>
    <script src="<?=base_url('app-assets/vendors/js/forms/validation/jquery.validate.min.js')?>"></script>
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
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <input type="hidden" name="txtGroupID" id="txtGroupID" class="form-control">
            </div>
            <div class="form-group">
                <label for="GroupCD" class="col-xs-8">Group Code</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtGroupCD" id="txtGroupCD" placeholder="Group Code">
                </div>
            </div>
            <div class="form-group">
                <label for="GroupDescs" class="col-xs-8 control-label">Group Description</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtGroupDescs" id="txtGroupDescs" placeholder="Group Description">
                </div>
            </div>
        </div>   
    </form>
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        var menuid = $('#modal').data('MenuID');
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
        
        $(document).ready(function () {
            loaddata();
            $('#savefrm').click(function(event){
                event.preventDefault();
                if (event.handled !== true) {
                    event.handled = true;
                    if ($('#frmEditor').valid()) {
                        block(true);
                        var id = $('#modal').data('rowID');
                        var datafrm = $('#frmEditor').serializeArray();
                        $.ajax({
                            url : "<?php echo base_url('C_group/save');?>",
                            type:"POST",
                            data: datafrm,
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
                                    tblgroup.ajax.reload(null,true);
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
                                    type:"error",
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

            $("#frmEditor").validate({
                rules: {
                    txtGroupCD: {
                        required: true,
                        maxlength:10
                    },
                    txtGroupDescs:{
                        required:true
                    }, 
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
                    } 
                    else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
                        error.insertAfter(element.next('span'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
        
        function loaddata(){
            var GroupID = $('#modal').data('groupID');
            if (GroupID > 0) {
                console.log(GroupID)
                $.getJSON("<?php echo base_url('C_group/getByID');?>" + "/" + GroupID, function (data) {
                    $('#txtGroupID').val(data[0].GroupID);
                    $('#txtGroupCD').val(data[0].group_cd);
                    $('#txtGroupDescs').val(data[0].group_descs);
                    $('#dashboard').val(data[0].dashboard_url);
                });
            }
        }

        $('#modal').one('hidden.bs.modal', function (e) {
            $(this).removeData();
        });
    </script>
<!-- js -->