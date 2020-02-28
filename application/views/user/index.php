<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">User Profile</h3>
      </div>

      <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">User Profile
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
                        <div class="card-header">
                            <!-- <h4 class="card-title">User Approval</h4> -->
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                       
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table id="tbluser" class="table table-hover table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Group Cd</th>
                                            <th>Handphone</th>
                                            <th>NIK</th>
                                        </tr>
                                    </thead>
                                </table>
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

    var tbluser = $('#tbluser').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_user/gettableuser');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "email" },
            { data: "name" },
            { data: "Group_Cd" },
            { data: "Handphone" },
            { data: "nik_id" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar user">frtip'
    });
    $("div.user").html(
        '<button id="adduser" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="edituser" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="activateuser" class="btn btn-danger pull-up">Approve</button>'
    );
    tbluser.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbluser.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#adduser').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add User');
        $('#modalbody').load("<?php echo base_url("c_user/adduser")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#edituser').click(function(){
        var rows = tbluser.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbluser.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit User');
        $('#modalbody').load("<?php echo base_url("c_user/adduser")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#activateuser').click(function(){

        var rows = tbluser.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbluser.rows(rows).data();
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
        $('#modalbody').load("<?php echo base_url("c_user/activate")?>");
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm_activate">Approve</button>');
        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deleteuser').click(function(){
        var rows = tbluser.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tbluser.rows(rows).data();
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
    
</script>