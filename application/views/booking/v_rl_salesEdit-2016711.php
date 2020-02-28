<div class="content-wrapper">
  <section class="content-header">
    <h1>Edit Booking</h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <form role="form" class="form-horizontal cmxform" id="form_rl_sales" method ="POST" action="<?php echo site_url("C_rl_sales/saveUpdate"); ?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Sales Date</label>
                <div class="col-sm-9">
                  <label class="control-label"><?php echo(date('D,d M Y', strtotime($dataSales->sales_date))); ?></label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">SP No</label>
                <div class="col-sm-8">
                  <input readonly="2" class="form-control" type="text" name="ref_no" value="<?php echo $dataSales->ref_no;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-8">
                  <input readonly="2" class="form-control" type="text" value="<?php echo $status;?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Name</label><a href = "<?php echo base_url('c_cf_business/editCustomer/'.$dataSales->business_id); ?>" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                  </a>
                <div class="col-sm-8">
                <input type="text" name="customer" value="<?php echo $customer;?>" class="form-control" readonly="2">
                  <!-- <a href = "<?php echo base_url('c_cf_business/editCustomer/'.$dataSales->business_id); ?>" class="btn btn-success">
                    <i class="fa fa-edit"></i>
                  </a> -->
                </div>
                <!-- <div class="col-sm-1">
                <a href="<?php echo base_url("c_cf_business"); ?> " ><input type='button' class="btn btn-xs btn-success" value='Create New' style = "margin-top: 5px"></a> 
                </div> -->
              </div>
              <div class="form-group">
                <label for="unit" class="col-sm-2 control-label">Unit Number</label>
                <div class="col-sm-8">
                  <input class="form-control" type="text" id="lotno" name="lotno" value="<?php echo $dataSales->lot_no;?>" readonly="2">
                </div>
              </div>
              <div class="form-group">
                <label for="payment" class="col-sm-2 control-label">Payment Method</label>
                <div class="col-sm-8">
                  <select name="payment" id="payment" class="form-control chosen-select" tabindex="2" data-placeholder="Select Payment Method" onChange="tampil_data()">
                    <?php echo $combo_payment; ?>
                  </select> 
                </div>
              </div>
              <!-- List price (exclude tax) -->
              <div class="form-group">
                <label class="col-sm-2 control-label">List price (exclude tax)</label>
                <div class="col-sm-8">
                  <label name="txt_list_bf_price" class="control-label" id="txt_list_bf_price" onkeyup="Disc();">
                    <?php echo number_format((float)$dataSales->list_before_price, 2, ".", ",");?>
                  </label>

                 <input type="hidden" id="txt_list_bf_price2" name="txt_list_bf_price" class="control-label" onkeyup="Disc();" value="<?php echo number_format((float)$dataSales->list_before_price, 2, ".", ",");?>">

                </div>
              </div>
              <!-- Plan Discount -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Plan Discount</label>
                <div class="col-sm-8">
                  <label class="control-label" id="txt_discount">
                    <?php echo number_format((float)$dataSales->disc_amt, 2, ".", ",");?>
                    <!-- <?php echo number_format((float)$dataSales->discount_special_amt, 2, ".", ","); ?> -->
                  </label> 

                   <input type="hidden" id="txt_discount2" name="txt_discount" value="<?php echo number_format((float)$dataSales->disc_amt, 2, ".", ",");?>">

                </div>
              </div>
              <!-- aditional disc code -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Special Disc</label>
                <div class="col-sm-4">
                  <select name="disc" class="form-control chosen-select" id="disc" tabindex="2" data-placeholder="Select disc" onkeyup="Disc();"><?php echo $combo_disc; ?></select> 
                </div>
                <?php //var_dump($dataSales->disc_cd) ?>
                <div class="col-sm-4">
                  <!-- <input name="txt_aditional_disc" class="form-control" align="left" type="text" onchange="hitung_ulang_disc()" id="txt_aditional_disc" value="<?php echo number_format((float)$dataSales->discount_special_amt, 2, ".", ","); ?>" > -->
                  <input class="form-control" type="input" name="txt_aditional_disc" onchange="hitung_ulang_disc()" id="txt_aditional_disc" value="<?php 
                  // echo number_format((float)$dataSales->discount_special_amt, 2, ".", ","); 
                  echo intval($dataSales->discount_special_amt);
                  ?>">
                </div>
              </div>
              <!-- Aditional Discount -->
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Aditional Discount</label>
                <div class="col-sm-8">
                  <input name="txt_aditional_disc" class="form-control" align="left" type="input" onchange="hitung_ulang_disc()" id="txt_aditional_disc" >
                </div>
              </div> -->
              <!-- Net Price -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Net Price</label>
                <div class="col-sm-8">
                  <label class="control-label" id="txt_netprice">
                    <?php echo number_format((float)$dataSales->sell_price, 2, ".", ",");?>
                  </label>

                  <input type="hidden" name="txt_netprice2" id="txt_netprice2" value="<?php echo number_format((float)$dataSales->sell_price, 2, ".", ",");?>">

                </div>
              </div>
              <!-- Tax --><!-- 
              <div class="form-group">
                <label type="hidden" class="col-sm-2 control-label">Tax</label>
                <div class="col-sm-9">
                  <label type="hidden" class="control-label" id="txt_listamt"></label>
                  <input class="form-control" name="txt_tax_cd" type="hidden" id="txt_tax_cd">
                </div>
              </div> -->
               <!--Sales Price --><!-- 
               <div class="form-group">
                <label type="hidden" class="col-sm-2 control-label">
                Sales Price</label>
                <div class="col-sm-9">
                  <label type="hidden" class="control-label" id="txt_contractprice"></label>
                </div>
              </div> -->
              <input type="hidden" id="txt_listamt">
              <!-- Event -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Sales Event</label>
                <div class="col-sm-8">
                  <select name="mediacd" id="mediacd" class="form-control chosen-select" tabindex="2" data-placeholder="Select Event">
                    <?php echo $combo_event; ?>
                  </select> 
                </div>
              </div>
              <!-- Debtor A/C -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Debtor A/C</label>
                <div class="col-sm-8">
                  <!-- // <label class="control-label" id="txt_debtors"><?php //echo $debtor; ?></label> -->
                  <input type="text" class="form-control" id="txt_debtor" name="debtor" value="<?php echo $dataSales->debtor_acct;?>" readonly="2">
            
                  
                </div>
              </div>
            </div>

          <!-- data hidden  -->
          <input type="hidden" id="business_id" name="business_id" value="<?php echo $dataSales->business_id;?>">
          <input type="hidden" id="txt_listamt" name="txt_listamt" value="<?php echo number_format((float)$dataSales->list_tax_amt, 2, ".", ",");?>">
          <input name="txt_tax_cd" type="hidden" id="txt_tax_cd" value="<?php echo $dataSales->list_tax_scheme;?>">

            <div class="box-footer">
              <!-- <button class="btn btn-primary" type="sumedia_cdmit" id="btnSimpan" onClick="validasi()"><i ></i> Save</button> -->

              <?php echo $back; ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <script src="<?=base_url('assets/docsupport/chosen.jquery.js')?>" type="text/javascript"></script>
  <script src="<?=base_url('assets/docsupport/prism.js')?>" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="<?=base_url('lainnya/dist/js/jquery.mask.min.js')?>"></script>
   
   <script type="text/javascript">
    var config = {
      // '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    $(".chosen-select").chosen({ width: '100%'});
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    function replaceAll(str, find, replace)
    {
      return str.replace(new RegExp(find, 'g'), replace);
    }
    function formatNumber(data) {
      return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }
    $(function() {
      var lot = $("#unit").find(':selected').val();
      $("#unit").change();
    });
    $("#unit").trigger('chosen:updated');
    $("#unit").change(function(){
      var lot = $(this).find(':selected').val();
      $("#txt_debtor").val(lot);
    });
    $('input[name=txt_aditional_disc]').mask('#,##0',{reverse:true,maxlength:true});
    
    $('#disc').change(function(){
      var discno = $("#disc option:selected").data("level");
      var list_price = $("#txt_list_bf_price").text();
      var plan = $("#txt_discount").text();
      var disc_input = $("#txt_aditional_disc").val();
      var price = replaceAll(list_price, ',','');
      var planprice = replaceAll(plan, ',','');
      
      if (discno==''||planprice=='') 
      {
        var result = 0;
        var net_price = price - result - planprice;
        $("#txt_aditional_disc").val(formatNumber(result));
        // console.log(net_price);
        // console.log(planprice);
      }
      else
      {
        var price = replaceAll(list_price, ',','');
        var planprice = replaceAll(plan, ',','');
        var result = (parseInt(discno) * parseInt(price)) / 100 ;
        var net_price = price - result - /*parseInt(*/planprice/*)*/ ;
        $("#txt_aditional_disc").val(formatNumber(result)); 
        // console.log(net_price);
      }
      var dis = $('#txt_netprice').text(formatNumber(net_price));
      //
      $('#txt_netprice2').val(formatNumber(net_price));
      $('#txt_list_bf_price2').val(formatNumber(price));
      $('#txt_discount2').val(formatNumber(planprice));
      // console.log(formatNumber(net_price));
    });


    function tampil_data()
      {
        var site_url    = "<?php echo site_url('C_rl_sales/set_field2/');?>";
        var lot_unit    = $('#lotno').val();
        var payment_cd  = $('#payment').val();

        var response = "";
        var tes = "";
        console.log(lot_unit);
        console.log(payment_cd);
        $.ajax({
        type: "POST", 
        url: site_url, 
        data: { lot_no: lot_unit ,payment: payment_cd},
        success: function(response)
        {
          // console.log(response);

             document.getElementById("txt_list_bf_price").innerHTML = formatNumber(response[0].list_before_price);
             document.getElementById("txt_list_bf_price2").innerHTML = formatNumber(response[0].list_before_price);
             document.getElementById("txt_discount").innerHTML      = formatNumber(response[0].disc);
              // document.getElementById("txt_discount2").innerHTML      = formatNumber(response[0].disc);
             document.getElementById("txt_netprice").innerHTML      = formatNumber(response[0].net_price);                       //net price
             // ducument.getElementById("disc").innerHTML              = response[0].sales_type;   // E RN
             document.getElementById("txt_tax_cd").innerHTML        = response[0].land_tax_cd;
             document.getElementById("txt_listamt").innerHTML       = formatNumber(response[0].list_tax_amt);
            /* document.getElementById("txt_payment_cd").innerHTML       = response[0].payment_cd;*/
             // document.getElementById("txt_contractprice").innerHTML = formatNumber(response[0].contract_price);
             // $('#txt_discount').val(formatNumber(response[0].disc));
             // $('#txt_netprice').val(formatNumber(response[0].net_price));
             $('#txt_tax_cd').val(response[0].land_tax_cd);
             // $('#txt_listamt').val(formatNumber(response[0].list_tax_amt));
             // $('#txt_contractprice').val(formatNumber(response[0].contract_price));
             // var json_obj = $.parseJSON(response);//parse JSON
                // alert(json_obj);           
         
        
        },
        dataType: "json"//set to JSON    
        }); 
      }
    function hitung_ulang_disc(){
      var site_url        = "<?php echo site_url('C_rl_sales/hitung_ulang_disc/');?>";
      var aditional_disc = $('#txt_aditional_disc').val(); 
      var aditional_DC = replaceAll(aditional_disc, ',','');
      // console.log(aditional_DC);
      var list_price = $('#txt_list_bf_price').text();//document.getElementById("txt_list_bf_price").value;
      var plan_disc = $('#txt_discount').text();//document.getElementById("txt_discount").value;
      var tax_cd   = $('#txt_tax_cd').val();
      var disc = $('#txt_discount').text();
      var response ='';
      console.log(disc);
      if($('#txt_unit').val()=="" || $('#txt_payment').val()=="") {
        alert("Unit and Payment cannot be blank");
      } else {
        $.ajax({
          type:"POST",
          url: site_url,
          dataType: "json",
          data:{aditional_disc:aditional_DC,list_price:list_price,plan_disc:plan_disc,tax_cd:tax_cd},
          success: function(response){
            console.log(disc);
            // console.log(response);
            // // document.getElementById("txt_netprice2").innerHTML      = formatNumber(response[1].net_price);
            // document.getElementById("txt_netprice").innerHTML      = formatNumber(response[1].net_price);       //net price
            // document.getElementById("txt_listamt").innerHTML       = formatNumber(response[1].list_tax_amt);
            // document.getElementById("txt_contractprice").innerHTML = formatNumber(response[1].sales_price);
            // $("#txt_list_bf_price2").val(formatNumber(response[1].list_price));
            // $("#txt_discount2").val(formatNumber(response[1].disc))
            $("#txt_netprice").text(formatNumber(response[1].net_price));
            $("#txt_netprice2").val(formatNumber(response[1].net_price));
            $("#txt_netprice").val(formatNumber(response[1].list_tax_amt));
            // $("#txt_contractprice").val(formatNumber(response[1].sales_price));
          },
           error: function(jqXHR, textStatus, errorThrown){
          //     alert(jqXHR+' '+errorThrown);
           }
          });
      }
    }

    // function Disc(){
    //   var discno = document.getElementById('disc').value;
    //   var list_price = document.getElementById('txt_list_bf_price').value;
    //   var result = parseInt(discno) * parseInt(list_price) / 100 ;
    //   if (result) {
    //     document.getElementById('txt_aditional_disc').value = result;
    //   }
    // }

   </script> 
   <!-- <?php $_GET; var_dump($_GET); ?> -->
  <!-- 
  <script type="text/javascript" src="<?=base_url('lainnya/bootstrap/js/justControl.js')?>"></script> -->
</div>