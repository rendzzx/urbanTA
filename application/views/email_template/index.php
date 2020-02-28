<!DOCTYPE html>
<html>
<head>
	<title>Email Template</title>
	<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
	<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
</head>
<body>

	<div class="content-wrapper">
	    <div class="row border-bottom white-bg dashboard-header">  
	        <div class="form-group">
	            <div class="tittle-top pull-right">Email Template</div>
	        </div>
	    </div>
	    <div class="wrapper wrapper-content" >
	        <div class="row">
	            <div class="col-xs-12">
	                <div class="ibox-content">
	                    <div class="table-responsive">
	                        <table id="tblemail" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
	                            <thead>            
	                                <th class="sorting_asc">No</th>
                                    <th>Title</th>
                                    <th>Body</th>
	                                <th>Template</th>
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

</body>
</html>

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<script type="text/javascript">

var tblemail;
$(function(){
   tblemail = $('#tblemail').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter: false,
            buttons: [
                {
                    text: ' Add', className: 'btn biru-bg fa fa-plus', 
                    action: function (e)
                    {
                        var site_url = '<?php echo base_url("c_email_template/addnew/")?>'+0;
                        window.location.href = site_url;
                    }
                },
                {
                    text: ' Edit', className: 'biru-bg fa fa-pencil',
                    action: function () {                       
                        var rows = tblemail.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }              

                        var data = tblemail.rows(rows).data();
                        var id = data[0].Body_Id;

                        var site_url = '<?php echo base_url("c_email_template/addnew/")?>'+id;
                        window.location.href = site_url;
                    }
                },
                {
                    text: ' Delete', className: 'biru-bg fa fa-trash', enabled: true,
                    action: function () {
                        
                        var rows = tblemail.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblemail.rows(rows).data();
                        var id = data[0].Body_Id;
                        


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

                        $('#modalTitle').html('Delete Email Body');

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
                },
                {
                    text: ' Use Email Body For', className: 'biru-bg fa fa-pencil',
                    action: function () {                       
                        var rows = tblemail.rows('.selected').indexes();
                            if (rows.length < 1) {
                                swal("Information",'Please select a row',"warning");
                                return;
                            }              

                            var data = tblemail.rows(rows).data();
                            var body = data[0].Body_Id;

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

                            $('#modalTitle').html('Use Email Body');
                            

                            $('div.modal-body').load("<?php echo base_url("c_email_template/openuse");?>");

                            $('#modal').data('body', body);
                            $('#modal').modal('show');
                    }
                },               
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_email_template/getTable');?>",
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
            {data:"row_number",name:"row_number", searchable:false,width:10},
            {data:"Tittle",name:"Tittle", sortable: false},
            {data:"body",name:"body", sortable: false},
            {data:"Template_Id",name:"Template_Id",
                render: function (data, type, row) {
                    var Template_id = row.Template_Id;
                    var image1 = '<?=base_url('img/email_template/E01.png')?>';
                    var image2 = '<?=base_url('img/email_template/E02.png')?>';
                    var image3 = '<?=base_url('img/email_template/E03.png')?>';
                    if (Template_id==1){
                        return '<img src="'+image1+'" width=100px>';
                    }
                    if (Template_id==2){
                        return '<img src="'+image2+'" width=100px>';
                    }
                    if (Template_id==3){
                        return '<img src="'+image3+'" width=100px>';
                    }
                }
            }
        ]
    });
    // $("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search()" style=" width: auto;"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_search").keyup(function(event){

        var a = $('#txt_search').val();
        
            if(a==''){
                tblemail.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblemail.ajax.reload(null,true);   
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
                            tblemail.ajax.reload(null,true); 
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }        
         
    }
}

function Delete() {
    var id = $('#modal').data('id');
    // alert(MenuID);
    $.ajax({
        url : "<?php echo base_url('c_email_template/Delete');?>",
        type:"POST",
        data: { id: id },
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"warning");
                $('#modal').modal('hide');
                tblemail.ajax.reload(null,true); 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");

        }
    });
}

</script>