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
              <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
              <h4 class="content-header-title">Agent Approval</h4>
            </div>
            <div id="loader" class="loader" hidden="true"></div>
            <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                        </li>
                        <li class="breadcrumb-item active">Sales Agent
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
                                        <a class="nav-link active"  data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Unapproved Agent</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Approved Agent</a>
                                    </li>
                                
                                </ul>
                                <div class="tab-content px-1">
                                    <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="tab1">
                                          <table id="tblagentunappr" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <!-- display table-striped table-condensed -->
                                            <thead>            
                                                <th>No</th>
                                                <th>Action</th>                       
                                                <th>Principal Name</th> 
                                                <th>Agent Name</th>                               
                                                <th>Handphone</th>
                                                <th>Email Address</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab2" aria-labelledby="tab2">
                                        <table id="tblagentappr" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <!-- display table-striped table-condensed -->
                                            <thead>            
                                                <th>No</th>
                                                <th>Status</th>                       
                                                <th>Principal Name</th> 
                                                <th>Agent Name</th>                               
                                                <th>Handphone</th>
                                                <th>Email Address</th>
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
<!-- Bootstrap Modal -->
<div id="modalAgent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
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



var tblagentappr,tblagentunappr;
var tblagentunappr = $('#tblagentunappr').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_agent_approval/getTable_unappr');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "rowID_agent", width:'2px', searchable:false,
                render: function (data, type, row) {
                    var rowid = row.rowID_agent;
                    return  '<a class="btn btn-success btn-sm" onclick="approve(\''+rowid+'\');" style="color:white;"><i class="fa fa-pencil fa-fw"></i> APPROVE </a>';
                }
            },
            { data: "group_name" },
            { data: "agent_name" },
            { data: "Agent_handphone1" },
            { data: "email_add"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar agent_unapproved">frtip'
    });
var tblagentappr = $('#tblagentappr').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_agent_approval/getTable');?>",
            "type": "POST"
        },
        lengthMenu: [[25, 50,100, -1], [25, 50,100, "All"]],
        "pageLength": -1,
    //     buttons:[
    //     'excelHtml5',
    //  ],
        buttons: [

        {
        extend: 'collection',
        className: 'btn  fa fa-star pull-right',
        text: ' Download',
        buttons: [
        
            {
                    extend: "csv",
                    text: "CSV",
                    exportOptions: {
                        modifier: {
                            search: 'applied',
                            order: 'applied',

                        },
                        columns: [ 0,2,1,3,4,5,6,8],
                        format: {
                            header: function ( data, row, column ) {
                               
                                    if(row==8){
                                        return 'Column ke-8';
                                    }else{
                                        return data;
                                    }
                            }
                        }
                    }

                    
            },
            // {
            //         extend: "pdf",
            //         text: "PDF",
            //         exportOptions: {
            //             modifier: {
            //                 search: 'applied',
            //                 order: 'applied'
            //             },
            //                 columns: [ 0,1,2,3,4,5,6,7]
            //         }

                    
            // }
            // ,
            // {
            //       extend: "print",
            //       text: "Print",
            //       exportOptions: {
            //             modifier: {
            //                 search: 'applied',
            //                 order: 'applied'
            //             },
            //                 columns: [ 0,1,2,3,4,5,6,7]
            //         }

                    
            // }
            // 'csv',
            // 'pdf',
            // 'print'
                    ]           
        },   
        {
            text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                
            }
        }
        
        ],
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "status_approval", width:'1px', searchable:false,
                render: function (data, type,row){
                    var stts = "<button class='btn btn-success btn-sm' disabled><i class='fa fa-pencil fa-fw'</i>APPROVED</button>";
                    if (data == "A") {
                        return stts;
                    }
                }
            },
            { data: "group_name" },
            { data: "agent_name" },
            { data: "Agent_handphone1" },
            { data: "email_add"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar agent_approved">frtip'
    });
    $("div.agent_approved").html(
        '<button id="viewapprove" class="btn btn-primary pull-up">View</button>&nbsp;'
    );

    $("div.agent_unapproved").html(
        '<button id="viewunapprove" class="btn btn-primary pull-up">View</button>&nbsp;'
    );

    tblagentappr.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblagentappr.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    tblagentunappr.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblagentunappr.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#viewapprove').click(function(){
        var rows = tblagentappr.rows('.selected').indexes();
        if (rows.length < 1) {
             swal("Information",'Please select a row',"warning");
                return;
        }

        var data = tblagentappr.rows(rows).data();
        var email_add = data[0].email_add;
        var rowID = data[0].rowID_agent;
        var statuss =  data[0].status;

        $('#modaldialog').addClass('modal-lg');
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('View Profile Agent');
        $('#modalbody').load("<?php echo base_url("c_agent_approval/viewprofile/")?>"+rowID);
        $('#modal').data('rowID_agent', rowID);
        $('#modal').modal('show');
    });

    $('#viewunapprove').click(function(){
        var rows = tblagentunappr.rows('.selected').indexes();
        if (rows.length < 1) {
             swal("Information",'Please select a row',"warning");
                return;
        }

        var data = tblagentunappr.rows(rows).data();
        var email_add = data[0].email_add;
        var rowID = data[0].rowID_agent;
        var statuss =  data[0].status;

        $('#modaldialog').addClass('modal-lg');
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('View Profile Agent');
        $('#modalbody').load("<?php echo base_url("c_agent_approval/viewprofile/")?>"+rowID);
        $('#modal').data('rowID_agent', rowID);
        $('#modal').modal('show');
    });

    function approve(rowid){
        var id = rowid;
        var rows = tblagentunappr.rows('.selected').indexes();
        var modalClass = $('#modalAgent').attr('class');
        switch (modalClass) {
            case "modal fade bs-example-modal-lg":
                $('#modalAgent').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                break;
            case "modal fade bs-example-modal-md":
                $('#modalAgent').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                break;
            default:
                $('#modalAgent').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
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

        $('#modalTitle').html('Approve Agent');

        $('div.modal-body').html('Are you sure want to Approve this Agent?');

        $('div.modal-body').append('<div class="modal-footer"></div>');

        var btnYes = $('<input/>').attr({id: "btnYes",type: "button",class: "btn btn-success",onclick: 'Approval(\''+rowid+'\')',value: 'Yes'
        });
        var btnNo = $('<a>No</a>').attr({ class: "btn btn-default", 'data-dismiss': "modal"
        });
        $('div.modal-footer').append(btnYes);
        $('div.modal-footer').append(btnNo);
        $('#modalAgent').data('id', id).modal('show');

    }

    function Approval(id) {
        document.getElementById('loader').hidden = false;
        $.ajax({
            url     : "<?php echo base_url('c_agent_approval/Approval') ?>",
            type    : "POST",
            data    : {id:id},
            dataType: "json",
            success:function(event, data){
                document.getElementById('loader').hidden = true;
                if (event.Status != 'Fail') {
                    Swal("Information", event.Pesan, "success");
                    $('#modalAgent').modal('hide');
                    tblagentunappr.ajax.reload(null, true);
                } else {
                    sweetAlert("Failed", event.Pesan, "error");
                    $('#modalAgent').modal('hide');
                }
                tblagentunappr.ajax.reload(null, true);
                tblagentappr.ajax.reload(null, true);
            },
            error: function(jqXHR, textStatus, errorThrown){
                document.getElementById('loader').hidden=true;
                Swal("Information", textStatus + ' Save : ' + errorThrown, "warning");
            }
        })
    }

</script>
<!-- <div id="loader" class="loader" hidden="true"></div> -->

