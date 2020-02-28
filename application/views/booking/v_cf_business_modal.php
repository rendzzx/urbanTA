<link href="<?=base_url('plugins/datepicker/datepicker3.css')?>" rel="stylesheet" />
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" /> 
<form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_rl_sales/Edit_Customer" enctype="multipart/form-data">
     <div class="row">
        <!-- <div class="col-md-6" style="width:60%"> -->
            <div class="box-body">
                <div class="form-group">
                    <label for="ic_no" class="col-xs-2 control-label">ID No</label>
                    <div class="col-xs-8">
                        <!-- @Html.TextBoxFor(m => m.UserCode, new { @class = "form-control"}) -->
                        <input type="text" class="form-control" name="ic_no" id="ic_no">
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-xs-2 control-label">Category</label>
                    <div class="col-xs-8">
                        <div class="radio">
                            <label>
                                <input id='C' name='category' class="control-form" type='radio' value="C" checked/> Company
                            </label>
                            
                            <label>
                                <input id='I' name='category' class="control-form" type='radio' value="I" /> Individu
                            </label>
                            
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Name" class="col-xs-2 control-label">Name</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="Name" id="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="Address" class="col-xs-2 control-label">Address</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="address1" id="address1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address2" class="col-xs-2 control-label"></label>
                    <div class="col-xs-8">
                        <input type="text" name="address2" id="address2" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="address3" class="col-xs-2 control-label"></label>
                    <div class="col-sm-3">
                        <input type="text" name="address3" id="address3" class="form-control">
                    </div>
                    <label for="post_cd" class="col-xs-2 control-label" >Post cd</label>
                    <div class="col-sm-3">
                        <input type="text" name="post_cd" id="post_cd" class="form-control">
                    </div>
                </div>        
                <div class="form-group">
                    <label for="contact_person" class="col-xs-2 control-label">H/Phone</label>
                    <div class="col-xs-8">
                    <input type="text" name="hand_phone" id="hand_phone" class="form-control">
                    </div>
                </div>       
                <div class="form-group">
                    <label for="contact_person" class="col-xs-2 control-label">Tel</label>
                    <div class="col-xs-3">
                    <input type="text" name="tel_no" id="tel_no" class="form-control">
                    </div>
                    <label for="contact_person" class="col-xs-2 control-label">Fax</label>
                    <div class="col-xs-3">
                    <input type="text" name="fax_no" id="fax_no" class="form-control">
                    </div>
                </div>                
                <div class="form-group">
                    <label for="contact_person" class="col-xs-2 control-label">E-mail</label>
                    <div class="col-xs-8">
                    <input type="text" name="email_addr" id="email_addr" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_person" class="col-xs-2 control-label">NPWP</label>
                    <div class="col-xs-8">
                    <input type="text" name="income_tax" id="income_tax" class="form-control">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="contact_person" class="col-xs-2 control-label">Contact Person</label>
                    <div class="col-xs-8">
                    <input type="text" name="contact_person" id="contact_person" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_person" class="col-xs-2 control-label">Position</label>
                    <div class="col-xs-8">
                    <input type="text" name="designation" id="designation" class="form-control">
                    </div>
                </div>
            </div>
        <!-- </div> -->
        <!-- <div class="col-md-6" style="width:40%" id="panel2" hidden="hidden"> -->
            <div class="box-body" id="panel2" hidden="hidden">
               <div class="form-group">
                    <label for="sex" class="col-xs-2 control-label">Gender</label>
                    <div class="col-xs-8">
                        <div class="radio">
                            <label>
                                <input id='M' name='sex' type='radio' value="M" checked/>Male 
                            </label>
                            <label>
                                <input id='F' name='sex' type='radio' value="F" />Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                      <label class="col-xs-2 control-label">DOB</label>
                        <div class="col-xs-8">
                            <div class="input-group">                            
                            <input id="birth_date" name="birth_date" class="form-control" type="text" placeholder="dd/MM/yyyy">
                            <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">Religion</label>
                    <div class="col-sm-8">
                       <!--  <select name="religion_cd" class="form-control chosen-select" id="religion_cd" tabindex="2" data-placeholder="Select Religion">
                            <?php foreach($religion as $row){   echo '<option value="'.$row->religion_cd.'">'.$row->descs.'</option>'; }?>
                        </select> -->
                        <select name="religion_cd" class="form-control chosen-select" id="religion_cd" tabindex="2" data-placeholder="Select Customer"><?php echo $religion; ?></select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-2 control-label">Nationality</label>
                    <div class="col-sm-8">
                        <select name="nationality" class="form-control chosen-select" id="nationality" tabindex="2" data-placeholder="Select Nationality"><?php echo $nationality; ?></select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact_person" class="col-xs-2 control-label">Married</label>
                    <div class="col-xs-8">
                        <div class="radio">
                            <label>
                                <input id='Y' name='marital_status' type='radio' value="Y" checked/>Yes
                            </label>
                            <label>
                                <input id='N' name='marital_status' type='radio' value="N" />No
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
     <!-- Modal Footer -->
    <div class="modal-footer">
        <button type="button" id="btnSave" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
    </div>                 
</form>
<script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('plugins/datepicker/bootstrap-datepicker.js')?>"></script>    
<script src="<?=base_url('plugins/input-mask/jquery.inputmask.bundle.min.js')?>"></script> 
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>

 <script type="text/javascript">
    var config = {
      // '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    $("#religion_cd").chosen({ width: '100%'});
    $("#nationality").chosen({ width: '100%'});
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    </script>


<script type="text/javascript">
  $(document).ready(function () {
    loaddata();
var isFile=false;
var jqXHRData;
//checked Categori
 if (document.getElementById('C').checked) { 
        $("#panel2").hide(900);
        
} else {
        $("#panel2").show(900);

}

$('input[type="radio"]').on('click change',function(e){
    if (document.getElementById('C').checked) { 
        $("#panel2").hide(900);
    } else { 
        $("#panel2").show(900);        
    }
});
//END checked Categori
$("#hand_phone").inputmask("Regex", { regex: "[0-9----,-. ]+$" });
$('#birth_date').datepicker({
    format: 'dd/mm/yyyy',
      autoclose: true
    });
  
 $("#frmEditor").validate({

            rules: {
                ic_no: {
                    required: true//,
                    // maxlength: 20,
                    
                },
                Name:{
                    required: true//,
                },
                address1:{
                    required: true//,
                },
                hand_phone:{
                    required: true//,
                },
                email_addr:{
                  required: true,
                  email:true  
                },
                post_cd:{
                    maxlength:5
                },
                birth_date:{
                    required:true
                }

            },
            messages: {birth_date: {DOB: "This field is required"} },
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block text-red");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents(".col-xs-5").addClass("has-feedback text-red");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!element.next("span")[0]) {
                    $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 95%' ></span>").insertAfter(element);
                }
            },
            success: function (label, element) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!$(element).next("span")[0]) {
                    $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 95%'></span>").insertAfter($(element));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
            }
        });



    $('#btnSave').click(function(){
      if($('#frmEditor').valid()){
                var bussines_id = $('#modal').data('id');
                var obj = new Object();
                obj.id = bussines_id;
                  // BootstrapDialog.alert(bussines_id);
                   
                    $.ajax({
                    url : "<?php echo base_url('c_cf_business/saveEdit');?>",
                    type:"POST",
                    data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    dataType:"json",
                    success:function(event, data){
                        // BootstrapDialog.alert(event.Pesan);
                        // BootstrapDialog.alert(event.id);
                        setcustomer(event.id);
                        $('#customer').val(event.id);
                        

                        BootstrapDialog.alert({
                                title: 'WARNING',
                                message: event.Pesan,
                                type: BootstrapDialog.TYPE_INFORMATION, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
                                closable: true,
                                buttonLabel: 'OK', 
                                callback:function(Result){
                                    $('[data-id=' + bussines_id + ']').remove();
                                    $('#modal').modal('hide');

                                }
                        });
                        // tblnewsfee  d.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                     
                    }
            });
                     
      }




    });

    function setcustomer(bussId){
        
        var site_url = '<?php echo base_url("c_rl_sales/zoom_nama_from")?>';
            $.post(site_url,
              {bussId:bussId},
              function(data,status) {
                $("#customer").empty();
                $("#customer").append(data);
                $("#customer").trigger('chosen:updated');
              }
            );
    }
    function setnationality(Id){
        
        var site_url = '<?php echo base_url("c_cf_business/zomm_nationality_from")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#nationality").empty();
                $("#nationality").append(data);
                $("#nationality").trigger('chosen:updated');
              }
            );
    }
    function setregion(Id){
        
        var site_url = '<?php echo base_url("c_cf_business/zomm_religion_from")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#religion_cd").empty();
                $("#religion_cd").append(data);
                $("#religion_cd").trigger('chosen:updated');
              }
            );
    }
    function loaddata(){
         var id = $('#modal').data('id');
         
             
        if (id != 0) {
            
            $.getJSON("<?php echo base_url('c_cf_business/getByID');?>" + "/" + id, function (data) {
                //var tes = JSON.parse(data);
                // BootstrapDialog.alert(data[0].youtube_link);
                $('#ic_no').val(data[0].ic_no);
                // $('#category ').val(data[0].category);//cb
                var category = data[0].category;
                document.getElementById(category).checked = true;
                if(category=='I'){
                    $("#panel2").show();

                 }
                 
                $('#Name').val(data[0].name);
                $('#address1').val(data[0].address1);
                $('#address2').val(data[0].address2);
                $('#address3').val(data[0].address3);
                $('#post_cd ').val(data[0].post_cd);
                $('#hand_phone').val(data[0].hand_phone);
                $('#tel_no').val(data[0].tel_no);
                $('#fax_no').val(data[0].fax_no);
                $('#email_addr').val(data[0].email_addr);
                $('#income_tax ').val(data[0].income_tax);
                $('#contact_person').val(data[0].contact_person);
                $('#designation').val(data[0].designation);
                // $('#sex').val(data[0].sex);//cb
                var sex = data[0].sex;
                document.getElementById(sex).checked = true;
                // $('#birth_date').val(data[0].birth_date);
                // $('#religion_cd ').val(data[0].religion_cd);
                // $('#nationality').val(data[0].nationality);
                setregion(data[0].religion_cd);
                setnationality(data[0].nationality);
                $('#marital_status').val(data[0].marital_status);  //cb     
                var st = data[0].marital_status;
                document.getElementById(st).checked = true;  
                var bb = data[0].birth_date;
                var year =bb.substr(0,4);
                var month=bb.substr(5,2);
                var day =bb.substr(8,2);
                var aa = day+"/"+month+"/"+year;
                $('#birth_date').val(aa);
                 

               
            });
        }
    }
  
  });

 
    $('#modal').one('hidden.bs.modal', function (e) {
        $('#modal').removeData('bs.modal');
        $(".modal-body").html("");
        // $('[data-id=' + bussines_id + ']').remove();
    });
</script>                