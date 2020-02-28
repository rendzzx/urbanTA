<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>IFCA Demo</title>
    <link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Animation CSS -->
    <link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
    <link href="<?=base_url('font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?=base_url('css/style.css')?>" rel="stylesheet">
    <style type="text/css">
    
        a.snapchat {
          position: relative;
          color: #676a6c;
            font-family: 'Open Sans', helvetica, arial, sans-serif;
            font-weight: 700;
        }
/*
        a.snapchat img {
          position: absolute !important;
          opacity: 0;
          left: 0;
          top: -20px;
          position: relative;
          transition: opacity .5s, top .5s;
        }*/
        a.snapchat:hover{
            color: #1ab394;
        }
  /*      a.snapchat:hover img {
          opacity: 1;
          top: 30px;
          
          left:1;
        }
*/
     
    </style>
</head>
<body id="page-top" class="landing-page">
<div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="page-scroll" href="#page-top">Home</a></li>
                        
                        <!-- <li><a class="page-scroll" target="_blank" href="http://112.78.150.230:88/webproperty2.0/userStaff">Login</a></li>

                        <li><a class="page-scroll" target="_blank" href="http://112.78.150.230:88/webproperty2.0/agent">Agent Registration</a></li>

                        <li><a class="page-scroll" target="_blank" href="http://112.78.150.230:88/webproperty2.0/nup_demo">NUP Online</a></li> -->

                        <li><a class="page-scroll" target="_blank" href="<?=base_url('userStaff')?>">Login</a></li>                        

                        <li><a class="page-scroll" target="_blank" href="<?=base_url('agent')?>">Agent Registration</a></li>

                        <li><a class="page-scroll" target="_blank" href="<?=base_url('nup_demo')?>">NUP Online</a></li>
                     
                       
                    </ul>
                </div>
            </div>
        </nav>
</div>
<div id="inSlider" class="carousel carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#inSlider" data-slide-to="0" class="active"></li>
        <li data-target="#inSlider" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <div class="container">
                <div class="carousel-caption">
                <br/>
                 <br/>
                    <h1>We craft web apps<br/> and user interfaces<br/>
                        </h1>
                    
                </div>
                <div class="carousel-image wow zoomIn">
                    <img src="img/landing/laptop.png" alt="laptop"/>
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back one"></div>

        </div>
        <div class="item">
            <div class="container">
                <div class="carousel-caption blank">
                    <h1>We create meaningful <br/> interfaces that inspire.</h1>
                    
                   
                </div>
            </div>
            <!-- Set background for slide in css -->
            <div class="header-back two"></div>
        </div>
    </div>
    <a class="left carousel-control" href="#inSlider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#inSlider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
 <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content" >
            <!-- Modal Header -->
            <div class="modal-header" style="background:#e5e5e5;">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle" style="font-size:18px"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" >
            </div>
            <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-dor" style="width: 100%; height: 40px; padding: 0;font-size: 14px"> <b>SEND MESSAGE</b> </button>
            
            </div>
        </div>

    </div>
</div>
<section id="contact" class="gray-section contact">
    <div class="container">
        <div class="row m-b-lg">
            <div class="col-lg-12 text-center">
                <div class="navy-line"></div>
                <h1><a onclick="contactmeh()" class="snapchat">Contact Us
                   <br><div id="imghover" style="display: none"><img alt="" id="" src="<?=base_url('img/clickme1.png')?>" width="170px" style="margin-left:90px;margin-top: 5px"/></div>
                </a>

                </h1>
                
            </div>
        </div>
        <div class="row m-b-lg">
            <div class="col-lg-3 col-lg-offset-3">
                <address>
                    <strong><span class="navy">PT IFCA Property365 Indonesia</span></strong><br/>
                    Jl. Sultan Agung No. 58 A-B<br/>
                    Jakarta 12970, Indonesia<br/>
                    <!-- <abbr title="Phone">Telp:</abbr> (62-21) 828 2455<br>
                    <abbr title="Fax">Fax:</abbr> (62-21) 828 2460<br>
                    <abbr title="Email">Email:</abbr> ifca@ifca.co.id<br>
                    <abbr title="Web">Telp:</abbr> www.ifca.co.id<br> -->
                </address>
            </div>
            <div class="col-lg-4">
                <p class="text-color">
                    <address>
                <!--     <strong><span class="navy">PT IFCA365 Indonesia</span></strong><br/>
                    Jl. Sultan Agung No. 58 A-B<br/>
                    Jakarta 12970, Indonesia<br/> -->
                    <abbr title="Phone">Telp:</abbr> (62-21) 828 2455<br>
                    <abbr title="Fax">Fax:</abbr> (62-21) 828 2460<br>
                    <abbr title="Email">Email:</abbr> ifca@ifca.co.id<br>
                  
                </address>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center m-t-lg m-b-lg">
                <p><strong>&copy; 2017 IFCA</strong><br/></p>
            </div>
        </div>
    </div>

</section>

<!-- Mainly scripts -->
<script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
<script src="<?=base_url('js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
<script src="<?=base_url('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>

<!-- Custom and plugin javascript -->
<script src="<?=base_url('js/inspinia.js')?>"></script>
<script src="<?=base_url('js/plugins/pace/pace.min.js')?>"></script>
<script src="<?=base_url('js/plugins/wow/wow.min.js')?>"></script>


<script>

 function contactmeh(){

             var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                        }
                        // $('.imagepop').attr('src', _src);
                        // $('div.modal-body').html('wkkw');
                        $('#modalTitle').html('<div style="font-size:12px;"><img src="<?=base_url('img/logo.png')?>" style="margin-left:5px;margin-right:40px;float:left">If you have any questions, please use the form below to leave<br> us your questions. We will reply you as soon <br>as possible. Thank you!</div>');
                        $('div.modal-body').load("<?php echo base_url("demo/contact");?>");
                        $('div.modal-body').append('<div class="modal-footer"></div>');
                        $('#modal').modal('show');
        }


        $(window).scroll(function(){
            // console.log($(this).scrollTop());
            console.log($(this));
    if ($(this).scrollTop() > 150 ) {
        // header.fadeTo("slow", 0);
        // op = 0;
        $('#imghover').show();
    } else {
        if ($(this).scrollTop() <= 150 ) {
            // header.fadeTo("slow", 1);
            // op = 1;  
            $('#imghover').hide();            
        }
    }
});
    $(document).ready(function () {
       
       
        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 80
        });

        // Page scrolling feature
        $('a.page-scroll').bind('click', function(event) {
            var link = $(this);
            $('html, body').stop().animate({
                scrollTop: $(link.attr('href')).offset().top - 50
            }, 500);
            event.preventDefault();
            $("#navbar").collapse('hide');
        });
    });

    var cbpAnimatedHeader = (function() {
        var docElem = document.documentElement,
                header = document.querySelector( '.navbar-default' ),
                didScroll = false,
                changeHeaderOn = 200;
        function init() {
            window.addEventListener( 'scroll', function( event ) {
                if( !didScroll ) {
                    didScroll = true;
                    setTimeout( scrollPage, 250 );
                }
            }, false );
        }
        function scrollPage() {
            var sy = scrollY();
            if ( sy >= changeHeaderOn ) {
                $(header).addClass('navbar-scroll')
            }
            else {
                $(header).removeClass('navbar-scroll')
            }
            didScroll = false;
        }
        function scrollY() {
            return window.pageYOffset || docElem.scrollTop;
        }
        init();

    })();

    // Activate WOW.js plugin for animation on scrol
    new WOW().init();

</script>

</body>
</html>
