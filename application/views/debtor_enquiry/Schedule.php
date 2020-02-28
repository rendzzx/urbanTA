<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>

<div id="tab-7" class="tab-pane">
      <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                      <fieldset>
                          <legend>Schedule</legend>
                          <div class="table-responsive">
                          <table id="tblschedule" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>            
                                <th class="sorting_asc">No.</th>
                                <th>Bill Date</th>
                                <th>Bill Type</th>
                                <th>Trx</th>
                                <th>Description</th>
                                <th>Tax Code</th>
                                <th>Forex</th>
                                <th>Trx Amt</th>
                                <th></th>
                                
                            </thead>
                            
                            <tbody>
                            <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                
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
var tblschedule;
$(function(){

   tblschedule = $('#tblschedule').DataTable( 

    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter: false,
            paging: false,
            "scrollY": "700px",
            buttons: [              
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_debtor_enquiry/getTableSchedule');?>",
            "data":{"sSearch": function(d){
                var search = $('#txt_search').val();
                var b="";
                if(search == null || search==""){
                    return b;
                }{
                    return search;
                }
             }},             
            "type":"POST"
        },
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"bill_date",name:"bill_date", sortable: true},
            {data:"bill_type",name:"bill_type"},
            {data:"trx_type",name:"trx_type"},
            {data:"descs",name:"descs"},
            {data:"tax_scheme",name:"tax_scheme"},
            {data:"currency_cd",name:"currency_cd"},
            {data:"trx_amt",name:"trx_amt"},
            {
                data:"STATUS",name:"STATUS",
                render:function(data,type,row){
                    if(data == 'Y'){
                        return '<img src="<?=base_url("img/Y.png")?>" />';
                    }else{
                        return '<img src="<?=base_url("img/X.png")?>" />';
                    }
                }
            }
            

            // {
            //     data:"status",name:"status",sortable: true, searchable:false,
            //     render:function (data,type,row) {
            //         if(data==1){
            //             return 'Active';
            //         }else{
            //             return 'Absolute';
            //         }
            //     }
            // }
        ]
    });


    // $("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search() style=" width: auto"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblschedule.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblschedule.ajax.reload(null,true);   
        }
    });
        //klik row datatable set debtor_acct to global
      tblschedule.on('select', function (e, dt, type, indexes) {
                var data = tblschedule.rows(indexes).data();
                 debtor_acct = data[0].debtor_acct;
                 
            });

});

function fn_search(){
    // var project = $('#txt_Pl_Project').val();
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){        
        tblnewsfeed.ajax.reload(null,true); 
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