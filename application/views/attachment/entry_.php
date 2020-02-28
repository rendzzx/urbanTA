<!-- <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" type="text/css" /> -->
<!-- <link rel="stylesheet" href="<?php echo base_url('plugins/jQueryUI/jquery-ui-1.8.9.css')?>" type="text/css"> -->
<!-- <link rel="stylesheet" href="<?php echo base_url('plugins/plupload/js/jquery.ui.plupload/css/jquery.ui.plupload.css');?>" type="text/css" /> -->
<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script> -->
<link href="<?=base_url('DataTable/media/css/dataTables.bootstrap.min.css');?>" rel="stylesheet" type="text/css" >
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" /> 
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<style type="text/css">
    .btn-std{
        width:80px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h3><?php echo $prj?></h3>
        <!-- </form> -->
    </section>
    <form enctype="multipart/form-data" method="post" action="<?php echo base_url('attachment/saveLogo')?>">
    <section class="content" >
        <div class="col-sm-12 box">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="checkbox-inline"></label><br>
                    <label for="logo" class="control-label">Logo :</label> 
                    <div id="logo" class="image" >
                        <img class="img-responsive" src="<?php echo(empty($logo) ? base_url('img/PlProject/default.png'): base_url('img/PlProject/'.$logo) );?>" width="120px" id="picturebox">
                    </div>
                    <br>
                    <input type="file" id="picture" name="picture" accept="image/*"> <p>(* Only Jpeg, Jpg, Png allowed)</p>
                    <input type="hidden" id="picturepath" value=".file path" readonly="1">
                </div>
                <input type="hidden" name="project" id="project" value="<?php echo $project?>">
            <input type="submit" value="Save"  class="btn-std"/><br><br>
            </div>
            <div class="col-sm-6">
                <label class="checkbox-inline"></label><br>
                <label class="control-label">Assign Menu</label><br>
                <?php if ($nup_menu==1){ ?>
                    <label class="checkbox-inline"><input type="checkbox" value="1" name="nup" id="nup" checked>NUP Menu</label><br>
                <?php }else{ ?> 
                    <label class="checkbox-inline"><input type="checkbox" value="1" name="nup" id="nup">NUP Menu</label><br>
                <?php } ?>
                <?php if ($booking_menu==1){ ?>
                    <label class="checkbox-inline"><input type="checkbox" value="1" name="booking" id="booking" checked>Booking Menu</label>
                <?php }else{ ?>
                    <label class="checkbox-inline"><input type="checkbox" value="1" name="booking" id="booking">Booking Menu</label>
                <?php } ?>    
            </div>
            <div class="col-sm-12">
                <table id="tblattach" class="display table-striped table-bordered" cellspacing="0" style="width:100%;">
                    <thead>            
                        <th >No</th>
                        <th width="50%">Filename</th>
                        <th width="40%">Action</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    </form>
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
<!--
<script src="<?php echo base_url('plugins/jQueryUI/jquery-1.9.0.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('plugins/jQueryUI/jquery-ui-1.10.2.min.js')?>" type="text/javascript"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url('plugins/plupload/js/plupload.full.min.js')?>"></script> -->
<!-- <script type="text/javascript" src="<?php echo base_url('plugins/plupload/js/jquery.ui.plupload/jquery.ui.plupload.js')?>"></script> -->
<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
var table;
$(function() {
    $("#picture").on('change', function() {
        $("#picturepath").val(this.files[0].name);
        readURL(this);
    });

    function readURL(input) {
        if(input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#picturebox").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    table = $('#tblattach').DataTable({
        dom: 'Bfrtip',
        select: true,
        info: false,
        lengthChange: false,
        ordering: false,
        searching: false,
        processing: true,
        serverSide: true,
        ajax: {
            url:"<?php echo base_url('attachment/getTable')?>",
            data:{"project":function(d){
                var a = $('#project').val();
                var b = '';
                if(a == null){
                    return b;
                }{
                    return $('#project').val();
                }
            } },
            type:"POST"
        },
        buttons:[
            {
                text: ' Add File Pictures',
                className: 'fa fa-plus',
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
                    $('#modalTitle').html('Add File');
                    $('div.modal-body').load("<?php echo base_url('attachment/addNew');?>"+"/"+$('#project').val());
                    $('#modal').modal('show');
                }
            },
            {
                text: ' Delete',
                className: 'fa fa-trash',
                action: function() {
                    var rows = table.rows('.selected').indexes();
                    if (rows.length < 1) {
                        alert('Please select a row');
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
            {data: "row_number", name: "row_number"},
            {data: "file_name", name: "file_name"},
            {data: "rowID", name: "rowID", visible: false}
        ]
    });
});

function Delete()
{
    var id = $('#modal').data('rowID');
    $.ajax({
        url: "<?php echo base_url('attachment/remove')?>",
        type: "post",
        data: {id: id},
        dataType: "json",
        success: function(data, status){
            alert(data.Pesan);
            $('#modal').modal('hide');
            table.ajax.reload(null, true);
        },
        error: function(jqXHR, txtStatus, errorThrown){
            alert(txtStatus+' delete : '+errorThrown);
        }
    });
    // $('[data-rowID='+id+']').remove();
    // $('#modal').modal('hide');
    // table.ajax.reload(null, false);
}
</script>
