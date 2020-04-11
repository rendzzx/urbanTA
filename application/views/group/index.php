<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/dataTables/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/dataTables/extensions/responsive.datatables.min.css')?>">
    <script type="text/javascript" src="<?=base_url('app-assets/js/tables/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/js/tables/dataTables.responsive.min.js')?>"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/sweetalert/sweetalert.css')?>">
<!-- link -->

<!-- content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <br><br>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Group Entry</h4>
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
                                        <table id="tblgroup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th hidden="1">Group Id</th>
                                                <th>Group Code</th>
                                                <th>Group Description</th>
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
        var tblgroup = $('#tblgroup').DataTable( {
            "responsive":true,
            "ajax" : {
                "url" : "<?php echo base_url('C_group/getTable');?>",
                "dataSrc": "",
                "type": "POST"
            },
            "columns": [
                {data:'GroupID'},
                {data:"GroupID", visible:false},
                {data:"group_cd"},
                {data:"group_descs"}
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar group">frtip',
            "responsive": {
                details: {
                    type: 'column',
                    target: 8
                }
            }
        });

        tblgroup.on( 'order.dt search.dt', function () {
            tblgroup.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        $("div.group").html(
            '<button id="addgroup" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
            '<button id="editgroup" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
            '<button id="deletegroup" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>&nbsp;'
        );

        tblgroup.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            }
            else{
                tblgroup.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        $('#addgroup').click(function(){
            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Group Entry');
            $('#modalbody').load("<?php echo base_url("c_group/addnew");?>");
            $('#modal').data('GroupID', 0);
            $('#modal').modal('show');
        })


        $('#editgroup').click(function(){
            var rows = tblgroup.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 
            var data = tblgroup.rows(rows).data();
            var groupID = data[0].GroupID;

            var site_url = '<?php echo base_url("c_group/addnew/")?>'+groupID;

            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Menu Edit');
            $('#modalbody').load(site_url);

            $('#modal').data('groupID', groupID);
            $('#modal').modal('show');
        })


        $('#deletegroup').click(function(){
            var rows = tblgroup.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 

            var data = tblgroup.rows(rows).data();
            var id = data[0].GroupID;

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
                        // Delete(id);
                    }else{
                        block(false,'.content-body');
                    }
            })
        })

        function Delete(id) {
           block(true,'.content-body');
            $.ajax({
                url : "<?php echo base_url('c_group/delete');?>",
                type:"POST",
                data: { id: id },
                dataType:"json",
                success:function(event, data){
                    // BootstrapDialog.alert(event.Pesan);
                    swal("Information",event.Pesan,"success");
                    block(false,'.content-body');
                    tblgroup.ajax.reload(null,true); 
                },                    
                error: function(jqXHR, textStatus, errorThrown){        
                    // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                    swal("Information",textStatus+' Save : '+errorThrown,"warning");
                    block(false,'.content-body');
                }
            });
        }
    </script>
<!-- js -->