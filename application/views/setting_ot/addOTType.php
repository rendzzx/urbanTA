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

                                            <div class="form-group" id="over">
                                                <label for="over_cd">Overtime Code</label>
                                                <div class="col-sm-6">
                                                    <input type="text" id="over_cd" class="form-control" placeholder="Overtime Code" name="over_cd">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="descs">Description</label>
                                                <div class="col-sm-6">
                                                    <input type="text" id="descs" class="form-control" placeholder="Description" name="descs">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="trx_type">Trx Type</label>
                                                <div class="col-sm-6">
                                                    <select data-placeholder="Choose a Trx Type" class="select2 form-control" id="trx_type" name="trx_type">
                                                        <option value=""></option>
                                                        <?php echo $data_trx ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="tax_cd">Tax Code</label>
                                                <div class="col-sm-6">
                                                    <select data-placeholder="Choose a Tax Code" class="select2 form-control" id="tax_cd" name="tax_cd">
                                                        <option value=""></option>
                                                        <?php echo $data_tax ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="type">Zone Code</label>
                                                <div class="col-sm-6">
                                                    <select data-placeholder="Choose a Zone Code" class="select2 form-control" id="type" name="type">
                                                        <option value=""></option>
                                                        <option value="C">By Zone</option>
                                                        <option value="L">By Area</option>  
                                                    </select>
                                                </div>
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
                                              <th>Project No</th>
                                              <th>Project Description</th>
                                              <th>Type</th>
                                              <th>Rate</th>
                                              <th>Description</th>
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


<!-- link -->
  <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>

  <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 

  <script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
  <!-- date-range-picker -->
  <script src="<?=base_url('js/plugins/fullcalendar/moment.min.js')?>"></script>
  <script src="<?=base_url('js/plugins/daterangepicker/daterangepicker.js')?>"></script>
  <script type="text/javascript" src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>

  <!-- datatables -->
  <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<!-- end link -->

<!-- script -->
    <script>
        $("#btnback").click(function(){
          // alert('a');
          location.href = "<?php echo base_url("c_setting_ot"); ?>";
        })
        $("#btnbac").click(function(){
          // alert('a');
          location.href = "<?php echo base_url("c_setting_ot"); ?>";
        })

        loaddata();

        ccc = <?php echo $this->uri->segment(3) ?>;
        if (typeof ccc !== 'undefined') {
            if (ccc == "0") {
              $('#meterDtl').hide();
              $('#over').show();
            }else{
              $('#meterDtl').show();
              // $('#over').hide();
              $('#over_cd').prop('readonly',true);
            }
        }

        $(document).ready(function(){
            tblcategory.on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {
                    tblcategory.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            // $("#modal").on("hidden.bs.modal", function(){
            //     $("#modalbody").html("");
            // });

            $("#trx_type").select2({
                width:"100%"
            });
            $("#tax_cd").select2({
                width:"100%"
            });
            $("#zone_cd").select2({
                width:"100%"
            });

            $("#frmEditor").validate({
                // ignore:"",
                rules: {
                  over_cd: {
                    required: true,
                    maxlength: 4,
                  },
                  descs: {
                    maxlength:60,
                  }
                },
                messages: {
                  
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
                    } else if (element.hasClass('select2')){
                        error.insertAfter(element.next('span'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            }); //end form editor

            $('#btnSave').click(function(){
                block(true);
                var id = "<?php echo $this->uri->segment(3) ?>";
                // alert(id);
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push({name:"id",value:id})

                $.ajax({
                    url : "<?php echo base_url('C_Setting_ot/save_OTType');?>",
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
                            }).then(function () {
                                location.href = "<?php echo base_url("c_setting_ot"); ?>";  
                            });
                            // $('#modal').modal('hide');
                            // tblottype.ajax.reload(null,true);
                            
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

            $('#add').click(function(){
            // var rowID = 0;
            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaldialog').addClass('modal-md');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Add Detail');
            $('#modalbody').load("<?php echo base_url("c_setting_ot/addOTTDtl")?>");

            $('#modal').data('rowID', 0);
            // $('#modal').data('entity_cd',"<?php echo $this->session->userdata('Tsentity'); ?>");
            // $('#modal').data('project_no',"<?php echo $this->session->userdata('Tsproject'); ?>");
            $('#modal').data('over_cd',"<?php echo $over_cd; ?>");
            // var cd = "<?php echo $over_cd; ?>"
            // alert(cd);

            $('#modal').modal('show');
          })

          $('#edit').click(function(){
            var rows = tblcategory.rows('.selected').indexes();
            
            if (rows.length < 1) {
              swal("Information",'Please select a row',"warning");
              return;
            }

            var data = tblcategory.rows(rows).data();
            var rowID = data[0].rowID;
            $('#modal').data('rowID', rowID);
            // console.log(rowID);
            var category_cd = "<?php echo $this->uri->segment(3); ?>";
            // console.log(category_cd);

            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaldialog').addClass('modal-md');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit Detail');
            $('#modalbody').load("<?php echo base_url("c_setting_ot/addOTTDtl")?>");

            $('#modal').data('over_cd',"<?php echo $over_cd; ?>");
            $('#modal').modal('show');
          })

          $('#delete').click(function(){
            var rows = tblcategory.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 

            var data = tblcategory.rows(rows).data();
            var rowID = data[0].rowID;

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
                    Delete(rowID,'ot_rate',tblcategory)
                }
            })
        })

        })//end doc ready


        function Delete(id,table,reload) {
            var data = [];
            data.push({ name:'id', value:id },{ name:'table', value:table })
            $.ajax({
                url : "<?php echo base_url('c_setting_ot/delete');?>",
                type:"POST",
                data: data,
                dataType:"json",
                success:function(event, data){
                    swal("Information",event.Pesan,"warning");
                    $('#modal').modal('hide');
                    reload.ajax.reload(null,true);
                },                    
                error: function(jqXHR, textStatus, errorThrown){        
                    swal("Information",textStatus+' Save : '+errorThrown,"warning");
                }
            });
        }

        var cd = "<?php echo $over_cd; ?>";
        // console.log(cd);
        var tblcategory = $('#tblcategory').DataTable({
          "ajax": {
              "url":"<?php echo base_url('c_setting_ot/getTableOTTDtl');?>" + "/" + cd,
              "type":"POST",
          },
          "columns": [
            {data:"row_number",searchable:false,
                 render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }},
            {data:"project_no"},
            {data:"project_descs"},
            {data:"zone_cd"},
            {data:"rate"},
            {data:"rate_descs"},
            {data:"rowID",visible:false},
          ],
          "language": {
              "decimal": ",",
              "thousands": ".",
          },
          "dom": '<"toolbar tblcategory">frtip',
        });

        function loaddata(){
            var rowID = <?php echo $this->uri->segment(3) ?>;
            if (rowID > 0) {
                // block(true);
                $.getJSON("<?php echo base_url('C_Setting_ot/getByIDOTType');?>" + "/" + rowID, function (data) {
                    $('#over_cd').val(data[0].over_cd);
                    $('#descs').val(data[0].descs);
                    $('#trx_type').val(data[0].trx_type).trigger("change");
                    $('#tax_cd').val(data[0].tax_cd).trigger("change");
                    $('#type').val(data[0].type).trigger("change");
                    $('#rowID').val(data[0].rowID);
                    block(false);
                });
            }
        }

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
    </script>
<!-- end script