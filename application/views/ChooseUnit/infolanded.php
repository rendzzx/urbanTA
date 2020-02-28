
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<style type="text/css">
    td.infobox {
        padding: 10px;
        border: 0px solid #cecece;
        margin: 10px;
    }
</style>    

    
        <div class="row">
        <div class="col-md-12">
                 
                        <div  style="padding: 0px 20px 5px;">
                     
                            <table id="tblproses" class="table table-striped table-bordered DataTable" cellspacing="0" width="100%">                      
                            <thead>            
                                <!-- <th>No.</th> -->
                                <th>Unit</th>
                                <th>Type</th>
                                <th>Land Area</th>
                                <th>Build Up Area</th>
                                <th>Early Bird Price</th>
                                <th>Launching price</th>
                            </thead>
                           
                           
                            </table>
                    
                        </div>
                        <div  style="padding: 0px 20px 30px;">
                            
                            <table class="ibox-content" style=" box-sizing: border-box; width:100%; border-radius: 5px">
                                <tbody>
                                <tr>
                                   <td class="infobox"><strong>Payment Option</strong> <br><select name="txtpayment" id="txtpayment" data-placeholder="Choose payment..." class="form-control select2">
                                    <option value=""></option>
                                    <?php echo $Cbpayment;?>
                                    </select><br><br>
                                     <div style="font-size: 11px;font-weight: bold;"><i>Payment option can still be changed before sales order form is signed.<br>
                                    Pilihan pembayaran dapat diubah sebelum sales order form ditandatangani.</i></div></td>
                                    <br>
                                </tr>
                            </tbody></table>
                    
                        </div>
                  
                  </div>

                </div>


               

<div class="modal-footer">
<button id="btnOk" type="button" class="btn btn-success">Process</button>

    
<button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>

<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<script type="text/javascript">
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
$("#txtpayment").select2({
  width:'100%'
 });
var lotno = '<?php echo $lot_no?>';
var paymentcd = '<?php echo $payment?>';
$("#txtpayment").change(function() {
               

        tblproses.ajax.reload(null,true);

        });
// setpayment(paymentcd,lotno);

// function setpayment(paycd,lotno){    
//       console.log(paycd);
//         var site_url = '<?php echo base_url("c_nup_landedNew/zoom_payment")?>';
//             $.post(site_url,
//               {paycd:paycd,lotno:lotno},
//               function(data,status) {
//                 $("#txtpayment").empty();
//                 $("#txtpayment").append(data);
//                 $("#txtpayment").trigger('change');
//               }
//             );
//     }
var txt = [];
$('#btnCancel').click(function(e){
    

    $('#modal').modal('hide');
});
$('#btnOk').click(function(e){
    var lot_no = $('#modal').data('id');
    var xlot_no = $('#modal').data('xlot_no');
    var pay = $('#txtpayment').val();
    // alert(pay);
    Booking2(lot_no,xlot_no,pay);
});
tblproses = $('#tblproses').DataTable( 
{
    
    responsive: true,
    select: true,
    paging: false,
    searching:false,
    info:false,
//     
"processing": false,
"serverSide": true,
"ajax":{
    "url":"<?php echo base_url('c_nup_landedNew/getTableproses');?>",
    "data":{"sSearch": function(d){
        var search = $('#txt_search').val();
        var b="";
        if(search == null || search==""){
            return b;
        }{
            return search;
        }
    },"lot_no":function(d){
        var search = '<?php echo $lot_no?>';
        var b="";
        if(search == null || search==""){
            return b;
        }{
            return search;
        }
    },"paymentcd":function(d){
        var search = '<?php echo $payment?>';
        var ddr=$('#txtpayment').val();
        var b="";
        if(ddr==search) {
            if(search == null || search==""){
            return b;
            }{
                return search;
            }
       } else {
           
                return ddr;
            
        }
        
    }
},             
    "type":"POST"
},
"columns": [
// {data: "row_number",name:"row_number", searchable:false},
{data:"descs",name:"descs"},
{data:"lot_type_descs",name:"lot_type_descs"},
{data:"land_area",name:"land_area"},
{data:"build_up_area",name:"build_up_area"},
{data:"trx_amt",name:"trx_amt",
        render: function (data, type, row) {
                return formatNumber(data);  
              }},
{data:"trx_amt_1",name:"trx_amt_1",
        render: function (data, type, row) {
                return data;  
              }}
]
});
function Booking2(lot_no, xlot_no, pay){
          // var LotNumber = $('#txtlotno').val();
          // alert(lot_no);
          var parseRowid = $('#modal').data('RowID');
          // alert(parseRowid);
          // return;
          var parseLotQty = $('#modal').data('parseLotQty');
          var rowid_index = $('#modal').data('rowid_index');
          var status_index = $('#modal').data('status_index');
          var parseNupno = $('#modal').data('parseNupno');
          
          
          // alert(parseNupno);return;
          
          
          $.ajax({
                    url : "<?php echo base_url('c_nup_unit/validasiNew');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    // data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    data: {LotNumber:lot_no,
                          rowid:parseRowid,
                          lotqty:parseLotQty,
                          xlot_no:xlot_no,
                          // add:add,
                          Nupno:parseNupno,
                          pay:pay},
                    dataType:"json",
                    success:function(event, data){
                        
                        // BootstrapDialog.alert(event.Pesan);
                            if(event.status=='OK'){
                                swal({
                                      title: "Information",
                                      animation: false,
                                      text: event.Pesan,
                                      type: "success",
                                      confirmButtonText: "OK"
                                    },
                                    function(){
                                        var a = event.nup;                                        
                                        var b = event.notif;
                          if(b == 'OK'){
                                          window.location.href="<?=base_url('c_nup_dtNew/list_dtNew/')?>"+"/"+parseNupno+"/1/"+rowid_index+"/"+status_index;  
                                        }else{
                                          window.location.href="<?=base_url('c_nup_unit/index/')?>"+"/"+parseRowid+"/"+parseLotQty+"/"+a;  
                                        }
                                    });
                            } else {
                                swal({
                                          title: "Error",
                                          animation: false,
                                          type:"error",
                                          text: event.Pesan,
                                          confirmButtonText: "OK"
                                        });
                            }
                        
                        $('#modal').modal('hide');

                       
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                     
                                swal({
                                      title: "Information",
                                      animation: false,
                                      type:"error",
                                      text: textStatus+' Save : '+errorThrown,
                                      confirmButtonText: "OK"
                                    });
                     
                    }
                    });

}
</script>