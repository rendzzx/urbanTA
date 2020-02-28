<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css')?>" rel="stylesheet">

<link href="<?=base_url('css/plugins/iCheck/custom.css')?>" rel="stylesheet">
 <style type="text/css">

.error{
    color:red;
    margin-top: 10px!important;
    margin-left: 5px;
}

</style>

<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <br><br>
           <h3 class="content-header-title">Survey Detail</h3>
        </div>

     </div>
        <div class="content-body">
             <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_AN" method="POST">
             <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">      
                             <?php echo $Survey; ?> 
                             </div>
                            </div>
                        </div>
                    </div>
                </div>
             <div class="col-12">
                <div class="box-footer pull-right">
                    <input type="button" name="btnSave" id="btnSave" value="Submit" class="btn btn-primary">
                    <a href="<?php echo base_url('c_survey/index')?>" class="btn grey btn-secondary">Back</a>
                </div>
             </div> 
             </form>      
        </div>
                       
    </div>       
        
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/iCheck/icheck.min.js')?>"></script>
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
<script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
                $('input#txtRespon').each(function() {
                    $(this).rules("add", 
                        {
                            messages: { required: "<br>Please choose an answer."}
                        });
                });
                // $("#txtRespon").rules("add", { messages: { required: "<br>Please choose an answer."}});
            });
        </script>

    <script type="text/javascript">
             $('#form_AN').validate({
      ignore: "",
      rules: {
        txtRespon: { required: true},
        // txtPublish: {required: true},
        // txtExpired: {required: true},
        // txtsubject: {required: true},
      },
      messages: {
                txtRespon: { required: "<br>Please choose an answer."},
               
              },
      errorElement: "span",
      highlight: function (element, errorClass, validClass) {
          $(element).addClass(errorClass); //.removeClass(errorClass);
          $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass(errorClass); //.addClass(validClass);
          $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            console.log(element.parent().hasClass('iradio_square-green'));
           console.log(element.parent().parent().parent());
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          } else if (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
            error.insertAfter(element.next('span'));
          }else if (element.parent().hasClass('iradio_square-green')) {
            error.appendTo(element.parent().parent().parent());
          } else {
            error.insertAfter(element);
            console.log('133311');
          }
        }

    });
        $('#btnSave').click(function() {

            if ($("#form_AN").valid()) {
            // alert('test');return;
            var datafrm = $('#form_AN').serializeArray();
            block(true,'.card-body');
            var state = document.readyState
            console.log(state);
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                },1000);
            }
            $.ajax({
                url: "<?php echo base_url('c_survey/save');?>",
                type: "POST",
                data: datafrm,
                dataType: "json",
                success: function(data, status) {

                    // console.log(data);
                    // console.log(status);

                    if (data.status == 'OK') {
                        block(false,'.card-body');
                        swal({
                                title: "Information",
                                animation: false,
                                type: "success",
                                text: data.pesan,
                                confirmButtonText: "OK"
                            });
                        window.location.href="<?php echo base_url('c_survey/index')?>";
                    } else {
                        swal({
                                title: "Information",
                                animation: false,
                                type: "error",
                                text: data.pesan,
                                confirmButtonText: "OK"
                            },
                            function() {
                                // tblsurvey.ajax.reload(null,true); 
                                // $('#modal').modal('hide');
                            });
                        block(true,'.card-body');
                    }

                    // alert(event.Pesan);

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                }
            });

        }

        });
         function block(boelan,div){
        var block_ele = $(div);
        if (boelan==true) {
            $(block_ele).block({
                message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                fadeIn: 1000,
                fadeOut: 1000,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    backgroundColor: '#333',
                    marginLeft : 'auto'
                }
            });
        }
        else{
            $(block_ele).unblock()
        }
    }
    </script>