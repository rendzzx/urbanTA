 
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/pickers/daterange/daterangepicker.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/pickers/daterange/daterange.css')?>">
<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <br><br>
           <h3 class="content-header-title">NUP Summary</h3>
        </div>

      </div>
      <div class="content-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
                  <div class="card-content collapse show">
                      <div class="card-body card-dashboard">
                        <div class="form-group">
                          <label for="pl_project" class="control-label" style="padding-left:0px;font-size: 15px"> Choose Project</label>
                            <div class="row" style="padding-left: 15px;">
                              <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;font-size: 15px;" tabindex="2">
                                <option value=""></option> 
                                <?php echo $comboProject ?>
                            
                              </select>
                               <button id="cari" class="btn btn-primary" style="margin-left: 10px"><i class="ft-search"></i> <span class="hidden-xs">Search</span></button>
                               <button id="download" class="btn btn-info" style="margin-left: 10px"><i class="ft-download"></i> <span class="hidden-xs">Download</span></button>
                            </div>
                            <br>
                          </div>
                          <div id="sumary">
                          <div class="ibox float-e-margins" id="reports">
                              
                              <div class="ibox-content">
                              <div class="row">
                                      <div class="col-lg-12">
                                          
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
      </div>
  </div>
</div>


<!-- JAVASCRIPT -->
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/pickers/daterange/daterangepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/pdfjs/pdf.js')?>"></script>
<script type="text/javascript">
 $(document).ready(function(){
    var url = '';
    $('#txt_Pl_Project').select2();
    $('#txtTanggal').select2();
  $('.select2').select2();
  var report = document.getElementById("reports");
  report.style.visibility="hidden";



  $('#cari').click(function(){
    var project = $('#txt_Pl_Project').val();
    var tanggal = $('#txtTanggal').val();
    block(true,'.card-body');
    if(project == '' ){
      swal('Information','Please Choose Project ','warning');
      block(false,'.card-body');
    }else{
      $('#sumary').load( "<?php echo base_url('grafik/goto_table');?> #sumary",{"project_no":project,"nup_date":tanggal} );
      report.style.visibility="visible";
      block(false,'.card-body');
    }
 
    
  });
 $('#download').click(function(){
      var project = $('#txt_Pl_Project').val();
       block(true,'.card-body');
        var pdf = 'NUPSummary_'+project+'.pdf';
        if (project == ''){
            swal('Information','Please choose project','warning');
            block(false,'.card-body');
        } else {
            var site_url = '<?php echo base_url("grafik/createpdf")?>';
            $.post(site_url,
              {project_no:project},
              function(data) {
                console.log(data);
                if(data=='OK'){
                  window.location.href="<?php echo base_url('grafik/download')?>/"+pdf;
                }else{
                  swal('Information','Can\'t download PDF! No Data Available.','error');
                }
                
                block(false,'.card-body');
              });
        }
        
    });
 });
</script>