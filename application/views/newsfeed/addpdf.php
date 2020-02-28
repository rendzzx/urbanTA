      
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet" />
  <link rel="stylesheet" href="<?=base_url('css/test/select2.min.css')?>">
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>           
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>  
<script src="<?=base_url('css/test/select2.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>
        <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_newsfeed/save_newsfeed" enctype="multipart/form-data">
                 <div class="box-body">

                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2">Description </label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="descs" id="descs" placeholder="Attachment Description">
                     </div>
                    </div>
                    
                </div>
                   <div class="form-group">
                   <label  class="col-xs-2">Upload File </label>
                   <div class="col-xs-8">
                     <!-- <span class="btn btn-success fileinput-button">
                            <span>Select File Pdf...</span>
                            <input type="file" id="userfile" name="userfile" accept="application/pdf" />
                        </span> -->
                        <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename" id="pdfname"></span></div>
                                <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" id="userfile" name="userfile" accept="application/pdf"></span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                        <input type="hidden" id="pdf" name="pdf"  readonly="readonly" />
                        <input type="hidden" id="seqno" name="seqno"  readonly="readonly" value="<?php echo $seq_no?>" />
                        <input type="hidden" class="form_control" id="project_no" name="project_no" value="<?php echo $project_no;?>">
                   </div>
                    <!-- <div class="col-xs-8">
                        <img id="picturebox" width="118" src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="Your File" />
                    </div> -->
                </div>
                
                    </div>
                 </div><!-- /.box-body -->
                 <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                </div>
                </form>



<script type="text/javascript">
  $(document).ready(function () {
    var isFile=false;
    var jqXHRData;
    loaddata();
    
 

    $.validator.addMethod("cek_data", function (value, element) {
            var isSuccess = false;
            var descs = $('#descs').val();
            var pdf = $('#pdf').val();
            
            // alert(content.length);
            // if(content==null||content =='' && youtubelink == null||youtubelink=='' && picture ==null || picture ==''){
            if(descs.length == 0 && pdf.length ==0 ){
                // isSuccess=true;
                // alert('pict ='+picture.length+' yt '+youtubelink.lenght+ ' content '+content.lenght);
            }else{
                isSuccess=true;

                 // alert(picture.lenght);
            }
            // alert(isSuccess);
            return isSuccess;

        });
    $.validator.addMethod("cek_youtube", function (value, element) {
            var isSuccess = true;            
            var url = $('#youtubelink').val();
        
            if (url.length != '0') {
                
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                var match = url.match(regExp);
                
                if (match && match[2].length == 11) {
                    // Do anything for being valid
                    // if need to change the url to embed url then use below line
                    // $('#ytplayerSide').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=0');
                    isSuccess = true;
                    
                }
                else {
                    // Do anything for not being valid
                    
                    isSuccess = false;
                }
            }
            
            return isSuccess;

        });
 $("#frmEditor").validate({
            rules: {
                descs: {
                    required: true//,
                    // maxlength: 20,
                    
                },
                pdf:{
                    cek_data:true
                }
            },
            messages: {
                pdf: {
                    cek_data: "Please Select a File."
                }
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

        $('#userfile').fileupload({
            url: "<?php echo base_url('c_newsfeed/save_pdf');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;                
            },
            done: function (event, response) {
                console.log(event);
                console.log(response);
                var res = response.result;
                if(res.status!="OK"){
                    swal({
                                title: "Information",
                                animation: false,
                                type:"error",
                                text: res.Pesan,
                                confirmButtonText: "OK"
                              });
                }else {
                    swal({
                                title: "Information",
                                animation: false,
                                type:"success",
                                text: res.Pesan,
                                confirmButtonText: "OK"
                              });

                    // $('[data-id=' + id + ']').remove();
                    $('#modal').modal('hide');
                    tblattachment.ajax.reload(null,true); 
                }
                

            },
            fail: function (event, response) {
                // BootstrapDialog.alert(response.result.Pesan);
                swal({
                                title: "Error",
                                animation: false,
                                type:"error",
                                text: response.result.Pesan,
                                confirmButtonText: "OK"
                              });
            }
        });
        $("#userfile").on('change', function () {

            $("#pdf").val(this.files[0].name);
            

        });


    $('#btnSave').click(function(){
      if($('#frmEditor').valid()){
                var id = $('#modal').data('id');
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push({name:"id",value:id},{name:"isFile",value:isFile});
                var obj = new Object();
                obj.id = id;
                obj.isFile = isFile;

                if(isFile){
                  // alert('sukses Picture');
                  if(jqXHRData){
                    jqXHRData.formData = datafrm;
                    jqXHRData.submit();
                    
                  }
                }else{
                   
                    $.ajax({
                    url : "<?php echo base_url('c_newsfeed/save_pdf');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: $('#frmEditor').serialize() + '&' + $.param(obj),
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
                          $('#modal').modal('hide');
                          tblattachment.ajax.reload(null,true);
                        } else {
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
                    }
                    });
                }       
      }
    });


 
function loaddata(){
    var id = $('#modal').data('id');
        ScreenID = id;
        
        if (id > 0) {
            $.getJSON("<?php echo base_url('c_newsfeed/getAttachByID');?>" + "/" + id, function (data) {
                //var tes = JSON.parse(data);
                // alert(data[0].youtube_link);
                console.log(data);
                $('#descs').val(data[0].descs);
                $('#pdf').val(data[0].file_name);
                if(data[0].file_name!="")
                {
                    document.getElementById("pdfname").innerHTML = data[0].file_name;
                    $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                }
                else {
                    document.getElementById("pdfname").innerHTML = data[0].file_name;
                }

                // $('#userfile').val(data[0].file_name);
                // document.getElementById("pdfname").innerHTML = data[0].file_name;
                // $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                // $('#Picture').val(data.Picture);
                
                // document.getElementById('Level').value = data.Level;
                // $('#picturebox').attr('src', '@Url.Content("~/Picture/")' + data.Picture);

                // document.getElementById("UserCode").readOnly = true;

            });
        }
}
   

    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
});
</script>                