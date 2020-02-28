<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>


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

  input { 
    text-transform: uppercase;
  }
  ::-webkit-input-placeholder { /* WebKit browsers */
    text-transform: none;
  }
  :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    text-transform: none;
  }
  ::-moz-placeholder { /* Mozilla Firefox 19+ */
    text-transform: none;
  }
  :-ms-input-placeholder { /* Internet Explorer 10+ */
    text-transform: none;
  }

  textarea{
   text-transform: uppercase;
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
    <div class="form-group">
      <div class="tittle-top pull-left"><b>            
        <?php echo $project; ?><br>
        <?php echo($agent->agent_name)?>
      </b></div>
      <!-- <div class="tittle-top pull-right"><b><?php if($status=='N'){echo 'ADD ROI Entry '.$phase->descs;}else{echo 'EDIT ROI Entry '.$phase->descs;} ?></b></div> -->
      <!-- <div class="tittle-top pull-right"><b><?php if($status=='N'){ if($Type=='P'){echo 'ADD ROI Entry Prioritas';}else{echo 'Prospect Entry';}}else{if($Type=='P'){echo 'Edit ROI Entry Prioritas';}else{echo 'Edit ROI Entry Regular';}} ?></b></div> -->
      <!-- <div class="tittle-top pull-right"><b><?php if($status=='N'){ if($Type=='P'){echo 'ADD ROI Entry Prioritas';}else{echo 'Prospect Entry';}}else{if($Type=='P'){echo 'Edit ROI Entry Prioritas';}else{echo 'Edit ROI Entry Regular';}} ?></b></div> -->
    </div>        
  </div>
  <div class="wrapper wrapper-content" >
    <div class="row">
      <div class="col-xs-12">
        <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
          <div class="ibox-content">            
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama / Name<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-3">
                <select class="select2_demo_1 form-control col-sm-2" name="salutation" id="salutation" data-placeholder="Select Salutation">                  
                  <option></option>
                  <option value="MR.">MR.</option>
                  <option value="MRS.">MRS.</option>
                  <option value="MS.">MS.</option> 
                </select>
              </div>
              <div class="col-sm-4">                  
                <input type="text" class="form-control col-sm-5" name="customer" id="customer" placeholder="Input Name">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Sumber / Source<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-3">
                <select class="select2_demo_1 form-control col-sm-2" name="media" id="media" data-placeholder="Select Media"> <?php echo $comboMedia ?> </select>
              </div>
              <div class="col-sm-4">                  
                <input type="text" class="form-control col-sm-5" name="media_detail" id="media_detail" placeholder="Input Media Detail">
              </div>
            </div>              
            <div class="form-group">
              <label class="col-sm-3 control-label">HP / Mobile<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-3">
                <select class="select2_demo_1 form-control" name="country_cd" id="country_cd" data-placeholder="Select Country"><?php echo $comboCountry ?></select>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="HP" id="HP" data-inputmask="'mask':'999999999999'" placeholder="8xxxxxxxxxx">
                Format: 21995500 | 89895098987
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Email<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="Email" id="Email" placeholder="Input Email">
              </div>
            </div>            
            <div class="form-group">
              <label class="col-sm-3 control-label">Kota / City<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                <select class="select2_demo_2 form-control"  name="city" id="city" data-placeholder="Select City"><?php// echo $comboCity;?></select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Kategori / Category<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="category" id="category" data-placeholder="Select Category"><?php echo $comboCategory;?></select>
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="col-sm-3 control-label">Customer Type<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="customer_type" id="customer_type" data-placeholder="Select Marital Status">
                  <option></option>
                  <option value="E">End User</option>
                  <option value="I">Investor</option>
                </select>
              </div>
            </div> -->
           <!-- s -->
            <div class="form-group">
              <label class="col-sm-3 control-label">Property yg dimiliki  / Owned Unit</label>
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control col-sm-2" name="unit_qty" id="unit_qty" data-placeholder="Select Unit Qty">                  
                  <option></option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option> 
                  <option value="4">4</option> 
                </select>
              </div>            
            </div>
            <!-- <div class="form-group">
              <label class="col-sm-3 control-label">Tujuan Pembelian Unit /<br>Reason to buy unit</label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="buy_unit_reason" id="buy_unit_reason" data-placeholder="Select Reason to buy"><?php echo $comboType;?></select>
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-sm-3 control-label">Alasan BELI Lavon /<br>Reason to buy Lavon</label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="buy_lavon_reason" id="buy_lavon_reason" data-placeholder="Select Reason to Lavon"><?php echo $comboReason;?></select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Alasan TIDAK BELI Lavon /<br>Reason to not buy Lavon</label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="nb_lavon_reason" id="nb_lavon_reason" data-placeholder="Select Reason to not buy Lavon"><?php echo $reason_nb;?></select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Cara Pembayaran ROI /<br>Payment Method</label>
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control col-sm-2" name="payment_method" id="payment_method" data-placeholder="Select Payment Method">                  
                  <option></option>
                  <option value="1">CASH</option>
                  <option value="2">CICIL</option>
                  <option value="3">KPR</option> 
                </select>
              </div>               
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Usia / Age</label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="age" id="age" data-placeholder="Select Age"><?php echo $comboAge?></select>
              </div>
            </div>           
            <div class="form-group">
              <label class="col-sm-3 control-label">Status Pernikahan /<br>Marital Status</label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="marital_status" id="marital_status" data-placeholder="Select Marital Status">
                  <option></option>
                  <option value="N">BELUM MENIKAH</option>
                  <option value="Y">MENIKAH</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Pekerjaan / Occupation</label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="occupation" id="occupation" data-placeholder="Select Occupation">
                  <option></option>
                  <option value="1">WIRASWASTA</option>
                  <option value="2">KARYAWAN SWASTA</option>
                  <option value="3">PEGAWAI NEGERI</option>
                </select>
              </div>
            </div>
            <div class="form-group" hidden="hiddens">
              <label class="col-sm-3 control-label">Penghasilan Perbulan /<br>Monthly Income</label>                
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="monthly_income" id="monthly_income" data-placeholder="Select Monthly Income"><?php echo $comboIncome;?></select>
              </div>              
            </div>
            <!-- <input type="hidden" name="prefix" id="prefix"> -->
            <input type="hidden" name="business_id" id="business_id">
            <!-- <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>"> -->
            <!-- <input type="hidden" name="seqno" value="<?php echo $seqno;?>" id="seqno"> -->
            <input type="hidden" name="status" id="status" value="<?php echo $status;?>">
            <!-- <input type="hidden" name="cntfile" id="cntfile" value="<?php echo $cnt?>"> -->            
          </div>
          <div class="box-footer">
            <input type="button" name="submit" id="submit" value="Save" class="btn btn-primary pull-right">&nbsp;
            <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-default pull-right">
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
        <button type="button" class="close" data-dismiss="modal" style="display: none;">
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

// $(document).ready(function(){     
//     document.getElementById('remarks').style.visibility = 'hidden';
// });

 
  
  var bussID=0;
  function setNUPType(Id,product){
        // alert(Id);
        // alert(product);
        var site_url = '<?php echo base_url("c_nup_cfld/chosen_nup_type")?>';
        $.post(site_url,
          {Id:Id,product:product},
          function(data,status) {
            $("#nuptype").empty();
            $("#nuptype").append(data);
            $("#nuptype").trigger('change');
          }
          );
      }
    function setLocation(Id){

      var site_url = '<?php echo base_url("c_nup/chosen_location")?>';
      $.post(site_url,
        {Id:Id},
        function(data,status) {
          $("#Location").empty();
          $("#Location").append(data);
          $("#Location").trigger('change');
        }
        );
    }
    function setcountrycd(Id){

      var site_url = '<?php echo base_url("c_nup/chosen_country")?>';
      $.post(site_url,
        {Id:Id},
        function(data,status) {
          $("#country_cd").empty();
          $("#country_cd").append(data);
          $("#country_cd").val(Id).trigger('change');
        }
        );
    }

    function setpayment(Id){

      var site_url = '<?php echo base_url("c_nup/chosen_payment")?>';
      $.post(site_url,
        {Id:Id},
        function(data,status) {
          $("#payment").empty();
          $("#payment").append(data);
          $("#payment").trigger('change');
        }
        );
    }
    function setcity(Id){

      var site_url = '<?php echo base_url("c_nup/chosen_city")?>';
      $.post(site_url,
        {Id:Id},
        function(data,status) {
          $("#city").empty();
          $("#city").append(data);
          $("#city").trigger('change');
        }
        );
    }

    function setsalutation(Id){

      var site_url = '<?php echo base_url("c_nup/chosen_salutation")?>';
      $.post(site_url,
        {Id:Id},
        function(data,status) {
          $("#salutation").empty();
          $("#salutation").append(data);
          $("#salutation").val(Id).trigger('change');
        }
        );
    }

    function setnationality(Id){

      var site_url = '<?php echo base_url("c_nup/chosen_nationality")?>';
      $.post(site_url,
        {Id:Id},
        function(data,status) {
          $("#nationality").empty();
          $("#nationality").append(data);
          $("#nationality").trigger('change');
                // console.log($("#noktp").val());
              }
              );
    }

    function Loaddata(){
      var status = '<?php echo $status;?>';

    if(status !='N'){
      var ID = '<?php echo $rowID;?>';
      // alert(status);

      var site_url = '<?php echo base_url("c_prospect_cfld/show_edit_data")?>'+'/'+ID;

      // alert(status);
      $.getJSON(site_url, function (data) {                
        console.log(data);        
        
        var Handphone = data[0].handphone;
        var country_cd = Handphone.substring(0,3);//data[0].country_code;
        var telp = Handphone.substring(3,Handphone.length);
        // var payment = data[0].type;
                // console.log(payment);
                $('#salutation').val(data[0].salutation).trigger('change');
                $('#customer').val(data[0].name);   
                $('#media').val(data[0].media_cd).trigger('change');
                $('#media_detail').val(data[0].prospect_media_detail);   
                setcountrycd(country_cd);          
                $('#HP').val(telp);
                $('#Email').val(data[0].email_addr);
                setcity(data[0].prospect_city);
                $('#category').val(data[0].prospect_category_cd).trigger('change');
                $('#unit_qty').val(data[0].prospect_qty_property).trigger('change');
                $('#buy_unit_reason').val(data[0].prospect_type).trigger('change');
                $('#buy_lavon_reason').val(data[0].prospect_reason).trigger('change');
                $('#payment_method').val(data[0].prospect_payment).trigger('change');
                $('#age').val(data[0].prospect_age).trigger('change');
                $('#marital_status').val(data[0].marital_status).trigger('change');
                $('#occupation').val(data[0].prospect_occupation).trigger('change');
                $('#monthly_income').val(data[0].income_cd).trigger('change');               
                $('#business_id').val(data[0].business_id);
                $('#nb_lavon_reason').val(data[0].reason_nb_cd).trigger('change');
                // $('#customer_type').val(data[0].customer_type).trigger('change');
                // $('#remarks').val(data[0].remarks);

                // var category = data[0].prospect_category_cd;

                // if (category != 'C'){
                //   document.getElementById('lblremarks').hidden=true;        
                //   document.getElementById('remarks').style.visibility = 'hidden';
                // }else{
                //   document.getElementById('lblremarks').hidden=false;        
                //   document.getElementById('remarks').style.visibility = 'visible';
                // }


               
          });            
}  
    
  }

  
  // $(".select2").select2();

  var table;
  var ids;
  var descss;
 
  
  Loaddata();
   

    $(function() {
    


$(".select2_demo_1").select2();

$(".select2_demo_2").select2({
  ajax:{
    url: '<?php echo base_url("c_nup/chosen_city_")?>',
    dataType: 'json',
    type: 'post',
    delay: 1000,
    data: function(params) {
      document.getElementById('loader').hidden=false;
      return{
        q: params.term
      };
    },
    processResults: function(data) {
              // console.log(data);
              document.getElementById('loader').hidden=true;
              return{
                results: data
              };
            },
            cache: false            
          },
          minimumInputLength: 3,
          placeholder: 'Type a city'          
        });

});



              $.validator.addMethod("attached", function (value, element) {
                var isSuccess = false;
                var content = $('#cntfile').val();
        // alert(content);
        // console.log(content);
        if(content < 1) {
          isSuccess = true;
        } else {
          isSuccess = false;
        }
        return isSuccess;
      });
              $.validator.setDefaults(
                { ignore: ":hidden:not(#cntfile)" },
                { ignore: ":hidden:not(.chosen-select)" }
                );

              $.validator.addMethod("cek_npwp", function (value, element) {
                var isSuccess = false;
                var npwp = $('#npwp').val();

            // alert(content.length);
            // if(content==null||content =='' && youtubelink == null||youtubelink=='' && picture ==null || picture ==''){
              if(npwp.length == 0){
                isSuccess=true;
              }else if(npwp.length > 20 || npwp.length < 20  ){
                // isSuccess=true;
                // alert('pict ='+picture.length+' yt '+youtubelink.lenght+ ' content '+content.lenght);
              }else{
                isSuccess=true;

                 // alert(picture.lenght);
               }
            // alert(isSuccess);
            return isSuccess;

          });

  

$.validator.addMethod("cek_telp", function (value, element) {
  var isSuccess = false;
  var Stext = $('#HP').val()
  var Sawal = value.charAt(0);
  // console.log(Stext);

  if(Sawal == 0){

  }else{
    isSuccess = true;
  }              

  return isSuccess;

});

    // $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
    $('#form_nup').validate({
      ignore: "",
      rules: {
        customer: { 
          required: true,
          maxlength:60
        },
        HP:{
          required: true,
          number:true,
          maxlength:12,
          cek_telp: true
        },
        Email:{
          required: true,
          email:true,
          maxlength:60
        },
        // noktp: {required: true,
        // check_noktp: true},
        address:{
          required: true,
          maxlength:255
        },
        salutation :{required: true},
        city: {required: true},
        npwp: {cek_npwp: true},
        // nuptype: {required: true},
        nupdesc: {required: true},
        rsvdate: {required: true},
        rsvby: {required: true},

        grpcd: {required: true},
        category: {required: true},
        nupamt: {required: true},
        type: {required: true},
        // phase: {required: true},
        // seqno: {required: true},
        bankcd: {required: true},
        country_cd:{required: true},
        Location:{required: true}
        // customer_type:{required:true}
        // ,cntfile: {attached: true}
      },
      messages: {
        cntfile: {attached: "Upload file need to completed"},
        npwp: { cek_npwp: "NPWP is not valid"},
                // noktp: {check_noktp: " IC No. Is not valid"},
        HP: {cek_telp: "Handphone number is not valid"} 
        // HP: {cek_telp: swal("Warning","Warning","warning");}
      },
      errorElement: "em",
      errorPlacement: function(error, element){
        error.addClass("help-block  text-red");
        element.parents(".col-xs-5").addClass("has-feedback  text-red");
        if (element.prop("type") === "checkbox") {
          error.insertAfter(element.parent("label"));
        } else {
          error.insertAfter(element);
          // console.log('not cb');
          // swal('Warning',error[0].textContent,'warning');
        }
        // console.log(error);
        if (!element.next("span")[0]) {
          $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 90%' ></span>").insertAfter(element);
        }
      },
      success: function(label, element){
        if (!$(element).next("span")[0]) {
          $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 90%'></span>").insertAfter($(element));
        }
      },
      highlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
        $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
      },
      unhighlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
        $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
      }
    });  //end #form_nup validate




// $('#category').change(function(){
//       var category = $(this).find(':selected').val();
//       if (category != 'C'){
//         document.getElementById('lblremarks').hidden=true;        
//         document.getElementById('remarks').style.visibility = 'hidden';
//       }else{
//         document.getElementById('lblremarks').hidden=false;        
//         document.getElementById('remarks').style.visibility = 'visible';
//       }
      
//     });


$('#submit').click(function(){


      if($('#form_nup').valid()){
        // document.getElementById("submit").disabled = true;
        document.getElementById('loader').hidden=false;
        // var nup_id = $('#modal').data('nup_id');
        var ID = '<?php echo $rowID;?>';
        var datafrm = $('#form_nup').serializeArray();

        datafrm.push(
        {name:"rowID",value:ID}
        
      );
        // console.log(datafrm);
        // return;
        // datafrm.push({name:"nup_id",value:nup_id});
        // var obj = new Object();
        // obj.id = nup_id;
        
          $.ajax({
            url : "<?php echo base_url('c_prospect_cfld/save_prospect');?>",
              type:"POST",
              data: datafrm,//$('#form_nup').serialize(),
              dataType:"json",
              success:function(event, data){
                // document.getElementById('loader').hidden=true;
                if(event.Status=='OK'){
                  swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: event.pesan,
                    confirmButtonText: "OK"
                  },
                  function(){
                    window.location.href="<?php echo base_url('c_prospect_cfld/index');?>"
                  });
                  // $('#modal').modal('hide');
                  // tblnewsfeed.ajax.reload(null,true);
                  
                } else {                  
                  swal({
                    title: "Error",
                    animation: false,
                    type:"error",
                    text: event.pesan,
                    confirmButtonText: "OK"
                  });
                  document.getElementById('loader').hidden=true;             
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
                document.getElementById('loader').hidden=true;
              }
          });                
      }
    });


$('#btnback').click(function(){
  window.location.href="<?php echo base_url('c_prospect_cfld/index');?>";
});



</script> 
</div>
