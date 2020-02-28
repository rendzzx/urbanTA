<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<!-- <script src="<?=base_url('js/plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>  -->
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<!-- 
  <script type="text/javascript" src="<?=base_url('js/plugins/sweetalert/sweetalert.min.js')?>"></script> -->
<!-- 
  <script src="<?=base_url('js/plugins/inputmask/jquery.inputmask.bundle.min.js')?>"></script> -->



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
      <div class="tittle-top pull-left">           
        <?php echo $project; ?><br>
        <?php echo($agent->agent_name)?>
      </div>
      <!-- <div class="tittle-top pull-right"><b><?php if($status=='N'){echo 'ADD ROI Entry '.$phase->descs;}else{echo 'EDIT ROI Entry '.$phase->descs;} ?></b></div> -->
      <div class="tittle-top pull-right"><b><?php if($status=='N'){ if($Type=='P'){echo 'ADD ROI Entry Prioritas';}else{echo 'ADD ROI Entry Regular';}}else{if($Type=='P'){echo 'Edit ROI Entry Prioritas';}else{echo 'Edit ROI Entry Regular';}} ?></b></div>
    </div>        
  </div>
  <div class="wrapper wrapper-content" >
    <div class="row">
      <div class="col-xs-12">
        <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
          <div class="ibox-content">
            <div class="form-group">
              <label class="col-sm-3 control-label" id="lblunitNo" name="lblunitNo">Unit NO
                <?php if($status != 'N'){?><input type="button" id="change_unit" name="change_unit" value="Change Unit" class="btn btn-info btn-xs"><?php } ?>
              </label>                
              <div class="col-sm-7">
                <!-- <input type="text" class="form-control" name="unitNo" id="unitNo" placeholder="Unit No" value="<?php echo $unit_book; ?>" readonly> -->
                <input type="hidden" class="form-control" name="unitNo" id="unitNo" placeholder="Unit No">
                <label style="text-align: left;" class="control-label" id="unitDescs" name="unitDescs"><?php echo $LotDesc; ?></label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Prospective Customer</label>
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control col-sm-2" name="prospective" id="prospective" data-placeholder="Select Prospective"><?php echo $cbprospect; ?></select>
              </div>
            </div>
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
              <label class="col-sm-3 control-label">HP / Mobile<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-3">
                <select class="select2_demo_1 form-control" name="country_cd" id="country_cd" data-placeholder="Select Country"><?php echo $comboCountry; ?></select>
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
              <label class="col-sm-3 control-label">Nationality</label>
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control col-sm-2" name="nationality" id="nationality" data-placeholder="Select Nationality"><?php echo $cbnationality ?></select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" name="lblnoktp" id="lblnoktp">ID No.</label>
              <label class="col-sm-3 control-label" name="lblnopass" id="lblnopass" hidden="true">No. Passport / Passport No.</label>                 
              <div class="col-sm-7">
                <input type="text" class="form-control" name="noktp" id="noktp" placeholder="Input ID Number">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Alamat / Address<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                <textarea class="form-control" placeholder="Input Address" name="address" id="address" style=" height: 50px;"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Kota / City<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">
                <select class="select2_demo_2 form-control"  name="city" id="city" data-placeholder="Select City"><?php// echo $comboCity;?></select>
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">Customer Type<FONT COLOR="RED">*</FONT></label>                
                <div class="col-sm-7">
                  <select class="select2_demo_1 form-control" name="customer_type" id="customer_type" data-placeholder="Select Customer Type">
                    <option></option>
                    <option value="E">End User</option>
                    <option value="I">Investor</option>
                  </select>
                </div>
              </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" id="lblnpwp" name="lblnpwp">NPWP</label>                
              <div class="col-sm-7">
                <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Input NPWP">
              </div>
            </div>
            <!-- <div class="form-group" id="divproduct">
              <label class="col-sm-3 control-label">Product<FONT COLOR="RED">*</FONT></label>                
              <div class="col-sm-7">                 
                <?php
                foreach($product as $row)
                {
                  $var ='<label class="radio-inline">';
                  $var.=' <input type="radio" id="'.$row->product_cd.'" name="product" value="'.$row->product_cd.'" tabindex="-2" />'.$row->descs;
                  $var.=' </label>';
                  echo $var;
                }  
                ?>
              </div>
            </div> -->
            <!-- <div class="form-group" >
              <label class="col-sm-3  control-label">Property<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-7">                
                <select class="select2_demo_1 form-control" name="property" id="property" data-placeholder="Select Property"><option value="e"></option><?php //echo $comboTnup ?></select>
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label class="col-sm-3 control-label" id="lblunitNo" name="lblunitNo">Unit NO
                <?php if($status != 'N'){?><input type="button" id="change_unit" name="change_unit" value="Change Unit" class="btn btn-info btn-xs"><?php } ?>
              </label>                
              <div class="col-sm-7">                
                <input type="text" class="form-control" name="unitNo" id="unitNo" placeholder="Unit No" readonly>
              </div>
            </div> -->
            <!-- <div class="form-group">
              <label class="col-sm-3 control-label" id="lblunitDescs" name="lblunitDescs">Unit Description</label>                
              <div class="col-sm-7">                
                <label class="control-label" id="unitDescs" name="unitDescs"><?php echo $LotDesc; ?></label>
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-sm-3 control-label">Tipe ROI / ROI Type<FONT COLOR="RED">*</FONT>
                <input type="button" value="More Info" onclick="nuptypeinfo(1);" class="btn btn-info btn-xs">
              </label>
              <div class="col-sm-3" >
                <!-- <select class="select2_demo_1 form-control" name="nuptype" id="nuptype" data-placeholder="Select NUP Type"><option value=""></option> --><!-- <?php echo $comboTnup ?> --><!-- </select> -->
                <select class="select2_demo_1 form-control" name="nuptype" id="nuptype" data-placeholder="Select ROI Type"><?php echo $cbroitype ?></select>
              </div>

            </div>
            <!--  <div class="form-group">
              <label class="col-sm-3 control-label">Tipe ROI</label>
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control col-sm-2" name="roitype" id="roitype" data-placeholder="Select ROI Type"><?php echo $cbroitype ?></select>
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-sm-3 control-label" id="lblRoiqty" name="lblRoiqty">ROI Qty / Amount</label>                
              <div class="col-sm-3">
                <!-- <input type="text" class="form-control" name="Roiqty" id="Roiqty" placeholder="ROI Qty" value="<?php echo $UnitQty; ?>" readonly> -->
                <input type="text" class="form-control" name="Roiqty" id="Roiqty" placeholder="ROI Qty"readonly>
              </div>
              <div class="col-sm-4">
                <input class="form-control" name="nupamt" id="nupamt" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" id="lblRoiamt" name="lblRoiamt">Total ROI Amount</label>                
              <div class="col-sm-7">
                <input type="text" class="form-control" name="Roiamt" id="Roiamt" placeholder="Total ROI Amount" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal ROI / ROI Date</label>
              <div class="col-sm-7">
                <input class="form-control" name="rsvdate" id="rsvdate" value="<?php echo($today)?>" disabled="1">
              </div>
            </div>
            <!-- <div class="form-group" >
              <label class="col-sm-3 control-label">Lokasi launcing yang dipilih /<br>Preffered launching location<FONT COLOR="RED">*</FONT>
                <input type="button" value="More Info" onclick="nuptypeinfo(0);" class="btn btn-info btn-xs">
              </label>
              <div class="col-sm-7">
                <select class="select2_demo_1 form-control" name="Location" id="Location" data-placeholder="Select Location"><?php echo $comboLocation; ?></select>                  
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-sm-3 control-label">Upload Document</label>
              <div class="col-sm-7">
                <input type="hidden" name="prefix" id="prefix">
                <input type="hidden" name="headerid" id="headerid">
                <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>">
                <input type="hidden" name="seqno" id="seqno" value="<?php echo $seqno;?>" >
                <input type="hidden" name="status" id="status" value="<?php echo $status;?>">
                <input type="hidden" name="cntfile" id="cntfile" value="<?php echo $cnt?>">
                <table id="tblattach" class="display table-striped" cellspacing="0" width="100%">
                  <thead>            
                    <th >No</th>
                    <th width="50%">Criteria</th>
                    <th width="40%">Preview</th>
                    <th >Upload</th>
                    <!-- <th >Download</th> -->
                  </thead>
                  <tbody>
                  </tbody>
                </table>                  
              </div>                
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Cara Pembayaran ROI /<br>Payment Method</label>
              <div class="col-sm-3">
                <select class="select2_demo_1 form-control" name="payment" id="payment" data-placeholder="Select Payment Method"><?php echo $payment; ?></select>                  
              </div>
              <div class="col-sm-4">
                <input class="form-control" name="remarkspayment" id="remarkspayment" placeholder="">
              </div>
            </div>
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
  var bussID=0;
  

    $("#payment").change(function(){
    var payment = $(this).find(':selected').val();
    var a = $('#seqno').val();
    console.log(payment);
    console.log(a);

    if(payment!='') {
      var site_url = '<?php echo base_url("c_nup_cfld/setPayment") ?>';
      $.post(site_url,
        {act:payment,bct:a},
        function(data,status){
          console.log(data);
          if(data.remarks!='') {
            $('#remarkspayment').attr('placeholder', data.remarks);
            if(data.pesan=='0'){
              $('#remarkspayment').val('');
            } else {
              $('#remarkspayment').val(data.values);
            }
          } else {
            swal('Please define NUP Type for this project');
              // console.log('salah');
            }
          },
          'json'
          );
    } 
      // else {
        // console.log('nuptype empty');
      // }
      // $("#txt_debtor").val(lot);
    });
  function nuptypeinfo(status)
  {
    // alert(status);
    var modalClass = $('#modal').attr('class');
    switch (modalClass) {
      case "modal fade bs-example-modal-md":
      $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
      break;
      case "modal fade bs-example-modal-sm":
      $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
      break;
      default:
      $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
      break;
    }

    var modalDialogClass = $('#modalDialog').attr('class');
    switch (modalDialogClass) {
      case "modal-dialog modal-md":
      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
      break;
      case "modal-dialog modal-sm":
      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
      break;
      default:
      $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
      break;
    }

    if(status == 1){
      $('#modalTitle').html('NUP Type Information');  
    }else{
      $('#modalTitle').html('Preffered launching location');  
    }

    $('div.modal-body').load("<?php echo base_url("c_nup/showinfo");?>/"+ status);

    $('#modal').modal('show');
  }

  
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
    // function setProperty(Id,prod){

    //     var site_url2 = '<?php echo base_url("c_nup/zoom_property_edit")?>';
    //         $.post(site_url2,
    //           {prod:prod,Id:Id},
    //           function(data,status) {
    //             $("#property").empty();
    //             $("#property").append(data);
    //             $("#property").trigger('change');
    //           }
    //         );
    // }
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
    $("#prospective").change(function(){
    var pros = $(this).find(':selected').val();
    var a = $('#seqno').val();
    bussID = pros;
    // console.log(pros);
    // console.log(a);
    // alert(pros);
    if(payment!='') {

      var site_url = '<?php echo base_url("c_nup_cfld/get_pros_dt")?>'+'/'+pros;
    
      $.getJSON(site_url, function (data) {  
        bussID = data[0].business_id;
        var Handphone = data[0].hand_phone;
        var telp = Handphone.substring(country_cd.length,Handphone.length);
                $('#salutation').val(data[0].salutation).trigger('change');

                $('#customer').val(data[0].name);                
                $('#HP').val(telp);
                $('#Email').val(data[0].email_addr);
                setcity(data[0].prospect_city);
                // alert(data[0].prospect_city);
      }); 
         
        } 
   
    });

    function Loaddata(){
      var status = '<?php echo $status;?>';
      var seqno = "<?php echo $seqno;?>";
      var unit_book = '<?php echo $unit_book; ?>';
      var UnitQty = '<?php echo $UnitQty; ?>';
      var unit_book_edit = '<?php echo $unit_book_edit; ?>';
      var UnitQty_edit = '<?php echo $UnitQty_edit; ?>';
    // var LotDesc = '<?php echo $LotDesc; ?>';    
    // $('#unitDescs').text(LotDesc);

    if(unit_book_edit==''){
      $('#unitNo').val(unit_book);
      $('#Roiqty').val(UnitQty);
    }else{
      $('#unitNo').val(unit_book_edit);
      $('#Roiqty').val(UnitQty_edit);
    }

    // console.log(status);
    if(status !='N'){
      var ID = '<?php echo $rowID;?>';
      
      // alert(status);

      var site_url = '<?php echo base_url("c_nup_cfld/show_edit_data")?>'+'/'+ID;

      // alert(status);
      $.getJSON(site_url, function (data) {                
        console.log(data);
        var m_names = new Array("Jan", "Feb", "Mar", 
          "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
          "Oct", "Nov", "Dec");
        var d = new Date(data[0].reserve_date);
        var curr_date = d.getDate();
        var curr_month = d.getMonth();
        var curr_year = d.getFullYear();
        var dt = curr_date + " " + m_names[curr_month]+ " " + curr_year;
        var country_cd = data[0].country_code;
        var Handphone = data[0].Handphone;
        var telp = Handphone.substring(country_cd.length,Handphone.length);
        var payment = data[0].type;
                // console.log(payment);

                $('#customer').val(data[0].NAME);                
                $('#HP').val(telp);
                $('#Email').val(data[0].Email);
                // $('#noktp').val(data[0].Id_No);
                $('#address').val(data[0].ADDRESS);
                
                $('#npwp').val(data[0].NPWP);
                setNUPType(data[0].nup_type,data[0].product_cd);
                $('#nupdesc').val(data[0].rl_reserve_descs);
                $('#rsvdate').val(dt);
                // $('#rsvname').val(data[0].agent_name);
                // setProperty(data[0].product_type,data[0].product_cd);
                // document.getElementById(data[0].product_cd).checked = true;
                $('#rsvname').text(data[0].agent_name);
                $('#rsvgroup').val(data[0].agentype);
                $('#rsvtype').val(data[0].group_name);
                $('#rsvby').val(data[0].reserve_by);
                $('#grpcd').val(data[0].group_cd);
                $('#agtype').val(data[0].agent_type_cd);
                setcountrycd(country_cd);
                $('#nupamt').val(formatNumber(data[0].nup_amt));
                setpayment(payment);

                // console.log(data[0].payment_type_remarks);
                $('#remarkspayment').val(data[0].payment_type_remarks);
                setLocation(data[0].location_cd);
                $('#remarks_nup').val(data[0].remarks_nup);
                $('#prefix').val(data[0].prefix);
                $('#remarks').val(data[0].remarks_nup);
                
                // console.log(data[0].ic_no);
                // console.log($('#noktp').val());
                $('#address').val(data[0].Address);
                bussID = data[0].business_id;
                $('#salutation').val(data[0].salutation).trigger('change');

                setnationality(data[0].nationality);
                setcity(data[0].city);
                var nation = data[0].nationality;
                // alert(nation);
                $('#noktp').val(data[0].ic_no);
                $('#headerid').val(data[0].HeaderID);
                $('#Roiamt').val(formatNumber(data[0].total_nup_amt));



                // console.log(data[0].city);
                if (nation != 01){
                  document.getElementById('lblnoktp').hidden=true;
                  document.getElementById('lblnopass').hidden=false;
                  document.getElementById('lblnpwp').hidden=true;        
                  document.getElementById('npwp').style.visibility = 'hidden';
                  // $('#noktp').val('');
                }else{
                  document.getElementById('lblnoktp').hidden=false;
                  document.getElementById('lblnopass').hidden=true;
                  document.getElementById('lblnpwp').hidden=false;        
                  document.getElementById('npwp').style.visibility = 'visible';

              // $('#noktp').val('');
            }
          });
            // );
}
    // else{
    //   var location_cd = "<?php echo($agent->location_cd)?>";
    //   if(location_cd==null || location_cd==''){
    //     location_cd="";
    //   }
    //   setLocation(location_cd);
    // }
    // alert(location_cd);
    
  }

  
  // $(".select2").select2();

  var table;
  var ids;
  var descss;
  var type_roi = '<?php echo $Type;?>';
  
  if(type_roi=='R'){
    $('#nuptype').val('ROI');  
  }else{
    $('#nuptype').val('ROP');
  }
  
  Loaddata();
    // var config = {
    //   '.chosen-select'           : {},
    //   '.chosen-select-deselect'  : {allow_single_deselect:true},
    //   '.chosen-select-no-single' : {disable_search_threshold:10},
    //   '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
    //   '.chosen-select-width'     : {width:"95%"}
    // }
    // $(".chosen-select").chosen({ width: '100%'});
    // for (var selector in config) {
    //   $(selector).chosen(config[selector]);
    // }

    $(function() {
      var form = "<?php echo $form;?>";
      if (form == "edit")
      {
        // document.getElementById('divproduct').style.display = 'none';
      }
      // $("#nuptype").click(function() {
      //   // $('input:radio[name="product"]:checked')
      //   if (! $("input:radio[name='product']").is(':checked') ) {

      //   }
      //   else {
      //     BootstrapDialog.alert('Please choose product');
      //   }

      // });
$("#npwp").inputmask({
  mask: "99.999.999.9-999.999"
});
      // $('#npwp').inputmask({"99.999.999.9-999.999"});
      // $("#noktp").inputmask("AAAAAAAAAAAAAAAA");
      // $("#HP").inputmask({
      //   mask: "999999999999"
      // });
      // $("#HP").inputmask({
      //   mask: "999999999999"
      //   });

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

$('input:radio[name="product"]').change(function(){

        // console.log('tes');
        var prod = $(this).val();    
          // alert(prod);
          if(prod !=='') {
            $('#nupamt').val('');
            var site_url = '<?php echo base_url("c_nup/zoom_nuptype")?>';
            $.post(site_url,
              {prod:prod},
              function(data,status) {
                $("#nuptype").empty();
                $("#nuptype").append(data);
                $("#nuptype").trigger('chosen:updated');
              }
              );
            var site_url2 = '<?php echo base_url("c_nup/zoom_property")?>';
            $.post(site_url2,
              {prod:prod},
              function(data,status) {
                $("#property").empty();
                $("#property").append(data);
                $("#property").trigger('chosen:updated');
              }
              );
          } else {
            $("#nuptype").empty();
          }

        });


      // $("#HP").inputmask("Regex", { regex: "[0-9]+$" });

      table = $('#tblattach').DataTable({
        dom: 'Bfrtip',
        select: true,
        info: false,
        lengthChange: false,
        ordering: false,
        searching: false,
        paging: false,
        processing: true,
        serverSide: true,
        // responsive: true,
        "scrollX": true,
        ajax:{
          url:"<?php echo base_url('c_nup_cfld/getTableAttach')?>",
          data:{"seqno": function(d){
            var a = $('#seqno').val();
            return a;
          }},
            // "data":{"pl_project": function(d){
              type:"POST"
            },
            buttons:[
            {
              text: ' Upload File Pictures',
              className: 'fa fa-plus hidden',
              action: function(e){
                var rows = table.rows('.selected').indexes();
                if (rows.length < 1) {
                  swal('Please select a row');
                  return;
                }
                var data = table.rows(rows).data();
                var descs = data[0].descs;
                var rowID = data[0].rowID;
                var sn = $('#seqno').val();
                // console.log(sn);
                // console.log(data);
                var modalClass = $('#modal').attr('class');
                switch (modalClass) {
                  case "modal fade bs-example-modal-md":
                  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                  break;
                  case "modal fade bs-example-modal-sm":
                  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                  break;
                  default:
                  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                  break;
                }

                var modalDialogClass = $('#modalDialog').attr('class');
                switch (modalDialogClass) {
                  case "modal-dialog modal-md":
                  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                  break;
                  case "modal-dialog modal-sm":
                  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                  break;
                  default:
                  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                  break;
                }
                $('#modalTitle').html('<b>Add File</b>');
                // alert(rowID);
                $('div.modal-body').load("<?php echo base_url('c_nup_cfld/addNew');?>"); //+"/"+descs+"/"+rowID);
$('#modal').data('descs', descs);
$('#modal').data('sn', sn);
$('#modal').data('id', data).modal('show');
}
}
],
columns:[
{data: "row_number", name: "rowID"},
{data: "document_descs", name: "document_descs"},
{data: "file_attachment", name: "file_attachment",
                            render: function (data, type, row) {
                              // console.log(data);
                                if(data==null || data =='')
                                {
                                  return '';
                                } else {
                                  
                                  var url = "<?php echo base_url('img/ROI/')?>"+data;
                                  return '<img src="'+url+'" width="120px" class="img-responsive" alt="'+data+'">';  
                                }
                                
                                

                            }},
{
              // data: "rowID", name: "rowID", visible: false
              data: "rowID", name: "rowID",
              render: function (data, type, row) {
                var id = row.rowID;
                var descs =row.document_descs;
                var datas = new Array(id,descs);
                ids = id;
                descss = row.document_descs;
                var sn = $('#seqno').val();
                // return '<a class="btn btn-primary btn-sm" onclick="Loadfile('+id+');"" ><i class="fa fa-users fa-fw"></i> Browse File</a>';
                 // return '<form id="frmPic'+id+'" enctype="multipart/form-data" method="post" ><span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i><span class="hidden-xs"> Browse File...</span><input type="file" id="userfile'+id+'" name="userfile" accept="image/*" onchange="UploadImage('+id+',this)" required/></span><b>Max Size 10 MB.</b><input type="hidden" name="row" id="row" value="'+id+'"><input type="hidden" name="sn" id="sn" value="'+sn+'"></form>';
                 return '<span class="btn btn-success fileinput-button"><i class="fa fa-upload"></i><span class="hidden-xs"> Browse File...</span><input type="file" id="userfile'+id+'" name="userfile" accept="image/*" onchange="UploadImage('+id+',this)" /></span><b>Max Size 10 MB.</b><input type="hidden" name="row" id="row'+id+'" value="'+id+'"><input type="hidden" name="sn" id="sn'+id+'" value="'+sn+'">';


              }
            }
            // ,
            // {
            //    data: "rowID", name: "rowID", //visible: false
            //   // data: null, searchable:false,
            //                 render: function (data, type, row) {

            //                     var seqno = row.Header_sequence_no;
            //                     console.log(seqno);
            //                     var document_no = row.document_no;

            //                     return '<a class="btn btn-primary btn-sm" href=' +'<?php echo base_url("c_nup_cfld/downloadFile")?>'+'/'+seqno+'/'+document_no+'><i class="fa fa-download"></i> Download</a>';                                
            //                     // return 'data';

            //                 }
            // }
            ]
          });





var lot = $("#nuptype").find(':selected').val();
$("#nuptype").change();
});
function UploadImage(rowid,el){
        // console.log(el);
        document.getElementById('loader').hidden=false; 
        var a = el.files[0].size;
        var max = (1024 *1024) * 7;
        
        if (a > max){
  
            
            if (max.toString().length > 6) {
                max = max / 1024 / 1024;
                max = max.toFixed(2);
                max = max + ' mb';
            } else {
                max = max / 1024;
                max = max.toFixed(2);
                max = max + ' kb';
            }
            swal('Please upload less than ' + max);
            return false;
        }
     

        
        var datafrm = new FormData( $('#frmPic'+rowid)[0] );

        $.ajax({
                url : "<?php echo base_url('c_nup_cfld/saveUpload');?>",
                type:"POST",
                data: function () {
                    var data = new FormData();
                    data.append("row", $("#row"+rowid).val());
                    data.append("sn", $("#row"+rowid).val());
                    data.append("userfile", $("#userfile"+rowid).get(0).files[0]);
                    return data;
                }(),
                processData: false,
                contentType: false,
                dataType:"json",
                success:function(data, status){
                  console.log(data.pesan);
                if(data.status == "OK"){
                      swal({
                        title: "Information",
                        text: data.pesan,
                        type: "success",
                        confirmButtonText: "OK"
                      },
                      function(){
                        document.getElementById('loader').hidden=true; 
                        // readURL(el,rowid);
                         table.ajax.reload(null,true);

                        // window.location.href="<?php echo base_url('c_cs/insert');?>";
                      });
                    } else {
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      document.getElementById('loader').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                }
            });



}


   
    function readURL(input,rowid) 
    {
      // alert(id);
        if (input.files && input.files[0])
        {
          // alert(rowid);
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#picturebox'+rowid).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
function Download(rowID){
  // alert(rowID);
  // var data = table.rows(0).data();
  var file_attachment ;
  var seqno;
  var document_no;
  var rowcount = table.rows().count();
  for (var i = 0; i < rowcount ; i++) {
    var Id = table.rows(i).data()[0].rowID;
    if(Id==rowID){
      file_attachment = table.rows(i).data()[0].file_attachment;
      seqno = table.rows(i).data()[0].nup_sequence_no;
      document_no = table.rows(i).data()[0].document_no;
    }

  }
  if(file_attachment==null ||file_attachment==''){

    return;
  }
  var site_url = '<?php echo base_url("c_nup/downloadFile")?>';
  $.post(site_url,
    {seqno:seqno,document_no:document_no},
    function(data,status) {

    }
    );
  

}
function Loadfile(rowID){
// alert(id);  

// alert(rowID);

var sn = $('#seqno').val();

var modalClass = $('#modal').attr('class');
switch (modalClass) {
  case "modal fade bs-example-modal-md":
  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
  break;
  case "modal fade bs-example-modal-sm":
  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
  break;
  default:
  $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
  break;
}

var modalDialogClass = $('#modalDialog').attr('class');
switch (modalDialogClass) {
  case "modal-dialog modal-md":
  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
  break;
  case "modal-dialog modal-sm":
  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
  break;
  default:
  $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
  break;
}
$('#modalTitle').html('<b>Add File</b>');
                // alert(rowID);
                $('div.modal-body').load("<?php echo base_url('c_nup_cfld/addNew');?>"); //+"/"+descs+"/"+rowID);
                // $('#modal').data('descs', descs);
                
                $('#modal').data('sn', sn);
                $('#modal').data('id', rowID).modal('show');
              }

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

    // $.validator.addMethod("check_noktp", function (value, element) {
    //   var isSuccess = false;
    //   var noktp = $('#noktp').val();
    //   var nationality =  $('#nationality').find(':selected').val();

    //   if(nationality != 01) {
    //       isSuccess=true;
    //   }
    //   else{
    //       if(noktp.length == 16){
    //         isSuccess=true
    //       } 
    //   //   if(noktp.length > 16 || noktp.length < 16  ){

    //   //   }else{
    //   //     isSuccess=true;
    //   //   }    
    //   } 
    //   return isSuccess;
    // });

$.validator.addMethod("cek_telp", function (value, element) {
  var isSuccess = false;
  var Stext = $('#HP').val()
  var Sawal = value.charAt(0);
  console.log(Stext);

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
        // agtype: {required: true},
        nupamt: {required: true},
        type: {required: true},
        // phase: {required: true},
        // seqno: {required: true},
        bankcd: {required: true},
        country_cd:{required: true},
        Location:{required: true}
        ,
        customer_type:{required:true}
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
        console.log(error);
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


$("#nuptype").trigger('chosen:updated');
    // $("#nupamt").mask('#,##0',{reverse:true,maxlength:false});
    $("#nuptype").change(function(){
      var nuptype = $(this).find(':selected').val();
      var Type = '<?php echo $Type ?>';
      
// alert(Type);

      // console.log(nuptype+'PP');
      if(nuptype!=='') {
        var site_url = '<?php echo base_url("c_nup_cfld/setnup") ?>';
        $.post(site_url,
          {tnup:nuptype},
          function(data,status){
            console.log(data);
            if(data.pesan==1) {
              var aa = $('#Roiqty').val();              
              var bb = data.nup_amt;              
              $("#nupamt").val(formatNumber(data.nup_amt));

              // $("#remarks").val(data.remarks); //ini ceritanya bikin remarks
              $("#remarks").text(data.remarks);

              // $("#nupdesc").val(data.descs);
              $("#prefix").val(data.pref);

              $("#Roiamt").val(formatNumber(aa * bb));

            } else {
              swal('Please define NUP Type for this project');
            }
            
            // $("#txt_debtor").empty();
            // $("#txt_debtor").val(data);
            // console.log(data);
          },
          'json'
          );
      } else {
        // console.log('nuptype empty');
      }
      // $("#txt_debtor").val(lot);
    });



$('#nationality').change(function(){
  var nationality = $(this).find(':selected').val();
      // alert(nationality);
      if (nationality != 01){
        document.getElementById('lblnoktp').hidden=true;
        document.getElementById('lblnopass').hidden=false;
        document.getElementById('lblnpwp').hidden=true;        
        document.getElementById('npwp').style.visibility = 'hidden';
        // $('#noktp').val('');
      }else{
        document.getElementById('lblnoktp').hidden=false;
        document.getElementById('lblnopass').hidden=true;
        document.getElementById('lblnpwp').hidden=false;        
        document.getElementById('npwp').style.visibility = 'visible';
        // $('#noktp').val('');
      }
      
    });


$('#submit1').click(function(){

  // if($('#form_nup').valid())
  // {
    document.getElementById("submit").disabled = true;
    document.getElementById('loader').hidden=false;
        // console.log('wkwkkwk');
        // alert($('#form_nup').serialize());
        // console.log($('#form_nup').serialize());
        var ID = '<?php echo $rowID;?>';
        var srvdate = $('#rsvdate').val();
        var nupamt = $('#nupamt').val();
        var remarkspayment = $('#remarkspayment').val();
        var npwp = $('#npwp').val();
        var city = $('#city').val();
        var Id_No = $('#noktp').val();
        // var city = $('#city').val();
        var prop =$('#property').val();
        var unitNo = $('#unitNo').val();
        var Roiqty = $('#Roiqty').val();
        var Roiamt = $('#Roiamt').val();
        
        // alert(ID);
        var dataform = $('#form_nup').serializeArray();
        dataform.push({name:"bussiness_id",value:bussID}
          ,{name:"rowID",value:ID}
          ,{name:"rsvdate",value:srvdate}
          ,{name:"nupamt",value:nupamt}
          ,{name:"remarkspayment",value:remarkspayment},
          {name:"npwp",value:npwp},
          {name:"Id_No",value:Id_No},
          {name:"city",value:city},
          {name:"property",value:prop}
          );

        // alert($('#rsvdate').val());
        // console.log(dataform);
        
        // console.log(dataform);
        // return;

        var site_url = "<?php echo base_url('c_nup_cfld/savenup')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: dataform,
          dataType: "json",
          success: function(data, status){

            // BootstrapDialog.alert(data.pesan);
           //add loading close
           document.getElementById('loader').hidden=true; 
            // BootstrapDialog.alert(data.pesan, function(result){
            //     if(result) {
            //         window.location.href="<?php echo base_url('c_nup/Index')?>";
            //     }
            //     // else {
            //     //     alert('Nope.');
            //     // }
            // });
        var id = data.rowid;
        var headerID = data.headerid;
        var status_nup = data.status_nup;


        if(data.status !='Failed'){
                          // swal({
                          //   title: "Information",
                          //   text: data.pesan,
                          //   type: "success",
                          //   confirmButtonText: "OK"
                          // },
                          // function(){
                          //   // alert("<?php echo base_url('c_nup/Index');?>");
                          //   window.location.href="<?php echo base_url('c_nup_cfld/Index');?>"
                          // });
        swal({
          title: "Information",
          text: data.pesan+" Do you want to submit this?",
          type: "success",
          showCancelButton: true,
          confirmButtonColor: "#1ab394",
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: false,
          closeOnCancel: false
        },
        function(isConfirm){
          if (isConfirm) {
           $.ajax({
            url : "<?php echo base_url('c_nup_cfld/SubmitStatus');?>",
            type:"POST",
            data: { id:id,status:status_nup,HeaderID:headerID},
            dataType:"json",
            success:function(event, data){
              document.getElementById('loader').hidden=true;
              console.log(event);
              console.log(data);
              if(data=='success'){                          
                swal("Information",event.Pesan,"success");

                window.location.href="<?php echo base_url('c_nup_cfld/Index');?>"
              } else {
                swal("Information",event.Pesan,"error");
              } 
            },                    
            error: function(jqXHR, textStatus, errorThrown){
              document.getElementById('loader').hidden=true;
              swal("Information",textStatus+' Save : '+errorThrown,"warning");
            }
          });
       swal("Deleted!", "Your imaginary file has been deleted.", "success");
                        // alert('yes');
                        // window.location.href="<?php echo base_url('c_nup_cfld/Index');?>"
                      } else {
                        // alert('no');
                        window.location.href="<?php echo base_url('c_nup_cfld/Index');?>"
                      }
                    });
      } else {
        swal({
          title: "Error",
          text: data.pesan,
          type: "error",
          confirmButtonText: "OK"

        });
      }

            // window.location.href="<?php echo base_url('c_nup/Index')?>";
            // console.log(data.pesan);
            // console.log(status);
          },
          error: function(jqXHR, textStatus, errorThrown){
            // document.getElementById('loader').hidden=true; 
            document.getElementById("submit").disabled = false;
            swal(textStatus+' Save : '+errorThrown);
          }
        })
// }
});


$('#submit').click(function(){ 
  var seqno =$('#seqno').val();
  var ID = '<?php echo $rowID;?>';
  var srvdate = $('#rsvdate').val();
  var nupamt = $('#nupamt').val();
  var remarkspayment = $('#remarkspayment').val();
  var payment = $('#payment').val();
  var npwp = $('#npwp').val();
  var city = $('#city').val();
  var Id_No = $('#noktp').val();
  var prop =$('#property').val();
  var unitNo = $('#unitNo').val();
  var Roiqty = $('#Roiqty').val();
  var Roiamt = $('#Roiamt').val();
  var dataform = $('#form_nup').serializeArray();
  var site_url = "<?php echo base_url('c_nup_cfld/savenup')?>"; 
  dataform.push(
    {name:"bussiness_id",value:bussID},
    {name:"rowID",value:ID},
    {name:"rsvdate",value:srvdate},
    {name:"nupamt",value:nupamt},
    {name:"remarkspayment",value:remarkspayment},
    {name:"npwp",value:npwp},
    {name:"Id_No",value:Id_No},
    {name:"city",value:city},
    {name:"property",value:prop}
  );
  // console.log(dataform);
  // return;
  if($('#form_nup').valid()){
    swal({
      title: "Information",
      text: "Do you want to submit this?",
      type: "success",
      showCancelButton: true,
      confirmButtonColor: "#1ab394",
      confirmButtonText: "Yes",
      cancelButtonText: "No",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        var statusRoi = '<?php echo $status ?>';
        var Type = '<?php echo $Type; ?>';
        var site_url2 = '<?php echo base_url("c_nup_cfld/check_attachment_roi")?>';
        $.post(site_url2,
          {seqno:seqno,from:'out',status:statusRoi},
          function(data,status) {
            console.log('ot');
            console.log(data);
            if(data!='OK' || payment == '' || remarkspayment == '') {
              swal("Information",'Please Complete NUP attachment & Payment Method',"warning");
              document.getElementById("submit").disabled = false;
              return;                                
            } else {              
              swal("Loading","Done","success");
              document.getElementById("submit").disabled = true;
              $.ajax({
                url : site_url,
                type : "POST",
                data : dataform,
                dataType : "json",
                success:function(data, status){
                  var id = data.rowid;
                  var headerID = data.headerid;
                  var status_nup = data.status_nup;

                  if(data.status != 'Failed'){
                    $.ajax({
                      url : "<?php echo base_url('c_nup_cfld/SubmitStatus');?>",
                      type:"POST",
                      data: { id:id,status:status_nup,HeaderID:headerID,Type:Type},
                      dataType:"json",
                      success:function(event, data) {
                        if(event.Status=='OK'){                          
                          swal("Information",event.Pesan,"success");
                          window.location.href="<?php echo base_url('c_nup_cfld/Index');?>"
                        } else {
                          swal("Information",event.Pesan,"error");
                        } 
                      },                    
                      error: function(jqXHR, textStatus, errorThrown) {
                        document.getElementById('loader').hidden=true;
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");
                      }
                    });
                  } else {
                    swal("Information",data.Pesan,"error");
                  }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                  document.getElementById('loader').hidden=true;
                  swal("Information",textStatus+' Save : '+errorThrown,"warning");
                }
              });              
            }
          }
          );
      } else {  
      swal("Loading","Done","success");
      document.getElementById("submit").disabled = true;      
        $.ajax({
          url : site_url,
          type : "POST",
          data : dataform,
          dataType : "json",
          success:function(data, status){
            if(data.status != 'Failed'){
              swal("Information",data.Pesan,"success");
              window.location.href="<?php echo base_url('c_nup_cfld/Index');?>"
            } else {
              swal("Information",data.Pesan,"error");
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            document.getElementById('loader').hidden=true;
            swal("Information",textStatus+' Save : '+errorThrown,"warning");
          }
        });        
      }
    });
  } else {
    if($('#salutation').val() == '') {
      swal("warning","Salutation can not be blank","warning");
    } else if ($('#customer').val() == '' ) {
      swal("warning","Customer Name can not be blank","warning");
    } else if ($('#country_cd').val() == '' ) {
      swal("warning","Country Code can not be blank","warning");
    } else if ($('#HP').val() == '' ) {
      swal("warning","HP can not be blank","warning");
    } else if ($('#Email').val() == '' ) {
      swal("warning","Email can not be blank","warning");
    } else if ($('#address').val() == '' ) {
      swal("warning","Address can not be blank","warning");
    } else if ($('#city').val() == '' || $('#city').val() == null ) {
      swal("warning","City can not be blank","warning");
    } else if ($('#customer_type').val() == '') {
      swal("warning","Customer Type can not be blank","warning");
    }
  }
});


$('#submitx').click(function() {
  var seqno =$('#seqno').val();
   //else { 
    if($('#form_nup').valid())
    {
      console.log('validform');
      document.getElementById("submit").disabled = true;
      document.getElementById('loader').hidden=false;
      var ID = '<?php echo $rowID;?>';
      // alert(ID+'  buss: '+bussID);
      var srvdate = $('#rsvdate').val();
      var nupamt = $('#nupamt').val();
      var remarkspayment = $('#remarkspayment').val();
      var npwp = $('#npwp').val();
      var city = $('#city').val();
      var Id_No = $('#noktp').val();
      var prop =$('#property').val();
      var unitNo = $('#unitNo').val();
      var Roiqty = $('#Roiqty').val();
      var Roiamt = $('#Roiamt').val();

      var dataform = $('#form_nup').serializeArray();
      dataform.push(
        {name:"bussiness_id",value:bussID}
        ,{name:"rowID",value:ID}
        ,{name:"rsvdate",value:srvdate}
        ,{name:"nupamt",value:nupamt}
        ,{name:"remarkspayment",value:remarkspayment},
        {name:"npwp",value:npwp},
        {name:"Id_No",value:Id_No},
        {name:"city",value:city},
        {name:"property",value:prop}
      );

      var site_url = "<?php echo base_url('c_nup_cfld/savenup')?>";
      $.ajax({
        url: site_url,
        type: "POST",
        data: dataform,
        dataType: "json",
        success: function(data, status) {
          document.getElementById('loader').hidden=true; 

          var id = data.rowid;
          var headerID = data.headerid;
          var status_nup = data.status_nup;

          if(data.status !='Failed')
          { 
            swal(
              {
                title: "Information",
                text: data.pesan+" Do you want to submit this?",
                type: "success",
                showCancelButton: true,
                confirmButtonColor: "#1ab394",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm) {
                if (isConfirm) {
                  var statusRoi = '<?php echo $status ?>';
                  var Type = '<?php echo $Type; ?>';
                  var site_url2 = '<?php echo base_url("c_nup_cfld/check_attachment_roi")?>';
                  $.post(site_url2,
                    {seqno:seqno,from:'out',status:statusRoi},
                    function(data,status) {
                      console.log(data);
                      if(data!='OK') {
                        swal("Information",'Please Complete NUP attachment & Payment Method',"warning");
                        document.getElementById("submit").disabled = false;
                        return;                                
                      }
                      else
                      { 
                        document.getElementById('loader').hidden=false;
                        $.ajax({
                          url : "<?php echo base_url('c_nup_cfld/SubmitStatus');?>",
                          type:"POST",
                          data: { id:id,status:status_nup,HeaderID:headerID,Type:Type},
                          dataType:"json",
                          success:function(event, data) {
                            // document.getElementById('loader').hidden=true;
                            console.log(event);
                            console.log(data);
                            if(data=='success'){                          
                              swal("Information",event.Pesan,"success");
                              window.location.href="<?php echo base_url('c_nup_cfld/Index');?>"
                            } else {
                              swal("Information",event.Pesan,"error");
                            } 
                          },                    
                          error: function(jqXHR, textStatus, errorThrown) {
                            document.getElementById('loader').hidden=true;
                            swal("Information",textStatus+' Save : '+errorThrown,"warning");
                          }
                        });
                      }
                    }
                  );
                } else {
                  window.location.href="<?php echo base_url('c_nup_cfld/Index');?>"
                }
              }
            );
          } 
          else 
          {
            swal({
              title: "Error",
              text: data.pesan,
              type: "error",
              confirmButtonText: "OK"
            });
          }
        },
        error: function(jqXHR, textStatus, errorThrown){
          document.getElementById("submit").disabled = false;
          swal(textStatus+' Save : '+errorThrown);
        }
      });
    }
    else {
      // console.log('notvalidform');
      if($('#salutation').val() == '') {
        swal("warning","Salutation can not be blank","warning");
      } else if ($('#customer').val() == '' ) {
        swal("warning","Customer Name can not be blank","warning");
      } else if ($('#country_cd').val() == '' ) {
        swal("warning","Country Code can not be blank","warning");
      } else if ($('#HP').val() == '' ) {
        swal("warning","HP can not be blank","warning");
      } else if ($('#Email').val() == '' ) {
        swal("warning","Email can not be blank","warning");
      } else if ($('#address').val() == '' ) {
        swal("warning","Address can not be blank","warning");
      } else if ($('#city').val() == '' || $('#city').val() == null ) {
        swal("warning","City can not be blank","warning");
      } else if ($('#customer_type').val() == '') {
        swal("warning","Customer Type can not be blank","warning");
      }
      // swal('Warning','Please fill the required field(s)','warning');
    }
  // }
});

$('#btnback').click(function(){
  swal({
    title: "Information",
    text: " Do you want to save this?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#1ab394",
    confirmButtonText: "Yes",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm){
    if (isConfirm) {
      if($('#form_nup').valid()){
        document.getElementById("submit").disabled = true;
        document.getElementById('loader').hidden=false;

        var ID = '<?php echo $rowID;?>';
        var srvdate = $('#rsvdate').val();
        var nupamt = $('#nupamt').val();
        var remarkspayment = $('#remarkspayment').val();
        var npwp = $('#npwp').val();
        var city = $('#city').val();
        var Id_No = $('#noktp').val();
        var prop =$('#property').val();
        var unitNo = $('#unitNo').val();
        var Roiqty = $('#Roiqty').val();
        var Roiamt = $('#Roiamt').val();        

        var dataform = $('#form_nup').serializeArray();
        dataform.push(
          {name:"bussiness_id",value:bussID},
          {name:"rowID",value:ID},
          {name:"rsvdate",value:srvdate},
          {name:"nupamt",value:nupamt},
          {name:"remarkspayment",value:remarkspayment},
          {name:"npwp",value:npwp},
          {name:"Id_No",value:Id_No},
          {name:"city",value:city},
          {name:"property",value:prop}
          );

        $.ajax({
          url : "<?php echo base_url('c_nup_cfld/savenup');?>",
          type:"POST",
          data: dataform,
          dataType:"json",
          success:function(data,event){
            document.getElementById('loader').hidden=true;
            console.log(data);
            if(data.Status=='OK'){                          
              swal("Information",event.Pesan,"success");
              // window.location.href="<?php echo base_url('c_nup_landed_cfld/indexEdit')?>";
              var headerid = data.headerid;
              var myBookId = $('#unitNo').val();

              var site_url = "<?php echo base_url('c_nup_landed_cfld_dt/set_session')?>";
              $.ajax({
                url: site_url,
                type: "POST",
                data: {
                  unit_loop: myBookId,
                  headerid: headerid
                },
                dataType: "json",
                success: function(data, status) {
                  var status = '<?php echo $status ?>';
                    // console.log('status : '+status);
                    // return;
                    if(status == 'E'){
                      window.location.href='<?php echo base_url("c_nup_cfld/index") ?>';
                    } else {
                      window.location.href = "<?php echo base_url('c_nup_landed_cfld/indexEdit')?>"+"/E"; 
                    }                                   
                  },
                  error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                  }
                })
            } else {
              swal("Information",event.Pesan,"error");
            } 
          },                    
          error: function(jqXHR, textStatus, errorThrown){
            document.getElementById('loader').hidden=true;
            swal("Information",textStatus+' Save : '+errorThrown,"warning");
          }
        });
} else {
  swal("warning", "Please completed your data!", "warning");  
}
} else {
  var status = '<?php echo $status ?>';
  if(status == 'E'){
    window.location.href='<?php echo base_url("c_nup_cfld/index") ?>';
  } else {
    var seqno =$('#seqno').val();      
    var site_url = '<?php echo base_url("c_nup_cfld/check_delete_attachment") ?>';
    $.post(site_url,
      {seqno:seqno},
      function(data,status){
        var headerid = $('#headerid').val();
        var myBookId = $('#unitNo').val();
        var site_url = "<?php echo base_url('c_nup_landed_cfld_dt/set_session')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: {
            unit_loop: myBookId,
            headerid: headerid
          },
          dataType:"json",
          success: function(data, status){
            if('<?php echo $Type;?>'=='P'){
              var url = '<?php echo base_url("c_nup_landed_cfld/indexPrior")?>';  
            }else{
              var url = '<?php echo base_url("c_nup_landed_cfld/index")?>';
            }
            
            window.location.href=url;
          },
          error: function(jqXHR, textStatus, errorThrown){
            swal(textStatus + ' Save : ' + errorThrown);
          }
        })          
      },
      'json'
      ); 
  }      
}
});
});

// $('#change_unit').click(function(){
//   var headerid = $('#headerid').val();
//   var myBookId = $('#unitNo').val();

//   // alert(headerid);

//   var site_url = "<?php echo base_url('c_nup_landed_cfld_dt/set_session')?>";
//   $.ajax({
//     url: site_url,
//     type: "POST",
//     data: {
//       unit_loop: myBookId,
//       headerid: headerid
//     },
//     dataType: "json",
//     success: function(data, status) {              
//       window.location.href = "<?php echo base_url('c_nup_landed_cfld/indexEdit')?>";
//     },
//     error: function(jqXHR, textStatus, errorThrown) {
//       swal(textStatus + ' Save : ' + errorThrown);
//     }
//   })
// });



    // $("#city").select2();
    // $('input[name=txt_aditional_disc]').mask('#,##0',{reverse:true,maxlength:false});
    
    // $('#disc').change(function(){
    //   var discno = $("#disc option:selected").data("level");
    //   var list_price = $("#txt_list_bf_price").text();
    //   var price = replaceAll(list_price, ',','');
    //   var disc = $("#txt_discount").text();
    //   var disc_amt = replaceAll(disc, ',','');
    //   price = price - parseFloat(disc_amt);
    //   if (discno=='') {
    //     var result = 0;
    //     var net_price = price - result;
    //     $("#txt_aditional_disc").val(formatNumber(result));

    //   } else { 
    //     // var price = replaceAll(list_price, ',','');
    //     var result = (parseInt(discno) * parseInt(price)) / 100 ;
    //     var net_price = price - result;
    //     $("#txt_aditional_disc").val(formatNumber(result));
    //   }
    //   $('#txt_netprice').text(formatNumber(net_price));
    //   // console.log(formatNumber(net_price));
    // });
    // $('#customer').change(function(){
    //   var select = $("#customer option:selected").val();
    //   if (select) {
    //       var editID = document.getElementById('edit');
    //       var link = '<?php echo base_url('c_cf_business/editCustomer'); ?>/'+ select;
    //       edit.setAttribute('href', link);
    //       // console.log(select);
    //       // alert('You can edit ');
    //   }else{
    //       var editID = document.getElementById('edit');
    //       var link = '';
    //       edit.setAttribute('href', link);
    //   }
    // });

   // $(document).ready(function() {
   //      $('[rel="tooltip"]')
   //          .tooltip({placement: 'right'})
   //          .data('tooltip')
   //          .tip()
   //          .css('z-index',2080);
   //  });

</script> 
</div>
