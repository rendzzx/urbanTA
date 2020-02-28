<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/select2/select2.min.css')?>" rel="stylesheet">

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<style type="text/css">
    table.dataTable th.dt-right,
    table.dataTable td.dt-right {
        text-align: right;
        cursor: pointer;
    }

    table.dataTable th.dt-left,
    table.dataTable td.dt-left {
        text-align: left;
        cursor: pointer;
    }

    legend{
        color: #1c84c6 !important;
    }
    .tabs-container > .nav > li > a {

        color: #A7B1C2;
    }
    .blockUI.blockOverlay {
    z-index: 0 !important;
    }
    div#tblnewsfeed_info {
    padding-top: 3em !important;
    }
    div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:last-child {
    padding-right: 0;
    padding-left: 0;
    }
</style>
<style type="text/css">
       #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2">
              <br><br>
              <h5 class="content-header-title">Debtor Enquiry</h5>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title">Choose Project</h4> -->
                                <div class="form-group" >
                                    <div class="row">
                                        <label for="pl_project" class="col-sm-2 control-label" style="padding-left:30px;padding-top: 15px;"> Choose Project</label>
                                        <div class="col-sm-6">
                                            <select name="txtProject" id="txtProject" data-placeholder="Choose a Project..." class="form-control select2" tabindex="2" style="width:250px;">
                                            <!-- <select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="form-control select2" style="width:250px;" tabindex="2"> -->
                                                <option value=""></option>
                                                <?php echo $comboProject;?>                     
                                            </select>
                                            <!-- <button id="search" class="btn blue-bg"><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button> -->
                                        </div>
                                    </div>
                                </div> 

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
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="table-responsive">
                                                    <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                        <thead>
                                                            <th>A/C</th>
                                                            <th>Name</th>
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab-1" aria-expanded="true">Profile</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab-2" aria-expanded="false">Account</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab-3" aria-expanded="false">Aging</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="base-tab4" data-toggle="tab" aria-controls="tab4" href="#tab-5" aria-expanded="false">Reminder</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="base-tab5" data-toggle="tab" aria-controls="tab5" href="#tab-7" aria-expanded="false">Schedule</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="base-tab6" data-toggle="tab" aria-controls="tab6" href="#tab-8" aria-expanded="false">Sales Info</a>
                                                    </li>
                                                    
                                                </ul>

                                                <div class="tab-content px-1 pt-1">
                                                    <div role="tabpanel" class="tab-pane active" id="tab-1" aria-expanded="true" aria-labelledby="base-tab1">
                                                        <div class="row" id="form">
                                                            <div class="col-sm-6">
                                                                <fieldset>
                                                                    <legend style="border-bottom: 1px solid #e5e5e5;">Personal Details</legend>
                                                                   
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Business ID</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="business_id" name="business_id"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Name</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="business_id" name="business_id"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group" hidden="hidden">                                                
                                                                        <label class="col-sm-4">Category</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="category" name="category"/>    
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="category_descs" name="category_descs"/>    
                                                                        </div>                           
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Address</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="add_1" name="add_1"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4"></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="add_2" name="add_2"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4"></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="add_3" name="add_3"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Post Code</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="post_cd" name="post_cd"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Tel No</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="tel_no" name="tel_no"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Fax No.</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="fax_no" name="fax_no"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Handphone</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="handphone" name="handphone"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Sex</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="sex" name="sex"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">E-mail</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="email" name="email"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Birth Date</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="birthdate" name="birthdate"/>    
                                                                        </div>                                                                               
                                                                    </div>
                                                                    <div hidden="hidden">
                                                                        <div class="form-group">                                                
                                                                            <label class="col-sm-4">Married</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="married" name="married"/>    
                                                                            </div>                                                                               
                                                                        </div>
                                                                        <div class="form-group">                                                
                                                                            <label class="col-sm-4">Nationality</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="nationality" name="nationality"/>    
                                                                            </div>                                                                               
                                                                        </div>
                                                                        <div class="form-group">                                                
                                                                            <label class="col-sm-4">Tax Reg.</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="tax_reg" name="tax_reg"/>    
                                                                            </div>                                                                               
                                                                        </div>
                                                                        <div class="form-group">                                                
                                                                            <label class="col-sm-4">Interest</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="interest" name="interest"/>    
                                                                            </div>                                                                               
                                                                        </div>
                                                                        <div class="form-group">                                                
                                                                            <label class="col-sm-4">Credit Limit</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="tax_reg" name="tax_reg"/>    
                                                                            </div>                                                                               
                                                                        </div>
                                                                        <div class="form-group">                                                
                                                                            <label class="col-sm-4">Terms</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="terms" name="terms"/>    
                                                                            </div>                                                                               
                                                                        </div>
                                                                        <div class="form-group">                                                
                                                                            <label class="col-sm-4">Stat. Type</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="stat_type" name="stat_type"/>    
                                                                            </div>                                                                               
                                                                        </div>
                                                                        <div class="form-group">                                                
                                                                            <label class="col-sm-4">Reminder</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="reminder" name="reminder"/>    
                                                                            </div>                                                                               
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </div>                                            
                                                            <div class="col-sm-6">  
                                                                <fieldset>
                                                                    <legend style="border-bottom: 1px solid #e5e5e5;">Company Details</legend>
                                                                    
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Name</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_name" name="comp_name"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Contact</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="contact" name="contact"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Position</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="position" name="position"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Address</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_1" name="comp_add_1"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4"></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_2" name="comp_add_2"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4"></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_3" name="comp_add_3"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Post Code</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_post_cd" name="comp_post_cd"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Tel No.</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_tel_no" name="comp_tel_no"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Fax No.</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_fax_no" name="comp_fax_no"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Home Page</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_homepage" name="comp_homepage"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <legend style="border-bottom: 1px solid #e5e5e5;">Mailing Address</legend>

                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Address</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_1" name="comp_mailadd_1"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4"></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_2" name="comp_mailadd_2"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4"></label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_3" name="comp_mailadd_3"/>    
                                                                        </div>                          
                                                                    </div>
                                                                    <div class="form-group">                                                
                                                                        <label class="col-sm-4">Post Code</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailpost_cd" name="comp_mailpost_cd"/>    
                                                                        </div>                          
                                                                    </div>
                                                                </fieldset>                                          
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-2" aria-labelledby="base-tab2">
                                                        <div class="col-xs-12" id="form">
                                                            <fieldset>
                                                                <legend>A/c Summary</legend>                                                  
                                                                <div class="table-responsive">
                                                                    <table id="tblAccount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                                        <thead>            
                                                                            <th class="sorting_asc">No.</th>
                                                                            <th>Descs</th>
                                                                            <th style="text-align: right;">Amount</th>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-3" aria-labelledby="base-tab3">
                                                        <div class="col-xs-6" id="form">
                                                            <fieldset>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <!-- <div id="tab-4" class="tab-pane">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <fieldset>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="tab-pane" id="tab-5" aria-labelledby="base-tab4">
                                                        <div class="col-xs-12" id="form">
                                                            <fieldset>
                                                                <legend>Reminder</legend>
                                                                <div class="table-responsive">
                                                                    <table id="tblreminder" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                                        <thead>            
                                                                            <th class="sorting_asc">No.</th>
                                                                            <th>Trx Type</th>
                                                                            <th>Doc No</th>
                                                                            <th>Doc Date</th>
                                                                            <th>Due Date</th>
                                                                            <th>Reminder No</th>
                                                                            <th>Reminder Date</th>
                                                                            <th>Forex</th>
                                                                            <th style="text-align: right;">Amount</th>                                                                
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <!-- <div id="tab-6" class="tab-pane">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-xs-6">
                                                                    <fieldset>
                                                                    </fieldset>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    <div class="tab-pane" id="tab-7" aria-labelledby="base-tab5">
                                                        <div class="col-xs-12" id="form">
                                                            <fieldset>
                                                                <legend>Schedule</legend>
                                                                <div class="table-responsive">
                                                                    <table id="tblschedule" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                                        <thead>            
                                                                            <th class="sorting_asc">No.</th>
                                                                            <th>Bill Date</th>
                                                                            <th>Bill Type</th>
                                                                            <th>Trx</th>
                                                                            <th>Description</th>
                                                                            <th>Tax Code</th>
                                                                            <th>Forex</th>
                                                                            <th>Trx Amt</th>
                                                                            <th></th>                                                                
                                                                        </thead>                                                            
                                                                        <tbody>                                                           
                                                                        </tbody>
                                                                        <tfoot style="font-weight: bold;background-color: #f2f2f2">
                                                                            <tr>                                                                   
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th></th>
                                                                                <th></th>                                    
                                                                                <th style="font-weight: bold;"> Total : </th>
                                                                                <th></th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </tfoot> 
                                                                    </table>
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-8" aria-labelledby="base-tab6">
                                                        <div class="col-xs-12" id="form">
                                                            <fieldset>
                                                                <legend>Sales Info</legend>                                                  
                                                                <div class="table-responsive">
                                                                    <table id="tblsalesinfo" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                                        <thead>            
                                                                            <th class="sorting_asc">No.</th>
                                                                            <th>Lot No</th>
                                                                            <th>Sales Date</th>
                                                                            <th>PPJB Date</th>
                                                                            <th>AJB Date</th>
                                                                            <th>Key Collection</th>
                                                                            <th>Selling Price</th>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </fieldset>
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
<!-- <div id="loader" class="loader" hidden="true"></div> -->
<!-- <div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">        
        <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Project</label>
            <div class="col-sm-6">
                <select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="select2" style="width:250px;" tabindex="2">
                    <option value=""></option>
                    <?php echo $comboProject;?>                     
                </select>
                
            </div>
        </div>  
        <div class="form-group">
            <div class="tittle-top pull-right">Debtor Enquiry</div>
        </div>
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-sm-4">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>
                                <th>A/C</th>
                                <th>Name</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="tabs-container">
                    <ul class="nav nav-tabs" style="">
                        <li class="active"><a  data-toggle="tab" href="#tab-1" onclick="fn_tab('tab-1')"> Profile</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2" onclick="fn_tab('tab-2')">Account</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-3" onclick="fn_tab('tab-3')">Aging</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-5" onclick="fn_tab('tab-5')">Reminder</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-7" onclick="fn_tab('tab-7')">Schedule</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-8" onclick="fn_tab('tab-8')">Sales Info</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <fieldset>
                                            <legend>Personal Details</legend>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Business ID</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="business_id" name="business_id"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="business_id" name="business_id"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group" hidden="hidden">                                                
                                                <label class="col-sm-4">Category</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="category" name="category"/>    
                                                </div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="category_descs" name="category_descs"/>    
                                                </div>                           
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Address</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="add_1" name="add_1"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4"></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="add_2" name="add_2"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4"></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="add_3" name="add_3"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Post Code</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="post_cd" name="post_cd"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Tel No</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="tel_no" name="tel_no"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Fax No.</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="fax_no" name="fax_no"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Handphone</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="handphone" name="handphone"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Sex</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="sex" name="sex"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">E-mail</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="email" name="email"/>    
                                                </div>                                                                               
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Birth Date</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="birthdate" name="birthdate"/>    
                                                </div>                                                                               
                                            </div>
                                            <div hidden="hidden">
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Married</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="married" name="married"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Nationality</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="nationality" name="nationality"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Tax Reg.</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="tax_reg" name="tax_reg"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Interest</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="interest" name="interest"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Credit Limit</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="tax_reg" name="tax_reg"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Terms</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="terms" name="terms"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Stat. Type</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="stat_type" name="stat_type"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Reminder</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="reminder" name="reminder"/>    
                                                    </div>                                                                               
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>                                            
                                    <div class="col-xs-6">  
                                        <fieldset>
                                            <legend>Company Details</legend>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_name" name="comp_name"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Contact</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="contact" name="contact"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Position</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="position" name="position"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Address</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_1" name="comp_add_1"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4"></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_2" name="comp_add_2"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4"></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_3" name="comp_add_3"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Post Code</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_post_cd" name="comp_post_cd"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Tel No.</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_tel_no" name="comp_tel_no"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Fax No.</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_fax_no" name="comp_fax_no"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Home Page</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_homepage" name="comp_homepage"/>    
                                                </div>                          
                                            </div>
                                            <legend>Mailing Address</legend>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Address</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_1" name="comp_mailadd_1"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4"></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_2" name="comp_mailadd_2"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4"></label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_3" name="comp_mailadd_3"/>    
                                                </div>                          
                                            </div>
                                            <div class="form-group">                                                
                                                <label class="col-sm-4">Post Code</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailpost_cd" name="comp_mailpost_cd"/>    
                                                </div>                          
                                            </div>
                                        </fieldset>                                          
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <fieldset>
                                            <legend>A/c Summary</legend>                                                  
                                            <div class="table-responsive">
                                                <table id="tblAccount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No.</th>
                                                        <th>Descs</th>
                                                        <th style="text-align: right;">Amount</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <fieldset>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <fieldset>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-5" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <fieldset>
                                            <legend>Reminder</legend>
                                            <div class="table-responsive">
                                                <table id="tblreminder" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No.</th>
                                                        <th>Trx Type</th>
                                                        <th>Doc No</th>
                                                        <th>Doc Date</th>
                                                        <th>Due Date</th>
                                                        <th>Reminder No</th>
                                                        <th>Reminder Date</th>
                                                        <th>Forex</th>
                                                        <th style="text-align: right;">Amount</th>                                                                
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-6" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <fieldset>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-7" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <fieldset>
                                            <legend>Schedule</legend>
                                            <div class="table-responsive">
                                                <table id="tblschedule" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No.</th>
                                                        <th>Bill Date</th>
                                                        <th>Bill Type</th>
                                                        <th>Trx</th>
                                                        <th>Description</th>
                                                        <th>Tax Code</th>
                                                        <th>Forex</th>
                                                        <th>Trx Amt</th>
                                                        <th></th>                                                                
                                                    </thead>                                                            
                                                    <tbody>                                                           
                                                    </tbody>
                                                    <tfoot style="font-weight: bold;background-color: #f2f2f2">
                                                        <tr>                                                                   
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>
                                                            <th></th>                                    
                                                            <th style="font-weight: bold;"> Total : </th>
                                                            <th></th>
                                                            <th></th>
                                                        </tr>
                                                    </tfoot> 
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tab-8" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <fieldset>
                                            <legend>Sales Info</legend>                                                  
                                            <div class="table-responsive">
                                                <table id="tblsalesinfo" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <thead>            
                                                        <th class="sorting_asc">No.</th>
                                                        <th>Lot No</th>
                                                        <th>Sales Date</th>
                                                        <th>PPJB Date</th>
                                                        <th>AJB Date</th>
                                                        <th>Key Collection</th>
                                                        <th>Selling Price</th>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>           
    </div>
</div>   -->  
<!-- </div> -->

<!-- Bootstrap Modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
// -----------------Function loading
    function block(boelan){
        var block_ele = $('#form')
        if (boelan==true) {
            $(block_ele).block({
                message: '<div class="semibold" style="z-index: 0 !important;"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                fadeIn: 1000,
                fadeOut: 1000,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait',
                    'z-index' : '0 !important' ,
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    backgroundColor: '#333',
                    marginLeft : 'auto',
                    "z-index" : '0 !important' ,
                    

                }
            });
        }
        else{
            $(block_ele).unblock()
        }
    }

// ------------------------ end function loading
// block(true);
var debtor_acct;
var tblnewsfeed;
var tblnewsfeed = $('#tblnewsfeed').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_debtor_enquiry/getTable');?>",
            "type": "POST"
        },
        "columns": [
            // { data: "row_number", width:'1px', searchable:false,
            //     render: function (data, type, row) {
            //         var row_number = row.row_number
            //         return row_number + '.'
            //     }
            // },
            { data: "debtor_acct", sortable: true },
            { data: "name" }

            
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        // "fnInitComplete": function(oSettings, json) {
        //         // tblnewsfeed.ajax.reload(null,true);
        //         // alert('a');

        //       $('#tblnewsfeed tbody').on( 'select', 'tr', function () {
        //             // console.log('fnInitComplete');
        //             // alert('select');
        //             // document.getElementById('loader').hidden=false;
        //             if($(this).hasClass( "selected" )){
        //                 if(tblnewsfeed.rows('.selected').data().length > 1){
        //                     $(this).removeClass( "selected" );
        //                 }
        //             } else {
        //                 $(this).addClass( "selected" );
        //                 var Project = $('#txtProject').val();
        //                 var s = tblnewsfeed.rows('.selected').data();
        //                 // console.log(s);
        //                 debtor_acct = s[0].debtor_acct; 
        //                 console.log(debtor_acct);                       

        //                 $('#tab-1').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-1/"+Project+" #tab-1");
        //                 tblnewsfeed.ajax.reload(null,true);
                        
                        
        //             }
        //         } );

        //         $('#tblnewsfeed tbody tr:eq(0)').select();
        //         $(document).ajaxStop(function() {
        //                     // alert('done');
        //                      document.getElementById('loader').hidden=true;
        //                 });
        //      // console.log(debtor_acct);
        //      // $('#tblnewsfeed tbody tr:eq(0)').click();
        //     },
        // "dom": '<"toolbar newsfeed">frtip'
    });
    tblnewsfeed.on('click', 'tr', function() {
        block(true);
        if ($(this).hasClass('selected')) {
            if(tblnewsfeed.rows('.selected').data().length > 1){
                $(this).removeClass( "selected" );
            }
            // $(this).removeClass('selected');
        } else {

            tblnewsfeed.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
            var Project = $('#txtProject').val();
            var s = tblnewsfeed.rows('.selected').data();
            // console.log(s);
            debtor_acct = s[0].debtor_acct; 
            console.log(debtor_acct);                       

            $('#tab-1').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-1/"+Project+" #tab-1");
             
            tblnewsfeed.ajax.reload(null,true);

        }
    });
    $('#tblnewsfeed tbody tr:eq(0)').select();
        $(document).ajaxStop(function() {
                    // alert('done');
             // document.getElementById('loader').hidden=true;
             block(false); 
        });
    
    $(document).on('click','#tblnewsfeed td',function(e){
        block(true);
        // document.getElementById('loader').hidden=false;
            var cons = $('#txtProject').find(':selected').attr('data-cons');
            var cell_clicked    = tblnewsfeed.cell(this).data();
            var row_clicked     = $(this).closest('tr');
            var data      = tblnewsfeed.row(row_clicked).data();
            var debtor = data['debtor_acct'];
            debtor_acct = debtor;
            tab = 'tab-1';
            // $('#tab-1').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+tab+" #tab-1");
            var Project = $('#txtProject').val();
            $('#tab-1').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-1/"+Project+"/"+cons+" #tab-1");
            $('#tab-3').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-3/"+Project+"/"+cons+" #tab-3");
             // $('#tab-3').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+'tab-3'+" #tab-3");
            tblAccount.ajax.reload(null,true);
            tblschedule.ajax.reload(null,true);
            tblreminder.ajax.reload(null,true);
            tblsalesinfo.ajax.reload(null,true); 

            var a = hasClass($('#tblnewsfeed tbody tr:eq(0)')[0],'selected');
            var row_td = $(this)['context']._DT_CellIndex.row;

                                    

            if(row_td==0){
                    
            }else{
                if(a==true){
                     
                    $('#tblnewsfeed tbody tr:eq(0)').removeClass( "selected" );      
                }
            }
            $(document).ajaxStop(function() {
                            // alert('done');
                             // document.getElementById('loader').hidden=true;
                             block(false);
                        });
        });

        // table Account
    
    // table account
    var tblAccount = $('#tblAccount').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_debtor_enquiry_account/getTableAccount');?>",
            "type": "POST",
            "data":{
             //    "sSearch": function(d){
             //    var search = $('#txt_search').val();
             //    var b="";
             //    if(search == null || search==""){
             //        return b;
             //    }{
             //        return search;
             //    }
             // },
                 "debtor_acct":function(d){
                  var dd = debtor_acct;
                  return dd;
                 },
                 "cons": function(d){
                        var a = $('#txtProject').find(':selected').attr('data-cons');
                        
                        var b ="all";
                        if(a == null){
                            return b;
                        }{
                            return a;
                        }
                        // console.log(a);
                        },
                 "project": function(d){
                        var a = $('#txtProject').val();
                        // console.log(a);
                        var b ="all";
                        if(a == null){
                            return b;
                        }{
                            return a;
                        }
                        console.log(a);
                        }

            }
        },
        "columns": [
            // { data: "row_number", width:'1px', searchable:false,
            //     render: function (data, type, row) {
            //         var row_number = row.row_number
            //         return row_number + '.'
            //     }
            // },
            { data: "no" },
            { data: "descs" , sortable: true},
            { data:"trx_amt" ,
                render: function(data,type,row){
                    return formatNumber(data);
                }
            },
            
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "columnDefs": [
          { className: "dt-left", "targets": [0] },
          { className: "dt-left", "targets": [1] },
          { className: "dt-right", "targets": [2] }          
        ]
        // "dom": '<"toolbar account">frtip'
    });
    $(document).on('click','#tblAccount td',function(e){
            var cell_clicked    = tblAccount.cell(this).data();
            var row_clicked     = $(this).closest('tr');
            var data      = tblAccount.row(row_clicked).data();
            console.log(data);
            var no = data['no'];
            var descs =  data['descs'];
            var name = data['name'];
            // console.log(name);
            var cons = $('#txtProject').find(':selected').attr('data-cons');
            fn_show_detail_account(no,descs,name,cons);
        });

    // table reminder
    var tblreminder = $('#tblreminder').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_debtor_enquiry_reminder/getTableReminder');?>",
            "type": "POST",
            "data":{
            // "sSearch": function(d){
            //     var search = $('#txt_search').val();
            //     var b="";
            //     if(search == null || search==""){
            //         return b;
            //     }{
            //         return search;
            //     }
            //  },
            "debtor_acct":function(d){
              var dd = debtor_acct;
              return dd;
             },
             "cons": function(d){
                    var a = $('#txtProject').find(':selected').attr('data-cons');
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
             "project": function(d){
                    var a = $('#txtProject').val();
                    // console.log(a);
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    }
         },
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "trx_type" , sortable: true},
            { data: "doc_no" },
            { data: "doc_date" },

            { data: "due_date" },
            { data: "reminder_no" },
            { data: "reminder_date" },
            { data: "currency_cd" },
            { data: "reminder_amt",
             render: function(data,type,row){
                    return formatNumber(data);
                }
            }

        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "columnDefs": [          
          { className: "dt-right", "targets": [8] }          
        ]
        // "dom": '<"toolbar newspromo">frtip'
    });

    // table Schedule
    var tblschedule = $('#tblschedule').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                    var trx_amt = api
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( 7 ).footer() ).html(
                    formatNumber(trx_amt) 
                );
                 
             
            },
        "ajax" : {
            "url" : "<?php echo base_url('c_debtor_enquiry_schedule/getTableSchedule');?>",
            "type": "POST",
            "data":{
            // "sSearch": function(d){
            //     var search = $('#txt_search').val();
            //     var b="";
            //     if(search == null || search==""){
            //         return b;
            //     }{
            //         return search;
            //     }
            //  },
            "debtor_acct":function(d){
              var dd = debtor_acct;
              return dd;
             },
             "cons": function(d){
                    var a = $('#txtProject').find(':selected').attr('data-cons');
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
             "project": function(d){
                    var a = $('#txtProject').val();
                    // console.log(a);
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    }
            },  
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"bill_date" ,sortable: true},
            {data:"bill_type" },
            {data:"trx_type" },
            {data:"descs" },
            {data:"tax_scheme" },
            {data:"currency_cd" },
            {data:"trx_amt",
            render: function(data,type,row){
                    return formatNumber(data);
                }
            },
            {
                data:"STATUS",
                render:function(data,type,row){
                    if(data == 'Y'){
                        return '<img style="width: 20px;" src="<?=base_url("img/Y.png")?>" />';
                        // return '<button class="btn btn-info btn-xs" type="button"><i class="fa fa-check"></i></button>';
                    }else{
                        return '<img style="width: 20px;" src="<?=base_url("img/X.png")?>" />';
                        // return '<button class="btn btn-danger btn-xs" type="button"><i class="fa fa-times"></i></button>';
                    }
                }
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        }
        // "dom": '<"toolbar newspromo">frtip'
    });

    // table salesinfo
    var tblsalesinfo = $('#tblsalesinfo').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                    var sell_price = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( 6 ).footer() ).html(
                    formatNumber(sell_price) 
                );
             
        },
        "ajax" : {
            "url" : "<?php echo base_url('c_debtor_enquiry_salesinfo/getTableSalesinfo');?>",
            "type": "POST",
            "data":{
            // "sSearch": function(d){
            //     var search = $('#txt_search').val();
            //     var b="";
            //     if(search == null || search==""){
            //         return b;
            //     }{
            //         return search;
            //     }
            //  },
            "debtor_acct":function(d){
              var dd = debtor_acct;
              // console.log(dd);
              return dd;
             },
             "cons": function(d){
                    var a = $('#txtProject').find(':selected').attr('data-cons');
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
             "project": function(d){
                    var a = $('#txtProject').val();
                    // console.log(a);
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    }
         },
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            
            {data:"lot_no", sortable: true},
            {data:"sales_date" },
            {data:"hand_over_date" },
            {data:"AJB_date" },
            {data:"key_collection_date" },
            {data:"sell_price" ,
            render: function(data,type,row){
                    return formatNumber(data);
                }
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        }
        // "dom": '<"toolbar newspromo">frtip'
    });

$('#txtProject').on("change", function(e) { 
    $('#txt_search').val('');
    var cons = $('#txtProject').find(':selected').attr('data-cons');
    // document.getElementById('loader').hidden=false;
    var Project = $('#txtProject').val();
        var state = document.readyState
        // console.log(state);
            if (state == 'complete') {
                tblnewsfeed.ajax.reload(function(){
                    tblAccount.ajax.reload(null,true);
                    tblschedule.ajax.reload(null,true); 
                    tblreminder.ajax.reload(null,true); 
                    tblsalesinfo.ajax.reload(null,true);
                    tblnewsfeed.ajax.reload(null,true); 
                    var count = $("#tblnewsfeed").dataTable().fnSettings().aoData.length;
                    // console.log(count);
                    var Project = $('#txtProject').val();
                    if(count>0){
                        
                        var datas = $("#tblnewsfeed").dataTable().fnSettings().aoData;
                      
                        var debtor_acct=datas[0]["_aData"]["debtor_acct"];
                        $('#tab-1').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-1/"+Project+"/"+cons+" #tab-1");
                         $('#tab-3').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-3/"+Project+"/"+cons+" #tab-3");
                        // alert('ada');
                    }else{
                        // console.log($("#tblnewsfeed").dataTable().fnSettings().aoData);
                         var debtor_acct='0';
                        $('#tab-1').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-1/"+Project+"/"+cons+" #tab-1");
                         $('#tab-3').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-3/"+Project+"/"+cons+" #tab-3");
                        // alert('ada');
                    }
                });
                // tblAccount.ajax.reload(null,true);
                // tblschedule.ajax.reload(null,true); 
                // tblreminder.ajax.reload(null,true); 
                // tblsalesinfo.ajax.reload(null,true); 
                // tblnewsfeed.ajax.reload(null,true); 
                // setTimeout(function(){
                //     // document.getElementById('interactive');
                    
                    
  
                    // 
                    // window.location.href = "<?=base_url('c_debtor_enquiry/index'); ?>";
                    // window.location.href="<?php echo base_url('c_debtor_enquiry/index');?>"+'/'+Project;
                    // tblnewsfeed.ajax.reload(null,true);
                //     $('#tblnewsfeed tbody').on( 'select', 'tr', function () {
                //         // console.log('fnInitComplete');
                //         if($(this).hasClass( "selected" )){
                //             console.log('1');
                //             // if(tblnewsfeed.rows('.selected').data().length > 1){
                //             //     $(this).removeClass( "selected" );

                //             // }
                //             tblnewsfeed.ajax.reload(null,true);
                //             var Project = $('#txtProject').val();
                //             var s = tblnewsfeed.rows('.selected').data();
                //             console.log(s);
                //             debtor_acct = s[0].debtor_acct;
                //              console.log(debtor_acct);

                //             tblAccount.ajax.reload(null,true);
                //             tblschedule.ajax.reload(null,true);
                //             tblreminder.ajax.reload(null,true); 
                //             tblsalesinfo.ajax.reload(null,true);
                //             $('#tab-1').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-1/"+Project+" #tab-1");

                //         } else {
                //             console.log('2');
                //             $(this).addClass( "selected" );
                //             var Project = $('#txtProject').val();
                //             var s = tblnewsfeed.rows('.selected').data();
                //             // console.log(s);
                //             debtor_acct = s[0].debtor_acct;
                //             console.log(debtor_acct);

                //             tblAccount.ajax.reload(null,true);
                //             tblschedule.ajax.reload(null,true);
                //             tblreminder.ajax.reload(null,true); 
                //             tblsalesinfo.ajax.reload(null,true);
                //             $('#tab-1').load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+"tab-1/"+Project+" #tab-1");
                            
                //         }
                //     } );

                //     $('#tblnewsfeed tbody tr:eq(0)').select();
                //     tblnewsfeed.ajax.reload(null,true);
                    // document.getElementById('loader').hidden=true;
                // },1000);
            }
    
});

function fn_show_detail_account(no,descs,name,cons){
   // alert(cons);
     var modalClass = $('#modal').attr('class');
            switch (modalClass) {
                case "modal fade bs-example-modal-md":
                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                    break;
                case "modal fade bs-example-modal-sm":
                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                    break;
                default:
                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                    break;
            }

            var modalDialogClass = $('#modalDialog').attr('class');
            switch (modalDialogClass) {
                case "modal-dialog modal-md":
                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                    break;
                case "modal-dialog modal-sm":
                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                    break;
                default:
                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                    break;
            }

            $('#modalTitle').html('Detail Debtor '+name+' ('+debtor_acct+')'+'/'+descs);
            

            $('div.modal-body').load("<?php echo base_url("c_debtor_enquiry/showDetailAccount");?>");

            $('#modal').data('no', no);
            $('#modal').data('cons', cons);

            $('#modal').modal('show');
}

function fn_tab(data){
    if(!debtor_acct){
        swal('warning','Please select row first','warning');
        // alert('');
        return;
    }
    var Project = $('#txtProject').val();    
    // alert(debtor_acct);
    var cons = $('#txtProject').find(':selected').attr('data-cons');
    var url;
    //     switch(data) {
    //     case 'tab-1':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-2':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-3':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-4':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-5':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-6':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-7':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    // } 

    if(data=='tab-2'){
        tblAccount.ajax.reload(null,true);   
    }else if(data=='tab-7'){
        tblschedule.ajax.reload(null,true); 
    }else if(data=='tab-5'){
        tblreminder.ajax.reload(null,true); 
    }else if(data=='tab-8'){
        tblsalesinfo.ajax.reload(null,true); 
    } else {
        // $('#'+data).load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data+" #"+data );
        $('#'+data).load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data+"/"+Project+"/"+cons+" #"+data );    
    }
    
    

    // $('#'+data).load(url);
}
function fn_detail(amt){
    // alert(amt+' - '+debtor_acct);
    var cons = $('#txtProject').find(':selected').attr('data-cons');
    // alert(cons);return;
     var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-lg":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-lg":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                            }
          

                            $('#modalTitle').html('Aging Detail');  
                              
                            $('div.modal-body').load("<?php echo base_url("c_debtor_enquiry/detail_aging");?>/"+ amt+"/"+debtor_acct+"/"+cons);
                            $('#modal').modal('show');
}
function hasClass(element, cls) {
    return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
}
</script>