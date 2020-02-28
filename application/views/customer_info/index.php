<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>



<style type="text/css">
  #loader{
    width:80%;
    height:80%;
    position:fixed;
    left: 9%;
    top: 1%;
   z-index: 99999;
    background:url("../img/loading.gif") no-repeat center center     
}
.toolbar{padding-bottom: 10px}
.label-blue {
    background-color: #1a7bb9;
    color: #FFFFFF;
}
#tableLatestTicket tbody tr:hover {
    background-color: #e8f3fc;
    cursor:pointer;
}

#billingoutstanding tbody tr:hover {
    background-color: #e8f3fc;
    cursor:pointer;
}
.top-navigation .nav > li.active > a {
    background: #F5F5F6;
    border-bottom: 1px solid #F5F5F6;
}

.mbal_amt {
                text-align: right;
            }
/*.row{
    margin-top:40px;
    padding: 0 10px;
}*/

.clickable{
    cursor: pointer;   
}

.panel-heading span {
    margin-top: -20px;
    font-size: 15px;
}
th{
    color: #1c84c6;
}
</style>

<script type="text/javascript">
window.history.forward();


var tableLatestTicket;

$(function(){
$('.select2').select2();

   tableLatestTicket = $('#tableLatestTicket').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            // responsive: true,
            responsive: {
                    details: {
                        type: 'column',
                        target: 8
                    }
                },
            select: true,
            filter:false,
            
            // searchDelay:null,
            buttons: [
//                 
                {
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                       
                    }
                },
                {
                    text: ' View', className: 'biru-bg fa fa-desktop hidden',
                    action: function () {
                      
                        var rows = tableLatestTicket.rows('.selected').indexes();
                        if (rows.length < 1) {                            
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tableLatestTicket.rows(rows).data();
                        // var status = data[0].STATUS;
                        var ID = data[0].rowID_agent;                        
                        
                        
        
                        
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

                        $('#modalTitle').html('View Agent');

                        $('div.modal-body').load("<?php echo base_url("c_agent_approval/viewprofile");?>"+"/"+ID);

                        $('#modal').data('id', ID).modal('show');

                    }
                },
                
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('C_customer_info/tableLatestTicket');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             },
         "debtor_acct": function(d){
                var a = $('#debtor_name').val();
                // console.log(a);
                var b ="all";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             }},           
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number",searchable:false,orderable:false } ,
            {
              // data: "rowID", name: "rowID", visible: false
              data: "status", name: "status",
                            render: function (data, type, row) {
                                
                                var warna = '';
                                var descs = '';
                                if(data=='M'){
                                    warna = 'label label-purple';
                                    descs = 'Modify';
                                }else if(data=='A'){
                                    warna = 'label label-warning';
                                    descs = 'Assign';
                                }else if(data=='S'){
                                    warna = 'label label-purple';
                                    descs = 'Survey';
                                }else if(data=='P'){
                                    warna = 'label label-blue';
                                    descs = 'Prosess';
                                }
                                else if(data=='R'){
                                    warna = 'label label-primary';
                                    descs = 'Open';
                                }

                                return  '<span class="'+warna+'">'+descs+'</span>';
                           
                        }
           
            },            
            {
                data:"report_no",name:"report_no",
                render: function (data, type, row) {
                                
                                
                                var work_req = row.work_requested;
                              
                                return  '<span style="color:#870000; font-weight:bold;">'+data+'</span><br><span>'+work_req+'</span>';
                           
                        }
            },
            {
                data:"category_descs",name:"category_descs"
               
            },
            {
                data:"name",name:"name",
                render: function (data, type, row) {
                                
                                
                                var hp = row.hand_phone;
                              
                                return  '<span>'+data+'</span><br><span>'+hp+'</span>';
                           
                        }
            },             
            {data:"lot_no",name:"lot_no"},
            {data:"reported_date_string",name:"reported_date_string"},
            {
                data:"report_no",name:"report_no",
                render: function (data, type, row) {
                                
                                
                                var rowid = row.rowID;
                                // return  '<button class="btn btn-primary" onclick="viewticket(\''+rowid+'\')">View</button>';
                                return  '<button class="btn btn-primary" onclick="viewticket(\''+rowid+'\')">View</button>';
                           
                        }
            },
             {data:"columdef",name:"columdef"},
            {data:"rowID",name:"rowID",visible:false},
            {data:"debtor_acct",name:"debtor_acct",visible:false},
            {data:"complain_no",name:"complain_no",visible:false}
               

            
            ],
            "columnDefs": [ {
                    className: 'control',
                    orderable: false,
                    targets:   8
                } ]
    });
    

});

function viewticket(rowid){
    // alert(ticketno);
    // window.location.href="<?php echo base_url('C_customer_info/viewticket/')?>"+rowid;
    // alert("HAH");
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

    $('#modalTitle').html('View Tickets');
    $('div.modal-body').empty();
    // console.log(rowid);return false;
    $('div.modal-body').load("<?php echo base_url('C_customer_info/viewticket/')?>"+rowid);
    // $('div.modal-body').load("<?php echo base_url('C_customer_info/viewticket/')?>"+rowid);
    // <button type="button" class="close" data-dismiss="modal">

    $('#modal').data('id', rowid).modal('show');

}
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
var billingoutstanding;

$(function(){
$('.select2').select2();

   billingoutstanding = $('#billingoutstanding').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            // responsive: true,
            responsive: {
                    details: {
                        type: 'column',
                        target: 7
                    }
                },
            
            select: true,
            filter:false,
            
            // searchDelay:null,
            buttons: [
//                 
                {
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                       
                    }
                },
                {
                    text: ' View', className: 'biru-bg fa fa-desktop hidden',
                    action: function () {
                      
                        var rows = billingoutstanding.rows('.selected').indexes();
                        if (rows.length < 1) {                            
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = billingoutstanding.rows(rows).data();
                        // var status = data[0].STATUS;
                        var ID = data[0].rowID_agent;                        
                        
                        
        
                        
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

                        $('#modalTitle').html('View Agent');

                        $('div.modal-body').load("<?php echo base_url("c_agent_approval/viewprofile");?>"+"/"+ID);

                        $('#modal').data('id', ID).modal('show');

                    }
                },
                
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('C_customer_info/billingoutstanding');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             },
             "debtor_acct": function(d){
                var a = $('#debtor_name').val();
                // console.log(a);
                var b ="all";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             }},           
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number",searchable:false,orderable:false } ,
            {data:"doc_no",name:"doc_no"},         
            {data:"doc_date",name:"doc_date",
                    render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               
                               
                               var aa = day+"/"+month+"/"+year;
                               
                               return aa;
                               
                               

                           }
            },   
            {data:"due_date",name:"due_date",
                render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               
                               
                               var aa = day+"/"+month+"/"+year;
                              
                               return aa;
                               
                               

                           }
            },           
            {data:"descs",name:"descs"},
            {data:"currency_cd",name:"currency_cd"},
            {data:"mbal_amt",name:"mbal_amt", class:"mbal_amt",
            render: function (data, type, row) {
                // return formatNumber(data);

                  return formatNumber(parseFloat(data));
              }
            },
            {data:"columdef",name:"columdef"}
            
        ],

        "columnDefs": [ {
                    className: 'control',
                    orderable: false,
                    targets:   7
                } ]
        
           
    });
     

});


$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
    if(!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
    }
});


var tableunit;

$(function(){
// $('.select2').select2();

   tableunit = $('#tableunit').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
            
            // searchDelay:null,
            buttons: [
//                 
                {
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                       
                    }
                },
                {
                    text: ' View', className: 'biru-bg fa fa-desktop hidden',
                    action: function () {
                      
                        var rows = billingoutstanding.rows('.selected').indexes();
                        if (rows.length < 1) {                            
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = billingoutstanding.rows(rows).data();
                        // var status = data[0].STATUS;
                        var ID = data[0].rowID_agent;                        
                        
                        
        
                        
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

                        $('#modalTitle').html('View Agent');

                        $('div.modal-body').load("<?php echo base_url("c_agent_approval/viewprofile");?>"+"/"+ID);

                        $('#modal').data('id', ID).modal('show');

                    }
                },
                
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('C_customer_info/getUnit');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             },
             "debtor_acct": function(d){
                var a = $('#debtor_name').val();
                // console.log(a);
                var b ="all";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             }},           
            "type":"POST"
        },
        "columns": [
            
            {data:"lot_description",name:"lot_description"},         
            {data:"build_up_area",name:"build_up_area"},   
            {data:"debtor_type",name:"debtor_type", hidden:true},           
           
        ]
           
    });
    

});
</script>

<!-- <div class="row"   id="chartt">  -->
<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <div class="judulprojek"><?php echo $ProjectDescs; ?></div>
        
        <div class="tittle-top pull-right" >Customer Info</div>
    </div>
    <br>
    <div class="form-group">
        <br>
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;font-size: 14px;">Customer</label>
            <div class="col-sm-2">
                <select name="debtor_name" id="debtor_name" data-placeholder="Select Debtor." class="select2" style="width:250px;" tabindex="2">
                    <option value=""></option>
                    <!-- <option value="all">All</option> -->
                    <?php echo $dtdebtor?>   
                    
                </select>
                
            </div>
            <br>
        </div>

    </section><br>
    <div id="loader" class="loader" hidden="true"></div>
    <section class="content" >
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Profile Details</h5>
                    </div>
                    <div id="profildebtor">
                    <div class="ibox-content" style="height: 450px;padding-left: 0;padding-right: 0">
                        <h3 class="m-b-xs" style="color: #1c84c6; margin-left: 20px;"><strong><?php if(!empty($databusiness)){ echo $databusiness[0]->name; } else {echo '&mdash; ';}?></strong></h3>

                        <!-- <div class="font-bold">Graphics designer</div> -->
                        <address class="m-t-md" style="margin-left: 30px;">
                            
                            <img src="<?php echo base_url('img/mobile.png')?>" style="width:20px;height: 20px;margin-bottom: 4px">&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->hand_phone; } else {echo '&mdash; ';}?><br>
                            <!-- <img src="<?php echo base_url('img/mail.png')?>" style="width:20px;height: 20px;margin-bottom: 4px">&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->email_addr;} else {echo '&mdash; ';}?><br>  --> 
                            <img src="<?php echo base_url('img/mail.png')?>" style="width:20px;height: 20px;margin-bottom: 4px">&nbsp;&nbsp;&nbsp;<?php echo $this->session->userdata('Tsemail');?><br> 
                            <img src="<?php echo base_url('img/id.png')?>" style="width:20px;height: 20px">&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo  $databusiness[0]->ic_no;} else {echo '&mdash; ';}?><br>  
                            <!-- <abbr title="Phone">P:</abbr> (123) 456-7890 -->
                            
                        </address>
                        <div id="tabs">
                            <div class="panel-heading">
                                <div class="panel-options">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-1" data-toggle="tab" style="color: #1c84c6;">Address</a></li>
                                        <li class=""><a href="#tab-2" data-toggle="tab" style="color: #1c84c6;">Mailing</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body" style="padding: 15px 0px">

                                <div class="tab-content" >
                                    <div class="tab-pane active" id="tab-1">
                                        <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)) { echo $databusiness[0]->address1; } else {echo '&mdash; ';}?><br>
                                         <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)) { echo $databusiness[0]->address2; } else {echo '&mdash; ';}?><br>  
                                         <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)) { echo $databusiness[0]->address3;} else {echo '&mdash; ';}?>&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->post_cd;} else {echo '&mdash; ';}?>

                                    </div>
                                    <div class="tab-pane" id="tab-2">

                                        <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo  $databusiness[0]->mail_addr1;} else {echo '&mdash; ';}?><br>
                                        <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo  $databusiness[0]->mail_addr2;} else {echo '&mdash; ';}?> <br>  
                                        <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->mail_addr3;} else {echo '&mdash; ';}?>&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->post_cd;} else {echo '&mdash; ';}?>
     
                                    </div>
                                </div>

                            </div>
                            <div class="panel-heading" style="width: 100%; margin: 0 auto">
                               <table width="40%" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Unit</th>
                                                <th>Area</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($dataUnit)){ 
                                                    foreach ($dataUnit as $row) {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $row->lot_description;?></td>
                                                    <td><?php echo $row->build_up_area." m<sup>2</sup>";?></td>
                                                </tr>
                                                <?php }} else {
                                                    ?>
                                                <tr>
                                                    <td>&mdash;</td>
                                                    <td>&mdash;</td>
                                                </tr>
                                                    <?php 
                                                    }?>
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                        
                    </div> 
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <!-- <h5>Monthly Electricity Usage</h5> -->
                        <div class="pull-left"><h5>Monthly Utilities Usage</h5></div>
                       
                    </div>
                    <div class="ibox-content" style="height: 450px">

                        <div class="row">
                           <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Unit</label>
                                    <div class="col-sm-2">
                                        <select name="unit_name" id="unit_name" data-placeholder="Choose Unit." class="select2" style="width:250px;" tabindex="2">
                                            <option value=""></option>
                                            
                                            <?php echo $chooseunit?>   
                                            
                                        </select>
                                        
                                    </div>

                                </div>
                                   <!--  <div class="col-sm-12"><br><br>
                                      <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #00a1e4 2px solid;">
                                        <b>Rental and Service Charge</b>
                                        </div>
                                    </div> -->
                                    <br><br>
                                    <?php

                                    if(empty($js3))
                                    {
                                        echo '';

                                    }
                                    else
                                    {
                                        $h2='';
                                        // $h2.='<div class="col-lg-12">';
                                        // $h2.='<div class="ibox float-e-margins">';
                                        // $h2.='<div class="ibox-title">';
                                        // $h2.='<b>Unit </b> &emsp;';
                                        // $h2.='<select name="unit_name" id="unit_name" data-placeholder="Choose Unit." class="select2" style="width:140px;">';
                                        // $h2.='    <option value=""></option>';
                                        // $h2.=     $chooseunit;
                                        // $h2.='</select>';
                                        // $h2.='</div>';
                                        $h2.='<div class="ibox-content" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;">';
                                        $h2.='<div>';
                                        
                                        $h2.='<div id="barproperty" height="160" width="120" style="position: fixed;"></div>';
                                        $h2.='<div class="container" style="margin:0 auto;"></div>';
                                        $h2.='</div>';
                                        $h2.='</div>';
                                        // $h2.='</div>';
                                        // $h2.='</div>';
                                        echo $h2;
                                    }
                                    ?> 
                                                                  
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>

    <section class="content" >
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                <div class="ibox-title">
                            <h5>Billing Outstanding</h5>
                        </div>
                <div class="ibox-content">
                
                    <div class="table-responsive">
                        <table id="billingoutstanding" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>    
                                <th >No</th>
                                <th>Doc No</th>
                                <th>Doc Date</th>  
                                <th>Due Date</th>                                   
                                <th>Description</th>
                                <th>Currency</th> 
                                <th style="color: #ff2828; text-align: right;">Outstanding Amount</th>
                                <th></th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
             </div>
            </div>
        </div>
    </section>

    <section class="content" >
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                <div class="ibox-title">
                            <h5>Ticket History</h5>
                        </div>
                <div class="ibox-content">
                   
                    <div class="table-responsive">
                        <table id="tableLatestTicket" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>    
                                <th>No</th>
                                <th>Status</th>
                                <th>Ticket No</th> 
                                <th>Category</th>                                       
                                <th>Requested Name</th>
                                <th>Lot No</th> 
                                <th>Reported Date</th>                               
                                <th>Action</th>
                                <th></th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>


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
var isdebtor = '<?php echo $ddx;?>';
$('#debtor_name').prop("disabled",<?php echo $ddx;?>);
// alert(isdebtor);
if (isdebtor == 'true') {
    $(".panel-primary").hide();
    $(".panel-danger").show();
}else{
    $(".panel-primary").show();
    $(".panel-danger").hide();
}
// $('#unit_name').prop("disabled",<?php echo $ddx;?>);
    $('#debtor_name').change(function(){
        // alert('a');
        document.getElementById('loader').hidden=false; 
        var debtor = $(this).find(':selected').val();          
          if(debtor!=='') {
            var site_url = '<?php echo base_url("C_customer_info/zoom_lotno/")?>'+debtor+'/view';
            $.post(site_url,
              {ent:debtor},
              function(data,status) {
                $("#unit_name").empty();
                $("#unit_name").append(data);
                $("#unit_name").trigger('change');
              }
            );
          } else {
            $("#unit_name").empty();
          }
        var businessid = $(this).find(':selected').data('businessid');
        var debtor= $(this).find(':selected').val();
        billingoutstanding.ajax.reload( function ( json ) 
        {
            
            if(json.recordsTotal>0){
                $(".panel-primary").hide();
                $(".panel-danger").show();
            }else{
                $(".panel-primary").show();
                $(".panel-danger").hide();
            }
        } );

           
            $('#profildebtor').load( "<?php echo base_url('C_customer_info/goto_table');?> #profildebtor",{"business_id":businessid,"debtor_acct":debtor});
            tableLatestTicket.ajax.reload(null,true);
             document.getElementById('loader').hidden=true;      
    });


</script>
<script type="text/javascript">
    var barprop;

    <?=$js3?>

    $('#unit_name').on("change", function(e) { 
    var debtor = $('#debtor_name').val();
    var unit = $(this).find(':selected').val();
    // alert(unit);
    document.getElementById('loader').hidden=false;
     $.ajax({
                    url : "<?php echo base_url('C_customer_info/barproperty');?>",
                    type:"POST",
                    data: {lot_no:unit,
                          debtor:debtor
                          },
                    dataType:"json",
                    success:function(event, data){
                    // console.log(event.dataE);
                    if(event.dataE!=0) {
                        var arrayE = event.dataE.split(",");
                    } else{
                        var arrayE = ['0'];
                    }
                    if(event.dataW!=0) {
                        var arrayW = event.dataW.split(",");
                    } else{
                        var arrayW = ['0'];
                    }
                    if(event.dataG!=0) {
                        var arrayG = event.dataG.split(",");
                    } else{
                        var arrayG = ['0'];
                    }
                    var arraymonth = event.category.split(",");
                   
                   
                    // console.log(arraymonth+"--<br>--"+arrayW+"--<br>--"+arrayE+"--<br>--"+arrayG);
                    barprop.unload({
                      done: function() {
                        barprop.load({ 
                          columns: [
                            arraymonth,arrayW,arrayE,arrayG
                          ]
                        });  
                      }
                    });
                    document.getElementById('loader').hidden=true;
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                    
                                swal({
                                      title: "Information",
                                      animation: false,
                                      type:"error",
                                      text: textStatus+' Save : '+errorThrown,
                                      confirmButtonText: "OK"
                                    });
                    }
                    });
});
</script>