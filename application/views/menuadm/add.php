
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
 <style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
/*div.dataTables_wrapper 
div.dataTables_filter {
    text-align: right;
    float: right;
    padding-bottom: 5px;
}*/
</style>

<script type="text/javascript">
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
  $("#frmEditor").validate({
            rules: {
                txtTitle: {
                    required: true
                },
                txtIconClass:{
                  required:true
                },
                txtOrderSeq:{
                  required:true,
                  number:true
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
<div id="loader" class="loader" hidden="true"></div>
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <input type="hidden" name="txtMenuID" id="txtMenuID" class="form-control">
            </div>
            <div class="form-group">
                <label for="Title" class="col-sm-2">Title</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txtTitle" id="txtTitle">
                </div>
            </div>
            <div class="form-group">
                <label for="URL" class="col-sm-2 control-label">URL</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txtURL" id="txtURL">
                </div>
            </div>
            <div class="form-group">
                <label for="project_name" class="col-sm-2">Parent ID</label>
                <div class="col-sm-8">
                    <select name="txtParentID" id="txtParentID" data-placeholder="Choose a Parent Menu..." class="select2_demo_1 form-control" >
                        <option value=""></option> 
                            <?php 
                                foreach ($menuData as $row) 
                                          {
                                              echo '<option value="'.$row->MenuID.'">'.$row->Title.'</option>';
                                          }
                            ?>            
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="IconClass" class="col-sm-2">Icon Class</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txtIconClass" id="txtIconClass">
                </div>
            </div>
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Order Sequence</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txtOrderSeq" id="txtOrderSeq">
                </div>
            </div>
        </div>   
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>

    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">


<script type="text/javascript">
  $(document).ready(function () {
    loaddata();
    $("#txtParentID").select2({
            dropdownParent: "#modal",
            width:"100%"
        }); 

    $('#btnSave').click(function(){
      // alert('a');
      var ParentID = $('#txtParentID').val();
      var title = $('#txtTitle').val();
      if(ParentID=="" && title.length>15) {
        swal("Information", "Menu Title can't be more than 15 characters!","warning");
        return;
      }
      if($('#frmEditor').valid()){
        var MenuID = $('#modal').data('MenuID');        
        var datafrm = $('#frmEditor').serializeArray();
        datafrm.push({name:"MenuID",value:MenuID});
        var obj = new Object();
        obj.id = MenuID;
          $.ajax({
            url : "<?php echo base_url('c_menu/save_menu');?>",
              type:"POST",
              data: $('#frmEditor').serialize() + '&' + $.param(obj),
              dataType:"json",
              success:function(event, data){
                if(event.St=="OK"){
                  swal("Information",event.Pesan,"success");
                  $('#modal').modal('hide');
                }else{
                  swal("Information",event.Pesan,"warning");
                }
                
                // alert(event.Pesan);
                document.getElementById('loader').hidden=false;
                var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                             tblnewsfeed.ajax.reload(null,true); 
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }
                
              },                    
              error: function(jqXHR, textStatus, errorThrown){
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                // alert(textStatus+' Save : '+errorThrown);
              }
          });                
      }
    });
  });

    function setparentid(MenuID){        

        var site_url = '<?php echo base_url("c_menu/zoom_parentid_from")?>';
            $.post(site_url,
              {MenuID:MenuID},
              function(data,status) {
                $("#txtParentID").empty();
                $("#txtParentID").append(data);                
                $("#txtParentID").trigger('change');
              }
            );
    }

    function loaddata(){
        var MenuID = $('#modal').data('MenuID');
        // alert(MenuID);
        ScreenID = MenuID;

        if (MenuID > 0) {
            $.getJSON("<?php echo base_url('c_menu/getByID');?>" + "/" + MenuID, function (data) {
                
              $('#txtMenuID').val(data[0].MenuID);
              $('#txtTitle').val(data[0].Title);
              $('#txtURL').val(data[0].URL);
              // $('#txtParentID').val(data[0].ParentMenuID);
              setparentid(data[0].ParentMenuID);
              $('#txtIconClass').val(data[0].IconClass);
              $('#txtOrderSeq').val(data[0].OrderSeq);

              
              // setprojectname(data[0].project_no);
              // setphase(data[0].phase_cd);
           
            });
        }
    }
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>