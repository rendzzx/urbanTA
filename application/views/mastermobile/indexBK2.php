

<!-- <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/summernote/summernote.css')?>">
 -->
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

            <!-- <div class="content-header-right col-md-4 col-12 mb-2">
              <br><br>
              
              <h5 class="content-header-title" >
              tes
              php echo $projectName;
              </h5>
            </div> -->
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
                                                            <a class="nav-link active" id="baseVerticalLeft-tab1" data-toggle="tab" aria-controls="tabVerticalLeft1" href="#infra" aria-expanded="true">Infrastructur</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="baseVerticalLeft-tab2" data-toggle="tab" aria-controls="tabVerticalLeft2" href="#school" aria-expanded="false">School</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="baseVerticalLeft-tab3" data-toggle="tab" aria-controls="tabVerticalLeft3" href="#hospital" aria-expanded="false">Hospital</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="baseVerticalLeft-tab4" data-toggle="tab" aria-controls="tabVerticalLeft4" href="#other" aria-expanded="false">Other</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content px-1">
                                                        <div role="tabpanel" class="tab-pane active" id="infra" aria-expanded="true" aria-labelledby="baseVerticalLeft-tab1">
                                                            <div id="i"></div>
                                                            <!-- infrastructure -->
                                                        </div>
                                                        <div class="tab-pane" id="school" aria-labelledby="baseVerticalLeft-tab2">
                                                            <div id="s"></div>
                                                            <!-- school -->
                                                        </div>
                                                        <div class="tab-pane" id="hospital" aria-labelledby="baseVerticalLeft-tab3">
                                                            <div id="h"></div>
                                                           <!-- hospital -->
                                                        </div>
                                                        <div class="tab-pane" id="other" aria-labelledby="baseVerticalLeft-tab4">
                                                            <div id="o"></div>
                                                            <!-- other -->
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
                                                            <input type="text" class="form-control" name="wa_no" id="wa_no" placeholder="WhatsApp">
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



<!--

-->

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

        $('#o').summernote({
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
        $('#i').summernote({
                    height: 300,
                    onImageUpload: function(files, editor, welEditable) {
                        sendFile(files[0], editor, welEditable);
                    },
                    toolbar: [
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                      ]
                });
         $('#s').summernote({
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
         $('#h').summernote({
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
                // console.log(data)
                if(data.length>0){
                    var infra='',school='',hospital='',other='';
                    $.each(data, function( index, key ) {
                      // if(key)
                      // console.log(key.amenities_info)
                      if(key.amenities_type=="I"){
                        infra = key.amenities_info
                      }
                      if(key.amenities_type=="S"){
                        school = key.amenities_info
                      }
                      if(key.amenities_type=="H"){
                        hospital = key.amenities_info
                      }
                      if(key.amenities_type=="O"){
                        other = key.amenities_info
                      }
               
                    });
                    // console.log(infra);
                    $('#i').summernote('code',infra);
                    $('#s').summernote('code',school);
                    $('#h').summernote('code',hospital);
                    $('#o').summernote('code',other);
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
            var infra = $('#i').summernote('code')
            var school = $("#s").summernote('code')
            var hospital = $("#h").summernote('code')
            var other = $("#o").summernote('code')
            data.push(
                {name:'infra',value:infra},
                {name:'school',value:school},
                {name:'hospital',value:hospital},
                {name:'other',value:other}
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

<!-- Property -->