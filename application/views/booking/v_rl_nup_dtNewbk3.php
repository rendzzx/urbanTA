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
  /*body {
    background-size:cover;
    height: 100%;
  }*/

  .fieldset-auto-width {
   display: inline-block;
   /*overflow-x:hidden;*/
   /*overflow-y:hidden;*/
   width:100%;
   height: 500px;
   vertical-align: middle;
 }

</style>

<link rel="icon" type="image/gif/png" href="<?=base_url('img/logo.png')?>">
<title>IFCA</title>

<link rel="stylesheet" href="<?=base_url('css/bootstrap.min.css')?>">   
<link rel="stylesheet" type="text/css" href="<?=base_url('font-awesome/css/font-awesome.min.css')?>"> 
<link href="<?=base_url('css/plugins/iCheck/custom.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet"> 
<link href="<?=base_url('css/animate.css')?>" rel="stylesheet">
<link href="<?=base_url('css/style.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<style>

  .wizard > .content > .body  {position: relative; }

</style>

<script src="<?=base_url('js/jquery-2.1.1.js')?>"></script>
<script src="<?=base_url('js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
<script src="<?=base_url('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/sweetalert/sweetalert.min.js')?>"></script>

<!-- Custom and plugin javascript -->
<script src="<?=base_url('js/inspinia.js')?>"></script>
<script src="<?=base_url('js/plugins/pace/pace.min.js')?>"></script>

<!-- Steps -->
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>"></script>
<!-- Jquery Validate -->
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>"></script>

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

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


  <!-- <div class="container" style="padding-left: 0px; padding-right: 15px;" >
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Complete this form in quick 3 steps!</h3>
    </div>
    <div class="panel-body" >
            
    </div>
  </div>
</div> -->
<div class="content-wrapper">
    <div class="wrapper wrapper-content" >
      <div class="row">
        <div class="col-xs-12">
          <div class="ibox">
          <div class="ibox-title">
            <h3>Complete this form in quick 3 steps!</h3>
          </div>

          <div class="ibox-content" style="position: absolute; width: 100%; align-content: center;">
            <form id="form" action="#" class="wizard-big wizard clearfix" role="application" novalidate="novalidate">
            <div class="steps clearfix"></div>

              <h1>Choose Unit</h1>
              <fieldset id="form-p-1" style="padding-bottom: 0px; padding-right: 0px; padding-left: 0px; padding-top: 0px;">
                <h3>Step 1 of 3</h3>
                <div class="">
                  <section class="content-header">
                    <div class="tittle-top"><?php echo $ProjectDescs; ?></div>              
                  </section>
                  <section class="wrapper wrapper-content" style="padding-bottom: 0px;">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="ibox-content">
                          <div class="table-responsive">
                            <br>
                            <table border="0" width="100%">
                              <tr>
                                <td width="10%"><b>Nup No.</b></td>
                                <td >: <?php echo $NupNO; ?></td>
                                <td></td>
                                <td ></td>

                                <!-- <td >Type : <?php echo $NupDescs; ?></td> -->
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
                            <div class="box-body">
                              <?php echo $choosUnit; ?>
                              <!-- <a href="<?php echo base_url("c_nup_unit/index"); ?>/<?=$RowId?>/<?=$LotQty?>/<?=$NupNO?>" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</a> -->
                              <!-- <button class="btn btn-primary" onclick="ChooseUnit(<?=$RowId?>,<?=$LotQty?>,'<?=$NupNO?>')"><i class="fa fa-plus"></i>&nbsp;&nbsp;Choose Unit</button> -->
                              <!-- <a href="<?php echo base_url("c_nup/index"); ?> " class="btn bg-orange btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</a> -->

                            </div>                      
                            <div class="box-body"> 
                              <div id="example_wrapper" class="dataTables_wrapper">                  
                                <table id="example" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
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
                          </div> 
                        </div>                
                      </div>
                    </div>
                  </section>
                </div>

              </fieldset>

              <h1>Fill the Form</h1>
              <fieldset id="form-p-2">
                <div class="row">
                  <div class="col-xs-12">
                    <!-- <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" > -->

                    <div class="ibox-content">

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="control-label">Nama / Name<FONT COLOR="RED">*</FONT></label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select class="select2_demo_1 form-control col-sm-2" name="salutation" id="salutation" data-placeholder="Select Salutation">                  
                              <option></option>
                              <option value="Mr.">Mr.</option>
                              <option value="Mrs.">Mrs.</option>
                              <option value="Ms.">Ms.</option> 
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input type="text" class="form-control" name="customer" id="customer" placeholder="Input Name">
                          </div>
                        </div>     
                      </div>



                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>HP / Mobile<FONT COLOR="RED">*</FONT></label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select class="select2_demo_1 form-control" name="country_cd" id="country_cd" data-placeholder="Select Country"><?php echo $comboCountry ?></select>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input type="text" class="form-control" name="HP" id="HP" placeholder="8xxxxxxxxxx">Format: 21995500 | 89895098987
                          </div>
                        </div>
                        <!-- bates baris -->
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Email<FONT COLOR="RED">*</FONT></label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input type="text" class="form-control" name="Email" id="Email" placeholder="Input Email">
                          </div>
                        </div>

                      </div>
                      <!-- bates sebaris -->
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Nationality</label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select class="select2_demo_1 form-control col-sm-2" name="nationality" id="nationality" data-placeholder="Select Salutation"><?php echo $cbnationality ?></select>
                          </div>
                        </div>
                      </div>

                      <!-- bates satu baris -->

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>No. KTP / ID No.<FONT COLOR="RED">*</FONT></label>
                            <!-- <label>No. Passport / Passport No.<FONT COLOR="RED">*</FONT></label> -->
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input type="text" class="form-control" name="noktp" id="noktp" placeholder="Input ID Number">
                          </div>
                        </div>     
                      </div>
                      <!-- bates sebaris -->
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Alamat / Address<FONT COLOR="RED">*</FONT></label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <textarea class="form-control" placeholder="Input Address" name="address" id="address" style=" height: 50px;"></textarea>
                          </div>
                        </div>
                      </div>

                      <!-- batas sebaris -->

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Kota / City<FONT COLOR="RED">*</FONT></label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <select class="select2_demo_2 form-control"  name="city" id="city" data-placeholder="Select City"><?php echo $comboCity ?></select>
                          </div>
                        </div>
                      </div>

                      <!-- bates sebaris -->
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>NPWP</label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Input NPWP">
                          </div>
                        </div>
                      </div>

                      <!-- bates baris -->

                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group" id="divproduct">
                            <label>Product<FONT COLOR="RED">*</FONT></label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">

                            <?php
                            foreach($product as $row)

                            {
                              $var = '<div class="col-xs-6">';
                              $var .='<label class="radio-inline">'; 
                              $var.=' <input style="margin-left: -30px;" type="radio" id="'.$row->product_cd.'" name="product" value=" '.$row->product_cd.'" tabindex="-2" />'.$row->descs;
                        // $var.=' <input type="radio" id="product" name="product" value="'.$row->product_cd.'" tabindex="-2" />'.$row->descs;
                              $var.=' </label>';
                              $var.=' </div>';
                              echo $var;
                            }  
                            ?> 
                          </div>
                        </div>
                      </div>
                      <!-- bates baris -->
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Property<FONT COLOR="RED">*</FONT></label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input type="text" id="property" name="property" value="" class="form-control" style="border:none; background-color:white;" readonly="readonly">
                          </div>
                        </div>
                      </div>
                      <!-- bates baris -->
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Tipe NUP / NUP Type<FONT COLOR="RED">*</FONT><input type="button" value="More Info" onclick="nuptypeinfo(1);" class="btn btn-info btn-xs">
                            </label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input class="form-control" name="nuptype" id="nuptype" readonly value="a">
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <!-- <label>Last name *</label> -->
                            <input class="form-control" name="nupamt" id="nupamt" readonly value="a">
                          </div>
                        </div>
                      </div>
                      <!-- bates baris -->
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label>Tanggal NUP / NUP Date<FONT COLOR="RED">*</FONT>
                            </label>
                          </div>
                        </div>
                        <div class="col-lg-4">
                          <div class="form-group">
                            <input class="form-control" name="rsvdate" id="rsvdate" value="<?php echo($today)?>" disabled="1">
                          </div>
                        </div>
                      </div>

                      <!-- bates baris -->
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="form-group">
                            <label class="control-label">Lokasi launcing yang dipilih /<br>Preffered launching location<FONT COLOR="RED">*</FONT>
                              <input type="button" value="More Info" onclick="nuptypeinfo(0);" class="btn btn-info btn-xs"></label>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <select class="select2_demo_1 form-control" name="Location" id="Location" data-placeholder="Select Location"><?php echo $comboLocation; ?></select> 
                            </div>
                          </div>
                        </div>

                        <!-- baris baru -->

                        <div class="row">
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="control-label">Upload Document</label>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <div class="ibox-content">
                                <input type="hidden" name="prefix" id="prefix">
                                <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>">
                                <input type="hidden" name="seqno" value="<?php echo $seqno;?>" id="seqno">
                                <!-- <input type="hidden" name="status" id="status" value="<?php echo $status;?>"> -->
                                <input type="hidden" name="cntfile" id="cntfile" value="<?php echo $cnt?>">

                                <table id="tblattach" class="display table-striped nowrap dataTable dtr-inline" cellspacing="0" width="100%">
                                  <thead >            
                                    <th >No</th>
                                    <th >Criteria</th>
                                    <th >Filename</th>
                                    <th >Upload</th>
                                    <th >Download</th>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table> 
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- bates baris -->

                      </div>              

                      

                    </div>            
                    <!-- </div> -->

                  </fieldset>

                  <h1>Finish</h1>
                  <fieldset id="form-p-3">
                    <h2>Step 3 of 3</h2>
                    <div class="text-center animated fadeInRight" style="margin-top: 120px">
                      <h2>Finished :-)</h2>
                    </div>

                  </fieldset>

                </form>
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
                        window.location.href="<?=base_url('c_nup_dt/list_dtNew/')?>"+"/"+data+"/1/<?php echo $rowid_index?>/<?php echo $status_index?>";
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

        
        $('#example').DataTable({
          'responsive': true,
          'paging': false,
          'searching': false,
        });

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
                // var payment = data[0].type;
                // // console.log(payment);

                $('#customer').val(data[0].NAME);                
                $('#HP').val(telp);
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
                document.getElementById(data[0].product_cd).checked = true;
                $('#product').text(data[0].product_descs);
                // $('#rsvname').text(data[0].agent_name);
                // $('#rsvgroup').val(data[0].agentype);
                // $('#rsvtype').val(data[0].group_name);
                // $('#rsvby').val(data[0].reserve_by);
                // $('#grpcd').val(data[0].group_cd);
                // $('#agtype').val(data[0].agent_type_cd);
                // setcountrycd(country_cd);
                $('#nupamt').val(formatNumber(data[0].nup_amt));
                // setpayment(payment);
                // $('#remarkspayment').val(data[0].payment_type_remarks);
                setLocation(data[0].location_cd);
                // $('#remarks_nup').val(data[0].remarks_nup);
                // $('#prefix').val(data[0].prefix);
                // $('#remarks').val(data[0].remarks_nup);
                $('#noktp').val(data[0].ic_no);
                $('#address').val(data[0].Address);
                // bussID = data[0].business_id;
              });
}


//       function back1st(){
//         var modalClass = $('#modal').attr('class');
//                         switch (modalClass) {
//                             case "modal fade bs-example-modal-lg":
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                 break;
//                             case "modal fade bs-example-modal-md":
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                 break;
//                             default:
//                                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
//                                 break;
//                         }

//                         var modalDialogClass = $('#modalDialog').attr('class');
//                         switch (modalDialogClass) {
//                             case "modal-dialog modal-lg":
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                 break;
//                             case "modal-dialog modal-md":
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                 break;
//                             default:
//                                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
//                                 break;
//                         }

//                         $('#modalTitle').html('Go Back');

//                         $('div.modal-body').html('Are you sure that you want to reset the data and go back?');

//                         $('div.modal-body').append('<div class="modal-footer"></div>');

//                         var btnYes = $('<input/>')
//                             .attr({
//                                 id: "btnYes",
//                                 type: "button",
//                                 class: "btn btn-danger",
//                                 onclick: 'ClearStep1();',
//                                 value: 'Yes'
//                             });

//                         var btnNo = $('<a>No</a>').attr({
//                             class: "btn btn-default", 'data-dismiss': "modal"
//                         });

//                         $('div.modal-footer').append(btnYes);
//                         $('div.modal-footer').append(btnNo);
//                         $('#modal').modal('show');

//       }
function ClearStep1() {
  window.location.href="<?php echo base_url('c_choose_unit_nup/indexNew/')?>";
}
//       function closestep() {
//         window.location.href= "<?php echo base_url('c_choose_unit_nup/indexNew')?>";
//       }

//       function back1(){
//         $(".frm").hide("fast");
//         $("#sf1").show("slow");
//       }

//       function back2(){
//         $(".frm").hide("fast");
//         $("#sf2").show("slow");
//       }

$(document).ready(function(){
  var tableatt;
  $("#wizard").steps();


  $("#form").steps({
    bodyTag: "fieldset",
    onStepChanging: function (event, currentIndex, newIndex)
    {
      console.log('changing');
      console.log(currentIndex,newIndex);
      var balance = '<?php echo $balance; ?>';
      if(balance>0)
      {
                      // alert('dor');
                      swal("Warning","You have to use all your balance!","error");
                      return false;

                    }
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                      return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                      return false;
                    }

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
                    console.log('changed');
                    console.log(event,currentIndex,priorIndex);

                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                      $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                      $(this).steps("previous");
                    }

                    
                  },
                  onFinishing: function (event, currentIndex)
                  {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                  },
                  onFinished: function (event, currentIndex)
                  {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                  },
                  onCanceled: function (event) {


                    var modalClass = $('#modal').attr('class');
                    switch (modalClass) {
                      case "modal fade bs-example-modal-lg":
                      $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                      break;
                      case "modal fade bs-example-modal-md":
                      $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                      break;
                      default:
                      $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                      break;
                    }

                    var modalDialogClass = $('#modalDialog').attr('class');
                    switch (modalDialogClass) {
                      case "modal-dialog modal-lg":
                      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                      break;
                      case "modal-dialog modal-md":
                      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                      break;
                      default:
                      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                      break;
                    }

                    $('#modalTitle').html('Go Back');

                    $('div.modal-body').html('Are you sure that you want to reset the data and go back?');

                    $('div.modal-body').append('<div class="modal-footer"></div>');

                    var btnYes = $('<input/>')
                    .attr({
                      id: "btnYes",
                      type: "button",
                      class: "btn btn-danger",
                      onclick: 'ClearStep1();',
                      value: 'Yes'
                    });

                    var btnNo = $('<a>No</a>').attr({
                      class: "btn btn-default", 'data-dismiss': "modal"
                    });

                    $('div.modal-footer').append(btnYes);
                    $('div.modal-footer').append(btnNo);
                    $('#modal').modal('show');

                    
                  }
                }).validate({
                  errorPlacement: function (error, element)
                  {
                    element.before(error);
                  },
                  rules: {
                    confirm: {
                      equalTo: "#password"
                    }
                  }
                });


                $(".select2_demo_1").select2();
                $('#salutation').val('<?php echo $person->salutation?>').trigger('change');
                $(".select2_demo_2").select2({ 
                            ajax:{ 
                                url: '<?php echo base_url("c_nup/chosen_city_")?>', 
                                dataType: 'json', 
                                type: 'post', 
                                delay: 1000, 
                                data: function(params) { 
                                    return{ 
                                        q: params.term 
                                    }; 
                                }, 
                                processResults: function(data) { 
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

                tableatt = $('#tblattach').DataTable({
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



      //   

    });
</script>
