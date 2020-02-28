
   
    <!-- BEGIN VENDOR CSS-->
    
   <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/charts/chartist.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/charts/chartist.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/charts/chartist-plugin-tooltip.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/colors/palette-gradient.css')?>">
  

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <!-- END VENDOR CSS-->
   
   
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css')?>">
    <!-- END Custom CSS-->

     <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.css')?>">
     <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
</style>

    <div class="app-content content">
      <div class="content-wrapper">
      <div>
        
      </div>
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
              <br><br>
              <h5 class="content-header-title">Good Afternoon, Tenant...</h5>
            </div>

            <div class="content-header-right col-md-6 col-12 mb-2">
              <br><br>
              <h5 class="content-header-title" >
              <!-- tes -->
              <span id="txtTime" class="pull-right"></span>
              </h5>
            </div>
        </div>
        <div class="content-body">
        <!-- Revenue, Hit Rate & Deals -->
        
       
          <div class="row">
             
              <div class="col-md-12 ">
                <div class="card">
                 
                  <div class="card-content">
                    <div class="card-body">
                      <div id="carousel-example-caption" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carousel-example-caption" data-slide-to="0" class="active"></li>
                          <li data-target="#carousel-example-caption" data-slide-to="1"></li>
                          <li data-target="#carousel-example-caption" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                          <div class="carousel-item active" style="height: 255px;">
                            <img src="<?=base_url('app-assets/images/carousel/06.jpg')?>" class="d-block w-100" style="object-fit: fill;background-size: cover;background-repeat: no-repeat;background-position: 50% 50%;position: fixed;" alt="First slide">
                            <div class="carousel-caption">
                              <h3>First Slide Label</h3>
                              <p>Donut jujubes I love topping I love sweet.</p>
                            </div>
                          </div>
                          <div class="carousel-item" style="height: 255px;">
                            <img src="<?=base_url('app-assets/images/carousel/08.jpg')?>" class="d-block w-100" alt="Second slide">
                            <div class="carousel-caption">
                              <h3>Second Slide Label</h3>
                              <p>Tart macaroon marzipan</p>
                            </div>
                          </div>
                          <div class="carousel-item" style="height: 255px;">
                            <img src="<?=base_url('app-assets/images/carousel/05.jpg')?>" class="d-block w-100" alt="Third slide">
                            <div class="carousel-caption">
                              <h3>Third Slide Label</h3>
                              <p>Pudding sweet pie gummies</p>
                            </div>
                          </div>
                          
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-caption" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carousel-example-caption" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                 <div class="col-xl-4 col-lg-6 col-12">
                      <div class="card pull-up bg-gradient-directional-danger" style="height: 117px !important">
                          <div class="card-header bg-hexagons-danger" >
                              <h4 class="card-title white">Alert</h4>
                              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                              <div class="white">Current month over due: Rp. 99999</div>
                              <div class="white">Total over due: Rp. 99999</div>
                          </div>
                          <div class="card-content collapse show bg-hexagons-danger" style="height: 117px !important">
                              
                          </div>
                      </div>
                  </div>
                  

                  <div class="col-xl-2 col-lg-6 col-12">
                    <div class="card pull-up bg-gradient-x-purple-blue">
                      <div class="card-content">
                          <div class="card-body">
                              <div class="media d-flex">
                                  <div class="align-self-top" >
                                      <i class="icon-eye icon-opacity text-white font-large-4 float-left"></i>
                                      
                                  </div>
                                  <div class="media-body text-white text-right align-self-bottom mt-3">
                                   
                                      <span class="d-block mb-1 font-medium-1">Current Total Ticket </span>
                                      <h1 class="text-white mb-0">687,142</h1>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-2 col-lg-6 col-12">
                    <div class="card pull-up bg-gradient-x-purple-red">
                      <div class="card-content">
                          <div class="card-body">
                              <div class="media d-flex">
                                  <div class="align-self-top">
                                      <i class="icon-eye icon-opacity text-white font-large-4 float-left"></i>
                                  </div>
                                  <div class="media-body text-white text-right align-self-bottom mt-3">
                                      <span class="d-block mb-1 font-medium-1">Current Total Application</span>
                                      <h1 class="text-white mb-0">8654</h1>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-2 col-lg-6 col-12">
                    <div class="card pull-up bg-gradient-x-blue-green">
                      <div class="card-content">
                          <div class="card-body">
                              <div class="media d-flex">
                                  <div class="align-self-top">
                                      <i class="icon-eye icon-opacity text-white font-large-4 float-left"></i>
                                  </div>
                                  <div class="media-body text-white text-right align-self-bottom mt-3">
                                      <span class="d-block mb-1 font-medium-1">Current Total Overtime</span>
                                      <h1 class="text-white mb-0">1562</h1>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xl-2 col-lg-6 col-12">
                    <div class="card pull-up bg-gradient-x-orange-yellow">
                      <div class="card-content">
                          <div class="card-body">
                              <div class="media d-flex">
                                  <div class="align-self-top">
                                      <i class="icon-eye icon-opacity text-white font-large-4 float-left"></i>
                                  </div>
                                  <div class="media-body text-white text-right align-self-bottom mt-3">
                                      <span class="d-block mb-1 font-medium-1">Current Total Billing</span>
                                      <h1 class="text-white mb-0">1562</h1>
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
<!--/ Revenue, Hit Rate & Deals -->
<!-- Utility Usage -->
          <div class="content-body">
            <section id="configuration">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title">Utility Usage</h4>
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
                            
                              <div class="row">
                                <div class="col-md-2" style="padding-right: 0px;">
                                  <div class="card-body card-dashboard" style="padding-right: 0px;">
                                    <div class="skin skin-flat">
                                      <div class="col-md-12 col-sm-12" style="padding-right: 0px;">
                                        <label> Search : </label>
                                        <div class="row col-search" >

                                          <input type="text" name=""><span><button type="button" class="btn btn-outline-warning search" ><i class="ft-search"></i></button></span>
                                         
                                        </div>

                                        <fieldset>
                                          <input type="radio" name="input-radio-3" id="input-radio-5">
                                          <label for="input-radio-5">Radio Button</label>
                                        </fieldset>
                                         <fieldset>
                                          <input type="radio" name="input-radio-3" id="input-radio-6">
                                          <label for="input-radio-6">Radio Button</label>
                                        </fieldset>
                                         <fieldset>
                                          <input type="radio" name="input-radio-3" id="input-radio-7">
                                          <label for="input-radio-7">Radio Button</label>
                                        </fieldset>
                                        <fieldset>
                                          <input type="radio" name="input-radio-3" id="input-radio-8" checked>
                                          <label for="input-radio-8">Radio Button</label>
                                        </fieldset>
                                      </div>
                                    </div>
                                  </div>
                                 
                                </div>
                                <div class="col-md-10">
                                  <div class="card-body card-dashboard">
                                    <div class="row">
                                     <label>Meter ID : </label>
                                        <div class="form-group">
                                          <select class="select2-size-xs form-control" id="xsmall-select">
                                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                              <option value="AK">Alaska</option>
                                              <option value="HI">Hawaii</option>
                                            </optgroup>
                                            <optgroup label="Pacific Time Zone">
                                              <option value="CA">California</option>
                                              <option value="NV">Nevada</option>
                                              <option value="OR" selected>Oregon</option>
                                              <option value="WA">Washington</option>
                                            </optgroup>
                                          </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                     <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="card">
                                          <div class="card-header">
                                             <h4 class="card-title">Electricity</h4>
                                                
                                                <div class="card-content collapse show">
                                              
                                                    <div class="card-body">
                                                        <div id="project-income-chart" class="height-400 BarChartShadow"></div>
                                                    </div>
                                                </div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="card">
                                          <div class="card-header">
                                             <h4 class="card-title">Water</h4>
                                                
                                                <div class="card-content collapse show">
                                              
                                                    <div class="card-body">
                                                        <div id="project-income-chart" class="height-400 BarChartShadow"></div>
                                                    </div>
                                                </div>
                                          </div>
                                        </div>
                                      </div>


                                      <div class="col-xl-4 col-lg-6 col-md-12">
                                        <div class="card">
                                          <div class="card-header">
                                             <h4 class="card-title">Gas</h4>
                                                
                                                <div class="card-content collapse show">
                                              
                                                    <div class="card-body">
                                                        <div id="project-income-chart" class="height-400 BarChartShadow"></div>
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
                      </div>
                  </div>
              </div>
            </section>
          </div>
<!-- / Utility Usage -->
<!-- Tenant Overview -->
        <div class="content-body">
          <section id="configuration">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Tenant Overview</h4>
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
                        
                          <div class="row">
                            <div class="col-md-2" style="padding-right: 0px;">
                              <div class="card-body card-dashboard" style="padding-right: 0px;">
                                <div class="skin skin-flat">
                                  <div class="col-md-12 col-sm-12" style="padding-right: 0px;">
                                    <div class="row col-search" >
                                      <input type="text" name=""><span><button type="button" class="btn btn-outline-warning search" ><i class="ft-search"></i></button></span>
                                      <!-- <button type="button" class="btn btn-outline-warning mr-1"  style="width: 2px;"><i class="ft-bookmark"></i></button> -->
                                    </div>

                                    <fieldset>
                                      <input type="radio" name="input-radio-4" id="input-radio-1">
                                      <label for="input-radio-1">Radio Button</label>
                                    </fieldset>
                                     <fieldset>
                                      <input type="radio" name="input-radio-4" id="input-radio-2">
                                      <label for="input-radio-2">Radio Button</label>
                                    </fieldset>
                                     <fieldset>
                                      <input type="radio" name="input-radio-4" id="input-radio-3">
                                      <label for="input-radio-3">Radio Button</label>
                                    </fieldset>
                                    <fieldset>
                                      <input type="radio" name="input-radio-4" id="input-radio-4" checked>
                                      <label for="input-radio-4">Radio Button</label>
                                    </fieldset>
                                  </div>
                                </div>
                              </div>
                             
                            </div>
                            <div class="col-md-10">
                               <div class="card-body card-dashboard">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                        </tr>
                                        <tr>
                                            <td>Garrett Winters</td>
                                            <td>Accountant</td>
                                            <td>Tokyo</td>
                                            <td>63</td>
                                            <td>2011/07/25</td>
                                            <td>$170,750</td>
                                        </tr>
                                        <tr>
                                            <td>Ashton Cox</td>
                                            <td>Junior Technical Author</td>
                                            <td>San Francisco</td>
                                            <td>66</td>
                                            <td>2009/01/12</td>
                                            <td>$86,000</td>
                                        </tr>
                                        <tr>
                                            <td>Cedric Kelly</td>
                                            <td>Senior Javascript Developer</td>
                                            <td>Edinburgh</td>
                                            <td>22</td>
                                            <td>2012/03/29</td>
                                            <td>$433,060</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>
                                </table>
                              </div>
                            </div>
                          </div>
                         
                      </div>
                  </div>
              </div>
          </div>
          </section>
        </div>
<!--/ Tenant Overview -->

        </div>
        </div>
     
    <!-- ////////////////////////////////////////////////////////////////////////////-->


    <footer class="footer footer-static footer-light navbar-shadow">
      <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2018  &copy; Copyright <a class="text-bold-800 grey darken-2" href="#">ThemeSelection</a></span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
          
          
          
        </ul>
      </div>
    </footer>

    <!-- BEGIN VENDOR JS-->
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/ui/jquery.sticky.js')?>"></script>
  
    <script src="<?=base_url('app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')?>" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN CHAMELEON  JS-->
    <script src="<?=base_url('app-assets/js/core/app-menu.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/js/core/app.js')?>" type="text/javascript"></script>
    <!-- END CHAMELEON  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="<?=base_url('app-assets/js/scripts/pages/dashboard-analytics.js')?>" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script src="<?=base_url('app-assets/js/scripts/tables/datatables/datatable-basic.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatables/datatable-basic.js')?>" type="text/javascript"></script>
     <script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('app-assets/vendors/js/charts/chartist.min.js')?>" type="text/javascript"></script>

     <script src="<?=base_url('app-assets/js/scripts/charts/chartist/bar/vertical-bar.js')?>" type="text/javascript')?>"></script>

    <script type="text/javascript">
    window.onload = function() { jam(); }

 function jam() {
  var e = document.getElementById('txtTime'),
  d = new Date(), h, m, s;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());
  em = d.toLocaleDateString("en-en", {month: "long"});

  e.innerHTML = d.getDate() + ' ' + em + ' ' + d.getFullYear() + ' ' + h +':'+ m +':'+ s;

  setTimeout('jam()', 1000);
 }

 function set(e) {
  e = e < 10 ? '0'+ e : e;
  return e;
 }

 </script>
