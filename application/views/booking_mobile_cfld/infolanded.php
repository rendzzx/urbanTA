<style type="text/css">
    td {
        padding: 6px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div >
        <div class="col-md-4">
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
        </div>
        <div class="col-md-8">
            <div class="ibox-content" style="font-size:14px;">
                <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
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
                                Range Price :<br><strong><span id="harga">
                                <?php

                                echo number_format($data[0]->start_range,2) .' s/d '. number_format($data[0]->end_range,2) ;
                                ?>

                            </span></strong>
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

load_data();
var txt = [];
$('#btnCancel').click(function(e){
    // var get_click = $("#usa_image").mapster();
    var Id = $('#modal').data('Id');
    // document.getElementById(Id).checked =false;
    // $("#usa_image").mapster('set', false, Id);
    // $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'} );
    $('#modal').modal('hide');
});
$('#btnOk').click(function (e){
    document.getElementById('loader').hidden=false;
    // var get_click = $("#usa_image").mapster("get");
    // var arr_get_click = get_click.split(',');
    var lotno = $('#lot_no2').val();
    var lotnox = $('#lot_nox').val();
    // var cnt_arr = arr_get_click.length;
    var this_lotno ='<?php echo $data[0]->lot_no;?>';
    var Id = $('#modal').data('Id');
    var Counter = $('#modal').data('nup_counter');
    var NupCnt = parseInt(Counter);
    var cntClr ="A"+NupCnt;
    var Cluster_cd =  $('#modal').data('Cluster_cd');

    var lot_descs1 = $('#lot_descs').val();
    var lot_descs = '<?php echo $data[0]->descs ?>';
   
    // alert(property_cd);
    // return;
    var site_url = '<?php echo base_url("c_mobile_cfld/update_status")?>';
    $.post(site_url,
        {id:Id,status:"R", lot_descs:lot_descs},
        function(data,status) {
            
            tstatus = 'R';
            if (lotno!='')
            {
                $('#lot_no2').val(lotno+','+this_lotno);
                $('#lot_descs').val(lot_descs1+', '+lot_descs)
            } else {
                $('#lot_no2').val(this_lotno);
                $('#lot_descs').val(lot_descs);
            }
        
        buttn.style.background = dataWarna[cntClr]["strokeColor"];
                
                $('#modal').modal('hide');
                // document.getElementById('loader').hidden=true;
         }
    );
   
//   console.log(buttn);
//   console.log(dataWarna[nupCounter]["fillColor"]);
    // $('#modal').modal('hide');
    

    // landinfo(e);
});

$('#btnProses').click(function(){
    // document.getElementById('loader').hidden=false;
    // var lot_descs = $('#modal').data('lot_descs');
    // alert(lot_descs);
    // return;
    document.getElementById('loader').hidden=false;
    var headerid = $('#modal').data('headerid');
    var TypeRoi = $('#modal').data('TypeRoi');

    var lotno = $('#lot_no2').val();
    var lotnox = $('#lot_nox').val();
    var lotDescs = $('#lot_descs').val();
    var lot_descs = $('#modal').data('lot_descs');
    var this_descs2 = '<?php echo $data[0]->descs ?>';
    // alert(this_descs2);
    // return;
    var this_lotno ='<?php echo $data[0]->lot_no;?>';
    var Id = $('#modal').data('Id');
    // alert(Id);
    var Counter = $('#modal').data('nup_counter');
    var NupCnt = parseInt(Counter);
    var cntClr ="A"+NupCnt;
    var Cluster_cd =  $('#modal').data('Cluster_cd');
    var myBookDescs='';
    var myBookId="";
    if (lotno!='')
            {
                $('#lot_no2').val(lotno+','+this_lotno);
                $('#lot_descs').val(lotDescs+','+this_descs2);
                myBookId=lotno+','+this_lotno;
                myBookDescs = lotDescs+','+this_descs2
            } else {
                $('#lot_no2').val(this_lotno);
                $('#lot_descs').val(this_descs2);
                myBookId=this_lotno;
                myBookDescs = this_descs2;
            }
            // alert(myBookId);
    var site_url = '<?php echo base_url("c_mobile_cfld/update_status")?>';
    $.post(site_url,
        {id:Id,status:"R",lot_descs:this_descs2},
        function(data,status) {
            
            tstatus = 'R';
            if (lotno!='')
            {
                $('#lot_no2').val(lotno+','+this_lotno);
                $('#lot_descs').val(lotDescs+','+this_descs2);
            } else {
                $('#lot_no2').val(this_lotno);
                $('#lot_descs').val(this_descs2);
            }
        
        buttn.style.background = dataWarna[cntClr]["strokeColor"];
                
                // $('#modal').modal('hide');
                // document.getElementById('loader').hidden=true;
         }
    );
    if (myBookId == "") {

                swal('Warning', 'Please Click Unit!',"warning");
                return;
            }

            var site_url = "<?php echo base_url('c_mobile_cfld/set_session')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: {
                    unit_loop: myBookId,
                    Cluster_cd: Cluster_cd,
                    headerid:headerid//,
                    // lot_descs: myBookDescs
                },
                dataType: "json",
                success: function(data, status) {
                    // alert(myBookDescs);
                    if(headerid){
                        var HI = parseInt(headerid)+1000000;
                        var urll="<?php echo base_url('c_nup_cfld/edit_rev_mobile/N')?>"+'/'+HI;
                        // alert(urll);
                        window.location.href = urll;
                    } else {
                         window.location.href = "<?php echo base_url('c_nup_cfld/insert_mobile/N')?>/"+TypeRoi; //+'/'+property_cd+'/'+myBookId;
                    }
                    

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                }
            })
});
// $('#btnProses').click(function(){

//     document.getElementById('loader').hidden=false;
//     // var get_click = $("#usa_image").mapster("get");
//     // var arr_get_click = get_click.split(',');
//     var chosen_unit = $('#modal').data('chosen');
//     // var cnt_arr = arr_get_click.length;
//     var this_lotno ='<?php echo $data[0]->lot_no;?>';
//     var Id = $('#modal').data('Id');
//     var Counter = $('#modal').data('nup_counter');
//     var NupCnt = parseInt(Counter)+1;
//     var cntClr ="A"+NupCnt;
//     var Cluster_cd =  $('#modal').data('Cluster_cd');
//     // alert(property_cd);
//     // return;
//     var site_url = '<?php echo base_url("c_mobile_cfld/update_status")?>';
//     $.post(site_url,
//         {id:Id,status:"R"},
//         function(data,status) {
            
//             tstatus = 'R';
//             if (lotno!='')
//             {
//                 $('#lot_no2').val(lotno+','+this_lotno);
//             } else {
//                 $('#lot_no2').val(this_lotno);
//             }
        
//         buttn.style.background = dataWarna[cntClr]["fillColor"];
                
//                 $('#modal').modal('hide');
//                 // document.getElementById('loader').hidden=true;
//          }
//     );
//     // var myBookId = $('#txt_unit').val();
    
//     if (myBookId == "") {

//                 swal('Warning', 'Please Click Unit!',"warning");
//                 return;
//             }
//             var site_url = "<?php echo base_url('c_mobile_cfld/set_session')?>";
//             $.ajax({
//                 url: site_url,
//                 type: "POST",
//                 data: {
//                     unit_loop: myBookId,
//                     Cluster_cd: Cluster_cd,
//                     headerid:headerid
//                 },
//                 dataType: "json",
//                 success: function(data, status) {
//                     // alert(headerid);
//                     if(headerid){
//                         var HI = parseInt(headerid)+1000000;
//                         var urll="<?php echo base_url('c_nup_cfld/edit_rev_mobile/N')?>"+'/'+HI;
//                         // alert(urll);
//                         window.location.href = urll;
//                     } else {
//                          window.location.href = "<?php echo base_url('c_nup_cfld/insert_mobile/N')?>/"; //+'/'+property_cd+'/'+myBookId;
//                     }
                    

//                 },
//                 error: function(jqXHR, textStatus, errorThrown) {
//                     swal(textStatus + ' Save : ' + errorThrown);
//                 }
//             })
// });
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



$('#modal').one('hidden.bs.modal', function (e){
    
    // $('#'+e.key).prop('checked', false);
    $('div.modal-body').html("");
    var Id = $('#modal').data('Id');
   document.getElementById('loader').hidden=true;
    // $('#'+Id).prop('checked', false);
    $('#modal').removeData('bs.modal');

});
function load_data(){
    document.getElementById('loader').hidden=true;
    // alert('tasss');
}
// 
</script>