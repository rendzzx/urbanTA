
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>


 <style type="text/css">
 
/*div.dataTables_wrapper 
div.dataTables_filter {
    text-align: right;
    float: right;
    padding-bottom: 5px;
}*/
</style>
<!-- 
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>  -->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before" style="height: 120px !important;"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-8 col-12 mb-2">
              <br><br>
              <h5 class="content-header-title">NUP Parameter</h5>
            </div>

            
        </div>

        <div class="content-body">
            <!-- <section id="tblnewsfeed"> -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Nup Parameter</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">

                                    <div class="table-responsive">
                                        <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th class="sorting_asc">No.</th>
                                                <th>Entity Name</th>
                                                <th>Project Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Phase Code</th>
                                                <th>Status</th>
                                                <!-- <th></th> -->
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
            <!-- </section> -->

        </div>
    </div>
</div>


<!-- <div id="modal" class="modal fade"  role="dialog" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>
            <div class="modal-body">
            </div>
        </div>

    </div>
</div> -->


<script type="text/javascript">

// var tblnewsfeed;
var tblnewsfeed = $('#tblnewsfeed').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_nup_parameter/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "entity_name" },
            { data: "project_descs" },
            { data: "start_date",
                render: function (data, type, row) {

                    var date = new Date(parseInt(data.substr(0,10)));
                    var year =data.substr(0,4);
                    var month=data.substr(5,2);
                    var day =data.substr(8,2);

                    var aa = day+"/"+month+"/"+year;
                    return aa;
                }
            },
            {
                data:"end_date",
                render: function (data, type, row) {

                    var date = new Date(parseInt(data.substr(0,10)));
                    var year =data.substr(0,4);
                    var month=data.substr(5,2);
                    var day =data.substr(8,2);

                    var aa = day+"/"+month+"/"+year;
                    return aa;
                }
            },
            {data:"phase_descs"},
            {
                data:"status",
                render:function (data,type,row) {
                    if(data==1){
                        return 'Active';
                    }else{
                        return 'Obsolete';
                    }
                }
            },

        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar parameter">frtip'
    });
    $("div.parameter").html(
        '<button id="addparam" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editparam" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
        
    );
    tblnewsfeed.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblnewsfeed.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addparam').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Newsfeed');
        $('#modalbody').load("<?php echo base_url("c_nup_parameter/addnew");?>");
        $('#modal').data('nup_id', 0);
        $('#modal').modal('show');
    })
    $('#editparam').click(function(){
        var rows = tblnewsfeed.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblnewsfeed.rows(rows).data();
        var UserID = data[0].nup_id;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Newsfeed');
        $('#modalbody').load("<?php echo base_url("c_nup_parameter/addnew");?>");

        $('#modal').data('nup_id', UserID);
        $('#modal').modal('show');
    })

function goToAttachment(){

}
</script>


