<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
 <script src="<?=base_url('js/plugins/datapicker/bootstrap-datepicker.js')?>"></script> 
 <link href="<?=base_url('css/plugins/datapicker/datepicker3.css')?>" rel="stylesheet">

<script type="text/javascript">
window.history.forward();
</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
    <div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <!-- <div class="tittle-top pull-left"><b><?php echo $ProjectDescs; ?></b></div> -->
            <div class="tittle-top pull-right">Unit List</div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div> <br>
         <div class="form-group">
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Project</label>
        <div class="col-sm-10">
          <select name="txt_Pl_Project" id="txt_Pl_Project" data-placeholder="Choose a Project..." class="select2" style="width:250px;" tabindex="2">
            <option value=""></option> 
            <?php echo $cbProject;?>            
          </select>
           <button id="search" class="btn blue-bg"><i class="fa fa-search"></i> <span class="hidden-xs">Search</span></button>
        </div>
        <br>
      </div>
        <div class="form-group">
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Product</label>
        <div class="col-sm-3">
          
          <select name="txtProduct" id="txtProduct" data-placeholder="Choose Product..." class="select2" style="width:250px;" tabindex="2">
          <option value="all"></option>
          <option value="all">All</option> 
            <?php 
            foreach ($Product as $row3) 
            {
              echo '<option value="'.$row3->product_cd.'">'.$row3->descs.'</option>';
            }
            ?>  
                   
          </select>
           
        </div>
        
        <br>
      </div>
      <div class="form-group">
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Choose Property</label>
      <div class="col-sm-3">
          
          <select name="txtProperty" id="txtProperty" data-placeholder="Choose Property..." class="select2" style="width:250px;" tabindex="2">
          <option value="all"></option>
          <option value="all">All</option> 
            <?php 
            foreach ($Property as $row3) 
            {
              echo '<option value="'.$row3->property_cd.'">'.$row3->descs.'</option>';
            }
            ?>  
                   
          </select>
           
        </div>
        
        <br>
      </div>
     
      <div class="form-group">
      <label for="pl_project" class="col-sm-2 control-label" style="padding-left:0px;"> Status</label>
        <div class="col-sm-10">
          <select name="txtStatus" id="txtStatus"  class="select2" style="width:250px;" tabindex="2">
              <option value="all"></option>
              <option value="all">All</option>
              <option value="A">Available</option>
              <option value="B">Booked</option>  
              <option value="H">Hold</option>
              <option value="R">Reserve</option>       
          </select>           
        </div>
        <br>
      </div>
     
    </div>
    <div class="wrapper wrapper-content" >
        <div class="row">
            <div class="col-xs-12">
                <div class="ibox-content">
                    <div class="table-responsive">                       
                        <div class="box-body"> 
                        <!-- <b>&nbsp; NUP Enquiry By Principal</b> -->
                        <br>                             
                            <table id="tblcount" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No.</th>
                                    <th>Unit</th>
                                    <th>Description</th>
                                    <th>Description</th>
                                    <th>Description</th>
                                    <th>Description</th> 
                                    <th>Land Area</th>   
                                    <th>Build Up Area</th> 
                                    <th>Status</th>
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
    <!-- Bootstrap Modal -->
    <div id="modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
      <div id="modalDialog2" class="modal-dialog">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              <span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span>
            </button>
            <h5 class="modal-title" id="modalTitle2"></h5>
          </div>
          <!-- Modal Body -->
          <div class="modal-body2">
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">

var tblcount;
$(function(){
   
    $('.select2').select2();
    $('#end').datepicker({
        format: 'dd/mm/yyyy',
        onSelect: function(dateText, inst) {
            $("input[name='end']").val(dateText);
        }
    });
    $('#start').datepicker({
        format: 'dd/mm/yyyy',
        onSelect: function(dateText, inst) {
            $("input[name='start']").val(dateText);
        }
    });
   tblcount = $('#tblcount').DataTable( 
    {
            dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter: false,    
            paging:false,       
            buttons: [
                
                {
                extend: 'collection',
                className: 'btn biru-bg fa fa-star',
                text: ' Action',
                buttons: [
                    // 'copy',
                    'excel',
                    'csv',
                    'pdf',
                    // 'print'
                            ]           
                },
                
               
                {
                    text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                                 tblcount.ajax.reload(null,true);
                                 document.getElementById('loader').hidden=true;
                              },1000);
                          }

                       // document.getElementById('loader').hidden=false;
                       // tblnup.ajax.reload(null,true);
                       // document.getElementById('loader').hidden=true;
                    }
                }
                
             
                
            ],
        "serverSide": true,
        "ajax":{
                    "url":"<?php echo base_url('c_master_unit/getTable');?>",  
                    "data":{"sSearch": function(d){
                    var a = $('#txt_search').val();
                    
                    var b ="";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }

                    },
                    "product": function(d){
                    var a = $('#txtProduct').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    },
                    "property": function(d){
                    var a = $('#txtProperty').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    },
                    "status": function(d){
                    var a = $('#txtStatus').val();
                    
                    var b ="all";
                    if(a == null){
                        return b;
                    }{
                        return a;
                    }
                    console.log(a);
                    }

                        },          
                "type":"POST"
            },
        // ini ada button submit
        "columns": [
            {data: "row_number",name:"row_number", searchable:false},
            {data:"lot_no",name:"lot_no"},            
            {data:"type_descs",name:"type_descs"},
            {data:"block_descs",name:"block_descs"},
            {data:"zone_descs",name:"zone_descs"},
            {data:"direction_descs",name:"direction_descs"},
            {data:"land_area",name:"land_area"},
            {data:"build_up_area",name:"build_up_area"},
            {data:"status_desc",name:"status_desc"}
            
            ]
    });
    $("div.toolbar").html('<div class="input-group" ><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblcount.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblcount.ajax.reload(null,true);   
        }
    });

});
$("#txtProduct").change(function() {
          var project = $('#txt_Pl_Project').val(); 
          var product = $(this).find(':selected').val();          
          if(product!=='') {
            var site_url = '<?php echo base_url("c_master_unit/zoom_property")?>';
            $.post(site_url,
              {product:product,project:project},
              function(data,status) {
                $("#txtProperty").empty();
                $("#txtProperty").append(data);
                $("#txtProperty").trigger('change');
                // $("#TxtphaseCode").trigger('change');
              }
            );
          } else {
            $("#txtProperty").empty();
          }
        });

function fn_search(){
    var a = $('#txt_search').val();
    tblcount.ajax.reload(null,true); 
    }

$('#search').click(function(){
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    // alert(date_start+', '+date_end);
    
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    if (date_start!='' && date_end=='')
    {
        swal('Warning','Please input date end','warning');
        return;
    }
    if (date_start=='' && date_end!='')
    {
        swal('Warning','Please input date start','warning');
        return;
    }
    document.getElementById('loader').hidden=false;
        var state = document.readyState
            if (state == 'complete') {
                setTimeout(function(){
                    document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                    tblcount.ajax.reload(null,true);
                    document.getElementById('loader').hidden=true;
                },1000);
            }
    
});

function fn_search2(){
    document.getElementById('loader').hidden=false;
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    if (date_start!='all' && date_end=='all')
    {
        swal('Warning','Please input date end','warning');
    } else if (date_start=='all' && date_end!='all')
    {
        swal('Warning','Please input date start','warning');
    } else {
        var a = $('#txt_search').val();
        document.getElementById('loader').hidden=false;
        tblcount.ajax.reload(null,true); 
        document.getElementById('loader').hidden=true;
    }

    
    }
function search(){
    var date_end = $('#end').val();
    var date_start = $('#start').val();
    if(date_end==null || date_start==null ){
        date_end='all';
        date_start='all';
    }
    var lead = $('#txtLead').val();
    var agent = $('#txtAgent').val();
    var product = $('#txtProduct').val();
    var type = $('#txtNUPtype').val();
    alert(date_end+'--'+date_start+', '+lead+', '+agent+', '+product+', '+type);
}
function nuptypeinfo(status)
  {
    // alert(status);
    var modalClass = $('#modal2').attr('class');
                        switch (modalClass) {
                            case "modal2 fade bs-example-modal-md":
                                $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            case "modal fade bs-example-modal-sm":
                                $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                            default:
                                $('#modal2').removeClass(modalClass).addClass('modal fade bs-example-modal-lg');
                                break;
                        }

                        var modalDialogClass = $('#modalDialog2').attr('class');
                        switch (modalDialogClass) {
                            case "modal-dialog modal-md":
                                $('#modalDialog2').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            case "modal-dialog modal-sm":
                                $('#modalDialog2').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                            default:
                                $('#modalDialog2').removeClass(modalDialogClass).addClass('modal-dialog modal-lg');
                                break;
                        }
                        
                        if(status == 1){
                          $('#modalTitle2').html('NUP Type Information');  
                        }else{
                          $('#modalTitle2').html('Preffered launching location');  
                        }
                        
                        $('div.modal-body2').load("<?php echo base_url("c_nup/showinfo");?>/"+ status);

                        $('#modal2').modal('show');
  }
</script>
