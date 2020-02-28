<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
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
           <h3 class="content-header-title">Statement Of Account for Debtor</h3>
        </div>

        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
  
                            <table id="tblcount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No.</th>
                                    <th>Project</th>
                                    <th>Debtor Name</th>
                                    <th>Unit No.</th>
                                    <th>Total Invoice</th>
                                    <th>Total Receipt</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                </tbody>              
                            </table>

                            </div>
                        </div>
                    </div>
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

<!-- JAVASCRIPT -->
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<script type="text/javascript">
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
            responsive: true,
            select: true,
            filter: false,    
            paging:true, 
            "columnDefs": [
                  { className: "text-right", "targets": [4,5] }

                ],
            info:false,        
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
                    "url":"<?php echo base_url('c_soa_debtor/getTable');?>",  
                    "data":{"date_end": function(d){
                    var a = $('#end').val();
                    
                    var b ="";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "date_start": function(d){
                    var a = $('#start').val();
                    
                    var b ="";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "debtor": function(d){
                    var a = $('#txtDebtor').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "unit": function(d){
                    var a = $('#txtUnit').val();
                    
                    var b ="all";
                    if(a == null){
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
                    "project": function(d){
                    var a = $('#txtProject').val();
                    // console.log(a);
                    var b ="";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    }
                        },          
                "type":"POST"
            },

        // ini ada button submit
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"project_descs",name:"project_descs"},  
            {data:"name",name:"name"},
            {data:"lot_no",name:"lot_no"},
            {data:"total_inv",name:"total_inv",
                    render: function (data, type, row) {
                        
                        return  formatNumber(data);
      
                    }
            },
            {data:"total_receipt",name:"total_receipt",
                    render: function (data, type, row) {
                        
                        return  formatNumber(data);
      
                    }
            },
            {
              data: "debtor_acct", name: "debtor_acct",
                    render: function (data, type, row) {
                        var project = row.project_no;
                        var entity = row.entity_cd;
                        return  '<a class="btn btn-success btn-sm" onclick="view(\''+data+'\',\''+project+'\',\''+entity+'\');"" ><i class="fa fa-desktop fa-fw"></i> View</a>&nbsp;<a class="btn btn-success btn-sm" onclick="sendmail(\''+data+'\',\''+project+'\',\''+entity+'\');"" ><i class="fa fa-envelope fa-fw"></i> Send E-mail</a>';
      
                    }
            },
            {data:"project_no",name:"project_no",visible:false}, 
            {data:"entity_cd",name:"entity_cd",visible:false}
            ]
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

$('#search').click(function(){

    
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    if (date_start!='' && date_end=='')
    {
        swal('Warning','Please input date end','warning');
        return;
    }
    if (date_start=='' && date_end!='')
    {
        swal('Warning','Please input date start','warning');
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

    window.location.href = "<?php echo base_url('c_soa_debtor/view/')?>"+debtor+"/"+entity+"/"+project;
}
// function sendmail(debtor,project,entity){
    // document.getElementById('loader').hidden=false;
   
    //          $.ajax({
    //                 url : "<?php echo base_url('c_soa_debtor/sendmail');?>",
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
function sendmail(debtor,project,entity){
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
                        
                        $('#modalTitle').html('Send E-mail');
                        $('div.modal-body').load("<?php echo base_url("c_soa_debtor/mail");?>"+"/"+debtor+"/"+entity+"/"+project);
                        $('#modal').modal('show');
               
                        $('#modal').data('debtor',debtor);
                        $('#modal').data('entity',entity);
                        $('#modal').data('project',project);
}
</script>
