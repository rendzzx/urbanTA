<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="level_no">Level No</label>
            <select data-placeholder="Choose a Level No" class="select2 form-control" id="level_no" name="level_no" required>
                <option value=""></option>
                <?php foreach ($level_no as $key) { ?>
                    <option value="<?php echo $key->level_no?>"><?php echo $key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="level_descs">Level Description</label>
            <input type="text" id="level_descs" class="form-control" placeholder="Level Description" name="level_descs">
        </div>
        <div class="form-group">
            <label for="meter_type">Meter Type</label>
            <select data-placeholder="Choose Meter Type" class="select2 form-control" id="meter_type" name="meter_type" required>
                <option value=""></option>
                <?php foreach ($meter_type as $key2) { ?>
                    <option value="<?php echo $key2->meter_type?>"><?php echo $key2->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="doc_date">Doc Date</label>
            <input type="date" id="doc_date" class="form-control" placeholder="Doc Date" name="doc_date" required>
        </div>
        <div class="form-group">
            <label for="read_date">Meter Reading Date</label>
            <input type="date" id="read_date" class="form-control" placeholder="Doc Date" name="read_date" required>
        </div>
        <div class="form-group">
            <input type="checkbox" id="generatemeter" placeholder="Generate Meter" name="generatemeter">
            <label for="generatemeter">Default Generate Meter ID</label>
        </div>
    </div>
</form>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script>
$(document).ready(function(){

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $('.select2').select2()

    // loaddata();

    $('#level_no').change(function(){
        block(true);
        var id = $(this).val()
        $.getJSON("<?php echo base_url('testing2/getByIDmeterreading/');?>"+id, function (data) {
            $('#level_descs').val(data[0].descs)
            block(false);
        });
        $.getJSON("<?php echo base_url('testing2/getByIDmeterreading_metertype');?>", function (data) {
            $('#meter_type').val(data[0].meter_type)
            block(false);
        });
    })

    $('#savefrm').click(function(){
        block(true);
        var id = $('#modal').data('id');
        var datafrm = $('#frmdata').serializeArray();
        datafrm.push({name:"id",value:id})

        $.ajax({
            url : "<?php echo base_url('testing2/save_meterreading');?>",
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
                    tblmeterreading.ajax.reload(null,true);
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