<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Ticket Launching</title>
  <style type="text/css">
    .report{font-size:14px}.page-header{font-size:20px; position: relative;top: 100px;}.page-footer{font-size:9px}.text-center{text-align:center}#outtable{padding:20px;border:1px solid b#e3e3e3;width:600px;border-radius:5px}
    .short{width:15px}.normal{width:250px}.extra{width:200px}.small{width:150px}.sign{width:20px;text-align:left}.money{width:100px;text-align:right}.today{margin-left:30px}.signed{text-align:center;width:150px}.ft{height:50px;vertical-align:bottom}
    .t01{border-bottom: 1px solid black;border-top: 1px solid black; border-collapse: collapse;}.bgclr{width:100%;height:100%;position:fixed;background:url("<?=base_url('img/gold.jpg') ?>") no-repeat}.s01{margin-top: 300px;}
    .pull-right{position: absolute; top: 10px; right: 100px;z-index: -1;}.pull-left{position: absolute; top: 20px; left: 10px;z-index: -1;}
    .nupno{position: absolute; left: 250px; top: 125px; width: 100%;text-align: center; font-size: 16px; }
    .location{position: absolute; left: 63px; top: 143px; width: 100%;text-align: center; font-size: 16px; }
    .t02{position: relative; top: 120px; width: 689px; border: 1px solid black; border-collapse: collapse;}td,th{border: 1px solid black; padding-left: 5px}
  </style>
</head>
<body class="report">
  <div class="container">
    <img src="img/logosml.png" class="pull-left">
    <img src="img/nove.png" class="pull-right">
    <div class="page-header" align="center"><strong>NUP THE NOVE /  THE NOVE PRE-LAUNCHING BOOKING SYSTEM<br>
      TANDA TERIMA SEMENTARA/ OFFICIAL INTERIM RECEIPT</strong>
    </div><BR>
    <table class="t02" align="center">
      <tr>
        <td class="normal"><b>TTS No. / Interim Receipt No. </b></td>
        <td><?php echo (empty($isi))? '': $isi->tts_no;?></td>
      </tr>
      <tr>
        <td class="normal"><b>No. NUP / Unit Queue No.</b></td>
        <td><?php echo (empty($isi))? '': $isi->nup_no;?></td>
      </tr>
      <tr>
        <td class="normal"><b>Nama NUP / Purchaser's Name</b></td>
        <td><?php echo (empty($isi))? '': $isi->name;?></td>
      </tr>
      <tr>
        <td class="normal"><b>No. KTP / Identification Document No.</b></td>
        <td><?php echo (empty($isi))? '': $isi->ic_no;?></td>
      </tr>
      <tr>
        <td class="normal"><b>Alamat / Address</b></td>
        <td><?php echo (empty($isi))? '': $isi->address1;?></td>
      </tr>
      <tr>
        <td class="normal"><b>No. HP / Mobile No.</b></td>
        <td><?php echo (empty($isi))? '': $isi->hand_phone;?></td>
      </tr>      
      <tr>
        <td class="normal"><b>Jenis NUP / Type of booking pass</b></td>
        <td><?php echo (empty($isi))? '': $isi->descs;?></td>
      </tr>
      <tr>
        <td class="normal"><b>Nama Agen / Sales Name</b></td>
        <td><?php echo (empty($isi))? '': $isi->agent_name;?></td>
      </tr>
      <tr>
        <td class="normal"><b>NUP fee yang dibayarkan / Amount paid (Indonesian Rupiah IDR)</b></td>
        <td><?php echo (empty($isi))? '': number_format($isi->nup_amt, 2);?></td>
      </tr>
    </table><br><br>
    <table class="t02" align="center" >
      <thead style="background:#e0e0e0;">
        <tr>
          <th style="text-align:center" colspan="5">Detil Transaksi / Transaction Details</th>
        </tr>        
      </thead>
      <tbody>
        <tr>
          <td class="normal">Cara Bayar / Payment Type</td>
          <td class="text-center">Credit Card<br>( <?php echo $type=='01'? 'X': '';?> )</td>
          <td class="text-center">Debit Card<br>( <?php echo $type=='02'? 'X': '';?> )</td>
          <td class="text-center" colspan="2">Bank Transfer<br>( <?php echo $type=='03'? 'X': '';?> )</td>
          <!-- <td class="small text-center">Other ( <?php //echo $type=='04'? 'X': '';?> )<br><div align="left">Specify: <?php //echo $isi->payment_type_remarks ?></div></td> -->
        </tr>
        <!-- <tr>
          <td class="normal">Spesifikasi / Specify</td>
          <td class="text-center" colspan="4"><?php echo $isi->payment_type_remarks ?></td>
        </tr>
        <tr>
          <td class="normal">Tanggal NUP / Date of Booking</td>
          <td colspan="4"><?php echo (empty($isi))? '': date('d F Y', strtotime($isi->reserve_date));?></td>
        </tr> -->
      </tbody>
    </table>

  </div>
  <br><br><br><br><br><br><br><br><br>&nbsp;&nbsp;Date : <?php echo date('d F Y');?>
  <div style="page-break-after:always;">
    
  </div>
  <div>
      <!-- <img src="img/Golden.jpg"> -->
      <?php //echo $ticket.' : '.$isi->descs ?>
      <img src="<?php echo $ticket ?>">
      <div class="nupno"><?php echo (empty($isi))? '': $isi->nup_no;?></div>
      <div class="location"><?php echo (empty($isi))? '': $isi->location;?></div>
    </div>
</div>
</body>
</html>