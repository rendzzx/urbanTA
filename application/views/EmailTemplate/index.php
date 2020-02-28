<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Email Tempalte</h2>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                Template 1
            </div>
            <div class="panel-body" style="height: 335px">
                <img class="img-responsive" src="<?=base_url('img/email_template/E01.png')?>">
            </div>
            <div class="panel-footer">
                <button class="btn btn-block btn-primary" id="choose_1" value="1">Choose Template</button>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Template 2
            </div>
            <div class="panel-body" style="height: 335px">
                <img class="img-responsive" src="<?=base_url('img/email_template/E02.png')?>">
            </div>
            <div class="panel-footer">
                <button class="btn btn-block btn-primary" id="choose_2" value="2">Choose Template</button>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                Template 3
            </div>
            <div class="panel-body" style="height: 335px">
                <img class="img-responsive" src="<?=base_url('img/email_template/E03.png')?>">
            </div>
            <div class="panel-footer">
                <button class="btn btn-block btn-primary" id="choose_3" value="3">Choose Template</button>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="panel panel-info">
            <div class="panel-heading">
                Template 4
            </div>
            <div class="panel-body">
                <img class="img-responsive" src="<?=base_url('img/email_template/coming_soon.png')?>">
            </div>
            <div class="panel-footer">
                <button class="btn btn-block btn-primary" id="choose_4" value="4">Choose Template</button>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
	$(document).ready(function(){

		var id = ['1', '2', '3','4'];

		id.forEach(function(element) {
    		$("#choose_"+element).click(function(){
    			var idemail = $(this).val();
    			window.location.href = "<?php echo base_url("c_email/editemail/") ?>"+idemail;
    		})
    	});
    });
</script>

</html>