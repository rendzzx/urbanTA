<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/> -->


 <style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
.text_right{
       text-align: right;
       padding-right: 30px !important;
    }
</style>

<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
        <h4 class="content-header-title">Booking</h4>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      </div>
    </div>
    <div class="content-body"> 
      <div class="row">      
        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <div class="card-content">
                  <!-- <?php // echo $list_nf; ?> -->
                    <b>&nbsp; NEW BOOKING</b>
                        <br/><br/>  
                            <table id="tblnup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                <thead>    
                                    <th>No.</th> 
                                    <th>Unit</th>
                                    <th>Name</th>                                        
                                    <th>SP No.</th>                                
                                    <th>Payment Plan</th>
                                    <th>Sales Status</th>
                                    <th>Sales Date</th>
                                    <th>Selling Price</th>
                                    <th>Receipt Amount</th>
                                    <th>Percentage</th>               
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

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('app-assets/vendors/js/tables/jquery-1.12.3.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
    var tblnup = $('#tblnup').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_booking/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.';
                }
            },
            {data:"lot_no"},
            {data:"NAME"},
            {data:"SP_No"},
            {data:"payment_plan"},
            {data:"status_desc"},            
            {data:"sales_date"},
            {data:"sell_price"},  
            {data:"receipt_amt"},
            {data:"Percentage"},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });

    $("div.section").html(
        '<button id="addnup" class="btn btn-primary pull-up">New</button>&nbsp;'+
        '<button id="editsection" class="btn btn-info pull-up">Edit/Revise</button>'
    );

    tblnup.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblnup.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var tr = $(this).closest('tr');
        var row = tblnup.row( tr );

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
    });

    $('#addnup').click(function(){
        // var status='I';
        var site_url = '<?php echo base_url("c_booking/index")?>';

        window.location.href= site_url;
    })


</script>

