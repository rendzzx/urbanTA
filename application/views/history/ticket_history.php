<style type="text/css">
  .radio{
    margin-right: 10px;
  }
</style>  
      <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Ticket History
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
                    <div class="row"><div class="col-sm-12"><div class="table-responsive"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead style="background:#ffa500;">
                      <tr role="row">
                        <th class="sorting_asc" style="width: 7px;">#</th>
                        <th class="sorting" style="width: 24px;">Ticket Number</th>
                        <th class="sorting" style="width: 24px;">Category</th>
                        <th class="sorting" >Description</th>
                        <th class="sorting" style="width: 100px;">Reported Date</th>
                        <th class="sorting" style="width: 24px;">Request By</th>
                        <th class="sorting" style="width: 80px;">Lot No</th>
                        <th class="sorting" style="width: 10px;">Ticket Status</th>
                        <th class="sorting" style="width: 80px;">Action</th>
                        <!-- <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="2" aria-label="Join Date: activate to sort column ascending" style="width: 110px; text-align:center;">Action</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <!-- <tr role="row" class="odd">
                        <td class="sorting_1">Gecko</td>
                        <td>Firefox 1.0</td>
                        <td>Win 98+ / OSX.2+</td>
                        <td>1.7</td>
                        <td>A</td>
                      </tr> -->
                      <?php 
                        if (!empty($list_ticket)) { 
                          echo $list_ticket;
                        } else {
                          echo '<h3>Database kosong.</h3>';
                        } 
                      ?>
                    </tbody>
                    <!-- <tfoot>
                      <tr><th rowspan="1" colspan="1">Tenant Name</th>
                        <th rowspan="1" colspan="1">Contact Name</th>
                        <th rowspan="1" colspan="1">Address</th>
                        <th rowspan="1" colspan="1">Phone</th>
                        <th rowspan="1" colspan="1">Join Date</th></tr>
                    </tfoot> -->
                  <!-- </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div> -->
                  </table></div></div></div><div class="row"><div class="col-sm-5"></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><?php echo $link_paging ?></div></div></div></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div>
     