<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<div class="app-content content">
	<div class="content-wrapper">
		<div class="content-wrapper-before"></div>
		<div class="content-header row">
			<div class="content-header-left col-md-4 col-12 mb-2">
				<br><br>
				<h3 class="content-header-title">NUP Enquiry</h3>
			</div>
		</div>
		<div class="content-body">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><?php echo $ProjectDescs; ?></h4>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
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
                            	<table id="tblenquiry" class="table table-striped table-responsive table-bordered table-hover" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No</th>
                                    <th>Agent Name</th>                                        
                                    <th>Customer Name</th>                                
                                    <th>Customer Handphone</th>
                                    <th>NUP No.</th>
                                    <th>Agent Name</th>
                                    <th>Principle Name</th>
                                    <th>Lead Name</th>
                                    <th>Agent HP</th>
                                    <th>Status</th>
                                    <th>Choose Unit Status</th>
                                    <th>Type</th>
                                    <th>Product</th>
                                    <th>Confirm Unit</th>
                                    <th>Choosen Unit</th>
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
</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script type="text/javascript">
	var tblenquiry = $('#tblenquiry').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_reserve_nup_cancel/getTable');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
            { data: "NAME" },
            { data: "nup_no" },
            { data: "Handphone" },
            { data: "Email" },
            { data: "nup_type" },
            { data: "reserve_date" },
            { data: "STATUS" },
            { data: "product_descs"},
            { data: "product_type"}
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });
</script>
