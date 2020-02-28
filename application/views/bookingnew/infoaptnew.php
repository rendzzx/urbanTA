<style type="text/css">
    td.infobox {
        padding: 5px;
        border: 1px solid #cecece;
        margin: 10px;
    }
/*    .footer2{
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
                                    <?php foreach ($galery as $key) { ?>
                                    <img src="<?php echo $key->gallery_url; ?>">
                                     <?php  } ?>
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
                            </div>
                    </div>
                    </div>
        <div class="col-md-6" style="padding-left: 0px;padding-right: 0px;">
            <!-- <div id="tbl_infoapt" style="font-size:14px;padding: 0px 5px 5px;"> -->
            <div class="col-lg-11">
            <div id="tbl_infoapt" class="ibox float-e-margins">
                <h3 id="nama_tipe"><?php echo $projectName;?></h3>
                        <div class="ibox-content">
                        <table class="table table-striped">
                           <tbody><tr>
                                      <td><span id="no_tower"><?php echo $data[0]->property_descs." | " .$data[0]->level_descs." | <b>".$data[0]->lot_no;?></span></td>
                                  </tr>
                                  <tr>
                                       <td><span id="no_tower"><?php echo $data[0]->build_up_area ." ".$data[0]->area_uom;?></span></td>
                                  </tr>
                                  <tr>
                                       <td><span id="no_tower"><?php echo $data[0]->lot_type_descs;?></span></td>
                                  </tr>
                                  <tr>
                                       <td><span id="no_tower"><?php echo $data[0]->direction_descs;?></span></td>
                                  </tr>
                                </tbody>
                            </table>
                      </div>
                <!-- </div> -->
            </div>

            <div id="tbl_infoapt" class="ibox float-e-margins">
                        <div class="ibox-content">
                        <table class="table table-striped">
                           <tbody>
                           <tr>
                               <td><span id="descs"></span></td>
                               <td>IDR. <span id="trx" style="color: green;"></span></td>
                           </tr>
                           <?php foreach ($data1 as $key) { ?>
                                <tr>
                                      <td><span><?php echo $key->descs ?></span></td>
                                      <td>IDR. <span style="color: green;"><?php echo $key->trx_amt?></span></td>
                                  </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                        </div>
            </div>
            </div>
           <div  style="font-size:14px;padding: 0px 20px 30px;" hidden="hidden">
                            <div class="row">
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
                                   <td class="infobox"><strong>Payment Option</strong> <br><select name="txtpayment" id="txtpayment" data-placeholder="Choose payment..." class="form-control select2">
                                    <option value=""></option>
                                    </select><br><br>
                                    <div style="font-size: 11px;font-weight: bold;"><i>Payment option can still be changed before sales order form is signed.<br>
                                    Pilihan pembayaran dapat diubah sebelum sales order form ditandatangani.</i></div></td>
                                    <br>

                                </tr>
                                <!-- <tr>
                                    <td class="hoon"></td>
                                </tr> -->
                            </tbody></table>
                    
                        </div>
        </div>
    </div>
</div> 
</div><br>
<div class="row">
    <div class="modal-footer" style="text-align: center;margin-left: 10px;margin-right: 10px;">

    <font color="#1a7bb9" style="font-size: 16px"><b>Are you sure you want to choose this unit ? &emsp;</b></font>
        <button id="btnOk" type="button" class="btn btn-success">Ok</button>
        <button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>
</div>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<script type="text/javascript">
render = new Array();

        render["ORANGE"] = {
            fillColor: 'FF8000',
            strokeColor: 'FF8000',
        };

        render["GREEN"] = {
            fillColor: '00FF00',
            strokeColor: '00FF00',
        };

        render["RED"] = {
            fillColor: 'FF0000',
            strokeColor: 'FF0000',
        };

// var thislotno = '<?php echo $data[0]->lot_no?>';

        $('#btnCancel').click(function(e){
           var Id = $('#modal').data('Id');
            // document.getElementById(Id).checked =false;
            // $("#usa_image").mapster('set', false, Id);
            // console.log(Id);


            $('#modal').modal('hide');
        });

$(document).ready(function () {
    var descs = $('#modal').data('descs');
    var trx = $('#modal').data('trx');
    // console.log(descs)
    $("#descs").html(descs);
    $("#trx").html(trx);
    // var myBookId = '<?php echo $data[0]->lot_no;?>';
    // console.log(myBookId)
});

$('#btnOk').click(function (e){
    var myBookId = '<?php echo $data[0]->lot_no;?>';
    // console.log(myBookId);
    
    if (myBookId == "") {
        swal('Warning', 'Please Click Unit!',"warning");
        return;
    }
            var descs = $('#modal').data('descs');
            var trx = $('#modal').data('trx');
            var data = [];
            data.push({name: "descs", value: descs},{name: "trx", value: trx},{name: "unit", value: myBookId});
            localStorage.setItem('data',myBookId);
            var site_url = "<?php echo base_url('booking/AddpayAndCust')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: data,
                dataType: "JSON",
                success: function(Data) {
                    // console.log(Data);
                    window.location.href = site_url 

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // console.log(Data);
                    // swal(textStatus + ' Save : ' + errorThrown);
                    // alert("test");
                    window.location.href = site_url; 
                }
            })

   
       
    
    
});

        $('#modal').one('hidden.bs.modal', function (e){
            var Id = $('#modal').data('Id');
            // console.log(Id);
            $('#'+Id).prop('checked', false);
            $('#modal').removeData('bs.modal');
        });
</script>