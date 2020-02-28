
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>




<script type="text/javascript">

var tblcus;
$(function(){

$('#search').click(function(){
   
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                    tblcus.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});
$('.select2').select2();
tblcus = $('#tblcus').DataTable( 
{
    dom: '<"toolbar dataTables_filter">Bfrtip',
    responsive: true,
    select: true,
    filter: false,    
    paging:false, 
    buttons: [
                  
                {
                extend: 'collection',
                className: 'btn biru-bg fa fa-star',
                text: ' Action',
                buttons: [
                    // 'copy',
                    'excel',
                    'csv',
                    'pdf',
                    // 'print'
                            ]           
                },
                
               
                {
                    text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 tblcus.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }
                    }
                }
                

],
"processing": false,
"serverSide": true,
"ajax":{
    "url":"<?php echo base_url('c_cus_details/getTable');?>",
    "data":{"sSearch": function(d){
        var search = $('#txt_search').val();
        var b="";
        if(search == null || search==""){
            return b;
        }{
            return search;
        }
        },
        "project": function(d){
        var search = $('#pl_project').val();
        var b="";
        if(search == null || search==""){
            return b;
        }{
            return search;
        }
    }
},             
    "type":"POST"
},
"columns": [
{data: "row_number",name:"row_number", searchable:false},
{data:"property_descs",name:"property_descs"},
{data:"nup_counter",name:"nup_counter"},
{data:"no_prioritas",name:"no_prioritas"},
{data:"lot_no",name:"lot_no"},
{data:"nup_no",name:"nup_no"},
{data:"name",name:"name"},
{data:"hand_phone",name:"hand_phone"},
{data:"group_name",name:"group_name"},
{data:"company_name",name:"company_name"},
{data:"agent_name",name:"agent_name"},
{data:"handphone1",name:"handphone1"}
]
});
$("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search() style=" width: auto"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblcus.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblcus.ajax.reload(null,true);   
        }
    });

});

function fn_search(){
// var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){

        tblcus.ajax.reload(null,true); 
    }
}



</script>
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">        
            <!-- <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div> -->
            <div class="tittle-top pull-right">NUP Choose Unit Details</div>
        </div>
        <div class="form-group">
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Project</label>
        <div class="col-sm-10">
         <select name="pl_project" id="pl_project" data-placeholder="Choose a Project..." class="select2" style="width:250px;" tabindex="2">
            <option value="all"></option> 
            <option value="all">All</option>
            <?php 
           
              echo $cbproject;
            
            ?>            
          </select>
           <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
        </div>
        
        <br>
      </div>
      
    </div> 
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
          
                        <table id="tblcus" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                       
                            <thead>            
                                <th>No.</th>
                                <th>Property Type</th>
                                <th>Unit Counter</th>
                                <th>Unit Priority</th>
                                <th>Unit No.</th>
                                <th>NUP No.</th>
                                <th>Name</th>
                                <th>Handphone</th>
                                <th>Group Name</th>
                                <th>Company Name</th>
                                <th>Agent Name</th>
                                <th>Handphone</th>
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

<div id="modal" class="modal fade"  role="dialog" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modalTitle"></h5>
            </div>
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>
