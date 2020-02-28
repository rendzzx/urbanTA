
        
            <div id="MAP" class="box-body" style="overflow-x: scroll;">
                <div id="map_demo" style="width:920px; ">    
                    <!-- <div style="width:720px; border:0; overflow: hidden; float:left;">      
                        <img style="width:800px;border:0;" id="usa_image" src="<?=base_url ('img/FloorPlan/IMAGE.jpg
                        ') ?>" usemap="#usa" >
                    </div> -->
                    <div style="width:720px; border:0; overflow: hidden; float:left;">      
                        <img style="width:800px;border:0;" id="usa_image" src="<?php echo base_url();?><?php echo $map_picture;?>" usemap="#usa" >
                    </div>
                    <div  id="statelist" style="float:left; padding-left: 10px; width:180px; height: 445px; overflow-y: scroll;"></div>

                    <div style="clear:both; height:8px;"></div>
                    <div>
                        <div style="clear:both;"></div> 
                        <input id="update" type="submit" value="Update">
                        <input type="button" value="Realod" id="test" onclick="test_klik()">
                        <br><br>
                        <div>
                            <a id="show_selected" href="#">Click here to show selected items:</a>
                            <span id="selections"></span>    
                        </div>
                    </div>
                </div>
            <map id="usa_image_map" name="usa">
        
                <?php echo $dataarea; ?>
            </map>
            </div>
      
      <script>
          $(document).ready(function () {

        // $('#btnReload').on('click', function(){

        // });

        var $statelist, $usamap, ratio,
        mapsterConfigured = function () {
            // set html settings values
            
            var opts = $usamap.mapster('get_options', null, true);
            if (!ratio) {
                ratio = $usamap.width() / $usamap.height();
            }
            $('#stroke_highlight').prop("checked", opts.render_highlight.stroke);
            $('#strokewidth_highlight').val(opts.render_highlight.strokeWidth);
            $('#fill_highlight').val(opts.render_highlight.fillOpacity);
            $('#strokeopacity_highlight').val(opts.render_highlight.strokeOpacity);
            $('#stroke_select').prop("checked", opts.render_select.stroke);
            $('#strokewidth_select').val(opts.render_select.strokeWidth);
            $('#fill_select').val(opts.render_select.fillOpacity);
            $('#strokeopacity_select').val(opts.render_select.strokeOpacity);
            $('#mouseout-delay').val(opts.mouseoutDelay);
            $('#img_width').val($usamap.width());
        },
        // var area = '<?php echo $keyarea; ?>';
        //     console.log(area);
        default_options =
        {
            fillOpacity: 0.5,
            render_highlight: {
                fillColor: '2aff00',                
                stroke: true
            },
            render_select: {
                fillColor: 'ff000c',
                stroke: false
            },
            //render_zoom: {
            //    altImage: 'images/usa_map_huge.jpg'
            //},
            mouseoutDelay: 0,
            fadeInterval: 50,
            isSelectable: true,
            singleSelect: false,
            // mapKey: 'state',
            mapKey: 'unit',
            mapValue: 'full',
            listKey: 'name',
            listSelectedAttribute: 'checked',
            sortList: "asc",
            onGetList: addCheckBoxes,
            onClick: function (e) {
               styleCheckbox(e.selected, e.listTarget);
               if (!utils.isScrolledIntoView(e.listTarget, false, $statelist)) {
                   utils.centerOn($statelist, e.listTarget);
               }
               selected = true;

               $('#'+e.key).prop('checked', selected);
               // console.log(e.key);
               // console.log(e);
               // console.log('1');
               //  if (e.key==='OH') {
               //     $usamap.mapster('zoom','OH');
               //      return false;
               //  }
               // return true;
            },
            onConfigured: mapsterConfigured,
            showToolTip: true,
            toolTipClose: ["area-mouseout"],
            areas:[ <?php echo $keyarea; ?> ] 
           
        };

        function styleCheckbox(selected, $checkbox) {
            var nowWeight = selected ? "bold" : "normal";
            $checkbox.closest('div').css("font-weight", nowWeight);
        }
        
        function addCheckBoxes(items) {
            // console.log(items);
            // console.log('2');
            var item, selected;
            $statelist.children().remove();
            for (var i = 0; i < items.length; i++) {
                selected = items[i].isSelected();
                item = $('<div><input type="checkbox" id="'+ items[i].key +'" name="' + items[i].key + '" ' + (selected ? "checked" : "") + '><span class="sel" key="' + items[i].key + '">' + items[i].value + '</span></div>');

                $statelist.append(item);
            }
            $statelist.find('span.sel').unbind('click').bind('click', function (e) {
                var key = $(this).attr('key');
                $usamap.mapster('highlight', true, key);
            });
            // return the list to mapster so it can bind to it
            return $statelist.find('input[type="checkbox"]').unbind('click').click(function (e) {
                var selected = $(this).is(':checked');
                $usamap.mapster('set', selected, $(this).attr('name'));
                styleCheckbox(selected, $(this));
            });
        }


        $statelist = $('#statelist');
        $usamap = $('#usa_image');
        function bindlinks() {
            // console.log('bindlinks');
            // $('*').unbind();
            $("#unbind_link").bind("click", function (e) {
                e.preventDefault();
                $usamap.mapster("unbind");
                $usamap.width(720);
                bindlinks();
            });
            $("#rebind_link").bind("click", function (e) {
                console.log('rebind_link');
                e.preventDefault();
                $usamap.mapster(default_options);
            });

            $("#unbind_link_preserve").bind("click", function (e) {
                e.preventDefault();
                $usamap.mapster("unbind", true);
                bindlinks();
            });
            $("#tooltip").bind("click", function (e) {
                e.preventDefault();
                var state = !$usamap.mapster('get_options').showToolTip;
                $('#tooltip_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { showToolTip: state });
            });
            $("#show_selected").bind("click", function (e) {
                e.preventDefault();
                $('#selections').text($("#usa_image").mapster("get"));
            });
            $("#single_select").bind("click", function (e) {
                e.preventDefault();
                var state = !$usamap.mapster('get_options').singleSelect;
                $('#single_select_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { singleSelect: state });
            });
            $("#is_deselectable").bind("click", function (e) {
                e.preventDefault();
                var state = !$usamap.mapster('get_options').isDeselectable;
                $('#is_deselectable_state').text(state ? "enabled" : "disabled");
                $usamap.mapster("set_options", { isDeselectable: state });
            });
            function getSelected(sel) {
                var item=$();
                sel.each(function() {
                    if (this.selected) {
                        item=item.add(this);
                        return false;
                    }

                });
                return item;

            }

            function getFillOptions(el) {
                var new_options,
                    val = getSelected($(el).find("option")).val();

     //            if (val > "0") {
     //                new_options = {
                    //  altImage: 'images/usa_map_720_alt_' + val + '.jpg',
                    //  stroke: true
                    // };
     //            } else {
                    new_options = {
                        altImage: null,
                        stroke: false
                    };
                // }
                return new_options;
            }

            function getNewOptions() {
                var options,
                    render_highlight = getFillOptions($('#highlight_style')),
                    render_select = getFillOptions($('#select_style'));

                options = $.extend({},
                    default_options,
                    {
                        render_select: render_select,
                        render_highlight: render_highlight
                    });

                return options;

            }
            $("#highlight_style, #select_style").bind("change", function (e) {
                e.preventDefault();
                $statelist.children().remove();

                $usamap.mapster(getNewOptions());

            });
            $("#update").click(function (e) {
                var newOpts = {};
                function setOption(base, opt, value) {
                    if (value !== '' && value !== null) {
                        base[opt] = value;
                    }
                }
                e.preventDefault();

                newOpts.render_highlight = {};
                setOption(newOpts.render_highlight, "stroke", $('#stroke_highlight').prop("checked"));

                setOption(newOpts.render_highlight, "strokeWidth", $('#strokewidth_highlight').val());
                setOption(newOpts.render_highlight, "fillOpacity", $('#fill_highlight').val());
                setOption(newOpts.render_highlight, "strokeOpacity", $('#strokeopacity_highlight').val());

                newOpts.render_select = {};
                setOption(newOpts.render_select, "stroke", $('#stroke_select').prop("checked"));
                setOption(newOpts.render_select, "strokeWidth", $('#strokewidth_select').val());
                setOption(newOpts.render_select, "fillOpacity", $('#fill_select').val());
                setOption(newOpts.render_select, "strokeOpacity", $('#strokeopacity_select').val());
                setOption(newOpts, "mouseoutDelay", $('#mouseout-delay').val());
                var width = parseInt($('#img_width').val(), 10);

                if ($usamap.width() != width) {
                    $('#update').prop("disabled",true);
                    $usamap.mapster('resize', width, null, 1000,function() {
                        $('#update').prop("disabled",false);
                    });
                } else {
                    $usamap.mapster('set_options', newOpts);
                }

            });

        }

        bindlinks();
        
        $usamap.mapster(default_options);


    });
      </script>


            