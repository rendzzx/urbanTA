<div class="content-wrapper" style="min-height: 221px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            My Work In Progress Ticket
          </h1>
          <ol class="breadcrumb">
            <li><!-- <a href="#"> --><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Work In Progress Ticket</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <!-- MAP & BOX PANE -->
              <div class="row">
              </div><!-- /.row -->

            <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-body">
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                      <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                          <form class="form-horizontal" method="post">
                          </form>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                          <thead>
                            <tr role="row">
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-label="CSS grade: activate to sort column ascending" style="width: 110px;">No.</th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">No. Ticket</th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">Judul</th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">Isi</th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">Tenant Profile</th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">Problem Picture</th>
                              <!-- <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 177px;">Status</th> -->
                              <!-- <th colspan = "2" style="text-align:center;">Action</th></tr> -->
                            </tr>
                          </thead>
                          <tbody>
                            <?php if (!empty($list_close)) { ?>
                            <?php echo $list_close ?>
                            <?php } else { ?>
                            <h3>Database kosong.</h3>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
              </div>
                </div><!-- /.box-body -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
            </div><!-- /.col -->
           
          </div>
        </section>
      </div>