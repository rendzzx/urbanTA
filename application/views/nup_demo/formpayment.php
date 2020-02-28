<style type="text/css">
/*  .ifca-font{
    font-family: comic sans ms;
  }*/
  .modal-footer{
    background-color: #ffffff;
  }
button.back {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    border: 0 none;
    cursor: pointer;
    padding: 0;
}
.card-title {
    border-bottom: 1px solid #f2f2f2;
    padding: 8px 16px;
}
.card-title .content {
    color: #555555;
    font-size: 1.3rem;
    font-weight: 400;
    line-height: 1;
}

.modal-body {
    background-color: #f2f2f2;
    padding: 0;
}
.back {
    color: #000;
    font-size: 16px;
    font-weight: bold;
    /*line-height: 1;*/
    opacity: 0.5;
    text-shadow: 0 1px 0 #fff;  
}
.amount {
    background-color: #ffffff;
    border-bottom: 2px solid #444444;
    height: 60px;
    padding: 10px;
    text-shadow: 0 1px 0 #fff;
    margin-bottom: 5px;
    /*box-shadow:0px 0px 10px 10px #c1c1c1;*/
}
.pay-title {
  padding-top:10px;
  padding-left:20px;
  /*color: #102c42;
  font-weight: 400;
  line-height: 1;*/
  margin: 0;
   color: #555555;
    font-size: 1.3rem;
    font-weight: 400;
    line-height: 1;
  /*padding-top: 20px;*/
}
span.pull-right.bank-sprite + span {
    margin-right: 4px;
}
.amount-title span {
    display: block;
    font-size: 15px;
}
.text-amount-title {
    color: #102c42;
    font-size: 1.3rem;
    font-weight: 400;
    line-height: 1;
    margin: 0;
    padding-bottom: 4px;
}
.amount-content .text-amount-rp {
    margin-right: 4px;
    vertical-align: 2px;
}
.amount-content span {
    vertical-align: -10px;
}
.text-amount-rp {
    color: #102c42;
    font-size: 20px;
    font-weight: 400;
    line-height: 1;
    margin: 0;
}
.text-amount-amount {
    color: #102c42;
    font-size: 40px;
    font-weight: 400;
    line-height: 1;
    margin: 0;
}
.permata {
    background-position: -169px 0;
    width: 58px;
}
.pull-right {
    float: right;
}

</style>

<script type="text/javascript">
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
 
</script>

    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body" style="padding: 20px 30px 20px;">
              <div id="loader" class="loader" hidden="true"></div> 
            <div id="choosePayment" class="list-group" style="background-color: #fff;">
                <div class="list-group-item">
                  <a class="form-group" href="#" onclick="return fn_cc();">
                  <div class="col-sm-2"><img src="<?=base_url('img/payment/CC.png')?>" style="width: 30px; height: 50px;"></div>
                      <div class="col-sm-8">
                      <div><b>Credit Card</b></div>
                      <div>Pay with Visa, MasterCard, or JCB</div>
                    </div>
                    <span><div class="fa fa-angle-right col-sm-1"></div></span>
                  </a>
                </div>
              
                <div class="list-group-item">
                    <a class="form-group" href="#" onclick="return fn_atm();">
                    <div class="col-sm-2"><img src="<?=base_url('img/payment/atm.png')?>" style="width: 30px; height: 50px;"></div>
                        <div class="col-sm-8">
                        <div><b>ATM/Bank Transfer</b></div>
                        <div>Pay from ATM Bersama,Prima or Alto</div>
                      </div>
                      <span><div class="fa fa-angle-right col-sm-1"></div></span>
                    </a>
                 </div>
            </div>
             <div id="formCC" hidden="hidden" >
             
              <div class="amount" style="background-color: #fff">
                <div class="amount-title pull-left">
                  <span class="text-amount-title">amount</span>
                  </div>
                  <div class="amount-content pull-right">
                  <span class="text-amount-rp">Rp</span>
                  <span class="text-amount-amount" id="amountnya"></span>
                  </div>
                </div>
                <br>
                  <form role="formCC" class="form-horizontal" enctype="multipart/form-data" id="form_nup" method ="POST" >
                        <div class="ibox-content">
                          <div class="form-group">
                            <label class="col-sm-12" id="lblnpwp" name="lblnpwp">E-mail</label>                
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="email" id="email" placeholder="Input E-mail">
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-12" id="lblnpwp" name="lblnpwp">Handphone</label>                
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="hp" id="hp" placeholder="Input Handphone">
                            </div>
                          </div>
                        </div>
                        <br>
                         <div class="ibox-content">
                          <div class="form-group">
                            <label class="col-sm-12" id="lblnpwp" name="lblnpwp">Card Number</label>                
                            <div class="col-sm-12">
                              <input type="text" class="form-control" name="cardno" id="cardno" placeholder="Input Card Number" data-mask="9999 9999 9999 9999">
                            </div>
                          </div>
                          <!-- <div class="form-group">
                            <label class="col-sm-7" id="lblnpwp" name="lblnpwp">Expiry Date</label> 
                            <label class="col-sm-5" id="lblnpwp" name="lblnpwp">CVV</label>                 
                            <div class="col-sm-7">
                              <input type="text" class="form-control" name="expiry" id="expiry" data-mask="99/99" placeholder="MM/YY">
                            </div>       
                            <div class="col-sm-5">
                              <input type="password" class="form-control" name="npwp" id="npwp" placeholder="Input CVV">
                            </div>
                          </div> -->
                        </div>
                  </form>
<br>
            <img src="<?=base_url('img/payment/cc2.png')?>" style="width: 100%;">
            </div>
            <div id="formATM" class="list-group" hidden="hidden" style="background-color: #fff">
              <div class="list-group-item">
                    <a class="form-group" href="#" onclick="return fn_bca();">
                    <div class="col-sm-2"><img src="<?=base_url('img/payment/bca.png')?>" style="width: 50px; height: 50px;"></div>
                        <div class="col-sm-8">
                        <div><b>BCA</b></div>
                        <div>Pay from BCA ATMs or internet banking</div>
                      </div>
                      <span><div class="fa fa-angle-right col-sm-1"></div></span>
                    </a>
                 </div>
                 <div class="list-group-item">
                    <a class="form-group" href="#" onclick="return fn_mandiri();">
                    <div class="col-sm-2"><img src="<?=base_url('img/payment/mandiri.png')?>" style="width: 50px; height: 50px;"></div>
                        <div class="col-sm-8">
                        <div><b>Mandiri</b></div>
                        <div>Pay from Mandiri ATMs or internet banking</div>
                      </div>
                      <span><div class="fa fa-angle-right col-sm-1"></div></span>
                    </a>
                 </div>
                   <div class="list-group-item">
                    <a class="form-group" href="#" onclick="return fn_permata();">
                    <div class="col-sm-2"><img src="<?=base_url('img/payment/permata.png')?>" style="width: 50px; height: 50px;"></div>
                        <div class="col-sm-8">
                        <div><b>Permata</b></div>
                        <div>Pay from Permata ATMs or internet banking</div>
                      </div>
                      <span><div class="fa fa-angle-right col-sm-1"></div></span>
                    </a>
                 </div>
                   <div class="list-group-item">
                    <a class="form-group" href="#" onclick="return fn_other();">
                    <div class="col-sm-2"><img src="<?=base_url('img/payment/atm.png')?>" style="width: 50px; height: 50px;"></div>
                        <div class="col-sm-8">
                        <div><b>Other Bank</b></div>
                        <div>Pay from other Bank ATMs</div>
                      </div>
                      <span><div class="fa fa-angle-right col-sm-1"></div></span>
                    </a>
                 </div>
            </div>
            <div id="formBCA" hidden="hidden" >
             
              <div class="amount" style="background-color: #fff">
                <div class="amount-title pull-left">
                  <span class="text-amount-title">amount</span>
                  </div>
                  <div class="amount-content pull-right">
                  <span class="text-amount-rp">Rp</span>
                  <span class="text-amount-amount" id="amountnya2"></span>
                  </div>
                </div><br>
             
             
              <div class="tabs-container" style="background-color: #fff" >
            
                    <div class="pay-title" style="background-color: #fff;">
                    <div style="font-size: 15px;margin-bottom: 12px" class="col-sm-5">How to pay?</div>

                    <div class="col-sm-5 pull-right"><img src="<?=base_url('img/payment/bcaa.png')?>" style="width: 50px; float: right"></div>
                    </div>

                    <hr style="clear:both; margin:0"> 

               
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">ATM BCA</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-2">Klik BCA</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-3">m-BCA</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <p>1. On the main menu, choose <b>Other Transaction</b></p>
                                    <hr>
                                    <p>2. Choose <b>Transfer</b></p>
                                    <hr>
                                    <p>3. Choose <b>To BCA Virtual Account</b></p>
                                    <hr>
                                    <p>4. Enter your payment code (11 digit code) and press <b>Correct</b></p>
                                    <hr>
                                    <p>5. Enter the full amount to be paid and press <b>Correct</b></p>
                                    <hr>
                                    <p>6. Your payment details will appear on the payment confirmation page. If the information is correct press <b>Yes</b></p>
                                </div>
                            </div>
                            <div id="tab-2" class="tab-pane">
                                <div class="panel-body">
                                     <p>1. Choose Menu <b>Fund Transfer</b></p>
                                    <hr>
                                    <p>2. Choose <b>Transfer to BCA Virtual Account</b></p>
                                    <hr>
                                    <p>3. <b>Input BCA Virtual Account Number</b> or <b>Choose from Transfer list</b> and click <b>Continue</b></p>
                                    <hr>
                                    <p>4. Amount to be paid, account number and Merchant name will appear on the payment confirmation page, if the information is right click <b>Continue</b></p>
                                    <hr>
                                    <p>5. Get your <b>BCA Token</b> and input KEYBCA Response <b>APPLI 1</b> and click <b>Submit</b></p>
                                    <hr>
                                    <p>6. Your Transaction is Done.</p>
                                </div>
                            </div>
                            <div id="tab-3" class="tab-pane">
                                <div class="panel-body">
                                    <p>1. Choose <b>m-Transfer</b></p>
                                    <hr>
                                    <p>2. Choose <b>Transfer</b></p>
                                    <hr>
                                    <p>3. Choose <b>BCA Virtual Account</b></p>
                                    <hr>
                                    <p>4. Choose <b>account number</b> that you want to use for payment</p>
                                    <hr>
                                    <p>5. Input BCA Virtual Account Number and click <b>OK</b></p>
                                    <hr>
                                    <p>6. BCA Virtual Account Numbe and your account information will appear on the payment confirmation page and then click <b>Send</b></p>
                                    <hr>
                                    <p>7. Click <b>OK</b> on the payment confirmation page </p>
                                    <hr>
                                    <p>8. Enter amount to be transferred and then click <b>OK</b></p>
                                    <hr>
                                    <p>9. Your Transaction is Done.</p>
                                </div>
                            </div>
                        </div>


                    </div>
            </div>
            <div id="formMandiri" hidden="hidden" >
             
              <div class="amount" style="background-color: #fff">
                <div class="amount-title pull-left">
                  <span class="text-amount-title">amount</span>
                  </div>
                  <div class="amount-content pull-right">
                  <span class="text-amount-rp">Rp</span>
                  <span class="text-amount-amount" id="amountnya3"></span>
                  </div>
                </div><br>
             
             
              <div class="tabs-container" style="background-color: #fff" >
              
                    <!-- <div class="pay-title" style="background-color: #fff;"> -->
                    <div style="font-size: 15px;margin-top: 8px" class="col-sm-5">How to pay?</div>

                    <div class="col-sm-5 pull-right"><img src="<?=base_url('img/payment/mandirii.png')?>" style="padding-top:0;height: 40px; float: right"></div>
                    <!-- </div> -->

                    <hr style="clear:both; margin:0"> 
         
               
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-11">ATM Mandiri</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-22">Internet Banking</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-11" class="tab-pane active">
                                <div class="panel-body">
                                    <p>1. On the main menu, choose <b>Pay/Buy</b></p>
                                    <hr>
                                    <p>2. Choose <b>Others</b></p>
                                    <hr>
                                    <p>3. Choose <b>Multi Payment</b></p>
                                    <hr>
                                    <p>4. Enter 70012 (midtrans company code) and press <b>Correct</b></p>
                                    <hr>
                                    <p>5. Enter your payment code and press <b>Correct</b></p>
                                    <hr>
                                    <p>6. Your payment details will appear on the payment confirmation page. If the information is correct press <b>Yes</b></p>
                                </div>
                            </div>
                            <div id="tab-22" class="tab-pane">
                                <div class="panel-body">
                                     <p>1. Login to Mandiri Internet Banking (https://ib.bankmandiri.co.id/)</p>
                                    <hr>
                                    <p>2. From the main menu choose <b>Payment,</b> and then choose <b>Multi Payment</b></p>
                                    <hr>
                                    <p>3. Select your account in <b>From Account,</b> then in <b>Billing Name</b> select midtrans</p>
                                    <hr>
                                    <p>4. A Enter the <b>Payment Code</b> and you will receive your payment details</p>
                                    <hr>
                                    <p>5. Confirm your payment using your Mandiri Token</p>
                                    
                                </div>
                            </div>
                   
                        </div>


                    </div>
            </div>
             <div id="formPermata" hidden="hidden" >
             
              <div class="amount" style="background-color: #fff">
                <div class="amount-title pull-left">
                  <span class="text-amount-title">amount</span>
                  </div>
                  <div class="amount-content pull-right">
                  <span class="text-amount-rp">Rp</span>
                  <span class="text-amount-amount" id="amountnya4"></span>
                  </div>
                </div><br>
             
             
              <div class="tabs-container" style="background-color: #fff" >
                    
                    <div class="pay-title" style="background-color: #fff;">
                    <div style="font-size: 15px;margin-bottom: 12px" class="col-sm-5">How to pay?</div>

                    <div class="col-sm-5 pull-right"><img src="<?=base_url('img/payment/alto.png')?>" style="height: 20px; float: right">&emsp;<img src="<?=base_url('img/payment/permataa.png')?>" style="height:20px; float: right"></div>
                    </div>

                    <hr style="clear:both; margin:0"> 
         
               
                      
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">
                                    <p>1. On the main menu, choose <b>Other Transaction</b></p>
                                    <hr>
                                    <p>2. Choose <b>Payment</b></p>
                                    <hr>
                                    <p>3. Choose <b>Other Payment</b></p>
                                    <hr>
                                    <p>4. Choose <b>Virtual Account</b></p>
                                    <hr>
                                    <p>5. Enter 16 digits payment Account No. and press <b>Correct</b></p>
                                    <hr>
                                    <p>6. Amount to be paid, account number, and merchant name will appear on the payment confirmation page. If the information is right, press <b>Correct</b></p>
                                    <hr>
                                    <p>7. Choose your payment account and press <b>Correct</b></p>
                                </div>
                            </div>
                          
                        </div>


                    </div>
            </div>
            <div id="formOther" hidden="hidden" >
              <div class="amount" style="background-color: #fff">
                <div class="amount-title pull-left">
                  <span class="text-amount-title">amount</span>
                  </div>
                  <div class="amount-content pull-right">
                  <span class="text-amount-rp">Rp</span>
                  <span class="text-amount-amount" id="amountnya5"></span>
                  </div>
                </div><br>
             
             
              <div class="tabs-container" style="background-color: #fff" >
            
                    <div class="pay-title" style="background-color: #fff;">
                    <div style="font-size: 15px;margin-bottom: 12px" class="col-sm-5">How to pay?</div>

                    <div class="col-sm-5 pull-right" id="image"><img src="<?=base_url('img/payment/alto.png')?>" style="height: 20px; float: right">&emsp; &emsp;<img src="<?=base_url('img/payment/prima.png')?>" style="height:20px; float: right">&emsp; &emsp;<img src="<?=base_url('img/payment/bersama.png')?>" style="height:20px; float: right"></div>
                    </div>

                    <hr style="clear:both; margin:0"> 

               
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-111">ATM Bersama</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-222">Prima</a></li>
                            <li class=""><a data-toggle="tab" href="#tab-333">Alto</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-111" class="tab-pane active">
                                <div class="panel-body">
                                    <p>1. On the main menu, choose<b>Others</b></p>
                                    <hr>
                                    <p>2. Choose <b>Transfer</b></p>
                                    <hr>
                                    <p>3. Choose <b>Online Transfer</b></p>
                                    <hr>
                                    <p>4. Enter 013 and 16 digits Account No.</p>
                                    <hr>
                                    <p>5. Enter the full amount to be paid. If the amount entered is not the same as the invoiced amount, the transaction will be declined.</p>
                                    <hr>
                                    <p>6. Empty the transfer reference number and press <b>Correct</b></p>
                                    <hr>
                                    <p>7. Amount to be paid, account number, and merchant name will appear on the payment confirmation page. If the information is right, press <b>Correct</b></p>
                                </div>
                            </div>
                            <div id="tab-222" class="tab-pane">
                                <div class="panel-body">
                                    <p>1. On the main menu, choose <b>Other Transaction</b></p>
                                    <hr>
                                    <p>2. Choose <b>Transfer</b></p>
                                    <hr>
                                    <p>3. Choose <b>Other Bank Account</b></p>
                                    <hr>
                                    <p>4. Enter <b>013</b> (Bank Permata code) and choose <b>Correct</b></p>
                                    <hr>
                                    <p>5. Enter the full amount to be paid. If the amount entered is not the same as the invoiced amount, the transaction will be declined.</p>
                                    <hr>
                                    <p>6. Enter 16 digits payment Account No. and press <b>Correct</b></p>
                                    <hr>
                                    <p>7. Amount to be paid, account number, and merchant name will appear on the payment confirmation page. If the information is right, press <b>Correct</b></p>
                                </div>
                            </div>
                            <div id="tab-333" class="tab-pane">
                                <div class="panel-body">
                                    <p>1. On the main menu, choose <b>Other Transaction</b></p>
                                    <hr>
                                    <p>2. Choose <b>Payment</b></p>
                                    <hr>
                                    <p>3. Choose <b>Other Payment</b></p>
                                    <hr>
                                    <p>4. Choose <b>Virtual Account</b></p>
                                    <hr>
                                    <p>5. Enter 16 digits payment Account No. and press <b>Correct</b></p>
                                    <hr>
                                    <p>6. Amount to be paid, account number, and merchant name will appear on the payment confirmation page. If the information is right, press  <b>Correct</b></p>
                                    <hr>
                                    <p>7. Choose your payment account and press <b>Correct</b></p>
                                </div>
                            </div>
                        </div>


                    </div>
            </div>

           
        </div>   
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Confirm Payment</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>

<script type="text/javascript">
var TypePayment='';
var remarkspayment='';
var amt = $('#modal').data('nupamt');
$('#amountnya').text(amt);
$('#amountnya2').text(amt);
$('#amountnya3').text(amt);
$('#amountnya4').text(amt);
$('#amountnya5').text(amt);
// $('#amountnya6').text(amt);
function fn_atm(){
  // alert('as');
  TypePayment = '03';
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm()"><</button>&emsp; ATM / BANK Transfer');  
  $('#choosePayment').hide(500);
  $('#formATM').show(500);
}
function fn_cc(){
  TypePayment = '01';
  // alert('as');
  $('#modalTitle').html('<button type="button" class="back"  onclick="fn_back_cc()"><</button>&emsp; Credit Card');  
  $('#choosePayment').hide(800);
  $('#formCC').show(500);
}
function fn_back_cc() {
  TypePayment='';
   $('#modalTitle').html('Select Payment');  
  $('#formCC').hide(500);
  $('#choosePayment').show(500);
}
function fn_back_atm() {
  TypePayment='';
  $('#modalTitle').html('Select Payment'); 
  $('#formATM').hide(500);
  $('#choosePayment').show(500);
  
}
function fn_back_atm_bca() {
  
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm()"><</button>&emsp; ATM / BANK Transfer'); 
  $('#formBCA').hide(500);
  $('#formATM').show(500);
  
}
function fn_back_atm_man() {
  
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm()"><</button>&emsp; ATM / BANK Transfer'); 
  $('#formMandiri').hide(500);
  $('#formATM').show(500);
  
}
function fn_back_atm_per() {
  
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm()"><</button>&emsp; ATM / BANK Transfer'); 
  $('#formPermata').hide(500);
  $('#formATM').show(500);
  
}
function fn_back_atm_oth() {
  
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm()"><</button>&emsp; ATM / BANK Transfer'); 
  $('#formOther').hide(500);
  $('#formATM').show(500);
  
}
function fn_bca(){
  remarkspayment = 'Transer melalui ATM BCA';
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm_bca()"><</button> &emsp;BCA ATM'); 
  $('#formATM').hide(500);
  $('#formBCA').show(500);
}
function fn_mandiri(){
  remarkspayment = 'Transer melalui ATM Mandiri';
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm_man()"><</button>&emsp; Mandiri ATM'); 
  $('#formATM').hide(500);
  $('#formMandiri').show(500);
}
function fn_permata(){
  remarkspayment = 'Transer melalui ATM Permata';
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm_per()"><</button>&emsp; Permata ATM'); 
  $('#formATM').hide(500);
  $('#formPermata').show(500);
}
function fn_other(){
  remarkspayment = 'Transer melalui ATM Other BANK';
  $('#modalTitle').html('<button type="button" class="back" onclick="fn_back_atm_oth()"><</button>&emsp; Others'); 
  $('#formATM').hide(500);
  $('#formOther').show(500);
}
  $(document).ready(function () {
    var email = $('#modal').data('email'); 
    var hp = $('#modal').data('hp');   
    if(email!=''){
      $('#email').val(email);
    }
    if(hp!=''){
      $('#hp').val(hp);
    }
    
    $(".select2_demo_1").select2({
            dropdownParent: "#modal"
        });

    $('#btnSave').click(function(){
      // alert('a');
      if(TypePayment==''){
        swal('Please Select Payment First!');
        return;
      }
      if(TypePayment=='01'){
        var cardNumber = $('#cardno').val();
        if(cardNumber==''){
          swal('Please Input Card Number');
          return;
        }else{
          remarkspayment = cardNumber;
        }
      }

      // alert(remarkspayment);
      var dataform = $('#modal').data('dataform');
      dataform.push({name:"payment",value:TypePayment},
                    {name:"remarkspayment",value:remarkspayment});
      // console.log(dataform);
      // location.reload();
      var site_url = "<?php echo base_url('c_nup_trans_demo/savenup')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: dataform,
          dataType: "json",
          success: function(data, status){

           document.getElementById('loader').hidden=true; 
        

            if(data.status !='Failed'){
                  swal({
                    title: "Information",
                    text: data.pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){
                    // alert("<?php echo base_url('c_nup/Index');?>");
                    window.location.href="<?php echo base_url('nup_demo');?>"
                    
                  });
                } else {
                  swal({
                    title: "Error",
                    text: data.pesan,
                    type: "error",
                    confirmButtonText: "OK"
                  });
                }

            // window.location.href="<?php echo base_url('c_nup/Index')?>";
            // console.log(data.pesan);
            // console.log(status);
          },
          error: function(jqXHR, textStatus, errorThrown){
            
            // swal(textStatus+' Save : '+errorThrown);
            swal({
                    title: "Error",
                    text: textStatus+' Save : '+errorThrown,
                    type: "error",
                    confirmButtonText: "OK"
                  });
          }
        })
      
    }); //end butonsave
  });



    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>