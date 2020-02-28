<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<!-- <table id="table1" class="table table-bordered table-hover dataTable"> -->
<script>
alert('sssss');
var tblAccount;
$(function(){
   tblAccount = $('#tblAccount').DataTable( 
    {
         dom: 'Bfrtip',
            responsive: true,
            select: true,
            filter: false,
            paging: false,
            // "scrollY": "700px",
            buttons: [              
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_debtor_enquiry_account/getTableAccount');?>",
            "data":{
             //    "sSearch": function(d){
             //    var search = $('#txt_search').val();
             //    var b="";
             //    if(search == null || search==""){
             //        return b;
             //    }{
             //        return search;
             //    }
             // },
             "debtor_acct":function(d){
              var dd = '<?php echo $debtor_acct; ?> ';
              return dd;
             }

           },             
            "type":"POST"
        },
        "columns": [
            {data: "no",name:"no", searchable:false},
            {data:"descs",name:"descs", sortable: true},
            {data:"trx_amt",name:"trx_amt"}
        
        ],
        "columnDefs": [
          { className: "dt-left", "targets": [0] },
          { className: "dt-left", "targets": [1] },
          { className: "dt-right", "targets": [2] }          
        ]
    });
    // $("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search() style=" width: auto"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
    $("div.toolbar1").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_searchAccount" name="txt_searchAccount" ><a class="btn blue-bg btn-sm" onclick="fn_search_acct()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_searchAccount").keyup(function(event){
        var a = $('#txt_searchAccount').val();
        
            if(a==''){
                tblAccount.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblAccount.ajax.reload(null,true);   
        }
    });
        //klik row datatable set debtor_acct to global
      tblAccount.on('select', function (e, dt, type, indexes) {
                var data = tblAccount.rows(indexes).data();
                 debtor_acct = data[0].debtor_acct;

            });

});
alert('<?php echo $debtor_acct; ?>' );
</script>
<div id="tab-2" class="tab-pane">
      <div class="panel-body">
            <div class="row">
                <div class="col-xs-6">
                      <fieldset>
                          <legend>A/c Summary</legend>
                          <?php echo $debtor_acct; ?> 
                          <div class="table-responsive">
                          <table id="tblAccount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>            
                                <th class="sorting_asc">No.</th>
                                <th>Descs</th>
                                <th>Amount</th>
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

