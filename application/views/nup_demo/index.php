<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
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

	<script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
	<script src="<?=base_url('js/bootstrap.min.js')?>"></script>
	<script src="<?=base_url('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
	<script src="<?=base_url('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>

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
  <script src="https://www.google.com/recaptcha/api.js"></script>
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
      .has-error .select2_demo_1-selection {
          border: 2px solid #a94442;
          border-radius: 4px;
      }
      /*.select.input-validation-error { border-color: red } 	  	*/
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
      <script type="text/javascript">
    function replaceAll(str, find, replace)
    {
      return str.replace(new RegExp(find, 'g'), replace);
    }

    function formatNumber(data) 
    {
      if(data==null){
        data =0;
      }
      // alert(data);
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

    }
    </script>
    <style >
      #signupForm label.error {
      margin-left: 10px;
      width: auto;
      display: inline;
    }
    td {
        height: 40px;
      }

    #label_form label {
        text-align: right;
      }

    .marginSelect{
      padding-left: 12px !important;
      padding-bottom: 6px !important;
      border-bottom-width: 1px !important;
      padding-top: 3px !important;

    }
    </style>

    <script type="text/javascript">

        var observe;
        if (window.attachEvent) {
            observe = function (element, event, handler) {
                element.attachEvent('on'+event, handler);
            };
        }
        else {
            observe = function (element, event, handler) {
                element.addEventListener(event, handler, false);
            };
        }
        function init () {
            var text = document.getElementById('remarks');
            function resize () {
                text.style.height = 'auto';
                text.style.height = text.scrollHeight+'px';
            }
            /* 0-timeout to get the already changed text */
            function delayedResize () {
                window.setTimeout(resize, 0);
            }
            observe(text, 'change',  resize);
            observe(text, 'cut',     delayedResize);
            observe(text, 'paste',   delayedResize);
            observe(text, 'drop',    delayedResize);
            observe(text, 'keydown', delayedResize);

            text.focus();
            text.select();
            resize();
        }
    </script> 

</head>
<body class="top-navigation">		
	<div id="wrapper">
        <div id="loader" class="loader" hidden="true"></div>
        <div id="page-wrapper" class="gray-bg">
            <!-- <div class="wrapper wrapper-content"> 
                <div class="container">            
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div id="panel1" class="col-sm-12">
                                        <h3>NUP Online Demo</h3>
                                        <hr>                                              
                                    </div>                  
                                    
                                    <form id="frmEditor1" class="form-horizontal" enctype="multipart/form-data" method="post" action="">
                                        <div id="panel3" class="col-sm-12">

                                        </div>
                                    </form>                                   
                                                    
                                    <div class="col-sm-10" hidden="hidden" id="btnDiv" name="btnDiv">
                                        <button type="button" id="btnSubmit" class="btn btn-danger">Submit</button>                     
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div> -->
            <div class="content-wrapper">
              <div class="row border-bottom white-bg dashboard-header"> 
              <div id="loader" class="loader" hidden="true"></div> 
                <div class="form-group">
                  <div class="tittle-top pull-left"><b>            
                 <!--  <?php echo $project; ?><br>
                    <?php echo($agent->agent_name)?> -->
                  </b></div>
                  <div class="tittle-top pull-right"><b>NUP Entry</b></div>
                </div>        
              </div>
              <div class="wrapper wrapper-content" >
                <div class="row">
                  <div class="col-xs-12">
                    <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
                      <div class="ibox-content">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nama / Name<FONT COLOR="RED">*</FONT></label>
                          <div class="col-sm-3">
                            <select class="select2_demo_1 form-control required col-sm-2" name="salutation" id="salutation" data-placeholder="Select Salutation">                  
                              <option></option>
                              <option value="Mr.">Mr.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Ms.">Ms.</option> 
                            </select>
                          </div>
                          <div class="col-sm-4">                  
                            <input type="text" class="form-control" name="customer" id="customer" placeholder="Input Name">
                          </div>
                        </div>              
                        <div class="form-group">
                          <label class="col-sm-3 control-label">HP / Mobile<FONT COLOR="RED">*</FONT></label>
                          <div class="col-sm-3">
                            <select class="select2_demo_1 form-control" name="country_cd" id="country_cd" data-placeholder="Select Country"><?php echo $comboCountry ?></select>
                          </div>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" name="HP" id="HP" data-inputmask="'mask':'999999999999'" placeholder="8xxxxxxxxxx">
                            Format: 21995500 | 89895098987
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Email<FONT COLOR="RED">*</FONT></label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control" name="Email" id="Email" placeholder="Input Email">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Nationality</label>
                          <div class="col-sm-7">
                            <select class="select2_demo_1 form-control col-sm-2" name="nationality" id="nationality" data-placeholder="Select Nationality"><?php echo $cbnationality ?></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label" name="lblnoktp" id="lblnoktp">No. KTP / ID No.<FONT COLOR="RED">*</FONT></label>
                          <label class="col-sm-3 control-label" name="lblnopass" id="lblnopass" hidden="true">No. Passport / Passport No.<FONT COLOR="RED">*</FONT></label>                 
                          <div class="col-sm-7">
                            <input type="text" class="form-control" name="noktp" id="noktp" placeholder="Input ID Number">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Alamat / Address<FONT COLOR="RED">*</FONT></label>                
                          <div class="col-sm-7">
                            <textarea class="form-control" placeholder="Input Address" name="address" id="address" style=" height: 50px;"></textarea>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Kota / City<FONT COLOR="RED">*</FONT></label>                
                          <div class="col-sm-7">
                            <select class="select2_demo_2 form-control"  name="city" id="city" data-placeholder="Select City"><?php// echo $comboCity;?></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label" id="lblnpwp" name="lblnpwp">NPWP</label>                
                          <div class="col-sm-7">
                            <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Input NPWP">
                          </div>
                        </div>
                        <div class="form-group" id="divproduct">
                          <label class="col-sm-3 control-label">Product<FONT COLOR="RED">*</FONT></label>                
                          <div class="col-sm-7">                 
                            <?php
                            foreach($product as $row)
                            {
                              $var ='<label class="radio-inline">';
                              $var.=' <input type="radio" id="'.$row->product_cd.'" name="product" value="'.$row->product_cd.'" tabindex="-2" />'.$row->descs;
                              $var.=' </label>';
                              echo $var;
                            }  
                            ?>
                          </div>
                        </div>
                        <div class="form-group" >
                          <label class="col-sm-3  control-label">Property<FONT COLOR="RED">*</FONT></label>
                          <div class="col-sm-7">                
                            <select class="select2_demo_1 form-control" name="property" id="property" data-placeholder="Select Property"><option value=""></option><?php //echo $comboTnup ?></select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Tipe NUP / NUP Type<FONT COLOR="RED">*</FONT>
                            <input type="button" value="More Info" onclick="nuptypeinfo(1);" class="btn btn-info btn-xs">
                          </label>
                          <div class="col-sm-3">
                            <select class="select2_demo_1 form-control" name="nuptype" id="nuptype" data-placeholder="Select NUP Type"><option value=""></option><!-- <?php echo $comboTnup ?> --></select>                  
                          </div>
                          <div class="col-sm-4">
                            <input class="form-control" name="nupamt" id="nupamt" readonly>
                          </div> 
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Tanggal NUP / NUP Date</label>
                          <div class="col-sm-7">
                            <input class="form-control" name="rsvdate" id="rsvdate" value="<?php echo($today)?>" disabled="1">
                          </div>
                        </div>
                       <!--  <div class="form-group" >
                          <label class="col-sm-3 control-label">Lokasi launcing yang dipilih /<br>Preffered launching location<FONT COLOR="RED">*</FONT>
                            <input type="button" value="More Info" onclick="nuptypeinfo(0);" class="btn btn-info btn-xs">
                          </label>
                          <div class="col-sm-7">
                            <select class="select2_demo_1 form-control" name="Location" id="Location" data-placeholder="Select Location"><?php echo $comboLocation; ?></select>                  
                          </div>
                        </div> -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Agent</label>
                            <div class="col-sm-7">
                                <select class="select2_demo_1 form-control" name="agent" id="agent" data-placeholder="Select Agent"><?php echo $comboagent; ?></select>
                            </div>
                        </div>
                        <div class="form-group" > 
                          <label class="col-sm-3 control-label"></label>               
                          <div class="col-sm-7">
                            <div style="color:red;" name="g-recaptcha-response" ></div>
                            <div class="g-recaptcha" data-sitekey="<?php echo $sitekey?>"></div>
                          </div>
                        </div>
                        <!-- <div class="form-group" id="captha_panel" name="captha_panel">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-7" id="captDiv" name="captDiv">
                              <?php if(!empty($cp["image"])){ echo $cp["image"];}?><br>

                              <a href="#" onclick="reload_captcha();">Refresh</a>
                              <input class="form-control" type="text" id="userCaptcha" name="userCaptcha" placeholder="Enter above text" value="<?php if(!empty($userCaptcha)){ echo $userCaptcha;} ?>"/>
                            </div>
                        </div>  -->                      
                            <input type="hidden" name="prefix" id="prefix">
                            <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>">
                            <input type="hidden" name="seqno" value="<?php echo $seqno;?>" id="seqno">
                            <input type="hidden" name="status" id="status" value="<?php echo $status;?>">                        
                      </div>
                      <br>
                      <div class="box-footer pull-left">
                        <input type="button" name="submit" id="submit" value="Make a Payment!" class="btn btn-primary">
                        <input type="button" onclick="close_windows()" value="Back" class="btn btn-default">
                      </div>
                    </form>
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
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>
    <!-- </form>	 -->


<script type="text/javascript">
  $(document).ready(function () {

    $('.select2').on('change', function () {
        $(this).valid();
    });

    $("#gyr_ind").select2();

    var validator = $("#documentAdmin").validate();

});

  // function reload_captcha(){             
  //   $("#captha_panel").load('<?=base_url("c_nup_trans_demo/load_captcha")?>' + '#captha_panel');
  // }

  function close_windows(){
  window.close();
}

	$("#payment").change(function(){
      var payment = $(this).find(':selected').val();
      var a = $('#seqno').val();
      if(payment!=='') {
        var site_url = '<?php echo base_url("c_nup_trans/setPayment") ?>';
        $.post(site_url,
          {act:payment,bct:a},
          function(data,status){
            // console.log(data);
            if(data.remarks!='') {
              $('#remarkspayment').attr('placeholder', data.remarks);
              if(data.pesan=='0'){
                $('#remarkspayment').val('');
              } else {
                $('#remarkspayment').val(data.values);
              }
            } else {
              swal('Please define NUP Type for this project');
              // console.log('salah');
            }
          },
          'json'
          );
      } else {
        // console.log('nuptype empty');
      }
      // $("#txt_debtor").val(lot);
    });
  function nuptypeinfo(status)
  {
    // alert(status);
    var modalClass = $('#modal').attr('class');
    
                      switch (modalClass) {
                          case "modal fade bs-example-modal-md":
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
                          case "modal-dialog modal-md":
                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                              break;
                          case "modal-dialog modal-sm":
                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                              break;
                          default:
                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                              break;
                      }
                      
                      if(status == 1){
                        $('#modalTitle').html('NUP Type Information');  
                      }else{
                        $('#modalTitle').html('Preffered launching location');  
                      }
                      
                      $('div.modal-body').load("<?php echo base_url("c_nup_trans_demo/showinfo");?>/"+ status);

                      $('#modal').modal('show');
  }

  var bussID=0;
  function setNUPType(Id,product){
        
        var site_url = '<?php echo base_url("c_nup_trans_demo/chosen_nup_type")?>';
            $.post(site_url,
              {Id:Id,product:product},
              function(data,status) {
                $("#nuptype").empty();
                $("#nuptype").append(data);
                $("#nuptype").trigger('change');
              }
            );
    }
     function setProperty(Id,prod){
        
        var site_url2 = '<?php echo base_url("c_nup_trans/zoom_property_edit")?>';
            $.post(site_url2,
              {prod:prod,Id:Id},
              function(data,status) {
                $("#property").empty();
                $("#property").append(data);
                $("#property").trigger('change');
              }
            );
    }
    function setLocation(Id){
        
        var site_url = '<?php echo base_url("c_nup_trans/chosen_location")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#Location").empty();
                $("#Location").append(data);
                $("#Location").trigger('change');
              }
            );
    }
    function setcountrycd(Id){
        
        var site_url = '<?php echo base_url("c_nup_trans/chosen_country")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#country_cd").empty();
                $("#country_cd").append(data);
                $("#country_cd").val(Id).trigger('change');
              }
            );
    }

   function setpayment(Id){
        
        var site_url = '<?php echo base_url("c_nup_trans/chosen_payment")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#payment").empty();
                $("#payment").append(data);
                $("#payment").trigger('change');
              }
            );
    }
    function setcity(Id){
        
        var site_url = '<?php echo base_url("c_nup_trans/chosen_city")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#city").empty();
                $("#city").append(data);
                $("#city").trigger('change');
              }
            );
    }

    // function setsalutation(Id){
        
    //     var site_url = '<?php echo base_url("c_nup_trans/chosen_salutation")?>';
    //         $.post(site_url,
    //           {Id:Id},
    //           function(data,status) {
    //             $("#salutation").empty();
    //             $("#salutation").append(data);
    //             $("#salutation").val(Id).trigger('change');
    //           }
    //         );
    // }

    function setnationality(Id){
        
        var site_url = '<?php echo base_url("c_nup_trans/chosen_nationality")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#nationality").empty();
                $("#nationality").append(data);
                $("#nationality").trigger('change');
                // console.log($("#noktp").val());
              }
            );
    }



  
  // $(".select2").select2();

    var table;
    var ids;
    var descss;
    // var config = {
    //   '.chosen-select'           : {},
    //   '.chosen-select-deselect'  : {allow_single_deselect:true},
    //   '.chosen-select-no-single' : {disable_search_threshold:10},
    //   '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
    //   '.chosen-select-width'     : {width:"95%"}
    // }
    // $(".chosen-select").chosen({ width: '100%'});
    // for (var selector in config) {
    //   $(selector).chosen(config[selector]);
    // }

    $(function() {
      var form = "<?php echo $form;?>";
      if (form == "edit")
      {
        // document.getElementById('divproduct').style.display = 'none';
      }
      // $("#nuptype").click(function() {
      //   // $('input:radio[name="product"]:checked')
      //   if (! $("input:radio[name='product']").is(':checked') ) {
            
      //   }
      //   else {
      //     BootstrapDialog.alert('Please choose product');
      //   }

      // });
      $("#npwp").inputmask({
        mask: "99.999.999.9-999.999"
      });
      // $('#npwp').inputmask({"99.999.999.9-999.999"});
      // $("#noktp").inputmask("AAAAAAAAAAAAAAAA");
      // $("#HP").inputmask({
      //   mask: "999999999999"
      // });
      // $("#HP").inputmask({
      //   mask: "999999999999"
      //   });

      $(".select2_demo_1").select2();

      $(".select2_demo_2").select2({
          ajax:{
            url: '<?php echo base_url("c_nup_trans_demo/chosen_city_")?>',
            dataType: 'json',
            type: 'post',
            delay: 1000,
            data: function(params) {
              document.getElementById('loader').hidden=false;
              return{
                q: params.term
              };
            },
            processResults: function(data) {
              // console.log(data);
              document.getElementById('loader').hidden=true;
              return{
                results: data
              };
            },
            cache: false            
          },
          minimumInputLength: 3,
          placeholder: 'Type a city'          
        });

      $('input:radio[name="product"]').change(function(){
        // console.log('tes');
        var prod = $(this).val();    
          // alert(prod);
          if(prod !=='') {
            $('#nupamt').val('');
            var site_url = '<?php echo base_url("c_nup_trans_demo/zoom_nuptype")?>';
            $.post(site_url,
              {prod:prod},
              function(data,status) {
                $("#nuptype").empty();
                $("#nuptype").append(data);
                $("#nuptype").trigger('chosen:updated');
              }
            );
            var site_url2 = '<?php echo base_url("c_nup_trans_demo/zoom_property")?>';
            $.post(site_url2,
              {prod:prod},
              function(data,status) {
                $("#property").empty();
                $("#property").append(data);
                $("#property").trigger('chosen:updated');
              }
            );
          } else {
            $("#nuptype").empty();
          }
        
    });

      var lot = $("#nuptype").find(':selected').val();
      $("#nuptype").change();
    });
function Download(rowID){
  // alert(rowID);
  // var data = table.rows(0).data();
  var file_attachment ;
  var seqno;
  var document_no;
  var rowcount = table.rows().count();
  for (var i = 0; i < rowcount ; i++) {
      var Id = table.rows(i).data()[0].rowID;
      if(Id==rowID){
        file_attachment = table.rows(i).data()[0].file_attachment;
        seqno = table.rows(i).data()[0].nup_sequence_no;
        document_no = table.rows(i).data()[0].document_no;
      }
            
    }
  if(file_attachment==null ||file_attachment==''){

    return;
  }
  var site_url = '<?php echo base_url("c_nup_trans/downloadFile")?>';
            $.post(site_url,
              {seqno:seqno,document_no:document_no},
              function(data,status) {
                
              }
            );
  

}
function Loadfile(rowID){
// alert(id);  

// alert(rowID);
             
              var sn = $('#seqno').val();
       
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
                $('div.modal-body').load("<?php echo base_url('c_nup_trans/addNew');?>"); //+"/"+descs+"/"+rowID);
                // $('#modal').data('descs', descs);
                
                $('#modal').data('sn', sn);
                $('#modal').data('id', rowID).modal('show');
}
   
    $.validator.addMethod("attached", function (value, element) {
        var isSuccess = false;
        var content = $('#cntfile').val();
        // alert(content);
        // console.log(content);
        if(content < 1) {
          isSuccess = true;
        } else {
          isSuccess = false;
        }
        return isSuccess;
    });
    $.validator.setDefaults(
      { ignore: ":hidden:not(#cntfile)" },
      { ignore: ":hidden:not(.chosen-select)" }
    );
    $.validator.addMethod("cek_npwp", function (value, element) {
            var isSuccess = false;
            var npwp = $('#npwp').val();
            
            // alert(content.length);
            // if(content==null||content =='' && youtubelink == null||youtubelink=='' && picture ==null || picture ==''){
            if(npwp.length == 0){
              isSuccess=true;
            }else if(npwp.length > 20 || npwp.length < 20  ){
                // isSuccess=true;
                // alert('pict ='+picture.length+' yt '+youtubelink.lenght+ ' content '+content.lenght);
            }else{
                isSuccess=true;

                 // alert(picture.lenght);
            }
            // alert(isSuccess);
            return isSuccess;

        });

    $.validator.addMethod("check_noktp", function (value, element) {
      var isSuccess = false;
      var noktp = $('#noktp').val();
      var nationality =  $('#nationality').find(':selected').val();
      
      if(nationality != 01) {
          isSuccess=true;
      }
      else{
          if(noktp.length == 16){
            isSuccess=true
          } 
      //   if(noktp.length > 16 || noktp.length < 16  ){
      
      //   }else{
      //     isSuccess=true;
      //   }    
      } 
      return isSuccess;
    });

    $.validator.addMethod("cek_telp", function (value, element) {
              var isSuccess = false;
              var Stext = $('#HP').val()
              var Sawal = value.charAt(0);
              console.log(Stext);

              if(Sawal == 0){

              }else{
                isSuccess = true;
              }              
        
              return isSuccess;

          });

    // $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
    $('#form_nup').validate({
      ignore: "",
      rules: {
        customer: { required: true,
        maxlength:60
      },
        
        HP:{
            required: true,
            number:true,
            maxlength:12,
            cek_telp: true
            },
        Email:{
                required: true,
                email:true,
                maxlength:60
              },
        noktp: {required: true,
        check_noktp: true},
        address:{
            required: true,
            maxlength:255
            },
        city: {required: true},
        npwp: {cek_npwp: true},
        nuptype: {required: true},
        nupdesc: {required: true},
        rsvdate: {required: true},
        rsvby: {required: true},

        grpcd: {required: true},
        // agtype: {required: true},
        nupamt: {required: true},
        type: {required: true},
        // phase: {required: true},
        // seqno: {required: true},
        bankcd: {required: true},
        country_cd:{required: true},
        salutation:{required:true},
        property:{ required:true}
        // ,
        // Location:{required: true}
        // ,cntfile: {attached: true}
      },
      messages: {cntfile: {attached: "Upload file need to completed"},
                npwp: { cek_npwp: "NPWP is not valid"},
                noktp: {check_noktp: " IC No. Is not valid"},
                HP: {cek_telp: "Handphone number is not valid"} ,
                country_cd : {country_cd: "required"}
      },
      // errorElement: "em",
      errorPlacement: function(error, element){

        if (element.parent('.span-group').length || element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
            error.insertAfter(element.parent());
            error.insertAfter(element.next('span'));
        } 
        else if (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
            error.insertAfter(element.next('span'));
        } else {
            // error.insertAfter(element);
        // }


        // if(element.parent('.select.input-group').length){
        //   error.insertAfter(element.parent());
        // }

      }
      // success: function(label, element){
      //   if (!$(element).next("span")[0]) {
      //       $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 90%'></span>").insertAfter($(element));
      //   }
      // },
      // highlight: function(element, errorClass, validClass){
      //   // $(element).parents(".select2_demo_1").addClass("has-error");
      //   // $(element).parents(".input-group").addClass("has-error");
      //   //.removeClass("has-success");
      //   // $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
      //   // $(element).addClass(errorClass); //.removeClass(errorClass);
      //   // $(element).closest('.span').removeClass('.select2-container--default .select2-selection--single .select2-container--default .select2-selection--multiple').addClass('select2_demo_1_error');

      // },
      // unhighlight: function(element, errorClass, validClass){
      //   // $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
      //   // $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
      //   $(element).removeClass(errorClass);
      //   // $(element).closest('.form-group').removeClass('has-error').addClass('has-success') 
      // }
    });

    $.validator.setDefaults({
      errorElement: "span",
      errorClass: "help-block",
      //  validClass: 'stay',
      highlight: function (element, errorClass, validClass) {
          $(element).addClass(errorClass); //.removeClass(errorClass);
          $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
      },
      unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass(errorClass); //.addClass(validClass);
          $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
      },
      errorPlacement: function (error, element) {
          if (element.parent('.input-group').length) {
              error.insertAfter(element.parent());
          } else if (element.hasClass('select2_demo_1')) {
              error.insertAfter(element.next('span'));
          } else {
              error.insertAfter(element);
          }
      }
  });

    $("#nuptype").trigger('chosen:updated');
    // $("#nupamt").mask('#,##0',{reverse:true,maxlength:false});
    $("#nuptype").change(function(){
      // alert('test');
      var nuptype = $(this).find(':selected').val();
      // alert(nuptype);
      // console.log(nuptype+'PP');
      if(nuptype!=='') {
        var site_url = '<?php echo base_url("c_nup_trans_demo/setnup") ?>';
        $.post(site_url,
          {tnup:nuptype},
          function(data,status){
            if(data.pesan==1) {
              $("#nupamt").val(formatNumber(data.nup_amt));

              // $("#remarks").val(data.remarks); //ini ceritanya bikin remarks
              $("#remarks").text(data.remarks);

              // $("#nupdesc").val(data.descs);
              $("#prefix").val(data.pref);
            } else {
              swal('Please define NUP Type for this project');
            }
            
            // $("#txt_debtor").empty();
            // $("#txt_debtor").val(data);
            // console.log(data);
          },
          'json'
          );
      } else {
        // console.log('nuptype empty');
      }
      // $("#txt_debtor").val(lot);
    });



    $('#nationality').change(function(){
      var nationality = $(this).find(':selected').val();
      // alert(nationality);
      if (nationality != 01){
        document.getElementById('lblnoktp').hidden=true;
        document.getElementById('lblnopass').hidden=false;
        document.getElementById('lblnpwp').hidden=true;        
        document.getElementById('npwp').style.visibility = 'hidden';
        // $('#noktp').val('');
      }else{
        document.getElementById('lblnoktp').hidden=false;
        document.getElementById('lblnopass').hidden=true;
        document.getElementById('lblnpwp').hidden=false;        
        document.getElementById('npwp').style.visibility = 'visible';
        // $('#noktp').val('');
      }
      
    });
    
    $('#submit').click(function(){
      var status = '<?php echo $status;?>';
      var email = $('#Email').val();
      var nupamt = $('#nupamt').val();
      var hp = $('#country_cd').val()+$('#HP').val();
      var ID = '<?php echo $rowID;?>';
      var srvdate = $('#rsvdate').val();
      var nupamt = $('#nupamt').val();
      var remarkspayment = $('#remarkspayment').val();
      var npwp = $('#npwp').val();
      var city = $('#city').val();
      var Id_No = $('#noktp').val();
        // var city = $('#city').val();
      var prop =$('#property').val();
        // alert(ID);
      var dataform = $('#form_nup').serializeArray();
        dataform.push({name:"bussiness_id",value:bussID}
                      ,{name:"rowID",value:ID}
                      ,{name:"rsvdate",value:srvdate}
                      ,{name:"nupamt",value:nupamt},
                      {name:"npwp",value:npwp},
                      {name:"Id_No",value:Id_No},
                      {name:"city",value:city},
                      {name:"status",value:status},
                      {name:"property",value:prop}
                      );
       // console.log(dataform);
       // alert(dataform);


      if($('#form_nup').valid()) {
        
        if(nupamt==''){
          swal("Information","Please choose NUP Type first!","error");
          return;
        }

        var response = grecaptcha.getResponse();
        
        if(response.length==0){
          swal('Warning','Captcha is invalid','error');
        } else {
          var modalClass = $('#modal').attr('class');
          switch (modalClass) {
            case "modal fade bs-example-modal-md":
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
            case "modal-dialog modal-md":
            $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
            break;
            case "modal-dialog modal-sm":
            $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
            break;
            default:
            $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
            break;
          }


          $('#modalTitle').html('Select  Payment');  


          $('div.modal-body').load("<?php echo base_url("c_nup_trans_demo/showformpayment");?>");
          $('#modal').data('email',email);
          $('#modal').data('hp',hp);
          $('#modal').data('nupamt',nupamt);
          $('#modal').data('dataform',dataform);
          $('#modal').modal('show');
        }
       
       
        
      }
      
    });    

    $('#btnback').click(function(){
     
      var seqno =$('#seqno').val();

      var site_url = '<?php echo base_url("c_nup_trans/check_delete_attachment") ?>';
        $.post(site_url,
          {seqno:seqno},
          function(data,status){

             var url = '<?php echo base_url("c_nup_trans/Index")?>';
              window.location.href=url;
          },
          'json'
          );

    });    

</script>		
<!-- Connect server : <?php //echo $hostname;?> , Database : <?php //echo $dbName;?> -->
</body>

</html>