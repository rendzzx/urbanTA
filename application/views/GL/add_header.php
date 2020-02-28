
<style type="text/css">
  .has-error .select2_demo_1-selected {
      border: 1px solid #a94442;
      border-radius: 4px;
      color: red;
    }

    .has-error .checkbox-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }

    .has-error .radio-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
    label {text-align: right;}
</style>


<script type="text/javascript">
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
  $("#frmEditor").validate({
            rules: {
                txt_descs: {
                    required: true
                },
                txt_rowID:{
                  required:true,
                  maxlength:5
                }
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
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
        });
</script>

    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">            
            <div class="form-group">
                <label for="IconClass" class="col-sm-2">Row ID</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txt_rowID" id="txt_rowID">
                </div>
            </div>
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Description</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txt_descs" id="txt_descs">
                </div>
            </div>
        </div>   
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>



<script type="text/javascript">
  $(document).ready(function () {
    // loaddata();

    $('#btnSave').click(function(){
      // alert('a');
      
      if($('#frmEditor').valid()){
        // var MenuID = $('#modal').data('MenuID');        
        var datafrm = $('#frmEditor').serializeArray();
        // datafrm.push({name:"MenuID",value:MenuID});
        // var obj = new Object();
        var row_id = $('#txt_rowID').val();
        // obj.id = MenuID;
          $.ajax({
            url : "<?php echo base_url('c_row_format/save_header');?>",
              type:"POST",
              data: $('#frmEditor').serialize(),
              dataType:"json",
              success:function(event, data){
                if(event.St=="OK"){
                              // $("#TxtentityCode").change(function() {
                                    // var ent = $(this).find(':selected').val();          
                                    if(row_id!=='') {
                                      var site_url = '<?php echo base_url("c_row_format/zoom_row_formatID")?>';
                                      $.post(site_url,
                                        {pro:row_id},
                                        function(data,status) {
                                          $("#row_formatID").empty();
                                          $("#row_formatID").append(data);
                                          $("#row_formatID").trigger('change');
                                          // $("#row_formatID").trigger('chosen:updated');
                                        }
                                      );
                                    } 
                                  // });
                    tblGLFormat.ajax.reload(null,true);
                  swal("Information",event.Pesan,"success");
                  $('#modal').modal('hide');
                }else{
                  swal("Information",event.Pesan,"warning");
                }
                
                // alert(event.Pesan);
                
                // tblnewsfeed.ajax.reload(null,true); 
              },                    
              error: function(jqXHR, textStatus, errorThrown){
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                // alert(textStatus+' Save : '+errorThrown);
              }
          });                
      }
    });
  });



    // function loaddata(){
    //     var MenuID = $('#modal').data('MenuID');
    //     // alert(MenuID);
    //     ScreenID = MenuID;

    //     if (MenuID > 0) {
    //         $.getJSON("<?php echo base_url('c_menu/getByID');?>" + "/" + MenuID, function (data) {
                
    //           $('#txtMenuID').val(data[0].MenuID);
    //           $('#txtTitle').val(data[0].Title);
    //           $('#txtURL').val(data[0].URL);
    //           // $('#txtParentID').val(data[0].ParentMenuID);
    //           setparentid(data[0].ParentMenuID);
    //           $('#txtIconClass').val(data[0].IconClass);
    //           $('#txtOrderSeq').val(data[0].OrderSeq);

              
    //           // setprojectname(data[0].project_no);
    //           // setphase(data[0].phase_cd);
           
    //         });
    //     }
    // }
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>