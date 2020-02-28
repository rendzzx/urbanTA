<link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>" type="text/javascript"></script>
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
                      <li class="first current" role="tab" aria-disabled="false" aria-selected="true">
                        <a id="form-t-0" href="#form-h0" aria-controls="form-p-0">
                          <span class="current-info audible">current step: </span>
                          <span class="number">1. </span>
                          Choose Property
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">2. </span>
                          Choose Unit
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">3. </span>
                          Input Customer Information
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
                          <!-- <span class="current-info audible">current step: </span> -->
                          <span class="number">4. </span>
                          Input Payment Plan + Disc
                        </a>
                      </li>
                      <li class="disabled" role="tab" aria-disabled="true">
                        <a id="form-t-1" href="#form-h1" aria-controls="form-p-1">
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
                        <h3 class="panel-title">Property</h3>
                      </div>
                      <div class="panel-body row" >
                        <form name="basicform" id="basicform" class="form-horizontal" method="post" action="#">
                        <div class="box-body">
                          <div class="form-group" hidden="hidden">
                                  <label class="col-sm-2 control-label">Product</label>                
                                  <div class="col-sm-7">
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
                              <div class="form-group">
                                  <label class="col-sm-2 control-label">Property Type</label>
                              </div>
                              <div  class="form-group">
                                <div id="property_div" class="col-sm-12">
                                  
                                </div>
                                <input type="hidden" name="txtproperty" id="txtproperty" >
                                <input type="hidden" name="txtproperty_type" id="txtproperty_type" >
                                </div>
                            </div>
                            <div class="box-footer col-sm-12">
                              <!-- <div class="form-group"> -->
                                <input type="button" name="btnback" id="btnback" value="Back" class="btn btn-primary">
                                <input type="button" name="btnNext" id="btnNext" value="Next" class="btn btn-primary">              
                                <!-- <input type="button" name="btntes" id="btntes" value="Tes" class="btn btn-primary"> -->
                              <!-- </div> -->
                            </div>
                        </form>     
                      
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
function fn_click_image(proprety_cd,property_type){
console.log(property_type);
console.log(proprety_cd);
$('#txtproperty').val(proprety_cd);
$('#txtproperty_type').val(property_type);

window.location.href = "<?php echo base_url('c_stepbooking/index')?>"+'/'+property_type+'/'+proprety_cd;
}
$(document).ready(function(){

  $('#property_div').load( "<?php echo base_url('c_stepbooking/property_image');?> #property_div");

});
     //  $(".select2_demo_1").select2();
     // $('input:radio[name="product"]').change(function(){
     //  var product_cd = $(this).val();  
     //  // alert(product_cd);
     //  $('#texthidden').val(product_cd);
       
     //   $('#property_div').load( "<?php echo base_url('c_stepbooking/property_type_image');?>"+"/"+product_cd+" #property_div");

     // });
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
        window.location.href = "<?php echo base_url('c_stepbooking/indexNew')?>";
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
    