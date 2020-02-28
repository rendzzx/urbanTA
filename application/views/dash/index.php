<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/line-awesome/css/line-awesome.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">Choose Project :</h3>
      </div>
      <div class="content-header-right col-md-8 col-12 mb-2">
        <label class="pull-right" style="color: #ffffff !important">Search:<input type="text" id="txtSearch" class="form-control form-control-sm  " placeholder=""></label>
      </div>
    </div>
    <div class="content-body"> 
<!-- start of content -->
      <div class="row">      
        <div class="col-sm-12" id="projects">
            <span id="listproject">
              <div class="row">
                  <?php echo $PlProject; ?>      
              </div>
            </span>
        </div>
      </div>

<!-- end of content -->
    </div>
  </div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#txtSearch').on("keyup",function(){
      var searchval = $(this).val();
      // console.log(searchval);
      block(true);
      $('#listproject').load( "<?php echo base_url('dash/search_project');?> #listproject",{"searchval":searchval},function(e){
        // console.log(e);
         block(false);
      } );
    });
    function block(boelan){
        var block_ele = $('#projects')
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
  });
</script>