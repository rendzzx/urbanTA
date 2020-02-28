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
      LAMPIRAN<div><strong><u>JADWAL PEMBAYARAN</u></strong></div>
    </div><BR>
    <table style="width:800px;">
      <tr>
        <td class="normal">Nama</td><td class="short">:</td>
        <td><?php echo $isi->NAME?></td>
      </tr>
      <tr>
        <td class="normal">No. Telp</td><td class="short">:</td>
        <td><?php echo(empty($isi->telp) ? '-' : $isi->telp)?></td>
      </tr>
      <tr>
        <td class="normal">No. Unit Pemesanan</td><td class="short">:</td>
        <td><?php echo $isi->lot_no?></td>
      </tr>
      <tr>
        <td class="normal">Harga</td><td class="short">:</td>
        <td><?php echo $isi->currency_cd .' '.number_format($harga,2)?></td>
      </tr>
      <tr>
        <td class="normal">Cara Pembayaran</td><td class="short">:</td>
        <td><?php echo(empty($isi->remarks) ? $isi->payment_desc :$isi->remarks)?></td>
      </tr>
    </table><br><br>
    <table>
      <thead class="t01">
        <tr>
          <th class="short">No.</th>
          <th class="normal" style="text-align:left">Uraian</th>
          <th style="text-align:right">Tanggal</th>
          <th class="money">Jumlah</th>
        </tr>        
      </thead>
      <tbody>
        <?php echo $list?>
      </tbody>
    </table>
  </div>
</body>
</html>