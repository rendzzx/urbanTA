           
                   
        <!-- </div> -->
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
                            
                            <table  border= "0px" >
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
                            </tbody></table><!-- 
                            <h4>Detail</h4>
                            <table class="table">
                                <tbody><tr>
                                    <td>
                                        <div class="fa fa-bank" aria-hidden="true"><br> Balkon</div>
                                    </td>
                                    <td>
                                        <div class="glyphicon glyphicon-lamp"><br> Ruang Tamu</div>
                                    </td>
                                    <td>
                                        <div class="fa fa-asterisk"><br> Kamar Mandi</div> 
                                        
                                    </td>
                                    <td>
                                        <div class="fa fa-cutlery" aria-hidden="true"><br> Dapur</div>
                                    </td>
                                </tr>
                            </tbody></table>

                            <h4>Fasilitas</h4>
                            <table class="table">
                                <tbody><tr>
                                    <td>
                                        <div class="fa fa-shield"> Keamanan</div>
                                    </td>
                                    <td>
                                        <div class="fa fa-columns"> Lift</div>
                                    </td>
                                    <td>
                                        <div class="glyphicon glyphicon-tent"> Playground</div>
                                    </td>
                                    <td>
                                        <div class="fa fa-sun-o"><br> Kolam Renang</div>
                                    </td>
                                </tr>
                            </tbody></table>
                            <h4>Harga : <span id="harga_unit">Rp. 562.000.000</span></h4> -->
                            
                          <!-- </div> -->

                          <!-- <div class="panel-body">
                            <button type="submit" class="btn btn-success btn-lg btn-block" id="btn-booked">PESAN SEKARANG</button>
                          </div> -->
                           
                      <!-- </div> -->
                  </div>
                  </div>
                  </div>

                </div>


                   <!-- <div class="col-xs-2">
                     <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/*" />
                        </span>
                        <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                        <input type="hidden" id="seqno" name="seqno"  readonly="readonly" value="<?php echo $seq_no?>" />
                   </div> -->
                     
               

<div class="modal-footer">
<!-- <a id="show_selected" href="#">Click here to show selected items:</a>
                            <span id="selections" src=""></span>  --> 
<button id="btnOk" type="button" class="btn btn-success">Ok</button>

    
<button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
</div>

<script type="text/javascript">
var txt = [];
$('#btnCancel').click(function(e){
    // var get_click = $("#usa_image").mapster();
    var Id = $('#modal').data('Id');
    document.getElementById(Id).checked =false;
    $("#usa_image").mapster('set', false, Id);
    $('#modal').modal('hide');
});
$('#btnOk').click(function (e){
    var get_click = $("#usa_image").mapster("get");
    var arr_get_click = get_click.split(',');
    var lotno = $('#lot_no2').val();
    var cnt_arr = arr_get_click.length;
    var this_lotno ='<?php echo $data[0]->lot_no;?>';
    var Id = $('#modal').data('Id');
    var b =  $('#modal').data('balance');

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
        $('#lot_no2').val(get_click);
    }
    
    $('#modal').modal('hide');

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
    
    // $('#'+e.key).prop('checked', false);
    var Id = $('#modal').data('Id');
    // var selected = false;
    // alert(e.Id);
    console.log(Id);
    $('#'+Id).prop('checked', false);
    $('#modal').removeData('bs.modal');

});
// 
</script>