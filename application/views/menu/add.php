<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">

    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/validation/jquery.validate.min.js'); ?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>"></script>

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
                <input type="hidden" name="txtMenuID" id="txtMenuID" class="form-control">
            </div>
            
            <div class="form-group">
                <label for="Title" class="col-xs-8">Title</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtTitle" id="txtTitle" placeholder="Title">
                </div>
            </div>

            <div class="form-group">
                <label for="Descs" class="col-xs-8">Description</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtDescs" id="txtDescs" placeholder="Descs">
                </div>
            </div>
            
            <div class="form-group">
                <label for="URL" class="col-xs-8 control-label">URL</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtURL" id="txtURL" placeholder="URL">
                </div>
            </div>
            
            <div class="form-group">
                <label for="project_name" class="col-xs-8">Parent ID</label>
                <div class="col-xs-8">
                    <select name="txtParentID" id="txtParentID" data-placeholder="Choose a Parent Menu..." class="select2 form-control" >
                        <option value=""></option> 
                        <?php foreach ($menuData as $row) { ?>
                            <option value="<?= $row->MenuID ?>"><?= $row->Title.' - '. $row->descs ?></option>;
                        <?php } ?> 
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="IconClass" class="col-xs-8">Icon Class</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtIconClass" id="txtIconClass" placeholder="Icon Class">
                </div>
            </div>
            
            <div class="form-group">
                <label for="OrderSeq" class="col-xs-8">Order Sequence</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtOrderSeq" id="txtOrderSeq" placeholder="Order Sequence">
                </div>
            </div>
        </div>
    </form>
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        $(document).ready(function () {
            loaddata();
         
            $('.i-checks').iCheck({
                radioClass: 'iradio_square-purple',
                checkboxClass: 'icheckbox_flat-purple'
            });

            $('.select2').select2({width:'100%'});

            $('#savefrm').click(function(event){
                event.preventDefault();
                if (event.handled !== true) {
                    event.handled = true;
                    if ($('#frmEditor').valid()) {
                        block(true);
                        var id = $('#modal').data('rowID');
                        var datafrm = $('#frmEditor').serializeArray();
                        // console.log(datafrm);
                        $.ajax({
                            url : "<?php echo base_url('C_menu/save');?>",
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
                                    tblmenu.ajax.reload(null,true);
                                }
                                else{
                                    swal({
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
                                swal({
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
                    txtTitle: {
                        required: true
                    },
                    txtDescs: {
                        required: true
                    },
                    txtIconClass:{
                        required:true
                    },
                    txtOrderSeq:{
                        required:true,
                        number:true
                    }
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
                    } 
                    else {
                        error.insertAfter(element);
                    }
                }
            });
        });

        function loaddata(){
            var MenuID = $('#modal').data('menuID');
            if (MenuID > 0) {
                $.getJSON("<?php echo base_url('C_menu/getByID');?>" + "/" + MenuID, function (data) {
                    $('#txtMenuID').val(data[0].MenuID);
                    $('#txtTitle').val(data[0].Title);
                    $('#txtDescs').val(data[0].descs);
                    $('#txtURL').val(data[0].URL);
                    $("#txtParentID").val(data[0].ParentMenuID).trigger('change');
                    $('#txtIconClass').val(data[0].IconClass);
                    $('#txtOrderSeq').val(data[0].OrderSeq);
                });
            }
        }

        $('#modal').one('hidden.bs.modal', function (e) {
            $(this).removeData();
        });
    </script>
<!-- js -->