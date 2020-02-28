      <div class="content-wrapper">
        <section class="content-header">
          <h1>
            Booking Entry
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Sales Booking</a></li>
            <li><a href="#"> Booking</a></li>
          </ol>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                  <div class="box-body">
                  <a href="<?php echo base_url("c_rl_sales"); ?> " class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Create New</a>
                        <!-- <a href="<?php echo base_url(); ?> " >
                        <input type = "button" value = "Print SP" class = "btn btn-primary"></a> -->
                  </div><!-- /.box-header -->
                  <div class="box-body"> 
                  <!-- <div class="table-responsive">  -->             
                    <table id="bookList" class="table table-bordered table-striped dataTable">
                      <thead>           
                        <tr>
                          <!-- <th style="width: 10px" class ="">No.</th> -->
                          <th>SP No.</th>
                          <th>Name</th>
                          <th>Unit</th>
                          <th>Sales Price</th>
                          <th>Sales Status</th>
                          <th>Sales Date</th>
                          <th><center>Action</center></th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php echo $RlSalesList; ?>                  
                      </tbody>
                      <!-- <tfoot>
                        <tr>
                        <td colspan = "8" align = "right">
                          <?php echo $paging ?>
                        </td>
                        </tr>
                      </tfoot> -->
                    </table> 
                    <!-- </div> -->
                  </div>
                </div>                 
              </div>
            </div>
          </section>
        </div>

      <script type="text/javascript">
      $(function () {
        $('#bookList').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": false,
          "autoWidth": false,
          "fixedColumns": true
        });
      });
      </script>
    