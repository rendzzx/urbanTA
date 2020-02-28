<style type="text/css">
 #load{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
    ul#stepForm, ul#stepForm li {
    margin: 0;
    padding: 0;
  }
  ul#stepForm li {
    list-style: none outside none;
  } 
  label{margin-top: 10px;}
  .help-inline-error{color:red;}
</style>
<link href="<?=base_url('css/plugins/blueimp/css/blueimp-gallery.min.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/blueimp/jquery.blueimp-gallery.min.js')?>"></script>
<!-- <link href="<?=base_url('css/plugins/steps/jquery.steps.css')?>" rel="stylesheet">
<script src="<?=base_url('js/plugins/steps/jquery.steps.min.js')?>" type="text/javascript"></script> -->

<!-- <link rel="stylesheet" href="js/plugins/jvectormap/jquery-jvectormap-1.2.2.css"> -->

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">
        <div class="form-group">
            <div class="tittle-top pull-left"><b><?php echo $projectName; ?></b></div>
            <div class="tittle-top pull-right">
                <b>
                <?php if($TypeRoi=='P'){echo 'ROI Prioritas';}else{echo 'ROI Regular';} ?>
                    <!-- ROI -->
                </b>
            </div>            
        </div>
    </div><br>
    <div class="row border-bottom white-bg dashboard-header" style="background: rgba(145,16,16,1);

background: -moz-linear-gradient(top, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(145,16,16,1)), color-stop(0%, rgba(145,16,16,1)), color-stop(27%, rgba(247,8,8,1)), color-stop(70%, rgba(247,8,8,1)), color-stop(100%, rgba(145,16,16,1)));
background: -webkit-linear-gradient(top, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);
background: -o-linear-gradient(top, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);
background: -ms-linear-gradient(top, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);
background: linear-gradient(to bottom, rgba(145,16,16,1) 0%, rgba(145,16,16,1) 0%, rgba(247,8,8,1) 27%, rgba(247,8,8,1) 70%, rgba(145,16,16,1) 100%);

filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#911010', endColorstr='#911010', GradientType=1 );
 color: white;  box-shadow: 0 5px 10px 0 rgba(0, 0, 0,0.30), 0 15px 5px 0 rgba(0, 0, 0, 0.15);">
    <label class="control-label" style="font-size:15px;">Filter</label>
        <div class="form-group">    
        <div class="col-sm-12">
                <label for="pl_project" class="col-sm-2 control-label" style="font-size:15px;">Block :</label>
                <div class="col-sm-10">
                   <select name="txtBlock" id="txtBlock" data-placeholder="Select Block..." class="select2 form-control" tabindex="2">
                        <option value=""></option> 
                        <!-- <?php echo $TypeList;?> -->
                    </select> 
                </div>
                <!-- <span id="time"></span> -->
            </div>        
            <div class="col-sm-12">
                <label for="pl_project" class="col-sm-2 control-label" style="font-size:15px;">Facing :</label>
                <div class="col-sm-10">
                    <select name="txtDirection" id="txtDirection" data-placeholder="Select Facing..." class="select2 form-control" tabindex="2">
                        <option value=""></option> 
                        <!-- <?php echo $DirectionList;?> -->
                    </select> 
                </div>
                <!-- <span id="time"></span> -->
            </div>
            <div class="col-sm-12">
                <label for="pl_project" class="col-sm-2 control-label" style="font-size:15px;">Type :</label>
                <div class="col-sm-10">
                   <select name="txtType" id="txtType" data-placeholder="Select Type..." class="select2 form-control" tabindex="2">
                        <option value=""></option> 
                        <!-- <?php echo $TypeList;?> -->
                    </select> 
                </div>
                <!-- <span id="time"></span> -->
            </div>
            <div class="col-sm-12">
                <label for="pl_project" class="col-sm-2 control-label" style="font-size:15px;">Price :</label>
                <div class="col-sm-10">
                    <select name="txtPrice" id="txtPrice" data-placeholder="Select Price..." class="select2 form-control" tabindex="2">
                        <option value=""></option>                        
                    </select>
                </div>
                <!-- <span id="time"></span> -->
            </div>
            <div class="col-sm-12">
                <div class="col-sm-10">
        <input type="hidden" name="cl_colour" id="cl_colour" width="100%" value='<?php echo $ms_colour;?>' class="form-control" >
                </div>
                <!-- <span id="time"></span> -->
            </div>
             <div class="col-sm-12">
                <!-- <input type="button" align="rigth" name="btnS" id="btnNext" value="Process" class="btn btn-success btn-sm"> -->
                <a class="btn blue-bg pull-right" onclick="fn_search();" style=" width: auto">Search <i class="fa fa-search"></i></a>
                <a class="btn blue-bg pull-right" onclick="fn_Clearsearch();" style=" width: auto">Clear Filter</a>
            </div>
        </div>
    </div><br>
    <div class="row border-bottom white-bg dashboard-header">
        <div class="form-group">
            <div class="col-sm-12">
                <div class="col-sm-2">
                    <label class="control-label">Legend</label>
                </div>
                <div class="col-sm-2"><img style="width:100%;" id="ap" src="<?php echo base_url('img/ap.png');?>"></div>
                <div class="col-sm-2"><img style="width:100%;" id="anp" src="<?php echo base_url('img/anp.png');?>"></div>
                <div class="col-sm-2"><img style="width:100%;" id="fb" src="<?php echo base_url('img/green.png');?>"></div>
                <div class="col-sm-2"><img style="width:100%;" id="fb" src="<?php echo base_url('img/fb.png');?>"></div>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="">
                        <!-- <br> -->
                        <div class="content">
                            <!-- <div class="panel panel-primary"> -->
                                <!-- <div class="panel-heading">
                                    <h3 class="panel-title">Choose Unit Landed Detail</h3>
                                </div> -->
                                <div class="panel-body row">
                                    <form name="basicform" id="basicform" class="form-horizontal" method="post" action="#">
                                        <!-- <div class="row"> -->
                                        <div class="box-body">
                                           <div class="col-sm-12"  style="">
                                                <label for="pl_Unit" class="col-sm-2 control-label" style="font-size:18px;">Cluster :</label>
                                                <label for="pl_project_name" class=" control-label" style="font-size:18px;"><?php echo $Cluster_descs;?> </label>
                                                <!-- <div class="col-sm-8"> -->
                                                    <!--<input type="text" name="txtCluster" id="txtCluster" width="100%" class="form-control" value="tesdfsdfa" style="border:none;" readonly="readonly">-->
                                                    
                                                <!-- </div> -->
                                            </div>
                                            <div class="col-sm-12"  style="">
                                                <label for="pl_Unit" class="col-sm-2 control-label" style="font-size:18px;">Unit :</label>
                                                <div class="col-sm-8">
                                                    <input type="hidden" name="lot_no2" id="lot_no2" width="100%" class="form-control" style="border:none; background-color:white; color:#ec0303;" readonly="readonly">
                                                    <input type="hidden" class="form-control" name="lot_nox" id="lot_nox" style="border:none; background-color:white;width:80%;" readonly="readonly" >
                                                    <!-- <input type="text" name="lot_descs" id="lot_descs" width="100%" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: 18px;" readonly="readonly"> -->
                                                    <textarea name="lot_descs" id="lot_descs" class="form-control" style="border:none; background-color:white; color:#ec0303; font-size: 18px;width:100%;" readonly="readonly" rows="2"></textarea>
                                                    <input type="hidden" name="cl_colour" id="cl_colour" width="100%" value='<?php echo $ms_colour;?>' class="form-control" >
                                                </div>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="pl_unit" class="col-sm-3 control-label">Unit :</label>
                                                <div></div>
                                            </div> -->

                                            <!-- <br> -->
                                            <!-- <div class="form-group"> -->
                                            <div class=" pull-right" >
                                                <!-- <input type="button" name="btnClear" id="btnClear" value="Clear" onclick="Clear();" class="btn btn-danger btn-sm"> -->
                                                <input type="button" name="btnBack" id="btnBack" value="Back" class="btn abu-bg btn-sm">
                                                <input type="button" name="btnNext" id="btnNext" value="Process" class="btn btn-success btn-sm">
                                                                                               
                                                
                                            </div>

                                            <!-- </div> -->
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <table id="table1" class="table table-striped table-bordered table-hover dataTables">
                                                    <thead>
                                                        <tr>
                                                            <th class="col-xs-1">Block</th>
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

                                    </form>

                                </div>
                                <div id="blueimp-gallery" class="blueimp-gallery">
                                <div class="slides"></div>
                                <h3 class="title"></h3>
                                <a class="prev">‹</a>
                                <a class="next">›</a>
                                <a class="close">×</a>
                                <a class="play-pause"></a>
                                <ol class="indicator"></ol>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div id="headermodal" class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                        
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
var buttn;
var TypeRoi ='<?php echo $TypeRoi;?>';
var tstatus;
    var txt = [];
    var txt_descs = [];
    var tstatus ='';
    var dataWarna = new Array();
dataWarna = JSON.parse($('#cl_colour').val());
console.log(dataWarna);
$('#txtType').select2();
$('#txtDirection').select2();
$('#txtPrice').select2();
$('#txtBlock').select2();
LoadData();
var unit_book = '<?php echo $unit_book;?>';
var unit_temp = '<?php echo $unit_temp;?>';
var lot_descs = '<?php echo $lot_descs;?>';

 if(unit_temp!='null'){
    
        txt = unit_book.split(",");
        $('#lot_no2').val(unit_temp);
        $('#lot_descs').val(lot_descs);
    }else{
        
        if (unit_book!='null') {
            
        txt = unit_book.split(",");
        $('#lot_no2').val(unit_book);
        }
    }
   
$(document).ready(function(e) {
    $('#btnBack').click(function() {
            // window.history.back();
           // if(TypeRoi=='P'){
           //  window.location.href = "<?php echo base_url('c_mobile_cfld/indexPrior')?>";
           // }else{
            window.location.href = "<?php echo base_url('c_mobile_cfld/indexEdit')?>";
           // }
            
        });
         $('#btnNext').click(function() {            
            // window.history.back();
            var myBookId = $('#lot_no2').val();
            var Cluster_cd = '<?php echo $Cluster_cd?>';
            var headerid = '<?php echo $headerid ?>';
            var TypeScreen = '<?php echo $TypeScreen ?>';
            var lot_descs = $('#lot_descs').val();
            // alert(lot_descs);
            // return;
                        
            if (myBookId == "") {

                swal('Warning', 'Please Click Unit!',"warning");
                return;
            }
            var site_url = "<?php echo base_url('c_mobile_cfld/set_session')?>";
            $.ajax({
                url: site_url,
                type: "POST",
                data: {
                    unit_loop: myBookId,
                    Cluster_cd: Cluster_cd,
                    headerid:headerid,
                    lot_descs: lot_descs
                },
                dataType: "json",
                success: function(data, status) {
                    // alert(headerid);
                    // return;
                    if(headerid){
                        var HI = parseInt(headerid)-1000000;
                        var urll="<?php echo base_url('c_nup_cfld/edit_rev/N')?>"+'/'+headerid+'/'+HI+'/'+TypeScreen+'/M';
                        // alert(urll);
                        window.location.href = urll;
                    } else {
                                               
                         window.location.href = "<?php echo base_url('c_nup_cfld/insert_mobile/N')?>/"+TypeRoi; //+'/'+property_cd+'/'+myBookId;
                        
                    }
                    

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal(textStatus + ' Save : ' + errorThrown);
                }
            })
            
        });
});
function fn_Clearsearch(){
    var Cluster_cd = '<?php echo $Cluster_cd;?>';
    // var TypeRoi = '<?php echo $TypeRoi;?>';
    
    var bb = '<?php echo base_url("c_mobile_cfld/ClusterLanded");?>'+"/"+Cluster_cd+"/"+TypeRoi;
    window.location.href = bb;
}
function fn_search(){
    var Cluster_cd = '<?php echo $Cluster_cd;?>';
    // var TypeRoi = '<?php echo $TypeRoi;?>';
    
    var lot_descs = $('#lot_descs').val();
    // alert(lot_descs);
    // return;
    
    var bb = '<?php echo base_url("c_mobile_cfld/ClusterLanded");?>'+"/"+Cluster_cd+"/"+TypeRoi+"/";
    var Block =$('#txtBlock').val(); 
    var Type = $('#txtType').val();
    var Direction = $('#txtDirection').val();
    var Price = $('#txtPrice').val();
   
    var where="";
    //unit/block/type/direction/price
    if(Block !=""){
        where ="null/"+ Block;
    }
    if(Type != ""){
        // where = "AND type='"+Type+"'";
        // where = "null/"+Type;
        if(where !=""){
            where = where+"/"+Type;
        }else{
            where = "null/null/"+Type;
        }
    }else{
        if(Direction !="" && Block!=""){
            where = where + "/null/"
        }
        
    }
    if(Direction!=""){
        if(where !=""){
            where = where+"/"+Direction;
        }else{
            where = "null/null/null/"+Direction;
        }
        
    }else{
        if(Type !="" && Price!=""){
            where = where + "/null/"
        }
        
    }

    if(Price !=""){
        if(where !=""){
            where = where+"/"+Price;
        }else{
            where = "null/null/null/null/"+Price;
        }
    }
    //unit/block/type/direction/price
    // console.log(bb+where);
    // alert(bb+where);
    $('#lot_descs').val(lot_descs);
    window.location.href = bb+where;
}
function landinfo(Id,nup_counter,btn,lot_descs){ 
    // alert(nup_counter);return
    console.log(Id);
    // alert('id '+Id);
    buttn = btn;
    
    // return;
    var Type = "A"+nup_counter;
    var fn = '';
    var lot_no = $('#lot_no2').val();
    var lot_nox = $('#lot_nox').val();
    var lot_descs = $('#lot_descs').val();

    var arr_lot = lot_no.split(",");
    // console.log(arr_lot);
    var arr_lotx = lot_nox.split(",");
    var arr_descs = lot_descs.split(",");

    var new_lot = ""; var new_lotx = ""; var new_descs = "";
    
    var ss = arr_lot.indexOf(Id);
    // alert(ss);

    if(ss < 0){   
      fn = 'A';
    }else{
      fn = 'B';             
    }
  console.log(fn); 

if(fn=='A'){
    if(TypeRoi=='P'){
        for (i = 0; i < arr_lot.length; i++) {
                    if (arr_lot[i] != Id && new_lot == ""){
                      new_lot = arr_lot[i];
                    } else if (arr_lot[i] != Id && new_lot != ""){
                      new_lot = new_lot + ',' + arr_lot[i];
                    } 
                  }
       
              for (i = 0; i <= arr_lotx.length; i++) {
                if (i == 0){
                  new_lotx = arr_lotx[i];
                } else if (i == arr_lotx.length && lot_nox != "") {
                  new_lotx = new_lotx + ',' + Id;
                } else if (i == arr_lotx.length && lot_nox == "") {
                  new_lotx = Id;
                } else {
                  new_lotx = new_lotx + ',' + arr_lotx[i];
                } 
              }

                

          var ind = arr_lot.indexOf(Id);
          if (ind > -1) {
            arr_lot.splice(ind, 1);
            arr_descs.splice(ind, 1);
          }
          // alert(arr_descs);
          console.log(fn); 
          if(fn=='A'){

                  showModal(Id,nup_counter); 
                  // document.getElementById('loader').hidden=true;             

                  
          }
    }else{
         // if(nup_counter < 3){             
                  for (i = 0; i < arr_lot.length; i++) {
                    if (arr_lot[i] != Id && new_lot == ""){
                      new_lot = arr_lot[i];
                    } else if (arr_lot[i] != Id && new_lot != ""){
                      new_lot = new_lot + ',' + arr_lot[i];
                    } 
                  }
       
              for (i = 0; i <= arr_lotx.length; i++) {
                if (i == 0){
                  new_lotx = arr_lotx[i];
                } else if (i == arr_lotx.length && lot_nox != "") {
                  new_lotx = new_lotx + ',' + Id;
                } else if (i == arr_lotx.length && lot_nox == "") {
                  new_lotx = Id;
                } else {
                  new_lotx = new_lotx + ',' + arr_lotx[i];
                } 
              }

                

          var ind = arr_lot.indexOf(Id);
          if (ind > -1) {
            arr_lot.splice(ind, 1);
          }
          console.log(fn); 
          if(fn=='A'){

                  showModal(Id,nup_counter); 
                  // document.getElementById('loader').hidden=true;             

                  
          }


        // }else{
            
        // //   $('#usa_image').mapster('highlight', false, ID);
        // }
    }
           
    
    }else{
          for (i = 0; i < arr_lot.length; i++) {
            if (arr_lot[i] != Id && new_lot == ""){
              new_lot = arr_lot[i];
            } else if (arr_lot[i] != Id && new_lot != ""){
              new_lot = new_lot + ',' + arr_lot[i];
            } 
          }

          var ind = arr_lot.indexOf(Id);
            if (ind > -1) {
                arr_descs.splice(ind, 1);
            }

          console.log(new_lot);
          for (i = 0; i <= arr_lotx.length; i++) {
            if (i == 0){
              new_lotx = arr_lotx[i];
            } else if (i == arr_lotx.length && lot_nox != "") {
              new_lotx = new_lotx + ',' + Id;
            } else if (i == arr_lotx.length && lot_nox == "") {
              new_lotx = Id;
            } else {
              new_lotx = new_lotx + ',' + arr_lotx[i];
            } 
          }

          // console.log(new_lotx);

          // balance = parseInt(balance) + 1;
          //   $('#b_val').val(balance);
        //   if(nup_counter>=3){
        //     var site_url = '<?php echo base_url("c_mobile_cfld/update_status_min_counter")?>';
        // }else{
            var site_url = '<?php echo base_url("c_mobile_cfld/update_status")?>';
        // }
          
          
    $.post(site_url,
        {id:Id,status:"A",lot_descs:lot_descs},
        function(data,status) {
            
            tstatus = 'A';
            buttn.style.background = dataWarna[Type]["fillColor"];
            // console.log(dataWarna[Type]["fillColor"]);
            $('#lot_no2').val(new_lot);
            $('#lot_nox').val(new_lotx);
            $('#lot_descs').val(arr_descs);
            // if(nup_counter>=3){
            //    location.reload(); 
            // }
            
                // document.getElementById('loader').hidden=true;
         }
    );
            
         
            // myVar =  setInterval(function(){ myTimer(Id,Type) }, 1000);
            // document.getElementById('loader').hidden=true; 
    }
}

function showModal(data,nup_counter)
  {
    // document.getElementById('loader').hidden=true;
    // return;
    var TypeScreen = '<?php echo $TypeScreen ?>';
    document.getElementById('loader').hidden=true;
    var chosen_unit = $('#lot_no2').val();
    var lot_descs = $('#lot_descs').val();
        var Cluster_cd = '<?php echo $Cluster_cd?>';
         var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }
                        
                        $('#modalTitle').html('Detail Information');
                        $('div.modal-body').load("<?php echo base_url("c_mobile_cfld/showlandEdit");?>"+"/"+data);


                        $('#modal').data('Cluster_cd',Cluster_cd);
                        
                        var Cluster_cd = '<?php echo $Cluster_cd?>';
                        var headerid = '<?php echo $headerid ?>';
                        
                        $('#modal').data('TypeScreen',TypeScreen);
                        $('#modal').data('chosen',chosen_unit);
                        $('#modal').data('clustercd',Cluster_cd);
                        $('#modal').data('Id',data);
                        $('#modal').data('headerid',headerid);
                        $('#modal').data('TypeRoi',TypeRoi);
                        $('#modal').data('nup_counter',nup_counter);
                        $('#modal').data('lot_descs',lot_descs);
                        $('#modal').modal('show');

  }

      
function LoadData(){
    var type = '<?php echo $type;?>';
    var Cluster_cd = '<?php echo $Cluster_cd?>';
    var Direction = '<?php echo $direction;?>';
    var Price = '<?php echo $Price;?>';
    var Block = '<?php echo $Block;?>';
    var site_url = '<?php echo base_url("c_mobile_cfld/zoom_type")?>';
            $.post(site_url,
                {type:type},
                function(data,status) {
                    $("#txtType").empty();
                    $("#txtType").append(data);
                    $("#txtType").trigger('change');
                }
                );
    var site_url = '<?php echo base_url("c_nup_landed_cfld_dt/zoom_direction")?>';
            $.post(site_url,
                {Direction:Direction},
                function(data,status) {
                    $("#txtDirection").empty();
                    $("#txtDirection").append(data);
                    $("#txtDirection").trigger('change');
                }
                );
    var site_url = '<?php echo base_url("c_mobile_cfld/Price")?>';
            $.post(site_url,
                {Price:Price},
                function(data,status) {
                    $("#txtPrice").empty();
                    $("#txtPrice").append(data);
                    $("#txtPrice").trigger('change');
                }
                );
   var site_url = '<?php echo base_url("c_mobile_cfld/zoom_block")?>';
            $.post(site_url,
                {Block:Block,Cluster_cd:Cluster_cd},
                function(data,status) {
                    $("#txtBlock").empty();
                    $("#txtBlock").append(data);
                    $("#txtBlock").trigger('change');
                }
                );
}
</script>

