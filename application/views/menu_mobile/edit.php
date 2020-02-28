      
<link href="<?=base_url('plugins/fileupload/css/jquery.fileupload.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('bootstrap/css/bootstrap.min.css')?>">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url('plugins/datepicker/datepicker3.css')?>">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="<?=base_url('plugins/timepicker/bootstrap-timepicker.min.css')?>">


    <form id ="frmEditor" class="form-horizontal" method="post" action="<?php echo site_url(); ?>c_nup_parameter/save_nup" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="entity_name" class="col-sm-2 control-label">Entity Name</label>
                <div class="col-sm-6">
                    <select name="TxtentityCode" id="TxtentityCode" data-placeholder="Choose a Project..." class="chosen-select form-control" tabindex="2">
                        <option value=""></option> 
                            <?php 
                                foreach ($entityData as $row) 
                                          {
                                              echo '<option value="'.$row->entity_cd.'">'.$row->entity_name.'</option>';
                                          }
                            ?>            
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="project_name" class="col-sm-2 control-label">Project Name</label>
                <div class="col-sm-6">
                    <select name="TxtprojectNo" id="TxtprojectNo" data-placeholder="Choose a Project..." class="chosen-select form-control" tabindex="2">
                    <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Phase </label>
                <div class="col-sm-6">
                    <select name="TxtphaseCode" id="TxtphaseCode" data-placeholder="Choose a Project..." class="chosen-select form-control" tabindex="2">
                        <option value=""></option>                                      
                    </select>
                </div>
            </div>            
            <div class="form-group">
                <label class="col-sm-2 control-label">Start and End Date</label>
                <div class="col-sm-6">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation" name="TxtstartEndDate">                  
                </div>
                </div>
              </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-4">
                    <label class="radio-inline"><input type="radio" name="Txtstatus" id="Txtstatus" value="1">Active </label>
                    <label class="radio-inline"><input type="radio" name="Txtstatus" id="Txtstatus" value="0">Absolut </label>    
                </div>                                
            </div>
        </div>                  
                 
        <div class="modal-footer">
            <button type="submit" id="btnSave" class="btn btn-primary">Save</button>
            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>

<script src="<?=base_url('plugins/validation/jquery.validate.min.js')?>" type="text/javascript"></script> 

<!-- File Upload -->
<script src="<?=base_url('plugins/fileupload/js/jquery.ui.widget.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.iframe-transport.js')?>" type="text/javascript"></script>
<script src="<?=base_url('plugins/fileupload/js/jquery.fileupload.js')?>" type="text/javascript"></script> 

<!-- Choosen -->
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>

<!-- Select2 -->
<script src="<?=base_url('plugins/select2/select2.full.min.js')?>"></script>
<!-- InputMask -->
<script src="<?=base_url('plugins/input-mask/jquery.inputmask.js')?>"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>




<script type="text/javascript">
//End choosen properties      
var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
      }
      for (var selector in config) {
        $(selector).chosen(config[selector]);
      }
//End choosen properties 

$("#TxtentityCode").change(function() {
          var ent = $(this).find(':selected').val();          
          if(ent!=='') {
            var site_url = '<?php echo base_url("c_nup_parameter/zoom_project")?>';
            $.post(site_url,
              {ent:ent},
              function(data,status) {
                $("#TxtprojectNo").empty();
                $("#TxtprojectNo").append(data);
                $("#TxtprojectNo").trigger('chosen:updated');
              }
            );
          } else {
            $("#TxtprojectNo").empty();
          }
        });

$("#TxtprojectNo").change(function() {
          var projectNo = $(this).find(':selected').val();          
          if(projectNo!=='') {
            var site_url = '<?php echo base_url("c_nup_parameter/zoom_phase")?>';
            $.post(site_url,
              {projectNo:projectNo},
              function(data,status) {
                $("#TxtphaseCode").empty();
                $("#TxtphaseCode").append(data);
                $("#TxtphaseCode").trigger('chosen:updated');
              }
            );
          } else {
            $("#TxtphaseCode").empty();
          }
        });

</script>               

<script type="text/javascript">
  $(document).ready(function () {
var isFile=false;
var jqXHRData;
$('#userfile').fileupload({
            url: "<?php echo base_url('c_newsfeed/save_newsfeed');?>",
            dataType: 'json',
            add: function (e, data) {
                jqXHRData = data
                isFile = true;
                
            },
            done: function (event, response) {

                var res = response.result;

                alert(res.Pesan);
                

                // $('[data-id=' + id + ']').remove();
                $('#modal').modal('hide');
                tblnewsfeed.ajax.reload(null,true); 

            },
            fail: function (event, response) {
                alert(response.result.Pesan);
            }
        });


    $('#btnSave').click(function(){
      if($('#frmEditor').valid()){
                var nup_id = $('#modal').data('nup_id');
                var datafrm = $('#frmEditor').serializeArray();
                datafrm.push({name:"nup_id",value:nup_id});
                var obj = new Object();
                obj.id = id;
               
                if(isFile){
                  // alert('sukses Picture');
                  if(jqXHRData){
                    jqXHRData.formData = datafrm;
                    jqXHRData.submit();
                    
                  }
                }else{
                   
                    $.ajax({
                    url : "<?php echo base_url('c_nup_parameter/save_nup');?>",
                    type:"POST",
                    // data:$('#form_rl_sales').serialize(),
                    data: $('#frmEditor').serialize() + '&' + $.param(obj),
                    dataType:"json",
                    success:function(event, data){
                        alert(event.Pesan);
                        
                        $('#modal').modal('hide');
                        tblnewsfeed.ajax.reload(null,true); 
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                      // delete_gagal();
                     alert(textStatus+' Save : '+errorThrown);
                     
                    }
                    });
                }
                // alert(datafrm["userfile"]);

                
                
      }
    });


 $("#userfile").on('change', function () {

            $("#Picture").val(this.files[0].name);
            readURL(this);
            // alert($("#Picture").val());

        });

        function readURL(input) {

            if (input.files && input.files[0])
            {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#picturebox').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);

            }
        }

  });

   $('#modal').one('shown.bs.modal', function (e) {

        var id = $('#modal').data('id');
        ScreenID = id;
        
        if (id > 0) {
            $.getJSON("<?php echo base_url('c_newsfeed/getByID');?>" + "/" + id, function (data) {
                //var tes = JSON.parse(data);
                // alert(data[0].youtube_link);
                $('#subject').val(data[0].subject);
                $('#content').val(data[0].content);
                $('#youtubelink').val(data[0].youtube_link);
                $('#status').val(data[0].status);
                $('#picture').val(data[0].picture);
                var pict_name = data[0].picture;
                // alert(pict_name);
                 $('#picturebox').attr("src", "<?=base_url('img/NewsFeed/')?>" +"/"+pict_name);
                // $('#Picture').val(data.Picture);
                
                // document.getElementById('Level').value = data.Level;
                // $('#picturebox').attr('src', '@Url.Content("~/Picture/")' + data.Picture);

                // document.getElementById("UserCode").readOnly = true;

            });
        }


    });

    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    // $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY h:mm A'
        }
    });

    // $(function() {
    // $('input[name="reservation"]').daterangepicker({
    //     timePicker: true,
    //     timePickerIncrement: 30,
    //     locale: {
    //         format: 'DD/MM/YYYY h:mm A'
    //     }
    // });
// });

    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>                