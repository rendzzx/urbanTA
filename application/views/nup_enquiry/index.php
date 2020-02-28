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
            <div class="tittle-top pull-right">NUP Enquiry</div>
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
                            <table id="tblenquiry" class="table table-striped table-bordered table-hover dataTables" cellspacing="0" width="100%" >
                                <thead>    
                                    <th>No</th>
                                    <th>Agent Name</th>                                        
                                    <th>Customer Name</th>                                
                                    <th>Customer Handphone</th>
                                    <!-- <th>Customer Email</th> -->
                                    <th>NUP No.</th>
                                    <!-- <th>Reserve Date</th> -->
                                    <th>Agent Name</th>
                                    <th>Principle Name</th>
                                    <th>Lead Name</th>
                                    <th>Agent HP</th>
                                    <th>Status</th>
                                    <th>Choose Unit Status</th>
                                    <th>Type</th>
                                    <th>Product</th>
                                    <th>Confirm Unit</th>
                                    <th>Choosen Unit</th>
                                    <th></th>
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
var tblenquiry;
$(function(){
   tblenquiry = $('#tblenquiry').DataTable( 
    {
            dom: '<"toolbar dataTables_filter">Bfrtip',
            // responsive: true,
            responsive: {
                    details: {
                        type: 'column',
                        target: 15
                    }
                },
            select: true,
            filter: false,    
            paging:false,
            // info:false,        
            buttons: [
            	{
                    text: ' View', className: "btn biru-bg fa fa-desktop",
                    action: function () {
                      
                        var rows = tblenquiry.rows('.selected').indexes();
                        if (rows.length < 1) {                            
                            swal("Information",'Please select a row',"warning");
                            return;
                        }

                        var data = tblenquiry.rows(rows).data();
                        var UserID = data[0].rowID;
                        // alert(UserID);
                        


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

                        $('#modalTitle').html('View NUP Enquiry');

                        $('div.modal-body').load("<?php echo base_url("c_nup_enquiry/view");?>"+"/"+UserID);

                        $('#modal').data('id', UserID).modal('show');

                    }
                },
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
                    text: ' Back ', className: 'btn biru-bg fa fa-arrow-left', action: function (e) {
                        var project = "<?php echo $project_no?>";
                        var projectName = "<?php echo $ProjectDescs; ?>";
                        var encParam = "<?php echo $encParam ?>";
                        // BootstrapDialog.alert(projectName);
                         // window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+project+'-'+projectName;
                         window.location.href="<?php echo base_url('newsfeed/index');?>"+'/'+encParam;
                    }
                },
                {
                    text: ' Refresh ', className: 'btn biru-bg fa fa-refresh', action: function (e) {
                       
                       document.getElementById('loader').hidden=false;
                       var state = document.readyState
                          if (state == 'complete') {
                              setTimeout(function(){
                                  document.getElementById('interactive');
                                 // document.getElementById('load').style.visibility="hidden";
                                 tblenquiry.ajax.reload(null,true);
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
                    "url":"<?php echo base_url('c_nup_enquiry/getTable');?>",  
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
            {data: "row_number",name:"row_number", searchable:false},
            {data:"agent_name",name:"agent_name"},
            {data:"NAME",name:"NAME"},            
            {data:"Handphone",name:"Handphone"},
            // {data:"Email",name:"Email"},
            {data:"nup_no",name:"nup_no"},
            
            // {
            //     data:"reserve_date",name:"reserve_date",
            //     render: function (data, type, row) {

            //                     var date = new Date(parseInt(data.substr(0,10)));
            //                     var year =data.substr(0,4);
            //                     var month=data.substr(5,2);
            //                     var day =data.substr(8,2);
                               
            //                    // BootstrapDialog.alert(data);
            //                    // var aa=date.getDate() + "/" + (month.length > 1 ? month : "0" + month) + "/" + date.getFullYear();
            //                    var aa = day+"/"+month+"/"+year;
            //                     return aa;
                               
                               

            //                }
            // },
            {data:"agent_name",name:"agent_name"},
            {data:"group_name",name:"group_name"},
            {data:"lead_name",name:"lead_name"},
            {data:"agent_handphone",name:"agent_handphone"},
            {data:"status_desc",name:"status_desc"},            
            {data:"choose_unit_status",name:"choose_unit_status"},
            // {data:"choose_unit_status",name:"choose_unit_status",
            //                 render: function (data, type, row) {
            //                   if(data=='Y'){
            //                     return 'Yes';
            //                   } else {
            //                     return 'No';
            //                   }
                           
            //             }
            // },
            {data:"descs",name:"descs"},
            {data:"product_descs",name:"product_descs"},
            {data:"lot_no",name:"lot_no"},
            {data:"Lot_descs",name:"Lot_descs"},
            {data:"columdef",name:"columdef"}
            ],
            "columnDefs": [ {
                    className: 'control',
                    orderable: false,
                    targets:   15
                } ]
    });
    $("div.toolbar").html('<div class="input-group"><b>Search : <div class="input-group"><input type="text" style="width: 150px; height: 25px; border-bottom: 1px;" id="txt_search" name="txt_search" ><a class="btn blue-bg btn-sm" onclick="fn_search()"><i class="fa fa-search"></i></a></div></div> </b>');

    $("#txt_search").keyup(function(event){
        var a = $('#txt_search').val();
        
            if(a==''){
                tblenquiry.ajax.reload(null,true);   
            }
            if(event.keyCode == 13){
            
            tblenquiry.ajax.reload(null,true);   
        }
    });

});
function fn_search(){
    var a = $('#txt_search').val();
    tblenquiry.ajax.reload(null,true); 
    }
</script>
