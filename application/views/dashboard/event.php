<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.css">
    
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/charts/chart.min.js')?>"></script>

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
                    <h2 class="content-header-title">Dashboard</h2>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Event</h4>
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
                                        <!-- total event -->
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <div class="card" id="card-totaluser">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h4 class="card-title">Total Event</h4>
                                                                    <div id="totaluser" class="height-150 donutShadow">
                                                                        <strong style="font-size: 30px;">
                                                                            <?= $totalevent; ?>
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
                                        <!-- total event -->
                                        
                                        <!-- total soon -->
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <div class="card" id="card-userattend">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h4 class="card-title">Comingsoon Event</h4>
                                                                    <div id="userattend" class="height-150 donutShadow">
                                                                        <strong style="font-size: 30px;">
                                                                            <?= $totalsoon; ?>
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
                                        <!-- total soon -->
                                        
                                        <!-- total cancle -->
                                            <div class="col-xl-4 col-lg-6 col-md-12">
                                                <div class="card" id="card-notattend">
                                                    <div class="card-content">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <h4 class="card-title">Canceled Event</h4>
                                                                    <div id="usernotattend" class="height-150 donutShadow">
                                                                        <strong style="font-size: 30px;">
                                                                            <?= $totalcancle; ?>
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
                                        <!-- total cancle -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Attend Per Event</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body chartjs">
                                    <div class="height-500">
                                        <canvas id="attendperevent"></canvas>
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
        $(window).on("load", function(){
            var ctx = $("#attendperevent");
            var chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Event'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        gridLines: {
                            color: "#f3f3f3",
                            drawTicks: false,
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Attended'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'User Attend per Event'
                }
            };
            var chartData = {
                labels: <?= json_encode(countDayOfMonth()); ?>,
                datasets: [
                    {
                        label: "This Month",
                        data: [1,2,3,4,5,5,6,7,8,5,3,4,5,4,3,2,4,4,3,2,34,5,54,32],
                        fill: false,
                        borderDash: [5, 5],
                        borderColor: "#9C27B0",
                        pointBorderColor: "#9C27B0",
                        pointBackgroundColor: "#FFF",
                        pointBorderWidth: 2,
                        pointHoverBorderWidth: 2,
                        pointRadius: 4,
                    }
                ]
            };
            var config = {
                type: 'line',
                options : chartOptions,
                data : chartData
            };
            var lineChart = new Chart(ctx, config);
        });
    </script>
<!-- js -->