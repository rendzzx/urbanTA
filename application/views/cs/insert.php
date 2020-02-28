




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
.hr-line-solid{
  border: 0;
  border-top: 3px double #8c8c8c;
}
label {
  text-align: right;
}
.has-error .select2-selection {
  border: 1px solid #a94442;
  border-radius: 4px;
}
</style>

<script type="text/javascript">

    var observe;
    if (window.attachEvent) {
        observe = function (element, event, handler) {
            element.attachEvent('on'+event, handler);
        };
    }
    else {
        observe = function (element, event, handler) {
            element.addEventListener(event, handler, false);
        };
    }
    function init () {
        var text = document.getElementById('remarks');
        function resize () {
            text.style.height = 'auto';
            text.style.height = text.scrollHeight+'px';
        }
        /* 0-timeout to get the already changed text */
        function delayedResize () {
            window.setTimeout(resize, 0);
        }
        observe(text, 'change',  resize);
        observe(text, 'cut',     delayedResize);
        observe(text, 'paste',   delayedResize);
        observe(text, 'drop',    delayedResize);
        observe(text, 'keydown', delayedResize);

        text.focus();
        text.select();
        resize();
    }
</script>


<div class="content-wrapper">
  <div class="row border-bottom white-bg dashboard-header"> 
  <div id="loader" class="loader" hidden="true"></div>
  <div class="tittle-top pull-right">Customer Service Entry</div> 
    <!-- <div class="form-group"> -->
 <div class="tittle-top pull-left"><?php echo $ProjectDescs; ?></div>
      
   <!--    <div class="form-group">
        <label for="pl_project" class="control-label" style="padding-left:0px;"> Choose Project</label> -->
        <!-- <div class="col-sm-10"> -->
         <!--  <select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="select2" style="width:250px;" tabindex="2">
            <option value=""></option>
            <?php echo $cbProject;?>   
            
          </select> -->
          
        <!-- </div> -->

    <!-- </div> -->
    <!-- </div>         -->
  </div>
  <div class="wrapper wrapper-content" >
    <div class="row">
      <div class="col-xs-12">
        <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method="POST" >
          <div class="ibox-content">
            <div class="form-group">
              <label class="col-sm-3">Ticket Date</label>
              <div class="col-sm-7">
              <?php echo date('d M Y H:i:s');?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Name<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-7">
                <!-- <input type="text" class="form-control " name="debtor_name" id="debtor_name" value="<?php echo $dtcust[0]->name?>" style="border:none; background-color:white;" readonly="true" > onchange="GetDebtor(this)"-->
                <select class="form-control select2" name="debtor_name" id="debtor_name" data-placeholder="Select Debtor." >
                <option value=""></option>
                <?php echo $dtdebtor?>
                </select>
              </div>
            </div>
            <!-- <input type="hidden" name="debtor_acct" id="debtor_acct" value="<?php echo $dtcust[0]->debtor_acct?>"> -->
            <!-- <input type="hidden" name="report_no" id="report_no" value="<?php echo 'jkjk'?>"> -->
              <!-- <input type="hidden" name="serv_req_by" id="serv_req_by" value="<?php echo $dtcust[0]->name?>"> -->
            <div class="form-group" >
               <label class="col-sm-3">Contact No.<FONT COLOR="RED">*</FONT></label>
               <div class="col-sm-7">                
                <input type="text" class="form-control " name="contact_no" id="contact_no">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Lot No.<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-7">
                <select class="form-control select2" name="lotno" id="lotno" data-placeholder="Select Lot No.">
                <option value=""></option>
                </select>
              </div>
            </div>
     
            <div class="form-group">
              <label class="col-sm-3">Floor</label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="floor" id="floor" placeholder="Input Floor">
              </div>
            </div>
         
            <div class="form-group">
              <label class="col-sm-3">Location Type<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-7">

              <select class="form-control col-sm-7 select2" name="loc_type" id="loc_type" data-placeholder="Select Location Type">
              <option value=""></option>
              <option value="U">Unit</option>
              <option value="P">Public Area</option></select> 
                
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-3">Category<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                <select class="form-control select2" name="category" id="category" data-placeholder="Select Category">
                <option value=""></option></select>   
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3">Work Request<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                  <textarea class="form-control" placeholder="Input Work Request" name="work_req" id="work_req" style=" height: 50px;"></textarea>
              </div>
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

  $('#debtor_name').prop("disabled",<?php echo $ddx;?>);
  var no = '<?php echo $ddno;?>';
  $('#contact_no').val(no);
  $('.select2').select2({ width: '100%' });
  $('#loc_type').change(function(){
        var prod = $(this).find(':selected').val();  

          if(prod !=='') {

            var site_url = '<?php echo base_url("c_customer_service/zoom_category")?>';
            $.post(site_url,
              {prod:prod},
              function(data,status) {
                // console.log(data);
                $("#category").empty();
                $("#category").append(data);
                $("#category").trigger('chosen:updated');
              }
            );

          } else {
            $("#category").empty();
          }
        
    });
  $('#lotno').change(function(){
        var prod = $(this).find(':selected').val();
        if(prod!==''){
           var site_url = '<?php echo base_url("c_customer_service/zoom_floor")?>';
            $.post(site_url,
              {prod:prod},
              function(data,status) {
                // console.log(data);
                $("#floor").val(data);
              }
            );

        }
           
    });


    $('#form_nup').validate({
      ignore: "",
      rules: {
        contact_no: { required: true
        },
        lotno: {required: true},
        loc_type:{required: true},
        work_req:{required: true},
        category:{required:true}
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

   


    $('#submit').click(function(){
      
      if($('#form_nup').valid())
      {
        // document.getElementById("submit").disabled = true;
        document.getElementById('loader').hidden=false;
        var project = $('#txtProject').val();
        var dataform = $('#form_nup').serializeArray();
         dataform.push({name:"project_no",value:project});
        
        // console.log(dataform);
       
        var site_url = "<?php echo base_url('c_customer_service/save')?>";
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
         
                    window.location.href="<?php echo base_url('c_customer_service/insert');?>"
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
        });
      }
    });

    $('#btnback').click(function(){


    });

    function GetDebtor(data){
      console.log(data);
      console.log(data.value);
      console.log(data.dataset);
      // console.log(data.data-telp);
      var debtor_acct = data.value;
      $('#floor').val("");
      if(debtor_acct!=='') {
            var site_url = '<?php echo base_url("C_customer_service/zoom_lot_no")?>';
            $.post(site_url,
              {debtor_acct:debtor_acct},
              function(data,status) {
                // console.log(data);
                $("#lotno").empty();
                $("#lotno").append(data);
                $("#lotno").trigger('change');
              }
              );
          } else {
            $("#lotno").empty();
          }
    }

    $("#debtor_name").change(function() {
    // Pure JS
    
    var debtor_acct = this.value;
    var telp = this.options[this.selectedIndex].dataset.telp;
    console.log(this.options[this.selectedIndex].dataset);
    $('#floor').val("");
      if(debtor_acct!=='') {
            var site_url = '<?php echo base_url("C_customer_service/zoom_lot_no")?>';
            $.post(site_url,
              {debtor_acct:debtor_acct},
              function(data,status) {
                // console.log(data);
                $("#lotno").empty();
                $("#lotno").append(data);
                $("#lotno").trigger('change');
              }
              );
          } else {
            $("#lotno").empty();
          }

      $('#contact_no').val(telp);
    // var selectedVal = this.value;
    // var selectedText = this.options[this.selectedIndex].text;

    // // jQuery
    // var selectedVal = $(this).find(':selected').val();
    // var selectedText = $(this).find(':selected').text();
});
 
  </script> 
</div>
