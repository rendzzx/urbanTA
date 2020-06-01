<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.css">
    
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/charts/chart.min.js')?>"></script>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.7.15/c3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.16.0/d3.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/c3_renderers.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/d3_renderers.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/tips_data.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/gchart_renderers.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/export_renderers.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pivottable/2.23.0/pivot.min.css">
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
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h2 class="content-header-title">Report</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <div class="row">
                                        <div class="col-6">
                                            <select name="emp_id" id="emp_id" class="select2_demo_1 form-control">
                                                <?=$cmbEMP;?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <button id="btncsv" class="btn btn-primary" style="width: 80%" disabled>Download CSV</button>
                                        </div>
                                    </div>
                                </div>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body" style="min-height: 500px;">
                                    <div id="attendperday">
                                        <h1 align="center" id="messageNotEmp">Please Select Employee</h1>
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
        $(document).ready(function () {
            $('#emp_id').on('change', function (data) {
                var emp_id = $('#emp_id').val();
                if (emp_id == '' || emp_id == null || emp_id == 0) {
                    $('.pvtUi').hide();
                    $('#messageNotEmp').show();
                    $('#btncsv').attr('disabled',true);
                }
                else{
                    $('#messageNotEmp').hide();
                    $('#btncsv').attr('disabled',false);
                    getPivot(emp_id);
                }
            })

            $('#btncsv').on('click', function (data) {
                var emp_id = $('#emp_id').val();
                console.log(emp_id);
                getCsv(emp_id);
            })
        });

        function getPivot(id){
            var derivers = $.pivotUtilities.derivers;
            $.getJSON("<?= base_url('C_attandance/getTableReport/')?>"+ id, function(data) {
                $("#attendperday").pivotUI(data, {
                    rows : ["day"],
                    cols : ["employee_id", "name","email"],
                    vals : ["hour_id"],
                    aggregators: $.pivotUtilities.aggregators,
                    rendererName : "Table",
                    renderers : $.extend(
                        $.pivotUtilities.renderers,
                        $.pivotUtilities.plotly_renderers,
                        $.pivotUtilities.c3_renderers,
                        $.pivotUtilities.export_renderers
                    ),
                });
            });
        }

        function getCsv(id) {
            $.getJSON("<?= base_url('C_attandance/getTableReport/')?>"+ id, function(data) {
            });
        }
    </script>
<!-- js -->