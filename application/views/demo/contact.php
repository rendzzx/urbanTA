
<!-- daterange picker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/daterangepicker/daterangepicker-bs3.css')?>">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" >
<!-- Bootstrap time Picker -->
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>"></script>
<!-- <script src="<?=base_url('js/jquery-2.1.1.js')?>"></script> -->

<style type="text/css">
.has-error .select2_demo_1-selection {
    border: 2px solid #a94442;
    border-radius: 4px;
} 
  .btn-dor {
    background-color: #7c7c7c;
    border-color: #7c7c7c;
    color: #FFFFFF;
  }
  .btn-dor:hover {
      background-color: #9e9e9e;
      border-color: #9e9e9e;
      color: #FFFFFF;
  }
</style>
<div id="loader" class="loader" hidden="false"></div>
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body" style="opacity: 1;">
            <div class="form-group">
                <label class="col-sm-1" id="lblnpwp" name="lblnpwp" align="right"><FONT SIZE="5px" color="gray"><i class="fa fa-user"></i></FONT></label>                
                <div class="col-sm-11">
                   <input type="text" class="form-control" name="first" id="first" placeholder="Your Name">
                </div>
                
            </div>
 
            <div class="form-group">
                <label class="col-sm-1" id="lblnpwp" name="lblnpwp" align="right"><FONT SIZE="5px" color="gray"><i class="fa fa-envelope"></i></FONT></label>                
                <div class="col-sm-11">
                   <input type="text" class="form-control" name="email" id="email" placeholder="Your E-mail">
                </div>
            </div>       
            <div class="form-group">
                <label class="col-sm-1" id="lblnpwp" name="lblnpwp" align="right"><FONT SIZE="5px" color="gray"><i class="fa fa-phone"></i></FONT></label>               
                <div class="col-sm-11">
                   <input type="text" class="form-control" name="hp" id="hp" placeholder="Your Handphone">
                </div>
            </div>       
            <div class="form-group">
                <label class="col-sm-1" id="lblnpwp" name="lblnpwp" align="right"><FONT SIZE="5px" color="gray"><i class="fa fa-pencil-square-o"></i></FONT></label>               
                <div class="col-sm-11">
                   <textarea class="form-control" name="message" id="message" placeholder="Your Message"></textarea> 
                </div>
            </div>
            <div class="form-group" > 
            <label class="col-sm-1" id="lblnpwp" name="lblnpwp" align="right"><FONT SIZE="5px" color="white"></label>               
                <div class="col-sm-11">
                <div style="color:red;" name="g-recaptcha-response" ></div>
                <div class="g-recaptcha" data-sitekey="<?php echo $sitekey?>"></div>
                </div>
            </div>
        </div>                  
    </form>



<!-- Select2 -->
<link href="<?=base_url('css/plugins/sweetalert/sweetalert.css')?>" rel="stylesheet"> 
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<script type="text/javascript" src="<?=base_url('js/plugins/sweetalert/sweetalert.min.js')?>"></script>
<!-- date-range-picker -->
<script src="<?=base_url('js/plugins/fullcalendar/moment.min.js')?>"></script>
<script src="<?=base_url('js/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>


            

<script type="text/javascript">
var nup_id = $('#modal').data('nup_id');

  $(document).ready(function () {

     $("#contact").validate({
            ignore:"",
            rules: {
                name: {
                    required: true
                },

                email:{
                    required:true,
                    email:true
                },
                message:{
                  required:true
                  // date:true
                }
            },

            errorPlacement: function(error, element)
            {

              if (element.parent('.input-group').length) && (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')){
                  error.insertAfter(element.parent());
                  error.insertAfter(element.next('span'));
              // } else if (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
              //     error.insertAfter(element.next('span'));
              } else {
                  error.insertAfter(element);
              } //CSS NYA ADA DI ATAS .HAS-ERROR

            }
        });
    $('#btnSave').click(function(){

      if($('#frmEditor').valid()){
        // document.getElementById("btnSave").disabled = true;
        document.getElementById('loader').hidden=false;
        var response = grecaptcha.getResponse();

        if(response.length == 0)
        {
            swal('Warning','Captcha is invalid','error');
        } else {
          var nup_id = $('#modal').data('nup_id');
          var datafrm = $('#frmEditor').serializeArray();

          // alert('dor');
            $.ajax({
              url : "<?php echo base_url('demo/save_message');?>",
                type:"POST",

                data: datafrm,
                dataType:"json",
                success:function(event, data){
                  document.getElementById('loader').hidden=true;

                  if(data=='success'){
                    swal({
                      title: "Information",
                      animation: false,
                      type:"success",
                      text: event.Pesan+' Thank you!',
                      confirmButtonText: "OK"
                    });
                  
                    $('#modal').modal('hide');
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
                  document.getElementById('loader').hidden=true;
    
                  swal({
                      title: "Information",
                      animation: false,
                      type:"success",
                      text: textStatus+' Save : '+errorThrown,
                      confirmButtonText: "OK"
                    });
                }
            });                
         }//captcha valid
      }//form valid
    });
  });


    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>
       