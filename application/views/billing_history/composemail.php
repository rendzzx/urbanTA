


        <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_newsfeed/save_newsfeed" enctype="multipart/form-data">
                 <div class="box-body">

                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2" style="text-align: right">To </label>
                     <div class="col-xs-9">
                       <input type="text" class="form-control" name="email" id="email" placeholder="Email"><!-- <font size="1px"><i>Input ; to separate receiver's emails.</i></font> -->
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2" style="text-align: right">Subject </label>
                     <div class="col-xs-9">
                       <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="subjectnewsfeed" class="col-xs-2" style="text-align: right">Attachment </label>
                     <div class="col-xs-9">
                     <img src="<?php echo base_url('img/pdflogo.png')?>" height="30px">&nbsp;Report.pdf
                       <input type="hidden" class="form-control" name="attach" id="attach" value="<?php echo base_url('pdf/SOA/Report.pdf')?>">
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="contentnewsfeed" class="col-xs-2" style="text-align: right">Message </label>
                     <div class="col-xs-9">
                      
                        <textarea class="form-control" name="msg" id="msg" placeholder="Message" style="height: 100px" ></textarea>
                     </div>
                    </div>
        
                  </div>

                 <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary"><i class="fa fa-reply"></i> Send</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
                </form>


<script type="text/javascript">
     $(document).ready(function () {


 $("#frmEditor").validate({
            rules: {
                email: {
                    required:true,
                    email: true
                },
                subject: {
                    required: true
                },
                // msg: {
                //     required: true
                // },

            },
            // errorElement: "em",
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
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          } else if (element.hasClass('select2')) {
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
           
        });


    $('#btnSave').click(function(){
      if($('#frmEditor').valid()){
                var debtor = $('#modal').data('debtor');
                var project = $('#modal').data('project');
                var entity = $('#modal').data('entity');
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push({name:"debtor",value:debtor},{name:"project",value:project},{name:"entity",value:entity});
               

             
                   
                    $.ajax({
                    url : "<?php echo base_url('c_soa/sendmail');?>",
                    type:"POST",
                    data: datafrm ,
                    dataType:"json",
                    success:function(event, data){
                        // console.log('2');

                        if(event.Status=='OK'){

                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
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
                          swal({
                            title: "Error",
                            animation: false,
                            type:"error",
                            text: textStatus+' Save : '+errorThrown,
                            confirmButtonText: "OK"
                          });
                     
                    }
                    });
                }       
            });
    });
</script>