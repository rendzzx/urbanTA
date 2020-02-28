
 <footer class="footer fixed-bottom footer-light navbar-shadow">
      <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2"><span class="float-md-left d-block d-md-inline-block">2018  &copy; Copyright <a class="text-bold-800 grey darken-2" href="#">PT. IFCA Property365</a>. All rights reserved.</span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
          
          
          
        </ul>
      </div>
    </footer>
    <script type="text/javascript">
	  $(document).ready(function(){
	     setInterval(function(){
	            // load_unseen_notif();
	            // load_unseen_notif_cnt();
	        },5000);
	    });
	  function load_unseen_notif(){
	    $('#div_notif').load( "<?php echo base_url('customerservice/load_unseen_notif');?> #div_notif" );
	  }
	  function load_unseen_notif_cnt(){
	    $('#div_cntnotif').load( "<?php echo base_url('customerservice/load_unseen_notif_cnt');?> #div_cntnotif" );
	  }
	</script>

	<!-- <script src="https://unpkg.com/@livechat/livechat-visitor-sdk@0.35.2/dist/livechat-visitor-sdk.min.js"></script>
<script type="text/javascript">
(function() {


  const visitorSDK = LivechatVisitorSDK.init({
    license: 10542457,
  })

  visitorSDK.on('new_message', newMessage => {
    console.log(newMessage)
  })

  visitorSDK.setVisitorData({
    name: 'Wynton Marsalis',
    email: 'test@livechatinc.com',
    pageUrl: 'http://35.198.219.220:2121/ifca_splus_v2/dash/index',
    pageTitle: 'Pricing',
    customProperties: {
      login: 'wyntonmarsalis',
      customerId: '18260556127834',
    },
  })

  visitorSDK
  .sendMessage({
    text: '321',
    customId: 3,
  })
  .then(response => {
    console.log(response)
  })
  .catch(error => {
    console.log(error)
  })

})();
</script>
<noscript>
<a href="https://www.livechatinc.com/chat-with/10542457/" rel="nofollow">Chat with us</a>,
powered by <a href="https://www.livechatinc.com/?welcome" rel="noopener nofollow" target="_blank">LiveChat</a>
</noscript>
End of LiveChat code -->
</body>
</html>