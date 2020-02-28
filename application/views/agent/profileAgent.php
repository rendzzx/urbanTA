<div class="content-wrapper">
	<div class="row border-bottom white-bg dashboard-header"> 
	  <div id="loader" class="loader" hidden="true"></div> 
	    <div class="form-group">
	      <div class="judulprojek">   
	      <!-- <div class="tittle-top pull-left">           -->
	      <!-- <?php echo $project; ?><br> -->
	        <!-- <?php echo($agent->agent_name)?> -->Profile
	      </div>
	      <div class="tittle-top pull-right">
	      	<!-- <b><?php if($status=='N'){echo 'ADD NUP Entry '.$phase->descs;}else{echo 'EDIT NUP Entry '.$phase->descs;} ?></b> -->
	      </div>
	    </div>        
	  </div>
	<div class="wrapper wrapper-content" >
		<div class="row">
			<div class="col-xs-12">
				<form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
					<div class="ibox-content">
						<div id="panel3" class="row">
							<!-- <h3>Profile</h3> -->
							<!-- <hr> -->
							<div class="form-group">
								<label for="OfficeName" class="col-sm-2 control-label">Office Name <FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<select disabled="true" name="OfficeNamedtl" id="OfficeNamedtl" onchange="myFunction()"  data-placeholder="Choose a Office Name..." class="select2 form-control">	                          
										<!-- <?php echo $zoom?> -->
									</select>  
								</div>
							</div>
							<div class="form-group">
								<!-- <?php echo $this->session->userdata("Tsuname");?> -->
								<label for="PT" class="col-sm-2 control-label">PT<FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" style = "border:none; background-color:white;" readonly="true" id="PTPTdtl" name="PTPTdtl"/>	
								</div>	                    	
							</div>
							<div class="form-group">
								<label for="AgentName" class="col-sm-2 control-label">Agent Name<FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<input type="text" id="txtAgentName" name="txtAgentName" class="form-control"/>	
								</div>	                    	
							</div>
							<div class="form-group">
								<label for="IDNo" class="col-sm-2 control-label">ID No<FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtIdNo" name="txtIdNo"/>	
								</div>	                    	
							</div>
							<div class="form-group">
								<label for="NPWP" class="col-sm-2 control-label">NPWP<FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtNPWP" name="txtNPWP"/>	
								</div>	                    	
							</div>
							<div class="form-group">
								<label for="HomeAdd" class="col-sm-2 control-label">Home Address<FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtHomeAdd" name="txtHomeAdd"/>	
								</div>	                    	
							</div>
							<div class="form-group">
								<label for="ComAdd" class="col-sm-2 control-label"><b>City</b><FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<select name="txtCity" id="txtCity" data-placeholder="Select City..." class="select2 form-control" tabindex="2">
										<option value=""></option> 
										<?php echo $comboCity;?>     
									</select>                 
								</div>
							</div>                 
							<div class="form-group">
								<label for="EmailAdd" class="col-sm-2 control-label">Email Address<FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtEmailAdd" name="txtEmailAdd" disabled/>	
								</div>	                    	
							</div>	                    
							<div class="form-group">
								<label for="Mbl1" class="col-sm-2 control-label">Mobile 1<FONT COLOR="RED">*</FONT></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtMbl1" name="txtMbl1"/>Format: 62817737669 | 0817737669 	
								</div>	                    	
							</div>
							<div class="form-group">
								<label for="Mbl2" class="col-sm-2 control-label">Mobile 2</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="txtMbl2" name="txtMbl2"/>	Format: 62817737669 | 0817737669 
								</div>	                    	
							</div>
						</div>
						<br>
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
      
      if($('#frmEditor').valid())
      {
        
       
        // alert(ID);
        var dataform = $('#frmEditor').serializeArray();
       
        
        // console.log(dataform);
        // return;
       
        var site_url = "<?php echo base_url('c_profile/update')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: dataform,
          dataType: "json",
          success: function(data, status){
    		console.log(data);

            if(status=='success'){
                  swal({
                    title: "Information",
                    text: data.Pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){
                  	$('#modal').modal('hide');
                    // alert("<?php echo base_url('c_nup/Index');?>");
                    // window.location.href="<?php echo base_url('c_nup/Index');?>"
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
        })
      }
    });
function myFunction()
{
	var x = document.getElementById("OfficeNamedtl").value;
	var site_url = '<?php echo base_url("c_agent/getById")?>';
	$.post(site_url,
		{Id:x},
		function(data,status) {
      	// console.log(data);
      	$('#PTPTdtl').val(data);
        // $("#customer").empty();
        // $("#customer").append(data);
        // $("#customer").trigger('chosen:updated');
    	}
    );			    
}
	loaddata();
	$(".select2").select2({
		// dropdownParent: "#modal",
		width:'100%'
	});
	$("#txtCity").select2({
		ajax:{
            url: '<?php echo base_url("c_nup/chosen_city_")?>',
            dataType: 'json',
            type: 'post',
            delay: 1000,
            data: function(params) {
              // document.getElementById('loader').hidden=false;
              return{
                q: params.term
              };
            },
            processResults: function(data) {
              // console.log(data);
              // document.getElementById('loader').hidden=true;
              return{
                results: data
              };
            },
            cache: false            
          },
          minimumInputLength: 3,
          placeholder: 'Type a city' ,
		width:'100%',
		dropdownParent: "#modal"
	});


	$("#txtCity").change(function() {
		var ent = $(this).find(':selected').val();
		if(ent!=='') {
			var site_url = '<?php echo base_url("c_agent/zoom_province")?>';
			$.post(site_url,
				{ent:ent},
				function(data,status) {
					$("#txtProp").empty();
					$("#txtProp").append(data);
					$("#txtProp").trigger('change');
				}
				);
		} else {
			$("#txtProp").empty();
		}
	});



	$(document).ready(function () {
		$("#txtNPWP").inputmask({
			mask: "99.999.999.9-999.999"
		});
	});

	function setcity(ent){ 
		var site_url = '<?php echo base_url("c_nup/chosen_city")?>';
		$.post(site_url,
			{Id:ent},
			function(data,status) {
				// console.log(data);
				$("#txtCity").empty();
				$("#txtCity").append(data);
				$("#txtCity").trigger('change');
			}
			);
	}

	function setOffice(pro){  
		var site_url = '<?php echo base_url("c_profile/zoom_office")?>';
		$.post(site_url,
			{Id:pro},
			function(data,status) {
				$("#OfficeNamedtl").empty();
				$("#OfficeNamedtl").append(data);
				$("#OfficeNamedtl").trigger('change');
			}
			);
	}

	function loaddata(){
		// var Ida = $('#modal').data('Id');
		var Ida = '<?php echo $this->session->userdata("Tsuname");?>';
		// alert(Ida);
		// alert(Ida.length);
		// ScreenID = nup_id;

		if (Ida.length > 0) {
			$.getJSON("<?php echo base_url('c_profile/getByID');?>" + "/" + Ida, function (data) {
				// console.log(data);
				$('#txtAgentName').val(data[0].agent_name);
				$('#txtIdNo').val(data[0].id_no);
				$('#txtNPWP').val(data[0].npwp);
				$('#txtHomeAdd').val(data[0].home_address);
				$('#txtEmailAdd').val(data[0].email_add);
				$('#txtMbl1').val(data[0].handphone1);
				$('#txtMbl2').val(data[0].handphone2);
				setcity(data[0].city);
				setOffice(data[0].group_cd);
			});
		}
}
</script>
