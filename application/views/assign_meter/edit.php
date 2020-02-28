<!-- link -->
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
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
  </style>
<!-- end style -->

<!-- form -->
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="cd" id="cd" value="<?php echo $this->uri->segment(3) ?>">
        <div class="box-body">

            <div class="form-group">
                <label for="meter_cd" class="col-sm-12 control-label">Meter Type</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="4" class="form-control" id="meter_cd" name="meter_cd" placeholder="Meter Type">
                </div>
            </div>

            <div class="form-group">
                <label for="descs" class="col-sm-12 control-label">Description</label>
                <div class="col-sm-12">
                  <input type="text" placeholder="Start range" class="form-control" id="descs" name="descs" readonly="true">
                </div>
            </div>

            <div class="form-group">
                <label for="meter_id" class="col-sm-12 control-label">Meter ID</label>
                <div class="col-sm-12">
                  <input type="text" maxlength="20" class="form-control" placeholder="Meter ID" id="meter_id" name="meter_id">  
                </div>
            </div>

            <div class="form-group">                        
                <div class="col-sm-12">
                    <label for="lot_no" class="col-sm-12 control-label">Lot No</label>
                    <select name="lot_no" id="lot_no" data-placeholder="Choose a Lot No..." class="select2_demo_1 form-control" style="width:250px;" tabindex="2">
                         <?php echo $lot?>
                    </select>
                </div>
            </div>

            <div class="form-group">                        
                <div class="col-sm-12">
                    <label for="debtor_acct" class="col-sm-12 control-label">Debtor Account</label>
                    <select name="debtor_acct" id="debtor_acct" data-placeholder="Choose a Debtor Account..." class="select2_demo_1 form-control" style="width:250px;" tabindex="2">
                        <?php echo $debtor?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="apportion" class="col-sm-12 control-label">% Apportion</label>
                <div class="col-sm-12">
                  <input type="number" class="form-control" id="apportion" name="apportion" placeholder="Apportion %">  
                </div>
            </div>

            <div class="form-group">
                <label for="capacity" class="col-sm-12 control-label">Capacity (KVA)</label>
                <div class="col-sm-12">
                  <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity (KVA)">  
                </div>
            </div>

            <div class="form-group">
                <label for="capacity_limit" class="col-sm-12 control-label">Capacity Limit (KVA)</label>
                <div class="col-sm-12">
                  <input type="number" class="form-control" id="capacity_limit" name="capacity_limit" placeholder="Capacity Limit (KVA)">  
                </div>
            </div>
        </div>
    </form>
<!-- end form -->


<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>


<!-- script -->
    <script type="text/javascript">

        loaddata();

        $(document).ready(function () {

            $("#lot_no").select2({
                width:"100%"
            });
              $("#debtor_acct").select2({
                width:"100%"
            });
            $("#frmEditor").validate({
                // ignore:"",
                rules: {
                    meter_cd: {
                        required: true,
                    },
                    meter_id: {
                        required: true,
                    },
                    apportion: {
                        max:100,
                    },
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

            $('#savefrm').click(function(){
                block(true);
                // console.log(category_cd);
                var entity      = "<?php echo $this->session->userdata('Tsentity'); ?>";
                var project     = "<?php echo $this->session->userdata('Tsproject'); ?>";
                var rowID       = $('#modal').data('rowID');
                // var int = $('.pro:checked').length
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push(
                    {name:"entity_cd",value:entity},
                    {name:"project_no",value:project},
                    {name:"rowID",value:rowID}
                )
                $.ajax({
                    url : "<?php echo base_url('c_assign_meter/save');?>",
                    type:"POST",
                    data:datafrm,
                    dataType:"json",
                    success:function(event, data){
                        if(event.status==true){
                            block(false);
                            swal({
                                title: "Information",
                                animation: false,
                                type:"success",
                                text: event.Pesan,
                                confirmButtonText: "OK"
                            });
                            $('#modal').modal('hide');
                            tblnewsfeed.ajax.reload(null,true);
                        }
                        else {
                            block(false);
                            swal({
                                title: "Error",
                                animation: false,
                                type:"error",
                                text: event.Pesan + "status = false",
                                confirmButtonText: "OK"
                            });
                            $('#modal').modal('hide');
                            // $('.modal').replaceClass('show','toggle');
                            tblnewsfeed.ajax.reload(null,true);
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
            }) // end save form

        }); //end documet ready

        function loaddata(){

            var cd = $('#modal').data('meter_cd');
            var id = $('#modal').data('meter_id');
            var no = $('#modal').data('line_no');
            // alert($('#modal').data('meter_cd'));
            // console.log(category_cd);

            if (no > 0) {
                $.getJSON("<?php echo base_url('c_assign_meter/getByID');?>"+"/"+ cd +"/"+ id +"/"+no, function (data) {
                    // console.log(data);
                    // $('#entity_cd').val(data[0].entity_cd);
                    // $('#project_no').val(data[0].project_no);
                    // $('#category_cd').val(data[0].category_cd);
                    $('#meter_cd').val(data[0].meter_cd);
                    $('#descs').val(data[0].descs);
                    $('#meter_id').val(data[0].meter_id);
                    $('#lot_no').val(data[0].lot_no);
                    $('#debtor_acct').val(data[0].debtor_acct);
                    $('#apportion').val(data[0].apportion);
                    $('#capacity').val(data[0].capacity);
                    $('#capacity_limit').val(data[0].capacity_limit);
                    $('#lot_no').val(data[0].lot_no);
                    $('#rowID').val(data[0].rowID);
                });
            }
        }

        $('#modal').on('hidden.bs.modal', function (e) {
          $(this).removeData();
        });

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
<!-- end script -->