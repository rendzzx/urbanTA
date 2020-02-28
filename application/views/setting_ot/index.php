<!-- link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<!-- endlink -->

<!-- content -->
    <div class="app-content content">
      <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <br><br>
                    <h3 class="content-header-title">Setup</h3>
                </div>

                <div class="content-header-right col-md-8 col-12 mb-2">
                    <br>
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a style="font-weight: bold">IFCA <?php echo $this->session->userdata('appsname'); ?></a>
                            </li>
                            <li class="breadcrumb-item active">Overtime
                            </li>
                            <!-- <li class="breadcrumb-item active" class="nav-link nav-link-expand">Survey
                            </li> -->
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <!-- <h4 class="card-title">Setting</h4> -->
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="nav-vertical p-2">
                                            <ul class="nav nav-tabs nav-left">
                                                <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#tabottype" aria-expanded="true">Overtime Type</a>
                                                </li>
                                                <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabworkhour" aria-expanded="true">Work Hour</a>
                                                </li>
                                                <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabotrate" aria-expanded="true">Overtime Rate by Area </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content px-1">
                                                <div id="tabottype" role="tabpanel" class="tab-pane active" aria-expanded="true">
                                                    <table id="tblottype" class="table table-hover table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Overtime Code</th>
                                                                <th>Description</th>
                                                                <th>Trx Type</th>
                                                                <th>Tax Code</th>
                                                                <th>Type</th>
                                                                <th hidden="true">rowid</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div id="tabworkhour" role="tabpanel" class="tab-pane" aria-expanded="true">
                                                    <table id="tblworkhour" class="table table-hover table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Day Code</th>
                                                                <th>Description</th>
                                                                <th>Day Type</th>
                                                                <th>Time In</th>
                                                                <th>Time Out</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                                <div id="tabotrate" role="tabpanel" class="tab-pane" aria-expanded="true">
                                                    <table id="tblotrate" class="table table-hover table-bordered" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Level No</th>
                                                                <th>Description</th>
                                                                <th>Area</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
      </div>
    </div>
<!-- end content -->

<!-- link -->
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<!-- end link -->

<!-- script -->
    <script type="text/javascript">
        // ottype
        var tblottype = $('#tblottype').DataTable( {
            "ajax" : {
                "url" : "<?php echo base_url('c_setting_ot/gettableOTType');?>",
                "type": "POST"
            },
            "columns": [
                { data: "row_number", width:'1px', searchable:false,
                    render: function (data, type, row) {
                        var row_number = row.row_number
                        return row_number + '.'
                    }
                },
                {data:"over_cd"},
                {data:"descs"},
                {data:"trx_type"},
                {data:"tax_cd"},
                {data:"type",
                    render: function (data, type, row) {
                        var type = row.type;
                        var typestat ='';
                        if (type == 'L') {
                            return typestat = 'By Area'; 
                        }else{
                            return typestat = 'By Zone' ;
                        }
                    }
                },
                {data:"rowID", visible:false}

            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar ottype">frtip'
        });

        $("div.ottype").html(
            '<button id="addottype" class="btn btn-primary pull-up">Add</button>&nbsp;'+
            '<button id="editottype" class="btn btn-info pull-up">Edit</button>&nbsp;'+
            '<button id="deleteottype" class="btn btn-danger pull-up">Delete</button>'
        );

        tblottype.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tblottype.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#addottype').click(function(){

            // $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            // $('#modaltitle').addClass('white');
            // $('#modaltitle').html('Add Overtime Type');
            // $('#modalbody').load("<?php echo base_url("c_setting_ot/addOTType")?>");
            // $('#modal').data('rowID', 0);
            // $('#modal').modal('show');
            var site_url = '<?php echo base_url("c_setting_ot/addOTType/")?>'+0;
            window.location.href= site_url;

        })

        $('#editottype').click(function(){
            var rows = tblottype.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 
            var data = tblottype.rows(rows).data();
            var rowID = data[0].rowID;
            var over_cd = data[0].over_cd;
            // console.log(over_cd);
            var site_url = '<?php echo base_url("c_setting_ot/addOTType/")?>'+rowID+'/'+over_cd;
            window.location.href= site_url;
            // $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            // $('#modaltitle').addClass('white');
            // $('#modaltitle').html('Edit Overtime Type');
            // $('#modalbody').load("<?php echo base_url("c_setting_ot/addOTType")?>");

            // $('#modal').data('rowID', rowID);
            // $('#modal').modal('show');
        })

        $('#deleteottype').click(function(){
            var rows = tblottype.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 

            var data = tblottype.rows(rows).data();
            var over_cd = data[0].over_cd;

            swal({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then(function(a){
                if (a.value==true) {
                    Delete(over_cd,'ot_type',tblottype)
                }
            })
        })


        // workhour
        var tblworkhour = $('#tblworkhour').DataTable( {
            "ajax" : {
                "url" : "<?php echo base_url('c_setting_ot/gettableworkhour');?>",
                "type": "POST"
            },
            "columns": [
                { data: "row_number", width:'1px', searchable:false,
                    render: function (data, type, row) {
                        var row_number = row.row_number
                        return row_number + '.'
                    }
                },
                {data:"day_cd"},
                {data:"descs"},
                {data:"day_type",
                    render: function (data, type, row) {
                        var day_type = row.day_type;
                        if(day_type=='D'){
                            return "Weekday";
                        }
                        else{
                            return "Weekend";
                        }
                    }
                },
                {data:"begin_time",
                    render: function (data, type, row) {
                        var date = new Date(parseInt(data.substr(0,19)));
                        var h =data.substr(11,3);
                        var m=data.substr(14,2);
                        var s =data.substr(16,3);
                        var aa = h+""+m+""+s;          
                        return aa;
                    }
                },
                {data:"end_time",name:"end_time",
                    render: function (data, type, row) {
                        var date = new Date(parseInt(data.substr(0,19)));
                        var h =data.substr(11,3);
                        var m=data.substr(14,2);
                        var s =data.substr(16,3);
                        var aa = h+""+m+""+s;
                        return aa;
                    }
                },
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar category">frtip'
        });

        $("div.category").html(
            '<button id="addworkhour" class="btn btn-primary pull-up">Add</button>&nbsp;'+
            '<button id="editworkhour" class="btn btn-info pull-up">Edit</button>&nbsp;'+
            '<button id="deleteworkhour" class="btn btn-danger pull-up">Delete</button>'
        );

        tblworkhour.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tblworkhour.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#addworkhour').click(function(){
            $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Add Work Hour');
            $('#modalbody').load("<?php echo base_url("c_setting_ot/addworkhour")?>");
            $('#modal').data('id', 0);
            $('#modal').modal('show');
        })

        $('#editworkhour').click(function(){
            var rows = tblworkhour.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 
            var data = tblworkhour.rows(rows).data();
            var id = data[0].rowID;

            $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
            $('#modaltitle').addClass('white');
            $('#modaltitle').html('Edit Work Hour');
            $('#modalbody').load("<?php echo base_url("c_setting_ot/addworkhour")?>");

            $('#modal').data('id', id);
            $('#modal').modal('show');
        })

        $('#deleteworkhour').click(function(){
            var rows = tblworkhour.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 

            var data = tblworkhour.rows(rows).data();
            var id = data[0].rowID;

            swal({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then(function(a){
                if (a.value==true) {
                    Delete(id,'cf_workhour',tblworkhour)
                }
            })
        })


        //otrate
        var tblotrate = $('#tblotrate').DataTable( {
            "ajax" : {
                "url" : "<?php echo base_url('c_setting_ot/gettableOTRate');?>",
                "type": "POST"
            },
            "columns": [
                { data: "row_number", width:'1px', searchable:false,
                    render: function (data, type, row) {
                        var row_number = row.row_number
                        return row_number + '.'
                    }
                },
                {data:"level_no"},
                {data:"descs"},
                {data:"area"}
            ],
            "language": {
                "decimal": ",",
                "thousands": ".",
            },
            "dom": '<"toolbar otrate">frtip'
        });

        $("div.otrate").html(
            // '<button id="addotrate" class="btn btn-primary pull-up">Add</button>&nbsp;'+
            '<button id="editotrate" class="btn btn-info pull-up">Edit</button>&nbsp;'+
            '<button id="deleteotrate" class="btn btn-danger pull-up">Delete</button>'
        );

        tblotrate.on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                tblotrate.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });


        $('#editotrate').click(function(){
            var rows = tblotrate.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 
            var data = tblotrate.rows(rows).data();
            var id = data[0].rowID;

            var rowID = data[0].rowID;
            var level_no = data[0].level_no;
            // console.log(level_no);
            var site_url = '<?php echo base_url("c_setting_ot/addOTRate/")?>'+rowID;
            window.location.href= site_url;
        })

        $('#deleteotrate').click(function(){
            var rows = tblotrate.rows('.selected').indexes();
            if (rows.length < 1) {
                swal("Information",'Please select a row',"warning");
                return;
            } 

            var data = tblotrate.rows(rows).data();
            var id = data[0].rowID;

            swal({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
            .then(function(a){
                if (a.value==true) {
                    Delete(id,'pm_level',tblotrate)
                }
            })
        })

        function Delete(id,table,reload) {
            var data = [];
            data.push({ name:'id', value:id },{ name:'table', value:table })
            $.ajax({
                url : "<?php echo base_url('c_setting_ot/delete');?>",
                type:"POST",
                data: data,
                dataType:"json",
                success:function(event, data){
                    swal("Information",event.Pesan,"warning");
                    $('#modal').modal('hide');
                    reload.ajax.reload(null,true);
                },                    
                error: function(jqXHR, textStatus, errorThrown){        
                    swal("Information",textStatus+' Save : '+errorThrown,"warning");
                }
            });
        }

        function formatNumber(data) {
          if(data==null){
            data =0;
          }
          return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
        }

        function format ( d ) {
            var labour_rate = d.labour_rate;
            if (labour_rate == 0) {
                labour_rate = '<p class="pull-right">'+0+'</p>'
            }else{
                labour_rate = '<p class="pull-right">'+formatNumber(labour_rate)+'</p>' ;
            }
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<th>Hours:</th>'+
                    '<td>'+d.service_day+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<th>Tax code:</th>'+
                    '<td>'+d.tax_cd+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<th>Currency Code:</th>'+
                    '<td>'+d.currency_cd+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<th>Service Rate:</th>'+
                    '<td>Rp.&nbsp;'+
                    labour_rate
                    '</td>'+
                '</tr>'+
            '</table>';
        }
    </script>
<!-- end script -->