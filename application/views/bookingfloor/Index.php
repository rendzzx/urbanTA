 <link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" />
 <script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
   <div class="content-wrapper">
    <section class="content-header">
      <!-- <h1>
        Floor List
      </h1> -->
      <div class="tittle-top pull-left"><?php echo $project_name ?></div>
        <div class="tittle-top pull-right">Floor/Block</div>
    
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body">

             <div class="form-group">
              <label for="pl_project" class="col-sm-1 control-label">Property Type</label>
              <div class="col-sm-8">
                  <select name="pl_property" id="pl_property" data-placeholder="Choose a Project..." class="chosen-select" style="width:250px;" tabindex="2">
                                <option value=""></option> 
                                <!-- <?php 
                                    foreach ($property_type as $row) 
                                    {
                                        echo '<option value="'.$row->property_cd.'">'.$row->descs.'</option>';
                                    }
                                ?>   -->    
                                <?php echo $property_type; ?>      
                              </select>
              </div>   
             <span id="time"></span>          
            </div>
            
           <!--  <div class="form-group">
              <label for="pl_project" class="col-sm-1 control-label">Property Type</label>
                <div class="col-sm-10">
                  <input type="button" value="back">  
                  <?php echo $backButton; ?>
                </div>  
            </div> -->
            <br>
            <?php echo $backButton; ?>
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
            <div class="box-footer">
             <!--  <a href="<?php echo base_url("userlevel/entryForm"); ?>"><i class="fa fa-plus"> New Record </i></a> -->
            </div>
          </div>
        </div>      
      </div>         
    </section>
  </div>
  <?php
  ?>

<div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>

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
</script>


  <script type="text/javascript">
 
// alert(table);
  //dropdown change
$('#pl_property').on("change",function(e){
   var property_cd = $('#pl_property').val();
   
    
$('#table1').load( "<?php echo base_url('c_booking_by_floor/goto_table');?>"+"/"+property_cd+" #table1" );

});

//countdown reload
var a =10;
display = document.querySelector('#time');
    startTimer(a, display);

function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        setInterval(function () {
            minutes = parseInt(timer / 60, 10)
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = 'Reload In : '+ seconds;
            if(seconds==0){
              var property_cd = $('#pl_property').val();
              
               $('#table1').load( "<?php echo base_url('c_booking_by_floor/goto_table');?>"+"/"+property_cd+" #table1" );
            }
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

  //buton status Book, Do nothing
  $(document).on("click", ".book-AddBookDialog", function () {
      var myBookId = $(this).data('id');
     // alert(myBookId);
     // $('#addBookDialog').data('id', myBookId).modal('show');
    
   // });
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
      var myBookId = $(this).data('id');
     
     
     $('#modalTitle').html('Booking');
     $('div.modal-body').html('Are You Sure want to Book this unit '+ myBookId);
     $('div.modal-body').append('<div class="modal-footer"></div>');
     $('#addBookDialog').data('id', myBookId).modal('show');
                        var btnYes = $('<input/>')
                            .attr({
                                id: "btnYes",
                                type: "button",
                                class: "btn btn-danger",
                                onclick: "Booking('"+myBookId+"');",
                                value: 'Yes'
                            });

                        var btnNo = $('<a>No</a>').attr({
                            class: "btn btn-default", 'data-dismiss': "modal"
                        });
                        $('div.modal-footer').append(btnYes);
                        $('div.modal-footer').append(btnNo);
$('#modal').data('id', myBookId).modal('show');                        
   
return false;
  });
    function Booking(myBookId){

      var property_cd = $('#pl_property').val();
      var url_booking ="<?php echo base_url('C_rl_sales/index'); ?>/"+myBookId+"/"+property_cd;
      

       $.ajax({
                    url : "<?php echo base_url('c_booking_by_floor/update_status');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: { id: myBookId ,
                            status:'R',
                            property_cd:property_cd
                          },
                    dataType:"json",
                    success:function(event, data){
                        // alert(event.Pesan);
                        
                        
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });
       
      
       $('#table1').load( "<?php echo base_url('c_booking_by_floor/goto_table');?>"+"/"+property_cd+" #table1" );
        setTimeout(function () {
                  window.location.href = url_booking;
                            }, 2000);
        
        // $('[data-id=' + id + ']').remove();
        $('#modal').modal('hide');
    }

        
  </script>


    