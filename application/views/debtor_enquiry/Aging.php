<?php 
$current ='';$day1='';$day2='';$day3='';$day4='';$day5='';$day6='';$day7='';$total='';
if(!empty($dtAging)){
  foreach ($dtAging as $key) {
      $current = (float)$key->current_day;
      $day1= (float)$key->day1_amt;
      $day2= (float)$key->day2_amt;
      $day3= (float)$key->day3_amt;
      $day4= (float)$key->day4_amt;
      $day5= (float)$key->day5_amt;
      $day6= (float)$key->day6_amt;
      $day7= (float)$key->day7_amt;
      $total =$day1+$day2+$day3+$day4+$day5+$day6+$day7;
  }  
} else {
$current = 0;
      $day1= 0;
      $day2= 0;
      $day3= 0;
      $day4= 0;
      $day5= 0;
      $day6= 0;
      $day7= 0;
      $total =0;

} ?>
<?php foreach ($ageData as $key) {
       $age1 = "1 - ".$key->age1." Days";
       $age2 = ($key->age1+1)." - ".$key->age2." Days";
       $age3 = ($key->age2+1)." - ".$key->age3." Days";
       $age4 = ($key->age3+1)." - ".$key->age4." Days";
       $age5 = ($key->age4+1)." - ".$key->age5." Days";
       $age6 = ($key->age5+1)." - ".$key->age6." Days";
       $age7 = $key->age6." Days";
                                } ?>
<div id="tab-3" class="tab-pane">
      <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                      <fieldset>
                          <legend>Aging</legend>
                          <div class="table-responsive">
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4" style="text-align:center;">Aging Criteria</label>
                                                    <label class="col-sm-4" style="text-align:right;">Amount</label>
                                                </div><br>
                                                <div class="form-group"> 
                                                    <div class="row">                                               
                                                      <?php if(number_format($current,2) > 0){ ?>
                                                            <label class="col-sm-4 btn btn-primary" onclick="fn_detail('current')">Current</label>
                                                      <?php } else { ?>
                                                            <label class="col-sm-4 btn btn-primary" disabled>Current</label>
                                                      <?php } ?>                                                    
                                                      <!-- <button type="button" onclick="fn_detail('current')" class="btn btn-primary">Detail</button>  -->
                                                        <div class="col-sm-4">
                                                          <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="business_id" name="business_id" value="<?php echo number_format($current,2) ?>" />                                                     
                                                        </div>  
                                                    </div>
                                                     <!-- <div class="col-sm-5">
                                                        <button type="button" onclick="fn_detail('current')" class="btn btn-primary">Detail</button>  
                                                    </div> -->                         
                                                </div><br><br>
                                                <div class="form-group">  
                                                  <div class="row">                                               
                                                    <?php if(number_format($day1,2) > 0){ ?>
                                                          <label class="col-sm-4 btn btn-primary" onclick="fn_detail('day1')"><?php echo $age1 ?></label>
                                                    <?php } else { ?>
                                                          <label class="col-sm-4 btn btn-primary" disabled><?php echo $age1 ?></label>
                                                    <?php } ?>

                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="category" name="category" value="<?php echo number_format($day1,2) ?>"/>    
                                                    </div>
                                                  </div>
                                                    <!-- <div class="col-sm-5">
                                                        <button type="button" onclick="fn_detail('day1')" class="btn btn-primary">Detail</button>  
                                                    </div> -->                     
                                                </div><br><br>
                                                <div class="form-group">
                                                  <div class="row">
                                                    <?php if(number_format($day2,2) > 0){ ?>
                                                          <label class="col-sm-4 btn btn-primary" onclick="fn_detail('day2')"><?php echo $age2 ?></label>
                                                    <?php } else { ?>
                                                          <label class="col-sm-4 btn btn-primary" disabled><?php echo $age2 ?></label>
                                                    <?php } ?>                                                
                                                    
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="add_2" name="add_2" value="<?php echo number_format($day2,2) ?>"/>    
                                                    </div>
                                                  </div> 
                                                    <!-- <div class="col-sm-5">
                                                        <button type="button" onclick="fn_detail('day2')" class="btn btn-primary">Detail</button>  
                                                    </div> -->                                                                              
                                                </div><br><br>
                                                <div class="form-group">
                                                  <div class="row">
                                                    <?php if(number_format($day3,2) > 0){ ?>
                                                          <label class="col-sm-4 btn btn-primary" onclick="fn_detail('day3')"><?php echo $age3 ?></label>
                                                    <?php } else { ?>
                                                          <label class="col-sm-4 btn btn-primary" disabled><?php echo $age3 ?></label>
                                                    <?php } ?>  

                                                    
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="add_3" name="add_3" value="<?php echo number_format($day3,2) ?>"/>    
                                                    </div>
                                                  </div>
                                                    <!-- <div class="col-sm-5">
                                                        <button type="button" onclick="fn_detail('day3')" class="btn btn-primary">Detail</button>  
                                                    </div>   -->                                                                              
                                                </div><br><br>
                                                <div class="form-group">
                                                  <div class="row">
                                                    <?php if(number_format($day4,2) > 0){ ?>
                                                          <label class="col-sm-4 btn btn-primary" onclick="fn_detail('day4')"><?php echo $age4 ?></label>
                                                    <?php } else { ?>
                                                          <label class="col-sm-4 btn btn-primary" disabled><?php echo $age4 ?></label>
                                                    <?php } ?>

                                                    
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="post_cd" name="post_cd" value="<?php echo number_format($day4,2) ?>"/>    
                                                    </div>
                                                  </div>
                                                    <!-- <div class="col-sm-5">
                                                        <button type="button" onclick="fn_detail('day4')" class="btn btn-primary">Detail</button>  
                                                    </div>  -->                                                                               
                                                </div><br><br>
                                                <div class="form-group">
                                                  <div class="row">
                                                    <?php if(number_format($day5,2) > 0){ ?>
                                                          <label class="col-sm-4 btn btn-primary" onclick="fn_detail('day5')"><?php echo $age5 ?></label>
                                                    <?php } else { ?>
                                                          <label class="col-sm-4 btn btn-primary" disabled><?php echo $age5 ?></label>
                                                    <?php } ?>

                                                    
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="tel_no" name="tel_no"
                                                        value="<?php echo number_format($day5,2) ?>"/>    
                                                    </div>
                                                  </div>
                                                    <!-- <div class="col-sm-5 btn-primary">
                                                        <button type="button" onclick="fn_detail('day5')" class="btn btn-primary">Detail</button>  
                                                    </div>  -->                                                                               
                                                </div><br><br>
                                                <div class="form-group">
                                                  <div class="row">
                                                    <?php if(number_format($day6,2) > 0){ ?>
                                                          <label class="col-sm-4 btn btn-primary" onclick="fn_detail('day6')"><?php echo $age6 ?></label>
                                                    <?php } else { ?>
                                                          <label class="col-sm-4 btn btn-primary" disabled><?php echo $age6 ?></label>
                                                    <?php } ?>

                                                    
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="fax_no" name="fax_no"
                                                        value="<?php echo number_format($day6,2) ?>"/>    
                                                    </div>
                                                  </div>
                                                    <!-- <div class="col-sm-5">
                                                        <button type="button" onclick="fn_detail('day6')" class="btn btn-primary">Detail</button>  
                                                    </div>  -->                                                                               
                                                </div><br><br>
                                                <div class="form-group">
                                                  <div class="row">                                                
                                                    <?php if(number_format($day7,2) > 0){ ?>
                                                          <label class="col-sm-4 btn btn-primary" onclick="fn_detail('day7')">><?php echo $age7 ?></label>
                                                    <?php } else { ?>
                                                          <label class="col-sm-4 btn btn-primary" disabled>><?php echo $age7 ?></label>
                                                    <?php } ?>

                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="fax_no" name="fax_no" value="<?php echo number_format($day7,2) ?>"/>    
                                                    </div>
                                                    <!-- <div class="col-sm-5">
                                                        <button type="button" onclick="fn_detail('day7')" class="btn btn-primary">Detail</button>  
                                                    </div> --> 
                                                  </div>                                                                               
                                                </div><br><br>
                                                <div class="form-group">
                                                  <div class="row">                                                
                                                    <label class="col-sm-4">Total Outstanding</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" style = "text-align:right; border:0px; background-color:white;" readonly="true" id="fax_no" name="fax_no" value="<?php echo number_format($total,2) ?>"/>    
                                                    </div>
                                                  </div>
                                                    <!-- <div class="col-sm-5">
                                                        <button type="button" onclick="fn_detail('total')" class="btn btn-primary">Detail</button>  
                                                    </div>  -->                                                                               
                                                </div>
                        </div>
                      </fieldset>
                </div>
           </div>
      </div>
</div>