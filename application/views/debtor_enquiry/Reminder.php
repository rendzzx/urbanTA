<div id="tab-5" class="tab-pane">
      <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                      <fieldset>
                          <legend>Reminder</legend>
                          <div class="table-responsive">
                          <table id="tblreminder" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>            
                                <th class="sorting_asc">No.</th>
                                <th>Trx Type</th>
                                <th>Doc No</th>
                                <th>Doc Date</th>
                                <th>Due Date</th>
                                <th>Reminder No</th>
                                <th>Reminder Date</th>
                                <th>Forex</th>
                                <th style="text-align: right;">Amount</th>
                                
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
var tblreminder;

$(function(){
   tblreminder = $('#tblreminder').DataTable( 
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
            "url":"<?php echo base_url('c_debtor_enquiry_reminder/getTableReminder');?>",
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
            {data:"trx_type",name:"trx_type", sortable: true},
            {data:"doc_no",name:"doc_no"},
            {data:"doc_date",name:"doc_date"},
            {data:"due_date",name:"due_date"},
            {data:"reminder_no",name:"reminder_no"},
            {data:"reminder_date",name:"reminder_date"},
            {data:"currency_cd",name:"currency_cd"},
            {data:"reminder_amt",name:"reminder_amt",
            render: function(data,type,row){
                    return formatNumber(data);
                }
            }
            // {data:"reminder_amt",name:"reminder_amt"}
            

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
        ],
        "columnDefs": [          
          { className: "dt-right", "targets": [8] }          
        ]
    });

   
    // $("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search() style=" width: auto"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblnewsfeed.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblnewsfeed.ajax.reload(null,true);   
        }
    });
        //klik row datatable set debtor_acct to global
      tblnewsfeed.on('select', function (e, dt, type, indexes) {
                var data = tblnewsfeed.rows(indexes).data();
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
    //     switch(data) {
    //     case 'tab-1':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-2':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-3':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-4':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-5':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-6':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    //         break;
    //     case 'tab-7':
    //         url ="<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data" #"+data;
    // } 

    $('#'+data).load( "<?php echo base_url('c_debtor_enquiry/goto_tab');?>"+"/"+debtor_acct+"/"+data+" #"+data );
    // $('#'+data).load(url);
}

</script>