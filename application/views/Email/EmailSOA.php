<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
    <title>Statement of Account</title>


    

      <style type="text/css">
      body{color: #333;font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;box-sizing: border-box;font-size: 13px;}
      .tablesoa{width: 100%;border:1px solid #EBEBEB ; border-spacing: 0;border-collapse: collapse;
		}
	.ibox-content{
		padding: 15px 20px 20px 20px;
	}
      .thead{font-size: 15px;background-color: #F5F5F6;}
      .tablesoa > thead > tr > th, .tablesoa > tbody > tr > th, .tablesoa > tfoot > tr > th, .tablesoa > thead > tr > td, .tablesoa > tbody > tr > td, .tablesoa > tfoot > tr > td {
    padding: 8px;border:1px solid #EBEBEB ;
}
.row {
    margin-right: -15px;
    margin-left: -15px;
    margin-bottom: 10px;
}

  </style>
</head>
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
        <div class="ibox-content" >
					<div class="row">
                        <h4 style="text-align: center;font-weight: bold;"><?php echo  $namaproject;?></h4>
                        <div style="font-weight: bold;text-align: center; font-size: 24px">Statement of Account</div>
                    </div><br><br>
                            <div class="row">
                                <div style="float: left!important;">
                                    
                                    

                              
                                        <table width="100%">
                                            <tr>
                                            	<td width="200px"><strong><?php echo $nama?></strong></td>
                                            	<td width="550px">&nbsp;</td>
                                                <td width="70px">Account</td>
                                                <td width="10px">:</td>
                                                <td><?php echo $account?></td>
                                            </tr>
                                            <tr>
                                            	<td width="200px"><?php echo $address1?></td>
                                            	<td ></td>
                                                <td>Deposit</td>
                                                <td>:</td>
                                                <td><?php echo $deposit?></td>
                                            </tr>
                                            <tr>
                                            	<td width="200px"><?php echo $address2?></td>
                                            	<td ></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                            	<td width="200px"><?php echo $address3?></td>
                                            	<td ></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                            	<td width="200px">Lot No: <?php echo $lotno?></td>
                                            	<td ></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </table>
                                   
                                </div>

                             
                            </div>
                             <div class="row">
                            <br><br>
                           
                                <table class="tablesoa">
                      
                                    <tr class="thead">
                                        <th>Document Date</th>
                                        <th>Document No.</th>
                                        <th>Due Date</th>
                                        <th>Kwitansi No.</th>
                                        <th>Document Description</th>
                                        <th>Debit (IDR)</th>
                                        <th>Credit (IDR)</th>
                                        <th>Balance (IDR)</th>
                                    </tr>
                                 
                          
                                    <?php 
                                     if(!empty($dtSOA)){
                                    foreach ($dtSOA as $row) {?>
                                    <tr>
                                        <th><?php $docdate = date_create($row->doc_date);
                                                  echo date_format($docdate,"d/m/Y");?></th>
                                        <th><?php if($row->trx_mode=='D') {
                                            echo $row->doc_no;
                                            } else { echo " "; }?></th>
                                        <th><?php $duedate = date_create($row->due_date);
                                                  echo date_format($duedate,"d/m/Y");?></th>
                                        <th><?php if($row->trx_mode=='C') {
                                            echo $row->doc_no;
                                            } else { echo " "; }?></th>
                                        <th style="text-align: left !important;"><?php echo $row->descs?></th>
                                        <th style="text-align: right !important;"><?php echo number_format($row->debit_amt,2); ?></th>
                                        <th style="text-align: right !important;"><?php echo number_format($row->credit_amt,2); ?></th>
                                        <th style="text-align: right !important;"><?php echo number_format($row->cumulative_sum,2); ?></th>
                                    </tr>

                                    <?php 
                                        $debit[]=$row->debit_amt;
                                        $credit[]=$row->credit_amt;
                                        $balance[]=$row->balance_amt;
                                        } 
                                    } else { 
                                        ?><tr><th colspan="8"> <b>No data available.</b></th></tr>
                                       <?php $debit[]=0;
                                        $credit[]=0;
                                        $balance[]=0;
                                        }?>

                    
                                        <tr>
                                            <th colspan="5" style="text-align: right;">Total Due :</th>
                                            <th style="text-align: right;"><?php echo number_format(array_sum($debit),2)?></th>
                                            <th style="text-align: right;"><?php echo number_format(array_sum($credit),2)?></th>
                                            <th style="text-align: right;"><?php echo number_format(array_sum($balance),2)?></th>
                                        </tr>
                                 
                                </table>
                            </div>
                            </div>

</body>
</html>