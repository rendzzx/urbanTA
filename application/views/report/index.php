<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Report</h3>
      </div>
    </div>
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo $this->session->userdata('Tsprojectname'); ?></h4>
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
                                <div class="nav-vertical p-2">
                                    <ul class="nav nav-tabs nav-left">
                                        <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabtb" aria-expanded="true">Trial Balance</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabda" aria-expanded="true">Debtor Aging</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabcategory" aria-expanded="true">Category</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabservice" aria-expanded="true">Costumer Service</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabcomplain" aria-expanded="true">Complain Source</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tablabour" aria-expanded="true">Labour</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabitem" aria-expanded="true">Item</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabfeedback" aria-expanded="true">Feedback</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabassign" aria-expanded="true">Assign</a>
                                        </li> -->
                                    </ul>
                                    <div class="tab-content px-1">
                                        <div id="tabtb" role="tabpanel" class="tab-pane active" aria-expanded="true">
                                            <table id="tbltb" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Description</th>
                                                        <th>File Attchment</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabda" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblda" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Description</th>
                                                        <th>File Attchment</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabservice" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblservice" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Service Code</th>
                                                        <th>Section Code</th>
                                                        <th>Category</th>
                                                        <th>Trx Type</th>
                                                        <th>Service Description</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabcomplain" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblcomplain" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Complain Code</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tablabour" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tbllabour" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Labour ID</th>
                                                        <th>Name</th>
                                                        <th>Division</th>
                                                        <th>Departement</th>
                                                        <th>Doc Type</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabitem" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblitem" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>IC</th>
                                                        <th>Item Code</th>
                                                        <th>Description</th>
                                                        <th>Trx Type</th>
                                                        <th>Tax Code</th>
                                                        <th>Currency</th>
                                                        <th>Unit Price</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabfeedback" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblfeedback" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Feedback Code</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabassign" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblassign" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>User ID</th>
                                                        <th>Labour ID</th>
                                                        <th>Name</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabcategorygroup" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblcategorygroup" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Category Group Code</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

<script type="text/javascript">

    // TB
    var tbltb = $('#tbltb').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_report/gettabletb');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "descs" },
            { data: "file_attachment" },
            { data: "doc_date" },
            { data: "file_url",
                render: function (data, type, row) {
                    return '<a href="'+data+'" target="_blank"><button class="btn btn-primary">View PDF</button></a>'
                }
            },
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar tb">frtip'
    });
    $("div.tb").html(
        '<button id="addtb" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="edittb" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletetb" class="btn btn-danger pull-up">Delete</button>'
    );
    tbltb.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tbltb.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addtb').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Trial Balance');
        $('#modalbody').load("<?php echo base_url("c_report/add")?>");
        $('#modal').data('id', 0);
        $('#modal').data('module', 'TB');
        $('#modal').modal('show');
    })
    $('#edittb').click(function(){
        var rows = tbltb.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tbltb.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Trial Balance');
        $('#modal').data('module', 'TB');
        $('#modalbody').load("<?php echo base_url("c_report/add")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletetb').click(function(){
        var rows = tbltb.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tbltb.rows(rows).data();
        var id = data[0].rowID;

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
                Delete(id,tbltb)
            }
        })
    })


    // DA
    var tblda = $('#tblda').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_report/gettableda');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "descs" },
            { data: "file_attachment" },
            { data: "doc_date" },
            { data: "file_url",
                render: function (data, type, row) {
                    return '<a href="'+data+'" target="_blank"><button class="btn btn-primary">View PDF</button></a>'
                }
            },
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar da">frtip'
    });
    $("div.da").html(
        '<button id="addda" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editda" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deleteda" class="btn btn-danger pull-up">Delete</button>'
    );
    tblda.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblda.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    $('#addda').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Debtor Aging');
        $('#modalbody').load("<?php echo base_url("c_report/add")?>");
        $('#modal').data('id', 0);
        $('#modal').data('module', 'DA');
        $('#modal').modal('show');
    })
    $('#editda').click(function(){
        var rows = tblda.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblda.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Debtor Aging');
        $('#modalbody').load("<?php echo base_url("c_report/add")?>");
        $('#modal').data('id', id);
        $('#modal').data('module', 'DA');
        $('#modal').modal('show');
    })
    $('#deleteda').click(function(){
        var rows = tblda.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblda.rows(rows).data();
        var id = data[0].rowID;

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
                Delete(id,tblda)
            }
        })
    })

    function Delete(id,reload) {
        var data = [];
        data.push({ name:'id', value:id })
        $.ajax({
            url : "<?php echo base_url('c_report/delete');?>",
            type:"POST",
            data: data,
            dataType:"json",
            success:function(event, data){
                swal("Information",event.Pesan,"warning");
                $('#modal').modal('hide');
                reload.ajax.reload(null,true);
            },                    
            error: function(jqXHR, textStatus, errorThrown){        
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
            }
        });
    }

    function formatNumber(data) {
      if(data==null){
        data =0;
      }
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    }

</script>

