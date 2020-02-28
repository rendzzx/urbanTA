
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>





<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">System Specification</h3>
      </div>

        <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">System Specification
                    </li>
                    <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Web Menu -->
                    </li>
                    </ol>
                </div>
            </div>
        </div>


    </div>
      <div class="content-body">
        <!-- <section id="tblgroup"> -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                  
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">

                                <div class="table-responsive">
                                    <table id="tblgroup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                        <thead>            
                                            <th class="sorting_asc">No.</th>
                                            <th >Max Upload Size</th>
                                            <th>Email S+</th>
                                    
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
            <!-- </section> -->
        </div>



      <script type="text/javascript">

        function block(boelan,element){
          var block_ele = $(element)
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
    //GET DATA TABLE
    var tblgroup; 
    var tblgroup = $('#tblgroup').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_sys_spec/getTable');?>",
            "type": "POST"
        },
        "columns": [
        { data: "row_number", width:'1px', searchable:false,
            render: function (data, type, row) {
                var row_number = row.row_number
                return row_number + '.'
                }
            },
            
            {data:"max_upload_size",
                render: function (data, type, row) {
                        
                        return data + row.max_upload_type
                        }},
            {data:"email_splus"},
            {data:"rowID", visible:false},
            {data:"max_upload_type", visible:false},
        ],

        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar group">frtip'

    });

// ADDING BUTTON
$("div.group").html(
    // '<button id="addgroup" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
    '<button id="editgroup" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'//+
    // '<button id="deletegroup" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>&nbsp;'
    
    );


// SELECT ROW
tblgroup.on('click', 'tr', function() {
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    } else {

        tblgroup.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    }
});


$('#addgroup').click(function(){
    // var site_url = '<?php echo base_url("c_sys_spec/addnew/")?>'+0;
    // window.location.href= site_url;
    $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
    $('#modaltitle').addClass('white');
    $('#modaltitle').html('System Specification Entry');
    $('#modalbody').load("<?php echo base_url("c_sys_spec/addnew");?>");

        $('#modal').data('rowID', 0);
        $('#modal').modal('show');

    })


$('#editgroup').click(function(){
    var rows = tblgroup.rows('.selected').indexes();
    if (rows.length < 1) {
        swal("Information",'Please select a row',"warning");
        return;
    } 
    var data = tblgroup.rows(rows).data();
    var rowID = data[0].rowID;

    var site_url = '<?php echo base_url("c_sys_spec/addnew/")?>'+rowID;
    // window.location.href= site_url;    

    $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
    $('#modaltitle').addClass('white');
    $('#modaltitle').html('System Specification Edit');
    $('#modalbody').load(site_url);

    $('#modal').data('rowID', rowID);
    $('#modal').modal('show');
})


$('#deletegroup').click(function(){
        // block(true,'.content-body');
        var rows = tblgroup.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblgroup.rows(rows).data();
        var id = data[0].GroupID;

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
                    Delete(id);
                }else{
                    block(false,'.content-body');
                }
        })
    })

function Delete(id) {
    // var survey_id = id;
   block(true,'.content-body');
    $.ajax({
        url : "<?php echo base_url('c_sys_spec/delete');?>",
        type:"POST",
        data: { id: id },
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"success");
               block(false,'.content-body');
                tblgroup.ajax.reload(null,true); 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                block(false,'.content-body');
        }
    });
}




</script>
