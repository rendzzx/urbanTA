<style type="text/css">
    td {
        padding: 6px;
        /*border: 1px solid black;*/
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="ibox-content ">
                <div class="carousel slide" id="carousel2">
                APARTMENT
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
        <div class="col-md-6">
            <div class="ibox-content">
                <div class="panel panel-body">
                <div class="box-body" style="font-size:14px;">
                        <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
                        <table  border= "1px" >
                            <tbody><tr>
                                <td>
                                    Tower <strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
                                </td>
                                <td>
                                    Lantai <strong><span id="no_lantai"><?php echo $data[0]->level_descs;?></span></strong>
                                </td>
                                <td>
                                    No Unit <strong><span id="no_unit"><?php echo $data[0]->lot_no;?></span></strong>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Luas <strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                                </td>
                                <td>
                                    View <strong><span id="view"><?php echo $data[0]->zone_descs;?></span></strong>
                                </td>
                                <td>
                                    Hadap  <strong><span id="direction"><?php echo $data[0]->direction_descs;?></span></strong>
                                </td>
                            </tr>
                        </tbody></table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button id="btnOk" type="button" class="btn btn-success">Ok</button>
        <button id="btnCancel" type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
    </div>

    <script type="text/javascript">

        $('#btnCancel').click(function(e){
            var Id = $('#modal').data('Id');

            $('#modal').modal('hide');
        });

        $('#btnOk').click(function (e){
            var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
            var Id = $('#modal').data('Id');
            var b =  $('#modal').data('balance');
            var property_cd = $('#modal').data('property_cd');
            $.post(site_url,
                      {id:Id,status:"R",property_cd:property_cd},
                      function(data,status) {
                        console.log(data.Pesan);
                        // var a = event.nup_no;
                        // alert(a);
                       $('#'+Id).removeClass("btn-success").addClass("btn-warning");
                        txt.push(Id);
                        console.log(txt);
                        $('#txt_unit').val(txt);
                        $('#modal').modal('hide');
                      }
                    );

            
            
        });

        $('#modal').one('hidden.bs.modal', function (e){
            // var Id = $('#modal').data('Id');
            // console.log(Id);
            $('#modal').removeData('bs.modal');
        });
</script>