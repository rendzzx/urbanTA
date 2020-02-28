<!-- style -->
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
        <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            <div class="box-body">
                <div class="container-fluid">

                    <input type="text" id="txtGrouptype" name="txtGrouptype" value="<?php echo $agent[0]->group_type ?>" hidden>
                    <input type="text" id="txtEmail" name="txtEmail" value="<?php echo $agent[0]->email_add ?>" hidden>
                    <input type="text" id="txtFullname" name="txtFullname" value="<?php echo $agent[0]->full_name ?>" hidden>
                    <input type="text" id="txtRegistdate" name="txtRegistdate" value="<?php echo $agent[0]->registration_date ?>" hidden>

                    <input type="text" id="txtNik" name="txtNik" value="<?php echo $agent[0]->nik ?>" hidden>
                    <input type="text" id="txtNpwp" name="txtNpwp" value="<?php echo $agent[0]->npwp ?>" hidden>
                    <input type="text" id="txtTrasnfer_bank" name="txtTrasnfer_bank" value="<?php echo $agent[0]->transfer_bank_name ?>" hidden>
                    <input type="text" id="txtTransfer_name" name="txtTransfer_name" value="<?php echo $agent[0]->transfer_name ?>" hidden>
                    <input type="text" id="txtTransfer_acc" name="txtTransfer_acc" value="<?php echo $agent[0]->transfer_acct_no ?>" hidden>

                    <input type="text" id="txtFileurl" name="txtFileurl" value="<?php echo $agent[0]->file_url ?>" hidden>
                    <input type="text" id="txtNpwpurl" name="txtNpwpurl" value="<?php echo $agent[0]->npwp_file_url ?>" hidden>
                    <input type="text" id="txtMemberurl" name="txtMemberurl" value="<?php echo $agent[0]->member_file_url ?>" hidden>
                    <input type="text" id="txtSavingurl" name="txtSavingurl" value="<?php echo $agent[0]->saving_file_url ?>" hidden>

                    <input type="text" id="txtFileattachment" name="txtFileattachment" value="<?php echo $agent[0]->file_attachment ?>" hidden>
                    <input type="text" id="txtNpwpattachment" name="txtNpwpattachment" value="<?php echo $agent[0]->npwp_file_attachment ?>" hidden>
                    <input type="text" id="txtMemberattachment" name="txtMemberattachment" value="<?php echo $agent[0]->member_file_attachment ?>" hidden>
                    <input type="text" id="txtSavingattachment" name="txtSavingattachment" value="<?php echo $agent[0]->saving_file_attachment ?>" hidden>
                    

                    <input type="text" id="txtHandphone" name="txtHandphone" value="<?php echo $agent[0]->handphone1 ?>" hidden>
                    <input type="text" id="txtStatus" name="txtStatus" value="<?php echo $agent[0]->status ?>" hidden>

                    <table class="table table-bordered fieldGroup">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th> Project </th>
                                <th> Group Agent </th>
                            </tr>
                        </thead>

                        <tr id="id1">
                            <td style="width: 10px;">
                                <a href="javascript:;" class="btn btn-primary addMore"><span class="ft-plus"></span></a>
                            </td>
                            <td style="width: 200px;">
                                <select name="cmbProject1" id="cmbProject1" placeholder="Choose a Project..." class="form-control select2" tabindex="2" onchange="zoomAgent(1)">
                                    <?php echo $project ?>     
                                </select>
                                <input type="text" id="txtProjectno1" name="txtProjectno1" hidden>
                                <input type="text" id="txtEntitycd1" name="txtEntitycd1" hidden>
                                <input type="text" id="batas" name="batas" value="2" hidden>
                            </td>
                            <td style="width: 200px;">
                                <select id="cmbAgent1" name="cmbAgent1" class="form-control select2" >
                                </select>
                                <input type="text" id="txtdbprofile1" name="txtdbprofile1" hidden>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
    <!-- </div> -->
<!-- content -->

<!-- link -->
    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<!-- limk -->

<!-- script -->
    <script type="text/javascript">
        $(document).ready(function(){
            var maxGroup = 5;
            var fGroup = $(".fieldGroup");
            // var fCopy = $(".fieldCopy");
            var addBtn = $(".addMore");

            var x = 1;
            // $("#batas").val(x);

            $(".select2").select2({
                width:'200'
            });

            $(addBtn).click(function(e) {
                var xx = $("#batas").val();
                for (var i = xx; i <= xx; i++) { 
                    if (i < maxGroup){
                      $(fGroup).append('<tr id="id'+i+'"><td style="width: 10px;"><a href="javascript:;" class="btn btn-danger remove" onclick="remove('+i+')"><span class="ft-x"></span></a></td><td style="width: 200px;"><select id="cmbProject'+i+'" name="cmbProject'+i+'" class="form-control select2" onchange="zoomAgent('+i+')"><?php echo $project ?> </select><input type="text" id="txtProjectno'+i+'" name="txtProjectno'+i+'" hidden><input type="text" id="txtEntitycd'+i+'" name="txtEntitycd'+i+'" hidden></td><td style="width: 200px;"><select id="cmbAgent'+i+'" name="cmbAgent'+i+'" class="form-control select2"></select><input type="text" id="txtdbprofile'+i+'" name="txtdbprofile'+i+'" hidden></td></tr>'); 
                    }
                }
                xx = i;
                $('#batas').val(i);
                $(".select2").select2({
                    width:'200'
                });
            });
        });

        function remove(no){
            $("#id"+no).remove();
            // $("#batas").val(x);
            var xx = parseInt($('#batas').val());
            if(xx>1) {
                xx = xx-1;
                console.log(xx);
                $("#batas").val(xx);  
            }
        }

        function zoomAgent(no){
            document.getElementById('loader').hidden=false;

            var dbprofile = $('#cmbProject'+no).find(':selected').data("db_profile");
            var entitycd = $('#cmbProject'+no).find(':selected').data("entity_cd");
            var projectno = $('#cmbProject'+no).find(':selected').data("project_no");

            $('#txtdbprofile'+no).val(dbprofile);
            $('#txtEntitycd'+no).val(entitycd);
            $('#txtProjectno'+no).val(projectno);

            // console.log(dbprofile);
            // var dbprofile = $('#cmbProject'+no).find(':selected').val();       
            if(dbprofile!=='' && entitycd!=='' && projectno!=='') {
                var site_url = '<?php echo base_url("c_submit_agent/zoom_project_from")?>';
                $.post(site_url,
                    {dbprofile:dbprofile, entitycd:entitycd, projectno:projectno},
                    function(data,status) {
                        $("#cmbAgent"+no).empty();
                        $("#cmbAgent"+no).append(data);
                        $("#cmbAgent"+no).trigger('change');
                        document.getElementById('loader').hidden=true;
                    }
                );
            }
            else{
                $("#cmbAgent"+no).empty();
                // document.getElementById('loader').hidden=true;
            }
        }

        $('#savefrm').click(function(){
            // if($('#frmEditor').valid()){
                // document.getElementById("btnSave").disabled = true;
                document.getElementById('loader').hidden=false;
                // var nup_id = $('#modal').data('nup_id');
                var datafrm = $('#frmEditor').serializeArray();
                // datafrm.push({name:"nup_id",value:nup_id});
                // var obj = new Object();
                // obj.id = nup_id;
                
                $.ajax({
                    url : "<?php echo base_url('c_submit_agent/save_agent');?>",
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
                            tblagent.ajax.reload(null,true);
                            tblhisagent.ajax.reload(null,true);
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
            // }
        });
    </script>
<!-- script -->