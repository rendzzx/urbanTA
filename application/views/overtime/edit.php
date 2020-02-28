<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
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
.clockpicker-popover {
    z-index: 999999;
}
 #loader{
    width:80%;
    height:100%;
    position:fixed;
   left: 9%;
    top: 1%;
   z-index: 99999;
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
                 <label>Overtime Date</label>                
                 <div class="col-sm-12" id="txtTime" style="color: #00a1e4;font-weight: bold">

              </div>
            </div>
            <div class="form-group">
              <label >Lot No. <FONT COLOR="RED">*</FONT></label>
              <div class="col-sm-12">
                <select class="form-control select2" name="lotno[]" id="lotno" data-placeholder="Select Lot No." tabindex="2">
                <option value=""></option>                
                <?php echo $datalot?>
                </select>
     
              </div>
            </div>           
            <div class="form-group">              
                <label >Start hour <FONT COLOR="RED">*</FONT></label>
                <div class="col-sm-12">
                  <div class="input-group clockpicker" data-autoclose="true">
                      <input type="text" class="form-control" id="startHour" name="startHour" autocomplete="off" >
                      <div class="input-group-append">
                        <span class="input-group-text">
                            <span class="ft-clock"></span>
                        </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label >End hour <FONT COLOR="RED">*</FONT></label>
                <div class="col-sm-12">
                <div class='input-group clockpicker' data-autoclose="true">
                    <input id="endHour" name="endHour" class="form-control" type="text" autocomplete="off" >
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <span class="ft-clock"></span>
                        </span>
                    </div>
                </div>
              </div>
               <div class="form-group">
                               
                 <div class="col-sm-12">
                  <b>Disclaimer</b><br>
                  This overtime form is limited to <?php echo $endhour?>. Minimum overtime request is 1 hour. If you need to submit the overtime form after <?php echo $endhour?>, kindly contact the Building Management. 

                </div>
            </div>
                <input id="txtdebtor" name="txtdebtor" class="form-control hidden" type="text">
                <input id="txtfloor" name="txtfloor" class="form-control hidden" type="text">
                <input id="txtfloordescs" name="txtfloordescs" class="form-control hidden" type="text">
            </div>
          
            </div>        
  
        </form>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<!-- <script src="<?=base_url('js/plugins/select2/select2.js')?>"></script> -->
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

  <script type="text/javascript">
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

e.innerHTML =dt;
$(document).ready(function () {
              

   $('.clockpicker').clockpicker({
        placement: 'bottom',
        align: 'left',
        donetext: 'Done'
    });
  $('#savefrm').click(function(){
      
      // console.log(e.innerHTML);
      // return;
        block(true);
      // alert('wkwk');
      if($('#form_nup').valid()){
        var datafrm = $('#form_nup').serializeArray();
        var ott = $('#modal').data('Ot_Id');        
        datafrm.push(
          {name:"ov_date",value:e.innerHTML} ,
          {name:"Ot_Id",value:ott}         
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
                        // window.location.href="<?php echo base_url('c_cs/insert');?>";
                        // location.reload();
                        $('#modal').modal('hide');
                        tblovertime.ajax.reload(null,true);   
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
    $('#lotno').select2({
        dropdownParent: "#modal",
        width: '100%' 
     });
    $( "#lotno" ).change(function(e) {
      var debtor = $(this).find(':selected').data('debtor'); 
      var floor = $(this).find(':selected').data('floor');  
      var levelDesc = $(this).find(':selected').data('leveldesc');  
      $('#txtdebtor').val(debtor);
      $('#txtfloor').val(floor);
      $('#txtfloordescs').val(levelDesc);

      // alert( "Handler for .change() called." );
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
        endHour: {required: true,cek_timer:true},
        lotno:{required: true}
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
              console.log(data);
              $("#lotno").val(data[0].lot_no).trigger('change');
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
