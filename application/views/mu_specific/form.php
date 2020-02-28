<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet">
<link href="<?=base_url('app-assets/vendors/css/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">

<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<style>
	input[type="file"] {
    display: none;
    position: relative;
    }

	.custom-file-upload {
	    border: 1px solid #ccc;
	    text-align: center;
	    cursor: pointer;
	    width: 100px;
	    height: 100px;
	    display: flex;
	  	align-items: center;
	  	justify-content: center;
	  	border-radius: 15px;
	  	position: relative;
	}

	.img-responsive{
		margin: 0 auto;
		position: absolute;
		object-fit: contain;
		background-size: contain;
		width: 85px;
		height: 85px;
		/*top: 0;
		left: 0;*/
	}
	.icon-img{
		    display: inline-block;
		    position: absolute;
		    right: 19px;
		    bottom: 10px;
		    padding-top: 12px;
		    text-align: right;
	}
	.icon-mgr{
		    width: 32px;
		    height: 32px;
		    padding: 8px;
		    border-radius: 32px;
		    opacity: 1;
		    display: inline-block;
		    -webkit-transition: background-color .5s ease;
		    transition: background-color .5s ease;
		    cursor: pointer;
	}

	.product-unit-active{
		color: #6967ce;
		border-color: #6967ce;

	}

</style>

<div class="app-content content">
	<div class="content-wrapper">
    	<div class="content-wrapper-before"></div>
    	<div class="content-header row">
	      	<div class="content-header-left col-md-4 col-12 mb-2">
		        <br><br>
		        <h3 class="content-header-title"><?php echo $ProjectDescs ?></h3>
		        <h4 class="content-header-title">Meter Utility Specification Master</h4>
		    </div>
	    </div>
	    
	    <div class="content-body">
	    	<div class="row">
	    		<div class="col-lg-12">
	    			<div class="card">
	    				<div class="card-header">
	    					<div class="card-content">
	    						<form class="form form-horizontal" id="form_mus" method="post" action="" enctype="multipart/form-data">
									<div class="form-body">
			                			<div class="form-group row">
			                            	<label class="col-md-3 label-control">Meter Code<FONT COLOR="RED">*</FONT></label>
			                            	<div class="col-md-7">
			                            		<input type="text" id="mtrtype" class="form-control" placeholder="Meter Code" name="mtrtype">
			                            		<input type="hidden" name="rowid" id="rowid">
			                            	</div>
				                        </div>

			                			<div class="form-group row">
			                            	<label class="col-md-3 label-control" for="eventRegInput2">Description</label>
			                            	<div class="col-md-7">
			                            		<input type="text" id="mtrdescs" class="form-control" placeholder="Meter Description" name="mtrdescs">
			                            	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Multiplier</label>
						                        	<div class="col-md-3">
						                        		<div class="input-group">        
								                            <input id="multip" name="multip" class="form-control" type="number" value="0">
								                        </div>
						                        	</div>

						                        	<label class="col-md-1 label-control">TRX Type</label>
						                        	<div class="col-md-3">
						                        		<div class="input-group"> 
								                            <select name="trxtype" id="trxtype" class="select2 form-control" data-placeholder="Choose TRX Type..">
						                            			<option></option>
						                            			<?php echo $combotrx?> 
			                            					</select>
								                        </div>
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Tax Scheme</label>
						                        	<div class="col-md-3">
						                        		<select name="taxsch" id="taxsch" class="select2 form-control" data-placeholder="Choose TAX Scheme..">
					                            			<option></option>
					                            			<?php echo $combotrx?> 
					                            		</select>
						                        	</div>

						                        	<label class="col-md-1 label-control">Minimum Amount</label>
						                        	<div class="col-md-3">
						                        		<div class="input-group">        
								                            <input id="min_amt" name="min_amt" class="form-control" type="number" value="0">
								                        </div>
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Category</label>
						                        	<div class="col-md-3">
						                        		<select name="catego" id="catego" class="select2 form-control" data-placeholder="Choose Category..">
					                            			<option></option>
					                            			<?php echo $comboctg ?> 
					                            		</select>
						                        	</div>

						                        	<label class="col-md-1 label-control">Meter Type</label>
						                        	<div class="col-md-3">
						                        		<select name="mtrtyp" id="mtrtyp" class="select2 form-control" data-placeholder="Choose Meter Descs..">
					                            			<option></option>
					                            			<option value="E">Electric</option>
					                            			<option value="W">Water</option>
					                            		</select>
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Other Flag</label>
						                        	<div class="col-md-1">
						                        		<div class="i-checks">
											            	<label id="chckBox">
											            			<input type="checkbox" name="flags" id="flags" value="Y"> &nbsp; Yes &nbsp; 
											            	</label>
											            	<label id="chckBox">
											            			<input type="checkbox" name="flags" id="flags" value="N"> &nbsp; No &nbsp; 
											            	</label>
										            	</div>
						                        	</div>

						                        	<label class="col-md-1 label-control">Add Min</label>
						                        	<div class="col-md-1">
						                        		<div class="i-checks">
											            	<label id="chckBox">
											            			<input type="checkbox" name="addmin" id="addY" value="Y"> &nbsp; Yes &nbsp; 
											            	</label>
											            	<label id="chckBox">
											            			<input type="checkbox" name="addmin" id="addN" value="N"> &nbsp; No &nbsp; 
											            	</label>
										            	</div>
						                        	</div>

						                        	<label class="col-md-1 label-control">Stamp Duty</label>
						                        	<div class="col-md-1">
						                        		<div class="i-checks">
											            	<label id="chckBox">
											            			<input type="checkbox" name="stamps" id="stamps" value="Y"> &nbsp; Yes &nbsp; 
											            	</label>
											            	<label id="chckBox">
											            			<input type="checkbox" name="stamps" id="stamps" value="N"> &nbsp; No &nbsp; 
											            	</label>
										            	</div>
						                        	</div>

						                        	<label class="col-md-1 label-control">Sewage Flag</label>
						                        	<div class="col-md-1">
						                        		<div class="i-checks">
											            	<label id="chckBox">
											            			<input type="checkbox" name="sewaflg" id="sewage" value="Y"> &nbsp; Yes &nbsp; 
											            	</label>
											            	<label id="chckBox">
											            			<input type="checkbox" name="sewaflg" id="sewage" value="N"> &nbsp; No &nbsp; 
											            	</label>
										            	</div>
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">OP TRX</label>
						                        	<div class="col-md-3">
						                        		<select name="optrx" id="optrx" class="select2 form-control" data-placeholder="Choose One..">
					                            			<option></option>
					                            			 <?php echo $combotrx ?> 
					                            		</select>
						                        	</div>

						                        	<label class="col-md-1 label-control">OP TAX Scheme</label>
						                        	<div class="col-md-3">
						                        		<select name="optax" id="optax" class="select2 form-control" data-placeholder="Choose One..">
					                            			<option></option>
					                            			<?php echo $combotrx?> 
					                            		</select>
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

				                        <div class="form-group row">
					                        <div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Sewage Percent</label>
						                        	<div class="col-md-3">
						                        		<input id="percent" name="percent" class="form-control" type="number" value="0">
						                        	</div>

						                        	<label class="col-md-1 label-control">Sewage Amount</label>
						                        	<div class="col-md-3">
						                        		<input id="amounts" name="amounts" class="form-control" type="number" value="0">
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Sewage TRX</label>
						                        	<div class="col-md-3">
						                        		<select name="sewatrx" id="sewatrx" class="select2 form-control" data-placeholder="Choose One..">
					                            			<option></option>
					                            			<?php echo $combotrx?> 
					                            		</select>
						                        	</div>

						                        	<label class="col-md-1 label-control">Sewage TAX</label>
						                        	<div class="col-md-3">
						                        		<select name="sewatax" id="sewatax" class="select2 form-control" data-placeholder="Choose One..">
					                            			<option></option>
					                            			<?php echo $combotrx?> 
					                            		</select>
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

	

									<div class="form-actions right">
			                            <button type="button" name="btnCancel" id="btnCancel" class="btn btn-danger mr-1">
			                            	<i class="ft-x"></i> Cancel
			                            </button>
			                            <button type="button" name="btnSave" id="btnSave" class="btn btn-primary">
			                                <i class="la la-check-square-o"></i> Save
			                            </button>
			                        </div>
								</form>


	    					</div>
	    				</div>
	    			</div>
	    		</div>

	    		<div class="col-lg-12">
	    			<div class="card">
	    				<div class="card-header">
	    					<div class="card-content">
	    						<div class="table-responsive">
	    							<pre style="border:0px; background: #ffffff;">
	    								<table id="tblspecificDT" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
	    									<thead>            
			                                    <th class="sorting_asc">No.</th>
			                                    <th>Meter ID</th>
			                                    <th>Ref No</th>
			                                    <th>Date</th>
			                                    <th>Reading High</th>
			                                 </thead>
			                                 <tbody>
			                                 </tbody>
	    								</table>
	    							</pre>
	    						</div>
	    					</div>
	    				</div>
	    			</div>
	    		</div>

	    	</div>
	    </div>
	</div>

</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script> 
 <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>

<script>
	$(document).ready(function(){
		// alert('duar');
		$(".select2").select2();
	    $('.i-checks').iCheck({
            radioClass: 'iradio_square-purple',
            checkboxClass: 'icheckbox_flat-purple'
        });

	    $('#btnSave').click(function(){            

            block('.content-body',true);

		        var datafrm = $('#form_mus').serializeArray();
		        // datafrm.push({name:"nup_info",value:nup_info},{name:"terms_descs",value:terms_descs});
		       	 console.log(datafrm);
		       	//return;
		            $.ajax({
		                url : "<?php echo base_url('c_mu_spesific/save');?>",
		                type:"POST",
		                data: datafrm,
		                dataType:"json",
		                success:function(data, status){
		                  console.log(data);console.log(status);
		                if(data.status =='OK'){
		                  
		                      swal({
		                        title: "Information",
		                        text: data.pesan,
		                        type: "success",
		                        confirmButtonText: "OK"
		                      }).then(function(){
		                        window.location.href="<?php echo base_url('c_mu_spesific/index');?>";  
		                      })
		               

		                    } else {
		                  
		                      swal({
		                        title: "Error",
		                        text: data.pesan,
		                        type: "error",
		                        confirmButtonText: "OK"
		                        });
		                      block('.content-body',false);
		                    }
		                 
		                },                    
		                error: function(jqXHR, textStatus, errorThrown){
		                  block('.content-body',false);
		                    swal(textStatus+' Save : '+errorThrown);
		                }
		            });

		        // }
	    });
	});


    $('#btnCancel').click(function(){
   
            window.location.href= '<?php echo base_url("c_mu_spesific/form")?>';

    });

    var tblspecificDT;
	var meter_cd = $('#mtrtype').val();
	var tblspecificDT = $('#tblspecificDT').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_mu_spesific/getTableDT/');?>"+meter_cd,
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"meter_id", sortable: false},
            {data:"ref_no"},
            {data:"curr_date", sortable: true},
            {data:"curr_read_high", sortable: true},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar muspecificDT">frtip'
    });

    $("div.muspecificDT").html(
        '<button id="addspecificDT" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editspecificDT" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
        '<button id="deletespecificDT" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>'
    );

    tblspecificDT.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblspecificDT.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#addspecificDT').click(function(){
        window.location.href="<?php echo base_url('c_mu_spesific/formDT')?>";
    });


      $('#editspecificDT').click(function(){
        var rows = tblspecificDT.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblspecificDT.rows(rows).data();
        var id = data[0].id;
        // alert(id);
        window.location.href="<?php echo base_url('c_mu_spesific/form')?>"+'/'+id+'/E';
    })


function Delete(id) {
    // var survey_id = id;
   block(true,'.content-body');
    $.ajax({
        url : "<?php echo base_url('newsandpromo/Delete');?>",
        type:"POST",
        data: { id: id },
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"success");
               block(false,'.content-body');
                tblspecificDT.ajax.reload(null,true); 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                block(false,'.content-body');
        }
    });
}


</script>