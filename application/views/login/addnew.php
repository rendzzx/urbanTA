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
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">

  <script src="https://apis.google.com/js/api:client.js"></script>

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

<body class="gray-bg-back" style="background: url('<?php echo base_url("img/back.jpg"); ?>') no-repeat center center fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover;">
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
                <div class="form-group">
                        <a id="customBtn" name="customBtn" class="btn btn-success btn-gmail" scope="public_profile,email">
                        <img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/gmail-logo.png')?>" width="25">
                            Gmail
                        </a>
                    </div>
                  <div class="form-group">
                        <a id="btnfb" name="btnfb" class="btn btn-success btn-facebook" scope="public_profile,email" onclick="checkLoginState();">
                            <img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/fb-logo.png')?>" width="24">
                                Facebook
                        </a>                    
                  </div>
         <div class="pull-right">
                <button type="button" id="cancel" class="btn btn-success"> Cancel</button>
        </div>               
      </div>

    </div>
      
     
        

          <script>

          $(document).ready(function () {
            $('#cancel').click(function(){
                window.location.href='<?php echo base_url('userStaff');?>';
                localStorage.clear()
              });
          })
</script>

<script>
            
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
                        client_id: '466737535909-cpubhuf9fv24i8hn9rp0on1eedls7djd.apps.googleusercontent.com',
                        cookiepolicy: 'single_host_origin',                    
                        });
                    attachSignin(document.getElementById('customBtn'));
                  });
                };

                function attachSignin(element) {
                  console.log(element.id);
                  auth2.attachClickHandler(element, {},
                      function(googleUser) {                            
                      gapi.client.load('plus', 'v1', function () {
                      var request = gapi.client.plus.people.get({
                          'userId': 'me'
                      });
                      request.execute(function (resp) {
                          var google = localStorage.setItem('google',JSON.stringify(resp))
                          var google = JSON.stringify(resp)
                          var id = "GMAIL"
                          window.location.href  = "<?php echo base_url('signupGuest/index');?>"+"/"+id;
                      });
                  });
                      }, function(error) {
                  });
              }
          </script>
          <script>startApp();</script>`

</body>
</html>