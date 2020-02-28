<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/custom.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/icheck/icheck.css')?>">

<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Ticket Entry</h3>
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
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
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
                              <form class="form" id="form_nup">
                                <div class="form-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                          <!-- <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>Ticket Type <FONT COLOR="RED">*</FONT></label>
                                                <div class="i-checks">
                                                  <label  id="radioR"> <input type="radio" name="ticket_type" id="R" value="R"> <i></i> Request </label> &emsp;
                                                  <label id="radioC"> <input type="radio" name="ticket_type" id="C" value="C"> <i></i> Complain </label>
                                                    &emsp;
                                                </div>
                                              </div>
                                            </div>

                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>Billing Type <FONT COLOR="RED">*</FONT></label>
                                                <div class="i-checks">
                                                  <label  id="radioT"> <input type="radio" name="bill_type" id="T" value="T"> <i></i> Customer</label> &emsp;
                                                  <label id="radioV"> <input type="radio" name="bill_type" id="V" value="V"> <i></i> Visitor </label>
                                                    &emsp;
                                                </div>
                                              </div>
                                            </div>
                                            
                                          </div> -->
                                      <div class="form-group">
                                        <label>Ticket Type <FONT COLOR="RED">*</FONT></label>
                                        <div class="i-checks">
                                          <label  id="radioR"> <input type="radio" name="ticket_type" id="R" value="R"> <i></i> Request </label> &emsp;
                                          <label id="radioC"> <input type="radio" name="ticket_type" id="C" value="C"> <i></i> Complain </label>
                                            &emsp;
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label>Customer Type <FONT COLOR="RED">*</FONT></label>
                                        <div class="i-checks">
                                          <label  id="radioT"> <input type="radio" name="bill_type" id="T" value="T"> <i></i> Customer</label> &emsp;
                                          <label id="radioV"> <input type="radio" name="bill_type" id="V" value="V"> <i></i> Visitor </label>
                                            &emsp;
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label for="debtor_name">Name <FONT COLOR="RED">*</FONT></label>
                                        <select data-placeholder="Select Debtor." class="select2 form-control" id="debtor_name" name="debtor_name">
                                            <option value=""></option>
                                              <?php echo $dtdebtor?>
                                        </select>
                                      </div>
                                      <div class="form-group">
                                       <label>Requested By <FONT COLOR="RED">*</FONT></label>              
                                        <input type="text" class="form-control " name="serv_req_by" id="serv_req_by">
                                      </div>
                                      <div class="form-group">
                                        <label>Contact No. <FONT COLOR="RED">*</FONT></label>    
                                        <input type="text" class="form-control " maxlength ="20" name="contact_no" id="contact_no" placeholder="Input Handphone Number">
                                      </div>
                                      <div class="form-group">
                                        <label for="complain_source">Complain Source <FONT COLOR="RED">*</FONT></label>
                                        <select data-placeholder="Select Complain Source" class="select2 form-control" id="complain_source" name="complain_source">
                                          <option value=""></option>
                                          <?php echo $datacomplain?>
                                        </select>
                                      </div>
                                      
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label for="debtor_name">Lot No. </label>
                                            <select data-placeholder="Select Lot No" class="select2 form-control" id="lotno" name="lotno">
                                              <option value=""></option>
                                              <?php echo $datalot?>
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label>Floor</label>
                                              <input type="text" class="form-control" name="floor" id="floor" placeholder="Input Floor" readonly="">
                                          </div>
                                        </div>
                                        
                                      </div>


                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="category">Category Problem / Request <FONT COLOR="RED">*</FONT></label>
                                          <select class="select2 form-control" name="category" id="category" data-placeholder="Select Category">
                                          <option value=""></option>
                                        </select>   
                                      </div>

                                      <div class="form-group">
                                        <label>Work Requested <FONT COLOR="RED">*</FONT></label>
                                          <textarea class="form-control" placeholder="Input Work Requested" name="work_req" id="work_req" style=" height: 120px;"></textarea>
                                      </div>

                                      <div class="form-group">
                                        <label>Location of Problem / Request</label>
                                        <input type="text" class="form-control" name="location" id="location" placeholder="e.g. in The Meeting Room or Men's Room">
                                      </div>

                                      <div class="form-group">
                                        <button class="btn btn-primary" id="btnAdd" type="button"><i class="ft-plus"></i> Add Picture</button>
                                      </div>

                                      <div class="row">
                                        <fieldset class="form-group col-sm-7">
                                          <div class="custom-file">
                                              <input type="file" id="userfile1" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(1,this)"/>
                                              <label id="labelimage1" class="custom-file-label" for="userfile1">Select Picture</label>
                                          </div>
                                          <p>(* Only Jpg, Png allowed and max size is below 500 kb)</p>
                                        </fieldset>
                                        <div class="col-sm-3" id="logo">
                                          <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox1">
                                        </div>
                                        <input type="hidden" id="picturepath1" value="<?php echo ''?>" readonly="1">
                                          <input type="hidden" id="picturename1" name="picturename[]" readonly="1">                                   
                                      </div>

                                      <div id="pict_div">
                                      </div>

                                      <!-- <div class="form-group">
                                        <label><button class="btn btn-primary" id="btnAdd" type="button"><i class="ft-plus"></i> Add Picture</button></label>
                                        <div id="logo" class="image" >
                                          <img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox1">
                                          <br>
                                          <br>
                                          <span class="btn btn-success fileinput-button">
                                            <span>Select Picture...</span>
                                            <input type="file" id="userfile1" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage(1,this)"/>
                                          </span>
                                          <p>(* Only Jpg, Png allowed and max size is below 500 kb)</p>
                                          <input type="hidden" id="picturepath1" value="<?php echo ''?>" readonly="1">
                                          <input type="hidden" id="picturename1" name="picturename[]" readonly="1">
                                        </div>
                                      </div>
                                      <span id="pict_div">
                                      </span> -->
                                      <input type="hidden" id="batas" name="batas" value="2"/>
                                      <input type="hidden" class="form-control " name="seq_no_ticket" id="seq_no_ticket">
                                      <input type="hidden" class="form-control " name="visitor_acct" id="visitor_acct">      
                                    </div>
                                  </div>
                                </div>
                              </form>
                            </div>
                            <div class="card-footer">
                              <input type="button" name="btnSave" id="btnSave" value="Submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/icheck/icheck.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/checkbox-radio.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

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
    return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  }
</script>

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

<script type="text/javascript">
    loaddata();
    
    function saveImage(seq, el) {
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
        block(true)
        $.ajax({
                url : "<?php echo base_url('c_cs/savePic2');?>",
                type:"POST",
                data: function () {
                    var data = new FormData();
                    data.append("seq_no_ticket", $("#seq_no_ticket").val());
                    data.append("seqno", seq);
                    data.append("userfile", $("#userfile"+seq).get(0).files[0]);
                    return data;
                }(),
                processData: false,
                contentType: false,
                dataType:"json",
                success:function(data, status){
                if(data.status == "OK"){
                      block(false)
                      swal({
                        title: "Information",
                        text: data.pesan,
                        type: "success",
                        confirmButtonText: "OK"
                      });
                      console.log(data.url)
                      $('#picturebox'+seq).attr('src', data.url);
                    } else {
                      block(false)
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      // document.getElementById('loader').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                      block(false)
                    swal(textStatus+' Save : '+errorThrown);
                }
            });
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
                $('#R').iCheck('check');
                $('#T').iCheck('check');
                $( "label#radioR" ).trigger("click");
                $('.i-checks').iCheck({
                    radioClass: 'iradio_square-green',
                });
            });

  
// $("#btnAdd").click(function() 
//   {
//     var xx = $("#batas").val();
//     for (var i = xx; i <= xx; i++) 
//     {
    
//       $('#pict_div').append('<div class="form-group" id="pictgroupdiv'+i+'"><label><button class="btn btn-danger btn-outline"  onclick="remove('+i+')" type="button">Remove</button> Picture '+i+'</label><div><div id="logo" class="image" ><img class="img-responsive" src="<?php //echo(empty('') ? //base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox'+i+'"></div><br><span class="btn btn-success fileinput-button"><span>Select Picture...</span><input type="file" id="userfile'+i+'" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage('+i+',this)"/></span><p>(* Only Jpg, Png allowed)</p><input type="hidden" id="picturepath'+i+'" value="<?php //echo ''?>" readonly="1"><input type="hidden" id="picturename'+i+'" name="picturename[]" readonly="1"></div></div>');
   
//     }
//     xx = i;
//     $('#batas').val(i); 
  
    
//   });

$("#btnAdd").click(function() 
  {
    var xx = $("#batas").val();
    for (var i = xx; i <= xx; i++) 
    {
      $('#pict_div').append(
        '<div class="row" id="pictgroupdiv'+i+'">'+
          '<fieldset class="form-group col-sm-7">'+
            '<div class="custom-file">'+
                '<input type="file" id="userfile'+i+'" name="userfile" accept="image/x-png,image/gif,image/jpeg" onChange="saveImage('+i+',this)"/>'+
                '<label id="labelimage1" class="custom-file-label" for="userfile'+i+'">Select Picture</label>'+
            '</div>'+
            '<p>(* Only Jpg, Png allowed and max size is below 500 kb)</p>'+
          '</fieldset>'+
          '<div class="col-sm-3" id="logo">'+
            '<img class="img-responsive" src="<?php echo(empty('') ? base_url('img/PlProject/no_image.png'): base_url('img/PlProject/'.'') );?>" width="120px" id="picturebox'+i+'">'+
          '</div>'+
          '<div class="col-sm-1">'+
            '<button type="button" class="btn btn-danger" onclick="remove('+i+')"><i class="ft-trash-2"></i></button>'+
          '</div>'+
          '<input type="hidden" id="picturepath'+i+'" value="<?php echo ''?>" readonly="1">'+
          '<input type="hidden" id="picturename'+i+'" name="picturename[]" readonly="1">'+
        '</div>'
      );
   
    }
    xx = i;
    $('#batas').val(i); 
  });

  function remove(no){
    // alert(no);
    var xx = parseInt($('#batas').val());
    
    $("#pictgroupdiv"+no).remove();
   
    // $("#tab-"+no).remove();
    // if ($('li').hasClass('active')) {
    //   $('li').removeClass('active')
    // }
    // if ($('div').hasClass('active')) {
    //   $('div').removeClass('active')
    // }
    
    // $('#tabsli-1').attr("class","active");
    // $('#tab-1').attr("class","tab-pane active");
   
    if(xx>1) {
      xx = xx-1;
      console.log(xx);
      $("#batas").val(xx);  
    }
  }
    function changepic(no){
        var thiss = $('#picture'+no);
        $("#picturepath"+no).val(thiss[0].files[0].name);
        // alert(thiss[0].files[0].name);
        // console.log(thiss[0].files[0].name);
        readURL(thiss,no);
    }
        

    function readURL(input,no) {

        if(input[0].files && input[0].files[0])
        {
            // alert('yas');
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#picturebox"+no).attr('src', e.target.result);
            }
            reader.readAsDataURL(input[0].files[0]);
        }
    }
  var ddx = <?php echo $ddx;?>;
  $('#debtor_name').prop("disabled",ddx);
  var debtor = $('#debtor_name').find(':selected');
  var lotno = $('#lotno').find(':selected');
  var no = '',floor = ''; 
  // console.log(deb);
  if(debtor){
    no = debtor.data('telp');
    floor = lotno.data('floor');
    // $('#debtor_name').find(':selected').data('telp');
  } else {
    no = '';
    floor = '';
  }
  // alert(no);
  $('#contact_no').val(no);
  $('#floor').val(floor);
  $('.select2').select2({ width: '100%' });
// alert('wkwk');


          var typevalue='';
          $('input[name=ticket_type]').on('ifChanged', function (event) {
                typevalue = $("input[name=ticket_type]:checked").val();
                // alert(typevalue);
               
                  // alert(typevalue);
                  if(typevalue!=null){
                    if(typevalue=='C' || typevalue=='R'){
                      var site_url = '<?php echo base_url("c_cs/zoom_category_from")?>';
                      $.post(site_url,
                        {prod:typevalue},
                        function(data,status) {
                          $("#category").empty();
                          $("#category").append(data);
                          $("#category").trigger('change');
                        }
                      );
                    }
                    
                  }
                  
                  $("#category").trigger('change');
            });

          var value='';
          $('input[name=bill_type]').on('ifChanged', function (event) {
                value = $("input[name=bill_type]:checked").val();
                visitor_acct = $("#visitor_acct").val();
                  if(value!=null){
                    if(value=='V'){
                      var site_url = '<?php echo base_url("c_cs/zoom_debtor_from/")?>'+visitor_acct;
                      $.get(site_url, function(data,status) {
                          $("#debtor_name").empty();
                          $("#debtor_name").append(data);
                          $("#debtor_name").trigger('change');
                          $("#debtor_name").attr('disabled','disabled');
                        }
                      );
                    }
                    else if(value=='T'){
                      var site_url = '<?php echo base_url("c_cs/zoom_debtor_from")?>';
                      $.get(site_url, function(data,status) {
                        console.log(data)
                          $("#debtor_name").empty();
                          $("#debtor_name").append(data);
                          $("#debtor_name").trigger('change');
                          $("#debtor_name").removeAttr('disabled');
                        }
                      );
                    }
                  }
            });
  
  $('#lotno').change(function(){
        var prod = $(this).find(':selected').val();
        lotno = prod;
        // alert(prod);
        if(prod!==''){
           var site_url = '<?php echo base_url("c_cs/zoom_floor")?>';
            $.post(site_url,
              {prod:prod},
              function(data,status) {
                console.log(data);
                $("#floor").val(data);
              }
            );

        }
           
    });

// $('input[name=ticket_type]').on('click',function(e){
//   if (document.getElementById('C').checked) { 
//     // document.getElementById('namadetail').innerHTML = "Complain";
//     $('#ticket_type').val('C');
//   }else {
//     // document.getElementById('namadetail').innerHTML = "Request";
//     $('#ticket_type').val('R');
//   }
// });

    // $('#form_nup').validate({
    //   ignore: "",
    //   rules: {
    //     contact_no: { required: true},
    //     debtor_name: {required: true},
    //     // lotno: {required: true},
    //     serv_req_by: {required: true},
    //     // location:{required: true},
    //     work_req1:{required: true},
    //     category1:{required:true}
    //   },
    //   messages: {cntfile: {attached: "Upload file need to completed"},
    //             npwp: { cek_npwp: "NPWP is not valid"},
    //             noktp: {check_noktp: " IC No. Is not valid"},
    //             HP: {cek_telp: "Handphone number is not valid"} 
    //           },
    //   errorElement: "span",
    //   highlight: function (element, errorClass, validClass) {
    //       $(element).addClass(errorClass); //.removeClass(errorClass);
    //       $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    //     },
    //     unhighlight: function (element, errorClass, validClass) {
    //       $(element).removeClass(errorClass); //.addClass(validClass);
    //       $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    //     },
    //     errorPlacement: function (error, element) {
    //       if (element.parent('.input-group').length) {
    //         error.insertAfter(element.parent());
    //       } else if (element.hasClass('select2_demo_1') || element.hasClass('select2_demo_2')) {
    //         error.insertAfter(element.next('span'));
    //       } else {
    //         error.insertAfter(element);
    //       }
    //     }

    // });

   

    $("#debtor_name").change(function() {
    // Pure JS
    
    var debtor_acct = this.value;
    var rowID = '<?php echo $rowID; ?>';
    // var ll = $('#lotno').val();
    // alert(lotno+' sdfsdfsd');
    var telp = this.options[this.selectedIndex].dataset.telp;
    // console.log(this.options[this.selectedIndex].dataset);
    $('#floor').val("");
      if(debtor_acct!=='') {
            var site_url = '<?php echo base_url("c_cs/zoom_lot_no")?>';
            $.post(site_url,
              {debtor_acct:debtor_acct},
              function(data,status) {
                // console.log(data);
                $("#lotno").empty();
                $("#lotno").append(data);
                console.log(lotno);
                if(rowID==0){
                  if(lotno[0].innerHTML.length!=0){
                  // $('#lotno').val
                  $("#lotno").val(lotno).trigger('change');
                  }
                }else{
                  if(lotno.length!=0){
                  // $('#lotno').val
                  $("#lotno").val(lotno).trigger('change');
                  }
                }
                
                

              }
              );
          } else {
            $("#lotno").empty();
          }

      $('#contact_no').val(telp);
    
});
function lololo(){
  document.getElementById('haha').hidden=false; 
}
    
    $('#btnSave').click(function(){            

                  block(true)

      // if($('#form_nup').valid()){

        var notpln = $("#contact_no").val();
        var notpln2 = notpln.substring(0, 1);
        if (notpln2==0) {
          notpln = notpln.replace(0,62);
        }


        var debtor = $('#debtor_name').val();
        var unitdescs = $('#lotno').find(":selected").text();
        var datafrm = $('#form_nup').serializeArray();
        var rowID = '<?php echo $rowID; ?>';
        datafrm.push(
          {name:"debtor_name",value:debtor},
          {name:"lotdescs",value:unitdescs},
          {name:"rowID",value:rowID}
          );
        // document.getElementById('haha').hidden=false; 
            $.ajax({
                url : "<?php echo base_url('c_cs/save');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(data, status){
                  
                if(data.status =='OK'){
                  block(false)
                      swal({
                        title: "Information",
                        text: data.pesan,
                        type: "success",
                        confirmButtonText: "OK"
                      }).then(function(){
                        location.reload();
                      })
                      var ticket = data.ticket
                      var nama = $("#serv_req_by").val()
                      var category = $("#category option:selected").text();
                      var pesan = nama+' your ticket number *%23'+ticket+'%23* already submitted for work requested Category in '+category+'. Thank You'
                      $.ajax({
                        url : 'http://35.197.137.111/whatsapp.php?IDus=CUS00000001&Handphone='+notpln+'&Messages='+pesan,
                        type: "POST",
                      })

                      $('#form_nup').trigger("reset");

                    } else {
                  block(false)  
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                        },
                        function(){
                          // document.getElementById('haha').hidden=true; 
                          window.location.href="<?php echo base_url('c_cs/insert');?>";  
                      });
                      
                      
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                  block(false)
                    swal(textStatus+' Save : '+errorThrown);
                }
            });

        // }
    });
    $('#btnemail').click(function(){
      document.getElementById('haha').hidden=false; 
      var debtor = $('#debtor_name').val();
      var unitdescs = $('#lotno').find(":selected").text();
        var datafrm = $('#form_nup').serializeArray();
        datafrm.push(
          {name:"debtor_name",value:debtor},
          {name:"lotdescs",value:unitdescs}
          );

      // if($('#form_nup').valid()){
        
            $.ajax({
                url : "<?php echo base_url('c_cs/sendemail');?>",
                type:"POST",
                data: datafrm,
                dataType:"json",
                success:function(data, status){
                  
                if(data.status =='OK'){
                      swal({
                        title: "Information",
                        text: data.pesan,
                        type: "success",
                        confirmButtonText: "OK"
                      },
                      function(){
                        document.getElementById('haha').hidden=true; 
                        // window.location.href="<?php echo base_url('c_cs/insert');?>"
                      });
                    } else {
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      document.getElementById('haha').hidden=true; 
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                }
            });

        // }
    });

    function loaddata(){
      var id = '<?php echo $rowID; ?>';

      if(id>0){
        $.getJSON("<?php echo base_url('c_cs/getByID');?>" + "/" + id, function (data) {
          console.log(data);
          lotno = data[0].lot_no;
          $('#debtor_name').val(data[0].debtor_acct).trigger('change');
          $('#lotno').val(data[0].lot_no).trigger('change');
          $('#category').val(data[0].category_cd).trigger('change');
          $('#serv_req_by').val(data[0].serv_req_by);
          $('#contact_no').val(data[0].contact_no);
          
          $('#floor').val(data[0].floor);
          $('#location').val(data[0].location);
          $('#complain_no').val(data[0].complain_no);
          $('#work_req').val(data[0].work_requested);
          $('#picturebox1').attr('src', data[0].file_url);
          // $('#userfile').val(data[0].file_url);
          // console.log($('#userfile').val('img/PlProject/no_image.png'));

        })
      }else{
        $('#serv_req_by').val('<?php echo ucwords($this->session->userdata("Tsuname"));?>');
        $('#seq_no_ticket').val('<?php echo $seq_no_ticket?>');
        $('#visitor_acct').val('<?php echo $visitor_acct?>');
        // $("#userfile").attr("required","true");
        
      }

    }

    function block(boelan){
        var block_ele = $('#form_nup')
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