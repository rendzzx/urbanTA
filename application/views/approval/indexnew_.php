<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">


<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
    table.dataTable th.dt-right,
    table.dataTable td.dt-right {
        text-align: right;
        /*cursor: pointer;*/
    /*}*/


</style>

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
        <h4 class="content-header-title">Agent Approval</h4>
      </div>
    </div>
    <div id="loader" class="loader" hidden="true"></div>
    <div class="content-body"> 
      <div class="row">      
        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <div class="card-content">
                  <div class="table-responsive">
                        <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>    
                                <th>No</th>
                                <th>Action</th>                                        
                                <th>Principal Name</th> 
                                <th>Agent Name</th>                               
                                <th>Handphone</th>
                                <th>Email Address</th>
                                <!-- <th></th>           -->
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

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('app-assets/vendors/js/tables/jquery-1.12.3.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">

var tblagent = $('#tblagent').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_agent_approval/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "rowID_agent", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var rowid = row.rowID_agent;
                    return  '<a class="btn btn-success btn-sm" onclick="approve(\''+rowid+'\');"><i class="fa fa-pencil fa-fw"></i> Approve</a>';
                }
            },
            { data: "group_name" },
            { data: "agent_name" },
            { data: "contact_person" },
            { data: "email_add"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });

   $("div.section").html(
        '<button id="viewapprove" class="btn btn-primary pull-up">View</button>&nbsp;'
        // '<button id="editnup" class="btn btn-info pull-up">Edit</button>&nbsp;'//+
        // '<button id="refreshnup" class="btn btn-success pull-up">Refresh</button>'
    );

    tblagent.on('click', 'tr', function() {

      if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblagent.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#viewapprove').click(function(){
        var rows = tblagent.rows('.selected').indexes();
        if (rows.length < 1) {
             swal("Information",'Please select a row',"warning");
                return;
        }

        var data = tblagent.rows(rows).data();
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
    })



function approve(rowid){
    var id = rowid;
    var rows = tblagent.rows('.selected').indexes();
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
    $('#modalFoot').append(btnYes);
    $('#modalFoot').append(btnNo);
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
                tblagent.ajax.reload(null, true);
            } else {
                sweetAlert("Failed", event.Pesan, "error");
                $('#modalAgent').modal('hide');
            }
            tblagent.ajax.reload(null, true);
        },
        error: function(jqXHR, textStatus, errorThrown){
            document.getElementById('loader').hidden=true;
            Swal("Information", textStatus + ' Save : ' + errorThrown, "warning");
        }
    })
}
</script>


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

            <div class="modal-footer" id="modalFoot">
            
            </div>
        </div>
        

    </div>
</div>
