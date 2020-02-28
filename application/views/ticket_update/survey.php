<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link href="<?=base_url('app-assets/css/plugins/forms/wizard.css')?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/extensions/toastr.css')?>" rel="stylesheet" />
<link href="<?=base_url('app-assets/css/plugins/extensions/toastr.css')?>" rel="stylesheet" />

<style type="text/css">
.clockpicker-popover {
    z-index: 999999;
}
#tblw td{
    text-align: center; 
    vertical-align: middle;
}

h4#modaltitle {
    width: 100%;
}

button#btnitem{

    padding-bottom: 8px;
    padding-top: 12px;
    float: right;
     margin-right: 0.9px;
     /*margin-right: 2.2px;*/
    margin-left: 2px;
}

button#btnservice{
    /*float: right;*/
    padding-bottom: 8px;
    padding-top: 12px;
    float: right;
     margin-right: 0.8px;
    margin-left: 2px;

}

button#btnpreview{

    padding-bottom: 6px;
    padding-top: 10px;
    float: right;
    margin-right: 2px;
    margin-left: 2px;
}

button#btncheckout{

    padding-bottom: 6px;
    padding-top: 10px;
    float: right;
    margin-right: 2px;
    margin-left: 2px;
}

button.close{
    margin-left: 0px
}


</style>

<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>C_Ticket_Update/save_update" enctype="multipart/form-data">
<?php 

    // OLD
    // $surveydate = $data[0]->survey_date;
    // $reported_date = date("d F Y G:i",strtotime($data[0]->reported_date));
    // $assigned_date = date("d F Y G:i",strtotime($data[0]->assigned_date));
    // $survey_date = '';
    // $survey_clock = '';
    // if ($surveydate==null || $surveydate=='') {
    //     $survey_date = date("d F Y");
    //     $survey_clock = date("G:i");
    // }
    // else{
    //     $survey_date = date("d F Y",strtotime($surveydate));
    //     $survey_clock = date("G:i",strtotime($surveydate));
    // }
    
    $eststartdate = $data[0]->est_start_date;
    $estcompletiondate = $data[0]->est_completion_date;
    $surveydate = $data[0]->survey_date;
    if (empty($eststartdate)) {
        $est_start_date = date("d F Y");
        $est_start_clock = date("G:i");
    }
    else{
        $est_start_date = date("d F Y",strtotime($eststartdate));
        $est_start_clock = date('G:i', strtotime($eststartdate));
    }
    if (empty($estcompletiondate)) {
        $est_completion_date = date("d F Y");
        $est_completion_clock = date("G:i");
    }
    else{
        $est_completion_date = date("d F Y",strtotime($estcompletiondate));
        $est_completion_clock = date("G:i",strtotime($estcompletiondate));
    }
    if (empty($surveydate)) {
        $survey_date = date("d F Y");
        $survey_clock = date("G:i");
    }
    else{
        $survey_date = date("d F Y",strtotime($surveydate));
        $survey_clock = date("G:i",strtotime($surveydate));
    }

    function formatdate($data){
        if ($data==null || $data=='') {
            return "--  ----  ---- --:--";
        }
        else{
            return date("d F Y G:i",strtotime($data));
        }
    }

 ?>
<div class="col-sm-12" id="tabhome">
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-4"><p class="text-center"><b>Ticket No : </b><?php echo $data[0]->complain_no ?></p></div>
                        <div class="col-sm-4"><p class="text-center"><b>Work Order : </b><?php echo $data[0]->report_no ?></p></div>
                        <div class="col-sm-4"><p class="text-center"><b>Assign To : </b><?php echo $data[0]->assign_to ?></p></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr style="margin-bottom: -33px;border-top: 3px solid rgba(0, 0, 0, 0.29);">
                    <div class="row">
                        <table width="100%" style="margin: 10px" id="tblw">
                            <tr>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-info ">New</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-primary ">A</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-secondary ">SS</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-warning ">AS</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-danger ">ES</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-danger ">EC</span>
                                    </span>
                                </td>
                                <td>
                                    <span class="avatar avatar-md">
                                        <span class="media-object rounded-circle text-circle bg-danger ">AS</span>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="badge badge-default badge-info">New Ticket</div><br>
                                    <div class="badge badge-info"><?php echo formatdate( $data[0]->reported_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-primary">Assign</div><br>
                                    <div class="badge badge-primary"><?php echo formatdate( $data[0]->assigned_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-secondary">Schedule Survey Date</div><br>
                                    <div class="badge badge-secondary"><?php echo formatdate( $data[0]->schedule_survey_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-warning">Actual Survey date</div><br>
                                    <div class="badge badge-warning"><?php echo formatdate( $data[0]->survey_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-danger">Estimated Start Date</div><br>
                                    <div class="badge badge-danger"><?php echo formatdate( $data[0]->est_start_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-danger">Estimated Complete Date</div><br>
                                    <div class="badge badge-danger"><?php echo formatdate( $data[0]->est_completion_date) ?></div>
                                </td>
                                <td>
                                    <div class="badge badge-default badge-danger">Actual Start Date</div><br>
                                    <div class="badge badge-danger"><?php echo formatdate( $data[0]->start_date) ?></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div id="accordion">
                <div class="card collapse-icon panel mb-0 box-shadow-0 border-0">
                    <div class="card-header border-bottom-blue-grey border-bottom-lighten-4" id="headingOne" style="padding-top: 0px">
                        <a href="#" class="h6 blue collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Survey</a>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                        <div class="card-body">
                            <input type="hidden" name="complainno" value="<?php echo $data[0]->complain_no ?>">
                            <input type="hidden" name="assignto" id="assignto" value="<?php echo $data[0]->assign_to ?>">
                            <input type="hidden" name="debtoracct" value="<?php echo $data[0]->debtor_acct ?>">
                            <input type="hidden" name="reportno" value="<?php echo $data[0]->report_no ?>">
                            <input type="hidden" name="currencycditem" id="currencycditem">
                            <input type="hidden" name="currencycdservice" id="currencycdservice">
                            <input type="hidden" name="sectioncd" id="sectioncd">
                            <input type="hidden" name="categorycd" id="categorycd">
                            <input type="hidden" name="lotno" value="<?php echo $data[0]->lot_no ?>">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label for="schedule_survey_date">Estimated Start Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="est_start_date" class="form-control" name="est_start_date" value="<?php echo $est_start_date ?>">
                                                <div class="form-control-position">
                                                    <i class="ft-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="est_start_clock" class="form-control" name="est_start_clock" value="<?php echo $est_start_clock ?>">
                                                <div class="form-control-position">
                                                    <i class="ft-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="schedule_survey_date">Estimated Completion Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="est_com_date" class="form-control" name="est_com_date" value="<?php echo $est_completion_date ?>">
                                                <div class="form-control-position">
                                                    <i class="ft-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="est_com_clock" class="form-control" name="est_com_clock" value="<?php echo $est_completion_clock ?>">
                                                <div class="form-control-position">
                                                    <i class="ft-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="schedule_survey_date">Actual Survey Date</label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="act_survey_date" class="form-control" name="act_survey_date" value="<?php echo $survey_date ?>">
                                                <div class="form-control-position">
                                                    <i class="ft-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="position-relative has-icon-left">
                                                <input type="text" id="act_survey_clock" class="form-control" name="act_survey_clock" value="<?php echo $survey_clock ?>">
                                                <div class="form-control-position">
                                                    <i class="ft-clock"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label>Survey Note</label>
                                    <textarea class="form-control" name="surveynote" id="surveynote" rows="4" cols="50"><?php echo $data[0]->survey_notes ?></textarea>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Problem Cause</label>
                                    <textarea class="form-control" name="problem" id="problem" rows="4" cols="50"><?php echo $data[0]->problem_cause ?></textarea>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Solution of Problem</label>
                                    <textarea class="form-control" name="solution" id="solution" rows="4" cols="50"><?php echo $data[0]->remarks ?></textarea>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="coname">Picture Survey</label>
                                    <fieldset class="form-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="userfile" name="userfile" accept="image/*">
                                            <input type="hidden" id="image" name="image"  readonly="readonly" />
                                            <label id="labelimage" class="custom-file-label" for="userfile">Choose Picture</label>
                                        </div>
                                    </fieldset>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <!-- <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion" style="">
                        <div class="card-body">
                            <input type="hidden" name="complainno" value="<?php// echo $data[0]->complain_no ?>">
                            <input type="hidden" name="assigndate" id="assigndate" value="<?php// echo $data[0]->assigned_date ?>">
                            <input type="hidden" name="assignto" id="assignto" value="<?php// echo $data[0]->assign_to ?>">
                            <input type="hidden" name="est_date" id="est_date" value="<?php// echo $data[0]->est_completion_date ?>">
                            <input type="hidden" name="completion_date" id="completion_date" value="<?php// echo $data[0]->completion_date ?>">
                            <div class="form-group">
                                <label for="surveydate">Survey Date</label>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <input type="text" id="surveydate" class="form-control" placeholder="Complain Code" name="surveydate" value="<?php// echo $survey_date?>" required>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="clock" name="clock"  value="<?php// echo $survey_clock?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" name="note" id="note" rows="4" cols="50"><?php// echo $data[0]->survey_notes ?></textarea>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<div class="col-sm-12" id="tabitem">
    <div class="card">
        <div class="card-body">
            <form id="frmitem" class="form-horizontal">
                <div class="row">
                        <div class="form-group col-sm-4">
                            <label>Item</label>
                            <select data-placeholder="Choose an Item" class="select2 form-control" id="itemid" name="itemid">
                                <option value=""></option>
                                <?php foreach ($item as $key) { ?>
                                    <option value="<?php echo $key->item_cd.",".$key->descs?>"><?php echo $key->descs ?></option>
                                <?php }  ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-1">
                            <label>Quantity</label>
                                <input type="number" class="form-control" required id="qtyitem" name="qtyitem" value="1">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Unit Price</label>
                            <div class="input-group m-b">
                                <span class="input-group-addon">Rp</span> 
                                <input type="text" class="form-control" required id="amtitem" name="amtitem">
                            </div>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Total Amount</label>
                            <div class="input-group m-b">
                                <span class="input-group-addon">Rp</span> 
                                <input type="text" class="form-control" required id="totalamtitem" name="totalamtitem" readonly>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" required id="baseamtitem" name="baseamtitem">
                        <input type="hidden" class="form-control" required id="taxitem" name="taxitem">
                        <input type="hidden" class="form-control" required id="taxamtitem" name="taxamtitem">
                </div>
            </form>
            <button type="button" id="btnadditem" class="btn btn-primary" disabled="">Add Item to Cart</button><br><br>
        </div>
    </div>
</div>
<div class="col-sm-12" id="tabservice">
    <div class="card">
        <div class="card-body">
            <form id="frmservice" class="form-horizontal">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label>Service</label>
                        <select data-placeholder="Choose a Service" class="select2 form-control" id="serviceid" name="serviceid">
                            <option value=""></option>
                            <?php foreach ($service as $key) { ?>
                                <option value="<?php echo $key->service_cd.",".$key->descs?>"><?php echo $key->descs ?></option>
                            <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-5">
                        <label>Time In and Time Out</label>
                        <div class="input-daterange input-group date-input-group" id="inandout">
                            <div class="position-relative has-icon-left">
                                <input type="text" class="form-control" name="start" id="start" value="<?php echo date("d F Y") ?>" />
                                <div class="form-control-position">
                                    <i class="ft-calendar"></i>
                                </div>
                            </div>
                            <div class="position-relative has-icon-left">
                                <input type="text" class="form-control" name="end" id="end" value="<?php echo date("d F Y") ?>" />
                                <div class="form-control-position">
                                    <i class="ft-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class="input-daterange input-group">
                            <div class="position-relative has-icon-left">
                                <input type="text" class="form-control" id="inclock" name="inclock" value="<?php echo date("G:i") ?>" >
                                <div class="form-control-position">
                                    <i class="ft-clock"></i>
                                </div>
                            </div>
                            <div class="position-relative has-icon-left">
                                <input type="text" class="form-control" id="outclock" name="outclock" value="<?php echo date("G:i") ?>" >
                                <div class="form-control-position">
                                    <i class="ft-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Rate</label>
                        <div class="input-group m-b">
                            <span class="input-group-addon">Rp</span> 
                            <input type="text" class="form-control" required id="rateservice" name="rateservice" >
                        </div>
                    </div>
                    <div class="form-group col-sm-2">
                        <label>Total Amount</label>
                        <div class="input-group m-b">
                            <span class="input-group-addon">Rp</span> 
                            <input type="text" class="form-control" required id="totalamtservice" name="totalamtservice" readonly>

                        </div>
                    </div>
                    <input type="hidden" class="form-control" required id="hourservice" name="hourservice" readonly>
                    <input type="hidden" class="form-control" required id="staffidservice" name="staffidservice" value="<?php echo $data[0]->assign_to ?>">
                    <input type="hidden" class="form-control" required id="baseamtservice" name="baseamtservice">
                    <input type="hidden" class="form-control" required id="taxservice" name="taxservice">
                    <input type="hidden" class="form-control" required id="taxamtservice" name="taxamtservice">
                </div>
            </form>
            <button type="button" id="btnaddservice" class="btn btn-primary" disabled="">Add Service to Cart</button><br><br>
        </div>
    </div>
</div>
<div class="col-sm-12" id="tabpreview">
    <div id="accordion4" class="card-accordion">
        <div class="card collapse-icon accordion-icon-rotate left">
            <div class="card">
                <div class="card-header" id="headingHOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#accordionD1" aria-expanded="true" aria-controls="accordionD1">
                            Items
                            <div class='badge badge-pill badge-danger' id='cntitem'>0</div>
                        </button>
                    </h5>
                </div>
                <div id="accordionD1" class="collapse show" aria-labelledby="headingHOne" data-parent="#accordion4">
                    <div class="card-body">
                        <table id="tblitem" class="table table-striped table-responsive table-bordered table-hover dataTables">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th width="50px">Item Code</th>
                                    <th width="250px">Descs</th>
                                    <th width="5px">Qty</th>
                                    <th width="120px">Unit Price</th>
                                    <th width="120px">Base Amt</th>
                                    <th width="5px">Tax</th>
                                    <th width="120px">Tax Amt</th>
                                    <th width="120px">Total Amt</th>
                                    <th width="5px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="8" style="text-align:right">Total:</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingHTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#accordionD2" aria-expanded="false" aria-controls="accordionD2">
                            Services
                            <div class='badge badge-pill badge-danger' id='cntservice'>0</div>
                        </button>
                    </h5>
                </div>
                <div id="accordionD2" class="collapse" aria-labelledby="headingHTwo" data-parent="#accordion4">
                    <div class="card-body">
                        <table id="tblservice" class="table table-striped table-responsive table-bordered table-hover dataTables">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th width="50px">Service Code</th>
                                    <th width="250px">Time In</th>
                                    <th width="250px">Time Out</th>
                                    <th width="5px">Hours</th>
                                    <th width="250px">Staff ID</th>
                                    <th width="250px">Rate</th>
                                    <th width="250px">Base Amt</th>
                                    <th width="250px">Tax</th>
                                    <th width="250px">Tax Amt</th>
                                    <th width="250px">Total Amt</th>
                                    <th width="5px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="10" style="text-align:right;">Total:</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12" id="tabckechout">
    <div id="accordion5" class="card-accordion">
        <div class="card collapse-icon accordion-icon-rotate left">
            <div class="card">
                <div class="card-header" id="headingHThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#accordionD3" aria-expanded="true" aria-controls="accordionD3">
                            Items
                            <div class='badge badge-pill badge-danger' id='cntitemc'>0</div>
                        </button>
                    </h5>
                </div>
                <div id="accordionD3" class="collapse show" aria-labelledby="headingHThree" data-parent="#accordion5">
                    <div class="card-body">
                        <table id="tblitemc" class="table table-hover table-striped table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th width="50px">Item Code</th>
                                    <th width="250px">Report No</th>
                                    <th width="5px">Qyt</th>
                                    <th width="120px">Unit Price</th>
                                    <th width="120px">Base Amt</th>
                                    <th width="5px">Tax</th>
                                    <th width="120px">Tax Amt</th>
                                    <th width="120px">Total Amt</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingHFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#accordionD4" aria-expanded="false" aria-controls="accordionD4">
                            Services
                            <div class='badge badge-pill badge-danger' id='cntservicec'>0</div>
                        </button>
                    </h5>
                </div>
                <div id="accordionD4" class="collapse" aria-labelledby="headingHFour" data-parent="#accordion5">
                    <div class="card-body">
                        <table id="tblservicec" class="table table-striped table-bordered table-hover" width="100%">
                        <thead>
                            <tr>
                                <th width="50px">Service Code</th>
                                <th width="250px">Time In</th>
                                <th width="250px">Time Out</th>
                                <th width="5px">Hours</th>
                                <th width="250px">Staff ID</th>
                                <th width="250px">Rate</th>
                                <th width="250px">Base Amt</th>
                                <th width="250px">Tax</th>
                                <th width="250px">Tax Amt</th>
                                <th width="250px">Total Amt</th>
                            </tr>
                        </thead>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button id="printWo" onclick="printWo('<?php echo $data[0]->report_no ?>')" class="btn btn-primary">Print Work Order</button>
    <button type="button" id="btnSave" class="btn btn-primary">Submit</button>
    <button type="button" id="checkout" class="btn btn-primary">Checkout</button>
    <button type="button" id="back1" class="btn btn-default" data-dismiss="modal">Back</button>
    <!-- <button type="button" id="confirm" class="btn btn-danger">Confirm to Pay</button> -->
    <button type="button" id="back2" class="btn btn-default">Back</button>
</div>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/toastr.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function(){

    var survey_date = '<?php echo $data[0]->survey_date; ?>'
    var confirm_date = '<?php echo $data[0]->confirm_date; ?>'
    if (survey_date!=='') {
        $('#btnSave').text('Update Survey')
    }
    else{
        $('#btnSave').text('Submit')
    }

    if (confirm_date!=='') {
        $('#btnSave').attr('disabled','disabled')
    }

    $('#surveydate').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd MM yyyy',
    });

    $(".select2").select2({
        width : '100%'
    });

    $('#clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    var tblitemc = $('#tblitemc').DataTable({
        "ajax" : {
            "url" : "<?php echo base_url('C_Ticket_Update/gettableitem/').$data[0]->report_no;?>",
            "type": "POST",
        },
        drawCallback: function() {
            var api = this.api();
            var num_rows = api.page.info()
            $("#cntc").text(num_rows.end)
            $("#cntitemc").text(num_rows.end)
        },
        "columns": [
            { data: "item_cd"},
            { data: "report_no"},
            { data: "qty",
                render: function (data, type, row) {
                    return  formatmoney(data);
                }
            },
            { data: "charge_rate",
                render: function (data, type, row) {
                    return  formatmoney(data);
                }
            },
            { data: "base_amt",
                render: function (data, type, row) {                        
                    return  formatmoney(data);
                }
            },
            { data: "tax_cd"},
            { data: "tax_amt",
                render: function (data, type, row) {
                    return  formatmoney(data);
                }
            },
            { data: "total_amt",
                render: function (data, type, row) {
                    return  formatmoney(data);
                }
            }
        ]
    })

    var tblservicec = $('#tblservicec').DataTable({
        "ajax" : {
            "url" : "<?php echo base_url('C_Ticket_Update/gettableservice/').$data[0]->report_no;?>",
            "type": "POST"
        },
        drawCallback: function() {
            var api = this.api();
            var num_rows = api.page.info()
            var cnt = $("#cntc").text()
            $("#cntc").text(Number(cnt)+Number(num_rows.end))
            $("#cntservicec").text(num_rows.end)
        },
        "columns": [
            { data: "service_cd"},
            { data: "time_in",
                render: function (data, type, row) {          
                    return  formatdate(data);
                }
            },
            { data: "time_out",
                render: function (data, type, row) {          
                    return  formatdate(data);
                }
            },
            { data: "manhours"},
            { data: "assign_to"},
            { data: "charge_rate",
                render: function (data, type, row) {          
                    return  formatmoney(data);
                }
            },
            { data: "base_amt",
                render: function (data, type, row) {          
                    return  formatmoney(data);
                }
            },
            { data: "tax_cd"},
            { data: "tax_amt",
                render: function (data, type, row) {
                    return  formatmoney(data);
                }
            },
            { data: "total_amt",
                render: function (data, type, row) {
                    return  formatmoney(data);
                }
            }
        ],
    })

    var titem = $('#tblitem').DataTable({
        "searching": false,
        "lengthChange": false,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/,.*|[^0-9]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 1 ).footer() ).html(
                'Total Item : Rp. '+ formatmoney(total)
            );
        }
    })
    var tservice = $('#tblservice').DataTable({
        "searching": false,
        "lengthChange": false,
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/,.*|[^0-9]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 1 ).footer() ).html(
                'Total Service : Rp. '+ formatmoney(total)
            );
        }
    })

    var intVal = function ( i ) {
        return typeof i === 'string' ?
            i.replace(/,.*|[^0-9]/g, '')*1 :
            typeof i === 'number' ?
                i : 0;
    };

    toastr.options = {
      "closeButton": true,
      "debug": false,
      "progressBar": true,
      "preventDuplicates": false,
      "positionClass": "toast-top-right",
      "onclick": null,
      "showDuration": "400",
      "hideDuration": "1000",
      "timeOut": "7000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    var cnt = 0
    var cntitem = 0
    var cntservice = 0
    $('#btnadditem').on( 'click', function () {
        var id = $("#itemid").val()
        var iditem = id.split(',')
        var length = titem.column( 1 ).data().length

        if (length<1) {
            titem.row.add( [
                iditem[0],
                iditem[1],
                $("#qtyitem").val(),
                $("#amtitem").val(),
                $("#baseamtitem").val(),
                $("#taxitem").val(),
                $("#taxamtitem").val(),
                $("#totalamtitem").val(),
            "<i class='ft ft-minus-circle' id='delete' style='cursor:pointer'>"
            ]).node().id = iditem[0];
            titem.draw(false)
            cnt = Number(cnt)+Number($("#qtyitem").val())
            $('#cnt').text(cnt)

            toastr.success('Add Item '+$("#qtyitem").val()+' '+iditem[1]+' check in tab prewiew', 'Add Item Success', {positionClass: 'toast-top-center', containerId: 'toast-top-center'});
        }
        else{
            var idx =  titem.columns(0).data().eq(0).indexOf(iditem[0])
            if(idx === -1){
                titem.row.add([
                    iditem[0],
                    iditem[1],
                    $("#qtyitem").val(),
                    $("#amtitem").val(),
                    $("#baseamtitem").val(),
                    $("#taxitem").val(),
                    $("#taxamtitem").val(),
                    $("#totalamtitem").val(),
                    "<i class='ft ft-minus-circle' id='delete' style='cursor:pointer'>"
                ]).node().id = iditem[0];
                titem.draw(false)
                cnt = Number(cnt)+Number($("#qtyitem").val())
                $('#cnt').text(cnt)

                toastr.success('Add Item '+$("#qtyitem").val()+' '+iditem[1]+' check in tab prewiew', 'Add Item Success', {positionClass: 'toast-top-center', containerId: 'toast-top-center'});
            }
            else{
                var row = titem.row('#'+iditem[0]).node();
                var dataoldqty = titem.cell(row, 2).data()
                var dataoldbaseamt = titem.cell(row, 4).data()
                var dataoldtotalamt = titem.cell(row, 7).data()
                titem.cell(row, 2).data(Number(dataoldqty)+Number($("#qtyitem").val())).draw();
                titem.cell(row, 4).data(formatmoney(Number(convertToAngka(dataoldbaseamt))+Number(convertToAngka($("#baseamtitem").val())))).draw();
                titem.cell(row, 7).data(formatmoney(Number(convertToAngka(dataoldtotalamt))+Number(convertToAngka($("#totalamtitem").val())))).draw();

                toastr.success('Add Item '+$("#qtyitem").val()+' '+iditem[1]+' check in tab prewiew', 'Add Item Success', {positionClass: 'toast-top-center', containerId: 'toast-top-center'});
            }
        }
        totalitem = titem
        .column( 7 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );

        totalservice = tservice
        .column( 10 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );


        $('#grandtotal').text('Rp. ' + formatmoney(Number(totalitem)+Number(totalservice)));

        $("#itemid").val('').trigger('change')
        block(false)
        $('#frmitem')[0].reset()
        $("#btnadditem").prop('disabled', true)
        cntitem = titem.rows().data().length
        $('#cntitem').text(cntitem)
    });

    $('#btnaddservice').on( 'click', function () {
        var id = $("#serviceid").val()
        var idservice = id.split(',')
        var length = tservice.column( 1 ).data().length
        
        if (length<1) {
            tservice.row.add( [
                idservice[0],
                $("#start").val() + ' ' + $("#inclock").val(),
                $("#end").val() + ' ' + $("#outclock").val(),
                $("#hourservice").val(),
                $("#staffidservice").val(),
                $("#rateservice").val(),
                $("#baseamtservice").val(),
                $("#taxservice").val(),
                $("#taxamtservice").val(),
                $("#totalamtservice").val(),
                "<i class='ft ft-minus-circle' id='delete' style='cursor:pointer'>"
            ] ).draw( false );

            cnt = cnt+1
            $('#cnt').text(cnt)

            toastr.success('Add Service '+idservice[0]+' check in tab prewiew', 'Add Service Success', {positionClass: 'toast-top-center', containerId: 'toast-top-center'});
        }
        else{
            var idx =  tservice.columns(0).data().eq(0).indexOf(idservice[0])
            if(idx === -1){
                tservice.row.add( [
                    idservice[0],
                    $("#start").val() + ' ' + $("#inclock").val(),
                    $("#end").val() + ' ' + $("#outclock").val(),
                    $("#hourservice").val(),
                    $("#staffidservice").val(),
                    $("#rateservice").val(),
                    $("#baseamtservice").val(),
                    $("#taxservice").val(),
                    $("#taxamtservice").val(),
                    $("#totalamtservice").val(),
                    "<i class='ft ft-minus-circle' id='delete' style='cursor:pointer'>"
                ] ).draw( false );

                cnt = cnt+1
                $('#cnt').text(cnt)

                toastr.success('Add Service '+idservice[0]+' check in tab prewiew', 'Add Service Success', {positionClass: 'toast-top-center', containerId: 'toast-top-center'});
            }
            else{
                toastr.error('This service already add in cart', 'Add Service Falied', {positionClass: 'toast-top-center', containerId: 'toast-top-center'});
            }
        }

        totalitem = titem
        .column( 8 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );

        totalservice = tservice
        .column( 10 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );

        $('#grandtotal').text('Rp. ' + formatmoney(Number(totalitem)+Number(totalservice)));


        $("#serviceid").val('').trigger('change')
        block(false)
        $('#frmservice')[0].reset()
        $("#btnaddservice").prop('disabled', true);
        cntservice = tservice.rows().data().length
        $('#cntservice').text(cntservice)
    } );


    $('#tblitem tbody').on( 'click', '#delete', function () {
        titem
        .row( $(this).parents('tr') )
        .remove()
        .draw();

        totalitem = titem
        .column( 8 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );

        totalservice = tservice
        .column( 10 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );


        $('#grandtotal').text('Rp. ' + formatmoney(Number(totalitem)+Number(totalservice)));

        cnt = cnt-1
        cntitem = cntitem-1
        $('#cntitem').text(cntitem)
        $('#cnt').text(cnt)
    });

    $('#tblservice tbody').on( 'click', '#delete', function () {
        tservice
        .row( $(this).parents('tr') )
        .remove()
        .draw();

        totalitem = titem
        .column( 8 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );

        totalservice = tservice
        .column( 10 )
        .data()
        .reduce( function (a, b) {
            return intVal(a) + intVal(b);
        }, 0 );


        $('#grandtotal').text('Rp. ' + formatmoney(Number(totalitem)+Number(totalservice)));

        cnt = cnt-1
        cntservice = cntservice-1
        $('#cnt').text(cnt)
        $('#cntservice').text(cntservice)
    } );

    $('#tabhome').show()
    $('#tabitem').hide()
    $('#tabservice').hide()
    $('#tabpreview').hide()
    $('#tabckechout').hide()

    $('#printWo').show()
    $('#btnSave').show()
    $('#checkout').hide()
    $('#back1').show()
    $('#back2').hide()
    $('#confirm').hide()

    $('#btnitem').click(function(){
        // $('#ttl').replaceWith('<span id="ttl"><i class="ft-arrow-left" onclick="back()" style="cursor: pointer;"></i>&nbsp;Add Items</span>')
        $(this).removeClass('btn-info').addClass('btn-success')
        $('#btnservice').removeClass('btn-success').addClass('btn-info')
        $('#btnpreview').removeClass('btn-success').addClass('btn-info')
        $('#btncheckout').removeClass('btn-success').addClass('btn-info')
        $('#tabhome').hide()
        $('#tabitem').show()
        $('#tabservice').hide()
        $('#tabpreview').hide()
        $('#tabckechout').hide()

        $('#printWo').hide()
        $('#btnSave').hide()
        $('#checkout').hide()
        $('#back1').hide()
        $('#back2').show()
        $('#confirm').hide()
    })

    $('#btnservice').click(function(){
        // $('#ttl').replaceWith('<span id="ttl"><i class="ft-arrow-left" onclick="back()" style="cursor: pointer;"></i>&nbsp;Add Services</span>')
        $('#btnitem').removeClass('btn-success').addClass('btn-info')
        $(this).removeClass('btn-info').addClass('btn-success')
        $('#btnpreview').removeClass('btn-success').addClass('btn-info')
        $('#btncheckout').removeClass('btn-success').addClass('btn-info')
        $('#tabhome').hide()
        $('#tabitem').hide()
        $('#tabservice').show()
        $('#tabpreview').hide()
        $('#tabckechout').hide()

        $('#printWo').hide()
        $('#btnSave').hide()
        $('#checkout').hide()
        $('#back1').hide()
        $('#back2').show()
        $('#confirm').hide()
    })

    $('#btnpreview').click(function(){
        // $('#ttl').replaceWith('<span id="ttl"><i class="ft-arrow-left" onclick="back()" style="cursor: pointer;"></i>&nbsp;List Cart</span>')
        $('#btnitem').removeClass('btn-success').addClass('btn-info')
        $('#btnservice').removeClass('btn-success').addClass('btn-info')
        $(this).removeClass('btn-info').addClass('btn-success')
        $('#btncheckout').removeClass('btn-success').addClass('btn-info')
        $('#tabhome').hide()
        $('#tabitem').hide()
        $('#tabservice').hide()
        $('#tabpreview').show()
        $('#tabckechout').hide()

        $('#printWo').hide()
        $('#btnSave').hide()
        $('#checkout').show()
        $('#back1').hide()
        $('#back2').show()
        $('#confirm').hide()
    })

    $('#btncheckout').click(function(){
        // $('#ttl').replaceWith('<span id="ttl"><i class="ft-arrow-left" onclick="back()" style="cursor: pointer;"></i>&nbsp;Checkout</span>')
        $('#btnitem').removeClass('btn-success').addClass('btn-info')
        $('#btnservice').removeClass('btn-success').addClass('btn-info')
        $('#btnpreview').removeClass('btn-success').addClass('btn-info')
        $(this).removeClass('btn-info').addClass('btn-success')
        $('#tabhome').hide()
        $('#tabitem').hide()
        $('#tabservice').hide()
        $('#tabpreview').hide()
        $('#tabckechout').show()

        $('#printWo').hide()
        $('#btnSave').hide()
        $('#checkout').hide()
        $('#back1').hide()
        $('#back2').show()
        $('#confirm').show()
    })

    $('#back2').click(function(){
        back()
    })

    var baseamtitem = $('#baseamtitem').val();
    var tax_amtitem = 0
    $("#itemid").change(function(){
        block(true)
        var id = $(this).val()
        var id = id.split(',')
        $.getJSON("<?php echo base_url('C_Ticket_Update/zoomitem');?>" + "/" + id[0], function (data) {
            $('#amtitem').val(formatmoney(data[0].charge_amt))
            $('#currencycditem').val(data[0].currency_cd)
            var tax_cd = $('#taxitem').val(data[0].tax_cd)
            $.getJSON("<?php echo base_url('C_Ticket_Update/zoomtax');?>" + "/" + data[0].tax_cd, function (data) {
                if (data.tax_cd.length>0) {
                    var incl = data.tax_cd[0].incl_excl
                    var tax_rate = data.tax_rate[0].tax_rate
                    if (incl=='I') {
                        tax_amtitem = Number(baseamtitem)/((100+Number(tax_rate))*Number(tax_rate)/100)
                        $('#taxamtitem').val(Math.floor(tax_amtitem))
                    }
                    if (incl=='E') {
                        tax_amtitem = Number(baseamtitem)*Number(tax_rate)/100;
                        $('#taxamtitem').val(Math.floor(tax_amtitem))
                    }
                }
                else{
                    tax_amtitem = 0
                    $('#taxamtitem').val(Math.floor(tax_amtitem))
                }
                block(false)
                var qyt = $('#qtyitem').val()
                var amt = convertToAngka($('#amtitem').val())
                baseamtitem = Number(amt)*Number(qyt)
                $('#baseamtitem').val(formatmoney(baseamtitem))
                baseamtitem = convertToAngka($('#baseamtitem').val())
                $('#totalamtitem').val(formatmoney(Number(baseamtitem)+Number(tax_amtitem)))
                $("#btnadditem").prop('disabled', false);
            })
        });
    })

    $('#qtyitem').bind("keyup change",function(){
        var qyt = $(this).val()
        var amt = convertToAngka($('#amtitem').val())
        baseamtitem = amt*qyt
        $('#baseamtitem').val(formatmoney(baseamtitem))
        $('#totalamtitem').val(formatmoney(Number(baseamtitem)+Number(tax_amtitem)))
    })

    $('#amtitem').bind("keyup change",function(){
        var qyt = $('#qtyitem').val()
        var amt = convertToAngka($('#amtitem').val())
        baseamtitem = amt*qyt
        $('#baseamtitem').val(formatmoney(baseamtitem))
        $('#totalamtitem').val(formatmoney(Number(baseamtitem)+Number(tax_amtitem)))
    })

    var baseamtservice = 0
    var tax_amtservice = 0
    $("#serviceid").change(function(){
        block(true)
        $("#btnadditem").prop('disabled', false);
        var id = $(this).val()
        var id = id.split(',')
        $.getJSON("<?php echo base_url('C_Ticket_Update/zoomservice');?>" + "/" + id[0], function (data) {
            $('#rateservice').val(formatmoney(data[0].labour_rate))
            $('#baseamtservice').val(formatmoney(data[0].labour_rate))
            $('#hourservice').val(data[0].service_day)
            $('#currencycdservice').val(data[0].currency_cd)
            $('#sectioncd').val(data[0].section_cd)
            $('#categorycd').val(data[0].category_cd)
            var tax_cd = $('#taxservice').val(data[0].tax_cd)
            baseamtservice = data[0].labour_rate
            $.getJSON("<?php echo base_url('C_Ticket_Update/zoomtax');?>" + "/" + data[0].tax_cd, function (data) {
                if (data.tax_cd.length>0) {
                    var incl = data.tax_cd[0].incl_excl
                    var tax_rate = data.tax_rate[0].tax_rate
                    if (incl=='I') {
                        tax_amtservice = Number(baseamtservice)/((100+Number(tax_rate))/100)*Number(tax_rate)/100
                        $('#taxamtservice').val(formatmoney(Math.floor(tax_amtservice)))
                    }
                    if (incl=='E') {
                        tax_amtservice = Number(baseamtservice)*Number(tax_rate)/100;
                        $('#taxamtservice').val(formatmoney(Math.floor(tax_amtservice)))
                    }
                }
                else{
                    tax_amtservice = 0
                    $('#taxamtservice').val(formatmoney(Math.floor(tax_amtservice)))
                }
                $('#totalamtservice').val(formatmoney(Math.floor(Number(baseamtservice)+Number(tax_amtservice))))
                $("#btnaddservice").prop('disabled', false);
                block(false)
            })
        });
    })

    $('#rateservice').bind("keyup change",function(){
        var rate = $(this).val()
        $('#baseamtservice').val(formatmoney(rate))
        $('#taxamtservice').val(formatmoney(tax_amtservice))
        $('#totalamtservice').val(formatmoney(Number(convertToAngka(rate))+Number(tax_amtservice)))
    })

    $('#inandout').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        calendarWeeks: true,
        forceParse: false,
        autoclose: true,
        format: 'dd-MM-yyyy',
        container: '.date-input-group'
    });

    $('#estdate').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd-MM-yyyy',
    });

    $('#surveydate').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd-MM-yyyy',
    });

    $('#clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('#clock_est').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('#inclock').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'bottom-dikit',
        align: 'kiri-dikit'
    });

    $('#outclock').clockpicker({
        autoclose: true,
        'default': 'now',
        placement: 'bottom-dikit',
        align: 'kiri-dikit-outclock'
    });


    // NEW
    $('#act_survey_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd MM yyyy',
    });

    $('#est_start_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd MM yyyy',
    });

    $('#est_com_date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: 'dd MM yyyy',
    });

    $('#est_start_clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

    $('#est_com_clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });

     $('#act_survey_clock').clockpicker({
        autoclose: true,
        'default': 'now'
    });


    // $('#btnSave').click(function(){
    //     $(this).attr('disabled','disabled')
    //     block(true)
    //     var dataitem = titem
    //         .rows()
    //         .data();

    //     var dataservice = tservice
    //         .rows()
    //         .data();
    //     var li = dataitem.length
    //     var ls = dataservice.length
        
    //     titem
    //     .clear()
    //     .draw();
    //     tservice
    //     .clear()
    //     .draw();
    //     $("#cnt").text(0)
    //     var id = $('#modal').data('id');
    //     var datafrm = $('#frmEditor').serializeArray();
    //     datafrm.push({name:'li',value:li},{name:'ls',value:ls})
    //     for (var i = 0; i < li ; i++) {
    //         datafrm.push({name:'item-'+[i],value:dataitem[i]})
    //     }
    //     for (var a = 0; a < ls ; a++) {
    //         datafrm.push({name:'service-'+[a],value:dataservice[a]})
    //     }

    //     $.ajax({
    //         url : "<?php echo base_url('C_Ticket_Update/save_proses');?>",
    //         type:"POST",
    //         data:datafrm,
    //         dataType:"json",
    //         success:function(event, data){
    //             if(event.Error==false){
    //                 block(false)
    //                 swal({
    //                     title: "Information",
    //                     animation: false,
    //                     type:"success",
    //                     text: event.Pesan,
    //                     confirmButtonText: "OK"
    //                 });
    //                 loadfilter()
    //                 table.ajax.reload(null,true);
    //                 tblitemc.ajax.reload(null,true);
    //                 tblservicec.ajax.reload(null,true);
    //                 $('#btnSave').removeAttr('disabled')
    //                 $('#modal').modal('hide');
    //             } else {
    //                 $('#modal').modal('hide');
    //                 block(false)
    //                 swal({
    //                     title: "Error",
    //                     animation: false,
    //                     type:"error",
    //                     text: event.Pesan,
    //                     confirmButtonText: "OK"
    //                 });
    //                 $('#btnSave').removeAttr('disabled')
    //           }
    //         },                    
    //         error: function(jqXHR, textStatus, errorThrown){
    //             $('#modal').modal('hide');
    //             block(false)
    //             swal({
    //                 title: "Error",
    //                 animation: false,
    //                 type:"error",
    //                 text: textStatus+' Save : '+errorThrown,
    //                 confirmButtonText: "OK"
    //             });
    //             $('#btnSave').removeAttr('disabled')
    //         }
    //     });
    // })

    $.validator.addMethod("cek_date", function (value, element) {
        var isSuccess = false;
        var assigndate = $('#assigndate').val()
        var surveydate = $('#surveydate').val()
        var clock = $('#clock').val()

        var newdate1 = new Date(assigndate)
        var newdate2 = new Date(surveydate + ' ' + clock)

        if (newdate2>newdate1) {
            var isSuccess = true;
        }

        return isSuccess;

      });

    $("#frmEditor").validate({
        rules: {
            // surveydate : {
            //     cek_date:true
            // },
            // clock : {
            //     required:true
            // }
        },
        messages: {
            surveydate: {
                cek_date: "Survey Date Cannot be smaller than Assigned Date",
            },
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass(errorClass); //.removeClass(errorClass);
          $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass(errorClass); //.addClass(validClass);
          $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
    });

    $('#checkout').click(function(){
        $(this).attr('disabled','disabled')
        block(true)
        var dataitem = titem.rows().data();
        var dataservice = tservice.rows().data();
        var li = dataitem.length
        var ls = dataservice.length
        
        titem.clear().draw();
        tservice.clear().draw();

        cnt = 0
        $("#cnt").text(cnt)
        $("#cntitem").text(0)
        $("#cntservice").text(0)

        var datafrm = $('#frmEditor').serializeArray();
        datafrm.push({name:'li',value:li},{name:'ls',value:ls})
        for (var i = 0; i < li ; i++) {
            datafrm.push({name:'item-'+[i],value:dataitem[i]})
        }
        for (var a = 0; a < ls ; a++) {
            datafrm.push({name:'service-'+[a],value:dataservice[a]})
        }

        $.ajax({
            url : "<?php echo base_url('C_Ticket_Update/save_item_service');?>",
            type:"POST",
            data:datafrm,
            dataType:"json",
            success:function(event, data){
                if(event.Error==false){
                    block(false)
                    swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                    back()
                    tblitemc.ajax.reload(null,true);
                    tblservicec.ajax.reload(null,true);
                    $('#checkout').removeAttr('disabled')
                } else {
                    block(false)
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                    $('#checkout').removeAttr('disabled')
                }
            },                    
            error: function(jqXHR, textStatus, errorThrown){
                block(false)
                swal({
                    title: "Error",
                    animation: false,
                    type:"error",
                    text: textStatus+' Save : '+errorThrown,
                    confirmButtonText: "OK"
                });
                $('#btnSave').removeAttr('disabled')
            }
        });
    })

    $('#btnSave').click(function(){
        if($('#frmEditor').valid()){
            $(this).attr('disabled','disabled')
            block(true)

            var datafrm = $('#frmEditor').serializeArray();

            $.ajax({
                url : "<?php echo base_url('C_Ticket_Update/save_survey');?>",
                type:"POST",
                data:datafrm,
                dataType:"json",
                success:function(event, data){
                    if(event.Error==false){
                        block(false)
                        swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        });
                        loadfilter()
                        table.ajax.reload(null,true);
                        $('#modal').modal('hide');
                        $('#btnSave').removeAttr('disabled')
                    } else {
                        block(false)
                        swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        });
                        $('#btnSave').removeAttr('disabled')
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    block(false)
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: textStatus+' Save : '+errorThrown,
                        confirmButtonText: "OK"
                    });
                    $('#btnSave').removeAttr('disabled')
                }
            });
        }
    })
})

function back(){
    $('#ttl').replaceWith('<span id="ttl">Survey</span>')
    $('#btnitem').removeClass('btn-success').addClass('btn-info')
    $('#btnservice').removeClass('btn-success').addClass('btn-info')
    $('#btnpreview').removeClass('btn-success').addClass('btn-info')
    $('#btncheckout').removeClass('btn-success').addClass('btn-info')
    $('#tabhome').show()
    $('#tabitem').hide()
    $('#tabservice').hide()
    $('#tabpreview').hide()
    $('#tabckechout').hide()

    $('#printWo').show()
    $('#btnSave').show()
    $('#checkout').hide()

    $('#back1').show()
    $('#back2').hide()
}

function formatmoney(data){
    var angka1 = Math.floor(data)
    if(angka1==null){
        angka1 =0;
      }
      return angka1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
}

function convertToAngka(rupiah)
{
    var rupiah1 = rupiah.replace(/,.*|[^0-9]/g,'');
    var rupiah2 = rupiah1.replace(/,.*|[^0-9]/g,'');
    
    return rupiah2.replace(/,.*|[^0-9]/g,'');
}

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

function printWo(reportno){
    url = "<?php echo base_url('C_workorder/viewprint/');?>"+reportno
    window.open(url);
}

function formatdate(data){
    if (data==null || data=='') {
      return 'Not Set'
    }
    var date = new Date(data);
    var dd = date.getDate();
    var mm = date.getMonth() + 1
    var yyyy = date.getFullYear();
    var h = date.getHours();
    var m = date.getMinutes();
    if (dd < 10) {
      dd = '0' + dd;
    } 
    if (mm < 10) {
      mm = '0' + mm;
    }
    if (h < 10) {
      h = '0' + h;
    } 
    if (m < 10) {
      m = '0' + m;
    } 

    var newdate = dd + '-' + mm + '-' + yyyy + ' ' + h + ':' + m;

    return newdate
  }