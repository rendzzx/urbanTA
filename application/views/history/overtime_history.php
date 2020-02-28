      <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Data Technician
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Data tables</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
              <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Our Overtime Request</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                      <div class="col-sm-6">
                        <div id="example1_filter" class="dataTables_filter">
                          <form class="form-horizontal" method="post" id="FTH">
                            <div class="checkbox">
                              <input type="checkbox" id="search">
                              <label id="id_criteria">Search by Criteria</label><br>
                              <div class="form-group" name="dropdown-ticket" >
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select class="form-control" name="search">
                                  <option value="0">Closed Ticket</option>
                                  <option value="1">Open Ticket</option>
                                  <option value="2">Waiting Ticket</option>
                                  <option value="3">Info</option>
                                </select>
                              </div><br>
                              <input type="checkbox" id="datesearch">
                              <label id="id_date">Search by Date</label><br>
                              <label>&nbsp;<input id="DateFrom" type="date" class="form-control input-sm" placeholder="from" aria-controls="example1" name="search_fromdate"><label id="id_until">&nbsp;Until:&nbsp;</label><input type="date" class="form-control input-sm" placeholder="to" aria-controls="example1" id="DateUntil" name="search_todate">&nbsp;</label><br>
                              <input type="checkbox" id="timesearch">
                              <label id="id_time">Search by Time</label><br>
                              <label>&nbsp;<input id="TimeFrom" type="time" class="form-control input-sm" placeholder="fromtime" aria-controls="example1" name="search_fromtime"><label id="id_until2">&nbsp;Until:&nbsp;</label><input type="time" class="form-control input-sm" placeholder="totime" aria-controls="example1" id="TimeUntil" name="search_totime">&nbsp;</label>
                          <br><br>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2">
                       
                        <button id="search_hist" name="search_hist" class="btn btn-block btn-primary btn-sm">Search</button>
                      </form>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                            <tr role="row">
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-label="CSS grade: activate to sort column ascending" style="width: 110px;">ID</th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">Subject</th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">How Long</th>
                              <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 152px;">Status</th>
                              <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 177px;">Request Date</th>
                            </tr>
                          </thead>
                    <tbody>
                     <?php if (!empty($list_overtime)) { ?>
              
                <?php echo $list_overtime ?>
              
            <?php } else { ?>
                <h3>Database kosong.</h3>
            <?php } ?>
              </tbody>
                  </table></div></div>
                <div class="box-footer clearfix">
                </div>
                </div>
                </div>
              </div>
            </div>
          </div>
            </div>
        </section>
      </div>

<script>
  
  

$( document ).ready(function() 
{
    $("#cari").hide();
    $("#TimeFrom").hide();
    $("#TimeUntil").hide();
    $("#DateFrom").hide();
    $("#DateUntil").hide();
    $("#id_until").hide();
    $("#id_until2").hide();
    $('#search').attr('checked', false);
    $('#datesearch').attr('checked', false);
    $('#timesearch').attr('checked', false);
    $("#cari").val('');
    $("#DateFrom").val('');
    $("#DateUntil").val('');
    $("#TimeFrom").val('');
    $("#TimeUntil").val('');

    // $( "#DateFrom" ).datepicker();
});

$( "#search_hist" ).click(function() {
  if($("#search").is(':checked'))
  {
      if($("#cari").val()=='')
      {
          alert("Criteria can't be empty");
          return;
      }
  }

  if($("#datesearch").is(':checked'))
  {
      if($("#DateFrom").val()=='')
      {
          alert("Date can't be empty");
          return;
      }
      if($("#DateUntil").val()=='')
      {
          alert("Date can't be empty");
          return;
      }
  }

  if($("#timesearch").is(':checked'))
  {
      if($("#TimeFrom").val()=='')
      {
          alert("Time can't be empty");
          return;
      }
      if($("#TimeUntil").val()=='')
      {
          alert("Time can't be empty");
          return;
      }
  }

});

$("#search").change(function() {
    if(this.checked) 
    {
        $("#cari").show();
    }else{
        $("#cari").val("");
        $("#cari").hide();
    }
});
$("#datesearch").change(function() {
    if(this.checked) 
    {
        $("#DateFrom").show();
        $("#DateUntil").show();
        $("#id_until").show();
    }else{
        $("#DateFrom").val("");
        $("#DateFrom").hide();
        $("#DateUntil").val("");
        $("#DateUntil").hide();     
        $("#id_until").hide();
        $("#id_until").val("");        
    }
});
$("#timesearch").change(function() {
    if(this.checked) 
    {
        $("#TimeFrom").show();
        $("#TimeUntil").show();
        $("#id_until2").show();
    }else{
        $("#TimeFrom").val("");
        $("#TimeFrom").hide();
        $("#TimeUntil").val("");
        $("#TimeUntil").hide();
        $("#id_until2").hide();
        $("#id_until2").val("");
    }
});

function myFunction() {
   var txt;
   var r = confirm("Press a button!");
   if (r == true) {
       txt = "You pressed OK!";
   } else {
       txt = "You pressed Cancel!";
   }
   document.getElementById("demo").innerHTML = txt;
}
</script>