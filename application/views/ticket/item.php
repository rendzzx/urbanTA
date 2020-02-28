<div class="content-wrapper" style="min-height: 221px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Item Material
      <!-- <small>Admin The Energy</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Item Material</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-8">
        <div class="box box-info">
          <div class="box-header with-border">
            <!-- <h3 class="box-title">Ticket Assignment</h3> -->
          </div><!-- /.box-header -->
          <?php echo $data['error']; ?>
          <div class="box-body">
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>ticket/saveItem">
                 <div class="box-body">
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Work Order</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php echo $complain->report_no; ?>' name="workorder" readonly="readonly" />  
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Item </label>
                      <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" value='<?php echo $complain->complain_no; ?>' name="ticket_num" readonly="readonly" />   -->
                        <select name="item_no" id="item_no" class="form-control">
                          <?php echo $combo_item; ?>
                        </select>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Location</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="location" />
                        <select name="location" id="location" class="form-control">
                          <?php echo $combo_location; ?>
                        </select>
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Quantity</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="1" name="qty" id="qty" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Tax</label>
                      <div class="col-sm-10">
                        <select name="tax" id="tax" class="form-control">
                          <?php echo $combo_tax; ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Unit Price</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php echo $unitprice; ?>' name="unitprice" id="unitprice" readonly="readonly" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Base Amount</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="0" name="baseamt" id="baseamt" readonly="readonly" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Tax Amount</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="0" name="taxamt" id="taxamt" readonly="readonly" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Total Amount</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="0" name="totalamt" id="totalamt" readonly="readonly" />
                      </div>
                    </div>
                 <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <input type="hidden" name="entity" id="entity" value="<?php echo $complain->entity_cd?>" />
                  <input type="hidden" name="project" id="project" value="<?php echo $complain->project_no?>" />
                  <input type="hidden" name="complain" id="complain" value="<?php echo $complain->complain_no?>" />
                </form>
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
<script type="text/javascript">
  // $(function(){
  //   var item_no = $("#item_no").find(':selected').val();
  //   $("#item_no").change();
  // });
  $("#qty").change(function() {
    var qty = $(this).val();
    var unitprice = $("#unitprice").val();
    var taxrate = $("#tax option:selected").data("rate");
    // var taxamt = $("#taxamt").val();
    // taxamt = parseFloat(taxamt) * qty;
    console.log(taxamt);
    var baseamt = parseFloat(unitprice) * qty;
    var taxamt = (parseFloat(taxrate) * parseFloat(baseamt) ) / 100;
    var totalamt = parseFloat(taxamt) + baseamt;
    // $("#taxamt").empty();
    $("#baseamt").val(parseFloat(baseamt));
    $("#taxamt").val(taxamt);
    $("#totalamt").val(parseFloat(totalamt));
    // console.log(baseamt);
  });

  $("#item_no").change(function() {
    var item_no = $(this).find(':selected').val();
    var qty = $("#qty").val();
    console.log(item_no);
    if(item_no!=='' && item_no!='-- Choose --') {
      var site_url = '<?php echo base_url("ticket/get_item") ?>';
      $.post(site_url,
        {
          complain_no: $(this).find(':selected').val()
        }
        ,
        function(data,status){
          var complain = JSON.parse(data);
          // $("#tax").empty();
          // alert("Data: " + data+ "\nStatus: "+status);
          // console.log(data);
          // console.log(complain);
          // console.log(complain[0].tax_cd);
          // console.log(complain[0].charge_amt);
          var baseamt = parseFloat(complain[0].charge_amt) * qty;
          $("#unitprice").val(parseFloat(complain[0].charge_amt));
          $("#baseamt").val(baseamt);
          $("#tax").val(complain[0].tax_cd);
          $("#tax").change();
        }
      );
    } else {
      console.log("No Item Selected");
      // $("#tax").empty();
    }
  });

  $("#tax").change(function() {
    var tax_cd = $(this).find(':selected').val();
    var taxrate = $("#tax option:selected").data("rate");
    var unitprice = $("#baseamt").val();
    var qty = $("#qty").val();
    // console.log(unitprice);
    // console.log(taxrate);
    var taxamt = (parseFloat(taxrate) * parseFloat(unitprice) ) / 100;
    var totalamt = parseFloat(taxamt) + parseFloat(unitprice);
    if(isNaN(taxamt)) {
      console.log("0.0");
    } else {
      console.log(taxamt);
    }
    $("#taxamt").val(taxamt);
    $("#totalamt").val(totalamt);
  });
</script>
