<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>" type="text/javascript"></script>
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-left"><b><?php echo $projectName; ?></b></div>
            <div class="tittle-top pull-right"><b>Booking</b></div>
        </div>
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
            <!-- next start -->
                <div class="ibox-content">
                <form class="wizard-big wizard clearfix" role="application" id="form">
                <div class="steps clearfix">
                    <ul role="tablist">
                      <li class="first done" role="tab" aria-disabled="false" aria-selected="false">
                        <a id="form-t-0" href="#form-h0" aria-controls="form-p-0">
                          <span class="current-info audible">current step: </span>
                          <span class="number">1. </span>
                          Product
                        </a>
                      </li>
                      <li class="done" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">2. </span>
                          Pilih Unit
                        </a>
                      </li>
                      <li class="done" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h2" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">3. </span>
                          Add Customer
                        </a>
                      </li>
                      <li class="done" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h3" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">4. </span>
                          Payment Plan + Disc
                        </a>
                      </li>
                      <li class="current" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h4" aria-controls="form-p-1">
                          <span class="current-info audible">current step: </span>
                          <span class="number">5. </span>
                          Finish
                        </a>
                      </li>
                    </ul>
                  </div>
                  </form>
                        <div class=""><br>
                  <div class="content" >
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title">Product</h3>
                      </div>
                      <div class="panel-body row">
                        <form name="basicform" id="basicform" class="form-horizontal" method="post" action="#">
                        <div class="box-body">
                          <h2>Step 5 of 5</h2>
                            <div class="text-center animated fadeInRight" style="margin-top: 120px">
                              <h2>Finished :-)</h2>
                            </div>
                            </div>
                            <div class="box-footer col-sm-12">
                              <!-- <div class="form-group"> -->
                                <!-- <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-primary"> -->
                                <input type="button" name="btnNext" id="btnNext" value="Finish" class="btn btn-primary">              
                                <!-- <input type="button" name="btntes" id="btntes" value="Tes" class="btn btn-primary"> -->
                              <!-- </div> -->
                            </div>
                        </form>     
                      
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>           



      

<script type="text/javascript">

     $('#btnNext').click(function(){
      
      window.location.href = "<?php echo base_url('c_stepbooking/indexNew')?>";
     });

   
</script>
    