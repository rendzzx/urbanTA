<!-- link -->
    <head> 
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  
        <link rel="icon" type="image/gif/png" href="<?=base_url('app-assets/images/logoweb/favicon.ico')?>">
        <title>IFCA</title>
        <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
        <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('app-assets/images/logo/icon_ifca.png')?>">
        <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
        <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">

        <!-- BEGIN Vendor CSS-->
            <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/vendors.min.css')?>">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
            <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/bootstrap.css')?>">
            <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/bootstrap-extended.css')?>">
            <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/colors.css')?>">
            <link rel="stylesheet" type="text/css" href="<?= base_url('app-assets/css/components.css')?>">
        <!-- END: Theme CSS-->

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
            <script type="text/javascript" src="<?= base_url('app-assets/js/core/libraries/jquery.min.js')?>"></script>
            <script type="text/javascript" src="<?= base_url('app-assets/js/core/libraries/bootstrap.min.js')?>"></script>
        <!-- BEGIN Vendor JS-->

        <!-- BEGIN: Page Vendor JS-->
            <script type="text/javascript" src="<?= base_url('app-assets/vendors/js/ui/jquery.sticky.js')?>"></script>
        <!-- END: Page Vendor JS-->

        <!-- BEGIN: Theme JS-->
            <script type="text/javascript" src="<?= base_url('app-assets/js/core/app-menu.js')?>"></script>
            <script type="text/javascript" src="<?= base_url('app-assets/js/core/app.js')?>"></script>
        <!-- END: Theme JS-->
    </head>
    <style type="text/css" rel="stylesheet">
        #floating-button{
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: #db4437;
            position: fixed;
            bottom: 50px;
            right: 30px;
            cursor: pointer;
            box-shadow: 0px 2px 5px #666;
        }
        .plus{
            color: white;
            position: absolute;
            top: 0;
            display: block;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 0;
            margin: 0;
            line-height: 55px;
            font-size: 38px;
            font-family: 'Roboto';
            font-weight: 300;
            animation: plus-out 0.3s;
            transition: all 0.3s;
        }
        #container-floating{
            position: fixed;
            width: 70px;
            height: 70px;
            bottom: 30px;
            right: 30px;
            z-index: 50px;
        }
        #container-floating:hover{
            height: 400px;
            width: 90px;
            padding: 30px;
        }
        #container-floating:hover .plus{
            animation: plus-in 0.15s linear;
            animation-fill-mode: forwards;
        }
        .edit{
            position: absolute;
            top: 0;
            display: block;
            bottom: 0;
            left: 0;
            display: block;
            right: 0;
            padding: 0;
            opacity: 0;
            margin: auto;
            line-height: 65px;
            transform: rotateZ(-70deg);
            transition: all 0.3s;
            animation: edit-out 0.3s;
        }
        #container-floating:hover .edit{
            animation: edit-in 0.2s;
            animation-delay: 0.1s;
            animation-fill-mode: forwards;
        }
        @keyframes edit-in{
            from {opacity: 0; transform: rotateZ(-70deg);}
            to {opacity: 1; transform: rotateZ(0deg);}
        }
        @keyframes edit-out{
            from {opacity: 1; transform: rotateZ(0deg);}
            to {opacity: 0; transform: rotateZ(-70deg);}
        }
        @keyframes plus-in{
            from {opacity: 1; transform: rotateZ(0deg);}
            to {opacity: 0; transform: rotateZ(180deg);}
        }
        @keyframes plus-out{
            from {opacity: 0; transform: rotateZ(180deg);}
            to {opacity: 1; transform: rotateZ(0deg);}
        }
        .horizontal-menu .navbar-horizontal .nav-item a span{
            font-size: 12px;
        }
        li.nav-item.d-none.d-md-block{
            z-index: 1 !important;
        }
    </style>

    <script type="text/javascript">
        window.history.forward();
        function noBack(){
            window.history.forward(1);
        }

        function profile(){
            var data = '<?php echo $this->session->userdata("Tsuname");?>';
            $('#modaldialog').addClass('modal-lg');
            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit Profile');
            $('#modalbody').load("<?php echo base_url("c_profile/profile");?>");
            $('#modal').data('Id', data);
            $('#modal').modal('show');
            $('.modal-footer').hide();
        }
    </script>
<!-- link -->

<!-- content -->
    <body class="horizontal-layout horizontal-menu 2-columns menu-expanded" data-open="hover" data-menu="horizontal-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns" onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="" oncontextmenu="return false;">

        <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper">
            <div class="navbar-container main-menu-content" data-menu="menu-container">
                <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=base_url('dash/index');?>">
                            <i class="ft-home"></i>
                            <span style="font-size: 12px !important"></span>
                        </a>
                    </li>
            
                    <li class="dropdown nav-item" data-menu="dropdown">
                        <a class=" nav-link" href="#" >
                            <h4>
                                Welcome, <?php echo ucwords($this->session->userdata("Tsname"));?>
                            </h4>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- MODAL -->
        <div class="modal fade text-left" id="modal" tabindex="-1" role="dialog" aria-labelledby="modaltitle" aria-hidden="true">
            <div class="modal-dialog" role="document" id="modaldialog">
                <div class="modal-content">
                    <div class="modal-header" id="modalheader">
                        <h4 class="modal-title" id="modaltitle">Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modalbody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="savefrm">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL -->
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        function loaddata(){
            $.getJSON("<?php echo base_url('c_profile/fotopict');?>", function (data) {
                $('#image').val(data[0].pict);
                console.log(data[0].pict);
                var url = data[0].pict;
                if(url == "" || url == null){
                }
                else{
                    var filename = url.substring(url.lastIndexOf('/')+1);
                    $('#labelimage').text(filename);
                    $('#picturebox').attr("src",url);
                }
            });
        }

        function readURL(input) {
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#picturebox").attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<!-- js -->