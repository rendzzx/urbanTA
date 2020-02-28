<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/select2/select2.min.css')?>" rel="stylesheet">


 <link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet">

<style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    left: 9%;
    top: 1%;
   z-index: 99999;
    background:url("<?php base_url('img/loading.gif') ?>") no-repeat center center  
}
/*div.dataTables_wrapper 
div.dataTables_filter {
    text-align: right;
    float: right;
    padding-bottom: 5px;
}*/
</style>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
              <br><br>
              <h3 class="content-header-title">News And Promo</h3>
            </div>

            <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                        </li>
                        <li class="breadcrumb-item active">Setting
                        </li>
                        <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Fixed Navigation
                        </li> -->
                        </ol>
                    </div>
                </div>
            </div>

            
        </div>

        <div class="content-body">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="nav-vertical p-2">
                                <ul class="nav nav-tabs nav-left flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link active"  data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Current News & Promo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">History News & Promo</a>
                                    </li>
                                
                                </ul>
                                <div class="tab-content px-1">
                                    <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="tab1">
                                          <table id="tblnewsfeed_current" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <!-- display table-striped table-condensed -->
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>Contect Type</th>
                                                <th>Subject</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Product Code</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab2" aria-labelledby="tab2">
                                        <table id="tblnewsfeed_history" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <!-- display table-striped table-condensed -->
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>Contect Type</th>
                                                <th>Subject</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Product Code</th>
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
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

 <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
<script type="text/javascript">



var tblnewsfeed_current,tblnewsfeed_history;
var tblnewsfeed_history = $('#tblnewsfeed_history').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('newsandpromo/getTable_history');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"content_type", sortable: false},
            {data:"subject"},
            {data:"start_date", sortable: true,
            render:function (data,type,row) {
                    var a = data.substr(0, 4);
                    var b = data.substr(5, 2);
                    var c = data.substr(8, 2);
                    return c+"-"+b+"-"+a;
                }
            },
            {data:"end_date", sortable: true,
            render:function (data,type,row) {
                    var a = data.substr(0, 4);
                    var b = data.substr(5, 2);
                    var c = data.substr(8, 2);
                    return c+"-"+b+"-"+a;
                }
            },
            {data:"product_cd", sortable: true,
            render:function (data,type,row) {
                    
                    return data+'+';
                }
            },
            {data:"id", visible: false},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar newsandpromo_history">frtip'
    });
var tblnewsfeed_current = $('#tblnewsfeed_current').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('newsandpromo/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"content_type", sortable: false},
            {data:"subject"},
            {data:"start_date", sortable: true,
            render:function (data,type,row) {
                    var a = data.substr(0, 4);
                    var b = data.substr(5, 2);
                    var c = data.substr(8, 2);
                    return c+"-"+b+"-"+a;
                }
            },
            {data:"end_date", sortable: true,
            render:function (data,type,row) {
                    var a = data.substr(0, 4);
                    var b = data.substr(5, 2);
                    var c = data.substr(8, 2);
                    return c+"-"+b+"-"+a;
                }
            },
            {data:"product_cd", sortable: true,
            render:function (data,type,row) {
                    
                    return data+'+';
                }
            },
            {data:"id", visible: false},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar newsandpromo">frtip'
    });
    $("div.newsandpromo").html(
        '<button id="addnewsandpromo" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editnewsandpromo" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
        '<button id="deletenewsandpromo" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>'
    );
    tblnewsfeed_current.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblnewsfeed_current.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addnewsandpromo').click(function(){
        // $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        // $('#modaltitle').addClass('white');
        // $('#modaltitle').html('Add News and Promo');
        // $('.modal-footer').hide();
        // $('#modalbody').load("<?php echo base_url("newsandpromo/addnew");?>");
        // $('#modal').data('id', 0);
        // $('#modal').data('action', 'add');
        // $('#modal').modal('show');
        window.location.href="<?php echo base_url('newsandpromo/form')?>"+'/0/A';
    })
    $('#editnewsandpromo').click(function(){
        var rows = tblnewsfeed_current.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblnewsfeed_current.rows(rows).data();
        var id = data[0].id;
        // alert(id);
        window.location.href="<?php echo base_url('newsandpromo/form')?>"+'/'+id+'/E';
        // $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        // $('#modaltitle').addClass('white');
        // $('.modal-footer').hide();
        // $('#modaltitle').html('Edit News and Promo');
        // $('#modalbody').load("<?php echo base_url("newsandpromo/addnew");?>");
        //  $('#modal').data('action', 'edit');
        // $('#modal').data('id', id);
        // $('#modal').modal('show');
    })
    $('#deletenewsandpromo').click(function(){
        block(true,'.content-body');
        var rows = tblnewsfeed_current.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblnewsfeed_current.rows(rows).data();
        var id = data[0].id;

        swal({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then(function(a){
            if (a.value==true) {
                    Delete(id);
                }else{
                    block(false,'.content-body');
                }
        })
    })

function Delete(id) {
    // var survey_id = id;
   block(true,'.content-body');
    $.ajax({
        url : "<?php echo base_url('newsandpromo/Delete');?>",
        type:"POST",
        data: { id: id },
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"success");
               block(false,'.content-body');
                tblnewsfeed_current.ajax.reload(null,true); 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                block(false,'.content-body');
        }
    });
}
</script>
<!-- <div id="loader" class="loader" hidden="true"></div> -->

