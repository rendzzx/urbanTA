

<link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/blueimp/css/blueimp-gallery.min.css')?>">
<!-- <link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" /> -->

</script>

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
              <h5 class="content-header-title">Unit Info Parameter</h5>
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
                                            <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#property" aria-expanded="true">1. Property</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#grup" aria-expanded="false">2. Unit Group</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#type" aria-expanded="false">3. Unit Type</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#typed" aria-expanded="false">4. Unit Type Gallery</a>
                                        </li>   
                                       
                                        <li class="nav-item">
                                            <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#level" aria-expanded="false">5. Floor</a>
                                        </li>
                                    </ul>
                                   
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="property" aria-expanded="true" aria-labelledby="base-tab1">
                                            <div class="table-responsive">
                                                <table id="tblproperty" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                            
                                                    <thead>            
                                                        <th style="width:15px !important;">No</th>
                                                        <th>Property Code</th>
                                                        <th>Property Description</th>
                                                        <th>Sales Booking Picture</th>
                                                        <th>Active</th>
                                                        <th>Picture</th>
                                                        <!-- <th></th> -->
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                         <div class="tab-pane" id="grup" aria-labelledby="base-tab2">
                                            <div class="table-responsive">
                                                <table id="tblgrup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No</th>
                                                        <th>Property Code</th>
                                                        <th>Descrpition</th>
                                                        <th>Remarks</th>
                                                        <th>Picture Url</th>
                                                        <th>Picture</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="type" aria-labelledby="base-tab2">
                                            <div class="table-responsive">
                                                <table id="tbllot" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No</th>
                                                        <th>Property Code</th>
                                                        <th>Unit Group</th>
                                                        <th>Descrpition</th>
                                                        <th>Remarks</th>
                                                        <th>Spec Info</th>
                                                        
                                                        <th>Picture Url</th>
                                                        <th>Picture</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="typed" aria-labelledby="base-tab3">
                                            <div class="table-responsive">
                                                <table id="tbllotd" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No</th>
                                                        <th>Property Code</th>
                                                        <th>Unit Group</th>
                                                        <th>Lot Type</th>
                                                        
                                                        <th>Gallery Title</th>
                                                        <th>Gallery Url</th>
                                                        <th>Picture</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="level" aria-labelledby="base-tab4">
                                            <div class="table-responsive">
                                                <table id="tbllevel" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No</th>
                                                        <th>Description</th>
                                                        <th>Picture Url</th>
                                                        <th>Picture</th>
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



<!--<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script type="text/javascript" src="<?=base_url('js/plugins/blueimp/jquery.blueimp-gallery.min.js') ?>"></script>-->

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/blueimp/jquery.blueimp-gallery.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>

<script>
$("#modal").on("hidden.bs.modal", function(){
    // alert('hide');
    $("modalbody").html("");
});
    var tbllot;
    var tbllot = $('#tbllot').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_lottype/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "property_cd" },
            { data: "unit_group_descs" },
            { data: "descs" },
            { data: "remarks" },
            { data: "spec_info" },
            
            { data: "picture_url" },
            { data: "picture_url",
                render: function (data, type, row) {
                    
                    var image = row.picture_url;
                    if(image==null||image==""){
                        return '';
                    }else{
                        return '<a href="'+image+'" title="Image from Unsplash" data-gallery=""><img src="'+image+'" width=100px></a>';
                    }
                    
                  }
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar tbllot">frtip'
    });
    $("div.tbllot").html(
        
        '<button id="edittbllot" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
        
    );
    tbllot.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbllot.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#edittbllot').click(function(){
        var rows = tbllot.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbllot.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Unit Type');
        $('#modalbody').load("<?php echo base_url("c_lottype/add");?>");
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_tbllot">Save</button>');

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })

    var tblgrup;
    var tblgrup = $('#tblgrup').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_grup/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "property_cd" },
            { data: "descs" },
            { data: "remarks" },
            
            { data: "picture_url" },
            { data: "picture_url",
                render: function (data, type, row) {
                    
                    var image = row.picture_url;
                    if(image==null||image==""){
                        return '';
                    }else{
                        return '<a href="'+image+'" title="Image from Unsplash" data-gallery=""><img src="'+image+'" width=100px></a>';
                    }
                    
                  }
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar tblgrup">frtip'
    });
    $("div.tblgrup").html(
        
        '<button id="edittblgrup" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
        
    );
    tblgrup.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblgrup.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#edittblgrup').click(function(){
        var rows = tblgrup.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblgrup.rows(rows).data();
        var id = data[0].rowID;
        // alert(id);

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Unit Group');
        $('#modalbody').load("<?php echo base_url("c_grup/add");?>");
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_grup">Save</button>');

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })

       
    var tbllotd;
    var tbllotd = $('#tbllotd').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_lottyped/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "property_cd" },
            { data:"unit_group_descs" },
            { data:"unit_type_descs" },
            { data: "gallery_title" },
            { data: "gallery_url" },
            { data: "gallery_url",
                render: function (data, type, row) {
                    console.log(row);
                    var image = row.gallery_url;
                    var title = row.gallery_title;
                    if(image==null||image==""){
                        return '';
                    }else{
                        return '<a href="'+image+'" title="'+title+'" data-gallery=""><img src="'+image+'" width=100px></a>';
                    }
                
                  }
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar lotd">frtip'
    });
    $("div.lotd").html(
        '<button id="addlotd" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editlotd" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
        '<button id="deletelotd" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>'
    );
    tbllotd.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbllotd.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addlotd').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Unit Type Gallery');
        $('#modalbody').load("<?php echo base_url("c_lottyped/add");?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_lotd">Save</button>');

    })
    $('#editlotd').click(function(){
        var rows = tbllotd.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbllotd.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Unit Type Gallery');
        $('#modalbody').load("<?php echo base_url("c_lottyped/add");?>");
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_lotd">Save</button>');
        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletelotd').click(function(){
        var rows = tbllotd.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tbllotd.rows(rows).data();
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
                // Delete(id,'rl_project_gallery',tbllotd)
                Delete(id,'cf_lot_type_gallery',tbllotd)
                // cf_lot_type_gallery
            }
        })
    })


    var tbllevel;
    var tbllevel = $('#tbllevel').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_pmlevel/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            
            { data: "descs" ,
                render: function (data, type, row) {
                        var descs = row.descs;
                        return descs;
                      }
            },
            { data: "picture_url" },
            { data: "picture_url",
            render: function (data, type, row) {
                    var image = row.picture_url;
                    if(image==null||image==""){
                        return '';
                    }else{
                        return '<a href="'+image+'" title="Image from Unsplash" data-gallery=""><img src="'+image+'" width=100px></a>';
                    }
                    
                  }
            },
            
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar level">frtip'
    });
    $("div.level").html(
            
            '<button id="editlevel" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
            
        );
        tbllevel.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tbllevel.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
        $('#editlevel').click(function(){
            var rows = tbllevel.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 
            var data = tbllevel.rows(rows).data();
            var id = data[0].rowID;

            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit Floor');
            $('#modalbody').load("<?php echo base_url("c_pmlevel/add");?>");
            $('.modal-footer').html("");
            $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_level">Save</button>');

            $('#modal').data('id', id);
            $('#modal').modal('show');
        })

    var tblproperty;
    var tblproperty = $('#tblproperty').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_property/getTable2');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "property_cd" },
            { data: "descs" },
            { data: "picture_url" },
            { data: "work_done",
                render: function (data, type, row) {
                         
                        if(data=="1.00"){
                            return  'Yes';   
                        }else{
                            return 'No';
                         }

                    }
            },
            { data: "picture_url",
            render: function (data, type, row) {
                var image = row.picture_url;
                if(image==null||image==""){
                        return '';
                    }else{
                        return '<a href="'+image+'" title="Image from Unsplash" data-gallery=""><img src="'+image+'" width=100px></a>';
                    }
                
              }
            }
            
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar property">frtip'
    });
    $("div.property").html(
        
        '<button id="editproperty" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
        
    );
    tblproperty.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblproperty.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#editproperty').click(function(){
        var rows = tblproperty.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblproperty.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Property');
        $('#modalbody').load("<?php echo base_url("c_property/add");?>");
        $('.modal-footer').html("");
            $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_property">Save</button>');


        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    function Delete(id, dbtable, idtable){
        
        $.ajax({
            url : "<?php echo base_url('c_picproject/Delete');?>",
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