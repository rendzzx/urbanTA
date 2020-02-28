      
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
        <input type="hidden" name="txtGroupID" id="txtGroupID" class="form-control">
      </div>
      <div class="form-group">
        <label for="GroupCD" class="col-xs-8">Group Code</label>
        <div class="col-xs-8">
          <input type="text" class="form-control" name="txtGroupCD" id="txtGroupCD" placeholder="Group Code">
        </div>
      </div>
      <div class="form-group">
        <label for="GroupDescs" class="col-xs-8 control-label">Group Description</label>
        <div class="col-xs-8">
          <input type="text" class="form-control" name="txtGroupDescs" id="txtGroupDescs" placeholder="Group Description">
        </div>
      </div>
      <!-- <div class="form-group">
        <label for="GroupDescs" class="col-xs-8 control-label">Dashboard URL</label>
        <div class="col-xs-8">
          <input type="text" class="form-control" name="dashboard" id="dashboard" placeholder="Dashboard URL">
        </div>
      </div> -->
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

   $('#savefrm').click(function(event){
    event.preventDefault();
    if (event.handled !== true) {
        event.handled = true;
         if ($('#frmEditor').valid()) {
         // document.getElementById('loader').hidden=false;
         block(true);
         var id = $('#modal').data('rowID');
         var datafrm = $('#frmEditor').serializeArray();
         $.ajax({
            url : "<?php echo base_url('c_group/save');?>",
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

          txtGroupCD: {
            required: true,
            maxlength:10
          },
          txtGroupDescs:{
            required:true
          },
         
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
        var GroupID = $('#modal').data('groupID');
        console.log(GroupID)


        if (GroupID > 0) {
          $.getJSON("<?php echo base_url('c_group/getByID');?>" + "/" + GroupID, function (data) {

            $('#txtGroupID').val(data[0].GroupID);
            $('#txtGroupCD').val(data[0].group_cd);
            $('#txtGroupDescs').val(data[0].group_descs);
            $('#dashboard').val(data[0].dashboard_url);
            });
        }
      }

      $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
      });
    </script>