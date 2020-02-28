	<div class="content-wrapper">
        <section class="content-header">
          <h1>
            Claim Form
          </h1>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
              <div class="box">
                <div class="box-body">
                <strong>
                  <p><span>Unit </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $unit; ?> </p>
                  <p><span>Name </span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $name; ?>  </p>
                  <p><span>Log Number </span>&nbsp; : <?php echo $no_com; ?>  </p>
                  <p><span>ST Date  </span>&nbsp;&nbsp;&nbsp; : <?php echo $date; ?>  </p>
                </strong>
                </div>
              </div>
                  <div class="box-body">
	                  <div id="example_wrapper" class="dataTables_wrapper">
	                    <table id="example" class="display table-bordered table-striped nowrap dataTable dtr-inline">
	                      <thead>
	                        <tr bgcolor="#4682B4">
	                          <th width="4%">No</th>
	                          <th>Locations</th>
	                          <th>Descriptions</th>
                            <th width="10%">Estimation Date</th>
	                        </tr>
	                      </thead>
	                      <tbody>
	                          <?php echo $ClaimList; ?>                  
	                      </tbody>
	                    </table> 
                      <hr size="12px">
                      <p><span><strong>All claims have been completed and accepted</strong></span></p>
                      <hr size="12px">
                      <p><span><strong>Record </strong></span> :</p>
                      <hr size="12px">
                      <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Signature</th>
                        <th></th>
                        <th></th>
                      </tr>
	                  </div>
                  </div>
                </div>                 
              </div>
            </div>
          </section>
        </div>

      <!-- <script type="text/javascript">
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
      </script> -->
      
