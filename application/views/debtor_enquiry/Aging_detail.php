<?php foreach ($ageData as $key) {
       $age1 = "1 - ".$key->age1." Days";
       $age2 = ($key->age1+1)." - ".$key->age2." Days";
       $age3 = ($key->age2+1)." - ".$key->age3." Days";
       $age4 = ($key->age3+1)." - ".$key->age4." Days";
       $age5 = ($key->age4+1)." - ".$key->age5." Days";
       $age6 = ($key->age5+1)." - ".$key->age6." Days";
       $age7 = "> ".$key->age6." Days";
                                }
  if($amt=='current'){
        $title = 'Current Day';
      } else if($amt=='day1') {
       $title = $age1;
      } else if($amt=='day2') {
        $title = $age2;
      } else if($amt=='day3') {
        $title = $age3;
      } else if($amt=='day4') {
        $title = $age4;
      } else if($amt=='day5') {
        $title = $age5;
      } else if($amt=='day6') {
        $title = $age6;
      } else if($amt=='day7') {
        $title = $age7;
      } else if($amt=='total') {
        $title = 'Total Outstanding';
      }
?>
<?php 
$docdate ='';$duedate='';$docno='';$trx='';$amount='';$title='';
if(!empty($dtAging)){
  foreach ($dtAging as $key) {
    $docdt = date_create($key->doc_date);
    $duedt = date_create($key->due_date);
      $docdate =  date_format($docdt,"d/m/Y");
      $duedate=  date_format($duedt,"d/m/Y");
      $docno=  $key->doc_no;
      $trx=  $key->decs;
      if($amt=='current'){
        $amount=  $key->current_day;
        $title = 'Current Day';
      } else if($amt=='day1') {
        $amount=  $key->day1_amt;
       $title = $age1;
      } else if($amt=='day2') {
        $amount=  $key->day2_amt;
        $title = $age2;
      } else if($amt=='day3') {
        $amount=  $key->day3_amt;
        $title = $age3;
      } else if($amt=='day4') {
        $amount=  $key->day4_amt;
        $title = $age4;
      } else if($amt=='day5') {
        $amount=  $key->day5_amt;
        $title = $age5;
      } else if($amt=='day6') {
        $amount=  $key->day6_amt;
        $title = $age6;
      } else if($amt=='day7') {
        $amount=  $key->day7_amt;
        $title = $age7;
      } else if($amt=='total') {
        $amount=  (float)$key->current_day+(float)$key->day1_amt+(float)$key->day2_amt+(float)$key->day3_amt+(float)$key->day4_amt+(float)$key->day5_amt+(float)$key->day6_amt+(float)$key->day7_amt;
        $title = 'Total Outstanding';
      }
      
      
  }  
} else {
      $docdate = '';
      $duedate= '';
      $docno= '';
      $trx= '';
      $amount= 0;
      $title='';
      

} ?>
            <div class="row" hidden="hidden">
                <div class="col-xs-12">
                      <fieldset>
                          <legend><?php echo $title ?> Detail</legend>
                          <div class="table-responsive">
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Document Date</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="business_id" name="business_id" value="<?php echo $docdate ?>" /> 
                                                    </div>                          
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Due Date</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="category" name="category" value="<?php echo $duedate ?>"/>    
                                                    </div>
                                                                        
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Document No.</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="add_2" name="add_2" value="<?php echo $docno ?>"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4">Trx Description</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="add_3" name="add_3" value="<?php echo $trx ?>"/>    
                                                    </div>                                                                               
                                                </div>
                                                <div class="form-group">                                                
                                                    <label class="col-sm-4"><?php echo $title ?></label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="post_cd" name="post_cd" value="<?php echo number_format($amount,2) ?>"/>    
                                                    </div>                                                                               
                                                </div>
                                                
                        </div>
                      </fieldset>
                </div>
           </div>

           <!-- <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data"> -->
              <div class="box-body">
                 <div class="table-responsive">
                      <table id="tblAccountDetail" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                          <thead>            
                                <th class="sorting_asc">Document Date</th>
                                <th>Due Date</th>
                                <th>Document No.</th>
                                <th >Trx Description</th>
                                <th width="200px" style="text-align: right"><?php echo $title ?></th>
                          </thead>
                          <tbody>
                          
                           <?php 
                          if(!empty($dtAging)){
                            foreach ($dtAging as $key) {?>
                            <tr>
                                <?php $docdt = date_create($key->doc_date);?>
                                <?php $duedt = date_create($key->due_date);?>
                                <td><?php echo date_format($docdt,"d/m/Y");?></td>
                                <td><?php echo date_format($duedt,"d/m/Y");?></td>
                                <td><?php echo $key->doc_no;?></td>
                                <td><?php echo $key->decs;?></td>
                                <td style="text-align: right"><?php
                                      if($amt=='current'){
                                        echo number_format($key->current_day,2);
                                        $total[] = $key->current_day;
                                       
                                      } else if($amt=='day1') {
                                        echo number_format($key->day1_amt,2);
                                        $total[] = $key->day1_amt;
                                      
                                      } else if($amt=='day2') {
                                        echo number_format($key->day2_amt,2);
                                        $total[] = $key->day2_amt;

                                      } else if($amt=='day3') {
                                        echo number_format($key->day3_amt,2);
                                        $total[] = $key->day3_amt;
                                    
                                      } else if($amt=='day4') {
                                        echo number_format($key->day4_amt,2);
                                        $total[] = $key->day4_amt;
                                 
                                      } else if($amt=='day5') {
                                        echo number_format($key->day5_amt,2);
                                        $total[] = $key->day5_amt;
                                      
                                      } else if($amt=='day6') {
                                        echo number_format($key->day6_amt,2);
                                        $total[] = $key->day6_amt;
                             
                                      } else if($amt=='day7') {
                                        echo number_format($key->day7_amt,2);
                                        $total[] = $key->day7_amt;
                                      
                                      } else if($amt=='total') {
                                        $amount=  (float)$key->current_day+(float)$key->day1_amt+(float)$key->day2_amt+(float)$key->day3_amt+(float)$key->day4_amt+(float)$key->day5_amt+(float)$key->day6_amt+(float)$key->day7_amt;
                                        echo number_format($amount,2);
                                        $total[] = $amount;
                                      }?></td></tr>
                             
                                <?php 
                                      } //end of foreach
                                      } else {?>
                                      <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>0</td>
                                   <?php $total[]=0;}?> 
                           
                            
                          </tr>
                          </tbody>
                          <tfoot>
                            <th style="text-align: right" colspan="4">Total : </th>
                            <th style="text-align: right"><?php echo number_format(array_sum($total),2);?></th>
                          </tfoot>
                          <!-- <tfoot style="font-weight: bold;background-color: #f2f2f2">
                                <th style="font-weight: bold;" colspan="5" align="center">Total</th>
                                 <th>Doc Date</th>
                                <th>Ref No</th>
                                <th>Trx Type</th>
                                <th>Description</th>
                                <th></th>
                                <th></th>
                        </tfoot>  -->
                      </table>
                  </div>
              </div>   
              <div class="modal-footer">
                  <!-- <button type="button" id="btnSave" class="btn btn-primary">Save</button> -->
                  <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
              </div>
          <!-- </form> -->
