

<form id ="frmEditor" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="box-body">
           
          
            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Report No </label>
                <div class="col-sm-6">
                    <!-- <label for="phase_descs" class="col-sm-2 control-label report_no" id="report_no"></label> -->
                    <input type="text" class="form-control pull-right report_no" id="report_no" name="report_no" readonly="true" style="border:none; 
		background-color: #ffffff;">
                </div>
            </div> 

            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Request By </label>
                <div class="col-sm-6">
                   <input type="text" class="form-control pull-right serv_req_by" id="serv_req_by" name="report_no" readonly="true" style="border:none; 
		background-color: #ffffff;">
                    
                </div>
            </div>

            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Contact </label>
                <div class="col-sm-6">
                   <input type="text" class="form-control pull-right contact_no" id="contact_no" name="report_no" readonly="true" style="border:none; 
		background-color: #ffffff;">
                    
                </div>
            </div> 

            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Lot No </label>
                <div class="col-sm-6">
                   <input type="text" class="form-control pull-right lot_no" id="lot_no" name="report_no" readonly="true" style="border:none; 
		background-color: #ffffff;">
                    
                </div>
            </div> 

            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Floor </label>
                <div class="col-sm-6">
                   <input type="text" class="form-control pull-right floor" id="floor" name="report_no" readonly="true" style="border:none; 
		background-color: #ffffff;">
                    
                </div>
            </div> 

            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Location Type </label>
                <div class="col-sm-6">
                   <input type="text" class="form-control pull-right location_type" id="location_type" name="report_no" readonly="true" style="border:none; 
		background-color: #ffffff;">
                    
                </div>
            </div>  

            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Category Code </label>
                <div class="col-sm-6">
                   <input type="text" class="form-control pull-right category_cd" id="category_cd" name="report_no" readonly="true" style="border:none; 
		background-color: #ffffff;">
                    
                </div>
            </div>  

            <div class="form-group">
                <label for="phase_descs" class="col-sm-2 control-label">Work Requested </label>
                <div class="col-sm-8">
                   <textarea class="form-control pull-right work_requested" id="work_requested" name="report_no" readonly="true" style="border:none; 
		background-color: #ffffff;height: 50px;"> </textarea>
                    
                </div>
            </div>             

        </div>                  
                 
        <div class="modal-footer">
            <button id="btnOK" type="button" class="btn btn-default" data-dismiss="modal">OK</button>
           
        </div>
    </form>

<script type="text/javascript">
formload();
  $(document).ready(function () {
var isFile=false;
var jqXHRData;

  });
function formload(){
	var id = $('#modal').data('rowID');
        // alert(id);
        if (id > 0) {
            $.getJSON("<?php echo base_url('c_csassign/getByID');?>" + "/" + id, function (data) {
                //var tes = JSON.parse(data);
              
                $('#report_no').val(data[0].report_no);
                $('#serv_req_by').val(data[0].serv_req_by);
                $('#contact_no').val(data[0].contact_no);
                $('#lot_no').val(data[0].lot_no);
                $('#floor').val(data[0].floor);
                $('#location_type').val(data[0].location_type);
                $('#category_cd').val(data[0].category_cd);
                $('#work_requested').val(data[0].work_requested);

  					// alert(data[0].report_no);
               
               
            });
        }
}
   // $('#modal').one('shown.bs.modal', function (e) {

   //      var id = $('#modal').data('rowID');
   //      alert(id);
   //      ScreenID = id;
        
   //      if (id > 0) {
   //          $.getJSON("<?php echo base_url('c_csassign/getByID');?>" + "/" + id, function (data) {
   //              //var tes = JSON.parse(data);
              
   //              $('#report_no').val(data[0].report_no);
  	// 				alert(data[0].report_no);
               
               
   //          });
   //      }


   //  });

    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>