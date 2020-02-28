<link href="<?=base_url('css/plugins/chartist/chartist.min.css')?>" rel="stylesheet">
<div class="row border-bottom white-bg dashboard-header">   
    <div class="col-sm-12">
      <h1>
        <?php echo $entityname; ?>
      </h1>
      <font color="#B00909" face="ARIAL" size="4">
        Choose Project :
      </font>
    </div>      
         
</div>
<div class="row">      
      <div class="col-sm-12">
        <div class="wrapper wrapper-content">
          <div class="row">           
            <?php echo $PlProject; ?>         
          </div>          
        </div> <br>
       <!-- <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p> -->