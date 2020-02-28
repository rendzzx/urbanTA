<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
        <h4 class="content-header-title">Submit Registration Agent</h4>
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
                         
                  <table id="tblsubagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >                         
                        <thead>    
                            <th>No</th>
                            <th>Group Type</th>                                        
                            <th>Email Address</th>                             
                            <th>Full Name</th>
                            <th>NIK</th>
                            <th>Handphone</th>
                            <th>Photos</th>
                            <th>Action</th>            
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
 var tblsubagent = $('#tblsubagent').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_agent_regist/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.';
                }
            },
          
            { data: "group_type", sortable: true, render:function(data,type, row){
                var inhs = "INHOUSE";
                var frlc = "MEMBER";
                if (data == "I"){
                    return inhs;
                }else{
                    return frlc;
                }
              } 
            },
            { data: "email_add" },
             { data: "full_name" },
            { data: "nik" },
            { data: "handphone1" },
            { data: "file_url" ,render:function(data, type, row){
                    return '<img src="'+data+'" height = "75%" width = "75%"/>';
                }
            },
            {
              data: "email_add", render: function (data, type, row) {
                        var emails = row.email_add;
                        var statuss = row.statuss;
                        
                        if (statuss == "N"){
                            return  '<a class="btn btn-danger btn-sm" disabled="true"><i class="fa fa-trash fa-fw"></i> Decline</a>';
                        }
                        return  '<a class="btn btn-danger btn-sm" id="btn_delete" onclick="deletest(\''+emails+'\');" ><i class="fa fa-trash fa-fw"></i> Decline</a>';
      
                    }
            },
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });

     $("div.section").html(
        '<button id="addnup" class="btn btn-primary pull-up">Add</button>&nbsp;'
        // '<button id="editnup" class="btn btn-info pull-up">Edit</button>&nbsp;'//+
        // '<button id="refreshnup" class="btn btn-success pull-up">Refresh</button>'
    );

    tblsubagent.on('click', 'tr', function() {

      if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblsubagent.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#addnup').click(function(){
   
            window.location.href= '<?php echo base_url("c_agent_regist/newagent")?>';

    })

    $('#editnup').click(function(){
        var rows = tblsubagent.rows('.selected').indexes();
        if (rows.length < 1) {                            
            swal("Information",'Please select a row',"warning");
            return;
        }

        var data = tblsubagent.rows(rows).data();
        var nup_type = data[0].nup_type;
        var ID = data[0].rowID;                        
       
        window.location.href= '<?php echo base_url("c_nup_online/form")?>'+'/'+nup_type;
    })

    $('#refreshnup').click(function(){
        tblsubagent.ajax.reload(null,true);
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
