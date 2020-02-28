<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<style type="text/css">
    .font-color{
        color: #667;
    }
</style>
<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
        <h4 class="content-header-title">BOOKING</h4>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      </div>
    </div>
    <div class="content-body"> 
      <div class="row">      
        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <div class="card-content">
                  <!-- <?php // echo $list_nf; ?> -->
                    <b>&nbsp; NEW BOOKING</b>
                        <br/><br/>                            
                            <table id="tblnup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >                         

                                <thead>    
                                    <th>No</th>
                                    <th>Action</th>                                        
                                    <th>Name</th>                                
                                    <th>Handphone</th>
                                    <th>Email</th>
                                    <th>Reserve Date</th>
                                    <th>Status</th>
                                    <th>Type</th>  
                                    <th></th>              
                                </thead>
                                <tbody>
                                </tbody>                            
                            </table>
                        </div>                        
                    </div>
                </div>
            </div>            
        </div><br>
               
        <div class="row">      
        <div class="col-lg-12">
        <div class="card">
        <div class="card-header">
        <div class="card-content">
        <b>&nbsp; APPROVED BOOKING</b>
        <br>                             
        <table id="tblapprove" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" style="position: ">
        <thead>
        <th>No</th>                                     
        <th>Name</th>                               
        <th>Handphone</th>
        <th>Email</th>
        <th>NUP No.</th>
        <th>Reserve Date</th>
        <th>Status</th>
        <th>Type</th>
        <th></th>
        </thead>
        <tbody>
        </tbody>
        </table>
        <font size="2px"><i>*Please click <b>NUP No.</b> to see "Tanda Terima Sementara" and Ticket NUP</i></font>
        </div>                      
        </div>
        </div>
        </div>          
        </div><br>




    </div>     
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
<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modal2Dialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modal2Title"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>

    </div>
</div>


<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('app-assets/vendors/js/tables/jquery-1.12.3.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>



<script type="text/javascript">

var tblnup = $('#tblnup').DataTable({
        "ajax":{
            "url":"<?php echo base_url('c_reservation/getTableHd');?>",           
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number",searchable:false,orderable:false } , 
            {
              data: "rowID", name: "rowID",
                            render: function (data, type, row) {
                                var seq_no = row.nup_sequence_no;
                                var status = row.STATUS;


                              // return status;
                               if(status=='N' || status=='R'){
                                return  '<a class="btn btn-success btn-sm" onclick="klikcubmitnon(\''+data+'\',\''+seq_no+'\',\''+status+'\');"" ><i class="fa fa-users fa-fw"></i> Submit</a>';
                               }else{
                                return ' ';
                               }
                                
                                

                            }
            },     
            {data:"NAME",name:"NAME"},            
            {data:"Handphone",name:"Handphone"},
            {data:"Email",name:"Email"},
            {
                data:"reserve_date",name:"reserve_date",
                render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               var aa = day+"/"+month+"/"+year;
                                return aa;

                           }
            },    
            {data:"status_desc",name:"status_desc",},            
            {data:"descs",name:"descs"},
            {data:"columdef", name:"columdef"},
            {data:"business_id",name:"business_id",visible:false},
            {data:"nup_sequence_no",name:"nup_sequence_no",visible:false},
            {data:"STATUS",name:"STATUS",visible:false},
            {data:"rowID",name:"rowID",visible:false}
            
            ],
            "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });
     $("div.section").html(
        '<button id="addnup" class="btn btn-primary pull-up">New</button>&nbsp;'+
        '<button id="editsection" class="btn btn-info pull-up">Edit/Revise</button>&nbsp;'+
        '<button id="deletesection" class="btn btn-danger pull-up">Delete</button>&nbsp;'+
        '<button id="backsection" class="btn btn-warning pull-up">Back</button>&nbsp;'+
        '<button id="refreshsection" class="btn btn-success pull-up">Refresh</button>'
    );

    tblnup.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblnup.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }

        var tr = $(this).closest('tr');
        var row = tblnup.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });


    $('#addnup').click(function(){
        var status='I';
        var site_url = '<?php echo base_url("booking/insert2")?>';

        var url = '<?php echo base_url("c_reservation/cek_agent")?>';
        $.post(url,
          {status:status},
          function(data,status) {
            console.log(data);
            if(data == 0){
                swal("Information",'Only Agent can Entry NUP',"warning");
                return false;
            }
            window.location.href= site_url+"/N";
          }
        );
    })

    $('#editsection').click(function(){
        var rows = tblnup.rows('.selected').indexes();
        if (rows.length < 1) {                            
            swal("Information",'Please select a row',"warning");
            return;
        }

        var data = tblnup.rows(rows).data();
        var status = data[0].STATUS;
        var ID = data[0].rowID;                        
        var st= new Array('A','N','P','V','R');
        
        if((st.indexOf(status)) < 0 ){                            
            swal("Information",'Only Status New, Approved, Pending ',"warning");
            return;
        }
        var site_url = '<?php echo base_url("c_reservation/edit_rev")?>'+'/'+status+'/'+ID;
        window.location.href= site_url;
    });

var tblapprove = $('#tblapprove').DataTable({
        "ajax":{
            "url":"<?php echo base_url('c_reservation/getTableHd');?>",           
            "type":"POST"
        },
        "columns": [
             {data: "row_number",name:"row_number",searchable:false,orderable:false } , 
             {data:"NAME",name:"NAME"},
             {data:"Handphone",name:"Handphone"},
             {data:"Email",name:"Email"},
             {data:"nup_no",name:"nup_no"},
             {
                 data:"reserve_date",name:"reserve_date",
                 render: function (data, type, row) {

                                 var date = new Date(parseInt(data.substr(0,10)));
                                 var year =data.substr(0,4);
                                 var month=data.substr(5,2);
                                 var day =data.substr(8,2);
                               
                                var aa = day+"/"+month+"/"+year;
                                 return aa;
                             

                            }
             },
             {data:"status_desc",name:"status_desc",
                 render: function(data, type, row){
                     var stat = row.STATUS;
                     var old_status = row.old_status_desc;
                     if(stat == 'S'){
                       status_merge = data + old_status;
                     }else{
                         status_merge = data;
                     }
                     return status_merge;
                 }
             },
             {data:"descs",name:"descs"},
             {data:"columdef",name:"columdef"},
             {data:"business_id",name:"business_id",visible:false},
             {data:"nup_sequence_no",name:"nup_sequence_no",visible:false},
             {data:"STATUS",name:"STATUS",visible:false},
             {data:"rowID",name:"rowID",visible:false}
            
            ],
            "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section2">frtip'
    });
     $("div.section2").html(
        // '<button id="addnup1" class="btn btn-primary pull-up">New</button>&nbsp;'+
        '<button id="editsection1" class="btn btn-info pull-up">Revise</button>&nbsp;'+
        // '<button id="deletesection1" class="btn btn-danger pull-up">Delete</button>&nbsp;'+
        '<button id="backsection1" class="btn btn-warning pull-up">Back</button>&nbsp;'+
        '<button id="refreshsection1" class="btn btn-success pull-up">Refresh</button>');

</script>
