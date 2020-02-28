<!-- link -->
	<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
	<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
	<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<!-- end link -->

<!-- style -->
	<style type="text/css">
		.has-error .select2 {
		    border: 1px solid #a94442;
		    border-radius: 4px;
		}
		.has-error .checkbox-inline {
		    border: 1px solid #a94442;
		    border-radius: 4px;
		}
		.has-error .radio-inline {
		    border: 1px solid #a94442;
		    border-radius: 4px;
		}
		.dataTables_filter {
		  display: none; 
		}
	</style>
<!-- end style -->

<!-- form -->
	<form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">

		<div class="box-body">

		    <div class="form-group" class="col-sm-12 control-label">
			    <label for="project_no">Project No</label>
			    <div class="col-sm-12">
			        <select data-placeholder="Choose a Project..." class="select2 form-control" id="project_no" name="project_no">
			            <option value=""></option>
			            <?php echo $data_project ?>
			            <!-- <?php foreach ($data_project as $key) { ?>
			            	//<option value="<?php echo $key->project_no; ?>"><?php echo $key->descs ?></option>
			            <?php } ?> -->
			        </select>
			    </div>
			</div>

		    <!-- <div class="form-group">
		      <label for="project_descs" class="col-sm-12 control-label">Project Description</label>
		      <div class="col-sm-12">
		        <input type="text" placeholder="Description" class="form-control pull-right" id="project_descs" name="project_descs">  
		      </div>
		    </div> -->

		    <div class="form-group">
		        <label for="zone_cd" class="col-sm-12 control-label">Type</label>
		        <div class="col-sm-12">
		            <select data-placeholder="Choose Type..." class="select2 form-control" id="zone_cd" name="zone_cd">
		                <option value=""></option>
		                <!-- <?php echo $data_zone; ?> -->
		                <option value="C">By Zone</option>
		                <option value="L">By Area</option>
		            </select>
		        </div>
		    </div>

		    <div class="form-group">
		      <label for="rate" class="col-sm-12 control-label">Rate</label>
		      <div class="col-sm-12">
		        <input type="number" class="form-control pull-right" id="rate" name="rate" placeholder="Rate">  
		      </div>
		    </div>

		    <div class="form-group">
		      <label for="descs" class="col-sm-12 control-label">Description</label>
		      <div class="col-sm-12">
		        <input type="text" class="form-control pull-right" id="descs" name="descs" placeholder="Description">  
		      </div>
		    </div>
		</div>
	</form>
<!-- end form -->

<!-- script -->
	<script type="text/javascript">
	    $("#btnback").click(function(){
	      // alert('a');
	      location.href = "<?php echo base_url("c_setting_ot"); ?>";
	    })

	    loaddata();

	    $(document).ready(function () {
	      
		    $("#zone_cd").select2({
		         width:"100%"
		    });
		    $("#project_no").select2({
		         width:"100%"
		    });
		    $("#frmEditor").validate({
		        // ignore:"",
		        rules: {
		          project_no: {
		            required: true,
		          },
		        },
		        messages: {
		          
		        },
		        errorElement: "span",
		        highlight: function (element, errorClass, validClass) {
		          $(element).addClass(errorClass); //.removeClass(errorClass);
		          $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
		        },
		        unhighlight: function (element, errorClass, validClass) {
		          $(element).removeClass(errorClass); //.addClass(validClass);
		          $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
		        },
		        errorPlacement: function (error, element) {
			        if (element.parent('.input-group').length) {
			            error.insertAfter(element.parent());
			        } else if (element.hasClass('select2')){
			            error.insertAfter(element.next('span'));
			        } else {
			            error.insertAfter(element);
			        }
		        }
		    }); //end form editor

		    $('#savefrm').click(function(){
		        block(true);
		        var id      = $('#modal').data('rowID');
		        var cd 		= $('#modal').data('over_cd');
		        // console.log(category_cd);
		        
		        // var int = $('.pro:checked').length
		        var datafrm = $('#frmEditor').serializeArray();
		        datafrm.push(
		            {name:"id",value:id},
		            {name:"cd",value:cd}
		        )
		        $.ajax({
		            url : "<?php echo base_url('c_setting_ot/save_OTTDtl');?>",
		            type:"POST",
		            data:datafrm,
		            dataType:"json",
		            success:function(event, data){
			            if(event.Error==false){
			                block(false);
			                swal({
			                    title: "Information",
			                    animation: false,
			                    type:"success",
			                    text: event.Pesan,
			                    confirmButtonText: "OK"
			                });
			                $('#modal').modal('hide');
			                tblcategory.ajax.reload(null,true);
			            }
			            else {
			                block(false);
			                swal({
			                    title: "Error",
			                    animation: false,
			                    type:"error",
			                    text: event.Pesan + "status = false",
			                    confirmButtonText: "OK"
			                });
			                $('#modal').modal('hide');
			                tblcategory.ajax.reload(null,true);
			            }
		            },
		            error: function(jqXHR, textStatus, errorThrown){
			            block(false);
			            swal({
			                title: "Error",
			                animation: false,
			                type:"error",
			                text: textStatus+' Save : '+errorThrown,
			                confirmButtonText: "OK"
			            });
		            }
		        });
		    }) // end save form
	    }); //end documet ready

	    function loaddata(){
		    var rowID = $('#modal').data('rowID');
		    var over_cd = $('#modal').data('over_cd');
		    console.log(over_cd);
		    console.log(rowID);

		    if (rowID > 0) {
		        $.getJSON("<?php echo base_url('c_setting_ot/getOTTDtl');?>"+"/"+rowID, function (data) {
		          // console.log(data);
		          // $('#entity_cd').val(data[0].entity_cd);
		          // $('#project_no').val(data[0].project_no);
		          // $('#category_cd').val(data[0].category_cd);
		          $('#project_no').val(data[0].project_no).trigger("change");
		          // $('#project_descs').val(data[0].project_descs);
		          $('#zone_cd').val(data[0].zone_cd).trigger("change");
		          $('#rate').val(data[0].rate);
		          $('#descs').val(data[0].descs);
		        });
		    }
	    }

	    $('#modal').on('hidden.bs.modal', function (e) {
	      $(this).removeData();
	    });

	    function block(boelan){
	      var block_ele = $('#form_nup')
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
	</script>
<!-- end script -->