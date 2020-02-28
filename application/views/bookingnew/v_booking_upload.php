
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<style type="text/css">
     #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>

<form id="addFrm" enctype="multipart/form-data" method="post" action="">
<div id="loader" class="loader" hidden="true"></div>
	<div class="form-group">
		<label for="userfile" class="control-label" id="lbl"></label><br>
		<img id="picturebox" src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="Your Image" /><br>
        <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/*" required/>
                        </span><br>
                        <b>Max Size 10 MB.</b>
	</div>
    <input type="hidden" id="Picture" name="Picture">
	<input type="button" style="width: 123px" value="Upload" id="btnSave" name="btnSave" class="btn btn-success fileinput-button">
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
		url: "<?php echo base_url('booking/saveUpload');?>",
        dataType: 'json',
        add: function (e, data) {
            jqXHRData = data
            isFile = true;
            // console.log(jqXHRData);
            // console.log('add');
        },
        done: function(event, response){
        	// var res = response.result;
            var cn = response.result.count;
            document.getElementById('loader').hidden=false;
            // console.log(type);
            $('#cntfile').val(cn);
        	// console.log('done');
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
        // alert("test")
		var id = $('#modal').data('id');
        var row = $('#row').val();
		var datafrm = $('#addFrm').serializeArray();
        // console.log(datafrm[0].value);
		var obj = new Object();
        obj.id = id;
        obj.isFile = isFile;

        // alert(isFile);
        if(isFile) 
        {
            jqXHRData.formData = datafrm;
            jqXHRData.submit();
            
            $.ajax({
                url : "<?php echo base_url('booking/saveUpload');?>",
                type:"POST",
                // data:$('#form_rl_sales').serialize(),
                data: $('#addFrm').serialize() + '&' + $.param(obj),
                dataType:"json",
                success:function(data, status){
                    console.log(data.pesan)
                    swal(data.pesan);
                    document.getElementById('loader').hidden=false;
                    console.log(data);
                    if (type=='ktp') {
        $('#ktp').attr('src', 'http://35.197.137.111/WaskitaWeb/img/Booking/' +datafrm[0].value);
            }
            else if(type=='npwp'){
        $('#npwp').attr('src', 'http://35.197.137.111/WaskitaWeb/img/Booking/' +datafrm[0].value);
                            
            }
            else if(type=='bukti'){
        $('#bukti').attr('src', 'http://35.197.137.111/WaskitaWeb/img/Booking/' +datafrm[0].value);
            }

                    // $('#ktp').attr('src', 'http://35.197.137.111/WaskitaWeb/img/Booking/'+ktp);
                    // $('#npwp').attr('src', 'http://35.197.137.111/WaskitaWeb/img/Booking/'+npwp);
                    // $('#bukti').attr('src', 'http://35.197.137.111/WaskitaWeb/img/Booking/'+bukti);
                    $('#modal').modal('hide');
                    // tblnewsfeed.ajax.reload(null,true);
                    // alert("test")
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                    // alert("test")

                }
            });
        } else {
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