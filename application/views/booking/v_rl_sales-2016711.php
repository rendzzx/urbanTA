<script type="text/javascript">
    function replaceAll(str, find, replace)
    {
      return str.replace(new RegExp(find, 'g'), replace);
    }

      function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
      function tampil_data()
      {
        var site_url    = "<?php echo site_url('C_rl_sales/set_field2/');?>";
        var lot_unit    = $('#unit').val();
        var payment_cd  = $('#payment').val();
        var response = "";
        var tes = "";

        /*
            {"list_bf_price":"261360000.00","land_tax_cd":"1003","land_tax_amt":"23760000.00","discount":"26136000.00","net_price":"235224000.00","list_tax_amt":"21384000.00","contract_price":"235224000.00"}
        */
         $.ajax({
        type: "POST", 
        url: site_url, 
        data: { lot_no: lot_unit ,payment: payment_cd},
        success: function(response)
        {
            // alert(number(response[0].list_before_price)));
             // console.log(response[0].list_before_price);
             // $('#txt_list_bf_price').val(formatNumber(response[0].list_before_price));
             document.getElementById("txt_list_bf_price").innerHTML = formatNumber(response[0].list_before_price);
             document.getElementById("txt_discount").innerHTML      = formatNumber(response[0].disc);
             document.getElementById("txt_netprice").innerHTML      = formatNumber(response[0].net_price);                       //net price
             // ducument.getElementById("disc").innerHTML              = response[0].sales_type;   // E RN
             document.getElementById("txt_tax_cd").innerHTML        = response[0].land_tax_cd;
             document.getElementById("txt_listamt").innerHTML       = formatNumber(response[0].list_tax_amt);
            /* document.getElementById("txt_payment_cd").innerHTML       = response[0].payment_cd;*/
             document.getElementById("txt_contractprice").innerHTML = formatNumber(response[0].contract_price);
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
      function validasi() 
      {
        
        if($('#txt_business_id').val()==""|| $('#txt_unit').val()=="" || $('#txt_payment').val()=="")
           {
            alert("Data Tidak Lengkap, mohon lengkapi (Nama, Unit dan Payment )");
           }else
           {
              // simpan_data();
              // generate_data();
              var msg = confirm("Save Booking Entry?");
                if (msg==true){
                    simpan_data();
                    // generate_data();
                }
            
           }
      }
       function generate_data()
      {
        var site_url    = "<?php echo site_url('C_rl_sales/gen/');?>";
        var business_id   = $('#customer').val();
        var debtor          = $('#txt_debtor').val();
        
        //add data to database
            $.ajax({
                url : site_url,
                type:"POST",
                // data:$('#form_rl_sales').serialize()
                data:{business_id:business_id,debtor:debtor},
                dataType:"json",
                success:function(data){
                    // reload_table();
                    // $.gritter.add({
                    //     title:'SUKSES SIMPAN',
                    //     text:'Data Berhasil disimpan',
                    //     class_name :'success',
                    //     time:''
                    // });
              
              alert('Success generate');
                }
                ,
                error: function(jqXHR, textStatus, errorThrown){
                  // delete_gagal();
                 alert(jqXHR+' Generate : '+errorThrown);
                 
                }
            });
      }
      function simpan_data()
      {
        var site_url      = "<?php echo site_url('C_rl_sales/isi_data_rl_sales/');?>";
        var business_id   = $('#customer').val();
        var unit          = $('#unit').val();
        var payment       = $('#payment').val();
        var list_price    = $('#txt_list_bf_price').text();
        var discount      = $('#txt_discount').text();
        /*var sales_type    = $('#disc').text()*/      // E RN
        var aditional_disc = $('#txt_aditional_disc').val();
        var net_price       = $('#txt_netprice').text();                                                    //net price
        var tax_cd          = $('#txt_tax_cd').val(); //$('#txt_tax_cd').text();
        var tax_listamt     = $('#txt_listamt').text(); //$('#txt_listamt').text();
        var sales_price     = $('#txt_contractprice').text(); //$('#txt_contractprice').text();
        var debtor          = $('#txt_debtor').val();
        //add data to database
            $.ajax({
                url : site_url,
                type:"POST",
                // data:$('#form_rl_sales').serialize(),
                data:{business_id:business_id,
                      unit:unit,
                      payment:payment,
                      list_price:list_price,
                      discount:discount,
                      aditional_disc:aditional_disc,
                      net_price:net_price,                                                                  //net price
                      tax_cd:tax_cd,
                      tax_listamt:tax_listamt,
                      sales_price:sales_price,
                      debtor:debtor},
                dataType:"json",
                success:function(data){
                    // reload_table();
                    // $.gritter.add({
                    //     title:'SUKSES SIMPAN',
                    //     text:'Data Berhasil disimpan',
                    //     class_name :'success',
                    //     time:''
                    // });
              
              alert('Success');
                }
                ,
                error: function(jqXHR, textStatus, errorThrown){
                  // delete_gagal();
                 alert(textStatus+' Save : '+errorThrown);
                 
                }
            });
      }
      function delete_gagal()
      {
        var site_url        = "<?php echo site_url('C_rl_sales/delete_gagal_rl_sales/');?>";
        var business_id     = $('#txt_business_id').val();
        var debtor_acct     = $('#txt_debtor').val();
        var response = "";
        var tes = "";

             $.ajax({
            type: "POST", 
            url: site_url, 
            data: { business_id: business_id ,debtor_acct: debtor_acct},
            success: function(response)
            {
                
            },
            error:function(jqXHR, textStatus, errorThrown)
            {
              
            },
            dataType: "json"//set to JSON    
            }); 
      }
      function hitung_ulang_disc(){
        var site_url        = "<?php echo site_url('C_rl_sales/hitung_ulang_disc/');?>";
       var aditional_disc = $('#txt_aditional_disc').val(); 
       var aditional_DC = replaceAll(aditional_disc, ',','');
       console.log(aditional_DC);
       var list_price = $('#txt_list_bf_price').text();//document.getElementById("txt_list_bf_price").value;
       var plan_disc = $('#txt_discount').text();//document.getElementById("txt_discount").value;
       var tax_cd   = $('#txt_tax_cd').val();
       var response ='';

       if($('#txt_unit').val()=="" || $('#txt_payment').val()==""){
            alert("Unit and Payment cannot be blank");
           }
           else{
            $.ajax({
                type:"POST",
                url: site_url,
                dataType: "json",
                data:{aditional_disc:aditional_DC,list_price:list_price,plan_disc:plan_disc,tax_cd:tax_cd},
                success: function(response){
                  
                  document.getElementById("txt_netprice").innerHTML      = formatNumber(response[1].net_price);       //net price
                  document.getElementById("txt_listamt").innerHTML       = formatNumber(response[1].list_tax_amt);
                  document.getElementById("txt_contractprice").innerHTML = formatNumber(response[1].sales_price);
// alert(response[1].net_price);
                },
                 error: function(jqXHR, textStatus, errorThrown){
                //     alert(jqXHR+' '+errorThrown);
                 }
              });
           }
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
  </style>  
<div class="content-wrapper">
  <section class="content-header">
    <h1>New Booking</h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <?php if(!empty($error)) {echo $error;} ?>
          <form role="form" class="form-horizontal cmxform" id="form_rl_sales" method ="POST" action="<?php echo site_url("C_rl_sales/isi_data_rl_sales"); ?>">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Sales Date</label>
                <div class="col-sm-9">
                  <label class="control-label"><?php echo(date('D, d M Y')); ?></label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">
                Name
                </label>

                <!-- <div class="col-sm-1"> -->
                <a href="<?php echo base_url("c_cf_business"); ?> " class="btn btn-success btn-xs" ><i class="fa fa-plus"></i> </a>
                <!-- <a href="#" class="btn btn-success btn-xs" ><i class="fa fa-edit"></i> </a> -->
                <!-- <?php echo $comboPay2; ?> -->
                <!-- </div> -->
                <div class="col-sm-8">
                  <select name="customer" class="form-control chosen-select" id="customer" tabindex="2" data-placeholder="Select Customer"><?php echo $combo_customer; ?></select>
                </div>
                <!-- <div class="col-sm-1">
                <a href="<?php echo base_url("c_cf_business"); ?> " ><input type='button' class="btn btn-xs btn-success" value='Create New' style = "margin-top: 5px"></a> 
                </div> -->
              </div>
              <div class="form-group">
                <label for="unit" class="col-sm-2 control-label">Unit Number</label>
                <div class="col-sm-8">
                  <select name="unit" id="unit" class="form-control chosen-select" tabindex="2" data-placeholder="Select Unit"><?php echo $combo_unit; ?>
                  </select> 
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
                  <label name="txt_list_bf_price" class="control-label" id="txt_list_bf_price" onkeyup="Disc();"></label>
                  <!-- <input id="txt_list_bf_price" name="txt_list_bf_price" class="control-label" onkeyup="Disc();"> -->
                </div>
              </div>
              <!-- Plan Discount -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Plan Discount</label>
                <div class="col-sm-8">
                  <label class="control-label" id="txt_discount"></label> 
                </div>
              </div>
              <!-- aditional disc code -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Special Disc</label>
                <div class="col-sm-2">
                  <select name="disc" class="form-control chosen-select" id="disc" tabindex="2" data-placeholder="Select disc" onkeyup="Disc();"><?php echo $Combo_disc; ?></select> 
                </div>
                <div class="col-sm-6">
                  <input name="txt_aditional_disc" class="form-control" align="left" type="input" onchange="hitung_ulang_disc()" id="txt_aditional_disc" >
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
                  <label class="control-label" id="txt_netprice"></label>
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
                <label type="hidden" class="col-sm-2 control-label">Sales Price</label>
                <div class="col-sm-9">
                  <label type="hidden" class="control-label" id="txt_contractprice"></label>
                </div>
              </div> -->
              <input type="hidden" id="txt_listamt">
              <input type="hidden" name="txt_tax_cd" id="txt_tax_cd">
              <input type="hidden" id="txt_contractprice">
              <!-- Debtor A/C -->
              <div class="form-group">
                <label class="col-sm-2 control-label">Debtor A/C</label>
                <div class="col-sm-8">
                  <!-- // <label class="control-label" id="txt_debtors"><?php //echo $debtor; ?></label> -->
                  <input type="text" class="form-control" id="txt_debtor" name="debtor">
                  <!-- <label type="hidden" id="txt_listamt"></label> -->
                  <!-- <input name="txt_tax_cd" type="hidden" id="txt_tax_cd"> -->
                  <!-- <label type="hidden" id="txt_contractprice"></label> -->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Sales Event</label>
                <div class="col-sm-8">
                  <select name="mediacd" id="mediacd" class="form-control chosen-select" tabindex="2" data-placeholder="Select Event">
                    <?php echo $combo_event; ?>
                  </select> 
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button class="btn btn-primary" type="button" id="btnSimpan" onClick="validasi()"><i ></i> Save</button>
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
    $(function() {
      var lot = $("#unit").find(':selected').val();
      $("#unit").change();
    });
    $("#unit").trigger('chosen:updated');
    $("#unit").change(function(){
      var lot = $(this).find(':selected').val();
      if(lot!=='') {
        var site_url = '<?php echo base_url("c_rl_sales/check_debtor") ?>';
        $.post(site_url,
          {debtor:lot},
          function(data,status){
            $("#txt_debtor").empty();
            $("#txt_debtor").val(data);
            console.log(data);
          });
      } else {
        console.log('empty lot');
      }
      // $("#txt_debtor").val(lot);
    });
    $('input[name=txt_aditional_disc]').mask('#,##0',{reverse:true,maxlength:false});
    
    $('#disc').change(function(){
      var discno = $("#disc option:selected").data("level");
      var list_price = $("#txt_list_bf_price").text();
      var price = replaceAll(list_price, ',','');
      
      if (discno=='') {
        var result = 0;
        var net_price = price - result;
        $("#txt_aditional_disc").val(formatNumber(result));
        
      } else { 
        var price = replaceAll(list_price, ',','');
        var result = (parseInt(discno) * parseInt(price)) / 100 ;
        var net_price = price - result;
        $("#txt_aditional_disc").val(formatNumber(result));
      }
      $('#txt_netprice').text(formatNumber(net_price));
      // console.log(formatNumber(net_price));
    });

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
