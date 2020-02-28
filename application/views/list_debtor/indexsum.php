<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/select2/select2.min.css')?>" rel="stylesheet">

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

 <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet"><script type="text/javascript">
<script type="text/javascript">
window.history.forward();
</script>
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

.toolbar.dataTables_filter {
    float: right !important;
}
a.btn.btn-icon.btn-info.mr-1 {
    padding: .5rem 1.1rem;
}

.btn-secondary{
    background-color: #30b6d7;
    border-color: #30b6d7;
    margin: 10px;
}

.btn-secondary:hover{
    background-color: #2ca7c5;
    border-color: #2ca7c5;
    margin: 10px;
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
            <div class="content-header-left col-md-8 col-12 mb-2">
              <br><br>
              <h5 class="content-header-title">Debtor Enquiry</h5>
            </div>
        </div>

        <div class="content-body">
            <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <!-- <h4 class="card-title">Choose Project</h4> -->
                                <div class="form-group">
                                    <div class="tittle-top pull-left">Debtor Aging Summary by Class</div>
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
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
                                        <div class="row">    
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Project</label>
                                                                <div class="col-sm-3">
                                                                    <select name="txtProject" id="txtProject" data-placeholder="Choose Project" class="select2" style="width:250px;" tabindex="2">
                                                                        <option value=""></option>
                                                                        <?php echo $cbProject;?>   
                                                                        
                                                                    </select>
                                                                    
                                                                </div>
                                                            <!-- <div class="col-sm-6"></div> -->
                                                        </div>

                                                    </div>
                                                    <br>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Debtor</label>
                                                                <div class="col-sm-3">
                                                                    <select name="txtDebtor" id="txtDebtor" data-placeholder="Choose Debtor" class="select2" style="width:250px;" tabindex="2">
                                                                        <option value="all"></option>
                                                                        <option value="all">All</option>
                                                                        <?php 
                                                                        foreach ($cbDebtor as $row) 
                                                                        {
                                                                            echo '<option value="'.$row->debtor_acct.'">'.$row->debtor_acct.' - '.$row->name.'</option>';
                                                                        }
                                                                        ?> 
                                                                        
                                                                    </select>
                                                                    
                                                                </div>
                                                            <span style="padding-left: 30px;">
                                                            <button class="btn btn-social btn-min-width mr-1 mb-1 btn-vimeo" id="search"><span class="ft-search font-medium-3"></span>Search</button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive">
                                                    <table id="tblcount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                                        <thead>    
                                                            <th>No.</th>
                                                            <th>Name</th>
                                                            <th>Unit</th>
                                                            <th>Total Outstanding</th>
                                                            <th>Current</th>
                                                        <?php foreach ($ageData as $key) {
                                                            echo "<th> 1 - ".$key->age1." Days</th>";
                                                            echo "<th> ".($key->age1+1)." - ".$key->age2." Days</th>";
                                                            echo "<th> ".($key->age2+1)." - ".$key->age3." Days</th>";
                                                            echo "<th> ".($key->age3+1)." - ".$key->age4." Days</th>";
                                                            echo "<th> ".($key->age4+1)." - ".$key->age5." Days</th>";
                                                            echo "<th> ".($key->age5+1)." - ".$key->age6." Days</th>";
                                                            echo "<th> > ".$key->age6." Days</th>";
                                                        } ?>
                                                            
                                                            <!-- <th>Unallocated Amount</th> -->
                                                            <!-- <th>Total Payment</th> -->
                                                            <!-- <th>Deposit Total</th> -->
                                                
                                                        </thead>
                                                        <tbody>
                                                        </tbody> 
                                                        <tfoot style="font-weight: bold;background-color: #f2f2f2">
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th style="text-align: right;font-weight: bold;"> Total : </th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <!-- <th></th> -->
                                                            </tr>
                                                        </tfoot>              
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
</div>   
<div id="loader" class="loader" hidden="true"></div>


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


<script type="text/javascript">
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
var tblcount;
$(function(){
   
document.getElementById('loader').hidden=false;
    $('.select2').select2();

   tblcount = $('#tblcount').DataTable( 
    {
            dom: '<"toolbar dataTables_filter">Bfrtip',
            // responsive: true,
            select: true,
            filter: false,
            "initComplete": function(settings, json) {
                // alert('done');
                document.getElementById('loader').hidden=true;
              },
            // "scrollY":"1000px",
            // "scrollCollapse": true,    
            paging:false,
            "columnDefs": [
                  { className: "text-right", "targets": [3,4,5,6,7,8,9,10,11] }
                ],
            info:false,        
            buttons: [
                
                {
                extend: 'collection',
                className: 'btn biru-bg fa fa-star',
                text: ' Action',
                buttons: [
                    {
                        extend: 'print',
                        footer: true
                    },
                    {
                        extend: 'excel',
                        footer: true
                    },
                    {
                        extend: 'pdf',
                        footer: true
                
                    }
                    
                    // 'print'
                            ]           
                },
                
               
                {
                    text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 tblcount.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }

                    }
                }
                
             
                
            ],
 
        "serverSide": true,
        "ajax":{
                    "url":"<?php echo base_url('c_debtor_sum/getTable');?>",  
                    "data":{"debtor": function(d){
                    var a = $('#txtDebtor').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "cons": function(d){
                    var a = $('#txtProject').find(':selected').attr('data-cons');
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "unit": function(d){
                    var a = $('#txtUnit').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    },
                    "sSearch": function(d){
                    var a = $('#txt_search').val();
                    
                    var b ="";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }

                    },
                    "project": function(d){
                    var a = $('#txtProject').val();
                    console.log(a);
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    // console.log(a);
                    }
                        },          
                "type":"POST"
            },
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            var current = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day1 = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day2 = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day3 = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day4 = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day5 = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day6 = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day7 = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // var payment = api
            //     .column( 12 )
            //     .data()
            //     .reduce( function (a, b) {
            //         return intVal(a) + intVal(b);
            //     }, 0 );
        
            // Update footer
            $( api.column( 3 ).footer() ).html(
                
                formatNumber(parseInt(current)+parseInt(day1)+parseInt(day2)+parseInt(day3)+parseInt(day4)+parseInt(day5)+parseInt(day6)+parseInt(day7)) 
            );
            $( api.column( 4 ).footer() ).html(
                formatNumber(current) 
            );
            $( api.column( 5 ).footer() ).html(
                formatNumber(day1) 
            );
            $( api.column( 6 ).footer() ).html(
                formatNumber(day2) 
            );
            $( api.column( 7 ).footer() ).html(
                formatNumber(day3) 
            );
            $( api.column( 8 ).footer() ).html(
                formatNumber(day4) 
            );
            $( api.column( 9 ).footer() ).html(
                formatNumber(day5) 
            );
            $( api.column( 10 ).footer() ).html(
                formatNumber(day6) 
            );
            $( api.column( 11 ).footer() ).html(
                formatNumber(day7) 
            );
            
            // $( api.column( 12 ).footer() ).html(
            //     formatNumber(payment) 
            // );
        },
        // ini ada button submit
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"debtor_name",name:"debtor_name"},  
            {data:"lot_no",name:"lot_no"},
            {data:"current_day",name:"current_day",
                 render: function (data, type, row) {
                    var total = parseFloat(row.current_day)+parseFloat(row.day1_amt)+parseFloat(row.day2_amt)+parseFloat(row.day3_amt)+parseFloat(row.day4_amt)+parseFloat(row.day5_amt)+parseFloat(row.day6_amt)+parseFloat(row.day7_amt);
                  return formatNumber(total);  
            }},
            {data:"current_day",name:"current_day",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"day1_amt",name:"day1_amt",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"day2_amt",name:"day2_amt",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"day3_amt",name:"day3_amt",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"day4_amt",name:"day4_amt",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"day5_amt",name:"day5_amt",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"day6_amt",name:"day6_amt",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"day7_amt",name:"day7_amt",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }}//,
            
            // {data:"unallocated_amt",name:"unallocated_amt",
            //      render: function (data, type, row) {
            //       return formatNumber(data);  
            // }},
            // {data:"total_payment",name:"total_payment",
            //      render: function (data, type, row) {
            //       return formatNumber(parseFloat(data));  
            // }}//,
            // {data:"deposit_todate",name:"deposit_todate",
            //      render: function (data, type, row) {
            //       return formatNumber(data);  
            // }}
            
            ]
    });

    $("div.toolbar").html('<div class="row"><div="col-md-4"><div class="input-group"><b><div class="input-group"><label style="margin-top:5px;">Search :</label><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn btn-icon btn-info mr-1" onclick="fn_search()"><i class="ft-search" style="color: white"></i></a></div></div> </b></div></div>');

    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblcount.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblcount.ajax.reload(null,true);   
        }
    });
    
});
function fn_search(){
    // alert('a');
    var a = $('#txt_search').val();
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblcount.ajax.reload(null,true); 
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
    }

$('#search').click(function(){
   
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                    tblcount.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});



</script>
