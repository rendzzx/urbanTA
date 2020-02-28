					<div id="panel3" class="col-sm-10">
					<!-- <form id="frmEditor1" class="form-horizontal" enctype="multipart/form-data" method="post" action=""> -->
	                	<h3>Principle</h3>
	                	<hr>
	                    <div class="form-group">
	                      <label for="ArebiMember" class="col-sm-2 control-label">AREBI Member <FONT COLOR="RED">*</FONT></label>
	                      <div class="col-sm-10" >
	                      	<label class="radio-inline">
	                        	<input type="radio" id="yes" name="am" value="Y" tabindex="-2" />Yes
	                        </label>
	                        <label class="radio-inline">
	                        	<input type="radio" id="no" name="am" value="N" tabindex="-2"/>No
	                        </label>
	                        <input type="text" id="txtHidden" name="txtHidden" hidden>
	                      </div>	
	                    </div>
	                    <div class="form-group" id="panelArmNo" hidden="hidden">
	                    <label for="ArebiNumber" class="col-sm-2 control-label">AREBI Number <FONT COLOR="RED">*</FONT>
	                    </label>
	                    <div class="col-sm-10" >
	                    	<input type="text" id="txtArmNo" name="txtArmNo" class="form-control"/>
	                    </div>
	                    </div>
	                    <!-- <div class="form-group" id="divBrand"> -->
	                    <div class="form-group" id="divBrand" hidden="hidden">
	                      <label for="Brand" class="col-sm-2 control-label">Brand <FONT COLOR="RED">*</FONT></label>
	                      <div class="col-sm-10">	                      
	                        <!-- <input type="text" class="form-control" id="txtBrand" name="txtBrand"/>  -->
	                        <select name="txtBrand" id="txtBrand" data-placeholder="Choose a Brand..." class="select2 form-control" style="width: 100%;">
	                          <!-- <option>-- Choose --</option> -->
	                          <?php echo $zoom_brand?>
	                        </select> 
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <label for="OfficeName" class="col-sm-2 control-label">Office Name <FONT COLOR="RED">*</FONT></label>
	                      <div class="col-sm-10">	                      
	                        <input type="text" class="form-control" id="txtOfficeName" name="txtOfficeName"/> 
	                      </div>
	                    </div>
	                    <div class="form-group">
	                    	<label for="PT" class="col-sm-2 control-label">PT<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="PT" name="PT"/>	
	                    	</div>	                    	
	                    </div>
	                    <!-- <div class="form-group">
	                    	<label for="ComNPWP" class="col-sm-2 control-label">Company NPWP<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" id="txtCompNPWP" name="txtCompNPWP" class="form-control"/>	
	                    	</div>	                    	
	                    </div> -->
	                    <div class="form-group">
	                    	<label for="ComAdd" class="col-sm-2 control-label">Company Address<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" id="txtCompAdd" name="txtCompAdd" class="form-control"/>
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
	                    	<label for="ComAdd" class="col-sm-2 control-label"><b>Lead</b><FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
                 			 <select name="txtLead" id="txtLead" data-placeholder="Select Lead..." class="select2 form-control" tabindex="2">
                       			<option value=""></option> 
                            		<?php echo $comboLead;?>
                    		</select>                 
                			</div>
                		</div>
	                    	<!-- <div class="col-sm-2">	                    		
	                    		<input type="text" id="txtCity" name="txtCity" class="form-control"/>
	                    	</div> -->

	                    	<!-- <div class="col-sm-1"><b>Province</b><FONT COLOR="RED">*</FONT></div>
	                    	<div class="col-sm-2">
                 			 <select class="form-control chosen-select" name="txtProp" id="txtProp" data-placeholder="Select Province"></select>                  
                			</div> -->
	                    	<!-- <div class="col-sm-2">	                    		
	                    		<input type="text" id="txtProp" name="txtProp" class="form-control"/>
	                    	</div> -->
	                    	<!-- <div class="col-sm-2"><b>ZIP Code</b></div> -->
	                    	<!-- <div class="col-sm-2"><b>ZIP Code</b><FONT COLOR="RED">*</FONT></div> -->
	                    	<!-- <div class="col-sm-2">	                    		
	                    		<input type="text" id="txtCode" name="txtCode" class="form-control"/>
	                    	</div> -->
	                    
	                    <div class="form-group">
	                    	<label for="TelpNo" class="col-sm-2 control-label">Telp No</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtTelp" name="txtTelp" />
	                    		Format: 6221995500 | 021995500
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="Fax" class="col-sm-2 control-label">Fax</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtFax" name="txtFax"/>
	                    		Format: 6221995500 | 021995500	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="OffEmail" class="col-sm-2 control-label">Official Email<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtOffEmail" name="txtOffEmail"/>	
	                    	</div>	                    	
	                    </div>
	                    <!-- <div class="form-group">
	                    	<label for="CompBankName" class="col-sm-2 control-label">Company Bank Name</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtCompBankName" name="txtCompBankName"/>	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="AcctName" class="col-sm-2 control-label">Account Name</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtAcctName" name="txtAcctName"/>	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="AcctNo" class="col-sm-2 control-label">Account No</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtAcctNo" name="txtAcctNo"/>	
	                    	</div>	                    	
	                    </div> -->
	                    <div class="form-group">
	                    	<label for="PrinNo" class="col-sm-2 control-label">Principle Name<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtPrinNo" name="txtPrinNo"/>	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="IDNo" class="col-sm-2 control-label">ID No</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtIdNo" name="txtIdNo"/>	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="NPWP" class="col-sm-2 control-label">NPWP</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtNPWP" name="txtNPWP"/>	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="EmailAdd" class="col-sm-2 control-label">Email Address</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtEmailAdd" name="txtEmailAdd"/>	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="Mbl1" class="col-sm-2 control-label">Mobile 1<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtMbl1" name="txtMbl1"/>
	                    		Format: 62817737669 | 0817737669 	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="Mbl2" class="col-sm-2 control-label">Mobile 2</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtMbl2" name="txtMbl2"/>	                    		 	
								Format: 62817737669 | 0817737669	
	                    	</div>	                    	
	                    </div>
	                    <!-- <div class="form-group">
	                      <label for="AssAgent" class="col-sm-2 control-label">Interested as Assigned Agent</label>
	                      <div class="col-sm-4">
	                        <input type="radio" id="yesa" name="AssAgent" value="Y" tabindex="-2"/>
	                        <label>Yes</label>
	                        <input type="radio" id="noa" name="AssAgent" value="N" tabindex="-2"/>
	                        <label>No</label>
	                      </div>	                      
	                    </div> -->
	                    <div class="form-group" id="divPackage" hidden="hidden">
	                      <label for="AssAgent" class="col-sm-2 control-label">Package</label>
	                      <div class="col-sm-4">
	                        <input type="radio" id="yes" name="package" value="P" tabindex="-2"/>
	                        <label>Platinum</label>
	                        <input type="radio" id="no" name="package" value="G" tabindex="-2"/>
	                        <label>Gold</label>
	                      </div>	                      
	                    </div>
	                    <div class="form-group" id="descPackage" hidden="hidden">
	                    	<div class="col-sm-3"></div>
	                    	<div>
	                    		<table>
	                    			<tr>
	                    				<td>Platinum Package doesn’t apply for Jabodetabek, Surabaya & Balikpapan</td>
	                    			</tr>
	                    			<tr>
	                    			<td>&nbsp;</td>
	                    			<td>&nbsp;</td>
	                    			</tr>
	                    			<tr>
	                    				<td>PLATINUM :</td>
	                    				<td>Gold :</td>
	                    			</tr>
	                    			<tr>
	                    			<td>&nbsp;</td>
	                    			<td>&nbsp;</td>
	                    			</tr>
	                    			<tr>
	                    				<td>
	                    					<ul>
	                    						<li>Prospect buyer from call center</li>
	                    						<li>Expose at website</li>
	                    						<li>Store Banner</li>
	                    						<li>Window Sticker</li>
	                    						<li>X – banner</li>	
	                    						<li>Poster</li>                    					
	                    					</ul>
	                    				</td>
	                    				<td>
	                    					<ul>
	                    						<li>Expose at website</li>
	                    						<li>Store Banner</li>	                    						
	                    						<li>Window Sticker</li>	                    						
	                    					</ul>
	                    				</td>
	                    			</tr>	                    			
	                    		</table>
	                    	</div>
	                    </div>
	                    <!-- </form>
	                    <div class="col-sm-10">
					        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>				        
					     </div> -->
	                  </div>
	                  <!-- <input type="button" name="btn" value="province_cd" onclick="loaddata()"> -->

	                  <script type="text/javascript">
	                  	$("#txtCity").select2({
	                  		ajax:{
					            url: '<?php echo base_url("c_agent/city")?>',
					            dataType: 'json',
					            type: 'post',
					            delay: 250,
					            data: function(params) {
					              return{
					                q: params.term
					              };
					            },
					            processResults: function(data) {
					              return{
					                results: data
					              };
					            },
					            cache: false
					          },
					          minimumInputLength: 3,
					          placeholder: 'Type a city'
	                  	});
	                  	$('#txtLead').select2();
						$('#txtBrand').select2();
					    // }

					    $("#txtCity").change(function() {
				          	var ent = $(this).find(':selected').val();
				          	// alert(ent);
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

						// $("#txtProp").change(function() {
				  //         var projectNo = $(this).find(':selected').val();          
				  //         if(projectNo!=='') {
				  //           var site_url = '<?php echo base_url("c_nup_parameter/zoom_phase")?>';
				  //           $.post(site_url,
				  //             {projectNo:projectNo},
				  //             function(data,status) {
				  //               $("#TxtphaseCode").empty();
				  //               $("#TxtphaseCode").append(data);
				  //               $("#TxtphaseCode").trigger('chosen:updated');
				  //             }
				  //           );
				  //         } else {
				  //           $("#TxtphaseCode").empty();
				  //         }
				  //       });


	                  		$(document).ready(function () {
	                  			// $("#txtTelp").inputmask("Regex", { regex: "[0-9]+$" });
	                  			// $("#txtFax").inputmask("Regex", { regex: "[0-9]+$" });
	                  			// $("#txtMbl1").inputmask("Regex", { regex: "[0-9-+]+$" });
	                  			// $("#txtMbl2").inputmask("Regex", { regex: "[0-9-+]+$" });

	       						//  $("#txtCompNPWP").mask("99.999.999.9-999.999");
								// $("#txtNPWP").mask("99.999.999.9-999.999");
								// $("#txtIdNo").mask("9999999999999999");
								 $("#txtCompNPWP").inputmask({
							        mask: "99.999.999.9-999.999"
							      });
	                  			$("#txtNPWP").inputmask({
							        mask: "99.999.999.9-999.999"
							      });
	                  			
	                  			var a ='<?php echo $Type?>';
	                  			
	                  			if(a=='F'){
	                  				$('#divBrand').show();
	                  			}
	                  			$('input[name=am]').on('click change',function(e){
	                  				if (document.getElementById('yes').checked) {
	                  					$("#panelArmNo").show(900);	                  					
	                  				} else {
	                  					$("#panelArmNo").hide(900);
	                  				}
	                  				$('#txtHidden').val('YES');
	                  			});

	                  			

						    	

						    	function setcity(ent){        

						        var site_url = '<?php echo base_url("c_agent/zoom_city")?>';
						            $.post(site_url,
						              {ent:ent},
						              function(data,status) {
						                $("#txtCity").empty();
						                $("#txtCity").append(data);
						                $("#txtCity").trigger('change');
						              }
						            );
						    	}

							    function setprovince(pro){       
							    	// alter(pro);
							        var site_url = '<?php echo base_url("c_agent/zoom_province")?>';
							            $.post(site_url,
							              {pro:pro},
							              function(data,status) {
							                $("#txtProp").empty();
							                $("#txtProp").append(data);
							                $("#txtProp").trigger('change');
							              }
							            );
							    }

							    // function loaddata(){
							    // 	var province_cd = $('#txtCity').data('nup_id');
							    // 	// alert(province_cd);
							    // }


	                  			$('input[name=AssAgent]').on('click change',function(e){
	                  				if (document.getElementById('yesa').checked) {
	                  					$("#divPackage").show(900);
	                  					$("#descPackage").show(900);
	                  				} else {
	                  					$("#divPackage").hide(900);
	                  					$("#descPackage").hide(900);
	                  				}
	                  			});
	                  		});
	                  </script>

	                  
	                 