<form enctype="multipart/form-data" method="post" action="<?php echo base_url('attachment/saveBrochure')?>">
	<div class="form-group">
		<label for="userfile" class="control-label">Brochure Upload :</label>
		<input type="file" name="userfile[]" id="userfile" accept="file_extension:,.jpg,.png,.pdf" multiple="multiple">
		<input type="hidden" name="project" id="project" value="<?php echo $project?>">
	</div>
	<input type="submit" value="Upload">
<form>