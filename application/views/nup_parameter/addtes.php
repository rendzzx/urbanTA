      
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
<!-- daterange picker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/daterangepicker/daterangepicker-bs3.css')?>">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" >
<!-- Bootstrap time Picker -->

<!-- <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet"> -->

<script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>"></script>
<script type="text/javascript">
  // $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
    $.fn.modal.Constructor.prototype.enforceFocus = function () {
      var that = this;
      $(document).on('focusin.modal', function (e) {
         if ($(e.target).hasClass('select2-input')) {
            return true;
         }

         if (that.$element[0] !== e.target && !that.$element.has(e.target).length) {
            that.$element.focus();
         }
      });
    };
  $("#frmEditor").validate({
            rules: {
                TxtentityCode: {
                    required: true
                },
                TxtprojectNo:{
                    required:true
                },
                TxtphaseCode:{
                    required:true
                },
                TxtstartEndDate:{
                  required:true,
                  date:true
                }
            },

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
</script>

<div id="loader" class="loader" hidden="false"></div>
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="nup_id" class="col-sm-2 control label"></label>
                <input type="hidden" name="txtNupId" id="txtNupId" class="form-control">
            </div>
            <div class="form-group">
                <label for="entity_name" class="col-sm-2 control-label">Entity Name</label>
                <div class="col-sm-6">
                    <select class="select2_demo_1 form-control">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                        <option value="5">Option 5</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="project_name" class="col-sm-2 control-label">Project Name</label>
                <div class="col-sm-6">
                    <select name="TxtprojectNo" id="TxtprojectNo" data-placeholder="Choose a Project..." class="form-control select2" tabindex="2">
                    <option value=""></option>
                    <option value="">1</option>
                    <option value="">3</option>
                    </select>
                </div>
            </div>
                       
            <div class="form-group">
                <label class="col-sm-2 control-label">Start and End Date</label>
                <div class="col-sm-6">
                  <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                        <input type="text" class="form-control pull-right" id="TxtstartEndDate" name="TxtstartEndDate">                  
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-4">
                    <label class="radio-inline"><input type="radio" name="status" id="1" value="1" checked>Active </label>
                    <label class="radio-inline"><input type="radio" name="status" id="0" value="0">Obsolete </label>    
                </div>                                
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Action </label>
                <div class="col-sm-4">
                    <label class="checkbox-inline"><input type="checkbox" name="txtUnitStatus" id="txtUnitStatus">Choose Unit </label>
                    <label class="checkbox-inline"><input type="checkbox" name="txtCancelNUP" id="txtCancelNUP">Cancel NUP</label>   

                </div>                                
            </div>
        </div>                  
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        </div>
    </form>



<!-- Select2 -->
<!-- <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script> -->

<!-- date-range-picker -->
<script src="<?=base_url('js/plugins/fullcalendar/moment.min.js')?>"></script>
<script src="<?=base_url('js/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".select2_demo_1").select2({
            dropdownParent: "#modal"
        });
    });
    
</script>
 
           