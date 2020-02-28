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

<body class="gray-bg-back" style="background: url('.../../app-assets/images/backgrounds/bg-18.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
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
          <img style="width: 200px; padding-bottom:15px" src="<?=base_url('app-assets/images/logo/logo-login.png')?>">
        </center>
        <center>
          <p style="color: white">
            <b>Forgot Password?</b><br>
            Please enter your email address and we'll send an email of your temporary password to login and reset your new password.
          </p>
        </center>
        <form id="frm1" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                    
          <div class="form-group ">
            <input type="email" class="form-control" placeholder="Email" required="true" name="txtUser" id="txtUser" >
          </div>
         
      
              <br>
             
        </form> 
         <div class="pull-right">
                <button type="button" id="submit" class="btn btn-success "> Reset</button>
                <button type="button" id="cancel" class="btn btn-success"> Cancel</button>
              </div>               
      </div>

    </div>
      
     
        

          <script>

            $(document).ready(function () {

              $('#cancel').click(function(){
                window.location.href='<?php echo base_url('userStaff');?>';
              });
              $('#frm1').validate({
                rules: {
                      
                  txtUser:{
                    required: true,
                    email:true
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
      // alert('hahaha');return;
      if($('#frm1').valid())
      {
       
        document.getElementById('loader').hidden=false;
    
        var dataform = $('#frm1').serializeArray();
        console.log(dataform);
        var site_url = "<?php echo base_url('ResetPassword/ForgetPassword')?>";
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