      
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<!-- daterange picker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/daterangepicker/daterangepicker-bs3.css')?>">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" >

<!-- Bootstrap time Picker -->
<style type="text/css">
.has-error .select2 {
  border: 1px solid #a94442;
  border-radius: 4px;
}

.has-error .checkbox-inline {
  border: 1px solid #a94442;
  border-radius: 4px;
}

.has-error .radio-inline {
  border: 1px solid #a94442;
  border-radius: 4px;
}
    /*label {text-align: right;}
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
      }*/
    </style>

    <div class="app-content content">
      <div class="content-wrapper">
        
        <div class="content-wrapper-before" style="height: 150px !Important"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2">
            <br><br>
            
          </div>
        </div>

        <div class="content-body">
          <!-- <section id="tblnewsfeed"> -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Projects</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                      <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                      
                      
                      <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" name="idproject" id="idproject" value="<?php echo $id ?>">
                        <div class="box-body">
                          <div class="form-group">
                            <label for="entity_name" class="col-sm-2 control-label">Entity Code</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control pull-right" id="entity_cd" name="entity_cd">  
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="entity_name" class="col-sm-2 control-label">Project No</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control pull-right" id="project_no" name="project_no">  
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="entity_name" class="col-sm-2 control-label">Project Description</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control pull-right" id="descs" name="descs">  
                            </div>
                          </div>
                          <div class="form-group">

                            <label class="col-sm-2 control-label">Picture Project </label>                
                            <div class="col-sm-7">
                              <div id="logo" class="image" >
                                <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox1">
                              </div>
                              <br>
                              <span class="btn btn-success fileinput-button">
                                <span>Select Picture...</span>
                                <input type="file" id="userfile1" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(1,this)"/>
                              </span>
                              <p>(* Only Jpg, Png allowed)</p>
                              <input type="hidden" id="picturepath1" name="picturepath1" value="<?php echo ''?>" readonly="1">
                              <input type="hidden" id="picturename1" name="picturename[]" readonly="1">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Picture Property </label>                
                            <div class="col-sm-7">
                              <div id="logo" class="image" >
                                <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox2">
                              </div>
                              <br>
                              <span class="btn btn-success fileinput-button">
                                <span>Select Picture...</span>
                                <input type="file" id="userfile2" name="userfile2" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(2,this)"/>
                              </span>
                              <p>(* Only Jpg, Png allowed)</p>
                              <input type="hidden" id="picturepath2" name="picturepath2" value="<?php echo ''?>" readonly="1">
                              <input type="hidden" id="picturename2" name="picturename[]" readonly="1">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Database Profile</label>
                            <div class="col-sm-6">
                              <select name="db_profile" id="db_profile" data-placeholder="Choose a Profile..." class="form-control select2" tabindex="2">
                                <option value=""></option>
                                <option value="IFCAPB">1</option>
                                <option value="IFCAPB2">2</option>
                                <option value="IFCAPB3">3</option>
                                <option value="IFCAPB4">4</option>
                                <option value="IFCAPB5">5</option>
                                <option value="IFCAPB6">6</option>
                                <option value="IFCAPB7">7</option>
                                <option value="IFCAPB8">8</option>
                                <option value="IFCAPB9">9</option>
                                <option value="IFCAPB10">10</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Email Profile Name</label>
                            <div class="col-sm-6">
                              <select name="sysmail" id="sysmail" data-placeholder="Choose a Email Profile Name..." class="form-control select2" tabindex="2">
                                <option value=""></option>
                                <?php foreach ($sysmail as $key) { ?>
                                  <option value="<?php echo $key->name ?>"><?php echo $key->name ?></option>
                                <?php  } ?>
                              </select>
                            </div>
                          </div>
                             <!-- <div class="form-group">
                                <label for="map" class="col-sm-2">Coordinat Address</label>
                                <div class="col-sm-6">
                                     <input type="text" class="form-control pull-right" id="map" name="map">  
                                </div>
                              </div> -->
                              <div class="form-group">
                                <label for="hp" class="col-sm-2 control-label">Handphone</label>
                                <div class="col-sm-6">
                                 <input type="number" class="form-control pull-right" id="hp" name="hp">  
                               </div>
                             </div>
                             <div class="form-group">
                              <label for="phase_descs" class="col-sm-2 control-label">Database Name</label>
                              <div class="col-sm-6">
                                
                               <input type="text" class="form-control pull-right" id="db_name" name="db_name">  

                             </div>
                           </div> 
                           <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-4">
                              <label class="radio-inline" style="padding-right: 10px"><input type="radio" name="status" id="1" value="1" checked style="margin-right: 10px">Active </label>
                              <label class="radio-inline" ><input type="radio" name="status" id="0" value="0" style="margin-right: 10px">Inactive </label>    
                            </div>                                
                          </div>
                          <div class="form-group">
                            <label for="entity_name" class="col-sm-2 control-label">Product Code</label>
                            <div class="col-sm-6">
                              <select name="product_cd" id="product_cd" data-placeholder="Choose Product..." class="form-control select2" tabindex="2">
                                <option value=""></option>
                                <option value="S+">Sales Property (S+)</option>
                                <option value="O+">Office Tower(O+)</option>
                                <option value="M+">Mall (M+)</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="entity_name" class="col-sm-2 control-label">Priority No</label>
                            <div class="col-sm-6">
                              <input type="text" class="form-control pull-right" id="seq_no" name="seq_no">  
                            </div>
                          </div>

                        </div>                  
                        
                        <div class="modal-footer">
                          <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                          <button type="button" id="btnback" class="btn btn-primary">Back</button>
                        </div>
                      </form>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- </section> -->
          </div>

        <!-- <div class="content-body">

        </div> -->
        
      </div>
    </div>


    <!-- Select2 -->
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>

    <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 

    <script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="<?=base_url('js/plugins/fullcalendar/moment.min.js')?>"></script>
    <script src="<?=base_url('js/plugins/daterangepicker/daterangepicker.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>

    <script type="text/javascript">

      $("#btnback").click(function(){
      // alert('a');
      location.href = "<?php echo base_url("c_projects"); ?>";
    })
// var rowID = $('#modal').data('rowID');

loaddata();
    // $.validator.addMethod("cek_data", function (value, element) {
    //     var isSuccess = false;
    
    //     var picture = $('#Picture').val();
    
    //     if(picture.length ==0 ){
     
    //     }else{
    //         isSuccess=true;

    //     }
    //     // alert(isSuccess);
    //     return isSuccess;

    // });
    $.validator.addMethod("cek_telp", function (value, element) {
      var isSuccess = false;
      var Stext = $('#hp').val()
      var Sawal = value.charAt(0);
      console.log(Stext);

      if(Sawal == 0){

      }else{
        isSuccess = true;
      }              
      
      return isSuccess;

    });
    $(document).ready(function () {
    // var isFile = false;
    $("#db_profile").select2({
      width:"100%"
    }); 
    $("#sysmail").select2({
      width:"100%"
    });
    // $("#userfile").on('change', function () {

    //         $("#Picture").val(this.files[0].name);
    
    //     });
    // $("#userfilepro").on('change', function () {

    //         $("#pictpro").val(this.files[0].name);
    
    //   });

    $("#frmEditor").validate({
      ignore:"",
      rules: {
        entity_cd: {
          required: true,
          maxlength:4
        },
        project_no: {
          required: true
        },
        descs: {
          required: true
        },
                // userfile:{
                //     cek_data:true
                // },
                hp:{
                  // required: true,
                  number:true,
                  maxlength:13,
                  cek_telp: true
                },
                http_add:{
                  required:true
                },
                db_profile:{
                  required:true
                },
                db_name:{
                  required:true
                },
                status:{
                  required:true
                },
                seq_no:{
                  required:true
                }
              },
              messages: {
                
                // userfile: {
                //     cek_data: "Please choose a picture."
                // }
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
     // $('#userfile').fileupload({
     //        url: "<?php echo base_url('c_projects/save');?>",
     //        dataType: 'json',
     //        add: function (e, data) {
     //            jqXHRData = data
     //            isFile = true;               
     //        },
     //        done: function (event, response) {

     //            var res = response.result;
     
     //            if(res.status =='OK'){
     //                swal({
     //                        title: "Information",
     //                        animation: false,
     //                        type:"success",
     //                        text: res.Pesan,
     //                        confirmButtonText: "OK"
     //                      });
     //                $('#modal').modal('hide');
     //            }else{
     //                 swal({
     //                        title: "Warning",
     //                        animation: false,
     //                        type:"error",
     //                        text: res.Pesan,
     //                        confirmButtonText: "OK"
     //                      });
     //            }
     
     //            tblnewsfeed.ajax.reload(null,true); 

     //        },
     //        fail: function (event, response) {
     //            var error = response["_response"]["errorThrown"];
     //            swal({
     //                title: "Warning",
     //                animation: false,
     //                type:"error",
     //                text: error,
     //                confirmButtonText: "OK"
     //                      });
     //        }
     //    });
     // // $('#userfilepro').fileupload({
     // //        url: "<?php echo base_url('c_projects/save');?>",
     // //        dataType: 'json',
     // //        add: function (e, data) {
     // //            jqXHRData = data
     // //            isFile = true;                
     // //        },
     // //        done: function (event, response) {

     // //            var res = response.result;
     
     // //            if(res.status =='OK'){
     // //                swal({
     // //                        title: "Information",
     // //                        animation: false,
     // //                        type:"success",
     // //                        text: res.Pesan,
     // //                        confirmButtonText: "OK"
     // //                      });
     // //                $('#modal').modal('hide');
     // //            }else{
     // //                 swal({
     // //                        title: "Warning",
     // //                        animation: false,
     // //                        type:"error",
     // //                        text: res.Pesan,
     // //                        confirmButtonText: "OK"
     // //                      });
     // //            }
     
     // //            tblnewsfeed.ajax.reload(null,true); 

     // //        },
     // //        fail: function (event, response) {
     // //            var error = response["_response"]["errorThrown"];
     // //            swal({
     // //                title: "Warning",
     // //                animation: false,
     // //                type:"error",
     // //                text: error,
     // //                confirmButtonText: "OK"
     // //                      });
     // //        }
     // //    });
     $('#btnSave').click(function(){
            // document.getElementById('loader').hidden=false;
            block(true)
            
            if($('#frmEditor').valid()){
              var id = <?php echo $id ?>;
              var datafrm = $('#frmEditor').serializeArray();
              datafrm.push({name:"id",value:id});
                // var obj = new Object();
                // obj.id = id;
                // obj.isFile = isFile;
                // console.log(isFile);
                // console.log(datafrm);return;
                // if(isFile){
                  // if(jqXHRData){
                  //   jqXHRData.formData = datafrm;
                  //   jqXHRData.submit();
                  // }
                // }else{
                   // console.log(datafrm);
                   $.ajax({
                    url : "<?php echo base_url('c_projects/save');?>",
                    type:"POST",
                    data: datafrm,
                    dataType:"json",
                    success:function(event, data){

                      if(event.status=='OK'){
                        block(false)
                        swal({
                          title: "Information",
                          animation: true,
                          type:"success",
                          text: event.Pesan,
                          confirmButtonText: "OK"
                        });
                          // document.getElementById('loader').hidden=true;
                          // $('#modal').modal('hide');
                          // tblnewsfeed.ajax.reload(null,true);
                        } else {
                          block(false)
                          swal({
                            title: "Error",
                            animation: true,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          // document.getElementById('loader').hidden=true;
                        }
                        
                      },                    
                      error: function(jqXHR, textStatus, errorThrown){
                        block(false)
                        swal({
                          title: "Error",
                          animation: false,
                          type:"error",
                          text: textStatus+' Save : '+errorThrown,
                          confirmButtonText: "OK"
                        });
                          // document.getElementById('loader').hidden=true;
                        }
                      });
                // }       
              }
            });

   });

      function setdbprofile(ent){        

        $("#db_profile").val(ent).trigger('change');

      }

      function saveImage(seq, el) {
        // document.getElementById('loader').hidden=false;
        var a = el.files[0].size;
        var max = (1024 * 1024) * 7;
        
        if (a > max){
          
          
          if (max.toString().length > 6) {
            max = max / 1024 / 1024;
            max = max.toFixed(2);
            max = max + ' mb';
          } else {
            max = max / 1024;
            max = max.toFixed(2);
            max = max + ' kb';
          }
          swal('Please upload less than ' + max);
          return false;
        }
        block(true)

        $.ajax({
          url : "<?php echo base_url('c_projects/savePic2');?>",
          type:"POST",
          data: function () {
            var data = new FormData();
            data.append("complain_no", $("#complain_no").val());
            data.append("seqno", seq);
            data.append("userfile", $("#userfile"+seq).get(0).files[0]);
            return data;
          }(),
          processData: false,
          contentType: false,
          dataType:"json",
          success:function(data, status){
            console.log(data);
            if(data.status == "OK"){
                    // document.getElementById('loader').hidden=true;
                    swal({
                      title: "Information",
                      text: data.pesan,
                      type: "success",
                      confirmButtonText: "OK"
                    });
                    $('#picturebox'+seq).attr('src', data.url);
                    $('#picturepath'+seq).val(data.url)
                    $('#picturename'+seq).val(data.picname)
                  } else {
                    // document.getElementById('loader').hidden=true;
                    swal({
                      title: "Error",
                      text: data.pesan,
                      type: "error",
                      confirmButtonText: "OK"
                    });
                      // document.getElementById('loader').hidden=true; 
                    }
                  },                    
                  error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                  }
                });
      }

      function loaddata(){
        var rowID = <?php echo $id ?>;
        // console.log(rowID);
        var pict_path,pict_url;
        if (rowID > 0) {
          $.getJSON("<?php echo base_url('c_projects/getByID');?>" + "/" + rowID, function (data) {
              // console.log(data);
              $('#entity_cd').val(data[0].entity_cd);
              $('#project_no').val(data[0].project_no);
              $('#descs').val(data[0].descs);
              // $('#Picture').val(data[0].picture_path);
              // $('#pict_pro').val(data[0].picture_url);
              $('#map').val(data[0].coordinat_project);
              $('#hp').val(data[0].handphone);
              $('#sysmail').val(data[0].profile_name).trigger('change');
              $('#picturepath1').val(data[0].picture_path)
              $('#picturepath2').val(data[0].picture_url)

              if(data[0].picture_path=='null'||data[0].picture_path==''||data[0].picture_path==null){
                pic_path = "<?php echo base_url('img/PlProject/no_image.png')?>";
              }else{
                pic_path = data[0].picture_path;
              }
              $('#picturebox1').attr('src', pic_path);
              if(data[0].picture_url=='null'||data[0].picture_url==''||data[0].picture_url==null){
                pict_url = "<?php echo base_url('img/PlProject/no_image.png')?>";
              }else{
                pict_url = data[0].picture_url;
              }
              $('#picturebox2').attr('src', pict_url);

              $('#seq_no').val(data[0].seq_no);



              
              // if(data[0].picture_path!="")
              // {
              //     document.getElementById("pictname").innerHTML = data[0].picture_path;
              // // $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
              // }
              // else {
              //     document.getElementById("pictname").innerHTML = data[0].picture_path;
              // }

              // if(data[0].picture_url!="")
              // {
              //     document.getElementById("pictpro").innerHTML = data[0].picture_url;
              // // $("#inputfile").removeClass("fileinput-new").addClass("fileinput-exists");
              // }
              // else {
              //     document.getElementById("pictpro").innerHTML = data[0].picture_url;
              // }

              $('#http_add').val(data[0].caption_address);
              $('#db_name').val(data[0].db_name);
              setdbprofile(data[0].db_profile);
              
              var status = data[0].status;
              document.getElementById(status).checked = true;
            });
        }
      }
      
      $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
      });

      function block(boelan){
        var block_ele = $('#form_nup')
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