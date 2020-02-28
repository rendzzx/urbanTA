<style type="text/css">
  .has-error .select2_demo_1-selected {
      border: 1px solid #a94442;
      border-radius: 4px;
      color: red;
    }

    .has-error .checkbox-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }

    .has-error .radio-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
    label {text-align: right;}
</style>
 <style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
/*div.dataTables_wrapper 
div.dataTables_filter {
    text-align: right;
    float: right;
    padding-bottom: 5px;
}*/
</style>

<script type="text/javascript">
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" });
  $("#frmEditor").validate({
            rules: {
                txtTitle: {
                    required: true
                },
                txtIconClass:{
                  required:true
                },
                txtOrderSeq:{
                  required:true,
                  number:true
                }
            },
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
          $(element).addClass(errorClass); //.removeClass(errorClass);
          $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass(errorClass); //.addClass(validClass);
          $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          } else if (element.hasClass('select2_demo_1') || element.hasClass('checkbox-inline') || element.hasClass('radio-inline')){
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
        });
</script>
<div id="loader" class="loader" hidden="true"></div>
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="project_name" class="col-sm-2">Menu Id</label>
                <div class="col-sm-8">
                    <select name="txtMenuID" id="txtMenuID" data-placeholder="Choose a Menu Id..." class="select2_demo_1 form-control" >
                        <option value=""></option> 
                            <?php 
                                foreach ($menuData as $row) 
                                          {
                                              echo '<option value="'.$row->MenuID.'">'.$row->Title.'</option>';
                                          }
                            ?>            
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="project_name" class="col-sm-2">Picure</label>
                <div class="col-sm-8">
                <!-- <input type="radio"><img src="<?php echo base_url('/img/dash/default.png') ?> "></input> -->
            <!-- <select name="pict" id="pict" class="form-control"> -->
              <input type="radio" name="pict" id="pict" value="default.png"><img src="<?php echo base_url('/img/dash/default.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="announcement.png"><img src="<?php echo base_url('/img/dash/announcement.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="approve.png"><img src="<?php echo base_url('/img/dash/approve.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="archive.png"><img src="<?php echo base_url('/img/dash/archive.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="assignMenu.png"><img src="<?php echo base_url('/img/dash/assignMenu.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="auction.png"><img src="<?php echo base_url('/img/dash/auction.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="bank.png"><img src="<?php echo base_url('/img/dash/bank.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="bar-chart.png"><img src="<?php echo base_url('/img/dash/bar-chart.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="booking.png"><img src="<?php echo base_url('/img/dash/booking.png') ?> "></input>
              <!-- <input type="radio" name="pict" id="pict" value=".png"><img src="<?php echo base_url('/img/dash/brochure.svg') ?> "></input> -->
              <input type="radio" name="pict" id="pict" value="businessman.png"><img src="<?php echo base_url('/img/dash/businessman.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="businesswoman.png"><img src="<?php echo base_url('/img/dash/businesswoman.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="calculator.png"><img src="<?php echo base_url('/img/dash/calculator.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="calculator1.png"><img src="<?php echo base_url('/img/dash/calculator1.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="calculator2.png"><img src="<?php echo base_url('/img/dash/calculator2.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="calendar.png"><img src="<?php echo base_url('/img/dash/calendar.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="cash.png"><img src="<?php echo base_url('/img/dash/cash.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="chair.png"><img src="<?php echo base_url('/img/dash/chair.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="checked.png"><img src="<?php echo base_url('/img/dash/checked.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="checklist.png"><img src="<?php echo base_url('/img/dash/checklist.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="cityscape.png"><img src="<?php echo base_url('/img/dash/cityscape.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="cloud-computing.png"><img src="<?php echo base_url('/img/dash/cloud-computing.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="conversation.png"><img src="<?php echo base_url('/img/dash/conversation.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="credit-card.png"><img src="<?php echo base_url('/img/dash/credit-card.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="dashboard.png"><img src="<?php echo base_url('/img/dash/dashboard.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="download.png"><img src="<?php echo base_url('/img/dash/download.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="earth-globe.png"><img src="<?php echo base_url('/img/dash/earth-globe.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="folder.png"><img src="<?php echo base_url('/img/dash/folder.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="goal.png"><img src="<?php echo base_url('/img/dash/goal.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="gold.png"><img src="<?php echo base_url('/img/dash/gold.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="group 2.png"><img src="<?php echo base_url('/img/dash/group 2.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="group.png"><img src="<?php echo base_url('/img/dash/group.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="growth.png"><img src="<?php echo base_url('/img/dash/growth.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="hierarchy.png"><img src="<?php echo base_url('/img/dash/hierarchy.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="home.png"><img src="<?php echo base_url('/img/dash/home.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="hourglass.png"><img src="<?php echo base_url('/img/dash/hourglass.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="house.png"><img src="<?php echo base_url('/img/dash/house.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="id-card.png"><img src="<?php echo base_url('/img/dash/id-card.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="idea.png"><img src="<?php echo base_url('/img/dash/idea.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="image.png"><img src="<?php echo base_url('/img/dash/image.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="key.png"><img src="<?php echo base_url('/img/dash/key.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="komisi.png"><img src="<?php echo base_url('/img/dash/komisi.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="komisi2.png"><img src="<?php echo base_url('/img/dash/komisi2.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="layers.png"><img src="<?php echo base_url('/img/dash/layers.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="like.png"><img src="<?php echo base_url('/img/dash/like.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="list.png"><img src="<?php echo base_url('/img/dash/list.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="loss.png"><img src="<?php echo base_url('/img/dash/loss.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="msg.png"><img src="<?php echo base_url('/img/dash/msg.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="news.png"><img src="<?php echo base_url('/img/dash/news.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="package.png"><img src="<?php echo base_url('/img/dash/package.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="Padlock.png"><img src="<?php echo base_url('/img/dash/Padlock.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="payment.png"><img src="<?php echo base_url('/img/dash/payment.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="pen.png"><img src="<?php echo base_url('/img/dash/pen.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="percentage.png"><img src="<?php echo base_url('/img/dash/percentage.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="piggy-bank.png"><img src="<?php echo base_url('/img/dash/piggy-bank.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="profits.png"><img src="<?php echo base_url('/img/dash/profits.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="projectinfo.png"><img src="<?php echo base_url('/img/dash/projectinfo.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="promo.png"><img src="<?php echo base_url('/img/dash/promo.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="push-pin.png"><img src="<?php echo base_url('/img/dash/push-pin.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="reserved.png"><img src="<?php echo base_url('/img/dash/reserved.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="rgb.png"><img src="<?php echo base_url('/img/dash/rgb.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="safebox.png"><img src="<?php echo base_url('/img/dash/safebox.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="scales.png"><img src="<?php echo base_url('/img/dash/scales.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="search 2.png"><img src="<?php echo base_url('/img/dash/search 2.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="settings.png"><img src="<?php echo base_url('/img/dash/settings.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="shopping-cart.png"><img src="<?php echo base_url('/img/dash/shopping-cart.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="smartphone.png"><img src="<?php echo base_url('/img/dash/smartphone.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="stopwatch.png"><img src="<?php echo base_url('/img/dash/stopwatch.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="suitcase.png"><img src="<?php echo base_url('/img/dash/suitcase.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="tablet.png"><img src="<?php echo base_url('/img/dash/tablet.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="tape.png"><img src="<?php echo base_url('/img/dash/tape.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="teamwork.png"><img src="<?php echo base_url('/img/dash/teamwork.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="text-lines.png"><img src="<?php echo base_url('/img/dash/text-lines.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="trash.png"><img src="<?php echo base_url('/img/dash/trash.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="trophy.png"><img src="<?php echo base_url('/img/dash/trophy.png') ?> "></input>
              <input type="radio" name="pict" id="pict" value="umbrella.png"><img src="<?php echo base_url('/img/dash/umbrella.png') ?> "></input>
              <!-- <input type="radio" name="pict" id="pict" value=".png"><img src="<?php echo base_url('/img/dash/units.png') ?> "></input> -->
              <input type="radio" name="pict" id="pict" value="wifi.png"><img src="<?php echo base_url('/img/dash/wifi.png') ?> "></input>
            <!-- </select> -->
                </div>
            </div>
            <!-- <div class="form-group">
              <div class="col-lg-10">
                <img id="img" style="display:block;margin:auto;" class="img-responsive" src="<?php echo base_url('/img/dash/default.png') ?> ">
              </div>
            </div> -->
        </div>   
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>

    <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">


<script type="text/javascript">
  $(document).ready(function () {

    loaddata();
    $("#txtMenuID").select2({
            dropdownParent: "#modal",
            width:"100%"
        }); 
    // $("#pict").select2({
    //         dropdownParent: "#modal",
    //         width:"100%"
    //     }); 

    // $("#txtMenuID").change(function(){
    //   var MenuID2 = $(this).val();
    // })

    var url = "<?php echo base_url('/img/dash/')?>"

    $('#pict').change(function(){
      var img = $('#pict').val();
      var url = "<?php echo base_url('/img/dash/')?>"+img
       $('#img').attr('src', url);
    });

    $('#btnSave').click(function(){
      // alert('a');
      // var a = MenuID2;
      var MenuID2 = $('#modal').data('MenuID');
      if($('#frmEditor').valid()){
        var action = $('#modal').data('action');        
        var datafrm = $('#frmEditor').serializeArray();
        datafrm.push({name:"action",value:action},{name:"MenuID2",value:MenuID2});
        console.log(datafrm);
          $.ajax({
            url : "<?php echo base_url('c_dashentry/save_menu');?>",
              type:"POST",
              data: datafrm,
              dataType:"json",
              success:function(event, data){
                if(event.St=="OK"){
                  swal("Information",event.Pesan,"success");
                  $('#modal').modal('hide');
                }else{
                  swal("Information",event.Pesan,"warning");
                }
                
                // alert(event.Pesan);
                document.getElementById('loader').hidden=false;
                var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                             tblnewsfeed.ajax.reload(null,true); 
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }
                
              },                    
              error: function(jqXHR, textStatus, errorThrown){
                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                // alert(textStatus+' Save : '+errorThrown);
              }
          });                
      }
    });
  });

    function setparentid(MenuID){        

        var site_url = '<?php echo base_url("c_dashentry/zoom_parentid_from")?>';
            $.post(site_url,
              {MenuID:MenuID},
              function(data,status) {
                $("#txtMenuId").empty();
                $("#txtMenuId").append(data);                
                $("#txtMenuId").trigger('change');
              }
            );
    }

    function loaddata(){
        var MenuID = $('#modal').data('MenuID');
        var GroupCd = $('#modal').data('GroupCd');
        // alert(MenuID);
        // ScreenID = MenuID;

        if (MenuID > 0) {
            $.getJSON("<?php echo base_url('c_dashentry/getByID');?>" + "/" + MenuID+ "/" + GroupCd, function (data) {
                
              var radio_checked = data[0].picture;
              $('#txtMenuID').val(data[0].MenuID);
              // console.log(data);
              $('#pict').val(data[0].picture);
              // console.log(data[0].picture);
              $("#txtMenuID").trigger('change');
              // $("#pict").trigger('change');
              $(':radio[value='+radio_checked+']').prop('checked', true);


              // setparentid(data[0].MenuID);


              
              // setprojectname(data[0].project_no);
              // setphase(data[0].phase_cd);
           
            });
        }
    }
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>