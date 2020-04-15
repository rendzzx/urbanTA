<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/simple-line-icons/style.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/fonts/line-awesome/css/line-awesome.min.css')?>">

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row"></div>
        <div class="content-body"> 
            <div class="row">
                <?= $module; ?>       
            </div>
        </div>
    </div>
</div>

<script>
    function gotodash(groupdash) {
        window.location.href = "<?php echo base_url('administrator/gotodash/')?>"+btoa(groupdash);
    }
</script>