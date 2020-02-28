<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
  <title>Change Password</title>
  <link href="<?=base_url('css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('font-awesome/css/font-awesome.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/style.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet"> 
  <script src="<?php echo base_url('js/ShowPCx.js'); ?>" type="text/javascript"></script>
  <script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
  <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
  <script src="<?=base_url('js/jquery.validate.min.js'); ?>" type="text/javascript"></script>
  <script type="text/javascript" src="<?=base_url('js/plugins/sweetalert/sweetalert.min.js')?>"></script>

  <style type="text/css">
    body {
      overflow:hidden;
    }
  </style>

</head>
<body class="gray-bg-back" style="background-image: url('../img/back.jpg');margin-top: 80px; overflow-x: hidden;">
  <div class="middle-box text-center loginscreen animated fadeInDown">
    <div>    
    <?php 
        if($error !=null){ 
          foreach ($error as $key => $value) {
            echo $value ."<br />";
          }
        }
        ?> 
      <div class="trans">
        <center><h4 style="color: white;">Change password for first time use</h4></center>
          <!-- <form action="<?php echo base_url(); ?>index.php/userStaff/save" method="post"> -->
          <form action="" method="post" name="change_form" id="change_form">
            <div class="form-group has-feedback">
              <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo $username ?>" />
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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
            <button class="btn btn-info" type="button" name="submit" id="submit">
              <span class = "glyphicon glyphicon-user"></span>
              Save
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script type="text/javascript">
  $('#submit').click(function(){
    if($('#change_form').valid()){
      var dataform = $('#change_form').serializeArray();
      // console.log(dataform);
        // dataform.push({name:"bussiness_id",value:bussID}
        //               ,{name:"rowID",value:ID}
        //               ,{name:"rsvdate",value:srvdate}
        //               ,{name:"nupamt",value:nupamt}
        //               ,{name:"remarkspayment",value:remarkspayment},
        //               {name:"npwp",value:npwp},
        //               {name:"Id_No",value:Id_No},
        //               {name:"city",value:city},
        //               {name:"property",value:prop}
        //               );

      var site_url = "<?php echo base_url('userStaff/save')?>";
      $.ajax({
        url: site_url,
        type: "POST",
        data: dataform,
        dataType: "json",
        success: function(data, status){
         // document.getElementById('loader').hidden=true;   
          if(data.status !='Failed'){
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
            },
            function(){
              window.location.href="<?php echo base_url('userStaff');?>"
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          // document.getElementById('loader').hidden=true; 
          // document.getElementById("submit").disabled = false;
          swal(textStatus+' Save : '+errorThrown);
        }
      })
    }

  });

  $(document).ready(function() {
    $.validator.addMethod("confirm_password", function (value, element) {
      var isSuccess = false;
      var newpassword = $('#newpassword').val();
      var confpassword = $('#confpassword').val();

      if(newpassword == confpassword){
         isSuccess=true;
      }
      
      return isSuccess;

    });

    $('#change_form').validate({
      rules: {
        username: { required: true,
                    email: true
        },
        newpassword: { required: true ,confirm_password:true},
        confpassword: { required: true,confirm_password:true }
      },
      messages: {newpassword: {confirm_password: "Password is not valid"},
                confpassword: { confirm_password: "Password is not valid"}
              },
      errorElement: "em",
      errorPlacement: function(error, element){
        error.addClass("help-block  text-red");
        element.parents(".col-xs-5").addClass("has-feedback  text-red");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
        } else {
            error.insertAfter(element);
        }

        if (!element.next("span")[0]) {
            $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 90%' ></span>").insertAfter(element);
        }
      },
      success: function(label, element){
        if (!$(element).next("span")[0]) {
            $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 90%'></span>").insertAfter($(element));
        }
      },
      highlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
        $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
      },
      unhighlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
        $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
      }
    });
  });

  </script>
  </html>

















<!-- <!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
  <title>::Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css')?>">
  <script src="<?php echo base_url('dist/js/ShowPCx.js'); ?>" type="text/javascript"></script>
  <script src="<?=base_url('plugins/jQuery/jQuery-2.2.0.min.js')?>"></script>
  <script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script>
  </head>
    

  <body>
    <div class="content-wrapper">
      <div class="container" style="padding-top: 70px;">
        <?php 
          if($error !=null){ 
            foreach ($error as $key => $value) {
              echo $value ."<br />";
            }
          }
        ?>        
        <div class="col-sm-8">
          <center><h4 style="color: white;">Change password for first time use</h4></center>
          <form action="<?php echo base_url(); ?>index.php/userStaff/save" method="post">
            <div class="form-group has-feedback">
              <input type="text" name="username" class="form-control" placeholder="username" value="<?php echo $username ?>" />
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="newpassword" class="form-control" placeholder="New Password" />
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
              <input type="password" name="confpassword" class="form-control" placeholder="Confirm Password" />
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>         
            <hr>
            <button class="btn btn-info" type="submit">
              <span class = "glyphicon glyphicon-user"></span>
              Save
            </button>
          </form>
        </div>
      </div>
    </div>
    <script src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html> -->
