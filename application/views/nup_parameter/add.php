      <!-- 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
<!-- daterange picker -->
<link rel="stylesheet" href="<?=base_url('app-assets/vendors/css/daterangepicker/daterangepicker-bs3.css')?>">
<!-- bootstrap datepicker -->
<link href="<?=base_url('app-assets/vendors/css/select2/select2.min.css')?>" rel="stylesheet">

<link rel="stylesheet" href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" >
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
  <!-- <link rel="stylesheet" href="<?=base_url('css/test/select2.min.css')?>"> -->

<!-- Bootstrap time Picker -->

<!--<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>"></script>
  <script src="<?=base_url('css/test/select2.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>-->

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
    label {text-align: right;}
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
</style>
<!-- <script src="<?=base_url('js/jquery-2.1.1.js')?>"></script> -->


<div id="loader" class="loader" hidden="false"></div>
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="nup_id" class="col-sm-2 control label"></label>
                <input type="hidden" name="txtNupId" id="txtNupId" class="form-control">
            </div>
            <div class="form-group">
                <label for="entity_name" class="col-xs-4">Entity Name</label>
                <div class="col-xs-8">
                    <select name="TxtentityCode" id="TxtentityCode" data-placeholder="Choose a Project..." class="form-control select2" tabindex="2">
                            <option value=""></option>
                            <?php 
                                foreach ($entityData as $row) 
                                          {
                                              echo '<option value="'.$row->entity_cd.'">'.$row->entity_name.'</option>';
                                          }
                            ?> 
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="project_name" class="col-xs-4">Project Name</label>
                <div class="col-xs-8">
                    <!-- <select name="TxtprojectNo" id="TxtprojectNo" data-placeholder="Choose a Project..." class="chosen-select form-control" tabindex="2">
                    <option value=""></option>
                    </select> -->
                    <select name="TxtprojectNo" id="TxtprojectNo" data-placeholder="Choose a Project..." class="form-control select2" tabindex="2">
                    <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="phase_descs" class="col-xs-4">Phase </label>
                <div class="col-xs-8">
                    <!-- <select name="TxtphaseCode" id="TxtphaseCode" data-placeholder="Choose a Project..." class="chosen-select form-control" tabindex="2">
                        <option value=""></option>                                      
                    </select> -->
                    <select name="TxtphaseCode" id="TxtphaseCode" data-placeholder="Choose a Project..." class="form-control select2" tabindex="2">
                        <option value=""></option>                                      
                    </select>

                </div>
            </div>            
            <div class="form-group">
                <label class="col-xs-4">Start and End Date</label>
                <div class="col-xs-8">
                  <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend">
                        <i class="ft-calendar"></i>
                      </span>
                    </div>
                      <!-- <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div> -->
                        <input type="text"  class="form-control pull-right" id="TxtstartEndDate" name="TxtstartEndDate">  
                        <!-- data-mask="99/99/9999 - 99/99/9999"                 -->
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-xs-4 control-label">Status</label>
                <div class="col-xs-8">
                
                    <label class="radio-inline" style="padding-right: 10px;"><input type="radio" name="status" id="1" value="1" checked>Active </label>

                    <label class="radio-inline"><input type="radio" name="status" id="0" value="0">Obsolete </label>   
                    
                </div>   
                <!-- <div class="custom-control custom-radio">
                  <input type="radio" id="1" name="status" value="1" class="custom-control-input bg-primary" checked>
                  <label class="custom-control-label" for="customRadio4">Active</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="0" name="status" value="0" class="custom-control-input bg-primary">
                  <label class="custom-control-label" for="customRadio5">Obsolete</label>
                </div>  -->                            
            </div>
            <div class="form-group">
                <label class="col-xs-4 control-label">Action </label>
                <div class="col-xs-8">
                    <label class="checkbox-inline" style="padding-right: 10px;"><input type="checkbox" name="txtUnitStatus" id="txtUnitStatus">Choose Unit </label>
                    <label class="checkbox-inline"><input type="checkbox" name="txtCancelNUP" id="txtCancelNUP">Cancel NUP</label>   
                    <!-- <label class="checkbox-inline"><input type="checkbox" name="txtRevision" id="txtRevision" >Revision Status </label>     -->
                </div>                                
            </div>        
        </div>                  
    </form>



<!-- Select2 -->

<script src="<?=base_url('app-assets/vendors/js/select2/select2.full.min.js')?>"></script>
<!-- <script src="<?=base_url('js/plugins/select2/select2.js')?>"></script> -->


<!-- date-range-picker -->
<script src="<?=base_url('app-assets/vendors/js/fullcalendar/moment.min.js')?>"></script>
<script src="<?=base_url('app-assets/vendors/js/daterangepicker/daterangepicker.js')?>"></script>
<script type="text/javascript" src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script>

<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url('app-assets/vendors/js/ui/jquery.sticky.js')?>"></script>



            

<script type="text/javascript">
// -----------------Function loading
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
// ------------------------ end function loading

var nup_id = $('#modal').data('nup_id');
// alert(nup_id);
loaddata();
if(nup_id==0){
  // block(true); 
  $("#TxtentityCode").change(function() {
          var ent = $(this).find(':selected').val();          
          if(ent!=='') {
            var site_url = '<?php echo base_url("c_nup_parameter/zoom_project")?>';
            $.post(site_url,
              {ent:ent},
              function(data,status) {
                $("#TxtprojectNo").empty();
                $("#TxtprojectNo").append(data);
                $("#TxtprojectNo").trigger('chosen:updated');
              }
            );
          } else {
            $("#TxtprojectNo").empty();
          }
        });

$("#TxtprojectNo").change(function() {
          var projectNo = $(this).find(':selected').val();          
          if(projectNo!=='') {
            var site_url = '<?php echo base_url("c_nup_parameter/zoom_phase")?>';
            $.post(site_url,
              {projectNo:projectNo},
              function(data,status) {
                $("#TxtphaseCode").empty();
                $("#TxtphaseCode").append(data);
                $("#TxtphaseCode").trigger('chosen:updated');
                // $("#TxtphaseCode").trigger('change');
              }
            );
          } else {
            $("#TxtphaseCode").empty();
          }
        });
  // block(false); 
}

  $(document).ready(function () {
    $("#TxtentityCode").select2({
            dropdownParent: "#modal",
            width:"100%"
        }); 
    $("#TxtprojectNo").select2({
            dropdownParent: "#modal",
            width:"100%"
        }); 
    $("#TxtphaseCode").select2({
            dropdownParent: "#modal",
            width:"100%"
        });
     $("#frmEditor").validate({
            ignore:"",
            rules: {
                TxtentityCode: {
                    required: true
                },
                TxtprojectNo:{
                    required:true
                },
                TxtphaseCode:{
                    required:true
                },
                TxtstartEndDate:{
                  required:true
                  // date:true
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
          } else if (element.hasClass('select2')){
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
        });
     
    $('#btnSave').click(function(){
      if($('#frmEditor').valid()){
        document.getElementById("btnSave").disabled = true;
        document.getElementById('loader').hidden=false;
        var nup_id = $('#modal').data('nup_id');
        var datafrm = $('#frmEditor').serializeArray();
        datafrm.push({name:"nup_id",value:nup_id});
        var obj = new Object();
        obj.id = nup_id;
        
          $.ajax({
            url : "<?php echo base_url('c_nup_parameter/save_nup');?>",
              type:"POST",
              // async: false,
              data: $('#frmEditor').serialize() + '&' + $.param(obj),
              dataType:"json",
              success:function(event, data){
                document.getElementById('loader').hidden=true;
                // console.log(event);
                if(data=='success'){
                  swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: event.Pesan,
                    confirmButtonText: "OK"
                  });
                  // BootstrapDialog.alert(event.Pesan);
                  $('#modal').modal('hide');
                  tblnewsfeed.ajax.reload(null,true);
                } else {
                  swal({
                    title: "Error",
                    animation: false,
                    type:"error",
                    text: event.Pesan,
                    confirmButtonText: "OK"
                  });
                //   BootstrapDialog.show({
                //   type: BootstrapDialog.TYPE_DANGER,
                //   title: 'Error',
                //   message: event.Pesan,
                //   buttons: [{
                //     label: 'OK',
                //     action: function(dialogItself){
                //     dialogItself.close();
                //     }
                //    }]
                // });
                }
              },                    
              error: function(jqXHR, textStatus, errorThrown){
                document.getElementById('loader').hidden=true;
                // alert('data error');
                // BootstrapDialog.alert();
                swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: textStatus+' Save : '+errorThrown,
                    confirmButtonText: "OK"
                  });
              }
          });                
      }
    });
  });

    function setentityname(ent){        
// console.log(ent);
      $("#TxtentityCode").val(ent).trigger('change');
        // var site_url = '<?php // echo base_url("c_nup_parameter/zoom_entity_from")?>';
        //     $.post(site_url,
        //       {ent:ent},
        //       function(data,status) {
        //         console.log(data);
        //         $("#TxtentityCode").empty();
        //         $("#TxtentityCode").append(data);
        //         // $("#TxtentityCode").trigger('chosen:updated');
        //         $("#TxtentityCode").val(ent).trigger('change');
        //       }
        //     );
    }

    function setprojectname(pro){    
      console.log(pro);
        var site_url = '<?php echo base_url("c_nup_parameter/zoom_project_from")?>';
            $.post(site_url,
              {pro:pro},
              function(data,status) {
                $("#TxtprojectNo").empty();
                $("#TxtprojectNo").append(data);
                $("#TxtprojectNo").trigger('change');
              }
            );
    }

    function setphase(pha){
    

        var site_url = '<?php echo base_url("c_nup_parameter/zoom_phase_from")?>';
            $.post(site_url,
              {pha:pha},
              function(data,status) {
                console.log(data);
                $("#TxtphaseCode").empty();
                $("#TxtphaseCode").append(data);
                $("#TxtphaseCode").trigger('change');
                // $("#TxtphaseCode").val(pha).trigger('change');
                
              }
            );
            // $('#TxtphaseCode').val(isi);
            // var e = document.getElementById('TxtphaseCode').value = pha;​​​​​​​​​​
                    
    }

    function loaddata(){
        var nup_id = $('#modal').data('nup_id');
        ScreenID = nup_id;

        if (nup_id > 0) {
          block(true); 
            $.getJSON("<?php echo base_url('c_nup_parameter/getByID');?>" + "/" + nup_id, function (data) {
              // console.log(data);
              $('#txtNupId').val(data[0].nup_id);
              setentityname(data[0].entity_cd);
              // alert(data[0].entity_cd);
              setprojectname(data[0].project_no);
              setphase(data[0].phase_cd);
                
              var sDate = data[0].start_date;
              var sYear = sDate.substr(0,4);
              var sMonth= sDate.substr(5,2);
              var sDay = sDate.substr(8,2);                
              var fsDate = sMonth+"/"+sDay+"/"+sYear;

              var eDate = data[0].end_date;
              var eYear = eDate.substr(0,4);
              var eMonth= eDate.substr(5,2);
              var eDay = eDate.substr(8,2);                
              var feDate = eMonth+"/"+eDay+"/"+eYear;

              var seDate = fsDate+" - "+feDate;                
              $('#TxtstartEndDate').val(seDate);

              var status = data[0].status;
              document.getElementById(status).checked = true;

              // $('#txtUnitStatus').val(data[0].choose_unit_status);
              var txtUnitStatus = data[0].choose_unit_status;
              if(txtUnitStatus == 1){
                document.getElementById('txtUnitStatus').checked = true;    
              }else{
                document.getElementById('txtUnitStatus').checked = false;
              }

              var txtCancelNUP = data[0].cancel_nup;
              if(txtCancelNUP == 1){
                document.getElementById('txtCancelNUP').checked = true;    
              }else{
                document.getElementById('txtCancelNUP').checked = false;
              }
                
              // $('#txtRevision').val(data[0].revision);
              // var txtRevision = data[0].revision;
              // if(txtRevision == 1){
              //   document.getElementById('txtRevision').checked = true;
              // }else{
              //   document.getElementById('txtRevision').checked = false;
              // }
              block(false); 
            });
        }
    }
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>

<script>
  $(function () {
    
    //Datemask dd/mm/yyyy
    // $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    // //Datemask2 mm/dd/yyyy
    // $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    // //Money Euro
    // $("[data-mask]").inputmask();

    //Date range picker
    $('#TxtstartEndDate').daterangepicker({
        // locale: {
        //     format: 'DD/MM/YYYY h:mm A'
        // }
    });    

    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          // $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          $('#daterange-btn span').html(start.format('D MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
        }
    );

  
  });
</script>                