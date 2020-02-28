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
            <div class="content-header-left col-md-8 col-12 mb-2">
              <br><br>
              <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
              <h5 class="content-header-title">Meter Utility Specification Master</h5>
            </div>

            
        </div>

        <div class="content-body">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="nav-vertical p-2">
                                <div class="tab-content px-1">
                                    <!-- <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="tab1"> -->
                                          <table id="tblspecific" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <!-- display table-striped table-condensed -->
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>Descriptions</th>
                                                <th>Category Code</th>
                                                <th>Trx Type</th>
                                                <th>Meter Type</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    <!-- </div> -->
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



var tblspecific;
var tblspecific = $('#tblspecific').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_mu_spesific/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"descs", sortable: false},
            {data:"category_cd"},
            {data:"trx_type", sortable: true},
            {data:"meter_type", sortable: true,
                render:function(data, type, row) {
                    var elc = "Electric";
                    var wtr = "Water";

                    if (data == "E") 
                    {
                        return elc;
                    }else if (data == "W") 
                    {
                        return wtr;
                    }
                }
            },
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar muspecific">frtip'
    });

    $("div.muspecific").html(
        '<button id="addspecific" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editspecific" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
        '<button id="deletespecific" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>'
    );

    tblspecific.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblspecific.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#addspecific').click(function(){

        window.location.href="<?php echo base_url('c_mu_spesific/form')?>";
    });

    $('#editspecific').click(function(){
        var rows = tblspecific.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblspecific.rows(rows).data();
        var meter_cd = data[0].meter_cd;
        var trx_type = data[0].trx_type;
        var category_cd = data[0].category_cd;
        var meter_type = data[0].meter_type;
        var op_trx = data[0].op_trx;
        
        window.location.href="<?php echo base_url('c_mu_spesific/form')?>"+'/'+trx_type+'/'+category_cd+'/'+meter_cd+'/'+op_trx+'/'+meter_type;
    })


    $('#deletespecific').click(function(){
        block(true,'.content-body');
        var rows = tblspecific.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblspecific.rows(rows).data();
        var rowid = data[0].rowID;

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
                    Delete(rowid);
                }else{
                    block(false,'.content-body');
                }
        })
    })

function Delete(rowid) {
    // var survey_id = id;
   block(true,'.content-body');
    $.ajax({
        url : "<?php echo base_url('c_mu_spesific/Delete');?>",
        type:"POST",
        data: { rowid: rowid },
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"success");
               block(false,'.content-body');
                tblspecific.ajax.reload(null,true); 
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

