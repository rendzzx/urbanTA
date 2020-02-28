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
    background:url("<?php base_url('/img/loading.gif') ?>") no-repeat center center  
}
/*div.dataTables_wrapper 
div.dataTables_filter {
    text-align: right;
    float: right;
    padding-bottom: 5px;
}*/
</style>
<script type="text/javascript">

var tbldownload;
$(function(){
   tbldownload = $('#tbldownload').DataTable( 
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

                        $('#modalTitle').html('Add Menu');
                        $('div.modal-body').load("<?php echo base_url("c_download/add");?>");
                        $('#modal').data('id', 0).modal('show');
                        // $('#modal').data('action', "add");
                    }
                },
                {
                    text: ' Edit', className: 'biru-bg fa fa-pencil',
                    action: function () {                       
                        var rows = tbldownload.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }              

                        var data = tbldownload.rows(rows).data();
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

                        $('#modalTitle').html('Edit Menu');
                        

                        $('div.modal-body').load("<?php echo base_url("c_download/add");?>");

                        $('#modal').data('id', id);
                        $('#modal').modal('show');
                        // $('#modal').data('action', "edit");
                        

                    }
                },
                {
                    text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                    action: function () {
                        
                        var rows = tbldownload.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tbldownload.rows(rows).data();
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

                        $('#modal').data('id', id).modal('show');

                    }
                }                    
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_download/getTable');?>",
            "data":{"sSearch": function(d){
                var search = $('#txt_search').val();
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
            {data:"descs",name:"descs"},
            {data:"url",name:"url"},
        ]
    });
    // $("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search()" style=" width: auto;"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_search").keyup(function(event){

        var a = $('#txt_search').val();
        
            if(a==''){
                tbldownload.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tbldownload.ajax.reload(null,true);   
        }
    });

});

function fn_search(){
    // alert('a');
    
    // var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){
    document.getElementById('loader').hidden=false;
                var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                            tbldownload.ajax.reload(null,true); 
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }        
         
    }
}

function Delete() {
    var id = $('#modal').data('id');
    $.ajax({
        url : "<?php echo base_url('c_download/Delete');?>",
        type:"POST",
        data: { id: id },
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"warning");
                $('#modal').modal('hide');
                tbldownload.ajax.reload(null,true); 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");

        }
    });
}

</script>
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-right">Project Overview</div>
        </div>
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tbldownload" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <!-- display table-striped table-condensed -->
                            <thead>            
                                <th class="sorting_asc">No</th>
                                <th>Descs</th>
                                <th>Url</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
    </div>    
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