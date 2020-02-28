
<style type="text/css">
.kedisable {
   /*pointer-events: none;*/
   cursor: default;
}

</style>
<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $projectName; ?></h3>
        <h4 class="content-header-title">Sales Booking</h4>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      </div>
    </div>

    <div class="content-body">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Choose Property</h4>
            </div>

            <div class="card-content">
              <form name="basicform" id="basicform" class="form form-horizontal" method="post" action="#">
                <div class="form-body">
                  <div class="form-body">

                    <div class="form-group row" hidden="hidden">
                        <label class="col-2 label-control">Product</label>                
                          <div class="col-8">
                              <?php
                                foreach($product as $row)
                                  {
                                    $var ='<label class="radio-inline">';
                                    $var.=' <input type="radio" id="'.$row->product_cd.'" name="product" value="'.$row->product_cd.'" tabindex="-2" />'.$row->descs;
                                    $var.=' </label>';
                                    echo $var;
                                  }  
                                ?>
                              <input type="hidden" name="texthidden" id="texthidden" >
                          </div>
                      </div>

                      <div class="form-group row" hidden="hidden">
                          <label class="col-2 control-label">Property Type</label>
                      </div>

                      <div class="col-12" style="padding-left: 50px;align-content: center; vertical-align: center;">
                        <div id="property_div" class="col-12">
                          <div class="row">
                            
                          </div>
                        </div>
                        <input type="hidden" name="txtproperty" id="txtproperty" >
                        <input type="hidden" name="txtproperty_type" id="txtproperty_type">
                      </div>
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
function fn_click_image(proprety_cd){
console.log(proprety_cd);
$('#txtproperty').val(proprety_cd);
window.location.href = "<?php echo base_url('c_booking_landed/indextipe')?>"+'/'+proprety_cd;
}
$(document).ready(function(){

  $('#property_div').load( "<?php echo base_url('c_stepbooking/property_image');?> #property_div");

});

     $('#basicform').validate({
      ignore: "",
      rules: {
        texthidden:{required: true},
        // txtproperty:{required: true},
      },
      errorElement: "em",
      errorPlacement: function(error, element){
        error.addClass("help-block  text-red");
        element.parents(".col-xs-5").addClass("has-feedback  text-red");
        if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
        } else {
            error.insertAfter(element);
        }

        if (!element.next("span")[0]) {
            $("<span class='glyphicon glyphicon-remove form-control-feedback glyph-color-red' style = 'left: 90%' ></span>").insertAfter(element);
        }
      },
      success: function(label, element){
        if (!$(element).next("span")[0]) {
            $("<span class='glyphicon glyphicon-ok form-control-feedback' style = 'left: 90%'></span>").insertAfter($(element));
        }
      },
      highlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-error").removeClass("has-success");
        $(element).next("span").addClass("glyphicon-remove").removeClass("glyphicon-ok");
      },
      unhighlight: function(element, errorClass, validClass){
        $(element).parents(".col-xs-5").addClass("has-success").removeClass("has-error");
        $(element).next("span").addClass("glyphicon-ok").removeClass("glyphicon-remove glyph-color-red");
      }

     });
     $('#btnNext').click(function(){
      // alert('tes');
      var a = $('#txtproperty').val();
      var b = $('#txtproperty_type').val();
      if(a.length ==0){
        swal("Error","Please Click Property","error");
        return;
      }
      if($('#basicform').valid()){
        var product =$('input[name="product"]:checked').val();
        // console.log(a);
        // console.log(b);
      
        window.location.href = "<?php echo base_url('c_stepbooking/index')?>"+'/'+b+'/'+a;
      }
     });

     $('#btnback').click(function(){
        // alert('tes');
        var a ='<?php echo $project;?>';
        var b ='<?php echo $projectName;?>';
        window.location.href = "<?php echo base_url('c_booking/indexNew')?>";
        // window.open("<?php echo base_url('c_stepbooking/go_toPDF')?>","_blank");
     });
     $('#btntes').click(function(){
      var tt = 'esss';
      var site_url = "<?php echo base_url('c_stepbooking/tes')?>";
        $.ajax({
          url: site_url,
          type: "POST",
          data: {tt:tt},
          dataType: "json",
          success: function(data, status){
            BootstrapDialog.alert(data.Pesan, function(result){
            });

            
          },
          error: function(jqXHR, textStatus, errorThrown){
            BootstrapDialog.alert(textStatus+' Save : '+jqXHR.responseText);
          }
        })
     });
     
</script>
    