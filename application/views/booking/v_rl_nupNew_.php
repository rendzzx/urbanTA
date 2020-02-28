<!-- <link href="<?=base_url('plugins/select2/select2.min.css')?>" rel="stylesheet" /> -->
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('DataTable/media/css/dataTables.bootstrap.min.css');?>" rel="stylesheet" type="text/css" >

<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />

<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
  <script src="<?=base_url('dist/js/jquery.mask.min.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script> 
  
  <script src="<?=base_url('plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('plugins/select2/select2.full.min.js')?>" type="text/javascript"></script>  
  <link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />
  <script src="<?=base_url('plugins/input-mask/jquery.inputmask.bundle.min.js')?>"></script> 


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

<style type="text/css">
  /*.loader{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center
    background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center     
  }*/

  /*input[type=number]::-webkit-inner-spin-button { 
    -webkit-appearance: none;
    cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
}

input[type=number]::-webkit-inner-spin-button:before,
input[type=number]::-webkit-inner-spin-button:after {
    content: "^";
    position:absolute;
    right: 0;
    font-family:monospace;
    line-height:
}

input[type=number]::-webkit-inner-spin-button:before {
    top:0px;
}

input[type=number]::-webkit-inner-spin-button:after {
    bottom:0px;
    -webkit-transform: rotate(180deg);
}*/
</style>


<div class="content-wrapper">
<div id="loader" class="loader" hidden="true"></div>
  <section class="content-header" style="padding-top: 5px;">
    <div class="form-group">
      <div class="tittle-top pull-left">
        <b><?php echo $project; ?></b><br>
        <b><?php echo($agent->agent_name)?></b>
        <!-- <label id="rsvname" name ="rsvname" style="margin-bottom: 0px;" value="<?php echo($agent->agent_name)?>"></label>   -->
      </div>
      <div class="tittle-top pull-right"><b><?php if($status=='N'){echo 'ADD NUP Entry '.$phase->descs;}else{echo 'EDIT NUP Entry '.$phase->descs;} ?></b></div>
    </div>    
  </section><br><br>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
            <div class="box-body">
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Sales Date</label>
                <div class="col-sm-9">
                  <label class="control-label"><?php echo(date('D, d M Y')); ?></label>
                </div>
              </div> -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Nama / Name<FONT COLOR="RED">*</FONT></label>
                <div class="col-sm-3">
                  <select class="form-control chosen-select col-sm-2" name="salutation" id="salutation" data-placeholder="Select Salutation">                  
                    <option></option>
                    <option value="Mr.">Mr.</option>
                    <option value="Mrs.">Mrs.</option>
                    <option value="Ms.">Ms.</option> 
                  </select>
                </div>
                <div class="col-sm-4">                  
                  <input type="text" class="form-control col-sm-5" name="customer" id="customer" placeholder="Input Name">
                </div>
              </div>              
              <div class="form-group">
                <label class="col-sm-3 control-label">HP / Mobile<FONT COLOR="RED">*</FONT></label>
                <div class="col-sm-3">
                  <select class="form-control chosen-select" name="country_cd" id="country_cd" data-placeholder="Select Country"><?php echo $comboCountry ?></select>
                </div>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="HP" id="HP" placeholder="8xxxxxxxxxx">
                  Format: 21995500 | 89895098987
                  <!-- <input type="number" class="form-control bfh-number" name="HP" id="HP" placeholder="8xxxxxxxxxx">                   -->
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
                  <select class="form-control chosen-select col-sm-2" name="nationality" id="nationality" data-placeholder="Select Nationality"><?php echo $cbnationality ?></select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" name="lblnoktp" id="lblnoktp">No. KTP / ID No.<FONT COLOR="RED">*</FONT></label>
                <label class="col-sm-3 control-label" name="lblnopass" id="lblnopass" hidden="true">No. Passport / Passport No.<FONT COLOR="RED">*</FONT></label>                 
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
                  <!-- <input type="text" class="form-control" name="city" id="city" placeholder="Input City"> -->
                  <select class="form-control chosen-select"  name="city" id="city" data-placeholder="Select City"><?php echo $comboCity;?></select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">NPWP</label>                
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Input NPWP">
                </div>
              </div>
              <div class="form-group" id="divproduct">
                <label class="col-sm-3 control-label">Product<FONT COLOR="RED">*</FONT></label>                
                <div class="col-sm-7">
                  
                  <!-- <input type="radio" name="product" id="product1" value="APT"> 
                    <label for="product1">Apartment &nbsp;</label>
                  <input type="radio" name="product" id="product2" value="LND">
                    <label for="product2">Landed &nbsp;</label>
                  <input type="radio" name="product" id="product3" value="RSD"> 
                    <label for="product3">Residence</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <label class="control-label" align="right" style="text-align: right">Property</label> -->
                 
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
                
                
              </div>
              <div class="form-group" >
              <label class="col-sm-3  control-label">Property<FONT COLOR="RED">*</FONT></label>
                <div class="col-sm-7">                
                <select class="form-control chosen-select" name="property" id="property" data-placeholder="Select Property"><option value=""></option><!-- <?php echo $comboTnup ?> --></select>
                </div>

              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Tipe NUP / NUP Type<FONT COLOR="RED">*</FONT>
                  <!-- <a href="#" onclick="nuptypeinfo();"><img src="<?php echo base_url('img/info.png');?>" width="20px" height="20px" ></a> -->
                  <input type="button" value="More Info" onclick="nuptypeinfo(1);" class="btn btn-info btn-xs">
                </label>
                <div class="col-sm-3">
                  <select class="form-control chosen-select" name="nuptype" id="nuptype" data-placeholder="Select NUP Type"><option value=""></option><!-- <?php echo $comboTnup ?> --></select>                  
                </div>
                <div class="col-sm-4">
                  <input class="form-control" name="nupamt" id="nupamt" readonly>
                </div> 
              </div>
                
              <!-- <div class="form-group">
                <label class="col-sm-3 control-label"></label>
                <div class="col-sm-7">
                  <input type="text" class="form-control" name="remarks" id="remarks" readonly="">
                </div>
              </div> -->

              
               <!--  <label class="col-sm-2 control-label"> Description </label>  -->
               <!--  <div class="col-sm-8">
                  <input class="form-control" name="remarks" id="remarks">
                </div> -->
             
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">NUP Number</label>
                <div class="col-sm-8">
                  <input class="form-control" name="nupno" id="nupno">
                </div>
              </div> -->
              <div class="form-group">
                <label class="col-sm-3 control-label">Tanggal NUP / NUP Date</label>
                <div class="col-sm-7">
                  <input class="form-control" name="rsvdate" id="rsvdate" value="<?php echo($today)?>" disabled="1">
                  <!-- <input class="form-control" name="rsvdate" id="rsvdate" value="" disabled="1"> -->
                </div>
              </div>
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Reserve By</label>
                <div class="col-sm-8">
                  <input class="form-control" id="rsvname" name ="rsvname" value="<?php echo($agent->agent_name)?>" disabled="1"><br>
                  <input class="form-control" id="rsvgroup" name ="rsvgroup" value="<?php echo($agent->agentype)?>" disabled="1"><br>
                  <input class="form-control" id="rsvtype" name ="rsvtype" value="<?php echo($agent->group_name)?>" disabled="1">
                  <input class="form-control" name="rsvby" id="rsvby" type="hidden" value="<?php echo($user)?>" disabled="1">
                  <input class="form-control" name="grpcd" id="grpcd" type="hidden" value="<?php echo($agent->group_cd)?>">
                  <input class="form-control" name="agtype" id="agtype" type="hidden" value="<?php echo($agent->agent_type_cd)?>">
                </div>
              </div> -->              
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">NUP Amount</label>
                <div class="col-sm-8">
                  <input class="form-control" name="nupamt" id="nupamt" readonly>
                </div>
              </div> -->
              <div class="form-group" >
                <label class="col-sm-3 control-label">Lokasi launcing yang dipilih /<br>Preffered launching location<FONT COLOR="RED">*</FONT>
                <input type="button" value="More Info" onclick="nuptypeinfo(0);" class="btn btn-info btn-xs">
                </label>
                <div class="col-sm-7">
                  <select class="form-control chosen-select" name="Location" id="Location" data-placeholder="Select Location"><?php echo $comboLocation; ?></select>                  
                </div>
                </div>
                
                <!-- <div class="form-group">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-7" style="font-size: 11px;"> -->
                 <!--  <label>
                    - Acara Launching Pemilihan Unit di awal tahun 2017 wajib dihadiri oleh pemegang NUP Pass dan akan diadakan di beberapa kota secara serentak dan bersamaan. Mohon memilih lokasi yang cocok untuk anda.
                    - Launching Event Unit  Selection must be attended by the NUP Pass holder and will be held in 3 locations simultaneously in early 2017. Kindly choose the location you preferred.
                  </label> -->
                    <!-- <div class="form-control" style="font-size: 11px; height: auto;" >                     -->
                   <!--  - Acara Launching Pemilihan Unit di awal tahun 2017 wajib dihadiri oleh pemegang NUP Pass dan akan diadakan di beberapa kota secara serentak dan bersamaan. Mohon memilih lokasi yang cocok untuk anda.<br>
                    - Launching Event Unit  Selection must be attended by the NUP Pass holder and will be held in 3 locations simultaneously in early 2017. Kindly choose the location you preferred. -->
                     <!-- <li>
                       Launching Event Unit  Selection must be attended by the NUP Pass holder and will be held in 3 locations simultaneously in early 2017. Kindly choose the location you preferred.
                     </li> -->                    
                    <!-- </div> -->
                  <!-- </div>
                </div> -->
              
           
              <div class="form-group">
                <label class="col-sm-3 control-label">Upload Document</label>
                <div class="col-sm-7">
                  <!-- <input type="file" name="picture[]" id="picture" multiple="multiple"> -->
                  <input type="hidden" name="prefix" id="prefix">
                  <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>">
                  <input type="hidden" name="seqno" value="<?php echo $seqno;?>" id="seqno">
                  <input type="hidden" name="status" id="status" value="<?php echo $status;?>">
                  <input type="hidden" name="cntfile" id="cntfile" value="<?php echo $cnt?>">
                  <table id="tblattach" class="display table-striped" cellspacing="0" width="100%">
                    <thead>            
                        <th >No</th>
                        <th width="50%">Criteria</th>
                        <th width="40%">Filename</th>
                        <th >Upload</th>
                        <th >Download</th>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>                  
                </div>                
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label">Cara Pembayaran NUP /<br>Payment Method</label>
                <div class="col-sm-3">
                  <select class="form-control chosen-select" name="payment" id="payment" data-placeholder="Select Payment Method"><?php echo $payment; ?></select>                  
                </div>
                <div class="col-sm-4">
                  <input class="form-control" name="remarkspayment" id="remarkspayment" placeholder="">
                </div>
                
              </div>              
            </div>
            <div class="box-footer">
              <!-- <button class="btn btn-primary" type="button" id="btnSimpan" onClick="validasi()"><i ></i> Save</button> -->
              <input type="button" name="submit" id="submit" value="Save" class="btn btn-primary">
              <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-default">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
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
  
  <!-- <script src="<?php echo base_url('plugins/jQueryUI/jquery-ui-1.10.2.min.js')?>" type="text/javascript"></script> -->
   
  <script type="text/javascript">
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

  var bussID=0;
  function setNUPType(Id,product){
        
        var site_url = '<?php echo base_url("c_nup/chosen_nup_type")?>';
            $.post(site_url,
              {Id:Id,product:product},
              function(data,status) {
                $("#nuptype").empty();
                $("#nuptype").append(data);
                $("#nuptype").trigger('chosen:updated');
              }
            );
    }
     function setProperty(Id,prod){
        
        var site_url2 = '<?php echo base_url("c_nup/zoom_property_edit")?>';
            $.post(site_url2,
              {prod:prod,Id:Id},
              function(data,status) {
                $("#property").empty();
                $("#property").append(data);
                $("#property").trigger('chosen:updated');
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
                $("#Location").trigger('chosen:updated');
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
                $("#country_cd").trigger('chosen:updated');
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
                $("#payment").trigger('chosen:updated');
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
                $("#city").trigger('chosen:updated');
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
                $("#salutation").trigger('chosen:updated');
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
                $("#nationality").trigger('chosen:updated');
              }
            );
    }

  function Loaddata(){
    var status = '<?php echo $status;?>';
    var seqno = "<?php echo $seqno;?>";
    
    if(status !='N'){
      var ID = '<?php echo $rowID;?>';
      // alert(status+' '+ID);
      var site_url = '<?php echo base_url("c_nup/show_edit_data")?>'+'/'+ID;
// alert(status);
      $.getJSON(site_url, function (data) {                
                // console.log(data);
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
                $('#noktp').val(data[0].Id_No);
                $('#address').val(data[0].ADDRESS);
                setcity(data[0].city);
                $('#npwp').val(data[0].NPWP);
                setNUPType(data[0].nup_type,data[0].product_cd);
                $('#nupdesc').val(data[0].rl_reserve_descs);
                $('#rsvdate').val(dt);
                // $('#rsvname').val(data[0].agent_name);
                setProperty(data[0].product_type,data[0].product_cd);
                document.getElementById(data[0].product_cd).checked = true;
                $('#rsvname').text(data[0].agent_name);
                $('#rsvgroup').val(data[0].agentype);
                $('#rsvtype').val(data[0].group_name);
                $('#rsvby').val(data[0].reserve_by);
                $('#grpcd').val(data[0].group_cd);
                $('#agtype').val(data[0].agent_type_cd);
                setcountrycd(country_cd);
                $('#nupamt').val(formatNumber(data[0].nup_amt));
                setpayment(payment);
                $('#remarkspayment').val(data[0].payment_type_remarks);
                setLocation(data[0].location_cd);
                $('#remarks_nup').val(data[0].remarks_nup);
                $('#prefix').val(data[0].prefix);
                $('#remarks').val(data[0].remarks_nup);
                $('#noktp').val(data[0].ic_no);
                $('#address').val(data[0].Address);
                bussID = data[0].business_id;
                setsalutation(data[0].salutation);
                setnationality(data[0].nationality);
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
  
  $(".select2").select2();
    var table;
    var ids;
    var descss;
    Loaddata();
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    $(".chosen-select").chosen({ width: '100%'});
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
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
      $("#npwp").mask("99.999.999.9-999.999");
      $("#noktp").mask("9999999999999999");
      $("#HP").mask("999999999999");
      $('input:radio[name="product"]').change(function(){

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


      $("#HP").inputmask("Regex", { regex: "[0-9]+$" });

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
            url:"<?php echo base_url('c_nup/getTableAttach')?>",
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
                    BootstrapDialog.alert('Please select a row');
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
                $('div.modal-body').load("<?php echo base_url('c_nup/addNew');?>"); //+"/"+descs+"/"+rowID);
                $('#modal').data('descs', descs);
                $('#modal').data('sn', sn);
                $('#modal').data('id', data).modal('show');
            }
          }
        ],
        columns:[
            {data: "row_number", name: "rowID"},
            {data: "document_descs", name: "document_descs"},
            {data: "file_attachment", name: "file_attachment"},
            {
              // data: "rowID", name: "rowID", visible: false
              data: "rowID", name: "rowID",
                            render: function (data, type, row) {
                                var id = row.rowID;
                                var descs =row.document_descs;
                                var datas = new Array(id,descs);
                                ids = id;
                                descss = row.document_descs;
                                return '<a class="btn btn-primary btn-sm" onclick="Loadfile('+data+');"" ><i class="fa fa-users fa-fw"></i> Upload File</a>';
                                

                            }
            },
            {
               data: "rowID", name: "rowID", //visible: false
              // data: null, searchable:false,
                            render: function (data, type, row) {
                       
                                var seqno = row.nup_sequence_no;
                                // console.log(seqno);
                                var document_no = row.document_no;
                                
return '<a class="btn btn-primary btn-sm" href=' +'<?php echo base_url("c_nup/downloadFile")?>'+'/'+seqno+'/'+document_no+'><i class="fa fa-download"></i> Download</a>';                                

                            }
            }
        ]
      });





      var lot = $("#nuptype").find(':selected').val();
      $("#nuptype").change();
    });
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
                $('div.modal-body').load("<?php echo base_url('c_nup/addNew');?>"); //+"/"+descs+"/"+rowID);
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

    $.validator.addMethod("check_noktp", function (value, element) {
      var isSuccess = false;
      var noktp = $('#noktp').val();
      var nationality =  $('#nationality').find(':selected').val();
      
      if(nationality != 01) {
          isSuccess=true;
      }else{        
        if(noktp.length > 16 || noktp.length < 16  ){
      
        }else{
          isSuccess=true;
        }    
      } 
      return isSuccess;
    });

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
        customer: { required: true},
        HP:{
            required: true,
            number:true,
            maxlength:12,
            cek_telp: true
            },
        Email:{
                required: true,
                email:true
              },
        noktp: {required: true,
        check_noktp: true},
        address:{
            required: true,
            maxlength:255
            },
        city: {required: true},
        npwp: {cek_npwp: true},
        nuptype: {required: true},
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
        // ,cntfile: {attached: true}
      },
      messages: {cntfile: {attached: "Upload file need to completed"},
                npwp: { cek_npwp: "NPWP is not valid"},
                noktp: {check_noktp: " IC No. Is not valid"},
                HP: {cek_telp: "Handphone number is not valid"} 
              },
      errorElement: "em",
      errorPlacement: function(error, element){
        error.addClass("help-block  text-red");
        element.parents(".col-xs-5").addClass("has-feedback  text-red");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
        } else {
            error.insertAfter(element);
        }

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
    });

    $("#nuptype").trigger('chosen:updated');
    $("#nupamt").mask('#,##0',{reverse:true,maxlength:false});
    $("#nuptype").change(function(){
      var nuptype = $(this).find(':selected').val();
      // console.log(nuptype+'PP');
      if(nuptype!=='') {
        var site_url = '<?php echo base_url("c_nup/setnup") ?>';
        $.post(site_url,
          {tnup:nuptype},
          function(data,status){
            if(data.pesan==1) {
              $("#nupamt").val(formatNumber(data.nup_amt));

              // $("#remarks").val(data.remarks); //ini ceritanya bikin remarks
              $("#remarks").text(data.remarks);

              // $("#nupdesc").val(data.descs);
              $("#prefix").val(data.pref);
            } else {
              BootstrapDialog.alert('Please define NUP Type for this project');
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

    $("#payment").change(function(){
      var payment = $(this).find(':selected').val();
      if(payment!=='') {
        var site_url = '<?php echo base_url("c_nup/setPayment") ?>';
        $.post(site_url,
          {act:payment},
          function(data,status){
            if(data.pesan==1) {
              document.getElementById('remarkspayment').value="";              
              $('#remarkspayment').attr('placeholder', data.remarks);
            } else {
              BootstrapDialog.alert('Please define NUP Type for this project');
            }
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
        $('#noktp').val('');
      }else{
        document.getElementById('lblnoktp').hidden=false;
        document.getElementById('lblnopass').hidden=true;
        $('#noktp').val('');
      }
      
    });
    

    $('#submit').click(function(){
      
      if($('#form_nup').valid())
      {
        document.getElementById("submit").disabled = true;
        document.getElementById('loader').hidden=false;

        // alert($('#form_nup').serialize());
        // console.log($('#form_nup').serialize());
        var ID = '<?php echo $rowID;?>';
        var srvdate = $('#rsvdate').val();
        var nupamt = $('#nupamt').val();
        var remarkspayment = $('#remarkspayment').val();
        var npwp = $('#npwp').val();
        var city = $('#city').val();
        var Id_No = $('#noktp').val();
        var city = $('#city').val();
        var prop =$('#property').val();
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
        
        console.log(dataform);
        // return;
       
        var site_url = "<?php echo base_url('c_nup/savenup')?>";
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
            if(data.status=='OK'){
                  BootstrapDialog.alert(data.pesan, function(result){
                    if(result) {
                      window.location.href="<?php echo base_url('c_nup/Index')?>";
                    }
                  });
                } else {
                  BootstrapDialog.show({
                  type: BootstrapDialog.TYPE_DANGER,
                  title: 'Error',
                  message: data.pesan,
                  buttons: [{
                    label: 'OK',
                    action: function(dialogItself){
                    dialogItself.close();
                    }
                   }]
                });
                }

            // window.location.href="<?php echo base_url('c_nup/Index')?>";
            // console.log(data.pesan);
            // console.log(status);
          },
          error: function(jqXHR, textStatus, errorThrown){
            BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
          }
        })
      }
    });

    $('#btnback').click(function(){
     
      var seqno =$('#seqno').val();

      var site_url = '<?php echo base_url("c_nup/check_delete_attachment") ?>';
        $.post(site_url,
          {seqno:seqno},
          function(data,status){
            // console.log(data);
            // alert(data);

             var url = '<?php echo base_url("c_nup/Index")?>';
              window.location.href=url;
          },
          'json'
          );

    });
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
    
   
    
  </script> 
</div>
