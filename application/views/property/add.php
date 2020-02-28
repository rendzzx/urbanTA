<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
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
    .input-group-addon.btn.btn-default.btn-file {

        line-height: .2px !important;

        }
</style>

<!-- <div id="loader" class="loader" hidden="true"></div> -->
<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_pm_level/save_level" enctype="multipart/form-data">
    <div class="box-body">
        <div class="form-group">
            <input type="hidden" id="image" name="image"  readonly="readonly" />
            <label class="col-xs-2">Upload Picture</label>
            <div class="col-xs-8">
                <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput" style="pointer-events:none;width: 70% !important;line-height: 30px !important;">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                        <span class="fileinput-filename" id="pictname"></span>
                    </div>
                    <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" id="userfile" name="userfile" accept="image/*">
                    </span>
                </div>
                <p style="color: red">(* Only Jpg, Png, Gif allowed and maximum file size <?php echo $max_upload_size?>)</p>
            </div>
            <div class="col-md-2 col-md-offset-5">
                <img src="" id="picturebox" width="120px" class="img-responsive"><br>
            </div>
        </div>
    </div>
    <!-- <div class="modal-footer">
        <button type="button" id="savefrm" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
    </div> -->
</form>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
<script src="<?=base_url('js/plugins/jasny/jasny-bootstrap.min.js')?>"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
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
        // console.log(id)
            
            if (id > 0) {
                    // panggil function loadin
                    block(true); 
                    // end panggil function loading
                $.getJSON("<?php echo base_url('c_property/getByID');?>" + "/" + id, function (data) {

                    // $('#title').val(data[0].gallery_title);
                    // console.log(data[0]);
                    
                    var url,filename,pict_name;
                    
                    if(data[0].picture_url==null)
                    {
                        document.getElementById("pictname").innerHTML = "No Image";
                        $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                    }
                    else {
                        url = data[0].picture_url;
                        filename = url.substring(url.lastIndexOf('/')+1);
                        document.getElementById("pictname").innerHTML = filename;
                        pict_name = data[0].picture_url;
                        $('#picturebox').attr("src",pict_name);
                        $('#image').val(data[0].picture_url);
                    }
                     
                    // alert(data[0].picture);
                    
                    // panggil function loadin
                    block(false); 
                    // end panggil function loading
                });
            }
    }

    var isFile=false;
    var jqXHRData;

    $(document).ready(function(){
        $(document).on('hidden.bs.modal', '#modal', function () {
            $('div.modal-body').empty();
            $("#savefrm_property").prop('disabled', false)
        });
        var max_upload_size = '<?php echo $max_upload_size?>';
        var max_size = '<?php echo $max_size?>';
        $('#userfile').bind('change', function() {

            var size = this.files[0].size
            // alert(this.files[0].size)
            if (size>=max_size) {
                swal({
                    title: "Information",
                    animation: false,
                    type:"warning",
                    text: "Can't upload image more than "+max_upload_size,
                    confirmButtonText: "OK"
                  });
                $("#savefrm_property").prop('disabled', true)
                $('#picturebox').attr('src', '');
            }
            else{
                $("#savefrm_property").prop('disabled', false)
                $("#image").val(this.files[0].name);
                readURL(this);
            }

        });
        
        loaddata();



        $('#userfile').fileupload({
            url: "<?php echo base_url('c_property/save_property');?>",
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
                tblproperty.ajax.reload(null,true); 

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
            }
        });

        $('#savefrm_property').click(function(){
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
                    url : "<?php echo base_url('c_property/save_property');?>",
                    type:"POST",
                    data:datafrm,
                    dataType:"json",
                    success:function(event, data){

                        if(event.status=='OK'){
                        // document.getElementById('loader').hidden=true;
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          $('#modal').modal('hide');
                          tblproperty.ajax.reload(null,true);
                        } else {
                            // document.getElementById('loader').hidden=true;
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                      }
                        block(false);
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