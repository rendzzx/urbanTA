<style type="text/css">
    input.break {
        word-wrap: break-word;
        word-break: break-all;
        height: 10px;
    }

    .ccc{
        font-weight: 100;
    }
</style>

<div id="tab-1" class="tab-pane active">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-6">
                <fieldset>
                    <legend style="border-bottom: 1px solid #e5e5e5;">Personal Details</legend>

                    <div class="form-group">                                                
                        <label class="col-sm-4">Business ID</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="business_id" name="business_id" value="<?php  if(!empty($profile)){echo $profile[0]->business_id;}else{echo '';} ?>" />    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="name" name="name" value="<?php if(!empty($profile)){echo $profile[0]->name;}else{echo '';} ?>"/>    
                            
                        </div>                                                  
                    </div>
                    <div class="form-group" hidden="hidden">                                                
                        <label class="col-sm-4">Category</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="category" name="category" value="<?php if(!empty($profile)){echo $profile[0]->category;}else{echo '';} ?>"/>    
                   
                        </div>
                        <div class="col-sm-4">
                        <!-- Category Description -->
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="category_descs" name="category_descs"/>    
                        </div>                           
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="col-sm-4">Address</label>
                        <div class="col-sm-8">
                            <textarea cols="" rows="4" type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true"><?php if(!empty($profile)){echo $profile[0]->address1;}else{echo '';} ?>&#13;&#10;<?php if(!empty($profile)){echo $profile[0]->address2;}else{echo '';} ?>&#13;&#10;<?php if(!empty($profile)){echo $profile[0]->address3;}else{echo '';} ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">                                                
                        <label class="col-sm-4">Post Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="post_cd" name="post_cd" value="<?php if(!empty($profile)){echo $profile[0]->post_cd;}else{echo '';} ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Tel No</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="tel_no" name="tel_no" value="<?php if(!empty($profile)){echo $profile[0]->tel_no;}else{echo '';} ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Fax No.</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="fax_no" name="fax_no" value="<?php if(!empty($profile)){echo $profile[0]->fax_no;}else{echo '';} ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Handphone</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="handphone" name="handphone" value="<?php if(!empty($profile)){echo $profile[0]->hand_phone;}else{echo '';} ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Sex</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="sex" name="sex" value="<?php if(!empty($profile)){echo $profile[0]->sex;}else{echo '';} ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">E-mail</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="email" name="email" value="<?php if(!empty($profile)){echo $profile[0]->email_addr;}else{echo '';} ?>" />    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Birth Date</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="birthdate" name="birthdate" value="<?php if(!empty($profile)){echo $profile[0]->birth_date;}else{echo '';} ?>"/>    
                        </div>                                                                               
                    </div>
                    <div hidden="hidden">
                    <div class="form-group">                                                
                        <label class="col-sm-4">Married</label>
                        <div class="col-sm-8">
                        <?php if(!empty($profile)){if($profile[0]->marital_status == 'Y' ){ ?> 
                            <img style="width: 30px;" src="<?=base_url('img/y.png');?>">
                        <?php } else { ?>
                            <img style="width: 30px;" src="<?=base_url('img/x.png');?>">
                        <?php } }else { echo '';}?>                            
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Nationality</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="nationality" name="nationality" value="<?php if(!empty($profile)){echo $profile[0]->nationality;}else{echo '';}  ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Tax Reg.</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="tax_reg" name="tax_reg" value="<?php if(!empty($profile)){echo $profile[0]->income_tax;}else{echo '';}  ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Interest</label>
                        <div class="col-sm-8">
                            <?php if(!empty($profile)){if($profile[0]->interest == 'Y' ){ ?> 
                                <img style="width: 30px;" src="<?=base_url('img/y.png');?>">
                            <?php } else { ?>
                                <img style="width: 30px;" src="<?=base_url('img/x.png');?>">
                            <?php } }else { echo '';}?>
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Credit Limit</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="credit_limit" name="credit_limit" value="<?php if(!empty($profile)){echo $profile[0]->credit_limit;}else{echo '';}  ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Terms</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="terms" name="terms"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Stat. Type</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true" id="stat_type" name="stat_type" value="<?php if(!empty($profile)){echo $profile[0]->statement_type;}else{echo '';}  ?>"/>    
                        </div>                                                                               
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Reminder</label>
                        <div class="col-sm-8">
                             <?php if(!empty($profile)){if($profile[0]->reminder == 'Y' ){ ?> 
                                <img style="width: 30px;" src="<?=base_url('img/y.png');?>">
                            <?php } else { ?>
                                <img style="width: 30px;" src="<?=base_url('img/x.png');?>">
                            <?php } }else {echo '';}?>
                        </div>                                                                               
                    </div></div>
                </fieldset>
            </div>                                            
            <div class="col-sm-6">  
                <fieldset>
                    <legend style="border-bottom: 1px solid #e5e5e5;">Company Details</legend>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_name" name="comp_name" value="<?php if(!empty($profile)){echo $profile[0]->co_name;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Contact</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="contact" name="contact" value="<?php if(!empty($profile)){echo $profile[0]->contact_person;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Position</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="position" name="position" value="<?php if(!empty($profile)){echo $profile[0]->designation;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <!-- <div class="form-group">                                                
                        <label class="col-sm-4">Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_1" name="comp_add_1" value="<?php if(!empty($profile)){echo $profile[0]->co_addr1;}else{echo '';} ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4"></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_2" name="comp_add_2" value="<?php if(!empty($profile)){echo $profile[0]->co_addr2;}else{echo '';} ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4"></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_add_3" name="comp_add_3" value="<?php if(!empty($profile)){echo $profile[0]->co_addr3;}else{echo '';} ?>"/>    
                        </div>                          
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-4">Address</label>
                        <div class="col-sm-8">
                            <textarea cols="" rows="4" type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true"><?php if(!empty($profile)){echo $profile[0]->co_addr1;}else{echo '';} ?>&#13;&#10;<?php if(!empty($profile)){echo $profile[0]->co_addr2;}else{echo '';} ?>&#13;&#10;<?php if(!empty($profile)){echo $profile[0]->co_addr3;}else{echo '';} ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Post Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_post_cd" name="comp_post_cd" value="<?php if(!empty($profile)){echo $profile[0]->co_post_cd;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Tel No.</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_tel_no" name="comp_tel_no" value="<?php if(!empty($profile)){echo $profile[0]->co_tel_no;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Fax No.</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_fax_no" name="comp_fax_no" value="<?php if(!empty($profile)){echo $profile[0]->co_fax_no;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group" hidden="hidden">                                                
                        <label class="col-sm-4">Home Page</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_homepage" name="comp_homepage" value="<?php if(!empty($profile)){echo $profile[0]->homepage;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <legend style="border-bottom: 1px solid #e5e5e5;">Mailing Address</legend>
                    <!-- <div class="form-group">                                                
                        <label class="col-sm-4">Address</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_1" name="comp_mailadd_1" value="<?php if(!empty($profile)){echo $profile[0]->mail_addr1;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4"></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_2" name="comp_mailadd_2" value="<?php if(!empty($profile)){echo $profile[0]->mail_addr2;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4"></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailadd_3" name="comp_mailadd_3" value="<?php if(!empty($profile)){echo $profile[0]->mail_addr3;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div> -->
                    <div class="form-group">
                        <label class="col-sm-4">Address</label>
                        <div class="col-sm-8">
                            <textarea cols="" rows="4" type="text" class="form-control" style = "border:0px; background-color:white;" readonly="true"><?php if(!empty($profile)){echo $profile[0]->mail_addr1;}else{echo '';}  ?>&#13;&#10;<?php if(!empty($profile)){echo $profile[0]->mail_addr2;}else{echo '';}  ?>&#13;&#10;<?php if(!empty($profile)){echo $profile[0]->mail_addr3;}else{echo '';}  ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">                                                
                        <label class="col-sm-4">Post Code</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" style = "border:0px; background-color:transparent;" readonly="true" id="comp_mailpost_cd" name="comp_mailpost_cd" value="<?php if(!empty($profile)){echo $profile[0]->mail_post_cd;}else{echo '';}  ?>"/>    
                        </div>                          
                    </div>
                </fieldset>                                          
            </div>
        </div>
    </div>
</div>