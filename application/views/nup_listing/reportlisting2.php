
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/pickers/daterange/daterangepicker.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/pickers/daterange/daterange.css')?>">
  <style type="text/css">
    .report{font-size:10px}.page-header{font-size:11px}.page-footer{font-size:9px}.text-center{text-align:center}#outtable{padding:20px;border:1px solid #e3e3e3;width:600px;border-radius:5px}.short{width:15px}.normal{width:180px}.extra{width:200px}.sign{width:20px;text-align:left}.money{width:100px;text-align:right}.today{margin-left:30px}.signed{text-align:center;width:150px}.ft{height:50px;vertical-align:bottom}.t01{border-bottom: 1px solid black;border-top: 1px solid black; border-collapse: collapse;}.colheader{background-color: #f5f5f6;border: 1px solid #ddd;}.space{border-right: 10px solid transparent;}.tblbordered{border: 1px solid #ddd;}
  </style>
<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <br><br>
           <h3 class="content-header-title">NUP Listing</h3>
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
                               <button id="search" class="btn btn-primary" style="margin-left: 10px"><i class="ft-search"></i> <span class="hidden-xs">Search</span></button>
                               <button id="download" class="btn btn-info" style="margin-left: 10px"><i class="ft-download"></i> <span class="hidden-xs">Download</span></button>
                            </div>
                            <br>
                          </div>
                          <div id="nup_listing_div">
                            <div class="ibox float-e-margins" id="reports" >
                              <div class="ibox-title" align="center" >
                                <div style="font-size: 14px"><strong><?php echo $nama_project?></strong></div>
                                <div></div>
                              </div>
                              
                              <div class="row">
                                <div class="col-lg-12">
                                  <div class="ibox-content">
                                    <table class="table" style="width:800px;" align="center">
                                      <?php echo $isi_table?>
                                    </table>
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
<script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">

  $(document).ready(function(){


  var url = '';
  $('.select2').select2();
  var report = document.getElementById("reports");
  report.style.visibility="hidden";
  

   $('#search').click(function(){
    block(true,'.card-body');
    var project = $('#txt_Pl_Project').val();
    if(project==''){
      swal("Information",'Please select a Project',"warning");
      block(false,'.card-body');
    } else {

    
      $('#nup_listing_div').load( "<?php echo base_url('c_nup_listing/goto_table');?> #nup_listing_div",{"project_no":project});

      report.style.visibility="visible";
      block(false,'.card-body');
    }
    
   });
   $('#download').click(function(){
        var project = $('#txt_Pl_Project').val();
       block(true,'.card-body');
        var pdf = 'NUPListing_'+project+'.pdf';
        if (project == ''){
            swal('Information','Please choose project','warning');
            block(false,'.card-body');
        } else {
          
     
            var site_url = '<?php echo base_url("c_nup_listing/createpdf")?>';
            $.post(site_url,
              {project_no:project},
              function(data) {
                if(data=='OK'){
                  var url = '<?php echo base_url("pdf/Reports")?>/'+pdf;
                  window.location.href="<?php echo base_url('c_nup_listing/download')?>/"+pdf;
                }else{
                  swal('Information','Can\'t download PDF! No Data Available.','error');
                }
                
                block(false,'.card-body');
              }
            );
        }
        
    });
     
    
});
</script>