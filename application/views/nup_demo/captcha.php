<div class="form-group" id="captha_panel" name="captha_panel">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-7" id="captDiv" name="captDiv">
                              <?php if(!empty($image)){ echo $image;}?><br>

                              <a href="#" onclick="reload_captcha();">Refresh</a>
                              <input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/>
                            </div>
                        </div>		          
     <div class="col-sm-10" hidden="hidden" id="btnDiv" name="btnDiv">
        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>				        
     </div>
   </div>