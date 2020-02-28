<style type="text/css">
    td.infobox {
        padding: 10px;
        border: 1px solid #cecece;
        margin: 10px;
    }
</style>  

<div class="row">
    <div class="col-md-12">
    <div>
        <div class="col-md-6">
            <div class="ibox-content ">
                <div class="carousel slide" id="carousel2">
                <!-- APARTMENT -->
                    <ol class="carousel-indicators">
                        <li data-slide-to="0" data-target="#carousel2"  class="active"></li>
                        <li data-slide-to="1" data-target="#carousel2"></li>
                        <li data-slide-to="2" data-target="#carousel2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                        <?php echo $img;?>
                    </div>
                    <a data-slide="prev" href="#carousel2" class="left carousel-control">
                        <span class="icon-prev"></span>
                    </a>
                    <a data-slide="next" href="#carousel2" class="right carousel-control">
                        <span class="icon-next"></span>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-6">
            <div id="tbl_infoapt" style="font-size:14px;padding: 0px 20px 5px;">
                <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
                        <table style="border:1px solid #cecece;padding: 6px;">
                            <tr >
                                    <td width="100px" class="infobox">
                                       Property :<br><strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
                                    </td>
                                    <td width="100px" class="infobox">
                                        Lantai :<br><strong><span id="no_lantai"><?php echo $data[0]->level_descs;?></span></strong>
                                    </td>
                                    <td width="100px" class="infobox">
                                         No Unit :<br><strong><span id="no_unit"><?php echo $data[0]->lot_no;?></span></strong>
                                    </td>
                                    <td width="100px" class="infobox">
                                         WING :<br><strong><span id="no_unit"><?php echo $data[0]->block_descs;?></span></strong>
                                    </td>
                                </tr>
                                <tr >
                                    <td class="infobox">
                                        Semi Gross Area (m2) :<br><strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                                    </td>
                                    <td class="infobox">
                                        View :<br><strong><span id="view"><?php echo $data[0]->zone_descs;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                         Hadap  :<br><strong><span id="direction"><?php echo $data[0]->direction_descs;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                         Harga Early Bird :<br><strong><span id="no_unit"><?php echo $data[0]->price_HC;?></span></strong><br>
                                         Harga Launching:<br><strong><span id="no_unit"><?php echo $data[0]->trx_amt_1;?></span></strong>
                                    </td>
                                </tr>
                            </table>
                    <!-- </div> -->
                <!-- </div> -->
            </div>
            <div  style="font-size:14px;padding: 0px 20px 30px;">
                            
                            <table class="ibox-content" style=" box-sizing: border-box; width:100%; border-radius: 5px">
                                <tbody><!-- <tr>
                                    <td class="infobox"><strong>Additional</strong> <br><select name="txtadd" id="txtadd" data-placeholder="Choose additional type..." class="form-control select2">
                                    <option value=""></option>
                                    <option value="PP01">Pool</option>
                                    <option value="PP02">Wardrobe</option>
                                    <option value="PP03">Terrace</option>
                                    </select></td>
                                </tr> -->
                                <input type="hidden" name="txtadd" id="txtadd">
                                <tr>
                                   <td style="margin: 10px;padding:10px"><strong>Payment Plan</strong> <br><select name="txtpayment" id="txtpayment" data-placeholder="Choose payment..." class="form-control select2">
                                    <option value=""></option>
                                    <?php echo $cbpayment; ?>
                                    </select></td>
                                    <br>
                                    <i>Payment option can still be changed before sales order form is signed.<br>
                                    Pilihan pembayaran masih dapat diubah sebelum sales order form ditandatangani.</i>
                                </tr>
                                <!-- <tr>
                                    <td class="hoon"></td>
                                </tr> -->
                            </tbody></table>
                    
                        </div>
        </div>
    </div>
</div>
    <div class="modal-footer">
        <button id="btnOk" type="button" class="btn btn-success">Ok</button>
        <button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<script type="text/javascript">

var add_ = '<?php echo $data[0]->theme_cd;?>';
$('#txtadd').val(add_);
var thislotno = '<?php echo $data[0]->lot_no?>';
var paymentcd = '<?php echo $payment?>';
setpayment(paymentcd,thislotno);
function setpayment(paycd,lottno){    
      console.log(paycd);
        var site_url = '<?php echo base_url("c_nup_landed/zoom_payment")?>';
            $.post(site_url,
              {paycd:paycd,lotno:lottno},
              function(data,status) {
                $("#txtpayment").empty();
                $("#txtpayment").append(data);
                $("#txtpayment").trigger('change');
              }
            );
    }

$("#txtpayment").change(function() {
document.getElementById('loader').hidden=false;
var thislotno = '<?php echo $data[0]->lot_no?>';
var paymentcd = $(this).find(':selected').val();        
$('#tbl_infoapt').load( "<?php echo base_url('c_nup_unit/goto_info');?>"+"/"+paymentcd+"/"+thislotno+" #tbl_infoapt" );
var add_ = '<?php echo $data[0]->block_no;?>';
$('#txtadd').val(add_);
document.getElementById('loader').hidden=true;
});
$("#txtpayment").select2({
  width:'100%'
 });

        $('#btnCancel').click(function(e){
            var Id = $('#modal').data('Id');
            // alert(Id);
            
            // document.getElementById(Id).checked =false;
            // $('#'+Id).removeClass("btn-danger").addClass("btn-primary");
            $('#modal').modal('hide');
        });

        $('#btnOk').click(function (e){


            var Id = $('#modal').data('Id');
            var b =  $('#modal').data('balance');
            // alert(Id);
            
            
            // document.getElementById("txtlotno").value=txt; 
            $('#'+Id).removeClass("btn-primary").addClass("btn-danger");

            //green
            var lotno = Id;
            var lot_no = $('#txtlotno').val();
            var lot_no2 = $('#txtlotno2').val();
            var arr_lot = lot_no.split(",");
            var arr_lot2 = lot_no2.split(",");
            var new_lot = ""; 
            var new_lot2 = "";

            var additional1 = $('#additional').val();
            var payment1 = $('#payment').val();
            
            
            var this_additional = $('#txtadd').val();
            var this_payment =$('#txtpayment').val();
            if(this_payment == ''){
                swal('warning','Please choose Payment Plan!','warning');
                return;
            } else {
            // txtlotno
            for (i = 0; i < arr_lot2.length; i++) {
              if (arr_lot2[i] != lotno && new_lot2 == ""){
                new_lot2 = arr_lot2[i];
                console.log('a');
              } else if (arr_lot2[i] == lotno && new_lot2 == ""){
                new_lot2 = new_lot2;
                console.log('b');
              } else if (arr_lot2[i] != lotno && new_lot2 != ""){
                if (lot_no2.length >0){
                  new_lot2 = new_lot2 + ',' + arr_lot2[i];
                  console.log('c');
                } else{
                  new_lot2 = new_lot2 + arr_lot2[i];
                  console.log('d');
                } 
              }
            }
            // console.log(new_lot2);
            // alert(new_lot2);

            // txtlotno2
            for (i = 0; i < arr_lot.length; i++) {
              if (arr_lot[i] != lotno && new_lot == "" && lot_no == ""){
                new_lot = lotno;
              } else if (arr_lot[i] != lotno && new_lot == "" && lot_no != ""){
                if (lot_no.length>0){
                  new_lot = arr_lot[i] + ',' + lotno;
                } else {
                  new_lot = arr_lot[i] + lotno;
                }
                
              } else if (arr_lot[i] != lotno && new_lot != ""){
                if (lot_no.length>0){
                  new_lot = new_lot + ',' + lotno;
                } else {
                  new_lot = new_lot + lotno;
                }
                
                
              } else {
                new_lot = lot_no;
              }
            }
            // alert(new_lot);

            // $('#txtlotno').val(new_lot);
            $('#txtlotno2').val(new_lot2);

            if (lot_no!='')
            {
                $('#additional').val(additional1+','+this_additional);
                $('#payment').val(payment1+','+this_payment);
            } else {
                $('#additional').val(this_additional);
                $('#payment').val(this_payment);
            }
            txt.push(Id);
            $('#txtlotno').val(txt);
            $('#modal').modal('hide'); 
        }
        });

        $('#modal').one('hidden.bs.modal', function (e){
            var Id = $('#modal').data('Id');
            // console.log(Id);
            $('#'+Id).prop('checked', false);
            $('#modal').removeData('bs.modal');
        });
</script>