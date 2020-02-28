
<!--<script src="<?=base_url('js/plugins/signature-pad/signature_pad.js')?>"></script> 
<link href="<?=base_url('css/plugins/signature-pad/signature-pad.css')?>" rel="stylesheet">
-->
<style>
    .container-canvas {
        /* This could be done in one single declaration. See the extended sample. */
        margin-right: auto;
        margin-left: auto;
        /*width: 70%;*/
    }
</style>


    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
           <div id="signature-pad" class="signature-pad">
              <div class="signature-pad--body" align="center">
                <canvas class="container-canvas" style="border:1px solid #000000;"></canvas>
              </div>
          <!-- <div class="signature-pad--footer"> class="container-canvas" 
                <div class="description">Sign above</div>
            <div class="left">
                  <button type="button" class="button clear" data-action="clear">Clear</button>
            </div>
            <div class="right">
             <button type="button" class="button save" data-action="save-png">Save as PNG</button>
             <button type="button" class="button save" data-action="save-svg">Save as SVG</button>
            </div>
          </div> -->
            </div>
        </div>   
        <div class="modal-footer">
            <!-- <button type="button" class="button clear" id="btnclear">Clear</button> -->
            <button type="button" id="btnclear" class="button save btn btn-primary" data-action="clear">Clear</button>
            <button type="button" id="btnSave" class="button save btn btn-primary" data-action="save-png">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>



<script type="text/javascript">
var wrapper = document.getElementById("signature-pad"),
    clearButton = document.getElementById("btnclear"),//wrapper.querySelector("[data-action=clear]"),
    // savePNGButton = wrapper.querySelector("[data-action=save-png]"),
    // saveSVGButton = wrapper.querySelector("[data-action=save-svg]"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
    // When zoomed out to less than 100%, for some very strange reason,
    // some browsers report devicePixelRatio as less than 1
    // and only part of the canvas is cleared then.
    // signaturePad.clear(); 
    var ratio =  Math.max(window.devicePixelRatio || 1, 1);
    // console.log(canvas.offsetWidth);
    // console.log('----------------');
    // console.log(ratio);
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    // canvas.width = 100 * ratio;
    // canvas.height = 100 * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    // signaturePad.clear(); //
}
// window.addEventListener("resize", resizeCanvas);
// resizeCanvas();
window.onresize = resizeCanvas;
// resizeCanvas();

signaturePad = new SignaturePad(canvas);
// signaturePad.minWidth = 1;
// signaturePad.maxWidth = 1;
// signaturePad.penColor = "rgb(66, 133, 244)";
clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
});

$('#btnSave').click(function(){
  var debtor = $('#modal').data("debtor_acct");
  var name = $('#modal').data("name");
  
   if (signaturePad.isEmpty()) {
        alert("Please provide signature first.");
    } else {
        // window.open(signaturePad.toDataURL());
        
        var dataUrl = signaturePad.toDataURL();
        // console.log(dataUrl);
            // document.getElementById('imagen_firma').src = dataUrl;
            var imagen = dataUrl.replace(/^data:image\/(png|jpg);base64,/, "");
            var site_url = "<?php echo base_url('C_customer_service_update/save_signature')?>";
            var dataform = new Array();
            dataform.push({name:"imageData",value:imagen},
                          {name:"image_name",value:debtor+name});
            console.log(dataform);
                
                $.ajax({
                  url: site_url,
                  type: "POST",
                  data: dataform,
                  dataType: "json",
                  success: function(data, status){
                                    
                      // alert(data.status);
                      if(data.status=="OK"){
                            // swal("Information",event.Pesan,"success");
                            // $('#divpict').load( "<?php echo base_url('C_customer_service_update/goto_signature');?> #divpict",{"Name":'111111'} );
                            document.getElementById("picturebox").src=dataUrl;
                            $('#modal').modal('hide');
                            $('#txt_sign').val('OK');
                      }else{
                            swal("Information",data.pesan,"warning");
                      }
              },
              error: function(jqXHR, textStatus, errorThrown){
                document.getElementById('loader').hidden=true; 
                document.getElementById("submit").disabled = false;
                swal(textStatus+' Save : '+errorThrown);
              }
            })
    }
});
// savePNGButton.addEventListener("click", function (event) {
//     if (signaturePad.isEmpty()) {
//         alert("Please provide signature first.");
//     } else {
//         window.open(signaturePad.toDataURL());
//     }
// });

// saveSVGButton.addEventListener("click", function (event) {
//     if (signaturePad.isEmpty()) {
//         alert("Please provide signature first.");
//     } else {
//         window.open(signaturePad.toDataURL('image/svg+xml'));
//     }
// });

  
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>