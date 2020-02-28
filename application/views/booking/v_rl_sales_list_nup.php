
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables/jquery.dataTables.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables/dataTables.bootstrap.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables/select.dataTables.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables/dataTables.responsive.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables/extensions/responsive/responsive.bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables/extensions/responsive/responsive.dataTables.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('plugins/datatables/extensions/responsive/responsive.jqueryui.min.css')?>">


      <div class="content-wrapper">
        <section class="content-header">
          <div class="tittle-top">
            <?php echo $ProjectDescs; ?>
          </div>          
          <ol class="breadcrumb">
            <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Sales Booking</a></li>
            <li><a href="#"> NUP</a></li> -->
            <li><span class="tittle-top">Surat Pemesanan</span></li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                  <div class="box-body">
                  <!-- <a href="<?php echo base_url("c_rl_sales_list_nup"); ?> " class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create New</a> -->
                    <div align="left" class="col-sm-8"><?php if(!empty($kondisi)) echo $kondisi;?></div>
                    <!-- <div align="right" class="col-sm-4">
                      <font size="5"><strong>Surat Pemesanan</strong></font>
                    </div> -->
                        <!-- <a href="<?php echo base_url(); ?> " >
                        <input type = "button" value = "Print SP" class = "btn btn-primary"></a> -->
                  </div><!-- /.box-header -->
                  <div class="box-body"> 
                  <div id="example_wrapper" class="dataTables_wrapper">
                  <!-- <div class="display nowrap dataTable dtr-inline"> -->
                  <!-- <div class="table-responsive">  -->             
                    <!-- <table id="example" class="table table-bordered table-striped dataTable"> -->
                    <table id="example" class="display table-striped nowrap dataTable dtr-inline">
                    <!-- <table id="example" class="display" cellspacing="0" width="100%"> -->
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
                    <!-- </div> -->
                    </div>
                    <!-- </div> -->
                  </div>
                </div>                 
              </div>
            </div>
          </section>
        </div>
    <script src="<?php echo base_url('plugins/datatables/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('plugins/datatables/dataTables.select.min.js')?>"></script>
    <script src="<?php echo base_url('plugins/datatables/dataTables.responsive.min.js')?>"></script>
    <script src="<?php echo base_url('plugins/datatables/extensions/responsive/js/dataTables.responsive.min.js')?>"></script> -->

      <script type="text/javascript">
      $(function () {
        $('#example').DataTable();
      });
      </script>
    