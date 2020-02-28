
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<form id="addFrm" enctype="multipart/form-data" method="post" action="<?php //echo base_url('c_nup/saveUpload')?>">
<div id="loader" class="loader" hidden="true"></div>
	<div class="form-group">
		<label for="userfile" class="control-label" id="lbl"></label><br>
		<img src="" id="picturebox" width="120px" class="img-responsive"><br>
        <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/*" required/>
                        </span>
                        <b>Max Size 10 MB.</b>
		<!-- <input type="file" name="userfile" id="userfile" accept="file_extension:,.jpg,.png,.pdf"> -->
		<input type="hidden" name="dt" id="dt" >
		<input type="hidden" name="row" id="row" >
        <input type="hidden" name="sn" id="sn" >
	</div>
<!--     <div class="form-group">
                   <div class="col-xs-2">
                     <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/*" />
                        </span>
                        <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                   </div>
                    <div class="col-xs-5">
                        <img id="picturebox" width="118" src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="Your Image" />
                    </div>
                </div> -->
    
	<input type="button" value="Upload" id="btnSave" name="btnSave" class="btn btn-success fileinput-button">
</form>

<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>  
<script type="text/javascript">
function loaddata(){
  var id = $('#modal').data('id');
        // alert(id);
       //  var descs;// = $('#modal').data('descs');
        // alert(descs);
        var sn = $('#modal').data('sn');
        // alert(sn);
        // var site_url = "<?php echo base_url('c_nup/getimage/') ?>";
        // alert(descs);
        // $('#row').val(id);
        // $('#sn').val(sn);
        // $.post(
        //     site_url,
        //     {rid:id},
        //     function(data,status){
        //         // $('#picturebox').attr('src','<?php echo base_url("img/NUP/")?>'+'/'+data[0].file_attachment);
        //         console.log(data[0].file_attachment);
        //         descs = data[0].document_descs;
        //         console.log(descs);
        //         $('#lbl').text(descs + ' Upload :');
        //         $('#dt').val(descs);
                $('#row').val(id);
                $('#sn').val(sn);
        //     }
        // );
        //   $.ajax({
        //   url: site_url,
        //   type: "POST",
        //   data: {rid:id},
        //   dataType: "json",
        //   success: function(data, status){
        //     // console.log(data[0].document_descs);
        //     var descs = data[0].document_descs;
        //     $('#lbl').text(descs + ' Upload :');
            
        // //         $('#dt').val(descs);
        //   },
        //   error: function(jqXHR, textStatus, errorThrown){
        //     BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
        //   }
        // })
}

$(document).ready(function () {
	loaddata();

    //document.getElementById('lbl1').value="FUCK";
    //$("#kampret").replaceWith($("#kampret")).val('');

	$("#userfile").on('change', function () {
        // $("#Picture").val(this.files[0].name);
        var a = this.files[0].size;
        // var max = (1024 *1024) * 7;
        var max = (1024 *1024) * 10;

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
        // alert(this.files[0].size);
        // alert('123');
        // console.log(a);

        readURL(this);
        // alert($("#Picture").val());
    });

	$("#userfile").fileupload({ 
        url: "<?php echo base_url('c_nup_cfld/saveUpload');?>",
        dataType: 'json',
        add: function (e, data) {
            jqXHRData = data
            isFile = true;
        },
        done: function(event, response){
        	var res = response.result;
            // console.log('done'+response);
            // console.log('res'+res);
            var cn = response.result.count;
            // console.log('a');
            document.getElementById('loader').hidden=true;
            // console.log('b');
            swal(response.result.pesan);
            $('#cntfile').val(cn);
        	// console.log(res);
        	$('#modal').modal('hide');            
            table.ajax.reload(null,true);
        },
        fail: function(event, response) {
            // var res = response.result;
         //    console.log('event'+event);
        	// console.log(response);
            swal('error','Upload Filed! Please check Your image size.','error');
            document.getElementById('loader').hidden=true;
            return;
            // alert(res);
        }


	});

	$('#btnSave').click(function(){
        
        // return;       
		var id = $('#modal').data('id');
        var row =$('#row').val();
		var datafrm = $('#addFrm').serializeArray();
		var obj = new Object();
        obj.id = id;
        obj.isFile = isFile;

        if(isFile){            
            if(jqXHRData){
                jqXHRData.formData = datafrm;
                jqXHRData.submit();
                isFile = false;
            }
            // console.log('opsi1');
             
            // $('#modal').modal('hide');            
            // table.ajax.reload(null,true);
            
        }
        document.getElementById('loader').hidden=false;
        // document.getElementById('userfile').value="";
        //$("#userfile").replaceWith($("#userfile").val('');
        // document.getElementById("myBar").hidden=true;
	});
   
    function readURL(input) 
    {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#picturebox').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
});
</script>