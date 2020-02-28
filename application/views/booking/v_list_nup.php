  
<link href="<?=base_url('DataTable/media/css/jquery.dataTables.min.css')?>" rel="stylesheet" type="text/css">
<link href="<?=base_url('DataTable/media/css/dataTables.bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
<!-- <link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />  -->
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<div class="content-wrapper">
  <section class="content-header">
    <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div>
    <div class="tittle-top pull-right"><b>Surat Pemesanan</b></div>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <div align="left" class="col-sm-8"><?php if(!empty($kondisi)) echo $kondisi;?></div>
          </div>
          <div class="box-body"> 
            <div id="example_wrapper" class="dataTables_wrapper">
              <table id="example" class="display table-bordered table-striped nowrap dataTable dtr-inline">
                <thead>           
                  <tr role="row">
                    <th class="sorting_asc">NUP. No</th>
                    <th>Name</th>
                    <th>Reserve Date</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th><center>Action</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php echo $RlSalesList; ?>                  
                </tbody>
              </table>
            </div>
          </div>
        </div>                 
      </div>
    </div>
  </section>
</div>
    
<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Responsive/js/responsive.bootstrap.min.js')?>" type="text/javascript"></script>    
<script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.min.js')?>" type="text/javascript"></script>

      <script type="text/javascript">
      $(function () {
        $('#example').DataTable({
            'responsive': true,
        });
      });
      </script>
    