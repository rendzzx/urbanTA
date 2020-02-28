
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<style type="text/css">
    img{
        float: left
    }

    .custom-file-label::after{
       padding: .75rem .5rem !important;
       height: auto;
    }

    .custom-file-label{
         padding-left: 10px;
    padding-right: 60px;
    white-space: normal;
    height: auto;
    }
</style>
<form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
	<div id="panel3" class="row" width="100%">
    	<div class="col-md-12" >
            <div class="row">
                <div class="col-md-6">
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group">
                                <label for="coname">Picture Profile</label><br>
                                <img id="picturebox" class="img-thumbnail img-fluid w-50" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1" itemprop="thumbnail" alt="Image description">
                                    <span class="btn btn-sm btn-primary fileinput-button" style="margin-top: 10px!important; margin-left: 10px !important;">
                                    <span>Select Picture...</span>
                                    <input type="file" id="userfile" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(this)"/>
                                    </span>
                                    <p>(* Only Jpg, Png allowed. Max 300mb)</p>
                                <input type="hidden" name="image" id="image" value="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1">
                                <input type="hidden" name="labelimage" id="labelimage">
                            </div>


                            <!-- <div class="form-group">
                                <img id="picturebox" class="img-thumbnail img-fluid w-50" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1" itemprop="thumbnail" alt="Image description">
                                <fieldset class="col-sm-6" style="padding-right: 0px">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="userfile" name="userfile" accept="image/*"><br>
                                        <input type="hidden" id="image" name="image"  readonly="readonly" />
                                        <label id="labelimage" class="custom-file-label" for="userfile">Choose Picture</label>
                                    </div>  
                                </fieldset>
                            <br>      
                            </div> -->
                        </div>
                        

                    </div>
                    

                    <hr>

                    <div class="col-md-12">
                        <div class="nav-vertical p-2" style="padding-left: 0px !important;padding-right: 0px !important;">
                            <ul class="nav nav-tabs nav-left" style="width: 100% !important; ">
                                <li class="nav-item">
                                <a class="nav-link active" id="baseVerticalLeft2-tab1" data-toggle="tab" aria-controls="tabVerticalLeft21" href="#tabVerticalLeft21" aria-expanded="true" style="min-width: 100% !important;"><i class="ft-box"></i>&nbsp;&nbsp;&nbsp; Basic Information</a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link" id="baseVerticalLeft2-tab2" data-toggle="tab" aria-controls="tabVerticalLeft22" href="#tabVerticalLeft22" aria-expanded="false" style="min-width: 100% !important;"><i class="ft-user"></i>&nbsp;&nbsp;&nbsp; Change Password</a>
                                </li>
                                
                            </ul>
                            
                        </div>
                    </div>


                </div>


                <div class="col-md-6">
                    <div class="tab-content px-1">
                            <div role="tabpanel" class="tab-pane active" id="tabVerticalLeft21" aria-expanded="true" aria-labelledby="baseVerticalLeft2-tab1">

                                <h4> Basic Information</h4>

                                <div class="form-group">
                                  <label for="OfficeName" class="col-md-8 control-label">Name <FONT COLOR="RED">*</FONT></label>
                                  <div class="col-md-12">                         
                                    <input type="text" class="form-control" id="Name" name="Name" /> 
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="Email" class="col-md-8 control-label">Email<FONT COLOR="RED">*</FONT></label>
                                  <div class="col-md-12">                         
                                    <input type="text" class="form-control" id="Email" name="Email" /> 
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label for="TelpNo" class="col-md-8 control-label">Telp No.<FONT COLOR="RED">*</FONT></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="Handphone" name="Handphone" />
                                        Format: 6221995500 | 021995500
                                    </div>                          
                                </div>
                                <div class="form-group">
                                    <label for="Wa" class="col-md-8 control-label">Whatsapp<FONT COLOR="RED">*</FONT></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="Wa" name="Wa" />
                                        Format: 6221995500 | 021995500
                                    </div>                          
                                </div>

                                <div class="modal-footer">
                                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                                </div>
                            </div>
                    </form>
                            <div class="tab-pane" id="tabVerticalLeft22" aria-labelledby="baseVerticalLeft2-tab2" style="height: 490px !important">
                                <h4>Change Password</h4>
                                
                            <form id ="frmchangepass" class="form-horizontal">
                                <div class="form-group">
                                    <label for="password" class="col-md-8 control-label">New Password<FONT COLOR="RED">*</FONT></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="password1" name="password1" />
                                        
                                    </div>                          
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-8 control-label">Confirm Password<FONT COLOR="RED">*</FONT></label>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="password2" name="password2" />
                                        
                                    </div>                          
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="btnSavepass" class="btn btn-primary">Change Password</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                                </div>
                            </div>
                        </form>
                        </div>

                    <!-- <div class="form-group">
                        <label for="TelpNo" class="col-md-8 control-label">Whatsapp<FONT COLOR="RED">*</FONT></label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="Handphone" name="Handphone" />
                            Format: 6221995500 | 021995500
                        </div>                          
                    </div> -->
                </div>
            </div>
            
            
        </div>
       
            

        

    	
    	
        
        
	</div>
	


<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/vendors/js/forms/toggle/switchery.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/toggle/switchery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/switch.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<script type="text/javascript">
var isFile=false;
var jqXHRData;
function block(boelan){
    var block_ele = $('#frmdata')
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


function loaddata(){
	var Id = $('#modal').data('Id');
	if (Id.length > 0) {
		$.getJSON("<?php echo base_url('c_profile/getByName');?>" + "/" + Id, function (data) {

			$("#Name").val(data[0].name);
			$("#Handphone").val(data[0].Handphone);
			$("#Email").val(data[0].email);
            $("#Wa").val(data[0].wa_no);
            // $("#password").val(data[0].password);
			$('#image').val(data[0].pict);

            var url = data[0].pict;
            
            if(url == "" || url == null)
            {   

            }
            else{
                var filename = url.substring(url.lastIndexOf('/')+1);
                $('#labelimage').text(filename);
                $('#picturebox').attr("src",url);
            }

			
			
		});
	}
	
}

$(document).ready(function(){
loaddata();

$("#userfile").on('change', function () {
        $("#image").val(this.files[0].name);
        $("#labelimage").text(this.files[0].name);
        readURL(this);


    });

 $('#userfile').fileupload({
        url: "<?php echo base_url('c_profile/updateElse');?>",
        dataType: 'json',
        add: function (e, data) {
            jqXHRData = data
            isFile = true;                
        },
        done: function (event, response) {
            var res = response.result
            // console.log(res)
            if(res.status == 'OK'){
                block(false);
                swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: res.Pesan,
                    confirmButtonText: "OK"
                });
							$('#modal').modal('hide');
            }
            else{
                block(false);
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: res.Pesan,
                    confirmButtonText: "OK"
                });
            }
            // tbluser.ajax.reload(null,true); 

            },
            fail: function (event, response) {
                block(false);
                var error = response["_response"]["errorThrown"];
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: error,
                    confirmButtonText: "OK"
                });
            }
        });

});

$('#btnSave').click(function(){
	// if($('#frmEditor').valid()){
		var dataform = $('#frmEditor').serializeArray();
		dataform.push({name:"isFile",value:isFile})
		var obj = new Object();
        obj.isFile = isFile;
        if(isFile){
          if(jqXHRData){
            jqXHRData.formData = dataform;
            jqXHRData.submit();
            
          }
        }
        else{
			var site_url = "<?php echo base_url('c_profile/updateElse')?>";
			$.ajax({
				url: site_url,
				type: "POST",
				data: dataform,
				dataType: "json",
				success: function(data, status){
					console.log(data); console.log(status);
					if(status=='success'){
						swal({
							title: "Information",
							text: data.Pesan,
							type: "success",
							confirmButtonText: "OK"
						})
							$('#modal').modal('hide');

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
	// }
});

$('#btnSavepass').click(function(){
    // if($('#frmEditor').valid()){
        var dataform = $('#frmchangepass').serializeArray();
        var email = $('#Email').val();
        console.log(email)
        dataform.push({name:"email",value:email})
        
        
            var site_url = "<?php echo base_url('c_profile/changepass')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: dataform,
                dataType: "json",
                success: function(data, status){
                    console.log(data); console.log(status);
                    if(status=='success'){
                        swal({
                            title: "Information",
                            text: data.Pesan,
                            type: "success",
                            confirmButtonText: "OK"
                        })
                            $('#modal').modal('hide');

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
        
    // }
});


function readURL(input) {

    if (input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#picturebox').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);



    }
}




</script>