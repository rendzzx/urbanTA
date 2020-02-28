<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
  <title>::Login</title>
  <!-- Tell the browser to be responsive to screen width -->

  <!-- Bootstrap 3.3.6 -->

  

  <!--  -->
  <!-- <link href="js/ShowPCx.js" rel="stylesheet"> -->
  <link href="<?=base_url('css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('font-awesome/css/font-awesome.css')?>" rel="stylesheet">

  <link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/style.css')?>" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

  <script src="https://apis.google.com/js/api:client.js"></script>
  <script src="<?=base_url('js/ShowPCx.js')?>" type="text/javascript"></script>


  <script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
  <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
  <script src="<?=base_url('js/jquery.validate.min.js'); ?>" type="text/javascript"></script>


<style type="text/css">
  /** { margin: 0; padding: 0; }
    
    html { 
      background: url('../img/back.jpg') no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: 100%;
    }    
*/
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
/*.text-center {
    text-align: left !important;
}*/


body {
    overflow:hidden;
    display:none !important;
    /*background-image:url('../img/back.jpg');
    background-size: cover;*/
    
}


</style>

</head>

<body class="gray-bg-back" style="background: url('img/back.jpg') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
<?php echo validation_errors(); ?>
<!-- <body class="gray-bg-back"> -->
<script type="text/javascript">
   if (self === top) { 
        var antiClickjack = document.getElementById("antiClickjack");
        antiClickjack.parentNode.removeChild(antiClickjack);
    } else {

        top.location = self.location;
    }
</script>
  <div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
      <div>        
      </div>
      <div style="text-align:left !important;" class="">
      <!-- <div class=""> -->
        <center>
          <!-- <h4 style="color: black;">Sign In</h4> -->
          <img style="width: 200px; padding-bottom:15px" src="<?=base_url('img/logo_3.png')?>">
        </center>

        <form id="frm1" action="<?php echo base_url(); ?>userStaff/login" method="post">
          <script type="text/javascript">
                   var theForm = document.forms['frm1']; 
                            if (!theForm) { 
                                theForm = document.frm1; 
                            }
                </script>                
          <div class="form-group ">
            <input type="email" class="form-control" placeholder="UserName" required="" name="txtUser" id="txtUser" >
          </div>
                  <div class="form-group" >                   
                    <span style="position: relative;">
                      <input type="password" class="form-control" id="txtPass" name="txtPass" placeholder="Password" required="">
                      <!-- <div class="input-group m-b"> <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="" class="form-control"><span class="input-group-addon"> <input type="checkbox"> </span></div> -->
                      <input class="form-control" id="txtPass" style="display:none" autocomplete="off" type="text">
                      <label for="showpasscheckbox-523" class="show-password" title="Show the password as plain text (not advisable in a public place)" style="display:block;position:static;">
                      </label>
                    </span>
                  </div>
                  <div id="error_msg">
                    <center><h4 style="color: red;"><?php echo $error_login;?></h4></center>
                  </div>
                    
                  <br>
                  <div class="form-group" id="divCaptLogin" name="divCaptLogin" alt=" " width="140" height="100" >
                    <div><?php if(!empty($image)){ echo $image;}?> 
                      <button type="button" class="btn btn-success pull-right" onclick="reload_captcha();" style="margin-top:0px; margin-right: 10px;">
                        <i class="glyphicon glyphicon-refresh"></i>
                      </button>
                    </div>
                    <br>

                    <input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter text above" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/>

                  </div>
                  <a href="#" onclick="fn_confirm();" style="font-size: 15px;color:white;">Forget Password?</a>
                  <button type="submit" class="btn btn-success block pull-right m-b"><span class = "glyphicon glyphicon-user"></span> Login</button>
                  <!-- button type="button" class="btn btn-success block full-width" onclick="fn_confirm();" >
                    <i>Forget Password </i>
                  </button> -->
                  <!-- <center><h4 style="color: black;">Log In With</h4></center> -->

                    <div class="form-group" hidden="hidden">
                     <a id="signup" name="signup" onclick="signup()" class="btn btn-success btn-gmail">
                            Sign Up With Sosmed
                        </a>
                    </div>

                    <div class="form-group" hidden="hidden">
                        <a id="customBtn" name="customBtn" class="btn btn-success btn-gmail" scope="public_profile,email">
                        <img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/gmail-logo.png')?>" width="25">
                            Gmail
                        </a>
                    </div>
                  <div class="form-group" hidden="hidden">
                        <a id="btnfb" name="btnfb" class="btn btn-success btn-facebook" scope="public_profile,email" onclick="checkLoginState();">
                            <img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/fb-logo.png')?>" width="24">
                                Facebook
                        </a>                    
                  </div>

                </form>                
              </div>


            </div>
          </div>
          <!-- <footer style="background: url('img/logo.png') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: 100% 100%;"></footer> -->

            <script type="text/javascript">
            var ss = '<?php echo $error_login;?>';
            if(ss.length>0){
                $('#error_msg').show();  
            }else{
              $('#error_msg').hide();
            }
            
                      function statusChangeCallback(response) {                       
                         
                        if (response.status === 'connected') {
                            
                          testAPI();
                        } else if (response.status === 'not_authorized') {
                          FB.login(function(response) {
                            
                            if (response.status === 'connected') {
                              testAPI();
                            }
                          }, {
                            scope: 'email'
                          });                          
                        } else {
                          FB.login(function(response) {
                            
                            if (response.status === 'connected') {
                              testAPI();
                            }
                          }, {
                            scope: 'email'
                          });
                        }
                      } 

                      window.fbAsyncInit = function() {
                        FB.init({
                          appId            : '1961289290825001',
                          autoLogAppEvents : true,
                          xfbml            : true,
                          status     : true, // check login status
                          cookie     : true, // enable cookies to allow the server to access the session
                          version          : 'v2.1'
                        // version          : 'v2.5'
                              });
                      };

                      function checkLoginState() {
                        // alert('1');
                        FB.getLoginStatus(function(response) {
                          // console.log(response);
                          statusChangeCallback(response);
                        });
                      }
                      // Load the SDK asynchronously
                      (function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s); js.id = id;
                        js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.9";
                        fjs.parentNode.insertBefore(js, fjs);
                      }(document, 'script', 'facebook-jssdk')); 

                      function testAPI() {
                        FB.api ("/me?fields=id,name,email,gender,link", "get", function (a) {
                          var id = "FB"
                          localStorage.setItem('facebook',JSON.stringify(a))
                          window.location.href  = "<?php echo base_url('signupGuest/index');?>"+"/"+id;
                        })
                      }
            </script>
            <!-- scipt setting gmail -->
                    <script>
                var googleUser = {};
                var startApp = function() {
                  gapi.load('auth2', function(){
                        auth2 = gapi.auth2.init({
                        client_id: '175436779311-tmh57oa0gpo9gq22ch3kco3ibcp8thql.apps.googleusercontent.com',
                        cookiepolicy: 'single_host_origin',                    
                        });
                    attachSignin(document.getElementById('customBtn'));
                  });
                };

                function attachSignin(element) {
                  // console.log(element.id);
                  auth2.attachClickHandler(element, {},
                      function(googleUser) {                            
                              gapi.client.load('plus', 'v1', function () {
                      var request = gapi.client.plus.people.get({
                          'userId': 'me'
                      });
                      request.execute(function (resp) {
                        // console.log(resp.emails[0].value);
                          var email = resp.emails[0].value;
                          var fr = "GMAIL";
                          var id = resp.id;
                          var data = [];
                          data.push({name:'Email',value:email},{name:'fr',value:fr},{name:'id',value:id});

                          console.log(data); 
                          $.ajax({
                          type: "POST",
                          url: "<?php echo base_url('userStaff/LoginWithSosmed');?>",
                          data: data,
                         async: false,
                          dataType: "JSON",
                          success: function(data) {
                            // console.log(data);
                            
                                window.location.href = data.Data;
                        }
                    });                         
                      });
                  });
                      }, function(error) {
                  });
              }

              // function _login(gm){
              //        $.ajax({
              //           type: "POST",
              //           url: "<?php echo base_url('userStaff/LoginWithSosmed');?>",
              //           data: {
              //               Email: gm
              //           },
              //           async: false,
              //           dataType: "html",
              //           success: function(event,data) {
              //               // console.log(event);
              //                   window.location.href = event;
                          
              //           }
              //       }); 
              // }
          </script>

          

          <script>
          


            new ShowPCx(document.getElementById("txtPass"));
            var frm = document.forms['frm1'];
            if(!frm){
              frm = document.frm1;
            }

            function __doPostBack()
            {
              if(!frm.onSubmit || (frm.onSubmit() != false)) {
                frm.submit();
              }
            }

            function reload_captcha()
            {             
              $("#divCaptLogin").load('<?=base_url("userStaff/load_captcha")?>' + '#divCaptLogin');
            }

            function fn_confirm(){
                // var email = $('#txtUser').val();
                // if(email.length<5){    
                //   return;
                // }
                window.location.href  = "<?php echo base_url('ResetPassword');?>";

            }

            function signup(){
                window.location.href  = "<?php echo base_url('userStaff/sosmed');?>";
            }

            $(document).ready(function () {

                        
              $('#frm1').validate({
                ignore: "",
                rules: {
                  password: { 
                    required: true
                  },        
                  txtUser:{
                    required: true,
                    email:true
                  },
                  userCaptcha:{
                    required: true
                  }
                },
                messages: {userCaptcha: {checkCapt: "Invalid Captcha"},
                txtUser: {checkUserPass: "Invalid txtUser and Password"},
                password: {checkUserPass: "Invalid txtUser and Password"}
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

});


</script>
<script>startApp();</script>
</body>
</html>