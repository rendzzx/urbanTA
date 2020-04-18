<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.datatables.min.css')?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.css">
    
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/validation/jquery.validate.min.js'); ?>"></script>
<!-- link -->

<!-- content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Module Assign</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table id="tblassignmodule" class="table table-hover table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Group Code</th>
                                                <th>Group Description</th>
                                                <!-- <th>Dashboard</th> -->
                                            </tr>
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

<!-- content -->

<!-- js -->
    <script type="text/javascript">
        var tblassignmodule = $('#tblassignmodule').DataTable( {
            "ajax" : {
                "url" : "<?php echo base_url('C_module/getTableGroup');?>",
                "dataSrc": "",
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

        tblassignmodule.on( 'order.dt search.dt', function () {
            tblassignmodule.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        tblassignmodule.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tblassignmodule.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#assign').click(function(){
            var rows = tblassignmodule.rows('.selected').indexes();
            if (rows.length < 1) {
                Swal.fire("warning",'Please select a row',"warning");
                return;
            } 
            var data = tblassignmodule.rows(rows).data();
            var GroupID = data[0].GroupID;
            var group_cd = data[0].group_cd;
            var group_descs = data[0].group_descs;

            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            // $('#modaldialog').addClass('modal-lg');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit User');
            $('#modalbody').load("<?php echo base_url("C_module/assignuser")?>");

            $('#modal').data('GroupID', GroupID);
            $('#modal').data('group_cd', group_cd);
            $('#modal').data('group_descs', group_descs);
            $('#modal').modal('show');
        })
</script>