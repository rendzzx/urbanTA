<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.css">
    
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?= base_url('app-assets/vendors/js/charts/Chart.bundle.min.js')?>"></script>

    <style>
        #card-totaluser{
            height: 10rem;
            border-style:solid;
            border-width: 2px 2px 2px 10px;
            border-color: #5E66E5;
            border-radius: 10px;
        }
        #card-userattend{
            height: 10rem;
            border-style:solid;
            border-width: 2px 2px 2px 10px;
            border-color: #0FB365;
            border-radius: 10px;
        }
        #card-notattend{
            height: 10rem;
            border-style:solid;
            border-width: 2px 2px 2px 10px;
            border-color: #FF2133;
            border-radius: 10px;
        }
    </style>
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
                                <h4 class="card-title">Dashboard</h4>
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
                                    <!-- total employee -->
                                    <div class="row">

                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <div class="card" id="card-totaluser">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h4 class="card-title">Total Employee</h4>
                                                                <div id="totaluser" class="height-150 donutShadow">
                                                                    <strong style="font-size: 30px;">
                                                                        <?= $totaluser; ?>
                                                                    </strong>
                                                                </div>
                                                            </div>
                                                            <div class="col text-right">
                                                                <i class="la la-user" style="font-size: 130px;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <div class="card" id="card-userattend">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h4 class="card-title">Total employee attended</h4>
                                                                <div id="userattend" class="height-150 donutShadow">
                                                                    <strong style="font-size: 30px;">
                                                                        <?= $userAttend; ?>
                                                                    </strong>
                                                                </div>
                                                            </div>
                                                            <div class="col text-right">
                                                                <i class="la la-user-plus" style="font-size: 130px;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-4 col-lg-6 col-md-12">
                                            <div class="card" id="card-notattend">
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h4 class="card-title">Employee not attended</h4>
                                                                <div id="usernotattend" class="height-150 donutShadow">
                                                                    <strong style="font-size: 30px;">
                                                                        <?= $notAttend; ?>
                                                                    </strong>
                                                                </div>
                                                            </div>
                                                            <div class="col text-right">
                                                                <i class="la la-user-times" style="font-size: 130px;"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- total employee -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Employee Attend Today</h4>
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
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table id="tblattend" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                <thead>            
                                                    <th class="sorting_asc">No.</th>
                                                    <th>Attend Id</th>
                                                    <th>Employee Id</th>
                                                    <th>Employee</th>
                                                    <th>Day</th>
                                                    <th>Hour IN</th>
                                                    <th>Hour OUT</th>
                                                    <th>Location IN</th>
                                                    <th>Location OUT</th>
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
    </div>
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        var tblattend = $('#tblattend').DataTable( {
            "responsive":true,
            "ajax" : {
                "url" : "<?php echo base_url('C_attandance/getAttend');?>",
                "dataSrc": "",
                "type": "POST"
            },
            "columns": [
                {data:'attend_id'},
                {data:'attend_id'},
                {data:'employee_id'},
                {data:'name'},
                {data:'day',
                    render: function (data) {
                        var monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
                        var date = new Date(data);
                        // return data;
                        var d = date.getDate();
                        var m = monthNames[date.getMonth()];
                        var y = date.getFullYear();
                        return d +' '+ m +' '+ y;
                    }
                },
                {data:"hour_in",
                    render: function (data) {
                        var date = new Date(data);
                        var hr = date.getHours();
                        var mi = date.getMinutes();
                        var se = date.getSeconds();
                        return hr +':'+ mi +':'+ se;
                    }
                },
                {data:"hour_out",
                    render: function (data) {
                        var date = new Date(data);
                        var hr = date.getHours();
                        var mi = date.getMinutes();
                        var se = date.getSeconds();
                        return hr +':'+ mi +':'+ se;
                    }
                },
                {data:"latitude_in",
                    render: function (data,type,row) {
                        return 'Lat : '+row.latitude_in +' Lon : '+ row.longitude_in;
                    }
                },
                {data:"latitude_out",
                    render: function (data,type,row) {
                        return 'Lat : '+row.latitude_out +' Lon : '+ row.longitude_out;
                    }
                }
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar group">rtip'
        });

        tblattend.on( 'order.dt search.dt', function () {
            tblattend.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    </script>
<!-- js -->