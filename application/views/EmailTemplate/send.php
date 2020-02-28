<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="<?=base_url('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')?>" rel="stylesheet">
	<style type="text/css">
    label {
      text-align: right;
      margin-top: 8px
    }
	</style>
<style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("<?php echo base_url('img/loading.gif') ?>") no-repeat center center  

</style>
</head>
<body>
	<div id="loader" class="loader" hidden="true"></div>
	<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_email/send" enctype="multipart/form-data">
    <div class="box-body">
        <div class="form-group">
            <label for="subjectnewsfeed" class="col-xs-2">Send To</label>
            <div class="col-xs-8">
                <input class="tagsinput form-control" type="text" name="email" id="email" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="subjectnewsfeed" class="col-xs-2">Cc</label>
            <div class="col-xs-8">
                <input class="tagsinput form-control" type="text" name="cc" id="cc" placeholder="Cc">
            </div>
        </div>
        <div class="form-group">
            <label for="subjectnewsfeed" class="col-xs-2">Subject</label>
            <div class="col-xs-8">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="btnSend" class="btn btn-primary">Send</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
    </div>
</form>

</body>
</html>
<script src="<?=base_url('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function(){

        $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
            });

		$('#btnSend').click(function(){
            document.getElementById('loader').hidden=false;
			var datafrm = $('#frmEditor').serializeArray();
            var id = $('#modal').data('id');
            var code = $('#modal').data('code');
			var footer = $('#modal').data('footer');
			datafrm.push({name:"code",value:code},{name:"id",value:id},{name:"footer",value:footer})

                    $.ajax({
                    url : "<?php echo base_url('c_email/send');?>",
                    type:"POST",
                    data:datafrm,
                    dataType:"json",
                    success:function(event, data){
            			document.getElementById('loader').hidden=true;
                    	var Statuserror = event.Error;
                        if(Statuserror==false){
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          $('#modal').modal('hide');
                        } else {
            			document.getElementById('loader').hidden=true;
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
            			document.getElementById('loader').hidden=true;
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
</script>