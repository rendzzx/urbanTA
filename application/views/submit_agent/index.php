<!-- link and style -->
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
                    <h4 class="content-header-title">Registration Agent</h4>
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
                                            <a class="nav-link active"  data-toggle="tab" aria-controls="tab1" href="#tab1" aria-expanded="true">Submit Regist Agent</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">Decline Regist Agent</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" aria-controls="tab3" href="#tab3" aria-expanded="false">History Regist Agent</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content px-1">
                                        <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="tab1">
                                            <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                <thead>            
                                                    <th>No</th>
                                                    <th>Registration Date</th>                      
                                                    <th>Full Name</th> 
                                                    <th>Email Address</th>                               
                                                    <th>Handphone</th>
                                                    <th>Project</th>
                                                    <th>Details</th>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div role="tabpanel" class="tab-pane" id="tab2" aria-expanded="true" aria-labelledby="tab2">
                                            <table id="tbldeclineagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                <thead>            
                                                    <th>No</th>
                                                    <th>Registration Date</th>                      
                                                    <th>Full Name</th> 
                                                    <th>Email Address</th>                               
                                                    <th>Handphone</th>
                                                    <th>Project</th>
                                                    <th>Details</th>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="tab3" aria-labelledby="tab3">
                                            <table id="tblhisagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                <thead>            
                                                    <th>No</th>
                                                    <th>Registration Date</th>                      
                                                    <th>Full Name</th> 
                                                    <th>Email Address</th>                               
                                                    <th>Handphone</th>
                                                    <th>Project</th>
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
        var tblagent, tbldeclineagent, tblhisagent;

        // ------------------------------ START TAB SUBMIT REGIST AGENT -----------------------------
            tblagent = $('#tblagent').DataTable( {
                "paging" : false,
                "ordering": false,
                "ajax" : {
                    "url" : "<?php echo base_url('c_submit_agent/getTable');?>",
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
                    {data:"full_name",name:"full_name", sortable: true, searchable: true},
                    {data:"email_add",name:"email_add"},
                    {data:"handphone1",name:"handphone1", sortable: true},
                    {data:"project_choosen",name:"project_choosen", searchable:false,sortable:false,
                        render: function (data,type,row){
                            x= data;
                            var cc = '';
                            xArray =x.split(',');
                            $.each(xArray, function(index,value) {
                                cc = cc + value + '<br>';
                            });
                            return cc;
                        }
                    },
                    // not used
                        // {data:"group_type",name:"group_type", sortable: true, render:function(data,type, row){
                            // var inhs = "INHOUSE";
                            // var frlc = "MEMBER";
                            // if (data == "I"){
                            //     return inhs;
                            // }else{
                            //     return frlc;
                            // }
                        // }},
                        // {data:"descs",name:"descs"},
                        // {data:"nik",name:"nik", sortable: true},
                        // {data:"file_url",name:"file_url", render:function(data, type, row){
                            // return '<img src="'+data+'" height = "10%" width = "10%"/>';
                        // }},
                    // end not used
                    // {data: "email_add", name: "email_add",
                    //     render: function (data, type, row) {
                    //         var emails = row.email_add;
                    //         var statuss = row.statuss;
                            
                    //         if (statuss == "N"){
                    //             return  '<a class="btn btn-danger btn-sm" disabled="true"><i class="fa fa-trash fa-fw"></i> Decline</a>';
                    //         }
                    //         return  '<a class="btn btn-danger btn-sm" id="btn_delete" onclick="deletest(\''+emails+'\');" ><i class="fa fa-trash fa-fw"></i> Decline</a>';
                    //     }
                    // },
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

            tblagent.on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tblagent.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    // console.table(row.data());
                    row.child( showDetailAgent(row.data()) ).show();
                    tr.addClass('shown');
                }
            });

            function showDetailAgent ( d ) {
                // console.table(d);
                var file_url_m = d.file_url,
                    npwp_file_url_m = d.npwp_file_url,
                    member_file_url_m = d.member_file_url,
                    saving_file_url_m = d.saving_file_url,
                    // default_img = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';
                    default_img = "./img/noimage.png";

                // if statement
                    if (!file_url_m) {
                        if(file_url_m == default_img){
                            file_url_m = default_img;
                        }
                        
                    }
                    if (!npwp_file_url_m) {
                        if(npwp_file_url_m == default_img){
                            npwp_file_url_m = default_img;
                        }
                        // npwp_file_url_m = default_img;
                    }
                    if (!member_file_url_m) {
                        if(member_file_url_m == default_img){
                            member_file_url_m = default_img;
                        }
                        // member_file_url_m = default_img;
                    }
                    if (!saving_file_url_m) {
                        if(saving_file_url_m == default_img){
                            saving_file_url_m = default_img;
                        }
                        // saving_file_url_m = default_img;
                    }

                // if statement for group type
                    if (d.group_type == 'I') {
                        d.group_type = 'Inhouse';
                    }else{
                        d.group_type = 'Member';
                    }

                // if statement for null values
                    if (!d.nik) {
                        d.nik = '-';
                    }
                    if(!d.npwp){
                        d.npwp = '-';
                    }
                    if(!d.transfer_bank_name){
                        d.transfer_bank_name = '-';
                    }
                    if(!d.transfer_name){
                        d.transfer_name = '-';
                    }
                    if(!d.transfer_acct_no){
                        d.transfer_acct_no = '-';
                    }
                    if(!d.group_cd){
                        d.group_cd = '-';
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
                                    '<div class="col-sm-2">'+
                                        '<span class="card-text"><b>ID No</span></b><br>'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                        '<span class="card-text"><b>Bank Name</span></b><br>'+
                                        '<span class="card-text"><b>Account Name</span></b><br>'+
                                        '<span class="card-text"><b>Account No</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.nik+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.npwp+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_bank_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_acct_no+'</span><br>'+
                                    '</div>'+

                                    '<div class="col-sm-2">'+
                                        '<span class="card-text"><b>Group Type</b></span><br>'+
                                        '<span class="card-text"><b>Group Code</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.group_type+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.group_cd+' - '+d.group_name+'</span><br>'+
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
                                    '<div class="col-sm-6 text-center">'+
                                        '<span class="card-text"><b>ID Card</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-6 text-center">'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                    '</div>'+

                                    // '<div class="col-sm-3 text-center">'+
                                    //     '<span class="card-text"><b>Member Card</span></b><br>'+
                                    // '</div>'+

                                    // '<div class="col-sm-3 text-center">'+
                                    //     '<span class="card-text"><b>Saving Book</span></b><br>'+
                                    // '</div>'+
                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-6">'+
                                        '<a onClick=zoomPic("'+d.rowID+'","ID")>'+
                                        // /Volumes/d$/xampp/htdocs/urban/img/noimage.png
                                        // onerror="this.onerror=null;this.src='img/noimage.png';"
                                            '<img src="'+file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="ID card" style="cursor: pointer;" id="ktp">'+
                                        '</a>'+
                                    '</div>'+

                                    '<div class="col-sm-6">'+
                                        '<a onClick=zoomPic("'+d.rowID+'","NPWP")>'+
                                        // <img id="currentPhoto" src="SomeImage.jpg" onerror="this.onerror=null; this.src='Default.jpg'" alt="" width="100" height="120">

                                            '<img src="'+npwp_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="NPWP" style="cursor: pointer;">'+
                                        '</a>'+
                                    '</div>'+

                                    // '<div class="col-sm-3">'+
                                    //     '<a onClick=zoomPic("'+d.rowID+'","Member")>'+
                                    //         '<img src="'+member_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="Member Card" style="cursor: pointer;">'+
                                    //     '</a>'+
                                    // '</div>'+

                                    // '<div class="col-sm-3">'+
                                    //     '<a onClick=zoomPic("'+d.rowID+'","Saving")>'+
                                    //         '<img src="'+saving_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="Saving Book" style="cursor: pointer;">'+
                                    //     '</a>'+
                                    // '</div>'+
                                '</div>'+

                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Action</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<br>'+

                                '<div class="row">'+

                                    '<div class="col-sm-6">'+
                                        '<button onclick=verifyProject("'+d.rowID+'","'+d.email_add+'") type="button" class="btn btn-bg-gradient-x-blue-cyan btn-block">Verify Project</button>'+
                                    '</div>'+

                                    // '<div class="col-sm-6">'+
                                    //     '<button onclick=addProject("'+d.rowID+'","'+d.status+'") type="button" class="btn btn-bg-gradient-x-blue-cyan btn-block">Add Project</button>'+
                                    // '</div>'+

                                    '<div class="col-sm-6">'+
                                      '<button onclick="declineAgent('+d.rowID+')" type="button" class="btn btn-bg-gradient-x-purple-red btn-block">Decline</button>'+
                                    '</div>'+
                                '</div>'+

                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<br>';

                return html;
            }

            function verifyProject(rowID, email){
                $('#modaldialog').addClass('modal-lg');
                $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
                $('#modaltitle').addClass('white');
                $('#modaltitle').html('Verify Project');
                $('#modalbody').load("<?php echo base_url("c_submit_agent/verifyproject/")?>"+rowID+"/"+email);
                $('#modal').data('email', email);
                $('#modal').modal('show');
            }

            function addProject(rowID, status){

                $('#modaldialog').addClass('modal-lg');
                $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
                $('#modaltitle').addClass('white');
                $('#modaltitle').html('Detail Submit Registration Agent');
                $('#modalbody').load("<?php echo base_url("c_submit_agent/addnew/")?>"+rowID+"/"+status);
                $('#modal').data('rowID', 0);
                $('#modal').modal('show');
            }

            function declineAgent(rowID) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'la-warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, declined it!'
                }).then((result) => {
                    if (result.value) {
                        decline(rowID,tblagent);
                    }
                })
            }

            function decline(rowID,tblagent){
                $.ajax({
                    url : "<?php echo base_url('c_submit_agent/decline');?>",
                    type:"POST",
                    data: { rowID: rowID },
                    dataType:"JSON",
                    success:function(event, data){
                        Swal.fire(
                            'Declined!',
                            'Your file has been declined.',
                            'success'
                        );

                        $('#modal').modal('hide');
                        
                        tblagent.ajax.reload(null,true);
                        tbldeclineagent.ajax.reload(null,true);
                        tblhisagent.ajax.reload(null,true);
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){        
                        // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");
                    }
                });
            }

            function zoomPic(id,type) {
                $('#modaltitle').text("Picture of " +type + " Card");
                $('#modaldialog').addClass('modal-lg');
                $.getJSON("<?= base_url('c_submit_agent/getPict') ?>" +"/"+ id +"/"+ type, function(data) {
                    var html = 
                        '<div class="text-center">'+
                            '<img src="'+data[0].url+'" class="img-thumbnail img-fluid rounded w-100" alt="Member Card" style="cursor: pointer;">'+
                        '</div>';

                    $('#modalbody').html(html);
                });
                $('#modal').modal('show');
                $('.modal-footer').remove();
            }
        // ------------------------------ END TAB SUBMIT REGIST AGENT --------------------------------

        // ------------------------------ START TAB DECLINE REGIST AGENT -----------------------------
            tbldeclineagent = $('#tbldeclineagent').DataTable( {
                "paging" : false,
                "ordering": false,
                "ajax" : {
                    "url" : "<?php echo base_url('c_submit_agent/getTableDecline');?>",
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
                    {data:"full_name",name:"full_name", sortable: true, searchable: true},
                    {data:"email_add",name:"email_add"},
                    {data:"handphone1",name:"handphone1", sortable: true},
                    {data:"project_choosen",name:"project_choosen", searchable:false,sortable:false,
                        render: function (data,type,row){
                            x= data;
                            var cc = '';
                            xArray =x.split(',');
                            $.each(xArray, function(index,value) {
                                cc = cc + value + '<br>';
                            });
                            return cc;
                        }
                    },
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

            tbldeclineagent.on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tbldeclineagent.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    console.table(row.data());
                    row.child( showDetailDeclineAgent(row.data()) ).show();
                    tr.addClass('shown');
                }
            });

            function showDetailDeclineAgent ( d ) {
                // console.table(d);
                var file_url_m = d.file_url,
                    npwp_file_url_m = d.npwp_file_url,
                    member_file_url_m = d.member_file_url,
                    saving_file_url_m = d.saving_file_url,
                    // default_img = 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
                    default_img = "./img/noimage.png";
                    
                    // if statement
                        if (!file_url_m) {
                            if(file_url_m == default_img){
                                file_url_m = default_img;
                            }
                            
                        }
                        if (!npwp_file_url_m) {
                            if(npwp_file_url_m == default_img){
                                npwp_file_url_m = default_img;
                            }
                            // npwp_file_url_m = default_img;
                        }
                        if (!member_file_url_m) {
                            if(member_file_url_m == default_img){
                                member_file_url_m = default_img;
                            }
                            // member_file_url_m = default_img;
                        }
                        if (!saving_file_url_m) {
                            if(saving_file_url_m == default_img){
                                saving_file_url_m = default_img;
                            }
                            // saving_file_url_m = default_img;
                        }

                // if statement for group type
                    if (d.group_type == 'I') {
                        d.group_type = 'Inhouse';
                    }else{
                        d.group_type = 'Member';
                    }

                // if statement for null values
                    if (!d.nik) {
                        d.nik = '-';
                    }
                    if(!d.npwp){
                        d.npwp = '-';
                    }
                    if(!d.transfer_bank_name){
                        d.transfer_bank_name = '-';
                    }
                    if(!d.transfer_name){
                        d.transfer_name = '-';
                    }
                    if(!d.transfer_acct_no){
                        d.transfer_acct_no = '-';
                    }
                    if(!d.group_cd){
                        d.group_cd = '-';
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
                                    '<div class="col-sm-2">'+
                                        '<span class="card-text"><b>ID No</span></b><br>'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                        '<span class="card-text"><b>Bank Name</span></b><br>'+
                                        '<span class="card-text"><b>Account Name</span></b><br>'+
                                        '<span class="card-text"><b>Account No</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.nik+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.npwp+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_bank_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_acct_no+'</span><br>'+
                                    '</div>'+

                                    '<div class="col-sm-2">'+
                                        '<span class="card-text"><b>Group Type</b></span><br>'+
                                        '<span class="card-text"><b>Group Code</span></b><br><br>'+
                                        '<span class="card-text"><b>Declined By</span></b><br>'+
                                        '<span class="card-text"><b>Declined Date</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.group_type+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.group_cd+'</span><br><br>'+
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
                                    '<div class="col-sm-6 text-center">'+
                                        '<span class="card-text"><b>ID Card</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-6 text-center">'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                    '</div>'+

                                    // '<div class="col-sm-3 text-center">'+
                                    //     '<span class="card-text"><b>Member Card</span></b><br>'+
                                    // '</div>'+

                                    // '<div class="col-sm-3 text-center">'+
                                    //     '<span class="card-text"><b>Saving Book</span></b><br>'+
                                    // '</div>'+
                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-6">'+
                                        '<a onClick=zoomDeclinePic("'+d.rowID+'","ID")>'+
                                            '<img src="'+file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="ID card" style="cursor: pointer;">'+
                                        '</a>'+
                                    '</div>'+

                                    '<div class="col-sm-6">'+
                                        '<a onClick=zoomDeclinePic("'+d.rowID+'","NPWP")>'+
                                            '<img src="'+npwp_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="NPWP" style="cursor: pointer;">'+
                                        '</a>'+
                                    '</div>'+

                                    // '<div class="col-sm-3">'+
                                    //     '<a onClick=zoomDeclinePic("'+d.rowID+'","Member")>'+
                                    //         '<img src="'+member_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="Member Card" style="cursor: pointer;">'+
                                    //     '</a>'+
                                    // '</div>'+

                                    // '<div class="col-sm-3">'+
                                    //     '<a onClick=zoomDeclinePic("'+d.rowID+'","Saving")>'+
                                    //         '<img src="'+saving_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="Saving Book" style="cursor: pointer;">'+
                                    //     '</a>'+
                                    // '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<br>';

                return html;
            }

            function zoomDeclinePic(id,type) {
                $('#modaltitle').text("Picture of " +type + " Card");
                $('#modaldialog').addClass('modal-lg');
                $.getJSON("<?= base_url('c_submit_agent/getPictDecline') ?>" +"/"+ id +"/"+ type, function(data) {
                    console.table(data);
                    var html = 
                        '<div class="text-center">'+
                            '<img src="'+data[0].url+'" class="img-thumbnail img-fluid rounded w-100" alt="Member Card" style="cursor: pointer;">'+
                        '</div>';

                    $('#modalbody').html(html);
                });
                $('#modal').modal('show');
                $('.modal-footer').remove();
            }
        // ------------------------------ END TAB DECLINE REGIST AGENT --------------------------------

        // ------------------------------ START TAB HISTORY REGIST AGENT ------------------------------
            tblhisagent = $('#tblhisagent').DataTable( {
                "paging" : false,
                "ordering": false,
                "ajax" : {
                    "url" : "<?php echo base_url('c_submit_agent/getTableHistory');?>",
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
                    {data:"full_name",name:"full_name", sortable: true, searchable: true},
                    {data:"email_add",name:"email_add"},
                    {data:"handphone1",name:"handphone1", sortable: true},
                    {data:"project_choosen",name:"project_choosen", searchable:false,sortable:false,
                        render: function (data,type,row){
                            x= data;
                            var cc = '';
                            xArray =x.split(',');
                            $.each(xArray, function(index,value) {
                                cc = cc + value + '<br>';
                            });
                            return cc;
                        }
                    },
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

            tblhisagent.on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = tblhisagent.row( tr );

                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    // console.table(row.data());
                    row.child( showDetailHistoryAgent(row.data()) ).show();
                    tr.addClass('shown');
                }
            });

            function showDetailHistoryAgent ( d ) {
                // console.table(d);
                var file_url_m = d.file_url,
                    npwp_file_url_m = d.npwp_file_url,
                    member_file_url_m = d.member_file_url,
                    saving_file_url_m = d.saving_file_url,
                    // default_img = 'https://upload.wikimedia.org/wikipedia/commons/a/ac/No_image_available.svg';
                    default_img = "./img/noimage.png";
                    
                    // if statement
                        if (!file_url_m) {
                            if(file_url_m == default_img){
                                file_url_m = default_img;
                            }
                            
                        }
                        if (!npwp_file_url_m) {
                            if(npwp_file_url_m == default_img){
                                npwp_file_url_m = default_img;
                            }
                            // npwp_file_url_m = default_img;
                        }
                        if (!member_file_url_m) {
                            if(member_file_url_m == default_img){
                                member_file_url_m = default_img;
                            }
                            // member_file_url_m = default_img;
                        }
                        if (!saving_file_url_m) {
                            if(saving_file_url_m == default_img){
                                saving_file_url_m = default_img;
                            }
                            // saving_file_url_m = default_img;
                        }

                // if statement for group type
                    if (d.group_type == 'I') {
                        d.group_type = 'Inhouse';
                    }else{
                        d.group_type = 'Member';
                    }

                // if statement for null values
                    if (!d.nik) {
                        d.nik = '-';
                    }
                    if(!d.npwp){
                        d.npwp = '-';
                    }
                    if(!d.transfer_bank_name){
                        d.transfer_bank_name = '-';
                    }
                    if(!d.transfer_name){
                        d.transfer_name = '-';
                    }
                    if(!d.transfer_acct_no){
                        d.transfer_acct_no = '-';
                    }
                    if(!d.group_cd){
                        d.group_cd = '-';
                    }
                    if(!d.approve_user){
                        d.approve_user = '-';
                    }
                    if(!d.approve_date){
                        d.approve_date = '-';
                    }
                    else{
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
                                    '<div class="col-sm-2">'+
                                        '<span class="card-text"><b>ID No</span></b><br>'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                        '<span class="card-text"><b>Bank Name</span></b><br>'+
                                        '<span class="card-text"><b>Account Name</span></b><br>'+
                                        '<span class="card-text"><b>Account No</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.nik+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.npwp+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_bank_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_name+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.transfer_acct_no+'</span><br>'+
                                    '</div>'+

                                    '<div class="col-sm-2">'+
                                        '<span class="card-text"><b>Group Type</b></span><br>'+
                                        '<span class="card-text"><b>Group Code</span></b><br><br>'+
                                        '<span class="card-text"><b>Approved By</span></b><br>'+
                                        '<span class="card-text"><b>Approved Date</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-4">'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.group_type+'</span><br>'+
                                        '<span class="card-text">:&nbsp;&nbsp; '+d.group_cd+' - '+d.group_name+'</span><br><br>'+
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
                                    '<div class="col-sm-6 text-center">'+
                                        '<span class="card-text"><b>ID Card</span></b><br>'+
                                    '</div>'+

                                    '<div class="col-sm-6 text-center">'+
                                        '<span class="card-text"><b>NPWP</span></b><br>'+
                                    '</div>'+

                                    // '<div class="col-sm-3 text-center">'+
                                    //     '<span class="card-text"><b>Member Card</span></b><br>'+
                                    // '</div>'+

                                    // '<div class="col-sm-3 text-center">'+
                                    //     '<span class="card-text"><b>Saving Book</span></b><br>'+
                                    // '</div>'+
                                '</div>'+

                                '<hr>'+
                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-6">'+
                                        '<a onClick=zoomHisPic("'+d.rowID+'","ID")>'+
                                            '<img src="'+file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="ID card" style="cursor: pointer;">'+
                                        '</a>'+
                                    '</div>'+

                                    '<div class="col-sm-6">'+
                                        '<a onClick=zoomHisPic("'+d.rowID+'","NPWP")>'+
                                            '<img src="'+npwp_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="NPWP" style="cursor: pointer;">'+
                                        '</a>'+
                                    '</div>'+

                                    // '<div class="col-sm-3">'+
                                    //     '<a onClick=zoomHisPic("'+d.rowID+'","Member")>'+
                                    //         '<img src="'+member_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="Member Card" style="cursor: pointer;">'+
                                    //     '</a>'+
                                    // '</div>'+

                                    // '<div class="col-sm-3">'+
                                    //     '<a onClick=zoomHisPic("'+d.rowID+'","Saving")>'+
                                    //         '<img src="'+saving_file_url_m+'" class="img-thumbnail img-fluid rounded w-100" alt="Saving Book" style="cursor: pointer;">'+
                                    //     '</a>'+
                                    // '</div>'+
                                '</div>'+

                                '<br>'+

                                '<div class="row">'+
                                    '<div class="col-sm-12">'+
                                        '<span class="card-text"><b>Action</b></span><br>'+
                                        '<hr>'+
                                    '</div>'+
                                '</div>'+

                                '<br>'+

                                '<div class="row">'+

                                    // '<div class="col-sm-4">'+
                                    //     '<button onclick=addHis("'+d.rowID+'","'+d.status+'") type="button" class="btn btn-bg-gradient-x-blue-green btn-block">Add</button>'+
                                    // '</div>'+

                                    '<div class="col-sm-6">'+
                                      '<button onclick="editHis('+d.rowID+')" type="button" class="btn btn-bg-gradient-x-blue-cyan btn-block">Edit</button>'+
                                    '</div>'+

                                    '<div class="col-sm-6">'+
                                      '<button onclick="viewHis(\''+d.email_add+'\')" type="button" class="btn btn-bg-gradient-x-orange-yellow btn-block">View</button>'+
                                    '</div>'+

                                '</div>'+

                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<br>';

                return html;
            }

            function addHis(rowID, status) {
                $('#modaldialog').addClass('modal-lg');
                $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
                $('#modaltitle').addClass('white');
                $('#modaltitle').html('Detail Submit Registration Agent');
                $('#modalbody').load("<?php echo base_url("c_submit_agent/addHis/")?>"+rowID+"/"+status);
                $('#modal').data('rowID', 0);
                $('#modal').modal('show');
            }

            function editHis(rowID) {
                $('#modaldialog').addClass('modal-lg');
                $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
                $('#modaltitle').addClass('white');
                $('#modaltitle').html('Edit Registration Agent');
                $('#modalbody').load("<?php echo base_url("c_submit_agent/editHis/")?>"+rowID);
                $('#modal').data('rowID', rowID);
                $('#modal').modal('show');
            }

            function viewHis(email_add) {
                console.log('js : ' + email_add);
                $('#modaldialog').addClass('modal-lg');
                $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
                $('#modaltitle').addClass('white');
                $('#modaltitle').html('View Registration Agent');
                $('#modalbody').load("<?php echo base_url("c_submit_agent/viewHis/")?>"+email_add);
                $('#modal').data('email_add', email_add);
                $('#modal').modal('show');
            }

            function zoomHisPic(id,type) {
                $('#modaltitle').text("Picture of " +type + " Card");
                $('#modaldialog').addClass('modal-lg');
                $.getJSON("<?= base_url('c_submit_agent/getPictHis') ?>" +"/"+ id +"/"+ type, function(data) {
                    var html = 
                        '<div class="text-center">'+
                            '<img src="'+data[0].url+'" class="img-thumbnail img-fluid rounded w-100" alt="Member Card" style="cursor: pointer;">'+
                        '</div>';

                    $('#modalbody').html(html);
                });
                $('#modal').modal('show');
                $('.modal-footer').remove();
            }
        // ------------------------------ END TAB HISTORY REGIST AGENT --------------------------------
        
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
    </script>
<!-- end script -->