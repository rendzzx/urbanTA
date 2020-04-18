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
                                <h4 class="card-title">Today's Event</h4>
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
                                        <table id="tblevent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>Event Id</th>
                                                <th>Event Name</th>
                                                <th>Date</th>
                                                <th>Location</th>
                                                <th>Latitude</th>
                                                <th>Longitude</th>
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
        var tblevent = $('#tblevent').DataTable( {
            "responsive":true,
            "ajax" : {
                "url" : "<?php echo base_url('C_event/getTableCan');?>",
                "dataSrc": "",
                "type": "POST"
            },
            "columns": [
                {data:'event_id'},
                {data:'event_id'},
                {data:'event_name'},
                {data:'event_date',
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
                {data:"event_location"},
                {data:"event_latitude"},
                {data:"event_longitude"},
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar tblevent">frtip'
        });

        tblevent.on( 'order.dt search.dt', function () {
            tblevent.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        tblevent.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {

                tblevent.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
    </script>
<!-- js -->