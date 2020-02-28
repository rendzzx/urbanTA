      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Billing Schedule
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li> -->
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                  <div class="box-header">
                    <!-- <h3 class="box-title">Billing Schedule</h3><br> -->
                    Customer Name : <?php echo $name; ?> <br>
                    Unit No. : <?php echo $lotno; ?>
                    <?php //echo base_url(); ?>
                  </div><!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class = "table-responsive">
                      <table class="table table-striped">                    
                      <thead>
                        <tr>
                          <!-- <th style="width: 10px">No.</th> -->
                          <th>Bill Date</th>
                          <th>Trx Type</th>
                          <th>Description</th>
                          <th class="text-right">Tax Amount</th>
                          <th class="text-center">Currency</th>
                          <th class="text-right">Trx Amount</th>
                          <th style="width: 40px">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php echo $PmBillSch; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                            <td colspan = "4" align = "left">
                              <a href="<?php echo base_url("c_rl_sales_list"); ?> "><input type = "button" value = "Back" class="btn btn-primary"></a>&nbsp
                              <a href="<?php echo base_url('c_reports/jp/'.$debtor.'/'.$lotno); ?>" target="_blank"><input type="button" value="Print" class="btn btn-warning"></a>
                            </td>
                            <!-- <td colspan = "4" align = "right">
                              <?php echo $paging ?>
                            </td> -->
                        </tr>
                      </tfoot> 
                    </table>
                    </div>                    
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->      
          </div><!-- /.col -->          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper