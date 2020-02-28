<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/summernote/summernote-bs3.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/iCheck/custom.css')?>" rel="stylesheet">


</head>
<body>

	<div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Email Template</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="template_email" class="col-sm-2">Template Email</label>
                                    <div class="col-sm-9">
                                        <select id="tempalte" name="id">
                                            <option value="1">Template 1</option>
                                            <option value="2">Template 2</option>
                                            <option value="3">Template 3</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-5">
                                        <img style="width: 300px;margin-left: 350px" id="imgtemplate" class="img-responsive" src="<?=base_url('img/email_template/E01.png')?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="template_email" class="col-sm-2">Subject</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="subject" id="subject" class="form-control">
                                    </div>
                                    <input type="button" name="tag" id="tag" value="Insert Tag" data-toggle="modal" data-target="#modaltag" class="btn btn-primary">
                                </div> 
                                <div class="form-group">
                                    <label for="template_email" class="col-sm-2">Content</label>
                                    <div class="col-sm-6">
                                        <div id="content"></div>
                                    </div>
                                </div> 
                            </div>                  
                        </form>
                    </div>
                    <div class="ibox-footer">
                        <button type="button" id="btnsend" class="btn btn-primary">Send Email</button>
                    </div>
                    <br>
                </div>
            </div>
            <div class="modal inmodal fade" id="modaltag" tabindex="-1" role="dialog"  aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            Insert Tag
                        </div>
                        <div class="modal-body">
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input id="name" name="check" type="checkbox" value="<?php echo $name ?>">
                                <label for="name">
                                    Name
                                </label>
                            </div>
                            <div class="checkbox checkbox-info checkbox-circle">
                                <input id="project" name="check" type="checkbox" value="<?php echo $project ?>">
                                <label for="project">
                                    Project Name
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btninsert" class="btn btn-primary">Insert</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                        </div>
                    </div>
                </div>
            </div>

</body>
</html>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
<script src="<?=base_url('js/plugins/iCheck/icheck.min.js')?>"></script>

<script type="text/javascript">
	$(document).ready(function(){

        var email = '<?php echo $email ?>'
                console.log(email);

        loaddata();

        $('.checkbox').iCheck({
            checkboxClass: 'icheckbox_square-green',
        });

        $('#btninsert').click(function(){
            var name = "";
            var project = "";
            var code = $('#content').summernote('code')
            if ($('#name').is(':checked')) {
                name = $('#name').val();
                var code2 = code.replace("{{name}}", name)
                if ($('#project').is(':checked')) {
                    project = $('#project').val()
                    var code2 = code2.replace("{{project name}}", project)
                }
                else{
                    project = $('#project').val()
                    var code2 = code.replace(project, "{{project name}}");  
                }
            }
            else{
                name = $('#name').val()
                var code2 = code.replace(name, "{{name}}");
            }

            $('#content').summernote('code',code2)
            $('#modaltag').modal('hide');
        });

		$("#tempalte").select2({
                placeholder: "Select a state",
                allowClear: true,
                width:'50%'
    	});

        $("#tempalte").change(function(){
            var a = $(this).val();
            if (a==1) {
                $('#imgtemplate').attr('src','<?=base_url('img/email_template/E01.png')?>');
            }
            if (a==2) {
                $('#imgtemplate').attr('src','<?=base_url('img/email_template/E02.png')?>');
            }
            if (a==3) {
                $('#imgtemplate').attr('src','<?=base_url('img/email_template/E03.png')?>');
            }
        })

        $('#btnsend').click(function () {
            swal({
                title: "Information",
                text: "Do you want to send an email ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#6A5ACD",
                confirmButtonText: "Yes, Send it",
                closeOnConfirm: false
            }, function () {
                var datafrm = $('#frmEditor').serializeArray();
                var email = '<?php echo $email ?>'
                console.log(email);
                var code = $('#content').summernote('code')
                var footer = "";
                var cc = "";
                datafrm.push({name:"code",value:code},{name:"footer",value:footer},{name:"cc",value:cc},{name:"email",value:email})

                        $.ajax({
                        url : "<?php echo base_url('c_email/send');?>",
                        type:"POST",
                        data:datafrm,
                        dataType:"json",
                        success:function(event, data){
                            var Statuserror = event.Error;
                            if(Statuserror==false){
                              swal({
                                title: "Information",
                                animation: false,
                                type:"success",
                                text: event.Pesan,
                                confirmButtonText: "OK"
                              });
                            } else {
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
            });
        });
	});

    function loaddata(){
        var id = "1"
        if (id > 0) {
            $.getJSON("<?php echo base_url('c_email_new/getByID');?>" + "/" + id, function (data) {
                var code = data[0].body;
                $('#content').summernote('code',code)
            });
        }
    }
	
</script>