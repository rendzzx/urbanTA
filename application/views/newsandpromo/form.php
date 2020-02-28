<link href="<?=base_url('app-assets/vendors/css/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet">
<link href="<?=base_url('app-assets/vendors/css/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">

 
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
            <h3 class="content-header-title">
                <?php echo $project; ?><br/>
            </h3>
           
          </div>
        </div>
        <div class="content-body"> 
          <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="card-content">
                        <b>&nbsp; <?php echo $jdl?></b>
                            <br/><hr/><br/>
                      <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                 <div class="col-12 box-body">
                  <div class="col-12">
                    <div class="form-group row">
                     
                     <div class="col-4">
                        <label> Content Type</label>
                        <div class="i-checks">
                          <label  id="radioT"> <input type="radio" name="news" id="news" value="news" checked=""  style="margin-right: 10px;">  News</label> &emsp;
                          <label id="radioV"> <input type="radio" name="news" id="promo" value="promo"  style="margin-right: 10px;">  Promo </label>
                            &emsp;
                        </div>
                <!--         <div class="input-group">
                           <input type="radio" name="news" id="news" value="news" checked=""  style="margin-right: 10px;"><label style="padding-right: 10px;">News</label>
                           <input type="radio" name="news" id="promo" value="promo"  style="margin-right: 10px;"><label>Promo</label>
                        </div> -->
                     </div>
                     <div class="col-4">
                      <label>Home Flag</label>
                        <div class="i-checks">
                            <label id="radioY"> <input type="radio" name="homeflag" id="yes" value="Y" checked=""  style="margin-right: 10px;">  Yes</label> &emsp;
                            <label id="radioN"> <input type="radio" name="homeflag" id="no" value="N"  style="margin-right: 10px;">  No </label>
                            &emsp;
                        </div>
                     </div>
                     
                     <div class="col-3">
                      <label>Product Code</label>
                       <input type="text" disabled="true" class="form-control" name="product_cd" id="product_cd" placeholder="Product">
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
                  
                        <textarea class="form-control" name="content" id="content" placeholder="Place content newsfeed here" name="content" id="content" cols="30" rows="15" class="ckeditor"></textarea>
                  
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2">Content Type</label>
                     <div class="i-checks">
                          <label  id="radioT"> <input type="radio"name="type" id="pict" value="P" checked="" style="margin-right: 10px;">  Picture</label> &emsp;
                          <label id="radioV"> <input type="radio" name="type" id="yt" value="Y"  style="margin-right: 10px;">  Youtube </label>
                            &emsp;
                        </div>
               <!--       <div class="col-xs-8">
                       <input type="radio" name="type" id="pict" value="P" checked="" style="margin-right: 10px;"><label style="padding-right: 10px;">Picture</label>
                       <input type="radio" name="type" id="yt" value="Y"  style="margin-right: 10px;"><label>Youtube</label>
                     </div> -->
                    </div>
                    <div class="form-group" id="youtube">
                     <label for="youtubenewsfeed" class="col-xs-2">Youtube Link </label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="youtubelink" id="youtubelink" placeholder="Youtube link">

                     </div>
                    </div>
                    <div class="form-group" id="picture">
                
                      <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />

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
                
                    <div class="form-group row">
                      <div class="col-6">
                        <label >Periode Start</label>
                          <div class="input-group"> 
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ft-calendar"></i></span>
                            </div>
                                             
                            <input id="date_created" name="date_created" class="form-control" type="text" value="<?php $mydate=date("d/m/Y");echo "$mydate";?>">
                        </div>
                      </div>
                      <div class="col-6">
                        <label >Periode End</label>
                            <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ft-calendar"></i></span>
                            </div>                            
                            <input id="date_created1" name="date_created1" class="form-control" type="text" value="<?php $mydate=date("d/m/Y");echo "$mydate";?>">
                           
                        </div>
                      </div>
                    </div>
                  </div>
                 </div><!-- /.box-body -->
                 <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" id="btnBack">Back</button>
                </div>
                </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
 <script src="<?=base_url('app-assets/vendors/js/editors/ckeditor/ckeditor.js')?>" type="text/javascript"></script>
<script type="text/javascript">
  $('.i-checks').iCheck({
                    radioClass: 'iradio_square-purple',
                });
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
    var editor = CKEDITOR.instances['ckeditor'];
    if (editor) { editor.destroy(true); }
    CKEDITOR.replace('content', {
      height: '350px',
      extraPlugins: 'forms'
    });
$('#btnBack').click(function(){
      window.location.href="<?php echo base_url('newsandpromo/index')?>";
    });

    // $("#youtube").hide()
    // $("#picture").show()
    // $("input[type=radio][name=type]").change(function(){
    //     if($(this).val()=='P'){
    //         $("#youtube").hide()
    //         $("#youtubelink").val('')
    //         $("#picture").show()

    //     }
    //     else{
    //         $("#youtube").show()
    //         $("#picture").hide()
    //         $("#Picture").val('')

    //     }
    // })

    $("#youtube").hide()
    $("#picture").show()

            var typevalue='';
            $('input[type=radio][name=type]').on('ifChanged', function (event) {
                var typevalue = $("input[type=radio][name=type]:checked").val();
                // alert(typevalue)
                if(typevalue!=null){
                    if(typevalue=='P' || typevalue=='Y'){
                        if(typevalue=='P'){
                            // alert('pict');
                            $("#youtube").hide()
                            $("#youtubelink").val('')
                            $("#picture").show()

                        }
                        else{
                            // alert('yt');
                            $("#youtube").show()
                            $("#picture").hide()
                            $("#Picture").val('')

                        }
                     
                    }
                    
                  }
                // if(typevalue=='P'){
                //         // alert('pict');
                //         $("#youtube").hide()
                //         $("#youtubelink").val('')
                //         $("#picture").show()

                //     }
                //     else{
                //         // alert('yt');
                //         $("#youtube").show()
                //         $("#picture").hide()
                //         $("#Picture").val('')

                //     }
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
      // console.log(CKEDITOR.instances.content);return;
      if($('#frmEditor').valid()){
            // block(true)
                var id = '<?php echo $id?>';
                var action ='<?php echo $form?>';
                var product_cd =$('#product_cd').val()
                product_cd= product_cd.substr(0, 1);;
                var datafrm = $('#frmEditor').serializeArray();
                var content = CKEDITOR.instances.content.getData();
                datafrm.push({name:"action",value:action},{name:"id",value:id},{name:"isFile",value:isFile},{name:"content_html",value:content},{name:"product_cd",value:product_cd});
                var obj = new Object();
                obj.id = id;
                obj.isFile = isFile;
                console.log(datafrm);
                // return;
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
                          // $('#modal').modal('hide');
                          window.location.href="<?php echo base_url('newsandpromo/index')?>";
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
    var id = '<?php echo $id ?>';
    // $('#product_cd').val('<?php echo $this->session->userdata('Tsproductcd')."+"; ?>');
    $('#product_cd').val('<?php echo $this->session->userdata('appsname'); ?>');
    
        ScreenID = id;
        
        if (id > 0) {
            $.getJSON("<?php echo base_url('newsandpromo/getByID');?>" + "/" + id, function (data) {
                //var tes = JSON.parse(data);
                // alert(data[0].youtube_link);
                   // alert(data[0].product_cd);
                var type = data[0].content_type;
                var news = data[0].attach_type;
                var homeflag = data[0].home_flag;
                if(type=="news"){
                    // $("#news").attr('checked', 'checked');
                    $("#news").iCheck('check');
                }
                else{
                    $("#promo").iCheck('check');
                }

                if(news=="P"){
                    $("#pict").iCheck('check');
                }
                else{
                    $("#yt").iCheck('check');
                    $("#youtube").show();
                    $("#picture").hide();
                }

                if(homeflag=="Y"){
                    // $("#news").attr('checked', 'checked');
                    $("#yes").iCheck('check');
                }
                else{
                    $("#no").iCheck('check');
                }

                console.log(data);
                // $('#project_no').val(data[0].project_no).trigger("change");
                $('#subject').val(data[0].subject);
                $('#content').val(data[0].content);
                CKEDITOR.instances['content'].on('instanceReady',function(){
                  CKEDITOR.instances['content'].setData(data[0].content);
                })
                 $('#product_cd').val(data[0].product_cd+'+');
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