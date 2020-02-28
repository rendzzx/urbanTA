
<style type="text/css">
    td.infobox {
        padding: 10px;
        border: 0px solid #cecece;
        margin: 10px;
    }
</style>    
    
        <div class="row">
        <div class="col-md-12">
                 
                        <div class="col-md-6">
                            <div class="carousel slide" id="carousel2" >
                                
                                <ol class="carousel-indicators ">
                                    <li data-slide-to="0" data-target="#carousel2"  class="active"></li>
                                    <li data-slide-to="1" data-target="#carousel2"></li>
                                    <li data-slide-to="2" data-target="#carousel2" class=""></li>
                                </ol>
                                <div class="carousel-inner" style="cursor: pointer;" >
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
  
                  <div class="col-md-6">
                        <div id="tbl_infolot" style="font-size:14px;padding: 0px 20px 5px;">
                     
                            
                            <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
                            
                            <table >
                                <tbody><tr>
                                    <td width="100px">
                                       Property :<br><strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
                                    </td>
                                    <td width="100px">
                                        Lantai :<br><strong><span id="no_lantai"><?php echo $data[0]->level_descs;?></span></strong>
                                    </td>
                                    <td width="100px">
                                         No Unit :<br><strong><span id="no_unit"><?php echo $data[0]->lot_no;?></span></strong>
                                    </td>
                                    <td width="100px">
                                         Design Option :<br><strong><span id="no_unit"><?php echo $data[0]->theme;?></span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Luas Bangunan :<br><strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                                    </td>
                                    <td>
                                        View :<br><strong><span id="view"><?php echo $data[0]->zone_descs;?></span></strong>
                                    </td>
                                    <td>
                                         Hadap  :<br><strong><span id="direction"><?php echo $data[0]->direction_descs;?></span></strong>
                                    </td>
                                    <td id="price">
                                         Harga Early Bird :<br><strong><span id="no_unit"><?php echo $data[0]->price_HC;?></span></strong>
                                          <br>
                                         Harga Launching:<br><strong><span id="no_unit"><?php echo $data[0]->trx_amt_1;?></span></strong>
                                    </td>
                                </tr>
                            </tbody></table>
                    
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
                                   <td class="infobox"><strong>Payment Plan</strong> <br><select name="txtpayment" id="txtpayment" data-placeholder="Choose payment..." class="form-control select2">
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

function formatNumber(data) 
{
  return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

}
var add_ = '<?php echo $data[0]->theme_cd;?>';
$('#txtadd').val(add_);

var lotno = '<?php echo $data[0]->lot_no?>';
var paymentcd = '<?php echo $payment?>';
setpayment(paymentcd,lotno);
function setpayment(paycd,lotno){    
      console.log(paycd);
        var site_url = '<?php echo base_url("c_nup_landed/zoom_payment")?>';
            $.post(site_url,
              {paycd:paycd,lotno:lotno},
              function(data,status) {
                $("#txtpayment").empty();
                $("#txtpayment").append(data);
                $("#txtpayment").trigger('change');
              }
            );
    }

$("#txtpayment").change(function() {
document.getElementById('loader').hidden=false;
var lotno = '<?php echo $data[0]->lot_no?>';
var paymentcd = $(this).find(':selected').val();        
$('#tbl_infolot').load( "<?php echo base_url('c_nup_landed/goto_table');?>"+"/"+paymentcd+"/"+lotno+" #tbl_infolot" );
var add_ = '<?php echo $data[0]->theme_cd;?>';
$('#txtadd').val(add_);
document.getElementById('loader').hidden=true;
});
$(".select2").select2({
  width:'100%'
 });
var txt = [];
$('#btnCancel').click(function(e){
    // var get_click = $("#usa_image").mapster();
    var Id = $('#modal').data('Id');
    // document.getElementById(Id).checked =false;
    // $("#usa_image").mapster('set', false, Id);
    // console.log(Id);
    $("#usa_image").mapster('set', false, Id);

    $('#modal').modal('hide');
});
$('#btnOk').click(function (e){
    var get_click = $("#usa_image").mapster("get");    
    var arr_get_click = get_click.split(',');
    var lotno = $('#lot_no2').val();
    var lotnox = $('#lot_nox').val();
    var additional1 = $('#additional').val();
    var payment1 = $('#payment').val();
    var additional = $('#txtadd').val();
    var payment =$('#txtpayment').val();

    // alert(additional1);
    // alert(payment1);
    
    var cnt_arr = arr_get_click.length;
    var this_lotno ='<?php echo $data[0]->lot_no;?>';
    var Id = $('#modal').data('Id');
    var b =  $('#modal').data('balance');

    var d = b - 1 ;

    if(payment == ''){
        swal('warning','Please choose Payment Plan!','warning');
        return;
    } else {
        if (d >= 0)
        {
            $('#b_val').val(d);
        }
        else {
            swal('Information','You\'ve already used all your balance','warning');
        }
        
        // document.getElementById(Id).checked =true;
        if (lotno!='')
        {
            $('#lot_no2').val(lotno+','+this_lotno);
            $('#additional').val(additional1+','+additional);
            $('#payment').val(payment1+','+payment);
        } else {
            $('#lot_no2').val(this_lotno);
            $('#additional').val(additional);
            $('#payment').val(payment);
        }
        // $("#usa_image").mapster('set', true, Id);
        $("#usa_image").mapster('set',true,Id,{fillColor: 'FF0000'});
        // alert(Id);

        $('#modal').modal('hide');
    }   

    // landinfo(e);
});
// function landinfo(num){

// var CariLotNo = txt.indexOf(num);
//       if( CariLotNo >= 0){
//         return false;
//       }else{
//         txt.push(num); 
//         // btn.style.background = 'red'; 
//       }      
    

        // document.getElementById("lot_no").value=txt;
    // }

function selected(){
    var Id = 'LL0001';
    // alert(Id);
    selected = true;
    $('#'+Id).prop('checked', selected);
}

$('#modal').one('hidden.bs.modal', function (e){
    $('div.modal-body').html("");
    // $('#'+e.key).prop('checked', false);
    var Id = $('#modal').data('Id');
    // var selected = false;
    // alert(e.Id);
    // console.log(Id);
    // $('#'+Id).prop('checked', false);
    $('#modal').removeData('bs.modal');

});
// 
</script>