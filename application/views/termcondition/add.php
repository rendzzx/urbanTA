<!-- link -->
    <link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">
<!-- end link -->
<!-- style -->
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

        .input-group-addon.btn.btn-default.btn-file {
            line-height: .2px !important;
        }
    </style>
<!-- end style -->

<!-- <div id="loader" class="loader" hidden="true"></div> -->
<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_gallery/save_gallery" enctype="multipart/form-data">
    <div class="box-body">
        <div class="form-group">
            <input type="hidden" id="pdf" name="pdf"  readonly="readonly" />
            <label class="col-xs-2">Upload Pdf</label>
            <div class="col-xs-8">
                <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput" style="word-wrap: anywhere;">
                    <div class="form-control" data-trigger="fileinput" style="pointer-events:none;width: 70% !important;line-height: 30px !important;">
                        <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                        <span class="fileinput-filename" id="pictname"></span>
                    </div>
                    <span class="input-group-addon btn btn-default btn-file">
                        <span class="btn btn-sm fileinput-new">Select file</span>
                        <span class="btn btn-sm fileinput-exists">Change</span>
                        <input type="file" id="userfile" name="userfile" accept="application/pdf">
                    </span>
                </div>
            </div>
        </div>
        <img src="" id="picturebox" width="120px" class="img-responsive"><br>
    </div>
</form>

<!-- script -->
    <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
    <script src="<?=base_url('js/plugins/jasny/jasny-bootstrap.min.js')?>"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>
<!-- script -->

<script>
// Function loading
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
// end function loading

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
            block(true);
            $.getJSON("<?php echo base_url('c_termcondition/getByID');?>" + "/" + id, function (data) {

                $('#pdf').val(data[0].file_url);
                
                if(data[0].Url!= ""){
                    document.getElementById("pictname").innerHTML = data[0].file_url;
                    $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                }
                else{
                    document.getElementById("pictname").innerHTML = data[0].file_url;
                }
                var pict_name = data[0].file_url;
                block(false);
            });
        }
    }

    var isFile=false;
    var jqXHRData;

    $(document).ready(function(){

        loaddata();

        $("#userfile").on('change', function (){
            $("#pdf").val(this.files[0].name);
        });

        // $.validator.addMethod("cek_data", function (value, element) {
        //     var isSuccess = false;
        //     // var file_attachment = $('#file_attachment').val();
            
        //     // alert(content.length);
        //     // if(content==null||content =='' && youtubelink == null||youtubelink=='' && picture ==null || picture ==''){
        //     // if(file_attachment.length == 0){
        //     //     // isSuccess=true;
        //     //     // alert('pict ='+picture.length+' yt '+youtubelink.lenght+ ' content '+content.lenght);
        //     // }else{
        //     //     isSuccess=true;

        //     //      // alert(picture.lenght);
        //     // }
        //     // alert(isSuccess);
        //     return isSuccess;

        // });

        // $("#frmEditor").validate({
        //     rules: {
        //         file_url:{
        //             cek_data:true
        //         },
        //     },
        //     messages: {
        //         file_url: {
        //             cek_data: "One of this Field can't be blank",
        //         },
        //     },
        //     // errorElement: "em",
        //     errorElement: "span",
        //     highlight: function (element, errorClass, validClass) {
        //           $(element).addClass(errorClass); //.removeClass(errorClass);
        //           $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        //     },
        //     unhighlight: function (element, errorClass, validClass) {
        //           $(element).removeClass(errorClass); //.addClass(validClass);
        //           $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        //     },
        //     errorPlacement: function (error, element) {
        //           if (element.parent('.input-group').length) {
        //             error.insertAfter(element.parent());
        //           } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
        //             error.insertAfter(element.next('span'));
        //           } else {
        //             error.insertAfter(element);
        //           }
        //     }
        // });

        $('#userfile').fileupload({
            url: "<?php echo base_url('c_termcondition/save_termcondition');?>",
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
                tblterm.ajax.reload(null,true); 
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
            block(true);
            // document.getElementById('loader').hidden=false;
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
                    url : "<?php echo base_url('c_termcondition/save_termcondition');?>",
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
                          tblterm.ajax.reload(null,true);
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