<link href="<?=base_url('datatable/media/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" >
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />

<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.js')?>" type="text/javascript"></script>

<div class="content-wrapper">
  <section class="content-header">
    <div class="form-group">        
        <label for="pl_project" class="control-label pull-left"><?php echo $entname;?></label>
        <label for="pl_project" class="control-label pull-right">Approval</label>
    </div><br>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-body">
            <!-- <table id="tblApproval" class="display table-bordered table-striped dataTable dtr-inline" cellspacing="0" width="100%"> -->
            <table id="tblApproval" class="display table-striped dataTable dtr-inline" cellspacing="0" width="100%">
                <thead>            
                    <th>No</th>
                    <th>Type</th>
                    <th>Doc No</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>
            </table>
          </div>
        </div>                 
      </div>
    </div>
  </section>
</div>

<script type="text/javascript">
var table;
function formatNumber(data) 
{
  if(data==null){
    data =0;
  }
  return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
}
$(function () {
  table = $('#tblApproval').DataTable({
    // select: {style: 'multi'},
    // dom: 'Bfrtip',  //dom: 'blf<t>ip', 
    select: true,
    responsive: true,
    paging: false,
    processing: false,
    serverside: true,
    ajax: {
      url: "<?php echo base_url('approval/getTable');?>",
      type: "POST"
    },
    columns:[
      { data: "row_number", name: "row_number" ,orderable: false },
      { data: "type", name: "type" },
      { data: "doc_no", name: "doc_no" },
      { data: "name", name: "name" },
      { data: null, orderable: false, searchable: false, render: function(data, type, row){
        return row.prjname + '<br>Unit :'+ row.lotname;
      }},
      { data: null, orderable: false, searchable: false, render: function(data, type, row){
        return 'Price : '+formatNumber(row.list_price) + '<br>Disc Amt :'+ formatNumber(row.disc_amt)+'<br>Disc Special : '+formatNumber(row.discount_special_amt)+'<br>Sell Price : '+formatNumber(row.sell_price);
      }},
      { data: "rowid", name: "rowid", orderable: false, searchable: false, render: function(data, type, row){
        // var id = row.doc_no;
        // return '<input type="radio" name="action'+id+'" value="A"><label> Approval</label><br><input type="radio" name="action'+id+'" value="R"><label> Reject</label><br><input type="radio" name="action'+id+'" value="V"><label> Revision</label><br>';
        // return '<a name="A-'+id+'" id="A-'+id+'" onclick="approve('+id+')" class="btn btn-success fa fa-check enable"><a name="R-'+id+'" id="R-'+id+'" onclick="reject('+id+')" class="btn btn-danger fa fa-times enable"><a name="V-'+id+'" id="V-'+id+'" onclick="revision('+id+')" class="btn btn-warning fa fa-refresh enable">' 
        return '<a onclick="approve('+data+');" class="btn btn-success fa fa-check" > Approve</a><a onclick="reject('+data+')" class="btn btn-danger fa fa-times enable"> Reject</a><a  onclick="revision('+data+')" class="btn btn-warning fa fa-refresh"> Revise</a>' 
      }}
    ]
  });
  
  
});
function approve(a){
    // console.log(a);
    // alert(a);
    var site_url = '<?php echo base_url("approval/updApv/")?>';
    $.ajax({
      url: site_url,
      type: "POST",
      data: {rid:a},
      dataType: "json",
      success: function(data, status){
        console.log(data);
        BootstrapDialog.alert(data.pesan);
        table.ajax.reload(null,true);
        // window.location.href="<?php echo base_url('c_nup/Index')?>";
      },
      error: function(jqXHR, textStatus, errorThrown){
      }
    })
    // var d = $(this).data("nip");
    

  }
</script>
    