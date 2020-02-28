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
                                        <a class="nav-link" data-toggle="tab" aria-controls="tab2" href="#tab2" aria-expanded="false">History Regist Agent</a>
                                    </li>
                                
                                </ul>
                                <div class="tab-content px-1">
                                    <div role="tabpanel" class="tab-pane active" id="tab1" aria-expanded="true" aria-labelledby="tab1">
                                          <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th>No</th>
                                                <th>Registration Date</th>                      
                                                <th>Grup Type</th> 
                                                <th>Email Address</th>                               
                                                <th>Project</th>
                                                <th>Full Name</th>
                                                <th>NIK</th>
                                                <th>Handphone</th>
                                                <th>Photos</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab2" aria-labelledby="tab2">
                                        <table id="tblsubagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <!-- display table-striped table-condensed -->
                                            <thead>            
                                                <th>No</th>
                                                <th>Registration Date</th>
                                                <th>Group Type</th>                 
                                                <th>Email Address</th>  
                                                <th>Project</th>                               
                                                <th>Full Name</th>
                                                <th>NIK</th>
                                                <th>Handphone</th>
                                                <th>Photos</th>
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

<!-- Bootstrap Modal -->

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

 <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
<script type="text/javascript">



var tblagent,tblsubagent;

// ------------------------------ START TAB SUBMIT REGIST AGENT -----------------------------
var tblagent = $('#tblagent').DataTable( {
        "scrollY": 200,
        "scrollX": true,
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
                            return weekday[date.getDay()] + ", "+ date.getDate() + "-" + (month.length > 1 ? month : "0" + month) + "-" + date.getFullYear();
                    }},
                    {data:"group_type",name:"group_type", sortable: true, render:function(data,type, row){
                        var inhs = "INHOUSE";
                        var frlc = "MEMBER";
                        if (data == "I"){
                            return inhs;
                        }else{
                            return frlc;
                        }
                    }},
                    // {data:"descs",name:"descs"},
                    {data:"email_add",name:"email_add"},
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
                    {data:"full_name",name:"full_name", sortable: true, searchable: true},
                    {data:"nik",name:"nik", sortable: true},
                    {data:"handphone1",name:"handphone1", sortable: true},
                    {data:"file_url",name:"file_url", render:function(data, type, row){
                        return '<img src="'+data+'" height = "10%" width = "10%"/>';
                    }},
                    {data: "email_add", name: "email_add",
                        render: function (data, type, row) {
                            var emails = row.email_add;
                            var statuss = row.statuss;
                            
                            if (statuss == "N"){
                                return  '<a class="btn btn-danger btn-sm" disabled="true"><i class="fa fa-trash fa-fw"></i> Decline</a>';
                            }
                            return  '<a class="btn btn-danger btn-sm" id="btn_delete" onclick="deletest(\''+emails+'\');" ><i class="fa fa-trash fa-fw"></i> Decline</a>';
                        }
                    },
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar agent">frtip'
    });

    $("div.agent").html(
        '<button id="add" class="btn btn-primary pull-up">Add Project</button>&nbsp;'
    );

    tblagent.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblagent.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#add').click(function(){
        var rows = tblagent.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                    return;
            }

        var data = tblagent.rows(rows).data();
        var email_add = data[0].email_add;
        var rowID = data[0].rowID;
        var statuss =  data[0].status;

        $('#modaldialog').addClass('modal-lg');
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Detail Submit Registration Agent');
        $('#modalbody').load("<?php echo base_url("c_submit_agent/addnew/")?>"+rowID);
        $('#modal').data('rowID', 0);
        $('#modal').modal('show');
    })

// ------------------------------ START TAB HISTORY REGIST AGENT -----------------------------
    var tblsubagent = $('#tblsubagent').DataTable( {
        "scrollY": 200,
        "scrollX": true,
        "ajax" : {
            "url" : "<?php echo base_url('c_his_submit_agent/getTable');?>",
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
                            return weekday[date.getDay()] + ", "+ date.getDate() + "-" + (month.length > 1 ? month : "0" + month) + "-" + date.getFullYear();
                    }},
                    {data:"group_type",name:"group_type", sortable: true, render:function(data,type, row){
                        var inhs = "INHOUSE";
                        var frlc = "MEMBER";
                        if (data == "I"){
                            return inhs;
                        }else{
                            return frlc;
                        }
                    }},
                    // {data:"descs",name:"descs"},
                    {data:"email_add",name:"email_add"},
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
                    {data:"full_name",name:"full_name", sortable: true, searchable: true},
                    {data:"nik",name:"nik", sortable: true},
                    {data:"handphone1",name:"handphone1", sortable: true},
                    {data:"file_url",name:"file_url", render:function(data, type, row){
                        return '<img src="'+data+'" style="position:relative" height = "50%" width = "50%"/>';
                    }},
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar agent_his">frtip'
    });


    $("div.agent_his").html(
        '<button id="addhis" class="btn btn-primary pull-up">Add</button>&nbsp;'
        +
        '<button id="edithis" class="btn btn-info pull-up">Edit</button>&nbsp;'
        +
        '<button id="viewhis" class="btn btn-danger pull-up">View</button>'
    );


    tblsubagent.on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            tblsubagent.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });

    $('#addhis').click(function(){
        var rows = tblsubagent.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                    return;
            }

        var data = tblsubagent.rows(rows).data();
        var email_add = data[0].email_add;
        var rowID = data[0].rowID;
        var statuss =  data[0].status;

        $('#modaldialog').addClass('modal-lg');
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Detail Submit Registration Agent');
        $('#modalbody').load("<?php echo base_url("c_his_submit_agent/addnew/")?>"+rowID);
        $('#modal').data('rowID', rowID);
        $('#modal').modal('show');
    });

    $('#edithis').click(function(){
        var rows = tblsubagent.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                    return;
            }

        var data = tblsubagent.rows(rows).data();
        var email_add = data[0].email_add;
        var rowID = data[0].rowID;
        var statuss =  data[0].status;

        $('#modaldialog').addClass('modal-lg');
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('Edit Registration Agent');
        $('#modalbody').load("<?php echo base_url("c_his_submit_agent/editagent/")?>"+rowID);
        $('#modal').data('rowID', rowID);
        $('#modal').modal('show');

    });

    $('#viewhis').click(function(){
        var rows = tblsubagent.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                    return;
            }

        var data = tblsubagent.rows(rows).data();
        var email_add = data[0].email_add;
        var rowID = data[0].rowID;
        var statuss =  data[0].status;

        $('#modaldialog').addClass('modal-lg');
        $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
        $('#modaltitle').addClass('white');
        $('#modaltitle').html('View Registration Agent');
        $('#modalbody').load("<?php echo base_url("c_his_submit_agent/viewagent/")?>"+email_add);
        $('#modal').data('email_add', email_add);
        $('#modal').modal('show');

    })



</script>
<!-- <div id="loader" class="loader" hidden="true"></div> -->

<!-- Bootstrap Modal -->
<div id="modalAgent" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modalDialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <!-- <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button> -->
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
        </div>
        

    </div>
</div>

