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
      TANDA TERIMA NUP<div><strong><u>Nomor : <?php echo $isi[0]->nup_no ?></u></strong></div>
    </div><BR>
    <table style="width:700px;" class="t01" rules="all">
      <tr >
        <td class="normal" >Nama</td><td class="short" align="center">:</td>
        <td colspan="7"><?php echo $isi[0]->NAME ?></td>
      </tr>
      <tr>
        <td class="normal">Alamat</td><td class="short" align="center">:</td>
        <td colspan="7"> <?php echo $isi[0]->address1 ?> </td>
      </tr>
      <tr>
        <td class="normal"></td><td class="short" align="center">:</td>
        <td colspan="7"><?php echo $isi[0]->address2 ?></td>
      </tr>
      <tr>
        <td class="normal"></td><td class="short" align="center">:</td>
        <td colspan="7"><?php echo $isi[0]->address3 ?></td>
      </tr>
      <tr>
        <td class="normal">Nomor KTP</td><td class="short" align="center">:</td>
        <td colspan="7"><?php echo $isi[0]->ic_no?></td>
      </tr>
      <tr>
        <td class="normal">Telepon / HP</td><td class="short" align="center">:</td>
        <td colspan="7"><?php echo(empty($isi[0]->tel_no) ? '-' : $isi[0]->hand_phone)?></td>
      </tr>
      <tr>
        <td class="normal">Co-ordinator Agent</td><td class="short" align="center">:</td>
        <td colspan="7"><?php echo $isi[0]->group_name?></td>
      </tr>
      <tr>
        <td class="normal">Property Agent</td><td class="short" align="center">:</td>
        <td colspan="7"><?php echo $isi[0]->agent_name?></td>
      </tr>
      <tr>
        <td class="normal">Type Agent</td><td class="short" align="center">:</td>
        <td colspan="7"><?php echo $isi[0]->agent_type?></td>
      </tr>
    </table><br>
    <table style="width:700px;" rules="all" border="0">
      <tr>
          <td width="180px">&nbsp;</td>
          <td align="right" width="10px"><img src="img/rpt/box.png"></td>
          <td colspan="2" width="70px">HOME</td>
          <td align="right" width="10px"><img src="img/rpt/box.png"></td>
          <td colspan="2" width="70px">OFFICE</td>
          <td align="right" width="10px"><img src="img/rpt/box.png"></td>
          <td colspan="2">HOME + OFFICE</td>
      </tr>      
    </table><br>
    <table style="width:700px;" rules="none" class="t01">
      <tr>
        <td class="normal">Jumlah Uang</td>
        <td class="short" align="center">:</td>
        <td class="money" align="left"><?php echo number_format($isi[0]->nup_amt,2).' (IDR)'?></td>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td class="normal" >Terbilang</td>
        <td class="short" align="center">:</td>
        <td colspan="7"><?php echo $terbilang.' Rupiah' ?></td>
      </tr>
      <tr>
        <td class="normal" >Keterangan</td>
        <td class="short" align="center">:</td>
        <td colspan="7">xxx</td>
      </tr>
      <tr>
        <td class="normal"></td>
        <td class="short" align="center"></td>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr>
          <td width="10px">&nbsp;</td>
          <td align="right" width="10px"><img src="img/rpt/box.png"></td>
          <td width="70px">CASH</td>
          <td align="right" width="10px"><img src="img/rpt/box.png"></td>
          <td width="70px">DEBIT</td>
          <td align="right" width="10px"><img src="img/rpt/box.png"></td>
          <td width=" 70px">TRANSFER</td>
          <td align="right" width="10px"><img src="img/rpt/box.png"></td>
          <td >CREDIT CARD</td>
      </tr>
      <tr>
        <td colspan="9">&nbsp;</td>
      </tr>    
    </table>
  </div>
</body>
</html>