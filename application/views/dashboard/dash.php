<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/line-awesome/css/line-awesome.min.css')?>">
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>"></script>
<!-- link -->

<!-- content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Choose Project :</h3>
                </div>
                <div class="content-header-right col-md-8 col-12 mb-2">
                </div>
            </div>
            <div class="content-body"> 
                <div class="row">      
                    <div class="col-sm-12" id="projects">
                        <span id="listproject">
                            <div class="row">
                                <?= $PlProject; ?>      
                            </div>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- content -->