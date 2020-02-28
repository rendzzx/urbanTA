<!-- link -->
    <link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<!-- link -->

<!-- content -->
   <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-sm">
                <span class="btn btn-md btn-bg-gradient-x-purple-blue fileinput-button">
                    <span>Select File...</span>
                    <input type="file" id="file_url" name="file_url" accept="pdf" onChange="saveFile()"/>
                    <p>(* Only PDF allowed)</p>
                </span>
                <input type="hidden" id="file_attachment" name="file_attachment" readonly="1">
            </div>
        </div>
    </form>
<!-- end content     -->

<!-- script -->
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<!-- script -->

    <script type="text/javascript">
        loaddata();

        $(document).ready(function () {
            $("#frmEditor").validate({
                ignore:"",
                rules: {
                    file_url: {
                        required: true
                    },
                    file_attachment: {
                        required: true
                    }
                },
                messages: {
                    // userfile: {
                    //     cek_data: "Please choose a picture."
                    // }
                },
                errorElement: "span",
                highlight: function (element, errorClass, validClass) {
                  $(element).addClass(errorClass);
                  $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element, errorClass, validClass) {
                  $(element).removeClass(errorClass); //.addClass(validClass);
                  $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } 
                    else if (element.hasClass('select2')){
                        error.insertAfter(element.next('span'));
                    } 
                    else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#btnSave').click(function(){
                block(true);
                    
                if( $('#frmEditor').valid() ){
                    var id = $('#modal').data('rowID');
                    var datafrm = $('#frmEditor').serializeArray();
                    datafrm.push(
                        {name:"rowID",value:id}
                    );
                    $.ajax({
                        url : "<?php echo base_url('c_termcondition/save');?>",
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
                                }).then(function(){
                                    tblterm.ajax.reload(null, true);
                                });
                            }
                            else {
                                block(false)
                                swal({
                                    title: "Error",
                                    animation: true,
                                    type:"error",
                                    text: event.Pesan,
                                    confirmButtonText: "OK"
                                });
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
                        }
                    });      
                } else{
                    block(false)
                }
            });
        });

        function saveImage(seq, el) {
            var a = el.files[0].size;
            var max = (1024 * 1024) * 7;
            
            if (a > max){
                if (max.toString().length > 6) {
                    max = max / 1024 / 1024;
                    max = max.toFixed(2);
                    max = max + ' mb';
                } 
                else {
                    max = max / 1024;
                    max = max.toFixed(2);
                    max = max + ' kb';
                }
                swal('Please upload less than ' + max);
                return false;
            }

            block(true)
            $.ajax({
                url : "<?php echo base_url('c_termcondition/savePic2');?>",
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
                success: function(data, status){
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
                    }
                    else {
                        // document.getElementById('loader').hidden=true;
                        swal({
                            title: "Error",
                            text: data.pesan,
                            type: "error",
                            confirmButtonText: "OK"
                        });
                          // document.getElementById('loader').hidden=true; 
                    }
                        block(false)
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                    block(false)
                }
            });
        }

        function loaddata(){
            var rowID = $('#modal').data();
            console.log(rowID);

            if (rowID > 0) {
                $.getJSON("<?php echo base_url('c_termcondition/getByID');?>" + "/" + rowID, function (data) {
                      $('#file_url').val(data[0].file_url);
                      $('#file_attachment').val(data[0].file_attachment);
                });
            }
        }

        function saveFile() {
            swal('lalala','aaaa');
        }
          
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