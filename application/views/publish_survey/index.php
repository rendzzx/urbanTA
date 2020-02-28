
 <link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('css/plugins/select2/select2.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/clockpicker/clockpicker.css')?>" rel="stylesheet" />
<link rel="stylesheet" href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/pickers/daterange/daterangepicker.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/css/plugins/pickers/daterange/daterange.css')?>">
<div class="app-content content">
  <div class="content-wrapper">
     <div class="content-wrapper-before"></div>
     <div class="content-header row">
        <div class="content-header-left col-md-4 col-12 mb-2">
            <br><br>
           <h3 class="content-header-title">Survey Publish</h3>
        </div>

        <div class="content-header-right col-md-8 col-12 mb-2">
        <br>
            <div class="breadcrumbs-top float-md-right">
                <div class="breadcrumb-wrapper mr-1">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Setting</a>
                    </li>
                    <li class="breadcrumb-item active" class="nav-link nav-link-expand">Survey
                    </li>
                    </ol>
                </div>
            </div>
        </div>

        </div>
        <div class="content-body">
           
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                            
                                  
                                        <table id="tblsurvey" class="table table-striped table-bordered base-style table-hover dataTables" cellspacing="0">  
                                            <thead> 
                                            <tr>
                                                <th>No.</th>          
                                                <th class="sorting_asc">Survey Title</th>
                                                <th>Subject</th>
                                                <th>Publish Date</th>
                                                <th>Expired Date</th>
                                                
                                            </tr> 
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                           
                                     
                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/pickers/daterange/daterangepicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('js/plugins/clockpicker/clockpicker.js')?>" type="text/javascript"></script>
<script src="<?=base_url('css/test/jquery.validate.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
<script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
<script type="text/javascript">
var tblsurvey;
var s='',q='',f='',g='',h='',j='';
var bs='',bq='';
$(function(){
   tblsurvey = $('#tblsurvey').DataTable( 
    {
         "language": {
            "decimal": ",",
            "thousands": ".",
        },
         "dom": '<"toolbar tblsurvey">frtip',
        select: true,
        order: [[ 0, 'asc' ]],
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_publish_survey/getTable');?>",
            "data":{"sSearch": function(d){
                var search = $('#txt_search').val();
                var b="";
                if(search == null || search==""){
                    return b;
                }{
                    return search;
                }
             }},             
            "type":"POST"
        },
        "columns": [
            {
              data: "row_number",name:"row_number", searchable:false
             },
             {
              data: "title",name:"title", searchable:true
             },
              {data:"sub",name:"sub",searchable:true,
                 render: function (data, type, row) {
                x=data;
                // console.log(x);
                var cc='';
                xArray = x.split(',');
                $.each(xArray, function(index, value) { 
                    // console.log(value);
                    cc=cc+value+'<br>';
                });
                return cc;
                }
               },
            {
              data: "s_publishdate",name:"s_publishdate",searchable:true
             },
            {
              data: "s_expireddate",name:"s_expireddate",searchable:true
             },
           
        ]
      
    });
    $("div.tblsurvey").html(
        '<button id="addparam" class="btn btn-primary pull-up">Add</button>&nbsp;'+
        '<button id="editparam" class="btn btn-info pull-up">Edit</button>&nbsp;'+
        '<button id="deleteparam" class="btn btn-danger pull-up">Delete</button>'
        // '<button id="editparam" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'
        
    );
    tblsurvey.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblsurvey.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

     $('#fn_search').click(function(){
        // alert('apalw');
        block(true,'#tblsurvey');
   
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblsurvey.ajax.reload(null,true);
                    block(false,'#tblsurvey');
                },1000);
            }  
    });
     $("input[type='search']").keyup(function(event){
        var a = $("input[type='search']").val();
            console.log($("input[type='search']"));
            if(a==''){
                tblsurvey.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            // alert(a);
            tblsurvey.ajax.reload(null,true);   
        }
    });
     $('#addparam').click(function(){

        var site_url = '<?php echo base_url("c_publish_survey/getPublishId")?>';
        $.post(site_url,{ent:1}, function(data,status) { 
            var publish_id = parseInt(data)+1;
          
            block(true,'#modalbody');
            $('#modalbody').html("");
            $('#modalheader').addClass('bg-primary white');
            $('#modaldialog').addClass('modal-lg');
            $('#modaltitle').addClass('white');
            $('#modal').modal({backdrop: 'static', keyboard: false})  
            $('#modaltitle').html('Add Question');
            $('#modalbody').load("<?php echo base_url("c_publish_survey/add");?>");
            
            $('#modal').data('publish_id', publish_id).modal('show');
            $('#modal').data('form', 'add');
        }); 
    });
       $('#editparam').click(function(){
        // alert('weee');
        var rows = tblsurvey.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            return;
        } 
        var data = tblsurvey.rows(rows).data();
        // var id = data[0].ot_id;
        var publish_id = data[0].publish_id;
        var line_no  = data[0].line_no;

      
        block(true,'#modalbody');
        $('#modalbody').html("");
        $('#modalheader').addClass('bg-primary white');
        $('#modaldialog').addClass('modal-lg');
        $('#modaltitle').addClass('white');
        $('#modal').modal({backdrop: 'static', keyboard: false})  
        $('#modaltitle').html('Edit Question');
        // var dd = $('#ov_date').val();
        $('#modalbody').load("<?php echo base_url("c_publish_survey/add");?>");

        // $('#modal').data('survey_id', survey_id).modal('show');
        $('#modal').data('publish_id', publish_id);
        $('#modal').data('line_no', line_no);
        $('#modal').data('form', 'Edit');
        $('#modal').modal('show');
        
    });
       $('#deleteparam').click(function(){
        block(true,'.content-body');
        var rows = tblsurvey.rows('.selected').indexes();
        if (rows.length < 1) {
            swal("Information",'Please select a row',"warning");
            block(false,'.content-body');
            return;
            
        } 
        var data = tblsurvey.rows(rows).data();
        var publish_id = data[0].publish_id;
        var survey_id = data[0].survey_id;
           
            swal({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then(function(a){
                if (a.value==true) {
                    Delete(publish_id,survey_id);
                }else{
                    block(false,'.content-body');
                }
            });
        });   
        
});


function Delete(publish_id,survey_id) {
    // var publish_id = $('#modal').data('publish_id');
    // var survey_id = $('#modal').data('survey_id');
    // alert(LocationID);
    $.ajax({
        url : "<?php echo base_url('c_publish_survey/Delete');?>",
        type:"POST",
        data: { publish_id: publish_id,survey_id:survey_id},
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
         
            if (event.status == 'success') {
                 // alert('test');
              swal("Information",event.Pesan,"success");
               block(false,'.content-body');
                tblsurvey.ajax.reload(null,true); 
          }
          else{
            swal("Information",event.Pesan,"error");
               block(false,'.content-body');


         }
                // $('#modal').modal('hide');
                //  location.reload();
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");

        }
    });
}
function block(boelan,div){
        var block_ele = $(div);
        if (boelan==true) {
            $(block_ele).block({
                message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                fadeIn: 1000,
                fadeOut: 1000,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait'
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    backgroundColor: '#333',
                    marginLeft : 'auto'
                }
            });
        }
        else{
            $(block_ele).unblock()
        }
    }
</script>


