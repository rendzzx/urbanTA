<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="genchrg">Generation Charges</label>
            <div class="position-relative has-icon-left">
                <input type="number" id="genchrg" class="form-control" placeholder="Generation Charges" name="genchrg" required>
                <div class="form-control-position">
                    <i class="ft-percent"></i>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="gendesc">Generation Description</label>
            <input type="text" id="gendesc" class="form-control" placeholder="Generation Description" name="gendesc" required>
        </div>
        <div class="form-group">
            <label for="demchrg">First Charges</label>
            <div class="position-relative has-icon-left"> 
                <input type="number" id="demchrg" class="form-control" placeholder="First Charges" name="demchrg" required>
                <div class="form-control-position">
                    <i class="ft-percent"></i>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="demdesc">First Description</label>
            <input type="text" id="demdesc" class="form-control" placeholder="First Description" name="demdesc" required>
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
            url : "<?php echo base_url('testing2/save_meterother');?>",
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
                    tblmeterother.ajax.reload(null,true);
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
            $.getJSON("<?php echo base_url('testing2/getByIDmeterother');?>", function (data) {
                $('#genchrg').val(data[0].gen_chrg);
                $('#gendesc').val(data[0].gen_desc);
                $('#demchrg').val(data[0].dem_chrg);
                $('#demdesc').val(data[0].dem_desc);
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