
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<style type="text/css">
#loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>

<div id="loader" class="loader" hidden="true"></div>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before" style="height: 150px !Important"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
              <br><br>
              <h3 class="content-header-title">Assign Menu Approval</h3>
              
          </div>

          <div class="content-header-right col-md-8 col-12 mb-2">
                <br>
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                        </li>
                        <li class="breadcrumb-item active">Assign Menu Approval
                        </li>
                        <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Web Menu -->
                        </li>
                        </ol>
                    </div>
                </div>
            </div>

            
      </div>
      <div class="content-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title">Assign Menu Approval</h4> -->
                        <div class="form-group">
                            
                            <div class="col-xs-6" style="margin-top: 30px;margin-bottom: 0px; padding-bottom: 0px;margin-left: 15px;">
                                <label for="group" class="col-xs-6">Group</label>
                                <select name="group" id="group" data-placeholder="Choose a Group..." class="select2_demo_1 form-control" style="width:250px;" tabindex="2">
                                     <?php echo $cmbGroup?>
                                </select>
                            </div>
                        </div>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content collapse show" style="margin-top: -40px;">
                        <div class="card-body card-dashboard">
                            <div class="table-responsive" id="cont">
                                <table id="tblassign" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                    <thead>            
                                        <th style="width:30px !important;">No</th>
                                        <th>Menu</th>
                                        <th><input type="checkbox" id="cbHeader" onclick='cbAll(event)'/></th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                                <div>
                                    <div class="" style="text-align:right;margin-right: 50px;">
                                        <button type="button" id="btnSave" class="btn btn-primary">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<!-- date-range-picker -->
<script src="<?=base_url('js/plugins/fullcalendar/moment.min.js')?>"></script>
<script src="<?=base_url('js/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

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
                url: '<?php echo base_url("c_assignmenu_approval/getList")?>',
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
                    // swal("Information",'failed to load group',"warning");
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: textStatus+' GetList : '+errorThrown,
                        confirmButtonText: "OK"
                    });
                }
            });
        }
    });
 table = $('#tblassign').DataTable({
        // select: true,
        // filter:false,
        paging:false,
        searching: false,
        // info:false,
        // processing: false,
        // serverSide: true,
        ajax:{
            url:"<?php echo base_url('c_assignmenu_approval/getTable');?>",
            data:{"group": function(e){
                var a = $('#group').val();
                if(a == null) {
                    return '';
                } else {
                    return $('#group').val();
                }
            }},
            type:"post"
        },
        columns: [
            {
                data:"row_number", name:"row_number", searchable:false
            },
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
                        // case 3:
                        // // console.log(data);
                        // return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')" disabled/>';
                        default:
                             return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')"/>';
                    }                    

                    // return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')"/>';


                }
            }
        ]
    });
    
    $('#btnSave').click(function(){
        block(true);
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
                    sysMenuGroup.Group_Cd = groupId;
                    sysMenuGroup.MenuID = menuID;
                    selData.push(sysMenuGroup);
                }
            }

            $.ajax({
                url  : '<?php echo base_url("c_assignmenu_approval/save");?>',
                data : {'models': selData},
                type : 'POST',
                dataType: 'json',
                success:function(event, data){
                    if(event.Error==false){
                        block(false);
                        swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        });
                        table.ajax.reload(null,true);
                    }
                    else {
                        block(false);
                        swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        });
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    block(false);
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: textStatus+' Save : '+errorThrown,
                        confirmButtonText: "OK"
                    });
                     
                }
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

function block(boelan){
    var block_ele = $('#cont')
    if (boelan==true) {
        $(block_ele).block({
            message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
            fadeIn: 1000,
            fadeOut: 1000,
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: '10px 15px',
                color: '#fff',
                width: 'auto',
                backgroundColor: '#333',
                marginLeft : 'auto'
            }
        });
    }
    else{
        $(block_ele).unblock()
    }
}

</script>