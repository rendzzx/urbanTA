<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<div class="app-content content">
	<div class="content-wrapper">
    	<div class="content-wrapper-before"></div>
    	<div class="content-header row">
	      	<div class="content-header-left col-md-4 col-12 mb-2">
		        <br><br>
		        <h3 class="content-header-title"><?php echo $project ?></h3>
		    </div>
	    </div>
	</div>
    <div class="content-body">
    	<section id="configuration">
        	<div class="row">
                <div class="col-12">
                    <div class="card">
                    	<div class="card-header">
                            <?php if($status=='N'){echo 'ADD NUP Entry '.$phase->descs;}else{echo 'EDIT NUP Entry '.$phase->descs;} ?>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
			                <div class="card-body card-dashboard">
			                	<form class="form" id="frmdata">
								    <div class="form-body col-8">
								        <div class="form-group">
								            <label for="descs">Nama / Name<FONT COLOR="RED">*</FONT></label>
								            <div class="row">
								            	<div class="col-3">
									            	<select data-placeholder="Select Salutation" class="select2 form-control" id="salutation" name="salutation">
										                <option value=""></option>
														<option value="Mr.">Mr.</option>
														<option value="Mrs.">Mrs.</option>
														<option value="Ms.">Ms.</option> 
										            </select>
									            </div>
									            <div class="col-9">
										            <input type="text" class="form-control" name="customer" id="customer" placeholder="Input Name">
									            </div>
								            </div>
								        </div>
								        <div class="form-group">
								            <label for="labourid">HP / Mobile<FONT COLOR="RED">*</label>
							            	<div class="row">
							            		<div class="col-3">
									                <select class="select2 form-control" name="country_cd" id="country_cd" data-placeholder="Select Country">
										                <?php echo $comboCountry ?>
									                </select>
									            </div>
									            <div class="col-9">
									            	<input type="text" class="form-control" name="HP" id="HP" data-inputmask="'mask':'999999999999'" placeholder="8xxxxxxxxxx">
									            </div>
							            	</div>
								        </div>
								        <div class="form-group">
							            	<label>Email<FONT COLOR="RED">*</FONT></label>
							                <input type="text" class="form-control" name="Email" id="Email" placeholder="Input Email">
							            </div>
							            <div class="form-group">
								            <label for="nationality">Nationality</label>
								            <select class="select2 form-control" name="nationality" id="nationality" data-placeholder="Select Nationality"><?php echo $cbnationality ?></select>
								        </div>
								        <div class="form-group">
											<label name="lblnoktp" id="lblnoktp">No. KTP / ID No.<FONT COLOR="RED">*</FONT></label>
											<label name="lblnopass" id="lblnopass" hidden="true">No. Passport / Passport No.<FONT COLOR="RED">*</FONT></label>                 
											<input type="text" class="form-control" name="noktp" id="noktp" placeholder="Input ID Number">
										</div>
										<div class="form-group">
											<label for="address">Alamat / Address<FONT COLOR="RED">*</FONT></label>                
											<textarea class="form-control" placeholder="Input Address" name="address" id="address" style=" height: 50px;"></textarea>
										</div>
										<div class="form-group">
											<label for="city">Kota / City<FONT COLOR="RED">*</FONT></label>
											<select class="select2 form-control"  name="city" id="city" data-placeholder="Select City">
												<!-- <?php echo $comboCity;?> -->
											</select>
										</div>
										<div class="form-group">
											<label id="lblnpwp" name="lblnpwp">NPWP</label>                
											<input type="text" class="form-control" name="npwp" id="npwp" placeholder="Input NPWP">
										</div>
										<div class="form-group" id="divproduct">
							            	<label for="product">Product<FONT COLOR="RED">*</FONT>
							                <?php
							                foreach($product as $row)
							                {
								                $var=' <input type="radio" id="'.$row->product_cd.'" name="product" value="'.$row->product_cd.'" tabindex="-2" />'.$row->descs;
								                
								                echo $var;
							                }  
							                ?>
							            </div>
							            <div class="form-group" >
											<label for="property">Property<FONT COLOR="RED">*</FONT></label>
											<select class="select2 form-control" name="property" id="property" data-placeholder="Select Property"><option value=""></option><?php echo $comboTnup ?></select>
										</div>
										<div class="form-group">
											<label>Tipe NUP / NUP Type<FONT COLOR="RED">*</FONT>
												<input type="button" value="More Info" onclick="nuptypeinfo(1);" class="btn btn-info btn-xs">
											</label>
											<div class="row">
												<div class="col-sm-6">
													<select class="select2 form-control" name="nuptype" id="nuptype" data-placeholder="Select NUP Type">
														<option value=""></option>
													</select>                  
												</div>
												<div class="col-sm-6">
													<input class="form-control" name="nupamt" id="nupamt" readonly>
												</div> 
											</div>
									    </div>
									    <div class="form-group" >
											<label for="Location">Lokasi launcing yang dipilih /<br>Preffered launching location<FONT COLOR="RED">*</FONT>
												<input type="button" value="More Info" onclick="nuptypeinfo(0);" class="btn btn-info btn-xs">
											</label>
											<select class="select2 form-control" name="Location" id="Location" data-placeholder="Select Location"><?php echo $comboLocation; ?></select>                  
										</div>
										<div class="form-group">
											<label>Cara Pembayaran NUP /<br>Payment Method</label>
											<div class="row">
												<div class="col-sm-6">
													<select class="select2 form-control" name="payment" id="payment" data-placeholder="Select Payment Method"><?php echo $payment; ?></select>                  
												</div>
												<div class="col-sm-6">
													<input class="form-control" name="remarkspayment" id="remarkspayment" placeholder="">
												</div>
											</div>
											</div>
									</div>
								</form>
			               	</div>
			            </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script>
	$(document).ready(function(){
	    $(".select2").select2();
	});
</script>