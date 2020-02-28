           
<style type="text/css">
    td.infobox {
        padding: 10px;
        border: 0px solid #cecece;
        margin: 10px;
    }
</style>    
    
        <div class="row">
        <div class="col-md-12">
                 
                        <div class="col-md-7" style="padding-bottom: 20px">
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
                            
                            <table style="width:100%">
                                <tbody><tr>
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
                            </tbody></table>
                    
                        </div>
                        <div  style="font-size:14px;padding: 0px 13px 30px;">
                            
                            <table class="ibox-content" style=" box-sizing: border-box; width:100%; border-radius: 5px">
                                <tbody><tr>
                                    <td class="infobox"><strong>Additional</strong> <br><select name="add_cd" id="add_cd" data-placeholder="Choose additional type..." class="form-control select2">
                                    <option value=""></option>
                                    <option value="tes1">Kolam Renang</option>
                                    </select></td>
                                </tr>
                                <tr>
                                   <td class="infobox"><strong>Payment Plan</strong> <br><select name="payment" id="payment" data-placeholder="Choose payment..." class="form-control select2">
                                    <option value=""></option>
                                    <option value="tes2">Kolam Renang</option>
                                    </select></td>
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


               

<div class="modal-footer">
<button id="btnOk" type="button" class="btn btn-success">Ok</button>

    
<button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>

<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<script type="text/javascript">
$(".select2").select2({
  width:'100%'
 });
var txt = [];
$('#btnCancel').click(function(e){
    // var get_click = $("#usa_image").mapster();
    var Id = $('#modal').data('Id');
    // document.getElementById(Id).checked =false;
    // $("#usa_image").mapster('set', false, Id);
    $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'});

    $('#modal').modal('hide');
});
$('#btnOk').click(function (e){
    var add_cd = $('#add_cd').val();
    var payment = $('#payment').val();
    var get_click = $("#usa_image").mapster("get");    
    var arr_get_click = get_click.split(',');
    var lotno = $('#lot_no2').val();
    var lotnox = $('#lot_nox').val();
    // alert(lotnox);
    var combo = $('#infolot').val();
    var cnt_arr = arr_get_click.length;
    var this_lotno ='<?php echo $data[0]->lot_no;?>';
    var Id = $('#modal').data('Id');
    var b =  $('#modal').data('balance');

    if(add_cd==''||payment==''){
        swal("Warning","Please Choose Additional and Payment Plan","error");
        return;
    } else {
        var d = b - 1 ;
        // alert(b);
        // alert(Id);
        // return;   
        // $('#lot_no').val(Id);
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

        } else {
            $('#lot_no2').val(this_lotno);
        }
        if (combo!='')
        {
            $('#infolot').val(combo+'&'+this_lotno+','+add_cd+','+payment);
        } else {
            $('#infolot').val(this_lotno+','+add_cd+','+payment);
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