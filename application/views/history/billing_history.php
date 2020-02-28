<style type="text/css">
  .radio{
    margin-right: 10px;
  }
</style>  
      <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Billing History
            <!-- <small>advanced tables</small> -->
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!-- <h3 class="box-title"></h3> -->
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <!-- 
                    <div class="row">
                      <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                          <form class="form-horizontal" method="post">
                            <label>Base On:</label>
                              <br />
                              <div class="radio"><input type="radio" name="r1" class="minimal" value="3" checked="">Ticket Open</div>
                              <div class="radio"><input type="radio" name="r1" class="minimal" value="5">Ticket Assign</div>
                              <div class="radio"><input type="radio" name="r1" class="minimal" value="4">Survey</div>
                              <div class="radio"><input type="radio" name="r1" class="minimal" value="2">Work In Progress</div>
                              <div class="radio"><input type="radio" name="r1" class="minimal" value="1">Confirm</div>
                              <div class="radio"><input type="radio" name="r1" class="minimal" value="0">Ticket Closed</div>
                              <?php //echo $list_radio ?>
                              <br /><br />
                              <button type="submit" class="btn btn-primary">Search!</button>
                              <input type="hidden" >
                              <br /><br />
                            </form>
                        </div>
                      </div>
                    </div>
                     -->
                    <div class="row"><div class="col-sm-12"><div class="table-responsive">
                      <?php
                        // if(!empty($list_billing)) {
                      ?>
                      <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                        <thead style="background:#ffa500;;">
                          <tr role="row">
                            <th class="sorting" style="width: 7px;"> #</th>
                            <th class="sorting" style="width: 24px;">Document Number</th>
                            <th class="sorting" style="width: 96px;">Doc Date</th>
                            <th class="sorting" style="width: 96px;">Due Date</th>
                            <th class="sorting" >Description</th>
                            <th class="sorting" style="width: 120px;">Periode</th>
                            <th class="sorting" style="width: 12px;">Currency</th>
                            <th class="sorting" >Amount</th>
                            <th class="sorting" >Paid</th>
                            <th class="sorting" >Outstanding</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            if (!empty($list_billing)) { 
                              echo $list_billing;
                            } else {
                              echo '<h3>Data Not Available';
                            }
                          ?>
                        </tbody>
                  <!-- </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div> -->
                    </table>
                    <?php
                      // } else {
                      //   echo '<h3>Data Not Available';
                      // }
                    ?>
                  </div></div></div><div class="row"><div class="col-sm-5"></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><?php echo $link_paging ?></div></div></div></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
     