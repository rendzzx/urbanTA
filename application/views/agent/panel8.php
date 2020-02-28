						<div id="panel3" class="col-sm-10">
						
	                	<h3>Inhouse</h3>
	                	<hr>           
	                    
	                    <!-- <div class="form-group">
	                    	<label for="PT" class="col-sm-2 control-label">PT<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="PT" name="PT"/>	
	                    	</div>	                    	
	                    </div> -->
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
                 			 <select name="txtCity" id="txtCity" data-placeholder="Choose a Project..." class="chosen-select form-control" tabindex="2">
                       			<option value=""></option> 
                            		<?php echo $comboCity;?>     
                    		</select>                 
                			</div>
                		</div>


	                                      
	                    <div class="form-group">
	                    	<label for="EmailAdd" class="col-sm-2 control-label">Email Address<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtEmailAdd" name="txtEmailAdd"/>	
	                    	</div>	                    	
	                    </div>	                    
	                    <div class="form-group">
	                    	<label for="Mbl1" class="col-sm-2 control-label">Mobile 1<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtMbl1" name="txtMbl1"/>	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="Mbl2" class="col-sm-2 control-label">Mobile 2</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtMbl2" name="txtMbl2"/>	
	                    	</div>	                    	
	                    </div>
	                  </div>

	                  <script type="text/javascript">
	        //           var config = {
					    //   '.chosen-select'           : {},
					    //   '.chosen-select-deselect'  : {allow_single_deselect:true},
					    //   '.chosen-select-no-single' : {disable_search_threshold:10},
					    //   '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
					    //   '.chosen-select-width'     : {width:"95%"}
					    // }
					    // $(".chosen-select").chosen({ width: '100%'});
					    // for (var selector in config) {
					    //   $(selector).chosen(config[selector]);
					    // }
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
				                $("#txtProp").trigger('chosen:updated');
				              }
				            );
				          } else {
				            $("#txtProp").empty();
				          }
				        });


	                  	$(document).ready(function () {	                  			
	                  			// $("#txtMbl1").inputmask("Regex", { regex: "[0-9]+$" });
	                  			// $("#txtMbl2").inputmask("Regex", { regex: "[0-9]+$" });
	                  			// $("#txtNPWP").mask("99-999-999-9-999-999");
	            //       			$("#txtCompNPWP").inputmask({
							      //   mask: "99.999.999.9-999.999"
							      // });
	                  			$("#txtNPWP").inputmask({
							        mask: "99.999.999.9-999.999"
							      });
	                  		});
	                  	function setcity(ent){        

						        var site_url = '<?php echo base_url("c_agent/zoom_city")?>';
						            $.post(site_url,
						              {ent:ent},
						              function(data,status) {
						                $("#txtCity").empty();
						                $("#txtCity").append(data);
						                $("#txtCity").trigger('chosen:updated');
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
							                $("#txtProp").trigger('chosen:updated');
							              }
							            );
							    }
	                  </script>
	                  