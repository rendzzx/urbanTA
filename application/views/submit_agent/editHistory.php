<!-- style -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">
    <style type="text/css">
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

        .container {
          padding-left: 50px;
          padding-top: 15px;
        }

        .buttonstl {
          padding-top: 5px;
        }

        label {text-align: right;}
        #loader{
            width:80%;
            height:100%;
            position:fixed;
            z-index:9999;
            background:url("../img/loading.gif") no-repeat center center     
        }
        /*div.dataTables_wrapper 
        div.dataTables_filter {
            text-align: right;
            float: right;
            padding-bottom: 5px;
            }*/
    </style>
<!-- style -->

<!-- content -->
    <!-- <div id="loader" class="loader" hidden="true"></div> -->
    <div class="container">
        <div class="col-12">
            <form id ="frmEditor" class="form form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="form-body">
                    <div class="form-group row">
                        <input type="hidden" name="txtrowID" id="txtrowID" class="form-control" hidden>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="txtEmail" id="txtEmail" class="form-control" hidden>
                    </div>
                    <div class="form-group row">
                        <label for="project_name" class="col-md-3 label-control">Full Name</label>
                        <div class="col-md-6">
                            <input type="text" name="TxtfullName" id="TxtfullName" class="form-control" tabindex="2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phase_descs" class="col-md-3 label-control">NIK </label>
                        <div class="col-md-6">
                            <input type="text" name="TxtnomorIdk" id="TxtnomorIdk" class="form-control" tabindex="2">
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="phase_descs" class="col-md-3 label-control">Handphone </label>
                        <div class="col-md-6">
                            <input type="text" name="TxthandPhone" id="TxthandPhone" class="form-control" tabindex="2">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phase_descs" class="col-md-3 label-control"></label>
                        <div class="col-sm-6">
                            <div class="i-checks">
                                <label  id="radioR"> <input type="checkbox" id="btntoggles" name="btntoggles"> <i></i> Do you want to deactivate this Agent? </label> 
                                <input type="hidden" name="hidden_btn" id="hidden_btn" value="A" />
                           </div>
                      </div>
                    </div> 

                    </div>
                </div>      
            </form>
    </div>
    </div>
<!-- content -->

<!-- link -->
    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<!-- limk -->

<!-- script -->
    <script type="text/javascript">
        $(document).ready(function(){
            loaddata();

            $('.i-checks').iCheck({
                radioClass: 'iradio_square-purple',
                checkboxClass: 'icheckbox_flat-purple'
            });
        })

        function loaddata(){
            var rowID = $('#modal').data('rowID');
            // alert(rowID);
            var valueChecked = 0 ;
            if (rowID > 0) {
                $.getJSON("<?php echo base_url('c_submit_agent/getHisByID');?>" + "/" + rowID, function (data) {
                    
                  $('#txtrowID').val(data[0].rowID);
                  $('#txtEmail').val(data[0].email_add);
                  $('#TxtfullName').val(data[0].full_name);
                  $('#TxtnomorIdk').val(data[0].nik);
                  $('#TxthandPhone').val(data[0].handphone1);

                  if (data[0].Status == 'D') 
                  {
                    $('#btntoggles').attr('checked', true);
                  }else{
                    $('#btntoggles').attr('checked', false);
                  }
                  
                });
            }
        }

        $('#savefrm').click(function(){
            document.getElementById('loader').hidden=false;
            var datafrm = $('#frmEditor').serializeArray();
            
            $.ajax({
                url : "<?php echo base_url('c_submit_agent/updateHis');?>",
                type:"POST",
                  // async: false,
                data: $('#frmEditor').serialize(),
                dataType:"json",
                success:function(event, data){
                    document.getElementById('loader').hidden=true;
                    // console.log(event);
                    if(data=='success'){
                        swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        });
                        // BootstrapDialog.alert(event.Pesan);
                        $('#modal').modal('hide');
                        tblsubagent.ajax.reload(null,true);
                    }
                    else{
                        swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                        });
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
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    document.getElementById('loader').hidden=true;
                    // alert('data error');
                    // BootstrapDialog.alert();
                    swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: textStatus+' Save : '+errorThrown,
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    </script>
<!-- script -->