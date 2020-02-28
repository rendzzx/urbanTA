<div class="row border-bottom white-bg Dashboard-header">   
    <div class="col-sm-12">
      
       <h2>Management Dashboard<h2>
      
      <font color="#B00909" face="ARIAL" size="4">
        
      </font>
    </div> 
         
</div>
<div class="row">      
      <div class="col-sm-12">
        <div class="wrapper wrapper-content">
          <div class="row">           
           
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Approved NUP-The Nove Nuvasa Bay</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barApprove" height="270"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>UnApproved NUP-The Nove Nuvasa Bay</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barNonApprove" height="270"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title" style="height:20px">
                            <h5>NUP Quantity group by Lead Batam-The Nove Nuvasa Bay</h5>
                            
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barBatam" height="320"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>NUP Quantity group by Agent Type (%)-The Nove Nuvasa Bay</h5>

                        </div>
                        <div class="ibox-content">
                            <!-- <div>
                                <canvas id="inhouseChart" height="140"></canvas>
                            </div> -->
                            <div>
                                <canvas id="inhouseChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>NUP Amount group by Agent Type (%)-The Nove Nuvasa Bay</h5>

                        </div>
                        <div class="ibox-content">
                            <!-- <div>
                                <canvas id="inhouseChart" height="140"></canvas>
                            </div> -->
                            <div>
                                <canvas id="amtchart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>NUP Quantity group by Nationality-The Nove Nuvasa Bay</h5>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <canvas id="barProvince" height="280px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
             
                 
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




// var data = {
//                 series: [5, 3,9]
//             };

//             var sum = function(a, b) { return a + b };

//             new Chartist.Pie('#ct-chart5', data, {
//                 labelInterpolationFnc: function(value) {
//                     return Math.round(value / data.series.reduce(sum) * 100) + '%';
//                 }
//             });
</script>