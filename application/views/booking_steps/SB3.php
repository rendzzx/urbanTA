<style type="text/css">
    .loader{
      width:80%;
      height:100%;
      position:fixed;
      z-index:9999;
      background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center     
    }  
  </style> 
<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>" type="text/javascript"></script>


<div class="content-wrapper">
<div id="loader" class="loader" hidden="true"></div>
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-left"><b><?php echo $projectName; ?></b></div>
            <div class="tittle-top pull-right"><b>Booking</b></div>
        </div>
    </div>
    <div class="wrapper wrapper-content" >
      <div id="loader" class="loader" hidden="false"></div>
        <div class="row">
            <div class="col-xs-12">
            <!-- next start -->
                <div class="ibox-content">
                <form class="wizard-big wizard clearfix" role="application" id="form">
                <div class="steps clearfix">
                    <ul role="tablist">
                      <li class="first done" role="tab" aria-disabled="false" aria-selected="false">
                        <a id="form-t-0" href="#form-h0" aria-controls="form-p-0">
                          <span class="current-info audible">current step: </span>
                          <span class="number">1. </span>
                          Choose Property
                        </a>
                      </li>
                      <li class="done" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">2. </span>
                          Choose Unit
                        </a>
                      </li>
                      <li class="current" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h2" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">3. </span>
                          Input Customer Information
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h3" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">4. </span>
                          Input Payment Plan + Disc
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h4" aria-controls="form-p-1">
                          <span class="current-info audible">current step: </span>
                          <span class="number">5. </span>
                          Finish
                        </a>
                      </li>
                    </ul>
                  </div>
                  </form>
                        <div class=""><br>
                  <div class="content" >
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title">Add Customer</h3>
                      </div>
                      <div class="panel-body">
                        <form name="frmEditor" id="frmEditor" class="form-horizontal" method="post" action="#">
                        <div class="row">
                          <!-- <div class="col-md-6" style="width:60%"> -->
                              <div class="box-body">
                                  
                                  <div class="form-group" hidden="hidden">
                                      <label for="category" class="col-xs-2 control-label">Category</label>
                                      <div class="col-xs-8">
                                          <div class="radio">
                                              <label>
                                                  <input id='C' name='category' class="control-form" type='radio' value="C" /> Company
                                              </label>
                                              
                                              <label>
                                                  <input id='I' name='category' class="control-form" type='radio' value="I" checked/> Individu
                                              </label>
                                              
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="Name" class="col-xs-2 control-label">Name <FONT COLOR="RED">*</FONT></label>
                                      <div class="col-xs-8">
                                          <input type="text" class="form-control" name="Name" id="Name">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="Address" class="col-xs-2 control-label">Address <FONT COLOR="RED">*</FONT></label>
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
                                      <div class="col-xs-3">
                                          <input type="text" name="address3" id="address3" class="form-control">
                                      </div>
                                      <label for="post_cd" class="col-xs-2 control-label" >Post cd</label>
                                      <div class="col-xs-3">
                                          <input type="text" name="post_cd" id="post_cd" class="form-control">
                                      </div>
                                  </div>        
                                  <div class="form-group">
                                      <label for="contact_person" class="col-xs-2 control-label">H/Phone <FONT COLOR="RED">*</FONT></label>
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
                                      <label for="contact_person" class="col-xs-2 control-label">E-mail <FONT COLOR="RED">*</FONT></label>
                                      <div class="col-xs-8">
                                      <input type="text" name="email_addr" id="email_addr" class="form-control">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="ic_no" class="col-xs-2 control-label">ID No <FONT COLOR="RED">*</FONT></label>
                                      <div class="col-xs-8">
                                          <!-- @Html.TextBoxFor(m => m.UserCode, new { @class = "form-control"}) -->
                                          <input type="text" class="form-control" name="ic_no" id="ic_no">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label for="contact_person" class="col-xs-2 control-label">NPWP <FONT COLOR="RED">*</FONT></label>
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
                                      <label for="sex" class="col-xs-2 control-label">Gender <FONT COLOR="RED">*</FONT></label>
                                      <div class="col-xs-8">
                                          <div class="radio">
                                              <label>
                                                  <input id='M' name='sex' type='radio' value="M"/>Male 
                                              </label>
                                              <label>
                                                  <input id='F' name='sex' type='radio' value="F" />Female
                                              </label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="col-xs-2 control-label">DOB <FONT COLOR="RED">*</FONT></label>
                                          <div class="col-xs-8">
                                              <div class="input-group">                            
                                              <input id="birth_date" name="birth_date" class="form-control" type="text" placeholder="dd/mm/yyyy">
                                              <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                  </div>
                                              
                                              </div>
                                          </div>
                                      </div>
                                  <div class="form-group">
                                      <label class="col-xs-2 control-label">Religion</label>
                                      <div class="col-xs-8">
                                        
                                          <select name="religion_cd" class="form-control select2_demo_1" id="religion_cd" tabindex="2" data-placeholder="Select Religion"><?php echo $religion; ?></select>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="col-xs-2 control-label">Nationality</label>
                                      <div class="col-xs-8">
                                          <select name="nationality" class="form-control select2_demo_1" id="nationality" tabindex="2" data-placeholder="Select Nationality"><?php echo $nationality; ?></select>
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
                      <!-- <div class="modal-footer">
                          <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                      </div>  -->
                            <div class="box-footer col-xs-12">
                              <!-- <div class="form-group"> -->
                                <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-primary">
                                <input type="button" name="btnNext" id="btnNext" value="Next" class="btn btn-primary">              
                                <!-- <input type="button" name="btntes" id="btntes" value="Tes" class="btn btn-primary"> -->
                              <!-- </div> -->
                            </div>
                        </form>     
                      
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>           



      

<script type="text/javascript">
loaddata();
$(document).ready(function(){
   $("#income_tax").inputmask({
                      mask: "99.999.999.9-999.999"
                    });
   // $("#ic_no").inputmask({
   //                    mask: "9999999999999999"
   //                  });
   // $("#birth_date").inputmask({
   //                    mask: "99/99/9999"
   //                  });
  $('#birth_date').datepicker({
        startView: 2,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true//,
        // format: 'dd/mm/yyyy'
  });
  

});
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
      $(".select2_demo_1").select2({
        width:"100%"
      });

$.validator.addMethod("check_noktp", function (value, element) {
    var isSuccess = false;
    var ktp = $('#ic_no').val();

    if (ktp.length == 0) {
        isSuccess=true;
    }else if(ktp.length > 16 || ktp.length < 16  ){

    }else{
        isSuccess=true;
    }
    return isSuccess;
  });


$.validator.addMethod("birth_date", function (value, element){
  var isSuccess = false;
  var selectDate = $('#birth_date').val();
  var yearSdate = selectDate.substring(6, 10);
  var monthSdate = selectDate.substring(3, 5);
  var daySdate = selectDate.substring(0, 2);
  
  var Sdate = yearSdate + monthSdate + daySdate

  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();

  if(dd<10){
      dd='0'+dd;
  } 
  if(mm<10){
      mm='0'+mm;
  }

  var todayDate = dd.toString();
  var todayMonth = mm.toString();
  var todayYear = yyyy.toString();

  var today1 = todayYear + todayDate + todayMonth;

  if(Sdate > today1){

  }else{
    isSuccess=true;
  }
  return isSuccess;

});
     $("#frmEditor").validate({

            rules: {
                ic_no: {
                    required: true,
                    check_noktp:true
                    // maxlength: 20,
                    
                },
                Name:{
                    required: true//,
                },
                address1:{
                    required: true//,
                },
                hand_phone:{
                    required: true,
                    number:true
                },
                email_addr:{
                  required: true,
                  email:true  
                },
                post_cd:{
                    maxlength:5
                },
                birth_date:{
                    required:true,
                    birth_date:true
                },
                income_tax:{
                    required:true
                },
                sex: {
                  required:true
                }

            },
            messages: {
                        birth_date: {DOB: "This field is required"},
                        birth_date: {birth_date: "Date is not valid"},
                        ic_no:{check_noktp: "ID No is not valid"}
                      },
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
     $('#btnNext').click(function(){

       if($('#frmEditor').valid()){
        document.getElementById('loader').hidden=false;
                  var bussines_id = '<?php echo $business_id;?>';
                  if(bussines_id=='null'){
                    bussines_id=0;
                  }
                  // return;
                  var unit_book = '<?php echo $unit_book;?>';
                  var obj = new Object();
                  obj.id = bussines_id;
                  obj.unit_book =  unit_book;
                  var form = $('#frmEditor').serialize() + '&' + $.param(obj) ;
                  console.log(form); 
                  $.ajax({
                      url : "<?php echo base_url('c_cf_business/SaveFromStep');?>",
                      type:"POST",
                      data: $('#frmEditor').serialize() + '&' + $.param(obj),
                      dataType:"json",
                      success:function(event, data){
                        document.getElementById('loader').hidden=true;
                          // console.log(event);
                          // console.log(data);
                          // return;
                        swal({
                        title: "Information",
                        text: event.Pesan,
                        type: "success",
                        confirmButtonText: "OK"
                        },
                        function(){
                          document.getElementById('loader').hidden=false;
                          var a= '<?php echo $product_type;?>';
                          window.location.href="<?php echo base_url('c_stepbooking/add_payment');?>"+"/"+event.id+"/"+a;

                        });

                      },                    
                      error: function(jqXHR, textStatus, errorThrown){
                        document.getElementById('loader').hidden=true;
                       swal("Error",textStatus+' Save : '+errorThrown,"error");
                       
                      }
              });
                       
        }
      // }

     });

     $('#btnback').click(function(){
        var a = '<?php echo $property_cd;?>';
        var type = '<?php echo $product_type;?>';

        window.location.href = "<?php echo base_url('c_stepbooking/index')?>"+'/'+type+'/'+a;
     });
     $('#btntes').click(function(){
      var tt = 'esss';
      var site_url = "<?php echo base_url('c_stepbooking/tes')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: {tt:tt},
          dataType: "json",
          success: function(data, status){
            BootstrapDialog.alert(data.Pesan, function(result){
            });

            
          },
          error: function(jqXHR, textStatus, errorThrown){
            BootstrapDialog.alert(textStatus+' Save : '+jqXHR.responseText);
          }
        })
     });
     function loaddata(){
      var id = '<?php echo $business_id;?>';
      // alert(id);
      
      if (id != 'null') {
        if(id != 0){                    
            $.getJSON("<?php echo base_url('c_cf_business/getByID');?>" + "/" + id, function (data) {
               
                $('#ic_no').val(data[0].ic_no);
                
                var category = data[0].category;
                document.getElementById(category).checked = true;
                if(category=='I'){
                    $("#panel2").show();
                    var sex = data[0].sex;                
                    var st = data[0].marital_status;
                     document.getElementById(sex).checked = true;
                     // console.log(data[0].religion_cd);
                     // console.log(data[0].nationality);
                    setregion(data[0].religion_cd);
                    setnationality(data[0].nationality);
                    $('#marital_status').val(data[0].marital_status); 

                document.getElementById(st).checked = true;  
                var bb = data[0].birth_date;
                var year =bb.substr(0,4);
                var month=bb.substr(5,2);
                var day =bb.substr(8,2);
                var aa = day+"/"+month+"/"+year;
                $('#birth_date').val(aa); 

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
                
                
                 

               
            });
          }
        }
     }
     function setregion(Id){
        
        var site_url = '<?php echo base_url("c_cf_business/zomm_religion_from")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#religion_cd").empty();
                $("#religion_cd").append(data);
                $("#religion_cd").trigger('change');
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
                $("#nationality").trigger('change');
              }
            );
    }
</script>
    