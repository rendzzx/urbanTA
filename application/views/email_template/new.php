<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/summernote/summernote-bs3.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/plugins/iCheck/custom.css')?>" rel="stylesheet">

    <style type="text/css">
        label{
            margin-top: 9px
        }
    </style>

    <style type="text/css">
    #loader{
        width:80%;
        height:100%;
        position:fixed;
        z-index:9999;
        background:url(<?php echo base_url("img/loading.gif") ?>) no-repeat center center
    }
    </style>

</head>
<body>
    <div id="loader" class="loader" hidden="true"></div>
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
                                        <select id="tempalte" name="tempalte">
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
                                    <label>Insert Tag</label>
                                </div> 
                                <div class="form-group">
                                    <label for="template_email" class="col-sm-2">Content</label>
                                    <div class="col-sm-6">
                                        <div id="content"></div>
                                    </div>
                                    <input type="button" name="name" id="name" value="Name"class="btn btn-primary">
                                    <input type="button" name="project" id="project" value="Project"class="btn btn-primary">
                                    <input type="button" name="email" id="email" value="Email"class="btn btn-primary">
                                </div> 
                            </div>                  
                        </form>
                    </div>
                    <div class="ibox-footer">
                        <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                        <button type="button" id="btnback" class="btn btn-default">Back</button>
                    </div>
                    <br>
                </div>
            </div>

</body>
</html>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
<script src="<?=base_url('js/plugins/iCheck/icheck.min.js')?>"></script>

<script type="text/javascript">
	$(document).ready(function(){

        loaddata();
        $('#content').summernote()

        $('.checkbox').iCheck({
            checkboxClass: 'icheckbox_square-green',
        });

        $('#name').click(function(){
            $('#content').summernote('insertText', '{{name}}');
        })
        $('#project').click(function(){
            $('#content').summernote('insertText', '{{project_name}}');
        })
        $('#email').click(function(){
            $('#content').summernote('insertText', '{{email}}');
        })

        $("#btnback").click(function(){
            location.href = "<?php echo base_url("c_email_template"); ?>"
        })

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

        $('#btnSave').click(function () {
            document.getElementById('loader').hidden=false;
            var site_url = '<?php echo base_url("c_email_template")?>';
            var id = '<?php echo $id ?>'
            var datafrm = $('#frmEditor').serializeArray();
            var code = $('#content').summernote('code')
            datafrm.push({name:'id',value:id},{name:"code",value:code})

            $.ajax({
            url : "<?php echo base_url('c_email_template/save');?>",
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
                    },
                    function(){
                        window.location.href = site_url;
                    });
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

    function loaddata(){
        var id = '<?php echo $id ?>'
        if (id > 0) {
            $.getJSON("<?php echo base_url('c_email_template/getByID');?>" + "/" + id, function (data) {
                var code = data[0].body;
                $('#content').summernote('code',code)
                $('#subject').val(data[0].Tittle)
                $('#tempalte').val(data[0].Template_Id).trigger('change');
            });
        }
    }
	
</script>