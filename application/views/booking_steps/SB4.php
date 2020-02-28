  <style type="text/css">
    .wizard.vertical > .content{height: 550px !important}
  </style>
<style type="text/css">
    .loader{
      width:100%;
      height:100%;
      position:fixed;
      z-index:9999;
      background:url("<?=base_url('img/loading.gif') ?>") no-repeat center center     
    }  
  </style> 
<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-left"><b><?php echo $projectName; ?></b></div>
            <div class="tittle-top pull-right"><b>Booking</b></div>
        </div>
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
            <!-- next start -->
                <div class="ibox-content">
                <form class="wizard-big wizard clearfix" role="application" id="form">
                <div class="steps clearfix">
                    <ul role="tablist">
                      <li class="first done" role="tab" aria-disabled="false" aria-selected="false">
                        <a id="form-t-0" href="#form-h0" aria-controls="form-p-0">
                          <span class="current-info audible">current step: </span>
                          <span class="number">1. </span>
                          Choose Property
                        </a>
                      </li>
                      <li class="done" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">2. </span>
                          Choose Unit
                        </a>
                      </li>
                      <li class="done" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h2" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">3. </span>
                          Input Customer Information
                        </a>
                      </li>
                      <li class="current" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h3" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">4. </span>
                          Input Payment Plan + Disc
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h4" aria-controls="form-p-1">
                          <span class="current-info audible">current step: </span>
                          <span class="number">5. </span>
                          Finish
                        </a>
                      </li>
                    </ul>
                  </div>
                  </form>
                        <div class=""><br>
                  <div class="content" >
                    <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title">Payment Plan And Disc</h3>
                      </div>
                      <div class="panel-body row">
                        <!-- <form name="basicform" id="basicform" class="form-horizontal" method="post" action="#"> -->
                        <div class="box-body">
                              <div class="col-xs-12">                                  
                                  <div  class="form-group">
                                    <label class="col-xs-2 font-noraml"><h4>Sales Date</h4></label>                               
                                    <label class="col-xs-10"><h4><?php echo(date('l, d F Y')); ?></h4></label>
                                  </div>
                              </div>
                              <div class="col-xs-12">                                  
                                  <div  class="form-group">
                                    <label class="col-xs-2 font-noraml"><h4>Name</h4></label>                               
                                    <label class="col-xs-10"><h4><?php echo $data_cf_business[0]->name; ?></h4></label>
                                  </div>
                              </div>

                              <div  class="form-group">
                              <form name="step_sales" id="step_sales" class="wizard-big" method="post" action="#">
                                <!-- <div id="step_sales"> -->
                                  <?php echo $list_rl_sales;?>
                                <!-- </div>   -->
                                </form>                              
                              </div>
                            </div>
                            <div class="box-footer col-xs-12">
                              <!-- <div class="form-group"> -->
                                <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-primary">
                                <input type="button" name="btnNext" id="btnNext" value="Next" class="btn btn-primary">
                            </div>
                        <!-- </form>      -->
                      
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>           



      

<script type="text/javascript">
    
    $(document).ready(function(){
      $('#step_sales').steps({
                headerTag: "h1",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                stepsOrientation: "vertical",
                enableCancelButton: false,
                labels: {
                    finish: "Save"
                },
                

                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    // console.log(currentIndex);
                    // console.log(newIndex);
                    
                    console.log('onStepChanging');
                    // console.log(event);
                    var a = $('#userName').val();
                    // alert(a);
                    // console.log('onStepChanging');
                    if (currentIndex > newIndex)
                    {
                      console.log('currentIndex > newIndex');
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                      console.log('newIndex === 3 && Number($("#age").val()) < 18');
                        return false;
                    }

                    var form = $(this);
                    var dataform = $('#step_sales').serializeArray();
                    // console.log(dataform);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                      console.log('newIndex === 3 && Number($("#age").val()) < 18');
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }
                    // return true;
                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    console.log(form.valid());
                    console.log('form.valid()');
                    // Start validation; Prevent going forward if false
                    return form.valid();

                    
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                  console.log('onStepChanged');
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                  console.log('onFinishing');
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                  document.getElementById('loader').hidden=false;
                    var form = $(this);
                    var site_url      = "<?php echo site_url('c_stepbooking/isi_data_rl_sales/');?>";
                    var unit_booked = '<?php echo $unit_book;?>';
                    var business_id = '<?php echo $data_cf_business[0]->business_id;?>';
                    var category = '<?php echo $data_cf_business[0]->category;?>';
                    var dataform = $('#step_sales').serializeArray();
                    dataform.push(
                                    {name:"unit_book",value:unit_booked},
                                    {name:"business_id",value:business_id},
                                    {name:"category",value:category}
                                  );
                    // console.log(dataform);
                    // console.log(form)
                    $.ajax({
                        url : site_url,
                        type:"POST",
                        data:dataform,
                        dataType:"json",
                        success:function(data){
                          document.getElementById('loader').hidden=true;
                          // console.log(data);
                          // console.log(data);
                          if(data.Status=='OK'){
                            swal({
                            title: "Information",
                            text: data.Pesan,
                            type: "success",
                            confirmButtonText: "OK"
                            },
                            function(){
                              // swal('sukses');
                              // window.location.href="<?php echo base_url('c_stepbooking/add_payment');?>"+"/"+event.id;
                            });
                          }else{
                            swal("Error Save",data.Pesan,"error");
                          }  

                          // if(data.Status=='Submit'){
                          //   $('#btnBack').text('Submit');
                          //   document.getElementById("btnchange").disabled = true;
                            
                          //   BootstrapDialog.alert(data.Pesan);
                          // }else{
                          //   BootstrapDialog.alert(data.Pesan);
                          // }
                          // $('#txt_debtor').val(data.debtor);
                        }
                        ,
                        error: function(jqXHR, textStatus, errorThrown){
                          // delete_gagal();
                          // console.log(jqXHR);
                          // console.log(textStatus);
                          // console.log(errorThrown);

                         swal("Error Save",textStatus+' Stored Procedure SQL',"error");
                          // var url = '<?php echo base_url("submitsales/index"); ?>'
                          // $(location).attr('href',url);
                         
                        }
                    });


                    // Submit form input
                    // form.submit();
                }
                
            }).validate({
                        errorPlacement: function (error, element)
                        {
                            element.before(error);
                        }//,
                        // rules: {
                        //     confirm: {
                        //         equalTo: "#password"
                        //     }
                        // }
                    });

      $(".select2_demo_1").select2({
      width:"100%"
      });

      $('#btnback').click(function(){
      var a = '<?php echo $data_cf_business[0]->business_id;?>';
      var b = '<?php echo $property_type;?>';
      window.location.href = "<?php echo base_url('c_stepbooking/add_customer')?>"+'/'+a+"/"+b;
      
      
     });

      $('#btnNext').click(function(){
       
       if($('#step_sales').valid()){
                var site_url = "<?php echo base_url('c_stepbooking/unset_session')?>";
                $.ajax({
                  url: site_url,
                  type: "POST",
                  data: {property_cd:"ok"},
                  dataType: "json",
                  success: function(data, status){


                    document.getElementById('loader').hidden=false;
                    var form = $(this);
                    var site_url      = "<?php echo site_url('c_stepbooking/isi_data_rl_sales/');?>";
                    var unit_booked = '<?php echo $unit_book;?>';
                    var business_id = '<?php echo $data_cf_business[0]->business_id;?>';
                    var category = '<?php echo $data_cf_business[0]->category;?>';
                    var dataform = $('#step_sales').serializeArray();
                    dataform.push(
                                    {name:"unit_book",value:unit_booked},
                                    {name:"business_id",value:business_id},
                                    {name:"category",value:category}
                                  );
                    // console.log(dataform);
                    // console.log(form)
                    $.ajax({
                        url : site_url,
                        type:"POST",
                        data:dataform,
                        dataType:"json",
                        success:function(data){
                          document.getElementById('loader').hidden=true;

                          if(data.Status=='OK'){
                            swal({
                            title: "Information",
                            text: data.Pesan,
                            type: "success",
                            confirmButtonText: "OK"
                            },
                            function(){

                            });
                          }else{
                            swal("Error Save",data.Pesan,"error");
                          }  
                        }
                        ,
                        error: function(jqXHR, textStatus, errorThrown){

                         swal("Error Save",textStatus+' Stored Procedure SQL',"error");
                        }
                    });
                    
                    window.location.href = "<?php echo base_url('c_stepbooking/finish')?>";

                  },
                  error: function(jqXHR, textStatus, errorThrown){
                    swal(textStatus+' Save : '+errorThrown);
                  }
                })
                       
        }else{
          swal("Please finish step booking first")
        }

     });
    });
    
    function tampil_data(data){
      // alert(data);
      var site_url    = "<?php echo site_url('C_rl_sales/set_field2/');?>";
        var lot_unit    = data;
        var payment_cd  = $('#payment'+data).val();
        var response = "";
        var tes = "";
         if(lot_unit.length==0){
          return;
        }
        if(payment_cd.length==0){
          return;
        }
         $.ajax({
        type: "POST", 
        url: site_url, 
        data: { lot_no: lot_unit ,payment: payment_cd},
        success: function(response)
        {
              if(response.length==0){

              swal({
                  title: "Warning",
                  text: data.Pesan,
                  type: "warning",
                  confirmButtonText: "OK"
                  },
                  function(){

                  });
          }else{

             var lb_price = response[0].list_before_price;
             var dsc = response[0].disc;
             var sp_dsc_amt = $("#txt_aditional_disc"+data).val();
             sp_dsc = replaceAll(sp_dsc_amt, ',','');
             if(!lb_price) {
              lb_price = 0;
             }
             if(!sp_dsc) {
              sp_dsc = 0;
             }
             var net_price = lb_price - dsc - sp_dsc;
             
             // document.getElementById("txt_list_bf_price"+data).innerHTML = formatNumber(response[0].list_before_price);
             $('#txt_list_bf_price'+data).val(formatNumber(response[0].list_before_price));
             // document.getElementById("txt_discount"+data).innerHTML      = formatNumber(response[0].disc);
             $('#txt_discount'+data).val(formatNumber(response[0].disc));
             // document.getElementById("txt_netprice"+data).innerHTML      = formatNumber(net_price);
             $('#txt_netprice'+data).val(formatNumber(net_price));
             // document.getElementById("txt_tax_cd"+data).innerHTML        = response[0].land_tax_cd;
             $('#txt_tax_cd'+data).val(response[0].land_tax_cd);
             
             $('#txt_tax_cd'+data).val(response[0].land_tax_cd);
             $('#txt_listamt'+data).val(formatNumber(response[0].list_tax_amt));
             $('#txt_contractprice'+data).val(formatNumber(response[0].contract_price));
                   
         }         
         
        
        },
        dataType: "json"//set to JSON    
        }); 
    }
    function hitung_ulang_disc(data){

    }
    function replaceAll(str, find, replace)
    {
      return str.replace(new RegExp(find, 'g'), replace);
    }

      function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
    function hitung_ulang_disc(data){
        var site_url        = "<?php echo site_url('C_rl_sales/hitung_ulang_disc/');?>";
       var aditional_disc = $('#txt_aditional_disc'+data).val(); 
       var aditional_DC = replaceAll(aditional_disc, ',','');
       // console.log(aditional_DC);
       var list_price = $('#txt_list_bf_price'+data).val();//document.getElementById("txt_list_bf_price").value;
       var plan_disc = $('#txt_discount'+data).val();//document.getElementById("txt_discount").value;
       var tax_cd   = $('#txt_tax_cd'+data).val();
       var response ='';
       console.log('2');
       if($('#txt_payment'+data).val()==""){
            sweetAlert("Warning","Payment cannot be blank","error");
           }
           else{
            $.ajax({
                type:"POST",
                url: site_url,
                dataType: "json",
                data:{aditional_disc:aditional_DC,list_price:list_price,plan_disc:plan_disc,tax_cd:tax_cd},
                success: function(response){
                  
                   document.getElementById("txt_netprice"+data).innerHTML      = formatNumber(response[1].net_price);       //net price
                   $('#txt_netprice'+data).val(formatNumber(response[1].net_price));
                  document.getElementById("txt_listamt"+data).innerHTML       = formatNumber(response[1].list_tax_amt);
                  $('#txt_listamt'+data).val(formatNumber(response[1].list_tax_amt))
                  document.getElementById("txt_contractprice"+data).innerHTML = formatNumber(response[1].sales_price);
                  $('#txt_contractprice'+data).val(formatNumber(response[1].sales_price))
// alert(response[1].net_price);

                },
                 error: function(jqXHR, textStatus, errorThrown){
                
                 }
              });
           }
      }
      function fn_disc(data){
        var discno = $("#disc"+data).val();
        // alert(discno);
        var list_price = $("#txt_list_bf_price"+data).val();
        var price = replaceAll(list_price, ',','');
        // console.log
        var disc = $("#txt_discount"+data).val();
        var disc_amt = replaceAll(disc, ',','');
        price = price - parseFloat(disc_amt);
        // BootstrapDialog.alert(price);
        var result = 0;
        // alert(discno);
        console.log('fn_disc');
        // console.log(discno);
        // console.log(discno);
        if (discno=='NA') {
          
          var net_price = price - result;
          $("#txt_aditional_disc"+data).val(formatNumber(result));
          
        } else { 
          // var price = replaceAll(list_price, ',','');
          var result = (parseInt(discno) * parseInt(price)) / 100 ;
          console.log(result);
          console.log(price);
          var net_price = price - result;
          $("#txt_aditional_disc"+data).val(formatNumber(result));
        }
        $('#txt_netprice'+data).val(formatNumber(net_price));
        // console.log(formatNumber(net_price));
        // hitung_ulang_disc();
      }
</script>
    