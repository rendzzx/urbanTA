<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<form class="form" id="frmdata">

    <div class="form-body">
        <h4 class="form-section">
            <i class="ft-users"></i> User Details</h4>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group" >
                    <!-- <label for="coname">Picture Profile</label><br> -->
                    <img id="picturebox" style="margin-left:90px!important;text-align: center" class="img-thumbnail img-fluid w-50" 
                    onerror="this.src='https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1'" src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1" itemprop="thumbnail" alt="Image description">
                </div>
                <div class="form-group">
                    <label for="groupcd">Group Code Approval <FONT COLOR="RED">*</FONT></label>
                     <input type="text" id="groupcd" class="form-control" placeholder="Group Code" name="groupcd" readonly>
                </div>

                <div class="form-group staff">
                    <label for="staffid">Staff Id <FONT COLOR="RED">*</FONT></label>
                    <input type="text" id="staffid" class="form-control" placeholder="Staff ID" name="staffid" readonly>
                </div>
                <div class="form-group">
                    <label for="name">Staff Name</label>
                    <input type="text" id="staffname" class="form-control" placeholder="Staff Name" name="staffname" readonly>
                </div>
               
                
            </div>
            <div class="col-sm-6">
                
                <div class="form-group">
                    <label for="name">Email</label>
                    <input type="text" id="email" class="form-control" placeholder="Email" name="email" readonly>
                </div>
                 <div class="form-group">
                    <label for="name">Gender</label>
                    <input type="text" id="gender" class="form-control" placeholder="Gender" name="gender" readonly>
                </div>
               <div class="form-group">
                    <label for="name">NIK ID</label>
                    <input type="text" id="nik_id" class="form-control" placeholder="NIK ID" name="nik_id" readonly>
                </div>
                <div class="form-group">
                    <label for="coname">Handphone</label>
                    <input type="text" id="handphone" class="form-control" placeholder="Handphone" name="handphone" readonly>
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
        <h4 class="form-section">
        <i class="ft-users"></i> User Access</h4>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <fieldset>
                        <span>
                            <input type="checkbox" class="icheckbox_line" name="web_stat" id="web_stat" disabled>
                        </span>
                    </fieldset>
         
                    <input type="hidden" name="web_stat_before" id="web_stat_before">
                    <input type="hidden" name="web_stat_after" id="web_stat_after">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <fieldset>
                        <input type="checkbox" class="icheckbox_line" name="meter_stat" id="meter_stat" disabled>
                    </fieldset>
                    <input type="hidden" name="meter_stat_before" id="meter_stat_before">
                    <input type="hidden" name="meter_stat_after" id="meter_stat_after">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <fieldset>
                        <input type="checkbox" class="icheckbox_line" name="approval_stat" id="approval_stat" disabled>
                    </fieldset>
                    <input type="hidden" name="approval_stat_before" id="approval_stat_before">
                    <input type="hidden" name="approval_stat_after" id="approval_stat_after">
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
 $('#modal').on('hidden.bs.modal', function (e) {
        $(this).removeData();
        $('.modal-footer').html("");
        $('.modal-footer').html('<button type="button" class="btn grey btn-secondary" data-dismiss="modal">Close</button><button type="button" class="btn btn-danger" id="savefrm">Save</button>');
    });
    loaddata()
    $("[class*='icheckbox_line-green']").removeClass (function (index, css) {
            return (css.match (/(^|\s)icheckbox_line-gree checked disabledn\S+/g) || []).join(' ');
        }).addClass("icheckbox_line-gree checked");

    // $('input[type=checkbox]').attr('disabled',true);
    $(".select2").select2()

      $('.i-checks').iCheck({
        radioClass: 'iradio_square-purple',
        checkboxClass: 'icheckbox_flat-purple'
    });
       // $('.i-checks').iCheck('disable');
    //warna kalo checked ijo uncheck merah
    // $("#web_stat").on('ifToggled', function(event){

    //        var act_class,remove_class,val_stat;
    //       if(event.target.checked){
    //         console.log('green');
    //         act_class = 'icheckbox_line-green checked hover';
    //         remove_class = 'icheckbox_line-red hover';
    //         val_stat = 'Y';
    //       }else{
    //         console.log('red');
    //         act_class = 'icheckbox_line-red hover';
    //         remove_class = 'icheckbox_line-green checked hover';
    //          val_stat = 'N';
    //       }
    //       var div_icheck = $(this).closest('div');
          
    //       if(div_icheck.hasClass('hover')){
    //         console.log(div_icheck.attr('class'))
    //         div_icheck.removeClass(remove_class).addClass(act_class)
    //       }
    //       $('#web_stat_after').val(val_stat);
    // });

    // $("#meter_stat").on('ifToggled', function(event){

    //        var act_class,remove_class,val_stat;
    //       if(event.target.checked){
    //         console.log('green');
    //         act_class = 'icheckbox_line-green checked hover';
    //         remove_class = 'icheckbox_line-red hover';
    //         val_stat = 'Y';
    //       }else{
    //         console.log('red');
    //         act_class = 'icheckbox_line-red hover';
    //         remove_class = 'icheckbox_line-green checked hover';
    //          val_stat = 'N';
    //       }
    //       var div_icheck = $(this).closest('div');
          
    //       if(div_icheck.hasClass('hover')){
    //         console.log(div_icheck.attr('class'))
    //         div_icheck.removeClass(remove_class).addClass(act_class)
    //       }
    //       $('#meter_stat_after').val(val_stat);
    // }); 
    // $("#approval_stat").on('ifToggled', function(event){

    //        var act_class,remove_class,val_stat;
    //       if(event.target.checked){
    //         console.log('green');
    //         act_class = 'icheckbox_line-green checked hover';
    //         remove_class = 'icheckbox_line-red hover';
    //         val_stat = 'Y';
    //       }else{
    //         console.log('red');
    //         act_class = 'icheckbox_line-red hover';
    //         remove_class = 'icheckbox_line-green checked hover';
    //          val_stat = 'N';
    //       }
    //       var div_icheck = $(this).closest('div');
          
    //       if(div_icheck.hasClass('hover')){
    //         console.log(div_icheck.attr('class'))
    //         div_icheck.removeClass(remove_class).addClass(act_class)
    //       }
    //       $('#approval_stat_after').val(val_stat);
    // });
    

    $('#savefrm_activate').click(function(event) {
        block(true);
        event.preventDefault();
        if (event.handled !== true) {
            event.handled = true;
            if($('#frmdata').valid()){
            swal({
                title: "Are you sure to approve this user?",
                animation: false,
                type:"success",
                text: "Once this user is approved it can't be cancelled. Please make sure everything is right.",
                showCancelButton: true,
                confirmButtonText: "Yes"
            }).then(function(event){
                console.log(event)
                if(event.value){
                    var id = $('#modal').data('id');
                    var staffid = $('#staffid').find(':selected').val();

                    var web =  $( 'input[name=web]:checked' ).val();
                    var meter = $('input[name=meter]:checked' ).val();
                    var approval = $('input[name=approval]:checked' ).val();
                    var datafrm = $('#frmdata').serializeArray();
              
                    datafrm.push({name:"id",value:id},
                        {name:"staffid",value:staffid},
                        {name:"web",value:web},
                        {name:"approval",value:approval},
                        {name:"meter",value:meter}
                        )

                    // console.log(datafrm);return;
                        $.ajax({
                        url : "<?php echo base_url('c_user/save_activate');?>",
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
                    }else{
                        block(false);
                    }
            });
            
            } else{
                block(false);
            }
        }
    });
});

function loaddata(){
    var id = $('#modal').data('id');
    if (id > 0) {
        block(true);
        $.getJSON("<?php echo base_url('c_user/getByIDuser');?>" + "/" + id, function (data) {
            // console.log(data)



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
            // $('#staffid').attr('disabled',true);
            $('#staffname').val(data.data[0].name)
            $('#nik_id').val(data.data[0].nik_id)
            $('#email').val(data.data[0].email)
            $('#handphone').val(data.data[0].Handphone)
            // console.log(data.data[0].pict);
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

            $('#web_stat_before').val(data.data[0].Status);
            $('#meter_stat_before').val(data.data[0].meter_apps);
            $('#approval_stat_before').val(data.data[0].approval_apps);
            $('#web_stat_after').val(data.data[0].Status);
            $('#meter_stat_after').val(data.data[0].meter_apps);
            $('#approval_stat_after').val(data.data[0].approval_apps);
            // $(".icheckbox_line-red").removeClass("checked")
            if(data.data[0].Status=='Y'){
                // $("#web_stat").attr('checked', 'checked');
                $("#web_stat").iCheck('check');
                $("#web_stat").iCheck({
                  checkboxClass: 'icheckbox_line-green',
                  insert: '<div class="icheck_line-icon"></div> Web Access'
                });
                
            }else{
                $("#web_stat").iCheck({
                  checkboxClass: 'icheckbox_line-red',
                  insert: '<div class="icheck_line-icon"></div> Web Access'
                });

            }
            
            if(data.data[0].meter_apps=='Y'){
                // $("#web_stat").attr('checked', 'checked');
                $("#meter_stat").iCheck('check');
                $("#meter_stat").iCheck({
                  checkboxClass: 'icheckbox_line-green',
                  insert: '<div class="icheck_line-icon"></div> Meter Access'
                });
            }else{
                $("#meter_stat").iCheck({
                  checkboxClass: 'icheckbox_line-red',
                  insert: '<div class="icheck_line-icon"></div> Meter Access'
                });
            }
            if(data.data[0].approval_apps=='Y'){
                // $("#web_stat").attr('checked', 'checked');
                $("#approval_stat").iCheck('check');
                $("#approval_stat").iCheck({
                  checkboxClass: 'icheckbox_line-green',
                  insert: '<div class="icheck_line-icon"></div> Approval Access'
                });
            }else{
                $("#approval_stat").iCheck({
                  checkboxClass: 'icheckbox_line-red',
                  insert: '<div class="icheck_line-icon"></div> Approval Access'
                });
            }
           
            var div_icheck_green = $("[class*='icheckbox_line-green']");
            if(div_icheck_green.hasClass('disabled')){
                console.log(div_icheck_green.attr('class'))
                div_icheck_green.removeClass('disabled')
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