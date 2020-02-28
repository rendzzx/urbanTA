      
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<!-- daterange picker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/daterangepicker/daterangepicker-bs3.css')?>">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" >

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
    /*label {text-align: right;}
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
      }*/
    </style>
<!-- <style type="text/css">
  .has-error .select2_demo_1-selected {
      border: 1px solid #a94442;
      border-radius: 4px;
      color: red;
    }

    .has-error .checkbox-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }

    .has-error .radio-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
    label {text-align: right;}
  </style> -->

  
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
    </div>   
    <!-- <div class="modal-footer">
      <button type="button" id="btnSave" class="btn btn-primary">Save</button>
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div> -->
      </form>



    <!-- Select2 -->
    <!-- <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script> -->
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
    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">


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


      $("#frmEditor").validate({
        rules: {
          // txtGroupID: {
          //   required:true,
          //   max:4
          // }
          txtGroupCD: {
            required: true
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

    $(document).ready(function () {
      loaddata();

      $('#btnSave').click(function(){
      // alert('a');
      var groupcd = $('#txtGroupCD').val();
      var groupdescs = $('#txtGroupDescs').val();
      // if(ParentID=="" && title.length>15) {
      //   swal("Information", "Menu Title can't be more than 15 characters!","warning");
      //   return;
      // }
      if($('#frmEditor').valid()){
        var GroupID = $('#modal').data('GroupID');      
        var datafrm = $('#frmEditor').serializeArray();
        datafrm.push({name:"GroupID",value:GroupID});
        var obj = new Object();
        obj.id = GroupID;
        $.ajax({
          url : "<?php echo base_url('c_menu_approval/save_menu');?>",
          type:"POST",
          data: $('#frmEditor').serialize() + '&' + $.param(obj),
          dataType:"json",
          success:function(event, data){
            if(event.St=="OK"){
              swal("Information",event.Pesan,"success");
              $('#modal').modal('hide');
            }else{
              swal("Information",event.Pesan,"warning");
            }

                // alert(event.Pesan);
                document.getElementById('loader').hidden=false;
                var state = document.readyState
                if (state == 'complete') {
                  setTimeout(function(){
                    document.getElementById('interactive');
                    tblnewsfeed.ajax.reload(null,true); 
                    document.getElementById('loader').hidden=true;
                  },1000);
                }
                
              },                    
              error: function(jqXHR, textStatus, errorThrown){
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                // alert(textStatus+' Save : '+errorThrown);
              }
            });                
      }
    });
      });

      // function setparentid(MenuID){        

      //   var site_url = '<?php echo base_url("c_menu_approval/zoom_parentid_from")?>';
      //   $.post(site_url,
      //     {MenuID:MenuID},
      //     function(data,status) {
      //       $("#txtParentID").empty();
      //       $("#txtParentID").append('<option value="0">Parent Menu</option> '); 
      //       $("#txtParentID").append(data);                
      //       $("#txtParentID").trigger('change');
      //     }
      //     );
      // }

      function loaddata(){
        var GroupID = $('#modal').data('groupID');
        console.log(GroupID)
        // <?php echo $this->uri->segment(3) ?>
        // 
        // alert(GroupID);
        // ScreenID = GroupID;
        


        if (GroupID > 0) {
          $.getJSON("<?php echo base_url('c_menu_approval/getByID');?>" + "/" + GroupID, function (data) {

            $('#txtGroupID').val(data[0].GroupID);
            $('#txtGroupCD').val(data[0].group_cd);
            $('#txtGroupDescs').val(data[0].group_descsL);
            });
        }
      }

      // $('#modal').one('hidden.bs.modal', function (e) {
      //   $(this).removeData();
      // });
    </script>