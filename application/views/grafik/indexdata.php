

<div id="sumary">
      <?php if(!empty($Listdata)||!empty($Listdata2)){ ?>
        <div class="ibox float-e-margins" id="reports">
            <div class="ibox-title" align="center">
                <div style="font-size: 14px"><strong><?php echo $nama_project?></strong></div>
                <div><strong><u>NUP Sales By Product</u></strong></div>
            </div>
            <div class="ibox-content">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                    <div class="ibox float-e-margins" id="reports">
                     

                        <div class="ibox-content" >
                            <div class="table-responsive">
                            <table class="table table-bordered" style="border-color: black">
    
                                <tbody >
                            
                                
                                    <?php echo $Listdata; ?>
                                
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>

               <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        
                            <div class="table-responsive">
                            <table class="table table-bordered">
                             
                                <tbody>
                            
                                <tr>
                                    
                                     <?php echo $Listdata2; ?>

                                </tr>
                                
                                </tbody>
                            </table>
                            </div>
                       
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } else{ ?>
      <p style="text-align: center;font-size: 20px;font-weight: bold">No Data Available</p>
    <?php } ?>
      </div>
