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
	    						<form class="form form-horizontal" id="form_nup" method="post" action="" enctype="multipart/form-data">
									<div class="form-body">
			                			<div class="form-group row">
			                            	<label class="col-md-3 label-control">Meter ID<FONT COLOR="RED">*</FONT></label>
			                            	<div class="col-md-7">
			                            		<input type="text" id="meterid" class="form-control" placeholder="Meter Type" name="meterid">
			                            		<input type="hidden" name="rowid" id="rowid">
			                            	</div>
				                        </div>

			                			<div class="form-group row">
			                            	<label class="col-md-3 label-control" for="eventRegInput2">Ref No</label>
			                            	<div class="col-md-7">
			                            		<input type="text" id="refno" class="form-control" placeholder="Meter Description" name="refno">
			                            	</div>
				                        </div>


			                			<div class="form-group row">
			                            	<label class="col-md-3 label-control" for="eventRegInput2">Date</label>
			                            	<div class="col-md-7">
			                            		<div class="input-group"> 
				                            		<div class="input-group-prepend">
									                    <span class="input-group-text"><i class="ft-calendar"></i></span>
									                </div>         
								                <input id="dates" name="dates" class="form-control" type="text">
			                            		</div>
			                            	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Current Read</label>
						                        	<div class="col-md-3">
						                        		<div class="input-group">        
								                            <input id="crread" name="crread" class="form-control" type="number" value="0">
								                        </div>
						                        	</div>

						                        	<label class="col-md-1 label-control">Current Read High</label>
						                        	<div class="col-md-3">
						                        		<div class="input-group"> 
								                            <input id="crhigh" name="crhigh" class="form-control" type="number" value="0">
								                        </div>
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
  <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 

<script>
	$(document).ready(function(){
		$(".select2").select2();
		$('#dates').datepicker({
	    format: 'dd/mm/yyyy',
	      autoclose: true,
	        keyboardNavigation: false,
	        forceParse: false
	        // calendarWeeks: true
	    });
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
		                url : "<?php echo base_url('c_mu_spesific/saveDT');?>",
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
		                        window.location.href="<?php echo base_url('c_mu_spesific/form');?>";  
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




</script>