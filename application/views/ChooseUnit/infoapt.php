<style type="text/css">
    td {
        padding: 6px;
        /*border: 1px solid black;*/
    }
</style>


<div class="row">
    <div class="col-md-12">
    <div>
        <div class="col-md-7">
            <div class="ibox-content ">
                <div class="carousel slide" id="carousel2">
                <!-- APARTMENT -->
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
        </div>
        <div class="col-md-5">
            <div class="ibox-content" style="font-size:14px;">
                <!-- <div class="panel panel-body"> -->
                <!-- <div class="box-body" style="font-size:14px;"> -->
                        <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
                        <table  border= "1px" >
                            <tbody><tr>
                                <td>
                                    Tower :<br><strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
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
                    <!-- </div> -->
                <!-- </div> -->
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
            // alert(Id);

            // document.getElementById(Id).checked =false;
            // $('#'+Id).removeClass("btn-danger").addClass("btn-primary");
            $('#modal').modal('hide');
        });

        $('#btnOk').click(function (e){


            var Id = $('#modal').data('Id');
            var b =  $('#modal').data('balance');
            // alert(Id);
            
            txt.push(Id);
            // document.getElementById("txtlotno").value=txt; 
            $('#'+Id).removeClass("btn-primary").addClass("btn-danger");

            //green
            var lotno = Id;
            var lot_no = $('#txtlotno').val();
            var lot_no2 = $('#txtlotno2').val();
            var arr_lot = lot_no.split(",");
            var arr_lot2 = lot_no2.split(",");
            var new_lot = ""; var new_lot2 = "";
            
            // txtlotno
            for (i = 0; i < arr_lot2.length; i++) {
              if (arr_lot2[i] != lotno && new_lot2 == ""){
                new_lot2 = arr_lot2[i];
              } else if (arr_lot2[i] == lotno && new_lot2 == ""){
                new_lot2 = new_lot2;
              } else if (arr_lot2[i] != lotno && new_lot2 != ""){
                new_lot2 = new_lot2 + ',' + arr_lot2[i];
              }
            }
            // alert(new_lot2);

            // txtlotno2
            for (i = 0; i < arr_lot.length; i++) {
              if (arr_lot[i] != lotno && new_lot == "" && lot_no == ""){
                new_lot = lotno;
              } else if (arr_lot[i] != lotno && new_lot == "" && lot_no != ""){
                new_lot = arr_lot[i] + ',' + lotno;
              } else if (arr_lot[i] != lotno && new_lot != ""){
                new_lot = new_lot + ',' + lotno;
              } else {
                new_lot = lot_no;
              }
            }
            // alert(new_lot);

            $('#txtlotno').val(new_lot);
            $('#txtlotno2').val(new_lot2);



            $('#txtlotno').val(txt);
            $('#modal').modal('hide');
        });

        $('#modal').one('hidden.bs.modal', function (e){
            var Id = $('#modal').data('Id');
            // console.log(Id);
            $('#'+Id).prop('checked', false);
            $('#modal').removeData('bs.modal');
        });
</script>