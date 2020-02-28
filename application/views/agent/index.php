<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta name="google-signin-client_id" content="466737535909-cpubhuf9fv24i8hn9rp0on1eedls7djd.apps.googleusercontent.com"> -->
	<link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
	<title>IFCA</title>
	

	<link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">   
	<link rel="stylesheet" type="text/css" href="<?=base_url('font-awesome/css/font-awesome.min.css')?>">  
	<link href="<?=base_url('css/plugins/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet">  
	<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
	<link href="<?=base_url('css/plugins/sweetalert/themes/twitter/twitter.css')?>" rel="stylesheet">  

	<link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
	<link href="<?=base_url('css/style.css')?>" rel="stylesheet">
	<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
    
    <script src="https://apis.google.com/js/api:client.js"></script>
	<script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
	<script src="<?=base_url('js/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
	<script src="<?=base_url('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>

    <!-- <script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script> -->
	<script type="text/javascript" src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/sweetalert/sweetalert.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>"></script>
	<script src="<?=base_url('js/plugins/jasny/jasny-bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('js/inspinia.js')?>"></script>
	<script src="<?=base_url('js/plugins/peity/jquery.peity.min.js')?>"></script>
	<script src="<?=base_url('js/plugins/pace/pace.min.js')?>"></script>
	<script src="<?=base_url('js/demo/peity-demo.js')?>"></script>

	<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
	<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

    <style type="text/css">
    	.fancyradio{
    		display: block;
    		background: #dbdbdb;
    		color: #000;
    		padding: 20px;
    		border-radius: 3px;
    		cursor: pointer;
    	}	,
    	body {
    		background-color: #eee;
    		padding-top: 40px;
    		padding-bottom: 40px; 
    	}	  	
    </style>

    <style type="text/css">
    .loader{
      width:100%;
      height:100%;
      position:fixed;
      z-index:9999;
      background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center     
    }  
  </style> 

</head>
<body class="top-navigation">		
	<div id="wrapper">
        <div id="loader" class="loader" hidden="true"></div>
        <div id="page-wrapper" class="gray-bg">
            <div class="wrapper wrapper-content">
                <div class="container">            
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div id="panel1" class="col-sm-12">
                                        <h3>Silahkan pilih status keagenan Anda</h3>
                                        <hr>
                                        <div class="form-group col-sm-12">                      
                                            <table id="tb1Type" class="fancyradio" border="0" style="font-size:12pt;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input id="B" type="radio" name="rbType" value="B">
                                                            <label for="B">Boutique / Non Franchise Office</label>
                                                        </td>
                                                        <td>
                                                            <input id="F" type="radio" name="rbType" value="F" >
                                                            <label for="F">Franchise Office</label>
                                                        </td>
                                                        <!-- <td>
                                                            <input id="N" type="radio" name="rbType" value="N" >
                                                            <label for="N">Independent</label>
                                                        </td> -->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>      
                                    </div>                  
                                    <div id="panel2" class="col-sm-12" hidden="hidden">
                                        <h3>Anda adalah?</h3>
                                        <hr>
                                        <div class="form-group col-sm-12">                      
                                            <table id="tb2Type" class="fancyradio" border="0" style="font-size:12pt;">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input id="P" type="radio" name="rbType2" value="P" >
                                                            <label for="P">Principal</label>
                                                        </td>
                                                        <td>
                                                            <input id="M" type="radio" name="rbType2" value="M" >
                                                            <label for="M">Marketing Executive</label>
                                                        </td>                                       
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <form id="frmEditor1" class="form-horizontal" enctype="multipart/form-data" method="post" action="">
                                        <div id="panel3" class="col-sm-12">

                                        </div>
                                    </form>
                                    <!--
                                    <div id="divAttach" class="form-group" hidden="hidden">
                                        <label class="col-sm-2 control-label">Upload File</label>
                                        <input type="hidden" class="form-control" id="seq_no" name="seq_no" value="<?php// echo $seq_no;?>" />
                                        <div class="col-sm-6">                        
                                            <table id="tblattach" class="display table-striped" cellspacing="0" width="100%">
                                                <thead>            
                                                    <th >No</th>
                                                    <th width="50%">Criteria</th>
                                                    <th width="40%">Filename</th>
                                                    <th >Upload</th>
                                                    <th >Download</th>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>                  
                                        </div>                
                                    </div> -->
                                    <div id="captha_panel" name="captha_panel">
                                        <div id="captDiv" name="captDiv" class="form-group col-sm-12" hidden="hidden" style="margin-top:10px;">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-3">
                                                <?php if(!empty($image)){ echo $image;}?><br>

                                                <a href="#" onclick="reload_captcha();">Refresh</a>
                                            </div>                      
                                        </div>
                                        <div id="captDivtxt" name="captDivtxt" hidden="hidden" class="form-group col-sm-12">
                                            <div class="col-sm-2">

                                            </div>
                                            <div class="col-sm-4">
                                                <input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/> 

                                            </div>
                                        </div>
                                    </div>                
                                    <div class="col-sm-10" hidden="hidden" id="btnDiv" name="btnDiv">
                                        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>                     
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="footer fixed">
	         	<strong>Copyright &copy; 2016-2017 <a href="#">PT. IFCA Property365</a>.</strong> All rights reserved.
	        </div>
        </div>
    </div>
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    	<div id="modalDialog" class="modal-dialog">
    		<div class="modal-content">
    			<!-- Modal Header -->
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal">
    					<span aria-hidden="true">&times;</span>
    					<span class="sr-only">Close</span>
    				</button>
    				<h5 class="modal-title" id="modalTitle"></h5>
    			</div>
    			<!-- Modal Body -->
    			<div class="modal-body">
    			</div>
    		</div>
    	</div>
    </div>
    <!-- </form>	 -->


<script type="text/javascript">	
	// var from_sosmed;
	var tblattach;
	var type;
		  			// var frm = document.forms['frmEditor'];
					  // if(!frm){
					  //   frm = document.frmEditor;
					  // }

					  function reload_captcha()
					  {
					    // if(!frm.onSubmit || (frm.onSubmit() != false)) {
					      // frm.submit();
					      $("#captha_panel").load('<?=base_url("c_agent/load_captcha")?>' + '#captha_panel');
					    // }
					}

					
					

					function myFunction(){
						var x = document.getElementById("OfficeNamedtl").value;
						var site_url = '<?php echo base_url("c_agent/getById")?>';
						$.post(site_url,
							{Id:x},
							function(data,status) {
			              	// console.log(data);
			              	$('#PTdtl').val(data);
			                // $("#customer").empty();
			                // $("#customer").append(data);
			                // $("#customer").trigger('chosen:updated');
			            }
			            );			    
					}
					function update_attach(){
						var site_url = '<?php echo base_url("c_agent/update_attach")?>';
						var Id = $('#seq_no').val();
						$.post(site_url,
							{Id:Id},
							function(data,status) {
			              	// console.log(data);
			              	// console.log(status);
			              	// $('#PT').val(data);
			                // $("#customer").empty();
			                // $("#customer").append(data);
			                // $("#customer").trigger('chosen:updated');
			            }
			            );	
						// tblattach.ajax.reload(null,false);
					}

					function Loadfile(rowID,descs){

             // console.log(rowID);
             // console.log(descs);
             // return;
             var sn = $('#seq_no').val();
             
             var modalClass = $('#modal').attr('class');
             switch (modalClass) {
             	case "modal fade bs-example-modal-lg":
             	$('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
             	break;
             	case "modal fade bs-example-modal-sm":
             	$('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
             	break;
             	default:
             	$('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
             	break;
             }

             var modalDialogClass = $('#modalDialog').attr('class');
             switch (modalDialogClass) {
             	case "modal-dialog modal-lg":
             	$('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
             	break;
             	case "modal-dialog modal-sm":
             	$('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
             	break;
             	default:
             	$('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
             	break;
             }
             $('#modalTitle').html('<b>Add File</b>');
                // alert(rowID);
                $('div.modal-body').load("<?php echo base_url('c_agent/formupload');?>"); //+"/"+descs+"/"+rowID);

$('#modal').data('descs', descs);

$('#modal').data('sn', sn);
$('#modal').data('id', rowID).modal('show');
}
						// $("#txtTelp").inputmask("Regex", { regex: "[0-9]+$" });
		  				// $("#txtFax").inputmask("Regex", { regex: "[0-9]+$" });
		  				$(document).ready(function () {
						// $("#txtTelp").inputmask("Regex", { regex: "[0-9]+$" });
						// $("#txtTelp").inputmask('Regex', {regex: "^[0-9]{1,6}(\\.\\d{1,2})?$"});
						// $("#txtTelp").inputmask("Regex", { regex: "[0-9----,-. ]+$" });
                        /*
						tblattach = $('#tblattach').DataTable({
							dom: 'Bfrtip',
							select: true,
							info: false,
							lengthChange: false,
							ordering: false,
							searching: false,
							paging: false,
							processing: true,
							serverSide: true,
							responsive: true,
							ajax:{
								url:"<?php echo base_url('c_Agent/getTableAttach')?>",
								data:{"seqno": function(d){
									var a = $('#seq_no').val();
									return a;
								}},
				            // "data":{"pl_project": function(d){
				            	type:"POST"
				            },
				            buttons:[
				            {
				            	text: ' Upload File Pictures',
				            	className: 'fa fa-plus hidden',
				            	action: function(e){
				            		var rows = table.rows('.selected').indexes();
				            		if (rows.length < 1) {
				            			swal('Please select a row');
				            			return;
				            		}
				            		var data = table.rows(rows).data();
				            		var descs = data[0].descs;
				            		var rowID = data[0].rowID;
				            		var sn = $('#seqno').val();
				                // console.log(sn);
				                // console.log(data);
				                var modalClass = $('#modal').attr('class');
				                switch (modalClass) {
				                	case "modal fade bs-example-modal-md":
				                	$('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
				                	break;
				                	case "modal fade bs-example-modal-sm":
				                	$('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
				                	break;
				                	default:
				                	$('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
				                	break;
				                }

				                var modalDialogClass = $('#modalDialog').attr('class');
				                switch (modalDialogClass) {
				                	case "modal-dialog modal-md":
				                	$('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
				                	break;
				                	case "modal-dialog modal-sm":
				                	$('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
				                	break;
				                	default:
				                	$('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
				                	break;
				                }
				                $('#modalTitle').html('<b>Add File</b>');
				                // alert(rowID);
				                $('div.modal-body').load("<?php echo base_url('c_nup/addNew');?>"); //+"/"+descs+"/"+rowID);
                                $('#modal').data('descs', descs);
                                $('#modal').data('sn', sn);
                                $('#modal').data('id', data).modal('show');
                                }
                                }
                                ],
                                columns:[
                                {data: "row_number", name: "row_number"},
                                {data: "document_descs", name: "document_descs"},
                                {data: "file_attachment", name: "file_attachment"},
                                {
				              // data: "rowID", name: "rowID", visible: false
				              data: "rowID", name: "rowID",
				              render: function (data, type, row) {
				              	var a = row.document_descs;
				              	return '<a class="btn btn-primary btn-sm" onclick="Loadfile(\''+data+'\',\''+a+'\');"" ><i class="fa fa-users fa-fw"></i> Upload File</a>';
				              	

				              }
				          },
				          {
				               data: "rowID", name: "rowID", //visible: false
				              // data: null, searchable:false,
				              render: function (data, type, row) {
				              	
				              	var seqno = row.agent_sequence_no;
				                                // console.log(seqno);
				                                var document_no = row.document_no;
				                                
				                                return '<a class="btn btn-primary btn-sm" href=' +'<?php echo base_url("c_agent/downloadFile")?>'+'/'+seqno+'/'+document_no+'><i class="fa fa-download"></i> Download</a>';                                

				                            }
				                        }
				                        ]
				                    });
	*/
    //end table		
	$('input[name=rbType]').on('click',function(e){
		if (document.getElementById('B').checked) {						    	  
						        // $("#panel2").show(900);
						        type = 'B';
						        $("#panel2").show();
						        $("#panel3").hide();
						        $('input[name=rbType2]').attr('checked',false);
						        $("#btnDiv").hide();
						        $("#captDiv").hide();
						        $("#captDivtxt").hide();
						        // $("#divAttach").hide();
						        
						    } else if(document.getElementById('F').checked) {
						    	// $("#panel2").show(900);
						    	type = 'F';
						    	$("#panel2").show();
						    	$("#panel3").hide();
						    	$('input[name=rbType2]').attr('checked',false);
						    	
						    	$("#btnDiv").hide();
						    	$("#captDiv").hide();
						    	$("#captDivtxt").hide();
						    	// $("#divAttach").hide();

						    	

						    } else if (document.getElementById('N').checked) {
						    	type = 'N';
						    	$("#panel3").show();
						    	$("#panel3").load('<?=base_url("c_agent/load_panel5")?>/N' + '#panel3');
						    	$("#panel2").hide();
						    	$("#captDiv").hide();
						    	$("#captDivtxt").hide();
						    	$("#btnDiv").hide();
						    	// $("#divAttach").hide();
						    	// update_attach();

						  //   } else if (document.getElementById('I').checked) {
						  //   	type = 'I';
						  //   	$("#panel3").show();

						  //       $("#panel3").load('<?=base_url("c_agent/load_panel4")?>/I/I' + '#panel3');
								// $("#captDiv").show();
								// $("#captDivtxt").show();
								// $("#divAttach").show();
								// $("#btnDiv").show();
								// $("#panel2").hide();
								// update_attach()

								
							} else { 
								type = '';
								$("#panel2").hide();
								$("#panel3").hide();
								$("#captDiv").hide();
								$("#captDivtxt").hide();
								$("#btnDiv").hide();
								// $("#divAttach").hide();


							}
						});

$('input[name=rbType2]').on('click',function(e){
	if (document.getElementById('P').checked) {
						    	// console.log('type');
						    	$("#panel3").show();
						    	$("#panel3").load('<?=base_url("c_agent/load_panel3")?>/P/'+type+ '#panel3');
						    	$("#divBrand").show();
						    	// $("#divAttach").show();
						    	$("#captDiv").show();
						    	$("#captDivtxt").show();						        
						    	$("#btnDiv").show();	
						    	// update_attach();					        						        
						          // $("#divBrand").show();
						      } else if (document.getElementById('M').checked) { 
						       // console.log(type);
						       $("#panel3").show();
						       $("#panel3").load('<?=base_url("c_agent/load_panel4")?>/M/'+type+ '#panel3');
						       $("#captDiv").show();
						       // $("#divAttach").show();
						       $("#captDivtxt").show();
						       $("#btnDiv").show();	
						       // update_attach();					    
						   } else {
						   	$("#panel3").hide();
						   }
						});

$.validator.addMethod("cek_telp", function (value, element) {
	var isSuccess = false;
	var Stext = $('#txtMbl1').val()
	var Sawal = value.charAt(0);
	console.log(Stext);
	
	if(Sawal==0){
		if(value.charAt(1) != 0){
			isSuccess = true;
		}
	}else if(Sawal==6){
		isSuccess = true;
		if(value.charAt(2) == 0){
	            			// console.log('trrr');
	            			isSuccess = false;
	            		}

	            		if(value.charAt(2) == 1){
	            			// console.log('trrr');
	            			isSuccess = false;
	            		}
	            	}else if(Sawal=='+'){

	            		isSuccess=true;
	            		console.log(value.charAt(3));
	            		if(value.charAt(3)==0){
	            			isSuccess =false;
	            		}
	            		if(value.charAt(3)==1){
	            			isSuccess =false;
	            		}
	            	}
	            // console.log(isSuccess);
	            return isSuccess;

	        });
$.validator.addMethod("cek_Lead", function (value, element) {
    var isSuccess = true;
     var a = $('#txtCity').val();
    var urll = '<?php echo base_url("c_Agent/cek_Lead") ?>';
                // console.log(urll);
                $.ajax({
                    type: "POST",
                    url: urll,
                    data: { pName: a },
                    async: false,
                    dataType: "html",
                    success: function (msg) {
                    // console.log(msg);
                    if (msg == 1) {
                        // isSuccess = true;
                        if(value.length<=0){
                            isSuccess = false;
                        }
                    }
                }


            });
                return isSuccess;
                // console.log(isSuccess);

            });

$.validator.addMethod("cek_fax", function (value, element) {
	var isSuccess = false;
	var Sawal = value.charAt(0);
	            // console.log(value.length);
	            if(value.length==0){
	            	var isSuccess = true;
	            }else{
	            	if(Sawal==0){
	            		if(value.charAt(1) != 0){
	            			isSuccess = true;
	            		}
	            	}else if(Sawal==6){
	            		isSuccess = true;
	            		if(value.charAt(2) == 0){
	            			// console.log('trrr');
	            			isSuccess = false;
	            		}

	            		if(value.charAt(2) == 1){
	            			// console.log('trrr');
	            			isSuccess = false;
	            		}
	            	}else if(Sawal=='+'){
	            		isSuccess=true;
	            		if(value.charAt(3)==0){
	            			isSuccess =false;
	            		}
	            		if(value.charAt(3)==1){
	            			isSuccess =false;
	            		}
	            	}
	            }
	            // console.log(isSuccess);
	            return isSuccess;

	        });
$.validator.addMethod("cek_office", function (value, element) {
	var isSuccess = false;
	var urll = '<?php echo base_url("c_Agent/cek_office") ?>';
	            // console.log(urll);
	            $.ajax({
	            	type: "POST",
	            	url: urll,
	            	data: { pName: value },
	            	async: false,
	            	dataType: "html",
	            	success: function (msg) {
                	// console.log(msg);
                	if (msg == 0) {
                		isSuccess = true;
                	}
                }


            });
	            return isSuccess;

	        });
$.validator.addMethod("cek_PT", function (value, element) {
	var isSuccess = false;
	var urll = '<?php echo base_url("c_Agent/cek_PT") ?>';
	            // console.log(urll);
	            $.ajax({
	            	type: "POST",
	            	url: urll,
	            	data: { pName: value },
	            	async: false,
	            	dataType: "html",
	            	success: function (msg) {
                	// console.log(msg);
                	if (msg == 0) {
                		isSuccess = true;
                	}
                }


            });
	            return isSuccess;

	        });
$.validator.addMethod("cek_offNPWP", function (value, element) {
	var isSuccess = false;
	var urll = '<?php echo base_url("c_Agent/cek_offNPWP") ?>';
	            // console.log(urll);
	            $.ajax({
	            	type: "POST",
	            	url: urll,
	            	data: { pName: value },
	            	async: false,
	            	dataType: "html",
	            	success: function (msg) {
                	// console.log(msg);
                	if (msg == 0) {
                		isSuccess = true;
                	}
                }


            });

	            return isSuccess;

	        });

$.validator.addMethod("cek_offEmail", function (value, element) {
    var isSuccess = false;
    var urll = '<?php echo base_url("c_Agent/cek_offEmail") ?>';
                // console.log(urll);
                $.ajax({
                    type: "POST",
                    url: urll,
                    data: { pName: value },
                    async: false,
                    dataType: "html",
                    success: function (msg) {
                    // console.log(msg);
                    if (msg == 0) {
                        isSuccess = true;
                    }
                }
            });
                return isSuccess;
            });

$.validator.addMethod("cek_emailAdd", function (value, element) {
    var isSuccess = false;
    var urll = '<?php echo base_url("c_Agent/cek_emailAdd") ?>';
                // console.log(urll);
                $.ajax({
                    type: "POST",
                    url: urll,
                    data: { pName: value },
                    async: false,
                    dataType: "html",
                    success: function (msg) {
                    // console.log(msg);
                    if (msg == 0) {
                        isSuccess = true;
                    }
                }
            });
                return isSuccess;
            });


$.validator.addMethod("cek_valuecompNPWP", function (value, element) {
	var isSuccess = false;
	var compnpwp = $('#txtCompNPWP').val();
	
	
	
	if(compnpwp.length > 20 || compnpwp.length < 20  ){
		
	}else{
		isSuccess=true;

		
	}
	
			            // alert(isSuccess);
			            return isSuccess;

			        });

$.validator.addMethod("cek_valueNPWP", function (value, element) {
	var isSuccess = false;
	
	var npwp = $('#txtNPWP').val();
	
	if(npwp.length == 0){
        isSuccess=true;
    }else if(npwp.length > 20 || npwp.length < 20  ){
		
	}else{
		isSuccess=true;
	}
        return isSuccess;
});

$.validator.addMethod("check_noktp", function (value, element) {
    var isSuccess = false;
    var ktp = $('#txtIdNo').val();

    if (ktp.length == 0) {
        isSuccess=true;
    }else if(ktp.length > 16 || ktp.length < 16  ){

    }else{
        isSuccess=true;
    }
    return isSuccess;
});


// $.validator.addMethod("check_noktp", function (value, element) { 
//       var isSuccess = false; 
//       var noktp = $('#txtIdNo').val();         
//       
//       if(noktp.length > 16 || noktp.length < 16  ){ 
// //       isSuccess = false; 
//       }else{ 
//         isSuccess=true; 
//       } 
//       return isSuccess; 
//     });
$("#frmEditor1").validate({
	ignore:"",
	rules: {
		
		txtOfficeName: {
			required: true,
			cek_office:true
            // ,
            // maxLength: 60				                    
		},
		OfficeNamedtl:{
			required: true
            // ,
            // maxLength: 60  
		},
		PTdtl:{
			required: true
            // ,
            // maxLength: 60
		},
		PT:{
			required: true,
			cek_PT:true
            // ,
            // maxLength: 60
		},
		txtCompNPWP:{
				                    // required: true,
				                    // cek_offNPWP:true,
				                    // number: true,
				                    cek_valuecompNPWP: true
                                    // ,
                                    // maxLength: 60
				                },
				                txtCompAdd:{
				                	required: true
                                    // ,
                                    // maxLength: 100
				                },
				                txtCity:{
				                	required: true
                                    // ,
                                    // maxLength: 60  
				                },
                                txtLead:{
                                    required: true,  
                                    cek_Lead:true
                                },
				                txtProp:{
				                	required: true 
				                	
				                },
				                txtHidden:{
				                	required: true
				                },
				                // txtCode:{
				                //     required:true,
				                //     maxlength:5
				                // },
				                txtTelp:{
				                	// required:true,
				                	number:true
                                    // ,
                                    // maxLength: 15
				                	// cek_telp: true
				                },
				                txtFax:{
				                    // required:true,
				                    number:true
                                    // ,
                                    // maxLength: 15
				                    // cek_fax:true
				                },
				                txtOffEmail:{
				                	required:true,
				                	email: true,
                                    cek_offEmail: true
                                    // ,
                                    // maxLength: 60

				                },
				                // txtCompBankName:{
				                // 	required:true
				                // },
				                // txtAcctName:{
				                // 	required:true
				                // },
				                // txtAcctNo:{
				                // 	required:true
				                // },
				                txtPrinNo:{
				                	required:true
                                    // ,
                                    // maxLength: 60

				                },
				                txtIdNo:{
				                	// required:true,
				                	check_noktp:true
                                    // ,
                                    // maxLength: 20
				                    // cek_office:true,
				                    // number: true
				                    
				                },
				                txtNPWP:{
				                	// cek_offNPWP:true,
				                	cek_valueNPWP: true
                                    // ,
                                    // maxLength: 60				                	
				                },
				                txtEmailAdd:{
				                	// required:true,
				                	email:true,
                                    cek_emailAdd:true
                                    // ,
                                    // maxLength: 60
				                },
				                txtMbl1:{
				                	required:true,
				                	number:true,
				                	cek_telp: true
				                },
				                txtMbl2:{
                                    // required:true,				                    
				                    number:true
				                    // cek_telp: true
				                },
				                OfficeName:{
				                	required:true
                                    // ,
                                    // maxLength: 60
				                },
				                txtAgentName:{
				                	required:true
                                    // ,
                                    // maxLength: 60
				                },
				                // txtIdNo:{
				                //     required:true
				                // },
				                txtHomeAdd:{
				                	required:true
				                }
				            },
				            messages: {
				            	birth_date: {DOB: "This field is required."} ,
				            	txtTelp: {cek_telp: "Invalid Telp No"},
				            	txtFax: {cek_fax: "Invalid Fax No"},
				            	txtMbl1: {cek_telp: "Invalid Telp No"},
                                txtMbl2: {cek_telp: "Invalid Telp No"},
                                txtLead:{cek_Lead:"This field is required."},
				            	txtOfficeName:{cek_office:"Principal Already Exist!"},
				            	PT:{cek_PT:"Principal Already Exist!"},
                                txtOffEmail:{cek_offEmail:"Office Email Already Exist!"},
                                txtEmailAdd:{cek_emailAdd:"Email Address Already Exist!"},
				            			// txtCompNPWP:{cek_offNPWP:"Principal Already Exist!"},
				            			txtCompNPWP:{cek_valuecompNPWP: "NPWP is not valid"},
				            			txtNPWP:{cek_valueNPWP: "NPWP is not valid"},
				            			txtIdNo:{check_noktp: "ID No is not valid"}
				            		},
				            		errorElement: "em",
				            		errorPlacement: function (error, element) {
				                // Add the `help-block` class to the error element
				                error.addClass("help-block text-red");

				                // Add `has-feedback` class to the parent div.form-group
				                // in order to add icons to inputs
				                element.parents(".col-xs-5").addClass("has-feedback text-red");

				                if (element.prop("type") === "checkbox") {
				                	error.insertAfter(element.parent("label"));
				                } else {
				                	error.insertAfter(element);
				                }

				                // Add the span element, if doesn't exists, and apply the icon classes to it.
				                if (!element.next("span")[0]) {
				                	$("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 95%' ></span>").insertAfter(element);
				                }
				            },
				            success: function (label, element) {
				                // Add the span element, if doesn't exists, and apply the icon classes to it.
				                if (!$(element).next("span")[0]) {
				                	$("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 95%'></span>").insertAfter($(element));
				                }
				            },
				            highlight: function (element, errorClass, validClass) {
				            	$(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
				            	$(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
				            },
				            unhighlight: function (element, errorClass, validClass) {
				            	$(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
				            	$(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
				            }
				        });					


					//start save
					$('#btnSubmit').click(function(){                       
						if($('#frmEditor1').valid()){                            
                            document.getElementById('loader').hidden=false;
				        	// var a = ('#rbType').val();
				        	var a='';
				        	var b='';
				        	var rbType = document.getElementsByName('rbType');
				        	for (var i = 0; i < rbType.length; i++) {
				        		if (rbType[i].checked) {
						        // do whatever you want with the checked radio
						        a =rbType[i].value;
						    }
						}
						var rbType2 = document.getElementsByName('rbType2');
						for (var i = 0; i < rbType2.length; i++) {
							if (rbType2[i].checked) {
						        // do whatever you want with the checked radio
						        b =rbType2[i].value;
						    }
						}
						
						

						var dataform =   $('#frmEditor1').serializeArray();
						dataform.push(
							{name:"rbType",value:a},
							{name:"rbType2",value:b},
							{name:"userCaptcha",value:$('#userCaptcha').val()},
							{name:"seqno",value:$('#seq_no').val()}
							);
								console.log(dataform);
								// return;
								var URL ='';
								if(b=='P'){
									URL = "<?php echo base_url('c_agent/SaveHd');?>";
								}else if(b=='M'){
									URL = "<?php echo base_url('c_agent/Savedtl');?>";
								}else{
									URL = "<?php echo base_url('c_agent/Savedtl');?>";
								}
							var home = "<?php echo base_url('c_agent/mainPage');?>";
					        	$.ajax({
					        		url :URL,
					        		type:"POST",
					        		data: dataform,
					        		dataType:"json",
					        		success:function(event, data){
                                        document.getElementById('loader').hidden=true;
                                        // console.log(event.status);
                                        
                                        // swal(event.Pesan);                                        
					                       // if(data=='success'){                                            
					                       	// window.location.href = '<?php echo base_url("c_agent/mainPage")?>';
					                       // }
                                        if(event.status == 'fail'){
                                            swal(event.Pesan);
                                        }else{
                                            swal(event.Pesan);
                                            // window.location.href = '<?php echo base_url("c_agent/mainPage")?>';
                                            window.location.href = '<?php echo base_url("agent")?>';
                                        }

					                    },                    
					                    error: function(jqXHR, textStatus, errorThrown){
                                            // document.getElementById('loader').hidden=true;
					                      swal(textStatus+' Save : '+errorThrown);
					                      
					                  }
					              });           
					      	//End ajax

					      }					      
					  });
				        //end save	 
				        
				    });




</script>		
<!-- Connect server : <?php //echo $hostname;?> , Database : <?php //echo $dbName;?> -->
</body>

</html>