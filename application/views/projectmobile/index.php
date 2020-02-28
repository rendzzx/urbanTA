<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<div class="app-content content">
    <div class="content-wrapper">
      
        <div class="content-wrapper-before" style="height: 150px !Important"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
              <br><br>
              <h3 class="content-header-title">Projects Entry</h3>
            </div>

            <div class="content-header-right col-md-8 col-12 mb-2">
                <br>
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                        </li>
                        <li class="breadcrumb-item active">Projects
                        </li>
                        <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Web Menu -->
                        </li>
                        </ol>
                    </div>
                </div>
            </div>


        </div>

        <div class="content-body">
            <!-- <section id="tblnewsfeed"> -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title">Projects</h4> -->
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
                                                <th>Entity Code</th>
                                                <th>Project Name</th>
                                                <!-- <th>Picture Path</th> -->
                                                <!-- <th>Http Address</th> -->
                                                <th>Location</th>
                                                <th>Database Profile</th>
                                                <th>Database Name</th>
                                                <th>Status</th>
                                                <th>Priority No</th>
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

        <!-- <div class="content-body">

        </div> -->
        
    </div>
</div>


<div id="modal" class="modal fade"  role="dialog" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
</div>
 
<script type="text/javascript">

var tblnewsfeed; 
var tblnewsfeed = $('#tblnewsfeed').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_projects/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"entity_cd" },
            {data:"project_descs"},
            // {data:"picture_path"},
            // {data:"http_add"},
            {data:"location"},
            {data:"db_profile"},
            {data:"db_name"},
            {data:"project_status_descs"},
            {data:"seq_no"}
            // {data:"columdef"},

        ],
        // "columnDefs": [ {
        //             className: 'control',
        //             orderable: false,
        //             targets:   8
        //         } ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar newsfeed">frtip',
        // "responsive": {
        //     details: {
        //         type: 'column',
        //         target: 8
        //     }
        // }
    });
    $("div.newsfeed").html(
        '<button id="addnewsfeed" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
        '<button id="editnewsfeed" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
    
    );
    tblnewsfeed.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblnewsfeed.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addnewsfeed').click(function(){
    var site_url = '<?php echo base_url("c_projects/form/add")?>';
    window.location.href= site_url;
        // $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        // $('#modaltitle').addClass('white');
        // $('#modaltitle').html('Add Plan');
        // $('#modalbody').load("<?php echo base_url("c_projects/addnew");?>");
        // $('#modal').data('id', 0);
        // $('#modal').modal('show');
    })
    $('#editnewsfeed').click(function(){
        var rows = tblnewsfeed.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblnewsfeed.rows(rows).data();
        var rowID = data[0].RowID;

        var site_url = '<?php echo base_url("c_projects/form/edit")?>'+ "/" +rowID;
        window.location.href= site_url;    

        // $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        // $('#modaltitle').addClass('white');
        // $('#modaltitle').html('Edit Plan');
        // $('#modalbody').load("<?php echo base_url("c_projects/addnew/")?>'+rowID");

        // $('#modal').data('rowID', rowID);
        // $('#modal').modal('show');
    })


</script>

