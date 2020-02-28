

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

var tblGLcolumn;
$(function(){
   tblGLcolumn = $('#tblGLcolumn').DataTable( 
    {
            dom: '<"toolbar dataTables_filter">Bfrtip',
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

                        $('#modalTitle').html('Add Column Format');
                        $('div.modal-body').load("<?php echo base_url("c_gl_column/edit");?>");
                        $('#modal').data('MenuID', 0).modal('show');
                    }
                },
                {
                    text: ' Edit', className: 'biru-bg fa fa-pencil',
                    action: function () {                       
                        var rows = tblGLcolumn.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }              

                        var data = tblGLcolumn.rows(rows).data();
                        var MenuID = data[0].field_id;
                        // alert(MenuID);


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

                        $('#modalTitle').html('Edit Column Format');
                        

                        $('div.modal-body').load("<?php echo base_url("c_gl_column/edit");?>");

                        $('#modal').data('MenuID', MenuID);

                        $('#modal').modal('show');

                    }
                },
                {
                    text: ' Delete', className: 'biru-bg fa fa-trash',
                    action: function () {
                        
                        var rows = tblGLcolumn.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblGLcolumn.rows(rows).data();
                        var MenuID = data[0].field_id;
                        


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

                        $('#modalTitle').html('Delete Newsfeed');

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

                        $('#modal').data('MenuID', MenuID).modal('show');

                    }
                },   
                {
                    text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       // alert('wk');
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 tblGLcolumn.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }

                    }
                }
                
            ],
        "serverSide": true,
        "ajax":{
                    "url":"<?php echo base_url('c_gl_column/getTable');?>",  
                    "data":{"sSearch": function(d){
                        var a = $('#txt_search').val();
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
        // ini ada button submit
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"field_id",name:"field_id"},            
            {data:"header1",name:"header1"},
            {data:"header2",name:"header2"},
            {data:"amt_type_descs",name:"amt_type_descs"},
            // {
            //     data:"reserve_date",name:"reserve_date",
            //     render: function (data, type, row) {

            //                     var date = new Date(parseInt(data.substr(0,10)));
            //                     var year =data.substr(0,4);
            //                     var month=data.substr(5,2);
            //                     var day =data.substr(8,2);
                               
            //                    // BootstrapDialog.alert(data);
            //                    // var aa=date.getDate() + "/" + (month.length > 1 ? month : "0" + month) + "/" + date.getFullYear();
            //                    var aa = day+"/"+month+"/"+year;
            //                     return aa;
                               
                               

            //                }
            // },    
            {data:"formula",name:"formula"}//,            
            // {data:"descs",name:"descs"}
            ]
    });
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblGLcolumn.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblGLcolumn.ajax.reload(null,true);   
        }
    });

});

function fn_search(){
    // var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){
        
        tblGLcolumn.ajax.reload(null,true); 
    }
}

function Delete() {
    var MenuID = $('#modal').data('MenuID');
    // alert(MenuID);
    $.ajax({
        url : "<?php echo base_url('c_gl_column/Delete');?>",
        type:"POST",
        data: { MenuID: MenuID },
        dataType:"json",
        success:function(event, data){
                if(event.status=='OK') {
                    swal("Information",event.Pesan,"success");
                    $('#modal').modal('hide');
                    tblGLcolumn.ajax.reload(null,true);
                }else {
                    swal("Information",event.Pesan,"error");
                }
                 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                
                swal("Information",textStatus+' Save : '+errorThrown,"warning");

        }
    });
}
</script>
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
        <div class="form-group">        
            <!-- <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div> -->
            <div class="tittle-top pull-right">GL Customised Column Format</div>
        </div>
    </section> 
    <section class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblGLcolumn" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                            
                            <thead>
                                <th>No.</th>                                     
                                <th>Column Id</th>                                
                                <th>Header 1</th>
                                <th>Header 2</th>
                                <th>Amount Type</th>
                                <th>Formula</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>            
        </div>
    </section>
</div>




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