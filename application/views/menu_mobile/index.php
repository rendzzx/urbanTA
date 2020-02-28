<!--link -->
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
    <script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
    <script src="<?=base_url('js/plugins/validate/jquery.validate.min.js')?>" type="text/javascript"></script>
<!-- link -->

<!-- style -->
    <style type="text/css">
        #loader{
            width:80%;
            height:100%;
            position:fixed;
            left: 9%;
            top: 1%;
            z-index: 99999;
            background:url("../img/loading.gif") no-repeat center center     
        }
        /*div.dataTables_wrapper 
        div.dataTables_filter {
            text-align: right;
            float: right;
            padding-bottom: 5px;
            }*/
    </style>
<!-- style -->

<!-- content -->
    <div id="loader" class="loader" hidden="true"></div>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before" style="height: 150px !Important"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <br><br>
                    <h3 class="content-header-title">Mobile Menu Entry</h3>
                </div>

                <div class="content-header-right col-md-8 col-12 mb-2">
                  <br>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title">Menu Entry</h4> -->
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <!-- <li><a data-action="collapse"><i class="ft-minus"></i></a></li> -->
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <!-- <li><a data-action="expand"><i class="ft-maximize"></i></a></li> -->
                                        <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table id="tblnewsfeed" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                            <thead>            
                                                <th class="sorting_asc">No</th>
                                                <th>Menu ID</th>
                                                <th>Title</th>
                                                <th>URL</th>
                                                <!-- <th>Parent Menu ID</th> -->
                                                <th>Description</th>
                                                <th>Sequence No.</th>
                                                <th>Icon Class</th>
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
<!-- content -->

<!-- script -->
    <script type="text/javascript">

        var tblnewsfeed;
        $(function(){
            tblnewsfeed = $('#tblnewsfeed').DataTable( 
            {
                "processing": false,
                "serverSide": true,
                "ajax":{
                    "url":"<?php echo base_url('c_menu_mobile/getTable');?>", 
                    "type":"POST"
                },
                "columns": [
                    { data: "row_number", width:'1px', searchable:false,
                        render: function (data, type, row) {
                            var row_number = row.row_number
                            return row_number + '.'
                        }
                    },
                    {data:"MenuID",name:"MenuID"},
                    {data:"Title",name:"Title"},
                    {data:"URL",name:"URL"},
                    // {data:"ParentMenuID",name:"ParentMenuID"},
                    {data:"title_descs",name:"title_descs"},
                    {data:"OrderSeq",name:"OrderSeq"},
                    {data:"IconClass",name:"IconClass"}
                ],
                "language": {
                    "decimal": ",",
                    "thousands": ".",
                },
                "dom": '<"toolbar newsfeed">frtip',
                "responsive": {
                    details: {
                        type: 'column',
                        target: 8
                    }
                }
            });
            $("div.newsfeed").html(
                '<button id="addnewsfeed" class="btn btn-primary pull-up" style="margin-top: 5px">Add</button>&nbsp;'+
                '<button id="editnewsfeed" class="btn btn-info pull-up" style="margin-top: 5px">Edit</button>&nbsp;'            
            );

            tblnewsfeed.on('click', 'tr', function() {
                if ($(this).hasClass('selected')) {
                    $(this).removeClass('selected');
                } else {

                    tblnewsfeed.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });

            $('#addnewsfeed').click(function(){
                // var site_url = '<?php echo base_url("c_menu_mobile/addnew/")?>'+0;
                // window.location.href= site_url;
                $('#modalheader').removeClass('bg-info').addClass('bg-primary white');
                $('#modaltitle').addClass('white');
                $('#modaltitle').html('Mobile Menu Entry');
                $('#modalbody').load("<?php echo base_url("c_menu_mobile/addnew");?>");
                    // #('#modalfooter').html('eeeeeeeee');
                    $('#modal').data('menuID', 0);
                    $('#modal').modal('show');

            })


            $('#editnewsfeed').click(function(){
                var rows = tblnewsfeed.rows('.selected').indexes();
                if (rows.length < 1) {
                    swal("Information",'Please select a row',"warning");
                    return;
                } 
                var data = tblnewsfeed.rows(rows).data();
                var menuID = data[0].MenuID;

                var site_url = '<?php echo base_url("c_menu_mobile/addnew/")?>'+menuID;
                // window.location.href= site_url;    

                $('#modalheader').removeClass('bg-primary').addClass('bg-info white');
                $('#modaltitle').addClass('white');
                $('#modaltitle').html('Mobile Menu Edit');
                $('#modalbody').load(site_url);

                $('#modal').data('menuID', menuID);
                $('#modal').modal('show');
            })
        });


        function Delete() {
            var MenuID = $('#modal').data('MenuID');
            // alert(MenuID);
            $.ajax({
                url : "<?php echo base_url('c_menu_mobile/Delete');?>",
                type:"POST",
                data: { MenuID: MenuID },
                dataType:"json",
                success:function(event, data){
                        // BootstrapDialog.alert(event.Pesan);
                        swal("Information",event.Pesan,"warning");
                        $('#modal').modal('hide');
                        tblnewsfeed.ajax.reload(null,true); 
                },                    
                error: function(jqXHR, textStatus, errorThrown){        
                        // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");

                }
            });
        }

        function block(boelan){
            var block_ele = $('#frmEditor')
            if (boelan==true) {
                $(block_ele).block({
                    message: '<div class="semibold"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                    fadeIn: 1000,
                    fadeOut: 1000,
                    overlayCSS: {
                        backgroundColor: '#fff',
                        opacity: 0.8,
                        cursor: 'wait'
                    },
                    css: {
                        border: 0,
                        padding: '10px 15px',
                        color: '#fff',
                        width: 'auto',
                        backgroundColor: '#333',
                        marginLeft : 'auto'
                    }
                });
            }
            else{
                $(block_ele).unblock()
            }
        }
    </script>
<!-- script