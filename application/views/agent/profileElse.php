<div class="content-wrapper">
	<div class="row border-bottom white-bg dashboard-header"> 
	  <div id="loader" class="loader" hidden="true"></div> 
	    <div class="form-group">
	      <div class="judulprojek">Profile
	      </div>
	      <!-- <div class="tittle-top pull-left">Profile
	      </div> -->
	      <div class="tittle-top pull-right">	      
	      </div>
	    </div>        
	  </div>
	<div class="wrapper wrapper-content" >
		<div class="row">
			<div class="col-xs-12">
				<form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
					<div class="ibox-content">
						<div id="panel3" class="row">
					    	<!-- <h3>Profile</h3><hr> -->
					        
					        <div class="form-group">
					          <label for="OfficeName" class="col-sm-2 control-label">Name <FONT COLOR="RED">*</FONT></label>
					          <div class="col-sm-9">	                      
					            <input type="text" class="form-control" id="Name" name="Name" /> 
					          </div>
					        </div>
					        <div class="form-group">
					        	<label for="TelpNo" class="col-sm-2 control-label">Telp No<FONT COLOR="RED">*</FONT></label>
					        	<div class="col-sm-9">
					        		<input type="text" class="form-control" id="Handphone" name="Handphone" />
					        		Format: 6221995500 | 021995500
					        	</div>	                    	
					        </div>
					        <div class="form-group">
	                      <label for="ArebiMember" class="col-sm-2 control-label">Program Menu Position <FONT COLOR="RED">*</FONT></label>
	                      <div class="col-sm-10" >
	                      	<label class="radio-inline">
	                        	<input type="radio" id="T" name="Menu" value="T" tabindex="-2" />TOP
	                        </label>
	                        <label class="radio-inline">
	                        	<input type="radio" id="L" name="Menu" value="L" tabindex="-2"/>LEFT
	                        </label>
	                        <input type="text" id="txtHidden" name="txtHidden" hidden>
	                      </div>	
	                    </div>
					        
						</div>
						<div class="modal-footer">
							<button type="button" id="btnSave" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$('#btnSave').click(function(){
	if($('#frmEditor').valid()){
		// var a='';
		// var Menu = document.getElementsByName('Menu');
		// 	for (var i = 0; i < Menu.length; i++) {
		// 		    if (Menu[i].checked) {
		// 		        // do whatever you want with the checked radio
		// 				   a =Menu[i].value;
		// 		 	}
		// 	}

		var dataform = $('#frmEditor').serializeArray();
		// dataform.push({name:"Menu",value:a});
		
		var site_url = "<?php echo base_url('c_profile/updateElse')?>";
		$.ajax({
			url: site_url,
			type: "POST",
			data: dataform,
			dataType: "json",
			success: function(data, status){
				if(data.status=='OK'){
					swal({
						title: "Information",
						text: data.Pesan,
						type: "success",
						confirmButtonText: "OK"
					},
					function(){
						$('#modal').modal('hide');
						location.reload();
					});
				} else {
					swal({
						title: "Error",
						text: data.pesan,
						type: "error",
						confirmButtonText: "OK"
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal(textStatus+' Save : '+errorThrown);
			}
		});
	}
});
loaddata();


function loaddata(){
	var Id = '<?php echo $this->session->userdata("Tsuname");?>';

	if (Id.length > 0) {
		$.getJSON("<?php echo base_url('c_profile/getByName');?>" + "/" + Id, function (data) {
				// console.log(data);
			$("#Name").val(data[0].DESCRIPTION);
			$("#Handphone").val(data[0].phone_cellular);
			if(data[0].MenuPosition){
					document.getElementById(data[0].MenuPosition).checked = true; 
			}
			

		});
	}
}



</script>