<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<form class="form" id="frmdata">
    <div class="nav-vertical p-2">
        <ul class="nav nav-tabs nav-left flex-column">
            <li class="nav-item">
                <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">User Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Assign Project</a>
            </li>
          
        </ul>
        <div class="tab-content px-1">
            <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" >
                <div class="form-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="groupcd">Group Code Approval <FONT COLOR="RED">*</FONT></label>
                        <select data-placeholder="Choose a Group" class="select2 form-control" id="groupcd" name="groupcd">
                            <option value=""></option>
                            <?php if(!empty($group)){foreach ($group as $key) { ?>
                                <option value="<?php echo $key->group_cd?>"><?php echo $key->group_descs ?></option>
                            <?php }}  ?>
                        </select>
                    </div>

                    <div class="form-group staff">
                        <label for="staffid">Staff Id <FONT COLOR="RED">*</FONT></label>
                        <select data-placeholder="Choose a Staff Id" class="select2 form-control" id="staffid" name="staffid">
                            <option value=""></option>
                            <?php foreach ($staff as $key) { ?>
                                <option value="<?php echo $key->staff_id?>"><?php echo $key->staff_id ?></option>
                            <?php }  ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Staff Name</label>
                        <input type="text" id="staffname" class="form-control" placeholder="Staff Name" name="staffname">
                    </div>
                    <div class="form-group">
                        <label for="name">NIK ID</label>
                        <input type="text" id="nik_id" class="form-control" placeholder="NIK ID" name="nik_id">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" id="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="coname">Handphone</label>
                        <input type="text" id="handphone" class="form-control" placeholder="Handphone" name="handphone">
                    </div>
                    <div class="form-group">
                        <label for="coname">Department</label>
                        <input type="text" class="form-control" placeholder="Department" name="dept" id="dept" readonly="true">
                        <input type="hidden" class="form-control" placeholder="Department" name="dept_cd" id="dept_cd" >
                    </div>
                    <div class="form-group">
                        <label for="coname">Divisi</label>
                        <input type="text" class="form-control" placeholder="Divisi" name="div" id="div" readonly="true">
                        <input type="hidden" class="form-control" placeholder="Divisi" name="div_cd" id="div_cd" >
                    </div>
                </div>
             
       
            </div>
        </div>
            </div>
            <div class="tab-pane" id="tab2">
                <div class="form-group">
            <label>Assign Project</label>
            <div class="row skin skin-line">
          
                <?php $no = 1;
                    if(!empty($project)){
                        foreach ($project as $key) {
                            ?>
                <div class="col-sm-11">
                    <fieldset>
                        <input type="checkbox" class="pro" name="project[]" id="project_no_<?php echo $key->project_no?>" value="<?php echo $key->entity_cd.'=&='.$key->project_no?>">
                        <label for="project_no_<?php echo $key->project_no?>"><?php echo $key->descs?></label>
                    </fieldset>
                </div>
                <?php
                        }
                    }
                ?>
                
            
            </div>
        </div>
            </div>
           
        </div>
    </div>

</form>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/toggle/switchery.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/toggle/switchery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/switch.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>


<script>
var isFile=false;
var jqXHRData;
$(document).ready(function(){

    loaddata()

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $(".select2").select2()

    $("#staffid").change(function(){

       
    })


    $("#staffid").change(function(){
        block(true);
        var rowid = $('#modal').data('id');
        if(rowid == 0){
             var id = $(this).val()
            $.getJSON("<?php echo base_url('Approvaldash/zoomstaff');?>" + "/" + id, function (data) {
                $('#staffname').val(data[0].staff_name)
                // $('#email').val(data[0].email_addr)
                // $('#handphone').val(data[0].handphone)
                $('#nik_id').val(data[0].nik_id)
                $('#dept').val(data[0].dept_descs)
                $('#dept_cd').val(data[0].dept_cd)
                $('#div').val(data[0].div_descs)
                $('#div_cd').val(data[0].div_cd)
                block(false);
            });
        }
       
    })
    $("#frmdata").validate({
          ignore:"",
          rules: {
      
            staffid: {
              required: true
            },
            groupcd:{
              required:true
            },
          
          },
          messages: {
            
            // userfile: {
            //     cek_data: "Please choose a picture."
            // }
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
    // $("#userfile").on('change', function () {
    //     $("#image").val(this.files[0].name);
    //     $("#labelimage").text(this.files[0].name);
    //     readURL(this);
    // });

    // $('#userfile').fileupload({
    //     url: "<?php echo base_url('Approvaldash/save_user');?>",
    //     dataType: 'json',
    //     add: function (e, data) {
    //         jqXHRData = data
    //         isFile = true;                
    //     },
    //     done: function (event, response) {
    //         var res = response.result
    //         if(res.Error==false){
    //             block(false);
    //             swal({
    //                 title: "Information",
    //                 animation: false,
    //                 type:"success",
    //                 text: res.Pesan,
    //                 confirmButtonText: "OK"
    //             });
    //             $('#modal').modal('hide');
    //         }
    //         else{
    //             block(false);
    //             swal({
    //                 title: "Warning",
    //                 animation: false,
    //                 type:"error",
    //                 text: res.Pesan,
    //                 confirmButtonText: "OK"
    //             });
    //         }
    //         tbluser.ajax.reload(null,true); 

    //         },
    //         fail: function (event, response) {
    //             block(false);
    //             var error = response["_response"]["errorThrown"];
    //             swal({
    //                 title: "Warning",
    //                 animation: false,
    //                 type:"error",
    //                 text: error,
    //                 confirmButtonText: "OK"
    //             });
    //         });
    //     });

    $('#savefrm').bind( "click", function() {
        block(true);
        if($('#frmdata').valid()){
        var id = $('#modal').data('id');
        var staffid = $('#staffid').find(':selected').val();
        // alert(staffid);
        // var int = $('.pro:checked').length
        var datafrm = $('#frmdata').serializeArray();
        
        // block(false);
        // datafrm.push({name:"id",value:id},{name:"isFile",value:isFile},{name:"int",value:int})
        datafrm.push({name:"id",value:id},{name:"staffid",value:staffid})
        console.log(datafrm);
        return;
        // var obj = new Object();
        // obj.isFile = isFile;
        // if(isFile){
        //   if(jqXHRData){
        //     jqXHRData.formData = datafrm;
        //     jqXHRData.submit();
        //   }
        // }
        // else{
            $.ajax({
            url : "<?php echo base_url('Approvaldash/save_user');?>",
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
                    tbluser.ajax.reload(null,true);
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
        } else{
            block(false);
        }
    });
});


function loaddata(){
    var id = $('#modal').data('id');
    if (id > 0) {
        block(true);
        $.getJSON("<?php echo base_url('Approvaldash/getByIDuser');?>" + "/" + id, function (data) {
            console.log(data)

            $('#groupcd').val(data.data[0].Group_Cd).trigger("change");
            $('#staffid').val(data.data[0].userID).trigger("change");
            $('#staffid').attr('disabled',true);
            $('#staffname').val(data.data[0].name)
            $('#nik_id').val(data.data[0].Nik_id)
            $('#email').val(data.data[0].email)
            $('#handphone').val(data.data[0].Handphone)

            $('#dept_cd').val(data.data[0].dept_cd)
            set_dept(data.data[0].dept_cd)
            $('#div_cd').val(data.data[0].div_cd)
            set_div(data.data[0].div_cd)

            $(".icheckbox_line-blue").removeClass("checked")
            if(data.datapro.length>0){
                 $.each(data.datapro, function( index, value ) {
                    var project = value.project_no;
                    var descs = value.prodescs;
                    $("#project_no_"+project.trim()).attr('checked', 'checked');
                    $("#project_no_"+project.trim()).iCheck({
                      checkboxClass: 'icheckbox_line-blue checked',
                      insert: '<div class="icheck_line-icon"></div>' + descs
                    });
                });
            }
           
            
            block(false);
        });
    }
    else{
        block(false);
    }
}
function set_dept(dept_cd){
    $.getJSON("<?php echo base_url('Approvaldash/zoomdept');?>" + "/" + dept_cd, function (data) {
            // console.log(data)
            $('#dept').val(data[0].descs);
          
        });
    
}
function set_div(div_cd){
    $.getJSON("<?php echo base_url('Approvaldash/zoomdiv');?>" + "/" + div_cd, function (data) {
            // console.log(data)
            $('#div').val(data[0].descs);
          
        });
    
}
function readURL(input) {

    if (input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#picturebox').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);

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