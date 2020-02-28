<script src="<?php echo base_url('js/plugins/slick/slick.min.js')?>"></script>
<link href="<?php echo base_url('css/plugins/slick/slick.css')?>" rel="stylesheet">
<link href="<?php echo base_url('css/plugins/slick/slick-theme.css')?>" rel="stylesheet">

<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />

<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>

<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<style type="text/css">
#loader{
    width:80%;
    height:100%;
    position:fixed;
    z-index:9999;
    background:url(<?php echo base_url("img/loading.gif")?>) no-repeat center center     
    }
  .has-error .select2 {
      border: 1px solid #a94442;
      border-radius: 4px;
 
    }

    .has-error .checkbox-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }

    .has-error .radio-inline {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
    label {text-align: right;}
    .has-error .select2-selection {
      border: 1px solid #a94442;
      border-radius: 4px;
    }
div.scrollmenu {
    margin: 0 auto;
    width: 94%;
  
/*    overflow: auto;
    white-space: nowrap;*/
}
.slick-prev {
    left: -40px!important;
}
.slick-prev::before, .slick-next::before {
    font-size: 35px!important;

}

div.scrollmenu .haha {
    display: inline-block;
    text-align: center;
    padding: 10px;
    width: 220px;
    margin: 0px 10px; 
}
div.scrollmenu .haha .yas {
    width: 55%;
    margin:0 auto;
    padding: 5px;
    /*font-weight: bold;*/
    /*text-decoration: none;*/
}
div.scrollmenu .haha .box{
    border:1px solid #000;width: 200px;height: 75px;
    margin:0 auto;
}
div.scrollmenu .haha .box .textinbox{
    padding: 5px;

}

</style>


<div id="loader" class="loader" hidden="true"></div>

<div class="content-wrapper">
    <section class="row border-bottom white-bg dashboard-header">
        <div class="form-group">        
            <div class="tittle-top pull-right">GL Customised Report Format <?php echo $form;?></div>
            <div class="tittle-top pull-left"><button onclick="back();" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back</button>&nbsp;<button id="btnSave" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save</button></div>
        </div>
    </section> 
    <section class="wrapper wrapper-content" >
    <form id ="frmEditor" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <div class="row" >
            <div class="col-xs-12">
                <div class="ibox-content" >
                <div class="row">
                    <div class="form-group" style="padding-top: 10px">
                        <label for="group" class="col-sm-2" >Report ID</label>
                        <div class="col-sm-2">
                             <input type="text" class="form-control" name="report_id" id="report_id">
                        </div>
                        <label for="group" class="col-sm-2">Description</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="descs" id="descs">
                        
                        </div>
                        <label for="group" class="col-sm-2">Filter Zero</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="filter_zero" id="filter_zero">
                            <input type="hidden" name="filter_zero_val" id="filter_zero_val">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group" >
                        <label for="group" class="col-sm-2" >Row Format ID</label>
                        <div class="col-sm-2">
                            <select name="row_id" id="row_id" data-placeholder="Choose Row Format..." class="form-control select2" tabindex="2">
                                  <option value=""></option>
                                  <?php echo $cbrowformat?>
                              </select>
                        </div>
                        <label for="group" class="col-sm-2" >Report Title</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control" name="title_descs" id="title_descs" >
                            
                        </div>
                       <!--  <label for="group" class="col-sm-1">Factor</label>
                        <div class="col-sm-2">
                            <select name="factorr" id="factorr" data-placeholder="Choose Factor..." class="form-control select2"  tabindex="2">
                                <option selected="1" value="0">Normal</option>
                                <option value="1">Dollar</option>
                                <option value="10">Ten</option>
                                <option value="100">Hundred</option>
                                <option value="1000">Thousand</option>
                                <option value="1000000">Million</option>
                            </select>
                        </div> -->
                    </div>
                
                </div>
              </div>  
            </div>            
        </div>
        <br>
         <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                <div style="position: relative;">
                        <div class="scrollmenu" >
                        <?php for ($i=1; $i <=20 ; $i++) { ?>
                        <div> <!-- slick-content -->
                            <div class="haha">
                                <div class="yas">Column <?php echo $i?></div>
                                <div class="box">
                                    <div class="textinbox">
                                    <div>
                                        <select name="column_id<?php echo $i?>" id="column_id<?php echo $i?>" data-placeholder="Choose Column..." class="form-control select2" tabindex="2">
                                             <option value=""></option>
                                              <?php echo $cbcolumn?>
                                          </select>
                                    </div> 
                                    <div>
                                        <select name="column_justify<?php echo $i?>" id="column_justify<?php echo $i?>" data-placeholder="Choose Alignment..." class="form-control select2" tabindex="2">
                                              <option value="0">Left</option>
                                              <option value="1" selected="1">Center</option>
                                              <option value="2">Right</option>
                                        </select>
                                    </div>
                                    <div style="display: none;">
                                        <select name="column_factor<?php echo $i?>" id="column_factor<?php echo $i?>" data-placeholder="Choose Factor..." class="form-control select2" tabindex="2">
                                              <option value="0" selected="1">Normal</option>
                                              <option value="1">Dollar</option>
                                              <option value="10">Ten</option>
                                              <option value="100">Hundred</option>
                                              <option value="1000">Thousand</option>
                                              <option value="1000000">Million</option>
                                          </select>
                                    </div> 
                                    </div>
                                </div><br>
                            </div>
                            </div><!-- end of slick-content -->
                        <?php } ?>
                        </div>
                </div>
                </div>
            </div>            
        </div>
        <br>
        <input type="hidden" class="form-control" name="form" id="form" value="<?php echo $form;?>">
        <input type="hidden" class="form-control" name="column_x1" id="column_x1" value="1610">
        <input type="hidden" class="form-control" name="column_x2" id="column_x2" value="1962">
        <input type="hidden" class="form-control" name="column_x3" id="column_x3" value="2314">
        <input type="hidden" class="form-control" name="column_x4" id="column_x4" value="2666">
        <input type="hidden" class="form-control" name="column_x5" id="column_x5" value="3018">
        <input type="hidden" class="form-control" name="column_x6" id="column_x6" value="3370">
        <input type="hidden" class="form-control" name="column_x7" id="column_x7" value="3722">
        <input type="hidden" class="form-control" name="column_x8" id="column_x8" value="4074">
        <input type="hidden" class="form-control" name="column_x9" id="column_x9" value="4426">
        <input type="hidden" class="form-control" name="column_x10" id="column_x10" value="4778">
        <input type="hidden" class="form-control" name="column_x11" id="column_x11" value="5130">
        <input type="hidden" class="form-control" name="column_x12" id="column_x12" value="5482">
        <input type="hidden" class="form-control" name="column_x13" id="column_x13" value="5834">
        <input type="hidden" class="form-control" name="column_x14" id="column_x14" value="6186">
        <input type="hidden" class="form-control" name="column_x15" id="column_x15" value="6538">
        <input type="hidden" class="form-control" name="column_x16" id="column_x16" value="6890">
        <input type="hidden" class="form-control" name="column_x17" id="column_x17" value="7242">
        <input type="hidden" class="form-control" name="column_x18" id="column_x18" value="7594">
        <input type="hidden" class="form-control" name="column_x19" id="column_x19" value="7946">
        <input type="hidden" class="form-control" name="column_x20" id="column_x20" value="8298">
        </form>
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
loaddata();
function back(){
    window.location.href="<?php echo base_url('c_gl_report/index')?>";
}

$('#filter_zero').change(function(){
    var c = this.checked ? 'Y' : 'N';
    $('#filter_zero_val').val(c);
  
  });
    function setcolid(id,no){
    

        var site_url = '<?php echo base_url("c_gl_report/zoom_colid")?>';
            $.post(site_url,
              {id:id,no:no},
              function(data,status) {
                // console.log(data);
                $("#column_id"+no).empty();
                $("#column_id"+no).append(data);
                $("#column_id"+no).trigger('change');
               
              }
            );
         
                    
    }



    function loaddata(){
      
        var row_id = "<?php echo $row_id?>";
        var report_id = "<?php echo $report_id?>";

        if (report_id != '0') {
            // alert(report_id);
            document.getElementById('loader').hidden=false;
            $.getJSON("<?php echo base_url('c_gl_report/getByID');?>" + "/" + report_id + "/" + row_id, function (data) {
              // $('#form').val('edit');
              $('#report_id').val(data[0].report_id);
              $('#descs').val(data[0].descs);
              $('#row_id').val(data[0].row_id).trigger('change');
              
              document.getElementById('report_id').disabled = true;
              // document.getElementById('row_id').disabled = true;
              // alert(data[0].relative_by);
              
      
              var calc = data[0].filter_zero;
              if(calc == 'Y'){
                document.getElementById('filter_zero').checked = true;    
              }else{
                document.getElementById('filter_zero').checked = false;
              }
              for (var i = 1; i <= 20; i++) {
                setcolid(data[0]['column_id'+i],i);
                $('#column_factor'+i).val(data[0]['column_factor'+i]).trigger('change'); 
                // console.log(data[0]['column_factor'+i]);
              }

              // $('#column_factor1').val(data[0]['column_format1']).trigger('change'); 
                // console.log(data[0]);

              var c = $('#filter_zero').checked ? 'Y' : 'N';
              $('#filter_zero_val').val(c);

              $('#title_descs').val(data[0].title_descs);
              tblGLrptlist.ajax.reload(null,true);

            });

              $(document).ajaxStop(function() {
                    document.getElementById('loader').hidden=true;
                });
        }
    }
var tblGLrptlist;
$(document).ready(function () {

     $('.scrollmenu').slick({
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 4,
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
    $('#filter_zero_val').val('N');

    $(".select2").select2({
            width:"100%"
        }); 

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


     $("#frmEditor").validate({
            ignore:"",
            rules: {
                row_id:{
                  required:true
                },
                report_id: {
                    required: true
                },
                descs:{
                    required:true
                },
                title_descs:{
                    required:true
                }
            },
 
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
          $(element).addClass(errorClass); //.removeClass(errorClass);
          $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass(errorClass); //.addClass(validClass);
          $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            console.log(element);
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          } else if (element.hasClass('select2')){
            error.insertAfter(element.next('span'));
          } else {
            error.insertAfter(element);
          }
        }
        });
    $('#btnSave').click(function(){
    
      
      if($('#frmEditor').valid()){
        // var col_id1 = $('#column_id1').val();
        // if(col_id1==''){
        //     swal('Warning', 'Column 1 is required. Please select Column 1!','warning');
        //     return;
        // }
        // document.getElementById("btnSave").disabled = true;
        document.getElementById('loader').hidden=false;
        // return;
        // var field_id = $('#modal').data('MenuID');
        var datafrm = $('#frmEditor').serializeArray();
        var descs = $('#descs').val();
        var report_id = $('#report_id').val();
        // alert(report_id);
        datafrm.push({name:"reportid",value:report_id},{name:"descs",value:descs});
        // console.log(datafrm);return;
        // datafrm.push({name:"field_id",value:field_id});
    
          $.ajax({
            url : "<?php echo base_url('c_gl_report/save');?>",
              type:"POST",
              // async: false,
              data: datafrm,
              dataType:"json",
              success:function(event, data){
                document.getElementById('loader').hidden=true;
                // console.log(event);
                if(event.status!='OK'){
                      swal({
                          title: "Error",
                          animation: false,
                          type:"error",
                          text: event.Pesan,
                          confirmButtonText: "OK"
                        },function(){
                    
                            document.getElementById("btnSave").disabled = false;
                        });
                      
                } else {
                 
                  swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: event.Pesan,
                    confirmButtonText: "OK"
                  },function(){
                        window.location.href="<?php echo base_url('c_gl_report/index')?>";
                        document.getElementById("btnSave").disabled = false;
                    });
                  
                }
              },                    
              error: function(jqXHR, textStatus, errorThrown){
                document.getElementById('loader').hidden=true;
                
                swal({
                    title: "Information",
                    animation: false,
                    type:"success",
                    text: textStatus+' Save : '+errorThrown,
                    confirmButtonText: "OK"
                  });
              }
          });                
      }
    });
  });
</script>