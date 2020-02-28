<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<style type="text/css">
   
</style>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Setup</h3>
      </div>
    </div>
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Setup</h4>
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
                                        <a class="nav-link active" data-toggle="tab" href="#tabmeterother" aria-expanded="true">Meter Other Charge Specification</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabmetercategory" aria-expanded="true">Meter Category</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabmeterutilityspecification" aria-expanded="true">Meter Utility Specification</a>
                                        </li>
                                        <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabassignmetertolot" aria-expanded="true">Assign Meter ID to LOT</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1">
                                        <div id="tabmeterother" role="tabpanel" class="tab-pane active" aria-expanded="true">
                                            <table id="tblmeterother" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Generation Charges</th>
                                                        <th>Generation Descs</th>
                                                        <th>First Charges</th>
                                                        <th>First Descs</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabmetercategory" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblmetercategory" class="table table-hover table-bordered table-responsive" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Category Code</th>
                                                        <th>Name</th>
                                                        <th>Capacity Rate</th>
                                                        <th>Calulation Method</th>
                                                        <th>Detail</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabmeterutilityspecification" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblmeterutilityspecification" class="table table-hover table-bordered table-responsive" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Meter Type</th>
                                                        <th>Descriptions</th>
                                                        <th>Multiplier</th>
                                                        <th>Trx Type</th>
                                                        <th>Tax Scheme</th>
                                                        <th>Minimum Amt</th>
                                                        <th>Category Code</th>
                                                        <th>Meter Type</th>
                                                        <th>Other Flag</th>
                                                        <th>Add Min</th>
                                                        <th>Stamp Duty</th>
                                                        <th>OP Trx</th>
                                                        <th>Op Tax Scheme</th>
                                                        <th>Sewage Flag</th>
                                                        <th>Detail</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div id="tabassignmetertolot" role="tabpanel" class="tab-pane" aria-expanded="true">
                                            <table id="tblassignmetertolot" class="table table-hover table-bordered table-responsive" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Meter Type</th>
                                                        <th>Descriptions</th>
                                                        <th>Meter ID</th>
                                                        <th>Lot No</th>
                                                        <th>Debtor acct</th>
                                                        <th>Capacity (KVA)</th>
                                                        <th>Capacity Limit(KVA)</th>
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

    // meterother
    var tblmeterother = $('#tblmeterother').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Mu/gettablemeterother');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "gen_chrg" },
            { data: "gen_desc" },
            { data: "dem_chrg" },
            { data: "dem_desc" }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar meterother">frtip'
    });
    $("div.meterother").html(
        '<button id="addmeterother" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editmeterother" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletemeterother" class="btn btn-danger pull-up">Delete</button>'
    );
    tblmeterother.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblmeterother.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        

    });
    $('#addmeterother').click(function(){
        var rows = tblmeterother.rows().data()
        if (rows.length > 0) {
            swal("Information",'Can\'t Add this Rows, just only one',"warning");
            return;
        } 
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addmeterother")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editmeterother').click(function(){
        var rows = tblmeterother.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblmeterother.rows(rows).data();
        var id = data.length;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Section');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addmeterother")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletemeterother').click(function(){
        var rows = tblmeterother.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblmeterother.rows(rows).data();
        var id = data.length;

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
                Delete(id,'mu_other_spec',tblmeterother)
            }
        })
    })

    //metercategory
    var tblmetercategory = $('#tblmetercategory').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Mu/gettablemetercategory');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"category_cd"},
            {data:"category_name"},
            {data:"capacity_rate"},
            {data:"calculation_method"},
            {
              "className":      'details-control',
              "orderable":      false,
              "data":           null,
              "defaultContent": ''
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar metercategory">frtip'
    });
    $("div.metercategory").html(
        '<button id="addmetercategory" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editmetercategory" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletemetercategory" class="btn btn-danger pull-up">Delete</button>'
    );
    tblmetercategory.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblmetercategory.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#tblmetercategory').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tblmetercategory.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
            // $('.th').removeClass('table th');
            $('td').css("padding","");
            $('th').css("padding","");
           
            // $.css("background-color", "");

            var style = window.getComputedStyle($('.table td').get(0),null);
             console.log(style);
        }

    } );
    $('#addmetercategory').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Service');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addmetercategory")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editmetercategory').click(function(){
        var rows = tblservice.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblservice.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Service');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addmetercategory")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletemetercategory').click(function(){
        var rows = tblservice.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblservice.rows(rows).data();
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
                Delete(id,'sv_master',tblservice)
            }
        })
    })

    //meterutilityspecification
    var tblmeterutilityspecification = $('#tblmeterutilityspecification').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Mu/gettablemeterutilityspecification');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"meter_cd"},
            {data:"descs"},
            {data:"multiplier"},
            {data:"trx_type"},
            {data:"tax_cd"},
            {data:"min_amt"},
            {data:"category_cd"},
            {data:"descs"},
            {data:"other_chrg"},
            {data:"add_min"},
            {data:"stamp_duty"},
            {data:"op_trx"},
            {data:"op_tax_cd"},
            {data:"sewage_flaq"},
            {
              "className":      'details-control',
              "orderable":      false,
              "data":           null,
              "defaultContent": ''
            }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar meterutilityspecification">frtip'
    });
    $("div.meterutilityspecification").html(
        '<button id="addmeterutilityspecification" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editmeterutilityspecification" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletemeterutilityspecification" class="btn btn-danger pull-up">Delete</button>'
    );
    tblmeterutilityspecification.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblmeterutilityspecification.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#tblmeterutilityspecification').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tblmeterutilityspecification.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( formatutil(row.data()) ).show();
            tr.addClass('shown');
            // $('.th').removeClass('table th');
            $('td').css("padding","");
            $('th').css("padding","");
           
            // $.css("background-color", "");

            var style = window.getComputedStyle($('.table td').get(0),null);
             console.log(style);
        }

    } );
    $('#addmeterutilityspecification').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Service');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addmeterutilityspecification")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editmeterutilityspecification').click(function(){
        var rows = tblservice.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblservice.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Service');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addmeterutilityspecification")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletemeterutilityspecification').click(function(){
        var rows = tblservice.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblservice.rows(rows).data();
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
                Delete(id,'sv_master',tblservice)
            }
        })
    })

    
    //assignmetertolot
    var tblassignmetertolot = $('#tblassignmetertolot').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('C_Setting_Mu/gettableassignmetertolot');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            {data:"meter_cd"},
            {data:"ref_no"},
            {data:"meter_id"},
            {data:"lot_no"},
            {data:"debtor_acct"},
            {data:"capacity"},
            {data:"capacity_limit"}
            // {
            //   "className":      'details-control',
            //   "orderable":      false,
            //   "data":           null,
            //   "defaultContent": ''
            // }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar assignmetertolot">frtip'
    });
    $("div.assignmetertolot").html(
        '<button id="addassignmetertolot" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editassignmetertolot" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deleteassignmetertolot" class="btn btn-danger pull-up">Delete</button>'
    );
    tblassignmetertolot.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblassignmetertolot.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#tblassignmetertolot').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tblassignmetertolot.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
            // $('.th').removeClass('table th');
            $('td').css("padding","");
            $('th').css("padding","");
           
            // $.css("background-color", "");

            var style = window.getComputedStyle($('.table td').get(0),null);
             console.log(style);
        }

    } );
    $('#addassignmetertolot').click(function(){
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Service');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addassignmetertolot")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editassignmetertolot').click(function(){
        var rows = tblservice.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblservice.rows(rows).data();
        var id = data[0].rowID;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Service');
        $('#modalbody').load("<?php echo base_url("C_Setting_Mu/addassignmetertolot")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deleteassignmetertolot').click(function(){
        var rows = tblservice.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblservice.rows(rows).data();
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
                Delete(id,'sv_master',tblservice)
            }
        })
    })

    function Delete(id,table,reload) {
        var data = [];
        data.push({ name:'id', value:id },{ name:'table', value:table })
        $.ajax({
            url : "<?php echo base_url('C_Setting_Mu/delete');?>",
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
      if(data==null || data==0){
        data = '-';
      }
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    }

    function format ( d ) {

        $.getJSON("<?php echo base_url('C_Setting_Mu/getdetail');?>" + "/" + d.category_cd, function (data) {
            console.log(data)
            $("#"+d.row_number).append(
                '<td>'+data[0].line_no+'</td>'+
                '<td>'+data[0].start_range+'</td>'+
                '<td>'+data[0].end_range+'</td>'+
                '<td>'+data[0].capacity_multiplier+'</td>'+
                '<td>'+data[0].low_rate+'</td>'+
                '<td>'+data[0].high_rate+'</td>'+
                '<td>'+data[0].rate_factor+'</td>'
            )
        })

        var capacity_given_flag = ''
        var limit_usage_flag = ''
        if (d.capacity_given_flag=='Y') {
            capacity_given_flag = 'Yes'
        }
        else{
            capacity_given_flag = 'No'
        }
        if (d.limit_usage_flag=='Y') {
            limit_usage_flag = 'Yes'
        }
        else{
            limit_usage_flag = 'No'
        }

        var html = 
        '<div class="col-md-12">'+
            '<div class="row">'+
                '<div class="col-sm-2">'+
                    '<b><label>Capacity Limit</label></b><br>'+
                    '<b><label>Usage Limit</label></b><br>'+
                    '<b><label>Discount Rate</label></b><br>'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<label>: '+capacity_given_flag+'</label><br>'+
                    '<label>: '+limit_usage_flag+'</label><br>'+
                    '<label>: '+formatNumber(d.disc_percent)+'</label><br>'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<b><label>Opr Rate</label></b><br>'+
                    '<b><label>Min Usage Hour</label></b><br>'+
                    '<b><label>Constant PLN</label></b><br>'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<label>: '+formatNumber(d.opr_percent)+'</label><br>'+
                    '<label>: '+formatNumber(d.min_usage_hour)+'</label><br>'+
                    '<label>: '+formatNumber(d.constant_pln)+'</label><br>'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<b><label>Bts Sub</label></b><br>'+
                    '<b><label>Trafo Rate</label></b><br>'+
                '</div>'+
                '<div class="col-sm-2">'+
                    '<label>: '+formatNumber(d.bts_sub)+'</label><br>'+
                    '<label>: '+formatNumber(d.trafo_rate)+'</label><br>'+
                '</div>'+
            '</div>'+

            '<div>'+
                    '<table>'+
                        '<tr>'+
                            '<th>No</th>'+
                            '<th>Start Range</th>'+
                            '<th>End Range</th>'+
                            '<th>Capacity Multiplier</th>'+
                            '<th>Low Rate</th>'+
                            '<th>High Rate</th>'+
                            '<th>Rate Factor</th>'+
                        '</tr>'+
                        '<tr id="'+d.row_number+'">'+
                        '</tr>'+
                    '</table>'+
                '</div>'+

        '</div>'+
        '<br>'+

        
                
            
        '<br>';

        // '<div class="col-sm-12">'+
        //     '<div class="row">'+
        //         '<b><label>Detail Master Category</label></b><br>'+
        //         '<div class="col-md-6">'+
        //             '<table class="table table-striped table-hover table-bordered table-responsive">'+
        //                 '<tr>'+
        //                     '<th>No</th>'+
        //                     '<th>Start Range</th>'+
        //                     '<th>End Range</th>'+
        //                     '<th>Capacity Multiplier</th>'+
        //                     '<th>Low Rate</th>'+
        //                     '<th>High Rate</th>'+
        //                     '<th>Rate Factor</th>'+
        //                 '</tr>'+
        //                 '<tr id="'+d.row_number+'">'+
        //                 '</tr>'+
        //             '</table>'+
        //         '</div>'+
        //         '<br>'+
        //         '<br>'+
        //     '</div>'+
        // '</div>';

        return html
    }

    function formatutil ( d ) {

        $.getJSON("<?php echo base_url('C_Setting_Mu/getdetailutility');?>" + "/" + d.meter_cd, function (data) {
            console.log(data)

            $.each(data, function( index, value ) {
                $("#"+d.row_number).append(
                    '<tr>'+
                        '<td>'+value.meter_id+'</td>'+
                        '<td>'+value.ref_no+'</td>'+
                        '<td>'+value.curr_date+'</td>'+
                        '<td>'+value.curr_read+'</td>'+
                        '<td>'+value.curr_read_high+'</td>'+
                    '</tr>'
                )
            })
        })

        // var capacity_given_flag = ''
        // var limit_usage_flag = ''
        // if (d.capacity_given_flag=='Y') {
        //     capacity_given_flag = 'Yes'
        // }
        // else{
        //     capacity_given_flag = 'No'
        // }
        // if (d.limit_usage_flag=='Y') {
        //     limit_usage_flag = 'Yes'
        // }
        // else{
        //     limit_usage_flag = 'No'
        // }

        var html = 
        '<div class="col-md-12">'+
            '<div>'+
                    '<table id="'+d.row_number+'">'+
                        '<tr>'+
                            '<th>Meter ID</th>'+
                            '<th>Ref No</th>'+
                            '<th>Date</th>'+
                            '<th>Reading</th>'+
                            '<th>Reading High</th>'+
                        '</tr>'+
                        // '<tr id="'+d.row_number+'">'+
                        // '</tr>'+
                    '</table>'+
                '</div>'+

        '</div>'+
        '<br>'+

        
                
            
        '<br>';

        return html
    }

</script>

