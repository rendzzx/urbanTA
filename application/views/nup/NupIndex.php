<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">

<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
        <h4 class="content-header-title">NUP</h4>
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
                    <b>&nbsp; NEW NUP</b>
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
                        </thead>

                        <tbody>
                            
                        </tbody>                            
                    </table>
                </div>
              </div>
           </div>
        </div>
      </div>

        <?php
                foreach($product as $row)
                {
                  // echo $row->product_cd;
                    $var ='<div class="row">';
                    $var.='<div class="col-lg-12">';
                    $var.='<div class="card">';
                    $var.='<div class="card-header">';
                    $var.='<div class="table-responsive">';                    
                    $var.='<div class="card-content">';
                    $var.='<b>&nbsp; APPROVED NUP '.$row->descs.'</b>';
                    $var.='<br/><br/>';                             
                    $var.='<table id="tblapprove'.$row->product_cd.'" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" style="position: ">';
                    $var.='<thead> ';   
                    $var.='<th>No</th>';                                        
                    $var.='<th>Name</th>';                                
                    $var.='<th>Handphone</th>';
                    $var.='<th>Email</th>';
                    $var.='<th>NUP No.</th>';
                    $var.='<th>Reserve Date</th>';
                    $var.='<th>Status</th>';
                    $var.='<th>Type</th>';
                    $var.='<th></th>';
                    $var.='</thead>';
                    $var.='<tbody>';
                    $var.='</tbody>';
                    $var.='</table>';
                    $var.='<font size="2px"><i>*Please click <b>NUP No.</b> to see "Tanda Terima Sementara" and Ticket NUP</i></font>';
                    $var.='</div>';                        
                    $var.='</div>';
                    $var.='</div>';
                    $var.='</div>';
                    $var.='</div>';            
                    $var.='</div><br>';
                    echo $var;
                }
                ?>
  </div>

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('app-assets/vendors/js/tables/jquery-1.12.3.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">
 var tblnup = $('#tblnup').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_nup/getTableHd');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.';
                }
            },
            { data: "NAME" },
            { data: "nup_no" },
            { data: "Handphone" },
            { data: "Email" },
            { data: "nup_type" },
            { data: "reserve_date" },
            { data: "STATUS" }
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
        var site_url = '<?php echo base_url("c_nup/insert")?>';
            window.location.href= site_url+"/N";

        // var url = '<?php echo base_url("c_nup/cek_agent")?>';
        // $.post(url,
        //   {status:status},
        //   function(data,status) {
        //     console.log(data);
        //     if(data == 0){
        //         swal("Information",'Only Agent can Entry NUP',"warning");
        //         return false;
        //     }
        //     window.location.href= site_url+"/N";
        //   }
        // );
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
        var site_url = '<?php echo base_url("c_nup/edit_rev")?>'+'/'+status+'/'+ID;
        window.location.href= site_url;
    })

    <?php 
    foreach ($product as $row) {
        $var = ' var tblapprove'.$row->product_cd.';';
        echo $var;
    }
     ?>

     <?php 

     foreach ($product as $row) {
         // echo $row->product_cd;
         $var ="tblapprove".$row->product_cd." = $('#tblapprove".$row->product_cd."').DataTable({";
         $var.=' "ajax":{';
         $var.=' "url": "'.base_url("c_nup/getTable/".$row->product_cd).'", ';
         $var.=' "type": "POST" ';
         $var.=' },';
         $var.='"columns": [';
         $var.=' { data: "row_number", width:"1px", searchable:false, ';
         $var.=' render: function (data, type, row){ ';
         $var.=' var row_number = row.row_number;';
         $var.=' return row_number + ".";';
         $var.=" }";
         $var.=" },";
         $var.=' { data: "NAME" },';
         $var.=' { data: "nup_no" },';
         $var.=' { data: "Handphone" },';
         $var.=' { data: "email" },';
         $var.=' { data: "nup_type" },';
         $var.=' { data: "reserve_date" },';
         $var.=' { data: "STATUS" },';
         $var.=" ],";
         $var.='"language": {';
         $var.='"decimal": ",",';
         $var.='"thousands": "."';
         $var.=" },";
         $var.=' "dom": "<\'toolbar section\'>frtip"';
         $var.=" });";
         // $var.=" $('div.section').html( ";
         // $var.="<button id='revisenup' class='btn btn-primary pull-up'>Revise</button>&nbsp;+";
         // $var.="<button id='backsection' class='btn btn-info pull-up'>Back</button>&nbsp;+" ;
         // $var.="<button id='refreshsection' class='btn btn-success pull-up'>Refresh</button>";
         // $var.=" );";


         echo $var;
     }
      ?>

//End choosen properties      
</script>

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