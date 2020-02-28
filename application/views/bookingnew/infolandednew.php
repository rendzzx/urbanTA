<style type="text/css">
    td.infobox {
        padding: 5px;
        border: 1px solid #cecece;
        margin: 10px;
    }
       /* .footer2{
        background: none repeat scroll 0 0 white;
        border-top: 1px solid #e7eaec;
        bottom: 0;
        left: 0;
        padding: 10px 20px;
        position:absolute;
        right: 0;
        text-align: center;
    }*/
</style>  

<div class="row">
    <div class="col-md-12">
    <div>
        <div class="col-md-6">
            <div class="ibox-content ">
                <div class="carousel slide" id="carousel2">
                                
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
                            <div style="font-size: 14px; font-weight: bold">
                            <!-- &emsp;&emsp;Already selected <?php echo $nup_counter ?> time(s). -->
                            </div>
                    </div>
                    </div>
                    <div class="col-md-6">
                        <div id="tbl_infolot" style="font-size:14px;">
                     
                            
                            <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
                            
                            <table style="border:1px solid #cecece;padding: 6px; width:100%;">
                                <tbody><tr>
                                    <td class="infobox">
                                       Property :<br><strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                        Blok :<br><strong><span id="no_lantai"><?php echo $data[0]->level_descs;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                         Unit No. :<br><strong><span id="no_unit"><?php echo $data[0]->lot_no;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                         Design Option :<br><strong><span id="no_unit"><?php echo $data[0]->theme;?></span></strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Build Area :<br><strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                                    </td>
                                    <td>
                                        View :<br><strong><span id="view"><?php echo $data[0]->zone_descs;?></span></strong>
                                    </td>
                                    <td>
                                         Direction  :<br><strong><span id="direction"><?php echo $data[0]->direction_descs;?></span></strong>
                                    </td>
                                    <!-- <td>
                                         Harga Early Bird :<br><strong><span id="no_unit"><?php echo $data[0]->price_HC;?></span></strong>
                                         <br>
                                         Harga Launching:<br><strong><span id="no_unit"><?php echo $data[0]->trx_amt_1;?></span></strong>
                                    </td> -->
                                    <td>
                                        Hard Cash :<br><strong><span id="no_unit"><?php echo $data[0]->price_HC;?></span></strong> 
                                    </td>
                                </tr>
                            </tbody></table>
                    
                        </div>
                        <div  style="font-size:14px;padding: 0px 20px 30px;" hidden="hidden">
                            <div class="row">
                                <table class="ibox-content" style=" box-sizing: border-box; width:100%; border-radius: 5px">
                                <tbody>
                                <input type="hidden" name="txtadd" id="txtadd">
                                <tr>
                                   <td class="infobox"><strong>Payment Option</strong> <br><select name="txtpayment" id="txtpayment" data-placeholder="Choose payment..." class="form-control select2">
                                    <option value=""></option>
                                    
                                    </select><br>
                                    <div style="font-size: 11px;font-weight: bold;"><i>Payment option can still be changed before sales order form is signed.<br>
                                    Pilihan pembayaran dapat diubah sebelum sales order form ditandatangani.</i></div></td>
                                    <br>

                                </tr>
                            </tbody></table>
                    
                        </div>
        </div>
    </div>
</div>
</div>
<div class="row">
    <div class="modal-footer" style="text-align: center;margin-left: 10px;margin-right: 10px;" >

    <font color="#1a7bb9" style="font-size: 16px"><b>Are you sure you want to choose this unit ? &emsp;</b></font>
        <button id="btnOk" type="button" class="btn btn-success">Ok</button>
        <button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
</div>

<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<script type="text/javascript">

function formatNumber(data) 
{
  return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

}
var txt = [];
$('#btnCancel').click(function(e){
    // var get_click = $("#usa_image").mapster();
    var Id = $('#modal').data('Id');
  
    $("#usa_image").mapster('set', false, Id);

    $('#modal').modal('hide');
});
$('#btnOk').click(function (e){
     var myBookId = '<?php echo $data[0]->lot_no;?>';
    var property_cd = '<?php echo $property_cd;?>';
    if (myBookId == "") {
        swal('Warning', 'Please Click Unit!',"warning");
        return;
    }
            var site_url = "<?php echo base_url('c_booking/set_session')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: {
                    property_cd: property_cd,
                    unit_book: myBookId
                },
                dataType: "json",
                success: function(data, status) {
                    busID=0;
                    window.location.href = "<?php echo base_url('c_booking_landed/AddpayAndCust')?>/"+myBookId+"/"+property_cd; 

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                }
            })

   
        // $('#modal').modal('hide');
    
    

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