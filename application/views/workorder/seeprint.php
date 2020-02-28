


<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
           <br><br>
           <h3 class="content-header-title">Work Order</h3>
           <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div>
     </div>

     <div class="content-body">
       <div class="col-md-12">
          <div class="card">
             <div class="card-content collapse show">
                <div class="card-body card-dashboard">

                		<table border="1" width="100%">
                			<tr >
                				<td colspan="6">
                						<div style="float: right; padding-top: 5px; padding-right: 10px" >
                							<div style="font-size: 11px">Doc No.<span style="padding-left: 28px">:</span><span style="padding-left: 5px;"> <?php echo $dataprint[0]->report_no?></span></div>
                							<div style="font-size: 11px" >Date<span style="padding-left: 43px">:</span><span style="padding-left: 5px"> <?php $reporteddate = date_create($dataprint[0]->reported_date); echo date_format($reporteddate,"d/m/Y")?> / <?php $reportedtime = date_create($dataprint[0]->reported_date); echo date_format($reportedtime,"H:s")?></span></div>
                							<div style="font-size: 11px">Create By<span style="padding-left: 18px">:</span><span style="padding-left: 5px"> IFCA</span></div>
                							
                						</div><br><br><br>

                						

                						
                						<div style="font-weight: bold;text-align: center; font-size: 14px">PT. IFCA Property365 Indonesia</div>
					                    <div style="font-weight: bold;text-align: center; font-size: 14px">WORK ORDER</div>
					                    <div style="font-weight: bold;text-align: center; font-size: 14px">(WO)</div>
					                    <div style="text-align: center; font-size: 14px">To : &nbsp;<?php echo $dataprint[0]->assign_to?></div>
                				</td>
                			</tr>
                			<tr >
            					<td colspan="6">
            						<table border="0" width="100%" style="padding-left: 40px" center>
                						<tr>
                							<td style="padding-left: 40px">
                								From : <?php echo $dataprint[0]->debtor_name?>
			                					
                							</td >

            								<td >
            									Category : <?php echo $dataprint[0]->category_descs?>
            								</td>

                						</tr>
                						<tr>
                							<td style="padding-left: 40px">
                								Twr/LT/Unit : <?php echo $dataprint[0]->lot_no?>
			                					
                							</td>
                							<td >
                								Source : <?php echo $dataprint[0]->complain_descs?>
                							</td>
                							
                						</tr>
                						<tr>
                							<td style="padding-left: 40px">Requested By : <?php echo $dataprint[0]->serv_req_by?> / <?php echo $dataprint[0]->contact_no?></td>
                						</tr>
            						</table>
            					</td>
                			</tr>
                			<tr>
                				<td style="font-weight: bold;text-align: center" colspan="6">
                					Description of Works
                				</td>
                			</tr>
                			<tr>
                				<td colspan="6">
                					<?php echo $dataprint[0]->work_requested?>
                				</td>
                			</tr>
                			<tr>
                				<td colspan="4" style="width: 55%">
                					<table border="0" style="width: 100%" >
                						<tr>
                							<td >
                								Type of Work :
                							</td>
                							<td >
                								<span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Preventetive Maintenance
                							</td>
                							<td >
                								<span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Preventetive
                							</td>
                						</tr>
                						<tr>
                							<td>
                								
                							</td>
                							<td>
                								<span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Work Request
                							</td>
                							<td>
                								<span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Office Hours
                							</td>
                						</tr>
                						<tr>
                							<td>
                								
                							</td>
                							<td>
                								<!-- <span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Preventetive -->
                							</td>
                							<td>
                								<span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Overtime
                							</td>
                						</tr>
                					</table>
                					<!-- Type of Work &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Preventetive -->
                				</td>

                				<td colspan="2">
                					<table border="0" width="100%">
                						<tr>
                							<td>
                								Charge To
                							</td>
                							<td>
                				
                							</td>
                							
                						</tr>
                						<tr>
                							
                							<td>
                								<span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Tenant
                							</td>
                							<td>
                								<span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> No Cost
                							</td>
                						</tr>
                						<tr>
                							
                							<td>
                								<span style="width: 30px;height: 30px;margin: 5px;border: 1px solid rgba(0, 0, 0, .2);">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Bldg Mgmt
                							</td>
                							<td>
                								
                							</td>
                						</tr>
                					</table>
                				</td>
                			</tr>
                			<tr>
                				<td rowspan="2" style="font-weight: bold" colspan="3">
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
                                        <td colspan="3"><?php echo $row->item_descs;?></td>
                                        <td style="text-align: right;"><?php echo number_format($row->base_amt,2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($row->tax_amt,2); ?></td>
                                        <td style="text-align: right;"><?php echo number_format($row->total_amt,2); ?></td>
                                        
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
                				<td style="text-align: right;"><?php echo number_format(array_sum($base_amt),2)?></td>
                				<td style="text-align: right;"><?php echo number_format(array_sum($tax_amt),2)?></td>
                				<td style="text-align: right;"><?php echo number_format(array_sum($total_amt),2)?></td>
                				
                			</tr>
                			<tr >
                				<td rowspan="3">
                					<table>
                						<tr>
                							<td>
                								Work Start
                							</td>
                						</tr>
                						<tr>
                							<td>
                								Date : <?php $surveydate = date_create($dataprint[0]->survey_date); echo date_format($surveydate,"d/m/Y")?>
                							</td>
                						</tr>
                						<tr>
                							<td>
                								Time : <?php $surveytime = date_create($dataprint[0]->survey_date); echo date_format($surveytime,"H:s:i")?>
                							</td>
                						</tr>
                					</table>
                				</td>
                				<td colspan="2" style="text-align: center">Work Completed</td>
                				<td rowspan="3" colspan="2" style="text-align: center;vertical-align: top">Work Checked By</td>
                				<td rowspan="3" style="text-align: center;vertical-align: top">Account Number</td>
                			</tr>
                			<tr>
                				<td style="text-align: center">Target</td>
                				<td style="text-align: center">Actual</td>
                			</tr>
                			<tr>
                				<td>
                					<table>
                						<tr>
                							<td>
                								Date : <?php $estcompletedate = date_create($dataprint[0]->est_completion_date); echo date_format($estcompletedate,"d/m/Y")?>
                							</td>
                						</tr>
                						<tr>
                							<td>
                								Time : <?php $estcompletetime = date_create($dataprint[0]->est_completion_date); echo date_format($estcompletetime,"H:s:i")?>
                							</td>
                						</tr>
                					</table>
                				</td>
                				<td>
                					<table>
                						<tr>
                							<td>
                								Date : <?php $completedate = date_create($dataprint[0]->completion_date); echo date_format($completedate,"d/m/Y")?>
                							</td>
                						</tr>
                						<tr>
                							<td>
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
	                						<td style="height: 150px; text-align: center;vertical-align: top">
	                							Prepared By
	                						</td>
	                						<td style="height: 150px; text-align: center;vertical-align: top">
	                							Acknowledge By
	                						</td>
	                						<td style="height: 150px; text-align: center;vertical-align: top">
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
	                							<td colspan="3">
	                								Approval After The Project is Completed:
	                							</td>
	                							
	                						</tr>
	                						<tr>
		                						<td colspan="3">
		                							Tenant/Owner has inspected the work based on the criteria which has been agreed by both parties
		                						</td>
	                							
	                						</tr>
	                						<tr>
		                						<td colspan="3">
		                							and the work is completed
		                						</td>
	                							
	                						</tr>
	                					<tr>
	                						<td style="height: 150px; text-align: center;vertical-align: top">
	                							Prepared By
	                						</td>
	                						<td style="height: 150px; text-align: center;vertical-align: top">
	                							Acknowledge By
	                						</td>
	                						<td style="height: 150px; text-align: center;vertical-align: top">
	                							Approved By
	                						</td>
	                					</tr>
	                				</table>
	                			</td>
                			</tr>
                		</table>

                	
                </div>
                
             </div>

             <!-- <div class="card-content"> -->
             	<div class="col-md-12">
                <!-- <div class="row"> -->

                		
                		<div class="form-group" style="float: left">
					        <button class="btn btn-info" onclick="back()" ><i class="fa fa-print" ></i> Back </button>
					  		<a href="<?php echo base_url('c_workorder/cetakprint/').$dataprint[0]->report_no?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print </a>
					  	</div>
					 	
                		<!-- </div> -->
                		
                	</div>
             <!-- </div> -->
          </div>
       </div>
    </div>
    	
   </div>
 </div>   
        <!-- <div id="loader" class="loader" hidden="true"></div> -->
    <!-- <section class="row border-bottom white-bg dashboard-header">
            <div class="form-group">        
                <div class="tittle-top pull-right">Work Order</div>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            </div><br>
            
    </section> -->
       
<script type="text/javascript">
    function back(){
        window.location.href="<?php echo base_url('c_workorder/index')?>";
    }
    // 
</script>