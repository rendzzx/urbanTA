<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>
<div id="loader" class="loader" hidden="true"></div>

    <form id="fAttch" enctype="multipart/form-data" method="post" action="<?php //echo base_url('attachment/saveLogo')?>">

       <div class="box-body">
        <div class="row ">
            <div class="col-sm-5">
                <div class="form-group" style="margin-left: 20px">
                    <label class="checkbox-inline"></label><br>
                    <label for="logo" class="control-label">Sales Booking Picture :</label> 
                    <div id="logo" class="image" >
                        <img class="img-responsive" src="<?php echo(empty($logo) ? base_url('img/PlProject/no_poto2.jpg'): $logo );?>" width="120px" id="picturebox">
                    </div>
                    <br>
                  
                    <span class="btn btn-success fileinput-button">
                        <span>Select File...</span>
                        <input type="file" id="picture" name="picture" accept="file_extension:,.jpg,.png,.gif" />
                    </span>

                    <p>(* Only Jpg, Png, Gif allowed)</p>
                    <input type="hidden" id="booking_pic" value="<?php echo $logo?>" readonly="1">
                    
                </div>
                <input type="hidden" name="pcd" id="pcd" value="<?php echo $pcd?>">
                <input type="hidden" name="project" id="project" value="<?php echo $project?>">
            </div>
  		    <div class="col-sm-7">
                <label class="checkbox-inline"></label><br>
                <label class="control-label">Active</label><br>
                <div class="radio">

                            <label>
                                <input id='work1' name='workdone' type='radio' value="1.00"/>Active 
                            </label> &emsp;
                            <label>
                                <input id='work0' name='workdone' type='radio' value="0.00" />Not Active
                            </label>
                        </div>
            </div>
            </div>
            <div class="row ">
            	<div class=" modal-footer">
               		<button type="button" id="btnSave" class="btn btn-primary">Save</button>
                	<a href="<?=base_url('c_property')?>"  class="btn btn-default" data-dismiss="modal">Back</a>
            	</div>
            </div>
             

         
        </div>      

    </form>

<script type="text/javascript">
var table;
var isFile = false;
$(function() {
	var done = "<?php echo $active?>";
	console.log(done);
	setproduct(done);
    $("#picture").on('change', function() {
        $("#picturepath").val(this.files[0].name);
        readURL(this);
    });

    function readURL(input) {
        if(input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#picturebox").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    function setproduct(data){
        if (data=="1.00"){
 	       	 $('input:radio[id="work1"]').prop('checked',true);
        }else {
        	 $('input:radio[id="work0"]').prop('checked',true);
       }
    }

var isFile=false;
var jqXHRData;
$('#picture').fileupload({
            url: "<?php echo base_url('c_property/saveLogo');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;
                
            },
            done: function (event, response) {
            	console.log(response);
                 swal("Information",response.jqXHR.responseText.Pesan,"success");
                

                // $('[data-id=' + id + ']').remove();
                $('#modal').modal('hide');
                tblnewsfeed.ajax.reload(null,true); 

            },
            fail: function (event, response) {
                // alert(response);
                swal("Information",response.jqXHR.responseText.Pesan,"error");
            }
        });
    $('#btnSave').click(function(){
        document.getElementById('loader').hidden=false;
    	// alert(isFile);
    	console.log(jqXHRData);
        // var id = $('#modal').data('id');
        var datafrm = $('#fAttch').serializeArray();
        // datafrm.push({name:"id",value:id});
        // console.log(datafrm);
        var obj = new Object();
        // obj.id = id;
        obj.isFile = isFile;
        if(isFile) 
        {
            if(jqXHRData){
                jqXHRData.formData = datafrm;
                jqXHRData.submit();
            }
        } else {
            $.ajax({
                url : "<?php echo base_url('c_property/saveLogo');?>",
                type:"POST",
                // data:$('#form_rl_sales').serialize(),
                data: $('#fAttch').serialize() + '&' + $.param(obj),
                dataType:"json",
                success:function(data, status){
                    swal(data.pesan);
                    // console.log(data);
                    $('#modal').modal('hide');
                    document.getElementById('loader').hidden=true;
                    tblnewsfeed.ajax.reload(null,true); 
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                }
            });
        }
        
    });

  
 });
</script>
