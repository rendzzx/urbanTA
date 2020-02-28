<!--link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<!-- link -->

<!-- style -->
    <style type="text/css">
        #loader{
            width:80%;
            height:100%;
            position:fixed;
            left: 9%;
            top: 1%;
            z-index: 99999;
            background:url("../img/loading.gif") no-repeat center center     
        }
    </style>
<!-- style -->

<!-- content -->
    <div id="loader" class="loader" hidden="true"></div>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before" style="height: 150px !Important"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                  <br><br>
                  <h3 class="content-header-title"></h3>
                </div>
                <!-- breadcrumbs -->
                  <!-- <div class="content-header-right col-md-8 col-12 mb-2">
                    <br>
                        <div class="breadcrumbs-top float-md-right">
                            <div class="breadcrumb-wrapper mr-1">
                                <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Setting Menu</a>
                                </li>
                                <li class="breadcrumb-item active" class="nav-link nav-link-expand">Web Menu
                                </li>
                                </ol>
                            </div>
                        </div>
                    </div> -->
                <!-- breadcrumbs -->
            </div>
            <div class="content-body">
                <!-- <section id="tblnewsfeed"> -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Assign Meter</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>       
                                                <th class="sorting_asc">No.</th>
                                                <th>Meter Type</th>
                                                <th>Description</th>
                                                <th>Meter ID</th>
                                                <th>Lot No</th>
                                                <th>Debtor Acct</th>
                                                <th>% Apportion</th>
                                                <th>Capacity (KVA)</th>
                                                <th>Capacity Limit (KVA)</th>
                                                <th hidden="true">line no</th>
                                                <th hidden="true">rowid</th>
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
                <!-- </section> -->
            </div>
        </div>
    </div>
<!-- end content -->

<!-- link -->
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/pickers/daterange/daterangepicker.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
    <script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>
<!-- end link -->

<!-- script -->
    <script type="text/javascript">

        function block(boelan){
            var block_ele = $('#frmEditor')
            if (boelan==true) {
                $(block_ele).block({
                    message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                    fadeIn: 1000,
                    fadeOut: 1000,
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: '10px 15px',
                        color: '#fff',
                        width: 'auto',
                        backgroundColor: '#333',
                        marginLeft : 'auto'
                    }
                });
            }
            else{
                $(block_ele).unblock()
            }
        }

        //GET DATA TABLE
        var tblnewsfeed; 
        var tblnewsfeed = $('#tblnewsfeed').DataTable({
            
            "ajax" : {
                "url" : "<?php echo base_url('c_assign_meter/getTable');?>",
                "type": "POST"
            },
            "columns": [
                { data: "row_number", width:'1px', searchable:false,
                    render: function (data, type, row) {
                        var row_number = row.row_number
                        return row_number + '.'
                    }
                },
                {data:"meter_cd" },
                {data:"descs" },
                {data:"meter_id"},
                {data:"lot_no"},
                {data:"debtor_acct"},
                {data:"apportion"},
                {data:"capacity"},
                {data:"capacity_limit"},
                {data:"line_no", visible:false},
                {data:"rowID", visible:false},

            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar newsfeed">frtip',
            "responsive": {
                details: {
                    type: 'column',
                    target: 8
                }
            }
        });

        // ADDING BUTTON
        $("div.newsfeed").html(
            '<button id="editnewsfeed" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
        );


        // SELECT ROW
        tblnewsfeed.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {

                tblnewsfeed.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        $('#editnewsfeed').click(function(){
            var rows = tblnewsfeed.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 
            var data = tblnewsfeed.rows(rows).data();
            var entity      = "<?php echo $this->session->userdata('Tsentity'); ?>";
            var project     = "<?php echo $this->session->userdata('Tsproject'); ?>";
            var meter_cd    = data[0].meter_cd;
            var meter_id    = data[0].meter_id;
            var line_no     = data[0].line_no;
            var rowID       = data[0].rowID;

            // alert(line_no);

            var site_url = '<?php echo base_url("c_assign_meter/edit/")?>';
            // window.location.href= site_url;    

            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit Meter');
            $('#modalbody').load(site_url);

            $('#modal').data('meter_cd', meter_cd);
            $('#modal').data('meter_id', meter_id);
            $('#modal').data('line_no', line_no);
            $('#modal').data('entity', entity);
            $('#modal').data('project', project);
            $('#modal').data('rowID', rowID);

            $('#modal').modal('show');
        })
    </script>
<!-- end script