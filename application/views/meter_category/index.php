<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/pickers/daterange/daterangepicker.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/pickers/daterange/daterange.css')?>">
<!-- end link -->

<!-- content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>

            <div class="content-header row">
              <div class="content-header-left col-md-6 col-12 mb-2">
                    <br><br>
                    <h3 class="content-header-title"><?php echo $projectName; ?></h3>
              </div><!-- end content header left -->
            </div><!-- end content header -->
          
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Meter Category</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div> <!-- end heading element -->
                            </div> <!-- end card header -->
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table id="tblcategory" class="table table-striped table-bordered base-style table-hover dataTables" cellspacing="0">  
                                        <thead> 
                                            <tr>
                                                <th>No.</th>          
                                                <!-- <th class="sorting_asc">Action</th> -->
                                                <th>Category</th>
                                                <th>Name</th>
                                                <th>Capacity Rate</th>
                                                <th>Calculation Method</th>
                                                <th>Capacity Limit</th>
                                                <th>usage Limit</th>
                                                <th>Dicount Rate</th>
                                                <th>OPR Rate</th>
                                                <th>Min Usage/h</th>
                                                <th>Portion1 %</th>
                                                <th>Portion2 %</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div> <!-- end card body -->
                            </div> <!-- end card content -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div><!-- end row -->
            </div> <!-- end content body -->
        </div> <!-- end content wrapper -->
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
        var tblcategory;
        $(document).ready(function () {
            var tblcategory = $('#tblcategory').DataTable( {
                "scrollX": true,
                "ajax":{
                    "url":"<?php echo base_url('c_meter_category/getTable');?>",
                    "type":"POST"
                },
                "columns": [
                    {data:"row_number",searchable:false,
                         render: function (data, type, row) {
                            var row_number = row.row_number
                            return row_number + '.'
                        }},
                    {data:"category_cd"},
                    {data:"category_name",width:200},
                    {data:"capacity_rate"},
                    {data:"calculation_method"},
                    {data:"capacity_given_flag"},
                    {data:"limit_usage_flag"},
                    {data:"disc_percent"},
                    {data:"opr_percent"},
                    {data:"min_usage_hour"},
                    {data:"portion1"},
                    {data:"portion2"},
                ], 
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                },
                "dom": '<"toolbar tblcategory">frtip',
            });

            $("div.tblcategory").html(
                '<button id="add" class="btn btn-primary pull-up">Add</button>&nbsp;'+
                '<button id="edit" class="btn btn-info pull-up">Edit</button>&nbsp;'+
                '<button id="delete" class="btn btn-danger pull-up>Delete</button>'
            );

            tblcategory.on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    tblcategory.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
            
            $('#add').click(function(){
                // block(true,'#modalbody');
                // $('#modalbody').html("");
                // $('#modalheader').addClass('bg-primary white');
                // $('#modaldialog').addClass('modal-lg');
                // $('#modaltitle').addClass('white');
                // $('#modal').modal({backdrop: 'static', keyboard: false})  
                // $('#modaltitle').html('Add Overtime');
                // $('#modalbody').load("<?php echo base_url("c_overtime/add");?>");
                // var dd = $('#ov_date').val();
                // $('#modal').data('ovdate', dd);
                // $('#modal').data('Ot_Id', 0).modal('show');
                // $('#modal').modal('show');

                var site_url = '<?php echo base_url("c_meter_category/add/")?>'+0;
                window.location.href= site_url;
            });

            $('#edit').click(function(){
                var rows = tblcategory.rows('.selected').indexes();
                if (rows.length < 1) {
                    swal("Information",'Please select a row',"warning");
                    return;
                } 
                var data = tblcategory.rows(rows).data();
                // console.log(data);
                var category_cd = data[0].category_cd;

                var site_url = '<?php echo base_url("c_meter_category/add/")?>'+category_cd;
                window.location.href= site_url;   
            })

            $('#delete').click(function(){
                var category_cd = data[0].category_cd;
                var rows = tblcategory.rows('.selected').indexes();
                if (rows.length < 1) {
                    swal("Information",'Please select a row',"warning");
                    return;
                } 
                $.ajax({
                    url : "<?php echo base_url('c_meter_category/delete');?>",
                    type:"POST",
                    data: { category_cd: category_cd },
                    dataType:"json",
                    success:function(event, data){
                            // BootstrapDialog.alert(event.Pesan);
                            swal("Information",event.Pesan,"warning");
                            $('#modal').modal('hide');
                            tblnewsfeed.ajax.reload(null,true); 
                    },             
                    error: function(jqXHR, textStatus, errorThrown){        
                        // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");
                    }
                });
            });
        });

        function block(boelan,div){
                var block_ele = $(div);
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
    </script>
<!-- end script -->