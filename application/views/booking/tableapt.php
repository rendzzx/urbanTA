
<style type="text/css">
    td
{
   padding: 6px;
   border: 1px solid #cecece;
}
td.infobox {
        padding: 5px;
        border: 1px solid #cecece;
        margin: 10px;
        width: 100px;
    }
</style>
<div id="tbl_infoapt">
        <h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
            <table  >
                 <tr >
                                    <td class="infobox">
                                       Property :<br><strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                        Floor :<br><strong><span id="no_lantai"><?php echo $data[0]->level_descs;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                         Unit No.:<br><strong><span id="no_unit"><?php echo $data[0]->lot_no;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                         WING :<br><strong><span id="no_unit"><?php echo $data[0]->block_descs;?></span></strong>
                                    </td>
                                </tr>
                                <tr >
                                    <td class="infobox">
                                        Semi Gross Area (m2) :<br><strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                                    </td>
                                    <td class="infobox">
                                        View :<br><strong><span id="view"><?php echo $data[0]->zone_descs;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                         Direction  :<br><strong><span id="direction"><?php echo $data[0]->direction_descs;?></span></strong>
                                    </td>
                                    <td class="infobox">
                                    Harga Hard Cash<br>
                                    - Early Bird :<br><strong><span id="no_unit"><?php echo $data[0]->price_HC;?></span></strong><br>
                                    - Launching:<br><strong><span id="no_unit"><?php echo $data[0]->trx_amt_1;?></span></strong>
                                    </td>
                                </tr>
                            </table>
                    <!-- </div> -->
                <!-- </div> -->
            </div>