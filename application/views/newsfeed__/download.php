
			<div style="margin-top: 3%;margin-bottom: 5%">
			  <img class="img-responsive" src="<?php echo base_url('img/NewsFeed/pdf-icon.png')?>" alt="pdf-icon.png" width="50px">
			  <?php echo $file_name;?><br><br>
              Click this button to download file <br><br>
              <button id="btnYes" type="button" class="btn btn-danger" onclick="Download();">Download</button>
              <br> <br>
              </div>

<script type="text/javascript">
	function Download()
	{
		 var pdfname = $('#modalpdf').data('namapdf');
		 window.location.href="<?php echo base_url('newsfeed/download')?>/"+pdfname;
	}
</script>

