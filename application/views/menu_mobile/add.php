<!-- link-->
    <link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?=base_url('css/plugins/daterangepicker/daterangepicker-bs3.css')?>">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" >
<!-- link -->

<!-- style -->
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
    </style>
<!-- style -->

<!-- content -->
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <input type="hidden" name="txtMenuID" id="txtMenuID" class="form-control">
            </div>

            <div class="form-group">
                <label for="Title" class="col-xs-8">Title</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtTitle" id="txtTitle" placeholder="Title">
                </div>
            </div>

            <div class="form-group">
                <label for="URL" class="col-xs-8 control-label">URL</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtURL" id="txtURL" placeholder="URL">
                </div>
            </div>

            <div class="form-group">
                <label for="descs" class="col-xs-8">Description</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtDescs" id="txtDescs" placeholder="Description">
                </div>
            </div>

            <div class="form-group">
                <label for="OrderSeq" class="col-xs-8">Order Sequence</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtOrderSeq" id="txtOrderSeq" placeholder="Order Sequence">
                </div>
            </div>

            <div class="form-group">
                <label for="IconClass" class="col-xs-8">Icon Class</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="txtIconClass" id="txtIconClass" placeholder="Icon Class">
                </div>
            </div>
        </div>
    </form>
<!-- CONTENT -->


<!-- link -->
    <!-- Select2 -->
    <!-- <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script> -->
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
    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<!-- link -->

<!-- script -->
    <script type="text/javascript">

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


        var menuid = $('#modal').data('MenuID');
        jQuery.validator.setDefaults({
            debug: true,
            success: "valid"
        });
        $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });


        $("#frmEditor").validate({
            rules: {
                txtTitle: {
                    required: true
                },
                txtIconClass:{
                    required:true
                },
                txtOrderSeq:{
                    required:true,
                    number:true
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
                } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
                    error.insertAfter(element.next('span'));
                } else {
                    error.insertAfter(element);
                }
            }
        });

        $(document).ready(function () {
            loaddata();

            $('#savefrm').click(function(){
                var ParentID = $('#txtParentID').val();
                var title = $('#txtTitle').val();
                if($('#frmEditor').valid()){
                    var MenuID = $('#modal').data('MenuID');        
                    var datafrm = $('#frmEditor').serializeArray();
                    datafrm.push({name:"MenuID",value:MenuID});
                    var obj = new Object();
                    obj.id = MenuID;
                    $.ajax({
                        url : "<?php echo base_url('c_menu_mobile/save_menu');?>",
                        type:"POST",
                        data: $('#frmEditor').serialize() + '&' + $.param(obj),
                        dataType:"json",
                        success:function(event, data){
                            if(event.St=="OK"){
                                swal("Information",event.Pesan,"success");
                                $('#modal').modal('hide');
                            }else{
                                swal("Information",event.Pesan,"warning");
                            }
                            // alert(event.Pesan);
                            document.getElementById('loader').hidden=false;
                            var state = document.readyState
                            if (state == 'complete') {
                                setTimeout(function(){
                                    document.getElementById('interactive');
                                    tblnewsfeed.ajax.reload(null,true); 
                                    document.getElementById('loader').hidden=true;
                                },1000);
                            }
                        },                    
                        error: function(jqXHR, textStatus, errorThrown){
                            swal("Information",textStatus+' Save : '+errorThrown,"warning");
                            // alert(textStatus+' Save : '+errorThrown);
                        }
                    });                
                }
            });
        });

        // function setparentid(MenuID){        

        //     var site_url = '<?php echo base_url("c_menu/zoom_parentid_from")?>';
        //     $.post(site_url,
        //         {MenuID:MenuID},
        //         function(data,status) {
        //             $("#txtParentID").empty();
        //             $("#txtParentID").append('<option value="0">Parent Menu</option> '); 
        //             $("#txtParentID").append(data);                
        //             $("#txtParentID").trigger('change');
        //         }
        //     );
        // }

        function loaddata(){
            var MenuID = $('#modal').data('menuID');
            console.log(MenuID)
            if (MenuID > 0) {
                $.getJSON("<?php echo base_url('c_menu_mobile/getByID');?>" + "/" + MenuID, function (data) {
                    $('#txtMenuID').val(data[0].MenuID);
                    $('#txtTitle').val(data[0].Title);
                    $('#txtURL').val(data[0].URL);
                    // setparentid(data[0].ParentMenuID);
                    $('#txtDescs').val(data[0].title_descs);
                    $('#txtOrderSeq').val(data[0].OrderSeq);
                    $('#txtIconClass').val(data[0].IconClass);
                });
            }
        }
    </script>
<!-- script -->