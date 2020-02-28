<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	.normal{width:250px;}.short{width:15px}
	</style>
</head>
<!-- <script type="text/javascript">
	function tes() {
		// body...
		window.location.href='<?php echo base_url('submitSales');?>';
	}
</script> -->
<body>

<div >
	<h3>Dear <?php echo $mail->NAME ?>,</h3>

	<div >
		<div>
			<br>Thank you for your interest in our premium development THE NOVE, Nuvasa Bay. Please find your booking details below:<br>
			<table border="0">
				<tr>
					<td class="normal">Status NUP</td>
					<td class="short">:</td>
					<td><?php echo $mail->status_desc?></td>
				</tr>
				<tr>
					<td class="normal">NUP No</td>
					<td class="short">:</td>
					<td><?php echo $mail->nup_no ?></td>
				</tr>
				<tr>
					<td class="normal">Name</td>
					<td class="short">:</td>
					<td><?php echo $mail->NAME ?></td>
				</tr>
				<tr>
					<td class="normal">NUP Type</td>
					<td class="short">:</td>
					<td><?php echo $mail->descs?></td>
				</tr>
				<tr>
					<td class="normal">Amount (IDR)</td>
					<td class="short">:</td>
					<td><?php echo number_format($mail->nup_amt)?></td>
				</tr>
				<tr>
					<td class="normal">Agent</td>
					<td class="short">:</td>
					<td><?php echo $mail->agent_name.', '.$mail->group_name ?></td>
				</tr>
			</table>
			<br>Further enquiries about your booking, kindly contact our Customer Service at +628117008238 or cs.thenove@sinarmasland.com<br><br>
		</div>		
		<p>Regards,</p>
		<br><br>
		<p>The Nove Customer Service</p>
	</div>
</div>
<br>
<hr><br>
<div >
	<h3>Dear <?php echo $mail->NAME ?>,</h3>

	<div >
		<div>
			<br>Terima kasih anda sudah berminat dengan projek kami THE NOVE, Nuvasa Bay. Informasi booking anda adalah sebagai berikut:<br>
			<table border="0">
				<tr>
					<td class="normal">Status NUP</td>
					<td class="short">:</td>
					<td><?php echo $mail->status_desc?></td>
				</tr>
				<tr>
					<td class="normal">NUP No</td>
					<td class="short">:</td>
					<td><?php echo $mail->nup_no ?></td>
				</tr>
				<tr>
					<td class="normal">Nama</td>
					<td class="short">:</td>
					<td><?php echo $mail->NAME ?></td>
				</tr>
				<tr>
					<td class="normal">Tipe NUP</td>
					<td class="short">:</td>
					<td><?php echo $mail->descs?></td>
				</tr>
				<tr>
					<td class="normal">Jumlah (IDR)</td>
					<td class="short">:</td>
					<td><?php echo number_format($mail->nup_amt)?></td>
				</tr>
				<tr>
					<td class="normal">Agen</td>
					<td class="short">:</td>
					<td><?php echo $mail->agent_name.', '.$mail->group_name ?></td>
				</tr>
			</table>
			<br>Untuk informasi lebih lanjut tentang NUP anda, silahkan menghubungi Customer Service kami di +628117008238 atau cs.thenove@sinarmasland.com<br><br>
		</div>		
		<p>Salam Hangat,</p>
		<br><br>
		<p>The Nove Customer Service</p>
	</div>
</div>
<!-- <button class="btn btn-primary" type="button" id="btnTes" onclick="tes()"> tes</button> -->
</body>
</html>