<link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
<div class="box-body">
<div class="form-group">
              <label for="pl_property" class="col-sm-1 control-label">Property Type</label>
              <div class="col-sm-10">
                  <select name="pl_property" class="form-control chosen-select" id="pl_property" tabindex="2" data-placeholder="Select Property"></select>
              </div>   
             <span id="time"></span>          
            </div>
                <table id="table1" class="table table-bordered table-hover dataTable">
                <thead>
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
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script> 
<script type="text/javascript">
var property_cd = "<?php echo $property_cd?>";
//start chosen properties
var config = {
      // '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:false},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    // $("").chosen({ width: '50%'});
    $("#pl_property").chosen({ width: '100%'});
    
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
    //end chosen properties
    
    //dropdown change reload table
    $('#pl_property').on("change",function(e){
      var property_cd = $('#pl_property').val();       
    $('#table1').load( "<?php echo base_url('c_booking_by_floor/goto_table_sales');?>"+"/"+property_cd+" #table1");
    });
    //END dropdown change reload table


    //set dropdown property cd with function
    setpl_project(property_cd);    
    function setpl_project(Id){
        
        var site_url = '<?php echo base_url("c_rl_sales/cb_property_cd")?>';
            $.post(site_url,
              {Id:Id},
              function(data,status) {
                $("#pl_property").empty();
                $("#pl_property").append(data);
                $("#pl_property").trigger('chosen:updated');
              }
            );
    }
//END set dropdown property cd with function 

//set Countdown with reload table
       var count=10;
        var duration = count;
         
        var counter=setInterval(timer, 1000);
        function timer(){
          
          if (count < 0)
          {
            var property_cd = $('#pl_property').val();   
            count = duration;
            $('#table1').load( "<?php echo base_url('c_booking_by_floor/goto_table_sales');?>"+"/"+property_cd+" #table1");
            
          }
         document.getElementById("time").innerHTML='Reload In : '+count;
         // display2 = 'Reload In : '+count;
         count=count-1;
       }
//END set Countdown with reload table
//function stop countdown when modal hide  
    function stoptime(){
       clearInterval(counter);
    }
//END function stop countdown when modal hide    
    
    //buton status Book, Do nothing
     $(document).on("click", ".book-AddBookDialog", function () {
      var myBookId = $(this).data('id');
     // alert(myBookId);
    return false;
      });
   //buton status Reserve, Do nothing
  $(document).on("click", ".reserve-AddBookDialog", function () {
      var myBookId = $(this).data('id');
     // alert(myBookId);
     // $('#addBookDialog').data('id', myBookId).modal('show');
    
   // });
return false;
  });
//buton status Open, Do Booking
    $(document).on("click", ".open-AddBookDialog", function () {
      var lot_no = $(this).data('id');
      var id = $('#modal').data('id');   
     // change_status_lot()
     // document.getElementById("unit").innerHTML= lot_no;
     $('#unit').val(lot_no);
     tampil_data();
     clearInterval(counter);
     // alert(lot_no,'R');
     $('#modal').modal('hide');  
     // $('[data-id=' + myBookId + ']').remove();                     
   
return false;
  });
   
      function change_status_lot(lot_no,status,property_cd){
        
        var site_url = '<?php echo base_url("c_booking_by_floor/update_status")?>';
            $.post(site_url,
              {id:lot_no,status:status,property_cd:property_cd},
              function(data,status) {
                // alert(status);
              }
            );
      }
      $('#modal').one('shown.bs.modal', function (e) {

       
        


    });
    $('#modal').one('hidden.bs.modal', function (e) {
      var id = $('#modal').data('id');        
        $(this).removeData();
        $('[data-id=' + id + ']').remove();
        var lot_no = $('#unit').val();   
        change_status_lot(lot_no,'R',id);
        clearInterval(counter);
        $(".modal-body").html("");
        // alert(lot_no);
      
    });
</script>           