<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet">
<link href="<?=base_url('app-assets/vendors/css/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<style>
	input[type="file"] {
    display: none;
    position: relative;
    }

	.custom-file-upload {
	    border: 1px solid #ccc;
	    text-align: center;
	    cursor: pointer;
	    width: 100px;
	    height: 100px;
	    display: flex;
	  	align-items: center;
	  	justify-content: center;
	  	border-radius: 15px;
	  	position: relative;
	}

	.img-responsive{
		margin: 0 auto;
		position: absolute;
		object-fit: contain;
		background-size: contain;
		width: 100px;
		height: 100px;
		top: 0;
		left: 0;
	}
	.icon-img{
		    display: inline-block;
		    position: absolute;
		    right: 19px;
		    bottom: 10px;
		    padding-top: 12px;
		    text-align: right;
	}
	.icon-mgr{
		    width: 32px;
		    height: 32px;
		    padding: 8px;
		    border-radius: 32px;
		    opacity: 1;
		    display: inline-block;
		    -webkit-transition: background-color .5s ease;
		    transition: background-color .5s ease;
		    cursor: pointer;
	}
/*	.product-unit{
			cursor: pointer;
			display: inline-block;
			min-width: 5rem;
			box-sizing: border-box;
			padding: 0 .75rem;
			height: 2.125rem;
			line-height: 1;
			margin: 0 8px 8px 0;
			text-align: center;
			border-radius: 10px;
			border: 1px solid;
			background-color: #fff;
			outline: 0;
	}*/
/*	.product-unit{
		width: 20px;
		height: 20px;
	}*/
	.product-unit-active{
		color: #6967ce;
		border-color: #6967ce;

	}

</style>

<div class="app-content content">
	<div class="content-wrapper">
    	<div class="content-wrapper-before"></div>
    	<div class="content-header row">
	      	<div class="content-header-left col-md-4 col-12 mb-2">
		        <br><br>
		        <h3 class="content-header-title"><?php echo $ProjectDescs ?></h3>
		    </div>
	    </div>
	</div>
    <div class="content-body"><!-- Basic form layout section start -->
		<section id="horizontal-form-layouts">
			<div class="row justify-content-md-center">
				<div class=" col-xl-10 col-lg-10 col-md-12">
			        <div class="card">
			            <div class="card-header">
			                <h4 class="card-title" id="horz-layout-card-center"> </h4>
			                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
		        	
			            </div>
			            <div class="card-content collpase show">
			                <div class="card-body" id="bodyform">
								<form class="form form-horizontal" id="form_nup" method="post" action="" enctype="multipart/form-data">
									<div class="form-body">
			                			<div class="form-group row">
			                            	<label class="col-md-3 label-control">NUP Type<FONT COLOR="RED">*</FONT></label>
			                            	<div class="col-md-7">
			                            		<select name="nuptype" id="nuptype" class="select2 form-control" data-placeholder="Choose NUP Type..">
			                            			<option></option>
			                            			<?php echo $combotype?>
			                            		</select>
			                            		<input type="hidden" name="rowid" id="rowid">
			                            	</div>
				                        </div>

			                			<div class="form-group row">
			                            	<label class="col-md-3 label-control" for="eventRegInput2">Description</label>
			                            	<div class="col-md-7">
			                            		<input type="text" id="descs" class="form-control" placeholder="NUP Description" name="descs">
			                            	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Start Date</label>
						                        	<div class="col-md-3">
						                        		<div class="input-group"> 
								                            <div class="input-group-prepend">
								                                <span class="input-group-text"><i class="ft-calendar"></i></span>
								                            </div>         
								                            <input id="start" name="start" class="form-control" type="text">
								                        </div>
						                        	</div>

						                        	<label class="col-md-1 label-control">End Date</label>
						                        	<div class="col-md-3">
						                        		<div class="input-group"> 
								                            <div class="input-group-prepend">
								                                <span class="input-group-text"><i class="ft-calendar"></i></span>
								                            </div>         
								                            <input id="end" name="end" class="form-control" type="text">
								                        </div>
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

				                        <div class="form-group row">
					                        	<div class="col-md-12">
					                        		<div class="form-group row">
						                        	<label class="col-md-3 label-control">Expired Minute</label>
						                        	<div class="col-md-3">
						                        		<input type="number" max="60" class="form-control" name="expired" id="expired" value="0">
						                        	</div>

						                        	<label class="col-md-1 label-control">Refund Type</label>
						                        	<label class="label-control">&nbsp;</label>
						                        	<div class="col-md-4">
						                        		<div class="i-checks">
					                                          <label  id="radioR"> <input type="radio" name="refund_type" id="ref" value="Y"> <i></i> Refund </label> &emsp;
					                                          <label id="radioC"> <input type="radio" name="refund_type" id="nonref" value="N"> <i></i> Non-Refund </label>
					                                            &emsp;
					                                        </div>
						                        		<!-- <input class="form-check-input" type="checkbox" name="exampleRadios" id="refund" value="R">
														  <label class="form-check-label">
														    Refund / Non-refund
														  </label><br> -->
						                        	</div>
						                        </div>
				                        	</div>
				                        </div>

			                			<div class="form-group row">
			                            	<label class="col-md-3 label-control" for="eventRegInput4">NUP Amount</label>
			                            	<div class="col-md-7">
			                            		<input type="text" id="nupamt" class="form-control" placeholder="NUP Amount" readonly>
			                            		<input type="hidden" id="nup_amt" class="form-control" placeholder="" name="nup_amt">
			                            	</div>
				                        </div>

				                         <div class="form-group row">
				                         	<label class="col-md-3 label-control">Unit Pictures<FONT COLOR="RED">*</FONT></label>
				                         	<div class="row col-9" id="uploadgambar">
							            	<div class="col-2">
									            <div class="form-group">
									            	<label for="userfile1" class="custom-file-upload">
									            		<!-- <i class="ft-plus"></i> -->
									            		 <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox1"> 
													</label>
													<input type="file" name="userfile" id="userfile1" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(1,this)"/>
											
									            	<p style="margin-left: 25px">Picture 1</p>
									            	<div class="i-checks" style="margin-left:38px;">
			                                       		<input type="radio" name="main_pic" id="pic1" value="1" checked> 
			                                       		<input type="hidden" name="query1" id="query1">
			                                        </div>
			                                        <div class="col-2" style="margin-top: 15px; margin-left: 8px;">
			                                       		<button class="btn btn-sm btn-danger" type="button" onclick="deleteImage('1')"><span class="la la-trash" ></span></button>
			                                        </div>
									            </div>
								        	</div>

								        	<div class="col-2">
									            <div class="form-group">
									            	<label for="userfile2" class="custom-file-upload">
									            		<!-- <i class="ft-plus"></i> -->
									            		 <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox2"> 
													</label>
													<input type="file" name="userfile" id="userfile2" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(2,this)"/>
											
									            	<p style="margin-left: 25px">Picture 2</p>
									            	<div class="i-checks" style="margin-left:38px;">
			                                       		<input type="radio" name="main_pic" id="pic2" value="2" > 
			                                       		<input type="hidden" name="query2" id="query2">
			                                        </div>
			                                        <div class="col-2" style="margin-top: 15px; margin-left: 8px;">
			                                       		<button class="btn btn-sm btn-danger" onclick="deleteImage('2')" type="button"><span class="la la-trash" ></span></button>
			                                        </div>
									            </div>
								        	</div>

								        	<div class="col-2">
									            <div class="form-group">
									            	<label for="userfile3" class="custom-file-upload">
									            		<!-- <i class="ft-plus"></i> -->
									            		 <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox3"> 
													</label>
													<input type="file" name="userfile" id="userfile3" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(3,this)"/>
											
									            	<p style="margin-left: 25px">Picture 3</p>
									            	<div class="i-checks" style="margin-left:38px;">
			                                       		<input type="radio" name="main_pic" id="pic3" value="3" > 
			                                       		<input type="hidden" name="query3" id="query3">
			                                        </div>
			                                        <div class="col-2" style="margin-top: 15px; margin-left: 8px;">
			                                       		<button class="btn btn-sm btn-danger" onclick="deleteImage('3')" type="button"><span class="la la-trash"></span></button>
			                                        </div>
									            </div>
								        	</div>

								        	<div class="col-2">
									            <div class="form-group">
									            	<label for="userfile4" class="custom-file-upload">
									            		<!-- <i class="ft-plus"></i> -->
									            		 <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox4"> 
													</label>
													<input type="file" name="userfile" id="userfile4" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(4,this)"/>
											
									            	<p style="margin-left: 25px">Picture 4</p>
									            	<div class="i-checks" style="margin-left:38px;">
			                                       		<input type="radio" name="main_pic" id="pic4" value="4" > 
			                                       		<input type="hidden" name="query4" id="query4">
			                                        </div>
			                                        <div class="col-2" style="margin-top: 15px; margin-left: 8px;">
			                                       		<button class="btn btn-sm btn-danger" type="button" onclick="deleteImage('4')"><span class="la la-trash" ></span></button>
			                                        </div>
									            </div>
								        	</div>
								        	<div class="col-2">
									            <div class="form-group">
									            	<label for="userfile5" class="custom-file-upload">
									            		<!-- <i class="ft-plus"></i> -->
									            		 <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox5"> 
													</label>
													<input type="file" name="userfile" id="userfile5" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(5,this)"/>
											
									            	<p style="margin-left: 25px">Picture 5</p>
									            	<div class="i-checks" style="margin-left:38px;">
			                                       		<input type="radio" name="main_pic" id="pic5" value="5" > 
			                                       		<input type="hidden" name="query5" id="query5">
			                                        </div>
			                                        <div class="col-2" style="margin-top: 15px; margin-left: 8px;">
			                                       		<button type="button" class="btn btn-sm btn-danger" onclick="deleteImage('5')"><span class="la la-trash"></span></button>
			                                        </div>
									            </div>
								        	</div>
								        </div>
							        	</div>

							        	<div class="form-group row">
				                         	<label class="col-md-3 label-control">Badge<FONT COLOR="RED">*</FONT></label>
				                         	<div class="row col-9" id="badgedescs">
								        	<div class="col-7">
									            <div class="form-group">
													<div class="i-checks">
														<div class="row" style="padding-left: 10px;">
															
														<div style="padding-right: 20px;" >
															<input type="radio" name="btn_badge" id="btn-badge-one" class="btn btn-default mr-1 mb-1 tablink" value="G" style="padding-right: 10px">
															GOLD
														</div>
														<div style="padding-right: 20px;">
															<input type="radio" name="btn_badge" id="btn-badge-two" class="btn btn-default mr-1 mb-1 tablink" value="P">
															PLATINUM
														</div>
															<!-- </button> -->
														<div style="padding-right: 20px;">
															<input type="radio" name="btn_badge" id="btn-badge-three" class="btn btn-default mr-1 mb-1 tablink" value="S">
															SILVER
														</div>
														</div>
															<!-- </button> -->
															
															<!-- </button> -->
													</div>
									            </div>
									        </div>
								        	</div>
								        </div>
								    

							        	<div class="form-group row">
			                            	<label class="col-md-3 label-control">Info NUP</label>
			                            	<div class="col-md-7">
			                            		<textarea class="form-control" name="info_nup" id="info_nup" placeholder="Place content newsfeed here" cols="30" rows="15" class="ckeditor"></textarea>
			                            	</div>
				                        </div>
				                        <div class="form-group row">
			                            	<label class="col-md-3 label-control">Terms Description</label>
			                            	<div class="col-md-7">
			                            		<textarea class="form-control" name="terms_descs" id="terms_descs" placeholder="Place content newsfeed here"  cols="30" rows="15" class="ckeditor"></textarea>
			                            	</div>
				                        </div>
									<div class="form-actions center">
			                            <button type="button" name="btnCancel" id="btnCancel" class="btn btn-danger mr-1">
			                            	<i class="ft-x"></i> Cancel
			                            </button>
			                            <button type="button" name="btnSave" id="btnSave" class="btn btn-primary">
			                                <i class="la la-check-square-o"></i> Save
			                            </button>
			                        </div>
								</form>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
		</section>
<!-- // Basic form layout section end -->
        </div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('app-assets/vendors/js/editors/ckeditor/ckeditor.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
 <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
 <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<script>
	$(document).ready(function(){

		// var btn_badge = '';
		// if($('#btn_badge') ==  $('#btn-badge-one') || $('#btn-badge-two') || $('#btn-badge-three')  ){

		// 	$('#btn-badge-one').on('click',function(){
		// 	btn_badge = $(this).val();
		// 	alert (btn_badge);
		// 	//  alert($(this).val());
		// 	});
		// 	$('#btn-badge-two').on('click',function(){
		// 		btn_badge = $(this).val();
		// 		alert (btn_badge);
		// 	//  alert($(this).val());
		// 	});
		// 	$('#btn-badge-three').on('click',function(){
		// 		btn_badge = $(this).val();
		// 		alert (btn_badge);
		// 	//  alert($(this).val());
		// 	});
			
		// }
		
		
		var editor = CKEDITOR.instances['ckeditor'];
	    if (editor) { editor.destroy(true); }
	    var editor_info = CKEDITOR.replace('info_nup', {
	      height: '350px',
	      // extraPlugins: 'forms',
	        removeButtons:'Save,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField'
	    });
	    var editor1 = CKEDITOR.instances['ckeditor'];
	    if (editor1) { editor1.destroy(true); }
	    var editor_term = CKEDITOR.replace('terms_descs', {
	      height: '350px',
	      // extraPlugins: 'forms',
	        removeButtons:'Save,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField'
	    });
		loaddata();
	    $(".select2").select2();
	    $('.i-checks').iCheck({
            radioClass: 'iradio_square-purple',
            checkboxClass: 'icheckbox_flat-purple'
        });
        $('#btnCancel').click(function(){
   
            window.location.href= '<?php echo base_url("c_nup_online/index")?>';

    	});

		// var btn_badge = '';
		// $('#btn-badge-one').on('click',function(){
		// 	$('btn_badge') = $(this).val();
        // //  alert($(this).val());
    	// });
		// $('#btn-badge-two').on('click',function(){
		// 	btn_badge = $(this).val();
        // //  alert($(this).val());
    	// });
		// $('#btn-badge-three').on('click',function(){
		// 	btn_badge = $(this).val();
        // //  alert($(this).val());
    	// });

	    $('#start').datepicker({
	    	format: 'dd/mm/yyyy',
	        autoclose: true,
	        keyboardNavigation: false,
	        forceParse: false
	        // calendarWeeks: true
	    });
	    $('#start').attr("autocomplete", "off");  
	    $('#end').datepicker({
	    	format: 'dd/mm/yyyy',
	      	autoclose: true,
	        keyboardNavigation: false,
	        forceParse: false,
	        // calendarWeeks: true
	    });

	    $('#end').attr("autocomplete", "off");  
	    

		$('.tablink').click(function(e) {
		  $('.tablink').removeClass('product-unit-active');
		  $(this).addClass('product-unit-active');
		});

		


	    $('#btnSave').click(function(){            

            block('.content-body',true);

      		// if($('#form_nup').valid()){
      			var nuptype = '<?php echo $nup_type ?>';
      			var terms_descs = CKEDITOR.instances.terms_descs.getData();
		    	var nup_info = CKEDITOR.instances.info_nup.getData();
		        var datafrm = $('#form_nup').serializeArray();
		        datafrm.push({name:"nup_info",value:nup_info},{name:"terms_descs",value:terms_descs},{name:"nuptype",value:nuptype});
		       	 console.log(datafrm);
		       	// return;
		            $.ajax({
		                url : "<?php echo base_url('c_nup_online/save');?>",
		                type:"POST",
		                data: datafrm,
		                dataType:"json",
		                success:function(data, status){
		                  console.log(data);console.log(status);
		                if(data.status =='OK'){
		                  
		                      swal({
		                        title: "Information",
		                        text: data.pesan,
		                        type: "success",
		                        confirmButtonText: "OK"
		                      }).then(function(){
		                        window.location.href="<?php echo base_url('c_nup_online/index');?>";  
		                      })
		               

		                    } else {
		                  
		                      swal({
		                        title: "Error",
		                        text: data.pesan,
		                        type: "error",
		                        confirmButtonText: "OK"
		                        });
		                      block('.content-body',false);
		                    }
		                 
		                },                    
		                error: function(jqXHR, textStatus, errorThrown){
		                  block('.content-body',false);
		                    swal(textStatus+' Save : '+errorThrown);
		                }
		            });

		        // }
	    });
	});

	function loaddata(){
	    	// alert($(this).find(':selected').val());
	    	block('.content-body',true);
	    	var nuptype = '<?php echo $nup_type ?>';
	
		
			$('#nuptype').attr("disabled",true);

	

             $.getJSON("<?php echo base_url('c_nup_online/getbyNUPtype');?>" + "/" + nuptype, function (data) {
              	console.log(data);
              	  
             	  
		          $('#nup_amt').val(data.data1[0].nup_amt);
		          $('#nupamt').val(formatNumber(data.data1[0].nup_amt));
		          if(data.data1_adm[0].refund_type == 'Y'){
		          	$('#ref').iCheck('check');
		          }else{
		          	$('#nonref').iCheck('check');
		          }

		          if(data.data1_adm[0].badges == 'G'){
		          	$('#btn-badge-one').iCheck('check');
		          }else if (data.data1_adm[0].badges == 'P') {
		          	$('#btn-badge-two').iCheck('check');
		          }else{
		          	$('#btn-badge-three').iCheck('check');
		          }

		          if(data.data1_adm.length<1){
		          	// alert('11')
		          	$('#rowid').val(0);
		          	$('#expired').val(0);
		          	$('#start').val('');
		          	$('#end').val('');
		          	$('#descs').val(data.data1[0].descs);

		          
		          }else{
		          	// alert('12')
		          	$('#descs').val(data.data1_adm[0].descs);
		          	$('#rowid').val(data.data1_adm[0].rowID);
		         
		          	var exp = data.data1_adm[0].expired_minute;
		          	var expired='';
		          	if(exp==''||exp==null){
		          		expired = 0;
		          	} else{
		          		expired = parseInt(exp);
		          	}
		          	$('#expired').val(expired);
		          	$('#start').val(FormatDateNew(data.data1_adm[0].start_date));
		          	$('#end').val(FormatDateNew(data.data1_adm[0].end_date));
		          	// console.log(CKEDITOR.instances['info_nup']);
		          	CKEDITOR.instances['info_nup'].on('instanceReady',function(){
		          		CKEDITOR.instances['info_nup'].setData(data.data1_adm[0].info_nup);
		          	})
		          	CKEDITOR.instances['terms_descs'].on('instanceReady',function(){
		          		CKEDITOR.instances['terms_descs'].setData(data.data1_adm[0].terms_descs);
		          	})
		          }
		          var pic ;
		          // var icon;
		          if(data.data2.length>0){
		          	$.each(data.data2, function( index, val ) {
		  				// console.log(val); 
		  				
		  				if(val.gallery_url==''||val.gallery_url==null){
		  					pic ='<?php echo base_url('img/PlProject/no_image.png')?>';
		  				}else{
		  					pic = val.gallery_url;
		  					// icon = '<span><i class='ft-plus'></i></span>';
		  				}
					    $('#picturebox'+val.line_no).attr('src',pic);
					    if(val.main_image==''||val.main_image==null){
						    $('#pic1').iCheck('check');
						}else{
							if(val.main_image=='Y'){
						    	$('#pic'+val.line_no).iCheck('check');
						    }
						}

					});
		          }else{
		          	for (var i = 1; i <= 5; i++) {
		          		pic ='<?php echo base_url('img/PlProject/no_image.png')?>';
		          		$('#picturebox'+i).attr('src',pic);
		          	}
		          	$('#pic1').iCheck('check');
		          }

               		block('.content-body',false);
              });
	    }
	function block(boelan,div){
        var block_ele = $(div)
        if (boelan==true) {
            $(block_ele).block({
                message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                fadeIn: 1000,
                fadeOut: 1000,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    backgroundColor: '#333',
                    marginLeft : 'auto'
                }
            });
        }
        else{
            $(block_ele).unblock()
        }
    }
	function saveImage(seq, el) {

        block(true,'#uploadgambar');
        var nuptype = $("#nuptype").find(':selected').val();
        if(nuptype==''||nuptype==null){
        	swal('Information','Please choose NUP type first!','warning');
        	block(false,'#uploadgambar');
        	return;

        }
        $.ajax({
                url : "<?php echo base_url('c_nup_online/savePic');?>",
                type:"POST",
                data: function () {
                    var data = new FormData();
                    data.append("nuptype", nuptype);
                    data.append("seqno", seq);
                    data.append("userfile", $("#userfile"+seq).get(0).files[0]);
                    return data;
                }(),
                processData: false,
                contentType: false,
                dataType:"json",
                success:function(data, status){
                if(data.status == "OK"){
           
                      console.log(data.url)
                      $('#picturebox'+seq).attr('src', data.url);
                      $('#query'+seq).val(data.query);
                      block(false,'#uploadgambar');
                    } else {
                      
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      block(false,'#uploadgambar');
                      // document.getElementById('loader').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                     block(false,'#uploadgambar');
                    swal(textStatus+' Save : '+errorThrown);
                }
            });
    }

    function deleteImage(seq, el) {

    	var imagess = "<?php echo base_url('img/PlProject/no_image.png') ?>";
        block(true,'#uploadgambar');
        var nuptype = $("#nuptype").find(':selected').val();
        if(nuptype==''||nuptype==null){
        	swal('Information','Please choose NUP type first!','warning');
        	block(false,'#uploadgambar');
        	return;

        }
        $.ajax({
                url : "<?php echo base_url('c_nup_online/deletePic');?>",
                type:"POST",
                data: function () {
                    var data = new FormData();
                    data.append("nuptype", nuptype);
                    data.append("seqno", seq);
                    return data;
                }(),
                processData: false,
                contentType: false,
                dataType:"json",
                success:function(data, status){
                if(data.status == "OK"){
           
                      console.log(data.url)
                      $('#picturebox'+seq).attr('src', imagess);
                      block(false,'#uploadgambar');
                    } else {
                      
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      block(false,'#uploadgambar');
                      // document.getElementById('loader').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                     block(false,'#uploadgambar');
                    swal(textStatus+' Save : '+errorThrown);
                }
            });
    }
    



</script>