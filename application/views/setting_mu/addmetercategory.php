<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />



<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="categorycd">Category Code</label>
            <input type="text" id="categorycd" class="form-control" placeholder="Category Code" name="categorycd">
        </div>
        <div class="form-group">
            <label for="text">Name</label>
            <input type="number" id="name" class="form-control" placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <label for="calculationmethod">Calculation Method</label>
            <input type="calculationmethod" id="calculationmethod" class="form-control" placeholder="Calculation Method" name="calculationmethod">
        </div>
        <div class="form-group">
            <input type="checkbox" id="capacityrate" name="capacityrate" class="switchery" data-color="primary" data-secondary-color="primary" value="Y" />&nbsp;&nbsp;
            <label for="capacityrate">Capacity Rate</label>
        </div>
        <div class="form-group">
            <input type="checkbox" id="usagelimit" name="usagelimit" class="switchery" data-color="primary" data-secondary-color="primary" value="Y" />&nbsp;&nbsp;
            <label for="usagelimit">Usage Limit</label>
        </div>
        <div class="form-group">
            <label for="discountrate">Discount Rate</label>
            <input type="number" id="discountrate" class="form-control" placeholder="Discount Rate" name="discountrate">
        </div>
        <div class="form-group">
            <label for="oprrate">Opr Rate</label>
            <input type="number" id="oprrate" class="form-control" placeholder="Opr Rate" name="oprrate">
        </div>
        <div class="form-group">
            <label for="minusagerate">Min Usage Hour</label>
            <input type="number" id="minusagerate" class="form-control" placeholder="Min Usage Hour" name="minusagerate">
        </div>
        <div class="form-group">
            <label for="constantpln">Constact PLN</label>
            <input type="number" id="constantpln" class="form-control" placeholder="Constact PLN" name="constantpln">
        </div>
        <div class="form-group">
            <label for="btssub">Bts Sub</label>
            <input type="number" id="btssub" class="form-control" placeholder="Constact PLN" name="btssub">
        </div>
        <div class="form-group">
            <label for="traforate">Trafo Rate</label>
            <input type="number" id="traforate" class="form-control" placeholder="Trafo Rate" name="traforate">
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

    $(".select2").select2();

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
            console.log(res)
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
    if (id > 0) {
        block(true);
        $.getJSON("<?php echo base_url('C_User_Access/getByIDuser');?>" + "/" + id, function (data) {

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

            // $('#descs').val(data[0].descs);
            // var priority = data[0].category_priority;
            // $("#priority"+priority).attr('checked', 'checked');
            // var label_priority = ''
            // if (priority==1) {
            //     label_priority = 'Low'
            // }
            // if (priority==2) {
            //     label_priority = 'Meduim'
            // }
            // if (priority==3) {
            //     label_priority = 'High'
            // }
            // $(".iradio_line-blue").removeClass("checked")
            // $("#priority"+priority).iCheck({
            //   radioClass: 'iradio_line-blue checked',
            //   insert: '<div class="icheck_line-icon"></div>' + label_priority
            // });
            // $('#spvid').val(data[0].user_spv).trigger("change");
            // $('#categorygroup').val(data[0].category_group_cd).trigger("change");
            // var complain = data[0].complain_type;
            // $("#"+complain).attr('checked', 'checked');
            // var label_complain = ''
            // if (complain=='R') {
            //     label_complain = 'Request'
            // }
            // if (complain=='C') {
            //     label_complain = 'Complain'
            // }
            // $("#"+complain).iCheck({
            //   radioClass: 'iradio_line-blue checked',
            //   insert: '<div class="icheck_line-icon"></div>' + label_complain
            // });
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