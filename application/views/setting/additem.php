<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/forms/checkboxes-radios.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">

<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="name">Item Code</label>
            <input type="text" id="itemcd" class="form-control" placeholder="Item Code" name="itemcd">
        </div>
        <div class="form-group">
            <label for="descs">IC Flag</label>
            <div class="row skin skin-line">
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="icflag" id="Y" value="Y" checked="">
                        <label for="Y" id="labelY">Yes</label>
                    </fieldset>
                </div>
                <div class="col-md-4">
                    <fieldset>
                        <input type="radio" name="icflag" id="N" value="N">
                        <label for="N" id="labelN">No</label>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="name">Description</label>
            <input type="text" id="descs" class="form-control" placeholder="Description" name="descs">
        </div>
        <div class="form-group">
            <label for="sectioncd">Trx Type</label>
            <select data-placeholder="Choose a Trx Type" class="select2 form-control" id="trxtype" name="trxtype">
                <option value=""></option>
                <?php foreach ($trxtype as $key) { ?>
                    <option value="<?php echo $key->trx_type?>"><?php echo $key->trx_type_desc ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="division">Tax Code</label>
            <select data-placeholder="Choose a Tax Code" class="select2 form-control" id="taxcd" name="taxcd">
                <option value=""></option>
                <?php foreach ($taxcd as $key) { ?>
                    <option value="<?php echo $key->scheme_cd?>"><?php echo $key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="departement">Currency</label>
            <select data-placeholder="Choose a Currency" class="select2 form-control" id="currencycd" name="currencycd">
                <option value=""></option>
                <?php foreach ($currency as $key) { ?>
                    <option value="<?php echo $key->currency_cd?>"><?php echo $key->currency_cd." - ".$key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="doctype">Unit Pricee</label>
            <input type="text" id="unitprice" class="form-control" placeholder="Unit Price" name="unitprice">
        </div>
    </div>
</form>

<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>

<!-- <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>" type="text/javascript"></script>
 -->
<script>
	$(document).ready(function(){

    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });

    $(".select2").select2({
        width:'100%'
    });

		loaddata();

        $('#savefrm').click(function(){
            block(true);
            var id = $('#modal').data('id');
            var datafrm = $('#frmdata').serializeArray();
            datafrm.push({name:"id",value:id})

            $.ajax({
                url : "<?php echo base_url('C_Setting_Cs/save_item');?>",
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
                        tblitem.ajax.reload(null,true);
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

    });

    function loaddata(){
        var id = $('#modal').data('id');
        if (id > 0) {
            block(true);
            $.getJSON("<?php echo base_url('C_Setting_Cs/getByIDitem');?>" + "/" + id, function (data) {
                $('#itemcd').val(data[0].item_cd);
                var ic = data[0].ic_flag;
                $("#"+ic).attr('checked', 'checked');
                var label_ic = ''
                if (ic=='Y') {
                    label_ic = 'Yes'
                }
                else {
                    label_ic = 'No'
                }

                $(".iradio_line-blue").removeClass("checked")
                $("#"+ic).iCheck({
                  radioClass: 'iradio_line-blue checked',
                  insert: '<div class="icheck_line-icon"></div>' + label_ic
                });
                $('#descs').val(data[0].descs);
                $('#trxtype').val(data[0].trx_type).trigger("change");
                $('#taxcd').val(data[0].tax_cd).trigger("change");
                $('#currencycd').val(data[0].currency_cd).trigger("change");
                $('#unitprice').val(data[0].charge_amt)
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