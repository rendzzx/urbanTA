<!-- 
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>
 -->


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
  <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_publish" method="POST" >

            <div class="form-group">
              <label>Survey Title</label>
              <div class="col-12">
                <input type="text" class="form-control" name="txttitle" id="txttitle" placeholder="Input Subject">
              </div>
            </div>
            <div class="form-group">
              <label >Publish Date</label>
              <div class="col-12">
                <input type="text" class="form-control" id="txtPublish" name="txtPublish"  placeholder="Publish Date" value=""/>
              </div>
            </div>
            <div class="form-group">
              <label >Expired Date</label>
              <div class="col-12">
                <input type="text" class="form-control" name="txtExpired" id="txtExpired" placeholder="Expired Date" value=""/>
              </div>
            </div>
             <div class="form-group">
              <label >Subject</label>
              <div class="col-12">
                <select name="txtsubject[]" id="txtsubject" data-placeholder="Select Subject..." style="width: 100%;" class="select2 form-control" tabindex="2" multiple="multiple">
                  <option value=""></option>
                <?php echo $ddsubject;?>                
              </select>
              </div>
            </div>   
     

        </form>
      </div>            


<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<script type="text/javascript">

loaddata();
$('#savefrm').attr("disabled", false); 
$("#txtsubject").select2();
$('#txtPublish').datepicker({
    format: 'dd/mm/yyyy',
    onSelect: function(dateText, inst) {
        $("input[name='txtPublish']").val(dateText);
    }
});
$('#txtExpired').datepicker({
    format: 'dd/mm/yyyy',
    onSelect: function(dateText, inst) {
        $("input[name='txtExpired']").val(dateText);
    }
});
  // $("#txtExpired").attr("disabled", "disabled");
// loaddata();
// $("#txtPublish").change(function(){
//       alert('nyala');
//     $("#txtExpired").removeattr("disabled", "disabled");
//       })


     $('#form_publish').validate({
      ignore: "",
      rules: {
        txttitle: { required: true},
        txtPublish: {required: true},
        txtExpired: {
                      required: true,
                      cek_date:true
                    },
        txtsubject: {required: true},
      },
      messages: {
        txtExpired:{
                    cek_date:"Expired Date can't be smaller than Publish Date"
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
          } else if (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }

    });
$('#txtExpired').change(function(){
$(this).valid();
});
$('#txtPublish').change(function(){
$(this).valid();
});
$.validator.addMethod("cek_date", function (value, element) {
            var isSuccess = false;
            var endperiod = $('#txtExpired').val().split("/");
            expired = new Date(endperiod[2], endperiod[1] - 1, endperiod[0]);
            var publish = $('#txtPublish').val().split("/");
            published = new Date(publish[2], publish[1] - 1, publish[0]);
            // console.log('publish: '+published);
            // console.log('expired: '+expired);
   

            if(expired < published){

            }
            else{
                isSuccess=true;
            }

            return isSuccess;
        });
   $('#savefrm').click(function(){
    $(this).attr("disabled", true); 
                  if($('#form_publish').valid()){
                  var txttitle = $("#txttitle").val();
                  var subject = $("#txtsubject").val();
                  // var myOpts = document.getElementById('txtsubject').options;
                  // console.log(subject);return;
                  var publish_id = $('#modal').data('publish_id');
                  var form = $('#modal').data('form');
                   var datafrm = $('#form_publish').serializeArray();
                   var a1 = $('#txtPublish').val();
                    var date = new Date(parseInt(a1.substr(0,10)));
                    var year =a1.substr(6,4);
                    var month=a1.substr(3,2);
                    var day =a1.substr(0,2);
                               
                  var aa1 = year+"/"+month+"/"+day;
                   // console.log(aa);
                    var b ="";
                    var publish = "";
                    if(aa1 == "//"){
                       publish =  b;
                    } else {
                       publish =  aa1;
                    }
                   
                    
                    
                    var a2 = $('#txtExpired').val();
                    var date = new Date(parseInt(a2.substr(0,10)));
                    var year =a2.substr(6,4);
                    var month=a2.substr(3,2);
                    var day =a2.substr(0,2);
                               
                  var a1a1 = year+"/"+month+"/"+day;
                  // console.log(aa);
                    var b ="";
                    var expired = "";
                    if(a1a1 == "//"){
                      expired =  b;
                    } else {
                       expired =  a1a1;
                    }

                    var batas = subject.length;
                    // console.log('Ini '+batas);return;
                    // console.log(batas);return;
                     datafrm.push(
                     {name:"txttitle",value:txttitle}, 
                     {name:"publishDate",value:publish},
                     {name:"ExpiredDate",value:expired},
                     {name:"publish_id",value:publish_id},
                     {name:"form",value:form},
                     {name:"batas",value:batas}
                     );
                     // console.log(txttitle);return;
            // var start = $("#txtPublish").val();
            // var end = $("#txtExpired").val();
            // if (start > end ) {          
            // // alert('nyala');
            // swal ( "Oops" ,  "Expired Date Must Be Greater Than Publish Date!" ,  "error" );
            // return;
            // }
                 // document.getElementById('loader').hidden=false;
                 block(true,'#form_publish');
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 tblsurvey.ajax.reload(null,true);
                                 block(false,'#form_publish');
                                 // document.getElementById('loader').hidden=true;
                              },1000);
                          }      
            $.ajax({
                url : "<?php echo base_url('c_publish_survey/save');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(data, status){
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
                    // console.log($('#modal'));
                    tblsurvey.ajax.reload(null,true);  
                    block(false,'#form_publish');
                 $('#savefrm').attr("disabled", false); 
                }else{
                  swal({
                                        title: "Information",
                                        animation: false,
                                        type: "error",
                                        text: data.pesan,
                                        confirmButtonText: "OK"
                                    });
                  block(false,'#form_publish');
                  $('#savefrm').attr("disabled", false); 
                }
                
                // alert(event.Pesan);
                
              
              },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                }
            });
      }

});
   function loaddata(){
        // alert('test');
        var form = $('#modal').data('form');
        var publish_id = $('#modal').data('publish_id');
        var line_no = $('#modal').data('line_no');
        publish_id = publish_id;
        // console.log(publish_id);
        if (form=='Edit') {
        $("#txttitle").attr("disabled", "disabled");
        // $("#txtPublish").attr("disabled", "disabled");
        // $("#txtExpired").attr("disabled", "disabled");
        $.getJSON("<?php echo base_url('c_publish_survey/getByID');?>" + "/" + publish_id , function (data) {
          var dd = new Array();
          // console.log(data.length);
          for(var i = 0; i<data.length; i++){
          dd[i] = data[i].survey_id;
          // dd[1] = data[1].survey_id;
          }
          
          $('#txtsubject').val(dd).trigger("change");
          $("#txttitle").val(data[0].title);
         var tgl_Publish =  data[0].publishdate;
         var tgl_Expired =  data[0].expireddate;
         //  var date = new Date(parseInt(a2.substr(0,10)));
          var year =tgl_Publish.substr(0,4);
          var month=tgl_Publish.substr(5,2);
          var day =tgl_Publish.substr(8,2);

          var year1 =tgl_Expired.substr(0,4);
          var month2=tgl_Expired.substr(5,2);
          var day3 =tgl_Expired.substr(8,2);
                     
          var Ptgl = day+"/"+month+"/"+year;
          var Etgl = day3+"/"+month2+"/"+year1;
          // $("#txtPublish").val(Ptgl);
          // $("#txtExpired").val(Etgl);
          $("#txtPublish").datepicker('setDate',new Date(tgl_Publish));
          $("#txtExpired").datepicker('setDate',new Date(tgl_Expired));
          

        })

        }
      }
 
    
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $('div.modal-body').html("");
        $(this).removeData();

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