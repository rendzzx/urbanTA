  <style>
    ul#stepForm, ul#stepForm li {
      margin: 0;
      padding: 0;
    }
    
    ul#stepForm li {
      list-style: none outside none;
    } 
    label{margin-top: 10px;}
    .help-inline-error{color:red;}

    .fieldset-auto-width {
      display: inline-block;
      width:100%;
      height: 500px;
      vertical-align: middle;
    }

    .dataTables_wrapper {
        padding-bottom: 0px !important;
    }
    .btn-padding {
      padding: 0px 0px !important;  
    }
  

  </style>

 
<!-- <link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" /> -->
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<!-- <script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script> -->

  <style type="text/css">
    .wizard > .content > .body  {position: relative;}
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
<!-- </head>
<body> -->
<div class="content-wrapper">
  <div class="row wrapper border-bottom white-bg page-heading" style="padding-bottom: 17px;">  
    <div class="wrapper wrapper-content  animated fadeInRight" style="padding-bottom: 10px; padding-top: 10px;">
    <div id="loader" class="loader" hidden="true"></div> 
      <div class="row">
        <div class="col-xs-12">
          <div class="ibox">
            <div class="ibox-title" style="padding-top: 5px; padding-bottom: 5px;">
              <h3><?php echo $ProjectDescs; ?> : NUP Choose Unit</h3>
            </div>
            <div class="ibox-content" style="padding-bottom: 0px; padding-top: 0px;">
              <div class="content" >
                <div class="steps clearfix" style="padding-top: 10px;"></div>
                <form id="form" action="#" class="wizard-big wizard clearfix" role="application" novalidate="novalidate">
                  <h1>Choose Unit</h1>                        
                  <fieldset id="form-p-1">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="ibox-content" style="padding-bottom: 0px; padding-top: 0px;">
                          <br>
                         <!--  <div class="row">
                            <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-lg-2 control-label">Nup No. : 
                            </label> 
                              <div class="col-lg-10"><?php echo $NupNO; ?></div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-lg-1 control-label">Product :</label>                          
                              <div class="col-lg-1">:</div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-lg-1 control-label">Name :</label>                          
                              <div class="col-lg-1">:</div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-lg-1 control-label">Total :</label>                          
                              <div class="col-lg-1">:</div>
                            </div>
                          </div> -->

                          <table border="0" width="100%">
                            <tr>
                              <td width="10%"><b>Nup No.</b></td>
                              <td >: <?php echo $NupNO; ?></td>
                              <td></td>
                              <td ></td>
                            </tr>
                            <tr>
                              <td width="10%"><b>Product</b></td>
                              <td >: <?php echo $ProductDescs; ?> &emsp;&emsp;&emsp;<b>Nup Type</b> : <?php echo $NupTypeDescs; ?>&emsp;&emsp;&emsp;<b>Property</b> : <?php echo $PropertyDescs; ?></td>
                              <td width="5%"></td>
                              <td ></td>
                            </tr>

                            <tr>
                              <td width="10%"><b>Name</b></td>
                              <td >: <?php echo $BussName; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                            </tr>
                            <tr>
                              <td width="10%"><b>Total</b></td>
                              <td >: <?php echo $LotQty; ?>&emsp;&emsp;&emsp;<b>Choosen</b> : <?php echo $TotQty; ?>&emsp;&emsp;&emsp;<b>Balance</b>: <?php echo $balance; ?></td>
                              <td width="5%"></td>
                              <td></td>
                            </tr>
                          </table>

                          <div class="box-body" style="padding-top: 5px;">
                            <?php echo $choosUnit; ?>                              
                          </div>

                          <!-- <div class="table-responsive">                     
                            <div class="box-body"> 
                              <div id="example_wrapper" class="dataTables_wrapper" style="padding-bottom: 0px;">                  
                                <table id="example" class="table table-striped table-bordered table-hover dataTables" cellspacing="0">
                                  <thead>
                                    <tr role="row">
                                      <th class="sorting_asc">Unit</th>
                                      <th>Description</th>
                                      <th>Remarks</th>
                                      <th><center>Action</center></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php echo $RlSalesList; ?>                  
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div> -->
                          <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">                                
                                    <div class="ibox-content" style="padding-bottom: 0px; padding-top: 5px; padding-left: 5px; padding-right: 5px; border-top-width: 0px;">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" style="padding-bottom: 0px;">
                                              <thead>
                                                <tr role="row">
                                                  <th><center>Action</center></th>
                                                  <th class="sorting_asc">Unit</th>
                                                  <th>Description</th>
                                                  <th>Remarks</th>                                                  
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php echo $RlSalesList; ?>                  
                                              </tbody>                                              
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>                
                      </div>
                    </div>
                  </fieldset>

                  <h1>Finalize Customer Information</h1>
                <fieldset id="form_nup">
                  <div class="col-lg-12">
                    <div class="ibox-content"> 
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">Nama/Name</label>                          
                          <div class="col-lg-2">
                            <select class="select2_demo_1 form-control" name="salutation" id="salutation" data-placeholder="Select Salutation" style="border: 1px solid #ccc !important;">                  
                              <option></option>
                              <option value="Mr.">Mr.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Ms.">Ms.</option> 
                            </select>
                          </div>
                          <div class="col-lg-6">                  
                            <input type="text" class="form-control" name="customer" id="customer" placeholder="Input Name" required="true">
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">HP/Mobile</label>
                          <div class="col-lg-2">
                            <select class="select2_demo_1 form-control" name="country_cd" id="country_cd" data-placeholder="Select Country" required="true"><?php echo $comboCountry ?></select>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="form-control" name="HP" id="HP" placeholder="8xxxxxxxxxx">
                            Format: 21995500 | 89895098987
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">Email</label>
                          <div class="col-lg-8">
                              <input type="text" class="form-control" name="Email" id="Email" placeholder="Input Email">
                              <input type="hidden" class="form-control" name="business_id" id="business_id">
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">Nationality</label>
                          <div class="col-lg-8">
                            <select class="select2_demo_1 form-control" name="nationality" id="nationality" data-placeholder="Select Nationality"><?php echo $cbnationality ?></select>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-sm-4 control-label" name="lblnoktp" id="lblnoktp">No. KTP / ID No.<FONT COLOR="RED">*</FONT></label>
                          <!-- <label class="col-sm-3 control-label" name="lblnopass" id="lblnopass" hidden="true">No. Passport / Passport No.<FONT COLOR="RED">*</FONT></label> -->
                          <!-- <label class="col-lg-4 control-label">No. KTP/ID No.</label> -->
                          <div class="col-lg-8">
                            <input type="text" class="form-control" name="noktp" id="noktp" placeholder="Input ID Number">
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">Alamat/Address</label>
                          <div class="col-lg-8">
                            <textarea class="form-control" placeholder="Input Address" name="address" id="address" style=" height: 50px;" required="true"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">Kota/City</label>
                          <div class="col-lg-8">
                            <select class="select2_demo_2 form-control col-lg-4"  name="city" id="city" data-placeholder="Select City" required="true"><?php //echo $comboCity ?></select>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-sm-4 control-label" id="lblnpwp" name="lblnpwp">NPWP</label>
                          <div class="col-lg-8">
                            <!-- <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Input NPWP" required="true"> -->
                            <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Input NPWP">
                          </div>
                        </div>
                      </div>
                     <!--  <div class="row" style="margin-bottom:5px;">
                        <div class="form-group" id="divproduct">
                          <label class="col-lg-3 control-label">Product</label>
                          <div class="col-lg-7">
                            <?php
                              foreach($product as $row) {
                                $var = '<div class="col-lg-6">';
                                $var .='<label class="radio-inline">'; 
                                $var .='<input style="margin-left: -30px;" type="radio" id="'.$row->product_cd.'" name="product" value="'.$row->product_cd.'" tabindex="-2" />'.$row->descs;                        
                                $var .='</label>';
                                $var .='</div>';
                                echo $var;
                              }  
                              ?>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Property</label>
                          <div class="col-lg-9">
                            <input type="text" id="property" name="property" value="" class="form-control" style="border:none; background-color:white;" readonly="readonly">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Tipe NUP/NUP Type
                            <span class="btn"><input type="button" value="More Info" onclick="nuptypeinfo(1);" class="btn btn-info btn-xs"></span>
                          </label>                          
                          <div class="col-lg-9">
                            <input class="form-control" name="nuptype" id="nuptype" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-3 control-label">NUP Amount</label>
                          <div class="col-lg-9">
                            <input class="form-control" name="nupamt" id="nupamt" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-bottom:5px;">
                        <div class="form-group">
                          <label class="col-lg-3 control-label">Tanggal NUP/NUP Date</label>
                          <div class="col-lg-9">
                            <input class="form-control" name="rsvdate" id="rsvdate" value="<?php echo($today)?>" disabled="1">
                          </div>
                        </div>
                      </div> -->
                      <div class="row">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">Lokasi launcing yang dipilih /<br>Preffered launching location
                           <span class="btn btn-padding"><input type="button" value="More Info" onclick="nuptypeinfo(0);" class="btn btn-info btn-xs"></span> 
                          </label>
                          <div class="col-lg-8">
                            <select class="select2_demo_1 form-control" name="Location" id="Location" data-placeholder="Select Location" required="true"><?php echo $comboLocation; ?></select> 
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group">
                          <label class="col-lg-4 control-label">Upload Document</label>
                          <!-- <div class="col-lg-8"> -->
                            <input type="hidden" name="prefix" id="prefix">
                            <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>" required="true">
                            <input type="hidden" name="seqno" value="<?php echo $seqno;?>" id="seqno" required="true">
                            <input type="hidden" name="cntfile" id="cntfile" value="<?php echo $cnt?>" required="true">
                            <div class="table-responsive">
                            <table id="tableatt" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                <thead width="100%">    
                                    <th >No</th>
                                    <th width="30%">Criteria</th>
                                    <th width="30%">Filename</th>
                                    <th>Upload</th>
                                    <th>Download</th>             
                                </thead>
                                
                            </table>
                           </div>

                           <!--  <table id="tableatt" class="display table-striped" cellspacing="0" width="100%">
                              <thead >            
                                <th >No</th>
                                <th width="50%">Criteria</th>
                                <th width="40%">Filename</th>
                                <th >Upload</th>
                                <th >Download</th>
                              </thead>
                              <tbody>
                              </tbody>
                            </table> -->
                          <!-- </div> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </fieldset>

                     <!--  <h1>Finish</h1>
                      <fieldset id="form-p-3">
                        <h2>Step 3 of 3</h2>
                        <div class="text-center animated fadeInRight" style="margin-top: 120px">
                          <h2>Finished :-)</h2>
                        </div>
                      </fieldset> -->
                      </form> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>

      <!-- Bootstrap Modal -->
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
          <!-- End of Bootstrap Modal -->
          <script type="text/javascript">

      

      function delete_1(rowid,lotno){ 
         swal({
            title: "Delete",
            text: "Are you sure to delete this unit ['"+lotno+"']?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            closeOnConfirm: false
          },
          function(){
            var site_url = '<?php echo base_url("c_nup_dt/delete")?>';
            $.post(site_url,
                      {rowID:rowid},
                      function(data,status) {
                        // console.log(data);
                        // var a = event.nup_no;
                        // alert(a);
                        window.location.href="<?=base_url('c_nup_dt/list_dtNew')?>"+"/"+data+"/1/<?php echo $rowid_index?>/<?php echo $status_index?>";
                      }
                    );
            swal("Deleted!", "Data has been deleted.", "success");
          });
        
      }
      function ChooseUnit(RowId,balance,NupNO){        

        /*var a = <?php echo $RowId; ?>;
        var b = <?php echo $LotQty; ?>;
        var c = <?php echo $NupNO; ?>;*/
        //alert(RowId +' ' + LotQty + ' ' + NupNO);
        var url ="<?php echo base_url('c_nup_unit/index'); ?>/"+RowId+"/"+balance+"/"+NupNO;
        //var url ="<?php echo base_url('c_nup_unit/index'); ?>/"+a+"/"+b+"/"+c;
        window.location.href = url;
      }
              //       function setcountrycd(Id){
                      
              //         var site_url = '<?php echo base_url("c_nup_dt/chosen_country")?>';
              //             $.post(site_url,
              //               {Id:Id},
              //               function(data,status) {
              //                 $("#country_cd").empty();
              //                 $("#country_cd").append(data);
              //                 $("#country_cd").trigger('chosen:updated');
              //               }
              //             );
              //       }
      function nuptypeinfo(status)
      {

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
                            
                            if(status == 1){
                              $('#modalTitle').html('NUP Type Information');  
                            }else{
                               $('#modalTitle').html('Preffered launching location');  
                            }
                              
                            $('div.modal-body').load("<?php echo base_url("c_nup/showinfo");?>/"+ status);

                            $('#modal').modal('show');
      }
//      
      // $("#npwp").mask("99-999-999-9-999-999");
      $('input:radio[name="product"]').change(function(){

        var prod = $(this).val();    
          // alert(prod);
          if(prod !=='') {
            $('#nupamt').val('');
            var site_url = '<?php echo base_url("c_nup/zoom_nuptype")?>';
            $.post(site_url,
              {prod:prod},
              function(data,status) {
                $("#nuptype").empty();
                $("#nuptype").append(data);
                $("#nuptype").trigger('change');
              }
            );
            var site_url2 = '<?php echo base_url("c_nup/zoom_property")?>';
            $.post(site_url2,
              {prod:prod},
              function(data,status) {
                $("#property").empty();
                $("#property").append(data);
                $("#property").trigger('change');
              }
            );
          } else {
            $("#nuptype").empty();
          }
        
      });
      $(function () {
        
        document.body.style.backgroundImage = "url(<?php echo base_url('img/back.jpg');?>)";
        // $("#HP").inputmask("Regex", { regex: "[0-9]+$" });
      
        
        // $('#example').DataTable({
        //   'responsive': true,
        //   'paging': false,
        //   'searching': false,
        // });

        // $(".open1").click(function() {
        //   if (v.form()) {
        //     $(".frm").hide("fast");
        //     $("#sf2").show("slow");
        //   }
        // });

      });
//       var bussID=0;
      function setNUPType(Id,product){
            
            var site_url = '<?php echo base_url("c_nup/chosen_nup_type")?>';
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

          var site_url2 = '<?php echo base_url("c_nup/zoom_property_edit")?>';
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
            
            var site_url = '<?php echo base_url("c_nup/chosen_location")?>';
                $.post(site_url,
                  {Id:Id},
                  function(data,status) {
                    $("#Location").empty();
                    $("#Location").append(data);
                    $("#Location").trigger('change');
                  }
                );
        }
//         function setcountrycd(Id){
            
//             var site_url = '<?php echo base_url("c_nup/chosen_country")?>';
//                 $.post(site_url,
//                   {Id:Id},
//                   function(data,status) {
//                     $("#country_cd").empty();
//                     $("#country_cd").append(data);
//                     $("#country_cd").trigger('chosen:updated');
//                   }
//                 );
//         }

//        function setpayment(Id){
            
//             var site_url = '<?php echo base_url("c_nup/chosen_payment")?>';
//                 $.post(site_url,
//                   {Id:Id},
//                   function(data,status) {
//                     $("#payment").empty();
//                     $("#payment").append(data);
//                     $("#payment").trigger('chosen:updated');
//                   }
//                 );
//         }
function setcity(Id){

  var site_url = '<?php echo base_url("c_nup/chosen_city")?>';
  $.post(site_url,
    {Id:Id},
    function(data,status) {
      $("#city").empty();
      $("#city").append(data);
      $("#city").trigger('change');
    }
    );
}
//         Loaddata();
function setnationality(Id){
        
        var site_url = '<?php echo base_url("c_nup/chosen_nationality")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#nationality").empty();
                $("#nationality").append(data);
                $("#nationality").trigger('change');
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
                $('div.modal-body').load("<?php echo base_url('c_nup_dt/addNew');?>"); //+"/"+descs+"/"+rowID);
                // $('#modal').data('descs', descs);
                
                $('#modal').data('sn', sn);
                $('#modal').data('id', rowID).modal('show');
}
function Loaddata() {

  var ID = '<?php echo $rowID;?>';
          // alert(status+' '+ID);
          var site_url = '<?php echo base_url("c_nup/show_edit_data")?>'+'/'+ID;
          // alert(status);
          $.getJSON(site_url, function (data) {                
                // console.log(data);
                var m_names = new Array("Jan", "Feb", "Mar", 
                  "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
                  "Oct", "Nov", "Dec");
                var d = new Date(data[0].reserve_date);
                var curr_date = d.getDate();
                var curr_month = d.getMonth();
                var curr_year = d.getFullYear();
                var dt = curr_date + " " + m_names[curr_month]+ " " + curr_year;
                var country_cd = data[0].country_code;
                var nationality = data[0].nationality;
                var Handphone = data[0].Handphone;
                var telp = Handphone.substring(country_cd.length,Handphone.length);
                console.log(telp);
                // var telp = Handphone.substring(country_cd.length,Handphone.length);
                

                $('#customer').val(data[0].NAME);                
                $('#HP').val(telp);
                // $('#HP').val(Handphone);
                $('#country_cd').val(country_cd).trigger('change');
                // $('#nationality').val(nationality).trigger('change');
                setnationality(data[0].nationality);
                $('#Email').val(data[0].Email);
                $('#seqno').val(data[0].nup_sequence_no);
                $('#noktp').val(data[0].Id_No);

                $('#address').val(data[0].ADDRESS);
                setcity(data[0].city);
                $('#npwp').val(data[0].NPWP);
                setNUPType(data[0].nup_type,data[0].product_cd);
                $('#nupdesc').val(data[0].rl_reserve_descs);
                $('#rsvdate').val(dt);
                // // $('#rsvname').val(data[0].agent_name);
               setProperty(data[0].product_type,data[0].product_cd);
                $('#nuptype').val(data[0].descs);
                $('#property').val(data[0].property_descs);
                // var abc = data[0].product_cd;
                // alert(abc);
                // document.getElementById(data[0].product_cd).checked = true;
                
                var inputs = document.getElementsByName('product');
                for (var i = 0, len = inputs.length; i<len; i++){
                    inputs[i].disabled = true;
                }


                $('#product').text(data[0].product_descs);
                
                $('#nupamt').val(formatNumber(data[0].nup_amt));
                
                setLocation(data[0].location_cd);
               
                $('#noktp').val(data[0].ic_no);
                $('#address').val(data[0].Address);
                $('#business_id').val(data[0].business_id);
                
                // var nation = data[0].nationality;
                // // console.log(nation);
                // if (nation != 01){
                //   document.getElementById('lblnoktp').style.visibility = 'hidden';
                //   document.getElementById('lblnopass').style.visibility = 'visible';        
                //   document.getElementById('lblnpwp').style.visibility = 'hidden';        
                //   document.getElementById('npwp').style.visibility = 'hidden';
                // }else{
                //   document.getElementById('lblnoktp').style.visibility = 'visible';
                //   document.getElementById('lblnopass').style.visibility = 'hidden'; 
                //   document.getElementById('lblnpwp').style.visibility = 'visible';        
                //   document.getElementById('npwp').style.visibility = 'visible';
                // }                                
              });
        }

        var tableatt;
        $(document).ready(function(){
            
            $("#wizard").steps();


            $("#form").steps({
                bodyTag: "fieldset",
                enableCancelButton: true,
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // console.log('a ' + currentIndex);
                    // console.log('b ' + newIndex);

                   var chosen = '<?php echo $TotQty; ?>';

                   if(chosen<3)
                    {
                      swal("Warning","You have to choose minimum 3 units!","error");
                      return false;
                    }
                    if (chosen>5)
                    {
                      swal("Warning","Units chosen must be less than 5!","error");
                      return false;
                    }


                  
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    if(newIndex === 2 && currentIndex === 1){
                      // if($('#form').valid())
                      // {

                      // // $(this).steps("next");
                      //   var dataform = $('#form').serializeArray();
                      //   var site_url = "<?php echo base_url('C_nup_dt/savenup2')?>";
                      //   // var home = "<?php echo base_url('c_choose_unit_nup/indexNew')?>";
                      //   $.ajax({
                      //     url: site_url,
                      //     type: "POST",
                      //     data: dataform,
                      //     dataType: "json",
                      //     success: function(data, status){
                      //       // console.log(data);
                      //       if(status=='success'){
                      //         // swal(
                      //         // {
                      //         //   title: "Information",
                      //         //   text: data.pesan,
                      //         //   type: "success",
                      //         //   confirmButtonText: "OK"
                      //         // },
                      //         // function(){
                      //         //   return true;
                      //         // });
                      //       } else {
                      //         swal({
                      //           title: "Error",
                      //           text: data.pesan,
                      //           type: "error",
                      //           confirmButtonText: "OK"
                      //         },
                      //         function(){
                      //           return false;
                      //         });
                      //       }
                      //     },
                      //     error: function(jqXHR, textStatus, errorThrown){
                      //       swal(textStatus+' Save : '+errorThrown);
                      //       return false;
                      //     }
                      //   });

                      // }

                    }
                    // Forbid suppressing "Warning" step if the user is to young
                    // if (newIndex === 3 && Number($("#age").val()) < 18)
                    // {
                    //     return false;
                    // }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // console.log('c ' + currentIndex);
                    // console.log('d ' + priorIndex);

                    if (currentIndex === 1 && priorIndex === 0){
                      $("#form .actions a[href='#finish']").show();
                      $("#form .actions a[href='#cancel']").hide(); 
                      // $(this).steps("previous");
                    }

                    if(currentIndex < 1){
                      $("#form .actions a[href='#finish']").hide();
                      $("#form .actions a[href='#cancel']").show();
                      // $(this).steps("previous");
                    }
                },
                // onFinishing: function (event, currentIndex)
                // {
                //     var form = $(this);

                //     // Disable validation on fields that are disabled.
                //     // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                //     form.validate().settings.ignore = ":disabled";

                //     // Start validation; Prevent form submission if false
                //     return form.valid();
                // },
                onFinished: function (event, currentIndex)
                {
                    // console.log(currentIndex);
                    if(currentIndex=='1')
                    {
                      if($('#form').valid())
                      {

                      // $(this).steps("next");
                        var dataform = $('#form').serializeArray();
                        var site_url = "<?php echo base_url('C_nup_dt/savenup2')?>";
                        // var home = "<?php echo base_url('c_choose_unit_nup/indexNew')?>";
                        $.ajax({
                          url: site_url,
                          type: "POST",
                          data: dataform,
                          dataType: "json",
                          success: function(data, status){
                            // console.log(data);
                            if(status=='success'){
                              swal(
                              {
                                title: "Information",
                                text: data.pesan,
                                type: "success",
                                confirmButtonText: "OK"
                              },
                              function(){
                                // return true;
                                window.location.href="<?php echo base_url('c_choose_unit_nup/indexNew/')?>";
                              });
                            } else {
                              swal({
                                title: "Error",
                                text: data.pesan,
                                type: "error",
                                confirmButtonText: "OK"
                              },
                              function(){
                                return false;
                              });
                            }
                          },
                          error: function(jqXHR, textStatus, errorThrown){
                            swal(textStatus+' Save : '+errorThrown);
                            return false;
                          }
                        });

                      }
                    }
                    // var form = $(this);
                      // form.validate().settings.ignore = ":disabled,:hidden";
                    // Submit form input
                    // form.submit();

                    // window.location.href="<?php echo base_url('c_choose_unit_nup/indexNew/')?>";
                },
                onCanceled: function (event) {
                  // console.log(event); 
                  window.location.href="<?php echo base_url('c_choose_unit_nup/indexNew/')?>";


                        // var modalClass = $('#modal').attr('class');
                        // switch (modalClass) {
                        //     case "modal fade bs-example-modal-lg":
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                        //         break;
                        //     case "modal fade bs-example-modal-md":
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                        //         break;
                        //     default:
                        //         $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                        //         break;
                        // }

                        // var modalDialogClass = $('#modalDialog').attr('class');
                        // switch (modalDialogClass) {
                        //     case "modal-dialog modal-lg":
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                        //         break;
                        //     case "modal-dialog modal-md":
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                        //         break;
                        //     default:
                        //         $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                        //         break;
                        // }

                        // $('#modalTitle').html('Go Back');

                        // $('div.modal-body').html('Are you sure that you want to reset the data and go back?');

                        // $('div.modal-body').append('<div class="modal-footer"></div>');

                        // var btnYes = $('<input/>')
                        //     .attr({
                        //         id: "btnYes",
                        //         type: "button",
                        //         class: "btn btn-danger",
                        //         onclick: 'ClearStep1();',
                        //         value: 'Yes'
                        //     });

                        // var btnNo = $('<a>No</a>').attr({
                        //     class: "btn btn-default", 'data-dismiss': "modal"
                        // });

                        // $('div.modal-footer').append(btnYes);
                        // $('div.modal-footer').append(btnNo);
                        // $('#modal').modal('show');

                    
                }
                
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        },
                        rules: {
                          HP:{
                            required: true,
                            number:true,
                            maxlength:12,
                            cek_telp:true
                            },
                            Email:{
                            required: true,
                            email:true
                            },
                            npwp:{
          // required: true,
                            check_npwp: true
                            },
                            noktp:{
                            required:true,
                            check_noktp: true
                            },

                            confirm: {
                                equalTo: "#password"
                            },
                            cntfile: {attached: true},
                            Location: {required:true}
                        },
                        messages: {cntfile: {attached: "Upload file need to completed"},
                        npwp: {check_npwp: "NPWP is not valid"},
                        noktp: {check_noktp: " IC No. Is not valid"},
                        HP:{cek_telp: "Handphone number is not valid"}}
                    });
                  $("#form .actions a[href='#finish']").hide();
                  // $("#form .actions a[href='#cancel']").hide();
                  // $("#cancel").html('Save');
                  $("#form .actions a[href='#cancel']").html('Back');


                  $(document).ready(function(){
                    $('.dataTables-example').DataTable({
                      // pageLength: 25,
                      responsive: true,
                      paging: false,
                      searching: false,
                      bInfo : false,
                      // dom: '<"html5buttons"B>lTfgitp',
                      buttons: [
                      // { extend: 'copy'},
                      // {extend: 'csv'},
                      // {extend: 'excel', title: 'ExampleFile'},
                      // {extend: 'pdf', title: 'ExampleFile'},

                    //   {extend: 'print',
                    //   customize: function (win){
                    //     $(win.document.body).addClass('white-bg');
                    //     $(win.document.body).css('font-size', '10px');

                    //     $(win.document.body).find('table')
                    //     .addClass('compact')
                    //     .css('font-size', 'inherit');
                    //   }
                    // }
                    ]
                  });
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
              console.log(isSuccess);

          });
            $.validator.addMethod("check_noktp", function (value, element) {
              var isSuccess = false;
              var noktp = $('#noktp').val();
              var nationality =  $('#nationality').find(':selected').val();
              
              if(nationality != 01) {
                  isSuccess=true;
              }else{        
                if(noktp.length > 16 || noktp.length < 16  ){
              
                }else{
                  isSuccess=true;
                }    
              } 
              return isSuccess;
              console.log(isSuccess);
            });

            $.validator.addMethod("check_npwp", function (value, element) {
              var isSuccess = false;
              var compnpwp = $('#npwp').val();         
              
              if(compnpwp.length == 0){
                isSuccess=true;
              }else if(compnpwp.length > 20 || compnpwp.length < 20  ){
              
              }else{
                isSuccess=true;
              }
              return isSuccess;
              console.log(isSuccess);
            });
            $.validator.addMethod("attached", function (value, element) {
              var isSuccess = false;
              var content = $('#cntfile').val();
              // BootstrapDialog.alert(content);
              // console.log(content);
              if(content < 1) {
                isSuccess = true;
              } else {
                isSuccess = false;
              }
              return isSuccess;
            });
            
            $(".select2_demo_1").select2({
              width:"100%"
            });
            $('#salutation').val('<?php echo $person->salutation?>').trigger('change');

            $(".select2_demo_2").select2({
              width:"100%",
              ajax:{
                url: '<?php echo base_url("c_nup/chosen_city_")?>',
                dataType: 'json',
                type: 'post',
                delay: 1000,
                data: function(params) {
                  // console.log(params);
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


          Loaddata();
        $('input:radio[name="product"]').change(function(){

        var prod = $(this).val();    
          // alert(prod);
          if(prod !=='') {
            $('#nupamt').val('');
            var site_url = '<?php echo base_url("c_nup/zoom_nuptype")?>';
            $.post(site_url,
              {prod:prod},
              function(data,status) {
                $("#nuptype").empty();
                $("#nuptype").append(data);
                $("#nuptype").trigger('change');
              }
            );
            var site_url2 = '<?php echo base_url("c_nup/zoom_property")?>';
            $.post(site_url2,
              {prod:prod},
              function(data,status) {
                $("#property").empty();
                $("#property").append(data);
                $("#property").trigger('change');
              }
            );
          } else {
            $("#nuptype").empty();
          }
        
      });
        
        // $(function(){
        //   $("#salutation").select2({
        //     width:"100%"
        //     }); 
        //   $("#country_cd").select2({
        //     width:"100%"
        //       }); 
        //   $("#nationality").select2({
        //           width:"100%"
        //       }); 
        //   $("#city").select2({
        //           width:"100%"
        //       }); 
        //   $("#Location").select2({
        //           width:"100%"
        //       }); 
        //   $("#reason_cd").select2({
        //           width:"100%"
        //       }); 

        // });

        tableatt = $('#tableatt').DataTable({
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
        "scrollX": true,
        ajax:{
            url:"<?php echo base_url('c_nup_dt/getTableAttachDoc')?>",
            data:{"seqno": function(d){
              // console.log(d);
              var a = $('#seqno').val();
              // console.log(a);
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
                var rows = tableatt.rows('.selected').indexes();
                if (rows.length < 1) {
                    swal('Please select a row');
                    return;
                }
                var data = tableatt.rows(rows).data();
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
                $('div.modal-body').load("<?php echo base_url('c_nup_dt/addNew');?>"); //+"/"+descs+"/"+rowID);
                $('#modal').data('descs', descs);
                $('#modal').data('sn', sn);
                $('#modal').data('id', data).modal('show');
            }
          }
        ],
        columns:[
            {data: "row_number", name: "rowID"},
            {data: "document_descs", name: "document_descs"},
            {data: "file_attachment", name: "file_attachment"},
            {
              // data: "rowID", name: "rowID", visible: false
              data: "rowID", name: "rowID",
                            render: function (data, type, row) {
                                // console.log(data);
                                var id = row.rowID;
                                var descs =row.document_descs;
                                var datas = new Array(id,descs);
                                ids = id;
                                descss = row.document_descs;
                                return '<a class="btn btn-primary btn-sm" onclick="Loadfile('+data+');"" ><i class="fa fa-users fa-fw"></i> Upload File</a>';
                                

                            }
            },
            {
               data: "rowID", name: "rowID", //visible: false
              // data: null, searchable:false,
                            render: function (data, type, row) {
                       
                                var seqno = row.nup_sequence_no;
                                // console.log(seqno);
                                var document_no = row.document_no;
                                
                                return '<a class="btn btn-primary btn-sm" href=' +'<?php echo base_url("c_nup_dt/downloadFile")?>'+'/'+seqno+'/'+document_no+'><i class="fa fa-download"></i> Download</a>';                                

                            }
            }

        ]
      });

    Loaddata();

    $('#nationality').change(function(){
      var nationality = $(this).find(':selected').val();
      // alert(nationality);
      if (nationality != 01){
        // document.getElementById('lblnoktp').style.visibility = 'hidden';                
        // document.getElementById('lblnopass').style.visibility = 'visible';
        // document.getElementById('lblnoktp').text('No. Passport / Passport No.<FONT COLOR="RED">*</FONT>');
        document.getElementById('lblnoktp').innerHTML = 'No. Passport / Passport No.<FONT COLOR="RED">*</FONT>';
        document.getElementById('lblnpwp').style.visibility = 'hidden';        
        document.getElementById('npwp').style.visibility = 'hidden';
        // $('#noktp').val('');
      }else{
        // document.getElementById('lblnoktp').style.visibility = 'visible';
        // document.getElementById('lblnopass').style.visibility = 'hidden'; 
        // document.getElementById('lblnoktp').text('No. KTP / ID No.<FONT COLOR="RED">*</FONT>');
        document.getElementById('lblnoktp').innerHTML = 'No. KTP / ID No.<FONT COLOR="RED">*</FONT>';
        document.getElementById('lblnpwp').style.visibility = 'visible';        
        document.getElementById('npwp').style.visibility = 'visible';
        // $('#noktp').val('');
      }      
    });
});

  function ClearStep1() {
    window.location.href="<?php echo base_url('c_choose_unit_nup/indexNew/')?>";
  }

  function landinfo(rowid, lotno, nup_no, balance, rowid_index, status)
  { 
    // var balance = $('#b_val').val();
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
                        
                        $('#modalTitle').html('Detail Information');
                        $('div.modal-body').load("<?php echo base_url("c_nup_dt/showland/");?>"+lotno+"/"+rowid+"/"+nup_no+"/"+balance+"/"+rowid_index+"/"+status);
                        // $('#modal').data('balance',balance);
                        $('#modal').modal('show');
                        // modalDialog
                        // $('.modal-dialog').draggable({
                        //     handle: ".modal-header"
                        // });
                        $('#modal').data('Id',rowid);
    
   
  }


  
    </script>

