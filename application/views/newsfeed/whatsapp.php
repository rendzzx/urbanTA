<link href="<?=base_url('css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')?>" rel="stylesheet">
<style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("<?php echo base_url('img/loading.gif') ?>") no-repeat center center  
  }
</style>
<div id="loader" class="loader" hidden="true"></div>
<script src="<?=base_url('js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')?>"></script>
<form id ="frmEditor" class="form-horizontal" enctype="multipart/form-data">
                 <div class="box-body">
                    <div class="form-group">
                       <label class="col-xs-5" id="proname"></label>
                    </div>
                    <div class="form-group">
                       <label class="col-xs-5" id="name"><?php echo $name ?></label>
                       <input type="hidden" name="notlp" id="notlp" value="<?php echo $handphone ?>">
                    </div>
                <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2">Subject</label>
                     <div class="col-xs-8">
                       <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                     </div>
                </div>
                <div class="form-group">
                    <label for="subjectnewsfeed" class="col-xs-2">Cc</label>
                    <div class="col-xs-8">
                        <input class="tagsinput form-control" type="text" name="emailcc" id="emailcc" placeholder="Cc">
                    </div>
                </div>
                <div class="form-group">
                     <div class="col-xs-8">
                       <a href="" target="_blank" id="wa"><button type="button" class="btn btn-success">Send Whatsapp</button></a>
                       <button type="button" class="btn btn-danger" id="email">Send Email</button>
                     </div>
                    </div>
                </div>
            </form>

<script type="text/javascript">
    $( document ).ready(function() {

        $('.tagsinput').tagsinput({
                tagClass: 'label label-primary'
            });

        var proname = $('#modal').data('name');
        $("#text").val("Saya Tertarik Reservasi "+name)
        var text = $("#text").val()
        $("#proname").html(proname)

        $("#wa").click(function(){
        var notlp = "<?php echo $handphone ?>";
        $(this).attr("href", "https://api.whatsapp.com/send?phone="+notlp+"&text="+text)
        })

        // $("#email").click(function(){
        //     $.ajax({
        //     url : "<?php echo base_url('newsfeed/sendemail');?>",
        //     type:"POST",
        //     data:$('#frmEditor').serialize(),
        //     dataType:"json",
        //     success:function(event, data){
        //         if(event.Error==false){

        //           swal({
        //             title: "Information",
        //             animation: false,
        //             type:"success",
        //             text: event.Pesan,
        //             confirmButtonText: "OK"
        //           });
        //           $('#modal').modal('hide');
        //           tblnewsfeed.ajax.reload(null,true);
        //         } else {
        //           swal({
        //             title: "Error",
        //             animation: false,
        //             type:"error",
        //             text: event.Pesan,
        //             confirmButtonText: "OK"
        //           });
        //       }
        //     },                    
        //     error: function(jqXHR, textStatus, errorThrown){
        //           swal({
        //             title: "Error",
        //             animation: false,
        //             type:"error",
        //             text: textStatus+' Save : '+errorThrown,
        //             confirmButtonText: "OK"
        //           });
             
        //     }
        //     });
        // })

        $("#email").click(function(){
            document.getElementById('loader').hidden=false;
            $.ajax({
            url : "<?php echo base_url('newsfeed/send');?>",
            type:"POST",
            data:$('#frmEditor').serialize(),
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

