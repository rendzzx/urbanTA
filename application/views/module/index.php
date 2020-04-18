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
                                <h4 class="card-title">Module Entry</h4>
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
                                        <table id="tblmodule" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>Module Code</th>
                                                <th>Module Description</th>
                                                <th>Module Group Code</th>
                                                <th>Dashboard URL</th>
                                                <th>Icon Class</th>
                                                <th>Button Class</th>
                                                <th>Status</th>
                                                <th>Order Seq</th>
                                                <!-- <th></th> -->
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
        var tblmodule = $('#tblmodule').DataTable({
            "responsive":true,
            "ajax" : {
                "url" : "<?php echo base_url('C_module/getTable');?>",
                "dataSrc": "",
                "type": "POST"
            },
            "order": [[ 8, "asc" ]],
            "columns": [
                {data:"module_cd"},
                {data:"module_cd"},
                {data:"module_descs"},
                {data:"module_group_cd"},
                {data:"dashboard_url"},
                {data:"IconClass",
                    render: function (data, type, row) {
                        return '<i class="'+data+'"></i>&nbsp;'+data;
                    }
                },
                {data:"ButtonClass",
                    render: function (data, type, row) {
                        return '<button type="button" class="btn btn-sm btn-bg-gradient-x-'+data+'">'+data+'</button>';
                    }
                },
                {data:"status",searchable:false,
                    render: function (data, type, row) {
                        var status;
                        if(data){
                            status = 'Active';
                        }else{
                            status = 'Not Active';
                        }
                        return status;
                    }
                },
                {data:"OrderSeq"},
                {data:"rowID", visible:false},
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar module">frtip',
            "responsive": {
                details: {
                    type: 'column',
                    target: 8
                }
            }
        });

        $("div.module").html(
            '<button id="addmodule" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
            '<button id="editmodule" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
            '<button id="deletemodule" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>&nbsp;'
        );

        tblmodule.on( 'order.dt search.dt', function () {
            tblmodule.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        tblmodule.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {

                tblmodule.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#addmodule').click(function(){
            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Module Entry');
            $('#modalbody').load("<?php echo base_url("C_module/addnew");?>");

            $('#modal').data('rowID', 0);
            $('#modal').modal('show');
        })

        $('#editmodule').click(function(){
            var rows = tblmodule.rows('.selected').indexes();
            if (rows.length < 1) {
                Swal.fire("warning",'Please select a row',"warning");
                return;
            } 
            var data = tblmodule.rows(rows).data();
            var rowID = data[0].rowID;

            var site_url = '<?php echo base_url("C_module/addnew/")?>'+rowID;
            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Menu Edit');
            $('#modalbody').load(site_url);

            $('#modal').data('rowID', rowID);
            $('#modal').modal('show');
        })

        $('#deletemodule').click(function(){
            var rows = tblmodule.rows('.selected').indexes();
            if (rows.length < 1) {
                Swal.fire("warning",'Please select a row',"warning");
                return;
            } 

            var data = tblmodule.rows(rows).data();
            var id = data[0].rowID;

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
                url : "<?php echo base_url('C_module/delete');?>",
                type:"POST",
                data: { id: id },
                dataType:"json",
                success:function(event, data){
                    if (event.Error == false) {
                        Swal.fire("success",event.Message,"success");
                        block(false,'.content-body');
                        tblmodule.ajax.reload(null,true); 
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