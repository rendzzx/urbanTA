	
  <div id="nup_listing_div">
    <?php if(!empty($isi_table)){ ?>
      <div class="ibox float-e-margins" id="reports" >
        <div class="ibox-title" align="center" >
          <div style="font-size: 14px"><strong><?php echo $nama_project?></strong></div>
          <div><strong><u>NUP Listing</u></strong></div>
        </div>
        
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox-content">
              <table class="table" style="width:800px;" align="center">
                <?php echo $isi_table?>
              </table>
            </div>
          </div>
        </div>
      </div>
    <?php } else{ ?>
      <p style="text-align: center;font-size: 20px;font-weight: bold">No Data Available</p>
    <?php } ?>
 </div>
