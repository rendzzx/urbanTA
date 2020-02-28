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
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/pages/chat-application.css')?>">

<title>Ifca Live Chat</title>
</head>
<body class="vertical-layout menu-expanded fixed-navbar">
<div class="col-sm-12" id="page">
  <div class="card">
      <div class="card-content">
          <div class="card-body chat-application">
              <div class="chats height-550 position-relative ps-container ps-theme-dark ps-active-y" data-ps-id="3b6b78cf-d52b-5968-f1b1-4669c37328b7">
                  <div class="chats ps-container ps-theme-dark" data-ps-id="a73f705c-1926-3f57-abd5-68bd26fd3802" id="chat">
                  <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
              <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 300px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 95px;"></div></div></div>
              <div class="chat-app-input mt-1 row">
                  <fieldset class="form-group position-relative has-icon-left col-xl-9 col-lg-9 col-9 m-0 mb-1">
                      <input type="text" class="form-control" id="message" placeholder="Type your message">
                  </fieldset>
                  <fieldset class="form-group position-relative has-icon-left col-xl-3 col-lg-3 col-3 m-0">
                      <button type="button" class="btn btn-primary" id="send">
                          <i class="ft-navigation white"></i>
                      </button>
                  </fieldset>
              </div>
          </div>
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
    license: 10666912,
  })

    var name = '<?php echo $name ?>'
    var name = name.replace('%20', " ");
    var email = '<?php echo $email ?>'
    var ticket = '<?php echo $ticket ?>'
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

  var message = '<?php echo $ticket ?>'
  var random = Math.random( )
    $( "#chat" ).append(
      '<div class="chat">'+
        '<div class="chat-avatar">'+
          'You'+
        '</div>'+
        '<div class="chat-body">'+
          '<div class="chat-content">'+
            '<p>'+message+'</p>'+
          '</div>'+
        '</div>'+
      '</div>'
      )
    $('#message').val('')
    visitorSDK
    .sendMessage({
      text: message,
      customId: random,
    })
    .then(response => {
      console.log(response)
    })
    .catch(error => {
      $( "#chat" ).append(
      '<div class="chat chat-left">'+
        '<div class="chat-avatar">'+
          'Cs Ifca'+
        '</div>'+
        '<div class="chat-body">'+
          '<div class="chat-content">'+
            '<p>'+error.reason+'</p>'+
          '</div>'+
        '</div>'+
      '</div>'
      );
    })

  visitorSDK.on('new_message', newMessage => {
    console.log(newMessage)
    var Message = newMessage.text
    var author = newMessage.authorId
    console.log(author)
    if (author=='8be2f2f0227443ba534d543d028d3f4e') {
      $( "#chat" ).append(
      '<div class="chat chat-left">'+
        '<div class="chat-avatar">'+
          'Cs Ifca'+
        '</div>'+
        '<div class="chat-body">'+
          '<div class="chat-content">'+
            '<p>'+Message+'</p>'+
          '</div>'+
        '</div>'+
      '</div>'
      );
    }
    else{
      $( document ).one(function() {
        $( "#chat" ).append(
        '<div class="chat">'+
          '<div class="chat-avatar">'+
            'You'+
          '</div>'+
          '<div class="chat-body">'+
            '<div class="chat-content">'+
              '<p>'+Message+'</p>'+
            '</div>'+
          '</div>'+
        '</div>'
        )
      });
    }
  })

  $(document).on('keypress',function(e) {
    if(e.which == 13) {
        var message = $('#message').val()
        var random = Math.random( )
        $( "#chat" ).append(
        '<div class="chat">'+
          '<div class="chat-avatar">'+
            'You'+
          '</div>'+
          '<div class="chat-body">'+
            '<div class="chat-content">'+
              '<p>'+message+'</p>'+
            '</div>'+
          '</div>'+
        '</div>'
        )

        $('#message').val('')
        visitorSDK
        .sendMessage({
          text: message,
          customId: random,
        })
        .then(response => {
          console.log(response)
        })
        .catch(error => {
          $( "#chat" ).append(
          '<div class="chat chat-left">'+
            '<div class="chat-avatar">'+
              'Cs Ifca'+
            '</div>'+
            '<div class="chat-body">'+
              '<div class="chat-content">'+
                '<p>'+error.reason+'</p>'+
              '</div>'+
            '</div>'+
          '</div>'
          );
        })

    }
});

  $('#send').click(function(){
    var message = $('#message').val()
    var name = '<?php echo $name ?>'
    var random = Math.random( )
    $( "#chat" ).append(
      '<div class="chat">'+
        '<div class="chat-avatar">'+
          'You'+
        '</div>'+
        '<div class="chat-body">'+
          '<div class="chat-content">'+
            '<p>'+message+'</p>'+
          '</div>'+
        '</div>'+
      '</div>'
      )
    $('#message').val('')
    visitorSDK
    .sendMessage({
      text: message,
      customId: random,
    })
    .then(response => {
      console.log(response)
    })
    .catch(error => {
      $( "#chat" ).append(
      '<div class="chat chat-left">'+
        '<div class="chat-avatar">'+
          'Cs Ifca'+
        '</div>'+
        '<div class="chat-body">'+
          '<div class="chat-content">'+
            '<p>'+error.reason+'</p>'+
          '</div>'+
        '</div>'+
      '</div>'
      );
    })
  })
})
</script>
</body>
</html>