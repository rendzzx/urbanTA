<style>
td {
    height: 40px;
}
</style>
 	<!-- <div class="well well-sm"> -->
 	<div class="content-wrapper">
	 	<section class="content-header">
	    	<h1>Edit Customer</h1>
	  	</section>
 	<section class="content">
 	    <form role="form" method ="POST" action="<?php echo base_url("C_cf_Business/saveEdit"); ?>">
 				<!-- <div id="page-wrapper">  -->
		            	   <!-- /.row -->
				            <div class="row">
				                <div class="col-lg-12">
				                <div class="box">
				                    <div class="panel panel-default">
				                        <!-- div class="panel-heading">
				                            CUSTOMER
				                        </div> -->
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
																	<td > 	<input readonly="true" class="form-control" name="business_id" type="text" id="business_id" value='<?php echo $business_id[0]->business_id;?>' > </td>
																	<td>&nbsp;</td>
																	<!-- <td>Class </td> -->
																	<td>&nbsp;</td> 
																</tr>																
																<tr>
																	<td >ID  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="ic_no" type="text" id="ic_no" value="<?php echo $business_id[0]->ic_no;?>"> </td>
																	
																</tr>
																<tr> 
																	<td > Category  </td> 
																	<td>&nbsp;</td>
																	<td style = "width: 150px"> 
																	   <!-- <input id='C' name='category' type='radio' value="C">&nbsp;&nbsp;Company 
																       <input id='I' name='category' type='radio' value="I">&nbsp;&nbsp;Individu -->
																       <?php echo $checked; ?>
																    </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																<tr > 
																	<td >Name  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="name" type="text" id="name" value="<?php echo $business_id[0]->name;?>"> </td> 
																</tr>
																<tr > 
																	<td >Address  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="Address1" type="text" id="Address1" value="<?php echo $business_id[0]->address1;?>"> </td> 
																</tr>
																		<tr > 
																		<td ></td>
																		<td>&nbsp;</td>
																		<td colspan="7"> 	<input class="form-control" name="Address2" type="text" id="Address2" value="<?php echo $business_id[0]->address2;?>"> </td> 
																		</tr>
																<tr > 
																	<td ></td> 
																	<td>&nbsp;</td>
																	<td > 	<input class="form-control" name="Address3" type="text" id="Address3" value="<?php echo $business_id[0]->address3;?>"> </td>
																	<td>&nbsp;</td>
																	<td>Post Cd </td>
																	<td>&nbsp;</td>
																	<td > 	<input class="form-control" name="post_cd" type="text" id="post_cd" value="<?php echo $business_id[0]->post_cd;?>"> </td> 
																</tr>
																<tr> 
																	<td >Contact  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="contact_person" type="text" id="contact_person" value="<?php echo $business_id[0]->contact_person;?>"> </td>
																	
																</tr>
																<tr> 
																	<td >Position  </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="designation" type="text" id="designation" value="<?php echo $business_id[0]->designation;?>"> </td>
																	
																</tr>
																<tr> 
																	<td > Tel </td> 
																	<td>&nbsp;</td>
																	<td > 	<input class="form-control" name="tel_no" type="text" id="tel_no" value="<?php echo $business_id[0]->tel_no;?>"> </td>
																	<td>&nbsp;</td>
																	<td>Fax </td>
																	<td>&nbsp;</td>
																	<td > 	<input class="form-control" name="fax_no" type="text" id="fax_no" value="<?php echo $business_id[0]->fax_no;?>"> </td>
																</tr>
																<tr> 
																	<td >H/Phone  </td>
																	<td>&nbsp;</td>
																	<td><input class="form-control" name="hand_phone" type="text" id="hand_phone" value="<?php echo $business_id[0]->hand_phone;?>"> </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td> 
																</tr>
																<tr> 
																	<td >E-mail   </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="email_addr" type="text" id="email_addr" value="<?php echo $business_id[0]->email_addr;?>"> </td>
																</tr>
																<tr> 
																	<td >NPWP   </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="income_tax" type="text" id="income_tax" value="<?php echo $business_id[0]->income_tax;?>"> </td>
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
				                <div class="box">
				                    <div class="panel panel-default">
				                        <section class="content-header">
										    <h1>Individu</h1>
										 </section>
				                        <p></p>
				                        <div class="panel-body">
				                            <div class="row">
				                                <div class="col-lg-6">
				                                    <!-- <form role="form"> -->
				                                        <div class="form-group">
				                                        	<table>
																<!-- --start detail--		                                        	 -->
																<!-- <tr> 
																	<td > Gender </td> 
																	<td>&nbsp;</td>
																	<td ></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td><input type="text" class="form-control" value="<?php echo $gender; ?>">
																		 <input type="hidden" name="sex" id="sex" class="form-control" value="<?php echo $business_id[0]->sex; ?>">
																</tr> -->
																<!-- <tr>
																	<td >DOB   </td>
																	<td>&nbsp;</td>
																	<td colspan="7">    <label type="date" name="birth_date" class="form-control" id="exampleInputDOB1" value="<?php echo $business_id[0]->birth_date; ?>"></label> 
																</tr> -->
																<tr>
																	<td >Rel   </td>
																	<td>&nbsp;</td>
																	<td colspan="7">
																		<select class="form-control" name="religion_cd" type="text"><?php echo $droprelig; ?></select>
																	</td>
																</tr>
																<tr>
																	<td >Nat   </td>
																	<td>&nbsp;</td>
																	<td colspan="7">
																	<select class="form-control"  type="text" name="nationality_cd"> <?php echo $dropcom; ?> </select>
																	</td>
																	</td> 
																</tr>
																<!-- <tr>
																	<td > Married </td> 
																	<td>&nbsp;</td>
																	<td ></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td><input class="form-control" type="text" value="<?php echo "$marital"; ?>">
																		 <input class="form-control" type="hidden" name="marital_status" id="marital_status" value="<?php echo $business_id[0]->marital_status; ?>">
																    </td>
																</tr>  -->
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
				           	</div>
						</session>
 				</div> 
 				<!-- <button type="submit" class="btn btn-success btn-sm" id="btnSimpan"><i class="fa fa-save"></i> Save</button> -->
 				<input type="submit" name="BtnBack" value="Save" class="btn btn-primary">
 				<a href="<?php echo base_url("c_rl_sales_list"); ?> " ><input type="button" name="BtnBack" value="Back" class="btn btn-success"></a>
 				</form>

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

 	