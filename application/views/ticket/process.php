<div class="content-wrapper" style="min-height: 221px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ticket Process
      <!-- <small>Admin The Energy</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Ticket Process</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- <h3 class="box-title">Ticket Open</h3> -->
          </div><!-- /.box-header -->
          <div class="box-body">
            <?php 
              if(!empty($list_helpdesk)) {
            ?>
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                  <tr>
                    <th style="width: 7px;"> No</th>
                    <th style="width: 24px;">Ticket Number</th>
                    <th style="width: 24px;">Work Order</th>
                    <th style="width: 100px;">Category</th>
                    <th >Description</th>
                    <th style="width: 100px;">Reported Date</th>
                    <th style="width: 24px;">Request By</th>
                    <th style="width: 80px;">Lot No</th>
                    <th style="width: 10px;">Ticket Status</th>
                    <th style="width: 10px;">Action</th>
                    <!-- <th>Action</th> -->
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    if (!empty($list_helpdesk)) {
                      echo $list_helpdesk;
                    }
                  ?>
                </tbody>
              </table>
            </div><!-- /.table-responsive -->
            <?php 
              } else {
                echo "Data Not Available";
              }
            ?>
          </div><!-- /.box-body -->
          <div class="box-footer clearfix">
            <!-- <a href="<?php echo site_url() ?>/helpdesk/new_helpdesk/" class="btn btn-sm btn-info btn-flat pull-left">New Ticket</a> -->
            <!-- <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
          </div><!-- /.box-footer -->
        </div><!-- /.box -->
      </div> <!-- /.col -->
    </div> <!-- /.row -->
  </section><!-- /.content -->
</div>  