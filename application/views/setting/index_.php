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
    margin:auto;
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
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary active" type="button" id="btnsection" style="margin-left: 15px">Section</button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary" type="button" id="btncategory">Category</button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary" type="button" id="btnservice">Customer Service</button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary" type="button" id="btncomplain">Complain Source </button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary" type="button" id="btnlabour">Labour</button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary" type="button" id="btnitem">Item</button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary" type="button" id="btnfeedback">Feedback</button>
                    <button data-toggle="button" class="btn btn-block btn-outline btn-primary" type="button" id="btnassign">Assign</button>
                </div>
                <!-- --- Panel -- -->
                <div class="col-lg-10">
                    <div class="panel panel-info" id="tabsection" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Section
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
                                <table id="tblsection" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:15px !important;">No</th>
                                        <th>Section Code</th>
                                        <th>Description</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tabcategory" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Category
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tblcategory" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:15px !important;">No</th>
                                        <th>Category Code</th>
                                        <th>Description</th>
                                        <th>Priority</th>
                                        <th>Supervisor ID</th>
                                        <th>Type</th>
                                        <th>Category Group</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tabservice" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Costumer Service
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tblservice" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:15px !important;">No</th>
                                        <th>Service Code</th>
                                        <th>Section Code</th>
                                        <th>Category</th>
                                        <th>Trx Type</th>
                                        <th>Service Description</th>
                                        <th>Hours</th>
                                        <th>Tax Code</th>
                                        <th>Currency Code</th>
                                        <th>Service Rate</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tabcomplain" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Complain Source 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tblcomplain" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:15px !important;">No</th>
                                        <th>Complain Code</th>
                                        <th>Description</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tablabour" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Labour 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tbllabour" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:15px !important;">No</th>
                                        <th>Labour ID</th>
                                        <th>Name</th>
                                        <th>Division</th>
                                        <th>Departement</th>
                                        <th>Doc Type</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tabitem" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Item
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tblitem" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:5px !important;">No</th>
                                        <th style="width:5px !important;">IC</th>
                                        <th>Item Code</th>
                                        <th>Description</th>
                                        <th>Trx Type</th>
                                        <th>Tax Code</th>
                                        <th>Currency</th>
                                        <th>Unit Price</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tabfeedback" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Feedback
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tblfeedback" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:5px !important;">No</th>
                                        <th>Feedback Code</th>
                                        <th>Description</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-info" id="tabassign" style="height: 710px">
                        <div class="panel-heading">
                            <i class="fa fa-wrench"></i> Assign
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="tblassign" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                   
                                    <thead>            
                                        <th style="width:5px !important;">No</th>
                                        <th>User ID</th>
                                        <th>Labour ID</th>
                                        <th>Name</th>
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

        $('#tabsection').show()
        $('#tabcategory').hide()
        $('#tabservice').hide()
        $('#tabcomplain').hide()
        $('#tablabour').hide()
        $('#tabitem').hide()
        $('#tabfeedback').hide()
        $('#tabassign').hide()

        $('#btnsection').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabsection').show(300)
        })

        $('#btncategory').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabcategory').show(300)
        })

        $('#btnservice').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabservice').show(300)
        })

        $('#btncomplain').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabcomplain').show(300)
        })

        $('#btnlabour').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tablabour').show(300)
        })

        $('#btnitem').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabitem').show(300)
        })

        $('#btnfeedback').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabfeedback').show(300)
        })

        $('#btnassign').click(function(){
            $('.btn').removeClass('active').addClass('btn-outline').css("margin-left", "");
            $(this).removeClass('btn-outline').css("margin-left", "15px");
            $('.panel').hide()
            $('#tabassign').show(300)
        })



    });
    document.getElementById('spinner').hidden=false;

    var tblsection;
    $(function(){
       tblsection = $('#tblsection').DataTable( 
        {
            dom: '<"toolbar1 dataTables_filter billing-out-search">Bfrtip',
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

                            $('#modalTitle').html('Add Section');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addsection");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblsection.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblsection.rows(rows).data();
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

                            $('#modalTitle').html('Edit Section');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addsection");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblsection.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblsection.rows(rows).data();
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

                            $('#modalTitle').html('Delete Section');

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
                            $('#modal').data('table', 'sv_section')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('C_Setting_Cs/gettablesection');?>",
                "data":{
                    "sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search1').val();
                    var b="";
                    if(search == null || search==""){
                        return b;
                    }{
                        return search;
                    }
                 }
             },             
                "type":"POST"
            },
            "columns": [
                {data:"row_number",name:"row_number", searchable:false},
                {data:"section_cd",name:"section_cd"},
                {data:"descs",name:"descs"}            
                ]
        });
        $("div.toolbar1").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search1" name="txt_search1" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblsection()"><i class="fa fa-search"></i></a></div></div> </b>');
        $("#txt_search1").keyup(function(event){
            var a = $('#txt_search1').val();

            if (a == '') {
                tblsection.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblsection.ajax.reload(null, true);
                    }, 1000);
                }
            }
        });

    });

    var tblcategory;
    $(function(){
       tblcategory = $('#tblcategory').DataTable( 
        {
            dom: '<"toolbar2 dataTables_filter billing-out-search">Bfrtip',
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

                            $('#modalTitle').html('Add Category');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addcategory");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblcategory.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblcategory.rows(rows).data();
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

                            $('#modalTitle').html('Edit Section');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addcategory");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblcategory.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblcategory.rows(rows).data();
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
                            $('#modal').data('table', 'sv_category')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('C_Setting_Cs/gettablecategory');?>",
                "data":{"sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search2').val();
                    console.log(search)
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
                {data:"category_cd",name:"category_cd"},
                {data:"descs",name:"descs"},
                {data:"category_priority",name:"category_priority",
                    render: function (data, type, row) {
                        var priority = row.category_priority;
                        if(priority==1){
                            return "Low";
                        }
                        else if(priority==2){
                            return "Medium";
                        }
                        else if(priority==3){
                            return "High";
                        }
                        else{
                            return '-';
                        }
                    }
                },
                {data:"user_spv",name:"user_spv"},
                {data:"complain_type",name:"complain_type",
                    render: function (data, type, row) {
                        var complain = row.complain_type;
                        if (complain=='R') {
                            return 'Request';
                        }
                        else if(complain=='C'){
                            return 'Complain';
                        }
                        else{
                            return "-"
                        }
                    }
                },
                {data:"descs_category_group",name:"descs_category_group"},
            ]
        });
        $("div.toolbar2").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search2" name="txt_search2" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblcategory()"><i class="fa fa-search"></i></a></div></div> </b>');
        $("#txt_search2").keyup(function(event){
            var a = $('#txt_search2').val();

            if (a == '') {
                tblcategory.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        document.getElementById('interactive');
                        tblcategory.ajax.reload(null, true);
                    }, 1000);
                }
            }
        });

    });

    var tblservice;
    $(function(){
       tblservice = $('#tblservice').DataTable( 
        {
            dom: '<"toolbar3 dataTables_filter billing-out-search">Bfrtip',
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

                            $('#modalTitle').html('Add Service');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addservice");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblservice.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblservice.rows(rows).data();
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

                            $('#modalTitle').html('Edit Service');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addservice");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblservice.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblservice.rows(rows).data();
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

                            $('#modalTitle').html('Delete Service');

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
                            $('#modal').data('table', 'sv_master')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('C_Setting_Cs/gettableservice');?>",
                "data":{"sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search3').val();
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
                {data:"service_cd",name:"service_cd"},
                {data:"section_cd",name:"section_cd"},
                {data:"category_cd",name:"category_cd"},
                {data:"trx_type",name:"trx_type"},
                {data:"descs",name:"descs"},
                {data:"service_day",name:"service_day"},
                {data:"tax_cd",name:"tax_cd"},
                {data:"currency_cd",name:"currency_cd"},
                {data:"labour_rate",name:"labour_rate",
                    render: function (data, type, row) {
                        var labour_rate = row.labour_rate;
                        if (labour_rate == 0) {
                            return '<p class="pull-right">'+0+'</p>'
                        }else{
                            return '<p class="pull-right">'+formatNumber(labour_rate)+'</p>' ;
                        }
                    }
                },
            ]
        });
        $("div.toolbar3").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search3" name="txt_search3" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblservice()"><i class="fa fa-search"></i></a></div></div> </b>');

        $("#txt_search3").keyup(function(event){
            var a = $('#txt_search3').val();

            if (a == '') {
                tblservice.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblservice.ajax.reload(null, true);
                        document.getElementById('spinner').hidden = true;
                    }, 1000);
                }
            }
        });

    });

    var tblcomplain;
    $(function(){
       tblcomplain = $('#tblcomplain').DataTable( 
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

                            $('#modalTitle').html('Add Complain');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addcomplain");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblcomplain.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblcomplain.rows(rows).data();
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

                            $('#modalTitle').html('Edit Complain');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addcomplain");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblcomplain.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblcomplain.rows(rows).data();
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
                            $('#modal').data('table', 'sv_complain_source')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('C_Setting_Cs/gettablecomplain');?>",
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
                {data:"complain_source",name:"complain_source"},
                {data:"descs",name:"descs"},
            ]
        });
        $("div.toolbar4").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search4" name="txt_search4" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblcomplain()"><i class="fa fa-search"></i></a></div></div> </b>');

        $("#txt_search4").keyup(function(event){

            var a = $('#txt_search4').val();

            if (a == '') {
                tblcomplain.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblcomplain.ajax.reload(null, true);
                        document.getElementById('spinner').hidden = true;
                    }, 1000);
                }
            }
        });

    });

    var tbllabour;
    $(function(){
       tbllabour = $('#tbllabour').DataTable( 
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

                            $('#modalTitle').html('Add Labour');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addlabour");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tbllabour.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tbllabour.rows(rows).data();
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

                            $('#modalTitle').html('Edit Section');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addlabour");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tbllabour.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tbllabour.rows(rows).data();
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

                            $('#modalTitle').html('Delete Labour');

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
                            $('#modal').data('table', 'sv_labour')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('C_Setting_Cs/gettablelabour');?>",
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
                {data:"staff_id",name:"staff_id"},
                {data:"name",name:"name"},
                {data:"div_cd",name:"div_cd"},
                {data:"dept_cd",name:"dept_cd"},
                {data:"prefix",name:"prefix"},
            ]
        });
        $("div.toolbar5").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search5" name="txt_search5" ><a class="btn blue-bg btn-sm" onclick="fn_searchtbllabour()"><i class="fa fa-search"></i></a></div></div> </b>');
        $("#txt_search5").keyup(function(event){

            var a = $('#txt_search5').val();

            if (a == '') {
                tbllabour.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tbllabour.ajax.reload(null, true);
                        document.getElementById('spinner').hidden = true;
                    }, 1000);
                }  
            }
        });

    });

    var tblitem;
    $(function(){
       tblitem = $('#tblitem').DataTable( 
        {
            dom: '<"toolbar6 dataTables_filter billing-out-search">Bfrtip',
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

                            $('#modalTitle').html('Add Item');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/additem");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblitem.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblitem.rows(rows).data();
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

                            $('#modalTitle').html('Edit Item');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/additem");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblitem.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblitem.rows(rows).data();
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

                            $('#modalTitle').html('Delete Item');

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
                            $('#modal').data('table', 'sv_charge')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('C_Setting_Cs/gettableitem');?>",
                "data":{"sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search6').val();
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
                {data:"ic_flag",name:"ic_flag",
                    render: function (data, type, row) {
                        var ic_flag = row.ic_flag;
                        if (ic_flag=='N') {
                            return '<div class="checkbox checkbox-primary"><input type="checkbox" disabled><label></label></div>'
                        }
                        else{
                            return '<div class="checkbox checkbox-primary"><input type="checkbox" checked="" disabled><label></label></div>'
                        }
                    }
                },
                {data:"item_cd",name:"item_cd"},
                {data:"descs",name:"descs"},
                {data:"trx_type",name:"trx_type"},
                {data:"tax_cd",name:"tax_cd"},
                {data:"currency_cd",name:"currency_cd"},
                {data:"charge_amt",name:"charge_amt",
                    render: function (data, type, row) {
                        var charge_amt = row.charge_amt;
                        if (charge_amt == 0) {
                            return '<p class="pull-right">'+0+'</p>'
                        }else{
                            return '<p class="pull-right">'+formatNumber(charge_amt)+'</p>' ;
                        }    
                    }
                },
            ]
        });
        $("div.toolbar6").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search6" name="txt_search6" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblitem()"><i class="fa fa-search"></i></a></div></div> </b>');
        $("#txt_search6").keyup(function(event){

            var a = $('#txt_search6').val();

            if (a == '') {
                tblitem.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblitem.ajax.reload(null, true);
                        document.getElementById('spinner').hidden = true;
                    }, 1000);
                }  
            }
        });

    });

    var tblfeedback;
    $(function(){
       tblfeedback = $('#tblfeedback').DataTable( 
        {
            dom: '<"toolbar7 dataTables_filter billing-out-search">Bfrtip',
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

                            $('#modalTitle').html('Add Feedback');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addfeedback");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblfeedback.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblfeedback.rows(rows).data();
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

                            $('#modalTitle').html('Edit Feedback');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addfeedback");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblfeedback.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblfeedback.rows(rows).data();
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

                            $('#modalTitle').html('Delete Feedback');

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
                            $('#modal').data('table', 'sv_feed_back')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('C_Setting_Cs/gettablefeedback');?>",
                "data":{"sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search7').val();
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
                {data:"code",name:"code"},
                {data:"descs",name:"descs"},
            ]
        });
        $("div.toolbar7").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search7" name="txt_search7" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblfeedback()"><i class="fa fa-search"></i></a></div></div> </b>');
        $("#txt_search7").keyup(function(event){
            var a = $('#txt_search7').val();

            if (a == '') {
                tblfeedback.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblfeedback.ajax.reload(null, true);
                        document.getElementById('spinner').hidden = true;
                    }, 1000);
                }  
            }
        });

    });

    var tblassign;
    $(function(){
       tblassign = $('#tblassign').DataTable( 
        {
            dom: '<"toolbar8 dataTables_filter billing-out-search">Bfrtip',
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

                            $('#modalTitle').html('Add Assign');
                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addassign");?>");
                            $('#modal').data('id', 0).modal('show');
                            // $('#modal').data('action', "add");
                        }
                    },
                    {
                        text: ' Edit', className: 'biru-bg fa fa-pencil',
                        action: function () {                       
                            var rows = tblassign.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblassign.rows(rows).data();
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

                            $('#modalTitle').html('Edit Assign');
                            

                            $('div.modal-body').load("<?php echo base_url("C_Setting_Cs/addassign");?>");

                            $('#modal').data('id', id);
                            $('#modal').modal('show');
                            // $('#modal').data('action', "edit");
                            

                        }
                    },
                    {
                        text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                        action: function () {
                            
                            var rows = tblassign.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }

                            var data = tblassign.rows(rows).data();
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

                            $('#modalTitle').html('Delete Assign');

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
                            $('#modal').data('table', 'sv_user_assign')

                        }
                    }                    
                ],
            "processing": false,
            "serverSide": true,
            "ajax":{
                "url":"<?php echo base_url('C_Setting_Cs/gettableassign');?>",
                "data":{"sSearch": function(d){
                    document.getElementById('spinner').hidden=true;
                    var search = $('#txt_search8').val();
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
                {data:"user_id",name:"user_id"},
                {data:"staff_id",name:"staff_id"},
                {data:"staff_id",name:"staff_id"},
            ]
        });
        $("div.toolbar8").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search8" name="txt_search8" ><a class="btn blue-bg btn-sm" onclick="fn_searchtblfeedback()"><i class="fa fa-search"></i></a></div></div> </b>');
        $("#txt_search8").keyup(function(event){

            var a = $('#txt_search8').val();

            if (a == '') {
                tblassign.ajax.reload(null, true);
            }
            if (event.keyCode == 13) {
                document.getElementById('spinner').hidden = false;
                var state = document.readyState
                if (state == 'complete') {
                    setTimeout(function () {
                        tblassign.ajax.reload(null, true);
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
                url : "<?php echo base_url('C_Setting_Cs/delete');?>",
                type:"POST",
                data: data,
                dataType:"json",
                success:function(event, data){
                        swal("Information",event.Pesan,"warning");
                        $('#modal').modal('hide');
                        tblsection.ajax.reload(null,true);
                        tblcategory.ajax.reload(null,true);
                        tblservice.ajax.reload(null,true);
                        tblcomplain.ajax.reload(null,true);
                        tbllabour.ajax.reload(null,true);
                        tblitem.ajax.reload(null,true);
                        tblfeedback.ajax.reload(null,true);
                        tblassign.ajax.reload(null,true);
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

    function fn_searchtblsection(){
        var a = $('#txt_search1').val();
        tblsection.ajax.reload(null,true);
    }
    function fn_searchtblcategory(){
        var a = $('#txt_search2').val();
        tblcategory.ajax.reload(null,true);
    }
    function fn_searchtblservice(){
        var a = $('#txt_search3').val();
        tblservice.ajax.reload(null,true);
    }
    function fn_searchtblcomplain(){
        var a = $('#txt_search4').val();
        tblcomplain.ajax.reload(null,true);
    }
    function fn_searchtbllabour(){
        var a = $('#txt_search5').val();
        tbllabour.ajax.reload(null,true);
    }
    function fn_searchtblitem(){
        var a = $('#txt_search6').val();
        tblitem.ajax.reload(null,true);
    }
    function fn_searchtblfeedback(){
        var a = $('#txt_search7').val();
        tblfeedback.ajax.reload(null,true);
    }
    function fn_searchtblassign(){
        var a = $('#txt_search8').val();
        tblassign.ajax.reload(null,true);
    }
</script>