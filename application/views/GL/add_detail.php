
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

    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}
upline {
     -moz-text-decoration-line: overline; /* Code for Firefox */
     text-decoration-line: overline; 
}
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
                },
                txt_refno:{
                  maxlength:15
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
                <label for="IconClass" class="col-sm-2">Type</label>
                <div class="col-sm-8">
                    <!-- <input type="text" class="form-control" name="txt_rowID" id="txt_rowID"> -->
                    <select name="txt_type" id="txt_type" data-placeholder="Choose a Type..." class="select2" style="width:100%;"  tabindex="2">
                        <option value=""></option>                                     
                        <option value="T">Total</option> 
                        <option value="G">Group</option> 
                        <option value="C">Criteria</option> 
                        <option value="F">Calculated</option> 
                        <option value="D">Data</option> 
                        <option value="R">Text</option> 
                        <option value="N">Row Form Link</option> 
                        <option value="P">Page Break</option> 
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Description</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txt_descs" id="txt_descs">
                </div>
            </div>
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Ref No</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txt_refno" id="txt_refno">
                </div>
            </div>
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Column</label>
                <div class="col-sm-8">
                    <select name="txt_column" id="txt_column" data-placeholder="Choose a Column..." class="select2" style="width:100%;"  tabindex="2" disabled="true">
                        <option value=""></option>                                     
                        <?PHP 
           
                            echo $zoom_column;
                          
                          ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Col Range</label>
                <div class="col-sm-8">
                  <input type="checkbox" name="cb_colrange" id="cb_colrange" value='N' disabled="true"> 
                </div>
            </div>            
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Calculated / % Expression</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txt_persent_exp" id="txt_persent_exp">
                </div>
            </div>
             <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Formula</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="txt_formula" id="txt_formula" disabled="true">
                </div>
            </div>
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">Start Range</label>
                <div class="col-sm-8">
                    <select name="txt_start_exp" id="txt_start_exp" data-placeholder="Choose a start exp..." class="select2" style="width:100%;"  tabindex="2" disabled="true">
                        <option value=""></option>                                                             
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="OrderSeq" class="col-sm-2">End Range</label>
                <div class="col-sm-8">
                    <select name="txt_end_exp" id="txt_end_exp" data-placeholder="Choose a End exp..." class="select2" style="width:100%;"  tabindex="2" disabled="true">
                        <option value=""></option>                                                             
                    </select>
                </div>
            </div>
        </div>  
        <div class="form-group">
                <label for="OrderSeq" class="col-sm-2"></label>
                <div class="col-sm-8">
                  <!-- <input type="checkbox" name="txt_colrange" id="txtcolrange" value='true'>  -->
                  <table border="1">
                  <tr>                   
                    <th><i class="fa fa-plus" aria-hidden="true"></i>/<i class="fa fa-minus" aria-hidden="true"></i></th>
                    <th><i class="fa fa-header" aria-hidden="true"></i></th>
                    <th><u><b>D</b></u></th>
                    <th><upline><b>89</b></upline></th>
                    <th><u><b>8S</b></u></th>
                    <th><i class="fa fa-search" aria-hidden="true"></i></th>
                    <th><i class="fa fa-bold" aria-hidden="true"></i></th>
                    <th><i class="fa fa-italic" aria-hidden="true"></i></th>
                    <th><i class="fa fa-underline" aria-hidden="true"></i></th>
                    
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="cb_debit_credit" id="cb_debit_credit" value='-1' disabled="true"></td>
                   <td><input type="checkbox" name="cb_show_header" id="cb_show_header" value='Y' disabled="true"></td>
                   <td><input type="checkbox" name="cb_show_details" id="cb_show_details" value='Y' disabled="true"></td>
                   <td><input type="checkbox" name="cb_show_topline" id="cb_show_topline" value='Y' disabled="true"></td>
                   <td><input type="checkbox" name="cb_show_bottomline" id="cb_show_bottomline" value='Y' disabled="true"></td>
                   <td><input type="checkbox" name="cb_show_data" id="cb_show_data" value='Y' disabled="true"></td>

                   <td><input type="checkbox" name="cb_row_bold" id="cb_row_bold" value='Y'></td>
                   <td><input type="checkbox" name="cb_row_italic" id="cb_row_italic" value='Y'></td>
                   <td><input type="checkbox" name="cb_row_underline" id="cb_row_underline" value='Y'></td>
                  </tr>
                  
                </table>
                </div>
            </div> 
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>



<script type="text/javascript">
    var _descs = document.getElementById("txt_descs");
    var _refno = document.getElementById("txt_refno");
    var _cb_colrange = document.getElementById("cb_colrange");
    var _txt_column = document.getElementById("txt_column");
    var _start_exp = document.getElementById("txt_start_exp");
    var _end_exp = document.getElementById("txt_end_exp");
     var _formula = document.getElementById("txt_formula");
     var _calculated = document.getElementById("txt_persent_exp");
     var st_exp='';
     var ed_exp='';
    //checkbox
    var _debcredit = document.getElementById("cb_debit_credit");
    var _header = document.getElementById("cb_show_header");
    var _sDetail = document.getElementById("cb_show_details");
    var _sTopLine = document.getElementById("cb_show_topline");
    var _sBottomline = document.getElementById("cb_show_bottomline");
    var _sData = document.getElementById("cb_show_data");

    var _rBold = document.getElementById("cb_row_bold");
    var _rUnderline = document.getElementById("cb_row_underline");
    var _rItalic = document.getElementById("cb_row_italic");

  $(document).ready(function () {
    $('.select2').select2();
    loaddata();

    $('#btnSave').click(function(){
      
      
      if($('#frmEditor').valid()){
        var row_id = $('#modal').data('row_id');        
        var field_id = $('#modal').data('field_id');  
        var seq_ID   = $('#modal').data('seq_id');  
        var indent   = $('#modal').data('indent'); 
        var datafrm = $('#frmEditor').serializeArray();
        datafrm.push({name:"row_id",value:row_id},
                      {name:"field_id",value:field_id},
                      {name:"seq_ID",value:seq_ID},
                      {name:"indent",value:indent}
                    );
          $.ajax({
            url : "<?php echo base_url('c_row_format/save_detail');?>",
              type:"POST",
              data: datafrm,
              dataType:"json",
              success:function(event, data){
                if(event.St=="OK"){
                    tblGLFormat.ajax.reload(null,true);
                  swal("Information",event.Pesan,"success");
                  $('#modal').modal('hide');
                }else{
                  swal("Information",event.Pesan,"warning");
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
$('#txt_column').on("change",function(e){
    var column_id = $(this).find(':selected').val();
    var table_name = $("#txt_column option:selected").data("table");
    var field_name = $("#txt_column option:selected").data("field");
    var field_show = $("#txt_column option:selected").data("show");
    
    if(column_id!=='0') {
                    var site_url = '<?php echo base_url("c_row_format/zoom_start_end")?>';
                    $.post(site_url,
                      {table_name:table_name,
                        field_name:field_name,
                        field_show:field_show},
                      function(data,status) {
                        $("#txt_start_exp").empty();
                        $("#txt_start_exp").append(data);
                        $("#txt_start_exp").trigger('change');

                        $("#txt_end_exp").empty();
                        $("#txt_end_exp").append(data);
                        $("#txt_end_exp").trigger('change');

                        $('#txt_start_exp').val(st_exp).trigger('change');
                        $('#txt_end_exp').val(ed_exp).trigger('change');
                      }
                    );
                  } else {
                    $("#txt_start_exp").empty();
                    $("#txt_end_exp").empty();
                  }
    
});
$('#txt_type').on("change",function(e){
      var type = $(this).find(':selected').val();
    
    

    //clear
    _descs.value ='';
    _refno.value ='';
    _calculated.value='';
    // document.getElementById("frmEditor").reset(); 
    $('#txt_column').val('0').trigger('change');
    $('#txt_start_exp').val('').trigger('change');
    $('#txt_end_exp').val('').trigger('change');
    _cb_colrange.checked =false;
    // $('#txt_type').val(type).trigger('change');
    _formula.value='';
// document.getElementById("frmEditor").reset(); 

            switch (type) {
              case 'T':
              _formula.disabled = true;
                      _cb_colrange.disabled = true;
                      _txt_column.disabled = true;
                      _start_exp.disabled = true;
                      _end_exp.disabled = true;
                  //disable checkbox
                      _debcredit.disabled = true;
                      _header.disabled = false;
                      _sDetail.disabled = false;
                      _sTopLine.disabled = false;
                      _sBottomline.disabled = false;
                      _sData.disabled = false;
                  //checked checkbox
                      _debcredit.checked = false;
                      _header.checked = false;
                      _sDetail.checked = false;
                      _sTopLine.checked = false;
                      _sBottomline.checked = false;
                      _sData.checked = true;
                      _rBold.checked = false;
                      _rUnderline.checked = false;
                      _rItalic.checked = false;

                  break;
              case 'G':
              _formula.disabled = true;
              _txt_column.disabled = false;
              _cb_colrange.disabled = false;
              _start_exp.disabled = false;
              _end_exp.disabled = false;
                  //disable
                      _debcredit.disabled = true;
                      _header.disabled = false;
                      _sDetail.disabled = false;
                      _sTopLine.disabled = false;
                      _sBottomline.disabled = false;
                      _sData.disabled = false;
                  //checked
                      _debcredit.checked = false;
                      _header.checked = false;
                      _sDetail.checked = false;
                      _sTopLine.checked = false;
                      _sBottomline.checked = false;
                      _sData.checked = true;
                      _rBold.checked = false;
                      _rUnderline.checked = false;
                      _rItalic.checked = false;
                  break;
              case 'C':
              _formula.disabled = true;
              _cb_colrange.disabled = false;
                  //disable
                      _debcredit.disabled = true;
                      _header.disabled = true;
                      _sDetail.disabled = true;
                      _sTopLine.disabled = true;
                      _sBottomline.disabled = true;
                      _sData.disabled = true;
                  //checked
                      _debcredit.checked = false;
                      _header.checked = false;
                      _sDetail.checked = false;
                      _sTopLine.checked = false;
                      _sBottomline.checked = false;
                      _sData.checked = false;
                      _rBold.checked = false;
                      _rUnderline.checked = false;
                      _rItalic.checked = false;
                  break;
              case 'F':
              _formula.disabled = false;
              _cb_colrange.disabled = true;
              _txt_column.disabled = true;
              _cb_colrange.disabled = true;
              _start_exp.disabled = true;
              _end_exp.disabled = true;
                  //disable
                      _debcredit.disabled = true;
                      _header.disabled = false;
                      _sDetail.disabled = false;
                      _sTopLine.disabled = true;
                      _sBottomline.disabled = true;
                      _sData.disabled = false;
                  //checked
                      _debcredit.checked = false;
                      _header.checked = false;
                      _sDetail.checked = false;
                      _sTopLine.checked = false;
                      _sBottomline.checked = false;
                      _sData.checked = false;
                      _rBold.checked = false;
                      _rUnderline.checked = false;
                      _rItalic.checked = false;
                  break;
              case 'D':
              _formula.disabled = true;
              _cb_colrange.disabled = false;
                  //disable
                      _debcredit.disabled = false;
                      _header.disabled = true;
                      _sDetail.disabled = true;
                      _sTopLine.disabled = true;
                      _sBottomline.disabled = true;
                      _sData.disabled = false;
                  //checked
                      _debcredit.checked = false;
                      _header.checked = false;
                      _sDetail.checked = false;
                      _sTopLine.checked = false;
                      _sBottomline.checked = false;
                      _sData.checked = true;
                      _rBold.checked = false;
                      _rUnderline.checked = false;
                      _rItalic.checked = false;
                  break;
              case 'R':
              _formula.disabled = true;
              _cb_colrange.disabled = true;
                 //disable
                      _debcredit.disabled = true;
                      _header.disabled = true;
                      _sDetail.disabled = true;
                      _sTopLine.disabled = true;
                      _sBottomline.disabled = true;
                      _sData.disabled = true;
                  //checked
                      _debcredit.checked = false;
                      _header.checked = false;
                      _sDetail.checked = false;
                      _sTopLine.checked = false;
                      _sBottomline.checked = false;
                      _sData.checked = false;
                      _rBold.checked = false;
                      _rUnderline.checked = false;
                      _rItalic.checked = false;
                  break;
              case 'N':
              _formula.disabled = false;              
              _cb_colrange.disabled = true;
              _txt_column.disabled = true;
              _cb_colrange.disabled = true;
              _start_exp.disabled = true;
              _end_exp.disabled = true;
                  //disable
                      _debcredit.disabled = true;
                      _header.disabled = true;
                      _sDetail.disabled = true;
                      _sTopLine.disabled = true;
                      _sBottomline.disabled = true;
                      _sData.disabled = true;
                  //checked
                      _debcredit.checked = false;
                      _header.checked = false;
                      _sDetail.checked = false;
                      _sTopLine.checked = false;
                      _sBottomline.checked = false;
                      _sData.checked = false;
                      _rBold.checked = false;
                      _rUnderline.checked = false;
                      _rItalic.checked = false;
                  break;
              case 'P':
              _formula.disabled = true;
              _cb_colrange.disabled = true;
                  //disable
                      _debcredit.disabled = true;
                      _header.disabled = true;
                      _sDetail.disabled = true;
                      _sTopLine.disabled = true;
                      _sBottomline.disabled = true;
                      _sData.disabled = true;
                  //checked
                      _debcredit.checked = false;
                      _header.checked = false;
                      _sDetail.checked = false;
                      _sTopLine.checked = false;
                      _sBottomline.checked = false;
                      _sData.checked = false;
                      _rBold.checked = false;
                      _rUnderline.checked = false;
                      _rItalic.checked = false;
                  break;
              }
  
            
        
      });

    function loaddata(){
        var field_id = $('#modal').data('field_id');
        var row_id = $('#modal').data('row_id');
        
        

        if (field_id != '0') {
            $.getJSON("<?php echo base_url('c_row_format/getByID');?>" + "/" + field_id+"/"+row_id, function (data) {
             console.log(data);   
             $('#txt_type').val(data[0].type).trigger('change');
             _descs.value = data[0].row_descs;
             _refno.value = data[0].ref_no;
             _formula.value = data[0].formula;
             _calculated.value = data[0].percent_exp;

             // $('#').val(data[0].row_descs);
             // $('#').val(data[0].ref_no);
             // $('#').val(data[0].formula);
             // $('#').val(data[0].percent_exp);

             st_exp = data[0].start_exp;
             ed_exp = data[0].end_exp;
             $('#txt_column').val(data[0].col_id).trigger('change');
             // $('#txt_start_exp').val(data[0].start_exp).trigger('change');
             // $('#txt_end_exp').val(data[0].end_exp).trigger('change');
           
              console.log(data[0].debit_credit);
              console.log(data[0].start_exp);
              console.log(data[0].end_exp);
              //checbox
              if(data[0].col_range=='N'){
                _cb_colrange.checked =true;
              }else{
                _cb_colrange.checked =false;
              }

              if(data[0].debit_credit=='-1'){
                _debcredit.checked =true;
              }else{
                _debcredit.checked =false;
              }

              if(data[0].show_header=='Y'){
                _header.checked =true;
              }else{
                _header.checked =false;
              }

              if(data[0].show_details=='Y'){
                _sDetail.checked =true;
              }else{
                _sDetail.checked =false;
              }

              if(data[0].show_topline=='Y'){
                _sTopLine.checked =true;
              }else{
                _sTopLine.checked =false;
              }

              if(data[0].show_bottomline=='Y'){
                _sBottomline.checked =true;
              }else{
                _sBottomline.checked =false;
              }

              if(data[0].show_data=='Y'){
                _sData.checked =true;
              }else{
                _sData.checked =false;
              }

              if(data[0].row_bold=='Y'){
                _rBold.checked =true;
              }else{
                _rBold.checked =false;
              }

              if(data[0].row_italic=='Y'){
                _rItalic.checked =true;
              }else{
                _rItalic.checked =false;
              }

              if(data[0].row_underline=='Y'){
                _rUnderline.checked =true;
              }else{
                _rUnderline.checked =false;
              }


            });
        }
    }
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
        $('div.modal-body').html("");
    });
</script>