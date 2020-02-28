
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>




<script type="text/javascript">

var tblagent;
$(function(){
$('.select2').select2();
tblagent = $('#tblagent').DataTable( 
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
                                 tblagent.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }
                    }
                }
                

],
"processing": false,
"serverSide": true,
"ajax":{
    "url":"<?php echo base_url('c_agent_list/getTable');?>",
    "data":{"sSearch": function(d){
        var search = $('#txt_search').val();
        var b="";
        if(search == null || search==""){
            return b;
        }{
            return search;
        }
        },
        "lead": function(d){
        var a = $('#txtLead').val();
                    
        var b ="all";
        if(a == null){
            return b;
        }{
            return a;
        }
        console.log(a);
        },
        "group": function(d){
        var a = $('#txtGroup').val();
                    
        var b ="all";
        if(a == null){
            return b;
        }{
            return a;
        }
        console.log(a);
        },
        "entity": function(d){
        var a = $('#txtEntity').val();
                    
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
{data:"entity_cd",name:"entity_cd"},
{data:"lead_name",name:"lead_name"},
{data:"group_name",name:"group_name"},
{data:"Arebi_Member",name:"Arebi_Member"},
{data:"Arebi_Number",name:"Arebi_Number"},
{data:"company_name",name:"company_name"},
{data:"contact_person",name:"contact_person"},
{data:"Company_Address",name:"Company_Address"},
{data:"City",name:"City"},
{data:"Telp_No",name:"Telp_No"},
{data:"Fax_No",name:"Fax_No"},
{data:"Company_Email",name:"Company_Email"},
{data:"agent_name",name:"agent_name"},
{data:"handphone1",name:"handphone1"},
{data:"email_add",name:"email_add"}
]
});
// $("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search() style=" width: auto"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
$("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblagent.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblagent.ajax.reload(null,true);   
        }
    });

});

function fn_search(){
// var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){

        tblagent.ajax.reload(null,true); 
    }
}

</script>
<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">        
            <div class="tittle-top pull-right">Agent List</div>
        </div>
        <div class="form-group" >
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
           <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
        </div>
        <br>
      </div>
        <div class="form-group" >
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Lead</label>
        <div class="col-sm-10">
          <select name="txtLead" id="txtLead"  class="select2" style="width:250px;" tabindex="2">
            <option value="all"></option> 
            <option value="all">All</option>
            <?php 
            foreach ($Lead as $row) 
            {
              echo '<option value="'.$row->lead_cd.'">'.$row->lead_name.'</option>';
            }
            ?>            
          </select>
           
        </div>
        <br>
      </div>
      <div class="form-group" >
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Group</label>
        <div class="col-sm-10">
          <select name="txtGroup" id="txtGroup"  class="select2" style="width:250px;" tabindex="2">
            <option value="all"></option> 
            <option value="all">All</option>
            <?php 
            foreach ($Group as $row) 
            {
              echo '<option value="'.$row->group_cd.'">'.$row->group_name.'</option>';
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
          
                        <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                       
                            <thead>            
                                <th>No.</th>
                                <th>Entity</th>
                                <th>Lead Name</th>
                                <th>Group Name</th>
                                <th>Arebi Member</th>
                                <th>Arebi Number</th>
                                <th>Company Name</th>
                                <th>Contact Person</th>
                                <th>Company Address</th>
                                <th>City</th>
                                <th>Telephone No.</th>
                                <th>Fax No.</th>
                                <th>Company Email</th>
                                <th>Agent Name</th>
                                <th>Handphone</th>
                                <th>Email Address</th>
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
                    tblagent.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});
     $("#txtEntity").change(function() {

          var ent = $(this).find(':selected').val();          
          if(ent!=='') {
            var site_url = '<?php echo base_url("c_agent_list/zoom_lead")?>';
            $.post(site_url,
              {ent:ent},
              function(data,status) {
                // console.log(data);
                $("#txtLead").empty();
                $("#txtLead").append(data);
                $("#txtLead").trigger('change');
              }
            );
           
          } else {
            $("#txtLead").empty();
          }

          var ent = $(this).find(':selected').val();          
          if(ent!=='') {
            var site_url = '<?php echo base_url("c_agent_list/zoom_group")?>';
            $.post(site_url,
              {ent:ent},
              function(data2,status2) {
                // console.log(data);
                $("#txtGroup").empty();
                $("#txtGroup").append(data2);
                $("#txtGroup").trigger('change');
              }
            );
           
          } else {
            $("#txtGroup").empty();
          }
          // document.getElementById('loader').hidden=true;
        });

     // $("#txtLead").change(function() {
     //    var lead = $(this).find(':selected').val(); 
     //    var ent = $("#txtEntity").val();         
     //      if(lead!=='') {
     //        var site_url = '<?php echo base_url("c_agent_list/zoom_group_from")?>';
     //        $.post(site_url,
     //          {lead:lead,ent:ent},
     //          function(data2,status2) {
     //            console.log(data);
     //            $("#txtGroup").empty();
     //            $("#txtGroup").append(data2);
     //            $("#txtGroup").trigger('change');
     //          }
     //        );
           
     //      } else {
     //        $("#txtGroup").empty();
     //      }
     // });
</script>