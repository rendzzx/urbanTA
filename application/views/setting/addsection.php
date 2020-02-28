<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="sectioncd">Section Code</label>
            <input type="text" id="sectioncd" class="form-control" placeholder="Section Code" name="sectioncd" required>
        </div>
        <div class="form-group">
            <label for="descs">Description</label>
            <input type="text" id="descs" class="form-control" placeholder="Description" name="descs" required>
        </div>
    </div>
</form>

<script>
	$(document).ready(function(){

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

        loaddata();

        $('#savefrm').click(function(){
            block(true);
            var id = $('#modal').data('id');
            var datafrm = $('#frmdata').serializeArray();
            datafrm.push({name:"id",value:id})

            $.ajax({
                url : "<?php echo base_url('C_Setting_Cs/save_section');?>",
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
                        tblsection.ajax.reload(null,true);
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
        });
    })

    function loaddata(){
        var id = $('#modal').data('id');
        if (id > 0) {
            block(true);
            $.getJSON("<?php echo base_url('C_Setting_Cs/getByIDsection');?>" + "/" + id, function (data) {
                $('#sectioncd').val(data[0].section_cd);
                $('#descs').val(data[0].descs);
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