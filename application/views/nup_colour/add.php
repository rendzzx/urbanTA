<link href="<?=base_url('css/plugins/colorpicker/bootstrap-colorpicker.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/jasny/jasny-bootstrap.min.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/colorpicker/bootstrap-colorpicker.min.js')?>"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>  

 <style> 
  .colorpicker-2x .colorpicker-saturation { 
          width: 200px; 
          height: 200px; 
          } 
  .colorpicker-2x .colorpicker-hue, .colorpicker-2x .colorpicker-alpha { 
          width: 30px; 
          height: 200px; 
        } 
  .colorpicker-2x .colorpicker-color, .colorpicker-2x .colorpicker-color div { 
        height: 30px; 
        } 
  </style>

        <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_nup_colour/save_colour" enctype="multipart/form-data">
                 <div class="box-body">
                    <div class="form-group">
                     <label for="contentnewsfeed" class="col-xs-3 control-label">No. </label>
                     <div class="col-xs-4">
                        <input type="text" class="form-control" name="nomer" id="nomer">
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="contentnewsfeed" class="col-xs-3 control-label">Initial Colour </label>
                     <div class="col-xs-4">
                        <div id="cp1" class="input-group colorpicker-component"> <input type="text" id="initial" name="initial" value="#00AABB" class="form-control col-xs-3" /> <span class="input-group-addon"><i style="width:100px;"></i></span> </div>
                     </div>
                    </div>
                    <div class="form-group">
                     <label for="youtubenewsfeed" class="col-xs-3 control-label">After Choose Colour </label>
                     <div class="col-xs-4">
                       <div id="cp2" class="input-group colorpicker-component"> <input type="text" id="after" name="after" value="#00AABB" class="form-control col-xs-3" /> <span class="input-group-addon"><i style="width:100px;"></i></span> </div>
                     </div>
                    </div>
                    
                  
                  </div>
                   
                
                    </div>
                 </div><!-- /.box-body -->
                 <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                </div>
                </form>
<script type="text/javascript">
var countnumber;
   $(function() {
      
      var site_url = '<?php echo base_url("c_nup_colour/countnumber")?>';
             $.post(site_url,
             {Id:'pro'},
             function(data,status) {
                  countnumber = data;
                  
                  $('#nomer').val(countnumber);
                   
                   }
            );
    // var id = $('#modal').data('nomer');
    // // alert(countnumber);
    // console.log(countnumber);
    loaddata();
    $('#cp1').colorpicker(); 
    $('#cp2').colorpicker(); 
    




 $("#frmEditor").validate({
            rules: {
                initial: {
                    required: true
                },
                after: {
                    required: true
                }
                

            },
            
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block  text-red");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents(".col-xs-5").addClass("has-feedback  text-red");

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
                var id = $('#modal').data('id');
                console.log(id);
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push({name:"id",value:id});
                var obj = new Object();
                obj.id = id;


                
                  console.log(datafrm);
                   
                    $.ajax({
                    url : "<?php echo base_url('c_nup_colour/save_colour');?>",
                    type:"POST",
                    data: $('#frmEditor').serialize()+ '&' + $.param(obj),
                    dataType:"json",
                    success:function(event, data){
                        console.log(event);
                        if(event.status=='OK'){
                          swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: event.Pesan,
                            confirmButtonText: "OK"
                          });
                          $('#modal').modal('hide');
                          tblcolour.ajax.reload(null,true);
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

function loaddata(){
    var id = $('#modal').data('id');
        ScreenID = id;
        var value1=$('#initial').val();
        var value2=$('#after').val();
        if (id >= 0) {
            $.getJSON("<?php echo base_url('c_nup_colour/getByID');?>" + "/" + id, function (data) {
                
                $('#nomer').val(data[0].counter_id);
                $('#initial').val(data[0].initial_colour);
                $('#cp1').colorpicker('setValue',data[0].initial_colour);
                $('#after').val(data[0].after_choose_colour);
                $('#cp2').colorpicker('setValue',data[0].after_choose_colour);
                
                

            });
        }

}
</script>