<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="<?=base_url('css/plugins/iCheck/custom.css')?>" rel="stylesheet">
</head>
<body>

	<div class="checkbox checkbox-info checkbox-circle">
        <input id="name" type="checkbox" value="name">
        <label for="name">
            Name
        </label>
    </div>
    <div class="checkbox checkbox-info checkbox-circle">
        <input id="project" type="checkbox" value="<?php echo $project ?>">
        <label for="project">
            Project Name
        </label>
    </div>
    <div class="modal-footer">
        <button type="button" id="btninsert" class="btn btn-primary">Insert</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
    </div>

</body>
</html>
<script src="<?=base_url('js/plugins/iCheck/icheck.min.js')?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.checkbox').iCheck({
		    checkboxClass: 'icheckbox_square-green',
		});

		$('#btninsert').click(function(){
			var name = $('#name:checked').val()
			var project = $('#project:checked').val()
			// var data = [];
			// data.push({name:"name",value:name},{name:"project",value:project})
			// $.ajax({
   //          url : "<?php echo base_url('c_email_new/tag');?>",
   //          type:"POST",
   //          data:data,
   //          dataType:"json",
   //          success:function(event, data){
   //              $('#modal').modal('hide');
   //          },                    
   //          error: function(jqXHR, textStatus, errorThrown){
             
   //          }
   //      	});bbbbbbbbbbbbbbbbbbbbbbbbbbbb
		});
	});


</script>