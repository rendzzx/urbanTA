<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
  <title>::Forgot Password</title>

  <!-- Bootstrap 3.3.6 -->

  
  <link href="<?=base_url('css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('font-awesome/css/font-awesome.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">  

  <link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/style.css')?>" rel="stylesheet">
  <script src="<?=base_url('js/ShowPCx.js')?>" type="text/javascript"></script>

  <script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
  <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
  <script src="<?=base_url('js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
  <script type="text/javascript" src="<?=base_url('js/plugins/sweetalert/sweetalert.min.js')?>"></script>


<style type="text/css">

a:hover {
    color: #dedcd0 !important;
}


input:-webkit-autofill, input:-webkit-autofill:focus, input:-webkit-autofill:hover, input:-webkit-autofill:active {
    -webkit-box-shadow: 0 0 0 30px white inset;
    /*-webkit-background-color:0 0 0 30px white inset;*/
    background-color: white inset !important;
    /*-webkit-text-fill-color: red !important;*/
}


</style>

<style id="antiClickjack" type="text/css">

body {
    overflow:hidden;
    display:none !important;
}

</style>

</head>

<body class="gray-bg-back" style="background: url('../img/back.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
<?php echo validation_errors(); ?>
<script type="text/javascript">
   if (self === top) { 
        var antiClickjack = document.getElementById("antiClickjack");
        antiClickjack.parentNode.removeChild(antiClickjack);
    } else {

        top.location = self.location;
    }
</script>
  <div class="middle-box text-center loginscreen animated fadeInDown">
      <div id="loader" class="loader" hidden="true"></div>
      <div style="text-align:left !important;" class="">
        <center>
          <img style="width: 200px; padding-bottom:15px" src="<?=base_url('img/logo_3.png')?>">
        </center>
        <center>
          <p style="color: white">
            <b>Reset Password</b><br>
         
          </p>
        </center>
        <form id="frm1" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
          <div class="form-group">                   
            <span style="position: relative;">
              <input type="password" class="form-control" id="newpass" name="newpass" placeholder="New Password" required="">
              <input class="form-control" id="newpass" style="display:none" autocomplete="off" type="text">
              <label for="showpasscheckbox-523" class="show-password" title="Show the password as plain text (not advisable in a public place)" style="display:block;position:static;">
              </label>
            </span>
          </div>    
          <div class="form-group">                   
            <span style="position: relative;">
              <input type="password" class="form-control" id="confpass" name="confpass" placeholder="Confirm Password" required="">
              <input class="form-control" id="confpass" style="display:none" autocomplete="off" type="text">
              <label for="showpasscheckbox-523" class="show-password" title="Show the password as plain text (not advisable in a public place)" style="display:block;position:static;">
              </label>
            </span>
          </div>
          <div class="form-group" id="divCaptLogin" name="divCaptLogin" alt=" " width="140" height="100" >
            <div><?php if(!empty($image)){ echo $image;}?> 
              <button type="button" class="btn btn-success pull-right" onclick="reload_captcha();" style="margin-top:0px; margin-right: 10px;">
                <i class="glyphicon glyphicon-refresh"></i>
              </button>
            </div>
            <br>

            <input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter text above" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/>

          </div> 
              <br>
        </form> 
        <div class="pull-right">
          <button type="button" id="submit" class="btn btn-success "> Save</button>
        </div>               
      </div>

    </div>
      
     
        

          <script>
            function reload_captcha()
            {             
              $("#divCaptLogin").load('<?=base_url("userStaff/load_captcha")?>' + '#divCaptLogin');
            }
            new ShowPCx(document.getElementById("newpass"));
            new ShowPCx(document.getElementById("confpass"));
            $(document).ready(function () {

              
              $('#frm1').validate({
                rules: {
                      
                  newpass:{
                    required: true,
                    minlength:5
                  },
                  confpass:{
                    required:true,
                    minlength:5
                  },
                  userCaptcha:{
                    required: true
                  }
                },
                
              errorElement: "em",
              errorPlacement: function(error, element){
                error.addClass("help-block");
                element.parents(".col-xs-5").addClass("has-feedback  text-red");
                if (element.prop("type") === "checkbox") {
                  error.insertAfter(element.parent("label"));
                } else {
                  error.insertAfter(element);
                }

      },
      success: function(label, element){
      },
      highlight: function(element, errorClass, validClass){
      },
      unhighlight: function(element, errorClass, validClass){
      }
    });

   $('#submit').click(function(){
      var newpass  = $('#newpass').val();
      var confpass  = $('#confpass').val();
      if(newpass != confpass){
        swal('Information', 'Password mismatch','error');
        return;
      }
      if($('#frm1').valid())
      { 
        var email = '<?php echo $email_user;?>';
        document.getElementById('loader').hidden=false;
    
        var dataform = $('#frm1').serializeArray();
        dataform.push({name:"txtUser", value:email});
        // console.log(dataform);return;
        var site_url = "<?php echo base_url('ResetPassword/SavePassword')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: dataform,
          dataType: "json",
          success: function(data, status){

           document.getElementById('loader').hidden=true; 
        

            if(data.status =='OK'){
                  swal({
                    title: "Information",
                    text: data.pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){
         
                    window.location.href="<?php echo base_url('userStaff');?>"
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
            document.getElementById('loader').hidden=true; 
            swal(textStatus+' Save : '+errorThrown);
          }
        });
      }
    });

});


</script>
</body>
</html>