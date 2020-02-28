           
                   
        <!-- </div> -->
        <!-- <div id="loader" class="loader" hidden="true"></div> -->
        <div class="row">
        <div class="col-md-12">
                   <div >
                        
                        <!-- <div class="image-unit">
                              <img src="/img/1BR_STD.jpg" id="image_room"> 
                        </div> -->
                        <!-- <div class="form-group">
                    
                        <img id="picturebox" src="<?=base_url('img/FloorPlan/room.jpg')?>" alt="Your Image" />
                    
                        </div> -->
                        <div class="col-md-7">
                        <!-- <div class="ibox-content "> -->
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
                        <!-- </div> -->
                   </div>
                  <div class="col-md-5">
                      <div class="ibox-content" style="font-size:14px;">
                      <!-- <div class="panel panel-body"> -->
                          <!-- <div class="box-body" > -->
                            
                            <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
                            
                            <table  border="2px">
                                <tbody><tr style="padding: 5px;" >
                                    <td style="padding: 5px;" >
                                       Property :<br><strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
                                    </td>
                                    <td style="padding: 5px;" >
                                        Lantai :<br><strong><span id="no_lantai"><?php echo $data[0]->level_descs;?></span></strong>
                                    </td>
                                    <td style="padding: 5px;" >
                                         No Unit :<br><strong><span id="no_unit"><?php echo $data[0]->lot_no;?></span></strong>
                                    </td>
                                </tr>
                                <tr style="padding: 5px;" >
                                    <td style="padding: 5px;" >
                                        Luas :<br><strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                                    </td>
                                    <td style="padding: 5px;" >
                                        View :<br><strong><span id="view"><?php echo $data[0]->zone_descs;?></span></strong>
                                    </td>
                                    <td style="padding: 5px;" > 
                                         Hadap  :<br><strong><span id="direction"><?php echo $data[0]->direction_descs;?></span></strong>
                                    </td>
                                </tr>
                            </tbody></table>
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
    $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'} );
    $('#modal').modal('hide');
});
$('#btnOk').click(function (e){
    document.getElementById('loader').hidden=false;
    var get_click = $("#usa_image").mapster("get");
    var arr_get_click = get_click.split(',');
    var lotno = $('#txt_unit').val();
    var cnt_arr = arr_get_click.length;
    var this_lotno ='<?php echo $data[0]->lot_no;?>';
    var Id = $('#modal').data('Id');
    var property_cd =  $('#modal').data('property_cd');
    // alert(property_cd);
    // return;

   var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
    $.post(site_url,
        {id:Id,status:"R",property_cd:property_cd},
        function(data,status) {
            $("#usa_image").mapster('set', true, Id);
            tstatus = 'R';
             // console.log(data.Pesan);        
             if (lotno!=''){
                    $('#txt_unit').val(lotno+','+this_lotno);
                } else {
                    $('#txt_unit').val(this_lotno);
                }
                
                $('#modal').modal('hide');
                document.getElementById('loader').hidden=true;
         }
    );
    
    

    // landinfo(e);
});
$('#btnProses').click(function(){
    var property_cd = $('#modal').data('property_cd');
    var chosen_unit = $('#modal').data('chosen');
    var unitnow = $('#modal').data('Id');

    var myBookId = '';
    if (chosen_unit=='')
    {
        myBookId = unitnow;
    } else {
        myBookId = chosen_unit+','+unitnow;
    }
    document.getElementById('loader').hidden=false;
    var get_click = $("#usa_image").mapster("get");
    var arr_get_click = get_click.split(',');
    var lotno = $('#txt_unit').val();
    var cnt_arr = arr_get_click.length;
    var this_lotno ='<?php echo $data[0]->lot_no;?>';
    var Id = $('#modal').data('Id');
    
    // alert(myBookId+', pro_cd: '+property_cd);
    var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
    $.post(site_url,
        {id:Id,status:"R",property_cd:property_cd},
        function(data,status) {
            $("#usa_image").mapster('set', true, Id);
            tstatus = 'R';
             // console.log(data.Pesan);        
             if (lotno!=''){
                    $('#txt_unit').val(lotno+','+this_lotno);
                } else {
                    $('#txt_unit').val(this_lotno);
                }
                
                // $('#modal').modal('hide');
                document.getElementById('loader').hidden=true;
         }
    );
    // var myBookId = $('#txt_unit').val();
    var url_ = '<?php echo base_url("c_stepbooking/next/3")?>';
    if (myBookId == "") {
        swal('Warning', 'Please Click Unit!',"warning");
            return;
    }
            var site_url = "<?php echo base_url('c_stepbooking/set_session')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: {
                    property_cd: property_cd,
                    unit_book: myBookId
                },
                dataType: "json",
                success: function(data, status) {
                    var busID = '<?php echo $business_id;?>';
                    window.location.href = "<?php echo base_url('c_stepbooking/add_customer')?>/"+busID+"/L"; //+'/'+property_cd+'/'+myBookId;

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                }
            })

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



$('#modal').one('hidden.bs.modal', function (e){
    
    // $('#'+e.key).prop('checked', false);
    var Id = $('#modal').data('Id');
   $("#usa_image").mapster('set', true, Id,{fillColor: '00FF00'} );
    // $('#'+Id).prop('checked', false);
    $('#modal').removeData('bs.modal');

});
function load_data(){
    document.getElementById('loader').hidden=true;
    // alert('tasss');
}
// 
</script>