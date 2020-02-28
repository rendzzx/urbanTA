
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('css/test/select2.min.css')?>">

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('css/test/select2.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<style type="text/css">
    td.infobox {
        padding: 10px;
        border: 0px solid #cecece;
        margin: 10px;
    },
    .div1 {
        width: 300px;
        height: 100px;
        border: 1px solid blue;
    }
    .text_right{
       text-align: right;
       padding-right: 50px !important;
    }
    th, td { white-space: nowrap; }
    td { 
          height: 25px;
       }
    .table > tbody > tr > td{
      padding-bottom: 0px !important;
    }

}
</style>
  <div class="col-sm-12" style="width:100%;height:100%;border:1px solid #939393;padding:20px; margin-bottom: 15px;">
    <legend style="text-align:left;">Payment Details</legend>
          <div class="col-sm-12">
            <div class="row">
              <label class="col-sm-3 control-label">Date</label>                
              <div class="col-sm-7">
                <input name="txtDate" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txtDate" readonly>
              </div>              
            </div>
            <div class="row">
              <label class="col-sm-3 control-label">Unit</label>                
              <div class="col-sm-7">
                <input name="txtUnit" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txtUnit" readonly>
              </div>              
            </div>
            <div class="row">
              <label class="col-sm-3 control-label">Payment Method</label>                
              <div class="col-sm-7">
                <!-- <input name="txtPayment" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txtPayment" readonly> -->
                 <select name="txtpayment" id="txtpayment" data-placeholder="Choose a Project..." class="select2 form-control" tabindex="2">
                    </select>
              </div>              
            </div>
            <div class="row">
              <label class="col-sm-3 control-label">Selling Price</label>                
              <div class="col-sm-7">
                <input name="txtSellingPrice" class="form-control required" align="left" style="border:none; background-color:white;" type="input" id="txtSellingPrice" readonly>
              </div>              
            </div>
        </div>
        
        <div class="row">
        <div class="col-md-12">
                 
                        <div  style="padding: 0px 20px 5px;">
                            <table id="tblproses" class="table table-striped table-bordered DataTable" cellspacing="0" width="100%">                      
                            <thead>        
                                <th>No.</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                            </thead>
                           
                           
                            </table>
                        </div>
          </div>
        </div>
         <div style="text-align:right;"><br> 
<button id="btnCancel" type="button" class="btn btn-success" >OK</button> 
</div>
</div>
     



<div class="col-sm-12" style="width:100%;height:100%;border:1px solid #939393;padding:20px;">
  <legend style="text-align:left;">Simulasi Perhitunganan KPR</legend>

            <div class="row">
              <label class="col-sm-4 control-label">Jumlah Kredit (Rp)</label>                
              <div class="col-sm-5">
                <input name="txtkredit" class="form-control required" style="text-align:right;" placeholder="0" type="input" id="txtkredit" >
              </div>              
            </div>
            <div class="row">
              <label class="col-sm-4 control-label">Bunga (%)</label>                
              <div class="col-sm-5">
                <input name="txtbunga" class="form-control required" style="text-align:right;" placeholder="0" type="input" id="txtbunga" >
              </div>              
            </div>
            <div class="row">
              <label class="col-sm-4 control-label">Waktu (pertahun)</label>                
              <div class="col-sm-5">
                <input name="txtwaktu" class="form-control required" style="text-align:right;"  placeholder="0" type="input" id="txtwaktu">
              </div>              
            </div>
            <div class="row">
            <label class="col-sm-4 control-label"></label>                
              <div class="col-sm-5">
                <button id="btnHitung" type="button" class="btn btn-primary pull-right" onclick="KPR();">Hitung</button>
              </div>                        
            </div>
            <div class="row">
              <label class="col-sm-4 control-label">Jumlah Angsuran (perbulan)</label>                
              <div class="col-sm-5">
                <input name="txthasil" class="form-control required" placeholder="0" style="text-align:right;" type="input" id="txthasil" readonly="true">
              </div>              
            </div>
</div>
 <div class="modal-footer">
 </div>

<script src="<?=base_url('js/jquery.mask.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
$("#txtkredit").mask('#,##0.00',{reverse:true,maxlength:false});
$("#txtbunga").mask('0,00.00',{reverse:true,maxlength:false});
var pcd=$('#modal').data('payment_cd');
$(document).ready(function(){
setpayment(pcd);
});
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
// $('#txtpayment').select2();
// $("#txtpayment").select2({
//   width: "50%"
// });

function setpayment(pcd){ 
var lotno = $('#modal').data('unit');   
      // console.log(pcd);
      // console.log(lotno);
      
        var site_url = '<?php echo base_url("c_booking_landed/zoom_payment2")?>';
            $.post(site_url,
              {paymentcd:pcd,lotno:lotno},
              function(data,status) {
                // console.log(data);
                $("#txtpayment").empty();
                $("#txtpayment").append(data).trigger("change");
                // $("#txtpayment").trigger('change');
              }
            );
    }

 $("#txtpayment").change(function() {

    var site_url    = "<?php echo site_url('C_rl_sales/set_field2/');?>";
    var lot_unit = $('#txtUnit').val();
    var payment_cd = $('#txtpayment').val();
    // alert(payment_cd);
    var response = "";

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
          // swal({
          //   title: "Warning",
          //   // text: data.Pesan,
          //   type: "warning",
          //   confirmButtonText: "OK"
          // },
          // function(){

          // });
            $('#txtSellingPrice').val('');
        }else{
          console.log(response);
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

          // $('#txt_list_bf_price').val(formatNumber(response[0].list_before_price));             
          // $('#txt_discount').val(formatNumber(response[0].disc));             
          $('#txtSellingPrice').val(formatNumber(net_price));                          
          // $('#txt_tax_cd').val(response[0].land_tax_cd);
          // $('#txt_listamt').val(formatNumber(response[0].list_tax_amt));
          // $('#txt_contractprice').val(formatNumber(response[0].contract_price));                   
        }
      },
        dataType: "json"//set to JSON    
      });
    tblproses.ajax.reload(null,true);
  });

function KPR(){
  
  var k = parseInt(replaceAll($('#txtkredit').val(),',',''));//i
  var b = parseInt($('#txtbunga').val());//p
  var w = parseInt($('#txtwaktu').val());//n

  if(k==''||k==0){
    swal('Warning','Isi Jumlah Kredit terlebih dahulu!','error');
    return;
  }
  if(b==''||b==0){
    swal('Warning','Isi Bunga terlebih dahulu!','error');
    return;
  }
  if(w==''||w==0){
    swal('Warning','Isi Jangka Waktu terlebih dahulu!','error');
    return;
  }
  var response ='';
  var site_url  = "<?php echo site_url('C_booking/hitungKPR/');?>";
  $.ajax({
            type:"POST",
            url: site_url,
            dataType: "json",
            data:{bunga:b,kredit:k,waktu:w},
                success: function(response){
                  $('#txthasil').val(formatNumber(Math.round(response[0].hasil)));

                },
                 error: function(jqXHR, textStatus, errorThrown){
                
                 }
              });
 

}
$('#txtUnit').val($('#modal').data('unit'));
$('#txtPayment').val($('#modal').data('descs'));
$('#txtSellingPrice').val($('#modal').data('selling_price'));
    $('#txtDate').val('<?php echo(date('D, d M Y')); ?>');

$('#btnCancel').click(function(e){
    var paycd=$('#txtpayment').find(':selected').val();  
    console.log(paycd); 
    $('#payment').select2({
                        width: '100%',
                        // theme: "bootstrap",
                        placeholder: 'select Payment'
                    }).val(paycd).trigger("change");
    // setpayment(paycd);
    $('#modal').modal('hide');
});
// $('#btnOk').click(function(e){
//     var lot_no = $('#modal').data('unit');
//     var xlot_no = $('#modal').data('xlot_no');
//     var pay = $('#txtpayment').val();
//     // alert(pay);
//     Booking2(lot_no,xlot_no,pay);
// });
tblproses = $('#tblproses').DataTable( 
{
    
    responsive: true,
    select: true,
    paging: false,
    searching:false,
    info:false,
    "columnDefs": [
        { className: "text_right", "targets": [3] }
                ],
        fixedColumns:   {
            heightMatch: 'none'
        }, 
"processing": false,
"serverSide": true,
"ajax":{
    "url":"<?php echo base_url('c_booking_landed/getTable');?>",
    "data":{"sSearch": function(d){
        var search = $('#txt_search').val();
        var b="";
        if(search == null || search==""){
            return b;
        }{
            return search;
        }
    },"lot_no":function(d){
        var search = $('#modal').data('unit');
        var b="";
        if(search == null || search==""){
            return b;
        }{
            return search;
        }
    },"paymentcd":function(d){
        var search = $('#txtpayment').val();
        // alert(search);
        var b=pcd;
            if(search == null || search==""){
            return b;
            }{
                return search;
            }

    }
},             
    "type":"POST"
},
"columns": [
{data: "row_number",name:"row_number", searchable:false},
{data:"trx_descs",name:"trx_descs"},
// {data:"freq",name:"freq"},
{data:"due_date",name:"due_date",
  render: function (data, type, row) {
    var dd= new Date(data);
            
                // return dd.toLocaleDateString(); 
                return FormatDateTime(dd); 
              }
},
{data:"trx_amt",name:"trx_amt",
        render: function (data, type, row) {
                return formatNumber(data);  
              }}
]
});

</script>