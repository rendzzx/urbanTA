						<div id="panel3" class="col-sm-10">
						<!-- <fb:login-button scope="public_profile,email" autologoutlink="true" onlogin="checkLoginState();">
						</fb:login-button> -->

						

						<div class="form-group">
							<div class="col-sm-3">
									
    										<a id="customBtn" name="customBtn" class="btn btn-success btn-gmail" scope="public_profile,email">
										<img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/gmail-logo.png')?>" width="24">
										Login with G-Mail
									</a>
      										
  										<div id="name"></div>

							</div>
							<!-- <div class="col-sm-1"> </div> -->
							<div class="col-sm-3">
									<a id="btnfb" name="btnfb" class="btn btn-success btn-facebook" scope="public_profile,email" onclick="checkLoginState();">
										<img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/fb-logo.png')?>" width="24">
										Login with Facebook
									</a> 
							</div>
						</div>
						

						
						<!-- <a class="btn btn-success btn-google" href="<?php echo base_url('c_agent/log_with_google')?>" target="_blank">
                            <i class="fa fa-google"> </i> Login with Google
                        </a>
                         -->
                      

						<!-- <a class="o-flag c-btn c-btn--large c-btn--block u-mrgn-bottom--2" onclick="checkLoginState();">
							<img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/fb-logo.png')?>" width="24">
							Daftar dengan Facebook
						</a> -->
						<div id='status'></div>

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
	                        <select name="OfficeNamedtl" id="OfficeNamedtl" onchange="myFunction()" data-placeholder="Choose a Office Name..." class="select2 form-control">
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
	                    	<label for="ComAdd" class="col-sm-2 control-label"><b>City</b><FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
                 			 <select name="txtCity" id="txtCity" data-placeholder="Select City..." class="select2 form-control" tabindex="2">
                       			<option value=""></option> 
                            		<?php echo $comboCity;?>     
                    		</select>                 
                			</div>
                		</div>

	                    <!--  -->                 
	                    <div class="form-group">
	                    	<label for="EmailAdd" class="col-sm-2 control-label">Email Address<FONT COLOR="RED">*</FONT></label>
	                    	<div class="col-sm-10">
	                    		<input type="text" class="form-control" id="txtEmailAdd" name="txtEmailAdd"/>	
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
	                    		
	                    		<input type="hidden" id="txtgender" name="txtgender" class="form-control"/>	
	                    		<input type="hidden" id="txtlink" name="txtlink" class="form-control"/>	
	                    		<input type="hidden" id="txtsosmed" name="txtsosmed" class="form-control"/>	
	                    	</div>	                    	
	                    </div>
	                    
					     <!-- </form> -->
					   <!--   <div class="col-sm-10">
					        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>				        
					     </div> -->
	                  </div>
	                  <script type="text/javascript">
	                  $(".select2").select2();
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



	                  	$(document).ready(function () {	                  			
	                  			// $("#txtMbl1").inputmask("Regex", { regex: "[0-9]+$" });
	                  			// $("#txtMbl2").inputmask("Regex", { regex: "[0-9]+$" });
	                  			// $("#txtCompNPWP").mask("99-999-999-9-999-999");
								// $("#txtNPWP").mask("99.999.999.9-999.999");
								// $("#txtIdNo").mask("9999999999999999");

								// $("#txtCompNPWP").inputmask({
							 //        mask: "99.999.999.9-999.999"
							 //      });
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
	                  </script>
	                   <!-- <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script> -->
	                   <!-- scipt setting facebook -->
	                  <script type="text/javascript">
	                  	function statusChangeCallback(response) {	                  		
	                  			console.log(response);
	                  			console.log('stCllback');
	                  		if (response.status === 'connected') {
	                  				console.log('dddd');
	                  			testAPI();
	                  		} else if (response.status === 'not_authorized') {
	                  			FB.login(function(response) {
	                  				console.log(response);
	                  				console.log('not_authorized');
	                  				if (response.status === 'connected') {
	                  					testAPI();
	                  				}
	                  			}, {
	                  				scope: 'email'
	                  			});
	                  			// document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
	                  		} else {
	                  			FB.login(function(response) {
	                  				console.log(response);
	                  				console.log('not_authorized2');
	                  				if (response.status === 'connected') {
	                  					testAPI();
	                  				}
	                  			}, {
	                  				scope: 'email'
	                  			});
	                  			// document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
	                  		}
	                  	} 

	                  	window.fbAsyncInit = function() {
	                  		FB.init({
	                  			appId            : '1961289290825001',
	                  			autoLogAppEvents : true,
	                  			xfbml            : true,
								status     : true, // check login status
								cookie     : true, // enable cookies to allow the server to access the session
								version          : 'v2.1'
								// version          : 'v2.5'
							});
	                  	};

	                  	function checkLoginState() {
	                  		// alert('1');
	                  		FB.getLoginStatus(function(response) {
	                  			// console.log(response);
	                  			statusChangeCallback(response);
	                  		});
	                  	}
						// Load the SDK asynchronously
						(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.9";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk')); 

						function testAPI() {
							// console.log('Welcome!  Fetching your information.... ');
							FB.api ("/me?fields=id,name,email,gender,link", "get", function (a) {
								console.log(a);
								// document.getElementById ("txtAgentName").value = a.name
								// document.getElementById ("txtEmailAdd").value = a.email
								$('#txtAgentName').val(a.name);
							    $('#txtEmailAdd').val(a.email);
							    $('#txtgender').val(a.gender);
							    $('#txtlink').val(a.link);
							    $('#txtsosmed').val('Facebook');
								// document.getElementById('status').innerHTML = 'Thanks for logging in, ' + a.name + '!';
							})
						}
						</script>
						<!-- scipt setting gmail -->
	                  <script>
	  						var googleUser = {};
	  						var startApp = function() {
	    						gapi.load('auth2', function(){
	      						// Retrieve the singleton for the GoogleAuth library and set up the client.
	      								auth2 = gapi.auth2.init({
	        							client_id: '466737535909-cpubhuf9fv24i8hn9rp0on1eedls7djd.apps.googleusercontent.com',
	        							cookiepolicy: 'single_host_origin',
	        					// Request scopes in addition to 'profile' and 'email'
	        					//scope: 'additional_scope'
	      								});
	      						attachSignin(document.getElementById('customBtn'));
	    						});
	  						};

	  						function attachSignin(element) {
	    						console.log(element.id);
	    						auth2.attachClickHandler(element, {},
	        						function(googleUser) {
	          								// document.getElementById('name').innerText = "Signed in: " +
	              				// 			googleUser.getBasicProfile().getName();
	              						// var profile = googleUser.getBasicProfile();
	              						// console.log(profile.name);
	              						// 	$('#txtAgentName').val(profile.name);
	              							gapi.client.load('plus', 'v1', function () {
							        var request = gapi.client.plus.people.get({
							            'userId': 'me'
							        });

							        	// alert('1');
							        	// console.log(request);
							        //Display the user details
							        request.execute(function (resp) {
							            console.log(resp);
							            $('#txtAgentName').val(resp.displayName);
							            $('#txtEmailAdd').val(resp.emails[0].value);
							            $('#txtgender').val(resp.gender);
							            $('#txtlink').val(resp.url);
							            $('#txtsosmed').val('GMAIL');

							            // $('#gSignIn').slideUp('slow');
							        });
							    });
	              							// $('#txtEmailAdd').val(profile.emails[0].value);
	        						}, function(error) {
	          						alert(JSON.stringify(error, undefined, 2));
	        				});
	  					}
  				</script>

  				<script>startApp();</script>