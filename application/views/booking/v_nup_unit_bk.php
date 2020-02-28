  <link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />

  <div class="content-wrapper">
    <section class="content-header">
      <!-- <h1> -->
        <div class="tittle-top pull-left"><?php echo $Project[0]->descs; ?></div>
        <div class="tittle-top pull-right">Unit List</div>
      <!-- </h1> -->
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Floor </a></li>
        <li class="active"><a href="#">Floor List</a></li>
      </ol> -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">
              <table id="table1" class="table table-bordered table-hover dataTable">
                <thead>
                  <tr>
                    <th class="col-xs-1">Project</th>
                    <th>
                        <select name="Txtproperty" id="Txtproperty" data-placeholder="Choose a Project..." class="chosen-select form-control" tabindex="2" >
                          <!-- <option value=""></option>
                          <?php 
                                foreach ($cfProperty as $row) 
                                          {
                                              echo '<option value="'.$row->property_cd.'">'.$row->descs.'</option>';
                                          }
                            ?>   -->                                    
                            <?php echo $cfProperty; ?>
                        </select>
                    </th>
                  </tr>
                  <tr>
                    <th class="col-xs-1">Floor</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>
                   <?php echo $userLevelList; ?>            
                </tbody>
              </table>
            </div>
          </div>
        </div>      
      </div>         
    </section>    
</div>
  
  <!-- Choosen -->
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
//End choosen properties      
var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:false},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
//End choosen properties

// $('#Txtproperty').on("change",function(e){
//    var property_cd = $('#pl_property').val();

$("#Txtproperty").change(function() {
          var pc = $(this).find(':selected').val(); 
          alert(pc);
          if(pc!=='') {
            var site_url = '<?php echo base_url("c_nup_parameter/zoom_project")?>';
            $.post(site_url,
              {pc:pc},
              function(data,status) {
                $("#TxtprojectNo").empty();
                $("#TxtprojectNo").append(data);
                $("#TxtprojectNo").trigger('chosen:updated');
              }
            );
          } else {
            $("#Txtproperty").empty();
          }
        });

</script>

  <script type="text/javascript">
    $(document).on("click", ".open-AddBookDialog", function () {
     var myBookId = $(this).data('id');
     var b1 = document.getElementById('lotDetail');
     var link1 = '<?php echo base_url('OptionFloor/lotDetail'); ?>/'+ myBookId;
     var b2 = document.getElementById('bookEntry');
     var link2 = '<?php echo base_url('C_rl_sales/index'); ?>/'+ myBookId;
     b1.setAttribute('href', link1);
     b2.setAttribute('href', link2);
     return false; 

  });
  </script>

  <!-- <section class="content"> -->
    <div class="example-modal">
      <div class="modal" id="addBookDialog" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Unit Detail and Booking</h4>
            </div>
            <div class="modal-body">
              <label> Please check lot detail or Booking </label>
            </div>
            <div class="modal-footer">
              <a href="<?php echo base_url();?>OptionFloor/lotDetail" id="lotDetail"><button type="submit" class="btn btn-success pull-left"> Lot Detail </button></a>
              <a href="<?php echo base_url();?>C_rl_sales/index" id="bookEntry"><button type="submit" class="btn btn-success pull-right"> Booking </button></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- </section> -->

     


    