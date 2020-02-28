<style type="text/css">
    td {
        padding: 6px;
    }
</style>
<div id="loader" class="loader" hidden="true"></div>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <div class="carousel slide" id="carousel2" >
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
        <div class="col-md-8">
            <div class="ibox-content" style="font-size:14px;">                    
                <h3 id="nama_tipe"><?php echo $data[0]->descs;?></h3>                            
                <table  border= "1px" >
                    <tbody>
                        <tr>
                            <td>
                                Cluster :<br><strong><span id="cluster"><?php echo $data[0]->cluster_descs;?></span></strong>
                            </td>
                            <td>
                                Block :<br><strong><span id="block_no"><?php echo $data[0]->block_no;?></span></strong>
                            </td>
                            <td>
                                Facing :<br><strong><span id="hadap"><?php echo $data[0]->direction_descs;?></span></strong>
                            </td>
                            <td>
                                Unit Type :<br><strong><span id="no_unit"><?php echo $data[0]->lot_type_descs;?></span></strong>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Land Area :<br><strong><span id="luas_tanah"><?php echo $data[0]->land_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                            </td>
                            <td>
                                Building Area  :<br><strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                            </td>
                            <td>
                                No. of Bedroom :<br><strong><span id="room_qty"><?php echo $data[0]->room_qty;?></span></strong>
                            </td>
                            <td>
                                Range Price :<br>
                                <strong>
                                    <span id="harga">
                                        <?php
                                            echo number_format($data[0]->start_range,2) .' s/d '. number_format($data[0]->end_range,2) ;
                                        ?>
                                    </span>
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>               

<div class="modal-footer">
    <button id="btnProses" type="button" class="btn btn-success"><strong>Process</strong></button>   
    <button id="btnOk" type="button" class="btn btn-primary">Choose Another Unit</button>    
    <button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>

<script type="text/javascript">
load_data()
var txt = [];
$('#btnCancel').click(function(e){
    // var get_click = $("#usa_image").mapster();
    var Id = $('#modal').data('Id');
    // document.getElementById(Id).checked =false;
    // $("#usa_image").mapster('set', false, Id);
    // askColour(function(_colour){
        var type = $('#modal').data('nup_counter');
        var a = dataWarna[type]["fillColor"];
        $("#usa_image").mapster('set',true,Id,{fillColor: a});
        
    // });
    // $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'});

    $('#modal').modal('hide');
});

 $('#btnProses').click(function() {
    document.getElementById('loader').hidden=false;
            var chosen_unit = $('#modal').data('chosen');
            var unitnow = $('#modal').data('Id');
            var statusEdit = $('#modal').data('statusEdit');
            var headerid = $('#modal').data('headerid');
            var Type = $('#modal').data('Type');

            // alert(Type);
            // return;

            // alert('chosen_unit : '+chosen_unit);
            // alert('unitnow : '+unitnow);
            
            var myBookId = '';
            if (chosen_unit=='')
            {
                myBookId = unitnow;
            } else {
                myBookId = chosen_unit+','+unitnow;
            }

            // alert('myBookId : '+myBookId);
            // return;

            // alert(myBookId);
            // alert('tes');
            // var myBookId = $('#lot_no2').val();
            
            if (myBookId == "") {

                swal('Warning', 'Please Choose Unit!',"warning");
                return;
                document.getElementById('loader').hidden=true;
            }
            var site_url = "<?php echo base_url('c_nup_landed_cfld_dt/set_session')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: {
                    unit_loop: myBookId
                },
                dataType: "json",
                success: function(data, status) {                    

                    if(statusEdit == 'R' || statusEdit == 'E' || statusEdit == 'P' ){
                        window.location.href = "<?php echo base_url('c_nup_cfld/edit_rev/N/')?>"+headerid;    
                    } else {
                        window.location.href = "<?php echo base_url('c_nup_cfld/insert/N')?>"+'/'+Type; //+'/'+property_cd+'/'+myBookId;    
                    }
                    
                    document.getElementById('loader').hidden=true;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                    document.getElementById('loader').hidden=true;
                }
            })
        });

$('#btnOk').click(function (e){
    var get_click = $("#usa_image").mapster("get");    
    var arr_get_click = get_click.split(',');
    var lotno = $('#lot_no2').val();
    var lotnox = $('#lot_nox').val();
    var lot_descs1 = $('#lot_descs').val();
    var lot_descs = '<?php echo $data[0]->descs ?>';

    // alert(lot_descs);
    // return;

    // alert('lotno : '+lotno);
    // alert('lotnox : '+lotnox);

    var cnt_arr = arr_get_click.length;
    var this_lotno ='<?php echo $data[0]->lot_no;?>';
    var Id = $('#modal').data('Id');

    // alert('this_lotno : '+this_lotno);

    if (lotno!='')
    {
        $('#lot_no2').val(lotno+','+this_lotno);
        $('#lot_descs').val(lot_descs1+', '+lot_descs)
        // $('#additional').val(additional1+','+additional);
    } else {
        $('#lot_no2').val(this_lotno);
        $('#lot_descs').val(lot_descs);
    }

    var unit_temp = $('#lot_no2').val();
    var descs_temp = $('#lot_descs').val();
    // alert(unit_temp +' - '+descs_temp);

    var site_url = "<?php echo base_url('c_nup_landed_cfld_dt/set_session')?>";
    $.ajax({
        url: site_url,
        type: "POST",
        data: {
            unit_loop : unit_temp,
            descs_loop : descs_temp
        },
        dataType: "json",
        success: function(data, status) {
            // alert('unit_temp : '+unit_temp);
            // alert('lotno2 : '+lotno);

            var type = $('#modal').data('nup_counter');
            var a = dataWarna[type]["strokeColor"];            
             
            $("#usa_image").mapster('set',true,Id,{fillColor: a});  

            $('#modal').modal('hide');                
        },
        error: function(jqXHR, textStatus, errorThrown) {
            swal(textStatus + ' Save : ' + errorThrown);
            // document.getElementById('loader').hidden=true;
        }
    })
});



$('#modal').one('hidden.bs.modal', function (e){
    $('div.modal-body').html("");
    // $('#'+e.key).prop('checked', false);
    var Id = $('#modal').data('Id');
    var type = $('#modal').data('nup_counter');
        var a = dataWarna[type]["fillColor"];
        $("#usa_image").mapster('set',true,Id,{fillColor: a});
    $('#modal').removeData('bs.modal');

});
function load_data(){
    document.getElementById('loader').hidden=true;
    // alert('tasss');
}
// 
</script>