<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
<script type="text/javascript">
window.history.forward();
</script>
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
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
	<div class="row border-bottom white-bg dashboard-header">  
		<div class="form-group">
			<div class="tittle-top pull-right">Billing History</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</div> <br>
		 


        <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Debtor</label>
            <div class="col-sm-10">
                <select name="txtDebtor" id="txtDebtor"   data-placeholder="Choose Debtor" class="select2" style="width:302px;" tabindex="2">
                    <option value=""></option>
                    
                    <?php
                    echo $cbDebtor;

                    ?>
                </select>

            </div>
            <br>
        </div>

        <div class="form-group" style="margin-bottom: 5px">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Periode</label>
            <!-- <div class="col-sm-10"> -->

            <div class="input-daterange input-group" >
            <div class="col-sm-5">
                <input type="text" class="form-control" id="start" name="start" style="height: 30px;width: 150px"  placeholder="Start Date" value=""/>
            </div>
            <div class="col-sm-5">
                 <input type="text" class="form-control" id="end" name="end"  style="height: 30px;width: 150px"  placeholder="End Date" value=""/>
            </div>
            </div>
         
        </div>
    <!--     <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Year</label>
            <div class="col-sm-10">
                <select name="txtYear" id="txtYear"  data-placeholder="Choose Year" class="select2" style="width:302px;" tabindex="2">
                    <option value=""></option>
                    <?php
                    echo $cbyear;

                    ?>
                </select>

            </div>
            <br>
        </div> -->

       <!--  <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Document Date</label>
            <div class="col-sm-3">
              
                <div class="input-daterange input-group" style="width:250px;">
                    <input type="text" class="form-control" id="start" name="start" value=""/>
                    <span class="input-group-addon">to</span>
                    <input type="text" class="form-control" id="end" name="end" value="" />
                </div>
            </div>

            </div> -->
        
	</div>
        <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                        <div class="box-body"> 
                        <br>    
                            <table id="tblcount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No.</th>
                                    <th>Document No</th>
                                    <th>Document Date</th>
                                    <th>Due Date</th>
                                    <th>Description</th>
                                    <th>Currency</th>
                                    <th>Amount</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                </tbody>              
                            </table>

                        </div>                        
                    <!-- </div> -->
                </div>
            </div>            
        </div>
    </div>

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
    <!-- Bootstrap Modal -->

<script type="text/javascript">
$('#txtDebtor').prop("disabled",<?php echo $ddx;?>);
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
$('.select2').select2();
$('#end').datepicker({
        format: 'dd/mm/yyyy',
        onSelect: function(dateText, inst) {
            $("input[name='end']").val(dateText);
        }
    });
    $('#start').datepicker({
        format: 'dd/mm/yyyy',
        onSelect: function(dateText, inst) {
            $("input[name='start']").val(dateText);
        }
    });
var tblcount;
$(function(){
   
   tblcount = $('#tblcount').DataTable( 
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
            filter: false,    
            paging:true, 
            "columnDefs": [
                  { className: "text-right", "targets": [6] }

                ],
            info:true,        
            buttons: [
                
                {
                extend: 'collection',
                className: 'btn biru-bg fa fa-star',
                text: ' Action',
                buttons: [
                    {
                        extend: 'print'
                    },
                    {
                        extend: 'excel'
                    },
                    {
                        extend: 'pdf'
                    }
                    
                    // 'print'
                            ]           
                },
                
               
                {
                    text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 tblcount.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }

                    }
                }
                
                
            ],
 
        "serverSide": true,
        "ajax":{
                    "url":"<?php echo base_url('c_billing_history/getTable');?>",  
                    "data":{"date_end": function(d){
                    var a = $('#end').val();

                    var date = new Date(parseInt(a.substr(0,10)));
                    var year =a.substr(6,4);
                    var month=a.substr(3,2);
                    var day =a.substr(0,2);
                               
                  var aa1 = year+"/"+month+"/"+day;
                   // console.log(aa);
                    var b ="";
                    if(aa1 == "//"){
                        return b;
                    }{
                        return aa1;
                    }
                   
                    },
                    "date_start": function(d){
                    var a = $('#start').val();
                    var date = new Date(parseInt(a.substr(0,10)));
                    var year =a.substr(6,4);
                    var month=a.substr(3,2);
                    var day =a.substr(0,2);
                               
                  var aa1 = year+"/"+month+"/"+day;
                  // console.log(aa);
                    var b ="";
                    if(aa1 == "//"){
                        return b;
                    }{
                        return aa1;
                    }
                    // console.log(a);
                    },
                    "debtor": function(d){
                    var a = $('#txtDebtor').val();
                    
                    var b ="lol";
                    if(a == null || a ==""){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },"txtYear": function(d){
                    var a = $('#txtYear').val();
                    
                    var b ="";
                    if(a == null || a ==""){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "sSearch": function(d){
                    var a = $('#txt_search').val();
                    
                    var b ="";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }

                    },

                        },          
                "type":"POST"
            },

        // ini ada button submit
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"doc_no",name:"doc_no"},  
            {data:"doc_date",name:"doc_date",
                    render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               
                               
                               var aa = year+"/"+month+"/"+day;
                               
                               return aa;
                               // return data;
                               

                           }
            },   
            {data:"due_date",name:"due_date",
                render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               
                               
                               var aa = year+"/"+month+"/"+day;
                              
                               return aa;
                               // return data;
                               

                           }
            }, 
            {data:"descs",name:"descs"},
            {data:"currency_cd",name:"currency_cd"},  
            {data:"mdoc_amt",name:"mdoc_amt",
                    render: function (data, type, row) {
                        
                        return  formatNumber(data);
      
                    }
            },
             {data:"columdef",name:"columdef"}
            // {data:"total_receipt",name:"total_receipt",
            //         render: function (data, type, row) {
                        
            //             return  formatNumber(data);
      
            //         }
            // },
            // {
            //   data: "debtor_acct", name: "debtor_acct",
            //         render: function (data, type, row) {
            //             var project = row.project_no;
            //             var entity = row.entity_cd;
            //             return  '<a class="btn btn-success btn-sm" onclick="view(\''+data+'\',\''+project+'\',\''+entity+'\');"" ><i class="fa fa-desktop fa-fw"></i> View</a>&nbsp;<a class="btn btn-success btn-sm" onclick="sendmail(\''+data+'\',\''+project+'\',\''+entity+'\');"" ><i class="fa fa-envelope fa-fw"></i> Send E-mail</a>';
      
            //         }
            // },
            // {data:"project_no",name:"project_no",visible:false}, 
            // {data:"entity_cd",name:"entity_cd",visible:false}
            ],
            "columnDefs": [ {
                    className: 'control',
                    orderable: false,
                    targets:   7
                } ]
    });

    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblcount.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblcount.ajax.reload(null,true);   
        }
    });

});
function fn_search(){
    var a = $('#txt_search').val();
    tblcount.ajax.reload(null,true); 
    }

$('#txtDebtor').change(function(){

    var debtorr = $("#txtDebtor").val();
    // var date_end = $('#end').val();
    // var date_start = $('#start').val();
    if (debtorr=="")
    {
        swal('Warning','Please Choose Debtor','warning');
        return;
    }
    // if (date_start!='' && date_end=='')
    // {
    //     swal('Warning','Please input date end','warning');
    //     return;
    // }
    // if (date_start=='' && date_end!='')
    // {
    //     swal('Warning','Please input date start','warning');
    //     return;
    // }
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblcount.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});
$('#txtYear').change(function(){

    var debtorr = $("#txtYear").val();

    if (debtorr=="")
    {
        swal('Warning','Please Choose Year','warning');
        return;
    }

    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblcount.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});

$('#end').change(function(){

    var debtorr = $("#txtDebtor").val();
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    if (debtorr=="")
    {
        swal('Warning','Please Choose Debtor','warning');
        return;
    }
    // if (date_start!='' && date_end=='')
    // {
    //     swal('Warning','Please input date end','warning');
    //     return;
    // }
    if (date_start=='' && date_end!='')
    {
        $("#start").val("01/01/2017");
        return;
    }
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblcount.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});

function view(debtor,project,entity){

    window.location.href = "<?php echo base_url('c_billing_history/view/')?>"+debtor+"/"+entity+"/"+project;
}
// function sendmail(debtor,project,entity){
    // document.getElementById('loader').hidden=false;
   
    //          $.ajax({
    //                 url : "<?php echo base_url('c_billing_history/sendmail');?>",
    //                 type:"POST",
    //                 data: { debtor:debtor,
    //                     project:project,
    //                     entity:entity},
    //                 dataType:"json",
    //                 success:function(event, data){
    //                     document.getElementById('loader').hidden=true;
                    
    //                     if(data=='success'){                          
    //                       swal("Information",event.Pesan,"success");
    //                     } else {
    //                         swal("Information",event.Pesan,"error");

    //                     } 

    //                 },                    
    //                 error: function(jqXHR, textStatus, errorThrown){
    //                     document.getElementById('loader').hidden=true;
    //                     swal("Information",textStatus+' Save : '+errorThrown,"error");
                     
    //                 }
    //                 });
// }
// function sendmail(debtor,project,entity){
//     var modalClass = $('#modal').attr('class');
//                         switch (modalClass) {
//                             case "modal fade bs-example-modal-md":
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                                 break;
//                             case "modal fade bs-example-modal-sm":
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                                 break;
//                             default:
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
//                                 break;
//                         }

//                         var modalDialogClass = $('#modalDialog').attr('class');
//                         switch (modalDialogClass) {
//                             case "modal-dialog modal-md":
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                                 break;
//                             case "modal-dialog modal-sm":
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                                 break;
//                             default:
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
//                                 break;
//                         }
                        
//                         $('#modalTitle').html('Send E-mail');
//                         $('div.modal-body').load("<?php echo base_url("c_billing_history/mail");?>"+"/"+debtor+"/"+entity+"/"+project);
//                         $('#modal').modal('show');
               
//                         $('#modal').data('debtor',debtor);
//                         $('#modal').data('entity',entity);
//                         $('#modal').data('project',project);
// }
</script>
