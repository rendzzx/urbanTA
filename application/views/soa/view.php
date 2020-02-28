<?php  
if(!empty($dtHeader)){
       foreach ($dtHeader as $row) {
        $nama = $row->bussines_name;
        $address1 = $row->address1;
        $address2 = $row->address2;
        $address3 = $row->address3;
        $lotno = $row->lot_no;
        $account= $row->debtor_acct;
        $deposit ="IDR ".number_format($row->deposit,0);
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
<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <br><br>
           <h3 class="content-header-title">Statement Of Account</h3>

        </div>
        <!-- <div class="content-header-right">  -->
            
        <!-- </div> -->
    </div>
 
        <div class="content-body">
           
           <div class="col-sm-12" style="z-index: 1;">
              <div class="card" style="z-index: 1;">
                 <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <div class="row" >
                            <div class="col-12">
                                <div style="float: right">
                                    <button class="btn btn-gray" onclick="back()">Back</button>&nbsp;
                                    <button class="btn btn-primary" onclick="download()"><i class="ft-download"></i> Download</button>&nbsp;
                                    <a href="<?php echo base_url('c_soa/printview/').$debtor.'/'.$entity.'/'.$project.'/'.$start.'/'.$end?>" target="_blank" class="btn btn-primary"><i class="ft-printer"></i> Print </a>
                                </div>
                            </div>
                            
                       </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="wrapper wrapper-content animated fadeInRight">
                                    <div class="ibox-content p-xl">
                                    <div class="row">
                                        <!-- > -->
                                        <div style="font-weight: bold;font-size: 24px;padding-left: 15px;"><?php echo  $namaproject;?><br>Statement of Account</div>
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

                                            <div class="table-responsive m-t">
                                                <table class="table invoice-table  table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Document Date</th>
                                                        <th>Document No.</th>
                                                        <th>Due Date</th>
                                                        <th>Kwitansi No.</th>
                                                        <th>Documenat Description</th>
                                                        <th>Debit (IDR)</th>
                                                        <th>Credit (IDR)</th>
                                                        <th>Balance (IDR)</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <!-- <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td> -->
                                                        <td colspan="5" align="center">Begining Balance</td>
                                                        <td align="right"><?php echo number_format($BDebitAmt,2); ?></td>
                                                        <td align="right"><?php echo number_format($BCreditAmt,2); ?></td>
                                                        <td align="right"></td>
                                                    </tr>
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
                                                            <th style="text-align: right;"><?php echo number_format(array_sum($debit)+$BDebitAmt,2)?></th>
                                                            <th style="text-align: right;"><?php echo number_format(array_sum($credit)+$BCreditAmt,2)?></th>
                                                            <th style="text-align: right;"><?php echo number_format(array_sum($balance),2)?></th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
    function back(){
        window.location.href="<?php echo base_url('c_soa/index')?>";
    }
    function download(){
        var project = '<?php echo trim($project)?>';
         var debtor = '<?php echo $debtor?>';
         var entity = '<?php echo $entity?>';
         var start = '<?php echo $start?>';
         var end = '<?php echo $end?>';
        var pdf = 'Report.pdf';
        console.log(pdf);

          block(true,'.content-body');
          var site_url = '<?php echo base_url("c_soa/createpdf")?>';
          $.post(site_url,{project:project,debtor:debtor,entity:entity,start:start,end:end},
            function(data){
              window.location.href="<?php echo base_url('c_soa/download')?>/"+pdf;
              block(false,'.content-body');
              console.log(data);
            }
            );

    }
</script>