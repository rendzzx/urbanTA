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
         dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter:false,
            // "columnDefs": [
            //         { className: "text_right", "targets": [8,9] }
            //                 ],
            
            // "order": [[ 11, "desc" ]],
            // searchDelay:null,
            buttons: [
                    {text: ' ', className: "btn biru-bg fa fa-angle-double-left ", action: function (e) {

                        var row_format = $('#row_formatID').val();
                        if(!row_format){
                            // alert(row_format);
                            swal('Warning','Please select Row Format ','error');
                            return;
                        }
                        
                        var rows = tblGLFormat.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal('Warning','Please select a row','error');
                            return;
                        }

                        var data = tblGLFormat.rows(rows).data();
                        var indent = data[0].indent;
                        if(indent < 1){

                            return;
                        }
                        space_line(data,'kurang');
                        // console.log(data);
                        

                    }},
                    {text: ' ', className: "btn biru-bg fa fa-angle-double-right ", action: function (e) {

                        var row_format = $('#row_formatID').val();
                        if(!row_format){
                            // alert(row_format);
                            swal('Warning','Please select Row Format ','error');
                            return;
                        }
                        
                        var rows = tblGLFormat.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal('Warning','Please select a row','error');
                            return;
                        }

                        var data = tblGLFormat.rows(rows).data();
                        // var indent = data[0].indent;
                        // if(indent < 1){

                        //     return;
                        // }
                        space_line(data,'tambah');

                    }},
                    {text: ' ', className: "btn biru-bg fa fa-angle-double-up ", action: function (e) {

                        var row_format = $('#row_formatID').val();
                        if(!row_format){
                            // alert(row_format);
                            swal('Warning','Please select Row Format ','error');
                            return;
                        }
                        
                        var rows = tblGLFormat.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal('Warning','Please select a row','error');
                            return;
                        }

                        var data = tblGLFormat.rows(rows).data();
                        var seq_id = data[0].seq_id;
                        if(seq_id == 1){
                            swal('Warning','Cant move up this a row','error');
                            return;
                        }
                        space_horizontal(data,'UP');

                    }},
                    {text: ' ', className: "btn biru-bg fa fa-angle-double-down ", action: function (e) {

                        var row_format = $('#row_formatID').val();
                        if(!row_format){
                            // alert(row_format);
                            swal('Warning','Please select Row Format ','error');
                            return;
                        }
                        
                        var rows = tblGLFormat.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal('Warning','Please select a row','error');
                            return;
                        }

                        var data = tblGLFormat.rows(rows).data();
                        // var indent = data[0].indent;
                        // if(indent < 1){

                        //     return;
                        // }
                        space_horizontal(data,'DOWN');

                    }},
                {
                    text: ' New', className: "btn biru-bg fa fa-plus ", action: function (e) {

                          var row_format = $('#row_formatID').val();
                        if(!row_format){
                            // alert(row_format);
                            swal('Warning','Please select Row Format ','error');
                            return;
                        }

                            var rows = tblGLFormat.rows('.selected').indexes();
                     
                        var data = tblGLFormat.rows(rows).data();
                        var seq_id='';
                        var indent =0;
                        if(data[0]){
                                // console.log('1');
                                seq_id = data[0].seq_id;
                                indent = data[0].indent;
                        }

                      


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

                        

                        $('#modalTitle').html('Customise Row Format');
                        $('div.modal-body').load("<?php echo base_url("c_row_format/addnew");?>");
                        $('#modal').data('row_id', row_format);
                        $('#modal').data('seq_id', seq_id);
                        $('#modal').data('indent', indent);
                        $('#modal').data('field_id', '0').modal('show');

                    }
                },
                {
                    text: ' Edit', className: 'btn biru-bg fa fa-pencil ',
                    action: function () {

                         var row_format = $('#row_formatID').val();
                        if(!row_format){
                            // alert(row_format);
                            swal('Warning','Please select Row Format ','error');
                            return;
                        }
                      
                        var rows = tblGLFormat.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal('Warning','Please select a row','error');
                            return;
                        }



                        var data = tblGLFormat.rows(rows).data();

                       var seq_id = data[0].seq_id;
                       var indent = data[0].indent;
                       var field_id = data[0].field_id;


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

                        // console.log('BE');

                        $('#modalTitle').html('Customise Row Format');
                        $('div.modal-body').load("<?php echo base_url("c_row_format/addnew");?>");
                        $('#modal').data('row_id', row_format);
                        $('#modal').data('seq_id', seq_id);
                        $('#modal').data('indent', indent);
                        $('#modal').data('field_id', field_id).modal('show');
                        

                    }
                },
                {
                    text: ' Delete', className: 'btn biru-bg fa fa-trash ',
                    action: function () {

                         var row_format = $('#row_formatID').val();
                        if(!row_format){
                            // alert(row_format);
                            swal('Warning','Please select Row Format ','error');
                            return;
                        }

                        var rows = tblGLFormat.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblGLFormat.rows(rows).data();
                        var MenuID = data[0].MenuID;
                        


                        var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-lg":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                break;
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-sm');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-lg":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                break;
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-sm');
                                break;
                        }

                        var data = tblGLFormat.rows(rows).data();

                       var seq_id = data[0].seq_id;
                       var indent = data[0].indent;
                       var field_id = data[0].field_id;

                        $('#modalTitle').html('Delete Row Format Detail!');

                        $('div.modal-body').html('Are you sure that you want to delete this item?');

                        $('div.modal-body').append('<div class="modal-footer"></div>');

                        var btnYes = $('<input/>')
                            .attr({
                                id: "btnYes",
                                type: "button",
                                class: "btn btn-danger",
                                onclick: 'Delete();',
                                value: 'Yes'
                            });

                        var btnNo = $('<a>No</a>').attr({
                            class: "btn btn-default", 'data-dismiss': "modal"
                        });

                        $('div.modal-footer').append(btnYes);
                        $('div.modal-footer').append(btnNo);

                        $('#modal').data('row_id', row_format);
                        $('#modal').data('seq_id', seq_id);
                        $('#modal').data('indent', indent);
                        $('#modal').data('field_id', field_id).modal('show');
                        

                    }
                }
            ],
        // "processing": true,
        "serverSide": true,
        "ajax":{
            "url":"<?php echo base_url('c_row_format/getTable');?>",  
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
                "row_formatID":function(d){
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
            // {data: "row_number",name:"row_number", searchable:false},            
            {data:"type_Descs",name:"type_Descs"},
            {
                data:"row_descs_space",name:"row_descs_space",sortable: false,
                render: function(data, type, row){
                    // var str = data.replace(/\s/g, "   ");
                    var dta = row.type;
                    var str = row.st_space.replace(/\s/g, "  ");
                    var cl = row.st_colour;
                    var dd='';
                    if(row.indent==0){
                        dd = row.row_descs;    
                        // dd = '<a class="label" style="background-color:'+cl+';" disabled> </a>'+ '   '+row.row_descs;
                    }else{
                        dd = '<a class="label " style="background-color:'+cl+';" disabled> '+str+'</a>'+ '   '+row.row_descs;
                    }
                    
                    return dd;
                }
            },            
            {data:"ref_no",name:"ref_no"},
            {data:"field_id",name:"field_id"},
            {data:"Col_id_descs",name:"Col_id_descs"},            
            {data:"percent_exp",name:"percent_exp"},
            {data:"start_exp",name:"percent_exp"},
            {data:"end_exp",name:"end_exp"}
            // ,           
            ,{data:"row_descs",name:"row_descs",visible:false}
            // {data:"status",name:"status",visible:false},
            // {data:"property_cd",name:"property_cd",visible:false},
            // {data:"rowID",name:"rowID",visible:false}
      
            
            ]
    });
    $("div.toolbar").html('<b>Search : <input type="text" class="form-control" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search"  name="txt_search" > <a class="btn btn-success btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a> </b>');

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
            // alert(a);
            tblGLFormat.ajax.reload(null,true);   
        }
        
    });
});

function fn_search(){
    // alert('ha');
             var a = $('#txt_search').val();
                if(a!=''){
                    tblGLFormat.ajax.reload(null,true);   
                }
        }
 
</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
    <div class="form-group">        
        <div class="tittle-top pull-left"><?php echo $ProjectDescs; ?></div>
        <div class="tittle-top pull-right">Row Format Setup</div>
    </div>    
    </section>
    <section class="row border-bottom white-bg dashboard-header">
     <div class="form-group">
      <label for="row_formatID" class="col-sm-2 control-label"> Choose Row Format ID</label>
        <div class="col-sm-4">
         <select name="row_formatID" id="row_formatID" data-placeholder="Choose a Project..." class="select2" onclick="fn_select_rowformat()" style="width:250px;" tabindex="2">
            <option value=""></option> 
            <!-- <option value="all">All</option> -->
            <?PHP 
           
              echo $row_formatID;
            
            ?>
          </select>           
        </div> 
           <div class="col-sm-2">
                <button id="btn_add_row" class="btn biru-bg" ><i class="fa fa-plus"></i> <span class="hidden-xs">Add</span></button>
           </div>    
      </div>
    </section>

    <div id="load" hidden="true"></div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body">
                            <table id="tblGLFormat" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">
                                <thead>    
                                    <!-- <th>No.</th>  -->
                                    <th>Type</th>   
                                    <th width="30%">Descs</th>
                                    <th>Ref No</th>                                        
                                    <th>Row ID</th>    
                                    <th>Column </th>                                                                    
                                    <th>Calculated / % Expression</th>
                                    <th>Start Range</th>
                                    <th>End Range</th>
                                    <!-- <th>Selling Price</th>
                                    <th>Receipt Amount</th>
                                    <th>Percentage</th>                   -->
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
        $('#btn_add_row').click(function(){
             var modalClass = $('#modal').attr('class');
                        switch (modalClass) {
                            case "modal fade bs-example-modal-md":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                            default:
                                $('#modal').removeClass(modalClass).addClass('modal fade bs-example-modal-md');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                            default:
                                $('#modalDialog').removeClass(modalDialogClass).addClass('modal-dialog modal-md');
                                break;
                        }

                        $('#modalTitle').html('Add Row Format ID');
                        $('div.modal-body').load("<?php echo base_url("c_row_format/add_header");?>");
                        $('#modal').data('MenuID', 0).modal('show');
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
