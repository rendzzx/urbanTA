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

                <div class="wrapper wrapper-content p-xl">
                            <div class="ibox-content p-xl">
                    
                    <!-- <h4 style="text-align: center;font-weight: bold;font-size: 18px">PT. IFCA Property365 Indonesia</h4> -->
                                <table border="1" width="100%">
                                    <tr >
                                        <td colspan="6">
                                            
                                            <div style="float: right; padding-top: 5px;padding-right: 10px " >
                                                <div style="font-size: 11px">Doc No.<span style="padding-left: 26px">:</span><span style="padding-left: 5px;"> <?php echo $dataprint[0]->report_no?></span></div>
                                                <div style="font-size: 11px" >Date<span style="padding-left: 43px">:</span><span style="padding-left: 5px"> <?php $reporteddate = date_create($dataprint[0]->reported_date); echo date_format($reporteddate,"d/m/Y")?> / <?php $reportedtime = date_create($dataprint[0]->reported_date); echo date_format($reportedtime,"H:s")?></span></div>
                                                <div style="font-size: 11px">Create By<span style="padding-left: 18px">:</span><span style="padding-left: 5px"> IFCA</span></div>
                                            
                                            </div>

                                            <br><br><br>

                                            

                                            
                                            <div style="font-weight: bold;text-align: center; font-size: 14px">PT. IFCA Property365 Indonesia</div>
                                            <div style="font-weight: bold;text-align: center; font-size: 14px">WORK ORDER</div>
                                            <div style="font-weight: bold;text-align: center; font-size: 14px">(WO)</div>
                                            <div style="text-align: center; font-size: 14px">To : &nbsp;<?php echo $dataprint[0]->assign_to?></div>
                                        </td>
                                    </tr>
                                    <tr >
                                        <td colspan="6">
                                            <table border="0" width="100%" style="padding-left: 20px;" center>
                                                <tr>
                                                    <td style="padding-left: 10px;padding-top: 5px">
                                                        From : <?php echo $dataprint[0]->debtor_name?>
                                                        
                                                    </td >

                                                    <td style="padding-top: 5px">
                                                        Category : <?php echo $dataprint[0]->category_descs?>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 10px">
                                                        Twr/LT/Unit : <?php echo $dataprint[0]->lot_no?>
                                                        
                                                    </td>
                                                    <td >
                                                        Source : <?php echo $dataprint[0]->complain_descs?>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 10px;padding-bottom: 5px">Requested By : <?php echo $dataprint[0]->serv_req_by?> / <?php echo $dataprint[0]->contact_no?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight: bold;text-align: center;" colspan="6">
                                            Description of Works
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="height: 120px;padding-left: 10px; padding-top: 5px; vertical-align: top">
                                            <?php echo $dataprint[0]->work_requested?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="width: 55%">
                                            <table border="0" style="width: 100%" >
                                                <tr>
                                                    <td style="padding-left: 10px;padding-top: 5px;padding-bottom:5px">
                                                        Type of Work :
                                                    </td>
                                                    <td >
                                                        <span style="width: 20px;height: 20px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Preventetive Maintenance
                                                    </td>
                                                    <td >
                                                        <span style="width: 20px;height: 20px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Urgent
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        
                                                    </td>
                                                    <td>
                                                        <span style="width: 20px;height: 20px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Work Request
                                                    </td>
                                                    <td style="padding-bottom:5px">
                                                        <span style="width: 20px;height: 20px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Office Hours
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        
                                                    </td>
                                                    <td>
                                                        <!-- <span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Preventetive -->
                                                    </td>
                                                    <td style="padding-bottom:5px">
                                                        <span style="width: 20px;height: 20px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Overtime
                                                    </td>
                                                </tr>
                                            </table>
                                            <!-- Type of Work &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Preventetive -->
                                        </td>

                                        <td colspan="2">
                                            <table border="0" width="100%">
                                                <tr>
                                                    <td style="padding-left:10px">
                                                        Charge To
                                                    </td>
                                                    <td>
                                        
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    
                                                    <td style="padding-bottom: 5px;">
                                                        <span style="width: 20px;height: 20px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Tenant
                                                    </td>
                                                    <td style="">
                                                        <span style="width: 20px;height: 20px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> No Cost
                                                    </td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td >
                                                        <span style="width: 20px;height: 20px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Bldg Mgmt
                                                    </td>
                                                    <td>
                                                        
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" style="font-weight: bold;padding-left: 10px" colspan="3">
                                            Description of Expenses
                                        </td>

                                        <td colspan="4" style="text-align: center">
                                            Calculation
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td style="text-align: center; width: 12% ">
                                            Base
                                        </td>
                                        <td style="text-align: center; width: 12%">
                                            Tax
                                        </td>
                                        <td style="text-align: center; width: 12%">
                                            Total
                                        </td>
                                    </tr>
                                    
                                        <?php 
                                             if(!empty($dataprint)){
                                            foreach ($dataprint as $row) {?>
                                            <tr>
                                                <td colspan="3" style="padding-left: 10px;"><?php echo $row->item_descs;?></td>
                                                <td style="text-align: right;padding-right: 5px;"><?php echo number_format($row->base_amt,2); ?></td>
                                                <td style="text-align: right;padding-right: 5px;"><?php echo number_format($row->tax_amt,2); ?></td>
                                                <td style="text-align: right;padding-right: 5px;"><?php echo number_format($row->total_amt,2); ?></td>
                                                
                                            </tr>

                                            <?php 
                                                $base_amt[]=$row->base_amt;
                                                $tax_amt[]=$row->tax_amt;
                                                $total_amt[]=$row->total_amt;
                                                } 
                                            } else { 
                                                echo "<tr><td colspan='5'> <b>No data available.</b></td></tr>";
                                                $base_amt[]=0;
                                                $tax_amt[]=0;
                                                $total_amt[]=0;
                                                }?>

                                    
                                    <tr>
                                        <td style="text-align: center;" colspan="3">Total</td>
                                        <td style="text-align: right;padding-right: 5px;"><?php echo number_format(array_sum($base_amt),2)?></td>
                                        <td style="text-align: right;padding-right: 5px;"><?php echo number_format(array_sum($tax_amt),2)?></td>
                                        <td style="text-align: right;padding-right: 5px;"><?php echo number_format(array_sum($total_amt),2)?></td>
                                        
                                    </tr>
                                    <tr >
                                        <td rowspan="3">
                                            <table>
                                                <tr>
                                                    <td style="padding-left: 10px;">
                                                        Work Start
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 10px;">
                                                        Date : <?php $surveydate = date_create($dataprint[0]->survey_date); echo date_format($surveydate,"d/m/Y")?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 10px;">
                                                        Time : <?php $surveytime = date_create($dataprint[0]->survey_date); echo date_format($surveytime,"H:s:i")?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td colspan="2" style="text-align: center">Work Completed</td>
                                        <td rowspan="3" colspan="2" style="text-align: center;vertical-align: top">Work Checked By</td>
                                        <td rowspan="3" style="text-align: center;vertical-align: top;padding-right: 1.5px;padding-left: 1.5px">Account Number</td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: center">Target</td>
                                        <td style="text-align: center">Actual</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding-left: 5px;">
                                                        Date : <?php $estcompletedate = date_create($dataprint[0]->est_completion_date); echo date_format($estcompletedate,"d/m/Y")?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 5px;">
                                                        Time : <?php $estcompletetime = date_create($dataprint[0]->est_completion_date); echo date_format($estcompletetime,"H:s:i")?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <table>
                                                <tr>
                                                    <td style="padding-left: 5px;">
                                                        Date : <?php $completedate = date_create($dataprint[0]->completion_date); echo date_format($completedate,"d/m/Y")?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-left: 5px;">
                                                        Time : <?php $completetime = date_create($dataprint[0]->completion_date); echo date_format($completetime,"H:s:i")?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table border="0" width="100%">
                                                <tr>
                                                    <td style="height: 120px; text-align: center;vertical-align: top;padding-top: 2px">
                                                        Prepared By
                                                    </td>
                                                    <td style="height: 120px; text-align: center;vertical-align: top;padding-top: 2px">
                                                        Acknowledge By
                                                    </td>
                                                    <td style="height: 120px; text-align: center;vertical-align: top;padding-top: 2px">
                                                        Approved By
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">
                                            <table border="0" width="100%">
                                                    <tr>
                                                        <td colspan="3" style="padding-left: 5px;padding-top: 5px">
                                                            Approval After The Project is Completed:
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="padding-left: 5px">
                                                            Tenant/Owner has inspected the work based on the criteria which has been agreed by both parties
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" style="padding-left: 5px">
                                                            and the work is completed
                                                        </td>
                                                        
                                                    </tr>
                                                <tr>
                                                    <td style="height: 120px; text-align: center;vertical-align: top">
                                                        Prepared By
                                                    </td>
                                                    <td style="height: 120px; text-align: center;vertical-align: top">
                                                        Acknowledge By
                                                    </td>
                                                    <td style="height: 120px; text-align: center;vertical-align: top">
                                                        Approved By
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                    
                    

                            
                            
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