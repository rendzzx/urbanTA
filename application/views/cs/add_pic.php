<style >
 #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>

<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<form id="addFrm" enctype="multipart/form-data" method="post" action="">
<div id="loader" class="loader" hidden="true"></div>
	<div class="form-group">
		<label for="userfile" class="control-label" id="lbl"></label><br>
		<img src="" id="picturebox" width="120px" class="img-responsive"><br>
        <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/x-png,image/gif,image/jpeg" required/>
                        </span>
                        <b>Max Size 10 MB.</b>
		<input type="hidden" name="complain_no" id="complain_no" >
        <input type="hidden" name="seqno" id="seqno" >
        <input type="hidden" name="picturepath" id="picturepath" >
	</div>

	<input type="button" value="Upload" id="btnSave" name="btnSave" class="btn btn-success fileinput-button">
</form>

<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>  
<script type="text/javascript">
function loaddata(){
    var id = $('#modal').data('complain_no');
    var sn = $('#modal').data('seqno');

    $('#complain_no').val(id);
    $('#seqno').val(sn);
}

$(document).ready(function () {
    var isFile;
	loaddata();
    var id = $('#modal').data('complain_no'); 
    var sn = $('#modal').data('seqno');
    function CheckFileName() {
        var fileName = document.getElementById("uploadFile").value
        if (fileName == "") {
            alert("Please only upload image files.");
            return false;
        }
        else if (fileName.split(".")[1].toUpperCase() == "PNG")
            return true;
        else {
            alert("File with " + fileName.split(".")[1] + " extensions is invalid. Upload a validfile with png, jpg & gif extensions");
            return false;
        }
        return true;
    }

	$("#userfile").on('change', function () {
        // $("#Picture").val(this.files[0].name);
        var a = this.files[0].size;
        var max = (1024 *1024) * 7;

        if (a > max){
            // alert(max.toString().length);
            
            if (max.toString().length > 6) {
                max = max / 1024 / 1024;
                max = max.toFixed(2);
                max = max + ' mb';
            } else {
                max = max / 1024;
                max = max.toFixed(2);
                max = max + ' kb';
            }
            swal('Please upload less than ' + max);
            return false;
        }


        readURL(this);
    });

    $('#userfile').fileupload({

            url: "<?php echo base_url('c_cs/savePic');?>",
            dataType: 'json',
            // data:{'no':i},
            add: function (e, data) {
                jqXHRData = data
                isFile = true;    

            },
            done: function (event, response) {

                // if(i == (batas-1)){
                  var res = response.result;
                  console.log(res);
                  if(res.status =='OK'){
                      // swal({
                      //         title: "Information",
                      //         animation: false,
                      //         type:"success",
                      //         text: res.pesan,
                      //         confirmButtonText: "OK"
                      //       },function(){
           
                                
                      //     });
                                var dataUrl = $('#picturepath').val();
                                document.getElementById("picturebox"+sn).src=dataUrl;
                                $('#picturename'+sn).val(res.picname);
                                $('#modal').modal('hide');
                                // document.getElementById('loader').hidden=true; 
                  }else{
                       swal({
                              title: "Warning",
                              animation: false,
                              type:"error",
                              text: res.pesan,
                              confirmButtonText: "OK"
                            });
                       document.getElementById('loader').hidden=true; 
                  }
                // }
                        

            },
            fail: function (event, response) {
                // BootstrapDialog.alert(response.result.Pesan);
                var error = response["_response"]["errorThrown"];
                // console.log(event);
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: error,
                    confirmButtonText: "OK"
                          });
            }
        });

	$('#btnSave').click(function(){
       
        document.getElementById('loader').hidden=false; 
		var id = $('#modal').data('seqno');
        var complain_no = $('#complain_no').val();
		var datafrm = $('#addFrm').serializeArray();
        datafrm.push({name:"isFile",value:isFile});

        if(isFile){     
        console.log(jqXHRData);       
            if(jqXHRData){
                console.log(datafrm);
                jqXHRData.formData = datafrm;
                jqXHRData.submit();
                isFile = false;
                // document.getElementById('loader').hidden=true; 
            }
            else {
                swal("Information","Can't Upload this file. please choose another file","Warning");
            }
        }
       
	});
   
    function readURL(input) 
    {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e) {
                // alert('dpr');
                // document.getElementById("picturebox").src=e.target.result;
                $('#picturebox').attr('src', e.target.result);
                $('#picturepath').val(e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
});
</script>