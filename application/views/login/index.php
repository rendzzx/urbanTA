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

            <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
            <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

            <link href="<?=base_url('app-assets/css/bootstrap.min.css')?>" rel="stylesheet">
            <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/vendors.css')?>">
            <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/app.css')?>">

            <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/colors/palette-gradient.css')?>">
            <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/pages/login-register.css')?>">
            <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css')?>">

            <script src="<?=base_url('app-assets/js/ShowPCx.js')?>" type="text/javascript"></script>
            <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
            <script src="<?=base_url('app-assets/js/core/app-menu.js')?>" type="text/javascript"></script>
            <script src="<?=base_url('app-assets/js/core/app.js')?>" type="text/javascript"></script>
            <script src="<?=base_url('app-assets/js/jquery-2.1.1.js')?>"></script>
            <script src="<?=base_url('app-assets/js/bootstrap.min.js')?>"></script>
            <script src="<?=base_url('app-assets/js/jquery.validate.min.js'); ?>" type="text/javascript"></script>

            <style id="antiClickjack" type="text/css">
                body {
                    overflow:hidden;
                    display:none !important;
                }
                #background-box{
                    background-image: url('app-assets/images/backgrounds/bg-18_c.jpg');
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: cover;
                    position: relative;
                }
                hr{ 
                    border: none;
                    border-left: 1px solid #ffffff;
                    height: auto;
                    width: 1px; 
                    margin-left: 0px; 
                    margin-right: 0px;  
                }
                #inner {
                    display: table;
                    margin: 0 auto;
                }
            </style>
            <script type="text/javascript">
                if (self === top) { 
                    var antiClickjack = document.getElementById("antiClickjack");
                    antiClickjack.parentNode.removeChild(antiClickjack);
                } 
                else {
                    top.location = self.location;
                }
            </script>
        </head>
<!-- link -->

<!-- content -->
    <body class="vertical-layout vertical-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-color="bg-gradient-x-purple-blue" data-col="1-column">
        <div class="app-content content" id="my">
            <div class="content-wrapper">
                <div class="content-wrapper-before"></div>
                <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-sm-10 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-1 py-1 m-0" id="background-box" style="padding: 0 !important;">
                                <div style="background-color: #00000061; " class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                    <div class="col-md-12 col-10" style="z-index: 2; margin-top: 25px;margin-bottom: 25px;">
                                        <div class="col-md-6 col-10">
                                            <div class="card-header border-0" style="background-color: transparent;">
                                                <div class="text-center mb-1" style="margin-top: 55px">
                                                    <img src="app-assets/images/logo/logo-login.png" alt="branding logo" width="200">
                                                </div>
                                                <div class="text-center">
                                                    <h2  style="color: #ffffff">Integrated and seamless property <br>sales management software</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-10">
                                            <div class="card-content">
                                                <div class="font-large-1  text-center" style="color: #ffffff">                       
                                                    Login
                                                </div>
                                                <?php echo validation_errors(); ?>
                                                <div class="card-body" style="width: 70%" id="inner">
                                                    <form class="form-horizontal" id="frm1" action="<?php echo base_url(); ?>Auth/login" method="post" width="40%">
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="email" class="form-control round"  name="txtUser" id="txtUser" placeholder="Your Email" required>
                                                            <div class="form-control-position">
                                                                <i class="ft-user"></i>
                                                            </div>
                                                        </fieldset>
                                                        
                                                        <fieldset class="form-group position-relative has-icon-left">
                                                            <input type="password" class="form-control round" id="txtPass" name="txtPass"  placeholder="Enter Password" required>
                                                            <div class="form-control-position">
                                                                <i class="ft-lock"></i>
                                                            </div>
                                                        </fieldset>

                                                        <label for="showpasscheckbox-523" class="show-password" title="Show the password as plain text (not advisable in a public place)" style="display:block;position:static;">
                                                        </label>

                                                        <div class="form-group row">
                                                            <div class="col-md-12 col-12 float-sm-left text-center text-sm-right">
                                                                <a href="#" onclick="fn_confirm();" class="card-link" style="color: #ffffff">
                                                                    Forgot Password?
                                                                </a>
                                                            </div>
                                                        </div> 

                                                        <div id="error_msg">
                                                            <center>
                                                                <h4 style="color: red;">
                                                                    <?php echo $error_login;?>                  
                                                                </h4>
                                                            </center>
                                                        </div>

                                                        <div class="form-group" id="divCaptLogin" name="divCaptLogin" alt=" " width="140" height="100" >
                                                            <div>
                                                                <center>
                                                                    <?php if(!empty($image)){ echo $image;}?> 
                                                                    <!-- <button type="button" class="btn btn-info pull-right" onclick="reload_captcha();" style="margin-top:0px; margin-right: 10px;">
                                                                        <i class="ft-refresh-ccw"></i>
                                                                    </button> -->
                                                                </center>
                                                            </div>
                                                            <br>
                                                            <input class="form-control round" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter text above" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/>
                                                        </div>

                                                        <div class="form-group text-center">
                                                            <button type="submit" class="btn round btn-block btn-glow btn-bg-gradient-x-purple-blue col-12 mr-1 mb-1">
                                                                Login
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                </section>
            </div>
        </div>

    </body>
    </html>
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        var ss = '<?php echo $error_login;?>';
        if(ss.length>0){
            $('#error_msg').show();  
        }
        else{
            $('#error_msg').hide();
        }

        new ShowPCx(document.getElementById("txtPass"));

        var frm = document.forms['frm1'];
        if(!frm){
            frm = document.frm1;
        }

        function fn_confirm(){
            window.location.href  = "<?php echo base_url('ResetPassword');?>";
        }

        $(document).ready(function () {
            $('#frm1').validate({
                ignore: "",
                rules: {
                    password: { 
                        required: true
                    },        
                    txtUser:{
                        required: true,
                        email:true
                    },
                    userCaptcha:{
                        required: true
                    }
                },
                messages: {
                    userCaptcha: {checkCapt: "Invalid Captcha"},
                    txtUser: {checkUserPass: "Invalid txtUser and Password"},
                    password: {checkUserPass: "Invalid txtUser and Password"}
                },
                errorElement: "em",
                errorPlacement: function(error, element){
                    error.addClass("help-block");
                    element.parents(".col-xs-5").addClass("has-feedback  text-red");
                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.parent("label"));
                    } 
                    else {
                        error.insertAfter(element);
                    }
                },
                success: function(label, element){
                },
                highlight: function(element, errorClass, validClass){
                },
                unhighlight: function(element, errorClass, validClass){
                }
            });

        });
    </script>
<!-- js -->