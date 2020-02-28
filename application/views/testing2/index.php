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
                                    <div class="tab-content px-1">
                                        <div id="tabmeterreading" role="tabpanel" class="tab-pane active" aria-expanded="true">
                                            <table id="tblmeterreading" class="table table-hover table-bordered" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Level No</th>
                                                        <th>Level Description</th>
                                                        <th>Meter Type</th>
                                                        <th>Document Date</th>
                                                        <th>Currency Rate</th>
                                                        <th>Detail</th>
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

    // meterreading
    var tblmeterreading = $('#tblmeterreading').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('testing2/gettablemeterreading');?>",
            "type": "POST"
        },
        "columns": [
            { data: "level_no" },
            { data: "descs" },
            // { data: "meter_type" },
            { data: null,
                    "searchable" : false,
                    "orderable":false,
                    "render": function (data, type, row) {
                      var metertype = row.meter_type;
                        if (metertype == 'E'){
                            return 'ELECTRICITY';
                        } else if (metertype == 'G'){
                            return 'GAS';
                        } else if (metertype == 'W'){
                            return 'WATER';
                        }
                    }
            },
            { data: "doc_date" },
            { data: "currency_rate" },
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
        "dom": '<"toolbar meterreading">frtip'
    });
    $("div.meterreading").html(
        '<button id="addmeterreading" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="deletemeterreading" class="btn btn-danger pull-up">Delete</button>'
    );
    tblmeterreading.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblmeterreading.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        

    });
    $('#tblmeterreading').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = tblmeterreading.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( formatreading(row.data()) ).show();
            tr.addClass('shown');
            // $('.th').removeClass('table th');
            $('td').css("padding","");
            $('th').css("padding","");
           
            // $.css("background-color", "");

            var style = window.getComputedStyle($('.table td').get(0),null);
             console.log(style);
        }

    } );
    $('#addmeterreading').click(function(){
        var rows = tblmeterreading.rows().data()
        // if (rows.length > 0) {
        //     swal("Information",'Can\'t Add this Rows, just only one',"warning");
        //     return;
        // } 
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Section');
        $('#modalbody').load("<?php echo base_url("testing2/addmeterreading")?>");
        $('#modal').data('id', 0);
        $('#modal').modal('show');
    })
    $('#editmeterreading').click(function(){
        var rows = tblmeterreading.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblmeterreading.rows(rows).data();
        var id = data.length;

        $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Section');
        $('#modalbody').load("<?php echo base_url("testing2/addmeterreading")?>");

        $('#modal').data('id', id);
        $('#modal').modal('show');
    })
    $('#deletemeterreading').click(function(){
        var rows = tblmeterreading.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblmeterreading.rows(rows).data();
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
                Delete(id,'mu_other_spec',tblmeterreading)
            }
        })
    })

    function Delete(id,table,reload) {
        var data = [];
        data.push({ name:'id', value:id },{ name:'table', value:table })
        $.ajax({
            url : "<?php echo base_url('testing2/delete');?>",
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

    function formatreading ( d ) {

        $.getJSON("<?php echo base_url('testing2/getdetailreading');?>" + "/" + d.level_no + "/" + d.meter_type, function (data) {
            console.log(data)

            $.each(data, function( index, value)
            {
                $("#"+d.row_number).append(
                    '<tr>'+
                    '<td>'+value.meter_id+'</td>'+
                    '<td>'+value.level_no+'</td>'+
                    '<td>'+value.meter_type+'</td>'+
                    '<td>'+value.debtor_acct+'</td>'+
                    '<td>'+value.lot_no+'</td>'+
                    '<td>'+value.capacity+'</td>'+
                    '<td>'+value.curr_read+'</td>'+
                    '<td>'+value.last_read+'</td>'+
                    '<td>'+value.usage+'</td>'+
                    '<td>'+value.curr_read_high+'</td>'+
                    '<td>'+value.last_read_high+'</td>'+
                    '<td>'+value.usage_high+'</td>'+
                    '<td>'+value.trx_amt+'</td>'+
                    '</tr>'
                )
            })
        })

        var html = 
        '<div class="col-md-12">'+
            '<div>'+
                    '<table width="100%" id="'+d.row_number+'">'+
                        '<tr>'+
                            '<th>Meter ID</th>'+
                            '<th>Level No</th>'+
                            '<th>Ref no</th>'+
                            '<th>Debtor A/C</th>'+
                            '<th>Lot No</th>'+
                            '<th>Capacity (KVA)</th>'+
                            '<th>Current Read</th>'+
                            '<th>Previous Read</th>'+
                            '<th>Usage</th>'+
                            '<th>Current Read High</th>'+
                            '<th>Previous Read High</th>'+
                            '<th>Usage High</th>'+
                            '<th>Trx Amount</th>'+
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

