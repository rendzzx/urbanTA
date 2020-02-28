<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
 <script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">

<script type="text/javascript">
window.history.forward();
</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
	<div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <!-- <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div> -->
            <div class="tittle-top pull-right"><b>NUP Enquiry</b></div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div> <br>
        <div class="form-group">
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Reserve Date</label>
        <div class="col-sm-3">
          
          <div class="input-daterange input-group" style="width:250px;">
                <input type="text" class="input-sm form-control" id="start" name="start" value=""/>
                <span class="input-group-addon">to</span>
                <input type="text" class="input-sm form-control" id="end" name="end" value="" />
            </div>
           
        </div>
        <div class="col-sm-7">
            <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
           <!-- <button id="download" class="btn btn-white"><i class="fa fa-download"></i> <span class="hidden-xs">Download</span></button> -->
        </div>
        <br>
      </div>
      <div class="form-group" >
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Lead</label>
        <div class="col-sm-10">
          <select name="txtLead" id="txtLead" data-placeholder="Choose a Lead..." class="select2" style="width:250px;" tabindex="2">
            <option value="all"></option> 
            <option value="all">All</option>
            <?php 
            foreach ($Lead as $row) 
            {
              echo '<option value="'.$row->lead_cd.'">'.$row->lead_name.'</option>';
            }
            ?>            
          </select>
           
        </div>
        <br>
      </div>
      <div class="form-group" >
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Agent</label>
        <div class="col-sm-10">
          <select name="txtAgenttype" id="txtAgenttype" data-placeholder="Choose ..." class="select2" style="width:75px;" tabindex="2">
            <option value=""></option>
            <option value="I">Inhouse</option>
            <option value="ex">External</option>        
          </select>
          <select name="txtAgent" id="txtAgent" data-placeholder="Choose an Agent..." class="select2" style="width:173px;" tabindex="2">
            <!-- <option value="all"></option>
            <option value="all">All</option> 
            <?php 
            foreach ($Agent as $row2) 
            {
              echo '<option value="'.$row2->agent_cd.'">'.$row2->agent_name.'</option>';
            }
            ?>  --> 
                    
          </select>
           
        </div>
        <br>
      </div>
      <div class="form-group">
      <label for="txtProduct" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Product</label>
        <div class="col-sm-10">
          <select name="txtProduct" id="txtProduct" data-placeholder="Choose Product..." class="select2" style="width:250px;" tabindex="2">
          <option value="all"></option>
          <option value="all">All</option> 
            <?php 
            foreach ($Product as $row3) 
            {
              echo '<option value="'.$row3->product_cd.'">'.$row3->descs.'</option>';
            }
            ?>  
                   
          </select>
           
        </div>
        <br>
      </div>
      <div class="form-group">
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Type</label>
        <div class="col-sm-10">
          <select name="txtNUPtype" id="txtNUPtype" data-placeholder="Choose Type..." class="select2" style="width:250px;" tabindex="2">
          <option value="all"></option>
          <option value="all">All</option>
          <option value="G">Golden</option>
          <option value="P">Platinum</option>  
           <!--  <?php 
            foreach ($Type as $row4) 
            {
              echo '<option value="'.$row4->nup_type.'">'.$row4->descs.' - '.$row4->nup_type.'</option>';
            }
            ?>   -->
                   
          </select>
           
        </div>
        <br>
      </div>
       <div class="form-group">
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Status</label>
        <div class="col-sm-10">
          <select name="txtStatus" id="txtStatus" data-placeholder="Choose Type..." class="select2" style="width:250px;" tabindex="2">
          <option value="all"></option>
          <option value="all">All</option>
          <option value="A">Approved</option>
          <option value="P">Clarify</option>
          <!-- <option value="X">Reject</option> -->
          <option value="N">New</option>
          <option value="S">Submit</option>
          <option value="C">Cancel</option>
          <!-- <option value="R">Revision</option> -->
          <!-- <option value="V">Approved Revision</option> -->
          <option value="E">Submit Cancel</option>

          
                   
          </select>
           
        </div>
        <br>
      </div>
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body"> 
                        <!-- <b>&nbsp; NUP Enquiry By Principal</b> -->
                        <br>                             
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
	<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	  <div id="modalDialog2" class="modal-dialog">
	    <div class="modal-content">
	      <!-- Modal Header -->
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">
	          <span aria-hidden="true">&times;</span>
	          <span class="sr-only">Close</span>
	        </button>
	        <h5 class="modal-title" id="modalTitle2"></h5>
	      </div>
	      <!-- Modal Body -->
	      <div class="modal-body2">
	      </div>
	    </div>
	  </div>
	</div>

<script type="text/javascript">

var tblenquiry;
$(function(){
    $("#txtAgenttype").change(function() {
    // document.getElementById('loader').hidden=false;
    // alert('loader');
          var Atypecd = $(this).find(':selected').val();          
          if(Atypecd!=='') {
            var site_url = '<?php echo base_url("c_enquiry/zoom_agent")?>';
            $.post(site_url,
              {Atypecd:Atypecd},
              function(data,status) {
                // console.log(data);
                $("#txtAgent").empty();
                $("#txtAgent").append(data);
                $("#txtAgent").trigger('chosen:updated');
              }
            );
           
          } else {
            $("#txtAgent").empty();
          }
          // document.getElementById('loader').hidden=true;
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
   tblenquiry = $('#tblenquiry').DataTable( 
    {
            dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter: false,    
            paging:false,
            // info:false,        
            buttons: [
            	
                {
                extend: 'collection',
                className: 'btn biru-bg fa fa-star',
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
                    text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                                 tblenquiry.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }

                       // document.getElementById('loader').hidden=false;
                       // tblnup.ajax.reload(null,true);
                       // document.getElementById('loader').hidden=true;
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
                    console.log(a);
	                },
                    "date_start": function(d){
                    var a = $('#start').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
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
                    "lead": function(d){
                    var a = $('#txtLead').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    },
                    "agent": function(d){
                    var a = $('#txtAgent').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    },
                    "product": function(d){
                    var a = $('#txtProduct').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    },
                    "status": function(d){
                    var a = $('#txtStatus').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    },
                    "nuptype": function(d){
                    var a = $('#txtNUPtype').val();
                   
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
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
            {data:"nup_desc",name:"nup_desc"}
            ]
    });
    $("div.toolbar").html('<div class="input-group" style="display:none;"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblenquiry.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblenquiry.ajax.reload(null,true);   
        }
    });

});
function fn_search(){
    var a = $('#txt_search').val();
    tblenquiry.ajax.reload(null,true); 
    }

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
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                    tblenquiry.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
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
