<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<style >
input[type="number"] {
  -webkit-appearance: textfield;
  -moz-appearance: textfield;
  appearance: textfield;
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
}

.number-input {
  border: 1px solid #ddd;
  display: inline-flex;
}

.number-input,
.number-input * {
  box-sizing: border-box;
}

.number-input button {
  outline:none;
  -webkit-appearance: none;
  background-color: transparent;
  border: none;
  align-items: center;
  justify-content: center;
  width: 3rem;
  height: 3rem;
  cursor: pointer;
  margin: 0;
  position: relative;
}

.number-input button:before,
.number-input button:after {
  display: inline-block;
  position: absolute;
  content: '';
  width: 1rem;
  height: 2px;
  background-color: #969696;
  transform: translate(-50%, -50%);
}
.number-input button.plus:after {
  transform: translate(-50%, -50%) rotate(90deg);
}

.number-input input[type=number] {
  font-family: sans-serif;
  width: 100%;
  padding: .5rem;
  border: solid #ddd;
  border-width: 0 2px;
  font-size: 2rem;
  height: 3rem;
  /*font-weight: bold;*/
  text-align: center;
}
.clockpicker-popover {
    z-index: 999999;
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
/*label {
  text-align: right;
}*/

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
 .tabs-container > .nav > li > a {
    padding: 10px 15px;
    color: #00a1e4;
    background-color: #f2f2f2;
    border-bottom: solid 1px #e7eaec;
}

</style>

        <form role="form" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method="POST" >
           <div class="ibox-content">
          <div class="form-group">
                 <label >Overtime Date</label>                
                 <div class="col-sm-12" id="txtTime" style="color: #00a1e4;font-weight: bold">

              </div>
            </div>
            <div class="form-group">
              <label >Debtor<FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-12">
                <select data-placeholder="Select Debtor." class="select2 form-control" id="debtor_name" name="debtor_name">
                    <option value=""></option>
                      <?php echo $dtdebtor?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label >Lot No. <FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-12">
       
                <select name="lotno" id="lotno" data-placeholder="Select Lot..." class="select2 form-control" >
                  <option value=""></option>
                  <?php echo $datalot;?>                
              </select>
              </div>
            </div>   
            <div class="form-group">
              <label >Over type <FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-12">
       
                <select name="over_cd" id="over_cd" data-placeholder="Select over type..." class="select2 form-control" >
                  <option value=""></option>
                  <?php echo $dataover;?>                
              </select>
              </div>
            </div>   
   <!--          <div class="form-group">
              <label >Zone type <FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-12">
       
                <select name="zone_type" id="zone_type" data-placeholder="Select zone type..." class="select2 form-control" >
                  <option value=""></option>             
              </select>
              </div>
            </div>   -->     
            <div class="form-group">              
                <label >Start hour</label>

                <div class="col-sm-12">
                  <div class="input-group clockpicker" data-autoclose="true" >
                      <input type="text" class="form-control" id="startHour" name="startHour" value='<?php echo $start_ot?>' disabled='true' autocomplete="off" >
                      <div class="input-group-append">
                        <span class="input-group-text">
                            <span class="ft-clock"></span>
                        </span>
                    </div>
                  </div>
                </div>
                
            </div>
            <div class="form-group">
               <label >Usage</label>
               <div class="col-sm-12">
                <div class="number-input">
                  <button onclick="" id="down_usage"></button>
                  <input id="usage" name="usage" class="form-control " type="number" value="1" min="1" step="0.5" disabled="true">
                  <button onclick="" id="up_usage" class="plus"></button>
                </div>
               
              </div>
            </div>
            <div class="form-group">
               <label >Total</label>
               <div class="col-sm-12">
                  <input id="trx_amt" name="trx_amt" class="form-control " type="text" disabled="true">
               </div>
            </div>
            <div class="form-group">
                               
                 <div class="col-sm-12">
                  <b>Disclaimer</b><br>
                  This overtime form is limited to <?php echo $endhour?>. Minimum overtime request is 1 hour. If you need to submit the overtime form after <?php echo $endhour?>, kindly contact the Building Management. 

                </div>
            </div>
                <input id="trx_type" name="trx_type" class="form-control hidden" type="text">
                <input id="tax_cd" name="tax_cd" class="form-control hidden" type="text">
                <input id="zone_type" name="zone_type" class="form-control hidden" type="text">
                <input id="type" name="type" class="form-control hidden" type="text">
                <input id="rate" name="rate" class="form-control hidden" type="text">
            </div>        
  
        </form>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
  <script type="text/javascript">
    $('#up_usage').click(function(e){
      e.preventDefault();
      var rate = parseFloat($('#rate').val());
      if(rate==0||rate==null||isNaN(rate)){
        alert('Please choose over type');
      }else{
         document.getElementById("usage").stepUp();
         hitung_trxamt();
      }
      return false;
    });
    $('#down_usage').click(function(e){
       e.preventDefault();
      var rate = parseFloat($('#rate').val());
      if(rate==0||rate==null||isNaN(rate)){
        alert('Please choose over type');
      }else{
         document.getElementById("usage").stepDown();
         hitung_trxamt();
      }
      return false;
    });
    function hitung_trxamt(){
   
      var rate = parseFloat($('#rate').val());
      var usage = parseFloat($('#usage').val());
      var total = parseFloat(rate*usage);
      $('#trx_amt').val(formatNumber(total.toFixed(2)));
   
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
var e = document.getElementById('txtTime');
    LoadData();
var dt = $('#modal').data('ovdate');

e.innerHTML = dt;
$(document).ready(function () {
  

   // $('.clockpicker').clockpicker({
   //      placement: 'top-dikit',
   //      align: 'kanan-dikit',
   //      donetext: 'Done'
   //  });

   $('#startHour').clockpicker({
        placement: 'starthour-overtime',
        align: 'kanan-dikit',
        donetext: 'Done'
    });

   $('#endHour').clockpicker({
        placement: 'endhour-overtime',
        align: 'kanan-dikit',
        donetext: 'Done'
    });

//    let optionss = {
//     donetext : 'Done',
//      placement: 'bottom',
//      align: 'left',

//      autoclose: true,
//         'default': 'now'
        
// }

   $('.select2').select2({
        // dropdownParent: "#modal",
        width: '100%' 
     });


    // $('#lotno').select2({
    //     dropdownParent: "#modal",
    //     width: '100%' 
    //  });

    // $( "#lotno" ).change(function(e) {
    //   // console.log(this.value)
    //   var data = this.value;
    //   // console.log(data)
    //   var data = data.split('-%-');
    //   var over_cd = data[2]
    //   block(true);
    //   $.getJSON("<?php echo base_url('c_overtime/zoom_ot_type');?>" + "/" + over_cd, function (data) {
    //         $('#trx_type').val(data[0].trx_type)
    //         $('#tax_cd').val(data[0].tax_cd)
    //         $('#type').val(data[0].type)
    //         block(false);
    //     });
    // });
    $( "#over_cd" ).change(function(e) {
      // console.log(this.value)
      var over_cd = $(this).find(':selected').val();
      // // console.log(data)
      block(true);
      $('#trx_type').val($(this).find(':selected').data('trxtype'));
      $('#tax_cd').val($(this).find(':selected').data('taxcd'));
      $('#type').val($(this).find(':selected').data('ottype'));
      
      if(over_cd!=='') {
            var site_url = '<?php echo base_url("c_overtime/zoom_zone_type")?>';
            $.post(site_url,
              {over_cd:over_cd},
              function(data,status) {
                block(false);
                console.log(data);
                var dt = JSON.parse(data);
                console.log(dt);
                // $("#zone_type").empty();
                // $("#zone_type").append(data);
                // $("#zone_type").trigger('change');
                $('#zone_type').val(dt.zone_cd);
                $('#rate').val(dt.rate);
                hitung_trxamt();
              });
      }
    });
    $( "#zone_type" ).change(function(e) {
      $('#rate').val($(this).find(':selected').data('rate'));
      hitung_trxamt();
    });

    $("#debtor_name").change(function() {
    
    block(true);
    var debtor_acct = this.value;
    var debtor_acct = debtor_acct.split("-%-");
    var debtor_acct = debtor_acct[0];
    var businessid = debtor_acct[1];
    var rowID = 0
    // var ll = $('#lotno').val();
    // alert(lotno+' sdfsdfsd');
    // var telp = this.options[this.selectedIndex].dataset.telp;
    console.log(this.options[this.selectedIndex]);
      $('#floor').val("");
      if(debtor_acct!=='') {
            var site_url = '<?php echo base_url("c_overtime/zoom_lot_no")?>';
            $.post(site_url,
              {debtor_acct:debtor_acct},
              function(data,status) {
                // console.log(data);

                $("#lotno").empty();
                $("#lotno").append(data);
                $("#lotno").trigger('change');
                // if(rowID==0){
                //   if(lotno[0].innerHTML.length!=0){
                //   // $('#lotno').val
                //   $("#lotno").val(lotno).trigger('change');
                //   }
                // }else{
                //   if(lotno.length!=0){
                //   // $('#lotno').val
                //   $("#lotno").val(lotno).trigger('change');
                //   }
                // }
                block(false);
                

              }
              );
          } else {
            $("#lotno").empty();
          }

      // $('#contact_no').val(telp);
    
});

    $('#savefrm').click(function(){
      
      // console.log(e.innerHTML);
      // return;
        block(true);
      // alert('wkwk');
      if($('#form_nup').valid()){
        var datafrm = $('#form_nup').serializeArray();
        var ott = $('#modal').data('Ot_Id');    
        var startHour = $('#startHour').val(); 
        var usage = $('#usage').val(); 
        var usage = $('#usage').val(); 
        var trx_amt = $('#trx_amt').val(); 
        console.log(datafrm); 
        datafrm.push(
          {name:"ov_date",value:e.innerHTML} ,
          {name:"Ot_Id",value:ott},
          {name:"startHour",value:startHour},
          {name:"usage",value:usage} ,
          {name:"trx_amt",value:trx_amt}         
          );
        // document.getElementById('loader').hidden=false; 
            $.ajax({
                url : "<?php echo base_url('c_overtime/save');?>",
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
                       })
                    .then(function(a){
                        // document.getElementById('loader').hidden=true; 
                        window.location.href="<?php echo base_url('c_overtime/index');?>";
                        // location.reload();
                        $('#modal').modal('hide');
                        // tblovertime.api().ajax.reload(null,true);  
                        // $('#tblovertime').DataTable().ajax.reload();
                        block(false);
                      });
                    } else {
                      swal({
                        title: "Error",
                        text: data.pesan,
                        type: "error",
                        confirmButtonText: "OK"
                      });
                      // document.getElementById('loader').hidden=true; 
                      block(false);
                    }
                },                    
                error: function(jqXHR, textStatus, errorThrown){
                  // document.getElementById('loader').hidden=true; 
                    swal(textStatus+' Save : '+errorThrown);
                    block(false);
                }
            });

        }
    });
           
});
 


    $.validator.addMethod("cek_timer", function (value, element) {
      var isSuccess = true;
      var StH = $('#startHour').val();
      console.log(value);
      var b = value.split(':');
      var a =  StH.split(':');
      console.log(a[0]);
      if(a[0]==b[0]){
        if(a[1]>b[1]){
          isSuccess = false;  
        }        
      }else if(a[0]>b[0]){
          isSuccess = false;  
      }
     
     return isSuccess;

    });
    $('#form_nup').validate({
      ignore: "",
      rules: {
        startHour: { required: true},
        debtor_name: {required: true},
        lotno: {required: true},
        over_cd:{required: true},
        zone_type:{required: true}
      },
      messages:{
        endHour:{cek_timer:"Can't be less than Start"}
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

   


   
    function parseDate(input) {
      var parts = input.match(/(\d+)/g);
      // new Date(year, month [, date [, hours[, minutes[, seconds[, ms]]]]])
      return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
    }
     // $('#modal').one('shown.bs.modal', function (e) {
      function LoadData(){

        var id = $('#modal').data('Ot_Id');
        ScreenID = id;
        
        if (id > 0) {
            $.getJSON("<?php echo base_url('c_overtime/getByID');?>" + "/" + id, function (data) {
              console.log(data)
                $("#debtor_name").val(data[0].debtor_acct+'-%-'+data[0].business_id+'-%-'+data[0].debtor_name).trigger('change');
                    block(true);
                setTimeout(function(){
                    block(false);
                    $("#lotno").val(data[0].lot_no+'-%-'+data[0].level_no).trigger('change');
                   },1000);
                // console.log(data[0].lot_no+'-%-'+data[0].level_no+'-%-'+data[0].over_cd+'-%-'+data[0].zone_cd)
                 $("#over_cd").val(data[0].over_cd).trigger('change');
                 block(true);
                setTimeout(function(){
                    block(false);
                    $("#zone_cd").val(data[0].zone_cd).trigger('change');
                    document.getElementById("usage").value = parseFloat(data[0].usage);
                    hitung_trxamt();
                   },1000);

                // $('#usage').val(parseFloat(data[0].usage));
                $('#trx_amt').val(data[0].trx_amt);
                ov_startdt = data[0].start_overtime;
                ov_enddt =data[0].end_overtime;

                start_dt = new Date(ov_startdt);
                endt_dt  = new Date(ov_enddt);

                var month = start_dt.getUTCMonth() + 1; //months from 1-12
                var day = start_dt.getUTCDate();
                var year = start_dt.getUTCFullYear();

                nn = parseDate(ov_startdt.substring(0,10));
                e.innerHTML = day.toString()+'-'+month.toString()+'-'+year.toString();

                Sstart_dtA = start_dt.getHours().toString().length == 1? '0'+start_dt.getHours().toString():start_dt.getHours().toString();
                Sstart_dtB = start_dt.getMinutes().toString().length == 1? '0'+start_dt.getMinutes().toString():start_dt.getMinutes().toString();

                Send_dtA = endt_dt.getHours().toString().length == 1? '0'+endt_dt.getHours().toString():endt_dt.getHours().toString();
                Send_dtB = endt_dt.getMinutes().toString().length == 1? '0'+endt_dt.getMinutes().toString():endt_dt.getMinutes().toString();

                $('#startHour').val(Sstart_dtA+':'+Sstart_dtB);

                $('#endHour').val(Send_dtA+':'+Send_dtB);
                $('#txtdebtor').val(data[0].debtor_acct);
                $('#txtfloor').val(data[0].level_no);
                $('#txtfloordescs').val(data[0].descs_level);

            });
        }


    // });
  }
     $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
  </script> 

</div>