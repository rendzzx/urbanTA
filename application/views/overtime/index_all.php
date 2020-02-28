<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">




<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
           <br><br>
           <h3 class="content-header-title">All Overtime</h3>
        </div>

        <div class="content-header-right col-md-8 col-12 mb-2">
          <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">Overtime
                    </li>
                    <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Survey
                    </li> -->
                    </ol>
                </div>
            </div>
        </div>

        
     </div>
     <div class="content-detached content-right">
        <div class="content-body">
           <div class="col-sm-12" style="z-index: 1;">
              <div class="card" style="z-index: 1;">
                 <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       <table class="table table-striped table-bordered zero-configuration" id="table" width="100%">
                          <thead>
                             <tr>
                                <th>Overtime No</th>
                                <th>Debtor Acct</th>
                                <th>Debtor Name</th>
                                <th>Lot No.</th>
                                <th>Start Overtime</th>
                                <th>End  Overtime</th>
                                <th>Status</th>
                                <th>OT Posting</th>
                                <!-- <th></th> -->
                             </tr>
                          </thead>
                       </table>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>

     
     


     <div class="sidebar-detached sidebar-left sidebar-sticky">
        <div class="sidebar">
           <div class="sidebar-content card d-none d-lg-block">
              <div class="card-body">
                 <h3 class="card-title"><i class="ft-filter"></i>&nbsp;&nbsp;Filter</h3>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="open" name="filter" value="Open">
                    <label class="custom-control-label" for="open">Open</label>
                    <span class="badge badge-info float-right mr-2" id="sOpen"></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="approved" name="filter" value="Approved">
                    <label class="custom-control-label" for="approved">Approved</label>
                    <span class="badge badge-info float-right mr-2" id="sApproved"></span>
                 </div>
                 </p>
              <!--    <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="Posted" name="filter2" value="Posted">
                    <label class="custom-control-label" for="Posted">Posting</label>
                    <span class="badge badge-info float-right mr-2" id="sPosting"></span>
                 </div>
                 </p> -->
              </div>
           </div>
        </div>
     </div>
     <div class="sidebar-detached sidebar-left sidebar-sticky">
        <div class="sidebar">
           <div class="sidebar-content card d-none d-lg-block">
              <div class="card-body">
                 <h3 class="card-title"><i class="ft-filter"></i>&nbsp;&nbsp;Filter</h3>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="unposted" name="filter2" value="N">
                    <label class="custom-control-label" for="unposted">Unposted</label>
                    <span class="badge badge-info float-right mr-2" id="sUnposted"></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="posted" name="filter2" value="Y">
                    <label class="custom-control-label" for="posted">Posted</label>
                    <span class="badge badge-info float-right mr-2" id="sPosted"></span>
                 </div>
                 </p>
              <!--    <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="Posted" name="filter2" value="Posted">
                    <label class="custom-control-label" for="Posted">Posting</label>
                    <span class="badge badge-info float-right mr-2" id="sPosting"></span>
                 </div>
                 </p> -->
              </div>
           </div>
        </div>
     </div>
  </div>
</div>

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/pages/content-sidebar.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

 


<script type="text/javascript">

  loadfilter()

  var table = $('#table').DataTable({
    "responsive": true,
    "ordering": false,
    "ajax" : {
        "url" : "<?php echo base_url('C_overtime_all/gettable');?>",
        "type": "POST"
    },
    "columns": [
            { data: "ot_id", width:'1px',
                render: function (data, type, row) {
                    return '<b>#' + data + '</b>'
                }
            },
            { data:'debtor_acct'},
            { data:'debtor_name'},
            { data:'lot_no'},
            { data: "start_overtime",
                render: function (data, type, row) {
                    return '<span>' + formatdate(data) + '</span>'
                }
            },
            { data: "end_overtime",
                render: function (data, type, row) {
                    return '<span>' + formatdate(data) + '</span>'
                }
            },
            // { data:'description'},
            { data:'approved',
                render: function (data, type, row) {
                  if(data=='N'){
                      data = 'Open';
                      color = 'badge-primary';
                  }
                
                  // else if(data=='Y'){
                  //     data = "Close";
                  //     color = 'badge-danger';
                  // }

                  else if(data=='Y'){
                      data = "Approved";
                      color = 'badge-danger';
                  }
                 
                  else{
                      data = "Error"
                      color = 'badge-danger';
                  }
                  return '<div class="badge '+color+'">'+data+'</div>'
                  // return '<span style="cursor: default" class="btn '+color+' btn-min-width">'+data+'</span> '
                }
            },
            { data:'status_posting',
                render: function (data, type, row) {
                  if(data=='N'){
                      data = 'Unposted';
                      color = 'badge-danger';
                  }
                
                  else if(data=='P'){
                      data = "Posted";
                      color = 'badge-primary';
                  }
                 
                  else{
                      data = "Error"
                      color = 'badge-danger';
                  }
                  return '<div class="badge '+color+'">'+data+'</div>'
                  // return '<span style="cursor: default" class="btn '+color+' btn-min-width">'+data+'</span> '
                }
            },
            { data:'status_posting',visible:false}
            // {
            //   "className":      'details-control',
            //   "orderable":      false,
            //   "data":           null,
            //   "defaultContent": ''
            // },
        ],
    paging:false,
  })


  $('#table').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
} );

  $( "input[name='filter']").change(function(){
    var length = $( "input[name='filter']:checked").length;
    var data = $( "input[name='filter']:checked");

    var filter = ''
    for (var i = 0; i < length; i++) {
      var filter = filter + data[i].value + '|'
    }
    var filter = filter.replace("undefined", "");
    var filter = filter.slice(0, -1)
    console.log(filter);
    table
      .column( 6 )
      .search(
        filter,
        {regex: true}
      )
    .draw()
  })

  $( "input[name='filter2']").change(function(){
    var length = $( "input[name='filter2']:checked").length;
    var data = $( "input[name='filter2']:checked");

    var filter = ''
    for (var i = 0; i < length; i++) {
      var filter = filter + data[i].value + '|'
    }
    var filter = filter.replace("undefined", "");
    var filter = filter.slice(0, -1)

    table
      .column( 8)
      .search(
        filter,
        {regex: true}
      )
    .draw()
  })

  function format ( d ) {
    var assign = ''
    var repotno = ''
    var priority = ''
    if (d.assign_to==null || d.assign_to=='') {
      assign = 'Not Set'
    }
    else{
      assign = d.assign_to
    }
    if (d.report_no==null || d.report_no=='') {
      repotno = 'Not Set'
    }
    else{
      repotno = d.report_no
    }
    if (d.category_priority==1) {
      priority = 'Low'
    }
    else if (d.category_priority==2){
      priority = 'Medium'
    }
    else{
      priority = 'High'
    }

    if (d.seq_no_ticket==null || d.seq_no_ticket=='') {
      $('#ol'+d.rowId).append('<li data-target="#carousel-area" data-slide-to="0" class="active"></li>')
      $('#img'+d.rowId).append(
      '<div class="carousel-item active">'+
        '<img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg" class="img-thumbnail img-fluid w-100" alt="First slide">'+
      '</div>'
      )
    }
    else{
      $.getJSON("<?php echo base_url('C_Ticket_Assign/getpict');?>" + "/" + d.seq_no_ticket, function (data) {
        if (data.length>0) {
          var pict = data[0].file_url
          if (pict==null || pict=='') {
            $('#ol'+d.complain_no).append('<li data-target="#carousel-area" data-slide-to="0" class="active"></li>')
            $('#img'+d.complain_no).append(
            '<div class="carousel-item active">'+
              '<img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg" class="img-thumbnail img-fluid w-100" alt="First slide">'+
            '</div>'
            )
          }
          else{
            $('#ol'+d.complain_no).append('<li data-target="#carousel-area" data-slide-to="0" class="active"></li>')
            $('#img'+d.complain_no).append(
            '<div class="carousel-item active">'+
              '<img src="'+data[0].file_url+'" class="img-thumbnail img-fluid w-100" alt="First slide" onclick=modal("'+data[0].file_url+'")>'+
            '</div>'
            )
          }
        }
        else{
          $('#ol'+d.complain_no).append('<li data-target="#carousel-area" data-slide-to="0" class="active"></li>')
          $('#img'+d.complain_no).append(
          '<div class="carousel-item active">'+
            '<img src="https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg" class="img-thumbnail img-fluid w-100" alt="First slide">'+
          '</div>'
          )
        }
        $.each(data, function( key, val ) {
          if (key>0) {
            key = key+1
            $('#ol'+d.complain_no).append('<li data-target="#carousel-area" data-slide-to="'+key+'"></li>')
            $('#img'+d.complain_no).append(
              '<div class="carousel-item">'+
                '<img src="'+val.file_url+'" class="img-thumbnail img-fluid w-100" alt="First slide" onclick=modal("'+val.file_url+'")>'+
              '</div>'
            )
          }
        });
      })
    }

    var html = '<div class="card box-shadow-0 border-info">'+
                  '<div class="card-content collapse show">'+
                    '<div class="card-body">'+
                      '<div class="row">'+
                        '<div class="col-sm-2">'+
                          '<span class="card-text"><b>Ticket No</span></b><br>'+
                          '<span class="card-text"><b>Report Date</span></b><br>'+
                          '<span class="card-text"><b>Category</span></b><br>'+
                          '<span class="card-text"><b>Priority</span></b><br>'+
                          '<span class="card-text"><b>Reported By</span></b><br>'+
                          '<span class="card-text"><b>Assign To</span></b><br>'+
                        '</div>'+
                        '<div class="col-sm-4">'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.complain_no+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+formatdate(d.reported_date)+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.descs+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+priority+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.reported_by+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+assign+'</span><br>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                          '<span class="card-text"><b>Report No</b></span><br>'+
                          '<span class="card-text"><b>Assign Date</span></b><br>'+
                          '<span class="card-text"><b>Survey Date</span></b><br>'+
                          '<span class="card-text"><b>Respond Date</span></b><br>'+
                          '<span class="card-text"><b>Estimated Date</span></b><br>'+
                          '<span class="card-text"><b>Completed Date</span></b><br>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                          '<span class="card-text">:&nbsp;&nbsp; '+repotno+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+formatdate(d.assigned_date)+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+formatdate(d.survey_date)+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+formatdate(d.response_time)+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+formatdate(d.est_completion_date)+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+formatdate(d.completion_date)+'</span><br>'+
                        '</div>'+
                      '</div>'+
                      '<br>'+
                      '<br>'+
                      '<div class="row">'+
                        '<div class="col-sm-8">'+
                          '<span class="card-text"><b>Detail Information</b></span><br>'+
                          '<hr>'+
                        '</div>'+
                        '<div class="col-sm-4">'+
                          '<span class="card-text"><b>Picture</b></span><br>'+
                          '<hr>'+
                        '</div>'+
                      '</div>'+
                      '<div class="row">'+
                        '<div class="col-sm-3">'+
                          '<span class="card-text"><b>Debtor Name</span></b><br>'+
                          '<span class="card-text"><b>Lot No</span></b><br>'+
                          '<span class="card-text"><b>Floor</span></b><br>'+
                          '<span class="card-text"><b>Request By</span></b><br>'+
                          '<span class="card-text"><b>Contact</span></b><br>'+
                          '<span class="card-text"><b>Location</span></b><br>'+
                          '<span class="card-text"><b>Work Requested</span></b><br>'+
                        '</div>'+
                        '<div class="col-sm-5">'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.name+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.lot_no+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.floor+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.serv_req_by+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.contact_no+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.location+'</span><br>'+
                          '<span class="card-text">:&nbsp;&nbsp; '+d.work_requested+'</span><br>'+
                        '</div>'+
                        '<div class="col-sm-4">'+
                          '<div id="carousel-area" class="carousel slide" data-ride="carousel">'+
                            '<ol class="carousel-indicators" id="ol'+d.complain_no+'">'+
                            '</ol>'+
                            '<div class="carousel-inner" role="listbox" id="img'+d.complain_no+'">'+
                            '</div>'+
                            '<a class="carousel-control-prev" href="#carousel-area" role="button" data-slide="prev">'+
                            '<span class="la la-angle-left" aria-hidden="true"></span>'+
                            '<span class="sr-only">Previous</span>'+
                            '</a>'+
                            '<a class="carousel-control-next" href="#carousel-area" role="button" data-slide="next">'+
                            '<span class="la la-angle-right icon-next" aria-hidden="true"></span>'+
                            '<span class="sr-only">Next</span>'+
                            '</a>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                      '<br>'+
                      '<div class="row">'+
                        '<div class="col-sm-3">'+
                          '<button onclick="view('+d.complain_no+',\'Survey\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan btn-block">Survey</button>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                          '<button onclick="view('+d.complain_no+',\'Process\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan btn-block">Process</button>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                          '<button onclick="view('+d.complain_no+',\'Confirm\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan btn-block">Confirm</button>'+
                        '</div>'+
                        '<div class="col-sm-3">'+
                          '<button onclick="view('+d.complain_no+',\'Close\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan btn-block">Close</button>'+
                        '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>';


        return html
    }

  function view(id,action){
    $('#modaldialog').addClass('modal-xl');
    $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
    $('#modaltitle').addClass('white');
    $('#modaltitle').html('Approval');
    if (action=='Close') {
      $('#modalbody').load("<?php echo base_url("c_ticket_close/add/");?>"+id+'/'+action);
    }
    else{
      $('#modalbody').load("<?php echo base_url("c_ticket_update/add/");?>"+id+'/'+action);
    }
    $('#modal').data('id', 0);
    $('#modal').modal('show');
    $('.modal-footer').hide()
  }


  function formatdate(data){
    if (data==null || data=='') {
      return 'Not Set'
    }
    var date = new Date(data);
    var dd = date.getDate();
    var mm = date.getMonth() + 1
    var yyyy = date.getFullYear();
    var h = date.getHours();
    var m = date.getMinutes();
    if (dd < 10) {
      dd = '0' + dd;
    } 
    if (mm < 10) {
      mm = '0' + mm;
    }
    if (h < 10) {
      h = '0' + h;
    } 
    if (m < 10) {
      m = '0' + m;
    } 

    var newdate = dd + '/' + mm + '/' + yyyy + ' ' + h + ':' + m;

    return newdate
  }

  function modal(pict){
    $('#modaltitle').hide()
    $('#modaldialog').addClass('modal-lg');
    $('#modalbody').html("<img src='"+pict+"' width='530px' style='margin:auto;display:block;'>");
    $('#modal').modal('show');
    $('.modal-footer').remove()
  }

  function loadfilter(){
      $.getJSON("<?php echo base_url('C_overtime_all/getfilter');?>", function (data) {
        console.log(data);
          $('#sOpen').text(data.open[0].cnt)
          $('#sApproved').text(data.approved[0].cnt)
          $('#sPosted').text(data.posted[0].cnt)
          $('#sUnposted').text(data.unposted[0].cnt)
      })
  }


</script>

