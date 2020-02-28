<link href="<?=base_url('datatable/media/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" >
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<!-- <link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" /> -->
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.css')?>" rel="stylesheet" />

<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.js')?>" type="text/javascript"></script>

<!--
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script> 
 -->

<script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script>


<style type="text/css">
    .btn-std{width:80px;}
</style>
<div class="content-wrapper">
    <section class="content-header">
    <div class="form-group">        
        <div class="tittle-top pull-left"><b><?php echo $entityname; ?></b></div>
        <div class="tittle-top pull-right"><b>Launch Invitation Parameter</b></div>
    </div>
    </section>
    <!-- <form enctype="multipart/form-data" method="post" action="<?php echo base_url('c_nup_loc/save')?>"> -->
    <section class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="tblnuploc" class="display table-striped" cellspacing="0" style="width:100%;">
                            <thead>            
                                <th class="sorting_asc">No</th>
                                <th>Project</th>
                                <th>Location</th>
                                <th>Filename</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- </form> -->
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
 
<script type="text/javascript">
var table;
// var config = {
//         '.chosen-select'           : {},
//         '.chosen-select-deselect'  : {allow_single_deselect:true},
//         '.chosen-select-no-single' : {disable_search_threshold:10},
//         '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
//         '.chosen-select-width'     : {width:"90%"}
//       }
//       for (var selector in config) {
//         $(selector).chosen(config[selector]);
//       }
$(function() {
    // $("#picture").on('change', function() {
    //     $("#picturepath").val(this.files[0].name);
    //     readURL(this);
    // });
    // function readURL(input) {
    //     if(input.files && input.files[0])
    //     {
    //         var reader = new FileReader();
    //         reader.onload = function(e) {
    //             $("#picturebox").attr('src', e.target.result);
    //         }
    //         reader.readAsDataURL(input.files[0]);
    //     }
    // }

    table = $('#tblnuploc').DataTable({
        dom: '<"toolbar dataTables_filter">Bfrtip',
        select: true,
        info: false,
        lengthChange: false,
        ordering: true,
        // searching: true,
        processing: false,
        serverSide: true,
        responsive: true,
        filter: false,
        ajax: {
            url:"<?php echo base_url('c_nup_loc/getTable')?>",
            data:{"project":function(d){
                var a = $('#project').val();
                var b = '';
                if(a == null){
                    return b;
                }{
                    return $('#project').val();
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
            type:"POST"
        },
        buttons:[
            {
                text: ' New',
                className: 'bg-orange fa fa-plus',
                action: function(e){
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
                    $('#modalTitle').html('<b>New Invitation</b>');
                    $('div.modal-body').load("<?php echo base_url('c_nup_loc/insert');?>");
                    $('#modal').data('id', 0).modal('show');
                }
            },
            {
                text: ' Edit',
                className: 'bg-orange fa fa-pencil'
                ,
                action: function () {
                    var rows = table.rows('.selected').indexes();
                    if (rows.length < 1) {
                        BootstrapDialog.alert('Please select a row');
                        return;
                    }
                    var data = table.rows(rows).data();
                    var rowID = data[0].rowID;
                    // var UserID = data[0].id;

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

                    $('#modalTitle').html('<b>Edit Invitation</b>');
                    $('div.modal-body').load("<?php echo base_url("c_nup_loc/edit");?>"+"/"+rowID);
                    $('#modal').data('id', rowID).modal('show');
                }
            },
            {
                text: ' Delete',
                className: 'bg-orange fa fa-trash',
                action: function() {
                    var rows = table.rows('.selected').indexes();
                    if (rows.length < 1) {
                        BootstrapDialog.alert('Please select a row');
                        return;
                    }
                    var data = table.rows(rows).data();
                    var rowID = data[0].rowID;
                    // alert(rowID);
                    console.log(data);
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
                    $('#modalTitle').html('Delete File');
                    $('div.modal-body').html('Are you sure that you want to delete this file?');
                    // $('div.modal-body').load("<?php echo base_url('attachment/addNew');?>"+"/"+$('#project').val());
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

                    $('#modal').data('rowID', rowID).modal('show');
                }
            }
        ],
        columns:[
            {data: "row_number", name: "row_number", searchable:false},
            {data: "prjname", name: "prjname"},
            {data: "location", name: "location"},
            {data: "invitation_path", name: "invitation_path"},
            {data: "rowID", name: "rowID", visible: false}
        ]
    });
    $("div.toolbar").html('<b>Search : <input type="text" style="width: 150px;" id="txt_search" name="txt_search" > <a class="btn btn-primary btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a> </b>');
    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        // var project = $('#txt_Pl_Project').val();

        // if(project != ''){
            if(a==''){
                table.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            table.ajax.reload(null,true);   
        }
        // }
    });
});

function fn_search(){
    // var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){
        
        table.ajax.reload(null,true); 
    }
}

function Delete()
{
    var id = $('#modal').data('rowID');
    $.ajax({
        url: "<?php echo base_url('c_nup_loc/remove')?>",
        type: "post",
        data: {rid: id},
        dataType: "json",
        success: function(data, status){
            BootstrapDialog.alert(data.Pesan);
            $('#modal').modal('hide');
            table.ajax.reload(null, true);
        },
        error: function(jqXHR, txtStatus, errorThrown){
            BootstrapDialog.alert(txtStatus+' delete : '+errorThrown);
        }
    });
    // $('[data-rowID='+id+']').remove();
    // $('#modal').modal('hide');
    // table.ajax.reload(null, false);
}
</script>
