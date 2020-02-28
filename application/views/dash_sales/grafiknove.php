<div class="row border-bottom white-bg dashboard-header">   
<script src="<?=base_url('js/plugins/chartJs/Chart.min.js')?>"></script>
    
    <div class="col-sm-12 control-label">
                <h5 for="pl_project" class="col-sm-2 control-label" style="padding-left:0px; font-size: 15px;font-family: Arial;color:black"> Choose Project</h5>
                <font size="2"><div class="col-sm-5">
                    <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;">
                      <option value=""></option>    
                      <?php 
                            echo $data_project;
                      ?>   
                          
                  </select>
                  
              </div></font>
             
              <div class="col-sm-5 control-label">
       
                <b><div style="font-size: 24px;text-align: right;padding-left: 50px;font-family: Arial;color:black">Management Dashboard Sales</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
    </div>
   
 </div> 
         

<div class="row"   id="chartt"> 
<br>
   <!-- <div style="height: 60px; padding-top: 15px; line-height: 2.3em;
    display: inline-block;border-bottom: #1ab394 2px solid; font-size:18px; width: 95%;margin-left: 22px;">
                
              <div class="control-label pull-left">
       
                <b><div style="font-size: 19px;text-align: right;padding-left: 25px;padding-top: 0px; ">Property Summary</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
    </div> -->     
      <div class="col-sm-12">
        <div class="wrapper wrapper-content">
            <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                <b>Property Summary</b>
            </div><br>
          <!-- <div class="row">   -->
          <div class="col-lg-6">
          <div class="ibox float-e-margins">
          <div class="ibox-title">
          <h5 >Property by Status</h5>
          </div>
          <div class="ibox-content" style="padding-bottom: 50px; padding-top: 10px;">
                <div class="table-responsive">
          
                        <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" >
                                       
                            <thead>            
                                <th>Property</th>
                                <th>Status</th>
                                <th style="text-align: right">Amount</th>
                                
                            </thead>
                            <tbody>
                                <?php $tt=''; $ts='';
                                    foreach ($listproduct as $key => $value) {
                                       
                                        $tt = $value->product_descs;
                                   
                                   $a ='';
                                $a.='<tr>';
                                   $a.='<td>';
                                  
                                        if($tt!=$ts){
                                            $a.= $value->product_descs;
                                        }else{
                                            $a.= ' ';
                                        }

                                        $ts = $tt;
                                   $a.='</td>';

                                    $a.='<td>';
                                        $wr='';
                                        if($value->STATUS=="A"){
                                            $wr='label label-primary';
                                        }else if ($value->STATUS=="H"){
                                           $wr='label label-info';
                                        }
                                        else if ($value->STATUS=="B"){
                                           $wr='label label-danger';
                                        }

                                        $a.='<span class="'.$wr.'">'.$value->status_descs.'</span>';
                                   $a.='</td>';

                                   $a.='<td style="text-align: right">';
                                        $a.= number_format($value->amount);
                                    
                                   $a.='</td>';
                                $a.='</tr>';
                                    
                                    echo $a;

                                } ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            </div>
            </div>
          
                <?php

                if(empty($js2))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment</h5>';
                    // $ht.='<h5>Apartment by Amount ddd</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;">';
                    $ht.='<div>';
                    // $ht.='<canvas id="aptamtchart" height="160" width="120"></canvas>';
                    $ht.='<div id="aptamtchart" height="160" width="120" style="position: fixed;"></div>';
                    // $ht.='<div style="font-size: 14px;"><b>Apartment by Amount</b></div>';

                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                <?php

                if(empty($js4))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px; padding-top:0px;padding-bottom:10px;">';
                    $ht.='<div>';
                    // $ht.='<canvas id="lndamtchart" height="160" width="120"></canvas>';
                    $ht.='<div id="lndamtchart" height="160" width="120"></div>';
                    // $ht.='<div style="font-size: 14px;"><b>Landed by Amount</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>
        <!-- </div> --> 
          </div>
        </div>
        
        <!-- <div style="height: 60px; line-height: 2.3em;
    display: inline-block;border-bottom: #1ab394 2px solid; font-size:18px; width: 95%;margin-left: 22px;">


          <div class="control-label pull-left">

            <b><div style="font-size: 19px;text-align: right;padding-left: 25px;padding-top: 15px; ">Sales per Payment Scheme</div></b>

            <font color="#B00909" face="ARIAL">

            </font>
        </div>

    </div> -->
            <div class="col-sm-12">
        <div class="wrapper wrapper-content">
        <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                <b>Sales per Payment Scheme</b>
            </div><br>
          <!-- <div class="row">  -->

                <?php

                if(empty($js11))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    // $ht.='<div class="ibox-title" style="width:1000px; position:relative;">';
                    $ht.='<h5>Apartment by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="paymentaptqty" height="360" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Apartment by Quantity</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                <?php

                if(empty($js9))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="paymentlndqty" height="360" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Landed by Quantity</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                <?php

                if(empty($js12))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="paymentaptamt" height="360" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Apartment by Amount</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                <?php

                if(empty($js10))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="paymentlndamt" height="360" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Landed by Amount</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>
<!-- </div> -->
</div></div>
            <!-- <div style="height: 60px; line-height: 2.3em;
    display: inline-block;border-bottom: #1ab394 2px solid; font-size:18px; width: 95%;margin-left: 22px;">
                
             
              <div class="control-label pull-left">
       
                <b><div style="font-size: 19px;text-align: right;padding-left: 25px;padding-top: 15px; ">Top 10 Sales Agent</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
            </div> -->
            <div class="col-sm-12">
                <div class="wrapper wrapper-content">
                <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                <b>Top 10 Sales Agent</b>
            </div><br>
                    <div class="col-lg-4">
          <div class="ibox float-e-margins">
          <div class="ibox-title">
          <h5>Sales Agent</h5>
          </div>
          <div class="ibox-content" style="padding-bottom: 0px; padding-top: 10px; padding-left: 10px; padding-right: 10px;">
                <div class="table-responsive">
          
                        <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" >
                                       
                            <thead>            
                                <th>No</th>
                                <th>Agent Name</th>
                                <!-- <th>Principal</th> -->
                                <th>Sold Qty</th>
                                <th align="center">Sold Amount</th>
                                
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($Top10Agent as $key => $value) {                                   
                                   $a ='';
                                   
                                   $a.='<tr>';
                                        $a.='<td>';
                                        $a.= $no;
                                        $a.='</td>';

                                        $a.='<td>';
                                        $a.= $value->agent_name;
                                        $a.= ' ('.$value->group_name.')';
                                        $a.='</td>';

                                        // $a.='<td>';
                                        // $a.= $value->group_name;
                                        // $a.='</td>';

                                        $a.='<td>';
                                        $a.= $value->total_sell_qty;
                                        $a.='</td>';

                                        $a.='<td align="center">';
                                        
                                        $a.= number_format($value->total_sell_amt);
                                        $a.='</td>';

                                    $a.='</tr>';
                                    echo $a;
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
            </div>
            </div>
            </div>

                 <?php
                if(empty($jtop10agent))
                {
                    echo '';
                }
                else
                {

                    $ht='';
                    $ht.='<div class="col-lg-8" style="padding-left:0px;">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-left:5px;padding-bottom:20px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptAmtAgent" height="440px" width="250px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>

                </div>
            </div>

                <!-- <div style="height: 60px; line-height: 2.3em;
    display: inline-block;border-bottom: #1ab394 2px solid; font-size:18px;width: 95%;margin-left: 22px;">
                
             
              <div class="control-label pull-left">
       
                <b><div style="font-size: 19px;text-align: right;padding-left: 25px;padding-top: 15px; ">Sales per Inhouse vs External</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
            </div> -->
            <div class="col-sm-12">
        <div class="wrapper wrapper-content">
        <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                <b>Sales per Inhouse vs External</b>
            </div><br>
          <!-- <div class="row">  -->

                <!-- inhouse ext -->
                
                <?php

                if(empty($js13))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    // $ht.='<div class="ibox-title" style="width:1000px; position:relative;">';
                    $ht.='<h5>Apartment by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="salesinqtyapt" height="160" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Apartment by Quantity</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                 <?php

                if(empty($js14))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="salesinqtylnd" height="160" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Landed by Quantity</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                <?php

                if(empty($js15))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="salesinamtapt" height="160" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Apartment by Amount</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                <?php

                if(empty($js16))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="salesinamtlnd" height="160" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Landed by Amount</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>
<!-- </div> -->
</div></div>
                <!-- <div style="height: 60px; line-height: 2.3em;
    display: inline-block;border-bottom: #1ab394 2px solid; font-size:18px; width: 95%;margin-left: 22px;">
                
             
              <div class="control-label pull-left">
       
                <b><div style="font-size: 19px;text-align: right;padding-left: 25px;padding-top: 15px; ">Sales per Lead Agent</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
            </div> --> 
            <div class="col-sm-12">
        <div class="wrapper wrapper-content">
        <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                <b>Sales per Lead Agent</b>
            </div><br>
          <!-- <div class="row">  -->

                <?php

                if(empty($js19))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    // $ht.='<div class="ibox-title" style="width:1000px; position:relative;">';
                    $ht.='<h5>Apartment by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="leadaptqty" height="360" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Apartment by Quantity</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                 <?php

                if(empty($js20))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="leadlndqty" height="360" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Landed by Quantity</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                <?php

                if(empty($js17))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="leadaptamt" height="360" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b></b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                 <?php

                if(empty($js18))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-3">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 8px;">';
                    $ht.='<div>';
                    $ht.='<canvas id="leadlndamt" height="360" width="120"></canvas>';
                    // $ht.='<div style="font-size: 14px;"><b>Landed by Amount</b></div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                
               
                 
        <!-- </div> -->
    </div>
  </div> 
 <!-- batesssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss -->
 <div class="col-sm-12">
        <div class="wrapper wrapper-content">
          <!-- <div class="row">   -->
          
              <?php
                if(empty($js21))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Sales Amount grouped by Apartment Floor</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptAmt" height="300px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
        
            <?php
                if(empty($js22))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Sales Quantity  grouped by Apartment Floor</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptQty" height="300px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
          

                <?php
                if(empty($js23))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Sales Amount grouped by Landed Blok</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barLndAmt" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
            
                <?php
                if(empty($js24))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Sales Quantity grouped by Landed Blok</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barLndQty" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
                <!-- </div> -->
          </div>
        </div>
  <!--       <div class=" white-bg dashboard-header">  -->  
    
    <!-- <div class="col-sm-12 control-label row border-bottom white-bg" style="height: 60px;"> -->
    <!-- <div style="height: 60px; line-height: 2.3em;
    display: inline-block;border-bottom: #1ab394 2px solid; font-size:18px;width: 95%;margin-left: 22px;"   >
            
             
              <div class="control-label pull-left">
       
                <b><div style="font-size: 19px;text-align: right;padding-left: 25px;padding-top: 15px; ">Sales Grouped by Nationality</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
    </div> -->
   
 <!-- </div>  -->
        <div class="col-sm-12">
        <div class="wrapper wrapper-content">
        <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                <b>Sales Grouped by Nationality</b>
            </div><br>
          <!-- <div class="row">  -->
                <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js25))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptQtyN" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js27))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div style="max-height:500px">';
                    $ht.='<canvas id="barLndQtyN" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
                
       
                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js26))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptAmtN" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>

                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js28))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barLndAmtN" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
              <!-- </div> -->
          </div>
        </div>
            <!-- <div  style="height: 60px; line-height: 2.3em;
    display: inline-block;border-bottom: #1ab394 2px solid; font-size:18px; width: 95%;margin-left: 22px;"   >
                
             
              <div class="control-label pull-left">
       
                <b><div style="font-size: 19px;text-align: right;padding-left: 25px;padding-top: 15px; ">Sales Grouped by City</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
    </div> -->
        <div class="col-sm-12">
        <div class="wrapper wrapper-content">
        <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                <b>Sales Grouped by City</b>
            </div><br>
          <!-- <div class="row">  -->
                 <!-- ~~~~~~~~~~~~~~~~batas nationality~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js29))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptQtyC" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js31))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barLndQtyC" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
            
          
                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js30))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptAmtC" height="400px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js32))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barLndAmtC" height="400px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
                <!-- </div> -->
          </div>
        </div>
                 <!-- <div  style="height: 60px; line-height: 2.3em;
    display: inline-block;border-bottom: #1ab394 2px solid; font-size:18px; width: 95%;margin-left: 22px;"   >
                
             
              <div class="control-label pull-left">
       
                <b><div style="font-size: 19px;text-align: right;padding-left: 25px;padding-top: 15px; ">Sales Grouped by Unit Type</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
    </div> -->
        <div class="col-sm-12">
        <div class="wrapper wrapper-content">
        <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                <b>Sales Grouped by Unit Type</b>
            </div><br>
          <!-- <div class="row">  -->
                <!-- ~~~~~~~~~~~~~~~wkwkkw~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js33))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptQtyLT" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js35))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barLndQtyLT" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
          
                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js34))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Apartment by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptAmtLT" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
                    <!-- ~~~~~~~~~~~~~~~~batas~~~~~~~~~~~~~~ -->
                 <?php
                if(empty($js36))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Landed by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barLndAmtLT" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>
        <!-- </div> -->
    </div>
  </div>
 <!--   <script src="<?=base_url('js/plugins/c3/c3.js')?>" type="text/javascript"></script> 
 <script src="<?=base_url('js/plugins/d3/d3.min.js')?>" type="text/javascript"></script> 
 <link href="<?=base_url('css/plugins/c3/c3.css')?>" rel="stylesheet">  -->
<style type="text/css">
    .label-primary{
        background-color: #80d82d;
    }
    .label-info{
        background-color: #2fb4ed;
    }
    .label-danger{
        background-color: #e82020;
    }
</style>
<script type="text/javascript">
// console.log('otnay');
<?=$jsp?>
<?=$js1?>
<?=$js2?>
<?=$js3?>
<?=$js4?>

<?=$jtop10agent?>
<?=$js9?>
<?=$js10?>
<?=$js11?>
<?=$js12?>
<?=$js13?>
<?=$js14?>
<?=$js15?>
<?=$js16?>
<?=$js17?>
<?=$js18?>
<?=$js19?>
<?=$js20?>
<?=$js21?>
<?=$js22?>
<?=$js23?>
<?=$js24?>
<?=$js25?>
<?=$js26?>
<?=$js27?>
<?=$js28?>
<?=$js29?>
<?=$js30?>
<?=$js31?>
<?=$js32?>
<?=$js33?>
<?=$js34?>
<?=$js35?>
<?=$js36?>





var url = '';
    $('#txt_Pl_Project').select2();
    var report = document.getElementById("chartt");
$('#txt_Pl_Project').on("change",function(e){
    // alert('a'); 
    // alert('fot');
    var project = $(this).find(':selected').val();
      console.log(project);
      if(project == ''){
        swal('Information','Please Choose Project ','warning');
        return;
      }else{
        // document.getElementById('loader').hidden=false;
        
      if(project==''){
        report.style.visibility="hidden";
    } else {
        window.location.href="<?php echo base_url('Dash_sales/index')?>/"+project;
        report.style.visibility="visible";
    }
        // document.getElementById('loader').hidden=true;
        
      }
 });

</script>
