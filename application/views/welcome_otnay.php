<div class="row border-bottom white-bg dashboard-header">   
    
    <div class="col-sm-12 control-label">
                <h5 for="pl_project" class="col-sm-2 control-label" style="padding-left:0px; font-size: 15px;"> Choose Project</h5>
                <font size="2"><div class="col-sm-5">
                    <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;">
                      <option value=""></option>    
                      <?php 
                            echo $data_project;
                      ?>   
                          
                  </select>
                  
              </div></font>
             
              <div class="col-sm-5 control-label">
       
                <b><div style="font-size: 24px;text-align: right;padding-left: 50px;">Management Dashboard NUP</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
    </div>
   
 </div> 
         

<div class="row"   id="chartt">      
      <div class="col-sm-12">
        <div class="wrapper wrapper-content">
          <div class="row">  
                
           <?php  
              if(empty($js))
                {
                    echo'';
                }
            else
                { 
                    $ht ='';
                    $ht .='<div class="col-lg-6">';
                    $ht .='<div class="ibox float-e-margins">';
                    $ht .='<div class="ibox-title">';
                    $ht .='<h5>Approved NUP</h5>';
                    $ht .='</div>';
                    $ht .='<div class="ibox-content">';
                    $ht .='<div>';
                    $ht .='<canvas id="barApprove" height="150"></canvas>';
                    $ht .='</div>';
                    $ht .='</div>';
                    $ht .='</div>';
                    $ht .='</div>';
                    echo $ht;
                }
           ?> 
                <!-- <div class="col-lg-6"> -->
                    <!-- <div class="ibox float-e-margins"> -->
                        <!-- <div class="ibox-title"> -->
                            <!-- <h5>Approved NUP</h5> -->
                        <!-- </div> -->
                        <!-- <div class="ibox-content"> -->
                            <!-- <div> -->
                                <!-- <canvas id="barApprove" height="150"></canvas> -->
                            <!-- </div>
                        </div>
                    </div>
                </div> -->
                <?php 

                    if (empty ($js2)) 
                        {
                           echo '';

                        }
                    else
                        {
                            $ht ='';
                            $ht .='<div class="col-lg-6">';
                            $ht .='<div class="ibox float-e-margins">';
                            $ht .='<div class="ibox-title">';
                            $ht .='<h5>UnApproved NUP</h5>';
                            $ht .='</div>';
                            $ht .='<div class="ibox-content">';
                            $ht .='<div>';
                            $ht .='<canvas id="barNonApprove" height="150"></canvas>';
                            $ht .='</div>';
                            $ht .='</div>';
                            $ht .='</div>';
                            $ht .='</div>';
                            
                            echo $ht;
                        }

                ?>


            <!-- <div class="col-lg-6"> -->
                    <!-- <div class="ibox float-e-margins"> -->
                        <!-- <div class="ibox-title"> -->
                            <!-- <h5>UnApproved NUP</h5> -->
                        <!-- </div> -->
                        <!-- <div class="ibox-content"> -->
                            <!-- <div> -->
                                <!-- <canvas id="barNonApprove" height="150"></canvas> -->
                            <!-- </div> -->
                     <!--    </div>
                    </div>
                </div> -->


                <?php

                if(empty($js3))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>NUP Quantity group by Lead Agent</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.=' <div>';
                    $ht.=' <canvas id="barBatam" height="320"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                   
                   
                   echo $ht;
                }
                ?>

                <!-- <div class="col-lg-12"> -->
                   <!--  <div class="ibox float-e-margins">
                        <div class="ibox-title" style="height:20px">
                            <h5>NUP Quantity group by Lead Agent</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barBatam" height="320"></canvas>
                                <! <canvas id="barChartData2" height="320"></canvas> -->
                        <!--     </div>
                        </div>
                    </div>
                </div> -->

            <!-- </div> -->


                <?php
                if(empty($js4)){
                    echo '';

                }
                else{
                    $ht='';
                    $ht .='<div class="col-lg-6">';
                    $ht .=' <div class="ibox float-e-margins">';
                    $ht .=' <div class="ibox-title">';
                    $ht .=' <h5>NUP Quantity group by Agent Type (%)</h5>';
                    $ht .='</div>';
                    $ht .='<div class="ibox-content">';
                    $ht .='<div>';
                    $ht .='<canvas id="inhouseChart" height="150"></canvas>';
                    $ht .='</div>';
                    $ht .=' </div>';
                    $ht .=' </div>';
                    $ht .=' </div>';
                    echo $ht;
                }
                ?>
      
                <!-- <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>NUP Quantity group by Agent Type (%)</h5>

                        </div>
                        <div class="ibox-content"> -->
                            
                        <!--     <div>
                                <canvas id="inhouseChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->

                <?php

                if(empty($js5))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>NUP Amount group by Agent Type (%)</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="amtchart" height="150"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>

                <!-- <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>NUP Amount group by Agent Type (%)</h5>

                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="inhouseChart" height="140"></canvas>
                            </div>
                            <div>
                                <canvas id="amtchart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->

                <?php

                if(empty($js6))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.=' <div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>NUP Quantity group by City otnay</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barProvince" height="280px" width="200"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>

               <!--  <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>NUP Quantity group by City</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barProvince" height="280px"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->
                <?php
                if(empty($js7))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>NUP Quantity group by Nationality</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barNationality" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?>

                 
        </div>
    </div>
  </div> <br>
 
<script type="text/javascript">




</script>