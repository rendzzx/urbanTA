<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::Login - Forgot Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.css')?>">
  <link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('plugins/confirmationDialog/bootstrap-dialog.min.css')?>">
  <script src="<?=base_url('plugins/jQuery/jQuery-2.2.0.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('plugins/confirmationDialog/bootstrap.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('plugins/confirmationDialog/bootstrap-dialog.min.js')?>"></script>
</head>
<body class="hold-transition login-page" style="background-color;margin-top: 80px;">
<style type="text/css">
  .loader{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center     
  }  
</style>
<div id="loader" class="loader" hidden="true"></div>
<div class="login-box">  
  <div class="login-box-body">
    <center><h4 style="color: black;">Forgot Password</h4></center>
    <form id="frm1" action="" method="post">
      <div class="form-group has-feedback">
        <input class="form-control" type="email" id="username" name="username" placeholder="Email recovery">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      
      <button class="btn btn-info" type="button" id="btnFgpwd">
        Forgot Password
      </button>
      <!-- <button class="btn btn-info pull-right" type="button">Forgot Password</button> -->
      <a class="btn btn-info pull-right" href="<?php echo base_url('loginstaff');?>">Cancel</a>
    </form>
  </div>
</div>
<script>
$(function () {
  $("#btnFgpwd").click(function(){
    var mail = $("#username").val();
    // console.log(mail);
    document.getElementById('loader').hidden=false;
    if(mail !== '' && mail !== undefined) {
      $.ajax({
        url:'<?php echo base_url("userStaff/forgetPass");?>',
        data: {mm: mail},
        method: 'post',
        dataType: 'json'
      })
      .done(function(msg){
        document.getElementById('loader').hidden=true;
        console.log('tes');
        BootstrapDialog.alert(msg.Response);
        window.location.href='<?=base_url("loginstaff")?>';
      })
      .fail(function(jqXHR, textStatus){
        document.getElementById('loader').hidden=true;
        BootstrapDialog.alert(textStatus);
      });
      
    } else {
      document.getElementById('loader').hidden=true;
      BootstrapDialog.alert('Forgot Password Failed');
    }
  });
});

</script>
</body>
</html>