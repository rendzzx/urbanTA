<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>

<form id="fNuploc" enctype="multipart/form-data" method="post" action="<?php echo base_url('c_nup_loc/save')?>">
    <div class="form-group">
        <label for="pl_project" class="col-sm-1 control-label">Project</label>
        <div class="col-sm-10">
            <select name="pl_project" id="pl_project" data-placeholder="Choose a Project..." class="chosen-select" style="width:250px;" tabindex="2">
                <?php echo $comboPrj?>
            </select>
        </div>
        <br>
    </div>
    <div class="form-group">
        <label for="location" class="col-sm-1 control-label">Location</label>
        <div class="col-sm-10">
            <select name="location" id="location" data-placeholder="Choose a Location..." class="chosen-select" style="width:250px;" tabindex="2">
                <?php echo $comboLoc?>
            </select>
        </div>
        <br>
    </div>
    <div class="form-group">
        <label for="userfile" class="col-sm-1 control-label">Upload</label>
        <div class="col-sm-10">
            <div id="logo" class="image" >
                <img id="picturebox" height="100" alt="Your Image" />
            </div>
            <span class="btn btn-success fileinput-button">
                <span>Select File...</span>
                <input type="file" id="userfile" name="userfile" accept="image/*" />
            </span>
            <input type="hidden" id="Picture" name="Picture" readonly="readonly" />
        </div>
        <br><br><br><br>
    </div><br><br><br>
    <div class="modal-footer">
        <button type="button" id="btnSave" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>

<!-- <script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script>  -->
<script type="text/javascript">
var jqXHRData;
var isFile = false;
//End choosen properties      
var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"90%"}
      }
      // $('.chosen-select').chosen({width: '100%'});
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
//End choosen properties
$(document).ready(function() {
    $("#userfile").on('change', function() {
        $("#Picture").val(this.files[0].name);
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

    $('#userfile').fileupload({
        url: "<?php echo base_url('c_nup_loc/save');?>",
        dataType: 'json',
        add: function (e, data) {
            jqXHRData = data
            // alert('11');
            isFile = true;
        },
        done: function (event, response) {
            var res = response.result;
            BootstrapDialog.alert(res.pesan);
            // $('[data-id=' + id + ']').remove();
            $('#modal').modal('hide');
            table.ajax.reload(null,true); 
        },
        fail: function (event, response) {
            BootstrapDialog.alert(response.result.pesan);
        }
    });
    $('#btnSave').click(function(){
        if($('#fNuploc').valid()){
            // alert('opsi1');
            var id = $('#modal').data('id');
            var datafrm = $('#fNuploc').serializeArray();
            datafrm.push({name:"id",value:id});
            var obj = new Object();
            obj.id = id;
            obj.isFile = isFile;
            if(isFile) {
                if(jqXHRData){
                    jqXHRData.formData = datafrm;
                    jqXHRData.submit();
                }
                // console.log('opsi1');
            } else {
                // console.log('opsi2');
                $.ajax({
                    url : "<?php echo base_url('c_nup_loc/save');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: $('#fNuploc').serialize(),
                    dataType:"json",
                    success:function(data, status){
                        BootstrapDialog.alert(data.pesan);
                        console.log(data);
                        $('#modal').modal('hide');
                        table.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                        BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                    }
                });
            }       
        }
    });
});
</script>