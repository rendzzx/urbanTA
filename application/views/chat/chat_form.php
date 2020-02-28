<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
<link rel="apple-touch-icon" href="<?=base_url('app-assets/images/ico/apple-icon-120.png')?>">
<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('app-assets/images/ico/favicon.ico')?>">
<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/vendors.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/menu/menu-types/horizontal-menu.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/colors/palette-gradient.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/app.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css')?>">
  <title>Ifca Live Chat</title>
</head>
<body class="vertical-layout menu-expanded fixed-navbar">
<div class="col-sm-12" id="page">
  <div class="card">
    <div class="card-header">
      Input Personal
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="name">Full Name</label>
        <div class="position-relative has-icon-left">
          <input type="text" id="name" class="form-control" placeholder="Your Name" name="name">
          <div class="form-control-position">
            <i class="ft-user"></i>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <div class="position-relative has-icon-left">
          <input type="text" id="email" class="form-control" placeholder="Your Email" name="email">
          <div class="form-control-position">
            <i class="ft-mail"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <button class="btn btn-primary" id="save">Submit</button>
    </div>
  </div>
</div>
<script src="https://unpkg.com/@livechat/livechat-visitor-sdk@0.35.2/dist/livechat-visitor-sdk.min.js"></script>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/core/app-menu.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/core/app.js')?>" type="text/javascript"></script>
<script type="text/javascript">
  $( document ).ready(function() {

  const visitorSDK = LivechatVisitorSDK.init({
    license: 10542457,
  })

  $('#save').click(function(){
    var name = $('#name').val()
    var email = $('#email').val()
    visitorSDK.setVisitorData({
      name: name,
      email: email,
      pageUrl: 'http://35.198.219.220:2121/ifca_splus_v2/c_chat_mobile',
      pageTitle: 'Ifca Live Chat',
      customProperties: {
        login: email,
        customerId: email,
      },
    })
    window.location.replace('http://35.198.219.220:2121/ifca_splus_v2/c_chat_mobile/chat')
  })

})
</script>
</body>
</html>