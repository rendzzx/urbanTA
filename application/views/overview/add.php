<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
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
</style>
<style type="text/css">
    .loader{
      width:100%;
      height:100%;
      position:fixed;
      z-index:9999;
      background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center     
    }  
</style> 

<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_overview/save_overview" enctype="multipart/form-data">
    <div class="box-body">
        <div id="overview">
        </div>
        <br>
        <br>
        <div class="form-group">
            <label for="youtubenewsfeed" class="col-xs-2">Youtube Link</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="youtubelink" id="youtubelink" placeholder="Youtube link">
            </div>
        </div>
        <div class="form-group">
            <input type="hidden" id="pdf" name="pdf"  readonly="readonly" />
            <label class="col-xs-2">Upload Brochure</label>
            <div class="col-xs-8">
                <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput">
                    <div class="form-control" data-trigger="fileinput">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                        <span class="fileinput-filename" id="pictname"></span>
                    </div>
                    <span class="input-group-addon btn btn-default btn-file">
                        <span class="fileinput-new">Select file</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" id="userfile" name="userfile" accept="application/pdf">
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btnSave" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
    </div>
</form>
<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script>

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

    var isFile=false;
    var jqXHRData;

    $(document).ready(function(){

        $.getJSON("<?php echo base_url('c_overview/getByID');?>",
            function (data) {
                // console.log(data);
                var overview = data[0].overview_info
                $('#overview').summernote({
                    toolbar: [
    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                  ]
                });
                $('#overview').summernote('code',overview)
                $('#youtubelink').val(data[0].youtube_link);
                if(data[0].url_brochure!="")
                {
                    document.getElementById("pictname").innerHTML = data[0].url_brochure;
                    $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                }
                else {
                    document.getElementById("pictname").innerHTML = data[0].url_brochure;
                }
            }
        );

        $("#userfile").on('change', function () {

            $("#pdf").val(this.files[0].name);

        });

        $.validator.addMethod("cek_youtube", function (value, element) {
            var isSuccess = true;            
            var url = $('#youtubelink').val();
            if (url.length != '0') {
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                var match = url.match(regExp);
                if (match && match[2].length == 11) {
                    isSuccess = true;
                }
                else {
                    isSuccess = false;
                }
            }
            return isSuccess;
        });

         $("#frmEditor").validate({
            rules: {
                youtubelink:{
                    cek_youtube:true
                },
            },
            messages: {
                youtubelink: {
                    cek_data: "One of this Field can't be blank",
                    cek_youtube: "Invalid Youtube Link"
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
            url: "<?php echo base_url('c_overview/save_overview');?>",
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
                tbloverview.ajax.reload(null,true); 

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

        $('#btnSave').click(function(){
            document.getElementById('loader').hidden=false; 
            if($('#frmEditor').valid()){
                var datafrm = $('#frmEditor').serializeArray();
                var overview = $('#overview').summernote('code')
                var id = $('#modal').data('id');
                datafrm.push({name:'overview',value:overview},{name:"isFile",value:isFile},{name:"id",value:id})
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
                    url : "<?php echo base_url('c_overview/save_overview');?>",
                    type:"POST",
                    data:datafrm,
                    dataType:"json",
                    success:function(event, data){

                        if(event.status=='OK'){
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          document.getElementById('loader').hidden=true;
                          $('#modal').modal('hide');
                          tbloverview.ajax.reload(null,true);
                        } else {
                            document.getElementById('loader').hidden=false;
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          document.getElementById('loader').hidden=true;
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
                     
                    }
                });
                }
            }
        });

   });
</script>