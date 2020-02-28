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
           <h3 class="content-header-title">NUP Enquiry</h3>
        </div>

    </div>
    <div class="content-detached content-right">
        <div class="content-body">
           <div class="col-sm-12" style="z-index: 1;">
              <div class="card" style="z-index: 1;">
                 <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <table id="tblenquiry" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No.</th>
                                    <th>Agent Name</th>
                                    <th>Lead Agent</th>                                        
                                    <th>Customer Name</th>                                
                                    <th>Customer Handphone</th>
                                    <th>Customer Email</th>
                                    <th>NUP No.</th>
                                    <th>Reserve Date</th>
                                    <th>Status</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Choose Unit?</th>
                                    <th>Chosen Unit</th>               
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
                    <select name="pl_project" id="pl_project" data-placeholder="Choose Project" class="select2" style="width:250px;" tabindex="2">
                        <option value=""></option>
                        <option value="all">All</option>
                        <?php echo $cbproject;?>   
                        
                    </select>
                    <input type="hidden" name="cons" id="cons">
          
                  </div>
                <div class="form-group">
                      <label for="pl_project" class="control-label" style="padding-left:0px;"> Reserve Date</label>
                     
                          <div class="input-daterange input-group" style="width:250px;">
                              <input type="text" class=" form-control" autocomplete="false" id="start" name="start" value=""/>
                              <span class="input-group-addon">to</span>
                              <input type="text" class=" form-control" autocomplete="false" id="end" name="end" value="" />
                          </div>
                         
                  </div>
                <div class="form-group" >
                  <label for="pl_project" class="control-label" style="padding-left:0px;"> Choose Lead</label>
                    <select name="txtLead" id="txtLead" data-placeholder="Choose a Lead..." class="select2" style="width:250px;" tabindex="2">
                      <option></option> 
                      <option value="all">All</option>
                      <?php 
                      foreach ($Lead as $row) 
                      {
                        echo '<option value="'.$row->lead_cd.'">'.$row->lead_name.'</option>';
                      }
                      ?>            
                    </select>
                
                </div>
                <div class="form-group" >
                  <label for="pl_project" class="control-label" style="padding-left:0px;"> Choose Agent</label>
                  <div class="row" style="padding-left: 15px">
                    <select name="txtAgenttype" id="txtAgenttype" data-placeholder="Choose ..." class="select2" style="width:75px;" tabindex="2">
                      <option></option>
                      <option value="I">Inhouse</option>
                      <option value="ex">External</option>        
                    </select>
                    <select name="txtAgent" id="txtAgent" data-placeholder="Choose an Agent..." class="select2" style="width:173px;" tabindex="2">

                    </select>
                  </div>  
                </div>
                <div class="form-group">
                  <label for="txtProduct" class="control-label" style="padding-left:0px;"> Choose Product</label>
                    <select name="txtProduct" id="txtProduct" data-placeholder="Choose Product..." class="select2" style="width:250px;" tabindex="2">
                    <option ></option>
                    <option value="all">All</option> 
                      <?php 
                      foreach ($Product as $row3) 
                      {
                        echo '<option value="'.$row3->product_cd.'">'.$row3->descs.'</option>';
                      }
                      ?>       
                    </select>
                </div>
                <div class="form-group">
                  <label for="pl_project" class="control-label" style="padding-left:0px;"> Choose Type</label>
                    <select name="txtNUPtype" id="txtNUPtype" data-placeholder="Choose Type..." class="select2" style="width:250px;" tabindex="2">
                    <option></option>
                    <option value="all">All</option>
                    <option value="G">Golden</option>
                    <option value="P">Platinum</option>  
                    </select>
                </div>
                <div class="form-group">
                  <label for="pl_project" class="control-label" style="padding-left:0px;"> Choose Status</label>
            
                    <select name="txtStatus" id="txtStatus" data-placeholder="Choose one..." class="select2" style="width:250px;" tabindex="2">
                      <option ></option>
                      <option value="all">All</option>
                      <option value="A">Approved</option>
                      <option value="P">Clarify</option>
                      <option value="N">New</option>
                      <option value="S">Submit</option>
                      <option value="C">Cancel</option>
                      <option value="E">Submit Cancel</option>
                    </select>
                 
                </div>
                <div class="form-group">
                  <label for="pl_project" class="control-label" style="padding-left:0px;"> Choose Unit Status</label>

                    <select name="txtCUS" id="txtCUS" data-placeholder="Choose one..." class="select2" style="width:250px;" tabindex="2">
                    <option></option>
                    <option value="all">All</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
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

var tblenquiry;
$(function(){
    $("#txtAgenttype").change(function() {

    // alert('loader');
    var project = $('#txtProject').find(':selected').val();
          var Atypecd = $(this).find(':selected').val();          
          if(Atypecd!=='') {
            var site_url = '<?php echo base_url("c_enquiry/zoom_agent")?>';
            $.post(site_url,
              {Atypecd:Atypecd,project:project},
              function(data,status) {
                // console.log(data);
                $("#txtAgent").empty();
                $("#txtAgent").append(data);
                $("#txtAgent").trigger('change');
              }
            );
           
          } else {
            $("#txtAgent").empty();
          }
        });
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
    $("div.tblenquiry").html(
        '<button id="action" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="refresh" class="btn btn-info pull-up">Edit</button>'
        // '<button id="editparam" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
        
    );
   tblenquiry = $('#tblenquiry').DataTable( 
    {
            dom: 'frtip',
            responsive: true,
            select: true,
                    
            buttons: [
            	
                {
                extend: 'collection',
                className: 'btn btn-primary ft-star',
                text: ' Action',
                buttons: [
                    // 'copy',
                    'excel',
                    'csv',
                    'pdf',
                    // 'print'
                            ]           
                },
                
               
                {
                    text: ' Refresh ', className: 'btn biru-bg ft-refresh-cw', action: function (e) {
                       
                       
                    }
                }
                
            ],
        "serverSide": true,
        "ajax":{
                    "url":"<?php echo base_url('c_enquiry/getTable');?>",  
                    "data":{"date_end": function(d){
	                var a = $('#end').val();
	                
	                var b ="all";
	                if(a == null){
	                    return b;
	                }{
	                    return a;
	                }
                    // console.log(a);
	                },
                    "date_start": function(d){
                    var a = $('#start').val();
                    
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
                    var a = $('#pl_project').val();
                    // console.log(a);
                    var b ="";
                    if(a == null||a==''){
                        return b;
                    }{
                        return a;
                    }

                    },
                    "lead": function(d){
                    var a = $('#txtLead').val();
                    
                    var b ="all";
                    if(a == null||a==''){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "agent": function(d){
                    var a = $('#txtAgent').val();
                    
                    var b ="all";
                    if(a == null||a==''){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "product": function(d){
                    var a = $('#txtProduct').val();
                    
                    var b ="all";
                    if(a == null||a==''){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "status": function(d){
                    var a = $('#txtStatus').val();
                    
                    var b ="all";
                    if(a == null||a==''){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "CUS": function(d){
                    var a = $('#txtCUS').val();
                    
                    var b ="all";
                    if(a == null||a==''){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "nuptype": function(d){
                    var a = $('#txtNUPtype').val();
                   
                    var b ="all";
                    if(a == null||a==''){
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
            {data:"agent_name",name:"agent_name"},
            {data:"lead_name",name:"lead_name"},
            {data:"name",name:"name"},            
            {data:"hand_phone",name:"hand_phone"},
            {data:"email_addr",name:"email_addr"},
            {data:"nup_no",name:"nup_no"},
            {
                data:"reserve_date",name:"reserve_date",
                render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(6,4);
                                var month=data.substr(3,2);
                                var day =data.substr(0,2);
                               
                               
                               var aa = day+"/"+month+"/"+year;
                               // console.log(data);
                               // console.log(year);                               
                               // console.log(month);
                               // console.log(day);
                               return aa;
                               
                               

                           }
            },    
            {data:"status_desc",name:"status_desc"},
            {data:"product_descs",name:"product_descs"},            
            {data:"nup_desc",name:"nup_desc"},
            {data:"choose_unit_status",name:"choose_unit_status",
                            render: function (data, type, row) {
                              if(data=='Y'){
                                return 'Yes';
                              } else {
                                return 'No';
                              }
                           
                        }
            },                 
            {data:"Lot_descs",name:"Lot_descs"}
            ]
    });



});
$('#cons').val($('#pl_project').find(':selected').data('cons'));
$('#refresh').click(function(){
  block(true,'.content-body');
  var state = document.readyState
    if (state == 'complete') {
        setTimeout(function(){
            document.getElementById('interactive');
           tblenquiry.ajax.reload(null,true);
           block(false,'.content-body');
        },1000);
    }
  });
$('#search').click(function(){
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    // alert(date_start+', '+date_end);
    
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
    block(true,'.content-body');
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                    tblenquiry.ajax.reload(null,true);
                    block(false,'.content-body');
                },1000);
            }
    
});

function fn_search2(){
    document.getElementById('loader').hidden=false;
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    if (date_start!='all' && date_end=='all')
    {
        swal('Warning','Please input date end','warning');
    } else if (date_start=='all' && date_end!='all')
    {
        swal('Warning','Please input date start','warning');
    } else {
        var a = $('#txt_search').val();
        document.getElementById('loader').hidden=false;
        tblenquiry.ajax.reload(null,true); 
        document.getElementById('loader').hidden=true;
    }

    
    }
function search(){
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    if(date_end==null || date_start==null ){
        date_end='all';
        date_start='all';
    }
    var lead = $('#txtLead').val();
    var agent = $('#txtAgent').val();
    var product = $('#txtProduct').val();
    var type = $('#txtNUPtype').val();
    alert(date_end+'--'+date_start+', '+lead+', '+agent+', '+product+', '+type);
}
function nuptypeinfo(status)
  {
    // alert(status);
    var modalClass = $('#modal2').attr('class');
                        switch (modalClass) {
                            case "modal2 fade bs-example-modal-md":
                                $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            default:
                                $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog2').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog2').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog2').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialog2').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }
                        
                        if(status == 1){
                          $('#modalTitle2').html('NUP Type Information');  
                        }else{
                          $('#modalTitle2').html('Preffered launching location');  
                        }
                        
                        $('div.modal-body2').load("<?php echo base_url("c_nup/showinfo");?>/"+ status);

                        $('#modal2').modal('show');
  }
</script>
