<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before" style="height: 150px !Important"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        
      </div>
    </div>
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Nup Payment</h4>
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
                                <table id="tbluser" class="table table-hover table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Payment Code</th>
                                            <th>Description</th>
                                            <th>Logo</th>
                                            <th hidden="true">Row Id</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  </div>
</div>

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<script type="text/javascript">

    var tbluser = $('#tbluser').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_nup_payment/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "payment_cd" },
            { data: "descs" },
            { data: "logo" },
            { data: "row_id" ,visible:false}
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar user">frtip'
    });
    $("div.user").html(
        '<button id="adduser" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="edituser" class="btn btn-info pull-up">Edit</button>&nbsp;'
        // '<button id="deleteuser" class="btn btn-danger pull-up">Delete</button>'
    );
    tbluser.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbluser.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#adduser').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaldialog').addClass('modal-sm');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Payment Entry');
        $('#modalbody').load("<?php echo base_url("C_nup_payment/addnew")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#edituser').click(function(){
        var rows = tbluser.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbluser.rows(rows).data();
        var id = data[0].row_id;
        console.log('id = '+id);
        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaldialog').addClass('modal-sm');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Payment');
        $('#modalbody').load("<?php echo base_url("C_nup_payment/addnew")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    // $('#deleteuser').click(function(){
    //     var rows = tbluser.rows('.selected').indexes();
    //     if (rows.length < 1) {
    //         swal("Information",'Please select a row',"warning");
    //         return;
    //     } 

    //     var data = tbluser.rows(rows).data();
    //     var id = data[0].rowID;

    //     swal({
    //         title: 'Are you sure?',
    //         text: 'You won\'t be able to revert this!',
    //         type: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, delete it!'
    //     })
    //     .then(function(a){
    //         if (a.value==true) {
    //             Delete(id,'sv_section',tblsection)
    //         }
    //     })
    // })
    
</script>