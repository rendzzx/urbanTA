
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>




<script type="text/javascript">

var tblinvoice;
$(function(){
$('.select2').select2();
tblinvoice = $('#tblinvoice').DataTable( 
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
                                 tblinvoice.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }
                    }
                }
                

],
"processing": false,
"serverSide": true,
"ajax":{
    "url":"<?php echo base_url('c_invoice/getTable');?>",
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
        var a = $('#txtProject').val();
                    
        var b ="all";
        if(a == null){
            return b;
        }{
            return a;
        }
        console.log(a);
        },
        "debtor": function(d){
        var a = $('#txtDebtor').val();
                    
        var b ="all";
        if(a == null){
            return b;
        }{
            return a;
        }
        console.log(a);
        }
},             
    "type":"POST"
},
"columns": [
{data: "row_number",name:"row_number", searchable:false},
{data:"name",name:"name"},
{data:"lot_no",name:"lot_no"},
{data:"doc_no",name:"doc_no"},
{data:"doc_date",name:"doc_date"},
{data:"due_date",name:"due_date"},
{data:"ar_ldg_desc",name:"ar_ldg_desc"},
{data:"currency_cd",name:"currency_cd"},
{data:"alloc_amt",name:"alloc_amt"}
]
});
$("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblinvoice.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblinvoice.ajax.reload(null,true);   
        }
    });

});

function fn_search(){
// var project = $('#txt_Pl_Project').val();
// alert('a');
// return;
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){
        tblinvoice.ajax.reload(null,true); 
    }
}

</script>
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">        
            <div class="tittle-top pull-right"><b>Invoice List</b></div>
        </div>
        <div class="form-group" hidden="hidden">
          <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Entity</label>
        <div class="col-sm-10">
          <select name="txtEntity" id="txtEntity" class="select2" style="width:250px;" tabindex="2">
            <option value="all"></option> 
            <option value="all">All</option>
            <?php 
            foreach ($Entity as $row) 
            {
              echo '<option value="'.$row->entity_cd.'">'.$row->entity_cd.'</option>';
            }
            ?>            
          </select>
           <!-- <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button> -->
        </div>
        <br>
      </div>
        <div class="form-group" >
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Project</label>
        <div class="col-sm-10">
          <!-- <select name="txtLead" id="txtLead"  class="select2" style="width:250px;" tabindex="2"> -->
          <select name="txtProject" id="txtProject"  class="select2" style="width:250px;" tabindex="2">
            <option value="all"></option> 
            <option value="all">All</option>
            <?php 
            foreach ($ProjectData as $row) 
            {
              echo '<option value="'.$row->project_no.'">'.$row->project_no.'</option>';
            }
            ?>            
          </select>
           <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
        </div>
        <br>
      </div>
      <div class="form-group" >
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Debtor</label>
        <div class="col-sm-10">
          <!-- <select name="txtGroup" id="txtGroup"  class="select2" style="width:250px;" tabindex="2"> -->
          <select name="txtDebtor" id="txtDebtor"  class="select2" style="width:250px;" tabindex="2">
            <option value="all"></option> 
            <option value="all">All</option>
            <?php 
            foreach ($DebtorData as $row) 
            {
              echo '<option value="'.$row->debtor_acct.'">'.$row->debtor_acct.'</option>';
            }
            ?>            
          </select>
           
        </div>
        <br>
      </div>
    </div> 
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
          
                        <table id="tblinvoice" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                       
                            <thead>            
                                <th>No.</th>
                                <th>Name</th>
                                <th>Unit</th>
                                <th>Document Number</th>
                                <th>Doc. Date</th>
                                <th>Due Date</th>
                                <th>Description</th>
                                <th>Currency</th>
                                <th>Outstanding</th>
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
<script type="text/javascript">
    $('#search').click(function(){
    
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblinvoice.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }    
});     
</script>