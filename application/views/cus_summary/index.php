<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<div class="app-content content">
	<div class="content-wrapper">
    	<div class="content-wrapper-before"></div>
    	<div class="content-header row">
	      	<div class="content-header-left col-md-4 col-12 mb-2">
		        <br><br>
		        <h3 class="content-header-title">Sales Summary</h3>
		    </div>
	    </div>
	</div>
    <div class="content-body">
        <section id="configuration">
        	<div class="row">
                <div class="col-12">
                    <div class="card">
                    	<div class="card-header">
                            <div class="form-group">
                        <label for="txt_Pl_Project" class="font-weight-bold">Choose Project : </label>
                        <select data-placeholder="Choose a Project..." class="select2" id="txt_Pl_Project" name="txt_Pl_Project">
                          <option value=""></option> 
                            <?php 
                            foreach ($project as $row) 
                            {
                                echo '<option value="'.$row->project_no.'">'.$row->descs.'</option>';
                            }
                            ?>
                        </select>
                        <button id="cari" class="btn btn-primary"><i class="ft-search"> </i><span class="hidden-xs">Search</span></button>
                      </div>
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
			                	<div id="sumary">
                          <div id="reports">
                            <div class="row">
                              <div class="col-12">
                                <strong>Summary Pass</strong>
      			                		<table class="table table-bordered" style="border-color: black;border: 1px">
                                    <tbody>
                                        <?php echo $Listdata; ?>
                                    </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-12">
                                <strong>Summary Stock</strong>
                                <table class="table table-bordered" style="border-color: black;border: 1px">
                                    <tbody>
                                      <tr>
                                         <?php echo $Listdata2; ?>
                                      </tr>
                                    </tbody>
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
        </section>
    </div>
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script>

$(document).ready(function(){

	$(".select2").select2({
	    width : 300
	});

    $('#txt_Pl_Project').select2();
    $('#reports').hide();

    $('#cari').click(function(){
        block(true, '.card-body')
	    var project = $('#txt_Pl_Project').val();
		if(project == ''){
			swal('Information','Please Choose Project ','warning');
			return;
		}else{
			$('#sumary').load( "<?php echo base_url('c_cus_summary/goto_table');?> #sumary",{"project_no":project} );
			block(false, '.card-body')
		}
    
    
    });

$('#download').click(function(){
        var project = $('#txt_Pl_Project').val();
        var pdf = 'SalesSum_'+project+'.pdf';
        console.log(project);
        if(project == ''){
          swal('Information','Please choose project','warning');
          return;
        }else{
          block(true)
          var site_url = '<?php echo base_url("c_sales_summary/createpdf")?>';
          $.post(site_url,{project_no:project},
            function(data){
              window.location.href="<?php echo base_url('c_sales_summary/download')?>/"+pdf;
              block(false)
            }
            );
        }
     });
  });
</script>