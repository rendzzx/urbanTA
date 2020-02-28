<link href="<?=base_url('css/plugins/dataTables/datatables.min.css')?>" rel="stylesheet">
<link href="<?=base_url('css/plugins/dataTables/select.dataTables.min.css')?>" rel="stylesheet" />
<script src="<?=base_url('js/plugins/dataTables/jquery.dataTables.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/dataTables.select.min.js')?>" type="text/javascript"></script>
<script src="<?=base_url('js/plugins/dataTables/datatables.min.js')?>"></script>
<script type="text/javascript">
window.history.forward();
</script>

<div id="loader" class="loader" hidden="true"></div>
<div class="content-wrapper">
	<div class="row border-bottom white-bg dashboard-header">  
        <div class="form-group">
            <div class="judulprojek"><?php echo $ProjectDescs; ?></div>
            <!-- <div class="tittle-top pull-left"><?php echo $ProjectDescs; ?></div> -->
            <div class="tittle-top pull-right">NUP Colour</div>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
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
                            <table id="tblcolour" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No</th>                               
                                    <th>Initial Colour</th>
                                    <th>After Choose Colour</th>         
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

     
    

var tblcolour;
$(function(){
    
   tblcolour = $('#tblcolour').DataTable( 
    {
            dom: '<"toolbar dataTables_filter">Bfrtip',
            responsive: true,
            select: true,
            filter: false,
            paging:false,
            // info:false,  
            buttons: [
            	{
                    text: ' New', className: "btn biru-bg fa fa-plus insert",
                    action: function () {
                       
                        var site_url = '<?php echo base_url("c_nup_colour/countnumber")?>';
                        $.post(site_url,
                           {Id:'pro'},
                            function(data,status) {
                                  var nomer = data;
                                  if(nomer > 4) {
                                    swal("Information",'Can\'t insert anymore',"warning");
                                    return;
                                  }
                                  else{
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

                                    $('#modalTitle').html('Add Lot NUP Colour');

                                    $('div.modal-body').load("<?php echo base_url("c_nup_colour/add");?>");
                                    // $('#modal').data('nomer', countnumber);
                                    $('#modal').data('id', -10).modal('show');
                                    // $('#modal').data('id', UserID).modal('show');
                                  }
                                }
                             );
                        


                        
                        

                    }
                },
                
                {
                    text: ' Edit', className: 'btn biru-bg fa fa-pencil btn-sm',
                    action: function () {
                        
                        var rows = tblcolour.rows('.selected').indexes();
                        if (rows.length < 1) {
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblcolour.rows(rows).data();
                        var ID = data[0].counter_id;
                        console.log(ID);
                        

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

                        $('#modalTitle').html('Edit Lot NUP Colour');

                        $('div.modal-body').load("<?php echo base_url("c_nup_colour/add");?>");

                        $('#modal').data('id', ID).modal('show');

                    }
                }
                
             
                
            ],
        "serverSide": true,
        "ajax":{
                    "url":"<?php echo base_url('c_nup_colour/getTable');?>",  
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
        // ini ada button submit
        "columns": [
            {data: "counter_id",name:"counter_id", searchable:false},
            {data:"initial_colour",name:"initial_colour",
              render: function (data, type, row) {
                 return '<div style="width:100px;height:30px;background-color:'+row.initial_colour+'"></div>'
              }
            },
            {data:"after_choose_colour",name:"after_choose_colour",
              render: function (data, type, row) {
                 return '<div style="width:100px;height:30px;background-color:'+row.after_choose_colour+'"></div>'
              }
            }//,
            //{data:"counter_id", name:"counter_id",visible:false}
            ]
    });
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

    
      

    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblcolour.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblcolour.ajax.reload(null,true);   
        }
    });


});
function fn_search(){
    var a = $('#txt_search').val();
    tblcolour.ajax.reload(null,true); 
  }
</script>
