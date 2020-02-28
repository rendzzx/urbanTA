<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
 <script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">
<script type="text/javascript">
window.history.forward();
</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2"><br/><br/>
        <h3 class="content-header-title">Sold Unit by Principle Listing</h3>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
      </div>
    </div>
    <div id="loader" class="loader" hidden="true"></div>
    <div class="content-body"> 
      <div class="row">      
        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <div class="card-content">
                 <form>

                    <div class="form-group row">
                        <label for="pl_project" class="col-sm-2 control-label" style="padding-left:2%;"> Choose Project</label>
                        <div class="col-sm-10">
                            <select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="form-control" style="width:90%;" tabindex="2">
                                <option value=""></option>
                                <?php echo $cbProject;?>   
                            </select>
                        </div>
                        <br>
                    </div>

                    <div class="form-group row">
                        <label for="pl_project" class="col-sm-2 control-label" style="padding-left:2%;"> Sales Date</label>
                        <div class="col-sm-7">
                            <div class="input-daterange input-group" style="width:90%;">
                                <input type="date" class="form-control" id="start" name="start" value=""/>
                                <span class="input-group-addon">  to  </span>
                                <input type="date" class="form-control" id="end" name="end" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pl_project" class="col-sm-2 control-label" style="padding-left:2%;"> Choose Product</label>
                        <div class="col-sm-7">

                            <select name="txtProduct" id="txtProduct" data-placeholder="Choose Product" class="form-control" style="width:90%;" tabindex="2">
                                <option value="all"></option>
                                <option value="all">All</option> 
                                <?php 
                                foreach ($Product as $row3) 
                                {
                                    echo '<option value="'.$row3->product_cd.'">'.$row3->descs.'</option>';
                                }
                                ?>  

                            </select>

                        </div>
                        <div class="col-sm-2 control-label">
                            <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
                            <!-- <button id="download" class="btn btn-white"><i class="fa fa-download"></i> <span class="hidden-xs">Download</span></button> -->
                        </div>
                        <br>
                    </div>

                    <div class="form-group row">
                        <label for="pl_project" class="col-sm-2 control-label" style="padding-left:2%;"> Choose Property</label>
                        <div class="col-sm-10">
                            <select name="txtProperty" id="txtProperty" data-placeholder="Choose Property" class="form-control" style="width:90%;" tabindex="2">
                                <option value="all"></option>
                                <option value="all">All</option>
                                <?php 
                                foreach ($Property as $row3) 
                                {
                                    echo '<option value="'.$row3->property_cd.'">'.$row3->descs.'</option>';
                                }
                                ?>  
                            </select>

                        </div>
                        <br>
                    </div>
                    <!-- <div class="form-group">
                        <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Lead</label>
                        <div class="col-sm-10">
                            <select name="txtLeadName" id="txtLeadName" data-placeholder="Choose Lead Name" class="select2" style="width:250px;" tabindex="2">
                                <option value="all"></option>
                                <option value="all">All</option>
                                <?php 
                                foreach ($leaddata as $row3) 
                                {
                                   // echo '<option value="'.$row3->lead_cd.'">'.$row3->lead_name.'</option>';
                                }
                                ?> 
                                
                                
                            </select>
                            
                        </div>
                        <br>
                    </div>
                    <div class="form-group">
                        <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Principal</label>
                        <div class="col-sm-10">
                            <select name="txtGroupName" id="txtGroupName" data-placeholder="Choose Group Name" class="select2" style="width:250px;" tabindex="2">
                                <option value="all"></option>
                                <option value="all">All</option>
                                <?php 
                                foreach ($groupData as $row3) 
                                {
                                   // echo '<option value="'.$row3->group_cd.'">'.$row3->group_name.'</option>';
                                }
                                ?> 
                                
                                
                            </select>
                            
                        </div>
                        <br>
                    </div> -->
                 </form>
                </div>
              </div>
           </div>
        </div>

        <div class="col-lg-12">
           <div class="card">
              <div class="card-header">
                <div class="card-content">
                  <div class="table-responsive">
                   <b>NUP Enquiry By Principal</b>                       
                        <pre style="border:0px; background: #ffffff;">                        
                            <table id="tblcount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No.</th>
                                    <th>Product Name</th>
                                    <th>Property Name</th>
                                    <th>Lead Name</th>
                                    <th>Principal Name</th>
                                    <th>Lot No.</th>
                                    <th>Name</th>
                                    <th>Sales Date</th>
                                    <th>Sales Name</th>
                                    <th>SP No.</th>
                                    <th>Nett Area</th>
                                    <th>Semi Gross</th>
                                    <th>Lot Type</th>
                                    <th>Position</th>
                                    <th>View</th>
                                    <th>Payment Plan</th>
                                    <th>Selling Price</th>            
                                </thead>
                                <tbody>
                                </tbody>                            
                            </table>
                        </pre>                       
                    </div>
                </div>
              </div>
           </div>
        </div>

      </div>
  </div>


</div>
<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/js/scripts/navs/navs.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/jquery-1.12.3.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>

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
    <!-- Bootstrap Modal -->
    <div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div id="modalDialog2" class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h5 class="modal-title" id="modalTitle2"></h5>
          </div>
          <!-- Modal Body -->
          <div class="modal-body2">
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">

    var tblcount = $('#tblcount').DataTable( {
        "ajax" : {
            "url" : "<?php echo base_url('c_report_agent/getTablePrinciple');?>",
            "type": "POST"
        },
        "columns": [
            { data: "row_number", width:'1px', searchable:false,
                render: function (data, type, row) {
                    var row_number = row.row_number
                    return row_number + '.'
                }
            },
             {data:"product_descs"},  
            {data:"property_descs"},  
            {data:"lead_name"},  
            {data:"group_name"},  
            {data:"lot_no"},            
            {data:"NAMA"},
            {data:"sales_date",
            render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               
                               
                               var aa = day+"/"+month+"/"+year;
                               // console.log(data);
                               // console.log(year);                               
                               // console.log(month);
                               // console.log(day);
                               return aa;
                               
                               

                           }

            },
            {data:"sales"},
            {data:"ref_no"},
            {data:"build_up_area"},
            {data:"land_area"},
            {data:"lot_type_descs"},
            {data:"direction_descs"},
            {data:"view_descs"},
            {data:"payment_plan_descs"},
            {data:"sell_price",
            render: function (data, type, row) {
                return formatNumber(data);  
              }
          }
        ],
        "language": {
            "decimal": ",",
            "thousands": ".",
        },
        "dom": '<"toolbar section">frtip'
    });


</script>
