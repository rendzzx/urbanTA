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
			<div class="tittle-top pull-right">Sales Report Enquiry</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</div> <br>
		 
		<div class="form-group">
			<label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Project</label>
			<div class="col-sm-10">
				<select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="select2" style="width:250px;" tabindex="2">
					<option value=""></option>
					<?php echo $cbProject;?>   
					
				</select>
				
			</div>
			<br>
		</div>
		<div class="form-group">
			<label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Sales Date</label>
			<div class="col-sm-3">
				
				<div class="input-daterange input-group" style="width:250px;">
					<input type="text" class="input-sm form-control" id="start" name="start" value=""/>
					<span class="input-group-addon">to</span>
					<input type="text" class="input-sm form-control" id="end" name="end" value="" />
				</div>
				
			</div>
			
			<br>
		</div>
        <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Nationality</label>
            <div class="col-sm-10">
                <select name="txtnationality" id="txtnationality" data-placeholder="Choose Product" class="select2" style="width:250px;" tabindex="2">
                    <option value="all"></option>
                    <option value="all">All</option> 
                    <?php 

                    foreach ($nationality as $row3) 
                    {
                        echo '<option value="'.$row3->nationality_cd.'">'.$row3->descs.'</option>';
                    }
                    ?>  

                </select>

            </div>
            <br>
        </div>
		<div class="form-group">
			<label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Product</label>
			<div class="col-sm-3">

				<select name="txtProduct" id="txtProduct" data-placeholder="Choose Product" class="select2" style="width:250px;" tabindex="2">
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
			<label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Property</label>
			<div class="col-sm-10">
				<select name="txtProperty" id="txtProperty" data-placeholder="Choose Property" class="select2" style="width:250px;" tabindex="2">
					<option value="all"></option>
					<option value="all">All</option>
					<?php 
					foreach ($Property as $row3) 
					{
						echo '<option value="'.$row3->property_cd.'">'.$row3->descs.'</option>';
					}
					?>  
				</select>

			</div>
			<br>
		</div>
		<div class="form-group">
			<label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Lead</label>
			<div class="col-sm-10">
				<select name="txtLeadName" id="txtLeadName" data-placeholder="Choose Lead Name" class="select2" style="width:250px;" tabindex="2">
					<option value="all"></option>
					<option value="all">All</option>
					<?php 
					foreach ($leaddata as $row3) 
					{
						echo '<option value="'.$row3->lead_cd.'">'.$row3->lead_name.'</option>';
					}
					?> 
					
					
				</select>
				
			</div>
			<br>
		</div>
		<div class="form-group">
			<label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Principal</label>
			<div class="col-sm-10">
				<select name="txtGroupName" id="txtGroupName" data-placeholder="Choose Group Name" class="select2" style="width:250px;" tabindex="2">
					<option value="all"></option>
					<option value="all">All</option>
					<?php 
					foreach ($groupData as $row3) 
					{
						echo '<option value="'.$row3->group_cd.'">'.$row3->group_name.'</option>';
					}
					?> 
					
					
				</select>
				
			</div>
			<br>
		</div>
        <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Lot Type</label>
            <div class="col-sm-10">
                <select name="txtlotType" id="txtlotType" data-placeholder="Choose Group Name" class="select2" style="width:250px;" tabindex="2">
                    <option value="all"></option>
                    <option value="all">All</option>
                    <?php 
                    foreach ($lot_type as $row3) 
                    {
                        echo '<option value="'.$row3->lot_type.'">'.$row3->descs.'</option>';
                    }
                    ?> 
                    
                    
                </select>
                
            </div>
            <br>
        </div>
        <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Payment Code</label>
            <div class="col-sm-3">
                <select name="txtPayment" id="txtPayment" data-placeholder="Choose Group Name" class="select2" style="width:250px;" tabindex="2">
                    <option value="all"></option>
                    <option value="all">All</option>
                    <?php 
                    foreach ($paymentdata as $row3) 
                    {
                        echo '<option value="'.$row3->payment_cd.'">'.$row3->descs.'</option>';
                    }
                    ?> 
                    
                    
                </select>
                
            </div>
            <div class="col-sm-7 control-label" style="margin-left: 33px">
                <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
                <!-- <button id="download" class="btn btn-white"><i class="fa fa-download"></i> <span class="hidden-xs">Download</span></button> -->
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
                            <table id="tblcount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No.</th>
                                    <th>Product Name</th>
                                    <th>Property Name</th>
                                    <!-- <th>Lead Name</th> -->
                                    <th>Principal Name</th>
                                    <th>Nationality</th>
                                    <th>Lot No.</th>
                                    <th>Name</th>
                                    <th>Sales Date</th>
                                    <th>Sales Name</th>
                                    <th>SP No.</th>
                                    <th>Nett Area</th>
                                    <th>Semi Gross</th>
                                    <th>Lot Type</th>
                                    <th>Position</th>
                                    <th>View</th>
                                    <th>Payment Plan</th>
                                    <th>Selling Price</th>
                                                   
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
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
var tblcount;
$(function(){
   
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
   tblcount = $('#tblcount').DataTable( 
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
                                 tblcount.ajax.reload(null,true);
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
                    "url":"<?php echo base_url('c_report_agent/getTableEnquery');?>",  
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
                    "product": function(d){
                    var a = $('#txtProduct').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "property": function(d){
                    var a = $('#txtProperty').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "groupname": function(d){
                    var a = $('#txtGroupName').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "leadname": function(d){
                    var a = $('#txtLeadName').val();
                    
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
                    console.log(a);
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "nationality": function(d){
                    var a = $('#txtnationality').val();
                    console.log(a);
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "lot_type": function(d){
                    var a = $('#txtlotType').val();
                    console.log(a);
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "payment_cd": function(d){
                    var a = $('#txtPayment').val();
                    console.log(a);
                    var b ="all";
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
            // {data:"nup_counter",name:"nup_counter"},
            {data:"product_descs",name:"product_descs"},  
            {data:"property_descs",name:"property_descs"},  
            // {data:"lead_name",name:"lead_name"},  
            {data:"group_name",name:"group_name"},  
            {data:"nationality_descs",name:"nationality_descs"},  
            {data:"lot_no",name:"lot_no"},            
            {data:"NAMA",name:"NAMA"},
            {data:"sales_date",name:"sales_date",
            render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               
                               
                               var aa = day+"/"+month+"/"+year;
                               // console.log(data);
                               // console.log(year);                               
                               // console.log(month);
                               // console.log(day);
                               return aa;
                               
                               

                           }

            },
            {data:"sales",name:"sales"},
            {data:"ref_no",name:"ref_no"},
            {data:"build_up_area",name:"build_up_area"},
            {data:"land_area",name:"land_area"},
            {data:"lot_type_descs",name:"lot_type_descs"},
            {data:"direction_descs",name:"direction_descs"},
            {data:"view_descs",name:"view_descs"},
            {data:"payment_plan_descs",name:"payment_plan_descs"},
            {data:"sell_price",name:"sell_price",
            render: function (data, type, row) {
                return formatNumber(data);  
              }
          }
            
            
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
                    tblcount.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});

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

$("#txtProduct").change(function() {
          var project = $('#txtProject').val(); 
          var product = $(this).find(':selected').val();          
          if(product!=='') {
            var site_url = '<?php echo base_url("c_report_agent/zoom_property")?>';
            $.post(site_url,
              {product:product,project:project},
              function(data,status) {
                $("#txtProperty").empty();
                $("#txtProperty").append(data);
                $("#txtProperty").trigger('change');
                // $("#TxtphaseCode").trigger('change');
              }
            );
          } else {
            $("#txtProperty").empty();
          }
        });

$("#txtLeadName").change(function() {
          var project = $('#txtProject').val(); 
          var leadname = $(this).find(':selected').val();          
          if(leadname!=='') {
            var site_url = '<?php echo base_url("c_report_agent/zoom_group")?>';
            $.post(site_url,
              {leadname:leadname,project:project},
              function(data,status) {
                $("#txtGroupName").empty();
                $("#txtGroupName").append(data);
                $("#txtGroupName").trigger('change');
                // $("#TxtphaseCode").trigger('change');
              }
            );
          } else {
            $("#txtGroupName").empty();
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
        tblcount.ajax.reload(null,true); 
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
