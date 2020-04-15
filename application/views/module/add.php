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
                <input type="hidden" name="rowID" id="rowID" class="form-control">
            </div>
         
            <div class="form-group">
                <label for="GroupCD" >Module Code</label>
                <input type="text" class="form-control" name="module_cd" id="module_cd" placeholder="Module Code">
            </div>
         
            <div class="form-group">
                <label for="GroupDescs" class="control-label">Module Description</label>
                <input type="text" class="form-control" name="module_descs" id="module_descs" placeholder="Module Description">
            </div>
         
            <div class="form-group">
                <label for="group" class="control-label">Module Group Code</label>
                <select data-placeholder="Choose a Module Group Code" class="select2 form-control" id="group" name="group">
                    <option value=""></option>
                    <?php foreach ($group as $key) { ?>
                        <option value="<?php echo $key->group_cd?>"><?php echo $key->group_descs.' ('.$key->group_cd.')' ?></option>
                    <?php }  ?>
                </select>
            </div>
         
            <div class="form-group">
                <label for="GroupDescs" class="control-label">Dashboard URL</label>
                <input type="text" class="form-control" name="dashboard" id="dashboard" placeholder="Dashboard URL">
            </div>
         
            <div class="form-group">
                <label for="GroupDescs" class="control-label">Icon Class</label>
                <input type="text" class="form-control" name="iconclass" id="iconclass" placeholder="Icon Class">
            </div>
         
            <div class="form-group">
                <label for="GroupDescs" class="control-label">Button Color</label>
                <div class="form-group row">
                    <div class="col-6">
                        <div class="i-checks" >
                            <input type="radio" name="buttonclass" id="purple-blue" value="purple-blue" checked> 
                            <label for="purple-blue">
                                <button type="button"  style="width: 130px;margin-top: 10px"  class="btn btn-bg-gradient-x-purple-blue">
                                    Purple blue
                                </button>
                            </label> 
                        </div>

                        <div class="i-checks" >
                            <input type="radio" name="buttonclass" id="purple-red" value="purple-red"> 
                            <label for="purple-red">
                                <button type="button"  style="width: 130px;margin-top: 10px"  class="btn btn-bg-gradient-x-purple-red">
                                    Purple red
                                </button>
                            </label>
                        </div>

                        <div class="i-checks" >
                            <input type="radio" name="buttonclass" id="blue-green" value="blue-green"> 
                            <label for="blue-green">
                                <button type="button"  style="width: 130px;margin-top: 10px"  class="btn btn-bg-gradient-x-blue-green">
                                    Blue green
                                </button>
                            </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="i-checks" >
                            <input type="radio" name="buttonclass" id="orange-yellow" value="orange-yellow"> 
                            <label for="orange-yellow">
                                <button type="button" style="width: 130px;margin-top: 10px;padding-right: 0px;padding-left: 0px;" class="btn btn-bg-gradient-x-orange-yellow">
                                    Orange yellow
                                </button>
                            </label>
                        </div>
                  
                        <div class="i-checks" >
                            <input type="radio" name="buttonclass" id="blue-cyan" value="blue-cyan"> 
                            <label for="blue-cyan">
                                <button type="button" style="width: 130px;margin-top: 10px" class="btn btn-bg-gradient-x-blue-cyan">
                                    Blue cyan
                                </button>
                            </label> 
                        </div>

                        <div class="i-checks" >
                            <input type="radio" name="buttonclass" id="red-pink" value="red-pink"> 
                            <label for="red-pink">
                                <button type="button"  style="width: 130px;margin-top: 10px"  class="btn btn-bg-gradient-x-red-pink">
                                    Red pink
                                </button>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="GroupDescs" class="control-label">Status</label>
                <div class="form-group row">
                    <div class="col-12">
                        <div class="i-checks" style="margin: 5px;">
                            <input type="radio" name="status" id="status-1" value="1" checked> 
                            <label for="status-1">Active</label> &nbsp;&nbsp;
                            <input type="radio" name="status" id="status-0" value="0"> 
                            <label for="status-0">Inactive</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="GroupDescs" class="control-label">Order Sequence</label>
                <input type="text" class="form-control" name="orderseq" id="orderseq" placeholder="Order Sequence">
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
                            url : "<?php echo base_url('C_module/save');?>",
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
                                    tblmodule.ajax.reload(null,true);
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
                    }
                    else {
                        error.insertAfter(element);
                    }
                }
            });
        });

        function loaddata(){
            var rowID = $('#modal').data('rowID');
            $('#rowID').val(rowID);

            if (rowID > 0) {
                $.getJSON("<?php echo base_url('C_module/getByID');?>" + "/" + rowID, function (data) {
                    // console.log(data);
                    $('#module_cd').val(data[0].module_cd);
                    $('#group').val(data[0].module_group_cd).trigger('change');
                    $('#module_descs').val(data[0].module_descs);
                    $('#dashboard').val(data[0].dashboard_url);
                    $('#iconclass').val(data[0].IconClass);
                    // console.log(data[0].ButtonClass);
                    if(data[0].ButtonClass!==null||data[0].ButtonClass!==''){
                        $('#'+data[0].ButtonClass).iCheck('check');
                    }
                    if(data[0].status!==null||data[0].status!==''){
                        $('#status-'+data[0].status).iCheck('check');
                    }
                    $('#orderseq').val(data[0].OrderSeq);
                });
            }
        }

        $('#modal').one('hidden.bs.modal', function (e) {
            $(this).removeData();
        });
    </script>
<!-- js -->