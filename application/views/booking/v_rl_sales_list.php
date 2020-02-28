<link href="<?=base_url('datatable/media/css/jquery.dataTables.min.css');?>" rel="stylesheet" type="text/css" >
<link href="<?=base_url('datatable/extensions/Buttons/css/buttons.dataTables.css')?>" rel="stylesheet" />
<link href="<?=base_url('datatable/extensions/Responsive/css/responsive.dataTables.min.css')?>" rel="stylesheet" />
<!-- <link href="<?=base_url('choosen/chosen.min.css')?>" rel="stylesheet" /> -->
<link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />

<script src="<?=base_url('datatable/media/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/media/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Responsive/js/dataTables.responsive.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Select/js/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('datatable/extensions/Buttons/js/dataTables.buttons.js')?>" type="text/javascript"></script> 

<!-- 
<script src="<?=base_url('choosen/chosen.jquery.js')?>" type="text/javascript"></script>
<script src="<?=base_url('choosen/prism.js')?>" type="text/javascript" charset="utf-8"></script>
 -->
<script type="text/javascript">
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
var project;


var tblsales;
$(function(){


   tblsales = $('#tblsales').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
            order: [[ 7, "desc"]],
            // searchDelay:null,
            buttons: [
                {
                    text: ' Add', className: "bg-orange fa fa-plus btn-sm", action: function (e) {

                        var status='I';
                        var site_url = '<?php echo base_url("c_rl_sales/indexfromlist")?>';
                         
                       // var url = '<?php echo base_url("c_nup/cek_agent")?>';
                       //  $.post(url,
                       //    {status:status},
                       //    function(data,status) {
                       //      // console.log(data);
                       //      if(data ==0){
                       //          BootstrapDialog.alert('Only Agent can Entry NUP');
                       //          return false;
                       //      }
                            window.location.href= site_url+"/0";
                          // if(data=='FAIL'){

                          // }
                        //   }
                        // );
                        
                        


                    }
                },
                {
                    text: ' Edit', className: 'bg-orange fa fa-pencil btn-sm',
                    action: function () {
                      
                        var rows = tblsales.rows('.selected').indexes();
                        if (rows.length < 1) {
                            BootstrapDialog.alert('Please select a row');
                            return;
                        }

                        var data = tblsales.rows(rows).data();
                        var status = data[0].status;
                        var ID = data[0].rowID;    
                        // alert(status);
                        
                        var st= new Array('B','E');
                        
                        if((st.indexOf(status)) < 0 ){
                            BootstrapDialog.alert('Only Status Approve and Pending ');
                            return;
                        }
// BootstrapDialog.alert(ID);
// BootstrapDialog.alert(status);
                        var site_url = '<?php echo base_url("c_rl_sales/indexfromlist")?>'+'/'+ID;
               
                        
                        window.location.href= site_url;
                        

                    }
                },
                {
                    text: ' Billing', className: 'btn-success fa fa-pencil btn-sm',
                    action: function () {
                      
                        var rows = tblsales.rows('.selected').indexes();
                        if (rows.length < 1) {
                            BootstrapDialog.alert('Please select a row');
                            return;
                        }

                        var data = tblsales.rows(rows).data();
                        var status = data[0].status;
                        var lot_no =data[0].lot_no;
                        var debtor_acct = data[0].debtor_acct;
                        var ID = data[0].rowID;    
                        // alert(lot_no);
                        
                        var st= new Array('B');
                        
                        if((st.indexOf(status)) < 0 ){
                            BootstrapDialog.alert('Only Status Approve');
                            return;
                        }

                        // var site_url = '<?php echo base_url("c_sales_billing/billing")?>'+'/'+lot_no;
               
                        // window.location.href= site_url;

                        var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                            $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                            break;
                            default:
                        $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                            break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }

                        $('#modalTitle').html(' Billing Schedule');
                        $('div.modal-body').load("<?php echo base_url("c_sales_billing/billing");?>"+"/"+lot_no);
                        $('#modal').data('id', 0).modal('show');
                    }
                },
                {
                    text: ' Print', className: 'bg-orange fa fa-print btn-sm',
                    action: function () {
                      
                        var rows = tblsales.rows('.selected').indexes();
                        if (rows.length < 1) {
                            BootstrapDialog.alert('Please select a row');
                            return;
                        }

                        var data = tblsales.rows(rows).data();
                        var status = data[0].status;
                        var lot_no =data[0].lot_no;
                        var debtor_acct = data[0].debtor_acct;
                        var ID = data[0].rowID;                        
                        // alert(lot_no+'<br>'+debtor_acct);
                        var st= new Array('B');
                        
                        if((st.indexOf(status)) < 0 ){
                            BootstrapDialog.alert('Only Status Approve ');
                            return;
                        }
// BootstrapDialog.alert(ID);
// BootstrapDialog.alert(status);
                        var site_url = '<?php echo base_url("c_reports/sp")?>'+'/'+debtor_acct+'/'+lot_no;
               
                        window.open(site_url,'_blank');
                        // window.location.href= site_url;
                        

                    }
                },
                {
                    text: ' Back ', className: 'bg-orange fa fa-arrow-left btn-sm', action: function (e) {
                        var project = "<?php echo $project_no?>";
                        var desc = "<?php echo $ProjectDescs; ?>";
                        var aa=project+'-'+desc;
                        // BootstrapDialog.alert(project);
                         window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+aa;
                    }
                },
                {
                    text: ' Reload ', className: 'bg-orange fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                                 tblsales.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }

                       // document.getElementById('loader').hidden=false;
                       // tblnup.ajax.reload(null,true);
                       // document.getElementById('loader').hidden=true;
                    }
                }
                
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_rl_sales_list/getTable');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             }},           
            "type":"POST"
        },
        "columns": [
            // {data: "row_number",name:"row_number",searchable:false,orderable:false } ,            
            {data:"SP_No",name:"SP_No"},            
            {
              data:"business_id",name:"business_id",
              render: function (data, type, row) {
                // return '<a href = "'+base_url('c_cf_business/editCustomer/')'">'+row.NAME+'<a>';
                return '<a href = "#" onclick="to_customer('+data+')">'+row.NAME+'</a>'
              }
            },
            {data:"lot_no",name:"lot_no"},
            {data:"payment_plan",name:"payment_plan"},
            {
              data:"sell_price",name:"sell_price",
              render: function (data, type, row) {
                return formatNumber(data);  
              }
            }, 
            {data:"status_desc",name:"status_desc"},
            {
                data:"sales_date",name:"sales_date"
                // ,
                // render: function (data, type, row) {

                //                 var date = new Date(parseInt(data.substr(0,10)));
                //                 var year =data.substr(0,4);
                //                 var month=data.substr(5,2);
                //                 var day =data.substr(8,2);
                               
                //                // BootstrapDialog.alert(data);
                //                // var aa=date.getDate() + "/" + (month.length > 1 ? month : "0" + month) + "/" + date.getFullYear();
                //                var aa = day+"/"+month+"/"+year;
                //                 return aa;
                               
                               
                //                // return <?php echo date('d-m-Y',strtotime(" ?>+data+ <?php "))?>;
                //                // return <?php echo date('d-m-Y',strtotime("2016-09-04 12:00:45"))?>;

                //            }
            },                
            {data:"rowID",name:"rowID",visible:false},
            {data:"NAME",name:"NAME",visible:false},
            {data:"status",name:"status",visible:false},
            {data:"debtor_acct",name:"debtor_acct",visible:false}
            
            ]
    });
    $("div.toolbar").html('<b>Search : <input type="text" style="width: 150px;" id="txt_search"  name="txt_search" > <a class="btn btn-success btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a> </b>');

    // $('#txt_search').change(function(){
    //     // BootstrapDialog.alert('asdf');
    // });
     $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        if(a==''){
            tblsales.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            // $("#id_of_button").click();
            
            tblsales.ajax.reload(null,true);   
        }
        
    });
});
function fn_search(){
    var a = $('#txt_search').val();
    tblsales.ajax.reload(null,true); 
}
function to_customer(data){
  // alert(data);
  var id = data
        // if(id==''){
        //   alert('Please Select Customer First!');
        //   return;
        // }
                                                        
        var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }

                        $('#modalTitle').html('Edit Customer');

                        $('div.modal-body').load("<?php echo base_url("c_cf_business/Index");?>");

                        $('#modal').data('id', id).modal('show');
}
function Print(seqno,hasil){
    var ab='';
    // var site_url = '<?php echo base_url("c_nup/check_attachment")?>';
    // $.post(site_url,
    //      {seqno:seqno,from:'out'},
    //  function(data,status) {
    // console.log(data);
    
    //     hasil = data;
    //     // BootstrapDialog.alert(result);
    //     // return result;
    // console.log('11 '+hasil);    
    // // return ab.toString();
    // });
    // var a = result;
    $.ajax({
        url :"<?php echo base_url("c_nup/check_attachment")?>",
        type:"POST",
                    // data:$('#form_rl_sales').serialize(),
        data: { seqno:seqno,from:'out' },
        dataType:"json",
        success:function(event, data){
            BootstrapDialog.alert(event.pesan);
            ab = event.Pesan;
            console.log(event);
        console.log('12 '+ab);
    return ab;
        },                    
        error: function(jqXHR, textStatus, errorThrown){                             
        }
    });

    
    
    

}
//    var count=10;
//         var duration = count;
         
//         var counter=setInterval(timer, 1000);
//         function timer(){
          
//           if (count < 0)
//           {
//             // var property_cd = $('#pl_property').val();   
//             count = duration;
//             // $('#table1').load( "<?php echo base_url('c_booking_by_floor/goto_table_sales');?>"+"/"+property_cd+" #table1");
//             tblsales.ajax.reload(null,true);
            
//           }
//          document.getElementById("time").innerHTML='Reload In : '+count;
//          // display2 = 'Reload In : '+count;
//          count=count-1;
//        }
// //END set Countdown with reload table
// //function stop countdown when modal hide  
//     function stoptime(){
//        clearInterval(counter);
//     }
   
</script>
<style type="text/css">
    .font-color{
        color: #667;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
    <div class="form-group">        
        <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div>
        <div class="tittle-top pull-right"><b>Booking List</b></div>
    </div>
    </section>
    <div id="loader" class="loader" hidden="true"></div>
    <section class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <!-- <div class="pull-right font-color">
                            <span id="time"></span>
                        </div> -->
                        <table id="tblsales" class="display table-striped table-condensed" cellspacing="0" width="100%">
                            <thead>    
                                <th>SP No.</th>                                        
                                <th>Name</th>                                
                                <th>Unit</th>
                                <th>Payment Plan</th>
                                <th>Sales Price</th>
                                <th>Sales Status</th>
                                <th>Sales Date</th>                                
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- <script src="<?=base_url('choosen/jquery.min.js')?>" type="text/javascript"></script> -->

<!-- <link href="<?=base_url('datatable/extensions/Select/css/select.dataTables.min.css')?>" rel="stylesheet" />  -->



<script type="text/javascript">
//End choosen properties      
// var config = {
//         '.chosen-select'           : {},
//         '.chosen-select-deselect'  : {allow_single_deselect:true},
//         '.chosen-select-no-single' : {disable_search_threshold:10},
//         '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
//         '.chosen-select-width'     : {width:"95%"}
//       }
//       for (var selector in config) {
//         $(selector).chosen(config[selector]);
//       }
//End choosen properties      
</script>

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
<div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div id="modal2Dialog" class="modal-dialog">

        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h5 class="modal-title" id="modal2Title"></h5>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" id="modal2body"> 
            </div>
        </div>

    </div>
</div>