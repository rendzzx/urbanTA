<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="descs">Description</label>
            <input type="text" id="descs" class="form-control" placeholder="Description" name="descs" required>
        </div>
        <div class="form-group">
            <label>Upload PDF</label>
            <fieldset class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="userfile" name="userfile" accept="application/pdf">
                    <input type="text" id="namefile" name="namefile"  readonly="readonly" />
                    <label id="labelimage" class="custom-file-label" for="userfile">Choose File</label>
                </div>
            </fieldset>
        </div>
    </div>
</form>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script>
var isFile=false;
var jqXHRData;
$(document).ready(function(){

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $("#userfile").on('change', function () {
        $("#namefile").val(this.files[0].name);
        $("#labelimage").text(this.files[0].name);
    });

    $('#userfile').fileupload({
        url      : "<?php echo base_url('c_report/save');?>",
        dataType : 'json',
        add : function (e, data) {
            jqXHRData = data
            isFile = true;                
        },
        done : function (event, response) {
            var res = response.result
            if(res.Error==false){
                block(false);
                swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: res.Pesan,
                    confirmButtonText: "OK"
                });
                $('#modal').modal('hide');
                tbltb.ajax.reload(null,true);
                tblda.ajax.reload(null,true);
            }
            else{
                block(false);
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: res.Pesan,
                    confirmButtonText: "OK"
                });
            }
        },
        fail: function (event, response) {
            block(false);
            var error = response["_response"]["errorThrown"];
            swal({
                title: "Warning",
                animation: false,
                type:"error",
                text: error,
                confirmButtonText: "OK"
            });
        }
    });

    loaddata();

    $('#savefrm').click(function(){
        block(true);
        var id      = $('#modal').data('id');
        var module  = $('#modal').data('module');
        var datafrm = $('#frmdata').serializeArray();
        datafrm.push({name:"id",value:id},{name:"isFile",value:isFile},{name:"module",value:module})

        var obj = new Object();
        obj.isFile = isFile;
        if(isFile){
          if(jqXHRData){
            jqXHRData.formData = datafrm;
            jqXHRData.submit();
          }
        }
        else{
            $.ajax({
            url : "<?php echo base_url('c_report/save');?>",
            type:"POST",
            data:datafrm,
            dataType:"json",
            success:function(event, data){
                if(event.Error==false){
                    block(false);
                    swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    });
                    $('#modal').modal('hide');
                    tbltb.ajax.reload(null,true);
                    tblda.ajax.reload(null,true);
                }
                else {
                    block(false);
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
                block(false);
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
    })

})

    function loaddata(){
        var id = $('#modal').data('id');
        if (id > 0) {
            block(true);
            $.getJSON("<?php echo base_url('c_report/getByID');?>" + "/" + id, function (data) {
                console.log(data)
                $('#descs').val(data[0].descs);
                $('#labelimage').text(data[0].file_attachment);
                $('#namefile').val(data[0].file_attachment);
                block(false);
            });
        }
    }

    function block(boelan){
        var block_ele = $('#frmdata')
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