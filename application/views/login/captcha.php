<div class="form-group" id="divCaptLogin" name="divCaptLogin">
        <div><?php if(!empty($image)){ echo $image;}?> 
          <button type="button" class="btn btn-success pull-right" onclick="reload_captcha();" style="margin-top:0px;">
            <i class="glyphicon glyphicon-refresh"></i>
          </button>
        </div>
        
        <input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/>
        <!-- <a id="tryNewCaptcha" href="javascript:__doPostBack()">Can't Read? Try different code.</a> -->
      </div>