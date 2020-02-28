
<style >
  #signupForm label.error {
  margin-left: 10px;
  width: auto;
  display: inline;
}
td {
    height: 40px;
  }

#label_form label {
    text-align: right;
  }

.marginSelect{
  padding-left: 12px !important;
  padding-bottom: 6px !important;
  border-bottom-width: 1px !important;
  padding-top: 3px !important;

}
label {
  text-align: right;
}
.has-error .select2-selection {
  border: 1px solid #a94442;
  border-radius: 4px;
}

</style>


<div class="ibox-content">
  <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method="POST" >

            <div class="form-group">
              <label >Subject</label>
              <div class="col-12">
                <input type="text" class="form-control" name="txtsubject" id="txtsubject" placeholder="Input Subject">
              </div>
            </div>
            <div class="form-group">
              <label >Question</label>
              <div class="col-12">
                <input type="text" class="form-control" name="txtquestion" id="txtquestion" placeholder="Input Question">
              </div>
            </div>      
               <div class="form-group">
             
                <label >Add Option(s)</label>
                <button class="btn btn-outline-success round btn-sm" style="padding-right: 7px;padding-left: 7px;" id="btnAdd" type="button"><i class="la la-plus"></i></button>
           
            </div>
            <div  style="overflow-y: scroll; overflow-x: hidden; height: 200px; ">
             <div id="options" >
                <div class="form-group">
                  
                </div>
                
              </div>
          
            </div>
             <input type="hidden" id="batas" name="batas"/>

        </form>
</div>
    


<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
  <script type="text/javascript">
  $(document).ready(function(){
$('#savefrm').attr("disabled", false); 
    $("#modal").on("hidden.bs.modal", function(){
        $("#modalbody").html("");
    });
    $("#txtoptType").select2();
      var xx = $("#batas").val();
      console.log(xx);   
      loaddata();

    

$("#btnAdd").click(function() 
  {
    var xx = $("#batas").val();    
    // console.log(xx);return;
    var li = 1;
    for (var i = xx; i <= xx; i++) 
    {
      $("#options").append('<div class="form-group" id="option_div'+i+'"><div class="col-12"><label><button class="btn btn-outline-danger round btn-sm" style="padding-right: 7px;padding-left: 7px;" onclick="remove('+i+')"><i class="la la-minus"></i></button></label> Option Value(s) <FONT COLOR="RED">*</FONT><br><div style="margin-left: 40px"><input type="text" class="form-control" name="txtopt_value[]" id="txtopt_value'+i+'" placeholder="Input Option"><label class="checkbox-inline"><input type="checkbox" name="remark[]"  id="remark'+i+'" onclick="checkremark('+i+')">Need Remark </label></div><input type="hidden" name="remark_val[]" id="remark_val'+i+'" value="0"><input type="hidden" name="line_no[]" id="line_no'+i+'" ></div></div>');
    }
    xx = i;
    $('#batas').val(i);
    // $("#line").val(i);
  });

  

  $('#form_nup').validate({
      ignore: "",
      rules: {
        txtsubject: { required: true},
        txtquestion: {required: true},
        txtopt_value1: {required: true},
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
          } else if (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }

    });

   $('#savefrm').unbind().click(function(){
// alert('ha');
$(this).attr("disabled", true); 
    s='',q='',f='',g='';
    bs='',bq='';
   var form = $('#modal').data('form');

   var survey_id = $('#modal').data('survey_id');      
    var a = $("#batas").val();  
 
    var datafrm = $('#form_nup').serializeArray();
        datafrm.push(
                     {name:"survey_id",value:survey_id},
                     {name:"form",value:form}
                     );

       if($('#form_nup').valid()){
   
            block(true,'#form_nup');
           var state = document.readyState
              if (state == 'complete') {
                  setTimeout(function(){
                      document.getElementById('interactive');
                     tblsurvey.ajax.reload(null,true);
                     block(false,'#form_nup');
                     // document.getElementById('loader').hidden=true;
                  },1000);
              }  
            $.ajax({
                url : "<?php echo base_url('c_detail_survey/save');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(data, status){
                 
                 // console.log(data);
                 // console.log(status);

                if(data.status =='OK'){
                                         // alert("OK");
                   swal({
                          title: "Information",
                          animation: false,
                          type: "success",
                          text: data.pesan,
                          confirmButtonText: "OK"
                      });
                    $('#modal').modal('hide');
                    console.log($('#modal'));
                    tblsurvey.ajax.reload(null,true);  
                    block(false,'#form_nup');
                }else{
                  swal({
                          title: "Information",
                          animation: false,
                          type: "error",
                          text: data.pesan,
                          confirmButtonText: "OK"
                      });
                  block(false,'#form_nup');
                }
                
              
              },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                    block(false,'#form_nup');
                }
            });
      }

});
     });
   function loaddata(){
        var survey_id = $('#modal').data('survey_id');
        var form = $('#modal').data('form');
        var line_no = $('#modal').data('line_no');
        survey_id = survey_id;

        if (form != 'add') {
            $.getJSON("<?php echo base_url('c_detail_survey/getByID');?>" + "/" + survey_id, function (data) {
              $('#txtsubject').val(data[0].subject);
              $('#txtquestion').val(data[0].content);
              // $('#txtopt_value1').val(data[0].options);
              // $('#line_no1').val(data[0].line_no);
              var a = data.length;
              // $('#batas').val(a+1);
              $('#batas').val(a);

            // var txtFlag = data[0].flag;
              // if(txtFlag == 1){
              //   document.getElementById('remark1').checked = true;    
              // }else{
              //   document.getElementById('remark1').checked = false;
              // }
              
              // for(var i = 1; i < a ;i++ ){
                for(var i = 0; i < a ;i++ ){
                
                var urut=i;
                var txtFlag = data[i].flag;
                var flagvalue =" ";var flagval='';
                if(txtFlag == '1'){
                  flagvalue = 'checked';
                  flagval = '1';
                }else{
                  flagvalue = ' ';
                  flagval = '0';
                }

                // console.log(flagvalue);//;return;
                // $("#options").append('<div class="form-group" id="option_div'+urut+'"><label class="col-sm-3"><button class="btn btn-danger btn-circle btn-outline pull-left" style="margin-left: 40%" onclick="remove('+urut+')"><i class="fa fa-minus"></i></button>Option Value(s)</label><div class="col-sm-7"><input type="text" class="form-control" name="txtopt_value[]" id="txtopt_value'+urut+'" placeholder="Input Option" value="'+data[i].options+'"><label class="checkbox-inline"><input type="checkbox" name="remark[]"  id="remark'+i+'" onclick="checkremark('+i+')" '+flagvalue+'>Need Remark </label><input type="hidden" name="remark_val[]" id="remark_val'+i+'" value="'+flagval+'"><br><input type="hidden" name="line_no[]" id="line_no'+i+'" value="'+data[i].line_no+'"></div>');
                $("#options").append('<div class="form-group" id="option_div'+urut+'"><div class="col-12"><label><button class="btn btn-outline-danger round btn-sm" style="padding-right: 7px;padding-left: 7px;" onclick="remove('+urut+')"><i class="la la-minus"></i></button></label> Option Value(s) <FONT COLOR="RED">*</FONT><br><div style="margin-left: 40px"><input type="text" class="form-control" name="txtopt_value[]" id="txtopt_value'+urut+'" placeholder="Input Option" value="'+data[i].options+'"><label class="checkbox-inline"><input type="checkbox" name="remark[]"  id="remark'+i+'" onclick="checkremark('+i+')" '+flagvalue+'>Need Remark </label></div><input type="hidden" name="remark_val[]" id="remark_val'+i+'" value="'+flagval+'"><input type="hidden" name="line_no[]" id="line_no'+i+'" value="'+data[i].line_no+'"></div></div>');
                    
              }
                    
            });
        } else {
          // $('#batas').val(2);
          $('#batas').val(3);
         }
    }
    
    $('#modal').on('hidden.bs.modal', function (e) {
        $('div.modal-body').html("");
        $(this).removeData();

    });


function remove(no){
    var site_url = "<?php echo base_url('c_detail_survey/deletedtlbyID');?>";
var survey_idDel = $("#modal").data('survey_id');
// $.post(site_url,
//               {survey_id:survey_idDel},
//               function(data,status) {
//                       // console.log(data);
//                       // $('#PTdtl').val(data);
//                       alert(data);
//                       $("#options #option_div"+no).remove();
//                         if(xx>1) {
//                           xx--;
//                           // $("#batas").val(xx);  
//                         }
//                   }
//                   );  
$("#options #option_div"+no).remove();
                        if(xx>1) {
                          xx--;
                          // $("#batas").val(xx);  
                        }
  // alert(survey_idDel);
  
    // console.log(tx);  



}
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
   function checkremark(no){
    // alert(no);
     if($('#remark'+no).is(':checked')){
      $('#remark_val'+no).val(1);
     } else {
      $('#remark_val'+no).val(0);
     }
   }
  </script> 