<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<form class="form" id="frmdata">
  <div class="card col-sm-6">
    <div class="card-body">
      <div class="form-body">
        <div class="form-group">
            <label for="sectioncd">Overtime Date</label>
            <div id="txtTime" style="color: #00a1e4;font-weight: bold"></div>
        </div>
        <div class="form-group">
            <label >Debtor<FONT COLOR="RED">*</FONT></label>
            <select data-placeholder="Select Debtor." class="select2 form-control" id="debtor_name" name="debtor_name">
                <option value=""></option>
                  <?php echo $dtdebtor?>
            </select>
        </div>
        <div class="form-group">
            <label >Lot No. <FONT COLOR="RED">*</FONT></label>
            <select name="lotno[]" id="lotno" data-placeholder="Select Lot..." style="width: 100%;" class="select2 form-control" >
                  <option value=""></option>
                  <?php echo $datalot;?>                
              </select>
        </div>
      </div>
    </div>
  </div>
</form>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){

    $(".select2").select2();

    var dt = $('#modal').data('ovdate');
    $('#txtTime').html(dt)

  })
</script>