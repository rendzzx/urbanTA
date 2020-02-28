<div id="panel3" class="col-sm-12">
	<h3>Inhouse</h3>
	<hr>
	<p>Anda akan mengisi formulir pendaftaran sebagai independent agent

		Dengan mengisi formulir pendaftaran tersebut Anda telah menyatakan diri bahwa Anda tidak terikat dengan salah satu institusi pemasaran manapun.

		Bila ternyata terbukti bahwa Anda terikat dengan salah satu institusi pemasaran, maka pihak Sinar Mas Land berhak untuk membatalkan seluruh benefit yang Anda dapat.

		Pihak Sinar Mas Land akan dibebaskan dari segala tuntutan yang timbul akibat ke tidak benaran data yang Anda berikan.</p>
	<div id="btnAgree">
		<input type="button" class="btn btn-danger" value="AGREE" onclick="show_panel8()">
	</div>
</div>

<script type="text/javascript">
	function show_panel8() {
		$("#panel3").load('<?=base_url("c_agent/load_panel8")?>' + '#panel3');
		$("#captDiv").show(900);
		$("#captDivtxt").show(900);
		$("#divAttach").show(900);
		$("#btnDiv").show(900);		
	}
</script>