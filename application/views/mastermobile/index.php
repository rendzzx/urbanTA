<!-- style -->
    <link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
    <link href="<?=base_url('app-assets/vendors/css/summernote/summernote.css')?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/blueimp/css/blueimp-gallery.min.css')?>">
    <link href="<?=base_url('css/plugins/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">

    <link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
    <style type="text/css">
        .loader{
          width:100%;
          height:100%;
          position:fixed;
          z-index:9999;
          background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center     
        }

        #navv>li.active>a{
            color: #00a1e4;
        }
        #navv:hover{
            color: #00a1e4;
        }
        #navv{
            color: #333 ;
        }
        .brand-text{
            color: #ffffff;
            font-size: 15px;
        }
        a.nav-link.nav-link-expand{
            padding: 0px;
        }
       
        .input-group-addon.btn.btn-default.btn-file {

        line-height: 20px !important;

        }
    </style>
<!-- style -->

<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
              <br>
              <!-- <h3 class="brand-text">IFCA <?php echo $this->session->userdata('appsname'); ?></h3> -->
              <h5 class="content-header-title">Project Info Parameter</h5>
            </div>

            <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
                <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active"><a href="#">Setting</a>
                    </li>
                    <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Fixed Navigation
                    </li> -->
                    </ol>
                </div>
                </div>
            </div>
        </div>

        <div class="content-body">
            <section id="basic-tabs-components">
                <div class="row match-height">
                    <div class="col-lg-12">
                        <div class="card">
                            
                            <div class="card-content">
                                <div class="card-body">
                                    
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#Gallery" aria-expanded="true">1. Project Gallery</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#Overview" aria-expanded="false">2. Project Overview</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#Feature" aria-expanded="false">3. Project Feature</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#Plan" aria-expanded="false">4. Project Plan</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab5" data-toggle="tab" aria-controls="tab5" href="#Amenities" aria-expanded="false">5. Project Surrounding Area</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab6" data-toggle="tab" aria-controls="tab6" href="#Location" aria-expanded="false">6. Project Location</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab7" data-toggle="tab" aria-controls="tab7" href="#Download" aria-expanded="false">7. Download</a>
                                        </li>
                                    </ul>
                                   
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="Gallery" aria-expanded="true" aria-labelledby="base-tab1">
                                            <div class="table-responsive">
                                                <table id="tblgallery" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No</th>
                                                        <th>Gallery Title</th>
                                                        <th>Gallery Url</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="Overview" aria-labelledby="base-tab2">
                                            <form id ="frmoverview" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_overview/save_overview" enctype="multipart/form-data">
                                                <div class="box-body">
                                                    <input type="hidden" id="idoverview" name="idoverview"  readonly="readonly" />
                                                    <div class="form-group">
                                                        <div id="overview">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Youtube Link</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="youtubelink" id="youtubelink" placeholder="Youtube link">
                                                        </div>
                                                    </div>
                                                    <span class="fileinput-filename" id="pictname" style="display: none"></span>
                                                    <!-- //UPLOAD BROCHURE HIDE DULU -->
                                                    <!-- <div class="form-group">
                                                        <input type="hidden" id="pdf" name="pdf"  readonly="readonly" />
                                                        <input type="hidden" id="idoverview" name="idoverview"  readonly="readonly" />
                                                        <label class="col-xs-2">Upload Brochure</label>
                                                        <div class="col-xs-8">
                                                            <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                <div class="form-control" data-trigger="fileinput" style="pointer-events:none;width: 70% !important;line-height: 30px !important;">
                                                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                                                    <span class="fileinput-filename" id="pictname"></span>
                                                                </div>
                                                                <span class="input-group-addon btn btn-default btn-file">
                                                                    <span class="fileinput-new">Select file</span>
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="file" id="userfile" name="userfile" accept="application/pdf">
                                                                </span>
                                                            </div>

                                                            <p style="color: red">(* Only Pdf)</p>
                                                        </div>
                                                    </div> -->
                                                    <button type="button" id="saveoverview" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="Feature" aria-labelledby="base-tab3">
                                            <div id="frmfeature">
                                                <input type="hidden" name="idfeature" id="idfeature">
                                                <div id="feature">
                                                </div> 
                                                <br>
                                                <button type="button" id="savefeature" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="Plan" aria-labelledby="base-tab4">
                                            <div class="table-responsive">
                                                <table id="tblplan" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No</th>
                                                        <th>Plan Title</th>
                                                        <th>Plan Url</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="Amenities" aria-labelledby="base-tab5">
                                            <DIV id="frmamenities">
                                                <div class="nav-vertical p-2">
                                                    <ul class="nav nav-tabs nav-left flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="psa_mall" data-toggle="tab" aria-controls="tabVerticalLeft1" href="#mall" aria-expanded="true">MALL</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="psa_lrt" data-toggle="tab" aria-controls="tabVerticalLeft2" href="#lrt" aria-expanded="false">LRT</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="psa_gym" data-toggle="tab" aria-controls="tabVerticalLeft3" href="#gym" aria-expanded="false">GYM</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="psa_din" data-toggle="tab" aria-controls="tabVerticalLeft4" href="#dining" aria-expanded="false">DINING</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="psa_pool" data-toggle="tab" aria-controls="tabVerticalLeft5" href="#pool" aria-expanded="false">POOL</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="psa_play" data-toggle="tab" aria-controls="tabVerticalLeft6" href="#play" aria-expanded="false">PLAYGROUND</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content px-1">
                                                        <div role="tabpanel" class="tab-pane active" id="mall" aria-expanded="true" aria-labelledby="baseVerticalLeft-tab1">
                                                            <div id="m"></div>
                                                            <!-- MALL -->
                                                            <br>
                                                            <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_amenities/save_amenities" enctype="multipart/form-data">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label class="col-xs-2">Picture Title</label>
                                                                        <div class="col-xs-8">
                                                                            <input type="text" class="form-control" name="title" id="title" placeholder="Picture Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="image" name="image"  readonly="readonly" />
                                                                        <label class="col-xs-2">Upload Picture</label>
                                                                        <div class="col-sm-7">
                                                                            <div id="logo" class="image" >
                                                                              <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/projectinfo/1103/amenities/no_image.png'): base_url('img/projectinfo/1103/amenities/'.'') );?>" width="120px" id="picturebox1">
                                                                            </div>
                                                                            <br>
                                                                            <span class="btn btn-success fileinput-button">
                                                                              <span>Select Picture...</span>
                                                                              <input type="file" id="userfile1" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(1,this)"/>
                                                                            </span>
                                                                            <p>(* Only Jpg, Png allowed)</p>
                                                                            <input type="hidden" id="picturepath1" name="picturepath1" value="<?php echo ''?>" readonly="1">
                                                                            <input type="hidden" id="pictturename1" name="picturename[]" readonly="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane" id="lrt" aria-labelledby="baseVerticalLeft-tab2">
                                                            <div id="l"></div>
                                                            <!-- LRT -->
                                                            <br>
                                                            <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_amenities/save_amenities" enctype="multipart/form-data">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label class="col-xs-2">Picture Title</label>
                                                                        <div class="col-xs-8">
                                                                            <input type="text" class="form-control" name="title1" id="title1" placeholder="Picture Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="image" name="image"  readonly="readonly" />
                                                                        <label class="col-xs-2">Upload Picture</label>
                                                                        <div class="col-sm-7">
                                                                            <div id="logo" class="image" >
                                                                              <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/projectinfo/1103/amenities/no_image.png'): base_url('img/projectinfo/1103/amenities/'.'') );?>" width="120px" id="picturebox2">
                                                                            </div>
                                                                            <br>
                                                                            <span class="btn btn-success fileinput-button">
                                                                              <span>Select Picture...</span>
                                                                              <input type="file" id="userfile2" name="userfile2" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(2,this)"/>
                                                                            </span>
                                                                            <p>(* Only Jpg, Png allowed)</p>
                                                                            <input type="hidden" id="picturepath2" name="picturepath2" value="<?php echo ''?>" readonly="1">
                                                                            <input type="hidden" id="picturename2" name="picturename[]" readonly="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane" id="gym" aria-labelledby="baseVerticalLeft-tab3">
                                                            <div id="g"></div>
                                                           <!-- GYM -->
                                                           <br>
                                                            <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_amenities/save_amenities" enctype="multipart/form-data">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label class="col-xs-2">Picture Title</label>
                                                                        <div class="col-xs-8">
                                                                            <input type="text" class="form-control" name="title2" id="title2" placeholder="Picture Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="image" name="image"  readonly="readonly" />
                                                                        <label class="col-xs-2">Upload Picture</label>
                                                                        <div class="col-sm-7">
                                                                            <div id="logo" class="image" >
                                                                              <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/projectinfo/1103/amenities/no_image.png'): base_url('img/projectinfo/1103/amenities/'.'') );?>" width="120px" id="picturebox3">
                                                                            </div>
                                                                            <br>
                                                                            <span class="btn btn-success fileinput-button">
                                                                              <span>Select Picture...</span>
                                                                              <input type="file" id="userfile3" name="userfile3" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(3,this)"/>
                                                                            </span>
                                                                            <p>(* Only Jpg, Png allowed)</p>
                                                                            <input type="hidden" id="picturepath3" name="picturepath3" value="<?php echo ''?>" readonly="1">
                                                                            <input type="hidden" id="picturename3" name="picturename[]" readonly="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane" id="dining" aria-labelledby="baseVerticalLeft-tab4">
                                                            <div id="d"></div>
                                                            <!-- DINING -->
                                                            <br>
                                                            <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_amenities/save_amenities" enctype="multipart/form-data">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label class="col-xs-2">Picture Title</label>
                                                                        <div class="col-xs-8">
                                                                            <input type="text" class="form-control" name="title3" id="title3" placeholder="Picture Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="image" name="image"  readonly="readonly" />
                                                                        <label class="col-xs-2">Upload Picture</label>
                                                                        <div class="col-sm-7">
                                                                            <div id="logo" class="image" >
                                                                              <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/projectinfo/1103/amenities/no_image.png'): base_url('img/projectinfo/1103/amenities/'.'') );?>" width="120px" id="picturebox4">
                                                                            </div>
                                                                            <br>
                                                                            <span class="btn btn-success fileinput-button">
                                                                              <span>Select Picture...</span>
                                                                              <input type="file" id="userfile4" name="userfile4" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(4,this)"/>
                                                                            </span>
                                                                            <p>(* Only Jpg, Png allowed)</p>
                                                                            <input type="hidden" id="picturepath4" name="picturepath4" value="<?php echo ''?>" readonly="1">
                                                                            <input type="hidden" id="picturename4" name="picturename[]" readonly="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane" id="pool" aria-labelledby="baseVerticalLeft-tab5">
                                                            <div id="p"></div>
                                                            <!-- POOL -->
                                                            <br>
                                                            <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_amenities/save_amenities" enctype="multipart/form-data">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label class="col-xs-2">Picture Title</label>
                                                                        <div class="col-xs-8">
                                                                            <input type="text" class="form-control" name="title4" id="title4" placeholder="Picture Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="image" name="image"  readonly="readonly" />
                                                                        <label class="col-xs-2">Upload Picture</label>
                                                                        <div class="col-sm-7">
                                                                            <div id="logo" class="image" >
                                                                              <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/projectinfo/1103/amenities/no_image.png'): base_url('img/projectinfo/1103/amenities/'.'') );?>" width="120px" id="picturebox5">
                                                                            </div>
                                                                            <br>
                                                                            <span class="btn btn-success fileinput-button">
                                                                              <span>Select Picture...</span>
                                                                              <input type="file" id="userfile5" name="userfile5" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(5,this)"/>
                                                                            </span>
                                                                            <p>(* Only Jpg, Png allowed)</p>
                                                                            <input type="hidden" id="picturepath5" name="picturepath5" value="<?php echo ''?>" readonly="1">
                                                                            <input type="hidden" id="picturename5" name="picturename[]" readonly="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="tab-pane" id="play" aria-labelledby="baseVerticalLeft-tab6">
                                                            <div id="y"></div>
                                                            <!-- PLAYGROUND -->
                                                            <br>
                                                            <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_amenities/save_amenities" enctype="multipart/form-data">
                                                                <div class="box-body">
                                                                    <div class="form-group">
                                                                        <label class="col-xs-2">Picture Title</label>
                                                                        <div class="col-xs-8">
                                                                            <input type="text" class="form-control" name="title5" id="title5" placeholder="Picture Title">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="hidden" id="image" name="image"  readonly="readonly" />
                                                                        <label class="col-xs-2">Upload Picture</label>
                                                                        <div class="col-sm-7">
                                                                            <div id="logo" class="image" >
                                                                              <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/projectinfo/1103/amenities/no_image.png'): base_url('img/projectinfo/1103/amenities/'.'') );?>" width="120px" id="picturebox6">
                                                                            </div>
                                                                            <br>
                                                                            <span class="btn btn-success fileinput-button">
                                                                              <span>Select Picture...</span>
                                                                              <input type="file" id="userfile6" name="userfile6" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(6,this)"/>
                                                                            </span>
                                                                            <p>(* Only Jpg, Png allowed)</p>
                                                                            <input type="hidden" id="picturepath6" name="picturepath6" value="<?php echo ''?>" readonly="1">
                                                                            <input type="hidden" id="picturename6" name="piturename[]" readonly="1">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>                                                  
                                                <button type="button" id="saveamenities" class="btn btn-primary">Save</button>
                                            </DIV>
                                        </div>

                                        <div class="tab-pane" id="Location" aria-labelledby="base-tab6">
                                            <form id ="frmloc" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_plocation/save_location" enctype="multipart/form-data">
                                                <div class="box-body">
                                                    <br>
                                                    <br>
                                                    <div class="form-group">
                                                        <input type="hidden" name="idlocation" id="idlocation">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Coordinat Name</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="coordinatname" id="coordinatname" placeholder="Coordinat Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Coordinat Project</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="coordinatproject" id="coordinatproject" placeholder="Coordinat Project">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Coordinat Adress</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="coordinataddress" id="coordinataddress" placeholder="Coordinat Adress">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Email</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">No. WhatsApp</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="wa_no" id="wa_no" placeholder="No. WhatsApp">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Facebook Url</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="Facebook Url">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">YouTube Url</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="youtube_url" id="youtube_url" placeholder="YouTube Url">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Instagram Url</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="instagram_url" id="instagram_url" placeholder="Instagram Url">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Web Url</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="web_url" id="web_url" placeholder="Web Url">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="youtubenewsfeed" class="col-xs-2">Contact No.</label>
                                                        <div class="col-xs-8">
                                                            <input type="text" class="form-control" name="contact_telno" id="contact_telno" placeholder="Contact No.">
                                                        </div>
                                                    </div>
                                                    <button type="button" id="savelocation" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane" id="Download" aria-labelledby="base-tab7">
                                            <div class="table-responsive">
                                                <table id="tbldownload" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                                            <!-- display table-striped table-condensed -->
                                                    <thead>            
                                                        <th class="sorting_asc">No</th>
                                                        <th>Descs</th>
                                                        <th>Url</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
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
</div>

<!-- script -->
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/blueimp/jquery.blueimp-gallery.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/summernote/summernote.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
    <script src="<?=base_url('js/plugins/jasny/jasny-bootstrap.min.js')?>"></script>
<!-- script -->

<script type="text/javascript">
    function block(boelan,div){
        var block_ele = $(div)
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
    //Amenities
    $(document).ready(function(){

        $('#m').summernote({
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });

        $('#l').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                      ]
        });

        $('#g').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                      ]
        });

        $('#d').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                      ]
        });

        $('#p').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                      ]
        });

        $('#y').summernote({
                    height: 300,
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                      ]
        });

        $.getJSON("<?php echo base_url('c_amenities/getByID');?>",
            function (data) {
                console.log(data);
                if(data.length>0){
                    var mall='',lrt='',gym='',dining='',pool='',play='';
                    $.each(data, function( index, key ) {
                      // if(key)
                      // console.log(key.amenities_info)
                      if(key.amenities_type=="M"){
                        mall = key.amenities_info
                          $('#title').val(data[4].amenities_title);
                          $('#picturepath1').val(data[4].amenities_url)
                          if(data[4].amenities_url=='null'||data[4].amenities_url==''||data[4].amenities_url==null){
                            pic_path = "<?php echo base_url('img/projectinfo/1103/amenities/no_image.png')?>";
                          }else{
                            pic_path = data[4].amenities_url;
                          }
                          $('#picturebox1').attr('src', pic_path);
                      }
                      if(key.amenities_type=="L"){
                        lrt = key.amenities_info
                          $('#title1').val(data[5].amenities_title);
                          $('#picturepath2').val(data[5].amenities_url)
                          if(data[5].amenities_url=='null'||data[5].amenities_url==''||data[5].amenities_url==null){
                            pic_path1 = "<?php echo base_url('img/projectinfo/1103/amenities/no_image.png')?>";
                          }else{
                            pic_path1 = data[5].amenities_url;
                          }
                          $('#picturebox2').attr('src', pic_path1)
                      }
                      if(key.amenities_type=="G"){
                        gym = key.amenities_info
                          $('#title2').val(data[6].amenities_title);
                          $('#picturepath3').val(data[6].amenities_url)
                          if(data[6].amenities_url=='null'||data[6].amenities_url==''||data[6].amenities_url==null){
                            pic_path2 = "<?php echo base_url('img/projectinfo/1103/amenities/no_image.png')?>";
                          }else{
                            pic_path2 = data[6].amenities_url;
                          }
                          $('#picturebox3').attr('src', pic_path2)
                      }
                      if(key.amenities_type=="D"){
                        dining = key.amenities_info
                          $('#title3').val(data[7].amenities_title);
                          $('#picturepath4').val(data[7].amenities_url)
                          if(data[7].amenities_url=='null'||data[7].amenities_url==''||data[7].amenities_url==null){
                            pic_path3 = "<?php echo base_url('img/projectinfo/1103/amenities/no_image.png')?>";
                          }else{
                            pic_path3 = data[7].amenities_url;
                          }
                          $('#picturebox4').attr('src', pic_path3)
                      }
                      if(key.amenities_type=="P"){
                        pool = key.amenities_info
                          $('#title4').val(data[8].amenities_title);
                          $('#picturepath5').val(data[8].amenities_url)
                          if(data[8].amenities_url=='null'||data[8].amenities_url==''||data[8].amenities_url==null){
                            pic_path4 = "<?php echo base_url('img/projectinfo/1103/amenities/no_image.png')?>";
                          }else{
                            pic_path4 = data[8].amenities_url;
                          }
                          $('#picturebox5').attr('src', pic_path4)
                      }
                      if(key.amenities_type=="Y"){
                        play = key.amenities_info
                          $('#title5').val(data[9].amenities_title);
                          $('#picturepat6').val(data[9].amenities_url)
                          if(data[9].amenities_url=='null'||data[9].amenities_url==''||data[9].amenities_url==null){
                            pic_path5 = "<?php echo base_url('img/projectinfo/1103/amenities/no_image.png')?>";
                          }else{
                            pic_path5 = data[9].amenities_url;
                          }
                          $('#picturebox6').attr('src', pic_path5)
                      }
                      

                      ;
               // $('#picturebox1').attr('src','".$key.amenities_url."')
                    });
                    // console.log(infra);
                    $('#m').summernote('code',mall);
                    $('#l').summernote('code',lrt);
                    $('#g').summernote('code',gym);
                    $('#d').summernote('code',dining);
                    $('#p').summernote('code',pool);
                    $('#y').summernote('code',play);
                }
                
                 function sendFile(file, editor, welEditable) {
                    data = new FormData();
                    data.append("file", file);
                    $.ajax({
                        data: data,
                        type: "POST",
                        url: "c_amenities/upload",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(url) {
                            editor.insertImage(welEditable, url);
                        }
                    });
                }
            }
        );

        $('#saveamenities').click(function(){
            // document.getElementById('loader').hidden=false;
            data = []
            var mall = $('#m').summernote('code')
            var lrt = $("#l").summernote('code')
            var gym = $("#g").summernote('code')
            var dining = $("#d").summernote('code')
            var pool = $("#p").summernote('code')
            var play = $("#y").summernote('code')
            
            var title = $("#title").val()
            var picturepath1 = $("#picturepath1").val()

            var title1 = $("#title1").val()
            var picturepath2 = $("#picturepath2").val()

            var title2 = $("#title2").val()
            var picturepath3 = $("#picturepath3").val()

            var title3 = $("#title3").val()
            var picturepath4 = $("#picturepath4").val()

            var title4 = $("#title4").val()
            var picturepath5 = $("#picturepath5").val()

            var title5 = $("#title5").val()
            var picturepath6 = $("#picturepath6").val()

            data.push(
                {name:'mall',value:mall},
                {name:'lrt',value:lrt},
                {name:'gym',value:gym},
                {name:'dining',value:dining},
                {name:'pool',value:pool},
                {name:'play',value:play},
                {name:'title',value:title},
                {name:'picturepath1',value:picturepath1},
                {name:'title1',value:title1},
                {name:'picturepath2',value:picturepath2},
                {name:'title2',value:title2},
                {name:'picturepath3',value:picturepath3},
                {name:'title3',value:title3},
                {name:'picturepath4',value:picturepath4},
                {name:'title4',value:title4},
                {name:'picturepath5',value:picturepath5},
                {name:'title5',value:title5},
                {name:'picturepath6',value:picturepath6},
            )

            $.ajax({
                url : "<?php echo base_url('c_amenities/save_amenities');?>",
                type:"POST",
                data:data,
                dataType:"json",
                success:function(event, data){

                    if(event.status=='OK'){
                      swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                      });
                      document.getElementById('loader').hidden=true;                          
                    } else {
                      swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                      });
                      document.getElementById('loader').hidden=true;
                  }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                      swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: textStatus+' Save : '+errorThrown,
                        confirmButtonText: "OK"
                      });
                }
            });
        });
    });

    $("#psa_mall").click(function() {
        $("#psaselect").val("M").trigger('change');
    });

    $("#psa_lrt").click(function() {
        $("#psaselect").val("L").trigger('change');
    });

    $("#psa_gym").click(function() {
        $("#psaselect").val("G").trigger('change');
    });

    $("#psa_din").click(function() {
        $("#psaselect").val("D").trigger('change');
    });
    $("#psa_pool").click(function() {
        $("#psaselect").val("p").trigger('change');
    });
    $("#psa_play").click(function() {
        $("#psaselect").val("Y").trigger('change');
    });

    function saveImage(seq, el) {
        // document.getElementById('loader').hidden=false;
        var a = el.files[0].size;
        var max = (1024 * 1024) * 7;
        
        if (a > max){
          
          
          if (max.toString().length > 6) {
            max = max / 1024 / 1024;
            max = max.toFixed(2);
            max = max + ' mb';
          } else {
            max = max / 1024;
            max = max.toFixed(2);
            max = max + ' kb';
          }
          swal('Please upload less than ' + max);
          return false;
        }
        block(true)

        $.ajax({
          url : "<?php echo base_url('c_amenities/savePic');?>",
          
          type:"POST",
          data: function () {
            var data = new FormData();
            data.append("complain_no", $("#complain_no").val());
            data.append("seqno", seq);
            data.append("userfile", $("#userfile"+seq).get(0).files[0]);
            return data;
          }(),
          processData: false,
          contentType: false,
          dataType:"json",
          success:function(data, status){
            console.log(data);
            if(data.status == "OK"){
                    // document.getElementById('loader').hidden=true;
                    swal({
                      title: "Information",
                      text: data.pesan,
                      type: "success",
                      confirmButtonText: "OK"
                    });
                    $('#picturebox'+seq).attr('src', data.url);
                    $('#picturepath'+seq).val(data.url);
                    $('#picturename'+seq).val(data.picname);
                    // $('#picturebox'+seq).attr('src', data.url);
                    // $('#lrtpath'+seq).val(data.url);
                    // $('#lrtname'+seq).val(data.picname);
                    // $('#picturebox'+seq).attr('src', data.url);
                    // $('#gympath'+seq).val(data.url);
                    // $('#gymname'+seq).val(data.picname);
                    // $('#picturebox'+seq).attr('src', data.url);
                    // $('#diningpath'+seq).val(data.url);
                    // $('#diningname'+seq).val(data.picname);
                    // $('#picturebox'+seq).attr('src', data.url);
                    // $('#poolpath'+seq).val(data.url);
                    // $('#poolname'+seq).val(data.picname);
                    // $('#picturebox'+seq).attr('src', data.url);
                    // $('#playpath'+seq).val(data.url);
                    // $('#playname'+seq).val(data.picname);
                  } else {
                    swal({
                      title: "Error",
                      text: data.pesan,
                      type: "error",
                      confirmButtonText: "OK"
                    });
                      // document.getElementById('loader').hidden=true; 
                    }
                    block(false)
                  },                    
                  error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                    block(false)
                  }
            });
        }

    //Feature
    $(document).ready(function(){

        $.getJSON("<?php echo base_url('c_feature/getByID');?>",
            function (data) {
                // console.log(data);
                 $('#feature').summernote({
                    height: 300,
                    toolbar: [
    // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                      ]
                });
                if(data.length>0){
                    $("#idfeature").val(data[0].rowID);
                    var feature = data[0].feature_info;
                    $('#feature').summernote('code',feature)
                }else{
                    $("#idfeature").val(0);
                }               
            }
        );
        $('#savefeature').click(function(){
            block(true,'#frmfeature');
            // document.getElementById('loader').hidden=false;
            data = []
            var idfeature = $("#idfeature").val();
            var feature = $('#feature').summernote('code')
            data.push({name:'feature',value:feature},{name:'idfeature',value:idfeature})
            // console.log(data);return;
            $.ajax({
                    url : "<?php echo base_url('c_feature/save_feature');?>",
                    type:"POST",
                    data:data,
                    dataType:"json",
                    success:function(event, data){

                        if(event.status=='OK'){
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          
                        } else {                          
                            swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                      }
                      block(false,'#frmfeature');
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: textStatus+' Save : '+errorThrown,
                            confirmButtonText: "OK"
                          });
                     block(false,'#frmfeature');
                    }
                    });
        });
    });

    //Overview
    var isFile=false;
    var jqXHRData;
    $(document).ready(function(){
        $.getJSON("<?php echo base_url('c_overview/getByID');?>",
            function (data) {
                // console.log(data);
                $('#overview').summernote({
                    height: 300,
                    toolbar: [
    // [groupName, [list of button]]
                            ['style', ['bold', 'italic', 'underline', 'clear']],
                            ['font', ['strikethrough', 'superscript', 'subscript']],
                            ['fontsize', ['fontsize']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['height', ['height']]
                            ]
                });
                if(data.length>0){
                    // alert(data[0].rowID);
                    var overview = data[0].overview_info
                    $('#idoverview').val(data[0].rowID);
                    $('#overview').summernote('code',overview)
                    $('#youtubelink').val(data[0].youtube_link);
                    $('#pdf').val(data[0].url_brochure);
                    var url = data[0].url_brochure;
                    var filename = url.substring(url.lastIndexOf('/')+1);
                    if(data[0].url_brochure!="")
                    {
                        document.getElementById("pictname").innerHTML = filename;
                        $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                    }
                    else {
                        document.getElementById("pictname").innerHTML = filename;
                    }
                }else{
                    $('#idoverview').val(0);
                }               
            }
        );
        $("#userfile").on('change', function () {
            $("#pdf").val(this.files[0].name);
        });
        $.validator.addMethod("cek_youtube", function (value, element) {
            var isSuccess = true;            
            var url = $('#youtubelink').val();
            if (url.length != '0') {
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                var match = url.match(regExp);
                if (match && match[2].length == 11) {
                    isSuccess = true;
                }
                else {
                    isSuccess = false;
                }
            }
            return isSuccess;
        });
         $("#frmoverview").validate({
            rules: {
                youtubelink:{
                    cek_youtube:false
                },
            },
            messages: {
                youtubelink: {
                    cek_data: "One of this Field can't be blank",
                    cek_youtube: "Invalid Youtube Link"
                },
            },
            // errorElement: "em",
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
          } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
        });
        $('#userfile').fileupload({
            url: "<?php echo base_url('c_overview/save_overview');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;                
            },
            done: function (event, response) {
                
                var res = response.result;
                if(res.status =='OK'){
                    swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: res.Pesan,
                            confirmButtonText: "OK"
                          });                         
                    $('#modal').modal('hide');
                }else{
                     swal({
                            title: "Warning",
                            animation: false,
                            type:"error",
                            text: res.Pesan,
                            confirmButtonText: "OK"
                          });                       
                }
                block(false,'#frmoverview');
                // tbloverview.ajax.reload(null,true); 

            },
            fail: function (event, response) {
                // BootstrapDialog.alert(response.result.Pesan);
                var error = response["_response"]["errorThrown"];
                // console.log(event);
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: error,
                    confirmButtonText: "OK"
                    });
            }
        });
        $('#saveoverview').click(function(){
            block(true,'#frmoverview');
            if($('#frmoverview').valid()){
                // document.getElementById('loader').hidden=false;
                var id = $('#idoverview').val();                
                var datafrm = $('#frmoverview').serializeArray();
                var overview = $('#overview').summernote('code')
                
                datafrm.push({name:'idoverview',value:id},{name:'overview',value:overview},{name:"isFile",value:isFile})
                var obj = new Object();
                // console.log(datafrm);return;
                // obj.id = id;
                obj.isFile = isFile;
                if(isFile){
                  // alert('sukses Picture');
                  if(jqXHRData){
                    jqXHRData.formData = datafrm;
                    jqXHRData.submit();
                    
                  }
                }
                else{
                    $.ajax({
                    url : "<?php echo base_url('c_overview/save_overview');?>",
                    type:"POST",
                    data:datafrm,
                    dataType:"json",
                    success:function(event, data){
                        if(event.status=='OK'){
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          $('#modal').modal('hide');
                        //   frmoverview.ajax.reload(null,true);
                        } else {
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                      }
                      block(false,'#frmoverview');
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: textStatus+' Save : '+errorThrown,
                            confirmButtonText: "OK"
                          });
                        block(false,'#frmoverview');
                    }
                });
                }
            }else{
                block(false,'#frmoverview');
            }
        });
    });
    
    //Gallery
    var tblgallery;
    var tblgallery = $('#tblgallery').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_gallery/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "gallery_title" },
            { data: "gallery_url" },
            { data: "gallery_url",
                render: function (data, type, row) {
                    var image = row.gallery_url;
                    var title = row.gallery_title;
                    return '<a href="'+image+'" title="'+title+'" data-gallery=""><img src="'+image+'" width=100px></a>';
                  }
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar gallery">frtip'
    });
    $("div.gallery").html(
        '<button id="addgallery" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editgallery" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
        '<button id="deletegallery" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>'
    );
    tblgallery.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblgallery.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addgallery').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Gallery');
        $('#modalbody').load("<?php echo base_url("c_gallery/add");?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editgallery').click(function(){
        var rows = tblgallery.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblgallery.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Gallery');
        $('#modalbody').load("<?php echo base_url("c_gallery/add");?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletegallery').click(function(){
        var rows = tblgallery.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblgallery.rows(rows).data();
        var id = data[0].rowID;

        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then(function(a){
            if (a.value==true) {
                Delete(id,'rl_project_gallery',tblgallery)
            }
        })
    })

    //Plan
    var tblplan;
    var tblplan = $('#tblplan').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_plan/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "plan_title" },
            { data: "plan_url" },
            { data: "plan_url", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var image = row.plan_url;
                    var title = row.plan_title;
                    return '<a href="'+image+'" title="'+title+'" data-gallery=""><img src="'+image+'" width=100px></a>';
                  }
            }

        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar plan">frtip'
    });
    $("div.plan").html(
        '<button id="addplan" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editplan" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
        '<button id="deleteplan" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>'
    );
    tblplan.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblplan.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addplan').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Plan');
        $('#modalbody').load("<?php echo base_url("c_plan/add");?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editplan').click(function(){
        var rows = tblplan.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblplan.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Plan');
        $('#modalbody').load("<?php echo base_url("c_plan/add");?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deleteplan').click(function(){
        // alert('a');
        var rows = tblplan.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblplan.rows(rows).data();
        var id = data[0].rowID;

        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then(function(a){
            if (a.value==true) {
                Delete(id,'rl_project_plan',tblplan)
            }
        })
    })
    
    //location
    $(document).ready(function(){

            $.getJSON("<?php echo base_url('c_plocation/getByID');?>",
                function (data) {
                    console.log(data)
                    $('#idlocation').val(data[0].RowID);
                    $('#coordinatproject').val(data[0].coordinat_project);
                    $('#coordinatname').val(data[0].coordinat_name);
                    $('#coordinataddress').val(data[0].coordinat_address);
                    $('#email').val(data[0].email_add);
                    $('#wa_no').val(data[0].wa_no);
                    $('#facebook_url').val(data[0].facebook_url);
                    $('#youtube_url').val(data[0].youtube_url);
                    $('#instagram_url').val(data[0].instagram_url);
                    $('#web_url').val(data[0].web_url);
                    $('#contact_telno').val(data[0].contact_telno);
                }
            );

            $('#savelocation').click(function(){
                block(true,'#frmloc');
                // document.getElementById('loader').hidden=false;
                var dataloc = $('#frmloc').serializeArray();
                    $.ajax({
                    url : "<?php echo base_url('c_plocation/save_location');?>",
                    type:"POST",
                    data:dataloc,
                    dataType:"json",
                    success:function(event, data){

                        if(event.status=='OK'){
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          // document.getElementById('loader').hidden=true;
                          $('#modal').modal('hide');
                          
                          // tbloverview.ajax.reload(null,true);
                        } else {
                            // document.getElementById('loader').hidden=false;
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });

                          // document.getElementById('loader').hidden=true;
                      }
                      block(false,'#frmloc');
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: textStatus+' Save : '+errorThrown,
                            confirmButtonText: "OK"
                          });
                     block(false,'#frmloc');
                    }
                });

        });

    });
    
    //Download
    var tbldownload;
    var tbldownload = $('#tbldownload').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_download/getTable');?>",
            "type": "POST"
        },
        "columns": [
                { data: "row_number", width:'1px', searchable:false,
                    render: function (data, type, row) {
                        var row_number = row.row_number
                        return row_number + '.'
                    }
                },
                { data: "descs" },
                { data: "url" },
                { data: "url", width:'1px', searchable:false,
                    render: function (data, type, row) {
                        var url = row.url;
                        // var pdf = '<?php echo base_url('pdf/')?>'+url;
                        return '<a href="'+url+'" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-users fa-fw"></i> Preview Pdf</a>';
                      }
                }

            ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar download">frtip'
    });
     tbldownload.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbldownload.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $("div.download").html(
        '<button id="adddownload" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editdownload" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
        '<button id="deletedownload" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>'
    );
    $('#adddownload').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Plan');
        $('#modalbody').load("<?php echo base_url("c_download/add");?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editdownload').click(function(){
        var rows = tbldownload.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbldownload.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Plan');
        $('#modalbody').load("<?php echo base_url("c_download/add");?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletedownload').click(function(){
        // alert('a');
        var rows = tbldownload.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tbldownload.rows(rows).data();
        var id = data[0].rowID;

        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then(function(a){
            if (a.value==true) {
                Delete(id,'rl_project_download',tbldownload)
            }
        })
    })
    function Delete(id, dbtable, idtable){
        
        $.ajax({
            url : "<?php echo base_url('c_mastermobile/Delete');?>",
            type:"POST",
            data: { id: id,dbtable:dbtable},
            dataType:"json",
            success:function(event, data){
                    // BootstrapDialog.alert(event.Pesan);
                    swal("Information",event.Pesan,"warning");
                    $('#modal').modal('hide');
                    // if(idtable=='tbldownload'){
                    //     tbldownload.ajax.reload(null,true);
                    // }
                     idtable.ajax.reload(null,true);
            },                    
            error: function(jqXHR, textStatus, errorThrown){        
                    // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                    swal("Information",textStatus+' Save : '+errorThrown,"warning");

            }
        });
    }

</script>

<!-- Property