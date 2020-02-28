
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<form id="addFrm" enctype="multipart/form-data" method="post" action="">
<div id="loader" class="loader" hidden="true"></div>
	<div class="form-group">
		<label for="userfile" class="control-label" id="lbl"></label><br>
		<img id="picturebox" width="118" src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="Your Image" /><br>
        <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/*" required/>
                        </span>
                        <b>Max Size 10 MB.</b>
	</div>
    <input type="text" id="Picture" name="Picture">
	<input type="button" value="Upload" id="btnSave" name="btnSave" class="btn btn-success fileinput-button">
</form>

<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>  
<script type="text/javascript">
function loaddata(){
  // var type = $('#modal').data('type');
}

$(document).ready(function () {
	loaddata();
    var type = $('#modal').data('type');
            console.log(type);
var isFile=false;
var jqXHRData;
	$("#userfile").on('change', function () {
        $("#Picture").val(this.files[0].name);
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
        // alert(this.files[0].size);
        // alert('123');
        console.log(a);

        readURL(this);
        // alert($("#Picture").val());
    });

	$("#userfile").fileupload({        
		url: "<?php echo base_url('c_reservation/saveUpload');?>",
        dataType: 'json',
        add: function (e, data) {
            jqXHRData = data
            isFile = true;
            console.log(jqXHRData);
            console.log('add');
        },
        done: function(event, response){
        	// var res = response.result;
            var cn = response.result.count;
            document.getElementById('loader').hidden=true;
            console.log(type);
            $('#cntfile').val(cn);
        	console.log('done');
        	$('#modal').modal('hide');
            if (type=='ktp') {
                $('#ktp').val($('#Picture').val());
            }
            else if(type=='npwp'){
                $('#npwp').val($('#Picture').val());
            }
            else if(type=='bukti'){
                $('#bukti').val($('#Picture').val());
            }
            // table.ajax.reload(null,true);
        },
        fail: function (event, response) {
        	console.log(response);
            console.log('fail');
            // swal(response.result.Pesan);
        }


	});

	$('#btnSave').click(function(){        
		var id = $('#modal').data('id');
        var row = $('#row').val();
		var datafrm = $('#addFrm').serializeArray();
        console.log(datafrm);
		var obj = new Object();
        obj.id = id;
        obj.isFile = isFile;


        if(isFile) 
        {
            if(jqXHRData){
                jqXHRData.formData = datafrm;
                jqXHRData.submit();
            }
        } else {
            $.ajax({
                url : "<?php echo base_url('c_reservation/saveUpload');?>",
                type:"POST",
                // data:$('#form_rl_sales').serialize(),
                data: $('#addFrm').serialize() + '&' + $.param(obj),
                dataType:"json",
                success:function(data, status){
                    swal(data.pesan);
                    // console.log(data);
                    // $('#modal').modal('hide');
                    // tblnewsfeed.ajax.reload(null,true); 
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                }
            });
        }
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