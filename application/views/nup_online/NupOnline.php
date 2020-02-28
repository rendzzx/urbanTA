<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
        <h4 class="content-header-title">NUP Master File</h4>
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
                         
                  <table id="tblnup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >                         
                        <thead>    
                            <th>No</th>
                                                   
                            <th>NUP Type</th>
                            <th>NUP Description</th>
                            <th>NUP Amount</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Refund Type</th>             
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

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('app-assets/vendors/js/tables/jquery-1.12.3.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
 var tblnup = $('#tblnup').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_nup_online/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.';
                }
            },
          
            { data: "nup_type" },
            { data: "descs" },
             { data: "nup_amt" ,
                render: function (data, type, row) {
                    
                    return formatNumber(data);
                }},
            { data: "start_date" ,
                render: function (data, type, row) {
                    
                    return FormatDateNew(data);
                }
            },
            { data: "end_date" ,
                render: function (data, type, row) {
                  
                    return FormatDateNew(data);
                }
            },
            { data: "refund_type" ,render: function (data, type, row) {
                    var ref;
                    if(data=='Y'){
                        ref = 'Refundable';
                    }else{
                        ref = 'Non-Refundable';
                    }
                    return ref;
                }},
            
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });

     $("div.section").html(
        '<button id="addnup" class="btn btn-primary pull-up">New</button>&nbsp;'+
        '<button id="editnup" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deletenup" class="btn btn-danger pull-up">Delete</button>&nbsp;'
        // '<button id="refreshnup" class="btn btn-success pull-up">Refresh</button>'
    );

    tblnup.on('click', 'tr', function() {

      if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblnup.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#addnup').click(function(){
        // alert('add');
   
            window.location.href= '<?php echo base_url("c_nup_online/form")?>';

    })

    $('#editnup').click(function(){
        var rows = tblnup.rows('.selected').indexes();
        if (rows.length < 1) {                            
            swal("Information",'Please select a row',"warning");
            return;
        }

        var data = tblnup.rows(rows).data();
        var nup_type = data[0].nup_type;
        var ID = data[0].rowID;                        
       
        window.location.href= '<?php echo base_url("c_nup_online/form")?>'+'/'+nup_type;
    })

    $('#deletenup').click(function(){
        block(true,'.content-body');
        var rows = tblnup.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblnup.rows(rows).data();
        var id = data[0].rowID;
        var nup_type = data[0].nup_type;

        alert(nup_type);
        alert(id);
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
                    Delete(id, nup_type);
                }else{
                    block(false,'.content-body');
                }
        })
    })

function Delete(rowID, nuptype) {
    // var nuptype = $("#nuptype").find(':selected').val();
    // var nuptype = nup_type;
    // var survey_id = id;
   block(true,'.content-body');
    $.ajax({
        url : "<?php echo base_url('c_nup_online/Delete');?>",
        type:"POST",
        data: { rowID: rowID, nuptype: nuptype },
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"success");
               block(false,'.content-body');
               tblnup.ajax.reload(null,true); 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                block(false,'.content-body');
        }
    });
}

    $('#refreshnup').click(function(){
        tblnup.ajax.reload(null,true);
    })

//End choosen properties      
</script>

<!-- Bootstrap Modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>
