<!-- link -->
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<!-- link -->

<!-- style -->
    <style type="text/css">
      #load{
        width:100%;
        height:100%;
        position:fixed;
        z-index:9999;
        background:url("../img/loading.gif") no-repeat center center     
    }
        table.dataTable th.dt-right,
        table.dataTable td.dt-right {
            text-align: right;
            /*cursor: pointer;*/
        /*}*/
    </style>
<!-- style -->

<!-- content -->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
            <h3 class="content-header-title"><?php echo $ProjectDescs; ?></h3>
            <h4 class="content-header-title">Submit Registration Agent</h4>
          </div>
        </div>
        <div id="loader" class="loader" hidden="true"></div>
        <div class="content-body"> 
          <div class="row">      
            <div class="col-lg-12">
               <div class="card">
                  <div class="card-header">
                    <div class="card-content">
                      <div class="table-responsive">
                            <table id="tblagent" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                <thead>    
                                    <th>No</th>
                                    <th>Registtration Date</th>                                      
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
                    </div>
                  </div>
               </div>
            </div>
          </div>
      </div>
<!-- content -->

<!-- link -->
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('app-assets/vendors/js/tables/jquery-1.12.3.js')?>" type="text/javascript"></script> -->
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<!-- link -->

<!-- script -->
    <script type="text/javascript">
        // var  tblagent;
        // $(function(){
            var tblagent = $('#tblagent').DataTable( {
                "processing": false,
                "serverSide": true,
                "ajax":{
                    "url":"<?php echo base_url('c_submit_agent/getTable');?>",
                    "data":{"sSearch": function(d){
                        var search = $('#txt_search').val();
                        var b="";
                        if(search == null || search==""){
                            return b;
                        }{
                            return search;
                        }
                    },},             
                    "type":"POST"
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
                        return '<img src="'+data+'" height = "75%" width = "75%"/>';
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
                // "responsive": {
                //     "details": {
                //         "type": 'column',
                //         "target": 6
                //     }
                // },
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                },
                "dom": '<"toolbar agent">frtip',
            });

            $("div.agent").html(
                '<button id="add" class="btn btn-primary pull-up">Add</button>&nbsp;'
                // +
                // '<button id="editottype" class="btn btn-info pull-up">Edit</button>&nbsp;'
                // +
                // '<button id="deleteottype" class="btn btn-danger pull-up">Delete</button>'
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

                // var site_url = '<?php echo base_url("c_submit_agent/addnew/")?>'+0;
                // window.location.href= site_url;
            })
        // }); //end function
    </script>
<!-- script -->
