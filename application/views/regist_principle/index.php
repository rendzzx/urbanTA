
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
    <link href="<?=base_url('app-assets/vendors/css/select2/select2.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet">

    <style type="text/css">
      #loader{
            width:80%;
            height:100%;
            position:fixed;
            left: 9%;
            top: 1%;
           z-index: 99999;
            background:url("<?php base_url('img/loading.gif') ?>") no-repeat center center  
        }
        .dt-buttons.btn-group{
    display: block !important;
}
        /*div.dataTables_wrapper 
        div.dataTables_filter {
            text-align: right;
            float: right;
            padding-bottom: 5px;
        }*/
    </style>
<!-- end link and style -->

<!-- main content -->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <br><br>
                    <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
                    <h4 class="content-header-title">Registration Principle</h4>
                </div>
                <div id="loader" class="loader" hidden="true"></div>
                <div class="content-header-right col-md-8 col-12 mb-2">
                    <br>
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                                </li>
                                <li class="breadcrumb-item active">Sales Agent
                                </li>
                                <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Fixed Navigation
                                </li> -->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <div class="nav-vertical p-2">
                                    <ul class="nav nav-tabs nav-left flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link active"  data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Submit Principle</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Approved Principle</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" aria-controls="tab3" href="#tab3" aria-expanded="false">Cancelled Principle</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content px-1">
                                        <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="tab1">
                                            <table id="tblsubmit" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                <thead>            
                                                    <th>No</th>
                                                    <th>Registration Date</th>                      
                                                    <th>Agency Name</th> 
                                                    <th>Company Name</th> 
                                                    <th>Email Address</th>                               
                                                    <th>Contact No.</th>
                                                    <th>Contact Person</th>
                                                    <th>Details</th>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="tab2" aria-expanded="true" aria-labelledby="tab2">
                                            <table id="tblapproved" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                <thead>            
                                                    <th>No</th>
                                                    <th>Registration Date</th>                      
                                                    <th>Agency Name</th> 
                                                    <th>Company Name</th> 
                                                    <th>Email Address</th>                               
                                                    <th>Contact No.</th>
                                                    <th>Contact Person</th>
                                                    <th>Details</th>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab3" aria-labelledby="tab3">
                                            <table id="tblcancel" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                <thead>            
                                                    <th>No</th>
                                                    <th>Registration Date</th>                      
                                                    <th>Agency Name</th> 
                                                    <th>Company Name</th> 
                                                    <th>Email Address</th>                               
                                                    <th>Contact No.</th>
                                                    <th>Contact Person</th>
                                                    <th>Details</th>
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
        </div>
    </div>
<!-- end main content -->

<!-- link to js -->
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/select2/select2.full.min.js')?>"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<!-- end link to js -->

<!-- modal -->
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">              
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <img src="" class="imagepreview" style="width: 100%;" >
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->

<!-- script -->
    <script type="text/javascript">
         function zoomPic(el,type) {
                $('#modaltitle').text("Picture of " + type);
                $('#modaldialog').addClass('modal-lg');
              
                var html = 
                    '<div class="text-center">'+
                        '<img src="'+el.src+'" class="img-thumbnail img-fluid rounded w-100" alt="Member Card" style="cursor: pointer;">'+
                    '</div>';

                $('#modalbody').html(html);
          
                $('#modal').modal('show');
                $('.modal-footer').remove();
            }
        var tblsubmit, tblapproved, tblcancel;

        // ------------------------------ START TAB SUBMIT -----------------------------
            tblsubmit = $('#tblsubmit').DataTable( {
                // dom: '<"toolbar dataTables_filter">Blfrtip',
                "paging" : false,
                "ordering": false,
                "ajax" : {
                    "url" : "<?php echo base_url('c_regist_principle/getTable_submit');?>",
                    "type": "POST"
                },
                lengthMenu: [[25, 50,100, -1], [25, 50,100, "All"]],
                "pageLength": -1,
            //     buttons:[
            //     'excelHtml5',
            //  ],
                buttons: [

                {
                extend: 'collection',
                className: 'btn  fa fa-star pull-right',
                text: ' Download',
                buttons: [
                
                    {
                            extend: "csv",
                            text: "CSV",
                            exportOptions: {
                                modifier: {
                                    search: 'applied',
                                    order: 'applied',

                                },
                                columns: [ 0,2,1,3,4,5,6,8],
                                format: {
                                    header: function ( data, row, column ) {
                                       
                                            if(row==8){
                                                return 'Column ke-8';
                                            }else{
                                                return data;
                                            }
                                    }
                                }
                            }

                            
                    },
                    // {
                    //         extend: "pdf",
                    //         text: "PDF",
                    //         exportOptions: {
                    //             modifier: {
                    //                 search: 'applied',
                    //                 order: 'applied'
                    //             },
                    //                 columns: [ 0,1,2,3,4,5,6,7]
                    //         }

                            
                    // }
                    // ,
                    // {
                    //       extend: "print",
                    //       text: "Print",
                    //       exportOptions: {
                    //             modifier: {
                    //                 search: 'applied',
                    //                 order: 'applied'
                    //             },
                    //                 columns: [ 0,1,2,3,4,5,6,7]
                    //         }

                            
                    // }
                    // 'csv',
                    // 'pdf',
                    // 'print'
                            ]           
                },   
                {
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                        
                    }
                }
                
                ],
                "columns": [
                    {data: "row_number",name:"row_number", searchable:true},
                    {data: "registration_date",name:"registration_date", searchable:true, render:function(data){
                        var date = new Date(data);
                        var weekday = new Array(7);
                            weekday[0] = "Sunday";
                            weekday[1] = "Monday";
                            weekday[2] = "Tuesday";
                            weekday[3] = "Wednesday";
                            weekday[4] = "Thursday";
                            weekday[5] = "Friday";
                            weekday[6] = "Saturday";
                        var month = date.getMonth() + 1;
                        return weekday[date.getDay()] + ", "+ date.getDate() + "-" + month + "-" + date.getFullYear();
                    }},
                    {data:"agency_name",name:"agency_name", sortable: true, searchable: true},
                    {data:"company_name",name:"company_name"},
                    {data:"email_add",name:"email_add", sortable: true},
                    {data:"contact_no",name:"contact_no", sortable: true},
                    {data:"contact_person",name:"contact_person", sortable: true},
                    
                   
                    {
                        "className"         : 'details-control',
                        "orderable"         : false,
                        "data"              : null,
                        "defaultContent"    : ''
                    },
                    {data: "lead_name", name:"lead_name",visible: false},
                ],
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                },
                "dom": '<"toolbar agent">frtip'
            });

            tblsubmit.on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tblsubmit.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    // console.table(row.data());
                    row.child( showDetailSubmit(row.data()) ).show();
                    tr.addClass('shown');
                }
            });
            function formatDateDay(data){
                var date = new Date(data);
                var weekday = new Array(7);
                    weekday[0] = "Sunday";
                    weekday[1] = "Monday";
                    weekday[2] = "Tuesday";
                    weekday[3] = "Wednesday";
                    weekday[4] = "Thursday";
                    weekday[5] = "Friday";
                    weekday[6] = "Saturday";
                var month = date.getMonth() + 1;
                return weekday[date.getDay()] + ", "+ date.getDate() + "-" + month + "-" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes();
            }
            function showDetailSubmit ( d ) {
                console.table(d);
                var siup_file_url = d.siup_file_url,
                    npwp_file_url = d.npwp_file_url,
                    tdp_file_url = d.tdp_file_url,
                    skd_file_url = d.skd_file_url,
                    appp_file_url = d.appp_file_url,
                    ktp_file_url = d.ktp_file_url,
                    // default_img = 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
                    default_img = './img/noimage.png';

                // if statement
                    if (!siup_file_url) {
                        if(siup_file_url == default_img){
                            siup_file_url = default_img;
                        }
                        // siup_file_url = default_img;
                    }
                    if (!npwp_file_url) {
                        if(npwp_file_url == default_img){
                            npwp_file_url = default_img;
                        }
                        // npwp_file_url = default_img;
                    }
                    if (!tdp_file_url) {
                        if(tdp_file_url == default_img){
                            tdp_file_url = default_img;
                        }
                        // tdp_file_url = default_img;
                    }
                    if (!skd_file_url) {
                        if(skd_file_url == default_img){
                            skd_file_url = default_img;
                        }
                        // skd_file_url = default_img;
                    }
                    if (!appp_file_url) {
                        if(appp_file_url == default_img){
                            appp_file_url = default_img;
                        }
                        // appp_file_url = default_img;
                    }
                    if (!ktp_file_url) {
                        if(ktp_file_url == default_img){
                            ktp_file_url = default_img;
                        }
                        ktp_file_url = default_img;
                    }

 

                // if statement for null values
                    if (!d.agency_name) {
                        d.agency_name = '-';
                    }
                    if(!d.company_name){
                        d.company_name = '-';
                    }
                    if(!d.company_address){
                        d.company_address = '-';
                    }
                    if(!d.office_phone){
                        d.office_phone = '-';
                    }
                    if(!d.company_npwp){
                        d.company_npwp = '-';
                    }
                    if(!d.contact_no){
                        d.contact_no = '-';
                    }
                    if(!d.lead_name){
                        d.lead_name = '-';
                    }
                    if(!d.bank_name){
                        d.bank_name = '-';
                    }
                    if(!d.bank_acct_name){
                        d.bank_acct_name = '-';
                    }
                    if(!d.bank_acct_no){
                        d.bank_acct_no = '-';
                    }
                var html = 
                    '<div class="card box-shadow-0 border-info">'+
                        '<div class="card-content collapse show">'+
                            '<div class="card-body">'+

                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Detail Information</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-sm-3">'+
                                        '<span class="card-text"><b>Agency Name</span></b><br>'+
                                        '<span class="card-text"><b>Company Name</span></b><br>'+
                                        '<span class="card-text"><b>Company Address</span></b><br>'+
                                        '<span class="card-text"><b>Company NPWP</span></b><br>'+
                                        '<span class="card-text"><b>Office Phone</span></b><br>'+
                                        '<span class="card-text"><b>Contact No.</span></b><br>'+
                                        '<span class="card-text"><b>Contact Person</span></b><br>'+
                                        '<span class="card-text"><b>Lead Name</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.agency_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_address+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_npwp+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.office_phone+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.contact_no+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.contact_person+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.lead_cd+' - '+d.lead_name+'</span><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text"><b>Bank Name</span></b><br>'+
                                        '<span class="card-text"><b>Account Name</span></b><br>'+
                                        '<span class="card-text"><b>Account No</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_acct_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_acct_no+'</span><br>'+
                                    '</div>'+
                                '</div>'+

                                '<br>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Picture</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>SIUP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>TDP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                    '</div>'+

                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4">'+
                                            '<img src="'+siup_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="SIUP" style="cursor: pointer;" onClick=zoomPic(this,"SIUP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+tdp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="TDP" style="cursor: pointer;" onClick=zoomPic(this,"TDP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+npwp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="NPWP" style="cursor: pointer;" onClick=zoomPic(this,"NPWP")>'+
                                    '</div>'+

                               
                                '</div>'+
                                '<hr>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>SKD</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>APPP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>KTP</span></b><br>'+
                                    '</div>'+

                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4">'+
                                            '<img src="'+skd_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="SKD" style="cursor: pointer;" onClick=zoomPic(this,"SKD")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+appp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="APPP" style="cursor: pointer;" onClick=zoomPic(this,"APPP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+ktp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="KTP" style="cursor: pointer;" onClick=zoomPic(this,"KTP")>'+
                                    '</div>'+

                                '</div>'+
                                '<br>'+
                                '<hr>'+
                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Action</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<br>'+

                                '<div class="row">'+

                                    '<div class="col-sm-6">'+
                                        '<button onclick="approvePrinciple(\''+d.rowID+'\',\''+d.agency_name+'\')" type="button" class="btn btn-bg-gradient-x-blue-cyan btn-block">Approve</button>'+
                                    '</div>'+

                                    '<div class="col-sm-6">'+
                                      '<button onclick="cancelPrinciple(\''+d.rowID+'\',\''+d.agency_name+'\')" type="button" class="btn btn-bg-gradient-x-purple-red btn-block">Cancel</button>'+
                                    '</div>'+
                                '</div>'+

                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<br>';

                return html;
            }

            function approvePrinciple(rowID, agency_name) {
                // alert('willapprove');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will approve ("+agency_name+") to be Principle.",
                    icon: 'la-warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, approve it!'
                }).then((result) => {
                    if (result.value) {
                        approve(rowID);
                    }
                })
            }
            function cancelPrinciple(rowID, agency_name) {
                // alert('hehe');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You will cancel "+agency_name+"'s registration to become Principle.",
                    icon: 'la-warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.value) {
                        cancel(rowID);
                    }
                })
            }
            

            function approve(rowID) {
                // alert('approving');
                $.ajax({
                    url : "<?php echo base_url('c_regist_principle/approve');?>",
                    type:"POST",
                    data: { rowID: rowID },
                    dataType:"JSON",
                    success:function(event, data){
                        Swal.fire(
                            'Approved!',
                            'This registration has been approved.',
                            'success'
                        );

                        $('#modal').modal('hide');
                        
                        tblsubmit.ajax.reload(null,true);
                        tblapproved.ajax.reload(null,true);
                        // tblcancel.ajax.reload(null,true);
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){        
                        // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");
                    }
                });
            }

            function cancel(rowID){
                // alert('cancel');
                $.ajax({
                    url : "<?php echo base_url('c_regist_principle/cancel');?>",
                    type:"POST",
                    data: { rowID: rowID },
                    dataType:"JSON",
                    success:function(event, data){
                        Swal.fire(
                            'Success!',
                            'This registration has been cancelled.',
                            'success'
                        );

                        $('#modal').modal('hide');
                        
                        tblsubmit.ajax.reload(null,true);
                        // tblapproved.ajax.reload(null,true);
                        tblcancel.ajax.reload(null,true);
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){        
                        // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");
                    }
                });
            }

           
        // ------------------------------ END TAB SUBMIT  --------------------------------

        // ------------------------------ START TAB approve -----------------------------
            tblapproved = $('#tblapproved').DataTable( {
                "paging" : false,
                "ordering": false,
                "ajax" : {
                    "url" : "<?php echo base_url('c_regist_principle/getTable_approve');?>",
                    "type": "POST"
                },
                lengthMenu: [[25, 50,100, -1], [25, 50,100, "All"]],
                "pageLength": -1,
            //     buttons:[
            //     'excelHtml5',
            //  ],
                buttons: [

                {
                extend: 'collection',
                className: 'btn  fa fa-star pull-right',
                text: ' Download',
                buttons: [
                
                    {
                            extend: "csv",
                            text: "CSV",
                            exportOptions: {
                                modifier: {
                                    search: 'applied',
                                    order: 'applied',

                                },
                                columns: [ 0,2,8,9,3,10,11,15,6,5,12,13,14,4,16],
                                format: {
                                    header: function ( data, row, column ) {
                                       
                                            if(row==8){
                                                return 'Lead Code';
                                            } else if(row==9){
                                                return 'Lead Name';
                                            } else if(row==10){
                                                return 'Company NPWP';
                                            } else if(row==11){
                                                return 'Company Address'; 
                                            } else if(row==12) {
                                                return 'Bank Name';
                                            } else if(row==13) {
                                                return 'Bank Account Name';
                                            } else if(row==14) {
                                                return 'Bank Account No';
                                            } else if(row==15) {
                                                return 'Telp No';
                                            } else if(row==16) {
                                                return 'Status';
                                            } else {
                                                return data;
                                            }
                                    }
                                }
                            }

                            
                    },
                    // {
                    //         extend: "pdf",
                    //         text: "PDF",
                    //         exportOptions: {
                    //             modifier: {
                    //                 search: 'applied',
                    //                 order: 'applied'
                    //             },
                    //                 columns: [ 0,1,2,3,4,5,6,7]
                    //         }

                            
                    // }
                    // ,
                    // {
                    //       extend: "print",
                    //       text: "Print",
                    //       exportOptions: {
                    //             modifier: {
                    //                 search: 'applied',
                    //                 order: 'applied'
                    //             },
                    //                 columns: [ 0,1,2,3,4,5,6,7]
                    //         }

                            
                    // }
                    // 'csv',
                    // 'pdf',
                    // 'print'
                            ]           
                },   
                {
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left hidden', action: function (e) {
                        
                    }
                }
                
                ],
                "columns": [
                    {data: "row_number",name:"row_number", searchable:true},
                    {data: "registration_date",name:"registration_date", searchable:true, render:function(data){
                        var date = new Date(data);
                        var weekday = new Array(7);
                            weekday[0] = "Sunday";
                            weekday[1] = "Monday";
                            weekday[2] = "Tuesday";
                            weekday[3] = "Wednesday";
                            weekday[4] = "Thursday";
                            weekday[5] = "Friday";
                            weekday[6] = "Saturday";
                        var month = date.getMonth() + 1;
                        return weekday[date.getDay()] + ", "+ date.getDate() + "-" + month + "-" + date.getFullYear();
                    }},
                    {data:"agency_name",name:"agency_name", sortable: true, searchable: true},
                    {data:"company_name",name:"company_name"},
                    {data:"email_add",name:"email_add", sortable: true},
                    {data:"contact_no",name:"contact_no", sortable: true},
                    {data:"contact_person",name:"contact_person", sortable: true},
                   
                    {
                        "className"         : 'details-control',
                        "orderable"         : false,
                        "data"              : null,
                        "defaultContent"    : ''
                    },
                    {data: "lead_cd", name:"lead_cd",visible: false},
                    {data: "lead_name", name:"lead_name",visible: false},
                    {data: "company_npwp", name:"company_npwp",visible: false},
                    {data: "company_address", name:"company_address",visible: false},
                    {data: "bank_name", name:"bank_name",visible: false},
                    {data: "bank_acct_name", name:"bank_acct_name",visible: false},
                    {data: "bank_acct_no", name:"bank_acct_no",visible: false},
                    {data: "office_phone", name:"office_phone",visible: false},
                    {data: "status", name:"status",visible: false},
                ],
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                },
                "dom": '<"toolbar agent">frtip'
            });

            tblapproved.on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tblapproved.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    // console.table(row.data());
                    row.child( showDetailApprove(row.data()) ).show();
                    tr.addClass('shown');
                }
            });

            function showDetailApprove ( d ) {
                // console.table(d);
                var siup_file_url = d.siup_file_url,
                    npwp_file_url = d.npwp_file_url,
                    tdp_file_url = d.tdp_file_url,
                    skd_file_url = d.skd_file_url,
                    appp_file_url = d.appp_file_url,
                    ktp_file_url = d.ktp_file_url,
                    // default_img = 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
                    default_img = './img/noimage.png';

                // if statement
                    if (!siup_file_url) {
                        if(siup_file_url == default_img){
                            siup_file_url = default_img;
                        }
                        // siup_file_url = default_img;
                    }
                    if (!npwp_file_url) {
                        if(npwp_file_url == default_img){
                            npwp_file_url = default_img;
                        }
                        // npwp_file_url = default_img;
                    }
                    if (!tdp_file_url) {
                        if(tdp_file_url == default_img){
                            tdp_file_url = default_img;
                        }
                        // tdp_file_url = default_img;
                    }
                    if (!skd_file_url) {
                        if(skd_file_url == default_img){
                            skd_file_url = default_img;
                        }
                        // skd_file_url = default_img;
                    }
                    if (!appp_file_url) {
                        if(appp_file_url == default_img){
                            appp_file_url = default_img;
                        }
                        // appp_file_url = default_img;
                    }
                    if (!ktp_file_url) {
                        if(ktp_file_url == default_img){
                            ktp_file_url = default_img;
                        }
                        ktp_file_url = default_img;
                    }

          
                // if statement for null values
                    if (!d.agency_name) {
                        d.agency_name = '-';
                    }
                    if(!d.company_name){
                        d.company_name = '-';
                    }
                    if(!d.office_phone){
                        d.office_phone = '-';
                    }
                    if(!d.company_address){
                        d.company_address = '-';
                    }
                    if(!d.company_npwp){
                        d.company_npwp = '-';
                    }
                    if(!d.contact_no){
                        d.contact_no = '-';
                    }
                    if(!d.lead_name){
                        d.lead_name = '-';
                    }
                    if(!d.bank_name){
                        d.bank_name = '-';
                    }
                    if(!d.bank_acct_name){
                        d.bank_acct_name = '-';
                    }
                    if(!d.bank_acct_no){
                        d.bank_acct_no = '-';
                    }
                    if(!d.approve_user){
                        d.approve_user = '-';
                    }
                    if(!d.approve_date){
                        d.approve_date = '-';
                    }else{
                        d.approve_date = formatDateDay(d.approve_date);
                    }
                var html = 
                    '<div class="card box-shadow-0 border-info">'+
                        '<div class="card-content collapse show">'+
                            '<div class="card-body">'+

                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Detail Information</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-sm-3">'+
                                        '<span class="card-text"><b>Agency Name</span></b><br>'+
                                        '<span class="card-text"><b>Company Name</span></b><br>'+
                                        '<span class="card-text"><b>Company Address</span></b><br>'+
                                        '<span class="card-text"><b>Company NPWP</span></b><br>'+
                                        '<span class="card-text"><b>Office Phone</span></b><br>'+
                                        '<span class="card-text"><b>Contact No.</span></b><br>'+
                                        '<span class="card-text"><b>Contact Person</span></b><br>'+
                                        '<span class="card-text"><b>Lead Name</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.agency_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_address+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_npwp+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.office_phone+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.contact_no+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.contact_person+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.lead_cd+' - '+d.lead_name+'</span><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text"><b>Bank Name</span></b><br>'+
                                        '<span class="card-text"><b>Account Name</span></b><br>'+
                                        '<span class="card-text"><b>Account No</span></b><br><br>'+
                                        '<span class="card-text"><b>Approved By</span></b><br>'+
                                        '<span class="card-text"><b>Approved Date</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_acct_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_acct_no+'</span><br><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.approve_user+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.approve_date+'</span><br>'+
                                    '</div>'+
                                '</div>'+

                                '<br>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Picture</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>SIUP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>TDP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                    '</div>'+

                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4">'+
                                            '<img src="'+siup_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="SIUP" style="cursor: pointer;" onClick=zoomPic(this,"SIUP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+tdp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="TDP" style="cursor: pointer;" onClick=zoomPic(this,"TDP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+npwp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="NPWP" style="cursor: pointer;" onClick=zoomPic(this,"NPWP")>'+
                                    '</div>'+

                               
                                '</div>'+
                                '<hr>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>SKD</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>APPP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>KTP</span></b><br>'+
                                    '</div>'+

                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4">'+
                                            '<img src="'+skd_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="SKD" style="cursor: pointer;" onClick=zoomPic(this,"SKD")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+appp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="APPP" style="cursor: pointer;" onClick=zoomPic(this,"APPP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+ktp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="KTP" style="cursor: pointer;" onClick=zoomPic(this,"KTP")>'+
                                    '</div>'+
                                    
                                '</div>'+

                                // '<div class="row">'+
                                //     '<div class="col-sm-12">'+
                                //         '<span class="card-text"><b>Action</b></span><br>'+
                                //         '<hr>'+
                                //     '</div>'+
                                // '</div>'+

                                // '<br>'+

                                // '<div class="row">'+

                                //     '<div class="col-sm-6">'+
                                //         '<button onclick=addProject("'+d.rowID+'","'+d.status+'") type="button" class="btn btn-bg-gradient-x-blue-cyan btn-block">Approve</button>'+
                                //     '</div>'+

                                //     '<div class="col-sm-6">'+
                                //       '<button onclick="declineAgent('+d.rowID+')" type="button" class="btn btn-bg-gradient-x-purple-red btn-block">Cancel</button>'+
                                //     '</div>'+
                                // '</div>'+

                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<br>';

                return html;
            }

       
        // ------------------------------ END TAB approve --------------------------------

        // ------------------------------ START TAB cancel ------------------------------
            tblcancel = $('#tblcancel').DataTable( {
                "paging" : false,
                "ordering": false,
                "ajax" : {
                    "url" : "<?php echo base_url('c_regist_principle/getTable_cancel');?>",
                    "type": "POST"
                },
                "columns": [
                    {data: "row_number",name:"row_number", searchable:true},
                    {data: "registration_date",name:"registration_date", searchable:true, render:function(data){
                        var date = new Date(data);
                        var weekday = new Array(7);
                            weekday[0] = "Sunday";
                            weekday[1] = "Monday";
                            weekday[2] = "Tuesday";
                            weekday[3] = "Wednesday";
                            weekday[4] = "Thursday";
                            weekday[5] = "Friday";
                            weekday[6] = "Saturday";
                        var month = date.getMonth() + 1;
                        return weekday[date.getDay()] + ", "+ date.getDate() + "-" + month + "-" + date.getFullYear();
                    }},
                    {data:"agency_name",name:"agency_name", sortable: true, searchable: true},
                    {data:"company_name",name:"company_name"},
                    {data:"email_add",name:"email_add", sortable: true},
                    {data:"contact_no",name:"contact_no", sortable: true},
                    {data:"contact_person",name:"contact_person", sortable: true},
                   
                    {
                        "className"         : 'details-control',
                        "orderable"         : false,
                        "data"              : null,
                        "defaultContent"    : ''
                    }
                ],
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                },
                "dom": '<"toolbar agent">frtip'
            });

            tblcancel.on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tblcancel.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    // console.table(row.data());
                    row.child( showDetailCancel(row.data()) ).show();
                    tr.addClass('shown');
                }
            });

            function showDetailCancel ( d ) {
                // console.table(d);
                var siup_file_url = d.siup_file_url,
                    npwp_file_url = d.npwp_file_url,
                    tdp_file_url = d.tdp_file_url,
                    skd_file_url = d.skd_file_url,
                    appp_file_url = d.appp_file_url,
                    ktp_file_url = d.ktp_file_url,
                    // default_img = 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';

                    default_img = './img/noimage.png';

                // if statement
                    if (!siup_file_url) {
                        if(siup_file_url == default_img){
                            siup_file_url = default_img;
                        }
                        // siup_file_url = default_img;
                    }
                    if (!npwp_file_url) {
                        if(npwp_file_url == default_img){
                            npwp_file_url = default_img;
                        }
                        // npwp_file_url = default_img;
                    }
                    if (!tdp_file_url) {
                        if(tdp_file_url == default_img){
                            tdp_file_url = default_img;
                        }
                        // tdp_file_url = default_img;
                    }
                    if (!skd_file_url) {
                        if(skd_file_url == default_img){
                            skd_file_url = default_img;
                        }
                        // skd_file_url = default_img;
                    }
                    if (!appp_file_url) {
                        if(appp_file_url == default_img){
                            appp_file_url = default_img;
                        }
                        // appp_file_url = default_img;
                    }
                    if (!ktp_file_url) {
                        if(ktp_file_url == default_img){
                            ktp_file_url = default_img;
                        }
                        ktp_file_url = default_img;
                    }

                // if statement for null values
                    if (!d.agency_name) {
                        d.agency_name = '-';
                    }
                    if(!d.company_name){
                        d.company_name = '-';
                    }
                    if(!d.company_address){
                        d.company_address = '-';
                    }
                    if(!d.office_phone){
                        d.office_phone = '-';
                    }
                    if(!d.company_npwp){
                        d.company_npwp = '-';
                    }
                    if(!d.contact_no){
                        d.contact_no = '-';
                    }
                    if(!d.lead_name){
                        d.lead_name = '-';
                    }
                    if(!d.bank_name){
                        d.bank_name = '-';
                    }
                    if(!d.bank_acct_name){
                        d.bank_acct_name = '-';
                    }
                    if(!d.bank_acct_no){
                        d.bank_acct_no = '-';
                    }
                     if(!d.approve_user){
                        d.approve_user = '-';
                    }
                    if(!d.approve_date){
                        d.approve_date = '-';
                    }else{
                        d.approve_date = formatDateDay(d.approve_date);
                    }
                var html = 
                    '<div class="card box-shadow-0 border-info">'+
                        '<div class="card-content collapse show">'+
                            '<div class="card-body">'+

                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Detail Information</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-sm-3">'+
                                        '<span class="card-text"><b>Agency Name</span></b><br>'+
                                        '<span class="card-text"><b>Company Name</span></b><br>'+
                                        '<span class="card-text"><b>Company Address</span></b><br>'+
                                        '<span class="card-text"><b>Company NPWP</span></b><br>'+
                                        '<span class="card-text"><b>Office Phone</span></b><br>'+
                                        '<span class="card-text"><b>Contact No.</span></b><br>'+
                                        '<span class="card-text"><b>Contact Person</span></b><br>'+
                                        '<span class="card-text"><b>Lead Name</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.agency_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_address+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.company_npwp+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.office_phone+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.contact_no+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.contact_person+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.lead_cd+' - '+d.lead_name+'</span><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text"><b>Bank Name</span></b><br>'+
                                        '<span class="card-text"><b>Account Name</span></b><br>'+
                                        '<span class="card-text"><b>Account No</span></b><br><br>'+
                                        '<span class="card-text"><b>Cancelled By</span></b><br>'+
                                        '<span class="card-text"><b>Cancelled Date</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-3">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_acct_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.bank_acct_no+'</span><br><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.approve_user+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.approve_date+'</span><br>'+
                                    '</div>'+
                                '</div>'+

                                '<br>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Picture</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>SIUP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>TDP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                    '</div>'+

                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4">'+
                                            '<img src="'+siup_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="SIUP" style="cursor: pointer;" onClick=zoomPic(this,"SIUP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+tdp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="TDP" style="cursor: pointer;" onClick=zoomPic(this,"TDP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+npwp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="NPWP" style="cursor: pointer;" onClick=zoomPic(this,"NPWP")>'+
                                    '</div>'+

                               
                                '</div>'+
                                '<hr>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>SKD</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>APPP</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4 text-center">'+
                                        '<span class="card-text"><b>KTP</span></b><br>'+
                                    '</div>'+

                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-4">'+
                                            '<img src="'+skd_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="SKD" style="cursor: pointer;" onClick=zoomPic(this,"SKD")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+appp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="APPP" style="cursor: pointer;" onClick=zoomPic(this,"APPP")>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                            '<img src="'+ktp_file_url+'" class="img-thumbnail img-fluid rounded w-100" alt="KTP" style="cursor: pointer;" onClick=zoomPic(this,"KTP")>'+
                                    '</div>'+
                                    
                                '</div>'+

                                // '<div class="row">'+
                                //     '<div class="col-sm-12">'+
                                //         '<span class="card-text"><b>Action</b></span><br>'+
                                //         '<hr>'+
                                //     '</div>'+
                                // '</div>'+

                                // '<br>'+

                                // '<div class="row">'+

                                //     '<div class="col-sm-6">'+
                                //         '<button onclick=addProject("'+d.rowID+'","'+d.status+'") type="button" class="btn btn-bg-gradient-x-blue-cyan btn-block">Approve</button>'+
                                //     '</div>'+

                                //     '<div class="col-sm-6">'+
                                //       '<button onclick="declineAgent('+d.rowID+')" type="button" class="btn btn-bg-gradient-x-purple-red btn-block">Cancel</button>'+
                                //     '</div>'+
                                // '</div>'+

                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<br>';

                return html;
            }


        // ------------------------------ END TAB HISTORY REGIST AGENT --------------------------------
    </script>
<!-- end script