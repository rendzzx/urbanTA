<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>IFCA <?php echo $this->session->userdata('appsname'); ?></title>
    <link rel="apple-touch-icon" href="<?=base_url('app-assets/images/logo/icon_ifca.png')?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?=base_url('app-assets/images/logo/icon_ifca.png')?>">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/vendors.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/charts/chartist.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/charts/chartist-plugin-tooltip.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/file-uploaders/dropzone.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/timeline/vertical-timeline.css')?>">
    <!-- END VENDOR CSS-->
    <!-- BEGIN CHAMELEON  CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/app.css')?>">
    <!-- END CHAMELEON  CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/menu/menu-types/horizontal-menu.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/colors/palette-gradient.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/colors/palette-gradient.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/pages/timeline.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/file-uploaders/dropzone.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/pages/dashboard-ecommerce.css')?>">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css')?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/slider.css')?>"> -->
    <!-- END Custom CSS-->

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
    // $("#chat").click(function(){
    //   alert('test')
    // })
    window.history.forward();
    function noBack() { window.history.forward(1); }
    function goNewWin(){
      var a = "<?php echo base_url('dash/index')?>";
      window.open(a,'windowName','toolbar=no,location=1,directories=1,status=1,menubar=1,scrollbars=1,resizable=1');
      window.history.forward(); 
    }
    function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }

  function FormatDateNew(data){
    if (data==null || data=='') {
      return 'Not Set'
    }
    var date = new Date(data.replace(/\s/, 'T'));
    var dd = date.getDate();
    var mm = date.getMonth() + 1
    var yyyy = date.getFullYear();
    var h = date.getHours();
    var m = date.getMinutes();
    if (dd < 10) {
      dd = '0' + dd;
    } 
    if (mm < 10) {
      mm = '0' + mm;
    }
    if (h < 10) {
      h = '0' + h;
    } 
    if (m < 10) {
      m = '0' + m;
    } 

    var newdate = dd + '/' + mm + '/' + yyyy ;

    return newdate
  }
  function FormatDateTimeNew(data){
    if (data==null || data=='') {
      return 'Not Set'
    }
    var date = new Date(data.replace(/\s/, 'T'));
    var dd = date.getDate();
    var mm = date.getMonth() + 1
    var yyyy = date.getFullYear();
    var h = date.getHours();
    var m = date.getMinutes();
    if (dd < 10) {
      dd = '0' + dd;
    } 
    if (mm < 10) {
      mm = '0' + mm;
    }
    if (h < 10) {
      h = '0' + h;
    } 
    if (m < 10) {
      m = '0' + m;
    } 

    var newdate = dd + '/' + mm + '/' + yyyy + ' ' + h + ':' + m;

    return newdate
  }
      function profile(){
        // alert('a');
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
  <body class="horizontal-layout horizontal-menu 2-columns   menu-expanded" data-open="hover" data-menu="horizontal-menu" data-color="bg-gradient-x-purple-blue" data-col="2-columns" onload="noBack();" onpageshow="if (event.persisted) noBack();">

    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow navbar-static-top navbar-light navbar-brand-center">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item" >
            <!-- <a class="navbar-brand" href="<?php echo base_url().$this->session->userdata('urlmodule');?>" ><img class="brand-logo" alt="ifca logo" src="<?=base_url('app-assets/images/logo/logo.png')?>"  <?php echo $this->session->userdata('margin'); ?> > -->
              <!-- <h3 class="brand-text">IFCA <?php echo $this->session->userdata('appsname'); ?></h3> -->
              </a></li>
          <li class="nav-item d-md-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a></li>
        </ul>
      </div>
      <div class="navbar-wrapper" >
        <div class="navbar-container content">
          <div class="collapse navbar-collapse" id="navbar-mobile">
            <ul class="nav navbar-nav mr-auto float-left">
              <li class="nav-item d-none d-md-block" style="z-index: 1 !important;">
                <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                  <i class="ft-menu"></i>
                </a>
              </li>
              <!-- <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li> -->
           <!--    <li class="dropdown nav-item mega-dropdown d-none d-md-block"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">Mega</a>
                <ul class="mega-dropdown-menu dropdown-menu row">
                  <li class="col-md-2">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-link"></i> Quick Links</h6>
                    <ul>
                      <li><a class="my-1" href="index.html"><i class="ft-home mr-1"></i> Dashboard</a></li>
                      <li><a class="my-1" href="email-application.html"><i class="ft-layers mr-1"></i> Email Application</a></li>
                      <li><a class="my-1" href="chat-application.html"><i class="ft-message-square mr-1"></i> Chat Application</a></li>
                      <li><a class="my-1" href="form-wizard.html"><i class="ft-edit mr-1"></i> Form Wizard</a></li>
                      <li><a class="my-1" href="table-bootstrap.html"><i class="ft-grid mr-1"></i> Tables</a></li>
                      <li><a class="my-1" href="chartist-charts.html"><i class="ft-bar-chart mr-1"></i> Chartist</a></li>
                      <li><a class="my-1" href="gallery-grid.html"><i class="ft-sidebar mr-1"></i> Gallery Page</a></li>
                    </ul>
                  </li>
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-star"></i> My Bookmarks</h6>
                    <ul class="ml-2">
                      <li class="list-style-circle"><a class="my-1" href="card-advanced.html">
                                                Advanced Cards</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-content-detached-left-sidebar.html">
                                                Left sidebar</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-content-detached-left-sticky-sidebar.html">
                                                Sticky left sidebar</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-content-detached-right-sidebar.html">
                                                Right sidebar</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-content-detached-right-sticky-sidebar.html">
                                                Sticky right sidebar</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-fixed-navbar-navigation.html">
                                                Fixed Navbar & Navigation</a></li>
                      <li class="list-style-circle"><a class="my-1" href="layout-fixed-navbar-footer.html">
                                                Fixed Navbar & Footer                  </a></li>
                    </ul>
                  </li>
                  <li class="col-md-3">
                    <h6 class="dropdown-menu-header text-uppercase"><i class="ft-layers"></i> Recent Products</h6>
                    <div class="carousel slide pt-1" id="carousel-example" data-ride="carousel">
                      <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"><img class="d-block w-100" src="<?=base_url('app-assets/images/carousel/08.jpg');?>" alt="First slide"></div>
                        <div class="carousel-item"><img class="d-block w-100" src="<?=base_url('app-assets/images/carousel/03.jpg');?>" alt="Second slide"></div>
                        <div class="carousel-item"><img class="d-block w-100" src="<?=base_url('app-assets/images/carousel/01.jpg');?>" alt="Third slide"></div>
                      </div><a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev"><span class="la la-angle-left" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next"><span class="la la-angle-right icon-next" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                      <h5 class="pt-1">Special title treatment</h5>
                      <p>Jelly beans sugar plum.</p>
                    </div>
                  </li>
                  <li class="col-md-4">
                    <h6 class="dropdown-menu-header text-uppercase mb-1"><i class="ft-thumbs-up"></i> Get in touch</h6>
                    <form class="form form-horizontal pt-1">
                      <div class="form-body">
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="inputName1">Name</label>
                          <div class="col-sm-9">
                            <div class="position-relative has-icon-left">
                              <input class="form-control" id="inputName1" type="text" placeholder="John Doe">
                              <div class="form-control-position pl-1"><i class="ft-user"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="inputContact1">Contact</label>
                          <div class="col-sm-9">
                            <div class="position-relative has-icon-left">
                              <input class="form-control" id="inputContact1" type="text" placeholder="(123)-456-7890">
                              <div class="form-control-position pl-1"><i class="ft-smartphone"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="inputEmail1">Email</label>
                          <div class="col-sm-9">
                            <div class="position-relative has-icon-left">
                              <input class="form-control" id="inputEmail1" type="email" placeholder="john@example.com">
                              <div class="form-control-position pl-1"><i class="ft-mail"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-3 form-control-label" for="inputMessage1">Message</label>
                          <div class="col-sm-9">
                            <div class="position-relative has-icon-left">
                              <textarea class="form-control" id="inputMessage1" rows="2" placeholder="Simple Textarea"></textarea>
                              <div class="form-control-position pl-1"><i class="ft-message-circle"></i></div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 mb-1">
                            <button class="btn btn-danger float-right" type="button"><i class="ft-arrow-right"></i> Submit</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </li>
                </ul>
              </li>
              <li class="dropdown d-none d-md-block mr-1"><a class="dropdown-toggle nav-link" id="apps-navbar-links" href="#" data-toggle="dropdown">
                                 Apps</a>
                <div class="dropdown-menu">
                  <div class="arrow_box"><a class="dropdown-item" href="email-application.html"><i class="ft-user"></i> Email</a><a class="dropdown-item" href="chat-application.html"><i class="ft-mail"></i> Chat</a><a class="dropdown-item" href="project-summary.html"><i class="ft-briefcase"></i> Project Summary            </a><a class="dropdown-item" href="full-calender.html"><i class="ft-calendar"></i> Calendar            </a></div>
                </div>
              </li> -->
      <!--         <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
                <ul class="dropdown-menu">
                  <li class="arrow_box">
                    <form>
                      <div class="input-group search-box">
                        <div class="position-relative has-icon-right full-width">
                          <input class="form-control" id="search" type="text" placeholder="Search here...">
                          <div class="form-control-position navbar-search-close"><i class="ft-x"></i></div>
                        </div>
                      </div>
                    </form>
                  </li>
                </ul>
              </li> -->
            </ul>
            <ul class="nav navbar-nav float-right">         
              <li class="nav-item d-none d-md-block">
                <div class="row">  
                <!-- <img src="http://35.198.219.220:2121/ifca_splus/img/PlProject/IFCAApartement.jpg" style="border-radius: 5px;width: 35px;height: 35px;object-fit: cover;" class="displayed"> -->
                  <div style="line-height: 4;display: block;padding-right: 0px !important;" class="nav-link nav-link-label">
                  
                <!-- image ini belom ngambil dari url database, tolong diganti jadi url didatabase ya. terimakasih -->
                    <img src="<?php echo $propict ?>" style="border-radius: 5px;width: 35px;height: 35px;object-fit: cover;" class="displayed">
                  </div>  
                  <div id="div_project" class="nav-link nav-link-label" style="padding-top: 31px;padding-right: 15px;">
                  <?php echo $projectName ?>
                  </div>
                </div>
              </li>    
              <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell bell-shake" id="notification-navbar-link"></i><div id="div_cntnotif"><?php echo $cntnotif ?></div></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <div class="arrow_box_right">
                    <li class="dropdown-menu-header">
                      <h6 class="dropdown-header m-0"><span class="grey darken-2">Notifications</span></h6>
                    </li>
                    <li class="scrollable-container media-list w-100">
                      <div id="div_notif">
                         <?php echo $divnotif?>
                      </div>
                    </li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item info text-right pr-1" href="javascript:void(0)">Read all</a></li>
                  </div>
                </ul>
              </li>
     <!--          <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                  <div class="arrow_box_right">
                    <li class="dropdown-menu-header">
                      <h6 class="dropdown-header m-0"><span class="grey darken-2">Messages</span></h6>
                    </li>
                    <li class="scrollable-container media-list w-100"><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="<?=base_url('app-assets/images/portrait/small/avatar-s-6.png');?>" alt="avatar"></span></div>
                          <div class="media-body">
                            <h6 class="media-heading text-bold-700">Sarah Montery<i class="ft-circle font-small-2 success float-right"></i></h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Everything looks good. I will provide...</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">3:55 PM</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left"><span class="avatar avatar-sm rounded-circle"><span class="media-object rounded-circle text-circle bg-warning">E</span></span></div>
                          <div class="media-body">
                            <h6 class="media-heading text-bold-700">Eliza Elliot<i class="ft-circle font-small-2 danger float-right"></i></h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Okay. here is some more details...</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">2:10 AM</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="<?=base_url('app-assets/images/portrait/small/avatar-s-3.png');?>" alt="avatar"></span></div>
                          <div class="media-body">
                            <h6 class="media-heading text-bold-700">Kelly Reyes<i class="ft-circle font-small-2 warning float-right"></i></h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">Check once and let me know if you...</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Yesterday</time></small>
                          </div>
                        </div></a><a href="javascript:void(0)">
                        <div class="media">
                          <div class="media-left"><span class="avatar avatar-sm rounded-circle"><img src="<?=base_url('app-assets/images/portrait/small/avatar-s-19.png');?>" alt="avatar"></span></div>
                          <div class="media-body">
                            <h6 class="media-heading text-bold-700">Tonny Deep<i class="ft-circle font-small-2 danger float-right"></i></h6>
                            <p class="notification-text font-small-3 text-muted text-bold-600">We will start new project development...</p><small>
                              <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">Friday</time></small>
                          </div>
                        </div></a></li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item text-right info pr-1" href="javascript:void(0)">Read all</a></li>
                  </div>
                </ul>
              </li> -->
              <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">             <span class="avatar avatar-online"><img src="<?php echo $pictuser ?>" alt="avatar"></span></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <div class="arrow_box_right"><a class="dropdown-item" href="#"><span class="avatar avatar-online"><img src="<?php echo $pictuser ?>" alt="avatar"><span class="user-name text-bold-700 ml-1"><?php echo ucwords($this->session->userdata("Tsname"));?></span></span></a>
                    
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" onclick="profile()" color="#000000">
                      <i class="ft-user"></i> Edit Profile
                    </a>
                    <!-- <a class="dropdown-item" href="email-application.html">
                      <i class="ft-mail"></i> My Inbox
                    </a>
                    <a class="dropdown-item" href="project-summary.html">
                      <i class="ft-check-square"></i> Task
                    </a>
                    <a class="dropdown-item" href="chat-application.html">
                      <i class="ft-message-square"></i> Chats
                    </a> -->
                    
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="<?php echo base_url("userstaff/logout")?>"><i class="ft-power"></i> Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal navbar-fixed navbar-dark navbar-without-dd-arrow navbar-shadow" role="navigation" data-menu="menu-wrapper" >
    <div class="navbar-container main-menu-content" data-menu="menu-container" id="my">
        <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation" >
        <!--   <?php 
          // $countproject=1;
          // if($countproject>1){?> -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().$this->session->userdata("Tsdashboard");?>"><i class="ft-layers"></i><span style="font-size: 12px !important">Modules</span></a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link" href="<?=base_url('dash/index');?>"><i class="ft-home"></i><span style="font-size: 12px !important"></span></a> -->
            <a class="nav-link" href="<?=base_url().$this->session->userdata("urlmodule");?>"><i class="ft-home"></i><span style="font-size: 12px !important">Dashboard</span></a>
          </li>
          <!-- <?php  ?> -->
          
          
          <?php 
            $choosengroup = $this->session->userdata('choosengroup');
            if(empty($choosengroup)){
              $choosengroup = 'ADMINWEB';
            }
            if($usergroup=='ADMINWEB'){
              echo $this->dynamic_menu->build_menu($path, $choosengroup);
            }else {
              echo $this->dynamic_menu->build_menu($path, $usergroup);
            }
          ;?>
        </ul>
      </div>


      <!-- Chat floating -->
      <!-- <a href="" onclick="openchat()">
  <div id="container-floating">
  
  <div id="floating-button" data-toggle="tooltip" data-placement="left" data-original-title="Create">
    <p class="plus">+</p>
    <img class="edit" src="https://ssl.gstatic.com/bt/C3341AA7A1A076756462EE2E5CD71C11/1x/bt_compose2_1x.png">
  </div>
  </div>
  </a> -->
  
    </div>
        

    

    <!-- MODAL -->
<div class="modal fade text-left" id="modal" role="dialog" aria-labelledby="modaltitle" aria-hidden="true">
  <div class="modal-dialog" role="document" id="modaldialog">
    <div class="modal-content">
      <div class="modal-header" id="modalheader">
      <h4 class="modal-title" id="modaltitle">Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalbody">                                          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="savefrm">Save</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function openchat() {

    var user = "<?php echo $this->session->userdata('Tsuname');?>"
    var url = ""
    if (user=="MGR") {
      url = "https://my.livechatinc.com/customers"
    }
    else{
      url = "http://35.198.219.220:2121/ifca_splus_v2/c_chat"
    }

    if (window.innerWidth <= 640) {
        // if width is smaller then 640px, create a temporary a elm that will open the link in new tab
        var a = document.createElement('a');
        a.setAttribute("href", url);
        a.setAttribute("target", "_blank");

        var dispatch = document.createEvent("HTMLEvents");
        dispatch.initEvent("click", true, true);

        a.dispatchEvent(dispatch);
    }
    else {
        var width = 500
        // define the height in
        var height = 600
        // Ratio the hight to the width as the user screen ratio
        window.open(url , 'newwindow', 'width=' + width + ', height=' + height + ', top=' + ((window.innerHeight - height) / 2) + ', left=' + ((window.innerWidth - width) / 2));
    }
    return false;
}
</script>
<!-- END OF menu yang biasa (menu aplikasi) -->
