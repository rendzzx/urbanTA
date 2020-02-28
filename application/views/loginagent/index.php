<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

<script type="text/javascript">
window.history.forward();
</script>

 <style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
/*div.dataTables_wrapper 
div.dataTables_filter {
    text-align: right;
    float: right;
    padding-bottom: 5px;
}*/
</style>

<script type="text/javascript">
// $('.select2').select2();

var tblAgent,tblstaff;
$(function(){
$('.select2').select2();

   tblAgent = $('#tblAgent').DataTable( 
    {
         dom: '<"toolbar1 dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
            buttons: [
                {
                    text: ' Process ss', className: "btn biru-bg fa fa-plus hidden ", action: function (e) {

                        var site_url = '<?php echo base_url("c_booking/index")?>';
        
                        window.location.href= site_url;

                    }
                }
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_loginagent/getTable');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search_debtor').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
                }},           
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {
              // data: "rowID", name: "rowID", visible: false
              data: "agent_cd", name: "agent_cd",
                            render: function (data, type, row) {
                            var project=row.project_no;
                            var entity=row.entity_cd;
                                return  '<a class="btn btn-success btn-sm" onclick="email(\''+data+'\',\''+project+'\',\''+entity+'\');"" ><i class="fa fa-envelope fa-fw"></i> Process</a>';
                                // return status;
                            }
            }, 
            {data:"agent_cd",name:"agent_cd"},
            {data:"agent_name",name:"agent_name"},            
            {data:"handphone1",name:"handphone1"},
            {data:"email_add",name:"email_add"},
            
            {
              data: "rowID", name: "rowID", searchable:false, orderable:false,
                    render: function (data, type, row) {
                        return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')"/>';
      
                    }
            },
            {data:"rowID",name:"rowID",visible:false}, 
            {data:"entity_cd",name:"entity_cd",visible:false}
           
            ]
    });
    // $("div.toolbar1").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" class="form-control" style="width: 150px; height: 25px;" id="txt_search_debtor"  name="txt_search_debtor" > <a class="btn btn-success btn-sm" onclick="fn_search_debtor()"><i class="fa fa-search"></i></a></div></div></b>');
 $("div.toolbar1").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search_debtor" name="txt_search_debtor" ><a class="btn blue-bg btn-sm" onclick="fn_search_debtor()"><i class="fa fa-search"></i></a></div></div><br><br></b>');
    // $('#txt_search').change(function(){
    //     // BootstrapDialog.alert('asdf');
    // });
     $("#txt_search_debtor").keyup(function(event){
        var a = $('#txt_search_debtor').val();
        if(a==''){
            tblAgent.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            // $("#id_of_button").click();
            
            tblAgent.ajax.reload(null,true);   
        }
        
    }); //end of tblAgent

     tblstaff = $('#tblstaff').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
            buttons: [
                {
                    text: ' Process', className: "btn biru-bg fa fa-plus hidden ", action: function (e) {

                        var site_url = '<?php echo base_url("c_booking/index")?>';
        
                        window.location.href= site_url;

                    }
                }
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_loginagent/getTableStaff');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search2').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
                },
                "project": function(d){
                    var a = $('#txtProject').val();
                    // console.log(a);
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    }},           
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {
              data: "name", name: "name",
                            render: function (data, type, row) {
                            var project=row.project_no;
                            var entity=row.entity_cd;
                                return  '<a class="btn btn-success btn-sm" onclick="email2(\''+data+'\',\''+project+'\',\''+entity+'\');"" ><i class="fa fa-envelope fa-fw"></i> Process</a>';
                                // return status;
                            }
            }, 
            {data:"name",name:"name"},
            {data:"description",name:"description"},            
            {data:"phone_cellular",name:"phone_cellular"},
            {data:"email_add",name:"email_add"},
            
            {
              data: "RowID", name: "RowID", searchable:false, orderable:false,
                    render: function (data, type, row) {
                        return '<input type="checkbox" id="cb_' + data + '" name="cb_' + data + '" onclick="cbclick('+data+')"/>';
      
                    }
            },
            {data:"RowID",name:"RowID",visible:false}, 
            {data:"entity_cd",name:"entity_cd",visible:false},
            {data:"project_no",name:"project_no",visible:false}
           
            ]
    });
    

     $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search2" name="txt_search2" ><a class="btn blue-bg btn-sm" onclick="fn_search2()"><i class="fa fa-search"></i></a></div></div><br><br></b>');


     $("#txt_search2").keyup(function(event){
        var a = $('#txt_search2').val();
        if(a==''){
            tblstaff.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            
            tblstaff.ajax.reload(null,true);   
        }
        
    });//end of tblstaff
     $('#search_project').click(function(){
        // var xx = $('#txtProject').val();
        // alert(xx);
        // alert('a');
        document.getElementById('loader').hidden=false;
                var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                            tblAgent.ajax.reload(null,true); 
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }
            
     });
});

function fn_search_debtor(){
    // var a = $('#txt_search').val();
    // alert('a');
    document.getElementById('loader').hidden=false;
                var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                            tblAgent.ajax.reload(null,true);
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }
     
}
function fn_search2(){
    document.getElementById('loader').hidden=false;
                var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                            tblstaff.ajax.reload(null,true); 
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }
    // var a = $('#txt_search2').val();
    
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
function cbAll2(e){
    e = e || event; /* get IE event ( not passed ) */
    e.stopPropagation ? e.stopPropagation() : e.cancelBubble = true;

    var chkSelectAll = $('#cbHeader2');

    if (chkSelectAll.length && chkSelectAll.is(':checked') && !status) {
        SetCheckBox2(true);
    }
    else {
        SetCheckBox2(false);
    }
}

function SetCheckBox(val) {
    var rows = tblAgent.rows().indexes();
    for (var i = 0; i < rows.length ; i++) {
        var menuId = tblAgent.rows(i).data()[0].rowID;
        $('#tblAgent' + ' input[name=cb_' + menuId + ']').prop('checked', val);
    }
    $('#cbHeader').prop('checked', val);
}
function SetCheckBox2(val) {
    var rows = tblstaff.rows().indexes();
    for (var i = 0; i < rows.length ; i++) {
        var menuId = tblstaff.rows(i).data()[0].RowID;
        $('#tblstaff' + ' input[name=cb_' + menuId + ']').prop('checked', val);
    }
    $('#cbHeader2').prop('checked', val);
}


 function email(agent_cd,project,entity){
        // var agent_cd = agent_cd;
        
        var rows = tblAgent.rows('.selected').indexes();      

                               
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

                                    $('#modalTitle').html('Send Email');

                                    $('div.modal-body').html('Are you sure want to send email?');

                                    $('div.modal-body').append('<div class="modal-footer"></div>');

                                    var btnYes = $('<input/>')
                                        .attr({
                                            id: "btnYes",
                                            type: "button",
                                            class: "btn btn-danger",
                                            onclick: 'Approval(\''+agent_cd+'\',\''+project+'\',\''+entity+'\')',
                                            value: 'Yes'
                                        });

                                    var btnNo = $('<a>No</a>').attr({
                                        class: "btn btn-default", 'data-dismiss': "modal"
                                    });

                                    $('div.modal-footer').append(btnYes);
                                    $('div.modal-footer').append(btnNo);

                                    $('#modal').data('agent_cd', agent_cd).modal('show');
                                   

    }
     function email2(name,project,entity){
        var name = name;
        var rows = tblstaff.rows('.selected').indexes();      

                               
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

                                    $('#modalTitle').html('Send Email');

                                    $('div.modal-body').html('Are you sure want to send email?');

                                    $('div.modal-body').append('<div class="modal-footer"></div>');

                                    var btnYes = $('<input/>')
                                        .attr({
                                            id: "btnYes",
                                            type: "button",
                                            class: "btn btn-danger",
                                            onclick: 'Approval2(\''+name+'\',\''+project+'\',\''+entity+'\')',
                                            value: 'Yes'
                                        });

                                    var btnNo = $('<a>No</a>').attr({
                                        class: "btn btn-default", 'data-dismiss': "modal"
                                    });

                                    $('div.modal-footer').append(btnYes);
                                    $('div.modal-footer').append(btnNo);

                                    $('#modal').data('name', name).modal('show');
                                   

    }
    function Approval(agent_cd,project,entity){
    // swal(agent_cd);
    // return;
     document.getElementById('loader').hidden=false;
      $.ajax({
                    url : "<?php echo base_url('c_loginagent/Approval');?>",
                    type:"POST",
                    data: { agent_cd: agent_cd, project: project, entity: entity},
                    dataType:"json",
                    success:function(event, data){
                        document.getElementById('loader').hidden=true;
                        // console.log(event);
                        // console.log(data);
                        if(event.Status !='Fail'){                          
                          swal("Information",event.Pesan,"success");
                          $('#modal').modal('hide');
                          tblAgent.ajax.reload(null,true);
                        } else {
                            sweetAlert("Failed", event.Pesan, "error");
                            $('#modal').modal('hide');
                            
                          
                        
                        } 

                        tblAgent.ajax.reload(null,true);  
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                        document.getElementById('loader').hidden=true;
                     swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
                    }
                    });   
   }
   function Approval2(name,project,entity){
    // swal(name);
    // return;
    
     document.getElementById('loader').hidden=false;
      $.ajax({
                    url : "<?php echo base_url('c_loginagent/Approval2');?>",
                    type:"POST",
                    data: { name: name, project: project, entity: entity},
                    dataType:"json",
                    success:function(event, data){
                        document.getElementById('loader').hidden=true;
            
                        if(event.Status !='Fail'){                          
                          swal("Information",event.Pesan,"success");
                          $('#modal').modal('hide');
                          tblstaff.ajax.reload(null,true);
                        } else {
                            sweetAlert("Failed", event.Pesan, "error");
                            $('#modal').modal('hide');
                            
                          
                        
                        } 

                        tblstaff.ajax.reload(null,true);  
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                        document.getElementById('loader').hidden=true;
                     swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
                    }
                    });   
   }
   function proses(){
    // alert('aa');
    var ids = tblAgent.rows().indexes();
            var ACCESS_CODE = '';
            var selData = [];
            for(var i = 0; i < ids.length; i++)
            {
                var menuID = tblAgent.rows(i).data()[0].rowID;
                var agent_cd = tblAgent.rows(i).data()[0].agent_cd;
                var entity = tblAgent.rows(i).data()[0].entity_cd;
                var project = tblAgent.rows(i).data()[0].project_no;
                var chx = $('#tblAgent input[name=cb_'+menuID+']').prop('checked');

                ACCESS_CODE = '';
                if(chx) {
                    ACCESS_CODE = 1;
                }

                if(ACCESS_CODE != '')
                {
                    
                    var sysMenuGroup = new Object()
                    sysMenuGroup.agent_cd = agent_cd;
                     sysMenuGroup.entity = entity;
                    sysMenuGroup.project = project;
                    selData.push(sysMenuGroup);
                }
            }

            console.log(ids.length);
            $.ajax({
                url: '<?php echo base_url("c_loginagent/save");?>',
                data: {models: selData},
                method: 'post',
                dataType: 'json',
            })
            .done(function(msg){
                // console.log(msg);
                swal("Information",msg.Response,"success");
            })
            .fail(function(jqXHR, textStatus){                
                swal("Information",textStatus,"warning");
            });
   }
   function proses2(){
    // alert('aa');
    var ids = tblstaff.rows().indexes();
            var ACCESS_CODE = '';
            var selData = [];
            for(var i = 0; i < ids.length; i++)
            {
                var menuID = tblstaff.rows(i).data()[0].RowID;
                var name = tblstaff.rows(i).data()[0].name;
                var entity = tblstaff.rows(i).data()[0].entity_cd;
                var project = tblstaff.rows(i).data()[0].project_no;
                var chx = $('#tblstaff input[name=cb_'+menuID+']').prop('checked');

                ACCESS_CODE = '';
                if(chx) {
                    ACCESS_CODE = 1;
                }

                if(ACCESS_CODE != '')
                {
                    
                    var sysMenuGroup = new Object()
                    sysMenuGroup.name = name;
                     sysMenuGroup.entity = entity;
                    sysMenuGroup.project = project;
                    selData.push(sysMenuGroup);
                }
            }

            console.log(ids.length);
            $.ajax({
                url: '<?php echo base_url("c_loginagent/savestaff");?>',
                data: {models: selData},
                method: 'post',
                dataType: 'json',
            })
            .done(function(msg){
                // console.log(msg);
                swal("Information",msg.Response,"success");
            })
            .fail(function(jqXHR, textStatus){                
                swal("Information",textStatus,"warning");
            });
   }
</script>
<script type="text/javascript">
    $('#search_project').click(function(){
   // alert('a');
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblcount.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});
</script>

<div id="loader" class="loader" hidden="true"></div>

<div class="content-wrapper">
   <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-right">Login IFCA Cloud</div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div> <br>
         
   

    </div>
    <style type="text/css">
        .navii{
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;

        }
        .navii > li > a {
            position: relative;
            display: block;
            padding: 10px 15px;
        }
        .navii-tabs > li > a {
            margin-right: 2px;
            line-height: 1.42857143;
            border: 1px solid transparent;
            border-radius: 4px 4px 0 0;
        }
        .navii-tabs > li > a {
            color: #A7B1C2;
            font-weight: 600;
            padding: 10px 20px 10px 25px;
        }
        .navii > li {
            position: relative;
            display: block;
        }

        a {
            cursor: pointer;
            text-decoration: none;
        }
        ul.navii li > a:hover{
            color:#676a6c;
        }
        li.active > a {
            color:#676a6c;
        }

        .tabs-container .navii-tabs > li {
            float: left;
            margin-bottom: -1px;
        }
        .navii.navii-tabs li {
            background: none;
            border: none;
        }
        .btn-group-vertical > .btn-group::after, .btn-toolbar::after, .clearfix::after, .container-fluid::after, .container::after, .dl-horizontal dd::after, .form-horizontal .form-group::after, .modal-footer::after, .modal-header::after, .navii::after, .navbar-collapse::after, .navbar-header::after, .navbar::after, .pager::after, .panel-body::after, .row::after {
    clear: both;
}
.btn-group-vertical > .btn-group::after, .btn-group-vertical > .btn-group::before, .btn-toolbar::after, .btn-toolbar::before, .clearfix::after, .clearfix::before, .container-fluid::after, .container-fluid::before, .container::after, .container::before, .dl-horizontal dd::after, .dl-horizontal dd::before, .form-horizontal .form-group::after, .form-horizontal .form-group::before, .modal-footer::after, .modal-footer::before, .modal-header::after, .modal-header::before, .navii::after, .navii::before, .navbar-collapse::after, .navbar-collapse::before, .navbar-header::after, .navbar-header::before, .navbar::after, .navbar::before, .pager::after, .pager::before, .panel-body::after, .panel-body::before, .row::after, .row::before {
    display: table;
    content: " ";
}
.tabs-container .navii-tabs > li.active > a,
.tabs-container .navii-tabs > li.active > a:hover,
.tabs-container .navii-tabs > li.active > a:focus {
  border: 1px solid #e7eaec;
  border-bottom-color: transparent;
  background-color: #fff;
}




    </style>
    <div id="load" hidden="true"></div>
    <div class="wrapper wrapper-content" >
        <div class="row">
        <div class="tabs-container">
                        <ul class="navii navii-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1"> Staff</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2"> Agent</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

                                    <div class="col-xs-12">
                                        <div class="ibox-content">
                                            <div class="table-responsive">                       
                                                <div class="box-body">
                                                <button id="proses2" class="btn biru-bg" onclick="proses2()"><i class="fa fa-envelope fa-fw"></i> <span class="hidden-xs">Process</span></button>
                                                    <table id="tblstaff" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                        <thead>    
                                                            <th>No.</th> 
                                                            <th>Action</th>   
                                                            <th>Staff Account</th>
                                                            <th>Name</th>                                        
                                                            <th>Handphone</th>                                
                                                            <th>Email</th>
                                                           <th><input type="checkbox" id="cbHeader2" onclick='cbAll2(event)'/></th>             
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end of div col12-->

                                </div><!-- end of panel body-->
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                         <!--         <div class="form-group">
                                        <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Project</label>
                                        <div class="col-sm-3">
                                            <select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="select2" style="width:250px;" tabindex="2">
                                                <option value=""></option>
                                                <?php echo $cbProject;?>   
                                                
                                            </select>
                                            
                                        </div>

                                        <div class="col-sm-6 control-label" style="margin-left: 40px">
                                            <button id="search_project" name="search_project" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
                                            
                                        </div>
                                    </div> -->
                                    <br>
                                    <div class="col-xs-12">
                                        <div class="ibox-content">
                                            <div class="table-responsive">                       
                                                <div class="box-body">
                                                <button id="proses2" class="btn biru-bg" onclick="proses()"><i class="fa fa-envelope fa-fw"></i> <span class="hidden-xs">Process</span></button>
                                                    <table id="tblAgent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                        <thead>    
                                                            <th>No.</th> 
                                                            <th>Action</th>   
                                                            <th>Agent Code</th>
                                                            <th>Name</th>                                        
                                                            <th>Handphone</th>                                
                                                            <th>Email</th>
                                                           <th><input type="checkbox" id="cbHeader" onclick='cbAll(event)'/></th>             
                                                        </thead>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end of div col12-->

                                </div>
                            </div>
                        </div>

        </div>
    </div>
</div>

