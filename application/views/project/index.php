<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/dataTables/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/dataTables/extensions/responsive.datatables.min.css')?>">
    <script type="text/javascript" src="<?=base_url('app-assets/js/tables/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/js/tables/dataTables.responsive.min.js')?>"></script>
<!-- link -->

<!-- content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before" style="height: 150px !Important"></div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Projects Entry</h3>
                                <a class="heading-elements-toggle">
                                    <i class="la la-ellipsis-v font-medium-3"></i>
                                </a>
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
                                        <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>Entity Code</th>
                                                <th>Project No</th>
                                                <th>Project Name</th>
                                                <th>Status</th>
                                                <th>Location</th>
                                                <th>Priority No</th>
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

<!-- modal -->
    <div id="modal" class="modal fade"  role="dialog" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div id="modalDialog" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h5 class="modal-title" id="modalTitle"></h5>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
<!-- modal -->

<!-- js -->
    <script type="text/javascript">
        var tblnewsfeed; 
        var tblnewsfeed = $('#tblnewsfeed').DataTable({
            "responsive":true,
            "ajax" : {
                "url" : "<?php echo base_url('C_projects/getTable');?>",
                "dataSrc": "",
                "type": "POST"
            },
            "columns": [
                {data:'entity_cd'},
                {data:"entity_cd" },
                {data:"project_no"},
                {data:"project_descs"},
                {data:"project_status_descs"},
                {data:"location"},
                {data:"seq_no"}
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar newsfeed">frtip',
        });

        $("div.newsfeed").html(
            '<button id="addnewsfeed" class="btn btn-primary pull-up disabled" style="margin-top: 5px" disabled>Add</button>&nbsp;'+
            '<button id="editnewsfeed" class="btn btn-info pull-up disabled" style="margin-top: 5px" disabled>Edit</button>&nbsp;'
        );

        tblnewsfeed.on( 'order.dt search.dt', function () {
            tblnewsfeed.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();

        tblnewsfeed.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tblnewsfeed.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#addnewsfeed').click(function(){
            var site_url = '<?php echo base_url("c_projects/form/add")?>';
            window.location.href= site_url;
        })

        $('#editnewsfeed').click(function(){
            var rows = tblnewsfeed.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            }
            var data = tblnewsfeed.rows(rows).data();
            var rowID = data[0].RowID;
            var site_url = '<?php echo base_url("c_projects/form/edit")?>'+ "/" +rowID;
            window.location.href= site_url;
        })
    </script>
<!-- js -->
