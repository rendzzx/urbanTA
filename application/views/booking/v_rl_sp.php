<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Report Table</title>
  <style type="text/css">
    .report{font-size:10px}.page-header{font-size:11px}.page-footer{font-size:9px}.text-center{text-align:center}#outtable{padding:20px;border:1px solid #e3e3e3;width:600px;border-radius:5px}.short{width:15px}.normal{width:180px}.extra{width:200px}.sign{width:20px;text-align:left}.money{width:80px;text-align:right}.today{margin-left:30px}.signed{text-align:center;width:150px}.ft{height:50px;vertical-align:bottom}.t01{border-bottom: 1px solid black;border-top: 1px solid black; border-collapse: collapse;}
  </style>
</head>
<body class="report">
  <div class="container">
    <div class="page-header" align="center">
      <div><strong><u>SURAT PEMESANAN</u></strong></div><?php echo $isi[0]->ref_no ?>
    </div>
    <p>
      Yang bertanda tangan dibawah ini :
    </p>
    <table style="width:800px;">
      <tr>
        <td class="normal">Nama</td><td class="short">:</td>
        <td><?php echo $isi[0]->name ?></td>
      </tr>
      <tr>
        <td class="normal">Alamat</td><td class="short">:</td>
        <td><?php echo $isi[0]->address1. ' '.$isi[0]->address2. ' '.$isi[0]->address3. ' '.$isi[0]->post_cd?></td>
      </tr>
      <tr>
        <td>Telepon/Fax</td><td class="short">:</td>
        <td><?php echo (!empty($isi[0]->telno)? $isi[0]->tel_no : '-').'/'.(!empty($isi[0]->fax_no)? $isi[0]->fax_no : '-') ?></td>
      </tr>
      <tr>
        <td>No. Identitas</td><td class="short">:</td>
        <td><?php echo($isi[0]->ic_no) ?></td>
      </tr>
      <tr>
        <td>NPWP</td><td class="short">:</td>
        <td><?php echo (!empty($isi[0]->income_tax)? $isi[0]->income_tax: '-')?></td>
      </tr>
      <tr>
        <td>Alamat Surat</td><td class="short">:</td>
        <td><?php echo $isi[0]->mail_addr1. ' '.$isi[0]->mail_addr2. ' '.$isi[0]->mail_addr3. ' '.$isi[0]->mail_post_cd?></td>
      </tr>
      <tr>
        <td>No. Telp/HP</td><td class="short">:</td>
        <td><?php echo (!empty($isi[0]->hand_phone)? $isi[0]->hand_phone : '-')?></td>
      </tr>
      <tr>
        <td>Email</td><td class="short">:</td>
        <td><?php echo (!empty($isi[0]->email_addr)? $isi[0]->email_addr : '-')?></td>
      </tr>
    </table><br>
    <!-- <div class="row">
      <div class="col-xs-3">
        Nama<span class="pull-right">:</span><br>
        Alamat<span class="pull-right">:</span>
      </div>
      <div class="col-xs-8">
        Nathanniel Sebastians<br>
        Apt.Pesona Bahari Tower Jade 17.B, Rt.001/Rw.011 Kel.Mangga Dua Selatan, Kec.Sawah Besar Jakarta Pusat 16911.<br>
        
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">
        Telepon/Fax<span class="pull-right">:</span><br>
        No. Identitas<span class="pull-right">:</span><br>
        NPWP<span class="pull-right">:</span><br>
        Alamat Surat<span class="pull-right">:</span><br>
      </div>
      <div class="col-xs-8">
        -<br>
        317102099800007<br>
        24.120.884.0-026.000<br>
        Apt.Pesona Bahari Tower Jade 17.B, Rt.001/Rw.011 Kel.Mangga Dua Selatan, Kec.Sawah Besar Jakarta Pusat.
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">
        No. Telp/HP<span class="pull-right">:</span><br>
        Email<span class="pull-right">:</span>
      </div>
      <div class="col-xs-8">
        08129407838<br>
        natsebas@yahoo.com
      </div>
    </div><br> -->
    <p class="text-justify">
      Selanjutnya disebut "PEMESAN", dengan ini menyatakan dan sepakat untuk memesan Satuan Unit Rumah Susun / Soho / Office dengan nama "<?php echo $project->descs .(empty($project->address1)? '': ' yang berlokasi di '). $project->address1.' '. $project->address2.' '.$project->address3.' dari '.$entity->entity_name. ' berkedudukan di '.$entity->address1.', '.$entity->address2.', '.$entity->address3;?>, yang nantinya akan disebut sebagai "PENERIMA PESANAN" dan Pemesan tunduk pada ketentuan-ketentuan pemesan sebagaimana pada Surat Pemesanan ini.<br><br>
      Dengan ini Pemesan melakukan pemesanan unit <?php echo $project->descs?> dan PENERIMA PESANAN  menerima pemesanan dengan rincian sbb : 
    </p>
    <table>
      <thead class="t01">
        <tr>
          <th style="width:20px">No</th>
          <th style="text-align:left; width:150px;">Keterangan</th>
          <th style="text-align:left; width:150px;">Jatuh Tempo</th>
          <th style="text-align:right; width:80px;" colspan=2>Jumlah</th>
        </tr>
      </thead>
      <tbody>
        <?php echo $detail ?>
        <!-- <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
        </tr> -->
      </tbody>      
    </table><br>
    <table>
      <tr>
        <td class="normal">Tipe/Lantai/No. Unit</td><td class="short">:</td>
        <td colspan="2" class="normal"><?php echo (!empty($isi[0]->desc_lotType)? $isi[0]->desc_lotType : '-').' / '.$isi[0]->level_no.' / '. $isi[0]->lot_no ?></td>
      </tr>
      <tr>
        <td class="normal">Luas</td><td class="short">:</td>
        <td colspan="2" class="normal">(Nett) <?php echo($isi[0]->build_up_area) ?> M<sup>2</sup> (Semigross) <?php echo($isi[0]->land_area) ?> M<sup>2</sup></td>
      </tr>
      <tr>
        <td class="normal">Harga (Incl. PPn)</td><td class="short">:</td>
        <td  class="sign">Rp</td><td class="money"><?php echo number_format($isi[0]->list_before_price + $isi[0]->other_amt, 2) ?></td>
      </tr>
      <tr>
        <td class="normal">Diskon</td><td class="short">:</td>
        <td  class="sign">Rp</td><td class="money"><?php echo number_format($isi[0]->disc_amt,2)?></td>
      </tr>
      <tr>
        <td class="normal">Cash Back</td><td class="short">:</td>
        <td  class="sign">Rp</td><td class="money"><?php echo number_format($isi[0]->discount_special_amt,2)?></td>
      </tr>
      <tr>
        <td class="normal">Harga Setelah Diskon</td><td class="short">:</td>
        <td  class="sign">Rp</td><td class="money"><?php echo number_format($isi[0]->harga_jual,2)?></td>
      </tr>
      <tr>
        <td class="normal">Terbilang</td><td class="short">:</td>
        <td colspan="2"><?php echo $terbilang.' Rupiah'?></td>
      </tr>
      <tr>
        <td class="normal">Cara Pembayaran</td><td class="short">:</td>
        <td colspan="2"><?php echo $isi[0]->payment_plan ?></td>
      </tr>
    </table><br>
    <!-- <div class="row">
      <div class="col-xs-3">Tipe/Lantai/No. Unit<span class="pull-right">:</span></div>
      <div class="col-xs-8">Office-B / 02 / 0210</div>
    </div>
    <div class="row">
      <div class="col-xs-3">Luas<span class="pull-right">:</span></div>
      <div class="col-xs-8">(Nett) 57.80 M2  ( Semigross) 70.49 M2</div>
    </div>
    <div class="row">
      <div class="col-xs-3">Harga (Incl. PPn)<span class="pull-right">:</span></div>
      <div class="col-xs-8">
        <div class="row">
          <div class="col-xs-1">Rp</div>
          <div class="col-xs-3"><span class="pull-right">0.00</span></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">Diskon<span class="pull-right">:</span></div>
      <div class="col-xs-8">
        <div class="row">
          <div class="col-xs-1">Rp</div>
          <div class="col-xs-3"><span class="pull-right">89,000,000.00</span></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">Cash Back<span class="pull-right">:</span></div>
      <div class="col-xs-8">
        <div class="row">
          <div class="col-xs-1">Rp</div>
          <div class="col-xs-3"><span class="pull-right">0.00</span></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">Harga Setelah Diskon<span class="pull-right">:</span></div>
      <div class="col-xs-8">
        <div class="row">
          <div class="col-xs-1">Rp</div>
          <div class="col-xs-3"><span class="pull-right">0.00</span></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-3">Terbilang<span class="pull-right">:</span></div>
      <div class="col-xs-8"></div>
    </div>
    <div class="row">
      <div class="col-xs-3">Cara Pembayaran<span class="pull-right">:</span></div>
      <div class="col-xs-4">Cicilan 40x</div>
    </div><br> -->
    <p>Selanjutnya, Pemesan berkewajiban untuk membayar Unit Pesanan <?php echo $project->descs?> dengan rincian sbb :</p>
    1. Harga sudah termasuk :
    <ul>
      <li>Pajak Pertambahan Nilai (PPN)</li>
      <li>Izin mendirikan Bangunan Induk (IMB Induk)</li>
      <li>Jaringan Air dan Listrik</li>
    </ul>
    2. Harga belum termasuk biaya biaya  :
    <ul>
      <li>PPJB dihadapan Notaris/PPAT/Lega</li>
      <li>Akte Jual Beli ( AJB ) dihadapan Notaris/PPAT</li>
      <li>Biaya Balik nama SHM-SRS ke atas nama Pemesan</li>
      <li>Bea Perolehan ( Service Charge dan Sinking Fund )</li>
      <li>Biaya yang timbul berdasarkan keputusan/peraturan dari pemerintah ( jika ada )</li>
    </ul>
    <p>3. Kwitansi pembayaran dapat diambil pada hari dan jam kerja di kantor pusat <?php echo $entity->entity_name?>. Softcopy kwitansi pembayaran akan dikirimkan melalui email paling lambat 14 hari setelah pembayaran dilakukan.</p>
    <p>Dengan ditanda tangani Surat Pemesanan ini, Pemesan menyatakan setuju dan mengikatkan diri atas syarat - syarat dan ketentuan - ketentuan dalam surat pemesanan ini.</p><br>
    <div class="today">Jakarta, <?php echo date('d F Y', strtotime($isi[0]->sales_date)) ?></div><br>
    <table>
      <tr>
        <td class="signed">Pemesan</td>
        <td class="signed">Penerima Pesanan</td>
        <td class="signed">Disetujui</td>
        <td class="signed">Diketahui</td>
      </tr>
      <tr>
        <td class="signed ft"><?php echo $isi[0]->name ?></td>
        <td class="signed ft"><u><?php echo $isi[0]->agent_name ?></u></td>
        <td class="signed ft"><u>Irwanto</u></td>
        <td class="signed ft"><u>Dirga Pradipta</u></td>
      </tr>
      <tr>
        <td class="signed"></td>
        <td class="signed">In House / Agent</td>
        <td class="signed">Marketing Manager</td>
        <td class="signed">Assistant Manager Finance</td>
      </tr>
    </table>
    <!-- <div class="row">
      <div class="col-xs-3 text-center">Pemesan</div>
      <div class="col-xs-3 text-center">Penerima Pesanan</div>
      <div class="col-xs-3 text-center">Disetujui</div>
      <div class="col-xs-3 text-center">Diketahui</div>
    </div>
    <br><br><br>
    <div class="row">
      <div class="col-xs-3 text-center ">Nathanniel Sebastians</div>
      <div class="col-xs-3 text-center "><u>MKT1</u></div>
      <div class="col-xs-3 text-center "><u>Irwanto</u></div>
      <div class="col-xs-3 text-center "><u>Dirga Pradipta</u></div>
    </div>
    <div class="row">
      <div class="col-xs-3 text-center"></div>
      <div class="col-xs-3 text-center">In House / Agent</div>
      <div class="col-xs-3 text-center">Marketing Manager</div>
      <div class="col-xs-3 text-center">Assistant Manager Finance</div>
    </div> -->
    <p class="page-footer">Putih: Finance, Merah: Pembeli, Kuning: Admin Marketing, Hijau: Legal</p>
    <!-- <div class="page-footer text-center">
      HEAD OFFICE<BR>
      APL Tower Lt. 10 Unit T9, Jl. Letjen S. Parman Kav.28, Grogol, Jakarta Barat 11470 P.021 - 2920 1133  Email : thesmith@trinitidinamik.com<br>
      MARKETING OFFICE<br>
      Ruko Prominence - Alam Sutera, Jl. Jalur Sutera 38 D No. 1 - 2, Tangerang   P. 021 - 2985 3885<br>
      www.trinitidinamik.com
    </div><br> -->
  </div>
</body>
</html>