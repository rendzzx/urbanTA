 <html>
 <head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <!-- <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
  </head>
  <body>
  <div class="row wrapper border-bottom white-bg page-heading" style="background: #e8e8e8">
  <div class="col-lg-10">
    <h2 style="color: #0a3a99"><?php echo $ProjectDescs; ?></h2>
    <font color="#00000" face="ARIAL" size="4">Scan QR Code</font>
  </div>
  <div class="col-lg-2">
  </div>
</div>
  <div class="ibox-content">
    <div class="col-md-4" style="background: #263238;">
      <video id="preview"></video>
      <button id="start" class="btn btn-success btn-sm">Start</button>
      <button id="stop" class="btn btn-success btn-sm">Stop</button>
    </div>
    <form role="form" class="form-horizontal" enctype="multipart/form-data" id="frmEditor" method ="POST" >
        <div class="form-group">
            <label class="col-sm-2 control-label">Value Qr Code<FONT COLOR="RED">*</FONT></label>
            <div class="col-sm-4">
              <input type="text" class="form-control col-sm-5" id="scan" name="scan"><br><br>
              <input type="button" name="btnSave" id="btnSave" value="Save" class="btn btn-primary">
              <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-default"> 
            </div>
        </div>           
    </form>
  </div>
    <script src="<?=base_url('assets/qrcode/instascan.min.js')?>"></script>
    <script type="text/javascript">
    $(document).ready(function () {
      $("#start").click(function(){

        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        scanner.addListener('scan', function (content) {
        $("#scan").val(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
          localStorage.setItem('camera',cameras[0])
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

      })

      $('#btnSave').click(function(){
            var datafrm = $('#frmEditor').serializeArray()   
                    $.ajax({
                    url : "<?php echo base_url('c_qrcode/saveqr');?>",
                    type:"POST",
                    data:datafrm,
                    dataType:"json",
                    success:function(event, data){
                        // console.log('2');

                        if(event.St=='OK'){

                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          $('#modal').modal('hide');
                          // tblnewsfeed.ajax.reload(null,true);
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
    })

    </script>
  </body>
  </html>