<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

<style type="text/css">
     #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>
<script type="text/javascript">

// $( document ).ready(function() {
//     document.getElementById("cb_2").disabled = true;
//     document.getElementById("cb_3").disabled = true;
// });

var table;

$(function(){    

    $(".select2_demo_1").select2({
        });
    

    $('#group').on("change",function(e){
        SetCheckBox(false);
        var groupId = $('#group').val();

        if(groupId !== '')
        {
            $.ajax({
                url: '<?php echo base_url("c_assignmenu/getList")?>',
                data: {gid: groupId},
                type: 'post',
                dataType: 'json',
                success: function(dts, status){
                    var n = 0;
                    $.each(dts, function(i, data){
                        var ids = table.rows().indexes();
                        
                        for (var i = 0; i < ids.length; i++) {
                            var menuID = table.rows(i).data()[0].MenuID;
                            if(data.groupCd != '')
                            {
                                if(menuID == data.MenuID) {
                                    $('#tblassign input[name=cb_'+menuID+']').prop('checked', true);
                                    n++;
                                }
                            }
                        };
                        if(n == ids.length) {
                            $('#cbHeader').prop('checked', true);
                        }
                    });
                },
                error: function(jqXHR, textStatus, errorThrown){                    
                    swal("Information",'failed to load group',"warning");
                }
            });
        }
    });

    table = $('#tblassign').DataTable({
        select: true,
        filter:false,
        paging:false,
        info:false,
        processing: false,
        serverSide: true,
        ajax:{
            url:"<?php echo base_url('c_assignmenu/getTable');?>",
            // data:{"group": function(e){
            //     var a = $('#group').val();
            //     if(a == null) {
            //         return '';
            //     } else {
            //         return $('#group').val();
            //     }
            // }},
            type:"post"
        },
        columns: [
            {data:"row_number", name:"row_number", searchable:false},
            {
                data:"Title", name:"Title", sortable: false,
                render: function(data, type, row){
                    var str = data.replace(/\s/g, "   ");
                    return str;
                }
            },
            {
                data:"MenuID", name:"MenuID", searchable:false, orderable:false, render: function(data, type, row){
                    switch(data) {
                        case 2:                            
                        case 3:
                        // console.log(data);
                        return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')" disabled/>';
                        default:
                             return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')"/>';
                    }                    

                    // return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')"/>';


                }
            }
        ]
    });
    
    $('#btnSave').click(function(){
        document.getElementById('loader').hidden=false; 
        var groupId = $('#group').val();
        if(groupId !== '')
        {
            var ids = table.rows().indexes();
            var ACCESS_CODE = '';
            var selData = [];
            for(var i = 0; i < ids.length; i++)
            {
                var menuID = table.rows(i).data()[0].MenuID;
                var chx = $('#tblassign input[name=cb_'+menuID+']').prop('checked');

                ACCESS_CODE = '';
                if(chx) {
                    ACCESS_CODE = 1;
                }

                if(ACCESS_CODE != '')
                {
                    var today = new Date().toLocaleString();
                    var sysMenuGroup = new Object()
                    sysMenuGroup.GroupCd = groupId;
                    sysMenuGroup.MenuID = menuID;
                    selData.push(sysMenuGroup);
                }
            }

            console.log(ids.length);
            $.ajax({
                url: '<?php echo base_url("c_assignmenu/save");?>',
                data: {models: selData},
                method: 'post',
                dataType: 'json',
            })
            .done(function(msg){
                // console.log(msg);
                document.getElementById('loader').hidden=true; 
                swal("Information",msg.Response,"success");
            })
            .fail(function(jqXHR, textStatus){                
                swal("Information",textStatus,"warning");
                document.getElementById('loader').hidden=true; 
            });

        } else {            
            swal("Information",'Please select a group first !',"warning");
        }
    });
});

function cbclick(data){
    $('#cbHeader').prop('checked', false);
    var thisVal = $('#tblassign input[name=cb_'+data+']').is(':checked');
    if(thisVal == false)
    {
        uncheck(data);
        return;
    }

    var rows = table.rows().indexes();
    var selMenu = '';
    $.each(rows, function(){
        var selMenu = table.rows(this).data()[0].MenuID;
        if(data == selMenu)
        {
            var parentID = table.rows(this).data()[0].ParentMenuID;
            if(!($('#tblassign input[name=cb_'+parentID+']').is(':checked')))
            {
                $('#tblassign input[name=cb_'+parentID+']').prop('checked', true);
            }
            var thisVal = $('#tblassign input[name=cb_'+parentID+']').is(':checked');
            if(thisVal == false)
                return;

            var selMenu = '';
            $.each(rows, function(){
                selMenu = table.rows(this).data()[0].MenuID;
                
                if(parentID==selMenu)
                {
                    var level1 = table.rows(this).data()[0].ParentMenuID;
                    console.log('level1 : '+level1);
                    if(!($('#tblassign input[name=cb_'+level1+']').is(':checked')))
                    {
                        $('#tblassign input[name=cb_'+level1+']').prop('checked', true);
                    }

                    var thisVal = $('#tblassign input[name=cb_'+level1+']').is(':checked');
                    if(thisVal==false)
                        // console.log('end');
                        return;

                    var rows = table.rows().indexes();
                    var selMenu = '';

                    $.each(rows, function(){
                        selMenu = table.rows(this).data()[0].MenuID;
                        if(level1 == selMenu)
                        {
                            var level2 = table.rows(this).data()[o].ParentMenuID;
                            if(!$('#tblassign input[name=cb_'+level2+']').is(':checked'))
                            {
                                $('#tblassign input[name=cb_'+level2+']').prop('checked', true);
                            }
                        }
                    });
                }
            });
            return;
        }
    });
}

function uncheck(val)
{
    $('#cbHeader').prop('checked', false);
    var thisVal = $('#tblassign input[name=cb_'+ val +']').is(':checked');
    var rows = table.rows().indexes();
    var selMenu = '';

    $.each(rows, function() {
        selMenu = table.rows(this).data()[0].ParentMenuID;
        if(val==selMenu)
        {
            var MenuID = table.rows(this).data()[0].MenuID;
            $('#tblassign input[name=cb_'+MenuID+']').prop('checked', false);
            var rows = table.rows().indexes();
            var selMenu  = '';
            $.each(rows, function(){
                selMenu = table.rows(this).data()[0].ParentMenuID;
                if (MenuID == selMenu)
                {
                    var level1 = table.rows(this).data()[0].MenuID;
                    $('#tblassign input[name=cb_'+level1+']').prop('checked', false);
                    var rows = table.rows().indexes();
                    var selMenu = '';
                    $.each(rows, function(){
                        selMenu = table.rows(this).data()[0].ParentMenuID;
                        if(level1 == selMenu)
                        {
                            var level2 = table.rows(this).data()[0].MenuID;
                            $('#tblassign input[name=cb_'+level2+']').prop('checked', false);
                        }
                    });
                }
            });
            return;
        }
    });
}

function cbAll(e){
    e = e || event; /* get IE event ( not passed ) */
    e.stopPropagation ? e.stopPropagation() : e.cancelBubble = true;

    var chkSelectAll = $('#cbHeader');

    if (chkSelectAll.length && chkSelectAll.is(':checked') && !status) {
        SetCheckBox( true);
    }
    else {
        SetCheckBox( false);
    }
}

function SetCheckBox(val) {
    var rows = table.rows().indexes();
    for (var i = 0; i < rows.length ; i++) {
        var menuId = table.rows(i).data()[0].MenuID;
        $('#tblassign' + ' input[name=cb' + '_' + menuId + ']').prop('checked', val);
    }
    $('#cbHeader').prop('checked', val);
}

</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <!-- <div class="tittle-top pull-left"><?php echo $entityname;?></div> -->
            <div class="judulprojek"><?php echo $entityname;?></div>
            <div class="tittle-top pull-right">Assign Menu to Group</div>
        </div><br>
        <div class="form-group">
            <label for="group" class="col-sm-1 control-label">Group</label>
            <div class="col-sm-10">
                <select name="group" id="group" data-placeholder="Choose a Group..." class="select2_demo_1 form-control" style="width:250px;" tabindex="2">
                    <?php echo $cmbGroup?>
                </select>
            </div><br>
        </div>
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblassign" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                            
                            <thead>            
                                <th style="width:30px !important;">No</th>
                                <th>Menu</th>
                                <th><input type="checkbox" id="cbHeader" onclick='cbAll(event)'/></th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-12 col-sm-6 col-md-8">&nbsp;</div>
                            <div class="col-sm-6 col-md-4" style="text-align:right"><button type="button" id="btnSave" class="btn btn-primary">SAVE</button></div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>     
</div>
