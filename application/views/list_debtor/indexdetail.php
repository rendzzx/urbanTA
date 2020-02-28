<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/datatable/datatables.min.css')?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('app-assets/vendors/css/tables/extensions/responsive.dataTables.min.css')?>">
<link href="<?=base_url('app-assets/vendors/css/select2/select2.min.css')?>" rel="stylesheet">

<script src="<?=base_url('app-assets/vendors/js/vendors.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/select2/select2.full.min.js')?>"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/datatables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('app-assets/vendors/js/extensions/sweetalert2.all.js')?>" type="text/javascript"></script>

 <script src="<?=base_url('app-assets/vendors/js/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('app-assets/vendors/css/datapicker/datepicker3.css')?>" rel="stylesheet">
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
                                    <div class="tittle-top pull-left">Debtor Aging Details</div>
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

                                    <!-- <div class="row">
                                        <div="col-md-6">
                                            <b>
                                                <div class="input-group">
                                                    <label >Search :</label>
                                                    <input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >
                                                    <a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a>
                                                </div>
                                           
                                            </b>
                                        </div>
                                    </div> -->

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
                                                                        echo '<option value="'.$row->debtor_acct.'">'.$row->name.'</option>';
                                                                    }
                                                                    ?> 
                                                                    
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-xs-6"></div> -->
                                                        
                                                    </div>
                                                    <br>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Unit</label>
                                                            <div class="col-sm-2">

                                                                <select name="txtUnit" id="txtUnit" data-placeholder="Choose Unit" class="select2" style="width:250px;" tabindex="2">
                                                                    <option value="all"></option>
                                                                    <option value="all">All</option> 
                                                                     <?php 
                                                                    foreach ($cbUnit as $row) 
                                                                    {
                                                                        echo '<option value="'.$row->lot_no.'">'.$row->lot_no.'</option>';
                                                                    }
                                                                    ?> 

                                                                </select>
                                                                <!-- <button type="button" id="search" class="btn btn-bg-gradient-x-blue-cyan col-12 col-md-5 mr-1 mb-1"><span class="ft-search"></span><span class="hidden-xs">Search</span></button> -->
                                                                
                                                                 <!-- <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button> -->
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
                                                            <th>Document Date</th>
                                                            <th>Due Date</th>
                                                            <th>Document No.</th>
                                                            <th>Trx Description</th>
                                                            <th>Total Outstanding</th>
                                                            <th>Current</th>
                                                        <?php foreach ($ageData as $key) {
                                                            echo "<th > 1 - ".$key->age1." Days</th>";
                                                            echo "<th > ".($key->age1+1)." - ".$key->age2." Days</th>";
                                                            echo "<th > ".($key->age2+1)." - ".$key->age3." Days</th>";
                                                            echo "<th > ".($key->age3+1)." - ".$key->age4." Days</th>";
                                                            echo "<th> ".($key->age4+1)." - ".$key->age5." Days</th>";
                                                            echo "<th > ".($key->age5+1)." - ".$key->age6." Days</th>";
                                                            echo "<th>  ".$key->age6." Days</th>";
                                                        } ?>
                                                            
                                                            <!-- <th>Unallocated Amount</th> -->
                                                            <!-- <th>Total Payment</th> -->
                                                            <!-- <th>Deposit Total</th> -->
                                                
                                                        </thead>
                                                        <tbody>
                                                        </tbody> 
                                                        <tfoot style="font-weight: bold;background-color: #f2f2f2">
                                                            <tr>
                                                                <th ></th>
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
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
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

// -----------------Function loading
    function block(boelan){
        var block_ele = $('#form')
        if (boelan==true) {
            $(block_ele).block({
                message: '<div class="semibold" style="z-index: 0 !important;"><span class="ft-refresh-cw icon-spin text-left"></span>&nbsp; Loading ...</div>',
                fadeIn: 1000,
                fadeOut: 1000,
                overlayCSS: {
                    backgroundColor: '#fff',
                    opacity: 0.8,
                    cursor: 'wait',
                    'z-index' : '0 !important' ,
                },
                css: {
                    border: 0,
                    padding: '10px 15px',
                    color: '#fff',
                    width: 'auto',
                    backgroundColor: '#333',
                    marginLeft : 'auto',
                    "z-index" : '0 !important' ,
                    

                }
            });
        }
        else{
            $(block_ele).unblock()
        }
    }

// ------------------------ end function loading

function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }


    // $('.select2').select2();
    // var tblcount;
    $(function(){
   
document.getElementById('loader').hidden=false;
    $('.select2').select2();
var tblcount;
   tblcount = $('#tblcount').DataTable( 
    {
            dom: '<"toolbar dataTables_filter">Bfrtip',
            // responsive: true,
            select: true,
            filter: false,
            "bLengthChange": false,
            "initComplete": function(settings, json) {
                // alert('done');
                document.getElementById('loader').hidden=true;
              },
            // oLanguage: {
            //     sProcessing: "<div id='loader' class='loader' hidden='false'></div>"
            // },
            // processing : true,
            // "scrollY":"1000px",
            // "scrollCollapse": true,    
            paging:false,
            "columnDefs": [
                  { className: "text-right", "targets": [6,7,8,9,10,11,12,13,14] },
                  { width: "30px", "targets": [6,7,8,9,10,11,12,13,14] }
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
                    "url":"<?php echo base_url('c_debtor_detail/getTable');?>",  
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
            var outstand = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var current = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day1 = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day2 = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day3 = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day4 = api
                .column( 11 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day5 = api
                .column( 12 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day6 = api
                .column( 13 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var day7 = api
                .column( 14 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            
            // var payment = api
            //     .column( 15 )
            //     .data()
            //     .reduce( function (a, b) {
            //         return intVal(a) + intVal(b);
            //     }, 0 );
           
            // Update footer
            $( api.column( 6 ).footer() ).html(
               formatNumber(parseInt(current)+parseInt(day1)+parseInt(day2)+parseInt(day3)+parseInt(day4)+parseInt(day5)+parseInt(day6)+parseInt(day7)) 
            );
            $( api.column( 7 ).footer() ).html(
                formatNumber(current) 
            );
            $( api.column( 8 ).footer() ).html(
                formatNumber(day1) 
            );
            $( api.column( 9 ).footer() ).html(
                formatNumber(day2) 
            );
            $( api.column( 10 ).footer() ).html(
                formatNumber(day3) 
            );
            $( api.column( 11 ).footer() ).html(
                formatNumber(day4) 
            );
            $( api.column( 12 ).footer() ).html(
                formatNumber(day5) 
            );
            $( api.column( 13 ).footer() ).html(
                formatNumber(day6) 
            );
            $( api.column( 14 ).footer() ).html(
                formatNumber(day7) 
            );
            
            // $( api.column( 15 ).footer() ).html(
            //     formatNumber(payment) 
            // );
        },
        // ini ada button submit
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"debtor_name",name:"debtor_name"},  
            {data:"doc_date",name:"doc_date",
            render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               
                               
                               var aa = day+"/"+month+"/"+year;
                   
                               return aa;
                               
                               

                           }

            },
            {data:"due_date",name:"due_date",
            render: function (data, type, row) {

                                var date = new Date(parseInt(data.substr(0,10)));
                                var year =data.substr(0,4);
                                var month=data.substr(5,2);
                                var day =data.substr(8,2);
                               
                               
                               
                               var aa = day+"/"+month+"/"+year;
                      
                               return aa;
                               

                           }

            },
            {data:"doc_no",name:"doc_no"},
            {data:"decs",name:"decs"},
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
            }},
            
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

    // var tblcount = $('#tblcount').DataTable( {
    //         "ajax" : {
    //             "url" : "<?php echo base_url('c_debtor_detail/getTable');?>",
    //             "type": "POST",
    //             "bLengthChange": false,
    //             "initComplete": function(settings, json) {
    //                 // alert('done');
    //                 document.getElementById('loader').hidden=true;
    //               },
    //             paging:false,
    //             "columnDefs": [
    //                   { className: "text-right", "targets": [6,7,8,9,10,11,12,13,14] },
    //                   { width: "30px", "targets": [6,7,8,9,10,11,12,13,14] }
    //                 ],
    //             info:false,
    //             "data":{"debtor": function(d){
    //                     var a = $('#txtDebtor').val();
                        
    //                     var b ="all";
    //                     if(a == null){
    //                         return b;
    //                     }{
    //                         return a;
    //                     }
    //                     // console.log(a);
    //                     },
    //                     "unit": function(d){
    //                     var a = $('#txtUnit').val();
                        
    //                     var b ="all";
    //                     if(a == null){
    //                         return b;
    //                     }{
    //                         return a;
    //                     }
    //                     // console.log(a);
    //                     },
    //                     "cons": function(d){
    //                     var a = $('#txtProject').find(':selected').attr('data-cons');
                        
    //                     var b ="all";
    //                     if(a == null){
    //                         return b;
    //                     }{
    //                         return a;
    //                     }
    //                     // console.log(a);
    //                     },
    //                     "sSearch": function(d){
    //                     var a = $('#txt_search').val();
                        
    //                     var b ="";
    //                     if(a == null){
    //                         return b;
    //                     }{
    //                         return a;
    //                     }

    //                     },
    //                     "project": function(d){
    //                     var a = $('#txtProject').val();
    //                     console.log(a);
    //                     var b ="all";
    //                     if(a == null){
    //                         return b;
    //                     }{
    //                         return a;
    //                     }
    //                     // console.log(a);
    //                     }
    //                 }, 
    //         },
    //         "footerCallback": function ( row, data, start, end, display ) {
    //             var api = this.api(), data;
     
    //             // Remove the formatting to get integer data for summation
    //             var intVal = function ( i ) {
    //                 return typeof i === 'string' ?
    //                     i.replace(/[\$,]/g, '')*1 :
    //                     typeof i === 'number' ?
    //                         i : 0;
    //             };
     
    //             // Total over all pages
    //             var outstand = api
    //                 .column( 6 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
    //             var current = api
    //                 .column( 7 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
    //             var day1 = api
    //                 .column( 8 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
    //             var day2 = api
    //                 .column( 9 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
    //             var day3 = api
    //                 .column( 10 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
    //             var day4 = api
    //                 .column( 11 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
    //             var day5 = api
    //                 .column( 12 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
    //             var day6 = api
    //                 .column( 13 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
    //             var day7 = api
    //                 .column( 14 )
    //                 .data()
    //                 .reduce( function (a, b) {
    //                     return intVal(a) + intVal(b);
    //                 }, 0 );
                
    //             // var payment = api
    //             //     .column( 15 )
    //             //     .data()
    //             //     .reduce( function (a, b) {
    //             //         return intVal(a) + intVal(b);
    //             //     }, 0 );
               
    //             // Update footer
    //             $( api.column( 6 ).footer() ).html(
    //                formatNumber(parseInt(current)+parseInt(day1)+parseInt(day2)+parseInt(day3)+parseInt(day4)+parseInt(day5)+parseInt(day6)+parseInt(day7)) 
    //             );
    //             $( api.column( 7 ).footer() ).html(
    //                 formatNumber(current) 
    //             );
    //             $( api.column( 8 ).footer() ).html(
    //                 formatNumber(day1) 
    //             );
    //             $( api.column( 9 ).footer() ).html(
    //                 formatNumber(day2) 
    //             );
    //             $( api.column( 10 ).footer() ).html(
    //                 formatNumber(day3) 
    //             );
    //             $( api.column( 11 ).footer() ).html(
    //                 formatNumber(day4) 
    //             );
    //             $( api.column( 12 ).footer() ).html(
    //                 formatNumber(day5) 
    //             );
    //             $( api.column( 13 ).footer() ).html(
    //                 formatNumber(day6) 
    //             );
    //             $( api.column( 14 ).footer() ).html(
    //                 formatNumber(day7) 
    //             );
                
    //             // $( api.column( 15 ).footer() ).html(
    //             //     formatNumber(payment) 
    //             // );
    //         },
    //         "columns": [
    //             { data: "row_number", width:'1px', searchable:false,
    //                 render: function (data, type, row) {
    //                     var row_number = row.row_number
    //                     return row_number + '.'
    //                 }
    //             },
    //             {data:"debtor_name"},  
    //             {data:"doc_date",
    //             render: function (data, type, row) {

    //                                 var date = new Date(parseInt(data.substr(0,10)));
    //                                 var year =data.substr(0,4);
    //                                 var month=data.substr(5,2);
    //                                 var day =data.substr(8,2);
                                   
                                   
                                   
    //                                var aa = day+"/"+month+"/"+year;
                       
    //                                return aa;
                                   
                                   

    //                            }

    //             },
    //             {data:"due_date",
    //             render: function (data, type, row) {

    //                                 var date = new Date(parseInt(data.substr(0,10)));
    //                                 var year =data.substr(0,4);
    //                                 var month=data.substr(5,2);
    //                                 var day =data.substr(8,2);
                                   
                                   
                                   
    //                                var aa = day+"/"+month+"/"+year;
                          
    //                                return aa;
                                   

    //                            }

    //             },
    //             {data:"doc_no"},
    //             {data:"decs"},
    //             {data:"current_day",
    //                  render: function (data, type, row) {
    //                     var total = parseFloat(row.current_day)+parseFloat(row.day1_amt)+parseFloat(row.day2_amt)+parseFloat(row.day3_amt)+parseFloat(row.day4_amt)+parseFloat(row.day5_amt)+parseFloat(row.day6_amt)+parseFloat(row.day7_amt);
    //                   return formatNumber(total);  
    //             }},
    //             {data:"current_day",
    //                  render: function (data, type, row) {
    //                   return formatNumber(parseFloat(data));  
    //             }},
    //             {data:"day1_amt",
    //                  render: function (data, type, row) {
    //                   return formatNumber(parseFloat(data));  
    //             }},
    //             {data:"day2_amt",
    //                  render: function (data, type, row) {
    //                   return formatNumber(parseFloat(data));  
    //             }},
    //             {data:"day3_amt",
    //                  render: function (data, type, row) {
    //                   return formatNumber(parseFloat(data));  
    //             }},
    //             {data:"day4_amt",
    //                  render: function (data, type, row) {
    //                   return formatNumber(parseFloat(data));  
    //             }},
    //             {data:"day5_amt",
    //                  render: function (data, type, row) {
    //                   return formatNumber(parseFloat(data));  
    //             }},
    //             {data:"day6_amt",
    //                  render: function (data, type, row) {
    //                   return formatNumber(parseFloat(data));  
    //             }},
    //             {data:"day7_amt",
    //                  render: function (data, type, row) {
    //                   return formatNumber(parseFloat(data));  
    //             }},
    //         ],
    //         "language": {
    //             "decimal": ",",
    //             "thousands": ".",
    //         },
    //         "dom": '<"toolbar count">frtip'
    //     });




    // $("div.count").html(
    //     '<button id="actioncount" class="btn btn-primary pull-up" style="margin-top: 5px">Action</button>&nbsp;'+
    //     '<button id="refresh" class="btn btn-info pull-up" style="margin-top: 5px">Refresh</button>&nbsp;'
    // );
    // tblcount.on('click', 'tr', function() {
    //     if ($(this).hasClass('selected')) {
    //         $(this).removeClass('selected');
    //     } else {
    //         tblcount.$('tr.selected').removeClass('selected');
    //         $(this).addClass('selected');
    //     }
    // });
    // $('#refresh').click(function(){
    //     var state = document.readyState
    //       if (state == 'complete') {
    //           setTimeout(function(){
    //               document.getElementById('interactive');
    //              tblcount.ajax.reload(null,true);
    //              document.getElementById('loader').hidden=true;
    //           },1000);
    //       }
    // })
    

function fn_search(){
    var a = $('#txt_search').val();
    tblcount.ajax.reload(null,true); 
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


$("#txtProduct").change(function() {
          var project = $('#txtProject').val(); 
          var product = $(this).find(':selected').val();          
          if(product!=='') {
            var site_url = '<?php echo base_url("c_report_agent/zoom_property")?>';
            $.post(site_url,
              {product:product,project:project},
              function(data,status) {
                $("#txtProperty").empty();
                $("#txtProperty").append(data);
                $("#txtProperty").trigger('change');
                // $("#TxtphaseCode").trigger('change');
              }
            );
          } else {
            $("#txtProperty").empty();
          }
        });

$("#txtLeadName").change(function() {
          var project = $('#txtProject').val(); 
          var leadname = $(this).find(':selected').val();          
          if(leadname!=='') {
            var site_url = '<?php echo base_url("c_report_agent/zoom_group")?>';
            $.post(site_url,
              {leadname:leadname,project:project},
              function(data,status) {
                $("#txtGroupName").empty();
                $("#txtGroupName").append(data);
                $("#txtGroupName").trigger('change');
                // $("#TxtphaseCode").trigger('change');
              }
            );
          } else {
            $("#txtGroupName").empty();
          }
        });


</script>
