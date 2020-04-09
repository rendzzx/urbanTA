<footer class="footer fixed-bottom footer-light navbar-shadow">
    <div class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-left d-block d-md-inline-block">
            2020  &copy; Copyright 
            <a class="text-bold-800 grey darken-2" href="https://www.ifca.co.id/" target="_blank">PT. IFCA Property365</a>. 
            All rights reserved.
        </span>
        <ul class="list-inline float-md-right d-block d-md-inline-blockd-none d-lg-block mb-0">
            <li></li>
        </ul>
    </div>
</footer>
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/ui/jquery.sticky.js')?>"></script>
    <script src="<?=base_url('app-assets/js/core/app-menu.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/js/core/app.js')?>" type="text/javascript"></script>
    
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

        function block(boelan,div){
            var block_ele = $(div);
            if (boelan==true) {
                $(block_ele).block({
                    message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                    fadeIn: 1000,
                    fadeOut: 1000,
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: '10px 15px',
                        color: '#fff',
                        width: 'auto',
                        backgroundColor: '#333',
                        marginLeft : 'auto'
                    }
                });
            }
            else{
                $(block_ele).unblock()
            }
        }
	</script>
</body>
</html>