<link href="<?=base_url('plugins/datepicker/datepicker3.css')?>" rel="stylesheet" />
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<style>
td {
    height: 40px;
}
</style>
 	<!-- <div class="well well-sm"> -->
 	<div class="content-wrapper">
	 
 	<!-- <section class="content"> -->
 	    <form role="form" id ="frmCfBusiness" method ="POST" action="<?php echo base_url("C_cf_Business/Insertcustomer"); ?>">
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
				                                 
				                                        <div class="form-group">
				                                        	<table>  
																<!-- --start detail--		                                        	 -->
																<!-- <tr> 
																	<td > Business ID   </td> 
																	<td>&nbsp;</td>
																	<td > 	<input readonly="true" class="form-control" name="business_id" type="input" id="business_id" value='<?php echo $business_id->COUNTER;?>' > </td>
																	<td>&nbsp;</td>
																	<td>Class </td>
																	<td>&nbsp;</td> 
																	<td>   
																	<select class="form-control chosen-select"  name="class_cd">
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
																</tr>	 -->															
																<tr>
																	<td >ID No </td>
																	<td>&nbsp;</td>
																	<td colspan="7"> 	<input class="form-control" name="ic_no" type="text" id="ic_no" > </td>
																	
																</tr>
																<tr> 
																	<td > Category  </td> 
																	<td>&nbsp;</td>
																	<td > 
																	   <input id='C' name='category' type='radio' value="C" checked/>&nbsp;&nbsp;Company 
																       <input id='I' name='category' type='radio' value="I" />&nbsp;&nbsp;Individu
																    </td>
																	<!-- <td></td>
																	<td></td>
																	<td></td>
																	<td></td> -->
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
				           	</div>

				<div id="panel_2">
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
																<tr> 
																	<td > Gender </td> 
																	<td>&nbsp;</td>
																	<!-- <td ></td>
																	<td></td>
																	<td></td>
																	<td></td> -->
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
																	<td colspan="7" class="input-group">    
																	<input id="date_of_birth" name="date_of_birth" class="form-control" type="text" value="<?php 
                                $mydate=date("d/m/Y");
                                // $Tanggal = "$mydate[mday] $mydate[month] $mydate[year]";
                                echo "$mydate";//[mday] / $mydate[month] / $mydate[year]";
                                // echo $Tanggal;
                          ?> ">
                            <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            
                            </div>
																	
																	</td>
																</tr>
																<tr>
																	<td >Rel   </td>
																	<td>&nbsp;</td>
																	<td colspan="7">   
																		<select class="form-control chosen-select" name="religion_cd">
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
																			<select class="form-control chosen-select" name="nationality">
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
																	<!-- <td ></td>
																	<td></td>
																	<td></td>
																	<td></td> -->
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
				           	</div>
						<!-- </session> -->
 				</div>
 				 <div>
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> 
 				</form>
 		 </div>
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script> 				
<script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('plugins/datepicker/bootstrap-datepicker.js')?>"></script>     

<script type="text/javascript">
    var config = {
      // '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    $(".chosen-select").chosen({ width: '100%'});
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    </script>

<script type="text/javascript">
 $(document).ready (function() { 

 	$("#frmCfBusiness").validate({
            rules: {
                ic_no: {
                    required: true//,
                    // maxlength: 20,
                    
                },
                name:{
                    required:true
                },
                address1:{
                    required:true
                },
                hand_phone:{
                    required:true
                },
                mail_addr:{
                	required:true
                }

            },
            messages: {
                // content: {
                //     cek_data: "One of this Field can't be blank"
                // },
                // youtubelink: {
                //     cek_data: "One of this Field can't be blank",
                //     cek_youtube: "Invalid Youtube Link"
                // },
                // picture: {
                //     cek_data: "One of this Field can't be blank"
                // }
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents(".col-xs-5").addClass("has-feedback");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!element.next("span")[0]) {
                    $("<span class='glyphicon glyphicon-remove form-control-feedback' style = 'left: 95%' ></span>").insertAfter(element);
                }
            },
            success: function (label, element) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!$(element).next("span")[0]) {
                    $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 95%'></span>").insertAfter($(element));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove");
            }
        });
 	
 	$('#date_of_birth').datepicker({
    format: 'dd/mm/yyyy',
      autoclose: true
    });

    if (document.getElementById('C').checked) { 
		 $("#panel_2").hide();		
    } else {
		 $("#panel_2").show();
	}
				        					    
	$('input[type="radio"]').on('click change',function(e){
		if (document.getElementById('C').checked) { 
			$("#panel_2").hide();
		} else { 
				$("#panel_2").show();			
		}
	});

	$('#btnSave').click(function(){
	if($('#frmEditor').valid()){


	}
	});

});
</script> 

 		 

 	