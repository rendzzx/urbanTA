<div class="content-wrapper" style="min-height: 221px;">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Ticket Assignment
      <!-- <small>Admin The Energy</small> -->
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Ticket Assignment</li>
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
            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo base_url(); ?>ticket/save">
                 <div class="box-body">
                  <!-- 
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Work Order</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php //echo $number; ?>' name="angka" readonly="readonly" />  
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Ticket Number</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php echo $complain->complain_no; ?>' name="ticket_num" readonly="readonly" />  
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Ticket Type</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php echo $tickettp; ?>' name="ticket_type" readonly="readonly" />
                        <!-- <select name="ticket_type" id="ticket_type" class="form-control" readonly="1">
                          <option>-- Choose --</option>
                          <option value="C">Complain</option>
                          <option value="R">Request</option>
                        </select>   -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Tenant </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php echo $complain->debtor_acct; ?>' name="tenant_no" readonly="readonly" />
                        <!-- <select name="tenant_no" id="tenant_no" class="form-control">
                          <?php echo $combo_tenant; ?>
                        </select>   -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Unit  </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php echo $complain->lot_no; ?>' name="lot_no" readonly="readonly" />
                        <!-- <select name="lot_no" id="lot_no" class="form-control">
                          <?php echo $combo_lot; ?>
                        </select>   -->
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Floor</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value='<?php //echo $floor; ?>' name="floor"id="floor" readonly="readonly" />  
                      </div>
                    </div> -->
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Location</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $complain->location?>" name="location" />  
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Requested By</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $complain->serv_req_by?>" name="req_by" />  
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Contact No</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $complain->contact_no?>" name="contact_no" />  
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputName3" class="col-sm-2 control-label">Category </label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?php echo $category->descs?>" name="category" />
                        <!-- <select name="category" id="category" class="form-control"><?php echo $combo_category; ?></select>   -->
                      </div>
                    </div>
                    <div class="form-group">
                     <label for="inputPos3" class="col-sm-2 control-label">Description</label>
                     <div class="col-sm-10">
                       <textarea class="form-control" rows="3" placeholder="Complain Description" name="description"><?php echo $complain->work_requested ?></textarea>
                     </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPos3" class="col-sm-2 control-label">Assign To</label>
                      <div class="col-sm-10">
                        <select name="assignto" id="assignto" class="form-control"><?php echo $combo_staff?></select>                        
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label for="InputFile1" class="col-sm-2 control-label">Picture</label>
                      <div class="col-sm-10">
                      <input type="file" class="form_control" id="InputFile1" name="picture">
                    </div>
                 </div> -->
                 <!-- /.box-body -->
                 <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <input type="hidden" name="entity" id="entity" value="<?php echo $complain->entity_cd?>" /><input type="hidden" name="project" id="project" value="<?php echo $complain->project_no?>" />
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