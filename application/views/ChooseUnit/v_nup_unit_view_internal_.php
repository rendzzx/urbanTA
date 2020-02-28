<!-- <link href="<?=base_url('css/w3.css')?>" rel="stylesheet" /> -->
<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("<?php base_url('/img/loading.gif') ?>") no-repeat center center   
}

.btn-green:hover, .btn-green:focus, .btn-green:active, .btn-green.active, .open .dropdown-toggle.btn-green, .btn-green:active:focus, .btn-green:active:hover, .btn-green.active:hover, .btn-green.active:focus {
    background-color: #18a689;
    border-color: #18a689;
    color: #FFFFFF;
}
.btn-green {
    background-color: #1ab394;
    border-color: #1ab394;
    color: #FFFFFF;
}
.btn-orange:hover, .btn-orange:focus, .btn-orange:active, .btn-orange.active, .open .dropdown-toggle.btn-orange, .btn-orange:active:focus, .btn-orange:active:hover, .btn-orange.active:hover, .btn-orange.active:focus {
    background-color: #a67118;
    border-color: #a67118;
    color: #FFFFFF;
}
.btn-orange {
    background-color: #db861e;
    border-color: #db861e;
    color: #FFFFFF;
}
.tittle-top{
  font-weight: bold;
}
</style>
<script type="text/javascript" src="<?=base_url('js/skinnytip.js')?>"></script>
    <style>
      span {
        border-bottom: 1px;
        
      }
    </style>

   <div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
      <div class="form-group">
        <div class="tittle-top pull-left"><?php echo $project_name ?></div>
        <div class="tittle-top pull-right">Unit Enquiry</div>  
      </div>
    </section><br>         
      <section class="content">   
      <div class="row border-bottom white-bg dashboard-header">
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="col-sm-2" style="padding-top: 10px;">
                        <label class="control-label">Legend</label>
                    </div>
                    <div class="col-sm-2">
                      <button type="button" id="btnRed" name ="btnRed" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-green" >Available</button>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" id="btnGreen" name ="btnGreen" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" >Sold</button>
                    </div>
                    <div class="col-sm-2">
                      <button type="button" id="btnOrange" name ="btnOrange" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;background:#FF8000;color:white;" class = "btn btn"  >Hold</button>
                    </div>
                    <!-- <div class="col-sm-2">
                      <button type="button" id="btnOrange" name ="btnOrange" style="width: 100px;margin-bottom: 5px; margin-top: 5px; margin-left: 5px; margin-right: 5px;background:#F7FE2E;" class = "btn btn"  >Reserved</button>
                    </div> -->
                </div>
            </div>
        </div> <br>
      <div class="row">      
        <div class="col-xs-12" style="padding-right: 0px;padding-left: 0px;">        
          <div class="ibox-content">
            <div class="box-body">            
             <div class="form-group">
              <label for="pl_project" class="col-sm-2 control-label" style="padding-left: 0px;">Property Type</label> 
                  <div class="form-group">
                    <div class="pull-left">
                      <select name="pl_property" id="pl_property" data-placeholder="Choose a Project..." class="select2" style="width:250px;" tabindex="2">
                        <option value=""></option>
                        <?php echo $property_type; ?>      
                      </select> 
                    </div>
                  </div>
            </div>

            <div class="form-group">
              <label for="pl_project" class="col-sm-1 control-label" id="label_level">Level</label>
                <div class="form-group">
                  <div class="pull-left">
                    <select name="level_no" id="level_no" data-placeholder="Choose a Level..." class="select2" style="width:250px;" tabindex="2">
                      <option selected="1" value="L">All Unit</option>                                   
                      <?php echo $level_no; ?>      
                    </select>
                  </div>
                  <div class="pull-right">
                    <span id="time"></span>
                  </div>
                </div>
            </div><br>
          

            <br><br> 
              <div id="load" hidden="true"></div>
              <table id="table1" class="table table-hover dataTable">
                <thead>
                  <tr>
                    <th id="TH1" class="col-xs-1">Floor</th>
                    <th>Unit</th>
                  </tr>
                </thead>
                <tbody>                
                   <?php echo $userLevelList; ?>            
                </tbody>
              </table>
               </div>
            <div class="box-footer">
            </div>
          </div>
        </div>      
      </div>         
    </section>
  </div>
  <?php
  ?>
<!-- <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>C_nup_unitNew/validasi" enctype="multipart/form-data">
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <div class="modal-body">
            </div>
        </div>

    </div>
</div>
</form> -->



<script type="text/javascript">
$('#pl_property').select2();
$('#level_no').select2();
</script>


<script type="text/javascript">
function progress_bar(){
  var progress = '<div ="myProgress"><div id="myBar"></div></div>';
}


$('#level_no').on("change",function(e){
  // alert('a');
   var property_cd = $('#pl_property').val();
   var level_no = $('#level_no').val();
   var lot_no = $('#txtlotno').val();
   // alert(lot_no);
   var Type = $("#pl_property option:selected").data("level");
   // var true_cl = hasClass(btnN,'btn-danger');   

document.getElementById('load').hidden=false;

var state = document.readyState
  if (state == 'complete') {
      setTimeout(function(){
          document.getElementById('interactive');
         // document.getElementById('load').style.visibility="hidden";
         document.getElementById('load').hidden=true;
      },1000);
  }

  // $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_tableView');?>"+"/"+property_cd+"/"+level_no+"/"+lot_no+" #table1" );
  // $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_table');?> #table1",{"property_cd":property_cd,"level_no":level_no,"lot_no":lot_no}
$('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_tableViewInternal');?> #table1",{"property_cd":property_cd,"level_no":level_no,"Type":Type} );
});

$('#pl_property').on("change",function(e){
  // alert('1');
   var property_cd = $('#pl_property').val();
   // var level_no = 'L';
   var level_no = $('#level_no').val();
   var Type = $("#pl_property option:selected").data("level");
 if(Type=='A'){
    document.getElementById('label_level').innerHTML = 'Level';
    document.getElementById('TH1').innerHTML = 'Floor';
 }else{
    document.getElementById('label_level').innerHTML = 'Type';
    document.getElementById('TH1').innerHTML = 'Type';
 }

document.getElementById('load').hidden=false;


var state = document.readyState

  if (state == 'complete') {
      setTimeout(function(){
          document.getElementById('interactive');
         document.getElementById('load').hidden=true;
      },1000);

  }

  

  var property_cd = $(this).find(':selected').val(); 
          if(property_cd!=='') {
            var site_url = '<?php echo base_url("C_nup_unitNew/level")?>';
            $.post(site_url,
              {property_cd:property_cd,level_no:level_no},       

              function(data,status) {
                
                $("#level_no").empty();
                $("#level_no").append('<option value="L" >All Unit</option>');
                $("#level_no").append(data);
                $("#level_no").trigger('chosen:updated');
                // console.log(data);
              }

            );
          }

    // $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_table');?>"+"/"+property_cd+"/"+level_no+" #table1" );
   $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_tableViewInternal');?> #table1",{"property_cd":property_cd,"level_no":level_no,"Type":Type},function(){$('.btn').popover();} );
});

//countdown reload
// var a =3;
// display = document.querySelector('#time');
//     startTimer(a, display);

// function startTimer(duration, display) {
//         var timer = duration, minutes, seconds;
//         setInterval(function () {
//             minutes = parseInt(timer / 60, 10)
//             seconds = parseInt(timer % 60, 10);

//             minutes = minutes < 10 ? "0" + minutes : minutes;
//             seconds = seconds < 10 ? "0" + seconds : seconds;

//             display.textContent = 'Reload In : '+ seconds;
//             if(seconds==0){
//               var property_cd = $('#pl_property').val();
//               var level_no = $('#level_no').val();
//               var lot_no = $('#txtlotno').val();
//               var Type = $("#pl_property option:selected").data("level");
//               // console.log(property_cd);
              
//                  $('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_tableViewInternal');?> #table1",{"property_cd":property_cd,"level_no":level_no,"Type":Type},function(){$('.btn').popover();} );
//             }
//             if (--timer < 0) {
//                 timer = duration;
//             }
//         }, 1000);
//     }


    </script>


<!-- <script type="text/javascript">SkinnyTip.init();</script> -->
    