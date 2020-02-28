      
<link href="<?=base_url('app-assets/vendors/css/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script src="<?=base_url('app-assets/vendors/js/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<link href="<?=base_url('app-assets/vendors/css/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">


<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>

  <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet">
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

<!-- <div id="loader" class="loader" hidden="true"></div> -->

        <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>newsandpromo/save_newsfeed" enctype="multipart/form-data">
                 <div class="box-body">
                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2">Content Type</label>
                     <div class="col-xs-8">
                       <input type="radio" name="news" id="news" value="news" checked=""  style="margin-right: 10px;"><label style="padding-right: 10px;">News</label>
                       <input type="radio" name="news" id="promo" value="promo"  style="margin-right: 10px;"><label>Promo</label>
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2">Subject</label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
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
                     <label for="subjectnewsfeed" class="col-xs-2">Content Type</label>
                     <div class="col-xs-8">
                       <input type="radio" name="type" id="pict" value="P" checked="" style="margin-right: 10px;"><label style="padding-right: 10px;">Picture</label>
                       <input type="radio" name="type" id="yt" value="Y"  style="margin-right: 10px;"><label>Youtube</label>
                     </div>
                    </div>
                    <div class="form-group" id="youtube">
                     <label for="youtubenewsfeed" class="col-xs-2">Youtube Link </label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="youtubelink" id="youtubelink" placeholder="Youtube link">
                            <!--  <input type="hidden" class="form_control" id="project_no" name="project_no"> -->
                     </div>
                    </div>

                    <div class="form-group" id="picture">
                  

                        <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                    <!--    <input type="hidden" id="seqno" name="seqno"  readonly="readonly"/> -->
                   <!-- </div> -->
                   
                        <label class="col-xs-2">Upload Picture</label>
                        <div class="col-xs-8">
                            <!-- <img id="picturebox" width="118" src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="Your Image" /> -->
                            <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput" style="height: 40px;width: 80%;display: inline-grid; overflow-wrap: break-word;font-size: .8rem;">
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
                
                    <div class="form-group">
                      <label class="col-xs-2">Periode Start</label>
                        <div class="col-xs-8">
                            <div class="input-group"> 
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ft-calendar"></i></span>
                            </div>
                            <!-- <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>   -->                         
                            <input id="date_created" name="date_created" class="form-control" type="text" value="<?php 
                                $mydate=date("d/m/Y");
                                // $Tanggal = "$mydate[mday] $mydate[month] $mydate[year]";
                                echo "$mydate";//[mday] / $mydate[month] / $mydate[year]";
                                // echo $Tanggal;
                          ?>">
                            
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-xs-2">Periode End</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ft-calendar"></i></span>
                            </div>                            
                            <input id="date_created1" name="date_created1" class="form-control" type="text" value="<?php 
                                $mydate=date("d/m/Y");
                                // $Tanggal = "$mydate[mday] $mydate[month] $mydate[year]";
                                echo "$mydate";//[mday] / $mydate[month] / $mydate[year]";
                                // echo $Tanggal;
                          ?>">
                           
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


    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
  <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

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


//    $("#youtube").hide()
//     $("#picture").show()
//     $("input[type=radio][name=type]").change(function(){
//         if($(this).val()=='P'){
//             alert('pict');
//             $("#youtube").hide()
//             $("#youtubelink").val('')
//             $("#picture").show()

//         }
//         else{
//             alert('yt');
//             $("#youtube").show()
//             $("#picture").hide()
//             $("#Picture").val('')

//         }
//     })

    $("#youtube").hide()
    $("#picture").show()

            $('input[type=radio][name=type]').on('ifChanged', function (event) {
                var typevalue = $("input[type=radio][name=type]:checked").val();
                alert(typevalue)
                if(typevalue=='P'){
                        alert('pict');
                        // $("#youtube").hide()
                        // $("#youtubelink").val('')
                        // $("#picture").show()

                    }
                    else{
                        alert('yt');
                        // $("#youtube").show()
                        // $("#picture").hide()
                        // $("#Picture").val('')

                    }
                // alert(typevalue);
               
                  // alert(typevalue);
                  
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
$('#date_created1').datepicker({
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
            var news = $('#news').val();
            
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

    $.validator.addMethod("cek_date", function (value, element) {
            var isSuccess = false;
            var d1 = $('#date_created1').val();
            var d = $('#date_created').val();

            var date_created1 = new Date(d1);
            var date_created = new Date(d);


            
            // alert(content.length);
            // if(content==null||content =='' && youtubelink == null||youtubelink=='' && picture ==null || picture ==''){

            if(date_created1<date_created){

            }
            else{
                isSuccess=true;
            }

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
                    required: true
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
                },
                date_created1:{
                    cek_date:true
                },
                news:{
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
                },
                date_created1:{
                    cek_date:"Period End should not be smaller than Period Start"
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
          } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }

        });

        $('#userfile').fileupload({
            url: "<?php echo base_url('newsandpromo/save_newsfeed');?>",
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
                            block(false)
                    swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: res.Pesan,
                            confirmButtonText: "OK"
                          });
                    $('#modal').modal('hide');
                }else{
                            block(false)
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
            block(true)
                var id = $('#modal').data('id');
                var action = $('#modal').data('action');
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push({name:"action",value:action},{name:"id",value:id},{name:"isFile",value:isFile});
                var obj = new Object();
                obj.id = id;
                obj.isFile = isFile;
                console.log(datafrm);
                if(isFile){
                  // alert('sukses Picture');
                  if(jqXHRData){
                    jqXHRData.formData = datafrm;
                    jqXHRData.submit();
                    
                  }
                }else{
                   
                    $.ajax({
                    url : "<?php echo base_url('newsandpromo/save_newsfeed');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    // data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    data:datafrm,
                    dataType:"json",
                    success:function(event, data){
                        // console.log('2');

                        if(event.status=='OK'){
                            block(false)
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
                            block(false)
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
            $.getJSON("<?php echo base_url('newsandpromo/getByID');?>" + "/" + id, function (data) {
                //var tes = JSON.parse(data);
                // alert(data[0].youtube_link);
                var type = data[0].content_type;
                var news = data[0].attach_type;
                if(type=="news"){
                    $("#news").attr('checked', 'checked');
                }
                else{
                    $("#promo").attr('checked', 'checked');
                }

                if(news=="P"){
                    $("#pict").attr('checked', 'checked');
                }
                else{
                    $("#yt").attr('checked', 'checked');
                    // alert('youtube show');
                    $("#youtube").show();
                    $("#picture").hide();
                }

                console.log(data);
                // $('#project_no').val(data[0].project_no).trigger("change");
                $('#subject').val(data[0].subject);
                $('#content').val(data[0].content);
                $('#youtubelink').val(data[0].youtube_link);
                $('#Picture').val(data[0].picture);
                
                if(data[0].Picture!="")
                {
                    document.getElementById("pictname").innerHTML = data[0].picture;
                $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
                }
                else {
                    document.getElementById("pictname").innerHTML = data[0].picture;
                }
                var bb = data[0].start_date;
                var year =bb.substr(0,4);
                var month=bb.substr(5,2);
                var day =bb.substr(8,2);
                var aa = day+"/"+month+"/"+year;
                var cc = data[0].end_date;
                var year =cc.substr(0,4);
                var month=cc.substr(5,2);
                var day =cc.substr(8,2);
                var dd = day+"/"+month+"/"+year;
                $('#date_created').val(aa);
                $('#date_created1').val(dd);
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
</script>                