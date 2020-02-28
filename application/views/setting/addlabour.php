<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">

<form class="form" id="frmdata">
    <div class="form-body">
        <div class="form-group">
            <label for="sectioncd">Labour</label>
            <select data-placeholder="Choose a Labour" class="select2 form-control" id="labourid" name="labourid">
                <option value=""></option>
                <?php foreach ($labour as $key) { ?>
                    <option value="<?php echo $key->staff_id?>"><?php echo $key->staff_name ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <label for="division">Division</label>
            <select data-placeholder="Choose a Division" class="select2 form-control" id="division" name="division">
                <option value=""></option>
                <?php foreach ($division as $key) { ?>
                    <option value="<?php echo $key->div_cd?>"><?php echo $key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="departement">Departemet</label>
            <select data-placeholder="Choose a Departemet" class="select2 form-control" id="departement" name="departement">
                <option value=""></option>
                <?php foreach ($departement as $key) { ?>
                    <option value="<?php echo $key->dept_cd?>"><?php echo $key->descs ?></option>
                <?php }  ?>
            </select>
        </div>
        <div class="form-group">
            <label for="doctype">Doc Type</label>
            <input type="text" id="doctype" class="form-control" placeholder="Service Description" name="doctype">
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


        $("#labourid").change(function(){
            block(true);
            var id = $(this).val()
            $.getJSON("<?php echo base_url('C_Setting_Cs/zoomlabour');?>" + "/" + id, function (data) {
                $('#name').val(data[0].staff_name)
                $('#division').val(data[0].div_cd).trigger('change')
                $('#departement').val(data[0].dept_cd).trigger('change')
                block(false);
            });
        })

		loaddata();

        $('#savefrm').click(function(){
            block(true);
            var id = $('#modal').data('id');
            var datafrm = $('#frmdata').serializeArray();
            datafrm.push({name:"id",value:id})

            $.ajax({
                url : "<?php echo base_url('C_Setting_Cs/save_labour');?>",
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
                        tbllabour.ajax.reload(null,true);
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
            $.getJSON("<?php echo base_url('C_Setting_Cs/getByIDlabour');?>" + "/" + id, function (data) {
                $('#labourid').val(data[0].staff_id).trigger("change");;
                $('#name').val(data[0].name)
                $('#division').val(data[0].div_cd).trigger("change");
                $('#departement').val(data[0].dept_cd).trigger("change");;
                $('#doctype').val(data[0].prefix);
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