<div class="content-wrapper">
	<div class="row border-bottom white-bg dashboard-header"> 
	  <div id="loader" class="loader" hidden="true"></div> 
	    <div class="form-group">
	      <div class="judulprojek">            
							Profile
	      </div>

         <!-- <div class="tittle-top pull-left">            
              Profile
        </div> -->
	      <div class="tittle-top pull-right">
	      					Change Password
	      </div>
	    </div>        
	  </div>
	<!-- <div class="wrapper wrapper-content" >
		<div class="row">
			<div class="col-xs-12">
				<form action="" method="post" name="change_form" id="change_form">
					<div class="form-group has-feedback">                          
                        <input type="text" class="form-control" id="username" name="username" readonly="readonly"/>  
                         <span class="glyphicon glyphicon-lock form-control-feedback"></span>                           
                    </div>
					
					<div class="form-group has-feedback">
						<input type="password" id="newpassword" name="newpassword" class="form-control" placeholder="New Password" />
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>

					<div class="form-group has-feedback">
						<input type="password" id="confpassword" name="confpassword" class="form-control" placeholder="Confirm Password" />
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>         
					<hr>
					<button class="btn btn-info" type="button" name="btnSave" id="btnSave">
						<span class = "glyphicon glyphicon-user"></span>
						Save
					</button>
				</form>
			</div>
		</div>
	</div>
</div> -->
<div class="wrapper wrapper-content"  style="width: 800px;margin: 0 auto;">
          <div class="row">
            <div class="col-xs-12">
              <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
                <div class="ibox-content" > 
                <br>          
                  <div class="form-group">
                    <label class="col-sm-4 ">E-mail <FONT COLOR="RED">*</FONT></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="txtemail" id="txtemail" placeholder="Email" value="<?php echo $email;?>" disabled="true">
                    </div>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-4 ">Password <FONT COLOR="RED">*</FONT></label>                
                    <div class="col-sm-5">
                      <input type="password" class="form-control" name="txtpassword" id="txtpassword" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group" >
                    <label class="col-sm-4 ">Confirm Password <FONT COLOR="RED">*</FONT></label>                
                    <div class="col-sm-5">
                      <input type="password" class="form-control" name="txtconfpassword" id="txtconfpassword" placeholder="Confirm Password">
                    </div>
                  </div><br>
                  <div class="form-group" id="divCaptLogin" name="divCaptLogin"  >
                  <div class="col-sm-12">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4"><?php if(!empty($cp['image'])){ echo $cp['image'];}?> 
                      <button type="button" class="btn btn-success pull-right" onclick="reload_captcha();" style="margin-top:0px; margin-right: 10px;">
                        <i class="glyphicon glyphicon-refresh"></i>
                      </button>
                    </div>
                    
                  </div>
               
                     <div class="form-group" >
                    <div class="col-sm-12">
                    <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                        </br>
                      <input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter text above" value="<?php if(!empty($cp['userCaptcha'])){ echo $cp['userCaptcha'];} ?>"/>
                    </div>
                    </div>
                  </div>
                     </div>
                 
                      </div>
                      <br>
                      <div class="box-footer pull-left">
                        <input type="button" name="submit" id="btnSave" value="Submit" class="btn btn-primary">
                
                      </div>
                    </form>
                  </div>            
                </div>
              </div>     
            </div>
</div>
 <script type="text/javascript">

            
    var ids;
    var descss;


          function reload_captcha()
            {             
              $("#divCaptLogin").load('<?=base_url("Change/load_captcha")?>' + '#divCaptLogin');
            }

$(document).ready(function(){


    $.validator.addMethod("confirmpass", function (value, element) {
                var isSuccess = false;
                var newpassword = $('#txtpassword').val();
                var confpassword = $('#txtconfpassword').val();

                if(newpassword == confpassword){
                   isSuccess=true;
                }
                
                return isSuccess;

              });


         $("#form_nup").validate({
            ignore:"",
            rules: {
              txtpassword: { required: true,
                maxlength:60
              },
              
              txtconfpassword:{
                required: true,
                confirmpass:true
              },
              txtemail:{
                required: true,
                email:true,
                maxlength:60
              },
              userCaptcha:{
              	required: true
              }

            },
            messages: {
                  txtconfpassword: {confirmpass: "Password is not valid"}
                },
            errorPlacement: function(error, element)
            {

              if (element.hasClass('select2_demo_2')){
                  error.insertAfter(element.parent());
                  error.insertAfter(element.next('span'));
              // } else if (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
              //     error.insertAfter(element.next('span'));
              } else {
                  error.insertAfter(element);
              } //CSS NYA ADA DI ATAS .HAS-ERROR

            }
        });

    $('#btnSave').click(function(){

      if($('#form_nup').valid()){
     
        // document.getElementById('loader').hidden=false;
        // var response = '<?php echo strtoupper($cp['word'])?>';
        var captcha = $('#userCaptcha').val();
        var email = $('#txtemail').val();
        var res = captcha.toUpperCase();

        // console.log(response);
        // console.log(res);
        // if(response != res )
        // {
        //     swal('Warning','Captcha is invalid','error');
        //     location.reload();
        // } else {
          // var nup_id = $('#modal').data('nup_id');
          var datafrm = $('#form_nup').serializeArray();
          datafrm.push({name:"email",value:email});
          	// console.log(datafrm);
          	// return;
          // alert('dor');
            $.ajax({
              url : "<?php echo base_url('c_profile/UpdatePasswordApi');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(event, data){
                  // document.getElementById('loader').hidden=true;

                  if(event.Status=='OK'){
                    swal({
                      title: "Information",
                      animation: false,
                      type:"success",
                      text: event.Pesan,
                      confirmButtonText: "OK"
                    },function(){
                        // window.location.href="<?=base_url('userstaff/logout')?>";
                    });
                    
      
                  } else {
                    swal({
                      title: "Error",
                      animation: false,
                      type:"error",
                      text: event.Pesan,
                      confirmButtonText: "OK"
                    },function(){
                    	location.reload();
                    });
                    
                  }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                  document.getElementById('loader').hidden=true;
    
                  swal({
                      title: "Information",
                      animation: false,
                      type:"error",
                      text: textStatus+' Save : '+errorThrown,
                      confirmButtonText: "OK"
                    });
                }
            });                
         //}//captcha valid
      }//form valid
    });
  });



$('#btnback').click(function(){

     window.location.href='<?php base_url('demo')?>';
  
});
</script>