<div class="content-wrapper" style="min-height: 221px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Service Charge
      <!-- <small>Admin The Energy</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Service Charge</li>
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
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>ticket/saveServ">
                 <div class="box-body">
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Work Order</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php echo $complain->report_no?>' name="workorder" readonly="readonly" />  
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Service</label>
                      <div class="col-sm-10">
                        <!-- <input type="text" class="form-control" value='<?php echo $complain->complain_no; ?>' name="ticket_num" readonly="readonly" />   -->
                        <select name="serv_no" id="serv_no" class="form-control">
                          <?php echo $combo_serv; ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Duration</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php echo $duration; ?>' name="duration" readonly="readonly" />
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
                      <label for="inputName3" class="col-sm-2 control-label">Rate</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="rateprice" id="rateprice" readonly="readonly" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Base Amount</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="baseamt" id="baseamt" readonly="readonly" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Tax Amount</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="taxamt" id="taxamt" readonly="readonly" />
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Total Amount</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="totalamt" id="totalamt" readonly="readonly" />
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
  $("#serv_no").change(function() {
    var serv_no = $(this).find(':selected').val();
    if(serv_no!=='' && serv_no!='-- Choose --') {
      var site_url = '<?php echo base_url("ticket/get_service") ?>';
      $.post(site_url,
        {
          complain_no: $(this).find(':selected').val()
        }
        ,
        function(data,status){
          // alert("Data: " + data+ "\nStatus: "+status);
          var complain = JSON.parse(data);
          var serv_rate = parseFloat(complain[0].labour_rate);
          $("#rateprice").val(serv_rate);
          $("#baseamt").val(serv_rate);
          $("#tax").val(complain[0].tax_cd);
          $("#tax").change();
        }
      );
    } else {
      console.log("No Service Selected");
    }
  });

  $("#tax").change(function() {
    var tax_cd = $(this).find(':selected').val();
    var taxrate = $("#tax option:selected").data("rate");
    var servrate = $("#rateprice").val();
    var baseamt = $("#baseamt").val();
    var taxamt = (parseFloat(taxrate) * parseFloat(baseamt) ) / 100;
    var totalamt = parseFloat(taxamt) + parseFloat(baseamt);
    if(isNaN(taxamt)) {
      console.log("0.0");
    } else {
      console.log(taxamt);
    }
    $("#taxamt").val(taxamt);
    $("#totalamt").val(totalamt);
  });
</script>