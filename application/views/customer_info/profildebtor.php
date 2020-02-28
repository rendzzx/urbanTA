<div id="profildebtor">
                    <div class="ibox-content" style="height: 450px;padding-left: 0;padding-right: 0">
                        <h3 class="m-b-xs" style="color: #1c84c6; margin-left: 20px;"><strong><?php if(!empty($databusiness)){ echo $databusiness[0]->name; } else {echo '&mdash; ';}?></strong></h3>

                        <!-- <div class="font-bold">Graphics designer</div> -->
                        <address class="m-t-md" style="margin-left: 30px;">
                            
                            <img src="<?php echo base_url('img/mobile.png')?>" style="width:20px;height: 20px;margin-bottom: 4px">&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->hand_phone; } else {echo '&mdash; ';}?><br>
                            <img src="<?php echo base_url('img/mail.png')?>" style="width:20px;height: 20px;margin-bottom: 4px">&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->email_addr;} else {echo '&mdash; ';}?><br>  
                            <img src="<?php echo base_url('img/id.png')?>" style="width:20px;height: 20px">&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo  $databusiness[0]->ic_no;} else {echo '&mdash; ';}?><br>  
                            <!-- <abbr title="Phone">P:</abbr> (123) 456-7890 -->
                            
                        </address>
                        <div id="tabs">
                            <div class="panel-heading">
                                <div class="panel-options">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-1" data-toggle="tab" style="color: #1c84c6;">Address</a></li>
                                        <li class=""><a href="#tab-2" data-toggle="tab" style="color: #1c84c6;">Mailing</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body" style="padding: 15px 0px">

                                <div class="tab-content" >
                                    <div class="tab-pane active" id="tab-1">
                                        <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)) { echo $databusiness[0]->address1; } else {echo '&mdash; ';}?><br>
                                         <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)) { echo $databusiness[0]->address2; } else {echo '&mdash; ';}?><br>  
                                         <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)) { echo $databusiness[0]->address3;} else {echo '&mdash; ';}?>&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->post_cd;} else {echo '&mdash; ';}?>

                                    </div>
                                    <div class="tab-pane" id="tab-2">

                                        <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo  $databusiness[0]->mail_addr1;} else {echo '&mdash; ';}?><br>
                                        <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo  $databusiness[0]->mail_addr2;} else {echo '&mdash; ';}?> <br>  
                                        <span class="hidden-xs">&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->mail_addr3;} else {echo '&mdash; ';}?>&nbsp;<?php if(!empty($databusiness)){ echo $databusiness[0]->post_cd;} else {echo '&mdash; ';}?>
     
                                    </div>
                                </div>

                            </div>
                            <div class="panel-heading" style="width: 100%; margin: 0 auto">
                               <table width="40%" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Unit</th>
                                                <th>Area</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($dataUnit)){ 
                                                    foreach ($dataUnit as $row) {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $row->lot_description;?></td>
                                                    <td><?php echo $row->build_up_area." m<sup>2</sup>";?></td>
                                                </tr>
                                                <?php }} else {
                                                    ?>
                                                <tr>
                                                    <td>&mdash;</td>
                                                    <td>&mdash;</td>
                                                </tr>
                                                    <?php 
                                                    }?>
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                        
                    </div> 
                    </div>