 <html>
 <head>
    <link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
  </head>
  <body>
  <div class="row wrapper border-bottom white-bg page-heading" style="background: #e8e8e8">
  <div class="col-lg-10">
    <h2 style="color: #0a3a99"><?php echo $ProjectDescs; ?></h2>
    <font color="#00000" face="ARIAL" size="4">Download</font>
  </div>
  <div class="col-lg-2">
  </div>
</div>
  <script type="text/javascript">
    var tbldownload;
$(function(){
   tbldownload = $('#tbldownload').DataTable( 
    {
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter: false,
            buttons: [
                {
                },
            ],
        "processing": false,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_download/getTable');?>",
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
            {data:"row_number",name:"row_number", searchable:false},
            {data:"descs",name:"descs", sortable: false},
            {data:"url",name:"url", sortable: true,
            render:function (data,type,row) {
                    var button = '<a href="http://35.197.137.111/WaskitaAPI2/pdf/'+data+'" target="_blank"><button class="btn btn-block btn-success">Download&nbsp&nbsp<i class="fa fa-download"></i></button></a><br>'
                    return button;
                }}
        ]
    });
    // $("div.toolbar").html('<b>Search :<div class="input-group"><div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" >&nbsp;<a class="btn blue-bg btn-sm" onclick="fn_search()" style=" width: auto;"><i class="fa fa-search"></i></a> </div></div></b>&nbsp;');
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');
    $("#txt_search").keyup(function(event){

        var a = $('#txt_search').val();
        
            if(a==''){
                tbldownload.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tbldownload.ajax.reload(null,true);   
        }
    });

});

function fn_search(){
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){
    document.getElementById('loader').hidden=false;
                var state = document.readyState
                    if (state == 'complete') {
                        setTimeout(function(){
                            document.getElementById('interactive');
                            tblnewsfeed.ajax.reload(null,true); 
                            document.getElementById('loader').hidden=true;
                        },1000);
                    }        
         
    }
}

  </script>

  <div id="loader" class="loader" hidden="true"></div>

<div class="content-wrapper">
    <!-- <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="tittle-top pull-right">Download</div>
        </div>
    </div> -->
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tbldownload" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                                    <!-- display table-striped table-condensed -->
                            <thead>            
                                <th class="sorting_asc">No</th>
                                <th>Descs</th>
                                <th style="text-align: center;">Action</th>
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

  </body>
  </html>