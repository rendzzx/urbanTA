<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/toggle/switchery.min.css')?>">
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />



<form class="form" id="frmdata">
    <div class="form-body">
        <div class="row">
            <div class="col-sm-12">
                
                <div class="form-group">
                    <label for="payment_cd">Payment Code</label>
                    <input type="text" id="payment_cd" class="form-control" placeholder="Payment Code" name="payment_cd">
                </div>

                <div class="form-group">
                    <label for="descs">Description</label>
                    <textarea id="descs" class="form-control" placeholder="Description" name="descs"></textarea>
                </div>

                <div class="form-group">
                    <label for="coname">Logo</label>
                    <fieldset class="form-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="userfile" name="userfile" accept="image/*">
                            <input type="hidden" id="image" name="image"  readonly="readonly" />
                            <label id="labelimage" class="custom-file-label" for="userfile">Choose Logo</label>
                        </div>
                    </fieldset>
                    <img id="picturebox" class="img-thumbnail img-fluid w-50" src="<?php echo base_url('/img/payment_logo/no_image.png') ?>" itemprop="thumbnail" alt="&nbsp; Logo">
                </div>
                    <input type="hidden" id="row_id" class="form-control" name="row_id">
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

    

    $("#userfile").on('change', function () {
        $("#image").val(this.files[0].name);
        $("#labelimage").text(this.files[0].name);
        readURL(this);
    });

    $('#userfile').fileupload({
        url: "<?php echo base_url('c_nup_payment/save');?>",
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
        datafrm.push({name:"id",value:id},{name:"isFile",value:isFile})

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
            url : "<?php echo base_url('c_nup_payment/save');?>",
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
        $.getJSON("<?php echo base_url('c_nup_payment/getByID');?>" + "/" + id, function (data) {
            console.log(data);
            $('#payment_cd').val(data[0].payment_cd)
            $('#descs').val(data[0].descs)
            $('#row_id').val(data[0].row_id)

            $('#image').val(data[0].logo);

            var url = '<?php echo base_url("/img/payment_logo/") ?>' + data[0].logo;
            console.log(url);
            if(url == "" || url == null)
            {

            }
            else{
                var filename = url.substring(url.lastIndexOf('/')+1);
                $('#labelimage').text(filename);
                $('#picturebox').attr("src",url);
            }

            // var email = data[0].email
            // $(".icheckbox_line-blue").removeClass("checked")
            // $.getJSON("<?php echo base_url('C_User_Access/getByIDproject');?>" + "/" + email, function (data) {
            //     $.each(data, function( index, value ) {
            //         var project = value.project_no;
            //         var descs = value.descs_project;
            //         $("#"+project).attr('checked', 'checked');
            //         $("#"+project).iCheck({
            //           checkboxClass: 'icheckbox_line-blue checked',
            //           insert: '<div class="icheck_line-icon"></div>' + descs
            //         });
            //     });
            // })
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