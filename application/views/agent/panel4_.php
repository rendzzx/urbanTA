						<div id="panel3" class="col-sm-10">
						<!-- <form id="frmEditor1" class="form-horizontal" enctype="multipart/form-data" method="post" action=""> -->
	                	<h3>Marketing Executive</h3>
	                	<hr>
	                    <!-- <div class="form-group">
	                      <label for="ArebiMember" class="col-sm-2 control-label">AREBI Member <FONT COLOR="RED">*</FONT></label>
	                      <div class="col-sm-2">
	                        <input type="radio" id="yes" name="am" value="y"/>
	                        <label>Yes</label>
	                        <input type="radio" id="no" name="am" value="n"/>
	                        <label>No</label>
	                      </div>
	                      <div id="panelArmNo" class="col-sm-8">
	                    	<input type="text" id="txtArmNo" name="txtArmNo" class="form-control"/>
	                      </div>
	                    </div> -->
	                    <div class="form-group">
	                      <label for="OfficeName" class="col-sm-2 control-label">Office Name <FONT COLOR="RED">*</FONT></label>
	                      <div class="col-sm-10">
	                        <select name="OfficeNamedtl" id="OfficeNamedtl" onchange="myFunction()" class="form-control">
	                          <!-- <option>-- Choose --</option> -->
	                          <?php echo $zoom?>
	                        </select>  
	                      </div>
	                    </div>
	                    <div class="form-group">
	                    	<label for="PT" class="col-sm-2 control-label">PT<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" style = "border:none; background-color:white;" readonly="true" id="PTdtl" name="PTPTdtl"/>	
	                    	</div>	                    	
	                    </div>
	                     <div class="form-group">
	                    	<label for="AgentName" class="col-sm-2 control-label">Agent Name<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" id="txtAgentName" name="txtAgentName" class="form-control"/>	
	                    	</div>	                    	
	                    </div>
	                    <!--<div class="form-group">
	                    	<label for="ComAdd" class="col-sm-2 control-label">Company Address<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" id="txtCompAdd" name="txtCompAdd" class="form-control"/>
	                    	</div>
	                    </div> -->
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
	                    	<label for="City" class="col-sm-2 control-label"><FONT COLOR="RED"></FONT></label>
	                    	<div class="col-sm-1"><b>City</b><FONT COLOR="RED">*</FONT></div>
	                    	<div class="col-sm-2">	                    		
	                    		<input type="text" id="txtCity" name="txtCity" class="form-control"/>
	                    	</div>
	                    	<div class="col-sm-1"><b>Province</b><FONT COLOR="RED">*</FONT></div>
	                    	<div class="col-sm-2">	                    		
	                    		<input type="text" id="txtProp" name="txtProp" class="form-control"/>
	                    	</div>
	                    	<div class="col-sm-2"><b>ZIP Code</b><FONT COLOR="RED">*</FONT></div>
	                    	<div class="col-sm-2">	                    		
	                    		<input type="text" id="txtCode" name="txtCode" class="form-control"/>
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
	                    		<input type="text" class="form-control" id="txtMbl1" name="txtMbl1"/>Format: +62817737669 | 62817737669 | 0817737669 	
	                    	</div>	                    	
	                    </div>
	                    <div class="form-group">
	                    	<label for="Mbl2" class="col-sm-2 control-label">Mobile 2</label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtMbl2" name="txtMbl2"/>	Format: +62817737669 | 62817737669 | 0817737669 
	                    	</div>	                    	
	                    </div>
	                    
					     <!-- </form> -->
					   <!--   <div class="col-sm-10">
					        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>				        
					     </div> -->
	                  </div>
	                  <script type="text/javascript">
	                  	$(document).ready(function () {	                  			
	                  			$("#txtMbl1").inputmask("Regex", { regex: "[0-9]+$" });
	                  			$("#txtMbl2").inputmask("Regex", { regex: "[0-9]+$" });
	                  		});
	                  </script>
	                  