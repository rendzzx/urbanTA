<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
           <br><br>
           <h3 class="content-header-title">Work Order</h3>
        </div>
     </div>
     
        <div class="content-body">
           <div class="col-md-12" style="z-index: 1;">
              <div class="card" style="z-index: 1;">
                 <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                       <table class="table table-padded table-xl mb-0" id="table" width="100%">
                          <thead>
                             <tr>
                                
                                <th>Report No</th>
                                <th>Assign To</th>
                                <th>Work REQUESTED</th>
                                <th>Action</th>
                                
                             </tr>
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

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/pages/content-sidebar.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script type="text/javascript">

function goto_print (report_no) {
	// alert('a');
	var create_print = "<?php echo base_url('C_workorder/viewprint/');?>"+report_no;
	window.location.href = create_print;
}

  var table = $('#table').DataTable({
    "ordering": false,
    "ajax" : {
        "url" : "<?php echo base_url('C_workorder/gettable');?>",
        "type": "POST"
    },
    "columns": [
            
            { data: "report_no", width:'1px',
                render: function (data, type, row) {
                    var report_no = row.report_no
                    return '<b>#' + report_no + '#</b>'
                }
            },
            // { data:'descs'},
            { data:'assign_to'},
            { data:'work_requested'},
            {
              data: "report_no",
              
              render: function (data, type, row) {
                  // var status = row.status;
                  // console.log(data);
                  
                  // if (status == 'R') {
                  //     var btnedit='<button style="width:50px" class="btn btn-warning btn-sm" onclick="goto_ticket(\'' + data + '\')"> Edit </button>';
                  // } else {
                  //     var btnedit = '';
                  // }
                  var report_no = data;
                  var btnprint = ' <button class="btn btn-primary btn-sm" onclick="goto_print(\''+report_no+'\')" > Print </button>'; 
                  // var btnprint='';
                  return btnprint;
              }
            },
            // {
            //   // "className":      'details-control',
            //   "orderable":      false,
            //   "data":           null,
            //   "defaultContent": ''
            // },
        ],
    paging:false,
  })

  

  

    


    

  


  

  


</script>

