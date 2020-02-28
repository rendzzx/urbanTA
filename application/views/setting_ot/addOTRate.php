<!--link -->
  <link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

  <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?=base_url('css/plugins/daterangepicker/daterangepicker-bs3.css')?>">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" >

  <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
  <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<!-- end link -->

<!-- style -->
  <style type="text/css">
    .has-error .select2 {
      border: 1px solid #a94442;
      border-radius: 4px;
    }

    .has-error .checkbox-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }

    .has-error .radio-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
    .dataTables_filter {
    display: none; 
    }
    /*label {text-align: right;}
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
      }*/
  </style>
<!-- end style -->

<!-- content -->
    <div class="app-content content">
        <div class="content-wrapper">

            <div class="content-wrapper-before" style="height: 150px !Important"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-8 col-12 mb-2">
                  <br><br>
                  <h3 class="content-header-title">Overtime</h3>
                </div> <!-- content-header-left -->
            </div> <!-- content-header row -->

            <div class="content-body">
                <!-- header -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Overtime Type</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                      <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                      </ul>
                                    </div> <!-- heading elements -->
                                </div> <!-- card header -->
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <form class="form" id="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                            <input type="hidden"  id="rowID" name="rowID">

                                            <div class="form-group">
                                                <label>Level No</label>
                                                <input type="text" class="form-control" id="level_no" name="level_no" readonly>
                                            </div>
                                          
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" id="descs" name="descs" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label>Area</label>
                                               <input type="number" step="any" class="form-control" id="area" name="area" maxlength="6">
                                            </div>

                                            <div class="modal-footer">
                                              <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                                              <button type="button" id="btnback" class="btn btn-primary">Back</button>
                                            </div>
                                        </form>
                                    </div> <!-- card body card dashboard end -->
                                </div> <!-- card content collapse show -->
                            </div> <!-- card -->
                        </div> <!-- col-12 -->
                    </div> <!-- row -->
                <!-- end header -->
                <!-- detail -->
                    <div class="row" id="meterDtl">
                        <div class="col-12">
                                <div class="card">
                                  <div class="card-header">
                                    <h4 class="card-title">Detail</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                      <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                      </ul>
                                    </div> <!-- heading elements -->
                                  </div> <!-- card header -->
                                  <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                      <div style="padding-bottom: 20px;">
                                        <button id="add" class="btn btn-primary pull-up">Add</button>&nbsp;
                                        <button id="edit" class="btn btn-info pull-up">Edit</button>&nbsp;
                                        <button id="delete" class="btn btn-danger">Delete</button> <br>
                                      </div> <!-- button -->
                                      <table id="tblcategory" class="table table-striped table-bordered base-style table-hover dataTables" cellspacing="0">  
                                        <thead> 
                                          <tr>
                                              <th>No.</th>          
                                              <!-- <th class="sorting_asc">Action</th> -->
                                              <th>Overtime Code</th>
                                              <th>Description</th>
                                              <th>Rate</th>
                                              <th hidden="true">Row ID</th>
                                          </tr> 
                                        </thead>
                                        <tbody>
                                        </tbody>
                                      </table>
                                        <div class="modal-footer">
                                            <button type="button" id="btnbac" class="btn btn-primary">Back</button>
                                        </div>
                                    </div> <!-- card-body dashboard -->
                                  </div> <!-- card-content show -->
                                </div> <!-- card -->
                        </div> <!-- col-12 -->
                    </div> <!-- row -->
                <!-- end detail -->
            </div>   
        </div> <!-- content wrapper -->
    </div> <!-- app content -->
  <br><br><br>
<!-- end content -->
<script>
$(document).ready(function(){

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

	loaddata();

    $('#savefrm').click(function(){
        block(true);
        var id = $('#modal').data('id');
        var datafrm = $('#frmdata').serializeArray();
        datafrm.push({name:"id",value:id})

        $.ajax({
            url : "<?php echo base_url('C_Setting_ot/save_OTRate');?>",
            type:"POST",
            data:datafrm,
            dataType:"json",
            success:function(event, data){
                if(event.Error==false){
                    block(false);
                    swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                    $('#modal').modal('hide');
                    tblotrate.ajax.reload(null,true);
                }
                else {
                    block(false);
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                }
            },                    
            error: function(jqXHR, textStatus, errorThrown){
                block(false);
                swal({
                    title: "Error",
                    animation: false,
                    type:"error",
                    text: textStatus+' Save : '+errorThrown,
                    confirmButtonText: "OK"
                });
                 
            }
        });
    });
});

function loaddata(){
    var id = "<?php echo $rowID; ?>";
    if (id > 0) {
        block(true)
        $.getJSON("<?php echo base_url('C_Setting_ot/getByIDOTRate');?>" + "/" + id, function (data) {
            $('#level_no').val(data[0].level_no);
            $('#descs').val(data[0].descs);
            $('#area').val(data[0].area);
            block(false)
        });
    }
}

function block(boelan){
    var block_ele = $('#frmdata')
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
</script>