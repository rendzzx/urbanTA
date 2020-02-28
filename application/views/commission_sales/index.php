<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Sales Commission</h3>
      </div>
    </div>
    <div class="content-body">
      <section id="salesCommission">
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
                  <div class="row">
                    <div class="col-4">
                      <div class="form-group">
                        <label for="groupCd" class="font-weight-bold">Group Code : </label>
                        <select data-placeholder="Choose a Group..." class="select2" id="groupCd" name="groupCd">
                          <option value=""></option>
                          <option value="all" selected>All</option>
                          <?php foreach ($group as $key) { ?>
                            <option value="<?php echo $key->group_cd?>"><?php echo $key->group_name ?></option>
                          <?php }  ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="agentCode" class="font-weight-bold">Agent Code : </label>
                        <select data-placeholder="Choose a Agent..." class="select2" id="agentCode" name="agentCode">
                          <option value=""></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12">
                      <table id="tblcomm" class="table table-hover table-bordered" style="font-size: 12px">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Commission No</th>
                            <th>Commission Date</th>
                            <th>Lot No</th>
                            <th>Customer Name</th>
                            <th>Sell Price</th>
                            <th>Percent</th>
                            <th>Commission Amount</th>
                            <th>Status</th>
                            <th>Payment No</th>
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
      </section>
    </div>
  </div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script>
  $( document ).ready(function() {
    var id = $('#groupCd').val()
    $.getJSON("<?php echo base_url('C_Commission_Sales/getByIdAgent');?>" + "/" + id, function (data) {
      $('#agentCode').html(data)
    });
  });

  $(".select2").select2({
    width : 300
  });

  $("#groupCd").change(function(){
    block(true);
    var id = $(this).val()
    $.getJSON("<?php echo base_url('C_Commission_Sales/getByIdAgent');?>" + "/" + id, function (data) {
      $('#agentCode').html(data)
      tblcomm.ajax.reload(null,true);
      block(false);
    });
  })

  $("#agentCode").change(function(){
    block(true);
    tblcomm.ajax.reload(null,true);
    block(false);
  })

  var tblcomm = $('#tblcomm').DataTable( {
    "ajax" : {
      "url"  : "<?php echo base_url('C_Commission_Sales/gettablecomm');?>",
      "type" : "POST",
      "data" : 
      {
        "groupCd": function(d){
          var a = $('#groupCd').val();
          var b = "all";
          if(a == null){
              return b;
          }{
              return a;
          }
        },
        "agentCd": function(d){
          var a = $('#agentCode').val();
          var b = "all";
          if(a == null){
              return b;
          }{
              return a;
          }
        }
      }
    },
    "columns": [
      { data: "row_number", width:'1px', searchable:false,
          render: function (data, type, row) {
              var row_number = row.row_number
              return row_number + '.'
          }
      },
      { data: "comm_doc_no" },
      { data: "trx_date",
        render: function(data, type, row){
          return formatdate(data)
        }
      },
      { data: "lot_no" },
      { data: "name" },
      { data: "sell_price",
        render: function(data, type, row){
          return '<p class="text-right">'+formatNumber(data)+'</p>'
        }
      },
      { data: "comm_percen" },
      { data: "comm_amount_dtl",
        render: function(data, type, row){
          return '<p class="text-right">'+formatNumber(data)+'</p>'
        }
      },
      { data: "status" },
      { data: "cb_doc_no" },
    ],
    "language": {
        "decimal": ",",
        "thousands": ".",
    },
    "dom": '<"toolbar section">frtip'
    });

  function block(boelan){
      var block_ele = $('#tblcomm')
      if (boelan==true) {
          $(block_ele).block({
              message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
              fadeIn: 1000,
              fadeOut: 1000,
              overlayCSS: {
                  backgroundColor: '#fff',
                  opacity: 0.8,
                  cursor: 'wait'
              },
              css: {
                  border: 0,
                  padding: '10px 15px',
                  color: '#fff',
                  width: 'auto',
                  backgroundColor: '#333',
                  marginLeft : 'auto'
              }
          });
      }
      else{
          $(block_ele).unblock()
      }
  }

  function formatNumber(data) {
    if(data==null){
      data =0;
    }
    return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
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
</script>