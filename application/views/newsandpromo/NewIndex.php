
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
   left: 9%;
    top: 1%;
   z-index: 99999;
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
var project;
var tblattachment;
var tblnewsfeed;
$(function(){
$('#txt_Pl_Project').on("change",function(e){
   var project = $('#txt_Pl_Project').val();
    tblattachment.ajax.reload(null,true);
    tblnewsfeed.ajax.reload(null,true); 

});

$('#txt_Pl_Project').select2();

   tblnewsfeed = $('#tblnewsfeed').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
         // dom: '<"html5buttons"B>lTfgitp',
            // responsive: true,
            responsive: {
                    details: {
                        type: 'column',
                        target: 6
                    }
                },
            select: true,
// "bLengthChange": false,
            filter: false,
            footer: false,
         // footerOffset: $('#tblnewsfeed_info').addClass('fa fa-pencil')
         //    },
            buttons: [
                
                {
                    text: ' Add', className: 'btn biru-bg fa fa-plus btn-sm enable', action: function (e) {
                        var project = $('#txt_Pl_Project').val();
                         if (project.length < 1) {
                            swal("Information",'Please select a Project',"warning");
                            return;
                        }
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

                        $('#modalTitle').html('Add Project Info');
                        $('div.modal-body').load("<?php echo base_url("c_newsfeed/addnew");?>"+"/"+$('#txt_Pl_Project').val());
                        $('#modal').data('id', 0).modal('show');


                    }
                }, 
                {
                    text: ' Edit', className: 'btn biru-bg fa fa-pencil btn-sm',
                    action: function () {
                        var project = $('#txt_Pl_Project').val();
                         if (project.length < 1) {
                            swal("Information",'Please select a Project',"warning");
                            return;
                        }
                        var rows = tblnewsfeed.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblnewsfeed.rows(rows).data();
                        var UserID = data[0].id;
                        

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

                        $('#modalTitle').html('Add Project Info');

                        $('div.modal-body').load("<?php echo base_url("c_newsfeed/addnew");?>"+"/"+$('#txt_Pl_Project').val());

                        $('#modal').data('id', UserID).modal('show');

                    }
                },
                {
                    text: ' Delete', className: 'btn btn biru-bg fa fa-trash btn-sm',
                    action: function () {
                        var project = $('#txt_Pl_Project').val();
                         if (project.length < 1) {
                            swal("Information",'Please select a Project',"warning");
                            return;
                        }
                        var rows = tblnewsfeed.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblnewsfeed.rows(rows).data();
                        var UserID = data[0].id;
                        


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

                        $('#modalTitle').html('Delete Project Info');

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

                        $('#modal').data('id', UserID).modal('show');

                    }
                },

                // {
                //     text: ' Project Logo', className: 'btn biru-bg fa fa-file btn-sm', action: function (e) {
                //         var project = $('#txt_Pl_Project').val();
                //          if (project.length < 1) {
                //             swal("Information",'Please select a Project',"warning");
                //             return;
                //         }
                //         window.location.href="<?php echo base_url('attachment/prj');?>"+'/'+project;
                //     }
                // },

                {
                extend: 'collection',
                className: 'btn biru-bg fa fa-star btn-sm',
                text: ' Action',
                buttons: [
                    // 'copy',
                    'excel',
                    'csv',
                    'pdf',
                    // 'print'
                            ]           
            }
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_newsfeed/getTable');?>",
             "data":{"pl_project": function(d){
                
                var a = $('#txt_Pl_Project').val();
                var b ="";
                if(a == null){
                    return b;
                }{
                    return $('#txt_Pl_Project').val();
                }
                
             },"sSearch": function(d){
                var search = $('#txt_search').val();
                var b="";
                if(search == null || search==""){
                    return b;
                }{
                    return search;
                }
             }},
             // "data":function(d){
             //    return $('#txt_Pl_Project').val();
             // },
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number",searchable:false } ,
            {data:"subject",name:"subject"},
            {
                data:"date_created",name:"date_created",
                render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               // alert(data);
                               // var aa=date.getDate() + "/" + (month.length > 1 ? month : "0" + month) + "/" + date.getFullYear();
                               var aa = day+"/"+month+"/"+year;
                                return aa;
                               
                               
                               

                           }
            },
            {data:"content",name:"content",
                render: function ( data, type, row ) {
                return data.length > 20 ?
                data.substr( 0, 50 ) +'…' :
        data;
}
            },
            {data:"youtube_link",name:"youtube_link"},
            {
                data:"status",name:"status",sortable: false, searchable:false,
                render:function (data,type,row) {
                    if(data==1){
                        return 'Information';
                    }else{
                        return 'Warning';
                    }
                    
                }
            },
            {data:"columdef",name:"columdef"}
            
            ],
            "columnDefs": [ {
                    className: 'control',
                    orderable: false,
                    targets:   6
                } ]
    });

tblattachment = $('#tblattachment').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
         // dom: '<"html5buttons"B>lTfgitp',
            // responsive: true,
            responsive: {
                    details: {
                        type: 'column',
                        target: 3
                    }
                },
            select: true,
            filter:false,
         //    fixedHeader: {
                footer: false,
         // footerOffset: $('#tblnewsfeed_info').addClass('fa fa-pencil')
         //    },
            buttons: [
                {
                    text: ' Add', className: 'btn biru-bg fa fa-plus btn-sm enable', action: function (e) {
                        var project = $('#txt_Pl_Project').val();
                         if (project.length < 1) {
                            swal("Information",'Please select a Project',"warning");
                            return;
                        }
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

                        $('#modalTitle').html('Add Attachment');
                        $('div.modal-body').load("<?php echo base_url("c_newsfeed/addpdf");?>"+"/"+$('#txt_Pl_Project').val());
                        $('#modal').data('id', 0).modal('show');


                    }
                },

                {
                    text: ' Edit', className: 'btn biru-bg fa fa-pencil btn-sm',
                    action: function () {
                        var project = $('#txt_Pl_Project').val();
                         if (project.length < 1) {
                            swal("Information",'Please select a Project',"warning");
                            return;
                        }
                        var rows = tblattachment.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblattachment.rows(rows).data();
                        var UserID = data[0].id;
                        

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

                        $('#modalTitle').html('Edit Attachment');

                        $('div.modal-body').load("<?php echo base_url("c_newsfeed/addpdf");?>"+"/"+$('#txt_Pl_Project').val());

                        $('#modal').data('id', UserID).modal('show');

                    }
                },
                {
                    text: ' Delete', className: 'btn biru-bg fa fa-trash btn-sm',
                    action: function () {
                        var project = $('#txt_Pl_Project').val();
                         if (project.length < 1) {
                            swal("Information",'Please select a Project',"warning");
                            return;
                        }
                        var rows = tblattachment.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblattachment.rows(rows).data();
                        var UserID = data[0].id;
                        


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

                        $('#modalTitle').html('Delete Attachment');

                        $('div.modal-body').html('Are you sure that you want to delete this item?');

                        $('div.modal-body').append('<div class="modal-footer"></div>');

                        var btnYes = $('<input/>')
                            .attr({
                                id: "btnYes",
                                type: "button",
                                class: "btn btn-danger",
                                onclick: 'DeleteAttach();',
                                value: 'Yes'
                            });

                        var btnNo = $('<a>No</a>').attr({
                            class: "btn btn-default", 'data-dismiss': "modal"
                        });

                        $('div.modal-footer').append(btnYes);
                        $('div.modal-footer').append(btnNo);

                        $('#modal').data('id', UserID).modal('show');

                    }
                }
                
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_newsfeed/getTableAttachment');?>",
             "data":{"pl_project": function(d){
                
                var a = $('#txt_Pl_Project').val();
                var b ="";
                if(a == null){
                    return b;
                }{
                    return $('#txt_Pl_Project').val();
                }
                
             },"sSearch": function(d){
                var search = $('#txt_search').val();
                var b="";
                if(search == null || search==""){
                    return b;
                }{
                    return search;
                }
             }},
             // "data":function(d){
             //    return $('#txt_Pl_Project').val();
             // },
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number",searchable:false } ,
            {data:"descs",name:"descs"},
            {data:"file_name",name:"file_name"},
            {data:"columdef",name:"columdef"}
            ],
            "columnDefs": [ {
                    className: 'control',
                    orderable: false,
                    targets:   3
                } ]
    });
    
    


$("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search();" style=" width: auto"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblnewsfeed.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblnewsfeed.ajax.reload(null,true);   
        }
    });

});
function fn_search(){
    // alert('a');
    var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(project!='' && txt_search!=''){
        document.getElementById('loader').hidden=false;
                var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                            tblnewsfeed.ajax.reload(null,true); 
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }
         
    }
    
    
}
function DeleteAttach() {

        var id = $('#modal').data('id');

         $.ajax({
                    url : "<?php echo base_url('c_newsfeed/DeleteAttach');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: { id: id },
                    dataType:"json",
                    success:function(event, data){
                        if(event.status=='OK'){
                            swal({
                                title: "Information",
                                animation: false,
                                type:"success",
                                text: event.Pesan,
                                confirmButtonText: "OK"
                              });
                            $('#modal').modal('hide');
                            tblattachment.ajax.reload(null,true);
                        } else {
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
                      // delete_gagal();
                     swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: textStatus+' Save : '+errorThrown,
                            confirmButtonText: "OK"
                          });
                     
                    }
                    });
        // $('[data-id=' + id + ']').remove();

        // $('#modal').modal('hide');

        // tblnewsfeed.ajax.reload(null, false);

    }
function Delete() {

        var id = $('#modal').data('id');

         $.ajax({
                    url : "<?php echo base_url('c_newsfeed/Delete');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: { id: id },
                    dataType:"json",
                    success:function(event, data){
                        if(event.status=='OK'){
                            swal({
                                title: "Information",
                                animation: false,
                                type:"success",
                                text: event.Pesan,
                                confirmButtonText: "OK"
                              });
                            $('#modal').modal('hide');
                            tblnewsfeed.ajax.reload(null,true);
                        } else {
                            swal({
                                title: "Error",
                                animation: false,
                                type:"error",
                                text: event.Pesan,
                                confirmButtonText: "OK"
                              });
                        //     BootstrapDialog.show({
                        //     type: BootstrapDialog.TYPE_DANGER,
                        //     title: 'Error',
                        //     message: event.Pesan,
                        //     buttons: [{
                        //         label: 'OK',
                        //         action: function(dialogItself){
                        //         dialogItself.close();
                        //         }
                        //     }]
                        // });
                        }  
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                       swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: textStatus+' Save : '+errorThrown,
                            confirmButtonText: "OK"
                          });
                     // BootstrapDialog.alert();
                     
                    }
                    });
        // $('[data-id=' + id + ']').remove();

        // $('#modal').modal('hide');

        // tblnewsfeed.ajax.reload(null, false);

    }
    function projectlogo(){
           // $('#projectlogo').click(function(){
           
            // alert(date_start+', '+date_end);
            // alert('tes');

                var project = $('#txt_Pl_Project').val();
                // alert(project);
                 if (project.length < 1) {
                swal("Information",'Please select a Project',"warning");
                return;
            }
            window.location.href = "<?php echo base_url('attachment/prj');?>"+'/'+project;

            // document.getElementById('loader').hidden=false;
               
            
        // });
    }
 
</script>
<div id="loader" class="loader" hidden="true"></div>

<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <!-- <div class="tittle-top pull-left"><?php echo $entityname;?></div> -->
        <div class="judulprojek"><?php echo $entityname;?></div>
        <div class="tittle-top pull-right">Project Parameter</div>
    </div><br>
        <div class="form-group">
            <label for="pl_project" class="col-sm-1 control-label" style="padding-left:0px;">Project</label>
            <div class="col-sm-3">
                <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;" tabindex="2">
                              <option value=""></option> 
                              <?php 
                                  foreach ($project as $row) 
                                  {
                                      echo '<option value="'.$row->project_no.'">'.$row->descs.'</option>';
                                  }
                              ?>            
                            </select>
            </div>
            <div class="col-sm-7">
                <button id="projectlogo" class="btn biru-bg btn-sm" onclick="projectlogo()"><i class="fa fa-file"></i>  Project Logo</button>
            
            </div>
            <br>
        </div>
    </section>
    <section class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <b>&nbsp; Project Info</b>
                            <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                            
                                <thead>            
                                    <th style="width:15px !important;">No</th>
                                    <th>Subject</th>
                                    <th>Date Created</th>
                                    <th>Content</th>
                                    <th>Youtube Link</th>
                                    <th>Status</th>
                                    <th></th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div> 
         </div>
         <br>

         <div class="row">
            
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                    <b>&nbsp; Project Attachment</b>
                    <br>
                        
                            <table id="tblattachment" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                            
                                <thead>            
                                    <th style="width:15px !important;">No</th>
                                    <th>Description</th>
                                    <th>File Name</th>
                                    <th></th>                            
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div> 
        </div>
            
       
        <!-- <table id="tblnewsfeed" class="display table-striped table-bordered table-condensed" cellspacing="0" style="width:100%"> -->
        
    </section>
</div>
<!-- <script src="<?=base_url('choosen/jquery.min.js')?>" type="text/javascript"></script> -->





<!-- Bootstrap Modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>