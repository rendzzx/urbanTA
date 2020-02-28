<div id="captha_panel" name="captha_panel">
    <div id="captDiv" name="captDiv" class="form-group col-sm-12"  style="margin-top:10px;">
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
        	<?php if(!empty($image)){ echo $image;}?><br>
        	<!-- <button type="button" class="btn btn-success pull-right" onclick="__doPostBack()">
	        	<i class="glyphicon glyphicon-refresh"></i>
	        </button> -->
	        <a href="#" onclick="reload_captcha();">reload</a>
	        <!-- <a href="" onclick="__doPostBack()">reload</a> -->
        </div>				        
      </div>
      <div id="captDivtxt" name="captDivtxt"  class="form-group col-sm-12">
      	<div class="col-sm-2">
      		
      	</div>
      	<div class="col-sm-4">
        	<input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/>	

        </div>
      </div>
      </div>		          
     <div class="col-sm-10" hidden="hidden" id="btnDiv" name="btnDiv">
        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>				        
     </div>
   </div>