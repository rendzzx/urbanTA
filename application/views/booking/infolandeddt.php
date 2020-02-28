
<style type="text/css">
    td.infobox {
        padding: 10px;
        border: 0px solid #cecece;
        margin: 10px;
    }
</style>    
    
<div class="row">
    <div class="col-md-12">                 
        <div class="col-md-7">
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
        <div class="col-md-5">
            <div  style="font-size:14px;padding: 0px 20px 5px;">
                <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>                            
                <table style="width:250px">
                    <tbody>
                        <tr>
                            <td>
                                Property :<br><strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
                            </td>
                            <td>
                                Lantai :<br><strong><span id="no_lantai"><?php echo $data[0]->level_descs;?></span></strong>
                            </td>
                            <td>
                                No Unit :<br><strong><span id="no_unit"><?php echo $data[0]->lot_no;?></span></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Luas :<br><strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                            </td>
                            <td>
                                View :<br><strong><span id="view"><?php echo $data[0]->zone_descs;?></span></strong>
                            </td>
                            <td>
                                Hadap  :<br><strong><span id="direction"><?php echo $data[0]->direction_descs;?></span></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>                    
            </div>
            <input type="hidden" name="rowid" value="<?php echo $rowid;?>" id="rowid" required="true">
            <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_info" method ="POST" >
                <div  style="font-size:14px;padding: 0px 20px 30px;">                            
                    <table class="ibox-content" style=" box-sizing: border-box; width:100%; border-radius: 5px">
                        <tbody>
                            <tr>
                                <td class="infobox">
                                    <strong>Additional</strong><br>
                                    <select name="txtadd" id="txtadd" data-placeholder="Choose additional type..." class="form-control select2">
                                        <option value=""></option>
                                        <option value="PP01">Pool</option>
                                        <option value="PP02">Wardrobe</option>
                                        <option value="PP03">Terrace</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="infobox"><strong>Payment Plan</strong><br>
                                    <select name="txtpayment" id="txtpayment" data-placeholder="Choose payment..." class="form-control select2">
                                        <option value=""></option>
                                        <?php echo $cbpayment; ?>
                                    </select>
                                </td>
                                <br>
                            </tr>                               
                        </tbody>
                    </table>                    
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button id="submit" type="button" class="btn btn-success">Ok</button>    
    <button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>

<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<script type="text/javascript">
$(".select2").select2({
  width:'100%'
 });
// var txt = [];
$('#btnCancel').click(function(e){
    // var get_click = $("#usa_image").mapster();
    var Id = $('#modal').data('Id');
    // document.getElementById(Id).checked =false;
    // $("#usa_image").mapster('set', false, Id);
    // $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'});

    $('#modal').modal('hide');
});

$('#submit').click(function(){
    var additional = $('#txtadd').val();
    var payment =$('#txtpayment').val();
    if(additional == '' || payment == ''){
        swal('warning','Additional and Payment Plan cannot be blank!','warning');
        return;
    } else {
        var add = $('#txtadd').val();
        var pay = $('#txtpayment').val();
        var rowid = $('#rowid').val();
        var dataform = $('#form_info').serializeArray();
        dataform.push(
                {name:"additional_cd",value:add},
                {name:"payment_cd",value:pay},
                {name:"rowid",value:rowid}
            );
        var site_url = "<?php echo base_url('c_nup_dt/updateAddPay')?>";

        $.ajax({
            url:site_url,
            type:"POST",
            data: dataform,
            dataType: "json",
            success: function(data, status){
            if(data.status !='Failed'){
                  swal({
                    title: "Information",
                    text: data.pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){
                    window.location.href="<?php echo base_url('c_nup_dt/list_dtNew/')?><?php echo $nup_no?>/<?php echo $balance ?>/<?php echo $rowid_index?>/<?php echo $status?>";                    
                  });
                } else {
                  swal({
                    title: "Error",
                    text: data.pesan,
                    type: "error",
                    confirmButtonText: "OK"
                  });
                }
          },
          error: function(jqXHR, textStatus, errorThrown){
            swal(textStatus+' Save : '+errorThrown);
          }
        })
    }
});

$(document).ready(function(){
    rowid = '<?php echo $rowid ?>';

    var site_url = '<?php echo base_url("c_nup_dt/show_edit_data")?>'+'/'+rowid;
    
    $.getJSON(site_url, function (data) {
        console.log(data);
        $('#txtadd').val(data[0].additional_cd).trigger('change');
        $('#txtpayment').val(data[0].payment_cd).trigger('change');
    });

});

</script>