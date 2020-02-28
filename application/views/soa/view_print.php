<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
    <title>IFCA</title>

    <link rel="stylesheet" href="<?=base_url('css/bootstrap.css')?>">  
    <link rel="stylesheet" type="text/css" href="<?=base_url('font-awesome/css/font-awesome.min.css')?>"> 

    <link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/style.css')?>" rel="stylesheet">

</head>
<style type="text/css" media="print">
    @page 
    {
        size:  auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

    html
    {
        background-color: #FFFFFF; 
        margin: 0px;  /* this affects the margin on the html before sending to printer */
    }

    </style>

<body class="white-bg">
<?php  
if(!empty($dtHeader)){
       foreach ($dtHeader as $row) {
        $nama = $row->bussines_name;
        $address1 = $row->address1;
        $address2 = $row->address2;
        $address3 = $row->address3;
        $lotno = $row->lot_no;
        $account= $row->debtor_acct;
        $deposit = "IDR ".number_format($row->deposit,0);
       }
   }else{
        $nama = '';
        $address1 = '';
        $address2 = '';
        $address3 = '';
        $lotno = '';
        $account='';
        $deposit ='';
       }
        ?>
                <div class="wrapper wrapper-content p-xl">
                            <div class="ibox-content p-xl">
                    <div class="row">
                    <h4 style="text-align: center;font-weight: bold;"><?php echo  $namaproject;?></h4>
                        <div style="font-weight: bold;text-align: center; font-size: 24px">Statement of Account</div>
                    </div><br><br>
                       <div class="row">
                                <div class="col-sm-9">
                                    
                                    <address style="word-wrap: break-word;width:16em ">
                                        <strong><?php echo $nama?></strong><br>
                                        <?php echo $address1?><br>
                                        <?php echo $address2?><br>
                                        <?php echo $address3?><br>
                                        Lot No: <?php echo $lotno?>
                                    </address>
                                </div>

                                <div class="col-sm-3 " style="font-size: 14px">
                                        <table>
                                            <tr>
                                                <td width="70px">Account</td>
                                                <td width="10px">:</td>
                                                <td><?php echo $account?></td>
                                            </tr>
                                            <tr>
                                                <td>Deposit</td>
                                                <td>:</td>
                                                <td><?php echo $deposit?></td>
                                            </tr>
                                        </table>
                                   
                                </div>
                            </div>

                            <div class="table-responsive m-t" style="font-size: 10px;width: 100%">
                                <table class="table invoice-table  table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Document Date</th>
                                        <th>Document No.</th>
                                        <th>Due Date</th>
                                        <th>Kwitansi No.</th>
                                        <th>Document Description</th>
                                        <th>Debit (IDR)</th>
                                        <th>Credit (IDR)</th>
                                        <th>Balance (IDR)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                     if(!empty($dtSOA)){
                                    foreach ($dtSOA as $row) {?>
                                    <tr>
                                        <td><?php $docdate = date_create($row->doc_date);
                                                  echo date_format($docdate,"d/m/Y");?></td>
                                        <td><?php if($row->trx_mode=='D') {
                                            echo $row->doc_no;
                                            } else { echo " "; }?></td>
                                        <td><?php $duedate = date_create($row->due_date);
                                                  echo date_format($duedate,"d/m/Y");?></td>
                                        <td><?php if($row->trx_mode=='C') {
                                            echo $row->doc_no;
                                            } else { echo " "; }?></td>
                                        <td><?php echo $row->descs?></td>
                                        <td align="right"><?php echo number_format($row->debit_amt,2); ?></td>
                                        <td align="right"><?php echo number_format($row->credit_amt,2); ?></td>
                                        <td align="right"><?php echo number_format($row->cumulative_sum,2); ?></td>
                                    </tr>

                                    <?php 
                                        $debit[]=$row->debit_amt;
                                        $credit[]=$row->credit_amt;
                                        $balance[]=$row->balance_amt;
                                        } 
                                    } else { 
                                        echo "<tr><td colspan='8'> <b>No data available.</b></td></tr>";
                                        $debit[]=0;
                                        $credit[]=0;
                                        $balance[]=0;
                                        }?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5" style="text-align: right;"><b> Total Due :</b></th>
                                            <th style="text-align: right;"><?php echo number_format(array_sum($debit),2)?></th>
                                            <th style="text-align: right;"><?php echo number_format(array_sum($credit),2)?></th>
                                            <th style="text-align: right;"><?php echo number_format(array_sum($balance),2)?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                        </div>

    </div>

    <!-- Mainly scripts -->
    <script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
    <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>

    <!-- Custom and plugin javascript -->
    <script type="text/javascript" src="<?=base_url('js/inspinia.js')?>"></script>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>
