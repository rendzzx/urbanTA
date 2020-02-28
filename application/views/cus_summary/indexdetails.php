<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <br><br>
                <h3 class="content-header-title">NUP Choose Unit Details</h3>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="form-group">
                                <label for="txt_Pl_Project" class="font-weight-bold">Choose Project : </label>
                                <select data-placeholder="Choose a Project..." class="select2" id="pl_project" name="pl_project">
                                    <option value=""></option>
                                    <option value="all">All</option>
                                    <?php echo $cbproject; ?>
                                </select>
                                <button id="search" class="btn btn-primary"><i class="ft-search"> </i><span class="hidden-xs">Search</span></button>
                            </div>
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
                                <table id="tblcus" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                    <thead>            
                                        <th>No.</th>
                                        <th>Property Type</th>
                                        <th>Unit Counter</th>
                                        <th>Unit Priority</th>
                                        <th>Unit No.</th>
                                        <th>NUP No.</th>
                                        <th>Name</th>
                                        <th>Handphone</th>
                                        <th>Group Name</th>
                                        <th>Company Name</th>
                                        <th>Agent Name</th>
                                        <th>Handphone</th>
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
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script>

$(document).ready(function(){

    $(".select2").select2({
        width : 300
    });

    tblcus = $('#tblcus').DataTable( 
    {
        dom         : '<"toolbar dataTables_filter">Bfrtip',
        responsive  : true,
        select      : true,
        filter      : false,    
        paging      :false,       
        buttons     :
        [{
            extend: 'collection',
            className: 'btn biru-bg fa fa-star',
            text: ' Action',
            buttons: [
                'excel',
                'csv',
                'pdf',
            ]
        }],
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_cus_details/getTable');?>",
            "data":{
                "project": function(d){
                    var a = $('#pl_project').val();
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                },
            },          
                "type":"POST"
        },
        // ini ada button submit
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"property_descs",name:"property_descs"},
            {data:"nup_counter",name:"nup_counter"},
            {data:"no_prioritas",name:"no_prioritas"},
            {data:"lot_no",name:"lot_no"},
            {data:"nup_no",name:"nup_no"},
            {data:"name",name:"name"},
            {data:"hand_phone",name:"hand_phone"},
            {data:"group_name",name:"group_name"},
            {data:"company_name",name:"company_name"},
            {data:"agent_name",name:"agent_name"},
            {data:"handphone1",name:"handphone1"}
        ]
    });

    $('#search').click(function(){
        block(true, '#tblcus')
        var state = document.readyState
        if (state == 'complete') {
            setTimeout(function(){
                document.getElementById('interactive');
                tblcus.ajax.reload(null,true);
                block(false, '#tblcus')
            },1000);
        }
    });
});
</script>