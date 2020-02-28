
<link rel="stylesheet" href="<?=base_url('css/plugins/daterangepicker/daterangepicker-bs3.css')?>">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" >

<style type="text/css">
  .has-error .select2 {
      border: 1px solid #a94442;
      border-radius: 4px;
 
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
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
</style>


<div id="loader" class="loader" hidden="false"></div>
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <label for="nup_id" class="col-sm-2 control label"></label>
                <input type="hidden" name="txtNupId" id="txtNupId" class="form-control">
            </div>
            <div class="form-group">
                <label for="entity_name" class="col-sm-2">Office Name </label>
                <div class="col-sm-10">
                    <select name="OfficeNamedtl" id="OfficeNamedtl" onchange="myFunction()" data-placeholder="Choose a Office..." class="form-control select2" tabindex="2" disabled>
                            <option value=""></option>
                          
                    </select>
                </div>
            </div>
            <div class="form-group">
      <label for="PT" class="col-sm-2 control-label">PT<FONT COLOR="RED">*</FONT></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" style = "border:none; background-color:white;" readonly="true" id="PTPTdtl" name="PTPTdtl"/>  
      </div>                        
    </div>
    <div class="form-group">
      <label for="AgentName" class="col-sm-2 control-label">Agent Name<FONT COLOR="RED">*</FONT></label>
      <div class="col-sm-10">
        <input type="text" id="txtAgentName" name="txtAgentName" class="form-control"/> 
      </div>                        
    </div>
    <div class="form-group">
      <label for="IDNo" class="col-sm-2 control-label">ID No<FONT COLOR="RED">*</FONT></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="txtIdNo" name="txtIdNo"/> 
      </div>                        
    </div>
    <div class="form-group">
      <label for="NPWP" class="col-sm-2 control-label">NPWP<FONT COLOR="RED">*</FONT></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="txtNPWP" name="txtNPWP"/> 
      </div>                        
    </div>
    <div class="form-group">
      <label for="HomeAdd" class="col-sm-2 control-label">Home Address<FONT COLOR="RED">*</FONT></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="txtHomeAdd" name="txtHomeAdd"/> 
      </div>                        
    </div>
            <div class="form-group">
                <label for="project_name" class="col-sm-2">City</label>
                <div class="col-sm-10">         
                    <select name="txtCity" id="txtCity" data-placeholder="Choose a City..." class="form-control select2" tabindex="2">
                    <option value=""></option>
                    </select>
                </div>
            </div>
            <div class="form-group">
      <label for="EmailAdd" class="col-sm-2 control-label">Email Address<FONT COLOR="RED">*</FONT></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="txtEmailAdd" name="txtEmailAdd" disabled/>  
      </div>                        
    </div>                      
    <div class="form-group">
      <label for="Mbl1" class="col-sm-2 control-label">Mobile 1<FONT COLOR="RED">*</FONT></label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="txtMbl1" name="txtMbl1"/>Format: 62817737669 | 0817737669   
      </div>                        
    </div>
    <div class="form-group">
      <label for="Mbl2" class="col-sm-2 control-label">Mobile 2</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="txtMbl2" name="txtMbl2"/> Format: 62817737669 | 0817737669 
      </div>                        
    </div>
                  
                
        </div>                  
                 
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        </div>
    </form>



<!-- Select2 -->

<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<!-- <script src="<?=base_url('js/plugins/select2/select2.js')?>"></script> -->
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<!-- date-range-picker -->
<script src="<?=base_url('js/plugins/fullcalendar/moment.min.js')?>"></script>
<script src="<?=base_url('js/plugins/daterangepicker/daterangepicker.js')?>"></script>
<script type="text/javascript" src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script>
         

<script type="text/javascript">

  $(document).ready(function () {
    $("#OfficeNamedtl").select2({
            dropdownParent: "#modal",
            width:"100%"
        }); 
    $("#txtCity").select2({
            dropdownParent: "#modal",
            width:"100%",
            ajax:{
            url: '<?php echo base_url("c_nup/chosen_city_")?>',
            dataType: 'json',
            type: 'post',
            delay: 1000,
            data: function(params) {
              document.getElementById('loader').hidden=false;
              return{
                q: params.term
              };
            },
            processResults: function(data) {
              // console.log(data);
              document.getElementById('loader').hidden=true;
              return{
                results: data
              };
            },
            cache: false            
          },
          minimumInputLength: 3,
          placeholder: 'Type a city' 
        }); 

      $('#btnSave').click(function(){
      
      if($('#frmEditor').valid())
      {
        
       
        // alert(ID);
        var ID = $('#modal').data('rowid');
        var dataform = $('#frmEditor').serializeArray();
       
        
        // console.log(dataform);
        // return;
       
        var site_url = "<?php echo base_url('c_marketing_list/update')?>/"+ID;
        $.ajax({
          url: site_url,
          type: "POST",
          data: dataform,
          dataType: "json",
          success: function(data, status){
        console.log(data);

            if(status=='success'){
                  swal({
                    title: "Information",
                    text: data.Pesan,
                    type: "success",
                    confirmButtonText: "OK"
                  },
                  function(){
                    $('#modal').modal('hide');
                    tblmarketing.ajax.reload(null,true);
                    // alert("<?php echo base_url('c_nup/Index');?>");
                    // window.location.href="<?php echo base_url('c_nup/Index');?>"
                  });
                } else {
                  swal({
                    title: "Error",
                    text: data.Pesan,
                    type: "error",
                    confirmButtonText: "OK"
                  });
                }

          },
          error: function(jqXHR, textStatus, errorThrown){
            swal(textStatus+' Save : '+errorThrown);
          }
        })
      }
    });
      

  });
loaddata();
   function myFunction()
{
  var x = document.getElementById("OfficeNamedtl").value;
  var site_url = '<?php echo base_url("c_agent/getById")?>';
  $.post(site_url,
    {Id:x},
    function(data,status) {
        // console.log(data);
        $('#PTPTdtl').val(data);
        // $("#customer").empty();
        // $("#customer").append(data);
        // $("#customer").trigger('chosen:updated');
      }
    );          
}

  function loaddata(){
    var Ida = $('#modal').data('id');
    // alert(Ida.length);
    // ScreenID = nup_id;

    if (Ida.length > 0) {
      $.getJSON("<?php echo base_url('c_profile/getByID');?>" + "/" + Ida, function (data) {
        console.log(data);
        $('#txtAgentName').val(data[0].agent_name);
        $('#txtIdNo').val(data[0].id_no);
        $('#txtNPWP').val(data[0].npwp);
        $('#txtHomeAdd').val(data[0].home_address);
        $('#txtEmailAdd').val(data[0].email_add);
        $('#txtMbl1').val(data[0].handphone1);
        $('#txtMbl2').val(data[0].handphone2);
        setcity(data[0].city);
        setOffice(data[0].group_cd);
      });
    }
}
function setcity(ent){ 
    var site_url = '<?php echo base_url("c_nup/chosen_city")?>';
    $.post(site_url,
      {Id:ent},
      function(data,status) {
        // console.log(data);
        $("#txtCity").empty();
        $("#txtCity").append(data);
        $("#txtCity").trigger('change');
      }
      );
  }
  function setOffice(pro){  
    var site_url = '<?php echo base_url("c_profile/zoom_office")?>';
    $.post(site_url,
      {Id:pro},
      function(data,status) {
        $("#OfficeNamedtl").empty();
        $("#OfficeNamedtl").append(data);
        $("#OfficeNamedtl").trigger('change');
      }
      );
  }
    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>
