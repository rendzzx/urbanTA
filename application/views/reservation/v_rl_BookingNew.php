<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/pickers/daterange/daterangepicker.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/pickers/daterange/daterange.css')?>">
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title"><?php echo $project; ?><br>Sales Booking Entry</h3>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
                      <div class="row">
                        <div class="col-11" style="margin:20px">
                          <div class="ibox-content">
                            <div class="row">
                              <div class="col-6">
                                <div class="form-group">
                                  <label class=" control-label">Nama / Name<FONT COLOR="RED">*</FONT></label>
                                  <div class="col-12">                  
                                    <input type="text" class="form-control " name="customer" id="customer" placeholder="Input Name">
                                  </div>
                                </div>
                              </div>
                              <div class="col-6">
                                  <div class="form-group">
                                    <label class="control-label">HP / Mobile<FONT COLOR="RED">*</FONT></label>
                                    <div class="col-12">
                                      <input type="text" class="form-control" name="HP" id="HP" data-inputmask="'mask':'999999999999'" placeholder="8xxxxxxxxxx">
                                      Format: 21995500 | 89895098987
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Email<FONT COLOR="RED">*</FONT></label>
                              <div class="col-12">
                                <input type="text" class="form-control" name="Email" id="Email" placeholder="Input Email">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Nationality</label>
                              <div class="col-12">
                                <select class="select2_demo_1 form-control " name="nationality" id="nationality" ><?php echo $cbnationality ?></select>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label" name="lblnoktp" id="lblnoktp">No. KTP / ID No.<FONT COLOR="RED">*</FONT></label>
                              <label class="control-label" name="lblnopass" id="lblnopass" hidden="true">No. Passport / Passport No.<FONT COLOR="RED">*</FONT></label>                 
                              <div class="col-12">
                                <input type="text" class="form-control" name="noktp" id="noktp" placeholder="Input ID Number">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class=" control-label">Alamat / Address<FONT COLOR="RED">*</FONT></label>                
                              <div class="col-12">
                                <textarea class="form-control" placeholder="Input Address" name="address" id="address" style=" height: 50px;"></textarea>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-8">
                                <div class="form-group">
                                  <label class=" control-label">Reservation Type<FONT COLOR="RED">*</FONT></label>
                                  <div class="col-12">                  
                                    <select class="select2_demo_2 form-control"  name="reserv" id="reserv" onchange="changereserv()" ><?php echo $nuptype?></select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-4">
                                  <div class="form-group">
                                    <label class="control-label">Amount<FONT COLOR="RED">*</FONT></label>
                                    <div class="col-12">
                                       <input type="text" class="form-control " name="amount" id="amount" value="0" disabled="">
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Remarks<FONT COLOR="RED">*</FONT></label>
                              <div class="col-12">                  
                                <input type="text" class="form-control" name="remark" id="remark" placeholder="Your Remarks">
                                <input type="hidden" name="lot_no" value="<?php echo $lot_no;?>" id="lot_no">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label">Upload Document</label>
                              <div class="col-12">
                                <input type="hidden" name="seqno" value="<?php echo $seqno;?>" id="seqno">                
                                <input type="hidden" name="txt_tax_cd" id="txt_tax_cd">
                                <input type="hidden" id="txt_contractprice" name="txt_contractprice">
                                <input type="hidden" id="txt_debtor" name="txt_debtor" >
                                <table id="tblattach" class="display table-striped" cellspacing="0" width="100%">
                                  <thead>            
                                    <th >No</th>
                                    <th width="50%">Criteria</th>
                                    <th width="40%">Preview</th>
                                    <th >Upload</th>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>KTP</td>
                                    <td></td>
                                    <td><span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i><span class="hidden-xs"> Upload File</span><input type="text" id="userfile" name="userfile" accept="image/*" onclick="upload('ktp')" /></span><b>Max Size 10 MB.</b><input type="hidden" name="row" id="row'+id+'" value="'+id+'"><input type="hidden" name="sn" id="sn'+id+'" value="'+sn+'"></td>
                                  </tr>
                                  <tr>
                                    <td>2</td>
                                    <td>NPWP</td>
                                    <td></td>
                                    <td><span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i><span class="hidden-xs">Upload File</span><input type="text" id="userfile" name="userfile" accept="image/*" onclick="upload('npwp')" /></span><b>Max Size 10 MB.</b><input type="hidden" name="row" id="row'+id+'" value="'+id+'"><input type="hidden" name="sn" id="sn'+id+'" value="'+sn+'"></td>
                                  </tr>
                                  <tr>
                                    <td>3</td>
                                    <td>Bukti Transfer</td>
                                    <td></td>
                                    <td><span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i><span class="hidden-xs">Upload File</span><input type="text" id="userfile" name="userfile" accept="image/*" onclick="upload('bukti')" /></span><b>Max Size 10 MB.</b><input type="hidden" name="row" id="row'+id+'" value="'+id+'"><input type="hidden" name="sn" id="sn'+id+'" value="'+sn+'"></td>
                                  </tr>
                                  </tbody>
                                </table>
                              </div> 
                              <input type="hidden" id="ktp" name="ktp">              
                              <input type="hidden" id="npwp" name="npwp">              
                              <input type="hidden" id="bukti" name="bukti">               
                            </div>                 
                          </div>
                        </div>            
                      </div>
                    </form>
                </div>
              </div>
            </div>
             <div class="box-footer">
                <input type="button" name="submit" id="submit" value="Save" class="btn btn-primary">
                <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-default">            
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
<!-- JAVASCRIPT -->
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
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
 #hahaload{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("<?php echo base_url('img/loading.gif')?>") no-repeat center center;
  }

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
function tampil_data(){

      // alert(data);
        var site_url    = "<?php echo site_url('C_rl_sales/set_field2/');?>";
        var payment_cd  = $('#payment').val();
        // console.log(payment_cd);
        
        if(payment_cd){
          document.getElementById("btnView").disabled = false;
        }
        // alert(lot_unit+' ====== '+payment_cd);return;
        var response = "";
        var tes = "";
        if(payment_cd == null){
          return;
        }

         if(lot_unit.length==0){
          return;
        }
        if(payment_cd.length==0){
          return;
        }
         $.ajax({
        type: "POST", 
        url: site_url, 
        data: { lot_no: lot_unit ,payment: payment_cd},
        success: function(response)
        {
            
          if(response.length==0){
     
             $('#txt_list_bf_price').val('');
             $('#txt_discount').val('');
             $('#txt_netprice').val('');
             $('#txt_tax_cd').val('');
             $('#txt_listamt').val('');
             $('#txt_contractprice').val('');

          }else{
              
             var lb_price = response[0].list_before_price;
             var dsc = response[0].disc;
             var sp_dsc_amt = $("#txt_aditional_disc").val();
             sp_dsc = replaceAll(sp_dsc_amt, ',','');
             if(!lb_price) {
              lb_price = 0;
             }
             if(!sp_dsc) {
              sp_dsc = 0;
             }
             var net_price = lb_price - dsc - sp_dsc;
             
             // document.getElementById("txt_list_bf_price"+data).innerHTML = formatNumber(response[0].list_before_price);
             $('#txt_list_bf_price').val(formatNumber(response[0].list_before_price));
             // document.getElementById("txt_discount"+data).innerHTML      = formatNumber(response[0].disc);
             $('#txt_discount').val(formatNumber(response[0].disc));
             // document.getElementById("txt_netprice"+data).innerHTML      = formatNumber(net_price);
             $('#txt_netprice').val(formatNumber(net_price));
             // document.getElementById("txt_tax_cd"+data).innerHTML        = response[0].land_tax_cd;
             // $('#txt_tax_cd').val(response[0].land_tax_cd);
             
             $('#txt_tax_cd').val(response[0].land_tax_cd);
             $('#txt_listamt').val(formatNumber(response[0].list_tax_amt));
             $('#txt_contractprice').val(formatNumber(response[0].contract_price));
                   
         }         
         
        
        },
        dataType: "json"//set to JSON    
        }); 
    }
    function hitung_ulang_disc(){
        var site_url        = "<?php echo site_url('C_rl_sales/hitung_ulang_disc/');?>";
       var aditional_disc = $('#txt_aditional_disc').val(); 
       var aditional_DC = replaceAll(aditional_disc, ',','');
       // console.log(aditional_DC);
       var list_price = $('#txt_list_bf_price').val();//document.getElementById("txt_list_bf_price").value;
       var plan_disc = $('#txt_discount').val();//document.getElementById("txt_discount").value;
       var tax_cd   = $('#txt_tax_cd').val();
       var response ='';
       // console.log('2');
       if($('#payment').val()==""){
            sweetAlert("Warning","Payment cannot be blank","error");
           }
           else{
            $.ajax({
                type:"POST",
                url: site_url,
                dataType: "json",
                data:{aditional_disc:aditional_DC,list_price:list_price,plan_disc:plan_disc,tax_cd:tax_cd},
                success: function(response){
                  
                   // document.getElementById("txt_netprice").innerHTML      = formatNumber(response[1].net_price);       //net price
                   $('#txt_netprice').val(formatNumber(response[1].net_price));
                  // document.getElementById("txt_listamt").innerHTML       = formatNumber(response[1].list_tax_amt);
                  $('#txt_listamt').val(formatNumber(response[1].list_tax_amt))
                  // document.getElementById("txt_contractprice"+data).innerHTML = formatNumber(response[1].sales_price);
                  $('#txt_contractprice').val(formatNumber(response[1].sales_price))
                  // alert(response[1].net_price);

                },
                 error: function(jqXHR, textStatus, errorThrown){
                
                 }
              });
           }
      }
function fn_disc(){

        var discno = $("#disc").val();
        
        var list_price = $("#txt_list_bf_price").val();
        var price = replaceAll(list_price, ',','');
        
        var disc = $("#txt_discount").val();
        var disc_amt = replaceAll(disc, ',','');
        price = price - parseFloat(disc_amt);
        // BootstrapDialog.alert(price);
        var result = 0;
        if (discno=='NA') {
          
          var net_price = price - result;
          $("#txt_aditional_disc").val(formatNumber(result));
          
        } else { 
          // var price = replaceAll(list_price, ',','');
          var result = (parseInt(discno) * parseInt(price)) / 100 ;
         
          var net_price = price - result;
          $("#txt_aditional_disc").val(formatNumber(result));
        }
        $('#txt_netprice').val(formatNumber(net_price));
        
      }
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

  <script type="text/javascript">


    var table;
    var ids;
    var descss;
    
   
    $(function() {
      
    $('#salutation').select2({
                width: '100%',
                placeholder: 'select Salutation'
            });
    $('#country_cd').select2({
                width: '100%',
                placeholder: 'select Country'
            });
    $('#nationality').select2({
                width: '100%',
                placeholder: 'select Nationality'
            });
    $('#payment').select2({
                width: '100%',
                placeholder: 'select Payment'
            });
    $('#disc').select2({
                width: '100%',
                placeholder: 'select Special Discount'
            });
     $('#paymenttype').select2({
                width: '100%',
                placeholder: 'select Payment Method'
            });
     $('#reserv').select2({
                width: '100%',
                placeholder: 'Select Reservation Type'
            });
   
      Loaddata();
  

     
    });

function changereserv(){
  var test = $('#reserv').find(':selected').val();
  var reservation = test.split("-");
  $('#amount').val(reservation[3]);
}

function UploadImage(rowid,el){
        // console.log(el);
        document.getElementById('hahaload').hidden=false; 
        // alert('hahaload');
      // return;
        var a = el.files[0].size;
        var max = (1024 *1024) * 7;
        
        if (a > max){
  
            
            if (max.toString().length > 6) {
                max = max / 1024 / 1024;
                max = max.toFixed(2);
                max = max + ' mb';
            } else {
                max = max / 1024;
                max = max.toFixed(2);
                max = max + ' kb';
            }
            swal('Please upload less than ' + max);
            return false;
        }

     

        
        var datafrm = new FormData( $('#frmPic'+rowid)[0] );
        // console.log(datafrm);

        $.ajax({
                url : "<?php echo base_url('c_reservation/saveUpload');?>",
                type:"POST",
                data: function () {
                    var data = new FormData();
                    data.append("row", $("#row"+rowid).val());
                    data.append("sn", $("#row"+rowid).val());
                    data.append("userfile", $("#userfile"+rowid).get(0).files[0]);
                    return data;
                }(),
                processData: false,
                contentType: false,
                dataType:"json",
                success:function(data, status){
                  console.log(data.pesan);
                if(data.status == "OK"){
                      swal({
                        title: "Information",
                        text: data.pesan,
                        type: "success",
                        confirmButtonText: "OK"
                      },
                      function(){
                        document.getElementById('hahaload').hidden=true; 
                        // readURL(el,rowid);
                         table.ajax.reload(null,true);

                        // window.location.href="<?php echo base_url('c_cs/insert');?>";
                      });
                    } else {
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      document.getElementById('hahaload').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                }
            });



}

  function upload(type){
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
                $('#modalTitle').html('<b>Add  </b>'+type);
                // alert(rowID);
                $('div.modal-body').load("<?php echo base_url('c_reservation/addNew');?>"); //+"/"+descs+"/"+rowID);
                $('#modal').data('type', type);
                // $('#modal').data('sn', sn);
                // $('#modal').data('id', data).modal('show');
                $('#modal').modal('show');
            }

    function readURL(input,rowid) 
    {
      // alert(id);
        if (input.files && input.files[0])
        {
          // alert(rowid);
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#picturebox'+rowid).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

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
  var site_url = '<?php echo base_url("c_nup/downloadFile")?>';
            $.post(site_url,
              {seqno:seqno,document_no:document_no},
              function(data,status) {
                
              }
            );
}
function Loadfile(rowID){
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
                $('div.modal-body').load("<?php echo base_url('c_reservation/addNew');?>"); //+"/"+descs+"/"+rowID);
                // $('#modal').data('descs', descs);
                
                $('#modal').data('sn', sn);
                $('#modal').data('id', rowID).modal('show');
}
   

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
        reserv: {required: true},  
        bankcd: {required: true},
        country_cd:{required: true},
        Location:{required: true}
        // ,cntfile: {attached: true}
      },
      messages: {
      // {cntfile: {attached: "Upload file need to completed"},
                // npwp: { cek_npwp: "NPWP is not valid"},
                noktp: {check_noktp: " IC No. Is not valid"},
                HP: {cek_telp: "Handphone number is not valid"} 
              },
      errorElement: "em",
      errorPlacement: function(error, element){
        error.addClass("help-block  text-red");
        element.parents(".col-xs-5").addClass("has-feedback  text-red");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
        } else {
            error.insertAfter(element);
        }

        if (!element.next("span")[0]) {
            $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 90%' ></span>").insertAfter(element);
        }
      },
      success: function(label, element){
        if (!$(element).next("span")[0]) {
            $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 90%'></span>").insertAfter($(element));
        }
      },
      highlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
        $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
      },
      unhighlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
        $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
      }
    });

 // $('#nationality').change(function(){
 //      var nationality = $(this).find(':selected').val();
 //      // alert(nationality);
 //      if (nationality != 01){
 //        document.getElementById('lblnoktp').hidden=true;
 //        document.getElementById('lblnopass').hidden=false;
 //        document.getElementById('lblnpwp').hidden=true;        
 //        document.getElementById('npwp').style.visibility = 'hidden';
 //        // $('#noktp').val('');
 //      }else{
 //        document.getElementById('lblnoktp').hidden=false;
 //        document.getElementById('lblnopass').hidden=true;
 //        document.getElementById('lblnpwp').hidden=false;        
 //        document.getElementById('npwp').style.visibility = 'visible';
 //        // $('#noktp').val('');
 //      }
      
 //    });
  $('#btnView').click(function(){
    var payment_cd = $('#payment').val();
    var selling_price = $('#txt_netprice').val();
    var payment_descs = $("#payment option:selected").text();

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
                $('#modalTitle').html('<b>Payment Schedule</b>');
                // alert(rowID);
                $('div.modal-body').load("<?php echo base_url('c_reservation/LotPriceList');?>"); //+"/"+descs+"/"+rowID);
                // $('#modal').data('descs', descs);
                
                $('#modal').data('unit', unit);
                $('#modal').data('descs', payment_descs);
                $('#modal').data('selling_price', selling_price);
                $('#modal').data('payment_cd', payment_cd).modal('show');
  });
  $('#submit').click(function(){


    if($('#form_nup').valid())
      {
        // alert('dor');
        // return;   
        // swal("Loading","Done","success");
        document.getElementById('hahaload').hidden=false; 
        var dataform = $('#form_nup').serializeArray();
        console.log(dataform);
        // return;
        // dataform.push(
        //                 {name:"unit",value:unit},
        //                 {name:"booking_fee",value:booking_fee},
        //                 {name:"Product_cd",value:Product_cd},
        //                 {name:"rowID",value:ID}

        //               );
        var site_url = "<?php echo base_url('c_reservation/savenup')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: dataform,
          dataType: "json",
          success: function(data, status){

           document.getElementById('hahaload').hidden=true; 
        

            if(data.status !='Failed'){
                  swal({
                    title: "Information",
                    text: data.pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){
                    // alert("<?php echo base_url('c_nup/Index');?>");
                    window.location.href="<?php echo base_url('c_reservation/index');?>"
                  });
                } else {
                  swal({
                    title: "Error",
                    text: data.pesan,
                    type: "error",
                    confirmButtonText: "OK"
                  });
                }

            // window.location.href="<?php echo base_url('c_nup/Index')?>";
            // console.log(data.pesan);
            // console.log(status);
          },
          error: function(jqXHR, textStatus, errorThrown){
            document.getElementById('hahaload').hidden=true; 
            // document.getElementById("submit").disabled = false;
            swal(textStatus+' Save : '+errorThrown);
          }
        })
      }
    
  });
  

    $('#btnback').click(function(){
     
      var seqno =$('#seqno').val();

      var site_url = '<?php echo base_url("c_nup/check_delete_attachment") ?>';
        $.post(site_url,
          {seqno:seqno},
          function(data,status){
            // console.log(data);
            // alert(data);

             var url = '<?php echo base_url("c_reservation/index")?>';
              window.location.href=url;
          },
          'json'
          );

    });
    function Loaddata(){
      // console.log(ID);
      // alert(status+' '+ID);
      var ID = '<?php echo $rowIdsales;?>';
      console.log(ID);
      
      var site_url = '<?php echo base_url("c_reservation/show_edit_data")?>'+'/'+ID;
      // alert(status);
      if(ID>0){
          $.getJSON(site_url, function (data) {  
                var country_cd = data[0].country_code;
                var Handphone = data[0].Handphone;
                // var telp = Handphone.substring(country_cd.length,Handphone.length);
                var payment = data[0].payment_type;
                // console.log();
                 $('#salutation').select2({
                        width: '100%',
                        // theme: "bootstrap",
                        placeholder: 'select Salutation'
                    }).val(data[0].salutation).trigger("change");
                 $('#nationality').select2({
                        width: '100%',
                        // theme: "bootstrap",
                        placeholder: 'select Nationality'
                    }).val(data[0].nationality).trigger("change");
                 $('#payment').select2({
                        width: '100%',
                        // theme: "bootstrap",
                        placeholder: 'select Payment'
                    }).val(data[0].payment_cd).trigger("change");
                 $('#paymenttype').select2({
                        width: '100%',
                        // theme: "bootstrap",
                        placeholder: 'select Payment'
                    }).val(data[0].payment_type).trigger("change");
                 // $('#media').select2({
                 //        width: '100%',
                 //        // theme: "bootstrap",
                 //        placeholder: 'select Payment'
                 //    }).val(data[0].media_cd).trigger("change");
                 $('#city').select2({
                        width: '100%',
                        // theme: "bootstrap",
                        placeholder: 'select City'
                    }).val(data[0].nuptype).trigger("change");
                 setcity(data[0].nuptype);
                $('#customer').val(data[0].NAME);                
                $('#HP').val(Handphone);
                $('#Email').val(data[0].Email);
                $('#address').val(data[0].address1);                
                $('#npwp').val(data[0].income_tax);
                $('#lot_no').val('');
                $('#remarkspayment').val(data[0].payment_type_remarks);
                var nation = data[0].nationality;
                // alert(nation);
                $('#noktp').val(data[0].ic_no);
                // console.log(data[0].city);
                if (nation != 01){
                  document.getElementById('lblnoktp').hidden=true;
                  document.getElementById('lblnopass').hidden=false;
                  // document.getElementById('lblnpwp').hidden=true;        
                  document.getElementById('npwp').style.visibility = 'hidden';
                  // $('#noktp').val('');
                }else{
                  document.getElementById('lblnoktp').hidden=false;
                  document.getElementById('lblnopass').hidden=true;
                  document.getElementById('lblnpwp').hidden=false;        
                  document.getElementById('npwp').style.visibility = 'visible';
                }
              });
         }         
    
  }
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

  </script> 

