      
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<!-- daterange picker -->


<!-- Bootstrap time Picker -->
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

</style>


  
  <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <div class="box-body">
      <div class="form-group">
        <input type="hidden" name="txtrowID" id="txtrowID" class="form-control">
      </div>
      <div class="form-group">
        <label for="max_size">Max Upload Size</label>
        <div class="row col-12" style="margin-right: 0px;margin-left: 0px;padding-left: 0px;padding-right: 0px;">
          <div class="col-8" style="padding-left: 0px">
            <input type="text" class="form-control" name="max_size" id="max_size" placeholder="Max Upload Size">
          </div>
          <div class="col-4" style="padding: 0px">
            <select data-placeholder="Choose Size" class="select2 form-control" id="max_type" name="max_type">
                <option value=""></option>
                <option value="kb">Kb</option>
                <option value="mb">Mb</option>
                <option value="gb">Gb</option>
            </select>
          </div>
          
        </div>
        
      </div>
      <div class="form-group">
        <label for="email" class="col-xs-8 control-label">Email S+</label>
        <div class="col-xs-12">
          <input type="text" class="form-control" name="email" id="email" placeholder="Email S+">
        </div>
      </div>
    
    </div>   

      </form>



    <!-- Select2 -->
    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>

    <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>

    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>



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


      var menuid = $('#modal').data('MenuID');
      jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
      });
      $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });


      

$(document).ready(function () {
  loaddata();
  $(".select2").select2();
   $('#savefrm').click(function(event){
    event.preventDefault();
    if (event.handled !== true) {
        event.handled = true;
         if ($('#frmEditor').valid()) {
         // document.getElementById('loader').hidden=false;
         block(true);
         var id = $('#modal').data('rowID');
         var datafrm = $('#frmEditor').serializeArray();
         // console.log(datafrm);
         // return;
         $.ajax({
            url : "<?php echo base_url('c_sys_spec/save');?>",
            type:"POST",
            data: datafrm,
            dataType:"json",
            success:function(event, data){
                if (event.St == 'OK') {
                    swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                    $('#modal').modal('hide');
                    tblgroup.ajax.reload(null,true);
                }else{
                    swal({
                        title: "Information",
                        animation: false,
                        type:"error",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                }
                block(false);
            },error: function(jqXHR, textStatus, errorThrown){
                swal({
                  title: "Error",
                  animation: false,
                  type:"error",
                  text: textStatus+' Save : '+errorThrown,
                  confirmButtonText: "OK"
              });
                block(false);
            }
        });
     }else{
      block(false);
     }
    }
  });
   $("#frmEditor").validate({
        rules: {

          max_size: {
            required: true,
            maxlength:10,
            number:true
          },
          max_type:{
            required:true
          },
          email:{
            required:true,
            email:true          
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
});


      function loaddata(){
        var rowID = $('#modal').data('rowID');
        console.log(rowID)


        if (rowID > 0) {
          $.getJSON("<?php echo base_url('c_sys_spec/getByID');?>" + "/" + rowID, function (data) {

            $('#txtrowID').val(data[0].rowID);
            $('#max_size').val(data[0].max_upload_size);
            $('#max_type').val(data[0].max_upload_type).trigger('change');
            $('#email').val(data[0].email_splus);
            });
        }
      }

      $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
      });
    </script>