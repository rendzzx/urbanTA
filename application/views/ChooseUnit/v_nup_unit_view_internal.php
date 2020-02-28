<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/forms/selects/select2.min.css')?>">
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <br><br>
        <h3 class="content-header-title">Unit Enquiry</h3>
      </div>
    </div>
    <div class="content-body">
        <section id="unitEnquiry">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    	<div class="card-header">
                            <h4 class="card-title"><?php echo $project_name ?></h4>
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
                            	<div class="row">
                            		<div class="col-12">
                            			<div class="form-group">
                            				<label for="pl_property" class="font-weight-bold">Legend</label>
                            				<br>
                            				<button type="button" class = "btn btn-success" data-toggle="popover" data-placement="top" data-container="body" data-original-title="Popover on top" data-content="Macaroon chocolate candy. I love carrot cake gingerbread cake lemon drops. Muffin sugar plum marzipan pie.">Available</button>
                            				<button type="button" class = "btn btn-danger">Sold</button>
                            				<button type="button" class = "btn btn-warning">Reserve</button>
                            			</div>
                            			<div class="form-group">
								            <label for="pl_property" class="font-weight-bold">Property Type : </label>
						                    <select data-placeholder="Choose a Project..." class="select2" id="pl_property" name="pl_property">
									            <option value=""></option>
									            <?php echo $property_type; ?>
								            </select>
								            &nbsp;&nbsp;&nbsp;
								            <label for="pl_property" class="font-weight-bold" id="label_level">Type : </label>
						                    <select data-placeholder="Choose a Project..." class="select2" id="level_no" name="level_no">
						                    	<option selected="1" value="L">All Unit</option>
								                <?php echo $level_no; ?>
								            </select>
								        </div>
                            		</div>
                            	</div>
                            	<div class="row">
                            		<div class="col-12">
                            			<table id="table1" class="table table-hover dataTable">
							                <thead>
							                  	<tr>
							                    	<th id="TH1" class="col-xs-1">Floor</th>
							                    	<th>Unit</th>
							                	</tr>
							                </thead>
							                <tbody>                
							                   <?php echo $userLevelList; ?>            
							            	</tbody>
							            </table>
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
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/forms/select/select2.full.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/forms/select/form-select2.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/popover/popover.js')?>" type="text/javascript"></script>
<script type="text/javascript">
    $(".select2").select2({
    	width : 300
    });

	$('#level_no').on("change",function(e){
		block(true);
		var property_cd = $('#pl_property').val();
		var level_no 	= $('#level_no').val();
		var lot_no 		= $('#txtlotno').val();
		var Type 		= $("#pl_property option:selected").data("level"); 

		var state = document.readyState
		if (state == 'complete') {
			setTimeout(function(){
		    	document.getElementById('interactive');
				block(false);
		  	}, 1000);
		}
		$('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_tableViewInternal');?> #table1",{"property_cd":property_cd,"level_no":level_no,"Type":Type}
		);
	});

	$('#pl_property').on("change",function(e){
		block(true);
		var property_cd = $('#pl_property').val();
		var level_no 	= $('#level_no').val();
		var Type 		= $("#pl_property option:selected").data("level");
		if(Type=='A'){
			document.getElementById('label_level').innerHTML = 'Level';
			document.getElementById('TH1').innerHTML = 'Floor';
		}
		else{
			document.getElementById('label_level').innerHTML = 'Type';
			document.getElementById('TH1').innerHTML = 'Type';
		}

		var state = document.readyState
		if (state == 'complete') {
			setTimeout(function(){
				document.getElementById('interactive');
				block(false);
			}, 1000);
		}

		var property_cd = $(this).find(':selected').val(); 
		if(property_cd!=='') {
			var site_url = '<?php echo base_url("C_nup_unitNew/level")?>';
			$.post(site_url,
				{property_cd:property_cd,level_no:level_no},       
				function(data,status) {
					$("#level_no").empty();
					$("#level_no").append('<option value="L" >All Unit</option>');
					$("#level_no").append(data);
					$("#level_no").trigger('chosen:updated');
				}
			);
		}

		$('#table1').load( "<?php echo base_url('C_nup_unitNew/goto_tableViewInternal');?> #table1", {"property_cd":property_cd,"level_no":level_no,"Type":Type}
			// function(){
			// 	$('.btn').popover();
			// }
		);
	});

	function block(boelan){
        var block_ele = $('#table1')
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