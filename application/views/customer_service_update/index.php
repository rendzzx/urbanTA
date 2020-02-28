<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

<style type="text/css">
  #loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
/*div.dataTables_wrapper 
div.dataTables_filter {
    text-align: right;
    float: right;
    padding-bottom: 5px;
}*/
</style>

<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
.toolbar{padding-bottom: 10px}
.label-blue {
    background-color: #1a7bb9;
    color: #FFFFFF;
}
#tblCustUpdate tbody tr:hover {
    background-color: #e8f3fc;
    cursor:pointer;
}
</style>

<script type="text/javascript">
window.history.forward();


var tblCustUpdate;
$(function(){


   tblCustUpdate = $('#tblCustUpdate').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
            
            // searchDelay:null,
            buttons: [
//                 
                {
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                       
                    }
                },
                {
                    text: ' View', className: 'biru-bg fa fa-desktop hidden',
                    action: function () {
                      
                        var rows = tblCustUpdate.rows('.selected').indexes();
                        if (rows.length < 1) {                            
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblCustUpdate.rows(rows).data();
                        // var status = data[0].STATUS;
                        var ID = data[0].rowID_agent;                        
                        
                        
        
                        
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

                        $('#modalTitle').html('View Agent');

                        $('div.modal-body').load("<?php echo base_url("c_agent_approval/viewprofile");?>"+"/"+ID);

                        $('#modal').data('id', ID).modal('show');

                    }
                },
                
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('C_customer_service_update/getTable');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             }},           
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number",searchable:false,orderable:false } ,
            {
              // data: "rowID", name: "rowID", visible: false
              data: "status", name: "status",
                            render: function (data, type, row) {
                                
                                var warna = '';
                                var descs = '';
                                if(data=='M'){
                                    warna = 'label label-primary';
                                    descs = 'Modify';
                                }else if(data=='A'){
                                    warna = 'label label-warning';
                                    descs = 'Assign';
                                }else if(data=='S'){
                                    warna = 'label label-primary';
                                    descs = 'Survey';
                                }else if(data=='P'){
                                    warna = 'label label-blue';
                                    descs = 'Prosess';
                                }

                                return  '<span class="'+warna+'">'+descs+'</span>';
                           
                        }
           
            },            
            {
                data:"report_no",name:"report_no",
                render: function (data, type, row) {
                                
                                
                                var work_req = row.work_requested;
                              
                                return  '<span style="color:#870000; font-weight:bold;">'+data+'</span><br><span>'+work_req+'</span>';
                           
                        }
            },
            {
                data:"name",name:"name",
                render: function (data, type, row) {
                                
                                
                                var hp = row.hand_phone;
                              
                                return  '<span>'+data+'</span><br><span>'+hp+'</span>';
                           
                        }
            },             
            {data:"lot_no",name:"lot_no"},
            {data:"reported_date_string",name:"reported_date_string"}
               
            // {data:"contact_person",name:"contact_person"},          
            // {data:"status_descs",name:"status_descs"},
            // {data:"group_cd",name:"group_cd",visible:false},
            // {data:"agent_cd",name:"agent_cd",visible:false},
            // {data:"lead_cd",name:"lead_cd",visible:false},
            // {data:"status_approval",name:"status_approval",visible:false},
            // {data:"rowID_agent",name:"rowID_agent",visible:false}
            
            ]
    });
    $("div.toolbar").html('<b>Search : <input type="text" class="form-control" style="width: 150px;" id="txt_search"  name="txt_search" > <a class="btn btn-success btn-sm" onclick="fn_search();"><i class="fa fa-search"></i></a> </b>');

   
     $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        if(a==''){
            tblCustUpdate.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            
            
            tblCustUpdate.ajax.reload(null,true);   
        }
        
    });

    $(document).on('click','#tblCustUpdate td',function(e){
                var cell_clicked    = tblCustUpdate.cell(this).data();
                var row_clicked     = $(this).closest('tr');
                
                var data      = tblCustUpdate.row(row_clicked).data();
                // console.log(data);
                var rowID = data['rowID'];
                window.location.href="<?php echo base_url('C_customer_service_update/update_form');?>"+'/'+rowID;
                // alert(rowID);
           

                // var a = hasClass($('#tblnewsfeed tbody tr:eq(0)')[0],'selected');
                // var row_td = $(this)['context']._DT_CellIndex.row;

              
            });

});
function fn_search(){
    // alert('a');
    var a = $('#txt_search').val();
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                   tblCustUpdate.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
     
}

    
   
function approve(rowid){
        var id = rowid;
        var rows = tblCustUpdate.rows('.selected').indexes();      

                               
                                    var modalClass = $('#modal').attr('class');
                                    switch (modalClass) {
                                        case "modal fade bs-example-modal-lg":
                                            $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                            break;
                                        case "modal fade bs-example-modal-md":
                                            $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                            break;
                                        default:
                                            $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                            break;
                                    }

                                    var modalDialogClass = $('#modalDialog').attr('class');
                                    switch (modalDialogClass) {
                                        case "modal-dialog modal-lg":
                                            $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                            break;
                                        case "modal-dialog modal-md":
                                            $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                            break;
                                        default:
                                            $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                            break;
                                    }

                                    $('#modalTitle').html('Approve Agent');

                                    $('div.modal-body').html('Are you sure want to Approve this Agent?');

                                    $('div.modal-body').append('<div class="modal-footer"></div>');

                                    var btnYes = $('<input/>')
                                        .attr({
                                            id: "btnYes",
                                            type: "button",
                                            class: "btn btn-danger",
                                            onclick: 'Approval(\''+rowid+'\')',
                                            value: 'Yes'
                                        });

                                    var btnNo = $('<a>No</a>').attr({
                                        class: "btn btn-default", 'data-dismiss': "modal"
                                    });

                                    $('div.modal-footer').append(btnYes);
                                    $('div.modal-footer').append(btnNo);

                                    $('#modal').data('id', id).modal('show');

    }
   function Approval(id){
    // swal(id);
     document.getElementById('loader').hidden=false;
      $.ajax({
                    url : "<?php echo base_url('c_agent_approval/Approval');?>",
                    type:"POST",
                    data: { id: id},
                    dataType:"json",
                    success:function(event, data){
                        document.getElementById('loader').hidden=true;
                        console.log(event);
                        console.log(data);
                        if(event.Status !='Fail'){                          
                          swal("Information",event.Pesan,"success");
                          $('#modal').modal('hide');
                          tblCustUpdate.ajax.reload(null,true);
                        } else {
                            sweetAlert("Failed", event.Pesan, "error");
                            $('#modal').modal('hide');
                            // swal({
                            //       title: "Are you sure?",
                            //       text: event.Pesan,
                            //       type: "warning",
                            //       showCancelButton: true,
                            //       confirmButtonColor: "#DD6B55",
                            //       confirmButtonText: "Ok",
                            //       closeOnConfirm: false
                            //     });


                        
                        } 

                        tblCustUpdate.ajax.reload(null,true);  
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                        document.getElementById('loader').hidden=true;
                     swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
                    }
                    });   
         

   }
</script>
<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <div class="tittle-top pull-left"><?php echo $ProjectDescs; ?></div>
        <div class="tittle-top pull-right">Customer Service Status Update</div>
    </div>
    </section><br>
    <div id="loader" class="loader" hidden="true"></div>
    <section class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblCustUpdate" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>    
                                <th>No</th>
                                <th>Status</th>
                                <th>Ticket No</th>                                        
                                <th>Requested Name</th>
                                <th>Lot No</th> 
                                <th>Reported</th>                               
                                <!-- <th>Email</th>
                                <th>Handphone</th>
                                <th>Status</th>               -->
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Bootstrap Modal -->
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
