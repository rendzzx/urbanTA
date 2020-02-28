<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link href="<?=base_url('css/plugins/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">
<style type="text/css">
    label {
      text-align: right;
    }
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
    }

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
    .input-group-addon{
        padding: 1.5rem !important;
    }
    .custom-file-control.selected:lang(en)::after {
  content: "" !important;
}
.input-group-addon.btn.btn-default.btn-file {

line-height: .2px !important;

}
</style>

<!-- <div id="loader" class="loader" hidden="true"></div> -->
<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_lottype/save_lottype" enctype="multipart/form-data">
    <div class="box-body">
        <div class="form-group">
            <label for="project_name" class="col-xs-4">Unit Type</label>
            <div class="col-xs-8">
                <select name="lot_type" id="lot_type" data-placeholder="Choose a Lot Type..." class="select2 form-control" style="width: 100% !important">
                    <option value=""></option> 
                        <?php 
                            foreach ($lot_type as $row) 
                                      {
                                          echo '<option value="'.$row->lot_type.'">'.$row->descs.'</option>';
                                      }
                        ?>            
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="subjectnewsfeed" class="col-xs-2">Gallery Title</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="title" id="title" placeholder="Gallery Title">
            </div>
        </div>
       
        <div class="form-group">
            <input type="hidden" id="image" name="image"  readonly="readonly" />
            <label class="col-xs-2">Upload Picture</label>
            <div class="col-xs-8">
                <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput" style="word-wrap: anywhere;">
                
                    <div class="form-control" data-trigger="fileinput" style="pointer-events:none;width: 70% !important;line-height: 30px !important;">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                        <span class="fileinput-filename" id="pictname"></span>
                        <!-- <div class="fileinput-filename" id="pictname"></div> -->
                    </div>
                    
                    <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" id="userfile" name="userfile" accept="image/*">
                    </span>
                </div>
                <p style="color: red">(* Only Jpg, Png, Gif allowed and maximum file size 300kb)</p>
            </div>
            <div class="col-md-2 col-md-offset-5">
                <img src="" id="picturebox" width="120px" class="img-responsive"><br>
            </div>
        </div>
    </div>
    <!-- <div class="modal-footer">
        <button type="button" id="btnSave" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
    </div> -->
</form>


<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/jasny/jasny-bootstrap.min.js')?>"></script>
<script>
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

    function loaddata(){
        var id = $('#modal').data('id');
            
            if (id > 0) {
                // panggil function loadin
                block(true); 
                $.getJSON("<?php echo base_url('c_lottyped/getByID');?>" + "/" + id, function (data) {

                    $('#lot_type').val(data[0].lot_type).trigger("change");
                    $('#title').val(data[0].gallery_title);
                    $('#image').val(data[0].gallery_url);
                    var url = data[0].gallery_url;
                    var filename = url.substring(url.lastIndexOf('/')+1);
                    
                    if(data[0].gallery_url!="")
                    {
                        document.getElementById("pictname").innerHTML = filename;
                        $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                    }
                    else {
                        document.getElementById("pictname").innerHTML = filename;
                    }
                     var pict_name = data[0].gallery_url;
                    // alert(data[0].picture);
                     $('#picturebox').attr("src",pict_name);
                     // panggil function loadin
                    block(false); 
                });
            }
    }

    var isFile=false;
    var jqXHRData;

    $(document).ready(function(){
        $("#project_no").select2({
            // dropdownParent: "#modal",
            width:"100%"
        });


        loaddata();

        $('#userfile').bind('change', function() {

        var size = this.files[0].size
        // alert(this.files[0].size)
        if (size>=300000) {
            swal({
                title: "Information",
                animation: false,
                type:"warning",
                text: "cannot upload image more than 300kb",
                confirmButtonText: "OK"
              });
            $("#savefrm").prop('disabled', true)
        }
        else{
            $("#savefrm").prop('disabled', false)
        }

    });
        
        $("#userfile").on('change', function () {

            $("#image").val(this.files[0].name);
            // $(this).next('.custom-file-label').html(fileName);
            readURL(this);

        });

        $.validator.addMethod("cek_data", function (value, element) {
            var isSuccess = false;
            var title = $('#title').val();
            
            // alert(content.length);
            // if(content==null||content =='' && youtubelink == null||youtubelink=='' && picture ==null || picture ==''){
            if(title.length == 0){
                // isSuccess=true;
                // alert('pict ='+picture.length+' yt '+youtubelink.lenght+ ' content '+content.lenght);
            }else{
                isSuccess=true;

                 // alert(picture.lenght);
            }
            // alert(isSuccess);
            return isSuccess;

        });

         $("#frmEditor").validate({
            rules: {
                title:{
                    cek_data:true
                },
            },
            messages: {
                title: {
                    cek_data: "One of this Field can't be blank",
                },
            },
            // errorElement: "em",
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

        $('#userfile').fileupload({
            url: "<?php echo base_url('c_lottyped/save_lottyped');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;                
            },
            done: function (event, response) {

                var res = response.result;
                if(res.status =='OK'){
                    swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: res.Pesan,
                            confirmButtonText: "OK"
                          });
                    $('#modal').modal('hide');
                }else{
                     swal({
                            title: "Warning",
                            animation: false,
                            type:"error",
                            text: res.Pesan,
                            confirmButtonText: "OK"
                          });
                }
                tbllotd.ajax.reload(null,true); 
                block(false);
            },
            fail: function (event, response) {
                // BootstrapDialog.alert(response.result.Pesan);
                var error = response["_response"]["errorThrown"];
                // console.log(event);
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: error,
                    confirmButtonText: "OK"
                          });
                block(false);
            }
        });

        $('#savefrm').click(function(){
            // document.getElementById('loader').hidden=false;
            block(true);
            if($('#frmEditor').valid()){
                var id = $('#modal').data('id');
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push({name:"isFile",value:isFile},{name:"id",value:id})
                var obj = new Object();
                // obj.id = id;
                obj.isFile = isFile;
                if(isFile){
                  // alert('sukses Picture');
                  if(jqXHRData){
                    jqXHRData.formData = datafrm;
                    jqXHRData.submit();
                    
                  }
                }
                else{
                    $.ajax({
                    url : "<?php echo base_url('c_lottyped/save_lottyped');?>",
                    type:"POST",
                    data:datafrm,
                    dataType:"json",
                    success:function(event, data){

                        if(event.status=='OK'){
                            block(false);
                        // document.getElementById('loader').hidden=true;
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          $('#modal').modal('hide');
                          tbllotd.ajax.reload(null,true);
                        } else {
                            block(false);
                            // document.getElementById('loader').hidden=true;
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
                }
            }
        });

   });
</script>