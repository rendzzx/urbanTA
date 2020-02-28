<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/pickers/daterange/daterangepicker.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/pickers/daterange/daterange.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Post Overtime</h3>
      </div>

        <div class="content-header-right col-md-8 col-12 mb-2">
        <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">Overtime Posting
                    </li>
                    <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Survey
                    </li> -->
                    </ol>
                </div>
            </div>
        </div>
    
    </div>
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card" id="card">
                    
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                                <form id="f_ot" enctype="multipart/form-data" method="post" action="">
                                                    <!-- <div class="form-group col-lg-6">
                                                        <label for="pl_project" class="control-label" style="padding-left:0px;"> Periode</label>
                                                        <div class="col-sm-12">
                                                            
                                                            <div class="input-daterange input-group" style="width:100%;">
                                                                <input type="text" class="form-control" id="start_OT" name="start_OT" autocomplete="off" placeholder="Start Date" value=""/>
                                                                <span class="input-group-addon" style="padding: 10px 15px">to</span>
                                                                <input type="text" class="form-control" id="end_OT" name="end_OT" autocomplete="off" placeholder="End Date" value="" />
                                                            </div>
                                                        </div>
                                                    </div> --> 
                                                 <!-- <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label  style="margin-top: 10px;padding-right: 0px;">Remarks</label>
                                               
                                                    <div class="input-group col-lg-12">                            
                                                        <input id="remarks" name="remarks" class="form-control col-lg-12" type="text"> 
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>   -->                        

                                    </form>
                                    <div class="card-body row">
                                        <div class="col-lg-12">
                                            <div class="form-group col-lg-6">
                                            <label >Billing Date</label>
                                                <div class='input-group'>
                                                    <input class="form-control singledate" autocomplete="off"  id="ov_date" name="ov_date" type="text" value="<?php 
                                                                $mydate=date("d-m-Y", strtotime("+1 day"));
                                                                echo "$mydate";//[mday] / $mydate[month] / $mydate[year]";
                                                          ?>"/>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">
                                                            <span class="la la-calendar"></span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>  
                                            <table id="tblovertime" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Debtor Acct</th>
                                                        <th>Name </th>
                                                        <th class="sorting_asc">Action</th>
                                                    </tr>
                                                </thead>
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
</div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
<script src="<?=base_url('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/pickers/daterange/daterangepicker.js')?>" type="text/javascript"></script>
<script type="text/javascript">

var tblovertime;
$(function(){
    var date = new Date();
    date.setDate(date.getDate());
    $('#post_date').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            keyboardNavigation: true,
            forceParse: false//,
            // calendarWeeks: true,
            // startDate: date
        });
    $('#start').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            keyboardNavigation: true,
            forceParse: false//,
            // calendarWeeks: true,
            // startDate: date
        });
    $('#end').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            keyboardNavigation: true,
            forceParse: false,
            // calendarWeeks: true
        });
    
    $('#ov_date').daterangepicker({
        locale: {
              format: 'DD-MM-YYYY',
              cancelLabel: 'Clear'
            },
        autoUpdateInput: false,
        singleDatePicker: true,
        showDropdowns: true,
        startDate: date,
        minDate:date
    });
     $('#ov_date').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD-MM-YYYY'));
          // console.log(picker);
          tblovertime.ajax.reload(null,true);   
      });
    // $('#ov_date').on('change',function(e){
    //     console.log($(this).val());
    //     tblovertime.ajax.reload(null,true);   
    // });
               
   tblovertime = $('#tblovertime').DataTable( 
    {
        "searching": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_overtime_posting/getTable');?>",
            "data":{"sSearch": function(d){
                var search = $('#txt_search').val();
                var b="";
                if(search == null || search==""){
                    return b;
                }{
                    return search;
                }
             }
            
            },             
            "type":"POST"
        },
        "columns": [
            {data:"row_number",name:"row_number"},
            {data:"debtor_acct",name:"debtor_acct"},
            {data:"name",name:"name", sortable: false},
            {data: "debtor_acct",name:"debtor_acct", searchable:false,
                render: function (data, type, row) {
                    return  '<button class="btn btn-primary" onclick="posting(\''+data+'\')"><i class="fa fa-edit"></i> Post</button>';

                    }
            }
     
        ],
     "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });


});


function posting(debtor_acct){
    swal({
        title: 'Are you sure?',
        text: 'Once this posted, it can\'t be cancelled.',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    })
    .then(function(a){
        if (a.value==true) {
            var datafrm = $('#f_ot').serializeArray();
            var ov_date = $('#ov_date').val()
            datafrm.push({name:"debtor_acct",value:debtor_acct},{name:"ov_date",value:ov_date})
            $.ajax({
                url : "<?php echo base_url('c_overtime_posting/posting');?>",
                type:"POST",
                data:datafrm,
                dataType:"json",
                success:function(event, data){
                    if(event.Error==false){
                        block(false);
                        swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        });
                        tblovertime.ajax.reload(null,true);
                    }
                    else {
                        block(false);
                        swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        });
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    block(false);
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: textStatus+' Save : '+errorThrown,
                        confirmButtonText: "OK"
                    });
                }
            });
        }
    })
}

// function cekifpost(businessid,bill_debtor_acct){
//     var remarks = $('#remarks').val();
//     var end = $('#end').val();
//     var start = $('#start').val();
    
//     if(start==''){
//         swal('Information','Please input start period','warning');
//         return;
//     }
//     if(end==''){
//         swal('Information','Please input end period','warning');
//         return;
//     }
//     if(remarks==''){
//         swal('Information','Please input remaks','warning');
//         return;
//     }
//     var modalClass = $('#modal').attr('class');
//                     switch (modalClass) {
//                         case "modal fade bs-example-modal-sm":
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                             break;
//                         case "modal fade bs-example-modal-sm":
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                             break;
//                         default:
//                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                             break;
//                     }

//                     var modalDialogClass = $('#modalDialog').attr('class');
//                     switch (modalDialogClass) {
//                         case "modal-dialog modal-sm":
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                             break;
//                         case "modal-dialog modal-sm":
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                             break;
//                         default:
//                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                             break;
//                     }
//                     $('#modalTitle').html('Post Overtime');
//     $('div.modal-body').html('Are you sure that you want to post this ('+businessid+')? <br>');             
//     $('div.modal-body').append('<div class="modal-footer"></div>');
//     var btnYes = $('<input/>')
//         .attr({
//             id: "btnYes",
//             type: "button",
//             class: "btn btn-danger",
//             onclick: 'posting("'+bill_debtor_acct+'");',
//             value: 'Yes'
//         });
//     var btnNo = $('<a>No</a>').attr({
//         class: "btn btn-default", 'data-dismiss': "modal"
//     });
//     $('div.modal-footer').append(btnYes);
//     $('div.modal-footer').append(btnNo);

//     $('#modal').modal('show');
// }
// function posting(bill_debtor_acct){
//   // posting berdasar bisnis id
//     document.getElementById('loader').hidden=false;
//     var datafrm = $('#f_ot').serializeArray();
//     datafrm.push({name:"bill_debtor_acct",value:bill_debtor_acct});
    
//     // console.log(datafrm);return;
//     // console.log();
//      $.ajax({
//         url : "<?php echo base_url('c_overtime_posting/post_ot');?>",
//         type:"POST",
//         data: datafrm,
//         dataType:"json",
//         success:function(event, data){
//                 $('#modal').modal('hide');
//                 if(event.status !='OK'){
//                     swal("Error",event.pesan,"error");
//                     document.getElementById('loader').hidden=true;
//                 }else{
//                     // swal("Success",event.pesan,"success");
//                     // console.log(event.dtexec);
//                      swal({
//                               title: "Success",
//                               animation: false,
//                               text: event.pesan,
//                               type: "success",
//                               confirmButtonText: "OK"
//                             },
//                             function(){
//                                 $('#remarks').val('');
//                                 $('#start').val('');
//                                 $('#end').val('');
//                                 tblovertime.ajax.reload(null,true); 
//                                 document.getElementById('loader').hidden=true;
//                                 $('#modal').modal('hide');
//                             });
                    
                    
//                 }
                
//         },                    
//         error: function(jqXHR, textStatus, errorThrown){        
//                 swal("Information",textStatus+' Save : '+errorThrown,"warning");
//                 document.getElementById('loader').hidden=true;
//                  // $('#modal').modal('hide');
//         }
//     });
// }

function block(boelan){
    var block_ele = $('#card')
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


