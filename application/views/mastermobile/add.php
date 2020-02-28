<link href="<?=base_url('css/plugins/summernote/summernote.css')?>" rel="stylesheet">
<!-- <link href="<?=base_url('css/plugins/summernote/summernote-bs3.css')?>" rel="stylesheet"> -->

<div class="box-body">
    <div class="tabs-container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#infra">Infrasturktur</a></li>
            <li class=""><a data-toggle="tab" href="#school">School</a></li>
            <li class=""><a data-toggle="tab" href="#hospital">Hospital</a></li>
            <li class=""><a data-toggle="tab" href="#other">Other</a></li>
        </ul>
        <div class="tab-content">
            <div id="infra" class="tab-pane active">
                <div class="panel-body">
                    <div id="i">
                    </div>
                </div>
            </div>
            <div id="school" class="tab-pane">
                <div class="panel-body">
                    <div id="s">
                    </div>
                </div>
            </div>
            <div id="hospital" class="tab-pane">
                <div class="panel-body">
                    <div id="h">
                    </div>
                </div>
            </div>
            <div id="other" class="tab-pane">
                <div class="panel-body">
                    <div id="o">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="modal-footer">
        <button type="button" id="btnSave" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
    </div>

<script src="<?=base_url('js/plugins/summernote/summernote.min.js')?>"></script>
<script>

    $(document).ready(function(){

        var id = $('#modal').data('id');
        if (id=="I") {
            $('a[href="#infra"]').click();
        }
        else if (id=="S") {
            $('a[href="#school"]').click();
        }
        else if (id=="H") {
            $('a[href="#hospital"]').click();
        }
        else if (id=="O") {
            $('a[href="#other"]').click();
        }
        

        $.getJSON("<?php echo base_url('c_amenities/getByID');?>",
            function (data) {
                console.log(data);
                var infra = data[0].amenities_info
                var school = data[1].amenities_info
                var hospital = data[3].amenities_info
                var other = data[2].amenities_info
                $('#i').summernote({
                    height: 300,
                    onImageUpload: function(files, editor, welEditable) {
                        sendFile(files[0], editor, welEditable);
                    }
                });
                 function sendFile(file, editor, welEditable) {
                    data = new FormData();
                    data.append("file", file);
                    $.ajax({
                        data: data,
                        type: "POST",
                        url: "c_amenities/upload",
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(url) {
                            editor.insertImage(welEditable, url);
                        }
                    });
                }
                $('#i').summernote('code',infra)

                $('#s').summernote({
                    height: 300,
                });
                $('#s').summernote('code',school)

                $('#h').summernote({
                    height: 300,
                });
                $('#h').summernote('code',hospital)

                $('#o').summernote({
                    height: 300,
                });
                $('#o').summernote('code',other)

            }
        );

        $('#btnSave').click(function(){
            data = []
            var infra = $('#i').summernote('code')
            var school = $("#s").summernote('code')
            var hospital = $("#h").summernote('code')
            var other = $("#o").summernote('code')
            data.push(
                {name:'infra',value:infra},
                {name:'school',value:school},
                {name:'hospital',value:hospital},
                {name:'other',value:other}
                )

            $.ajax({
                    url : "<?php echo base_url('c_amenities/save_amenities');?>",
                    type:"POST",
                    data:data,
                    dataType:"json",
                    success:function(event, data){

                        if(event.status=='OK'){
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          $('#modal').modal('hide');
                          tblnewsfeed.ajax.reload(null,true);
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
</script>
