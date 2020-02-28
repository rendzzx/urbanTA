<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
 
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>


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
input[type="text"]
{
    /*border:none; */
    background-color:white;
    /*display: none;*/
}
/*.form-control[readonly] {
    background-color: white;
}*/
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


    <div class="row">
      <div class="col-xs-12">
        <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
          
            <div class="form-group">
              <label class="col-sm-3 control-label">Nama / Name </label>
              <div class="col-sm-2">
                <!-- <select class="select2_demo_1 form-control col-sm-2" name="salutation" id="salutation" data-placeholder="Select Salutation" disabled="1">                  
                  <option></option>
                  <option value="Mr.">Mr.</option>
                  <option value="Mrs.">Mrs.</option>
                  <option value="Ms.">Ms.</option> 
                </select> -->
                <input type="text" class="form-control" name="salutation" id="salutation" readonly>
              </div>
              <div class="col-sm-5">                  
                <input type="text" class="form-control col-sm-5" name="customer" id="customer" placeholder="Input Name" readonly>
              </div>
            </div>              
            <div class="form-group">
              <label class="col-sm-3 control-label">HP / Mobile </label>
              <div class="col-sm-3">
                <!-- <select class="select2_demo_1 form-control" name="country_cd" id="country_cd" data-placeholder="Select Country" disabled="1"><?php echo $comboCountry ?></select> -->
                <input type="text" class="form-control" name="country" id="country" readonly>
              </div>
              <div class="col-sm-4">
                <input type="text" class="form-control" name="HP" id="HP" data-inputmask="'mask':'999999999999'" placeholder="8xxxxxxxxxx" readonly>
                <!-- Format: 21995500 | 89895098987 -->
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Email </label>
              <div class="col-sm-7">
                <input type="text" class="form-control" name="Email" id="Email" placeholder="Input Email" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Nationality</label>
              <div class="col-sm-7">
              <input type="text" class="form-control" name="nationality" id="nationality" readonly>
                <!-- <select class="select2_demo_1 form-control col-sm-2" name="nationality" id="nationality" data-placeholder="Select Nationality" disabled="1"><?php echo $cbnationality ?></select> -->
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" name="lblnoktp" id="lblnoktp">No. KTP / ID No. </label>
              <label class="col-sm-3 control-label" name="lblnopass" id="lblnopass" hidden="true">No. Passport / Passport No. </label>                 
              <div class="col-sm-7">
                <input type="text" class="form-control" name="noktp" id="noktp" placeholder="Input ID Number" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Alamat / Address </label>                
              <div class="col-sm-7">
                <textarea class="form-control" readonly placeholder="Input Address" name="address" id="address" style=" height: 50px;"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Kota / City </label>                
              <div class="col-sm-7">
                <!-- <select class="select2_demo_2 form-control"  name="city" id="city" data-placeholder="Select City" disabled="1"><?php// echo $comboCity;?></select> -->
                <input type="text" class="form-control" name="city" id="city" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" id="lblnpwp" name="lblnpwp">NPWP</label>                
              <div class="col-sm-7">
                <input type="text" class="form-control" name="npwp" id="npwp" placeholder="Input NPWP" readonly>
              </div>
            </div>
            <div class="form-group" id="divproduct">
              <label class="col-sm-3 control-label">Product </label>                
              <div class="col-sm-7">                 
                <!-- <?php
                foreach($product as $row)
                {
                  $var ='<label class="radio-inline">';
                  $var.=' <input type="radio" id="'.$row->product_cd.'" name="product" value="'.$row->product_cd.'" tabindex="-2"  />'.$row->descs;
                  $var.=' </label>';
                  echo $var;
                }  
                ?> -->
                <input type="text" class="form-control" name="product" id="product" readonly>
              </div>
            </div>
            <div class="form-group" >
              <label class="col-sm-3  control-label">Property </label>
              <div class="col-sm-7">                
                <!-- <select class="select2_demo_1 form-control" name="property" id="property" data-placeholder="Select Property" disabled="1"><option value=""></option><?php //echo $comboTnup ?></select> -->
                <input type="text" class="form-control" name="property" id="property" readonly>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tipe NUP / NUP Type 
                <!-- <input type="button" value="More Info" onclick="nuptypeinfo(1);" class="btn btn-info btn-xs"> -->
              </label>
              <div class="col-sm-3">
                <!-- <select class="select2_demo_1 form-control" name="nuptype" id="nuptype" data-placeholder="Select NUP Type" disabled="1"><option value=""></option>
                <?php echo $comboTnup ?> </select>   --> 
                <input type="text" class="form-control" name="nuptype" id="nuptype" readonly>              
              </div>
              <div class="col-sm-4">
                <input class="form-control" name="nupamt" id="nupamt" readonly>
              </div> 
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal NUP / NUP Date</label>
              <div class="col-sm-7">
                <input class="form-control" name="rsvdate" id="rsvdate" value="<?php echo($today)?>" disabled="1" >
              </div>
            </div>
            <div class="form-group" >
              <label class="col-sm-3 control-label">Lokasi launcing yang dipilih/<br>Preffered launching location 
                <!-- <input type="button" value="More Info" onclick="nuptypeinfo(0);" class="btn btn-info btn-xs"> -->
              </label>
              <div class="col-sm-7">
                <!-- <select class="select2_demo_1 form-control" name="Location" id="Location" data-placeholder="Select Location" disabled="true"><?php echo $comboLocation; ?></select>  -->  
                <input type="text" class="form-control" name="location" id="location" readonly>               
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="col-sm-3 control-label">Document</label>
              <div class="col-sm-7">
                <input type="hidden" name="prefix" id="prefix">
                <input type="hidden" name="phase" value="<?php echo $phase->phase_cd?>">
                <input type="hidden" name="seqno" value="<?php echo $seqno;?>" id="seqno">
                
                <input type="hidden" name="cntfile" id="cntfile" value="<?php echo $cnt?>">
                <table id="tblattach" class="display table-striped" cellspacing="0" width="100%">
                  <thead>            
                    <th >No</th>
                    <th width="50%">Criteria</th>
                    <th width="40%">Filename</th>
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
                <select class="select2_demo_1 form-control" name="payment" id="payment" data-placeholder="Select Payment Method" disabled="1"><?php echo $payment; ?></select>                  
              </div>
              <div class="col-sm-4">
                <input class="form-control" name="remarkspayment" id="remarkspayment" placeholder="" disabled="1">
              </div>
            </div> --><br><br>
         
          <div class="modal-footer">
            <div class="pull-right">
              <button type="button" data-dismiss="modal" class="btn btn-primary">Close</button>
            </div>
          </div>
        </form>
      </div>            
    </div>
 
<script type="text/javascript">
function setNUPType(Id, product){
        
        var site_url = '<?php echo base_url("c_nup/chosen_nup_type")?>';
            $.post(site_url,
              {Id:Id, product:product},
              function(data,status) {
                $("#nuptype").empty();
                $("#nuptype").append(data);
                $("#nuptype").trigger('change');
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
                $("#property").trigger('change');
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

    function setCity(Id){
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

    function setReason(Id){
        
        var site_url = '<?php echo base_url("c_nup/chosen_reason")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#reason_cd").empty();
                $("#reason_cd").append(data);
                $("#reason_cd").trigger('change');

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
                $("#country_cd").trigger('change');
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
  function setproduct(data){
    if (data=="APT"){
      $('input:radio[id="product1"]').prop('checked',true);
    }else if (data == "LND"){
      $('input:radio[id="product2"]').prop('checked',true);
    }else if (data == "RSD"){
      $('input:radio[id="product3"]').prop('checked',true);
    }
  }

  function setsalutation(Id){
        
        var site_url = '<?php echo base_url("c_nup/chosen_salutation")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#salutation").empty();
                $("#salutation").append(data);
                $("#salutation").trigger('change');
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
              }
            );
    }
    function loaddata(){
    // console.log('a');
      var ID = '<?php echo $rowID;?>';
      
      var site_url = '<?php echo base_url("c_nup_enquiry/show_edit_data")?>'+'/'+ID;

      $.getJSON(site_url, function(data){                
                
                var m_names = new Array("Jan", "Feb", "Mar", 
                                        "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
                                        "Oct", "Nov", "Dec");
                var d = new Date(data[0].reserve_date);
                var curr_date = d.getDate();
                var curr_month = d.getMonth();
                var curr_year = d.getFullYear();
                var dt = curr_date + " " + m_names[curr_month]+ " " + curr_year;
                var country_cd = data[0].country_code;
                if(country_cd==null){
                  country_cd=0;
                }
                var Handphone = data[0].Handphone;
                
                var telp = Handphone.substring(country_cd.length,Handphone.length);
                var payment = data[0].type;
                var nupseq = data[0].nup_sequence_no;

                $('#customer').val(data[0].NAME);
                $('#product').val(data[0].product_descs);
                setcountrycd(country_cd);
                $('#HP').val(telp);
                $('#Email').val(data[0].Email);
                $('#noktp').val(data[0].ic_no);
                $('#address').val(data[0].Address);
                $('#nuptype').val(data[0].descs);
                $('#npwp').val(data[0].NPWP);
                $('#nationality').val(data[0].nationality_descs);
                $('#city').val(data[0].city);
                $('#location').val(data[0].location_descs);
                $('#country').val(data[0].country_descs);
         
                $('#nupdesc').val(data[0].rl_reserve_descs);
                $('#rsvdate').val(dt);
                // $('#rsvname').val(data[0].agent_name);

                setProperty(data[0].product_type,data[0].product_cd);
                // document.getElementById(data[0].product_cd).checked = true;                
                // document.getElementById(data[0].product_cd).checked = true;

                var inputs = document.getElementsByName('product');
                for (var i = 0, len = inputs.length; i<len; i++){
                    inputs[i].disabled = true;
                }

                

                $('#rsvname').text(data[0].agent_name);
                $('#rsvgroup').val(data[0].agentype);
                $('#rsvtype').val(data[0].group_name);
                $('#rsvby').val(data[0].reserve_by);
                $('#grpcd').val(data[0].group_cd);
                $('#agtype').val(data[0].agent_type_cd);
                $('#nupamt').val(formatNumber(data[0].nup_amt));
                // setpayment(payment);
                $('#remarkspayment').val(data[0].payment_type_remarks);
                $('#remarks_nup').val(data[0].remarks_nup);
                $('#remarks').val(data[0].remarks_nup);
                // setLocation(data[0].location_cd);
                // $('#location').val(data[0].loca)
                $('#prefix').val(data[0].prefix);
                setReason(data[0].revision_reason);
                bussID = data[0].business_id;

                setCity(data[0].city);
                // $('#property').text(data[0].property_descs);
                $('#property').val(data[0].property_descs);

                // document.getElementById("Location").disabled = true;
                document.getElementById("nuptype").readonly = true;
                // setsalutation(data[0].salutation);
                // $('#salutation').val(data[0].salutation);
                var aaaa = data[0].salutation;
                // console.log('asd'+aaaa+'sdf');
                $('#salutation').val(aaaa);
                // $("#salutation").trigger('change');

                setnationality(data[0].nationality);

                var nation = data[0].nationality;
                // alert(nation);
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


                // document.getElementById("nupdesc").disabled = true;
              });

        }
loaddata();
$(function() {

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
                console.log(sn);
                console.log(data);
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
                // BootstrapDialog.alert(rowID);
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

</script>

 
 