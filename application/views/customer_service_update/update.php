
      
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('js/plugins/bootstrap-datetime/bootstrap-datetimepicker.min.js')?>"></script> 

 <link href="<?=base_url('css/plugins/bootstrap-datetime/bootstrap-datetimepicker.min.css')?>" rel="stylesheet">

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
<style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
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
.label-blue {
    background-color: #1a7bb9;
    color: #FFFFFF;
}

</style>


<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
  <div class="row border-bottom white-bg dashboard-header"> 
  <!-- <div id="loader" class="loader" hidden="true"></div>  -->
    <div class="form-group">
      <div class="tittle-top pull-left"><b>            


      </b></div>
      <div class="tittle-top pull-left"><?php echo $ProjectDescs; ?></div>
      <div class="tittle-top pull-right">
          Customer Service Status Update
      </div>
    </div>        
  </div>
  <div class="wrapper wrapper-content" >
    <div class="row">
      <div class="col-xs-12">
        <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_cs_update" method="POST" >
          <div class="ibox-content">

            <div class="form-group">
              <label class="col-sm-3">Ticket No</label>
              <div class="col-sm-3" style="color:#870000">
                <!-- <input type="text" class="form-control" name="debtor_name" id="debtor_name" value="<?php echo date('d M Y H:i:s');?>" style="border:none; background-color:white;" readonly="true" > -->
                <?php echo $data_cs[0]->report_no?>
              </div>
               <label class="col-sm-1">Status</label>
              <div class="col-sm-3">
                <?php 
                    $st = $data_cs[0]->status;
                    $warna = '';
                    $descs = '';
                                if($st=='M'){
                                    $warna = 'label label-primary';
                                    $descs = 'Modify';
                                }else if($st=='A'){
                                    $warna = 'label label-warning';
                                    $descs = 'Assign';
                                }else if($st=='S'){
                                    $warna = 'label label-primary';
                                    $descs = 'Survey';
                                }else if($st=='P'){
                                    $warna = 'label label-blue';
                                    $descs = 'Prosess';
                                }
                     $stt = '<span class="'.$warna.'">'.$descs.'</span>';
                    echo $stt;
                ?>
              </div>
            </div>
                        
            <div class="form-group">
              <label class="col-sm-3">Customer Name </label>
              <div class="col-sm-3">
          
                <?php echo $data_cs[0]->name?>
              </div>
              <label class="col-sm-1">Reported</label>
              <div class="col-sm-3">
                <?php 
                $dd = new Datetime($data_cs[0]->reported_date);
                echo date_format($dd,'d/m/Y H:i');?>
              </div>
              <!-- <label class="col-sm-1">Staff</label>  
              <div class="col-sm-3">
                <select class="form-control select2" name="ddstaff" id="ddstaff" data-placeholder="Select Staff">
                    <option value=""></option>                    
                  </select>   
              </div> -->
            </div>

            <div class="form-group">
              <label class="col-sm-3">Work Request</label>                
              <div class="col-sm-7">
                  <textarea class="form-control" placeholder="Input Action Taken" name="workreq" id="workreq" style=" height: 60px;align-content: sleft !important;" readonly="true"><?php echo $data_cs[0]->work_requested;?>
                  </textarea>
              </div>
              
            </div>
          
            <div class="form-group">
              <!-- <label class="col-sm-3">Status</label>                
              <div class="col-sm-3">
                <select class="form-control select2" name="ddstatus" id="ddstatus" data-placeholder="Select Status">
                    <option value=""></option>
                    <option value="X">Cancel</option>
                    <option value="P">Prosses</option>
                    <option value="M">Modify</option>
                    <option value="F">Confirm</option>
                  </select>   
              </div> -->
              <label class="col-sm-3">Staff <FONT COLOR="RED">*</FONT></label>  
              <div class="col-sm-7">
                <select class="form-control select2" name="ddstaff" id="ddstaff" data-placeholder="Select Staff">
                    <option value=""></option>                    
                  </select>   
              </div>
            </div>

           <!--  <div class="form-group">
              <label class="col-sm-3">Date Completed</label>                
              <div class="col-sm-3">
                
                  <div class='input-group date' id='dtcompleted'>
                    <input type='text' class="form-control" placeholder="dd/MM/yyyy hh:mm" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>

              </div>
              <label class="col-sm-1">Process Date</label>  
              <div class="col-sm-3">
              
                  <div class='input-group date' id='dtproces'>
                    <input type='text' class="form-control" placeholder="dd/MM/yyyy hh:mm"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-sm-3">Category <FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                  <select class="form-control select2" name="ddcategory" id="ddcategory" data-placeholder="Select Category">
                    <option value=""></option>                    
                  </select> 
              </div>
            <!--   <label class="col-sm-1">Start</label>  
              <div class="col-sm-3">
                  <div class='input-group date' id='dtstart'>
                    <input type='text' class="form-control" placeholder="dd/MM/yyyy hh:mm"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
              </div> -->
            </div>
            <div class="form-group">
              <label class="col-sm-3">Problem Caused <FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                  <textarea class="form-control" placeholder="Input Problem Caused" name="problemacoused" id="problemacoused" style=" height: 50px;"></textarea>
              </div>

            </div>

              

            <div class="form-group">
              <label class="col-sm-3">Action Taken</label>                
              <div class="col-sm-7">
                  <textarea class="form-control" placeholder="Input Action Taken" name="actionTaken" id="actionTaken" style=" height: 50px;"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Action Taken<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
              <?php //echo $st;
               if($st =='A'){

                     echo "<label><input id='S' name='action' class='control-form' type='radio' value='S' checked/> Survey</label>&emsp;<label><input id='F' name='action' class='control-form' type='radio' value='F' /> Problem Solved</label>";

                  } else if($st=='S') {
                      echo "<label><input id='P' name='action' class='control-form' type='radio' value='P' checked/> Process</label>&emsp;<label><input id='F' name='action' class='control-form' type='radio' value='F' /> Problem Solved</label>";
                  } 

                  ?>
              </div>
            </div>
            <div id="problem">
                <div class="form-group">
                  <label class="col-sm-3">Complete Date</label>                
                  <div class="col-sm-7">
                      <input type="text" class="form-control" name="complete_date" id="complete_date" value="<?php echo date('d M Y H:i:s');?>" style="border:none; background-color:white;" readonly="true" >
                  </div>
                </div>
            </div>
            <div id="survey">
               <div class="form-group">
                  <label class="col-sm-3">Survey Date</label>                
                  <div class="col-sm-7">
                     <input type="text" class="form-control" name="survey_date" id="survey_date" >
                  </div>
                </div>
            </div>
            <div id="proses">
               <div class="form-group">
                  <label class="col-sm-3">Start Date</label>                
                  <div class="col-sm-7">
                     <input type="text" class="form-control" name="start_date" id="start_date" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3">Estimation Date</label>                
                  <div class="col-sm-7">
                     <input type="text" class="form-control" name="est_completion_date" id="est_completion_date" >
                  </div>
                </div>
            </div>
      
           
            <div class="form-group">
              <label class="col-sm-3">Remarks</label>                
              <div class="col-sm-7">
                  <textarea class="form-control" placeholder="Input Remarks" name="remarks" id="remarks" style=" height: 50px;"></textarea>
              </div>
            </div>
            <div class="form-group">
             

                        <input type="hidden" id="Picture" name="Picture"  readonly="readonly" />
                        <input type="hidden" id="seqno" name="seqno"  readonly="readonly"/>
                   <!-- </div> -->
                   <label class="col-sm-3">Upload Picture</label>
                    <div class="col-sm-7">
                        <!-- <img id="picturebox" width="118" src="<?=base_url('img/PlProject/no_poto.jpg')?>" alt="Your Image" /> -->
                        <div id="inputfile" class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i> 
                                <span class="fileinput-filename" id="pictname"></span>
                            </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                    <span class="fileinput-new">Select file</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" id="userfile" name="userfile" accept="image/*">
                                </span>
                                <!-- <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                        </div>
                    </div>
                </div>

              <div class="form-group">
              <label class="col-sm-3">Signature</label>                
              <div class="col-sm-7" id="divpict">
                 <img id="picturebox" width="118" src="<?=base_url('img/no_poto.jpg')?>" alt="Your Image" onclick="fn_showSignature()"/>
              </div>
              <input type="hidden" class="form-control" name="txt_sign" id="txt_sign" placeholder="">
            </div>

          </div>
          <div class="box-footer">
            <input type="button" name="submit" id="submit" value="Submit" class="btn btn-primary">
            <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-default">
          </div>
        </form>
      </div> 



    </div>
  </div>     
</div>

<!-- Bootstrap Modal -->
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
  $('.select2').select2();
var staff = '<?php echo $data_cs[0]->assign_to;?>';
var Category  = '<?php echo $data_cs[0]->category_cd;?>';
var site_url = '<?php echo base_url("C_customer_service_update/zoom_staff")?>';
            $.post(site_url,
              {staff:staff},
              function(data,status) {
                  // console.log(data);
                $("#ddstaff").empty();
                $("#ddstaff").append(data);
                // $("#ddstaff").trigger('chosen:updated');
                $("#ddstaff").trigger('change');
              }
            );
$(document).ready(function(){
  var status = "<?php echo $st?>";
  $('#survey_date').datetimepicker({
        format: 'dd/mm/yyyy hh:ii',
    });
  $('#est_completion_date').datetimepicker({
        format: 'dd/mm/yyyy hh:ii',
    });
  $('#start_date').datetimepicker({
        format: 'dd/mm/yyyy hh:ii',
    });

  if(status=='A') {
     if (document.getElementById('F').checked) { 
          $("#survey").hide();
          $("#proses").hide();
          $("#problem").show();
          
    } else if(document.getElementById('S').checked){
            $("#survey").show();
            $("#proses").hide();
            $("#problem").hide();
    }
  } else if(status=='S'){
    if (document.getElementById('F').checked) { 
          $("#proses").hide();
          $("#survey").hide();
          $("#problem").show();
          
    } else if(document.getElementById('P').checked){
        
        $("#problem").hide();
        $("#survey").hide();
        $("#proses").show();
    }
  }

    
    $('input[type="radio"]').on('click change',function(e){
       if(status=='A') {
         if (document.getElementById('F').checked) { 
              $("#survey").hide();
              $("#proses").hide();
              $("#problem").show();
              
        } else if(document.getElementById('S').checked){
                $("#survey").show();
                $("#proses").hide();
                $("#problem").hide();
        }
      } else if(status=='S'){
        if (document.getElementById('F').checked) { 
              $("#proses").hide();
              $("#survey").hide();
              $("#problem").show();
              
        } else if(document.getElementById('P').checked){
            
            $("#problem").hide();
            $("#survey").hide();
            $("#proses").show();
        }
      }
   });
});
// alert(staff);
  // // $('#datetimepicker').datetimepicker();

  

  // $('#dtproces').datetimepicker({
  //       format: 'dd/mm/yyyy hh:ii',
       
  //   });
  //  $('#dtstart').datetimepicker({
  //       format: 'dd/mm/yyyy hh:ii',
       
  //   });
  //   $('#dtcompleted').datetimepicker({
  //       format: 'dd/mm/yyyy hh:ii',
       
  //   });
  

            

             var site_url = '<?php echo base_url("C_customer_service_update/zoom_category")?>';
            $.post(site_url,
              {Category:Category},
              function(data,status) {

                $("#ddcategory").empty();
                $("#ddcategory").append(data);
                $("#ddcategory").trigger('change');
              }
            );

// $('#ddstaff').val(staff).trigger('chosen:updated');
// $('#ddstaff').select2('data', staff);

    $('#form_cs_update').validate({
      ignore: "",
      rules: {
        problemacoused: { required: true},
        ddstaff: {required: true},
        ddcategory:{required: true}
        // ,txt_sign:{required: true}
      },
      messages: {cntfile: {attached: "Upload file need to completed"},
                npwp: { cek_npwp: "NPWP is not valid"},
                noktp: {check_noktp: " IC No. Is not valid"},
                HP: {cek_telp: "Handphone number is not valid"} 
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

   
      $('#userfile').fileupload({
            url: "<?php echo base_url('C_customer_service_update/save');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;    
                // alert('ssss');            
            },
            done: function (event, response) {

                var res = response.result;
                console.log(res);
                // console.log(response.);
                // BootstrapDialog.alert();
                if(res.status =='OK'){
                    swal({
                            title: "Information",
                            animation: false,
                            type:"success",
                            text: res.pesan,
                            confirmButtonText: "OK"
                          },function(){
         
                            window.location.href="<?php echo base_url('C_customer_service_update');?>"
                        });
                    $('#modal').modal('hide');
                }else{
                     swal({
                            title: "Warning",
                            animation: false,
                            type:"error",
                            text: res.pesan,
                            confirmButtonText: "OK"
                          });
                }
                        

                // $('[data-id=' + id + ']').remove();
                
                

            },
            fail: function (event, response) {
                // BootstrapDialog.alert(response.result.Pesan);
                var error = response["_response"]["errorThrown"];
                // console.log(event);
                swal({
                    title: "Warning",
                    animation: false,
                    type:"error",
                    text: error,
                    confirmButtonText: "OK"
                          });
            }
        });

    $('#submit').click(function(){
      // var dataform = $('#form_cs_update').serializeArray();
      // console.log(dataform);
      var sign = $('#txt_sign').val();
      if(!sign){
        swal('Warning','Please Signature','warning');
        return;
      }

      if($('#form_cs_update').valid())
      {
        document.getElementById('loader').hidden=false;
        // document.getElementById("submit").disabled = true;
        // document.getElementById('loader').hidden=false;

        var dataform = $('#form_cs_update').serializeArray();
        
        dataform.push(
                        {name:"rowID",value:'<?php echo $data_cs[0]->rowID?>'},
                        {name:"isFile",value:isFile}
                      );
        if(isFile){
          jqXHRData.formData = dataform;
                    jqXHRData.submit();
                    isFile = false;
        }else{
            var site_url = "<?php echo base_url('C_customer_service_update/save')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: dataform,
          dataType: "json",
          success: function(data, status){

           document.getElementById('loader').hidden=true; 
        

            if(data.status =='OK'){
                  swal({
                    title: "Information",
                    text: data.pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){
            document.getElementById('loader').hidden=true;
                    window.location.href="<?php echo base_url('C_customer_service_update');?>"
                  });
                } else {
                  swal({
                    title: "Error",
                    text: data.pesan,
                    type: "error",
                    confirmButtonText: "OK"
                  });
                }

          },
          error: function(jqXHR, textStatus, errorThrown){
            document.getElementById('loader').hidden=true; 
            document.getElementById("submit").disabled = false;
            swal(textStatus+' Save : '+errorThrown);
          }
        })


        }      
        
      }

    });

    $('#btnback').click(function(){
        document.getElementById('loader').hidden=true;
      window.location.href="<?php echo base_url('C_customer_service_update');?>";
    });

    function fn_showSignature(){
       var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                        }

                        $('#modalTitle').html('Signature');
                        $('div.modal-body').load("<?php echo base_url("C_customer_service_update/addsignature");?>");
                        $('#modal').data('debtor_acct', '<?php echo $data_cs[0]->debtor_acct?>');
                        $('#modal').data('name', '<?php echo $data_cs[0]->name?>');
                        $('#modal').data('MenuID', 0).modal('show');
    }

 
  </script> 
</div>
