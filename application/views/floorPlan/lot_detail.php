              <?php 
              /*if ($status=="Available") 
              {
                $button = "<div class='box-footer'>";
                $button.= "<a href='".base_url()."C_rl_sales/index/".$lot_no[0]->lot_no."'><button type='submit' name='booking' class='btn btn-success pull-right'>Booking</button></a></div>";
              }else{
                $button = "";
              }*/
              ?>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
      Lot Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Floor Plan </a></li>
        <li><a href="#">Floor List</a></li>
        <li class="active"><a href="#">Lot Detail</a></li>      
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-sm-12">
          <div class="box">
            <div class="box-body">
            <div class="form-horizontal"> 
              <div class="form-group">
                <label class="col-sm-2 control-label">Tower</label>
                <div class="col-sm-9">
                <input type="text" name="tower" readonly="1" class="form-control" value="<?php echo $property_descs; ?>">
                <input type="hidden" name="tower" readonly="1" class="form-control" value="<?php echo $lot_no[0]->property_cd; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Unit No</label>
                <div class="col-sm-9">
                <input type="text" name="unit_no" readonly="1" class="form-control" value="<?php echo $lot_no[0]->lot_no.' - '.$lot_no[0]->descs; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-9">
                <input type="text" name="status" readonly="1" class="form-control" value="<?php echo $status; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Unit Type</label>
                <div class="col-sm-9">
                <input type="text" name="type" readonly="1" class="form-control" value="<?php echo $type;   ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Block</label>
                <div class="col-sm-9">
                <input type="text" name="block" readonly="1" class="form-control" value="<?php echo $lot_no[0]->block_no; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Level</label>
                <div class="col-sm-9">
                <input type="text" name="level" readonly="1" class="form-control" value="<?php echo $level_descs; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Net Area</label>
                <div class="col-sm-9">
                <input type="text" name="net_area" readonly="1" class="form-control" value="<?php echo $lot_no[0]->build_up_area; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Base Area</label>
                <div class="col-sm-9">
                <input type="text" name="base" readonly="1" class="form-control" value="<?php echo $lot_no[0]->land_area; ?> M &sup2;">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Selling Price</label>
                <div class="col-sm-9">
                <input type="text" name="selling" readonly="1" class="form-control" value="<?php echo number_format( $dataCount,0,",","."); ?>">
                </div>
              </div>
              <?php
              if ($status=="Available") 
              {
                $button = "<div class='box-footer'>";
                $button.= "<a href='".base_url()."C_rl_sales/index/".$lot_no[0]->lot_no."'><button type='submit' name='booking' class='btn btn-success pull-right'>Booking</button></a></div>";
              }else{
                $button = "";
              } 
              echo $button; 
              ?>
              <!-- </table> -->
              </div>
            </div>
          </div>
        </div>      
      </div>         
    </section>
  </div>

    

     


    