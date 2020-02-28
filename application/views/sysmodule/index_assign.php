<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Assign Module to Group</h3>
      </div>

        <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">Group Assign
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
                            <!-- <h4 class="card-title">Assign Module to User</h4> -->
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
              
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <table id="tbluser" class="table table-hover table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Group Code</th>
                                            <th>Group Description</th>
                                            <!-- <th>Dashboard</th> -->
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
            "url" : "<?php echo base_url('C_Module/getTableGroup');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "group_cd" },
            { data: "group_descs" },
            // { data: "dashboard_url" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar user">frtip'
    });
    $("div.user").html(
        '<button id="assign" class="btn btn-primary pull-up">Assign</button>&nbsp;'
     
    );
    tbluser.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbluser.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#assign').click(function(){
        var rows = tbluser.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbluser.rows(rows).data();
        var GroupID = data[0].GroupID;
        var group_cd = data[0].group_cd;
        var group_descs = data[0].group_descs;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        // $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit User');
        $('#modalbody').load("<?php echo base_url("C_Module/assignuser")?>");

        $('#modal').data('GroupID', GroupID);
        $('#modal').data('group_cd', group_cd);
        $('#modal').data('group_descs', group_descs);
        $('#modal').modal('show');
    })
    
</script>