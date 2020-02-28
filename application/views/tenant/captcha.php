          <div class="form-group" id="divCaptLogin" name="divCaptLogin" alt=" " >
                  <div class="col-sm-12">
                    <div class="col-xs-4"></div>
                    <div class="col-xs-4"><?php if(!empty($cp['image'])){ echo $cp['image'];}?> 
                      <button type="button" class="btn btn-success pull-right" onclick="reload_captcha();" style="margin-top:0px; margin-right: 10px;">
                        <i class="glyphicon glyphicon-refresh"></i>
                      </button>
                    </div>
                    
                  </div>
               
                     <div class="form-group" >
                    <div class="col-sm-12">
                    <div class="col-xs-4"></div>
                        <div class="col-xs-4">
                      <input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter text above" value="<?php if(!empty($cp['userCaptcha'])){ echo $cp['userCaptcha'];} ?>"/>
                    </div>
                    </div>
                  </div>
                     </div>