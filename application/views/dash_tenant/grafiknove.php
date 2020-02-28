<div id="loader" class="loader" hidden="true"></div>
<!-- <script type="text/javascript" src="<?=base_url('plugins/confirmationDialog/bootstrap.min.js')?>"></script>
  <link rel="stylesheet" type="text/css" href="<?=base_url('plugins/confirmationDialog/bootstrap-dialog.min.css')?>">  
  <script type="text/javascript" src="<?=base_url('plugins/confirmationDialog/bootstrap-dialog.min.js')?>"></script> -->
<div class="row border-bottom white-bg dashboard-header">   
    
    <div class="col-sm-12 control-label">
                <h5 for="pl_project" class="col-sm-2 control-label" style="padding-left:0px; font-family: Arial;color:black;font-size: 15px;"> Choose Project</h5>
                <font size="2"><div class="col-sm-5">
                    <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;">
                      <option value=""></option>    
                      <?php echo $data_project;?>   
                  </select>
                 <!--  <button id="testab">Tes</button> -->
              </div></font>
             
              <div class="col-sm-5 control-label">
       
                <b><div style="font-size: 24px;text-align: right;padding-left: 50px;font-family: Arial;color:black">Management Dashboard Tenancy</div></b>
      
                <font color="#B00909" face="ARIAL">
        
                </font>
            </div>
         
    </div>
   
 </div> 
 <div class="row"   id="chartt"> 
<br>
<div class="col-sm-12">
   <div class="tabs-container" id="tabs">
                    <ul class="nav nav-tabs">
              
                        <li class="active"><a  data-toggle="tab" href="#tab-1" > Grafik</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-2" >Unit Enquiry</a></li>
              
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane active">
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-sm-12">
        <div class="wrapper wrapper-content">
            <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #00a1e4 2px solid;">
                <b>Property Summary</b>
            </div><br>
         <div id="propertylist">
          <div class="col-lg-6">
          <!-- <div class="ibox float-e-margins"> -->
<!--           <div class="ibox-title">
          <h5 >Property by Status</h5>
         
          </div> -->
          <div class="ibox-content" style="padding-bottom: 25px; padding-top: 10px;"><br>
                <div class="table-responsive" style="overflow-y: scroll;height: 350px">
                   
                        <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" >
                                       
                            <thead>            
                                <th>Property</th>
                                <th>Status</th>
                                <th>By Quantity</th>
                                <th>By Area (m<sup>2</sup>)</th>
                                
                            </thead>
                            <tbody>

                                <?php 
                                if(!empty($listproperty)) {
                                    foreach ($listproperty as $key => $value) {

                                        $av_qty = $value->lot_avail_qty;
                                        $av_area = $value->lot_avail_area;
                                        $re_qty = $value->lot_rented_qty;
                                        $re_area = $value->lot_rented_area;
                                   ?>
                              <tr>
                                  <td><?php echo $value->descs?></td>
                                  <td><span class="label label-primary">AVAILABLE</span></td>
                                  <td style="text-align: right"><?php echo number_format($av_qty)?></td>
                                  <td style="text-align: right"><?php echo number_format($av_area)?></td>
                             </tr>
                             <tr>
                                  <td></td>
                                  <td><span class="label label-danger">RENTED</span></td>
                                  <td style="text-align: right"><?php echo number_format($re_qty)?></td>
                                  <td style="text-align: right"><?php echo number_format($re_area)?></td>
                             </tr>
                             <?php } ?>
                              <?php }else {
                                  echo "<tr><td colspan='4' style='text-align:center'> No data available </td></tr>";
                                }?>
                            </tbody>
                        </table>
                       
                    </div>
            </div>
            <!-- </div> -->
            </div>
          </div>
          
                <?php

                if(empty($js1) || empty($js2))
                {
                    echo '<div class="col-lg-6"></div>';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    // $ht.='<div class="ibox float-e-margins">';
                    // $ht.='<div class="ibox-title">';
                    // $ht.='<h5>Quantity</h5>';
                   
                    // $ht.='</div>';
                    $ht.='<div class="ibox-content col-sm-12" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;">';
                     $ht.='<br><select name="property_cd" id="property_cd" data-placeholder="Choose Property" class="select2" style="width:100%;" multiple="multiple">';
                    $ht.='    <option value=""></option>';
                    $ht.='    <option value="all">All</option>';
                    $ht.=     $propertyList;
                    $ht.='</select>';
                    $ht.='<div class="col-sm-6">';
                    $ht.='<div id="pieQTY" height="160" width="120" ></div>';
                    $ht.='<center><h4>  Unit Summary by Quantity </h4> </center>';
                    $ht.='</div>';
                    $ht.='<div class="col-sm-6">';
                    $ht.='<div id="pieAREA" height="160" width="120"></div>';
                    $ht.='<center><h4> Unit Summary by Area</h4></center>';
                    $ht.='</div>';
                    // $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>
                <div class="col-sm-12"><br><br>
                  <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #00a1e4 2px solid;">
                <b>Rental and Service Charge</b>
            </div>
                </div>
                <br><br>
                <?php

                if(empty($js3))
                {
                    echo '';

                }
                else
                {
                    $h2='';
                    $h2.='<div class="col-lg-12">';
                    $h2.='<div class="ibox float-e-margins">';
                    $h2.='<div class="ibox-title">';
                    $h2.='<b>Projection and Realisation </b> &emsp;';
                    $h2.='<select name="profityear" id="profityear" data-placeholder="Year" class="select2" style="width:140px;">';
                    $h2.='    <option value=""></option>';
                    $h2.=     $profityear;
                    $h2.='</select>';
                    $h2.='</div>';
                    $h2.='<div class="ibox-content" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;">';
                    $h2.='<div>';
                    $h2.='<div id="barproperty" height="160" width="120" style="position: fixed;"></div>';
                    $h2.='<div class="container" style="margin:0 auto;"></div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    echo $h2;
                }
                ?> 

                 <!-- <?php

                if(empty($js4))
                {
                    echo '';

                }
                else
                {
                    $h2='';
                    $h2.='<div class="col-lg-12">';
                    $h2.='<div class="ibox float-e-margins">';
                    $h2.='<div class="ibox-title">';
                    $h2.='<b>Realisation </b> &emsp;';
                    $h2.='<select name="profityear2" id="profityear2" data-placeholder="Year" class="select2" style="width:140px;">';
                    $h2.='    <option value=""></option>';
                    $h2.=     $profityear;
                    $h2.='</select>';
                    $h2.='</div>';
                    $h2.='<div class="ibox-content" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;">';
                    $h2.='<div>';
                    $h2.='<div id="bar2property" height="160" width="120" style="position: fixed;"></div>';
                    $h2.='<div class="container" style="margin:0 auto;"></div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    echo $h2;
                }
                ?>  -->

          </div>
        </div>
                                </div>
                            </div>
                        </div>
                  
                    <div id="tab-2" class="tab-pane">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <fieldset>
                                        <div class="wrapper wrapper-content">
                                        <div id="enquiry">
                                            <div style="font-size:18px; padding-bottom:5px; margin-left:15px; margin-right:15px; border-bottom: #1ab394 2px solid;">
                                                <b>Unit Enquiry</b>
                                            </div><br>                                                
                                            <div class="row border-bottom white-bg dashboard-header">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-2" style="padding-top: 10px;">
                                                            <label class="control-label">Legend</label>
                                                        </div>
                                                        <div class="col-sm-2">
                                                          <button type="button" id="btnRed" name ="btnRed" style="width: 100px;margin-bottom: 5px; margin-top: 5px; cursor:default;margin-left: 5px; margin-right: 5px;" class = "btn btn-green" >Available</button>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="button" id="btnGreen" name ="btnGreen" style="width: 100px;margin-bottom: 5px; margin-top: 5px; cursor:default;margin-left: 5px; margin-right: 5px;" class = "btn btn-danger" >Rented</button>
                                                        </div>
                                       
                                                    </div>
                                                </div>
                                            </div> <br>
                                  <div class="row">      
                                    <div class="col-xs-12">        
                                      <div class="col-sm-12">
                                        <div class="box-body">            
                                         <div class="form-group">
                                          <label for="pl_project" class="col-sm-2 control-label">Property Type</label> 
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
      </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                          </div>
      </div>
      
    </div>
    </div>
    <style type="text/css">
    .label-primary{
        background-color: #80d82d;
    }
    .label-info{
        background-color: #2fb4ed;
    }
    .label-danger{
        background-color: #e82020;
    }
</style>
<script type="text/javascript">
$('#pl_property').select2();
$('#level_no').select2();
</script>
<script type="text/javascript">
var tabvalue;
    $(document).ready(function() {
      var tabid = '<?php echo $tab ?>';
        activaTab('tab-'+tabid);
    
    });
function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
var pieQTY;
var pieAREA;
var barprop;
var bar2prop;
$('#property_cd').select2();
$('#profityear').select2();
$('#profityear2').select2();
$('#txt_Pl_Project').select2();
<?=$js1?>
<?=$js2?>
<?=$js3?>
<?=$js4?>
$('#property_cd').on("change", function(e) { 
  
  document.getElementById('loader').hidden=false;
   var property_cd = $('#property_cd').val();

    var entity = $('#txt_Pl_Project').val();
     $.ajax({  
      url : "<?php echo base_url('Dash_tenant/filter_property');?>",
      type:"POST",
      async: true,
      data: {project:entity,
        pro_cd:property_cd},
        dataType:"json",
        success:function(data){

            var array1 = data.avqty.split(",");
            var array2 = data.avarea.split(",");
            var array3 = data.renqty.split(",");
            var array4 = data.renarea.split(",");

                    pieQTY.unload({
                      done: function() {
                        pieQTY.load({ 
                          columns: [
                            array1,array3
                          ] 
                        });   
                      }
                    });
                    pieAREA.unload({
                      done: function() {
                        pieAREA.load({ 
                          columns: [
                            array2,array4
                          ] 
                        });  
                      }
                    });
                    document.getElementById('loader').hidden=true;


       
        },                    
        error: function(jqXHR, textStatus, errorThrown){

         swal('Information',textStatus+' Save : '+errorThrown,'warning');
        }
      });
    
});
$('#profityear').on("select2:selecting", function(e) { 
    var project = $('#txt_Pl_Project').val();
    var year = e.params.args.data["id"];
    document.getElementById('loader').hidden=false;
     $.ajax({
                    url : "<?php echo base_url('Dash_tenant/barproperty');?>",
                    type:"POST",
                    data: {year:year,
                          project:project,
                          },
                    dataType:"json",
                    success:function(event, data){
                    // console.log(event);
                    var arrayipl = event.ipl.split(",");
                    var arrayrental = event.rental.split(",");
                    var arrayiplreal = event.iplreal.split(",");
                    var arrayrentalreal = event.rentalreal.split(",");
                    var arraymonth = event.category.split(",");
                    console.log(arrayrentalreal);
                    
                    barprop.unload({
                      done: function() {
                        barprop.load({ 
                          columns: [
                            arraymonth,arrayrental,arrayrentalreal,arrayipl,arrayiplreal
                          ]
                        });  
                      }
                    });
                    document.getElementById('loader').hidden=true;
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                    
                                swal({
                                      title: "Information",
                                      animation: false,
                                      type:"error",
                                      text: textStatus+' Save : '+errorThrown,
                                      confirmButtonText: "OK"
                                    });
                    }
                    });
});
$('#profityear2').on("select2:selecting", function(e) { 
    var project = $('#txt_Pl_Project').val();
    var year = e.params.args.data["id"];
    document.getElementById('loader').hidden=false;
     $.ajax({
                    url : "<?php echo base_url('Dash_tenant/barproperty2');?>",
                    type:"POST",
                    data: {year:year,
                          project:project,
                          },
                    dataType:"json",
                    success:function(event, data){
              
                    var arrayipl = event.ipl.split(",");
                    var arrayrental = event.rental.split(",");
                    var arraymonth = event.category.split(",");
                    // console.log(arraymonth);
                    bar2prop.unload({
                      done: function() {
                        bar2prop.load({ 
                          columns: [
                            arraymonth,arrayrental,arrayipl
                          ]
                        });  
                      }
                    });
                    document.getElementById('loader').hidden=true;
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                    
                                swal({
                                      title: "Information",
                                      animation: false,
                                      type:"error",
                                      text: textStatus+' Save : '+errorThrown,
                                      confirmButtonText: "OK"
                                    });
                    }
                    });
});
$('#txt_Pl_Project').on("change",function(e){
    document.getElementById('loader').hidden=false;
    var project = $(this).find(':selected').val();
    var property_cd = $('#property_cd').val();
     var pro_cd = $('#pl_property').val();
   var level_no = $('#level_no').val();
   var lot_no = $('#txtlotno').val();
   // alert(lot_no);
   var Type = $("#pl_property option:selected").data("level");

      if(project == ''){
        swal('Information','Please Choose Project ','warning');
        return;
      }else{

        window.location.href = "<?php echo base_url('dash_tenant/index/');?>"+project.trim()+"/1";
       // $('#propertylist').load( "<?php echo base_url('dash_tenant/goto_table');?> #propertylist",{"project_no":project});
   
       // $('#table1').load( "<?php echo base_url('dash_tenant/goto_enquiry');?> #table1",{"project":project} );


       // var site_url = '<?php echo base_url("dash_tenant/zoom_propertytype")?>';
       //      $.post(site_url,
       //        {project:project},       
       //        function(data,status) {
       //          console.log(data);
       //          $("#pl_property").empty();
       //          $("#pl_property").append(data);
       //          $("#pl_property").trigger('change');
                
       //        }

       //      );


    //  $.ajax({  
    //   url : "<?php echo base_url('Dash_tenant/filter_property');?>",
    //   type:"POST",
    //   async: true,
    //   data: {project:project,
    //     pro_cd:property_cd},
    //     dataType:"json",
    //     success:function(data){

    //         var array1 = data.avqty.split(",");
    //         var array2 = data.avarea.split(",");
    //         var array3 = data.renqty.split(",");
    //         var array4 = data.renarea.split(",");

    //                 pieQTY.unload({
    //                   done: function() {
    //                     pieQTY.load({ 
    //                       columns: [
    //                         array1,array3
    //                       ] 
    //                     });   
    //                   }
    //                 });
    //                 pieAREA.unload({
    //                   done: function() {
    //                     pieAREA.load({ 
    //                       columns: [
    //                         array2,array4
    //                       ] 
    //                     });  
    //                   }
    //                 });
    //                 // document.getElementById('loader').hidden=true;


       
    //     },                    
    //     error: function(jqXHR, textStatus, errorThrown){

    //      swal('Information',textStatus+' Save : '+errorThrown,'warning');
    //     }
    //   });

    //    var year = $('#profityear').val();
    
    //  $.ajax({
    //                 url : "<?php echo base_url('Dash_tenant/barproperty');?>",
    //                 type:"POST",
    //                 data: {year:year,
    //                       project:project,
    //                       },
    //                 dataType:"json",
    //                 success:function(event, data){
              
    //                 var arrayipl = event.ipl.split(",");
    //                 var arrayrental = event.rental.split(",");
    //                 var arraymonth = event.category.split(",");
    //                 // console.log(arraymonth);
    //                 barprop.unload({
    //                   done: function() {
    //                     barprop.load({ 
    //                       columns: [
    //                         arraymonth,arrayrental,arrayipl
    //                       ]
    //                     });  
    //                   }
    //                 });
    //                 // document.getElementById('loader').hidden=true;
    //                 },                    
    //                 error: function(jqXHR, textStatus, errorThrown){
                    
    //                             swal({
    //                                   title: "Information",
    //                                   animation: false,
    //                                   type:"error",
    //                                   text: textStatus+' Save : '+errorThrown,
    //                                   confirmButtonText: "OK"
    //                                 });
    //                 }
    //                 });
    //  var year2= $('#profityear').val();
    // // document.getElementById('loader').hidden=false;
    //  $.ajax({
    //                 url : "<?php echo base_url('Dash_tenant/barproperty2');?>",
    //                 type:"POST",
    //                 data: {year:year2,
    //                       project:project,
    //                       },
    //                 dataType:"json",
    //                 success:function(event, data){
              
    //                 var arrayipl = event.ipl.split(",");
    //                 var arrayrental = event.rental.split(",");
    //                 var arraymonth = event.category.split(",");
    //                 // console.log(arraymonth);
    //                 bar2prop.unload({
    //                   done: function() {
    //                     bar2prop.load({ 
    //                       columns: [
    //                         arraymonth,arrayrental,arrayipl
    //                       ]
    //                     });  
    //                   }
    //                 });
    //                 // document.getElementById('loader').hidden=true;
    //                 },                    
    //                 error: function(jqXHR, textStatus, errorThrown){
                    
    //                             swal({
    //                                   title: "Information",
    //                                   animation: false,
    //                                   type:"error",
    //                                   text: textStatus+' Save : '+errorThrown,
    //                                   confirmButtonText: "OK"
    //                                 });
    //                 }
    //                 });
     // document.getElementById('loader').hidden=true;
          // var state = document.readyState

          // if (state == 'complete') {
          //   // alert('wk');
          //     setTimeout(function(){
          //         document.getElementById('interactive');
          //        document.getElementById('loader').hidden=true;
          //     },1000);

          // }
      }
 });
// console.log(pieAREA);

$('#level_no').on("change",function(e){
  // alert('a');
   var property_cd = $('#pl_property').val();
   var level_no = $('#level_no').val();
   var lot_no = $('#txtlotno').val();
   var project=$('#txt_Pl_Project').val();
   var Type = $("#pl_property option:selected").data("level");
   // var true_cl = hasClass(btnN,'btn-danger');   

  document.getElementById('loader').hidden=false;
// $('#table1').load( "<?php echo base_url('dash_tenant/goto_tableView');?> #table1",{"property_cd":property_cd,"level_no":level_no,"Type":Type,"project":project} );
 window.location.href = "<?php echo base_url('dash_tenant/index/');?>"+project.trim()+"/2/"+property_cd.trim()+"/"+level_no;
  var state = document.readyState
    if (state == 'complete') {
        setTimeout(function(){
            document.getElementById('interactive');
           document.getElementById('loader').hidden=true;
        },1000);
    }

});

$('#pl_property').on("change",function(e){

  
   var property_cd = $('#pl_property').val();
   var project=$('#txt_Pl_Project').val();
   var level_no = $('#level_no').val();
   var Type = $("#pl_property option:selected").data("level");
   if(Type=='A'){
      document.getElementById('label_level').innerHTML = 'Level';
      document.getElementById('TH1').innerHTML = 'Floor';
   }else{
      document.getElementById('label_level').innerHTML = 'Type';
      document.getElementById('TH1').innerHTML = 'Type';
   }

  document.getElementById('loader').hidden=false;


  

  

  var property_cd = $(this).find(':selected').val(); 
          if(property_cd!=='') {
            var site_url = '<?php echo base_url("dash_tenant/level")?>';
            $.post(site_url,
              {property_cd:property_cd,level_no:level_no,project:project},       

              function(data,status) {
                // console.log(data);
                $("#level_no").empty();
                $("#level_no").append('<option value="L" selected="1" >All Unit</option>');
                $("#level_no").append(data);
                $("#level_no").trigger('chosen:updated');
                
              }

            );
          }

          window.location.href = "<?php echo base_url('dash_tenant/index/');?>"+project.trim()+"/2/"+property_cd.trim()+"/L";
    // $('#table1').load( "<?php echo base_url('dash_tenant/goto_tableView');?> #table1",{"property_cd":property_cd,"level_no":level_no,"Type":Type,"project":project} );

    var state = document.readyState

    if (state == 'complete') {
        setTimeout(function(){
            document.getElementById('interactive');
           document.getElementById('loader').hidden=true;
        },1000);

    }
});

</script>