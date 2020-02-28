
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">


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
#juduldetail{
  background-color: #00a1e4;
  color: white;
  padding: 10px;
  /*text-align: center;*/
}
.btn-biru {
    background-color: #00a1e4;
    border-color: white;
    color: #FFFFFF;
}
.btn-biru:hover, .btn-biru:focus, .btn-biru:active, .btn-biru.active, .open .dropdown-toggle.btn-green, .btn-biru:active:focus, .btn-biru:active:hover, .btn-biru.active:hover, .btn-biru.active:focus {
    background-color: #0088c1;
    border-color: white;
    color: #FFFFFF;
}
.bodydetail{
  background-color: #fff;
  /*color: white;*/
  padding: 10px;
  padding-top: 15px;
  margin-left: -15px;
  margin-top: -15px;
  margin-right: -15px;
  /*text-align: center;*/
}
hr {
  border : 0;
  height: 1px; 
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
}
.hr-line-solid{
  border : 0;
  height: 1px; 
  background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0,0,255,1), rgba(0, 0, 0, 0));
}
</style>



<style type="text/css">
 .tabs-container > .nav > li > a {
    padding: 10px 15px;
    color: #00a1e4;
    background-color: #f2f2f2;
    border-bottom: solid 1px #e7eaec;
}

</style>
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before" style="height: 120px !important;"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <br><br>
            <h3 class="content-header-title">Application Entry</h3>
          </div>

          <div class="content-header-right col-md-8 col-12 mb-2">
            <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item active">Customer Service
                    </li>
                    <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Survey
                    </li> -->
                    </ol>
                </div>
            </div>
        </div>

        </div>
     

         <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                              <div class="card-header">
                                  <h4 class="card-title"><?php echo $ProjectDescs; ?></h4>
                                  <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                  <div class="heading-elements">
                                    <!-- Ticket Date -->
                                    <div id="txtTime" style="color: #00a1e4;font-weight: bold">
                                    </div>
                                  </div>
                              </div>
                          <div class="card-content collapse show">
                            <div class="card-body card-dashboard">
                              <form class="form" id="frmEditor" class="needs-validation" novalidate>
                                <div class="form-body">
                                  <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                         <label>Application Type <FONT COLOR="RED">*</FONT></label>
                                         <div class="col-sm-10">
                                          <div class="i-checks">
                                            <label  id="radioA"> <input type="radio" name="ticket_type" id="A" value="A"> <i></i> Access </label> &emsp;
                                            <label id="radioP"> <input type="radio" name="ticket_type" id="P" value="P"> <i></i> Parking </label>
                                              &emsp;
                                            <label id="radioT"> <input type="radio" name="ticket_type" id="T" value="T"> <i></i> Telephone </label>
                                              &emsp;
                                          </div>
                                          <input type="hidden" name="bill_type" id="bill_type" value="T">
                                        </div>
                                      </div>
                                      <div class="form-group" >
                                         <label >Name <FONT COLOR="RED">*</FONT></label>
                                         <div class="col-sm-10">                
                                          <input type="text" class="form-control " name="serv_req_by" id="serv_req_by" placeholder="Input Name" required>
                                           <div class="invalid-tooltip">
                                            Please fill the name.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group" >
                                         <label >Contact No. <FONT COLOR="RED">*</FONT></label>
                                         <div class="col-sm-10">                
                                          <input type="text" class="form-control " name="contact_no" id="contact_no" placeholder="Input Contact Number" required>
                                          <div class="invalid-tooltip">
                                            Please fill contact number.
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label >Company Name <FONT COLOR="RED">*</FONT></label>
                                        <div class="col-sm-10">
                                          <select class="form-control select2" name="debtor_name" id="debtor_name" data-placeholder="Select Debtor." required>
                                          <option value=""></option>
                                          <?php echo $dtdebtor?>
                                          </select>
                                          <div class="invalid-tooltip">
                                            Please choose company name.
                                          </div>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label >Lot No. <!-- <FONT COLOR="RED">*</FONT> --></label>
                                        <div class="col-sm-10">
                                          <select class="form-control select2" name="lotno" id="lotno" data-placeholder="Select Lot No.">
                                          <option value=""></option>
                                  
                                          </select>
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label >Floor</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="floor" id="floor" placeholder="Input Floor" disabled="true" >
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label >Location</label>
                                        <div class="col-sm-10">
                                          <input type="text" class="form-control" name="location" id="location" placeholder="Input Location">
                                        </div>
                                      </div>
                                      
                                        <div class="form-group">
                                          <label >Reason <FONT COLOR="RED">*</FONT></label>                
                                          <div class="col-sm-10">
                                            <select class="form-control select2" name="category" id="category" data-placeholder="Select Category">
                                            <option value=""></option>
                                            <?php echo $datacategory?>
                                            </select>   
                                          </div>
                                        </div>
          
                                    <div class="form-group">
                                      <label >Description <FONT COLOR="RED">*</FONT></label>                
                                      <div class="col-sm-10">
                                          <textarea class="form-control" placeholder="Input Work Request" name="work_req" id="work_req" style=" height: 50px;"></textarea>
                                      </div>
                                    </div>
                                    </div>
                                   <input type="hidden" id="batas" name="batas" value="2"/>
                                   <input type="hidden" class="form-control " name="complain_no" id="complain_no">
                                  <input type="hidden" class="form-control " name="seq_no_ticket" id="seq_no_ticket" value="<?php echo $seq_no_ticket ?>">
                                  </div>`
                                </div>
                              </form>
                            </div>
                            <div class="card-footer">
                              <input type="button" name="btnSave" id="btnSave" value="Save" class="btn btn-primary">
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

  
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>
 
  <script type="text/javascript">
    loaddata();
   function block(boelan){
        var block_ele = $('#frmEditor')
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

// ini buat jam
window.onload = function() { jam(); }

 function jam() {
  var e = document.getElementById('txtTime'),
  d = new Date(), h, m, s;
  h = d.getHours();
  m = set(d.getMinutes());
  s = set(d.getSeconds());
  em = d.toLocaleDateString("en-en", {month: "short"});

  e.innerHTML = d.getDate() + ' ' + em + ' ' + d.getFullYear() + ' ' + h +':'+ m +':'+ s;

  setTimeout('jam()', 1000);
 }

 function set(e) {
  e = e < 10 ? '0'+ e : e;
  return e;
 }
 // end of jam
            $(document).ready(function () {
                $('#A').iCheck('check');
                $( "label#radioA" ).trigger("click");
                $('.i-checks').iCheck({
                   checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });



  $('.select2').select2({ width: '100%' });

      var typevalue='';
          $('.i-checks').on('ifChanged', function (event) {
                typevalue = $("input[name=ticket_type]:checked").val();
                // alert(typevalue);
               
                  // alert(typevalue);
                  block(true);
                  var site_url = '<?php echo base_url("c_cs/zoom_category_from")?>';
                  $.post(site_url,
                    {prod:typevalue},
                    function(data,status) {
                      console.log(data);
                      $("#category").empty();
                      $("#category").append(data);
                      $("#category").trigger('change');
                      var description = $(this).find(':selected').data('reasondescs');
                      $('#work_req').text(description);
                      block(false);
                    }
                  );
               
            });

  $('#category').change(function(){
    var description = $(this).find(':selected').data('reasondescs');
    $('#work_req').text(description);

  });
   $('#lotno').change(function(){
    block(true);
        var lotno = $(this).find(':selected').val();
        // lotno = prod;
       
        if(lotno==''||lotno==undefined||lotno==null){
          
           // alert(lotno);
        } else {
           var site_url = '<?php echo base_url("c_cs/zoom_floor")?>';
            $.post(site_url,
              {prod:lotno},
              function(data,status) {
                // console.log(data);
                $("#floor").val(data);
                block(false);
              }
            );
        }
           
    });


   

    $("#debtor_name").change(function() {
    // Pure JS
    block(true);
    var debtor_acct = this.value;
    var rowID = '<?php echo $rowID; ?>';
    // var ll = $('#lotno').val();
    // alert(lotno+' sdfsdfsd');
    var telp = this.options[this.selectedIndex].dataset.telp;
    // alert('yas');
    $('#floor').val("");
      if(debtor_acct!=='') {
            var site_url = '<?php echo base_url("C_cs/zoom_lot_no")?>';
            $.post(site_url,
              {debtor_acct:debtor_acct},
              function(data,status) {
                // console.log(data);
                $("#lotno").empty();
                $("#lotno").append(data);
        
                $("#lotno").val(lotno).trigger('change');
                block(false);
                }
                
              );
          } else {
            $("#lotno").empty();
            block(false);
          }

      // $('#contact_no').val(telp);
    
});
$('#frmEditor').validate({
      ignore: "",
      rules: {
        contact_no: { required: true},
        debtor_name: {required: true},
        // lotno: {required: true},
        serv_req_by: {required: true},
        // location:{required: true},
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
    
    $('#btnSave').click(function(){            

      if($('#frmEditor').valid()){
        var notpln = $("#contact_no").val();
        var notpln2 = notpln.substring(0, 1);
        if (notpln2==0) {
          notpln = notpln.replace(0,62);
        }
        var debtor = $('#debtor_name').val();
        var floor = $('#floor').val();
        var unitdescs = $('#lotno').find(":selected").text();
        var datafrm = $('#frmEditor').serializeArray();
        var rowID = '<?php echo $rowID; ?>';
        datafrm.push(
          {name:"debtor_name",value:debtor},
          {name:"lotdescs",value:unitdescs},
          {name:"floor",value:floor},
          {name:"rowID",value:rowID}
          );
        // document.getElementById('haha').hidden=false; 
        block(true);
            $.ajax({
                url : "<?php echo base_url('c_cs/save');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(data, status){
                  
                if(data.status =='OK'){
                  block(false);
                      swal({
                        title: "Information",
                        text: data.pesan,
                        type: "success",
                        confirmButtonText: "OK"
                      })
                    .then(function(a){
                        var ticket = data.ticket
                        var nama = $("#serv_req_by").val()
                        var category = $("#category option:selected").text();
                        var pesan = nama+' your ticket number *%23'+ticket+'%23* already submitted for work requested Category in '+category+'. Thank You'
                        $.ajax({
                          url : 'http://35.197.137.111/whatsapp.php?IDus=CUS00000001&Handphone='+notpln+'&Messages='+pesan,
                          type: "POST",
                        })
                        block(false);
                        if(rowID==0){
                          window.location.href="<?php echo base_url('c_cs/application');?>";  
                        }else{
                          window.location.href="<?php echo base_url('dashboard/index');?>";
                        }
                        
                      });
                    } else {
                      block(false);
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      // document.getElementById('haha').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                    block(false);
                }
            });

        }
    });


    function loaddata(){
      var id = '<?php echo $rowID; ?>';
      // alert(id);
      if(id>0){
        $.getJSON("<?php echo base_url('c_cs/getByID');?>" + "/" + id+ "/A", function (data) {
          // console.log(data);
          lotno = data[0].lot_no;
          // console.log(lotno);
          $('#debtor_name').val(data[0].debtor_acct).trigger('change');
          $('#lotno').val(data[0].lot_no).trigger('change');
          $('#category').val(data[0].category_cd).trigger('change');
          $('#serv_req_by').val(data[0].serv_req_by);
          $('#contact_no').val(data[0].contact_no);
          
          $('#floor').val(data[0].floor);
          $('#location').val(data[0].location);
          $('#complain_no').val(data[0].complain_no);
          $('#work_req').val(data[0].work_requested);
          $('#'+data[0].complain_type).iCheck('check');
          $( "label#radio"+data[0].complain_type ).trigger("click");


        })
      }else{
    
        
      }

    }
  </script> 

</div>
