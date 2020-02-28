<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/line-awesome/css/line-awesome.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
    </div>
    <div class="content-body"> 
     <div class="row">
        <!-- <div class="col-xl-4 col-lg-6 col-12" onclick="gotodash('TAM')">
            <div class="card btn btn-bg-gradient-x-blue-cyan box-shadow-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="align-self-top">
                                <i class="la la-building icon-opacity text-white font-large-4 float-left"></i>
                            </div>
                            <div class="media-body text-white text-right align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Office Tower</span>
                                <h1 class="text-white mb-0">O+</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-12" onclick="gotodash('OTM')">
            <div class="card btn btn-bg-gradient-x-orange-yellow box-shadow-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-white text-left align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Overtime</span>
                                <h1 class="text-white mb-0">OT</h1>
                            </div>
                            <div class="align-self-top">
                                <i class="icon-tag icon-opacity text-white font-large-4 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-xl-4 col-lg-6 col-12" onclick="gotodash('CSM')">
            <div class="card btn btn-bg-gradient-x-blue-cyan box-shadow-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-white text-left align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Customer Service</span>
                                <h1 class="text-white mb-0">CSM</h1>
                            </div>
                            <div class="align-self-top">
                                <i class="icon-earphones-alt icon-opacity text-white font-large-4 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-12" onclick="gotodash('MUM')">
            <div class="card btn btn-bg-gradient-x-red-pink box-shadow-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-white text-left align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Meter Utilities</span>
                                <h1 class="text-white mb-0">MU</h1>
                            </div>
                            <div class="align-self-top">
                                <i class="icon-speedometer icon-opacity text-white font-large-4 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-12" onclick="gotodash('AM')">
            <div class="card btn btn-bg-gradient-x-blue-green box-shadow-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-white text-left align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">Approval Management</span>
                                <h1 class="text-white mb-0">AM</h1>
                            </div>
                            <div class="align-self-top">
                                <i class="ft-check-square icon-opacity text-white font-large-4 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <div class="col-xl-4 col-lg-6 col-12" onclick="gotodash('SA')">
            <div class="card btn btn-bg-gradient-x-purple-red box-shadow-3">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-white text-left align-self-bottom mt-3">
                                <span class="d-block mb-1 font-medium-1">System Administration</span>
                                <h1 class="text-white mb-0">SA</h1>
                            </div>
                            <div class="align-self-top">
                                <i class="icon-users icon-opacity text-white font-large-4 float-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <?php echo $module;?>
       
    </div>
<!-- end of content -->
    </div>
  </div>
</div>
   
 
        <br>

<script type="text/javascript">
  function gotodash(groupdash) {
    // alert(groupdash);
    window.location.href = "<?php echo base_url('administrator/gotodash/')?>"+btoa(groupdash);
  }
</script>