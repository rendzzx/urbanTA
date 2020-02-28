<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<style type="text/css">
    #spinner {
    width:100%;
    height:50%;
    position:absolute;
    z-index:9999;
    margin: auto;
}
</style>

<div class="col-lg-13">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h1 align="center"><i class="fa fa-wrench"></i> Setting</h1>
        </div>

        <div class="ibox-content">
            <div class="row">
                <!-- --- Menu Samping -- -->
                <div class="col-lg-2">
                    
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary active" type="button" id="btnottype" style="margin-left: 15px">Overtime Type</button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary " type="button" id="btnworkhour" >Work Hour</button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary" type="button" id="btnotrate">Overtime Rate by Area</button>
                   
                </div>
                <!-- --- Panel -- -->
                <div class="col-lg-10">
                   
                    <div class="panel panel-info" id="tabottype" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Overtime Type
                        </div>
                        <div class="panel-body">
                         <div class="spiner-example" id="spinner" hidden="true">
                                <div class="sk-spinner sk-spinner-three-bounce">
                                    <div class="sk-bounce1"></div>
                                    <div class="sk-bounce2"></div>
                                    <div class="sk-bounce3"></div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="tblottype" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:15px !important;">No</th>
                                        <th>Overtime Code</th>
                                        <th>Description</th>
                                        <th>Trx Type</th>
                                        <th>Tax Code</th>
                                        <th>Type</th>
                                        <!-- <th hidden="true">Rate Type</th> -->
                                        <th>Rate</th>
                                        <th>Project No</th>
                                       
                                        
                                       
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tabworkhour" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Work Hour 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tblworkhour" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:15px !important;">No</th>
                                        <th>Day Code</th>
                                        <th>Description</th>
                                        <th>Day Type</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tabotrate" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Overtime Rate by Area 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tblotrate" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:15px !important;">No</th>
                                        <th>Level No</th>
                                        <th>Description</th>
                                        <th>Area</th>
                                        
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $( document ).ready(function() {

        
        $('#tabworkhour').hide()
        $('#tabotrate').hide()
        $('#tabottype').show()
       
        $('#btnworkhour').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabworkhour').show(300)
        })
        $('#btnotrate').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabotrate').show(300)
        })
        $('#btnottype').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabottype').show(300)
        })

    });
    document.getElementById('spinner').hidden=false;
 
    var tblworkhour;
    $(function(){
       tblworkhour = $('#tblworkhour').DataTable( 
        {
            dom: '<"toolbar4 dataTables_filter billing-out-search">Bfrtip',
                responsive: true,
                select: true,
                filter: false,
                buttons: [
                    {
                        text: ' Add', className: 'biru-bg fa fa-plus ', action: function (e) {
                            var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                case "modal fade bs-example-modal-sm":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                case "modal-dialog modal-sm":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                            }

                            $('#modalTitle').html('Add Work Hour');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_ot/addworkhour");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblworkhour.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblworkhour.rows(rows).data();
                            var id = data[0].rowID;

                            var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                case "modal fade bs-example-modal-sm":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                case "modal-dialog modal-sm":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                            }

                            $('#modalTitle').html('Edit Work Hour');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_ot/addworkhour");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblworkhour.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblworkhour.rows(rows).data();
                            console.log(data)
                            var id = data[0].rowID;
                            


                            var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-lg":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-lg":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                            }

                            $('#modalTitle').html('Delete Category');

                            $('div.modal-body').html('Are you sure that you want to delete this item?');

                            $('div.modal-body').append('<div class="modal-footer"></div>');

                            var btnYes = $('<input/>')
                                .attr({
                                    id: "btnYes",
                                    type: "button",
                                    class: "btn btn-danger",
                                    onclick: 'Delete();',
                                    value: 'Yes'
                                });

                            var btnNo = $('<a>No</a>').attr({
                                class: "btn btn-default", 'data-dismiss': "modal"
                            });

                            $('div.modal-footer').append(btnYes);
                            $('div.modal-footer').append(btnNo);

                            $('#modal').data('id', id).modal('show');
                            $('#modal').data('table', 'cf_workhour')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('c_setting_ot/gettableworkhour');?>",
                "data":{"sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search4').val();
                    var b="";
                    if(search == null || search==""){
                        return b;
                    }{
                        return search;
                    }
                 }},             
                "type":"POST"
            },

            "columns": [
                {data:"row_number",name:"row_number", searchable:false},
                {data:"day_cd",name:"day_cd"},
                {data:"descs",name:"descs"},
                
                {data:"day_type",name:"day_type",
                    render: function (data, type, row) {
                        var day_type = row.day_type;
                        if(day_type=='D'){
                            return "Weekday";
                        }
                        else{
                            return "Weekend";
                        }
                        
                    }
                },
                {data:"begin_time",name:"begin_time",
                   render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,19)));
                                var h =data.substr(11,3);
                                var m=data.substr(14,2);
                                var s =data.substr(16,3);
                               
                               
                               
                               var aa = h+""+m+""+s;
                              
                               return aa;
                               // return data;
                               

                           }
                },
                {data:"end_time",name:"end_time",
                    render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,19)));
                                var h =data.substr(11,3);
                                var m=data.substr(14,2);
                                var s =data.substr(16,3);
                               
                               
                               
                               var aa = h+""+m+""+s;
                              
                               return aa;
                               // return data;
                               

                           }
                },
            ]
        });
        $("div.toolbar4").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search4" name="txt_search4" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblworkhour()"><i class="fa fa-search"></i></a></div></div> </b>');

        $("#txt_search4").keyup(function(event){

            var a = $('#txt_search4').val();

            if (a == '') {
                tblworkhour.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblworkhour.ajax.reload(null, true);
                        document.getElementById('spinner').hidden = true;
                    }, 1000);
                }
            }
        });

    });

    var tblotrate;
    $(function(){
       tblotrate = $('#tblotrate').DataTable( 
        {
            dom: '<"toolbar5 dataTables_filter billing-out-search">Bfrtip',
                responsive: true,
                select: true,
                filter: false,
                buttons: [
                    // {
                    //     text: ' Add', className: 'biru-bg fa fa-plus ', action: function (e) {
                    //         var modalClass = $('#modal').attr('class');
                    //         switch (modalClass) {
                    //             case "modal fade bs-example-modal-md":
                    //                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                    //                 break;
                    //             case "modal fade bs-example-modal-sm":
                    //                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                    //                 break;
                    //             default:
                    //                 $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                    //                 break;
                    //         }

                    //         var modalDialogClass = $('#modalDialog').attr('class');
                    //         switch (modalDialogClass) {
                    //             case "modal-dialog modal-md":
                    //                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                    //                 break;
                    //             case "modal-dialog modal-sm":
                    //                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                    //                 break;
                    //             default:
                    //                 $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                    //                 break;
                    //         }

                    //         $('#modalTitle').html('Add Overtime Rate by Area');
                    //         $('div.modal-body').load("<?php echo base_url("C_Setting_ot/addOTRate");?>");
                    //         $('#modal').data('id', 0).modal('show');
                    //         // $('#modal').data('action', "add");
                    //     }
                    // },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblotrate.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblotrate.rows(rows).data();
                            var id = data[0].rowID;

                            var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                case "modal fade bs-example-modal-sm":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                case "modal-dialog modal-sm":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                            }

                            $('#modalTitle').html('Edit Overtime Rate by Area');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_ot/addOTRate");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblotrate.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblotrate.rows(rows).data();
                            console.log(data)
                            var id = data[0].rowID;
                            


                            var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-lg":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-lg":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                            }

                            $('#modalTitle').html('Delete');

                            $('div.modal-body').html('Are you sure that you want to delete this item?');

                            $('div.modal-body').append('<div class="modal-footer"></div>');

                            var btnYes = $('<input/>')
                                .attr({
                                    id: "btnYes",
                                    type: "button",
                                    class: "btn btn-danger",
                                    onclick: 'Delete();',
                                    value: 'Yes'
                                });

                            var btnNo = $('<a>No</a>').attr({
                                class: "btn btn-default", 'data-dismiss': "modal"
                            });

                            $('div.modal-footer').append(btnYes);
                            $('div.modal-footer').append(btnNo);

                            $('#modal').data('id', id).modal('show');
                            $('#modal').data('table', 'pm_level')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('c_setting_ot/gettableOTRate');?>",
                "data":{"sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search5').val();
                    var b="";
                    if(search == null || search==""){
                        return b;
                    }{
                        return search;
                    }
                 }},             
                "type":"POST"
            },

            "columns": [
                {data:"row_number",name:"row_number", searchable:false},
                {data:"level_no",name:"level_no"},
                {data:"descs",name:"descs"},
                
                {data:"area",name:"area"},
                
            ]
        });
        $("div.toolbar5").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search5" name="txt_search5" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblotrate()"><i class="fa fa-search"></i></a></div></div> </b>');

        $("#txt_search5").keyup(function(event){

            var a = $('#txt_search5').val();

            if (a == '') {
                tblotrate.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblotrate.ajax.reload(null, true);
                        document.getElementById('spinner').hidden = true;
                    }, 1000);
                }
            }
        });

    });

    var tblottype;
    $(function(){
       tblottype = $('#tblottype').DataTable( 
        {
            dom: '<"toolbar5 dataTables_filter billing-out-search">Bfrtip',
                responsive: true,
                select: true,
                filter: false,
                buttons: [
                    {
                        text: ' Add', className: 'biru-bg fa fa-plus ', action: function (e) {
                            var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                case "modal fade bs-example-modal-sm":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                case "modal-dialog modal-sm":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                            }

                            $('#modalTitle').html('Add Overtime Type');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_ot/addOTType");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblottype.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblottype.rows(rows).data();
                            var id = data[0].id_type;
                            var id2 = data[0].id_rate;

                            var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                case "modal fade bs-example-modal-sm":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                case "modal-dialog modal-sm":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                    break;
                            }

                            $('#modalTitle').html('Edit Overtime Type');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_ot/addOTType");?>");

                            $('#modal').data('id', id);
                            $('#modal').data('id2', id2);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblottype.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblottype.rows(rows).data();
                            console.log(data)
                            var id = data[0].rowID;
                            


                            var modalClass = $('#modal').attr('class');
                            switch (modalClass) {
                                case "modal fade bs-example-modal-lg":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                                case "modal fade bs-example-modal-md":
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                                default:
                                    $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                    break;
                            }

                            var modalDialogClass = $('#modalDialog').attr('class');
                            switch (modalDialogClass) {
                                case "modal-dialog modal-lg":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                                case "modal-dialog modal-md":
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                                default:
                                    $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                    break;
                            }

                            $('#modalTitle').html('Delete');

                            $('div.modal-body').html('Are you sure that you want to delete this item?');

                            $('div.modal-body').append('<div class="modal-footer"></div>');

                            var btnYes = $('<input/>')
                                .attr({
                                    id: "btnYes",
                                    type: "button",
                                    class: "btn btn-danger",
                                    onclick: 'Delete();',
                                    value: 'Yes'
                                });

                            var btnNo = $('<a>No</a>').attr({
                                class: "btn btn-default", 'data-dismiss': "modal"
                            });

                            $('div.modal-footer').append(btnYes);
                            $('div.modal-footer').append(btnNo);

                            $('#modal').data('id', id).modal('show');
                            $('#modal').data('table', 'pm_level')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('c_setting_ot/gettableOTType');?>",
                "data":{"sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search5').val();
                    var b="";
                    if(search == null || search==""){
                        return b;
                    }{
                        return search;
                    }
                 }},             
                "type":"POST"
            },

            "columns": [
                    
                {data:"row_number",name:"row_number", searchable:false},
                {data:"over_cd",name:"over_cd"},
                {data:"descs",name:"descs"},
                {data:"trx_type",name:"trx_type"},
                {data:"tax_cd",name:"tax_cd"},
                {data:"type",name:"type",
                    render: function (data, type, row) {
                        var type = row.type;
                        var typestat ='';
                        if (type == 'L') {
                            return typestat = 'By Area'; 
                        }else{
                            return typestat = 'By Zone' ;
                        }
                    }
                },
                // {data:"rate_type",name:"rate_type"},
                {data:"rate",name:"rate"},
                {data:"project_no",name:"project_no"},
                {data:"id_type",name:"id_type", visible:false},
                {data:"id_rate",name:"id_rate", visible:false}
                
            ]
        });
        $("div.toolbar6").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search6" name="txt_search6" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblottype()"><i class="fa fa-search"></i></a></div></div> </b>');

        $("#txt_search6").keyup(function(event){

            var a = $('#txt_search6').val();

            if (a == '') {
                tblottype.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblottype.ajax.reload(null, true);
                        document.getElementById('spinner').hidden = true;
                    }, 1000);
                }
            }
        });

    });

    function Delete() {
            var id = $('#modal').data('id');
            var table = $('#modal').data('table');
            var data = [];
            data.push({ name:'id', value:id },{ name:'table', value:table })
            $.ajax({
                url : "<?php echo base_url('C_Setting_ot/delete');?>",
                type:"POST",
                data: data,
                dataType:"json",
                success:function(event, data){
                        swal("Information",event.Pesan,"warning");
                        $('#modal').modal('hide');
                        tblotrate.ajax.reload(null,true);
                        tblottype.ajax.reload(null,true);
                        tblworkhour.ajax.reload(null,true);
                        
                },                    
                error: function(jqXHR, textStatus, errorThrown){        
                        // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");

                }
            });
    }

    function formatNumber(data) 
    {
      if(data==null){
        data =0;
      }
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    }

    
    function fn_searchtblottype(){
        var a = $('#txt_search6').val();
        tblottype.ajax.reload(null,true);
    }
    function fn_searchtblworkhour(){
        var a = $('#txt_search4').val();
        tblworkhour.ajax.reload(null,true);
    }
    function fn_searchtblotrate(){
        var a = $('#txt_search5').val();
        tblotrate.ajax.reload(null,true);
    }
    
</script>