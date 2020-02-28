<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
 <script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">



 <style type="text/css">
  #loader{
    width:80%;
    height:100%;x
    position:fixed;
    z-index:9999;
    background:url("../img/loading.gif") no-repeat center center     
}
.text_right{
       text-align: right;
       padding-right: 30px !important;
    }
</style>

<script type="text/javascript">

function formatNumber(data) 
      {
        return data.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")

      }
window.history.forward();
var project;

var tblGLFormat;
$(function(){


   tblGLFormat = $('#tblGLFormat').DataTable( 
    {
         dom: 'Bfrti',
            responsive: true,
            select: true,
            filter:false,
            "paging": false,
            "scrolly": true,
            // "columnDefs": [
            //         { className: "text_right", "targets": [8,9] }
            //                 ],
            
            // "order": [[ 11, "desc" ]],
            // searchDelay:null,
            buttons: [
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_print_gl_report/getTable');?>",  
            "data":{"sSearch": function(d){
                var a = $('#txt_search').val();
                // console.log(a);
                var b ="";
                if(a == null){
                    return b;
                }{
                    return a;
                }
                
             },
                "report_id":function(d){
                var a = $('#row_formatID').val();
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
            {
                data:"row_descs",name:"row_descs",sortable: false,
                render: function(data, type, row){
                    // var str = data.replace(/\s/g, "   ");
                    // var dta = row.type;
                    var str = row.space_descs.replace(/\s/g, "   ");
                    // var cl = row.st_colour;
                    var dd='';
                    // if(row.indent==0){
                    //     dd = row.row_descs;    
                    //     // dd = '<a class="label" style="background-color:'+cl+';" disabled> </a>'+ '   '+row.row_descs;
                    // }else{
                    //     dd = '<a class="label " style="background-color:'+cl+';" disabled> '+str+'</a>'+ '   '+row.row_descs;
                    // }
                    dd = str+data;
                    return dd;
                }
            },            
            {data:"ref_no",name:"ref_no"}
            // ,{data:"row_descs",name:"row_descs",visible:false}
            // {data:"status",name:"status",visible:false},
            // {data:"property_cd",name:"property_cd",visible:false},
            // {data:"rowID",name:"rowID",visible:false}
      
            
            ]
    });
    // $("div.toolbar").html('<b>Search : <input type="text" class="form-control" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search"  name="txt_search" > <a class="btn btn-success btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a> </b>');

    // $('#txt_search').change(function(){
    //     // BootstrapDialog.alert('asdf');
    // });
     $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        if(a==''){
            tblGLFormat.ajax.reload(null,true);   
        }

        if(event.keyCode == 13){
            // $("#id_of_button").click();
            alert(a);
            tblGLFormat.ajax.reload(null,true);   
        }
        
    });
});


 
</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">    
    <div class="form-group">        
        <div class="tittle-top pull-left"><?php echo $ProjectDescs; ?></div>
        <div class="tittle-top pull-right">GL Customised Report</div>
    </div>    
    </section>

    <section class="row border-bottom white-bg dashboard-header">
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
     <div class="form-group">
      <label for="row_formatID" class="col-sm-2 control-label"> Choose Report ID</label>
        <div class="col-sm-8">
         <select name="row_formatID" id="row_formatID" data-placeholder="Choose a Project..." class="select2"  style="width:100%;" onclick="fn_select_rowformat()" tabindex="2">
            <option value=""></option> 
            <!-- <option value="all">All</option> -->
            <?PHP 
           
              echo $row_formatID;
            
            ?>
          </select>           
        </div> 
           <div class="col-sm-2">
                <!-- <button id="btn_add_row" class="btn biru-bg" ><i class="fa fa-plus"></i> <span class="hidden-xs">Add</span></button> -->
           </div>    
      </div>
      </form>
    </section>
    <section class="row border-bottom white-bg dashboard-header">
      <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
        <div class="box-body">             
            <div class="form-group">
                <label for="row_formatID" class="col-sm-2 control-label"> Period</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="txt_period" id="txt_period" placeholder="YYYYDD" >          
              </div>    
            </div>
            <div class="form-group">
                <label for="row_formatID" class="col-sm-2 control-label"> Description</label>
               <div class="col-sm-8">
                    <input type="text" class="form-control" name="txt_period" id="txt_period" placeholder="" >          
                </div>   
          </div>

           
        </div>  
        <div class="modal-footer">
            <button type="button" id="btnSave" class="btn btn-primary" style="float: left">Print Customised Rerport</button>
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        </div>
    </form>
    </section>

    <div id="load" hidden="true"></div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body" style="height: 350px;">
                            <table id="tblGLFormat" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                <thead>    
                                    <th>No.</th>
                                    <th width="65%">Description</th>
                                    <th width="30%">Reference No</th>
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

<script type="text/javascript">
    $(function(){
        $('.select2').select2();

        $('#row_formatID').on("change",function(e){
    // alert('a'); 
    // alert('fot');
            var formatID = $(this).find(':selected').val();
            // alert(formatID);
            tblGLFormat.ajax.reload(null,true);
        // document.getElementById('loader').hidden=false;
   
        // document.getElementById('loader').hidden=true;
        
      });
      

    });

    function space_line(data,TaKu){
        var row_format = $('#row_formatID').val()
        var seq_id      = data[0].seq_id;
        var tt = TaKu;
        // alert(TaKu);
        // return;
        document.getElementById('loader').hidden=false;
         $.ajax({
                    url : "<?php echo base_url('c_row_format/space_line');?>",
                    type:"POST",
                    data: { "row_format": row_format,
                            "seq_id":seq_id,
                            "Taku":tt},
                    dataType:"json",
                    success:function(event, data){
                        document.getElementById('loader').hidden=true;
                    if(event.St !='OK'){
                        swal('Warning',event.Pesan,'error');
                    }

                        tblGLFormat.ajax.reload(null,true);  
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                        document.getElementById('loader').hidden=true;
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
                    }
                    });
    }
      function space_horizontal(data,TaKu){
        var row_format = $('#row_formatID').val()
        var seq_id      = data[0].seq_id;
        var field_id   = data[0].field_id;
        var tt = TaKu;
        // alert(data[0].field_id);
        // return;
        document.getElementById('loader').hidden=false;
         $.ajax({
                    url : "<?php echo base_url('c_row_format/space_horizontal');?>",
                    type:"POST",
                    data: { "row_format": row_format,
                            "seq_id":seq_id,
                            "field_id":field_id,
                            "Taku":tt},
                    dataType:"json",
                    success:function(event, data){
                        document.getElementById('loader').hidden=true;
                    if(event.St !='OK'){
                        swal('Warning',event.Pesan,'error');
                    }

                        tblGLFormat.ajax.reload(null,true);  
                    },                    
                    error: function(jqXHR, textStatus, errorThrown){
                        document.getElementById('loader').hidden=true;
                        swal("Information",textStatus+' Save : '+errorThrown,"warning");
                     
                    }
                    });
    }
    function Delete() {
    var row_id = $('#modal').data('row_id');        
        var field_id = $('#modal').data('field_id');  
        var seq_ID   = $('#modal').data('seq_id');  
        var indent   = $('#modal').data('indent'); 
    // alert(MenuID);
    $.ajax({
        url : "<?php echo base_url('c_row_format/Delete');?>",
        type:"POST",
        data: { row_id: row_id,
                field_id:field_id,
                seq_ID:seq_ID,
                 indent:indent},
        dataType:"json",
        success:function(event, data){
                // BootstrapDialog.alert(event.Pesan);
                swal("Information",event.Pesan,"warning");
                $('#modal').modal('hide');
                tblnewsfeed.ajax.reload(null,true); 
        },                    
        error: function(jqXHR, textStatus, errorThrown){        
                // BootstrapDialog.alert(textStatus+' Save : '+errorThrown);
                swal("Information",textStatus+' Save : '+errorThrown,"warning");

        }
    });
}
</script>
