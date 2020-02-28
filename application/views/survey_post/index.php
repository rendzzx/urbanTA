
<link href="<?=base_url('css/plugins/iCheck/custom.css')?>" rel="stylesheet">

<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <br><br>
           <h3 class="content-header-title">Survey </h3>
        </div>

     </div>
        <div class="content-body">
            <!-- <div class="row"> -->
       
                   
                             <?php echo $Survey; ?> 
                     
 
            <!-- </div> -->
        </div>
  </div>
</div>
        

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/iCheck/icheck.min.js')?>"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
        </script>

   