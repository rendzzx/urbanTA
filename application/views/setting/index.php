<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Setup</h3>
      </div>

        <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">Customer Service
                    </li>
                    <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Survey
                    </li> -->
                    </ol>
                </div>
            </div>
        </div>

    </div>
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h4 class="card-title">Setup</h4> -->
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <div class="nav-vertical p-2">
                                    <ul class="nav nav-tabs nav-left">
                                        <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabsection" aria-expanded="true">Section</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabcategorygroup" aria-expanded="true">Category Group</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabcategory" aria-expanded="true">Category</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabservice" aria-expanded="true">Costumer Service</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabcomplain" aria-expanded="true">Complain Source</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tablabour" aria-expanded="true">Labour</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabitem" aria-expanded="true">Item</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabfeedback" aria-expanded="true">Feedback</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabassign" aria-expanded="true">Assign</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1">
                                        <div id="tabsection" role="tabpanel" class="tab-pane active" aria-expanded="true">
                                            <table id="tblsection" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Section Code</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabcategory" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblcategory" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Category Code</th>
                                                        <th>Description</th>
                                                        <th>Priority</th>
                                                        <th>Supervisor ID</th>
                                                        <th>Type</th>
                                                        <th>Category Group</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabservice" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblservice" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Service Code</th>
                                                        <th>Section Code</th>
                                                        <th>Category</th>
                                                        <th>Trx Type</th>
                                                        <th>Service Description</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabcomplain" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblcomplain" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Complain Code</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tablabour" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tbllabour" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Labour ID</th>
                                                        <th>Name</th>
                                                        <th>Division</th>
                                                        <th>Departement</th>
                                                        <th>Doc Type</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabitem" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblitem" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>IC</th>
                                                        <th>Item Code</th>
                                                        <th>Description</th>
                                                        <th>Trx Type</th>
                                                        <th>Tax Code</th>
                                                        <th>Currency</th>
                                                        <th>Unit Price</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabfeedback" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblfeedback" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Feedback Code</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabassign" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblassign" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>User ID</th>
                                                        <th>Labour ID</th>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabcategorygroup" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblcategorygroup" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Category Group Code</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
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
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<script type="text/javascript">

    // SECTION
    var tblsection = $('#tblsection').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettablesection');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "section_cd" },
            { data: "descs" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });
    $("div.section").html(
        '<button id="addsection" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editsection" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletesection" class="btn btn-danger pull-up">Delete</button>'
    );
    tblsection.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblsection.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addsection').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addsection")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editsection').click(function(){
        var rows = tblsection.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblsection.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addsection")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletesection').click(function(){
        var rows = tblsection.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblsection.rows(rows).data();
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
                Delete(id,'sv_section',tblsection)
            }
        })
    })


    // CATEGORY
    var tblcategory = $('#tblcategory').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettablecategory');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"category_cd"},
            {data:"descs"},
            {data:"category_priority",
                render: function (data, type, row) {
                    var priority = row.category_priority;
                    if(priority==1){
                        return "Low";
                    }
                    else if(priority==2){
                        return "Medium";
                    }
                    else if(priority==3){
                        return "High";
                    }
                    else{
                        return '-';
                    }
                }
            },
            {data:"user_spv"},
            {data:"complain_type",
                render: function (data, type, row) {
                    var complain = row.complain_type;
                    if (complain=='R') {
                        return 'Request';
                    }
                    else if(complain=='C'){
                        return 'Complain';
                    }
                    else if(complain=='A'){
                        return 'Access';
                    }
                    else if(complain=='T'){
                        return 'Telphone';
                    }
                    else if(complain=='P'){
                        return 'Parking';
                    }
                    else{
                        return "-"
                    }
                }
            },
            {data:"descs_category_group"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar category">frtip'
    });
    $("div.category").html(
        '<button id="addcategory" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editcategory" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletecategory" class="btn btn-danger pull-up">Delete</button>'
    );
    tblcategory.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblcategory.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addcategory').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Category');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addcategory")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editcategory').click(function(){
        var rows = tblcategory.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblcategory.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Category');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addcategory")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletecategory').click(function(){
        var rows = tblcategory.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblcategory.rows(rows).data();
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
                Delete(id,'sv_category',tblcategory)
            }
        })
    })


    //COMPLAIN
    var tblservice = $('#tblservice').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettableservice');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"service_cd"},
            {data:"section_cd"},
            {data:"category_cd"},
            {data:"trx_type"},
            {data:"descs"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar service">frtip'
    });
    $("div.service").html(
        '<button id="addservice" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editservice" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deleteservice" class="btn btn-danger pull-up">Delete</button>'
    );
    tblservice.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblservice.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var tr = $(this).closest('tr');
        var row = tblservice.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });
    $('#addservice').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Service');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addservice")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editservice').click(function(){
        var rows = tblservice.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblservice.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Service');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addservice")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deleteservice').click(function(){
        var rows = tblservice.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblservice.rows(rows).data();
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
                Delete(id,'sv_master',tblservice)
            }
        })
    })


    //SOURCE
    var tblcomplain = $('#tblcomplain').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettablecomplain');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"complain_source"},
            {data:"descs"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar complain">frtip'
    });
    $("div.complain").html(
        '<button id="addcomplain" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editcomplain" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletecomplain" class="btn btn-danger pull-up">Delete</button>'
    );
    tblcomplain.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblcomplain.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addcomplain').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Complain');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addcomplain")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editcomplain').click(function(){
        var rows = tblcomplain.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblcomplain.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Complain');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addcomplain")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletecomplain').click(function(){
        var rows = tblcomplain.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblcomplain.rows(rows).data();
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
                Delete(id,'sv_complain_source',tblcomplain)
            }
        })
    })


    //LABOUR
    var tbllabour = $('#tbllabour').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettablelabour');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"staff_id"},
            {data:"name"},
            {data:"div_cd"},
            {data:"dept_cd"},
            {data:"prefix"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar labour">frtip'
    });
    $("div.labour").html(
        '<button id="addlabour" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editlabour" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletelabour" class="btn btn-danger pull-up">Delete</button>'
    );
    tbllabour.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbllabour.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addlabour').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Labour');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addlabour")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editlabour').click(function(){
        var rows = tbllabour.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbllabour.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Labour');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addlabour")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletelabour').click(function(){
        var rows = tbllabour.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tbllabour.rows(rows).data();
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
                Delete(id,'sv_labour',tbllabour)
            }
        })
    })


    //ITEM
    var tblitem = $('#tblitem').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettableitem');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"ic_flag", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var ic_flag = row.ic_flag;
                    if (ic_flag=='N') {
                        return '<div class="checkbox checkbox-primary"><input type="checkbox" disabled><label></label></div>'
                    }
                    else{
                        return '<div class="checkbox checkbox-primary"><input type="checkbox" checked="" disabled><label></label></div>'
                    }
                }
            },
            {data:"item_cd"},
            {data:"descs"},
            {data:"trx_type"},
            {data:"tax_cd"},
            {data:"currency_cd"},
            {data:"charge_amt",
                render: function (data, type, row) {
                    var charge_amt = row.charge_amt;
                    if (charge_amt == 0) {
                        return '<p class="pull-right">'+0+'</p>'
                    }else{
                        return '<p class="pull-right">'+formatNumber(charge_amt)+'</p>' ;
                    }    
                }
            },
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar item">frtip'
    });
    $("div.item").html(
        '<button id="additem" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="edititem" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deleteitem" class="btn btn-danger pull-up">Delete</button>'
    );
    tblitem.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblitem.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#additem').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Item');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/additem")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#edititem').click(function(){
        var rows = tblitem.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblitem.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Item');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/additem")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deleteitem').click(function(){
        var rows = tblitem.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblitem.rows(rows).data();
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
                Delete(id,'sv_charge',tblitem)
            }
        })
    })


    //FEEDBACK
    var tblfeedback = $('#tblfeedback').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettablefeedback');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"code"},
            {data:"descs"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar feedback">frtip'
    });
    $("div.feedback").html(
        '<button id="addfeedback" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editfeedback" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletefeedback" class="btn btn-danger pull-up">Delete</button>'
    );
    tblfeedback.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblfeedback.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addfeedback').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Feedback');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addfeedback")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editfeedback').click(function(){
        var rows = tblfeedback.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblfeedback.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Feedback');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addfeedback")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletefeedback').click(function(){
        var rows = tblfeedback.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblfeedback.rows(rows).data();
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
                Delete(id,'sv_feed_back',tblfeedback)
            }
        })
    })


    //ASSIGN
    var tblassign = $('#tblassign').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettableassign');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"user_id"},
            {data:"staff_id"},
            {data:"staff_id"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar assign">frtip'
    });
    $("div.assign").html(
        '<button id="addassign" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editassign" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deleteassign" class="btn btn-danger pull-up">Delete</button>'
    );
    tblassign.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblassign.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addassign').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Assign');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addassign")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editassign').click(function(){
        var rows = tblassign.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblassign.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Assign');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addassign")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deleteassign').click(function(){
        var rows = tblassign.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblassign.rows(rows).data();
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
                Delete(id,'sv_user_assign',tblassign)
            }
        })
    })

    function Delete(id,table,reload) {
        var data = [];
        data.push({ name:'id', value:id },{ name:'table', value:table })
        $.ajax({
            url : "<?php echo base_url('C_Setting_Cs/delete');?>",
            type:"POST",
            data: data,
            dataType:"json",
            success:function(event, data){
                swal("Information",event.Pesan,"warning");
                $('#modal').modal('hide');
                reload.ajax.reload(null,true);
            },                    
            error: function(jqXHR, textStatus, errorThrown){        
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
            }
        });
    }

    function formatNumber(data) {
      if(data==null){
        data =0;
      }
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    }

    function format ( d ) {
        var labour_rate = d.labour_rate;
        if (labour_rate == 0) {
            labour_rate = '<p class="pull-right">'+0+'</p>'
        }else{
            labour_rate = '<p class="pull-right">'+formatNumber(labour_rate)+'</p>' ;
        }
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<th>Hours:</th>'+
                '<td>'+d.service_day+'</td>'+
            '</tr>'+
            '<tr>'+
                '<th>Tax code:</th>'+
                '<td>'+d.tax_cd+'</td>'+
            '</tr>'+
            '<tr>'+
                '<th>Currency Code:</th>'+
                '<td>'+d.currency_cd+'</td>'+
            '</tr>'+
            '<tr>'+
                '<th>Service Rate:</th>'+
                '<td>Rp.&nbsp;'+
                labour_rate
                '</td>'+
            '</tr>'+
        '</table>';
    }


    //CATEGORY GROUP
    var tblcategorygroup = $('#tblcategorygroup').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Cs/gettablecategorygroup');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "category_group_cd" },
            { data: "descs" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar categorygroup">frtip'
    });
    $("div.categorygroup").html(
        '<button id="addcategorygroup" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editcategorygroup" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletecategorygroup" class="btn btn-danger pull-up">Delete</button>'
    );
    tblcategorygroup.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblcategorygroup.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addcategorygroup').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addcategorygroup")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editcategorygroup').click(function(){
        var rows = tblcategorygroup.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblcategorygroup.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Cs/addcategorygroup")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletecategorygroup').click(function(){
        var rows = tblcategorygroup.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblcategorygroup.rows(rows).data();
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
                Delete(id,'sv_category_group',tblcategorygroup)
            }
        })
    })

</script>

