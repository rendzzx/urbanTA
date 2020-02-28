<!DOCTYPE html>
<html>
<head>
<link rel="apple-touch-icon" href="<?=base_url('app-assets/images/ico/apple-icon-120.png')?>">
<link rel="shortcut icon" type="image/x-icon" href="<?=base_url('app-assets/images/ico/favicon.ico')?>">
<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/pages/chat-application.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/vendors.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/menu/menu-types/horizontal-menu.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/core/colors/palette-gradient.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/app.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css')?>">
  <title>Ifca Live Chat</title>
</head>
<body class="horizontal-layout horizontal-menu chat-application  menu-expanded" data-open="hover" data-menu="horizontal-menu" data-color="bg-gradient-x-purple-blue" data-col="content-left-sidebar">
            <section class="chat-app-window">
  <div class="mb-1 secondary text-bold-700" id="name">CS Ifca</div>
  <div class="chats">
    <div class="chats" id="chat">
    </div>
  </div>
</section>
<section class="chat-app-form">
  <div class="chat-app-input d-flex">
    <fieldset class="form-group position-relative has-icon-left col-10 m-0">
      <div class="position-relative has-icon-left">
        <input type="text" id="message" class="form-control" placeholder="Type your Message">
        <div class="form-control-position">
          <i class="la la-briefcase"></i>
        </div>
      </div>
    </fieldset>
    <fieldset class="form-group position-relative has-icon-left col-2 m-0">
      <button type="button" class="btn btn-danger" id="send">
        <i class="la la-paper-plane-o d-xl-none"></i>
        <span class="d-none d-lg-none d-xl-block">Send Message </span>
      </button>
    </fieldset>
  </div>
</section>

<script src="https://unpkg.com/@livechat/livechat-visitor-sdk@0.35.2/dist/livechat-visitor-sdk.min.js"></script>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/pages/chat-application.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/core/app-menu.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/core/app.js')?>" type="text/javascript"></script>
<script type="text/javascript">
(function() {

  const visitorSDK = LivechatVisitorSDK.init({
    license: 10666912,
  })

  visitorSDK.on('new_message', newMessage => {
    console.log(newMessage)
    var Message = newMessage.text
    var author = newMessage.authorId
    if (author=='8be2f2f0227443ba534d543d028d3f4e') {
      $( "#chat" ).append(
      '<div class="chat chat-left">'+
        '<div class="chat-avatar">'+
          '<span class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">'+
            '<img src="app-assets/images/portrait/small/avatar-s-7.png" class="box-shadow-4" alt="avatar" />'+
          '</span>'+
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
            '<a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">'+
              '<img src="<?php echo $pict ?>" class="box-shadow-4" alt="avatar" />'+
            '</a>'+
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
            '<a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">'+
              '<img src="app-assets/images/portrait/small/avatar-s-7.png" class="box-shadow-4" alt="avatar" />'+
            '</a>'+
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
              '<a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">'+
                '<img src="app-assets/images/portrait/small/avatar-s-7.png" class="box-shadow-4" alt="avatar" />'+
              '</a>'+
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
    var random = Math.random( )
    $( "#chat" ).append(
      '<div class="chat">'+
        '<div class="chat-avatar">'+
          '<a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">'+
            '<img src="app-assets/images/portrait/small/avatar-s-7.png" class="box-shadow-4" alt="avatar" />'+
          '</a>'+
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
          '<a class="avatar" data-toggle="tooltip" href="#" data-placement="left" title="" data-original-title="">'+
            '<img src="app-assets/images/portrait/small/avatar-s-7.png" class="box-shadow-4" alt="avatar" />'+
          '</a>'+
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

  visitorSDK.setVisitorData({
    name: '<?php echo $name ?>',
    email: '<?php echo $email ?>',
    pageUrl: 'http://35.198.219.220:2121/ifca_splus_v2/c_chat',
    pageTitle: 'Ifca Live Chat',
    customProperties: {
      login: '<?php echo $email ?>',
      customerId: '<?php echo $userID ?>',
    },
  })
})();
</script>
<noscript>
<a href="https://www.livechatinc.com/chat-with/10666912/" rel="nofollow">Chat with us</a>,
powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>
</noscript>


</body>
</html>