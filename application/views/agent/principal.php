<form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<div id="panel3" class="row">
    	<!-- <h3>Profile</h3><hr> -->
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
            	<input type="text" id="txtArmNo" name="txtArmNo" class="form-control" readonly/>
            </div>
        </div>
        <!-- <div class="form-group" id="divBrand"> -->
        <div class="form-group" id="divBrand" hidden="hidden">
          <label for="Brand" class="col-sm-2 control-label">Brand <FONT COLOR="RED">*</FONT></label>
          <div class="col-sm-10">	                      
            <!-- <input type="text" class="form-control" id="txtBrand" name="txtBrand"/>  -->
            <select name="txtBrand" id="txtBrand" data-placeholder="Choose a Brand..." class="select2 form-control" style="width: 100%;">
              <!-- <option>-- Choose --</option> -->
              <?php //echo $zoom_brand?>
            </select> 
          </div>
        </div>
        <div class="form-group">
          <label for="OfficeName" class="col-md-8 control-label">Office Name <FONT COLOR="RED">*</FONT></label>
          <div class="col-md-10">	                      
            <input type="text" class="form-control" id="txtOfficeName" name="txtOfficeName" style="border:none; background-color:white;" readonly="readonly"/> 
          </div>
        </div>
        <div class="form-group">
        	<label for="PT" class="col-md-8 control-label">PT<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="PT" name="PT"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="ComNPWP" class="col-md-8 control-label">Company NPWP<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
        		<input type="text" id="txtCompNPWP" name="txtCompNPWP" class="form-control"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="ComAdd" class="col-md-8 control-label">Company Address<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
        		<input type="text" id="txtCompAdd" name="txtCompAdd" class="form-control"/>
        	</div>
        </div>
        <div class="form-group">
        	<label for="ComAdd" class="col-md-8 control-label"><b>City</b><FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
 			 <select name="txtCity" id="txtCity" data-placeholder="Select City..." class="select2 form-control" tabindex="2">
       			<option value=""></option> 
            		<?php //echo $comboCity;?>     
    		</select>                 
			</div>
		</div>
		<div class="form-group">
        	<label for="ComAdd" class="col-md-8 control-label"><b>Lead</b><FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
 			 <select name="txtLead" id="txtLead" data-placeholder="Select Lead..." class="select2 form-control" tabindex="2">
       			<option value=""></option> 
            		<?php //echo $comboLead;?>
    		</select>                 
			</div>
		</div>
        <div class="form-group">
        	<label for="TelpNo" class="col-md-8 control-label">Telp No<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtTelp" name="txtTelp" />
        		Format: 6221995500 | 021995500
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="Fax" class="col-md-8 control-label">Fax<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtFax" name="txtFax"/>
        		Format: 6221995500 | 021995500	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="OffEmail" class="col-md-8 control-label">Official Email<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtOffEmail" name="txtOffEmail" style="border:none; background-color:white;" readonly="readonly"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="CompBankName" class="col-md-8 control-label">Company Bank Name</label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtCompBankName" name="txtCompBankName"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="AcctName" class="col-md-8 control-label">Account Name</label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtAcctName" name="txtAcctName"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="AcctNo" class="col-md-8 control-label">Account No</label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtAcctNo" name="txtAcctNo"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="PrinNo" class="col-md-8 control-label">Principle Name<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtPrinNo" name="txtPrinNo"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="IDNo" class="col-md-8 control-label">ID No</label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtIdNo" name="txtIdNo"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="NPWP" class="col-md-8 control-label">NPWP</label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtNPWP" name="txtNPWP"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="EmailAdd" class="col-md-8 control-label">Email Address</label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtEmailAdd" name="txtEmailAdd" style="border:none; background-color:white;" readonly="readonly"/>	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="Mbl1" class="col-md-8 control-label">Mobile 1<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
        		<input type="text" class="form-control" id="txtMbl1" name="txtMbl1"/>
        		Format: 62817737669 | 0817737669 	
        	</div>	                    	
        </div>
        <div class="form-group">
        	<label for="Mbl2" class="col-md-8 control-label">Mobile 2<FONT COLOR="RED">*</FONT></label>
        	<div class="col-md-10">
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
        <!-- 
        <div class="col-sm-10">
	        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>				        
	     </div> -->
	</div>
	<div class="modal-footer">
		<button type="button" id="btnSave" class="btn btn-primary">Save</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
	</div>
</form>
<script type="text/javascript">
$('#btnSave').click(function(){
	if($('#frmEditor').valid()){
		var dataform = $('#frmEditor').serializeArray();
		var site_url = "<?php echo base_url('c_profile/updateGroup')?>";
		$.ajax({
			url: site_url,
			type: "POST",
			data: dataform,
			dataType: "json",
			success: function(data, status){
				if(status=='success'){
					swal({
						title: "Information",
						text: data.Pesan,
						type: "success",
						confirmButtonText: "OK"
					},
					function(){
						$('#modal').modal('hide');
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
$("#txtLead").select2({
    ajax:{
        url: '<?php echo base_url("c_profile/chooseLead")?>',
        dataType: 'json',
        type: 'post',
        delay: 300,
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
    placeholder: 'Choose a Leader',
    width:'100%',
    dropdownParent: "#modal"
});
$("#txtCity").select2({
    ajax:{
        url: '<?php echo base_url("c_nup/chosen_city_")?>',
        dataType: 'json',
        type: 'post',
        delay: 300,
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
    placeholder: 'Type a city' ,
    width:'100%',
    dropdownParent: "#modal"
});
function loaddata(){
	var Id = $('#modal').data('Id');
	if (Id.length > 0) {
		$.getJSON("<?php echo base_url('c_profile/getByIDGroup');?>" + "/" + Id, function (data) {
			$("[name=am").val([data[0].Arebi_Member]);
			$("#txtArmNo").val(data[0].Arebi_Number);
			$("#txtOfficeName").val(data[0].group_name);
			$("#PT").val(data[0].company_name);
			$("#txtCompNPWP").val(data[0].Company_NPWP);
			$("#txtCompAdd").val(data[0].Company_Address);
			$("#txtTelp").val(data[0].Telp_No);
			$("#txtFax").val(data[0].Fax_No);
			$("#txtOffEmail").val(data[0].Company_Email);
			$("#txtAcctName").val(data[0].Bank_Acct_Name);
			$("#txtAcctNo").val(data[0].Bank_Acct_No);
			$("#txtPrinNo").val(data[0].contact_person);
			$("#txtIdNo").val(data[0].id_no);
			$("#txtNPWP").val(data[0].NPWP);
			$("#txtEmailAdd").val(data[0].Email_Addr);
			$("#txtMbl1").val(data[0].Handphone1);
			$("#txtMbl2").val(data[0].Handphone2);
			setBankName(data[0].Bank_Name);
			setAsAgent(data[0].Assigned_Agent);
			setPackage(data[0].Package);
			setcity(data[0].city);
            setBrand(data[0].Brand);
            setLead(data[0].lead_cd);
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