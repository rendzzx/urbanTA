<div id="tbl_infolot" style="font-size:14px;padding: 0px 5px 5px;">
<h3 id="nama_tipe"><?php echo $data[0]->lot_type_descs;?></h3>
                            
                            <table >
                                <tbody><tr>
                                    <td width="100px">
                                       Property :<br><strong><span id="no_tower"><?php echo $data[0]->property_descs;?></span></strong>
                                    </td>
                                    <td width="100px">
                                         Unit Number :<br><strong><span id="no_unit"><?php echo $data[0]->lot_no;?></span></strong>
                                    </td>
                                    <td width="100px">
                                         Design Option :<br><strong><span id="no_unit"><?php echo $data[0]->theme;?></span></strong>
                                    </td>
                                    <td width="100px">
                                        Building Area :<br><strong><span id="luas_bangunan"><?php echo $data[0]->build_up_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                                    </td>
                                    
                                    
                                </tr>
                                <tr>
                                    <td>
                                        Land Area :<br><strong><span id="luas_bangunan"><?php echo $data[0]->land_area;?></span> <?php echo $data[0]->area_uom;?></strong>
                                    </td>
                                    <td>
                                        View :<br><strong><span id="view"><?php echo $data[0]->zone_descs;?></span></strong>
                                    </td>
                                    <td>
                                         Direction  :<br><strong><span id="direction"><?php echo $data[0]->direction_descs;?></span></strong>
                                    </td>
                                    <td id="price">
                                         Harga Early Bird :<br><strong><span id="no_unit"><?php echo $data[0]->price_HC;?></span></strong><br>
                                         Harga Launching:<br><strong><span id="no_unit"><?php echo $data[0]->trx_amt_1;?></span></strong>
                                    </td>
                                </tr>
                            </tbody></table>
                            </div>