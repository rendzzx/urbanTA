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
<div class="content-wrapper">
	<div class="row border-bottom white-bg dashboard-header">  
		<div class="form-group">
			<div class="tittle-top pull-right">Trial Balance Report</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
		</div> <br>
		 
		<div class="form-group">
			<label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Entity</label>
			<div class="col-sm-10">
				<select name="txtEntity" id="txtEntity" data-placeholder="Choose Entity" class="select2" style="width:250px;" tabindex="2">
					<option value=""></option>
					<?php echo $cbEntity;?>   
					
				</select>
				
			</div>
			<br>
		</div>

        <div class="form-group">
            <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Period</label>
            <div class="col-sm-3">
                <select name="txtPeriod" id="txtPeriod" data-placeholder="Choose Period" class="select2" style="width:250px;" tabindex="2">
                    <option value=""></option>
                    <?php echo $cbPeriod;?>                    
                </select>                
            </div>
            <div class="col-sm-6 control-label" style="margin-left: 40px">
                <button id="search" class="btn blue-bg" ><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
            </div>
            <br>
        </div>





		

	</div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body"> 
                        <!-- <b>&nbsp; NUP Enquiry By Principal</b> -->
                        <br>    
                      
                            <table id="tblcount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>
                                   <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">A/c Period</th>
                                        <th rowspan="2">A/c Type</th>
                                        <th rowspan="2">A/c Code</th>
                                        <th rowspan="2">Description</th>
                                        <th colspan="2" style="text-align: right">Opening Balance</th>
                                        <th colspan="2" style="text-align: right">MTD Amt</th>
                                        <th colspan="2" style="text-align: right">Closing Balance</th>
                                    </tr>
                                    <tr>                                   
                                        <!-- <th >No.</th>
                                        <th >A/c Period</th>
                                        <th >A/c Type</th>
                                        <th >A/c Code</th>
                                        <th >Description</th> -->
                                        <th>Debit Amount</th>
                                        <th>Credit Amount</th>
                                        <th>Debit Amount</th>
                                        <th>Credit Amount</th>
                                        <th>Debit Amount</th>
                                        <th>Credit Amount</th>
                                    </tr>                                                           
                                </thead>
                                <tbody>
                                </tbody> 
                                <tfoot style="font-weight: bold;background-color: #f2f2f2">
                                    <tr>
                                        <th colspan="4"></th>
                                        <th style="text-align: right;font-weight: bold;"> Grand Total : </th>
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
            responsive: true,
            select: true,
            filter: false,
            "bLengthChange": false,
            "initComplete": function(settings, json) {
                // alert('done');
                document.getElementById('loader').hidden=true;
              },
            // "scrollY":"1000px",
            // "scrollX": true,
            // "scrollCollapse": true,    
            paging:false,
            "columnDefs": [
                  { className: "text-right", "targets": [5,6,7,8,9,10] },
                  { width: "10px", "targets": [5,6,7,8,9,10] }
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
                    "url":"<?php echo base_url('c_trial_balance/getTable');?>",  
                    "data":{"period": function(d){
	                var a = $('#txtPeriod').val();	                
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
                    "entity": function(d){
                    var a = $('#txtEntity').val();
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
            // console.log(api);
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
            // console.log(intVal);
 
            // Total over all pages
            var OBDA = api
                .column( 5 )
                .data()                
                .reduce( function (a, b) {

                    return intVal(a) + intVal(b);
                }, 0 );
            var OBCA = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var MTDDA = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    // console.log(a);
                    // console.log('=============================');
                    // console.log(b);
                    return intVal(a) + intVal(b);
                }, 0 );
            var MTDCA = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var CBDA = api
                .column( 9 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
            var CBCA = api
                .column( 10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
           
            // Update footer
            $( api.column( 5 ).footer() ).html(
                formatNumber(OBDA) 
            );
            $( api.column( 6 ).footer() ).html(
                formatNumber(OBCA) 
            );
            $( api.column( 7 ).footer() ).html(
                formatNumber(MTDDA) 
            );
            $( api.column( 8 ).footer() ).html(
                formatNumber(MTDCA) 
            );
            $( api.column( 9 ).footer() ).html(
                formatNumber(CBDA) 
            );
            $( api.column( 10 ).footer() ).html(
                formatNumber(parseInt(CBCA)) 
            );
            
            // $( api.column( 14 ).footer() ).html(
            //    formatNumber(parseInt(current)+parseInt(day1)+parseInt(day2)+parseInt(day3)+parseInt(day4)+parseInt(day5)+parseInt(day6)+parseInt(day7)) 
            // );
           
        },
        // ini ada button submit
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"period",name:"period"},
            {
                data:"acct_type",name:"acct_type",
                render: function(data,type,row){
                if(data == 'A'){
                  var str = 'Asset';
                  // var result = str.fontcolor("green");
                  return str;
                } else if (data == 'L') {
                  var str = 'Liability';
                  // var result = str.fontcolor("red");
                  return str;
                } else if (data == 'C') {
                  var str = 'Capital';
                  // var result = str.fontcolor("red");
                  return str;
                } else if (data == 'E') {
                  var str = 'Expense';
                  // var result = str.fontcolor("red");
                  return str;
                } else {
                  var str = 'Income';
                  return str;
                }
              }
            },
            {data:"acct_cd",name:"acct_cd"},
            {data:"descs",name:"descs"},
            {data:"a",name:"a",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"b",name:"b",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"amount",name:"amount",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"credit_trx",name:"credit_trx",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"e",name:"e",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }},
            {data:"f",name:"f",
                 render: function (data, type, row) {
                  return formatNumber(parseFloat(data));  
            }}
            
            // {data:"opent_amt",name:"opent_amt",
            //      render: function (data, type, row) {
            //     console.log(row);
            //     if(row.opent_amt > 0){                    
            //         return formatNumber(row.opent_amt);  
            //       }else{
            //         return formatNumber(0);
            //       }
                    
            // }},
            // {data:"opent_amt",name:"opent_amt",
            //      render: function (data, type, row) {

            //         if(row.opent_amt <= 0){                    
            //         return formatNumber(row.opent_amt);  
            //       }else{
            //         return formatNumber(row.opent_amt * -1);
            //       }               
            // }},
            // {data:"amount",name:"amount",
            //      render: function (data, type, row) {
            //      // var amt = 0;
            //       return formatNumber(parseFloat(data));  
            // }},
            // {data:"credit_trx",name:"credit_trx",
            //      render: function (data, type, row) {
            //       return formatNumber(parseFloat(data));  
            // }},
            // {data:"amount",name:"amount",
            //      render: function (data, type, row) {
            //      var amt = 0;
            //      if (data > 0){
            //         return formatNumber(parseFloat(data));  
            //      } else {
            //         return formatNumber(parseFloat(0));
            //      }                    
            // }},
            // {data:"amount",name:"amount",
            //      render: function (data, type, row) {
            //      var amt = 0;
            //      if(data <= 0){
            //         amt = data * -1;
            //         return formatNumber(parseFloat(amt));    
            //      } else {
            //         return formatNumber(parseFloat(data));  
            //      }                  
            // }}
            ]
    });

    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

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


$("#txtEntity").change(function() {
    // alert('a');
          var ent = $(this).find(':selected').val();
          // alert(ent);          
          if(ent!=='') {
            console.log(ent);
            var site_url = '<?php echo base_url("c_trial_balance/zoom_period")?>';
            $.post(site_url,
              {ent:ent},
              function(data,status) {
                $("#txtPeriod").empty();
                $("#txtPeriod").append(data);
                $("#txtPeriod").trigger('chosen:updated');
              }
            );
          } else {
            $("#txtPeriod").empty();
          }
        });


</script>
