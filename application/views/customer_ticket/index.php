<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>



<style type="text/css">
  #load{
    width:100%;
    height:100%;
    position:fixed;
    left: 9%;
    top: 1%;
   z-index: 99999;
    background:url("../img/loading.gif") no-repeat center center     
}
.toolbar{padding-bottom: 10px}
.label-blue {
    background-color: #1a7bb9;
    color: #FFFFFF;
}
#tableLatestTicket tbody tr:hover {
    background-color: #e8f3fc;
    cursor:pointer;
}

#billingoutstanding tbody tr:hover {
    background-color: #e8f3fc;
    cursor:pointer;
}
.top-navigation .nav > li.active > a {
    background: #F5F5F6;
    border-bottom: 1px solid #F5F5F6;
}

.mbal_amt {
                text-align: right;
            }

.clickable{
    cursor: pointer;   
}

.panel-heading span {
    margin-top: -20px;
    font-size: 15px;
}
th{
    color: #1c84c6;
}
</style>

<script type="text/javascript">
window.history.forward();


var tableLatestTicket;

$(function(){
$('.select2').select2();

   tableLatestTicket = $('#tableLatestTicket').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            // responsive: true,
            responsive: {
                    details: {
                        type: 'column',
                        target: 8
                    }
                },
            select: true,
            filter:false,
            buttons: [
//                 
                {
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                       
                    }
                }
                
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_ticket_history/tableLatestTicket');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             },
         "debtor_acct": function(d){
                var a = $('#debtor_name').val();
                // console.log(a);
                var b ="all";
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
              data: "status", name: "status",
                            render: function (data, type, row) {
                                
                                var warna = '';
                                var descs = '';
                                if(data=='M'){
                                    warna = 'label label-purple';
                                    descs = 'Modify';
                                }else if(data=='A'){
                                    warna = 'label label-warning';
                                    descs = 'Assign';
                                }else if(data=='S'){
                                    warna = 'label label-purple';
                                    descs = 'Survey';
                                }else if(data=='P'){
                                    warna = 'label label-blue';
                                    descs = 'Prosess';
                                }
                                else if(data=='R'){
                                    warna = 'label label-primary';
                                    descs = 'Open';
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
                data:"category_descs",name:"category_descs"
               
            },
            {
                data:"name",name:"name",
                render: function (data, type, row) {
                                
                                
                                var hp = row.hand_phone;
                              
                                return  '<span>'+data+'</span><br><span>'+hp+'</span>';
                           
                        }
            },             
            {data:"lot_no",name:"lot_no"},
            {data:"reported_date_string",name:"reported_date_string"},
            {
                data:"report_no",name:"report_no",
                render: function (data, type, row) {
                                
                                var rowid = row.rowID;
                                var complain = row.complain_no;
                                var debtor = row.debtor_acct;
                                return  '<button class="btn btn-primary" onclick="editticket(\''+rowid+'\')">Edit</button>&nbsp;<button class="btn btn-primary" onclick="viewticket(\''+rowid+'\')">View</button>';
                           
                        }
            },
            {data:"columdef",name:"columdef"},
            {data:"rowID",name:"rowID",visible:false},
            {data:"debtor_acct",name:"debtor_acct",visible:false},
            {data:"complain_no",name:"complain_no",visible:false}
               

            
            ],
            "columnDefs": [ {
                    className: 'control',
                    orderable: false,
                    targets:   8
                } ]
    });
    

});

function viewticket(rowid){
    // alert(ticketno);
    window.location.href="<?php echo base_url('c_ticket_history/viewticket/')?>"+rowid;
}
function editticket(rowid){
    // alert(ticketno);
    window.location.href="<?php echo base_url('c_ticket_history/editticket/')?>"+rowid;
}
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }

</script>

<!-- <div class="row"   id="chartt">  -->
<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <!-- <div class="tittle-top pull-left" ><?php echo $ProjectDescs; ?></div> -->
        <div class="judulprojek" ><?php echo $ProjectDescs; ?></div>
        <div class="tittle-top pull-right" >Ticket History</div>
    </div>
    <br>
    <div class="form-group">
        <br>
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;font-size: 14px;">Customer</label>
            <div class="col-sm-2">
                <select name="debtor_name" id="debtor_name" data-placeholder="Select Debtor." class="select2" style="width:250px;" tabindex="2">
                    <option value=""></option>
                    <?php echo $dtdebtor?>   
                    
                </select>
                
            </div>
            <br>
        </div>

    </section><br>
    <div id="loader" class="loader" hidden="true"></div>


    <section class="content" >
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
         
                <div class="ibox-content">
                   
                    <div class="table-responsive">
                        <table id="tableLatestTicket" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>    
                                <th>No</th>
                                <th>Status</th>
                                <th>Ticket No</th> 
                                <th>Category</th>                                       
                                <th>Requested Name</th>
                                <th>Lot No</th> 
                                <th>Reported Date</th>                               
                                <th>Action</th>
                                <th></th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
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

<script type="text/javascript">
var isdebtor = '<?php echo $ddx;?>';
$('#debtor_name').prop("disabled",<?php echo $ddx;?>);


    $('#debtor_name').change(function(){
        // alert('a');
    
        var businessid = $(this).find(':selected').data('businessid');
        var debtor= $(this).find(':selected').val();
   
            tableLatestTicket.ajax.reload(null,true);     
    });


</script>
