	<div class="content-wrapper">
        <section class="content-header">
          <h1>
            Hand Over Unit
          </h1>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                  <div class="box-body"> 
	                  <div id="example_wrapper" class="dataTables_wrapper">
	                    <table id="example" class="display table-bordered table-striped nowrap dataTable dtr-inline">
	                      <thead>
	                        <tr>
	                          <th>Unit</th>
	                          <th>CS Name</th>
	                          <th>Sales Date</th>
	                          <th>Sales Agent</th>
	                          <th width="20">Action</th>
	                        </tr>
	                      </thead>
	                      <tbody>
	                          <?php echo $ClaimList; ?>                  
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

      <script type="text/javascript">
      $(function () {
        $('#example').DataTable({
          "responsive": true,
          // "paging": true,
          // "lengthChange": true,
          // "searching": true,
          // "ordering": false,
          // "info": true,
          // "autoWidth": true
        });
      });
      </script>
      
