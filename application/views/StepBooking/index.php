<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>



 <style type="text/css">
  #load{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
</style>

<script type="text/javascript">
function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
window.history.forward();
var project;

var tblnup;
$(function(){


   tblnup = $('#tblnup').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
            // "order": [[ 11, "desc" ]],
            // searchDelay:null,
            buttons: [
                {
                    text: ' Add', className: "btn biru-bg fa fa-plus ", action: function (e) {

                        var site_url = '<?php echo base_url("c_stepbooking/index")?>';
                         
                      
                        
                        window.location.href= site_url;

                    }
                }
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_stepbooking/getTable');?>",  
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
            {data: "row_number",name:"row_number", searchable:false},
            {data:"SP_No",name:"SP_No"},
            {data:"NAME",name:"NAME"},            
            {data:"lot_no",name:"lot_no"},
            {data:"payment_plan",name:"payment_plan"},
            {
                data:"sell_price",name:"sell_price",
                render: function(data,type,row){
                    return formatNumber(data);
                }
            },  
            {data:"status_desc",name:"status_desc"},            
            {data:"sales_date",name:"sales_date"}
            // {
            //     data:"sales_date",name:"sales_date",
            //     render: function (data, type, row) {

            //                     var date = new Date(parseInt(data.substr(0,10)));
            //                     var year =data.substr(0,4);
            //                     var month=data.substr(5,2);
            //                     var day =data.substr(8,2);
                               
                               
            //                    var aa = day+"/"+month+"/"+year;
            //                     return aa;       

            //                }
            // }
            
            ]
    });
    $("div.toolbar").html('<b>Search : <input type="text" class="form-control" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search"  name="txt_search" > <a class="btn btn-success btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a> </b>');

    // $('#txt_search').change(function(){
    //     // BootstrapDialog.alert('asdf');
    // });
     $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        if(a==''){
            tblnup.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            // $("#id_of_button").click();
            
            tblnup.ajax.reload(null,true);   
        }
        
    });
});
function fn_search(){
    var a = $('#txt_search').val();
    tblnup.ajax.reload(null,true); 
}
 
</script>
<!-- <div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div>
        <div class="tittle-top pull-right"><b>NUP</b></div>
    </div>
    </section><br>
    <div id="load" hidden="true"></div>
    <section class="content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblnup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                            <thead>    
                                <th>No.</th>    
                                <th>SP No.</th>
                                <th>Name</th>                                        
                                <th>Unit</th>                                
                                <th>Payment Plan</th>
                                <th>Sell Price</th>
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
</div> -->

<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div>
        <div class="tittle-top pull-right"><b>NUP</b></div>
    </div>
    </section>
    <div id="load" hidden="true"></div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body">
                            <table id="tblnup" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                <thead>    
                                    <th>No.</th>    
                                    <th>SP No.</th>
                                    <th>Name</th>                                        
                                    <th>Unit</th>                                
                                    <th>Payment Plan</th>
                                    <th>Sell Price</th>
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
        </div>
    </div>
</div>

