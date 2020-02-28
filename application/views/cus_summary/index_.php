  <script src="<?=base_url('js/plugins/pdfjs/pdf.js')?>"></script>

 <div id="loader" class="loader" hidden="true"></div>

<body class="">
    <div class="content-wrapper">
        <section class="row border-bottom white-bg dashboard-header">
            <div class="form-group">        
                <!-- <label for="pl_project" class="control-label pull-left">The Nove Nuvasa Bay</label> -->
                <div class="tittle-top pull-right">NUP Choose Unit Summary</div>
            </div><br>
            <div class="form-group">
                <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;font-size: 15px">Choose Project</label>
                <div class="col-sm-10">
                    <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;" tabindex="2">
                      <option value=""></option> 
                      <?php 
                      foreach ($project as $row) 
                      {
                          echo '<option value="'.$row->project_no.'">'.$row->descs.'</option>';
                      }
                      ?>            
                  </select>
                  <button id="cari" class="btn blue-bg"><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
                  <button id="download" class="btn btn-white" ><i class="fa fa-download"></i> <span class="hidden-xs">Download</span></button>
              </div>
              <br>
          </div>
      </section><br>

      <div class="wrapper wrapper-content">
      

<div id="sumary">
        <div class="float-e-margins" id="reports">
            <div class="ibox-title" align="center">
                <div  style="font-size: 14px"><strong>Summary Pass</strong></div>
            </div>
            <div class="ibox-content">
            <div class="row">                                                                           
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                    <div class="ibox float-e-margins" id="reports">
                        

                        <div class="ibox-content" >
                            <div class="table-responsive">
                            <table class="table table-bordered" style="border-color: black;border: 1px">
                  
                                <tbody>

                                    <?php echo $Listdata; ?>
                                
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>

               <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div  align="center">
                            <div style="font-size: 14px"><strong>Summary Stock</strong></div>
                        </div>
                            <div class="table-responsive">
                            <table class="table table-bordered">
                           
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

</div>
</body>
<script type="text/javascript">
$(document).ready(function(){

    var url = '';
    $('#txt_Pl_Project').select2();
    var report = document.getElementById("reports");
    report.style.visibility="hidden";

    $('#cari').click(function(){
      var project = $('#txt_Pl_Project').val();
      console.log(project);
      if(project == ''){
        swal('Information','Please Choose Project ','warning');
        return;
      }else{
        document.getElementById('loader').hidden=false;
        $('#sumary').load( "<?php echo base_url('c_cus_summary/goto_table');?> #sumary",{"project_no":project} );
      
        document.getElementById('loader').hidden=true;
        report.style.visibility="visible";
      }
    
    
    });

$('#download').click(function(){
        var project = $('#txt_Pl_Project').val();
        var pdf = 'ChooseUnitSum_'+project+'.pdf';
        console.log(project);
        if(project == ''){
          swal('Information','Please choose project','warning');
          return;
        }else{
          document.getElementById('loader').hidden=false;
          var site_url = '<?php echo base_url("c_cus_summary/createpdf")?>';
          $.post(site_url,{project_no:project},
            function(data){
              window.location.href="<?php echo base_url('c_cus_summary/download')?>/"+pdf;
              document.getElementById('loader').hidden=true;
            }
            );
        }
     });
  });

</script>