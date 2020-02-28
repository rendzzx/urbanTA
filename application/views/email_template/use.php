<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <style type="text/css">
  	#loader{
	    width:80%;
	    height:100%;
	    position:fixed;
	    z-index:9999;
	    background:url("img/loading.gif") no-repeat center center  
	}

	</style>
</head>
<body>
<div id="loader" class="loader" hidden="true"></div>
      <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">

        </div>
        <div class="form-group">
	        <label class="col-sm-2 control-label">Use For</label>
	        <div class="col-sm-6">
	          <select name="email" id="email" data-placeholder="Choose" class="form-control select2" tabindex="2">
	            <option value=""></option>
	            <?php foreach ($email as $key) { ?>
	            <option value="<?php echo $key->Email_Id ?>"><?php echo $key->Title ?></option>
	            <?php  } ?>
	            </select>
	        </div>
	    </div>   
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        </div>
    </form>

</body>
</html>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<script type="text/javascript">

	$(document).ready(function(){
		$("#email").select2({
		    placeholder: "Select",
		    allowClear: true,
		    width:'100%'
    	});

    	$('#btnSave').click(function () {
            document.getElementById('loader').hidden=false;
            var body = $('#modal').data('body');
            var datafrm = $('#frmEditor').serializeArray();
            datafrm.push({name:'body',value:body})

            $.ajax({
            url : "<?php echo base_url('c_email_template/useemail');?>",
            type:"POST",
            data:datafrm,
            dataType:"json",
            success:function(event, data){
                var Statuserror = event.Error;
                if(Statuserror==false){
                    document.getElementById('loader').hidden=true;
                    swal({
                        title: "Information",
                        animation: false,
                        type:"success",
                        text: event.Pesan,
                        confirmButtonText: "OK"
                    })
                    $('#modal').modal('hide');
                    tblemail.ajax.reload(null,true);
                }
                else {
                    document.getElementById('loader').hidden=true;
                    swal({
                        title: "Error",
                        animation: false,
                        type:"error",
                        text: event.Pesan,
                        confirmButtonText: "OK",
                    });
                }
            },                    
            error: function(jqXHR, textStatus, errorThrown){
                // document.getElementById('loader').hidden=true;
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
</script>