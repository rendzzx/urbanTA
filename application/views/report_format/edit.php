



<style type="text/css">
    #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
  .has-error .select2 {
      border: 1px solid #a94442;
      border-radius: 4px;
 
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
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
</style>


<div id="loader" class="loader" hidden="true"></div>
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="nup_id" class="col-sm-2 control label"></label>
                <input type="hidden" name="field_id" id="field_id" class="form-control">
                <input type="hidden" name="form" id="form">
            </div>
            <div class="form-group">
              <div class="col-sm-1"></div>
                <label class="col-sm-2 ">Column ID</label>
                <div class="col-sm-7">
                  <input type="text" name="col_id" id="col_id" class="form-control" style="text-transform: uppercase;">   
                </div>                                
            </div>
            <div class="form-group">
              <div class="col-sm-1"></div>
                <label class="col-sm-2 ">Header</label>
                <div class="col-sm-7">
                  <input type="text" name="header1" id="header1" class="form-control">   
                </div>                                
            </div>
            <div class="form-group">
              <div class="col-sm-1"></div>
                <label class="col-sm-2 "></label>
                <div class="col-sm-7">
                  <input type="text" name="header2" id="header2" class="form-control">   
                </div>                                
            </div>
            <div class="form-group">
              <div class="col-sm-1"></div>
                <label class="col-sm-2 ">Amount Type</label>
                <div class="col-sm-7">
                  <select name="amt_type" id="amt_type" data-placeholder="Choose Amount Type..." class="form-control select2" tabindex="2">
                      <option value=""></option>
                      <?php echo $cbAmt?>
                  </select>
                </div>                                
            </div>
            <div class="form-group">
              <div class="col-sm-1"></div>
                <label class="col-sm-2 ">Formula</label>
                <div class="col-sm-7">
                  <input type="text" name="formula" id="formula" class="form-control">   
                </div>                                
            </div>
            <div class="form-group">
            <div class="col-sm-1"></div>
                <label class="col-sm-2 ">Period Type</label>
                <div class="col-sm-7">
                    <label class="radio-inline"><input type="radio" name="fixed_relative" id="F" value="F" checked>Fixed </label>
                    <label class="radio-inline"><input type="radio" name="fixed_relative" id="R" value="R">Relative </label>    
                </div>                                
            </div>
            <div class="form-group">
            <div class="col-sm-1"></div>
                <label for="entity_name" class="col-sm-2">Relative By</label>
                <div class="col-sm-3">
                    <select name="relative_by" id="relative_by" data-placeholder="Choose Relative..." class="form-control select2" tabindex="2">
                            <option value=""></option>
                            <option value="Y">Year</option>
                            <option value="M">Period</option>
                            <option value="D">Day</option>
                    </select>
                </div>
                <label for="entity_name" class="col-sm-1">Period</label>
                <div class="col-sm-3">
                   <input type="text"  class="form-control" id="period" name="period">  
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-1"></div>
                <label for="entity_name" class="col-sm-2">Duration Type</label>
                <div class="col-sm-3">
                    <select name="duration_type" id="duration_type" data-placeholder="Choose Duration Type..." class="form-control select2" tabindex="2">
                            <option value=""></option>
                            <option value="M">MTD</option>
                            <option value="Y">YTD</option>
                            <option value="T">TD</option>
                            <option value="S">Specify</option>
                    </select>
                </div>
                <label for="entity_name" class="col-sm-1">Duration</label>
                <div class="col-sm-3">
                   <input type="number"  class="form-control" id="duration" name="duration" min="1">  
                </div>
            </div>
            <div class="form-group">
            <div class="col-sm-1"></div>
                <label class="col-sm-2 ">Recalculate </label>
                <div class="col-sm-4">
                    <input type="checkbox" name="calc" id="calc">
                     <input type="hidden" name="calc_val" id="calc_val">
                    
                </div>                                
            </div>
            <div class="form-group">
            <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <table class="table table-bordered table-hover" cellspacing="0" width="80%">  
                    <thead>
                        <th colspan="3">Criteria By Expression</th>                                     
                        <!-- <th>By</th>                                 -->
                        <!-- <th>Expression</th> -->
                    </thead>
                    <tbody>
                      <tr>
                        <th width="180px">

                          <select name="col_id1" id="col_id1" data-placeholder="Choose ..." class="form-control select2" tabindex="2">
                              <option value=""></option>
                              <?php echo $cbcrit?>
                          </select>
                        </th>
                        <th>
                          <input type="checkbox" name="col_range1" id="col_range1">
                          <input type="hidden" name="col_range1_val" id="col_range1_val">
                        </th>
                        <th>
                        <!-- <div class="col-sm-12"> -->
                          <div class="col-sm-6"><input type="text"  class="form-control " id="start_exp1" name="start_exp1" style="width: 100%;float:left"></div>
                    
                          <div class="col-sm-6"><input type="text"  class="form-control " id="end_exp1" name="end_exp1" style="width: 100%">  </div>
                        <!-- </div> -->
                              
                          </th>
                      </tr>
                      <tr>
                        <th>
                          <select name="col_id2" id="col_id2" data-placeholder="Choose ..." class="form-control select2" tabindex="2">
                              <option value=""></option>
                              <?php echo $cbcrit?>
                          </select>
                        </th>
                        <th>
                          <input type="checkbox" name="col_range2" id="col_range2">
                          <input type="hidden" name="col_range2_val" id="col_range2_val">
                        </th>
                        <th>
                          <div class="col-sm-6"><input type="text"  class="form-control " id="start_exp2" name="start_exp2" style="width: 100%;float:left"></div>
                          <div class="col-sm-6"><input type="text"  class="form-control " id="end_exp2" name="end_exp2" style="width: 100%">  </div>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          <select name="col_id3" id="col_id3" data-placeholder="Choose ..." class="form-control select2" tabindex="2">
                              <option value=""></option>
                              <?php echo $cbcrit?>
                          </select>
                        </th>
                        <th>
                          <input type="checkbox" name="col_range3" id="col_range3">
                          <input type="hidden" name="col_range3_val" id="col_range3_val">
                        </th>
                        <th>
                          <div class="col-sm-6"><input type="text"  class="form-control " id="start_exp3" name="start_exp3" style="width: 100%;float:left"></div>
                          <div class="col-sm-6"><input type="text"  class="form-control " id="end_exp3" name="end_exp3" style="width: 100%">  </div>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          <select name="col_id4" id="col_id4" data-placeholder="Choose ..." class="form-control select2" tabindex="2">
                              <option value=""></option>
                              <?php echo $cbcrit?>
                          </select>
                        </th>
                        <th>
                          <input type="checkbox" name="col_range4" id="col_range4">
                          <input type="hidden" name="col_range4_val" id="col_range4_val">
                        </th>
                        <th>
                          <div class="col-sm-6"><input type="text"  class="form-control " id="start_exp4" name="start_exp4" style="width: 100%;float:left"></div>
                          <div class="col-sm-6"><input type="text"  class="form-control " id="end_exp4" name="end_exp4" style="width: 100%">  </div>
                        </th>
                      </tr>
                      <tr>
                        <th>
                          <select name="col_id5" id="col_id5" data-placeholder="Choose ..." class="form-control select2" tabindex="2">
                              <option value=""></option>
                              <?php echo $cbcrit?>
                          </select>
                        </th>
                        <th>
                          <input type="checkbox" name="col_range5" id="col_range5">
                          <input type="hidden" name="col_range5_val" id="col_range5_val">
                        </th>
                        <th>
                          <div class="col-sm-6"><input type="text"  class="form-control " id="start_exp5" name="start_exp5" style="width: 100%;float:left"></div>
                          <div class="col-sm-6"><input type="text"  class="form-control " id="end_exp5" name="end_exp5" style="width: 100%">  </div>
                        </th>
                      </tr>
                        
                    </tbody>
              </table>
              </div>
            </div>
             
                        
            

     
        </div>                  
                 
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        </div>
    </form>



<!-- Select2 -->

<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<!-- date-range-picker -->
<script src="<?=base_url('js/plugins/fullcalendar/moment.min.js')?>"></script>
<script src="<?=base_url('js/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>





            

<script type="text/javascript">
var field_id = $('#modal').data('MenuID');
// alert(field_id);
loaddata();


  $(document).ready(function () {
    $('#calc_val').val('N');
    $('#col_range1_val').val('Y');
    $('#col_range2_val').val('Y');
    $('#col_range3_val').val('Y');
    $('#col_range4_val').val('Y');
    $('#col_range5_val').val('Y');
    $(".select2").select2({
            width:"100%"
        }); 
    $.validator.addMethod("cek_col", function (value, element) {
        var isSuccess = false;
        var str = $('#col_id').val();
        var Sawal = str.charAt(0).toUpperCase();
        // console.log(Sawal);  
        
        if(Sawal=='C' && str.length==4){
          isSuccess = true;
        }
                    // console.log(isSuccess);
                    return isSuccess;

      });
     $("#frmEditor").validate({
            ignore:"",
            rules: {
                col_id:{
                  required:true,
                  cek_col:true
                },
                header1: {
                    required: true
                },
                amt_type:{
                    required:true
                },
                relative_by:{
                    required:true
                },
                period:{
                  required:true
                 
                },
                duration_type:{
                    required:true
                },
                duration:{
                  required:true
               
                }
            },
            messages: {
                col_id: {cek_col: "First character must be C and character's length must be 4."}
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
          } else if (element.hasClass('select2')){
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
        });
    $('#btnSave').click(function(){
      // var datafrm = $('#frmEditor').serializeArray();
        // datafrm.push({name:"field_id",value:field_id});
      // console.log(datafrm);return;
      
      if($('#frmEditor').valid()){
        
        document.getElementById("btnSave").disabled = true;
        document.getElementById('loader').hidden=false;
        // return;
        // var field_id = $('#modal').data('MenuID');
        var datafrm = $('#frmEditor').serializeArray();
        // datafrm.push({name:"field_id",value:field_id});
    
          $.ajax({
            url : "<?php echo base_url('c_gl_column/save');?>",
              type:"POST",
              // async: false,
              data: $('#frmEditor').serialize(),
              dataType:"json",
              success:function(event, data){
                document.getElementById('loader').hidden=true;
                // console.log(event);
                if(event.status=='OK'){
                  swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: event.Pesan,
                    confirmButtonText: "OK"
                  });
                  
                  $('#modal').modal('hide');
                  tblGLcolumn.ajax.reload(null,true);
                } else {
                  swal({
                    title: "Error",
                    animation: false,
                    type:"error",
                    text: event.Pesan,
                    confirmButtonText: "OK"
                  });
                  document.getElementById("btnSave").disabled = false;
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
      }
    });
  });

  $('#col_id1').change(function(){
    var col_id1 = $(this).find(':selected').val(); 
    if(col_id1=='0'){
        document.getElementById('col_range1').disabled=true;
    }else {
      document.getElementById('col_range1').disabled=false;
    }
  });
  $('#col_id2').change(function(){
    var col_id2 = $(this).find(':selected').val(); 
    if(col_id2=='0'){
        document.getElementById('col_range2').disabled=true;
    }else {
      document.getElementById('col_range2').disabled=false;
    }
  });
  $('#col_id3').change(function(){
    var col_id3 = $(this).find(':selected').val(); 
    if(col_id3=='0'){
        document.getElementById('col_range3').disabled=true;
    }else {
      document.getElementById('col_range3').disabled=false;
    }
  });
  $('#col_id4').change(function(){
    var col_id4 = $(this).find(':selected').val(); 
    if(col_id4=='0'){
        document.getElementById('col_range4').disabled=true;
    }else {
      document.getElementById('col_range4').disabled=false;
    }
  });
  $('#col_id5').change(function(){
    var col_id5 = $(this).find(':selected').val(); 
    if(col_id5=='0'){
        document.getElementById('col_range5').disabled=true;
    }else {
      document.getElementById('col_range5').disabled=false;
    }
  });
  $('#calc').change(function(){
    var c = this.checked ? 'Y' : 'N';
    $('#calc_val').val(c);
  
  });

  $('#col_range1').change(function(){
    var c = this.checked ? 'N' : 'Y';
    $('#col_range1_val').val(c);
    if(c=='N'){
      document.getElementById('start_exp1').disabled=true;
      document.getElementById('end_exp1').disabled=true;
    } else {
       document.getElementById('start_exp1').disabled=false;
      document.getElementById('end_exp1').disabled=false;
    }
  });
  $('#col_range2').change(function(){
    var c = this.checked ? 'N' : 'Y';
    $('#col_range2_val').val(c);
    if(c=='N'){
      document.getElementById('start_exp2').disabled=true;
      document.getElementById('end_exp2').disabled=true;
    } else {
       document.getElementById('start_exp2').disabled=false;
      document.getElementById('end_exp2').disabled=false;
    }
  });
  $('#col_range3').change(function(){
    var c = this.checked ? 'N' : 'Y';
    $('#col_range3_val').val(c);
    if(c=='N'){
      document.getElementById('start_exp3').disabled=true;
      document.getElementById('end_exp3').disabled=true;
    } else {
       document.getElementById('start_exp3').disabled=false;
      document.getElementById('end_exp3').disabled=false;
    }
  });
  $('#col_range4').change(function(){
     var c = this.checked ? 'N' : 'Y';
      $('#col_range4_val').val(c);
      if(c=='N'){
        document.getElementById('start_exp4').disabled=true;
        document.getElementById('end_exp4').disabled=true;
      } else {
         document.getElementById('start_exp4').disabled=false;
        document.getElementById('end_exp4').disabled=false;
      }
  });
  $('#col_range5').change(function(){
    var c = this.checked ? 'N' : 'Y';
    $('#col_range5_val').val(c);
    if(c=='N'){
      document.getElementById('start_exp5').disabled=true;
      document.getElementById('end_exp5').disabled=true;
    } else {
       document.getElementById('start_exp5').disabled=false;
      document.getElementById('end_exp5').disabled=false;
    }
  });



    function setcriteria(id,no){
    

        var site_url = '<?php echo base_url("c_gl_column/zoom_criteria")?>';
            $.post(site_url,
              {id:id,no:no},
              function(data,status) {
                // console.log(data);
                $("#col_id"+no).empty();
                $("#col_id"+no).append(data);
                $("#col_id"+no).trigger('change');
               
              }
            );
         
                    
    }
    function setamttype(id){
    

        var site_url = '<?php echo base_url("c_gl_column/zoom_amt_type")?>';
            $.post(site_url,
              {id:id},
              function(data,status) {
                // console.log(data);
                $("#amt_type").empty();
                $("#amt_type").append(data);
                $("#amt_type").trigger('change');
               
              }
            );
         
                    
    }

    function loaddata(){
      
        var field_id = $('#modal').data('MenuID');
        // var ID = field_id.length;

        if (field_id.length > 0) {
            document.getElementById('loader').hidden=false;
            $.getJSON("<?php echo base_url('c_gl_column/getByID');?>" + "/" + field_id, function (data) {
              $('#form').val('edit');
              $('#col_id').val(data[0].field_id);
              document.getElementById('col_id').disabled = true;
              var status = data[0].fixed_relative;
              document.getElementById(status).checked = true;
              // alert(data[0].relative_by);
              $('#relative_by').val(data[0].relative_by).trigger('change');
              $('#header1').val(data[0].header1);
              $('#header2').val(data[0].header2);
              $('#formula').val(data[0].formula);
              $('#period').val(data[0].period);
              $('#duration_type').val(data[0].duration_type).trigger('change');
              $('#duration').val(data[0].duration);
              $('#field_id').val(data[0].field_id);

              setamttype(data[0].amt_type);
              var calc = data[0].calc;
              if(calc == 'Y'){
                document.getElementById('col_range1').checked = true;    
              }else{
                document.getElementById('col_range1').checked = false;
              }
                
             setcriteria(data[0].col_id1,'1');
             setcriteria(data[0].col_id2,'2');
             setcriteria(data[0].col_id3,'3');
             setcriteria(data[0].col_id4,'4');
             setcriteria(data[0].col_id5,'5');
             
             var colrange1 = data[0].col_range1;
             $('#col_range1_val').val(colrange1);
              if(colrange1 == 'N'){
                document.getElementById('col_range1').checked = true;    
              }else{
                document.getElementById('col_range1').checked = false;
              }
              var colrange2 = data[0].col_range2;
              $('#col_range2_val').val(colrange2);
              if(colrange2 == 'N'){
                document.getElementById('col_range2').checked = true;    
              }else{
                document.getElementById('col_range2').checked = false;
              }
              var colrange3 = data[0].col_range3;
              $('#col_range3_val').val(colrange3);
              if(colrange3 == 'N'){
                document.getElementById('col_range3').checked = true;    
              }else{
                document.getElementById('col_range3').checked = false;
              }
              var colrange4 = data[0].col_range4;
              $('#col_range4_val').val(colrange4);
              if(colrange4 == 'N'){
                document.getElementById('col_range4').checked = true;    
              }else{
                document.getElementById('col_range4').checked = false;
              }
              var colrange5 = data[0].col_range5;
              $('#col_range5_val').val(colrange5);
              if(colrange5 == 'N'){
                document.getElementById('col_range5').checked = true;    
              }else{
                document.getElementById('col_range5').checked = false;
              }
              // var seDate = fsDate+" - "+feDate;                
              // $('#TxtstartEndDate').val(seDate);

              // var status = data[0].status;
              // document.getElementById(status).checked = true;

              var c = $('#calc').checked ? 'Y' : 'N';
              $('#calc_val').val(c);

              // var txtCancelNUP = data[0].cancel_nup;
              // if(txtCancelNUP == 1){
              //   document.getElementById('txtCancelNUP').checked = true;    
              // }else{
              //   document.getElementById('txtCancelNUP').checked = false;
              // }
                

            });
              var state = document.readyState
              if (state == 'complete') {
                  setTimeout(function(){
                      document.getElementById('interactive');
                     // document.getElementById('load').style.visibility="hidden";
                     document.getElementById('loader').hidden=true;
                  },1000);
              }
        }
    }
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>
          