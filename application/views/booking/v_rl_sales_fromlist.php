<link href="<?=base_url('datatable/media/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" >
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.css')?>" rel="stylesheet" />
<!-- <link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" /> -->

<style type="text/css">
  /*.glyph-color-red{
    color:red;
  }*/
</style>

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
        if(lot_unit.length==0){
          return;
        }
        if(payment_cd.length==0){
          return;
        }
        /*
            {"list_bf_price":"261360000.00","land_tax_cd":"1003","land_tax_amt":"23760000.00","discount":"26136000.00","net_price":"235224000.00","list_tax_amt":"21384000.00","contract_price":"235224000.00"}
        */
         $.ajax({
        type: "POST", 
        url: site_url, 
        data: { lot_no: lot_unit ,payment: payment_cd},
        success: function(response)
        {
          // console.log(response.length);
          if(response.length==0){
            // BootstrapDialog.alert('Selling Price Not Found');
             BootstrapDialog.alert({
            title: 'WARNING',
            message: 'Selling Price Not Found',
            type: BootstrapDialog.TYPE_WARNING, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
           // draggable: true, // <-- Default value is false
            buttonLabel: 'OK', // <-- Default value is 'OK',
            // callback: function(result) {
            //     // result will be true if button was click, while it will be false if users close the dialog directly.
            //     // alert('Result is: ' + result);
            // }
        });

          }else{


             var lb_price = response[0].list_before_price;
             var dsc = response[0].disc;
             var sp_dsc_amt = $("#txt_aditional_disc").val();
             sp_dsc = replaceAll(sp_dsc_amt, ',','');
             if(!lb_price) {
              lb_price = 0;
             }
             if(!sp_dsc) {
              sp_dsc = 0;
             }
             var net_price = lb_price - dsc - sp_dsc;
             // BootstrapDialog.alert(net_price);
             document.getElementById("txt_list_bf_price").innerHTML = formatNumber(response[0].list_before_price);
             document.getElementById("txt_discount").innerHTML      = formatNumber(response[0].disc);
             document.getElementById("txt_netprice").innerHTML      = formatNumber(net_price);                       //net price
             // ducument.getElementById("disc").innerHTML              = response[0].sales_type;   // E RN
             document.getElementById("txt_tax_cd").innerHTML        = response[0].land_tax_cd;
             // document.getElementById("txt_listamt").innerHTML       = formatNumber(response[0].list_tax_amt);

            /* document.getElementById("txt_payment_cd").innerHTML       = response[0].payment_cd;*/
             // document.getElementById("txt_contractprice").innerHTML = formatNumber(response[0].contract_price);
             // $('#txt_discount').val(formatNumber(response[0].disc));
             // $('#txt_netprice').val(formatNumber(response[0].net_price));
             $('#txt_tax_cd').val(response[0].land_tax_cd);
             $('#txt_listamt').val(formatNumber(response[0].list_tax_amt));
             $('#txt_contractprice').val(formatNumber(response[0].contract_price));
             // var json_obj = $.parseJSON(response);//parse JSON
                // BootstrapDialog.alert(json_obj);           
         }
        
        },
        dataType: "json"//set to JSON    
        }); 
      }
      function validasi() 
      {
        if($('#form_rl_sales').valid()){
          // $('#btnBack').text('submit');
          simpan_data()
          // BootstrapDialog.alert($('#btnBack').text());
        }


      }
      function tes_sp(){
         var site_url = '<?php echo base_url("c_rl_sales/sp_document_format")?>';
            $.post(site_url,
              // {Id:Id},
              function(data,status) {
                // $("#pl_property").empty();
                // $("#pl_property").append(data);
                // $("#pl_property").trigger('chosen:updated');
                console.log(data);
              }
            );
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
              
              BootstrapDialog.alert('Success generate');
                }
                ,
                error: function(jqXHR, textStatus, errorThrown){
                  // delete_gagal();
                 BootstrapDialog.alert(jqXHR+' Generate : '+errorThrown);
                 
                }
            });
      }
      function setName(Id){
        var site_url = '<?php echo base_url("c_rl_sales/zoom_nama_from")?>';
            $.post(site_url,
              {bussId:Id},
              function(data,status) {
                $("#customer").empty();
                $("#customer").append(data);
                $("#customer").trigger('chosen:updated');
              }
            );
      }
      function setPaymentcd(Id){
        var site_url = '<?php echo base_url("c_rl_sales/zoom_payment_cd_from")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#payment").empty();
                $("#payment").append(data);
                $("#payment").trigger('chosen:updated');
              }
            );
      }
      function setSpesialDis(Id){
        var site_url = '<?php echo base_url("c_rl_sales/zoom_discount_from")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#disc").empty();
                $("#disc").append(data);
                $("#disc").trigger('chosen:updated');
              }
            );
      }
      function setSalesEvent(Id){
        var site_url = '<?php echo base_url("c_rl_sales/zoom_media_from")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#mediacd").empty();
                $("#mediacd").append(data);
                $("#mediacd").trigger('chosen:updated');
              }
            );
      }
      function loaddata(){
        var rowID =<?php echo $rowID;?>;
        // BootstrapDialog.alert(rowID);

        if (rowID != 0) {
            
            $.getJSON("<?php echo base_url('c_rl_sales/getByID');?>" + "/" + rowID, function (data) {
                                  console.log(data);
                var d = new Date(data[0].sales_date);
                var n = d.toUTCString();
                var pdate = n.indexOf(":")-2;
                n = n.substring(0,pdate);
                $('#sales_date').text(n);
                  setName(data[0].business_id);
                $('#unit').val(data[0].lot_no);
                setPaymentcd(data[0].payment_cd);
                setSalesEvent(data[0].media_cd)
                setSpesialDis(data[0].disc_cd_spe);
                $('#txt_aditional_disc').val(formatNumber(data[0].discount_special_amt));
                $('#txt_list_bf_price').text(formatNumber(data[0].list_before_price));
                $('#txt_discount').text(formatNumber(data[0].disc_amt));   
                $('#txt_tax_cd').val(data[0].list_tax_scheme);             
                $('#txt_netprice').text(formatNumber(data[0].sell_price));
                $('#txt_debtor').val(data[0].debtor_acct);
                

                $('#txt_listamt').val(formatNumber(data[0].list_tax_amt));
                $('#txt_contractprice').val(formatNumber(data[0].sell_price));
                var status = data[0].status;
                if(status=='E'){
                  $('#btnBack').text('Submit');
                }
                document.getElementById("btnchange").disabled = true;
                // BootstrapDialog.alert(status);
                // txt_tax_cd
                // txt_contractprice

                // setTimeout(tampil_data(),3000);
                // tampil_data();
                // var category = data[0].category;
                // document.getElementById(category).checked = true;
                // if(category=='I'){
                //     $("#panel2").show();

                //  }
                 
                // $('#Name').val(data[0].name);
                // $('#address1').val(data[0].address1);
                // $('#address2').val(data[0].address2);
                // $('#address3').val(data[0].address3);
                // $('#post_cd ').val(data[0].post_cd);
                // $('#hand_phone').val(data[0].hand_phone);
                // $('#tel_no').val(data[0].tel_no);
                // $('#fax_no').val(data[0].fax_no);
                // $('#email_addr').val(data[0].email_addr);
                // $('#income_tax ').val(data[0].income_tax);
                // $('#contact_person').val(data[0].contact_person);
                // $('#designation').val(data[0].designation);
                // // $('#sex').val(data[0].sex);//cb
                // var sex = data[0].sex;
                // document.getElementById(sex).checked = true;
                // // $('#birth_date').val(data[0].birth_date);
                // // $('#religion_cd ').val(data[0].religion_cd);
                // // $('#nationality').val(data[0].nationality);
                // setregion(data[0].religion_cd);
                // setnationality(data[0].nationality);
                // $('#marital_status').val(data[0].marital_status);  //cb     
                
                 

               
            });
        }
      }
      function simpan_data()
      {
        var site_url      = "<?php echo site_url('C_rl_sales/isi_data_rl_sales/');?>";
        var rowID         ="<?php echo $rowID;?>";
        var business_id   = $('#customer').val();
        var unit          = $('#unit').val();
        var payment       = $('#payment').val();
        var list_price    = $('#txt_list_bf_price').text();
        var discount      = $('#txt_discount').text();
        var Special_disc_cd = $('#disc').val();
        var Special_disc_amt = $('#txt_aditional_disc').val();
        /*var sales_type    = $('#disc').text()*/      // E RN
        var aditional_disc = $('#txt_aditional_disc').val();
        var net_price       = $('#txt_netprice').text();                                                    //net price
        var tax_cd          = $('#txt_tax_cd').val(); //$('#txt_tax_cd').text();
        var tax_listamt     = $('#txt_listamt').val(); //$('#txt_listamt').text();
        var sales_price     = $('#txt_contractprice').val(); //$('#txt_contractprice').text();
        var debtor          = $('#txt_debtor').val();
        var dataform = $('#form_rl_sales').serializeArray();
        dataform.push(
                      {name:"list_price",value:list_price}
                      ,{name:"unit",value:unit}
                      ,{name:"discount",value:discount}
                      ,{name:"net_price",value:net_price}
                      ,{name:"tax_cd",value:tax_cd}
                      ,{name:"tax_listamt",value:tax_listamt}
                      ,{name:"sales_price",value:sales_price}
                      ,{name:"business_id",value:business_id}
                      ,{name:"Special_disc_cd",value:Special_disc_cd}
                      ,{name:"Special_disc_amt",value:Special_disc_amt}
                    );
        //add data to database
            $.ajax({
                url : site_url,
                type:"POST",
                data:dataform,
                dataType:"json",
                success:function(data){
                  // console.log(data);  
                  if(data.Status=='Submit'){
                    $('#btnBack').text('Submit');
                    document.getElementById("btnchange").disabled = true;
                    
                    BootstrapDialog.alert(data.Pesan);
                  }else{
                    BootstrapDialog.alert(data.Pesan);
                  }
                  $('#txt_debtor').val(data.debtor);
                }
                ,
                error: function(jqXHR, textStatus, errorThrown){
                  // delete_gagal();
                  // console.log(jqXHR);
                  // console.log(textStatus);
                  // console.log(errorThrown);

                 BootstrapDialog.alert('Error Save : '+textStatus+' Stored Procedure SQL');
                  // var url = '<?php echo base_url("submitsales/index"); ?>'
                  // $(location).attr('href',url);
                 
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

       if($('#unit').val()=="" || $('#txt_payment').val()==""){
            BootstrapDialog.alert("Unit and Payment cannot be blank");
           }
           else{
            $.ajax({
                type:"POST",
                url: site_url,
                dataType: "json",
                data:{aditional_disc:aditional_DC,list_price:list_price,plan_disc:plan_disc,tax_cd:tax_cd},
                success: function(response){
                  
                   document.getElementById("txt_netprice").innerHTML      = formatNumber(response[1].net_price);       //net price
                  $('#txt_netprice').val(formatNumber(response[1].net_price))
                  document.getElementById("txt_listamt").innerHTML       = formatNumber(response[1].list_tax_amt);
                  $('#txt_listamt').val(formatNumber(response[1].list_tax_amt))
                  document.getElementById("txt_contractprice").innerHTML = formatNumber(response[1].sales_price);
                  $('#txt_contractprice').val(formatNumber(response[1].sales_price))
// BootstrapDialog.alert(response[1].net_price);
                },
                 error: function(jqXHR, textStatus, errorThrown){
                //     BootstrapDialog.alert(jqXHR+' '+errorThrown);
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
    <div class="form-group">
      <div class="tittle-top pull-left"><?php echo $project_name ?></div>
      <div class="tittle-top pull-right">Booking Entry</div>
    </div>    
  </section>
  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <!-- <?php if(!empty($error)) {echo $error;} ?> -->
          <form role="form" class="form-horizontal cmxform" id="form_rl_sales" method ="POST" action="">
            <div class="box-body">
              <div class="form-group">
                <label class="col-sm-2 control-label">Sales Date</label>
                <div class="col-sm-9">
                  <label name="sales_date" id="sales_date" class="control-label"><?php echo(date('D, d M Y')); ?></label>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">
                Name
                </label>

                <!-- <div class="col-sm-1"> -->
                <!-- <a href="<?php echo base_url("c_cf_business"); ?> " class="btn btn-success btn-xs" ><i class="fa fa-plus"></i> </a> -->
                <a class="btn btn-success btn-xs" id="btnadd" type="button"><i class="fa fa-plus"></i></a>
                <a class="btn btn-success btn-xs" id="btnedit" type="button"><i class="fa fa-pencil"></i></a>
                <!-- <a class="btn btn-success btn-xs" id="edit" type="button"><i class="fa fa-pencil"></i></a> -->
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
                <!-- <a class="btn btn-success btn-xs" id="btnchange" name="btnchange" type="button" disabled><i class="fa fa-refresh fa-spin"></i></a> -->
                <button class="btn btn-success btn-xs" type="button" name="btnchange" id="btnchange"><i class="fa fa-search"></i></button>
                <div class="col-sm-8">
                 <!--  <select name="unit" id="unit" class="form-control chosen-select" tabindex="2" data-placeholder="Select Unit"><?php echo $combo_unit; ?>
                  </select>  -->
                  <!-- <label name="unit" id="unit" onchange="changeUnit()" class="control-label"></label> -->
                  <input type="text" style="border:none; background-color:white;" name="unit" id="unit" onchange="changeUnit()" class="control-form" readonly>
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
                <div class="col-sm-4">
                  <select name="disc" class="form-control chosen-select" id="disc" tabindex="2" data-placeholder="Select disc" onkeyup="hitung_ulang_disc();"><?php echo $Combo_disc; ?></select> 
                </div>
                <div class="col-sm-4">
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
              <input type="hidden" name ="txt_listamt" id="txt_listamt">
              <input type="hidden" name="txt_tax_cd" id="txt_tax_cd">
              <input type="hidden" name="txt_contractprice" id="txt_contractprice">
              <!-- Debtor A/C -->
              <!-- <div class="form-group">
                <label class="col-sm-2 control-label">Debtor A/C</label>
                <div class="col-sm-8"> -->
                  <input type="hidden" class="form-control" id="txt_debtor" name="txt_debtor" >
               <!--    <label type="hidden" id="txt_listamt"></label>
                  <input name="txt_tax_cd" type="hidden" id="txt_tax_cd">
                  <label type="hidden" id="txt_contractprice"></label> -->
                <!-- </div>
              </div> -->
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
              <button class="btn btn-primary" type="button" id="btnBack" onClick="back_to_list()"><i ></i> Back</button>
              <!-- <button class="btn btn-primary" type="button" id="tesbtn" onClick="testbtn()"><i ></i> email page</button> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.js')?>" type="text/javascript"></script>


  <script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script> 
   <script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript" src="<?=base_url('plugins/jquery.mask.min.js')?>"></script>
   
   <script type="text/javascript">
   //chosen properties
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:false},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    $(".chosen-select").chosen({ width: '100%'});
    $("#customer").chosen({ width: '100%'});
    
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    // end chosen properties
    // window.history.forward();
    // function noBack() { window.history.forward(); }
    $(document).ready(function(){
      loaddata();
$.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
$("#form_rl_sales").validate({
            rules: {
                customer: {
                    required: true//,
                    // maxlength: 20,
                    
                },
                payment:{
                    required:true
                },
                mediacd:{
                    required:true
                },
                unit:{
                  required:true
                }
            },
            // messages: {
                
            // },
            errorElement: "em",
            errorPlacement: function (error, element) {
                // Add the `help-block` class to the error element
                error.addClass("help-block text-red");

                // Add `has-feedback` class to the parent div.form-group
                // in order to add icons to inputs
                element.parents(".col-xs-5").addClass("has-feedback text-red");

                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }

                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!element.next("span")[0]) {
                    $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 95%' ></span>").insertAfter(element);
                }
            },
            success: function (label, element) {
                // Add the span element, if doesn't exists, and apply the icon classes to it.
                if (!$(element).next("span")[0]) {
                    $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 95%'></span>").insertAfter($(element));
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
                $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
                $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
            }
        });


      //btn add cf_business
      $('#btnadd').click(function(){
        var id = $('#customer').val();

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

                        $('#modalTitle').html('Add Customer');
                        $('div.modal-body').load("<?php echo base_url("c_cf_business/Index");?>");

                        $('#modal').data('id', 0).modal('show');

      });
      //end add
      //btn Edit cf_business
      $('#btnedit').click(function(){
        var id = $('#customer').val();
        if(id==''){
          BootstrapDialog.alert('Please Select Customer First!');
          return;
        }
                                                        
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

                        $('#modalTitle').html('Edit Customer');

                        $('div.modal-body').load("<?php echo base_url("c_cf_business/Index");?>");

                        $('#modal').data('id', id).modal('show');


      });
      //end Edit
      //btn change lot 
      $('#btnchange').click(function(){
      var property_cd = "<?php echo $property_cd ?>";
      var lot_no = $('#unit').val();   
      change_status_lot(lot_no,'A',property_cd);
      // document.getElementById("unit").innerHTML ='nuryanto';                      
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

                        $('#modalTitle').html('Choose Unit');

                        $('div.modal-body').load("<?php echo base_url("c_booking_by_floor/goto_table_sales");?>/"+property_cd);
                      

                        $('#modal').data('id', property_cd).modal('show');


      });
      //end change
    });
  function showSubmit(){
    var debtor_acct = $('#txt_debtor').val();
    var lot_no = $('#unit').val();
    var business_id = $('#customer').val();
    console.log(debtor_acct+'- '+business_id+' + '+lot_no);
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

                        $('#modalTitle').html('Submit Approval');

                        $('div.modal-body').load("<?php echo base_url("submitsales/indexfromlist");?>");
                      
                        // $('#modal').draggable({
                        //    handle:".modal-header"
                        // });
                        $('#modal').data('lot_no', lot_no);
                        $('#modal').data('debtor_acct', debtor_acct);
                        $('#modal').data('id', business_id).modal('show');
                        $('#modal').data('from', 'list');
  }
    function change_status_lot(lot_no,status,property_cd){
        
        var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
            $.post(site_url,
              {id:lot_no,status:status,property_cd:property_cd},
              function(data,status) {
                // BootstrapDialog.alert(status);
              }
            );
      }
      // $('#Unit').change(function(){
      //   alert('tess');
      // });
      $('input[name=txt_aditional_disc]').mask('#,##0',{reverse:true,maxlength:false});
      
      $('#disc').change(function(){
        var discno = $("#disc").val();//$("#disc option:selected").data("level");
        // alert(discno);
        var list_price = $("#txt_list_bf_price").text();
        var price = replaceAll(list_price, ',','');
        var disc = $("#txt_discount").text();
        var disc_amt = replaceAll(disc, ',','');
        price = price - parseFloat(disc_amt);
        // BootstrapDialog.alert(price);
        var result = 0;
        // console.log(discno);
        if (discno=='NA') {
          
          var net_price = price - result;
          $("#txt_aditional_disc").val(formatNumber(result));
          
        } else { 
          // var price = replaceAll(list_price, ',','');
          var result = (parseInt(discno) * parseInt(price)) / 100 ;
          var net_price = price - result;
          $("#txt_aditional_disc").val(formatNumber(result));
        }
        $('#txt_netprice').text(formatNumber(net_price));
        // console.log(formatNumber(net_price));
        hitung_ulang_disc();
      });
      function testbtn(){
        window.location.href="<?php echo base_url('c_nup/tes');?>";
      }
      function back_to_list(){
        var property_cd = "<?php echo $property_cd ?>";
      var lot_no = $('#unit').val();   
      var site_url = '<?php echo base_url("c_rl_sales/cek_status_update")?>';
      var texts = $('#btnBack').text();

      if(texts==' Back'){
        // BootstrapDialog.alert(texts+' close');
         $.post(site_url,
              {Id:lot_no},
              function(data,status) {
                window.location.href="<?php echo base_url('c_rl_sales_list');?>";
              }
              );
         
      }else{
        // do if submit
        // BootstrapDialog.alert(texts+' submit');
        showSubmit();
        // window.location.href="<?php echo base_url('submitsales/indexfromlist');?>";
        // return false;
      }
           
            

      }
   </script> 

</div>
<!--Modal-->
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
