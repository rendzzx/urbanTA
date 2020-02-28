<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<div class="app-content content">
	<div class="content-wrapper">
    	<div class="content-wrapper-before"></div>
    	<div class="content-header row">
	      	<div class="content-header-left col-md-4 col-12 mb-2">
		        <br><br>
		        <h3 class="content-header-title">Unit List</h3>
		    </div>
	    </div>
	</div>
    <div class="content-body">
        <section id="configuration">
        	<div class="row">
                <div class="col-12">
                    <div class="card">
                    	<div class="card-header">
                            <div class="form-group">
				                <label for="txt_Pl_Project" class="font-weight-bold col-2">Choose Project</label>
				                <select data-placeholder="Choose a Project..." class="select2" id="txt_Pl_Project" name="txt_Pl_Project">
									<?php echo $cbProject; ?>
				                </select>
				                <button id="search" class="btn btn-primary"><i class="ft-search"> </i><span class="hidden-xs">Search</span></button>
		                    </div>
		                    <div class="form-group">
				                <label for="txt_Pl_Project" class="font-weight-bold col-2">Choose Product</label>
				                <select name="txtProduct" id="txtProduct" data-placeholder="Choose Product..." class="select2" tabindex="2">
									<option value=""></option>
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
				                <label for="txt_Pl_Project" class="font-weight-bold col-2">Counter</label>
				                <select name="txtCount" id="txtCount" data-placeholder="Choose Count..." class="select2" style="width:250px;" tabindex="2">
									<option value=""></option>
									<option value="all">All</option>
									<option value="nol">0</option>
									<option value="lebih">>0</option>
					        	</select>
		                    </div>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
			                <div class="card-body card-dashboard">
			                	<table id="tblcount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
		                            <thead>
		                                <th>No.</th>
		                                <th>NUP Counter</th>
		                                <th>Unit</th>
		                                <th>Description</th>
		                                <th>Description</th>
		                                <th>Description</th>
		                                <th>Description</th>                
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
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script>

$(document).ready(function(){

	$(".select2").select2({
	    width : 300
	});

	tblcount = $('#tblcount').DataTable( 
    {
		dom 		: '<"toolbar dataTables_filter">Bfrtip',
        responsive	: true,
        select 		: true,
        filter 		: false,    
        paging 		:false,       
        buttons		:
        [{
            extend: 'collection',
            className: 'btn biru-bg fa fa-star',
            text: ' Action',
            buttons: [
                'excel',
                'csv',
                'pdf',
            ]
	    }],
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_unit_counter/getTable');?>",
            "data":{
                "product": function(d){
	                var a = $('#txtProduct').val();
	                var b ="all";
	                if(a == null){
	                    return b;
	                }{
	                    return a;
	                }
                },
                "project": function(d){
                    var a = $('#txt_Pl_Project').val();
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                },
                "nupcount": function(d){
                    var a = $('#txtCount').val();
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
            {data:"nup_counter",name:"nup_counter"},
            {data:"lot_no",name:"lot_no"},            
            {data:"type_descs",name:"type_descs"},
            {data:"block_descs",name:"block_descs"},
            {data:"zone_descs",name:"zone_descs"},
            {data:"direction_descs",name:"direction_descs"}
            
            ]
    });

    $('#search').click(function(){
	    block(true, '.card-header')
	    var state = document.readyState
	    if (state == 'complete') {
	        setTimeout(function(){
	            document.getElementById('interactive');
	            tblcount.ajax.reload(null,true);
	            block(false, '.card-header')
	        },1000);
	    }
	});
});
</script>