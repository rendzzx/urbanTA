<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.css">

    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
    
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.10/dist/sweetalert2.min.js"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/validation/jquery.validate.min.js'); ?>"></script>

    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>"></script>
<!-- link -->

<!-- content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before" style="height: 150px !Important"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <br><br>
                    <h3 class="content-header-title">Assign Menu Entry</h3>
                </div>
                <div class="content-header-right col-md-8 col-12 mb-2">
                    <br>    
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
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
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
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
                                                <th>Description</th>
                                                <th><input type="checkbox" id="cbHeader" onclick='cbAll(event)'/></th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <br><br>
                                    <div class="" style="text-align:right;margin-right: 10px;">
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
<!-- content -->

<!-- js -->
    <script type="text/javascript">
        $(".select2").select2();

        $('#group').on("change",function(e){
            SetCheckBox(false);
            var groupId = $('#group').val();
            if(groupId !== ''){
                $.ajax({
                    url: '<?php echo base_url("C_menu/getList")?>',
                    data: {gid: groupId},
                    type: 'post',
                    dataType: 'json',
                    success: function(dts, status){
                        var n = 0;
                        $.each(dts, function(i, data){
                            var ids = tblassign.rows().indexes();
                            
                            for (var i = 0; i < ids.length; i++) {
                                var menuID = tblassign.rows(i).data()[0].MenuID;
                                if(data.groupCd != ''){
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
                            animation: true,
                            type:"error",
                            text: textStatus+' GetList : '+errorThrown,
                            confirmButtonText: "OK"
                        });
                    }
                });
            }
        });
        
        var tblassign = $('#tblassign').DataTable({
            "responsive":true,
            "paging":false,
            "ajax":{
                "url":"<?php echo base_url('C_menu/getTableAssign');?>",
                "dataSrc": "",
                "data":{
                    "group": function(e){
                        var a = $('#group').val();
                        if(a == null) {
                            return '';
                        } else {
                            return $('#group').val();
                        }
                    }
                },
                "type":"post"
            },
            "columns": [
                {data:"MenuID"},
                {data:"Title",
                    render: function(data, type, row){
                        var str = data.replace(/\s/g, "   ");
                        return str;
                    }
                },
                {data:"descs"},
                {data:"MenuID",
                    render: function(data, type, row){
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
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar tblassign">rti',
            "responsive": {
                details: {
                    type: 'column',
                    target: 8
                }
            }
        });

        tblassign.on( 'order.dt search.dt', function () {
            tblassign.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        }).draw();
        
        $('#btnSave').click(function(){
            block(true);
            var groupId = $('#group').val();
            if(groupId !== ''){
                var ids = tblassign.rows().indexes();
                var ACCESS_CODE = '';
                var selData = [];

                for(var i = 0; i < ids.length; i++){
                    var menuID = tblassign.rows(i).data()[0].MenuID;
                    var chx = $('#tblassign input[name=cb_'+menuID+']').prop('checked');
                    ACCESS_CODE = '';
                    if(chx) {
                        ACCESS_CODE = 1;
                    }

                    if(ACCESS_CODE != ''){
                        var today = new Date().toLocaleString();
                        var sysMenuGroup = new Object()
                        sysMenuGroup.GroupCd = groupId;
                        sysMenuGroup.MenuID = menuID;
                        selData.push(sysMenuGroup);
                    }
                }

                $.ajax({
                    url  : '<?php echo base_url("C_menu/saveAssign");?>',
                    data : {
                        'models': selData
                    },
                    type : 'POST',
                    dataType: 'json',
                    success:function(event, data){
                        if (event.Error == false) {
                            Swal.fire({
                                title: "Information",
                                animation: true,
                                icon:"success",
                                text: event.Message,
                                confirmButtonText: "OK"
                            });
                            $('#modal').modal('hide');
                            tblassign.ajax.reload(null,true);
                        }
                        else{
                            Swal.fire({
                                title: "Information",
                                animation: true,
                                icon:"error",
                                text: event.Message,
                                confirmButtonText: "OK"
                            });
                        }
                        block(false);
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                        Swal.fire({
                            title: "Error",
                            animation: true,
                            icon:"error",
                            text: textStatus+' Save : '+errorThrown,
                            confirmButtonText: "OK"
                        });
                        block(false);
                    }
                });
            }
            else {
                Swal.fire({
                    title: "Information",
                    animation: true,
                    icon:"warning",
                    text: 'Please select a group first !',
                    confirmButtonText: "OK"
                });
            }
        });

        function cbclick(data){
            $('#cbHeader').prop('checked', false);
            var thisVal = $('#tblassign input[name=cb_'+data+']').is(':checked');
            if(thisVal == false)
            {
                uncheck(data);
                return;
            }

            var rows = tblassign.rows().indexes();
            var selMenu = '';
            $.each(rows, function(){
                var selMenu = tblassign.rows(this).data()[0].MenuID;
                if(data == selMenu)
                {
                    var parentID = tblassign.rows(this).data()[0].ParentMenuID;
                    if(!($('#tblassign input[name=cb_'+parentID+']').is(':checked')))
                    {
                        $('#tblassign input[name=cb_'+parentID+']').prop('checked', true);
                    }
                    var thisVal = $('#tblassign input[name=cb_'+parentID+']').is(':checked');
                    if(thisVal == false)
                        return;

                    var selMenu = '';
                    $.each(rows, function(){
                        selMenu = tblassign.rows(this).data()[0].MenuID;
                        
                        if(parentID==selMenu)
                        {
                            var level1 = tblassign.rows(this).data()[0].ParentMenuID;
                            console.log('level1 : '+level1);
                            if(!($('#tblassign input[name=cb_'+level1+']').is(':checked')))
                            {
                                $('#tblassign input[name=cb_'+level1+']').prop('checked', true);
                            }

                            var thisVal = $('#tblassign input[name=cb_'+level1+']').is(':checked');
                            if(thisVal==false)
                                // console.log('end');
                                return;

                            var rows = tblassign.rows().indexes();
                            var selMenu = '';

                            $.each(rows, function(){
                                selMenu = tblassign.rows(this).data()[0].MenuID;
                                if(level1 == selMenu)
                                {
                                    var level2 = tblassign.rows(this).data()[o].ParentMenuID;
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

        function uncheck(val){
            $('#cbHeader').prop('checked', false);
            var thisVal = $('#tblassign input[name=cb_'+ val +']').is(':checked');
            var rows = tblassign.rows().indexes();
            var selMenu = '';

            $.each(rows, function() {
                selMenu = tblassign.rows(this).data()[0].ParentMenuID;
                if(val==selMenu)
                {
                    var MenuID = tblassign.rows(this).data()[0].MenuID;
                    $('#tblassign input[name=cb_'+MenuID+']').prop('checked', false);
                    var rows = tblassign.rows().indexes();
                    var selMenu  = '';
                    $.each(rows, function(){
                        selMenu = tblassign.rows(this).data()[0].ParentMenuID;
                        if (MenuID == selMenu)
                        {
                            var level1 = tblassign.rows(this).data()[0].MenuID;
                            $('#tblassign input[name=cb_'+level1+']').prop('checked', false);
                            var rows = tblassign.rows().indexes();
                            var selMenu = '';
                            $.each(rows, function(){
                                selMenu = tblassign.rows(this).data()[0].ParentMenuID;
                                if(level1 == selMenu)
                                {
                                    var level2 = tblassign.rows(this).data()[0].MenuID;
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
            e = e || event;
            e.stopPropagation ? e.stopPropagation() : e.cancelBubble = true;

            var chkSelectAll = $('#cbHeader');

            if (chkSelectAll.length && chkSelectAll.is(':checked') && !status) {
                SetCheckBox(true);
            }
            else {
                SetCheckBox(false);
            }
        }

        function SetCheckBox(val) {
            var rows = tblassign.rows().indexes();
            for (var i = 0; i < rows.length ; i++) {
                var menuId = tblassign.rows(i).data()[0].MenuID;
                $('#tblassign' + ' input[name=cb' + '_' + menuId + ']').prop('checked', val);
            }
            $('#cbHeader').prop('checked', val);
        }
    </script>
<!-- ks -->