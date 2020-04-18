<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.datatables.min.css')?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.css">
    
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.js"></script>
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
                                <h4 class="card-title">User</h4>
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
                                    <div class="table-responsive">
                                        <table id="tbluser" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>User Id</th>
                                                <th>Employee Id</th>
                                                <th>email</th>
                                                <th hidden>password</th>
                                                <th>name</th>
                                                <th>Group</th>
                                                <th>Handphone</th>
                                                <th>Agent ID</th>
                                                <th>Debtor ID</th>
                                                <th>Address</th>
                                                <th>Gender</th>
                                                <th>Status</th>
                                                <th>NIK</th>
                                                <th>NPWP</th>
                                                <th>Mandiri</th>
                                                <th>Division</th>
                                                <th>Postition</th>
                                                <th>Allowance</th>
                                                <th>Base Salary</th>
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
    </div>
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        var tbluser = $('#tbluser').DataTable( {
            "responsive":true,
            "ajax" : {
                "url" : "<?php echo base_url('C_user/getTable');?>",
                "dataSrc": "",
                "type": "POST"
            },
            "columns": [
                {data:'userID'},
                {data:'userID'},
                {data:'employee_id'},
                {data:"email"},
                {data:"password", visible:false},
                {data:"name"},
                {data:"Group_Cd"},
                {data:"handphone"},
                {data:"agent_cd"},
                {data:"debtor_acct"},
                {data:"address"},
                {data:"gender"},
                {data:"status_active",
                    render:function(data, type, row) {
                        if (data == 'Y') {
                            return '<span class="badge badge-danger">Not Active</span>'
                        }
                        else{
                            return '<span class="badge badge-success">Active</span>'
                        }
                    }
                },
                {data:"nik"},
                {data:"npwp"},
                {data:"bank_acct"},
                {data:"division_name"},
                {data:"postition_name"},
                {data:"allowance"},
                {data:"base_salary"},
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar group">frtip'
        });

        tbluser.on( 'order.dt search.dt', function () {
            tbluser.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        $("div.group").html(
            '<button id="add" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
            '<button id="edit" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
            '<button id="delete" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>&nbsp;'
        );

        tbluser.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else{
                tbluser.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#add').click(function(){
            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaldialog').addClass('modal-lg');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Employee Entry');
            $('#modalbody').load("<?php echo base_url("C_user/addnew");?>");
            $('#modal').data('id', 0);
            $('#modal').modal('show');
        })

        $('#edit').click(function(){
            var rows = tbluser.rows('.selected').indexes();
            if (rows.length < 1) {
                Swal.fire("warning",'Please select a row',"warning");
                return;
            } 
            var data = tbluser.rows(rows).data();
            var id = data[0].userID;
            var employee_id = data[0].employee_id;

            var site_url = '<?php echo base_url("C_user/addnew/")?>';

            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaldialog').addClass('modal-lg');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Menu Edit');
            $('#modalbody').load(site_url);

            $('#modal').data('id', id);
            $('#modal').data('employee_id', employee_id);
            $('#modal').modal('show');
        })


        $('#delete').click(function(){
            var rows = tbluser.rows('.selected').indexes();
            if (rows.length < 1) {
                Swal.fire("warning",'Please select a row',"warning");
                return;
            } 

            var data = tbluser.rows(rows).data();
            var id = data[0].userID;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then((result) => {
                if (result.value) {
                    Delete(id);
                }else{
                    block(false,'.content-body');
                }
            })
        })

        function Delete(id) {
           block(true,'.content-body');
            $.ajax({
                url : "<?php echo base_url('C_user/delete');?>",
                type:"POST",
                data: { id: id },
                dataType:"json",
                success:function(event, data){
                    if (event.Error == false) {
                        Swal.fire("success",event.Message,"success");
                        block(false,'.content-body');
                        tbluser.ajax.reload(null,true); 
                    }
                    else{
                        Swal.fire("Information",'error Save : '+event.Message,"warning");
                        block(false,'.content-body');
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){        
                    Swal.fire("Information",textStatus+' Save : '+errorThrown,"warning");
                    block(false,'.content-body');
                }
            });
        }
    </script>
<!-- js -->