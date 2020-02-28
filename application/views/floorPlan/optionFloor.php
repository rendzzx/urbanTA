  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Floor List
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Floor </a></li>
        <li class="active"><a href="#">Floor List</a></li>
      </ol> -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="table1" class="table table-bordered table-hover dataTable">
                <thead>
                  <tr>
                    <th class="col-xs-1">Floor</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>
                   <?php echo $userLevelList; ?>            
                </tbody>
              </table>
            </div>
            <div class="box-footer">
             <!--  <a href="<?php echo base_url("userlevel/entryForm"); ?>"><i class="fa fa-plus"> New Record </i></a> -->
            </div>
          </div>
        </div>      
      </div>         
    </section>
  </div>
  <?php
  ?>
  <section class="content">
    <div class="example-modal">
      <div class="modal" id="addBookDialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
          <!-- <form action="<?php base_url('OptionFloor/lotDetail'+'bookId'); ?>" method="post"> -->
              <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Unit Detail and Booking</h4>
                  </div>
                  <div class="modal-body">
                    <label> Please check lot detail or Booking </label>
                    <!-- <input type="text" name="bookId" id="bookId" class="form-control"> -->
                  </div>
                  <div class="modal-footer">
                    <a href="<?php echo base_url();?>OptionFloor/lotDetail" id="lotDetail"><button type="submit" class="btn btn-success pull-left"> Lot Detail </button></a>
                    <a href="<?php echo base_url();?>C_rl_sales/index" id="bookEntry"><button type="submit" class="btn btn-success pull-right"> Booking </button></a>
                    <!-- <button type="submit" class="btn btn-success pull-left"> Detail </button> -->
              </div>
          </div>
        </div>
      </div>
    </div>
  </session>

  <script type="text/javascript">
    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     var b1 = document.getElementById('lotDetail');
     var link1 = '<?php echo base_url('OptionFloor/lotDetail'); ?>/'+ myBookId;
     var b2 = document.getElementById('bookEntry');
     var link2 = '<?php echo base_url('C_rl_sales/index'); ?>/'+ myBookId;
     b1.setAttribute('href', link1);
     b2.setAttribute('href', link2);
     return false;
   //   $(".modal-body #bookId").val( myBookId );

   //   alert($('#bookId').val());
   //   var bookId = $('#bookId').val();
   //   var site_url = "<?php echo site_url();?>" +'/OptionFloor/sessions';

   //   $.ajax({
   //    type: "POST",
   //    url: site_url,
   //    data: { value: bookId }
   // }).done(function( msg ) {
   //    alert( "Data Saved: " + msg );
   // });

  });
  </script>


  <!-- <script type="text/javascript">
      $(function () {
        $('#table1').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": true,
          "autoWidth": false
        });
      });
  </script> -->

    

     


    