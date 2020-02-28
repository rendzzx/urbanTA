<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">S+ Users</h3>
      </div>

      <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">S+ Users
                    </li>
                    <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Web Menu -->
                    </li>
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
          
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#agent" aria-expanded="true">Agent</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#debtor" aria-expanded="false">Debtor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#guest" aria-expanded="false">Guest</a>
                                    </li>
                                  
                                </ul>
                                   
                                <div class="tab-content px-1 pt-1">
                                    <div role="tabpanel" class="tab-pane active" id="agent" aria-expanded="true" aria-labelledby="base-tab1">
                                        <table id="tblagent" class="table table-hover table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>User ID</th>
                                                    <th>Handphone</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="debtor" aria-expanded="true" aria-labelledby="base-tab2">
                                        <table id="tbldebtor" class="table table-hover table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>User ID</th>
                                                    <th>Handphone</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="guest" aria-expanded="true" aria-labelledby="base-tab3">
                                        <table id="tblguest" class="table table-hover table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>User ID</th>
                                                    <th>Handphone</th>
                                                    <th>Status</th>
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
        </section>
    </div>
  </div>
</div>

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<script type="text/javascript">

    var tblagent = $('#tblagent').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_user_splus/gettable/agent');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "name" },
            { data: "email" },
            { data: "userID" },
            { data: "Handphone" },
            { data: "status_activate" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar agent">frtip'
    });
    $("div.agent").html(
        // '<button id="adduser" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editagent" class="btn btn-info pull-up">Edit</button>&nbsp;'//+
        // '<button id="activateagent"  class="btn btn-danger pull-up">Approve</button>'
    );
    tblagent.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblagent.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#editagent').click(function(){
        var rows = tblagent.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblagent.rows(rows).data();
        var id = data[0].rowID;
        var group = data[0].Group_Cd;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit User');
        $('#modalbody').load("<?php echo base_url("c_user_splus/adduser")?>");

        $('#modal').data('id', id);
        $('#modal').data('namatbl', tblagent);
        $('#modal').data('group', group.toLowerCase());
        $('#modal').modal('show');
    })


    $('#activateagent').click(function(){
        var rows = tblagent.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblagent.rows(rows).data();
        var id = data[0].rowID;
        var stat = data[0].status_activate;
        // alert(stat);
        if (stat =='Y') {
            swal("Information",'This user has already been approved!',"warning");
            return;
        } 

        $('#modalheader').removeClass('bg-danger').addClass('bg-info white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Approve User');
        $('#modalbody').load("<?php echo base_url("c_user_splus/activate")?>");
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_activate">Approve</button>');
        $('#modal').data('id', id);
        $('#modal').data('namatbl', tblagent);
        $('#modal').modal('show');
    })
    var tbldebtor = $('#tbldebtor').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_user_splus/gettable/debtor');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "name" },
            { data: "email" },
            { data: "userID" },
            { data: "Handphone" },
            { data: "status_activate" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar debtor">frtip'
    });
    $("div.debtor").html(
        // '<button id="adduser" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editdebtor" class="btn btn-info pull-up">Edit</button>&nbsp;'//+
        // '<button id="activatedebtor"  class="btn btn-danger pull-up">Approve</button>'
    );
    tbldebtor.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbldebtor.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#editdebtor').click(function(){
        var rows = tbldebtor.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbldebtor.rows(rows).data();
        var id = data[0].rowID;
        var group = data[0].Group_Cd;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit User');
        $('#modalbody').load("<?php echo base_url("c_user_splus/adduser")?>");

        $('#modal').data('id', id);
        $('#modal').data('namatbl', tbldebtor);
        $('#modal').data('group', group.toLowerCase());
        $('#modal').modal('show');
    })


    $('#activatedebtor').click(function(){
        var rows = tbldebtor.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbldebtor.rows(rows).data();
        var id = data[0].rowID;
        var stat = data[0].status_activate;
        // alert(stat);
        if (stat =='Y') {
            swal("Information",'This user has already been approved!',"warning");
            return;
        } 

        $('#modalheader').removeClass('bg-danger').addClass('bg-info white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Approve User');
        $('#modalbody').load("<?php echo base_url("c_user_splus/activate")?>");
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_activate">Approve</button>');
        $('#modal').data('id', id);
        $('#modal').data('namatbl', tbldebtor);
        $('#modal').modal('show');
    })
    var tblguest = $('#tblguest').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_user_splus/gettable/guest');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "name" },
            { data: "email" },
            { data: "userID" },
            { data: "Handphone" },
            { data: "status_activate" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar guest">frtip'
    });
    $("div.guest").html(
        // '<button id="adduser" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editguest"  class="btn btn-info pull-up">Edit</button>&nbsp;'//+
        // '<button id="activateguest"  class="btn btn-danger pull-up">Approve</button>'
    );
    tblguest.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblguest.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#editguest').click(function(){
        var rows = tblguest.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblguest.rows(rows).data();
        var id = data[0].rowID;
        var group = data[0].Group_Cd;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit User');
        $('#modalbody').load("<?php echo base_url("c_user_splus/adduser")?>");

        $('#modal').data('id', id);
        $('#modal').data('namatbl', tblguest);
        $('#modal').data('group', group.toLowerCase());
        $('#modal').modal('show');
    })


    $('#activateguest').click(function(){
        var rows = tblguest.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblguest.rows(rows).data();
        var id = data[0].rowID;
        var stat = data[0].status_activate;
        // alert(stat);
        if (stat =='Y') {
            swal("Information",'This user has already been approved!',"warning");
            return;
        } 

        $('#modalheader').removeClass('bg-danger').addClass('bg-info white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Approve User');
        $('#modalbody').load("<?php echo base_url("c_user_splus/activate")?>");
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_activate">Approve</button>');
        $('#modal').data('id', id);
        $('#modal').data('namatbl', tblguest);
        $('#modal').modal('show');
    })
    
</script>