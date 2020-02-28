.<!-- style -->
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
      <label for="line_no" class="col-sm-12 control-label">Line No</label>
      <div class="col-sm-12">
        <input type="number" class="form-control pull-right" id="line_no" name="line_no" placeholder="Line No">
      </div>
    </div>

    <div class="form-group">
      <label for="start_range" class="col-sm-12 control-label">Start Range</label>
      <div class="col-sm-12">
        <input type="text" placeholder="Start range" class="form-control pull-right" id="start_range" name="start_range">  
      </div>
    </div>

    <div class="form-group">
      <label for="end_range" class="col-sm-12 control-label">End Range</label>
      <div class="col-sm-12">
        <input type="number" class="form-control pull-right" placeholder="End Range" id="end_range" name="end_range">  
      </div>
    </div>

    <div class="form-group">
      <label for="capacity_multiplier" class="col-sm-12 control-label">Capacity Multiplier</label>
      <div class="col-sm-12">
        <input type="number" class="form-control pull-right" id="capacity_multiplier" name="capacity_multiplier" placeholder="Capacity Multiplier">  
      </div>
    </div>

    <div class="form-group">
      <label for="low_rate" class="col-sm-12 control-label">Low Rate</label>
      <div class="col-sm-12">
        <input type="number" class="form-control pull-right" id="low_rate" name="low_rate" placeholder="Low Rate">  
      </div>
    </div>

    <div class="form-group">
      <label for="high_rate" class="col-sm-12 control-label">High Rate</label>
      <div class="col-sm-12">
        <input type="number" class="form-control pull-right" id="high_rate" name="high_rate" placeholder="High Rate">  
      </div>
    </div>

    <div class="form-group">
      <label for="rate_factor" class="col-sm-12 control-label">Rate Factor</label>
      <div class="col-sm-12">
        <input type="number" class="form-control pull-right" id="rate_factor" name="rate_factor" placeholder="Rate Factor">  
      </div>
    </div>

  </div>
  </form>
<!-- end form -->

<!-- script -->
  <script type="text/javascript">
    $("#btnback").click(function(){
      // alert('a');
      location.href = "<?php echo base_url("c_meter_category"); ?>";
    })

    loaddata();

    $(document).ready(function () {
      $("#calculation_method").select2({
        width:"100%"
      }); 
      $("#frmEditor").validate({
        // ignore:"",
        rules: {
          line_no: {
            required: true,
            maxlength:10
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
          var rowID       = "<?php echo $rowID; ?>";
          var category_cd = "<?php echo $category_cd ?>";
          // console.log(category_cd);
          var entity_cd   = "<?php echo $entity_cd; ?>";
          var project_no  = "<?php echo $project_no; ?>";
          // var int = $('.pro:checked').length
          var datafrm = $('#frmEditor').serializeArray();
          datafrm.push(
            {name:"rowID",value:rowID},
            {name:"category_cd",value:category_cd},
            {name:"entity_cd",value:entity_cd},
            {name:"project_no",value:project_no}
          )
          $.ajax({
            url : "<?php echo base_url('c_meter_category/savedtl');?>",
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
                // $('.modal').replaceClass('show','toggle');
                tblcategory.ajax.reload(null,true);
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
                tblcategory.ajax.reload(null,true);
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
      var rowID = "<?php echo $rowID; ?>";
      var category_cd = "<?php echo $category_cd; ?>";
      var project_no = "<?php echo $project_no; ?>";
      var entity_cd = "<?php echo $entity_cd; ?>";
      // alert($('#modal').data('rowID'));
      // console.log(category_cd);

      if (rowID > 0) {
        $.getJSON("<?php echo base_url('c_meter_category/getByrowID');?>"+"/"+rowID, function (data) {
          // console.log(data);
          // $('#entity_cd').val(data[0].entity_cd);
          // $('#project_no').val(data[0].project_no);
          // $('#category_cd').val(data[0].category_cd);
          $('#line_no').val(data[0].line_no);
          $('#start_range').val(data[0].start_range);
          $('#end_range').val(data[0].end_range);
          $('#capacity_multiplier').val(data[0].capacity_multiplier);
          $('#low_rate').val(data[0].low_rate);
          $('#high_rate').val(data[0].high_rate);
          $('#rate_factor').val(data[0].rate_factor);
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