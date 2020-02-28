 <link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">

<div class="box-body">
<div class="container-fluid">
<form id ="frmEditor" class="form form-horizontal" method="post" action="" enctype="multipart/form-data">
    <div class="form-body">
        <div class="form-group row">
            <label for="OfficeName" class="col-sm-3 control-label">Office Name </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" style = "border:none; background-color:white;" readonly="true" name="OfficeNamedtl" id="OfficeNamedtl" readonly/>   
            </div>
        </div>
        <div class="form-group row">
            <label for="PT" class="col-sm-3 control-label">PT </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" style = "border:none; background-color:white;" readonly="true" id="PTPTdtl" name="PTPTdtl" readonly/>    
            </div>                          
        </div>
        <div class="form-group row">
            <label for="AgentName" class="col-sm-3 control-label">Agent Name </label>
            <div class="col-sm-8">
                <input type="text" id="txtAgentName" name="txtAgentName" style = "border:none; background-color:white;" class="form-control" readonly/> 
            </div>                          
        </div>
        <div class="form-group row">
            <label for="IDNo" class="col-sm-3 control-label">ID No </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="txtIdNo" style = "border:none; background-color:white;" name="txtIdNo" readonly/>   
            </div>                          
        </div>
        <div class="form-group row">
            <label for="NPWP" class="col-sm-3 control-label">NPWP </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="txtNPWP" style = "border:none; background-color:white;" name="txtNPWP" readonly/>   
            </div>                          
        </div>
        <div class="form-group row">
            <label for="HomeAdd" class="col-sm-3 control-label">Home Address </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="txtHomeAdd" style = "border:none; background-color:white;" name="txtHomeAdd" readonly/> 
            </div>                          
        </div>
        <div class="form-group row">
            <label for="ComAdd" class="col-sm-3 control-label"><b>City</b> </label>
            <div class="col-sm-8">
          
                <input type="text" class="form-control" name="txtCity" id="txtCity" style = "border:none; background-color:white;" readonly/>                 
            </div>
        </div>                 
        <div class="form-group row">
            <label for="EmailAdd" class="col-sm-3 control-label">Email Address </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="txtEmailAdd" name="txtEmailAdd" style = "border:none; background-color:white;" readonly/>  
            </div>                          
        </div>                      
        <div class="form-group row">
            <label for="Mbl1" class="col-sm-3 control-label">Mobile 1 </label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="txtMbl1" name="txtMbl1" style = "border:none; background-color:white;" readonly/>  
            </div>                          
        </div>
        <div class="form-group row">
            <label for="Mbl2" class="col-sm-3 control-label">Mobile 2</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="txtMbl2" name="txtMbl2" style = "border:none; background-color:white;" readonly/> 
            </div>                          
        </div>
    </div>
    <br>

</form>
</div>
</div>
  <script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
 

<script type="text/javascript">
    $(document).ready(function () {

        loaddata();

        // $("#txtNPWP").inputmask({
        //     mask: "99.999.999.9-999.999"
        // });

        $(".select2").select2({
            dropdownParent: "#modal",
             width:'100%'
        });
    });

    function loaddata(){
        var rowsid = $('#modal').data('rowID_agent');
        console.log(rowsid);
        // alert(Ida.length);
        // ScreenID = nup_id;

        if (rowsid.length > 0) {
            $.getJSON("<?php echo base_url('c_agent_approval/getByID');?>" + "/" + rowsid, function (data) {
                console.log(data);

                $('#txtAgentName').val(data[0].agent_name);
                $('#txtIdNo').val(data[0].id_no);
                $('#txtNPWP').val(data[0].npwp);
                $('#txtHomeAdd').val(data[0].home_address);
                $('#txtEmailAdd').val(data[0].email_add);
                $('#txtMbl1').val(data[0].Handphone1);
                $('#txtMbl2').val(data[0].Handphone2);
                // setcity(data[0].city);
                $('#txtCity').val(data[0].city);
                $("#OfficeNamedtl").val(data[0].group_name);
                $('#PTPTdtl').val(data[0].company_name);
                // setOffice(data[0].group_cd);
            });
        }
}
</script>
