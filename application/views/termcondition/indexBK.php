<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<!-- link  -->

<!-- content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before" style="height: 150px !Important"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                  <br><br>
                  <h3 class="content-header-title">Term & Condition Entry</h3>
                </div>

                <div class="content-header-right col-md-8 col-12 mb-2">
                    <br>
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                                </li>
                                <li class="breadcrumb-item active">
                                    Term & Condition Principle
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <!-- <li><a data-action="expand"><i class="ft-maximize"></i></a></li> -->
                                        <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table id="tblterm" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>File URL</th>
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
<!-- end content -->

<!-- link to js -->
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/select2/select2.full.min.js')?>"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<!-- end link to js -->

<!-- script -->
    <script>
        var tblterm
        tblterm = $('#tblterm').DataTable( {
            "ajax" : {
                "url" : "<?php echo base_url('c_termcondition/getTable');?>",
                "type": "POST"
            },
            "columns": [
                { data: "row_number", width:'1px', searchable:false,
                    render: function (data, type, row) {
                        var row_number = row.row_number
                        return row_number + '.'
                    }
                },
                {data:"file_url", render: function(data, type, row){
                    var call = '<a href="'+data+'" target="blank">'+data+'</a>';
                    return call;
                }}
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar termm">frtip'
        });

        $("div.termm").html(
            '<button id="addterm" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
            '<button id="editterm" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
            '<button id="delterm" class="btn btn-danger pull-up disabled" style="margin-top: 5px">Delete</button>&nbsp;'
        );

        tblterm.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tblterm.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#addterm').click(function(){
            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Add Term & Condition');
            $('#modalbody').load("<?php echo base_url("c_termcondition/addnew");?>");
            $('#modal').data('rowID', 0);
            $('#modal').modal('show');
        });

        $('#editterm').click(function(){
            var rows = tblterm.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 
            var data = tblterm.rows(rows).data();
            var rowID = data[0].rowID;

            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit Trem & Condition');
            $('#modalbody').load("<?php echo base_url("c_termcondition/addnew");?>");
            $('#modal').data('rowID', rowID);
            $('#modal').modal('show');
        });

    </script>
<!-- end script -->