

<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>


<script type="text/javascript">

var tblGLrptlist;
$(function(){

    $('.select2').select2();
   tblGLrptlist = $('#tblGLrptlist').DataTable( 
    {
            dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            paging:false,
            filter: false,
            buttons: [
                 {
                    text: ' Add', className: 'biru-bg fa fa-plus hidden', action: function (e) {
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

                        $('#modalTitle').html('Add Column Format');
                        $('div.modal-body').load("<?php echo base_url("c_gl_column/edit");?>");
                        $('#modal').data('MenuID', 0).modal('show');
                    }
                }
            ],
        "serverSide": true,
        "fnInitComplete": function(oSettings) {
                $('#tblGLrptlist thead').hide();
            },
        "ajax":{
                    "url":"<?php echo base_url('c_gl_report/getTable');?>",  
                    "data":{"sSearch": function(d){
                        var a = $('#txt_search').val();
                        // console.log(a);
                        var b ="";
                        if(a == null){
                            return b;
                        }{
                            return a;
                        }
                    },"reportid": function(d){
                        var a = $('#report_id').val();
                        // console.log(a);
                        var b ="";
                        if(a == null){
                            return b;
                        }{
                            return a;
                        }
                    },"rowid": function(d){
                        var a = $('#row_id').val();
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
        // ini ada button submit
        "columns": [
            // {data:"row_number", name:"row_number", searchable:false,visible:false},
            {
                data:"row_descs", name:"row_descs", sortable: false,
                render: function(data, type, row){
                    if(row.indent==null){
                        var indent = 0;
                    } else {
                        var indent = row.indent;
                    }
                    var space='';
                    for (var i = 0; i <= indent; i++) {
                        space+="&emsp;";
                    }
                    if(data==null){
                        data = '';
                    }
                    // console.log(row.row_bold);
                    var str = data;
                    if(row.row_bold=='Y'){
                        str="<b>"+str+"</b>";
                    }
                    if(row.row_italic=='Y'){
                        str="<i>"+str+"</i>";
                    }
                     if(row.row_underline=='Y'){
                        str="<u>"+str+"</u>";
                    }
                    return space+str;
                }
            },
            {data:"ref_no",name:"ref_no", visible:false},
            {data:"indent",name:"indent", visible:false},
            {data:"row_bold",name:"row_bold", visible:false},
            {data:"row_italic",name:"row_italic", visible:false},
            {data:"row_underline",name:"row_underline", visible:false}
            ]
    });
    // $("div.toolbar").html('<div class="input-group" style="padding-bottom: 10px"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblGLrptlist.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblGLrptlist.ajax.reload(null,true);   
        }
    });

});

function fn_search(){
    var txt_search = $('#txt_search').val();
    if(txt_search!=''){
        
        tblGLrptlist.ajax.reload(null,true); 
    }
}

$(document).ready(function(){
   var filter_zero= "<?php echo $datafilter[0]->filter_zero?>";
   if(filter_zero == 'Y'){
        document.getElementById('filter_zero').checked = true;    
    }else{
        document.getElementById('filter_zero').checked = false;
   }
  
  
});

</script>
<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
        <div class="form-group">        
            <div class="tittle-top pull-right">GL Customised Report Format</div>
            <div class="tittle-top pull-left"><button onclick="back();" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button></div>
        </div>
    </section> 
    <section class="wrapper wrapper-content" >
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <div class="row" >
            <div class="col-xs-12">
                <div class="ibox-content" >
                <div class="row">
                    <div class="form-group" style="padding-top: 10px">
                        <label for="group" class="control-label col-sm-2" >Report ID</label>
                        <div class="col-sm-1">
                        <!-- <?php echo $datafilter[0]->report_id?> -->
                             <input type="text" class="form-control" style = "border:none; background-color:white;width:180px" readonly="true" name="report_id" id="report_id" value="<?php echo $datafilter[0]->report_id?>">
                        </div>
                        <label for="group" class="control-label col-sm-2">Description</label>
                        <div class="col-sm-3">
                            <input type="text" style = "border:none; background-color:white;" readonly="true" class="form-control" name="descs" id="descs" value="<?php echo $datafilter[0]->descs?>">
                            <!-- <?php echo $datafilter[0]->descs?> -->
                        </div>
                        <label for="group" class="control-label col-sm-2">Filter Zero</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="filter_zero" id="filter_zero">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" >
                        <label for="group" class="control-label col-sm-2" >Row Format ID</label>
                        <div class="col-sm-1">
                            <input type="text" style = "border:none; background-color:white;" readonly="true" class="form-control" name="row_id" id="row_id" value="<?php echo $datafilter[0]->row_id?>">
                            <!-- <?php echo $datafilter[0]->row_id?> -->
                        </div>
                        <label for="group" class=" control-label col-sm-2" >Report Title</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" style = "border:none; background-color:white;" readonly="true" name="title_descs" id="title_descs" value="<?php echo $datafilter[0]->title_descs?>">
                            <!-- <?php echo $datafilter[0]->title_descs?> -->
                        </div>
                        <label for="group" class="col-sm-2 control-label">Factor</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" style = "border:none; background-color:white;" readonly="true" name="factor" id="factor" >
                        </div>
                    </div>
                
                </div>
              </div>  
            </div>            
        </div><br>
        </form>
        <style type="text/css">
            
div.scrollmenu {
    margin: 0 auto;
    width: 94%;
  
/*    overflow: auto;
    white-space: nowrap;*/
}

div.scrollmenu .haha {
    display: inline-block;
    text-align: center;
    padding: 10px;
    margin: 0px 7px; 
    width: 180px;
}
div.scrollmenu .haha .yas {
    width: 55%;
    margin:0 auto;
    padding: 5px;
    /*font-weight: bold;*/
    /*text-decoration: none;*/
}
.slick-prev {
    left: -40px!important;
}
.slick-prev::before, .slick-next::before {
    font-size: 35px!important;

}

div.scrollmenu .haha .box{
    border:1px solid #000;width: 160px;height: 50px;
    margin:0 auto;
}
div.scrollmenu .haha .box .textinbox{
    padding: 5px;

}

        </style>
<script src="<?php echo base_url('js/plugins/slick/slick.min.js')?>"></script>
  <link href="<?php echo base_url('css/plugins/slick/slick.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('css/plugins/slick/slick-theme.css')?>" rel="stylesheet">
         <div class="row">
            <div class="col-xs-12 ">
                <div class="ibox-content">
                <div style="position: relative;">
                        <div class="scrollmenu" >
                        <?php for ($i=1; $i <=20 ; $i++) { 
                      
                            ?>
                            <div> <!-- slick-content -->
                            <div class="haha" onclick="columnclick(<?php echo $i?>);">
                                <div class="yas">Column <?php echo $i?></div>
                                <div class="box">
                                    <div class="textinbox">
                                            <?php if(!empty($dataheader1[$i])){
                                                
                                                    $header1=$dataheader1[$i];
                                                
                                                } else {$header1 = '';}
                                            
                                            if(!empty($dataheader2[$i])){
                                                $header2 = $dataheader2[$i]; 
                                                } else {$header2 ='';}
                                            if($new['column_justify'.$i]=='2'){
                                                echo '<div style="text-align: right"><b>'.$header1.'</b></div><div style="text-align: right"><b>'.$header2.'</b></div>';
                                            } else if($new['column_justify'.$i]=='1') {
                                                echo '<div style="text-align: center"><b>'.$header1.'</b></div><div style="text-align: center"><b>'.$header2.'</b></div>';
                                            } else {
                                                echo '<div style="text-align: left"><b>'.$header1.'</b></div><div style="text-align: left"><b>'.$header2.'</b></div>';
                                            }
                                        ?>
                                    </div>
                                </div><br>
                            </div>
                            </div><!-- end of slick-content -->
                        <?php 
                         
                        }//end of for looping
                     ?>
                        </div>
                </div>
                </div>
            </div>            
        </div><br>
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table id="tblGLrptlist" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%">                            
                            <thead>
                                <th>Column Id</th>                                
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
<script type="text/javascript">
function back(){
    window.location.href="<?php echo base_url('c_gl_report/index')?>";
}
$(document).ready(function(){
    columnclick(1);
     $('.scrollmenu').slick({
                infinite: false,
                slidesToShow: 5,
                slidesToScroll: 5,
                variableWidth: true,
                centerMode: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
});

function columnclick(col_no){
// alert(col_no);
var factor='';
    var report_id = $('#report_id').val();
    var row_id = $('#row_id').val();
          var site_url = '<?php echo base_url("c_gl_report/get_colformat")?>';
            $.post(site_url,
              {report_id:report_id,row_id:row_id,col_no:col_no},
              function(data,status) {
                console.log(data);
                if(data==0){
                    factor = 'Normal';
                } else if(data==1){
                    factor = 'Dollar';
                } else if(data==10){
                    factor = 'Ten';
                } else if(data==100){
                    factor = 'Hundred';
                } else if(data==1000){
                    factor = 'Thousand';
                } else if(data==1000000){
                    factor = 'Million';
                }
                $("#factor").val(factor);
               
              }
            );

}

</script>