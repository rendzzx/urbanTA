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
                                <h4 class="card-title">All Event</h4>
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
                                                <th>Status</th>
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
                "url" : "<?php echo base_url('C_event/getTableAll');?>",
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
                {data:"status",
                    render:function(data, type, row) {
                        var date = new Date(row.event_date);
                        var now = new Date();
                        now.setHours(0,0,0,0);
                        if (row.status == '0') {
                            return '<span class="badge badge-danger">Canceled</span>'
                        }
                        else if(date < now){
                            return '<span class="badge badge-warning">Expired</span>'
                        }
                        else if(isToday(date)){
                            return '<span class="badge badge-primary">on going</span>'
                        }
                        else{
                            return '<span class="badge badge-success">up cooming</span>'
                        }
                    }
                },
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar tblevent">frtip'
        });

        $("div.tblevent").html(
            '<button id="add" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
            '<button id="edit" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
            '<button id="delete" class="btn btn-danger pull-up" style="margin-top: 5px">Cancle</button>&nbsp;'
        );

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

        $('#add').click(function(){
            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaldialog').addClass('modal-lg');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Event Entry');
            $('#modalbody').load("<?php echo base_url("C_event/addnew");?>");
            $('#modal').data('id', 0);
            $('#modal').modal('show');
        })

        $('#edit').click(function(){
            var rows = tblevent.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 
            var data = tblevent.rows(rows).data();
            var id = data[0].event_id;

            var site_url = '<?php echo base_url("C_event/addnew/")?>'+id;

            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaldialog').addClass('modal-lg');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Event Edit');
            $('#modalbody').load(site_url);

            $('#modal').data('id', id);
            $('#modal').modal('show');
        })

        $('#delete').click(function(){
            var rows = tblevent.rows('.selected').indexes();
            if (rows.length < 1) {
                Swal.fire("warning",'Please select a row',"warning");
                return;
            } 

            var data = tblevent.rows(rows).data();
            var id = data[0].event_id;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, cancle it!'
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
                url : "<?php echo base_url('C_event/delete');?>",
                type:"POST",
                data: { id: id },
                dataType:"json",
                success:function(event, data){
                    if (event.Error == false) {
                        Swal.fire("success",event.Message,"success");
                        block(false,'.content-body');
                        tblevent.ajax.reload(null,true); 
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

        const isToday = (someDate) => {
            const today = new Date()
            return someDate.getDate() == today.getDate() && someDate.getMonth() == today.getMonth() && someDate.getFullYear() == today.getFullYear();
        }
    </script>
<!-- js -->