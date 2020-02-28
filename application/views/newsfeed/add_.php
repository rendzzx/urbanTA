      
<link href="<?=base_url('plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link href="<?=base_url('plugins/datepicker/datepicker3.css')?>" rel="stylesheet" />

<script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>           
<script src="<?=base_url('plugins/datepicker/bootstrap-datepicker.js')?>"></script>  

        <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_newsfeed/save_newsfeed" enctype="multipart/form-data">
                 <div class="box-body">

                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2 control-label">Subject </label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject newsfeed">
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="contentnewsfeed" class="col-xs-2 control-label">Content </label>
                     <div class="col-xs-8">
                       <!-- <input type="text" class="form-control" name="name" id="contentnewsfeed" placeholder="Content newsfeed"> -->
                       <!-- <div class="box-body pad"> -->
                        <textarea class="form-control" name="content" id="content" placeholder="Place content newsfeed here" ></textarea>
                       <!-- </div> -->
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="youtubenewsfeed" class="col-xs-2 control-label">Youtube Embeded Link </label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="youtubelink" id="youtubelink" placeholder="Youtube link">
                       <input type="hidden" class="form_control" id="project_no" name="project_no" value="<?php echo $project_no;?>">
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="statusnewsfeed" class="col-xs-2 control-label">Status </label>
                     <div class="col-xs-8">
                       <!-- <input type="text" class="form-control" name="name" id="contentnewsfeed" placeholder="Content newsfeed"> -->
                       <select class="form-control" name="status" id="status">
                        <option value="1">Information</option>
                        <option value="2">Warning</option>
                      </select>
                     </div>
                    </div>
                    <div class="form-group">
                      <label class="col-xs-2 control-label">Date Created</label>
                        <div class="col-xs-8">
                            <div class="input-group">                            
                            <input id="date_created" name="date_created" class="form-control" type="text" value="<?php 
                                $mydate=date("d/m/Y");
                                // $Tanggal = "$mydate[mday] $mydate[month] $mydate[year]";
                                echo "$mydate";//[mday] / $mydate[month] / $mydate[year]";
                                // echo $Tanggal;
                          ?> ">
                            <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                  </div>
                   <div class="form-group">
                   <div class="col-xs-2">
                     <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <!-- <input type="file" id="userfile" name="userfile" accept="image/*" /> -->
                            <input type="file" id="userfile" name="userfile" accept="image/*" />
                        </span>
                        <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                   </div>
                    <div class="col-xs-8">
                        <img id="picturebox" width="118" src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="Your Image" />
                    </div>
                </div>
                
                    </div>
                 </div><!-- /.box-body -->
                 <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                </form>



<script type="text/javascript">
  $(document).ready(function () {
var isFile=false;
var jqXHRData;
loaddata();
$('#date_created').datepicker({
    format: 'dd/mm/yyyy',
      autoclose: true
    });
    $.validator.addMethod("cek_data", function (value, element) {
            var isSuccess = false;
            var content = $('#content').val();
            var youtubelink = $('#youtubelink').val();
            var picture = $('#Picture').val();
            
            // alert(content.length);
            // if(content==null||content =='' && youtubelink == null||youtubelink=='' && picture ==null || picture ==''){
            if(content.length == 0 && youtubelink.length == 0 && picture.length ==0 ){
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
                subject: {
                    required: true//,
                    // maxlength: 20,
                    
                },
                content:{
                    cek_data:true
                },
                youtubelink:{
                    cek_data:true,
                    cek_youtube:true
                },
                picture:{
                    cek_data:true
                }

            },
            messages: {
                content: {
                    cek_data: "One of this Field can't be blank"
                },
                youtubelink: {
                    cek_data: "One of this Field can't be blank",
                    cek_youtube: "Invalid Youtube Link"
                },
                picture: {
                    cek_data: "One of this Field can't be blank"
                }
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block  text-red");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents(".col-xs-5").addClass("has-feedback  text-red");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!element.next("span")[0]) {
                    $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 95%' ></span>").insertAfter(element);
                }
            },
            success: function (label, element) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!$(element).next("span")[0]) {
                    $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 95%'></span>").insertAfter($(element));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
            }
        });
$('#file').fileupload({
            url: "<?php echo base_url('c_newsfeed/save_newsfeed');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;
                console.log(data);
                
            },
            done: function (event, response) {

                var res = response.result;

                alert(res.Pesan);
                

                // $('[data-id=' + id + ']').remove();
                $('#modal').modal('hide');
                tblnewsfeed.ajax.reload(null,true); 

            },
            fail: function (event, response) {
                alert(response.result.Pesan);
            }
        });


    $('#btnSave').click(function(){
      if($('#frmEditor').valid()){
                // alert('aa');
                var id = $('#modal').data('id');
                // var userfile = $('#userfile').val();
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push({name:"id",value:id}
                    ,{name:"isFile",value:isFile}
                    // ,{name:"userfile",value:userfile}
                    );


                var obj = new Object();
                obj.id = id;
                obj.isFile = isFile;
                // alert(isFile);
console.log(datafrm);

                if(isFile){
                  // alert('sukses Picture');
                  if(jqXHRData){
                    jqXHRData.formData = datafrm;
                    jqXHRData.submit();
                    
                  }
                }else{
                   
                    $.ajax({
                    url : "<?php echo base_url('c_newsfeed/save_newsfeed');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    dataType:"json",
                    success:function(event, data){
                        alert(event.Pesan);
                        
                        $('#modal').modal('hide');
                        tblnewsfeed.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });
                }       
      }
    });


 $("#file").on('change', function () {

            $("#Picture").val(this.files[0].name);
            readURL(this);
            // alert($("#Picture").val());

        });

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

  });
function loaddata(){
    var id = $('#modal').data('id');
        ScreenID = id;
        
        if (id > 0) {
            $.getJSON("<?php echo base_url('c_newsfeed/getByID');?>" + "/" + id, function (data) {
                //var tes = JSON.parse(data);
                // alert(data[0].youtube_link);
                console.log(data);
                $('#subject').val(data[0].subject);
                $('#content').val(data[0].content);
                $('#youtubelink').val(data[0].youtube_link);
                $('#status').val(data[0].status);
                $('#Picture').val(data[0].picture);
                var bb = data[0].date_created;
                var year =bb.substr(0,4);
                var month=bb.substr(5,2);
                var day =bb.substr(8,2);
                var aa = day+"/"+month+"/"+year;
                $('#date_created').val(aa);
                 var pict_name = data[0].picture;
                // alert(data[0].picture);
                 $('#picturebox').attr("src", "<?=base_url('img/NewsFeed/')?>" +"/"+pict_name);
                // $('#Picture').val(data.Picture);
                
                // document.getElementById('Level').value = data.Level;
                // $('#picturebox').attr('src', '@Url.Content("~/Picture/")' + data.Picture);

                // document.getElementById("UserCode").readOnly = true;

            });
        }
}
   // $('#modal').one('shown.bs.modal', function (e) {

        // var id = $('#modal').data('id');
        // ScreenID = id;
        // alert('add '+id);
        // if (id > 0) {
        //     $.getJSON("<?php echo base_url('c_newsfeed/getByID');?>" + "/" + id, function (data) {
        //         //var tes = JSON.parse(data);
        //         // alert(data[0].youtube_link);
        //         console.log(data);
        //         $('#subject').val(data[0].subject);
        //         $('#content').val(data[0].content);
        //         $('#youtubelink').val(data[0].youtube_link);
        //         $('#status').val(data[0].status);
        //         $('#Picture').val(data[0].picture);
        //         var bb = data[0].date_created;
        //         var year =bb.substr(0,4);
        //         var month=bb.substr(5,2);
        //         var day =bb.substr(8,2);
        //         var aa = day+"/"+month+"/"+year;
        //         $('#date_created').val(aa);
        //          var pict_name = data[0].picture;
        //         // alert(data[0].picture);
        //          $('#picturebox').attr("src", "<?=base_url('img/NewsFeed/')?>" +"/"+pict_name);
        //         // $('#Picture').val(data.Picture);
                
        //         // document.getElementById('Level').value = data.Level;
        //         // $('#picturebox').attr('src', '@Url.Content("~/Picture/")' + data.Picture);

        //         // document.getElementById("UserCode").readOnly = true;

        //     });
        // }


    // });

    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>                