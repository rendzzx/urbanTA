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
           <h3 class="content-header-title">Statement Of Account</h3>
        </div>

    </div>
    <div class="content-detached content-right">
        <div class="content-body">
           <div class="col-sm-12" style="z-index: 1;">
              <div class="card" style="z-index: 1;">
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
     <div class="sidebar-detached sidebar-left sidebar-sticky">
        <div class="sidebar">
           <div class="sidebar-content card d-none d-lg-block">
              <div class="card-body">
                 <h3 class="card-title"><i class="ft-filter"></i>&nbsp;&nbsp;Filter</h3>
                  <div class=" form-group">
                <label for="pl_project" class=" control-label" style="padding-left:0px;"> Choose Project</label>
         
                    <select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="select2" style="width:250px;" tabindex="2">
                        <option value=""></option>
                        <?php echo $cbProject;?>   
                        
                    </select>
            <input type="hidden" name="cons" id="cons">
          
            </div>
            <div class="form-group">
                <label for="pl_project" class="control-label" style="padding-left:0px;"> Document Date</label>
               
                  
                    <div class="input-daterange input-group" style="width:250px;">
                        <input type="text" class="form-control" autocomplete="false" id="start" name="start" value=""/>
                        <span class="input-group-addon">to</span>
                        <input type="text" class="form-control" autocomplete="false" id="end" name="end" value="" />
                    </div>
                   
           
           
            </div>
            <div class="form-group">
                <label for="pl_project" class=" control-label" style="padding-left:0px;"> Choose Debtor</label>
          
                    <select name="txtDebtor" id="txtDebtor" data-placeholder="Choose Debtor" class="select2" style="width:250px;" tabindex="2">
                  
                        
                        <?php $group = $this->session->userdata('Tsusergroup');
                        // $group='DEBTOR';
                        $debtor_acct = $this->session->userdata("Tsdebtor_acct");
                        foreach ($cbDebtor as $row) 
                        {
                            if($group == 'DEBTOR'){
                                if($row->debtor_acct==$debtor_acct){
                                    $pilih = 'selected="1"';
                                }else{
                                    
                                    $pilih = '';
                                }
                                echo '<option value="'.$row->debtor_acct.'" '.$pilih.'>'.$row->debtor_acct.' - '.$row->name.'</option>';
                            }else{
                                echo '<option></option><option value="all">All</option>';
                                echo '<option value="'.$row->debtor_acct.'">'.$row->debtor_acct.' - '.$row->name.'</option>';
                            }
                            
                        }
                        ?> 
                        
                    </select>

           
            </div>
            <div class="form-group">
                <label for="pl_project" class="control-label" style="padding-left:0px;"> Choose Unit</label>
               

                    <select name="txtUnit" id="txtUnit" data-placeholder="Choose Unit" class="select2" style="width:250px;" tabindex="2">
                        <option></option>
                        <option value="all">All</option> 
                         <?php 
                        foreach ($cbUnit as $row) 
                        {
                            echo '<option value="'.$row->lot_no.'">'.$row->lot_no.'</option>';
                        }
                        ?> 

                    </select>
                                
            </div>
            <button id="search" class="btn btn-primary" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>

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
$('#cons').val($('#txtProject').find(':selected').data('cons'));
$('.select2').select2();
$('#end').datepicker({
        format: 'dd/mm/yyyy',
        onSelect: function(dateText, inst) {
            $("input[name='end']").val(dateText);
            alert(dateText);
        }
    });

    $('#start').datepicker({        
        onSelect: function(date) {
            $("input[name='start']").val(date);
            console.log('select');
        }
        ,format: 'dd/mm/yyyy'
    });//.on("change",function(){
    //   var st = $(this).val();
    //     var ed = $('#end').val();
    //     var site_url = '<?php echo base_url("c_soa/cek_startdate")?>';
    //     $.post(site_url,
    //        {st:st,ed:ed},
    //        function(data) {
    //         if(data==0){
    //             alert("Can't be More 1 Year!");
    //             $(this).val('');
    //             // return;
    //         }
    //     });
    // });
    
var tblcount;
$(function(){
   // $('#start').change(function(){
    
   //      // alert($(this).val());
   //      // $(this).val('');
   //      var st = $(this).val();
   //      var ed = $('#end').val();
   //      var site_url = '<?php echo base_url("c_soa/cek_startdate")?>';
   //      $.post(site_url,
   //         {st:st,ed:ed},
   //         function(data) {
   //          if(data==0){
   //              alert("Can't be More 1 Year!");
   //              $(this).val('');
   //              // return;
   //          }
   //      });

   // });
   tblcount = $('#tblcount').DataTable( 
    {
            "language": {
            "decimal": ",",
            "thousands": ".",
        },
         "dom": '<"toolbar tblsurvey">frtip',
        select: true,
      
        order: [[ 0, 'asc' ]],
        "serverSide": true,
            select: true,   
            paging:true, 
            "columnDefs": [
                  { className: "text-right", "targets": [4,5] }

                ],
               
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
                }
            ],
 
        "serverSide": true,
        "ajax":{
                    "url":"<?php echo base_url('c_soa/getTable');?>",  
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
                    if(a == null || a ==''){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "unit": function(d){
                    var a = $('#txtUnit').val();
                    
                    var b ="all";
                    if(a == null|| a ==''){
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
                    console.log(a);
                    var b ="all";
                    if(a == null|| a ==''){
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
                        var start = $('#start').val();
                        var end = $('#end').val();
// console.log()
                        return  '<div class="row" style="color:white"><a class="btn btn-info btn-sm" onclick="view(\''+data+'\',\''+project+'\',\''+entity+'\',\''+start+'\',\''+end+'\');"" ><i class="ft-eye"></i> </a>&nbsp;<a class="btn btn-primary btn-sm" onclick="sendmail(\''+data+'\',\''+project+'\',\''+entity+'\',\''+start+'\',\''+end+'\');"" ><i class="ft-mail"></i></a></div>';
      
                    }
            },
      
            {data:"project_no",name:"project_no",visible:false}, 
            {data:"entity_cd",name:"entity_cd",visible:false}
            ]
    });




});

$('#txtProject').change(function(){
    $('#cons').val($(this).find(':selected').data('cons'));
    // var ent = $(this).find(':selected').val();          
    //       if(ent!=='') {
    //         var site_url = '<?php echo base_url("c_soa/zoom_project")?>';
    //         $.post(site_url,
    //           {ent:ent},
    //           function(data,status) {
    //             $("#TxtprojectNo").empty();
    //             $("#TxtprojectNo").append(data);
    //             $("#TxtprojectNo").trigger('chosen:updated');
    //           }
    //         );
    //       } else {
    //         $("#TxtprojectNo").empty();
    //       }
});

$('#search').click(function(){
    // alert($('#txtProject').val());
    
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
        var site_url = '<?php echo base_url("c_soa/cek_startdate")?>';
        $.post(site_url,
           {st:date_start,ed:date_end},
           function(data) {
            if(data==0){
                swal('Warning',"Can't be More 1 Year from End Date",'warning');
                return;
            }else{
                   block(true,'.content-body');
                    var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                            tblcount.ajax.reload(null,true);
                            block(false,'.content-body');
                        },1000);
                    }
            }
        });
 
    
});
function view(debtor,project,entity,start,end){
    var param = '';
    var start = $('#start').val();
    var cons = $('#cons').val();
    var end = $('#end').val();
    if(start!='' && end!=''){
        param = '/'+start+'/'+end;
    }
    // alert(start);
    // return;
    var parameter = debtor+"/"+entity+"/"+project.trim()+"/"+cons+param
    var url = "<?php echo base_url('c_soa/view/')?>"+btoa(parameter);
    // alert(url);
    // return;
    window.location.href = url;
}

function sendmail(debtor,project,entity,start,end){
    // block(true,'#modalbody');
            $('#modalbody').html("");
            $('#modalheader').addClass('bg-primary white');
            $('#modaldialog').addClass('modal-lg');
            $('#modaltitle').addClass('white');
            $('#modal').modal({backdrop: 'static', keyboard: false})  
            $('#modaltitle').html('Send email');
            $('#modalbody').load("<?php echo base_url("c_soa/mail");?>"+"/"+debtor+"/"+entity+"/"+project+"/"+start+"/"+end);
            
            // $('#modal').data('survey_id', survey_id).modal('show');
            $('#modal').modal('show');
               
                        $('#modal').data('debtor',debtor);
                        $('#modal').data('entity',entity);
                        $('#modal').data('project',project);
    // var modalClass = $('#modal').attr('class');
    //                     switch (modalClass) {
    //                         case "modal fade bs-example-modal-md":
    //                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
    //                             break;
    //                         case "modal fade bs-example-modal-sm":
    //                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
    //                             break;
    //                         default:
    //                             $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
    //                             break;
    //                     }

    //                     var modalDialogClass = $('#modalDialog').attr('class');
    //                     switch (modalDialogClass) {
    //                         case "modal-dialog modal-md":
    //                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
    //                             break;
    //                         case "modal-dialog modal-sm":
    //                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
    //                             break;
    //                         default:
    //                             $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
    //                             break;
    //                     }
                        
    //                     $('#modalTitle').html('Send E-mail');
    //                     $('div.modal-body').load();
    //                     $('#modal').modal('show');
               
    //                     $('#modal').data('debtor',debtor);
    //                     $('#modal').data('entity',entity);
    //                     $('#modal').data('project',project);
}
</script>
