<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

<div id="tab-8" class="tab-pane">
 <div class="panel-body">
    <div class="row">
        <div class="col-xs-12">
            <fieldset>
              <legend>Sales Info</legend>                                                  
              <div class="table-responsive">
                  <table id="tblsalesinfo" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                    <thead>            
                        <th class="sorting_asc">No.</th>
                        <th>Lot No</th>
                        <th>Sales Date</th>
                        <th>PPJB Date</th>
                        <th>AJB Date</th>
                        <th>Key Collection</th>
                        <th>Selling Price</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
var debtor_acct;
var tblsalesinfo;
$(function(){

   tblsalesinfo = $('#tblsalesinfo').DataTable( 

    {
         dom: 'Bfrtip',
            responsive: true,
            select: true,
            filter: false,
            paging: false,
            // "scrollY": "700px",
            // responsive: true,
            // select: true,
            // filter: false,
            // paging: false,
            // "scrollX":true,
            // "scrollCollapse": true,  
            // "scrollY": "700px",
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                //console.log(data);
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                        i : 0;
                };
                    var sell_price = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                    $( api.column( 6 ).footer() ).html(
                    formatNumber(sell_price) 
                );
                     
                // console.log(mtax_amt);
                // console.log(total);
             
            },
            buttons: [              
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_debtor_enquiry_salesinfo/getTableSalesinfo');?>",
            "data":{
            // "sSearch": function(d){
            //     var search = $('#txt_search').val();
            //     var b="";
            //     if(search == null || search==""){
            //         return b;
            //     }{
            //         return search;
            //     }
            //  },
            "debtor_acct":function(d){
              var dd = debtor_acct;
              return dd;
             }
         },             
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"lot_no",name:"lot_no", sortable: true},
            {data:"sales_date",name:"sales_date"},
            {data:"hand_over_date",name:"hand_over_date"},
            {data:"AJB_date",name:"AJB_date"},
            {data:"key_collection_date",name:"key_collection_date"},
            {data:"sell_price",name:"sell_price",
            render: function(data,type,row){
                    return formatNumber(data);
                }
            }           
        ]
    });
    
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblsalesinfo.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblsalesinfo.ajax.reload(null,true);   
        }
    });
        //klik row datatable set debtor_acct to global
      tblsalesinfo.on('select', function (e, dt, type, indexes) {
                var data = tblsalesinfo.rows(indexes).data();
                 debtor_acct = data[0].debtor_acct;
                 
            });

});

function fn_search(){
    // var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){        
        tblsalesinfo.ajax.reload(null,true); 
    }
}

function fn_tab(data){
    if(!debtor_acct){
        alert('Please select table first');
        return;
    }
    var url;
    

    $('#'+data).load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data+" #"+data );
    // $('#'+data).load(url);
}

</script>