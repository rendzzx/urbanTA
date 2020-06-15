<!-- link -->
    <!DOCTYPE html>
    <html class="loading" lang="en" data-textdirection="ltr">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
            <title>Login</title>
            <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
            <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/logo/logo.png">
            <!-- BEGIN Vendor CSS-->
                <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/vendors.min.css')?>">
            <!-- END: Vendor CSS-->

            <!-- BEGIN: Theme CSS-->
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/bootstrap.css')?>">
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/bootstrap-extended.css')?>">
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/colors.css')?>">
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/components.css')?>">
            <!-- END: Theme CSS-->

            <!-- FONT -->
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/fonts/feather/style.min.css')?>">
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/fonts/line-awesome/css/line-awesome.min.css')?>">
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/fonts/simple-line-icons/style.min.css')?>">
            <!-- FONT -->
            
            <!-- BEGIN: Page CSS-->
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/core/menu/menu-types/horizontal-menu.css')?>">
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/core/colors/palette-gradient.css')?>">
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/core/colors/palette-gradient.css')?>">
                <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/pages/chat-application.css')?>">
            <!-- END: Page CSS-->

                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/js/min/perfect-scrollbar.jquery.min.js"></script>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.6.7/css/perfect-scrollbar.min.css" />

            <!-- BEGIN: Vendor JS-->
                <script type="text/javascript" src="<?= base_url('app-assets/vendors/js/vendors.min.js')?>"></script>
            <!-- BEGIN Vendor JS-->

            <!-- BEGIN: Page Vendor JS-->
                <script type="text/javascript" src="<?= base_url('app-assets/vendors/js/ui/jquery.sticky.js')?>"></script>
            <!-- END: Page Vendor JS-->

            <!-- BEGIN: Theme JS-->
                <script type="text/javascript" src="<?= base_url('app-assets/js/core/app-menu.js')?>"></script>
                <script type="text/javascript" src="<?= base_url('app-assets/js/core/app.js')?>"></script>
            <!-- END: Theme JS-->
            <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/validation/jquery.validate.min.js'); ?>"></script>
            <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.css">
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.js"></script>
        </head>
<!-- link -->

<!-- content -->
    <body class="bg-full-screen-image" data-color="bg-gradient-x-purple-blue">
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="text-center mb-1" style="margin-top: 55px">
                            <img src="app-assets/images/logo/logo-login.png" alt="branding logo" width="200">
                        </div>
                        <div class="text-center">
                            <h2  style="color: #ffffff">Integrated and seamless property <br>sales management software</h2>
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-large-1  text-center" style="color: #ffffff">                       
                            Login
                        </div>
                        <form class="form-horizontal" id="frmEditor" action="<?php echo base_url(); ?>Auth/login" method="post" width="40%">
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="email" class="form-control round"  name="email" id="email" placeholder="Your Email" required>
                                <div class="form-control-position">
                                    <i class="ft-user"></i>
                                </div>
                            </fieldset>
                            
                            <fieldset class="form-group position-relative has-icon-left">
                                <input type="password" class="form-control round" id="password" name="password"  placeholder="Enter Password" required>
                                <div class="form-control-position">
                                    <i class="ft-lock"></i>
                                </div>
                            </fieldset>

                            <div class="form-group" id="divCaptLogin" name="divCaptLogin" alt=" " width="140" height="100" >
                                <div>
                                    <center>
                                        <?php if(!empty($image)){ echo $image;}?>
                                    </center>
                                </div>
                                <br>
                                <input class="form-control round" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter text above" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" id="loginBtn" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">
                                    Login
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#frmEditor').validate({
                ignore: "",
                rules: {
                    password: { 
                        required: true
                    },        
                    email:{
                        required: true,
                        email:true
                    },
                    userCaptcha:{
                        required: true
                    }
                },
                messages: {
                    email: {
                        required: "Email is required",
                        email: "This must be an email"
                    },
                    password: {
                        required: "Password is required"
                    },
                    userCaptcha: {
                        required: "Invalid Captcha"
                    },
                },
                errorElement: "em",
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

            $('#loginBtn').click(function(event){
                event.preventDefault();
                if (event.handled !== true) {
                    event.handled = true;
                    if ($('#frmEditor').valid()) {
                        var datafrm = $('#frmEditor').serializeArray();
                        $.ajax({
                            url : "<?php echo base_url('Auth/login');?>",
                            type:"POST",
                            data: datafrm,
                            dataType:"json",
                            success:function(event, data){
                                if (event.Error == false) {
                                    if (event.Message == 'success') {
                                        window.location.href = '<?= base_url("Administrator/index"); ?>';
                                    }
                                }
                                else{
                                    Swal.fire({
                                        title: "Information",
                                        animation: true,
                                        icon:"error",
                                        text: event.Message,
                                        confirmButtonText: "OK"
                                    });
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                Swal.fire({
                                    title: "Error",
                                    animation: true,
                                    icon:"error",
                                    text: textStatus+' Save : '+errorThrown,
                                    confirmButtonText: "OK"
                                });
                            }
                        });
                    }
                    else{
                    }
                }
            });
        });
    </script>
<!-- js -->