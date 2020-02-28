<form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<div id="panel3" class="row">
    	<!-- <h3>Profile</h3><hr> -->
        <div class="form-group" hidden="hidden">
          <label for="ArebiMember" class=" col-sm-3 control-label">AREBI Member </label>
          <div class=" col-sm-8" >
          	<label class="radio-inline">
            	<input type="radio" id="yes" name="am" value="Y" tabindex="-2" disabled/>Yes
            </label>
            <label class="radio-inline">
            	<input type="radio" id="no" name="am" value="N" tabindex="-2" disabled/>No
            </label>
            <input type="text" id="txtHidden" name="txtHidden" hidden>
          </div>	
        </div>
        <div class="form-group" id="panelArmNo">
            <label for="ArebiNumber" class=" col-sm-3 control-label">AREBI Number 
            </label>
            <div class=" col-sm-8" >
            	<input type="text" id="txtArmNo" name="txtArmNo" class="form-control" style="border:none; background-color:white;" readonly/>
            </div>
        </div>
        <!-- <div class="form-group" id="divBrand"> -->
        <div class="form-group" id="divBrand" hidden="hidden">
          <label for="Brand" class=" col-sm-3 control-label">Brand </label>
          <div class=" col-sm-8">	                      
            
            <input type="text" class="form-control" name="txtBrand" id="txtBrand" style="border:none; background-color:white;" readonly="readonly"/>  
          </div>
        </div>
        <div class="form-group">
          <label for="OfficeName" class=" col-sm-3 control-label">Office Name </label>
          <div class=" col-sm-8">	                      
            <input type="text" class="form-control" id="txtOfficeName" name="txtOfficeName" style="border:none; background-color:white;" readonly="readonly"/> 
          </div>
        </div>
        <div class="form-group">
        	<label for="PT" class=" col-sm-3 control-label">PT </label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="PT" name="PT" style="border:none; background-color:white;" readonly/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="ComNPWP" class=" col-sm-3 control-label">Company NPWP </label>
        	<div class=" col-sm-8">
        		<input type="text" id="txtCompNPWP" name="txtCompNPWP" class="form-control" style="border:none; background-color:white;" readonly/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="ComAdd" class=" col-sm-3 control-label">Company Address </label>
        	<div class=" col-sm-8">
        		<input type="text" id="txtCompAdd" name="txtCompAdd" class="form-control" style="border:none; background-color:white;" readonly/>
        	</div>
        </div>
        <div class="form-group">
        	<label for="ComAdd" class=" col-sm-3 control-label"><b>City</b> </label>
        	<div class=" col-sm-8">
 			
                <input type="text" class="form-control" name="txtCity" id="txtCity" style="border:none; background-color:white;" readonly/>           
			</div>
		</div>
		<div class="form-group">
        	<label for="ComAdd" class=" col-sm-3 control-label"><b>Lead</b> </label>
        	<div class=" col-sm-8">
                <input type="text" class="form-control" name="txtLead" id="txtLead" style="border:none; background-color:white;" readonly/>
            </div>                
			</div>
		</div>
        <div class="form-group">
        	<label for="TelpNo" class=" col-sm-3 control-label">Telp No </label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtTelp" name="txtTelp" style="border:none; background-color:white;" readonly/>
        		
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="Fax" class=" col-sm-3 control-label">Fax </label>
        	<div class=" col-sm-8"> 
        		<input type="text" class="form-control" id="txtFax" name="txtFax" style="border:none; background-color:white;" readonly/>
        		
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="OffEmail" class=" col-sm-3 control-label">Official Email </label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtOffEmail" name="txtOffEmail" style="border:none; background-color:white;" readonly="readonly"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="CompBankName" class=" col-sm-3 control-label">Company Bank Name</label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtCompBankName" name="txtCompBankName" style="border:none; background-color:white;" readonly/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="AcctName" class=" col-sm-3 control-label">Account Name</label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtAcctName" name="txtAcctName" style="border:none; background-color:white;" readonly/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="AcctNo" class=" col-sm-3 control-label">Account No</label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtAcctNo" name="txtAcctNo" style="border:none; background-color:white;" readonly/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="PrinNo" class=" col-sm-3 control-label">Principle Name </label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtPrinNo" name="txtPrinNo" style="border:none; background-color:white;" readonly/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="IDNo" class=" col-sm-3 control-label">ID No</label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtIdNo" name="txtIdNo" style="border:none; background-color:white;" readonly/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="NPWP" class=" col-sm-3 control-label">NPWP</label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtNPWP" name="txtNPWP" style="border:none; background-color:white;" readonly/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="EmailAdd" class=" col-sm-3 control-label">Email Address</label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtEmailAdd" name="txtEmailAdd" style="border:none; background-color:white;" readonly="readonly"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="Mbl1" class=" col-sm-3 control-label">Mobile 1 </label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtMbl1" name="txtMbl1" style="border:none; background-color:white;" readonly />	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="Mbl2" class=" col-sm-3 control-label">Mobile 2 </label>
        	<div class=" col-sm-8">
        		<input type="text" class="form-control" id="txtMbl2" name="txtMbl2" style="border:none; background-color:white;" readonly/>	  
        	</div>	                    	
        </div>
        <div class="form-group" hidden="hidden">
          <label for="AssAgent" class=" col-sm-3 control-label">Interested as Assigned Agent</label>
          <div class="col-sm-4">
            <input type="radio" id="yesa" name="AssAgent" value="Y" tabindex="-2"/>
            <label>Yes</label>
            <input type="radio" id="noa" name="AssAgent" value="N" tabindex="-2"/>
            <label>No</label>
          </div>	                      
        </div>
        <div class="form-group" id="divPackage" hidden="hidden">
          <label for="AssAgent" class=" col-sm-3 control-label">Package</label>
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
        <!-- 
        <div class=" col-sm-8">
	        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>				        
	     </div> -->
	</div>
	<div class="modal-footer">
		
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</form>
<script type="text/javascript">

loaddata();
$("#txtBrand").select2({
    ajax:{
        url: '<?=base_url("c_profile/chooseBrand")?>',
        dataType: "JSON",
        type: "POST",
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
    minimumInputLength: 2,
    placeholder: 'Choose a brand' ,
    width:'100%',
    dropdownParent: "#modal"
});

function loaddata(){
	var Id = $('#modal').data('id');
    // alert(Id);
    // alert('principal');
	if (Id.length > 0) {
		$.getJSON("<?php echo base_url('c_agent_approval/getByID');?>" + "/" + Id, function (data) {
			$("[name=am").val([data[0].principal_arebi_member]);
			$("#txtArmNo").val(data[0].principal_arebi_no);
			$("#txtOfficeName").val(data[0].group_name);
			$("#PT").val(data[0].company_name);
			$("#txtCompNPWP").val(data[0].Company_NPWP);
			$("#txtCompAdd").val(data[0].Company_Address);
			$("#txtTelp").val(data[0].principal_telp);
			$("#txtFax").val(data[0].principal_fax);
			$("#txtOffEmail").val(data[0].Company_Email);
            $("#txtCompBankName").val(data[0].principal_bank_name);
			$("#txtAcctName").val(data[0].principal_bank_acct);
			$("#txtAcctNo").val(data[0].principal_bank_no);
			$("#txtPrinNo").val(data[0].principle_name);
			$("#txtIdNo").val(data[0].contact_no);
			$("#txtNPWP").val(data[0].principal_npwp);
			$("#txtEmailAdd").val(data[0].principal_email_add);
			$("#txtMbl1").val(data[0].principal_handphone1);
			$("#txtMbl2").val(data[0].principal_handphone2);
            $('#txtCity').val(data[0].principal_city);
            $('#txtLead').val(data[0].lead_name);
            $('#txtOffEmail').val(data[0].email_add);
			// setBankName(data[0].Bank_Name);
			// setAsAgent(data[0].Assigned_Agent);
			// setPackage(data[0].Package);
			// setcity(data[0].city);
   //          setBrand(data[0].Brand);
   //          setLead(data[0].lead_cd);
		});
	}
}
$(function(){
	$("#txtCompNPWP").inputmask({
		mask: "99.999.999.9-999.999"
	});
	$("#txtNPWP").inputmask({
		mask: "99.999.999.9-999.999"
	});
	$('input[name=am]').on('click change',function(e){
		if (document.getElementById('yes').checked) {
			$("#panelArmNo").show(900);	                  					
		} else {
			$("#panelArmNo").hide(900);
		}
		$('#txtHidden').val('YES');
	});

	$('input[name=AssAgent]').on('change',function(e){
		if (document.getElementById('yesa').checked) {
			$("#divPackage").show(900);
			$("#descPackage").show(900);
		} else {
			$("#divPackage").hide(900);
			$("#descPackage").hide(900);
		}
	});
});
function setAsAgent(n){
	if(n!=0 || n.length>1){
		$("[name=AssAgent]").val([n]);
	}
}
function setPackage(n){
	if(n!=0 || n.length>1){
		$("[name=package]").val([n]);
	}
}
function setBankName(n){
	if(n!=0 || n.length>1){
		$("#txtCompBankName").val(n);
	}
}
function setBrand(n){
    if(n!=0 || n.length>1){
        var site_url = '<?=base_url("c_profile/choosen_Brand")?>';
        $.post(site_url,
            {Id:n},
            function(data, status){
                $("#txtBrand").empty;
                $("#txtBrand").append(data);
                $("#txtBrand").trigger('change');
            }
        );
    }
}
function setcity(ent){ 
	var site_url = '<?php echo base_url("c_nup/chosen_city")?>';
	$.post(site_url,
		{Id:ent},
		function(data,status) {
			$("#txtCity").empty();
			$("#txtCity").append(data);
			$("#txtCity").trigger('change');
		}
	);
}
function setLead(m){
    if(m!=0 || m.length>1){
        var site_url = '<?php echo base_url("c_profile/choose_Lead")?>';
        $.post(site_url,
            {Id:m},
            function(data, status){
                $("#txtLead").empty;
                $("#txtLead").append(data);
                $("#txtLead").trigger('change');
            }
        );
    }
}

</script>