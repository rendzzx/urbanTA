<!-- link -->
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
        <div class="nav-vertical p-2">
            <ul class="nav nav-tabs nav-left flex-column pt-5">
                <li class="nav-item">
                    <a class="nav-link active"  data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Employee</a>
                </li>
                <li class="nav-item" id="tab3btn">
                    <a class="nav-link" data-toggle="tab" aria-controls="tab3" href="#tab3" aria-expanded='false'>Change Password</a>
                </li>
            </ul>

            <div class="tab-content px-1">

                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="tab1">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="userid" class="col-xs-8">User ID</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="userid" id="userid" placeholder="User ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-xs-8 control-label">E-mail</label>
                            <div class="col-xs-8">
                                <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="group" class="col-xs-8 control-label">Group</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="group" id="group" placeholder="Group">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="agent" class="col-xs-8 control-label">Agent</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="agent" id="agent" placeholder="Agent Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="debtor" class="col-xs-8 control-label">Debtor</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="debtor" id="debtor" placeholder="Debtor Account">
                            </div>
                        </div>
                    </div>   
                </div>

                <div role="tabpanel" class="tab-pane" id="tab2" aria-expanded="true" aria-labelledby="tab2">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="employeeid" class="col-xs-8">Employee ID</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="employeeid" id="employeeid" placeholder="Employee ID">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-xs-8 control-label">Name</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Full Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-xs-8 control-label">Address</label>
                            <div class="col-xs-8">
                                <textarea type="text" class="form-control" name="address" id="address" placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-xs-8">Gender</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="gender" id="gender" placeholder="Gender">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="handphone" class="col-xs-8">Handphone</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="handphone" id="handphone" placeholder="No Handphone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-xs-8">NIK</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="nik" id="nik" placeholder="National Id Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="npwp" class="col-xs-8">NPWP</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Tax Number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="bankacc" class="col-xs-8">Mandiri Account</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="bankacc" id="bankacc" placeholder="Mandiri">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="division" class="col-xs-8">Division</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="division" id="division" placeholder="Division">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="postiton" class="col-xs-8">Postition</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="postiton" id="postiton" placeholder="Postition">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="salary" class="col-xs-8">Salary</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="salary" id="salary" placeholder="Base Salary">
                            </div>
                        </div>
                    </div>   
                </div>

                <div role="tabpanel" class="tab-pane" id="tab3" aria-expanded="true" aria-lebelledby="tab3">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="password" class="col-xs-8 control-label">Password</label>
                            <div class="col-xs-8">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password2" class="col-xs-8 control-label">Password</label>
                            <div class="col-xs-8">
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Confrim Password">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        var menuid = $('#modal').data('MenuID');
        
        $(document).ready(function () {
            loaddata();
            $('#savefrm').click(function(event){
                event.preventDefault();
                if (event.handled !== true) {
                    event.handled = true;
                    if ($('#frmEditor').valid()) {
                        block(true);
                        var datafrm = $('#frmEditor').serializeArray();
                        $.ajax({
                            url : "<?php echo base_url('C_user/save');?>",
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
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
        
        function loaddata(){
            var id = $('#modal').data('id');
            if (id) {
                // console.log(id)
                $.getJSON("<?php echo base_url('C_user/getByID');?>" + "/" + id, function (data) {
                    // user
                        $('#userid').val(data[0].userID);
                        $('#userid').attr('disabled', 'true');
                        $('#email').val(data[0].email);
                        // $('#password').val(data[0].password);
                        // $('#password2').val(data[0].password);
                        $('#group').val(data[0].Group_Cd);
                        $('#agent').val(data[0].agent_cd);
                        $('#debtor').val(data[0].debtor_acct);
                    //employee
                        $('#employeeid').val(data[0].employee_id);
                        $('#name').val(data[0].name);
                        $('#address').val(data[0].address);
                        $('#gender').val(data[0].gender);
                        $('#handphone').val(data[0].handphone);
                        $('#nik').val(data[0].nik);
                        $('#npwp').val(data[0].npwp);
                        $('#bankacc').val(data[0].bank_acct);
                        $('#division').val(data[0].division_name);
                        $('#postiton').val(data[0].postition_name);
                        $('#salary').val(data[0].base_salary);

                });
            }
            else{
                $('#tab3').attr('hidden', 'true');
                $('#tab3btn').attr('hidden', 'true');
            }
        }

        $('#modal').one('hidden.bs.modal', function (e) {
            $(this).removeData();
        });
    </script>
<!-- js