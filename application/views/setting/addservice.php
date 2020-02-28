<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">

<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="servicecd">Service Code</label>
            <input type="text" id="servicecd" class="form-control" placeholder="Service Code" name="servicecd">
        </div>
        <div class="form-group">
            <label for="sectioncd">Section</label>
            <select data-placeholder="Choose a Section" class="select2 form-control" id="sectioncd" name="sectioncd">
                <option value=""></option>
                <?php foreach ($section as $key) { ?>
                    <option value="<?php echo $key->section_cd?>"><?php echo $key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="descs">Category</label>
            <select data-placeholder="Choose a Category" class="select2 form-control" id="categorycd" name="categorycd">
                <option value=""></option>
                <?php foreach ($category as $key) { ?>
                    <option value="<?php echo $key->category_cd?>"><?php echo $key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="descs">Trx Type</label>
            <select data-placeholder="Choose a Trx Type" class="select2 form-control" id="trxtype" name="trxtype">
                <option value=""></option>
                <?php foreach ($trxtype as $key) { ?>
                    <option value="<?php echo $key->trx_type?>"><?php echo $key->trx_type_desc ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="servicecd">Service Description</label>
            <input type="text" id="descs" class="form-control" placeholder="Service Description" name="descs">
        </div>
        <div class="form-group">
            <label for="servicecd">Hours</label>
            <input type="text" id="hours" class="form-control" placeholder="Hours" name="hours">
        </div>
        <div class="form-group">
            <label for="descs">Tax Code</label>
            <select data-placeholder="Choose a Tax Code" class="select2 form-control" id="taxcd" name="taxcd">
                <option value=""></option>
                <?php foreach ($taxcd as $key) { ?>
                    <option value="<?php echo $key->scheme_cd?>"><?php echo $key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="descs">Currency</label>
            <select data-placeholder="Choose a Currency" class="select2 form-control" id="currencycd" name="currencycd">
                <option value=""></option>
                <?php foreach ($currency as $key) { ?>
                    <option value="<?php echo $key->currency_cd?>"><?php echo $key->currency_cd." - ".$key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="servicecd">Service Rate</label>
            <input type="text" id="servicerate" class="form-control" placeholder="Service Rate" name="servicerate">
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

    $(".select2").select2();

		loaddata();

        $('#savefrm').click(function(){
            block(true);
            var id = $('#modal').data('id');
            var datafrm = $('#frmdata').serializeArray();
            datafrm.push({name:"id",value:id})

            $.ajax({
                url : "<?php echo base_url('C_Setting_Cs/save_service');?>",
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
                        tblservice.ajax.reload(null,true);
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
        })

    });

    function loaddata(){
        var id = $('#modal').data('id');
        if (id > 0) {
            block(true);
            $.getJSON("<?php echo base_url('C_Setting_Cs/getByIDservice');?>" + "/" + id, function (data) {
                $('#servicecd').val(data[0].service_cd);
                $('#sectioncd').val(data[0].section_cd).trigger("change");
                $('#categorycd').val(data[0].category_cd).trigger("change");
                $('#trxtype').val(data[0].trx_type).trigger("change");
                $('#descs').val(data[0].descs);
                $('#hours').val(data[0].service_day);
                $('#taxcd').val(data[0].tax_cd).trigger("change");
                $('#currencycd').val(data[0].currency_cd).trigger("change");
                $('#servicerate').val(data[0].labour_rate)
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