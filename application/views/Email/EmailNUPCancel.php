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
	</style>

</head>
<script type="text/javascript">
	function formatNumber(data) 
{
  if(data==null){
    data =0;
  }
  return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

}
 
</script>
<body>

<div >
	<h1>Dear Finance,</h1>

	<div >
		<div>
			
			Please approve cancel NUP Number : <?php echo $nupno;?><br>
			Name : <?php echo $NAME;?> <br>
			NUP Type : <?php echo $nuptype;?> <br>
			Amount :  <?php echo $nup_amt;?><br>
			Agency : <?php echo $agency;?> <br>
			Marketing/Agent : <?php echo $agent_name;?> <br>
			Reason : <?php echo $reason;?>.( <?php echo $remark;?> ) <br>
			<br><br><br>
			Thank You.
		</div>		
		
	</div>
</div>
</body>
</html>