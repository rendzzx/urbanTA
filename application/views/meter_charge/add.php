      
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

<!--       <div class="form-group" id="div_entity">
        <label for="GroupCD" class="col-xs-8">Entity Code</label>
        <div class="col-xs-8">
          <input type="text" class="form-control" name="entity" id="entity" placeholder="Entity Code" readonly>
        </div>
      </div>
      <div class="form-group" id="div_project">
        <label for="GroupCD" class="col-xs-8">Project No.</label>
        <div class="col-xs-8">
          <input type="text" class="form-control" name="project" id="project" placeholder="Project No" readonly>
        </div>
      </div> -->
      <label for="GroupCD"><h4>Generation Charges</h4></label>
      <div class="form-group">
        <label for="GroupCD">Generation Charges</label>
        <div class="col-12 row">
          <input type="number" step="0.0001" max="100" class="form-control col-3" name="gen_chrg" id="gen_chrg" placeholder="0.0000"><span style="padding:10px;">%</span>
           <input type="text" class="form-control col-8" name="gen_desc" id="gen_desc" placeholder="Generation Description">
        </div>
      </div>
      <label for="GroupCD"><h4>Distribution Charges</h4></label>
      <div class="form-group">
        <label for="GroupCD">First Charges</label>
        <div class="col-12 row">
          <input type="number" step="0.0001" max="100" class="form-control col-3"  name="dem_chrg" id="dem_chrg" placeholder="0.0000"><span style="padding:10px;">%</span>
           <input type="text" class="form-control col-8" name="dem_desc" id="dem_desc" placeholder="Distribution Description">
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
  //disallow text for input type number
  $(':input[type="number"]').on('change keyup', function() {
  
    var sanitized = $(this).val().replace(/[^-.0-9]/g, '');
    sanitized = sanitized.replace(/(.)-+/g, '$1');
    sanitized = sanitized.replace(/\.(?=.*\.)/g, '');

    $(this).val(sanitized);
  });

  loaddata();

   $('#savefrm').click(function(event){

    event.preventDefault();
    if (event.handled !== true) {
        event.handled = true;
         // if ($('#frmEditor').valid()) {
         // document.getElementById('loader').hidden=false;
         block(true);
          var entity = $('#modal').data('entity_cd');
          var project = $('#modal').data('project_no');
          var datafrm = $('#frmEditor').serializeArray();
          datafrm.push({name:"entity",value:entity},{name:"project",value:project})
          console.log(datafrm);//return;
         $.ajax({
            url : "<?php echo base_url('c_meter_charge/save');?>",
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
                    if(event.St=="exist"){
                      $('#modal').modal('hide');
                       tblgroup.ajax.reload(null,true);
                    }
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
     // }else{
     //  block(false);
     // }
    }
  });
   // $("#frmEditor").validate({
   //      rules: {

   //        txtGroupCD: {
   //          required: true,
   //          maxlength:10
   //        },
   //        txtGroupDescs:{
   //          required:true
   //        },
         
   //      },
   //      errorElement: "span",
   //      highlight: function (element, errorClass, validClass) {
   //        $(element).addClass(errorClass); //.removeClass(errorClass);
   //        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
   //      },
   //      unhighlight: function (element, errorClass, validClass) {
   //        $(element).removeClass(errorClass); //.addClass(validClass);
   //        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
   //      },
   //      errorPlacement: function (error, element) {
   //        if (element.parent('.input-group').length) {
   //          error.insertAfter(element.parent());
   //        } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
   //          error.insertAfter(element.next('span'));
   //        } else {
   //          error.insertAfter(element);
   //        }
   //      }
   //    });
});


      function loaddata(){
        var entity = $('#modal').data('entity_cd');
        var project = $('#modal').data('project_no');



        if (entity == 0 && project == 0) {
          // $('#div_entity').hide()
          // $('#div_project').hide()
          // $('#entity').val(entity);
          // $('#project').val(project);
          // $('#entity').attr('readonly',false);
          // $('#project').attr('readonly',false);

          
        }else{
          // $('#entity').val(entity);
          // $('#project').val(project);
          $.getJSON("<?php echo base_url('c_meter_charge/getByCrit');?>" + "/" + entity+ "/" + project, function (data) {
            // console.log(data);
            $('#gen_chrg').val(parseFloat(data[0].gen_chrg).toFixed(4));
            $('#gen_desc').val(data[0].gen_desc);
            $('#dem_chrg').val(parseFloat(data[0].dem_chrg).toFixed(4));
            $('#dem_desc').val(data[0].dem_desc);
            });
        }
      }

      $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
      });
    </script>