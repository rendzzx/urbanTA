<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Jadwal Pembayaran</title>
  <style type="text/css">
    .report{font-size:10px}.page-header{font-size:11px}.page-footer{font-size:9px}.text-center{text-align:center}#outtable{padding:20px;border:1px solid b#e3e3e3;width:600px;border-radius:5px}.short{width:15px}.normal{width:180px}.extra{width:200px}.sign{width:20px;text-align:left}.money{width:100px;text-align:right}.today{margin-left:30px}.signed{text-align:center;width:150px}.ft{height:50px;vertical-align:bottom}.t01{border-bottom: 1px solid black;border-top: 1px solid black; border-collapse: collapse;}
  </style>
</head>
<body class="report">
  <div class="container">
    <div class="page-header" align="center">
      <div><strong><u><?php echo $nama_project?></u></strong></div>
      <div><strong><u>NUP Listing</u></strong></div>
    </div>
    <table style="width:800px;">
      <?php echo $isi_table?>
    </table>
  </div>
</body>
</html>