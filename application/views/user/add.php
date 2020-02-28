<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
    <link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<!-- link -->

<!-- content -->
    <form class="form" id="frmdata">
        <div class="nav-vertical p-2">
            <ul class="nav nav-tabs nav-left flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="base-tab1" data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">User Profile</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Assign Project</a>
                </li>

                <li class="nav-item" id="resetpass">
                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3" href="#tab3" aria-expanded="false">Reset Password</a>
                </li>
            </ul>
            <div class="tab-content px-1">
                <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" >
                    <div class="form-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="groupcd">Group Code Approval <FONT COLOR="RED">*</FONT></label>
                                    <select data-placeholder="Choose a Group" class="select2 form-control" id="groupcd" name="groupcd">
                                        <option value=""></option>
                                        <?php if(!empty($group)){foreach ($group as $key) { ?>
                                            <option value="<?php echo $key->group_cd?>"><?php echo $key->group_cd?> - <?php echo $key->group_descs ?> </option>
                                        <?php }}  ?>
                                    </select>
                                </div>

                                <div class="form-group staff">
                                    <label for="staffid">Staff Id <FONT COLOR="RED">*</FONT></label>
                                    <select data-placeholder="Choose a Staff Id" class="select2 form-control" id="staffid" name="staffid">
                                        <option value=""></option>
                                        <?php foreach ($staff as $key) { ?>
                                            <option value="<?php echo $key->staff_id?>"><?php echo $key->staff_id ?>  - <?php echo $key->staff_name?></option>
                                        <?php }  ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Staff Name</label>
                                    <input type="text" id="staffname" class="form-control" placeholder="Staff Name" name="staffname">
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
                                    <label for="name">Gender</label>
                                    <select data-placeholder="Choose gender" class="select2 form-control" id="gender" name="gender">
                                        <option value=""></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                               <div class="form-group">
                                    <label for="name">NIK ID</label>
                                    <input type="text" id="nik_id" class="form-control" placeholder="NIK ID" name="nik_id">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="coname">Picture Profile</label><br>
                                    <img id="picturebox" class="img-thumbnail img-fluid w-50" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1" itemprop="thumbnail" alt="Image description">
                                        <span class="btn btn-sm btn-primary fileinput-button" style="margin-top: 10px!important">
                                          <span>Select Picture...</span>
                                          <input type="file" id="userfile" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(this)"/>
                                        </span>
                                        <p>(* Only Jpg, Png allowed)</p>
                                    <input type="hidden" name="picturepath" id="picturepath" value="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1">
                                    <input type="hidden" name="picturename" id="picturename">
                                </div>
                                
                                
                                <div class="form-group">
                                    <label for="coname">Web Access</label>
                                    <div class="i-checks" style="margin: 5px;">
                                        <input type="radio" name="web" id="web-Y" value="Y" > 
                                        <label for="web-Y">Active</label> &nbsp;&nbsp;
                                        <input type="radio" name="web" id="web-N" value="N" checked > 
                                        <label for="web-N">Inactive</label>
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label for="coname">Approval Access</label>
                                    <div class="i-checks" style="margin: 5px;">
                                        <input type="radio" name="approval" id="approval-Y" value="Y" > 
                                        <label for="approval-Y">Active</label> &nbsp;&nbsp;
                                        <input type="radio" name="approval" id="approval-N" value="N" checked > 
                                        <label for="approval-N">Inactive</label>
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label for="coname">Meter Access</label>
                                   <div class="i-checks" style="margin: 5px;">
                                        <input type="radio" name="meter" id="meter-Y" value="Y" > 
                                        <label for="meter-Y">Active</label> &nbsp;&nbsp;
                                        <input type="radio" name="meter" id="meter-N" value="N" checked > 
                                        <label for="meter-N">Inactive</label>
                                      </div>
                                </div>
                                <div class="form-group">
                                    <label for="coname">Status Approve</label>
                                   <div class="i-checks" style="margin: 5px;">
                                        <input type="radio" name="activate" id="activate-Y" value="Y" > 
                                        <label for="status-Y">Approved</label> &nbsp;&nbsp;
                                        <input type="radio" name="activate" id="activate-N" value="N" checked > 
                                        <label for="status-N">Unapproved</label>
                                      </div>
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
                                    <label for="project_no_<?php echo $key->project_no?>"><?php echo $key->descs.' ('.$key->entity_cd.')'?></label>
                                </fieldset>
                            </div>
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tab3" id="resetpass">
                   <div class="form-group" >
                        <label for="name">Reset Password</label><br>
                        <button type="button" id="btnReset" class="btn btn-primary" onclick="resetpass()">Reset</button>
                    </div>
               </div>
            </div>
        </div>
    </form>
<!-- content -->

<!-- script -->
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
<!-- script -->


<script>
var isFile=false;
var jqXHRData;
$(document).ready(function(){

    loaddata()

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $(".select2").select2()

      $('.i-checks').iCheck({
        radioClass: 'iradio_square-purple',
        checkboxClass: 'icheckbox_flat-purple'
    });
       $('#activate-Y').iCheck('disable');
       $('#activate-N').iCheck('disable');
    $("#staffid").change(function(){
        block(true);
        var rowid = $('#modal').data('id');
        if(rowid == 0){
            var id = $(this).val()
            if(id){
                $.getJSON("<?php echo base_url('c_user/zoomstaff');?>" + "/" + id, function (data) {
                    $('#staffname').val(data[0].staff_name)
                    // $('#email').val(data[0].email_addr)
                    // $('#handphone').val(data[0].handphone)
                    // $('#nik_id').val(data[0].nik_id)
                    $('#dept').val(data[0].dept_descs)
                    $('#dept_cd').val(data[0].dept_cd)
                    $('#div').val(data[0].div_descs)
                    $('#div_cd').val(data[0].div_cd)
                    block(false);
                });
            }
        }else{
            var id = $(this).val()
            if(id){
               $.getJSON("<?php echo base_url('c_user/zoomstaff');?>" + "/" + id, function (data) {
                    console.log(data);
                    // $('#staffname').val(data[0].staff_name)
                    // $('#email').val(data[0].email_addr)
                    // $('#handphone').val(data[0].handphone)
                    // $('#nik_id').val(data[0].nik_id)
                    $('#dept').val(data[0].dept_descs)
                    $('#dept_cd').val(data[0].dept_cd)
                    $('#div').val(data[0].div_descs)
                    $('#div_cd').val(data[0].div_cd)
                    block(false);
                }); 
            }
            
        }
       
    })
    $("#frmdata").validate({
          ignore:"",
          rules: {
            email: {
              required: true,
              email:true
            },
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
 

    $('#savefrm').click(function(event) {
        block(true);
        event.preventDefault();
        if (event.handled !== true) {
            event.handled = true;
            if($('#frmdata').valid()){
            var id = $('#modal').data('id');
            var staffid = $('#staffid').find(':selected').val();

            var web =  $( 'input[name=web]:checked' ).val();
            var meter = $('input[name=meter]:checked' ).val();
            var approval = $('input[name=approval]:checked' ).val();
            var activate = $('input[name=activate]:checked' ).val();
            var datafrm = $('#frmdata').serializeArray();
      
            datafrm.push({name:"id",value:id},
                {name:"staffid",value:staffid},
                {name:"web",value:web},
                {name:"approval",value:approval},
                {name:"activate",value:activate},
                {name:"meter",value:meter}
                )

            // console.log(datafrm);return;
                $.ajax({
                url : "<?php echo base_url('c_user/save_user');?>",
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
        }
        block(false);
    });
});
function saveImage(el) {

block(true)
// console.log($("#userfile").get(0).files[0]);return;
$.ajax({
  url : "<?php echo base_url('c_user/savePic');?>",
  type:"POST",
  data: function () {
    var data = new FormData();
    data.append("userfile", $("#userfile").get(0).files[0]);
    return data;
  }(),
  processData: false,
  contentType: false,
  dataType:"json",
  success:function(data, status){
    console.log(data);
    if(data.status == "OK"){
            swal({
              title: "Information",
              text: data.pesan,
              type: "success",
              confirmButtonText: "OK"
            });
            $('#picturebox').attr('src', data.url);
            $('#picturepath').val(data.url)
            $('#picturename').val(data.picname)
          } else {
            swal({
              title: "Error",
              text: data.pesan,
              type: "error",
              confirmButtonText: "OK"
            });
              // document.getElementById('loader').hidden=true; 
            }
            block(false)
          },                    
          error: function(jqXHR, textStatus, errorThrown){
            swal(textStatus+' Save : '+errorThrown);
            block(false)
          }
        });
}
function resetpass(){
    var id = $('#modal').data('id');
    var staffid = $('#staffid').find(':selected').val();
    var datafrm = $('#frmdata').serializeArray();
    datafrm.push({name:"id",value:id},{name:"staffid",value:staffid})
    swal({
            title: 'Do you want to reset password?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Reset'
        }).then(function(event){
            // console.log(event);
            if(event.value){
                $.ajax({
                url : "<?php echo base_url('c_user/resetpass');?>",
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
            }
        });

}
function loaddata(){
    var id = $('#modal').data('id');
    if (id > 0) {
        block(true);
        $.getJSON("<?php echo base_url('c_user/getByIDuser');?>" + "/" + id, function (data) {
            console.log(data)



            $('#groupcd').val(data.data[0].Group_Cd).trigger("change");
            $('#gender').val(data.data[0].gender).trigger("change");
            $('#staffid').val(data.data[0].userID).trigger("change");
            // alert(data.data[0].Status)
            if(data.data[0].Status!==null||data.data[0].Status!==''){
              $('#web-'+data.data[0].Status).iCheck('check');
            }
            if(data.data[0].meter_apps!==null||data.data[0].meter_apps!==''){
              $('#meter-'+data.data[0].meter_apps).iCheck('check');
            }
            if(data.data[0].approval_apps!==null||data.data[0].approval_apps!==''){
              $('#approval-'+data.data[0].approval_apps).iCheck('check');
            }
            if(data.data[0].status_activate!==null||data.data[0].status_activate!==''){
              $('#activate-'+data.data[0].status_activate).iCheck('check');
            }
            // $('#staffid').attr('disabled',true);
            $('#staffname').val(data.data[0].name)
            $('#nik_id').val(data.data[0].nik_id)
            $('#email').val(data.data[0].email)
            $('#handphone').val(data.data[0].Handphone)
            // if(data.data[0].pict!==null||data.data[0].pict!==''){
            //     $('#picturebox').attr('src', data.data[0].pict);
            //     $('#picturepath').val(data.data[0].pict);        
            // }
            if(data.data[0].pict==null||data.data[0].pict==''||data.data[0].pict=='null'){
                $('#picturebox').attr('src', "https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1");
                $('#picturepath').val("https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1"); 
            }else{
                $('#picturebox').attr('src', data.data[0].pict);
                $('#picturepath').val(data.data[0].pict); 
            }
            $('#dept_cd').val(data.data[0].dept_cd)
            set_dept(data.data[0].dept_cd)
            $('#div_cd').val(data.data[0].div_cd)
            set_div(data.data[0].div_cd)

            $(".icheckbox_line-blue").removeClass("checked")
            if(data.datapro.length>0){
                 $.each(data.datapro, function( index, value ) {
                    var project = value.project_no;
                    var descs = value.project_descs;
                    var entity = value.entity_cd;
                    $("#project_no_"+project.trim()).attr('checked', 'checked');
                    $("#project_no_"+project.trim()).iCheck({
                      checkboxClass: 'icheckbox_line-blue checked',
                      insert: '<div class="icheck_line-icon"></div>' + descs +' ('+entity.trim()+')'
                    });
                });
            }
           
            
            block(false);
        });
    }
    else{
        block(false);
        $('#resetpass').hide();
    }
}
function set_dept(dept_cd){
    if(dept_cd){
        $.getJSON("<?php echo base_url('c_user/zoomdept');?>" + "/" + dept_cd, function (data) {
            // console.log(data)
            
            $('#dept').val(data[0].descs);    
            
        });
    }
    
}
function set_div(div_cd){
    if(div_cd){
        $.getJSON("<?php echo base_url('c_user/zoomdiv');?>" + "/" + div_cd, function (data) {
            // console.log(data)
            if(data){
                $('#div').val(data[0].descs);
            }
            
          
        });
    }
    
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