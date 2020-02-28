
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>


<style type="text/css">
#loader{
    width:80%;
    height:100%;
    position:fixed;
    left: 9%;
    top: 1%;
    z-index: 99999;
    background:url("../img/loading.gif") no-repeat center center     
}
/*div.dataTables_wrapper 
div.dataTables_filter {
    text-align: right;
    float: right;
    padding-bottom: 5px;
    }*/
</style>


<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
    <div class="content-wrapper">

        <div class="content-wrapper-before" style="height: 150px !Important"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
              <br><br>
              <h3 class="content-header-title">Group Approval</h3>
            </div>

            <div class="content-header-right col-md-8 col-12 mb-2">
                <br>
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                        </li>
                        <li class="breadcrumb-item active">Group Approval
                        </li>
                        <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Web Menu -->
                        </li>
                        </ol>
                    </div>
                </div>
            </div>

      </div>
      <div class="content-body">
        <!-- <section id="tblnewsfeed"> -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- <h4 class="card-title">Group Approval</h4> -->
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

                                <div class="table-responsive">
                                    <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                        <thead>            
                                            <th class="sorting_asc">No.</th>
                                            <th hidden="1">Group Id</th>
                                            <th>Group Code</th>
                                            <th>Group Description</th>
                                            <th>Audit User</th>
                                            <th>Audit Date</th>
                                            <!-- <th></th> -->
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



        <!-- Bootstrap Modal -->
        <div id="modal" class="modal fade"  role="dialog" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div id="modalDialog" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" id="modalheader">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h5 class="modal-title" id="modalTitle"></h5>
                    </div>
                    <div class="modal-body" id="modalbody">
                    </div>
                    <div class="modal-footer">
                      <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </div>

          </div>
      </div>


      <script type="text/javascript">

        function block(boelan){
          var block_ele = $('#frmEditor')
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
    var tblnewsfeed; 
    var tblnewsfeed = $('#tblnewsfeed').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_group_approval/getTable');?>",
            "type": "POST"
        },
        "columns": [
        { data: "row_number", width:'1px', searchable:false,
        render: function (data, type, row) {
            var row_number = row.row_number
            return row_number + '.'
        }
    },
    {data:"GroupID", visible:false,},
    {data:"group_cd"},
    {data:"group_descs"},
    {data:"audit_user"},
    {data:"audit_date"},
            // {data:"columdef"},

            ],
        // "columnDefs": [ {
        //             className: 'control',
        //             orderable: false,
        //             targets:   8
        //         } ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar newsfeed">frtip',
        "responsive": {
            details: {
                type: 'column',
                target: 8
            }
        }
    });

// ADDING BUTTON
$("div.newsfeed").html(
    '<button id="addnewsfeed" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
    '<button id="editnewsfeed" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'+
    '<button id="deletenewsfeed" class="btn btn-danger pull-up" style="margin-top: 5px">Delete</button>&nbsp;'
    
    );


// SELECT ROW
tblnewsfeed.on('click', 'tr', function() {
    if ($(this).hasClass('selected')) {
        $(this).removeClass('selected');
    } else {

        tblnewsfeed.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');
    }
});


$('#addnewsfeed').click(function(){
    // var site_url = '<?php echo base_url("c_group_approval/addnew/")?>'+0;
    // window.location.href= site_url;
    $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
    $('#modaltitle').addClass('white');
    $('#modaltitle').html('Menu Entry');
    $('#modalbody').load("<?php echo base_url("c_group_approval/addnew");?>");
        // #('#modalfooter').html('eeeeeeeee');
        $('#modal').data('GroupID', 0);
        $('#modal').modal('show');

    })


$('#editnewsfeed').click(function(){
    var rows = tblnewsfeed.rows('.selected').indexes();
    if (rows.length < 1) {
        swal("Information",'Please select a row',"warning");
        return;
    } 
    var data = tblnewsfeed.rows(rows).data();
    var groupID = data[0].GroupID;

    var site_url = '<?php echo base_url("c_group_approval/addnew/")?>'+groupID;
    // window.location.href= site_url;    

    $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
    $('#modaltitle').addClass('white');
    $('#modaltitle').html('Menu Edit');
    $('#modalbody').load(site_url);

    $('#modal').data('groupID', groupID);
    $('#modal').modal('show');
})


$('#deletenewsfeed').click(function(){
        // block(true,'.content-body');
        var rows = tblnewsfeed.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tblnewsfeed.rows(rows).data();
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
        url : "<?php echo base_url('c_group_approval/delete');?>",
        type:"POST",
        data: { id: id },
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"success");
               block(false,'.content-body');
                tblnewsfeed.ajax.reload(null,true); 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                block(false,'.content-body');
        }
    });
}

$("#frmEditor").validate({
    rules: {
        txtTitle: {
            required: true
        },
        txtIconClass:{
            required:true
        },
        txtOrderSeq:{
            required:true,
            number:true
        }
    },
    errorElement: "span",
    highlight: function (element, errorClass, validClass) {
            $(element).addClass(errorClass); //.removeClass(errorClass);
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass(errorClass); //.addClass(validClass);
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
            error.insertAfter(element.next('span'));
        } else {
            error.insertAfter(element);
        }
    }
});


$('#savefrm').click(function(){


        if ($('#frmEditor').valid()) {
         // document.getElementById('loader').hidden=false;
         block(true);
         var id = $('#modal').data('rowID');
         var datafrm = $('#frmEditor').serializeArray();
         $.ajax({
            url : "<?php echo base_url('c_group_approval/save_menu');?>",
            type:"POST",
            data: datafrm,
            dataType:"json",
            success:function(event, data){
                if (event.ststus == 'NO') {
                    swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                    $('#modal').modal('hide');
                    tblnewsfeed.ajax.reload(null,true);
                }else{
                    swal({
                        title: "Success",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                     $('#modal').modal('hide');
                    tblnewsfeed.ajax.reload(null,true);
                }
            },error: function(jqXHR, textStatus, errorThrown){
              swal({
                title: "Error",
                animation: false,
                type:"error",
                text: textStatus+' Save : '+errorThrown,
                confirmButtonText: "OK"
            });
              document.getElementById('loader').hidden=true;
          }
      })
     }
 
})


</script>
