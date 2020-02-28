

<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"> <?php echo $project_name; ?></h3>
        <h4 class="content-header-title"> Sales Booking</h4>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      </div>
    </div>

     <div class="content-body"> 
      <div class="row">      
        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <h3>&nbsp; Choose Floor </h3>
                        <br/>
              </div>

                        <div class="card-content">
                            <form name="basicform" id="basicform" class="form form-horizontal" method="post" action="#">
                                <div class="form-body">
                                    <div class="col-12" style="padding-left: 50px;align-content: center; vertical-align: center;">
                                    <div id="property_div" class="col-12">
                                      <div class="row">
                                        
                                      </div>
                                    </div>
                                    <input type="hidden" name="txtlevel" id="txtlevel" >
                                    <input type="hidden" name="txtproperty_type" id="txtproperty_type">
                                  </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="submit" class="btn btn-primary mr-1" name="btnback" id="btnback">Back</button>    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>


<script type="text/javascript">
function fn_click_btn(level_no){

$('#txtlevel').val(level_no);

  window.location.href = "<?php echo base_url('c_booking_landed/indexunit')?>"+'/'+level_no;

}

$(document).ready(function(){

  $('#property_div').load( "<?php echo base_url('c_booking_landed/property_types');?> #property_div");

});

$('#btnback').click(function(){
        var b ='<?php echo $project_name;?>';
        window.location.href = "<?php echo base_url('c_booking/index')?>";
     });
</script>





  


