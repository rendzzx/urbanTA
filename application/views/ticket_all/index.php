<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<style type="text/css">
  .checked {
    color: orange;
  }
</style>

<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
           <br><br>
           <h3 class="content-header-title">All Ticket</h3>
        </div>

        <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">Customer Service
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
                       <table class="table table-padded table-xl mb-0" id="table" width="100%">
                          <thead>
                             <tr>
                                <th>Ticket No</th>
                                <th>Work Order No</th>
                                <th>Assign To</th>
                                <th>Work REQUESTED</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th></th>
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
                    <span class="badge badge-info float-right mr-2"><?php echo $open[0]->cnt ?></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="assign" name="filter" value="Assign">
                    <label class="custom-control-label" for="assign">Assign</label>
                    <span class="badge badge-info float-right mr-2"><?php echo $assign[0]->cnt ?></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="survey" name="filter" value="Survey">
                    <label class="custom-control-label" for="survey">Survey</label>
                    <span class="badge badge-info float-right mr-2"><?php echo $survey[0]->cnt ?></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="modify" name="filter" value="Modify">
                    <label class="custom-control-label" for="modify">Modify</label>
                    <span class="badge badge-info float-right mr-2"><?php echo $modify[0]->cnt ?></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="proses" name="filter" value="Process">
                    <label class="custom-control-label" for="proses">Process</label>
                    <span class="badge badge-info float-right mr-2"><?php echo $proses[0]->cnt ?></span>
                 </div>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="confirm" name="filter" value="Confirm">
                    <label class="custom-control-label" for="confirm">Confirm</label>
                    <span class="badge badge-info float-right mr-2"><?php echo $confirm[0]->cnt ?></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="approved" name="filter" value="Approved">
                    <label class="custom-control-label" for="approved">Approved</label>
                    <span class="badge badge-info float-right mr-2"><?php echo $approved[0]->cnt ?></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="close" name="filter" value="Close">
                    <label class="custom-control-label" for="close">Close</label>
                    <span class="badge badge-info float-right mr-2"><?php echo $close[0]->cnt ?></span>
                 </div>
                 </p>
                 <p>
                 <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input bg-primary" id="done" name="filter" value="Done">
                    <label class="custom-control-label" for="done">Rating</label>
                    <span class="badge badge-info float-right mr-2"><?php echo $done[0]->cnt ?></span>
                 </div>
                 </p>
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

  $("#modal").on("hidden.bs.modal", function(){
    $("#modalbody").html("");
  });

  var table = $('#table').DataTable({
    "ordering": false,
    "ajax" : {
        "url" : "<?php echo base_url('C_Ticket_All/gettable');?>",
        "type": "POST"
    },
    "columns": [
            { data: "complain_no", width:'1px',
                render: function (data, type, row) {
                    var complain_no = row.complain_no
                    return '<b>#' + complain_no + '</b>'
                }
            },
            { data: "report_no", width:'1px',
                render: function (data, type, row) {
                    var report_no = row.report_no
                    return '<b>' + report_no + '</b>'
                }
            },
            // { data:'descs'},
            { data:'assign_to'},
            { data:'work_requested'},
            { data:'rating_us',
              render: function (data, type, row) {
                return star(data)
              }
            },
            { data:'status',
                render: function (data, type, row) {
                  if(data=='R'){
                      data = 'Open';
                      color = 'badge-primary';
                  }
                  else if(data=='A'){
                      data = "Assign";
                      color = 'badge-info';
                  } 
                  else if(data=='S'){
                      data = "Survey";
                      color = 'badge-warning';
                  }
                  else if(data=='M'){
                      data = "Modify";
                      color = 'badge-secondary';
                  }
                  else if(data=='P'){
                      data = "Process";
                      color = 'badge-success';
                  }
                  else if(data=='F'){
                      data = "Confirm";
                      color = 'badge-secondary';
                  }
                  else if(data=='Z'){
                      data = "Approved";
                      color = 'badge-secondary';
                  }
                  else if(data=='C'){
                      data = "Close";
                      color = 'badge-secondary';
                  }
                  else if(data=='E'){
                      data = "Reject";
                      color = 'badge-danger';
                  }
                  else if(data=='D'){
                      data = "Done";
                      color = 'badge-secondary';
                  }
                  else{
                      data = "Error"
                      color = 'badge-danger';
                  }
                  return '<div class="badge '+color+'">'+data+'</div>'
                  // return '<span style="cursor: default" class="btn '+color+' btn-min-width">'+data+'</span> '
                }
            },
            {
              "className":      'details-control',
              "orderable":      false,
              "data":           null,
              "defaultContent": ''
            },
        ]
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

    table
      .column( 5 )
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
              '<img src="'+data[0].file_url+'" class="img-thumbnail img-fluid w-100" alt="First slide" onclick=modal("'+d.seq_no_ticket+'")>'+
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
                '<img src="'+val.file_url+'" class="img-thumbnail img-fluid w-100" alt="First slide" onclick=modal("'+d.seq_no_ticket+'")>'+
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
                        '<div class="col-sm-12">'+
                          '<button onclick="view('+d.complain_no+',\''+repotno+'\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan btn-block">Detail</button>'+
                        '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>';


    // var html =  '<div class="row">'+
    //               '<div class="col-sm-6">'+
    //                 '<div class="card">'+
    //                   '<div class="card-content collapse show">'+
    //                     '<div class="card-body">'+
    //                       '<div class="row">'+
    //                         '<div class="col-sm-4">'+
    //                           '<span class="card-text"><b>Debtor Name</b></span><br>'+
    //                           '<span class="card-text"><b>Category</span></b><br>'+
    //                           '<span class="card-text"><b>Assign To</span></b><br>'+
    //                           '<span class="card-text"><b>Priority</span></b><br>'+
    //                           '<span class="card-text"><b>Reported By</span></b><br>'+
    //                         '</div>'+
    //                         '<div class="col-sm-8">'+
    //                           '<span class="card-text">: '+d.name+'</span><br>'+
    //                           '<span class="card-text">: '+d.descs+'</span><br>'+
    //                           '<span class="card-text">: '+assign+'</span><br>'+
    //                           '<span class="card-text">: '+priority+'</span><br>'+
    //                           '<span class="card-text">: '+d.reported_by+'</span><br>'+
    //                         '</div>'+
    //                       '</div>'+
    //                     '</div>'+
    //                   '</div>'+
    //                 '</div>'+
    //               '</div>'+
    //               '<div class="col-sm-6">'+
    //                 '<div class="card>'+
    //                   '<div class="card-content collapse show">'+
    //                     '<div class="card-body">'+
    //                       '<div class="row">'+
    //                         '<div class="col-sm-4">'+
    //                           '<span class="card-text"><b>Report No</b></span><br>'+
    //                           '<span class="card-text"><b>Assign Date</span></b><br>'+
    //                           '<span class="card-text"><b>Survey Date</span></b><br>'+
    //                           '<span class="card-text"><b>Respond Date</span></b><br>'+
    //                         '</div>'+
    //                         '<div class="col-sm-8">'+
    //                           '<span class="card-text">: '+repotno+'</span><br>'+
    //                           '<span class="card-text">: '+formatdate(d.assigned_date)+'</span><br>'+
    //                           '<span class="card-text">: '+formatdate(d.survey_date)+'</span><br>'+
    //                           '<span class="card-text">: '+formatdate(d.response_time)+'</span><br>'+
    //                         '</div>'+
    //                       '</div>'+
    //                     '</div>'+
    //                   '</div>'+
    //                 '</div>'+
    //               '</div>'+
    //             '</div>'+
    //             '<div class="row">'+
    //             '<button onclick="view('+d.complain_no+',\'Survey\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan">Survey</button>'+
    //             '<button onclick="view('+d.complain_no+',\'Process\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan">Process</button>'+
    //             '<button onclick="view('+d.complain_no+',\'Confirm\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan">Confirm</button>'+
    //             '<button onclick="view('+d.complain_no+',\'Close\')" type="button" class="btn btn-glow btn-bg-gradient-x-blue-cyan">Close</button>'+
    //             '</div>';
        return html
    }

  function view(id,repotno){
    $('#modaldialog').addClass('modal-xl');
    $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
    $('#modaltitle').addClass('white');
    $('#modaltitle').html(
        '<span id="ttl">Detail</span>'+
        "&nbsp;&nbsp;&nbsp;"+
        "<button class='btn btn-info pull-up' id='btncheckout'><i class='ft ft-check'>&nbsp;<div class='badge badge-pill badge-danger' id='cntc'>0</div></i></button>"
      );
    $('#modalbody').load("<?php echo base_url("c_ticket_all/add/");?>"+id+'/'+repotno);
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

  function modal(id){
    $('#modaltitle').hide()
    $('#modaldialog').addClass('modal-lg');
    $.getJSON("<?php echo base_url('C_Ticket_Update/getpict');?>" + "/" + id, function (data) {
    var html = "";
    html += '<div id="carousel-area" class="carousel slide" data-ride="carousel">'
    html += '<ol class="carousel-indicators">'
    html += '<li data-target="#carousel-area" data-slide-to="0" class="active"></li>'
    $.each(data, function( key, val ) {
      if (key>0) {
        key = key+1
        html += '<li data-target="#carousel-area" data-slide-to="'+key+'"></li>'
      }
    });
    html += '</ol>'
    html += '<div class="carousel-inner" role="listbox">'
    html += '<div class="carousel-item active">'
    html += '<img src="'+data[0].file_url+'" width="530px" style="margin:auto;display:block;"/>'
    html += '</div>'
    $.each(data, function( key, val ) {
      if (key>0) {
        html += '<div class="carousel-item">'
        html += '<img src="'+val.file_url+'" width="530px" style="margin:auto;display:block;"'
        html += '</div>'
      }
    });
    html += '</div>'
    html += '<a class="carousel-control-prev" href="#carousel-area" role="button" data-slide="prev">'
    html += '<span class="la la-angle-left" aria-hidden="true"></span>'
    html += '<span class="sr-only">Previous</span>'
    html += '</a>'
    html += '<a class="carousel-control-next" href="#carousel-area" role="button" data-slide="next">'
    html += '<span class="la la-angle-right icon-next" aria-hidden="true"></span>'
    html += '<span class="sr-only">Next</span>'
    html += '</a>'
    html += '</div>'
    $('#modalbody').html(html);
    })
      // "<img src='"+pict+"' width='530px' style='margin:auto;display:block;'>"
    $('#modal').modal('show');
    $('.modal-footer').remove()
  }

  function star(data){
    var stars = ''
    if (!data) {
        stars = '<i class="la la-star-o"><i class="la la-star-o"><i class="la la-star-o"><i class="la la-star-o"><i class="la la-star-o">'
    }
    if (data==1) {
      stars = '<i class="la la-star checked"><i class="la la-star"><i class="la la-star-o"><i class="la la-star-o"><i class="la la-star-o">'
    }
    if (data==2) {
      stars = '<i class="la la-star checked"><i class="la la-star checked"><i class="la la-star-o"><i class="la la-star-o"><i class="la la-star-o">'
    }
    if (data==3) {
      stars = '<i class="la la-star checked"><i class="la la-star checked"><i class="la la-star checked"><i class="la la-star-o"><i class="la la-star-o">'
    }
    if (data==4) {
      stars = '<i class="la la-star checked"><i class="la la-star checked"><i class="la la-star checked"><i class="la la-star checked"><i class="la la-star-o">'
    }
    if (data==5) {
      stars = '<i class="la la-star checked"><i class="la la-star checked"><i class="la la-star checked"><i class="la la-star checked"><i class="la la-star checked">'
    }
    return stars
  }


</script>

