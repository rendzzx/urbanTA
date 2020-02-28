<style>
  ul#stepForm, ul#stepForm li {
    margin: 0;
    padding: 0;
  }
  ul#stepForm li {
    list-style: none outside none;
  } 
  label{margin-top: 10px;}
  .help-inline-error{color:red;}
</style>

<!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?=base_url('bootstrap/css/bootstrap.min.css')?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="<?=base_url('plugins/font-awesome/css/font-awesome.min.css')?>">
  <!-- Image preview -->
  <!-- <link rel="stylesheet" type="text/css" href="<?=base_url('plugins/imagepreview/imgpreview.css')?>"> -->

  <link href="<?=base_url('plugins/select2/select2.min.css')?>" rel="stylesheet" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url('dist/css/AdminLTE.min.css')?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url('dist/css/skins/_all-skins.min.css')?>">
  <!-- jQuery 2.2.0 -->
  <script src="<?=base_url('plugins/jQuery/jQuery-2.2.0.min.js')?>"></script>

  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
  <script type="text/javascript" src="<?=base_url('plugins/confirmationDialog/bootstrap.min.js')?>"></script>
  <!-- <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/css/bootstrap-dialog.min.css">--> 
  <link rel="stylesheet" type="text/css" href="<?=base_url('plugins/confirmationDialog/bootstrap-dialog.min.css')?>">  
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.9/js/bootstrap-dialog.min.js"></script>-->
  <script type="text/javascript" src="<?=base_url('plugins/confirmationDialog/bootstrap-dialog.min.js')?>"></script>

  <!-- ./wrapper 
  <script src="<?=base_url('plugins/select2/select2.full.min.js')?>" type="text/javascript"></script>-->
  <script type="text/javascript">
    // $(".select2").select2();
  </script>

<link href="<?=base_url('datatable/media/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" >
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.css')?>" rel="stylesheet" />

<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
<link href="<?=base_url('plugins/step/step.css')?>" rel="stylesheet" />

<div class="sia-breadcrumb noRebookPnr">
  <div class="breadcrumb-inner">
    <span class="breadcrumb-item breadcrumb-item-1 passed ">
      <span class="breadcrumb-item__info">
        <span class="number">1.</span>
        <span class="text">&nbsp;Product</span>
        <em class="ico-breadcrumb"></em>
      </span>
    </span>
    <span class="breadcrumb-item breadcrumb-item-2 passed">
      <span class="breadcrumb-item__info">
        <span class="number">2.</span>
        <span class="text">&nbsp;Pilih Unit</span>
        <em class="ico-breadcrumb"></em>
      </span>
    </span>
    <span class="breadcrumb-item breadcrumb-item-3 ">
      <span class="breadcrumb-item__info">
        <span class="number">3.</span>
        <span class="text">&nbsp;Add Customer</span>
        <em class="ico-breadcrumb"></em>
      </span>
    </span>
    <span class="breadcrumb-item breadcrumb-item-4">
      <span class="breadcrumb-item__info">
        <span class="number">4.</span>
        <span class="text">&nbsp;Payment Plan + Disc</span>
        <em class="ico-breadcrumb"></em>
      </span>
    </span>
    <span class="breadcrumb-item breadcrumbAddon breadcrumb-item-5 last">
      <span class="breadcrumb-item__info">
        <span class="number">5.</span>
        <span class="text">&nbsp;View Sch Billing</span>
        <em class="ico-breadcrumb"></em>
      </span>
    </span>
   
  </div>
</div>

      <div class=""><br>
<div class="content" >
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Pilih Unit</h3>
    </div>
    <div class="panel-body row">
      <form name="basicform" id="basicform" class="form-horizontal" method="post" action="#">
      <div class="box-body">
        <div class="form-group">
                <label class="col-sm-2 control-label">Product</label>                
                <div class="col-sm-7">
                    <?php
                      foreach($product as $row)
                      {
                        $var ='<label class="radio-inline">';
                        $var.=' <input type="radio" id="'.$row->product_cd.'" name="product" value="'.$row->product_cd.'" tabindex="-2" />'.$row->descs;
                        $var.=' </label>';
                        echo $var;
                      }  
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Property Type</label>                
                <div class="col-sm-7 ">
                  <select class="form-control chosen-select"  name="property_type" id="property_type" data-placeholder="Select Property type"></select>
                </div>
              </div>
          </div>
          <div class="box-footer">
              <input type="button" name="btnNext" id="btnNext" value="Next" class="btn btn-primary">
            </div>
      </form>      
    </div>
  </div>
</div>
</div>
      

<script type="text/javascript">
      var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
      }
      $(".chosen-select").chosen({ width: '100%'});
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
     $('input:radio[name="product"]').change(function(){
      var product_cd = $(this).val();  
      // alert(prod);
       var site_url = '<?php echo base_url("c_stepbooking/zoom_property_type")?>';
            $.post(site_url,
              {product_cd:product_cd},
              function(data,status) {
                $("#property_type").empty();
                $("#property_type").append(data);
                $("#property_type").trigger('chosen:updated');
              }
            );

     });
      $(function() {
     $('#btnNext').click(function(){
      alert('tes');
     });
   });
</script>
    