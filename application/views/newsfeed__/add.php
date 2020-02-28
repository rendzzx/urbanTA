      
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<link href="<?=base_url('css/plugins/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">

<!--<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>  -->
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>
 
 <style type="text/css">
    label {
      text-align: right;
    }
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
 </style>

        <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_newsfeed/save_newsfeed" enctype="multipart/form-data">
                 <div class="box-body">


                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2">Subject </label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject newsfeed">
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="contentnewsfeed" class="col-xs-2">Content </label>
                     <div class="col-xs-8">
                       <!-- <input type="text" class="form-control" name="name" id="contentnewsfeed" placeholder="Content newsfeed"> -->
                       <!-- <div class="box-body pad"> -->
                        <textarea class="form-control" name="content" id="content" placeholder="Place content newsfeed here" ></textarea>
                       <!-- </div> -->
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="youtubenewsfeed" class="col-xs-2">Youtube Embeded Link </label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="youtubelink" id="youtubelink" placeholder="Youtube link">
                       <input type="hidden" class="form_control" id="project_no" name="project_no" value="<?php echo $project_no;?>">
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="statusnewsfeed" class="col-xs-2">Status </label>
                     <div class="col-xs-8">
                       <!-- <input type="text" class="form-control" name="name" id="contentnewsfeed" placeholder="Content newsfeed"> -->
                       <select class="form-control select2" name="status" id="status">
                        <option value="1">Information</option>
                        <option value="2">Warning</option>
                      </select>
                     </div>
                    </div>
                    <div class="form-group">
                      <label class="col-xs-2">Date Created</label>
                        <div class="col-xs-8">
                            <div class="input-group">                            
                            <input id="date_created" name="date_created" class="form-control" type="text" value="<?php 
                                $mydate=date("d/m/Y");
                                // $Tanggal = "$mydate[mday] $mydate[month] $mydate[year]";
                                echo "$mydate";//[mday] / $mydate[month] / $mydate[year]";
                                // echo $Tanggal;
                          ?>">
                            <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                  </div>
                   <div class="form-group">
                   <!-- <div class="col-xs-2"> -->
                     <!-- <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/*" />

                        </span> -->

                        <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                        <input type="hidden" id="seqno" name="seqno"  readonly="readonly" value="<?php echo $seq_no?>" />
                   <!-- </div> -->
                   <label class="col-xs-2">Upload Picture</label>
                    <div class="col-xs-8">
                        <!-- <img id="picturebox" width="118" src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="Your Image" /> -->
                        <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                <span class="fileinput-filename" id="pictname"></span>
                            </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Select file</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" id="userfile" name="userfile" accept="image/*">
                                </span>
                                <!-- <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                        </div>
                    </div>
                </div>
                
                    </div>
                 </div><!-- /.box-body -->
                 <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                </div>
                </form>



<script type="text/javascript">
$(".select2").select2({
            allowClear: false,
            multiple: false,
            tags: true,
            width:'100%'
            // ...other settings,
            // ajax: {
            //         ...  
            // }
        }).on("change", function (e) {
            $(this).valid(); //jquery validation script validate on change
        }).on("select2:open", function() { //correct validation classes (has=*)
            if ($(this).parents("[class*='has-']").length) { //copies the classes
                var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);

                for (var i = 0; i < classNames.length; ++i) {
                    if (classNames[i].match("has-")) {
                        $("body > .select2-container").addClass(classNames[i]);
                    }
                }
            } else { //removes any existing classes
                $("body > .select2-container").removeClass (function (index, css) {
                    return (css.match (/(^|\s)has-\S+/g) || []).join(' ');
                });            
            }
        }

      );


  $(document).ready(function () {
    $("#status").select2({
            dropdownParent: "#modal",
            width:"100%"
        });
var isFile=false;
var jqXHRData;
loaddata();
$('#date_created').datepicker({
    format: 'dd/mm/yyyy',
      autoclose: true,
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true
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
          } else if (element.hasClass('select2')) {
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
            // errorPlacement: function (error, element) {
            //     // Add the `help-block` class to the error element
            //     error.addClass("help-block  text-red");

            //     // Add `has-feedback` class to the parent div.form-group
            //     // in order to add icons to inputs
            //     element.parents(".col-xs-5").addClass("has-feedback  text-red");

            //     if (element.prop("type") === "checkbox") {
            //         error.insertAfter(element.parent("label"));
            //     } else {
            //         error.insertAfter(element);
            //     }

            //     // Add the span element, if doesn't exists, and apply the icon classes to it.
            //     if (!element.next("span")[0]) {
            //         $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 95%' ></span>").insertAfter(element);
            //     }
            // },
            // success: function (label, element) {
            //     // Add the span element, if doesn't exists, and apply the icon classes to it.
            //     if (!$(element).next("span")[0]) {
            //         $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 95%'></span>").insertAfter($(element));
            //     }
            // },
            // highlight: function (element, errorClass, validClass) {
            //     $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
            //     $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            // },
            // unhighlight: function (element, errorClass, validClass) {
            //     $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
            //     $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
            // }
        });

        $('#userfile').fileupload({
            url: "<?php echo base_url('c_newsfeed/save_newsfeed');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;                
            },
            done: function (event, response) {

                var res = response.result;
                // console.log(res);
                // console.log(response.);
                // BootstrapDialog.alert();
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
                        

                // $('[data-id=' + id + ']').remove();
                
                tblnewsfeed.ajax.reload(null,true); 

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
                    url : "<?php echo base_url('c_newsfeed/save_newsfeed');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    dataType:"json",
                    success:function(event, data){
                        // console.log('2');

                        if(event.status=='OK'){

                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          $('#modal').modal('hide');
                          tblnewsfeed.ajax.reload(null,true);
                        } else {
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                      }
                        //   BootstrapDialog.show({
                        //   type: BootstrapDialog.TYPE_DANGER,
                        //   title: 'Error',
                        //   message: event.Pesan,
                        //   buttons: [{
                        //     label: 'OK',
                        //     action: function(dialogItself){
                        //     dialogItself.close();
                        //     }
                        //    }]
                        // });
                        // } 
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


        $("#userfile").on('change', function () {

            // $("#Picture").val(this.files[0].FileList);
            // console.log(this.files[0].name);
            // return;
            // console.log('1');
            $("#Picture").val(this.files[0].name);
            // readURL(this);
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
                
                if(data[0].picture!="")
                {
                    document.getElementById("pictname").innerHTML = data[0].picture;
                $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                }
                else {
                    document.getElementById("pictname").innerHTML = data[0].picture;
                }
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