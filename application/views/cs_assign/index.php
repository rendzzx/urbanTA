<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/dataTables.select.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>



<script type="text/javascript">

window.history.forward();
</script>

 <style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}

</style>

<script type="text/javascript">


 // $('#assign_to').select2();



var tblcs;
$(function(){
// $(".select2").select2({});
$("#assign_to_").select2({
        placeholder: "Select a Country"
    });
   

   tblcs = $('#tblcs').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
           
            
            // "order": [[ 11, "desc" ]],
            // searchDelay:null,
            buttons: [
                  
                // {
                // extend: 'collection',
                // className: 'btn biru-bg fa fa-star',
                // text: ' Action',
                // buttons: [
                //     // 'copy',
                //     'excel',
                //     'csv',
                //     'pdf',
                //     // 'print'
                //             ]           
                // },
                
               
                {
                    text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 tblcs.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }
                    }
                }
                

],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_csassign/getTable');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
                }
            },           
            "type":"POST"
        },
        "columns": [
            {data: "report_no",name:"report_no", searchable:true},
            {data: "rowID",name:"rowID", 
                        render: function (data, type, row) {
                            var project=row.project_no;
                            var entity=row.entity_cd;
                                return  '<input type="button" value="i" onclick="info('+data+');" class="btn btn-info btn-xs">';
                                // return status;
                            }
            },
            {data: "name", name: "name"}, 
            {data:"reported_date",name:"reported_date",render: function (data) {
                    var date = new Date(data);
                    var month = date.getMonth() + 1;
                    return date.getDate() + "-" + (month.length > 1 ? month : "" + month) + "-" + date.getFullYear();
                }},
            {data:"reported_by",name:"reported_by"},            
            {data:"status_desc",name:"status_desc"},
            {data:"assign_to",name:"assign_to",
                render: function (data, type, row) {
                            var project=row.project_no;
                            var entity=row.entity_cd;
                            var rowID=row.rowID;
                                return  '<select name="assign_to_'+rowID+'" id="assign_to_'+rowID+'" data-placeholder="Assign to.." style="width:200px;" class="select2" onchange="updateValue('+rowID+');"><option value="" disabled selected>Choose Assign to..</option><?php echo $comboAssign;?></select>';

                                // return status;
                            }},
            {data: "departement", name: "departement"},
            {data: "division", name: "division"},
            {
              data: "status", name: "status",
                   render: function (data, type, row) {
                            var project=row.project_no;
                            var entity=row.entity_cd;
                            var rowID=row.rowID;
                                return  '<a class="btn btn-success btn-sm" name="status_'+rowID+'" id="status_'+rowID+'" onclick="updateStatus('+rowID+');"" > Submit</a>';
                                // return status;
                            }
            },
            // {data:"debtor_acct",name:"debtor_acct",visible:false},
            {data:"entity_cd",name:"entity_cd",visible:false},
            {data:"project_no",name:"project_no",visible:false}
            // {data:"status",name:"status",visible:false}
           
            ]
    });
    $("div.toolbar").html('<b>Search : <input type="text" class="form-control" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search"  name="txt_search" > <a class="btn btn-success btn-sm" onclick="fn_search();"><i class="fa fa-search"></i></a> </b>');

    // $('#txt_search').change(function(){
    //     // BootstrapDialog.alert('asdf');
    // });
     $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        if(a==''){
            tblcs.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            // $("#id_of_button").click();
            
            tblcs.ajax.reload(null,true);   
        }
        
    });



});

function fn_search(){
    var a = $('#txt_search').val();
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblcs.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
     
}


 // $("#txtassign").change(function() {
 //          var assign_to = $(this).find(':selected').val();          
 //          if(assign_to!=='') {
 //            var site_url = '<?php echo base_url("c_csassign/zoom")?>';
 //            $.post(site_url,
 //              {assign_to:assign_to},
 //              function(data,status) {
 //                $("#txtassign").empty();
 //                $("#txtassign").append(data);
 //                $("#txtassign").trigger('chosen:updated');
 //              }
 //            );
 //          } else {
 //            $("#txtassign").empty();
 //          }
 //        });

    function info(rowID)
  {
    // alert(rowID);return;
    var modalClass = $('#modal').attr('class');
                      switch (modalClass) {
                          case "modal fade bs-example-modal-md":
                              $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                              break;
                          case "modal fade bs-example-modal-sm":
                              $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                              break;
                          default:
                              $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                              break;
                      }

                      var modalDialogClass = $('#modalDialog').attr('class');
                      switch (modalDialogClass) {
                          case "modal-dialog modal-md":
                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                              break;
                          case "modal-dialog modal-sm":
                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                              break;
                          default:
                              $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                              break;
                      }
                      
                     
                    $('#modalTitle').html('Information Assignment');  
                     
                      $('#modal').data('rowID', rowID);
                      $('div.modal-body').load("<?php echo base_url("c_csassign/showinfo");?>/");

                      $('#modal').modal('show');
  }

function updateValue(rowID)
{
  document.getElementById('loader').hidden=false;
    // alert($('#assign_to_'+rowID).val());
    var assign_to = $('#assign_to_'+rowID).val();
    // $('#textboxid').val($('#selectLoco').val());
    // var entity = $('#txt_Pl_Project').val();
    // var fyear = e.params.args.data["id"];

    
     $.ajax({
                    url : "<?php echo base_url('c_csassign/updatestatus');?>",
                    type:"POST",
                    data: {rowID:rowID,
                          assign_to:assign_to
                          },
                    dataType:"json",
                    success:function(event, data){
                    // console.log(event);
                    
                    // if(event.status=="OK"){
                    // swal("Information",event.pesan,"success");
                    //     $('#modal').modal('hide');
                    //     }else{
                    //       swal("Information",event.pesan,"warning");
                    //     }
                    document.getElementById('loader').hidden=true;
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                    
                                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                    }
                    });
}

function updateStatus(rowID)
{
    var assign_to = $('#assign_to_'+rowID).val();

    
    if(assign_to==null){
        
        swal("Information", "Please Choose assign to first.", "warning");
        return;
    }

    var status = $('#status_'+rowID).val();

    // alert($('#status_'+rowID).val());
    // $('#textboxid').val($('#selectLoco').val());
    // var entity = $('#txt_Pl_Project').val();
    // var fyear = e.params.args.data["id"];
swal({
            title: "Are you sure?",
            // text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, Submit it!",
            closeOnConfirm: false
          },
          function(){
            document.getElementById('loader').hidden=false;
              $.ajax({
                    url : "<?php echo base_url('c_csassign/updatesubmit');?>",
                    type:"POST",
                    data: {rowID:rowID,
                          status:status
                          },
                    dataType:"json",
                    success:function(event, data){
                    // console.log(event);
                    
                    if(event.status=="OK"){
                            swal("Information",event.pesan,"success");
                            document.getElementById('loader').hidden=true;
                            tblcs.ajax.reload(null,true);   
                        }else{
                          swal("Information",event.pesan,"warning");
                        }
                    document.getElementById('loader').hidden=true;
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                    
                                swal("Information",textStatus+' Save : '+errorThrown,"warning");
                    }
                    });
            
          });
    
     
}

//update once the page has loaded too
// $(document).ready(function () {
//     updateValue();
// });

   
</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
   <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-right">Customer Service Assignment</div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div> <br>
         
       <!--  <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Project</label>
            <div class="col-sm-3">
                <select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="select2" style="width:250px;" tabindex="2">
                    <option value=""></option>
                   
                </select>
                
            </div>

            <div class="col-sm-6 control-label" style="margin-left: 40px">
                <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>

            </div>
        </div> -->


    </div>
    <div id="load" hidden="true"></div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body">
                        <!-- <button id="proses2" class="btn biru-bg" onclick="proses()"><i class="fa fa-envelope fa-fw"></i> <span class="hidden-xs">Process</span></button> -->
                            <table id="tblcs" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                <thead>    
                                    <th>No. Ticket</th>
                                    <th></th>
                                    <th>Tenant Name</th>   
                                    <th>Report Date</th>
                                    <th>Reported By</th> 
                                    <th>Status</th>
                                    <th>Assign To</th>      
                                    <th>Department</th>               
                                    <th>Division</th>
                                    <th>Action</th>                  
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

