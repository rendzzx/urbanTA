<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />



<form class="form" id="frmdata">
    <div class="form-body">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="groupcd">Group Code</label>
                    <select data-placeholder="Choose a Group" class="select2 form-control" id="groupcd" name="groupcd">
                        <option value=""></option>
                        <option value="DEBTOR">Debtor</option>
                        <option value="TEKNISI">Teknisi</option>
                        <option value="CSM">CSM</option>
                    </select>
                </div>
                <div class="form-group business">
                    <label for="businnessid">Business Id</label>
                    <select data-placeholder="Choose a Business Id" class="select2 form-control" id="businessid" name="businessid">
                        <option value=""></option>
                        <?php foreach ($business as $key) { ?>
                            <option value="<?php echo $key->business_id?>"><?php echo $key->business_id ?></option>
                        <?php }  ?>
                    </select>
                </div>
                <div class="form-group staff">
                    <label for="businnessid">Staff Id</label>
                    <select data-placeholder="Choose a Staff Id" class="select2 form-control" id="staffid" name="staffid">
                        <option value=""></option>
                        <?php foreach ($staff as $key) { ?>
                            <option value="<?php echo $key->staff_id?>"><?php echo $key->staff_id ?></option>
                        <?php }  ?>
                    </select>
                </div>
                <div class="form-group business">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" class="form-control" placeholder="Name" name="name">
                </div>
                <div class="form-group staff">
                    <label for="name">Staff Name</label>
                    <input type="text" id="staffname" class="form-control" placeholder="Staff Name" name="staffname">
                </div>
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" id="email" class="form-control" placeholder="Email" name="email">
                </div>
                <!-- <div class="form-group business">
                    <label for="coname">Co Name</label>
                    <input type="text" id="coname" class="form-control" placeholder="Co Name" name="coname">
                </div>
                <div class="form-group business">
                    <label for="coname">Contact Person</label>
                    <input type="text" id="contactperson" class="form-control" placeholder="Contact Person" name="contactperson">
                </div> -->
                <div class="form-group">
                    <label for="coname">Handphone</label>
                    <input type="text" id="handphone" class="form-control" placeholder="Handphone" name="handphone">
                </div>
                <div class="form-group">
                    <label for="coname">Whatsapp</label>
                    <input type="text" id="whatsapp" class="form-control" placeholder="Number Whatsapp" name="whatsapp">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="coname">Picture Profile</label>
                    <fieldset class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="userfile" name="userfile" accept="image/*">
                            <input type="hidden" id="image" name="image"  readonly="readonly" />
                            <label id="labelimage" class="custom-file-label" for="userfile">Choose Picture</label>
                        </div>
                    </fieldset>
                    <img id="picturebox" class="img-thumbnail img-fluid w-50" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1" itemprop="thumbnail" alt="Image description">
                </div>
                <div class="form-group pb-1">
                  <input type="checkbox" id="notifsms" name="notifsms" class="switchery" data-color="primary" data-secondary-color="primary" value="1" />&nbsp;&nbsp;
                  <label for="notifsms">Notification SMS</label>
                </div>
                <div class="form-group pb-1">
                  <input type="checkbox" id="notifemail" name="notifemail" class="switchery" data-color="primary" data-secondary-color="primary" value="1" />&nbsp;&nbsp;
                  <label for="notifemail">Notification Email</label>
                </div>
                <div class="form-group pb-1">
                    <input type="checkbox" id="notifwa" name="notifwa" class="switchery" data-color="primary" data-secondary-color="primary" value="1" />&nbsp;&nbsp;
                    <label for="notifwa">Notification Whatsapp</label>
                </div>
                <div class="form-group">
                    <label>Project</label>
                    <div class="row skin skin-line">
                        <?php $i = 1 ?>
                        <?php foreach ($project as $key) { ?>
                        <div class="col-sm-10">
                            <fieldset>
                                <input type="checkbox" class="pro" name="<?php echo 'project'.$i++ ?>" id="<?php echo $key->project_no?>" value="<?php echo $key->entity_cd.','.$key->project_no;?>">
                                <label for="<?php echo $key->project_no?>"><?php echo $key->descs ?></label>
                            </fieldset>
                        </div>
                        <?php } ?>
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


<script>
var isFile=false;
var jqXHRData;
$(document).ready(function(){

    loaddata()

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $(".select2").select2({
        width: '100%' 
    })

    var group = $("#groupcd").val()
    if (group=='DEBTOR') {
        $('.staff').hide()
        $('.business').show()
    }
    else{
        $('.staff').show()
        $('.business').hide()
    }

    $("#groupcd").change(function(){
        var group = $(this).val()
        if (group=='DEBTOR') {
            $('.staff').hide()
            $('.business').show()
        }
        else{
            $('.staff').show()
            $('.business').hide()
        }
    })

    $("#businessid").change(function(){
        block(true);
        var id = $(this).val()
        $.getJSON("<?php echo base_url('C_User_Access/zoombusiness');?>" + "/" + id, function (data) {
            $('#name').val(data[0].contact_person)
            $('#email').val(data[0].email_addr)
            // $('#coname').val(data[0].co_name)
            // $('#contactperson').val(data[0].contact_person)
            $('#handphone').val(data[0].hand_phone)
            $('#whatsapp').val(data[0].hand_phone)
            block(false);
        });
    })

    $("#staffid").change(function(){
        block(true);
        var id = $(this).val()
        $.getJSON("<?php echo base_url('C_User_Access/zoomstaff');?>" + "/" + id, function (data) {
            $('#staffname').val(data[0].staff_name)
            $('#email').val(data[0].email_addr)
            $('#handphone').val(data[0].hand_phone)
            $('#whatsapp').val(data[0].hand_phone)
            block(false);
        });
    })

    $("#userfile").on('change', function () {
        $("#image").val(this.files[0].name);
        $("#labelimage").text(this.files[0].name);
        readURL(this);
    });

    $('#userfile').fileupload({
        url: "<?php echo base_url('C_User_Access/save_user');?>",
        dataType: 'json',
        add: function (e, data) {
            jqXHRData = data
            isFile = true;                
        },
        done: function (event, response) {
            var res = response.result
            if(res.Error==false){
                block(false);
                swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: res.Pesan,
                    confirmButtonText: "OK"
                });
                $('#modal').modal('hide');
            }
            else{
                block(false);
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: res.Pesan,
                    confirmButtonText: "OK"
                });
            }
            tbluser.ajax.reload(null,true); 

            },
            fail: function (event, response) {
                block(false);
                var error = response["_response"]["errorThrown"];
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: error,
                    confirmButtonText: "OK"
                });
            }
        });

    $('#savefrm').click(function(){
        block(true);
        var id = $('#modal').data('id');
        var int = $('.pro:checked').length
        var datafrm = $('#frmdata').serializeArray();
        datafrm.push({name:"id",value:id},{name:"isFile",value:isFile},{name:"int",value:int})

        var obj = new Object();
        obj.isFile = isFile;
        if(isFile){
          if(jqXHRData){
            jqXHRData.formData = datafrm;
            jqXHRData.submit();
          }
        }
        else{
            $.ajax({
            url : "<?php echo base_url('C_User_Access/save_user');?>",
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
    })
});


function loaddata(){
    var id = $('#modal').data('id');
    // console.log(id);
    if (id > 0) {
        block(true);
        $.getJSON("<?php echo base_url('C_User_Access/getByIDuser');?>" + "/" + id, function (data) {
            console.log(data)
            $('#groupcd').val(data[0].Group_Cd).trigger("change");
            $('#businessid').val(data[0].business_id).trigger("change");
            $('#name').val(data[0].name)
            $('#staffname').val(data[0].name)
            $('#email').val(data[0].email)
            $('#handphone').val(data[0].Handphone)
            $('#whatsapp').val(data[0].wa_no)
            if (data[0].notif_wa=="Y") {
                $('#notifwa').attr('checked', 'checked');
            }
            if (data[0].notif_email=="Y") {
                $('#notifemail').attr('checked', 'checked');
            }
            if (data[0].notif_sms=="Y") {
                $('#notifsms').attr('checked', 'checked');
            }

            $('#image').val(data[0].pict);

            var url = data[0].pict;
            
            if(url == "" || url == null)
            {   
            }
            else{
                var filename = url.substring(url.lastIndexOf('/')+1);
                $('#labelimage').text(filename);
                $('#picturebox').attr("src",url);
            }

            var email = data[0].email
            $(".icheckbox_line-blue").removeClass("checked")
            $.getJSON("<?php echo base_url('C_User_Access/getByIDproject');?>" + "/" + email, function (data) {
                $.each(data, function( index, value ) {
                    var project = value.project_no;
                    var descs = value.descs_project;
                    $("#"+project).attr('checked', 'checked');
                    $("#"+project).iCheck({
                      checkboxClass: 'icheckbox_line-blue checked',
                      insert: '<div class="icheck_line-icon"></div>' + descs
                    });
                });
            })
            block(false);
        });
    }
    else{
        block(false);
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