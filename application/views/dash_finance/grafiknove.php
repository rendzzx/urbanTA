 <script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
 <div id="loader" class="loader" hidden="true"></div>
<div class="row border-bottom white-bg dashboard-header">   
    <div class="form-group">
            <div class="tittle-top pull-right" style="font-size: 24px;text-align: right;padding-left: 50px;"><b>Management Dashboard Finance and Accounting</b></div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div> 
     <div class="form-group">
          <label for="pl_project" class="tittle-top pull-left" style="padding-left:0px;font-size: 15px;"> Choose Entity</label>
               &emsp; &emsp;
            <!--     <div class="col-sm-3"> -->
                    <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;">
                      <option value=""></option>    
                      <?php 
                            echo $data_project;
                      ?>   
                          
                  </select>
                  
              <!-- </div> -->
             
        </div>

   
 </div> 
 <style type="text/css">

     .c3-legend-item-IncomeBudget > .c3-legend-item-tile {
       stroke: #909293 !important;/*abu2*/

    }
    .c3-legend-item-IncomeAmount > .c3-legend-item-tile {
       stroke:  #1f77b4 !important;/*biru*/
    }
    .c3-legend-item-ExpanseAmount > .c3-legend-item-tile {
       stroke: #d62728 !important;/*merah*/
    }
    .c3-legend-item-ExpanseBudget > .c3-legend-item-tile {
       stroke: #909293 !important;/*abu2*/
    }
 </style>        

<div class="row"   id="chartt"> 
<br>
      <div class="col-sm-12">
        <div class="wrapper wrapper-content">

                <!--  ~~~~~~ trial GL ~~~~~~ -->
                <?php

                if(empty($js1))
                {
                    echo '';

                }
                else
                {
                    $ht='';
                    $ht.='<div class="col-lg-6">';
                    $ht.='<div class="ibox float-e-margins">';
                    $ht.='<div class="ibox-title">';
                    $ht.='<b>Trial Balance <br><br>Period</b> &emsp;';
                    $ht.='<select name="aperiod" id="aperiod" data-placeholder="Month" class="select2" style="width:100px;">';
                    $ht.='    <option value=""></option>';
                    $ht.='    <option value="ALL">ALL</option>';
                    $ht.='    <option value="01">1</option>';
                    $ht.='    <option value="02">2</option>';
                    $ht.='    <option value="03">3</option>';
                    $ht.='    <option value="04">4</option>';
                    $ht.='    <option value="05">5</option>';
                    $ht.='    <option value="06">6</option>';
                    $ht.='    <option value="07">7</option>';
                    $ht.='    <option value="08">8</option>';
                    $ht.='    <option value="09">9</option>';
                    $ht.='    <option value="10">10</option>';
                    $ht.='    <option value="11">11</option>';
                    $ht.='    <option value="12">12</option>';
                    $ht.='</select>  ';
                    $ht.='<select name="fyear" id="fyear" data-placeholder="Year" class="select2" style="width:140px;">';
                    $ht.='    <option value=""></option>';
                    $ht.=     $trialyear;
                    $ht.='</select>';
                    $ht.='</div>';
                    $ht.='<div class="ibox-content" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;">';
                    $ht.='<div>';
                    $ht.='<div id="pieBalanceGL" height="160" width="120" style="position: fixed;"></div>';


                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    $ht.='</div>';
                    echo $ht;
                }
                ?>
                <!--  ~~~~~~ end of trial GL ~~~~~~ -->
                <!--  ~~~~~~ profit loss ~~~~~~ -->
                <?php

                if(empty($js2))
                {
                    echo '';

                }
                else
                {
                    $h2='';
                    $h2.='<div class="col-lg-6">';
                    $h2.='<div class="ibox float-e-margins">';
                    $h2.='<div class="ibox-title">';
                    $h2.='<h5>Profit Loss </h5>';
       
                    $h2.='</div>';
                    $h2.='<div class="ibox-content" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;">';
                    $h2.='<div>';
                    $h2.='<div id="pieProfitLoss" height="160" width="120" style="position: fixed;"></div>';
                    $h2.='<div class="container" style="margin:0 auto;"></div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    echo $h2;
                }
                ?>   
                <!--  ~~~~~~ end of profit loss pie ~~~~~~ -->
                <!--  ~~~~~~ profit loss bar ~~~~~~ --> 
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
                    $h2.='<b>Profit Loss </b> &emsp;';
                    $h2.='<select name="profityear" id="profityear" data-placeholder="Year" class="select2" style="width:140px;">';
                    $h2.='    <option value=""></option>';
                    $h2.=     $profityear;
                    $h2.='</select>';
                    $h2.='</div>';
                    $h2.='<div class="ibox-content" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;">';
                    $h2.='<div>';
                    $h2.='<div id="barProfitLoss" height="160" width="120" style="position: fixed;"></div>';
                    $h2.='<div class="container" style="margin:0 auto;"></div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    $h2.='</div>';
                    echo $h2;
                }
                ?> 
                
                <!-- <start income vs expanse> -->
                 <?php

                if(empty($IncomeVSExpanse))
                {
                    echo '';

                }
                else
                {
                    $h2='';
                    $h2.='<div class="col-lg-12">';
                    $h2.='<div class="ibox float-e-margins">';
                    $h2.='<div class="ibox-title">';
                    // $h2.='<div  onclick="HideSearch()">';
                    $h2.='<b>Income VS Expense </b> &emsp;';
                    // $h2.='</div>';
                    $h2.='<div id="searchdiv" style="display:none"><br>';
                    $h2.='<div class="form-group">';
                    $h2.='<label for="pl_project" class="col-sm-2 control-label">Year</label>';
                    // $h2.='<div class="col-sm-10">';
                    $h2.='<select name="incomeYear" id="incomeYear" data-placeholder="Year" class="select2" style="width:140px;">';
                    $h2.='    <option value=""></option>';
                    $h2.=     $trialyear;
                    $h2.='</select>';
                    // $h2.='</div>';
                    $h2.='</div>';

                     $h2.='<div class="form-group">';
                    $h2.='<label for="pl_project" class="col-sm-2 control-label">Divisi</label>';
                    // $h2.='<div class="col-sm-10">';
                    $h2.='<select name="div_cd" id="div_cd" data-placeholder="Choose Div" class="select2" style="width:700px;" multiple="multiple">';
                    $h2.='    <option value=""></option>';
                    $h2.=     $divList;
                    $h2.='</select>';
                    // $h2.='</div>';
                    $h2.='</div>';

                     $h2.='<div class="form-group">';
                    $h2.='<label for="pl_project" class="col-sm-2 control-label">Dept</label>';
                    // $h2.='<div class="col-sm-10">';
                    $h2.='<select name="dept_cd" id="dept_cd" data-placeholder="Choose Dept" class="select2" style="width:700px;" multiple="multiple">';
                    $h2.='    <option value=""></option>';
                    $h2.=     $deptList;
                    $h2.='</select>';
                    $h2.='</div>';
                    $h2.='<button id="btn_search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>';
                    $h2.='</div>';
                    $h2.='<button id="showsearch" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>';
                    


                    // $h2.='</div>';
                    $h2.='</div>';

                    $h2.='<div class="ibox-content" style="padding-right: 8px;padding-left: 6px; padding-top:0px;padding-bottom:10px;text-align:center;">';
                    // $h2.='<div>';
                    $h2.='<div id="incomeVSexpanse" height="300" width="120" style="position: fixed;"></div>';//
                    $h2.='<div class="container" style="margin:0 auto;"></div>';
                    $h2.='<img src="'.base_url('img/label.png').'" style="margin: auto;">';
                    $h2.='</div>';
                    $h2.='</div>';
                    // $h2.='</div>';
                    $h2.='</div>';
                    echo $h2;
                }
                ?> 
                <!-- <start income vs expanse> -->
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
    .ui-datepicker-calendar {
    display: none;
    }
    .legend span {
      display: inline-block;
      margin-left: 7px;
      margin-right: 7px;
      padding: 5px;

    }
    #Profit{
        padding-left:150px;
    }

</style>

<script type="text/javascript">

var bar3;
var BarInVeX;
var pieBalanceGL;
 var YY = '<?php echo $fyear;?>';
 var mm = '<?php echo $period;?>';
 <?=$js1?>
<?=$js2?>
<?=$js3?>
<?=$IncomeVSExpanse?>
 // var aperiod = <?php echo $period;?>-1;
 $('#aperiod').val(mm);
 $('#txt_Pl_Project').select2();
$('#aperiod').select2();
$('#fyear').select2();
$('#profityear').select2();
$('#div_cd').select2();
 $('#dept_cd').select2();
$('#incomeYear').select2();

$('#aperiod').on("select2:selecting", function(e) { 
    var entity = $('#txt_Pl_Project').val();
    var month = e.params.args.data["id"];
    var fyear = $('#fyear').val();
    var aperiod = month+'-'+fyear;
    document.getElementById('loader').hidden=false;
    $.ajax({  
      url : "<?php echo base_url('Dash_finance/filter_Gl_balance');?>",
      type:"POST",
      // dataType: "text",
      async: true,
      data: {entity:entity,
        Year:fyear,
        Aperiod:month},
        dataType:"json",
        success:function(data){
// console.log(data);
            var array1 = data.data.split("-");
                    var tes =[];
                    array1.forEach(function(entry) {
                        // console.log(entry);
                        entry = entry.substring(1);
                        var cc = entry.split(",");
                         pieBalanceGL.load({ 
                          columns: [
                            cc
                          ] 
                        });  
                    });
                    document.getElementById('loader').hidden=true;
        },                    
        error: function(jqXHR, textStatus, errorThrown){
          // console.log('a')
         swal('Information',textStatus+' Save : '+errorThrown,'warning');
        }
      });
 
    // window.location.href="<?php echo base_url('Dash_finance/index')?>/"+entity+"/"+aperiod;
   
});
$('#fyear').on("select2:selecting", function(e) { 
    var entity = $('#txt_Pl_Project').val();
    var fyear = e.params.args.data["id"];
    var  month= $('#aperiod').val();
    var aperiod = month+'-'+fyear;
    document.getElementById('loader').hidden=false;
    // window.location.href="<?php echo base_url('Dash_finance/index')?>/"+entity+"/"+aperiod;
    $.ajax({  
      url : "<?php echo base_url('Dash_finance/filter_Gl_balance');?>",
      type:"POST",
      // dataType: "text",
      async: true,
      data: {entity:entity,
        Year:fyear,
        Aperiod:month},
        dataType:"json",
        success:function(data){
// console.log(data);
            var array1 = data.data.split("-");
                    var tes =[];
                    array1.forEach(function(entry) {
                        // console.log(entry);
                        entry = entry.substring(1);
                        var cc = entry.split(",");
                         pieBalanceGL.load({ 
                          columns: [
                            cc
                          ] 
                        });  
                    });
                    document.getElementById('loader').hidden=true;
        },                    
        error: function(jqXHR, textStatus, errorThrown){
          // console.log('a')
         swal('Information',textStatus+' Save : '+errorThrown,'warning');
        }
      }); 
   
});
$('#profityear').on("select2:selecting", function(e) { 
    var entity = $('#txt_Pl_Project').val();
    var fyear = e.params.args.data["id"];
    document.getElementById('loader').hidden=false;
     $.ajax({
                    url : "<?php echo base_url('Dash_finance/bar3');?>",
                    type:"POST",
                    data: {fyear:fyear,
                          entity:entity,
                          },
                    dataType:"json",
                    success:function(event, data){
                    // console.log(event);
                    var arraycolumn = event.data3.split(",");
                    console.log(arraycolumn);
                    bar3.unload({
                      done: function() {
                        bar3.load({ 
                          columns: [
                            arraycolumn
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



// //buat garis xnya yg bar ada ditengah
// d3.select(chart.element).select('.' + c3.chart.internal.fn.CLASS.axisX).transition()
//     .attr('transform', "translate(" + 0 + "," + chart.internal.y(0) + ")");
// //customized label profit loss
// d3.select('.container').insert('div', '.chart').attr('class', 'legend').selectAll('div')
//   .data(['Profit', 'Loss'])
//   .enter().append('span')
//   .attr('id', function(id) {
//     return id;
//   })
//   .html(function(id) {
//     if(id=='Profit') {
//         return '<span style="background-color:#2ca02c;"></span>'+id;
//     }else{
//         return '<span style="background-color:#d62728"></span>'+id;
//     }
//   })
//   .on('mouseover', function(id) {

//   })
//   .on('mouseout', function(id) {
  
//   })
//   .on('click', function(id) {

//   });
$('#showsearch').click(function(){
     $('#searchdiv').toggle('show');
     $('#showsearch').hide();
});

$('#btn_search').click(function(){
  document.getElementById('loader').hidden=false;
   var yearIncome = $('#incomeYear').val();
   var divisi = $('#div_cd').val();
   var dept = $('#dept_cd').val();
    var entity = $('#txt_Pl_Project').val();
     $.ajax({  
      url : "<?php echo base_url('Dash_finance/filter_IncomeVsexpanse');?>",
      type:"POST",
      // dataType: "text",
      async: true,
      data: {entity:entity,
        incomeYear:yearIncome,
        div_cd:divisi,
        dept_cd:dept},
        dataType:"json",
        success:function(data){
            var x = data.x.split(",");
            var array1 = data.IncomeAmount.split(",");
            var array2 = data.IncomeBudget.split(",");
            var array3 = data.ExpanseAmount.split(",");
            var array4 = data.ExpanseBudget.split(",");
                    // console.log(array1);
                    BarInVeX.unload({
                      done: function() {
                        BarInVeX.load({ 
                          columns: [
                            x,array2,array1,array4,array3
                          ],
                            color: function (color, d) {
                                // console.
                                //IF SUM INC ACTUAL > SUM INC BUDGET
                                if(d.id == "IncomeAmount"){  
                                if(dtcolumns[2][d.index + 1] > dtcolumns[1][d.index + 1] )
                                { INCOME_A_color = "#1f77b4"; } else { INCOME_A_color = "#d62728"; }} 
                                  //END OF IF SUM INC ACTUAL > SUM INC BUDGET
                                  //IF SUM EXP ACTUAL > SUM EXP BUDGET
                                  
                                  // console.log(EXP_A.reduce((a, b) => a + b, 0)+"  -- "+EXP_B.reduce((a, b) => a + b, 0));';//sum expanse budget
                                if(d.id == "ExpanseAmount"){  
                                if(dtcolumns[4][d.index + 1] > dtcolumns[3][d.index + 1]  )
                                { EXP_A_color = "#1f77b4"; } else { EXP_A_color = "#d62728"; }}
                                  //END OF IF SUM EXP ACTUAL > SUM EXP BUDGET
                                  // DEFINE COLOR
                               if(d.id=="IncomeAmount")
                                { return INCOME_A_color; }
                                else if(d.id=="ExpanseAmount") { return EXP_A_color; } else { return "#909293"}
                               }
                        });  
                      }
                    });
                    console.log(BarInVeX.internal);
                    document.getElementById('loader').hidden=true;
                    // BarInVeX.groups([ 
                    //     ['IncomeAmount', 'IncomeBudget'],['ExpanseAmount', 'ExpanseBudget']
                    // ]);


       
        },                    
        error: function(jqXHR, textStatus, errorThrown){
          // console.log('a')
         swal('Information',textStatus+' Save : '+errorThrown,'warning');
        }
      });
    
});


var url = '';
   
    
$('#txt_Pl_Project').on("change",function(e){
    // alert('a'); 
    // alert('fot');
    var entity = $(this).find(':selected').val();
    // var aperiod = $("$start").val();
      
      if(entity == ''){
        swal('Information','Please Choose Project ','warning');
        return;
      }else{
        // document.getElementById('loader').hidden=false;
        
      if(entity==''){
        report.style.visibility="hidden";
    } else {
        window.location.href="<?php echo base_url('Dash_finance/index')?>/"+entity;
        report.style.visibility="visible";
    }
        // document.getElementById('loader').hidden=true;
        
      }
 });

function HideSearch(){
    alert('asdf');
}
</script>
