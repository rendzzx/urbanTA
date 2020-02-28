<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet">
<link href="<?=base_url('app-assets/vendors/css/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">



<div class="app-content content">
	<div class="content-wrapper">
    	<div class="content-wrapper-before"></div>
    	<div class="content-header row">
	      	<div class="content-header-left col-md-4 col-12 mb-2">
		        <br><br>
		        <h3 class="content-header-title"><?php echo $ProjectDescs ?></h3>
		    </div>
	    </div>
	</div>

<div id="loader" class="loader" hidden="true"></div>
    <div class="content-body"><!-- Basic form layout section start -->
		<section id="form-control-repeater">
			<div class="row justify-content-md-center">
				<div class=" col-xl-10 col-lg-10 col-md-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title" id="horz-layout-card-center"> Submit Project Agent </h4>
			                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
		        	
			            </div>
			            <div class="card-content collpase show">
			                <div class="card-body" id="bodyform">
			                	<form class="form row" id="form_agent" method="post" action="" enctype="multipart/form-data">
			                	<div class="table-responsive">
									<table class="table fieldGroup">
										<thead>
											<tr>
												<th>Project</th>
												<th>Agent</th>
												<th>&nbsp;</th>
											</tr>
										</thead>

											<tr id="id1">
												<td style="width: 40%;">
													<select class="select2 form-control" id="projectz1" name="projectz1" onchange="loadAgent(1)">
		                                            	<option>Choose Project</option>
			                            				<?php echo $comboproject?>
		                                            </select>
		                                            <input type="text" id="batas" name="batas" value="2" hidden>
		                                            <input type="text" id="txtProjectno1" name="txtProjectno1" hidden>
                          							<input type="text" id="txtEntitycd1" name="txtEntitycd1" hidden>
												</td>
												<td style="width: 40%;">
													<select class="select2 form-control" id="agents1" name="agents1">
		                                                <option>Choose Agent</option>
		                                            </select>
		                                            <input type="text" id="txtdbprofile1" name="txtdbprofile1" hidden>
												</td>
												<td style="width: 10%;">
													 <button type="button" class="btn btn-danger">
		                                                <i class="ft-trash" onclick="remove(1)"></i> </button>
												</td>
											</tr>
									</table>
								</div>
								<div class="form-group overflow-hidden">
		                                <div class="col-12">
		                                    <button type="button" class="btn btn-primary" id="btnAdd">
		                                        Add
		                                    </button>
											<button type="submit" class="btn btn-success">
												Save
											</button>
		                                    <button type="button" id="btnCancel" class="btn btn-danger">
												Cancel
											</button>
		                                </div>
		                            </div>
							</form>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</section>
<!-- // Basic form layout section end -->
    </div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
 <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

 <script src="<?=base_url('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('app-assets/js/scripts/forms/form-repeater.js')?>" type="text/javascript"></script>

<script>

$(document).ready(function(){
	var x = 1;
	var maxAdd = 7;
	var addMore = $("#btnAdd");
	var fGroup = $(".fieldGroup");

	$(addMore).click(function(e){
		var xx = $("#batas").val();
		for (var i = xx; i <= xx; i++) {
			if (i < maxAdd) {
				$(fGroup).append('<tr id="id'+i+'"><td style="width: 40%;"><select class="select2 form-control" id="projectz'+i+'" name="projectz'+i+'" onchange="loadAgent('+i+')"><option>Choose Project</option><?php echo $comboproject?></select><input type="text" id="txtProjectno'+i+'" name="txtProjectno'+i+'" hidden><input type="text" id="txtEntitycd'+i+'" name="txtEntitycd'+i+'" hidden></td><td style="width: 40%;"><select class="select2 form-control" id="agents'+i+'" name="agents'+i+'"><option>Choose Agent</option></select><input type="text" id="txtdbprofile'+i+'" name="txtdbprofile'+i+'" hidden></td><td style="width: 10%;"><button type="button" class="btn btn-danger" onclick="remove('+i+')"><i class="ft-trash"></i> </button></td></tr>');
			}
		}
		xx = i;
		$('#batas').val(i);
		 $(".select2").select2({
    		width:'100%'
  		});
	});

	$('#btnCancel').click(function(){
        window.location.href= '<?php echo base_url("c_agent_regist/index")?>';
   });

});


function remove(no){
    $("#id"+no).remove();
    // $("#batas").val(x);

    var xx = parseInt($('#batas').val());
    if(xx>1) {
        xx = xx-1;
        // console.log(xx);
        $("#batas").val(xx);  
    }
}

function loadAgent(no){
	document.getElementById('loader').hidden = false;

	var dbprofile = $('#projectz'+no).find(':selected').data("db_profile");
	var entitycd = $('#projectz'+no).find(':selected').data("entity_cd");
	var projectno = $('#projectz'+no).find(':selected').data("project_no");

	$('#txtdbprofile'+no).val(dbprofile);
    $('#txtEntitycd'+no).val(entitycd);
    $('#txtProjectno'+no).val(projectno);

    if (dbprofile !== '' && entitycd !== '' && projectno !== '' ){
    	var site_url = '<?php echo base_url("c_agent_regist/zoombyAgent") ?>';
    	$.post(site_url,
    		{dbprofile:dbprofile, entitycd:entitycd, projectno:projectno},
    		function(data, status){
    			$("#agents"+no).empty();
    			$("#agents"+no).append(data);
    			$("#agents"+no).trigger('change');
    			document.getElementById('loader').hidden = true;
    		}
    	);
    }else{
    	$("#agents"+no).empty();
    }
}

</script>