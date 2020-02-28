<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
  <title>IFCA</title>
  
  
<style id="antiClickjack" type="text/css">
body {
    /*overflow:hidden;*/
    display:none !important;
}
</style>

<script type="text/javascript">
   if (self === top) { 
        var antiClickjack = document.getElementById("antiClickjack");
        antiClickjack.parentNode.removeChild(antiClickjack);
    } else {
 
        top.location = self.location;
    }
</script>
  <link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">   
  <link rel="stylesheet" type="text/css" href="<?=base_url('font-awesome/css/font-awesome.min.css')?>">  
  <link href="<?=base_url('css/plugins/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">



  <link href="<?=base_url('css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">  
  <link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">


  <link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/style.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

  <script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
  <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
  <script src="<?=base_url('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
  <script src="<?=base_url('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    
    <script src="https://apis.google.com/js/api:client.js"></script>

  <script type="text/javascript" src="<?=base_url('js/plugins/sweetalert/sweetalert.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>"></script>

  <script src="<?=base_url('css/test/select2.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>"></script>

  <script src="<?=base_url('js/plugins/jasny/jasny-bootstrap.min.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('js/inspinia.js')?>"></script>
  <script src="<?=base_url('js/plugins/peity/jquery.peity.min.js')?>"></script>
  <script src="<?=base_url('js/plugins/pace/pace.min.js')?>"></script>
  <script src="<?=base_url('js/demo/peity-demo.js')?>"></script>

  <script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
  <script src="https://www.google.com/recaptcha/api.js"></script>
  <script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>


  <style type="text/css">
.has-error .select2_demo_1-selection {
    border: 2px solid #a94442;
    border-radius: 4px;
} 
  .btn-dor {
    background-color: #7c7c7c;
    border-color: #7c7c7c;
    color: #FFFFFF;
  }
  .btn-dor:hover {
      background-color: #9e9e9e;
      border-color: #9e9e9e;
      color: #FFFFFF;
  }
</style>
  <style type="text/css">
    .fancyradio{
      display: block;
      background: #dbdbdb;
      color: #000;
      padding: 20px;
      border-radius: 3px;
      cursor: pointer;
    } ,
    body {
      background-color: #eee;
      padding-top: 40px;
      padding-bottom: 40px;
    }
    label {text-align: right;}
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
    /*.select.input-validation-error { border-color: red }       */
  </style>

  <style type="text/css">
    .loader{
      width:100%;
      height:100%;
      position:fixed;
      z-index:9999;
      background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center     
    }  
  </style>
  <script type="text/javascript">
    function replaceAll(str, find, replace)
    {
      return str.replace(new RegExp(find, 'g'), replace);
    }

    function formatNumber(data) 
    {
      if(data==null){
        data =0;
      }
      // alert(data);
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

    }
  </script>
  <style >
    #signupForm label.error {
      margin-left: 10px;
      width: auto;
      display: inline;
    }
    td {
      height: 40px;
    }

    #label_form label {
      text-align: right;
    }

    .marginSelect{
      padding-left: 12px !important;
      padding-bottom: 6px !important;
      border-bottom-width: 1px !important;
      padding-top: 3px !important;

    }
  </style>

  <script type="text/javascript">

    var observe;
    if (window.attachEvent) {
      observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
      };
    }
    else {
      observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
      };
    }
    function init () {
      var text = document.getElementById('remarks');
      function resize () {
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
      }
      /* 0-timeout to get the already changed text */
      function delayedResize () {
        window.setTimeout(resize, 0);
      }
      observe(text, 'change',  resize);
      observe(text, 'cut',     delayedResize);
      observe(text, 'paste',   delayedResize);
      observe(text, 'drop',    delayedResize);
      observe(text, 'keydown', delayedResize);

      text.focus();
      text.select();
      resize();
    }
  </script> 

</head>
<body class="top-navigation">   
  <div id="wrapper">
    <div id="loader" class="loader" hidden="true"></div>
    <div id="page-wrapper" class="gray-bg">            
      <div class="content-wrapper">
        <div class="row border-bottom white-bg dashboard-header"> 
          <div id="loader" class="loader" hidden="true"></div> 
          <div class="form-group">
            <div class="tittle-top pull-left"><b>
            </b></div>
            <div class="tittle-top pull-right"><b>Occupants Registration</b></div>
          </div>        
        </div>
        <div class="wrapper wrapper-content"  style="width: 800px;margin: 0 auto;">
          <div class="row">
            <div class="col-xs-12">
              <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
                <div class="ibox-content" > 
                <br>          
                  <div class="form-group">
                    <label class="col-sm-4 ">E-mail <FONT COLOR="RED">*</FONT></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" name="txtemail" id="txtemail" placeholder="Email" value="<?php echo $Email;?>">
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
                      <input type="hidden" name="txtgender" id="txtgender">
                      <input type="hidden" name="txtsosmed" id="txtsosmed">
                      <input type="hidden" name="txtlink" id="txtlink">
                      <input type="hidden" name="txtname" id="txtname" value="<?php echo $debtor_acct;?>">
                      
                      <input type="hidden" name="entity_cd" id="entity_cd" value="<?php echo $entity_cd;?>">
                      <input type="hidden" name="project_no" id="project_no" value="<?php echo $project_no;?>">
                      <input type="hidden" name="debtor_acct" id="debtor_acct" value="<?php echo $debtor_acct;?>">
                    </div>
                  </div><br>
               <!--     <div style="text-align: center;"> - Or - </div><br>
                  <div class="form-group" >
                    <div class="col-sm-12">
                         <div class="col-xs-3"></div>
                              <a id="customBtn" name="customBtn" style="margin: 0 auto;" class="btn btn-success btn-gmail col-xs-6" scope="public_profile,email">
                          <img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/gmail-logo.png')?>" width="24">
                           Sign in with G-Mail
                        </a>
                                
                            <div id="name"></div>
                    </div>
                  </div> -->
                  <!--
                  <div class="form-group" >
                    <div class="col-sm-12">
                    <div class="col-xs-3"></div>
                        <a id="btnfb" name="btnfb" style="margin: 0 auto;" class="btn btn-success btn-facebook col-xs-6" scope="public_profile,email" onclick="checkLoginState();">
                          <img alt="Facebook Icon" class="c-btn__farleft-icon" height="24" src="<?=base_url('img/fb-logo.png')?>" width="24">
                          Sign in with Facebook
                        </a> 
                    </div>
                  </div> -->
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
            <div class="footer fixed">
              <strong>Copyright &copy; 2016-2017 <a href="#">PT. IFCA Property365</a>.</strong> All rights reserved.
            </div>
          </div>
        </div>
        <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
          <div id="modalDialog" class="modal-dialog">
            <div class="modal-content">
              <!-- Modal Header -->
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
              </div>
              <!-- Modal Body -->
              <div class="modal-body">
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>
        <!-- </form>   -->


        <script type="text/javascript">

            
    var ids;
    var descss;


          function reload_captcha()
            {             
              $("#divCaptLogin").load('<?=base_url("Occupants/load_captcha")?>' + '#divCaptLogin');
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
     
        document.getElementById('loader').hidden=false;

          var datafrm = $('#form_nup').serializeArray();

            $.ajax({
              url : "<?php echo base_url('Occupants/save');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(event, data){
                  document.getElementById('loader').hidden=true;

                  if(event.status=='OK'){
                    swal({
                      title: "Information",
                      animation: false,
                      type:"success",
                      text: event.Pesan,
                      confirmButtonText: "OK"
                    },function(){
                        window.location.href="<?=base_url('userstaff/logout')?>";
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

      }//form valid
    });
  });



$('#btnback').click(function(){

     window.location.href='<?php base_url('demo')?>';
  
});
</script>
<script type="text/javascript">
            //           function statusChangeCallback(response) {                       
            //               console.log(response);
            //               console.log('stCllback');
            //             if (response.status === 'connected') {
            //                 console.log('dddd');
            //               testAPI();
            //             } else if (response.status === 'not_authorized') {
            //               FB.login(function(response) {
            //                 console.log(response);
            //                 console.log('not_authorized');
            //                 if (response.status === 'connected') {
            //                   testAPI();
            //                 }
            //               }, {
            //                 scope: 'email'
            //               });
            //               // document.getElementById('status').innerHTML = 'Please log ' + 'into this app.';
            //             } else {
            //               FB.login(function(response) {
            //                 console.log(response);
            //                 console.log('not_authorized2');
            //                 if (response.status === 'connected') {
            //                   testAPI();
            //                 }
            //               }, {
            //                 scope: 'email'
            //               });
            //               // document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
            //             }
            //           } 

            //           window.fbAsyncInit = function() {
            //             FB.init({
            //               appId            : '1961289290825001',
            //               autoLogAppEvents : true,
            //               xfbml            : true,
            //               status     : true, // check login status
            //               cookie     : true, // enable cookies to allow the server to access the session
            //               version          : 'v2.1'
            //               // version          : 'v2.5'
            //             });
            //           };

            //           function checkLoginState() {
            //             // alert('1');
            //             FB.getLoginStatus(function(response) {
            //               // console.log(response);
            //               statusChangeCallback(response);
            //             });
            //           }
            // // Load the SDK asynchronously
            // (function(d, s, id) {
            //   var js, fjs = d.getElementsByTagName(s)[0];
            //   if (d.getElementById(id)) return;
            //   js = d.createElement(s); js.id = id;
            //   js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.9";
            //   fjs.parentNode.insertBefore(js, fjs);
            // }(document, 'script', 'facebook-jssdk')); 

            // function testAPI() {
            //   // console.log('Welcome!  Fetching your information.... ');
            //   FB.api ("/me?fields=id,name,email,gender,link", "get", function (a) {
            //     console.log(a);
            //     $('#txtname').val(a.name);
            //       $('#txtemail').val(a.email);
            //       $('#txtgender').val(a.gender);
            //       $('#txtlink').val(a.link);
            //       $('#txtsosmed').val('Facebook');
            //   })
            // }
            </script>
             <!-- scipt setting gmail -->
                     <script>
                // var googleUser = {};
                // var startApp = function() {
                //   gapi.load('auth2', function(){
                //     // Retrieve the singleton for the GoogleAuth library and set up the client.
                //         auth2 = gapi.auth2.init({
                //         client_id: '175436779311-tmh57oa0gpo9gq22ch3kco3ibcp8thql.apps.googleusercontent.com',
                //         cookiepolicy: 'single_host_origin',
                //     // Request scopes in addition to 'profile' and 'email'
                //     //scope: 'additional_scope'
                //         });
                //     attachSignin(document.getElementById('customBtn'));
                //   });
                // };

              //   function attachSignin(element) {
              //     // console.log(element.id);

              //     auth2.attachClickHandler(element, {},

              //         function(googleUser) {
              //         // console.log('a');
              //                 gapi.client.load('plus', 'v1', function () {
              //         var request = gapi.client.plus.people.get({
              //             'userId': 'me'
              //         });

              //         //Display the user details
              //         request.execute(function (resp) {
              //             // console.log(resp);
              //             document.getElementById('loader').hidden=false;
              //             // $('#txtname').val(resp.displayName);
              //             $('#txtemail').val(resp.emails[0].value);
              //             $('#txtgender').val(resp.gender);
              //             $('#txtlink').val(resp.url);
              //             $('#txtsosmed').val(1);
              //             _save();

              //         });
              //     });
                            
              //         }, function(error) {
              //           // alert(JSON.stringify(error, undefined, 2));
              //     });
              // }
              function _save(){
                // alert(a);
                var datafrm = $('#form_nup').serializeArray();
// console.log(datafrm);return;
          // alert('dor');
            $.ajax({
              url : "<?php echo base_url('Occupants/save');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(event, data){
                  document.getElementById('loader').hidden=true;

                  if(event.status=='OK'){
                    swal({
                      title: "Information",
                      animation: false,
                      type:"success",
                      text: event.Pesan,
                      confirmButtonText: "OK"
                    },function(){
                        window.location.href="<?=base_url('userstaff/logout')?>";
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
              }
          </script>

          <!-- <script>startApp();</script>    Google-->
</body>

</html>