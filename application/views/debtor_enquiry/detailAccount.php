<style type="text/css">
/*  .ifca-font{
    font-family: comic sans ms;
  }*/
</style>


    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">
           <div class="table-responsive">
                <table id="tblAccountDetail" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                    <thead>            
                          <th class="sorting_asc">Doc No</th>
                          <th>Doc Date</th>
                          <th>Ref No</th>
                          <th>Trx Type</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th>Mode</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <!-- <tfoot style="font-weight: bold;background-color: #f2f2f2">
                          <th style="font-weight: bold;" colspan="5" align="center">Total</th>
                           <th>Doc Date</th>
                          <th>Ref No</th>
                          <th>Trx Type</th>
                          <th>Description</th>
                          <th></th>
                          <th></th>
                  </tfoot>  -->
                </table>
            </div>
        </div>   
        <div class="modal-footer">
            <!-- <button type="button" id="btnSave" class="btn btn-primary">Save</button> -->
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
        </div>
    </form>

<script type="text/javascript">
var tblAccountDetail;
  $(document).ready(function () {
    // loaddata();
    var cons = $('#modal').data('cons');
     tblAccountDetail = $('#tblAccountDetail').DataTable( 
    {
         dom: 'Bfrtip',
            responsive: true,
            select: true,
            filter: false,
            paging: false,
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
                var no = $('#modal').data('no');
                var total=0;
                // Total over all pages
                mbase_amt = api
                    .column(5)
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                  mtax_amt = api
                    .column(7)
                    // .data()
                    .data(function(a,b){
                        
                      })
                    .reduce( function (a, b) {
                      
                        return intVal(a) + intVal(b);
                    }, 0 );

                    mdoc_amt = api
                    .column(8)
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                    if(no==4){
                      total = mtax_amt;
                    }else if(no==9){
                      total = mdoc_amt;
                    }
                    else{
                      total = mbase_amt;
                    }
                Totaldetail = total;
                if(total < 0 ){
                  total = total * -1;
                }
                // console.log(no);
                // console.log(formatNumber(total));
                // if(total > 0){
                    //total = formatNumber(total);
                    //var dd = '<tfoot><tr><td colspan="3" align="center"  style="border-top: 2px solid; border-left: 2px solid; border-bottom: 2px solid;">Jumlah</td><td style="border-top: 2px solid; border-bottom: 2px solid; border-right: 2px solid; ">'+formatNumber(total)+'</td></tr></tfoot>';
                    // $('#tblAccountDetail').append(dd);
                    var foot = $("#tblAccountDetail").find('tfoot');

                    var dd = '<tfoot><tr><td colspan="5" align="center" style="border-top: 2px solid; border-left: 2px solid; border-bottom: 2px solid;">Total</td><td style="border-top: 2px solid; border-right: 2px solid; border-bottom: 2px solid;">'+formatNumber(total)+'.00</td><td style="border-top: 2px solid; border-right: 2px solid; border-bottom: 2px solid;"></td></tr></tfoot>';

                    var cc = '<tr style="border:2px solid"><td colspan="5" align="center" style="border-top: 2px solid; border-left: 2px solid; border-bottom: 2px solid;">Jumlah</td><td style="border-top: 2px solid; border-right: 2px solid; border-bottom: 2px solid;">'+formatNumber(total)+'.00</td style="border-top: 2px solid; border-right: 2px solid; border-bottom: 2px solid;"><td></td></tr>';
                    //alert(foot.length);
                    if(foot.length>0){
                        $('#tblAccountDetail tfoot').html(cc);
                    }else{
                        $('#tblAccountDetail').append(dd);
                    }

                // }
            },
            buttons: [              
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_debtor_enquiry_account/getTableAccountDetail');?>",
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
              var dd = debtor_acct;
              return dd;
             },
             "cons":function(d){
              var dd = cons;
              return dd;
             },
             "no":function(d){
              var no = $('#modal').data('no');
              return no;
             }

           },             
            "type":"POST"
        },
        "columns": [
            {data: "doc_no",name:"doc_no", searchable:false},
            {
              data:"doc_date",name:"doc_date", sortable: true,
                render: function(data,type,row){
                  var dd= new Date(data);
            
                // return dd.toLocaleDateString(); 
                return FormatDateTime(dd); 
                    
                }
            },
            {data:"ref_no",name:"ref_no"},
            {data:"trx_type",name:"trx_type"},
            {data:"descs",name:"descs"},
            {
                data:"mbase_amt",name:"mbase_amt",
                render: function(data,type,row){
                  var no = $('#modal').data('no');
                  var Smt=' ';
                  var amt=0;
                   if (no == 4) {
                       amt = row.mtax_amt;
                   } else if (no == 9) {
                       amt = row.mdoc_amt;
                       if (row.trx_mode == 'C') {
                           amt = amt * -1;
                       } else {
                           amt = amt;
                       }

                   } else {
                       amt = data;
                       if (row.trx_mode == 'C') {
                           amt = amt * -1;
                       } else {
                           amt = amt;
                       }

                   }
                  // console.log(row.descs);
                  if (row.trx_mode == 'C') {
                           smt = formatNumber(amt)+'.00' ;
                       } else {
                           smt = formatNumber(amt) ;
                       }
                    return smt;
                }
            },
            {
              data:"trx_mode",name:"trx_mode",
              render: function(data,type,row){
                if(data == 'D'){
                  var str = 'Debit';
                  var result = str.fontcolor("green");
                  return result;
                } else {
                  var str = 'Credit';
                  var result = str.fontcolor("red");
                  return result;
                }
              }
            },
            {data:"mtax_amt",name:"mtax_amt", visible: false}
            ,{data:"mdoc_amt",name:"mdoc_amt", visible: false}
        ]
    });



  });

   

    
    $('#modal').one('hidden.bs.modal', function (e) {
        $(this).removeData();
    });
</script>