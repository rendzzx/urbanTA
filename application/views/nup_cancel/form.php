<!-- <link rel="stylesheet" type="text/css" href="<?=//base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
 -->
 <form role="form" class="form" id="form_cancel">
            <div class="form-body">
              <div class="form-group">                
                <label class="col-sm-3">NUP No.</label>
                <div class="col-sm-3">
                  <select class="select2 form-control" name="nupno" id="nupno" data-placeholder="Select NUP No.">
                  <option value=""></option> 
                  <?php echo $comboNonup; ?>
                  </select>                  
                </div>
                <label class="col-sm-2" id="nuptype" name="nuptype"></label>
                <input type="text" id="nupcd" name="nupcd" hidden/>               
                <!-- <div class="col-sm-3">
                  <select class="chosen-select form-control" name="nuptype" id="nuptype" data-placeholder="Select NUP Type"><?php // echo $comboTnup ?></select>                  
                </div> -->
              </div>

              <div class="form-group">
                <label class="col-sm-3">Tanggal NUP / NUP Date</label>
                <div class="col-sm-3">
                  <input class="form-control" name="rsvdate" id="rsvdate" readonly>
                </div>
                <label class="col-sm-2">Jumlah / Amount</label>
                <div class="col-sm-3">
                  <input class="form-control" name="amt" id="amt" readonly>
                  <input type="hidden" class="form-control" name="nupseq" id="nupseq">
                  <input type="hidden" class="form-control" name="businessid" id="businessid">
                  <input type="hidden" class="form-control" name="trx" id="trx">
                  <input type="hidden" class="form-control" name="bankcd" id="bankcd">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Nama / Name</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="customer" id="customer"  readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Nama Bank / Bank Name</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="bankname" id="bankname" placeholder="Input Bank Name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">No Rekening Bank / <br> Bank Account No.</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="bacctno" id="bacctno" placeholder="Input Bank Account Number">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Nama Pemegang Rekening / <br> Bank Account Name</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="bacctname" id="bacctname" placeholder="Input Bank Account Name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Tanggal Batal / Cancel Date</label>
                <div class="col-sm-3">
                  <input class="form-control" name="canceldate" id="canceldate" value="<?php echo($today)?>" readonly>
                </div>
                <label class="col-sm-2">Alasan Batal / <br>Cancel Reason</label>
                <div class="col-sm-3">
                  <select class="form-control select2" name="reason" id="reason" data-placeholder="Select Reason"><?php echo $comboCReason ?></select>                  
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Keterangan / Remarks</label>                
                <div class="col-sm-8">
                  <!-- <input type="text" class="form-control" name="remark" id="remark" placeholder="Input Remark"> -->
                  <textarea class="form-control" name="remark" id="remark" placeholder="Input Remark"></textarea>
                </div>
              </div>
              

                <div class="form-group">
                  <label class="col-sm-3"></label>
                  <div class="col-sm-8">
                    <!-- <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/*" />
                    </span> -->
                    <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <table>
                          <tr>
                            <td rowspan="2">
                      <div class="fileinput-new thumbnail" style="width: 130px; height: 127px;">
                        <img src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 130px; max-height: 127px;"></div>
                      <div>
                          </td>                            
                            <td style="padding-left: 20px; font-size:11px;">Please Download NUP Cancel Form</td>                            
                          </tr>
                          <tr>                            
                            <td style="padding-left: 20px;">
                              <!-- <button name="download" id="download" class="btn bg-orange btn-sm fa fa-download"> Download Nup<br>Cancel Form </button> -->
                              <a type="button" href="<?php echo base_url('c_reserve_nup_cancel/download')?>/CANCELLATION_FORM.pdf" class="btn bg-orange btn-sm fa fa-download" target="_blank">Download Nup<br>Cancel Form</a>
                            </td>
                          </tr>                          
                        </table> 
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select picture</span><span class="fileinput-exists">Change</span><input type="file" id="userfile" name="userfile" accept="image/*"></span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                      </div>
                    </div>
                    <!-- end of fileupload -->
                  </div>
                </div>                
            </div>
            <!-- <div class="box-footer pull-right"> -->
              <!-- <button class="btn btn-primary" type="button" id="btnSimpan" onClick="validasi()"><i ></i> Save</button> -->
              <input type="button" name="submit" id="submit" value="Submit" class="btn btn-primary">
              <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-default">
            <!-- </div> -->
          </form>

<script type="text/javascript">
function replaceAll(str, find, replace)
{
  return str.replace(new RegExp(find, 'g'), replace);
}

function formatNumber(data) 
{
  if(data==null){
    data =0;
  }
  // alert(data);
  return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");

}
</script>
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



<!-- <div class="content-wrapper">
<div id="loader" class="loader" hidden="false"></div> -->
<!-- <div id="loader" hidden="false"></div> -->
 <!--  <section class="row border-bottom white-bg dashboard-header" style="padding-top: 5px;">
    <div class="form-group">
      <div class="tittle-top pull-left">
        <b><?php // echo $project; ?></b><br>
        <b><?php // echo($agent->agent_name)?></b> 
      </div>
      <div class="tittle-top pull-right"><b>Cancel NUP</b></div> -->
    
      
   <!--  </div>    
  </section><br><br> -->
<!--   <section class="wrapper wrapper-content">
    <div class="row">
      <div class="col-sm-12">
        <div class="ibox-content">
        <br> -->
          <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_cancel" method ="POST" >
            <div class="form-body">
              <div class="form-group">                
                <label class="col-sm-3">NUP No.</label>
                <div class="col-sm-3">
                  <select class="select2 form-control" name="nupno" id="nupno" data-placeholder="Select NUP No.">
                  <option value=""></option> 
                  <?php echo $comboNonup; ?>
                  </select>                  
                </div>
                <label class="col-sm-2" id="nuptype" name="nuptype"></label>
                <input type="text" id="nupcd" name="nupcd" hidden/>               
                <!-- <div class="col-sm-3">
                  <select class="chosen-select form-control" name="nuptype" id="nuptype" data-placeholder="Select NUP Type"><?php // echo $comboTnup ?></select>                  
                </div> -->
              </div>

              <div class="form-group">
                <label class="col-sm-3">Tanggal NUP / NUP Date</label>
                <div class="col-sm-3">
                  <input class="form-control" name="rsvdate" id="rsvdate" readonly>
                </div>
                <label class="col-sm-2">Jumlah / Amount</label>
                <div class="col-sm-3">
                  <input class="form-control" name="amt" id="amt" readonly>
                  <input type="hidden" class="form-control" name="nupseq" id="nupseq">
                  <input type="hidden" class="form-control" name="businessid" id="businessid">
                  <input type="hidden" class="form-control" name="trx" id="trx">
                  <input type="hidden" class="form-control" name="bankcd" id="bankcd">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Nama / Name</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="customer" id="customer"  readonly>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Nama Bank / Bank Name</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="bankname" id="bankname" placeholder="Input Bank Name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">No Rekening Bank / <br> Bank Account No.</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="bacctno" id="bacctno" placeholder="Input Bank Account Number">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Nama Pemegang Rekening / <br> Bank Account Name</label>                
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="bacctname" id="bacctname" placeholder="Input Bank Account Name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Tanggal Batal / Cancel Date</label>
                <div class="col-sm-3">
                  <input class="form-control" name="canceldate" id="canceldate" value="<?php echo($today)?>" readonly>
                </div>
                <label class="col-sm-2">Alasan Batal / <br>Cancel Reason</label>
                <div class="col-sm-3">
                  <select class="form-control select2" name="reason" id="reason" data-placeholder="Select Reason"><?php echo $comboCReason ?></select>                  
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3">Keterangan / Remarks</label>                
                <div class="col-sm-8">
                  <!-- <input type="text" class="form-control" name="remark" id="remark" placeholder="Input Remark"> -->
                  <textarea class="form-control" name="remark" id="remark" placeholder="Input Remark"></textarea>
                </div>
              </div>
              

                <div class="form-group">
                  <label class="col-sm-3"></label>
                  <div class="col-sm-8">
                    <!-- <span class="btn btn-success fileinput-button">
                            <span>Select Picture...</span>
                            <input type="file" id="userfile" name="userfile" accept="image/*" />
                    </span> -->
                    <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                      <table>
                          <tr>
                            <td rowspan="2">
                      <div class="fileinput-new thumbnail" style="width: 130px; height: 127px;">
                        <img src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="...">
                      </div>
                      <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 130px; max-height: 127px;"></div>
                      <div>
                          </td>                            
                            <td style="padding-left: 20px; font-size:11px;">Please Download NUP Cancel Form</td>                            
                          </tr>
                          <tr>                            
                            <td style="padding-left: 20px;">
                              <!-- <button name="download" id="download" class="btn bg-orange btn-sm fa fa-download"> Download Nup<br>Cancel Form </button> -->
                              <a type="button" href="<?php echo base_url('c_reserve_nup_cancel/download')?>/CANCELLATION_FORM.pdf" class="btn bg-orange btn-sm fa fa-download" target="_blank">Download Nup<br>Cancel Form</a>
                            </td>
                          </tr>                          
                        </table> 
                        <span class="btn btn-default btn-file"><span class="fileinput-new">Select picture</span><span class="fileinput-exists">Change</span><input type="file" id="userfile" name="userfile" accept="image/*"></span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                      </div>
                    </div>
                    <!-- end of fileupload -->
                  </div>
                </div>                
            </div>
            <div class="box-footer pull-right">
              <!-- <button class="btn btn-primary" type="button" id="btnSimpan" onClick="validasi()"><i ></i> Save</button> -->
              <input type="button" name="submit" id="submit" value="Submit" class="btn btn-primary">
              <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-default">
            </div>
          </form>
<!--         </div>
      </div>
    </div>
  </section> -->

  <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>
 
 <script type="text/javascript">
 var jqXHRData;
 var isFile=false;
 // $(".select2").select2({ width: '100%'});
 $(".select2").select2({
            allowClear: false,
            multiple: false,
            tags: true,
            width:'100%'
            // ...other settings,
            // ajax: {
            //         ...  
            // }
        }).on("change", function (e) {
            $(this).valid(); //jquery validation script validate on change
        }).on("select2:open", function() { //correct validation classes (has=*)
            if ($(this).parents("[class*='has-']").length) { //copies the classes
                var classNames = $(this).parents("[class*='has-']")[0].className.split(/\s+/);

                for (var i = 0; i < classNames.length; ++i) {
                    if (classNames[i].match("has-")) {
                        $("body > .select2-container").addClass(classNames[i]);
                    }
                }
            } else { //removes any existing classes
                $("body > .select2-container").removeClass (function (index, css) {
                    return (css.match (/(^|\s)has-\S+/g) || []).join(' ');
                });            
            }
        }

      );

       // $("#nuptype").change(function() {
       //    $("#amt").val('');
       //    $("#rsvdate").val('');
       //    $("#customer").val('');
       //    var NupType = $(this).find(':selected').val();    

       //    if(NupType !=='') {
       //      var site_url = '<?php echo base_url("c_reserve_nup_cancel/cbNUP")?>';
       //      $.post(site_url,
       //        {NupType:NupType},
       //        function(data,status) {
       //          $("#nupno").empty();
       //          $("#nupno").append(data);
       //          $("#nupno").trigger('chosen:updated');
       //        }
       //      );
       //    } else {
       //      $("#nupno").empty();
       //    }
       //  });

      $("#amt").inputmask('#,##0',{reverse:true,maxlength:false});

       $("#nupno").change(function() {

          var NupNo = $(this).find(':selected').val();    

          if(NupNo !=='') {
            var site_url = '<?php echo base_url("c_reserve_nup_cancel/NUPno")?>';
            $.post(site_url,
              {nupno:NupNo},
              function(data,status) {
                // console.log(data[0].nup_amt);
                $("#amt").empty();
                // $("#amt").val(formatNumber(data[0].nup_amt));
                 if(data[0].nup_amt!=null){
                  $("#amt").val(formatNumber(data[0].nup_amt));
                }

                $("#rsvdate").empty();
                var m_names = new Array("Jan", "Feb", "Mar", 
                                        "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
                                        "Oct", "Nov", "Dec");
                var d = new Date(data[0].reserve_date);
                var date = d.getDate();
                var month = d.getMonth();
                var year = d.getFullYear();
                var dt = date + " " + m_names[month]+ " " + year;
                $("#rsvdate").val(dt);
                $("#nupseq").val(data[0].nup_sequence_no);
                $("#businessid").val(data[0].business_id);
                $("#trx").val(data[0].trx_type);
                $("#bankcd").val(data[0].bank_cd);
                $("#customer").val(data[0].name);
                $('#nuptype').text(data[0].descs);
                $('#nupcd').val(data[0].nup_type);

              },
              "json"
            );
          }
        });


       //nuptype,nupno,customer,bankname,bacctno,bacctname,canceldate,reason,remark
    // $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
    $('#form_cancel').validate({
      ignore: "",
      rules: {
        // nuptype: { required: true},
        nupno:{required: true},
        customer: {required: true},
        bankname: {required: true},
        bacctno: {required: true},
        bacctname: {required: true},
        canceldate: {required: true},
        reason: {required: true},
        // agtype: {required: true},
        remark: {required: true},
        Picture: {required: true}        
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
          } else if (element.hasClass('select2')) {
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
      // errorPlacement: function(error, element){
      //   error.addClass("help-block  text-red");
      //   element.parents(".col-xs-5").addClass("has-feedback  text-red");
      //   if (element.prop("type") === "checkbox") {
      //       error.insertAfter(element.parent("label"));
      //   } else {
      //       error.insertAfter(element);
      //   }

      //   if (!element.next("span")[0]) {
      //       $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 90%' ></span>").insertAfter(element);
      //   }
      // },
      // success: function(label, element){
      //   if (!$(element).next("span")[0]) {
      //       $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 90%'></span>").insertAfter($(element));
      //   }
      // },
      // highlight: function(element, errorClass, validClass){
      //   $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
      //   $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
      // },
      // unhighlight: function(element, errorClass, validClass){
      //   $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
      //   $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
      // }
    });

     $('#userfile').fileupload({
            url: "<?php echo base_url('c_reserve_nup_cancel/saveFile');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;
                // console.log(isFile);
                
            },
            done: function (event, response) {

                var res = response.result;
                // console.log(event);
                // console.log(response);
                console.log(res);

                // BootstrapDialog.alert(res.Pesan);
                // alert('aa');
                document.getElementById('loader').hidden=true;
                
                // BootstrapDialog.alert(res.pesan, function(result){
                //                 if(result) {
                //                     window.location.href="<?php echo base_url('c_reserve_nup_cancel/index')?>";
                //                 }
                //             });
                

             

            },
            fail: function (event, response) {
              document.getElementById('loader').hidden=true;
                // BootstrapDialog.alert(response.result.Pesan);
                // swal('Warning',response.result.Pesan,'warning');
                 swal({
                                          title: "Error",
                                          animation: false,
                                          type:"error",
                                          text: data.Msg,
                                          confirmButtonText: "OK"
                                        });
                
            }
        });

// $('#submit').click(function(){      
//       if($('#form_cancel').valid())
//       {
//         document.getElementById("submit").disabled = true;
//         document.getElementById("loader").hidden=false;

//          var nupamt = $('#amt').val();
//          var amount = replaceAll(nupamt, ',', '');
        
//         var dataform = $('#form_cancel').serializeArray();
//         dataform.push({name:"amount",value:amount},
//                       {name:"isFile",value:isFile}
//                       );

       
       
//         var site_url = "<?php echo base_url('c_reserve_nup_cancel/savecancel')?>";

//         if(isFile){
//                   // alert('sukses Picture');
//                   if(jqXHRData){
//                     jqXHRData.formData = dataform;
//                     jqXHRData.submit();
                    
//                   }
//                 }else{
//                        $.ajax({
//                           url: site_url,
//                           type: "POST",
//                           data: dataform,
//                           dataType: "json",
//                           success: function(data, status){

                            
//                            document.getElementById('loader').hidden=true; 
                           
//                             BootstrapDialog.alert(data.pesan, function(result){
//                                 if(result) {
//                                     window.location.href="<?php echo base_url('c_reserve_nup_cancel/index')?>";
//                                 }
//                             });
//                           },
//                           error: function(jqXHR, textStatus, errorThrown){
//                             BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
//                           }
//                         });
//                   }
       
//       }
//     });

$('#submit').click(function(){    
      if($('#form_cancel').valid())
      {
       swal({
          title: "Submit Cancel NUP",
          text: "Are you sure you want to submit Cancel NUP?",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes",
          closeOnConfirm: false
        },
        function(){
          document.getElementById("submit").disabled = true;
          document.getElementById("loader").hidden=false;

          var nupamt = $('#amt').val();
          var amount = replaceAll(nupamt, ',', '');
          var nuptype = $('#nuptype').text();
                    // alert(nuptype);
                    // return;
                    
          var dataform = $('#form_cancel').serializeArray();
          dataform.push({name:"amount",value:amount},
                        {name:"isFile",value:isFile},
                        {name:"nuptype",value:nuptype}
                      );     
          var site_url = "<?php echo base_url('c_reserve_nup_cancel/savecancel')?>";

                     $.ajax({
                              url: site_url,
                              type: "POST",
                              data: dataform,
                              dataType: "json",
                              success: function(data, status){
                                        
                                  document.getElementById('loader').hidden=true;
                                        // alert('sesudah'); 
                                  console.log(data);
                                        
                                  if(data.Status=='OK'){
                                    swal({
                                      title: "Information",
                                      animation: false,
                                      text: data.Msg,
                                      type: "success",
                                      confirmButtonText: "OK"
                                    },
                                    function(){
                                      window.location.href="<?php echo base_url('c_reserve_nup_cancel/index')?>";
                                    });
                                     
                                    } else { 
                                        swal({
                                          title: "Error",
                                          animation: false,
                                          type:"error",
                                          text: data.Msg,
                                          confirmButtonText: "OK"
                                        });
                                        //   BootstrapDialog.show({
                                        //   type: BootstrapDialog.TYPE_DANGER,
                                        //   title: 'Error',
                                        //   message: data.Msg,
                                        //   buttons: [{
                                        //     label: 'OK',
                                        //     action: function(dialogItself){
                                        //     dialogItself.close();
                                        //     }
                                        //    }]
                                        // });
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

        });
      }

});


$("#userfile").on('change', function () {

            $("#Picture").val(this.files[0].name);
            readURL(this);
            var dataform = $('#form_cancel').serializeArray();
            var nupno = $('#nupno').val();
            dataform.push({name:"Nup_No",value:nupno}); 
            jqXHRData.formData = dataform;
            jqXHRData.submit();
            // alert($("#Picture").val());

        });

        function readURL(input) {

            if (input.files && input.files[0])
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#picturebox').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);

            }
        }
  $('#btnback').click(function(){
    
    // var project = "<?php echo $project_no?>";
    // var projectName = "<?php echo $project; ?>";
     
    window.location.href="<?php echo base_url('c_reserve_nup_cancel/index');?>";

    });

  $('#download').click(function(){
    window.location.href="<?php echo base_url('c_reserve_nup_cancel/download')?>/CANCELLATION_FORM.pdf";
    // alert('download');
  });
 </script>
  


