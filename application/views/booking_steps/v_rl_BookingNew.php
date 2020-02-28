<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<!-- 
<script src="<?=base_url('js/plugins/inputmask/jquery.inputmask.bundle.min.js')?>"></script> -->


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
        var lot_unit    = '<?php echo $unit;?>';
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

<div id="hahaload" class="hahaload" hidden="true"></div>
<div class="content-wrapper">
  <div class="row border-bottom white-bg dashboard-header"> 
  
    <div class="form-group">
      <div class="tittle-top pull-left">            
      <?php echo $project; ?><br>
        <?php echo($agent)?>
      </div>
      <div class="tittle-top pull-right">Sales Booking Entry</div>
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
                <select class="select2_demo_1 form-control col-sm-2" name="salutation" id="salutation" >                  
                  <option></option>
                  <option value="Mr.">Mr.</option>
                  <option value="Mrs.">Mrs.</option>
                  <option value="Ms.">Ms.</option> 
                </select>
              </div>
              <div class="col-sm-4">                  
                <input type="text" class="form-control col-sm-5" name="customer" id="customer" placeholder="Input Name">
              </div>
            </div>              
            <div class="form-group">
              <label class="col-sm-3 control-label">HP / Mobile<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-3">
                <select class="select2_demo_1 form-control" name="country_cd" id="country_cd"><?php echo $comboCountry ?></select>
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
                <select class="select2_demo_1 form-control col-sm-2" name="nationality" id="nationality" ><?php echo $cbnationality ?></select>
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
                <select class="select2_demo_2 form-control"  name="city" id="city"></select>
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
              <label class="control-label"><?php echo $product_descs;?></label>                
               
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" id="Unit" name="Unit">Unit</label>                
              <div class="col-sm-7">
                <label class="control-label"><?php echo $unit;?></label>   
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Payment Method</label>
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control col-sm-2" name="payment" id="payment"  onchange="tampil_data()"><?php echo $payment_method ?></select>
              </div>
              <input type="button" name="btnView" id="btnView" value="Calculation" class="btn btn-primary" disabled>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">List Price(Exlude tax)</label>                
              <div class="col-sm-7">
                <input name="txt_list_bf_price" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txt_list_bf_price" readonly>
              </div>
            </div>
            <div class="form-group" hidden="hidden">
              <label class="col-sm-3 control-label">Plan Discount</label>                
              <div class="col-sm-7">
                <input name="txt_discount" class="form-control" align="left" style="border:none; background-color:white;" type="input" id="txt_discount" readonly>
              </div>
            </div>
            <div class="form-group" hidden="hidden">
              <label class="col-sm-3 control-label">Special Discount</label>
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control col-sm-2" name="disc" id="disc" data-placeholder="Select Special Discount" onchange="fn_disc()"><?php echo $special_discount ?></select>
              </div>              
            </div>
            <div class="form-group" hidden="hidden">
              <label class="col-sm-3 control-label"></label>                
              <div class="col-sm-7">
                <input name="txt_aditional_disc" class="form-control" align="left" type="input" onchange="hitung_ulang_disc()" id="txt_aditional_disc" >   
              </div>              
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Net Price</label>                
              <div class="col-sm-7">
                <input name="txt_netprice" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txt_netprice" readonly>
              </div>              
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Booking Fee</label>                
              <div class="col-sm-7">
                <label class="control-label"><?php echo $booking_fee_amt;?></label>   
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Upload Document</label>
              <div class="col-sm-7">
              <input type="hidden" name="seqno" value="<?php echo $seqno;?>" id="seqno">                
                <input type="hidden" name="cntfile" id="cntfile" value="<?php echo $cnt?>">
                <input type="hidden" id="txt_listamt" name="txt_listamt">
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
                  </tbody>
                </table>                  
              </div>                
            </div>                  
            <div class="form-group">
              <label class="col-sm-3 control-label">Cara Pembayaran /<br>Payment Method</label>
              <div class="col-sm-3">
                <select class="select2_demo_1 form-control" name="paymenttype" id="paymenttype" data-placeholder="Select Payment Method"><?php echo $payment; ?></select>                  
              </div>
              <div class="col-sm-4">
                <input class="form-control" name="remarkspayment" id="remarkspayment" placeholder="">
              </div>
            </div>
          </div>
          <br>
          <div class="box-footer">
            <input type="button" name="submit" id="submit" value="Save" class="btn btn-primary">
            <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-default">            
          </div>
        </form>
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
      // $('#media').select2({
      //           width: '100%',
      //           placeholder: 'select Media'
      //       });
      $("#npwp").inputmask({
        mask: "99.999.999.9-999.999"
      });     
      // $(".select2_demo_1").select2();

      $("#city").select2({
          ajax:{
            url: '<?php echo base_url("c_nup/chosen_city_")?>',
            dataType: 'json',
            type: 'post',
            delay: 1000,
            data: function(params) {
              document.getElementById('hahaload').hidden=false;
              return{
                q: params.term
              };
            },
            processResults: function(data) {
              
              document.getElementById('hahaload').hidden=true;
              return{
                results: data
              };
            },
            cache: false            
          },
          minimumInputLength: 3,
          placeholder: 'Select City'          
        });
      Loaddata();
      table = $('#tblattach').DataTable({
        dom: 'Bfrtip',
        select: true,
        info: false,
        lengthChange: false,
        ordering: false,
        searching: false,
        paging: false,
        processing: true,
        serverSide: true,
        // responsive: true,
        "scrollX": true,
        ajax:{
            url:"<?php echo base_url('c_booking_landed/getTableAttach')?>",
            data:{"seqno": function(d){
              var a = $('#seqno').val();
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
                $('div.modal-body').load("<?php echo base_url('c_booking_landed/addNew');?>"); //+"/"+descs+"/"+rowID);
                $('#modal').data('descs', descs);
                $('#modal').data('sn', sn);
                $('#modal').data('id', data).modal('show');
            }
          }
        ],
        columns:[
            {data: "row_number", name: "row_number"},
            {data: "document_descs", name: "document_descs"},
            {data: "file_attachment", name: "file_attachment",
                            render: function (data, type, row) {
                              // console.log(data);
                              var url = row.file_url;console.log(url);
                                if(url==null || url =='')
                                {
                                  return '';
                                } else {
                                  
                                  // var url = "<?php echo base_url('img/Booking/')?>"+data;
                                  return '<img src="'+url+'" width="120px" class="img-responsive" alt="'+data+'">';  
                                }
                                
                                

                            }},
            {
             
              data: "rowID", name: "rowID",
                            render: function (data, type, row) {
                                var id = row.rowID;
                                var no = row.row_number;
                                var descs =row.document_descs;
                                var datas = new Array(id,descs);
                                ids = id;
                                descss = row.document_descs;
                                var sn = $('#seqno').val();
                                // return '<a class="btn btn-primary btn-sm" onclick="Loadfile('+id+');"" ><i class="fa fa-users fa-fw"></i> Browse File</a>';
                                // return '<form id="frmPic'+id+'" enctype="multipart/form-data" method="post" ><span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i><span class="hidden-xs"> Browse File...</span><input type="file" id="userfile'+id+'" name="userfile" accept="image/*" onchange="UploadImage('+id+',this)" required/></span><b>Max Size 10 MB.</b><input type="hidden" name="row" id="row" value="'+id+'"><input type="hidden" name="sn" id="sn" value="'+sn+'"></form>';
                                return '<span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i><span class="hidden-xs"> Browse File...</span><input type="file" id="userfile'+id+'" name="userfile" accept="image/*" onchange="UploadImage('+id+',this)" /></span><b>Max Size 10 MB.</b><input type="hidden" name="row" id="row'+id+'" value="'+id+'"><input type="hidden" name="sn" id="sn'+id+'" value="'+sn+'">';
                                

                            }
            },
            // {
            //    data: "rowID", name: "rowID", //visible: false
            //   // data: null, searchable:false,
            //                 render: function (data, type, row) {
                       
            //                     var seqno = row.sales_seq_no;
            //                     // console.log(seqno);
            //                     var document_no = row.document_no;
                                
            //                     return '<a class="btn btn-primary btn-sm" href=' +'<?php echo base_url("c_booking_landed/downloadFile")?>'+'/'+seqno+'/'+document_no+'><i class="fa fa-download"></i> Download</a>';                                

            //                 }
            // }
            {data: "file_url", name: "file_url",visible:false}
        ]
      });

     
    });
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
                url : "<?php echo base_url('c_booking_landed/saveUpload');?>",
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
                $('div.modal-body').load("<?php echo base_url('c_booking_landed/addNew');?>"); //+"/"+descs+"/"+rowID);
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
        payment : {cek_npwp: true},    
        txt_list_bf_price: {cek_npwp: true},    
        // txt_discount: {cek_npwp: true},    
        // txt_aditional_disc: {cek_npwp: true},    
        txt_netprice: {cek_npwp: true},    
        bankcd: {required: true},
        country_cd:{required: true},
        Location:{required: true}
        // ,cntfile: {attached: true}
      },
      messages: {cntfile: {attached: "Upload file need to completed"},
                npwp: { cek_npwp: "NPWP is not valid"},
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
  $('#btnView').click(function(){
    var unit = '<?php echo $unit;?>';
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
                $('div.modal-body').load("<?php echo base_url('c_booking_landed/LotPriceList');?>"); //+"/"+descs+"/"+rowID);
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
        var unit = '<?php echo $unit;?>';
        var booking_fee = replaceAll('<?php echo $booking_fee_amt;?>', ',','');
        var Product_cd = '<?php echo $product_cd;?>';
        var ID = '<?php echo $rowIdsales;?>';
        var dataform = $('#form_nup').serializeArray();
        // console.log(dataform);
        // return;
        dataform.push(
                        {name:"unit",value:unit},
                        {name:"booking_fee",value:booking_fee},
                        {name:"Product_cd",value:Product_cd},
                        {name:"rowID",value:ID}

                      );
        var site_url = "<?php echo base_url('c_booking_landed/SaveBookAndCust')?>";
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
                    window.location.href="<?php echo base_url('c_booking/indexNew');?>"
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

             var url = '<?php echo base_url("c_booking/indexNew")?>';
              window.location.href=url;
          },
          'json'
          );

    });
    function Loaddata(){
    var seqno = "<?php echo $seqno;?>";
 
      var ID = '<?php echo $rowIdsales;?>';
      // console.log(ID);
      // alert(status+' '+ID);
      var site_url = '<?php echo base_url("c_booking_landed/show_edit_data")?>'+'/'+ID;
      // alert(status);
      if(ID>0){
        $.getJSON(site_url, function (data) {     
      // console.log(data);           
                // // console.log(data);
                // var m_names = new Array("Jan", "Feb", "Mar", 
                //                         "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
                //                         "Oct", "Nov", "Dec");
                // var d = new Date(data[0].reserve_date);
                // var curr_date = d.getDate();
                // var curr_month = d.getMonth();
                // var curr_year = d.getFullYear();
                // var dt = curr_date + " " + m_names[curr_month]+ " " + curr_year;
                var country_cd = data[0].country_code;
                var Handphone = data[0].hand_phone;
                var telp = Handphone.substring(country_cd.length,Handphone.length);
                var payment = data[0].payment_type;
                // console.log(payment);
                 $('#salutation').select2({
                        width: '100%',
                        // theme: "bootstrap",
                        placeholder: 'select Salutation'
                    }).val(data[0].salutation).trigger("change");
                 $('#country_cd').select2({
                        width: '100%',
                        // theme: "bootstrap",
                        placeholder: 'select Country'
                    }).val(data[0].country_code).trigger("change");
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
                 // $('#city').select2({
                 //        width: '100%',
                 //        // theme: "bootstrap",
                 //        placeholder: 'select City'
                 //    }).val(data[0].city).trigger("change");
                 setcity(data[0].city);
                $('#customer').val(data[0].name);                
                $('#HP').val(telp);
                $('#Email').val(data[0].email_addr);
                $('#address').val(data[0].address1);                
                $('#npwp').val(data[0].income_tax);
                $('#remarkspayment').val(data[0].payment_type_remarks);
                var nation = data[0].nationality;
                // alert(nation);
                $('#noktp').val(data[0].ic_no);
                // console.log(data[0].city);
                if (nation != 01){
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

