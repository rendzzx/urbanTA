      <div class="content-wrapper">
        <section class="content-header">
          <h1>Approval</h1>
        </section>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                  <div class="box-body">
                    <!-- <div class="table-responsive"> -->
                      <div id="example_wrapper" class="dataTables_wrapper">
                        <table id="example" class="display table-bordered table-striped nowrap dataTable dtr-inline"> 
                          <thead>
                            <tr role="row">
                              <th>Level</th>
                              <th>User</th>
                              <th>Email</th>
                              <th>Phone Cell</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php echo $appList; ?>                  
                          </tbody>
                        </table> 
                      <!-- </div> -->
                    </div>
                  </div>
                  <div class="box-footer">
                    <!-- <button class="btn btn-primary" type="button" id="btnSave" name="btnSave">Save</button> -->
                  </div>
                </div>                 
              </div>
            </div>
          </section>
        </div>

  <script type="text/javascript">
      var table;
      $(function () {
        table = $('#example').DataTable({
          // columnDefs:[{
          //   orderable: false,
          //   className: 'select-checkbox',
          //   targets: 0
          // }],
        // processing: true,
        // serverside: true,
        // ajax:'<?php echo base_url("");?>',
        // columns:[
        //  {
        //    data: "namakolom1",orderable: false, width:"10%",
        //    render: function(data, type, row) {
        //      return '<input type="checkbox" onchange="DoChange() />'
        //    }
        //  },
        //  {
        //    data: "namakolom2"
        //  }
        // ],
          // select:{
          //   style: 'multi',
          //   selector: 'td:first-child'
          //   // selector:'td:last-child'
          // },
          select: false,
          search : true,
          responsive: false,
        });
        // table
        //   .on('select', function(e, dt, type, indexes){
        //     var rowData = table.rows(indexes).data().toArray();
        //   });
      });

      function edit(data) {
        // alert(data);
        var email = $('#email'+data).val();
        var phone = $('#cellular'+data).val();
        var user = $('#user'+data).val();
        var level = $('#level'+data).val();
        // var dt = new array(user,level,email,phone);
        var dt = [user,level,email,phone];
        var site_url = "<?php echo base_url('c_rl_approval/edit/');?>";
        $.post(site_url,
          {dname:dt},
          function(data,status) {
            alert('Edit : '+status);
          }
        );
        // alert(email);
        // console.log($(this));
        // var nm = $(".open-enabled").data('level');
        // alert(nm);
        console.log(data);

      }
      </script>
    