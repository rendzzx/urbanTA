<style>
td {
    height: 40px;
}
</style>
 	<!-- <div class="well well-sm"> -->
 	<div class="content-wrapper">
 	<section class="content-header">
 	    <form role="form" method ="POST" action="<?php echo base_url("C_cf_Business/Insertcustomer"); ?>">
 				<!-- <div id="page-wrapper">  -->
 					<div class="row">
		               <!--  <div class="col-lg-12">
		                    <h6 class="page-header"></h6> -->
		                <!-- </div>  -->
		            </div>
		            	   <!-- /.row -->
				            <div class="row">
				                <div class="col-lg-12">
				                    <div class="panel panel-default">
				                        <div class="panel-heading">
				                            CUSTOMER
				                        </div>
				                        <p></p>
				                        <div class="panel-body">
				                            <div class="row">
				                                <div class="col-lg-6">
				                                    <!-- <form role="form" method ="POST" action="<?php echo base_url("C_cf_Business/Insertcustomer"); ?>"> -->
				                                    <?php if(!empty($error)) {
				                                     echo $error;
				                                     } ?>
				                                        <div class="form-group">
				                                        	<table>  
																<!-- --start detail--		                                        	 -->
																<tr> 
																	<td > Business ID   </td> 
																	<td>&nbsp;</td>
																	<td > 	<input readonly="true" class="form-control" name="business_id" type="input" id="business_id" value='<?php echo $business_id->COUNTER;?>' > </td>
																	<td>&nbsp;</td>
																	<td>Class </td>
																	<td>&nbsp;</td> 
																	<td>   
																	<select class="form-control" name="class_cd">
																            <?php 
																            foreach($group as $row)
																              { 
																                 if($row->class_cd==='APT') 
																                 {
																                 		echo '<option value="'.$row->class_cd.'" selected>'.$row->class_cd.'</option>'; 
																                 }
																                 else{
																                 	echo '<option value="'.$row->class_cd.'">'.$row->class_cd.'</option>'; 
																                 }
																              }
																            ?>
																    </select>
																	</td>
																</tr>																
																<tr>
																	<td >ID  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="ic_no" type="text" id="ic_no" > </td>
																	
																</tr>
																<tr> 
																	<td > Category  </td> 
																	<td>&nbsp;</td>
																	<td style = "width: 150px"> 
																	   <input id='C' name='category' type='radio' value="C" checked/>&nbsp;&nbsp;Company 
																       <input id='I' name='category' type='radio' value="I" />&nbsp;&nbsp;Individu
																    </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																<tr > 
																	<td >Name  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="name" type="input" id="name"> </td> 
																</tr>
																<tr > 
																	<td >Address  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="Address1" type="input" id="Address1"> </td> 
																</tr>
																		<tr > 
																		<td ></td>
																		<td>&nbsp;</td>
																		<td colspan="7"> 	<input class="form-control" name="Address2" type="input" id="Address2"> </td> 
																		</tr>
																<tr > 
																	<td ></td> 
																	<td>&nbsp;</td>
																	<td > 	<input class="form-control" name="Address3" type="input" id="Address3"> </td>
																	<td>&nbsp;</td>
																	<td>Post Cd </td>
																	<td>&nbsp;</td>
																	<td > 	<input class="form-control" name="post_cd" type="input" id="post_cd" > </td> 
																</tr>
																<tr> 
																	<td >Contact  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="contact_person" type="input" id="contact_person"> </td>
																	
																</tr>
																<tr> 
																	<td >Position  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="designation" type="input" id="designation"> </td>
																	
																</tr>
																<tr> 
																	<td > Tel </td> 
																	<td>&nbsp;</td>
																	<td > 	<input class="form-control" name="tel_no" type="input" id="tel_no"> </td>
																	<td>&nbsp;</td>
																	<td>Fax </td>
																	<td>&nbsp;</td>
																	<td > 	<input class="form-control" name="fax_no" type="input" id="fax_no"> </td>
																</tr>
																<tr> 
																	<td >H/Phone  </td>
																	<td>&nbsp;</td>
																	<td><input class="form-control" name="hand_phone" type="input" id="hand_phone"> </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td> 
																</tr>
																<tr> 
																	<td >E-mail   </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="email_addr" type="input" id="email_addr"> </td>
																</tr>
																<tr> 
																	<td >NPWP   </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="income_tax" type="input" id="income_tax"> </td>
																</tr>
																<!-- --End detail--	 -->

																<!-- </tr>  -->
				                                        		</font>
				                                        	</table>
				                                        </div>
				                                    <!-- </form> -->
				                                </div> 
				                            </div>
				                        </div>
				                    </div>
				                </div>
				           	</div>

<!-- <script type="text/javascript" src="./assets/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- <script type="text/javascript"></script>  -->
 				<!-- </div>  -->
 	   <!-- end panel 1 -->
<!-- START PANEL INDIVIDUE --> 


<!-- <script type="text/javascript"></script> -->


<!-- <div id="page-wrapper"> -->
<div id="panel_2">
<div class="row">
  <!--   <div class="col-lg-12">
        <h1 class="page-header">Tes</h1>
    </div>  -->
</div>
		            	   <!-- /.row -->
				            <div class="row">
				                <div class="col-lg-12">
				                    <div class="panel panel-default">
				                        <div class="panel-heading">
				                            INDIVIDU
				                        </div>
				                        <p></p>
				                        <div class="panel-body">
				                            <div class="row">
				                                <div class="col-lg-6">
				                                    <!-- <form role="form"> -->
				                                        <div class="form-group">
				                                        	<table>
																<!-- --start detail--		                                        	 -->
																<tr> 
																	<td > Gender </td> 
																	<td>&nbsp;</td>
																	<td ></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td><label class="radio-inline">
																		 <input type="radio" name="sex" id="sex" value="M" checked>Male
																		 </label> 
																		 <label class="radio-inline">
																		 <input type="radio" name="sex" id="sex" value="F" checked>Female
																		 </label> </td>
																</tr>
																<tr>
																	<td >DOB   </td>
																	<td>&nbsp;</td>
																	<td colspan="7">    <input type="date" name="birth_date" class="form-control" id="exampleInputDOB1" placeholder="Date of Birth"> 
																</tr>
																<tr>
																	<td >Rel   </td>
																	<td>&nbsp;</td>
																	<td colspan="7">   
																		<select class="form-control" name="religion_cd">
																	            <?php 
																	            foreach($religion as $row)
																	            {   echo '<option value="'.$row->religion_cd.'">'.$row->descs.'</option>'; }
																	            ?>
																	    </select>
																	</td>
																	</td>
																</tr>
																<tr>
																	<td >Nat   </td>
																	<td>&nbsp;</td>
																	<td colspan="7">  
																			<select class="form-control" name="nationality">
																				            <?php 
																				            foreach($nationality as $row)
																				            {   
																				            	echo '<option value="'.$row->nationality_cd.'">'.$row->descs.'</option>'; }
																				            ?>
																				    </select>
																	</td>
																	</td> 
																</tr>
																<tr>
																	<td > Married </td> 
																	<td>&nbsp;</td>
																	<td ></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td><label class="radio-inline">
																		 <input type="radio" name="marital_status" id="marital_status" value="Y" checked>Yes
																		 </label> 
																		 <label class="radio-inline">
																		 <input type="radio" name="marital_status" id="marital_status" value="N" checked>No
																		 </label> </td>
																</tr> 
				                                        		<!-- </tr> -->
				                                        	</table>
				                                        </div>
				                                    <!-- </form> -->
				                                </div>
				                            </div>
				                        </div>

				                    </div>
				                </div>
				           	</div>
						</session>
 				</div> 
 				<!-- <button type="submit" class="btn btn-success btn-sm" id="btnSimpan"><i class="fa fa-save"></i> Save</button> -->
 				<input type="submit" name="BtnBack" value="Save" class="btn btn-primary">
 				<a href="<?php echo base_url("c_rl_sales"); ?> " ><input type="button" name="BtnBack" value="Back" class="btn btn-success"></a>

				<!-- <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Back</button> -->
 				<!-- </div> -->
			 		<!-- /#wrapper 2
<!-- END PANEL INDIVIDUE --> 
			 		<!-- /#wrapper
<!-- end panel 1 -->

			    <!-- jQuery 
			    <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>
			    <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
			    <script src="./assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
			    <script src="./assets/dist/js/sb-admin-2.js"></script>-->

			    <script type="text/javascript">
					    $(document).ready (function() { 
					        if (document.getElementById('C').checked) { 
					        			 $("#panel_2").hide();
					        			 console.log('hide');
					        } else {
					        			 $("#panel_2").show();
					        			 console.log('show');
					        }
					    });
					    $('input[type="radio"]').on('click change',function(e){
					    	console.log(e.type);
					    	if (document.getElementById('C').checked) { 
					        			 $("#panel_2").hide();
					        			 console.log('hide');
					        } else { 
					        			 $("#panel_2").show();
					        			 console.log('show');
					        }
					    });
					</script> 
 		 </form>
 		 </div>

 	