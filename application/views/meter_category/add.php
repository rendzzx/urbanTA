<!-- link -->
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
        </div> <!-- content-header-left -->
      </div> <!-- content-header row -->

      <div class="content-body">
        <!-- header -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Meter Category</h4>
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
                  <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <input type="hidden" name="cd" id="cd" value="<?php echo $this->uri->segment(3) ?>">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="category_cd" class="col-sm-2 control-label">Category Code</label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control pull-right" id="category_cd" name="category_cd" placeholder="Category Code">  
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="category_name" class="col-sm-2 control-label">Category Name</label>
                        <div class="col-sm-6">
                          <input type="text" placeholder="Category Name" class="form-control pull-right" id="category_name" name="category_name">  
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="capacity_rate" class="col-sm-2 control-label">Capacity Rate</label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control pull-right" placeholder="Capacity Rate" id="capacity_rate" name="capacity_rate">  
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Calculation Method</label>
                        <div class="col-sm-6">
                          <select name="calculation_method" id="calculation_method" data-placeholder="Choose a Method..." class="form-control select2" tabindex="2">
                            <option value=""></option>
                            <option value="1">Proportion</option>
                            <option value="2">Balance</option>
                            <option value="3">Dual Meter</option>
                            <option value="7">Dual Portion</option>
                            <option value="8">Dual Portion Plus</option>
                          </select>
                        </div>
                      </div>

                     <div class="form-group pb-1">
                        <div class="col-sm-4">
                          <input type="checkbox" id="capacity_given_flag" name="capacity_given_flag" class="switchery" data-color="primary" data-secondary-color="primary" value="Y" />&nbsp;&nbsp;
                          <label for="capacity_given_flag">Capacity Limit</label>
                        </div>                                
                      </div>

                      <div class="form-group pb-1">
                        <div class="col-sm-4">
                          <input type="checkbox" id="limit_usage_flag" name="limit_usage_flag" class="switchery" data-color="primary" data-secondary-color="primary" value="Y" />&nbsp;&nbsp;
                          <label for="limit_usage_flag">Usage Limit</label>
                        </div>                                
                      </div>

                      <div class="form-group">
                        <label for="disc_percent" class="col-sm-2 control-label">Discount Rate</label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control pull-right" id="disc_percent" name="disc_percent" placeholder="Discount Rate">  
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="opr_percent" class="col-sm-2 control-label">Opr Rate</label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control pull-right" id="opr_percent" name="opr_percent" placeholder="OPR Rate">  
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="min_usage_hour" class="col-sm-2 control-label">Min Usage/h</label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control pull-right" id="min_usage_hour" name="min_usage_hour" placeholder="Min Usage Per Hour">  
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="portion1" class="col-sm-2 control-label">Portion 1</label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control pull-right" id="portion1" name="portion1" placeholder="Portion 1">  
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="portion2" class="col-sm-2 control-label">Portion 2</label>
                        <div class="col-sm-6">
                          <input type="number" class="form-control pull-right" id="portion2" name="portion2" placeholder="Portion 2">  
                        </div>
                      </div>

                      <!-- <div class="form-group">
                        <label for="project_no" class="col-sm-2 control-label">Project No</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control pull-right" id="project_no" name="project_no" placeholder="Portion 2">  
                        </div>
                      </div> -->

                    </div> <!-- box body end -->
                    
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

        <!-- detail -->
        <div class="row" id="meterDtl">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Meter Category Detail</h4>
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
                    <!-- <button id="delete" class="btn btn-danger" disabled onclick="deleteov()">Delete</button> <br> -->
                  </div> <!-- button -->
                  <table id="tblcategory" class="table table-striped table-bordered base-style table-hover dataTables" cellspacing="0">  
                    <thead> 
                      <tr>
                          <th>No.</th>          
                          <!-- <th class="sorting_asc">Action</th> -->
                          <th>Line No</th>
                          <th>Start Range</th>
                          <th>End Range</th>
                          <th>Capacity Multiplier</th>
                          <th>Low Rate</th>
                          <th>High Rate</th>
                          <th>Rate Factor</th>
                          <th hidden="true">Row ID</th>
                      </tr> 
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div> <!-- card-body dashboard -->
              </div> <!-- card-content show -->
            </div> <!-- card -->
          </div> <!-- col-12 -->
        </div> <!-- row -->
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
  <script type="text/javascript">

    $("#btnback").click(function(){
      // alert('a');
      location.href = "<?php echo base_url("c_meter_category"); ?>";
      })

    loaddata();

    $(document).ready(function(){
      tblcategory.on('click', 'tr', function() {
          if ($(this).hasClass('selected')) {
              $(this).removeClass('selected');
          } else {
              tblcategory.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
          }
      });  

      $("#calculation_method").select2({
        width:"100%"
      }); 

      $("#frmEditor").validate({
        // ignore:"",
        rules: {
          category_cd: {
            required: true,
            maxlength:20
          },
          category_name: {
            required: true
          },
          capacity_rate:{
            maxlength:19
          },
          disc_percent: {
            max:100
          },
          opr_percent:{
            max:100
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
      });

      $('#btnSave').click(function(){
        // document.getElementById('loader').hidden=false;
        // block(true)
        if($('#frmEditor').valid()){
          var cd = $('#category_cd').val();
          // console.log(cd);
          var datafrm = $('#frmEditor').serializeArray();
          datafrm.push({name:"category_cd",value:cd});
               
          $.ajax({
            url : "<?php echo base_url('c_meter_category/save');?>",
            type:"POST",
            data: datafrm,
            dataType:"json",
            success:function(event, data){
              if(event.status=='OK'){
                block(false)
                swal({
                  title: "Information",
                  animation: true,
                  type:"success",
                  text: event.Pesan,
                  confirmButtonText: "OK"
                });
                  // document.getElementById('loader').hidden=true;
                  // $('#modal').modal('hide');
                  // tblnewsfeed.ajax.reload(null,true);
              }else {
                block(false)
                swal({
                  title: "Error 1",
                  animation: true,
                  type:"error",
                  text: event.Pesan,
                  confirmButtonText: "OK"
                });
                // document.getElementById('loader').hidden=true;
              } 
            },error: function(jqXHR, textStatus, errorThrown){
              block(false)
              swal({
                title: "Error 2",
                animation: false,
                type:"error",
                text: textStatus+' Save : '+errorThrown,
                confirmButtonText: "OK"
              });
                // document.getElementById('loader').hidden=true;
              }
          });     
        }
      });

      $('#add').click(function(){
        var rowID = 0;
        var category_cd = "<?php echo $this->uri->segment(3); ?>";

        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaldialog').addClass('modal-md');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Add Detail');
        $('#modalbody').load("<?php echo base_url("c_meter_category/adddtl")?>"+"/"+rowID+"/"+category_cd);

        // $('#modal').data('rowID', 0);
        // $('#modal').data('entity_cd',"<?php echo $this->session->userdata('Tsentity'); ?>");
        // $('#modal').data('project_no',"<?php echo $this->session->userdata('Tsproject'); ?>");
        // $('#modal').data('category_cd',"<?php echo $this->uri->segment(3); ?>");

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
        $('#modalbody').load("<?php echo base_url("c_meter_category/adddtl")?>"+"/"+rowID+"/"+category_cd);


        $('#modal').modal('show');
      })

      $('#delete').click(function(){
        var rows = tbluser.rows('.selected').indexes();

        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 

        var data = tbluser.rows(rows).data();
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
            Delete(rowID,'pm_meter_category_dtl',tblcategory);
          }
        })
      })
      
      // $('#modal').on('hidden.bs.modal', function (e) {
      //   $(this).removeData();
      // });
    });

    var cd = document.getElementById('cd').value;
    // console.log(cd);
    var tblcategory = $('#tblcategory').DataTable({
      "ajax": {
          "url":"<?php echo base_url('c_meter_category/getTableDtl');?>" + "/" + cd,
          "type":"POST",
      },
      "columns": [
        {data:"row_number",searchable:false,
             render: function (data, type, row) {
                var row_number = row.row_number
                return row_number + '.'
            }},
        {data:"line_no"},
        {data:"start_range"},
        {data:"end_range"},
        {data:"capacity_multiplier"},
        {data:"low_rate"},
        {data:"high_rate"},
        {data:"rate_factor"},
        {data:"rowID",visible:false},
      ],
      "language": {
          "decimal": ",",
          "thousands": ".",
      },
      "dom": '<"toolbar tblcategory">frtip',
    });

    function loaddata(){
      var category_cd = <?php echo $this->uri->segment(3); ?>;
      // console.log(category_cd);

      if (category_cd > 0) {
        $.getJSON("<?php echo base_url('c_meter_category/getByID');?>" + "/" + category_cd, function (data) {
          // console.log(data);
          // $('#entity_cd').val(data[0].entity_cd);
          // $('#project_no').val(data[0].project_no);
          $('#category_cd').val(data[0].category_cd);
          $('#category_name').val(data[0].category_name);
          $('#capacity_rate').val(data[0].capacity_rate);
          $('#calculation_method').val(data[0].calculation_method).trigger('change');

          if (data[0].capacity_given_flag=="Y") {
            $('#capacity_given_flag').attr('checked',true);
          }
          if (data[0].limit_usage_flag=="Y") {
            $('#limit_usage_flag').attr('checked',true);
          }

          $('#disc_percent').val(data[0].disc_percent);
          $('#opr_percent').val(data[0].opr_percent);
          $('#min_usage_hour').val(data[0].min_usage_hour);
          $('#portion1').val(data[0].portion1);
          $('#portion2').val(data[0].portion2);
          // $('#project_no').val(data[0].limit_usage_flag);
        });
      }
    }

    // $('#meterDtl').toggle(cd);
    ccc = $('#cd').val();
    if (ccc == "0") {
      $('#meterDtl').hide();
    }else{
      $('#meterDtl').show();
    }

    function block(boelan){
      var block_ele = $('#form_nup')
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