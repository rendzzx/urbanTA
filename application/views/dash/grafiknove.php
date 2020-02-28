<div class="row border-bottom white-bg dashboard-header">   
    
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
       
                <b><div style="font-size: 24px;text-align: right;padding-left: 50px;font-family: Arial;color:black">Management Dashboard NUP</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
    </div>
   
 </div> 
         

<div class="row"   id="chartt">      
      <div class="col-sm-12">
        <div class="wrapper wrapper-content">
          <div class="row">  
      
<!--                    <?php  
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
                   ?>  -->

                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Approved NUP</h5>
                        </div>
                        <div class="ibox-content">
                            <?php  
                              if(empty($js))
                                {
                                    echo'';
                                }
                            else
                                { 
                                    $ht ='';
                                 
                                    $ht .='<div>';
                                    $ht .='<canvas id="barApprove" height="150"></canvas>';
                                    $ht .='</div>';
                           
                                    echo $ht;
                                }
                           ?> 
                        </div>
                    </div>
                </div>
<!--                 <?php 

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

                ?> -->


            <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>UnApproved NUP</h5>
                        </div>
                        <div class="ibox-content" >
                                            <?php 

                    if (empty ($js2)) 
                        {
                           echo '';

                        }
                    else
                        {
                            $ht ='';
            
                            $ht .='<div>';
                            $ht .='<canvas id="barNonApprove" height="150"></canvas>';
                            $ht .='</div>';
        
                            
                            echo $ht;
                        }

                ?>
                        </div>
                    </div>
                </div>


                <?php

                if(empty($js5))
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

                if(empty($js6))
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

                if(empty($js7))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.=' <div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>NUP Quantity group by City</h5>';
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
<!-- 
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>NUP Quantity group by Nationality</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barNationality" height="280px"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->
                
            <!-- </div> -->
          
             <!--  <?php
                if(empty($js8))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Sales Apartment by Amount</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptAmt" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?> -->
            
           <!--  <?php
                if(empty($js9))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Sales Apartment by Quantity</h5>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content">';
                    $ht.='<div>';
                    $ht.='<canvas id="barAptQty" height="280px"></canvas>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;

                }
                ?> -->

               <!--  <?php
                if(empty($js10))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Sales Landed by Amount</h5>';
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
                ?> -->

                <!-- <?php
                if(empty($js11))
                {
                    echo '';
                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-12">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<h5>Sales Landed by Quantity</h5>';
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
                ?> -->
                 
        </div>
    </div>
  </div> <br>
 
<script type="text/javascript">

<?=$jsp?>
<?=$js?> 
<?=$js2?>   
<?=$js3?>
<?=$js4?>
<?=$js5?>
<?=$js6?>
<?=$js7?>




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
        window.location.href="<?php echo base_url('Dash/index')?>/"+project;
        report.style.visibility="visible";
    }
        // document.getElementById('loader').hidden=true;
        
      }
 });


</script>