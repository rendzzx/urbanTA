<link href="<?=base_url('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')?>" rel="stylesheet" />
</style>
<style type="text/css">

   /* @media (max-width: 465px){
        #table-respons{
            display: block;
            overflow: auto;
        }
    }*/
    #kotak{
      border:0px;
      background-color: #1AB394;
      color: white;border-radius: 15px;
      display: inline-block;
      height: 140px;
    }
     @media (max-width: 550px){
        #table-respons{
            display: block;
            overflow: auto;
        }
    }
     /*@media (max-width: 1199px){
        #kotak{
            width: 100%;
            height: 50px;
        }
    }*/
    
</style>
<div class="row" id='page'>
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <div class="row">
                <div class="col-lg-2">
                    <h5>Ticket Update</h5>
                </div>
                <!-- <div class="col-lg-9">
                    <div class="input-group">
                        <input type="text" placeholder="Search Ticekt " class="input form-control">
                        <span class="input-group-btn">
                                <button type="button" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                        </span>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="ibox-content">
            <div class="row">
            <?php foreach ($data as $key) {?>
                <div class="col-lg-12" style="">
                    <div class="panel panel-primary">
                        <div class="panel-body" >
                            <div class="row" style="margin-bottom: 0px;">
                                <div class="col-lg-2">
                                    <button type="button" class="btn btn-block pull-left" id="kotak">
                                        <p align="center">
                                            Work Order <br>
                                            # <?php echo $key->report_no; ?> #
                                        </p>
                                        <b>
                                           <p align="center">
                                               <?php 
                                                $status = $key->status;
                                                if($status=='R'){
                                                    $color = 'label-warning';
                                                }
                                                else if($status=='A'){
                                                    $color = 'label-danger';
                                                } 
                                                else if($status=='S'){
                                                    $color = 'label-default';
                                                }
                                                else if($status=='P'){
                                                    $color = 'label-default';
                                                }
                                                else if($status=='F'){
                                                    $color = 'label-default';
                                                }
                                                else if($status=='E'){
                                                    $color = 'label-default';
                                                }
                                                else if($status=='D'){
                                                    $color = 'label-default';
                                                }
                                                else if($status=='M'){
                                                    $color = 'label-default';
                                                }
                                                else if($status=='Y'){
                                                    $color = 'label-default';
                                                }
                                                else{
                                                    echo "Error";
                                                } ?>
                                                <span class="label <?php echo $color ?>">
                                                    <?php
                                                    $status = $key->status;
                                                    if($status=='R'){
                                                        echo 'Open';
                                                        $color = 'label-primary';
                                                    }
                                                    else if($status=='A'){
                                                        echo "Assign";
                                                        $color = 'label-primary';
                                                    } 
                                                    else if($status=='S'){
                                                        echo "Survey";
                                                        $color = 'label-primary';
                                                    }
                                                    else if($status=='P'){
                                                        echo "Process";
                                                        $color = 'label-primary';
                                                    }
                                                    else if($status=='F'){
                                                        echo "Confirm";
                                                        $color = 'label-primary';
                                                    }
                                                    else if($status=='E'){
                                                        echo "Reject";
                                                        $color = 'label-primary';
                                                    }
                                                    else if($status=='D'){
                                                        echo "Done";
                                                        $color = 'label-primary';
                                                    }
                                                    else if($status=='M'){
                                                        echo "Modify";
                                                        $color = 'label-primary';
                                                    }
                                                    else if($status=='Y'){
                                                        echo "Approved";
                                                        $color = 'label-primary';
                                                    }
                                                    else{
                                                        echo "Error";
                                                    }
                                                    ?> 
                                                </span> 
                                           </p> 
                                        </b>
                                        <p align="center">
                                           Assign To <br>
                                            <?php echo $key->assign_to ?>
                                        </p>
                                    </button>
                                    <!-- <div class="panel panel-primary" style="background-color: #1AB394; color: white;border-radius: 15px; display: inline-block">
                                        <div class="panel-body" id="kotak">
                                            <p align="center">
                                                Tanggal
                                            </p>
                                            <b>
                                               <p align="center">
                                                   # Lotno
                                               </p> 
                                            </b>
                                            <p align="center">
                                                <span class="label label-warning">Open</span>
                                            </p>
                                        </div>
                                    </div> -->
                                </div>

                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-9">
                                           <table>
                                                <tr>
                                                    <td><b>Debtor Name</b>&nbsp;&nbsp;</td>
                                                    <td>: <?php echo $key->name ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Category</b>&nbsp;&nbsp;</td>
                                                    <td>: <?php echo $key->descs ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Work Requested</b>&nbsp;&nbsp;</td>
                                                    <td>: <?php echo $key->work_requested ?></td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div class="col-lg-3">
                                            <?php $status = $key->status;
                                                if ($status=="R") {
                                                    $status = '';
                                                }
                                                else{
                                                   $status = 'disabled' ;
                                                }
                                            ?>
                                            <button type="button" class="btn btn-warning" id="survey" onclick="modal(<?php echo $key->complain_no?>,'Survey')">Survey</button>
                                            <button type="button" class="btn btn-danger" id="process" onclick="modal(<?php echo $key->complain_no?>,'Process')">Process</button>
                                            <button type="button" class="btn btn-primary" id="confirm" onclick="modal(<?php echo $key->complain_no?>,'Confirm')">Confirm</button>
                                        </div>
                                    </div>

                                    <table class="table table-bordered" style="width: 100%;margin-bottom: 0px;" id="table-respons">
                                    <thead>
                                    <tr>
                                        <th>Complain No</th>
                                        <th>Priority</th>
                                        <th>Assign Date</th>
                                        <th>Survey Date</th>
                                        <th>Response Time</th>
                                        <th>Estimated Date</th>
                                        <th>Completion Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php
                                                if($key->complain_no==null||$key->complain_no==''){
                                                    echo 'Not Set';
                                                }else{
                                                    echo $key->complain_no;
                                                } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $priority = $key->category_priority;
                                                if($priority==1){
                                                    echo 'Low';
                                                    }
                                                else if($priority==2){
                                                    echo "Medium";
                                                } 
                                                else if($priority==3){
                                                    echo "High";
                                                }
                                                else{
                                                    echo "Error";
                                                }
                                                ?>    
                                            </td>
                                            <td>
                                                <?php
                                                if($key->assigned_date==null||$key->assigned_date==''){
                                                    echo 'Not Set';
                                                }else{
                                                    echo date("d/m/Y h:i", strtotime($key->assigned_date));
                                                } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($key->survey_date==null||$key->survey_date==''){
                                                    echo 'Not Set';
                                                }else{
                                                    echo date("d/m/Y h:i", strtotime($key->survey_date));
                                                } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($key->response_time==null||$key->response_time==''){
                                                    echo 'Not Set';
                                                }else{
                                                    echo date("d/m/Y h:i", strtotime($key->response_time));
                                                } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($key->est_completion_date==null||$key->est_completion_date==''){
                                                    echo 'Not Set';
                                                }else{
                                                    echo date("d/m/Y h:i", strtotime($key->est_completion_date));
                                                } 
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if($key->completion_date==null||$key->completion_date==''){
                                                    echo 'Not Set';
                                                }else{
                                                    echo date("d/m/Y h:i", strtotime($key->completion_date));
                                                } 
                                                ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">

    function modal(id,action){
        var modalClass = $('#modal').attr('class');
        switch (modalClass) {
            case "modal fade bs-example-modal-lg":
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

        $('#modalTitle').html('<h1 align="center">'+action+'</h1>');
        $('div.modal-body').load("<?php echo base_url("c_ticket_update/add/");?>"+id+'/'+action);
        $('#modal').data('id', 0).modal('show');  
    }
</script>